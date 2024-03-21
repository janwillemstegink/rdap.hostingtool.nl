<?php
session_start();  // is needed with no Scriptcase PHP Generator
echo '<!DOCTYPE html><html lang="en" style="font-size: 90%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>server headers/title>';
?><script>
	
function SwitchDisplay(type) {
	if (type == 80)			{ // server header
		var pre = '80';
		var max = 1
	}
	else if (type == 81)	{ // server header www
		var pre = '81';
		var max = 1
	}
	else if (type == 90)	{ // transfer information
		var pre = '90';
		var max = 1
	}
	else if (type == 91)	{ // transfer information www
		var pre = '91';
		var max = 1
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
//$developmentpath = '/home/admin/whois_file/';
//$zonefile = 'data_zones.xml';
//$domainfile = 'data_domains.xml';
if (!empty($_GET['url']))	{
	$viewserver = $_GET['url'];
}
else	{
	$viewserver = 'hostingtool.nl';
}

$server_url = 'https://rdap.hostingtool.nl/compose_server_headers/index.php?url='.$viewserver;
if (@get_headers($server_url))	{ // the application to compose for zone data
	$xml1 = simplexml_load_file($server_url, "SimpleXMLElement", LIBXML_NOCDATA) or die("An entered url could not be read.");
}
$html_text = '<body><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem">
<tr><th style="width:325px"></th><th style="width:300px"></th><th style="width:750px"></th></tr>';
$html_text .= '<tr style="font-size: .8rem"><td style="font-size: 1.3rem;color:blue;font-weight:bold">Modeling Server Headers</td>
<td><form action='.htmlentities($_SERVER['PHP_SELF']).' method="get">    
	<label for="url">Just enter a url:</label>
	<input type="text" style="width:90%" id="url" name="url" value='.$viewserver.'></form></td><td> 
	<a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap_view_model/issues" target="_blank">issues</a></td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr style="font-size:1.05rem;font-weight:bold"><td id="field"></td><td id="value"><td id="explanation"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(80)">server headers +/-</button></td></tr>';
	$html_text .= '<tr id="801" style="display:table-row"><td colspan="3">'.$item->server_headers.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(81)">server headers www +/-</button></td></tr>';
	$html_text .= '<tr id="811" style="display:table-row"><td colspan="3">'.$item->server_headers_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(90)">transfer information +/-</button></td></tr>';
	$html_text .= '<tr id="901" style="display:table-row"><td colspan="3">'.$item->transfer_information.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(91)">transfer information www +/-</button></td></tr>';
	$html_text .= '<tr id="911" style="display:table-row"><td colspan="3">'.$item->transfer_information_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>