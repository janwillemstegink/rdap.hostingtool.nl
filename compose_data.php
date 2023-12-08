<?php
//$_GET['domain'] = 'webhostingtech.nl';
//$_GET['domain'] = 'cyberfusion.nl';

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

$url = 'https://rdap.sidn.nl/domain/'.$inputdomain;
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
$zone_language = $obj['lang'];

$zone_toplevel_domain = mb_substr($inputdomain, strrpos($inputdomain, '.') + 1);
$zone_description = 'NL Domain Registry';
$zone_menu = 'https://nl.sidn.nl';
$zone_support = 'support@sidn.nl';
$zone_registry_trade_name = 'SIDN';
$zone_registry_web_id = '';
$zone_time_zone = 'Europe/Amsterdam';

$url = 'https://rdap.sidn.nl/domain/'.$inputdomain;
$obj = json_decode(file_get_contents($url), true);
$view_datetime = date('Y-m-d\TH:i:s\Z');
$view_type = 'public';	
$view_links_value = $obj['links'][0]['value'];
//$view_links_value = str_replace('https://', '', $view_links_value);	
//$view_links_value = str_replace($inputdomain, '', $view_links_value);	
$view_links_related = $obj['links'][0]['rel'];
$view_links_href = $obj['links'][0]['href'];
$view_links_type = $obj['links'][0]['type'];	
	
//$created = $obj['events'][0]['eventDate'];
//$updated = $obj['events'][1]['eventDate'];
//$refreshed = $obj['events'][2]['eventDate'];
$type = 'business use';
$status = $obj['status'][0];
$registrar_iana_id = $obj['entities'][0]['publicIds'][0]['identifier'];
$registrar_iana_id = '1603';
$name = $obj['ldhName'];
$name_unicode = $obj['ldhName'];
if ($obj['secureDNS']['delegationSigned'] == 1)	{
	$name_servers_dnssec = 'yes';
}
elseif ($obj['secureDNS']['delegationSigned'] == 0)	{
	$name_servers_dnssec = 'no';	
}
else	{
	$name_servers_dnssec = 'NA';	
}	
//$registrar_trade_name = $obj['entities'][3]['vcardArray'][1][1][3];
//$registrar_street = $obj['entities'][3]['vcardArray'][1][2][3][2];
//$registrar_city = $obj['entities'][3]['vcardArray'][1][2][3][3];
//$registrar_postal_code = $obj['entities'][3]['vcardArray'][1][2][3][5];
//$registrar_country_code = $obj['entities'][3]['vcardArray'][1][2][3][6];
//$registrar_abuse_email = $obj['entities'][3]['entities'][0]['vcardArray'][1][2][3];
	
//$registrar_abuse_phone = $obj['entities'][3]['entities'][0]['vcardArray'][1][2][3];	
//$registrar_abuse_email = $obj['entities'][3]['entities'][0]['vcardArray'][1][3][3];

$registrar_protected = 'contact_id,personal_name,phone,fax,email';	
//$reseller_trade_name = $obj['entities'][4]['vcardArray'][1][1][3];
//$reseller_street = $obj['entities'][4]['vcardArray'][1][2][3][2];
//$reseller_city = $obj['entities'][4]['vcardArray'][1][2][3][3];
//$reseller_postal_code = $obj['entities'][4]['vcardArray'][1][2][3][5];
//$reseller_country_code = $obj['entities'][4]['vcardArray'][1][2][3][6];
$reseller_protected = 'contact_id,personal_name,phone,fax,email';
//$registrant_trade_name = $obj['entities'][0]['vcardArray'][1][1][3];
$registrant_web_id = 'NL88COMM01234567890123456789012345';	
$registrant_protected = 'contact_id,personal_name,phone,fax,email,address';	
//$admin_email = $obj['entities'][2]['vcardArray'][1][2][3];
$admin_protected = 'contact_id,personal_name,phone,fax,address,country';	
//$tech_email = $obj['entities'][1]['vcardArray'][1][2][3];
$tech_protected = 'contact_id,personal_name,phone,fax,address,country';	

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
$registrar = -1;	
$abuse = -1;
$reseller = -1;	
$registrant = -1;
$admin = -1;
$tech = -1;	
	
foreach($obj as $key1 => $value1) {
    foreach($value1 as $key2 => $value2) {
		foreach($value2 as $key3 => $value3) {
			foreach($value3 as $key4 => $value4) {
				if ($value4 == 'registrar')	{
					$registrar = $key2;
				}
				elseif ($value4 == 'reseller')	{
					$reseller = $key2;
				}
				elseif ($value4 == 'registrant')	{
					$registrant = $key2;
				}
				elseif ($value4 == 'administrative')	{
					$admin = $key2;	
				}
				elseif ($value4 == 'technical')	{
					$tech = $key2;	
				}
				foreach($value4 as $key5 => $value5) {
					foreach($value5 as $key6 => $value6) {
						if ($value6 == 'abuse')	{
							$abuse = $key4;
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
					$created = $value2['eventDate'];
				}
				elseif ($value3 == 'last changed')	{
					$updated = $value2['eventDate'];
				}
				elseif ($value3 == 'last update of RDAP database')	{
					$refreshed = $value2['eventDate'];
				}
			}	
			foreach($value3 as $key4 => $value4) {
				foreach($value4 as $key5 => $value5) {
					foreach($value5 as $key6 => $value6) {
						if ($key1 == 'entities' and $key2 == $registrar and $key3 == 'vcardArray' and $value5[0] == 'fn')	{
							$registrar_trade_name = $value5[3];
						}
						elseif ($key1 == 'entities' and $key2 == $reseller and $key3 == 'vcardArray' and $value5[0] == 'fn')	{
							$reseller_trade_name = $value5[3];
						}
						elseif ($key1 == 'entities' and $key2 == $registrant and $key3 == 'vcardArray' and $value5[0] == 'fn')	{
							$registrant_trade_name = $value5[3];
						}
						elseif ($key1 == 'entities' and $key2 == $admin and $key3 == 'vcardArray' and $value5[0] == 'email')	{
							$admin_email = $value6;
						}
						elseif ($key1 == 'entities' and $key2 == $tech and $key3 == 'vcardArray' and $value5[0] == 'email')	{
							$tech_email = $value6;		
						}	
						foreach($value6 as $key7 => $value7) {
							if ($key4 == 1 and $key5 == 2 and $key6 == 3)	{
								if ($key1 == 'entities' and $key2 == $registrar and $key3 == 'vcardArray' and $value5[0] == 'adr')	{
									$registrar_street = $value6[2];
									$registrar_city = $value6[3];
									$registrar_postal_code = $value6[5];
									$registrar_country_code = $value6[6];
								}
								elseif ($key1 == 'entities' and $key2 == $reseller and $key3 == 'vcardArray' and $value5[0] == 'adr')	{
									$reseller_street = $value6[2];
									$reseller_city = $value6[3];
									$reseller_postal_code = $value6[5];
									$reseller_country_code = $value6[6];
								}
							}
							foreach($value7 as $key8 => $value8) {
								if ($key1 == 'entities' and $key2 == $registrar and $key3 == 'entities' and $key4 == $abuse and $key5 == 'vcardArray' and $key6 == 1)	{
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

$domain_zone_registry_trade_name = $doc->createElement("zone_registry_trade_name");
$domain_zone_registry_trade_name->appendChild($doc->createCDATASection($zone_registry_trade_name));	
$zone->appendChild($domain_zone_registry_trade_name);
	
$domain_zone_time_zone = $doc->createElement("zone_time_zone");
$domain_zone_time_zone->appendChild($doc->createCDATASection($zone_time_zone));	
$zone->appendChild($domain_zone_time_zone);
	
$domain_zone_language = $doc->createElement("zone_language");
$domain_zone_language->appendChild($doc->createCDATASection($zone_language));	
$zone->appendChild($domain_zone_language);	
	
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
	
$domain_view_datetime = $doc->createElement("view_datetime");
$domain_view_datetime->appendChild($doc->createCDATASection($view_datetime));
$view->appendChild($domain_view_datetime);

$domain_view_type = $doc->createElement("view_type");
$domain_view_type->appendChild($doc->createCDATASection($view_type));	
$view->appendChild($domain_view_type);

$domain_view_links_value = $doc->createElement("view_links_value");
$domain_view_links_value->appendChild($doc->createCDATASection($view_links_value));	
$view->appendChild($domain_view_links_value);
	
$domain_view_links_related = $doc->createElement("view_links_related");
$domain_view_links_related->appendChild($doc->createCDATASection($view_links_related));	
$view->appendChild($domain_view_links_related);
	
$domain_view_links_href = $doc->createElement("view_links_href");
$domain_view_links_href->appendChild($doc->createCDATASection($view_links_href));	
$view->appendChild($domain_view_links_href);
	
$domain_view_links_type = $doc->createElement("view_links_type");
$domain_view_links_type->appendChild($doc->createCDATASection($view_links_type));	
$view->appendChild($domain_view_links_type);
	
$domain->appendChild($view);
	
$domain_name = $doc->createElement("domain_name");
$domain_name->appendChild($doc->createCDATASection($name));	
$domain->appendChild($domain_name);
$domain_name_unicode = $doc->createElement("domain_name_unicode");
$domain_name_unicode->appendChild($doc->createCDATASection($name_unicode));	
$domain->appendChild($domain_name_unicode);
$domain_type = $doc->createElement("domain_type");
$domain_type->appendChild($doc->createCDATASection($type));	
$domain->appendChild($domain_type);	
$domain_status = $doc->createElement("domain_status");
$domain_status->appendChild($doc->createCDATASection($status));	
$domain->appendChild($domain_status);	
$domain_created = $doc->createElement("domain_created");
$domain_created->appendChild($doc->createCDATASection($created));	
$domain->appendChild($domain_created);	
$domain_updated = $doc->createElement("domain_updated");
$domain_updated->appendChild($doc->createCDATASection($updated));	
$domain->appendChild($domain_updated);	
$domain_refreshed = $doc->createElement("domain_refreshed");
$domain_refreshed->appendChild($doc->createCDATASection($refreshed));	
$domain->appendChild($domain_refreshed);	

$registrar = $doc->createElement("registrar");
$domain->appendChild($registrar);
$domain_registrar_trade_name = $doc->createElement("registrar_trade_name");
$domain_registrar_trade_name->appendChild($doc->createCDATASection($registrar_trade_name));	
$registrar->appendChild($domain_registrar_trade_name);
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
$domain_reseller_trade_name = $doc->createElement("reseller_trade_name");
$domain_reseller_trade_name->appendChild($doc->createCDATASection($reseller_trade_name));	
$reseller->appendChild($domain_reseller_trade_name);
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
$domain_reseller_protected = $doc->createElement("reseller_protected");	
$domain_reseller_protected->appendChild($doc->createCDATASection($reseller_protected));	
$reseller->appendChild($domain_reseller_protected);	
$domain->appendChild($reseller);
	
$registrant = $doc->createElement("registrant");
$domain->appendChild($registrant);
$domain_registrant_web_id = $doc->createElement("registrant_web_id");
$domain_registrant_web_id->appendChild($doc->createCDATASection($registrant_web_id));	
$registrant->appendChild($domain_registrant_web_id);
$domain_registrant_trade_name = $doc->createElement("registrant_trade_name");
$domain_registrant_trade_name->appendChild($doc->createCDATASection($registrant_trade_name));	
$registrant->appendChild($domain_registrant_trade_name);
$domain_registrant_protected = $doc->createElement("registrant_protected");	
$domain_registrant_protected->appendChild($doc->createCDATASection($registrant_protected));	
$registrant->appendChild($domain_registrant_protected);	
$domain->appendChild($registrant);
	
$admin = $doc->createElement("admin");
$domain->appendChild($admin);		
$domain_admin_email = $doc->createElement("admin_email");
$domain_admin_email->appendChild($doc->createCDATASection($admin_email));	
$admin->appendChild($domain_admin_email);
$domain_admin_protected = $doc->createElement("admin_protected");	
$domain_admin_protected->appendChild($doc->createCDATASection($admin_protected));	
$admin->appendChild($domain_admin_protected);		
$domain->appendChild($admin);	
	
$tech = $doc->createElement("tech");
$domain->appendChild($tech);	
$domain_tech_email = $doc->createElement("tech_email");
$domain_tech_email->appendChild($doc->createCDATASection($tech_email));	
$tech->appendChild($domain_tech_email);
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