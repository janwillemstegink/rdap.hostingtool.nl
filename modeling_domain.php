<?php
session_start();  // is needed with no Scriptcase PHP Generator
echo '<!DOCTYPE html><html lang="en" style="font-size: 90%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>Domain Data</title>';
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
	else if (type == 30)	{ // domain
		var pre = '30';
		var max = 11
	}
	else if (type == 40)	{ // registrant
		var pre = '40';
		var max = 22
	}
	else if (type == 41)	{ // admin
		var pre = '41';
		var max = 14
	}
	else if (type == 42)	{ // tech
		var pre = '42';
		var max = 14
	}
	else if (type == 43)	{ // billing
		var pre = '43';
		var max = 15
	}
	else if (type == 44)	{ // emergency
		var pre = '44';
		var max = 15
	}
	else if (type == 50)	{ // reseller
		var pre = '50';
		var max = 24
	}	
	else if (type == 60)	{ // registrar
		var pre = '60';
		var max = 26
	}
	else if (type == 61)	{ // abuse
		var pre = '61';
		var max = 1
	}
	else if (type == 62)	{ // sponsor
		var pre = '62';
		var max = 26
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
		document.getElementById("title").textContent = "Domain Data";
		document.getElementById("subtitle").textContent = "(modeled data)";
		document.getElementById("instruction").textContent = "Paste a domain name and press Enter.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "";
		document.getElementById("zone_role").textContent = "";
		document.getElementById("zone_registry_web_id").textContent = proposed;
		document.getElementById("zone_registry_full_name").textContent = proposed;
		document.getElementById("zone_registry_website").textContent = proposed;
		document.getElementById("zone_menu").textContent = proposed;
		document.getElementById("zone_support").textContent = proposed;
		document.getElementById("notices").textContent = "";
		document.getElementById("links").textContent = "";
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
		document.getElementById("registrant_full_name").textContent = "";
		document.getElementById("registrant_kind").textContent = "";
		document.getElementById("registrant_name").textContent = "";
		document.getElementById("registrant_country_code").textContent = "";
		document.getElementById("registrant_protected").textContent = proposed;
		document.getElementById("registrant_event_verification_received").textContent = proposed;
		document.getElementById("registrant_event_verification_set").textContent = proposed;
		document.getElementById("admin_role").textContent = "";
		document.getElementById("admin_web_id").textContent = proposed;
		document.getElementById("admin_protected").textContent = proposed;
		document.getElementById("tech_role").textContent = "";
		document.getElementById("tech_web_id").textContent = proposed;
		document.getElementById("tech_protected").textContent = proposed;
		document.getElementById("billing_role").textContent = "";
		document.getElementById("billing_protected").textContent = proposed;
		document.getElementById("emergency_role").textContent = "";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_protected").textContent = proposed;
		document.getElementById("reseller_role").textContent = "";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_protected").textContent = proposed;
		document.getElementById("reseller_event_verification_received").textContent = proposed;
		document.getElementById("reseller_event_verification_set").textContent = proposed;
		document.getElementById("registrar_role").textContent = "";
		document.getElementById("registrar_recover").textContent = "";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_iana_id").textContent = "";
		document.getElementById("registrar_protected").textContent = proposed;
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
		document.getElementById("title").textContent = "Domeingegevens";
		document.getElementById("subtitle").textContent = "(gemodelleerde data)";
		document.getElementById("instruction").textContent = "Plak een domeinnaam en druk op Enter.";
		document.getElementById("field").textContent = "Omschrijving";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Webdomeinen toegelicht";
		document.getElementById("zone_role").textContent = "Een domeinzone is door de ICANN toegewezen aan een domain registry om domeinen te beheren.";
		document.getElementById("zone_registry_web_id").textContent = proposed;
		document.getElementById("zone_registry_full_name").textContent = proposed;
		document.getElementById("zone_registry_website").textContent = proposed;
		document.getElementById("zone_menu").textContent = proposed + "Een vervolgkeuzemenu met uitleg en details, bijvoorbeeld via een subdomein van de registry.";
		document.getElementById("zone_support").textContent = proposed + "Hulp vanuit de registry is mogelijk per e-mail.";
		document.getElementById("notices").textContent = "Het gebruik van domeingegevens is aan beperkingen onderhevig.";
		document.getElementById("links").textContent = "Gepland: Web-ID-zoekopdrachten kunnen worden uitgevoerd op wereldwijde RDAP-servers.";
		document.getElementById("domain_role").textContent = "Een webdomein onder een topleveldomein is wereldwijd uniek en onder bepaalde regels vrij te kiezen.";
		document.getElementById("domain_name_ascii").textContent = "Namen met speciale tekens in ASCII-tekenreeksen gebruiken Punycode-transcriptie.";
		document.getElementById("domain_name_unicode").textContent = "In het RDAP-protocol is de domeinnaam in Unicode optioneel, maar het is wel duidelijke informatie.";
		document.getElementById("domain_status_values").textContent = "De waarde 'redemption period' is info over herstel. De waarde 'pending delete' is van toepassing in de laatste fase.";
		document.getElementById("domain_event_expiration").textContent = "Datum en tijdstip van periodieke verlenging of stopzetting van de publicatie.";
		document.getElementById("domain_event_recovery_until").textContent = proposed + "Datum en tijdstip tot wanneer herstel nog mogelijk is.";		
		document.getElementById("domain_event_deletion").textContent = "Datum en tijdstip gepland voor volledige verwijdering. Er kan een laatste verwijderingsfase zijn.";
		document.getElementById("domain_event_last_uploaded").textContent = "Datum en tijdstip van de RDAP-database-update in Zoeloe-tijd (Coordinated Universal Time - UTC).";
		document.getElementById("domain_extensions_values").textContent = "'Eligibility': Hoe een domein voldoet aan een specifieke vereiste in een topleveldomeinzone.";
		document.getElementById("registrant_role").textContent = "De domeinhouder is primair verantwoordelijk en heeft het abonnement op zijn domein.";
		document.getElementById("registrant_web_id").textContent = proposed + "Webidentificatienummer voor bedrijfsentiteiten en natuurlijke personen.";
		document.getElementById("registrant_full_name").textContent = "De domeingebruiker die de daadwerkelijke of effectieve controle heeft voor domeinrecht in het land van vestiging.";
		document.getElementById("registrant_kind").textContent = "Leeg / 'org' / 'individual' (relevant: levenstestament, testament en digitale executeur)";
		document.getElementById("registrant_name").textContent = "In het RDAP-protocol kan een persoonlijke naam zichtbaar zijn in het veld 'full_name', zie cira.ca.";
		document.getElementById("registrant_country_code").textContent = "De ISO-2-landcode-indexering werkt, bijvoorbeeld voor het Verenigd Koninkrijk, dat de EU heeft verlaten.";
		document.getElementById("registrant_protected").textContent = proposed + "Zonespecifieke verborgen gegevens variëren afhankelijk van het gebruik van een adres.";
		document.getElementById("registrant_event_verification_received").textContent = proposed + "De verantwoordelijke persoon kan een identieke web-ID aanklikken; leeg is intrekking.";
		document.getElementById("registrant_event_verification_set").textContent = proposed + "Vervolgens controleert het register de gegevens bij de landspecifieke webdomeindienst.";
		document.getElementById("admin_role").textContent = "Het administratief aanspreekpunt beantwoordt een verzoek en stuurt zo nodig door.";
		document.getElementById("admin_web_id").textContent = proposed;
		document.getElementById("admin_protected").textContent = proposed;
		document.getElementById("tech_role").textContent = "Een technisch contact reageert om een gemelde storing op te lossen.";
		document.getElementById("tech_web_id").textContent = proposed;
		document.getElementById("tech_protected").textContent = proposed;
		document.getElementById("billing_role").textContent = "Sommige domain registries houden gegevens bij om hun facturering uit te voeren.";
		document.getElementById("billing_protected").textContent = proposed;
		document.getElementById("emergency_role").textContent = proposed + "Een verantwoordelijke persoon kan de benodigde toegang verlenen.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_protected").textContent = proposed;
		document.getElementById("reseller_role").textContent = "De domeinreseller is als tweede verantwoordelijk, ook afhankelijk van de overeenkomst en de regelgeving.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_protected").textContent = proposed;
		document.getElementById("reseller_event_verification_received").textContent = proposed;
		document.getElementById("reseller_event_verification_set").textContent = proposed;
		document.getElementById("registrar_role").textContent = "De domeinregistrar is verantwoordelijk voor domeinreserveringen en IP-adresroutering.";
		document.getElementById("registrar_recover").textContent = "Herstel binnen de 'redemption period' is ook bij een andere domeinregistrar mogelijk.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_iana_id").textContent = "In het geval van ICANN-accreditatie, voor één of meer generieke topleveldomeinen. En moet juist zijn.";
		document.getElementById("registrar_protected").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_abuse_role").textContent = "Misbruikinformatie vergemakkelijkt het contact opnemen met de registrar door een derde partij.";
		document.getElementById("sponsor_role").textContent = "In het geval van een sponsor is deze entiteit verantwoordelijk voor het beheer van de domeinregistratie.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is een web-route-beveiligingsvoorziening op het DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Een DNSSEC-algoritme vanaf versie 13 is up-to-date.";
		document.getElementById("name_servers_ip").textContent = "IP-waarden in een glue record alleen als de nameservers van de registrar niet worden gebruikt.";
		document.getElementById("br_zone").textContent = "Zone .br: De RDAP-gegevens zijn aangepast met nameservervalidatie.";

		document.getElementById("raw_data_next").textContent = "Deze tool toont een op verantwoordelijkheid gebaseerde veldvolgorde, de standaardwaarde 'hidden' en unieke veldnamen voor weergave.";	
	et }
	else if (translation == 2)	{
		var proposed = 'PROPOSED - ';
		document.getElementById("title").textContent = "Domain Data";
		document.getElementById("subtitle").textContent = "(modeled data)";
		document.getElementById("instruction").textContent = "Paste a domain name and press Enter.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Web Domains Explained";		
		document.getElementById("zone_role").textContent = "A domain zone is assigned by ICANN to a domain registry to manage domains.";
		document.getElementById("zone_registry_web_id").textContent = proposed;
		document.getElementById("zone_registry_full_name").textContent = proposed;
		document.getElementById("zone_registry_website").textContent = proposed;
		document.getElementById("zone_menu").textContent = proposed + "A drop-down menu with explanations and details, for example via a subdomain of the registry.";
		document.getElementById("zone_support").textContent = proposed + "Help from the registry is possible by e-mail.";
		document.getElementById("notices").textContent = "The use of domain data is subject to restrictions.";
		document.getElementById("links").textContent = "Planned: Web ID searches can be performed on global RDAP servers.";
		document.getElementById("domain_role").textContent = "A web domain under a top-level domain is unique worldwide and can be freely chosen under certain rules.";
		document.getElementById("domain_name_ascii").textContent = "Names containing special characters in ASCII strings use Punycode transcription.";
		document.getElementById("domain_name_unicode").textContent = "In the RDAP protocol, the domain name in Unicode is optional, but it is clear information.";
		document.getElementById("domain_status_values").textContent = "The 'redemption period' value is info about recovery. The 'pending delete' value applies in the final phase.";
		document.getElementById("domain_event_expiration").textContent = "Date and time of periodic renewal or discontinuation of publication.";
		document.getElementById("domain_event_recovery_until").textContent = proposed + "Date and time until which recovery is still possible.";
		document.getElementById("domain_event_deletion").textContent = "Date and time scheduled for complete deletion. A final deletion phase may exist.";
		document.getElementById("domain_event_last_uploaded").textContent = "Date and time of RDAP database update in Zulu time (Coordinated Universal Time - UTC).";
		document.getElementById("domain_extensions_values").textContent = "'Eligibility': How a domain fulfills a specific requirement in a top-level domain zone.";
		document.getElementById("registrant_role").textContent = "The domain owner is primarily responsible and has the subscription to his domain.";
		document.getElementById("registrant_web_id").textContent = proposed + "Web Identification number for business entities and natural persons.";
		document.getElementById("registrant_full_name").textContent = "The domain user who has the actual or effective control for domain rights in the country of establishment.";
		document.getElementById("registrant_kind").textContent = "Empty / 'org' / 'individual' (relevant: living will, will and digital executor)";
		document.getElementById("registrant_name").textContent = "In the RDAP protocol, a personal name may be visible in the 'full_name' field, see cira.ca.";
		document.getElementById("registrant_country_code").textContent = "ISO-2 country code indexing works, as for the United Kingdom, which has left the EU.";
		document.getElementById("registrant_protected").textContent = proposed + "Zone Specific hidden data varies depending on the use of an address.";
		document.getElementById("registrant_event_verification_received").textContent = proposed + "The responsible person can click on an identical web ID; empty is revocation.";
		document.getElementById("registrant_event_verification_set").textContent = proposed + "The registry then checks the data with the country-specific web domain service.";	
		document.getElementById("admin_role").textContent = "The administratively responsible desk answers a request, and forwards on if necessary.";
		document.getElementById("admin_web_id").textContent = proposed;
		document.getElementById("admin_protected").textContent = proposed;
		document.getElementById("tech_role").textContent = "A technical contact responds to resolve a reported malfunction.";
		document.getElementById("tech_web_id").textContent = proposed;
		document.getElementById("tech_protected").textContent = proposed;
		document.getElementById("billing_role").textContent = "Some domain registries maintain records to perform their billing.";
		document.getElementById("billing_protected").textContent = proposed;
		document.getElementById("emergency_role").textContent = proposed + "A responsible person can provide the necessary access.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_protected").textContent = proposed;
		document.getElementById("reseller_role").textContent = "The domain reseller is secondly responsible, also depending on the agreement and regulations.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_protected").textContent = proposed;
		document.getElementById("reseller_event_verification_received").textContent = proposed;
		document.getElementById("reseller_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_role").textContent = "The domain registrar is responsible for domain reservations and IP address routing.";
		document.getElementById("registrar_recover").textContent = "Recovery within the 'redemption period' is also possible with another domain registrar.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_iana_id").textContent = "In case of ICANN accreditation, for one or more generic top-level domains. And must be correct.";
		document.getElementById("registrar_protected").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_abuse_role").textContent = "Abuse information facilitates contacting the registrar by a third party.";
		document.getElementById("sponsor_role").textContent = "In the case of a sponsor, this entity is responsible for managing the domain registration.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is a web route security feature on the DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "A DNSSEC algorithm starting from version 13 is up-to-date.";
		document.getElementById("name_servers_ip").textContent = "IP values in a glue record only if the registrar's name servers are not used.";
		document.getElementById("br_zone").textContent = "Zone .br: The RDAP data has been modified with name server validation.";
		document.getElementById("raw_data_next").textContent = "This tool shows a responsibility based field order, the default value 'hidden', and unique field names for display.";
	}
	else if (translation == 3)	{
		var proposed = 'VORGESCHLAGEN - ';
		document.getElementById("title").textContent = "Domänendaten";
		document.getElementById("subtitle").textContent = "(modellierte Daten)";
		document.getElementById("instruction").textContent = "Fügen Sie einen Domänennamen ein und drücken Sie die Eingabetaste.";
		document.getElementById("field").textContent = "Beschreibung";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Webdomänen erklärt";		
		document.getElementById("zone_role").textContent = "Eine Domänenzone wird von ICANN einer Domänenregistrierungsstelle zugewiesen, um Domänen zu verwalten.";		
		document.getElementById("zone_registry_web_id").textContent = proposed;
		document.getElementById("zone_registry_full_name").textContent = proposed;
		document.getElementById("zone_registry_website").textContent = proposed;
		document.getElementById("zone_menu").textContent = proposed + "Ein Dropdown-Menü mit Erläuterungen und Details, z. B. über eine Subdomain der Registry.";
		document.getElementById("zone_support").textContent = proposed + "Hilfe aus der Registry ist per E-Mail möglich.";
		document.getElementById("notices").textContent = "Die Nutzung der Domaindaten unterliegt Einschränkungen.";
		document.getElementById("links").textContent = "Geplant: Web-ID-Suchen können auf globalen RDAP-Servern durchgeführt werden.";
		document.getElementById("domain_role").textContent = "Eine Webdomain unter einer Top-Level-Domain ist weltweit einzigartig und unter bestimmten Regeln frei wählbar.";
		document.getElementById("domain_name_ascii").textContent = "Namen, die Sonderzeichen in ASCII-Zeichenfolgen enthalten, verwenden die Punycode-Transkription.";
		document.getElementById("domain_name_unicode").textContent = "Im RDAP-Protokoll ist der Domänenname in Unicode optional, stellt jedoch eine eindeutige Information dar.";
		document.getElementById("domain_status_values").textContent = "Der Wert 'redemption period' ist Info zur Wiederherstellung. Der Wert 'pending delete' gilt in der Endphase.";
		document.getElementById("domain_event_expiration").textContent = "Datum und Uhrzeit der periodischen Erneuerung oder Einstellung der Veröffentlichung.";
		document.getElementById("domain_event_recovery_until").textContent = proposed + "Datum und Uhrzeit, bis zu denen eine Wiederherstellung noch möglich ist.";
		document.getElementById("domain_event_deletion").textContent = "Datum und Uhrzeit für die vollständige Löschung geplant. Es kann eine abschließende Löschphase geben.";
		document.getElementById("domain_event_last_uploaded").textContent = "Datum und Uhrzeit der RDAP-Datenbankaktualisierung in Zulu-Zeit (Koordinierte Weltzeit – UTC).";
		document.getElementById("domain_extensions_values").textContent = "'Eligibility': Wie eine Domäne eine bestimmte Anforderung in einer Top-Level-Domänenzone erfüllt.";
		document.getElementById("registrant_role").textContent = "Der Domaininhaber ist hauptverantwortlich und hat das Abonnement für seine Domain.";
		document.getElementById("registrant_web_id").textContent = proposed + "Web-Identifikationsnummer für Unternehmen und natürliche Personen.";
		document.getElementById("registrant_full_name").textContent = "Der Domänenbenutzer, der die tatsächliche oder effektive Kontrolle hat für Domainrechte im Wohnsitzland.";
		document.getElementById("registrant_kind").textContent = "Leer / 'org' / 'individual' (relevant: Patientenverfügung, Testament und Testamentsvollstrecker)";
		document.getElementById("registrant_name").textContent = "Im RDAP-Protokoll kann im Feld 'full_name' ein Personenname sichtbar sein, siehe cira.ca";
		document.getElementById("registrant_country_code").textContent = "Die Indizierung mit dem ISO-2-Ländercode funktioniert, wie für das Vereinigte Königreich, das die EU verlassen hat.";
		document.getElementById("registrant_protected").textContent = proposed + "Zonenspezifische versteckte Daten variieren je nach Verwendung einer Adresse.";
		document.getElementById("registrant_event_verification_received").textContent = proposed + "Der Verantwortliche kann auf eine identische Web-ID klicken; leer ist Rückzug.";
		document.getElementById("registrant_event_verification_set").textContent = proposed + "Anschließend gleicht die Registry die Daten beim länderspezifischen Webdomain-Dienst ab.";
		document.getElementById("admin_role").textContent = "Die administrativ zuständige Stelle beantwortet eine Anfrage und leitet sie gegebenenfalls weiter.";
		document.getElementById("admin_web_id").textContent = proposed;
		document.getElementById("admin_protected").textContent = proposed;
		document.getElementById("tech_role").textContent = "Ein technischer Kontakt reagiert, um eine gemeldete Störung zu beheben.";
		document.getElementById("tech_web_id").textContent = proposed;
		document.getElementById("tech_protected").textContent = proposed;
		document.getElementById("billing_role").textContent = "Einige Domänenregistrierungen führen Aufzeichnungen, um ihre Abrechnung durchzuführen.";
		document.getElementById("billing_protected").textContent = proposed;
		document.getElementById("emergency_role").textContent = proposed + "Die erforderlichen Zugänge kann eine verantwortliche Person bereitstellen.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_protected").textContent = proposed;
		document.getElementById("reseller_role").textContent = "In zweiter Linie ist der Domain-Reseller, ebenfalls je nach Vereinbarung und Regelungen, verantwortlich.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_protected").textContent = proposed;
		document.getElementById("reseller_event_verification_received").textContent = proposed;
		document.getElementById("reseller_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_role").textContent = "Der Domänenregistrar ist für die Domänenreservierung und das IP-Adressrouting verantwortlich.";
		document.getElementById("registrar_recover").textContent = "Eine Wiederherstellung innerhalb der 'redemption period' ist auch bei einem anderen Domain-Registrar möglich.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_iana_id").textContent = "Im Falle einer ICANN-Akkreditierung für eine oder mehrere generische Top-Level-Domains. Und muss korrekt sein.";
		document.getElementById("registrar_protected").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_abuse_role").textContent = "Missbrauchsinformationen erleichtern die Kontaktaufnahme mit dem Registrar durch Dritte.";
		document.getElementById("sponsor_role").textContent = "Im Falle eines Sponsors ist diese Entität für die Verwaltung der Domänenregistrierung verantwortlich.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC ist eine Sicherheitsfunktion für Webrouten im DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Ein DNSSEC-Algorithmus ab Version 13 ist auf dem neuesten Stand.";
		document.getElementById("name_servers_ip").textContent = "IP-Werte in einem Glue-Record nur, wenn die Nameserver des Registrars nicht verwendet werden.";
		document.getElementById("br_zone").textContent = "Zone .br: Die RDAP-Daten wurden mit der Nameserver-Validierung angepasst.";
		document.getElementById("raw_data_next").textContent = "Dieses Tool zeigt eine verantwortungsbasierte Feldreihenfolge an, dem Standardwert 'hidden' und eindeutigen Feldnamen für die Anzeige.";
	}
	else if (translation == 4)	{
		var proposed = 'PROPOSÉ - ';
		document.getElementById("title").textContent = "Données du domaine";
		document.getElementById("subtitle").textContent = "(données modélisées)";
		document.getElementById("instruction").textContent = "Collez un nom de domaine et appuyez sur Entrée.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Détail";
		document.getElementById("explanation").textContent = "Domaines Web expliqués";		
		document.getElementById("zone_role").textContent = "Une zone de domaine est attribuée par l'ICANN à un registre de domaine pour gérer les domaines.";
		document.getElementById("zone_registry_web_id").textContent = proposed;
		document.getElementById("zone_registry_full_name").textContent = proposed;
		document.getElementById("zone_registry_website").textContent = proposed;
		document.getElementById("zone_menu").textContent = proposed + "Un menu déroulant avec explication et détails, par exemple via un sous-domaine du registre.";
		document.getElementById("zone_support").textContent = proposed + "L'aide du registre est possible par e-mail.";
		document.getElementById("notices").textContent = "L'utilisation des données de domaine est soumise à des restrictions.";
		document.getElementById("links").textContent = "Prévu : Les recherches d’identifiant Web peuvent être effectuées sur des serveurs RDAP mondiaux.";
		document.getElementById("domain_role").textContent = "Un domaine Web sous un domaine de premier niveau est unique au monde et peut être choisi librement selon certaines règles.";
		document.getElementById("domain_name_ascii").textContent = "Les noms contenant des caractères spéciaux dans les chaînes ASCII utilisent la transcription Punycode.";
		document.getElementById("domain_name_unicode").textContent = "Dans le protocole RDAP, le nom de domaine en Unicode est facultatif, mais il s'agit d'une information claire.";
		document.getElementById("domain_status_values").textContent = "La valeur 'redemption period' est infos de récupération. La valeur 'pending delete' s'applique dans la phase finale.";
		document.getElementById("domain_event_expiration").textContent = "Date et heure du renouvellement périodique ou de l'arrêt de la publication.";
		document.getElementById("domain_event_recovery_until").textContent = proposed + "Date et heure jusqu'à laquelle la récupération est encore possible.";
		document.getElementById("domain_event_deletion").textContent = "Date et heure prévues pour la suppression complète. Une phase de suppression finale peut exister.";
		document.getElementById("domain_event_last_uploaded").textContent = "Date et heure de mise à jour de la base de données RDAP en heure Zulu (temps universel coordonné - UTC).";
		document.getElementById("domain_extensions_values").textContent = "'Eligibility' : comment un domaine répond à une exigence spécifique dans une zone de domaine de premier niveau.";
		document.getElementById("registrant_role").textContent = "Le propriétaire d'un domaine est le premier responsable et titulaire de l'abonnement à son domaine.";
		document.getElementById("registrant_web_id").textContent = proposed + "Numéro d’identification Web pour les entités commerciales et les personnes physiques.";
		document.getElementById("registrant_full_name").textContent = "L'utilisateur du domaine qui a le contrôle réel ou effectif pour les droits de domaine dans le pays de résidence.";
		document.getElementById("registrant_kind").textContent = "Vide / 'org' / 'individual' (pertinent : testament de vie, testament et exécuteur testamentaire numérique)";
		document.getElementById("registrant_name").textContent = "Dans le protocole RDAP, un nom personnel peut être visible dans le champ 'full_name', voir cira.ca.";
		document.getElementById("registrant_country_code").textContent = "L'indexation des codes pays ISO-2 fonctionne, comme pour le Royaume-Uni, qui a quitté l'UE.";
		document.getElementById("registrant_protected").textContent = proposed + "Les données cachées spécifiques à la zone varient en fonction de l'utilisation d'une adresse.";
		document.getElementById("registrant_event_verification_received").textContent = proposed + "La personne responsable peut cliquer sur un identifiant Web identique ; le vide est le retrait.";
		document.getElementById("registrant_event_verification_set").textContent = proposed + "Le registre vérifie ensuite les données avec le service de domaine Web spécifique au pays.";
		document.getElementById("admin_role").textContent = "Le bureau administrativement responsable répond à une demande, et la transmet si nécessaire.";
		document.getElementById("admin_web_id").textContent = proposed;
		document.getElementById("admin_protected").textContent = proposed;
		document.getElementById("tech_role").textContent = "Un contact technique répond pour résoudre un dysfonctionnement signalé.";
		document.getElementById("tech_web_id").textContent = proposed;
		document.getElementById("tech_protected").textContent = proposed;
		document.getElementById("billing_role").textContent = "Certains registres de domaine conservent des enregistrements pour effectuer leur facturation.";
		document.getElementById("billing_protected").textContent = proposed;
		document.getElementById("emergency_role").textContent = proposed + "Une personne responsable peut fournir l'accès nécessaire.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_protected").textContent = proposed;
		document.getElementById("reseller_role").textContent = "Le revendeur de domaine est en second lieu responsable, également en fonction de l'accord et des réglementations.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_protected").textContent = proposed;
		document.getElementById("reseller_event_verification_received").textContent = proposed;
		document.getElementById("reseller_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_role").textContent = "Le registraire de domaine est responsable des réservations de domaines et du routage des adresses IP.";
		document.getElementById("registrar_recover").textContent = "La récupération pendant la 'redemption period' est également possible auprès d'un autre registraire de domaine.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_iana_id").textContent = "En cas d'accréditation ICANN, pour un ou plusieurs domaines génériques de premier niveau. Et doit être correct.";
		document.getElementById("registrar_protected").textContent = proposed;
		document.getElementById("registrar_event_verification_received").textContent = proposed;
		document.getElementById("registrar_event_verification_set").textContent = proposed;		
		document.getElementById("registrar_abuse_role").textContent = "Les informations sur les abus facilitent la prise de contact avec le bureau d'enregistrement par un tiers.";
		document.getElementById("sponsor_role").textContent = "Dans le cas d'un sponsor, cette entité est responsable de la gestion de l'enregistrement du domaine.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC est une fonctionnalité de sécurité de route Web sur le DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Un algorithme DNSSEC à partir de la version 13 est à jour.";
		document.getElementById("name_servers_ip").textContent = "Valeurs IP dans un enregistrement de colle uniquement si les serveurs de noms du registraire ne sont pas utilisés.";
		document.getElementById("br_zone").textContent = "Zone .br: Les données RDAP ont été ajustées avec la validation du serveur de noms.";
		document.getElementById("raw_data_next").textContent = "Cet outil affiche un ordre de champ basé sur la responsabilité, la valeur par défaut 'hidden' et des noms de champ uniques pour l'affichage.";
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
	<input type="text" style="width:90%" id="domain" name="domain" value='.$viewdomain.'></form>
	<label for="domain">biz/com/net/org/ca/ch/de/fr/nl/frl/uk/amsterdam/politie</label></td><td>
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(0)">None</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(1)">nl_NL</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(2)">en_US</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(3)">de_DE</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(4)">fr_FR</button> 
	<a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_email" target="_blank">modeling email</a> - <a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_menu" target="_blank">modeling menu</a> - <a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap.hostingtool.nl/issues" target="_blank">issues on GitHub</a> - <a style="font-size: 0.9rem" href="https://janwillemstegink.nl/" target="_blank">janwillemstegink.nl</a></td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr style="font-size:1.05rem;font-weight:bold"><td id="field"></td><td id="value"><td id="explanation"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(10)">Zone Information +/-</button></td><td><b>'.$item->zone->zone_top_level_domain.'</b></td><td id="zone_role"></td></tr>';
	$html_text .= '<tr id="101" style="display:none"><td>zone_registry_web_id</td><td>'.$item->zone->zone_registry_web_id.'</td><td id="zone_registry_web_id"></td></tr>';
	$html_text .= '<tr id="102" style="display:none"><td>zone_registry_full_name</td><td>'.$item->zone->zone_registry_full_name.'</td><td id="zone_registry_full_name"></td></tr>';
	$html_text .= '<tr id="103" style="display:none"><td>zone_registry_language</td><td>'.$item->zone->zone_registry_language.'</td><td></td></tr>';
	$html_text .= '<tr id="104" style="display:none"><td>zone_registry_website</td><td>'.$item->zone->zone_registry_website.'</td><td id="zone_registry_website"></td></tr>';
	$html_text .= '<tr id="105" style="display:none"><td>zone_menu</td><td>'.$item->zone->zone_menu.'</td><td id="zone_menu"></td></tr>';
	$html_text .= '<tr id="106" style="display:none"><td>zone_support</td><td>'.$item->zone->zone_support.'</td><td id="zone_support"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(11)">Notice0 +/-</button> <button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(12)">Notice1 +/-</button> <button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(13)">Notice2 +/-</button> <button style="cursor:pointer;font-size:.85rem" onclick="SwitchDisplay(14)">Notice3 +/-</button></td><td></td><td id="notices"></td></tr>';
	$html_text .= '<tr id="111" style="display:none;vertical-align:top"><td>notice_0_title</td><td>'.$item->zone->notice_0_title.'</td><td></td></tr>';
	$html_text .= '<tr id="112" style="display:none;vertical-align:top"><td>notice_0_description_0</td><td>'.$item->zone->notice_0_description_0.'</td><td></td></tr>';
	$html_text .= '<tr id="113" style="display:none;vertical-align:top"><td>notice_0_description_1</td><td>'.$item->zone->notice_0_description_1.'</td><td></td></tr>';
	$html_text .= '<tr id="114" style="display:none;vertical-align:top"><td>notice_0_links_0_href</td><td>'.$item->zone->notice_0_links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="115" style="display:none;vertical-align:top"><td>notice_0_links_0_type</td><td>'.$item->zone->notice_0_links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr id="121" style="display:none;vertical-align:top"><td>notice_1_title</td><td>'.$item->zone->notice_1_title.'</td><td></td></tr>';
	$html_text .= '<tr id="122" style="display:none;vertical-align:top"><td>notice_1_description_0</td><td>'.$item->zone->notice_1_description_0.'</td><td></td></tr>';
	$html_text .= '<tr id="123" style="display:none;vertical-align:top"><td>notice_1_description_1</td><td>'.$item->zone->notice_1_description_1.'</td><td></td></tr>';
	$html_text .= '<tr id="124" style="display:none;vertical-align:top"><td>notice_1_links_0_href</td><td>'.$item->zone->notice_1_links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="125" style="display:none;vertical-align:top"><td>notice_1_links_0_type</td><td>'.$item->zone->notice_1_links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr id="131" style="display:none;vertical-align:top"><td>notice_2_title</td><td>'.$item->zone->notice_2_title.'</td><td></td></tr>';
	$html_text .= '<tr id="132" style="display:none;vertical-align:top"><td>notice_2_description_0</td><td>'.$item->zone->notice_2_description_0.'</td><td></td></tr>';
	$html_text .= '<tr id="133" style="display:none;vertical-align:top"><td>notice_2_description_1</td><td>'.$item->zone->notice_2_description_1.'</td><td></td></tr>';
	$html_text .= '<tr id="134" style="display:none;vertical-align:top"><td>notice_2_links_0_href</td><td>'.$item->zone->notice_2_links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="135" style="display:none;vertical-align:top"><td>notice_2_links_0_type</td><td>'.$item->zone->notice_2_links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr id="141" style="display:none;vertical-align:top"><td>notice_3_title</td><td>'.$item->zone->notice_3_title.'</td><td></td></tr>';
	$html_text .= '<tr id="142" style="display:none;vertical-align:top"><td>notice_3_description_0</td><td>'.$item->zone->notice_3_description_0.'</td><td></td></tr>';
	$html_text .= '<tr id="143" style="display:none;vertical-align:top"><td>notice_3_description_1</td><td>'.$item->zone->notice_3_description_1.'</td><td></td></tr>';
	$html_text .= '<tr id="144" style="display:none;vertical-align:top"><td>notice_3_links_0_href</td><td>'.$item->zone->notice_3_links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="145" style="display:none;vertical-align:top"><td>notice_3_links_0_type</td><td>'.$item->zone->notice_3_links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(20)">Links0 +/-</button> <button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(21)">Links1 +/-</button> <button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(22)">Links2 +/-</button> <button style="cursor:pointer;font-size:.95rem" onclick="SwitchDisplay(23)">Links3 +/-</button></td><td></td><td id="links"></td></tr>';
	$html_text .= '<tr id="201" style="display:none;vertical-align:top"><td>links_0_value</td><td>'.$item->view->links_0_value.'</td><td></td></tr>';
	$html_text .= '<tr id="202" style="display:none;vertical-align:top"><td>links_0_related</td><td>'.$item->view->links_0_related.'</td><td></td></tr>';
	$html_text .= '<tr id="203" style="display:none;vertical-align:top"><td>links_0_href</td><td>'.$item->view->links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="204" style="display:none;vertical-align:top"><td>links_0_href_lang</td><td>'.$item->view->links_0_href_lang.'</td><td></td></tr>';
	$html_text .= '<tr id="205" style="display:none;vertical-align:top"><td>links_0_title</td><td>'.$item->view->links_0_title.'</td><td></td></tr>';
	$html_text .= '<tr id="206" style="display:none;vertical-align:top"><td>links_0_media</td><td>'.$item->view->links_0_media.'</td><td></td></tr>';
	$html_text .= '<tr id="207" style="display:none;vertical-align:top"><td>links_0_type</td><td>'.$item->view->links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr id="211" style="display:none;vertical-align:top"><td>links_1_value</td><td>'.$item->view->links_1_value.'</td><td></td></tr>';
	$html_text .= '<tr id="212" style="display:none;vertical-align:top"><td>links_1_related</td><td>'.$item->view->links_1_related.'</td><td></td></tr>';
	$html_text .= '<tr id="213" style="display:none;vertical-align:top"><td>links_1_href</td><td>'.$item->view->links_1_href.'</td><td></td></tr>';
	$html_text .= '<tr id="214" style="display:none;vertical-align:top"><td>links_1_href_lang</td><td>'.$item->view->links_1_href_lang.'</td><td></td></tr>';
	$html_text .= '<tr id="215" style="display:none;vertical-align:top"><td>links_1_title</td><td>'.$item->view->links_1_title.'</td><td></td></tr>';
	$html_text .= '<tr id="216" style="display:none;vertical-align:top"><td>links_1_media</td><td>'.$item->view->links_1_media.'</td><td></td></tr>';
	$html_text .= '<tr id="217" style="display:none;vertical-align:top"><td>links_1_type</td><td>'.$item->view->links_1_type.'</td><td></td></tr>';
	$html_text .= '<tr id="221" style="display:none;vertical-align:top"><td>links_2_value</td><td>'.$item->view->links_2_value.'</td><td></td></tr>';
	$html_text .= '<tr id="222" style="display:none;vertical-align:top"><td>links_2_related</td><td>'.$item->view->links_2_related.'</td><td></td></tr>';
	$html_text .= '<tr id="223" style="display:none;vertical-align:top"><td>links_2_href</td><td>'.$item->view->links_2_href.'</td><td></td></tr>';
	$html_text .= '<tr id="224" style="display:none;vertical-align:top"><td>links_2_href_lang</td><td>'.$item->view->links_2_href_lang.'</td><td></td></tr>';
	$html_text .= '<tr id="225" style="display:none;vertical-align:top"><td>links_2_title</td><td>'.$item->view->links_2_title.'</td><td></td></tr>';
	$html_text .= '<tr id="226" style="display:none;vertical-align:top"><td>links_2_media</td><td>'.$item->view->links_2_media.'</td><td></td></tr>';
	$html_text .= '<tr id="227" style="display:none;vertical-align:top"><td>links_2_type</td><td>'.$item->view->links_2_type.'</td><td></td></tr>';
	$html_text .= '<tr id="231" style="display:none;vertical-align:top"><td>links_3_value</td><td>'.$item->view->links_3_value.'</td><td></td></tr>';
	$html_text .= '<tr id="232" style="display:none;vertical-align:top"><td>links_3_related</td><td>'.$item->view->links_3_related.'</td><td></td></tr>';
	$html_text .= '<tr id="233" style="display:none;vertical-align:top"><td>links_3_href</td><td>'.$item->view->links_3_href.'</td><td></td></tr>';
	$html_text .= '<tr id="234" style="display:none;vertical-align:top"><td>links_3_href_lang</td><td>'.$item->view->links_3_href_lang.'</td><td></td></tr>';
	$html_text .= '<tr id="235" style="display:none;vertical-align:top"><td>links_3_title</td><td>'.$item->view->links_3_title.'</td><td></td></tr>';
	$html_text .= '<tr id="236" style="display:none;vertical-align:top"><td>links_3_media</td><td>'.$item->view->links_3_media.'</td><td></td></tr>';
	$html_text .= '<tr id="237" style="display:none;vertical-align:top"><td>links_3_type</td><td>'.$item->view->links_3_type.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(30)">Domain +/-</button></td><td><b>'.$viewdomain.'</b></td><td id="domain_role"></td></tr>';
	$html_text .= '<tr id="301" style="display:none"><td>domain_handle</td><td>'.$item->details->domain_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="302" style="display:none"><td>domain_name_ascii</td><td>'.$item->details->domain_name_ascii.'</td><td id="domain_name_ascii"></td></tr>';
	$html_text .= '<tr id="303" style="display:none"><td>domain_name_unicode</td><td>'.$item->details->domain_name_unicode.'</td><td id="domain_name_unicode"></td></tr>';
	$html_text .= '<tr style="vertical-align:top"><td>domain_status_values</td><td><b>'.$item->details->domain_status_values.'</b></td><td id="domain_status_values"></td></tr>';
	$html_text .= '<tr id="304" style="display:none"><td>domain_event_registration</td><td>'.$item->details->domain_event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="305" style="display:none"><td>domain_event_last_transferred</td><td>'.$item->details->domain_event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="306" style="display:none"><td>domain_event_last_changed</td><td>'.$item->details->domain_event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr><td>domain_event_expiration</td><td>'.$item->details->domain_event_expiration.'</td><td id="domain_event_expiration"></td></tr>';
	$html_text .= '<tr id="307" style="display:none"><td>domain_event_recovery_until</td><td>'.$item->details->domain_event_recovery_until.'</td><td id="domain_event_recovery_until"></td></tr>';
	$html_text .= '<tr id="308" style="display:none"><td>domain_event_deletion</td><td>'.$item->details->domain_event_deletion.'</td><td id="domain_event_deletion"></td></tr>';
	$html_text .= '<tr id="309" style="display:none"><td>domain_event_last_uploaded</td><td>'.$item->details->domain_event_last_uploaded.'</td><td id="domain_event_last_uploaded"></td></tr>';
	$html_text .= '<tr id="3010" style="display:none;vertical-align:top"><td>domain_extensions_values</td><td><b>'.$item->details->domain_extensions_values.'</b></td><td id="domain_extensions_values"></td></tr>';
	$html_text .= '<tr id="3011" style="display:none;vertical-align:top"><td>domain_remark_values</td><td>'.$item->details->domain_remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(40)">Registrant +/-</button></td><td></td><td id="registrant_role"></td></tr>';
	$html_text .= '<tr id="401" style="display:none"><td>registrant_handle</td><td>'.$item->registrant->registrant_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="402" style="display:none"><td>registrant_web_id</td><td>'.$item->registrant->registrant_web_id.'</td><td id="registrant_web_id"></td></tr>';
	$html_text .= '<tr><td>registrant_full_name</td><td><b>'.$item->registrant->registrant_full_name.'</b></td><td id="registrant_full_name"></td></tr>';
	$html_text .= '<tr><td>registrant_kind</td><td>'.$item->registrant->registrant_kind.'</td><td id="registrant_kind"></td></tr>';
	$html_text .= '<tr id="403" style="display:none"><td>registrant_name</td><td><b>'.$item->registrant->registrant_name.'</b></td><td id="registrant_name"></td></tr>';
	$html_text .= '<tr id="404" style="display:none"><td>registrant_email</td><td>'.$item->registrant->registrant_email.'</td><td></td></tr>';
	$html_text .= '<tr id="405" style="display:none"><td>registrant_tel</td><td>'.$item->registrant->registrant_tel.'</td><td></td></tr>';
	$html_text .= '<tr id="406" style="display:none"><td>registrant_street</td><td>'.$item->registrant->registrant_street.'</td><td></td></tr>';
	$html_text .= '<tr id="40" style="display:none"><td>registrant_postal_code</td><td>'.$item->registrant->registrant_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="408" style="display:none"><td>registrant_city</td><td>'.$item->registrant->registrant_city.'</td><td></td></tr>';
	$html_text .= '<tr id="409" style="display:none"><td>registrant_state_province</td><td>'.$item->registrant->registrant_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr><td>registrant_country_code</td><td>'.$item->registrant->registrant_country_code.'</td><td id="registrant_country_code"></td></tr>';
	$html_text .= '<tr id="4010" style="display:none"><td>registrant_language_pref_1</td><td>'.$item->registrant->registrant_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4011" style="display:none"><td>registrant_language_pref_2</td><td>'.$item->registrant->registrant_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4012" style="display:none"><td>registrant_protected</td><td>'.$item->registrant->registrant_protected.'</td><td id="registrant_protected"></td></tr>';
	$html_text .= '<tr id="4013" style="display:none;vertical-align:top"><td>registrant_status_values</td><td>'.$item->registrant->registrant_status_values.'</td><td></td></tr>';
	$html_text .= '<tr id="4014" style="display:none"><td>registrant_event_registration</td><td>'.$item->registrant->registrant_event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="4015" style="display:none"><td>registrant_event_last_transferred</td><td>'.$item->registrant->registrant_event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="4016" style="display:none"><td>registrant_event_last_changed</td><td>'.$item->registrant->registrant_event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr id="4017" style="display:none"><td>registrant_event_expiration</td><td>'.$item->registrant->registrant_event_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="4018" style="display:none"><td>registrant_event_deletion</td><td>'.$item->registrant->registrant_event_deletion.'</td><td id="registrant_event_deletion"></td></tr>';
	$html_text .= '<tr id="4019" style="display:none"><td>registrant_event_last_uploaded</td><td>'.$item->registrant->registrant_event_last_uploaded.'</td><td id="registrant_event_last_uploaded"></td></tr>';
	$html_text .= '<tr id="4020" style="display:none"><td>registrant_event_verification_received</td><td>'.$item->registrant->registrant_event_verification_received.'</td><td id="registrant_event_verification_received"></td></tr>';
	$html_text .= '<tr id="4021" style="display:none"><td>registrant_event_verification_set</td><td>'.$item->registrant->registrant_event_verification_set.'</td><td id="registrant_event_verification_set"></td></tr>';
	$html_text .= '<tr id="4022" style="display:none;vertical-align:top"><td>registrant_remark_values</td><td>'.$item->registrant->registrant_remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(41)">Admin / Decision +/-</button></td><td></td><td id="admin_role"></td></tr>';
	$html_text .= '<tr id="411" style="display:none"><td>admin_handle</td><td>'.$item->admin->admin_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="412" style="display:none"><td>admin_web_id</td><td>'.$item->admin->admin_web_id.'</td><td id="admin_web_id"></td></tr>';
	$html_text .= '<tr id="413" style="display:none"><td>admin_full_name</td><td>'.$item->admin->admin_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="414" style="display:none"><td>admin_kind</td><td>'.$item->admin->admin_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="415" style="display:none"><td>admin_name</td><td>'.$item->admin->admin_name.'</td><td></td></tr>';
	$html_text .= '<tr><td>admin_email</td><td>'.$item->admin->admin_email.'</td><td></td></tr>';
	$html_text .= '<tr id="416" style="display:none"><td>admin_tel</td><td>'.$item->admin->admin_tel.'</td><td></td></tr>';
	$html_text .= '<tr id="417" style="display:none"><td>admin_street</td><td>'.$item->admin->admin_street.'</td><td></td></tr>';
	$html_text .= '<tr id="418" style="display:none"><td>admin_postal_code</td><td>'.$item->admin->admin_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="419" style="display:none"><td>admin_city</td><td>'.$item->admin->admin_city.'</td><td></td></tr>';
	$html_text .= '<tr id="4110" style="display:none"><td>admin_state_province</td><td>'.$item->admin->admin_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="4111" style="display:none"><td>admin_country_code</td><td>'.$item->admin->admin_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4112" style="display:none"><td>admin_language_pref_1</td><td>'.$item->admin->admin_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4113" style="display:none"><td>admin_language_pref_2</td><td>'.$item->admin->admin_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4114" style="display:none"><td>admin_protected</td><td>'.$item->admin->admin_protected.'</td><td id="admin_protected"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(42)">Tech / Onsite +/-</button></td><td></td><td id="tech_role"></td></tr>';
	$html_text .= '<tr id="421" style="display:none"><td>tech_handle</td><td>'.$item->tech->tech_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="422" style="display:none"><td>tech_web_id</td><td>'.$item->tech->tech_web_id.'</td><td id="tech_web_id"></td></tr>';
	$html_text .= '<tr id="423" style="display:none"><td>tech_full_name</td><td>'.$item->tech->tech_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="424" style="display:none"><td>tech_kind</td><td>'.$item->tech->tech_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="425" style="display:none"><td>tech_name</td><td>'.$item->tech->tech_name.'</td><td></td></tr>';
	$html_text .= '<tr><td>tech_email</td><td>'.$item->tech->tech_email.'</td><td></td></tr>';
	$html_text .= '<tr id="426" style="display:none"><td>tech_tel</td><td>'.$item->tech->tech_tel.'</td><td></td></tr>';
	$html_text .= '<tr id="427" style="display:none"><td>tech_street</td><td>'.$item->tech->tech_street.'</td><td></td></tr>';
	$html_text .= '<tr id="428" style="display:none"><td>tech_postal_code</td><td>'.$item->tech->tech_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="429" style="display:none"><td>tech_city</td><td>'.$item->tech->tech_city.'</td><td></td></tr>';
	$html_text .= '<tr id="4210" style="display:none"><td>tech_state_province</td><td>'.$item->tech->tech_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="4211" style="display:none"><td>tech_country_code</td><td>'.$item->tech->tech_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4212" style="display:none"><td>tech_language_pref_1</td><td>'.$item->tech->tech_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4213" style="display:none"><td>tech_language_pref_2</td><td>'.$item->tech->tech_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4214" style="display:none"><td>tech_protected</td><td>'.$item->tech->tech_protected.'</td><td id="tech_protected"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(43)">Billing +/-</button></td><td></td><td id="billing_role"></td></tr>';
	$html_text .= '<tr id="431" style="display:none"><td>billing_handle</td><td>'.$item->billing->billing_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="432" style="display:none"><td>billing_web_id</td><td>'.$item->billing->billing_web_id.'</td><td></td></tr>';
	$html_text .= '<tr id="433" style="display:none"><td>billing_full_name</td><td>'.$item->billing->billing_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="434" style="display:none"><td>billing_kind</td><td>'.$item->billing->billing_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="435" style="display:none"><td>billing_name</td><td>'.$item->billing->billing_name.'</td><td></td></tr>';
	$html_text .= '<tr id="436" style="display:none"><td>billing_email</td><td>'.$item->billing->billing_email.'</td><td></td></tr>';
	$html_text .= '<tr id="437" style="display:none"><td>billing_tel</td><td>'.$item->billing->billing_tel.'</td><td></td></tr>';
	$html_text .= '<tr id="438" style="display:none"><td>billing_street</td><td>'.$item->billing->billing_street.'</td><td></td></tr>';
	$html_text .= '<tr id="439" style="display:none"><td>billing_postal_code</td><td>'.$item->billing->billing_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4310" style="display:none"><td>billing_city</td><td>'.$item->billing->billing_city.'</td><td></td></tr>';
	$html_text .= '<tr id="4311" style="display:none"><td>billing_state_province</td><td>'.$item->billing->billing_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="4312" style="display:none"><td>billing_country_code</td><td>'.$item->billing->billing_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4313" style="display:none"><td>billing_language_pref_1</td><td>'.$item->billing->billing_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4314" style="display:none"><td>billing_language_pref_2</td><td>'.$item->billing->billing_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4315" style="display:none"><td>billing_protected</td><td>'.$item->billing->billing_protected.'</td><td id="billing_protected"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(44)">Emergency +/-</button></td><td></td><td id="emergency_role"></td></tr>';
	$html_text .= '<tr id="441" style="display:none"><td>emergency_handle</td><td>'.$item->emergency->emergency_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="442" style="display:none"><td>emergency_web_id</td><td>'.$item->emergency->emergency_web_id.'</td><td id="emergency_web_id"></td></tr>';
	$html_text .= '<tr id="443" style="display:none"><td>emergency_full_name</td><td>'.$item->emergency->emergency_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="444" style="display:none"><td>emergency_kind</td><td>'.$item->emergency->emergency_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="445" style="display:none"><td>emergency_name</td><td>'.$item->emergency->emergency_name.'</td><td></td></tr>';
	$html_text .= '<tr id="446" style="display:none"><td>emergency_email</td><td>'.$item->emergency->emergency_email.'</td><td></td></tr>';
	$html_text .= '<tr id="447" style="display:none"><td>emergency_tel</td><td>'.$item->emergency->emergency_tel.'</td><td></td></tr>';
	$html_text .= '<tr id="448" style="display:none"><td>emergency_street</td><td>'.$item->emergency->emergency_street.'</td><td></td></tr>';
	$html_text .= '<tr id="449" style="display:none"><td>emergency_postal_code</td><td>'.$item->emergency->emergency_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4410" style="display:none"><td>emergency_city</td><td>'.$item->emergency->emergency_city.'</td><td></td></tr>';
	$html_text .= '<tr id="4411" style="display:none"><td>emergency_state_province</td><td>'.$item->emergency->emergency_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="4412" style="display:none"><td>emergency_country_code</td><td>'.$item->emergency->emergency_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4413" style="display:none"><td>emergency_language_pref_1</td><td>'.$item->emergency->emergency_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4414" style="display:none"><td>emergency_language_pref_2</td><td>'.$item->emergency->emergency_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4415" style="display:none"><td>emergency_protected</td><td>'.$item->emergency->emergency_protected.'</td><td id="emergency_protected"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(50)">Reseller +/-</button></td><td></td><td id="reseller_role"></td></tr>';
	$html_text .= '<tr id="501" style="display:none"><td>reseller_handle</td><td>'.$item->reseller->reseller_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="502" style="display:none"><td>reseller_web_id</td><td>'.$item->reseller->reseller_web_id.'</td><td id="reseller_web_id"></td></tr>';
	$html_text .= '<tr><td>reseller_full_name</td><td>'.$item->reseller->reseller_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="503" style="display:none"><td>reseller_kind</td><td>'.$item->reseller->reseller_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="504" style="display:none"><td>reseller_name</td><td>'.$item->reseller->reseller_name.'</td><td></td></tr>';
	$html_text .= '<tr id="505" style="display:none"><td>reseller_email</td><td>'.$item->reseller->reseller_email.'</td><td></td></tr>';
	$html_text .= '<tr id="506" style="display:none"><td>reseller_tel</td><td>'.$item->reseller->reseller_tel.'</td><td></td></tr>';
	$html_text .= '<tr id="507" style="display:none"><td>reseller_street</td><td>'.$item->reseller->reseller_street.'</td><td></td></tr>';
	$html_text .= '<tr id="508" style="display:none"><td>reseller_postal_code</td><td>'.$item->reseller->reseller_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="509" style="display:none"><td>reseller_city</td><td>'.$item->reseller->reseller_city.'</td><td></td></tr>';
	$html_text .= '<tr id="5010" style="display:none"><td>reseller_state_province</td><td>'.$item->reseller->reseller_state_province.'</td><td></td></tr>';			
	$html_text .= '<tr id="5011" style="display:none"><td>reseller_country_code</td><td>'.$item->reseller->reseller_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="5012" style="display:none"><td>reseller_language_pref_1</td><td>'.$item->reseller->reseller_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="5013" style="display:none"><td>reseller_language_pref_2</td><td>'.$item->reseller->reseller_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="5014" style="display:none"><td>reseller_protected</td><td>'.$item->reseller->reseller_protected.'</td><td id="reseller_protected"></td></tr>';
	$html_text .= '<tr id="5015" style="display:none;vertical-align:top"><td>reseller_status_values</td><td>'.$item->reseller->reseller_status_values.'</td><td></td></tr>';
	$html_text .= '<tr id="5016" style="display:none"><td>reseller_event_registration</td><td>'.$item->reseller->reseller_event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="5017" style="display:none"><td>reseller_event_last_transferred</td><td>'.$item->reseller->reseller_event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="5018" style="display:none"><td>reseller_event_last_changed</td><td>'.$item->reseller->reseller_event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr id="5019" style="display:none"><td>reseller_event_expiration</td><td>'.$item->reseller->reseller_event_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="5020" style="display:none"><td>reseller_event_deletion</td><td>'.$item->reseller->reseller_event_deletion.'</td><td></td></tr>';
	$html_text .= '<tr id="5021" style="display:none"><td>reseller_event_last_uploaded</td><td>'.$item->reseller->reseller_event_last_uploaded.'</td><td></td></tr>';
	$html_text .= '<tr id="5022" style="display:none"><td>reseller_event_verification_received</td><td>'.$item->reseller->reseller_event_verification_received.'</td><td id="reseller_event_verification_received"></td></tr>';
	$html_text .= '<tr id="5023" style="display:none"><td>reseller_event_verification_set</td><td>'.$item->reseller->reseller_event_verification_set.'</td><td id="reseller_event_verification_set"></td></tr>';
	$html_text .= '<tr id="5024" style="display:none;vertical-align:top"><td>reseller_remark_values</td><td>'.$item->reseller->reseller_remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(60)">Registrar +/-</button></td><td></td><td id="registrar_role"></td></tr>';
	$html_text .= '<tr id="601" style="display:none"><td>registrar_handle</td><td>'.$item->registrar->registrar_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="602" style="display:none"><td>registrar_web_id</td><td>'.$item->registrar->registrar_web_id.'</td><td id="registrar_web_id"></td></tr>';		
	$html_text .= '<tr><td>registrar_full_name</td><td>'.$item->registrar->registrar_full_name.'</td><td id="registrar_recover"></td></tr>';
	$html_text .= '<tr id="603" style="display:none"><td>registrar_kind</td><td>'.$item->registrar->registrar_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="604" style="display:none"><td>registrar_url</td><td>'.$item->registrar->registrar_url.'</td><td></td></tr>';
	$html_text .= '<tr id="605" style="display:none"><td>registrar_iana_id</td><td>'.$item->registrar->registrar_iana_id.'</td><td id="registrar_iana_id"></td></tr>';
	$html_text .= '<tr id="606" style="display:none"><td>registrar_name</td><td>'.$item->registrar->registrar_name.'</td><td></td></tr>';
	$html_text .= '<tr id="607" style="display:none"><td>registrar_email</td><td>'.$item->registrar->registrar_email.'</td><td></td></tr>';
	$html_text .= '<tr id="608" style="display:none"><td>registrar_tel</td><td>'.$item->registrar->registrar_tel.'</td><td></td></tr>';
	$html_text .= '<tr id="609" style="display:none"><td>registrar_street</td><td>'.$item->registrar->registrar_street.'</td><td></td></tr>';
	$html_text .= '<tr id="6010" style="display:none"><td>registrar_postal_code</td><td>'.$item->registrar->registrar_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6011" style="display:none"><td>registrar_city</td><td>'.$item->registrar->registrar_city.'</td><td></td></tr>';
	$html_text .= '<tr id="6012" style="display:none"><td>registrar_state_province</td><td>'.$item->registrar->registrar_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="6013" style="display:none"><td>registrar_country_code</td><td>'.$item->registrar->registrar_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6014" style="display:none"><td>registrar_language_pref_1</td><td>'.$item->registrar->registrar_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="6015" style="display:none"><td>registrar_language_pref_2</td><td>'.$item->registrar->registrar_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="6016" style="display:none"><td>registrar_protected</td><td>'.$item->registrar->registrar_protected.'</td><td id="registrar_protected"></td></tr>';
	$html_text .= '<tr id="6017" style="display:none;vertical-align:top"><td>registrar_status_values</td><td>'.$item->registrar->registrar_status_values.'</td><td></td></tr>';
	$html_text .= '<tr id="6018" style="display:none"><td>registrar_event_registration</td><td>'.$item->registrar->registrar_event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="6019" style="display:none"><td>registrar_event_last_transferred</td><td>'.$item->registrar->registrar_event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="6020" style="display:none"><td>registrar_event_last_changed</td><td>'.$item->registrar->registrar_event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr id="6021" style="display:none"><td>registrar_event_expiration</td><td>'.$item->registrar->registrar_event_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="6022" style="display:none"><td>registrar_event_deletion</td><td>'.$item->registrar->registrar_event_deletion.'</td><td></td></tr>';
	$html_text .= '<tr id="6023" style="display:none"><td>registrar_event_last_uploaded</td><td>'.$item->registrar->registrar_event_last_uploaded.'</td><td></td></tr>';
	$html_text .= '<tr id="6024" style="display:none"><td>registrar_event_verification_received</td><td>'.$item->registrar->registrar_event_verification_received.'</td><td id="registrar_event_verification_received"></td></tr>';
	$html_text .= '<tr id="6025" style="display:none"><td>registrar_event_verification_set</td><td>'.$item->registrar->registrar_event_verification_set.'</td><td id="registrar_event_verification_set"></td></tr>';
	$html_text .= '<tr id="6026" style="display:none;vertical-align:top"><td>registrar_remark_values</td><td>'.$item->registrar->registrar_remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(61)">Registrar Abuse +/-</button></td><td></td><td id="registrar_abuse_role"></td></tr>';
	$html_text .= '<tr><td>registrar_abuse_email</td><td>'.$item->registrar->registrar_abuse_email.'</td><td></td></tr>';
	$html_text .= '<tr id="611" style="display:none"><td>registrar_abuse_tel</td><td>'.$item->registrar->registrar_abuse_tel.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(62)">Sponsor +/-</button></td><td></td><td id="sponsor_role"></td></tr>';
	$html_text .= '<tr id="621" style="display:none"><td>sponsor_handle</td><td>'.$item->sponsor->sponsor_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="622" style="display:none"><td>sponsor_web_id</td><td>'.$item->sponsor->sponsor_web_id.'</td><td id="sponsor_web_id"></td></tr>';		
	$html_text .= '<tr><td>sponsor_full_name</td><td>'.$item->sponsor->sponsor_full_name.'</td><td id="sponsor_recover"></td></tr>';
	$html_text .= '<tr id="623" style="display:none"><td>sponsor_kind</td><td>'.$item->sponsor->sponsor_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="624" style="display:none"><td>sponsor_url</td><td>'.$item->sponsor->sponsor_url.'</td><td></td></tr>';
	$html_text .= '<tr id="625" style="display:none"><td>sponsor_iana_id</td><td>'.$item->sponsor->sponsor_iana_id.'</td><td></td></tr>';
	$html_text .= '<tr id="626" style="display:none"><td>sponsor_name</td><td>'.$item->sponsor->sponsor_name.'</td><td></td></tr>';
	$html_text .= '<tr id="627" style="display:none"><td>sponsor_email</td><td>'.$item->sponsor->sponsor_email.'</td><td></td></tr>';
	$html_text .= '<tr id="628" style="display:none"><td>sponsor_tel</td><td>'.$item->sponsor->sponsor_tel.'</td><td></td></tr>';
	$html_text .= '<tr id="629" style="display:none"><td>sponsor_street</td><td>'.$item->sponsor->sponsor_street.'</td><td></td></tr>';
	$html_text .= '<tr id="6210" style="display:none"><td>sponsor_postal_code</td><td>'.$item->sponsor->sponsor_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6211" style="display:none"><td>sponsor_city</td><td>'.$item->sponsor->sponsor_city.'</td><td></td></tr>';
	$html_text .= '<tr id="6212" style="display:none"><td>sponsor_state_province</td><td>'.$item->sponsor->sponsor_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="6213" style="display:none"><td>sponsor_country_code</td><td>'.$item->sponsor->sponsor_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6214" style="display:none"><td>sponsor_language_pref_1</td><td>'.$item->sponsor->sponsor_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="6215" style="display:none"><td>sponsor_language_pref_2</td><td>'.$item->sponsor->sponsor_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="6216" style="display:none"><td>sponsor_protected</td><td>'.$item->sponsor->sponsor_protected.'</td><td></td></tr>';
	$html_text .= '<tr id="6217" style="display:none;vertical-align:top"><td>sponsor_status_values</td><td>'.$item->sponsor->sponsor_status_values.'</td><td></td></tr>';
	$html_text .= '<tr id="6218" style="display:none"><td>sponsor_event_registration</td><td>'.$item->sponsor->sponsor_event_registration.'</td><td></td></tr>';
	$html_text .= '<tr id="6219" style="display:none"><td>sponsor_event_last_transferred</td><td>'.$item->sponsor->sponsor_event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr id="6220" style="display:none"><td>sponsor_event_last_changed</td><td>'.$item->sponsor->sponsor_event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr id="6221" style="display:none"><td>sponsor_event_expiration</td><td>'.$item->sponsor->sponsor_event_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="6222" style="display:none"><td>sponsor_event_deletion</td><td>'.$item->sponsor->sponsor_event_deletion.'</td><td></td></tr>';
	$html_text .= '<tr id="6223" style="display:none"><td>sponsor_event_last_uploaded</td><td>'.$item->sponsor->sponsor_event_last_uploaded.'</td><td></td></tr>';
	$html_text .= '<tr id="6224" style="display:none"><td>sponsor_event_verification_received</td><td>'.$item->sponsor->sponsor_event_verification_received.'</td><td id="sponsor_event_verification_received"></td></tr>';
	$html_text .= '<tr id="6225" style="display:none"><td>sponsor_event_verification_set</td><td>'.$item->sponsor->sponsor_event_verification_set.'</td><td id="sponsor_event_verification_set"></td></tr>';
	$html_text .= '<tr id="6226" style="display:none;vertical-align:top"><td>sponsor_remark_values</td><td>'.$item->sponsor->sponsor_remark_values.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(63)">Name Servers +/-</button></td><td></td><td></td></tr>';
	//if (!empty($item->name_servers->server_1->server_name_1))	{
	//	if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
			$html_text .= '<tr id="631" style="display:none"><td>server_name_1</td><td>'.$item->name_servers->server_1->server_name_1.'</td><td></td></tr>';
			$html_text .= '<tr id="632" style="display:none"><td>server_name_unicode_1</td><td>'.$item->name_servers->server_1->server_name_unicode_1.'</td><td></td></tr>';
			$html_text .= '<tr id="633" style="display:none"><td>server_ipv4_1</td><td>'.$item->name_servers->server_1->server_ipv4_1.'</td><td id="name_servers_ip"></td></tr>';
			$html_text .= '<tr id="634" style="display:none"><td>server_ipv6_1</td><td>'.$item->name_servers->server_1->server_ipv6_1.'</td><td></td></tr>';
			$html_text .= '<tr id="635" style="display:none"><td>server_delegation_check_1</td><td>'.$item->name_servers->server_1->server_delegation_check_1.'</td><td id="br_zone"></td></tr>';
			$html_text .= '<tr id="636" style="display:none"><td>server_status_1</td><td>'.$item->name_servers->server_1->server_status_1.'</td><td></td></tr>';
			$html_text .= '<tr id="637" style="display:none"><td>server_delegation_check_last_correct_1</td><td>'.$item->name_servers->server_1->server_delegation_check_last_correct_1.'</td><td></td></tr>';	
	//	}	
	//}
	if (!empty($item->name_servers->server_1->server_name_1))	{		
		if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
			$html_text .= '<tr id="638" style="display:none"><td>server_name_2</td><td>'.$item->name_servers->server_2->server_name_2.'</td><td></td></tr>';
			$html_text .= '<tr id="639" style="display:none"><td>server_name_unicode_2</td><td>'.$item->name_servers->server_2->server_name_unicode_2.'</td><td></td></tr>';		
			$html_text .= '<tr id="6310" style="display:none"><td>server_ipv4_2</td><td>'.$item->name_servers->server_2->server_ipv4_2.'</td><td></td></tr>';
			$html_text .= '<tr id="6311" style="display:none"><td>server_ipv6_2</td><td>'.$item->name_servers->server_2->server_ipv6_2.'</td><td></td></tr>';
			$html_text .= '<tr id="6312" style="display:none"><td>server_delegation_check_2</td><td>'.$item->name_servers->server_2->server_delegation_check_2.'</td><td></td></tr>';
			$html_text .= '<tr id="6313" style="display:none"><td>server_status_2</td><td>'.$item->name_servers->server_2->server_status_2.'</td><td></td></tr>';
			$html_text .= '<tr id="6314" style="display:none"><td>server_delegation_check_last_correct_2</td><td>'.$item->name_servers->server_2->server_delegation_check_last_correct_2.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_3->server_name_3))	{
		if (strlen(trim($item->name_servers->server_3->server_name_3)))	{
			$html_text .= '<tr id="6315" style="display:none"><td>server_name_3</td><td>'.$item->name_servers->server_3->server_name_3.'</td><td></td></tr>';
			$html_text .= '<tr id="6316" style="display:none"><td>server_name_unicode_3</td><td>'.$item->name_servers->server_3->server_name_unicode_3.'</td><td></td></tr>';
			$html_text .= '<tr id="6317" style="display:none"><td>server_ipv4_3</td><td>'.$item->name_servers->server_3->server_ipv4_3.'</td><td></td></tr>';
			$html_text .= '<tr id="6318" style="display:none"><td>server_ipv6_3</td><td>'.$item->name_servers->server_3->server_ipv6_3.'</td><td></td></tr>';
			$html_text .= '<tr id="6319" style="display:none"><td>server_delegation_check_3</td><td>'.$item->name_servers->server_3->server_delegation_check_3.'</td><td></td></tr>';
			$html_text .= '<tr id="6320" style="display:none"><td>server_status_3</td><td>'.$item->name_servers->server_3->server_status_3.'</td><td></td></tr>';
			$html_text .= '<tr id="6321" style="display:none"><td>server_delegation_check_last_correct_3</td><td>'.$item->name_servers->server_3->server_delegation_check_last_correct_3.'</td><td></td></tr>';				
		}	
	}
	if (!empty($item->name_servers->server_4->server_name_4))	{	
		if (strlen(trim($item->name_servers->server_4->server_name_4)))	{
			$html_text .= '<tr id="6322" style="display:none"><td>server_name_4</td><td>'.$item->name_servers->server_4->server_name_4.'</td><td></td></tr>';
			$html_text .= '<tr id="6323" style="display:none"><td>server_name_unicode_4</td><td>'.$item->name_servers->server_4->server_name_unicode_4.'</td><td></td></tr>';			
			$html_text .= '<tr id="6324" style="display:none"><td>server_ipv4_4</td><td>'.$item->name_servers->server_4->server_ipv4_4.'</td><td></td></tr>';
			$html_text .= '<tr id="6325" style="display:none"><td>server_ipv6_4</td><td>'.$item->name_servers->server_4->server_ipv6_4.'</td><td></td></tr>';
			$html_text .= '<tr id="6326" style="display:none"><td>server_delegation_check_4</td><td>'.$item->name_servers->server_4->server_delegation_check_4.'</td><td></td></tr>';
			$html_text .= '<tr id="6327" style="display:none"><td>server_status_4</td><td>'.$item->name_servers->server_4->server_status_4.'</td><td></td></tr>';
			$html_text .= '<tr id="6328" style="display:none"><td>server_delegation_check_last_correct_4</td><td>'.$item->name_servers->server_4->server_delegation_check_last_correct_4.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_5->server_name_5))	{		
		if (strlen(trim($item->name_servers->server_5->server_name_5)))	{
			$html_text .= '<tr id="6329" style="display:none"><td>server_name_5</td><td>'.$item->name_servers->server_5->server_name_5.'</td><td></td></tr>';
			$html_text .= '<tr id="6330" style="display:none"><td>server_name_unicode_5</td><td>'.$item->name_servers->server_5->server_name_unicode_5.'</td><td></td></tr>';		
			$html_text .= '<tr id="6331" style="display:none"><td>server_ipv4_5</td><td>'.$item->name_servers->server_5->server_ipv4_5.'</td><td></td></tr>';
			$html_text .= '<tr id="6332" style="display:none"><td>server_ipv6_5</td><td>'.$item->name_servers->server_5->server_ipv6_5.'</td><td></td></tr>';
			$html_text .= '<tr id="6333" style="display:none"><td>server_delegation_check_5</td><td>'.$item->name_servers->server_5->server_delegation_check_5.'</td><td></td></tr>';
			$html_text .= '<tr id="6334" style="display:none"><td>server_status_5</td><td>'.$item->name_servers->server_5->server_status_5.'</td><td></td></tr>';
			$html_text .= '<tr id="6335" style="display:none"><td>server_delegation_check_last_correct_5</td><td>'.$item->name_servers->server_5->server_delegation_check_last_correct_5.'</td><td></td></tr>';	
		}	
	}
	if (!empty($item->name_servers->server_6->server_name_6))	{
		if (strlen(trim($item->name_servers->server_6->server_name_6)))	{
			$html_text .= '<tr id="6336" style="display:none"><td>server_name_6</td><td>'.$item->name_servers->server_6->server_name_6.'</td><td></td></tr>';
			$html_text .= '<tr id="6337" style="display:none"><td>server_name_unicode_6</td><td>'.$item->name_servers->server_6->server_name_unicode_6.'</td><td></td></tr>';		
			$html_text .= '<tr id="6338" style="display:none"><td>server_ipv4_6</td><td>'.$item->name_servers->server_6->server_ipv4_6.'</td><td></td></tr>';
			$html_text .= '<tr id="6339" style="display:none"><td>server_ipv6_6</td><td>'.$item->name_servers->server_6->server_ipv6_6.'</td><td></td></tr>';
			$html_text .= '<tr id="6340" style="display:none"><td>server_delegation_check_6</td><td>'.$item->name_servers->server_6->server_delegation_check_6.'</td><td></td></tr>';
			$html_text .= '<tr id="6341" style="display:none"><td>server_status_6</td><td>'.$item->name_servers->server_6->server_status_6.'</td><td></td></tr>';
			$html_text .= '<tr id="6342" style="display:none"><td>server_delegation_check_last_correct_6</td><td>'.$item->name_servers->server_6->server_delegation_check_last_correct_6.'</td><td></td></tr>';	
		}	
	}
	$html_text .= '<tr><td>name_servers_dnssec</td><td>'.$item->name_servers->name_servers_dnssec.'</td><td id="name_servers_dnssec"></td></tr>';
	$html_text .= '<tr><td>name_servers_dnssec_algorithm</td><td>'.$item->name_servers->name_servers_dnssec_algorithm.'</td><td id="name_servers_dnssec_algorithm"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(70)">Whois Data +/-</button></td><td colspan="2"></td></tr>';
	$html_text .= '<tr id="701" style="display:none"><td colspan="3">'.$item->raw_whois_data.'</td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(75)">RDAP Data +/-</button></td><td id="raw_data_next" colspan="2"></td></tr>';
	$html_text .= '<tr id="751" style="display:none"><td colspan="3">'.$item->raw_rdap_data.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>