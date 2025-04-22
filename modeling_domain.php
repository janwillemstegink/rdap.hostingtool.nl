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
		var max = 6
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
	else if (type == 29)	{ // protocols
		var pre = '29';
		var max = 6
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
		var max = 6
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
		document.getElementById("instruction").textContent = "Paste a domain name and press Enter.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "";
		document.getElementById("zone_role").textContent = "";
		document.getElementById("zone_delegation_url").textContent = proposed;
		document.getElementById("zone_registry_operator_trade_name").textContent = proposed;
		document.getElementById("zone_restrictions_url").textContent = proposed;
		document.getElementById("zone_registry_trade_name").textContent = proposed;
		document.getElementById("zone_menu_url").textContent = proposed;
		document.getElementById("zone_language_codes").textContent = proposed;
		document.getElementById("notices_role").textContent = "";
		document.getElementById("links_role").textContent = "";		
		document.getElementById("protocols_role").textContent = "";
		document.getElementById("protocols_registrar_iana_id").textContent = proposed;
		document.getElementById("protocols_registrar_complaint").textContent = proposed;
		document.getElementById("protocols_source_registry_trade_name").textContent = proposed;
		document.getElementById("protocols_source_registrar").textContent = proposed;
		document.getElementById("protocols_status_explanation").textContent = proposed;
		document.getElementById("details_role").textContent = "";
		document.getElementById("details_name_ascii").textContent = "";
		document.getElementById("details_name_unicode").textContent = "";
		document.getElementById("details_status_values").textContent = "";
		document.getElementById("details_event_expiration").textContent = "";
		document.getElementById("details_event_recovery_until").textContent = proposed;
		document.getElementById("details_event_deletion").textContent = "";
		document.getElementById("details_event_last_uploaded").textContent = "";
		document.getElementById("details_extensions_values").textContent = "";
		document.getElementById("sponsor_role").textContent = "";
		document.getElementById("registrant_role").textContent = "";
		document.getElementById("registrant_handle").textContent = "";
		document.getElementById("registrant_web_id").textContent = proposed;
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
		document.getElementById("registrar_abuse_role").textContent = "";
		document.getElementById("registrar_abuse_telephone").textContent = "";
		document.getElementById("name_servers_dnssec").textContent = "";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "";
		document.getElementById("name_servers_ip").textContent = "";
		document.getElementById("br_zone").textContent = "";
		document.getElementById("raw_data_next").textContent = "";
	}
	else if (translation == 1)	{
		var proposed = 'Voorgesteld - ';
		var address = "Het afschermen van adresgegevens zoals bij example.tel, resulteert in rommelige gegevens.";
		var accessible = 'Met de voorgestelde velden wordt deze informatie gemakkelijker toegankelijk.';
		document.getElementById("title").textContent = "Domein-informatie";
		document.getElementById("subtitle").textContent = "RDAP-v1-gebaseerde modellering";
		document.getElementById("instruction").textContent = "Plak een domeinnaam en druk op Enter.";
		document.getElementById("field").textContent = "Omschrijving";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Webdomeinen toegelicht";
		document.getElementById("zone_role").textContent = "Topleveldomeinen worden door ICANN toegewezen aan domeinregisters die de domeinen beheren.";
		document.getElementById("zone_delegation_url").textContent = proposed + "Gepland: Web-ID-zoekopdrachten kunnen worden uitgevoerd op wereldwijde RDAP-servers.";
		document.getElementById("zone_registry_operator_trade_name").textContent = proposed;
		document.getElementById("zone_restrictions_url").textContent = proposed + "Het gebruik van domeingegevens is aan beperkingen onderhevig.";
		document.getElementById("zone_menu_url").textContent = proposed + 'Een vervolgkeuzemenu met uitleg en details, bijvoorbeeld via een subdomein "regmenu".';
		document.getElementById("zone_registry_trade_name").textContent = proposed;
		document.getElementById("zone_language_codes").textContent = proposed + "Een zone kan met meerdere veelgebruikte talen werken.";
		document.getElementById("notices_role").textContent = accessible;
		document.getElementById("links_role").textContent = accessible;	
		document.getElementById("protocols_role").textContent = "Het Registration Data Access Protocol (RDAP) is bedoeld voor wereldwijde communicatie.";
		document.getElementById("protocols_registrar_iana_id").textContent = proposed + "Accreditatie, voor één of meer generieke topleveldomeinen. En moet juist zijn.";
		document.getElementById("protocols_registrar_complaint").textContent = proposed;
		document.getElementById("protocols_source_registry_trade_name").textContent = proposed + "Een folder '/v1/' werkt voor een versie '/v2/', zie icann.com.";
		document.getElementById("protocols_source_registrar").textContent = proposed;
		document.getElementById("protocols_status_explanation").textContent = proposed;
		document.getElementById("details_role").textContent = "Een domein onder TLD-niveau is wereldwijd uniek en kan vrij worden gekozen onder bepaalde regels.";
		document.getElementById("details_name_ascii").textContent = "Namen met speciale tekens in ASCII-tekenreeksen gebruiken Punycode-transcriptie.";
		document.getElementById("details_name_unicode").textContent = "In het RDAP-protocol is de domeinnaam in Unicode optioneel, maar het is wel duidelijke informatie.";
		document.getElementById("details_status_values").textContent = "De waarde 'redemption period' is info over herstel. De waarde 'pending delete' is van toepassing in de laatste fase.";
		document.getElementById("details_event_expiration").textContent = "Datum en tijdstip van periodieke verlenging of stopzetting van de publicatie.";
		document.getElementById("details_event_recovery_until").textContent = proposed + "Tijdstip tot wanneer herstel nog mogelijk is. En in deze volgorde.";		
		document.getElementById("details_event_deletion").textContent = "Datum en tijdstip gepland voor volledige verwijdering. Er kan een laatste verwijderingsfase zijn.";
		document.getElementById("details_event_last_uploaded").textContent = "Datum en tijdstip van de RDAP-database-update in Zoeloe-tijd (Coordinated Universal Time - UTC).";
		document.getElementById("details_extensions_values").textContent = "'Eligibility': Hoe een domein voldoet aan een specifieke vereiste in een topleveldomeinzone.";
		document.getElementById("sponsor_role").textContent = "De domeinregistratie kan worden beheerd door een sponsor. Zie bijvoorbeeld france.fr.";
		document.getElementById("registrant_role").textContent = "De domeingebruiker die de daadwerkelijke of effectieve controle heeft voor domeinrecht in het land van vestiging.";
		document.getElementById("registrant_handle").textContent = 'De uitvoer van "hostingtool.nl" bevat onbedoeld informatie met "STE135427-TRAIP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Webidentificatienummer voor bedrijfsentiteiten en natuurlijke personen.";
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
		document.getElementById("registrar_abuse_role").textContent = "Informatie over hoe een derde partij contact kan opnemen met de registrar. Zie bijvoorbeeld fryslan.frl.";
		document.getElementById("registrar_abuse_telephone").textContent = "Een telefoonnummer moet beginnen met het type. Toegestaan zijn in ieder geval 'voice' en 'fax'.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is een web-route-beveiligingsvoorziening op het DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Een DNSSEC-algoritme vanaf versie 13 is up-to-date.";
		document.getElementById("name_servers_ip").textContent = "IP-waarden in een glue record alleen als de nameservers van de registrar niet worden gebruikt.";
		document.getElementById("br_zone").textContent = "Zone .br: De RDAP-gegevens zijn aangepast met nameservervalidatie.";
		document.getElementById("raw_data_next").textContent = "De rollen zijn hier gerangschikt op verantwoordelijkheid. 'None Specified' komt van deze tool. Voor communicatie in JSON is een leesbare XML-structuur vereist.";
	}
	else if (translation == 2)	{
		var proposed = 'Proposed - ';
		var address = "Shielding address data as with example.tel, results in messy data.";
		var accessible = 'With the proposed fields, this information would be more easily accessible.';
		document.getElementById("title").textContent = "Domain Information";
		document.getElementById("subtitle").textContent = "RDAP-v1-based modeling";
		document.getElementById("instruction").textContent = "Paste a domain name and press Enter.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Web Domains Explained";		
		document.getElementById("zone_role").textContent = "Top-level domains are assigned by ICANN to domain registries that manage the domains.";
		document.getElementById("zone_delegation_url").textContent = proposed + "Planned: Web ID searches can be performed on global RDAP servers.";
		document.getElementById("zone_registry_operator_trade_name").textContent = proposed;
		document.getElementById("zone_restrictions_url").textContent = proposed + "The use of domain data is subject to restrictions.";
		document.getElementById("zone_registry_trade_name").textContent = proposed;
		document.getElementById("zone_menu_url").textContent = proposed + 'A drop-down menu with explanations and details, for example via a subdomain "regmenu".';
		document.getElementById("zone_language_codes").textContent = proposed + "A zone can work with multiple commonly used languages.";
		document.getElementById("notices_role").textContent = accessible;
		document.getElementById("links_role").textContent = accessible;			
		document.getElementById("protocols_role").textContent = "The Registration Data Access Protocol (RDAP) is intended for global communication.";
		document.getElementById("protocols_registrar_iana_id").textContent = proposed + "Accreditation, for one or more generic top-level domains. And must be correct.";
		document.getElementById("protocols_registrar_complaint").textContent = proposed;
		document.getElementById("protocols_source_registry_trade_name").textContent = proposed + "A folder '/v1/' works for a version '/v2/', see icann.com.";
		document.getElementById("protocols_source_registrar").textContent = proposed;
		document.getElementById("protocols_status_explanation").textContent = proposed;
		document.getElementById("details_role").textContent = "A domain below TLD level is globally unique and can be freely chosen under certain rules.";
		document.getElementById("details_name_ascii").textContent = "Names containing special characters in ASCII strings use Punycode transcription.";
		document.getElementById("details_name_unicode").textContent = "In the RDAP protocol, the domain name in Unicode is optional, but it is clear information.";
		document.getElementById("details_status_values").textContent = "The 'redemption period' value is info about recovery. The 'pending delete' value applies in the final phase.";
		document.getElementById("details_event_expiration").textContent = "Date and time of periodic renewal or discontinuation of publication.";
		document.getElementById("details_event_recovery_until").textContent = proposed + "Time until which recovery is still possible. And in this order.";
		document.getElementById("details_event_deletion").textContent = "Date and time scheduled for complete deletion. A final deletion phase may exist.";
		document.getElementById("details_event_last_uploaded").textContent = "Date and time of RDAP database update in Zulu time (Coordinated Universal Time - UTC).";
		document.getElementById("details_extensions_values").textContent = "'Eligibility': How a domain fulfills a specific requirement in a top-level domain zone.";
		document.getElementById("sponsor_role").textContent = "The domain registration can be managed by a sponsor. See for example france.fr.";
		document.getElementById("registrant_role").textContent = "The domain user who has the actual or effective control for domain rights in the country of establishment.";
		document.getElementById("registrant_handle").textContent = 'The output from "hostingtool.nl" unintentionally contains information with "STE135427-TRAIP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Web Identification number for business entities and natural persons.";
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
		document.getElementById("registrar_abuse_role").textContent = "Information on how a third party can contact the registrar. See e.g. fryslan.frl.";
		document.getElementById("registrar_abuse_telephone").textContent = "A telephone number must begin with the type. Allowed are anyway 'voice' and 'fax'.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is a web route security feature on the DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "A DNSSEC algorithm starting from version 13 is up-to-date.";
		document.getElementById("name_servers_ip").textContent = "IP values in a glue record only if the registrar's name servers are not used.";
		document.getElementById("br_zone").textContent = "Zone .br: The RDAP data has been modified with name server validation.";
		document.getElementById("raw_data_next").textContent = "The roles here are arranged according to responsibility. 'None Specified' comes from this tool. Communication in JSON requires a readable XML structure.";
	}
	else if (translation == 3)	{
		var proposed = 'Vorgeschlagen - ';
		var address = "Das Abschirmen von Adressdaten wie bei example.tel, führt zu unordentlichen Daten.";
		var accessible = 'Mit den vorgeschlagenen Feldern wären diese Informationen leichter zugänglich.';
		document.getElementById("title").textContent = "Domäneninformation";
		document.getElementById("subtitle").textContent = "RDAP-v1-basierte Modellierung";
		document.getElementById("instruction").textContent = "Fügen Sie einen Domänennamen ein und drücken Sie die Eingabetaste.";
		document.getElementById("field").textContent = "Beschreibung";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Webdomänen erklärt";		
		document.getElementById("zone_role").textContent = "Top-Level-Domains werden von der ICANN an Domain-Registrare vergeben, die die Domains verwalten.";	
		document.getElementById("zone_delegation_url").textContent = proposed + "Geplant: Web-ID-Suchen können auf globalen RDAP-Servern durchgeführt werden.";
		document.getElementById("zone_registry_operator_trade_name").textContent = proposed;
		document.getElementById("zone_restrictions_url").textContent = proposed + "Die Nutzung der Domaindaten unterliegt Einschränkungen.";
		document.getElementById("zone_registry_trade_name").textContent = proposed;
		document.getElementById("zone_menu_url").textContent = proposed + 'Ein Dropdown-Menü mit Erläuterungen und Details, z. B. über eine Subdomain "regmenu".';
		document.getElementById("zone_language_codes").textContent = proposed + "Eine Zone kann mit mehreren häufig verwendeten Sprachen arbeiten.";
		document.getElementById("notices_role").textContent = accessible;
		document.getElementById("links_role").textContent = accessible;
		document.getElementById("protocols_role").textContent = "Das Registration Data Access Protocol (RDAP) ist für die weltweite Kommunikation vorgesehen.";
		document.getElementById("protocols_registrar_iana_id").textContent = proposed + "Akkreditierung für eine oder mehrere generische Top-Level-Domains. Und muss korrekt sein.";
		document.getElementById("protocols_registrar_complaint").textContent = proposed;
		document.getElementById("protocols_source_registry_trade_name").textContent = proposed + "Ein Ordner '/v1/' funktioniert für eine Version '/v2/', siehe icann.com.";
		document.getElementById("protocols_source_registrar").textContent = proposed;
		document.getElementById("protocols_status_explanation").textContent = proposed;
		document.getElementById("details_role").textContent = "Eine Domain unterhalb der TLD-Ebene ist weltweit eindeutig und kann unter bestimmten Regeln frei gewählt werden.";
		document.getElementById("details_name_ascii").textContent = "Namen, die Sonderzeichen in ASCII-Zeichenfolgen enthalten, verwenden die Punycode-Transkription.";
		document.getElementById("details_name_unicode").textContent = "Im RDAP-Protokoll ist der Domänenname in Unicode optional, stellt jedoch eine eindeutige Information dar.";
		document.getElementById("details_status_values").textContent = "Der Wert 'redemption period' ist Info zur Wiederherstellung. Der Wert 'pending delete' gilt in der Endphase.";
		document.getElementById("details_event_expiration").textContent = "Datum und Uhrzeit der periodischen Erneuerung oder Einstellung der Veröffentlichung.";
		document.getElementById("details_event_recovery_until").textContent = proposed + "Zeitpunkt, bis zu dem eine Wiederherstellung noch möglich ist. Und in dieser Reihenfolge.";
		document.getElementById("details_event_deletion").textContent = "Datum und Uhrzeit für die vollständige Löschung geplant. Es kann eine abschließende Löschphase geben.";
		document.getElementById("details_event_last_uploaded").textContent = "Datum und Uhrzeit der RDAP-Datenbankaktualisierung in Zulu-Zeit (Koordinierte Weltzeit – UTC).";
		document.getElementById("details_extensions_values").textContent = "'Eligibility': Wie eine Domäne eine bestimmte Anforderung in einer Top-Level-Domänenzone erfüllt.";
		document.getElementById("sponsor_role").textContent = "Die Domänenregistrierung kann von einem Sponsor verwaltet werden. Siehe beispielsweise france.fr.";
		document.getElementById("registrant_role").textContent = "Der Domänenbenutzer, der die tatsächliche oder effektive Kontrolle hat für Domainrechte im Wohnsitzland.";
		document.getElementById("registrant_handle").textContent = 'Die Ausgabe von "hostingtool.nl" enthält unbeabsichtigt Informationen mit "STE135427-TRAIP".';
		document.getElementById("registrant_web_id").textContent = proposed + "Web-Identifikationsnummer für Unternehmen und natürliche Personen.";
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
		document.getElementById("registrar_abuse_role").textContent = "Informationen darüber, wie Dritte den Registrar kontaktieren können. Siehe z. B. fryslan.frl.";
		document.getElementById("registrar_abuse_telephone").textContent = "Eine Telefonnummer muss mit dem Typ beginnen. Erlaubt sind grundsätzlich 'voice' und 'fax'.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC ist eine Sicherheitsfunktion für Webrouten im DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Ein DNSSEC-Algorithmus ab Version 13 ist auf dem neuesten Stand.";
		document.getElementById("name_servers_ip").textContent = "IP-Werte in einem Glue-Record nur, wenn die Nameserver des Registrars nicht verwendet werden.";
		document.getElementById("br_zone").textContent = "Zone .br: Die RDAP-Daten wurden mit der Nameserver-Validierung angepasst.";
		document.getElementById("raw_data_next").textContent = "Die Rollen sind hierbei nach Verantwortung verteilt. 'None Specified' stammt von diesem Tool. Die Kommunikation in JSON erfordert eine lesbare XML-Struktur.";
	}
	else if (translation == 4)	{
		var proposed = 'Proposé - ';
		var address = "Le blindage des données d'adresse comme avec example.tel, génère des données désordonnées.";
		var accessible = 'Avec les champs proposés, ces informations seraient plus facilement accessibles.';
		document.getElementById("title").textContent = "Informations sur le domaine";
		document.getElementById("subtitle").textContent = "Modélisation basée sur RDAP-v1";
		document.getElementById("instruction").textContent = "Collez un nom de domaine et appuyez sur Entrée.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Détail";
		document.getElementById("explanation").textContent = "Domaines Web expliqués";		
		document.getElementById("zone_role").textContent = "Les domaines de premier niveau sont attribués par l'ICANN aux registres de domaines qui gèrent les domaines.";
		document.getElementById("zone_delegation_url").textContent = proposed + "Prévu : Les recherches d’identifiant Web peuvent être effectuées sur des serveurs RDAP mondiaux.";
		document.getElementById("zone_registry_operator_trade_name").textContent = proposed;
		document.getElementById("zone_restrictions_url").textContent = proposed + "L'utilisation des données de domaine est soumise à des restrictions.";
		document.getElementById("zone_registry_trade_name").textContent = proposed;
		document.getElementById("zone_menu_url").textContent = proposed + 'Un menu déroulant avec explication et détails, par exemple via un sous-domaine "regmenu".';
		document.getElementById("notices_role").textContent = accessible;
		document.getElementById("links_role").textContent = accessible;
		document.getElementById("zone_language_codes").textContent = proposed + "Une zone peut fonctionner avec plusieurs langues couramment utilisées.";
		document.getElementById("protocols_role").textContent = "Le protocole d'accès aux données d'enregistrement (RDAP) est destiné à la communication mondiale.";
		document.getElementById("protocols_registrar_iana_id").textContent = proposed + "Accréditation, pour un ou plusieurs domaines génériques de premier niveau. Et doit être correct.";
		document.getElementById("protocols_registrar_complaint").textContent = proposed;
		document.getElementById("protocols_source_registry_trade_name").textContent = proposed + "Un dossier '/v1/' fonctionne pour une version '/v2/', voir icann.com.";
		document.getElementById("protocols_source_registrar").textContent = proposed;
		document.getElementById("protocols_status_explanation").textContent = proposed;
		document.getElementById("details_role").textContent = "Un domaine inférieur au niveau TLD est unique au monde et peut être choisi librement selon certaines règles.";
		document.getElementById("details_name_ascii").textContent = "Les noms contenant des caractères spéciaux dans les chaînes ASCII utilisent la transcription Punycode.";
		document.getElementById("details_name_unicode").textContent = "Dans le protocole RDAP, le nom de domaine en Unicode est facultatif, mais il s'agit d'une information claire.";
		document.getElementById("details_status_values").textContent = "La valeur 'redemption period' est infos de récupération. La valeur 'pending delete' s'applique dans la phase finale.";
		document.getElementById("details_event_expiration").textContent = "Date et heure du renouvellement périodique ou de l'arrêt de la publication.";
		document.getElementById("details_event_recovery_until").textContent = proposed + "Délai jusqu'à lequel la récupération est encore possible. Et dans cet ordre.";
		document.getElementById("details_event_deletion").textContent = "Date et heure prévues pour la suppression complète. Une phase de suppression finale peut exister.";
		document.getElementById("details_event_last_uploaded").textContent = "Date et heure de mise à jour de la base de données RDAP en heure Zulu (Temps Universel Coordonné - UTC).";
		document.getElementById("details_extensions_values").textContent = "'Eligibility' : comment un domaine répond à une exigence spécifique dans une zone de domaine de premier niveau.";
		document.getElementById("sponsor_role").textContent = "L'enregistrement du domaine peut être géré par un sponsor. Voir par exemple france.fr.";
		document.getElementById("registrant_role").textContent = "L'utilisateur du domaine qui a le contrôle réel ou effectif pour les droits de domaine dans le pays de résidence.";
		document.getElementById("registrant_handle").textContent = 'La sortie de "hostingtool.nl" contient involontairement des informations avec "STE135427-TRAIP"';
		document.getElementById("registrant_web_id").textContent = proposed + "Numéro d’identification Web pour les entités commerciales et les personnes physiques.";
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
		document.getElementById("registrar_abuse_role").textContent = "Informations sur la manière dont un tiers peut contacter le registraire. Voir par exemple fryslan.frl.";
		document.getElementById("registrar_abuse_telephone").textContent = "Un numéro de téléphone doit commencer par le type. Sont autorisés de toute façon 'voice' et 'fax'.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC est une fonctionnalité de sécurité de route Web sur le DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Un algorithme DNSSEC à partir de la version 13 est à jour.";
		document.getElementById("name_servers_ip").textContent = "Valeurs IP dans un enregistrement de colle uniquement si les serveurs de noms du registraire ne sont pas utilisés.";
		document.getElementById("br_zone").textContent = "Zone .br: Les données RDAP ont été ajustées avec la validation du serveur de noms.";
		document.getElementById("raw_data_next").textContent = "Les rôles ici sont organisés en fonction des responsabilités. 'None Specified' provient de cet outil. La communication en JSON nécessite une structure XML lisible.";
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
$developmentpath = '/home/admin/whois_file/';
$zonefile = 'data_zones.xml';
$domainfile = 'data_domains.xml';
if (!empty($_GET['domain']))	{
	$viewdomain = $_GET['domain'];
	$viewdomain = mb_strtolower($viewdomain);
	$viewdomain = str_replace('http://','', $viewdomain);
	$viewdomain = str_replace('https://','', $viewdomain);
	if (substr_count($domain, '.') > 1)	{
		$viewdomain = str_replace('www.','', $viewdomain);
	}
	$strpos = mb_strpos($viewdomain, '/');
	if ($strpos)	{
		$viewdomain = mb_substr($viewdomain, 0, $strpos);
	}
	$strpos = mb_strpos($viewdomain, ':');
	if ($strpos)	{
		$viewdomain = mb_substr($viewdomain, 0, $strpos);
	}
}
else	{
	$viewdomain = 'hostingtool.nl';
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
else	{
	$viewlanguage = $_GET["language"];
}
$server_url = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
$server_url .= '://'. $_SERVER['HTTP_HOST'];
$server_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);	
$server_url = dirname($server_url);
$rdap_url = $server_url.'/compose_domain/index.php?batch=0&domain='.$viewdomain;
if (@get_headers($rdap_url))	{ // the application to compose for zone data
	$xml1 = simplexml_load_file($rdap_url, "SimpleXMLElement", LIBXML_NOCDATA) or die("An entered domain could not be read.");
}
if	(is_null($xml1))	{
	$reopen = $server_url.'/modeling_domain/index.php?batch=0&domain=hostingtool.nl';
	sc_redir($reopen);
}
$html_text = '<body onload=SwitchTranslation('.$viewlanguage.')><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem; table-layout: fixed; width:1375px">
<tr><th style="width:325px"></th><th style="width:300px"></th><th style="width:750px"></th></tr>';
$html_text .= '<tr style="font-size: .8rem"><td id="title" style="font-size: 1.3rem;color:blue;font-weight:bold"></td><td colspan="2" id="instruction"></td></tr>';
$html_text .= '<tr style="font-size: .8rem"><td id="subtitle" style="font-size: 1.0rem;color:blue;font-weight:bold"></td><td><form action='.htmlentities($_SERVER['PHP_SELF']).' method="get">
	<input type="hidden" id="language" name="language" value='.$viewlanguage.'>	
	<input type="text" style="width:90%" id="domain" name="domain" value='.$viewdomain.'></form></td><td>
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(0)">None</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(1)">nl_NL</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(2)">en_US</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(3)">de_DE</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(4)">fr_FR</button> 
	<a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_email" target="_blank">modeling email</a> - <a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_menu" target="_blank">modeling menu</a> - <a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap.hostingtool.nl/issues" target="_blank">reporting of issues</a> - <a style="font-size: 0.9rem" href="https://janwillemstegink.nl/" target="_blank">janwillemstegink.nl</a></td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr style="font-size:1.05rem;font-weight:bold"><td id="field"></td><td id="value"><td id="explanation"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(10)">Zone Information +/-</button></td><td><b>'.$item->zone->top_level_domain.'</b></td><td id="zone_role"></td></tr>';
	$html_text .= '<tr id="101" style="display:none"><td>zone delegation_url</td><td><a href='.$item->zone->delegation_url.' target="_blank">Top-Level Domain Delegation</a></td><td id="zone_delegation_url"></td></tr>';
	$html_text .= '<tr id="102" style="display:none"><td>zone registry_operator_trade_name</td><td>'.$item->zone->registry_operator_trade_name.'</td><td id="zone_registry_operator_trade_name"></td></tr>';
	if (strlen($item->zone->restrictions_url))	{
		$html_text .= '<tr id="103" style="display:none"><td>zone restrictions_url</td><td><a href='.$item->zone->restrictions_url.' target="_blank">Top-Level Domain Restrictions</a></td><td id="zone_restrictions_url"></td></tr>';
	}
	else	{
		$html_text .= '<tr id="103" style="display:none"><td>zone restrictions_url</td><td></td><td id="zone_restrictions_url"></td></tr>';
	}
	if (strlen($item->zone->menu_url))	{
		$html_text .= '<tr id="104" style="display:none"><td>zone menu_url</td><td><a href='.$item->zone->menu_url.' target="_blank">Top-Level Domain Menu</a></td><td id="zone_menu_url"></td></tr>';
	}
	else	{
		$html_text .= '<tr id="104" style="display:none"><td>zone menu_url</td><td></td><td id="zone_menu_url"></td></tr>';	
	}
	$html_text .= '<tr id="105" style="display:none"><td>zone registry_trade_name</td><td>'.$item->zone->registry_trade_name.'</td><td id="zone_registry_trade_name"></td></tr>';
	$html_text .= '<tr id="106" style="display:none"><td>zone language_codes</td><td>'.$item->zone->language_codes.'</td><td id="zone_language_codes"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(11)">Notice0 +/-</button> <button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(12)">Notice1 +/-</button> <button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(13)">Notice2 +/-</button> <button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(14)">Notice3 +/-</button></td><td></td><td id="notices_role"></td></tr>';
	$html_text .= '<tr id="111" style="display:none;vertical-align:top"><td>zone notice_0_title</td><td>'.$item->zone->notice_0_title.'</td><td></td></tr>';
	$html_text .= '<tr id="112" style="display:none;vertical-align:top"><td>zone notice_0_description_0</td><td>'.$item->zone->notice_0_description_0.'</td><td></td></tr>';
	$html_text .= '<tr id="113" style="display:none;vertical-align:top"><td>zone notice_0_description_1</td><td>'.$item->zone->notice_0_description_1.'</td><td></td></tr>';
	$html_text .= '<tr id="114" style="display:none;vertical-align:top"><td>zone notice_0_links_0_href</td><td>'.$item->zone->notice_0_links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="115" style="display:none;vertical-align:top"><td>zone notice_0_links_0_type</td><td>'.$item->zone->notice_0_links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr id="121" style="display:none;vertical-align:top"><td>zone notice_1_title</td><td>'.$item->zone->notice_1_title.'</td><td></td></tr>';
	$html_text .= '<tr id="122" style="display:none;vertical-align:top"><td>zone notice_1_description_0</td><td>'.$item->zone->notice_1_description_0.'</td><td></td></tr>';
	$html_text .= '<tr id="123" style="display:none;vertical-align:top"><td>zone notice_1_description_1</td><td>'.$item->zone->notice_1_description_1.'</td><td></td></tr>';
	$html_text .= '<tr id="124" style="display:none;vertical-align:top"><td>zone notice_1_links_0_href</td><td>'.$item->zone->notice_1_links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="125" style="display:none;vertical-align:top"><td>zone notice_1_links_0_type</td><td>'.$item->zone->notice_1_links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr id="131" style="display:none;vertical-align:top"><td>zone notice_2_title</td><td>'.$item->zone->notice_2_title.'</td><td></td></tr>';
	$html_text .= '<tr id="132" style="display:none;vertical-align:top"><td>zone notice_2_description_0</td><td>'.$item->zone->notice_2_description_0.'</td><td></td></tr>';
	$html_text .= '<tr id="133" style="display:none;vertical-align:top"><td>zone notice_2_description_1</td><td>'.$item->zone->notice_2_description_1.'</td><td></td></tr>';
	$html_text .= '<tr id="134" style="display:none;vertical-align:top"><td>zone notice_2_links_0_href</td><td>'.$item->zone->notice_2_links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="135" style="display:none;vertical-align:top"><td>zone notice_2_links_0_type</td><td>'.$item->zone->notice_2_links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr id="141" style="display:none;vertical-align:top"><td>zone notice_3_title</td><td>'.$item->zone->notice_3_title.'</td><td></td></tr>';
	$html_text .= '<tr id="142" style="display:none;vertical-align:top"><td>zone notice_3_description_0</td><td>'.$item->zone->notice_3_description_0.'</td><td></td></tr>';
	$html_text .= '<tr id="143" style="display:none;vertical-align:top"><td>zone notice_3_description_1</td><td>'.$item->zone->notice_3_description_1.'</td><td></td></tr>';
	$html_text .= '<tr id="144" style="display:none;vertical-align:top"><td>zone notice_3_links_0_href</td><td>'.$item->zone->notice_3_links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="145" style="display:none;vertical-align:top"><td>zone notice_3_links_0_type</td><td>'.$item->zone->notice_3_links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(20)">Links0 +/-</button> <button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(21)">Links1 +/-</button> <button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(22)">Links2 +/-</button> <button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(23)">Links3 +/-</button></td><td></td><td id="links_role"></td></tr>';
	$html_text .= '<tr id="201" style="display:none;vertical-align:top"><td>zone links_0_value</td><td>'.$item->view->links_0_value.'</td><td></td></tr>';
	$html_text .= '<tr id="202" style="display:none;vertical-align:top"><td>zone links_0_related</td><td>'.$item->view->links_0_related.'</td><td></td></tr>';
	$html_text .= '<tr id="203" style="display:none;vertical-align:top"><td>zone links_0_href</td><td>'.$item->view->links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="204" style="display:none;vertical-align:top"><td>zone links_0_href_lang</td><td>'.$item->view->links_0_href_lang.'</td><td></td></tr>';
	$html_text .= '<tr id="205" style="display:none;vertical-align:top"><td>zone links_0_title</td><td>'.$item->view->links_0_title.'</td><td></td></tr>';
	$html_text .= '<tr id="206" style="display:none;vertical-align:top"><td>zone links_0_media</td><td>'.$item->view->links_0_media.'</td><td></td></tr>';
	$html_text .= '<tr id="207" style="display:none;vertical-align:top"><td>zone links_0_type</td><td>'.$item->view->links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr id="211" style="display:none;vertical-align:top"><td>zone links_1_value</td><td>'.$item->view->links_1_value.'</td><td></td></tr>';
	$html_text .= '<tr id="212" style="display:none;vertical-align:top"><td>zone links_1_related</td><td>'.$item->view->links_1_related.'</td><td></td></tr>';
	$html_text .= '<tr id="213" style="display:none;vertical-align:top"><td>zone links_1_href</td><td>'.$item->view->links_1_href.'</td><td></td></tr>';
	$html_text .= '<tr id="214" style="display:none;vertical-align:top"><td>zone links_1_href_lang</td><td>'.$item->view->links_1_href_lang.'</td><td></td></tr>';
	$html_text .= '<tr id="215" style="display:none;vertical-align:top"><td>zone links_1_title</td><td>'.$item->view->links_1_title.'</td><td></td></tr>';
	$html_text .= '<tr id="216" style="display:none;vertical-align:top"><td>zone links_1_media</td><td>'.$item->view->links_1_media.'</td><td></td></tr>';
	$html_text .= '<tr id="217" style="display:none;vertical-align:top"><td>zone links_1_type</td><td>'.$item->view->links_1_type.'</td><td></td></tr>';
	$html_text .= '<tr id="221" style="display:none;vertical-align:top"><td>zone links_2_value</td><td>'.$item->view->links_2_value.'</td><td></td></tr>';
	$html_text .= '<tr id="222" style="display:none;vertical-align:top"><td>zone links_2_related</td><td>'.$item->view->links_2_related.'</td><td></td></tr>';
	$html_text .= '<tr id="223" style="display:none;vertical-align:top"><td>zone links_2_href</td><td>'.$item->view->links_2_href.'</td><td></td></tr>';
	$html_text .= '<tr id="224" style="display:none;vertical-align:top"><td>zone links_2_href_lang</td><td>'.$item->view->links_2_href_lang.'</td><td></td></tr>';
	$html_text .= '<tr id="225" style="display:none;vertical-align:top"><td>zone links_2_title</td><td>'.$item->view->links_2_title.'</td><td></td></tr>';
	$html_text .= '<tr id="226" style="display:none;vertical-align:top"><td>zone links_2_media</td><td>'.$item->view->links_2_media.'</td><td></td></tr>';
	$html_text .= '<tr id="227" style="display:none;vertical-align:top"><td>zone links_2_type</td><td>'.$item->view->links_2_type.'</td><td></td></tr>';
	$html_text .= '<tr id="231" style="display:none;vertical-align:top"><td>zone links_3_value</td><td>'.$item->view->links_3_value.'</td><td></td></tr>';
	$html_text .= '<tr id="232" style="display:none;vertical-align:top"><td>zone links_3_related</td><td>'.$item->view->links_3_related.'</td><td></td></tr>';
	$html_text .= '<tr id="233" style="display:none;vertical-align:top"><td>zone links_3_href</td><td>'.$item->view->links_3_href.'</td><td></td></tr>';
	$html_text .= '<tr id="234" style="display:none;vertical-align:top"><td>zone links_3_href_lang</td><td>'.$item->view->links_3_href_lang.'</td><td></td></tr>';
	$html_text .= '<tr id="235" style="display:none;vertical-align:top"><td>zone links_3_title</td><td>'.$item->view->links_3_title.'</td><td></td></tr>';
	$html_text .= '<tr id="236" style="display:none;vertical-align:top"><td>zone links_3_media</td><td>'.$item->view->links_3_media.'</td><td></td></tr>';
	$html_text .= '<tr id="237" style="display:none;vertical-align:top"><td>zone links_3_type</td><td>'.$item->view->links_3_type.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(29)">Protocol Information +/-</button></td><td></td><td id="protocols_role"></td></tr>';
	$html_text .= '<tr id="291" style="display:none"><td>protocols object_conformance</td><td>'.$item->protocols->object_conformance.'</td><td></td></tr>';
	$html_text .= '<tr id="292" style="display:none"><td>protocols object_class_name</td><td>'.$item->protocols->object_class_name.'</td><td></td></tr>';
	if (strlen($item->protocols->registrar_iana_id))	{
		$html_text .= '<tr id="293" style="display:none"><td>protocols registrar_iana_id</td><td>'.$item->protocols->registrar_iana_id.'</td><td id="protocols_registrar_iana_id"></td></tr>';
	}
	else	{
		$html_text .= '<tr id="293" style="display:none"><td>protocols registrar_iana_id</td><td>none</td><td id="protocols_registrar_iana_id"></td></tr>';	
	}	
	if (strlen($item->protocols->registrar_complaint))	{
		$html_text .= '<tr id="294" style="display:none"><td>protocols registrar_complaint</td><td><a href='.$item->protocols->registrar_complaint.' target="_blank">icann.org/wicf</a></td><td id="protocols_registrar_complaint"></td></tr>';
	}
	else	{
		$html_text .= '<tr id="294" style="display:none"><td>protocols registrar_complaint</td><td>none</td><td id="protocols_registrar_complaint"></td></tr>';	
	}
	if (strlen($item->protocols->source_registry))	{
		$source_registry = str_replace('https://', '', $item->protocols->source_registry);
		$validation_registry = 'https://validator.rdap.org/?url=https://'.$source_registry.'&response-type=domain&server-type=gtld-registry&errors-only=1';
		$html_text .= '<tr><td>protocols source_registry</td><td><a href='.$item->protocols->source_registry.' target="_blank">registry file</a> - <a href="' . htmlspecialchars($validation_registry, ENT_QUOTES, "UTF-8") . '" target="_blank">validator.rdap.org</a></td><td id="protocols_source_registry_trade_name"></td></tr>';
	}
	else	{
		$html_text .= '<tr><td>protocols source_registry</td><td>none</td><td id="protocols_source_registry_trade_name"></td></tr>';	
	}
	if (strlen($item->protocols->source_registrar))	{
		$source_registrar = str_replace('https://', '', $item->protocols->source_registrar);
		$validation_registrar = 'https://validator.rdap.org/?url=https://'.$source_registrar.'&response-type=domain&server-type=gtld-registrar&errors-only=1';
		$html_text .= '<tr id="295" style="display:none"><td>protocols source_registrar</td><td><a href='.$item->protocols->source_registrar.' target="_blank">registrar file</a> - <a href="' . htmlspecialchars($validation_registrar, ENT_QUOTES, "UTF-8") . '" target="_blank">validator.rdap.org</a></td><td id="protocols_source_registrar"></td></tr>';
	}
	else	{
		$html_text .= '<tr id="295" style="display:none"><td>protocols source_registrar (<a style="font-size: 0.9rem" href="https://rdap.cscglobal.com/dbs/rdap-api/v1/domain/icann.com" target="_blank">e.g. icann.com</a> <a style="font-size: 0.9rem" href="https://rdap.metaregistrar.com/domain/fryslan.frl" target="_blank">fryslan.frl</a>)</td><td>none</td><td id="protocols_source_registrar"></td></tr>';
	}
	if (strlen($item->protocols->status_explanation))	{
		$html_text .= '<tr id="296" style="display:none"><td>protocols status_explanation</td><td><a href='.$item->protocols->status_explanation.' target="_blank">icann.org/epp</a></td><td id="protocols_status_explanation"></td></tr>';
	}
	else	{
		$html_text .= '<tr id="296" style="display:none"><td>protocols status_explanation</td><td>none</td><td id="protocols_status_explanation"></td></tr>';	
	}
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(30)">Details +/-</button></td><td>'.$viewdomain.'</td><td id="details_role"></td></tr>';
	$html_text .= '<tr id="301" style="display:none"><td>details handle</td><td>'.$item->details->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="302" style="display:none"><td>details name_ascii</td><td>'.$item->details->name_ascii.'</td><td id="details_name_ascii"></td></tr>';
	$html_text .= '<tr id="303" style="display:none"><td>details name_unicode</td><td>'.$item->details->name_unicode.'</td><td id="details_name_unicode"></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>details status_values</td><td>'.$item->details->status_values.'</td><td id="details_status_values"></td></tr>';
	$html_text .= '<tr id="304" style="display:none"><td>details event_registration</td><td>'.$item->details->event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="305" style="display:none"><td>details event_last_transferred</td><td>'.$item->details->event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="306" style="display:none"><td>details event_last_changed</td><td>'.$item->details->event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr><td>details event_expiration</td><td>'.$item->details->event_expiration.'</td><td id="details_event_expiration"></td></tr>';
	$html_text .= '<tr id="307" style="display:none"><td>details event_recovery_until</td><td>'.$item->details->event_recovery_until.'</td><td id="details_event_recovery_until"></td></tr>';
	$html_text .= '<tr id="308" style="display:none"><td>details event_deletion</td><td>'.$item->details->event_deletion.'</td><td id="details_event_deletion"></td></tr>';
	$html_text .= '<tr id="309" style="display:none"><td>details event_last_uploaded</td><td>'.$item->details->event_last_uploaded.'</td><td id="details_event_last_uploaded"></td></tr>';
	$html_text .= '<tr id="3010" style="display:none;vertical-align:top"><td>details extensions_values</td><td>'.$item->details->extensions_values.'</td><td id="details_extensions_values"></td></tr>';
	$html_text .= '<tr id="3011" style="display:none;vertical-align:top"><td>details remark_values</td><td>'.$item->details->remark_values.'</td><td></td></tr>';
	$sponsor_applicable = (strlen($item->sponsor->organization_name) or strlen($item->sponsor->presented_name)) ? 'Sponsor Data Exists' : 'No Sponsor Data';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(39)">Sponsor +/-</button></td><td>'.$sponsor_applicable.'</td><td id="sponsor_role"></td></tr>';
	$html_text .= '<tr id="391" style="display:none"><td>sponsor handle</td><td>'.$item->sponsor->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="392" style="display:none"><td>sponsor web_id</td><td>'.$item->sponsor->web_id.'</td><td id="sponsor_web_id"></td></tr>';
	$html_text .= '<tr id="393" style="display:none"><td>sponsor organization_type</td><td>'.$item->sponsor->organization_type.'</td><td></td></tr>';
	$html_text .= '<tr id="394" style="display:none"><td>sponsor organization_name</td><td>'.$item->sponsor->organization_name.'</td><td></td></tr>';
	$html_text .= '<tr id="395" style="display:none"><td>sponsor presented_name</td><td>'.$item->sponsor->presented_name.'</td><td id="sponsor_recover"></td></tr>';
	$html_text .= '<tr id="396" style="display:none"><td>sponsor kind</td><td>'.$item->sponsor->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="397" style="display:none"><td>sponsor name</td><td>'.$item->sponsor->name.'</td><td></td></tr>';
	$html_text .= '<tr id="398" style="display:none"><td>sponsor email</td><td>'.$item->sponsor->email.'</td><td></td></tr>';
	$html_text .= '<tr id="399" style="display:none"><td>sponsor telephone</td><td>'.$item->sponsor->telephone.'</td><td></td></tr>';
	$html_text .= '<tr id="3910" style="display:none"><td>sponsor country_code</td><td>'.$item->sponsor->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="3911" style="display:none"><td>sponsor street</td><td>'.$item->sponsor->street.'</td><td></td></tr>';
	$html_text .= '<tr id="3912" style="display:none"><td>sponsor city</td><td>'.$item->sponsor->city.'</td><td></td></tr>';
	$html_text .= '<tr id="3913" style="display:none"><td>sponsor state_province</td><td>'.$item->sponsor->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="3914" style="display:none"><td>sponsor postal_code</td><td>'.$item->sponsor->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="3915" style="display:none"><td>sponsor country_name</td><td>'.$item->sponsor->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="3916" style="display:none"><td>sponsor language_pref_1</td><td>'.$item->sponsor->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="3917" style="display:none"><td>sponsor language_pref_2</td><td>'.$item->sponsor->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="3918" style="display:none"><td>sponsor shielding</td><td>'.$item->sponsor->shielding.'</td><td></td></tr>';
	$html_text .= '<tr id="3919" style="display:none;vertical-align:top"><td>sponsor status_values</td><td>'.$item->sponsor->status_values.'</td><td></td></tr>';
	$html_text .= '<tr id="3920" style="display:none"><td>sponsor event_registration</td><td>'.$item->sponsor->event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="3921" style="display:none"><td>sponsor event_last_transferred</td><td>'.$item->sponsor->event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="3922" style="display:none"><td>sponsor event_last_changed</td><td>'.$item->sponsor->event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr id="3923" style="display:none"><td>sponsor event_expiration</td><td>'.$item->sponsor->event_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="3924" style="display:none"><td>sponsor event_deletion</td><td>'.$item->sponsor->event_deletion.'</td><td></td></tr>';
	$html_text .= '<tr id="3925" style="display:none"><td>sponsor event_last_uploaded</td><td>'.$item->sponsor->event_last_uploaded.'</td><td></td></tr>';
	$html_text .= '<tr id="3926" style="display:none"><td>sponsor event_verification_received</td><td>'.$item->sponsor->event_verification_received.'</td><td id="sponsor_event_verification_received"></td></tr>';
	$html_text .= '<tr id="3927" style="display:none"><td>sponsor event_verification_set</td><td>'.$item->sponsor->event_verification_set.'</td><td id="sponsor_event_verification_set"></td></tr>';
	$html_text .= '<tr id="3928" style="display:none;vertical-align:top"><td>sponsor properties</td><td>'.$item->sponsor->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="3929" style="display:none;vertical-align:top"><td>sponsor remark_values</td><td>'.$item->sponsor->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(40)">Registrant +/-</button></td><td></td><td id="registrant_role"></td></tr>';
	$html_text .= '<tr id="401" style="display:none"><td>registrant handle</td><td>'.$item->registrant->handle.'</td><td id="registrant_handle"></td></tr>';
	$html_text .= '<tr id="402" style="display:none"><td>registrant web_id</td><td>'.$item->registrant->web_id.'</td><td id="registrant_web_id"></td></tr>';
	$html_text .= '<tr id="403" style="display:none"><td>registrant organization_type</td><td>'.$item->registrant->organization_type.'</td><td></td></tr>';
	$html_text .= '<tr><td>registrant organization_name</td><td>'.$item->registrant->organization_name.'</td><td id="registrant_organization_name"></td></tr>';
	$html_text .= '<tr><td>registrant presented_name (RDAP: "fn"/full name)</td><td>'.$item->registrant->presented_name.'</td><td id="registrant_presented_name"></td></tr>';
	$html_text .= '<tr id="404" style="display:none"><td>registrant kind</td><td>'.$item->registrant->kind.'</td><td id="registrant_kind"></td></tr>';
	$html_text .= '<tr id="405" style="display:none"><td>registrant name</td><td>'.$item->registrant->name.'</td><td id="registrant_name"></td></tr>';
	$html_text .= '<tr id="406" style="display:none"><td>registrant email</td><td>'.$item->registrant->email.'</td><td></td></tr>';
	$html_text .= '<tr id="407" style="display:none"><td>registrant telephone</td><td>'.$item->registrant->telephone.'</td><td></td></tr>';
	$html_text .= '<tr><td>registrant country_code (<a style="font-size: 0.9rem" href="https://icann-hamster.nl/ham/soac/ccnso/techday/icann80/2.%20RDAP%20Conformance%20Tool%20-%20Tech%20Day.pdf" target="_blank">"cc" parameter</a>)</td><td>'.$item->registrant->country_code.'</td><td id="registrant_country_code"></td></tr>';
	$html_text .= '<tr id="408" style="display:none"><td>registrant street</td><td>'.$item->registrant->street.'</td><td id="registrant_street"></td></tr>';
	$html_text .= '<tr id="409" style="display:none"><td>registrant city</td><td>'.$item->registrant->city.'</td><td id="registrant_city"></td></tr>';
	$html_text .= '<tr id="4010" style="display:none"><td>registrant state_province</td><td>'.$item->registrant->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="4011" style="display:none"><td>registrant postal_code</td><td>'.$item->registrant->postal_code.'</td><td id="registrant_postal_code"></td></tr>';
	$html_text .= '<tr id="4012" style="display:none"><td>registrant country_name</td><td>'.$item->registrant->country_name.'</td><td id="registrant_country_name"></td></tr>';
	$html_text .= '<tr id="4013" style="display:none"><td>registrant language_pref_1</td><td>'.$item->registrant->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4014" style="display:none"><td>registrant language_pref_2</td><td>'.$item->registrant->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4015" style="display:none"><td>registrant shielding</td><td>'.$item->registrant->shielding.'</td><td id="registrant_shielding"></td></tr>';
	$html_text .= '<tr id="4016" style="display:none;vertical-align:top"><td>registrant status_values</td><td>'.$item->registrant->status_values.'</td><td></td></tr>';
	$html_text .= '<tr id="4017" style="display:none"><td>registrant event_registration</td><td>'.$item->registrant->event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="4018" style="display:none"><td>registrant event_last_transferred</td><td>'.$item->registrant->event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="4019" style="display:none"><td>registrant event_last_changed</td><td>'.$item->registrant->event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr id="4020" style="display:none"><td>registrant event_expiration</td><td>'.$item->registrant->event_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="4021" style="display:none"><td>registrant event_deletion</td><td>'.$item->registrant->event_deletion.'</td><td id="registrant_event_deletion"></td></tr>';
	$html_text .= '<tr id="4022" style="display:none"><td>registrant event_last_uploaded</td><td>'.$item->registrant->event_last_uploaded.'</td><td id="registrant_event_last_uploaded"></td></tr>';
	$html_text .= '<tr><td>registrant event_verification_received</td><td>'.$item->registrant->event_verification_received.'</td><td id="registrant_event_verification_received"></td></tr>';
	$html_text .= '<tr><td>registrant event_verification_set</td><td>'.$item->registrant->event_verification_set.'</td><td id="registrant_event_verification_set"></td></tr>';
	$html_text .= '<tr id="4023" style="display:none;vertical-align:top"><td>registrant properties</td><td>'.$item->registrant->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="4024" style="display:none;vertical-align:top"><td>registrant remark_values</td><td>'.$item->registrant->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(41)">Administrative / Decision +/-</button></td><td></td><td id="administrative_role"></td></tr>';
	$html_text .= '<tr id="411" style="display:none"><td>administrative handle</td><td>'.$item->administrative->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="412" style="display:none"><td>administrative web_id</td><td>'.$item->administrative->web_id.'</td><td id="administrative_web_id"></td></tr>';
	$html_text .= '<tr id="413" style="display:none"><td>administrative organization_type</td><td>'.$item->administrative->organization_type.'</td><td></td></tr>';
	$html_text .= '<tr id="414" style="display:none"><td>administrative organization_name</td><td>'.$item->administrative->organization_name.'</td><td></td></tr>';
	$html_text .= '<tr id="415" style="display:none"><td>administrative presented_name</td><td>'.$item->administrative->presented_name.'</td><td></td></tr>';
	$html_text .= '<tr id="416" style="display:none"><td>administrative kind</td><td>'.$item->administrative->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="417" style="display:none"><td>administrative name</td><td>'.$item->administrative->name.'</td><td></td></tr>';
	$html_text .= '<tr><td>administrative email</td><td>'.$item->administrative->email.'</td><td></td></tr>';
	$html_text .= '<tr id="418" style="display:none"><td>administrative telephone</td><td>'.$item->administrative->telephone.'</td><td></td></tr>';
	$html_text .= '<tr id="419" style="display:none"><td>administrative country_code</td><td>'.$item->administrative->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4110" style="display:none"><td>administrative street</td><td>'.$item->administrative->street.'</td><td></td></tr>';
	$html_text .= '<tr id="4111" style="display:none"><td>administrative city</td><td>'.$item->administrative->city.'</td><td></td></tr>';
	$html_text .= '<tr id="4112" style="display:none"><td>administrative state_province</td><td>'.$item->administrative->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="4113" style="display:none"><td>administrative postal_code</td><td>'.$item->administrative->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4114" style="display:none"><td>administrative country_name</td><td>'.$item->administrative->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="4115" style="display:none"><td>administrative language_pref_1</td><td>'.$item->administrative->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4116" style="display:none"><td>administrative language_pref_2</td><td>'.$item->administrative->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4117" style="display:none"><td>administrative shielding</td><td>'.$item->administrative->shielding.'</td><td id="administrative_shielding"></td></tr>';
	$html_text .= '<tr id="4118" style="display:none;vertical-align:top"><td>administrative properties</td><td>'.$item->administrative->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="4119" style="display:none;vertical-align:top"><td>administrative remark_values</td><td>'.$item->administrative->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(42)">Technical / Onsite +/-</button></td><td></td><td id="technical_role"></td></tr>';
	$html_text .= '<tr id="421" style="display:none"><td>technical handle</td><td>'.$item->technical->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="422" style="display:none"><td>technical web_id</td><td>'.$item->technical->web_id.'</td><td id="technical_web_id"></td></tr>';
	$html_text .= '<tr id="423" style="display:none"><td>technical organization_type</td><td>'.$item->technical->organization_type.'</td><td></td></tr>';
	$html_text .= '<tr id="424" style="display:none"><td>technical organization_name</td><td>'.$item->technical->organization_name.'</td><td></td></tr>';
	$html_text .= '<tr id="425" style="display:none"><td>technical presented_name</td><td>'.$item->technical->presented_name.'</td><td></td></tr>';
	$html_text .= '<tr id="426" style="display:none"><td>technical kind</td><td>'.$item->technical->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="427" style="display:none"><td>technical name</td><td>'.$item->technical->name.'</td><td></td></tr>';
	$html_text .= '<tr><td>technical email</td><td>'.$item->technical->email.'</td><td></td></tr>';
	$html_text .= '<tr id="428" style="display:none"><td>technical telephone</td><td>'.$item->technical->telephone.'</td><td></td></tr>';
	$html_text .= '<tr id="429" style="display:none"><td>technical country_code</td><td>'.$item->technical->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4210" style="display:none"><td>technical street</td><td>'.$item->technical->street.'</td><td></td></tr>';
	$html_text .= '<tr id="4211" style="display:none"><td>technical city</td><td>'.$item->technical->city.'</td><td></td></tr>';
	$html_text .= '<tr id="4212" style="display:none"><td>technical state_province</td><td>'.$item->technical->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="4213" style="display:none"><td>technical postal_code</td><td>'.$item->technical->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4214" style="display:none"><td>technical country_name</td><td>'.$item->technical->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="4215" style="display:none"><td>technical language_pref_1</td><td>'.$item->technical->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4216" style="display:none"><td>technical language_pref_2</td><td>'.$item->technical->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4217" style="display:none"><td>technical shielding</td><td>'.$item->technical->shielding.'</td><td id="technical_shielding"></td></tr>';
	$html_text .= '<tr id="4218" style="display:none;vertical-align:top"><td>technical properties</td><td>'.$item->technical->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="4219" style="display:none;vertical-align:top"><td>technical remark_values</td><td>'.$item->technical->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(43)">Billing +/-</button></td><td></td><td id="billing_role"></td></tr>';
	$html_text .= '<tr id="431" style="display:none"><td>billing handle</td><td>'.$item->billing->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="432" style="display:none"><td>billing web_id</td><td>'.$item->billing->web_id.'</td><td></td></tr>';
	$html_text .= '<tr id="433" style="display:none"><td>billing organization_type</td><td>'.$item->billing->organization_type.'</td><td></td></tr>';
	$html_text .= '<tr id="434" style="display:none"><td>billing organization_name</td><td>'.$item->billing->organization_name.'</td><td></td></tr>';
	$html_text .= '<tr id="435" style="display:none"><td>billing presented_name</td><td>'.$item->billing->presented_name.'</td><td></td></tr>';
	$html_text .= '<tr id="436" style="display:none"><td>billing kind</td><td>'.$item->billing->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="437" style="display:none"><td>billing name</td><td>'.$item->billing->name.'</td><td></td></tr>';
	$html_text .= '<tr id="438" style="display:none"><td>billing email</td><td>'.$item->billing->email.'</td><td></td></tr>';
	$html_text .= '<tr id="439" style="display:none"><td>billing telephone</td><td>'.$item->billing->telephone.'</td><td></td></tr>';
	$html_text .= '<tr id="4310" style="display:none"><td>billing country_code</td><td>'.$item->billing->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4311" style="display:none"><td>billing street</td><td>'.$item->billing->street.'</td><td></td></tr>';
	$html_text .= '<tr id="4312" style="display:none"><td>billing city</td><td>'.$item->billing->city.'</td><td></td></tr>';
	$html_text .= '<tr id="4313" style="display:none"><td>billing state_province</td><td>'.$item->billing->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="4314" style="display:none"><td>billing postal_code</td><td>'.$item->billing->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4315" style="display:none"><td>billing country_name</td><td>'.$item->billing->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="4316" style="display:none"><td>billing language_pref_1</td><td>'.$item->billing->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4317" style="display:none"><td>billing language_pref_2</td><td>'.$item->billing->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4318" style="display:none"><td>billing shielding</td><td>'.$item->billing->shielding.'</td><td id="billing_shielding"></td></tr>';
	$html_text .= '<tr id="4319" style="display:none;vertical-align:top"><td>billing properties</td><td>'.$item->billing->properties.'</td><td></td></tr>';	
	$html_text .= '<tr id="4320" style="display:none;vertical-align:top"><td>billing remark_values</td><td>'.$item->billing->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(44)">Emergency +/-</button></td><td></td><td id="emergency_role"></td></tr>';
	$html_text .= '<tr id="441" style="display:none"><td>emergency handle</td><td>'.$item->emergency->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="442" style="display:none"><td>emergency web_id</td><td>'.$item->emergency->web_id.'</td><td id="emergency_web_id"></td></tr>';
	$html_text .= '<tr id="443" style="display:none"><td>emergency organization_type</td><td>'.$item->emergency->organization_type.'</td><td></td></tr>';
	$html_text .= '<tr id="444" style="display:none"><td>emergency organization_name</td><td>'.$item->emergency->organization_name.'</td><td></td></tr>';
	$html_text .= '<tr id="445" style="display:none"><td>emergency presented_name</td><td>'.$item->emergency->presented_name.'</td><td></td></tr>';
	$html_text .= '<tr id="446" style="display:none"><td>emergency kind</td><td>'.$item->emergency->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="447" style="display:none"><td>emergency name</td><td>'.$item->emergency->name.'</td><td></td></tr>';
	$html_text .= '<tr id="448" style="display:none"><td>emergency email</td><td>'.$item->emergency->email.'</td><td></td></tr>';
	$html_text .= '<tr id="449" style="display:none"><td>emergency telephone</td><td>'.$item->emergency->telephone.'</td><td></td></tr>';
	$html_text .= '<tr id="4410" style="display:none"><td>emergency country_code</td><td>'.$item->emergency->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4411" style="display:none"><td>emergency street</td><td>'.$item->emergency->street.'</td><td></td></tr>';
	$html_text .= '<tr id="4412" style="display:none"><td>emergency city</td><td>'.$item->emergency->city.'</td><td></td></tr>';
	$html_text .= '<tr id="4413" style="display:none"><td>emergency state_province</td><td>'.$item->emergency->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="4414" style="display:none"><td>emergency postal_code</td><td>'.$item->emergency->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4415" style="display:none"><td>emergency country_name</td><td>'.$item->emergency->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="4416" style="display:none"><td>emergency language_pref_1</td><td>'.$item->emergency->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4417" style="display:none"><td>emergency language_pref_2</td><td>'.$item->emergency->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4418" style="display:none"><td>emergency shielding</td><td>'.$item->emergency->shielding.'</td><td id="emergency_shielding"></td></tr>';
	$html_text .= '<tr id="4419" style="display:none;vertical-align:top"><td>emergency properties</td><td>'.$item->emergency->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="4420" style="display:none;vertical-align:top"><td>emergency remark_values</td><td>'.$item->emergency->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(50)">Reseller +/-</button></td><td></td><td id="reseller_role"></td></tr>';
	$html_text .= '<tr id="501" style="display:none"><td>reseller handle</td><td>'.$item->reseller->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="502" style="display:none"><td>reseller web_id</td><td>'.$item->reseller->web_id.'</td><td id="reseller_web_id"></td></tr>';
	$html_text .= '<tr id="503" style="display:none"><td>reseller organization_type</td><td>'.$item->reseller->organization_type.'</td><td></td></tr>';
	$html_text .= '<tr><td>reseller organization_name</td><td>'.$item->reseller->organization_name.'</td><td></td></tr>';
	$html_text .= '<tr><td>reseller presented_name</td><td>'.$item->reseller->presented_name.'</td><td></td></tr>';
	$html_text .= '<tr id="504" style="display:none"><td>reseller kind</td><td>'.$item->reseller->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="505" style="display:none"><td>reseller name</td><td>'.$item->reseller->name.'</td><td></td></tr>';
	$html_text .= '<tr id="506" style="display:none"><td>reseller email</td><td>'.$item->reseller->email.'</td><td></td></tr>';
	$html_text .= '<tr id="507" style="display:none"><td>reseller telephone</td><td>'.$item->reseller->telephone.'</td><td></td></tr>';
	$html_text .= '<tr><td>reseller country_code</td><td>'.$item->reseller->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="508" style="display:none"><td>reseller street</td><td>'.$item->reseller->street.'</td><td></td></tr>';
	$html_text .= '<tr id="509" style="display:none"><td>reseller city</td><td>'.$item->reseller->city.'</td><td></td></tr>';
	$html_text .= '<tr id="5010" style="display:none"><td>reseller state_province</td><td>'.$item->reseller->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="5011" style="display:none"><td>reseller postal_code</td><td>'.$item->reseller->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="5012" style="display:none"><td>reseller country_name</td><td>'.$item->reseller->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="5013" style="display:none"><td>reseller language_pref_1</td><td>'.$item->reseller->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="5014" style="display:none"><td>reseller language_pref_2</td><td>'.$item->reseller->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="5015" style="display:none"><td>reseller shielding</td><td>'.$item->reseller->shielding.'</td><td id="reseller_shielding"></td></tr>';
	$html_text .= '<tr id="5016" style="display:none;vertical-align:top"><td>reseller status_values</td><td>'.$item->reseller->status_values.'</td><td></td></tr>';
	$html_text .= '<tr id="5017" style="display:none"><td>reseller event_registration</td><td>'.$item->reseller->event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="5018" style="display:none"><td>reseller event_last_transferred</td><td>'.$item->reseller->event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="5019" style="display:none"><td>reseller event_last_changed</td><td>'.$item->reseller->event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr id="5020" style="display:none"><td>reseller event_expiration</td><td>'.$item->reseller->event_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="5021" style="display:none"><td>reseller event_deletion</td><td>'.$item->reseller->event_deletion.'</td><td></td></tr>';
	$html_text .= '<tr id="5022" style="display:none"><td>reseller event_last_uploaded</td><td>'.$item->reseller->event_last_uploaded.'</td><td></td></tr>';
	$html_text .= '<tr id="5023" style="display:none"><td>reseller event_verification_received</td><td>'.$item->reseller->event_verification_received.'</td><td id="reseller_event_verification_received"></td></tr>';
	$html_text .= '<tr id="5024" style="display:none"><td>reseller event_verification_set</td><td>'.$item->reseller->event_verification_set.'</td><td id="reseller_event_verification_set"></td></tr>';
	$html_text .= '<tr id="5025" style="display:none;vertical-align:top"><td>reseller properties</td><td>'.$item->reseller->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="5026" style="display:none;vertical-align:top"><td>reseller remark_values</td><td>'.$item->reseller->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(60)">Registrar +/-</button></td><td></td><td id="registrar_role"></td></tr>';
	$html_text .= '<tr id="601" style="display:none"><td>registrar handle</td><td>'.$item->registrar->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="602" style="display:none"><td>registrar web_id</td><td>'.$item->registrar->web_id.'</td><td id="registrar_web_id"></td></tr>';
	$html_text .= '<tr id="603" style="display:none"><td>registrar organization_type</td><td>'.$item->registrar->organization_type.'</td><td></td></tr>';
	$html_text .= '<tr><td>registrar organization_name</td><td>'.$item->registrar->organization_name.'</td><td></td></tr>';
	$html_text .= '<tr><td>registrar presented_name</td><td>'.$item->registrar->presented_name.'</td><td></td></tr>';
	$html_text .= '<tr id="604" style="display:none"><td>registrar kind</td><td>'.$item->registrar->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="605" style="display:none"><td>registrar name</td><td>'.$item->registrar->name.'</td><td></td></tr>';
	$html_text .= '<tr id="606" style="display:none"><td>registrar email</td><td>'.$item->registrar->email.'</td><td></td></tr>';
	$html_text .= '<tr id="607" style="display:none"><td>registrar telephone</td><td>'.$item->registrar->telephone.'</td><td></td></tr>';
	$html_text .= '<tr><td>registrar country_code</td><td>'.$item->registrar->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="608" style="display:none"><td>registrar street</td><td>'.$item->registrar->street.'</td><td></td></tr>';
	$html_text .= '<tr id="609" style="display:none"><td>registrar city</td><td>'.$item->registrar->city.'</td><td></td></tr>';
	$html_text .= '<tr id="6010" style="display:none"><td>registrar state_province</td><td>'.$item->registrar->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="6011" style="display:none"><td>registrar postal_code</td><td>'.$item->registrar->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6012" style="display:none"><td>registrar country_name</td><td>'.$item->registrar->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="6013" style="display:none"><td>registrar language_pref_1</td><td>'.$item->registrar->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="6014" style="display:none"><td>registrar language_pref_2</td><td>'.$item->registrar->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="6015" style="display:none"><td>registrar shielding</td><td>'.$item->registrar->shielding.'</td><td id="registrar_shielding"></td></tr>';
	$html_text .= '<tr id="6016" style="display:none;vertical-align:top"><td>registrar status_values</td><td>'.$item->registrar->status_values.'</td><td></td></tr>';
	$html_text .= '<tr id="6017" style="display:none"><td>registrar event_registration</td><td>'.$item->registrar->event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="6018" style="display:none"><td>registrar event_last_transferred</td><td>'.$item->registrar->event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="6019" style="display:none"><td>registrar event_last_changed</td><td>'.$item->registrar->event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr id="6020" style="display:none"><td>registrar event_expiration</td><td>'.$item->registrar->event_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="6021" style="display:none"><td>registrar event_deletion</td><td>'.$item->registrar->event_deletion.'</td><td></td></tr>';
	$html_text .= '<tr id="6022" style="display:none"><td>registrar event_last_uploaded</td><td>'.$item->registrar->event_last_uploaded.'</td><td></td></tr>';
	$html_text .= '<tr id="6023" style="display:none"><td>registrar event_verification_received</td><td>'.$item->registrar->event_verification_received.'</td><td id="registrar_event_verification_received"></td></tr>';
	$html_text .= '<tr id="6024" style="display:none"><td>registrar event_verification_set</td><td>'.$item->registrar->event_verification_set.'</td><td id="registrar_event_verification_set"></td></tr>';
	$html_text .= '<tr id="6025" style="display:none;vertical-align:top"><td>registrar properties</td><td>'.$item->registrar->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="6026" style="display:none;vertical-align:top"><td>registrar remark_values</td><td>'.$item->registrar->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(61)">Registrar Abuse +/-</button></td><td></td><td id="registrar_abuse_role"></td></tr>';
	$html_text .= '<tr id="611" style="display:none"><td>registrar abuse_organization_type</td><td>'.$item->registrar->abuse_organization_type.'</td><td></td></tr>';
	$html_text .= '<tr id="612" style="display:none"><td>registrar abuse_organization_name</td><td>'.$item->registrar->abuse_organization_name.'</td><td></td></tr>';
	$html_text .= '<tr id="613" style="display:none"><td>registrar abuse_presented_name</td><td>'.$item->registrar->abuse_presented_name.'</td><td></td></tr>';
	$html_text .= '<tr id="614" style="display:none"><td>registrar abuse_email</td><td>'.$item->registrar->abuse_email.'</td><td></td></tr>';
	$html_text .= '<tr id="615" style="display:none"><td>registrar abuse_telephone</td><td>'.$item->registrar->abuse_telephone.'</td><td id="registrar_abuse_telephone"></td></tr>';
	$html_text .= '<tr id="616" style="display:none"><td>registrar abuse_country_code</td><td>'.$item->registrar->abuse_country_code.'</td><td id="registrar_abuse_country_code"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(63)">Name Servers +/-</button></td><td></td><td></td></tr>';
	//if (!empty($item->name_servers->server_1->server_name))	{
	//	if (strlen(trim($item->name_servers->server_1->server_name)))	{
			$html_text .= '<tr id="631" style="display:none"><td>server_name_1</td><td>'.$item->name_servers->server_1->server_name.'</td><td></td></tr>';
			$html_text .= '<tr id="632" style="display:none"><td>server_name_unicode_1</td><td>'.$item->name_servers->server_1->server_name_unicode.'</td><td></td></tr>';
			$html_text .= '<tr id="633" style="display:none"><td>server_ipv4_1</td><td>'.$item->name_servers->server_1->server_ipv4.'</td><td id="name_servers_ip"></td></tr>';
			$html_text .= '<tr id="634" style="display:none"><td>server_ipv6_1</td><td>'.$item->name_servers->server_1->server_ipv6.'</td><td></td></tr>';
			$html_text .= '<tr id="635" style="display:none"><td>server_delegation_check_1</td><td>'.$item->name_servers->server_1->server_delegation_check.'</td><td id="br_zone"></td></tr>';
			$html_text .= '<tr id="636" style="display:none"><td>server_status_1</td><td>'.$item->name_servers->server_1->server_status.'</td><td></td></tr>';
			$html_text .= '<tr id="637" style="display:none"><td>server_delegation_check_last_correct_1</td><td>'.$item->name_servers->server_1->server_delegation_check_last_correct.'</td><td></td></tr>';	
	//	}	
	//}
	if (!empty($item->name_servers->server_2->server_name))	{		
		if (strlen(trim($item->name_servers->server_2->server_name)))	{
			$html_text .= '<tr id="638" style="display:none"><td>server_name_2</td><td>'.$item->name_servers->server_2->server_name.'</td><td></td></tr>';
			$html_text .= '<tr id="639" style="display:none"><td>server_name_unicode_2</td><td>'.$item->name_servers->server_2->server_name_unicode.'</td><td></td></tr>';		
			$html_text .= '<tr id="6310" style="display:none"><td>server_ipv4_2</td><td>'.$item->name_servers->server_2->server_ipv4.'</td><td></td></tr>';
			$html_text .= '<tr id="6311" style="display:none"><td>server_ipv6_2</td><td>'.$item->name_servers->server_2->server_ipv6.'</td><td></td></tr>';
			$html_text .= '<tr id="6312" style="display:none"><td>server_delegation_check_2</td><td>'.$item->name_servers->server_2->server_delegation_check.'</td><td></td></tr>';
			$html_text .= '<tr id="6313" style="display:none"><td>server_status_2</td><td>'.$item->name_servers->server_2->server_status.'</td><td></td></tr>';
			$html_text .= '<tr id="6314" style="display:none"><td>server_delegation_check_last_correct_2</td><td>'.$item->name_servers->server_2->server_delegation_check_last_correct.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_3->server_name))	{
		if (strlen(trim($item->name_servers->server_3->server_name)))	{
			$html_text .= '<tr id="6315" style="display:none"><td>server_name_3</td><td>'.$item->name_servers->server_3->server_name.'</td><td></td></tr>';
			$html_text .= '<tr id="6316" style="display:none"><td>server_name_unicode_3</td><td>'.$item->name_servers->server_3->server_name_unicode.'</td><td></td></tr>';
			$html_text .= '<tr id="6317" style="display:none"><td>server_ipv4_3</td><td>'.$item->name_servers->server_3->server_ipv4.'</td><td></td></tr>';
			$html_text .= '<tr id="6318" style="display:none"><td>server_ipv6_3</td><td>'.$item->name_servers->server_3->server_ipv6.'</td><td></td></tr>';
			$html_text .= '<tr id="6319" style="display:none"><td>server_delegation_check_3</td><td>'.$item->name_servers->server_3->server_delegation_check.'</td><td></td></tr>';
			$html_text .= '<tr id="6320" style="display:none"><td>server_status_3</td><td>'.$item->name_servers->server_3->server_status.'</td><td></td></tr>';
			$html_text .= '<tr id="6321" style="display:none"><td>server_delegation_check_last_correct_3</td><td>'.$item->name_servers->server_3->server_delegation_check_last_correct.'</td><td></td></tr>';				
		}	
	}
	if (!empty($item->name_servers->server_4->server_name))	{	
		if (strlen(trim($item->name_servers->server_4->server_name)))	{
			$html_text .= '<tr id="6322" style="display:none"><td>server_name_4</td><td>'.$item->name_servers->server_4->server_name.'</td><td></td></tr>';
			$html_text .= '<tr id="6323" style="display:none"><td>server_name_unicode_4</td><td>'.$item->name_servers->server_4->server_name_unicode.'</td><td></td></tr>';			
			$html_text .= '<tr id="6324" style="display:none"><td>server_ipv4_4</td><td>'.$item->name_servers->server_4->server_ipv4.'</td><td></td></tr>';
			$html_text .= '<tr id="6325" style="display:none"><td>server_ipv6_4</td><td>'.$item->name_servers->server_4->server_ipv6.'</td><td></td></tr>';
			$html_text .= '<tr id="6326" style="display:none"><td>server_delegation_check_4</td><td>'.$item->name_servers->server_4->server_delegation_check.'</td><td></td></tr>';
			$html_text .= '<tr id="6327" style="display:none"><td>server_status_4</td><td>'.$item->name_servers->server_4->server_status.'</td><td></td></tr>';
			$html_text .= '<tr id="6328" style="display:none"><td>server_delegation_check_last_correct_4</td><td>'.$item->name_servers->server_4->server_delegation_check_last_correct.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_5->server_name))	{		
		if (strlen(trim($item->name_servers->server_5->server_name)))	{
			$html_text .= '<tr id="6329" style="display:none"><td>server_name_5</td><td>'.$item->name_servers->server_5->server_name.'</td><td></td></tr>';
			$html_text .= '<tr id="6330" style="display:none"><td>server_name_unicode_5</td><td>'.$item->name_servers->server_5->server_name_unicode.'</td><td></td></tr>';		
			$html_text .= '<tr id="6331" style="display:none"><td>server_ipv4_5</td><td>'.$item->name_servers->server_5->server_ipv4.'</td><td></td></tr>';
			$html_text .= '<tr id="6332" style="display:none"><td>server_ipv6_5</td><td>'.$item->name_servers->server_5->server_ipv6.'</td><td></td></tr>';
			$html_text .= '<tr id="6333" style="display:none"><td>server_delegation_check_5</td><td>'.$item->name_servers->server_5->server_delegation_check.'</td><td></td></tr>';
			$html_text .= '<tr id="6334" style="display:none"><td>server_status_5</td><td>'.$item->name_servers->server_5->server_status.'</td><td></td></tr>';
			$html_text .= '<tr id="6335" style="display:none"><td>server_delegation_check_last_correct_5</td><td>'.$item->name_servers->server_5->server_delegation_check_last_correct.'</td><td></td></tr>';	
		}	
	}
	if (!empty($item->name_servers->server_6->server_name))	{
		if (strlen(trim($item->name_servers->server_6->server_name)))	{
			$html_text .= '<tr id="6336" style="display:none"><td>server_name_6</td><td>'.$item->name_servers->server_6->server_name.'</td><td></td></tr>';
			$html_text .= '<tr id="6337" style="display:none"><td>server_name_unicode_6</td><td>'.$item->name_servers->server_6->server_name_unicode.'</td><td></td></tr>';		
			$html_text .= '<tr id="6338" style="display:none"><td>server_ipv4_6</td><td>'.$item->name_servers->server_6->server_ipv4.'</td><td></td></tr>';
			$html_text .= '<tr id="6339" style="display:none"><td>server_ipv6_6</td><td>'.$item->name_servers->server_6->server_ipv6.'</td><td></td></tr>';
			$html_text .= '<tr id="6340" style="display:none"><td>server_delegation_check_6</td><td>'.$item->name_servers->server_6->server_delegation_check.'</td><td></td></tr>';
			$html_text .= '<tr id="6341" style="display:none"><td>server_status_6</td><td>'.$item->name_servers->server_6->server_status.'</td><td></td></tr>';
			$html_text .= '<tr id="6342" style="display:none"><td>server_delegation_check_last_correct_6</td><td>'.$item->name_servers->server_6->server_delegation_check_last_correct.'</td><td></td></tr>';	
		}	
	}
	$html_text .= '<tr><td>name_servers dnssec</td><td>'.$item->name_servers->dnssec.'</td><td id="name_servers_dnssec"></td></tr>';
	$html_text .= '<tr><td>name_servers dnssec_algorithm</td><td>'.$item->name_servers->dnssec_algorithm.'</td><td id="name_servers_dnssec_algorithm"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(70)">Whois Data +/-</button></td><td colspan="2"></td></tr>';
	$html_text .= '<tr id="701" style="display:none"><td colspan="3">'.$item->raw_whois_data.'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:0.8rem" onclick="SwitchDisplay(75)">RDAP Data +/-</button></td><td id="raw_data_next" colspan="2"></td></tr>';
	$html_text .= '<tr id="751" style="display:none"><td colspan="3">'.$item->raw_rdap_data.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>