<?php
session_start();  // without Scriptcase PHP Generator
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
if (!empty(trim($_GET['domain'])))	{
	$_GET["domain"] = trim($_GET['domain']);
	$_GET["domain"] = str_replace("'", "", $_GET["domain"]);
	$vd = mb_strtolower($_GET["domain"]);
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
	$vd = 'domain';
}	
if (empty([ip]) or empty([block]))	{
	[ip] = getClientIP();
	[block] = get_block([ip]);
}
$internal = (str_contains([block],'Freedom')) ? 'internal_' : '';
$log_file = "/home/admin/logging/domain_lookup_tool_" . $internal . $datetime->format('Ym') . ".txt";
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
	else if (type == 29)	{ // metadata
		var pre = '29';
		var max = 10
	}
	else if (type == 30)	{ // domain
		var pre = '30';
		var max = 17
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
	else if (type == 45)	{ // fallback
		var pre = '45';
		var max = 9
	}
	else if (type == 50)	{ // reseller
		var pre = '50';
		var max = 21
	}	
	else if (type == 60)	{ // registrar
		var pre = '60';
		var max = 22
	}
	else if (type == 61)	{ // abuse
		var pre = '61';
		var max = 9
	}
	else if (type == 63)	{ // name servers
		var pre = '63';
		var max = 12
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
	if (translation == 99)	{
		var modified = '';
		var proposed = '';
		var accessible = '';
		var legacy = '';
		document.getElementById("title").textContent = "Domain Data Request";
		document.getElementById("subtitle").textContent = "RDAPv1 based modeling";
		document.getElementById("instruction").textContent = "Fill in and press Enter to retrieve.";
		document.getElementById("modeling").textContent = "";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "";
		document.getElementById("notices_role").textContent = legacy;
		document.getElementById("links_role").textContent = legacy;
		document.getElementById("metadata_role").textContent = proposed;
		document.getElementById("metadata_object_class_name").textContent = modified;
		document.getElementById("metadata_object_conformance").textContent = modified;
		document.getElementById("metadata_terms_and_conditions").textContent = proposed;
		document.getElementById("metadata_global_json_response_url").textContent = proposed;
		document.getElementById("metadata_registry_json_response_url").textContent = proposed;
		document.getElementById("metadata_registry_language_codes").textContent = legacy;
		document.getElementById("metadata_registrar_accreditation").textContent = modified;
		document.getElementById("metadata_registrar_json_response_url").textContent = proposed;
		document.getElementById("metadata_registrar_complaint_url").textContent = proposed;
		document.getElementById("metadata_status_explanation_url").textContent = proposed;
		document.getElementById("metadata_resource_upload_at").textContent = modified;
		document.getElementById("domain_role").textContent = "";
		document.getElementById("domain_ascii_name").textContent = "";
		document.getElementById("domain_unicode_name").textContent = "";
		document.getElementById("domain_statuses").textContent = modified;
		document.getElementById("domain_created_at").textContent = "";
		document.getElementById("domain_expiration_at").textContent = "";
		document.getElementById("domain_recoverable_until").textContent = proposed;
		document.getElementById("domain_deletion_at").textContent = "";
		document.getElementById("domain_extensions").textContent = "";		
		document.getElementById("sponsor_role").textContent = "";
		document.getElementById("registrant_role").textContent = "";
		document.getElementById("registrant_server_handle").textContent = proposed;
		document.getElementById("registrant_client_handle").textContent = "";
		document.getElementById("registrant_web_id").textContent = proposed;
		document.getElementById("registrant_organization_type").textContent = "";
		document.getElementById("registrant_organization_name").textContent = "";
		document.getElementById("registrant_presented_name").textContent = "";
		document.getElementById("registrant_kind").textContent = "";
		document.getElementById("registrant_name").textContent = "";
		document.getElementById("registrant_country_code").textContent = "";
		document.getElementById("registrant_street_address").textContent = "";
		document.getElementById("registrant_postal_code").textContent = "";
		document.getElementById("registrant_country_name").textContent = "";
		document.getElementById("registrant_verification_received_at").textContent = proposed;
		document.getElementById("registrant_verification_set_at").textContent = proposed;
		document.getElementById("administrative_role").textContent = "";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_role").textContent = "";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_role").textContent = "";
		document.getElementById("emergency_role").textContent = "";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("fallback_role").textContent = proposed;
		document.getElementById("reseller_role").textContent = "";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;
		document.getElementById("registrar_role").textContent = "";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;
		document.getElementById("abuse_role").textContent = "";
		document.getElementById("abuse_telephone").textContent = "";
		document.getElementById("name_servers_dnssec_signed").textContent = "";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "";
		document.getElementById("name_servers_ipv4_addresses").textContent = "";
		document.getElementById("name_servers_ipv6_addresses").textContent = "";
		document.getElementById("br_zone").textContent = "";
		document.getElementById("raw_data_next").textContent = "";
	}
	else if (translation == 1)	{
		var modified = '(Gewijzigd) ';
		var proposed = '(Nieuw) ';
		var accessible = 'Nieuwe velden moeten de bruikbaarheid vergroten en voor duidelijkheid zorgen.';
		var legacy = '(Legacy) ';
		document.getElementById("title").textContent = "Domein Gegevens opvragen";
		document.getElementById("subtitle").textContent = "RDAPv1-gebaseerde modellering";
		document.getElementById("instruction").textContent = "Typ een domeinnaam en druk op Enter.";
		document.getElementById("modeling").textContent = "Een RDAPv2 kan onbepaalde statussen elimineren en ccTLD-proof zijn via een nieuwe globale tabeldefinitie in snake_case.";
		document.getElementById("field").textContent = "Omschrijving";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Een overzicht van en toelichting op de structuur en kenmerken van webdomeinen.";
		document.getElementById("notices_role").textContent = legacy + accessible;
		document.getElementById("links_role").textContent = legacy + accessible;
		document.getElementById("metadata_role").textContent = proposed + "Metadata bieden context en details over data-elementen.";
		document.getElementById("metadata_object_class_name").textContent = modified;
		document.getElementById("metadata_object_conformance").textContent = modified;
		document.getElementById("metadata_terms_and_conditions").textContent = proposed + "Verbeterde machineleesbare IANA TLD-gegevens (PostgreSQL JSON-gestructureerd)";
		document.getElementById("metadata_global_json_response_url").textContent = proposed + "URL van de geplande JSON-respons van de globale RDAP-server.";
		document.getElementById("metadata_registry_json_response_url").textContent = proposed + "URL van de JSON-respons op registratieniveau.";
		document.getElementById("metadata_registry_language_codes").textContent = legacy + "Ondanks de update blijft het veld zonder functioneel nut.";	
		document.getElementById("metadata_registrar_accreditation").textContent = modified + "Er kan een IANA Registrar Accreditation ID voor gTLD's bestaan. Deze moet correct zijn.";
		document.getElementById("metadata_registrar_json_response_url").textContent = proposed + 'Indien van toepassing, moet de RDAP-bron-URL van de registrar machine-leesbaar worden.';
		document.getElementById("metadata_registrar_complaint_url").textContent = proposed + 'Vereist indien de registrator geaccrediteerd is door IANA, om een klacht in behandeling te kunnen nemen.';		
		document.getElementById("metadata_status_explanation_url").textContent = proposed + 'Vereist als de registrar IANA-geaccrediteerd is; bevat uitleg over de statuscode.';
		document.getElementById("metadata_resource_upload_at").textContent = modified + "Datum en tijd van RDAP-database-update in uniforme Zulu-tijd (UTC).";
		document.getElementById("domain_role").textContent = "Een domein onder TLD-niveau is wereldwijd uniek en kan vrij worden gekozen onder bepaalde regels.";
		document.getElementById("domain_ascii_name").textContent = "Voor speciale tekens bevatten de ASCII-tekenreeksen Punycode-transcriptie.";
		document.getElementById("domain_unicode_name").textContent = "Optioneel veld dat, indien van toepassing, de Unicode-weergave van het domein biedt.";
		document.getElementById("domain_statuses").textContent = modified + "RDAP zelf garandeert niet of status van registry, registrar, of lifecycle is — uit te filteren.";
		document.getElementById("domain_created_at").textContent = "De datumvelden staan hier in een logische volgorde. Dit is ook eenvoudig in de JSON-array.";
		document.getElementById("domain_expiration_at").textContent = "Eindtijd voor verlenging of van publicatie, daarna neemt de betrokkenheid van de registrar af.";
		document.getElementById("domain_recoverable_until").textContent = proposed + "Laatste hersteldatum, gebaseerd op domain_expiration_at + pending_redemption_days.";
		document.getElementById("domain_deletion_at").textContent = "Datum en tijdstip gepland voor volledige verwijdering. Er kan een laatste verwijderingsfase zijn.";
		document.getElementById("domain_extensions").textContent = "'Eligibility': Hoe het domein voldoet aan specifieke eisen van de TLD-rootzone.";		
		document.getElementById("sponsor_role").textContent = "De domeinregistratie kan worden beheerd door een sponsor. Zie bijvoorbeeld france.fr.";
		document.getElementById("registrant_role").textContent = "De domeingebruiker die de daadwerkelijke of effectieve controle heeft voor domeinrecht in het land van vestiging.";
		document.getElementById("registrant_server_handle").textContent = proposed + "Zonder deze identificatie kan een wereldwijde RDAP-server niet worden bijgewerkt.";
		document.getElementById("registrant_client_handle").textContent = 'Bij "janwillemstegink.nl" toont de registrar vertrouwelijke informatie met "STE135420-TRAP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Webidentificatienummer voor bedrijfsentiteiten en natuurlijke personen.";
		document.getElementById("registrant_organization_type").textContent = 'De gebruikelijke waarde is "work", of mogelijk "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "De juridische naam van de organisatie die primair verantwoordelijk is voor het domeinabonnement.";
		document.getElementById("registrant_presented_name").textContent = "Geldig is de naam van een primair verantwoordelijke persoon of een rol binnen de organisatie.";
		document.getElementById("registrant_kind").textContent = "Leeg / 'org' / 'individual' (Voor continuïteit: levenstestament + testament + digitale executeur)";
		document.getElementById("registrant_name").textContent = "Een persoonlijke naam kan openbaar zichtbaar zijn in het veld 'presented_name'. Zie bijvoorbeeld cira.ca.";
		document.getElementById("registrant_country_code").textContent = "De ISO-2-landcode-indexering werkt, bijvoorbeeld voor het Verenigd Koninkrijk, dat de EU heeft verlaten.";
		document.getElementById("registrant_street_address").textContent = "Het afschermen van adresgegevens zoals bij example.tel, resulteert in rommelige gegevens.";
		document.getElementById("registrant_postal_code").textContent = "Indexeren op postcode is in de database noodzakelijk. De vCard-array vormt een obstakel.";
		document.getElementById("registrant_country_name").textContent = "Een openbaar zichtbare landnaam is beperkt tot een 'Registrar Lookup via RDAP' (ontwerpwijziging).";
		document.getElementById("registrant_verification_received_at").textContent = proposed + "Na identificatie kan een overeenkomende web-ID worden bevestigd, leeg is intrekking.";
		document.getElementById("registrant_verification_set_at").textContent = proposed + "Vervolgens verifieert de registry de gegevens bij de landspecifieke webdomeindienst.";
		document.getElementById("administrative_role").textContent = "Het administratief aanspreekpunt beantwoordt een verzoek en stuurt zo nodig door.";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_role").textContent = "Een technisch contact reageert om een gemelde storing op te lossen.";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_role").textContent = "Sommige domain registries houden gegevens bij om hun facturering uit te voeren.";
		document.getElementById("emergency_role").textContent = proposed + "Een verantwoordelijke persoon kan de benodigde toegang verlenen.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("fallback_role").textContent = proposed + "Contact dat wordt gebruikt wanneer rolgegevens niet openbaar zichtbaar zijn.";		
		document.getElementById("reseller_role").textContent = "De domeinreseller is als tweede verantwoordelijk, ook afhankelijk van de overeenkomst en de regelgeving.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;
		document.getElementById("registrar_role").textContent = "De domeinregistrar is verantwoordelijk voor domeinreserveringen en IP-adresroutering.";
		document.getElementById("registrar_web_id").textContent = proposed
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;
		document.getElementById("abuse_role").textContent = "Informatie over hoe een derde partij contact kan opnemen met de registrar of belaste partij. Zie fryslan.frl.";
		document.getElementById("abuse_telephone").textContent = "Een telefoonnummer moet beginnen met het type. Toegestaan zijn in ieder geval 'voice' en 'fax'.";
		document.getElementById("name_servers_dnssec_signed").textContent = "DNSSEC beveiligt DNS tegen spoofing en cachevergiftiging.";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Algoritmen 13, 14, 15 en 16 vormen de aanbevolen basislijn voor DNSSEC-compliance.";
		document.getElementById("name_servers_ipv4_addresses").textContent = "Een glue-record is een DNS-record dat wordt meegegeven door de bovenliggende zone, ook al is die daar niet";
		document.getElementById("name_servers_ipv6_addresses").textContent = "autoritatief voor, om cirkelafhankelijke resoluties van nameservers binnen de onderliggende zone te voorkomen.";
		document.getElementById("br_zone").textContent = "TLD .br: De RDAP-gegevens zijn aangepast met nameservervalidatie.";
		document.getElementById("raw_data_next").textContent = "De rollen zijn hier gerangschikt op verantwoordelijkheid. 'None Specified' komt van deze tool. Een JSON-structuur kan ook zo leesbaar zijn als XML.";
	}
	else if (translation == 2)	{
		var modified = '(Modified) ';
		var proposed = '(New) ';
		var accessible = 'New fields should boost usability and bring clarity.';
		var legacy = '(Legacy) ';
		document.getElementById("title").textContent = "Domain Data Request";
		document.getElementById("subtitle").textContent = "RDAPv1 based modeling";
		document.getElementById("instruction").textContent = "Type a domain, then press Enter.";
		document.getElementById("modeling").textContent = "An RDAPv2 can eliminate indeterminate statuses and be ccTLD-proof via a new global table definition in snake_case.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "An overview of the structure and key characteristics of domain data.";
		document.getElementById("notices_role").textContent = legacy + accessible;
		document.getElementById("links_role").textContent = legacy + accessible;
		document.getElementById("metadata_role").textContent = proposed + "Metadata provides context and details about data elements.";
		document.getElementById("metadata_object_class_name").textContent = modified;
		document.getElementById("metadata_object_conformance").textContent = modified;
		document.getElementById("metadata_terms_and_conditions").textContent = proposed + "Improved Machine-Readable IANA TLD Data (PostgreSQL JSON-Structured)";
		document.getElementById("metadata_global_json_response_url").textContent = proposed + "URL of the planned global RDAP server JSON response.";
		document.getElementById("metadata_registry_json_response_url").textContent = proposed + "URL of the JSON response at the registry level.";
		document.getElementById("metadata_registry_language_codes").textContent = legacy + "Despite the update, the field remains without functional use.";
		document.getElementById("metadata_registrar_accreditation").textContent = modified + "There may be an IANA Registrar Accreditation ID for gTLDs. It must be correct.";
		document.getElementById("metadata_registrar_json_response_url").textContent = proposed + 'If applicable, the RDAP-source registrar URL should become machine-readable.';
		document.getElementById("metadata_registrar_complaint_url").textContent = proposed + 'Required if the registrar is accredited by IANA, in order to have a complaint handled.';		
		document.getElementById("metadata_status_explanation_url").textContent = proposed + 'Required if the registrar is IANA-accredited; provides status code explanations.';
		document.getElementById("metadata_resource_upload_at").textContent = modified + "Date and time of RDAP database update in uniform Zulu time (UTC).";
		document.getElementById("domain_role").textContent = "A domain below TLD level is globally unique and can be freely chosen under certain rules.";
		document.getElementById("domain_ascii_name").textContent = "For special characters, the ASCII character strings contain Punycode transcription.";
		document.getElementById("domain_unicode_name").textContent = "Optional field that provides the Unicode representation of the domain, if applicable.";
		document.getElementById("domain_statuses").textContent = modified + "RDAP itself doesn’t guarantee showing if status is registry, registrar, or lifecycle — to filter out.";
		document.getElementById("domain_created_at").textContent = "The date fields are here in a logical order. This is also easy in the JSON array.";
		document.getElementById("domain_expiration_at").textContent = "End time for renewal or publication, after which registrar involvement decreases.";
		document.getElementById("domain_recoverable_until").textContent = proposed + "Last date recovery is allowed, based on domain_expiration_at + pending_redemption_days.";
		document.getElementById("domain_deletion_at").textContent = "Date and time scheduled for complete deletion. A final deletion phase may exist.";
		document.getElementById("domain_extensions").textContent = "'Eligibility': How the domain meets specific TLD root zone requirements.";
		document.getElementById("sponsor_role").textContent = "The domain registration can be managed by a sponsor. See for example france.fr.";
		document.getElementById("registrant_role").textContent = "The domain user who has the actual or effective control for domain rights in the country of establishment.";
		document.getElementById("registrant_server_handle").textContent = proposed + "Without this identifier, a global RDAP server cannot be updated.";
		document.getElementById("registrant_client_handle").textContent = 'At "janwillemstegink.nl" the registrar shows confidential information with "STE135420-TRAP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Web Identification number for business entities and natural persons.";
		document.getElementById("registrant_organization_type").textContent = 'The usual value is "work", or possibly "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "The legal name of the organization primarily responsible for the domain subscription.";
		document.getElementById("registrant_presented_name").textContent = "Valid is the name of a primarily responsible person or a role within the organization.";
		document.getElementById("registrant_kind").textContent = "Empty / 'org' / 'individual' (For continuity: Living Will + Will + Digital Executor)";
		document.getElementById("registrant_name").textContent = "A personal name may be publicly visible in the 'presented_name' field. See for example cira.ca.";
		document.getElementById("registrant_country_code").textContent = "ISO-2 country code indexing works, as for the United Kingdom, which has left the EU.";
		document.getElementById("registrant_street_address").textContent = "Shielding address data as with example.tel, results in messy data.";
		document.getElementById("registrant_postal_code").textContent = "Indexing by postal code is necessary in the database. The Vcard array is an obstacle.";	
		document.getElementById("registrant_country_name").textContent = "A publicly visible country name is limited to a 'Registrar Lookup via RDAP' (design change).";
		document.getElementById("registrant_verification_received_at").textContent = proposed + "After identification, a matching web ID can be confirmed, empty is revocation.";
		document.getElementById("registrant_verification_set_at").textContent = proposed + "The registry then verifies the data with the country-specific web domain service.";	
		document.getElementById("administrative_role").textContent = "The administratively responsible desk answers a request, and forwards on if necessary.";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_role").textContent = "A technical contact responds to resolve a reported malfunction.";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_role").textContent = "Some domain registries maintain records to perform their billing.";
		document.getElementById("emergency_role").textContent = proposed + "A responsible person can provide the necessary access.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("fallback_role").textContent = proposed + "Contact used if role data is not publicly visible.";
		document.getElementById("reseller_role").textContent = "The domain reseller is secondly responsible, also depending on the agreement and regulations.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;		
		document.getElementById("registrar_role").textContent = "The domain registrar is responsible for domain reservations and IP address routing.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;
		document.getElementById("abuse_role").textContent = "Information on how a third party can contact the registrar or entrusted party. See fryslan.frl.";
		document.getElementById("abuse_telephone").textContent = "A telephone number must begin with the type. Allowed are anyway 'voice' and 'fax'.";
		document.getElementById("name_servers_dnssec_signed").textContent = "DNSSEC secures DNS against spoofing and cache poisoning.";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Algorithms 13, 14, 15, and 16 are the recommended baseline for DNSSEC compliance.";
		document.getElementById("name_servers_ipv4_addresses").textContent = "A glue record is a DNS record provided by the parent zone, even though it is not authoritative for it,";
		document.getElementById("name_servers_ipv6_addresses").textContent = "to prevent circular dependencies when resolving nameservers within the child zone.";
		document.getElementById("br_zone").textContent = "TLD .br: The RDAP data has been modified with name server validation.";
		document.getElementById("raw_data_next").textContent = "The roles here are arranged according to responsibility. 'None Specified' comes from this tool. A JSON structure can also be as readable as XML.";
	}
	else if (translation == 3)	{
		var modified = '(Geändert) ';
		var proposed = '(Neu) ';
		var accessible = 'Neue Felder sollten die Benutzerfreundlichkeit verbessern und für Klarheit sorgen.';
		var legacy = '(Legacy) ';
		document.getElementById("title").textContent = "Domänendatenanforderung";
		document.getElementById("subtitle").textContent = "RDAPv1-basierte Modellierung";
		document.getElementById("instruction").textContent = "Geben Sie eine Domain ein und drücken Sie Enter.";
		document.getElementById("modeling").textContent = "Ein RDAPv2 kann unbestimmte Statuswerte eliminieren und ccTLD-sicher sein durch eine neue globale Tabellendefinition in snake_case.";
		document.getElementById("field").textContent = "Beschreibung";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Eine Übersicht und Erklärung zur Struktur und den Eigenschaften von Webdomänen.";
		document.getElementById("notices_role").textContent = legacy + accessible;
		document.getElementById("links_role").textContent = legacy + accessible;
		document.getElementById("metadata_role").textContent = proposed + "Metadaten liefern Kontext und Details zu Datenelementen.";
		document.getElementById("metadata_object_class_name").textContent = modified;
		document.getElementById("metadata_object_conformance").textContent = modified;
		document.getElementById("metadata_terms_and_conditions").textContent = proposed + "Verbesserte maschinenlesbare IANA-TLD-Daten (PostgreSQL-JSON-strukturiert)";
		document.getElementById("metadata_global_json_response_url").textContent = proposed + "URL der geplanten JSON-Antwort des globalen RDAP-Servers.";
		document.getElementById("metadata_registry_json_response_url").textContent = proposed + "URL der JSON-Antwort auf Registry-Ebene.";
		document.getElementById("metadata_registry_language_codes").textContent = legacy + "Trotz der Aktualisierung bleibt das Feld ohne funktionalen Nutzen.";
		document.getElementById("metadata_registrar_accreditation").textContent = modified + "Für gTLDs kann eine IANA-Registrar-Akkreditierungs-ID vorhanden sein. Diese muss korrekt sein.";
		document.getElementById("metadata_registrar_json_response_url").textContent = proposed + 'Falls zutreffend, sollte die RDAP-Quell-URL des Registrars maschinenlesbar werden.';
		document.getElementById("metadata_registrar_complaint_url").textContent = proposed + 'Erforderlich, wenn der Registrar von der IANA akkreditiert ist, um eine Beschwerde bearbeiten zu lassen.';
		document.getElementById("metadata_status_explanation_url").textContent = proposed + 'Erforderlich, wenn der Registrar IANA-akkreditiert ist; bietet Erklärungen zum Statuscode.';
		document.getElementById("metadata_resource_upload_at").textContent = modified + "Datum und Uhrzeit der RDAP-Datenbankaktualisierung in einheitlicher Zulu-Zeit (UTC).";
		document.getElementById("domain_role").textContent = "Eine Domain unterhalb der TLD-Ebene ist weltweit eindeutig und kann unter bestimmten Regeln frei gewählt werden.";
		document.getElementById("domain_ascii_name").textContent = "Für Sonderzeichen enthalten die ASCII-Zeichenfolgen eine Punycode-Transkription.";
		document.getElementById("domain_unicode_name").textContent = "Optionales Feld, das gegebenenfalls die Unicode-Darstellung der Domäne bereitstellt.";
		document.getElementById("domain_statuses").textContent = modified + "RDAP garantiert nicht, ob Status von Registry, Registrar, oder Lifecycle stammt — herauszufiltern.";
		document.getElementById("domain_created_at").textContent = "Die Datumsfelder stehen hier in einer logischen Reihenfolge. Auch dies ist im JSON-Array einfach.";
		document.getElementById("domain_expiration_at").textContent = "Eine Wiederherstellung ist erst ab dem Ablaufdatum der Domain + Tagen der Rücknahmefrist möglich.";
		document.getElementById("domain_recoverable_until").textContent = proposed + "Letzter möglicher Wiederherstellungstag, basierend auf domain_expiration_at + pending_redemption_days.";
		document.getElementById("domain_deletion_at").textContent = "Datum und Uhrzeit für die vollständige Löschung geplant. Es kann eine abschließende Löschphase geben.";
		document.getElementById("domain_extensions").textContent = "'Eligibility': Wie die Domain die spezifischen Anforderungen der TLD-Rootzone erfüllt.";
		document.getElementById("sponsor_role").textContent = "Die Domänenregistrierung kann von einem Sponsor verwaltet werden. Siehe beispielsweise france.fr.";
		document.getElementById("registrant_role").textContent = "Der Domänenbenutzer, der die tatsächliche oder effektive Kontrolle hat für Domainrechte im Wohnsitzland.";
		document.getElementById("registrant_server_handle").textContent = proposed + "Ohne diese Kennung kann ein globaler RDAP-Server nicht aktualisiert werden.";
		document.getElementById("registrant_client_handle").textContent = 'Bei "janwillemstegink.nl" zeigt der Registrar vertrauliche Informationen mit "STE135420-TRAP" an.';
		document.getElementById("registrant_web_id").textContent = proposed + "Web-Identifikationsnummer für Unternehmen und natürliche Personen.";
		document.getElementById("registrant_organization_type").textContent = 'Der übliche Wert ist "work" oder möglicherweise "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "Der offizielle Name der Organisation, die hauptsächlich für das Domänenabonnement verantwortlich ist.";
		document.getElementById("registrant_presented_name").textContent = "Gültig ist der Name einer hauptverantwortlichen Person oder einer Rolle innerhalb der Organisation.";
		document.getElementById("registrant_kind").textContent = "Leer / 'org' / 'individual' (Für Kontinuität: Patientenverfügung + Testament + digitaler Testamentsvollstrecker)";
		document.getElementById("registrant_name").textContent = "Ein Personenname kann im Feld 'presented_name' öffentlich sichtbar sei. Siehe beispielsweise cira.ca.";
		document.getElementById("registrant_country_code").textContent = "Die Indizierung mit dem ISO-2-Ländercode funktioniert, wie für das Vereinigte Königreich, das die EU verlassen hat.";
		document.getElementById("registrant_street_address").textContent = "Das Abschirmen von Adressdaten wie bei example.tel, führt zu unordentlichen Daten.";
		document.getElementById("registrant_postal_code").textContent = "In der Datenbank ist eine Indizierung nach Postleitzahl erforderlich. Das vCard-Array stellt ein Hindernis dar.";	
		document.getElementById("registrant_country_name").textContent = "Ein öffentlich sichtbarer Ländername ist auf eine 'Registrar Lookup via RDAP' beschränkt (Designänderung).";
		document.getElementById("registrant_verification_received_at").textContent = proposed + "Nach der Identifizierung kann eine passende Web-ID bestätigt werden, leer ist der Widerruf.";
		document.getElementById("registrant_verification_set_at").textContent = proposed + "Anschließend verifiziert die Registry die Daten beim länderspezifischen Webdomänendienst.";
		document.getElementById("administrative_role").textContent = "Die administrativ zuständige Stelle beantwortet eine Anfrage und leitet sie gegebenenfalls weiter.";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_role").textContent = "Ein technischer Kontakt reagiert, um eine gemeldete Störung zu beheben.";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_role").textContent = "Einige Domänenregistrierungen führen Aufzeichnungen, um ihre Abrechnung durchzuführen.";
		document.getElementById("emergency_role").textContent = proposed + "Die erforderlichen Zugänge kann eine verantwortliche Person bereitstellen.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("fallback_role").textContent = proposed + "Kontakt, der verwendet wird, wenn Rollendaten nicht öffentlich sichtbar sind.";
		document.getElementById("reseller_role").textContent = "In zweiter Linie ist der Domain-Reseller, ebenfalls je nach Vereinbarung und Regelungen, verantwortlich.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;		
		document.getElementById("registrar_role").textContent = "Der Domänenregistrar ist für die Domänenreservierung und das IP-Adressrouting verantwortlich.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;
		document.getElementById("abuse_role").textContent = "Informationen darüber, wie Dritte den Registrar oder die beauftragte Partei kontaktieren können. Siehe fryslan.frl.";
		document.getElementById("abuse_telephone").textContent = "Eine Telefonnummer muss mit dem Typ beginnen. Erlaubt sind grundsätzlich 'voice' und 'fax'.";		
		document.getElementById("name_servers_dnssec_signed").textContent = "DNSSEC sichert DNS gegen Spoofing und Cache-Poisoning.";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Die Algorithmen 13, 14, 15 und 16 sind die empfohlene Basis für DNSSEC-Compliance.";
		document.getElementById("name_servers_ipv4_addresses").textContent = "Ein Glue-Record ist ein DNS-Eintrag, den die übergeordnete Zone bereitstellt, obwohl sie nicht autoritativ ist,";
		document.getElementById("name_servers_ipv6_addresses").textContent = "um zirkuläre Abhängigkeiten bei der Auflösung von Nameservern in der untergeordneten Zone zu verhindern.";		
		document.getElementById("br_zone").textContent = "TLD .br: Die RDAP-Daten wurden mit der Nameserver-Validierung angepasst.";
		document.getElementById("raw_data_next").textContent = "Die Rollen sind hierbei nach Verantwortung verteilt. 'None Specified' stammt von diesem Tool. Eine JSON-Struktur kann auch genauso lesbar sein wie XML.";
	}
	else if (translation == 4)	{
		var modified = '(Modifié) ';
		var proposed = '(Nouveau) ';
		var accessible = "Les nouveaux champs devraient améliorer l’utilisabilité et apporter de la clarté.";
		var legacy = '(Legacy) ';
		document.getElementById("title").textContent = "Demande de données de domaine";
		document.getElementById("subtitle").textContent = "Modélisation basée sur RDAPv1";
		document.getElementById("instruction").textContent = "Saisissez un nom de domaine, puis appuyez sur Entrée.";
		document.getElementById("modeling").textContent = "Un RDAPv2 peut éliminer les statuts indéterminés et être ccTLD-compatible en adoptant une nouvelle définition globale de table en snake_case.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Détail";
		document.getElementById("explanation").textContent = "Un aperçu et une explication de la structure et des caractéristiques des domaines Web.";
		document.getElementById("notices_role").textContent = legacy + accessible;
		document.getElementById("links_role").textContent = legacy + accessible;
		document.getElementById("metadata_role").textContent = proposed + "Les métadonnées fournissent le contexte et des détails sur les éléments de données.";
		document.getElementById("metadata_object_class_name").textContent = modified;
		document.getElementById("metadata_object_conformance").textContent = modified;
		document.getElementById("metadata_terms_and_conditions").textContent = proposed + "Données TLD IANA améliorées et lisibles par machine (structurées en JSON pour PostgreSQL)";
		document.getElementById("metadata_global_json_response_url").textContent = proposed + "URL de la réponse JSON prévue du serveur RDAP global.";
		document.getElementById("metadata_registry_json_response_url").textContent = proposed + "URL de la réponse JSON au niveau du registre.";
		document.getElementById("metadata_registry_language_codes").textContent = legacy + "Malgré la mise à jour, le champ reste sans utilité fonctionnelle.";
		document.getElementById("metadata_registrar_accreditation").textContent = modified + "Il peut exister un identifiant d'accréditation IANA pour les gTLD. Il doit être correct.";
		document.getElementById("metadata_registrar_json_response_url").textContent = proposed + "Le cas échéant, l’URL source RDAP du registraire devrait devenir lisible par machine.";
		document.getElementById("metadata_registrar_complaint_url").textContent = proposed + "Obligatoire si le registraire est accrédité par l'IANA, afin de pouvoir traiter une plainte.";
		document.getElementById("metadata_status_explanation_url").textContent = proposed + "Obligatoire si le registraire est accrédité par l'IANA ; fournit des explications sur le code de statut.";
		document.getElementById("metadata_resource_upload_at").textContent = modified + "Date et heure de mise à jour de la base de données RDAP en heure Zulu uniforme (UTC).";
		document.getElementById("domain_role").textContent = "Un domaine inférieur au niveau TLD est unique au monde et peut être choisi librement selon certaines règles.";
		document.getElementById("domain_ascii_name").textContent = "Pour les caractères spéciaux, les chaînes de caractères ASCII contiennent une transcription Punycode.";
		document.getElementById("domain_unicode_name").textContent = "Champ facultatif qui fournit la représentation Unicode du domaine, le cas échéant.";
		document.getElementById("domain_statuses").textContent = modified + "Les statuts ne garantissent pas que RDAP indique registre, registrar, ou cycle — pour filtrer.";
		document.getElementById("domain_created_at").textContent = "Les champs de date sont ici classés dans un ordre logique. C'est également facile dans le tableau JSON.";
		document.getElementById("domain_expiration_at").textContent = "Date limite de renouvellement ou de publication, après laquelle l'implication du registraire diminue.";
		document.getElementById("domain_recoverable_until").textContent = proposed + "Dernier jour de récupération, basé sur domain_expiration_at + pending_redemption_days.";
		document.getElementById("domain_deletion_at").textContent = "Date et heure prévues pour la suppression complète. Une phase de suppression finale peut exister.";
		document.getElementById("domain_extensions").textContent = "'Eligibility' : comment le domaine répond aux exigences spécifiques de la zone racine TLD.";
		document.getElementById("sponsor_role").textContent = "L'enregistrement du domaine peut être géré par un sponsor. Voir par exemple france.fr.";
		document.getElementById("registrant_server_handle").textContent = proposed + "Sans cet identifiant, un serveur RDAP global ne peut pas être mis à jour.";
		document.getElementById("registrant_role").textContent = "L'utilisateur du domaine qui a le contrôle réel ou effectif pour les droits de domaine dans le pays de résidence.";
		document.getElementById("registrant_client_handle").textContent = 'Sur "janwillemstegink.nl", le registraire affiche des informations confidentielles avec "STE135420-TRAP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Numéro d’identification Web pour les entités commerciales et les personnes physiques.";
		document.getElementById("registrant_organization_type").textContent = 'La valeur habituelle est "work", ou éventuellement "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "Le nom légal de l'organisation principalement responsable de l'abonnement au domaine.";
		document.getElementById("registrant_presented_name").textContent = "Valide est le nom d'une personne principalement responsable ou d'un rôle au sein de l'organisation.";
		document.getElementById("registrant_kind").textContent = "Vide / 'org' / 'individual' (Pour la continuité : testament biologique + testament + exécuteur testamentaire numérique)";
		document.getElementById("registrant_name").textContent = "Un nom personnel peut être visible publiquement dans le champ 'presented_name'. Voir, par exemple, cira.ca.";
		document.getElementById("registrant_country_code").textContent = "L'indexation des codes pays ISO-2 fonctionne, comme pour le Royaume-Uni, qui a quitté l'UE.";
		document.getElementById("registrant_street_address").textContent = "Le blindage des données d'adresse comme avec example.tel, génère des données désordonnées.";
		document.getElementById("registrant_postal_code").textContent = "L'indexation par code postal est nécessaire dans la base de données. Le tableau de vCard constitue un obstacle.";
		document.getElementById("registrant_country_name").textContent = "Un nom de pays visible publiquement est limité à une 'Registrar Lookup via RDAP' (changement de conception).";
		document.getElementById("registrant_verification_received_at").textContent = proposed + "Après identification, un identifiant Web correspondant peut être confirmé, vide signifie révocation.";
		document.getElementById("registrant_verification_set_at").textContent = proposed + "Le registre vérifie ensuite les données avec le service de domaine Web spécifique au pays.";
		document.getElementById("administrative_role").textContent = "Le bureau administrativement responsable répond à une demande, et la transmet si nécessaire.";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_role").textContent = "Un contact technique répond pour résoudre un dysfonctionnement signalé.";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_role").textContent = "Certains registres de domaine conservent des enregistrements pour effectuer leur facturation.";
		document.getElementById("emergency_role").textContent = proposed + "Une personne responsable peut fournir l'accès nécessaire.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("fallback_role").textContent = proposed + "Contact utilisé lorsque les données de rôle ne sont pas visibles publiquement.";
		document.getElementById("reseller_role").textContent = "Le revendeur de domaine est en second lieu responsable, également en fonction de l'accord et des réglementations.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;		
		document.getElementById("registrar_role").textContent = "Le registraire de domaine est responsable des réservations de domaines et du routage des adresses IP.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;
		document.getElementById("abuse_role").textContent = "Informations sur la manière dont un tiers peut contacter le registraire ou la partie mandatée. Voir fryslan.frl.";
		document.getElementById("abuse_telephone").textContent = "Un numéro de téléphone doit commencer par le type. Sont autorisés de toute façon 'voice' et 'fax'.";
		document.getElementById("name_servers_dnssec_signed").textContent = "DNSSEC sécurise le DNS contre le spoofing et l’empoisonnement.";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Les algorithmes 13, 14, 15 et 16 constituent la base recommandée pour la conformité DNSSEC.";
		document.getElementById("name_servers_ipv4_addresses").textContent = "Un glue record est un enregistrement DNS fourni par la zone parente, bien qu’elle n’en soit pas autoritaire,";
		document.getElementById("name_servers_ipv6_addresses").textContent = "afin d’éviter les dépendances circulaires lors de la résolution des serveurs de noms de la zone enfant.";		
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
$server_url = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
$server_url .= '://'. $_SERVER['HTTP_HOST'];
$server_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);	
$server_url = dirname($server_url);
$rdap_url = $server_url.'/compose_domain/index.php?batch=0&domain='.$pd;
if (@get_headers($rdap_url))	{ // the application to compose data
	$json = file_get_contents($rdap_url) or die("An entered domain could not be read.");
	$data = json_decode($json, true);
	$terms_and_conditions = $server_url.'/modeling_tld/index.php?language='.$viewlanguage.'&tld='.$data[$pd]['metadata']['zone_identifier'];
	$raw_whois = $server_url.'/domain_whois/index.php?language='.$viewlanguage.'&domain='.$vd;
}
if	(is_null($data))	{
	$terms_and_conditions = '';
	$raw_whois = '';
	$reopen = $server_url.'/modeling_domain/index.php?batch=0&domain=domain';
	sc_redir($reopen);
}
$html_text = '<body onload=SwitchTranslation('.$viewlanguage.')><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem; table-layout: fixed; width:1375px">
<tr><th style="width:325px"></th><th style="width:300px"></th><th style="width:750px"></th></tr>';
$html_text .= '<tr style="font-size: .8rem"><td id="title" style="font-size: 1.3rem;color:blue;font-weight:bold"></td><td id="instruction"></td><td id="modeling"></td></tr>';
$html_text .= '<tr style="font-size: .8rem"><td id="subtitle" style="font-size: 1.0rem;color:blue;font-weight:bold"></td><td><form action='.htmlentities($_SERVER['PHP_SELF']).' method="get">
	<input type="hidden" id="language" name="language" value='.$viewlanguage.'>	
	<input type="text" style="width:90%" id="domain" name="domain" value='.$vd.'></form></td><td>
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(99)">None</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(1)">nl_NL</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(2)">en_US</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(3)">de_DE</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(4)">fr_FR</button> 
	<a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_email" target="_blank">Email modeling</a> - <a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap.hostingtool.nl" target="_blank">Code/issues on GitHub</a> - <a style="font-size: 0.9rem" href="https://janwillemstegink.nl/" target="_blank">Insight at janwillemstegink.nl</a></td></tr>';
//echo $pd.'#'.$data[$pd]['domain']['ascii_name'];
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
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(29)">Metadata +/-</button></td><td></td><td id="metadata_role"></td></tr>';
	$html_text .= '<tr id="291" style="display:none"><td>object_class_name</td><td>'.$data[$pd]['metadata']['object_class_name'].'</td><td id="metadata_object_class_name"></td></tr>';
	$html_text .= '<tr id="292" style="display:none; vertical-align:top"><td>object_conformance</td><td>'.$data[$pd]['metadata']['object_conformance'].'</td><td id="metadata_object_conformance"></td></tr>';	
	$html_text .= '<tr><td>terms_and_conditions</td><td>'.((strlen($terms_and_conditions)) ? '<a href="'.$terms_and_conditions.'" target="_blank">.'.$data[$pd]['metadata']['zone_identifier'].' TLD Data</a>' : '').'</td><td id="metadata_terms_and_conditions"></td></tr>';	
	$html_text .= '<tr id="293" style="display:none"><td>global_json_response_url</td><td>'.$data[$pd]['metadata']['global_json_response_url'].'</td><td id="metadata_global_json_response_url"></td></tr>';
	$registry_json_response_url = str_replace('https://', '', $data[$pd]['metadata']['registry_json_response_url']);
	$validation_registry = 'https://validator.rdap.org/?url=https://'.$registry_json_response_url.'&response-type=domain&server-type=gtld-registry&errors-only=1';	
	$html_text .= '<tr id="294" style="display:none"><td>registry_json_response_url</td><td>'.((strlen($data[$pd]['metadata']['registry_json_response_url'])) ? '<a href='.$data[$pd]['metadata']['registry_json_response_url'].' target="_blank">Registry Response</a> - <a href="' . htmlspecialchars($validation_registry, ENT_QUOTES, "UTF-8") . '" target="_blank">gTLD validator.rdap.org</a>' : '').'</td><td id="metadata_registry_json_response_url"></td></tr>';
	$html_text .= '<tr id="295" style="display:none"><td>registry_language_codes</td><td>'.$data[$pd]['metadata']['registry_language_codes'].'</td><td id="metadata_registry_language_codes"></td></tr>';
	$html_text .= '<tr id="296" style="display:none"><td>registrar_accreditation</td><td>'.((strlen($data[$pd]['metadata']['registrar_accreditation'])) ? $data[$pd]['metadata']['registrar_accreditation'] : '').'</td><td id="metadata_registrar_accreditation"></td></tr>';
	$registrar_json_response_url = str_replace('https://', '', $data[$pd]['metadata']['registrar_json_response_url']);
	$validation_registrar = 'https://validator.rdap.org/?url=https://'.$registrar_json_response_url.'&response-type=domain&server-type=gtld-registrar&errors-only=1';	
	$html_text .= '<tr id="297" style="display:none"><td>registrar_json_response_url eg. <a style="font-size: 0.9rem" href="https://rdap.cscglobal.com/dbs/rdap-api/v1/domain/icann.com" target="_blank">icann.com</a> <a style="font-size: 0.9rem" href="https://rdap.metaregistrar.com/domain/fryslan.frl" target="_blank">fryslan.frl</a></td><td>'.((strlen($data[$pd]['metadata']['registrar_json_response_url'])) ? '<a href='.$data[$pd]['metadata']['registrar_json_response_url'].' target="_blank">Registrar Response</a> - <a href="' . htmlspecialchars($validation_registrar, ENT_QUOTES, "UTF-8") . '" target="_blank">gTLD validator.rdap.org</a>' : '').'</td><td id="metadata_registrar_json_response_url"></td></tr>';
	$html_text .= '<tr id="298" style="display:none"><td>registrar_complaint_url</td><td>'.((strlen($data[$pd]['metadata']['registrar_complaint_url'])) ? '<a href='.$data[$pd]['metadata']['registrar_complaint_url'].' target="_blank">icann.org/wicf</a>' : '(if accredited)').'</td><td id="metadata_registrar_complaint_url"></td></tr>';
	$html_text .= '<tr id="299" style="display:none"><td>status_explanation_url</td><td>'.((strlen($data[$pd]['metadata']['status_explanation_url'])) ? '<a href='.$data[$pd]['metadata']['status_explanation_url'].' target="_blank">icann.org/epp</a>' : '(if accredited)').'</td><td id="metadata_status_explanation_url"></td></tr>';
	$html_text .= '<tr id="2910" style="display:none"><td>geo_location</td><td>'.$data[$pd]['metadata']['geo_location'].'</td><td></td></tr>';
	$html_text .= '<tr><td>resource_upload_at</td><td>'.$data[$pd]['metadata']['resource_upload_at'].'</td><td id="metadata_resource_upload_at"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	if (strlen($data[$pd]['http_error']))	{
		$html_text .= '<tr><td>http_error</td><td>'.$data[$pd]['http_error'].'</td><td></td></tr>';
	}
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(30)">Domain Data +/-</button></td><td><b>'.$vd.'</b></td><td id="domain_role"></td></tr>';
	$html_text .= '<tr id="301" style="display:none"><td>domain_server_handle</td><td colspan="2">'.$data[$pd]['domain']['server_handle'].'</td></tr>';
	$html_text .= '<tr id="302" style="display:none"><td>domain_client_handle</td><td colspan="2">'.$data[$pd]['domain']['client_handle'].'</td></tr>';
	$html_text .= '<tr id="303" style="display:none"><td>domain_ascii_name (lowercase is not a "MUST")</td><td>'.$data[$pd]['domain']['ascii_name'].'</td><td id="domain_ascii_name"></td></tr>';
	$html_text .= '<tr id="304" style="display:none"><td>domain_unicode_name</td><td>'.$data[$pd]['domain']['unicode_name'].'</td><td id="domain_unicode_name"></td></tr>';
	$domain_statuses = (!empty($data[$pd]['domain']['statuses'])) ? str_replace(',','<br />', $data[$pd]['domain']['statuses']) : '';
	$domain_statuses = str_replace('excluded','excluded (without DNS no email protection)', $domain_statuses);
	$domain_statuses = str_replace('locked','locked (indeterminate RDAPv1)', $domain_statuses);
	$domain_statuses = str_replace('removed','removed (indeterminate RDAPv1)', $domain_statuses);
	$domain_statuses = str_replace('obscured','obscured (indeterminate RDAPv1)', $domain_statuses);
	$domain_statuses = str_replace('private','private (indeterminate RDAPv1)', $domain_statuses);
	$domain_statuses = str_replace('proxy','proxy (indeterminate RDAPv1)', $domain_statuses);
	$domain_statuses = str_replace('associated','associated (indeterminate RDAPv1)', $domain_statuses);
	if (str_contains($data[$pd]['domain']['statuses'], 'inactive'))	{
		$domain_statuses = str_replace('inactive','inactive (without DNS no email protection)', $domain_statuses);
	}	
	elseif (str_contains($data[$pd]['domain']['statuses'], 'active'))	{
		$domain_statuses = str_replace('active','active (RDAPv2 => dns_active)', $domain_statuses);
	}
	$domain_statuses = str_replace('redemption period','redemption period (=> pending_redemption)', $domain_statuses);
	if (str_contains($data[$pd]['domain']['statuses'], 'renew prohibited'))	{
		if (!str_contains($data[$pd]['domain']['statuses'], 'server renew prohibited') and !str_contains($data[$pd]['domain']['statuses'], 'client renew prohibited'))	{
			$domain_statuses = str_replace('renew prohibited','renew prohibited (indeterminate RDAPv1)', $domain_statuses);
		}
	}
	if (str_contains($data[$pd]['domain']['statuses'], 'update prohibited'))	{
		if (!str_contains($data[$pd]['domain']['statuses'], 'server update prohibited') and !str_contains($data[$pd]['domain']['statuses'], 'client update prohibited'))	{
			$domain_statuses = str_replace('update prohibited','update prohibited (indeterminate RDAPv1)', $domain_statuses);
		}
	}
	if (str_contains($data[$pd]['domain']['statuses'], 'transfer prohibited'))	{
		if (!str_contains($data[$pd]['domain']['statuses'], 'server transfer prohibited') and !str_contains($data[$pd]['domain']['statuses'], 'client transfer prohibited'))	{
			$domain_statuses = str_replace('transfer prohibited','transfer prohibited (indeterminate RDAPv1)', $domain_statuses);
		}
	}	
	if (str_contains($data[$pd]['domain']['statuses'], 'delete prohibited'))	{
		if (!str_contains($data[$pd]['domain']['statuses'], 'server delete prohibited') and !str_contains($data[$pd]['domain']['statuses'], 'client delete prohibited'))	{
			$domain_statuses = str_replace('delete prohibited','delete prohibited (indeterminate RDAPv1)', $domain_statuses);
		}
	}	
	$html_text .= '<tr style="vertical-align:top"><td>domain_statuses</td><td>'.$domain_statuses.'</td><td id="domain_statuses"></td></tr>';
	$html_text .= '<tr id="305" style="display:none"><td>domain_created_at</td><td>'.$data[$pd]['domain']['created_at'].'</td><td id="domain_created_at"></td></tr>';
	$html_text .= '<tr id="306" style="display:none"><td>domain_latest_transfer_at</td><td>'.$data[$pd]['domain']['latest_transfer_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="307" style="display:none"><td>domain_latest_update_at</td><td>'.$data[$pd]['domain']['latest_update_at'].'</td><td></td></tr>';
	$html_text .= '<tr><td>domain_expiration_at</td><td>'.$data[$pd]['domain']['expiration_at'].'</td><td id="domain_expiration_at"></td></tr>';
	$html_text .= '<tr id="308" style="display:none"><td>domain_recoverable_until</td><td>'.$data[$pd]['domain']['recoverable_until'].'</td><td id="domain_recoverable_until"></td></tr>';
	$html_text .= '<tr id="309" style="display:none"><td>domain_deletion_at</td><td>'.$data[$pd]['domain']['deletion_at'].'</td><td id="domain_deletion_at"></td></tr>';
	if (!empty($data[$pd]['domain']['statuses']))	{
		if (str_contains($data[$pd]['domain']['statuses'], 'pending delete'))	{
			if (str_contains($data[$pd]['domain']['statuses'], 'redemption period') and str_contains($data[$pd]['domain']['statuses'], 'pending delete'))	{
				$html_text .= '<tr id="3010" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>"pending delete" disregards redemption grace</td><td></td></tr>';
			}	
			elseif (!empty($data[$pd]['metadata']['zone_identifier']))	{
				if ($data[$pd]['metadata']['zone_identifier'] == 'nl')	{
					$html_text .= '<tr id="3011" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>"pending delete" refers to "redemption period"</td><td></td></tr>';
				}	
			}	
		}
		if (str_contains($data[$pd]['domain']['statuses'], 'redemption period'))	{
			if (empty($data[$pd]['domain']['expiration_at']) and empty($data[$pd]['domain']['deletion_at'])) {
				$html_text .= '<tr id="3012" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>"redemption" without date-time provided</td><td></td></tr>';
			}	
		}
		elseif (str_contains($data[$pd]['domain']['statuses'], 'pending delete'))	{
			if (empty($data[$pd]['domain']['expiration_at']) and empty($data[$pd]['domain']['deletion_at'])) {
				$html_text .= '<tr id="3013" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>"pending delete" without date-time provided</td><td></td></tr>';
			}	
		}
	}
	if (!empty($data[$pd]['domain']['expiration_at']) and !empty($data[$pd]['domain']['deletion_at'])) {
    	$expiration = strtotime($data[$pd]['domain']['expiration_at']);
    	$deletion = strtotime($data[$pd]['domain']['deletion_at']);
    	if ($expiration !== false and $deletion !== false)	{
			$days_before = floor(($expiration - $deletion) / (60 * 60 * 24));
			if ($days_before > 0) {
       			$html_text .= '<tr id="3014" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>"deletion_at" '.$days_before.' days before "expiration_at"</td><td></td></tr>';
			}	
    	}
	}
	if (!empty($data[$pd]['domain']['deletion_at'])) {
		$current = strtotime($datetime->format('Y-m-d H:i:s'));
		$deletion = strtotime($data[$pd]['domain']['deletion_at']);
    	if ($current !== false and $deletion !== false and $current > $deletion) {
			$days_ago = floor(($current - $deletion) / (60 * 60 * 24));
        	$html_text .= '<tr id="3015" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>"deletion_at" was '.$days_ago.' days ago?</td><td></td></tr>';
		}
	}	
	$html_text .= '<tr id="3016" style="display:none;vertical-align:top"><td>domain_extensions</td><td>'.$data[$pd]['domain']['extensions'].'</td><td id="domain_extensions"></td></tr>';
	$html_text .= '<tr id="3017" style="display:none;vertical-align:top"><td>domain_remarks</td><td>'.$data[$pd]['domain']['remarks'].'</td><td></td></tr>';
	$sponsor_applicable = (strlen($data[$pd]['sponsor']['organization_name']) or strlen($data[$pd]['sponsor']['presented_name'])) ? 'Sponsor Data Exists' : 'No Sponsor Data';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(39)">Sponsor +/-</button></td><td>'.$sponsor_applicable.'</td><td id="sponsor_role"></td></tr>';
	$html_text .= '<tr id="391" style="display:none"><td>sponsor_server_handle</td><td>'.$data[$pd]['sponsor']['server_handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="392" style="display:none"><td>sponsor_client_handle</td><td>'.$data[$pd]['sponsor']['client_handle'].'</td><td></td></tr>';
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
	$html_text .= '<tr id="3916" style="display:none"><td>sponsor_country_name'.if_filled($data[$pd]['sponsor']['country_name']).'</td><td>'.$data[$pd]['sponsor']['country_name'].'</td><td></td></tr>';
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
	$html_text .= '<tr id="401" style="display:none"><td>registrant_server_handle</td><td>'.$data[$pd]['registrant']['server_handle'].'</td><td id="registrant_server_handle"></td></tr>';
	$html_text .= '<tr id="402" style="display:none"><td>registrant_client_handle</td><td>'.$data[$pd]['registrant']['client_handle'].'</td><td id="registrant_client_handle"></td></tr>';
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
	$html_text .= '<tr id="4010" style="display:none"><td>registrant_city</td><td>'.$data[$pd]['registrant']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="4011" style="display:none"><td>registrant_state_or_province</td><td>'.$data[$pd]['registrant']['state_or_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="4012" style="display:none"><td>registrant_postal_code</td><td>'.$data[$pd]['registrant']['postal_code'].'</td><td id="registrant_postal_code"></td></tr>';
	$html_text .= '<tr id="4013" style="display:none"><td>registrant_country_name'.if_filled($data[$pd]['registrant']['country_name']).'</td><td>'.$data[$pd]['registrant']['country_name'].'</td><td id="registrant_country_name"></td></tr>';
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
	$html_text .= '<tr id="411" style="display:none"><td>administrative_server_handle</td><td>'.$data[$pd]['administrative']['server_handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="412" style="display:none"><td>administrative_client_handle</td><td>'.$data[$pd]['administrative']['client_handle'].'</td><td></td></tr>';
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
	$html_text .= '<tr id="4115" style="display:none"><td>administrative_country_name'.if_filled($data[$pd]['administrative']['country_name']).'</td><td>'.$data[$pd]['administrative']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="4116" style="display:none"><td>administrative_language_pref_1</td><td>'.$data[$pd]['administrative']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4117" style="display:none"><td>administrative_language_pref_2</td><td>'.$data[$pd]['administrative']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4118" style="display:none;vertical-align:top"><td>administrative_properties</td><td>'.$data[$pd]['administrative']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="4119" style="display:none;vertical-align:top"><td>administrative_remarks</td><td>'.$data[$pd]['administrative']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(42)">Technical / Onsite +/-</button></td><td></td><td id="technical_role"></td></tr>';
	$html_text .= '<tr id="421" style="display:none"><td>technical_server_handle</td><td>'.$data[$pd]['technical']['server_handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="422" style="display:none"><td>technical_client_handle</td><td>'.$data[$pd]['technical']['client_handle'].'</td><td></td></tr>';
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
	$html_text .= '<tr id="4215" style="display:none"><td>technical_country_name'.if_filled($data[$pd]['technical']['country_name']).'</td><td>'.$data[$pd]['technical']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="4216" style="display:none"><td>technical_language_pref_1</td><td>'.$data[$pd]['technical']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4217" style="display:none"><td>technical_language_pref_2</td><td>'.$data[$pd]['technical']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4218" style="display:none;vertical-align:top"><td>technical_properties</td><td>'.$data[$pd]['technical']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="4219" style="display:none;vertical-align:top"><td>technical_remarks</td><td>'.$data[$pd]['technical']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(43)">Billing +/-</button></td><td></td><td id="billing_role"></td></tr>';
	$html_text .= '<tr id="431" style="display:none"><td>billing_server_handle</td><td>'.$data[$pd]['billing']['server_handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="432" style="display:none"><td>billing_client_handle</td><td>'.$data[$pd]['billing']['client_handle'].'</td><td></td></tr>';
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
	$html_text .= '<tr id="4316" style="display:none"><td>billing_country_name'.if_filled($data[$pd]['billing']['country_name']).'</td><td>'.$data[$pd]['billing']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="4317" style="display:none"><td>billing_language_pref_1</td><td>'.$data[$pd]['billing']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4318" style="display:none"><td>billing_language_pref_2</td><td>'.$data[$pd]['billing']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4319" style="display:none;vertical-align:top"><td>billing_properties</td><td>'.$data[$pd]['billing']['properties'].'</td><td></td></tr>';	
	$html_text .= '<tr id="4320" style="display:none;vertical-align:top"><td>billing_remarks</td><td>'.$data[$pd]['billing']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(44)">Emergency +/-</button></td><td></td><td id="emergency_role"></td></tr>';
	$html_text .= '<tr id="441" style="display:none"><td>emergency_server_handle</td><td>'.$data[$pd]['emergency']['server_handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="442" style="display:none"><td>emergency_client_handle</td><td>'.$data[$pd]['emergency']['client_handle'].'</td><td></td></tr>';
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
	$html_text .= '<tr id="4416" style="display:none"><td>emergency_country_name'.if_filled($data[$pd]['emergency']['country_name']).'</td><td>'.$data[$pd]['emergency']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="4417" style="display:none"><td>emergency_language_pref_1</td><td>'.$data[$pd]['emergency']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4418" style="display:none"><td>emergency_language_pref_2</td><td>'.$data[$pd]['emergency']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4419" style="display:none;vertical-align:top"><td>emergency_properties</td><td>'.$data[$pd]['emergency']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="4420" style="display:none;vertical-align:top"><td>emergency_remarks</td><td>'.$data[$pd]['emergency']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(45)">Fallback Contact +/-</button></td><td></td><td id="fallback_role"></td></tr>';
	$html_text .= '<tr id="451" style="display:none"><td>fallback_server_handle</td><td>'.$data[$pd]['fallback']['server_handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="452" style="display:none"><td>fallback_client_handle</td><td>'.$data[$pd]['fallback']['client_handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="453" style="display:none"><td>fallback_organization_type</td><td>'.$data[$pd]['fallback']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="454" style="display:none"><td>fallback_organization_name</td><td>'.$data[$pd]['fallback']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="455" style="display:none"><td>fallback_presented_name</td><td>'.$data[$pd]['fallback']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="456" style="display:none"><td>fallback_kind</td><td>'.$data[$pd]['fallback']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="457" style="display:none"><td>fallback_email</td><td>'.$data[$pd]['fallback']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="458" style="display:none"><td>fallback_telephone</td><td>'.$data[$pd]['fallback']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr id="459" style="display:none"><td>fallback_country_code</td><td>'.$data[$pd]['fallback']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(50)">Reseller +/-</button></td><td></td><td id="reseller_role"></td></tr>';
	$html_text .= '<tr id="501" style="display:none"><td>reseller_server_handle</td><td>'.$data[$pd]['reseller']['server_handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="502" style="display:none"><td>reseller_client_handle</td><td>'.$data[$pd]['reseller']['client_handle'].'</td><td></td></tr>';
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
	$html_text .= '<tr id="5013" style="display:none"><td>reseller_country_name'.if_filled($data[$pd]['reseller']['country_name']).'</td><td>'.$data[$pd]['reseller']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="5014" style="display:none"><td>reseller_language_pref_1</td><td>'.$data[$pd]['reseller']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="5015" style="display:none"><td>reseller_language_pref_2</td><td>'.$data[$pd]['reseller']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="5016" style="display:none;vertical-align:top"><td>reseller_statuses</td><td>'.$data[$pd]['reseller']['statuses'].'</td><td></td></tr>';
	$html_text .= '<tr id="5017" style="display:none"><td>reseller_created_at</td><td>'.$data[$pd]['reseller']['created_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="5018" style="display:none"><td>reseller_latest_update_at</td><td>'.$data[$pd]['reseller']['latest_update_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="5019" style="display:none"><td>reseller_verification_received_at</td><td>'.$data[$pd]['reseller']['verification_received_at'].'</td><td id="reseller_verification_received_at"></td></tr>';
	$html_text .= '<tr id="5020" style="display:none"><td>reseller_verification_set_at</td><td>'.$data[$pd]['reseller']['verification_set_at'].'</td><td id="reseller_verification_set_at"></td></tr>';
	$html_text .= '<tr id="5021" style="display:none;vertical-align:top"><td>reseller_properties</td><td>'.$data[$pd]['reseller']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="5022" style="display:none;vertical-align:top"><td>reseller_remarks</td><td>'.$data[$pd]['reseller']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(60)">Registrar +/-</button></td><td></td><td id="registrar_role"></td></tr>';
	$html_text .= '<tr id="601" style="display:none"><td>registrar_server_handle</td><td>'.$data[$pd]['registrar']['server_handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="602" style="display:none"><td>registrar_client_handle</td><td>'.$data[$pd]['registrar']['client_handle'].'</td><td></td></tr>';
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
	$html_text .= '<tr id="6013" style="display:none"><td>registrar_country_name'.if_filled($data[$pd]['registrar']['country_name']).'</td><td>'.$data[$pd]['registrar']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="6014" style="display:none"><td>registrar_language_pref_1</td><td>'.$data[$pd]['registrar']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="6015" style="display:none"><td>registrar_language_pref_2</td><td>'.$data[$pd]['registrar']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="6016" style="display:none;vertical-align:top"><td>registrar_statuses</td><td>'.$data[$pd]['registrar']['statuses'].'</td><td></td></tr>';
	$html_text .= '<tr id="6017" style="display:none"><td>registrar_created_at</td><td>'.$data[$pd]['registrar']['created_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="6018" style="display:none"><td>registrar_latest_update_at</td><td>'.$data[$pd]['registrar']['latest_update_at'].'</td><td></td></tr>';
	$html_text .= '<tr id="6019" style="display:none"><td>registrar_verification_received_at</td><td>'.$data[$pd]['registrar']['verification_received_at'].'</td><td id="registrar_verification_received_at"></td></tr>';
	$html_text .= '<tr id="6020" style="display:none"><td>registrar_verification_set_at</td><td>'.$data[$pd]['registrar']['verification_set_at'].'</td><td id="registrar_verification_set_at"></td></tr>';
	$html_text .= '<tr id="6021" style="display:none;vertical-align:top"><td>registrar_properties</td><td>'.$data[$pd]['registrar']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="6022" style="display:none;vertical-align:top"><td>registrar_remarks</td><td>'.$data[$pd]['registrar']['remarks'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(61)">Abuse Contact +/-</button></td><td></td><td id="abuse_role"></td></tr>';
	$html_text .= '<tr id="611" style="display:none"><td>abuse_server_handle</td><td>'.$data[$pd]['abuse']['server_handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="612" style="display:none"><td>abuse_client_handle</td><td>'.$data[$pd]['abuse']['client_handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="613" style="display:none"><td>abuse_organization_type</td><td>'.$data[$pd]['abuse']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="614" style="display:none"><td>abuse_organization_name</td><td>'.$data[$pd]['abuse']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="615" style="display:none"><td>abuse_presented_name</td><td>'.$data[$pd]['abuse']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="616" style="display:none"><td>abuse_kind</td><td>'.$data[$pd]['abuse']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="617" style="display:none"><td>abuse_email</td><td>'.$data[$pd]['abuse']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="618" style="display:none"><td>abuse_telephone</td><td>'.$data[$pd]['abuse']['telephone'].'</td><td id="abuse_telephone"></td></tr>';
	$html_text .= '<tr id="619" style="display:none"><td>abuse_country_code</td><td>'.$data[$pd]['abuse']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(63)">Name Servers +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="631" style="display:none;vertical-align:top"><td>server_handles</td><td colspan="2">'.$data[$pd]['name_servers']['server_handles'].'</td></tr>';
	$html_text .= '<tr id="632" style="display:none;vertical-align:top"><td>client_handles</td><td colspan="2">'.$data[$pd]['name_servers']['client_handles'].'</td></tr>';
	$html_text .= '<tr id="633" style="display:none;vertical-align:top"><td>ascii_names</td><td colspan="2">'.$data[$pd]['name_servers']['ascii_names'].'</td></tr>';
	$html_text .= '<tr id="634" style="display:none;vertical-align:top"><td>unicode_names</td><td colspan="2">'.$data[$pd]['name_servers']['unicode_names'].'</td></tr>';
	$html_text .= '<tr id="635" style="display:none;vertical-align:top"><td>ipv4_addresses</td><td>'.$data[$pd]['name_servers']['ipv4_addresses'].'</td><td style="vertical-align:bottom" id="name_servers_ipv4_addresses"></td></tr>';
	$html_text .= '<tr id="636" style="display:none;vertical-align:top"><td>ipv6_addresses</td><td>'.$data[$pd]['name_servers']['ipv6_addresses'].'</td><td id="name_servers_ipv6_addresses"></td></tr>';
	$html_text .= '<tr id="637" style="display:none;vertical-align:top"><td>statuses</td><td>'.$data[$pd]['name_servers']['statuses'].'</td><td></td></tr>';
	$html_text .= '<tr id="638" style="display:none;vertical-align:top"><td>delegation_checks</td><td>'.$data[$pd]['name_servers']['delegation_checks'].'</td><td id="br_zone"></td></tr>';
	$html_text .= '<tr id="639" style="display:none;vertical-align:top"><td>latest_correct_delegation_checks</td><td>'.$data[$pd]['name_servers']['latest_correct_delegation_checks'].'</td><td></td></tr>';
	$html_text .= '<tr><td>dnssec_signed</td><td>'.$data[$pd]['name_servers']['dnssec_signed'].'</td><td id="name_servers_dnssec_signed"></td></tr>';
	$html_text .= '<tr id="6310" style="display:none;vertical-align:top"><td>dnssec_key_tag</td><td>'.str_replace(',',',<br />',$data[$pd]['name_servers']['dnssec_key_tag']).'</td><td></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>dnssec_algorithm</td><td>'.str_replace(',',',<br />',$data[$pd]['name_servers']['dnssec_algorithm']).'</td><td id="name_servers_dnssec_algorithm"></td></tr>';	
	$html_text .= '<tr id="6311" style="display:none;vertical-align:top"><td>dnssec_digest_type</td><td>'.str_replace(',',',<br />',$data[$pd]['name_servers']['dnssec_digest_type']).'</td><td></td></tr>';
	$html_text .= '<tr id="6312" style="display:none;vertical-align:top"><td>dnssec_digest</td><td colspan="2">'.str_replace(',',',<br />',$data[$pd]['name_servers']['dnssec_digest']).'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td>raw_whois</td><td>'.((strlen($raw_whois)) ? '<a href="'.$raw_whois.'" target="_blank">Whois Data</a>' : '').'</td><td></td></tr>';
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

function if_filled($inputvalue)	{
	if (!empty($inputvalue))	{
		return ' (to be empty) ⚠️';
	}
	return ' (to be empty)';
}					
?>