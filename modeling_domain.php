<?php
session_start();  // is needed with no Scriptcase PHP Generator
echo '<!DOCTYPE html><html lang="en" style="font-size: 90%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>Domain Data Modeling</title>';
?><script>
	
function SwitchDisplay(type) {
	if (type == 10)			{ // zone
		var pre = '10';
		var max = 10
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
	else if (type == 28)	{ // background
		var pre = '28';
		var max = 5
	}
	else if (type == 29)	{ // resource
		var pre = '29';
		var max = 5
	}
	else if (type == 30)	{ // details
		var pre = '30';
		var max = 11
	}
	else if (type == 39)	{ // sponsor
		var pre = '39';
		var max = 29
	}
	else if (type == 40)	{ // registrant
		var pre = '40';
		var max = 24
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
		var max = 26
	}	
	else if (type == 60)	{ // registrar
		var pre = '60';
		var max = 26
	}
	else if (type == 61)	{ // abuse
		var pre = '61';
		var max = 7
	}
	else if (type == 63)	{ // name servers
		var pre = '63';
		var max = 42
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
		var proposed = '';
		var address = '';
		var accessible = '';
		document.getElementById("title").textContent = "Domain Information";
		document.getElementById("subtitle").textContent = "RDAP-v1-based modeling";
		document.getElementById("instruction").textContent = "Fill in and press Enter to retrieve.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "";
		document.getElementById("zone_role").textContent = "";
		document.getElementById("zone_tld_category").textContent = proposed;
		document.getElementById("zone_tld_type").textContent = proposed;
		document.getElementById("zone_sponsoring_organization").textContent = proposed;
		document.getElementById("zone_country_code_designated_manager").textContent = proposed;
		document.getElementById("zone_registry_operator_trade_name").textContent = proposed;
		document.getElementById("zone_backend_operator_trade_name").textContent = proposed;
		document.getElementById("zone_language_codes").textContent = proposed;
		document.getElementById("zone_delegation_url").textContent = proposed;
		document.getElementById("zone_restrictions_url").textContent = proposed;
		document.getElementById("zone_menu_url").textContent = proposed;
		document.getElementById("notices_role").textContent = "";
		document.getElementById("links_role").textContent = "";		
		document.getElementById("background_role").textContent = "";
		document.getElementById("background_root_zones_url").textContent = proposed;
		document.getElementById("background_accredited_registrars_url").textContent = proposed;
		document.getElementById("background_lookup_endpoints_url").textContent = proposed;
		document.getElementById("background_registry_source").textContent = proposed;
		document.getElementById("resources_role").textContent = "";
		document.getElementById("resources_registrar_source").textContent = proposed;
		document.getElementById("resources_registrar_public_ids").textContent = proposed;
		document.getElementById("resources_registrar_complaint_url").textContent = proposed;
		document.getElementById("resources_status_explanation_url").textContent = proposed;
		document.getElementById("details_role").textContent = "";
		document.getElementById("details_name_ascii").textContent = "";
		document.getElementById("details_name_unicode").textContent = "";
		document.getElementById("details_status_values").textContent = "";
		document.getElementById("details_event_registration").textContent = "";
		document.getElementById("details_event_expiration").textContent = "";
		document.getElementById("details_event_recovery_until").textContent = proposed;
		document.getElementById("details_event_deletion").textContent = "";
		document.getElementById("details_event_last_uploaded").textContent = "";
		document.getElementById("details_extensions_values").textContent = "";
		document.getElementById("sponsor_role").textContent = "";
		document.getElementById("registrant_role").textContent = "";
		document.getElementById("registrant_handle").textContent = "";
		document.getElementById("registrant_web_id").textContent = proposed;
		document.getElementById("registrant_organization_type").textContent = "";
		document.getElementById("registrant_organization_name").textContent = "";
		document.getElementById("registrant_presented_name").textContent = "";
		document.getElementById("registrant_kind").textContent = "";
		document.getElementById("registrant_name").textContent = "";
		document.getElementById("registrant_country_code").textContent = "";
		document.getElementById("registrant_street").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;
		document.getElementById("registrant_country_name").textContent = "";
		document.getElementById("registrant_shielding").textContent = proposed;
		document.getElementById("registrant_event_verification_received").textContent = proposed;
		document.getElementById("registrant_event_verification_set").textContent = proposed;
		document.getElementById("administrative_role").textContent = "";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("administrative_shielding").textContent = proposed;
		document.getElementById("technical_role").textContent = "";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("technical_shielding").textContent = proposed;
		document.getElementById("billing_role").textContent = "";
		document.getElementById("billing_shielding").textContent = proposed;
		document.getElementById("emergency_role").textContent = "";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_shielding").textContent = proposed;
		document.getElementById("reseller_role").textContent = "";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_shielding").textContent = proposed;
		document.getElementById("reseller_event_verification_received").textContent = proposed;
		document.getElementById("reseller_event_verification_set").textContent = proposed;
		document.getElementById("registrar_role").textContent = "";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;
		document.getElementById("abuse_role").textContent = "";
		document.getElementById("abuse_telephone").textContent = "";
		document.getElementById("name_servers_dnssec").textContent = "";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "";
		document.getElementById("name_servers_ip").textContent = "";
		document.getElementById("br_zone").textContent = "";
		document.getElementById("raw_data_next").textContent = "";
	}
	else if (translation == 1)	{
		var proposed = '(Nieuw) ';
		var address = "Het afschermen van adresgegevens zoals bij example.tel, resulteert in rommelige gegevens.";
		var accessible = 'De voorgestelde velden verbeteren de bruikbaarheid en vergroten de transparantie van RDAP.';
		document.getElementById("title").textContent = "Domein-informatie";
		document.getElementById("subtitle").textContent = "RDAP-v1-gebaseerde modellering";
		document.getElementById("instruction").textContent = "Vul in en druk op Enter om op te halen.";
		document.getElementById("field").textContent = "Omschrijving";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Een overzicht en toelichting op de structuur en kenmerken van webdomeinen.";
		document.getElementById("zone_role").textContent = 'ICANN beheert de delegatie van een topleveldomein.';
		document.getElementById("zone_tld_category").textContent = proposed + 'Geeft aan of het topleveldomein generiek is (gTLD) of landgebaseerd (ccTLD).';
		document.getElementById("zone_tld_type").textContent = proposed + 'Geeft een overzicht van TLD-typen, zoals gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD en geoTLD.';
		document.getElementById("zone_sponsoring_organization").textContent = proposed + 'Verantwoordelijk voor de toelatingscriteria en communityregels van de TLD.';
		document.getElementById("zone_country_code_designated_manager").textContent = proposed + "ccTLD-beheerders hoeven zich niet aan internationale standaarden te houden.";
		document.getElementById("zone_registry_operator_trade_name").textContent = proposed + 'Handelsnaam van de organisatie die verantwoordelijk is voor het beheer van het register.';
		document.getElementById("zone_backend_operator_trade_name").textContent = proposed + 'De backend-operator verzorgt de technische infrastructuur van de TLD.';
		document.getElementById("zone_language_codes").textContent = proposed + "Geeft ondersteunde talen voor de zone aan.";
		document.getElementById("zone_delegation_url").textContent = proposed + 'URL die verwijst naar het ICANN-delegatierecord voor de TLD.';
		document.getElementById("zone_restrictions_url").textContent = proposed + "Beperkingen op gebruik en registratiebeleid zijn te vinden via deze URL.";
		document.getElementById("zone_menu_url").textContent = proposed + 'Een informatiemenu specifiek voor de zone, bijvoorbeeld via een subdomein zoals "regmenu".';
		document.getElementById("notices_role").textContent = accessible;
		document.getElementById("links_role").textContent = accessible;
		document.getElementById("background_root_zones_url").textContent = proposed + 'Een verwijzing naar de officiële lijst met rootzones.';
		document.getElementById("background_accredited_registrars_url").textContent = proposed;
		document.getElementById("background_role").textContent = "Het Registration Data Access Protocol (RDAP) is bedoeld voor wereldwijde communicatie.";
		document.getElementById("background_lookup_endpoints_url").textContent = proposed;
		document.getElementById("background_registry_source").textContent = proposed + "Een folder /v1/ ondersteunt ook mogelijke /v2/-responses; zie icann.com.";
		document.getElementById("resources_role").textContent = "Geplande functie: Web-ID-zoekopdrachten zijn beschikbaar op wereldwijde RDAP-servers.";
		document.getElementById("resources_registrar_source").textContent = proposed + 'Er is geen registrarbron-URL opgenomen in het huidige RDAP v1-antwoord.';
		document.getElementById("resources_registrar_public_ids").textContent = proposed + "Een IANA-registraraccreditatie-ID voor gTLD's moet correct zijn.";
		document.getElementById("resources_registrar_complaint_url").textContent = proposed + 'Vereist als de registrar IANA-geaccrediteerd is; wordt gebruikt om klachten van gebruikers door te sturen.';		
		document.getElementById("resources_status_explanation_url").textContent = proposed + 'Vereist als de registrar IANA-geaccrediteerd is; bevat uitleg over de statuscode.';
		document.getElementById("details_role").textContent = "Een domein onder TLD-niveau is wereldwijd uniek en kan vrij worden gekozen onder bepaalde regels.";
		document.getElementById("details_name_ascii").textContent = "Voor speciale tekens bevatten de ASCII-tekenreeksen Punycode-transcriptie.";
		document.getElementById("details_name_unicode").textContent = "Hoewel de informatie duidelijk is, is de unicode-domeinnaam optioneel binnen het RDAP-protocol.";
		document.getElementById("details_status_values").textContent = "De waarde 'redemption period' is info over herstel. De waarde 'pending delete' is van toepassing in de laatste fase.";
		document.getElementById("details_event_registration").textContent = "De datumvelden staan hier in een logische volgorde. Dit werkt ook in de RDAP-uitvoer.";
		document.getElementById("details_event_expiration").textContent = "Datum en tijdstip van periodieke verlenging of stopzetting van de publicatie.";
		document.getElementById("details_event_recovery_until").textContent = proposed + "Tijdstip tot wanneer herstel nog mogelijk is.";		
		document.getElementById("details_event_deletion").textContent = "Datum en tijdstip gepland voor volledige verwijdering. Er kan een laatste verwijderingsfase zijn.";
		document.getElementById("details_event_last_uploaded").textContent = "Datum en tijdstip van de RDAP-database-update in Zoeloe-tijd (Coordinated Universal Time - UTC).";
		document.getElementById("details_extensions_values").textContent = "'Eligibility': Hoe een domein voldoet aan een specifieke vereiste in een topleveldomeinzone.";
		document.getElementById("sponsor_role").textContent = "De domeinregistratie kan worden beheerd door een sponsor. Zie bijvoorbeeld france.fr.";
		document.getElementById("registrant_role").textContent = "De domeingebruiker die de daadwerkelijke of effectieve controle heeft voor domeinrecht in het land van vestiging.";
		document.getElementById("registrant_handle").textContent = 'De uitvoer van "hostingtool.nl" bevat onbedoeld informatie met "STE135427-TRAIP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Webidentificatienummer voor bedrijfsentiteiten en natuurlijke personen.";
		document.getElementById("registrant_organization_type").textContent = 'De gebruikelijke waarde is "work", of mogelijk "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "Een organisatie die primair verantwoordelijk is voor het domeinabonnement. Zie bijvoorbeeld icann.org.";
		document.getElementById("registrant_presented_name").textContent = "Geldig is de naam van een primair verantwoordelijke persoon of een rol binnen de organisatie.";
		document.getElementById("registrant_kind").textContent = "Leeg / 'org' / 'individual' (Voor continuïteit: levenstestament + testament + digitale executeur)";
		document.getElementById("registrant_name").textContent = "Een persoonlijke naam kan openbaar zichtbaar zijn in het veld 'presented_name'. Zie bijvoorbeeld circa.ca.";
		document.getElementById("registrant_country_code").textContent = "De ISO-2-landcode-indexering werkt, bijvoorbeeld voor het Verenigd Koninkrijk, dat de EU heeft verlaten.";
		document.getElementById("registrant_street").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;
		document.getElementById("registrant_country_name").textContent = "Een openbaar zichtbare landnaam is beperkt tot een 'Registrar Lookup via RDAP'.";
		document.getElementById("registrant_shielding").textContent = proposed + "Een 'Request-Driven' waarde. Aanvrager/zone/rol vereisen een niet-geclusterde zichtbaarheid.";
		document.getElementById("registrant_event_verification_received").textContent = proposed + "Na identificatie kan een overeenkomende web-ID worden bevestigd, leeg is intrekking.";
		document.getElementById("registrant_event_verification_set").textContent = proposed + "Vervolgens verifieert de registry de gegevens bij de landspecifieke webdomeindienst.";
		document.getElementById("administrative_role").textContent = "Het administratief aanspreekpunt beantwoordt een verzoek en stuurt zo nodig door.";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("administrative_shielding").textContent = proposed;
		document.getElementById("technical_role").textContent = "Een technisch contact reageert om een gemelde storing op te lossen.";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("technical_shielding").textContent = proposed;
		document.getElementById("billing_role").textContent = "Sommige domain registries houden gegevens bij om hun facturering uit te voeren.";
		document.getElementById("billing_shielding").textContent = proposed;
		document.getElementById("emergency_role").textContent = proposed + "Een verantwoordelijke persoon kan de benodigde toegang verlenen.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_shielding").textContent = proposed;
		document.getElementById("reseller_role").textContent = "De domeinreseller is als tweede verantwoordelijk, ook afhankelijk van de overeenkomst en de regelgeving.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_shielding").textContent = proposed;
		document.getElementById("reseller_event_verification_received").textContent = proposed;
		document.getElementById("reseller_event_verification_set").textContent = proposed;
		document.getElementById("registrar_role").textContent = "De domeinregistrar is verantwoordelijk voor domeinreserveringen en IP-adresroutering.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;		
		document.getElementById("abuse_role").textContent = "Informatie over hoe een derde partij contact kan opnemen met de registrar. Zie bijvoorbeeld fryslan.frl.";
		document.getElementById("abuse_telephone").textContent = "Een telefoonnummer moet beginnen met het type. Toegestaan zijn in ieder geval 'voice' en 'fax'.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is een web-route-beveiligingsvoorziening op het DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Een DNSSEC-algoritme vanaf versie 13 is up-to-date.";
		document.getElementById("name_servers_ip").textContent = "IP-waarden in een glue record alleen als de nameservers van de registrar niet worden gebruikt.";
		document.getElementById("br_zone").textContent = "Zone .br: De RDAP-gegevens zijn aangepast met nameservervalidatie.";
		document.getElementById("raw_data_next").textContent = "De rollen zijn hier gerangschikt op verantwoordelijkheid. 'None Specified' komt van deze tool. Voor communicatie in JSON is een leesbare XML-structuur vereist.";
	}
	else if (translation == 2)	{
		var proposed = '(New) ';
		var address = "Shielding address data as with example.tel, results in messy data.";
		var accessible = 'The proposed fields improve usability and enhance transparency of RDAP.';
		document.getElementById("title").textContent = "Domain Information";
		document.getElementById("subtitle").textContent = "RDAP-v1-based modeling";
		document.getElementById("instruction").textContent = "Fill in and press Enter to retrieve.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "An overview and explanation of the structure and characteristics of web domains.";		
		document.getElementById("zone_role").textContent = "ICANN manages the delegation of a top-level domain.";
		document.getElementById("zone_tld_category").textContent = proposed + 'Indicates whether the top-level domain is generic (gTLD) or country-code based (ccTLD).';
		document.getElementById("zone_tld_type").textContent = proposed + 'Enumerates TLD types such as gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD, and geoTLD.';
		document.getElementById("zone_sponsoring_organization").textContent = proposed + 'Responsible for eligibility and community rules related to the TLD.';
		document.getElementById("zone_country_code_designated_manager").textContent = proposed + 'ccTLD managers are not required to adhere to international standards.';
		document.getElementById("zone_registry_operator_trade_name").textContent = proposed + 'Trade name of the organization responsible for operating the registry.';
		document.getElementById("zone_backend_operator_trade_name").textContent = proposed + 'The backend operator manages the technical infrastructure of the TLD.';
		document.getElementById("zone_language_codes").textContent = proposed + "Indicates supported languages for the zone.";
		document.getElementById("zone_delegation_url").textContent = proposed + 'URL referencing the ICANN delegation record for the TLD.';
		document.getElementById("zone_restrictions_url").textContent = proposed + "Restrictions on usage and registration policies can be found at this URL.";
		document.getElementById("zone_menu_url").textContent = proposed + 'A zone-specific info menu, e.g. under a subdomain like "regmenu".';
		document.getElementById("notices_role").textContent = accessible;
		document.getElementById("links_role").textContent = accessible;			
		document.getElementById("background_role").textContent = "The Registration Data Access Protocol (RDAP) is intended for global communication.";
		document.getElementById("background_root_zones_url").textContent = proposed + 'A reference to the official list of root zones.';
		document.getElementById("background_accredited_registrars_url").textContent = proposed;		
		document.getElementById("background_lookup_endpoints_url").textContent = proposed;
		document.getElementById("background_registry_source").textContent = proposed + "A /v1/ folder also supports possible /v2/ responses; see icann.com.";
		document.getElementById("resources_role").textContent = "Planned Feature: Web ID searches will be available on global RDAP servers.";
		document.getElementById("resources_registrar_source").textContent = proposed + 'A registrar source URL is not included in the current RDAP v1 response.';
		document.getElementById("resources_registrar_public_ids").textContent = proposed + "An IANA registrar accreditation ID for gTLDs must be accurate.";
		document.getElementById("resources_registrar_complaint_url").textContent = proposed + 'Required if the registrar is IANA-accredited; used to direct user complaints.';		
		document.getElementById("resources_status_explanation_url").textContent = proposed + 'Required if the registrar is IANA-accredited; provides status code explanations.';		
		document.getElementById("details_role").textContent = "A domain below TLD level is globally unique and can be freely chosen under certain rules.";
		document.getElementById("details_name_ascii").textContent = "For special characters, the ASCII character strings contain Punycode transcription.";
		document.getElementById("details_name_unicode").textContent = "Although the information is clear, the unicode domain name is optional within the RDAP protocol.";
		document.getElementById("details_status_values").textContent = "The 'redemption period' value is info about recovery. The 'pending delete' value applies in the final phase.";
		document.getElementById("details_event_registration").textContent = "The date fields are here in a logical order. This will also work in the RDAP output.";
		document.getElementById("details_event_expiration").textContent = "Date and time of periodic renewal or discontinuation of publication.";
		document.getElementById("details_event_recovery_until").textContent = proposed + "Time until which recovery is still possible.";
		document.getElementById("details_event_deletion").textContent = "Date and time scheduled for complete deletion. A final deletion phase may exist.";
		document.getElementById("details_event_last_uploaded").textContent = "Date and time of RDAP database update in Zulu time (Coordinated Universal Time - UTC).";
		document.getElementById("details_extensions_values").textContent = "'Eligibility': How a domain fulfills a specific requirement in a top-level domain zone.";
		document.getElementById("sponsor_role").textContent = "The domain registration can be managed by a sponsor. See for example france.fr.";
		document.getElementById("registrant_role").textContent = "The domain user who has the actual or effective control for domain rights in the country of establishment.";
		document.getElementById("registrant_handle").textContent = 'The output from "hostingtool.nl" unintentionally contains information with "STE135427-TRAIP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Web Identification number for business entities and natural persons.";
		document.getElementById("registrant_organization_type").textContent = 'The usual value is "work", or possibly "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "An organization primarily responsible for the domain subscription. See for example icann.org.";
		document.getElementById("registrant_presented_name").textContent = "Valid is the name of a primarily responsible person or a role within the organization.";
		document.getElementById("registrant_kind").textContent = "Empty / 'org' / 'individual' (For continuity: Living Will + Will + Digital Executor)";
		document.getElementById("registrant_name").textContent = "A personal name may be publicly visible in the 'presented_name' field. See for example circa.ca.";
		document.getElementById("registrant_country_code").textContent = "ISO-2 country code indexing works, as for the United Kingdom, which has left the EU.";
		document.getElementById("registrant_street").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;		
		document.getElementById("registrant_country_name").textContent = "A publicly visible country name is limited to a 'Registrar Lookup via RDAP'.";
		document.getElementById("registrant_shielding").textContent = proposed + "A Request-Driven value. Requester/zone/role require an unclustered visibility.";
		document.getElementById("registrant_event_verification_received").textContent = proposed + "After identification, a matching web ID can be confirmed, empty is revocation.";
		document.getElementById("registrant_event_verification_set").textContent = proposed + "The registry then verifies the data with the country-specific web domain service.";	
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
		document.getElementById("reseller_event_verification_received").textContent = proposed;
		document.getElementById("reseller_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_role").textContent = "The domain registrar is responsible for domain reservations and IP address routing.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;		
		document.getElementById("abuse_role").textContent = "Information on how a third party can contact the registrar. See e.g. fryslan.frl.";
		document.getElementById("abuse_telephone").textContent = "A telephone number must begin with the type. Allowed are anyway 'voice' and 'fax'.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is a web route security feature on the DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "A DNSSEC algorithm starting from version 13 is up-to-date.";
		document.getElementById("name_servers_ip").textContent = "IP values in a glue record only if the registrar's name servers are not used.";
		document.getElementById("br_zone").textContent = "Zone .br: The RDAP data has been modified with name server validation.";
		document.getElementById("raw_data_next").textContent = "The roles here are arranged according to responsibility. 'None Specified' comes from this tool. Communication in JSON requires a readable XML structure.";
	}
	else if (translation == 3)	{
		var proposed = '(Neu) ';
		var address = "Das Abschirmen von Adressdaten wie bei example.tel, führt zu unordentlichen Daten.";
		var accessible = 'Die vorgeschlagenen Felder verbessern die Benutzerfreundlichkeit und erhöhen die Transparenz von RDAP.';
		document.getElementById("title").textContent = "Domäneninformation";
		document.getElementById("subtitle").textContent = "RDAP-v1-basierte Modellierung";
		document.getElementById("instruction").textContent = "Ausfüllen und zum Abrufen die Eingabetaste drücken.";
		document.getElementById("field").textContent = "Beschreibung";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Eine Übersicht und Erklärung zur Struktur und den Eigenschaften von Webdomänen.";		
		document.getElementById("zone_role").textContent = 'ICANN verwaltet die Delegierung einer Top-Level-Domain.';
		document.getElementById("zone_tld_category").textContent = proposed + 'Gibt an, ob die Top-Level-Domain generisch (gTLD) oder ländercodebasiert (ccTLD) ist.';
		document.getElementById("zone_tld_type").textContent = proposed + 'Zählt TLD-Typen auf, wie etwa gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD und geoTLD.';
		document.getElementById("zone_sponsoring_organization").textContent = proposed + 'Zuständig für die Zulassung und Community-Regeln im Zusammenhang mit der TLD.';
		document.getElementById("zone_country_code_designated_manager").textContent = proposed + 'ccTLD-Manager sind nicht verpflichtet, internationale Standards einzuhalten.';
		document.getElementById("zone_registry_operator_trade_name").textContent = proposed + 'Name der Organisation, die den Registry-Betrieb übernimmt.';
		document.getElementById("zone_backend_operator_trade_name").textContent = proposed + 'Der Backend-Betreiber verwaltet die technische Infrastruktur der TLD.';
		document.getElementById("zone_language_codes").textContent = proposed + "Gibt die unterstützten Sprachen der Zone an.";
		document.getElementById("zone_delegation_url").textContent = proposed + 'URL mit Verweis auf den ICANN-Delegationsdatensatz für die TLD.';
		document.getElementById("zone_restrictions_url").textContent = proposed + "Nutzungsbeschränkungen und Registrierungsrichtlinien finden Sie unter dieser URL.";		
		document.getElementById("zone_menu_url").textContent = proposed + 'Ein zonenspezifisches Informationsmenü, z. B. unter einer Subdomain wie "regmenu".';
		document.getElementById("notices_role").textContent = accessible;
		document.getElementById("links_role").textContent = accessible;
		document.getElementById("background_role").textContent = "Das Registration Data Access Protocol (RDAP) ist für die weltweite Kommunikation vorgesehen.";
		document.getElementById("background_root_zones_url").textContent = proposed + 'Ein Verweis auf die offizielle Liste der Wurzelzonen.';
		document.getElementById("background_accredited_registrars_url").textContent = proposed;		
		document.getElementById("background_lookup_endpoints_url").textContent = proposed;
		document.getElementById("background_registry_source").textContent = proposed + "Ein /v1/-Ordner unterstützt auch mögliche /v2/-Antworten; siehe icann.com.";
		document.getElementById("resources_role").textContent = "Geplante Funktion: Web-ID-Suchen werden auf globalen RDAP-Servern verfügbar sein.";
		document.getElementById("resources_registrar_source").textContent = proposed + 'Eine Registrar-Quell-URL ist in der aktuellen RDAP v1-Antwort nicht enthalten.';
		document.getElementById("resources_registrar_public_ids").textContent = proposed + "Eine IANA-Registrar-Akkreditierungs-ID für gTLDs muss korrekt sein.";
		document.getElementById("resources_registrar_complaint_url").textContent = proposed + 'Erforderlich, wenn der Registrar IANA-akkreditiert ist; wird verwendet, um Benutzerbeschwerden weiterzuleiten.';
		document.getElementById("resources_status_explanation_url").textContent = proposed + 'Erforderlich, wenn der Registrar IANA-akkreditiert ist; bietet Erklärungen zum Statuscode.';
		document.getElementById("details_role").textContent = "Eine Domain unterhalb der TLD-Ebene ist weltweit eindeutig und kann unter bestimmten Regeln frei gewählt werden.";
		document.getElementById("details_name_ascii").textContent = "Für Sonderzeichen enthalten die ASCII-Zeichenfolgen eine Punycode-Transkription.";
		document.getElementById("details_name_unicode").textContent = "Obwohl die Informationen eindeutig sind, ist der Unicode-Domänenname innerhalb des RDAP-Protokolls optional.";
		document.getElementById("details_status_values").textContent = "Der Wert 'redemption period' ist Info zur Wiederherstellung. Der Wert 'pending delete' gilt in der Endphase.";
		document.getElementById("details_event_registration").textContent = "Die Datumsfelder stehen hier in einer logischen Reihenfolge. Dies funktioniert auch in der RDAP-Ausgabe.";
		document.getElementById("details_event_expiration").textContent = "Datum und Uhrzeit der periodischen Erneuerung oder Einstellung der Veröffentlichung.";
		document.getElementById("details_event_recovery_until").textContent = proposed + "Zeitpunkt, bis zu dem eine Wiederherstellung noch möglich ist.";
		document.getElementById("details_event_deletion").textContent = "Datum und Uhrzeit für die vollständige Löschung geplant. Es kann eine abschließende Löschphase geben.";
		document.getElementById("details_event_last_uploaded").textContent = "Datum und Uhrzeit der RDAP-Datenbankaktualisierung in Zulu-Zeit (Koordinierte Weltzeit – UTC).";
		document.getElementById("details_extensions_values").textContent = "'Eligibility': Wie eine Domäne eine bestimmte Anforderung in einer Top-Level-Domänenzone erfüllt.";
		document.getElementById("sponsor_role").textContent = "Die Domänenregistrierung kann von einem Sponsor verwaltet werden. Siehe beispielsweise france.fr.";
		document.getElementById("registrant_role").textContent = "Der Domänenbenutzer, der die tatsächliche oder effektive Kontrolle hat für Domainrechte im Wohnsitzland.";
		document.getElementById("registrant_handle").textContent = 'Die Ausgabe von "hostingtool.nl" enthält unbeabsichtigt Informationen mit "STE135427-TRAIP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Web-Identifikationsnummer für Unternehmen und natürliche Personen.";
		document.getElementById("registrant_organization_type").textContent = 'Der übliche Wert ist "work" oder möglicherweise "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "Eine Organisation, die hauptsächlich für das Domänenabonnement verantwortlich ist. Siehe beispielsweise icann.org.";
		document.getElementById("registrant_presented_name").textContent = "Gültig ist der Name einer hauptverantwortlichen Person oder einer Rolle innerhalb der Organisation.";
		document.getElementById("registrant_kind").textContent = "Leer / 'org' / 'individual' (Für Kontinuität: Patientenverfügung + Testament + digitaler Testamentsvollstrecker)";
		document.getElementById("registrant_name").textContent = "Ein Personenname kann im Feld 'presented_name' öffentlich sichtbar sei. Siehe beispielsweise circa.ca.";
		document.getElementById("registrant_country_code").textContent = "Die Indizierung mit dem ISO-2-Ländercode funktioniert, wie für das Vereinigte Königreich, das die EU verlassen hat.";
		document.getElementById("registrant_street").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;		
		document.getElementById("registrant_country_name").textContent = "Ein öffentlich sichtbarer Ländername ist auf eine 'Registrar Lookup via RDAP' beschränkt.";
		document.getElementById("registrant_shielding").textContent = proposed + "Ein 'Request-Driven' Wert. Anforderer/Zone/Rolle erfordern eine nicht gruppierte Sichtbarkeit.";
		document.getElementById("registrant_event_verification_received").textContent = proposed + "Nach der Identifizierung kann eine passende Web-ID bestätigt werden, leer ist der Widerruf.";
		document.getElementById("registrant_event_verification_set").textContent = proposed + "Anschließend verifiziert die Registry die Daten beim länderspezifischen Webdomänendienst.";
		document.getElementById("administrative_role").textContent = "Die administrativ zuständige Stelle beantwortet eine Anfrage und leitet sie gegebenenfalls weiter.";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("administrative_shielding").textContent = proposed;
		document.getElementById("technical_role").textContent = "Ein technischer Kontakt reagiert, um eine gemeldete Störung zu beheben.";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("technical_shielding").textContent = proposed;
		document.getElementById("billing_role").textContent = "Einige Domänenregistrierungen führen Aufzeichnungen, um ihre Abrechnung durchzuführen.";
		document.getElementById("billing_shielding").textContent = proposed;
		document.getElementById("emergency_role").textContent = proposed + "Die erforderlichen Zugänge kann eine verantwortliche Person bereitstellen.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_shielding").textContent = proposed;
		document.getElementById("reseller_role").textContent = "In zweiter Linie ist der Domain-Reseller, ebenfalls je nach Vereinbarung und Regelungen, verantwortlich.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_shielding").textContent = proposed;
		document.getElementById("reseller_event_verification_received").textContent = proposed;
		document.getElementById("reseller_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_role").textContent = "Der Domänenregistrar ist für die Domänenreservierung und das IP-Adressrouting verantwortlich.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;		
		document.getElementById("abuse_role").textContent = "Informationen darüber, wie Dritte den Registrar kontaktieren können. Siehe z. B. fryslan.frl.";
		document.getElementById("abuse_telephone").textContent = "Eine Telefonnummer muss mit dem Typ beginnen. Erlaubt sind grundsätzlich 'voice' und 'fax'.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC ist eine Sicherheitsfunktion für Webrouten im DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Ein DNSSEC-Algorithmus ab Version 13 ist auf dem neuesten Stand.";
		document.getElementById("name_servers_ip").textContent = "IP-Werte in einem Glue-Record nur, wenn die Nameserver des Registrars nicht verwendet werden.";
		document.getElementById("br_zone").textContent = "Zone .br: Die RDAP-Daten wurden mit der Nameserver-Validierung angepasst.";
		document.getElementById("raw_data_next").textContent = "Die Rollen sind hierbei nach Verantwortung verteilt. 'None Specified' stammt von diesem Tool. Die Kommunikation in JSON erfordert eine lesbare XML-Struktur.";
	}
	else if (translation == 4)	{
		var proposed = '(Nouveau) ';
		var address = "Le blindage des données d'adresse comme avec example.tel, génère des données désordonnées.";
		var accessible = "Les champs proposés améliorent la convivialité et renforcent la transparence du RDAP.";
		document.getElementById("title").textContent = "Informations sur le domaine";
		document.getElementById("subtitle").textContent = "Modélisation basée sur RDAP-v1";
		document.getElementById("instruction").textContent = "Remplissez et appuyez sur Entrée pour récupérer.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Détail";
		document.getElementById("explanation").textContent = "Un aperçu et une explication de la structure et des caractéristiques des domaines Web.";		
		document.getElementById("zone_role").textContent = "L'ICANN gère la délégation d'un domaine de premier niveau.";
		document.getElementById("zone_tld_category").textContent = proposed + "Indique si le domaine de premier niveau est générique (gTLD) ou basé sur un code de pays (ccTLD).";
		document.getElementById("zone_tld_type").textContent = proposed + "Liste les types de TLD, notamment gTLD, grTLD, sTLD, ccTLD, tTLD, iTLD et geoTLD.";
		document.getElementById("zone_sponsoring_organization").textContent = proposed + "Responsable de l'éligibilité et les règles du TLD.";
		document.getElementById("zone_country_code_designated_manager").textContent = proposed + "Les gestionnaires de ccTLD ne sont pas tenus d’adhérer aux normes internationales.";
		document.getElementById("zone_registry_operator_trade_name").textContent = proposed + "Nom commercial de l’organisme responsable de l’exploitation du registre.";
		document.getElementById("zone_backend_operator_trade_name").textContent = proposed + "Le opérateur du backend gère l'infrastructure technique du TLD.";
		document.getElementById("zone_language_codes").textContent = proposed + "Indique les langues prises en charge pour la zone.";
		document.getElementById("zone_delegation_url").textContent = proposed + "URL référençant l'enregistrement de délégation de l'ICANN pour le TLD.";	
		document.getElementById("zone_restrictions_url").textContent = proposed + "Les restrictions d’usage et les politiques d’enregistrement sont accessibles via cette URL.";				document.getElementById("zone_menu_url").textContent = proposed + "Un menu d’information propre à la zone, par exemple sous un sous-domaine comme 'regmenu'.";
		document.getElementById("notices_role").textContent = accessible;
		document.getElementById("links_role").textContent = accessible;
		document.getElementById("background_role").textContent = "Le protocole d'accès aux données d'enregistrement (RDAP) est destiné à la communication mondiale.";
		document.getElementById("background_root_zones_url").textContent = proposed + "Une référence à la liste officielle des zones racines.";
		document.getElementById("background_accredited_registrars_url").textContent = proposed;		
		document.getElementById("background_lookup_endpoints_url").textContent = proposed;
		document.getElementById("background_registry_source").textContent = proposed + "Un dossier /v1/ prend également en charge les réponses /v2/ possibles ; voir icann.com.";
		document.getElementById("resources_role").textContent = "Fonctionnalité prévue : les recherches d’identifiants Web seront disponibles sur les serveurs RDAP mondiaux.";
		document.getElementById("resources_registrar_source").textContent = proposed + "L'URL source du bureau d'enregistrement n'est pas incluse dans la réponse RDAP v1 actuelle.";
		document.getElementById("resources_registrar_public_ids").textContent = proposed + "Un identifiant d'accréditation de bureau d'enregistrement IANA pour les gTLD doit être exact.";
		document.getElementById("resources_registrar_complaint_url").textContent = proposed + "Obligatoire si le registraire est accrédité par l'IANA ; utilisé pour diriger les plaintes des utilisateurs.";		
		document.getElementById("resources_status_explanation_url").textContent = proposed + "Obligatoire si le registraire est accrédité par l'IANA ; fournit des explications sur le code de statut.";
		document.getElementById("details_role").textContent = "Un domaine inférieur au niveau TLD est unique au monde et peut être choisi librement selon certaines règles.";
		document.getElementById("details_name_ascii").textContent = "Pour les caractères spéciaux, les chaînes de caractères ASCII contiennent une transcription Punycode.";
		document.getElementById("details_name_unicode").textContent = "Bien que l'information soit claire, le nom de domaine Unicode est facultatif dans le protocole RDAP.";
		document.getElementById("details_status_values").textContent = "La valeur 'redemption period' est infos de récupération. La valeur 'pending delete' s'applique dans la phase finale.";
		document.getElementById("details_event_registration").textContent = "Les champs de date sont ici classés dans un ordre logique. Cela fonctionnera également dans la sortie RDAP.";
		document.getElementById("details_event_expiration").textContent = "Date et heure du renouvellement périodique ou de l'arrêt de la publication.";
		document.getElementById("details_event_recovery_until").textContent = proposed + "Délai jusqu'à lequel la récupération est encore possible.";
		document.getElementById("details_event_deletion").textContent = "Date et heure prévues pour la suppression complète. Une phase de suppression finale peut exister.";
		document.getElementById("details_event_last_uploaded").textContent = "Date et heure de mise à jour de la base de données RDAP en heure Zulu (Temps Universel Coordonné - UTC).";
		document.getElementById("details_extensions_values").textContent = "'Eligibility' : comment un domaine répond à une exigence spécifique dans une zone de domaine de premier niveau.";
		document.getElementById("sponsor_role").textContent = "L'enregistrement du domaine peut être géré par un sponsor. Voir par exemple france.fr.";
		document.getElementById("registrant_role").textContent = "L'utilisateur du domaine qui a le contrôle réel ou effectif pour les droits de domaine dans le pays de résidence.";
		document.getElementById("registrant_handle").textContent = 'La sortie de "hostingtool.nl" contient involontairement des informations avec "STE135427-TRAIP"';
		document.getElementById("registrant_web_id").textContent = proposed + "Numéro d’identification Web pour les entités commerciales et les personnes physiques.";
		document.getElementById("registrant_organization_type").textContent = 'La valeur habituelle est "work", ou éventuellement "work", "headquarters".';
		document.getElementById("registrant_organization_name").textContent = "Une organisation principalement responsable de l’abonnement au domaine. Voir, par exemple, icann.org.";
		document.getElementById("registrant_presented_name").textContent = "Valide est le nom d'une personne principalement responsable ou d'un rôle au sein de l'organisation.";
		document.getElementById("registrant_kind").textContent = "Vide / 'org' / 'individual' (Pour la continuité : testament biologique + testament + exécuteur testamentaire numérique)";
		document.getElementById("registrant_name").textContent = "Un nom personnel peut être visible publiquement dans le champ 'presented_name'. Voir, par exemple, circa.ca.";
		document.getElementById("registrant_country_code").textContent = "L'indexation des codes pays ISO-2 fonctionne, comme pour le Royaume-Uni, qui a quitté l'UE.";
		document.getElementById("registrant_street").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;
		document.getElementById("registrant_country_name").textContent = "Un nom de pays visible publiquement est limité à une 'Registrar Lookup via RDAP'.";
		document.getElementById("registrant_shielding").textContent = proposed + "Une valeur 'Request-Driven'. Le demandeur/la zone/le rôle nécessite une visibilité non groupée.";
		document.getElementById("registrant_event_verification_received").textContent = proposed + "Après identification, un identifiant Web correspondant peut être confirmé, vide signifie révocation.";
		document.getElementById("registrant_event_verification_set").textContent = proposed + "Le registre vérifie ensuite les données avec le service de domaine Web spécifique au pays.";
		document.getElementById("administrative_role").textContent = "Le bureau administrativement responsable répond à une demande, et la transmet si nécessaire.";
		document.getElementById("administrative_web_id").textContent = proposed;
		document.getElementById("administrative_shielding").textContent = proposed;
		document.getElementById("technical_role").textContent = "Un contact technique répond pour résoudre un dysfonctionnement signalé.";
		document.getElementById("technical_web_id").textContent = proposed;
		document.getElementById("technical_shielding").textContent = proposed;
		document.getElementById("billing_role").textContent = "Certains registres de domaine conservent des enregistrements pour effectuer leur facturation.";
		document.getElementById("billing_shielding").textContent = proposed;
		document.getElementById("emergency_role").textContent = proposed + "Une personne responsable peut fournir l'accès nécessaire.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_shielding").textContent = proposed;
		document.getElementById("reseller_role").textContent = "Le revendeur de domaine est en second lieu responsable, également en fonction de l'accord et des réglementations.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_shielding").textContent = proposed;
		document.getElementById("reseller_event_verification_received").textContent = proposed;
		document.getElementById("reseller_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_role").textContent = "Le registraire de domaine est responsable des réservations de domaines et du routage des adresses IP.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;		
		document.getElementById("abuse_role").textContent = "Informations sur la manière dont un tiers peut contacter le registraire. Voir par exemple fryslan.frl.";
		document.getElementById("abuse_telephone").textContent = "Un numéro de téléphone doit commencer par le type. Sont autorisés de toute façon 'voice' et 'fax'.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC est une fonctionnalité de sécurité de route Web sur le DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Un algorithme DNSSEC à partir de la version 13 est à jour.";
		document.getElementById("name_servers_ip").textContent = "Valeurs IP dans un enregistrement de colle uniquement si les serveurs de noms du registraire ne sont pas utilisés.";
		document.getElementById("br_zone").textContent = "Zone .br: Les données RDAP ont été ajustées avec la validation du serveur de noms.";
		document.getElementById("raw_data_next").textContent = "Les rôles ici sont organisés en fonction des responsabilités. 'None Specified' provient de cet outil. La communication en JSON nécessite une structure XML lisible.";
	}
}	
</script><?php
echo '</head>';
if (ini_get("allow_url_fopen") == 1)	{
}
else	{	
	die('allow_url_fopen does not work.'); 	
}
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
$html_text .= '<tr style="font-size: .8rem"><td id="title" style="font-size: 1.3rem;color:blue;font-weight:bold"></td><td colspan="2" id="instruction"></td></tr>';
$html_text .= '<tr style="font-size: .8rem"><td id="subtitle" style="font-size: 1.0rem;color:blue;font-weight:bold"></td><td><form action='.htmlentities($_SERVER['PHP_SELF']).' method="get">
	<input type="hidden" id="language" name="language" value='.$viewlanguage.'>	
	<input type="text" style="width:90%" id="domain" name="domain" value='.$vd.'></form></td><td>
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(0)">None</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(1)">nl_NL</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(2)">en_US</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(3)">de_DE</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(4)">fr_FR</button> 
	<a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_email" target="_blank">modeling email</a> - <a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_menu" target="_blank">modeling menu</a> - <a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap.hostingtool.nl/issues" target="_blank">reporting of issues</a> - <a style="font-size: 0.9rem" href="https://janwillemstegink.nl/" target="_blank">janwillemstegink.nl</a></td></tr>';
//echo $pd.'#'.$data[$pd]['details']['name_ascii'];
if (true or $pd == mb_strtolower($data[$pd]['details']['name_ascii']) or empty($data[$pd]['details']['name_ascii']))	{
	$html_text .= '<tr style="font-size:1.05rem;font-weight:bold"><td id="field"></td><td id="value"><td id="explanation"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(10)">Zone Information +/-</button></td><td><b>'.$data[$pd]['zone']['top_level_domain'].'</b></td><td id="zone_role"></td></tr>';
	$html_text .= '<tr id="101" style="display:none"><td>zone tld_category</td><td>'.$data[$pd]['zone']['tld_category'].'</td><td id="zone_tld_category"></td></tr>';
	$html_text .= '<tr id="102" style="display:none"><td>zone tld_type</td><td>'.$data[$pd]['zone']['tld_type'].'</td><td id="zone_tld_type"></td></tr>';
	$html_text .= '<tr id="103" style="display:none"><td>zone sponsoring_organization</td><td>'.$data[$pd]['zone']['sponsoring_organization'].'</td><td id="zone_sponsoring_organization"></td></tr>';
	$html_text .= '<tr id="104" style="display:none"><td>zone country_code_designated_manager</td><td>'.$data[$pd]['zone']['country_code_designated_manager'].'</td><td id="zone_country_code_designated_manager"></td></tr>';
	$html_text .= '<tr id="105" style="display:none"><td>zone registry_operator_trade_name</td><td>'.$data[$pd]['zone']['registry_operator_trade_name'].'</td><td id="zone_registry_operator_trade_name"></td></tr>';
	$html_text .= '<tr id="106" style="display:none"><td>zone backend_operator_trade_name</td><td>'.$data[$pd]['zone']['backend_operator_trade_name'].'</td><td id="zone_backend_operator_trade_name"></td></tr>';
	$html_text .= '<tr id="107" style="display:none"><td>zone language_codes</td><td>'.$data[$pd]['zone']['language_codes'].'</td><td id="zone_language_codes"></td></tr>';
	$html_text .= '<tr id="108" style="display:none"><td>zone delegation_url</td><td><a href='.$data[$pd]['zone']['delegation_url'].' target="_blank">Top-Level Domain Delegation</a></td><td id="zone_delegation_url"></td></tr>';
	$html_text .= '<tr id="109" style="display:none"><td>zone restrictions_url</td><td>'.((strlen($data[$pd]['zone']['restrictions_url'])) ? '<a href='.$data[$pd]['zone']['restrictions_url'].' target="_blank">Zone Restrictions</a>' : '').'</td><td id="zone_restrictions_url"></td></tr>';
	$html_text .= '<tr id="1010" style="display:none"><td>zone menu_url</td><td>'.((strlen($data[$pd]['zone']['menu_url'])) ? '<a href='.$data[$pd]['zone']['menu_url'].' target="_blank">Zone Menu</a>' : '').'</td><td id="zone_menu_url"></td></tr>';
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
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(28)">Background Information +/-</button></td><td></td><td id="background_role"></td></tr>';
	$html_text .= '<tr id="281" style="display:none"><td>background object_class_name</td><td>'.$data[$pd]['background']['object_class_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="282" style="display:none; vertical-align:top"><td>background object_conformance</td><td>'.$data[$pd]['background']['object_conformance'].'</td><td></td></tr>';
	$html_text .= '<tr id="283" style="display:none"><td>background root_zones_url</td><td><a href='.$data[$pd]['background']['root_zones_url'].' target="_blank">Root Zones</a></td><td id="background_root_zones_url"></td></tr>';
	$html_text .= '<tr id="284" style="display:none"><td>background accredited_registrars_url</td><td><a href='.$data[$pd]['background']['accredited_registrars_url'].' target="_blank">IANA Registrars</a></td><td id="background_accredited_registrars_url"></td></tr>';
	$html_text .= '<tr id="285" style="display:none"><td>background lookup_endpoints_url</td><td><a href='.$data[$pd]['background']['lookup_endpoints_url'].' target="_blank">Lookup Endpoints</a></td><td id="background_lookup_endpoints_url"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(29)">Resources +/-</button></td><td></td><td id="resources_role"></td></tr>';
	$registry_source = str_replace('https://', '', $data[$pd]['resources']['registry_source']);
	$validation_registry = 'https://validator.rdap.org/?url=https://'.$registry_source.'&response-type=domain&server-type=gtld-registry&errors-only=1';	
	$html_text .= '<tr id="291" style="display:none"><td>resources registry_source</td><td>'.((strlen($data[$pd]['resources']['registry_source'])) ? '<a href='.$data[$pd]['resources']['registry_source'].' target="_blank">Registry Response</a> - <a href="' . htmlspecialchars($validation_registry, ENT_QUOTES, "UTF-8") . '" target="_blank">validator.rdap.org</a>' : 'none').'</td><td id="background_registry_source"></td></tr>';
	$registrar_source = str_replace('https://', '', $data[$pd]['resources']['registrar_source']);
	$validation_registrar = 'https://validator.rdap.org/?url=https://'.$registrar_source.'&response-type=domain&server-type=gtld-registrar&errors-only=1';	
	$html_text .= '<tr id="292" style="display:none"><td>resources registrar_source eg. <a style="font-size: 0.9rem" href="https://rdap.cscglobal.com/dbs/rdap-api/v1/domain/icann.com" target="_blank">icann.com</a> <a style="font-size: 0.9rem" href="https://rdap.metaregistrar.com/domain/fryslan.frl" target="_blank">fryslan.frl</a></td><td>'.((strlen($data[$pd]['resources']['registrar_source'])) ? '<a href='.$data[$pd]['resources']['registrar_source'].' target="_blank">Registrar Response</a> - <a href="' . htmlspecialchars($validation_registrar, ENT_QUOTES, "UTF-8") . '" target="_blank">validator.rdap.org</a>' : 'none').'</td><td id="resources_registrar_source"></td></tr>';
	$html_text .= '<tr id="293" style="display:none"><td>resources registrar_public_ids</td><td>'.((strlen($data[$pd]['resources']['registrar_public_ids'])) ? $data[$pd]['resources']['registrar_public_ids'] : 'none').'</td><td id="resources_registrar_public_ids"></td></tr>';
	$html_text .= '<tr id="294" style="display:none"><td>resources registrar_complaint_url</td><td>'.((strlen($data[$pd]['resources']['registrar_complaint_url'])) ? '<a href='.$data[$pd]['resourcest']['registrar_complaint_url'].' target="_blank">icann.org/wicf</a>' : 'none').'</td><td id="resources_registrar_complaint_url"></td></tr>';
	$html_text .= '<tr id="295" style="display:none"><td>resources status_explanation_url</td><td>'.((strlen($data[$pd]['resources']['status_explanation_url'])) ? '<a href='.$data[$pd]['resources']['status_explanation_url'].' target="_blank">icann.org/epp</a>' : 'none').'</td><td id="resources_status_explanation_url"></td></tr>';
	//$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(30)">Details +/-</button></td><td>'.$vd.'</td><td id="details_role"></td></tr>';
	$html_text .= '<tr id="301" style="display:none"><td>details handle</td><td>'.$data[$pd]['details']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="302" style="display:none"><td>details name_ascii (lower case is not a "MUST")</td><td>'.$data[$pd]['details']['name_ascii'].'</td><td id="details_name_ascii"></td></tr>';
	$html_text .= '<tr id="303" style="display:none"><td>details name_unicode</td><td>'.$data[$pd]['details']['name_unicode'].'</td><td id="details_name_unicode"></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>details status_values</td><td>'.$data[$pd]['details']['status_values'].'</td><td id="details_status_values"></td></tr>';
	$html_text .= '<tr id="304" style="display:none"><td>details event_registration</td><td>'.$data[$pd]['details']['event_registration'].'</td><td id="details_event_registration"></td></tr>';
	$html_text .= '<tr id="305" style="display:none"><td>details event_last_transferred</td><td>'.$data[$pd]['details']['event_last_transferred'].'</td><td></td></tr>';
	$html_text .= '<tr id="306" style="display:none"><td>details event_last_changed</td><td>'.$data[$pd]['details']['event_last_changed'].'</td><td></td></tr>';
	$html_text .= '<tr><td>details event_expiration</td><td>'.$data[$pd]['details']['event_expiration'].'</td><td id="details_event_expiration"></td></tr>';
	$html_text .= '<tr id="307" style="display:none"><td>details event_recovery_until</td><td>'.$data[$pd]['details']['event_recovery_until'].'</td><td id="details_event_recovery_until"></td></tr>';
	$html_text .= '<tr id="308" style="display:none"><td>details event_deletion</td><td>'.$data[$pd]['details']['event_deletion'].'</td><td id="details_event_deletion"></td></tr>';
	$html_text .= '<tr id="309" style="display:none"><td>details event_last_uploaded</td><td>'.$data[$pd]['details']['event_last_uploaded'].'</td><td id="details_event_last_uploaded"></td></tr>';
	$html_text .= '<tr id="3010" style="display:none;vertical-align:top"><td>details extensions_values</td><td>'.$data[$pd]['details']['extensions_values'].'</td><td id="details_extensions_values"></td></tr>';
	$html_text .= '<tr id="3011" style="display:none;vertical-align:top"><td>details remark_values</td><td>'.$data[$pd]['details']['remark_values'].'</td><td></td></tr>';
	$sponsor_applicable = (strlen($data[$pd]['sponsor']['organization_name']) or strlen($data[$pd]['sponsor']['presented_name'])) ? 'Sponsor Data Exists' : 'No Sponsor Data';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(39)">Sponsor +/-</button></td><td>'.$sponsor_applicable.'</td><td id="sponsor_role"></td></tr>';
	$html_text .= '<tr id="391" style="display:none"><td>sponsor handle</td><td>'.$data[$pd]['sponsor']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="392" style="display:none"><td>sponsor web_id</td><td>'.$data[$pd]['sponsor']['web_id'].'</td><td id="sponsor_web_id"></td></tr>';
	$html_text .= '<tr id="393" style="display:none"><td>sponsor organization_type</td><td>'.$data[$pd]['sponsor']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="394" style="display:none"><td>sponsor organization_name</td><td>'.$data[$pd]['sponsor']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="395" style="display:none"><td>sponsor presented_name</td><td>'.$data[$pd]['sponsor']['presented_name'].'</td><td id="sponsor_recover"></td></tr>';
	$html_text .= '<tr id="396" style="display:none"><td>sponsor kind</td><td>'.$data[$pd]['sponsor']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="397" style="display:none"><td>sponsor name</td><td>'.$data[$pd]['sponsor']['name'].'</td><td></td></tr>';
	$html_text .= '<tr id="398" style="display:none"><td>sponsor email</td><td>'.$data[$pd]['sponsor']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="399" style="display:none"><td>sponsor telephone</td><td>'.$data[$pd]['sponsor']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr id="3910" style="display:none"><td>sponsor country_code</td><td>'.$data[$pd]['sponsor']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="3911" style="display:none"><td>sponsor street</td><td>'.$data[$pd]['sponsor']['street'].'</td><td></td></tr>';
	$html_text .= '<tr id="3912" style="display:none"><td>sponsor city</td><td>'.$data[$pd]['sponsor']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="3913" style="display:none"><td>sponsor state_province</td><td>'.$data[$pd]['sponsor']['state_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="3914" style="display:none"><td>sponsor postal_code</td><td>'.$data[$pd]['sponsor']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="3915" style="display:none"><td>sponsor country_name</td><td>'.$data[$pd]['sponsor']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="3916" style="display:none"><td>sponsor language_pref_1</td><td>'.$data[$pd]['sponsor']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="3917" style="display:none"><td>sponsor language_pref_2</td><td>'.$data[$pd]['sponsor']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="3918" style="display:none"><td>sponsor shielding</td><td>'.$data[$pd]['sponsor']['shielding'].'</td><td></td></tr>';
	$html_text .= '<tr id="3919" style="display:none;vertical-align:top"><td>sponsor status_values</td><td>'.$data[$pd]['sponsor']['status_values'].'</td><td></td></tr>';
	$html_text .= '<tr id="3920" style="display:none"><td>sponsor event_registration</td><td>'.$data[$pd]['sponsor']['event_registration'].'</td><td></td></tr>';
	$html_text .= '<tr id="3921" style="display:none"><td>sponsor event_last_transferred</td><td>'.$data[$pd]['sponsor']['event_last_transferred'].'</td><td></td></tr>';
	$html_text .= '<tr id="3922" style="display:none"><td>sponsor event_last_changed</td><td>'.$data[$pd]['sponsor']['event_last_changed'].'</td><td></td></tr>';
	$html_text .= '<tr id="3923" style="display:none"><td>sponsor event_expiration</td><td>'.$data[$pd]['sponsor']['event_expiration'].'</td><td></td></tr>';
	$html_text .= '<tr id="3924" style="display:none"><td>sponsor event_deletion</td><td>'.$data[$pd]['sponsor']['event_deletion'].'</td><td></td></tr>';
	$html_text .= '<tr id="3925" style="display:none"><td>sponsor event_last_uploaded</td><td>'.$data[$pd]['sponsor']['event_last_uploaded'].'</td><td></td></tr>';
	$html_text .= '<tr id="3926" style="display:none"><td>sponsor event_verification_received</td><td>'.$data[$pd]['sponsor']['event_verification_received'].'</td><td id="sponsor_event_verification_received"></td></tr>';
	$html_text .= '<tr id="3927" style="display:none"><td>sponsor event_verification_set</td><td>'.$data[$pd]['sponsor']['event_verification_set'].'</td><td id="sponsor_event_verification_set"></td></tr>';
	$html_text .= '<tr id="3928" style="display:none;vertical-align:top"><td>sponsor properties</td><td>'.$data[$pd]['sponsor']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="3929" style="display:none;vertical-align:top"><td>sponsor remark_values</td><td>'.$data[$pd]['sponsor']['remark_values'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(40)">Registrant +/-</button></td><td></td><td id="registrant_role"></td></tr>';
	$html_text .= '<tr id="401" style="display:none"><td>registrant handle</td><td>'.$data[$pd]['registrant']['handle'].'</td><td id="registrant_handle"></td></tr>';
	$html_text .= '<tr id="402" style="display:none"><td>registrant web_id</td><td>'.$data[$pd]['registrant']['web_id'].'</td><td id="registrant_web_id"></td></tr>';
	$html_text .= '<tr id="403" style="display:none"><td>registrant organization_type</td><td>'.$data[$pd]['registrant']['organization_type'].'</td><td id="registrant_organization_type"></td></tr>';
	$html_text .= '<tr><td>registrant organization_name</td><td>'.$data[$pd]['registrant']['organization_name'].'</td><td id="registrant_organization_name"></td></tr>';
	$html_text .= '<tr><td>registrant presented_name (RDAP: "fn"/full name)</td><td>'.$data[$pd]['registrant']['presented_name'].'</td><td id="registrant_presented_name"></td></tr>';
	$html_text .= '<tr id="404" style="display:none"><td>registrant kind</td><td>'.$data[$pd]['registrant']['kind'].'</td><td id="registrant_kind"></td></tr>';
	$html_text .= '<tr id="405" style="display:none"><td>registrant name</td><td>'.$data[$pd]['registrant']['name'].'</td><td id="registrant_name"></td></tr>';
	$html_text .= '<tr id="406" style="display:none"><td>registrant email</td><td>'.$data[$pd]['registrant']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="407" style="display:none"><td>registrant telephone</td><td>'.$data[$pd]['registrant']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr><td>registrant country_code (<a style="font-size: 0.9rem" href="https://icann-hamster.nl/ham/soac/ccnso/techday/icann80/2.%20RDAP%20Conformance%20Tool%20-%20Tech%20Day.pdf" target="_blank">"cc" parameter</a>)</td><td>'.$data[$pd]['registrant']['country_code'].'</td><td id="registrant_country_code"></td></tr>';
	$html_text .= '<tr id="408" style="display:none"><td>registrant street</td><td>'.$data[$pd]['registrant']['street'].'</td><td id="registrant_street"></td></tr>';
	$html_text .= '<tr id="409" style="display:none"><td>registrant city</td><td>'.$data[$pd]['registrant']['city'].'</td><td id="registrant_city"></td></tr>';
	$html_text .= '<tr id="4010" style="display:none"><td>registrant state_province</td><td>'.$data[$pd]['registrant']['state_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="4011" style="display:none"><td>registrant postal_code</td><td>'.$data[$pd]['registrant']['postal_code'].'</td><td id="registrant_postal_code"></td></tr>';
	$html_text .= '<tr id="4012" style="display:none"><td>registrant country_name</td><td>'.$data[$pd]['registrant']['country_name'].'</td><td id="registrant_country_name"></td></tr>';
	$html_text .= '<tr id="4013" style="display:none"><td>registrant language_pref_1</td><td>'.$data[$pd]['registrant']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4014" style="display:none"><td>registrant language_pref_2</td><td>'.$data[$pd]['registrant']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4015" style="display:none"><td>registrant shielding</td><td>'.$data[$pd]['registrant']['shielding'].'</td><td id="registrant_shielding"></td></tr>';
	$html_text .= '<tr id="4016" style="display:none;vertical-align:top"><td>registrant status_values</td><td>'.$data[$pd]['registrant']['status_values'].'</td><td></td></tr>';
	$html_text .= '<tr id="4017" style="display:none"><td>registrant event_registration</td><td>'.$data[$pd]['registrant']['event_registration'].'</td><td></td></tr>';
	$html_text .= '<tr id="4018" style="display:none"><td>registrant event_last_transferred</td><td>'.$data[$pd]['registrant']['event_last_transferred'].'</td><td></td></tr>';
	$html_text .= '<tr id="4019" style="display:none"><td>registrant event_last_changed</td><td>'.$data[$pd]['registrant']['event_last_changed'].'</td><td></td></tr>';
	$html_text .= '<tr id="4020" style="display:none"><td>registrant event_expiration</td><td>'.$data[$pd]['registrant']['event_expiration'].'</td><td></td></tr>';
	$html_text .= '<tr id="4021" style="display:none"><td>registrant event_deletion</td><td>'.$data[$pd]['registrant']['event_deletion'].'</td><td id="registrant_event_deletion"></td></tr>';
	$html_text .= '<tr id="4022" style="display:none"><td>registrant event_last_uploaded</td><td>'.$data[$pd]['registrant']['event_last_uploaded'].'</td><td id="registrant_event_last_uploaded"></td></tr>';
	$html_text .= '<tr><td>registrant event_verification_received</td><td>'.$data[$pd]['registrant']['event_verification_received'].'</td><td id="registrant_event_verification_received"></td></tr>';
	$html_text .= '<tr><td>registrant event_verification_set</td><td>'.$data[$pd]['registrant']['event_verification_set'].'</td><td id="registrant_event_verification_set"></td></tr>';
	$html_text .= '<tr id="4023" style="display:none;vertical-align:top"><td>registrant properties</td><td>'.$data[$pd]['registrant']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="4024" style="display:none;vertical-align:top"><td>registrant remark_values</td><td>'.$data[$pd]['registrant']['remark_values'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(41)">Administrative / Decision +/-</button></td><td></td><td id="administrative_role"></td></tr>';
	$html_text .= '<tr id="411" style="display:none"><td>administrative handle</td><td>'.$data[$pd]['administrative']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="412" style="display:none"><td>administrative web_id</td><td>'.$data[$pd]['administrative']['web_id'].'</td><td id="administrative_web_id"></td></tr>';
	$html_text .= '<tr id="413" style="display:none"><td>administrative organization_type</td><td>'.$data[$pd]['administrative']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="414" style="display:none"><td>administrative organization_name</td><td>'.$data[$pd]['administrative']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="415" style="display:none"><td>administrative presented_name</td><td>'.$data[$pd]['administrative']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="416" style="display:none"><td>administrative kind</td><td>'.$data[$pd]['administrative']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="417" style="display:none"><td>administrative name</td><td>'.$data[$pd]['administrative']['name'].'</td><td></td></tr>';
	$html_text .= '<tr><td>administrative email</td><td>'.$data[$pd]['administrative']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="418" style="display:none"><td>administrative telephone</td><td>'.$data[$pd]['administrative']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr id="419" style="display:none"><td>administrative country_code</td><td>'.$data[$pd]['administrative']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4110" style="display:none"><td>administrative street</td><td>'.$data[$pd]['administrative']['street'].'</td><td></td></tr>';
	$html_text .= '<tr id="4111" style="display:none"><td>administrative city</td><td>'.$data[$pd]['administrative']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="4112" style="display:none"><td>administrative state_province</td><td>'.$data[$pd]['administrative']['state_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="4113" style="display:none"><td>administrative postal_code</td><td>'.$data[$pd]['administrative']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4114" style="display:none"><td>administrative country_name</td><td>'.$data[$pd]['administrative']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="4115" style="display:none"><td>administrative language_pref_1</td><td>'.$data[$pd]['administrative']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4116" style="display:none"><td>administrative language_pref_2</td><td>'.$data[$pd]['administrative']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4117" style="display:none"><td>administrative shielding</td><td>'.$data[$pd]['administrative']['shielding'].'</td><td id="administrative_shielding"></td></tr>';
	$html_text .= '<tr id="4118" style="display:none;vertical-align:top"><td>administrative properties</td><td>'.$data[$pd]['administrative']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="4119" style="display:none;vertical-align:top"><td>administrative remark_values</td><td>'.$data[$pd]['administrative']['remark_values'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(42)">Technical / Onsite +/-</button></td><td></td><td id="technical_role"></td></tr>';
	$html_text .= '<tr id="421" style="display:none"><td>technical handle</td><td>'.$data[$pd]['technical']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="422" style="display:none"><td>technical web_id</td><td>'.$data[$pd]['technical']['web_id'].'</td><td id="technical_web_id"></td></tr>';
	$html_text .= '<tr id="423" style="display:none"><td>technical organization_type</td><td>'.$data[$pd]['technical']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="424" style="display:none"><td>technical organization_name</td><td>'.$data[$pd]['technical']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="425" style="display:none"><td>technical presented_name</td><td>'.$data[$pd]['technical']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="426" style="display:none"><td>technical kind</td><td>'.$data[$pd]['technical']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="427" style="display:none"><td>technical name</td><td>'.$data[$pd]['technical']['name'].'</td><td></td></tr>';
	$html_text .= '<tr><td>technical email</td><td>'.$data[$pd]['technical']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="428" style="display:none"><td>technical telephone</td><td>'.$data[$pd]['technical']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr id="429" style="display:none"><td>technical country_code</td><td>'.$data[$pd]['technical']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4210" style="display:none"><td>technical street</td><td>'.$data[$pd]['technical']['street'].'</td><td></td></tr>';
	$html_text .= '<tr id="4211" style="display:none"><td>technical city</td><td>'.$data[$pd]['technical']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="4212" style="display:none"><td>technical state_province</td><td>'.$data[$pd]['technical']['state_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="4213" style="display:none"><td>technical postal_code</td><td>'.$data[$pd]['technical']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4214" style="display:none"><td>technical country_name</td><td>'.$data[$pd]['technical']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="4215" style="display:none"><td>technical language_pref_1</td><td>'.$data[$pd]['technical']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4216" style="display:none"><td>technical language_pref_2</td><td>'.$data[$pd]['technical']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4217" style="display:none"><td>technical shielding</td><td>'.$data[$pd]['technical']['shielding'].'</td><td id="technical_shielding"></td></tr>';
	$html_text .= '<tr id="4218" style="display:none;vertical-align:top"><td>technical properties</td><td>'.$data[$pd]['technical']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="4219" style="display:none;vertical-align:top"><td>technical remark_values</td><td>'.$data[$pd]['technical']['remark_values'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(43)">Billing +/-</button></td><td></td><td id="billing_role"></td></tr>';
	$html_text .= '<tr id="431" style="display:none"><td>billing handle</td><td>'.$data[$pd]['billing']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="432" style="display:none"><td>billing web_id</td><td>'.$data[$pd]['billing']['web_id'].'</td><td></td></tr>';
	$html_text .= '<tr id="433" style="display:none"><td>billing organization_type</td><td>'.$data[$pd]['billing']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="434" style="display:none"><td>billing organization_name</td><td>'.$data[$pd]['billing']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="435" style="display:none"><td>billing presented_name</td><td>'.$data[$pd]['billing']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="436" style="display:none"><td>billing kind</td><td>'.$data[$pd]['billing']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="437" style="display:none"><td>billing name</td><td>'.$data[$pd]['billing']['name'].'</td><td></td></tr>';
	$html_text .= '<tr id="438" style="display:none"><td>billing email</td><td>'.$data[$pd]['billing']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="439" style="display:none"><td>billing telephone</td><td>'.$data[$pd]['billing']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr id="4310" style="display:none"><td>billing country_code</td><td>'.$data[$pd]['billing']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4311" style="display:none"><td>billing street</td><td>'.$data[$pd]['billing']['street'].'</td><td></td></tr>';
	$html_text .= '<tr id="4312" style="display:none"><td>billing city</td><td>'.$data[$pd]['billing']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="4313" style="display:none"><td>billing state_province</td><td>'.$data[$pd]['billing']['state_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="4314" style="display:none"><td>billing postal_code</td><td>'.$data[$pd]['billing']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4315" style="display:none"><td>billing country_name</td><td>'.$data[$pd]['billing']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="4316" style="display:none"><td>billing language_pref_1</td><td>'.$data[$pd]['billing']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4317" style="display:none"><td>billing language_pref_2</td><td>'.$data[$pd]['billing']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4318" style="display:none"><td>billing shielding</td><td>'.$data[$pd]['billing']['shielding'].'</td><td id="billing_shielding"></td></tr>';
	$html_text .= '<tr id="4319" style="display:none;vertical-align:top"><td>billing properties</td><td>'.$data[$pd]['billing']['properties'].'</td><td></td></tr>';	
	$html_text .= '<tr id="4320" style="display:none;vertical-align:top"><td>billing remark_values</td><td>'.$data[$pd]['billing']['remark_values'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(44)">Emergency +/-</button></td><td></td><td id="emergency_role"></td></tr>';
	$html_text .= '<tr id="441" style="display:none"><td>emergency handle</td><td>'.$data[$pd]['emergency']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="442" style="display:none"><td>emergency web_id</td><td>'.$data[$pd]['emergency']['web_id'].'</td><td id="emergency_web_id"></td></tr>';
	$html_text .= '<tr id="443" style="display:none"><td>emergency organization_type</td><td>'.$data[$pd]['emergency']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="444" style="display:none"><td>emergency organization_name</td><td>'.$data[$pd]['emergency']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="445" style="display:none"><td>emergency presented_name</td><td>'.$data[$pd]['emergency']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="446" style="display:none"><td>emergency kind</td><td>'.$data[$pd]['emergency']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="447" style="display:none"><td>emergency name</td><td>'.$data[$pd]['emergency']['name'].'</td><td></td></tr>';
	$html_text .= '<tr id="448" style="display:none"><td>emergency email</td><td>'.$data[$pd]['emergency']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="449" style="display:none"><td>emergency telephone</td><td>'.$data[$pd]['emergency']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr id="4410" style="display:none"><td>emergency country_code</td><td>'.$data[$pd]['emergency']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4411" style="display:none"><td>emergency street</td><td>'.$data[$pd]['emergency']['street'].'</td><td></td></tr>';
	$html_text .= '<tr id="4412" style="display:none"><td>emergency city</td><td>'.$data[$pd]['emergency']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="4413" style="display:none"><td>emergency state_province</td><td>'.$data[$pd]['emergency']['state_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="4414" style="display:none"><td>emergency postal_code</td><td>'.$data[$pd]['emergency']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="4415" style="display:none"><td>emergency country_name</td><td>'.$data[$pd]['emergency']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="4416" style="display:none"><td>emergency language_pref_1</td><td>'.$data[$pd]['emergency']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="4417" style="display:none"><td>emergency language_pref_2</td><td>'.$data[$pd]['emergency']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="4418" style="display:none"><td>emergency shielding</td><td>'.$data[$pd]['emergency']['shielding'].'</td><td id="emergency_shielding"></td></tr>';
	$html_text .= '<tr id="4419" style="display:none;vertical-align:top"><td>emergency properties</td><td>'.$data[$pd]['emergency']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="4420" style="display:none;vertical-align:top"><td>emergency remark_values</td><td>'.$data[$pd]['emergency']['remark_values'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(50)">Reseller +/-</button></td><td></td><td id="reseller_role"></td></tr>';
	$html_text .= '<tr id="501" style="display:none"><td>reseller handle</td><td>'.$data[$pd]['reseller']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="502" style="display:none"><td>reseller web_id</td><td>'.$data[$pd]['reseller']['web_id'].'</td><td id="reseller_web_id"></td></tr>';
	$html_text .= '<tr id="503" style="display:none"><td>reseller organization_type</td><td>'.$data[$pd]['reseller']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr><td>reseller organization_name</td><td>'.$data[$pd]['reseller']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr><td>reseller presented_name</td><td>'.$data[$pd]['reseller']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="504" style="display:none"><td>reseller kind</td><td>'.$data[$pd]['reseller']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="505" style="display:none"><td>reseller name</td><td>'.$data[$pd]['reseller']['name'].'</td><td></td></tr>';
	$html_text .= '<tr id="506" style="display:none"><td>reseller email</td><td>'.$data[$pd]['reseller']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="507" style="display:none"><td>reseller telephone</td><td>'.$data[$pd]['reseller']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr><td>reseller country_code</td><td>'.$data[$pd]['reseller']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="508" style="display:none"><td>reseller street</td><td>'.$data[$pd]['reseller']['street'].'</td><td></td></tr>';
	$html_text .= '<tr id="509" style="display:none"><td>reseller city</td><td>'.$data[$pd]['reseller']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="5010" style="display:none"><td>reseller state_province</td><td>'.$data[$pd]['reseller']['state_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="5011" style="display:none"><td>reseller postal_code</td><td>'.$data[$pd]['reseller']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="5012" style="display:none"><td>reseller country_name</td><td>'.$data[$pd]['reseller']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="5013" style="display:none"><td>reseller language_pref_1</td><td>'.$data[$pd]['reseller']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="5014" style="display:none"><td>reseller language_pref_2</td><td>'.$data[$pd]['reseller']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="5015" style="display:none"><td>reseller shielding</td><td>'.$data[$pd]['reseller']['shielding'].'</td><td id="reseller_shielding"></td></tr>';
	$html_text .= '<tr id="5016" style="display:none;vertical-align:top"><td>reseller status_values</td><td>'.$data[$pd]['reseller']['status_values'].'</td><td></td></tr>';
	$html_text .= '<tr id="5017" style="display:none"><td>reseller event_registration</td><td>'.$data[$pd]['reseller']['event_registration'].'</td><td></td></tr>';
	$html_text .= '<tr id="5018" style="display:none"><td>reseller event_last_transferred</td><td>'.$data[$pd]['reseller']['event_last_transferred'].'</td><td></td></tr>';
	$html_text .= '<tr id="5019" style="display:none"><td>reseller event_last_changed</td><td>'.$data[$pd]['reseller']['event_last_changed'].'</td><td></td></tr>';
	$html_text .= '<tr id="5020" style="display:none"><td>reseller event_expiration</td><td>'.$data[$pd]['reseller']['event_expiration'].'</td><td></td></tr>';
	$html_text .= '<tr id="5021" style="display:none"><td>reseller event_deletion</td><td>'.$data[$pd]['reseller']['event_deletion'].'</td><td></td></tr>';
	$html_text .= '<tr id="5022" style="display:none"><td>reseller event_last_uploaded</td><td>'.$data[$pd]['reseller']['event_last_uploaded'].'</td><td></td></tr>';
	$html_text .= '<tr id="5023" style="display:none"><td>reseller event_verification_received</td><td>'.$data[$pd]['reseller']['event_verification_received'].'</td><td id="reseller_event_verification_received"></td></tr>';
	$html_text .= '<tr id="5024" style="display:none"><td>reseller event_verification_set</td><td>'.$data[$pd]['reseller']['event_verification_set'].'</td><td id="reseller_event_verification_set"></td></tr>';
	$html_text .= '<tr id="5025" style="display:none;vertical-align:top"><td>reseller properties</td><td>'.$data[$pd]['reseller']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="5026" style="display:none;vertical-align:top"><td>reseller remark_values</td><td>'.$data[$pd]['reseller']['remark_values'].'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(60)">Registrar +/-</button></td><td></td><td id="registrar_role"></td></tr>';
	$html_text .= '<tr id="601" style="display:none"><td>registrar handle</td><td>'.$data[$pd]['registrar']['handle'].'</td><td></td></tr>';
	$html_text .= '<tr id="602" style="display:none"><td>registrar web_id</td><td>'.$data[$pd]['registrar']['web_id'].'</td><td id="registrar_web_id"></td></tr>';
	$html_text .= '<tr id="603" style="display:none"><td>registrar organization_type</td><td>'.$data[$pd]['registrar']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr><td>registrar organization_name</td><td>'.$data[$pd]['registrar']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr><td>registrar presented_name</td><td>'.$data[$pd]['registrar']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="604" style="display:none"><td>registrar kind</td><td>'.$data[$pd]['registrar']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="605" style="display:none"><td>registrar name</td><td>'.$data[$pd]['registrar']['name'].'</td><td></td></tr>';
	$html_text .= '<tr id="606" style="display:none"><td>registrar email</td><td>'.$data[$pd]['registrar']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="607" style="display:none"><td>registrar telephone</td><td>'.$data[$pd]['registrar']['telephone'].'</td><td></td></tr>';
	$html_text .= '<tr><td>registrar country_code</td><td>'.$data[$pd]['registrar']['country_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="608" style="display:none"><td>registrar street</td><td>'.$data[$pd]['registrar']['street'].'</td><td></td></tr>';
	$html_text .= '<tr id="609" style="display:none"><td>registrar city</td><td>'.$data[$pd]['registrar']['city'].'</td><td></td></tr>';
	$html_text .= '<tr id="6010" style="display:none"><td>registrar state_province</td><td>'.$data[$pd]['registrar']['state_province'].'</td><td></td></tr>';
	$html_text .= '<tr id="6011" style="display:none"><td>registrar postal_code</td><td>'.$data[$pd]['registrar']['postal_code'].'</td><td></td></tr>';
	$html_text .= '<tr id="6012" style="display:none"><td>registrar country_name</td><td>'.$data[$pd]['registrar']['country_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="6013" style="display:none"><td>registrar language_pref_1</td><td>'.$data[$pd]['registrar']['language_pref_1'].'</td><td></td></tr>';
	$html_text .= '<tr id="6014" style="display:none"><td>registrar language_pref_2</td><td>'.$data[$pd]['registrar']['language_pref_2'].'</td><td></td></tr>';
	$html_text .= '<tr id="6015" style="display:none"><td>registrar shielding</td><td>'.$data[$pd]['registrar']['shielding'].'</td><td id="registrar_shielding"></td></tr>';
	$html_text .= '<tr id="6016" style="display:none;vertical-align:top"><td>registrar status_values</td><td>'.$data[$pd]['registrar']['status_values'].'</td><td></td></tr>';
	$html_text .= '<tr id="6017" style="display:none"><td>registrar event_registration</td><td>'.$data[$pd]['registrar']['event_registration'].'</td><td></td></tr>';
	$html_text .= '<tr id="6018" style="display:none"><td>registrar event_last_transferred</td><td>'.$data[$pd]['registrar']['event_last_transferred'].'</td><td></td></tr>';
	$html_text .= '<tr id="6019" style="display:none"><td>registrar event_last_changed</td><td>'.$data[$pd]['registrar']['event_last_changed'].'</td><td></td></tr>';
	$html_text .= '<tr id="6020" style="display:none"><td>registrar event_expiration</td><td>'.$data[$pd]['registrar']['event_expiration'].'</td><td></td></tr>';
	$html_text .= '<tr id="6021" style="display:none"><td>registrar event_deletion</td><td>'.$data[$pd]['registrar']['event_deletion'].'</td><td></td></tr>';
	$html_text .= '<tr id="6022" style="display:none"><td>registrar event_last_uploaded</td><td>'.$data[$pd]['registrar']['event_last_uploaded'].'</td><td></td></tr>';
	$html_text .= '<tr id="6023" style="display:none"><td>registrar event_verification_received</td><td>'.$data[$pd]['registrar']['event_verification_received'].'</td><td id="registrar_event_verification_received"></td></tr>';
	$html_text .= '<tr id="6024" style="display:none"><td>registrar event_verification_set</td><td>'.$data[$pd]['registrar']['event_verification_set'].'</td><td id="registrar_event_verification_set"></td></tr>';
	$html_text .= '<tr id="6025" style="display:none;vertical-align:top"><td>registrar properties</td><td>'.$data[$pd]['registrar']['properties'].'</td><td></td></tr>';
	$html_text .= '<tr id="6026" style="display:none;vertical-align:top"><td>registrar remark_values</td><td>'.$data[$pd]['registrar']['remark_values'].'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(61)">Abuse +/-</button></td><td></td><td id="abuse_role"></td></tr>';
	$html_text .= '<tr id="611" style="display:none"><td>abuse organization_type</td><td>'.$data[$pd]['abuse']['organization_type'].'</td><td></td></tr>';
	$html_text .= '<tr id="612" style="display:none"><td>abuse organization_name</td><td>'.$data[$pd]['abuse']['organization_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="613" style="display:none"><td>abuse presented_name</td><td>'.$data[$pd]['abuse']['presented_name'].'</td><td></td></tr>';
	$html_text .= '<tr id="614" style="display:none"><td>abuse kind</td><td>'.$data[$pd]['abuse']['kind'].'</td><td></td></tr>';
	$html_text .= '<tr id="615" style="display:none"><td>abuse email</td><td>'.$data[$pd]['abuse']['email'].'</td><td></td></tr>';
	$html_text .= '<tr id="616" style="display:none"><td>abuse telephone</td><td>'.$data[$pd]['abuse']['telephone'].'</td><td id="abuse_telephone"></td></tr>';
	$html_text .= '<tr id="617" style="display:none"><td>abuse country_code</td><td>'.$data[$pd]['abuse']['country_code'].'</td><td id="abuse_country_code"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(63)">Name Servers +/-</button></td><td></td><td></td></tr>';
	//if (!empty($data[$pd]['name_servers']['server_1']['server_name_ascii']))	{
	//	if (strlen(trim($data[$pd]['name_servers']['server_1']['server_name_ascii'])))	{
			$html_text .= '<tr id="631" style="display:none"><td>server_name_ascii_1</td><td>'.$data[$pd]['name_servers']['server_1']['server_name_ascii'].'</td><td></td></tr>';
			$html_text .= '<tr id="632" style="display:none"><td>server_name_unicode_1</td><td>'.$data[$pd]['name_servers']['server_1']['server_name_unicode'].'</td><td></td></tr>';
			$html_text .= '<tr id="633" style="display:none"><td>server_ipv4_1</td><td>'.$data[$pd]['name_servers']['server_1']['server_ipv4'].'</td><td id="name_servers_ip"></td></tr>';
			$html_text .= '<tr id="634" style="display:none"><td>server_ipv6_1</td><td>'.$data[$pd]['name_servers']['server_1']['server_ipv6'].'</td><td></td></tr>';
			$html_text .= '<tr id="635" style="display:none"><td>server_delegation_check_1</td><td>'.$data[$pd]['name_servers']['server_1']['server_delegation_check'].'</td><td id="br_zone"></td></tr>';
			$html_text .= '<tr id="636" style="display:none"><td>server_status_1</td><td>'.$data[$pd]['name_servers']['server_1']['server_status'].'</td><td></td></tr>';
			$html_text .= '<tr id="637" style="display:none"><td>server_delegation_check_last_correct_1</td><td>'.$data[$pd]['name_servers']['server_1']['server_delegation_check_last_correct'].'</td><td></td></tr>';	
	//	}	
	//}
	if (!empty($data[$pd]['name_servers']['server_2']['server_name_ascii']))	{		
		if (strlen(trim($data[$pd]['name_servers']['server_2']['server_name_ascii'])))	{
			$html_text .= '<tr id="638" style="display:none"><td>server_name_ascii_2</td><td>'.$data[$pd]['name_servers']['server_2']['server_name_ascii'].'</td><td></td></tr>';
			$html_text .= '<tr id="639" style="display:none"><td>server_name_unicode_2</td><td>'.$data[$pd]['name_servers']['server_2']['server_name_unicode'].'</td><td></td></tr>';		
			$html_text .= '<tr id="6310" style="display:none"><td>server_ipv4_2</td><td>'.$data[$pd]['name_servers']['server_2']['server_ipv4'].'</td><td></td></tr>';
			$html_text .= '<tr id="6311" style="display:none"><td>server_ipv6_2</td><td>'.$data[$pd]['name_servers']['server_2']['server_ipv6'].'</td><td></td></tr>';
			$html_text .= '<tr id="6312" style="display:none"><td>server_delegation_check_2</td><td>'.$data[$pd]['name_servers']['server_2']['server_delegation_check'].'</td><td></td></tr>';
			$html_text .= '<tr id="6313" style="display:none"><td>server_status_2</td><td>'.$data[$pd]['name_servers']['server_2']['server_status'].'</td><td></td></tr>';
			$html_text .= '<tr id="6314" style="display:none"><td>server_delegation_check_last_correct_2</td><td>'.$data[$pd]['name_servers']['server_2']['server_delegation_check_last_correct'].'</td><td></td></tr>';
		}	
	}
	if (!empty($data[$pd]['name_servers']['server_3']['server_name_ascii']))	{
		if (strlen(trim($data[$pd]['name_servers']['server_3']['server_name_ascii'])))	{
			$html_text .= '<tr id="6315" style="display:none"><td>server_name_ascii_3</td><td>'.$data[$pd]['name_servers']['server_3']['server_name_ascii'].'</td><td></td></tr>';
			$html_text .= '<tr id="6316" style="display:none"><td>server_name_unicode_3</td><td>'.$data[$pd]['name_servers']['server_3']['server_name_unicode'].'</td><td></td></tr>';
			$html_text .= '<tr id="6317" style="display:none"><td>server_ipv4_3</td><td>'.$data[$pd]['name_servers']['server_3']['server_ipv4'].'</td><td></td></tr>';
			$html_text .= '<tr id="6318" style="display:none"><td>server_ipv6_3</td><td>'.$data[$pd]['name_servers']['server_3']['server_ipv6'].'</td><td></td></tr>';
			$html_text .= '<tr id="6319" style="display:none"><td>server_delegation_check_3</td><td>'.$data[$pd]['name_servers']['server_3']['server_delegation_check'].'</td><td></td></tr>';
			$html_text .= '<tr id="6320" style="display:none"><td>server_status_3</td><td>'.$data[$pd]['name_servers']['server_3']['server_status'].'</td><td></td></tr>';
			$html_text .= '<tr id="6321" style="display:none"><td>server_delegation_check_last_correct_3</td><td>'.$data[$pd]['name_servers']['server_3']['server_delegation_check_last_correct'].'</td><td></td></tr>';				
		}	
	}
	if (!empty($data[$pd]['name_servers']['server_4']['server_name_ascii']))	{	
		if (strlen(trim($data[$pd]['name_servers']['server_4']['server_name_ascii'])))	{
			$html_text .= '<tr id="6322" style="display:none"><td>server_name_ascii_4</td><td>'.$data[$pd]['name_servers']['server_4']['server_name_ascii'].'</td><td></td></tr>';
			$html_text .= '<tr id="6323" style="display:none"><td>server_name_unicode_4</td><td>'.$data[$pd]['name_servers']['server_4']['server_name_unicode'].'</td><td></td></tr>';	
			$html_text .= '<tr id="6324" style="display:none"><td>server_ipv4_4</td><td>'.$data[$pd]['name_servers']['server_4']['server_ipv4'].'</td><td></td></tr>';
			$html_text .= '<tr id="6325" style="display:none"><td>server_ipv6_4</td><td>'.$data[$pd]['name_servers']['server_4']['server_ipv6'].'</td><td></td></tr>';
			$html_text .= '<tr id="6326" style="display:none"><td>server_delegation_check_4</td><td>'.$data[$pd]['name_servers']['server_4']['server_delegation_check'].'</td><td></td></tr>';
			$html_text .= '<tr id="6327" style="display:none"><td>server_status_4</td><td>'.$data[$pd]['name_servers']['server_4']['server_status'].'</td><td></td></tr>';
			$html_text .= '<tr id="6328" style="display:none"><td>server_delegation_check_last_correct_4</td><td>'.$data[$pd]['name_servers']['server_4']['server_delegation_check_last_correct'].'</td><td></td></tr>';
		}	
	}
	if (!empty($data[$pd]['name_servers']['server_5']['server_name_ascii']))	{		
		if (strlen(trim($data[$pd]['name_servers']['server_5']['server_name_ascii'])))	{
			$html_text .= '<tr id="6329" style="display:none"><td>server_name_ascii_5</td><td>'.$data[$pd]['name_servers']['server_5']['server_name_ascii'].'</td><td></td></tr>';
			$html_text .= '<tr id="6330" style="display:none"><td>server_name_unicode_5</td><td>'.$data[$pd]['name_servers']['server_5']['server_name_unicode'].'</td><td></td></tr>';
			$html_text .= '<tr id="6331" style="display:none"><td>server_ipv4_5</td><td>'.$data[$pd]['name_servers']['server_5']['server_ipv4'].'</td><td></td></tr>';
			$html_text .= '<tr id="6332" style="display:none"><td>server_ipv6_5</td><td>'.$data[$pd]['name_servers']['server_5']['server_ipv6'].'</td><td></td></tr>';
			$html_text .= '<tr id="6333" style="display:none"><td>server_delegation_check_5</td><td>'.$data[$pd]['name_servers']['server_5']['server_delegation_check'].'</td><td></td></tr>';
			$html_text .= '<tr id="6334" style="display:none"><td>server_status_5</td><td>'.$data[$pd]['name_servers']['server_5']['server_status'].'</td><td></td></tr>';
			$html_text .= '<tr id="6335" style="display:none"><td>server_delegation_check_last_correct_5</td><td>'.$data[$pd]['name_servers']['server_5']['server_delegation_check_last_correct'].'</td><td></td></tr>';	
		}	
	}
	if (!empty($data[$pd]['name_servers']['server_6']['server_name_ascii']))	{
		if (strlen(trim($data[$pd]['name_servers']['server_6']['server_name_ascii'])))	{
			$html_text .= '<tr id="6336" style="display:none"><td>server_name_ascii_6</td><td>'.$data[$pd]['name_servers']['server_6']['server_name_ascii'].'</td><td></td></tr>';
			$html_text .= '<tr id="6337" style="display:none"><td>server_name_unicode_6</td><td>'.$data[$pd]['name_servers']['server_6']['server_name_unicode'].'</td><td></td></tr>';	
			$html_text .= '<tr id="6338" style="display:none"><td>server_ipv4_6</td><td>'.$data[$pd]['name_servers']['server_6']['server_ipv4'].'</td><td></td></tr>';
			$html_text .= '<tr id="6339" style="display:none"><td>server_ipv6_6</td><td>'.$data[$pd]['name_servers']['server_6']['server_ipv6'].'</td><td></td></tr>';
			$html_text .= '<tr id="6340" style="display:none"><td>server_delegation_check_6</td><td>'.$data[$pd]['name_servers']['server_6']['server_delegation_check'].'</td><td></td></tr>';
			$html_text .= '<tr id="6341" style="display:none"><td>server_status_6</td><td>'.$data[$pd]['name_servers']['server_6']['server_status'].'</td><td></td></tr>';
			$html_text .= '<tr id="6342" style="display:none"><td>server_delegation_check_last_correct_6</td><td>'.$data[$pd]['name_servers']['server_6']['server_delegation_check_last_correct'].'</td><td></td></tr>';	
		}	
	}
	$html_text .= '<tr><td>name_servers dnssec</td><td>'.$data[$pd]['name_servers']['dnssec'].'</td><td id="name_servers_dnssec"></td></tr>';
	$html_text .= '<tr><td>name_servers dnssec_algorithm</td><td>'.$data[$pd]['name_servers']['dnssec_algorithm'].'</td><td id="name_servers_dnssec_algorithm"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(70)">raw Whois +/-</button></td><td colspan="2"></td></tr>';
	$html_text .= '<tr id="701" style="display:none"><td colspan="3">'.$data[$pd]['raw_whois'].'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(75)">raw RDAP +/-</button></td><td id="raw_data_next" colspan="2"></td></tr>';
	$html_text .= '<tr id="751" style="display:none"><td colspan="3">'.$data[$pd]['raw_rdap'].'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>