<?php
session_start();  // is needed with no PHP Generator Scriptcase
if (!function_exists('simplexml_load_file')) {
	die('simpleXML functions are not available.');
}
if (ini_get("allow_url_fopen") == 1)	{
}
else	{	
	die('allow_url_fopen does not work.'); 	
}
$filesPath = '/home/admin/whois_file/';
$dataFile = 'whois_confirmation_data.xml';
$inputdomain = 'webhostingtech.nl';
$url1a = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=$inputdomain&format=xml&type=1";
$url1b = "http://whois.hostingtool.nl/".$dataFile;

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

$html_text = '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="robots" content="index"><title>Web Domain Whois Email Modeling</title></head>';
$html_text .= '<body><div style="border-spacing=0; padding=0; border-width=0; padding-bottom:5px; line-height:120%;">
<table style="border-collapse:collapse; font-family:Helvetica, Arial, sans-serif; font-size:13px;">
<tr><th style="width:350px"></th><th style="width:475px"></th></tr>';
$html_text .= '<tr><td style="font-size:16px;color:blue;font-weight:bold"><b>Web Domain Whois Email Modeling</b></td><td><a href="https://www.sidn.nl/whois?q=webhostingtech.nl" target="_blank">sidn.nl/whois?q=webhostingtech.nl/whois</a> - <a href="https://github.com/janwillemstegink/xml-whois" target="_blank">github.com/janwillemstegink/xml-whois</a></td></tr>';
$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
$html_text .= '<tr><td COLSPAN="2">- English version of this message below –</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />Beste domeinnaamhouder,</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />Je krijgt deze mail omdat je de administratieve contactpersoon bent van een domeinnaam.</td></tr>';
$html_text .= '<tr><td COLSPAN="2">team.blue nl B.V. heeft minimaal één van de houdergegevens van webhostingtech.nl gewijzigd. Dit zijn de gegevens:</td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td COLSPAN="2"><br />Houder / Registrant:</td></tr>';
	$html_text .= '<tr><td>registrant_contact_id</td><td>'.$item->registrant->registrant_contact_id.'</td></tr>';
	$html_text .= '<tr><td>registrant_business_name</td><td>'.$item->registrant->registrant_business_name.'</td></tr>';
	$html_text .= '<tr><td>registrant_personal_name</td><td>'.$item->registrant->registrant_personal_name.'</td></tr>';	
	$html_text .= '<tr><td>registrant_street</td><td>'.$item->registrant->registrant_street.'</td></tr>';
	$html_text .= '<tr><td>registrant_postal_code</td><td>'.$item->registrant->registrant_postal_code.'</td></tr>';
	$html_text .= '<tr><td>registrant_city</td><td>'.$item->registrant->registrant_city.'</td></tr>';
	$html_text .= '<tr><td>registrant_phone</td><td>'.$item->registrant->registrant_phone.'</td></tr>';
	$html_text .= '<tr><td>registrant_email</td><td>'.$item->registrant->registrant_email.'</td></tr>';
	$html_text .= '<tr><td>registrant_country_code</td><td>'.$item->registrant->registrant_country_code.'</td></tr>';
	$html_text .= '<tr><td>registrant_country_name</td><td>'.$item->registrant->registrant_country_name.'</td></tr>';
	$html_text .= '<tr><td>registrant_country_language</td><td>'.$item->registrant->registrant_country_language.'</td></tr>';
	$html_text .= '<tr><td>registrant_protected</td><td>'.$item->registrant->registrant_protected.'</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br />Administratieve contactpersoon / Administrative contact:</td></tr>';
	$html_text .= '<tr><td>admin_contact_id</td><td>'.$item->admin->admin_contact_id.'</td></tr>';
	$html_text .= '<tr><td>admin_business_name</td><td>'.$item->admin->admin_business_name.'</td></tr>';
	$html_text .= '<tr><td>admin_personal_name</td><td>'.$item->admin->admin_personal_name.'</td></tr>';
	$html_text .= '<tr><td>admin_phone</td><td>'.$item->admin->admin_phone.'</td></tr>';
	$html_text .= '<tr><td>admin_email</td><td>'.$item->admin->admin_email.'</td></tr>';
	$html_text .= '<tr><td>admin_protected</td><td>'.$item->admin->admin_protected.'</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br />Facturering / Billing:</td></tr>';
	$html_text .= '<tr><td>billing_contact_id</td><td>'.$item->billing->billing_contact_id.'</td></tr>';
	$html_text .= '<tr><td>billing_business_name</td><td>'.$item->billing->billing_business_name.'</td></tr>';
	$html_text .= '<tr><td>billing_personal_name</td><td>'.$item->billing->billing_personal_name.'</td></tr>';	
	$html_text .= '<tr><td>billing_street</td><td>'.$item->billing->billing_street.'</td></tr>';
	$html_text .= '<tr><td>billing_postal_code</td><td>'.$item->billing->billing_postal_code.'</td></tr>';
	$html_text .= '<tr><td>billing_city</td><td>'.$item->billing->billing_city.'</td></tr>';
	$html_text .= '<tr><td>billing_phone</td><td>'.$item->billing->billing_phone.'</td></tr>';
	$html_text .= '<tr><td>billing_email</td><td>'.$item->billing->billing_email.'</td></tr>';
	$html_text .= '<tr><td>billing_country_code</td><td>'.$item->billing->billing_country_code.'</td></tr>';
	$html_text .= '<tr><td>billing_country_name</td><td>'.$item->billing->billing_country_name.'</td></tr>';
	$html_text .= '<tr><td>billing_country_language</td><td>'.$item->billing->billing_country_language.'</td></tr>';
	$html_text .= '<tr><td>billing_protected</td><td>'.$item->billing->billing_protected.'</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br />Is er iets mis? Het bedrijf dat deze domeinnaam beheert is: team.blue nl B.V. of de reseller: TransIP.</td></tr>';
	$html_text .= '<tr><td COLSPAN="2">Als u als registrant toegang heeft tot het menu, dan kunt u primair verantwoordelijk zijn.</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br />Met vriendelijke groet,</td></tr>';
	$html_text .= '<tr><td COLSPAN="2">SIDN - Essentiële Aanbieder</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br />Beantwoord deze mail niet. Als je vragen of feedback hebt, neem dan contact op met <a href="mailto:support@sidn.nl">support@sidn.nl</a>.</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
	break;
}
$html_text .= '<tr><td COLSPAN="2"><br />Dear registrant,</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />You are receiving this message because you are the administrative contact for a domain name.</td></tr>';
$html_text .= '<tr><td COLSPAN="2">team.blue nl B.V. has changed at least one of the holder details of webhostingtech.nl, as mentioned above.</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />Is something wrong? The company that manages this domain name is: team.blue nl B.V. or the reseller: TransIP.</td></tr>';
$html_text .= '<tr><td COLSPAN="2">If you as a registrant have access to the menu, then you can be primarily responsible.</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />Kind regards</td></tr>';
$html_text .= '<tr><td COLSPAN="2">SIDN - Essential Provider</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />Please don&#39;t reply to this mail. If you have any questions or feedback, please contact <a href="mailto:support@sidn.nl">support@sidn.nl</a>.</td></tr>';
$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
$html_text .= '</table></div></body></html>';
echo $html_text;
?>