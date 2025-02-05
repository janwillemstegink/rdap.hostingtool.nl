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
		var max = 4
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
	else if (type == 30)	{ // domain
		var pre = '30';
		var max = 11
	}
	else if (type == 40)	{ // registrant
		var pre = '40';
		var max = 24
	}
	else if (type == 41)	{ // administrative
		var pre = '41';
		var max = 18
	}
	else if (type == 42)	{ // technical
		var pre = '42';
		var max = 18
	}
	else if (type == 43)	{ // billing
		var pre = '43';
		var max = 19
	}
	else if (type == 44)	{ // emergency
		var pre = '44';
		var max = 19
	}
	else if (type == 50)	{ // reseller
		var pre = '50';
		var max = 26
	}	
	else if (type == 60)	{ // registrar
		var pre = '60';
		var max = 28
	}
	else if (type == 61)	{ // abuse
		var pre = '61';
		var max = 3
	}
	else if (type == 62)	{ // sponsor
		var pre = '62';
		var max = 30
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
		document.getElementById("title").textContent = "Domain Data";
		document.getElementById("subtitle").textContent = "(modeled data)";
		document.getElementById("instruction").textContent = "Paste a domain name and press Enter.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "";
		document.getElementById("zone_role").textContent = "";
		document.getElementById("zone_delegation").textContent = proposed;
		document.getElementById("zone_restrictions").textContent = proposed;
		document.getElementById("zone_regmenu").textContent = proposed;
		document.getElementById("domain_role").textContent = "";
		document.getElementById("domain_name_ascii").textContent = "";
		document.getElementById("domain_name_unicode").textContent = "";
		document.getElementById("domain_status_values").textContent = "";
		document.getElementById("domain_event_expiration").textContent = "";
		document.getElementById("domain_event_recovery_until").textContent = proposed;
		document.getElementById("domain_event_deletion").textContent = "";
		document.getElementById("domain_event_last_uploaded").textContent = "";
		document.getElementById("domain_extensions_values").textContent = "";
		document.getElementById("registrant_role").textContent = "";
		document.getElementById("registrant_web_id").textContent = proposed;
		document.getElementById("registrant_organization").textContent = "";
		document.getElementById("registrant_full_name").textContent = "";
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
		document.getElementById("registrar_iana_id").textContent = "";
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;
		document.getElementById("registrar_abuse_role").textContent = "";
		document.getElementById("sponsor_role").textContent = "";
		document.getElementById("name_servers_dnssec").textContent = "";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "";
		document.getElementById("name_servers_ip").textContent = "";
		document.getElementById("br_zone").textContent = "";
		document.getElementById("raw_data_next").textContent = "";
	}
	else if (translation == 1)	{
		var proposed = 'VOORGESTELD - ';
		var address = "Afscherming van adresgegevens is duidelijk zichtbaar bij example.tel.";
		document.getElementById("title").textContent = "Domeingegevens";
		document.getElementById("subtitle").textContent = "(gemodelleerde data)";
		document.getElementById("instruction").textContent = "Plak een domeinnaam en druk op Enter.";
		document.getElementById("field").textContent = "Omschrijving";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Webdomeinen toegelicht";
		document.getElementById("zone_role").textContent = "Een domeinzone is door de ICANN toegewezen aan een domain registry om domeinen te beheren.";
		document.getElementById("zone_delegation").textContent = proposed + "Gepland: Web-ID-zoekopdrachten kunnen worden uitgevoerd op wereldwijde RDAP-servers.";
		document.getElementById("zone_restrictions").textContent = proposed + "Het gebruik van domeingegevens is aan beperkingen onderhevig.";
		document.getElementById("zone_regmenu").textContent = proposed + "Een vervolgkeuzemenu met uitleg en details, bijvoorbeeld via een subdomein van de registry.";
		document.getElementById("domain_role").textContent = "Een webdomein onder een topleveldomein is wereldwijd uniek en onder bepaalde regels vrij te kiezen.";
		document.getElementById("domain_name_ascii").textContent = "Namen met speciale tekens in ASCII-tekenreeksen gebruiken Punycode-transcriptie.";
		document.getElementById("domain_name_unicode").textContent = "In het RDAP-protocol is de domeinnaam in Unicode optioneel, maar het is wel duidelijke informatie.";
		document.getElementById("domain_status_values").textContent = "De waarde 'redemption period' is info over herstel. De waarde 'pending delete' is van toepassing in de laatste fase.";
		document.getElementById("domain_event_expiration").textContent = "Datum en tijdstip van periodieke verlenging of stopzetting van de publicatie.";
		document.getElementById("domain_event_recovery_until").textContent = proposed + "Datum en tijdstip tot wanneer herstel nog mogelijk is.";		
		document.getElementById("domain_event_deletion").textContent = "Datum en tijdstip gepland voor volledige verwijdering. Er kan een laatste verwijderingsfase zijn.";
		document.getElementById("domain_event_last_uploaded").textContent = "Datum en tijdstip van de RDAP-database-update in Zoeloe-tijd (Coordinated Universal Time - UTC).";
		document.getElementById("domain_extensions_values").textContent = "'Eligibility': Hoe een domein voldoet aan een specifieke vereiste in een topleveldomeinzone.";
		document.getElementById("registrant_role").textContent = "De domeingebruiker die de daadwerkelijke of effectieve controle heeft voor domeinrecht in het land van vestiging.";
		document.getElementById("registrant_web_id").textContent = proposed + "Webidentificatienummer voor bedrijfsentiteiten en natuurlijke personen.";
		document.getElementById("registrant_organization").textContent = "De naam van een organisatie die primair verantwoordelijk is voor het domeinabonnement.";
		document.getElementById("registrant_full_name").textContent = "De naam van een persoon of rol die primair verantwoordelijk is voor het domeinabonnement.";
		document.getElementById("registrant_kind").textContent = "Leeg / 'org' / 'individual' (Voor continuïteit: levenstestament + testament + digitale executeur)";
		document.getElementById("registrant_name").textContent = "In het RDAP-protocol kan een persoonlijke naam zichtbaar zijn in het veld 'full_name', zie cira.ca.";
		document.getElementById("registrant_country_code").textContent = "De ISO-2-landcode-indexering werkt, bijvoorbeeld voor het Verenigd Koninkrijk, dat de EU heeft verlaten.";
		document.getElementById("registrant_street").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;
		document.getElementById("registrant_shielding").textContent = proposed + "De aanvrager, zone en rol bepalen de uitvoer per rol.";
		document.getElementById("registrant_event_verification_received").textContent = proposed + "De verantwoordelijke persoon kan een identieke web-ID aanklikken; leeg is intrekking.";
		document.getElementById("registrant_event_verification_set").textContent = proposed + "Vervolgens controleert het register de gegevens bij de landspecifieke webdomeindienst.";
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
		document.getElementById("registrar_iana_id").textContent = "In het geval van ICANN-accreditatie, voor één of meer generieke topleveldomeinen. En moet juist zijn.";
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_abuse_role").textContent = "Informatie over hoe een derde partij contact kan opnemen met de registrar (zie bijvoorbeeld hostingtool.org).";
		document.getElementById("sponsor_role").textContent = "In het geval van een sponsor is deze entiteit verantwoordelijk voor het beheer van de domeinregistratie.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is een web-route-beveiligingsvoorziening op het DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Een DNSSEC-algoritme vanaf versie 13 is up-to-date.";
		document.getElementById("name_servers_ip").textContent = "IP-waarden in een glue record alleen als de nameservers van de registrar niet worden gebruikt.";
		document.getElementById("br_zone").textContent = "Zone .br: De RDAP-gegevens zijn aangepast met nameservervalidatie.";
		document.getElementById("raw_data_next").textContent = "De volgorde van de rollen is niet voorgeschreven. 'None Specified' komt van deze tool. Een XML-structuur in JSON voor de RDAP-gegevens zou nuttig zijn.";	
	}
	else if (translation == 2)	{
		var proposed = 'PROPOSED - ';
		var address = "Shielding of address data is clearly visible at example.tel.";
		document.getElementById("title").textContent = "Domain Data";
		document.getElementById("subtitle").textContent = "(modeled data)";
		document.getElementById("instruction").textContent = "Paste a domain name and press Enter.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Web Domains Explained";		
		document.getElementById("zone_role").textContent = "A domain zone is assigned by ICANN to a domain registry to manage domains.";
		document.getElementById("zone_delegation").textContent = proposed + "Planned: Web ID searches can be performed on global RDAP servers.";
		document.getElementById("zone_restrictions").textContent = proposed + "The use of domain data is subject to restrictions.";
		document.getElementById("zone_regmenu").textContent = proposed + "A drop-down menu with explanations and details, for example via a subdomain of the registry.";
		document.getElementById("domain_role").textContent = "A web domain under a top-level domain is unique worldwide and can be freely chosen under certain rules.";
		document.getElementById("domain_name_ascii").textContent = "Names containing special characters in ASCII strings use Punycode transcription.";
		document.getElementById("domain_name_unicode").textContent = "In the RDAP protocol, the domain name in Unicode is optional, but it is clear information.";
		document.getElementById("domain_status_values").textContent = "The 'redemption period' value is info about recovery. The 'pending delete' value applies in the final phase.";
		document.getElementById("domain_event_expiration").textContent = "Date and time of periodic renewal or discontinuation of publication.";
		document.getElementById("domain_event_recovery_until").textContent = proposed + "Date and time until which recovery is still possible.";
		document.getElementById("domain_event_deletion").textContent = "Date and time scheduled for complete deletion. A final deletion phase may exist.";
		document.getElementById("domain_event_last_uploaded").textContent = "Date and time of RDAP database update in Zulu time (Coordinated Universal Time - UTC).";
		document.getElementById("domain_extensions_values").textContent = "'Eligibility': How a domain fulfills a specific requirement in a top-level domain zone.";
		document.getElementById("registrant_role").textContent = "The domain user who has the actual or effective control for domain rights in the country of establishment.";
		document.getElementById("registrant_web_id").textContent = proposed + "Web Identification number for business entities and natural persons.";
		document.getElementById("registrant_organization").textContent = "The name of an organization primarily responsible for the domain subscription.";
		document.getElementById("registrant_full_name").textContent = "The name of a person or role primarily responsible for the domain subscription.";
		document.getElementById("registrant_kind").textContent = "Empty / 'org' / 'individual' (For continuity: Living Will + Will + Digital Executor)";
		document.getElementById("registrant_name").textContent = "In the RDAP protocol, a personal name may be visible in the 'full_name' field, see cira.ca.";
		document.getElementById("registrant_country_code").textContent = "ISO-2 country code indexing works, as for the United Kingdom, which has left the EU.";
		document.getElementById("registrant_street").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;		
		document.getElementById("registrant_country_name").textContent = "The country name is limited to registrar information in the so-called 'registrar RDAP query'.";
		document.getElementById("registrant_shielding").textContent = proposed + "The requester, zone and role determine the output per role.";
		document.getElementById("registrant_event_verification_received").textContent = proposed + "The responsible person can click on an identical web ID; empty is revocation.";
		document.getElementById("registrant_event_verification_set").textContent = proposed + "The registry then checks the data with the country-specific web domain service.";	
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
		document.getElementById("registrar_iana_id").textContent = "In case of ICANN accreditation, for one or more generic top-level domains. And must be correct.";
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_abuse_role").textContent = "Information on how a third party can contact the registrar (see e.g. hostingtool.org).";
		document.getElementById("sponsor_role").textContent = "In the case of a sponsor, this entity is responsible for managing the domain registration.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is a web route security feature on the DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "A DNSSEC algorithm starting from version 13 is up-to-date.";
		document.getElementById("name_servers_ip").textContent = "IP values in a glue record only if the registrar's name servers are not used.";
		document.getElementById("br_zone").textContent = "Zone .br: The RDAP data has been modified with name server validation.";
		document.getElementById("raw_data_next").textContent = "The order of the roles is not prescribed. 'None Specified' comes from this tool. An XML structure in JSON for the RDAP data would be useful.";
	}
	else if (translation == 3)	{
		var proposed = 'VORGESCHLAGEN - ';
		var address = "Die Abschirmung der Adressdaten ist bei example.tel deutlich sichtbar.";
		document.getElementById("title").textContent = "Domänendaten";
		document.getElementById("subtitle").textContent = "(modellierte Daten)";
		document.getElementById("instruction").textContent = "Fügen Sie einen Domänennamen ein und drücken Sie die Eingabetaste.";
		document.getElementById("field").textContent = "Beschreibung";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Webdomänen erklärt";		
		document.getElementById("zone_role").textContent = "Eine Domänenzone wird von ICANN einer Domänenregistrierungsstelle zugewiesen, um Domänen zu verwalten.";	
		document.getElementById("zone_delegation").textContent = proposed + "Geplant: Web-ID-Suchen können auf globalen RDAP-Servern durchgeführt werden.";
		document.getElementById("zone_restrictions").textContent = proposed + "Die Nutzung der Domaindaten unterliegt Einschränkungen.";
		document.getElementById("zone_regmenu").textContent = proposed + "Ein Dropdown-Menü mit Erläuterungen und Details, z. B. über eine Subdomain der Registry.";
		document.getElementById("domain_role").textContent = "Eine Webdomain unter einer Top-Level-Domain ist weltweit einzigartig und unter bestimmten Regeln frei wählbar.";
		document.getElementById("domain_name_ascii").textContent = "Namen, die Sonderzeichen in ASCII-Zeichenfolgen enthalten, verwenden die Punycode-Transkription.";
		document.getElementById("domain_name_unicode").textContent = "Im RDAP-Protokoll ist der Domänenname in Unicode optional, stellt jedoch eine eindeutige Information dar.";
		document.getElementById("domain_status_values").textContent = "Der Wert 'redemption period' ist Info zur Wiederherstellung. Der Wert 'pending delete' gilt in der Endphase.";
		document.getElementById("domain_event_expiration").textContent = "Datum und Uhrzeit der periodischen Erneuerung oder Einstellung der Veröffentlichung.";
		document.getElementById("domain_event_recovery_until").textContent = proposed + "Datum und Uhrzeit, bis zu denen eine Wiederherstellung noch möglich ist.";
		document.getElementById("domain_event_deletion").textContent = "Datum und Uhrzeit für die vollständige Löschung geplant. Es kann eine abschließende Löschphase geben.";
		document.getElementById("domain_event_last_uploaded").textContent = "Datum und Uhrzeit der RDAP-Datenbankaktualisierung in Zulu-Zeit (Koordinierte Weltzeit – UTC).";
		document.getElementById("domain_extensions_values").textContent = "'Eligibility': Wie eine Domäne eine bestimmte Anforderung in einer Top-Level-Domänenzone erfüllt.";
		document.getElementById("registrant_role").textContent = "Der Domänenbenutzer, der die tatsächliche oder effektive Kontrolle hat für Domainrechte im Wohnsitzland.";
		document.getElementById("registrant_web_id").textContent = proposed + "Web-Identifikationsnummer für Unternehmen und natürliche Personen.";
		document.getElementById("registrant_organization").textContent = "Der Name einer Organisation, die hauptsächlich für das Domänenabonnement verantwortlich ist.";
		document.getElementById("registrant_full_name").textContent = "Der Name einer Person oder Rolle, die hauptsächlich für das Domänenabonnement verantwortlich ist.";
		document.getElementById("registrant_kind").textContent = "Leer / 'org' / 'individual' (Für Kontinuität: Patientenverfügung + Testament + digitaler Testamentsvollstrecker)";
		document.getElementById("registrant_name").textContent = "Im RDAP-Protokoll kann im Feld 'full_name' ein Personenname sichtbar sein, siehe cira.ca";
		document.getElementById("registrant_country_code").textContent = "Die Indizierung mit dem ISO-2-Ländercode funktioniert, wie für das Vereinigte Königreich, das die EU verlassen hat.";
		document.getElementById("registrant_street").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;		
		document.getElementById("registrant_country_name").textContent = "Der Ländername beschränkt sich bei der sogenannten 'registrar RDAP-query' auf die Registrar-Informationen.";
		document.getElementById("registrant_shielding").textContent = proposed + "Anforderer, Zone und Rolle bestimmen die Ausgabe pro Rolle.";
		document.getElementById("registrant_event_verification_received").textContent = proposed + "Der Verantwortliche kann auf eine identische Web-ID klicken; leer ist Rückzug.";
		document.getElementById("registrant_event_verification_set").textContent = proposed + "Anschließend gleicht die Registry die Daten beim länderspezifischen Webdomain-Dienst ab.";
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
		document.getElementById("registrar_iana_id").textContent = "Im Falle einer ICANN-Akkreditierung für eine oder mehrere generische Top-Level-Domains. Und muss korrekt sein.";
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_abuse_role").textContent = "Informationen darüber, wie Dritte den Registrar kontaktieren können (siehe z. B. hostingtool.org).";
		document.getElementById("sponsor_role").textContent = "Im Falle eines Sponsors ist diese Entität für die Verwaltung der Domänenregistrierung verantwortlich.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC ist eine Sicherheitsfunktion für Webrouten im DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Ein DNSSEC-Algorithmus ab Version 13 ist auf dem neuesten Stand.";
		document.getElementById("name_servers_ip").textContent = "IP-Werte in einem Glue-Record nur, wenn die Nameserver des Registrars nicht verwendet werden.";
		document.getElementById("br_zone").textContent = "Zone .br: Die RDAP-Daten wurden mit der Nameserver-Validierung angepasst.";
		document.getElementById("raw_data_next").textContent = "Die Reihenfolge der Rollen ist nicht vorgeschrieben. 'None Specified' stammt von diesem Tool. Eine XML-Struktur in JSON für die RDAP-Daten wäre sinnvoll.";
	}
	else if (translation == 4)	{
		var proposed = 'PROPOSÉ - ';
		var address = "Le blindage des données d'adresse est clairement visible sur example.tel.";
		document.getElementById("title").textContent = "Données du domaine";
		document.getElementById("subtitle").textContent = "(données modélisées)";
		document.getElementById("instruction").textContent = "Collez un nom de domaine et appuyez sur Entrée.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Détail";
		document.getElementById("explanation").textContent = "Domaines Web expliqués";		
		document.getElementById("zone_role").textContent = "Une zone de domaine est attribuée par l'ICANN à un registre de domaine pour gérer les domaines.";
		document.getElementById("zone_delegation").textContent = proposed + "Prévu : Les recherches d’identifiant Web peuvent être effectuées sur des serveurs RDAP mondiaux.";
		document.getElementById("zone_restrictions").textContent = proposed + "L'utilisation des données de domaine est soumise à des restrictions.";
		document.getElementById("zone_regmenu").textContent = proposed + "Un menu déroulant avec explication et détails, par exemple via un sous-domaine du registre.";
		document.getElementById("domain_role").textContent = "Un domaine Web sous un domaine de premier niveau est unique au monde et peut être choisi librement selon certaines règles.";
		document.getElementById("domain_name_ascii").textContent = "Les noms contenant des caractères spéciaux dans les chaînes ASCII utilisent la transcription Punycode.";
		document.getElementById("domain_name_unicode").textContent = "Dans le protocole RDAP, le nom de domaine en Unicode est facultatif, mais il s'agit d'une information claire.";
		document.getElementById("domain_status_values").textContent = "La valeur 'redemption period' est infos de récupération. La valeur 'pending delete' s'applique dans la phase finale.";
		document.getElementById("domain_event_expiration").textContent = "Date et heure du renouvellement périodique ou de l'arrêt de la publication.";
		document.getElementById("domain_event_recovery_until").textContent = proposed + "Date et heure jusqu'à laquelle la récupération est encore possible.";
		document.getElementById("domain_event_deletion").textContent = "Date et heure prévues pour la suppression complète. Une phase de suppression finale peut exister.";
		document.getElementById("domain_event_last_uploaded").textContent = "Date et heure de mise à jour de la base de données RDAP en heure Zulu (temps universel coordonné - UTC).";
		document.getElementById("domain_extensions_values").textContent = "'Eligibility' : comment un domaine répond à une exigence spécifique dans une zone de domaine de premier niveau.";
		document.getElementById("registrant_role").textContent = "L'utilisateur du domaine qui a le contrôle réel ou effectif pour les droits de domaine dans le pays de résidence.";
		document.getElementById("registrant_web_id").textContent = proposed + "Numéro d’identification Web pour les entités commerciales et les personnes physiques.";
		document.getElementById("registrant_organization").textContent = "Le nom d’une organisation principalement responsable de l’abonnement au domaine.";
		document.getElementById("registrant_full_name").textContent = "Le nom d'une personne ou d'un rôle principalement responsable de l'abonnement au domaine.";
		document.getElementById("registrant_kind").textContent = "Vide / 'org' / 'individual' (Pour la continuité : testament biologique + testament + exécuteur testamentaire numérique)";
		document.getElementById("registrant_name").textContent = "Dans le protocole RDAP, un nom personnel peut être visible dans le champ 'full_name', voir cira.ca.";
		document.getElementById("registrant_country_code").textContent = "L'indexation des codes pays ISO-2 fonctionne, comme pour le Royaume-Uni, qui a quitté l'UE.";
		document.getElementById("registrant_street").textContent = address;
		document.getElementById("registrant_city").textContent = address;
		document.getElementById("registrant_postal_code").textContent = address;
		document.getElementById("registrant_country_name").textContent = "Le nom du pays est limité aux informations du bureau d'enregistrement dans la 'registrar RDAP-query'.";
		document.getElementById("registrant_shielding").textContent = proposed + "Le demandeur, la zone et le rôle déterminent la sortie par rôle.";
		document.getElementById("registrant_event_verification_received").textContent = proposed + "La personne responsable peut cliquer sur un identifiant Web identique ; le vide est le retrait.";
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
		document.getElementById("registrar_iana_id").textContent = "En cas d'accréditation ICANN, pour un ou plusieurs domaines génériques de premier niveau. Et doit être correct.";
		document.getElementById("registrar_shielding").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_abuse_role").textContent = "Informations sur la manière dont un tiers peut contacter le registraire (voir par exemple hostingtool.org).";
		document.getElementById("sponsor_role").textContent = "Dans le cas d'un sponsor, cette entité est responsable de la gestion de l'enregistrement du domaine.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC est une fonctionnalité de sécurité de route Web sur le DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Un algorithme DNSSEC à partir de la version 13 est à jour.";
		document.getElementById("name_servers_ip").textContent = "Valeurs IP dans un enregistrement de colle uniquement si les serveurs de noms du registraire ne sont pas utilisés.";
		document.getElementById("br_zone").textContent = "Zone .br: Les données RDAP ont été ajustées avec la validation du serveur de noms.";
		document.getElementById("raw_data_next").textContent = "L'ordre des rôles n'est pas prescrit. 'None Specified' provient de cet outil. Une structure XML en JSON pour les données RDAP serait utile.";
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
	$display_message = str_replace("'", "\'", "A result could not be retrieved.");	
	echo "<script>alert('$display_message');</script>";
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
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr style="font-size:1.05rem;font-weight:bold"><td id="field"></td><td id="value"><td id="explanation"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(10)">Zone +/-</button></td><td><b>'.$item->zone->top_level_domain.'</b></td><td id="zone_role"></td></tr>';
	$html_text .= '<tr id="101" style="display:none"><td>zone delegation</td><td><a href='.$item->zone->delegation.' target="_blank">IANA Delegation Data</a></td><td id="zone_delegation"></td></tr>';
	if (strlen($item->zone->restrictions))	{
		$html_text .= '<tr id="102" style="display:none"><td>zone restrictions</td><td><a href='.$item->zone->restrictions.' target="_blank">Data Usage Restrictions</a></td><td id="zone_restrictions"></td></tr>';
	}
	else	{
		$html_text .= '<tr id="102" style="display:none"><td>zone restrictions</td><td>none</td><td id="zone_restrictions"></td></tr>';
	}
	if (strlen($item->zone->regmenu))	{
		$html_text .= '<tr id="103" style="display:none"><td>zone regmenu</td><td><a href='.$item->zone->regmenu.' target="_blank">Domain Zone Registry Menu</a></td><td id="zone_regmenu"></td></tr>';
	}
	else	{
		$html_text .= '<tr id="103" style="display:none"><td>zone regmenu</td><td>none</td><td id="zone_regmenu"></td></tr>';	
	}
	$html_text .= '<tr id="104" style="display:none"><td>zone language</td><td>'.$item->zone->language.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(11)">Notice0 +/-</button> <button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(12)">Notice1 +/-</button> <button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(13)">Notice2 +/-</button> <button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(14)">Notice3 +/-</button></td><td></td><td></td></tr>';
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
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(20)">Links0 +/-</button> <button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(21)">Links1 +/-</button> <button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(22)">Links2 +/-</button> <button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(23)">Links3 +/-</button></td><td></td><td></td></tr>';
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
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(30)">Details +/-</button></td><td><b>'.$viewdomain.'</b></td><td id="domain_role"></td></tr>';
	$html_text .= '<tr id="301" style="display:none"><td>details handle</td><td>'.$item->details->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="302" style="display:none"><td>details name_ascii</td><td>'.$item->details->name_ascii.'</td><td id="domain_name_ascii"></td></tr>';
	$html_text .= '<tr id="303" style="display:none"><td>details name_unicode</td><td>'.$item->details->name_unicode.'</td><td id="domain_name_unicode"></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>details status_values</td><td><b>'.$item->details->status_values.'</b></td><td id="domain_status_values"></td></tr>';
	$html_text .= '<tr id="304" style="display:none"><td>details event_registration</td><td>'.$item->details->event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="305" style="display:none"><td>details event_last_transferred</td><td>'.$item->details->event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="306" style="display:none"><td>details event_last_changed</td><td>'.$item->details->event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr><td>details event_expiration</td><td>'.$item->details->event_expiration.'</td><td id="domain_event_expiration"></td></tr>';
	$html_text .= '<tr id="307" style="display:none"><td>details event_recovery_until</td><td>'.$item->details->event_recovery_until.'</td><td id="domain_event_recovery_until"></td></tr>';
	$html_text .= '<tr id="308" style="display:none"><td>details event_deletion</td><td>'.$item->details->event_deletion.'</td><td id="domain_event_deletion"></td></tr>';
	$html_text .= '<tr id="309" style="display:none"><td>details event_last_uploaded</td><td>'.$item->details->event_last_uploaded.'</td><td id="domain_event_last_uploaded"></td></tr>';
	$html_text .= '<tr id="3010" style="display:none;vertical-align:top"><td>details extensions_values</td><td><b>'.$item->details->extensions_values.'</b></td><td id="domain_extensions_values"></td></tr>';
	$html_text .= '<tr id="3011" style="display:none;vertical-align:top"><td>details remark_values</td><td>'.$item->details->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(40)">Registrant +/-</button></td><td></td><td id="registrant_role"></td></tr>';
	$html_text .= '<tr id="401" style="display:none"><td>registrant handle</td><td>'.$item->registrant->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="402" style="display:none"><td>registrant web_id</td><td>'.$item->registrant->web_id.'</td><td id="registrant_web_id"></td></tr>';
	$html_text .= '<tr><td>registrant organization</td><td><b>'.$item->registrant->organization.'</b></td><td id="registrant_organization"></td></tr>';
	$html_text .= '<tr><td>registrant full_name</td><td><b>'.$item->registrant->full_name.'</b></td><td id="registrant_full_name"></td></tr>';
	$html_text .= '<tr><td>registrant kind</td><td>'.$item->registrant->kind.'</td><td id="registrant_kind"></td></tr>';
	$html_text .= '<tr id="403" style="display:none"><td>registrant name</td><td><b>'.$item->registrant->name.'</b></td><td id="registrant_name"></td></tr>';
	$html_text .= '<tr id="404" style="display:none"><td>registrant email</td><td>'.$item->registrant->email.'</td><td></td></tr>';
	$html_text .= '<tr id="405" style="display:none"><td>registrant tel</td><td>'.$item->registrant->tel.'</td><td></td></tr>';
	$html_text .= '<tr><td>registrant country_code (<a style="font-size: 0.9rem" href="https://icann-hamster.nl/ham/soac/ccnso/techday/icann80/2.%20RDAP%20Conformance%20Tool%20-%20Tech%20Day.pdf" target="_blank">cc parameter</a>)</td><td><b>'.$item->registrant->country_code.'</b></td><td id="registrant_country_code"></td></tr>';
	$html_text .= '<tr id="406" style="display:none"><td>registrant street</td><td>'.$item->registrant->street.'</td><td id="registrant_street"></td></tr>';
	$html_text .= '<tr id="407" style="display:none"><td>registrant city</td><td>'.$item->registrant->city.'</td><td id="registrant_city"></td></tr>';
	$html_text .= '<tr id="408" style="display:none"><td>registrant state_province</td><td>'.$item->registrant->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="409" style="display:none"><td>registrant postal_code</td><td>'.$item->registrant->postal_code.'</td><td id="registrant_postal_code"></td></tr>';
	$html_text .= '<tr id="4010" style="display:none"><td>registrant country_name</td><td>'.$item->registrant->country_name.'</td><td id="registrant_country_name"></td></tr>';
	$html_text .= '<tr id="4011" style="display:none"><td>registrant language_pref_1</td><td>'.$item->registrant->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4012" style="display:none"><td>registrant language_pref_2</td><td>'.$item->registrant->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4013" style="display:none"><td>registrant shielding</td><td>'.$item->registrant->shielding.'</td><td id="registrant_shielding"></td></tr>';
	$html_text .= '<tr id="4014" style="display:none;vertical-align:top"><td>registrant status_values</td><td>'.$item->registrant->status_values.'</td><td></td></tr>';
	$html_text .= '<tr id="4015" style="display:none"><td>registrant event_registration</td><td>'.$item->registrant->event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="4016" style="display:none"><td>registrant event_last_transferred</td><td>'.$item->registrant->event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="4017" style="display:none"><td>registrant event_last_changed</td><td>'.$item->registrant->event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr id="4018" style="display:none"><td>registrant event_expiration</td><td>'.$item->registrant->event_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="4019" style="display:none"><td>registrant event_deletion</td><td>'.$item->registrant->event_deletion.'</td><td id="registrant_event_deletion"></td></tr>';
	$html_text .= '<tr id="4020" style="display:none"><td>registrant event_last_uploaded</td><td>'.$item->registrant->event_last_uploaded.'</td><td id="registrant_event_last_uploaded"></td></tr>';
	$html_text .= '<tr id="4021" style="display:none"><td>registrant event_verification_received</td><td>'.$item->registrant->event_verification_received.'</td><td id="registrant_event_verification_received"></td></tr>';
	$html_text .= '<tr id="4022" style="display:none"><td>registrant event_verification_set</td><td>'.$item->registrant->event_verification_set.'</td><td id="registrant_event_verification_set"></td></tr>';
	$html_text .= '<tr id="4023" style="display:none;vertical-align:top"><td>registrant properties</td><td>'.$item->registrant->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="4024" style="display:none;vertical-align:top"><td>registrant remark_values</td><td>'.$item->registrant->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(41)">Administrative / Decision +/-</button></td><td></td><td id="administrative_role"></td></tr>';
	$html_text .= '<tr id="411" style="display:none"><td>administrative handle</td><td>'.$item->administrative->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="412" style="display:none"><td>administrative web_id</td><td>'.$item->administrative->web_id.'</td><td id="administrative_web_id"></td></tr>';
	$html_text .= '<tr id="413" style="display:none"><td>administrative organization</td><td>'.$item->administrative->organization.'</td><td></td></tr>';
	$html_text .= '<tr id="414" style="display:none"><td>administrative full_name</td><td>'.$item->administrative->full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="415" style="display:none"><td>administrative kind</td><td>'.$item->administrative->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="416" style="display:none"><td>administrative name</td><td>'.$item->administrative->name.'</td><td></td></tr>';
	$html_text .= '<tr><td>administrative email</td><td>'.$item->administrative->email.'</td><td></td></tr>';
	$html_text .= '<tr id="417" style="display:none"><td>administrative tel</td><td>'.$item->administrative->tel.'</td><td></td></tr>';
	$html_text .= '<tr id="418" style="display:none"><td>administrative country_code</td><td>'.$item->administrative->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="419" style="display:none"><td>administrative street</td><td>'.$item->administrative->street.'</td><td></td></tr>';
	$html_text .= '<tr id="4110" style="display:none"><td>administrative city</td><td>'.$item->administrative->city.'</td><td></td></tr>';
	$html_text .= '<tr id="4111" style="display:none"><td>administrative state_province</td><td>'.$item->administrative->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="4112" style="display:none"><td>administrative postal_code</td><td>'.$item->administrative->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4113" style="display:none"><td>administrative country_name</td><td>'.$item->administrative->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="4114" style="display:none"><td>administrative language_pref_1</td><td>'.$item->administrative->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4115" style="display:none"><td>administrative language_pref_2</td><td>'.$item->administrative->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4116" style="display:none"><td>administrative shielding</td><td>'.$item->administrative->shielding.'</td><td id="administrative_shielding"></td></tr>';
	$html_text .= '<tr id="4117" style="display:none;vertical-align:top"><td>administrative properties</td><td>'.$item->administrative->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="4118" style="display:none;vertical-align:top"><td>administrative remark_values</td><td>'.$item->administrative->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(42)">Technical / Onsite +/-</button></td><td></td><td id="technical_role"></td></tr>';
	$html_text .= '<tr id="421" style="display:none"><td>technical handle</td><td>'.$item->technical->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="422" style="display:none"><td>technical web_id</td><td>'.$item->technical->web_id.'</td><td id="technical_web_id"></td></tr>';
	$html_text .= '<tr id="423" style="display:none"><td>technical organization</td><td>'.$item->technical->organization.'</td><td></td></tr>';
	$html_text .= '<tr id="424" style="display:none"><td>technical full_name</td><td>'.$item->technical->full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="425" style="display:none"><td>technical kind</td><td>'.$item->technical->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="426" style="display:none"><td>technical name</td><td>'.$item->technical->name.'</td><td></td></tr>';
	$html_text .= '<tr><td>technical email</td><td>'.$item->technical->email.'</td><td></td></tr>';
	$html_text .= '<tr id="427" style="display:none"><td>technical tel</td><td>'.$item->technical->tel.'</td><td></td></tr>';
	$html_text .= '<tr id="428" style="display:none"><td>technical country_code</td><td>'.$item->technical->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="429" style="display:none"><td>technical street</td><td>'.$item->technical->street.'</td><td></td></tr>';
	$html_text .= '<tr id="4210" style="display:none"><td>technical city</td><td>'.$item->technical->city.'</td><td></td></tr>';
	$html_text .= '<tr id="4211" style="display:none"><td>technical state_province</td><td>'.$item->technical->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="4212" style="display:none"><td>technical postal_code</td><td>'.$item->technical->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4213" style="display:none"><td>technical country_name</td><td>'.$item->technical->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="4214" style="display:none"><td>technical language_pref_1</td><td>'.$item->technical->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4215" style="display:none"><td>technical language_pref_2</td><td>'.$item->technical->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4216" style="display:none"><td>technical shielding</td><td>'.$item->technical->shielding.'</td><td id="technical_shielding"></td></tr>';
	$html_text .= '<tr id="4217" style="display:none;vertical-align:top"><td>technical properties</td><td>'.$item->technical->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="4218" style="display:none;vertical-align:top"><td>technical remark_values</td><td>'.$item->technical->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(43)">Billing +/-</button></td><td></td><td id="billing_role"></td></tr>';
	$html_text .= '<tr id="431" style="display:none"><td>billing handle</td><td>'.$item->billing->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="432" style="display:none"><td>billing web_id</td><td>'.$item->billing->web_id.'</td><td></td></tr>';
	$html_text .= '<tr id="433" style="display:none"><td>billing organization</td><td>'.$item->billing->organization.'</td><td></td></tr>';
	$html_text .= '<tr id="434" style="display:none"><td>billing full_name</td><td>'.$item->billing->full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="435" style="display:none"><td>billing kind</td><td>'.$item->billing->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="436" style="display:none"><td>billing name</td><td>'.$item->billing->name.'</td><td></td></tr>';
	$html_text .= '<tr id="437" style="display:none"><td>billing email</td><td>'.$item->billing->email.'</td><td></td></tr>';
	$html_text .= '<tr id="438" style="display:none"><td>billing tel</td><td>'.$item->billing->tel.'</td><td></td></tr>';
	$html_text .= '<tr id="439" style="display:none"><td>billing country_code</td><td>'.$item->billing->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4310" style="display:none"><td>billing street</td><td>'.$item->billing->street.'</td><td></td></tr>';
	$html_text .= '<tr id="4311" style="display:none"><td>billing city</td><td>'.$item->billing->city.'</td><td></td></tr>';
	$html_text .= '<tr id="4312" style="display:none"><td>billing state_province</td><td>'.$item->billing->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="4313" style="display:none"><td>billing postal_code</td><td>'.$item->billing->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4314" style="display:none"><td>billing country_name</td><td>'.$item->billing->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="4315" style="display:none"><td>billing language_pref_1</td><td>'.$item->billing->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4316" style="display:none"><td>billing language_pref_2</td><td>'.$item->billing->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4317" style="display:none"><td>billing shielding</td><td>'.$item->billing->shielding.'</td><td id="billing_shielding"></td></tr>';
	$html_text .= '<tr id="4318" style="display:none;vertical-align:top"><td>billing properties</td><td>'.$item->billing->properties.'</td><td></td></tr>';	
	$html_text .= '<tr id="4319" style="display:none;vertical-align:top"><td>billing remark_values</td><td>'.$item->billing->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(44)">Emergency +/-</button></td><td></td><td id="emergency_role"></td></tr>';
	$html_text .= '<tr id="441" style="display:none"><td>emergency handle</td><td>'.$item->emergency->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="442" style="display:none"><td>emergency web_id</td><td>'.$item->emergency->web_id.'</td><td id="emergency_web_id"></td></tr>';
	$html_text .= '<tr id="443" style="display:none"><td>emergency organization</td><td>'.$item->emergency->organization.'</td><td></td></tr>';
	$html_text .= '<tr id="444" style="display:none"><td>emergency full_name</td><td>'.$item->emergency->full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="445" style="display:none"><td>emergency kind</td><td>'.$item->emergency->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="446" style="display:none"><td>emergency name</td><td>'.$item->emergency->name.'</td><td></td></tr>';
	$html_text .= '<tr id="447" style="display:none"><td>emergency email</td><td>'.$item->emergency->email.'</td><td></td></tr>';
	$html_text .= '<tr id="448" style="display:none"><td>emergency tel</td><td>'.$item->emergency->tel.'</td><td></td></tr>';
	$html_text .= '<tr id="449" style="display:none"><td>emergency country_code</td><td>'.$item->emergency->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4410" style="display:none"><td>emergency street</td><td>'.$item->emergency->street.'</td><td></td></tr>';
	$html_text .= '<tr id="4411" style="display:none"><td>emergency city</td><td>'.$item->emergency->city.'</td><td></td></tr>';
	$html_text .= '<tr id="4412" style="display:none"><td>emergency state_province</td><td>'.$item->emergency->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="4413" style="display:none"><td>emergency postal_code</td><td>'.$item->emergency->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4414" style="display:none"><td>emergency country_name</td><td>'.$item->emergency->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="4415" style="display:none"><td>emergency language_pref_1</td><td>'.$item->emergency->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4416" style="display:none"><td>emergency language_pref_2</td><td>'.$item->emergency->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4417" style="display:none"><td>emergency shielding</td><td>'.$item->emergency->shielding.'</td><td id="emergency_shielding"></td></tr>';
	$html_text .= '<tr id="4418" style="display:none;vertical-align:top"><td>emergency properties</td><td>'.$item->emergency->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="4419" style="display:none;vertical-align:top"><td>emergency remark_values</td><td>'.$item->emergency->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(50)">Reseller +/-</button></td><td></td><td id="reseller_role"></td></tr>';
	$html_text .= '<tr id="501" style="display:none"><td>reseller handle</td><td>'.$item->reseller->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="502" style="display:none"><td>reseller web_id</td><td>'.$item->reseller->web_id.'</td><td id="reseller_web_id"></td></tr>';
	$html_text .= '<tr><td>reseller organization</td><td>'.$item->reseller->organization.'</td><td></td></tr>';
	$html_text .= '<tr><td>reseller full_name</td><td>'.$item->reseller->full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="503" style="display:none"><td>reseller kind</td><td>'.$item->reseller->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="504" style="display:none"><td>reseller name</td><td>'.$item->reseller->name.'</td><td></td></tr>';
	$html_text .= '<tr id="505" style="display:none"><td>reseller email</td><td>'.$item->reseller->email.'</td><td></td></tr>';
	$html_text .= '<tr id="506" style="display:none"><td>reseller tel</td><td>'.$item->reseller->tel.'</td><td></td></tr>';
	$html_text .= '<tr id="507" style="display:none"><td>reseller country_code</td><td>'.$item->reseller->country_code.'</td><td></td></tr>';
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
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(60)">Registrar +/-</button></td><td></td><td id="registrar_role"></td></tr>';
	$html_text .= '<tr id="601" style="display:none"><td>registrar handle</td><td>'.$item->registrar->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="602" style="display:none"><td>registrar web_id</td><td>'.$item->registrar->web_id.'</td><td id="registrar_web_id"></td></tr>';
	$html_text .= '<tr><td>registrar organization</td><td>'.$item->registrar->organization.'</td><td></td></tr>';
	$html_text .= '<tr><td>registrar full_name</td><td>'.$item->registrar->full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="603" style="display:none"><td>registrar kind</td><td>'.$item->registrar->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="604" style="display:none"><td>registrar url</td><td>'.$item->registrar->url.'</td><td></td></tr>';
	$html_text .= '<tr id="605" style="display:none"><td>registrar iana_id</td><td>'.$item->registrar->iana_id.'</td><td id="registrar_iana_id"></td></tr>';
	$html_text .= '<tr id="606" style="display:none"><td>registrar name</td><td>'.$item->registrar->name.'</td><td></td></tr>';
	$html_text .= '<tr id="607" style="display:none"><td>registrar email</td><td>'.$item->registrar->email.'</td><td></td></tr>';
	$html_text .= '<tr id="608" style="display:none"><td>registrar tel</td><td>'.$item->registrar->tel.'</td><td></td></tr>';
	$html_text .= '<tr id="609" style="display:none"><td>registrar country_code</td><td>'.$item->registrar->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6010" style="display:none"><td>registrar street</td><td>'.$item->registrar->street.'</td><td></td></tr>';
	$html_text .= '<tr id="6011" style="display:none"><td>registrar city</td><td>'.$item->registrar->city.'</td><td></td></tr>';
	$html_text .= '<tr id="6012" style="display:none"><td>registrar state_province</td><td>'.$item->registrar->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="6013" style="display:none"><td>registrar postal_code</td><td>'.$item->registrar->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6014" style="display:none"><td>registrar country_name</td><td>'.$item->registrar->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="6015" style="display:none"><td>registrar language_pref_1</td><td>'.$item->registrar->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="6016" style="display:none"><td>registrar language_pref_2</td><td>'.$item->registrar->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="6017" style="display:none"><td>registrar shielding</td><td>'.$item->registrar->shielding.'</td><td id="registrar_shielding"></td></tr>';
	$html_text .= '<tr id="6018" style="display:none;vertical-align:top"><td>registrar status_values</td><td>'.$item->registrar->status_values.'</td><td></td></tr>';
	$html_text .= '<tr id="6019" style="display:none"><td>registrar event_registration</td><td>'.$item->registrar->event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="6020" style="display:none"><td>registrar event_last_transferred</td><td>'.$item->registrar->event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="6021" style="display:none"><td>registrar event_last_changed</td><td>'.$item->registrar->event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr id="6022" style="display:none"><td>registrar event_expiration</td><td>'.$item->registrar->event_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="6023" style="display:none"><td>registrar event_deletion</td><td>'.$item->registrar->event_deletion.'</td><td></td></tr>';
	$html_text .= '<tr id="6024" style="display:none"><td>registrar event_last_uploaded</td><td>'.$item->registrar->event_last_uploaded.'</td><td></td></tr>';
	$html_text .= '<tr id="6025" style="display:none"><td>registrar event_verification_received</td><td>'.$item->registrar->event_verification_received.'</td><td id="registrar_event_verification_received"></td></tr>';
	$html_text .= '<tr id="6026" style="display:none"><td>registrar event_verification_set</td><td>'.$item->registrar->event_verification_set.'</td><td id="registrar_event_verification_set"></td></tr>';
	$html_text .= '<tr id="6027" style="display:none;vertical-align:top"><td>registrar properties</td><td>'.$item->registrar->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="6028" style="display:none;vertical-align:top"><td>registrar remark_values</td><td>'.$item->registrar->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(61)">Registrar Abuse +/-</button></td><td></td><td id="registrar_abuse_role"></td></tr>';
	$html_text .= '<tr id="611" style="display:none"><td>registrar abuse_full_name</td><td>'.$item->registrar->abuse_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="612" style="display:none"><td>registrar abuse_email</td><td>'.$item->registrar->abuse_email.'</td><td></td></tr>';
	$html_text .= '<tr id="613" style="display:none"><td>registrar abuse_tel</td><td>'.$item->registrar->abuse_tel.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(62)">Sponsor +/-</button></td><td></td><td id="sponsor_role"></td></tr>';
	$html_text .= '<tr id="621" style="display:none"><td>sponsor handle</td><td>'.$item->sponsor->handle.'</td><td></td></tr>';
	$html_text .= '<tr id="622" style="display:none"><td>sponsor web_id</td><td>'.$item->sponsor->web_id.'</td><td id="sponsor_web_id"></td></tr>';
	$html_text .= '<tr id="623" style="display:none"><td>sponsor organization</td><td>'.$item->sponsor->organization.'</td><td></td></tr>';
	$html_text .= '<tr id="624" style="display:none"><td>sponsor full_name</td><td>'.$item->sponsor->full_name.'</td><td id="sponsor_recover"></td></tr>';
	$html_text .= '<tr id="625" style="display:none"><td>sponsor kind</td><td>'.$item->sponsor->kind.'</td><td></td></tr>';
	$html_text .= '<tr id="626" style="display:none"><td>sponsor url</td><td>'.$item->sponsor->url.'</td><td></td></tr>';
	$html_text .= '<tr id="627" style="display:none"><td>sponsor iana_id</td><td>'.$item->sponsor->iana_id.'</td><td></td></tr>';
	$html_text .= '<tr id="628" style="display:none"><td>sponsor name</td><td>'.$item->sponsor->name.'</td><td></td></tr>';
	$html_text .= '<tr id="629" style="display:none"><td>sponsor email</td><td>'.$item->sponsor->email.'</td><td></td></tr>';
	$html_text .= '<tr id="6210" style="display:none"><td>sponsor tel</td><td>'.$item->sponsor->tel.'</td><td></td></tr>';
	$html_text .= '<tr id="6211" style="display:none"><td>sponsor country_code</td><td>'.$item->sponsor->country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6212" style="display:none"><td>sponsor street</td><td>'.$item->sponsor->street.'</td><td></td></tr>';
	$html_text .= '<tr id="6213" style="display:none"><td>sponsor city</td><td>'.$item->sponsor->city.'</td><td></td></tr>';
	$html_text .= '<tr id="6214" style="display:none"><td>sponsor state_province</td><td>'.$item->sponsor->state_province.'</td><td></td></tr>';
	$html_text .= '<tr id="6215" style="display:none"><td>sponsor postal_code</td><td>'.$item->sponsor->postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6216" style="display:none"><td>sponsor country_name</td><td>'.$item->sponsor->country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="6217" style="display:none"><td>sponsor language_pref_1</td><td>'.$item->sponsor->language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="6218" style="display:none"><td>sponsor language_pref_2</td><td>'.$item->sponsor->language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="6219" style="display:none"><td>sponsor shielding</td><td>'.$item->sponsor->shielding.'</td><td></td></tr>';
	$html_text .= '<tr id="6220" style="display:none;vertical-align:top"><td>sponsor status_values</td><td>'.$item->sponsor->status_values.'</td><td></td></tr>';
	$html_text .= '<tr id="6221" style="display:none"><td>sponsor event_registration</td><td>'.$item->sponsor->event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="6222" style="display:none"><td>sponsor event_last_transferred</td><td>'.$item->sponsor->event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="6223" style="display:none"><td>sponsor event_last_changed</td><td>'.$item->sponsor->event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr id="6224" style="display:none"><td>sponsor event_expiration</td><td>'.$item->sponsor->event_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="6225" style="display:none"><td>sponsor event_deletion</td><td>'.$item->sponsor->event_deletion.'</td><td></td></tr>';
	$html_text .= '<tr id="6226" style="display:none"><td>sponsor event_last_uploaded</td><td>'.$item->sponsor->event_last_uploaded.'</td><td></td></tr>';
	$html_text .= '<tr id="6227" style="display:none"><td>sponsor event_verification_received</td><td>'.$item->sponsor->event_verification_received.'</td><td id="sponsor_event_verification_received"></td></tr>';
	$html_text .= '<tr id="6228" style="display:none"><td>sponsor event_verification_set</td><td>'.$item->sponsor->event_verification_set.'</td><td id="sponsor_event_verification_set"></td></tr>';
	$html_text .= '<tr id="6229" style="display:none;vertical-align:top"><td>sponsor properties</td><td>'.$item->sponsor->properties.'</td><td></td></tr>';
	$html_text .= '<tr id="6230" style="display:none;vertical-align:top"><td>sponsor remark_values</td><td>'.$item->sponsor->remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(63)">Name Servers +/-</button></td><td></td><td></td></tr>';
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
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(70)">Whois Data +/-</button></td><td colspan="2"></td></tr>';
	$html_text .= '<tr id="701" style="display:none"><td colspan="3">'.$item->raw_whois_data.'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(75)">RDAP Data +/-</button> (<a style="font-size: 0.9rem" href='.$item->rdap_url.' target="_blank">in JSON format</a>)</td><td id="raw_data_next" colspan="2"></td></tr>';
	$html_text .= '<tr id="751" style="display:none"><td colspan="3">'.$item->raw_rdap_data.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>