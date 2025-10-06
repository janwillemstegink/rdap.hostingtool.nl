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
$internal = (str_contains([block],'Freedom')) ? '_internal_' : '';
$log_file = "/home/admin/logging/" . $internal . "tld_tool_" . $datetime->format('Ym') . ".txt";
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
	else if (type == 31)	{ // common URLs
		var pre = '31';
		var max = 4
	}
	else if (type == 32)	{ // roles
		var pre = '32';
		var max = 1
	}
	else if (type == 33)	{ // indeterminate RDAP statuses
		var pre = '33';
		var max = 1
	}
	else if (type == 34)	{ // best practices periods
		var pre = '34';
		var max = 1
	}
	else if (type == 35)	{ // root accepted workload
		var pre = '35';
		var max = 1
	}
	else if (type == 41)		{ // zone information
		var pre = '41';
		var max = 12
	}
	else if (type == 42)	{ // zone contacts
		var pre = '42';
		var max = 1
	}
	else if (type == 43)	{ // zone roles
		var pre = '43';
		var max = 1
	}
	else if (type == 44)	{ // zone accepted workload
		var pre = '44';
		var max = 1
	}
	else if (type == 51)	{ // lifecycle information
		var pre = '51';
		var max = 2
	}
	else if (type == 52)	{ // status meanings
		var pre = '52';
		var max = 1
	}
	else if (type == 53)	{ // operational_periods
		var pre = '53';
		var max = 1
	}
	else if (type == 61)	{ // name servers
		var pre = '61';
		var max = 10
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
		document.getElementById("title").textContent = "Request TLD Data";
		document.getElementById("subtitle").textContent = "RDAPv1 based modeling";
		document.getElementById("instruction").textContent = "Fill in and press Enter to retrieve.";
		document.getElementById("modeling").textContent = "";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "";
		document.getElementById("notices_role").textContent = legacy;
		document.getElementById("links_role").textContent = legacy;		
		document.getElementById("common_root_services_url").textContent = proposed;
		document.getElementById("common_root_zones_url").textContent = proposed;
		document.getElementById("common_lookup_endpoints_url").textContent = proposed;
		document.getElementById("common_registrar_accreditations_url").textContent = proposed;
		document.getElementById("common_tld_roles").textContent = proposed;
		document.getElementById("common_indeterminate_rdap_statuses").textContent = proposed;
		document.getElementById("common_best_practices_periods").textContent = proposed;
		document.getElementById("common_root_accepted_workload").textContent = proposed;
		document.getElementById("root_zone_role").textContent = "";
		document.getElementById("root_zone_data_active_from").textContent = proposed;
		document.getElementById("root_zone_tld_category").textContent = proposed;
		document.getElementById("root_zone_tld_type").textContent = proposed;
		document.getElementById("root_zone_tld_statuses").textContent = modified;
		document.getElementById("root_zone_tld_delegation_url").textContent = proposed;
		document.getElementById("root_zone_tld_json_response_url").textContent = proposed;
		document.getElementById("root_zone_tld_terms_of_service_url").textContent = proposed;
		document.getElementById("root_zone_tld_privacy_policy_url").textContent = proposed;
		document.getElementById("root_zone_tld_menu_url").textContent = proposed;
		document.getElementById("root_zone_tld_search_engine_deletion_phase_ready").textContent = proposed;
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed;
		document.getElementById("root_zone_zone_accepted_workload").textContent = proposed;
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_status_meanings").textContent = proposed;
		document.getElementById("lifecycle_operational_periods").textContent = proposed;
		document.getElementById("name_servers_dnssec_signed").textContent = "";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "";
		document.getElementById("name_servers_ip").textContent = "";
	}
	else if (translation == 1)	{
		var modified = '(Gewijzigd) ';
		var proposed = '(Nieuw) ';
		var legacy = '(Legacy) ';
		document.getElementById("title").textContent = "TLD Gegevens opvragen";
		document.getElementById("subtitle").textContent = "RDAPv1-gebaseerde modellering";
		document.getElementById("instruction").textContent = "Typ een TLD-naam en druk op Enter.";
		document.getElementById("modeling").textContent = "Een RDAPv2 kan onbepaalde statussen elimineren en ccTLD-proof zijn via een nieuwe globale tabeldefinitie in snake_case.";
		document.getElementById("field").textContent = "Omschrijving";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Gestroomlijnde TLD-metadata met een centraal model om redundantie te voorkomen.";
		document.getElementById("notices_role").textContent = legacy;
		document.getElementById("links_role").textContent = legacy;
		document.getElementById("common_root_services_url").textContent = proposed + "IANA beheert, voor ICANN, TLD’s en wijst IP-blokken en AS-nummers toe aan regionale registries.";
		document.getElementById("common_root_zones_url").textContent = proposed + 'Officiële Root Zones-lijst, beheerd door IANA, de DNS-rootautoriteit.';
		document.getElementById("common_lookup_endpoints_url").textContent = proposed + "Een API-endpoint onder /v1/ kan een nieuwere versie onder /v2/ ondersteunen — zie com.";
		document.getElementById("common_registrar_accreditations_url").textContent = proposed + "Officiële lijst van geaccrediteerde registrars, beheerd door IANA onder ICANN-beleid.";
		document.getElementById("common_tld_roles").textContent = proposed + "Deze rolbenamingen zijn voorlopig. Ze kunnen nog veranderen.";
		document.getElementById("common_indeterminate_rdap_statuses").textContent = proposed + "Ongeschikt voor automatisering, alleen informatief.";
		document.getElementById("common_best_practices_periods").textContent = proposed + "Registries kunnen baat hebben bij gedeelde richtlijnen.";
		document.getElementById("common_root_accepted_workload").textContent = proposed + "IANA-servers kunnen in de toekomst limieten toepassen.";
		document.getElementById("root_zone_role").textContent = "Top-Level Domain (TLD)";
		document.getElementById("root_zone_data_active_from").textContent = proposed;
		document.getElementById("root_zone_tld_category").textContent = proposed + 'Geeft een generieke TLD (gTLD) of een landcode-TLD (ccTLD) aan.';
		document.getElementById("root_zone_tld_type").textContent = proposed + 'Het TLD-type, bijvoorbeeld gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD of geoTLD.';
		document.getElementById("root_zone_tld_statuses").textContent = modified;		
		document.getElementById("root_zone_tld_delegation_url").textContent = proposed + 'URL die verwijst naar het ICANN-delegatierecord voor de TLD.';
		document.getElementById("root_zone_tld_json_response_url").textContent = proposed + "IANA kan overstappen op een moderne database voor de rollen en levenscyclus.";
		document.getElementById("root_zone_tld_terms_of_service_url").textContent = proposed;
		document.getElementById("root_zone_tld_privacy_policy_url").textContent = proposed;
		document.getElementById("root_zone_tld_menu_url").textContent = proposed + 'Een TLD-specifiek informatiemenu, beschikbaar onder een subdomein zoals "regmenu".';
		document.getElementById("root_zone_tld_search_engine_deletion_phase_ready").textContent = proposed + 'Of zoekmachines op pending delete mogen vertrouwen om resultaten te wissen.';
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed + "'Request-Driven': Aanvrager/TLD/rol vereisen een niet-geclusterde zichtbaarheid.";
		document.getElementById("root_zone_zone_accepted_workload").textContent = proposed + "Deze modellering ondersteunt de modernisering van IANA-databasetabellen.";
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_status_meanings").textContent = proposed + "Let op: Er bestaat een globale tabeldefinitie; ICANN speelt nog geen leidende rol.";
		document.getElementById("lifecycle_operational_periods").textContent = proposed + 'Meerjarige registratie soms mogelijk; max. verschilt per TLD en registrar.';
		document.getElementById("name_servers_dnssec_signed").textContent = "DNSSEC beveiligt DNS tegen spoofing en cachevergiftiging.";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Algoritmen 13, 14, 15 en 16 vormen de aanbevolen basislijn voor DNSSEC-compliance.";
		document.getElementById("name_servers_ip").textContent = "IP-adressen zijn zichtbaar indien van toepassing en ook opgenomen in het RDAP-bestand.";
	}
	else if (translation == 2)	{
		var modified = '(Modified) ';
		var proposed = '(New) ';
		var legacy = '(Legacy) ';		
		document.getElementById("title").textContent = "Request TLD Data";
		document.getElementById("subtitle").textContent = "RDAPv1 based modeling";
		document.getElementById("instruction").textContent = "Type a TLD name, then press Enter.";
		document.getElementById("modeling").textContent = "An RDAPv2 can eliminate indeterminate statuses and be ccTLD-proof via a new global table definition in snake_case.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Streamlined TLD metadata using a single-source model to prevent redundancy.";
		document.getElementById("notices_role").textContent = legacy;
		document.getElementById("links_role").textContent = legacy;		
		document.getElementById("common_root_services_url").textContent = proposed + "IANA manages, for ICANN, TLDs and allocates IP blocks and AS numbers to regional registries.";
		document.getElementById("common_root_zones_url").textContent = proposed + 'Official Root Zones list maintained by IANA, the DNS root authority.';
		document.getElementById("common_lookup_endpoints_url").textContent = proposed + "An API endpoint under /v1/ may support a newer version under /v2/ — as seen on com.";
		document.getElementById("common_registrar_accreditations_url").textContent = proposed + "Official list of accredited registrars maintained by IANA under ICANN policy.";
		document.getElementById("common_tld_roles").textContent = proposed + "These role names are draft. They may change.";
		document.getElementById("common_indeterminate_rdap_statuses").textContent = proposed + "Unsuitable for automation, informational only.";
		document.getElementById("common_best_practices_periods").textContent = proposed + "Registries may benefit from shared timing guidelines.";
		document.getElementById("common_root_accepted_workload").textContent = proposed + "IANA servers may apply limits in the future.";
		document.getElementById("root_zone_role").textContent = "Top-Level Domain (TLD)";
		document.getElementById("root_zone_data_active_from").textContent = proposed;
		document.getElementById("root_zone_tld_category").textContent = proposed + 'Indicates generic TLD (gTLD) or a country-code TLD (ccTLD).';
		document.getElementById("root_zone_tld_type").textContent = proposed + 'The TLD type, such as gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD, or geoTLD.';
		document.getElementById("root_zone_tld_statuses").textContent = modified;
		document.getElementById("root_zone_tld_delegation_url").textContent = proposed + 'URL pointing to the ICANN delegation record for the TLD.';
		document.getElementById("root_zone_tld_json_response_url").textContent = proposed + "IANA can move to a modern database for the roles and lifecycle.";
		document.getElementById("root_zone_tld_terms_of_service_url").textContent = proposed;
		document.getElementById("root_zone_tld_privacy_policy_url").textContent = proposed;		
		document.getElementById("root_zone_tld_menu_url").textContent = proposed + 'A TLD specific information menu, available under a subdomain such as "regmenu".';
		document.getElementById("root_zone_tld_search_engine_deletion_phase_ready").textContent = proposed + 'If search engines may rely on pending delete to delete results.';
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed + "Request-Driven: Requester/TLD/role require an unclustered visibility.";
		document.getElementById("root_zone_zone_accepted_workload").textContent = proposed + "This modeling supports IANA database table modernization efforts.";
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;	
		document.getElementById("lifecycle_status_meanings").textContent = proposed + "Note: A global table definition exists; ICANN is not yet in a leading role.";
		document.getElementById("lifecycle_operational_periods").textContent = proposed + 'Multi-year registration sometimes possible; max varies by TLD & registrar.';
		document.getElementById("name_servers_dnssec_signed").textContent = "DNSSEC secures DNS against spoofing and cache poisoning.";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Algorithms 13, 14, 15, and 16 are the recommended baseline for DNSSEC compliance.";
		document.getElementById("name_servers_ip").textContent = "IP addresses are visible if applicable and also included in the RDAP file.";
	}
	else if (translation == 3)	{
		var modified = '(Geändert) ';
		var proposed = '(Neu) ';
		var legacy = '(Legacy) ';		
		document.getElementById("title").textContent = "TLD-Daten anfordern";
		document.getElementById("subtitle").textContent = "RDAPv1-basierte Modellierung";
		document.getElementById("instruction").textContent = "Geben Sie einen TLD-Namen ein und drücken Sie Enter.";
		document.getElementById("modeling").textContent = "Ein RDAPv2 kann unbestimmte Statuswerte eliminieren und ccTLD-sicher sein durch eine neue globale Tabellendefinition in snake_case.";
		document.getElementById("field").textContent = "Beschreibung";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Schlanke TLD-Metadaten mit einem Single-Source-Modell zur Vermeidung von Redundanz.";
		document.getElementById("notices_role").textContent = legacy;
		document.getElementById("links_role").textContent = legacy;		
		document.getElementById("common_root_services_url").textContent = proposed + "IANA verwaltet, für ICANN, TLDs und weist IP-Blöcke sowie AS-Nummern an regionale Registries zu.";		
		document.getElementById("common_root_zones_url").textContent = proposed + 'Offizielle Root-Zonenliste, verwaltet von IANA, der DNS-Root-Behörde.';
		document.getElementById("common_lookup_endpoints_url").textContent = proposed + "Ein API-Endpunkt unter /v1/ kann eine neuere Version unter /v2/ unterstützen — siehe com.";
		document.getElementById("common_registrar_accreditations_url").textContent = proposed + "Offizielle Liste der akkreditierten Registrar, verwaltet von IANA unter ICANN-Richtlinien.";
		document.getElementById("common_tld_roles").textContent = proposed + "Diese Rollennamen sind vorläufig und können sich ändern.";
		document.getElementById("common_indeterminate_rdap_statuses").textContent = proposed + "Ungeeignet für Automatisierung, nur informativ.";
		document.getElementById("common_best_practices_periods").textContent = proposed + "Viele Registries können von gemeinsamen Regeln profitieren.";
		document.getElementById("common_root_accepted_workload").textContent = proposed + "IANA kann zukünftig Limits festlegen.";
		document.getElementById("root_zone_role").textContent = "Top-Level Domain (TLD)";
		document.getElementById("root_zone_data_active_from").textContent = proposed;
		document.getElementById("root_zone_tld_json_response_url").textContent = proposed + "IANA kann für die Rollen und den Lebenszyklus auf eine moderne Datenbank umsteigen.";
		document.getElementById("root_zone_tld_category").textContent = proposed + 'Zeigt eine generische TLD (gTLD) oder eine länderspezifische TLD (ccTLD) an.';
		document.getElementById("root_zone_tld_type").textContent = proposed + 'Der TLD-Typ, z. B. gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD oder geoTLD.';
		document.getElementById("root_zone_tld_statuses").textContent = modified;
		document.getElementById("root_zone_tld_delegation_url").textContent = proposed + 'URL mit Verweis auf den ICANN-Delegationsdatensatz für die TLD.';
		document.getElementById("root_zone_tld_terms_of_service_url").textContent = proposed;
		document.getElementById("root_zone_tld_privacy_policy_url").textContent = proposed;		
		document.getElementById("root_zone_tld_menu_url").textContent = proposed + 'Ein TLD-spezifisches Informationsmenü, verfügbar unter einer Subdomäne wie "regmenu".';
		document.getElementById("root_zone_tld_search_engine_deletion_phase_ready").textContent = proposed + 'Ob Suchmaschinen auf Pending Delete vertrauen dürfen, um Ergebnisse zu löschen.';
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed + "'Request-Driven: Anforderer/TLD/Rolle erfordern eine nicht gruppierte Sichtbarkeit.";
		document.getElementById("root_zone_zone_accepted_workload").textContent = proposed + "Dieses Modell unterstützt die Modernisierung der IANA-Datenbanktabellen.";
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_status_meanings").textContent = proposed + "Hinweis: Eine globale Tabellendefinition existiert; ICANN übernimmt noch keine führende Rolle.";
		document.getElementById("lifecycle_operational_periods").textContent = proposed + 'Mehrjährige Registrierung teils möglich; max. variiert je nach TLD und Registrar.';
		document.getElementById("name_servers_dnssec_signed").textContent = "DNSSEC sichert DNS gegen Spoofing und Cache-Poisoning.";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Die Algorithmen 13, 14, 15 und 16 sind die empfohlene Basis für DNSSEC-Compliance.";
		document.getElementById("name_servers_ip").textContent = "IP-Adressen sind sichtbar, sofern zutreffend, und auch in der RDAP-Datei enthalten.";
	}
	else if (translation == 4)	{
		var modified = '(Modifié) ';
		var proposed = '(Nouveau) ';
		var legacy = '(Legacy) ';		
		document.getElementById("title").textContent = "Demande de données TLD";
		document.getElementById("subtitle").textContent = "Modélisation basée sur RDAPv1";
		document.getElementById("instruction").textContent = "Saisissez un nom TLD, puis appuyez sur Entrée.";
		document.getElementById("modeling").textContent = "Un RDAPv2 peut éliminer les statuts indéterminés et être ccTLD-compatible en adoptant une nouvelle définition globale de table en snake_case.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Détail";
		document.getElementById("explanation").textContent = "Métadonnées TLD rationalisées utilisant un modèle à source unique pour éviter la redondance.";
		document.getElementById("notices_role").textContent = legacy;
		document.getElementById("links_role").textContent = legacy;		
		document.getElementById("common_root_services_url").textContent = proposed + "L’IANA gère pour l’ICANN les TLD et alloue les blocs IP ainsi que les numéros AS aux registres régionaux.";
		document.getElementById("common_root_zones_url").textContent = proposed + "Liste officielle des zones racines, gérée par l’IANA, l’autorité racine du DNS.";
		document.getElementById("common_lookup_endpoints_url").textContent = proposed + "Un endpoint API sous /v1/ peut supporter une version plus récente sous /v2/ — voir com.";
		document.getElementById("common_registrar_accreditations_url").textContent = proposed + "Liste officielle des bureaux d’enregistrement accrédités, gérée par l’IANA selon la politique de l’ICANN.";
		document.getElementById("common_tld_roles").textContent = proposed + "Ces noms de rôles sont provisoires. Ils peuvent changer.";
		document.getElementById("common_indeterminate_rdap_statuses").textContent = proposed + "Inadapté à l’automatisation, informatif seulement.";
		document.getElementById("common_best_practices_periods").textContent = proposed + "Les registres peuvent profiter de lignes directrices communes.";
		document.getElementById("common_root_accepted_workload").textContent = proposed + "Les serveurs IANA pourront appliquer des limites.";
		document.getElementById("root_zone_role").textContent = "Top-Level Domain (TLD)";
		document.getElementById("root_zone_data_active_from").textContent = proposed;
		document.getElementById("root_zone_tld_category").textContent = proposed + "Indique un TLD générique (gTLD) ou un TLD de code pays (ccTLD).";
		document.getElementById("root_zone_tld_type").textContent = proposed + "Le type de TLD, tel que gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD ou geoTLD.";
		document.getElementById("root_zone_tld_statuses").textContent = modified;
		document.getElementById("root_zone_tld_delegation_url").textContent = proposed + "URL référençant l'enregistrement de délégation de l'ICANN pour le TLD.";
		document.getElementById("root_zone_tld_json_response_url").textContent = proposed + "L'IANA peut passer à une base de données moderne pour les rôles et le cycle de vie.";
		document.getElementById("root_zone_tld_terms_of_service_url").textContent = proposed;
		document.getElementById("root_zone_tld_privacy_policy_url").textContent = proposed;		
		document.getElementById("root_zone_tld_menu_url").textContent = proposed + "Un menu d'informations spécifique au TLD, disponible sous un sous-domaine tel que 'regmenu'.";
		document.getElementById("root_zone_tld_search_engine_deletion_phase_ready").textContent = proposed + "Si les moteurs peuvent se fier à pending delete pour supprimer des résultats.";
		document.getElementById("root_zone_tld_contacts").textContent = proposed;
		document.getElementById("root_zone_zone_roles").textContent = proposed + "'Request-Driven': Le demandeur/TLD/le rôle nécessite une visibilité non groupée.";
		document.getElementById("root_zone_zone_accepted_workload").textContent = proposed + "Cette modélisation soutient la modernisation des tables de la base de données IANA.";
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_status_meanings").textContent = proposed + "Remarque : Une définition de table globale existe ; l’ICANN ne joue pas encore un rôle de premier plan.";
		document.getElementById("lifecycle_operational_periods").textContent = proposed + "Enregistrement pluriannuel parfois possible ; max. selon TLD et bureau d’enregistrement.";
		document.getElementById("name_servers_dnssec_signed").textContent = "DNSSEC sécurise le DNS contre le spoofing et l’empoisonnement.";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Les algorithmes 13, 14, 15 et 16 constituent la base recommandée pour la conformité DNSSEC.";
		document.getElementById("name_servers_ip").textContent = "Les adresses IP sont visibles si cela s’applique et sont également fournies dans le fichier RDAP.";
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
$html_text .= '<tr style="font-size: .8rem"><td id="title" style="font-size: 1.3rem;color:blue;font-weight:bold"></td><td id="instruction"></td><td id="modeling"></td></tr>';
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
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(31)">Common URLs +/-</button></td><td></td><td id="common_role"></td></tr>';
	$html_text .= '<tr id="311" style="display:table-row"><td>root_services_url</td><td><a href='.$data[$pd]['common']['root_services_url'].' target="_blank">Root Services</a></td><td id="common_root_services_url"></td></tr>';
	$html_text .= '<tr id="312" style="display:table-row"><td>root_zones_url</td><td><a href='.$data[$pd]['common']['root_zones_url'].' target="_blank">Root Zones</a></td><td id="common_root_zones_url"></td></tr>';
	$html_text .= '<tr id="313" style="display:table-row"><td>lookup_endpoints_url</td><td><a href='.$data[$pd]['common']['lookup_endpoints_url'].' target="_blank">Lookup Endpoints</a></td><td id="common_lookup_endpoints_url"></td></tr>';
	$html_text .= '<tr id="314" style="display:table-row"><td>registrar_accreditations_url</td><td><a href='.$data[$pd]['common']['registrar_accreditations_url'].' target="_blank">IANA Registrars</a></td><td id="common_registrar_accreditations_url"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(32)">Common roles +/-</button></td><td></td><td id="common_tld_roles"></td></tr>';
	$html_text .= '<tr id="321" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['common']['tld_roles'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(33)">Indeterminate RDAP statuses +/-</button></td><td></td><td id="common_indeterminate_rdap_statuses"></td></tr>';
	$html_text .= '<tr id="331" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['common']['indeterminate_rdap_statuses'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(34)">Best practices periods +/-</button></td><td></td><td id="common_best_practices_periods"></td></tr>';
	$html_text .= '<tr id="341" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['common']['best_practices_periods'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(35)">Root accepted workload +/-</button></td><td></td><td id="common_root_accepted_workload"></td></tr>';
	$html_text .= '<tr id="351" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['common']['root_accepted_workload'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(41)">Zone Information +/-</button></td><td><b>'.$vd.'</b></td><td id="root_zone_role"></td></tr>';
	$html_text .= '<tr id="411" style="display:table-row"><td>data_active_from</td><td> '.$data[$pd]['root_zone']['data_active_from'].'</td><td id="root_zone_data_active_from"></td></tr>';
	$html_text .= '<tr id="412" style="display:table-row"><td>tld_category</td><td>'.$data[$pd]['root_zone']['tld_category'].'</td><td id="root_zone_tld_category"></td></tr>';
	$html_text .= '<tr id="413" style="display:table-row"><td>tld_type</td><td>'.$data[$pd]['root_zone']['tld_type'].'</td><td id="root_zone_tld_type"></td></tr>';
	$html_text .= '<tr id="414" style="display:table-row"><td>tld_ascii_name</td><td>'.$data[$pd]['root_zone']['tld_ascii_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="415" style="display:table-row"><td>tld_unicode_name</td><td>'.$data[$pd]['root_zone']['tld_unicode_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="416" style="display:table-row"><td>tld_statuses</td><td> '.$data[$pd]['root_zone']['tld_statuses'].'</td><td id="root_zone_tld_statuses"></td></tr>';
	$html_text .= '<tr id="417" style="display:table-row"><td>tld_delegation_url</td><td><a href='.$data[$pd]['root_zone']['tld_delegation_url'].' target="_blank">TLD Delegation</a></td><td id="root_zone_tld_delegation_url"></td></tr>';
	$html_text .= '<tr id="418" style="display:table-row"><td>tld_json_response_url</td><td>'.((strlen($data[$pd]['root_zone']['tld_json_response_url'])) ? '<a href='.$data[$pd]['root_zone']['tld_json_response_url'].' target="_blank">TLD Data</a>' : '').'</td><td id="root_zone_tld_json_response_url"></td></tr>';
	$html_text .= '<tr id="419" style="display:table-row"><td>tld_terms_of_service_url</td><td>'.((strlen($data[$pd]['root_zone']['tld_terms_of_service_url'])) ? '<a href='.$data[$pd]['root_zone']['tld_terms_of_service_url'].' target="_blank">TLD Terms</a>' : '').'</td><td id="root_zone_tld_terms_of_service_url"></td></tr>';
	$html_text .= '<tr id="4110" style="display:table-row"><td>tld_privacy_policy_url</td><td>'.((strlen($data[$pd]['root_zone']['tld_privacy_policy_url'])) ? '<a href='.$data[$pd]['root_zone']['tld_privacy_policy_url'].' target="_blank">TLD Privacy</a>' : '').'</td><td id="root_zone_tld_privacy_policy_url"></td></tr>';
	$html_text .= '<tr id="4111" style="display:table-row"><td>tld_menu_url</td><td>'.((strlen($data[$pd]['root_zone']['tld_menu_url'])) ? '<a href='.$data[$pd]['root_zone']['tld_menu_url'].' target="_blank">TLD Menu</a>' : '').'</td><td id="root_zone_tld_menu_url"></td></tr>';
	$html_text .= '<tr  id="4112" style="display:table-row"><td>tld_search_engine_deletion_phase_ready</td><td>'.$data[$pd]['root_zone']['tld_search_engine_deletion_phase_ready'].'</td><td id="root_zone_tld_search_engine_deletion_phase_ready"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(42)">Zone contacts +/-</button></td><td></td><td id="root_zone_tld_contacts"></td></tr>';
	$html_text .= '<tr id="421" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['root_zone']['tld_contacts'].'</td><td id="root_zone_tld_contacts"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(43)">Zone roles +/-</button></td><td></td><td id="root_zone_zone_roles"></td></tr>';
	$html_text .= '<tr id="431" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['root_zone']['zone_roles'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(44)">Zone accepted workload +/-</button></td><td></td><td id="root_zone_zone_accepted_workload"></td></tr>';
	$html_text .= '<tr id="441" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['root_zone']['zone_accepted_workload'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';	
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(51)">Lifecycle information +/-</button></td><td><b>'.$vd.'</b></td><td id="lifecycle_role"></td></tr>';
	$html_text .= '<tr id="511" style="display:table-row"><td>data_active_from</td><td>'.$data[$pd]['lifecycle']['data_active_from'].'</td><td id="lifecycle_data_active_from"></td></tr>';
	$html_text .= '<tr id="512" style="display:table-row"><td>upon_termination</td><td>'.$data[$pd]['lifecycle']['upon_termination'].'</td><td id="lifecycle_upon_termination"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(52)">Status meanings +/-</button></td><td></td><td id="lifecycle_status_meanings"></td></tr>';
	$html_text .= '<tr id="521" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['lifecycle']['status_meanings'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(53)">Operational periods +/-</button></td><td></td><td id="lifecycle_operational_periods"></td></tr>';
	$html_text .= '<tr id="531" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['lifecycle']['operational_periods'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(61)">Name servers +/-</button></td><td><b>'.$vd.'</b></td><td></td></tr>';
	$html_text .= '<tr id="611" style="display:none;vertical-align:top"><td>handles</td><td colspan="2">'.$data[$pd]['name_servers']['handles'].'</td></tr>';
	$html_text .= '<tr id="612" style="display:none;vertical-align:top"><td>ascii_names</td><td colspan="2">'.$data[$pd]['name_servers']['ascii_names'].'</td></tr>';
	$html_text .= '<tr id="613" style="display:none;vertical-align:top"><td>unicode_names</td><td colspan="2">'.$data[$pd]['name_servers']['unicode_names'].'</td></tr>';
	$html_text .= '<tr id="614" style="display:none;vertical-align:top"><td>ipv4_addresses</td><td>'.$data[$pd]['name_servers']['ipv4_addresses'].'</td><td id="name_servers_ip"></td></tr>';
	$html_text .= '<tr id="615" style="display:none;vertical-align:top"><td>ipv6_addresses</td><td>'.$data[$pd]['name_servers']['ipv6_addresses'].'</td><td></td></tr>';
	$html_text .= '<tr id="616" style="display:none;vertical-align:top"><td>statuses</td><td>'.$data[$pd]['name_servers']['statuses'].'</td><td></td></tr>';
	$html_text .= '<tr id="617" style="display:none;vertical-align:top"><td>dnssec_signed</td><td>'.$data[$pd]['name_servers']['dnssec_signed'].'</td><td id="name_servers_dnssec_signed"></td></tr>';
	$html_text .= '<tr id="618" style="display:none;vertical-align:top"><td>dnssec_key_tag</td><td>'.$data[$pd]['name_servers']['dnssec_key_tag'].'</td><td></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>dnssec_algorithm</td><td>'.$data[$pd]['name_servers']['dnssec_algorithm'].'</td><td id="name_servers_dnssec_algorithm"></td></tr>';	
	$html_text .= '<tr id="619" style="display:none;vertical-align:top"><td>dnssec_digest_type</td><td>'.$data[$pd]['name_servers']['dnssec_digest_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="6110" style="display:none;vertical-align:top"><td>dnssec_digest</td><td colspan="2">'.$data[$pd]['name_servers']['dnssec_digest'].'</td></tr>';
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