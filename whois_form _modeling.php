<?php
session_start();  // is not needed using PHP Generator Scriptcase
echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="robots" content="index"><title>Whois modeling for Trade Register use</title>';

?><script>
function SwitchDisplay(type) {
	if (type == 20)	{ // domain
		var pre = 'B';
		var max = 5
	}
	else if (type == 30)	{ // registrar
		var pre = 'C';
		var max = 15
	}
	else if (type == 40)	{ // reseller
		var pre = 'D';
		var max = 11
	}
	else if (type == 50)	{ // registrant
		var pre = 'E';
		var max = 10
	}
	else if (type == 60)	{ // admin
		var pre = 'F';
		var max = 6
	}
	else if (type == 70)	{ // tech
		var pre = 'G';
		var max = 24
	}
	else if (type == 80)	{ // name servers
		var pre = 'H';
		var max = 18
	}
	else if (type == 90)	{ // registry
		var pre = 'I';
		var max = 2
	}
	else if (type == 100)	{ // conditions
		var pre = 'J';
		var max = 3
	}
	else	{
		return;	
	}
	
	for (let i = 1; i <= max; i++) {
		var id = pre + i.toString();
		if (typeof(document.getElementById(id)) != 'undefined' && document.getElementById(id) != null )	{
			if (document.getElementById(id).style.display == "table-row")	{
				document.getElementById(id).style.display = "none";	
			}
			else	{
				document.getElementById(id).style.display = "table-row";
			}
		}
	}
		
	function echo( ...s )	{
   		for(var i = 0; i < s.length; i++ ) {
    		document.write(s[i] + ' ');
		}
	}
}
	
function OpenMenu()	{
   	return;
}

</script><?php

echo '</head>';

if (!function_exists('simplexml_load_file')) {
	die('simpleXML functions are not available.');
}
if (ini_get("allow_url_fopen") == 1)	{
}
else	{	
	die('allow_url_fopen does not work.'); 	
}
$filesPath = '/home/admin/whois_file/';
$dataFile = 'whois_source_data.xml';
$restrictionsFile = 'whois_restrictions.xml';
$inputdomain = 'webhostingtech.nl';
$url1a = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=$inputdomain&format=xml&type=1";
$url2a = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=$inputdomain&format=xml&type=2";
$url1b = "http://whois.hostingtool.nl/".$dataFile;
$url2b = "http://whois.hostingtool.nl/".$restrictionsFile;

if (file_exists($filesPath.$dataFile) and false)	{ // skipping initial testing
	$xml1 = simplexml_load_file($filesPath.$dataFile) or die("Cannot load xml1 from path,");
}
elseif (file_exists($dataFile))	{
	$xml1 = simplexml_load_file($dataFile) or die("Cannot load xml1 from same folder.");
}
elseif (@get_headers($url1a) and false)	{ // skipping complex application to compose
	$xml1 = simplexml_load_file($url1a, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url1a from Scriptcase folder.");
}
else	{
	$url1 = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=$inputdomain&format=xml&type=1";
	$xml1 = simplexml_load_file($url1b, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url1b from public_html folder.");
}

if (file_exists($filesPath.$restrictionsFile and false))	{ // skipping initial testing
	$xml2 = simplexml_load_file($filesPath.$restrictionsFile) or die("Cannot load xml2 from path.");
}
elseif (file_exists($restrictionsFile))	{
	$xml2 = simplexml_load_file($restrictionsFile) or die("Cannot load xml2 from same folder.");
}
elseif (@get_headers($url2a))	{	
	$xml2 = simplexml_load_file($url2a, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url2a from Scriptcase folder.");
}
else	{	
	$xml2 = simplexml_load_file($url2b, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url2b from public_html folder.");
}
$html_text = '<body><div style="border-spacing=0; padding=0; border-width=0; padding-bottom:5px; line-height:120%;">
<table style="border-collapse:collapse; font-family:Helvetica, Arial, sans-serif; font-size:13px;">
<tr><th style="width:15%"></th><th style="width:25%"></th><th style="width:30%"></th><th style="width:30%"></th></tr>';
$html_text .= '<tr><td><b><u>Modeling of domain Whois fields</u></b></td><td><b>Data to retrieve in xml format from a registry</b></td>
<td><b>Toelichting</b> - <a href="https://www.sidn.nl/whois?q=webhostingtech.nl" target="_blank">sidn.nl/whois?q=webhostingtech.nl/whois</a></td>
<td><b>Explanation</b> - <a href="https://github.com/janwillemstegink/xml-whois" target="_blank">github.com/janwillemstegink/xml-whois</a></td></tr>';

foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="OpenMenu()">button to work instruction by a c-c registry</button></td><td></td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>view_datetime</b></td><td>'.$item->view->view_datetime.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>view_type</b></td><td>'.$item->view->view_type.'</td>
	<td>Typen: alles, isp (Internet Service Provider), publiek</td>
	<td>Types: all, isp (Internet Service Provider), public</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(20)">domain +/-</button></td><td></td><td></td><td></td></tr>';
	$html_text .= '<tr id="B1" style="display:none"><td><b>domain_id</b></td><td>'.$item->domain_id.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>domain_name</b></td><td>'.$item->domain_name.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>domain_status</b></td><td><b>'.$item->domain_status.'</b></td>
	<td>Statussen: vrij, onttrokken, uitgesloten, in aanvraag, actief, inactief, in quarantaine.</td>
	<td>Statusses: free, withdrawn, excluded, requested, active, inactive, in quarantaine.</td></tr>';
	$html_text .= '<tr><td><b>domain_web_publish</b></td><td>'.$item->domain_web_publish.'</td>
	<td>Als "web_publish" is ingesteld op "ja", dan komt publiceren van een zoekresultaat overeen.</td>
	<td>If "web_publish" is set to "yes", then publishing a search result will match.</td></tr>';
	$html_text .= '<tr id="B2" style="display:none"><td><b>domain_creation</b></td><td>'.$item->domain_creation.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>domain_last_renewal</b></td><td>'.$item->domain_last_renewal.'</td>
	<td>Een zoekmachine kan deze datum gebruiken om op jaarlijkse verlenging te controleren.</td>
	<td>A search engine can use this date to check for annual renewal.</td></tr>';
	$html_text .= '<tr id="B3" style="display:none"><td><b>domain_updated</b></td><td>'.$item->domain_updated.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="B4" style="display:none"><td><b>domain_expiration</b></td><td>'.$item->domain_expiration.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="B5" style="display:none"><td><b>domain_out_of_quarantine</b></td><td>'.$item->domain_out_of_quarantine.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(30)">registrar +/-</button></td><td></td><td></td><td></td></tr>';
	$html_text .= '<tr id="C1" style="display:none"><td><b>registrar_contact_id</b></td><td>'.$item->registrar->registrar_contact_id.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>registrar_company_name</b></td><td>'.$item->registrar->registrar_company_name.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>registrar_web_id</b></td><td>'.$item->registrar->registrar_web_id.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C2" style="display:none"><td><b>registrar_personal_name</b></td><td>'.$item->registrar->registrar_personal_name.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>registrar_abuse_email</b></td><td>'.$item->registrar->registrar_abuse_email.'</td>
	<td>Contactgegevens om misbruik te melden zijn niet verplicht voor een registrar.</td>
	<td>Contact details to report abuse are not mandatory for a registrar.</td></tr>';
	$html_text .= '<tr id="C3" style="display:none"><td><b>registrar_abuse_phone</b></td><td>'.$item->registrar->registrar_abuse_phone.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C4" style="display:none"><td><b>registrar_street</b></td><td>'.$item->registrar->registrar_street.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C5" style="display:none"><td><b>registrar_postal_code</b></td><td>'.$item->registrar->registrar_postal_code.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C6" style="display:none"><td><b>registrar_city</b></td><td>'.$item->registrar->registrar_city.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C7" style="display:none"><td><b>registrar_phone</b></td><td>'.$item->registrar->registrar_phone.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C8" style="display:none"><td><b>registrar_email</b></td><td>'.$item->registrar->registrar_email.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C9" style="display:none"><td><b>registrar_country_code</b></td><td>'.$item->registrar->registrar_country_code.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C10" style="display:none"><td><b>registrar_country_name</b></td><td>'.$item->registrar->registrar_country_name.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C11" style="display:none"><td><b>registrar_country_language</b></td><td>'.$item->registrar->registrar_country_language.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C12" style="display:none"><td><b>registrar_whois_server</b></td><td>'.$item->registrar->registrar_whois_server.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C13" style="display:none"><td><b>registrar_url</b></td><td>'.$item->registrar->registrar_url.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C14" style="display:none"><td><b>registrar_iana_id</b></td><td>'.$item->registrar->registrar_iana_id.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="C15" style="display:none"><td><b>registrar_protected</b></td><td>'.$item->registrar->registrar_protected.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	if (!empty($item->reseller->reseller_company_name))	{
		if (strlen(trim($item->reseller->reseller_company_name)))	{
			$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(40)">reseller +/-</button></td><td></td><td></td><td></td></tr>';
			$html_text .= '<tr id="D1" style="display:none"><td><b>reseller_contact_id</b></td><td>'.$item->reseller->reseller_contact_id.'</td><td></td><td></td></tr>';
			$html_text .= '<tr><td><b>reseller_company_name</b></td><td>'.$item->reseller->reseller_company_name.'</td>
			<td>De verwerkersovereenkomst kan tussen de reseller en de houder zijn.</td>
			<td>The processing agreement may be between the reseller and the holder.</td></tr>';
			$html_text .= '<tr><td><b>reseller_web_id</b></td><td>'.$item->reseller->reseller_web_id.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="D2" style="display:none"><td><b>reseller_personal_name</b></td><td>'.$item->reseller->reseller_personal_name.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="D3" style="display:none"><td><b>reseller_street</b></td><td>'.$item->reseller->reseller_street.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="D4" style="display:none"><td><b>reseller_postal_code</b></td><td>'.$item->reseller->reseller_postal_code.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="D5" style="display:none"><td><b>reseller_city</b></td><td>'.$item->reseller->reseller_city.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="D6" style="display:none"><td><b>reseller_phone</b></td><td>'.$item->reseller->reseller_phone.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="D7" style="display:none"><td><b>reseller_email</b></td><td>'.$item->reseller->reseller_email.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="D8" style="display:none"><td><b>reseller_country_code</b></td><td>'.$item->reseller->reseller_country_code.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="D9" style="display:none"><td><b>reseller_country_name</b></td><td>'.$item->reseller->reseller_country_name.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="D10" style="display:none"><td><b>reseller_country_language</b></td><td>'.$item->reseller->reseller_country_language.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="D11" style="display:none"><td><b>reseller_protected</b></td><td>'.$item->reseller->reseller_protected.'</td><td></td><td></td></tr>';
			$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
		}	
	}
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(50)">registrant +/-</button></td><td></td><td></td><td></td></tr>';
	$html_text .= '<tr id="E1" style="display:none"><td><b>registrant_contact_id</b></td><td>'.$item->registrant->registrant_contact_id.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>registrant_company_name</b></td><td>'.$item->registrant->registrant_company_name.'</td>
	<td>Er is legitiem houderschap met een bestaande, bedoelde en zichtbare bedrijfsnaam.</td>
	<td>Legitimate holdership exists with an existing, intended and visible company name.</td></tr>';
	$html_text .= '<tr><td><b>registrant_web_id</b></td><td>'.$item->registrant->registrant_web_id.'</td>
	<td>De KVK kan de benodigde "web_id"-identificatie aan het Handelsregister toevoegen.</td>
	<td>The Chamber of Commerce can add the required "web_id" identification to the Trade Register.</td></tr>';
	$html_text .= '<tr><td><b>registrant_personal_name</b></td><td>'.$item->registrant->registrant_personal_name.'</td>
	<td>De houdernaam van een natuurlijke persoon kan op verzoek zichtbaar zijn.</td>
	<td>The holder&apos;s name of a natural person can be visible on request.</td></tr>';	
	$html_text .= '<tr id="E2" style="display:none"><td><b>registrant_street</b></td><td>'.$item->registrant->registrant_street.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="E3" style="display:none"><td><b>registrant_postal_code</b></td><td>'.$item->registrant->registrant_postal_code.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="E4" style="display:none"><td><b>registrant_city</b></td><td>'.$item->registrant->registrant_city.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="E5" style="display:none"><td><b>registrant_phone</b></td><td>'.$item->registrant->registrant_phone.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="E6" style="display:none"><td><b>registrant_email</b></td><td>'.$item->registrant->registrant_email.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="E7" style="display:none"><td><b>registrant_country_code</b></td><td>'.$item->registrant->registrant_country_code.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="E8" style="display:none"><td><b>registrant_country_name</b></td><td>'.$item->registrant->registrant_country_name.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="E9" style="display:none"><td><b>registrant_country_language</b></td><td>'.$item->registrant->registrant_country_language.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="E10" style="display:none"><td><b>registrant_protected</b></td><td>'.$item->registrant->registrant_protected.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(60)">admin +/-</button></td><td></td><td></td><td></td></tr>';
	$html_text .= '<tr id="F1" style="display:none"><td><b>admin_contact_id</b></td><td>'.$item->admin->admin_contact_id.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="F2" style="display:none"><td><b>admin_company_name</b></td><td>'.$item->admin->admin_company_name.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="F3" style="display:none"><td><b>admin_web_id</b></td><td>'.$item->admin->admin_web_id.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="F4" style="display:none"><td><b>admin_personal_name</b></td><td>'.$item->admin->admin_personal_name.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="F5" style="display:none"><td><b>admin_phone</b></td><td>'.$item->admin->admin_phone.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>admin_email</b></td><td>'.$item->admin->admin_email.'</td>
	<td>Het administratief aanspreekpunt beantwoordt een verzoek, en stuurt het indien nodig door.</td>
	<td>The administratively responsible desk answers a request, and forwards it if necessary.</td></tr>';
	$html_text .= '<tr id="F6" style="display:none"><td><b>admin_protected</b></td><td>'.$item->admin->admin_protected.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(70)">tech +/-</button></td><td></td><td></td><td></td></tr>';
	if (!empty($item->tech->contact_1->tech_email_1))	{
		if (strlen(trim($item->tech->contact_1->tech_email_1)))	{	
			$html_text .= '<tr id="G1" style="display:none"><td><b>tech_contact_id_1</b></td><td>'.$item->tech->contact_1->tech_contact_id_1.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G2" style="display:none"><td><b>tech_company_name_1</b></td><td>'.$item->tech->contact_1->tech_company_name_1.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G3" style="display:none"><td><b>tech_web_id_1</b></td><td>'.$item->tech->contact_1->tech_web_id_1.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G4" style="display:none"><td><b>tech_personal_name_1</b></td><td>'.$item->tech->contact_1->tech_personal_name_1.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G5" style="display:none"><td><b>tech_phone_1</b></td><td>'.$item->tech->contact_1->tech_phone_1.'</td><td></td><td></td></tr>';
			$html_text .= '<tr><td><b>tech_email_1</b></td><td>'.$item->tech->contact_1->tech_email_1.'</td>
			<td>Een technisch contact reageert om een gemelde storing op te lossen.</td>
			<td>A technical contact responds to resolve a reported malfunction.</td></tr>';
			$html_text .= '<tr id="G6" style="display:none"><td><b>tech_protected_1</b></td><td>'.$item->tech->contact_1->tech_protected_1.'</td><td></td><td></td></tr>';
		}	
	}
	if (!empty($item->tech->contact_2->tech_email_2))	{
		if (strlen(trim($item->tech->contact_2->tech_email_2)))	{	
			$html_text .= '<tr id="G7" style="display:none"><td><b>tech_contact_id_2</b></td><td>'.$item->tech->contact_2->tech_contact_id_2.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G8" style="display:none"><td><b>tech_company_name_2</b></td><td>'.$item->tech->contact_2->tech_company_name_2.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G9" style="display:none"><td><b>tech_web_id_2</b></td><td>'.$item->tech->contact_2->tech_web_id_2.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G10" style="display:none"><td><b>tech_personal_name_2</b></td><td>'.$item->tech->contact_2->tech_personal_name_2.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G11" style="display:none"><td><b>tech_phone_2</b></td><td>'.$item->tech->contact_2->tech_phone_2.'</td><td></td><td></td></tr>';
			$html_text .= '<tr><td><b>tech_email_2</b></td><td>'.$item->tech->contact_2->tech_email_2.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G12" style="display:none"><td><b>tech_protected_2</b></td><td>'.$item->tech->contact_2->tech_protected_2.'</td><td></td><td></td></tr>';
		}	
	}
	if (!empty($item->tech->contact_3->tech_email_3))	{
		if (strlen(trim($item->tech->contact_3->tech_email_3)))	{	
			$html_text .= '<tr id="G13" style="display:none"><td><b>tech_contact_id_3</b></td><td>'.$item->tech->contact_3->tech_contact_id_3.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G14" style="display:none"><td><b>tech_company_name_3</b></td><td>'.$item->tech->contact_3->tech_company_name_3.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G15" style="display:none"><td><b>tech_web_id_3</b></td><td>'.$item->tech->contact_3->tech_web_id_3.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G16" style="display:none"><td><b>tech_personal_name_3</b></td><td>'.$item->tech->contact_3->tech_personal_name_3.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G17" style="display:none"><td><b>tech_phone_3</b></td><td>'.$item->tech->contact_3->tech_phone_3.'</td><td></td><td></td></tr>';
			$html_text .= '<tr><td><b>tech_email_3</b></td><td>'.$item->tech->contact_3->tech_email_3.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G18" style="display:none"><td><b>tech_protected_3</b></td><td>'.$item->tech->contact_3->tech_protected_3.'</td><td></td><td></td></tr>';
		}	
	}
	if (!empty($item->tech->contact_4->tech_email_4))	{
		if (strlen(trim($item->tech->contact_4->tech_email_4)))	{	
			$html_text .= '<tr id="G19" style="display:none"><td><b>tech_contact_id_4</b></td><td>'.$item->tech->contact_4->tech_contact_id_4.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G20" style="display:none"><td><b>tech_company_name_4</b></td><td>'.$item->tech->contact_4->tech_company_name_4.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G21" style="display:none"><td><b>tech_web_id_4</b></td><td>'.$item->tech->contact_4->tech_web_id_4.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G22" style="display:none"><td><b>tech_personal_name_4</b></td><td>'.$item->tech->contact_4->tech_personal_name_4.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G23" style="display:none"><td><b>tech_phone_4</b></td><td>'.$item->tech->contact_4->tech_phone_4.'</td><td></td><td></td></tr>';
			$html_text .= '<tr><td><b>tech_email_4</b></td><td>'.$item->tech->contact_4->tech_email_4.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="G24" style="display:none"><td><b>tech_protected_4</b></td><td>'.$item->tech->contact_4->tech_protected_4.'</td><td></td><td></td></tr>';
		}	
	}	
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(80)">name servers +/-</button></td><td></td><td></td><td></td></tr>';
	if (!empty($item->name_servers->server_1->server_name_1))	{
		if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
			$html_text .= '<tr id="H1" style="display:none"><td><b>server_name_1</b></td><td>'.$item->name_servers->server_1->server_name_1.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="H2" style="display:none"><td><b>ipv4_1</b></td><td>'.$item->name_servers->server_1->ipv4_1.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="H3" style="display:none"><td><b>ipv6_1</b></td><td>'.$item->name_servers->server_1->ipv6_1.'</td><td></td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_1->server_name_1))	{		
		if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
			$html_text .= '<tr id="H4" style="display:none"><td><b>server_name_2</b></td><td>'.$item->name_servers->server_2->server_name_2.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="H5" style="display:none"><td><b>ipv4_2</b></td><td>'.$item->name_servers->server_2->ipv4_2.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="H6" style="display:none"><td><b>ipv6_2</b></td><td>'.$item->name_servers->server_2->ipv6_2.'</td><td></td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_3->server_name_3))	{
		if (strlen(trim($item->name_servers->server_3->server_name_3)))	{
			$html_text .= '<tr id="H7" style="display:none"><td><b>server_name_3</b></td><td>'.$item->name_servers->server_3->server_name_3.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="H8" style="display:none"><td><b>ipv4_3</b></td><td>'.$item->name_servers->server_3->ipv4_3.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="H9" style="display:none"><td><b>ipv6_3</b></td><td>'.$item->name_servers->server_3->ipv6_3.'</td><td></td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_4->server_name_4))	{	
		if (strlen(trim($item->name_servers->server_4->server_name_4)))	{
			$html_text .= '<tr id="H10" style="display:none"><td><b>server_name_4</b></td><td>'.$item->name_servers->server_4->server_name_4.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="H11" style="display:none"><td><b>ipv4_4</b></td><td>'.$item->name_servers->server_4->ipv4_4.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="H12" style="display:none"><td><b>ipv6_4</b></td><td>'.$item->name_servers->server_4->ipv6_4.'</td><td></td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_5->server_name_5))	{		
		if (strlen(trim($item->name_servers->server_5->server_name_5)))	{
			$html_text .= '<tr id="H13" style="display:none"><td><b>server_name_5</b></td><td>'.$item->name_servers->server_5->server_name_5.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="H14" style="display:none"><td><b>ipv4_5</b></td><td>'.$item->name_servers->server_5->ipv4_5.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="H15" style="display:none"><td><b>ipv6_5</b></td><td>'.$item->name_servers->server_5->ipv6_5.'</td><td></td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_6->server_name_6))	{
		if (strlen(trim($item->name_servers->server_6->server_name_6)))	{
			$html_text .= '<tr id="H16" style="display:none"><td><b>server_name_6</b></td><td>'.$item->name_servers->server_6->server_name_6.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="H17" style="display:none"><td><b>ipv4_6</b></td><td>'.$item->name_servers->server_6->ipv4_6.'</td><td></td><td></td></tr>';
			$html_text .= '<tr id="H18" style="display:none"><td><b>ipv6_6</b></td><td>'.$item->name_servers->server_6->ipv6_6.'</td><td></td><td></td></tr>';
		}	
	}
	$html_text .= '<tr><td><b>name_servers_dnssec</b></td><td>'.$item->name_servers->name_servers_dnssec.'</td>
	<td>DNSSEC is een web-route-beveiligingsvoorziening op het DNS (Domain Name System).</td>
	<td>DNSSEC is a web route security feature on the DNS (Domain Name System).</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(90)">registry +/-</button></td><td></td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>registry_description</b></td><td>'.$item->data_management->registry_description.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="I1" style="display:none"><td><b>registry_language</b></td><td>'.$item->data_management->registry_language.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="I2" style="display:none"><td><b>registry_format</b></td><td>'.$item->data_management->registry_format.'</td><td></td><td></td></tr>';
	break;
}	
foreach ($xml2->xpath('//domain') as $item)	{
simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(100)">whois restrictions +/-</button></td><td></td><td></td><td></td></tr>';
	$html_text .= '<tr id="J1" style="display:none"><td><b>restrictions_legally</b></td><td>'.$item->restrictions_legally.'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="J2" style="display:none"><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr id="J3" style="display:none"><td><b>restrictions_translated</b></td><td>'.$item->restrictions_translated.'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	break;
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>