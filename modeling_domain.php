<?php
session_start();  // is needed with no Scriptcase PHP Generator
echo '<!DOCTYPE html><html lang="en" style="font-size: 90%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>Web domain information modeling</title>';
?><script>
	
function SwitchDisplay(type) {
	if (type == 10)			{ // zone
		var pre = '10';
		var max = 5
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
	else if (type == 20)	{ // view 0
		var pre = '20';
		var max = 7
	}
	else if (type == 21)	{ // view 1
		var pre = '21';
		var max = 7
	}
	else if (type == 30)	{ // domain
		var pre = '30';
		var max = 3
	}
	else if (type == 31)	{ // events
		var pre = '31';
		var max = 6
	}
	else if (type == 40)	{ // registrant
		var pre = '40';
		var max = 13
	}
	else if (type == 41)	{ // admin
		var pre = '41';
		var max = 15
	}
	else if (type == 42)	{ // tech
		var pre = '42';
		var max = 15
	}
	else if (type == 43)	{ // billing
		var pre = '43';
		var max = 16
	}
	else if (type == 44)	{ // emergency
		var pre = '44';
		var max = 15
	}
	else if (type == 50)	{ // reseller
		var pre = '50';
		var max = 15
	}	
	else if (type == 60)	{ // registrar
		var pre = '60';
		var max = 17
	}
	else if (type == 61)	{ // abuse
		var pre = '61';
		var max = 1
	}
	else if (type == 62)	{ // name servers
		var pre = '62';
		var max = 24
	}
	else if (type == 70)	{ // raw data
		var pre = '70';
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
		var derived = '';
		document.getElementById("title").textContent = "Model";
		document.getElementById("instruction").textContent = "Paste a domain name and press Enter.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "";
		document.getElementById("zone_role").textContent = "";
		document.getElementById("zone_registry_web_id").textContent = proposed;
		document.getElementById("zone_registry_full_name").textContent = proposed;
		document.getElementById("zone_menu").textContent = proposed;
		document.getElementById("zone_support").textContent = proposed;
		document.getElementById("zone_notices").textContent = "";
		document.getElementById("view_role").textContent = "";
		document.getElementById("domain_role").textContent = "";
		document.getElementById("domain_name_unicode").textContent = "";
		document.getElementById("events_role").textContent = proposed;
		document.getElementById("event_expiration_grace_until").textContent = "";
		document.getElementById("event_last_uploaded").textContent = "";
		document.getElementById("event_verification_requested").textContent = proposed;
		document.getElementById("event_verification_retrieved").textContent = proposed;
		document.getElementById("registrar_role").textContent = "";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_iana_id").textContent = "";
		document.getElementById("registrar_protected").textContent = derived;
		document.getElementById("registrar_abuse_role").textContent = "";
		document.getElementById("reseller_role").textContent = "";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_protected").textContent = derived;
		document.getElementById("registrant_role").textContent = "";
		document.getElementById("registrant_web_id").textContent = proposed;
		document.getElementById("registrant_full_name").textContent = "";
		document.getElementById("registrant_kind").textContent = "";
		document.getElementById("registrant_name").textContent = "";
		document.getElementById("registrant_protected").textContent = derived;
		document.getElementById("admin_role").textContent = "";
		document.getElementById("admin_web_id").textContent = proposed;
		document.getElementById("admin_protected").textContent = derived;
		document.getElementById("tech_role").textContent = "";
		document.getElementById("tech_web_id").textContent = proposed;
		document.getElementById("tech_protected").textContent = derived;
		document.getElementById("billing_role").textContent = "";
		document.getElementById("billing_protected").textContent = derived;
		document.getElementById("emergency_role").textContent = "";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_protected").textContent = derived;
		document.getElementById("name_servers_role").textContent = "";
		document.getElementById("name_servers_ip").textContent = "";
		document.getElementById("name_servers_dnssec").textContent = "";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "";
		document.getElementById("raw_data_next").textContent = "US/EU:";
	}
	else if (translation == 1)	{
		var proposed = 'VOORGESTELD - ';
		var derived = proposed + 'Niet-openbare gegevens';
		document.getElementById("title").textContent = "Model voor domeininformatie";
		document.getElementById("instruction").textContent = "Plak een domeinnaam en druk op Enter.";
		document.getElementById("field").textContent = "Omschrijving";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Toelichting";
		document.getElementById("zone_role").textContent = "Een domeinzone is (door de ICANN) toegewezen aan een domain registry om domeinen te beheren.";
		document.getElementById("zone_registry_web_id").textContent = proposed;
		document.getElementById("zone_registry_full_name").textContent = proposed;
		document.getElementById("zone_menu").textContent = proposed + "Een vervolgkeuzemenu voor uitleg en details per zone via een subdomein van de registry.";
		document.getElementById("zone_support").textContent = proposed + "Hulp vanuit de registry is mogelijk per e-mail.";
		document.getElementById("zone_notices").textContent = "Het gebruik van domeingegevens is aan beperkingen onderhevig.";
		document.getElementById("view_role").textContent = "Zoeken op web-ID's kan werken met indexering in de databasetabel op de wereldwijde RDAP-servers.";
		document.getElementById("domain_role").textContent = "Een webdomein onder een topleveldomein is wereldwijd uniek en onder bepaalde regels vrij te kiezen.";
		document.getElementById("domain_name_unicode").textContent = "Namen met speciale tekens worden opgeslagen als ASCII-tekenreeksen met behulp van Punycode-transcriptie.";
		document.getElementById("events_role").textContent = proposed + "Landspecifieke domeincontroleregisters (DCR) op basis van de daadwerkelijke gebruiker.";
		document.getElementById("event_expiration_grace_until").textContent = "De 'deletion' in RDAP betreft een verwachte beëindigingsstatus in de administratieve geschiedenis.";
		document.getElementById("event_last_uploaded").textContent = "RDAP-database-update in Zulu-tijd (gecoördineerde universele tijd - UTC).";
		document.getElementById("event_verification_requested").textContent = proposed + "Bij een matchend web-ID ontvangt de registry een signaal.";
		document.getElementById("event_verification_retrieved").textContent = proposed + "Op de lange termijn kan verificatie ook worden gebruikt door zoekmachines.";
		document.getElementById("registrar_role").textContent = "Een domain registrar verzorgt de reservering van domeinen en IP-adresroutering.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_iana_id").textContent = "Met een gTLD-domein en ICANN-accreditatie voor één of meerdere generieke topleveldomeinen.";
		document.getElementById("registrar_protected").textContent = derived;
		document.getElementById("registrar_abuse_role").textContent = "Misbruikinformatie vergemakkelijkt het contact opnemen met de registrar door een derde partij.";
		document.getElementById("reseller_role").textContent = "Een domain reseller heeft verantwoordelijkheid, afhankelijk van de overeenkomst en de voorschriften.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_protected").textContent = derived;
		document.getElementById("registrant_role").textContent = "Een domeinhouder heeft tenminste de rechten van een abonnement op zijn domein.";
		document.getElementById("registrant_web_id").textContent = proposed + "Webidentificatienummer voor bedrijfsentiteiten en natuurlijke personen.";
		document.getElementById("registrant_full_name").textContent = "Een bestaande (en zichtbare) naam van de gebruiker met de daadwerkelijke of de effectieve controle.";
		document.getElementById("registrant_kind").textContent = "Leeg, 'individual' of 'org'; een levenstestament kan een juridische lacune opvullen; suggestie: 'non-hidden individual'.";
		document.getElementById("registrant_name").textContent = "Het veld 'full_name' kan een publieke persoonlijke naam bevatten in het RDAP-protocol.";
		document.getElementById("registrant_protected").textContent = derived;
		document.getElementById("admin_role").textContent = "Het administratief aanspreekpunt beantwoordt een verzoek en stuurt zo nodig door.";
		document.getElementById("admin_web_id").textContent = proposed;
		document.getElementById("admin_protected").textContent = derived;
		document.getElementById("tech_role").textContent = "Een technisch contact reageert om een gemelde storing op te lossen.";
		document.getElementById("tech_web_id").textContent = proposed;
		document.getElementById("tech_protected").textContent = derived;
		document.getElementById("billing_role").textContent = "Sommige domain registries houden gegevens bij om hun facturering uit te voeren.";
		document.getElementById("billing_protected").textContent = derived;
		document.getElementById("emergency_role").textContent = proposed + "Een verantwoordelijke persoon kan de benodigde toegang verlenen.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_protected").textContent = derived;
		document.getElementById("name_servers_role").textContent = "Naamservers leiden naar IP-adressen van webservers van een URL.";
		document.getElementById("name_servers_ip").textContent = "Een lijmrecord is vereist als de naamservers van de registrar niet worden gebruikt.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is een web-route-beveiligingsvoorziening op het DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Een DNSSEC-algoritme vanaf versie 13 is up-to-date.";
		document.getElementById("raw_data_next").textContent = "US/EU: Een volgend volwassen RDAP-formaat vraagt om unieke veldnamen, vaste veldvolgorde, overzicht en passend 'non-public'.";		
	}
	else if (translation == 2)	{
		var proposed = 'PROPOSED - ';
		var derived = proposed + 'Non-public data';
		document.getElementById("title").textContent = "Model for Domain Information";
		document.getElementById("instruction").textContent = "Paste a domain name and press Enter.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Explanation";		
		document.getElementById("zone_role").textContent = "A domain zone is assigned (by ICANN) to a domain registry to manage domains.";
		document.getElementById("zone_registry_web_id").textContent = proposed;
		document.getElementById("zone_registry_full_name").textContent = proposed;
		document.getElementById("zone_menu").textContent = proposed + "A drop-down menu for explanations and details per zone via a subdomain of the registry.";
		document.getElementById("zone_support").textContent = proposed + "Help from the registry is possible by e-mail.";
		document.getElementById("zone_notices").textContent = "The use of domain data is subject to restrictions.";
		document.getElementById("view_role").textContent = "Web ID search can work with indexing in the database table on the global RDAP servers.";	
		document.getElementById("domain_role").textContent = "A web domain under a top-level domain is unique worldwide and can be freely chosen under certain rules.";
		document.getElementById("domain_name_unicode").textContent = "Names with special characters are stored as ASCII strings using Punycode transcription.";
		document.getElementById("events_role").textContent = proposed + "Country-specific domain control registers, DCR, based on the actual user.";
		document.getElementById("event_expiration_grace_until").textContent = "The 'deletion' in RDAP concerns an expected termination status in the administrative history.";
		document.getElementById("event_last_uploaded").textContent = "RDAP database update in Zulu Time (coordinated universal time - UTC).";
		document.getElementById("event_verification_requested").textContent = proposed + "The registry receives a signal in case of a matching web ID.";
		document.getElementById("event_verification_retrieved").textContent = proposed + "In the long term, verification can also be used by search engines.";
		document.getElementById("registrar_role").textContent = "A domain registrar takes care of domain reservations and IP address routing.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_iana_id").textContent = "With a gTLD domain and ICANN accreditation for one or more generic top-level domains.";
		document.getElementById("registrar_protected").textContent = derived;
		document.getElementById("registrar_abuse_role").textContent = "Abuse information facilitates contacting the registrar by a third party.";
		document.getElementById("reseller_role").textContent = "A domain reseller has responsibility, depending on the agreement and the regulations.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_protected").textContent = derived;
		document.getElementById("registrant_role").textContent = "A domain holder has at least the rights of a subscription to his domain.";
		document.getElementById("registrant_web_id").textContent = proposed + "Web Identification number for business entities and natural persons.";
		document.getElementById("registrant_full_name").textContent = "An existing (and visible) name of the user with actual or effective control.";
		document.getElementById("registrant_kind").textContent = "Empty, 'individual' or 'org'; a living will can fill a legal gap; suggestion: 'non-hidden individual'.";
		document.getElementById("registrant_name").textContent = "The 'full_name' field can contain a public personal name in the RDAP protocol.";
		document.getElementById("registrant_protected").textContent = derived;
		document.getElementById("admin_role").textContent = "The administratively responsible desk answers a request, and forwards on if necessary.";
		document.getElementById("admin_web_id").textContent = proposed;
		document.getElementById("admin_protected").textContent = derived;
		document.getElementById("tech_role").textContent = "A technical contact responds to resolve a reported malfunction.";
		document.getElementById("tech_web_id").textContent = proposed;
		document.getElementById("tech_protected").textContent = derived;
		document.getElementById("billing_role").textContent = "Some domain registries maintain records to perform their billing.";
		document.getElementById("billing_protected").textContent = derived;
		document.getElementById("emergency_role").textContent = proposed + "A responsible person can provide the necessary access.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_protected").textContent = derived;		
		document.getElementById("name_servers_role").textContent = "Name servers lead to IP addresses of web servers from a URL.";
		document.getElementById("name_servers_ip").textContent = "A glue record is required if the registrar's name servers are not used.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is a web route security feature on the DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "A DNSSEC algorithm starting from version 13 is up-to-date.";
		document.getElementById("raw_data_next").textContent ="US/EU: A next mature RDAP format requires unique field names, fixed field order, overview and appropriate 'non-public'.";
	}
	else if (translation == 3)	{
		var proposed = 'VORGESCHLAGEN - ';
		var derived = proposed + 'Nicht öffentliche Daten';
		document.getElementById("title").textContent = "Modell für Domäneninformationen";
		document.getElementById("instruction").textContent = "Fügen Sie einen Domänennamen ein und drücken Sie die Eingabetaste.";
		document.getElementById("field").textContent = "Beschreibung";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Erläuterung";		
		document.getElementById("zone_role").textContent = "Eine Domänenzone wird (von ICANN) einer Domänenregistrierungsstelle zugewiesen, um Domänen zu verwalten.";		
		document.getElementById("zone_registry_web_id").textContent = proposed;
		document.getElementById("zone_registry_full_name").textContent = proposed;
		document.getElementById("zone_menu").textContent = proposed + "Ein Dropdown-Menü für Erläuterungen und Details pro Zone über eine Subdomain der Registry.";
		document.getElementById("zone_support").textContent = proposed + "Hilfe aus der Registry ist per E-Mail möglich.";
		document.getElementById("zone_notices").textContent = "Die Nutzung der Domaindaten unterliegt Einschränkungen.";
		document.getElementById("view_role").textContent = "Die Web-ID-Suche kann mit der Indizierung in der Datenbanktabelle auf den globalen RDAP-Servern funktionieren.";
		document.getElementById("domain_role").textContent = "Eine Webdomain unter einer Top-Level-Domain ist weltweit einzigartig und unter bestimmten Regeln frei wählbar.";
		document.getElementById("domain_name_unicode").textContent = "Namen mit Sonderzeichen werden mittels Punycode-Transkription als ASCII-Strings gespeichert.";
		document.getElementById("events_role").textContent = proposed + "Länderspezifische Domänenkontrollregister (DCR), basierend auf dem tatsächlichen Benutzer.";
		document.getElementById("event_expiration_grace_until").textContent = "Bei der 'deletion' im RDAP handelt es sich um einen erwarteten Beendigungsstatus in der Verwaltungshistorie.";
		document.getElementById("event_last_uploaded").textContent = "RDAP-Datenbankaktualisierung in Zulu-Zeit (koordinierte Weltzeit – UTC).";
		document.getElementById("event_verification_requested").textContent = proposed + "Bei einer übereinstimmenden Web-ID erhält die Registrierungsstelle ein Signal.";
		document.getElementById("event_verification_retrieved").textContent = proposed + "Langfristig kann die Überprüfung auch von Suchmaschinen genutzt werden.";
		document.getElementById("registrar_role").textContent = "Ein Domain-Registrar kümmert sich um Domain-Reservierungen und IP-Adress-Routing.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_iana_id").textContent = "Mit einer gTLD-Domain und ICANN-Akkreditierung für eine oder mehrere generische Top-Level-Domains.";
		document.getElementById("registrar_protected").textContent = derived;
		document.getElementById("registrar_abuse_role").textContent = "Missbrauchsinformationen erleichtern die Kontaktaufnahme mit dem Registrar durch Dritte.";
		document.getElementById("reseller_role").textContent = "Ein Domain-Reseller trägt die Verantwortung, abhängig von der Vereinbarung und den Vorschriften.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_protected").textContent = derived;
		document.getElementById("registrant_role").textContent = "Ein Domaininhaber hat zumindest die Rechte eines Abonnements seiner Domain.";
		document.getElementById("registrant_web_id").textContent = proposed + "Web-Identifikationsnummer für Unternehmen und natürliche Personen.";
		document.getElementById("registrant_full_name").textContent = "Ein vorhandener (und sichtbarer) Name des Benutzers mit tatsächlicher oder effektiver Kontrolle.";
		document.getElementById("registrant_kind").textContent = "Leer, 'individual' oder 'org'; Eine Patientenverfügung kann eine rechtliche Lücke schließen; Anregung: 'non-hidden individual'.";
		document.getElementById("registrant_name").textContent = "Das Feld 'full_name' kann einen öffentlichen persönlichen Namen im RDAP-Protokoll enthalten.";
		document.getElementById("registrant_protected").textContent = derived;
		document.getElementById("admin_role").textContent = "Die administrativ zuständige Stelle beantwortet eine Anfrage und leitet sie gegebenenfalls weiter.";
		document.getElementById("admin_web_id").textContent = proposed;
		document.getElementById("admin_protected").textContent = derived;
		document.getElementById("tech_role").textContent = "Ein technischer Kontakt reagiert, um eine gemeldete Störung zu beheben.";
		document.getElementById("tech_web_id").textContent = proposed;
		document.getElementById("tech_protected").textContent = derived;
		document.getElementById("billing_role").textContent = "Einige Domänenregistrierungen führen Aufzeichnungen, um ihre Abrechnung durchzuführen.";
		document.getElementById("billing_protected").textContent = derived;
		document.getElementById("emergency_role").textContent = proposed + "Die erforderlichen Zugänge kann eine verantwortliche Person bereitstellen.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_protected").textContent = derived;
		document.getElementById("name_servers_role").textContent = "Nameserver führen von einer URL zu IP-Adressen von Webservern.";
		document.getElementById("name_servers_ip").textContent = "Ein Glue-Record ist erforderlich, wenn die Nameserver des Registrars nicht verwendet werden.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC ist eine Sicherheitsfunktion für Webrouten im DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Ein DNSSEC-Algorithmus ab Version 13 ist auf dem neuesten Stand.";
		document.getElementById("raw_data_next").textContent = "US/EU: Ein nächstes ausgereiftes RDAP-Format erfordert eindeutige Feldnamen, eine feste Feldreihenfolge, Übersicht und entsprechende 'non-public'.";
	}
	else if (translation == 4)	{
		var proposed = 'PROPOSÉ - ';
		var derived = proposed + 'Données non publiques';
		document.getElementById("title").textContent = "Modèle d'informations de domaine";
		document.getElementById("instruction").textContent = "Collez un nom de domaine et appuyez sur Entrée.";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Détail";
		document.getElementById("explanation").textContent = "Explication";		
		document.getElementById("zone_role").textContent = "Une zone de domaine est attribuée (par l'ICANN) à un registre de domaine pour gérer les domaines.";
		document.getElementById("zone_registry_web_id").textContent = proposed;
		document.getElementById("zone_registry_full_name").textContent = proposed;
		document.getElementById("zone_menu").textContent = proposed + "Un menu déroulant pour des explications et des détails par zone via un sous-domaine du registre.";
		document.getElementById("zone_support").textContent = proposed + "L'aide du registre est possible par e-mail.";
		document.getElementById("zone_notices").textContent = "L'utilisation des données de domaine est soumise à des restrictions.";
		document.getElementById("view_role").textContent = "La recherche d'ID Web peut fonctionner avec l'indexation dans la table de base de données sur les serveurs RDAP mondiaux.";
		document.getElementById("domain_role").textContent = "Un domaine Web sous un domaine de premier niveau est unique au monde et peut être choisi librement selon certaines règles.";
		document.getElementById("domain_name_unicode").textContent = "Les noms avec des caractères spéciaux sont stockés sous forme de chaînes ASCII à l'aide de la transcription Punycode.";
		document.getElementById("events_role").textContent = proposed + "Registres de contrôle de domaine spécifiques à chaque pays, DCR, basés sur l'utilisateur réel.";
		document.getElementById("event_expiration_grace_until").textContent = "La 'deletion' dans RDAP concerne un statut de résiliation attendu dans l'historique administratif.";
		document.getElementById("event_last_uploaded").textContent = "Mise à jour de la base de données RDAP dans Heure zoulou (temps universel coordonné - UTC).";
		document.getElementById("event_verification_requested").textContent = proposed + "Le registre reçoit un signal en cas d'identifiant Web correspondant.";
		document.getElementById("event_verification_retrieved").textContent = proposed + "À long terme, la vérification peut également être utilisée par les moteurs de recherche.";
		document.getElementById("registrar_role").textContent = "Un registraire de domaine s'occupe des réservations de domaine et du routage des adresses IP.";
		document.getElementById("registrar_web_id").textContent = proposed;
		document.getElementById("registrar_iana_id").textContent = "Avec un domaine gTLD et une accréditation ICANN pour un ou plusieurs domaines génériques de premier niveau.";
		document.getElementById("registrar_protected").textContent = derived;
		document.getElementById("registrar_abuse_role").textContent = "Les informations sur les abus facilitent la prise de contact avec le bureau d'enregistrement par un tiers.";
		document.getElementById("reseller_role").textContent = "Un revendeur de domaine a la responsabilité, en fonction de l'accord et de la réglementation.";
		document.getElementById("reseller_web_id").textContent = proposed;
		document.getElementById("reseller_protected").textContent = derived;
		document.getElementById("registrant_role").textContent = "Un titulaire de domaine a au moins les droits d'un abonnement à son domaine.";
		document.getElementById("registrant_web_id").textContent = proposed + "Numéro d’identification Web pour les entités commerciales et les personnes physiques.";
		document.getElementById("registrant_full_name").textContent = "Un nom existant (et visible) de l'utilisateur avec un contrôle réel ou effectif.";
		document.getElementById("registrant_kind").textContent = "Vide, 'individual' ou 'org' ; un testament biologique peut combler un vide juridique ; suggestion : 'non-hidden individual'.";
		document.getElementById("registrant_name").textContent = "Le champ 'full_name' peut contenir un nom personnel public dans le protocole RDAP.";
		document.getElementById("registrant_protected").textContent = derived;
		document.getElementById("admin_role").textContent = "Le bureau administrativement responsable répond à une demande, et la transmet si nécessaire.";
		document.getElementById("admin_web_id").textContent = proposed;
		document.getElementById("admin_protected").textContent = derived;
		document.getElementById("tech_role").textContent = "Un contact technique répond pour résoudre un dysfonctionnement signalé.";
		document.getElementById("tech_web_id").textContent = proposed;
		document.getElementById("tech_protected").textContent = derived;
		document.getElementById("billing_role").textContent = "Certains registres de domaine conservent des enregistrements pour effectuer leur facturation.";
		document.getElementById("billing_protected").textContent = derived;
		document.getElementById("emergency_role").textContent = proposed + "Une personne responsable peut fournir l'accès nécessaire.";
		document.getElementById("emergency_web_id").textContent = proposed;
		document.getElementById("emergency_protected").textContent = derived;		
		document.getElementById("name_servers_role").textContent = "Les serveurs de noms mènent aux adresses IP des serveurs Web à partir d'une URL.";
		document.getElementById("name_servers_ip").textContent = "Un enregistrement Glue est requis si les serveurs de noms du registraire ne sont pas utilisés.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC est une fonctionnalité de sécurité de route Web sur le DNS (Domain Name System).";
		document.getElementById("name_servers_dnssec_algorithm").textContent = "Un algorithme DNSSEC à partir de la version 13 est à jour.";
		document.getElementById("raw_data_next").textContent = "US/EU: Un prochain format RDAP mature nécessite des noms de champs uniques, un ordre des champs fixe, une vue d'ensemble et un 'non-public' approprié.";
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
//$rdap_url = 'https://rdap.hostingtool.nl/compose_domain/index.php?domain='.$viewdomain;	
$rdap_url = isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
$rdap_url .= '://'. $_SERVER['HTTP_HOST'];
$rdap_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);	
$rdap_url = dirname($rdap_url).'/compose_domain/index.php?domain='.$viewdomain;
if (@get_headers($rdap_url))	{ // the application to compose for zone data
	$xml1 = simplexml_load_file($rdap_url, "SimpleXMLElement", LIBXML_NOCDATA) or die("An entered domain could not be read.");
}
$html_text = '<body onload=SwitchTranslation('.$viewlanguage.')><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem; table-layout: fixed; width:1375px">
<tr><th style="width:325px"></th><th style="width:300px"></th><th style="width:750px"></th></tr>';

$html_text .= '<tr style="font-size: .8rem"><td id="title" style="font-size: 1.3rem;color:blue;font-weight:bold"></td><td colspan="2" id="instruction"></td></tr>';
$html_text .= '<tr style="font-size: .8rem"><td></td><td><form action='.htmlentities($_SERVER['PHP_SELF']).' method="get">
	<input type="hidden" id="language" name="language" value='.$viewlanguage.'>	
	<input type="text" style="width:90%" id="domain" name="domain" value='.$viewdomain.'></form>
	<label for="domain">biz/com/net/org/ca/ch/de/fr/nl/uk/amsterdam/politie</label></td><td>
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(0)">none</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(1)">nl_NL</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(2)">en_US</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(3)">de_DE</button> 
	<button style="cursor:pointer;font-size:1.0rem" onclick="SwitchTranslation(4)">fr_FR</button> 
	<a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_email" target="_blank">modeling_email</a> - <a style="font-size: 0.9rem" href="https://rdap.hostingtool.nl/modeling_menu" target="_blank">modeling_menu</a> - <a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap_view_model/issues" target="_blank">issues on GitHub</a> - <a style="font-size: 0.9rem" href="https://janwillemstegink.nl/" target="_blank">janwillemstegink.nl</a></td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr style="font-size:1.05rem;font-weight:bold"><td id="field"></td><td id="value"><td id="explanation"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(10)">zone +/-</button></td><td>'.$item->zone->zone_top_level_domain.'</td><td id="zone_role"></td></tr>';
	$html_text .= '<tr id="101" style="display:none"><td>zone_registry_web_id</td><td>'.$item->zone->zone_registry_web_id.'</td><td id="zone_registry_web_id"></td></tr>';
	$html_text .= '<tr id="102" style="display:none"><td>zone_registry_full_name</td><td>'.$item->zone->zone_registry_full_name.'</td><td id="zone_registry_full_name"></td></tr>';
	$html_text .= '<tr id="103" style="display:none"><td>zone_registry_language</td><td>'.$item->zone->zone_registry_language.'</td><td></td></tr>';
	$html_text .= '<tr id="104" style="display:none"><td>zone_menu</td><td>'.$item->zone->zone_menu.'</td><td id="zone_menu"></td></tr>';
	$html_text .= '<tr id="105" style="display:none"><td>zone_support</td><td>'.$item->zone->zone_support.'</td><td id="zone_support"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(11)">notice0 +/-</button> <button style="cursor:pointer;font-size:1.0rem" onclick="SwitchDisplay(12)">notice1 +/-</button> <button style="cursor:pointer;font-size:1.0rem" onclick="SwitchDisplay(13)">notice2 +/-</button></td><td></td><td id="zone_notices"></td></tr>';
	$html_text .= '<tr id="111" style="display:none;vertical-align:top"><td>zone_notice_0_title</td><td>'.$item->zone->zone_notice_0_title.'</td><td></td></tr>';
	$html_text .= '<tr id="112" style="display:none;vertical-align:top"><td>zone_notice_0_description_0</td><td>'.$item->zone->zone_notice_0_description_0.'</td><td></td></tr>';
	$html_text .= '<tr id="113" style="display:none;vertical-align:top"><td>zone_notice_0_description_1</td><td>'.$item->zone->zone_notice_0_description_1.'</td><td></td></tr>';
	$html_text .= '<tr id="114" style="display:none;vertical-align:top"><td>zone_notice_0_links_0_href</td><td>'.$item->zone->zone_notice_0_links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="115" style="display:none;vertical-align:top"><td>zone_notice_0_links_0_type</td><td>'.$item->zone->zone_notice_0_links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr id="121" style="display:none;vertical-align:top"><td>zone_notice_1_title</td><td>'.$item->zone->zone_notice_1_title.'</td><td></td></tr>';
	$html_text .= '<tr id="122" style="display:none;vertical-align:top"><td>zone_notice_1_description_0</td><td>'.$item->zone->zone_notice_1_description_0.'</td><td></td></tr>';
	$html_text .= '<tr id="123" style="display:none;vertical-align:top"><td>zone_notice_1_description_1</td><td>'.$item->zone->zone_notice_1_description_1.'</td><td></td></tr>';
	$html_text .= '<tr id="124" style="display:none;vertical-align:top"><td>zone_notice_1_links_0_href</td><td>'.$item->zone->zone_notice_1_links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="125" style="display:none;vertical-align:top"><td>zone_notice_1_links_0_type</td><td>'.$item->zone->zone_notice_1_links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr id="131" style="display:none;vertical-align:top"><td>zone_notice_2_title</td><td>'.$item->zone->zone_notice_2_title.'</td><td></td></tr>';
	$html_text .= '<tr id="132" style="display:none;vertical-align:top"><td>zone_notice_2_description_0</td><td>'.$item->zone->zone_notice_2_description_0.'</td><td></td></tr>';
	$html_text .= '<tr id="133" style="display:none;vertical-align:top"><td>zone_notice_2_description_1</td><td>'.$item->zone->zone_notice_2_description_1.'</td><td></td></tr>';
	$html_text .= '<tr id="134" style="display:none;vertical-align:top"><td>zone_notice_2_links_0_href</td><td>'.$item->zone->zone_notice_2_links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="135" style="display:none;vertical-align:top"><td>zone_notice_2_links_0_type</td><td>'.$item->zone->zone_notice_2_links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(20)">view0 +/-</button> <button style="cursor:pointer;font-size:1.0rem" onclick="SwitchDisplay(21)">view1 +/-</button></td><td></td><td id="view_role"></td></tr>';
	$html_text .= '<tr id="201" style="display:none;vertical-align:top"><td>view_links_0_value</td><td>'.$item->view->view_links_0_value.'</td><td></td></tr>';
	$html_text .= '<tr id="202" style="display:none;vertical-align:top"><td>view_links_0_related</td><td>'.$item->view->view_links_0_related.'</td><td></td></tr>';
	$html_text .= '<tr id="203" style="display:none;vertical-align:top"><td>view_links_0_href</td><td>'.$item->view->view_links_0_href.'</td><td></td></tr>';
	$html_text .= '<tr id="204" style="display:none;vertical-align:top"><td>view_links_0_href_lang</td><td>'.$item->view->view_links_0_href_lang.'</td><td></td></tr>';
	$html_text .= '<tr id="205" style="display:none;vertical-align:top"><td>view_links_0_title</td><td>'.$item->view->view_links_0_title.'</td><td></td></tr>';
	$html_text .= '<tr id="206" style="display:none;vertical-align:top"><td>view_links_0_media</td><td>'.$item->view->view_links_0_media.'</td><td></td></tr>';
	$html_text .= '<tr id="207" style="display:none;vertical-align:top"><td>view_links_0_type</td><td>'.$item->view->view_links_0_type.'</td><td></td></tr>';
	$html_text .= '<tr id="211" style="display:none;vertical-align:top"><td>view_links_1_value</td><td>'.$item->view->view_links_1_value.'</td><td></td></tr>';
	$html_text .= '<tr id="212" style="display:none;vertical-align:top"><td>view_links_1_related</td><td>'.$item->view->view_links_1_related.'</td><td></td></tr>';
	$html_text .= '<tr id="213" style="display:none;vertical-align:top"><td>view_links_1_href</td><td>'.$item->view->view_links_1_href.'</td><td></td></tr>';
	$html_text .= '<tr id="214" style="display:none;vertical-align:top"><td>view_links_1_href_lang</td><td>'.$item->view->view_links_1_href_lang.'</td><td></td></tr>';
	$html_text .= '<tr id="215" style="display:none;vertical-align:top"><td>view_links_1_title</td><td>'.$item->view->view_links_1_title.'</td><td></td></tr>';
	$html_text .= '<tr id="216" style="display:none;vertical-align:top"><td>view_links_1_media</td><td>'.$item->view->view_links_1_media.'</td><td></td></tr>';
	$html_text .= '<tr id="217" style="display:none;vertical-align:top"><td>view_links_1_type</td><td>'.$item->view->view_links_1_type.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(30)">domain +/-</button></td><td><b>'.$item->domain_name.'</b></td><td id="domain_role"></td></tr>';
	$html_text .= '<tr id="301" style="display:none"><td>domain_handle</td><td>'.$item->domain_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="302" style="display:none"><td>domain_name_unicode</td><td>'.$item->domain_name_unicode.'</td><td id="domain_name_unicode"></td></tr>';
	$html_text .= '<tr id="303" style="display:none;vertical-align:top"><td>domain_status</td><td>'.$item->domain_status.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(31)">events +/-</button></td><td></td><td id="events_role"></td></tr>';
	$html_text .= '<tr id="311" style="display:none;vertical-align:top"><td>event_registration</td><td>'.$item->event_registration.'</td><td></td></tr>';
	$html_text .= '<tr><td>event_expiration</td><td>'.$item->event_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="312" style="display:none"><td>event_expiration_grace_until</td><td>'.$item->event_expiration_grace_until.'</td><td id="event_expiration_grace_until"></td></tr>';
	$html_text .= '<tr id="313" style="display:none"><td>event_last_transferred</td><td>'.$item->event_last_transferred.'</td><td></td></tr>';
	$html_text .= '<tr><td>event_last_changed</td><td>'.$item->event_last_changed.'</td><td></td></tr>';
	$html_text .= '<tr id="314" style="display:none"><td>event_verification_requested</td><td>'.$item->event_verification_requested.'</td><td id="event_verification_requested"></td></tr>';
	$html_text .= '<tr id="315" style="display:none"><td>event_verification_retrieved</td><td>'.$item->event_verification_retrieved.'</td><td id="event_verification_retrieved"></td></tr>';
	$html_text .= '<tr id="316" style="display:none"><td>event_last_uploaded</td><td>'.$item->event_last_uploaded.'</td><td id="event_last_uploaded"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(40)">registrant +/-</button></td><td></td><td id="registrant_role"></td></tr>';
	$html_text .= '<tr id="401" style="display:none"><td>registrant_handle</td><td>'.$item->registrant->registrant_handle.'</td><td></td></tr>';
	$html_text .= '<tr><td>registrant_web_id</td><td>'.$item->registrant->registrant_web_id.'</td><td id="registrant_web_id"></td></tr>';
	$html_text .= '<tr><td>registrant_full_name</td><td><b>'.$item->registrant->registrant_full_name.'</b></td><td id="registrant_full_name"></td></tr>';
	$html_text .= '<tr><td>registrant_kind</td><td>'.$item->registrant->registrant_kind.'</td><td id="registrant_kind"></td></tr>';
	$html_text .= '<tr id="402" style="display:none"><td>registrant_name</td><td><b>'.$item->registrant->registrant_name.'</b></td><td id="registrant_name"></td></tr>';
	$html_text .= '<tr id="403" style="display:none"><td>registrant_phone</td><td>'.$item->registrant->registrant_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="404" style="display:none"><td>registrant_fax</td><td>'.$item->registrant->registrant_fax.'</td><td></td></tr>';
	$html_text .= '<tr id="405" style="display:none"><td>registrant_email</td><td>'.$item->registrant->registrant_email.'</td><td></td></tr>';
	$html_text .= '<tr id="406" style="display:none"><td>registrant_street</td><td>'.$item->registrant->registrant_street.'</td><td></td></tr>';
	$html_text .= '<tr id="407" style="display:none"><td>registrant_postal_code</td><td>'.$item->registrant->registrant_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="408" style="display:none"><td>registrant_city</td><td>'.$item->registrant->registrant_city.'</td><td></td></tr>';
	$html_text .= '<tr id="409" style="display:none"><td>registrant_state_province</td><td>'.$item->registrant->registrant_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="4010" style="display:none"><td>registrant_country_code</td><td>'.$item->registrant->registrant_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4011" style="display:none"><td>registrant_language_pref_1</td><td>'.$item->registrant->registrant_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4012" style="display:none"><td>registrant_language_pref_2</td><td>'.$item->registrant->registrant_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4013" style="display:none"><td>registrant_protected</td><td>'.$item->registrant->registrant_protected.'</td><td id="registrant_protected"></td></tr>';
	$segregationofduties = '';
	if (strlen($item->admin->admin_email) and strlen($item->tech->tech_email) and !strcmp($item->admin->admin_email, $item->tech->tech_email))	{
		//$segregationofduties = 'analyzed as no separation of duties';
	}
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(41)">admin / decision +/-</button></td><td><i>'.$segregationofduties.'</i></td><td id="admin_role"></td></tr>';
	$html_text .= '<tr id="411" style="display:none"><td>admin_handle</td><td>'.$item->admin->admin_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="412" style="display:none"><td>admin_web_id</td><td>'.$item->admin->admin_web_id.'</td><td id="admin_web_id"></td></tr>';
	$html_text .= '<tr id="413" style="display:none"><td>admin_full_name</td><td>'.$item->admin->admin_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="414" style="display:none"><td>admin_kind</td><td>'.$item->admin->admin_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="415" style="display:none"><td>admin_name</td><td>'.$item->admin->admin_name.'</td><td></td></tr>';
	$html_text .= '<tr id="416" style="display:none"><td>admin_phone</td><td>'.$item->admin->admin_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="417" style="display:none"><td>admin_fax</td><td>'.$item->admin->admin_fax.'</td><td></td></tr>';
	$html_text .= '<tr><td>admin_email</td><td>'.$item->admin->admin_email.'</td><td></td></tr>';
	$html_text .= '<tr id="418" style="display:none"><td>admin_street</td><td>'.$item->admin->admin_street.'</td><td></td></tr>';
	$html_text .= '<tr id="419" style="display:none"><td>admin_postal_code</td><td>'.$item->admin->admin_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4110" style="display:none"><td>admin_city</td><td>'.$item->admin->admin_city.'</td><td></td></tr>';
	$html_text .= '<tr id="4111" style="display:none"><td>admin_state_province</td><td>'.$item->admin->admin_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="4112" style="display:none"><td>admin_country_code</td><td>'.$item->admin->admin_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4113" style="display:none"><td>admin_language_pref_1</td><td>'.$item->admin->admin_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4114" style="display:none"><td>admin_language_pref_2</td><td>'.$item->admin->admin_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4115" style="display:none"><td>admin_protected</td><td>'.$item->admin->admin_protected.'</td><td id="admin_protected"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(42)">tech / onsite +/-</button></td><td></td><td id="tech_role"></td></tr>';
	$html_text .= '<tr id="421" style="display:none"><td>tech_handle</td><td>'.$item->tech->tech_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="422" style="display:none"><td>tech_web_id</td><td>'.$item->tech->tech_web_id.'</td><td id="tech_web_id"></td></tr>';
	$html_text .= '<tr id="423" style="display:none"><td>tech_full_name</td><td>'.$item->tech->tech_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="424" style="display:none"><td>tech_kind</td><td>'.$item->tech->tech_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="425" style="display:none"><td>tech_name</td><td>'.$item->tech->tech_name.'</td><td></td></tr>';
	$html_text .= '<tr id="426" style="display:none"><td>tech_phone</td><td>'.$item->tech->tech_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="427" style="display:none"><td>tech_fax</td><td>'.$item->tech->tech_fax.'</td><td></td></tr>';
	$html_text .= '<tr><td>tech_email</td><td>'.$item->tech->tech_email.'</td><td></td></tr>';
	$html_text .= '<tr id="428" style="display:none"><td>tech_street</td><td>'.$item->tech->tech_street.'</td><td></td></tr>';
	$html_text .= '<tr id="429" style="display:none"><td>tech_postal_code</td><td>'.$item->tech->tech_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4210" style="display:none"><td>tech_city</td><td>'.$item->tech->tech_city.'</td><td></td></tr>';
	$html_text .= '<tr id="4211" style="display:none"><td>tech_state_province</td><td>'.$item->tech->tech_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="4212" style="display:none"><td>tech_country_code</td><td>'.$item->tech->tech_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4213" style="display:none"><td>tech_language_pref_1</td><td>'.$item->tech->tech_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4214" style="display:none"><td>tech_language_pref_2</td><td>'.$item->tech->tech_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4215" style="display:none"><td>tech_protected</td><td>'.$item->tech->tech_protected.'</td><td id="tech_protected"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(43)">billing +/-</button></td><td></td><td id="billing_role"></td></tr>';
	$html_text .= '<tr id="431" style="display:none"><td>billing_handle</td><td>'.$item->billing->billing_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="432" style="display:none"><td>billing_web_id</td><td>'.$item->billing->billing_web_id.'</td><td></td></tr>';
	$html_text .= '<tr id="433" style="display:none"><td>billing_full_name</td><td>'.$item->billing->billing_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="434" style="display:none"><td>billing_kind</td><td>'.$item->billing->billing_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="435" style="display:none"><td>billing_name</td><td>'.$item->billing->billing_name.'</td><td></td></tr>';
	$html_text .= '<tr id="436" style="display:none"><td>billing_phone</td><td>'.$item->billing->billing_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="437" style="display:none"><td>billing_fax</td><td>'.$item->billing->billing_fax.'</td><td></td></tr>';
	$html_text .= '<tr id="438" style="display:none"><td>billing_email</td><td>'.$item->billing->billing_email.'</td><td></td></tr>';
	$html_text .= '<tr id="439" style="display:none"><td>billing_street</td><td>'.$item->billing->billing_street.'</td><td></td></tr>';
	$html_text .= '<tr id="4310" style="display:none"><td>billing_postal_code</td><td>'.$item->billing->billing_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4311" style="display:none"><td>billing_city</td><td>'.$item->billing->billing_city.'</td><td></td></tr>';
	$html_text .= '<tr id="4312" style="display:none"><td>billing_state_province</td><td>'.$item->billing->billing_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="4313" style="display:none"><td>billing_country_code</td><td>'.$item->billing->billing_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4314" style="display:none"><td>billing_language_pref_1</td><td>'.$item->billing->billing_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4315" style="display:none"><td>billing_language_pref_2</td><td>'.$item->billing->billing_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4316" style="display:none"><td>billing_protected</td><td>'.$item->billing->billing_protected.'</td><td id="billing_protected"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(44)">emergency +/-</button></td><td></td><td id="emergency_role"></td></tr>';
	$html_text .= '<tr id="441" style="display:none"><td>emergency_handle</td><td>'.$item->emergency->emergency_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="442" style="display:none"><td>emergency_web_id</td><td>'.$item->emergency->emergency_web_id.'</td><td id="emergency_web_id"></td></tr>';
	$html_text .= '<tr id="443" style="display:none"><td>emergency_full_name</td><td>'.$item->emergency->emergency_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="444" style="display:none"><td>emergency_kind</td><td>'.$item->emergency->emergency_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="445" style="display:none"><td>emergency_name</td><td>'.$item->emergency->emergency_name.'</td><td></td></tr>';
	$html_text .= '<tr id="446" style="display:none"><td>emergency_phone</td><td>'.$item->emergency->emergency_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="447" style="display:none"><td>emergency_fax</td><td>'.$item->emergency->emergency_fax.'</td><td></td></tr>';
	$html_text .= '<tr><td>emergency_email</td><td>'.$item->emergency->emergency_email.'</td><td></td></tr>';
	$html_text .= '<tr id="448" style="display:none"><td>emergency_street</td><td>'.$item->emergency->emergency_street.'</td><td></td></tr>';
	$html_text .= '<tr id="449" style="display:none"><td>emergency_postal_code</td><td>'.$item->emergency->emergency_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4410" style="display:none"><td>emergency_city</td><td>'.$item->emergency->emergency_city.'</td><td></td></tr>';
	$html_text .= '<tr id="4411" style="display:none"><td>emergency_state_province</td><td>'.$item->emergency->emergency_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="4412" style="display:none"><td>emergency_country_code</td><td>'.$item->emergency->emergency_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4413" style="display:none"><td>emergency_language_pref_1</td><td>'.$item->emergency->emergency_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4414" style="display:none"><td>emergency_language_pref_2</td><td>'.$item->emergency->emergency_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4415" style="display:none"><td>emergency_protected</td><td>'.$item->emergency->emergency_protected.'</td><td id="emergency_protected"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	//if (!empty($item->reseller->reseller_full_name))	{
	//	if (strlen(trim($item->reseller->reseller_full_name)))	{
			$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(50)">reseller +/-</button></td><td></td><td id="reseller_role"></td></tr>';
			$html_text .= '<tr id="501" style="display:none"><td>reseller_handle</td><td>'.$item->reseller->reseller_handle.'</td><td></td></tr>';
			$html_text .= '<tr id="502" style="display:none"><td>reseller_web_id</td><td>'.$item->reseller->reseller_web_id.'</td><td id="reseller_web_id"></td></tr>';
			$html_text .= '<tr><td>reseller_full_name</td><td>'.$item->reseller->reseller_full_name.'</td><td></td></tr>';
			$html_text .= '<tr id="503" style="display:none"><td>reseller_kind</td><td>'.$item->reseller->reseller_kind.'</td><td></td></tr>';
			$html_text .= '<tr id="504" style="display:none"><td>reseller_name</td><td>'.$item->reseller->reseller_name.'</td><td></td></tr>';
			$html_text .= '<tr id="505" style="display:none"><td>reseller_phone</td><td>'.$item->reseller->reseller_phone.'</td><td></td></tr>';
			$html_text .= '<tr id="506" style="display:none"><td>reseller_fax</td><td>'.$item->reseller->reseller_fax.'</td><td></td></tr>';
			$html_text .= '<tr id="507" style="display:none"><td>reseller_email</td><td>'.$item->reseller->reseller_email.'</td><td></td></tr>';			
			$html_text .= '<tr id="508" style="display:none"><td>reseller_street</td><td>'.$item->reseller->reseller_street.'</td><td></td></tr>';
			$html_text .= '<tr id="509" style="display:none"><td>reseller_postal_code</td><td>'.$item->reseller->reseller_postal_code.'</td><td></td></tr>';
			$html_text .= '<tr id="5010" style="display:none"><td>reseller_city</td><td>'.$item->reseller->reseller_city.'</td><td></td></tr>';
			$html_text .= '<tr id="5011" style="display:none"><td>reseller_state_province</td><td>'.$item->reseller->reseller_state_province.'</td><td></td></tr>';			
			$html_text .= '<tr id="5012" style="display:none"><td>reseller_country_code</td><td>'.$item->reseller->reseller_country_code.'</td><td></td></tr>';
			$html_text .= '<tr id="5013" style="display:none"><td>reseller_language_pref_1</td><td>'.$item->reseller->reseller_language_pref_1.'</td><td></td></tr>';
			$html_text .= '<tr id="5014" style="display:none"><td>reseller_language_pref_2</td><td>'.$item->reseller->reseller_language_pref_2.'</td><td></td></tr>';
			$html_text .= '<tr id="5015" style="display:none"><td>reseller_protected</td><td>'.$item->reseller->reseller_protected.'</td><td id="reseller_protected"></td></tr>';		
			$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	//	}	
	//}
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(60)">registrar +/-</button></td><td></td><td id="registrar_role"></td></tr>';
	$html_text .= '<tr id="601" style="display:none"><td>registrar_handle</td><td>'.$item->registrar->registrar_handle.'</td><td></td></tr>';
	$html_text .= '<tr id="602" style="display:none"><td>registrar_web_id</td><td>'.$item->registrar->registrar_web_id.'</td><td id="registrar_web_id"></td></tr>';		
	$html_text .= '<tr><td>registrar_full_name</td><td>'.$item->registrar->registrar_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="603" style="display:none"><td>registrar_kind</td><td>'.$item->registrar->registrar_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="604" style="display:none"><td>registrar_url</td><td>'.$item->registrar->registrar_url.'</td><td></td></tr>';
	$html_text .= '<tr id="605" style="display:none"><td>registrar_iana_id</td><td>'.$item->registrar->registrar_iana_id.'</td><td id="registrar_iana_id"></td></tr>';
	$html_text .= '<tr id="606" style="display:none"><td>registrar_name</td><td>'.$item->registrar->registrar_name.'</td><td></td></tr>';
	$html_text .= '<tr id="607" style="display:none"><td>registrar_phone</td><td>'.$item->registrar->registrar_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="608" style="display:none"><td>registrar_fax</td><td>'.$item->registrar->registrar_fax.'</td><td></td></tr>';
	$html_text .= '<tr id="609" style="display:none"><td>registrar_email</td><td>'.$item->registrar->registrar_email.'</td><td></td></tr>';
	$html_text .= '<tr id="6010" style="display:none"><td>registrar_street</td><td>'.$item->registrar->registrar_street.'</td><td></td></tr>';
	$html_text .= '<tr id="6011" style="display:none"><td>registrar_postal_code</td><td>'.$item->registrar->registrar_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6012" style="display:none"><td>registrar_city</td><td>'.$item->registrar->registrar_city.'</td><td></td></tr>';
	$html_text .= '<tr id="6013" style="display:none"><td>registrar_state_province</td><td>'.$item->registrar->registrar_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="6014" style="display:none"><td>registrar_country_code</td><td>'.$item->registrar->registrar_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6015" style="display:none"><td>registrar_language_pref_1</td><td>'.$item->registrar->registrar_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="6016" style="display:none"><td>registrar_language_pref_2</td><td>'.$item->registrar->registrar_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="6017" style="display:none"><td>registrar_protected</td><td>'.$item->registrar->registrar_protected.'</td><td id="registrar_protected"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(61)">registrar abuse +/-</button></td><td></td><td id="registrar_abuse_role"></td></tr>';
	$html_text .= '<tr id="611" style="display:none"><td>registrar_abuse_phone</td><td>'.$item->registrar->registrar_abuse_phone.'</td><td></td></tr>';
	$html_text .= '<tr><td>registrar_abuse_email</td><td>'.$item->registrar->registrar_abuse_email.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(62)">name servers +/-</button></td><td></td><td id="name_servers_role"></td></tr>';
	if (!empty($item->name_servers->server_1->server_name_1))	{
		if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
			$html_text .= '<tr id="621" style="display:none"><td>server_name_1</td><td>'.$item->name_servers->server_1->server_name_1.'</td><td></td></tr>';
			$html_text .= '<tr id="622" style="display:none"><td>server_name_unicode_1</td><td>'.$item->name_servers->server_1->server_name_unicode_1.'</td><td></td></tr>';
			$html_text .= '<tr id="623" style="display:none"><td>server_ipv4_1</td><td>'.$item->name_servers->server_1->server_ipv4_1.'</td><td id="name_servers_ip"></td></tr>';
			$html_text .= '<tr id="624" style="display:none"><td>server_ipv6_1</td><td>'.$item->name_servers->server_1->server_ipv6_1.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_1->server_name_1))	{		
		if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
			$html_text .= '<tr id="625" style="display:none"><td>server_name_2</td><td>'.$item->name_servers->server_2->server_name_2.'</td><td></td></tr>';
			$html_text .= '<tr id="626" style="display:none"><td>server_name_unicode_2</td><td>'.$item->name_servers->server_2->server_name_unicode_2.'</td><td></td></tr>';
			$html_text .= '<tr id="627" style="display:none"><td>server_ipv4_2</td><td>'.$item->name_servers->server_2->server_ipv4_2.'</td><td></td></tr>';
			$html_text .= '<tr id="628" style="display:none"><td>server_ipv6_2</td><td>'.$item->name_servers->server_2->server_ipv6_2.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_3->server_name_3))	{
		if (strlen(trim($item->name_servers->server_3->server_name_3)))	{
			$html_text .= '<tr id="629" style="display:none"><td>server_name_3</td><td>'.$item->name_servers->server_3->server_name_3.'</td><td></td></tr>';
			$html_text .= '<tr id="6210" style="display:none"><td>server_name_unicode_3</td><td>'.$item->name_servers->server_3->server_name_unicode_3.'</td><td></td></tr>';
			$html_text .= '<tr id="6211" style="display:none"><td>server_ipv4_3</td><td>'.$item->name_servers->server_3->server_ipv4_3.'</td><td></td></tr>';
			$html_text .= '<tr id="6212" style="display:none"><td>server_ipv6_3</td><td>'.$item->name_servers->server_3->server_ipv6_3.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_4->server_name_4))	{	
		if (strlen(trim($item->name_servers->server_4->server_name_4)))	{
			$html_text .= '<tr id="6213" style="display:none"><td>server_name_4</td><td>'.$item->name_servers->server_4->server_name_4.'</td><td></td></tr>';
			$html_text .= '<tr id="6214" style="display:none"><td>server_name_unicode_4</td><td>'.$item->name_servers->server_4->server_name_unicode_4.'</td><td></td></tr>';
			$html_text .= '<tr id="6215" style="display:none"><td>server_ipv4_4</td><td>'.$item->name_servers->server_4->server_ipv4_4.'</td><td></td></tr>';
			$html_text .= '<tr id="6216" style="display:none"><td>server_ipv6_4</td><td>'.$item->name_servers->server_4->server_ipv6_4.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_5->server_name_5))	{		
		if (strlen(trim($item->name_servers->server_5->server_name_5)))	{
			$html_text .= '<tr id="6217" style="display:none"><td>server_name_5</td><td>'.$item->name_servers->server_5->server_name_5.'</td><td></td></tr>';
			$html_text .= '<tr id="6218" style="display:none"><td>server_name_unicode_5</td><td>'.$item->name_servers->server_5->server_name_unicode_5.'</td><td></td></tr>';
			$html_text .= '<tr id="6219" style="display:none"><td>server_ipv4_5</td><td>'.$item->name_servers->server_5->server_ipv4_5.'</td><td></td></tr>';
			$html_text .= '<tr id="6220" style="display:none"><td>server_ipv6_5</td><td>'.$item->name_servers->server_5->server_ipv6_5.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_6->server_name_6))	{
		if (strlen(trim($item->name_servers->server_6->server_name_6)))	{
			$html_text .= '<tr id="6221" style="display:none"><td>server_name_6</td><td>'.$item->name_servers->server_6->server_name_6.'</td><td></td></tr>';
			$html_text .= '<tr id="6222" style="display:none"><td>server_name_unicode_6</td><td>'.$item->name_servers->server_6->server_name_unicode_6.'</td><td></td></tr>';
			$html_text .= '<tr id="6223" style="display:none"><td>server_ipv4_6</td><td>'.$item->name_servers->server_6->server_ipv4_6.'</td><td></td></tr>';
			$html_text .= '<tr id="6224" style="display:none"><td>server_ipv6_6</td><td>'.$item->name_servers->server_6->server_ipv6_6.'</td><td></td></tr>';
		}	
	}
	$html_text .= '<tr><td>name_servers_dnssec</td><td>'.$item->name_servers->name_servers_dnssec.'</td><td id="name_servers_dnssec"></td></tr>';
	$html_text .= '<tr><td>name_servers_dnssec_algorithm</td><td>'.$item->name_servers->name_servers_dnssec_algorithm.'</td><td id="name_servers_dnssec_algorithm"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;font-size:1.05rem" onclick="SwitchDisplay(70)">raw data +/-</button></td><td colspan="2" id="raw_data_next"></td></tr>';
	$html_text .= '<tr id="701" style="display:none"><td colspan="3">'.$item->raw_data.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>