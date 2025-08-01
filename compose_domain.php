<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//$_GET['domain'] = 'hostingtool.nl';
//$_GET['domain'] = 'cyberfusion.nl';
//$_GET['domain'] = 'm�nchen.de';
//$_GET['domain'] = 'example.tel';
//$_GET['domain'] = 'ledigheid.nl';
//$_GET['domain'] = 'rdap.org';

if (!empty($_GET['domain']))	{
	if (strlen($_GET['domain']))	{
		$domain = $_GET['domain'];
		$batch = false;
		if (!empty($_GET['batch']))	{
			if (trim($_GET['batch'] == '1'))	{
				$batch = true;
			}
		}
		$domain = mb_strtolower($domain);
		$domain = str_replace('http://','', $domain);
		$domain = str_replace('https://','', $domain);
		if (substr_count($domain, '.') > 1)	{
			$domain = str_replace('www.','', $domain);
		}
		$strpos = mb_strpos($domain, '/');
		if ($strpos)	{
			$domain = mb_substr($domain, 0, $strpos);
		}
		$strpos = mb_strpos($domain, ':');
		if ($strpos)	{
			$domain = mb_substr($domain, 0, $strpos);
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

function write_file($inputdomain, $inputbatch)	{

$arr = array();	
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
$lookup_endpoints_url = 'https://data.iana.org/rdap/dns.json';	
if (!strlen($url))	{
	$rdap = json_decode(file_get_contents($lookup_endpoints_url), true);
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
$url .= 'domain/'.$inputdomain;
$registrar_json_response_url = '';
$options = [
    "http" => [
        "method" => "GET",
        "ignore_errors" => true,
        "header" => "User-Agent: MyRDAPClient/1.0\r\n"
    ]
];
$context = stream_context_create($options);
$time_pass = microtime(true) - $time_start;
if ($time_pass < 1.05) {
    usleep((1.05 - $time_pass) * 1_000_000);
}
$fp = fopen($url, 'r', false, $context);
if ($fp) {
    $response = stream_get_contents($fp);
    fclose($fp);
}
else {
    $response = false;
}
$http_code = null;
if (isset($http_response_header)) {
    if (preg_match('#HTTP/\d+\.\d+\s+(\d+)#', $http_response_header[0], $matches)) {
        $http_code = (int)$matches[1];
    }
}
$arr[$inputdomain]['http_error'] = "";	
if ($http_code === 429) {
	$arr[$inputdomain]['http_error'] = "429 - Rate limit exceeded";
	return $arr;
}
if ($http_code === 200) {
    if (json_last_error() === JSON_ERROR_NONE) {
		$obj = json_decode($response, true);
    }
	else {
		$arr[$inputdomain]['http_error'] = "500 - Invalid JSON from RDAP";
		return $arr;
    }
}
else {
	$arr[$inputdomain]['http_error'] = strval($http_code) . " - Insufficient HTTP response";
	return $arr;
}
$notice_0_title = $obj['notices'][0]['title'];
$notice_0_description_0 = $obj['notices'][0]['description'][0];	
$notice_0_description_1 = $obj['notices'][0]['description'][1];
$notice_0_links_0_href = $obj['notices'][0]['links'][0]['href'];
$notice_0_links_0_type = $obj['notices'][0]['links'][0]['type'];
$notice_1_title = $obj['notices'][1]['title'];
$notice_1_description_0 = $obj['notices'][1]['description'][0];
$notice_1_description_1 = $obj['notices'][1]['description'][1];
$notice_1_links_0_href = $obj['notices'][1]['links'][0]['href'];
$notice_1_links_0_type = $obj['notices'][1]['links'][0]['type'];	
$notice_2_title = $obj['notices'][2]['title'];	
$notice_2_description_0 = $obj['notices'][2]['description'][0];
$notice_2_description_1 = $obj['notices'][2]['description'][1];
$notice_2_links_0_href = $obj['notices'][2]['links'][0]['href'];
$notice_2_links_0_type = $obj['notices'][2]['links'][0]['type'];
$notice_3_title = $obj['notices'][3]['title'];	
$notice_3_description_0 = $obj['notices'][3]['description'][0];
$notice_3_description_1 = $obj['notices'][3]['description'][1];
$notice_3_links_0_href = $obj['notices'][3]['links'][0]['href'];
$notice_3_links_0_type = $obj['notices'][3]['links'][0]['type'];
$links_0_value = $obj['links'][0]['value'];
$links_0_related = $obj['links'][0]['rel'];
$links_0_href = $obj['links'][0]['href'];
$links_0_href_lang = $obj['links'][0]['hreflang'];
$links_0_title = $obj['links'][0]['title'];
$links_0_media = $obj['links'][0]['media'];
$links_0_type = $obj['links'][0]['type'];
	
$links_1_value = $obj['links'][1]['value'];
$links_1_related = $obj['links'][1]['rel'];
$links_1_href = $obj['links'][1]['href'];
$links_1_href_lang_1 = $obj['links'][1]['hreflang'];
$links_1_title = $obj['links'][1]['title'];
$links_1_media = $obj['links'][1]['media'];
$links_1_type = $obj['links'][1]['type'];
	
$links_2_value = $obj['links'][2]['value'];
$links_2_related = $obj['links'][2]['rel'];
$links_2_href = $obj['links'][2]['href'];
$links_2_href_lang = $obj['links'][2]['hreflang'];
$links_2_title = $obj['links'][2]['title'];
$links_2_media = $obj['links'][2]['media'];
$links_2_type = $obj['links'][2]['type'];
	
$links_3_value = $obj['links'][3]['value'];
$links_3_related = $obj['links'][3]['rel'];
$links_3_href = $obj['links'][3]['href'];
$links_3_href_lang_1 = $obj['links'][3]['hreflang'];
$links_3_title = $obj['links'][3]['title'];
$links_3_media = $obj['links'][3]['media'];
$links_3_type = $obj['links'][3]['type'];	

$resource_upload_at = null;
$object_class_name = $obj['objectClassName'];
$object_conformance = (is_array($obj['rdapConformance'])) ? implode(",<br />", $obj['rdapConformance']) : $obj['rdapConformance'];
$language_codes = (is_array($obj['lang'])) ? implode(",<br />", $obj['lang']) : $obj['lang'];
if (!strlen($language_codes))	{
	$language_codes = 'None Specified';	
}	
$registrar_accreditation = '';
$registrar_complaint_url = '';
$flag_explanation_url = '';	
	
if ($notice_0_links_0_href == 'https://icann.org/wicf' or $notice_0_links_0_href == 'https://icann.org/wicf/')	$registrar_complaint_url = $notice_0_links_0_href;
if ($notice_1_links_0_href == 'https://icann.org/wicf' or $notice_1_links_0_href == 'https://icann.org/wicf/')	$registrar_complaint_url = $notice_1_links_0_href;
if ($notice_2_links_0_href == 'https://icann.org/wicf' or $notice_2_links_0_href == 'https://icann.org/wicf/')	$registrar_complaint_url = $notice_2_links_0_href;
if ($notice_3_links_0_href == 'https://icann.org/wicf' or $notice_3_links_0_href == 'https://icann.org/wicf/')	$registrar_complaint_url = $notice_3_links_0_href;
	
if ($notice_0_links_0_href == 'https://icann.org/epp' or $notice_0_links_0_href == 'https://icann.org/epp/')	$flag_explanation_url = $notice_0_links_0_href;
if ($notice_1_links_0_href == 'https://icann.org/epp' or $notice_1_links_0_href == 'https://icann.org/epp/')	$flag_explanation_url = $notice_1_links_0_href;
if ($notice_2_links_0_href == 'https://icann.org/epp' or $notice_2_links_0_href == 'https://icann.org/epp/')	$flag_explanation_url = $notice_2_links_0_href;
if ($notice_3_links_0_href == 'https://icann.org/epp' or $notice_3_links_0_href == 'https://icann.org/epp/')	$flag_explanation_url = $notice_3_links_0_href;

$registrant_web_id = '';
if ($zone_identifier == 'nl' or $zone_identifier == 'frl')	{		
	$registrant_web_id = 'NL88COMM01234567890123456789012345';	
}
$domain_dns_flags = '';
$domain_lifecycle_flags = '';	
$domain_client_flags = '';
$created_at = null;
$latest_transfer_at = null;			
$latest_update_at = null;
$expiration_at = null;	
$deletion_at = null;	
$extensions = '';
$remarks = '';	
$registrant_flags = '';
$registrant_created_at = null;
$registrant_latest_transfer_at = null;	
$registrant_latest_update_at = null;
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
$reseller_flags = '';
$reseller_created_at = null;
$reseller_latest_transfer_at = null;	
$reseller_latest_update_at = null;
$reseller_expiration_at = null;	
$reseller_deletion_at = null;
$reseller_properties = '(not tested yet)';	
$reseller_remarks = '';		
$registrar_flags = '';	
$registrar_created_at = null;
$registrar_latest_transfer_at = null;	
$registrar_latest_update_at = null;
$registrar_expiration_at = null;	
$registrar_deletion_at = null;		
$registrar_properties = '(not tested yet)';	
$registrar_remarks = '';		
$sponsor_flags = '';
$sponsor_created_at = null;
$sponsor_latest_transfer_at = null;	
$sponsor_latest_update_at = null;
$sponsor_expiration_at = null;	
$sponsor_deletion_at = null;
$sponsor_properties = '(not tested yet)';
$sponsor_remarks = '';
$dns_handle	= '';
$client_handle = $obj['handle'];
$ascii_name = $obj['ldhName'];
$unicode_name = $obj['unicodeName'];
$name_servers_dnssec_signed = '';
$name_servers_dnssec_key_tag = '';	
$name_servers_dnssec_algorithm = '';
$name_servers_dnssec_digest_type = '';
$name_servers_dnssec_digest = '';	
$abuse_handle = '';	
$abuse_organization_type = '';
$abuse_organization_name = '';
$abuse_presented_name = '';
$abuse_kind = '';
$abuse_email = 'Abuse contact email unavailable.';
$abuse_telephone = '';
$abuse_country_code = '';
	
$sponsor_handle = '';
$sponsor_organization_type = '';	
$sponsor_organization_name = '';		
$sponsor_presented_name = '';	
$sponsor_kind = '';
$sponsor_name = '';
$sponsor_email = '';
$sponsor_telephone = '';
$sponsor_country_code = '';		
$sponsor_street_address = '';
$sponsor_city = '';
$sponsor_state_or_province = '';	
$sponsor_postal_code = '';
$sponsor_country_name = '';
$registrant_handle = '';
$registrant_organization_type = '';
$registrant_organization_name = '';	
$registrant_presented_name = '';
$registrant_kind = '';
$registrant_name = '';
$registrant_email = '';	
$registrant_telephone = '';
$registrant_country_code = 'None Specified';
$registrant_street_address = '';
$registrant_city = '';
$registrant_state_or_province = '';
$registrant_postal_code = '';
$registrant_country_name = '';	
$registrant_language_pref_1 = '';
$registrant_language_pref_2 = '';	
$administrative_handle = '';
$administrative_organization_type = '';
$administrative_organization_name = '';	
$administrative_presented_name = '';
$administrative_kind = '';
$administrative_name = '';	
$administrative_email = '';
$administrative_telephone = '';
$administrative_country_code = '';	
$administrative_street_address = '';
$administrative_city = '';	
$administrative_state_or_province = '';
$administrative_postal_code = '';	
$administrative_country_name = '';
$administrative_language_pref_1 = '';
$administrative_language_pref_2 = '';	
$technical_handle = '';
$technical_organization_type = '';
$technical_organization_name = '';	
$technical_presented_name = '';
$technical_kind = '';
$technical_name = '';	
$technical_email = '';
$technical_telephone = '';
$technical_country_code = '';	
$technical_street_address = '';
$technical_city = '';	
$technical_state_or_province = '';
$technical_postal_code = '';	
$technical_country_name = '';
$technical_language_pref_1 = '';
$technical_language_pref_2 = '';	
$billing_handle = '';
$billing_organization_type = '';
$billing_organization_name = '';	
$billing_presented_name = '';
$billing_kind = '';
$billing_name = '';		
$billing_email = '';
$billing_telephone = '';
$billing_country_code = '';	
$billing_street_address = '';
$billing_city = '';	
$billing_state_or_province = '';	
$billing_postal_code = '';	
$billing_country_name = '';

$reseller_handle = '';
$reseller_organization_type = '';	
$reseller_organization_name = '';	
$reseller_presented_name = '';	
$reseller_kind = '';	
$reseller_name = '';
$reseller_email = '';
$reseller_telephone = '';
$reseller_country_code = '';	
$reseller_street_address = '';
$reseller_city = '';
$reseller_state_or_province = '';	
$reseller_postal_code = '';
$reseller_country_name = '';	
$reseller_language_pref_1 = '';
$reseller_language_pref_2 = '';	
$registrar_handle = '';
$registrar_organization_type = '';
$registrar_organization_name = '';	
$registrar_presented_name = '';	
$registrar_kind = '';
$registrar_name = '';	
$registrar_email = '';
$registrar_telephone = '';
$registrar_country_code = '';	
$registrar_street_address = '';
$registrar_city = '';
$registrar_state_or_province = '';	
$registrar_postal_code = '';
$registrar_country_name = '';	
$registrar_language_pref_1 = '';
$registrar_language_pref_2 = '';
	
$name_servers_handles = '';
$name_servers_ascii = '';
$name_servers_unicode = '';
$name_servers_ipv4 = '';
$name_servers_ipv6 = '';
$name_servers_flags = '';
$name_servers_delegation_check = '';
$name_servers_latest_correct_delegation_check = '';	
	
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
$entity_key4_abuse = -1;	

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
							$entity_key4_abuse = $key4;
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
			if (str_starts_with($value2, 'client'))	{
				$domain_client_flags .= $value2 . "<br />";
			}
			elseif (str_starts_with($value2, 'pending'))	{
				$domain_lifecycle_flags .= $value2 . "<br />";
			}
			elseif (str_contains($value2, 'redemption'))	{
				$domain_lifecycle_flags .= $value2 . "<br />";
			}			
			else	{
				$domain_dns_flags .= $value2 . "<br />";
			}
		}
		if ($key1 == 'secureDNS')	{
			if ($key2 == 'delegationSigned') {
				if ($value2 === true)	{
					$name_servers_dnssec_signed .= 'Yes'."<br />";
				}	
				elseif ($value2 === false)	{
					$name_servers_dnssec_signed .= 'No'."<br />";
				}
				else	{
					$name_servers_dnssec_signed .= 'Not Applicable'."<br />";					
				}	
			}
		}
		foreach($value2 as $key3 => $value3) {
			if ($key1 == 'remarks')	{
				if (strlen($remarks))	{
					$remarks .= "<br />";				
				}
				if (!is_array($value3))	{
					$remarks .= $key3 . ': ' . $value3;
				}
				else	{
					$remarks .= $value3;
				}				
			}
			if ($key1 == 'events')	{
				if ($key3 == 'eventAction' and $value3 == 'registration')	{
					$created_at = $value2['eventDate'];
				}
				elseif ($key3 == 'eventAction' and $value3 == 'transfer')	{
					$latest_transfer_at = $value2['eventDate'];
				}
				elseif ($key3 == 'eventAction' and $value3 == 'last changed')	{
					$latest_update_at = $value2['eventDate'];
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
						$registrant_flags .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
						//$registrant_flags .= $key1.'#'.$value1.'#'.$key2.'#'.$value2.'#'.$key3.'#'.$value3.'#'.$key4.'#'.$value4;
					}
					if ($key2 == $entity_reseller)	{
						$reseller_flags .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
					}
					if ($key2 == $entity_registrar)	{
						$registrar_flags .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
					}
					if ($key2 == $entity_sponsor)	{
						$sponsor_flags .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
					}
				}
			}	
			if ($key1 == 'nameservers')	{
				if ($key3 == 'handle') {
					$name_servers_handles .= $key2.': '.$value3."<br />";
				}
				elseif ($key3 == 'ldhName') {
					$name_servers_ascii .= $key2.': '.$value3."<br />";
				}
				elseif ($key3 == 'unicodeName')	{
					$name_servers_unicode .= $key2.': '.$value3."<br />";
				}
				elseif ($key3 == 'status')	{
					$name_servers_flags .= $key2.': '.$value3[0]."<br />";	
				}
			}
			if ($key1 == 'secureDNS')	{
				if ($key2 == 'dsData') {
					$name_servers_dnssec_key_tag .= $key3.': '.$value3['keyTag']."<br />";	
					$name_servers_dnssec_algorithm .= $key3.': '.$value3['algorithm']."<br />";	
					$name_servers_dnssec_digest_type .= $key3.': '.$value3['digestType']."<br />";	
					$name_servers_dnssec_digest .= $key3.': '.$value3['digest']."<br />";
				}				
			}
			foreach($value3 as $key4 => $value4) {
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
					if ($key1 == 'entities')	{
						if ($key2 == $entity_registrant and $key3 == 'events')	{
							if ($key5 == 'eventAction' and $value5 == 'registration')	{
								$registrant_created_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'transfer')	{
								$registrant_latest_transfer_at = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last changed')	{
								$registrant_latest_update_at = $value4['eventDate'];
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
								$reseller_latest_update_at = $value4['eventDate'];
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
								$registrar_latest_update_at = $value4['eventDate'];
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
								$sponsor_latest_update_at = $value4['eventDate'];
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
						if ($key2 == $entity_registrant and $key3 == 'remarks')	{
							if (strlen($registrant_remarks))	{
								$registrant_remarks .= "<br />";				
							}
							$registrant_remarks .= (is_array($value5)) ? $key5.': '.$value5 : $value5;	
						}
						if ($key2 == $entity_administrative and $key3 == 'remarks')	{
							if (strlen($administrative_remarks))	{
								$administrative_remarks .= "<br />";				
							}
							$administrative_remarks .= (is_array($value5)) ? $key5.': '.$value5 : $value5;	
						}
						if ($key2 == $entity_technical and $key3 == 'remarks')	{
							if (strlen($technical_remarks))	{
								$technical_remarks .= "<br />";				
							}
							$technical_remarks .= (is_array($value5)) ? $key5.': '.$value5 : $value5;
						}
						if ($key2 == $entity_billing and $key3 == 'remarks')	{
							if (strlen($billing_remarks))	{
								$billing_remarks .= "<br />";				
							}
							$billing_remarks .= (is_array($value5)) ? $key5.': '.$value5 : $value5;	
						}
						if ($key2 == $entity_reseller and $key3 == 'remarks')	{
							if (strlen($reseller_remarks))	{
								$reseller_remarks .= "<br />";				
							}
							$reseller_remarks .= (is_array($value5)) ? $key5.': '.$value5 : $value5;
						}
						if ($key2 == $entity_registrar and $key3 == 'remarks')	{
							if (strlen($registrar_remarks))	{
								$registrar_remarks .= "<br />";				
							}
							$registrar_remarks .= (is_array($value5)) ? $key5.': '.$value5 : $value5;
						}
						if ($key2 == $entity_sponsor and $key3 == 'remarks')	{
							if (strlen($sponsor_remarks))	{
								$sponsor_remarks .= "<br />";				
							}
							$sponsor_remarks .= (is_array($value5)) ? $key5.': '.$value5 : $value5;
						}
					}		
					if ($key1 == 'nameservers')	{							
						if ($key3 == 'events')	{
							if ($key4 == 0)	{	
								if ($key5 == 'eventAction' and $value5 == 'delegation check')	{
									$name_servers_delegation_check .= $key2.': '.$value4['eventDate']."<br />";
								}
							}	
							elseif ($key4 == 1)	{	
								if ($key5 == 'eventAction' and $value5 == 'last correct delegation check')	{
									$name_servers_latest_correct_delegation_check .= $key2.': '.$value4['eventDate']."<br />";
								}
							}					
						
						}
						if ($key3 == 'ipAddresses') {
							if ($key4 == 'v4') {
								$name_servers_ipv4 .= $key2.': '.$value5."<br />";
							}
							elseif ($key4 == 'v6') {
								$name_servers_ipv6 .= $key2.': '.$value5."<br />";
							}
						}					
					}
					foreach($value5 as $key6 => $value6) {
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'email' and $value6 == 'email')	{	
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
							if ($key2 == $entity_sponsor)	{
								$sponsor_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3];
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
								$registrant_telephone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}
							if ($key2 == $entity_administrative)	{
								$administrative_telephone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}
							if ($key2 == $entity_technical)	{
								$technical_telephone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}
							if ($key2 == $entity_billing)	{
								$billing_telephone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}							
							if ($key2 == $entity_reseller)	{
								$reseller_telephone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}
							if ($key2 == $entity_registrar)	{
								$registrar_telephone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_telephone .= $typeresult . $value5[2] . ' ' . $value5[3]."<br />";
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
						if ($key2 == $entity_registrant and $key3 == 'remarks')	{
							$registrant_remarks .= "<br />" . $value6 . ';';		
						}
						if ($key2 == $entity_reseller and $key3 == 'remarks')	{
							$reseller_remarks .= "<br />" . $value6 . ';';	
						}
						if ($key2 == $entity_registrar and $key3 == 'remarks')	{
							$registrar_remarks .= "<br />" . $value6 . ';';	
						}
						if ($key2 == $entity_sponsor and $key3 == 'remarks')	{
							$sponsor_remarks .= "<br />" . $value6 . ';';	
						}
						foreach($value6 as $key7 => $value7)	{
							foreach($value7 as $key8 => $value8) {
								if ($key1 == 'entities' and $key2 == $entity_registrar and $key3 == 'entities' 
									and $key4 == $entity_key4_abuse and $key5 == 'vcardArray' and $key6 == 1)	{
									if ($value7[0] == 'handle' and $value8 == 'handle')	{
										$abuse_handle = $value7[3];
									}
									elseif ($value7[0] == 'org' and $value8 == 'org')	{
										$abuse_organization_type = $value7[1]['type'];
										$abuse_organization_name = $value7[3];
									}
									elseif ($value7[0] == 'fn' and $value8 == 'fn')	{
										$abuse_presented_name = $value7[3];
									}
									elseif ($value7[0] == 'kind' and $value8 == 'kind')	{
										$abuse_kind = $value7[3];
									}	
									elseif ($value7[0] == 'email' and $value8 == 'email')	{
										$abuse_email = $value7[3];
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
										$abuse_telephone .= $typeresult . $value7[2] . ' ' . $value7[3]."<br />";
									}
									elseif ($value7[0] == 'adr' and $key8 == 1)	{
										$abuse_country_code = detect_country_code($abuse_country_code, $value8['CC'], $value8['cc']);				
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
										$registrant_telephone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . "<br />";
									}
									if ($key4 == $entity_key4_administrative)	{
										$administrative_telephone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . "<br />";
									}
									if ($key4 == $entity_key4_tech)	{
										$technical_telephone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . "<br />";
									}	
									if ($key4 == $entity_key4_reseller)	{
										$reseller_telephone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . "<br />";
									}
									if ($key4 == $entity_key4_registrar)	{
										$registrar_telephone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . "<br />";
									}
									if ($key4 == $entity_key4_sponsor)	{
										$sponsor_telephone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . "<br />";
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
	
$arr[$inputdomain]['notices']['notice_0_title'] = $notice_0_title;	
$arr[$inputdomain]['notices']['notice_0_description_0'] = $notice_0_description_0;
$arr[$inputdomain]['notices']['notice_0_description_1'] = $notice_0_description_1;
$arr[$inputdomain]['notices']['notice_0_links_0_href'] = $notice_0_links_0_href;
$arr[$inputdomain]['notices']['notice_0_links_0_type'] = $notice_0_links_0_type;
	
$arr[$inputdomain]['notices']['notice_1_title'] = $notice_1_title;	
$arr[$inputdomain]['notices']['notice_1_description_0'] = $notice_1_description_0;
$arr[$inputdomain]['notices']['notice_1_description_1'] = $notice_1_description_1;
$arr[$inputdomain]['notices']['notice_1_links_0_href'] = $notice_1_links_0_href;
$arr[$inputdomain]['notices']['notice_1_links_0_type'] = $notice_1_links_0_type;
	
$arr[$inputdomain]['notices']['notice_2_title'] = $notice_2_title;	
$arr[$inputdomain]['notices']['notice_2_description_0'] = $notice_2_description_0;
$arr[$inputdomain]['notices']['notice_2_description_1'] = $notice_2_description_1;
$arr[$inputdomain]['notices']['notice_2_links_0_href'] = $notice_2_links_0_href;
$arr[$inputdomain]['notices']['notice_2_links_0_type'] = $notice_2_links_0_type;
	
$arr[$inputdomain]['notices']['notice_3_title'] = $notice_3_title;	
$arr[$inputdomain]['notices']['notice_3_description_0'] = $notice_3_description_0;
$arr[$inputdomain]['notices']['notice_3_description_1'] = $notice_3_description_1;
$arr[$inputdomain]['notices']['notice_3_links_0_href'] = $notice_3_links_0_href;
$arr[$inputdomain]['notices']['notice_3_links_0_type'] = $notice_3_links_0_type;	
	
$arr[$inputdomain]['links']['links_0_value'] = $links_0_value;		
$arr[$inputdomain]['links']['links_0_related'] = $links_0_related;		
$arr[$inputdomain]['links']['links_0_href'] = $links_0_href;		
$arr[$inputdomain]['links']['links_0_href_lang'] = $links_0_href_lang;			
$arr[$inputdomain]['links']['links_0_title'] = $links_0_title;	
$arr[$inputdomain]['links']['links_0_media'] = $links_0_media;	
$arr[$inputdomain]['links']['links_0_type'] = $links_0_type;

$arr[$inputdomain]['links']['links_1_value'] = $links_1_value;		
$arr[$inputdomain]['links']['links_1_related'] = $links_1_related;		
$arr[$inputdomain]['links']['links_1_href'] = $links_1_href;		
$arr[$inputdomain]['links']['links_1_href_lang'] = $links_1_href_lang;			
$arr[$inputdomain]['links']['links_1_title'] = $links_1_title;	
$arr[$inputdomain]['links']['links_1_media'] = $links_1_media;	
$arr[$inputdomain]['links']['links_1_type'] = $links_1_type;
	
$arr[$inputdomain]['links']['links_2_value'] = $links_2_value;		
$arr[$inputdomain]['links']['links_2_related'] = $links_2_related;		
$arr[$inputdomain]['links']['links_2_href'] = $links_2_href;		
$arr[$inputdomain]['links']['links_2_href_lang'] = $links_2_href_lang;			
$arr[$inputdomain]['links']['links_2_title'] = $links_2_title;	
$arr[$inputdomain]['links']['links_2_media'] = $links_2_media;	
$arr[$inputdomain]['links']['links_2_type'] = $links_2_type;
	
$arr[$inputdomain]['links']['links_3_value'] = $links_3_value;		
$arr[$inputdomain]['links']['links_3_related'] = $links_3_related;		
$arr[$inputdomain]['links']['links_3_href'] = $links_3_href;		
$arr[$inputdomain]['links']['links_3_href_lang'] = $links_3_href_lang;			
$arr[$inputdomain]['links']['links_3_title'] = $links_3_title;	
$arr[$inputdomain]['links']['links_3_media'] = $links_3_media;	
$arr[$inputdomain]['links']['links_3_type'] = $links_3_type;
	
$arr[$inputdomain]['metadata']['zone_identifier'] = $zone_identifier;	
$arr[$inputdomain]['metadata']['resource_upload_at'] = $resource_upload_at;	
$arr[$inputdomain]['metadata']['object_class_name'] = $object_class_name;
$arr[$inputdomain]['metadata']['object_conformance'] = $object_conformance;
$arr[$inputdomain]['metadata']['tld_information_url'] = $tld_information_url;
$arr[$inputdomain]['metadata']['registry_json_response_url'] = $url;
$arr[$inputdomain]['metadata']['registry_language_codes'] = $language_codes;	
$arr[$inputdomain]['metadata']['registrar_accreditation'] = $registrar_accreditation;		
$arr[$inputdomain]['metadata']['registrar_json_response_url'] = $registrar_json_response_url;
$arr[$inputdomain]['metadata']['registrar_complaint_url'] = $registrar_complaint_url;		
$arr[$inputdomain]['metadata']['flag_explanation_url'] = $flag_explanation_url;
$arr[$inputdomain]['metadata']['geo_location'] = '';
	
$arr[$inputdomain]['domain']['dns_handle'] = $dns_handle;
$arr[$inputdomain]['domain']['client_handle'] = $client_handle;
$arr[$inputdomain]['domain']['ascii_name'] = $ascii_name;	
$arr[$inputdomain]['domain']['unicode_name'] = $unicode_name;
$arr[$inputdomain]['domain']['flags'] = $domain_dns_flags . $domain_lifecycle_flags . $domain_client_flags;
$arr[$inputdomain]['domain']['created_at'] = $created_at;	
$arr[$inputdomain]['domain']['latest_transfer_at'] = $latest_transfer_at;
$arr[$inputdomain]['domain']['latest_update_at'] = $latest_update_at;
$arr[$inputdomain]['domain']['expiration_at'] = $expiration_at;
$arr[$inputdomain]['domain']['deletion_at'] = $deletion_at;
$arr[$inputdomain]['domain']['extensions'] = $extensions;
$arr[$inputdomain]['domain']['remarks'] = $remarks;			
	
$arr[$inputdomain]['sponsor']['client_handle'] = $sponsor_handle;
$arr[$inputdomain]['sponsor']['web_id'] = $sponsor_web_id;		
$arr[$inputdomain]['sponsor']['organization_type'] = $sponsor_organization_type;	
$arr[$inputdomain]['sponsor']['organization_name'] = $sponsor_organization_name;	
$arr[$inputdomain]['sponsor']['presented_name'] = $sponsor_presented_name;	
$arr[$inputdomain]['sponsor']['kind'] = $sponsor_kind;	
$arr[$inputdomain]['sponsor']['name'] = $sponsor_name;		
$arr[$inputdomain]['sponsor']['email'] = $sponsor_email;	
$arr[$inputdomain]['sponsor']['telephone'] = $sponsor_telephone;
$arr[$inputdomain]['sponsor']['country_code'] = $sponsor_country_code;		
$arr[$inputdomain]['sponsor']['street_address'] = $sponsor_street_address;
$arr[$inputdomain]['sponsor']['city'] = $sponsor_city;
$arr[$inputdomain]['sponsor']['state_or_province'] = $sponsor_state_or_province;
$arr[$inputdomain]['sponsor']['postal_code'] = $sponsor_postal_code;
$arr[$inputdomain]['sponsor']['country_name'] = $sponsor_country_name;	
$arr[$inputdomain]['sponsor']['language_pref_1'] = $sponsor_language_pref_1;	
$arr[$inputdomain]['sponsor']['language_pref_2'] = $sponsor_language_pref_2;
$arr[$inputdomain]['sponsor']['flags'] = $sponsor_flags;
$arr[$inputdomain]['sponsor']['created_at'] = $sponsor_created_at;
$arr[$inputdomain]['sponsor']['latest_update_at'] = $sponsor_latest_update_at;
$arr[$inputdomain]['sponsor']['properties'] = $sponsor_properties;
$arr[$inputdomain]['sponsor']['remarks'] = $sponsor_remarks;
	
$arr[$inputdomain]['registrant']['client_handle'] = $registrant_handle;
$arr[$inputdomain]['registrant']['web_id'] = $registrant_web_id;		
$arr[$inputdomain]['registrant']['organization_type'] = $registrant_organization_type;	
$arr[$inputdomain]['registrant']['organization_name'] = $registrant_organization_name;	
$arr[$inputdomain]['registrant']['presented_name'] = $registrant_presented_name;	
$arr[$inputdomain]['registrant']['kind'] = $registrant_kind;	
$arr[$inputdomain]['registrant']['name'] = $registrant_name;		
$arr[$inputdomain]['registrant']['email'] = $registrant_email;	
$arr[$inputdomain]['registrant']['telephone'] = $registrant_telephone;
$arr[$inputdomain]['registrant']['country_code'] = $registrant_country_code;		
$arr[$inputdomain]['registrant']['street_address'] = $registrant_street_address;
$arr[$inputdomain]['registrant']['city'] = $registrant_city;
$arr[$inputdomain]['registrant']['state_or_province'] = $registrant_state_or_province;
$arr[$inputdomain]['registrant']['postal_code'] = $registrant_postal_code;
$arr[$inputdomain]['registrant']['country_name'] = $registrant_country_name;	
$arr[$inputdomain]['registrant']['language_pref_1'] = $registrant_language_pref_1;	
$arr[$inputdomain]['registrant']['language_pref_2'] = $registrant_language_pref_2;
$arr[$inputdomain]['registrant']['flags'] = $registrant_flags;
$arr[$inputdomain]['registrant']['created_at'] = $registrant_created_at;
$arr[$inputdomain]['registrant']['latest_update_at'] = $registrant_latest_update_at;
$arr[$inputdomain]['registrant']['properties'] = $registrant_properties;
$arr[$inputdomain]['registrant']['remarks'] = $registrant_remarks;	
	
$arr[$inputdomain]['administrative']['client_handle'] = $administrative_handle;
$arr[$inputdomain]['administrative']['web_id'] = $administrative_web_id;		
$arr[$inputdomain]['administrative']['organization_type'] = $administrative_organization_type;	
$arr[$inputdomain]['administrative']['organization_name'] = $administrative_organization_name;	
$arr[$inputdomain]['administrative']['presented_name'] = $administrative_presented_name;	
$arr[$inputdomain]['administrative']['kind'] = $administrative_kind;	
$arr[$inputdomain]['administrative']['name'] = $administrative_name;		
$arr[$inputdomain]['administrative']['email'] = $administrative_email;	
$arr[$inputdomain]['administrative']['telephone'] = $administrative_telephone;
$arr[$inputdomain]['administrative']['country_code'] = $administrative_country_code;		
$arr[$inputdomain]['administrative']['street_address'] = $administrative_street_address;
$arr[$inputdomain]['administrative']['city'] = $administrative_city;
$arr[$inputdomain]['administrative']['state_or_province'] = $administrative_state_or_province;
$arr[$inputdomain]['administrative']['postal_code'] = $administrative_postal_code;
$arr[$inputdomain]['administrative']['country_name'] = $administrative_country_name;	
$arr[$inputdomain]['administrative']['language_pref_1'] = $administrative_language_pref_1;	
$arr[$inputdomain]['administrative']['language_pref_2'] = $administrative_language_pref_2;
$arr[$inputdomain]['administrative']['flags'] = $administrative_flags;
$arr[$inputdomain]['administrative']['created_at'] = $administrative_created_at;
$arr[$inputdomain]['administrative']['latest_update_at'] = $administrative_latest_update_at;
$arr[$inputdomain]['administrative']['properties'] = $administrative_properties;
$arr[$inputdomain]['administrative']['remarks'] = $administrative_remarks;	

$arr[$inputdomain]['technical']['client_handle'] = $technical_handle;
$arr[$inputdomain]['technical']['web_id'] = $technical_web_id;		
$arr[$inputdomain]['technical']['organization_type'] = $technical_organization_type;	
$arr[$inputdomain]['technical']['organization_name'] = $technical_organization_name;	
$arr[$inputdomain]['technical']['presented_name'] = $technical_presented_name;	
$arr[$inputdomain]['technical']['kind'] = $technical_kind;	
$arr[$inputdomain]['technical']['name'] = $technical_name;		
$arr[$inputdomain]['technical']['email'] = $technical_email;	
$arr[$inputdomain]['technical']['telephone'] = $technical_telephone;
$arr[$inputdomain]['technical']['country_code'] = $technical_country_code;		
$arr[$inputdomain]['technical']['street_address'] = $technical_street_address;
$arr[$inputdomain]['technical']['city'] = $technical_city;
$arr[$inputdomain]['technical']['state_or_province'] = $technical_state_or_province;
$arr[$inputdomain]['technical']['postal_code'] = $technical_postal_code;
$arr[$inputdomain]['technical']['country_name'] = $technical_country_name;	
$arr[$inputdomain]['technical']['language_pref_1'] = $technical_language_pref_1;	
$arr[$inputdomain]['technical']['language_pref_2'] = $technical_language_pref_2;
$arr[$inputdomain]['technical']['flags'] = $technical_flags;
$arr[$inputdomain]['technical']['created_at'] = $technical_created_at;
$arr[$inputdomain]['technical']['latest_update_at'] = $technical_latest_update_at;
$arr[$inputdomain]['technical']['properties'] = $technical_properties;
$arr[$inputdomain]['technical']['remarks'] = $technical_remarks;
	
$arr[$inputdomain]['billing']['client_handle'] = $billing_handle;
$arr[$inputdomain]['billing']['web_id'] = $billing_web_id;		
$arr[$inputdomain]['billing']['organization_type'] = $billing_organization_type;	
$arr[$inputdomain]['billing']['organization_name'] = $billing_organization_name;	
$arr[$inputdomain]['billing']['presented_name'] = $billing_presented_name;	
$arr[$inputdomain]['billing']['kind'] = $billing_kind;	
$arr[$inputdomain]['billing']['name'] = $billing_name;		
$arr[$inputdomain]['billing']['email'] = $billing_email;	
$arr[$inputdomain]['billing']['telephone'] = $billing_telephone;
$arr[$inputdomain]['billing']['country_code'] = $billing_country_code;		
$arr[$inputdomain]['billing']['street_address'] = $billing_street_address;
$arr[$inputdomain]['billing']['city'] = $billing_city;
$arr[$inputdomain]['billing']['state_or_province'] = $billing_state_or_province;
$arr[$inputdomain]['billing']['postal_code'] = $billing_postal_code;
$arr[$inputdomain]['billing']['country_name'] = $billing_country_name;	
$arr[$inputdomain]['billing']['language_pref_1'] = $billing_language_pref_1;	
$arr[$inputdomain]['billing']['language_pref_2'] = $billing_language_pref_2;
$arr[$inputdomain]['billing']['flags'] = $billing_flags;
$arr[$inputdomain]['billing']['created_at'] = $billing_created_at;
$arr[$inputdomain]['billing']['latest_update_at'] = $billing_latest_update_at;
$arr[$inputdomain]['billing']['properties'] = $billing_properties;
$arr[$inputdomain]['billing']['remarks'] = $billing_remarks;

$arr[$inputdomain]['reseller']['client_handle'] = $reseller_handle;
$arr[$inputdomain]['reseller']['web_id'] = $reseller_web_id;		
$arr[$inputdomain]['reseller']['organization_type'] = $reseller_organization_type;	
$arr[$inputdomain]['reseller']['organization_name'] = $reseller_organization_name;	
$arr[$inputdomain]['reseller']['presented_name'] = $reseller_presented_name;	
$arr[$inputdomain]['reseller']['kind'] = $reseller_kind;	
$arr[$inputdomain]['reseller']['name'] = $reseller_name;		
$arr[$inputdomain]['reseller']['email'] = $reseller_email;	
$arr[$inputdomain]['reseller']['telephone'] = $reseller_telephone;
$arr[$inputdomain]['reseller']['country_code'] = $reseller_country_code;		
$arr[$inputdomain]['reseller']['street_address'] = $reseller_street_address;
$arr[$inputdomain]['reseller']['city'] = $reseller_city;
$arr[$inputdomain]['reseller']['state_or_province'] = $reseller_state_or_province;
$arr[$inputdomain]['reseller']['postal_code'] = $reseller_postal_code;
$arr[$inputdomain]['reseller']['country_name'] = $reseller_country_name;	
$arr[$inputdomain]['reseller']['language_pref_1'] = $reseller_language_pref_1;	
$arr[$inputdomain]['reseller']['language_pref_2'] = $reseller_language_pref_2;
$arr[$inputdomain]['reseller']['flags'] = $reseller_flags;
$arr[$inputdomain]['reseller']['created_at'] = $reseller_created_at;
$arr[$inputdomain]['reseller']['latest_update_at'] = $reseller_latest_update_at;
$arr[$inputdomain]['reseller']['properties'] = $reseller_properties;
$arr[$inputdomain]['reseller']['remarks'] = $reseller_remarks;	

$arr[$inputdomain]['registrar']['client_handle'] = $registrar_handle;
$arr[$inputdomain]['registrar']['web_id'] = $registrar_web_id;		
$arr[$inputdomain]['registrar']['organization_type'] = $registrar_organization_type;	
$arr[$inputdomain]['registrar']['organization_name'] = $registrar_organization_name;	
$arr[$inputdomain]['registrar']['presented_name'] = $registrar_presented_name;	
$arr[$inputdomain]['registrar']['kind'] = $registrar_kind;
$arr[$inputdomain]['registrar']['name'] = $registrar_name;		
$arr[$inputdomain]['registrar']['email'] = $registrar_email;	
$arr[$inputdomain]['registrar']['telephone'] = $registrar_telephone;
$arr[$inputdomain]['registrar']['country_code'] = $registrar_country_code;		
$arr[$inputdomain]['registrar']['street_address'] = $registrar_street_address;
$arr[$inputdomain]['registrar']['city'] = $registrar_city;
$arr[$inputdomain]['registrar']['state_or_province'] = $registrar_state_or_province;
$arr[$inputdomain]['registrar']['postal_code'] = $registrar_postal_code;
$arr[$inputdomain]['registrar']['country_name'] = $registrar_country_name;	
$arr[$inputdomain]['registrar']['language_pref_1'] = $registrar_language_pref_1;	
$arr[$inputdomain]['registrar']['language_pref_2'] = $registrar_language_pref_2;
$arr[$inputdomain]['registrar']['flags'] = $registrar_flags;
$arr[$inputdomain]['registrar']['created_at'] = $registrar_created_at;
$arr[$inputdomain]['registrar']['latest_update_at'] = $registrar_latest_update_at;
$arr[$inputdomain]['registrar']['properties'] = $registrar_properties;
$arr[$inputdomain]['registrar']['remarks'] = $registrar_remarks;
	
$arr[$inputdomain]['abuse']['client_handle'] = $abuse_handle;
$arr[$inputdomain]['abuse']['organization_type'] = $abuse_organization_type;
$arr[$inputdomain]['abuse']['organization_name'] = $abuse_organization_name;	
$arr[$inputdomain]['abuse']['presented_name'] = $abuse_presented_name;
$arr[$inputdomain]['abuse']['kind'] = $abuse_kind;
$arr[$inputdomain]['abuse']['email'] = $abuse_email;	
$arr[$inputdomain]['abuse']['telephone'] = $abuse_telephone;
$arr[$inputdomain]['abuse']['country_code'] = $abuse_country_code;	
	
$arr[$inputdomain]['name_servers']['client_handles'] = $name_servers_handles;
$arr[$inputdomain]['name_servers']['ascii_names'] = $name_servers_ascii;
$arr[$inputdomain]['name_servers']['unicode_names'] = $name_servers_unicode;	
$arr[$inputdomain]['name_servers']['ipv4_addresses'] = $name_servers_ipv4;	
$arr[$inputdomain]['name_servers']['ipv6_addresses'] = $name_servers_ipv6;	
$arr[$inputdomain]['name_servers']['flags'] = $name_servers_flags;	
$arr[$inputdomain]['name_servers']['delegation_checks'] = $name_servers_delegation_check;
$arr[$inputdomain]['name_servers']['latest_correct_delegation_checks'] = $name_servers_latest_correct_delegation_check;	
$arr[$inputdomain]['name_servers']['dnssec_signed'] = $name_servers_dnssec_signed;
$arr[$inputdomain]['name_servers']['dnssec_key_tag'] = $name_servers_dnssec_key_tag;
$arr[$inputdomain]['name_servers']['dnssec_algorithm'] = $name_servers_dnssec_algorithm;
$arr[$inputdomain]['name_servers']['dnssec_digest_type'] = $name_servers_dnssec_digest_type;
$arr[$inputdomain]['name_servers']['dnssec_digest'] = $name_servers_dnssec_digest;
	
$arr[$inputdomain]['raw_rdap'] = $raw_rdap_data;

return $arr;
}
?>