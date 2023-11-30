<?php
if (!empty($_GET['domain']))	{
	if (strlen(trim($_GET['domain'])))	{
		$domain = trim($_GET['domain']);
		if	($_GET['format'] == 'json')	{
			if	($_GET['type'] == 1)	{
				echo write_file1($domain);
				die();
			}
			elseif	($_GET['type'] == 2)	{
				echo write_file2($domain);
				die();
			}	
			else	{
				die("No data type matches.");	
			}
		}
		else	{
			die("No data format matches");	
		}
	}
	else	{	
		die("No domain name is filled as input");	
	}
}
else	{	
	die("No domain name variable as input");
}

function write_file1($inputdomain)	{

$url = 'https://rdap.sidn.nl/domain/'.$inputdomain;
$obj = json_decode(file_get_contents($url), true);
	
$rdap_conformance = $obj['rdapConformance'];
$object_class_name = $obj['objectClassName'];
$privacy_title_0_0 = $obj['notices'][0]['title'];
$privacy_description_0_0 = $obj['notices'][0]['description'][0];
$privacy_description_0_1 = $obj['notices'][0]['description'][1];
$copyright_title_1_0 = $obj['notices'][1]['title'];
$copyright_restrictions_1_0 = $obj['notices'][1]['description'][0];
$copyright_restrictions_1_1 = $obj['notices'][1]['description'][1];
$copyright_description_2_0 = $obj['notices'][2]['description'][0];
$copyright_description_2_1 = $obj['notices'][2]['description'][1];
$language = $obj['lang'];	
$links_value = $obj['links'][0]['value'];
//$links_value = str_replace('https://', '', $links_value);	
//$links_value = str_replace($inputdomain, '', $links_value);	
$links_rel = $obj['links'][0]['rel'];
$links_href = $obj['links'][0]['href'];
$links_type = $obj['links'][0]['type'];

$toplevel_domain = mb_substr($inputdomain, strrpos($inputdomain, '.') + 1);
$description = 'NL Domain Registry';
$menu = 'https://nl.sidn.nl';
$support = 'support@sidn.nl';
$registry_trade_name = 'SIDN';
$registry_web_id = '';
$time_zone = 'Europe/Amsterdam';

$doc = new DOMDocument("1.0", "UTF-8");
$doc->xmlStandalone = true;	
$doc->formatOutput = true;	
$zones = $doc->createElement("zones");
$doc->appendChild($zones);

$zone = $doc->createElement("zone");	
$zones->appendChild($zone);
$zone->setAttribute("item", $topleveldomain);

$zone_server = $doc->createElement("zone_server");
$zone_server->appendChild($doc->createCDATASection($server));	
$zone->appendChild($zone_server);
	
$zone_description = $doc->createElement("zone_description");
$zone_description->appendChild($doc->createCDATASection($description));	
$zone->appendChild($zone_description);
	
$zone_menu = $doc->createElement("zone_menu");
$zone_menu->appendChild($doc->createCDATASection($menu));	
$zone->appendChild($zone_menu);	
	
$zone_support = $doc->createElement("zone_support");
$zone_support->appendChild($doc->createCDATASection($support));	
$zone->appendChild($zone_support);
	
$zone_registry_web_id = $doc->createElement("zone_registry_web_id");
$zone_registry_web_id->appendChild($doc->createCDATASection($registry_web_id));	
$zone->appendChild($zone_registry_web_id);

$zone_registry_trade_name = $doc->createElement("zone_registry_trade_name");
$zone_registry_trade_name->appendChild($doc->createCDATASection($registry_trade_name));	
$zone->appendChild($zone_registry_trade_name);
	
$zone_time_zone = $doc->createElement("zone_time_zone");
$zone_time_zone->appendChild($doc->createCDATASection($time_zone));	
$zone->appendChild($zone_time_zone);
	
$zone_language = $doc->createElement("zone_language");
$zone_language->appendChild($doc->createCDATASection($language));	
$zone->appendChild($zone_language);
	
$zone_links_value = $doc->createElement("zone_links_value");
$zone_links_value->appendChild($doc->createCDATASection($links_value));	
$zone->appendChild($zone_links_value);
	
$zone_links_rel = $doc->createElement("zone_links_rel");
$zone_links_rel->appendChild($doc->createCDATASection($links_rel));	
$zone->appendChild($zone_links_rel);
	
$zone_links_href = $doc->createElement("zone_links_href");
$zone_links_href->appendChild($doc->createCDATASection($links_href));	
$zone->appendChild($zone_links_href);
	
$zone_links_type = $doc->createElement("zone_links_type");
$zone_links_type->appendChild($doc->createCDATASection($links_type));	
$zone->appendChild($zone_links_type);	
	
$zone_legal_restrictions = $doc->createElement("zone_legal_restrictions");
$zone_legal_restrictions->appendChild($doc->createCDATASection($copyright_restrictions_1_0));	
$zone->appendChild($zone_legal_restrictions);
	
$zone_translated_restrictions = $doc->createElement("zone_translated_restrictions");
$zone_translated_restrictions->appendChild($doc->createCDATASection($copyright_restrictions_1_1));		
$zone->appendChild($zone_translated_restrictions);	
	
$zones->appendChild($zone);
$doc->appendChild($zones);
	
//return $doc->saveXML(NULL, LIBXML_NOEMPTYTAG);	
return $doc->saveXML();
}	

function write_file2($inputdomain)	{
	
$url = 'https://rdap.sidn.nl/domain/'.$inputdomain;
$obj = json_decode(file_get_contents($url), true);
	
$created = $obj['events'][0]['eventDate'];
$updated = $obj['events'][1]['eventDate'];
$updated_rdap = $obj['events'][2]['eventDate'];
$type = 'business use';
$status = $obj['status'][0];
$name = $obj['ldhName'];
$name_unicode = $obj['ldhName'];
$name_servers_dnssec = $obj['secureDNS'][0]['delegationSigned'][0];
$registrant_web_id = 'NL88COMM01234567890123456789012345';
$registrant_trade_name = $obj['entities'][0]['vcardArray'][1][1][3];
$registrant_protected = 'contact_id,personal_name,phone,fax,email,address';
$tech_email = $obj['entities'][1]['vcardArray'][1][2][3];
$tech_protected = 'contact_id,personal_name,phone,fax,address,country';
$admin_email = $obj['entities'][2]['vcardArray'][1][2][3];
$admin_protected = 'contact_id,personal_name,phone,fax,address,country';	
$registrar_trade_name = $obj['entities'][3]['vcardArray'][1][1][3];
$registrar_street = $obj['entities'][3]['vcardArray'][1][2][3][2];
$registrar_city = $obj['entities'][3]['vcardArray'][1][2][3][3];
$registrar_postal_code = $obj['entities'][3]['vcardArray'][1][2][3][5];
$registrar_country_code = $obj['entities'][3]['vcardArray'][1][2][3][6];
$registrar_iana_id = '1603';
$registrar_abuse_email = $obj['entities'][3]['entities'][0][2][3][3];
$registrar_protected = 'personal_name,phone,fax,email';

$reseller_trade_name = $obj['entities'][4]['vcardArray'][1][1][3];
$reseller_street = $obj['entities'][4]['vcardArray'][1][2][3][2];
$reseller_city = $obj['entities'][4]['vcardArray'][1][2][3][3];
$reseller_postal_code = $obj['entities'][4]['vcardArray'][1][2][3][5];
$reseller_country_code = $obj['entities'][4]['vcardArray'][1][2][3][6];
$reseller_protected = 'personal_name,phone,fax,email';

$server_name_1 = $obj['nameservers'][0]['ldhName'];
$server_name_2 = $obj['nameservers'][1]['ldhName'];
$server_name_3 = $obj['nameservers'][2]['ldhName'];

$doc = new DOMDocument("1.0", "UTF-8");
$doc->xmlStandalone = true;	
$doc->formatOutput = true;
	
$domains = $doc->createElement("domains");
$doc->appendChild($domains);
$domain = $doc->createElement("domain");	
$domains->appendChild($domain);
$domain->setAttribute("item", $inputdomain);

$view = $doc->createElement("view");
$domain->appendChild($view);	
$domain_view_datetime = $doc->createElement("view_datetime");
$domain_view_datetime->appendChild($doc->createCDATASection(date("Y-m-d H:i:s")));	
$view->appendChild($domain_view_datetime);
$domain_view_type = $doc->createElement("view_type");
$domain_view_type->appendChild($doc->createCDATASection('public'));	
$view->appendChild($domain_view_type);
$domain->appendChild($view);
	
$domain_created = $doc->createElement("domain_created");
$domain_created->appendChild($doc->createCDATASection($created));	
$domain->appendChild($domain_created);	
$domain_updated = $doc->createElement("domain_updated");
$domain_updated->appendChild($doc->createCDATASection($updated));	
$domain->appendChild($domain_updated);	
$domain_updated_rdap = $doc->createElement("domain_updated_rdap");
$domain_updated_rdap->appendChild($doc->createCDATASection($updated_rdap));	
$domain->appendChild($domain_updated_rdap);	
$domain_type = $doc->createElement("domain_type");
$domain_type->appendChild($doc->createCDATASection($type));	
$domain->appendChild($domain_type);
$domain_status = $doc->createElement("domain_status");
$domain_status->appendChild($doc->createCDATASection($status));	
$domain->appendChild($domain_status);	
$domain_name = $doc->createElement("domain_name");
$domain_name->appendChild($doc->createCDATASection($name));	
$domain->appendChild($domain_name);
$domain_name_unicode = $doc->createElement("domain_name_unicode");
$domain_name_unicode->appendChild($doc->createCDATASection($name_unicode));	
$domain->appendChild($domain_name_unicode);
	
$domain_name_servers_dnssec = $doc->createElement("domain_name_servers_dnssec");
$domain_name_servers_dnssec->appendChild($doc->createCDATASection($name_servers_dnssec));	
$domain->appendChild($domain_name_servers_dnssec);
	
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
	
$tech = $doc->createElement("tech");
$domain->appendChild($tech);	
$domain_tech_email = $doc->createElement("tech_email");
$domain_tech_email->appendChild($doc->createCDATASection($tech_email));	
$tech->appendChild($domain_tech_email);
$domain_tech_protected = $doc->createElement("tech_protected");	
$domain_tech_protected->appendChild($doc->createCDATASection($tech_protected));	
$tech->appendChild($domain_tech_protected);		
$domain->appendChild($tech);
	
$admin = $doc->createElement("admin");
$domain->appendChild($admin);		
$domain_admin_email = $doc->createElement("admin_email");
$domain_admin_email->appendChild($doc->createCDATASection($admin_email));	
$admin->appendChild($domain_admin_email);
$domain_admin_protected = $doc->createElement("admin_protected");	
$domain_admin_protected->appendChild($doc->createCDATASection($admin_protected));	
$admin->appendChild($domain_admin_protected);		
$domain->appendChild($admin);	

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
$domain_registrar_abuse_email = $doc->createElement("registrar_abuse_email");
$domain_registrar_abuse_email->appendChild($doc->createCDATASection($registrar_abuse_email));	
$registrar->appendChild($domain_registrar_abuse_email);
$domain_registrar_protected = $doc->createElement("registrar_protected");	
$domain_registrar_protected->appendChild($doc->createCDATASection($registrar_protected));	
$registrar->appendChild($domain_registrar_protected);
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
	
$name_servers = $doc->createElement("name_servers");
$domain->appendChild($name_servers);

$server_1 = $doc->createElement("server_1");
$name_servers->appendChild($server_1);	
$domain_server_name_1 = $doc->createElement("server_name_1");
$domain_server_name_1->appendChild($doc->createCDATASection($server_name_1));		
$server_1->appendChild($domain_server_name_1);
$name_servers->appendChild($server_1);
	
$server_2 = $doc->createElement("server_2");
$name_servers->appendChild($server_2);	
$domain_server_name_2 = $doc->createElement("server_name_2");
$domain_server_name_2->appendChild($doc->createCDATASection($server_name_2));		
$server_2->appendChild($domain_server_name_2);
$name_servers->appendChild($server_2);	
	
$server_3 = $doc->createElement("server_3");
$name_servers->appendChild($server_3);	
$domain_server_name_3 = $doc->createElement("server_name_3");
$domain_server_name_3->appendChild($doc->createCDATASection($server_name_3));		
$server_3->appendChild($domain_server_name_3);
$name_servers->appendChild($server_3);	
	
$domain->appendChild($name_servers);	
	
$domains->appendChild($domain);
$doc->appendChild($domains);
//return $doc->saveXML(NULL, LIBXML_NOEMPTYTAG);
return $doc->saveXML();
}									
?>