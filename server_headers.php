<?php
session_start();  // is needed with no Scriptcase PHP Generator
echo '<!DOCTYPE html><html lang="en" style="font-size: 90%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>Server Headers</title>';
?><script>
	
function SwitchDisplay(type) {
	if (type == 11)			{ // transfer information without www
		var pre = '11';
		var max = 1
	}
	else if (type == 12)	{ // transfer information with www
		var pre = '12';
		var max = 1
	}
	else if (type == 20)	{ // server header explanation
		var pre = '20';
		var max = 3
	}
	else if (type == 21)	{ // server headers
		var pre = '21';
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
if (@get_headers($server_url))	{ 
	$xml1 = simplexml_load_file($server_url, "SimpleXMLElement", LIBXML_NOCDATA) or die("An entered url could not be read.");
}
$html_text = '<body><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem">
<tr><th style="width:325px"></th><th style="width:300px"></th><th style="width:750px"></th></tr>';
$html_text .= '<tr style="font-size: .8rem"><td style="font-size: 1.3rem;color:blue;font-weight:bold">Modeling Server Headers</td>
<td><form action='.htmlentities($_SERVER['PHP_SELF']).' method="get">    
	<label for="url">Just enter a URL:</label>
	<input type="text" style="width:90%" id="url" name="url" value='.$viewserver.'></form></td><td> 
	<a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap_view_model/issues" target="_blank">issues</a></td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(11)">transfer information without www +/-</button></td></tr>';
	$html_text .= '<tr id="111" style="display:none"><td colspan="3">'.$item->transfer_information.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(12)">transfer information with www +/-</button></td></tr>';
	$html_text .= '<tr id="121" style="display:none"><td colspan="3">'.$item->transfer_information_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(20)">server header explanation +/-</button></td></tr>';
	$html_text .= '<tr id="201" style="display:table-row"><td colspan="3">For a security header to work, the RFC specification requires that the current URL has also been the first URL over HTTPS.</td></tr>';
	$html_text .= '<tr id="202" style="display:table-row"><td colspan="3">A server header that is too short is a security weakness.';
	$html_text .= '<tr id="203" style="display:table-row"><td colspan="3">First rewrite with the check mark in the control panel to HTTPS, set the security headers and then 301/302 redirection if applicable.</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td colspan="2"><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(21)">server header without www +/-</button></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(21)">server header with www +/-</button></td></tr>';
	$html_text .= '<tr id="211" style="display:table-row;vertical-align:top"><td colspan="2">'.$item->server_headers.'</td><td colspan="1">'.$item->server_headers_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>