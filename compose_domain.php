<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//$_GET['domain'] = 'hostingtool.nl';
//$_GET['domain'] = 'cyberfusion.nl';
//$_GET['domain'] = 'münchen.de';
//$_GET['domain'] = 'example.tel';
//$_GET['domain'] = 'ledigheid.nl';
//$_GET['domain'] = 'rdap.org';
//$_GET['domain'] = 'france.fr';
//$_GET['domain'] = 'domaincontrolregister.org';
//$_GET['domain'] = 'prezero.nl';
//$_GET['domain'] = 'prezerotest.nl';
//$_GET['domain'] = 'openprovider.com';
//$_GET['domain'] = 'icann.org';

if (!empty($_GET['domain']))	{
	if (strlen($_GET['domain']))	{
		$domain = $_GET['domain'];
		$batch = false;
		if (isset($_GET['batch']) && trim($_GET['batch']) === '1') {
		    $batch = true;
		}
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
		echo json_encode(write_file($domain, $batch), JSON_PRETTY_PRINT);
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


function write_file($inputdomain, $inputbatch)	{
	
$arr = array();
$arr[$inputdomain]['http_error'] = "";	
$strpos = mb_strpos($inputdomain, '.');
if ($strpos !== false)	{
	$zone_identifier = mb_substr($inputdomain, mb_strrpos($inputdomain, '.') + 1);
}
else	{
	$arr[$inputdomain]['metadata']['zone_identifier'] = 'tld';
	return $arr;
}
$time_start = microtime(true);	
$url = '';	
switch ($zone_identifier) {
	case 'nl':
   		$url = 'https://rdap.sidn.nl/';
   		break;		
	//case 'cc': // transparencia.cc
   	//	$url = 'https://rdap.godaddy.com/v1/';
   	//	break;
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
	//case 'it':
	//	$url = 'https://rdap.pubtest.nic.it/';
   	//	break;
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
	$arr[$inputdomain]['http_error'] = $zone_identifier . " - Operational RDAP unknown";
	return $arr;
}	
$url .= 'domain/'.$inputdomain;
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
  $arr[$inputdomain]['http_error'] = [
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
	$arr[$inputdomain]['http_error'] = "No HTTP status line at $start_utc_iso UTC in " . round($elapsed_seconds, 2) . " sec from $server_seen";
  	return $arr;
}
if ($http_code === 429) {
	$arr[$inputdomain]['http_error'] = "429 - Rate limit exceeded at $start_utc_iso UTC in " . round($elapsed_seconds, 2) . " sec from $server_seen";
	return $arr;
}
if ($http_code !== 200) {
	$arr[$inputdomain]['http_error'] = $http_code . " - Insufficient HTTP response at $start_utc_iso UTC in " . round($elapsed_seconds, 2) . " sec from $server_seen";
	return $arr;
}
try {
  	$obj = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
}
catch (JsonException $e) {
	$arr[$inputdomain]['http_error'] = "200 - JSON decode exception: " . $e->getMessage() . " at $start_utc_iso UTC in " . round($elapsed_seconds, 2) . " sec from $server_seen";
	return $arr;
}
if (!is_array($obj)) {
	$arr[$inputdomain]['http_error'] = "200 - Invalid JSON structure at $start_utc_iso UTC in " . round($elapsed_seconds, 2) . " sec from $server_seen";
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
if (!strlen($language_codes))	{
	$language_codes = '(not provided)';	
}	
$registrar_accreditation = '';
$registrar_json_response_uri = '';	
$registrar_complaint_uri = '';	
$status_explanation_uri = '';
$registrant_web_id = '';
if ($zone_identifier == 'nl' or $zone_identifier == 'frl')	{		
	$registrant_web_id = 'NL88COMM01234567890123456789012345';	
}
$domain_dns_statuses = '';
$domain_lifecycle_statuses = '';	
$domain_client_statuses = '';
$created_at = null;
$latest_transfer_at = null;			
$latest_change_at = null;
$expiration_at = null;	
$deletion_at = null;	
$extensions = '';
$remarks = '';
$registrant_statuses = '';
$registrant_created_at = null;
$registrant_latest_transfer_at = null;	
$registrant_latest_change_at = null;
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
$reseller_statuses = '';
$reseller_created_at = null;
$reseller_latest_transfer_at = null;	
$reseller_latest_change_at = null;
$reseller_expiration_at = null;	
$reseller_deletion_at = null;
$reseller_properties = '(not tested yet)';	
$reseller_remarks = '';		
$registrar_statuses = '';	
$registrar_created_at = null;
$registrar_latest_transfer_at = null;	
$registrar_latest_change_at = null;
$registrar_expiration_at = null;	
$registrar_deletion_at = null;		
$registrar_properties = '(not tested yet)';	
$registrar_remarks = '';
$sponsor_statuses = '';
$sponsor_created_at = null;
$sponsor_latest_transfer_at = null;	
$sponsor_latest_change_at = null;
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
$nameservers_statuses = '';
$nameservers_delegation_check = '';
$nameservers_latest_correct_delegation_check = '';
$dns_delegation = '0';	
	
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
			if (str_starts_with($value2, 'client'))	{
				$domain_client_statuses .= $value2 . ",";
			}
			elseif (str_starts_with($value2, 'pending'))	{
				$domain_lifecycle_statuses .= $value2 . ",";
			}
			elseif (str_contains($value2, 'redemption'))	{
				$domain_lifecycle_statuses .= $value2 . ",";
			}			
			else	{
				$domain_dns_statuses .= $value2 . ",";
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
				if ($key3 == 'rel' and $value3 == 'related') {
					$registrar_json_response_uri = $value2['href'];
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
					$latest_transfer_at = $value2['eventDate'];
				}
				elseif ($key3 == 'eventAction' and $value3 == 'last changed')	{
					$latest_change_at = $value2['eventDate'];
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
						$registrant_statuses .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
						//$registrant_statuses .= $key1.'#'.$value1.'#'.$key2.'#'.$value2.'#'.$key3.'#'.$value3.'#'.$key4.'#'.$value4;
					}
					if ($key2 == $entity_reseller)	{
						$reseller_statuses .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
					}
					if ($key2 == $entity_registrar)	{
						$registrar_statuses .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
					}
					if ($key2 == $entity_sponsor)	{
						$sponsor_statuses .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
					}
				}
			}	
			if ($key1 == 'nameservers')	{
				if ($key3 == 'handle') {
					$nameservers_handles .= $key2.': '.$value3."<br />";
				}
				elseif ($key3 == 'ldhName') {
					$nameservers_ascii .= $key2.': '.$value3."<br />";
					$dns_delegation = '1';
				}
				elseif ($key3 == 'unicodeName')	{
					$nameservers_unicode .= $key2.': '.$value3."<br />";
					$dns_delegation = '1';
				}
				elseif ($key3 == 'status')	{
					$nameservers_statuses .= $key2.': '.$value3[0]."<br />";	
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
								$registrant_latest_change_at = $value4['eventDate'];
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
								$reseller_latest_change_at = $value4['eventDate'];
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
								$registrar_latest_change_at = $value4['eventDate'];
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
								$sponsor_latest_change_at = $value4['eventDate'];
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
								$dns_delegation = '1';
							}
							elseif ($key4 == 'v6') {
								$nameservers_ipv6 .= $key2.': '.$value5."<br />";
								$dns_delegation = '1';
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
else	{
	$registrar_rdap_registration_time = null;
	$registrar_rdap_transfer_time = null;
	$registrar_rdap_change_time = null;
	$registrar_rdap_registrant_organization_name = '';
	$registrar_rdap_registrant_presented_name = '';
	$registrar_rdap_registrant_email = '';
	$registrar_rdap_registrant_email_uri = '';
	$registrar_rdap_registrant_contact_uri = '';
	$entity_registrant_key = null;
	if (strlen($registrar_json_response_uri))	{
		$options = [
  			"http" => [
    		"method" => "GET",
    		"ignore_errors" => true,
    		"timeout" => 8,
    		"header" => "User-Agent: MyRDAPClient/1.0\r\nAccept: application/json\r\n",
  			]
		];
		$context = stream_context_create($options);
		$fp2 = @fopen($registrar_json_response_uri, 'r', false, $context);
		//$fp2 = fopen($registrar_json_response_uri, 'r', false, $context);
		if ($fp2) {
			$registrar_response = stream_get_contents($fp2);
			fclose($fp2);
			try {
 		 		$obj2 = json_decode($registrar_response, true, 512, JSON_THROW_ON_ERROR);
			}
			catch (JsonException $e) {
				$obj2 = null;
			}		
			if (is_array($obj2)) {	
				if (!empty($obj2['events']) && is_array($obj2['events'])) {
			    	foreach ($obj2['events'] as $event) {
						if (($event['eventAction'] ?? null) === 'registration') {
            				$registrar_rdap_registration_time = $event['eventDate'] ?? null;
						}
						if (($event['eventAction'] ?? null) === 'transfer') {
            				$registrar_rdap_transfer_time = $event['eventDate'] ?? null;
						}
        				if (($event['eventAction'] ?? null) === 'last changed') {
            				$registrar_rdap_change_time = $event['eventDate'] ?? null;
						}	
        			}
				}
			}
			if (is_array($obj2) && !empty($obj2['entities']) && is_array($obj2['entities'])) {
			    foreach ($obj2['entities'] as $idx => $entity) {
    			    $roles = $entity['roles'] ?? [];
					if (is_array($roles) && in_array('registrant', $roles, true)) {
            			$entity_registrant_key = $idx;
			   			break;
        			}
    			}
			}	
			if ($entity_registrant_key !== null) {
				$entity = $obj2['entities'][$entity_registrant_key];
        		if (!empty($entity['vcardArray']) && is_array($entity['vcardArray']) && isset($entity['vcardArray'][1]) && is_array($entity['vcardArray'][1])) {
            		foreach ($entity['vcardArray'][1] as $prop) {
						if (is_array($prop) && ($prop[0] ?? null) === 'org') {
    						$raw = $prop[3] ?? '';
    						$candidates = is_array($raw) ? $raw : [$raw];
    						foreach ($candidates as $candidate) {
        						$candidate = trim((string)$candidate);
        						if ($candidate === '') {
            						continue;
        						}
        						$registrar_rdap_registrant_organization_name .= ($registrar_rdap_registrant_organization_name ? ",<br />" : "") . $candidate;
								continue;
							}
						}
						if (is_array($prop) && ($prop[0] ?? null) === 'fn') {
    						$raw = $prop[3] ?? '';
    						$candidates = is_array($raw) ? $raw : [$raw];
    						foreach ($candidates as $candidate) {
        						$candidate = trim((string)$candidate);
        						if ($candidate === '') {
            						continue;
        						}
        						$registrar_rdap_registrant_presented_name .= ($registrar_rdap_registrant_presented_name ? ",<br />" : "") . $candidate;
								continue;
							}
						}						
						if (is_array($prop) && ($prop[0] ?? null) === 'email') {
    						$raw = $prop[3] ?? '';
    						$candidates = is_array($raw) ? $raw : [$raw];
    						foreach ($candidates as $candidate) {
        						$candidate = trim((string)$candidate);
        						if ($candidate === '') {
            						continue;
        						}
        						if (filter_var($candidate, FILTER_VALIDATE_EMAIL)) {
            						$registrar_rdap_registrant_email .= ($registrar_rdap_registrant_email ? ",<br />" : "") . $candidate;
            						continue;
        						}
        						if (preg_match('~^https?://~i', $candidate)) {
            						$registrar_rdap_registrant_email_uri = $candidate;
        						}
							}
						}	
						if (is_array($prop) && ($prop[0] ?? null) === 'contact_uri') {
    						$raw = $prop[3] ?? '';
    						$candidates = is_array($raw) ? $raw : [$raw];
    						foreach ($candidates as $candidate) {
        						$candidate = trim((string)$candidate);
        						if ($candidate === '') {
            						continue;
        						}
        						$registrar_rdap_registrant_contact_uri .= ($registrar_rdap_registrant_contact_uri ? ",<br />" : "") . $candidate;
								continue;
							}
						}
    				}
				}
    		}
		}			
	}
}
$arr[$inputdomain]['notices'] = $notices;
$arr[$inputdomain]['links'] = $links;
$arr[$inputdomain]['redacted'] = $redacted;
	
$arr[$inputdomain]['registrar_rdap_registration_time'] = $registrar_rdap_registration_time;	
$arr[$inputdomain]['registrar_rdap_transfer_time'] = $registrar_rdap_transfer_time;
$arr[$inputdomain]['registrar_rdap_change_time'] = $registrar_rdap_change_time;
$arr[$inputdomain]['registrar_rdap_registrant_organization_name'] = $registrar_rdap_registrant_organization_name;
$arr[$inputdomain]['registrar_rdap_registrant_presented_name'] = $registrar_rdap_registrant_presented_name;
$arr[$inputdomain]['registrar_rdap_registrant_email'] = $registrar_rdap_registrant_email;
$arr[$inputdomain]['registrar_rdap_registrant_email_uri'] = $registrar_rdap_registrant_email_uri;
$arr[$inputdomain]['registrar_rdap_registrant_contact_uri'] = $registrar_rdap_registrant_contact_uri;

$arr[$inputdomain]['metadata']['zone_identifier'] = $zone_identifier;	
$arr[$inputdomain]['metadata']['object_type'] = $object_type;
$arr[$inputdomain]['metadata']['rdap_version'] = $rdap_version;
$arr[$inputdomain]['metadata']['rdap_conformance'] = $rdap_conformance;
$arr[$inputdomain]['metadata']['tld_information_uri'] = $tld_information_uri;
$arr[$inputdomain]['metadata']['registry_json_response_uri'] = $url;
$arr[$inputdomain]['metadata']['registry_language_codes'] = $language_codes;	
$arr[$inputdomain]['metadata']['registrar_accreditation'] = $registrar_accreditation;		
$arr[$inputdomain]['metadata']['registrar_json_response_uri'] = $registrar_json_response_uri;
$arr[$inputdomain]['metadata']['registrar_complaint_uri'] = $registrar_complaint_uri;
$arr[$inputdomain]['metadata']['status_explanation_uri'] = $status_explanation_uri;
$arr[$inputdomain]['metadata']['geo_location'] = '';
$arr[$inputdomain]['metadata']['resource_upload_at'] = $resource_upload_at;		
	
$arr[$inputdomain]['properties']['server_handle'] = $server_handle;
$arr[$inputdomain]['properties']['client_handle'] = $client_handle;
$arr[$inputdomain]['properties']['ascii_name'] = $ascii_name;	
$arr[$inputdomain]['properties']['unicode_name'] = $unicode_name;
$arr[$inputdomain]['properties']['statuses'] = rtrim($domain_dns_statuses . $domain_client_statuses . $domain_lifecycle_statuses, ",");
$arr[$inputdomain]['properties']['created_at'] = $created_at;	
$arr[$inputdomain]['properties']['latest_transfer_at'] = $latest_transfer_at;
$arr[$inputdomain]['properties']['latest_change_at'] = $latest_change_at;
$arr[$inputdomain]['properties']['expiration_at'] = $expiration_at;
$arr[$inputdomain]['properties']['deletion_at'] = $deletion_at;
$arr[$inputdomain]['properties']['extensions'] = $extensions;
$arr[$inputdomain]['properties']['remarks'] = $remarks;			
	
$arr[$inputdomain]['sponsor']['client_handle'] = $sponsor_handle;
$arr[$inputdomain]['sponsor']['web_id'] = $sponsor_web_id;		
$arr[$inputdomain]['sponsor']['organization_type'] = $sponsor_organization_type;	
$arr[$inputdomain]['sponsor']['organization_name'] = $sponsor_organization_name;	
$arr[$inputdomain]['sponsor']['presented_name'] = $sponsor_presented_name;	
$arr[$inputdomain]['sponsor']['kind'] = $sponsor_kind;	
$arr[$inputdomain]['sponsor']['name'] = $sponsor_name;		
$arr[$inputdomain]['sponsor']['email'] = $sponsor_email;	
$arr[$inputdomain]['sponsor']['phone'] = $sponsor_phone;
$arr[$inputdomain]['sponsor']['country_code'] = $sponsor_country_code;		
$arr[$inputdomain]['sponsor']['street_address'] = $sponsor_street_address;
$arr[$inputdomain]['sponsor']['city'] = $sponsor_city;
$arr[$inputdomain]['sponsor']['state_or_province'] = $sponsor_state_or_province;
$arr[$inputdomain]['sponsor']['postal_code'] = $sponsor_postal_code;
$arr[$inputdomain]['sponsor']['country_name'] = $sponsor_country_name;	
$arr[$inputdomain]['sponsor']['language_pref_1'] = $sponsor_language_pref_1;	
$arr[$inputdomain]['sponsor']['language_pref_2'] = $sponsor_language_pref_2;
$arr[$inputdomain]['sponsor']['statuses'] = $sponsor_statuses;
$arr[$inputdomain]['sponsor']['created_at'] = $sponsor_created_at;
$arr[$inputdomain]['sponsor']['latest_change_at'] = $sponsor_latest_change_at;
$arr[$inputdomain]['sponsor']['properties'] = $sponsor_properties;
$arr[$inputdomain]['sponsor']['remarks'] = $sponsor_remarks;
$arr[$inputdomain]['sponsor']['links'] = $sponsor_links;	
	
$arr[$inputdomain]['registrant']['client_handle'] = $registrant_handle;
$arr[$inputdomain]['registrant']['web_id'] = $registrant_web_id;		
$arr[$inputdomain]['registrant']['organization_type'] = $registrant_organization_type;	
$arr[$inputdomain]['registrant']['organization_name'] = $registrant_organization_name;	
$arr[$inputdomain]['registrant']['presented_name'] = $registrant_presented_name;	
$arr[$inputdomain]['registrant']['kind'] = $registrant_kind;	
$arr[$inputdomain]['registrant']['name'] = $registrant_name;		
$arr[$inputdomain]['registrant']['email'] = $registrant_email;
$arr[$inputdomain]['registrant']['contact_uri'] = $registrant_contact_uri;
$arr[$inputdomain]['registrant']['phone'] = $registrant_phone;
$arr[$inputdomain]['registrant']['country_code'] = $registrant_country_code;		
$arr[$inputdomain]['registrant']['street_address'] = $registrant_street_address;
$arr[$inputdomain]['registrant']['city'] = $registrant_city;
$arr[$inputdomain]['registrant']['state_or_province'] = $registrant_state_or_province;
$arr[$inputdomain]['registrant']['postal_code'] = $registrant_postal_code;
$arr[$inputdomain]['registrant']['country_name'] = $registrant_country_name;	
$arr[$inputdomain]['registrant']['language_pref_1'] = $registrant_language_pref_1;	
$arr[$inputdomain]['registrant']['language_pref_2'] = $registrant_language_pref_2;
$arr[$inputdomain]['registrant']['statuses'] = $registrant_statuses;
$arr[$inputdomain]['registrant']['created_at'] = $registrant_created_at;
$arr[$inputdomain]['registrant']['latest_change_at'] = $registrant_latest_change_at;
$arr[$inputdomain]['registrant']['properties'] = $registrant_properties;
$arr[$inputdomain]['registrant']['remarks'] = $registrant_remarks;
$arr[$inputdomain]['registrant']['links'] = $registrant_links;	
	
$arr[$inputdomain]['administrative']['client_handle'] = $administrative_handle;
$arr[$inputdomain]['administrative']['web_id'] = $administrative_web_id;		
$arr[$inputdomain]['administrative']['organization_type'] = $administrative_organization_type;	
$arr[$inputdomain]['administrative']['organization_name'] = $administrative_organization_name;	
$arr[$inputdomain]['administrative']['presented_name'] = $administrative_presented_name;	
$arr[$inputdomain]['administrative']['kind'] = $administrative_kind;	
$arr[$inputdomain]['administrative']['name'] = $administrative_name;		
$arr[$inputdomain]['administrative']['email'] = $administrative_email;
$arr[$inputdomain]['administrative']['contact_uri'] = $administrative_contact_uri;	
$arr[$inputdomain]['administrative']['phone'] = $administrative_phone;
$arr[$inputdomain]['administrative']['country_code'] = $administrative_country_code;		
$arr[$inputdomain]['administrative']['street_address'] = $administrative_street_address;
$arr[$inputdomain]['administrative']['city'] = $administrative_city;
$arr[$inputdomain]['administrative']['state_or_province'] = $administrative_state_or_province;
$arr[$inputdomain]['administrative']['postal_code'] = $administrative_postal_code;
$arr[$inputdomain]['administrative']['country_name'] = $administrative_country_name;	
$arr[$inputdomain]['administrative']['language_pref_1'] = $administrative_language_pref_1;	
$arr[$inputdomain]['administrative']['language_pref_2'] = $administrative_language_pref_2;
$arr[$inputdomain]['administrative']['statuses'] = $administrative_statuses;
$arr[$inputdomain]['administrative']['created_at'] = $administrative_created_at;
$arr[$inputdomain]['administrative']['latest_change_at'] = $administrative_latest_change_at;
$arr[$inputdomain]['administrative']['properties'] = $administrative_properties;
$arr[$inputdomain]['administrative']['remarks'] = $administrative_remarks;
$arr[$inputdomain]['administrative']['links'] = $administrative_links;

$arr[$inputdomain]['technical']['client_handle'] = $technical_handle;
$arr[$inputdomain]['technical']['web_id'] = $technical_web_id;		
$arr[$inputdomain]['technical']['organization_type'] = $technical_organization_type;	
$arr[$inputdomain]['technical']['organization_name'] = $technical_organization_name;	
$arr[$inputdomain]['technical']['presented_name'] = $technical_presented_name;	
$arr[$inputdomain]['technical']['kind'] = $technical_kind;	
$arr[$inputdomain]['technical']['name'] = $technical_name;		
$arr[$inputdomain]['technical']['email'] = $technical_email;
$arr[$inputdomain]['technical']['contact_uri'] = $technical_contact_uri;	
$arr[$inputdomain]['technical']['phone'] = $technical_phone;
$arr[$inputdomain]['technical']['country_code'] = $technical_country_code;		
$arr[$inputdomain]['technical']['street_address'] = $technical_street_address;
$arr[$inputdomain]['technical']['city'] = $technical_city;
$arr[$inputdomain]['technical']['state_or_province'] = $technical_state_or_province;
$arr[$inputdomain]['technical']['postal_code'] = $technical_postal_code;
$arr[$inputdomain]['technical']['country_name'] = $technical_country_name;	
$arr[$inputdomain]['technical']['language_pref_1'] = $technical_language_pref_1;	
$arr[$inputdomain]['technical']['language_pref_2'] = $technical_language_pref_2;
$arr[$inputdomain]['technical']['statuses'] = $technical_statuses;
$arr[$inputdomain]['technical']['created_at'] = $technical_created_at;
$arr[$inputdomain]['technical']['latest_change_at'] = $technical_latest_change_at;
$arr[$inputdomain]['technical']['properties'] = $technical_properties;
$arr[$inputdomain]['technical']['remarks'] = $technical_remarks;
$arr[$inputdomain]['technical']['links'] = $technical_links;	
	
$arr[$inputdomain]['billing']['client_handle'] = $billing_handle;
$arr[$inputdomain]['billing']['web_id'] = $billing_web_id;		
$arr[$inputdomain]['billing']['organization_type'] = $billing_organization_type;	
$arr[$inputdomain]['billing']['organization_name'] = $billing_organization_name;	
$arr[$inputdomain]['billing']['presented_name'] = $billing_presented_name;	
$arr[$inputdomain]['billing']['kind'] = $billing_kind;	
$arr[$inputdomain]['billing']['name'] = $billing_name;		
$arr[$inputdomain]['billing']['email'] = $billing_email;
$arr[$inputdomain]['billing']['contact_uri'] = $billing_contact_uri;	
$arr[$inputdomain]['billing']['phone'] = $billing_phone;
$arr[$inputdomain]['billing']['country_code'] = $billing_country_code;		
$arr[$inputdomain]['billing']['street_address'] = $billing_street_address;
$arr[$inputdomain]['billing']['city'] = $billing_city;
$arr[$inputdomain]['billing']['state_or_province'] = $billing_state_or_province;
$arr[$inputdomain]['billing']['postal_code'] = $billing_postal_code;
$arr[$inputdomain]['billing']['country_name'] = $billing_country_name;	
$arr[$inputdomain]['billing']['language_pref_1'] = $billing_language_pref_1;	
$arr[$inputdomain]['billing']['language_pref_2'] = $billing_language_pref_2;
$arr[$inputdomain]['billing']['statuses'] = $billing_statuses;
$arr[$inputdomain]['billing']['created_at'] = $billing_created_at;
$arr[$inputdomain]['billing']['latest_change_at'] = $billing_latest_change_at;
$arr[$inputdomain]['billing']['properties'] = $billing_properties;
$arr[$inputdomain]['billing']['remarks'] = $billing_remarks;
$arr[$inputdomain]['billing']['links'] = $billing_links;	

$arr[$inputdomain]['reseller']['client_handle'] = $reseller_handle;
$arr[$inputdomain]['reseller']['web_id'] = $reseller_web_id;		
$arr[$inputdomain]['reseller']['organization_type'] = $reseller_organization_type;	
$arr[$inputdomain]['reseller']['organization_name'] = $reseller_organization_name;	
$arr[$inputdomain]['reseller']['presented_name'] = $reseller_presented_name;	
$arr[$inputdomain]['reseller']['kind'] = $reseller_kind;	
$arr[$inputdomain]['reseller']['name'] = $reseller_name;		
$arr[$inputdomain]['reseller']['email'] = $reseller_email;
$arr[$inputdomain]['reseller']['contact_uri'] = $reseller_contact_uri;	
$arr[$inputdomain]['reseller']['phone'] = $reseller_phone;
$arr[$inputdomain]['reseller']['country_code'] = $reseller_country_code;		
$arr[$inputdomain]['reseller']['street_address'] = $reseller_street_address;
$arr[$inputdomain]['reseller']['city'] = $reseller_city;
$arr[$inputdomain]['reseller']['state_or_province'] = $reseller_state_or_province;
$arr[$inputdomain]['reseller']['postal_code'] = $reseller_postal_code;
$arr[$inputdomain]['reseller']['country_name'] = $reseller_country_name;	
$arr[$inputdomain]['reseller']['language_pref_1'] = $reseller_language_pref_1;	
$arr[$inputdomain]['reseller']['language_pref_2'] = $reseller_language_pref_2;
$arr[$inputdomain]['reseller']['statuses'] = $reseller_statuses;
$arr[$inputdomain]['reseller']['created_at'] = $reseller_created_at;
$arr[$inputdomain]['reseller']['latest_change_at'] = $reseller_latest_change_at;
$arr[$inputdomain]['reseller']['properties'] = $reseller_properties;
$arr[$inputdomain]['reseller']['remarks'] = $reseller_remarks;
$arr[$inputdomain]['reseller']['links'] = $reseller_links;	

$arr[$inputdomain]['registrar']['client_handle'] = $registrar_handle;
$arr[$inputdomain]['registrar']['web_id'] = $registrar_web_id;		
$arr[$inputdomain]['registrar']['organization_type'] = $registrar_organization_type;	
$arr[$inputdomain]['registrar']['organization_name'] = $registrar_organization_name;	
$arr[$inputdomain]['registrar']['presented_name'] = $registrar_presented_name;	
$arr[$inputdomain]['registrar']['kind'] = $registrar_kind;
$arr[$inputdomain]['registrar']['name'] = $registrar_name;		
$arr[$inputdomain]['registrar']['email'] = $registrar_email;
$arr[$inputdomain]['registrar']['contact_uri'] = $registrar_contact_uri;	
$arr[$inputdomain]['registrar']['phone'] = $registrar_phone;
$arr[$inputdomain]['registrar']['country_code'] = $registrar_country_code;		
$arr[$inputdomain]['registrar']['street_address'] = $registrar_street_address;
$arr[$inputdomain]['registrar']['city'] = $registrar_city;
$arr[$inputdomain]['registrar']['state_or_province'] = $registrar_state_or_province;
$arr[$inputdomain]['registrar']['postal_code'] = $registrar_postal_code;
$arr[$inputdomain]['registrar']['country_name'] = $registrar_country_name;	
$arr[$inputdomain]['registrar']['language_pref_1'] = $registrar_language_pref_1;	
$arr[$inputdomain]['registrar']['language_pref_2'] = $registrar_language_pref_2;
$arr[$inputdomain]['registrar']['statuses'] = $registrar_statuses;
$arr[$inputdomain]['registrar']['created_at'] = $registrar_created_at;
$arr[$inputdomain]['registrar']['latest_change_at'] = $registrar_latest_change_at;
$arr[$inputdomain]['registrar']['properties'] = $registrar_properties;
$arr[$inputdomain]['registrar']['remarks'] = $registrar_remarks;
$arr[$inputdomain]['registrar']['links'] = $registrar_links;	
	
$arr[$inputdomain]['registrar_abuse']['client_handle'] = $registrar_abuse_handle;
$arr[$inputdomain]['registrar_abuse']['organization_type'] = $registrar_abuse_organization_type;
$arr[$inputdomain]['registrar_abuse']['organization_name'] = $registrar_abuse_organization_name;	
$arr[$inputdomain]['registrar_abuse']['presented_name'] = $registrar_abuse_presented_name;
$arr[$inputdomain]['registrar_abuse']['kind'] = $registrar_abuse_kind;
$arr[$inputdomain]['registrar_abuse']['email'] = $registrar_abuse_email;
$arr[$inputdomain]['registrar_abuse']['contact_uri'] = $registrar_abuse_contact_uri;	
$arr[$inputdomain]['registrar_abuse']['phone'] = $registrar_abuse_phone;
$arr[$inputdomain]['registrar_abuse']['country_code'] = $registrar_abuse_country_code;
	
$arr[$inputdomain]['nameservers']['client_handles'] = $nameservers_handles;
$arr[$inputdomain]['nameservers']['ascii_names'] = $nameservers_ascii;
$arr[$inputdomain]['nameservers']['unicode_names'] = $nameservers_unicode;	
$arr[$inputdomain]['nameservers']['ipv4_addresses'] = $nameservers_ipv4;	
$arr[$inputdomain]['nameservers']['ipv6_addresses'] = $nameservers_ipv6;	
$arr[$inputdomain]['nameservers']['statuses'] = $nameservers_statuses;	
$arr[$inputdomain]['nameservers']['delegation_checks'] = $nameservers_delegation_check;
$arr[$inputdomain]['nameservers']['latest_correct_delegation_checks'] = $nameservers_latest_correct_delegation_check;	
$arr[$inputdomain]['nameservers']['dnssec_signed'] = $nameservers_dnssec_signed;
$arr[$inputdomain]['nameservers']['dnssec_key_tag'] = rtrim($nameservers_dnssec_key_tag, ",");
$arr[$inputdomain]['nameservers']['dnssec_algorithm'] = rtrim($nameservers_dnssec_algorithm, ",");
$arr[$inputdomain]['nameservers']['dnssec_digest_type'] = rtrim($nameservers_dnssec_digest_type, ",");
$arr[$inputdomain]['nameservers']['dnssec_digest'] = rtrim($nameservers_dnssec_digest, ",");
$arr[$inputdomain]['nameservers']['dns_delegation'] = $dns_delegation;
	
$arr[$inputdomain]['raw_rdap'] = $raw_rdap_data;

return $arr;
}
?>