<?php
//$_GET['domain'] = 'hostingtool.nl';
//$_GET['domain'] = 'münchen.de';
//$_GET['domain'] = 'example.tel';
//$_GET['domain'] = 'nic.frl';
//$_GET['domain'] = 'fryslan.frl';
//$_GET['domain'] = 'example.ovh';
//$_GET['domain'] = 'icann.org';
//$_GET['domain'] = 'team.blue';

if (!empty($_GET['domain']))	{
	if (strlen($_GET['domain']))	{
		$domain = trim($_GET['domain']);
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
		$domain = urlencode($domain);
        echo write_file($domain, $batch);
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

function write_file($inputdomain, $inputbatch)	{
	
if ($inputbatch)	{
	$raw_whois_data = '';
}
else	{
	//$command = escapeshellcmd("python3.9 /home/admin/get_domain_data.py");
	$command = escapeshellcmd("/usr/bin/python3.9 /home/admin/get_domain_data.py");
	//$raw_whois_data = shell_exec($command . " " . $inputdomain . " 2>&1");
	$raw_whois_data = nl2br(htmlspecialchars(shell_exec($command . " " . $inputdomain)));
}
	
$zone_top_level_domain = mb_substr($inputdomain, strrpos($inputdomain, '.') + 1);

$url = '';	
switch ($zone_top_level_domain) {
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
	default:
   		//die("No match with a top level domain.");
}

if (!strlen($url))	{
	$rdap = json_decode(file_get_contents('https://data.iana.org/rdap/dns.json'), true);
	$temp_key = -1;
	foreach($rdap as $key1 => $value1) {
    	foreach($value1 as $key2 => $value2) {
			foreach($value2 as $key3 => $value3) {				
				foreach($value3 as $key4 => $value4) {
					if ($key3 == 0 and $value4 == $zone_top_level_domain)	{
						$temp_key = $key2;
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
$url_registrar = '';	
$obj = json_decode(file_get_contents($url), true);
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
$zone_delegation = 'https://www.iana.org/domains/root/db/'.$zone_top_level_domain.'.html';	
if ($zone_top_level_domain == 'nl')	{
	$registrant_web_id = 'NL88COMM01234567890123456789012345';
	$zone_restrictions = 'https://www.sidn.nl/en/nl-domain-name/sidn-and-privacy';
	$zone_regmenu = 'https://www.sidn.nl/en/theme/domain-names';
}
else	{
	$registrant_web_id = '';
	$zone_restrictions = '';
	$zone_regmenu = '';
}
$zone_languages = (is_array($obj['lang'])) ? implode(",<br />", $obj['lang']) : $obj['lang'];
if (!strlen($zone_languages))	{
	$zone_languages = 'None Specified';	
}	
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

$object_class_name = $obj['objectClassName'];
$object_conformance = (is_array($obj['rdapConformance'])) ? implode(",<br />", $obj['rdapConformance']) : $obj['rdapConformance'];
$registrar_iana_id = '';
$registrar_complaint = '';
$status_explanation = '';	
	
if ($notice_0_links_0_href == 'https://icann.org/wicf' or $notice_0_links_0_href == 'https://icann.org/wicf/')	$registrar_complaint = $notice_0_links_0_href;
if ($notice_1_links_0_href == 'https://icann.org/wicf' or $notice_1_links_0_href == 'https://icann.org/wicf/')	$registrar_complaint = $notice_1_links_0_href;
if ($notice_2_links_0_href == 'https://icann.org/wicf' or $notice_2_links_0_href == 'https://icann.org/wicf/')	$registrar_complaint = $notice_2_links_0_href;
if ($notice_3_links_0_href == 'https://icann.org/wicf' or $notice_3_links_0_href == 'https://icann.org/wicf/')	$registrar_complaint = $notice_3_links_0_href;
	
if ($notice_0_links_0_href == 'https://icann.org/epp' or $notice_0_links_0_href == 'https://icann.org/epp/')	$status_explanation = $notice_0_links_0_href;
if ($notice_1_links_0_href == 'https://icann.org/epp' or $notice_1_links_0_href == 'https://icann.org/epp/')	$status_explanation = $notice_1_links_0_href;
if ($notice_2_links_0_href == 'https://icann.org/epp' or $notice_2_links_0_href == 'https://icann.org/epp/')	$status_explanation = $notice_2_links_0_href;
if ($notice_3_links_0_href == 'https://icann.org/epp' or $notice_3_links_0_href == 'https://icann.org/epp/')	$status_explanation = $notice_3_links_0_href;	
	
$status_values = '';	
$registration = null;
$last_transferred = null;			
$last_changed = null;
$expiration = null;	
$deletion = null;
$last_uploaded = null;	
$extensions_values = '';
$remark_values = '';	
$registrant_status_values = '';
$registrant_registration = null;
$registrant_last_transferred = null;	
$registrant_last_changed = null;
$registrant_expiration = null;	
$registrant_deletion = null;
$registrant_properties = '(not tested yet)';		
$registrant_remark_values = '';		
$administrative_properties = '(not tested yet)';	
$administrative_remark_values = '';
$technical_properties = '(not tested yet)';	
$technical_remark_values = '';
$billing_properties = '(not tested yet)';
$billing_remark_values = '';		
$reseller_status_values = '';
$reseller_registration = null;
$reseller_last_transferred = null;	
$reseller_last_changed = null;
$reseller_expiration = null;	
$reseller_deletion = null;
$reseller_properties = '(not tested yet)';	
$reseller_remark_values = '';		
$registrar_status_values = '';	
$registrar_registration = null;
$registrar_last_transferred = null;	
$registrar_last_changed = null;
$registrar_expiration = null;	
$registrar_deletion = null;		
$registrar_properties = '(not tested yet)';	
$registrar_remark_values = '';		
$sponsor_status_values = '';
$sponsor_registration = null;
$sponsor_last_transferred = null;	
$sponsor_last_changed = null;
$sponsor_expiration = null;	
$sponsor_deletion = null;
$sponsor_properties = '(not tested yet)';
$sponsor_remark_values = '';
$handle = $obj['handle'];
$name_ascii = $obj['ldhName'];
$name_unicode = $obj['unicodeName'];
$name_servers_dnssec = 'Not Available';
$name_servers_dnssec_algorithm = 'Not Applicable';
if (empty($obj['secureDNS']['delegationSigned']))	{
}	
elseif ($obj['secureDNS']['delegationSigned'] === true)	{
	$name_servers_dnssec = 'yes';
	$algorithm = $obj['secureDNS']['dsData'][0]['algorithm'];
	if (strlen($algorithm))	{
		$name_servers_dnssec_algorithm = $algorithm;
	}
	else	{
		$name_servers_dnssec_algorithm = 'Not Available';
	}	
}
elseif ($obj['secureDNS']['delegationSigned'] === false)	{
	$name_servers_dnssec = 'no';	
}
$sponsor_handle = '';
$sponsor_organization_type = '';	
$sponsor_organization_name = '';		
$sponsor_presented_name = '';	
$sponsor_kind = '';
$sponsor_name = '';
$sponsor_email = '';
$sponsor_telephone = '';
$sponsor_country_code = '';		
$sponsor_street = '';
$sponsor_city = '';
$sponsor_state_province = '';	
$sponsor_postal_code = '';
$sponsor_country_name = '';
$sponsor_shielding = 'name,email,tel';	
$registrant_handle = '';
$registrant_organization_type = '';
$registrant_organization_name = '';	
$registrant_presented_name = '';
$registrant_kind = '';
$registrant_name = '';
$registrant_email = '';	
$registrant_telephone = '';
$registrant_country_code = 'None Specified';
$registrant_street = '';
$registrant_city = '';
$registrant_state_province = '';
$registrant_postal_code = '';
$registrant_country_name = '';	
$registrant_shielding = 'name,email,tel,address';
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
$administrative_street = '';
$administrative_city = '';	
$administrative_state_province = '';
$administrative_postal_code = '';	
$administrative_country_name = '';
$administrative_shielding = 'web_id,name,tel,address';
$administrative_language_pref_1 = '';
$administrative_language_pref_2 = '';	
$technical_handle = '';
$technical_organization_type = '';
$technical_organization_name = '';	
$technical_presented_name = '';
$technical_kind = '';
$technical_name = '';	
$technical_email	= '';
$technical_telephone = '';
$technical_country_code = '';	
$technical_street = '';
$technical_city = '';	
$technical_state_province = '';
$technical_postal_code = '';	
$technical_country_name = '';
$technical_shielding = 'web_id,name,tel,address';
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
$billing_street = '';
$billing_city = '';	
$billing_state_province = '';	
$billing_postal_code = '';	
$billing_country_name = '';
$billing_shielding = 'web_id,name,tel,address';
$reseller_handle = '';
$reseller_organization_type = '';	
$reseller_organization_name = '';	
$reseller_presented_name = '';	
$reseller_kind = '';	
$reseller_name = '';
$reseller_email = '';
$reseller_telephone = '';
$reseller_country_code = '';	
$reseller_street = '';
$reseller_city = '';
$reseller_state_province = '';	
$reseller_postal_code = '';
$reseller_country_name = '';	
$reseller_shielding = 'name,email,tel';
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
$registrar_street = '';
$registrar_city = '';
$registrar_state_province = '';	
$registrar_postal_code = '';
$registrar_country_name = '';	
$registrar_shielding = 'name,email,tel';
$registrar_language_pref_1 = '';
$registrar_language_pref_2 = '';
$registrar_abuse_organization_type = '';
$registrar_abuse_organization_name = '';
$registrar_abuse_presented_name = '';
$registrar_abuse_email = 'No Point of Contact';
$registrar_abuse_telephone = '';
$registrar_abuse_country_code = '';	

$server_name_1 = $obj['nameservers'][0]['ldhName'];
$server_name_2 = $obj['nameservers'][1]['ldhName'];
$server_name_3 = $obj['nameservers'][2]['ldhName'];
$server_name_4 = $obj['nameservers'][3]['ldhName'];
$server_name_5 = $obj['nameservers'][4]['ldhName'];
$server_name_6 = $obj['nameservers'][5]['ldhName'];	
$server_name_unicode_1 = $obj['nameservers'][0]['unicodeName'];
$server_name_unicode_2 = $obj['nameservers'][1]['unicodeName'];
$server_name_unicode_3 = $obj['nameservers'][2]['unicodeName'];
$server_name_unicode_4 = $obj['nameservers'][3]['unicodeName'];
$server_name_unicode_5 = $obj['nameservers'][4]['unicodeName'];
$server_name_unicode_6 = $obj['nameservers'][5]['unicodeName'];	
$server_ipv4_1 = $obj['nameservers'][0]['ipAddresses']['v4'][0];
$server_ipv6_1 = $obj['nameservers'][0]['ipAddresses']['v6'][0];	
$server_ipv4_2 = $obj['nameservers'][1]['ipAddresses']['v4'][0];
$server_ipv6_2 = $obj['nameservers'][1]['ipAddresses']['v6'][0];
$server_ipv4_3 = $obj['nameservers'][2]['ipAddresses']['v4'][0];
$server_ipv6_3 = $obj['nameservers'][2]['ipAddresses']['v6'][0];
$server_ipv4_4 = $obj['nameservers'][3]['ipAddresses']['v4'][0];
$server_ipv6_4 = $obj['nameservers'][3]['ipAddresses']['v6'][0];	
$server_ipv4_5 = $obj['nameservers'][4]['ipAddresses']['v4'][0];
$server_ipv6_5 = $obj['nameservers'][4]['ipAddresses']['v6'][0];
$server_ipv4_6 = $obj['nameservers'][5]['ipAddresses']['v4'][0];
$server_ipv6_6 = $obj['nameservers'][5]['ipAddresses']['v6'][0];
$server_delegation_check_1 = '';	
$server_delegation_check_2 = '';
$server_delegation_check_3 = '';
$server_delegation_check_4 = '';
$server_delegation_check_5 = '';
$server_delegation_check_6 = '';
$server_status_1 = '';
$server_status_2 = '';
$server_status_3 = '';
$server_status_4 = '';
$server_status_5 = '';
$server_status_6 = '';	
$server_delegation_check_last_correct_1 = '';
$server_delegation_check_last_correct_2 = '';
$server_delegation_check_last_correct_3 = '';
$server_delegation_check_last_correct_4 = '';
$server_delegation_check_last_correct_5 = '';
$server_delegation_check_last_correct_6 = '';		

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
	if ($key1 == 'status')	{	
		$status_values .= (is_array($value1)) ? implode(",<br />", $value1) : $value1;
	}
	if ($key1 == 'extensions')	{	
		$extensions_values .= (is_array($value1)) ? implode(",<br />", $value1) : $value1;
	}
	foreach($value1 as $key2 => $value2) {
		foreach($value2 as $key3 => $value3) {
			if ($key1 == 'remarks')	{
				if (strlen($remark_values))	{
					$remark_values .= '<br />';				
				}
				if (!is_array($value3))	{
					$remark_values .= $key3 . ': ' . $value3;
				}
				else	{
					$remark_values .= $value3;
				}				
			}
			if ($key1 == 'events')	{
				if ($key3 == 'eventAction' and $value3 == 'registration')	{
					$registration = $value2['eventDate'];
				}
				elseif ($key3 == 'eventAction' and $value3 == 'transfer')	{
					$last_transferred = $value2['eventDate'];
				}
				elseif ($key3 == 'eventAction' and $value3 == 'last changed')	{
					$last_changed = $value2['eventDate'];
				}				
				elseif ($key3 == 'eventAction' and $value3 == 'expiration')	{
					$expiration = $value2['eventDate'];
				}
				elseif ($key3 == 'eventAction' and $value3 == 'deletion')	{
					$deletion = $value2['eventDate'];
				}
				elseif ($key3 == 'eventAction' and $value3 == 'last update of RDAP database')	{
					$last_uploaded = $value2['eventDate'];				
				}
					
			}			
			if ($key1 == 'entities')	{
				if ($key3 == 'handle')	{
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
					if ($key2 == $entity_sponsor)	{
						$sponsor_handle = $value3;
					}	
				}
				if ($key3 == 'status')	{
					if ($key2 == $entity_registrant)	{
						$registrant_status_values .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
						//$registrant_status_values .= $key1.'#'.$value1.'#'.$key2.'#'.$value2.'#'.$key3.'#'.$value3.'#'.$key4.'#'.$value4;
					}
					if ($key2 == $entity_reseller)	{
						$reseller_status_values .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
					}
					if ($key2 == $entity_registrar)	{
						$registrar_status_values .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
					}
					if ($key2 == $entity_sponsor)	{
						$sponsor_status_values .= (is_array($value3)) ? implode(",<br />", $value3) : $value3;
					}
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
						$registrar_iana_id .= $value4['type'].': '.$value4['identifier'].'<br />';
					}
				}
				foreach($value4 as $key5 => $value5) {
					if ($key1 == 'entities')	{
						if ($key2 == $entity_registrant and $key3 == 'events')	{
							if ($key5 == 'eventAction' and $value5 == 'registration')	{
								$registrant_registration = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'transfer')	{
								$registrant_last_transferred = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last changed')	{
								$registrant_last_changed = $value4['eventDate'];
							}				
							elseif ($key5 == 'eventAction' and $value5 == 'expiration')	{
								$registrant_expiration = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'deletion')	{
								$registrant_deletion = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last update of RDAP database')	{
								$registrant_last_uploaded = $value4['eventDate'];				
							}
						}
						if ($key2 == $entity_reseller and $key3 == 'events')	{
							if ($key5 == 'eventAction' and $value5 == 'registration')	{
								$reseller_registration = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'transfer')	{
								$reseller_last_transferred = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last changed')	{
								$reseller_last_changed = $value4['eventDate'];
							}				
							elseif ($key5 == 'eventAction' and $value5 == 'expiration')	{
								$reseller_expiration = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'deletion')	{
								$reseller_deletion = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last update of RDAP database')	{
								$reseller_last_uploaded = $value4['eventDate'];				
							}
						}				
						if ($key2 == $entity_registrar and $key3 == 'events')	{
							if ($key5 == 'eventAction' and $value5 == 'registration')	{
								$registrar_registration = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'transfer')	{
								$registrar_last_transferred = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last changed')	{
								$registrar_last_changed = $value4['eventDate'];
							}				
							elseif ($key5 == 'eventAction' and $value5 == 'expiration')	{
								$registrar_expiration = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'deletion')	{
								$registrar_deletion = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last update of RDAP database')	{
								$registrar_last_uploaded = $value4['eventDate'];				
							}
						}
						if ($key2 == $entity_sponsor and $key3 == 'events')	{
							if ($key5 == 'eventAction' and $value5 == 'registration')	{
								$sponsor_registration = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'transfer')	{
								$sponsor_last_transferred = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last changed')	{
								$sponsor_last_changed = $value4['eventDate'];
							}				
							elseif ($key5 == 'eventAction' and $value5 == 'expiration')	{
								$sponsor_expiration = $valu4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'deletion')	{
								$sponsor_deletion = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last update of RDAP database')	{
								$sponsor_last_uploaded = $value4['eventDate'];				
							}
						}
						if ($key2 == $entity_registrant and $key3 == 'remarks')	{
							if (strlen($registrant_remark_values))	{
								$registrant_remark_values .= '<br />';				
							}
							$registrant_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;	
						}
						if ($key2 == $entity_administrative and $key3 == 'remarks')	{
							if (strlen($administrative_remark_values))	{
								$administrative_remark_values .= '<br />';				
							}
							$administrative_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;	
						}
						if ($key2 == $entity_technical and $key3 == 'remarks')	{
							if (strlen($technical_remark_values))	{
								$technical_remark_values .= '<br />';				
							}
							$technical_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;
						}
						if ($key2 == $entity_billing and $key3 == 'remarks')	{
							if (strlen($billing_remark_values))	{
								$billing_remark_values .= '<br />';				
							}
							$billing_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;	
						}
						if ($key2 == $entity_reseller and $key3 == 'remarks')	{
							if (strlen($reseller_remark_values))	{
								$reseller_remark_values .= '<br />';				
							}
							$reseller_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;
						}
						if ($key2 == $entity_registrar and $key3 == 'remarks')	{
							if (strlen($registrar_remark_values))	{
								$registrar_remark_values .= '<br />';				
							}
							$registrar_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;
						}
						if ($key2 == $entity_sponsor and $key3 == 'remarks')	{
							if (strlen($sponsor_remark_values))	{
								$sponsor_remark_values .= '<br />';				
							}
							$sponsor_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;
						}
					}
					if ($key1 == 'nameservers')	{
						if ($key2 == 0)	{
							if ($key3 == 'events')	{
								if ($key4 == 0)	{	
									if ($key5 == 'eventAction' and $value5 == 'delegation check')	{
										$server_delegation_check_1 = $value4['eventDate'];
									}
									if ($key5 == 'status')	{
										$server_status_1 = $value5[0];	
									}
								}	
								elseif ($key4 == 1)	{	
									if ($key5 == 'eventAction' and $value5 == 'last correct delegation check')	{
										$server_delegation_check_last_correct_1 = $value4['eventDate'];
									}	
								}		
							}	
						}
						elseif ($key2 == 1)	{
							if ($key3 == 'events')	{
								if ($key4 == 0)	{	
									if ($key5 == 'eventAction' and $value5 == 'delegation check')	{
										$server_delegation_check_2 = $value4['eventDate'];
									}
									if ($key5 == 'status')	{
										$server_status_2 = $value5[0];	
									}
								}	
								elseif ($key4 == 1)	{	
									if ($key5 == 'eventAction' and $value5 == 'last correct delegation check')	{
										$server_delegation_check_last_correct_2 = $value4['eventDate'];
									}	
								}		
							}	
						}
						elseif ($key2 == 2)	{
							if ($key3 == 'events')	{
								if ($key4 == 0)	{	
									if ($key5 == 'eventAction' and $value5 == 'delegation check')	{
										$server_delegation_check_3 = $value4['eventDate'];
									}
									if ($key5 == 'status')	{
										$server_status_3 = $value5[0];	
									}
								}	
								elseif ($key4 == 1)	{	
									if ($key5 == 'eventAction' and $value5 == 'last correct delegation check')	{
										$server_delegation_check_last_correct_3 = $value4['eventDate'];
									}	
								}		
							}	
						}
						elseif ($key2 == 3)	{
							if ($key3 == 'events')	{
								if ($key4 == 0)	{	
									if ($key5 == 'eventAction' and $value5 == 'delegation check')	{
										$server_delegation_check_4 = $value4['eventDate'];
									}
									if ($key5 == 'status')	{
										$server_status_4 = $value5[0];	
									}
								}	
								elseif ($key4 == 1)	{	
									if ($key5 == 'eventAction' and $value5 == 'last correct delegation check')	{
										$server_delegation_check_last_correct_4 = $value4['eventDate'];
									}	
								}		
							}	
						}
						elseif ($key2 == 4)	{
							if ($key3 == 'events')	{
								if ($key4 == 0)	{	
									if ($key5 == 'eventAction' and $value5 == 'delegation check')	{
										$server_delegation_check_5 = $value4['eventDate'];
									}
									if ($key5 == 'status')	{
										$server_status_5 = $value5[0];	
									}
								}	
								elseif ($key4 == 1)	{	
									if ($key5 == 'eventAction' and $value5 == 'last correct delegation check')	{
										$server_delegation_check_last_correct_5 = $value4['eventDate'];
									}	
								}		
							}	
						}
						elseif ($key2 == 5)	{
							if ($key3 == 'events')	{
								if ($key4 == 0)	{	
									if ($key5 == 'eventAction' and $value5 == 'delegation check')	{
										$server_delegation_check_6 = $value4['eventDate'];
									}
									if ($key5 == 'status')	{
										$server_status_6 = $value5[0];	
									}
								}	
								elseif ($key4 == 1)	{	
									if ($key5 == 'eventAction' and $value5 == 'last correct delegation check')	{
										$server_delegation_check_last_correct_6 = $value4['eventDate'];
									}	
								}		
							}	
						}
					}
					foreach($value5 as $key6 => $value6) {
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'email' and $value6 == 'email')	{					
							if ($key2 == $entity_registrant)	{
								$registrant_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3].'<br />';
							}
							if ($key2 == $entity_administrative)	{
								$administrative_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3].'<br />';
							}
							if ($key2 == $entity_technical)	{
								$technical_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3].'<br />';
							}
							if ($key2 == $entity_billing)	{
								$billing_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3].'<br />';
							}							
							if ($key2 == $entity_reseller)	{
								$reseller_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3].'<br />';
							}
							if ($key2 == $entity_registrar)	{
								$registrar_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3].'<br />';
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_email .= (is_array($value5[3])) ? implode(",<br />",$value5[3]) : $value5[3].'<br />';
							}
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'tel' and $value6 == 'tel')	{
							if ($key2 == $entity_registrant)	{
								$registrant_telephone .= implode(",<br />",$value5[1]) . ' ' . $value5[2] . ' ' . $value5[3] . '<br />';
							}
							if ($key2 == $entity_administrative)	{
								$administrative_telephone .= implode(",<br />",$value5[1]) . ' ' . $value5[2] . ' ' . $value5[3] . '<br />';
							}
							if ($key2 == $entity_technical)	{
								$technical_telephone .= implode(",<br />",$value5[1]) . ' ' . $value5[2] . ' ' . $value5[3] . '<br />';
							}
							if ($key2 == $entity_billing)	{
								$billing_telephone .= implode(",<br />",$value5[1]) . ' ' . $value5[2] . ' ' . $value5[3] . '<br />';
							}							
							if ($key2 == $entity_reseller)	{
								$reseller_telephone .= implode(",<br />",$value5[1]) . ' ' . $value5[2] . ' ' . $value5[3] . '<br />';
							}
							if ($key2 == $entity_registrar)	{
								$registrar_telephone .= implode(",<br />",$value5[1]) . ' ' . $value5[2] . ' ' . $value5[3] . '<br />';
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_telephone .= implode(",<br />",$value5[1]) . ' ' . $value5[2] . ' ' . $value5[3] . '<br />';
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
								$registrant_organization_type = $value5[1]['type'];
								$registrant_organization_name = $value5[3];
							}
							if ($key2 == $entity_administrative)	{
								$administrative_organization_type = $value5[1]['type'];
								$administrative_organization_name = $value5[3];
							}
							if ($key2 == $entity_technical)	{
								$technical_organization_type = $value5[1]['type'];
								$technical_organization_name = $value5[3];
							}
							if ($key2 == $entity_billing)	{
								$billing_organization_type = $value5[1]['type'];
								$billing_organization_name = $value5[3];
							}							
							if ($key2 == $entity_reseller)	{
								$reseller_organization_type = $value5[1]['type'];
								$reseller_organization_name = $value5[3];
							}
							if ($key2 == $entity_registrar)	{
								$registrar_organization_type = $value5[1]['type'];
								$registrar_organization_name = $value5[3];
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_organization_type = $value5[1]['type'];
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
								$registrant_street = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$registrant_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$registrant_state_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$registrant_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$registrant_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];
							}
							if ($key2 == $entity_administrative)	{
								$administrative_street = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$administrative_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$administrative_state_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$administrative_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$administrative_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];
							}	
							if ($key2 == $entity_technical)	{
								$technical_street = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$technical_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$technical_state_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$technical_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$technical_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];
							}
							if ($key2 == $entity_billing)	{
								$billing_street = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$billing_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$billing_state_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$billing_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$billing_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];
							}
							if ($key2 == $entity_reseller)	{
								$reseller_street = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$reseller_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$reseller_state_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$reseller_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$reseller_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];
							}
							if ($key2 == $entity_registrar)	{
								$registrar_street = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$registrar_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$registrar_state_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$registrar_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$registrar_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];	
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_street = (is_array($value6[2])) ? implode(",<br />",$value6[2]) : $value6[2];
								$sponsor_city = (is_array($value6[3])) ? implode(",<br />",$value6[3]) : $value6[3];
								$sponsor_state_province = (is_array($value6[4])) ? implode(",<br />",$value6[4]) : $value6[4];
								$sponsor_postal_code = (is_array($value6[5])) ? implode(",<br />",$value6[5]) : $value6[5];
								$sponsor_country_name = (is_array($value6[6])) ? implode(",<br />",$value6[6]) : $value6[6];
							}
						}	
						if ($key2 == $entity_registrant and $key3 == 'remarks')	{
							$registrant_remark_values .= '<br />' . $value6 . ';';		
						}
						if ($key2 == $entity_reseller and $key3 == 'remarks')	{
							$reseller_remark_values .= '<br />' . $value6 . ';';	
						}
						if ($key2 == $entity_registrar and $key3 == 'remarks')	{
							$registrar_remark_values .= '<br />' . $value6 . ';';	
						}
						if ($key2 == $entity_sponsor and $key3 == 'remarks')	{
							$sponsor_remark_values .= '<br />' . $value6 . ';';	
						}
						foreach($value6 as $key7 => $value7)	{
							foreach($value7 as $key8 => $value8) {
								if ($key1 == 'entities' and $key2 == $entity_registrar and $key3 == 'entities' 
									and $key4 == $entity_key4_abuse and $key5 == 'vcardArray' and $key6 == 1)	{
									if ($value7[0] == 'org' and $value8 == 'org')	{
										$registrar_abuse_organization_type = $value7[1]['type'];
										$registrar_abuse_organization_name = $value7[3];
									}
									elseif ($value7[0] == 'fn' and $value8 == 'fn')	{
										$registrar_abuse_presented_name = $value7[3];
									}
									elseif ($value7[0] == 'email' and $value8 == 'email')	{
										$registrar_abuse_email = $value7[3];
									}
									elseif ($value7[0] == 'tel' and $value8 == 'tel')	{
										$registrar_abuse_telephone = implode(",<br />",$value7[1]) . ' ' . $value7[2] . ' ' . $value7[3];							
									}
									elseif ($value7[0] == 'adr' and $key8 == 1)	{
										$registrar_abuse_country_code = detect_country_code($registrar_abuse_country_code, $value8['CC'], $value8['cc']);				
									}
								}
								//echo 'k4: '.$key4. ' v4: '.$value4.' k5: '.$key5.' v5: '.$value5.' k6: '.$key6.' v6: '.$value6.' k7: '.$key7.' value73: '.$value7[3].'<br />';
								if ($key1 == 'entities' and $key5 == 'vcardArray' and $value7[0] == 'email' and $value8 == 'email')	{					
									if ($key4 == $entity_key4_registrant)	{
										$registrant_email .= $value7[3].'<br />';
									}
									if ($key4 == $entity_key4_administrative)	{
										$administrative_email .= $value7[3].'<br />';
									}
									if ($key4 == $entity_key4_tech)	{
										$technical_email .= $value7[3].'<br />';
									}
									if ($key4 == $entity_key4_reseller)	{
										$reseller_email .= $value7[3].'<br />';
									}
									if ($key4 == $entity_key4_registrar)	{
										$registrar_email .= $value7[3].'<br />';
									}
									if ($key4 == $entity_key4_sponsor)	{
										$sponsor_email .= $value7[3].'<br />';
									}							
								}
								if ($key1 == 'entities' and $key5 == 'vcardArray' and $value7[0] == 'tel' and $value8 == 'tel')	{
									if ($key4 == $entity_key4_registrant)	{
										$registrant_telephone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . '<br />';
									}
									if ($key4 == $entity_key4_administrative)	{
										$administrative_telephone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . '<br />';
									}
									if ($key4 == $entity_key4_tech)	{
										$technical_telephone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . '<br />';
									}	
									if ($key4 == $entity_key4_reseller)	{
										$reseller_telephone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . '<br />';
									}
									if ($key4 == $entity_key4_registrar)	{
										$registrar_telephone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . '<br />';
									}
									if ($key4 == $entity_key4_sponsor)	{
										$sponsor_telephone .= implode(",<br />",$value7[1]) . ': ' . $value7[3] . '<br />';
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
$doc = new DOMDocument("1.0", "UTF-8");
$doc->xmlStandalone = true;	
$doc->formatOutput = true;		
	
$domains = $doc->createElement("domains");
$doc->appendChild($domains);
	
$domain = $doc->createElement("domain");	
$domains->appendChild($domain);
	
$domain->setAttribute("item", $inputdomain);
	
$zone = $doc->createElement("zone");	
$domain->appendChild($zone);
	
$domain_zone_top_level_domain = $doc->createElement("top_level_domain");
$domain_zone_top_level_domain->appendChild($doc->createCDATASection($zone_top_level_domain));	
$zone->appendChild($domain_zone_top_level_domain);	
	
$domain_zone_delegation = $doc->createElement("delegation");
$domain_zone_delegation->appendChild($doc->createCDATASection($zone_delegation));	
$zone->appendChild($domain_zone_delegation);	
	
$domain_zone_restrictions = $doc->createElement("restrictions");
$domain_zone_restrictions->appendChild($doc->createCDATASection($zone_restrictions));	
$zone->appendChild($domain_zone_restrictions);
	
$domain_zone_regmenu = $doc->createElement("regmenu");
$domain_zone_regmenu->appendChild($doc->createCDATASection($zone_regmenu));	
$zone->appendChild($domain_zone_regmenu);

$domain_zone_languages = $doc->createElement("languages");
$domain_zone_languages->appendChild($doc->createCDATASection($zone_languages));	
$zone->appendChild($domain_zone_languages);	
	
$domain_notice_0_title = $doc->createElement("notice_0_title");
$domain_notice_0_title->appendChild($doc->createCDATASection($notice_0_title));	
$zone->appendChild($domain_notice_0_title);	
	
$domain_notice_0_description_0 = $doc->createElement("notice_0_description_0");
$domain_notice_0_description_0->appendChild($doc->createCDATASection($notice_0_description_0));	
$zone->appendChild($domain_notice_0_description_0);
	
$domain_notice_0_description_1 = $doc->createElement("notice_0_description_1");
$domain_notice_0_description_1->appendChild($doc->createCDATASection($notice_0_description_1));		
$zone->appendChild($domain_notice_0_description_1);
	
$domain_notice_0_links_0_href = $doc->createElement("notice_0_links_0_href");
$domain_notice_0_links_0_href->appendChild($doc->createCDATASection($notice_0_links_0_href));	
$zone->appendChild($domain_notice_0_links_0_href);
	
$domain_notice_0_links_0_type = $doc->createElement("notice_0_links_0_type");
$domain_notice_0_links_0_type->appendChild($doc->createCDATASection($notice_0_links_0_type));	
$zone->appendChild($domain_notice_0_links_0_type);	
	
$domain_notice_1_title = $doc->createElement("notice_1_title");
$domain_notice_1_title->appendChild($doc->createCDATASection($notice_1_title));	
$zone->appendChild($domain_notice_1_title);	

$domain_notice_1_description_0 = $doc->createElement("notice_1_description_0");
$domain_notice_1_description_0->appendChild($doc->createCDATASection($notice_1_description_0));	
$zone->appendChild($domain_notice_1_description_0);
	
$domain_notice_1_description_1 = $doc->createElement("notice_1_description_1");
$domain_notice_1_description_1->appendChild($doc->createCDATASection($notice_1_description_1));		
$zone->appendChild($domain_notice_1_description_1);
	
$domain_notice_1_links_0_href = $doc->createElement("notice_1_links_0_href");
$domain_notice_1_links_0_href->appendChild($doc->createCDATASection($notice_1_links_0_href));	
$zone->appendChild($domain_notice_1_links_0_href);
	
$domain_notice_1_links_0_type = $doc->createElement("notice_1_links_0_type");
$domain_notice_1_links_0_type->appendChild($doc->createCDATASection($notice_1_links_0_type));	
$zone->appendChild($domain_notice_1_links_0_type);	
	
$domain_notice_2_title = $doc->createElement("notice_2_title");
$domain_notice_2_title->appendChild($doc->createCDATASection($notice_2_title));	
$zone->appendChild($domain_notice_2_title);
	
$domain_notice_2_description_0 = $doc->createElement("notice_2_description_0");
$domain_notice_2_description_0->appendChild($doc->createCDATASection($notice_2_description_0));	
$zone->appendChild($domain_notice_2_description_0);
	
$domain_notice_2_description_1 = $doc->createElement("notice_2_description_1");
$domain_notice_2_description_1->appendChild($doc->createCDATASection($notice_2_description_1));	
$zone->appendChild($domain_notice_2_description_1);
	
$domain_notice_2_links_0_href = $doc->createElement("notice_2_links_0_href");
$domain_notice_2_links_0_href->appendChild($doc->createCDATASection($notice_2_links_0_href));	
$zone->appendChild($domain_notice_2_links_0_href);
	
$domain_notice_2_links_0_type = $doc->createElement("notice_2_links_0_type");
$domain_notice_2_links_0_type->appendChild($doc->createCDATASection($notice_2_links_0_type));	
$zone->appendChild($domain_notice_2_links_0_type);
	
$domain_notice_3_title = $doc->createElement("notice_3_title");
$domain_notice_3_title->appendChild($doc->createCDATASection($notice_3_title));	
$zone->appendChild($domain_notice_3_title);
	
$domain_notice_3_description_0 = $doc->createElement("notice_3_description_0");
$domain_notice_3_description_0->appendChild($doc->createCDATASection($notice_3_description_0));	
$zone->appendChild($domain_notice_3_description_0);
	
$domain_notice_3_description_1 = $doc->createElement("notice_3_description_1");
$domain_notice_3_description_1->appendChild($doc->createCDATASection($notice_3_description_1));	
$zone->appendChild($domain_notice_3_description_1);
	
$domain_notice_3_links_0_href = $doc->createElement("notice_3_links_0_href");
$domain_notice_3_links_0_href->appendChild($doc->createCDATASection($notice_3_links_0_href));	
$zone->appendChild($domain_notice_3_links_0_href);
	
$domain_notice_3_links_0_type = $doc->createElement("notice_3_links_0_type");
$domain_notice_3_links_0_type->appendChild($doc->createCDATASection($notice_3_links_0_type));	
$zone->appendChild($domain_notice_3_links_0_type);	
	
$domain->appendChild($zone);	

$view = $doc->createElement("view");
$domain->appendChild($view);

$domain_links_0_value = $doc->createElement("links_0_value");
$domain_links_0_value->appendChild($doc->createCDATASection($links_0_value));	
$view->appendChild($domain_links_0_value);
	
$domain_links_0_related = $doc->createElement("links_0_related");
$domain_links_0_related->appendChild($doc->createCDATASection($links_0_related));	
$view->appendChild($domain_links_0_related);
	
$domain_links_0_href = $doc->createElement("links_0_href");
$domain_links_0_href->appendChild($doc->createCDATASection($links_0_href));	
$view->appendChild($domain_links_0_href);
	
$domain_links_0_href_lang = $doc->createElement("links_0_href_lang");
$domain_links_0_href_lang->appendChild($doc->createCDATASection($links_0_href_lang));	
$view->appendChild($domain_links_0_href_lang);
	
$domain_links_0_title = $doc->createElement("links_0_title");
$domain_links_0_title->appendChild($doc->createCDATASection($links_0_title));	
$view->appendChild($domain_links_0_title);	
	
$domain_links_0_media = $doc->createElement("links_0_media");
$domain_links_0_media->appendChild($doc->createCDATASection($links_0_media));	
$view->appendChild($domain_links_0_media);

$domain_links_0_type = $doc->createElement("links_0_type");
$domain_links_0_type->appendChild($doc->createCDATASection($links_0_type));	
$view->appendChild($domain_links_0_type);
	
$domain_links_1_value = $doc->createElement("links_1_value");
$domain_links_1_value->appendChild($doc->createCDATASection($links_1_value));	
$view->appendChild($domain_links_1_value);
	
$domain_links_1_related = $doc->createElement("links_1_related");
$domain_links_1_related->appendChild($doc->createCDATASection($links_1_related));	
$view->appendChild($domain_links_1_related);
	
$domain_links_1_href = $doc->createElement("links_1_href");
$domain_links_1_href->appendChild($doc->createCDATASection($links_1_href));	
$view->appendChild($domain_links_1_href);
	
$domain_links_href_lang_1 = $doc->createElement("links_href_lang_1");
$domain_links_href_lang_1->appendChild($doc->createCDATASection($links_href_lang_1));	
$view->appendChild($domain_links_href_lang_1);
	
$domain_links_1_title = $doc->createElement("links_1_title");
$domain_links_1_title->appendChild($doc->createCDATASection($links_1_title));	
$view->appendChild($domain_links_1_title);	
	
$domain_links_1_media = $doc->createElement("links_1_media");
$domain_links_1_media->appendChild($doc->createCDATASection($links_1_media));	
$view->appendChild($domain_links_1_media);

$domain_links_1_type = $doc->createElement("links_1_type");
$domain_links_1_type->appendChild($doc->createCDATASection($links_1_type));	
$view->appendChild($domain_links_1_type);
	
$domain_links_2_value = $doc->createElement("links_2_value");
$domain_links_2_value->appendChild($doc->createCDATASection($links_2_value));	
$view->appendChild($domain_links_2_value);
	
$domain_links_2_related = $doc->createElement("links_2_related");
$domain_links_2_related->appendChild($doc->createCDATASection($links_2_related));	
$view->appendChild($domain_links_2_related);
	
$domain_links_2_href = $doc->createElement("links_2_href");
$domain_links_2_href->appendChild($doc->createCDATASection($links_2_href));	
$view->appendChild($domain_links_2_href);
	
$domain_links_href_lang_2 = $doc->createElement("links_href_lang_2");
$domain_links_href_lang_2->appendChild($doc->createCDATASection($links_href_lang_2));	
$view->appendChild($domain_links_href_lang_2);
	
$domain_links_2_title = $doc->createElement("links_2_title");
$domain_links_2_title->appendChild($doc->createCDATASection($links_2_title));	
$view->appendChild($domain_links_2_title);	
	
$domain_links_2_media = $doc->createElement("links_2_media");
$domain_links_2_media->appendChild($doc->createCDATASection($links_2_media));	
$view->appendChild($domain_links_2_media);

$domain_links_2_type = $doc->createElement("links_2_type");
$domain_links_2_type->appendChild($doc->createCDATASection($links_2_type));	
$view->appendChild($domain_links_2_type);
	
$domain_links_3_value = $doc->createElement("links_3_value");
$domain_links_3_value->appendChild($doc->createCDATASection($links_3_value));	
$view->appendChild($domain_links_3_value);
	
$domain_links_3_related = $doc->createElement("links_3_related");
$domain_links_3_related->appendChild($doc->createCDATASection($links_3_related));	
$view->appendChild($domain_links_3_related);
	
$domain_links_3_href = $doc->createElement("links_3_href");
$domain_links_3_href->appendChild($doc->createCDATASection($links_3_href));	
$view->appendChild($domain_links_3_href);
	
$domain_links_href_lang_3 = $doc->createElement("links_href_lang_3");
$domain_links_href_lang_3->appendChild($doc->createCDATASection($links_href_lang_3));	
$view->appendChild($domain_links_href_lang_3);
	
$domain_links_3_title = $doc->createElement("links_3_title");
$domain_links_3_title->appendChild($doc->createCDATASection($links_3_title));	
$view->appendChild($domain_links_3_title);	
	
$domain_links_3_media = $doc->createElement("links_3_media");
$domain_links_3_media->appendChild($doc->createCDATASection($links_3_media));	
$view->appendChild($domain_links_3_media);

$domain_links_3_type = $doc->createElement("links_3_type");
$domain_links_3_type->appendChild($doc->createCDATASection($links_3_type));	
$view->appendChild($domain_links_3_type);
	
$domain->appendChild($view);	
	
$protocols = $doc->createElement("protocols");
$domain->appendChild($protocols);	
	
$domain_object_conformance = $doc->createElement("object_conformance");
$domain_object_conformance->appendChild($doc->createCDATASection($object_conformance));
$protocols->appendChild($domain_object_conformance);	
$domain_source_registry = $doc->createElement("source_registry");
$domain_source_registry->appendChild($doc->createCDATASection($url));		
$protocols->appendChild($domain_source_registry);	
$domain_source_registrar = $doc->createElement("source_registrar");
$domain_source_registrar->appendChild($doc->createCDATASection($url_registrar));		
$protocols->appendChild($domain_source_registrar);	
$domain_object_class_name = $doc->createElement("object_class_name");
$domain_object_class_name->appendChild($doc->createCDATASection($object_class_name));
$protocols->appendChild($domain_object_class_name);	
$domain_registrar_iana_id = $doc->createElement("registrar_iana_id");
$domain_registrar_iana_id->appendChild($doc->createCDATASection($registrar_iana_id));	
$protocols->appendChild($domain_registrar_iana_id);	
$domain_registrar_complaint = $doc->createElement("registrar_complaint");
$domain_registrar_complaint->appendChild($doc->createCDATASection($registrar_complaint));		
$protocols->appendChild($domain_registrar_complaint);	
$domain_status_explanation = $doc->createElement("status_explanation");
$domain_status_explanation->appendChild($doc->createCDATASection($status_explanation));		
$protocols->appendChild($domain_status_explanation);			
	
$domain->appendChild($protocols);	
		
$details = $doc->createElement("details");
$domain->appendChild($details);	
		
$domain_handle = $doc->createElement("handle");
$domain_handle->appendChild($doc->createCDATASection($handle));
$details->appendChild($domain_handle);		
$domain_name_ascii = $doc->createElement("name_ascii");
$domain_name_ascii->appendChild($doc->createCDATASection($name_ascii));	
$details->appendChild($domain_name_ascii);
$domain_name_unicode = $doc->createElement("name_unicode");
$domain_name_unicode->appendChild($doc->createCDATASection($name_unicode));	
$details->appendChild($domain_name_unicode);	
$domain_status_values = $doc->createElement("status_values");
$domain_status_values->appendChild($doc->createCDATASection($status_values));	
$details->appendChild($domain_status_values);			
$domain_event_registration = $doc->createElement("event_registration");
$domain_event_registration->appendChild($doc->createCDATASection($registration));	
$details->appendChild($domain_event_registration);
$domain_event_last_transferred = $doc->createElement("event_last_transferred");
$domain_event_last_transferred->appendChild($doc->createCDATASection($last_transferred));	
$details->appendChild($domain_event_last_transferred);
$domain_event_last_changed = $doc->createElement("event_last_changed");
$domain_event_last_changed->appendChild($doc->createCDATASection($last_changed));	
$details->appendChild($domain_event_last_changed);	
$domain_event_expiration = $doc->createElement("event_expiration");
$domain_event_expiration->appendChild($doc->createCDATASection($expiration));	
$details->appendChild($domain_event_expiration);
$domain_event_deletion = $doc->createElement("event_deletion");
$domain_event_deletion->appendChild($doc->createCDATASection($deletion));	
$details->appendChild($domain_event_deletion);	
$domain_event_last_uploaded = $doc->createElement("event_last_uploaded");
$domain_event_last_uploaded->appendChild($doc->createCDATASection($last_uploaded));	
$details->appendChild($domain_event_last_uploaded);	
$domain_extensions_values = $doc->createElement("extensions_values");
$domain_extensions_values->appendChild($doc->createCDATASection($extensions_values));	
$details->appendChild($domain_extensions_values);
$domain_remark_values = $doc->createElement("remark_values");
$domain_remark_values->appendChild($doc->createCDATASection($remark_values));	
$details->appendChild($domain_remark_values);	
$domain->appendChild($details);
	
$sponsor = $doc->createElement("sponsor");
$domain->appendChild($sponsor);
$domain_sponsor_handle = $doc->createElement("handle");
$domain_sponsor_handle->appendChild($doc->createCDATASection($sponsor_handle));	
$sponsor->appendChild($domain_sponsor_handle);	
$domain_sponsor_organization_type = $doc->createElement("organization_type");
$domain_sponsor_organization_type->appendChild($doc->createCDATASection($sponsor_organization_type));
$sponsor->appendChild($domain_sponsor_organization_type);
$domain_sponsor_organization_name = $doc->createElement("organization_name");
$domain_sponsor_organization_name->appendChild($doc->createCDATASection($sponsor_organization_name));
$sponsor->appendChild($domain_sponsor_organization_name);
$domain_sponsor_presented_name = $doc->createElement("presented_name");
$domain_sponsor_presented_name->appendChild($doc->createCDATASection($sponsor_presented_name));	
$sponsor->appendChild($domain_sponsor_presented_name);
$domain_sponsor_kind = $doc->createElement("kind");
$domain_sponsor_kind->appendChild($doc->createCDATASection($sponsor_kind));	
$sponsor->appendChild($domain_sponsor_kind);	
$domain_sponsor_name = $doc->createElement("name");
$domain_sponsor_name->appendChild($doc->createCDATASection($sponsor_name));	
$sponsor->appendChild($domain_sponsor_name);
$domain_sponsor_email = $doc->createElement("email");
$domain_sponsor_email->appendChild($doc->createCDATASection($sponsor_email));	
$sponsor->appendChild($domain_sponsor_email);	
$domain_sponsor_telephone = $doc->createElement("tel");
$domain_sponsor_telephone->appendChild($doc->createCDATASection($sponsor_telephone));	
$sponsor->appendChild($domain_sponsor_telephone);	
$domain_sponsor_street = $doc->createElement("street");
$domain_sponsor_street->appendChild($doc->createCDATASection($sponsor_street));	
$sponsor->appendChild($domain_sponsor_street);
$domain_sponsor_city = $doc->createElement("city");
$domain_sponsor_city->appendChild($doc->createCDATASection($sponsor_city));	
$sponsor->appendChild($domain_sponsor_city);
$domain_sponsor_state_province = $doc->createElement("state_province");
$domain_sponsor_state_province->appendChild($doc->createCDATASection($sponsor_state_province));
$sponsor->appendChild($domain_sponsor_state_province);
$domain_sponsor_postal_code = $doc->createElement("postal_code");
$domain_sponsor_postal_code->appendChild($doc->createCDATASection($sponsor_postal_code));
$sponsor->appendChild($domain_sponsor_postal_code);
$domain_sponsor_country_name = $doc->createElement("country_name");
$domain_sponsor_country_name->appendChild($doc->createCDATASection($sponsor_country_name));	
$sponsor->appendChild($domain_sponsor_country_name);		
$domain_sponsor_language_pref_1 = $doc->createElement("language_pref_1");
$domain_sponsor_language_pref_1->appendChild($doc->createCDATASection($sponsor_language_pref_1));	
$sponsor->appendChild($domain_sponsor_language_pref_1);
$domain_sponsor_language_pref_2 = $doc->createElement("language_pref_2");
$domain_sponsor_language_pref_2->appendChild($doc->createCDATASection($sponsor_language_pref_2));	
$sponsor->appendChild($domain_sponsor_language_pref_2);	
$domain_sponsor_shielding = $doc->createElement("shielding");	
$domain_sponsor_shielding->appendChild($doc->createCDATASection($sponsor_shielding));	
$sponsor->appendChild($domain_sponsor_shielding);
$domain_sponsor_status_values = $doc->createElement("status_values");
$domain_sponsor_status_values->appendChild($doc->createCDATASection($sponsor_status_values));	
$sponsor->appendChild($domain_sponsor_status_values);
$domain_sponsor_event_registration = $doc->createElement("event_registration");
$domain_sponsor_event_registration->appendChild($doc->createCDATASection($sponsor_registration));	
$sponsor->appendChild($domain_sponsor_event_registration);
$domain_sponsor_event_last_transferred = $doc->createElement("event_last_transferred");
$domain_sponsor_event_last_transferred->appendChild($doc->createCDATASection($sponsor_last_transferred));	
$sponsor->appendChild($domain_sponsor_event_last_transferred);
$domain_sponsor_event_last_changed = $doc->createElement("event_last_changed");
$domain_sponsor_event_last_changed->appendChild($doc->createCDATASection($sponsor_last_changed));	
$sponsor->appendChild($domain_sponsor_event_last_changed);	
$domain_sponsor_event_expiration = $doc->createElement("event_expiration");
$domain_sponsor_event_expiration->appendChild($doc->createCDATASection($sponsor_expiration));	
$sponsor->appendChild($domain_sponsor_event_expiration);
$domain_sponsor_event_deletion = $doc->createElement("event_deletion");
$domain_sponsor_event_deletion->appendChild($doc->createCDATASection($sponsor_deletion));	
$sponsor->appendChild($domain_sponsor_event_deletion);	
$domain_sponsor_event_last_uploaded = $doc->createElement("event_last_uploaded");
$domain_sponsor_event_last_uploaded->appendChild($doc->createCDATASection($sponsor_last_uploaded));	
$sponsor->appendChild($domain_sponsor_event_last_uploaded);
$domain_sponsor_properties = $doc->createElement("properties");
$domain_sponsor_properties->appendChild($doc->createCDATASection($sponsor_properties));	
$sponsor->appendChild($domain_sponsor_properties);
$domain_sponsor_remark_values = $doc->createElement("remark_values");
$domain_sponsor_remark_values->appendChild($doc->createCDATASection($sponsor_remark_values));	
$sponsor->appendChild($domain_sponsor_remark_values);	
$domain->appendChild($sponsor);	
	
$registrant = $doc->createElement("registrant");
$domain->appendChild($registrant);
$domain_registrant_handle = $doc->createElement("handle");
$domain_registrant_handle->appendChild($doc->createCDATASection($registrant_handle));	
$registrant->appendChild($domain_registrant_handle);	
$domain_registrant_web_id = $doc->createElement("web_id");
$domain_registrant_web_id->appendChild($doc->createCDATASection($registrant_web_id));	
$registrant->appendChild($domain_registrant_web_id);
$domain_registrant_organization_type = $doc->createElement("organization_type");
$domain_registrant_organization_type->appendChild($doc->createCDATASection($registrant_organization_type));
$registrant->appendChild($domain_registrant_organization_type);
$domain_registrant_organization_name = $doc->createElement("organization_name");
$domain_registrant_organization_name->appendChild($doc->createCDATASection($registrant_organization_name));
$registrant->appendChild($domain_registrant_organization_name);
$domain_registrant_presented_name = $doc->createElement("presented_name");
$domain_registrant_presented_name->appendChild($doc->createCDATASection($registrant_presented_name));	
$registrant->appendChild($domain_registrant_presented_name);
$domain_registrant_kind = $doc->createElement("kind");
$domain_registrant_kind->appendChild($doc->createCDATASection($registrant_kind));	
$registrant->appendChild($domain_registrant_kind);	
$domain_registrant_name = $doc->createElement("name");
$domain_registrant_name->appendChild($doc->createCDATASection($registrant_name));	
$registrant->appendChild($domain_registrant_name);
$domain_registrant_email = $doc->createElement("email");
$domain_registrant_email->appendChild($doc->createCDATASection($registrant_email));	
$registrant->appendChild($domain_registrant_email);	
$domain_registrant_telephone = $doc->createElement("tel");
$domain_registrant_telephone->appendChild($doc->createCDATASection($registrant_telephone));	
$registrant->appendChild($domain_registrant_telephone);
$domain_registrant_country_code = $doc->createElement("country_code");
$domain_registrant_country_code->appendChild($doc->createCDATASection($registrant_country_code));
$registrant->appendChild($domain_registrant_country_code);	
$domain_registrant_street = $doc->createElement("street");
$domain_registrant_street->appendChild($doc->createCDATASection($registrant_street));	
$registrant->appendChild($domain_registrant_street);
$domain_registrant_city = $doc->createElement("city");
$domain_registrant_city->appendChild($doc->createCDATASection($registrant_city));	
$registrant->appendChild($domain_registrant_city);	
$domain_registrant_state_province = $doc->createElement("state_province");
$domain_registrant_state_province->appendChild($doc->createCDATASection($registrant_state_province));
$registrant->appendChild($domain_registrant_state_province);
$domain_registrant_postal_code = $doc->createElement("postal_code");
$domain_registrant_postal_code->appendChild($doc->createCDATASection($registrant_postal_code));
$registrant->appendChild($domain_registrant_postal_code);	
$domain_registrant_country_name = $doc->createElement("country_name");
$domain_registrant_country_name->appendChild($doc->createCDATASection($registrant_country_name));
$registrant->appendChild($domain_registrant_country_name);	
$domain_registrant_language_pref_1 = $doc->createElement("language_pref_1");
$domain_registrant_language_pref_1->appendChild($doc->createCDATASection($registrant_language_pref_1));	
$registrant->appendChild($domain_registrant_language_pref_1);
$domain_registrant_language_pref_2 = $doc->createElement("language_pref_2");
$domain_registrant_language_pref_2->appendChild($doc->createCDATASection($registrant_language_pref_2));	
$registrant->appendChild($domain_registrant_language_pref_2);	
$domain_registrant_shielding = $doc->createElement("shielding");	
$domain_registrant_shielding->appendChild($doc->createCDATASection($registrant_shielding));	
$registrant->appendChild($domain_registrant_shielding);
$domain_registrant_status_values = $doc->createElement("status_values");
$domain_registrant_status_values->appendChild($doc->createCDATASection($registrant_status_values));	
$registrant->appendChild($domain_registrant_status_values);
$domain_registrant_event_registration = $doc->createElement("event_registration");
$domain_registrant_event_registration->appendChild($doc->createCDATASection($registrant_registration));	
$registrant->appendChild($domain_registrant_event_registration);
$domain_registrant_event_last_transferred = $doc->createElement("event_last_transferred");
$domain_registrant_event_last_transferred->appendChild($doc->createCDATASection($registrant_last_transferred));	
$registrant->appendChild($domain_registrant_event_last_transferred);
$domain_registrant_event_last_changed = $doc->createElement("event_last_changed");
$domain_registrant_event_last_changed->appendChild($doc->createCDATASection($registrant_last_changed));	
$registrant->appendChild($domain_registrant_event_last_changed);	
$domain_registrant_event_expiration = $doc->createElement("event_expiration");
$domain_registrant_event_expiration->appendChild($doc->createCDATASection($registrant_expiration));	
$registrant->appendChild($domain_registrant_event_expiration);
$domain_registrant_event_deletion = $doc->createElement("event_deletion");
$domain_registrant_event_deletion->appendChild($doc->createCDATASection($registrant_deletion));	
$registrant->appendChild($domain_registrant_event_deletion);	
$domain_registrant_event_last_uploaded = $doc->createElement("event_last_uploaded");
$domain_registrant_event_last_uploaded->appendChild($doc->createCDATASection($registrant_last_uploaded));	
$registrant->appendChild($domain_registrant_event_last_uploaded);
$domain_registrant_properties = $doc->createElement("properties");
$domain_registrant_properties->appendChild($doc->createCDATASection($registrant_properties));	
$registrant->appendChild($domain_registrant_properties);
$domain_registrant_remark_values = $doc->createElement("remark_values");
$domain_registrant_remark_values->appendChild($doc->createCDATASection($registrant_remark_values));	
$registrant->appendChild($domain_registrant_remark_values);		
$domain->appendChild($registrant);
	
$administrative = $doc->createElement("administrative");
$domain->appendChild($administrative);
$domain_administrative_handle = $doc->createElement("handle");
$domain_administrative_handle->appendChild($doc->createCDATASection($administrative_handle));	
$administrative->appendChild($domain_administrative_handle);
$domain_administrative_organization_type = $doc->createElement("organization_type");
$domain_administrative_organization_type->appendChild($doc->createCDATASection($administrative_organization_type));
$administrative->appendChild($domain_administrative_organization_type);
$domain_administrative_organization_name = $doc->createElement("organization_name");
$domain_administrative_organization_name->appendChild($doc->createCDATASection($administrative_organization_name));
$administrative->appendChild($domain_administrative_organization_name);
$domain_administrative_presented_name = $doc->createElement("presented_name");
$domain_administrative_presented_name->appendChild($doc->createCDATASection($administrative_presented_name));
$administrative->appendChild($domain_administrative_presented_name);
$domain_administrative_kind = $doc->createElement("kind");
$domain_administrative_kind->appendChild($doc->createCDATASection($administrative_kind));	
$administrative->appendChild($domain_administrative_kind);	
$domain_administrative_name = $doc->createElement("name");
$domain_administrative_name->appendChild($doc->createCDATASection($administrative_name));	
$administrative->appendChild($domain_administrative_name);	
$domain_administrative_email = $doc->createElement("email");
$domain_administrative_email->appendChild($doc->createCDATASection($administrative_email));	
$administrative->appendChild($domain_administrative_email);	
$domain_administrative_telephone = $doc->createElement("tel");
$domain_administrative_telephone->appendChild($doc->createCDATASection($administrative_telephone));	
$administrative->appendChild($domain_administrative_telephone);
$domain_administrative_country_code = $doc->createElement("country_code");
$domain_administrative_country_code->appendChild($doc->createCDATASection($administrative_country_code));
$administrative->appendChild($domain_administrative_country_code);		
$domain_administrative_street = $doc->createElement("street");
$domain_administrative_street->appendChild($doc->createCDATASection($administrative_street));	
$administrative->appendChild($domain_administrative_street);
$domain_administrative_city = $doc->createElement("city");
$domain_administrative_city->appendChild($doc->createCDATASection($administrative_city));	
$administrative->appendChild($domain_administrative_city);	
$domain_administrative_state_province = $doc->createElement("state_province");
$domain_administrative_state_province->appendChild($doc->createCDATASection($administrative_state_province));
$administrative->appendChild($domain_administrative_state_province);
$domain_administrative_postal_code = $doc->createElement("postal_code");
$domain_administrative_postal_code->appendChild($doc->createCDATASection($administrative_postal_code));
$administrative->appendChild($domain_administrative_postal_code);	
$domain_administrative_country_name = $doc->createElement("country_name");
$domain_administrative_country_name->appendChild($doc->createCDATASection($administrative_country_name));
$administrative->appendChild($domain_administrative_country_name);	
$domain_administrative_language_pref_1 = $doc->createElement("language_pref_1");
$domain_administrative_language_pref_1->appendChild($doc->createCDATASection($administrative_language_pref_1));	
$administrative->appendChild($domain_administrative_language_pref_1);
$domain_administrative_language_pref_2 = $doc->createElement("language_pref_2");
$domain_administrative_language_pref_2->appendChild($doc->createCDATASection($administrative_language_pref_2));
$administrative->appendChild($domain_administrative_language_pref_2);	
$domain_administrative_shielding = $doc->createElement("shielding");	
$domain_administrative_shielding->appendChild($doc->createCDATASection($administrative_shielding));	
$administrative->appendChild($domain_administrative_shielding);
$domain_administrative_properties = $doc->createElement("properties");
$domain_administrative_properties->appendChild($doc->createCDATASection($administrative_properties));	
$administrative->appendChild($domain_administrative_properties);	
$domain_administrative_remark_values = $doc->createElement("remark_values");
$domain_administrative_remark_values->appendChild($doc->createCDATASection($administrative_remark_values));	
$administrative->appendChild($domain_administrative_remark_values);	
$domain->appendChild($administrative);	
	
$technical = $doc->createElement("technical");
$domain->appendChild($technical);
$domain_technical_handle = $doc->createElement("handle");
$domain_technical_handle->appendChild($doc->createCDATASection($technical_handle));	
$technical->appendChild($domain_technical_handle);
$domain_technical_organization_type = $doc->createElement("organization_type");
$domain_technical_organization_type->appendChild($doc->createCDATASection($technical_organization_type));
$technical->appendChild($domain_technical_organization_type);
$domain_technical_organization_name = $doc->createElement("organization_name");
$domain_technical_organization_name->appendChild($doc->createCDATASection($technical_organization_name));
$technical->appendChild($domain_technical_organization_name);	
$domain_technical_presented_name = $doc->createElement("presented_name");
$domain_technical_presented_name->appendChild($doc->createCDATASection($technical_presented_name));	
$technical->appendChild($domain_technical_presented_name);
$domain_technical_kind = $doc->createElement("kind");
$domain_technical_kind->appendChild($doc->createCDATASection($technical_kind));	
$technical->appendChild($domain_technical_kind);	
$domain_technical_name = $doc->createElement("name");
$domain_technical_name->appendChild($doc->createCDATASection($technical_name));	
$technical->appendChild($domain_technical_name);	
$domain_technical_email = $doc->createElement("email");
$domain_technical_email->appendChild($doc->createCDATASection($technical_email));	
$technical->appendChild($domain_technical_email);	
$domain_technical_telephone = $doc->createElement("tel");
$domain_technical_telephone->appendChild($doc->createCDATASection($technical_telephone));	
$technical->appendChild($domain_technical_telephone);
$domain_technical_country_code = $doc->createElement("country_code");
$domain_technical_country_code->appendChild($doc->createCDATASection($technical_country_code));
$technical->appendChild($domain_technical_country_code);	
$domain_technical_street = $doc->createElement("street");
$domain_technical_street->appendChild($doc->createCDATASection($technical_street));	
$technical->appendChild($domain_technical_street);
$domain_technical_city = $doc->createElement("city");
$domain_technical_city->appendChild($doc->createCDATASection($technical_city));	
$technical->appendChild($domain_technical_city);	
$domain_technical_state_province = $doc->createElement("state_province");
$domain_technical_state_province->appendChild($doc->createCDATASection($technical_state_province));
$technical->appendChild($domain_technical_state_province);
$domain_technical_postal_code = $doc->createElement("postal_code");
$domain_technical_postal_code->appendChild($doc->createCDATASection($technical_postal_code));
$technical->appendChild($domain_technical_postal_code);	
$domain_technical_country_name = $doc->createElement("country_name");
$domain_technical_country_name->appendChild($doc->createCDATASection($technical_country_name));
$technical->appendChild($domain_technical_country_name);		
$domain_technical_language_pref_1 = $doc->createElement("language_pref_1");
$domain_technical_language_pref_1->appendChild($doc->createCDATASection($technical_language_pref_1));	
$technical->appendChild($domain_technical_language_pref_1);
$domain_technical_language_pref_2 = $doc->createElement("language_pref_2");
$domain_technical_language_pref_2->appendChild($doc->createCDATASection($technical_language_pref_2));	
$technical->appendChild($domain_technical_language_pref_2);	
$domain_technical_shielding = $doc->createElement("shielding");	
$domain_technical_shielding->appendChild($doc->createCDATASection($technical_shielding));	
$technical->appendChild($domain_technical_shielding);
$domain_technical_properties = $doc->createElement("properties");
$domain_technical_properties->appendChild($doc->createCDATASection($technical_properties));	
$technical->appendChild($domain_technical_properties);	
$domain_technical_remark_values = $doc->createElement("remark_values");
$domain_technical_remark_values->appendChild($doc->createCDATASection($technical_remark_values));	
$technical->appendChild($domain_technical_remark_values);
$domain->appendChild($technical);
	
$billing = $doc->createElement("billing");
$domain->appendChild($billing);
$domain_billing_handle = $doc->createElement("handle");
$domain_billing_handle->appendChild($doc->createCDATASection($billing_handle));	
$billing->appendChild($domain_billing_handle);
$domain_billing_organization_type = $doc->createElement("organization_type");
$domain_billing_organization_type->appendChild($doc->createCDATASection($billing_organization_type));
$billing->appendChild($domain_billing_organization_type);
$domain_billing_organization_name = $doc->createElement("organization_name");
$domain_billing_organization_name->appendChild($doc->createCDATASection($billing_organization_name));
$billing->appendChild($domain_billing_organization_name);		
$domain_billing_presented_name = $doc->createElement("presented_name");
$domain_billing_presented_name->appendChild($doc->createCDATASection($billing_presented_name));	
$billing->appendChild($domain_billing_presented_name);
$domain_billing_kind = $doc->createElement("kind");
$domain_billing_kind->appendChild($doc->createCDATASection($billing_kind));	
$billing->appendChild($domain_billing_kind);	
$domain_billing_name = $doc->createElement("name");
$domain_billing_name->appendChild($doc->createCDATASection($billing_name));	
$billing->appendChild($domain_billing_name);	
$domain_billing_email = $doc->createElement("email");
$domain_billing_email->appendChild($doc->createCDATASection($billing_email));	
$billing->appendChild($domain_billing_email);	
$domain_billing_telephone = $doc->createElement("tel");
$domain_billing_telephone->appendChild($doc->createCDATASection($billing_telephone));	
$billing->appendChild($domain_billing_telephone);
$domain_billing_country_code = $doc->createElement("country_code");
$domain_billing_country_code->appendChild($doc->createCDATASection($billing_country_code));
$billing->appendChild($domain_billing_country_code);	
$domain_billing_street = $doc->createElement("street");
$domain_billing_street->appendChild($doc->createCDATASection($billing_street));	
$billing->appendChild($domain_billing_street);
$domain_billing_city = $doc->createElement("city");
$domain_billing_city->appendChild($doc->createCDATASection($billing_city));	
$billing->appendChild($domain_billing_city);
$domain_billing_state_province = $doc->createElement("state_province");
$domain_billing_state_province->appendChild($doc->createCDATASection($billing_state_province));
$billing->appendChild($domain_billing_state_province);
$domain_billing_postal_code = $doc->createElement("postal_code");
$domain_billing_postal_code->appendChild($doc->createCDATASection($billing_postal_code));
$billing->appendChild($domain_billing_postal_code);	
$domain_billing_country_name = $doc->createElement("country_name");
$domain_billing_country_name->appendChild($doc->createCDATASection($billing_country_name));
$billing->appendChild($domain_billing_country_name);	
$domain_billing_language_pref_1 = $doc->createElement("language_pref_1");
$domain_billing_language_pref_1->appendChild($doc->createCDATASection($billing_language_pref_1));	
$billing->appendChild($domain_billing_language_pref_1);
$domain_billing_language_pref_2 = $doc->createElement("language_pref_2");
$domain_billing_language_pref_2->appendChild($doc->createCDATASection($billing_language_pref_2));	
$billing->appendChild($domain_billing_language_pref_2);	
$domain_billing_shielding = $doc->createElement("shielding");	
$domain_billing_shielding->appendChild($doc->createCDATASection($billing_shielding));	
$billing->appendChild($domain_billing_shielding);
$domain_billing_properties = $doc->createElement("properties");
$domain_billing_properties->appendChild($doc->createCDATASection($billing_properties));	
$billing->appendChild($domain_billing_properties);
$domain_billing_remark_values = $doc->createElement("remark_values");
$domain_billing_remark_values->appendChild($doc->createCDATASection($billing_remark_values));	
$billing->appendChild($domain_billing_remark_values);	
$domain->appendChild($billing);	

$reseller = $doc->createElement("reseller");
$domain->appendChild($reseller);
$domain_reseller_handle = $doc->createElement("handle");
$domain_reseller_handle->appendChild($doc->createCDATASection($reseller_handle));	
$reseller->appendChild($domain_reseller_handle);
$domain_reseller_organization_type = $doc->createElement("organization_type");
$domain_reseller_organization_type->appendChild($doc->createCDATASection($reseller_organization_type));
$reseller->appendChild($domain_reseller_organization_type);
$domain_reseller_organization_name = $doc->createElement("organization_name");
$domain_reseller_organization_name->appendChild($doc->createCDATASection($reseller_organization_name));
$reseller->appendChild($domain_reseller_organization_name);	
$domain_reseller_presented_name = $doc->createElement("presented_name");
$domain_reseller_presented_name->appendChild($doc->createCDATASection($reseller_presented_name));	
$reseller->appendChild($domain_reseller_presented_name);
$domain_reseller_kind = $doc->createElement("kind");
$domain_reseller_kind->appendChild($doc->createCDATASection($reseller_kind));	
$reseller->appendChild($domain_reseller_kind);		
$domain_reseller_name = $doc->createElement("name");
$domain_reseller_name->appendChild($doc->createCDATASection($reseller_name));	
$reseller->appendChild($domain_reseller_name);
$domain_reseller_email = $doc->createElement("email");
$domain_reseller_email->appendChild($doc->createCDATASection($reseller_email));	
$reseller->appendChild($domain_reseller_email);	
$domain_reseller_telephone = $doc->createElement("tel");
$domain_reseller_telephone->appendChild($doc->createCDATASection($reseller_telephone));	
$reseller->appendChild($domain_reseller_telephone);
$domain_reseller_country_code = $doc->createElement("country_code");
$domain_reseller_country_code->appendChild($doc->createCDATASection($reseller_country_code));
$reseller->appendChild($domain_reseller_country_code);	
$domain_reseller_street = $doc->createElement("street");
$domain_reseller_street->appendChild($doc->createCDATASection($reseller_street));	
$reseller->appendChild($domain_reseller_street);
$domain_reseller_city = $doc->createElement("city");
$domain_reseller_city->appendChild($doc->createCDATASection($reseller_city));	
$reseller->appendChild($domain_reseller_city);
$domain_reseller_state_province = $doc->createElement("state_province");
$domain_reseller_state_province->appendChild($doc->createCDATASection($reseller_state_province));
$reseller->appendChild($domain_reseller_state_province);
$domain_reseller_postal_code = $doc->createElement("postal_code");
$domain_reseller_postal_code->appendChild($doc->createCDATASection($reseller_postal_code));
$reseller->appendChild($domain_reseller_postal_code);
$domain_reseller_country_name = $doc->createElement("country_name");
$domain_reseller_country_name->appendChild($doc->createCDATASection($reseller_country_name));	
$reseller->appendChild($domain_reseller_country_name);	
$domain_reseller_language_pref_1 = $doc->createElement("language_pref_1");
$domain_reseller_language_pref_1->appendChild($doc->createCDATASection($reseller_language_pref_1));	
$reseller->appendChild($domain_reseller_language_pref_1);
$domain_reseller_language_pref_2 = $doc->createElement("language_pref_2");
$domain_reseller_language_pref_2->appendChild($doc->createCDATASection($reseller_language_pref_2));	
$reseller->appendChild($domain_reseller_language_pref_2);	
$domain_reseller_shielding = $doc->createElement("shielding");	
$domain_reseller_shielding->appendChild($doc->createCDATASection($reseller_shielding));	
$reseller->appendChild($domain_reseller_shielding);
$domain_reseller_status_values = $doc->createElement("status_values");
$domain_reseller_status_values->appendChild($doc->createCDATASection($reseller_status_values));	
$reseller->appendChild($domain_reseller_status_values);
$domain_reseller_event_registration = $doc->createElement("event_registration");
$domain_reseller_event_registration->appendChild($doc->createCDATASection($reseller_registration));	
$reseller->appendChild($domain_reseller_event_registration);
$domain_reseller_event_last_transferred = $doc->createElement("event_last_transferred");
$domain_reseller_event_last_transferred->appendChild($doc->createCDATASection($reseller_last_transferred));	
$reseller->appendChild($domain_reseller_event_last_transferred);
$domain_reseller_event_last_changed = $doc->createElement("event_last_changed");
$domain_reseller_event_last_changed->appendChild($doc->createCDATASection($reseller_last_changed));	
$reseller->appendChild($domain_reseller_event_last_changed);	
$domain_reseller_event_expiration = $doc->createElement("event_expiration");
$domain_reseller_event_expiration->appendChild($doc->createCDATASection($reseller_expiration));	
$reseller->appendChild($domain_reseller_event_expiration);
$domain_reseller_event_deletion = $doc->createElement("event_deletion");
$domain_reseller_event_deletion->appendChild($doc->createCDATASection($reseller_deletion));	
$reseller->appendChild($domain_reseller_event_deletion);	
$domain_reseller_event_last_uploaded = $doc->createElement("event_last_uploaded");
$domain_reseller_event_last_uploaded->appendChild($doc->createCDATASection($reseller_last_uploaded));	
$reseller->appendChild($domain_reseller_event_last_uploaded);
$domain_reseller_properties = $doc->createElement("properties");
$domain_reseller_properties->appendChild($doc->createCDATASection($reseller_properties));	
$reseller->appendChild($domain_reseller_properties);
$domain_reseller_remark_values = $doc->createElement("remark_values");
$domain_reseller_remark_values->appendChild($doc->createCDATASection($reseller_remark_values));	
$reseller->appendChild($domain_reseller_remark_values);		
$domain->appendChild($reseller);	
	
$registrar = $doc->createElement("registrar");
$domain->appendChild($registrar);
$domain_registrar_handle = $doc->createElement("handle");
$domain_registrar_handle->appendChild($doc->createCDATASection($registrar_handle));	
$registrar->appendChild($domain_registrar_handle);
$domain_registrar_organization_type = $doc->createElement("organization_type");
$domain_registrar_organization_type->appendChild($doc->createCDATASection($registrar_organization_type));
$registrar->appendChild($domain_registrar_organization_type);
$domain_registrar_organization_name = $doc->createElement("organization_name");
$domain_registrar_organization_name->appendChild($doc->createCDATASection($registrar_organization_name));
$registrar->appendChild($domain_registrar_organization_name);	
$domain_registrar_presented_name = $doc->createElement("presented_name");
$domain_registrar_presented_name->appendChild($doc->createCDATASection($registrar_presented_name));	
$registrar->appendChild($domain_registrar_presented_name);
$domain_registrar_kind = $doc->createElement("kind");
$domain_registrar_kind->appendChild($doc->createCDATASection($registrar_kind));	
$registrar->appendChild($domain_registrar_kind);	
$domain_registrar_name = $doc->createElement("name");
$domain_registrar_name->appendChild($doc->createCDATASection($registrar_name));	
$registrar->appendChild($domain_registrar_name);
$domain_registrar_email = $doc->createElement("email");
$domain_registrar_email->appendChild($doc->createCDATASection($registrar_email));	
$registrar->appendChild($domain_registrar_email);	
$domain_registrar_telephone = $doc->createElement("tel");
$domain_registrar_telephone->appendChild($doc->createCDATASection($registrar_telephone));	
$registrar->appendChild($domain_registrar_telephone);
$domain_registrar_country_code = $doc->createElement("country_code");
$domain_registrar_country_code->appendChild($doc->createCDATASection($registrar_country_code));
$registrar->appendChild($domain_registrar_country_code);	
$domain_registrar_street = $doc->createElement("street");
$domain_registrar_street->appendChild($doc->createCDATASection($registrar_street));	
$registrar->appendChild($domain_registrar_street);
$domain_registrar_city = $doc->createElement("city");
$domain_registrar_city->appendChild($doc->createCDATASection($registrar_city));	
$registrar->appendChild($domain_registrar_city);
$domain_registrar_state_province = $doc->createElement("state_province");
$domain_registrar_state_province->appendChild($doc->createCDATASection($registrar_state_province));
$registrar->appendChild($domain_registrar_state_province);
$domain_registrar_postal_code = $doc->createElement("postal_code");
$domain_registrar_postal_code->appendChild($doc->createCDATASection($registrar_postal_code));
$registrar->appendChild($domain_registrar_postal_code);
$domain_registrar_country_name = $doc->createElement("country_name");
$domain_registrar_country_name->appendChild($doc->createCDATASection($registrar_country_name));	
$registrar->appendChild($domain_registrar_country_name);	
$domain_registrar_language_pref_1 = $doc->createElement("language_pref_1");
$domain_registrar_language_pref_1->appendChild($doc->createCDATASection($registrar_language_pref_1));	
$registrar->appendChild($domain_registrar_language_pref_1);
$domain_registrar_language_pref_2 = $doc->createElement("language_pref_2");
$domain_registrar_language_pref_2->appendChild($doc->createCDATASection($registrar_language_pref_2));	
$registrar->appendChild($domain_registrar_language_pref_2);	
$domain_registrar_shielding = $doc->createElement("shielding");	
$domain_registrar_shielding->appendChild($doc->createCDATASection($registrar_shielding));	
$registrar->appendChild($domain_registrar_shielding);	
$domain_registrar_status_values = $doc->createElement("status_values");
$domain_registrar_status_values->appendChild($doc->createCDATASection($registrar_status_values));	
$registrar->appendChild($domain_registrar_status_values);	
$domain_registrar_event_registration = $doc->createElement("event_registration");
$domain_registrar_event_registration->appendChild($doc->createCDATASection($registrar_registration));	
$registrar->appendChild($domain_registrar_event_registration);
$domain_registrar_event_last_transferred = $doc->createElement("event_last_transferred");
$domain_registrar_event_last_transferred->appendChild($doc->createCDATASection($registrar_last_transferred));	
$registrar->appendChild($domain_registrar_event_last_transferred);
$domain_registrar_event_last_changed = $doc->createElement("event_last_changed");
$domain_registrar_event_last_changed->appendChild($doc->createCDATASection($registrar_last_changed));	
$registrar->appendChild($domain_registrar_event_last_changed);	
$domain_registrar_event_expiration = $doc->createElement("event_expiration");
$domain_registrar_event_expiration->appendChild($doc->createCDATASection($registrar_expiration));	
$registrar->appendChild($domain_registrar_event_expiration);
$domain_registrar_event_deletion = $doc->createElement("event_deletion");
$domain_registrar_event_deletion->appendChild($doc->createCDATASection($registrar_deletion));	
$registrar->appendChild($domain_registrar_event_deletion);	
$domain_registrar_event_last_uploaded = $doc->createElement("event_last_uploaded");
$domain_registrar_event_last_uploaded->appendChild($doc->createCDATASection($registrar_last_uploaded));
$registrar->appendChild($domain_registrar_event_last_uploaded);	
$domain_registrar_properties = $doc->createElement("properties");
$domain_registrar_properties->appendChild($doc->createCDATASection($registrar_properties));	
$registrar->appendChild($domain_registrar_properties);
$domain_registrar_remark_values = $doc->createElement("remark_values");
$domain_registrar_remark_values->appendChild($doc->createCDATASection($registrar_remark_values));	
$registrar->appendChild($domain_registrar_remark_values);
$domain_registrar_abuse_organization_type = $doc->createElement("abuse_organization_type");
$domain_registrar_abuse_organization_type->appendChild($doc->createCDATASection($registrar_abuse_organization_type));
$registrar->appendChild($domain_registrar_abuse_organization_type);	
$domain_registrar_abuse_organization_name = $doc->createElement("abuse_organization_name");
$domain_registrar_abuse_organization_name->appendChild($doc->createCDATASection($registrar_abuse_organization_name));
$registrar->appendChild($domain_registrar_abuse_organization_name);	
$domain_registrar_abuse_presented_name = $doc->createElement("abuse_presented_name");
$domain_registrar_abuse_presented_name->appendChild($doc->createCDATASection($registrar_abuse_presented_name));	
$registrar->appendChild($domain_registrar_abuse_presented_name);	
$domain_registrar_abuse_email = $doc->createElement("abuse_email");
$domain_registrar_abuse_email->appendChild($doc->createCDATASection($registrar_abuse_email));	
$registrar->appendChild($domain_registrar_abuse_email);
$domain_registrar_abuse_telephone = $doc->createElement("abuse_telephone");
$domain_registrar_abuse_telephone->appendChild($doc->createCDATASection($registrar_abuse_telephone));	
$registrar->appendChild($domain_registrar_abuse_telephone);
$domain_registrar_abuse_country_code = $doc->createElement("abuse_country_code");
$domain_registrar_abuse_country_code->appendChild($doc->createCDATASection($registrar_abuse_country_code));	
$registrar->appendChild($domain_registrar_abuse_country_code);		
$domain->appendChild($registrar);
	
$name_servers = $doc->createElement("name_servers");
$domain->appendChild($name_servers);

$server_1 = $doc->createElement("server_1");
$name_servers->appendChild($server_1);	
$domain_server_name_1 = $doc->createElement("server_name");
$domain_server_name_1->appendChild($doc->createCDATASection($server_name_1));		
$server_1->appendChild($domain_server_name_1);
$domain_server_name_unicode_1 = $doc->createElement("server_name_unicode");
$domain_server_name_unicode_1->appendChild($doc->createCDATASection($server_name_unicode_1));
$server_1->appendChild($domain_server_name_unicode_1);	
$domain_server_delegation_check_1 = $doc->createElement("server_delegation_check");
$domain_server_delegation_check_1->appendChild($doc->createCDATASection($server_delegation_check_1));		
$server_1->appendChild($domain_server_delegation_check_1);
$domain_server_status_1 = $doc->createElement("server_status");
$domain_server_status_1->appendChild($doc->createCDATASection($server_status_1));		
$server_1->appendChild($domain_server_status_1);		
$domain_server_delegation_check_last_correct_1 = $doc->createElement("server_delegation_check_last_correct");
$domain_server_delegation_check_last_correct_1->appendChild($doc->createCDATASection($server_delegation_check_last_correct_1));		
$server_1->appendChild($domain_server_delegation_check_last_correct_1);	
$domain_server_ipv4_1 = $doc->createElement("server_ipv4");
$domain_server_ipv4_1->appendChild($doc->createCDATASection($server_ipv4_1));		
$server_1->appendChild($domain_server_ipv4_1);
$domain_server_ipv6_1 = $doc->createElement("server_ipv6");
$domain_server_ipv6_1->appendChild($doc->createCDATASection($server_ipv6_1));		
$server_1->appendChild($domain_server_ipv6_1);	
$name_servers->appendChild($server_1);
	
$server_2 = $doc->createElement("server_2");
$name_servers->appendChild($server_2);	
$domain_server_name_2 = $doc->createElement("server_name");
$domain_server_name_2->appendChild($doc->createCDATASection($server_name_2));		
$server_2->appendChild($domain_server_name_2);
$domain_server_name_unicode_2 = $doc->createElement("server_name_unicode");
$domain_server_name_unicode_2->appendChild($doc->createCDATASection($server_name_unicode_2));		
$server_2->appendChild($domain_server_name_unicode_2);
$domain_server_delegation_check_2 = $doc->createElement("server_delegation_check");
$domain_server_delegation_check_2->appendChild($doc->createCDATASection($server_delegation_check_2));		
$server_2->appendChild($domain_server_delegation_check_2);
$domain_server_status_2 = $doc->createElement("server_status");
$domain_server_status_2->appendChild($doc->createCDATASection($server_status_2));		
$server_2->appendChild($domain_server_status_2);		
$domain_server_delegation_check_last_correct_2 = $doc->createElement("server_delegation_check_last_correct");
$domain_server_delegation_check_last_correct_2->appendChild($doc->createCDATASection($server_delegation_check_last_correct_2));		
$server_2->appendChild($domain_server_delegation_check_last_correct_2);	
$domain_server_ipv4_2 = $doc->createElement("server_ipv4");
$domain_server_ipv4_2->appendChild($doc->createCDATASection($server_ipv4_2));		
$server_2->appendChild($domain_server_ipv4_2);
$domain_server_ipv6_2 = $doc->createElement("server_ipv6");
$domain_server_ipv6_2->appendChild($doc->createCDATASection($server_ipv6_2));		
$server_2->appendChild($domain_server_ipv6_2);	
$name_servers->appendChild($server_2);	
	
$server_3 = $doc->createElement("server_3");
$name_servers->appendChild($server_3);	
$domain_server_name_3 = $doc->createElement("server_name");
$domain_server_name_3->appendChild($doc->createCDATASection($server_name_3));		
$server_3->appendChild($domain_server_name_3);
$domain_server_name_unicode_3 = $doc->createElement("server_name_unicode");
$domain_server_name_unicode_3->appendChild($doc->createCDATASection($server_name_unicode_3));		
$server_3->appendChild($domain_server_name_unicode_3);
$domain_server_delegation_check_3 = $doc->createElement("server_delegation_check");
$domain_server_delegation_check_3->appendChild($doc->createCDATASection($server_delegation_check_3));		
$server_3->appendChild($domain_server_delegation_check_3);
$domain_server_status_3 = $doc->createElement("server_status");
$domain_server_status_3->appendChild($doc->createCDATASection($server_status_3));		
$server_3->appendChild($domain_server_status_3);		
$domain_server_delegation_check_last_correct_3 = $doc->createElement("server_delegation_check_last_correct");
$domain_server_delegation_check_last_correct_3->appendChild($doc->createCDATASection($server_delegation_check_last_correct_3));		
$server_3->appendChild($domain_server_delegation_check_last_correct_3);	
$domain_server_ipv4_3 = $doc->createElement("server_ipv4");
$domain_server_ipv4_3->appendChild($doc->createCDATASection($server_ipv4_3));		
$server_3->appendChild($domain_server_ipv4_3);
$domain_server_ipv6_3 = $doc->createElement("server_ipv6");
$domain_server_ipv6_3->appendChild($doc->createCDATASection($server_ipv6_3));		
$server_3->appendChild($domain_server_ipv6_3);		
$name_servers->appendChild($server_3);
	
$server_4 = $doc->createElement("server_4");
$name_servers->appendChild($server_4);	
$domain_server_name_4 = $doc->createElement("server_name");
$domain_server_name_4->appendChild($doc->createCDATASection($server_name_4));		
$server_4->appendChild($domain_server_name_4);
$domain_server_name_unicode_4 = $doc->createElement("server_name_unicode");
$domain_server_name_unicode_4->appendChild($doc->createCDATASection($server_name_unicode_4));		
$server_4->appendChild($domain_server_name_unicode_4);
$domain_server_delegation_check_4 = $doc->createElement("server_delegation_check");
$domain_server_delegation_check_4->appendChild($doc->createCDATASection($server_delegation_check_4));		
$server_4->appendChild($domain_server_delegation_check_4);
$domain_server_status_4 = $doc->createElement("server_status");
$domain_server_status_4->appendChild($doc->createCDATASection($server_status_4));		
$server_4->appendChild($domain_server_status_4);		
$domain_server_delegation_check_last_correct_4 = $doc->createElement("server_delegation_check_last_correct");
$domain_server_delegation_check_last_correct_4->appendChild($doc->createCDATASection($server_delegation_check_last_correct_4));		
$server_4->appendChild($domain_server_delegation_check_last_correct_4);	
$domain_server_ipv4_4 = $doc->createElement("server_ipv4");
$domain_server_ipv4_4->appendChild($doc->createCDATASection($server_ipv4_4));		
$server_4->appendChild($domain_server_ipv4_4);
$domain_server_ipv6_4 = $doc->createElement("server_ipv6");
$domain_server_ipv6_4->appendChild($doc->createCDATASection($server_ipv6_4));		
$server_4->appendChild($domain_server_ipv6_4);		
$name_servers->appendChild($server_4);
	
$server_5 = $doc->createElement("server_5");
$name_servers->appendChild($server_5);	
$domain_server_name_5 = $doc->createElement("server_name");
$domain_server_name_5->appendChild($doc->createCDATASection($server_name_5));		
$server_5->appendChild($domain_server_name_5);
$domain_server_name_unicode_5 = $doc->createElement("server_name_unicode");
$domain_server_name_unicode_5->appendChild($doc->createCDATASection($server_name_unicode_5));		
$server_5->appendChild($domain_server_name_unicode_5);
$domain_server_delegation_check_5 = $doc->createElement("server_delegation_check");
$domain_server_delegation_check_5->appendChild($doc->createCDATASection($server_delegation_check_5));		
$server_5->appendChild($domain_server_delegation_check_5);
$domain_server_status_5 = $doc->createElement("server_status");
$domain_server_status_5->appendChild($doc->createCDATASection($server_status_5));		
$server_5->appendChild($domain_server_status_5);		
$domain_server_delegation_check_last_correct_5 = $doc->createElement("server_delegation_check_last_correct");
$domain_server_delegation_check_last_correct_5->appendChild($doc->createCDATASection($server_delegation_check_last_correct_5));		
$server_5->appendChild($domain_server_delegation_check_last_correct_5);	
$domain_server_ipv4_5 = $doc->createElement("server_ipv4");
$domain_server_ipv4_5->appendChild($doc->createCDATASection($server_ipv4_5));		
$server_5->appendChild($domain_server_ipv4_5);
$domain_server_ipv6_5 = $doc->createElement("server_ipv6");
$domain_server_ipv6_5->appendChild($doc->createCDATASection($server_ipv6_5));		
$server_5->appendChild($domain_server_ipv6_5);		
$name_servers->appendChild($server_5);
$server_6 = $doc->createElement("server_6");
$name_servers->appendChild($server_6);	
$domain_server_name_6 = $doc->createElement("server_name");
$domain_server_name_6->appendChild($doc->createCDATASection($server_name_6));		
$server_6->appendChild($domain_server_name_6);
$domain_server_name_unicode_6 = $doc->createElement("server_name_unicode");
$domain_server_name_unicode_6->appendChild($doc->createCDATASection($server_name_unicode_6));		
$server_6->appendChild($domain_server_name_unicode_6);
$domain_server_delegation_check_6 = $doc->createElement("server_delegation_check");
$domain_server_delegation_check_6->appendChild($doc->createCDATASection($server_delegation_check_6));		
$server_6->appendChild($domain_server_delegation_check_6);
$domain_server_status_6 = $doc->createElement("server_status");
$domain_server_status_6->appendChild($doc->createCDATASection($server_status_6));		
$server_6->appendChild($domain_server_status_6);		
$domain_server_delegation_check_last_correct_6 = $doc->createElement("server_delegation_check_last_correct");
$domain_server_delegation_check_last_correct_6->appendChild($doc->createCDATASection($server_delegation_check_last_correct_6));		
$server_6->appendChild($domain_server_delegation_check_last_correct_6);
$domain_server_ipv4_6 = $doc->createElement("server_ipv4");
$domain_server_ipv4_6->appendChild($doc->createCDATASection($server_ipv4_6));		
$server_6->appendChild($domain_server_ipv4_6);
$domain_server_ipv6_6 = $doc->createElement("server_ipv6");
$domain_server_ipv6_6->appendChild($doc->createCDATASection($server_ipv6_6));		
$server_6->appendChild($domain_server_ipv6_6);		
$name_servers->appendChild($server_6);	
	
$domain_name_servers_dnssec = $doc->createElement("dnssec");
$domain_name_servers_dnssec->appendChild($doc->createCDATASection($name_servers_dnssec));	
$name_servers->appendChild($domain_name_servers_dnssec);
$domain_name_servers_dnssec_algorithm = $doc->createElement("dnssec_algorithm");
$domain_name_servers_dnssec_algorithm->appendChild($doc->createCDATASection($name_servers_dnssec_algorithm));	
$name_servers->appendChild($domain_name_servers_dnssec_algorithm);	
	
$domain->appendChild($name_servers);
	
$domain_raw_whois_data = $doc->createElement("raw_whois_data");	
$domain_raw_whois_data->appendChild($doc->createCDATASection($raw_whois_data));		
$domain->appendChild($domain_raw_whois_data);
	
$domain_raw_rdap_data = $doc->createElement("raw_rdap_data");	
$domain_raw_rdap_data->appendChild($doc->createCDATASection($raw_rdap_data));
$domain->appendChild($domain_raw_rdap_data);	
	
$domains->appendChild($domain);
$doc->appendChild($domains);
//return $doc->saveXML(NULL, LIBXML_NOEMPTYTAG);
return $doc->saveXML();
}
?>