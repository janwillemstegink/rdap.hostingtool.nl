<?php
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

if (file_exists($filesPath.$dataFile) and false)	{
	$xml = simplexml_load_file($filesPath.$dataFile) or die("Cannot load xml file 1 from path,");
}
elseif (file_exists($dataFile))	{
	$xml = simplexml_load_file($dataFile) or die("Cannot load xml file 1 from same folder.");
}
else	{
	//$url = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=".$inputdomain."&format=xml&type=1";
	$url = "http://whois.hostingtool.nl/".$dataFile;
	$xml = simplexml_load_file($url, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load xml file 1 by url.");
}

if (file_exists($filesPath.$restrictionsFile and false))	{
	$xml2 = simplexml_load_file($filesPath.$restrictionsFile) or die("Cannot load xml file 2 from path.");
	
}
elseif (file_exists($restrictionsFile))	{
	$xml2 = simplexml_load_file($restrictionsFile) or die("Cannot load xml file 2 from same folder.");
}
else	{	
	$url2 = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=".$inputdomain."&format=xml&type=2";
	//$url2 = "http://whois.hostingtool.nl/".$restrictionsFile;
	$xml2 = simplexml_load_file($url2, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load xml file 2 by url.");
}

$html_text = '<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="robots" content="index"><title>Whois modeling for Trade Register use</title>';
?><script>
function SwitchVisibility(type) {
	if (type == 20)	{ // domain
		var pre = 'B';
		var max = 6
	}
	else if (type == 30)	{ // registrar
		var pre = 'C';
		var max = 13
	}
	else if (type == 40)	{ // reseller
		var pre = 'D';
		var max = 9
	}
	else if (type == 50)	{ // holder
		var pre = 'E';
		var max = 8
	}
	else if (type == 60)	{ // admin
		var pre = 'F';
		var max = 2
	}
	else if (type == 70)	{ // tech
		var pre = 'G';
		var max = 8
	}
	else if (type == 80)	{ // name servers
		var pre = 'H';
		var max = 18
	}
	else if (type == 90)	{ // registry
		var pre = 'I';
		var max = 7
	}
	else	{
		return;	
	}
	
	for (let i = 1; i <= max; i++) {
		var id = pre + i.toString();
		if (document.getElementById(id).style.display == "table-row")	{
			document.getElementById(id).style.display = "none";	
		}
		else	{
			document.getElementById(id).style.display = "table-row";
		}
	}
		
	function echo( ...s )	{
   		for(var i = 0; i < s.length; i++ ) {
    		document.write(s[i] + ' ');
		}
	}
}	
</script><?php
$html_text = '</head><body><div style="border-spacing=0; padding=0; border-width=0; padding-bottom:5px; line-height:120%;">
<table style="border-collapse:collapse; font-family:Helvetica, Arial, sans-serif; font-size:13px;">
<style>
.RowToSwitch {
  display: none
}  
</style>
<tr><th style="width:15%"></th><th style="width:25%"></th><th style="width:30%"></th><th style="width:30%"></th></tr>';
$html_text .= '<tr><td><b>Clearer Whois</td><td><b>From a registry in xml - </b><a href="https://github.com/janwillemstegink/xml-whois" target="_blank">github.com/janwillemstegink/xml-whois</a></b></td><td><b>Toelichting</b></td><td><b>Explanation</b></td></tr>';
foreach ($xml->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td>view_datetime</td><td>'.$item->view->view_datetime.'</td></tr>';
	$html_text .= '<tr><td>view_type</td><td>'.$item->view->view_type.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button a style="cursor: pointer; cursor: hand; " onclick="SwitchVisibility(20)">domain +/-</a></td></tr>';
	$html_text .= '<tr id="B1" class="RowToSwitch"><td>domain_id</td><td>'.$item->domain_id.'</td></tr>';
	$html_text .= '<tr><td>domain_name</td><td>'.$item->domain_name.'</td></tr>';
	$html_text .= '<tr><td>domain_web_publish</td><td>'.$item->domain_web_publish.'</td>
	<td>Met "web_publish" ingesteld op ja, kunnen zoekmachines legaal publiceren.</td>
	<td>Having "web_publish" set to yes, search engines can publish legally.</td></tr>';
	$html_text .= '<tr><td>domain_business_use</td><td>'.$item->domain_business_use.'</td>
	<td>Zakelijk gebruik vereist het type: bestaande en zichtbare naam van de houder.</td>
	<td>Business use requires the type: existing and visible name of the holder.</td></tr>';
	$html_text .= '<tr><td>domain_status</td><td>'.$item->domain_status.'</td></tr>';
	$html_text .= '<tr id="B2" class="RowToSwitch"><td>domain_creation</td><td>'.$item->domain_creation.'</td></tr>';
	$html_text .= '<tr id="B3" class="RowToSwitch"><td>domain_last_renewal</td><td>'.$item->domain_last_renewal.'</td></tr>';
	$html_text .= '<tr id="B4" class="RowToSwitch"><td>domain_updated</td><td>'.$item->domain_updated.'</td></tr>';
	$html_text .= '<tr id="B5" class="RowToSwitch"><td>domain_expiration</td><td>'.$item->domain_expiration.'</td></tr>';
	$html_text .= '<tr id="B6" class="RowToSwitch"><td>domain_out_of_quarantine</td><td>'.$item->domain_out_of_quarantine.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button a style="cursor: pointer; cursor: hand; " onclick="SwitchVisibility(30)">registrar +/-</a></td></tr>';
	$html_text .= '<tr id="C1" class="RowToSwitch"><td>registrar_contact_id</td><td>'.$item->registrar->registrar_contact_id.'</td></tr>';
	$html_text .= '<tr><td>registrar_name</td><td>'.$item->registrar->registrar_name.'</td></tr>';
	$html_text .= '<tr id="C2" class="RowToSwitch"><td>registrar_web_id</td><td>'.$item->registrar->registrar_web_id.'</td></tr>';
	$html_text .= '<tr><td>registrar_abuse_email</td><td>'.$item->registrar->registrar_abuse_email.'</td></tr>';
	$html_text .= '<tr id="C3" class="RowToSwitch"><td>registrar_abuse_phone</td><td>'.$item->registrar->registrar_abuse_phone.'</td></tr>';
	$html_text .= '<tr id="C4" class="RowToSwitch"><td>registrar_street</td><td>'.$item->registrar->registrar_street.'</td></tr>';
	$html_text .= '<tr id="C5" class="RowToSwitch"><td>registrar_postal_code</td><td>'.$item->registrar->registrar_postal_code.'</td></tr>';
	$html_text .= '<tr id="C6" class="RowToSwitch"><td>registrar_city</td><td>'.$item->registrar->registrar_city.'</td></tr>';
	$html_text .= '<tr id="C7" class="RowToSwitch"><td>registrar_country_code</td><td>'.$item->registrar->registrar_country_code.'</td></tr>';
	$html_text .= '<tr id="C8" class="RowToSwitch"><td>registrar_country_name</td><td>'.$item->registrar->registrar_country_name.'</td></tr>';
	$html_text .= '<tr id="C9" class="RowToSwitch"><td>registrar_country_language</td><td>'.$item->registrar->registrar_country_language.'</td></tr>';
	$html_text .= '<tr id="C10" class="RowToSwitch"><td>registrar_whois_server</td><td>'.$item->registrar->registrar_whois_server.'</td></tr>';
	$html_text .= '<tr id="C11" class="RowToSwitch"><td>registrar_url</td><td>'.$item->registrar->registrar_url.'</td></tr>';
	$html_text .= '<tr id="C12" class="RowToSwitch"><td>registrar_iana_id</td><td>'.$item->registrar->registrar_iana_id.'</td></tr>';
	$html_text .= '<tr id="C13" class="RowToSwitch"><td>registrar_hidden</td><td>'.$item->registrar->registrar_hidden.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	if (strlen(trim($item->reseller->reseller_name)))	{
		$html_text .= '<tr><td><button a style="cursor: pointer; cursor: hand; " onclick="SwitchVisibility(40)">reseller +/-</a></td></tr>';
		$html_text .= '<tr id="D1" class="RowToSwitch"><td>reseller_contact_id</td><td>'.$item->reseller->reseller_contact_id.'</td></tr>';
		$html_text .= '<tr><td>reseller_name</td><td>'.$item->reseller->reseller_name.'</td></tr>';
		$html_text .= '<tr id="D2" class="RowToSwitch"><td>reseller_web_id</td><td>'.$item->reseller->reseller_web_id.'</td></tr>';
		$html_text .= '<tr id="D3" class="RowToSwitch"><td>reseller_street</td><td>'.$item->reseller->reseller_street.'</td></tr>';
		$html_text .= '<tr id="D4" class="RowToSwitch"><td>reseller_postal_code</td><td>'.$item->reseller->reseller_postal_code.'</td></tr>';
		$html_text .= '<tr id="D5" class="RowToSwitch"><td>reseller_city</td><td>'.$item->reseller->reseller_city.'</td></tr>';
		$html_text .= '<tr id="D6" class="RowToSwitch"><td>reseller_country_code</td><td>'.$item->reseller->reseller_country_code.'</td></tr>';
		$html_text .= '<tr id="D7" class="RowToSwitch"><td>reseller_country_name</td><td>'.$item->reseller->reseller_country_name.'</td></tr>';
		$html_text .= '<tr id="D8" class="RowToSwitch"><td>reseller_country_language</td><td>'.$item->reseller->reseller_country_language.'</td></tr>';
		$html_text .= '<tr id="D9" class="RowToSwitch"><td>reseller_hidden</td><td>'.$item->reseller->reseller_hidden.'</td></tr>';
		$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	}
	$html_text .= '<tr><td><button a style="cursor: pointer; cursor: hand; " onclick="SwitchVisibility(50)">holder +/-</a></td></tr>';
	$html_text .= '<tr id="E1" class="RowToSwitch"><td>registrant_holder_contact_id</td><td>'.$item->registrant->registrant_holder_contact_id.'</td></tr>';
	$html_text .= '<tr><td>registrant_holder_name</td><td>'.$item->registrant->registrant_holder_name.'</td>	
	<td>De houder, en anders de reseller, is direct verantwoordelijk voor de houdernaam.</td>
	<td>The holder, otherwise the reseller, is directly responsible for the holder name.</td></tr>';
	$html_text .= '<tr><td>registrant_holder_web_id</td><td>'.$item->registrant->registrant_holder_web_id.'</td>
	<td>De KVK kan een "web_id" eigenschap in het Handelsregister toevoegen.</td>
	<td>The Chamber of Commerce can add a "web_id" property in the Trade Register.</td></tr>';
	$html_text .= '<tr id="E2" class="RowToSwitch"><td>registrant_holder_street</td><td>'.$item->registrant->registrant_holder_street.'</td></tr>';
	$html_text .= '<tr id="E3" class="RowToSwitch"><td>registrant_holder_postal_code</td><td>'.$item->registrant->registrant_holder_postal_code.'</td></tr>';
	$html_text .= '<tr id="E4" class="RowToSwitch"><td>registrant_holder_city</td><td>'.$item->registrant->registrant_holder_city.'</td></tr>';
	$html_text .= '<tr id="E5" class="RowToSwitch"><td>registrant_holder_country_code</td><td>'.$item->registrant->registrant_holder_country_code.'</td></tr>';
	$html_text .= '<tr id="E6" class="RowToSwitch"><td>registrant_holder_country_name</td><td>'.$item->registrant->registrant_holder_country_name.'</td></tr>';
	$html_text .= '<tr id="E7" class="RowToSwitch"><td>registrant_holder_country_language</td><td>'.$item->registrant->registrant_holder_country_language.'</td></tr>';
	$html_text .= '<tr id="E8" class="RowToSwitch"><td>registrant_holder_hidden</td><td>'.$item->registrant->registrant_holder_hidden.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button a style="cursor: pointer; cursor: hand; " onclick="SwitchVisibility(60)">admin +/-</a></td></tr>';
	$html_text .= '<tr id="F1" class="RowToSwitch"><td>admin_contact_id</td><td>'.$item->admin->admin_contact_id.'</td></tr>';
	$html_text .= '<tr><td>admin_email</td><td>'.$item->admin->admin_email.'</td>
	<td>Admin beantwoordt en adresseert een gemeld probleem voor een oplossing.</td>
	<td>Admin answers and addresses a reported issue for a solution.</td></tr>';
	$html_text .= '<tr id="F2" class="RowToSwitch"><td>admin_hidden</td><td>'.$item->admin->admin_hidden.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button a style="cursor: pointer; cursor: hand; " onclick="SwitchVisibility(70)">tech +/-</a></td></tr>';
	if (strlen(trim($item->tech->contact_1->tech_email_1)))	{	
		$html_text .= '<tr id="G1" class="RowToSwitch"><td>tech_contact_id_1</td><td>'.$item->tech->contact_1->tech_contact_id_1.'</td></tr>';
		$html_text .= '<tr><td>tech_email_1</td><td>'.$item->tech->contact_1->tech_email_1.'</td>
		<td>Een technisch contact reageert om een storingsmelding op te lossen.</td>
		<td>A technical contact responds to resolve a malfunction notification.</td></tr>';
		$html_text .= '<tr id="G2" class="RowToSwitch"><td>tech_hidden_1</td><td>'.$item->tech->contact_1->tech_hidden_1.'</td></tr>';
	}
	if (strlen(trim($item->tech->contact_2->tech_email_2)))	{	
		$html_text .= '<tr id="G3" class="RowToSwitch"><td>tech_contact_id_2</td><td>'.$item->tech->contact_2->tech_contact_id_2.'</td></tr>';
		$html_text .= '<tr><td>tech_email_2</td><td>'.$item->tech->contact_2->tech_email_2.'</td></tr>';
		$html_text .= '<tr id="G4" class="RowToSwitch"><td>tech_hidden_2</td><td>'.$item->tech->contact_2->tech_hidden_2.'</td></tr>';
	}
	if (strlen(trim($item->tech->contact_3->tech_email_3)))	{	
		$html_text .= '<tr id="G5" class="RowToSwitch"><td>tech_contact_id_3</td><td>'.$item->tech->contact_3->tech_contact_id_3.'</td></tr>';
		$html_text .= '<tr><td>tech_email_3</td><td>'.$item->tech->contact_3->tech_email_3.'</td></tr>';
		$html_text .= '<tr id="G6" class="RowToSwitch"><td>tech_hidden_3</td><td>'.$item->tech->contact_3->tech_hidden_3.'</td></tr>';
	}
	if (strlen(trim($item->tech->contact_4->tech_email_4)))	{	
		$html_text .= '<tr id="G7" class="RowToSwitch"><td>tech_contact_id_4</td><td>'.$item->tech->contact_4->tech_contact_id_4.'</td></tr>';
		$html_text .= '<tr><td>tech_email_4</td><td>'.$item->tech->contact_4->tech_email_4.'</td></tr>';
		$html_text .= '<tr id="G8" class="RowToSwitch"><td>tech_hidden_4</td><td>'.$item->tech->contact_4->tech_hidden_4.'</td></tr>';
	}	
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button a style="cursor: pointer; cursor: hand; " onclick="SwitchVisibility(80)">name server +/-</a></td></tr>';
	if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
		$html_text .= '<tr id="H1" class="RowToSwitch"><td>server_name_1</td><td>'.$item->name_servers->server_1->server_name_1.'</td></tr>';
		$html_text .= '<tr id="H2" class="RowToSwitch"><td>ipv4_1</td><td>'.$item->name_servers->server_1->ipv4_1.'</td></tr>';
		$html_text .= '<tr id="H3" class="RowToSwitch"><td>ipv6_1</td><td>'.$item->name_servers->server_1->ipv6_1.'</td></tr>';
	}
	if (strlen(trim($item->name_servers->server_2->server_name_2)))	{
		$html_text .= '<tr id="H4" class="RowToSwitch"><td>server_name_2</td><td>'.$item->name_servers->server_2->server_name_2.'</td></tr>';
		$html_text .= '<tr id="H5" class="RowToSwitch"><td>ipv4_2</td><td>'.$item->name_servers->server_2->ipv4_2.'</td></tr>';
		$html_text .= '<tr id="H6" class="RowToSwitch"><td>ipv6_2</td><td>'.$item->name_servers->server_2->ipv6_2.'</td></tr>';
	}
	if (strlen(trim($item->name_servers->server_3->server_name_3)))	{
		$html_text .= '<tr id="H7" class="RowToSwitch"><td>server_name_3</td><td>'.$item->name_servers->server_3->server_name_3.'</td></tr>';
		$html_text .= '<tr id="H8" class="RowToSwitch"><td>ipv4_3</td><td>'.$item->name_servers->server_3->ipv4_3.'</td></tr>';
		$html_text .= '<tr id="H9" class="RowToSwitch"><td>ipv6_3</td><td>'.$item->name_servers->server_3->ipv6_3.'</td></tr>';
	}
	if (strlen(trim($item->name_servers->server_4->server_name_4)))	{
		$html_text .= '<tr id="H10" class="RowToSwitch"><td>server_name_4</td><td>'.$item->name_servers->server_4->server_name_4.'</td></tr>';
		$html_text .= '<tr id="H11" class="RowToSwitch"><td>ipv4_4</td><td>'.$item->name_servers->server_4->ipv4_4.'</td></tr>';
		$html_text .= '<tr id="H12" class="RowToSwitch"><td>ipv6_4</td><td>'.$item->name_servers->server_4->ipv6_4.'</td></tr>';
	}
	if (strlen(trim($item->name_servers->server_5->server_name_5)))	{
		$html_text .= '<tr id="H13" class="RowToSwitch"><td>server_name_5</td><td>'.$item->name_servers->server_5->server_name_5.'</td></tr>';
		$html_text .= '<tr id="H14" class="RowToSwitch"><td>ipv4_5</td><td>'.$item->name_servers->server_5->ipv4_5.'</td></tr>';
		$html_text .= '<tr id="H15" class="RowToSwitch"><td>ipv6_5</td><td>'.$item->name_servers->server_5->ipv6_5.'</td></tr>';
	}
	if (strlen(trim($item->name_servers->server_6->server_name_6)))	{
		$html_text .= '<tr id="H16" class="RowToSwitch"><td>server_name_6</td><td>'.$item->name_servers->server_6->server_name_6.'</td></tr>';
		$html_text .= '<tr id="H17" class="RowToSwitch"><td>ipv4_6</td><td>'.$item->name_servers->server_6->ipv4_6.'</td></tr>';
		$html_text .= '<tr id="H18" class="RowToSwitch"><td>ipv6_6</td><td>'.$item->name_servers->server_6->ipv6_6.'</td></tr>';
	}
	$html_text .= '<tr><td>name_servers_dnssec</td><td>'.$item->name_servers->name_servers_dnssec.'</td>
	<td>DNSSEC is een web-route-beveiligingsvoorziening op het DNS.</td>
	<td>DNSSEC is a web route security feature on the DNS.</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button a style="cursor: pointer; cursor: hand; " onclick="SwitchVisibility(90)">registry conditions +/-</a></td></tr>';
	$html_text .= '<tr><td>registry_description</td><td>'.$item->data_management->registry_description.'</td></tr>';
	$html_text .= '<tr id="I1" class="RowToSwitch"><td>registry_language</td><td>'.$item->data_management->registry_language.'</td></tr>';
	$html_text .= '<tr id="I2" class="RowToSwitch"><td>registry_format</td><td>'.$item->data_management->registry_format.'</td></tr>';
	break;
}	
foreach ($xml2->xpath('//domain') as $item)	{
simplexml_load_string($item->asXML());
	$html_text .= '<tr id="I3" class="RowToSwitch"><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr id="I4" class="RowToSwitch"><td>restrictions_legally</td><td>'.$item->restrictions_legally.'</td></tr>';
	$html_text .= '<tr id="I5" class="RowToSwitch"><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr id="I6" class="RowToSwitch"><td>restrictions_translated</td><td>'.$item->restrictions_translated.'</td></tr>';
	$html_text .= '<tr id="I7" class="RowToSwitch"><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	break;
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>