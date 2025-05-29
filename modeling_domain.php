<?php
session_start();  // is needed with no Scriptcase PHP Generator
$datetime = new DateTime('now', new DateTimeZone('UTC'));
$utc = $datetime->format('Y-m-d H:i:s');
if (!empty($_GET['domain']))	{
	$vd = $_GET['domain'];
	$vd = mb_strtolower($vd);
	$vd = str_replace('http://','', $vd);
	$vd = str_replace('https://','', $vd);
	if (substr_count($domain, '.') > 1)	{
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
	$vd = 'hostingtool.nl';
}	
if (empty([ip]) or empty([block]))	{
	[ip] = getClientIP();
	[block] = get_block([ip]);
}
$log_file = "/home/admin/logging/domain_lookup_tool_" . date("Ym") . ".txt";
$log_line = $datetime->format('Y-m-d H:i:s') . " UTC, " . $vd . ", " . [ip] . ", " . [block] . "\n";
file_put_contents($log_file, $log_line, FILE_APPEND);
echo '<!DOCTYPE html><html lang="en" style="font-size: 90%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>Domain Information</title>';
?><script>
	
function SwitchDisplay(type) {
	if (type == 10)			{ // root zone
		var pre = '10';
		var max = 13
	}
	else if (type == 11)	{ // notice 0
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
	else if (type == 28)	{ // life cycle
		var pre = '28';
		var max = 7
	}
	else if (type == 29)	{ // meta
		var pre = '29';
		var max = 9
	}
	else if (type == 30)	{ // domain
		var pre = '30';
		var max = 12
	}
	else if (type == 35)	{ // abuse
		var pre = '35';
		var max = 8
	}
	else if (type == 39)	{ // sponsor
		var pre = '39';
		var max = 25
	}
	else if (type == 40)	{ // registrant
		var pre = '40';
		var max = 20
	}
	else if (type == 41)	{ // administrative
		var pre = '41';
		var max = 19
	}
	else if (type == 42)	{ // technical
		var pre = '42';
		var max = 19
	}
	else if (type == 43)	{ // billing
		var pre = '43';
		var max = 20
	}
	else if (type == 44)	{ // emergency
		var pre = '44';
		var max = 20
	}
	else if (type == 50)	{ // reseller
		var pre = '50';
		var max = 22
	}	
	else if (type == 60)	{ // registrar
		var pre = '60';
		var max = 22
	}
	else if (type == 63)	{ // name servers
		var pre = '63';
		var max = 7
	}
	else if (type == 70)	{ // raw whois data
		var pre = '70';
		var max = 1
	}
	else if (type == 75)	{ // raw rdap data
		var pre = '75';
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
	if (translation == 0)	{
		var modified = '';
		var proposed = '';
		var address = '';
		var accessible = '';
		document.getElementById("title").textContent = "Domain Information";
		document.getElementById("subtitle").textContent = "RDAP-v1-based modeling";
		document.getElementById("instruction").textContent = "Fill in and press Enter to retrieve.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "";
		document.getElementById("root_zone_role").textContent = proposed;
		document.getElementById("root_zone_root_zones_url").textContent = proposed;
		document.getElementById("root_zone_delegation_url").textContent = proposed;
		document.getElementById("root_zone_tld_category").textContent = proposed;
		document.getElementById("root_zone_tld_type").textContent = proposed;
		document.getElementById("root_zone_sponsoring_organization_name").textContent = proposed;
		document.getElementById("root_zone_country_code_designated_manager").textContent = proposed;
		document.getElementById("root_zone_registry_operator_organization_name").textContent = proposed;
		document.getElementById("root_zone_registry_operator_presented_name").textContent = proposed;
		document.getElementById("root_zone_backend_operator_organization_name").textContent = proposed;
		document.getElementById("root_zone_backend_operator_presented_name").textContent = proposed;
		document.getElementById("root_zone_language_codes").textContent = modified;
		document.getElementById("root_zone_restrictions_url").textContent = proposed;
		document.getElementById("root_zone_menu_url").textContent = proposed;
		document.getElementById("notices_role").textContent = "";
		document.getElementById("links_role").textContent = "";		
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_max_subscription_period_years").textContent = proposed;
		document.getElementById("lifecycle_add_period_days").textContent = proposed;
		document.getElementById("lifecycle_renew_period_days").textContent = proposed;
		document.getElementById("lifecycle_auto_renew_period_days").textContent = proposed;		
		document.getElementById("lifecycle_redemption_period_days").textContent = proposed;
		document.getElementById("lifecycle_deletion_phase_days").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("metadata_role").textContent = proposed;
		document.getElementById("metadata_lookup_endpoints_url").textContent = proposed;
		document.getElementById("metadata_resource_upload_at").textContent = modified;
		document.getElementById("metadata_object_class_name").textContent = modified;
		document.getElementById("metadata_object_conformance").textContent = modified;		
		document.getElementById("metadata_registry_source").textContent = modified;
		document.getElementById("metadata_accredited_registrars_url").textContent = proposed;
		document.getElementById("metadata_registrar_source").textContent = proposed;
		document.getElementById("metadata_registrar_complaint_url").textContent = proposed;
		document.getElementById("metadata_status_explanation_url").textContent = proposed;
		document.getElementById("domain_role").textContent = "";
		document.getElementById("domain_ascii_name").textContent = "";
		document.getElementById("domain_unicode_name").textContent = "";
		document.getElementById("domain_statuses_registry").textContent = "";
		document.getElementById("domain_statuses_registrar").textContent = modified;
		document.getElementById("domain_accredited_registrar").textContent = modified;
		document.getElementById("domain_created_at").textContent = "";
		document.getElementById("domain_expiration_at").textContent = "";
		document.getElementById("domain_recovery_deadline").textContent = proposed;
		document.getElementById("domain_deletion_at").textContent = "";
		document.getElementById("domain_extensions").textContent = "";
		document.getElementById("abuse_role").textContent = "";
		document.getElementById("abuse_shielding").textContent = proposed;
		document.getElementById("abuse_telephone").textContent = "";		
		document.getElementById("sponsor_role").textContent = "";
		document.getElementById("registrant_role").textContent = "";
		document.getElementById("registrant_shielding").textContent = proposed;
		document.getElementById("registrant_handle").textContent = "";
		document.getElementById("registrant_web_id").textContent = proposed;
		document.getElementById("registrant_organization_type").textContent = "";
		document.getElementById("registrant_organization_name").textContent = "";
		document.getElementById("registrant_presented_name").textContent = "";
		document.getElementById("registrant_kind").textContent = "";
		document.getElementById("registrant_name").textContent = "";
		document.getElementById("registrant_country_code").textContent = "";
		document.getElementById("registrant_street_address").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;
		document.getElementById("registrant_country_name").textContent = "";
		document.getElementById("registrant_verification_received_at").textContent = proposed;
		document.getElementById("registrant_verification_set_at").textContent = proposed;
		document.getElementById("administrative_role").textContent = "";
		document.getElementById("administrative_shielding").textContent = proposed;
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_role").textContent = "";
		document.getElementById("technical_shielding").textContent = proposed;
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_role").textContent = "";
		document.getElementById("billing_shielding").textContent = proposed;
		document.getElementById("emergency_role").textContent = "";
		document.getElementById("emergency_shielding").textContent = proposed;
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("reseller_role").textContent = "";
		document.getElementById("reseller_shielding").textContent = proposed;
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;
		document.getElementById("registrar_role").textContent = "";
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;
		document.getElementById("name_servers_dnssec").textContent = "";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "";
		document.getElementById("name_servers_ip").textContent = "";
		document.getElementById("br_zone").textContent = "";
		document.getElementById("raw_data_next").textContent = "";
	}
	else if (translation == 1)	{
		var modified = '(Gewijzigd) ';
		var proposed = '(Nieuw) ';
		var address = "Het afschermen van adresgegevens zoals bij example.tel, resulteert in rommelige gegevens.";
		var accessible = 'De voorgestelde velden verbeteren de bruikbaarheid en verhogen de transparantie van RDAP.';
		document.getElementById("title").textContent = "Domeininformatie";
		document.getElementById("subtitle").textContent = "RDAP-v1-gebaseerde modellering";
		document.getElementById("instruction").textContent = "Typ een domeinnaam en druk op Enter.";
		document.getElementById("field").textContent = "Omschrijving";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Een overzicht en toelichting op de structuur en kenmerken van webdomeinen.";
		document.getElementById("root_zone_role").textContent = proposed + "Top-Level Domain (TLD)";
		document.getElementById("root_zone_root_zones_url").textContent = proposed + 'Een verwijzing naar de officiële lijst met Root Zones.';
		document.getElementById("root_zone_delegation_url").textContent = proposed + 'URL die verwijst naar het ICANN-delegatierecord voor de TLD.';
		document.getElementById("root_zone_tld_category").textContent = proposed + 'Geeft een generieke TLD (gTLD) of een landcode-TLD (ccTLD) aan.';
		document.getElementById("root_zone_tld_type").textContent = proposed + 'Geeft een lijst van TLD-typen weer, zoals gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD en geoTLD.';
		document.getElementById("root_zone_sponsoring_organization_name").textContent = proposed + 'Definieert de geschiktheid en communityregels voor de TLD.';
		document.getElementById("root_zone_country_code_designated_manager").textContent = proposed + "ccTLD-beheerders zijn niet noodzakelijkerwijs gebonden aan internationale normen.";
		document.getElementById("root_zone_registry_operator_organization_name").textContent = proposed + 'De juridische naam van de organisatie die verantwoordelijk is voor de registratieactiviteiten.';
		document.getElementById("root_zone_registry_operator_presented_name").textContent = proposed;
		document.getElementById("root_zone_backend_operator_organization_name").textContent = proposed + 'De backend-operator verzorgt de technische infrastructuur van de TLD.';
		document.getElementById("root_zone_backend_operator_presented_name").textContent = proposed;
		document.getElementById("root_zone_language_codes").textContent = modified + "Geeft ondersteunde talen voor de Root Zone aan.";	
		document.getElementById("root_zone_restrictions_url").textContent = proposed + "Beperkingen op gebruik en registratiebeleid zijn te vinden via deze URL.";
		document.getElementById("root_zone_menu_url").textContent = proposed + 'Een TLD-specifiek informatiemenu, beschikbaar onder een subdomein zoals "regmenu".';
		document.getElementById("notices_role").textContent = accessible;
		document.getElementById("links_role").textContent = accessible;
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_max_subscription_period_years").textContent = proposed;
		document.getElementById("lifecycle_add_period_days").textContent = proposed;
		document.getElementById("lifecycle_renew_period_days").textContent = proposed;
		document.getElementById("lifecycle_auto_renew_period_days").textContent = proposed;
		document.getElementById("lifecycle_redemption_period_days").textContent = proposed;
		document.getElementById("lifecycle_deletion_phase_days").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;			
		document.getElementById("metadata_role").textContent = proposed;
		document.getElementById("metadata_lookup_endpoints_url").textContent = proposed + "Een folder /v1/ ondersteunt ook mogelijke /v2/-responses; zie icann.com.";
		document.getElementById("metadata_resource_upload_at").textContent = modified + "Datum en tijdstip van de RDAP-database-update in Zoeloe-tijd (UTC).";
		document.getElementById("metadata_object_class_name").textContent = modified;
		document.getElementById("metadata_object_conformance").textContent = modified;		
		document.getElementById("metadata_registry_source").textContent = modified + "Gepland: Web-ID-zoekopdrachten op wereldwijde RDAP-servers.";
		document.getElementById("metadata_accredited_registrars_url").textContent = proposed;
		document.getElementById("metadata_registrar_source").textContent = proposed + 'Er is geen registrarbron-URL opgenomen in het huidige RDAP v1-antwoord.';
		document.getElementById("metadata_registrar_complaint_url").textContent = proposed + 'Vereist als de registrar IANA-geaccrediteerd is; wordt gebruikt om klachten van gebruikers door te sturen.';		
		document.getElementById("metadata_status_explanation_url").textContent = proposed + 'Vereist als de registrar IANA-geaccrediteerd is; bevat uitleg over de statuscode.';
		document.getElementById("domain_role").textContent = "Een domein onder TLD-niveau is wereldwijd uniek en kan vrij worden gekozen onder bepaalde regels.";
		document.getElementById("domain_ascii_name").textContent = "Voor speciale tekens bevatten de ASCII-tekenreeksen Punycode-transcriptie.";
		document.getElementById("domain_unicode_name").textContent = "Hoewel de informatie verduidelijkt, is de unicode-domeinnaam optioneel binnen het RDAP-protocol.";
		document.getElementById("domain_statuses_registry").textContent = "De status 'redemption period' biedt de mogelijkheid tot herstel. Met 'pending delete' wordt de verwijdering definitief.";
		document.getElementById("domain_statuses_registrar").textContent = modified;
		document.getElementById("domain_accredited_registrar").textContent = modified + "Een IANA-registraraccreditatie-ID voor gTLD's moet correct zijn.";
		document.getElementById("domain_created_at").textContent = "De datumvelden staan hier in een logische volgorde. Dit is ook eenvoudig in de JSON-array.";
		document.getElementById("domain_expiration_at").textContent = "Datum en tijdstip van periodieke verlenging of stopzetting van de publicatie.";
		document.getElementById("domain_recovery_deadline").textContent = proposed + "Herstel is mogelijk tot 'domain_expiration_at' plus 'redemption_period_days'.";		
		document.getElementById("domain_deletion_at").textContent = "Datum en tijdstip gepland voor volledige verwijdering. Er kan een laatste verwijderingsfase zijn.";
		document.getElementById("domain_extensions").textContent = "'Eligibility': Hoe een domein voldoet aan een specifieke vereiste in een topleveldomeinzone.";
		document.getElementById("abuse_role").textContent = "Informatie over hoe een derde partij contact kan opnemen met de registrar of belaste partij. Zie fryslan.frl.";
		document.getElementById("abuse_shielding").textContent = proposed;
		document.getElementById("abuse_telephone").textContent = "Een telefoonnummer moet beginnen met het type. Toegestaan zijn in ieder geval 'voice' en 'fax'.";		
		document.getElementById("sponsor_role").textContent = "De domeinregistratie kan worden beheerd door een sponsor. Zie bijvoorbeeld france.fr.";
		document.getElementById("registrant_role").textContent = "De domeingebruiker die de daadwerkelijke of effectieve controle heeft voor domeinrecht in het land van vestiging.";
		document.getElementById("registrant_shielding").textContent = proposed + "Een 'Request-Driven' waarde. Aanvrager/TLD/rol vereisen een niet-geclusterde zichtbaarheid.";
		document.getElementById("registrant_handle").textContent = 'De uitvoer van "hostingtool.nl" bevat onbedoeld informatie met "STE135427-TRAIP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Webidentificatienummer voor bedrijfsentiteiten en natuurlijke personen.";
		document.getElementById("registrant_organization_type").textContent = 'De gebruikelijke waarde is "work", of mogelijk "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "De juridische naam van de organisatie die primair verantwoordelijk is voor het domeinabonnement.";
		document.getElementById("registrant_presented_name").textContent = "Geldig is de naam van een primair verantwoordelijke persoon of een rol binnen de organisatie.";
		document.getElementById("registrant_kind").textContent = "Leeg / 'org' / 'individual' (Voor continuïteit: levenstestament + testament + digitale executeur)";
		document.getElementById("registrant_name").textContent = "Een persoonlijke naam kan openbaar zichtbaar zijn in het veld 'presented_name'. Zie bijvoorbeeld circa.ca.";
		document.getElementById("registrant_country_code").textContent = "De ISO-2-landcode-indexering werkt, bijvoorbeeld voor het Verenigd Koninkrijk, dat de EU heeft verlaten.";
		document.getElementById("registrant_street_address").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;
		document.getElementById("registrant_country_name").textContent = "Een openbaar zichtbare landnaam is beperkt tot een 'Registrar Lookup via RDAP'.";
		document.getElementById("registrant_verification_received_at").textContent = proposed + "Na identificatie kan een overeenkomende web-ID worden bevestigd, leeg is intrekking.";
		document.getElementById("registrant_verification_set_at").textContent = proposed + "Vervolgens verifieert de registry de gegevens bij de landspecifieke webdomeindienst.";
		document.getElementById("administrative_role").textContent = "Het administratief aanspreekpunt beantwoordt een verzoek en stuurt zo nodig door.";
		document.getElementById("administrative_shielding").textContent = proposed;
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_role").textContent = "Een technisch contact reageert om een gemelde storing op te lossen.";
		document.getElementById("technical_shielding").textContent = proposed;
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_role").textContent = "Sommige domain registries houden gegevens bij om hun facturering uit te voeren.";
		document.getElementById("billing_shielding").textContent = proposed;
		document.getElementById("emergency_role").textContent = proposed + "Een verantwoordelijke persoon kan de benodigde toegang verlenen.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_shielding").textContent = proposed;
		document.getElementById("reseller_role").textContent = "De domeinreseller is als tweede verantwoordelijk, ook afhankelijk van de overeenkomst en de regelgeving.";
		document.getElementById("reseller_shielding").textContent = proposed;
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;
		document.getElementById("registrar_role").textContent = "De domeinregistrar is verantwoordelijk voor domeinreserveringen en IP-adresroutering.";
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_web_id").textContent = proposed
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;		
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is een web-route-beveiligingsvoorziening op het DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Een DNSSEC-algoritme vanaf versie 13 is up-to-date.";
		document.getElementById("name_servers_ip").textContent = "IP-waarden in een glue record alleen als de nameservers van de registrar niet worden gebruikt.";
		document.getElementById("br_zone").textContent = "TLD .br: De RDAP-gegevens zijn aangepast met nameservervalidatie.";
		document.getElementById("raw_data_next").textContent = "De rollen zijn hier gerangschikt op verantwoordelijkheid. 'None Specified' komt van deze tool. Een JSON-structuur kan ook zo leesbaar zijn als XML.";
	}
	else if (translation == 2)	{
		var modified = '(Modified) ';
		var proposed = '(New) ';
		var address = "Shielding address data as with example.tel, results in messy data.";
		var accessible = 'The proposed fields improve usability and increase transparency of RDAP.';
		document.getElementById("title").textContent = "Domain Information";
		document.getElementById("subtitle").textContent = "RDAP-v1-based modeling";
		document.getElementById("instruction").textContent = "Type a domain, then press Enter.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "An overview of the structure and key characteristics of domain data.";		
		document.getElementById("root_zone_role").textContent = proposed + "Top-Level Domain (TLD)";
		document.getElementById("root_zone_root_zones_url").textContent = proposed + 'A reference to the official list of Root Zones.';
		document.getElementById("root_zone_delegation_url").textContent = proposed + 'URL pointing to the ICANN delegation record for the TLD.';
		document.getElementById("root_zone_tld_category").textContent = proposed + 'Indicates generic TLD (gTLD) or a country-code TLD (ccTLD).';
		document.getElementById("root_zone_tld_type").textContent = proposed + 'Lists TLD types such as gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD, and geoTLD.';
		document.getElementById("root_zone_sponsoring_organization_name").textContent = proposed + 'Defines eligibility and community rules for the TLD.';
		document.getElementById("root_zone_country_code_designated_manager").textContent = proposed + 'ccTLD managers are not necessarily bound by international standards.';
		document.getElementById("root_zone_registry_operator_organization_name").textContent = proposed + 'The legal name of the organization responsible for registration activities.';
		document.getElementById("root_zone_registry_operator_presented_name").textContent = proposed;
		document.getElementById("root_zone_backend_operator_organization_name").textContent = proposed + 'The backend operator manages the technical infrastructure of the TLD.';
		document.getElementById("root_zone_backend_operator_presented_name").textContent = proposed;
		document.getElementById("root_zone_language_codes").textContent = modified + "Indicates supported languages for the Root Zone.";
		document.getElementById("root_zone_restrictions_url").textContent = proposed + "Usage and registration restrictions are listed at this URL.";
		document.getElementById("root_zone_menu_url").textContent = proposed + 'A TLD specific information menu, available under a subdomain such as "regmenu".';
		document.getElementById("notices_role").textContent = accessible;
		document.getElementById("links_role").textContent = accessible;
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_max_subscription_period_years").textContent = proposed;
		document.getElementById("lifecycle_add_period_days").textContent = proposed;
		document.getElementById("lifecycle_renew_period_days").textContent = proposed;
		document.getElementById("lifecycle_auto_renew_period_days").textContent = proposed;		
		document.getElementById("lifecycle_redemption_period_days").textContent = proposed;
		document.getElementById("lifecycle_deletion_phase_days").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;		
		document.getElementById("metadata_role").textContent = proposed;
		document.getElementById("metadata_lookup_endpoints_url").textContent = proposed + "A /v1/ folder may also support /v2/ responses — see icann.com for details.";
		document.getElementById("metadata_resource_upload_at").textContent = modified + "Date and time of RDAP database update in Zulu time (UTC).";
		document.getElementById("metadata_object_class_name").textContent = modified;
		document.getElementById("metadata_object_conformance").textContent = modified;		
		document.getElementById("metadata_registry_source").textContent = modified + "Planned: Web ID searches on global RDAP servers.";
		document.getElementById("metadata_accredited_registrars_url").textContent = proposed;
		document.getElementById("metadata_registrar_source").textContent = proposed + 'No registrar source URL is included in the current RDAP v1 response.';
		document.getElementById("metadata_registrar_complaint_url").textContent = proposed + 'Required for IANA-accredited registrars; used to direct user complaints.';		
		document.getElementById("metadata_status_explanation_url").textContent = proposed + 'Required if the registrar is IANA-accredited; provides status code explanations.';
		document.getElementById("domain_role").textContent = "A domain below TLD level is globally unique and can be freely chosen under certain rules.";
		document.getElementById("domain_ascii_name").textContent = "For special characters, the ASCII character strings contain Punycode transcription.";
		document.getElementById("domain_unicode_name").textContent = "Although information clarifies, the unicode domain name is optional within the RDAP protocol.";
		document.getElementById("domain_statuses_registry").textContent = "Status 'redemption period' allows for recovery. With 'pending delete' deletion becomes final.";
		document.getElementById("domain_statuses_registrar").textContent = modified;
		document.getElementById("domain_accredited_registrar").textContent = modified + "The IANA registrar accreditation ID for gTLDs must be accurate.";
		document.getElementById("domain_created_at").textContent = "The date fields are here in a logical order. This is also easy in the JSON array.";
		document.getElementById("domain_expiration_at").textContent = "Date and time of periodic renewal or discontinuation of publication.";
		document.getElementById("domain_recovery_deadline").textContent = proposed + "Recovery is possible up to the 'domain_expiration_at' plus 'redemption_period_days'.";
		document.getElementById("domain_deletion_at").textContent = "Date and time scheduled for complete deletion. A final deletion phase may exist.";
		document.getElementById("domain_extensions").textContent = "'Eligibility': How a domain fulfills a specific requirement in a top-level domain root zone.";
		document.getElementById("abuse_role").textContent = "Information on how a third party can contact the registrar or entrusted party. See fryslan.frl.";
		document.getElementById("abuse_shielding").textContent = proposed;
		document.getElementById("abuse_telephone").textContent = "A telephone number must begin with the type. Allowed are anyway 'voice' and 'fax'.";
		document.getElementById("sponsor_role").textContent = "The domain registration can be managed by a sponsor. See for example france.fr.";
		document.getElementById("registrant_role").textContent = "The domain user who has the actual or effective control for domain rights in the country of establishment.";
		document.getElementById("registrant_handle").textContent = 'The output from "hostingtool.nl" unintentionally contains information with "STE135427-TRAIP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Web Identification number for business entities and natural persons.";
		document.getElementById("registrant_organization_type").textContent = 'The usual value is "work", or possibly "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "The legal name of the organization primarily responsible for the domain subscription.";
		document.getElementById("registrant_presented_name").textContent = "Valid is the name of a primarily responsible person or a role within the organization.";
		document.getElementById("registrant_kind").textContent = "Empty / 'org' / 'individual' (For continuity: Living Will + Will + Digital Executor)";
		document.getElementById("registrant_name").textContent = "A personal name may be publicly visible in the 'presented_name' field. See for example circa.ca.";
		document.getElementById("registrant_country_code").textContent = "ISO-2 country code indexing works, as for the United Kingdom, which has left the EU.";
		document.getElementById("registrant_street_address").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;		
		document.getElementById("registrant_country_name").textContent = "A publicly visible country name is limited to a 'Registrar Lookup via RDAP'.";
		document.getElementById("registrant_shielding").textContent = proposed + "A Request-Driven value. Requester/TLD/role require an unclustered visibility.";
		document.getElementById("registrant_verification_received_at").textContent = proposed + "After identification, a matching web ID can be confirmed, empty is revocation.";
		document.getElementById("registrant_verification_set_at").textContent = proposed + "The registry then verifies the data with the country-specific web domain service.";	
		document.getElementById("administrative_role").textContent = "The administratively responsible desk answers a request, and forwards on if necessary.";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("administrative_shielding").textContent = proposed;
		document.getElementById("technical_role").textContent = "A technical contact responds to resolve a reported malfunction.";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("technical_shielding").textContent = proposed;
		document.getElementById("billing_role").textContent = "Some domain registries maintain records to perform their billing.";
		document.getElementById("billing_shielding").textContent = proposed;
		document.getElementById("emergency_role").textContent = proposed + "A responsible person can provide the necessary access.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_shielding").textContent = proposed;
		document.getElementById("reseller_role").textContent = "The domain reseller is secondly responsible, also depending on the agreement and regulations.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_shielding").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;		
		document.getElementById("registrar_role").textContent = "The domain registrar is responsible for domain reservations and IP address routing.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;		
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is a web route security feature on the DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "A DNSSEC algorithm starting from version 13 is up-to-date.";
		document.getElementById("name_servers_ip").textContent = "IP values in a glue record only if the registrar's name servers are not used.";
		document.getElementById("br_zone").textContent = "TLD .br: The RDAP data has been modified with name server validation.";
		document.getElementById("raw_data_next").textContent = "The roles here are arranged according to responsibility. 'None Specified' comes from this tool. A JSON structure can also be as readable as XML.";
	}
	else if (translation == 3)	{
		var modified = '(Geändert) ';
		var proposed = '(Neu) ';
		var address = "Das Abschirmen von Adressdaten wie bei example.tel, führt zu unordentlichen Daten.";
		var accessible = 'Die vorgeschlagenen Felder verbessern die Benutzerfreundlichkeit und erhöhen die Transparenz von RDAP.';
		document.getElementById("title").textContent = "Domaininformationen";
		document.getElementById("subtitle").textContent = "RDAP-v1-basierte Modellierung";
		document.getElementById("instruction").textContent = "Geben Sie eine Domain ein und drücken Sie Enter.";
		document.getElementById("field").textContent = "Beschreibung";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Eine Übersicht und Erklärung zur Struktur und den Eigenschaften von Webdomänen.";		
		document.getElementById("root_zone_role").textContent = proposed + "Top-Level Domain (TLD)";
		document.getElementById("root_zone_root_zones_url").textContent = proposed + 'Ein Verweis auf die offizielle Liste der Root-Zones.';	
		document.getElementById("root_zone_delegation_url").textContent = proposed + 'URL mit Verweis auf den ICANN-Delegationsdatensatz für die TLD.';
		document.getElementById("root_zone_tld_category").textContent = proposed + 'Zeigt eine generische TLD (gTLD) oder eine länderspezifische TLD (ccTLD) an.';
		document.getElementById("root_zone_tld_type").textContent = proposed + 'Listet TLD-Typen wie gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD und geoTLD auf.';
		document.getElementById("root_zone_sponsoring_organization_name").textContent = proposed + 'Definiert die Berechtigung und Community-Regeln für die TLD.';
		document.getElementById("root_zone_country_code_designated_manager").textContent = proposed + 'ccTLD-Manager sind nicht unbedingt an internationale Standards gebunden.';
		document.getElementById("root_zone_registry_operator_organization_name").textContent = proposed + 'Der offizielle Name der Organisation, die für die Registrierungsaktivitäten verantwortlich ist.';
		document.getElementById("root_zone_registry_operator_presented_name").textContent = proposed;
		document.getElementById("root_zone_backend_operator_organization_name").textContent = proposed + 'Der Backend-Betreiber verwaltet die technische Infrastruktur der TLD.';
		document.getElementById("root_zone_backend_operator_presented_name").textContent = proposed;
		document.getElementById("root_zone_language_codes").textContent = modified + "Gibt die unterstützten Sprachen der Root-Zone an.";
		document.getElementById("root_zone_restrictions_url").textContent = proposed + "Nutzungsbeschränkungen und Registrierungsrichtlinien finden Sie unter dieser URL.";		
		document.getElementById("root_zone_menu_url").textContent = proposed + 'Ein TLD-spezifisches Informationsmenü, verfügbar unter einer Subdomäne wie "regmenu".';
		document.getElementById("notices_role").textContent = accessible;
		document.getElementById("links_role").textContent = accessible;
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_max_subscription_period_years").textContent = proposed;
		document.getElementById("lifecycle_add_period_days").textContent = proposed;
		document.getElementById("lifecycle_renew_period_days").textContent = proposed;
		document.getElementById("lifecycle_auto_renew_period_days").textContent = proposed;		
		document.getElementById("lifecycle_redemption_period_days").textContent = proposed;
		document.getElementById("lifecycle_deletion_phase_days").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("metadata_role").textContent = proposed;
		document.getElementById("metadata_lookup_endpoints_url").textContent = proposed + "Ein /v1/-Ordner unterstützt auch mögliche /v2/-Antworten; siehe icann.com.";
		document.getElementById("metadata_resource_upload_at").textContent = modified + "Datum und Uhrzeit der RDAP-Datenbankaktualisierung in Zulu-Zeit (UTC).";
		document.getElementById("metadata_object_class_name").textContent = modified;
		document.getElementById("metadata_object_conformance").textContent = modified;		
		document.getElementById("metadata_registry_source").textContent = modified + "Geplant: Web-ID-Suchen auf globalen RDAP-Servern.";
		document.getElementById("metadata_accredited_registrars_url").textContent = proposed;
		document.getElementById("metadata_registrar_source").textContent = proposed + 'Eine Registrar-Quell-URL ist in der aktuellen RDAP v1-Antwort nicht enthalten.';
		document.getElementById("metadata_registrar_complaint_url").textContent = proposed + 'Erforderlich, wenn der Registrar IANA-akkreditiert ist; wird verwendet, um Benutzerbeschwerden weiterzuleiten.';
		document.getElementById("metadata_status_explanation_url").textContent = proposed + 'Erforderlich, wenn der Registrar IANA-akkreditiert ist; bietet Erklärungen zum Statuscode.';
		document.getElementById("domain_role").textContent = "Eine Domain unterhalb der TLD-Ebene ist weltweit eindeutig und kann unter bestimmten Regeln frei gewählt werden.";
		document.getElementById("domain_ascii_name").textContent = "Für Sonderzeichen enthalten die ASCII-Zeichenfolgen eine Punycode-Transkription.";
		document.getElementById("domain_unicode_name").textContent = "Obwohl die Informationen klarstellen, ist der Unicode-Domänenname innerhalb des RDAP-Protokolls optional.";
		document.getElementById("domain_statuses_registry").textContent = "Der Status 'redemption period' ermöglicht eine Wiederherstellung. Mit 'pending delete' wird die Löschung endgültig.";
		document.getElementById("domain_statuses_registrar").textContent = modified;
		document.getElementById("domain_accredited_registrar").textContent = modified + "Eine IANA-Registrar-Akkreditierungs-ID für gTLDs muss korrekt sein.";
		document.getElementById("domain_created_at").textContent = "Die Datumsfelder stehen hier in einer logischen Reihenfolge. Auch dies ist im JSON-Array einfach.";
		document.getElementById("domain_expiration_at").textContent = "Datum und Uhrzeit der periodischen Erneuerung oder Einstellung der Veröffentlichung.";
		document.getElementById("domain_recovery_deadline").textContent = proposed + "Eine Wiederherstellung ist bis zum Ablaufdatum plus den Tagen der Einlösungsfrist möglich.";
		document.getElementById("domain_deletion_at").textContent = "Datum und Uhrzeit für die vollständige Löschung geplant. Es kann eine abschließende Löschphase geben.";
		document.getElementById("domain_extensions").textContent = "'Eligibility': Wie eine Domäne eine bestimmte Anforderung in einer Top-Level-Domänenzone erfüllt.";
		document.getElementById("abuse_role").textContent = "Informationen darüber, wie Dritte den Registrar oder die beauftragte Partei kontaktieren können. Siehe fryslan.frl.";
		document.getElementById("abuse_shielding").textContent = proposed;
		document.getElementById("abuse_telephone").textContent = "Eine Telefonnummer muss mit dem Typ beginnen. Erlaubt sind grundsätzlich 'voice' und 'fax'.";
		document.getElementById("sponsor_role").textContent = "Die Domänenregistrierung kann von einem Sponsor verwaltet werden. Siehe beispielsweise france.fr.";
		document.getElementById("registrant_role").textContent = "Der Domänenbenutzer, der die tatsächliche oder effektive Kontrolle hat für Domainrechte im Wohnsitzland.";
		document.getElementById("registrant_shielding").textContent = proposed + "Ein 'Request-Driven' Wert. Anforderer/TLD/Rolle erfordern eine nicht gruppierte Sichtbarkeit.";
		document.getElementById("registrant_handle").textContent = 'Die Ausgabe von "hostingtool.nl" enthält unbeabsichtigt Informationen mit "STE135427-TRAIP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Web-Identifikationsnummer für Unternehmen und natürliche Personen.";
		document.getElementById("registrant_organization_type").textContent = 'Der übliche Wert ist "work" oder möglicherweise "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "Der offizielle Name der Organisation, die hauptsächlich für das Domänenabonnement verantwortlich ist.";
		document.getElementById("registrant_presented_name").textContent = "Gültig ist der Name einer hauptverantwortlichen Person oder einer Rolle innerhalb der Organisation.";
		document.getElementById("registrant_kind").textContent = "Leer / 'org' / 'individual' (Für Kontinuität: Patientenverfügung + Testament + digitaler Testamentsvollstrecker)";
		document.getElementById("registrant_name").textContent = "Ein Personenname kann im Feld 'presented_name' öffentlich sichtbar sei. Siehe beispielsweise circa.ca.";
		document.getElementById("registrant_country_code").textContent = "Die Indizierung mit dem ISO-2-Ländercode funktioniert, wie für das Vereinigte Königreich, das die EU verlassen hat.";
		document.getElementById("registrant_street_address").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;		
		document.getElementById("registrant_country_name").textContent = "Ein öffentlich sichtbarer Ländername ist auf eine 'Registrar Lookup via RDAP' beschränkt.";
		document.getElementById("registrant_verification_received_at").textContent = proposed + "Nach der Identifizierung kann eine passende Web-ID bestätigt werden, leer ist der Widerruf.";
		document.getElementById("registrant_verification_set_at").textContent = proposed + "Anschließend verifiziert die Registry die Daten beim länderspezifischen Webdomänendienst.";
		document.getElementById("administrative_role").textContent = "Die administrativ zuständige Stelle beantwortet eine Anfrage und leitet sie gegebenenfalls weiter.";
		document.getElementById("administrative_shielding").textContent = proposed;
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_role").textContent = "Ein technischer Kontakt reagiert, um eine gemeldete Störung zu beheben.";
		document.getElementById("technical_shielding").textContent = proposed;
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_role").textContent = "Einige Domänenregistrierungen führen Aufzeichnungen, um ihre Abrechnung durchzuführen.";
		document.getElementById("billing_shielding").textContent = proposed;
		document.getElementById("emergency_role").textContent = proposed + "Die erforderlichen Zugänge kann eine verantwortliche Person bereitstellen.";
		document.getElementById("emergency_shielding").textContent = proposed;
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("reseller_role").textContent = "In zweiter Linie ist der Domain-Reseller, ebenfalls je nach Vereinbarung und Regelungen, verantwortlich.";
		document.getElementById("reseller_shielding").textContent = proposed;
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;		
		document.getElementById("registrar_role").textContent = "Der Domänenregistrar ist für die Domänenreservierung und das IP-Adressrouting verantwortlich.";
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;		
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC ist eine Sicherheitsfunktion für Webrouten im DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Ein DNSSEC-Algorithmus ab Version 13 ist auf dem neuesten Stand.";
		document.getElementById("name_servers_ip").textContent = "IP-Werte in einem Glue-Record nur, wenn die Nameserver des Registrars nicht verwendet werden.";
		document.getElementById("br_zone").textContent = "TLD .br: Die RDAP-Daten wurden mit der Nameserver-Validierung angepasst.";
		document.getElementById("raw_data_next").textContent = "Die Rollen sind hierbei nach Verantwortung verteilt. 'None Specified' stammt von diesem Tool. Eine JSON-Struktur kann auch genauso lesbar sein wie XML.";
	}
	else if (translation == 4)	{
		var modified = '(Modifié) ';
		var proposed = '(Nouveau) ';
		var address = "Le blindage des données d'adresse comme avec example.tel, génère des données désordonnées.";
		var accessible = "Les champs proposés améliorent la convivialité et augmentent la transparence du RDAP.";
		document.getElementById("title").textContent = "Informations sur le domaine";
		document.getElementById("subtitle").textContent = "Modélisation basée sur RDAP-v1";
		document.getElementById("instruction").textContent = "Saisissez un nom de domaine, puis appuyez sur Entrée.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Détail";
		document.getElementById("explanation").textContent = "Un aperçu et une explication de la structure et des caractéristiques des domaines Web.";		
		document.getElementById("root_zone_role").textContent = proposed + "Top-Level Domain (TLD)";
		document.getElementById("root_zone_root_zones_url").textContent = proposed + "Une référence à la liste officielle des 'Root Zones'.";
		document.getElementById("root_zone_delegation_url").textContent = proposed + "URL référençant l'enregistrement de délégation de l'ICANN pour le TLD.";	
		document.getElementById("root_zone_tld_category").textContent = proposed + "Indique un TLD générique (gTLD) ou un TLD de code pays (ccTLD).";
		document.getElementById("root_zone_tld_type").textContent = proposed + "Répertorie les types de TLD tels que gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD et geoTLD.";
		document.getElementById("root_zone_sponsoring_organization_name").textContent = proposed + "Définit l'éligibilité et les règles communautaires pour le TLD.";
		document.getElementById("root_zone_country_code_designated_manager").textContent = proposed + "Les gestionnaires de ccTLD ne sont pas nécessairement liés par les normes internationales.";
		document.getElementById("root_zone_registry_operator_organization_name").textContent = proposed + "Le nom légal de l’organisation responsable des activités d’enregistrement.";
		document.getElementById("root_zone_registry_operator_presented_name").textContent = proposed;
		document.getElementById("root_zone_backend_operator_organization_name").textContent = proposed + "Le opérateur du backend gère l'infrastructure technique du TLD.";
		document.getElementById("root_zone_backend_operator_presented_name").textContent = proposed;
		document.getElementById("root_zone_language_codes").textContent = modified + "Indique les langues prises en charge pour la 'Root Zone'.";
		document.getElementById("root_zone_restrictions_url").textContent = proposed + "Les restrictions d’usage et les politiques d’enregistrement sont accessibles via cette URL.";
		document.getElementById("root_zone_menu_url").textContent = proposed + "Un menu d'informations spécifique au TLD, disponible sous un sous-domaine tel que 'regmenu'.";
		document.getElementById("notices_role").textContent = accessible;
		document.getElementById("links_role").textContent = accessible;
		document.getElementById("lifecycle_role").textContent = proposed;
		document.getElementById("lifecycle_max_subscription_period_years").textContent = proposed;
		document.getElementById("lifecycle_add_period_days").textContent = proposed;
		document.getElementById("lifecycle_renew_period_days").textContent = proposed;
		document.getElementById("lifecycle_auto_renew_period_days").textContent = proposed;		
		document.getElementById("lifecycle_redemption_period_days").textContent = proposed;
		document.getElementById("lifecycle_deletion_phase_days").textContent = proposed;
		document.getElementById("lifecycle_upon_termination").textContent = proposed;
		document.getElementById("metadata_role").textContent = proposed;
		document.getElementById("metadata_lookup_endpoints_url").textContent = proposed + "Un dossier /v1/ prend également en charge les réponses /v2/ possibles ; voir icann.com.";
		document.getElementById("metadata_resource_upload_at").textContent = modified + "Date et heure de mise à jour de la base de données RDAP en heure Zulu (UTC).";
		document.getElementById("metadata_object_class_name").textContent = modified;
		document.getElementById("metadata_object_conformance").textContent = modified;		
		document.getElementById("metadata_registry_source").textContent = modified + "Prévue : les recherches d’identifiants Web sur les serveurs RDAP mondiaux.";
		document.getElementById("metadata_accredited_registrars_url").textContent = proposed;
		document.getElementById("metadata_registrar_source").textContent = proposed + "L'URL source du bureau d'enregistrement n'est pas incluse dans la réponse RDAP v1 actuelle.";
		document.getElementById("metadata_registrar_complaint_url").textContent = proposed + "Obligatoire si le registraire est accrédité par l'IANA ; utilisé pour diriger les plaintes des utilisateurs.";		
		document.getElementById("metadata_status_explanation_url").textContent = proposed + "Obligatoire si le registraire est accrédité par l'IANA ; fournit des explications sur le code de statut.";
		document.getElementById("domain_role").textContent = "Un domaine inférieur au niveau TLD est unique au monde et peut être choisi librement selon certaines règles.";
		document.getElementById("domain_ascii_name").textContent = "Pour les caractères spéciaux, les chaînes de caractères ASCII contiennent une transcription Punycode.";
		document.getElementById("domain_unicode_name").textContent = "Bien que les informations soient clarifiées, le nom de domaine Unicode est facultatif dans le protocole RDAP.";
		document.getElementById("domain_statuses_registry").textContent = "Le statut 'redemption period' permet la récupération. Avec le statut 'pending delete', la suppression devient définitive.";
		document.getElementById("domain_statuses_registrar").textContent = modified;
		document.getElementById("domain_accredited_registrar").textContent = modified + "Un identifiant d'accréditation de bureau d'enregistrement IANA pour les gTLD doit être exact.";
		document.getElementById("domain_created_at").textContent = "Les champs de date sont ici classés dans un ordre logique. C'est également facile dans le tableau JSON.";
		document.getElementById("domain_expiration_at").textContent = "Date et heure du renouvellement périodique ou de l'arrêt de la publication.";
		document.getElementById("domain_recovery_deadline").textContent = proposed + "La récupération est possible jusqu'à 'domain_expiration_at' plus 'redemption_period_days'.";
		document.getElementById("domain_deletion_at").textContent = "Date et heure prévues pour la suppression complète. Une phase de suppression finale peut exister.";
		document.getElementById("domain_extensions").textContent = "'Eligibility' : comment un domaine répond à une exigence spécifique dans une zone de domaine de premier niveau.";
		document.getElementById("abuse_role").textContent = "Informations sur la manière dont un tiers peut contacter le registraire ou la partie mandatée. Voir fryslan.frl.";
		document.getElementById("abuse_shielding").textContent = proposed;
		document.getElementById("abuse_telephone").textContent = "Un numéro de téléphone doit commencer par le type. Sont autorisés de toute façon 'voice' et 'fax'.";
		document.getElementById("sponsor_role").textContent = "L'enregistrement du domaine peut être géré par un sponsor. Voir par exemple france.fr.";
		document.getElementById("registrant_role").textContent = "L'utilisateur du domaine qui a le contrôle réel ou effectif pour les droits de domaine dans le pays de résidence.";
		document.getElementById("registrant_shielding").textContent = proposed + "Une valeur 'Request-Driven'. Le demandeur/TLD/le rôle nécessite une visibilité non groupée.";
		document.getElementById("registrant_handle").textContent = 'La sortie de "hostingtool.nl" contient involontairement des informations avec "STE135427-TRAIP"';
		document.getElementById("registrant_web_id").textContent = proposed + "Numéro d’identification Web pour les entités commerciales et les personnes physiques.";
		document.getElementById("registrant_organization_type").textContent = 'La valeur habituelle est "work", ou éventuellement "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "Le nom légal de l'organisation principalement responsable de l'abonnement au domaine.";
		document.getElementById("registrant_presented_name").textContent = "Valide est le nom d'une personne principalement responsable ou d'un rôle au sein de l'organisation.";
		document.getElementById("registrant_kind").textContent = "Vide / 'org' / 'individual' (Pour la continuité : testament biologique + testament + exécuteur testamentaire numérique)";
		document.getElementById("registrant_name").textContent = "Un nom personnel peut être visible publiquement dans le champ 'presented_name'. Voir, par exemple, circa.ca.";
		document.getElementById("registrant_country_code").textContent = "L'indexation des codes pays ISO-2 fonctionne, comme pour le Royaume-Uni, qui a quitté l'UE.";
		document.getElementById("registrant_street_address").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;
		document.getElementById("registrant_country_name").textContent = "Un nom de pays visible publiquement est limité à une 'Registrar Lookup via RDAP'.";
		document.getElementById("registrant_verification_received_at").textContent = proposed + "Après identification, un identifiant Web correspondant peut être confirmé, vide signifie révocation.";
		document.getElementById("registrant_verification_set_at").textContent = proposed + "Le registre vérifie ensuite les données avec le service de domaine Web spécifique au pays.";
		document.getElementById("administrative_role").textContent = "Le bureau administrativement responsable répond à une demande, et la transmet si nécessaire.";
		document.getElementById("administrative_shielding").textContent = proposed;
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_role").textContent = "Un contact technique répond pour résoudre un dysfonctionnement signalé.";
		document.getElementById("technical_shielding").textContent = proposed;
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_role").textContent = "Certains registres de domaine conservent des enregistrements pour effectuer leur facturation.";
		document.getElementById("billing_shielding").textContent = proposed;
		document.getElementById("emergency_role").textContent = proposed + "Une personne responsable peut fournir l'accès nécessaire.";
		document.getElementById("emergency_shielding").textContent = proposed;
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("reseller_role").textContent = "Le revendeur de domaine est en second lieu responsable, également en fonction de l'accord et des réglementations.";
		document.getElementById("reseller_shielding").textContent = proposed;
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;		
		document.getElementById("registrar_role").textContent = "Le registraire de domaine est responsable des réservations de domaines et du routage des adresses IP.";
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;		
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC est une fonctionnalité de sécurité de route Web sur le DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Un algorithme DNSSEC à partir de la version 13 est à jour.";
		document.getElementById("name_servers_ip").textContent = "Valeurs IP dans un enregistrement de colle uniquement si les serveurs de noms du registraire ne sont pas utilisés.";
		document.getElementById("br_zone").textContent = "TLD .br: Les données RDAP ont été ajustées avec la validation du serveur de noms.";
		document.getElementById("raw_data_next").textContent = "Les rôles ici sont organisés en fonction des responsabilités. 'None Specified' provient de cet outil. Une structure JSON peut également être aussi lisible que XML.";
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
$server_url = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
$server_url .= '://'. $_SERVER['HTTP_HOST'];
$server_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);	
$server_url = dirname($server_url);
$rdap_url = $server_url.'/compose_domain/index.php?batch=0&domain='.$pd;
if (@get_headers($rdap_url))	{ // the application to compose data
	$json = file_get_contents($rdap_url) or die("An entered domain could not be read.");
	$data = json_decode($json, true);
}
if	(is_null($data))	{
	$reopen = $server_url.'/modeling_domain/index.php?batch=0&domain=hostingtool.nl';
	sc_redir($reopen);
}
$html_text = '<body onload=SwitchTranslation('.$viewlanguage.')><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem; table-layout: fixed; width:1375px">
<tr><th style="width:325px"></th><th style="width:300px"></th><th style="width:750px"></th></tr>';
$html_text .= '<tr style="font-size: .8rem"><td id="title" style="font-size: 1.3rem;color:blue;font-weight:bold"></td><td id="instruction"></td><td></td></tr>';
$html_text .= '<tr style="font-size: .8rem"><td id="subtitle" style="font-size: 1.0rem;color:blue;font-weight:bold"></td><td><form action='.htmlentities($_SERVER['PHP_SELF']).' method="get">
	<input type="hidden" id="language" name="language" value='.$viewlanguage.'>	
	<input type="text" style="width:90%" id="domain" name="domain" value='.$vd.'></form></td><td>
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(0)">None</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(1)">nl_NL</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(2)">en_US</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(3)">de_DE</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(4)">fr_FR</button> 
	<a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_email" target="_blank">email modeling</a> - <a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_menu" target="_blank">menu modeling</a> - <a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap.hostingtool.nl" target="_blank">code/issues on GitHub</a> - <a style="font-size: 0.9rem" href="https://janwillemstegink.nl/" target="_blank">janwillemstegink.nl</a></td></tr>';
//echo $pd.'#'.$data[$pd]['domain']['ascii_name'];
if (true or $pd == mb_strtolower($data[$pd]['domain']['ascii_name']) or empty($data[$pd]['domain']['ascii_name']))	{
	$html_text .= '<tr style="font-size:1.05rem;font-weight:bold"><td id="field"></td><td id="value"><td id="explanation"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(10)">Root Zone Information +/-</button></td><td><b>'.$data[$pd]['root_zone']['top_level_domain'].'</b></td><td id="root_zone_role"></td></tr>';
	$html_text .= '<tr id="101" style="display:none"><td>root_zones_url</td><td><a href='.$data[$pd]['root_zone']['root_zones_url'].' target="_blank">Root Zones</a></td><td id="root_zone_root_zones_url"></td></tr>';
	$html_text .= '<tr id="102" style="display:none"><td>delegation_url</td><td><a href='.$data[$pd]['root_zone']['delegation_url'].' target="_blank">TLD Delegation</a></td><td id="root_zone_delegation_url"></td></tr>';
	$html_text .= '<tr id="103" style="display:none"><td>tld_category</td><td>'.$data[$pd]['root_zone']['tld_category'].'</td><td id="root_zone_tld_category"></td></tr>';
	$html_text .= '<tr id="104" style="display:none"><td>tld_type</td><td>'.$data[$pd]['root_zone']['tld_type'].'</td><td id="root_zone_tld_type"></td></tr>';
	$html_text .= '<tr id="105" style="display:none"><td>sponsoring_organization_name</td><td>'.$data[$pd]['root_zone']['sponsoring_organization_name'].'</td><td id="root_zone_sponsoring_organization_name"></td></tr>';
	$html_text .= '<tr id="106" style="display:none"><td>country_code_designated_manager</td><td>'.$data[$pd]['root_zone']['country_code_designated_manager'].'</td><td id="root_zone_country_code_designated_manager"></td></tr>';
	$html_text .= '<tr id="107" style="display:none"><td>registry_operator_organization_name</td><td>'.$data[$pd]['root_zone']['registry_operator_organization_name'].'</td><td id="root_zone_registry_operator_organization_name"></td></tr>';
	$html_text .= '<tr id="108" style="display:none"><td>registry_operator_presented_name</td><td>'.$data[$pd]['root_zone']['registry_operator_presented_name'].'</td><td id="root_zone_registry_operator_presented_name"></td></tr>';
	$html_text .= '<tr id="109" style="display:none"><td>backend_operator_organization_name</td><td>'.$data[$pd]['root_zone']['backend_operator_organization_name'].'</td><td id="root_zone_backend_operator_organization_name"></td></tr>';
	$html_text .= '<tr id="1010" style="display:none"><td>backend_operator_presented_name</td><td>'.$data[$pd]['root_zone']['backend_operator_presented_name'].'</td><td id="root_zone_backend_operator_presented_name"></td></tr>';
	$html_text .= '<tr id="1011" style="display:none"><td>language_codes</td><td>'.$data[$pd]['root_zone']['language_codes'].'</td><td id="root_zone_language_codes"></td></tr>';
	$html_text .= '<tr id="1012" style="display:none"><td>restrictions_url</td><td>'.((strlen($data[$pd]['root_zone']['restrictions_url'])) ? '<a href='.$data[$pd]['root_zone']['restrictions_url'].' target="_blank">TLD Restrictions</a>' : '').'</td><td id="root_zone_restrictions_url"></td></tr>';
	$html_text .= '<tr id="1013" style="display:none"><td>menu_url</td><td>'.((strlen($data[$pd]['root_zone']['menu_url'])) ? '<a href='.$data[$pd]['root_zone']['menu_url'].' target="_blank">TLD Menu</a>' : '').'</td><td id="root_zone_menu_url"></td></tr>';
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
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(28)">Lifecycle Data +/-</button></td><td></td><td id="lifecycle_role"></td></tr>';
	$html_text .= '<tr id="281" style="display:none"><td>max_subscription_period_years</td><td>'.$data[$pd]['lifecycle']['max_subscription_period_years'].'</td><td id="lifecycle_max_subscription_period_years"></td></tr>';
	$html_text .= '<tr id="282" style="display:none"><td>add_period_days</td><td>'.$data[$pd]['lifecycle']['add_period_days'].'</td><td id="lifecycle_add_period_days"></td></tr>';
	$html_text .= '<tr id="283" style="display:none"><td>renew_period_days</td><td>'.$data[$pd]['lifecycle']['renew_period_days'].'</td><td id="lifecycle_renew_period_days"></td></tr>';
	$html_text .= '<tr id="284" style="display:none"><td>auto_renew_period_days</td><td>'.$data[$pd]['lifecycle']['auto_renew_period_days'].'</td><td id="lifecycle_auto_renew_period_days"></td></tr>';
	$html_text .= '<tr id="285" style="display:none"><td>redemption_period_days</td><td>'.$data[$pd]['lifecycle']['redemption_period_days'].'</td><td id="lifecycle_redemption_period_days"></td></tr>';
	$html_text .= '<tr id="286" style="display:none"><td>deletion_phase_days</td><td>'.$data[$pd]['lifecycle']['deletion_phase_days'].'</td><td id="lifecycle_deletion_phase_days"></td></tr>';
	$html_text .= '<tr id="287" style="display:none"><td>upon_termination</td><td>'.$data[$pd]['lifecycle']['upon_termination'].'</td><td id="lifecycle_upon_termination"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(29)">Metadata +/-</button></td><td></td><td id="metadata_role"></td></tr>';
	$html_text .= '<tr id="291" style="display:none"><td>lookup_endpoints_url</td><td><a href='.$data[$pd]['metadata']['lookup_endpoints_url'].' target="_blank">Lookup Endpoints</a></td><td id="metadata_lookup_endpoints_url"></td></tr>';
	$html_text .= '<tr id="292" style="display:none"><td>resource_upload_at</td><td>'.$data[$pd]['metadata']['resource_upload_at'].'</td><td id="metadata_resource_upload_at"></td></tr>';
	$html_text .= '<tr id="293" style="display:none"><td>object_class_name</td><td>'.$data[$pd]['metadata']['object_class_name'].'</td><td id="metadata_object_class_name"></td></tr>';
	$html_text .= '<tr id="294" style="display:none; vertical-align:top"><td>object_conformance</td><td>'.$data[$pd]['metadata']['object_conformance'].'</td><td id="metadata_object_conformance"></td></tr>';
	$registry_source = str_replace('https://', '', $data[$pd]['metadata']['registry_source']);
	$validation_registry = 'https://validator.rdap.org/?url=https://'.$registry_source.'&response-type=domain&server-type=gtld-registry&errors-only=1';	
	$html_text .= '<tr id="295" style="display:none"><td>registry_source</td><td>'.((strlen($data[$pd]['metadata']['registry_source'])) ? '<a href='.$data[$pd]['metadata']['registry_source'].' target="_blank">Registry Response</a> - <a href="' . htmlspecialchars($validation_registry, ENT_QUOTES, "UTF-8") . '" target="_blank">validator.rdap.org</a>' : '').'</td><td id="metadata_registry_source"></td></tr>';
	$html_text .= '<tr id="296" style="display:none"><td>accredited_registrars_url</td><td><a href='.$data[$pd]['metadata']['accredited_registrars_url'].' target="_blank">IANA Registrars</a></td><td id="metadata_accredited_registrars_url"></td></tr>';
	$registrar_source = str_replace('https://', '', $data[$pd]['metadata']['registrar_source']);
	$validation_registrar = 'https://validator.rdap.org/?url=https://'.$registrar_source.'&response-type=domain&server-type=gtld-registrar&errors-only=1';	
	$html_text .= '<tr id="297" style="display:none"><td>registrar_source eg. <a style="font-size: 0.9rem" href="https://rdap.cscglobal.com/dbs/rdap-api/v1/domain/icann.com" target="_blank">icann.com</a> <a style="font-size: 0.9rem" href="https://rdap.metaregistrar.com/domain/fryslan.frl" target="_blank">fryslan.frl</a></td><td>'.((strlen($data[$pd]['metadata']['registrar_source'])) ? '<a href='.$data[$pd]['metadata']['registrar_source'].' target="_blank">Registrar Response</a> - <a href="' . htmlspecialchars($validation_registrar, ENT_QUOTES, "UTF-8") . '" target="_blank">validator.rdap.org</a>' : 'Not Available').'</td><td id="metadata_registrar_source"></td></tr>';
	$html_text .= '<tr id="298" style="display:none"><td>registrar_complaint_url</td><td>'.((strlen($data[$pd]['metadata']['registrar_complaint_url'])) ? '<a href='.$data[$pd]['metadata']['registrar_complaint_url'].' target="_blank">icann.org/wicf</a>' : 'Not Applicable').'</td><td id="metadata_registrar_complaint_url"></td></tr>';
	$html_text .= '<tr id="299" style="display:none"><td>status_explanation_url</td><td>'.((strlen($data[$pd]['metadata']['status_explanation_url'])) ? '<a href='.$data[$pd]['metadata']['status_explanation_url'].' target="_blank">icann.org/epp</a>' : 'Not Applicable').'</td><td id="metadata_status_explanation_url"></td></tr>';
	//$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(30)">Domain Data +/-</button></td><td>'.$vd.'</td><td id="domain_role"></td></tr>';
	$html_text .= '<tr id="301" style="display:none"><td>domain_handle</td><td>'.$data[$pd]['domain']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="302" style="display:none"><td>domain_ascii_name (lower case is not a "MUST")</td><td>'.$data[$pd]['domain']['ascii_name'].'</td><td id="domain_ascii_name"></td></tr>';
	$html_text .= '<tr id="303" style="display:none"><td>domain_unicode_name</td><td>'.$data[$pd]['domain']['unicode_name'].'</td><td id="domain_unicode_name"></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>domain_statuses_registry</td><td>'.$data[$pd]['domain']['statuses_registry'].'</td><td id="domain_statuses_registry"></td></tr>';
	$html_text .= '<tr id="304" style="display:none;vertical-align:top"><td>domain_statuses_registrar</td><td>'.$data[$pd]['domain']['statuses_registrar'].'</td><td id="domain_statuses_registrar"></td></tr>';
	$html_text .= '<tr id="305" style="display:none"><td>domain_accredited_registrar</td><td>'.((strlen($data[$pd]['domain']['accredited_registrar'])) ? $data[$pd]['domain']['accredited_registrar'] : 'Not Applicable').'</td><td id="domain_accredited_registrar"></td></tr>';
	$html_text .= '<tr id="306" style="display:none"><td>domain_created_at</td><td>'.$data[$pd]['domain']['created_at'].'</td><td id="domain_created_at"></td></tr>';
	$html_text .= '<tr id="307" style="display:none"><td>domain_latest_transfer_at</td><td>'.$data[$pd]['domain']['latest_transfer_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="308" style="display:none"><td>domain_latest_update_at</td><td>'.$data[$pd]['domain']['latest_update_at'].'</td><td></td></tr>';
	$html_text .= '<tr><td>domain_expiration_at</td><td>'.$data[$pd]['domain']['expiration_at'].'</td><td id="domain_expiration_at"></td></tr>';
	$html_text .= '<tr id="309" style="display:none"><td>domain_recovery_deadline</td><td>'.$data[$pd]['domain']['recovery_deadline'].'</td><td id="domain_recovery_deadline"></td></tr>';
	$html_text .= '<tr id="3010" style="display:none"><td>domain_deletion_at</td><td>'.$data[$pd]['domain']['deletion_at'].'</td><td id="domain_deletion_at"></td></tr>';
	$html_text .= '<tr id="3011" style="display:none;vertical-align:top"><td>domain_extensions</td><td>'.$data[$pd]['domain']['extensions'].'</td><td id="domain_extensions"></td></tr>';
	$html_text .= '<tr id="3012" style="display:none;vertical-align:top"><td>domain_remarks</td><td>'.$data[$pd]['domain']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(35)">Abuse Contact +/-</button></td><td></td><td id="abuse_role"></td></tr>';
	$html_text .= '<tr id="351" style="display:none"><td>abuse_shielding</td><td>'.$data[$pd]['abuse']['shielding'].'</td><td id="abuse_shielding"></td></tr>';
	$html_text .= '<tr id="352" style="display:none"><td>abuse_organization_type</td><td>'.$data[$pd]['abuse']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="353" style="display:none"><td>abuse_organization_name</td><td>'.$data[$pd]['abuse']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="354" style="display:none"><td>abuse_presented_name</td><td>'.$data[$pd]['abuse']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="355" style="display:none"><td>abuse_kind</td><td>'.$data[$pd]['abuse']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="356" style="display:none"><td>abuse_email</td><td>'.$data[$pd]['abuse']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="357" style="display:none"><td>abuse_telephone</td><td>'.$data[$pd]['abuse']['telephone'].'</td><td id="abuse_telephone"></td></tr>';
	$html_text .= '<tr id="358" style="display:none"><td>abuse_country_code</td><td>'.$data[$pd]['abuse']['country_code'].'</td><td id="abuse_country_code"></td></tr>';
	$sponsor_applicable = (strlen($data[$pd]['sponsor']['organization_name']) or strlen($data[$pd]['sponsor']['presented_name'])) ? 'Sponsor Data Exists' : 'No Sponsor Data';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(39)">Sponsor +/-</button></td><td>'.$sponsor_applicable.'</td><td id="sponsor_role"></td></tr>';
	$html_text .= '<tr id="391" style="display:none"><td>sponsor_shielding</td><td>'.$data[$pd]['sponsor']['shielding'].'</td><td></td></tr>';
	$html_text .= '<tr id="392" style="display:none"><td>sponsor_handle</td><td>'.$data[$pd]['sponsor']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="393" style="display:none"><td>sponsor_web_id</td><td>'.$data[$pd]['sponsor']['web_id'].'</td><td id="sponsor_web_id"></td></tr>';
	$html_text .= '<tr id="394" style="display:none"><td>sponsor_organization_type</td><td>'.$data[$pd]['sponsor']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="395" style="display:none"><td>sponsor_organization_name</td><td>'.$data[$pd]['sponsor']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="396" style="display:none"><td>sponsor_presented_name</td><td>'.$data[$pd]['sponsor']['presented_name'].'</td><td id="sponsor_recover"></td></tr>';
	$html_text .= '<tr id="397" style="display:none"><td>sponsor_kind</td><td>'.$data[$pd]['sponsor']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="398" style="display:none"><td>sponsor_name</td><td>'.$data[$pd]['sponsor']['name'].'</td><td></td></tr>';
	$html_text .= '<tr id="399" style="display:none"><td>sponsor_email</td><td>'.$data[$pd]['sponsor']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="3910" style="display:none"><td>sponsor_telephone</td><td>'.$data[$pd]['sponsor']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr id="3911" style="display:none"><td>sponsor_country_code</td><td>'.$data[$pd]['sponsor']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="3912" style="display:none"><td>sponsor_street_address</td><td>'.$data[$pd]['sponsor']['street_address'].'</td><td></td></tr>';
	$html_text .= '<tr id="3913" style="display:none"><td>sponsor_city</td><td>'.$data[$pd]['sponsor']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="3914" style="display:none"><td>sponsor_state_or_province</td><td>'.$data[$pd]['sponsor']['state_or_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="3915" style="display:none"><td>sponsor_postal_code</td><td>'.$data[$pd]['sponsor']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="3916" style="display:none"><td>sponsor_country_name</td><td>'.$data[$pd]['sponsor']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="3917" style="display:none"><td>sponsor_language_pref_1</td><td>'.$data[$pd]['sponsor']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="3918" style="display:none"><td>sponsor_language_pref_2</td><td>'.$data[$pd]['sponsor']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="3919" style="display:none;vertical-align:top"><td>sponsor_statuses</td><td>'.$data[$pd]['sponsor']['statuses'].'</td><td></td></tr>';
	$html_text .= '<tr id="3920" style="display:none"><td>sponsor_created_at</td><td>'.$data[$pd]['sponsor']['created_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="3921" style="display:none"><td>sponsor_latest_update_at</td><td>'.$data[$pd]['sponsor']['latest_update_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="3922" style="display:none"><td>sponsor_verification_received_at</td><td>'.$data[$pd]['sponsor']['verification_received_at'].'</td><td id="sponsor_verification_received_at"></td></tr>';
	$html_text .= '<tr id="3923" style="display:none"><td>sponsor_verification_set_at</td><td>'.$data[$pd]['sponsor']['verification_set_at'].'</td><td id="sponsor_verification_set_at"></td></tr>';
	$html_text .= '<tr id="3924" style="display:none;vertical-align:top"><td>sponsor_properties</td><td>'.$data[$pd]['sponsor']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="3925" style="display:none;vertical-align:top"><td>sponsor_remarks</td><td>'.$data[$pd]['sponsor']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(40)">Registrant +/-</button></td><td></td><td id="registrant_role"></td></tr>';
	$html_text .= '<tr id="401" style="display:none"><td>registrant_shielding</td><td>'.$data[$pd]['registrant']['shielding'].'</td><td id="registrant_shielding"></td></tr>';
	$html_text .= '<tr id="402" style="display:none"><td>registrant_handle</td><td>'.$data[$pd]['registrant']['handle'].'</td><td id="registrant_handle"></td></tr>';
	$html_text .= '<tr id="403" style="display:none"><td>registrant_web_id</td><td>'.$data[$pd]['registrant']['web_id'].'</td><td id="registrant_web_id"></td></tr>';
	$html_text .= '<tr id="404" style="display:none"><td>registrant_organization_type</td><td>'.$data[$pd]['registrant']['organization_type'].'</td><td id="registrant_organization_type"></td></tr>';
	$html_text .= '<tr><td>registrant_organization_name</td><td>'.$data[$pd]['registrant']['organization_name'].'</td><td id="registrant_organization_name"></td></tr>';
	$html_text .= '<tr><td>registrant_presented_name (RDAP: "fn"/full name)</td><td>'.$data[$pd]['registrant']['presented_name'].'</td><td id="registrant_presented_name"></td></tr>';
	$html_text .= '<tr id="405" style="display:none"><td>registrant_kind</td><td>'.$data[$pd]['registrant']['kind'].'</td><td id="registrant_kind"></td></tr>';
	$html_text .= '<tr id="406" style="display:none"><td>registrant_name</td><td>'.$data[$pd]['registrant']['name'].'</td><td id="registrant_name"></td></tr>';
	$html_text .= '<tr id="407" style="display:none"><td>registrant_email</td><td>'.$data[$pd]['registrant']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="408" style="display:none"><td>registrant_telephone</td><td>'.$data[$pd]['registrant']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr><td>registrant_country_code (<a style="font-size: 0.9rem" href="https://icann-hamster.nl/ham/soac/ccnso/techday/icann80/2.%20RDAP%20Conformance%20Tool%20-%20Tech%20Day.pdf" target="_blank">"cc" parameter</a>)</td><td>'.$data[$pd]['registrant']['country_code'].'</td><td id="registrant_country_code"></td></tr>';
	$html_text .= '<tr id="409" style="display:none"><td>registrant_street_address</td><td>'.$data[$pd]['registrant']['street_address'].'</td><td id="registrant_street_address"></td></tr>';
	$html_text .= '<tr id="4010" style="display:none"><td>registrant_city</td><td>'.$data[$pd]['registrant']['city'].'</td><td id="registrant_city"></td></tr>';
	$html_text .= '<tr id="4011" style="display:none"><td>registrant_state_or_province</td><td>'.$data[$pd]['registrant']['state_or_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="4012" style="display:none"><td>registrant_postal_code</td><td>'.$data[$pd]['registrant']['postal_code'].'</td><td id="registrant_postal_code"></td></tr>';
	$html_text .= '<tr id="4013" style="display:none"><td>registrant_country_name</td><td>'.$data[$pd]['registrant']['country_name'].'</td><td id="registrant_country_name"></td></tr>';
	$html_text .= '<tr id="4014" style="display:none"><td>registrant_language_pref_1</td><td>'.$data[$pd]['registrant']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4015" style="display:none"><td>registrant_language_pref_2</td><td>'.$data[$pd]['registrant']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4016" style="display:none;vertical-align:top"><td>registrant_statuses</td><td>'.$data[$pd]['registrant']['statuses'].'</td><td></td></tr>';
	$html_text .= '<tr id="4017" style="display:none"><td>registrant_created_at</td><td>'.$data[$pd]['registrant']['created_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="4018" style="display:none"><td>registrant_latest_update_at</td><td>'.$data[$pd]['registrant']['latest_update_at'].'</td><td></td></tr>';
	$html_text .= '<tr><td>registrant_verification_received_at</td><td>'.$data[$pd]['registrant']['verification_received_at'].'</td><td id="registrant_verification_received_at"></td></tr>';
	$html_text .= '<tr><td>registrant_verification_set_at</td><td>'.$data[$pd]['registrant']['verification_set_at'].'</td><td id="registrant_verification_set_at"></td></tr>';
	$html_text .= '<tr id="4019" style="display:none;vertical-align:top"><td>registrant_properties</td><td>'.$data[$pd]['registrant']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="4020" style="display:none;vertical-align:top"><td>registrant_remarks</td><td>'.$data[$pd]['registrant']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(41)">Administrative / Decision +/-</button></td><td></td><td id="administrative_role"></td></tr>';
	$html_text .= '<tr id="411" style="display:none"><td>administrative_shielding</td><td>'.$data[$pd]['administrative']['shielding'].'</td><td id="administrative_shielding"></td></tr>';
	$html_text .= '<tr id="412" style="display:none"><td>administrative_handle</td><td>'.$data[$pd]['administrative']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="413" style="display:none"><td>administrative_web_id</td><td>'.$data[$pd]['administrative']['web_id'].'</td><td id="administrative_web_id"></td></tr>';
	$html_text .= '<tr id="414" style="display:none"><td>administrative_organization_type</td><td>'.$data[$pd]['administrative']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="415" style="display:none"><td>administrative_organization_name</td><td>'.$data[$pd]['administrative']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="416" style="display:none"><td>administrative_presented_name</td><td>'.$data[$pd]['administrative']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="417" style="display:none"><td>administrative_kind</td><td>'.$data[$pd]['administrative']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="418" style="display:none"><td>administrative_name</td><td>'.$data[$pd]['administrative']['name'].'</td><td></td></tr>';
	$html_text .= '<tr><td>administrative_email</td><td>'.$data[$pd]['administrative']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="419" style="display:none"><td>administrative_telephone</td><td>'.$data[$pd]['administrative']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr id="4110" style="display:none"><td>administrative_country_code</td><td>'.$data[$pd]['administrative']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4111" style="display:none"><td>administrative_street_address</td><td>'.$data[$pd]['administrative']['street_address'].'</td><td></td></tr>';
	$html_text .= '<tr id="4112" style="display:none"><td>administrative_city</td><td>'.$data[$pd]['administrative']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="4113" style="display:none"><td>administrative_state_or_province</td><td>'.$data[$pd]['administrative']['state_or_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="4114" style="display:none"><td>administrative_postal_code</td><td>'.$data[$pd]['administrative']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4115" style="display:none"><td>administrative_country_name</td><td>'.$data[$pd]['administrative']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="4116" style="display:none"><td>administrative_language_pref_1</td><td>'.$data[$pd]['administrative']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4117" style="display:none"><td>administrative_language_pref_2</td><td>'.$data[$pd]['administrative']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4118" style="display:none;vertical-align:top"><td>administrative_properties</td><td>'.$data[$pd]['administrative']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="4119" style="display:none;vertical-align:top"><td>administrative_remarks</td><td>'.$data[$pd]['administrative']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(42)">Technical / Onsite +/-</button></td><td></td><td id="technical_role"></td></tr>';
	$html_text .= '<tr id="421" style="display:none"><td>technical_shielding</td><td>'.$data[$pd]['technical']['shielding'].'</td><td id="technical_shielding"></td></tr>';
	$html_text .= '<tr id="422" style="display:none"><td>technical_handle</td><td>'.$data[$pd]['technical']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="423" style="display:none"><td>technical_web_id</td><td>'.$data[$pd]['technical']['web_id'].'</td><td id="technical_web_id"></td></tr>';
	$html_text .= '<tr id="424" style="display:none"><td>technical_organization_type</td><td>'.$data[$pd]['technical']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="425" style="display:none"><td>technical_organization_name</td><td>'.$data[$pd]['technical']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="426" style="display:none"><td>technical_presented_name</td><td>'.$data[$pd]['technical']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="427" style="display:none"><td>technical_kind</td><td>'.$data[$pd]['technical']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="428" style="display:none"><td>technical_name</td><td>'.$data[$pd]['technical']['name'].'</td><td></td></tr>';
	$html_text .= '<tr><td>technical_email</td><td>'.$data[$pd]['technical']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="429" style="display:none"><td>technical_telephone</td><td>'.$data[$pd]['technical']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr id="4210" style="display:none"><td>technical_country_code</td><td>'.$data[$pd]['technical']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4211" style="display:none"><td>technical_street_address</td><td>'.$data[$pd]['technical']['street_address'].'</td><td></td></tr>';
	$html_text .= '<tr id="4212" style="display:none"><td>technical_city</td><td>'.$data[$pd]['technical']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="4213" style="display:none"><td>technical_state_or_province</td><td>'.$data[$pd]['technical']['state_or_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="4214" style="display:none"><td>technical_postal_code</td><td>'.$data[$pd]['technical']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4215" style="display:none"><td>technical_country_name</td><td>'.$data[$pd]['technical']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="4216" style="display:none"><td>technical_language_pref_1</td><td>'.$data[$pd]['technical']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4217" style="display:none"><td>technical_language_pref_2</td><td>'.$data[$pd]['technical']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4218" style="display:none;vertical-align:top"><td>technical_properties</td><td>'.$data[$pd]['technical']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="4219" style="display:none;vertical-align:top"><td>technical_remarks</td><td>'.$data[$pd]['technical']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(43)">Billing +/-</button></td><td></td><td id="billing_role"></td></tr>';
	$html_text .= '<tr id="431" style="display:none"><td>billing_shielding</td><td>'.$data[$pd]['billing']['shielding'].'</td><td id="billing_shielding"></td></tr>';
	$html_text .= '<tr id="432" style="display:none"><td>billing_handle</td><td>'.$data[$pd]['billing']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="433" style="display:none"><td>billing_web_id</td><td>'.$data[$pd]['billing']['web_id'].'</td><td></td></tr>';
	$html_text .= '<tr id="434" style="display:none"><td>billing_organization_type</td><td>'.$data[$pd]['billing']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="435" style="display:none"><td>billing_organization_name</td><td>'.$data[$pd]['billing']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="436" style="display:none"><td>billing_presented_name</td><td>'.$data[$pd]['billing']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="437" style="display:none"><td>billing_kind</td><td>'.$data[$pd]['billing']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="438" style="display:none"><td>billing_name</td><td>'.$data[$pd]['billing']['name'].'</td><td></td></tr>';
	$html_text .= '<tr id="439" style="display:none"><td>billing_email</td><td>'.$data[$pd]['billing']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="4310" style="display:none"><td>billing_telephone</td><td>'.$data[$pd]['billing']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr id="4311" style="display:none"><td>billing_country_code</td><td>'.$data[$pd]['billing']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4312" style="display:none"><td>billing_street_address</td><td>'.$data[$pd]['billing']['street_address'].'</td><td></td></tr>';
	$html_text .= '<tr id="4313" style="display:none"><td>billing_city</td><td>'.$data[$pd]['billing']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="4314" style="display:none"><td>billing_state_or_province</td><td>'.$data[$pd]['billing']['state_or_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="4315" style="display:none"><td>billing_postal_code</td><td>'.$data[$pd]['billing']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4316" style="display:none"><td>billing_country_name</td><td>'.$data[$pd]['billing']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="4317" style="display:none"><td>billing_language_pref_1</td><td>'.$data[$pd]['billing']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4318" style="display:none"><td>billing_language_pref_2</td><td>'.$data[$pd]['billing']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4319" style="display:none;vertical-align:top"><td>billing_properties</td><td>'.$data[$pd]['billing']['properties'].'</td><td></td></tr>';	
	$html_text .= '<tr id="4320" style="display:none;vertical-align:top"><td>billing_remarks</td><td>'.$data[$pd]['billing']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(44)">Emergency +/-</button></td><td></td><td id="emergency_role"></td></tr>';
	$html_text .= '<tr id="441" style="display:none"><td>emergency_shielding</td><td>'.$data[$pd]['emergency']['shielding'].'</td><td id="emergency_shielding"></td></tr>';
	$html_text .= '<tr id="442" style="display:none"><td>emergency_handle</td><td>'.$data[$pd]['emergency']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="443" style="display:none"><td>emergency_web_id</td><td>'.$data[$pd]['emergency']['web_id'].'</td><td id="emergency_web_id"></td></tr>';
	$html_text .= '<tr id="444" style="display:none"><td>emergency_organization_type</td><td>'.$data[$pd]['emergency']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="445" style="display:none"><td>emergency_organization_name</td><td>'.$data[$pd]['emergency']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="446" style="display:none"><td>emergency_presented_name</td><td>'.$data[$pd]['emergency']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="447" style="display:none"><td>emergency_kind</td><td>'.$data[$pd]['emergency']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="448" style="display:none"><td>emergency_name</td><td>'.$data[$pd]['emergency']['name'].'</td><td></td></tr>';
	$html_text .= '<tr id="449" style="display:none"><td>emergency_email</td><td>'.$data[$pd]['emergency']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="4410" style="display:none"><td>emergency_telephone</td><td>'.$data[$pd]['emergency']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr id="4411" style="display:none"><td>emergency_country_code</td><td>'.$data[$pd]['emergency']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4412" style="display:none"><td>emergency_street_address</td><td>'.$data[$pd]['emergency']['street_address'].'</td><td></td></tr>';
	$html_text .= '<tr id="4413" style="display:none"><td>emergency_city</td><td>'.$data[$pd]['emergency']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="4414" style="display:none"><td>emergency_state_or_province</td><td>'.$data[$pd]['emergency']['state_or_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="4415" style="display:none"><td>emergency_postal_code</td><td>'.$data[$pd]['emergency']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4416" style="display:none"><td>emergency_country_name</td><td>'.$data[$pd]['emergency']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="4417" style="display:none"><td>emergency_language_pref_1</td><td>'.$data[$pd]['emergency']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4418" style="display:none"><td>emergency_language_pref_2</td><td>'.$data[$pd]['emergency']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4419" style="display:none;vertical-align:top"><td>emergency_properties</td><td>'.$data[$pd]['emergency']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="4420" style="display:none;vertical-align:top"><td>emergency_remarks</td><td>'.$data[$pd]['emergency']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(50)">Reseller +/-</button></td><td></td><td id="reseller_role"></td></tr>';
	$html_text .= '<tr id="501" style="display:none"><td>reseller_shielding</td><td>'.$data[$pd]['reseller']['shielding'].'</td><td id="reseller_shielding"></td></tr>';
	$html_text .= '<tr id="502" style="display:none"><td>reseller_handle</td><td>'.$data[$pd]['reseller']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="503" style="display:none"><td>reseller_web_id</td><td>'.$data[$pd]['reseller']['web_id'].'</td><td id="reseller_web_id"></td></tr>';
	$html_text .= '<tr id="504" style="display:none"><td>reseller_organization_type</td><td>'.$data[$pd]['reseller']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr><td>reseller_organization_name</td><td>'.$data[$pd]['reseller']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr><td>reseller_presented_name</td><td>'.$data[$pd]['reseller']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="505" style="display:none"><td>reseller_kind</td><td>'.$data[$pd]['reseller']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="506" style="display:none"><td>reseller_name</td><td>'.$data[$pd]['reseller']['name'].'</td><td></td></tr>';
	$html_text .= '<tr id="507" style="display:none"><td>reseller_email</td><td>'.$data[$pd]['reseller']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="508" style="display:none"><td>reseller_telephone</td><td>'.$data[$pd]['reseller']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr><td>reseller_country_code</td><td>'.$data[$pd]['reseller']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="509" style="display:none"><td>reseller_street_address</td><td>'.$data[$pd]['reseller']['street_address'].'</td><td></td></tr>';
	$html_text .= '<tr id="5010" style="display:none"><td>reseller_city</td><td>'.$data[$pd]['reseller']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="5011" style="display:none"><td>reseller_state_or_province</td><td>'.$data[$pd]['reseller']['state_or_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="5012" style="display:none"><td>reseller_postal_code</td><td>'.$data[$pd]['reseller']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="5013" style="display:none"><td>reseller_country_name</td><td>'.$data[$pd]['reseller']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="5014" style="display:none"><td>reseller_language_pref_1</td><td>'.$data[$pd]['reseller']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="5015" style="display:none"><td>reseller_language_pref_2</td><td>'.$data[$pd]['reseller']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="5016" style="display:none;vertical-align:top"><td>reseller_statuses</td><td>'.$data[$pd]['reseller']['statuses'].'</td><td></td></tr>';
	$html_text .= '<tr id="5017" style="display:none"><td>reseller_created_at</td><td>'.$data[$pd]['reseller']['created_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="5018" style="display:none"><td>reseller_latest_update_at</td><td>'.$data[$pd]['reseller']['latest_update_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="5019" style="display:none"><td>reseller_verification_received_at</td><td>'.$data[$pd]['reseller']['verification_received_at'].'</td><td id="reseller_verification_received_at"></td></tr>';
	$html_text .= '<tr id="5020" style="display:none"><td>reseller_verification_set_at</td><td>'.$data[$pd]['reseller']['verification_set_at'].'</td><td id="reseller_verification_set_at"></td></tr>';
	$html_text .= '<tr id="5021" style="display:none;vertical-align:top"><td>reseller_properties</td><td>'.$data[$pd]['reseller']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="5022" style="display:none;vertical-align:top"><td>reseller_remarks</td><td>'.$data[$pd]['reseller']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(60)">Registrar +/-</button></td><td></td><td id="registrar_role"></td></tr>';
	$html_text .= '<tr id="601" style="display:none"><td>registrar_shielding</td><td>'.$data[$pd]['registrar']['shielding'].'</td><td id="registrar_shielding"></td></tr>';
	$html_text .= '<tr id="602" style="display:none"><td>registrar_handle</td><td>'.$data[$pd]['registrar']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="603" style="display:none"><td>registrar_web_id</td><td>'.$data[$pd]['registrar']['web_id'].'</td><td id="registrar_web_id"></td></tr>';
	$html_text .= '<tr id="604" style="display:none"><td>registrar_organization_type</td><td>'.$data[$pd]['registrar']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr><td>registrar_organization_name</td><td>'.$data[$pd]['registrar']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr><td>registrar_presented_name</td><td>'.$data[$pd]['registrar']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="605" style="display:none"><td>registrar_kind</td><td>'.$data[$pd]['registrar']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="606" style="display:none"><td>registrar_name</td><td>'.$data[$pd]['registrar']['name'].'</td><td></td></tr>';
	$html_text .= '<tr id="607" style="display:none"><td>registrar_email</td><td>'.$data[$pd]['registrar']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="608" style="display:none"><td>registrar_telephone</td><td>'.$data[$pd]['registrar']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr><td>registrar_country_code</td><td>'.$data[$pd]['registrar']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="609" style="display:none"><td>registrar_street_address</td><td>'.$data[$pd]['registrar']['street_address'].'</td><td></td></tr>';
	$html_text .= '<tr id="6010" style="display:none"><td>registrar_city</td><td>'.$data[$pd]['registrar']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="6011" style="display:none"><td>registrar_state_or_province</td><td>'.$data[$pd]['registrar']['state_or_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="6012" style="display:none"><td>registrar_postal_code</td><td>'.$data[$pd]['registrar']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="6013" style="display:none"><td>registrar_country_name</td><td>'.$data[$pd]['registrar']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="6014" style="display:none"><td>registrar_language_pref_1</td><td>'.$data[$pd]['registrar']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="6015" style="display:none"><td>registrar_language_pref_2</td><td>'.$data[$pd]['registrar']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="6016" style="display:none;vertical-align:top"><td>registrar_statuses</td><td>'.$data[$pd]['registrar']['statuses'].'</td><td></td></tr>';
	$html_text .= '<tr id="6017" style="display:none"><td>registrar_created_at</td><td>'.$data[$pd]['registrar']['created_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="6018" style="display:none"><td>registrar_latest_update_at</td><td>'.$data[$pd]['registrar']['latest_update_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="6019" style="display:none"><td>registrar_verification_received_at</td><td>'.$data[$pd]['registrar']['verification_received_at'].'</td><td id="registrar_verification_received_at"></td></tr>';
	$html_text .= '<tr id="6020" style="display:none"><td>registrar_verification_set_at</td><td>'.$data[$pd]['registrar']['verification_set_at'].'</td><td id="registrar_verification_set_at"></td></tr>';
	$html_text .= '<tr id="6021" style="display:none;vertical-align:top"><td>registrar_properties</td><td>'.$data[$pd]['registrar']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="6022" style="display:none;vertical-align:top"><td>registrar_remarks</td><td>'.$data[$pd]['registrar']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(63)">Name Servers +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="631" style="display:none;vertical-align:top"><td>ascii_names</td><td>'.$data[$pd]['name_servers']['ascii_names'].'</td><td></td></tr>';
	$html_text .= '<tr id="632" style="display:none;vertical-align:top"><td>unicode_names</td><td>'.$data[$pd]['name_servers']['unicode_names'].'</td><td></td></tr>';
	$html_text .= '<tr id="633" style="display:none;vertical-align:top"><td>ipv4_addresses</td><td>'.$data[$pd]['name_servers']['ipv4_addresses'].'</td><td id="name_servers_ip"></td></tr>';
	$html_text .= '<tr id="634" style="display:none;vertical-align:top"><td>ipv6_addresses</td><td>'.$data[$pd]['name_servers']['ipv6_addresses'].'</td><td></td></tr>';
	$html_text .= '<tr id="636" style="display:none;vertical-align:top"><td>statuses</td><td>'.$data[$pd]['name_servers']['statuses'].'</td><td id="br_zone"></td></tr>';
	$html_text .= '<tr id="635" style="display:none;vertical-align:top"><td>delegation_checks</td><td>'.$data[$pd]['name_servers']['delegation_checks'].'</td><td></td></tr>';
	$html_text .= '<tr id="637" style="display:none;vertical-align:top"><td>latest_correct_delegation_checks</td><td>'.$data[$pd]['name_servers']['latest_correct_delegation_checks'].'</td><td></td></tr>';
	$html_text .= '<tr><td>dnssec</td><td>'.$data[$pd]['name_servers']['dnssec'].'</td><td id="name_servers_dnssec"></td></tr>';
	$html_text .= '<tr><td>dnssec_algorithm</td><td>'.$data[$pd]['name_servers']['dnssec_algorithm'].'</td><td id="name_servers_dnssec_algorithm"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(70)">Raw Whois +/-</button></td><td colspan="2"></td></tr>';
	$html_text .= '<tr id="701" style="display:none"><td colspan="3">'.$data[$pd]['raw_whois'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(75)">Raw RDAP +/-</button></td><td id="raw_data_next" colspan="2"></td></tr>';
	$html_text .= '<tr id="751" style="display:none"><td colspan="3">'.$data[$pd]['raw_rdap'].'</td></tr>';
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