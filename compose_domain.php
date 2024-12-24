<?php
//$_GET['domain'] = 'hostingtool.nl';
//$_GET['domain'] = 'münchen.de';

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

function write_file($inputdomain, $inputbatch)	{
	
if ($inputbatch)	{
	$raw_whois_data = '';
}
else	{
	$command = escapeshellcmd("python3.9 /home/admin/get_domain_data.py");
	//$raw_whois_data = shell_exec($command . " " . $inputdomain . " 2>&1");
	$raw_whois_data = nl2br(shell_exec($command . " " . $inputdomain));
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
	$matched = false;
	$rdap = json_decode(file_get_contents('https://data.iana.org/rdap/dns.json'), true);
	$temp_tld = '';
	foreach($rdap as $key1 => $value1) {
    	foreach($value1 as $key2 => $value2) {
			foreach($value2 as $key3 => $value3) {
				foreach($value3 as $key4 => $value4) {
					if ($key3 == 0 and !$matched)	{
						$temp_tld = $value4;
					}
					if ($key3 == 1 and $zone_top_level_domain == $temp_tld and !$matched)	{
						$url = $value4;
						$matched = true;
					}	
				}
			}
		}
	}
}	
$url .= 'domain/'.$inputdomain;
$obj = json_decode(file_get_contents($url), true);
$rdap_conformance = $obj['rdapConformance'];
$object_class_name = $obj['objectClassName'];
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
	
if ($zone_top_level_domain == 'nl')	{
	$zone_registry_web_id = '';
	$zone_registry_full_name = 'SIDN B.V.';
	$zone_registry_website = 'https://www.sidn.nl';
	$zone_menu = 'https://regmenu.sidn.nl';
	$zone_support = 'support@sidn.nl';
	$registrant_web_id = 'NL88COMM01234567890123456789012345';
}
elseif ($zone_top_level_domain == 'frl')	{
	$zone_registry_web_id = '';
	$zone_registry_full_name = 'FRLregistry B.V.';
	$zone_registry_website = 'https://nic.frl';
	$zone_menu = 'https://regmenu.nic.frl';
	$zone_support = 'support@registreer.frl';
	$registrant_web_id = 'NL88COMM01234567890123456789012345';
}
elseif ($zone_top_level_domain == 'com' or $zone_top_level_domain == 'net')	{
	$zone_registry_web_id = '';
	$zone_registry_full_name = 'VeriSign, Inc.';
	$zone_registry_website = 'https://www.verisign.com/';
	$zone_menu = 'https://regmenu.verisign.com';
	$zone_support = 'info@verisign-grs.com';
	$registrant_web_id = '';
}
elseif ($zone_top_level_domain == 'org')	{
	$zone_registry_web_id = '';
	$zone_registry_full_name = 'Public Interest Registry (PIR)';
	$zone_registry_website = 'https://pir.org';
	$zone_menu = 'https://regmenu.pir.org';
	$zone_support = 'ops@pir.org';
	$registrant_web_id = '';
}
elseif ($zone_top_level_domain == 'uk')	{
	$zone_registry_web_id = '';
	$zone_registry_full_name = 'Nominet UK';
	$zone_registry_website = 'https://www.nominet.uk';
	$zone_menu = 'https://regmenu.nominet.uk';
	$zone_support = 'nominet@nominet.uk';
	$registrant_web_id = '';
}		
elseif ($zone_top_level_domain == 'ca')	{
	$zone_registry_web_id = '';
	$zone_registry_full_name = 'Canadian Internet Registration Authority (CIRA)';
	$zone_registry_website = 'https://www.cira.ca';
	$zone_menu = 'https://regmenu.cira.ca';
	$zone_support = 'info@cira.ca';
	$registrant_web_id = '';
}	
else	{
	$zone_registry_web_id = '';
	$zone_registry_full_name = '';
	$zone_registry_website = '';
	$zone_menu = '';
	$zone_support = '';
	$registrant_web_id = '';
}
if (strlen($obj['lang']))	{
	$zone_registry_language = $obj['lang'];	
}
else	{
	$zone_registry_language = '(hidden)';	
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
$registrant_remark_values = '';		
$reseller_status_values = '';
$reseller_registration = null;
$reseller_last_transferred = null;	
$reseller_last_changed = null;
$reseller_expiration = null;	
$reseller_deletion = null;
$reseller_remark_values = '';	
$registrar_status_values = '';	
$registrar_registration = null;
$registrar_last_transferred = null;	
$registrar_last_changed = null;
$registrar_expiration = null;	
$registrar_deletion = null;
$registrar_iana_id = '';		
$registrar_remark_values = '';	
$sponsor_status_values = '';
$sponsor_registration = null;
$sponsor_last_transferred = null;	
$sponsor_last_changed = null;
$sponsor_expiration = null;	
$sponsor_deletion = null;
$sponsor_remark_values = '';
$handle = $obj['handle']; 	
$name_ascii = $obj['ldhName'];
$name_unicode = $obj['unicodeName'];
$name_servers_dnssec = '(not available)';
$name_servers_dnssec_algorithm = '(not applicable)';
if (empty($obj['secureDNS']['delegationSigned']))	{
}	
elseif ($obj['secureDNS']['delegationSigned'] === true)	{
	$name_servers_dnssec = 'yes';
	$algorithm = $obj['secureDNS']['dsData'][0]['algorithm'];
	if (strlen($algorithm))	{
		$name_servers_dnssec_algorithm = $algorithm;
	}
	else	{
		$name_servers_dnssec_algorithm = '(not available)';
	}	
}
elseif ($obj['secureDNS']['delegationSigned'] === false)	{
	$name_servers_dnssec = 'no';	
}
$registrant_handle = '';
$registrant_full_name = '(hidden)';
$registrant_kind = '';
$registrant_name = '';	
$registrant_street = '';
$registrant_city = '';
$registrant_postal_code = '';
$registrant_country_code = '(hidden)';	
$registrant_protected = 'name,phone,fax,email,address';
$registrant_language_pref_1 = '';
$registrant_language_pref_2 = '';	
$admin_handle = '';
$admin_email = '(hidden)';
$admin_country_code = '(hidden)';	
$admin_protected = 'web_id,full_name,name,phone,fax,address';
$admin_language_pref_1 = '';
$admin_language_pref_2 = '';	
$tech_handle = '';
$tech_email	= '(hidden)';
$tech_country_code = '(hidden)';
$tech_protected = 'web_id,full_name,name,phone,fax,address';
$tech_language_pref_1 = '';
$tech_language_pref_2 = '';	
$billing_handle = '';
$billing_email = '';	
$billing_country_code = '';	
$billing_protected = 'web_id,full_name,name,phone,fax,address';
$reseller_handle = '';
$reseller_kind = '';	
$reseller_full_name = '';
$reseller_name = '';	
$reseller_street = '';
$reseller_city = '';
$reseller_postal_code = '';
$reseller_country_code = '';
$reseller_protected = 'name,phone,fax,email';
$reseller_language_pref_1 = '';
$reseller_language_pref_2 = '';	
$registrar_handle = '';
$registrar_kind = '';
$registrar_full_name = '';
$registrar_name = '';	
$registrar_street = '';
$registrar_city = '';
$registrar_postal_code = '';
$registrar_country_code = '(hidden)';	
$registrar_protected = 'name,phone,fax,email';
$registrar_language_pref_1 = '';
$registrar_language_pref_2 = '';	
$sponsor_handle = '';
$sponsor_kind = '';
$sponsor_full_name = '';
$sponsor_name = '';
$sponsor_street = '';
$sponsor_city = '';
$sponsor_postal_code = '';
$sponsor_country_code = '';
$sponsor_protected = 'name,phone,fax,email';

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
	
$registrar_abuse_email = '(no point of contact)';

$entity_registrant = -1;
$entity_admin = -1;
$entity_tech = -1;
$entity_reseller = -1;		
$entity_registrar = -1;
$entity_abuse = -1;	
$entity_sponsor = -1;
	
$raw_rdap_data = '';
	
foreach($obj as $key1 => $value1) {
	$raw_rdap_data .= $key1 . ': ' . $value1 . '<br />';
    foreach($value1 as $key2 => $value2) {
		$raw_rdap_data .= "+". $key2 . ': ' . $value2 . '<br />';
		foreach($value2 as $key3 => $value3) {
			$raw_rdap_data .= "++" . $key3 . ': ' . $value3 . '<br />';
			foreach($value3 as $key4 => $value4) {
				$raw_rdap_data .= "+++" . $key4 . ': ' . $value4 . '<br />';
				if ($value4 == 'registrant')	{
					$entity_registrant = $key2;
				}
				elseif ($value4 == 'administrative')	{
					$entity_admin = $key2;	
				}
				elseif ($value4 == 'technical')	{
					$entity_tech = $key2;
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
					$raw_rdap_data .= "++++" . $key5 . ': ' . $value5 . '<br />';
					foreach($value5 as $key6 => $value6) {
						$raw_rdap_data .= "+++++" . $key6 . ': ' . $value6 . '<br />';
						if ($value6 == 'abuse')	{
							$entity_abuse = $key4;
						}
						foreach($value6 as $key7 => $value7) {
							$raw_rdap_data .= "++++++" . $key7 . ': ' . $value7 . '<br />';
							foreach($value7 as $key8 => $value8) {
								$raw_rdap_data .= "+++++++" . $key8 . ': ' . $value8 . '<br />';	
							}
						}	
					}	
				}
			}
		}
	}
}
$raw_rdap_data = str_replace('Array','', $raw_rdap_data);	
foreach($obj as $key1 => $value1) {
	foreach($value1 as $key2 => $value2) {
		if ($key1 == 'status')	{
			if (strlen($status_values))	{
				$status_values .= ', <br />';				
			}	
			$status_values .= $value2;
		}
		if ($key1 == 'extensions')	{
			if (strlen($extensions_values))	{
				$extensions_values .= ', <br />';				
			}	
			$extensions_values .= $value2;
		}
		foreach($value2 as $key3 => $value3) {
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
			if ($key1 == 'entities' and $key3 == 'handle')	{
				if ($key2 == $entity_registrant)	{
					$registrant_handle = $value3;
				}				
				if ($key2 == $entity_admin)	{
					$admin_handle = $value3;
				}
				if ($key2 == $entity_tech)	{
					$tech_handle = $value3;
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
			if ($key1 == 'remarks')	{
				if (strlen($remark_values))	{
					$remark_values .= '<br />';				
				}
				if (!is_array($value3))	{
					$remark_values .= $key3 . ': ' . $value3;
				}
				else	{
					$remark_values .= $key3;
				}	
			}
			foreach($value3 as $key4 => $value4) {
				if ($key1 == 'entities')	{
					if ($key2 == $entity_registrant and $key3 == 'status')	{
						if (strlen($registrant_status_values))	{
							$registrant_status_values .= ', <br />';				
						}
						$registrant_status_values .= $value4;
						//$registrant_status_values .= $key1.'#'.$value1.'#'.$key2.'#'.$value2.'#'.$key3.'#'.$value3.'#'.$key4.'#'.$value4;
					}
					if ($key2 == $entity_reseller and $key3 == 'status')	{
						if (strlen($reseller_status_values))	{
							$reseller_status_values .= ', <br />';				
						}	
						$reseller_status_values .= $value4;
					}
					if ($key2 == $entity_registrar and $key3 == 'status')	{
						if (strlen($registrar_status_values))	{
							$registrar_status_values .= ', <br />';				
						}	
						$registrar_status_values .= $value4;
					}
					if ($key2 == $entity_sponsor and $key3 == 'status')	{
						if (strlen($sponsor_status_values))	{
							$sponsor_status_values .= ', <br />';				
						}	
						$sponsor_status_values .= $value4;
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
								$registrant_expiration = $valu42['eventDate'];
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
								$reseller_expiration = $valu42['eventDate'];
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
								$registrar_expiration = $valu42['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'deletion')	{
								$registrar_deletion = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last update of RDAP database')	{
								$registrar_last_uploaded = $value4['eventDate'];				
							}
						}
						if ($key2 == $entity_registrar and $key3 == 'publicIds')	{
							if ($key5 == 'type' and $value5 == 'IANA Registrar ID')	{
								$registrar_iana_id = $value4['identifier'];
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
								$sponsor_expiration = $valu42['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'deletion')	{
								$sponsor_deletion = $value4['eventDate'];
							}
							elseif ($key5 == 'eventAction' and $value5 == 'last update of RDAP database')	{
								$sponsor_last_uploaded = $value4['eventDate'];				
							}
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
					if ($key1 == 'entities')	{
						if ($key2 == $entity_registrant and $key3 == 'remarks')	{
							if (strlen($registrant_remark_values))	{
								$registrant_remark_values .= '<br />';				
							}
							if (!is_array($value5))	{
								$registrant_remark_values .= $key5 . ': ' . $value5;
							}
							else	{
								$registrant_remark_values .= $key5;
							}	
						}
						if ($key2 == $entity_reseller and $key3 == 'remarks')	{
							if (strlen($reseller_remark_values))	{
								$reseller_remark_values .= '<br />';				
							}
							if (!is_array($value5))	{
								$reseller_remark_values .= $key5 . ': ' . $value5;
							}
							else	{
								$reseller_remark_values .= $key5;
							}	
						}
						if ($key2 == $entity_registrar and $key3 == 'remarks')	{
							if (strlen($registrar_remark_values))	{
								$registrar_remark_values .= '<br />';				
							}
							if (!is_array($value5))	{
								$registrar_remark_values .= $key5 . ': ' . $value5;
							}
							else	{
								$registrar_remark_values .= $key5;
							}
						}
						if ($key2 == $entity_sponsor and $key3 == 'remarks')	{
							if (strlen($sponsor_remark_values))	{
								$sponsor_remark_values .= '<br />';				
							}
							if (!is_array($value5))	{
								$sponsor_remark_values .= $key5 . ': ' . $value5;
							}
							else	{					
								$sponsor_remark_values .= $key5;
							}
						}	
					}
					foreach($value5 as $key6 => $value6) {
						if ($key1 == 'entities' and $key3 == 'handle')	{
							if ($key2 == $entity_registrant)	{
								$registrant_handle = $value4['value'];
							}
							if ($key2 == $entity_admin)	{
								$admin_handle = $value4['value'];
							}
							if ($key2 == $entity_tech)	{
								$tech_handle = $value4['value'];
							}
							if ($key2 == $entity_reseller)	{
								$reseller_handle = $value4['value'];
							}
							if ($key2 == $entity_registrar)	{
								$registrar_handle = $value4['value'];
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_handle = $value4['value'];
							}	
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value6 == 'fn')	{
							if ($key2 == $entity_registrant)	{
								$registrant_full_name = $value5[3];
							}
							if ($key2 == $entity_admin)	{
								$admin_full_name = $value5[3];
							}
							if ($key2 == $entity_tech)	{
								$tech_full_name = $value5[3];
							}
							if ($key2 == $entity_reseller)	{
								$reseller_full_name = $value5[3];
							}
							if ($key2 == $entity_registrar)	{
								$registrar_full_name = $value5[3];
							}
							if ($key2 == $entity_sponsor)	{
								$sponsor_full_name = $value5[3];
							}	
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value6 == 'n')	{
							if ($key2 == $entity_registrant)	{
								$registrant_name = $value5[3][0];	
								if (strlen($value5[3][1]))	{
									$registrant_name .= ', '. $value5[3][1];
								}
							}
							if ($key2 == $entity_admin)	{
								$admin_name = $value5[3][0];	
								if (strlen($value5[3][1]))	{
									$admin_name .= ', '. $value5[3][1];
								}
							}
							if ($key2 == $entity_tech)	{
								$tech_name = $value5[3][0];	
								if (strlen($value5[3][1]))	{
									$tech_name .= ', '. $value5[3][1];
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
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value6 == 'kind')	{
							if ($key2 == $entity_registrant)	{
								$registrant_kind = $value5[3];
							}
							if ($key2 == $entity_admin)	{
								$admin_kind = $value5[3];
							}
							if ($key2 == $entity_tech)	{
								$tech_kind = $value5[3];
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
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value6 == 'lang')	{
							if ($key2 == $entity_registrant)	{
								if ($value6['pref'] == 1)	$registrant_language_pref_1 = $value5[3];
								if ($value6['pref'] == 2)	$registrant_language_pref_2 = $value5[3];
							}
							if ($key2 == $entity_admin)	{
								if ($value6['pref'] == 1)	$admin_language_pref_1 = $value5[3];
								if ($value6['pref'] == 2)	$admin_language_pref_2 = $value5[3];
							}
							if ($ky2 == $entity_tech)	{
								if ($value6['pref'] == 1)	$tech_language_pref_1 = $value5[3];
								if ($value6['pref'] == 2)	$tech_language_pref_2 = $value5[3];
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
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value6 == 'email')	{
							if ($key2 == $entity_admin)	{
								$admin_email = $value5[3];
							}	
							if ($key2 == $entity_tech)	{
								$tech_email = $value5[3];
							}	
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value5[0] == 'adr' and $key6 == 3)	{
							if ($key2 == $entity_registrant)	{
								$registrant_country_code = $value6[6];
							}
							if ($key2 == $entity_admin)	{
								$admin_country_code = $value6[6];
							}	
							if ($key2 == $entity_tech)	{
								$tech_country_code = $value6[6];
							}							
							if ($key2 == $entity_reseller)	{
								if (!is_array($value6[2]))	{
									$reseller_street = $value6[2];
								}
								if (!is_array($value6[3]))	{
									$reseller_city = $value6[3];
								}
								if (!is_array($value6[5]))	{
									$reseller_postal_code = $value6[5];
								}
								if (!is_array($value6[6]))	{
									$reseller_country_code = $value6[6];
								}	
							}
							if ($key2 == $entity_registrar)	{
								if (!is_array($value6[2]))	{
									$registrar_street = $value6[2];
								}
								if (!is_array($value6[3]))	{
									$registrar_city = $value6[3];
								}
								if (!is_array($value6[5]))	{
									$registrar_postal_code = $value6[5];
								}
								if (!is_array($value6[6]))	{
									$registrar_country_code = $value6[6];
								}	
							}
							if ($key2 == $entity_sponsor)	{
								if (!is_array($value6[2]))	{
									$sponsor_street = $value6[2];
								}
								if (!is_array($value6[3]))	{
									$sponsor_city = $value6[3];
								}
								if (!is_array($value6[5]))	{
									$sponsor_postal_code = $value6[5];
								}
								if (!is_array($value6[6]))	{
									$sponsor_country_code = $value6[6];
								}	
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
								if ($key1 == 'entities' and $key2 == $entity_registrar and $key3 == 'entities' and $key4 == $entity_abuse and $key5 == 'vcardArray' and $key6 == 1)	{
									if ($value8 == 'tel')	{
										$registrar_abuse_phone = $value7[3];									
									}
									elseif ($value8 == 'email')	{
										$registrar_abuse_email = $value7[3];
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
if (str_contains($status_values, 'locked'))	{	
	if ($expiration == '(hidden)')	{
		$expiration = '(not applicable)';	
	}		
}
if (str_contains($status_values, 'redemption period') or str_contains($status_values, 'pending delete'))	{	
	if (!strlen($deletion))	{
		$deletion = '(without date-time)';	
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
	
$domain_zone_top_level_domain = $doc->createElement("zone_top_level_domain");
$domain_zone_top_level_domain->appendChild($doc->createCDATASection($zone_top_level_domain));	
$zone->appendChild($domain_zone_top_level_domain);

$domain_zone_registry_web_id = $doc->createElement("zone_registry_web_id");
$domain_zone_registry_web_id->appendChild($doc->createCDATASection($zone_registry_web_id));	
$zone->appendChild($domain_zone_registry_web_id);	

$domain_zone_registry_full_name = $doc->createElement("zone_registry_full_name");
$domain_zone_registry_full_name->appendChild($doc->createCDATASection($zone_registry_full_name));	
$zone->appendChild($domain_zone_registry_full_name);
	
$domain_zone_registry_language = $doc->createElement("zone_registry_language");
$domain_zone_registry_language->appendChild($doc->createCDATASection($zone_registry_language));	
$zone->appendChild($domain_zone_registry_language);	
	
$domain_zone_registry_website = $doc->createElement("zone_registry_website");
$domain_zone_registry_website->appendChild($doc->createCDATASection($zone_registry_website));	
$zone->appendChild($domain_zone_registry_website);	
	
$domain_zone_menu = $doc->createElement("zone_menu");
$domain_zone_menu->appendChild($doc->createCDATASection($zone_menu));	
$zone->appendChild($domain_zone_menu);	
	
$domain_zone_support = $doc->createElement("zone_support");
$domain_zone_support->appendChild($doc->createCDATASection($zone_support));	
$zone->appendChild($domain_zone_support);	
	
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
		
$details = $doc->createElement("details");
$domain->appendChild($details);
	
$domain_handle = $doc->createElement("domain_handle");
$domain_handle->appendChild($doc->createCDATASection($handle));	
$details->appendChild($domain_handle);	
	
$domain_name_ascii = $doc->createElement("domain_name_ascii");
$domain_name_ascii->appendChild($doc->createCDATASection($name_ascii));	
$details->appendChild($domain_name_ascii);
$domain_name_unicode = $doc->createElement("domain_name_unicode");
$domain_name_unicode->appendChild($doc->createCDATASection($name_unicode));	
$details->appendChild($domain_name_unicode);	
$domain_status_values = $doc->createElement("domain_status_values");
$domain_status_values->appendChild($doc->createCDATASection($status_values));	
$details->appendChild($domain_status_values);			
$domain_event_registration = $doc->createElement("domain_event_registration");
$domain_event_registration->appendChild($doc->createCDATASection($registration));	
$details->appendChild($domain_event_registration);
$domain_event_last_transferred = $doc->createElement("domain_event_last_transferred");
$domain_event_last_transferred->appendChild($doc->createCDATASection($last_transferred));	
$details->appendChild($domain_event_last_transferred);
$domain_event_last_changed = $doc->createElement("domain_event_last_changed");
$domain_event_last_changed->appendChild($doc->createCDATASection($last_changed));	
$details->appendChild($domain_event_last_changed);	
$domain_event_expiration = $doc->createElement("domain_event_expiration");
$domain_event_expiration->appendChild($doc->createCDATASection($expiration));	
$details->appendChild($domain_event_expiration);
$domain_event_deletion = $doc->createElement("domain_event_deletion");
$domain_event_deletion->appendChild($doc->createCDATASection($deletion));	
$details->appendChild($domain_event_deletion);	
$domain_event_last_uploaded = $doc->createElement("domain_event_last_uploaded");
$domain_event_last_uploaded->appendChild($doc->createCDATASection($last_uploaded));	
$details->appendChild($domain_event_last_uploaded);	
$domain_extensions_values = $doc->createElement("domain_extensions_values");
$domain_extensions_values->appendChild($doc->createCDATASection($extensions_values));	
$details->appendChild($domain_extensions_values);
$domain_remark_values = $doc->createElement("domain_remark_values");
$domain_remark_values->appendChild($doc->createCDATASection($remark_values));	
$details->appendChild($domain_remark_values);	
$domain->appendChild($details);	
	
$registrant = $doc->createElement("registrant");
$domain->appendChild($registrant);
$domain_registrant_handle = $doc->createElement("registrant_handle");
$domain_registrant_handle->appendChild($doc->createCDATASection($registrant_handle));	
$registrant->appendChild($domain_registrant_handle);	
$domain_registrant_web_id = $doc->createElement("registrant_web_id");
$domain_registrant_web_id->appendChild($doc->createCDATASection($registrant_web_id));	
$registrant->appendChild($domain_registrant_web_id);
$domain_registrant_full_name = $doc->createElement("registrant_full_name");
$domain_registrant_full_name->appendChild($doc->createCDATASection($registrant_full_name));	
$registrant->appendChild($domain_registrant_full_name);
$domain_registrant_kind = $doc->createElement("registrant_kind");
$domain_registrant_kind->appendChild($doc->createCDATASection($registrant_kind));	
$registrant->appendChild($domain_registrant_kind);	
$domain_registrant_name = $doc->createElement("registrant_name");
$domain_registrant_name->appendChild($doc->createCDATASection($registrant_name));	
$registrant->appendChild($domain_registrant_name);
$domain_registrant_country_code = $doc->createElement("registrant_country_code");
$domain_registrant_country_code->appendChild($doc->createCDATASection($registrant_country_code));
$registrant->appendChild($domain_registrant_country_code);		
$domain_registrant_language_pref_1 = $doc->createElement("registrant_language_pref_1");
$domain_registrant_language_pref_1->appendChild($doc->createCDATASection($registrant_language_pref_1));	
$registrant->appendChild($domain_registrant_language_pref_1);
$domain_registrant_language_pref_2 = $doc->createElement("registrant_language_pref_2");
$domain_registrant_language_pref_2->appendChild($doc->createCDATASection($registrant_language_pref_2));	
$registrant->appendChild($domain_registrant_language_pref_2);	
$domain_registrant_protected = $doc->createElement("registrant_protected");	
$domain_registrant_protected->appendChild($doc->createCDATASection($registrant_protected));	
$registrant->appendChild($domain_registrant_protected);
$domain_registrant_status_values = $doc->createElement("registrant_status_values");
$domain_registrant_status_values->appendChild($doc->createCDATASection($registrant_status_values));	
$registrant->appendChild($domain_registrant_status_values);
$domain_registrant_event_registration = $doc->createElement("registrant_event_registration");
$domain_registrant_event_registration->appendChild($doc->createCDATASection($registrant_registration));	
$registrant->appendChild($domain_registrant_event_registration);
$domain_registrant_event_last_transferred = $doc->createElement("registrant_event_last_transferred");
$domain_registrant_event_last_transferred->appendChild($doc->createCDATASection($registrant_last_transferred));	
$registrant->appendChild($domain_registrant_event_last_transferred);
$domain_registrant_event_last_changed = $doc->createElement("registrant_event_last_changed");
$domain_registrant_event_last_changed->appendChild($doc->createCDATASection($registrant_last_changed));	
$registrant->appendChild($domain_registrant_event_last_changed);	
$domain_registrant_event_expiration = $doc->createElement("registrant_event_expiration");
$domain_registrant_event_expiration->appendChild($doc->createCDATASection($registrant_expiration));	
$registrant->appendChild($domain_registrant_event_expiration);
$domain_registrant_event_deletion = $doc->createElement("registrant_event_deletion");
$domain_registrant_event_deletion->appendChild($doc->createCDATASection($registrant_deletion));	
$registrant->appendChild($domain_registrant_event_deletion);	
$domain_registrant_event_last_uploaded = $doc->createElement("registrant_event_last_uploaded");
$domain_registrant_event_last_uploaded->appendChild($doc->createCDATASection($registrant_last_uploaded));	
$registrant->appendChild($domain_registrant_event_last_uploaded);
$domain_registrant_remark_values = $doc->createElement("registrant_remark_values");
$domain_registrant_remark_values->appendChild($doc->createCDATASection($registrant_remark_values));	
$registrant->appendChild($domain_registrant_remark_values);		
$domain->appendChild($registrant);
	
$admin = $doc->createElement("admin");
$domain->appendChild($admin);
$domain_admin_handle = $doc->createElement("admin_handle");
$domain_admin_handle->appendChild($doc->createCDATASection($admin_handle));	
$admin->appendChild($domain_admin_handle);	
$domain_admin_full_name = $doc->createElement("admin_full_name");
$domain_admin_full_name->appendChild($doc->createCDATASection($admin_full_name));	
$admin->appendChild($domain_admin_full_name);	
$domain_admin_email = $doc->createElement("admin_email");
$domain_admin_email->appendChild($doc->createCDATASection($admin_email));	
$admin->appendChild($domain_admin_email);
$domain_admin_country_code = $doc->createElement("admin_country_code");
$domain_admin_country_code->appendChild($doc->createCDATASection($admin_country_code));
$admin->appendChild($domain_admin_country_code);	
$domain_admin_language_pref_1 = $doc->createElement("admin_language_pref_1");
$domain_admin_language_pref_1->appendChild($doc->createCDATASection($admin_language_pref_1));	
$admin->appendChild($domain_admin_language_pref_1);
$domain_admin_language_pref_2 = $doc->createElement("admin_language_pref_2");
$domain_admin_language_pref_2->appendChild($doc->createCDATASection($admin_language_pref_2));	
$admin->appendChild($domain_admin_language_pref_2);	
$domain_admin_protected = $doc->createElement("admin_protected");	
$domain_admin_protected->appendChild($doc->createCDATASection($admin_protected));	
$admin->appendChild($domain_admin_protected);		
$domain->appendChild($admin);	
	
$tech = $doc->createElement("tech");
$domain->appendChild($tech);
$domain_tech_handle = $doc->createElement("tech_handle");
$domain_tech_handle->appendChild($doc->createCDATASection($tech_handle));	
$tech->appendChild($domain_tech_handle);	
$domain_tech_full_name = $doc->createElement("tech_full_name");
$domain_tech_full_name->appendChild($doc->createCDATASection($tech_full_name));	
$tech->appendChild($domain_tech_full_name);	
$domain_tech_email = $doc->createElement("tech_email");
$domain_tech_email->appendChild($doc->createCDATASection($tech_email));	
$tech->appendChild($domain_tech_email);
$domain_tech_country_code = $doc->createElement("tech_country_code");
$domain_tech_country_code->appendChild($doc->createCDATASection($tech_country_code));
$tech->appendChild($domain_tech_country_code);	
$domain_tech_language_pref_1 = $doc->createElement("tech_language_pref_1");
$domain_tech_language_pref_1->appendChild($doc->createCDATASection($tech_language_pref_1));	
$tech->appendChild($domain_tech_language_pref_1);
$domain_tech_language_pref_2 = $doc->createElement("tech_language_pref_2");
$domain_tech_language_pref_2->appendChild($doc->createCDATASection($tech_language_pref_2));	
$tech->appendChild($domain_tech_language_pref_2);	
$domain_tech_protected = $doc->createElement("tech_protected");	
$domain_tech_protected->appendChild($doc->createCDATASection($tech_protected));	
$tech->appendChild($domain_tech_protected);		
$domain->appendChild($tech);
	
$billing = $doc->createElement("billing");
$domain->appendChild($billing);
$domain_billing_handle = $doc->createElement("billing_handle");
$domain_billing_handle->appendChild($doc->createCDATASection($billing_handle));	
$billing->appendChild($domain_billing_handle);	
$domain_billing_full_name = $doc->createElement("billing_full_name");
$domain_billing_full_name->appendChild($doc->createCDATASection($billing_full_name));	
$billing->appendChild($domain_billing_full_name);	
$domain_billing_email = $doc->createElement("billing_email");
$domain_billing_email->appendChild($doc->createCDATASection($billing_email));	
$billing->appendChild($domain_billing_email);
$domain_billing_country_code = $doc->createElement("billing_country_code");
$domain_billing_country_code->appendChild($doc->createCDATASection($billing_country_code));
$billing->appendChild($domain_billing_country_code);	
$domain_billing_language_pref_1 = $doc->createElement("billing_language_pref_1");
$domain_billing_language_pref_1->appendChild($doc->createCDATASection($billing_language_pref_1));	
$billing->appendChild($domain_billing_language_pref_1);
$domain_billing_language_pref_2 = $doc->createElement("billing_language_pref_2");
$domain_billing_language_pref_2->appendChild($doc->createCDATASection($billing_language_pref_2));	
$billing->appendChild($domain_billing_language_pref_2);	
$domain_billing_protected = $doc->createElement("billing_protected");	
$domain_billing_protected->appendChild($doc->createCDATASection($billing_protected));	
$billing->appendChild($domain_billing_protected);		
$domain->appendChild($billing);	

$reseller = $doc->createElement("reseller");
$domain->appendChild($reseller);
$domain_reseller_handle = $doc->createElement("reseller_handle");
$domain_reseller_handle->appendChild($doc->createCDATASection($reseller_handle));	
$reseller->appendChild($domain_reseller_handle);	
$domain_reseller_full_name = $doc->createElement("reseller_full_name");
$domain_reseller_full_name->appendChild($doc->createCDATASection($reseller_full_name));	
$reseller->appendChild($domain_reseller_full_name);
$domain_reseller_kind = $doc->createElement("reseller_kind");
$domain_reseller_kind->appendChild($doc->createCDATASection($reseller_kind));	
$reseller->appendChild($domain_reseller_kind);		
$domain_reseller_name = $doc->createElement("reseller_name");
$domain_reseller_name->appendChild($doc->createCDATASection($reseller_name));	
$reseller->appendChild($domain_reseller_name);
$domain_reseller_street = $doc->createElement("reseller_street");
$domain_reseller_street->appendChild($doc->createCDATASection($reseller_street));	
$reseller->appendChild($domain_reseller_street);
$domain_reseller_city = $doc->createElement("reseller_city");
$domain_reseller_city->appendChild($doc->createCDATASection($reseller_city));	
$reseller->appendChild($domain_reseller_city);
$domain_reseller_postal_code = $doc->createElement("reseller_postal_code");
$domain_reseller_postal_code->appendChild($doc->createCDATASection($reseller_postal_code));	
$reseller->appendChild($domain_reseller_postal_code);
$domain_reseller_country_code = $doc->createElement("reseller_country_code");
$domain_reseller_country_code->appendChild($doc->createCDATASection($reseller_country_code));	
$reseller->appendChild($domain_reseller_country_code);
$domain_reseller_language_pref_1 = $doc->createElement("reseller_language_pref_1");
$domain_reseller_language_pref_1->appendChild($doc->createCDATASection($reseller_language_pref_1));	
$reseller->appendChild($domain_reseller_language_pref_1);
$domain_reseller_language_pref_2 = $doc->createElement("reseller_language_pref_2");
$domain_reseller_language_pref_2->appendChild($doc->createCDATASection($reseller_language_pref_2));	
$reseller->appendChild($domain_reseller_language_pref_2);	
$domain_reseller_protected = $doc->createElement("reseller_protected");	
$domain_reseller_protected->appendChild($doc->createCDATASection($reseller_protected));	
$reseller->appendChild($domain_reseller_protected);
$domain_reseller_status_values = $doc->createElement("reseller_status_values");
$domain_reseller_status_values->appendChild($doc->createCDATASection($reseller_status_values));	
$reseller->appendChild($domain_reseller_status_values);
$domain_reseller_event_registration = $doc->createElement("reseller_event_registration");
$domain_reseller_event_registration->appendChild($doc->createCDATASection($reseller_registration));	
$reseller->appendChild($domain_reseller_event_registration);
$domain_reseller_event_last_transferred = $doc->createElement("reseller_event_last_transferred");
$domain_reseller_event_last_transferred->appendChild($doc->createCDATASection($reseller_last_transferred));	
$reseller->appendChild($domain_reseller_event_last_transferred);
$domain_reseller_event_last_changed = $doc->createElement("reseller_event_last_changed");
$domain_reseller_event_last_changed->appendChild($doc->createCDATASection($reseller_last_changed));	
$reseller->appendChild($domain_reseller_event_last_changed);	
$domain_reseller_event_expiration = $doc->createElement("reseller_event_expiration");
$domain_reseller_event_expiration->appendChild($doc->createCDATASection($reseller_expiration));	
$reseller->appendChild($domain_reseller_event_expiration);
$domain_reseller_event_deletion = $doc->createElement("reseller_event_deletion");
$domain_reseller_event_deletion->appendChild($doc->createCDATASection($reseller_deletion));	
$reseller->appendChild($domain_reseller_event_deletion);	
$domain_reseller_event_last_uploaded = $doc->createElement("reseller_event_last_uploaded");
$domain_reseller_event_last_uploaded->appendChild($doc->createCDATASection($reseller_last_uploaded));	
$reseller->appendChild($domain_reseller_event_last_uploaded);
$domain_reseller_remark_values = $doc->createElement("reseller_remark_values");
$domain_reseller_remark_values->appendChild($doc->createCDATASection($reseller_remark_values));	
$reseller->appendChild($domain_reseller_remark_values);		
$domain->appendChild($reseller);	
	
$registrar = $doc->createElement("registrar");
$domain->appendChild($registrar);
$domain_registrar_handle = $doc->createElement("registrar_handle");
$domain_registrar_handle->appendChild($doc->createCDATASection($registrar_handle));	
$registrar->appendChild($domain_registrar_handle);	
$domain_registrar_full_name = $doc->createElement("registrar_full_name");
$domain_registrar_full_name->appendChild($doc->createCDATASection($registrar_full_name));	
$registrar->appendChild($domain_registrar_full_name);
$domain_registrar_kind = $doc->createElement("registrar_kind");
$domain_registrar_kind->appendChild($doc->createCDATASection($registrar_kind));	
$registrar->appendChild($domain_registrar_kind);	
$domain_registrar_name = $doc->createElement("registrar_name");
$domain_registrar_name->appendChild($doc->createCDATASection($registrar_name));	
$registrar->appendChild($domain_registrar_name);	
$domain_registrar_iana_id = $doc->createElement("registrar_iana_id");
$domain_registrar_iana_id->appendChild($doc->createCDATASection($registrar_iana_id));	
$registrar->appendChild($domain_registrar_iana_id);	
$domain_registrar_street = $doc->createElement("registrar_street");
$domain_registrar_street->appendChild($doc->createCDATASection($registrar_street));	
$registrar->appendChild($domain_registrar_street);
$domain_registrar_city = $doc->createElement("registrar_city");
$domain_registrar_city->appendChild($doc->createCDATASection($registrar_city));	
$registrar->appendChild($domain_registrar_city);
$domain_registrar_postal_code = $doc->createElement("registrar_postal_code");
$domain_registrar_postal_code->appendChild($doc->createCDATASection($registrar_postal_code));	
$registrar->appendChild($domain_registrar_postal_code);
$domain_registrar_country_code = $doc->createElement("registrar_country_code");
$domain_registrar_country_code->appendChild($doc->createCDATASection($registrar_country_code));	
$registrar->appendChild($domain_registrar_country_code);
$domain_registrar_language_pref_1 = $doc->createElement("registrar_language_pref_1");
$domain_registrar_language_pref_1->appendChild($doc->createCDATASection($registrar_language_pref_1));	
$registrar->appendChild($domain_registrar_language_pref_1);
$domain_registrar_language_pref_2 = $doc->createElement("registrar_language_pref_2");
$domain_registrar_language_pref_2->appendChild($doc->createCDATASection($registrar_language_pref_2));	
$registrar->appendChild($domain_registrar_language_pref_2);	
$domain_registrar_protected = $doc->createElement("registrar_protected");	
$domain_registrar_protected->appendChild($doc->createCDATASection($registrar_protected));	
$registrar->appendChild($domain_registrar_protected);	
$domain_registrar_status_values = $doc->createElement("registrar_status_values");
$domain_registrar_status_values->appendChild($doc->createCDATASection($registrar_status_values));	
$registrar->appendChild($domain_registrar_status_values);	
$domain_registrar_event_registration = $doc->createElement("registrar_event_registration");
$domain_registrar_event_registration->appendChild($doc->createCDATASection($registrar_registration));	
$registrar->appendChild($domain_registrar_event_registration);
$domain_registrar_event_last_transferred = $doc->createElement("registrar_event_last_transferred");
$domain_registrar_event_last_transferred->appendChild($doc->createCDATASection($registrar_last_transferred));	
$registrar->appendChild($domain_registrar_event_last_transferred);
$domain_registrar_event_last_changed = $doc->createElement("registrar_event_last_changed");
$domain_registrar_event_last_changed->appendChild($doc->createCDATASection($registrar_last_changed));	
$registrar->appendChild($domain_registrar_event_last_changed);	
$domain_registrar_event_expiration = $doc->createElement("registrar_event_expiration");
$domain_registrar_event_expiration->appendChild($doc->createCDATASection($registrar_expiration));	
$registrar->appendChild($domain_registrar_event_expiration);
$domain_registrar_event_deletion = $doc->createElement("registrar_event_deletion");
$domain_registrar_event_deletion->appendChild($doc->createCDATASection($registrar_deletion));	
$registrar->appendChild($domain_registrar_event_deletion);	
$domain_registrar_event_last_uploaded = $doc->createElement("registrar_event_last_uploaded");
$domain_registrar_event_last_uploaded->appendChild($doc->createCDATASection($registrar_last_uploaded));
$registrar->appendChild($domain_registrar_event_last_uploaded);	
$domain_registrar_remark_values = $doc->createElement("registrar_remark_values");
$domain_registrar_remark_values->appendChild($doc->createCDATASection($registrar_remark_values));	
$registrar->appendChild($domain_registrar_remark_values);	
$domain_registrar_abuse_email = $doc->createElement("registrar_abuse_email");
$domain_registrar_abuse_email->appendChild($doc->createCDATASection($registrar_abuse_email));	
$registrar->appendChild($domain_registrar_abuse_email);
$domain_registrar_abuse_phone = $doc->createElement("registrar_abuse_phone");
$domain_registrar_abuse_phone->appendChild($doc->createCDATASection($registrar_abuse_phone));	
$registrar->appendChild($domain_registrar_abuse_phone);	
$domain->appendChild($registrar);
	
$sponsor = $doc->createElement("sponsor");
$domain->appendChild($sponsor);
$domain_sponsor_handle = $doc->createElement("sponsor_handle");
$domain_sponsor_handle->appendChild($doc->createCDATASection($sponsor_handle));	
$sponsor->appendChild($domain_sponsor_handle);	
$domain_sponsor_full_name = $doc->createElement("sponsor_full_name");
$domain_sponsor_full_name->appendChild($doc->createCDATASection($sponsor_full_name));	
$sponsor->appendChild($domain_sponsor_full_name);
$domain_sponsor_kind = $doc->createElement("sponsor_kind");
$domain_sponsor_kind->appendChild($doc->createCDATASection($sponsor_kind));	
$sponsor->appendChild($domain_sponsor_kind);	
$domain_sponsor_name = $doc->createElement("sponsor_name");
$domain_sponsor_name->appendChild($doc->createCDATASection($sponsor_name));	
$sponsor->appendChild($domain_sponsor_name);	
$domain_sponsor_iana_id = $doc->createElement("sponsor_iana_id");
$domain_sponsor_iana_id->appendChild($doc->createCDATASection($sponsor_iana_id));	
$sponsor->appendChild($domain_sponsor_iana_id);	
$domain_sponsor_street = $doc->createElement("sponsor_street");
$domain_sponsor_street->appendChild($doc->createCDATASection($sponsor_street));	
$sponsor->appendChild($domain_sponsor_street);
$domain_sponsor_city = $doc->createElement("sponsor_city");
$domain_sponsor_city->appendChild($doc->createCDATASection($sponsor_city));	
$sponsor->appendChild($domain_sponsor_city);
$domain_sponsor_postal_code = $doc->createElement("sponsor_postal_code");
$domain_sponsor_postal_code->appendChild($doc->createCDATASection($sponsor_postal_code));	
$sponsor->appendChild($domain_sponsor_postal_code);
$domain_sponsor_country_code = $doc->createElement("sponsor_country_code");
$domain_sponsor_country_code->appendChild($doc->createCDATASection($sponsor_country_code));	
$sponsor->appendChild($domain_sponsor_country_code);
$domain_sponsor_language_pref_1 = $doc->createElement("sponsor_language_pref_1");
$domain_sponsor_language_pref_1->appendChild($doc->createCDATASection($sponsor_language_pref_1));	
$sponsor->appendChild($domain_sponsor_language_pref_1);
$domain_sponsor_language_pref_2 = $doc->createElement("sponsor_language_pref_2");
$domain_sponsor_language_pref_2->appendChild($doc->createCDATASection($sponsor_language_pref_2));	
$sponsor->appendChild($domain_sponsor_language_pref_2);	
$domain_sponsor_protected = $doc->createElement("sponsor_protected");	
$domain_sponsor_protected->appendChild($doc->createCDATASection($sponsor_protected));	
$sponsor->appendChild($domain_sponsor_protected);
$domain_sponsor_status_values = $doc->createElement("sponsor_status_values");
$domain_sponsor_status_values->appendChild($doc->createCDATASection($sponsor_status_values));	
$sponsor->appendChild($domain_sponsor_status_values);
$domain_sponsor_event_registration = $doc->createElement("sponsor_event_registration");
$domain_sponsor_event_registration->appendChild($doc->createCDATASection($sponsor_registration));	
$sponsor->appendChild($domain_sponsor_event_registration);
$domain_sponsor_event_last_transferred = $doc->createElement("sponsor_event_last_transferred");
$domain_sponsor_event_last_transferred->appendChild($doc->createCDATASection($sponsor_last_transferred));	
$sponsor->appendChild($domain_sponsor_event_last_transferred);
$domain_sponsor_event_last_changed = $doc->createElement("sponsor_event_last_changed");
$domain_sponsor_event_last_changed->appendChild($doc->createCDATASection($sponsor_last_changed));	
$sponsor->appendChild($domain_sponsor_event_last_changed);	
$domain_sponsor_event_expiration = $doc->createElement("sponsor_event_expiration");
$domain_sponsor_event_expiration->appendChild($doc->createCDATASection($sponsor_expiration));	
$sponsor->appendChild($domain_sponsor_event_expiration);
$domain_sponsor_event_deletion = $doc->createElement("sponsor_event_deletion");
$domain_sponsor_event_deletion->appendChild($doc->createCDATASection($sponsor_deletion));	
$sponsor->appendChild($domain_sponsor_event_deletion);	
$domain_sponsor_event_last_uploaded = $doc->createElement("sponsor_event_last_uploaded");
$domain_sponsor_event_last_uploaded->appendChild($doc->createCDATASection($sponsor_last_uploaded));	
$sponsor->appendChild($domain_sponsor_event_last_uploaded);
$domain_sponsor_remark_values = $doc->createElement("sponsor_remark_values");
$domain_sponsor_remark_values->appendChild($doc->createCDATASection($sponsor_remark_values));	
$sponsor->appendChild($domain_sponsor_remark_values);	
$domain->appendChild($sponsor);	
	
$name_servers = $doc->createElement("name_servers");
$domain->appendChild($name_servers);

$server_1 = $doc->createElement("server_1");
$name_servers->appendChild($server_1);	
$domain_server_name_1 = $doc->createElement("server_name_1");
$domain_server_name_1->appendChild($doc->createCDATASection($server_name_1));		
$server_1->appendChild($domain_server_name_1);
$domain_server_name_unicode_1 = $doc->createElement("server_name_unicode_1");
$domain_server_name_unicode_1->appendChild($doc->createCDATASection($server_name_unicode_1));
$server_1->appendChild($domain_server_name_unicode_1);	
$domain_server_delegation_check_1 = $doc->createElement("server_delegation_check_1");
$domain_server_delegation_check_1->appendChild($doc->createCDATASection($server_delegation_check_1));		
$server_1->appendChild($domain_server_delegation_check_1);
$domain_server_status_1 = $doc->createElement("server_status_1");
$domain_server_status_1->appendChild($doc->createCDATASection($server_status_1));		
$server_1->appendChild($domain_server_status_1);		
$domain_server_delegation_check_last_correct_1 = $doc->createElement("server_delegation_check_last_correct_1");
$domain_server_delegation_check_last_correct_1->appendChild($doc->createCDATASection($server_delegation_check_last_correct_1));		
$server_1->appendChild($domain_server_delegation_check_last_correct_1);	
$domain_server_ipv4_1 = $doc->createElement("server_ipv4_1");
$domain_server_ipv4_1->appendChild($doc->createCDATASection($server_ipv4_1));		
$server_1->appendChild($domain_server_ipv4_1);
$domain_server_ipv6_1 = $doc->createElement("server_ipv6_1");
$domain_server_ipv6_1->appendChild($doc->createCDATASection($server_ipv6_1));		
$server_1->appendChild($domain_server_ipv6_1);	
$name_servers->appendChild($server_1);
	
$server_2 = $doc->createElement("server_2");
$name_servers->appendChild($server_2);	
$domain_server_name_2 = $doc->createElement("server_name_2");
$domain_server_name_2->appendChild($doc->createCDATASection($server_name_2));		
$server_2->appendChild($domain_server_name_2);
$domain_server_name_unicode_2 = $doc->createElement("server_name_unicode_2");
$domain_server_name_unicode_2->appendChild($doc->createCDATASection($server_name_unicode_2));		
$server_2->appendChild($domain_server_name_unicode_2);
$domain_server_delegation_check_2 = $doc->createElement("server_delegation_check_2");
$domain_server_delegation_check_2->appendChild($doc->createCDATASection($server_delegation_check_2));		
$server_2->appendChild($domain_server_delegation_check_2);
$domain_server_status_2 = $doc->createElement("server_status_2");
$domain_server_status_2->appendChild($doc->createCDATASection($server_status_2));		
$server_2->appendChild($domain_server_status_2);		
$domain_server_delegation_check_last_correct_2 = $doc->createElement("server_delegation_check_last_correct_2");
$domain_server_delegation_check_last_correct_2->appendChild($doc->createCDATASection($server_delegation_check_last_correct_2));		
$server_2->appendChild($domain_server_delegation_check_last_correct_2);	
$domain_server_ipv4_2 = $doc->createElement("server_ipv4_2");
$domain_server_ipv4_2->appendChild($doc->createCDATASection($server_ipv4_2));		
$server_2->appendChild($domain_server_ipv4_2);
$domain_server_ipv6_2 = $doc->createElement("server_ipv6_2");
$domain_server_ipv6_2->appendChild($doc->createCDATASection($server_ipv6_2));		
$server_2->appendChild($domain_server_ipv6_2);	
$name_servers->appendChild($server_2);	
	
$server_3 = $doc->createElement("server_3");
$name_servers->appendChild($server_3);	
$domain_server_name_3 = $doc->createElement("server_name_3");
$domain_server_name_3->appendChild($doc->createCDATASection($server_name_3));		
$server_3->appendChild($domain_server_name_3);
$domain_server_name_unicode_3 = $doc->createElement("server_name_unicode_3");
$domain_server_name_unicode_3->appendChild($doc->createCDATASection($server_name_unicode_3));		
$server_3->appendChild($domain_server_name_unicode_3);
$domain_server_delegation_check_3 = $doc->createElement("server_delegation_check_3");
$domain_server_delegation_check_3->appendChild($doc->createCDATASection($server_delegation_check_3));		
$server_3->appendChild($domain_server_delegation_check_3);
$domain_server_status_3 = $doc->createElement("server_status_3");
$domain_server_status_3->appendChild($doc->createCDATASection($server_status_3));		
$server_3->appendChild($domain_server_status_3);		
$domain_server_delegation_check_last_correct_3 = $doc->createElement("server_delegation_check_last_correct_3");
$domain_server_delegation_check_last_correct_3->appendChild($doc->createCDATASection($server_delegation_check_last_correct_3));		
$server_3->appendChild($domain_server_delegation_check_last_correct_3);	
$domain_server_ipv4_3 = $doc->createElement("server_ipv4_3");
$domain_server_ipv4_3->appendChild($doc->createCDATASection($server_ipv4_3));		
$server_3->appendChild($domain_server_ipv4_3);
$domain_server_ipv6_3 = $doc->createElement("server_ipv6_3");
$domain_server_ipv6_3->appendChild($doc->createCDATASection($server_ipv6_3));		
$server_3->appendChild($domain_server_ipv6_3);		
$name_servers->appendChild($server_3);
	
$server_4 = $doc->createElement("server_4");
$name_servers->appendChild($server_4);	
$domain_server_name_4 = $doc->createElement("server_name_4");
$domain_server_name_4->appendChild($doc->createCDATASection($server_name_4));		
$server_4->appendChild($domain_server_name_4);
$domain_server_name_unicode_4 = $doc->createElement("server_name_unicode_4");
$domain_server_name_unicode_4->appendChild($doc->createCDATASection($server_name_unicode_4));		
$server_4->appendChild($domain_server_name_unicode_4);
$domain_server_delegation_check_4 = $doc->createElement("server_delegation_check_4");
$domain_server_delegation_check_4->appendChild($doc->createCDATASection($server_delegation_check_4));		
$server_4->appendChild($domain_server_delegation_check_4);
$domain_server_status_4 = $doc->createElement("server_status_4");
$domain_server_status_4->appendChild($doc->createCDATASection($server_status_4));		
$server_4->appendChild($domain_server_status_4);		
$domain_server_delegation_check_last_correct_4 = $doc->createElement("server_delegation_check_last_correct_4");
$domain_server_delegation_check_last_correct_4->appendChild($doc->createCDATASection($server_delegation_check_last_correct_4));		
$server_4->appendChild($domain_server_delegation_check_last_correct_4);	
$domain_server_ipv4_4 = $doc->createElement("server_ipv4_4");
$domain_server_ipv4_4->appendChild($doc->createCDATASection($server_ipv4_4));		
$server_4->appendChild($domain_server_ipv4_4);
$domain_server_ipv6_4 = $doc->createElement("server_ipv6_4");
$domain_server_ipv6_4->appendChild($doc->createCDATASection($server_ipv6_4));		
$server_4->appendChild($domain_server_ipv6_4);		
$name_servers->appendChild($server_4);
	
$server_5 = $doc->createElement("server_5");
$name_servers->appendChild($server_5);	
$domain_server_name_5 = $doc->createElement("server_name_5");
$domain_server_name_5->appendChild($doc->createCDATASection($server_name_5));		
$server_5->appendChild($domain_server_name_5);
$domain_server_name_unicode_5 = $doc->createElement("server_name_unicode_5");
$domain_server_name_unicode_5->appendChild($doc->createCDATASection($server_name_unicode_5));		
$server_5->appendChild($domain_server_name_unicode_5);
$domain_server_delegation_check_5 = $doc->createElement("server_delegation_check_5");
$domain_server_delegation_check_5->appendChild($doc->createCDATASection($server_delegation_check_5));		
$server_5->appendChild($domain_server_delegation_check_5);
$domain_server_status_5 = $doc->createElement("server_status_5");
$domain_server_status_5->appendChild($doc->createCDATASection($server_status_5));		
$server_5->appendChild($domain_server_status_5);		
$domain_server_delegation_check_last_correct_5 = $doc->createElement("server_delegation_check_last_correct_5");
$domain_server_delegation_check_last_correct_5->appendChild($doc->createCDATASection($server_delegation_check_last_correct_5));		
$server_5->appendChild($domain_server_delegation_check_last_correct_5);	
$domain_server_ipv4_5 = $doc->createElement("server_ipv4_5");
$domain_server_ipv4_5->appendChild($doc->createCDATASection($server_ipv4_5));		
$server_5->appendChild($domain_server_ipv4_5);
$domain_server_ipv6_5 = $doc->createElement("server_ipv6_5");
$domain_server_ipv6_5->appendChild($doc->createCDATASection($server_ipv6_5));		
$server_5->appendChild($domain_server_ipv6_5);		
$name_servers->appendChild($server_5);
$server_6 = $doc->createElement("server_6");
$name_servers->appendChild($server_6);	
$domain_server_name_6 = $doc->createElement("server_name_6");
$domain_server_name_6->appendChild($doc->createCDATASection($server_name_6));		
$server_6->appendChild($domain_server_name_6);
$domain_server_name_unicode_6 = $doc->createElement("server_name_unicode_6");
$domain_server_name_unicode_6->appendChild($doc->createCDATASection($server_name_unicode_6));		
$server_6->appendChild($domain_server_name_unicode_6);
$domain_server_delegation_check_6 = $doc->createElement("server_delegation_check_6");
$domain_server_delegation_check_6->appendChild($doc->createCDATASection($server_delegation_check_6));		
$server_6->appendChild($domain_server_delegation_check_6);
$domain_server_status_6 = $doc->createElement("server_status_6");
$domain_server_status_6->appendChild($doc->createCDATASection($server_status_6));		
$server_6->appendChild($domain_server_status_6);		
$domain_server_delegation_check_last_correct_6 = $doc->createElement("server_delegation_check_last_correct_6");
$domain_server_delegation_check_last_correct_6->appendChild($doc->createCDATASection($server_delegation_check_last_correct_6));		
$server_6->appendChild($domain_server_delegation_check_last_correct_6);
$domain_server_ipv4_6 = $doc->createElement("server_ipv4_6");
$domain_server_ipv4_6->appendChild($doc->createCDATASection($server_ipv4_6));		
$server_6->appendChild($domain_server_ipv4_6);
$domain_server_ipv6_6 = $doc->createElement("server_ipv6_6");
$domain_server_ipv6_6->appendChild($doc->createCDATASection($server_ipv6_6));		
$server_6->appendChild($domain_server_ipv6_6);		
$name_servers->appendChild($server_6);	
	
$domain_name_servers_dnssec = $doc->createElement("name_servers_dnssec");
$domain_name_servers_dnssec->appendChild($doc->createCDATASection($name_servers_dnssec));	
$name_servers->appendChild($domain_name_servers_dnssec);
$domain_name_servers_dnssec_algorithm = $doc->createElement("name_servers_dnssec_algorithm");
$domain_name_servers_dnssec_algorithm->appendChild($doc->createCDATASection($name_servers_dnssec_algorithm));	
$name_servers->appendChild($domain_name_servers_dnssec_algorithm);	
	
$domain->appendChild($name_servers);
		
$domain_raw_rdap_data = $doc->createElement("raw_rdap_data");	
$domain_raw_rdap_data->appendChild($doc->createCDATASection($raw_rdap_data));
$domain->appendChild($domain_raw_rdap_data);
	
$domain_raw_whois_data = $doc->createElement("raw_whois_data");	
$domain_raw_whois_data->appendChild($doc->createCDATASection($raw_whois_data));		
$domain->appendChild($domain_raw_whois_data);	
	
$domains->appendChild($domain);
$doc->appendChild($domains);
//return $doc->saveXML(NULL, LIBXML_NOEMPTYTAG);
return $doc->saveXML();
}
?>