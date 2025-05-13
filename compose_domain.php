<?php
//$_GET['domain'] = 'hostingtool.nl';
//$_GET['domain'] = 'münchen.de';
//$_GET['domain'] = 'example.tel';
//$_GET['domain'] = 'nic.frl';
//$_GET['domain'] = 'nic.br';
//$_GET['domain'] = 'fryslan.frl';
//$_GET['domain'] = 'example.ovh';
//$_GET['domain'] = 'icann.com';
//$_GET['domain'] = 'icann.org';
//$_GET['domain'] = 'team.blue';
//$_GET['domain'] = 'france.fr';
//$_GET['domain'] = 'cira.ca';

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
		
if ($inputbatch)	{
	$raw_whois_data = '';
}
else	{
	//$command = escapeshellcmd("python3.9 /home/admin/get_domain_data.py");
	$command = escapeshellcmd("/usr/bin/python3.9 /home/admin/get_domain_data.py");
	//$raw_whois_data = shell_exec($command . " " . $inputdomain . " 2>&1");
	$raw_whois_data = nl2br(htmlspecialchars(shell_exec($command . " " . $inputdomain)));
}
$top_level_domain = mb_substr($inputdomain, strrpos($inputdomain, '.') + 1);

$url = '';	
switch ($top_level_domain) {
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
	
$root_zones_url = 'https://www.iana.org/domains/root/db';
$accredited_registrars_url = 'https://www.iana.org/assignments/registrar-ids/registrar-ids.xhtml';
$lookup_endpoints_url = 'https://data.iana.org/rdap/dns.json';
if (!strlen($url))	{
	$rdap = json_decode(file_get_contents($lookup_endpoints_url), true);
	$temp_key = -1;
	foreach($rdap as $key1 => $value1) {
    	foreach($value1 as $key2 => $value2) {
			foreach($value2 as $key3 => $value3) {				
				foreach($value3 as $key4 => $value4) {
					if ($key3 == 0 and $value4 == $top_level_domain)	{
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
if ($top_level_domain == 'nl')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$sponsoring_organization_name = '';
	$country_code_designated_manager = 'Stichting Internet Domeinregistratie Nederland';
	$registry_operator_organization_name = 'Stichting Internet Domeinregistratie Nederland';
	$registry_operator_presented_name = '';
	$backend_operator_organization_name = 'SIDN B.V.';
	$backend_operator_presented_name = '';
	$restrictions_url = 'https://www.sidn.nl/en/nl-domain-name/sidn-and-privacy';
	$menu_url = 'https://www.sidn.nl/en/theme/domain-names';
	$registrant_web_id = 'NL88COMM01234567890123456789012345';
}
elseif ($top_level_domain == 'frl')	{
	$tld_category = 'gTLD';
	$tld_type = 'geoTLD';
	$sponsoring_organization_name = 'FRLregistry B.V.';
	$country_code_designated_manager = '';
	$registry_operator_organization_name = 'FRLregistry B.V.';
	$registry_operator_presented_name = '';
	$backend_operator_organization_name = 'Team Internet Group PLC';
	$backend_operator_presented_name = 'CTO CentralNic';
	$restrictions_url = 'https://nic.frl/';
	$menu_url = 'https://nic.frl/';
	$registrant_web_id = 'NL88COMM01234567890123456789012345';
}
elseif ($top_level_domain == 'amsterdam')	{
	$tld_category = 'gTLD';
	$tld_type = 'geoTLD';
	$sponsoring_organization_name = 'Gemeente Amsterdam';
	$country_code_designated_manager = '';
	$registry_operator_organization_name = 'Stichting Internet Domeinregistratie Nederland';
	$registry_operator_presented_name = '';
	$backend_operator_organization_name = 'SIDN B.V.';
	$backend_operator_presented_name = '';
	$restrictions_url = 'https://www.sidn.nl/en/nl-domain-name/sidn-and-privacy';
	$menu_url = 'https://www.sidn.nl/en/theme/domain-names';
	$registrant_web_id = 'NL88COMM01234567890123456789012345';
}
elseif ($top_level_domain == 'politie')	{
	$tld_category = 'gTLD';
	$tld_type = 'Brand gTLD';
	$sponsoring_organization_name = 'Politie Nederland';
	$country_code_designated_manager = '';
	$registry_operator_organization_name = 'Stichting Internet Domeinregistratie Nederland';
	$registry_operator_presented_name = '';
	$backend_operator_organization_name = 'SIDN B.V.';
	$backend_operator_presented_name = '';
	$restrictions_url = 'https://www.sidn.nl/en/nl-domain-name/sidn-and-privacy';
	$menu_url = 'https://www.sidn.nl/en/theme/domain-names';
}
elseif ($top_level_domain == 'eu')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$sponsoring_organization_name = '';
	$country_code_designated_manager = 'EURid vzw/asbl';
	$registry_operator_organization_name = 'EURid vzw';
	$registry_operator_presented_name = '';
	$backend_operator_organization_name = 'EURid vzw';
	$backend_operator_presented_name = 'Technical Department';
	$restrictions_url = 'https://help.eurid.eu/hc/en-gb/';
	$menu_url = 'https://help.eurid.eu/hc/en-gb/';
	$registrant_web_id = '';
}
elseif ($top_level_domain == 'de')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$sponsoring_organization_name = '';
	$country_code_designated_manager = 'DENIC eG';
	$registry_operator_organization_name = 'DENIC eG';
	$registry_operator_presented_name = 'Vorstand';
	$backend_operator_organization_name = 'DENIC eG';
	$backend_operator_presented_name = 'Business Services';
	$restrictions_url = 'https://www.denic.de/';
	$menu_url = 'https://www.denic.de/';
	$registrant_web_id = '';
}
elseif ($top_level_domain == 'fr')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$sponsoring_organization_name = '';
	$country_code_designated_manager = 'Association Française pour le Nommage Internet en Coopération (A.F.N.I.C.)';
	$registry_operator_organization_name = 'Association Française pour le Nommage Internet en Coopération (A.F.N.I.C.)';
	$registry_operator_presented_name = '';
	$backend_operator_organization_name = 'Association Française pour le Nommage Internet en Coopération (A.F.N.I.C.)';
	$backend_operator_presented_name = '';
	$restrictions_url = 'https://www.afnic.fr/';
	$menu_url = 'https://www.afnic.fr/';
	$registrant_web_id = '';
}
elseif ($top_level_domain == 'ch')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$sponsoring_organization_name = '';
	$country_code_designated_manager = 'SWITCH Foundation';
	$registry_operator_organization_name = 'SWITCH Foundation';
	$registry_operator_presented_name = 'The Swiss Education & Research Network';
	$backend_operator_organization_name = 'SWITCH Foundation';
	$backend_operator_presented_name = 'The Swiss Education & Research Network';
	$restrictions_url = 'https://www.nic.ch/';
	$menu_url = 'https://www.nic.ch/';
	$registrant_web_id = '';
}	
elseif ($top_level_domain == 'li')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$sponsoring_organization_name = '';
	$country_code_designated_manager = 'SWITCH Foundation';
	$registry_operator_organization_name = 'SWITCH Foundation';
	$registry_operator_presented_name = 'The Swiss Education & Research Network';
	$backend_operator_organization_name = 'SWITCH Foundation';
	$backend_operator_presented_name = 'The Swiss Education & Research Network';
	$restrictions_url = 'https://www.nic.li/';
	$menu_url = 'https://www.nic.li/';
	$registrant_web_id = '';
}
elseif ($top_level_domain == 'be')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$sponsoring_organization_name = '';
	$country_code_designated_manager = 'DNS Belgium vzw/asbl';
	$registry_operator_organization_name = 'DNS Belgium vzw/asbl';
	$registry_operator_presented_name = '';
	$backend_operator_organization_name = 'DNS Belgium vzw/asbl';
	$backend_operator_presented_name = '';
	$restrictions_url = 'https://www.dnsbelgium.be/';
	$menu_url = 'https://www.dnsbelgium.be/';
	$registrant_web_id = '';
}
elseif ($top_level_domain == 'lu')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$sponsoring_organization_name = '';
	$country_code_designated_manager = 'RESTENA';
	$registry_operator_organization_name = 'Fondation RESTENA';
	$registry_operator_presented_name = '';
	$backend_operator_organization_name = 'Fondation RESTENA';
	$backend_operator_presented_name = 'NOC';
	$restrictions_url = 'https://restena.lu/';
	$menu_url = 'https://restena.lu/';
	$registrant_web_id = '';
}
elseif ($top_level_domain == 'uk')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$sponsoring_organization_name = '';
	$country_code_designated_manager = 'Nominet UK';
	$registry_operator_organization_name = 'Nominet UK';
	$registry_operator_presented_name = 'TLD Registry Services Management';
	$backend_operator_organization_name = 'Nominet UK';
	$backend_operator_presented_name = 'TLD Registry Services Technical';
	$restrictions_url = 'https://nominet.uk/';
	$menu_url = 'https://nominet.uk/';
	$registrant_web_id = '';
}	
else	{
	$tld_category = '';
	$tld_type = '';
	$sponsoring_organization_name = '';
	$country_code_designated_manager = '';
	$registry_operator_organization_name = '';
	$registry_operator_presented_name = '';
	$backend_operator_organization_name = '';
	$backend_operator_presented_name = '';
	$restrictions_url = '';
	$menu_url = '';
	$registrant_web_id = '';
}
$delegation_url = 'https://www.iana.org/domains/root/db/'.$top_level_domain.'.html';		
$language_codes = (is_array($obj['lang'])) ? implode(",<br />", $obj['lang']) : $obj['lang'];
if (!strlen($language_codes))	{
	$language_codes = 'None Specified';	
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
$registrar_public_ids = '';
$registrar_complaint_url = '';
$status_explanation_url = '';	
	
if ($notice_0_links_0_href == 'https://icann.org/wicf' or $notice_0_links_0_href == 'https://icann.org/wicf/')	$registrar_complaint_url = $notice_0_links_0_href;
if ($notice_1_links_0_href == 'https://icann.org/wicf' or $notice_1_links_0_href == 'https://icann.org/wicf/')	$registrar_complaint_url = $notice_1_links_0_href;
if ($notice_2_links_0_href == 'https://icann.org/wicf' or $notice_2_links_0_href == 'https://icann.org/wicf/')	$registrar_complaint_url = $notice_2_links_0_href;
if ($notice_3_links_0_href == 'https://icann.org/wicf' or $notice_3_links_0_href == 'https://icann.org/wicf/')	$registrar_complaint_url = $notice_3_links_0_href;
	
if ($notice_0_links_0_href == 'https://icann.org/epp' or $notice_0_links_0_href == 'https://icann.org/epp/')	$status_explanation_url = $notice_0_links_0_href;
if ($notice_1_links_0_href == 'https://icann.org/epp' or $notice_1_links_0_href == 'https://icann.org/epp/')	$status_explanation_url = $notice_1_links_0_href;
if ($notice_2_links_0_href == 'https://icann.org/epp' or $notice_2_links_0_href == 'https://icann.org/epp/')	$status_explanation_url = $notice_2_links_0_href;
if ($notice_3_links_0_href == 'https://icann.org/epp' or $notice_3_links_0_href == 'https://icann.org/epp/')	$status_explanation_url = $notice_3_links_0_href;	
	
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
elseif ($obj['secureDNS']['delegation_urlSigned'] === false)	{
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
$technical_email = '';
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
$abuse_organization_type = '';
$abuse_organization_name = '';
$abuse_presented_name = '';
$abuse_kind = '';
$abuse_email = 'Abuse contact email unavailable.';
$abuse_telephone = '';
$abuse_country_code = '';	

$server_name_ascii_1 = $obj['nameservers'][0]['ldhName'];
$server_name_ascii_2 = $obj['nameservers'][1]['ldhName'];
$server_name_ascii_3 = $obj['nameservers'][2]['ldhName'];
$server_name_ascii_4 = $obj['nameservers'][3]['ldhName'];
$server_name_ascii_5 = $obj['nameservers'][4]['ldhName'];
$server_name_ascii_6 = $obj['nameservers'][5]['ldhName'];	
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
					$remark_values .= "<br />";				
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
						$registrar_public_ids .= $value4['type'].': '.$value4['identifier']."<br />";
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
								$registrant_remark_values .= "<br />";				
							}
							$registrant_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;	
						}
						if ($key2 == $entity_administrative and $key3 == 'remarks')	{
							if (strlen($administrative_remark_values))	{
								$administrative_remark_values .= "<br />";				
							}
							$administrative_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;	
						}
						if ($key2 == $entity_technical and $key3 == 'remarks')	{
							if (strlen($technical_remark_values))	{
								$technical_remark_values .= "<br />";				
							}
							$technical_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;
						}
						if ($key2 == $entity_billing and $key3 == 'remarks')	{
							if (strlen($billing_remark_values))	{
								$billing_remark_values .= "<br />";				
							}
							$billing_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;	
						}
						if ($key2 == $entity_reseller and $key3 == 'remarks')	{
							if (strlen($reseller_remark_values))	{
								$reseller_remark_values .= "<br />";				
							}
							$reseller_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;
						}
						if ($key2 == $entity_registrar and $key3 == 'remarks')	{
							if (strlen($registrar_remark_values))	{
								$registrar_remark_values .= "<br />";				
							}
							$registrar_remark_values .= (is_array($value5)) ? $key5.': '.$value5 : $value5;
						}
						if ($key2 == $entity_sponsor and $key3 == 'remarks')	{
							if (strlen($sponsor_remark_values))	{
								$sponsor_remark_values .= "<br />";				
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
							$registrant_remark_values .= "<br />" . $value6 . ';';		
						}
						if ($key2 == $entity_reseller and $key3 == 'remarks')	{
							$reseller_remark_values .= "<br />" . $value6 . ';';	
						}
						if ($key2 == $entity_registrar and $key3 == 'remarks')	{
							$registrar_remark_values .= "<br />" . $value6 . ';';	
						}
						if ($key2 == $entity_sponsor and $key3 == 'remarks')	{
							$sponsor_remark_values .= "<br />" . $value6 . ';';	
						}
						foreach($value6 as $key7 => $value7)	{
							foreach($value7 as $key8 => $value8) {
								if ($key1 == 'entities' and $key2 == $entity_registrar and $key3 == 'entities' 
									and $key4 == $entity_key4_abuse and $key5 == 'vcardArray' and $key6 == 1)	{
									if ($value7[0] == 'org' and $value8 == 'org')	{
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
$arr = array();	
$arr[$inputdomain]['zone']['top_level_domain'] = $top_level_domain;
$arr[$inputdomain]['zone']['tld_category'] = $tld_category;
$arr[$inputdomain]['zone']['tld_type'] = $tld_type;
$arr[$inputdomain]['zone']['sponsoring_organization_name'] = $sponsoring_organization_name;
$arr[$inputdomain]['zone']['country_code_designated_manager'] = $country_code_designated_manager;
$arr[$inputdomain]['zone']['registry_operator_organization_name'] = $registry_operator_organization_name;
$arr[$inputdomain]['zone']['registry_operator_presented_name'] = $registry_operator_presented_name;
$arr[$inputdomain]['zone']['backend_operator_organization_name'] = $backend_operator_organization_name;
$arr[$inputdomain]['zone']['backend_operator_presented_name'] = $backend_operator_presented_name;
$arr[$inputdomain]['zone']['delegation_url'] = $delegation_url;	
$arr[$inputdomain]['zone']['restrictions_url'] = $restrictions_url;
$arr[$inputdomain]['zone']['menu_url'] = $menu_url;
$arr[$inputdomain]['zone']['language_codes'] = $language_codes;	
	
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

$arr[$inputdomain]['background']['object_class_name'] = $object_class_name;
$arr[$inputdomain]['background']['object_conformance'] = $object_conformance;	
$arr[$inputdomain]['background']['root_zones_url'] = $root_zones_url;
$arr[$inputdomain]['background']['accredited_registrars_url'] = $accredited_registrars_url;
$arr[$inputdomain]['background']['lookup_endpoints_url'] = $lookup_endpoints_url;
	
$arr[$inputdomain]['resources']['registry_source'] = $url;		
$arr[$inputdomain]['resources']['registrar_source'] = $url_registrar;
$arr[$inputdomain]['resources']['registrar_public_ids'] = $registrar_public_ids;	
$arr[$inputdomain]['resources']['registrar_complaint_url'] = $registrar_complaint_url;		
$arr[$inputdomain]['resources']['status_explanation_url'] = $status_explanation_url;	
	
$arr[$inputdomain]['details']['handle'] = $handle;
$arr[$inputdomain]['details']['name_ascii'] = $name_ascii;	
$arr[$inputdomain]['details']['name_unicode'] = $name_unicode;
$arr[$inputdomain]['details']['status_values'] = $status_values;	
$arr[$inputdomain]['details']['event_registration'] = $registration;	
$arr[$inputdomain]['details']['event_last_transferred'] = $last_transferred;
$arr[$inputdomain]['details']['event_last_changed'] = $last_changed;
$arr[$inputdomain]['details']['event_expiration'] = $expiration;
$arr[$inputdomain]['details']['event_deletion'] = $deletion;
$arr[$inputdomain]['details']['event_last_uploaded'] = $last_uploaded;
$arr[$inputdomain]['details']['extensions_values'] = $extensions_values;
$arr[$inputdomain]['details']['remark_values'] = $remark_values;	
	
$arr[$inputdomain]['sponsor']['handle'] = $sponsor_handle;
$arr[$inputdomain]['sponsor']['web_id'] = $sponsor_web_id;		
$arr[$inputdomain]['sponsor']['organization_type'] = $sponsor_organization_type;	
$arr[$inputdomain]['sponsor']['organization_name'] = $sponsor_organization_name;	
$arr[$inputdomain]['sponsor']['presented_name'] = $sponsor_presented_name;	
$arr[$inputdomain]['sponsor']['kind'] = $sponsor_kind;	
$arr[$inputdomain]['sponsor']['name'] = $sponsor_name;		
$arr[$inputdomain]['sponsor']['email'] = $sponsor_email;	
$arr[$inputdomain]['sponsor']['telephone'] = $sponsor_telephone;
$arr[$inputdomain]['sponsor']['country_code'] = $sponsor_country_code;		
$arr[$inputdomain]['sponsor']['street'] = $sponsor_street;
$arr[$inputdomain]['sponsor']['city'] = $sponsor_city;
$arr[$inputdomain]['sponsor']['state_province'] = $sponsor_state_province;
$arr[$inputdomain]['sponsor']['postal_code'] = $sponsor_postal_code;
$arr[$inputdomain]['sponsor']['country_name'] = $sponsor_country_name;	
$arr[$inputdomain]['sponsor']['language_pref_1'] = $sponsor_language_pref_1;	
$arr[$inputdomain]['sponsor']['language_pref_2'] = $sponsor_language_pref_2;
$arr[$inputdomain]['sponsor']['shielding'] = $sponsor_shielding;
$arr[$inputdomain]['sponsor']['status_values'] = $sponsor_status_values;
$arr[$inputdomain]['sponsor']['event_registration'] = $sponsor_registration;
$arr[$inputdomain]['sponsor']['event_last_transferred'] = $sponsor_last_transferred;	
$arr[$inputdomain]['sponsor']['event_last_changed'] = $sponsor_last_changed;
$arr[$inputdomain]['sponsor']['event_expiration'] = $sponsor_expiration;
$arr[$inputdomain]['sponsor']['event_deletion'] = $sponsor_deletion;	
$arr[$inputdomain]['sponsor']['event_last_uploaded'] = $sponsor_last_uploaded;
$arr[$inputdomain]['sponsor']['properties'] = $sponsor_properties;
$arr[$inputdomain]['sponsor']['remark_values'] = $sponsor_remark_values;
	
$arr[$inputdomain]['registrant']['handle'] = $registrant_handle;
$arr[$inputdomain]['registrant']['web_id'] = $registrant_web_id;		
$arr[$inputdomain]['registrant']['organization_type'] = $registrant_organization_type;	
$arr[$inputdomain]['registrant']['organization_name'] = $registrant_organization_name;	
$arr[$inputdomain]['registrant']['presented_name'] = $registrant_presented_name;	
$arr[$inputdomain]['registrant']['kind'] = $registrant_kind;	
$arr[$inputdomain]['registrant']['name'] = $registrant_name;		
$arr[$inputdomain]['registrant']['email'] = $registrant_email;	
$arr[$inputdomain]['registrant']['telephone'] = $registrant_telephone;
$arr[$inputdomain]['registrant']['country_code'] = $registrant_country_code;		
$arr[$inputdomain]['registrant']['street'] = $registrant_street;
$arr[$inputdomain]['registrant']['city'] = $registrant_city;
$arr[$inputdomain]['registrant']['state_province'] = $registrant_state_province;
$arr[$inputdomain]['registrant']['postal_code'] = $registrant_postal_code;
$arr[$inputdomain]['registrant']['country_name'] = $registrant_country_name;	
$arr[$inputdomain]['registrant']['language_pref_1'] = $registrant_language_pref_1;	
$arr[$inputdomain]['registrant']['language_pref_2'] = $registrant_language_pref_2;
$arr[$inputdomain]['registrant']['shielding'] = $registrant_shielding;
$arr[$inputdomain]['registrant']['status_values'] = $registrant_status_values;
$arr[$inputdomain]['registrant']['event_registration'] = $registrant_registration;
$arr[$inputdomain]['registrant']['event_last_transferred'] = $registrant_last_transferred;	
$arr[$inputdomain]['registrant']['event_last_changed'] = $registrant_last_changed;
$arr[$inputdomain]['registrant']['event_expiration'] = $registrant_expiration;
$arr[$inputdomain]['registrant']['event_deletion'] = $registrant_deletion;	
$arr[$inputdomain]['registrant']['event_last_uploaded'] = $registrant_last_uploaded;
$arr[$inputdomain]['registrant']['properties'] = $registrant_properties;
$arr[$inputdomain]['registrant']['remark_values'] = $registrant_remark_values;	
	
$arr[$inputdomain]['administrative']['handle'] = $administrative_handle;
$arr[$inputdomain]['administrative']['web_id'] = $administrative_web_id;		
$arr[$inputdomain]['administrative']['organization_type'] = $administrative_organization_type;	
$arr[$inputdomain]['administrative']['organization_name'] = $administrative_organization_name;	
$arr[$inputdomain]['administrative']['presented_name'] = $administrative_presented_name;	
$arr[$inputdomain]['administrative']['kind'] = $administrative_kind;	
$arr[$inputdomain]['administrative']['name'] = $administrative_name;		
$arr[$inputdomain]['administrative']['email'] = $administrative_email;	
$arr[$inputdomain]['administrative']['telephone'] = $administrative_telephone;
$arr[$inputdomain]['administrative']['country_code'] = $administrative_country_code;		
$arr[$inputdomain]['administrative']['street'] = $administrative_street;
$arr[$inputdomain]['administrative']['city'] = $administrative_city;
$arr[$inputdomain]['administrative']['state_province'] = $administrative_state_province;
$arr[$inputdomain]['administrative']['postal_code'] = $administrative_postal_code;
$arr[$inputdomain]['administrative']['country_name'] = $administrative_country_name;	
$arr[$inputdomain]['administrative']['language_pref_1'] = $administrative_language_pref_1;	
$arr[$inputdomain]['administrative']['language_pref_2'] = $administrative_language_pref_2;
$arr[$inputdomain]['administrative']['shielding'] = $administrative_shielding;
$arr[$inputdomain]['administrative']['status_values'] = $administrative_status_values;
$arr[$inputdomain]['administrative']['event_registration'] = $administrative_registration;
$arr[$inputdomain]['administrative']['event_last_transferred'] = $administrative_last_transferred;	
$arr[$inputdomain]['administrative']['event_last_changed'] = $administrative_last_changed;
$arr[$inputdomain]['administrative']['event_expiration'] = $administrative_expiration;
$arr[$inputdomain]['administrative']['event_deletion'] = $administrative_deletion;	
$arr[$inputdomain]['administrative']['event_last_uploaded'] = $administrative_last_uploaded;
$arr[$inputdomain]['administrative']['properties'] = $administrative_properties;
$arr[$inputdomain]['administrative']['remark_values'] = $administrative_remark_values;	

$arr[$inputdomain]['technical']['handle'] = $technical_handle;
$arr[$inputdomain]['technical']['web_id'] = $technical_web_id;		
$arr[$inputdomain]['technical']['organization_type'] = $technical_organization_type;	
$arr[$inputdomain]['technical']['organization_name'] = $technical_organization_name;	
$arr[$inputdomain]['technical']['presented_name'] = $technical_presented_name;	
$arr[$inputdomain]['technical']['kind'] = $technical_kind;	
$arr[$inputdomain]['technical']['name'] = $technical_name;		
$arr[$inputdomain]['technical']['email'] = $technical_email;	
$arr[$inputdomain]['technical']['telephone'] = $technical_telephone;
$arr[$inputdomain]['technical']['country_code'] = $technical_country_code;		
$arr[$inputdomain]['technical']['street'] = $technical_street;
$arr[$inputdomain]['technical']['city'] = $technical_city;
$arr[$inputdomain]['technical']['state_province'] = $technical_state_province;
$arr[$inputdomain]['technical']['postal_code'] = $technical_postal_code;
$arr[$inputdomain]['technical']['country_name'] = $technical_country_name;	
$arr[$inputdomain]['technical']['language_pref_1'] = $technical_language_pref_1;	
$arr[$inputdomain]['technical']['language_pref_2'] = $technical_language_pref_2;
$arr[$inputdomain]['technical']['shielding'] = $technical_shielding;
$arr[$inputdomain]['technical']['status_values'] = $technical_status_values;
$arr[$inputdomain]['technical']['event_registration'] = $technical_registration;
$arr[$inputdomain]['technical']['event_last_transferred'] = $technical_last_transferred;	
$arr[$inputdomain]['technical']['event_last_changed'] = $technical_last_changed;
$arr[$inputdomain]['technical']['event_expiration'] = $technical_expiration;
$arr[$inputdomain]['technical']['event_deletion'] = $technical_deletion;	
$arr[$inputdomain]['technical']['event_last_uploaded'] = $technical_last_uploaded;
$arr[$inputdomain]['technical']['properties'] = $technical_properties;
$arr[$inputdomain]['technical']['remark_values'] = $technical_remark_values;
	
$arr[$inputdomain]['billing']['handle'] = $billing_handle;
$arr[$inputdomain]['billing']['web_id'] = $billing_web_id;		
$arr[$inputdomain]['billing']['organization_type'] = $billing_organization_type;	
$arr[$inputdomain]['billing']['organization_name'] = $billing_organization_name;	
$arr[$inputdomain]['billing']['presented_name'] = $billing_presented_name;	
$arr[$inputdomain]['billing']['kind'] = $billing_kind;	
$arr[$inputdomain]['billing']['name'] = $billing_name;		
$arr[$inputdomain]['billing']['email'] = $billing_email;	
$arr[$inputdomain]['billing']['telephone'] = $billing_telephone;
$arr[$inputdomain]['billing']['country_code'] = $billing_country_code;		
$arr[$inputdomain]['billing']['street'] = $billing_street;
$arr[$inputdomain]['billing']['city'] = $billing_city;
$arr[$inputdomain]['billing']['state_province'] = $billing_state_province;
$arr[$inputdomain]['billing']['postal_code'] = $billing_postal_code;
$arr[$inputdomain]['billing']['country_name'] = $billing_country_name;	
$arr[$inputdomain]['billing']['language_pref_1'] = $billing_language_pref_1;	
$arr[$inputdomain]['billing']['language_pref_2'] = $billing_language_pref_2;
$arr[$inputdomain]['billing']['shielding'] = $billing_shielding;
$arr[$inputdomain]['billing']['status_values'] = $billing_status_values;
$arr[$inputdomain]['billing']['event_registration'] = $billing_registration;
$arr[$inputdomain]['billing']['event_last_transferred'] = $billing_last_transferred;	
$arr[$inputdomain]['billing']['event_last_changed'] = $billing_last_changed;
$arr[$inputdomain]['billing']['event_expiration'] = $billing_expiration;
$arr[$inputdomain]['billing']['event_deletion'] = $billing_deletion;	
$arr[$inputdomain]['billing']['event_last_uploaded'] = $billing_last_uploaded;
$arr[$inputdomain]['billing']['properties'] = $billing_properties;
$arr[$inputdomain]['billing']['remark_values'] = $billing_remark_values;	

$arr[$inputdomain]['reseller']['handle'] = $reseller_handle;
$arr[$inputdomain]['reseller']['web_id'] = $reseller_web_id;		
$arr[$inputdomain]['reseller']['organization_type'] = $reseller_organization_type;	
$arr[$inputdomain]['reseller']['organization_name'] = $reseller_organization_name;	
$arr[$inputdomain]['reseller']['presented_name'] = $reseller_presented_name;	
$arr[$inputdomain]['reseller']['kind'] = $reseller_kind;	
$arr[$inputdomain]['reseller']['name'] = $reseller_name;		
$arr[$inputdomain]['reseller']['email'] = $reseller_email;	
$arr[$inputdomain]['reseller']['telephone'] = $reseller_telephone;
$arr[$inputdomain]['reseller']['country_code'] = $reseller_country_code;		
$arr[$inputdomain]['reseller']['street'] = $reseller_street;
$arr[$inputdomain]['reseller']['city'] = $reseller_city;
$arr[$inputdomain]['reseller']['state_province'] = $reseller_state_province;
$arr[$inputdomain]['reseller']['postal_code'] = $reseller_postal_code;
$arr[$inputdomain]['reseller']['country_name'] = $reseller_country_name;	
$arr[$inputdomain]['reseller']['language_pref_1'] = $reseller_language_pref_1;	
$arr[$inputdomain]['reseller']['language_pref_2'] = $reseller_language_pref_2;
$arr[$inputdomain]['reseller']['shielding'] = $reseller_shielding;
$arr[$inputdomain]['reseller']['status_values'] = $reseller_status_values;
$arr[$inputdomain]['reseller']['event_registration'] = $reseller_registration;
$arr[$inputdomain]['reseller']['event_last_transferred'] = $reseller_last_transferred;	
$arr[$inputdomain]['reseller']['event_last_changed'] = $reseller_last_changed;
$arr[$inputdomain]['reseller']['event_expiration'] = $reseller_expiration;
$arr[$inputdomain]['reseller']['event_deletion'] = $reseller_deletion;	
$arr[$inputdomain]['reseller']['event_last_uploaded'] = $reseller_last_uploaded;
$arr[$inputdomain]['reseller']['properties'] = $reseller_properties;
$arr[$inputdomain]['reseller']['remark_values'] = $reseller_remark_values;	

$arr[$inputdomain]['registrar']['handle'] = $registrar_handle;
$arr[$inputdomain]['registrar']['web_id'] = $registrar_web_id;		
$arr[$inputdomain]['registrar']['organization_type'] = $registrar_organization_type;	
$arr[$inputdomain]['registrar']['organization_name'] = $registrar_organization_name;	
$arr[$inputdomain]['registrar']['presented_name'] = $registrar_presented_name;	
$arr[$inputdomain]['registrar']['kind'] = $registrar_kind;
$arr[$inputdomain]['registrar']['name'] = $registrar_name;		
$arr[$inputdomain]['registrar']['email'] = $registrar_email;	
$arr[$inputdomain]['registrar']['telephone'] = $registrar_telephone;
$arr[$inputdomain]['registrar']['country_code'] = $registrar_country_code;		
$arr[$inputdomain]['registrar']['street'] = $registrar_street;
$arr[$inputdomain]['registrar']['city'] = $registrar_city;
$arr[$inputdomain]['registrar']['state_province'] = $registrar_state_province;
$arr[$inputdomain]['registrar']['postal_code'] = $registrar_postal_code;
$arr[$inputdomain]['registrar']['country_name'] = $registrar_country_name;	
$arr[$inputdomain]['registrar']['language_pref_1'] = $registrar_language_pref_1;	
$arr[$inputdomain]['registrar']['language_pref_2'] = $registrar_language_pref_2;
$arr[$inputdomain]['registrar']['shielding'] = $registrar_shielding;
$arr[$inputdomain]['registrar']['status_values'] = $registrar_status_values;
$arr[$inputdomain]['registrar']['event_registration'] = $registrar_registration;
$arr[$inputdomain]['registrar']['event_last_transferred'] = $registrar_last_transferred;	
$arr[$inputdomain]['registrar']['event_last_changed'] = $registrar_last_changed;
$arr[$inputdomain]['registrar']['event_expiration'] = $registrar_expiration;
$arr[$inputdomain]['registrar']['event_deletion'] = $registrar_deletion;	
$arr[$inputdomain]['registrar']['event_last_uploaded'] = $registrar_last_uploaded;
$arr[$inputdomain]['registrar']['properties'] = $registrar_properties;
$arr[$inputdomain]['registrar']['remark_values'] = $registrar_remark_values;	

$arr[$inputdomain]['abuse']['organization_type'] = $abuse_organization_type;	
$arr[$inputdomain]['abuse']['organization_name'] = $abuse_organization_name;	
$arr[$inputdomain]['abuse']['presented_name'] = $abuse_presented_name;
$arr[$inputdomain]['abuse']['kind'] = $abuse_kind;
$arr[$inputdomain]['abuse']['email'] = $abuse_email;	
$arr[$inputdomain]['abuse']['telephone'] = $abuse_telephone;
$arr[$inputdomain]['abuse']['country_code'] = $abuse_country_code;	
	
$arr[$inputdomain]['name_servers']['server_1']['server_name_ascii'] = $server_name_ascii_1;	
$arr[$inputdomain]['name_servers']['server_1']['server_name_unicode'] = $server_name_unicode_1;	
$arr[$inputdomain]['name_servers']['server_1']['server_delegation_check'] = $server_delegation_check_1;	
$arr[$inputdomain]['name_servers']['server_1']['server_status'] = $server_status_1;	
$arr[$inputdomain]['name_servers']['server_1']['server_delegation_check_last_correct'] = $server_delegation_check_last_correct_1;	
$arr[$inputdomain]['name_servers']['server_1']['server_ipv4'] = $server_ipv4_1;	
$arr[$inputdomain]['name_servers']['server_1']['server_ipv6'] = $server_ipv6_1;	

$arr[$inputdomain]['name_servers']['server_2']['server_name_ascii'] = $server_name_ascii_2;	
$arr[$inputdomain]['name_servers']['server_2']['server_name_unicode'] = $server_name_unicode_2;	
$arr[$inputdomain]['name_servers']['server_2']['server_delegation_check'] = $server_delegation_check_2;	
$arr[$inputdomain]['name_servers']['server_2']['server_status'] = $server_status_2;	
$arr[$inputdomain]['name_servers']['server_2']['server_delegation_check_last_correct'] = $server_delegation_check_last_correct_2;	
$arr[$inputdomain]['name_servers']['server_2']['server_ipv4'] = $server_ipv4_2;	
$arr[$inputdomain]['name_servers']['server_2']['server_ipv6'] = $server_ipv6_2;
	
$arr[$inputdomain]['name_servers']['server_3']['server_name_ascii'] = $server_name_ascii_3;	
$arr[$inputdomain]['name_servers']['server_3']['server_name_unicode'] = $server_name_unicode_3;	
$arr[$inputdomain]['name_servers']['server_3']['server_delegation_check'] = $server_delegation_check_3;	
$arr[$inputdomain]['name_servers']['server_3']['server_status'] = $server_status_3;	
$arr[$inputdomain]['name_servers']['server_3']['server_delegation_check_last_correct'] = $server_delegation_check_last_correct_3;	
$arr[$inputdomain]['name_servers']['server_3']['server_ipv4'] = $server_ipv4_3;	
$arr[$inputdomain]['name_servers']['server_3']['server_ipv6'] = $server_ipv6_3;
	
$arr[$inputdomain]['name_servers']['server_4']['server_name_ascii'] = $server_name_ascii_4;	
$arr[$inputdomain]['name_servers']['server_4']['server_name_unicode'] = $server_name_unicode_4;	
$arr[$inputdomain]['name_servers']['server_4']['server_delegation_check'] = $server_delegation_check_4;	
$arr[$inputdomain]['name_servers']['server_4']['server_status'] = $server_status_4;	
$arr[$inputdomain]['name_servers']['server_4']['server_delegation_check_last_correct'] = $server_delegation_check_last_correct_4;	
$arr[$inputdomain]['name_servers']['server_4']['server_ipv4'] = $server_ipv4_4;	
$arr[$inputdomain]['name_servers']['server_4']['server_ipv6'] = $server_ipv6_4;	
	
$arr[$inputdomain]['name_servers']['server_5']['server_name_ascii'] = $server_name_ascii_5;	
$arr[$inputdomain]['name_servers']['server_5']['server_name_unicode'] = $server_name_unicode_5;	
$arr[$inputdomain]['name_servers']['server_5']['server_delegation_check'] = $server_delegation_check_5;	
$arr[$inputdomain]['name_servers']['server_5']['server_status'] = $server_status_5;	
$arr[$inputdomain]['name_servers']['server_5']['server_delegation_check_last_correct'] = $server_delegation_check_last_correct_5;	
$arr[$inputdomain]['name_servers']['server_5']['server_ipv4'] = $server_ipv4_5;	
$arr[$inputdomain]['name_servers']['server_5']['server_ipv6'] = $server_ipv6_5;
	
$arr[$inputdomain]['name_servers']['server_6']['server_name_ascii'] = $server_name_ascii_6;	
$arr[$inputdomain]['name_servers']['server_6']['server_name_unicode'] = $server_name_unicode_6;	
$arr[$inputdomain]['name_servers']['server_6']['server_delegation_check'] = $server_delegation_check_6;	
$arr[$inputdomain]['name_servers']['server_6']['server_status'] = $server_status_6;	
$arr[$inputdomain]['name_servers']['server_6']['server_delegation_check_last_correct'] = $server_delegation_check_last_correct_6;	
$arr[$inputdomain]['name_servers']['server_6']['server_ipv4'] = $server_ipv4_6;	
$arr[$inputdomain]['name_servers']['server_6']['server_ipv6'] = $server_ipv6_6;	
		
$arr[$inputdomain]['name_servers']['dnssec'] = $name_servers_dnssec;
$arr[$inputdomain]['name_servers']['dnssec_algorithm'] = $name_servers_dnssec_algorithm;
	
$arr[$inputdomain]['raw_whois'] = $raw_whois_data;	
$arr[$inputdomain]['raw_rdap'] = $raw_rdap_data;
	
return $arr;
}
?>