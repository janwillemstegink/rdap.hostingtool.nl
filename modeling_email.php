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
$dataFile = '/home/admin/rdap_files/data_email.xml';
$inputdomain = 'webhostingtech.nl';
$url1 = "https://rdap.hostingtool.nl/compose_data/index.php?domain=$inputdomain";
if (file_exists($dataFile))	{
	$xml1 = simplexml_load_file($dataFile) or die("Cannot load xml1 from folder.");
}
elseif (@get_headers($url1))	{ // RDAP does not contain all data
	$xml1 = simplexml_load_file($url1, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load " . $url1);
}
$html_text = '<!DOCTYPE html><html lang="en" style="font-size:100%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>Web domain email modeling</title></head>';
$html_text .= '<body><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size:.85rem">
<tr><th style="width:350px"></th><th style="width:475px"></th></tr>';
$html_text .= '<tr><td style="font-size:1.1rem;color:blue;font-weight:bold"><b>Web Domain Email Model</b></td><td style="font-size:.8rem"><a href="https://github.com/janwillemstegink/rdap_view_model" target="_blank">github.com/janwillemstegink/rdap_view_model</a></td></tr>';
$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
$html_text .= '<tr><td COLSPAN="2">- English version of this message below –</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />Beste domeinnaamhouder,</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />Je krijgt deze mail omdat je de administratieve contactpersoon bent voor onderstaand webdomein.</td></tr>';
$html_text .= '<tr><td COLSPAN="2">team.blue nl B.V. heeft minimaal één van de houdergegevens gewijzigd. Dit zijn de gegevens:</td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td COLSPAN="2"><br />Domein / Domain:</td></tr>';
	$html_text .= '<tr><td>domain_handle</td><td>'.$item->domain_handle.'</td></tr>';
	$html_text .= '<tr><td>domain_name_ascii</td><td>'.$item->domain_name_ascii.'</td></tr>';
	$html_text .= '<tr><td>domain_name_unicode</td><td>'.$item->domain_name_unicode.'</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br />Houder / Registrant:</td></tr>';
	$html_text .= '<tr><td>registrant_handle</td><td>'.$item->registrant->registrant_handle.'</td></tr>';
	$html_text .= '<tr><td>registrant_web_id</td><td>'.$item->registrant->registrant_web_id.'</td></tr>';
	$html_text .= '<tr><td>registrant_full_name</td><td>'.$item->registrant->registrant_full_name.'</td></tr>';
	$html_text .= '<tr><td>registrant_kind</td><td>'.$item->registrant->registrant_kind.'</td></tr>';
	$html_text .= '<tr><td>registrant_name</td><td>'.$item->registrant->registrant_name.'</td></tr>';
	$html_text .= '<tr><td>registrant_tel</td><td>'.$item->registrant->registrant_tel.'</td></tr>';
	$html_text .= '<tr><td>registrant_country_code</td><td>'.$item->registrant->registrant_country_code.'</td></tr>';
	$html_text .= '<tr><td>registrant_email</td><td>'.$item->registrant->registrant_email.'</td></tr>';
	$html_text .= '<tr><td>registrant_street</td><td>'.$item->registrant->registrant_street.'</td></tr>';
	$html_text .= '<tr><td>registrant_postal_code</td><td>'.$item->registrant->registrant_postal_code.'</td></tr>';
	$html_text .= '<tr><td>registrant_city</td><td>'.$item->registrant->registrant_city.'</td></tr>';
	$html_text .= '<tr><td>registrant_state_province</td><td>'.$item->registrant->registrant_state_province.'</td></tr>';	
	$html_text .= '<tr><td>registrant_country</td><td>'.$item->registrant->registrant_country.'</td></tr>';
	$html_text .= '<tr><td>registrant_protected</td><td>'.$item->registrant->registrant_protected.'</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br />Administratieve contactpersoon / Administrative contact:</td></tr>';
	$html_text .= '<tr><td>admin_handle</td><td>'.$item->admin->admin_handle.'</td></tr>';
	$html_text .= '<tr><td>admin_web_id</td><td>'.$item->admin->admin_web_id.'</td></tr>';
	$html_text .= '<tr><td>admin_full_name</td><td>'.$item->admin->admin_full_name.'</td></tr>';
	$html_text .= '<tr><td>admin_kind</td><td>'.$item->admin->admin_kind.'</td></tr>';
	$html_text .= '<tr><td>admin_name</td><td>'.$item->admin->admin_name.'</td></tr>';
	$html_text .= '<tr><td>admin_tel</td><td>'.$item->admin->admin_tel.'</td></tr>';
	$html_text .= '<tr><td>admin_country_code</td><td>'.$item->admin->admin_country_code.'</td></tr>';
	$html_text .= '<tr><td>admin_email</td><td>'.$item->admin->admin_email.'</td></tr>';
	$html_text .= '<tr><td>admin_street</td><td>'.$item->admin->admin_street.'</td></tr>';
	$html_text .= '<tr><td>admin_postal_code</td><td>'.$item->admin->admin_postal_code.'</td></tr>';
	$html_text .= '<tr><td>admin_city</td><td>'.$item->admin->admin_city.'</td></tr>';
	$html_text .= '<tr><td>admin_state_province</td><td>'.$item->admin->admin_state_province.'</td></tr>';
	$html_text .= '<tr><td>admin_country</td><td>'.$item->admin->admin_country.'</td></tr>';
	$html_text .= '<tr><td>admin_protected</td><td>'.$item->admin->admin_protected.'</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br />Facturering (indien de registry dit onderhoudt) / Billing (if the registry maintains this):</td></tr>';
	$html_text .= '<tr><td>billing_handle</td><td>'.$item->billing->billing_handle.'</td></tr>';
	$html_text .= '<tr><td>billing_web_id</td><td>'.$item->billing->billing_web_id.'</td></tr>';
	$html_text .= '<tr><td>billing_full_name</td><td>'.$item->billing->billing_full_name.'</td></tr>';
	$html_text .= '<tr><td>billing_kind</td><td>'.$item->billing->billing_kind.'</td></tr>';
	$html_text .= '<tr><td>billing_name</td><td>'.$item->billing->billing_name.'</td></tr>';
	$html_text .= '<tr><td>billing_tel</td><td>'.$item->billing->billing_tel.'</td></tr>';
	$html_text .= '<tr><td>billing_country_code</td><td>'.$item->billing->billing_country_code.'</td></tr>';
	$html_text .= '<tr><td>billing_email</td><td>'.$item->billing->billing_email.'</td></tr>';
	$html_text .= '<tr><td>billing_street</td><td>'.$item->billing->billing_street.'</td></tr>';
	$html_text .= '<tr><td>billing_postal_code</td><td>'.$item->billing->billing_postal_code.'</td></tr>';
	$html_text .= '<tr><td>billing_city</td><td>'.$item->billing->billing_city.'</td></tr>';
	$html_text .= '<tr><td>billing_state_province</td><td>'.$item->billing->billing_state_province.'</td></tr>';
	$html_text .= '<tr><td>billing_country</td><td>'.$item->billing->billing_country.'</td></tr>';
	$html_text .= '<tr><td>billing_protected</td><td>'.$item->billing->billing_protected.'</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br />Is er iets mis? Het bedrijf dat deze domeinnaam beheert is: team.blue nl B.V., of de reseller: TransIP.</td></tr>';
	$html_text .= '<tr><td COLSPAN="2">Als u als registrant via hun menu wijzigingen kunt aanbrengen, dan bent u primair verantwoordelijk.</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br />Met vriendelijke groet,</td></tr>';
	$html_text .= '<tr><td COLSPAN="2">SIDN</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br />Beantwoord deze mail niet. Als je vragen of feedback hebt, neem dan contact op met <a href="mailto:support@sidn.nl">support@sidn.nl</a>.</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
	break;
}
$html_text .= '<tr><td COLSPAN="2"><br />Dear registrant,</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />You are receiving this message because you are the administrative contact for the above web domain.</td></tr>';
$html_text .= '<tr><td COLSPAN="2">team.blue nl B.V. has changed at least one of the holder details. This information is listed.</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />Is there something wrong? The company that manages this domain name is: team.blue nl B.V., or the reseller: TransIP.</td></tr>';
$html_text .= '<tr><td COLSPAN="2">If you, as a registrant, can make changes via their menu, you are primarily responsible.</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />Kind regards</td></tr>';
$html_text .= '<tr><td COLSPAN="2">SIDN</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />Please don&#39;t reply to this mail. If you have any questions or feedback, please contact <a href="mailto:support@sidn.nl">support@sidn.nl</a>.</td></tr>';
$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
$html_text .= '</table></div></body></html>';
echo $html_text;
?>