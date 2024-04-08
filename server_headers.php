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

	if (type == 11)			{ // www explanation
		var pre = '11';
		var max = 4
	}
	else if (type == 31)	{ // MX
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
	else if (type == 34)	{ // legacy
		var pre = '34';
		var max = 2
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
		var max = 5
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
	$html_text .= '<tr><td colspan="2"><button style="cursor:pointer;font-size:1.7rem" onclick="SwitchDisplay(11)">no www +/-</button></td><td><button style="cursor:pointer;font-size:1.7rem" onclick="SwitchDisplay(11)">via www +/-</button></td></tr>';
	$html_text .= '<tr id="111" style="display:table-row"><td colspan="2"><i>An apex domain is a root domain that does not contain a subdomain part.</i></td><td><i>The www subdomain has long been considered outdated.</i></td></tr>';
	$html_text .= '<tr id="112" style="display:table-row"><td colspan="2"><i></i></td><td><i>Without a subdomain, redirection via CNAME is not allowed anymore.</i></td></tr>';
	$html_text .= '<tr id="113" style="display:table-row"><td colspan="2"><i></i></td><td><i>If you host elsewhere with a subdomain, apex email traffic can remain secure.</i></td></tr>';
	$html_text .= '<tr id="114" style="display:table-row"><td colspan="2"><i></i></td><td><i>For a URL with a subdomain such as www, HSTS can be set more precisely.</i></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';	
	$html_text .= '<tr><td colspan="2"><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(31)">DNS CNAME, A, AAAA: rDNS +/-</button></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(31)">DNS CNAME, A, AAAA: rDNS +/-</button></td></tr>';
	$html_text .= '<tr id="311" style="display:none;vertical-align:top"><td colspan="2">'.$item->DNS_CNAME.'</td><td>'.$item->DNS_CNAME_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td colspan="2"><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(32)">DNS MX (incoming email) +/-</button></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(32)">DNS MX (Null MX value, except in cPanel) +/-</button></td></tr>';
	$html_text .= '<tr id="321" style="display:none;vertical-align:top"><td colspan="2">'.$item->DNS_MX.'</td><td>'.$item->DNS_MX_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td colspan="2"><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(33)">DNS TXT +/-</button></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(33)">DNS TXT (without server email: v=spf1 -all) +/-</button></td></tr>';
	$html_text .= '<tr id="331" style="display:none;vertical-align:top"><td colspan="2">'.$item->DNS_TXT.'</td><td>'.$item->DNS_TXT_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td colspan="2"><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(34)">legacy security.txt file +/-</button></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(34)">legacy security.txt file +/-</button></td></tr>';
	$html_text .= '<tr id="341" style="display:none;vertical-align:top"><td colspan="2"><em>'.$item->security_txt_url_legacy.'</em></td><td><em>'.$item->security_txt_url_www_legacy.'</em></td></tr>';
	$html_text .= '<tr id="342" style="display:none;vertical-align:top"><td colspan="2">'.$item->security_txt_legacy.'</td><td>'.$item->security_txt_www_legacy.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td colspan="2"><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(35)">relocated security.txt file +/-</button></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(35)">relocated security.txt file +/-</button></td></tr>';
	$html_text .= '<tr id="351" style="display:none;vertical-align:top"><td colspan="2"><em>'.$item->security_txt_url.'</em></td><td><em>'.$item->security_txt_url_www.'</em></td></tr>';
	$html_text .= '<tr id="352" style="display:none;vertical-align:top"><td colspan="2">'.$item->security_txt.'</td><td>'.$item->security_txt_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td colspan="2"><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(41)">transfer information +/-</button></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(41)">transfer information +/-</button></td></tr>';
	$html_text .= '<tr id="411" style="display:none;vertical-align:top"><td colspan="2">'.$item->transfer_information.'</td><td>'.$item->transfer_information_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td colspan="2"><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(50)">security header basics +/-</button></td><td></td></tr>';
	$html_text .= '<tr id="501" style="display:table-row"><td colspan="3"><i>For a security header to work, strict RFC interpretation requires that the current URL has also been the first URL over HTTPS. However, browsers work more broadly.</i></td></tr>';
	$html_text .= '<tr id="502" style="display:table-row"><td colspan="3"><i>A server header requires sufficient settings before public Internet access can be used safely. Do not set the HSTS preload list without understanding it.</i></td></tr>';
	$html_text .= '<tr id="503" style="display:table-row"><td colspan="3"><i>First rewrite the URL to HTTPS using the checkbox in the control panel, secondly set the security header values and finally, if applicable, redirect in the 301 or 302 way.</i></td></tr>';
	$html_text .= '<tr id="504" style="display:table-row"><td colspan="3"><i>In case of multiple HSTS header values (an application can also define a security header) there is a rule for the user agent (UA) as follows:</i></td></tr>';
	$html_text .= '<tr id="505" style="display:table-row"><td colspan="3"><i>RFC 6797, 8.1: If a UA receives more than one STS header field in an HTTP response message over secure transport, then the UA MUST process only the first such header field.</i></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td colspan="2"><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(51)">server header +/-</button></td><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(51)">server header +/-</button></td></tr>';
	$html_text .= '<tr id="511" style="display:table-row;vertical-align:top"><td colspan="2">'.$item->server_headers.'</td><td colspan="1">'.$item->server_headers_www.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>