<?php
session_start();  // is needed with no Scriptcase PHP Generator
$inputlanguage = 2;
echo '<!DOCTYPE html><html lang="en" style="font-size: 90%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>Web domain data visualization template</title>';
?><script>
	
function SwitchDisplay(type) {
	if (type == 10)			{ // zone
		var pre = '10';
		var max = 7
	}
	else if (type == 11)	{ // restrictions legal
		var pre = '11';
		var max = 5
	}
	else if (type == 12)	{ // restrictions translated
		var pre = '12';
		var max = 5
	}
	else if (type == 20)	{ // view
		var pre = '20';
		var max = 8
	}
	else if (type == 30)	{ // domain
		var pre = '30';
		var max = 8
	}
	else if (type == 40)	{ // registrar
		var pre = '40';
		var max = 16
	}
	else if (type == 45)	{ // abuse
		var pre = '45';
		var max = 2
	}
	else if (type == 50)	{ // reseller
		var pre = '50';
		var max = 14
	}
	else if (type == 60)	{ // registrant
		var pre = '60';
		var max = 14
	}
	else if (type == 70)	{ // admin
		var pre = '70';
		var max = 15
	}
	else if (type == 80)	{ // tech
		var pre = '80';
		var max = 15
	}
	else if (type == 90)	{ // billing
		var pre = '90';
		var max = 16
	}
	else if (type == 95)	{ // name servers
		var pre = '95';
		var max = 24
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

function SwitchTranslation(inputlanguage)	{
	if (inputlanguage == 0)	{
		var proposedfield = '';
		var derivedfield = '';
		document.getElementById("title").textContent = "Model";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "";
		document.getElementById("view_role").textContent = "";
		document.getElementById("view_datetime").textContent = proposedfield;
		document.getElementById("view_type").textContent = proposedfield;
		document.getElementById("zone_role").textContent = "";
		document.getElementById("zone_menu").textContent = proposedfield;
		document.getElementById("zone_support").textContent = proposedfield;
		document.getElementById("zone_registry_web_id").textContent = proposedfield;
		document.getElementById("zone_registry_full_name").textContent = proposedfield;
		document.getElementById("zone_restrictions").textContent = "";
		document.getElementById("domain_role").textContent = "";
		document.getElementById("domain_name_unicode").textContent = "";
		document.getElementById("domain_renewed").textContent = proposedfield;
		document.getElementById("domain_refreshed").textContent = "";
		document.getElementById("registrar_role").textContent = "";
		document.getElementById("registrar_web_id").textContent = "";
		document.getElementById("registrar_iana_id").textContent = "";
		document.getElementById("registrar_protected").textContent = derivedfield;
		document.getElementById("registrar_abuse_role").textContent = "";
		document.getElementById("reseller_role").textContent = "";
		document.getElementById("reseller_web_id").textContent = "";
		document.getElementById("reseller_protected").textContent = derivedfield;
		document.getElementById("registrant_role").textContent = "";
		document.getElementById("registrant_web_id").textContent = "";
		document.getElementById("registrant_full_name").textContent = "";
		document.getElementById("registrant_name").textContent = "";
		document.getElementById("registrant_protected").textContent = derivedfield;
		document.getElementById("admin_role").textContent = "";
		document.getElementById("admin_web_id").textContent = "";
		document.getElementById("admin_full_name").textContent = proposedfield;
		document.getElementById("admin_protected").textContent = derivedfield;
		document.getElementById("tech_role").textContent = "";
		document.getElementById("tech_web_id").textContent = "";
		document.getElementById("tech_full_name").textContent = proposedfield;
		document.getElementById("tech_protected").textContent = derivedfield;
		document.getElementById("billing_role").textContent = "";
		document.getElementById("billing_protected").textContent = derivedfield;
		document.getElementById("name_servers_role").textContent = "";
		document.getElementById("name_servers_ip").textContent = "";
		document.getElementById("name_servers_dnssec").textContent = "";
	}
	else if (inputlanguage == 1)	{
		var proposedfield = 'VOORGESTELD - ';
		var derivedfield = 'AFGELEID - Niet-openbare gegevens';
		document.getElementById("title").textContent = "Model voor domeingegevens";
		document.getElementById("field").textContent = "Omschrijving";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Toelichting";
		document.getElementById("view_role").textContent = "Query's gaan werken met centrale RDAP-servers. Dit kan werken voor Web ID-indexering.";
		document.getElementById("view_type").textContent = proposedfield + "all, isp (internet service provider), br (business register), public, se (zoekmachine)";
		document.getElementById("zone_role").textContent = "Een domein zone is (door de ICANN) toegewezen aan een domain registry om domeinen te beheren.";
		document.getElementById("zone_menu").textContent = proposedfield + "Een vervolgkeuzemenu voor uitleg en details per zone via een subdomein van de registry.";
		document.getElementById("zone_support").textContent = proposedfield + "Hulp vanuit de registry is mogelijk per e-mail.";
		document.getElementById("zone_registry_web_id").textContent = proposedfield;
		document.getElementById("zone_registry_full_name").textContent = proposedfield;
		document.getElementById("zone_restrictions").textContent = "Het bekijken van domeingegevens is aan beperkingen onderhevig.";
		document.getElementById("domain_role").textContent = "Een webdomein onder een topleveldomein is wereldwijd uniek en onder bepaalde regels vrij te kiezen.";
		document.getElementById("domain_name_unicode").textContent = "Namen met speciale tekens worden opgeslagen als ASCII-tekenreeksen met behulp van Punycode-transcriptie.";
		document.getElementById("domain_renewed").textContent = proposedfield + "Zoekmachines kunnen filteren op 'actief' en een transactie die niet ouder is dan een jaar.";
		document.getElementById("domain_refreshed").textContent = "RDAP-serverupdate in Zulu-tijd (gecoördineerde universele tijd - UTC).";
		document.getElementById("registrar_role").textContent = "Een domain registrar verzorgt de reservering van domeinen en IP-adresroutering.";
		document.getElementById("registrar_web_id").textContent = "";
		document.getElementById("registrar_iana_id").textContent = "De IANA-registratie ontbreekt in de RDAP-gegevens.";
		document.getElementById("registrar_protected").textContent = derivedfield;
		document.getElementById("registrar_abuse_role").textContent = "Door misbruikinformatie kan een derde contact opnemen met de registrar van een domein.";
		document.getElementById("reseller_role").textContent = "Een domain reseller heeft verantwoordelijkheid, afhankelijk van voorschriften en afspraken.";
		document.getElementById("reseller_web_id").textContent = "";
		document.getElementById("reseller_protected").textContent = derivedfield;
		document.getElementById("registrant_role").textContent = "Een domeinhouder heeft tenminste de rechten van een abonnement op zijn domein.";
		document.getElementById("registrant_web_id").textContent = 'Voor de Handelsregisters wordt gewerkt aan een WebID-identificatienummer.';
		document.getElementById("registrant_full_name").textContent = "Domeininformatie werkt bij een bestaande, beoogde en zichtbare handelsnaam.";
		document.getElementById("registrant_name").textContent = "Het is mogelijk om af te wijken van de bescherming van de privacy van de persoonsnaam van de houder.";
		document.getElementById("registrant_protected").textContent = derivedfield;
		document.getElementById("admin_role").textContent = "Het administratief aanspreekpunt beantwoordt een verzoek en stuurt zo nodig door.";
		document.getElementById("admin_web_id").textContent = "";
		document.getElementById("admin_full_name").textContent = proposedfield + "De handelsnaam van de administratieve contactpersoon ontbreekt in de RDAP-gegevens.";
		document.getElementById("admin_protected").textContent = derivedfield;
		document.getElementById("tech_role").textContent = "Een technisch contact reageert om een gemelde storing op te lossen.";
		document.getElementById("tech_web_id").textContent = "";
		document.getElementById("tech_full_name").textContent = proposedfield + "De handelsnaam van de technische contactpersoon ontbreekt in de RDAP-gegevens.";
		document.getElementById("tech_protected").textContent = derivedfield;
		document.getElementById("billing_role").textContent = "Sommige domain registries houden gegevens bij om hun facturering uit te voeren.";
		document.getElementById("billing_protected").textContent = derivedfield;
		document.getElementById("name_servers_role").textContent = "Naam servers leiden naar IP-adressen van webservers van een URL.";
		document.getElementById("name_servers_ip").textContent = "Een lijmrecord is vereist als de naamservers van de registrar niet worden gebruikt.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is een web-route-beveeiligingsvoorziening op het DNS (Domain Name System).";
		
	}
	else if (inputlanguage == 2)	{
		var proposedfield = 'PROPOSED - ';
		var derivedfield = 'DERIVED - Non-public data';
		document.getElementById("title").textContent = "Domain data model";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Explanation";		
		document.getElementById("view_role").textContent = "Queries will work with central RDAP servers. This can work for Web ID indexing.";	
		document.getElementById("view_type").textContent = proposedfield + "all, isp (nternet service provider), br (business register), public, se (search engine)";
		document.getElementById("zone_role").textContent = "A domain zone is assigned (by ICANN) to a domain registry to manage domains.";	
		document.getElementById("zone_menu").textContent = proposedfield + "A drop-down menu for explanations and details per zone via a subdomain of the registry.";
		document.getElementById("zone_support").textContent = proposedfield + "Help from the registry is possible by e-mail.";
		document.getElementById("zone_registry_web_id").textContent = proposedfield;
		document.getElementById("zone_registry_full_name").textContent = proposedfield;
		document.getElementById("zone_restrictions").textContent = "Viewing domain data is subject to restrictions.";
		document.getElementById("domain_role").textContent = "A web domain under a top-level domain is unique worldwide and can be freely chosen under certain rules.";
		document.getElementById("domain_name_unicode").textContent = "Names with special characters are stored as ASCII strings using Punycode transcription.";
		document.getElementById("domain_renewed").textContent = proposedfield + "Search engines can filter by 'active' and a transaction that is not older than one year.";
		document.getElementById("domain_refreshed").textContent = "RDAP server update in Zulu Time (coordinated universal time - UTC).";
		document.getElementById("registrar_role").textContent = "A domain registrar takes care of domain reservations and IP address routing.";
		document.getElementById("registrar_web_id").textContent = "";
		document.getElementById("registrar_iana_id").textContent = "The IANA registration is missing from the RDAP data.";
		document.getElementById("registrar_protected").textContent = derivedfield;
		document.getElementById("registrar_abuse_role").textContent = "Abuse information allows a third party to contact the registrar of a domain.";
		document.getElementById("reseller_role").textContent = "A domain reseller has responsibility, depending on regulations and agreements.";
		document.getElementById("reseller_web_id").textContent = "";
		document.getElementById("reseller_protected").textContent = derivedfield;
		document.getElementById("registrant_role").textContent = "A domain holder has at least the rights of a subscription to his domain.";
		document.getElementById("registrant_web_id").textContent = 'A WebID identification number is being developed for the Business Registers.';
		document.getElementById("registrant_full_name").textContent = "Domain information works with an existing, intended and visible trade name.";	
		document.getElementById("registrant_name").textContent = "It is possible to deviate from the privacy protection of the holder's personal name.";
		document.getElementById("registrant_protected").textContent = derivedfield;
		document.getElementById("admin_role").textContent = "The administratively responsible desk answers a request, and forwards on if necessary.";
		document.getElementById("admin_web_id").textContent = "";
		document.getElementById("admin_full_name").textContent = proposedfield + "The trade name of the administrative contact is missing from the RDAP data.";
		document.getElementById("admin_protected").textContent = derivedfield;
		document.getElementById("tech_role").textContent = "A technical contact responds to resolve a reported malfunction.";
		document.getElementById("tech_web_id").textContent = "";
		document.getElementById("tech_full_name").textContent = proposedfield + "The trade name of the technical contact is missing from the RDAP data.";
		document.getElementById("tech_protected").textContent = derivedfield;
		document.getElementById("billing_role").textContent = "Some domain registries maintain records to perform their billing.";
		document.getElementById("billing_protected").textContent = derivedfield;
		document.getElementById("name_servers_role").textContent = "Name servers lead to IP addresses of web servers from a URL.";
		document.getElementById("name_servers_ip").textContent = "A glue record is required if the registrar's name servers are not used.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is a web route security feature on the DNS (Domain Name System).";

	}
	else if (inputlanguage == 3)	{
		var proposedfield = 'VORGESCHLAGEN - ';
		var derivedfield = 'ABGELEITET - Nicht öffentliche Daten';
		document.getElementById("title").textContent = "Domänendatenmodell";
		document.getElementById("field").textContent = "Beschreibung";
		document.getElementById("value").textContent = "Detail";
		document.getElementById("explanation").textContent = "Erläuterung";		
		document.getElementById("view_role").textContent = "Abfragen funktionieren mit zentralen RDAP-Servern. Dies kann für die Web-ID-Indizierung funktionieren.";
		document.getElementById("view_type").textContent = proposedfield + "all, isp (Internetdienstanbieter), br (Unternehmensregister), public, se (Suchmaschine)";
		document.getElementById("zone_role").textContent = "Eine Domänenzone wird (von ICANN) einer Domänenregistrierungsstelle zugewiesen, um Domänen zu verwalten.";		
		document.getElementById("zone_menu").textContent = proposedfield + "Ein Dropdown-Menü für Erläuterungen und Details pro Zone über eine Subdomain der Registry.";
		document.getElementById("zone_support").textContent = proposedfield + "Hilfe aus der Registry ist per E-Mail möglich.";
		document.getElementById("zone_registry_web_id").textContent = proposedfield;
		document.getElementById("zone_registry_full_name").textContent = proposedfield;	
		document.getElementById("zone_restrictions").textContent = "Das Anzeigen von Domänendaten unterliegt Einschränkungen.";
		document.getElementById("domain_role").textContent = "Eine Webdomain unter einer Top-Level-Domain ist weltweit einzigartig und unter bestimmten Regeln frei wählbar.";
		document.getElementById("domain_name_unicode").textContent = "Namen mit Sonderzeichen werden mittels Punycode-Transkription als ASCII-Strings gespeichert.";
		document.getElementById("domain_renewed").textContent = proposedfield + "Suchmaschinen können nach „aktiv“ und einer Transaktion filtern, die nicht älter als ein Jahr ist.";
		document.getElementById("domain_refreshed").textContent = "RDAP-Server-Update in Zulu-Zeit (koordinierte Weltzeit – UTC).";
		document.getElementById("registrar_role").textContent = "Ein Domain-Registrar kümmert sich um Domain-Reservierungen und IP-Adress-Routing.";
		document.getElementById("registrar_web_id").textContent = "";
		document.getElementById("registrar_iana_id").textContent = "Die IANA-Registrierung fehlt in den RDAP-Daten.";
		document.getElementById("registrar_protected").textContent = derivedfield;
		document.getElementById("registrar_abuse_role").textContent = "Missbrauchsinformationen ermöglichen es einem Dritten, den Registrar einer Domain zu kontaktieren.";
		document.getElementById("reseller_role").textContent = "Ein Domain-Reseller trägt die Verantwortung, je nach Vorschriften und Vereinbarungen.";
		document.getElementById("reseller_web_id").textContent = "";
		document.getElementById("reseller_protected").textContent = derivedfield;
		document.getElementById("registrant_role").textContent = "Ein Domaininhaber hat zumindest die Rechte eines Abonnements seiner Domain.";
		document.getElementById("registrant_web_id").textContent = 'Für die Handelsregister wird eine WebID-Identifikationsnummer entwickelt.';
		document.getElementById("registrant_full_name").textContent = "Domain-Informationen funktionieren mit einem bestehenden, beabsichtigten und sichtbaren Handelsnamen.";
		document.getElementById("registrant_name").textContent = "Es ist möglich, vom Datenschutz des Personennamens des Inhabers abzuweichen.";
		document.getElementById("registrant_protected").textContent = derivedfield;
		document.getElementById("admin_role").textContent = "Die administrativ zuständige Stelle beantwortet eine Anfrage und leitet sie gegebenenfalls weiter.";
		document.getElementById("admin_web_id").textContent = "";
		document.getElementById("admin_full_name").textContent = proposedfield + "Der Handelsname des Verwaltungskontakts fehlt in den RDAP-Daten.";
		document.getElementById("admin_protected").textContent = derivedfield;
		document.getElementById("tech_role").textContent = "Ein technischer Kontakt reagiert, um eine gemeldete Störung zu beheben.";
		document.getElementById("tech_web_id").textContent = "";
		document.getElementById("tech_full_name").textContent = proposedfield + "Der Handelsname des technischen Ansprechpartners fehlt in den RDAP-Daten.";
		document.getElementById("tech_protected").textContent = derivedfield;
		document.getElementById("billing_role").textContent = "Einige Domänenregistrierungen führen Aufzeichnungen, um ihre Abrechnung durchzuführen.";
		document.getElementById("billing_protected").textContent = derivedfield;
		document.getElementById("name_servers_role").textContent = "Nameserver führen von einer URL zu IP-Adressen von Webservern.";
		document.getElementById("name_servers_ip").textContent = "Ein Glue-Record ist erforderlich, wenn die Nameserver des Registrars nicht verwendet werden.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC ist eine Sicherheitsfunktion für Webrouten im DNS (Domain Name System).";
	}
	else if (inputlanguage == 4)	{
		var proposedfield = 'PROPOSÉ - ';
		var derivedfield = 'DÉRIVÉ - Données non publiques';
		document.getElementById("title").textContent = "Modèle de données de domaine";
		document.getElementById("field").textContent = "Description";
		document.getElementById("value").textContent = "Détail";
		document.getElementById("explanation").textContent = "Explication";		
		document.getElementById("view_role").textContent = "Les requêtes fonctionneront avec les serveurs RDAP centraux. Cela peut fonctionner pour l’indexation des Web ID.";
		document.getElementById("view_type").textContent = proposedfield + "all, isp (fournisseur d'accès Internet), br (registre du commerce), public, se (moteur de recherche)";
		document.getElementById("zone_role").textContent = "Une zone de domaine est attribuée (par l'ICANN) à un registre de domaine pour gérer les domaines.";
		document.getElementById("zone_menu").textContent = proposedfield + "Un menu déroulant pour des explications et des détails par zone via un sous-domaine du registre.";
		document.getElementById("zone_support").textContent = proposedfield + "L'aide du registre est possible par e-mail.";
		document.getElementById("zone_registry_web_id").textContent = proposedfield;
		document.getElementById("zone_registry_full_name").textContent = proposedfield;
		document.getElementById("zone_restrictions").textContent = "L'affichage des données de domaine est soumis à des restrictions.";
		document.getElementById("domain_role").textContent = "Un domaine Web sous un domaine de premier niveau est unique au monde et peut être choisi librement selon certaines règles.";
		document.getElementById("domain_name_unicode").textContent = "Les noms avec des caractères spéciaux sont stockés sous forme de chaînes ASCII à l'aide de la transcription Punycode.";
		document.getElementById("domain_renewed").textContent = proposedfield + "Les moteurs de recherche peuvent filtrer par 'actif' et une transaction datant de moins d'un an.";
		document.getElementById("domain_refreshed").textContent = "Mise à jour du serveur RDAP en heure zoulou (temps universel coordonné - UTC).";
		document.getElementById("registrar_role").textContent = "Un registraire de domaine s'occupe des réservations de domaine et du routage des adresses IP.";
		document.getElementById("registrar_web_id").textContent = "";
		document.getElementById("registrar_iana_id").textContent = "L'enregistrement IANA est absent des données RDAP.";
		document.getElementById("registrar_protected").textContent = derivedfield;
		document.getElementById("registrar_abuse_role").textContent = "Les informations sur les abus permettent à un tiers de contacter le registraire d'un domaine.";
		document.getElementById("reseller_role").textContent = "Un revendeur de domaine a la responsabilité, en fonction des réglementations et des accords.";
		document.getElementById("reseller_web_id").textContent = "";
		document.getElementById("reseller_protected").textContent = derivedfield;
		document.getElementById("registrant_role").textContent = "Un titulaire de domaine a au moins les droits d'un abonnement à son domaine.";
		document.getElementById("registrant_web_id").textContent = "Un numéro d'identification WebID est en cours d'élaboration pour les Registres de Commerce.";
		document.getElementById("registrant_full_name").textContent = "Les informations de domaine fonctionnent avec un nom commercial existant, prévu et visible.";
		document.getElementById("registrant_name").textContent = "Il est possible de déroger à la protection de la vie privée du nom personnel du titulaire.";
		document.getElementById("registrant_protected").textContent = derivedfield;
		document.getElementById("admin_role").textContent = "Le bureau administrativement responsable répond à une demande, et la transmet si nécessaire.";
		document.getElementById("admin_web_id").textContent = "";
		document.getElementById("admin_full_name").textContent = proposedfield + "Le nom commercial du contact administratif est absent des données RDAP.";
		document.getElementById("admin_protected").textContent = derivedfield;
		document.getElementById("tech_role").textContent = "Un contact technique répond pour résoudre un dysfonctionnement signalé.";
		document.getElementById("tech_web_id").textContent = "";
		document.getElementById("tech_full_name").textContent = proposedfield + "Le nom commercial du contact technique est absent des données RDAP.";
		document.getElementById("tech_protected").textContent = derivedfield;
		document.getElementById("billing_role").textContent = "Certains registres de domaine conservent des enregistrements pour effectuer leur facturation.";
		document.getElementById("billing_protected").textContent = derivedfield;
		document.getElementById("name_servers_role").textContent = "Les serveurs de noms mènent aux adresses IP des serveurs Web à partir d'une URL.";
		document.getElementById("name_servers_ip").textContent = "Un enregistrement Glue est requis si les serveurs de noms du registraire ne sont pas utilisés.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC est une fonctionnalité de sécurité de route Web sur le DNS (Domain Name System).";
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
if (empty($_POST['inputdomain']))	{
	$viewdomain = 'webhostingtech.nl';
	//$viewdomain = 'cyberfusion.nl';
}
else	{
	$viewdomain = $_POST['inputdomain'];
}	
$rdap_url = 'https://rdap.hostingtool.nl/compose_data/index.php?domain='.$viewdomain;
if (@get_headers($rdap_url))	{ // the application to compose for zone data
	$xml1 = simplexml_load_file($rdap_url, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load rdap_url from non-public folder.");
}
$html_text = '<body onload=SwitchTranslation('.$inputlanguage.')><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem">
<tr><th style="width:325px"></th><th style="width:300px"></th><th style="width:750px"></th></tr>';
$html_text .= '<tr><td id="title" style="font-size: 1.4rem;color:blue;font-weight:bold"></b></td>
<td><form action='.htmlentities($_SERVER['PHP_SELF']).' method="post">    
	<label style="font-size: 1rem" for="inputdomain">.nl</label>
	<input type="text" style="width:75%" id="inputdomain" name="inputdomain" value='.$viewdomain.'>
	<input type="submit" value="OK" name="IsSubmit" /></form></td><td>
	<button style="cursor:pointer" onclick="SwitchTranslation(0)">none</button> - 
	<button style="cursor:pointer" onclick="SwitchTranslation(1)">Nederlands</button> - 
	<button style="cursor:pointer" onclick="SwitchTranslation(2)">English</button> - 
	<button style="cursor:pointer" onclick="SwitchTranslation(3)">Deutsch</button> - 
	<button style="cursor:pointer" onclick="SwitchTranslation(4)">Français</button> -
	<a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap_view_model" target="_blank">github.com/janwillemstegink/rdap_view_model</a></td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	$html_text .= '<tr style="font-size:1.05rem;font-weight:bold"><td id="field"</td><td id="value"><td id="explanation"></td></tr>';
	$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(10)">zone +/-</button></b></td><td></b></td><td id="zone_role"></td></tr>';
	$html_text .= '<tr id="101" style="display:none"><td>zone_menu</td><td>'.$item->zone->zone_menu.'</td><td id="zone_menu"></td></tr>';
	$html_text .= '<tr id="102" style="display:none"><td>zone_support</td><td>'.$item->zone->zone_support.'</td><td id="zone_support"></td></tr>';
	$html_text .= '<tr id="103" style="display:none"><td>zone_registry_web_id</td><td>'.$item->zone->zone_registry_web_id.'</td><td id="zone_registry_web_id"></td></tr>';
	$html_text .= '<tr id="104" style="display:none"><td>zone_registry_full_name</td><td>'.$item->zone->zone_registry_full_name.'</td><td id="zone_registry_full_name"></td></tr>';
	$html_text .= '<tr id="105" style="display:none"><td>zone_registry_language</td><td>'.$item->zone->zone_registry_language.'</td><td></td></tr>';
	$html_text .= '<tr id="106" style="display:none;vertical-align:top"><td>zone_description_legal</td><td>'.$item->zone->zone_description_legal.'</td><td></td></tr>';
	$html_text .= '<tr id="107" style="display:none;vertical-align:top"><td>zone_description_translated</td><td>'.$item->zone->zone_description_translated.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';	
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(11)">restrictions legal +/-</button></b></td><td></b></td><td id="zone_restrictions"></td></tr>';
	$html_text .= '<tr id="111" style="display:none;vertical-align:top"><td>zone_privacy_title</td><td>'.$item->zone->zone_privacy_title.'</td><td></td></tr>';
	$html_text .= '<tr id="112" style="display:none;vertical-align:top"><td>zone_privacy_legal</td><td>'.$item->zone->zone_privacy_legal.'</td><td></td></tr>';
	$html_text .= '<tr id="113" style="display:none"><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	$html_text .= '<tr id="114" style="display:none;vertical-align:top"><td>zone_copyright_title</td><td>'.$item->zone->zone_copyright_title.'</td><td></td></tr>';
	$html_text .= '<tr id="115" style="display:none;vertical-align:top"><td>zone_copyright_legal</td><td>'.$item->zone->zone_copyright_legal.'</td><td></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(12)">restrictions translated +/-</button></b></td><td></b></td><td></td></tr>';
	$html_text .= '<tr id="121" style="display:none;vertical-align:top"><td>zone_privacy_title</td><td>'.$item->zone->zone_privacy_title.'</td><td></td></tr>';
	$html_text .= '<tr id="122" style="display:none;vertical-align:top"><td>zone_privacy_translated</td><td>'.$item->zone->zone_privacy_translated.'</td><td></td></tr>';
	$html_text .= '<tr id="123" style="display:none"><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	$html_text .= '<tr id="124" style="display:none;vertical-align:top"><td>zone_copyright_title</td><td>'.$item->zone->zone_copyright_title.'</td><td></td></tr>';
	$html_text .= '<tr id="125" style="display:none;vertical-align:top"><td>zone_copyright_translated</td><td>'.$item->zone->zone_copyright_translated.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';	
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(20)">view +/-</button></b></td><td></b></td><td id="view_role"></td></tr>';
	$html_text .= '<tr id="201" style="display:none"><td>view_type</td><td>'.$item->view->view_type.'</td><td id="view_type"></td></tr>';
	$html_text .= '<tr id="202" style="display:none"><td>view_links_value</td><td>'.$item->view->view_links_value.'</td><td></td></tr>';
	$html_text .= '<tr id="203" style="display:none"><td>view_links_related</td><td>'.$item->view->view_links_related.'</td><td></td></tr>';
	$html_text .= '<tr id="204" style="display:none"><td>view_links_href</td><td>'.$item->view->view_links_href.'</td><td></td></tr>';
	$html_text .= '<tr id="205" style="display:none"><td>view_links_href_lang</td><td>'.$item->view->view_links_href_lang.'</td><td></td></tr>';
	$html_text .= '<tr id="206" style="display:none"><td>view_links_title</td><td>'.$item->view->view_links_title.'</td><td></td></tr>';
	$html_text .= '<tr id="207" style="display:none"><td>view_links_media</td><td>'.$item->view->view_links_media.'</td><td></td></tr>';
	$html_text .= '<tr id="208" style="display:none"><td>view_links_type</td><td>'.$item->view->view_links_type.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(30)">domain +/-</button></b></td><td></b></td><td id="domain_role"></td></tr>';
	$html_text .= '<tr id="301" style="display:none"><td>domain_id</td><td>'.$item->domain_id.'</td><td></td></tr>';
	$html_text .= '<tr><td>domain_name</td><td><b>'.$item->domain_name.'</b></td><td></td></tr>';
	$html_text .= '<tr id="302" style="display:none"><td>domain_name_unicode</td><td>'.$item->domain_name_unicode.'</td><td id="domain_name_unicode"></td></tr>';
	$html_text .= '<tr><td>domain_status</td><td>'.$item->domain_status.'</td><td></td></tr>';
	$html_text .= '<tr><td>domain_created</td><td>'.$item->domain_created.'</td><td></td></tr>';
	$html_text .= '<tr><td>domain_renewed</td><td>'.$item->domain_renewed.'</td><td id="domain_renewed"></td></tr>';
	$html_text .= '<tr id="303" style="display:none"><td>domain_updated</td><td>'.$item->domain_updated.'</td><td></td></tr>';
	$html_text .= '<tr id="304" style="display:none"><td>domain_refreshed</td><td>'.$item->domain_refreshed.'</td><td id="domain_refreshed"></td></tr>';
	$html_text .= '<tr id="305" style="display:none"><td>domain_expiration</td><td>'.$item->domain_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="306" style="display:none"><td>domain_out_of_quarantine</td><td>'.$item->domain_out_of_quarantine.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(40)">registrar +/-</button></b></td><td></b></td><td id="registrar_role"></td></tr>';
	$html_text .= '<tr id="401" style="display:none"><td>registrar_contact_id</td><td>'.$item->registrar->registrar_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr><td>registrar_web_id</td><td>'.$item->registrar->registrar_web_id.'</td><td id="registrar_web_id"></td></tr>';		
	$html_text .= '<tr><td>registrar_full_name</td><td>'.$item->registrar->registrar_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="402" style="display:none"><td>registrar_kind</td><td>'.$item->registrar->registrar_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="403" style="display:none"><td>registrar_url</td><td>'.$item->registrar->registrar_url.'</td><td></td></tr>';
	$html_text .= '<tr id="404" style="display:none"><td>registrar_iana_id</td><td>'.$item->registrar->registrar_iana_id.'</td><td id="registrar_iana_id"></td></tr>';
	$html_text .= '<tr id="405" style="display:none"><td>registrar_name</td><td>'.$item->registrar->registrar_name.'</td><td></td></tr>';
	$html_text .= '<tr id="406" style="display:none"><td>registrar_phone</td><td>'.$item->registrar->registrar_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="407" style="display:none"><td>registrar_fax</td><td>'.$item->registrar->registrar_fax.'</td><td></td></tr>';
	$html_text .= '<tr id="408" style="display:none"><td>registrar_email</td><td>'.$item->registrar->registrar_email.'</td><td></td></tr>';
	$html_text .= '<tr id="409" style="display:none"><td>registrar_street</td><td>'.$item->registrar->registrar_street.'</td><td></td></tr>';
	$html_text .= '<tr id="4010" style="display:none"><td>registrar_postal_code</td><td>'.$item->registrar->registrar_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4011" style="display:none"><td>registrar_city</td><td>'.$item->registrar->registrar_city.'</td><td></td></tr>';
	$html_text .= '<tr id="4012" style="display:none"><td>registrar_state_province</td><td>'.$item->registrar->registrar_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="4013" style="display:none"><td>registrar_country_code</td><td>'.$item->registrar->registrar_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="4014" style="display:none"><td>registrar_language_pref_1</td><td>'.$item->registrar->registrar_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="4015" style="display:none"><td>registrar_language_pref_2</td><td>'.$item->registrar->registrar_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="4016" style="display:none"><td>registrar_protected</td><td>'.$item->registrar->registrar_protected.'</td><td id="registrar_protected"></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(45)">registrar abuse +/-</button></b></td><td></b></td><td id="registrar_abuse_role"></td></tr>';
	$html_text .= '<tr id="451" style="display:none"><td>registrar_abuse_phone</td><td>'.$item->registrar->registrar_abuse_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="452" style="display:none"><td>registrar_abuse_email</td><td>'.$item->registrar->registrar_abuse_email.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	//if (!empty($item->reseller->reseller_full_name))	{
	//	if (strlen(trim($item->reseller->reseller_full_name)))	{
			$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(50)">reseller +/-</button></b></td><td></b></td><td id="reseller_role"></td></tr>';		
			$html_text .= '<tr id="501" style="display:none"><td>reseller_contact_id</td><td>'.$item->reseller->reseller_contact_id.'</td><td></td></tr>';
			$html_text .= '<tr><td>reseller_web_id</td><td>'.$item->reseller->reseller_web_id.'</td><td id="reseller_web_id"></td></tr>';
			$html_text .= '<tr><td>reseller_full_name</td><td>'.$item->reseller->reseller_full_name.'</td><td></td></tr>';
			$html_text .= '<tr id="502" style="display:none"><td>reseller_kind</td><td>'.$item->reseller->reseller_kind.'</td><td></td></tr>';
			$html_text .= '<tr id="503" style="display:none"><td>reseller_name</td><td>'.$item->reseller->reseller_name.'</td><td></td></tr>';
			$html_text .= '<tr id="504" style="display:none"><td>reseller_phone</td><td>'.$item->reseller->reseller_phone.'</td><td></td></tr>';
			$html_text .= '<tr id="505" style="display:none"><td>reseller_fax</td><td>'.$item->reseller->reseller_fax.'</td><td></td></tr>';
			$html_text .= '<tr id="506" style="display:none"><td>reseller_email</td><td>'.$item->reseller->reseller_email.'</td><td></td></tr>';			
			$html_text .= '<tr id="507" style="display:none"><td>reseller_street</td><td>'.$item->reseller->reseller_street.'</td><td></td></tr>';
			$html_text .= '<tr id="508" style="display:none"><td>reseller_postal_code</td><td>'.$item->reseller->reseller_postal_code.'</td><td></td></tr>';
			$html_text .= '<tr id="509" style="display:none"><td>reseller_city</td><td>'.$item->reseller->reseller_city.'</td><td></td></tr>';
			$html_text .= '<tr id="5010" style="display:none"><td>reseller_state_province</td><td>'.$item->reseller->reseller_state_province.'</td><td></td></tr>';			
			$html_text .= '<tr id="5011" style="display:none"><td>reseller_country_code</td><td>'.$item->reseller->reseller_country_code.'</td><td></td></tr>';
			$html_text .= '<tr id="5012" style="display:none"><td>reseller_language_pref_1</td><td>'.$item->reseller->reseller_language_pref_1.'</td><td></td></tr>';
			$html_text .= '<tr id="5013" style="display:none"><td>reseller_language_pref_2</td><td>'.$item->reseller->reseller_language_pref_2.'</td><td></td></tr>';
			$html_text .= '<tr id="5014" style="display:none"><td>reseller_protected</td><td>'.$item->reseller->reseller_protected.'</td><td id="reseller_protected"></td></tr>';		
			$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	//	}	
	//}
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(60)">registrant +/-</button></b></td><td></b></td><td id="registrant_role"></td></tr>';
	$html_text .= '<tr id="601" style="display:none"><td>registrant_contact_id</td><td>'.$item->registrant->registrant_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr><td>registrant_web_id</td><td>'.$item->registrant->registrant_web_id.'</td><td id="registrant_web_id"></td></tr>';
	$html_text .= '<tr><td>registrant_full_name</td><td><b>'.$item->registrant->registrant_full_name.'</b></td><td id="registrant_full_name"></td></tr>';
	$html_text .= '<tr id="602" style="display:none"><td>registrant_kind</td><td><b>'.$item->registrant->registrant_kind.'</b></td><td id="registrant_kind"></td></tr>';
	$html_text .= '<tr id="603" style="display:none"><td>registrant_name</td><td><b>'.$item->registrant->registrant_name.'</b></td><td id="registrant_name"></td></tr>';
	$html_text .= '<tr id="604" style="display:none"><td>registrant_phone</td><td>'.$item->registrant->registrant_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="605" style="display:none"><td>registrant_fax</td><td>'.$item->registrant->registrant_fax.'</td><td></td></tr>';
	$html_text .= '<tr id="606" style="display:none"><td>registrant_email</td><td>'.$item->registrant->registrant_email.'</td><td></td></tr>';
	$html_text .= '<tr id="607" style="display:none"><td>registrant_street</td><td>'.$item->registrant->registrant_street.'</td><td></td></tr>';
	$html_text .= '<tr id="608" style="display:none"><td>registrant_postal_code</td><td>'.$item->registrant->registrant_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="609" style="display:none"><td>registrant_city</td><td>'.$item->registrant->registrant_city.'</td><td></td></tr>';
	$html_text .= '<tr id="6010" style="display:none"><td>registrant_state_province</td><td>'.$item->registrant->registrant_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="6011" style="display:none"><td>registrant_country_code</td><td>'.$item->registrant->registrant_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6012" style="display:none"><td>registrant_language_pref_1</td><td>'.$item->registrant->registrant_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="6013" style="display:none"><td>registrant_language_pref_2</td><td>'.$item->registrant->registrant_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="6014" style="display:none"><td>registrant_protected</td><td>'.$item->registrant->registrant_protected.'</td><td id="registrant_protected"></td></tr>';
	$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(70)">administrative +/-</button></b></td><td></b></td><td id="admin_role"></td></tr>';
	$html_text .= '<tr id="701" style="display:none"><td>admin_contact_id</td><td>'.$item->admin->admin_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr id="702" style="display:none"><td>admin_web_id</td><td>'.$item->admin->admin_web_id.'</td><td id="admin_web_id"></td></tr>';
	$html_text .= '<tr id="703" style="display:none"><td>admin_full_name</td><td>'.$item->admin->admin_full_name.'</td><td id="admin_full_name"></td></tr>';
	$html_text .= '<tr id="704" style="display:none"><td>admin_kind</td><td>'.$item->admin->admin_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="705" style="display:none"><td>admin_name</td><td>'.$item->admin->admin_name.'</td><td></td></tr>';
	$html_text .= '<tr id="706" style="display:none"><td>admin_phone</td><td>'.$item->admin->admin_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="707" style="display:none"><td>admin_fax</td><td>'.$item->admin->admin_fax.'</td><td></td></tr>';
	$html_text .= '<tr><td>admin_email</td><td>'.$item->admin->admin_email.'</td><td></td></tr>';
	$html_text .= '<tr id="708" style="display:none"><td>admin_street</td><td>'.$item->admin->admin_street.'</td><td></td></tr>';
	$html_text .= '<tr id="709" style="display:none"><td>admin_postal_code</td><td>'.$item->admin->admin_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="7010" style="display:none"><td>admin_city</td><td>'.$item->admin->admin_city.'</td><td></td></tr>';
	$html_text .= '<tr id="7011" style="display:none"><td>admin_state_province</td><td>'.$item->admin->admin_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="7012" style="display:none"><td>admin_country_code</td><td>'.$item->admin->admin_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="7013" style="display:none"><td>admin_language_pref_1</td><td>'.$item->admin->admin_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="7014" style="display:none"><td>admin_language_pref_2</td><td>'.$item->admin->admin_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="7015" style="display:none"><td>admin_protected</td><td>'.$item->admin->admin_protected.'</td><td id="admin_protected"></td></tr>';
	$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(80)">technical +/-</button></b></td><td></b></td><td id="tech_role"></td></tr>';
	$html_text .= '<tr id="801" style="display:none"><td>tech_contact_id</td><td>'.$item->tech->tech_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr id="802" style="display:none"><td>tech_web_id</td><td>'.$item->tech->tech_web_id.'</td><td id="tech_web_id"></td></tr>';
	$html_text .= '<tr id="803" style="display:none"><td>tech_full_name</td><td>'.$item->tech->tech_full_name.'</td><td id="tech_full_name"></td></tr>';
	$html_text .= '<tr id="804" style="display:none"><td>tech_kind</td><td>'.$item->tech->tech_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="805" style="display:none"><td>tech_name</td><td>'.$item->tech->tech_name.'</td><td></td></tr>';
	$html_text .= '<tr id="806" style="display:none"><td>tech_phone</td><td>'.$item->tech->tech_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="807" style="display:none"><td>tech_fax</td><td>'.$item->tech->tech_fax.'</td><td></td></tr>';
	$html_text .= '<tr><td>tech_email</td><td>'.$item->tech->tech_email.'</td><td></td></tr>';
	$html_text .= '<tr id="808" style="display:none"><td>tech_street</td><td>'.$item->tech->tech_street.'</td><td></td></tr>';
	$html_text .= '<tr id="809" style="display:none"><td>tech_postal_code</td><td>'.$item->tech->tech_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="8010" style="display:none"><td>tech_city</td><td>'.$item->tech->tech_city.'</td><td></td></tr>';
	$html_text .= '<tr id="8011" style="display:none"><td>tech_state_province</td><td>'.$item->tech->tech_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="8012" style="display:none"><td>tech_country_code</td><td>'.$item->tech->tech_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="8013" style="display:none"><td>tech_language_pref_1</td><td>'.$item->tech->tech_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="8014" style="display:none"><td>tech_language_pref_2</td><td>'.$item->tech->tech_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="8015" style="display:none"><td>tech_protected</td><td>'.$item->tech->tech_protected.'</td><td id="tech_protected"></td></tr>';
	$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(90)">billing +/-</button></b></td><td></b></td><td id="billing_role"></td></tr>';
	$html_text .= '<tr id="901" style="display:none"><td>billing_contact_id</td><td>'.$item->billing->billing_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr id="902" style="display:none"><td>billing_web_id</td><td>'.$item->billing->billing_web_id.'</td><td></td></tr>';
	$html_text .= '<tr id="903" style="display:none"><td>billing_full_name</td><td>'.$item->billing->billing_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="904" style="display:none"><td>billing_kind</td><td>'.$item->billing->billing_kind.'</td><td></td></tr>';
	$html_text .= '<tr id="905" style="display:none"><td>billing_name</td><td>'.$item->billing->billing_name.'</td><td></td></tr>';
	$html_text .= '<tr id="906" style="display:none"><td>billing_phone</td><td>'.$item->billing->billing_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="907" style="display:none"><td>billing_fax</td><td>'.$item->billing->billing_fax.'</td><td></td></tr>';
	$html_text .= '<tr id="908" style="display:none"><td>billing_email</td><td>'.$item->billing->billing_email.'</td><td></td></tr>';
	$html_text .= '<tr id="909" style="display:none"><td>billing_street</td><td>'.$item->billing->billing_street.'</td><td></td></tr>';
	$html_text .= '<tr id="9010" style="display:none"><td>billing_postal_code</td><td>'.$item->billing->billing_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="9011" style="display:none"><td>billing_city</td><td>'.$item->billing->billing_city.'</td><td></td></tr>';
	$html_text .= '<tr id="9012" style="display:none"><td>billing_state_province</td><td>'.$item->billing->billing_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="9013" style="display:none"><td>billing_country_code</td><td>'.$item->billing->billing_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="9014" style="display:none"><td>billing_language_pref_1</td><td>'.$item->billing->billing_language_pref_1.'</td><td></td></tr>';
	$html_text .= '<tr id="9015" style="display:none"><td>billing_language_pref_2</td><td>'.$item->billing->billing_language_pref_2.'</td><td></td></tr>';
	$html_text .= '<tr id="9016" style="display:none"><td>billing_protected</td><td>'.$item->billing->billing_protected.'</td><td id="billing_protected"></td></tr>';
	$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(95)">name servers +/-</button></b></td><td></b></td><td id="name_servers_role"></td></tr>';
	if (!empty($item->name_servers->server_1->server_name_1))	{
		if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
			$html_text .= '<tr id="951" style="display:none"><td>server_name_1</td><td>'.$item->name_servers->server_1->server_name_1.'</td><td></td></tr>';
			$html_text .= '<tr id="952" style="display:none"><td>server_name_unicode_1</td><td>'.$item->name_servers->server_1->server_name_unicode_1.'</td><td></td></tr>';
			$html_text .= '<tr id="953" style="display:none"><td>server_ipv4_1</td><td>'.$item->name_servers->server_1->server_ipv4_1.'</td><td id="name_servers_ip"></td></tr>';
			$html_text .= '<tr id="954" style="display:none"><td>server_ipv6_1</td><td>'.$item->name_servers->server_1->server_ipv6_1.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_1->server_name_1))	{		
		if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
			$html_text .= '<tr id="955" style="display:none"><td>server_name_2</td><td>'.$item->name_servers->server_2->server_name_2.'</td><td></td></tr>';
			$html_text .= '<tr id="956" style="display:none"><td>server_name_unicode_2</td><td>'.$item->name_servers->server_2->server_name_unicode_2.'</td><td></td></tr>';
			$html_text .= '<tr id="957" style="display:none"><td>server_ipv4_2</td><td>'.$item->name_servers->server_2->server_ipv4_2.'</td><td></td></tr>';
			$html_text .= '<tr id="958" style="display:none"><td>server_ipv6_2</td><td>'.$item->name_servers->server_2->server_ipv6_2.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_3->server_name_3))	{
		if (strlen(trim($item->name_servers->server_3->server_name_3)))	{
			$html_text .= '<tr id="959" style="display:none"><td>server_name_3</td><td>'.$item->name_servers->server_3->server_name_3.'</td><td></td></tr>';
			$html_text .= '<tr id="9510" style="display:none"><td>server_name_unicode_3</td><td>'.$item->name_servers->server_3->server_name_unicode_3.'</td><td></td></tr>';
			$html_text .= '<tr id="9511" style="display:none"><td>server_ipv4_3</td><td>'.$item->name_servers->server_3->server_ipv4_3.'</td><td></td></tr>';
			$html_text .= '<tr id="9512" style="display:none"><td>server_ipv6_3</td><td>'.$item->name_servers->server_3->server_ipv6_3.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_4->server_name_4))	{	
		if (strlen(trim($item->name_servers->server_4->server_name_4)))	{
			$html_text .= '<tr id="9513" style="display:none"><td>server_name_4</td><td>'.$item->name_servers->server_4->server_name_4.'</td><td></td></tr>';
			$html_text .= '<tr id="9514" style="display:none"><td>server_name_unicode_4</td><td>'.$item->name_servers->server_4->server_name_unicode_4.'</td><td></td></tr>';
			$html_text .= '<tr id="9515" style="display:none"><td>server_ipv4_4</td><td>'.$item->name_servers->server_4->server_ipv4_4.'</td><td></td></tr>';
			$html_text .= '<tr id="9516" style="display:none"><td>server_ipv6_4</td><td>'.$item->name_servers->server_4->server_ipv6_4.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_5->server_name_5))	{		
		if (strlen(trim($item->name_servers->server_5->server_name_5)))	{
			$html_text .= '<tr id="9517" style="display:none"><td>server_name_5</td><td>'.$item->name_servers->server_5->server_name_5.'</td><td></td></tr>';
			$html_text .= '<tr id="9518" style="display:none"><td>server_name_unicode_5</td><td>'.$item->name_servers->server_5->server_name_unicode_5.'</td><td></td></tr>';
			$html_text .= '<tr id="9519" style="display:none"><td>server_ipv4_5</td><td>'.$item->name_servers->server_5->server_ipv4_5.'</td><td></td></tr>';
			$html_text .= '<tr id="9520" style="display:none"><td>server_ipv6_5</td><td>'.$item->name_servers->server_5->server_ipv6_5.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_6->server_name_6))	{
		if (strlen(trim($item->name_servers->server_6->server_name_6)))	{
			$html_text .= '<tr id="9521" style="display:none"><td>server_name_6</td><td>'.$item->name_servers->server_6->server_name_6.'</td><td></td></tr>';
			$html_text .= '<tr id="9522" style="display:none"><td>server_name_unicode_6</td><td>'.$item->name_servers->server_6->server_name_unicode_6.'</td><td></td></tr>';
			$html_text .= '<tr id="9523" style="display:none"><td>server_ipv4_6</td><td>'.$item->name_servers->server_6->server_ipv4_6.'</td><td></td></tr>';
			$html_text .= '<tr id="9524" style="display:none"><td>server_ipv6_6</td><td>'.$item->name_servers->server_6->server_ipv6_6.'</td><td></td></tr>';
		}	
	}
	$html_text .= '<tr><td>name_servers_dnssec</td><td>'.$item->name_servers->name_servers_dnssec.'</td><td id="name_servers_dnssec"></td></tr>';
	$html_text .= '<tr><td><hr></b></td><td><hr></b></td><td><hr></td></tr>';
	//break;
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>