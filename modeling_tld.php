<?php
session_start();  // is needed with no Scriptcase PHP Generator
$datetime = new DateTime('now', new DateTimeZone('UTC'));
$utc = $datetime->format('Y-m-d H:i:s');
if (empty($_GET["language"]))	{
	$browserlanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	switch ($browserlanguage) {
		case 'nl':
	 		$viewlanguage = 1;
	 		break;
		case 'de':
	 		$viewlanguage = 3;
			break;
		case 'fr':
   			$viewlanguage = 4;
   			break;
		default:
   			$viewlanguage = 2;		
	}	
}
else	{
	$viewlanguage = $_GET["language"];
}
if (!empty(trim($_GET['tld'])))	{
	$vd = trim($_GET['tld']);
	$vd = mb_strtolower($vd);
	$vd = str_replace('http://','', $vd);
	$vd = str_replace('https://','', $vd);
	if (substr_count($vd, '.') > 1)	{
		$vd = str_replace('www.','', $vd);
	}
	$strpos = mb_strpos($vd, '/');
	if ($strpos)	{
		$vd = mb_substr($vd, 0, $strpos);
	}
	$strpos = mb_strpos($vd, ':');
	if ($strpos)	{
		$vd = mb_substr($vd, 0, $strpos);
	}
}
else	{
	$vd = 'nl';
}	
if (empty([ip]) or empty([block]))	{
	[ip] = getClientIP();
	[block] = get_block([ip]);
}
$log_file = "/home/admin/logging/tld_lookup_tool_" . date("Ym") . ".txt";
$log_line = $datetime->format('Y-m-d H:i:s') . " UTC, lang" . $viewlanguage . ", " . $vd . ", " . [ip] . ", " . [block] . "\n";
file_put_contents($log_file, $log_line, FILE_APPEND);
echo '<!DOCTYPE html><html lang="en" style="font-size: 90%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>Domain Information</title>';
?><script>
	
function SwitchDisplay(type) {
	if (type == 26)	{ 	// common
		var pre = '26';
		var max = 1
	}
	else if (type == 27)	{ // zone 
		var pre = '27';
		var max = 1
	}
	else if (type == 28)	{ // lifecycle
		var pre = '28';
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

function SwitchTranslation(translation)	{
	document.getElementById("language").value = translation;
	if (translation == 99)	{
		var modified = '';
		var proposed = '';
		document.getElementById("title").textContent = "TLD Information";
		document.getElementById("subtitle").textContent = "RDAP v1 based modeling";
		document.getElementById("instruction").textContent = "Fill in and press Enter to retrieve.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "";
		document.getElementById("common_role").textContent = proposed;
		document.getElementById("common_root_zones_url").textContent = proposed;
		document.getElementById("common_lookup_endpoints_url").textContent = proposed;
		document.getElementById("common_registrar_accreditations_url").textContent = proposed;
		document.getElementById("common_tld_roles").textContent = proposed;
		document.getElementById("root_zone_role").textContent = proposed;
		document.getElementById("root_zone_active_from").textContent = proposed;
		document.getElementById("root_zone_delegation_url").textContent = proposed;
		document.getElementById("root_zone_tld_category").textContent = proposed;
		document.getElementById("root_zone_tld_type").textContent = proposed;
		document.getElementById("root_zone_restrictions_url").textContent = proposed;
		document.getElementById("root_zone_menu_url").textContent = proposed;
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed;
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_zone_status_meanings").textContent = proposed;
		document.getElementById("lifecycle_periods").textContent = proposed;
	}
	else if (translation == 1)	{
		var modified = '(Gewijzigd) ';
		var proposed = '(Nieuw) ';
		document.getElementById("title").textContent = "TLD-informatie";
		document.getElementById("subtitle").textContent = "RDAP v1-gebaseerde modellering";
		document.getElementById("instruction").textContent = "Typ een TLD-naam en druk op Enter.";
		document.getElementById("field").textContent = "Omschrijving";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Een overzicht van en toelichting op de structuur en kenmerken van TLD's.";
		document.getElementById("common_role").textContent = proposed;
		document.getElementById("common_root_zones_url").textContent = proposed + 'URL die verwijst naar de officiële lijst met Root Zones.';
		document.getElementById("common_lookup_endpoints_url").textContent = proposed + "Een folder /v1/ ondersteunt ook mogelijke /v2/-responses; zie icann.com.";
		document.getElementById("common_registrar_accreditations_url").textContent = proposed;
		document.getElementById("common_tld_roles").textContent = proposed;
		document.getElementById("root_zone_role").textContent = proposed + "Top-Level Domain (TLD)";
		document.getElementById("root_zone_active_from").textContent = proposed;
		document.getElementById("root_zone_delegation_url").textContent = proposed + 'URL die verwijst naar het ICANN-delegatierecord voor de TLD.';
		document.getElementById("root_zone_tld_category").textContent = proposed + 'Geeft een generieke TLD (gTLD) of een landcode-TLD (ccTLD) aan.';
		document.getElementById("root_zone_tld_type").textContent = proposed + 'Het TLD-type, bijvoorbeeld gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD of geoTLD.';
		document.getElementById("root_zone_restrictions_url").textContent = proposed + "Beperkingen op gebruik en registratiebeleid zijn te vinden via deze URL.";
		document.getElementById("root_zone_menu_url").textContent = proposed + 'Een TLD-specifiek informatiemenu, beschikbaar onder een subdomein zoals "regmenu".';
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed + "'Request-Driven': Aanvrager/TLD/rol vereisen een niet-geclusterde zichtbaarheid.";
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_zone_status_meanings").textContent = proposed + "De beëindigingstatussen uit het verleden zijn vaak misleidend.";
		document.getElementById("lifecycle_periods").textContent = proposed + 'Meerjarig registreren mogelijk; maximale periode varieert per TLD en registrar.';		
	}
	else if (translation == 2)	{
		var modified = '(Modified) ';
		var proposed = '(New) ';
		document.getElementById("title").textContent = "TLD Information";
		document.getElementById("subtitle").textContent = "RDAP v1 based modeling";
		document.getElementById("instruction").textContent = "Type a TLD name, then press Enter.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "An overview of the structure and key characteristics of TLD data.";
		document.getElementById("common_role").textContent = proposed;
		document.getElementById("common_root_zones_url").textContent = proposed + 'URL pointing to the official list of Root Zones.';
		document.getElementById("common_lookup_endpoints_url").textContent = proposed + "A /v1/ folder may also support /v2/ responses — see icann.com for details.";
		document.getElementById("common_registrar_accreditations_url").textContent = proposed;
		document.getElementById("common_tld_roles").textContent = proposed;		
		document.getElementById("root_zone_role").textContent = proposed + "Top-Level Domain (TLD)";
		document.getElementById("root_zone_active_from").textContent = proposed;
		document.getElementById("root_zone_delegation_url").textContent = proposed + 'URL pointing to the ICANN delegation record for the TLD.';
		document.getElementById("root_zone_tld_category").textContent = proposed + 'Indicates generic TLD (gTLD) or a country-code TLD (ccTLD).';
		document.getElementById("root_zone_tld_type").textContent = proposed + 'The TLD type, such as gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD, or geoTLD.';
		document.getElementById("root_zone_restrictions_url").textContent = proposed + "Usage and registration restrictions are listed at this URL.";
		document.getElementById("root_zone_menu_url").textContent = proposed + 'A TLD specific information menu, available under a subdomain such as "regmenu".';
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed + "Request-Driven: Requester/TLD/role require an unclustered visibility.";
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;	
		document.getElementById("lifecycle_zone_status_meanings").textContent = proposed + "The termination statuses coming from the past are often misleading.";
		document.getElementById("lifecycle_periods").textContent = proposed + 'Multi-year registration possible; max period varies by TLD and registrar.';	
	}
	else if (translation == 3)	{
		var modified = '(Geändert) ';
		var proposed = '(Neu) ';
		document.getElementById("title").textContent = "TLD-Informationen";
		document.getElementById("subtitle").textContent = "RDAP-v1-basierte Modellierung";
		document.getElementById("instruction").textContent = "Geben Sie einen TLD-Namen ein und drücken Sie Enter.";
		document.getElementById("field").textContent = "Beschreibung";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Eine Übersicht und Erklärung zur Struktur und den Eigenschaften von TLDs.";
		document.getElementById("common_role").textContent = proposed;
		document.getElementById("common_root_zones_url").textContent = proposed + 'URL mit Verweis auf die offizielle Liste der Root-Zones.';
		document.getElementById("common_lookup_endpoints_url").textContent = proposed + "Ein /v1/-Ordner unterstützt auch mögliche /v2/-Antworten; siehe icann.com.";
		document.getElementById("common_registrar_accreditations_url").textContent = proposed;
		document.getElementById("common_tld_roles").textContent = proposed;		
		document.getElementById("root_zone_role").textContent = proposed + "Top-Level Domain (TLD)";
		document.getElementById("root_zone_active_from").textContent = proposed;
		document.getElementById("root_zone_delegation_url").textContent = proposed + 'URL mit Verweis auf den ICANN-Delegationsdatensatz für die TLD.';
		document.getElementById("root_zone_tld_category").textContent = proposed + 'Zeigt eine generische TLD (gTLD) oder eine länderspezifische TLD (ccTLD) an.';
		document.getElementById("root_zone_tld_type").textContent = proposed + 'Der TLD-Typ, z. B. gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD oder geoTLD.';
		document.getElementById("root_zone_restrictions_url").textContent = proposed + "Nutzungsbeschränkungen und Registrierungsrichtlinien finden Sie unter dieser URL.";		
		document.getElementById("root_zone_menu_url").textContent = proposed + 'Ein TLD-spezifisches Informationsmenü, verfügbar unter einer Subdomäne wie "regmenu".';
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed + "'Request-Driven: Anforderer/TLD/Rolle erfordern eine nicht gruppierte Sichtbarkeit.";
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_zone_status_meanings").textContent = proposed + "Die Kündigungsstände aus der Vergangenheit sind oft irreführend.";
		document.getElementById("lifecycle_periods").textContent = proposed + 'Mehrjährige Registrierung möglich; maximale Laufzeit variiert je nach TLD und Registrar.';
	}
	else if (translation == 4)	{
		var modified = '(Modifié) ';
		var proposed = '(Nouveau) ';
		document.getElementById("title").textContent = "Informations sur le TLD";
		document.getElementById("subtitle").textContent = "Modélisation basée sur RDAP v1";
		document.getElementById("instruction").textContent = "Saisissez un nom TLD, puis appuyez sur Entrée.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Détail";
		document.getElementById("explanation").textContent = "Un aperçu et une explication de la structure et des caractéristiques des TLD.";
		document.getElementById("common_role").textContent = proposed;
		document.getElementById("common_root_zones_url").textContent = proposed + "URL référençan la liste officielle des 'Root Zones'.";
		document.getElementById("common_lookup_endpoints_url").textContent = proposed + "Un dossier /v1/ prend également en charge les réponses /v2/ possibles ; voir icann.com.";
		document.getElementById("common_registrar_accreditations_url").textContent = proposed;
		document.getElementById("common_tld_roles").textContent = proposed;
		document.getElementById("root_zone_role").textContent = proposed + "Top-Level Domain (TLD)";
		document.getElementById("root_zone_active_from").textContent = proposed;		
		document.getElementById("root_zone_delegation_url").textContent = proposed + "URL référençant l'enregistrement de délégation de l'ICANN pour le TLD.";	
		document.getElementById("root_zone_tld_category").textContent = proposed + "Indique un TLD générique (gTLD) ou un TLD de code pays (ccTLD).";
		document.getElementById("root_zone_tld_type").textContent = proposed + "Le type de TLD, tel que gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD ou geoTLD.";
		document.getElementById("root_zone_restrictions_url").textContent = proposed + "Les restrictions d’usage et les politiques d’enregistrement sont accessibles via cette URL.";
		document.getElementById("root_zone_menu_url").textContent = proposed + "Un menu d'informations spécifique au TLD, disponible sous un sous-domaine tel que 'regmenu'.";
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed + "'Request-Driven': Le demandeur/TLD/le rôle nécessite une visibilité non groupée.";
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_zone_status_meanings").textContent = proposed + "Les statuts de résiliation provenant du passé sont souvent trompeurs.";
		document.getElementById("lifecycle_periods").textContent = proposed + "Enregistrement pluriannuel possible ; durée maximale variable selon le TLD et le registrar.";
	}
}	
</script><?php
echo '</head>';
if (ini_get("allow_url_fopen") == 1)	{
}
else	{	
	die('allow_url_fopen does not work.'); 	
}
//$pd = idn_to_ascii($vd, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
$pd = $vd;
$server_url = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
$server_url .= '://'. $_SERVER['HTTP_HOST'];
$server_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);	
$server_url = dirname($server_url);
$rdap_url = $server_url.'/compose_tld/index.php?tld='.$pd;
if (@get_headers($rdap_url))	{ // the application to compose data
	$json = file_get_contents($rdap_url) or die("An entered tld could not be read.");
	$data = json_decode($json, true);
}
if	(is_null($data))	{
	$reopen = $server_url.'/modeling_tld/index.php?tld=tld';
	sc_redir($reopen);
}
$html_text = '<body onload=SwitchTranslation('.$viewlanguage.')><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem; table-layout: fixed; width:1375px">
<tr><th style="width:325px"></th><th style="width:300px"></th><th style="width:750px"></th></tr>';
$html_text .= '<tr style="font-size: .8rem"><td id="title" style="font-size: 1.3rem;color:blue;font-weight:bold"></td><td id="instruction"></td><td></td></tr>';
$html_text .= '<tr style="font-size: .8rem"><td id="subtitle" style="font-size: 1.0rem;color:blue;font-weight:bold"></td><td><form action='.htmlentities($_SERVER['PHP_SELF']).' method="get">
	<input type="hidden" id="language" name="language" value='.$viewlanguage.'>	
	<input type="text" style="width:90%" id="tld" name="tld" value='.$pd.'></form></td><td>
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(99)">None</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(1)">nl_NL</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(2)">en_US</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(3)">de_DE</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(4)">fr_FR</button> 
	<a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap.hostingtool.nl" target="_blank">code/issues on GitHub</a> - <a style="font-size: 0.9rem" href="https://janwillemstegink.nl/" target="_blank">janwillemstegink.nl</a></td></tr>';
if (true or $pd == mb_strtolower($data[$pd]['domain']['ascii_name']) or empty($data[$pd]['domain']['ascii_name']))	{
	$html_text .= '<tr style="font-size:1.05rem;font-weight:bold"><td id="field"></td><td id="value"><td id="explanation"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(26)">Common Information +/-</button></td><td></td><td id="common_role"></td></tr>';
	$html_text .= '<tr><td>root_zones_url</td><td><a href='.$data[$pd]['common']['root_zones_url'].' target="_blank">Root Zones</a></td><td id="common_root_zones_url"></td></tr>';
	$html_text .= '<tr><td>lookup_endpoints_url</td><td><a href='.$data[$pd]['common']['lookup_endpoints_url'].' target="_blank">Lookup Endpoints</a></td><td id="common_lookup_endpoints_url"></td></tr>';
	$html_text .= '<tr><td>registrar_accreditations_url</td><td><a href='.$data[$pd]['common']['registrar_accreditations_url'].' target="_blank">IANA Registrars</a></td><td id="common_registrar_accreditations_url"></td></tr>';
	$html_text .= '<tr id="261" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['common']['tld_roles'].'</td><td id="common_tld_roles"></td></tr>';	
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(27)">Root Zone Information +/-</button></td><td><b>'.$data[$pd]['root_zone']['zone_identifier'].'</b></td><td id="root_zone_role"></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>active_from</td><td> '.$data[$pd]['root_zone']['active_from'].'</td><td id="root_zone_active_from"></td></tr>';
	$html_text .= '<tr><td>delegation_url</td><td><a href='.$data[$pd]['root_zone']['delegation_url'].' target="_blank">TLD Delegation</a></td><td id="root_zone_delegation_url"></td></tr>';
	$html_text .= '<tr><td>tld_category</td><td>'.$data[$pd]['root_zone']['tld_category'].'</td><td id="root_zone_tld_category"></td></tr>';
	$html_text .= '<tr><td>tld_type</td><td>'.$data[$pd]['root_zone']['tld_type'].'</td><td id="root_zone_tld_type"></td></tr>';
	$html_text .= '<tr><td>restrictions_url</td><td>'.((strlen($data[$pd]['root_zone']['restrictions_url'])) ? '<a href='.$data[$pd]['root_zone']['restrictions_url'].' target="_blank">TLD Restrictions</a>' : '').'</td><td id="root_zone_restrictions_url"></td></tr>';
	$html_text .= '<tr><td>menu_url</td><td>'.((strlen($data[$pd]['root_zone']['menu_url'])) ? '<a href='.$data[$pd]['root_zone']['menu_url'].' target="_blank">TLD Menu</a>' : '').'</td><td id="root_zone_menu_url"></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td colspan="2">'.$data[$pd]['root_zone']['tld_contacts'].'</td><td id="root_zone_tld_contacts"></td></tr>';
	$html_text .= '<tr id="271" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['root_zone']['zone_roles'].'</td><td id="root_zone_zone_roles"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(28)">Lifecycle Information +/-</button></td><td></td><td id="lifecycle_role"></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>active_from</td><td>'.$data[$pd]['lifecycle']['active_from'].'</td><td id="lifecycle_active_from"></td></tr>';
	$html_text .= '<tr style="vertical-align:top;vertical-align:top"><td>upon_termination</td><td>'.$data[$pd]['lifecycle']['upon_termination'].'</td><td id="lifecycle_upon_termination"></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td colspan="2">'.$data[$pd]['lifecycle']['zone_status_meanings'].'</td><td id="lifecycle_zone_status_meanings"></td></tr>';
	$html_text .= '<tr id="281" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['lifecycle']['periods'].'</td><td id="lifecycle_periods"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
}
$html_text .= '</table></div></body></html>';
echo $html_text;

function getClientIP() {
    $ip = '';
    if (isset($_SERVER)) {
        if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ipList = explode(',', $_SERVER["HTTP_X_FORWARDED_FOR"]);
            $ip = trim($ipList[0]);
        } elseif (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipList = explode(',', getenv('HTTP_X_FORWARDED_FOR'));
            $ip = trim($ipList[0]);
        } elseif (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else {
            $ip = getenv('REMOTE_ADDR');
        }
    }
    return $ip;
}

function get_block($ip) {
    $rdap_url = "https://rdap.db.ripe.net/ip/".$ip;
    $response = @file_get_contents($rdap_url);
	$data = json_decode($response, true);
	$country = '';
	if (!empty($data['country']))	{
    	$country = $data['country'];
	}
	$orgName = '';
	if (!empty($data['entities'])) {
        foreach ($data['entities'] as $entity) {
            if (isset($entity['vcardArray'][1])) {
                foreach ($entity['vcardArray'][1] as $vcardField) {
                    if ($vcardField[0] === 'fn') {
                        $orgName .= $vcardField[3].'; ';
                    }

                }
            }
        }
    }
	return (strlen($country)) ? $country . '; ' . $orgName : $orgName;	
}						
?>