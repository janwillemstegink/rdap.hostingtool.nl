<?php
//$_GET['url'] = 'hostingtool.nl';

if (!empty($_GET['url']))	{
	if (strlen($_GET['url']))	{
		$domain = str_replace('http://','', trim($_GET['url']));
		$domain = str_replace('https://','', $domain);
		$domain = str_replace('www.','', $domain);
		$domain = str_replace('/','', $domain);
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
	
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://'.$inputdomain);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
$curl_server_headers = curl_exec($ch);
$arr_server_headers = explode (",", $curl_server_headers);	
$server_headers = '';	
foreach($arr_server_headers as $key1 => $value1) {
	$server_headers .= $key1 . ': ' . $value1 . '<br />';
    foreach($value1 as $key2 => $value2) {
		$server_headers .= "+". $key2 . ': ' . $value2 . '<br />';
	}	
}
$arr_transfer_information = curl_getinfo($ch);
$transfer_information = '';	
foreach($arr_transfer_information as $key1 => $value1) {
	$transfer_information .= $key1 . ': ' . $value1 . '<br />';
    foreach($value1 as $key2 => $value2) {
		$transfer_information .= "+". $key2 . ': ' . $value2 . '<br />';
	}	
}	
curl_setopt($ch, CURLOPT_URL, 'https://www.'.$inputdomain);
$curl_server_headers_www = curl_exec($ch);
$arr_server_headers_www = explode (",", $curl_server_headers_www);	
$server_headers_www = '';	
foreach($arr_server_headers_www as $key1 => $value1) {
	$server_headers_www .= $key1 . ': ' . $value1 . '<br />';
    foreach($value1 as $key2 => $value2) {
		$server_headers_www .= "+". $key2 . ': ' . $value2 . '<br />';
	}	
}	
$arr_transfer_information_www = curl_getinfo($ch);
$transfer_information_www = '';	
foreach($arr_transfer_information_www as $key1 => $value1) {
	$transfer_information_www .= $key1 . ': ' . $value1 . '<br />';
    foreach($value1 as $key2 => $value2) {
		$transfer_information_www .= "+". $key2 . ': ' . $value2 . '<br />';
	}	
}	
curl_close($ch);

$doc = new DOMDocument("1.0", "UTF-8");
$doc->xmlStandalone = true;	
$doc->formatOutput = true;		
	
$domains = $doc->createElement("domains");
$doc->appendChild($domains);
	
$domain = $doc->createElement("domain");	
$domains->appendChild($domain);
	
$domain->setAttribute("item", $inputdomain);
	
$domain_server_headers = $doc->createElement("server_headers");
$domain_server_headers->appendChild($doc->createCDATASection($server_headers));		
$domain->appendChild($domain_server_headers);
	
$domain_transfer_information = $doc->createElement("transfer_information");
$domain_transfer_information->appendChild($doc->createCDATASection($transfer_information));
$domain->appendChild($domain_transfer_information);
	
$domain_server_headers_www = $doc->createElement("server_headers_www");
$domain_server_headers_www->appendChild($doc->createCDATASection($server_headers_www));		
$domain->appendChild($domain_server_headers_www);
	
$domain_transfer_information_www = $doc->createElement("transfer_information_www");
$domain_transfer_information_www->appendChild($doc->createCDATASection($transfer_information_www));
$domain->appendChild($domain_transfer_information_www);	
	
$domains->appendChild($domain);
$doc->appendChild($domains);
//return $doc->saveXML(NULL, LIBXML_NOEMPTYTAG);
return $doc->saveXML();
}
?>