<?php
session_start();  // is needed with no Scriptcase PHP Generator
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
$datetime = new DateTime('now', new DateTimeZone('UTC'));
$utc = $datetime->format('Y-m-d H:i:s');
if (!empty($_GET["language"]))	{
	$_GET["language"] = intval($_GET["language"]);
	$viewlanguage = $_GET["language"];
}
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
if (!empty(trim($_GET['tld'])))	{
	$_GET["tld"] = trim($_GET['tld']);
	$_GET["tld"] = str_replace("'", "", $_GET["tld"]);
	$vd = mb_strtolower($_GET["tld"]);
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
	$vd = 'tld';
}	
if (empty([ip]) or empty([block]))	{
	[ip] = getClientIP();
	[block] = get_block([ip]);
}
$log_file = "/home/admin/logging/tld_lookup_tool_" . $datetime->format('Ym') . ".txt";
$log_line = $datetime->format('Y-m-d H:i:s') . " UTC, lang" . $viewlanguage . ", " . $vd . ", " . [ip] . ", " . [block] . "\n";
file_put_contents($log_file, $log_line, FILE_APPEND);
echo '<!DOCTYPE html><html lang="en" style="font-size: 90%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>TLD Information</title>';
?><script>
	
function SwitchDisplay(type) {
	if (type == 11)	{ // notice 0
		var pre = '11';
		var max = 5
	}
	else if (type == 12)	{ // notice 1
		var pre = '12';
		var max = 5
	}
	else if (type == 13)	{ // notice 2
		var pre = '13';
		var max = 5
	}
	else if (type == 14)	{ // notice 3
		var pre = '14';
		var max = 5
	}
	else if (type == 20)	{ // links 0
		var pre = '20';
		var max = 7
	}
	else if (type == 21)	{ // links 1
		var pre = '21';
		var max = 7
	}
	else if (type == 22)	{ // links 2
		var pre = '22';
		var max = 7
	}
	else if (type == 23)	{ // links 3
		var pre = '23';
		var max = 7
	}
	else if (type == 26)	{ // common
		var pre = '26';
		var max = 2
	}
	else if (type == 27)	{ // zone 
		var pre = '27';
		var max = 2
	}
	else if (type == 28)	{ // lifecycle
		var pre = '28';
		var max = 2
	}
	else if (type == 63)	{ // name servers
		var pre = '63';
		var max = 7
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
		var legacy = '';
		document.getElementById("title").textContent = "TLD Information";
		document.getElementById("subtitle").textContent = "RDAP v1 based modeling";
		document.getElementById("instruction").textContent = "Fill in and press Enter to retrieve.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "";
		document.getElementById("notices_role").textContent = legacy;
		document.getElementById("links_role").textContent = legacy;		
		document.getElementById("common_role").textContent = proposed;
		document.getElementById("common_root_services_url").textContent = proposed;
		document.getElementById("common_root_zones_url").textContent = proposed;
		document.getElementById("common_lookup_endpoints_url").textContent = proposed;
		document.getElementById("common_registrar_accreditations_url").textContent = proposed;
		document.getElementById("common_tld_roles").textContent = proposed;
		document.getElementById("common_root_accepted_workload").textContent = proposed;
		document.getElementById("root_zone_role").textContent = proposed;
		document.getElementById("root_zone_data_active_from").textContent = proposed;
		document.getElementById("root_zone_tld_category").textContent = proposed;
		document.getElementById("root_zone_tld_type").textContent = proposed;
		document.getElementById("root_zone_tld_statuses").textContent = modified;
		document.getElementById("root_zone_tld_delegation_url").textContent = proposed;
		document.getElementById("root_zone_tld_json_response_url").textContent = proposed;
		document.getElementById("root_zone_tld_terms_of_service_url").textContent = proposed;
		document.getElementById("root_zone_tld_privacy_policy_url").textContent = proposed;
		document.getElementById("root_zone_tld_menu_url").textContent = proposed;
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed;
		document.getElementById("root_zone_zone_accepted_workload").textContent = proposed;
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_zone_status_meanings").textContent = proposed;
		document.getElementById("lifecycle_periods").textContent = proposed;
		document.getElementById("name_servers_dnssec_algorithm").textContent = "";
	}
	else if (translation == 1)	{
		var modified = '(Gewijzigd) ';
		var proposed = '(Nieuw) ';
		var legacy = '(Legacy) ';
		document.getElementById("title").textContent = "TLD-informatie";
		document.getElementById("subtitle").textContent = "RDAP v1-gebaseerde modellering";
		document.getElementById("instruction").textContent = "Typ een TLD-naam en druk op Enter.";
		document.getElementById("field").textContent = "Omschrijving";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Gestroomlijnde TLD-metadata met een centraal model om redundantie te voorkomen.";
		document.getElementById("notices_role").textContent = legacy;
		document.getElementById("links_role").textContent = legacy;
		document.getElementById("common_role").textContent = proposed;
		document.getElementById("common_root_services_url").textContent = proposed + "IANA beheert, voor ICANN, TLD’s en wijst IP-blokken en AS-nummers toe aan regionale registries.";
		document.getElementById("common_root_zones_url").textContent = proposed + 'Officiële Root Zones-lijst, beheerd door IANA, de DNS-rootautoriteit.';
		document.getElementById("common_lookup_endpoints_url").textContent = proposed + "Een API-endpoint onder /v1/ kan een nieuwere versie onder /v2/ ondersteunen — zie icann.com.";
		document.getElementById("common_registrar_accreditations_url").textContent = proposed + "Officiële lijst van geaccrediteerde registrars, beheerd door IANA onder ICANN-beleid.";
		document.getElementById("common_tld_roles").textContent = proposed;
		document.getElementById("common_root_accepted_workload").textContent = proposed;
		document.getElementById("root_zone_role").textContent = proposed + "Top-Level Domain (TLD)";
		document.getElementById("root_zone_data_active_from").textContent = proposed;
		document.getElementById("root_zone_tld_category").textContent = proposed + 'Geeft een generieke TLD (gTLD) of een landcode-TLD (ccTLD) aan.';
		document.getElementById("root_zone_tld_type").textContent = proposed + 'Het TLD-type, bijvoorbeeld gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD of geoTLD.';
		document.getElementById("root_zone_tld_statuses").textContent = modified;		
		document.getElementById("root_zone_tld_delegation_url").textContent = proposed + 'URL die verwijst naar het ICANN-delegatierecord voor de TLD.';
		document.getElementById("root_zone_tld_json_response_url").textContent = proposed + "IANA kan overstappen op een moderne database voor de rollen en levenscyclus.";
		document.getElementById("root_zone_tld_terms_of_service_url").textContent = proposed;
		document.getElementById("root_zone_tld_privacy_policy_url").textContent = proposed;
		document.getElementById("root_zone_tld_menu_url").textContent = proposed + 'Een TLD-specifiek informatiemenu, beschikbaar onder een subdomein zoals "regmenu".';
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed + "'Request-Driven': Aanvrager/TLD/rol vereisen een niet-geclusterde zichtbaarheid.";
		document.getElementById("root_zone_zone_accepted_workload").textContent = proposed + "Deze modellering ondersteunt de modernisering van IANA-databasetabellen.";
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_zone_status_meanings").textContent = proposed + "FYI: Ik heb een globale tabeldefinitie opgesteld, maar ICANN speelt daarin nog geen hoofdrol.";
		document.getElementById("lifecycle_periods").textContent = proposed + 'Meerjarig registreren mogelijk; maximale periode varieert per TLD en registrar.';
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Een DNSSEC-algoritme vanaf versie 13 is up-to-date.";
	}
	else if (translation == 2)	{
		var modified = '(Modified) ';
		var proposed = '(New) ';
		var legacy = '(Legacy) ';		
		document.getElementById("title").textContent = "TLD Information";
		document.getElementById("subtitle").textContent = "RDAP v1 based modeling";
		document.getElementById("instruction").textContent = "Type a TLD name, then press Enter.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Streamlined TLD metadata using a single-source model to prevent redundancy.";
		document.getElementById("notices_role").textContent = legacy;
		document.getElementById("links_role").textContent = legacy;		
		document.getElementById("common_role").textContent = proposed;
		document.getElementById("common_root_services_url").textContent = proposed + "IANA manages, for ICANN, TLDs and allocates IP blocks and AS numbers to regional registries.";
		document.getElementById("common_root_zones_url").textContent = proposed + 'Official Root Zones list maintained by IANA, the DNS root authority.';
		document.getElementById("common_lookup_endpoints_url").textContent = proposed + "An API endpoint under /v1/ may support a newer version under /v2/ — as seen on icann.com.";
		document.getElementById("common_registrar_accreditations_url").textContent = proposed + "Official list of accredited registrars maintained by IANA under ICANN policy.";
		document.getElementById("common_tld_roles").textContent = proposed;
		document.getElementById("common_root_accepted_workload").textContent = proposed;
		document.getElementById("root_zone_role").textContent = proposed + "Top-Level Domain (TLD)";
		document.getElementById("root_zone_data_active_from").textContent = proposed;
		document.getElementById("root_zone_tld_category").textContent = proposed + 'Indicates generic TLD (gTLD) or a country-code TLD (ccTLD).';
		document.getElementById("root_zone_tld_type").textContent = proposed + 'The TLD type, such as gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD, or geoTLD.';
		document.getElementById("root_zone_tld_statuses").textContent = modified;
		document.getElementById("root_zone_tld_delegation_url").textContent = proposed + 'URL pointing to the ICANN delegation record for the TLD.';
		document.getElementById("root_zone_tld_json_response_url").textContent = proposed + "IANA can move to a modern database for the roles and lifecycle.";
		document.getElementById("root_zone_tld_terms_of_service_url").textContent = proposed;
		document.getElementById("root_zone_tld_privacy_policy_url").textContent = proposed;		
		document.getElementById("root_zone_tld_menu_url").textContent = proposed + 'A TLD specific information menu, available under a subdomain such as "regmenu".';
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed + "Request-Driven: Requester/TLD/role require an unclustered visibility.";
		document.getElementById("root_zone_zone_accepted_workload").textContent = proposed + "This modeling supports IANA database table modernization efforts.";
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;	
		document.getElementById("lifecycle_zone_status_meanings").textContent = proposed + "FYI: I have prepared a global table definition, but ICANN does not yet play a leading role in it.";
		document.getElementById("lifecycle_periods").textContent = proposed + 'Multi-year registration possible; max period varies by TLD and registrar.';
		document.getElementById("name_servers_dnssec_algorithm").textContent = "A DNSSEC algorithm starting from version 13 is up-to-date.";
	}
	else if (translation == 3)	{
		var modified = '(Geändert) ';
		var proposed = '(Neu) ';
		var legacy = '(Legacy) ';		
		document.getElementById("title").textContent = "TLD-Informationen";
		document.getElementById("subtitle").textContent = "RDAP-v1-basierte Modellierung";
		document.getElementById("instruction").textContent = "Geben Sie einen TLD-Namen ein und drücken Sie Enter.";
		document.getElementById("field").textContent = "Beschreibung";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Schlanke TLD-Metadaten mit einem Single-Source-Modell zur Vermeidung von Redundanz.";
		document.getElementById("notices_role").textContent = legacy;
		document.getElementById("links_role").textContent = legacy;		
		document.getElementById("common_role").textContent = proposed;
		document.getElementById("common_root_services_url").textContent = proposed + "IANA verwaltet, für ICANN, TLDs und weist IP-Blöcke sowie AS-Nummern an regionale Registries zu.";		
		document.getElementById("common_root_zones_url").textContent = proposed + 'Offizielle Root-Zonenliste, verwaltet von IANA, der DNS-Root-Behörde.';
		document.getElementById("common_lookup_endpoints_url").textContent = proposed + "Ein API-Endpunkt unter /v1/ kann eine neuere Version unter /v2/ unterstützen — siehe icann.com.";
		document.getElementById("common_registrar_accreditations_url").textContent = proposed + "Offizielle Liste der akkreditierten Registrar, verwaltet von IANA unter ICANN-Richtlinien.";
		document.getElementById("common_tld_roles").textContent = proposed;
		document.getElementById("common_root_accepted_workload").textContent = proposed;
		document.getElementById("root_zone_role").textContent = proposed + "Top-Level Domain (TLD)";
		document.getElementById("root_zone_data_active_from").textContent = proposed;
		document.getElementById("root_zone_tld_json_response_url").textContent = proposed + "IANA kann für die Rollen und den Lebenszyklus auf eine moderne Datenbank umsteigen.";
		document.getElementById("root_zone_tld_category").textContent = proposed + 'Zeigt eine generische TLD (gTLD) oder eine länderspezifische TLD (ccTLD) an.';
		document.getElementById("root_zone_tld_type").textContent = proposed + 'Der TLD-Typ, z. B. gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD oder geoTLD.';
		document.getElementById("root_zone_tld_statuses").textContent = modified;
		document.getElementById("root_zone_tld_delegation_url").textContent = proposed + 'URL mit Verweis auf den ICANN-Delegationsdatensatz für die TLD.';
		document.getElementById("root_zone_tld_terms_of_service_url").textContent = proposed;
		document.getElementById("root_zone_tld_privacy_policy_url").textContent = proposed;		
		document.getElementById("root_zone_tld_menu_url").textContent = proposed + 'Ein TLD-spezifisches Informationsmenü, verfügbar unter einer Subdomäne wie "regmenu".';
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed + "'Request-Driven: Anforderer/TLD/Rolle erfordern eine nicht gruppierte Sichtbarkeit.";
		document.getElementById("root_zone_zone_accepted_workload").textContent = proposed + "Dieses Modell unterstützt die Modernisierung der IANA-Datenbanktabellen.";
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_zone_status_meanings").textContent = proposed + "FYI: Ich habe eine globale Tabellendefinition vorbereitet, aber ICANN spielt darin noch keine führende Rolle.";
		document.getElementById("lifecycle_periods").textContent = proposed + 'Mehrjährige Registrierung möglich; maximale Laufzeit variiert je nach TLD und Registrar.';
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Ein DNSSEC-Algorithmus ab Version 13 ist auf dem neuesten Stand.";
	}
	else if (translation == 4)	{
		var modified = '(Modifié) ';
		var proposed = '(Nouveau) ';
		var legacy = '(Legacy) ';		
		document.getElementById("title").textContent = "Informations sur le TLD";
		document.getElementById("subtitle").textContent = "Modélisation basée sur RDAP v1";
		document.getElementById("instruction").textContent = "Saisissez un nom TLD, puis appuyez sur Entrée.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Détail";
		document.getElementById("explanation").textContent = "Métadonnées TLD rationalisées utilisant un modèle à source unique pour éviter la redondance.";
		document.getElementById("notices_role").textContent = legacy;
		document.getElementById("links_role").textContent = legacy;		
		document.getElementById("common_role").textContent = proposed;
		document.getElementById("common_root_services_url").textContent = proposed + "L’IANA gère pour l’ICANN les TLD et alloue les blocs IP ainsi que les numéros AS aux registres régionaux.";
		document.getElementById("common_root_zones_url").textContent = proposed + "Liste officielle des zones racines, gérée par l’IANA, l’autorité racine du DNS.";
		document.getElementById("common_lookup_endpoints_url").textContent = proposed + "Un endpoint API sous /v1/ peut supporter une version plus récente sous /v2/ — voir icann.com.";
		document.getElementById("common_registrar_accreditations_url").textContent = proposed + "Liste officielle des bureaux d’enregistrement accrédités, gérée par l’IANA selon la politique de l’ICANN.";
		document.getElementById("common_tld_roles").textContent = proposed;
		document.getElementById("common_root_accepted_workload").textContent = proposed;
		document.getElementById("root_zone_role").textContent = proposed + "Top-Level Domain (TLD)";
		document.getElementById("root_zone_data_active_from").textContent = proposed;
		document.getElementById("root_zone_tld_category").textContent = proposed + "Indique un TLD générique (gTLD) ou un TLD de code pays (ccTLD).";
		document.getElementById("root_zone_tld_type").textContent = proposed + "Le type de TLD, tel que gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD ou geoTLD.";
		document.getElementById("root_zone_tld_statuses").textContent = modified;
		document.getElementById("root_zone_tld_delegation_url").textContent = proposed + "URL référençant l'enregistrement de délégation de l'ICANN pour le TLD.";
		document.getElementById("root_zone_tld_json_response_url").textContent = proposed + "L'IANA peut passer à une base de données moderne pour les rôles et le cycle de vie.";
		document.getElementById("root_zone_tld_terms_of_service_url").textContent = proposed;
		document.getElementById("root_zone_tld_privacy_policy_url").textContent = proposed;		
		document.getElementById("root_zone_tld_menu_url").textContent = proposed + "Un menu d'informations spécifique au TLD, disponible sous un sous-domaine tel que 'regmenu'.";
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed + "'Request-Driven': Le demandeur/TLD/le rôle nécessite une visibilité non groupée.";
		document.getElementById("root_zone_zone_accepted_workload").textContent = proposed + "Cette modélisation soutient la modernisation des tables de la base de données IANA.";
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_zone_status_meanings").textContent = proposed + "FYI: J'ai préparé une définition de table globale, mais l'ICANN n'y joue pas encore un rôle de premier plan.";
		document.getElementById("lifecycle_periods").textContent = proposed + "Enregistrement pluriannuel possible ; durée maximale variable selon le TLD et le registrar.";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Un algorithme DNSSEC à partir de la version 13 est à jour.";
	}
}	
</script><?php
echo '</head>';
if (ini_get("allow_url_fopen") == 1)	{
}
else	{	
	die('allow_url_fopen does not work.'); 	
}
$pd = idn_to_ascii($vd, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
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
	<a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_menu" target="_blank">Menu modeling</a> - <a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap.hostingtool.nl" target="_blank">Code/issues on GitHub</a> - <a style="font-size: 0.9rem" href="https://janwillemstegink.nl/" target="_blank">Insight at janwillemstegink.nl</a></td></tr>';
if (true or $pd == mb_strtolower($data[$pd]['domain']['ascii_name']) or empty($data[$pd]['domain']['ascii_name']))	{
	$html_text .= '<tr style="font-size:1.05rem;font-weight:bold"><td id="field"></td><td id="value"><td id="explanation"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(11)">Notice0 +/-</button> <button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(12)">Notice1 +/-</button> <button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(13)">Notice2 +/-</button> <button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(14)">Notice3 +/-</button></td><td></td><td id="notices_role"></td></tr>';
	$html_text .= '<tr id="111" style="display:none;vertical-align:top"><td>notice_0_title</td><td>'.$data[$pd]['notices']['notice_0_title'].'</td><td></td></tr>';
	$html_text .= '<tr id="112" style="display:none;vertical-align:top"><td>notice_0_description_0</td><td>'.$data[$pd]['notices']['notice_0_description_0'].'</td><td></td></tr>';
	$html_text .= '<tr id="113" style="display:none;vertical-align:top"><td>notice_0_description_1</td><td>'.$data[$pd]['notices']['notice_0_description_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="114" style="display:none;vertical-align:top"><td>notice_0_links_0_href</td><td>'.$data[$pd]['notices']['notice_0_links_0_href'].'</td><td></td></tr>';
	$html_text .= '<tr id="115" style="display:none;vertical-align:top"><td>notice_0_links_0_type</td><td>'.$data[$pd]['notices']['notice_0_links_0_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="121" style="display:none;vertical-align:top"><td>notice_1_title</td><td>'.$data[$pd]['notices']['notice_1_title'].'</td><td></td></tr>';
	$html_text .= '<tr id="122" style="display:none;vertical-align:top"><td>notice_1_description_0</td><td>'.$data[$pd]['notices']['notice_1_description_0'].'</td><td></td></tr>';
	$html_text .= '<tr id="123" style="display:none;vertical-align:top"><td>notice_1_description_1</td><td>'.$data[$pd]['notices']['notice_1_description_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="124" style="display:none;vertical-align:top"><td>notice_1_links_0_href</td><td>'.$data[$pd]['notices']['notice_1_links_0_href'].'</td><td></td></tr>';
	$html_text .= '<tr id="125" style="display:none;vertical-align:top"><td>notice_1_links_0_type</td><td>'.$data[$pd]['notices']['notice_1_links_0_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="131" style="display:none;vertical-align:top"><td>notice_2_title</td><td>'.$data[$pd]['notices']['notice_2_title'].'</td><td></td></tr>';
	$html_text .= '<tr id="132" style="display:none;vertical-align:top"><td>notice_2_description_0</td><td>'.$data[$pd]['notices']['notice_2_description_0'].'</td><td></td></tr>';
	$html_text .= '<tr id="133" style="display:none;vertical-align:top"><td>notice_2_description_1</td><td>'.$data[$pd]['notices']['notice_2_description_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="134" style="display:none;vertical-align:top"><td>notice_2_links_0_href</td><td>'.$data[$pd]['notices']['notice_2_links_0_href'].'</td><td></td></tr>';
	$html_text .= '<tr id="135" style="display:none;vertical-align:top"><td>notice_2_links_0_type</td><td>'.$data[$pd]['notices']['notice_2_links_0_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="141" style="display:none;vertical-align:top"><td>notice_3_title</td><td>'.$data[$pd]['notices']['notice_3_title'].'</td><td></td></tr>';
	$html_text .= '<tr id="142" style="display:none;vertical-align:top"><td>notice_3_description_0</td><td>'.$data[$pd]['notices']['notice_3_description_0'].'</td><td></td></tr>';
	$html_text .= '<tr id="143" style="display:none;vertical-align:top"><td>notice_3_description_1</td><td>'.$data[$pd]['notices']['notice_3_description_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="144" style="display:none;vertical-align:top"><td>notice_3_links_0_href</td><td>'.$data[$pd]['notices']['notice_3_links_0_href'].'</td><td></td></tr>';
	$html_text .= '<tr id="145" style="display:none;vertical-align:top"><td>notice_3_links_0_type</td><td>'.$data[$pd]['notices']['notice_3_links_0_type'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(20)">Links0 +/-</button> <button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(21)">Links1 +/-</button> <button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(22)">Links2 +/-</button> <button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(23)">Links3 +/-</button></td><td></td><td id="links_role"></td></tr>';
	$html_text .= '<tr id="201" style="display:none;vertical-align:top"><td>links_0_value</td><td>'.$data[$pd]['links']['links_0_value'].'</td><td></td></tr>';
	$html_text .= '<tr id="202" style="display:none;vertical-align:top"><td>links_0_related</td><td>'.$data[$pd]['links']['links_0_related'].'</td><td></td></tr>';
	$html_text .= '<tr id="203" style="display:none;vertical-align:top"><td>links_0_href</td><td>'.$data[$pd]['links']['links_0_href'].'</td><td></td></tr>';
	$html_text .= '<tr id="204" style="display:none;vertical-align:top"><td>links_0_href_lang</td><td>'.$data[$pd]['links']['links_0_href_lang'].'</td><td></td></tr>';
	$html_text .= '<tr id="205" style="display:none;vertical-align:top"><td>links_0_title</td><td>'.$data[$pd]['links']['links_0_title'].'</td><td></td></tr>';
	$html_text .= '<tr id="206" style="display:none;vertical-align:top"><td>links_0_media</td><td>'.$data[$pd]['links']['links_0_media'].'</td><td></td></tr>';
	$html_text .= '<tr id="207" style="display:none;vertical-align:top"><td>links_0_type</td><td>'.$data[$pd]['links']['links_0_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="211" style="display:none;vertical-align:top"><td>links_1_value</td><td>'.$data[$pd]['links']['links_1_value'].'</td><td></td></tr>';
	$html_text .= '<tr id="212" style="display:none;vertical-align:top"><td>links_1_related</td><td>'.$data[$pd]['links']['links_1_related'].'</td><td></td></tr>';
	$html_text .= '<tr id="213" style="display:none;vertical-align:top"><td>links_1_href</td><td>'.$data[$pd]['links']['links_1_href'].'</td><td></td></tr>';
	$html_text .= '<tr id="214" style="display:none;vertical-align:top"><td>links_1_href_lang</td><td>'.$data[$pd]['links']['links_1_href_lang'].'</td><td></td></tr>';
	$html_text .= '<tr id="215" style="display:none;vertical-align:top"><td>links_1_title</td><td>'.$data[$pd]['links']['links_1_title'].'</td><td></td></tr>';
	$html_text .= '<tr id="216" style="display:none;vertical-align:top"><td>links_1_media</td><td>'.$data[$pd]['links']['links_1_media'].'</td><td></td></tr>';
	$html_text .= '<tr id="217" style="display:none;vertical-align:top"><td>links_1_type</td><td>'.$data[$pd]['links']['links_1_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="221" style="display:none;vertical-align:top"><td>links_2_value</td><td>'.$data[$pd]['links']['links_2_value'].'</td><td></td></tr>';
	$html_text .= '<tr id="222" style="display:none;vertical-align:top"><td>links_2_related</td><td>'.$data[$pd]['links']['links_2_related'].'</td><td></td></tr>';
	$html_text .= '<tr id="223" style="display:none;vertical-align:top"><td>links_2_href</td><td>'.$data[$pd]['links']['links_2_href'].'</td><td></td></tr>';
	$html_text .= '<tr id="224" style="display:none;vertical-align:top"><td>links_2_href_lang</td><td>'.$data[$pd]['links']['links_2_href_lang'].'</td><td></td></tr>';
	$html_text .= '<tr id="225" style="display:none;vertical-align:top"><td>links_2_title</td><td>'.$data[$pd]['links']['links_2_title'].'</td><td></td></tr>';
	$html_text .= '<tr id="226" style="display:none;vertical-align:top"><td>links_2_media</td><td>'.$data[$pd]['links']['links_2_media'].'</td><td></td></tr>';
	$html_text .= '<tr id="227" style="display:none;vertical-align:top"><td>links_2_type</td><td>'.$data[$pd]['links']['links_2_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="231" style="display:none;vertical-align:top"><td>links_3_value</td><td>'.$data[$pd]['links']['links_3_value'].'</td><td></td></tr>';
	$html_text .= '<tr id="232" style="display:none;vertical-align:top"><td>links_3_related</td><td>'.$data[$pd]['links']['links_3_related'].'</td><td></td></tr>';
	$html_text .= '<tr id="233" style="display:none;vertical-align:top"><td>links_3_href</td><td>'.$data[$pd]['links']['links_3_href'].'</td><td></td></tr>';
	$html_text .= '<tr id="234" style="display:none;vertical-align:top"><td>links_3_href_lang</td><td>'.$data[$pd]['links']['links_3_href_lang'].'</td><td></td></tr>';
	$html_text .= '<tr id="235" style="display:none;vertical-align:top"><td>links_3_title</td><td>'.$data[$pd]['links']['links_3_title'].'</td><td></td></tr>';
	$html_text .= '<tr id="236" style="display:none;vertical-align:top"><td>links_3_media</td><td>'.$data[$pd]['links']['links_3_media'].'</td><td></td></tr>';
	$html_text .= '<tr id="237" style="display:none;vertical-align:top"><td>links_3_type</td><td>'.$data[$pd]['links']['links_3_type'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(26)">Common Information +/-</button></td><td></td><td id="common_role"></td></tr>';
	$html_text .= '<tr><td>root_services_url</td><td><a href='.$data[$pd]['common']['root_services_url'].' target="_blank">Root Services</a></td><td id="common_root_services_url"></td></tr>';
	$html_text .= '<tr><td>root_zones_url</td><td><a href='.$data[$pd]['common']['root_zones_url'].' target="_blank">Root Zones</a></td><td id="common_root_zones_url"></td></tr>';
	$html_text .= '<tr><td>lookup_endpoints_url</td><td><a href='.$data[$pd]['common']['lookup_endpoints_url'].' target="_blank">Lookup Endpoints</a></td><td id="common_lookup_endpoints_url"></td></tr>';
	$html_text .= '<tr><td>registrar_accreditations_url</td><td><a href='.$data[$pd]['common']['registrar_accreditations_url'].' target="_blank">IANA Registrars</a></td><td id="common_registrar_accreditations_url"></td></tr>';
	$html_text .= '<tr id="261" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['common']['tld_roles'].'</td><td id="common_tld_roles"></td></tr>';
	$html_text .= '<tr id="262" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['common']['root_accepted_workload'].'</td><td id="common_root_accepted_workload"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(27)">Root Zone Information +/-</button></td><td><b>'.$vd.'</b></td><td id="root_zone_role"></td></tr>';
	$html_text .= '<tr><td>data_active_from</td><td> '.$data[$pd]['root_zone']['data_active_from'].'</td><td id="root_zone_data_active_from"></td></tr>';
	$html_text .= '<tr><td>tld_category</td><td>'.$data[$pd]['root_zone']['tld_category'].'</td><td id="root_zone_tld_category"></td></tr>';
	$html_text .= '<tr><td>tld_type</td><td>'.$data[$pd]['root_zone']['tld_type'].'</td><td id="root_zone_tld_type"></td></tr>';
	$html_text .= '<tr><td>tld_ascii_name</td><td>'.$data[$pd]['root_zone']['tld_ascii_name'].'</td><td></td></tr>';
	$html_text .= '<tr><td>tld_unicode_name</td><td>'.$data[$pd]['root_zone']['tld_unicode_name'].'</td><td></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>tld_statuses</td><td> '.$data[$pd]['root_zone']['tld_statuses'].'</td><td id="root_zone_tld_statuses"></td></tr>';
	$html_text .= '<tr><td>tld_delegation_url</td><td><a href='.$data[$pd]['root_zone']['tld_delegation_url'].' target="_blank">TLD Delegation</a></td><td id="root_zone_tld_delegation_url"></td></tr>';
	$html_text .= '<tr><td>tld_json_response_url</td><td>'.((strlen($data[$pd]['root_zone']['tld_json_response_url'])) ? '<a href='.$data[$pd]['root_zone']['tld_json_response_url'].' target="_blank">TLD Data</a>' : '').'</td><td id="root_zone_tld_json_response_url"></td></tr>';
	$html_text .= '<tr><td>tld_terms_of_service_url</td><td>'.((strlen($data[$pd]['root_zone']['tld_terms_of_service_url'])) ? '<a href='.$data[$pd]['root_zone']['tld_terms_of_service_url'].' target="_blank">TLD Terms</a>' : '').'</td><td id="root_zone_tld_terms_of_service_url"></td></tr>';
	$html_text .= '<tr><td>tld_privacy_policy_url</td><td>'.((strlen($data[$pd]['root_zone']['tld_privacy_policy_url'])) ? '<a href='.$data[$pd]['root_zone']['tld_privacy_policy_url'].' target="_blank">TLD Privacy</a>' : '').'</td><td id="root_zone_tld_privacy_policy_url"></td></tr>';
	$html_text .= '<tr><td>tld_menu_url</td><td>'.((strlen($data[$pd]['root_zone']['tld_menu_url'])) ? '<a href='.$data[$pd]['root_zone']['tld_menu_url'].' target="_blank">TLD Menu</a>' : '').'</td><td id="root_zone_tld_menu_url"></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td colspan="2">'.$data[$pd]['root_zone']['tld_contacts'].'</td><td id="root_zone_tld_contacts"></td></tr>';
	$html_text .= '<tr id="271" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['root_zone']['zone_roles'].'</td><td id="root_zone_zone_roles"></td></tr>';
	$html_text .= '<tr id="272" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['root_zone']['zone_accepted_workload'].'</td><td id="root_zone_zone_accepted_workload"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';	
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(28)">Lifecycle Information +/-</button></td><td></td><td id="lifecycle_role"></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>data_active_from</td><td>'.$data[$pd]['lifecycle']['data_active_from'].'</td><td id="lifecycle_data_active_from"></td></tr>';
	$html_text .= '<tr style="vertical-align:top;vertical-align:top"><td>upon_termination</td><td>'.$data[$pd]['lifecycle']['upon_termination'].'</td><td id="lifecycle_upon_termination"></td></tr>';
	$html_text .= '<tr id="281" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['lifecycle']['zone_status_meanings'].'</td><td id="lifecycle_zone_status_meanings"></td></tr>';
	$html_text .= '<tr id="282" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['lifecycle']['periods'].'</td><td id="lifecycle_periods"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(63)">Name Servers +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="631" style="display:none;vertical-align:top"><td>zone_handles</td><td>'.$data[$pd]['name_servers']['zone_handles'].'</td><td></td></tr>';
	$html_text .= '<tr id="632" style="display:none;vertical-align:top"><td>entry_handles</td><td>'.$data[$pd]['name_servers']['entry_handles'].'</td><td></td></tr>';
	$html_text .= '<tr id="633" style="display:none;vertical-align:top"><td>ascii_names</td><td>'.$data[$pd]['name_servers']['ascii_names'].'</td><td></td></tr>';
	$html_text .= '<tr id="634" style="display:none;vertical-align:top"><td>unicode_names</td><td>'.$data[$pd]['name_servers']['unicode_names'].'</td><td></td></tr>';
	$html_text .= '<tr id="635" style="display:none;vertical-align:top"><td>ipv4_addresses</td><td>'.$data[$pd]['name_servers']['ipv4_addresses'].'</td><td></td></tr>';
	$html_text .= '<tr id="636" style="display:none;vertical-align:top"><td>ipv6_addresses</td><td>'.$data[$pd]['name_servers']['ipv6_addresses'].'</td><td></td></tr>';
	$html_text .= '<tr><td>dnssec_signed</td><td>'.$data[$pd]['name_servers']['dnssec_signed'].'</td><td></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>dnssec_algorithm</td><td>'.$data[$pd]['name_servers']['dnssec_algorithm'].'</td><td id="name_servers_dnssec_algorithm"></td></tr>';	
	$html_text .= '<tr id="637" style="display:none;vertical-align:top"><td>dnssec_record</td><td colspan="2">'.$data[$pd]['name_servers']['dnssec_record'].'</td></tr>';
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