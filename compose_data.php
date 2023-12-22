<?php
//$_GET['domain'] = 'webhostingtech.nl';
//$_GET['domain'] = 'cyberfusion.nl';
//$_GET['domain'] = 'meetingdistrict.com';
//$_GET['domain'] = 'kcdekempen.nl';

if (!empty($_GET['domain']))	{
	if (strlen(trim($_GET['domain'])))	{
		$domain = trim($_GET['domain']);
        echo write_file($domain);
		die();

	}
	else	{	
		die("No domain name is filled as input");	
	}
}
else	{	
	die("No domain name variable as input");
}

function write_file($inputdomain)	{
	
$zone_toplevel_domain = mb_substr($inputdomain, strrpos($inputdomain, '.') + 1);	

if ($zone_toplevel_domain == 'nl')	{	
	$url = 'https://rdap.sidn.nl/domain/'.$inputdomain;
}	
elseif ($zone_toplevel_domain == 'com')	{
	//$url = 'https://rdap.namebright.com/rdap/domain/'.$inputdomain;
	$url = 'https://rdap.verisign.com/com/v1/domain/'.$inputdomain;	
}
else	{
	die("no .nl or .com domain is entered");				
}		
$obj = json_decode(file_get_contents($url), true);
	
$rdap_conformance = $obj['rdapConformance'];
$object_class_name = $obj['objectClassName'];
$zone_privacy_title = $obj['notices'][0]['title'];
$zone_privacy_legal = $obj['notices'][0]['description'][0];	
$zone_privacy_translated = $obj['notices'][0]['description'][1];
$zone_copyright_title = $obj['notices'][1]['title'];
$zone_copyright_legal = $obj['notices'][1]['description'][0];
$zone_copyright_translated = $obj['notices'][1]['description'][1];
$zone_description_legal = $obj['notices'][2]['description'][0];
$zone_description_translated = $obj['notices'][2]['description'][1];
if ($zone_toplevel_domain == 'nl')	{
	$zone_description = 'NL Domain Registry';
	$zone_menu = 'https://nl.sidn.nl';
	$zone_support = 'support@sidn.nl';
	$zone_registry_web_id = '';
	$zone_registry_full_name = 'SIDN B.V.';
}
else	{
	$zone_description = '';
	$zone_menu = '';
	$zone_support = '';
	$zone_registry_web_id = '';
	$zone_registry_full_name = '';
}
$zone_registry_language = $obj['lang'];	
$view_type = 'public';	
$view_links_value_0 = $obj['links'][0]['value'];
$view_links_related_0 = $obj['links'][0]['rel'];
$view_links_href_0 = $obj['links'][0]['href'];
$view_links_href_lang_0 = $obj['links'][0]['hreflang'];
$view_links_title_0 = $obj['links'][0]['title'];
$view_links_media_0 = $obj['links'][0]['media'];
$view_links_type_0 = $obj['links'][0]['type'];
	
$view_links_value_1 = $obj['links'][1]['value'];
$view_links_related_1 = $obj['links'][1]['rel'];
$view_links_href_1 = $obj['links'][1]['href'];
$view_links_href_lang_1 = $obj['links'][1]['hreflang'];
$view_links_title_1 = $obj['links'][1]['title'];
$view_links_media_1 = $obj['links'][1]['media'];
$view_links_type_1 = $obj['links'][1]['type'];	
	
$status = $obj['status'][0];
$registrar_iana_id = $obj['entities'][0]['publicIds'][0]['identifier'];
$name = $obj['ldhName'];
$name_unicode = $obj['ldhName'];
if ($obj['secureDNS']['delegationSigned'] == 1)	{
	$name_servers_dnssec = 'yes';
}
elseif ($obj['secureDNS']['delegationSigned'] == 0 and strlen(strval($obj['secureDNS']['delegationSigned'])))	{
	$name_servers_dnssec = 'no';	
}
else	{
	$name_servers_dnssec = 'NA';	
}
$registrar_protected = 'contact_id,name,phone,fax,email';	
$registrar_name = '';
$reseller_name = '';
$registrant_name = '';
$registar_kind = '';
$reseller_kind = '';
$registrant_kind = '';
$registrar_language_pref_1 = '';
$registrar_language_pref_2 = '';
$reseller_language_pref_1 = '';
$reseller_language_pref_2 = '';
$registrant_language_pref_1 = '';
$registrant_language_pref_2 = '';
$admin_language_pref_1 = '';
$admin_language_pref_2 = '';
$tech_language_pref_1 = '';
$tech_language_pref_2 = '';
$reseller_full_name = '';
$reseller_street = '';
$reseller_city = '';
$reseller_postal_code = '';
$reseller_country_code = '';
$reseller_protected = 'contact_id,name,phone,fax,email';
//$registrant_full_name = $obj['entities'][0]['vcardArray'][1][1][3];
$registrant_web_id = 'NL88COMM01234567890123456789012345';
$registrant_full_name = '';
$registrant_street = '';
$registrant_city = '';
$registrant_postal_code = '';
$registrant_country_code = '';	
$registrant_protected = 'contact_id,name,phone,fax,email,address';	
//$admin_email = $obj['entities'][2]['vcardArray'][1][2][3];
$admin_country_code = '';	
$admin_protected = 'contact_id,name,phone,fax,address,country';	
//$tech_email = $obj['entities'][1]['vcardArray'][1][2][3];
$tech_country_code = '';	
$tech_protected = 'contact_id,name,phone,fax,address,country';	

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
	
$registrar_abuse_email = 'NA';
$entity_registrar = -1;	
$entity_abuse = -1;
$entity_reseller = -1;	
$entity_registrant = -1;
$entity_admin = -1;
$entity_tech = -1;
foreach($obj as $key1 => $value1) {
    foreach($value1 as $key2 => $value2) {
		foreach($value2 as $key3 => $value3) {
			foreach($value3 as $key4 => $value4) {
				if ($value4 == 'registrar')	{
					$entity_registrar = $key2;
				}
				elseif ($value4 == 'reseller')	{
					$entity_reseller = $key2;
				}
				elseif ($value4 == 'registrant')	{
					$entity_registrant = $key2;
				}
				elseif ($value4 == 'administrative')	{
					$entity_admin = $key2;	
				}
				elseif ($value4 == 'technical')	{
					$entity_tech = $key2;
				}
				foreach($value4 as $key5 => $value5) {
					foreach($value5 as $key6 => $value6) {
						if ($value6 == 'abuse')	{
							$entity_abuse = $key4;
						}
					}	
				}
			}
		}
	}
}
foreach($obj as $key1 => $value1) {
	foreach($value1 as $key2 => $value2) {
		foreach($value2 as $key3 => $value3) {
			if ($key1 == 'events' )	{
				if ($value3 == 'registration')	{
					$registered = $value2['eventDate'];
				}
				elseif ($value3 == 'last changed')	{
					$last_changed = $value2['eventDate'];
				}				
				elseif ($value3 == 'last update of RDAP database')	{
					$last_updated = $value2['eventDate'];
				}
				elseif ($value3 == 'expiration')	{
					$will_expire = $value2['eventDate'];
				}
			}	
			foreach($value3 as $key4 => $value4) {
				foreach($value4 as $key5 => $value5) {
					foreach($value5 as $key6 => $value6) {
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value6 == 'fn')	{
							if ($key2 == $entity_registrar)	{
								$registrar_full_name = $value5[3];
							}
							if ($key2 == $entity_reseller)	{
								$reseller_full_name = $value5[3];
							}
							if ($key2 == $entity_registrant)	{
								$registrant_full_name = $value5[3];
							}
							if ($key2 == $entity_admin)	{
								$admin_full_name = $value5[3];
							}
							if ($key2 == $entity_tech)	{
								$tech_full_name = $value5[3];
							}
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value6 == 'n')	{
							if ($key2 == $entity_registrar)	{
								$registrar_name = $value5[3][0];	
								if (strlen($value5[3][1]))	{
									$registrar_name .= ', '. $value5[3][1];
								}
							}
							if ($key2 == $entity_reseller)	{
								$reseller_name = $value5[3][0];	
								if (strlen($value5[3][1]))	{
									$reseller_name .= ', '. $value5[3][1];
								}
							}
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
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value6 == 'kind')	{
							if ($key2 == $entity_registrar)	{
								$registrar_kind = $value5[3];
							}
							if ($key2 == $entity_reseller)	{
								$reseller_kind = $value5[3];
							}
							if ($key2 == $entity_registrant)	{
								$registrant_kind = $value5[3];
							}
							if ($key2 == $entity_admin)	{
								$admin_kind = $value5[3];
							}
							if ($key2 == $entity_tech)	{
								$tech_kind = $value5[3];
							}							
						}
						if ($key1 == 'entities' and $key3 == 'vcardArray' and $value6 == 'lang')	{
							if ($key2 == $entity_registraR) 		{
								if ($value6['pref'] == 1)	$registrar_language_pref_1 = $value5[3];
								if ($value6['pref'] == 2)	$registrar_language_pref_2 = $value5[3];
							}
							if ($key2 == $entity_reseller)	{
								if ($value6['pref'] == 1)	$reseller_language_pref_1 = $value5[3];
								if ($value6['pref'] == 2)	$reseller_language_pref_2 = $value5[3];
							}
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
							if ($key2 == $entity_registrar)	{
								$registrar_street = $value6[2];
								$registrar_city = $value6[3];
								$registrar_postal_code = $value6[5];
								$registrar_country_code = $value6[6];
							}	
							if ($key2 == $entity_reseller)	{
								$reseller_street = $value6[2];
								$reseller_city = $value6[3];
								$reseller_postal_code = $value6[5];
								$reseller_country_code = $value6[6];
							}
							if ($key2 == $entity_registrant)	{
								$registrant_country_code = $value6[6];
							}
							if ($key2 == $entity_admin)	{
								$admin_country_code = $value6[6];
							}	
							if ($key2 == $entity_tech)	{
								$tech_country_code = $value6[6];
							}							
						}
						foreach($value6 as $key7 => $value7) {
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

$domain_zone_menu = $doc->createElement("zone_menu");
$domain_zone_menu->appendChild($doc->createCDATASection($zone_menu));	
$zone->appendChild($domain_zone_menu);	
	
$domain_zone_support = $doc->createElement("zone_support");
$domain_zone_support->appendChild($doc->createCDATASection($zone_support));	
$zone->appendChild($domain_zone_support);
	
$domain_zone_registry_web_id = $doc->createElement("zone_registry_web_id");
$domain_zone_registry_web_id->appendChild($doc->createCDATASection($zone_registry_web_id));	
$zone->appendChild($domain_zone_registry_web_id);

$domain_zone_registry_full_name = $doc->createElement("zone_registry_full_name");
$domain_zone_registry_full_name->appendChild($doc->createCDATASection($zone_registry_full_name));	
$zone->appendChild($domain_zone_registry_full_name);
	
$domain_zone_registry_language = $doc->createElement("zone_registry_language");
$domain_zone_registry_language->appendChild($doc->createCDATASection($zone_registry_language));	
$zone->appendChild($domain_zone_registry_language);	
	
$domain_zone_privacy_title = $doc->createElement("zone_privacy_title");
$domain_zone_privacy_title->appendChild($doc->createCDATASection($zone_privacy_title));	
$zone->appendChild($domain_zone_privacy_title);	
	
$domain_zone_privacy_legal = $doc->createElement("zone_privacy_legal");
$domain_zone_privacy_legal->appendChild($doc->createCDATASection($zone_privacy_legal));	
$zone->appendChild($domain_zone_privacy_legal);
	
$domain_zone_privacy_translated = $doc->createElement("zone_privacy_translated");
$domain_zone_privacy_translated->appendChild($doc->createCDATASection($zone_privacy_translated));		
$zone->appendChild($domain_zone_privacy_translated);
	
$domain_zone_copyright_title = $doc->createElement("zone_copyright_title");
$domain_zone_copyright_title->appendChild($doc->createCDATASection($zone_copyright_title));	
$zone->appendChild($domain_zone_copyright_title);	

$domain_zone_copyright_legal = $doc->createElement("zone_copyright_legal");
$domain_zone_copyright_legal->appendChild($doc->createCDATASection($zone_copyright_legal));	
$zone->appendChild($domain_zone_copyright_legal);
	
$domain_zone_copyright_translated = $doc->createElement("zone_copyright_translated");
$domain_zone_copyright_translated->appendChild($doc->createCDATASection($zone_copyright_translated));		
$zone->appendChild($domain_zone_copyright_translated);	
	
$domain_zone_description_legal = $doc->createElement("zone_description_legal");
$domain_zone_description_legal->appendChild($doc->createCDATASection($zone_description_legal));	
$zone->appendChild($domain_zone_description_legal);
	
$domain_zone_description_translated = $doc->createElement("zone_description_translated");
$domain_zone_description_translated->appendChild($doc->createCDATASection($zone_description_translated));	
$zone->appendChild($domain_zone_description_translated);	
	
$domain->appendChild($zone);	

$view = $doc->createElement("view");
$domain->appendChild($view);

$domain_view_type = $doc->createElement("view_type");
$domain_view_type->appendChild($doc->createCDATASection($view_type));	
$view->appendChild($domain_view_type);

$domain_view_links_value_0 = $doc->createElement("view_links_value_0");
$domain_view_links_value_0->appendChild($doc->createCDATASection($view_links_value_0));	
$view->appendChild($domain_view_links_value_0);
	
$domain_view_links_related_0 = $doc->createElement("view_links_related_0");
$domain_view_links_related_0->appendChild($doc->createCDATASection($view_links_related_0));	
$view->appendChild($domain_view_links_related_0);
	
$domain_view_links_href_0 = $doc->createElement("view_links_href_0");
$domain_view_links_href_0->appendChild($doc->createCDATASection($view_links_href_0));	
$view->appendChild($domain_view_links_href_0);
	
$domain_view_links_href_lang_0 = $doc->createElement("view_links_href_lang_0");
$domain_view_links_href_lang_0->appendChild($doc->createCDATASection($view_links_href_lang_0));	
$view->appendChild($domain_view_links_href_lang_0);
	
$domain_view_links_title_0 = $doc->createElement("view_links_title_0");
$domain_view_links_title_0->appendChild($doc->createCDATASection($view_links_title_0));	
$view->appendChild($domain_view_links_title_0);	
	
$domain_view_links_media_0 = $doc->createElement("view_links_media_0");
$domain_view_links_media_0->appendChild($doc->createCDATASection($view_links_media_0));	
$view->appendChild($domain_view_links_media_0);

$domain_view_links_type_0 = $doc->createElement("view_links_type_0");
$domain_view_links_type_0->appendChild($doc->createCDATASection($view_links_type_0));	
$view->appendChild($domain_view_links_type_0);
	
$domain_view_links_value_1 = $doc->createElement("view_links_value_1");
$domain_view_links_value_1->appendChild($doc->createCDATASection($view_links_value_1));	
$view->appendChild($domain_view_links_value_1);
	
$domain_view_links_related_1 = $doc->createElement("view_links_related_1");
$domain_view_links_related_1->appendChild($doc->createCDATASection($view_links_related_1));	
$view->appendChild($domain_view_links_related_1);
	
$domain_view_links_href_1 = $doc->createElement("view_links_href_1");
$domain_view_links_href_1->appendChild($doc->createCDATASection($view_links_href_1));	
$view->appendChild($domain_view_links_href_1);
	
$domain_view_links_href_lang_1 = $doc->createElement("view_links_href_lang_1");
$domain_view_links_href_lang_1->appendChild($doc->createCDATASection($view_links_href_lang_1));	
$view->appendChild($domain_view_links_href_lang_1);
	
$domain_view_links_title_1 = $doc->createElement("view_links_title_1");
$domain_view_links_title_1->appendChild($doc->createCDATASection($view_links_title_1));	
$view->appendChild($domain_view_links_title_1);	
	
$domain_view_links_media_1 = $doc->createElement("view_links_media_1");
$domain_view_links_media_1->appendChild($doc->createCDATASection($view_links_media_1));	
$view->appendChild($domain_view_links_media_1);

$domain_view_links_type_1 = $doc->createElement("view_links_type_1");
$domain_view_links_type_1->appendChild($doc->createCDATASection($view_links_type_1));	
$view->appendChild($domain_view_links_type_1);	
	
$domain->appendChild($view);
	
$domain_name = $doc->createElement("domain_name");
$domain_name->appendChild($doc->createCDATASection($name));	
$domain->appendChild($domain_name);
$domain_name_unicode = $doc->createElement("domain_name_unicode");
$domain_name_unicode->appendChild($doc->createCDATASection($name_unicode));	
$domain->appendChild($domain_name_unicode);
$domain_status = $doc->createElement("domain_status");
$domain_status->appendChild($doc->createCDATASection($status));	
$domain->appendChild($domain_status);	
$domain_registered = $doc->createElement("domain_registered");
$domain_registered->appendChild($doc->createCDATASection($registered));	
$domain->appendChild($domain_registered);	
$domain_last_changed = $doc->createElement("domain_last_changed");
$domain_last_changed->appendChild($doc->createCDATASection($last_changed));	
$domain->appendChild($domain_last_changed);	
$domain_last_updated = $doc->createElement("domain_last_updated");
$domain_last_updated->appendChild($doc->createCDATASection($last_updated));	
$domain->appendChild($domain_last_updated);
$domain_will_expire = $doc->createElement("domain_will_expire");
$domain_will_expire->appendChild($doc->createCDATASection($will_expire));	
$domain->appendChild($domain_will_expire);	

$registrar = $doc->createElement("registrar");
$domain->appendChild($registrar);
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
	
$domain_registrar_abuse_email = $doc->createElement("registrar_abuse_email");
$domain_registrar_abuse_email->appendChild($doc->createCDATASection($registrar_abuse_email));	
$registrar->appendChild($domain_registrar_abuse_email);
$domain_registrar_abuse_phone = $doc->createElement("registrar_abuse_phone");
$domain_registrar_abuse_phone->appendChild($doc->createCDATASection($registrar_abuse_phone));	
$registrar->appendChild($domain_registrar_abuse_phone);		
$domain->appendChild($registrar);	

$reseller = $doc->createElement("reseller");
$domain->appendChild($reseller);
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
$domain->appendChild($reseller);
	
$registrant = $doc->createElement("registrant");
$domain->appendChild($registrant);
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
$domain->appendChild($registrant);
	
$admin = $doc->createElement("admin");
$domain->appendChild($admin);
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
$domain_server_ipv5_5 = $doc->createElement("server_ipv5_5");
$domain_server_ipv5_5->appendChild($doc->createCDATASection($server_ipv5_5));		
$server_5->appendChild($domain_server_ipv5_5);
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
$domain_server_ipv6_6 = $doc->createElement("server_ipv6_6");
$domain_server_ipv6_6->appendChild($doc->createCDATASection($server_ipv6_6));		
$server_6->appendChild($domain_server_ipv6_6);
$domain_server_ipv6_6 = $doc->createElement("server_ipv6_6");
$domain_server_ipv6_6->appendChild($doc->createCDATASection($server_ipv6_6));		
$server_6->appendChild($domain_server_ipv6_6);		
$name_servers->appendChild($server_6);	
	
$domain_name_servers_dnssec = $doc->createElement("name_servers_dnssec");
$domain_name_servers_dnssec->appendChild($doc->createCDATASection($name_servers_dnssec));	
$name_servers->appendChild($domain_name_servers_dnssec);	
	
$domain->appendChild($name_servers);	
	
$domains->appendChild($domain);
$doc->appendChild($domains);
//return $doc->saveXML(NULL, LIBXML_NOEMPTYTAG);
return $doc->saveXML();
}			
?>