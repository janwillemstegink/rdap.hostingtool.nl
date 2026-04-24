<?php
session_start();  // A clean, stateless environment works without a sleep command.
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

$internal = (str_contains([block],'Freedom')) ? '_internal_' : '';
$log_file = "/home/admin/logging/" . $internal . "domain_tool_" . $datetime->format('Ym') . ".txt";
$log_line = $datetime->format('Y-m-d H:i:s') . " UTC, lang" . $viewlanguage . ", " . $vd . ", " . [ip] . ", " . [block] . "\n";
file_put_contents($log_file, $log_line, FILE_APPEND);
echo '<!DOCTYPE html><html lang="en" style="font-size: 90%">
<head><meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8"><meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="robots" content="index">
<title>Domain Information</title><style>.top-align td {vertical-align: top;}</style>';
?><script>	
	
function SwitchDisplay(type) {
	if (type == 11)	{ // notice
		var pre = '11';
		var max = 1
	}
	else if (type == 12)	{ // links
		var pre = '12';
		var max = 1
	}
	else if (type == 13)	{ // publication
		var pre = '13';
		var max = 1
	}
	else if (type == 20)	{ // metadata
		var pre = '20';
		var max = 12
	}
	else if (type == 30)	{ // domain properties
		var pre = '30';
		var max = 24
	}
	else if (type == 39)	{ // sponsor
		var pre = '39';
		var max = 25
	}
	else if (type == 40)	{ // registrant
		var pre = '40';
		var max = 21
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
		var max = 21
	}
	else if (type == 44)	{ // emergency
		var pre = '44';
		var max = 20
	}
	else if (type == 45)	{ // fallback
		var pre = '45';
		var max = 10
	}
	else if (type == 50)	{ // reseller
		var pre = '50';
		var max = 24
	}	
	else if (type == 60)	{ // registrar
		var pre = '60';
		var max = 24
	}
	else if (type == 61)	{ // registrar abuse
		var pre = '61';
		var max = 10
	}
	else if (type == 63)	{ // nameservers
		var pre = '63';
		var max = 18
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
		
const modeling = `Legacy table structures lack explicit disclosure semantics.
Aggregating data across relationships may incorrectly disclose or suppress data.

Each field’s publication state is determined for each domain–relationship–field combination.
Implementations MUST NOT aggregate data across relationships when determining disclosure.
Disclosure MUST be evaluated independently within each relationship.

Example (non-normative)

An entity may be associated with a domain through multiple relationships, each assigning a publication state to each field.
An email field in one relationship is "visible", while in another relationship it is "shielded".

Enumerated Values (domain_entities.field_publication)

shielded — not disclosed
visible — disclosed
authorizable_shielded — disclosed only if authorized and permitted by policy
authorizable_visible — disclosed based on authorization and permitted by policy

End of RFC Modeling Section

`;

function SwitchTranslation(translation)	{
	document.getElementById("language").value = translation;
	if (translation == 99)	{
		var modified = '';
		var proposed = '';
		var accessible = '';
		var legacy = '';
		document.getElementById("title").textContent = "Domain Information — RDAP Data & Verification";
		document.getElementById("modeling").textContent = "";
		document.getElementById("instruction").textContent = "Enter here:";
		document.getElementById("field_name").textContent = "Modeled with snake_case";
		document.getElementById("explanation").textContent = "";
		document.getElementById("notices_part").textContent = legacy;
		document.getElementById("links_part").textContent = legacy;
		document.getElementById("field_publication_part").textContent = "";
		document.getElementById("field_publication").textContent = "";
		document.getElementById("metadata_part").textContent = proposed;
		document.getElementById("metadata_object_type").textContent = modified;
		document.getElementById("metadata_rdap_version").textContent = modified;
		document.getElementById("metadata_rdap_data_layer").textContent = proposed;
		document.getElementById("metadata_rdap_issue_uri").textContent = proposed;
		document.getElementById("metadata_tld_policies_uri").textContent = proposed;
		document.getElementById("metadata_global_json_response_uri").textContent = proposed;
		document.getElementById("metadata_registry_json_response_uri").textContent = proposed;
		document.getElementById("metadata_registrar_identifiers").textContent = modified;
		document.getElementById("metadata_registrar_json_response_uri").textContent = proposed;
		document.getElementById("metadata_registrar_complaint_uri").textContent = proposed;
		document.getElementById("metadata_registrar_publication_method").textContent = proposed;
		document.getElementById("metadata_status_explanation_uri").textContent = proposed;
		document.getElementById("metadata_resource_upload_at").textContent = modified;
		document.getElementById("domain_part").textContent = "";
		document.getElementById("domain_ascii_name").textContent = "";
		document.getElementById("domain_unicode_name").textContent = "";
		document.getElementById("domain_statuses").textContent = legacy;
		document.getElementById("domain_policy_statuses").textContent = modified;
		document.getElementById("domain_dns_state").textContent = proposed;
		document.getElementById("domain_created_at").textContent = "";
		document.getElementById("domain_latest_data_mutation_at").textContent = modified;
		document.getElementById("domain_expiration_at").textContent = "";
		document.getElementById("domain_lifecycle_phase").textContent = modified;
		document.getElementById("domain_lifecycle_phase_until").textContent = modified;
		document.getElementById("domain_applicable_grace").textContent = modified;
		document.getElementById("domain_applicable_grace_until").textContent = modified;		
		document.getElementById("domain_recoverable_until").textContent = proposed;
		document.getElementById("domain_deletion_at").textContent = "";
		document.getElementById("domain_extensions").textContent = "";		
		document.getElementById("sponsor_part").textContent = "";
		document.getElementById("registrant_part").textContent = "";
		document.getElementById("registrant_server_handle").textContent = proposed;
		document.getElementById("registrant_client_handle").textContent = "";
		document.getElementById("registrant_web_id").textContent = proposed;
		document.getElementById("registrant_organization_type").textContent = "";
		document.getElementById("registrant_organization_name").textContent = "";
		document.getElementById("registrant_presented_name").textContent = "";
		document.getElementById("registrant_kind").textContent = "";
		document.getElementById("registrant_name").textContent = "";
		document.getElementById("registrant_contact_uri").textContent = "";
		document.getElementById("registrant_country_code").textContent = "";
		document.getElementById("registrant_street_address").textContent = "";
		document.getElementById("registrant_postal_code").textContent = "";
		document.getElementById("registrant_country_name").textContent = "";
		document.getElementById("registrant_verification_received_at").textContent = proposed;
		document.getElementById("registrant_verification_set_at").textContent = proposed;
		document.getElementById("registrant_remarks").textContent = "";
		document.getElementById("administrative_part").textContent = "";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_part").textContent = "";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_part").textContent = "";
		document.getElementById("emergency_part").textContent = "";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("fallback_part").textContent = proposed;
		document.getElementById("reseller_part").textContent = "";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;
		document.getElementById("registrar_part").textContent = "";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_email").textContent = "";
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;
		document.getElementById("registrar_abuse_part").textContent = "";
		document.getElementById("registrar_abuse_phone").textContent = "";
		document.getElementById("nameservers_rdap_dnssec_signed").textContent = "";
		document.getElementById("nameservers_rdap_ds_algorithms").textContent = "";
		document.getElementById("nameservers_rdap_ds_digest_types").textContent = "";
		document.getElementById("measured_ds_algorithms").textContent = proposed;
		document.getElementById("nameservers_ipv4_addresses").textContent = "";
		document.getElementById("nameservers_ipv6_addresses").textContent = "";
		document.getElementById("br_tld").textContent = "";
		document.getElementById("raw_data_next").textContent = "";
	}
	else if (translation == 1)	{
		var modified = '(Gewijzigd) ';
		var proposed = '(Nieuw) ';
		var accessible = 'Voor het gebruiksgemak en de duidelijkheid kunnen nieuwe velden worden toegevoegd.';
		var legacy = '(Legacy) ';
		document.getElementById("title").textContent = "Domeininformatie — RDAP-gegevens & Verificatie";
		document.getElementById("modeling").textContent = "Deze RDAP-modellering biedt een gestructureerde referentie voor het interpreteren van domeingegevens en openbaarmakingssemantiek.";
		document.getElementById("instruction").textContent = "Geef hier in:";
		document.getElementById("field_name").textContent = "Gemodelleerd met snake_case";
		document.getElementById("explanation").textContent = "Een overzicht van en toelichting op de structuur en kenmerken van webdomeinen.";
		document.getElementById("notices_part").textContent = legacy + accessible;
		document.getElementById("links_part").textContent = legacy + accessible;
		document.getElementById("field_publication_part").textContent = "Gegevens kunnen afgeschermd zijn. Interpretatie vereist RFC-modellering.";
		document.getElementById("field_publication").textContent = modeling;
		document.getElementById("metadata_part").textContent = proposed + "Metadata bieden context en details over data-elementen.";
		document.getElementById("metadata_object_type").textContent = modified;
		document.getElementById("metadata_rdap_version").textContent = modified;
		document.getElementById("metadata_rdap_data_layer").textContent = proposed + "Geeft aan uit welke RDAP-laag de gegevens afkomstig zijn.";
		document.getElementById("metadata_rdap_issue_uri").textContent = proposed + "URI voor het melden van technische of dataintegriteitsproblemen in RDAP";
		document.getElementById("metadata_tld_policies_uri").textContent = proposed + "Beperkt gebruik. Interpretatie hangt af van TLD- en RDAP-context.";
		document.getElementById("metadata_global_json_response_uri").textContent = proposed + "JSON-antwoord via een globale RDAP-URI die kan verwijzen naar een andere RDAP-bron.";
		document.getElementById("metadata_registry_json_response_uri").textContent = proposed + "URI van het RDAP-JSON-antwoord van de registry; relatie 'self'.";
		document.getElementById("metadata_registrar_identifiers").textContent = modified + "Identificatoren die met de registrar zijn verbonden. Een IANA-Registrar-ID moet geldig zijn.";
		document.getElementById("metadata_registrar_json_response_uri").textContent = proposed + "URI van het RDAP-JSON-antwoord van de registrar; relatie 'related'.";
		document.getElementById("metadata_registrar_complaint_uri").textContent = proposed + 'Vereist indien de registrator geaccrediteerd is door IANA, om een klacht in behandeling te kunnen nemen.';
		document.getElementById("metadata_registrar_publication_method").textContent = proposed + "Voor gTLD’s kan de houder publicatie per registrantveld inschakelen.";
		document.getElementById("metadata_status_explanation_uri").textContent = proposed + 'Vereist als de registrar IANA-geaccrediteerd is; bevat uitleg over de statuscode.';
		document.getElementById("metadata_resource_upload_at").textContent = modified + "Tijdstempel van de RDAP-datasetupdate in UTC (Zulu-tijd).";
		document.getElementById("domain_part").textContent = "Een domein onder TLD-niveau is wereldwijd uniek en kan vrij worden gekozen onder bepaalde regels.";
		document.getElementById("domain_ascii_name").textContent = "Voor speciale tekens bevatten de ASCII-tekenreeksen Punycode-transcriptie.";
		document.getElementById("domain_unicode_name").textContent = "Optioneel veld dat, indien van toepassing, de Unicode-weergave van het domein biedt.";
		document.getElementById("domain_statuses").textContent = legacy + "RDAPv1 zelf garandeert niet of status van registry, registrar, of lifecycle is — elimineerbaar.";
		document.getElementById("domain_policy_statuses").textContent = modified;
		document.getElementById("domain_dns_state").textContent = proposed + "Gemodelleerde DNS-resolutiestatussen: dns_delegated, dns_undelegated, no_dns_records, unknown.";
		document.getElementById("domain_created_at").textContent = "De datumvelden staan hier in een logische volgorde. Dit is ook eenvoudig in de JSON-array.";
		document.getElementById("domain_latest_data_mutation_at").textContent = modified + "Verschillende mutatieniveaus: contactobject (registrar) versus domeinobject (registry).";
		document.getElementById("domain_expiration_at").textContent = "Vervaldatumgrens van het domein, waarna de rechten van de registrar afnemen.";
		document.getElementById("domain_lifecycle_phase").textContent = modified + "De EPP-status 'redemptionPeriod' kan in RDAPv2 worden gewijzigd naar 'pending_redemption'.";
		document.getElementById("domain_lifecycle_phase_until").textContent = modified;
		document.getElementById("domain_applicable_grace").textContent = modified;
		document.getElementById("domain_applicable_grace_until").textContent = modified;		
		document.getElementById("domain_recoverable_until").textContent = proposed + "Gemodelleerd als na stop van DNS-publicatie + TLD pending_redemption_days.";
		document.getElementById("domain_deletion_at").textContent = "Datum en tijdstip gepland voor volledige verwijdering. Er kan een laatste verwijderingsfase zijn.";
		document.getElementById("domain_extensions").textContent = "'Eligibility': Hoe het domein voldoet aan specifieke eisen van de TLD-rootzone.";		
		document.getElementById("sponsor_part").textContent = "De domeinregistratie kan, indien van toepassing, via een sponsorrelatie worden beheerd. Zie bijvoorbeeld france.fr.";
		document.getElementById("registrant_part").textContent = "Jurisdictiereferentie op basis van het land van vestiging van de legitieme registrant of organisatorische gebruiker.";
		document.getElementById("registrant_server_handle").textContent = proposed + "Zonder deze identificatie kan een wereldwijde RDAP-server niet worden bijgewerkt.";
		document.getElementById("registrant_client_handle").textContent = 'Voor "janwillemstegink.nl" wordt vertrouwelijke informatie weergegeven met "STE135420-TRAP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Webidentificatienummer voor bedrijfsentiteiten en natuurlijke personen.";
		document.getElementById("registrant_organization_type").textContent = 'De gebruikelijke waarde is "work", of mogelijk "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "De juridische naam van de organisatie die primair verantwoordelijk is voor het domeinabonnement.";
		document.getElementById("registrant_presented_name").textContent = "De naam van de primair verantwoordelijke persoon of een rol binnen de organisatie wordt verwacht.";
		document.getElementById("registrant_kind").textContent = "Leeg / 'org' / 'individual' (Voor continuïteit: levenstestament + testament + digitale executeur)";
		document.getElementById("registrant_name").textContent = "Een persoonlijke naam kan openbaar zichtbaar zijn in het veld 'presented_name'. Zie bijvoorbeeld cira.ca.";
		document.getElementById("registrant_contact_uri").textContent = "Deze contact-URI kan verwijzen naar een professioneel beheerd eindpunt.";
		document.getElementById("registrant_country_code").textContent = "ISO-2-landcode-indexering, bijv. voor het Verenigd Koninkrijk, inclusief situaties na het uittreden uit de EU.";
		document.getElementById("registrant_street_address").textContent = "Het afschermen van adresgegevens zoals bij example.tel, resulteert in rommelige gegevens.";
		document.getElementById("registrant_postal_code").textContent = "Indexeren op postcode is in de database noodzakelijk. De vCard-array vormt een obstakel.";
		document.getElementById("registrant_country_name").textContent = "Een openbaar zichtbare landnaam is beperkt tot 'gTLD registrar RDAP' (ontwerpwijziging).";
		document.getElementById("registrant_verification_received_at").textContent = proposed + "Na identificatie kan een overeenkomende web-ID worden bevestigd, leeg is intrekking.";
		document.getElementById("registrant_verification_set_at").textContent = proposed + "Vervolgens verifieert de registry de gegevens bij de landspecifieke webdomeindienst.";
		document.getElementById("registrant_remarks").textContent = "Meer informatie. Zie bijvoorbeeld france.fr.";
		document.getElementById("administrative_part").textContent = "Het administratief aanspreekpunt beantwoordt een verzoek en stuurt zo nodig door.";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_part").textContent = "Een technisch contact reageert om een gemelde storing op te lossen.";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_part").textContent = "Sommige domain registries houden gegevens bij om hun facturering uit te voeren.";
		document.getElementById("emergency_part").textContent = proposed + "Een verantwoordelijke persoon kan de benodigde toegang verlenen.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("fallback_part").textContent = proposed + "Contact dat wordt gebruikt wanneer contactgegevens niet openbaar zichtbaar zijn.";		
		document.getElementById("reseller_part").textContent = "De domeinreseller is als tweede verantwoordelijk, ook afhankelijk van de overeenkomst en de regelgeving.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;
		document.getElementById("registrar_part").textContent = "De domeinregistrar is verantwoordelijk voor domeinreserveringen en IP-adresroutering.";
		document.getElementById("registrar_web_id").textContent = proposed
		document.getElementById("registrar_email").textContent = "Een registrar moet zonder verdere hyperlinks bereikbaar zijn. Zie bijvoorbeeld example.tel.";
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;
		document.getElementById("registrar_abuse_part").textContent = "Informatie over hoe een derde partij contact kan opnemen met de registrar of belaste partij. Zie fryslan.frl.";
		document.getElementById("registrar_abuse_phone").textContent = "Een telefoonnummer moet beginnen met het type. Toegestaan zijn in ieder geval 'voice' en 'fax'.";
		document.getElementById("nameservers_rdap_dnssec_signed").textContent = "DNSSEC beveiligt DNS tegen spoofing en cachevergiftiging.";
		document.getElementById("nameservers_rdap_ds_algorithms").textContent = "Algoritmen 13–16 zijn actueel. IANA voert algoritme 8 als RECOMMENDED, geldt als uitlopend.";
		document.getElementById("nameservers_rdap_ds_digest_types").textContent = "De hexadecimale digest waarde is niet hoofdlettergevoelig.";
		document.getElementById("measured_ds_algorithms").textContent = proposed + "Deze tool meet DNSSEC-algoritmen direct, onafhankelijk van RDAP, ook bij tijdelijke duplicatie.";
		document.getElementById("nameservers_ipv4_addresses").textContent = "Een glue-record is een DNS-record dat wordt meegegeven door de bovenliggende zone, ook al is die daar niet";
		document.getElementById("nameservers_ipv6_addresses").textContent = "autoritatief voor, om cirkelafhankelijke resoluties van nameservers binnen de onderliggende zone te voorkomen.";
		document.getElementById("br_tld").textContent = "TLD .br: De RDAP-gegevens zijn aangepast met nameservervalidatie.";
		document.getElementById("raw_data_next").textContent = "Opmerkingen: De relaties zijn hier gerangschikt naar verantwoordelijkheid. Duidelijker met '(not provided)'. Een JSON-structuur kan net zo leesbaar zijn als XML.";
	}
	else if (translation == 2)	{
		var modified = '(Modified) ';
		var proposed = '(New) ';
		var accessible = 'For ease of use and clarity, new fields can be added.';
		var legacy = '(Legacy) ';
		document.getElementById("title").textContent = "Domain Information — RDAP Data & Verification";
		document.getElementById("modeling").textContent = "This RDAP modeling provides a structured reference for interpreting domain data and disclosure semantics.";
		document.getElementById("instruction").textContent = "Enter here:";
		document.getElementById("field_name").textContent = "Modeled with snake_case";
		document.getElementById("explanation").textContent = "An overview of the structure and key characteristics of domain data.";
		document.getElementById("notices_part").textContent = legacy + accessible;
		document.getElementById("links_part").textContent = legacy + accessible;
		document.getElementById("field_publication_part").textContent = "Data may be shielded. Interpretation requires RFC modeling.";
		document.getElementById("field_publication").textContent = modeling;
		document.getElementById("metadata_part").textContent = proposed + "Metadata provides context and details about data elements.";
		document.getElementById("metadata_object_type").textContent = modified;
		document.getElementById("metadata_rdap_version").textContent = modified;
		document.getElementById("metadata_rdap_data_layer").textContent = proposed + "Indicates the RDAP layer from which the data originates.";
		document.getElementById("metadata_rdap_issue_uri").textContent = proposed + "URI for reporting RDAP technical or data integrity issues";
		document.getElementById("metadata_tld_policies_uri").textContent = proposed + "Restricted use. Interpretation depends on TLD and RDAP context.";
		document.getElementById("metadata_global_json_response_uri").textContent = proposed + "JSON response via a global RDAP URI that may reference another RDAP source.";
		document.getElementById("metadata_registry_json_response_uri").textContent = proposed + "RDAP JSON response URI from the registry; relationship 'self'.";
		document.getElementById("metadata_registrar_identifiers").textContent = modified + "Identifiers associated with the registrar. Any IANA Registrar ID must be valid.";
		document.getElementById("metadata_registrar_json_response_uri").textContent = proposed + "RDAP JSON response URI from the registrar; relationship 'related'.";
		document.getElementById("metadata_registrar_complaint_uri").textContent = proposed + 'Required if the registrar is accredited by IANA, in order to have a complaint handled.';
		document.getElementById("metadata_registrar_publication_method").textContent = proposed + "For gTLDs, the holder may enable publication on a per-registrant-field basis.";
		document.getElementById("metadata_status_explanation_uri").textContent = proposed + 'Required if the registrar is IANA-accredited; provides status code explanations.';
		document.getElementById("metadata_resource_upload_at").textContent = modified + "Timestamp of RDAP dataset update in UTC (Zulu time).";
		document.getElementById("domain_part").textContent = "A domain below TLD level is globally unique and can be freely chosen under certain rules.";
		document.getElementById("domain_ascii_name").textContent = "For special characters, the ASCII character strings contain Punycode transcription.";
		document.getElementById("domain_unicode_name").textContent = "Optional field that provides the Unicode representation of the domain, if applicable.";
		document.getElementById("domain_statuses").textContent = legacy + "RDAPv1 itself doesn’t guarantee showing if status is registry, registrar, or lifecycle — eliminable.";
		document.getElementById("domain_policy_statuses").textContent = modified;
		document.getElementById("domain_dns_state").textContent = proposed + "Modeled DNS resolution states: dns_delegated, dns_undelegated, no_dns_records, unknown.";
		document.getElementById("domain_created_at").textContent = "The date fields are here in a logical order. This is also easy in the JSON array.";
		document.getElementById("domain_latest_data_mutation_at").textContent = modified + "Distinct mutation layers: contact object (registrar) vs domain object (registry).";
		document.getElementById("domain_expiration_at").textContent = "Domain expiration boundary, after which registrar rights decline.";
		document.getElementById("domain_lifecycle_phase").textContent = modified + "The EPP 'redemptionPeriod' status can be changed to 'pending_redemption' in RDAPv2.";
		document.getElementById("domain_lifecycle_phase_until").textContent = modified;
		document.getElementById("domain_applicable_grace").textContent = modified;
		document.getElementById("domain_applicable_grace_until").textContent = modified;
		document.getElementById("domain_recoverable_until").textContent = proposed + "Modeled as after DNS publication stop + TLD pending_redemption_days.";
		document.getElementById("domain_deletion_at").textContent = "Date and time scheduled for complete deletion. A final deletion phase may exist.";
		document.getElementById("domain_extensions").textContent = "'Eligibility': How the domain meets specific TLD root zone requirements.";
		document.getElementById("sponsor_part").textContent = "The domain registration may be managed through a sponsor relationship, where applicable. See for example france.fr.";
		document.getElementById("registrant_part").textContent = "Jurisdiction reference based on the country of establishment of the legitimate registrant or organizational user.";
		document.getElementById("registrant_server_handle").textContent = proposed + "Without this identifier, a global RDAP server cannot be updated.";
		document.getElementById("registrant_client_handle").textContent = 'For “janwillemstegink.nl”, confidential information is indicated by “STE135420-TRAP”.';
		document.getElementById("registrant_web_id").textContent = proposed + "Web Identification number for business entities and natural persons.";
		document.getElementById("registrant_organization_type").textContent = 'The usual value is "work", or possibly "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "The legal name of the organization primarily responsible for the domain subscription.";
		document.getElementById("registrant_presented_name").textContent = "The name of the primarily responsible person or a role within the organization is expected.";
		document.getElementById("registrant_kind").textContent = "Empty / 'org' / 'individual' (For continuity: Living Will + Will + Digital Executor)";
		document.getElementById("registrant_name").textContent = "A personal name may be publicly visible in the 'presented_name' field. See for example cira.ca.";
		document.getElementById("registrant_contact_uri").textContent = "This contact URI may point to a professionally managed endpoint.";
		document.getElementById("registrant_country_code").textContent = "ISO-2 country code indexing, e.g. for the United Kingdom, including post-EU withdrawal cases.";
		document.getElementById("registrant_street_address").textContent = "Shielding address data as with example.tel, results in messy data.";
		document.getElementById("registrant_postal_code").textContent = "Indexing by postal code is necessary in the database. The Vcard array is an obstacle.";	
		document.getElementById("registrant_country_name").textContent = "A publicly visible country name is limited to 'gTLD registrar RDAP' (design change).";
		document.getElementById("registrant_verification_received_at").textContent = proposed + "After identification, a matching web ID can be confirmed, empty is revocation.";
		document.getElementById("registrant_verification_set_at").textContent = proposed + "The registry then verifies the data with the country-specific web domain service.";
		document.getElementById("registrant_remarks").textContent = "More information. See for example france.fr.";
		document.getElementById("administrative_part").textContent = "The administratively responsible desk answers a request, and forwards on if necessary.";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_part").textContent = "A technical contact responds to resolve a reported malfunction.";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_part").textContent = "Some domain registries maintain records to perform their billing.";
		document.getElementById("emergency_part").textContent = proposed + "A responsible person can provide the necessary access.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("fallback_part").textContent = proposed + "Contact used if contact data is not publicly visible.";
		document.getElementById("reseller_part").textContent = "The domain reseller is secondly responsible, also depending on the agreement and regulations.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;		
		document.getElementById("registrar_part").textContent = "The domain registrar is responsible for domain reservations and IP address routing.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_email").textContent = "A registrar needs to be reachable without any further hyperlink. See, for example, example.tel.";
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;
		document.getElementById("registrar_abuse_part").textContent = "Information on how a third party can contact the registrar or entrusted party. See fryslan.frl.";
		document.getElementById("registrar_abuse_phone").textContent = "A phone number must begin with the type. Allowed are anyway 'voice' and 'fax'.";
		document.getElementById("nameservers_rdap_dnssec_signed").textContent = "DNSSEC secures DNS against spoofing and cache poisoning.";
		document.getElementById("nameservers_rdap_ds_algorithms").textContent = "Algorithms 13–16 are current. IANA lists algorithm 8 as RECOMMENDED, considered phasing out.";
		document.getElementById("nameservers_rdap_ds_digest_types").textContent = "The hexadecimal digest value is not case-sensitive.";
		document.getElementById("measured_ds_algorithms").textContent = proposed + "This tool measures DNSSEC algorithms directly, independent of RDAP, including during temporary duplication.";
		document.getElementById("nameservers_ipv4_addresses").textContent = "A glue record is a DNS record provided by the parent zone, even though it is not authoritative for it,";
		document.getElementById("nameservers_ipv6_addresses").textContent = "to prevent circular dependencies when resolving nameservers within the child zone.";
		document.getElementById("br_tld").textContent = "TLD .br: The RDAP data has been modified with nameserver validation.";
		document.getElementById("raw_data_next").textContent = "Remarks: The relations here are arranged according to responsibility. Clearer with '(not provided)'. A JSON structure can be as readable as XML.";
	}
	else if (translation == 3)	{
		var modified = '(Geändert) ';
		var proposed = '(Neu) ';
		var accessible = 'Zur Vereinfachung und besseren Übersichtlichkeit können neue Felder hinzugefügt werden.';
		var legacy = '(Legacy) ';
		document.getElementById("title").textContent = "Domaininformationen — RDAP-Daten & Verifikation";
		document.getElementById("modeling").textContent = "Diese RDAP-Modellierung bietet eine strukturierte Referenz zur Interpretation von Domain-Daten und Offenlegungssemantik.";
		document.getElementById("instruction").textContent = "Hier eingeben:";
		document.getElementById("field_name").textContent = "Modelliert mit snake_case";
		document.getElementById("explanation").textContent = "Eine Übersicht und Erklärung zur Struktur und den Eigenschaften von Webdomänen.";
		document.getElementById("notices_part").textContent = legacy + accessible;
		document.getElementById("links_part").textContent = legacy + accessible;
		document.getElementById("field_publication_part").textContent = "Daten können abgeschirmt sein. Interpretation erfordert RFC-Modellierung.";
		document.getElementById("field_publication").textContent = modeling;
		document.getElementById("metadata_part").textContent = proposed + "Metadaten liefern Kontext und Details zu Datenelementen.";
		document.getElementById("metadata_object_type").textContent = modified;
		document.getElementById("metadata_rdap_version").textContent = modified;
		document.getElementById("metadata_rdap_data_layer").textContent = proposed + "Gibt an, aus welcher RDAP-Ebene die Daten stammen.";
		document.getElementById("metadata_rdap_issue_uri").textContent = proposed + "URI zur Meldung technischer oder Datenintegritätsprobleme bei RDAP";
		document.getElementById("metadata_tld_policies_uri").textContent = proposed + "Eingeschränkte Nutzung. Interpretation hängt vom TLD- und RDAP-Kontext ab.";
		document.getElementById("metadata_global_json_response_uri").textContent = proposed + "JSON-Antwort über eine globale RDAP-URI, die auf eine andere RDAP-Quelle verweisen kann.";
		document.getElementById("metadata_registry_json_response_uri").textContent = proposed + "URI der RDAP-JSON-Antwort der Registry; Beziehung 'self'.";
		document.getElementById("metadata_registrar_identifiers").textContent = modified + "Kennungen, die dem Registrar zugeordnet sind. Eine IANA-Registrar-ID muss gültig sein.";
		document.getElementById("metadata_registrar_json_response_uri").textContent = proposed + "URI der RDAP-JSON-Antwort des Registrars; Beziehung 'related'."
		document.getElementById("metadata_registrar_complaint_uri").textContent = proposed + 'Erforderlich, wenn der Registrar von der IANA akkreditiert ist, um eine Beschwerde bearbeiten zu lassen.';
		document.getElementById("metadata_registrar_publication_method").textContent = proposed + "Für gTLDs kann der Inhaber die Veröffentlichung pro Registrantenfeld aktivieren.";
		document.getElementById("metadata_status_explanation_uri").textContent = proposed + 'Erforderlich, wenn der Registrar IANA-akkreditiert ist; bietet Erklärungen zum Statuscode.';
		document.getElementById("metadata_resource_upload_at").textContent = modified + "Zeitstempel der Aktualisierung des RDAP-Datensatzes in UTC (Zulu-Zeit).";
		document.getElementById("domain_part").textContent = "Eine Domain unterhalb der TLD-Ebene ist weltweit eindeutig und kann unter bestimmten Regeln frei gewählt werden.";
		document.getElementById("domain_ascii_name").textContent = "Für Sonderzeichen enthalten die ASCII-Zeichenfolgen eine Punycode-Transkription.";
		document.getElementById("domain_unicode_name").textContent = "Optionales Feld, das gegebenenfalls die Unicode-Darstellung der Domäne bereitstellt.";
		document.getElementById("domain_statuses").textContent = legacy + "RDAPv1 garantiert nicht, ob Status von Registry, Registrar, oder Lifecycle stammt — eliminierbar.";
		document.getElementById("domain_policy_statuses").textContent = modified;
		document.getElementById("domain_dns_state").textContent = proposed + "Modellierte DNS-Auflösungszustände: dns_delegated, dns_undelegated, no_dns_records, unknown.";
		document.getElementById("domain_created_at").textContent = "Die Datumsfelder stehen hier in einer logischen Reihenfolge. Auch dies ist im JSON-Array einfach.";
		document.getElementById("domain_latest_data_mutation_at").textContent = modified + "Unterschiedliche Mutationsebenen: Kontaktobjekt (Registrar) versus Domainobjekt (Registry).";
		document.getElementById("domain_expiration_at").textContent = "Ablaufschwelle der Domain, nach der die Befugnisse des Registrars abnehmen.";
		document.getElementById("domain_lifecycle_phase").textContent = modified + "Der EPP-Status 'redemptionPeriod' kann in RDAPv2 auf 'pending_redemption' geändert werden.";
		document.getElementById("domain_lifecycle_phase_until").textContent = modified;
		document.getElementById("domain_applicable_grace").textContent = modified;
		document.getElementById("domain_applicable_grace_until").textContent = modified;		
		document.getElementById("domain_recoverable_until").textContent = proposed + "Modelliert als nach Ende der DNS-Veröffentlichung + TLD pending_redemption_days.";
		document.getElementById("domain_deletion_at").textContent = "Datum und Uhrzeit für die vollständige Löschung geplant. Es kann eine abschließende Löschphase geben.";
		document.getElementById("domain_extensions").textContent = "'Eligibility': Wie die Domain die spezifischen Anforderungen der TLD-Rootzone erfüllt.";
		document.getElementById("sponsor_part").textContent = "Die Domainregistrierung kann gegebenenfalls über eine Sponsorenrolle verwaltet werden. Siehe z.B. france.fr.";
		document.getElementById("registrant_part").textContent = "Jurisdiktionsreferenz: Niederlassungsland des legitimen Registranten oder Organisationsnutzers.";
		document.getElementById("registrant_server_handle").textContent = proposed + "Ohne diese Kennung kann ein globaler RDAP-Server nicht aktualisiert werden.";
		document.getElementById("registrant_client_handle").textContent = 'Für "janwillemstegink.nl" werden vertrauliche Informationen mit "STE135420-TRAP" gekennzeichnet.';
		document.getElementById("registrant_web_id").textContent = proposed + "Web-Identifikationsnummer für Unternehmen und natürliche Personen.";
		document.getElementById("registrant_organization_type").textContent = 'Der übliche Wert ist "work" oder möglicherweise "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "Der offizielle Name der Organisation, die hauptsächlich für das Domänenabonnement verantwortlich ist.";
		document.getElementById("registrant_presented_name").textContent = "Erwartet wird der Name der primär verantwortlichen Person oder einer Rolle innerhalb der Organisation.";
		document.getElementById("registrant_kind").textContent = "Leer / 'org' / 'individual' (Für Kontinuität: Patientenverfügung + Testament + digitaler Testamentsvollstrecker)";
		document.getElementById("registrant_name").textContent = "Ein Personenname kann im Feld 'presented_name' öffentlich sichtbar sei. Siehe beispielsweise cira.ca.";
		document.getElementById("registrant_contact_uri").textContent = "Diese Kontakt-URI kann auf einen professionell verwalteten Endpunkt verweisen.";
		document.getElementById("registrant_country_code").textContent = "ISO-2-Ländercode-Indexierung, z. B. für das Vereinigte Königreich, einschließlich Fälle nach dem EU-Austritt.";
		document.getElementById("registrant_street_address").textContent = "Das Abschirmen von Adressdaten wie bei example.tel, führt zu unordentlichen Daten.";
		document.getElementById("registrant_postal_code").textContent = "In der Datenbank ist eine Indizierung nach Postleitzahl erforderlich. Das vCard-Array stellt ein Hindernis dar.";	
		document.getElementById("registrant_country_name").textContent = "Ein öffentlich sichtbarer Ländername ist auf 'gTLD registrar RDAP' beschränkt (Designänderung).";
		document.getElementById("registrant_verification_received_at").textContent = proposed + "Nach der Identifizierung kann eine passende Web-ID bestätigt werden, leer ist der Widerruf.";
		document.getElementById("registrant_verification_set_at").textContent = proposed + "Anschließend verifiziert die Registry die Daten beim länderspezifischen Webdomänendienst.";
		document.getElementById("registrant_remarks").textContent = "Weitere Informationen. Siehe beispielsweise france.fr.";
		document.getElementById("administrative_part").textContent = "Die administrativ zuständige Stelle beantwortet eine Anfrage und leitet sie gegebenenfalls weiter.";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_part").textContent = "Ein technischer Kontakt reagiert, um eine gemeldete Störung zu beheben.";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_part").textContent = "Einige Domänenregistrierungen führen Aufzeichnungen, um ihre Abrechnung durchzuführen.";
		document.getElementById("emergency_part").textContent = proposed + "Die erforderlichen Zugänge kann eine verantwortliche Person bereitstellen.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("fallback_part").textContent = proposed + "Kontakt, der verwendet wird, wenn Kontaktdaten nicht öffentlich sichtbar sind.";
		document.getElementById("reseller_part").textContent = "In zweiter Linie ist der Domain-Reseller, ebenfalls je nach Vereinbarung und Regelungen, verantwortlich.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;		
		document.getElementById("registrar_part").textContent = "Der Domänenregistrar ist für die Domänenreservierung und das IP-Adressrouting verantwortlich.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_email").textContent = "Ein Registrar muss ohne weitere Hyperlinks erreichbar sein. Siehe beispielsweise example.tel.";
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;
		document.getElementById("registrar_abuse_part").textContent = "Informationen darüber, wie Dritte den Registrar oder die beauftragte Partei kontaktieren können. Siehe fryslan.frl.";
		document.getElementById("registrar_abuse_phone").textContent = "Eine Telefonnummer muss mit dem Typ beginnen. Erlaubt sind grundsätzlich 'voice' und 'fax'.";		
		document.getElementById("nameservers_rdap_dnssec_signed").textContent = "DNSSEC sichert DNS gegen Spoofing und Cache-Poisoning.";
		document.getElementById("nameservers_rdap_ds_digest_types").textContent = "Der hexadezimale Digest-Wert unterscheidet nicht zwischen Groß- und Kleinschreibung.";
		document.getElementById("measured_ds_algorithms").textContent = proposed + "Dieses Tool ermittelt DNSSEC-Algorithmen direkt, unabhängig von RDAP, auch bei temporärer Doppelung.";		
		document.getElementById("nameservers_rdap_ds_algorithms").textContent = "Algorithmen 13–16 sind aktuell. IANA führt Algorithmus 8 als RECOMMENDED, gilt als auslaufend.";
		document.getElementById("nameservers_ipv4_addresses").textContent = "Ein Glue-Record ist ein DNS-Eintrag, den die übergeordnete Zone bereitstellt, obwohl sie nicht autoritativ ist,";
		document.getElementById("nameservers_ipv6_addresses").textContent = "um zirkuläre Abhängigkeiten bei der Auflösung von Nameservern in der untergeordneten Zone zu verhindern.";		
		document.getElementById("br_tld").textContent = "TLD .br: Die RDAP-Daten wurden mit der Nameserver-Validierung angepasst.";
		document.getElementById("raw_data_next").textContent = "Anmerkungen: Die Beziehungen sind hier nach Verantwortung angeordnet. Deutlicher mit '(not provided)'. Eine JSON-Struktur kann genauso gut lesbar sein wie XML.";
	}
	else if (translation == 4)	{
		var modified = '(Modifié) ';
		var proposed = '(Nouveau) ';
		var accessible = "Pour plus de facilité d'utilisation et de clarté, de nouveaux champs peuvent être ajoutés.";
		var legacy = '(Legacy) ';
		document.getElementById("title").textContent = "Informations sur le domaine — Données RDAP & Vérification";
		document.getElementById("modeling").textContent = "Cette modélisation RDAP fournit une référence structurée pour l’interprétation des données de domaine et de la sémantique de divulgation.";
		document.getElementById("instruction").textContent = "Saisissez ici :";
		document.getElementById("field_name").textContent = "Modélisé en snake_case";
		document.getElementById("explanation").textContent = "Un aperçu et une explication de la structure et des caractéristiques des domaines Web.";
		document.getElementById("notices_part").textContent = legacy + accessible;
		document.getElementById("links_part").textContent = legacy + accessible;
		document.getElementById("field_publication_part").textContent = "Les données peuvent être masquées. Interprétation nécessite une modélisation RFC.";
		document.getElementById("field_publication").textContent = modeling;
		document.getElementById("metadata_part").textContent = proposed + "Les métadonnées fournissent le contexte et des détails sur les éléments de données.";
		document.getElementById("metadata_object_type").textContent = modified;
		document.getElementById("metadata_rdap_version").textContent = modified;
		document.getElementById("metadata_rdap_data_layer").textContent = proposed + "Indique la couche RDAP dont proviennent les données.";
		document.getElementById("metadata_rdap_issue_uri").textContent = proposed + "URI pour signaler des problèmes techniques ou d’intégrité des données RDAP";
		document.getElementById("metadata_tld_policies_uri").textContent = proposed + "Utilisation restreinte. L’interprétation dépend du contexte TLD et RDAP.";
		document.getElementById("metadata_global_json_response_uri").textContent = proposed + "Réponse JSON via une URI RDAP globale pouvant référencer une autre source RDAP.";
		document.getElementById("metadata_registry_json_response_uri").textContent = proposed + "URI de la réponse JSON RDAP du registre ; relation 'self'.";
		document.getElementById("metadata_registrar_identifiers").textContent = modified + "Identifiants associés au registrar. Tout identifiant de registrar IANA doit être valide.";
		document.getElementById("metadata_registrar_json_response_uri").textContent = proposed + "URI de la réponse JSON RDAP du bureau d’enregistrement ; relation 'related'.";
		document.getElementById("metadata_registrar_complaint_uri").textContent = proposed + "Obligatoire si le registraire est accrédité par l'IANA, afin de pouvoir traiter une plainte.";
		document.getElementById("metadata_registrar_publication_method").textContent = proposed + "Pour les gTLD, le titulaire peut activer la publication par champ du titulaire.";
		document.getElementById("metadata_status_explanation_uri").textContent = proposed + "Obligatoire si le registraire est accrédité par l'IANA ; fournit des explications sur le code de statut.";
		document.getElementById("metadata_resource_upload_at").textContent = modified + "Horodatage de la mise à jour de l'ensemble de données RDAP en UTC (heure Zulu).";
		document.getElementById("domain_part").textContent = "Un domaine inférieur au niveau TLD est unique au monde et peut être choisi librement selon certaines règles.";
		document.getElementById("domain_ascii_name").textContent = "Pour les caractères spéciaux, les chaînes de caractères ASCII contiennent une transcription Punycode.";
		document.getElementById("domain_unicode_name").textContent = "Champ facultatif qui fournit la représentation Unicode du domaine, le cas échéant.";
		document.getElementById("domain_statuses").textContent = legacy + "Les statuts ne garantissent pas que RDAPv1 indique registre, registrar, ou cycle — éliminable.";
		document.getElementById("domain_policy_statuses").textContent = modified;
		document.getElementById("domain_dns_state").textContent = proposed + "États de résolution DNS modélisés : dns_delegated, dns_undelegated, no_dns_records, unknown.";
		document.getElementById("domain_created_at").textContent = "Les champs de date sont ici classés dans un ordre logique. C'est également facile dans le tableau JSON.";
		document.getElementById("domain_latest_data_mutation_at").textContent = modified + "Niveaux de mutation distincts : objet contact (registrar) vs objet domaine (registre).";
		document.getElementById("domain_expiration_at").textContent = "Limite d’expiration du domaine, après laquelle les droits du registrar diminuent.";
		document.getElementById("domain_lifecycle_phase").textContent = modified + "Le statut 'redemptionPeriod' de l’EPP peut être modifié en 'pending_redemption' dans RDAPv2.";
		document.getElementById("domain_lifecycle_phase_until").textContent = modified;
		document.getElementById("domain_applicable_grace").textContent = modified;
		document.getElementById("domain_applicable_grace_until").textContent = modified;		
		document.getElementById("domain_recoverable_until").textContent = proposed + "Modélisé comme après l’arrêt de publication DNS + TLD pending_redemption_days.";
		document.getElementById("domain_deletion_at").textContent = "Date et heure prévues pour la suppression complète. Une phase de suppression finale peut exister.";
		document.getElementById("domain_extensions").textContent = "'Eligibility' : comment le domaine répond aux exigences spécifiques de la zone racine TLD.";
		document.getElementById("sponsor_part").textContent = "L'enregistrement du domaine peut être géré par un sponsor, le cas échéant. Voir par exemple france.fr.";
		document.getElementById("registrant_server_handle").textContent = proposed + "Sans cet identifiant, un serveur RDAP global ne peut pas être mis à jour.";
		document.getElementById("registrant_part").textContent = "Référence de juridiction fondée sur le pays d’établissement du titulaire légitime ou de l’utilisateur organisationnel.";
		document.getElementById("registrant_client_handle").textContent = 'Pour "janwillemstegink.nl", les informations confidentielles sont indiquées par "STE135420-TRAP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Numéro d’identification Web pour les entités commerciales et les personnes physiques.";
		document.getElementById("registrant_organization_type").textContent = 'La valeur habituelle est "work", ou éventuellement "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "Le nom légal de l'organisation principalement responsable de l'abonnement au domaine.";
		document.getElementById("registrant_presented_name").textContent = "Le nom de la personne principalement responsable ou d’un rôle au sein de l’organisation est attendu.";
		document.getElementById("registrant_kind").textContent = "Vide / 'org' / 'individual' (Pour la continuité : testament biologique + testament + exécuteur testamentaire numérique)";
		document.getElementById("registrant_name").textContent = "Un nom personnel peut être visible publiquement dans le champ 'presented_name'. Voir, par exemple, cira.ca.";
		document.getElementById("registrant_contact_uri").textContent = "Cet URI de contact peut pointer vers un point d’accès géré de manière professionnelle.";
		document.getElementById("registrant_country_code").textContent = "Indexation par code pays ISO-2, par ex. pour le Royaume-Uni, y compris après le retrait de l’UE.";
		document.getElementById("registrant_street_address").textContent = "Le blindage des données d'adresse comme avec example.tel, génère des données désordonnées.";
		document.getElementById("registrant_postal_code").textContent = "L'indexation par code postal est nécessaire dans la base de données. Le tableau de vCard constitue un obstacle.";
		document.getElementById("registrant_country_name").textContent = "Un nom de pays visible publiquement est limité à 'gTLD registrar RDAP' (changement de conception).";
		document.getElementById("registrant_verification_received_at").textContent = proposed + "Après identification, un identifiant Web correspondant peut être confirmé, vide signifie révocation.";
		document.getElementById("registrant_verification_set_at").textContent = proposed + "Le registre vérifie ensuite les données avec le service de domaine Web spécifique au pays.";
		document.getElementById("registrant_remarks").textContent = "Plus d'informations. Voir, par exemple, france.fr.";
		document.getElementById("administrative_part").textContent = "Le bureau administrativement responsable répond à une demande, et la transmet si nécessaire.";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("technical_part").textContent = "Un contact technique répond pour résoudre un dysfonctionnement signalé.";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("billing_part").textContent = "Certains registres de domaine conservent des enregistrements pour effectuer leur facturation.";
		document.getElementById("emergency_part").textContent = proposed + "Une personne responsable peut fournir l'accès nécessaire.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("fallback_part").textContent = proposed + "Contact utilisé lorsque les données de contact ne sont pas visibles publiquement.";
		document.getElementById("reseller_part").textContent = "Le revendeur de domaine est en second lieu responsable, également en fonction de l'accord et des réglementations.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_verification_received_at").textContent = proposed;
		document.getElementById("reseller_verification_set_at").textContent = proposed;		
		document.getElementById("registrar_part").textContent = "Le registraire de domaine est responsable des réservations de domaines et du routage des adresses IP.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_email").textContent = "Un registraire doit être joignable sans lien hypertexte supplémentaire. Voir, par exemple, example.tel.";
		document.getElementById("registrar_verification_received_at").textContent = proposed;
		document.getElementById("registrar_verification_set_at").textContent = proposed;
		document.getElementById("registrar_abuse_part").textContent = "Informations sur la manière dont un tiers peut contacter le registraire ou la partie mandatée. Voir fryslan.frl.";
		document.getElementById("registrar_abuse_phone").textContent = "Un numéro de téléphone doit commencer par le type. Sont autorisés de toute façon 'voice' et 'fax'.";
		document.getElementById("nameservers_rdap_dnssec_signed").textContent = "DNSSEC sécurise le DNS contre le spoofing et l’empoisonnement.";
		document.getElementById("nameservers_rdap_ds_algorithms").textContent = "Les algorithmes 13–16 sont actuels. L’IANA classe l’algorithme 8 comme RECOMMENDED, en fin de vie.";
		document.getElementById("nameservers_rdap_ds_digest_types").textContent = "La valeur de hachage hexadécimale n'est pas sensible à la casse.";
		document.getElementById("measured_ds_algorithms").textContent = proposed + "Mesure directe des algorithmes DNSSEC, indépendante du RDAP, y compris duplication temporaire.";
		document.getElementById("nameservers_ipv4_addresses").textContent = "Un glue record est un enregistrement DNS fourni par la zone parente, bien qu’elle n’en soit pas autoritaire,";
		document.getElementById("nameservers_ipv6_addresses").textContent = "afin d’éviter les dépendances circulaires lors de la résolution des serveurs de noms de la zone enfant.";		
		document.getElementById("br_tld").textContent = "TLD .br: Les données RDAP ont été ajustées avec la validation du serveur de noms.";
		document.getElementById("raw_data_next").textContent = "Remarques : Les relations sont ici organisés selon la responsabilité. Plus clair avec '(not provided)'. Une structure JSON peut être aussi lisible que du XML.";
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
$rdap_uri = $server_uri.'/compose_domain/index.php?batch=0&domain='.$pd;
$context = stream_context_create([
  'http' => [
    'method'  => 'GET',
    'timeout' => 5,
    'header'  => "Accept: application/json\r\n",
  ],
]);
$json = @file_get_contents($rdap_uri, false, $context);

if ($json === false) {
  $err = error_get_last();
  die("The RDAP endpoint could not be reached. " . ($err['message'] ?? 'Unknown error'));
}
$data = json_decode($json, true);
if (!is_array($data)) {
  die("The RDAP endpoint returned invalid JSON.");
}
$tld_policies_uri = $server_uri.'/modeling_tld/index.php?language='.$viewlanguage.'&tld='.$data[$pd]['registry']['metadata']['tld_ascii_name'];
$raw_whois = $server_uri.'/domain_whois/index.php?language='.$viewlanguage.'&domain='.$vd;
if	(is_null($data))	{
	$tld_policies_uri = '';
	$raw_whois = '';
	$reopen = $server_uri.'/modeling_domain/index.php?batch=0&domain=domain';
	sc_redir($reopen);
}
$html_text = '<body onload=SwitchTranslation('.$viewlanguage.')><div style="line-height: 1.2;">
<table class="top-align" style="border-collapse:collapse; font-family:Helvetica, Arial, sans-serif; font-size: 1rem; table-layout: fixed; width:1675px">
<tr><th style="width:325px"></th><th style="width:300px"></th><th style="width:750px"></th><th style="width:300px"></th></tr>';
$html_text .= '<tr style="font-size: 0.9rem"><td colspan="2" id="title" style="font-size: 1.4rem;color:blue;font-weight:bold"></td><td colspan="2" id="modeling"></td></tr>';
$html_text .= '<tr><td id="instruction" style="font-size: 0.8rem; vertical-align:middle; text-align: right;"></td><td><form action='.htmlentities($_SERVER['PHP_SELF']).' method="get">
	<input type="hidden" id="language" name="language" value='.$viewlanguage.'>	
	<input type="text" style="width:90%" id="domain" name="domain" value='.$vd.'></form></td><td>
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(99)">None</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(1)">nl_NL</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(2)">en_US</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(3)">de_DE</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(4)">fr_FR</button> 
	<a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_email" target="_blank">Email modeling</a> - <a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap.hostingtool.nl" target="_blank">Code/issues on GitHub</a> - <a style="font-size: 0.9rem" href="https://janwillemstegink.nl/" target="_blank">Insight at janwillemstegink.nl</a></td><td></td></tr>';
if (true or $pd == mb_strtolower($data[$pd]['registry']['domain']['ascii_name']) or empty($data[$pd]['registry']['domain']['ascii_name']))	{
	$html_text .= '<tr style="font-size:1.05rem;font-weight:bold"><td id="field_name"></td><td>registry_rdap_service<td id="explanation"></td><td>registrar_rdap_service</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(11)">Notices +/-</button><td></td><td id="notices_part"></td><td></td></tr>';
	$html_text .= '<tr id="111" style="display:none"><td colspan="2">'.$data[$pd]['registry']['notices'].'</td><td></td><td>'.$data[$pd]['registrar']['notices'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(12)">Links +/-</button><td></td><td id="links_part"></td><td></td></tr>';
	$html_text .= '<tr id="121" style="display:none"><td colspan="2">'.$data[$pd]['registry']['links'].'</td><td></td><td>'.$data[$pd]['registrar']['links'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(13)">Field Publication +/-</button></td><td></td><td id="field_publication_part"></td><td></td></tr>';
	$html_text .= '<tr id="131" style="display:none"><td colspan="2">'.$data[$pd]['registry']['field_publication'].'</td><td id="field_publication" style="white-space: pre-wrap; font-family: monospace; line-height: 1.4; font-size: 13px;"></td><td>'.$data[$pd]['registrar']['field_publication'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(20)">Metadata +/-</button></td><td></td><td id="metadata_part"></td><td></td></tr>';
	$html_text .= '<tr id="201" style="display:none"><td>object_type</td><td>'.$data[$pd]['registry']['metadata']['object_type'].'</td><td id="metadata_object_type"></td><td>'.$data[$pd]['registrar']['metadata']['object_type'].'</td></tr>';
	$html_text .= '<tr id="202" style="display:none"><td>rdap_version</td><td>'.$data[$pd]['registry']['metadata']['rdap_version'].'</td><td id="metadata_rdap_version"></td><td>'.$data[$pd]['registrar']['metadata']['rdap_version'].'</td></tr>';
	$html_text .= '<tr id="203" style="display:none"><td>rdap_conformance</td><td colspan="2">'.$data[$pd]['registry']['metadata']['rdap_conformance'].'</td><td>'.$data[$pd]['registrar']['metadata']['rdap_conformance'].'</td></tr>';
	$html_text .= '<tr id="204" style="display:none"><td>rdap_data_layer</td><td>'.$data[$pd]['registry']['metadata']['rdap_data_layer'].'</td><td id="metadata_rdap_data_layer"></td><td>'.$data[$pd]['registrar']['metadata']['rdap_data_layer'].'</td></tr>';
	$html_text .= '<tr id="205" style="display:none"><td>rdap_issue_uri</td><td>'.$data[$pd]['registry']['metadata']['rdap_issue_uri'].'</td><td id="metadata_rdap_issue_uri"></td><td>'.$data[$pd]['registrar']['metadata']['rdap_issue_uri'].'</td></tr>';
	$html_text .= '<tr id="206" style="display:none"><td>global_json_response_uri</td><td>'.$data[$pd]['registry']['metadata']['global_json_response_uri'].'</td><td id="metadata_global_json_response_uri"></td><td>'.$data[$pd]['registrar']['metadata']['global_json_response_uri'].'</td></tr>';
	$registry_json_response_uri = str_replace('https://', '', $data[$pd]['registry']['metadata']['registry_json_response_uri']);
	$validation_registry = 'https://validator.rdap.org/?url=https://'.$registry_json_response_uri.'&response-type=domain&server-type=gtld-registry&errors-only=1';	
	$html_text .= '<tr><td>registry_json_response_uri</td><td>'.((!empty($data[$pd]['registry']['metadata']['registry_json_response_uri'])) ? '<a href='.$data[$pd]['registry']['metadata']['registry_json_response_uri'].' target="_blank">Registry Response</a> - <a href="' . htmlspecialchars($validation_registry, ENT_QUOTES, "UTF-8") . '" target="_blank">gTLD validator.rdap.org</a>' : '').'</td><td id="metadata_registry_json_response_uri"></td><td>'.$data[$pd]['registrar']['metadata']['registry_json_response_uri'].'</td></tr>';
	$html_text .= '<tr><td>registrar_json_response_uri</td><td>'.((!empty($data[$pd]['registry']['metadata']['registrar_json_response_uri'])) ? '<a href='.$data[$pd]['registry']['metadata']['registrar_json_response_uri'].' target="_blank">Registrar Response</a> - <a href="' . htmlspecialchars($validation_registrar, ENT_QUOTES, "UTF-8") . '" target="_blank">gTLD validator.rdap.org</a>' : '').'</td><td id="metadata_registrar_json_response_uri"></td><td>'.$data[$pd]['registrar']['metadata']['registrar_json_response_uri'].'</td></tr>';	
	$html_text .= '<tr><td>tld_policies_uri</td><td>'.((!empty($tld_policies_uri)) ? '<a href="'.$tld_policies_uri.'" target="_blank">.'.$data[$pd]['registry']['tld_unicode_name'].' TLD Policies</a>' : '').'</td><td id="metadata_tld_policies_uri"></td><td></td></tr>';
	$html_text .= '<tr id="207" style="display:none"><td>registry_geo_location</td><td>'.$data[$pd]['registry']['metadata']['registry_geo_location'].'</td><td></td><td>'.$data[$pd]['registrar']['metadata']['registry_geo_location'].'</td></tr>';
	$html_text .= '<tr id="208" style="display:none"><td>registrar_identifiers</td><td>'.((!empty($data[$pd]['registry']['metadata']['registrar_identifiers'])) ? $data[$pd]['registry']['metadata']['registrar_identifiers'] : '').'</td><td id="metadata_registrar_identifiers"></td><td>'.$data[$pd]['registrar']['metadata']['registrar_identifiers'].'</td></tr>';
	$registrar_json_response_uri = str_replace('https://', '', $data[$pd]['registry']['metadata']['registrar_json_response_uri']);
	$validation_registrar = 'https://validator.rdap.org/?url=https://'.$registrar_json_response_uri.'&response-type=domain&server-type=gtld-registrar&errors-only=1';	
	$html_text .= '<tr id="209" style="display:none"><td>registrar_complaint_uri</td><td>'.((!empty($data[$pd]['registry']['metadata']['registrar_complaint_uri'])) ? '<a href='.$data[$pd]['registry']['metadata']['registrar_complaint_uri'].' target="_blank">icann.org/wicf</a>' : '').'</td><td id="metadata_registrar_complaint_uri"></td><td>'.$data[$pd]['registrar']['metadata']['registrar_complaint_uri'].'</td></tr>';
	$html_text .= '<tr id="2010" style="display:none"><td>registrar_publication_method</td><td>'.$data[$pd]['registry']['metadata']['registrar_publication_method'].'</td><td id="metadata_registrar_publication_method"></td><td>'.$data[$pd]['registrar']['metadata']['registrar_publication_method'].'</td></tr>';
	$html_text .= '<tr id="2011" style="display:none"><td>registrar_uri_links</td><td colspan="2">'.$data[$pd]['registry']['metadata']['registrar_uri_links'].'</td><td>'.$data[$pd]['registrar']['metadata']['registrar_uri_links'].'</td></tr>';
	$html_text .= '<tr id="2012" style="display:none"><td>status_explanation_uri</td><td>'.((!empty($data[$pd]['registry']['metadata']['status_explanation_uri'])) ? '<a href='.$data[$pd]['registry']['metadata']['status_explanation_uri'].' target="_blank">icann.org/epp</a>' : '').'</td><td id="metadata_status_explanation_uri"></td><td>'.$data[$pd]['registrar']['metadata']['status_explanation_uri'].'</td></tr>';
	$html_text .= '<tr><td>resource_upload_at</td><td>'.$data[$pd]['registry']['metadata']['resource_upload_at'].'</td><td id="metadata_resource_upload_at"></td><td>'.$data[$pd]['registrar']['metadata']['resource_upload_at'].'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	if (!empty($data[$pd]['registry']['interface_notice']) or !empty($data[$pd]['registrar']['interface_notice']))	{
		$html_text .= '<tr><td><b>interface_notice</b></td><td>'.str_replace(',',',<br />',$data[$pd]['registry']['interface_notice']).'</td><td></td><td>'.str_replace(',',',<br />',$data[$pd]['registrar']['interface_notice']).'</td></tr>';
	}
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(30)">Domain Properties +/-</button></td><td><b>'.$vd.'</b></td><td id="domain_part"></td><td></td></tr>';
	$html_text .= '<tr id="301" style="display:none"><td>domain_server_handle</td><td colspan="2">'.$data[$pd]['registry']['domain']['server_handle'].'</td><td>'.$data[$pd]['registrar']['domain']['server_handle'].'</td></tr>';
	$html_text .= '<tr id="302" style="display:none"><td>domain_client_handle</td><td colspan="2">'.$data[$pd]['registry']['domain']['client_handle'].'</td><td>'.$data[$pd]['registrar']['domain']['client_handle'].'</td></tr>';
	$html_text .= '<tr id="303" style="display:none"><td>domain_ascii_name (lowercase is no "MUST")</td><td>'.$data[$pd]['registry']['domain']['ascii_name'].'</td><td id="domain_ascii_name"></td><td>'.$data[$pd]['registrar']['domain']['ascii_name'].'</td></tr>';
	$html_text .= '<tr id="304" style="display:none"><td>domain_unicode_name</td><td>'.$data[$pd]['registry']['domain']['unicode_name'].'</td><td id="domain_unicode_name"></td><td>'.$data[$pd]['registrar']['domain']['unicode_name'].'</td></tr>';
	$domain_statuses = (!empty($data[$pd]['registry']['domain']['statuses'])) ? $data[$pd]['registry']['domain']['statuses'] : '';
	$domain_statuses = str_replace('excluded','<br />excluded (without DNS no email protection)', $domain_statuses);
	$domain_statuses = str_replace('locked','<br />locked (ambiguous RDAP use)', $domain_statuses);
	$domain_statuses = str_replace('removed','<br />removed (ambiguous RDAP use)', $domain_statuses);
	$domain_statuses = str_replace('obscured','<br />obscured (ambiguous RDAP use)', $domain_statuses);
	$domain_statuses = str_replace('private','<br />private (ambiguous RDAP use)', $domain_statuses);
	$domain_statuses = str_replace('proxy','<br />proxy (ambiguous RDAP use)', $domain_statuses);
	$domain_statuses = str_replace('associated','<br />associated (ambiguous RDAP use)', $domain_statuses);
	if (str_contains($data[$pd]['registry']['domain']['statuses'], 'renew prohibited'))	{
		if (!str_contains($data[$pd]['registry']['domain']['statuses'], 'server renew prohibited') and !str_contains($data[$pd]['registry']['domain']['statuses'], 'client renew prohibited'))	{
			$domain_statuses = str_replace('renew prohibited','<br />renew prohibited (ambiguous RDAP use)', $domain_statuses);
		}
	}
	if (str_contains($data[$pd]['registry']['domain']['statuses'], 'update prohibited'))	{
		if (!str_contains($data[$pd]['registry']['domain']['statuses'], 'server update prohibited') and !str_contains($data[$pd]['registry']['domain']['statuses'], 'client update prohibited'))	{
			$domain_statuses = str_replace('update prohibited','<br />update prohibited (ambiguous RDAP use)', $domain_statuses);
		}
	}
	if (str_contains($data[$pd]['registry']['domain']['statuses'], 'transfer prohibited'))	{
		if (!str_contains($data[$pd]['registry']['domain']['statuses'], 'server transfer prohibited') and !str_contains($data[$pd]['registry']['domain']['statuses'], 'client transfer prohibited'))	{
			$domain_statuses = str_replace('transfer prohibited','<br />transfer prohibited (ambiguous RDAP use)', $domain_statuses);
		}
	}	
	if (str_contains($data[$pd]['registry']['domain']['statuses'], 'delete prohibited'))	{
		if (!str_contains($data[$pd]['registry']['domain']['statuses'], 'server delete prohibited') and !str_contains($data[$pd]['registry']['domain']['statuses'], 'client delete prohibited'))	{
			$domain_statuses = str_replace('delete prohibited','<br />delete prohibited (ambiguous RDAP use)', $domain_statuses);
		}
	}	
	$html_text .= '<tr id="305" style="display:none"><td>domain_statuses</td><td>'.$domain_statuses.'</td><td id="domain_statuses"></td><td>'.$data[$pd]['registrar']['domain']['statuses'].'</td></tr>';
	$html_text .= '<tr id="306" style="display:none"><td>domain_policy_statuses</td><td>'.$data[$pd]['registry']['domain']['policy_statuses'].'</td><td id="domain_policy_statuses"></td><td>'.$data[$pd]['registrar']['domain']['policy_statuses'].'</td></tr>';
	$html_text .= '<tr><td>domain_dns_state</td><td>'.$data[$pd]['registry']['domain']['dns_state'].'</td><td id="domain_dns_state"></td><td>'.$data[$pd]['registrar']['domain']['dns_state'].'</td></tr>';
	$html_text .= '<tr id="307" style="display:none"><td>domain_created_at</td><td>'.$data[$pd]['registry']['domain']['created_at'].'</td><td id="domain_created_at"></td><td>'.$data[$pd]['registrar']['domain']['created_at'].'</td></tr>';
	$html_text .= '<tr id="308" style="display:none"><td>domain_latest_registrar_transfer_at</td><td>'.$data[$pd]['registry']['domain']['latest_registrar_transfer_at'].'</td><td></td><td>'.$data[$pd]['registrar']['domain']['latest_registrar_transfer_at'].'</td></tr>';		
	$html_text .= '<tr><td>domain_latest_data_mutation_at</td><td>'.$data[$pd]['registry']['domain']['latest_data_mutation_at'].'</td><td id="domain_latest_data_mutation_at"></td><td>'.$data[$pd]['registrar']['domain']['latest_data_mutation_at'].'</td></tr>';	
	$html_text .= '<tr><td>domain_expiration_at</td><td>'.$data[$pd]['registry']['domain']['expiration_at'].'</td><td id="domain_expiration_at"></td><td>'.$data[$pd]['registrar']['domain']['expiration_at'].'</td></tr>';
	$html_text .= '<tr id="309" style="display:none"><td>domain_lifecycle_phase</td><td>'.$data[$pd]['registry']['domain']['lifecycle_phase'].'</td><td id="domain_lifecycle_phase"></td><td>'.$data[$pd]['registrar']['domain']['lifecycle_phase'].'</td></tr>';
	$html_text .= '<tr id="3010" style="display:none"><td>domain_lifecycle_phase_until</td><td>'.$data[$pd]['registry']['domain']['lifecycle_phase_until'].'</td><td id="domain_lifecycle_phase_until"></td><td>'.$data[$pd]['registrar']['domain']['lifecycle_phase_until'].'</td></tr>';
	$html_text .= '<tr id="3011" style="display:none"><td>domain_applicable_grace</td><td>'.$data[$pd]['registry']['domain']['applicable_grace'].'</td><td id="domain_applicable_grace"></td><td>'.$data[$pd]['registrar']['domain']['applicable_grace'].'</td></tr>';
	$html_text .= '<tr id="3012" style="display:none"><td>domain_applicable_grace_until</td><td>'.$data[$pd]['registry']['domain']['applicable_grace_until'].'</td><td id="domain_applicable_grace_until"></td><td>'.$data[$pd]['registrar']['domain']['applicable_grace_until'].'</td></tr>';
	$html_text .= '<tr id="3013" style="display:none"><td>domain_recoverable_until</td><td>'.$data[$pd]['registry']['domain']['recoverable_until'].'</td><td id="domain_recoverable_until"></td><td>'.$data[$pd]['registrar']['domain']['recoverable_until'].'</td></tr>';
	$html_text .= '<tr id="3014" style="display:none"><td>domain_deletion_at</td><td>'.$data[$pd]['registry']['domain']['deletion_at'].'</td><td id="domain_deletion_at"></td><td>'.$data[$pd]['registrar']['domain']['deletion_at'].'</td></tr>';
	if (!empty($data[$pd]['registry']['domain']['statuses']))	{
		if (!empty($data[$pd]['registry']['domain']['lifecycle_phase']))	{
			if (str_contains($data[$pd]['registry']['domain']['lifecycle_phase'], ','))	{
				$html_text .= '<tr id="3015" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>RDAPv2: single-value for lifecycle_phase</td><td></td><td></td></tr>';
			}
		}
		if (str_contains($data[$pd]['registry']['domain']['statuses'], 'pending delete'))	{
			if (str_contains($data[$pd]['registry']['domain']['statuses'], 'redemption period') and str_contains($data[$pd]['registry']['domain']['statuses'], 'pending delete'))	{
				$html_text .= '<tr id="3016" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>"pending delete" disregards redemption grace</td><td></td><td></td></tr>';
			}	
			elseif (!empty($data[$pd]['registry']['tld_unicode_name']))	{
				if ($data[$pd]['registry']['tld_unicode_name'] == 'nl')	{
					$html_text .= '<tr id="3017" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>"pending delete" refers to "redemption period"</td><td></td><td></td></tr>';
				}	
			}	
		}
		if (str_contains($data[$pd]['registry']['domain']['statuses'], 'redemption period') or str_contains($data[$pd]['registry']['domain']['statuses'], 'pending delete'))	{
			if (!empty($data[$pd]['registry']['domain']['dns_state']))	{
				if ($data[$pd]['registry']['domain']['dns_state'] == 'dns_delegated')	{
					$html_text .= '<tr id="3018" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>upon deletion, DNS publishing is not expected</td><td></td><td></td></tr>';
				}	
			}
		}		
		if (str_contains($data[$pd]['registry']['domain']['statuses'], 'redemption period'))	{
			if (empty($data[$pd]['registry']['domain']['expiration_at']) and empty($data[$pd]['registry']['domain']['deletion_at'])) {
				$html_text .= '<tr id="3019" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>"redemption" without date-time provided</td><td></td><td></td></tr>';
			}	
		}
		elseif (str_contains($data[$pd]['registry']['domain']['statuses'], 'pending delete'))	{
			if (empty($data[$pd]['registry']['domain']['expiration_at']) and empty($data[$pd]['registry']['domain']['deletion_at'])) {
				$html_text .= '<tr id="3020" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>"pending delete" without date-time provided</td><td></td><td></td></tr>';
			}	
		}
	}
	if (!empty($data[$pd]['registry']['domain']['expiration_at']) and !empty($data[$pd]['registry']['domain']['deletion_at'])) {
    	$expiration = strtotime($data[$pd]['registry']['domain']['expiration_at']);
    	$deletion = strtotime($data[$pd]['registry']['domain']['deletion_at']);
    	if ($expiration !== false and $deletion !== false)	{
			$days_before = floor(($expiration - $deletion) / (60 * 60 * 24));
			if ($days_before > 0) {
       			$html_text .= '<tr id="3021" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>"deletion_at" '.$days_before.' days before "expiration_at"</td><td></td><td></td></tr>';
			}	
    	}
	}
	if (!empty($data[$pd]['registry']['domain']['deletion_at'])) {
		$current = strtotime($datetime->format('Y-m-d H:i:s'));
		$deletion = strtotime($data[$pd]['registry']['domain']['deletion_at']);
    	if ($current !== false and $deletion !== false and $current > $deletion) {
			$days_ago = floor(($current - $deletion) / (60 * 60 * 24));
        	$html_text .= '<tr id="3022" style="display:none"><td>(Global table definition addresses ccTLD variation)</td><td>"deletion_at" was '.$days_ago.' days ago?</td><td></td><td></td></tr>';
		}
	}	
	$html_text .= '<tr id="3023" style="display:none"><td>domain_extensions</td><td>'.$data[$pd]['registry']['domain']['extensions'].'</td><td id="domain_extensions"></td><td>'.$data[$pd]['registrar']['domain']['extensions'].'</td></tr>';
	$html_text .= '<tr id="3024" style="display:none"><td>domain_remarks</td><td>'.$data[$pd]['registry']['domain']['remarks'].'</td><td></td><td>'.$data[$pd]['registrar']['domain']['remarks'].'</td></tr>';
	if (!empty($data[$pd]['registry']['domain']['statuses']))	{
		$sponsor_applicable = (!empty($data[$pd]['registry']['sponsor']['organization_name']) or !empty($data[$pd]['registry']['sponsor']['presented_name'])) ? '(sponsor data exists)' : '(no sponsor data)';
	}
	else	{
		$sponsor_applicable = '';
	}	
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(39)">Sponsor +/-</button></td><td>'.$sponsor_applicable.'</td><td id="sponsor_part"></td><td></td></tr>';
	$html_text .= '<tr id="391" style="display:none"><td>sponsor_server_handle</td><td>'.$data[$pd]['registry']['sponsor']['server_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['server_handle'].'</td></tr>';
	$html_text .= '<tr id="392" style="display:none"><td>sponsor_client_handle</td><td>'.$data[$pd]['registry']['sponsor']['client_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['client_handle'].'</td></tr>';
	$html_text .= '<tr id="393" style="display:none"><td>sponsor_web_id</td><td>'.$data[$pd]['registry']['sponsor']['web_id'].'</td><td id="sponsor_web_id"></td><td>'.$data[$pd]['registrar']['sponsor']['web_id'].'</td></tr>';
	$html_text .= '<tr id="394" style="display:none"><td>sponsor_organization_type</td><td>'.$data[$pd]['registry']['sponsor']['organization_type'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['organization_type'].'</td></tr>';
	$html_text .= '<tr id="395" style="display:none"><td>sponsor_organization_name</td><td>'.$data[$pd]['registry']['sponsor']['organization_name'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['organization_name'].'</td></tr>';
	$html_text .= '<tr id="396" style="display:none"><td>sponsor_presented_name</td><td>'.$data[$pd]['registry']['sponsor']['presented_name'].'</td><td id="sponsor_recover"></td><td>'.$data[$pd]['registrar']['sponsor']['presented_name'].'</td></tr>';
	$html_text .= '<tr id="397" style="display:none"><td>sponsor_kind</td><td>'.$data[$pd]['registry']['sponsor']['kind'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['kind'].'</td></tr>';
	$html_text .= '<tr id="398" style="display:none"><td>sponsor_name</td><td>'.$data[$pd]['registry']['sponsor']['name'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['name'].'</td></tr>';
	$html_text .= '<tr id="399" style="display:none"><td>sponsor_email</td><td>'.$data[$pd]['registry']['sponsor']['email'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['email'].'</td></tr>';
	$html_text .= '<tr id="3910" style="display:none"><td>sponsor_phone</td><td>'.$data[$pd]['registry']['sponsor']['phone'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['phone'].'</td></tr>';
	$html_text .= '<tr id="3911" style="display:none"><td>sponsor_country_code</td><td>'.$data[$pd]['registry']['sponsor']['country_code'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['country_code'].'</td></tr>';
	$html_text .= '<tr id="3912" style="display:none"><td>sponsor_street_address</td><td>'.$data[$pd]['registry']['sponsor']['street_address'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['street_address'].'</td></tr>';
	$html_text .= '<tr id="3913" style="display:none"><td>sponsor_city</td><td>'.$data[$pd]['registry']['sponsor']['city'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['city'].'</td></tr>';
	$html_text .= '<tr id="3914" style="display:none"><td>sponsor_state_or_province</td><td>'.$data[$pd]['registry']['sponsor']['state_or_province'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['state_or_province'].'</td></tr>';
	$html_text .= '<tr id="3915" style="display:none"><td>sponsor_postal_code</td><td>'.$data[$pd]['registry']['sponsor']['postal_code'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['country_name'].'</td></tr>';
	$html_text .= '<tr id="3916" style="display:none"><td>sponsor_country_name'.if_filled($data[$pd]['registry']['sponsor']['country_name']).'</td><td>'.$data[$pd]['registry']['sponsor']['country_name'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['country_name'].'</td></tr>';
	$html_text .= '<tr id="3917" style="display:none"><td>sponsor_preferred_languages</td><td>'.$data[$pd]['registry']['sponsor']['preferred_languages'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['preferred_languages'].'</td></tr>';
	$html_text .= '<tr id="3918" style="display:none"><td>sponsor_statuses</td><td>'.$data[$pd]['registry']['sponsor']['statuses'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['statuses'].'</td></tr>';
	$html_text .= '<tr id="3919" style="display:none"><td>sponsor_created_at</td><td>'.$data[$pd]['registry']['sponsor']['created_at'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['created_at'].'</td></tr>';
	$html_text .= '<tr id="3920" style="display:none"><td>sponsor_latest_data_mutation_at</td><td>'.$data[$pd]['registry']['sponsor']['latest_data_mutation_at'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['latest_data_mutation_at'].'</td></tr>';
	$html_text .= '<tr id="3921" style="display:none"><td>sponsor_verification_received_at</td><td>'.$data[$pd]['registry']['sponsor']['verification_received_at'].'</td><td id="sponsor_verification_received_at"></td><td>'.$data[$pd]['registrar']['sponsor']['verification_received_at'].'</td></tr>';
	$html_text .= '<tr id="3922" style="display:none"><td>sponsor_verification_set_at</td><td>'.$data[$pd]['registry']['sponsor']['verification_set_at'].'</td><td id="sponsor_verification_set_at"></td><td>'.$data[$pd]['registrar']['sponsor']['verification_set_at'].'</td></tr>';
	$html_text .= '<tr id="3923" style="display:none"><td>sponsor_properties</td><td>'.$data[$pd]['registry']['sponsor']['properties'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['properties'].'</td></tr>';
	$html_text .= '<tr id="3924" style="display:none"><td>sponsor_remarks</td><td>'.$data[$pd]['registry']['sponsor']['remarks'].'</td><td></td><td>'.$data[$pd]['registrar']['sponsor']['remarks'].'</td></tr>';
	$html_text .= '<tr id="3925" style="display:none"><td>sponsor_links (RDAPv1)</td><td colspan="2">'.$data[$pd]['registry']['sponsor']['links'].'</td><td>'.$data[$pd]['registrar']['sponsor']['links'].'</td></tr>';	
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(40)">Registrant +/-</button></td><td></td><td id="registrant_part"></td><td></td></tr>';
	$html_text .= '<tr id="401" style="display:none"><td>registrant_server_handle</td><td>'.$data[$pd]['registry']['registrant']['server_handle'].'</td><td id="registrant_server_handle"></td><td>'.$data[$pd]['registrar']['registrant']['server_handle'].'</td></tr>';
	$html_text .= '<tr id="402" style="display:none"><td>registrant_client_handle</td><td>'.$data[$pd]['registry']['registrant']['client_handle'].'</td><td id="registrant_client_handle"></td><td>'.$data[$pd]['registrar']['registrant']['client_handle'].'</td></tr>';
	$html_text .= '<tr id="403" style="display:none"><td>registrant_web_id</td><td>'.$data[$pd]['registry']['registrant']['web_id'].'</td><td id="registrant_web_id"></td><td>'.$data[$pd]['registrar']['registrant']['web_id'].'</td></tr>';
	$html_text .= '<tr id="404" style="display:none"><td>registrant_organization_type</td><td>'.$data[$pd]['registry']['registrant']['organization_type'].'</td><td id="registrant_organization_type"></td><td>'.$data[$pd]['registrar']['registrant']['organization_type'].'</td></tr>';
	$html_text .= '<tr><td>registrant_organization_name</td><td>'.$data[$pd]['registry']['registrant']['organization_name'].'</td><td id="registrant_organization_name"></td><td>'.$data[$pd]['registrar']['registrant']['organization_name'].'</td></tr>';
	$html_text .= '<tr><td>registrant_presented_name (RDAP: "fn"/full name)</td><td>'.$data[$pd]['registry']['registrant']['presented_name'].'</td><td id="registrant_presented_name"></td><td>'.$data[$pd]['registrar']['registrant']['presented_name'].'</td></tr>';
	$html_text .= '<tr id="405" style="display:none"><td>registrant_kind</td><td>'.$data[$pd]['registry']['registrant']['kind'].'</td><td id="registrant_kind"></td><td>'.$data[$pd]['registrar']['registrant']['kind'].'</td></tr>';
	$html_text .= '<tr id="406" style="display:none"><td>registrant_name</td><td>'.$data[$pd]['registry']['registrant']['name'].'</td><td id="registrant_name"></td><td>'.$data[$pd]['registrar']['registrant']['name'].'</td></tr>';
	$html_text .= '<tr><td>registrant_email</td><td>'.$data[$pd]['registry']['registrant']['email'].'</td><td></td><td>'.$data[$pd]['registrar']['registrant']['email'].'</td></tr>';
	$html_text .= '<tr><td>registrant_contact_uri</td><td>'.$data[$pd]['registry']['registrant']['contact_uri'].'</td><td id="registrant_contact_uri"></td><td>'.$data[$pd]['registrar']['registrant']['contact_uri'].'</td></tr>';
	$html_text .= '<tr id="407" style="display:none"><td>registrant_phone</td><td>'.$data[$pd]['registry']['registrant']['phone'].'</td><td></td><td>'.$data[$pd]['registrar']['registrant']['phone'].'</td></tr>';
	$html_text .= '<tr><td>registrant_country_code (<a style="font-size: 0.9rem" href="https://icann-hamster.nl/ham/soac/ccnso/techday/icann80/2.%20RDAP%20Conformance%20Tool%20-%20Tech%20Day.pdf" target="_blank">"cc" parameter</a>)</td><td>'.$data[$pd]['registry']['registrant']['country_code'].'</td><td id="registrant_country_code"></td><td>'.$data[$pd]['registrar']['registrant']['country_code'].'</td></tr>';
	$html_text .= '<tr id="408" style="display:none"><td>registrant_street_address</td><td>'.$data[$pd]['registry']['registrant']['street_address'].'</td><td id="registrant_street_address"></td><td>'.$data[$pd]['registrar']['registrant']['street_address'].'</td></tr>';
	$html_text .= '<tr id="409" style="display:none"><td>registrant_city</td><td>'.$data[$pd]['registry']['registrant']['city'].'</td><td></td><td>'.$data[$pd]['registrar']['registrant']['city'].'</td></tr>';
	$html_text .= '<tr id="4010" style="display:none"><td>registrant_state_or_province</td><td>'.$data[$pd]['registry']['registrant']['state_or_province'].'</td><td></td><td>'.$data[$pd]['registrar']['registrant']['state_or_province'].'</td></tr>';
	$html_text .= '<tr id="4011" style="display:none"><td>registrant_postal_code</td><td>'.$data[$pd]['registry']['registrant']['postal_code'].'</td><td id="registrant_postal_code"></td><td>'.$data[$pd]['registrar']['registrant']['postal_code'].'</td></tr>';
	$html_text .= '<tr id="4012" style="display:none"><td>registrant_country_name'.if_filled($data[$pd]['registry']['registrant']['country_name']).'</td><td>'.$data[$pd]['registry']['registrant']['country_name'].'</td><td id="registrant_country_name"></td><td>'.$data[$pd]['registrar']['registrant']['country_name'].'</td></tr>';
	$html_text .= '<tr id="4013" style="display:none"><td>registrant_preferred_languages</td><td>'.$data[$pd]['registry']['registrant']['preferred_languages'].'</td><td></td><td>'.$data[$pd]['registrar']['registrant']['preferred_languages'].'</td></tr>';
	$html_text .= '<tr id="4014" style="display:none"><td>registrant_statuses</td><td>'.$data[$pd]['registry']['registrant']['statuses'].'</td><td></td><td>'.$data[$pd]['registrar']['registrant']['statuses'].'</td></tr>';
	$html_text .= '<tr id="4015" style="display:none"><td>registrant_created_at</td><td>'.$data[$pd]['registry']['registrant']['created_at'].'</td><td></td><td>'.$data[$pd]['registrar']['registrant']['created_at'].'</td></tr>';
	$html_text .= '<tr id="4016" style="display:none"><td>registrant_latest_data_mutation_at</td><td>'.$data[$pd]['registry']['registrant']['latest_data_mutation_at'].'</td><td></td><td>'.$data[$pd]['registrar']['registrant']['latest_data_mutation_at'].'</td></tr>';
	$html_text .= '<tr id="4017" style="display:none"><td>registrant_verification_received_at</td><td>'.$data[$pd]['registry']['registrant']['verification_received_at'].'</td><td id="registrant_verification_received_at"></td><td>'.$data[$pd]['registrar']['registrant']['verification_received_at'].'</td></tr>';
	$html_text .= '<tr id="4018" style="display:none"><td>registrant_verification_set_at</td><td>'.$data[$pd]['registry']['registrant']['verification_set_at'].'</td><td id="registrant_verification_set_at"></td><td>'.$data[$pd]['registrar']['registrant']['verification_set_at'].'</td></tr>';
	$html_text .= '<tr id="4019" style="display:none"><td>registrant_properties</td><td>'.$data[$pd]['registry']['registrant']['properties'].'</td><td></td><td>'.$data[$pd]['registrar']['registrant']['properties'].'</td></tr>';
	$html_text .= '<tr id="4020" style="display:none"><td>registrant_remarks</td><td>'.$data[$pd]['registry']['registrant']['remarks'].'</td><td id="registrant_remarks"></td><td>'.$data[$pd]['registrar']['registrant']['remarks'].'</td></tr>';
	$html_text .= '<tr id="4021" style="display:none"><td>registrant_links (RDAPv1)</td><td colspan="2">'.$data[$pd]['registry']['registrant']['links'].'</td><td>'.$data[$pd]['registrar']['registrant']['links'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(41)">Administrative (Decision) +/-</button></td><td></td><td id="administrative_part"></td><td></td></tr>';
	$html_text .= '<tr id="411" style="display:none"><td>administrative_server_handle</td><td>'.$data[$pd]['registry']['administrative']['server_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['server_handle'].'</td></tr>';
	$html_text .= '<tr id="412" style="display:none"><td>administrative_client_handle</td><td>'.$data[$pd]['registry']['administrative']['client_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['client_handle'].'</td></tr>';
	$html_text .= '<tr id="413" style="display:none"><td>administrative_web_id</td><td>'.$data[$pd]['registry']['administrative']['web_id'].'</td><td id="administrative_web_id"></td><td>'.$data[$pd]['registrar']['administrative']['web_id'].'</td></tr>';
	$html_text .= '<tr id="414" style="display:none"><td>administrative_organization_type</td><td>'.$data[$pd]['registry']['administrative']['organization_type'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['organization_type'].'</td></tr>';
	$html_text .= '<tr id="415" style="display:none"><td>administrative_organization_name</td><td>'.$data[$pd]['registry']['administrative']['organization_name'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['organization_name'].'</td></tr>';
	$html_text .= '<tr id="416" style="display:none"><td>administrative_presented_name</td><td>'.$data[$pd]['registry']['administrative']['presented_name'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['presented_name'].'</td></tr>';
	$html_text .= '<tr id="417" style="display:none"><td>administrative_kind</td><td>'.$data[$pd]['registry']['administrative']['kind'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['kind'].'</td></tr>';
	$html_text .= '<tr id="418" style="display:none"><td>administrative_name</td><td>'.$data[$pd]['registry']['administrative']['name'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['name'].'</td></tr>';
	$html_text .= '<tr><td>administrative_email</td><td>'.$data[$pd]['registry']['administrative']['email'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['email'].'</td></tr>';
	$html_text .= '<tr><td>administrative_contact_uri</td><td>'.$data[$pd]['registry']['administrative']['contact_uri'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['contact_uri'].'</td></tr>';
	$html_text .= '<tr id="419" style="display:none"><td>administrative_phone</td><td>'.$data[$pd]['registry']['administrative']['phone'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['phone'].'</td></tr>';
	$html_text .= '<tr id="4110" style="display:none"><td>administrative_country_code</td><td>'.$data[$pd]['registry']['administrative']['country_code'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['country_code'].'</td></tr>';
	$html_text .= '<tr id="4111" style="display:none"><td>administrative_street_address</td><td>'.$data[$pd]['registry']['administrative']['street_address'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['street_address'].'</td></tr>';
	$html_text .= '<tr id="4112" style="display:none"><td>administrative_city</td><td>'.$data[$pd]['registry']['administrative']['city'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['city'].'</td></tr>';
	$html_text .= '<tr id="4113" style="display:none"><td>administrative_state_or_province</td><td>'.$data[$pd]['registry']['administrative']['state_or_province'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['state_or_province'].'</td></tr>';
	$html_text .= '<tr id="4114" style="display:none"><td>administrative_postal_code</td><td>'.$data[$pd]['registry']['administrative']['postal_code'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['postal_code'].'</td></tr>';
	$html_text .= '<tr id="4115" style="display:none"><td>administrative_country_name'.if_filled($data[$pd]['registry']['administrative']['country_name']).'</td><td>'.$data[$pd]['registry']['administrative']['country_name'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['country_name'].'</td></tr>';
	$html_text .= '<tr id="4116" style="display:none"><td>administrative_preferred_languages</td><td>'.$data[$pd]['registry']['administrative']['preferred_languages'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['preferred_languages'].'</td></tr>';
	$html_text .= '<tr id="4117" style="display:none"><td>administrative_properties</td><td>'.$data[$pd]['registry']['administrative']['properties'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['properties'].'</td></tr>';
	$html_text .= '<tr id="4118" style="display:none"><td>administrative_remarks</td><td>'.$data[$pd]['registry']['administrative']['remarks'].'</td><td></td><td>'.$data[$pd]['registrar']['administrative']['remarks'].'</td></tr>';
	$html_text .= '<tr id="4119" style="display:none"><td>administrative_links (RDAPv1)</td><td colspan="2">'.$data[$pd]['registry']['administrative']['links'].'</td><td>'.$data[$pd]['registrar']['administrative']['links'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(42)">Technical (Onsite) +/-</button></td><td></td><td id="technical_part"></td><td></td></tr>';
	$html_text .= '<tr id="421" style="display:none"><td>technical_server_handle</td><td>'.$data[$pd]['registry']['technical']['server_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['server_handle'].'</td></tr>';
	$html_text .= '<tr id="422" style="display:none"><td>technical_client_handle</td><td>'.$data[$pd]['registry']['technical']['client_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['client_handle'].'</td></tr>';
	$html_text .= '<tr id="423" style="display:none"><td>technical_web_id</td><td>'.$data[$pd]['registry']['technical']['web_id'].'</td><td id="technical_web_id"></td><td>'.$data[$pd]['registrar']['technical']['web_id'].'</td></tr>';
	$html_text .= '<tr id="424" style="display:none"><td>technical_organization_type</td><td>'.$data[$pd]['registry']['technical']['organization_type'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['organization_type'].'</td></tr>';
	$html_text .= '<tr id="425" style="display:none"><td>technical_organization_name</td><td>'.$data[$pd]['registry']['technical']['organization_name'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['organization_name'].'</td></tr>';
	$html_text .= '<tr id="426" style="display:none"><td>technical_presented_name</td><td>'.$data[$pd]['registry']['technical']['presented_name'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['presented_name'].'</td></tr>';
	$html_text .= '<tr id="427" style="display:none"><td>technical_kind</td><td>'.$data[$pd]['registry']['technical']['kind'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['kind'].'</td></tr>';
	$html_text .= '<tr id="428" style="display:none"><td>technical_name</td><td>'.$data[$pd]['registry']['technical']['name'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['name'].'</td></tr>';
	$html_text .= '<tr><td>technical_email</td><td>'.$data[$pd]['registry']['technical']['email'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['email'].'</td></tr>';
	$html_text .= '<tr><td>technical_contact_uri</td><td>'.$data[$pd]['registry']['technical']['contact_uri'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['contact_uri'].'</td></tr>';
	$html_text .= '<tr id="429" style="display:none"><td>technical_phone</td><td>'.$data[$pd]['registry']['technical']['phone'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['phone'].'</td></tr>';
	$html_text .= '<tr id="4210" style="display:none"><td>technical_country_code</td><td>'.$data[$pd]['registry']['technical']['country_code'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['country_code'].'</td></tr>';
	$html_text .= '<tr id="4211" style="display:none"><td>technical_street_address</td><td>'.$data[$pd]['registry']['technical']['street_address'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['street_address'].'</td></tr>';
	$html_text .= '<tr id="4212" style="display:none"><td>technical_city</td><td>'.$data[$pd]['registry']['technical']['city'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['city'].'</td></tr>';
	$html_text .= '<tr id="4213" style="display:none"><td>technical_state_or_province</td><td>'.$data[$pd]['registry']['technical']['state_or_province'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['state_or_province'].'</td></tr>';
	$html_text .= '<tr id="4214" style="display:none"><td>technical_postal_code</td><td>'.$data[$pd]['registry']['technical']['postal_code'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['postal_code'].'</td></tr>';
	$html_text .= '<tr id="4215" style="display:none"><td>technical_country_name'.if_filled($data[$pd]['registry']['technical']['country_name']).'</td><td>'.$data[$pd]['registry']['technical']['country_name'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['country_name'].'</td></tr>';
	$html_text .= '<tr id="4216" style="display:none"><td>technical_preferred_languages</td><td>'.$data[$pd]['registry']['technical']['preferred_languages'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['preferred_languages'].'</td></tr>';
	$html_text .= '<tr id="4217" style="display:none"><td>technical_properties</td><td>'.$data[$pd]['registry']['technical']['properties'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['properties'].'</td></tr>';
	$html_text .= '<tr id="4218" style="display:none"><td>technical_remarks</td><td>'.$data[$pd]['registry']['technical']['remarks'].'</td><td></td><td>'.$data[$pd]['registrar']['technical']['remarks'].'</td></tr>';
	$html_text .= '<tr id="4219" style="display:none"><td>technical_links (RDAPv1)</td><td colspan="2">'.$data[$pd]['registry']['technical']['links'].'</td><td>'.$data[$pd]['registrar']['technical']['links'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(43)">Billing +/-</button></td><td></td><td id="billing_part"></td><td></td></tr>';
	$html_text .= '<tr id="431" style="display:none"><td>billing_server_handle</td><td>'.$data[$pd]['registry']['billing']['server_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['server_handle'].'</td></tr>';
	$html_text .= '<tr id="432" style="display:none"><td>billing_client_handle</td><td>'.$data[$pd]['registry']['billing']['client_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['client_handle'].'</td></tr>';
	$html_text .= '<tr id="433" style="display:none"><td>billing_web_id</td><td>'.$data[$pd]['registry']['billing']['web_id'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['web_id'].'</td></tr>';
	$html_text .= '<tr id="434" style="display:none"><td>billing_organization_type</td><td>'.$data[$pd]['registry']['billing']['organization_type'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['organization_type'].'</td></tr>';
	$html_text .= '<tr id="435" style="display:none"><td>billing_organization_name</td><td>'.$data[$pd]['registry']['billing']['organization_name'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['organization_name'].'</td></tr>';
	$html_text .= '<tr id="436" style="display:none"><td>billing_presented_name</td><td>'.$data[$pd]['registry']['billing']['presented_name'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['presented_name'].'</td></tr>';
	$html_text .= '<tr id="437" style="display:none"><td>billing_kind</td><td>'.$data[$pd]['registry']['billing']['kind'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['kind'].'</td></tr>';
	$html_text .= '<tr id="438" style="display:none"><td>billing_name</td><td>'.$data[$pd]['registry']['billing']['name'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['name'].'</td></tr>';
	$html_text .= '<tr id="439" style="display:none"><td>billing_email</td><td>'.$data[$pd]['registry']['billing']['email'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['email'].'</td></tr>';
	$html_text .= '<tr id="4310" style="display:none"><td>billing_contact_uri</td><td>'.$data[$pd]['registry']['billing']['contact_uri'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['contact_uri'].'</td></tr>';
	$html_text .= '<tr id="4311" style="display:none"><td>billing_phone</td><td>'.$data[$pd]['registry']['billing']['phone'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['phone'].'</td></tr>';
	$html_text .= '<tr id="4312" style="display:none"><td>billing_country_code</td><td>'.$data[$pd]['registry']['billing']['country_code'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['country_code'].'</td></tr>';
	$html_text .= '<tr id="4313" style="display:none"><td>billing_street_address</td><td>'.$data[$pd]['registry']['billing']['street_address'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['street_address'].'</td></tr>';
	$html_text .= '<tr id="4314" style="display:none"><td>billing_city</td><td>'.$data[$pd]['registry']['billing']['city'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['city'].'</td></tr>';
	$html_text .= '<tr id="4315" style="display:none"><td>billing_state_or_province</td><td>'.$data[$pd]['registry']['billing']['state_or_province'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['state_or_province'].'</td></tr>';
	$html_text .= '<tr id="4316" style="display:none"><td>billing_postal_code</td><td>'.$data[$pd]['registry']['billing']['postal_code'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['postal_code'].'</td></tr>';
	$html_text .= '<tr id="4317" style="display:none"><td>billing_country_name'.if_filled($data[$pd]['registry']['billing']['country_name']).'</td><td>'.$data[$pd]['registry']['billing']['country_name'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['country_name'].'</td></tr>';
	$html_text .= '<tr id="4318" style="display:none"><td>billing_preferred_languages</td><td>'.$data[$pd]['registry']['billing']['preferred_languages'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['preferred_languages'].'</td></tr>';
	$html_text .= '<tr id="4319" style="display:none"><td>billing_properties</td><td>'.$data[$pd]['registry']['billing']['properties'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['properties'].'</td></tr>';	
	$html_text .= '<tr id="4320" style="display:none"><td>billing_remarks</td><td>'.$data[$pd]['registry']['billing']['remarks'].'</td><td></td><td>'.$data[$pd]['registrar']['billing']['remarks'].'</td></tr>';
	$html_text .= '<tr id="4321" style="display:none"><td>billing_links (RDAPv1)</td><td colspan="2">'.$data[$pd]['registry']['billing']['links'].'</td><td>'.$data[$pd]['registrar']['billing']['links'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(44)">Emergency +/-</button></td><td></td><td id="emergency_part"></td><td></td></tr>';
	$html_text .= '<tr id="441" style="display:none"><td>emergency_server_handle</td><td>'.$data[$pd]['registry']['emergency']['server_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['server_handle'].'</td></tr>';
	$html_text .= '<tr id="442" style="display:none"><td>emergency_client_handle</td><td>'.$data[$pd]['registry']['emergency']['client_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['client_handle'].'</td></tr>';
	$html_text .= '<tr id="443" style="display:none"><td>emergency_web_id</td><td>'.$data[$pd]['registry']['emergency']['web_id'].'</td><td id="emergency_web_id"></td><td>'.$data[$pd]['registrar']['emergency']['web_id'].'</td></tr>';
	$html_text .= '<tr id="444" style="display:none"><td>emergency_organization_type</td><td>'.$data[$pd]['registry']['emergency']['organization_type'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['organization_type'].'</td></tr>';
	$html_text .= '<tr id="445" style="display:none"><td>emergency_organization_name</td><td>'.$data[$pd]['registry']['emergency']['organization_name'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['organization_name'].'</td></tr>';
	$html_text .= '<tr id="446" style="display:none"><td>emergency_presented_name</td><td>'.$data[$pd]['registry']['emergency']['presented_name'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['presented_name'].'</td></tr>';
	$html_text .= '<tr id="447" style="display:none"><td>emergency_kind</td><td>'.$data[$pd]['registry']['emergency']['kind'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['kind'].'</td></tr>';
	$html_text .= '<tr id="448" style="display:none"><td>emergency_name</td><td>'.$data[$pd]['registry']['emergency']['name'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['name'].'</td></tr>';
	$html_text .= '<tr id="449" style="display:none"><td>emergency_email</td><td>'.$data[$pd]['registry']['emergency']['email'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['email'].'</td></tr>';
	$html_text .= '<tr id="4410" style="display:none"><td>emergency_contact_uri</td><td>'.$data[$pd]['registry']['emergency']['contact_uri'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['contact_uri'].'</td></tr>';
	$html_text .= '<tr id="4411" style="display:none"><td>emergency_phone</td><td>'.$data[$pd]['registry']['emergency']['phone'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['phone'].'</td></tr>';
	$html_text .= '<tr id="4412" style="display:none"><td>emergency_country_code</td><td>'.$data[$pd]['registry']['emergency']['country_code'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['country_code'].'</td></tr>';
	$html_text .= '<tr id="4413" style="display:none"><td>emergency_street_address</td><td>'.$data[$pd]['registry']['emergency']['street_address'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['street_address'].'</td></tr>';
	$html_text .= '<tr id="4414" style="display:none"><td>emergency_city</td><td>'.$data[$pd]['registry']['emergency']['city'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['city'].'</td></tr>';
	$html_text .= '<tr id="4415" style="display:none"><td>emergency_state_or_province</td><td>'.$data[$pd]['registry']['emergency']['state_or_province'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['state_or_province'].'</td></tr>';
	$html_text .= '<tr id="4416" style="display:none"><td>emergency_postal_code</td><td>'.$data[$pd]['registry']['emergency']['postal_code'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['postal_code'].'</td></tr>';
	$html_text .= '<tr id="4417" style="display:none"><td>emergency_country_name'.if_filled($data[$pd]['registry']['emergency']['country_name']).'</td><td>'.$data[$pd]['registry']['emergency']['country_name'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['country_name'].'</td></tr>';
	$html_text .= '<tr id="4418" style="display:none"><td>emergency_preferred_languages</td><td>'.$data[$pd]['registry']['emergency']['preferred_languages'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['preferred_languages'].'</td></tr>';
	$html_text .= '<tr id="4419" style="display:none"><td>emergency_properties</td><td>'.$data[$pd]['registry']['emergency']['properties'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['properties'].'</td></tr>';
	$html_text .= '<tr id="4420" style="display:none"><td>emergency_remarks</td><td>'.$data[$pd]['registry']['emergency']['remarks'].'</td><td></td><td>'.$data[$pd]['registrar']['emergency']['remarks'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(45)">Fallback +/-</button></td><td></td><td id="fallback_part"></td><td></td></tr>';
	$html_text .= '<tr id="451" style="display:none"><td>fallback_server_handle</td><td>'.$data[$pd]['registry']['fallback']['server_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['fallback']['server_handle'].'</td></tr>';
	$html_text .= '<tr id="452" style="display:none"><td>fallback_client_handle</td><td>'.$data[$pd]['registry']['fallback']['client_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['fallback']['client_handle'].'</td></tr>';
	$html_text .= '<tr id="453" style="display:none"><td>fallback_organization_type</td><td>'.$data[$pd]['registry']['fallback']['organization_type'].'</td><td></td><td>'.$data[$pd]['registrar']['fallback']['organization_type'].'</td></tr>';
	$html_text .= '<tr id="454" style="display:none"><td>fallback_organization_name</td><td>'.$data[$pd]['registry']['fallback']['organization_name'].'</td><td></td><td>'.$data[$pd]['registrar']['fallback']['organization_name'].'</td></tr>';
	$html_text .= '<tr id="455" style="display:none"><td>fallback_presented_name</td><td>'.$data[$pd]['registry']['fallback']['presented_name'].'</td><td></td><td>'.$data[$pd]['registrar']['fallback']['presented_name'].'</td></tr>';
	$html_text .= '<tr id="456" style="display:none"><td>fallback_kind</td><td>'.$data[$pd]['registry']['fallback']['kind'].'</td><td></td><td>'.$data[$pd]['registrar']['fallback']['kind'].'</td></tr>';
	$html_text .= '<tr id="457" style="display:none"><td>fallback_email</td><td>'.$data[$pd]['registry']['fallback']['email'].'</td><td></td><td>'.$data[$pd]['registrar']['fallback']['email'].'</td></tr>';
	$html_text .= '<tr id="458" style="display:none"><td>fallback_contact_uri</td><td>'.$data[$pd]['registry']['fallback']['contact_uri'].'</td><td></td><td>'.$data[$pd]['registrar']['fallback']['contact_uri'].'</td></tr>';
	$html_text .= '<tr id="459" style="display:none"><td>fallback_phone</td><td>'.$data[$pd]['registry']['fallback']['phone'].'</td><td></td><td>'.$data[$pd]['registrar']['fallback']['phone'].'</td></tr>';
	$html_text .= '<tr id="4510" style="display:none"><td>fallback_country_code</td><td>'.$data[$pd]['registry']['fallback']['country_code'].'</td><td></td><td>'.$data[$pd]['registrar']['fallback']['country_code'].'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(50)">Reseller +/-</button></td><td><b>'.$vd.'</b></td><td id="reseller_part"></td><td></td></tr>';
	$html_text .= '<tr id="501" style="display:none"><td>reseller_server_handle</td><td>'.$data[$pd]['registry']['reseller']['server_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['server_handle'].'</td></tr>';
	$html_text .= '<tr id="502" style="display:none"><td>reseller_client_handle</td><td>'.$data[$pd]['registry']['reseller']['client_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['client_handle'].'</td></tr>';
	$html_text .= '<tr id="503" style="display:none"><td>reseller_web_id</td><td>'.$data[$pd]['registry']['reseller']['web_id'].'</td><td id="reseller_web_id"></td><td>'.$data[$pd]['registrar']['reseller']['web_id'].'</td></tr>';
	$html_text .= '<tr id="504" style="display:none"><td>reseller_organization_type</td><td>'.$data[$pd]['registry']['reseller']['organization_type'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['organization_type'].'</td></tr>';
	$html_text .= '<tr><td>reseller_organization_name</td><td>'.$data[$pd]['registry']['reseller']['organization_name'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['organization_name'].'</td></tr>';
	$html_text .= '<tr><td>reseller_presented_name</td><td>'.$data[$pd]['registry']['reseller']['presented_name'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['presented_name'].'</td></tr>';
	$html_text .= '<tr id="505" style="display:none"><td>reseller_kind</td><td>'.$data[$pd]['registry']['reseller']['kind'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['kind'].'</td></tr>';
	$html_text .= '<tr id="506" style="display:none"><td>reseller_name</td><td>'.$data[$pd]['registry']['reseller']['name'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['name'].'</td></tr>';
	$html_text .= '<tr id="507" style="display:none"><td>reseller_email</td><td>'.$data[$pd]['registry']['reseller']['email'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['email'].'</td></tr>';
	$html_text .= '<tr id="508" style="display:none"><td>reseller_contact_uri</td><td>'.$data[$pd]['registry']['reseller']['contact_uri'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['contact_uri'].'</td></tr>';
	$html_text .= '<tr id="509" style="display:none"><td>reseller_phone</td><td>'.$data[$pd]['registry']['reseller']['phone'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['phone'].'</td></tr>';
	$html_text .= '<tr id="5010" style="display:none"><td>reseller_country_code</td><td>'.$data[$pd]['registry']['reseller']['country_code'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['country_code'].'</td></tr>';
	$html_text .= '<tr id="5011" style="display:none"><td>reseller_street_address</td><td>'.$data[$pd]['registry']['reseller']['street_address'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['street_address'].'</td></tr>';
	$html_text .= '<tr id="5012" style="display:none"><td>reseller_city</td><td>'.$data[$pd]['registry']['reseller']['city'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['city'].'</td></tr>';
	$html_text .= '<tr id="5013" style="display:none"><td>reseller_state_or_province</td><td>'.$data[$pd]['registry']['reseller']['state_or_province'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['state_or_province'].'</td></tr>';
	$html_text .= '<tr id="5014" style="display:none"><td>reseller_postal_code</td><td>'.$data[$pd]['registry']['reseller']['postal_code'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['postal_code'].'</td></tr>';
	$html_text .= '<tr id="5015" style="display:none"><td>reseller_country_name'.if_filled($data[$pd]['registry']['reseller']['country_name']).'</td><td>'.$data[$pd]['registry']['reseller']['country_name'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['country_name'].'</td></tr>';
	$html_text .= '<tr id="5016" style="display:none"><td>reseller_preferred_languages</td><td>'.$data[$pd]['registry']['reseller']['preferred_languages'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['preferred_languages'].'</td></tr>';
	$html_text .= '<tr id="5017" style="display:none"><td>reseller_statuses</td><td>'.$data[$pd]['registry']['reseller']['statuses'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['statuses'].'</td></tr>';
	$html_text .= '<tr id="5018" style="display:none"><td>reseller_created_at</td><td>'.$data[$pd]['registry']['reseller']['created_at'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['created_at'].'</td></tr>';
	$html_text .= '<tr id="5019" style="display:none"><td>reseller_latest_data_mutation_at</td><td>'.$data[$pd]['registry']['reseller']['latest_data_mutation_at'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['latest_data_mutation_at'].'</td></tr>';
	$html_text .= '<tr id="5020" style="display:none"><td>reseller_verification_received_at</td><td>'.$data[$pd]['registry']['reseller']['verification_received_at'].'</td><td id="reseller_verification_received_at"></td><td>'.$data[$pd]['registrar']['reseller']['verification_received_at'].'</td></tr>';
	$html_text .= '<tr id="5021" style="display:none"><td>reseller_verification_set_at</td><td>'.$data[$pd]['registry']['reseller']['verification_set_at'].'</td><td id="reseller_verification_set_at"></td><td>'.$data[$pd]['registrar']['reseller']['verification_set_at'].'</td></tr>';
	$html_text .= '<tr id="5022" style="display:none"><td>reseller_properties</td><td>'.$data[$pd]['registry']['reseller']['properties'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['properties'].'</td></tr>';
	$html_text .= '<tr id="5023" style="display:none"><td>reseller_remarks</td><td>'.$data[$pd]['registry']['reseller']['remarks'].'</td><td></td><td>'.$data[$pd]['registrar']['reseller']['remarks'].'</td></tr>';
	$html_text .= '<tr id="5024" style="display:none"><td>reseller_links (RDAPv1)</td><td colspan="2">'.$data[$pd]['registry']['reseller']['links'].'</td><td>'.$data[$pd]['registrar']['reseller']['links'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(60)">Registrar +/-</button></td><td></td><td id="registrar_part"></td><td></td></tr>';
	$html_text .= '<tr id="601" style="display:none"><td>registrar_server_handle</td><td>'.$data[$pd]['registry']['registrar']['server_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['server_handle'].'</td></tr>';
	$html_text .= '<tr id="602" style="display:none"><td>registrar_client_handle</td><td>'.$data[$pd]['registry']['registrar']['client_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['client_handle'].'</td></tr>';
	$html_text .= '<tr id="603" style="display:none"><td>registrar_web_id</td><td>'.$data[$pd]['registry']['registrar']['web_id'].'</td><td id="registrar_web_id"></td><td>'.$data[$pd]['registrar']['registrar']['web_id'].'</td></tr>';
	$html_text .= '<tr id="604" style="display:none"><td>registrar_organization_type</td><td>'.$data[$pd]['registry']['registrar']['organization_type'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['organization_type'].'</td></tr>';
	$html_text .= '<tr><td>registrar_organization_name</td><td>'.$data[$pd]['registry']['registrar']['organization_name'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['organization_name'].'</td></tr>';
	$html_text .= '<tr><td>registrar_presented_name</td><td>'.$data[$pd]['registry']['registrar']['presented_name'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['presented_name'].'</td></tr>';
	$html_text .= '<tr id="605" style="display:none"><td>registrar_kind</td><td>'.$data[$pd]['registry']['registrar']['kind'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['kind'].'</td></tr>';
	$html_text .= '<tr id="606" style="display:none"><td>registrar_name</td><td>'.$data[$pd]['registry']['registrar']['name'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['name'].'</td></tr>';
	$html_text .= '<tr id="607" style="display:none"><td>registrar_email</td><td>'.$data[$pd]['registry']['registrar']['email'].'</td><td id="registrar_email"></td><td>'.$data[$pd]['registrar']['registrar']['email'].'</td></tr>';
	$html_text .= '<tr id="608" style="display:none"><td>registrar_contact_uri</td><td>'.$data[$pd]['registry']['registrar']['contact_uri'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['contact_uri'].'</td></tr>';
	$html_text .= '<tr id="609" style="display:none"><td>registrar_phone</td><td>'.$data[$pd]['registry']['registrar']['phone'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['phone'].'</td></tr>';
	$html_text .= '<tr id="6010" style="display:none"><td>registrar_country_code</td><td>'.$data[$pd]['registry']['registrar']['country_code'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['country_code'].'</td></tr>';
	$html_text .= '<tr id="6011" style="display:none"><td>registrar_street_address</td><td>'.$data[$pd]['registry']['registrar']['street_address'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['street_address'].'</td></tr>';
	$html_text .= '<tr id="6012" style="display:none"><td>registrar_city</td><td>'.$data[$pd]['registry']['registrar']['city'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['city'].'</td></tr>';
	$html_text .= '<tr id="6013" style="display:none"><td>registrar_state_or_province</td><td>'.$data[$pd]['registry']['registrar']['state_or_province'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['state_or_province'].'</td></tr>';
	$html_text .= '<tr id="6014" style="display:none"><td>registrar_postal_code</td><td>'.$data[$pd]['registry']['registrar']['postal_code'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['postal_code'].'</td></tr>';
	$html_text .= '<tr id="6015" style="display:none"><td>registrar_country_name'.if_filled($data[$pd]['registry']['registrar']['country_name']).'</td><td>'.$data[$pd]['registry']['registrar']['country_name'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['country_name'].'</td></tr>';
	$html_text .= '<tr id="6016" style="display:none"><td>registrar_preferred_languages</td><td>'.$data[$pd]['registry']['registrar']['preferred_languages'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['preferred_languages'].'</td></tr>';
	$html_text .= '<tr id="6017" style="display:none"><td>registrar_statuses</td><td>'.$data[$pd]['registry']['registrar']['statuses'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['statuses'].'</td></tr>';
	$html_text .= '<tr id="6018" style="display:none"><td>registrar_created_at</td><td>'.$data[$pd]['registry']['registrar']['created_at'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['created_at'].'</td></tr>';
	$html_text .= '<tr id="6019" style="display:none"><td>registrar_latest_data_mutation_at</td><td>'.$data[$pd]['registry']['registrar']['latest_data_mutation_at'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['latest_data_mutation_at'].'</td></tr>';
	$html_text .= '<tr id="6020" style="display:none"><td>registrar_verification_received_at</td><td>'.$data[$pd]['registry']['registrar']['verification_received_at'].'</td><td id="registrar_verification_received_at"></td><td>'.$data[$pd]['registrar']['registrar']['verification_received_at'].'</td></tr>';
	$html_text .= '<tr id="6021" style="display:none"><td>registrar_verification_set_at</td><td>'.$data[$pd]['registry']['registrar']['verification_set_at'].'</td><td id="registrar_verification_set_at"></td><td>'.$data[$pd]['registrar']['registrar']['verification_set_at'].'</td></tr>';
	$html_text .= '<tr id="6022" style="display:none"><td>registrar_properties</td><td>'.$data[$pd]['registry']['registrar']['properties'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['properties'].'</td></tr>';
	$html_text .= '<tr id="6023" style="display:none"><td>registrar_remarks</td><td>'.$data[$pd]['registry']['registrar']['remarks'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar']['remarks'].'</td></tr>';
	$html_text .= '<tr id="6024" style="display:none"><td>registrar_links (RDAPv1)</td><td colspan="2">'.$data[$pd]['registry']['registrar']['links'].'</td><td>'.$data[$pd]['registrar']['registrar']['links'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(61)">Registrar Abuse +/-</button></td><td></td><td id="registrar_abuse_part"></td><td></td></tr>';
	$html_text .= '<tr id="611" style="display:none"><td>registrar_abuse_server_handle</td><td>'.$data[$pd]['registry']['registrar_abuse']['server_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar_abuse']['server_handle'].'</td></tr>';
	$html_text .= '<tr id="612" style="display:none"><td>registrar_abuse_client_handle</td><td>'.$data[$pd]['registry']['registrar_abuse']['client_handle'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar_abuse']['client_handle'].'</td></tr>';
	$html_text .= '<tr id="613" style="display:none"><td>registrar_abuse_organization_type</td><td>'.$data[$pd]['registry']['registrar_abuse']['organization_type'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar_abuse']['organization_type'].'</td></tr>';
	$html_text .= '<tr id="614" style="display:none"><td>registrar_abuse_organization_name</td><td>'.$data[$pd]['registry']['registrar_abuse']['organization_name'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar_abuse']['organization_name'].'</td></tr>';
	$html_text .= '<tr id="615" style="display:none"><td>registrar_abuse_presented_name</td><td>'.$data[$pd]['registry']['registrar_abuse']['presented_name'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar_abuse']['presented_name'].'</td></tr>';
	$html_text .= '<tr id="616" style="display:none"><td>registrar_abuse_kind</td><td>'.$data[$pd]['registry']['registrar_abuse']['kind'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar_abuse']['kind'].'</td></tr>';
	$html_text .= '<tr id="617" style="display:none"><td>registrar_abuse_email</td><td>'.$data[$pd]['registry']['registrar_abuse']['email'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar_abuse']['email'].'</td></tr>';
	$html_text .= '<tr id="618" style="display:none"><td>registrar_abuse_contact_uri</td><td>'.$data[$pd]['registry']['registrar_abuse']['contact_uri'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar_abuse']['contact_uri'].'</td></tr>';
	$html_text .= '<tr id="619" style="display:none"><td>registrar_abuse_phone</td><td>'.$data[$pd]['registry']['registrar_abuse']['phone'].'</td><td id="registrar_abuse_phone"></td><td>'.$data[$pd]['registrar']['registrar_abuse']['phone'].'</td></tr>';
	$html_text .= '<tr id="6110" style="display:none"><td>registrar_abuse_country_code</td><td>'.$data[$pd]['registry']['registrar_abuse']['country_code'].'</td><td></td><td>'.$data[$pd]['registrar']['registrar_abuse']['country_code'].'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(63)">Nameservers +/-</button></td><td><b>'.$vd.'</b></td><td></td><td></td></tr>';
	$html_text .= '<tr id="631" style="display:none"><td>server_handles</td><td colspan="2">'.$data[$pd]['registry']['nameservers']['server_handles'].'</td><td>'.$data[$pd]['registrar']['nameservers']['server_handles'].'</td></tr>';
	$html_text .= '<tr id="632" style="display:none"><td>client_handles</td><td colspan="2">'.$data[$pd]['registry']['nameservers']['client_handles'].'</td><td>'.$data[$pd]['registrar']['nameservers']['client_handles'].'</td></tr>';
	$html_text .= '<tr id="633" style="display:none"><td>ascii_names</td><td colspan="2">'.$data[$pd]['registry']['nameservers']['ascii_names'].'</td><td>'.$data[$pd]['registrar']['nameservers']['ascii_names'].'</td></tr>';
	$html_text .= '<tr id="634" style="display:none"><td>unicode_names</td><td colspan="2">'.$data[$pd]['registry']['nameservers']['unicode_names'].'</td><td>'.$data[$pd]['registrar']['nameservers']['unicode_names'].'</td></tr>';
	$html_text .= '<tr id="635" style="display:none"><td>ipv4_addresses</td><td>'.$data[$pd]['registry']['nameservers']['ipv4_addresses'].'</td><td style="vertical-align:bottom" id="nameservers_ipv4_addresses"></td><td>'.$data[$pd]['registrar']['nameservers']['ipv4_addresses'].'</td></tr>';
	$html_text .= '<tr id="636" style="display:none"><td>ipv6_addresses</td><td>'.$data[$pd]['registry']['nameservers']['ipv6_addresses'].'</td><td id="nameservers_ipv6_addresses"></td><td>'.$data[$pd]['registrar']['nameservers']['ipv6_addresses'].'</td></tr>';
	$html_text .= '<tr id="637" style="display:none"><td>statuses</td><td>'.$data[$pd]['registry']['nameservers']['statuses'].'</td><td></td><td>'.$data[$pd]['registrar']['nameservers']['statuses'].'</td></tr>';
	$html_text .= '<tr id="638" style="display:none"><td>nameserver_check_result</td><td>'.$data[$pd]['registry']['nameservers']['nameserver_check_result'].'</td><td id="br_tld"></td><td>'.$data[$pd]['registrar']['nameservers']['nameserver_check_result'].'</td></tr>';
	$html_text .= '<tr id="639" style="display:none"><td>nameserver_check_dates</td><td>'.$data[$pd]['registry']['nameservers']['nameserver_check_dates'].'</td><td></td><td>'.$data[$pd]['registrar']['nameservers']['nameserver_check_dates'].'</td></tr>';
	$html_text .= '<tr id="6310" style="display:none"><td>last_valid_nameserver_check_dates</td><td>'.$data[$pd]['registry']['nameservers']['last_valid_nameserver_check_dates'].'</td><td></td><td>'.$data[$pd]['registrar']['nameservers']['last_valid_nameserver_check_dates'].'</td></tr>';
	$html_text .= '<tr id="6311" style="display:none"><td>rdap_dnssec_signed</td><td>'.$data[$pd]['registry']['nameservers']['rdap_dnssec_signed'].'</td><td id="nameservers_rdap_dnssec_signed"></td><td>'.str_replace(',',',<br />',$data[$pd]['registrar']['nameservers']['rdap_dnssec_signed']).'</td></tr>';
	$html_text .= '<tr id="6312" style="display:none"><td>rdap_ds_key_tags</td><td>'.str_replace(',',',<br />',$data[$pd]['registry']['nameservers']['rdap_ds_key_tags']).'</td><td></td><td>'.str_replace(',',',<br />',$data[$pd]['registrar']['nameservers']['rdap_ds_key_tags']).'</td></tr>';
	$html_text .= '<tr id="6313" style="display:none"><td>rdap_ds_algorithms</td><td>'.str_replace(',',',<br />',$data[$pd]['registry']['nameservers']['rdap_ds_algorithms']).'</td><td id="nameservers_rdap_ds_algorithms"></td><td>'.str_replace(',',',<br />',$data[$pd]['registrar']['nameservers']['rdap_ds_algorithms']).'</td></tr>';
	$html_text .= '<tr id="6314" style="display:none"><td>rdap_ds_digest_types</td><td>'.str_replace(',',',<br />',$data[$pd]['registry']['nameservers']['rdap_ds_digest_types']).'</td><td id="nameservers_rdap_ds_digest_types"></td><td>'.str_replace(',',',<br />',$data[$pd]['registrar']['nameservers']['rdap_ds_digest_types']).'</td></tr>';
	$html_text .= '<tr id="6315" style="display:none"><td>rdap_ds_digests</td><td colspan="2">'.str_replace(',',',<br />',$data[$pd]['registry']['nameservers']['rdap_ds_digests']).'</td><td>'.str_replace(',',',<br />',$data[$pd]['registrar']['nameservers']['rdap_ds_digests']).'</td></tr>';
	$html_text .= '<tr id="6316" style="display:none"><td>measured_ds_key_tags</td><td>'.str_replace(',',',<br />',$data[$pd]['registry']['measured_ds_key_tags']).'</td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>measured_ds_algorithms</b></td><td><b>'.str_replace(',',',<br />',$data[$pd]['registry']['measured_ds_algorithms']).'</b></td><td id="measured_ds_algorithms"></td><td></td></tr>';
	$html_text .= '<tr id="6317" style="display:none"><td>measured_ds_digest_types</td><td>'.str_replace(',',',<br />',$data[$pd]['registry']['measured_ds_digest_types']).'</td><td></td><td></td></tr>';
	$html_text .= '<tr id="6318" style="display:none"><td>measured_ds_digests</td><td colspan="2">'.str_replace(',',',<br />',$data[$pd]['registry']['measured_ds_digests']).'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(75)">Raw RDAP +/-</button> | ' . ((!empty($raw_whois)) ? '<a href="'.$raw_whois.'" target="_blank">Whois Data</a>' : 'No Whois Data').'</td><td id="raw_data_next" colspan="2"></td><td></td></tr>';
	$html_text .= '<tr id="751" style="display:none;;"><td colspan="2">'.$data[$pd]['registry']['raw_rdap'].'</td><td></td><td>'.$data[$pd]['registrar']['raw_rdap'].'</td></tr>';
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

function if_filled($inputvalue)	{
	if (!empty($inputvalue))	{
		return ' (to be empty) ⚠️';
	}
	return ' (to be empty)';
}
}?>