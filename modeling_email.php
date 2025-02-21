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
<table style="margin-left: 50px; font-family:Helvetica, Arial, sans-serif; font-size:.85rem">
<tr><th style="width:225px"></th><th style="width:650px"></th></tr>';
$html_text .= '<tr><td style="font-size:1.1rem;color:blue;font-weight:bold">Web Domain Email Model</td><td style="font-size:.8rem"><a href="https://github.com/janwillemstegink/rdap_view_model" target="_blank">github.com/janwillemstegink/rdap_view_model</a></td></tr>';
$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
$html_text .= '<tr><td COLSPAN="2">- English version of this message below –</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />Beste domeinnaamhouder,</td></tr>';
$html_text .= '<tr><td COLSPAN="2"><br />Je krijgt deze mail omdat je de administratieve contactpersoon bent voor onderstaand webdomein.</td></tr>';
$html_text .= '<tr><td COLSPAN="2">team.blue nl B.V. heeft minimaal één van de houdergegevens gewijzigd. Dit zijn de gegevens:</td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td COLSPAN="2"><br /><u>Domein / Domain:</u></td></tr>';
	$html_text .= '<tr><td>handle</td><td>'.$item->details->handle.'</td></tr>';
	$html_text .= '<tr><td>name_ascii</td><td>'.$item->details->name_ascii.'</td></tr>';
	$html_text .= '<tr><td>name_unicode</td><td>'.$item->details->name_unicode.'</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br /><u>Houder / Registrant:</u></td></tr>';
	$html_text .= '<tr><td>handle</td><td>'.$item->registrant->handle.'</td></tr>';
	$html_text .= '<tr><td>web_id</td><td>'.$item->registrant->web_id.'</td></tr>';
	$html_text .= '<tr><td>organization</td><td>'.$item->registrant->organization.'</td></tr>';
	$html_text .= '<tr><td>presented_name</td><td>'.$item->registrant->presented_name.'</td></tr>';
	$html_text .= '<tr><td>kind</td><td>'.$item->registrant->kind.'</td></tr>';
	$html_text .= '<tr><td>name</td><td>'.$item->registrant->name.'</td></tr>';
	$html_text .= '<tr><td>email</td><td>'.$item->registrant->email.'</td></tr>';
	$html_text .= '<tr><td>tel</td><td>'.$item->registrant->tel.'</td></tr>';
	$html_text .= '<tr><td>country_code</td><td>'.$item->registrant->country_code.'</td></tr>';
	$html_text .= '<tr><td>street</td><td>'.$item->registrant->street.'</td></tr>';
	$html_text .= '<tr><td>postal_code</td><td>'.$item->registrant->postal_code.'</td></tr>';
	$html_text .= '<tr><td>city</td><td>'.$item->registrant->city.'</td></tr>';
	$html_text .= '<tr><td>state_province</td><td>'.$item->registrant->state_province.'</td></tr>';	
	$html_text .= '<tr><td>country_name</td><td>'.$item->registrant->country_name.'</td></tr>';
	$html_text .= '<tr><td>shielding</td><td>'.$item->registrant->shielding.'</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br /><u>Administratieve contactpersoon / Administrative contact:</u></td></tr>';
	$html_text .= '<tr><td>handle</td><td>'.$item->administrative->handle.'</td></tr>';
	$html_text .= '<tr><td>web_id</td><td>'.$item->administrative->web_id.'</td></tr>';
	$html_text .= '<tr><td>organization</td><td>'.$item->administrative->organization.'</td></tr>';
	$html_text .= '<tr><td>presented_name</td><td>'.$item->administrative->presented_name.'</td></tr>';
	$html_text .= '<tr><td>kind</td><td>'.$item->administrative->kind.'</td></tr>';
	$html_text .= '<tr><td>name</td><td>'.$item->administrative->name.'</td></tr>';
	$html_text .= '<tr><td>email</td><td>'.$item->administrative->email.'</td></tr>';
	$html_text .= '<tr><td>tel</td><td>'.$item->administrative->tel.'</td></tr>';
	$html_text .= '<tr><td>country_code</td><td>'.$item->administrative->country_code.'</td></tr>';
	$html_text .= '<tr><td>street</td><td>'.$item->administrative->street.'</td></tr>';
	$html_text .= '<tr><td>postal_code</td><td>'.$item->administrative->postal_code.'</td></tr>';
	$html_text .= '<tr><td>city</td><td>'.$item->administrative->city.'</td></tr>';
	$html_text .= '<tr><td>state_province</td><td>'.$item->administrative->state_province.'</td></tr>';
	$html_text .= '<tr><td>country_name</td><td>'.$item->administrative->country_name.'</td></tr>';
	$html_text .= '<tr><td>shielding</td><td>'.$item->administrative->shielding.'</td></tr>';
	$html_text .= '<tr><td COLSPAN="2"><br /><u>Facturering (indien de registry dit onderhoudt) / Billing (if the registry maintains this):</u></td></tr>';
	$html_text .= '<tr><td>handle</td><td>'.$item->billing->handle.'</td></tr>';
	$html_text .= '<tr><td>web_id</td><td>'.$item->billing->web_id.'</td></tr>';
	$html_text .= '<tr><td>organization</td><td>'.$item->billing->organization.'</td></tr>';
	$html_text .= '<tr><td>presented_name</td><td>'.$item->billing->presented_name.'</td></tr>';
	$html_text .= '<tr><td>kind</td><td>'.$item->billing->kind.'</td></tr>';
	$html_text .= '<tr><td>name</td><td>'.$item->billing->name.'</td></tr>';
	$html_text .= '<tr><td>email</td><td>'.$item->billing->email.'</td></tr>';
	$html_text .= '<tr><td>tel</td><td>'.$item->billing->tel.'</td></tr>';
	$html_text .= '<tr><td>country_code</td><td>'.$item->billing->country_code.'</td></tr>';
	$html_text .= '<tr><td>street</td><td>'.$item->billing->street.'</td></tr>';
	$html_text .= '<tr><td>postal_code</td><td>'.$item->billing->postal_code.'</td></tr>';
	$html_text .= '<tr><td>city</td><td>'.$item->billing->city.'</td></tr>';
	$html_text .= '<tr><td>state_province</td><td>'.$item->billing->state_province.'</td></tr>';
	$html_text .= '<tr><td>country_name</td><td>'.$item->billing->country_name.'</td></tr>';
	$html_text .= '<tr><td>shielding</td><td>'.$item->billing->shielding.'</td></tr>';
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