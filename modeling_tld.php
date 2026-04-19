<?php
session_start();  // is needed with no PHP Generator Scriptcase
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="robots" content="index">
<title>TLD Information</title>';
?><script>
	
function SwitchDisplay(type) {
	if (type == 11)	{ // notices
		var pre = '11';
		var max = 1
	}
	else if (type == 12)	{ // links
		var pre = '12';
		var max = 1
	}
	else if (type == 31)	{ // common URIs
		var pre = '31';
		var max = 6
	}
	else if (type == 32)	{ // function identifiers
		var pre = '32';
		var max = 1
	}
	else if (type == 33)	{ // indeterminate RDAP statuses
		var pre = '33';
		var max = 1
	}
	else if (type == 34)	{ // lifecycle period ranges
		var pre = '34';
		var max = 1
	}
	else if (type == 35)	{ // root accepted workload
		var pre = '35';
		var max = 1
	}
	else if (type == 41)		{ // zone information
		var pre = '41';
		var max = 15
	}
	else if (type == 42)	{ // zone functions
		var pre = '42';
		var max = 1
	}
	else if (type == 43)	{ // zone relationships
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
	else if (type == 61)	{ // nameservers
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
		document.getElementById("title").textContent = "Top-Level Domain Information — IANA Data";
		document.getElementById("instruction").textContent = "Enter here:";
		document.getElementById("modeling").textContent = "";
		document.getElementById("field").textContent = "Modeled with snake_case";
		document.getElementById("explanation").textContent = "";
		document.getElementById("notices_part").textContent = legacy;
		document.getElementById("links_part").textContent = legacy;		
		document.getElementById("common_root_services_uri").textContent = proposed;
		document.getElementById("common_roots_uri").textContent = proposed;
		document.getElementById("common_root_terms_of_service_uri").textContent = proposed;
		document.getElementById("common_root_privacy_policy_uri").textContent = proposed;
		document.getElementById("common_lookup_endpoints_uri").textContent = proposed;
		document.getElementById("common_registrar_accreditations_uri").textContent = proposed;
		document.getElementById("common_function_identifiers").textContent = proposed;
		document.getElementById("common_indeterminate_rdap_statuses").textContent = proposed;
		document.getElementById("common_lifecycle_period_ranges").textContent = proposed;
		document.getElementById("common_root_accepted_workload").textContent = proposed;
		document.getElementById("zone_part").textContent = "";
		document.getElementById("zone_tld_data_active_from").textContent = proposed;
		document.getElementById("zone_tld_category").textContent = proposed;
		document.getElementById("zone_tld_type").textContent = proposed;
		document.getElementById("zone_tld_statuses").textContent = modified;
		document.getElementById("zone_tld_storage_model").textContent = proposed;
		document.getElementById("zone_tld_response_model").textContent = proposed;
		document.getElementById("zone_tld_services_uri").textContent = proposed;		
		document.getElementById("zone_tld_standardized_prices_uri").textContent = proposed;
		document.getElementById("zone_tld_delegation_uri").textContent = proposed;
		document.getElementById("zone_tld_json_response_uri").textContent = proposed;
		document.getElementById("zone_tld_terms_of_service_uri").textContent = proposed;
		document.getElementById("zone_tld_privacy_policy_uri").textContent = proposed;
		document.getElementById("zone_tld_search_engine_deletion_phase_ready").textContent = proposed;
		document.getElementById("zone_tld_functions").textContent = proposed;
		document.getElementById("zone_tld_accepted_workload").textContent = proposed;
		document.getElementById("zone_tld_relationships").textContent = proposed;
		document.getElementById("lifecycle_part").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_status_meanings").textContent = proposed;
		document.getElementById("lifecycle_operational_periods").textContent = proposed;
		document.getElementById("nameservers_rdap_dnssec_signed").textContent = "";
		document.getElementById("nameservers_rdap_ds_algorithms").textContent = "";
		document.getElementById("nameservers_ip").textContent = "";
	}
	else if (translation == 1)	{
		var modified = '(Gewijzigd) ';
		var proposed = '(Nieuw) ';
		var legacy = '(Legacy) ';
		document.getElementById("title").textContent = "Top-leveldomeininformatie — IANA-gegevens";
		document.getElementById("instruction").textContent = "Geef hier in:";
		document.getElementById("modeling").textContent = "Een RDAPv2 kan onbepaalde statussen elimineren en ccTLD-proof zijn via een nieuwe globale tabeldefinitie in snake_case.";
		document.getElementById("field").textContent = "Gemodelleerd met snake_case";
		document.getElementById("explanation").textContent = "Gestroomlijnde TLD-metadata met een centraal model om redundantie te voorkomen.";
		document.getElementById("notices_part").textContent = legacy;
		document.getElementById("links_part").textContent = legacy;
		document.getElementById("common_root_services_uri").textContent = proposed + "IANA beheert, voor ICANN, TLD’s en wijst IP-blokken en AS-nummers toe aan regionale registries.";
		document.getElementById("common_roots_uri").textContent = proposed + 'Officiële Root Zones-lijst, beheerd door IANA, de DNS-rootautoriteit.';
		document.getElementById("common_root_terms_of_service_uri").textContent = proposed;
		document.getElementById("common_root_privacy_policy_uri").textContent = proposed;
		document.getElementById("common_lookup_endpoints_uri").textContent = proposed + "Een API-endpoint onder /v1/ kan een nieuwere versie onder /v2/ ondersteunen — zie com.";
		document.getElementById("common_registrar_accreditations_uri").textContent = proposed + "Officiële lijst van geaccrediteerde registrars, beheerd door IANA onder ICANN-beleid.";
		document.getElementById("common_function_identifiers").textContent = proposed + "Deze functiebenamingen zijn voorlopig. Ze kunnen nog veranderen.";
		document.getElementById("common_indeterminate_rdap_statuses").textContent = proposed + "Ongeschikt voor automatisering, alleen informatief.";
		document.getElementById("common_lifecycle_period_ranges").textContent = proposed + "Registries kunnen baat hebben bij gedeelde richtlijnen.";
		document.getElementById("common_root_accepted_workload").textContent = proposed + "IANA-servers kunnen in de toekomst limieten toepassen.";
		document.getElementById("zone_part").textContent = "Top-Level Domain (TLD)";
		document.getElementById("zone_tld_data_active_from").textContent = proposed;
		document.getElementById("zone_tld_category").textContent = proposed + 'Geeft een generieke TLD (gTLD) of een landcode-TLD (ccTLD) aan.';
		document.getElementById("zone_tld_type").textContent = proposed + 'Het TLD-type, bijvoorbeeld gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD of geoTLD.';
		document.getElementById("zone_tld_statuses").textContent = modified;
		document.getElementById("zone_tld_storage_model").textContent = proposed + "Opslagmodel voor TLD-domeingegevens (thin of thick).";
		document.getElementById("zone_tld_response_model").textContent = proposed + "RDAP-responsmodel voor domeingegevens (thin, delegated of thick).";
		document.getElementById("zone_tld_services_uri").textContent = proposed + 'Een TLD-specifiek informatiemenu, beschikbaar onder een subdomein zoals "regmenu".';
		document.getElementById("zone_tld_standardized_prices_uri").textContent = proposed + "De EU kan prijstransparantie baseren op een machineleesbare technische basis.";
		document.getElementById("zone_tld_delegation_uri").textContent = proposed + 'URI die verwijst naar het ICANN-delegatierecord voor de TLD.';
		document.getElementById("zone_tld_json_response_uri").textContent = proposed + "TLD-metadata, mogelijk afkomstig uit gemoderniseerde IANA-datadiensten.";
		document.getElementById("zone_tld_terms_of_service_uri").textContent = proposed;
		document.getElementById("zone_tld_privacy_policy_uri").textContent = proposed;
		document.getElementById("zone_tld_search_engine_deletion_phase_ready").textContent = proposed + 'Of zoekmachines op pending delete mogen vertrouwen om resultaten te wissen.';
		document.getElementById("zone_tld_functions").textContent = proposed;
		document.getElementById("zone_tld_accepted_workload").textContent = proposed + "Deze modellering ondersteunt de modernisering van IANA-databasetabellen.";
		document.getElementById("zone_tld_relationships").textContent = proposed;
		document.getElementById("lifecycle_part").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_status_meanings").textContent = proposed + "Let op: Er bestaat een globale tabeldefinitie; ICANN speelt nog geen leidende rol.";
		document.getElementById("lifecycle_operational_periods").textContent = proposed + 'Meerjarige registratie soms mogelijk; max. verschilt per TLD en registrar.';
		document.getElementById("nameservers_rdap_dnssec_signed").textContent = "DNSSEC beveiligt DNS tegen spoofing en cachevergiftiging.";
		document.getElementById("nameservers_rdap_ds_algorithms").textContent = "Algoritmen 13–16 zijn actueel. IANA voert algoritme 8 als RECOMMENDED, geldt als uitlopend.";
		document.getElementById("nameservers_ip").textContent = "IP-adressen zijn zichtbaar indien van toepassing en ook opgenomen in het RDAP-bestand.";
	}
	else if (translation == 2)	{
		var modified = '(Modified) ';
		var proposed = '(New) ';
		var legacy = '(Legacy) ';		
		document.getElementById("title").textContent = "Top-Level Domain Information — IANA Data";
		document.getElementById("instruction").textContent = "Enter here:";
		document.getElementById("modeling").textContent = "An RDAPv2 can eliminate indeterminate statuses and be ccTLD-proof via a new global table definition in snake_case.";
		document.getElementById("field").textContent = "Modeled with snake_case";
		document.getElementById("explanation").textContent = "Streamlined TLD metadata using a single-source model to prevent redundancy.";
		document.getElementById("notices_part").textContent = legacy;
		document.getElementById("links_part").textContent = legacy;		
		document.getElementById("common_root_services_uri").textContent = proposed + "IANA manages, for ICANN, TLDs and allocates IP blocks and AS numbers to regional registries.";
		document.getElementById("common_roots_uri").textContent = proposed + 'Official Root Zones list maintained by IANA, the DNS root authority.';
		document.getElementById("common_root_terms_of_service_uri").textContent = proposed;
		document.getElementById("common_root_privacy_policy_uri").textContent = proposed;		
		document.getElementById("common_lookup_endpoints_uri").textContent = proposed + "An API endpoint under /v1/ may support a newer version under /v2/ — as seen on com.";
		document.getElementById("common_registrar_accreditations_uri").textContent = proposed + "Official list of accredited registrars maintained by IANA under ICANN policy.";
		document.getElementById("common_function_identifiers").textContent = proposed + "These function names are draft. They may change.";
		document.getElementById("common_indeterminate_rdap_statuses").textContent = proposed + "Unsuitable for automation, informational only.";
		document.getElementById("common_lifecycle_period_ranges").textContent = proposed + "Registries may benefit from shared timing guidelines.";
		document.getElementById("common_root_accepted_workload").textContent = proposed + "IANA servers may apply limits in the future.";
		document.getElementById("zone_part").textContent = "Top-Level Domain (TLD)";
		document.getElementById("zone_tld_data_active_from").textContent = proposed;
		document.getElementById("zone_tld_category").textContent = proposed + 'Indicates generic TLD (gTLD) or a country-code TLD (ccTLD).';
		document.getElementById("zone_tld_type").textContent = proposed + 'The TLD type, such as gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD, or geoTLD.';
		document.getElementById("zone_tld_statuses").textContent = modified;
		document.getElementById("zone_tld_storage_model").textContent = proposed + "Storage model for TLD domain data (thin or thick).";
		document.getElementById("zone_tld_response_model").textContent = proposed + "RDAP response model for domain data (thin, delegated or thick).";		
		document.getElementById("zone_tld_services_uri").textContent = proposed + 'A TLD specific information menu, available under a subdomain such as "regmenu".';
		document.getElementById("zone_tld_standardized_prices_uri").textContent = proposed + "The EU may base pricing transparency on a machine-readable technical foundation.";
		document.getElementById("zone_tld_delegation_uri").textContent = proposed + 'URI pointing to the ICANN delegation record for the TLD.';
		document.getElementById("zone_tld_json_response_uri").textContent = proposed + "TLD metadata, potentially derived from modernized IANA data services.";
		document.getElementById("zone_tld_terms_of_service_uri").textContent = proposed;
		document.getElementById("zone_tld_privacy_policy_uri").textContent = proposed;		
		document.getElementById("zone_tld_search_engine_deletion_phase_ready").textContent = proposed + 'If search engines may rely on pending delete to delete results.';
		document.getElementById("zone_tld_functions").textContent = proposed;
		document.getElementById("zone_tld_accepted_workload").textContent = proposed + "This modeling supports IANA database table modernization efforts.";
		document.getElementById("zone_tld_relationships").textContent = proposed;
		document.getElementById("lifecycle_part").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;	
		document.getElementById("lifecycle_status_meanings").textContent = proposed + "Note: A global table definition exists; ICANN is not yet in a leading role.";
		document.getElementById("lifecycle_operational_periods").textContent = proposed + 'Multi-year registration sometimes possible; max varies by TLD & registrar.';
		document.getElementById("nameservers_rdap_dnssec_signed").textContent = "DNSSEC secures DNS against spoofing and cache poisoning.";
		document.getElementById("nameservers_rdap_ds_algorithms").textContent = "Algorithms 13–16 are current. IANA lists algorithm 8 as RECOMMENDED, considered phasing out.";
		document.getElementById("nameservers_ip").textContent = "IP addresses are visible if applicable and also included in the RDAP file.";
	}
	else if (translation == 3)	{
		var modified = '(Geändert) ';
		var proposed = '(Neu) ';
		var legacy = '(Legacy) ';		
		document.getElementById("title").textContent = "Top-Level-Domain-Informationen — IANA-Daten";
		document.getElementById("instruction").textContent = "Hier eingeben:";
		document.getElementById("modeling").textContent = "Ein RDAPv2 kann unbestimmte Statuswerte eliminieren und ccTLD-sicher sein durch eine neue globale Tabellendefinition in snake_case.";
		document.getElementById("field").textContent = "Modelliert mit snake_case";
		document.getElementById("explanation").textContent = "Schlanke TLD-Metadaten mit einem Single-Source-Modell zur Vermeidung von Redundanz.";
		document.getElementById("notices_part").textContent = legacy;
		document.getElementById("links_part").textContent = legacy;		
		document.getElementById("common_root_services_uri").textContent = proposed + "IANA verwaltet, für ICANN, TLDs und weist IP-Blöcke sowie AS-Nummern an regionale Registries zu.";
		document.getElementById("common_roots_uri").textContent = proposed + 'Offizielle Root-Zonenliste, verwaltet von IANA, der DNS-Root-Behörde.';
		document.getElementById("common_root_terms_of_service_uri").textContent = proposed;
		document.getElementById("common_root_privacy_policy_uri").textContent = proposed;		
		document.getElementById("common_lookup_endpoints_uri").textContent = proposed + "Ein API-Endpunkt unter /v1/ kann eine neuere Version unter /v2/ unterstützen — siehe com.";
		document.getElementById("common_registrar_accreditations_uri").textContent = proposed + "Offizielle Liste der akkreditierten Registrar, verwaltet von IANA unter ICANN-Richtlinien.";
		document.getElementById("common_function_identifiers").textContent = proposed + "Diese Funktionsnamen sind vorläufig und können sich ändern.";
		document.getElementById("common_indeterminate_rdap_statuses").textContent = proposed + "Ungeeignet für Automatisierung, nur informativ.";
		document.getElementById("common_lifecycle_period_ranges").textContent = proposed + "Viele Registries können von gemeinsamen Regeln profitieren.";
		document.getElementById("common_root_accepted_workload").textContent = proposed + "IANA kann zukünftig Limits festlegen.";
		document.getElementById("zone_part").textContent = "Top-Level Domain (TLD)";
		document.getElementById("zone_tld_data_active_from").textContent = proposed;
		document.getElementById("zone_tld_json_response_uri").textContent = proposed + "TLD-Metadaten, möglicherweise aus modernisierten IANA-Datendiensten abgeleitet.";
		document.getElementById("zone_tld_category").textContent = proposed + 'Zeigt eine generische TLD (gTLD) oder eine länderspezifische TLD (ccTLD) an.';
		document.getElementById("zone_tld_type").textContent = proposed + 'Der TLD-Typ, z. B. gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD oder geoTLD.';
		document.getElementById("zone_tld_statuses").textContent = modified;
		document.getElementById("zone_tld_storage_model").textContent = proposed + "Speichermodell für TLD-Domaindaten (thin oder thick).";
		document.getElementById("zone_tld_response_model").textContent = proposed + "RDAP-Antwortmodell für Domaindaten (thin, delegated oder thick).";		
		document.getElementById("zone_tld_services_uri").textContent = proposed + 'Ein TLD-spezifisches Informationsmenü, verfügbar unter einer Subdomäne wie "regmenu".';
		document.getElementById("zone_tld_standardized_prices_uri").textContent = proposed + "Die EU könnte Preistransparenz auf einer maschinenlesbaren technischen Grundlage aufbauen.";
		document.getElementById("zone_tld_delegation_uri").textContent = proposed + 'URI mit Verweis auf den ICANN-Delegationsdatensatz für die TLD.';
		document.getElementById("zone_tld_terms_of_service_uri").textContent = proposed;
		document.getElementById("zone_tld_privacy_policy_uri").textContent = proposed;		
		document.getElementById("zone_tld_search_engine_deletion_phase_ready").textContent = proposed + 'Ob Suchmaschinen auf Pending Delete vertrauen dürfen, um Ergebnisse zu löschen.';
		document.getElementById("zone_tld_functions").textContent = proposed;
		document.getElementById("zone_tld_accepted_workload").textContent = proposed + "Dieses Modell unterstützt die Modernisierung der IANA-Datenbanktabellen.";
		document.getElementById("zone_tld_relationships").textContent = proposed;
		document.getElementById("lifecycle_part").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_status_meanings").textContent = proposed + "Hinweis: Eine globale Tabellendefinition existiert; ICANN übernimmt noch keine führende Rolle.";
		document.getElementById("lifecycle_operational_periods").textContent = proposed + 'Mehrjährige Registrierung teils möglich; max. variiert je nach TLD und Registrar.';
		document.getElementById("nameservers_rdap_dnssec_signed").textContent = "DNSSEC sichert DNS gegen Spoofing und Cache-Poisoning.";
		document.getElementById("nameservers_rdap_ds_algorithms").textContent = "Algorithmen 13–16 sind aktuell. IANA führt Algorithmus 8 als RECOMMENDED, gilt als auslaufend.";
		document.getElementById("nameservers_ip").textContent = "IP-Adressen sind sichtbar, sofern zutreffend, und auch in der RDAP-Datei enthalten.";
	}
	else if (translation == 4)	{
		var modified = '(Modifié) ';
		var proposed = '(Nouveau) ';
		var legacy = '(Legacy) ';		
		document.getElementById("title").textContent = "Informations des domaines de premier niveau — Données IANA";
		document.getElementById("instruction").textContent = "Saisissez ici :";
		document.getElementById("modeling").textContent = "Un RDAPv2 peut éliminer les statuts indéterminés et être ccTLD-compatible en adoptant une nouvelle définition globale de table en snake_case.";
		document.getElementById("field").textContent = "Modélisé en snake_case";
		document.getElementById("explanation").textContent = "Métadonnées TLD rationalisées utilisant un modèle à source unique pour éviter la redondance.";
		document.getElementById("notices_part").textContent = legacy;
		document.getElementById("links_part").textContent = legacy;		
		document.getElementById("common_root_services_uri").textContent = proposed + "L’IANA gère pour l’ICANN les TLD et alloue les blocs IP ainsi que les numéros AS aux registres régionaux.";
		document.getElementById("common_roots_uri").textContent = proposed + "Liste officielle des zones racines, gérée par l’IANA, l’autorité racine du DNS.";
		document.getElementById("common_root_terms_of_service_uri").textContent = proposed;
		document.getElementById("common_root_privacy_policy_uri").textContent = proposed;
		document.getElementById("common_lookup_endpoints_uri").textContent = proposed + "Un endpoint API sous /v1/ peut supporter une version plus récente sous /v2/ — voir com.";
		document.getElementById("common_registrar_accreditations_uri").textContent = proposed + "Liste officielle des bureaux d’enregistrement accrédités, gérée par l’IANA selon la politique de l’ICANN.";
		document.getElementById("common_function_identifiers").textContent = proposed + "Ces noms de fonctions sont provisoires. Ils peuvent changer.";
		document.getElementById("common_indeterminate_rdap_statuses").textContent = proposed + "Inadapté à l’automatisation, informatif seulement.";
		document.getElementById("common_lifecycle_period_ranges").textContent = proposed + "Les registres peuvent profiter de lignes directrices communes.";
		document.getElementById("common_root_accepted_workload").textContent = proposed + "Les serveurs IANA pourront appliquer des limites.";
		document.getElementById("zone_part").textContent = "Top-Level Domain (TLD)";
		document.getElementById("zone_tld_data_active_from").textContent = proposed;
		document.getElementById("zone_tld_category").textContent = proposed + "Indique un TLD générique (gTLD) ou un TLD de code pays (ccTLD).";
		document.getElementById("zone_tld_type").textContent = proposed + "Le type de TLD, tel que gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD ou geoTLD.";
		document.getElementById("zone_tld_statuses").textContent = modified;
		document.getElementById("zone_tld_storage_model").textContent = proposed + "Mode de stockage des données de domaine du TLD (thin ou thick).";
		document.getElementById("zone_tld_response_model").textContent = proposed + "Mode de réponse RDAP pour les données de domaine (thin, delegated ou thick).";
		document.getElementById("zone_tld_services_uri").textContent = proposed + "Un menu d'informations spécifique au TLD, disponible sous un sous-domaine tel que 'regmenu'.";
		document.getElementById("zone_tld_standardized_prices_uri").textContent = proposed + "L’UE pourrait fonder la transparence des prix sur une base technique lisible par machine.";
		document.getElementById("zone_tld_delegation_uri").textContent = proposed + "URI référençant l'enregistrement de délégation de l'ICANN pour le TLD.";
		document.getElementById("zone_tld_json_response_uri").textContent = proposed + "Métadonnées du TLD, éventuellement issues de services de données IANA modernisés.";
		document.getElementById("zone_tld_terms_of_service_uri").textContent = proposed;
		document.getElementById("zone_tld_privacy_policy_uri").textContent = proposed;		
		document.getElementById("zone_tld_search_engine_deletion_phase_ready").textContent = proposed + "Si les moteurs peuvent se fier à pending delete pour supprimer des résultats.";
		document.getElementById("zone_tld_functions").textContent = proposed;
		document.getElementById("zone_tld_accepted_workload").textContent = proposed + "Cette modélisation soutient la modernisation des tables de la base de données IANA.";
		document.getElementById("zone_tld_relationships").textContent = proposed;
		document.getElementById("lifecycle_part").textContent = proposed;
		document.getElementById("lifecycle_data_active_from").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("lifecycle_status_meanings").textContent = proposed + "Remarque : Une définition de table globale existe ; l’ICANN ne joue pas encore un rôle de premier plan.";
		document.getElementById("lifecycle_operational_periods").textContent = proposed + "Enregistrement pluriannuel parfois possible ; max. selon TLD et bureau d’enregistrement.";
		document.getElementById("nameservers_rdap_dnssec_signed").textContent = "DNSSEC sécurise le DNS contre le spoofing et l’empoisonnement.";
		document.getElementById("nameservers_rdap_ds_algorithms").textContent = "Les algorithmes 13–16 sont actuels. L’IANA classe l’algorithme 8 comme RECOMMENDED, en fin de vie.";
		document.getElementById("nameservers_ip").textContent = "Les adresses IP sont visibles si cela s’applique et sont également fournies dans le fichier RDAP.";
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
$server_uri = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
$server_uri .= '://'. $_SERVER['HTTP_HOST'];
$server_uri .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);	
$server_uri = dirname($server_uri);
$rdap_uri = $server_uri.'/compose_tld/index.php?tld='.$pd;
if (@get_headers($rdap_uri))	{ // the application to compose data
	$json = file_get_contents($rdap_uri) or die("An entered tld could not be read.");
	$data = json_decode($json, true);
}
if	(is_null($data))	{
	$reopen = $server_uri.'/modeling_tld/index.php?tld=tld';
	sc_redir($reopen);
}
$html_text = '<body onload=SwitchTranslation('.$viewlanguage.')><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem; table-layout: fixed; width:1375px">
<tr><th style="width:325px"></th><th style="width:300px"></th><th style="width:750px"></th></tr>';
$html_text .= '<tr style="font-size: .8rem"><td colspan="2" id="title" style="font-size: 1.4rem;color:blue;font-weight:bold"></td><td id="modeling"></td></tr>';
$html_text .= '<tr style="font-size: .8rem"><td id="instruction" style="vertical-align:middle; text-align: right"></td><td><form action='.htmlentities($_SERVER['PHP_SELF']).' method="get">
	<input type="hidden" id="language" name="language" value='.$viewlanguage.'>	
	<input type="text" style="width:90%" id="tld" name="tld" value='.$vd.'></form></td><td>
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(99)">None</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(1)">nl_NL</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(2)">en_US</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(3)">de_DE</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(4)">fr_FR</button> 
	<a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_menu" target="_blank">Menu modeling</a> - <a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap.hostingtool.nl" target="_blank">Code/issues on GitHub</a> - <a style="font-size: 0.9rem" href="https://janwillemstegink.nl/" target="_blank">Insight at janwillemstegink.nl</a></td></tr>';
if (true or $pd == mb_strtolower($data[$pd]['domain']['ascii_name']) or empty($data[$pd]['domain']['ascii_name']))	{
	$html_text .= '<tr style="font-size:1.05rem;font-weight:bold"><td id="field"></td><td>iana_rdap_service</td><td id="explanation"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(11)">Notices +/-</button><td></td><td id="notices_part"></td></tr>';
	$html_text .= '<tr id="111" style="display:none;vertical-align:top"><td colspan="3">'.$data[$pd]['notices'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(12)">Links +/-</button><td></td><td id="links_part"></td></tr>';
	$html_text .= '<tr id="121" style="display:none;vertical-align:top"><td colspan="3">'.$data[$pd]['links'].'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(31)">Common URIs +/-</button></td><td></td><td id="common_part"></td></tr>';
	$html_text .= '<tr id="311" style="display:table-row"><td>root_services_uri</td><td><a href='.$data[$pd]['common']['root_services_uri'].' target="_blank">Root Services</a></td><td id="common_root_services_uri"></td></tr>';
	$html_text .= '<tr id="312" style="display:table-row"><td>roots_uri</td><td><a href='.$data[$pd]['common']['roots_uri'].' target="_blank">Root Zones</a></td><td id="common_roots_uri"></td></tr>';
	$html_text .= '<tr id="313" style="display:table-row"><td>root_terms_of_service_uri</td><td>'.((!empty($data[$pd]['common']['root_terms_of_service_uri'])) ? '<a href='.$data[$pd]['common']['root_terms_of_service_uri'].' target="_blank">Root Terms</a>' : '').'</td><td id="common_root_terms_of_service_uri"></td></tr>';
	$html_text .= '<tr id="314" style="display:table-row"><td>root_privacy_policy_uri</td><td>'.((!empty($data[$pd]['common']['root_privacy_policy_uri'])) ? '<a href='.$data[$pd]['common']['root_privacy_policy_uri'].' target="_blank">Root Privacy</a>' : '').'</td><td id="common_root_privacy_policy_uri"></td></tr>';
	$html_text .= '<tr id="315" style="display:table-row"><td>lookup_endpoints_uri</td><td><a href='.$data[$pd]['common']['lookup_endpoints_uri'].' target="_blank">Lookup Endpoints</a></td><td id="common_lookup_endpoints_uri"></td></tr>';
	$html_text .= '<tr id="316" style="display:table-row"><td>registrar_accreditations_uri</td><td><a href='.$data[$pd]['common']['registrar_accreditations_uri'].' target="_blank">IANA Registrars</a></td><td id="common_registrar_accreditations_uri"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(32)">Function Identifiers +/-</button></td><td></td><td id="common_function_identifiers"></td></tr>';
	$html_text .= '<tr id="321" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['common']['function_identifiers'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(33)">Indeterminate RDAP Statuses +/-</button></td><td></td><td id="common_indeterminate_rdap_statuses"></td></tr>';
	$html_text .= '<tr id="331" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['common']['indeterminate_rdap_statuses'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(34)">Lifecycle Period Ranges +/-</button></td><td></td><td id="common_lifecycle_period_ranges"></td></tr>';
	$html_text .= '<tr id="341" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['common']['lifecycle_period_ranges'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(35)">Root Accepted Workload +/-</button></td><td></td><td id="common_root_accepted_workload"></td></tr>';
	$html_text .= '<tr id="351" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['common']['root_accepted_workload'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(41)">TLD Information +/-</button></td><td><b>'.$vd.'</b></td><td id="zone_part"></td></tr>';
	$html_text .= '<tr id="411" style="display:table-row"><td>tld_data_active_from</td><td> '.$data[$pd]['zone']['tld_data_active_from'].'</td><td id="zone_tld_data_active_from"></td></tr>';
	$html_text .= '<tr id="412" style="display:table-row"><td>tld_category</td><td>'.$data[$pd]['zone']['tld_category'].'</td><td id="zone_tld_category"></td></tr>';
	$html_text .= '<tr id="413" style="display:table-row"><td>tld_type</td><td>'.$data[$pd]['zone']['tld_type'].'</td><td id="zone_tld_type"></td></tr>';
	$html_text .= '<tr id="414" style="display:table-row"><td>tld_ascii_name</td><td>'.$data[$pd]['zone']['tld_ascii_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="415" style="display:table-row"><td>tld_unicode_name</td><td>'.$data[$pd]['zone']['tld_unicode_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="416" style="display:table-row"><td>tld_statuses</td><td> '.$data[$pd]['zone']['tld_statuses'].'</td><td id="zone_tld_statuses"></td></tr>';
	$html_text .= '<tr id="417" style="display:table-row"><td>tld_storage_model</td><td> '.$data[$pd]['zone']['tld_storage_model'].'</td><td id="zone_tld_storage_model"></td></tr>';
	$html_text .= '<tr id="418" style="display:table-row"><td>tld_response_model</td><td> '.$data[$pd]['zone']['tld_response_model'].'</td><td id="zone_tld_response_model"></td></tr>';
	$html_text .= '<tr id="419" style="display:table-row"><td>tld_services_uri</td><td>'.((!empty($data[$pd]['zone']['tld_services_uri'])) ? '<a href='.$data[$pd]['zone']['tld_services_uri'].' target="_blank">TLD Services</a>' : '').'</td><td id="zone_tld_services_uri"></td></tr>';
	$html_text .= '<tr id="4110" style="display:table-row"><td>tld_standardized_prices_uri</td><td>'.((!empty($data[$pd]['zone']['tld_standardized_prices_uri'])) ? '<a href='.$data[$pd]['zone']['tld_standardized_prices_uri'].' target="_blank">TLD Prices</a>' : '').'</td><td id="zone_tld_standardized_prices_uri"></td></tr>';
	$html_text .= '<tr id="4111" style="display:table-row"><td>tld_delegation_uri</td><td><a href='.$data[$pd]['zone']['tld_delegation_uri'].' target="_blank">TLD Delegation</a></td><td id="zone_tld_delegation_uri"></td></tr>';
	$html_text .= '<tr id="4112" style="display:table-row"><td>tld_json_response_uri</td><td>'.((!empty($data[$pd]['zone']['tld_json_response_uri'])) ? '<a href='.$data[$pd]['zone']['tld_json_response_uri'].' target="_blank">TLD Data</a>' : '').'</td><td id="zone_tld_json_response_uri"></td></tr>';
	$html_text .= '<tr id="4113" style="display:table-row"><td>tld_terms_of_service_uri</td><td>'.((!empty($data[$pd]['zone']['tld_terms_of_service_uri'])) ? '<a href='.$data[$pd]['zone']['tld_terms_of_service_uri'].' target="_blank">TLD Terms</a>' : '').'</td><td id="zone_tld_terms_of_service_uri"></td></tr>';
	$html_text .= '<tr id="4114" style="display:table-row"><td>tld_privacy_policy_uri</td><td>'.((!empty($data[$pd]['zone']['tld_privacy_policy_uri'])) ? '<a href='.$data[$pd]['zone']['tld_privacy_policy_uri'].' target="_blank">TLD Privacy</a>' : '').'</td><td id="zone_tld_privacy_policy_uri"></td></tr>';
	$html_text .= '<tr  id="4115" style="display:table-row"><td>tld_search_engine_deletion_phase_ready</td><td>'.$data[$pd]['zone']['tld_search_engine_deletion_phase_ready'].'</td><td id="zone_tld_search_engine_deletion_phase_ready"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(42)">Functions +/-</button></td><td></td><td id="zone_tld_functions"></td></tr>';
	$html_text .= '<tr id="421" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['zone']['tld_functions'].'</td><td id="zone_tld_functions"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(44)">Accepted Workload +/-</button></td><td></td><td id="zone_tld_accepted_workload"></td></tr>';
	$html_text .= '<tr id="441" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['zone']['tld_accepted_workload'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(43)">Relationships +/-</button></td><td></td><td id="zone_tld_relationships"></td></tr>';
	$html_text .= '<tr id="431" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['zone']['tld_relationships'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';	
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(51)">Lifecycle Information +/-</button></td><td><b>'.$vd.'</b></td><td id="lifecycle_part"></td></tr>';
	$html_text .= '<tr id="511" style="display:table-row"><td>data_active_from</td><td>'.$data[$pd]['lifecycle']['data_active_from'].'</td><td id="lifecycle_data_active_from"></td></tr>';
	$html_text .= '<tr id="512" style="display:table-row"><td>upon_termination</td><td>'.$data[$pd]['lifecycle']['upon_termination'].'</td><td id="lifecycle_upon_termination"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(52)">Status Meanings +/-</button></td><td></td><td id="lifecycle_status_meanings"></td></tr>';
	$html_text .= '<tr id="521" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['lifecycle']['status_meanings'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(53)">Operational Periods +/-</button></td><td></td><td id="lifecycle_operational_periods"></td></tr>';
	$html_text .= '<tr id="531" style="display:none;vertical-align:top"><td colspan="2">'.$data[$pd]['lifecycle']['operational_periods'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(61)">Nameservers +/-</button></td><td><b>'.$vd.'</b></td><td></td></tr>';
	$html_text .= '<tr id="611" style="display:none;vertical-align:top"><td>handles</td><td colspan="2">'.$data[$pd]['nameservers']['handles'].'</td></tr>';
	$html_text .= '<tr id="612" style="display:none;vertical-align:top"><td>ascii_names</td><td colspan="2">'.$data[$pd]['nameservers']['ascii_names'].'</td></tr>';
	$html_text .= '<tr id="613" style="display:none;vertical-align:top"><td>unicode_names</td><td colspan="2">'.$data[$pd]['nameservers']['unicode_names'].'</td></tr>';
	$html_text .= '<tr id="614" style="display:none;vertical-align:top"><td>ipv4_addresses</td><td>'.$data[$pd]['nameservers']['ipv4_addresses'].'</td><td id="nameservers_ip"></td></tr>';
	$html_text .= '<tr id="615" style="display:none;vertical-align:top"><td>ipv6_addresses</td><td>'.$data[$pd]['nameservers']['ipv6_addresses'].'</td><td></td></tr>';
	$html_text .= '<tr id="616" style="display:none;vertical-align:top"><td>statuses</td><td>'.$data[$pd]['nameservers']['statuses'].'</td><td></td></tr>';
	$html_text .= '<tr id="617" style="display:none;vertical-align:top"><td>rdap_dnssec_signed</td><td>'.$data[$pd]['nameservers']['rdap_dnssec_signed'].'</td><td id="nameservers_rdap_dnssec_signed"></td></tr>';
	$html_text .= '<tr id="618" style="display:none;vertical-align:top"><td>rdap_ds_key_tags</td><td>'.$data[$pd]['nameservers']['rdap_ds_key_tags'].'</td><td></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>rdap_ds_algorithms</td><td>'.$data[$pd]['nameservers']['rdap_ds_algorithms'].'</td><td id="nameservers_rdap_ds_algorithms"></td></tr>';	
	$html_text .= '<tr id="619" style="display:none;vertical-align:top"><td>rdap_ds_digest_types</td><td>'.$data[$pd]['nameservers']['rdap_ds_digest_types'].'</td><td></td></tr>';
	$html_text .= '<tr id="6110" style="display:none;vertical-align:top"><td>rdap_ds_digests</td><td colspan="2">'.$data[$pd]['nameservers']['rdap_ds_digests'].'</td></tr>';
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
    $rdap_uri = "https://rdap.db.ripe.net/ip/".$ip;
    $response = @file_get_contents($rdap_uri);
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
	return (!empty($country)) ? $country . '; ' . $orgName : $orgName;	
}	
?>