<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//$_GET['domain'] = 'hostingtool.nl';
//$_GET['domain'] = 'cyberfusion.nl';
//$_GET['domain'] = 'münchen.de';
//$_GET['domain'] = 'example.tel';
//$_GET['domain'] = 'rdap.org';
//$_GET['domain'] = 'france.fr';
//$_GET['domain'] = 'domaincontrolregister.org';
//$_GET['domain'] = 'icann.org';
//$_GET['domain'] = 'amsterdam.amsterdam';

if (!empty($_GET['domain']))	{
	if (strlen($_GET['domain']))	{
		$domain = $_GET['domain'];
		$batch = false;
		if (isset($_GET['batch']) && trim($_GET['batch']) === '1') {
		    $batch = true;
		}
		$domain = htmlspecialchars($domain, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
		$domain = mb_strtolower($domain);
		$domain = str_replace('http://','', $domain);
		$domain = str_replace('https://','', $domain);
		if (preg_match('/^www\.(.+)$/i', $domain, $m)) {
    		if (substr_count($m[1], '.') >= 1) {
        		$domain = $m[1];
    		}
		}
		$pos = mb_strpos($domain, '/');
		if ($pos !== false) {
		    $domain = mb_substr($domain, 0, $pos);
		}
		$pos = mb_strpos($domain, ':');
		if ($pos !== false) {
    		$domain = mb_substr($domain, 0, $pos);
		}		
		$domain = toPunycodeIfNeeded($domain);
		header('Content-Type: application/json');
		$registry_interface = '';
		$registrar_interface = '';
		$registry_rdap = write_file($domain, $batch, '');
		$registry_statuses = $registry_rdap['properties']['statuses_raw'] ?? null;
		$registry_zone = $registry_rdap['metadata']['zone_identifier'] ?? null;
		$registrar_rdap = [];
		if (!empty($registry_statuses) and mb_strlen($registry_zone) > 2) {
			$registry_rdap['metadata']['rdap_layer'] = 'registry_rdap';
			$registry_rdap['metadata']['registry_json_response_uri'] = $registry_rdap['metadata']['url_json_response_uri'];
			$self_uri = $registry_rdap['metadata']['self_json_response_uri'] ?? null;
			$related_uri = $registry_rdap['metadata']['related_json_response_uri'] ?? null;
			if (empty($self_uri)) {
				$registry_interface .= 'Registry RDAP has no rel="self" link.';
			}		
			elseif (strcasecmp($registry_rdap['metadata']['url_json_response_uri'], $self_uri) !== 0) {
 				$registry_interface .= 'Registry RDAP has a wrong rel="self" link.';
			}
			elseif (strcasecmp($related_uri, $self_uri) === 0) {
    			$registry_interface .= 'Registry RDAP has equal rel="self"/"related".';
			}
			$registrar_identifier = $registry_rdap['metadata']['registrar_identifier'] ?? null;
			if (!empty($related_uri)) {
       			$registrar_rdap = write_file($domain, $batch, $related_uri);
				$registry_rdap['metadata']['registrar_json_response_uri'] = $related_uri;
				$registrar_rdap['metadata']['rdap_layer'] = 'registrar_rdap';
			}
			elseif (!empty($registrar_identifier))	{
				$iana_id = (int) $registrar_identifier;
				if ($iana_id > 0 and $iana_id < 9990) {
					$base_url = fetchIanaRegistrarRdapBaseUrl($iana_id);
		    		if ($base_url) {
						$registrar_uri = rtrim($base_url, '/') . '/domain/' . rawurlencode($domain);
						$registry_rdap['metadata']['registrar_json_response_uri'] = $registrar_uri;
						$registry_rdap['interface_notice'] = 'Registry RDAP has no rel="related" link.';
       					$registrar_rdap = write_file($domain, $batch, $registrar_uri);
						$registrar_statuses = $registrar_rdap['properties']['statuses_raw'] ?? null;
						if (!empty($registrar_statuses)) {						
							$registrar_rdap['metadata']['rdap_layer'] = 'registrar_rdap';
							if (strlen($registry_interface))	{
								$registry_interface .= "<br />";
							}
							$registry_interface .= 'Registry RDAP has no rel="related" link.';
						}	
    				}	
					else	{
						if (strlen($registrar_interface))	{
							$registrar_interface .= "<br />";
						}
						$registrar_interface .= $iana_id . " - no retrieval";	
					}	
				}			
			}
			$url_uri = $registrar_rdap['metadata']['url_json_response_uri'] ?? null;
			$self_uri = $registrar_rdap['metadata']['self_json_response_uri'] ?? null;
			if (!empty($self_uri)) {
				$registrar_rdap['metadata']['registry_json_response_uri'] = $self_uri;
			}
			elseif (!empty($url_uri)) {
				$registrar_rdap['metadata']['registry_json_response_uri'] = $url_uri;
			}
			$related_uri = $registrar_rdap['metadata']['related_json_response_uri'] ?? null;					
			if (!empty($related_uri)) {
				$registrar_rdap['metadata']['registrar_json_response_uri'] = $related_uri;
				if (strlen($registrar_interface))	{
					$registrar_interface .= "<br />";
				}
				$registrar_interface .= 'Registrar RDAP shows a rel="related" link.';
			}
		}	
		$registry_rdap['interface_notice'] = $registry_interface;
		$registrar_rdap['interface_notice'] = $registrar_interface;
		$merged = [];
		$merged[$domain]['registry']  = $registry_rdap ?? [];
		$merged[$domain]['registrar'] = $registrar_rdap ?? [];
		echo json_encode($merged, JSON_PRETTY_PRINT);
		die();
	}
	else	{	
		die("No domain name is filled as input");	
	}
}
else	{	
	die("No domain name variable as input");
}

function detect_country_code($inputdefault, $inputCC, $inputcc)	{	
	$outputcc = $inputdefault;
	if (strlen($inputCC))	$outputcc = $inputCC.' "CC"=>"cc"';
	if (strlen($inputcc))	$outputcc = $inputcc;
	return $outputcc;
}

function toPunycodeIfNeeded($inputdomain) {
    if (strpos($inputdomain, 'xn--') === false) {
        $punycode = idn_to_ascii($inputdomain, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
        if ($punycode !== false) {
            return $punycode;
        }
		else {
            die("Invalid domain: $inputdomain");
        }
    }
    return $inputdomain;
}

function interprete_remark($inputkey, $inputvalue) {
    $esc = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
    $out = '';

    if ($inputkey === 'title' && $inputvalue !== '') {
        $out .= '<strong>'.$esc($inputvalue).'</strong> ';
    }
    elseif ($inputkey === 'type' && $inputvalue !== '') {
        // We'll add a colon, but we’ll also include a cleanup step at the caller to strip it if nothing follows.
        $out .= '<em>'.$esc($inputvalue).'</em>: ';
    }
    elseif ($inputkey === 'description') {
        if (is_array($inputvalue)) {
            $out .= implode('<br />', array_map($esc, $inputvalue));
        }
		elseif ($inputvalue !== null && $inputvalue !== '') {
            $out .= $esc($inputvalue);
        }
    }
    elseif ($inputkey === 'links' && is_array($inputvalue)) {
        // Collect and join to avoid a trailing <br />
        $links = [];
        foreach ($inputvalue as $link) {
            if (!empty($link['href'])) {
                $text = $link['value'] ?? $link['href'];
                $links[] = '<a href="'.$esc($link['href']).'" target="_blank" rel="noopener">'.$esc($text).'</a>';
            }
        }
        if ($links) {
            $out .= implode('<br />', $links);
        }
    }
    else {
        // Fallback for unexpected fields
        if ($inputvalue !== null && $inputvalue !== '') {
            $out .= $esc($inputvalue);
        }
    }

    return $out;
}

function fetchIanaRegistrarRdapBaseUrl(int $ianaId): ? string	{
    static $rdapMap = null;

    if ($rdapMap === null) {

        $csvUrl = 'https://www.iana.org/assignments/registrar-ids/registrar-ids-1.csv';

        // Add timeouts so it can’t hang forever
        $ctx = stream_context_create([
            'http' => [
                'timeout' => 8,
                'user_agent' => 'rdap-tool/1.0',
            ],
            'ssl' => [
                'verify_peer' => true,
                'verify_peer_name' => true,
            ],
        ]);

        $err = null;
        set_error_handler(function($severity, $message) use (&$err) {
            $err = $message;
            return true; // suppress default warning output
        });

        $csvContent = file_get_contents($csvUrl, false, $ctx);

        restore_error_handler();

        if ($csvContent === false) {
            //echo "B: " . ($err ?? 'unknown error') . "\n";
            return null;
        }

        $fp = fopen('php://temp', 'r+');
        fwrite($fp, $csvContent);
        rewind($fp);

        $header = fgetcsv($fp);
        if (!$header) {
            fclose($fp);
            return null; // invalid CSV
        }

        // Locate required columns dynamically
		$idAliases   = ['Registrar ID', 'IANA Registrar ID', 'ID'];
		$rdapAliases = ['RDAP Base URL', 'RDAP URL', 'RDAP'];

		$find = function(array $header, array $aliases) {
    		foreach ($aliases as $a) {
        		$idx = array_search($a, $header, true);
        		if ($idx !== false) return $idx;
    		}
    		return false;
		};

		$idIndex   = $find($header, $idAliases);
		$rdapIndex = $find($header, $rdapAliases);

		if ($idIndex === false || $rdapIndex === false) { fclose($fp); return null; }

        $rdapMap = [];

        while (($row = fgetcsv($fp)) !== false) {
            $id   = isset($row[$idIndex]) ? (int) trim($row[$idIndex]) : 0;
            $rdap = isset($row[$rdapIndex]) ? trim($row[$rdapIndex]) : '';

            if ($id > 0 && $rdap !== '') {
	            // Normalize: remove trailing slash
                $rdapMap[$id] = rtrim($rdap, '/');
            }
        }

        fclose($fp);
    }

    return $rdapMap[$ianaId] ?? null;
}

function write_file($inputdomain, $inputbatch, $inputurl)	{

$arr = array();
$arr['interface_notice'] = "";
if (strlen($inputurl))	{
	$registry_response_model = '';
	$url = $inputurl;
}	
else	{	
	$strpos = mb_strpos($inputdomain, '.');
	if ($strpos !== false)	{
		$zone_identifier = mb_substr($inputdomain, mb_strrpos($inputdomain, '.') + 1);
	}
	else	{
		$arr['metadata']['zone_identifier'] = 'tld';
		return $arr;
	}
	$time_start = microtime(true);			
	$url = '';	
	switch ($zone_identifier) {
		case 'nl':
   			$url = 'https://rdap.sidn.nl/';
   			break;		
		case 'biz':
   			$url = 'https://rdap.nic.biz/';
   			break;	
		case 'com':
   			$url = 'https://rdap.verisign.com/com/v1/';
   			break;	
		case 'net':
   			$url = 'https://rdap.verisign.com/net/v1/';
   			break;
		case 'org':
   			$url = 'https://rdap.publicinterestregistry.org/rdap/';
			break;
		case 'ca':
			$url = 'https://rdap.ca.fury.ca/rdap/';
			break;
		case 'ch':
   			$url = 'https://rdap.nic.ch/';	
   			break;		
		case 'de':
   			$url = 'https://rdap.denic.de/';
   			break;
		case 'fr':
			$url = 'https://rdap.nic.fr/';
			break;
		case 'uk':
    		$url = 'https://rdap.nominet.uk/uk/';
    		break;
		case 'amsterdam':
    		$url = 'https://rdap.nic.amsterdam/';
    		break;
		case 'politie':
    		$url = 'https://rdap.nic.politie/';
    		break;
		case 'aw':
    		$url = 'https://rdap.nic.aw/';
    		break;	
		case 'frl':
    		$url = 'https://rdap.centralnic.com/frl/';
    		break;
		case 'ch':
    		$url = 'https://rdap.nic.ch/';
    		break;
		case 'li':
    		$url = 'https://rdap.nic.ch/';
    		break;	
		default:
   			//die("No match with a top level domain.");
	}	
	$lookup_endpoints_uri = 'https://data.iana.org/rdap/dns.json';
	if (!strlen($url))	{
		$rdap = json_decode(file_get_contents($lookup_endpoints_uri), true);
		$temp_key = -1;
		foreach($rdap as $key1 => $value1) {
    		foreach($value1 as $key2 => $value2) {
				foreach($value2 as $key3 => $value3) {				
					foreach($value3 as $key4 => $value4) {
						if ($key3 == 0 and $value4 == $zone_identifier)	{
							$temp_key = $key2;
							break;
						}
						elseif ($key3 == 1 and $key2 == $temp_key)	{
							$url = $value4;
							break 4;
						}					
					}
				}
			}
		}
	}
	if (!strlen($url))	{
		$arr['interface_notice'] = $zone_identifier . " - Operational RDAP unknown";
		return $arr;
	}
	$url .= 'domain/'.$inputdomain;
	switch ($zone_identifier) {
		case 'com':
		case 'net':
			$registry_response_model = 'thin';
			break;
		case 'org':
			$registry_response_model = 'delegated';
			break;
		default:
			$registry_response_model = 'thick';
	}
}
$options = [
  "http" => [
    "method" => "GET",
    "ignore_errors" => true,
    "timeout" => 8,
    "header" => "User-Agent: MyRDAPClient/1.0\r\nAccept: application/json\r\n",
  ]
];
$context = stream_context_create($options);
$time_pass = microtime(true) - $time_start;
if ($time_pass < 1.05) {
  usleep((int)((1.05 - $time_pass) * 1_000_000));
}
$start_monotonic = microtime(true);
$start_utc_iso   = gmdate('c');
$server_seen = $_SERVER['SERVER_ADDR'] ?? null;
$fp = @fopen($url, 'r', false, $context);
if (!$fp) {
  $arr['interface_notice'] = [
    'message' => 'Failed to open URL',
    'php_error' => error_get_last(),
    'time_utc' => $start_utc_iso,
    'server_ip' => $server_seen,
    'url' => $url,
  ];
  return $arr;
}
$response = stream_get_contents($fp);
fclose($fp);
$http_code = null;
if (!empty($http_response_header) && preg_match('#^HTTP/\S+\s+(\d{3})#', $http_response_header[0], $matches)) {
	$http_code = (int)$matches[1];
}
$elapsed_seconds = microtime(true) - $start_monotonic;
if ($http_code === null) {
	$arr['interface_notice'] = "No HTTP status line at $start_utc_iso UTC in " . round($elapsed_seconds, 2) . " sec observed from $server_seen";
  	return $arr;
}
if ($http_code === 429) {
	$arr['interface_notice'] = "429 - Rate limit exceeded at $start_utc_iso UTC in " . round($elapsed_seconds, 2) . " sec observed from $server_seen";
	return $arr;
}
if ($http_code !== 200) {
	$arr['interface_notice'] = $http_code . " - Insufficient HTTP response at $start_utc_iso UTC in " . round($elapsed_seconds, 2) . " sec observed from $server_seen";
	return $arr;
}
try {
  	$obj = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
}
catch (JsonException $e) {
	$arr['interface_notice'] = "200 - JSON decode exception: " . $e->getMessage() . " at $start_utc_iso UTC in " . round($elapsed_seconds, 2) . " sec observed from $server_seen";
	return $arr;
}
if (!is_array($obj)) {
	$arr['interface_notice'] = "200 - Invalid JSON structure at $start_utc_iso UTC in " . round($elapsed_seconds, 2) . " sec observed from $server_seen";
	return $arr;
}
$notices = '';	
$links = '';		
$redacted = '';
$resource_upload_at = null;
$object_type = $obj['objectClassName'];
$rdap_version = '';	
$rdap_conformance = (is_array($obj['rdapConformance'])) ? implode(",<br />", $obj['rdapConformance']) : $obj['rdapConformance'];
$language_codes = (is_array($obj['lang'])) ? implode(",<br />", $obj['lang']) : $obj['lang'];
$registrar_accreditation = '';
$registrar_identifier = null;
$self_json_response_uri = '';
$related_json_response_uri = '';
$registrar_complaint_uri = '';	
$status_explanation_uri = '';
$registrant_web_id = '';
if ($zone_identifier == 'nl' or $zone_identifier == 'frl')	{		
	$registrant_web_id = 'NL88COMM01234567890123456789012345';	
}
$created_at = null;
$latest_registrar_transfer_at = null;			
$latest_data_mutation_at = null;
$server_statuses = '';
$client_statuses = '';
$policy_statuses = '';
$dns_state = 'dns_undelegated';
$expiration_at = null;
$lifecycle_phase = '';	
$deletion_at = null;	
$extensions = '';
$remarks = '';
$registrant_statuses_raw = '';
$registrant_created_at = null;
$registrant_latest_transfer_at = null;	
$registrant_latest_data_mutation_at = null;
$registrant_expiration_at = null;	
$registrant_deletion_at = null;
$registrant_properties = '(not tested yet)';		
$registrant_remarks = '';		
$administrative_properties = '(not tested yet)';	
$administrative_remarks = '';
$technical_properties = '(not tested yet)';	
$technical_remarks = '';
$billing_properties = '(not tested yet)';
$billing_remarks = '';		
$reseller_statuses_raw = '';
$reseller_created_at = null;
$reseller_latest_transfer_at = null;	
$reseller_latest_data_mutation_at = null;
$reseller_expiration_at = null;	
$reseller_deletion_at = null;
$reseller_properties = '(not tested yet)';	
$reseller_remarks = '';		
$registrar_statuses_raw = '';	
$registrar_created_at = null;
$registrar_latest_transfer_at = null;	
$registrar_latest_data_mutation_at = null;
$registrar_expiration_at = null;	
$registrar_deletion_at = null;		
$registrar_properties = '(not tested yet)';	
$registrar_remarks = '';
$sponsor_statuses_raw = '';
$sponsor_created_at = null;
$sponsor_latest_transfer_at = null;	
$sponsor_latest_data_mutation_at = null;
$sponsor_expiration_at = null;	
$sponsor_deletion_at = null;
$sponsor_properties = '(not tested yet)';
$sponsor_remarks = '';
$server_handle	= '';
$client_handle = $obj['handle'];
$ascii_name = $obj['ldhName'];
$unicode_name = $obj['unicodeName'];
$nameservers_dnssec_signed = '';
$nameservers_dnssec_key_tag = '';	
$nameservers_dnssec_algorithm = '';
$nameservers_dnssec_digest_type = '';
$nameservers_dnssec_digest = '';	
	
$sponsor_handle = '';
$sponsor_organization_type = '';	
$sponsor_organization_name = '';		
$sponsor_presented_name = '';	
$sponsor_kind = '';
$sponsor_name = '';
$sponsor_email = '';
$sponsor_phone = '';
$sponsor_country_code = '';		
$sponsor_street_address = '';
$sponsor_city = '';
$sponsor_state_or_province = '';	
$sponsor_postal_code = '';
$sponsor_country_name = '';
$sponsor_links = '';	
$registrant_handle = '';
$registrant_organization_type = '';
$registrant_organization_name = '';	
$registrant_presented_name = '';
$registrant_kind = '';
$registrant_name = '';
$registrant_email = '';
$registrant_contact_uri = '';	
$registrant_phone = '';
$registrant_country_code = '(not provided)';
$registrant_street_address = '';
$registrant_city = '';
$registrant_state_or_province = '';
$registrant_postal_code = '';
$registrant_country_name = '';	
$registrant_language_pref_1 = '';
$registrant_language_pref_2 = '';
$registrant_links = '';	
$administrative_handle = '';
$administrative_organization_type = '';
$administrative_organization_name = '';	
$administrative_presented_name = '';
$administrative_kind = '';
$administrative_name = '';	
$administrative_email = '';
$administrative_contact_uri = '';	
$administrative_phone = '';
$administrative_country_code = '';	
$administrative_street_address = '';
$administrative_city = '';	
$administrative_state_or_province = '';
$administrative_postal_code = '';	
$administrative_country_name = '';
$administrative_language_pref_1 = '';
$administrative_language_pref_2 = '';
$administrative_links = '';	
$technical_handle = '';
$technical_organization_type = '';
$technical_organization_name = '';	
$technical_presented_name = '';
$technical_kind = '';
$technical_name = '';	
$technical_email = '';
$technical_contact_uri = '';	
$technical_phone = '';
$technical_country_code = '';	
$technical_street_address = '';
$technical_city = '';	
$technical_state_or_province = '';
$technical_postal_code = '';	
$technical_country_name = '';
$technical_language_pref_1 = '';
$technical_language_pref_2 = '';
$technical_links = '';	
$billing_handle = '';
$billing_organization_type = '';
$billing_organization_name = '';	
$billing_presented_name = '';
$billing_kind = '';
$billing_name = '';		
$billing_email = '';
$billing_contact_uri = '';	
$billing_phone = '';
$billing_country_code = '';	
$billing_street_address = '';
$billing_city = '';	
$billing_state_or_province = '';	
$billing_postal_code = '';	
$billing_country_name = '';
$billing_links = '';	

$reseller_handle = '';
$reseller_organization_type = '';	
$reseller_organization_name = '';	
$reseller_presented_name = '';	
$reseller_kind = '';	
$reseller_name = '';
$reseller_email = '';	
$reseller_contact_uri = '';	
$reseller_phone = '';
$reseller_country_code = '';	
$reseller_street_address = '';
$reseller_city = '';
$reseller_state_or_province = '';	
$reseller_postal_code = '';
$reseller_country_name = '';	
$reseller_language_pref_1 = '';
$reseller_language_pref_2 = '';
$reseller_links = '';
	
$registrar_handle = '';
$registrar_organization_type = '';
$registrar_organization_name = '';	
$registrar_presented_name = '';	
$registrar_kind = '';
$registrar_name = '';	
$registrar_email = '';
$registrar_contact_uri = '';	
$registrar_phone = '';
$registrar_country_code = '';	
$registrar_street_address = '';
$registrar_city = '';
$registrar_state_or_province = '';	
$registrar_postal_code = '';
$registrar_country_name = '';	
$registrar_language_pref_1 = '';
$registrar_language_pref_2 = '';
$registrar_links = '';
	
$registrar_abuse_handle = '';	
$registrar_abuse_organization_type = '';
$registrar_abuse_organization_name = '';
$registrar_abuse_presented_name = '';
$registrar_abuse_kind = '';
$registrar_abuse_email = 'Abuse contact email unavailable.';
$registrar_abuse_contact_uri = '';	
$registrar_abuse_phone = '';
$registrar_abuse_country_code = '';	
	
$nameservers_handles = '';
$nameservers_ascii = '';
$nameservers_unicode = '';
$nameservers_ipv4 = '';
$nameservers_ipv6 = '';
$nameservers_statuses_raw = '';
$nameservers_delegation_check = '';
$nameservers_latest_correct_delegation_check = '';
	
$entity_sponsor = -1;	
$entity_registrant = -1;
$entity_administrative = -1;
$entity_technical = -1;
$entity_billing = -1;	
$entity_reseller = -1;		
$entity_registrar = -1;
$entity_key4_sponsor = -1;	
$entity_key4_registrant = -1;	
$entity_key4_administrative = -1;
$entity_key4_tech = -1;
$entity_key4_billing = -1;
$entity_key4_reseller = -1;		
$entity_key4_registrar = -1;
$entity_key4_registrar_abuse = -1;	

$raw_rdap_data = '';
	
foreach($obj as $key1 => $value1) {
	$raw_rdap_data .= $key1 . ': ' . $value1 . "\n";
    foreach($value1 as $key2 => $value2) {
		$raw_rdap_data .= "+". $key2 . ': ' . $value2 . "\n";
		foreach($value2 as $key3 => $value3) {
			$raw_rdap_data .= "++" . $key3 . ': ' . $value3 . "\n";
			foreach($value3 as $key4 => $value4) {
				$raw_rdap_data .= "+++" . $key4 . ': ' . $value4 . "\n";
				if ($value4 == 'registrant')	{
					$entity_registrant = $key2;
				}
				elseif ($value4 == 'administrative')	{
					$entity_administrative = $key2;
				}
				elseif ($value4 == 'technical')	{
					$entity_technical = $key2;
				}
				elseif ($value4 == 'billing')	{
					$entity_billing = $key2;
				}
				elseif ($value4 == 'reseller')	{
					$entity_reseller = $key2;
				}
				elseif ($value4 == 'registrar')	{
					$entity_registrar = $key2;
				}
				elseif ($value4 == 'sponsor')	{
					$entity_sponsor = $key2;
				}
				foreach($value4 as $key5 => $value5) {
					$raw_rdap_data .= "++++" . $key5 . ': ' . $value5 . "\n";
					foreach($value5 as $key6 => $value6) {
						$raw_rdap_data .= "+++++" . $key6 . ': ' . $value6 . "\n";
						if ($value6 == 'registrant')	{
							$entity_key4_registrant = $key4;
						}
						elseif ($value6 == 'administrative')	{
							$entity_key4_administrative = $key4;
						}
						elseif ($value6 == 'technical')	{
							$entity_key4_tech = $key4;
						}
						elseif ($value6 == 'billing')	{
							$entity_key4_billing = $key4;
						}						
						elseif ($value6 == 'reseller')	{
							$entity_key4_reseller = $key4;
						}
						elseif ($value6 == 'registrar')	{
							$entity_key4_registrar = $key4;
						}
						elseif ($value6 == 'sponsor')	{
							$entity_key4_sponsor = $key4;
						}
						elseif ($value6 == 'abuse')	{
							$entity_key4_registrar_abuse = $key4;
						}
						foreach($value6 as $key7 => $value7) {
							$raw_rdap_data .= "++++++" . $key7 . ': ' . $value7 . "\n";
							foreach($value7 as $key8 => $value8) {
								$raw_rdap_data .= "+++++++" . $key8 . ': ' . $value8 . "\n";
								foreach($value8 as $key9 => $value9) {
									$raw_rdap_data .= "++++++++" . $key9 . ': ' . $value9 . "\n";	
								}
							}
						}	
					}	
				}
			}
		}
	}
}
$raw_rdap_data = nl2br(htmlspecialchars($raw_rdap_data));	
$raw_rdap_data = str_replace(' Array','', $raw_rdap_data);
foreach($obj as $key1 => $value1) {
	if ($key1 == 'extensions')	{	
		$extensions .= (is_array($value1)) ? implode(",<br />", $value1) : $value1;
	}
	foreach($value1 as $key2 => $value2) {
		if ($key1 == 'status')	{
			$rdap_version = 'RDAPv1';
			if (str_starts_with($value2, 'server'))	{
				$server_statuses .= $value2 . ",";
			}
			elseif (str_starts_with($value2, 'client'))	{
				$client_statuses .= $value2 . ",";
			}
			elseif (str_starts_with($value2, 'pending'))	{
				$lifecycle_phase .= $value2 . ",";
			}
			elseif (str_contains($value2, 'redemption'))	{
				$lifecycle_phase .= $value2 . ",";
			}			
			else	{
				$indeterminate_statuses .= $value2 . ",";
			}
		}
		if ($key1 == 'secureDNS')	{
			if ($key2 == 'delegationSigned') {
				if ($value2 === true)	{
					$nameservers_dnssec_signed .= 'Yes'."<br />";
				}	
				elseif ($value2 === false)	{
					$nameservers_dnssec_signed .= 'No'."<br />";
				}
				else	{
					$nameservers_dnssec_signed .= 'Not Applicable'."<br />";					
				}	
			}
		}
		if ($key1 == 'redacted')	{
			$redacted .= $key2;
			$redacted .= (!empty($value2['name']['description'])) ? ": name: " . $value2['name']['description'] : '';
			$redacted .= (!empty($value2['name']['type'])) ? ": type: " . $value2['name']['type'] : '';
			$redacted .= (!empty($value2['method'])) ? ": method: " . $value2['method'] : '';
			$redacted .= (!empty($value2['reason']['description'])) ? ": reason: " . $value2['reason']['description'] : '';
			$redacted .= "<br />";
		}
		foreach($value2 as $key3 => $value3) {
			if ($key1 == 'notices')	{
				if (!is_array($value3))	{
					$notices .= $key2.': '.$key3.': '.$value3."<br />";		
				}
			}				
			if ($key1 == 'links')	{
				$links .= $key2.': '.$key3.': '.$value3."<br />";
				if ($key3 == 'rel' and $value3 == 'self') {
					$self_json_response_uri = $value2['href'];
				}
				elseif ($key3 == 'rel' and $value3 == 'related') {
					$related_json_response_uri = $value2['href'];
				}				
			}	
			if ($key1 == 'remarks')	{
				if (strlen($remarks))	{
					$remarks .= "<br />";				
				}
				$remarks .= interprete_remark($key3, $value3);
			}			
			if ($key1 == 'events')	{
				if ($key3 == 'eventAction' and $value3 == 'registration')	{
					$created_at = $value2['eventDate'];
				}
				elseif ($key3 == 'eventAction' and $value3 == 'transfer')	{
					$latest_registrar_transfer_at = $value2['eventDate'];
				}
				elseif ($key3 == 'eventAction' and $value3 == 'last changed')	{
					$latest_data_mutation_at = $value2['eventDate'];
				}				
				elseif ($key3 == 'eventAction' and $value3 == 'expiration')	{
					$expiration_at = $value2['eventDate'];
				}
				elseif ($key3 == 'eventAction' and $value3 == 'deletion')	{
					$deletion_at = $value2['eventDate'];
				}
				elseif ($key3 == 'eventAction' and $value3 == 'last update of RDAP database')	{
					$resource_upload_at = $value2['eventDate'];				
				}
					
			}			
			if ($key1 == 'entities')	{
				if ($key3 == 'handle')	{
					if ($key2 == $entity_sponsor)	{
						$sponsor_handle = $value3;
					}
					if ($key2 == $entity_registrant)	{
						$registrant_handle = $value3;
					}				
					if ($key2 == $entity_administrative)	{
						$administrative_handle = $value3;
					}
					if ($key2 == $entity_technical)	{
						$technical_handle = $value3;
					}
					if ($key2 == $entity_reseller)	{
						$reseller_handle = $value3;
					}
					if ($key2 == $entity_registrar)	{
						$registrar_handle = $value3;
					}	
				}
				if ($key3 == 'status')	{
					if ($key2 == $entity_registrant)	{
						$registrant_statuses_raw .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
						//$registrant_statuses_raw .= $key1.'#'.$value1.'#'.$key2.'#'.$value2.'#'.$key3.'#'.$value3.'#'.$key4.'#'.$value4;
					}
					if ($key2 == $entity_reseller)	{
						$reseller_statuses_raw .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
					}
					if ($key2 == $entity_registrar)	{
						$registrar_statuses_raw .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
					}
					if ($key2 == $entity_sponsor)	{
						$sponsor_statuses_raw .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
					}
				}
			}	
			if ($key1 == 'nameservers')	{
				if ($key3 == 'handle') {
					$nameservers_handles .= $key2.': '.$value3."<br />";
				}
				elseif ($key3 == 'ldhName') {
					$nameservers_ascii .= $key2.': '.$value3."<br />";
					$dns_state = 'dns_delegated';
				}
				elseif ($key3 == 'unicodeName')	{
					$nameservers_unicode .= $key2.': '.$value3."<br />";
					$dns_state = 'dns_delegated';
				}
				elseif ($key3 == 'status')	{
					$nameservers_statuses_raw .= $key2.': '.$value3[0]."<br />";	
				}
			}
			if ($key1 == 'secureDNS')	{
				if ($key2 == 'dsData') {
					$nameservers_dnssec_key_tag .= $key3.': '.$value3['keyTag'].",";	
					$nameservers_dnssec_algorithm .= $key3.': '.$value3['algorithm'].",";	
					$nameservers_dnssec_digest_type .= $key3.': '.$value3['digestType'].",";	
					$nameservers_dnssec_digest .= $key3.': '.$value3['digest'].",";
				}				
			}
			foreach($value3 as $key4 => $value4) {
				if ($key1 == 'notices')	{
					if (!is_array($value4))	{
						$notices .= $key2.': '.$key3.': '.$key4.': '.$value4."<br />";				
					}
				}	
				if ($key1 == 'entities')	{
					if ($key3 == 'properties')	{
						if ($key2 == $entity_registrant)	{
							$registrant_properties = $key4 . ":<br />" . (is_array($value4)) ? implode(",<br />", $value4) : $value4;
						}
						if ($key2 == $entity_administrative)	{
							$administrative_properties = $key4 . ":<br />" . (is_array($value4)) ? implode(",<br />", $value4) : $value4;
						}
						if ($key2 == $entity_technical)	{
							$technical_properties = $key4 . ":<br />" . (is_array($value4)) ? implode(",<br />", $value4) : $value4;
						}
						if ($key2 == $entity_billing)	{
							$billing_properties = $key4 . ":<br />" . (is_array($value4)) ? implode(",<br />", $value4) : $value4;
						}							
						if ($key2 == $entity_reseller)	{
							$reseller_properties = $key4 . ":<br />" . (is_array($value4)) ? implode(",<br />", $value4) : $value4;
						}
						if ($key2 == $entity_registrar)	{
							$registrar_properties = $key4 . ":<br />" . (is_array($value4)) ? implode(",<br />", $value4) : $value4;
						}
						if ($key2 == $entity_sponsor)	{
							$sponsor_properties = $key4 . ":<br />" . (is_array($value4)) ? implode(",<br />", $value4) : $value4;
						}	
					}
					if ($key2 == $entity_registrar and $key3 == 'publicIds')	{
						$registrar_accreditation .= $value4['type'].': '.$value4['identifier']."<br />";
						$registrar_identifier = $value4['identifier'];
					}					
				}
				foreach($value4 as $key5 => $value5) {
					if ($key1 == 'notices')	{
						if (!is_array($value5))	{
							$notices .= $key2.': '.$key3.': '.$key4.': '.$key5.': '.$value5."<br />";
						}	
						if ($key3 == 'links')	{
							if ($key5 == 'href' and str_contains($value5, 'icann.org/wicf')) $registrar_complaint_uri = $value5; 
							if ($key5 == 'href' and str_contains($value5, 'icann.org/epp')) $status_explanation_uri = $value5;
						}
					}
					if ($key1 == 'entities')	{
						if ($key2 == $entity_registrant and $key3 == 'events')	{
							if ($key5 == 'eventAction' and $value5 == 'registration')	{
								$registrant_created_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'transfer')	{
								$registrant_latest_transfer_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last changed')	{
								$registrant_latest_data_mutation_at = $value4['eventDate'];
							}				
							elseif ($key5 == 'eventAction' and $value5 == 'expiration')	{
								$registrant_expiration_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'deletion')	{
								$registrant_deletion_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last update of RDAP database')	{
								$registrant_resource_upload_at = $value4['eventDate'];				
							}
						}
						if ($key2 == $entity_reseller and $key3 == 'events')	{
							if ($key5 == 'eventAction' and $value5 == 'registration')	{
								$reseller_created_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'transfer')	{
								$reseller_latest_transfer_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last changed')	{
								$reseller_latest_data_mutation_at = $value4['eventDate'];
							}				
							elseif ($key5 == 'eventAction' and $value5 == 'expiration')	{
								$reseller_expiration_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'deletion')	{
								$reseller_deletion_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last update of RDAP database')	{
								$reseller_resource_upload_at = $value4['eventDate'];				
							}
						}				
						if ($key2 == $entity_registrar and $key3 == 'events')	{
							if ($key5 == 'eventAction' and $value5 == 'registration')	{
								$registrar_created_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'transfer')	{
								$registrar_latest_transfer_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last changed')	{
								$registrar_latest_data_mutation_at = $value4['eventDate'];
							}				
							elseif ($key5 == 'eventAction' and $value5 == 'expiration')	{
								$registrar_expiration_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'deletion')	{
								$registrar_deletion_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last update of RDAP database')	{
								$registrar_resource_upload_at = $value4['eventDate'];				
							}
						}
						if ($key2 == $entity_sponsor and $key3 == 'events')	{
							if ($key5 == 'eventAction' and $value5 == 'registration')	{
								$sponsor_created_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'transfer')	{
								$sponsor_latest_transfer_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last changed')	{
								$sponsor_latest_data_mutation_at = $value4['eventDate'];
							}				
							elseif ($key5 == 'eventAction' and $value5 == 'expiration')	{
								$sponsor_expiration_at = $valu4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'deletion')	{
								$sponsor_deletion_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last update of RDAP database')	{
								$sponsor_resource_upload_at = $value4['eventDate'];				
							}
						}
						if ($key2 == $entity_sponsor and $key3 == 'remarks')	{
							if (strlen($sponsor_remarks))	{
								$sponsor_remarks .= "<br />";				
							}
            				$sponsor_remarks .= interprete_remark($key5, $value5);
						}
						if ($key2 == $entity_registrant and $key3 == 'remarks')	{
							if (strlen($registrant_remarks))	{
								$registrant_remarks .= "<br />";				
							}
		        			$registrant_remarks .= interprete_remark($key5, $value5);
						}
						if ($key2 == $entity_administrative and $key3 == 'remarks')	{
							if (strlen($administrative_remarks))	{
								$administrative_remarks .= "<br />";				
							}
		        			$administrative_remarks .= interprete_remark($key5, $value5);
						}
						if ($key2 == $entity_technical and $key3 == 'remarks')	{
							if (strlen($technical_remarks))	{
								$technical_remarks .= "<br />";				
							}
		        			$technical_remarks .= interprete_remark($key5, $value5);
						}
						if ($key2 == $entity_billing and $key3 == 'remarks')	{
							if (strlen($billing_remarks))	{
								$billing_remarks .= "<br />";				
							}
		        			$billing_remarks .= interprete_remark($key5, $value5);
						}
						if ($key2 == $entity_reseller and $key3 == 'remarks')	{
							if (strlen($reseller_remarks))	{
								$reseller_remarks .= "<br />";				
							}
		        			$reseller_remarks .= interprete_remark($key5, $value5);
						}
						if ($key2 == $entity_registrar and $key3 == 'remarks')	{
							if (strlen($registrar_remarks))	{
								$registrar_remarks .= "<br />";				
							}
							$registrar_remarks .= interprete_remark($key5, $value5);	
						}
						if ($key2 == $entity_sponsor and $key3 == 'links')	{
							$sponsor_links .= $key4.': '.$key5.': '.$value5."<br />";
						}
						if ($key2 == $entity_registrant and $key3 == 'links')	{
							$registrant_links .= $key4.': '.$key5.': '.$value5."<br />";
						}
						if ($key2 == $entity_administrative and $key3 == 'links')	{
							$administrative_links .= $key4.': '.$key5.': '.$value5."<br />";
						}
						if ($key2 == $entity_technical and $key3 == 'links')	{
							$technical_links .= $key4.': '.$key5.': '.$value5."<br />";
						}
						if ($key2 == $entity_billing and $key3 == 'links')	{
							$billing_links .= $key4.': '.$key5.': '.$value5."<br />";
						}
						if ($key2 == $entity_reseller and $key3 == 'links')	{
							$reseller_links .= $key4.': '.$key5.': '.$value5."<br />";
						}
						if ($key2 == $entity_registrar and $key3 == 'links')	{
							$registrar_links .= $key4.': '.$key5.': '.$value5."<br />";
						}
					}		
					if ($key1 == 'nameservers')	{							
						if ($key3 == 'events')	{
							if ($key4 == 0)	{	
								if ($key5 == 'eventAction' and $value5 == 'delegation check')	{
									$nameservers_delegation_check .= $key2.': '.$value4['eventDate']."<br />";
								}
							}	
							elseif ($key4 == 1)	{	
								if ($key5 == 'eventAction' and $value5 == 'last correct delegation check')	{
									$nameservers_latest_correct_delegation_check .= $key2.': '.$value4['eventDate']."<br />";
								}
							}					
						
						}
						if ($key3 == 'ipAddresses') {
							if ($key4 == 'v4') {
								$nameservers_ipv4 .= $key2.': '.$value5."<br />";
								$dns_state = 'dns_delegated';
							}
							elseif ($key4 == 'v6') {
								$nameservers_ipv6 .= $key2.': '.$value5."<br />";
								$dns_state = 'dns_delegated';
							}
						}					
					}
					foreach($value5 as $key6 => $value6) {
						if ($key1 == 'notices')	{
							if (!is_array($value6))	{
								$notices .= $key2.': '.$key3.': '.$key4.': '.$key5.': '.$key6.': '.$value6."<br />";
							}
						}	
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'email' and $value6 == 'email')	{
							if ($key2 == $entity_sponsor)	{
								$sponsor_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}							
							if ($key2 == $entity_registrant)	{
								$registrant_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}
							if ($key2 == $entity_administrative)	{
								$administrative_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}
							if ($key2 == $entity_technical)	{
								$technical_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}
							if ($key2 == $entity_billing)	{
								$billing_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}							
							if ($key2 == $entity_reseller)	{
								$reseller_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}
							if ($key2 == $entity_registrar)	{
								$registrar_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'contact-uri' and $value6 == 'uri')	{
							if ($key2 == $entity_sponsor)	{
								$sponsor_contact_uri .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}
							if ($key2 == $entity_registrant)	{
								$registrant_contact_uri .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}
							if ($key2 == $entity_administrative)	{
								$administrative_contact_uri .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}
							if ($key2 == $entity_technical)	{
								$technical_contact_uri .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}
							if ($key2 == $entity_billing)	{
								$billing_contact_uri .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}							
							if ($key2 == $entity_reseller)	{
								$reseller_contact_uri .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}
							if ($key2 == $entity_registrar)	{
								$registrar_contact_uri .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
							}
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'tel' and $value6 == 'tel')	{
							$typeresult = '';
							if (is_array($value5[1]))	{ 
								foreach($value5[1] as $typekey => $typevalue)	{
									if (is_array($typevalue))	{ 
										foreach($typevalue as $typekey2 => $typevalue2)	{											
											$typeresult .= $typevalue2 . ' ';												
										}
									}
									else	{
										$typeresult .= $typevalue . ' ';
									}
								}	
							}
							else	{
								$typeresult .= $value5[1] . ' ';								
							}
							if ($key2 == $entity_registrant)	{
								$registrant_phone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}
							if ($key2 == $entity_administrative)	{
								$administrative_phone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}
							if ($key2 == $entity_technical)	{
								$technical_phone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}
							if ($key2 == $entity_billing)	{
								$billing_phone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}							
							if ($key2 == $entity_reseller)	{
								$reseller_phone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}
							if ($key2 == $entity_registrar)	{
								$registrar_phone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_phone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}	
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'fn' and $value6 == 'fn')	{
							if ($key2 == $entity_registrant)	{
								$registrant_presented_name = $value5[3];
							}
							if ($key2 == $entity_administrative)	{
								$administrative_presented_name = $value5[3];
							}
							if ($key2 == $entity_technical)	{
								$technical_presented_name = $value5[3];
							}
							if ($key2 == $entity_billing)	{
								$billing_presented_name = $value5[3];
							}							
							if ($key2 == $entity_reseller)	{
								$reseller_presented_name = $value5[3];
							}
							if ($key2 == $entity_registrar)	{
								$registrar_presented_name = $value5[3];
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_presented_name = $value5[3];
							}	
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'n' and $value6 == 'n')	{
							if ($key2 == $entity_registrant)	{
								$registrant_name = $value5[3][0];	
								if (strlen($value5[3][1]))	{
									$registrant_name .= ', '. $value5[3][1];
								}
							}
							if ($key2 == $entity_administrative)	{
								$administrative_name = $value5[3][0];	
								if (strlen($value5[3][1]))	{
									$administrative_name .= ', '. $value5[3][1];
								}
							}
							if ($key2 == $entity_technical)	{
								$technical_name = $value5[3][0];	
								if (strlen($value5[3][1]))	{
									$technical_name .= ', '. $value5[3][1];
								}
							}
							if ($key2 == $entity_billing)	{
								$billing_name = $value5[3][0];	
								if (strlen($value5[3][1]))	{
									$billing_name .= ', '. $value5[3][1];
								}
							}							
							if ($key2 == $entity_reseller)	{
								$reseller_name = $value5[3][0];	
								if (strlen($value5[3][1]))	{
									$reseller_name .= ', '. $value5[3][1];
								}
							}
							if ($key2 == $entity_registrar)	{
								$registrar_name = $value5[3][0];	
								if (strlen($value5[3][1]))	{
									$registrar_name .= ', '. $value5[3][1];
								}
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_name = $value5[3][0];	
								if (strlen($value5[3][1]))	{
									$sponsor_name .= ', '. $value5[3][1];
								}
							}
						}	
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'kind' and $value6 == 'kind')	{
							if ($key2 == $entity_registrant)	{
								$registrant_kind = $value5[3];
							}
							if ($key2 == $entity_administrative)	{
								$administrative_kind = $value5[3];
							}
							if ($key2 == $entity_technical)	{
								$technical_kind = $value5[3];
							}
							if ($key2 == $entity_billing)	{
								$biiling_kind = $value5[3];
							}							
							if ($key2 == $entity_reseller)	{
								$reseller_kind = $value5[3];
							}
							if ($key2 == $entity_registrar)	{
								$registrar_kind = $value5[3];
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_kind = $value5[3];
							}							
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'org' and $value6 == 'org')	{
							if ($key2 == $entity_registrant)	{
								$registrant_organization_type = (is_array($value5[1]['type'])) ? implode(",<br />",$value5[1]['type']) : $value5[1]['type'];
								$registrant_organization_name = $value5[3];
							}
							if ($key2 == $entity_administrative)	{
								$administrative_organization_type = (is_array($value5[1]['type'])) ? implode(",<br />",$value5[1]['type']) : $value5[1]['type'];
								$administrative_organization_name = $value5[3];
							}
							if ($key2 == $entity_technical)	{
								$technical_organization_type = (is_array($value5[1]['type'])) ? implode(",<br />",$value5[1]['type']) : $value5[1]['type'];
								$technical_organization_name = $value5[3];
							}
							if ($key2 == $entity_billing)	{
								$billing_organization_type = (is_array($value5[1]['type'])) ? implode(",<br />",$value5[1]['type']) : $value5[1]['type'];
								$billing_organization_name = $value5[3];
							}							
							if ($key2 == $entity_reseller)	{
								$reseller_organization_type = (is_array($value5[1]['type'])) ? implode(",<br />",$value5[1]['type']) : $value5[1]['type'];
								$reseller_organization_name = $value5[3];
							}
							if ($key2 == $entity_registrar)	{
								$registrar_organization_type = (is_array($value5[1]['type'])) ? implode(",<br />",$value5[1]['type']) : $value5[1]['type'];
								$registrar_organization_name = $value5[3];
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_organization_type = (is_array($value5[1]['type'])) ? implode(",<br />",$value5[1]['type']) : $value5[1]['type'];
								$sponsor_organization_name = $value5[3];
							}
						}						
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'lang')	{
							if ($key2 == $entity_registrant)	{
								if ($value6['pref'] == 1)	$registrant_language_pref_1 = $value5[3];
								if ($value6['pref'] == 2)	$registrant_language_pref_2 = $value5[3];
							}
							if ($key2 == $entity_administrative)	{
								if ($value6['pref'] == 1)	$administrative_language_pref_1 = $value5[3];
								if ($value6['pref'] == 2)	$administrative_language_pref_2 = $value5[3];
							}
							if ($ky2 == $entity_technical)	{
								if ($value6['pref'] == 1)	$technical_language_pref_1 = $value5[3];
								if ($value6['pref'] == 2)	$technical_language_pref_2 = $value5[3];
							}
							if ($key2 == $entity_billing) 		{
								if ($value6['pref'] == 1)	$billing_language_pref_1 = $value5[3];
								if ($value6['pref'] == 2)	$billing_language_pref_2 = $value5[3];
							}							
							if ($key2 == $entity_reseller)	{
								if ($value6['pref'] == 1)	$reseller_language_pref_1 = $value5[3];
								if ($value6['pref'] == 2)	$reseller_language_pref_2 = $value5[3];
							}
							if ($key2 == $entity_registrar) 		{
								if ($value6['pref'] == 1)	$registrar_language_pref_1 = $value5[3];
								if ($value6['pref'] == 2)	$registrar_language_pref_2 = $value5[3];
							}
							if ($key2 == $entity_sponsor) 		{
								if ($value6['pref'] == 1)	$sponsor_language_pref_1 = $value5[3];
								if ($value6['pref'] == 2)	$sponsor_language_pref_2 = $value5[3];
							}
						}						
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'adr' and $key6 == 1)	{
							if ($key2 == $entity_registrant)	{
								$registrant_country_code = detect_country_code($registrant_country_code, $value6['CC'], $value6['cc']);
							}
							if ($key2 == $entity_administrative)	{
								$administrative_country_code = detect_country_code($administrative_country_code, $value6['CC'], $value6['cc']);
							}	
							if ($key2 == $entity_technical)	{
								$technical_country_code = detect_country_code($technical_country_code, $value6['CC'], $value6['cc']);
							}
							if ($key2 == $entity_billing)	{
								$billing_country_code = detect_country_code($billing_country_code, $value6['CC'], $value6['cc']);
							}
							if ($key2 == $entity_reseller)	{
								$reseller_country_code = detect_country_code($reseller_country_code, $value6['CC'], $value6['cc']);
							}
							if ($key2 == $entity_registrar)	{
								$registrar_country_code = detect_country_code($registrar_country_code, $value6['CC'], $value6['cc']);
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_country_code = detect_country_code($sponsor_country_code, $value6['CC'], $value6['cc']);
							}
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'adr' and $key6 == 3)	{
							if ($key2 == $entity_registrant)	{
								$registrant_street_address = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$registrant_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$registrant_state_or_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$registrant_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$registrant_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];
							}
							if ($key2 == $entity_administrative)	{
								$administrative_street_address = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$administrative_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$administrative_state_or_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$administrative_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$administrative_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];
							}	
							if ($key2 == $entity_technical)	{
								$technical_street_address = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$technical_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$technical_state_or_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$technical_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$technical_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];
							}
							if ($key2 == $entity_billing)	{
								$billing_street_address = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$billing_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$billing_state_or_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$billing_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$billing_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];
							}
							if ($key2 == $entity_reseller)	{
								$reseller_street_address = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$reseller_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$reseller_state_or_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$reseller_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$reseller_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];
							}
							if ($key2 == $entity_registrar)	{
								$registrar_street_address = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$registrar_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$registrar_state_or_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$registrar_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$registrar_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];	
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_street_address = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$sponsor_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$sponsor_state_or_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$sponsor_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$sponsor_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];
							}
						}
						foreach($value6 as $key7 => $value7)	{
							foreach($value7 as $key8 => $value8) {
								if ($key1 == 'entities' and $key2 == $entity_registrar and $key3 == 'entities' 
									and $key4 == $entity_key4_registrar_abuse and $key5 == 'vcardArray' and $key6 == 1)	{
									if ($value7[0] == 'handle' and $value8 == 'handle')	{
										$registrar_abuse_handle = $value7[3];
									}
									elseif ($value7[0] == 'org' and $value8 == 'org')	{
										$registrar_abuse_organization_type = $value7[1]['type'];
										$registrar_abuse_organization_name = $value7[3];
									}
									elseif ($value7[0] == 'fn' and $value8 == 'fn')	{
										$registrar_abuse_presented_name = $value7[3];
									}
									elseif ($value7[0] == 'kind' and $value8 == 'kind')	{
										$registrar_abuse_kind = $value7[3];
									}	
									elseif ($value7[0] == 'email' and $value8 == 'email')	{
										$registrar_abuse_email = $value7[3];
									}
									elseif ($value7[0] == 'contact-uri' and $value8 == 'uri')	{
										$registrar_abuse_contact_uri = $value7[3];
									}
									elseif ($value7[0] == 'tel' and $value8 == 'tel')	{
										$typeresult = '';
										if (is_array($value7[1]))	{ 
											foreach($value7[1] as $typekey => $typevalue)	{
												if (is_array($typevalue))	{ 
													foreach($typevalue as $typekey2 => $typevalue2)	{											
														$typeresult .= $typevalue2 . ' ';												
													}
												}
												else	{
													$typeresult .= $typevalue . ' ';
												}
											}	
										}
										else	{
											$typeresult .= $value7[1] . ' ';								
										}						
										$registrar_abuse_phone .= $typeresult . $value7[2] . ' ' . $value7[3]."<br />";
									}
									elseif ($value7[0] == 'adr' and $key8 == 1)	{
										$registrar_abuse_country_code = detect_country_code($registrar_abuse_country_code, $value8['CC'], $value8['cc']);				
									}							
								}
								//echo 'k4: '.$key4. ' v4: '.$value4.' k5: '.$key5.' v5: '.$value5.' k6: '.$key6.' v6: '.$value6.' k7: '.$key7.' value73: '.$value7[3]."<br />";
								if ($key1 == 'entities' and $key5 == 'vcardArray' and $value7[0] == 'email' and $value8 == 'email')	{					
									if ($key4 == $entity_key4_registrant)	{
										$registrant_email .= $value7[3]."<br />";
									}
									if ($key4 == $entity_key4_administrative)	{
										$administrative_email .= $value7[3]."<br />";
									}
									if ($key4 == $entity_key4_tech)	{
										$technical_email .= $value7[3]."<br />";
									}
									if ($key4 == $entity_key4_reseller)	{
										$reseller_email .= $value7[3]."<br />";
									}
									if ($key4 == $entity_key4_registrar)	{
										$registrar_email .= $value7[3]."<br />";
									}
									if ($key4 == $entity_key4_sponsor)	{
										$sponsor_email .= $value7[3]."<br />";
									}							
								}
								if ($key1 == 'entities' and $key5 == 'vcardArray' and $value7[0] == 'tel' and $value8 == 'tel')	{
									if ($key4 == $entity_key4_registrant)	{
										$registrant_phone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . "<br />";
									}
									if ($key4 == $entity_key4_administrative)	{
										$administrative_phone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . "<br />";
									}
									if ($key4 == $entity_key4_tech)	{
										$technical_phone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . "<br />";
									}	
									if ($key4 == $entity_key4_reseller)	{
										$reseller_phone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . "<br />";
									}
									if ($key4 == $entity_key4_registrar)	{
										$registrar_phone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . "<br />";
									}
									if ($key4 == $entity_key4_sponsor)	{
										$sponsor_phone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . "<br />";
									}							
								}
							}	
						}	
					}					
				}
			}
		}
	}
}	

if ($inputbatch)	{
	$raw_rdap_data = '';
}
	
$arr['notices'] = $notices;
$arr['links'] = $links;
$arr['redacted'] = $redacted;
	
$arr['metadata']['zone_identifier'] = $zone_identifier;	
$arr['metadata']['object_type'] = $object_type;
$arr['metadata']['rdap_version'] = $rdap_version;
$arr['metadata']['rdap_conformance'] = $rdap_conformance;
$arr['metadata']['tld_information_uri'] = $tld_information_uri;
$arr['metadata']['registry_json_response_uri'] = $url;
$arr['metadata']['registry_response_model'] = $registry_response_model;	
$arr['metadata']['registry_language_codes'] = $language_codes;	
$arr['metadata']['registrar_accreditation'] = $registrar_accreditation;		
$arr['metadata']['registrar_identifier'] = $registrar_identifier;
$arr['metadata']['url_json_response_uri'] = $url;
$arr['metadata']['self_json_response_uri'] = $self_json_response_uri;
$arr['metadata']['related_json_response_uri'] = $related_json_response_uri;
$arr['metadata']['registrar_complaint_uri'] = $registrar_complaint_uri;
$arr['metadata']['status_explanation_uri'] = $status_explanation_uri;
$arr['metadata']['geo_location'] = '';
$arr['metadata']['resource_upload_at'] = $resource_upload_at;		
	
$arr['properties']['server_handle'] = $server_handle;
$arr['properties']['client_handle'] = $client_handle;
$arr['properties']['ascii_name'] = $ascii_name;	
$arr['properties']['unicode_name'] = $unicode_name;
$arr['properties']['statuses_raw'] = rtrim($indeterminate_statuses . $server_statuses . $client_statuses . $lifecycle_phase, ",");
$arr['properties']['policy_statuses'] = rtrim($server_statuses . $client_statuses, ",");
$arr['properties']['dns_state'] = $dns_state;
$arr['properties']['created_at'] = $created_at;	
$arr['properties']['latest_registrar_transfer_at'] = $latest_registrar_transfer_at;
$arr['properties']['latest_data_mutation_at'] = $latest_data_mutation_at;
$arr['properties']['expiration_at'] = $expiration_at;
$arr['properties']['lifecycle_phase'] = rtrim($lifecycle_phase, ",");
$arr['properties']['deletion_at'] = $deletion_at;
$arr['properties']['extensions'] = $extensions;
$arr['properties']['remarks'] = $remarks;			
	
$arr['sponsor']['client_handle'] = $sponsor_handle;
$arr['sponsor']['web_id'] = $sponsor_web_id;		
$arr['sponsor']['organization_type'] = $sponsor_organization_type;	
$arr['sponsor']['organization_name'] = $sponsor_organization_name;	
$arr['sponsor']['presented_name'] = $sponsor_presented_name;	
$arr['sponsor']['kind'] = $sponsor_kind;	
$arr['sponsor']['name'] = $sponsor_name;		
$arr['sponsor']['email'] = $sponsor_email;	
$arr['sponsor']['phone'] = $sponsor_phone;
$arr['sponsor']['country_code'] = $sponsor_country_code;		
$arr['sponsor']['street_address'] = $sponsor_street_address;
$arr['sponsor']['city'] = $sponsor_city;
$arr['sponsor']['state_or_province'] = $sponsor_state_or_province;
$arr['sponsor']['postal_code'] = $sponsor_postal_code;
$arr['sponsor']['country_name'] = $sponsor_country_name;	
$arr['sponsor']['language_pref_1'] = $sponsor_language_pref_1;	
$arr['sponsor']['language_pref_2'] = $sponsor_language_pref_2;
$arr['sponsor']['statuses_raw'] = $sponsor_statuses_raw;
$arr['sponsor']['created_at'] = $sponsor_created_at;
$arr['sponsor']['latest_data_mutation_at'] = $sponsor_latest_data_mutation_at;
$arr['sponsor']['properties'] = $sponsor_properties;
$arr['sponsor']['remarks'] = $sponsor_remarks;
$arr['sponsor']['links'] = $sponsor_links;	
	
$arr['registrant']['client_handle'] = $registrant_handle;
$arr['registrant']['web_id'] = $registrant_web_id;		
$arr['registrant']['organization_type'] = $registrant_organization_type;	
$arr['registrant']['organization_name'] = $registrant_organization_name;	
$arr['registrant']['presented_name'] = $registrant_presented_name;	
$arr['registrant']['kind'] = $registrant_kind;	
$arr['registrant']['name'] = $registrant_name;		
$arr['registrant']['email'] = $registrant_email;
$arr['registrant']['contact_uri'] = $registrant_contact_uri;
$arr['registrant']['phone'] = $registrant_phone;
$arr['registrant']['country_code'] = $registrant_country_code;		
$arr['registrant']['street_address'] = $registrant_street_address;
$arr['registrant']['city'] = $registrant_city;
$arr['registrant']['state_or_province'] = $registrant_state_or_province;
$arr['registrant']['postal_code'] = $registrant_postal_code;
$arr['registrant']['country_name'] = $registrant_country_name;	
$arr['registrant']['language_pref_1'] = $registrant_language_pref_1;	
$arr['registrant']['language_pref_2'] = $registrant_language_pref_2;
$arr['registrant']['statuses_raw'] = $registrant_statuses_raw;
$arr['registrant']['created_at'] = $registrant_created_at;
$arr['registrant']['latest_data_mutation_at'] = $registrant_latest_data_mutation_at;
$arr['registrant']['properties'] = $registrant_properties;
$arr['registrant']['remarks'] = $registrant_remarks;
$arr['registrant']['links'] = $registrant_links;	
	
$arr['administrative']['client_handle'] = $administrative_handle;
$arr['administrative']['web_id'] = $administrative_web_id;		
$arr['administrative']['organization_type'] = $administrative_organization_type;	
$arr['administrative']['organization_name'] = $administrative_organization_name;	
$arr['administrative']['presented_name'] = $administrative_presented_name;	
$arr['administrative']['kind'] = $administrative_kind;	
$arr['administrative']['name'] = $administrative_name;		
$arr['administrative']['email'] = $administrative_email;
$arr['administrative']['contact_uri'] = $administrative_contact_uri;	
$arr['administrative']['phone'] = $administrative_phone;
$arr['administrative']['country_code'] = $administrative_country_code;		
$arr['administrative']['street_address'] = $administrative_street_address;
$arr['administrative']['city'] = $administrative_city;
$arr['administrative']['state_or_province'] = $administrative_state_or_province;
$arr['administrative']['postal_code'] = $administrative_postal_code;
$arr['administrative']['country_name'] = $administrative_country_name;	
$arr['administrative']['language_pref_1'] = $administrative_language_pref_1;	
$arr['administrative']['language_pref_2'] = $administrative_language_pref_2;
$arr['administrative']['statuses_raw'] = $administrative_statuses_raw;
$arr['administrative']['created_at'] = $administrative_created_at;
$arr['administrative']['latest_data_mutation_at'] = $administrative_latest_data_mutation_at;
$arr['administrative']['properties'] = $administrative_properties;
$arr['administrative']['remarks'] = $administrative_remarks;
$arr['administrative']['links'] = $administrative_links;

$arr['technical']['client_handle'] = $technical_handle;
$arr['technical']['web_id'] = $technical_web_id;		
$arr['technical']['organization_type'] = $technical_organization_type;	
$arr['technical']['organization_name'] = $technical_organization_name;	
$arr['technical']['presented_name'] = $technical_presented_name;	
$arr['technical']['kind'] = $technical_kind;	
$arr['technical']['name'] = $technical_name;		
$arr['technical']['email'] = $technical_email;
$arr['technical']['contact_uri'] = $technical_contact_uri;	
$arr['technical']['phone'] = $technical_phone;
$arr['technical']['country_code'] = $technical_country_code;		
$arr['technical']['street_address'] = $technical_street_address;
$arr['technical']['city'] = $technical_city;
$arr['technical']['state_or_province'] = $technical_state_or_province;
$arr['technical']['postal_code'] = $technical_postal_code;
$arr['technical']['country_name'] = $technical_country_name;	
$arr['technical']['language_pref_1'] = $technical_language_pref_1;	
$arr['technical']['language_pref_2'] = $technical_language_pref_2;
$arr['technical']['statuses_raw'] = $technical_statuses_raw;
$arr['technical']['created_at'] = $technical_created_at;
$arr['technical']['latest_data_mutation_at'] = $technical_latest_data_mutation_at;
$arr['technical']['properties'] = $technical_properties;
$arr['technical']['remarks'] = $technical_remarks;
$arr['technical']['links'] = $technical_links;	
	
$arr['billing']['client_handle'] = $billing_handle;
$arr['billing']['web_id'] = $billing_web_id;		
$arr['billing']['organization_type'] = $billing_organization_type;	
$arr['billing']['organization_name'] = $billing_organization_name;	
$arr['billing']['presented_name'] = $billing_presented_name;	
$arr['billing']['kind'] = $billing_kind;	
$arr['billing']['name'] = $billing_name;		
$arr['billing']['email'] = $billing_email;
$arr['billing']['contact_uri'] = $billing_contact_uri;	
$arr['billing']['phone'] = $billing_phone;
$arr['billing']['country_code'] = $billing_country_code;		
$arr['billing']['street_address'] = $billing_street_address;
$arr['billing']['city'] = $billing_city;
$arr['billing']['state_or_province'] = $billing_state_or_province;
$arr['billing']['postal_code'] = $billing_postal_code;
$arr['billing']['country_name'] = $billing_country_name;	
$arr['billing']['language_pref_1'] = $billing_language_pref_1;	
$arr['billing']['language_pref_2'] = $billing_language_pref_2;
$arr['billing']['statuses_raw'] = $billing_statuses_raw;
$arr['billing']['created_at'] = $billing_created_at;
$arr['billing']['latest_data_mutation_at'] = $billing_latest_data_mutation_at;
$arr['billing']['properties'] = $billing_properties;
$arr['billing']['remarks'] = $billing_remarks;
$arr['billing']['links'] = $billing_links;	

$arr['reseller']['client_handle'] = $reseller_handle;
$arr['reseller']['web_id'] = $reseller_web_id;		
$arr['reseller']['organization_type'] = $reseller_organization_type;	
$arr['reseller']['organization_name'] = $reseller_organization_name;	
$arr['reseller']['presented_name'] = $reseller_presented_name;	
$arr['reseller']['kind'] = $reseller_kind;	
$arr['reseller']['name'] = $reseller_name;		
$arr['reseller']['email'] = $reseller_email;
$arr['reseller']['contact_uri'] = $reseller_contact_uri;	
$arr['reseller']['phone'] = $reseller_phone;
$arr['reseller']['country_code'] = $reseller_country_code;		
$arr['reseller']['street_address'] = $reseller_street_address;
$arr['reseller']['city'] = $reseller_city;
$arr['reseller']['state_or_province'] = $reseller_state_or_province;
$arr['reseller']['postal_code'] = $reseller_postal_code;
$arr['reseller']['country_name'] = $reseller_country_name;	
$arr['reseller']['language_pref_1'] = $reseller_language_pref_1;	
$arr['reseller']['language_pref_2'] = $reseller_language_pref_2;
$arr['reseller']['statuses_raw'] = $reseller_statuses_raw;
$arr['reseller']['created_at'] = $reseller_created_at;
$arr['reseller']['latest_data_mutation_at'] = $reseller_latest_data_mutation_at;
$arr['reseller']['properties'] = $reseller_properties;
$arr['reseller']['remarks'] = $reseller_remarks;
$arr['reseller']['links'] = $reseller_links;	

$arr['registrar']['client_handle'] = $registrar_handle;
$arr['registrar']['web_id'] = $registrar_web_id;		
$arr['registrar']['organization_type'] = $registrar_organization_type;	
$arr['registrar']['organization_name'] = $registrar_organization_name;	
$arr['registrar']['presented_name'] = $registrar_presented_name;	
$arr['registrar']['kind'] = $registrar_kind;
$arr['registrar']['name'] = $registrar_name;		
$arr['registrar']['email'] = $registrar_email;
$arr['registrar']['contact_uri'] = $registrar_contact_uri;	
$arr['registrar']['phone'] = $registrar_phone;
$arr['registrar']['country_code'] = $registrar_country_code;		
$arr['registrar']['street_address'] = $registrar_street_address;
$arr['registrar']['city'] = $registrar_city;
$arr['registrar']['state_or_province'] = $registrar_state_or_province;
$arr['registrar']['postal_code'] = $registrar_postal_code;
$arr['registrar']['country_name'] = $registrar_country_name;	
$arr['registrar']['language_pref_1'] = $registrar_language_pref_1;	
$arr['registrar']['language_pref_2'] = $registrar_language_pref_2;
$arr['registrar']['statuses_raw'] = $registrar_statuses_raw;
$arr['registrar']['created_at'] = $registrar_created_at;
$arr['registrar']['latest_data_mutation_at'] = $registrar_latest_data_mutation_at;
$arr['registrar']['properties'] = $registrar_properties;
$arr['registrar']['remarks'] = $registrar_remarks;
$arr['registrar']['links'] = $registrar_links;	
	
$arr['registrar_abuse']['client_handle'] = $registrar_abuse_handle;
$arr['registrar_abuse']['organization_type'] = $registrar_abuse_organization_type;
$arr['registrar_abuse']['organization_name'] = $registrar_abuse_organization_name;	
$arr['registrar_abuse']['presented_name'] = $registrar_abuse_presented_name;
$arr['registrar_abuse']['kind'] = $registrar_abuse_kind;
$arr['registrar_abuse']['email'] = $registrar_abuse_email;
$arr['registrar_abuse']['contact_uri'] = $registrar_abuse_contact_uri;	
$arr['registrar_abuse']['phone'] = $registrar_abuse_phone;
$arr['registrar_abuse']['country_code'] = $registrar_abuse_country_code;
	
$arr['nameservers']['client_handles'] = $nameservers_handles;
$arr['nameservers']['ascii_names'] = $nameservers_ascii;
$arr['nameservers']['unicode_names'] = $nameservers_unicode;	
$arr['nameservers']['ipv4_addresses'] = $nameservers_ipv4;	
$arr['nameservers']['ipv6_addresses'] = $nameservers_ipv6;	
$arr['nameservers']['statuses_raw'] = $nameservers_statuses_raw;	
$arr['nameservers']['delegation_checks'] = $nameservers_delegation_check;
$arr['nameservers']['latest_correct_delegation_checks'] = $nameservers_latest_correct_delegation_check;	
$arr['nameservers']['dnssec_signed'] = $nameservers_dnssec_signed;
$arr['nameservers']['dnssec_key_tag'] = rtrim($nameservers_dnssec_key_tag, ",");
$arr['nameservers']['dnssec_algorithm'] = rtrim($nameservers_dnssec_algorithm, ",");
$arr['nameservers']['dnssec_digest_type'] = rtrim($nameservers_dnssec_digest_type, ",");
$arr['nameservers']['dnssec_digest'] = rtrim($nameservers_dnssec_digest, ",");
	
$arr['raw_rdap'] = $raw_rdap_data;

return $arr;
}
}?>