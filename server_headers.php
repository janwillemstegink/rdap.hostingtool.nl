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

	if (type == 31)			{ // CNAME
		var pre = '31';
		var max = 1
	}
	else if (type == 32)	{ // MX
		var pre = '32';
		var max = 1
	}
	else if (type == 33)	{ // TXT
		var pre = '33';
		var max = 1
	}
	else if (type == 34)	{ // HINFO
		var pre = '34';
		var max = 1
	}
	else if (type == 35)	{ // security headers
		var pre = '35';
		var max = 2
	}
	else if (type == 41)	{ // transfer information
		var pre = '41';
		var max = 1
	}
	else if (type == 50)	{ // server header explanation
		var pre = '50';
		var max = 3
	}
	else if (type == 51)	{ // server headers
		var pre = '51';
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
if (!empty($_GET['url']))	{
	$viewserver = $_GET['url'];
}
else	{
	$viewserver = 'rdap.hostingtool.nl';
}

$server_url = 'https://rdap.hostingtool.nl/compose_server_headers/index.php?url='.$viewserver;
if (@get_headers($server_url))	{ 
	$xml1 = simplexml_load_file($server_url, "SimpleXMLElement", LIBXML_NOCDATA) or die("An entered url could not be read.");
}
$html_text = '<body><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem; table-layout: fixed; width:1200px">
<tr><th style="width:300px"></th><th style="width:300px"></th><th style="width:600px"></th></tr>';
$html_text .= '<tr style="font-size: .8rem"><td style="font-size: 1.3rem;color:blue;font-weight:bold">Server Headers</td>
<td><form action='.htmlentities($_SERVER['PHP_SELF']).' method="get">    
	<label for="url">Just enter a URL:</label>
	<input type="text" style="width:90%" id="url" name="url" value='.$viewserver.'></form></td><td> <a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap_view_model/issues" target="_blank">issues on GitHub</a> - <a style="font-size: 0.9rem" href="https://webhostingtech.nl/wordpress/wp-content/uploads/2024/03/some-htaccess-statements.txt" target="_blank">example code for .htaccess</a></td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(31)">CNAME / A+AAAA, no www +/-</button></td><td></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(31)">CNAME / A+AAAA, via www +/-</button></td></tr>';
	$html_text .= '<tr id="311" style="display:none;vertical-align:top"><td colspan="2">'.$item->DNS_CNAME.'</td><td>'.$item->DNS_CNAME_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(32)">MX (incoming email), no www +/-</button></td><td></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(32)">MX (incoming email), via www +/-</button></td></tr>';
	$html_text .= '<tr id="321" style="display:none;vertical-align:top"><td colspan="2">'.$item->DNS_MX.'</td><td>'.$item->DNS_MX_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(33)">TXT, no www +/-</button></td><td></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(33)">TXT, via www +/-</button></td></tr>';
	$html_text .= '<tr id="331" style="display:none;vertical-align:top"><td colspan="2">'.$item->DNS_TXT.'</td><td>'.$item->DNS_TXT_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(35)">security.txt, no www +/-</button></td><td></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(35)">security.txt, via www +/-</button></td></tr>';
	$html_text .= '<tr id="351" style="display:none;vertical-align:top"><td colspan="2"><em>'.$item->security_txt_url.'</em></td><td><em>'.$item->security_txt_url_www.'</em></td></tr>';
	$html_text .= '<tr id="352" style="display:none;vertical-align:top"><td colspan="2">'.$item->security_txt.'</td><td>'.$item->security_txt_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(41)">transfer information, no www +/-</button></td><td></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(41)">transfer information, via www +/-</button></td></tr>';
	$html_text .= '<tr id="411" style="display:none;vertical-align:top"><td colspan="2">'.$item->transfer_information.'</td><td>'.$item->transfer_information_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td colspan="2"><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(50)">server header explanation +/-</button></td><td></td></tr>';
	$html_text .= '<tr id="501" style="display:none"><td colspan="3"><i>For a security header to work, strict RFC interpretation requires that the current URL has also been the first URL over HTTPS.</i></td></tr>';
	$html_text .= '<tr id="502" style="display:none"><td colspan="3"><i>A server header requires sufficient settings before public Internet access can be used safely.</i></td></tr>';
	$html_text .= '<tr id="503" style="display:none"><td colspan="3"><i>First rewrite the URL to HTTPS using the checkbox in the control panel, secondly set the security header values and finally, if applicable, redirect in the 301 or 302 way.</i></td></tr>';	
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td colspan="2"><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(51)">server header, no www +/-</button></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(51)">server header, via www +/-</button></td></tr>';
	$html_text .= '<tr id="511" style="display:table-row;vertical-align:top"><td colspan="2">'.$item->server_headers.'</td><td colspan="1">'.$item->server_headers_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>