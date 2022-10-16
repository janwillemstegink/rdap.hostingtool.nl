<?php
session_start();  // is needed with no PHP Generator Scriptcase
$inputlanguage = 2;
echo '<!DOCTYPE html><html lang="en" style="font-size: 90%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>Whois modeling</title>';
?><script>
function SwitchDisplay(type) {
	if (type == 20)	{ // domain
		var pre = '20';
		var max = 6
	}
	else if (type == 30)	{ // registrar
		var pre = '30';
		var max = 19
	}
	else if (type == 40)	{ // reseller
		var pre = '40';
		var max = 15
	}
	else if (type == 50)	{ // registrant
		var pre = '50';
		var max = 14
	}
	else if (type == 60)	{ // admin
		var pre = '60';
		var max = 16
	}
	else if (type == 70)	{ // tech
		var pre = '70';
		var max = 16
	}
	else if (type == 80)	{ // billing
		var pre = '80';
		var max = 17
	}
	else if (type == 90)	{ // name servers
		var pre = '90';
		var max = 18
	}
	else if (type == 100)	{ // zone
		var pre = '100';
		var max = 8
	}
	else if (type == 110)	{ // restrictions
		var pre = '110';
		var max = 3
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
	var statuscodes = 'https://www.icann.org/resources/pages/epp-status-codes-2014-06-16-en';
	if (inputlanguage == 0)	{
		var newfield = '';
		var derivedfield = '';
		document.getElementById("title").textContent = "Whois";
		document.getElementById("data").textContent = "Details";
		document.getElementById("view_type").textContent = "";
		document.getElementById("domain_role").textContent = "";
		document.getElementById("domain_name_unicode").textContent = "";
		document.getElementById("domain_type").textContent = newfield;
		document.getElementById("domain_status").textContent = "";
		document.getElementById("domain_status_codes").textContent = "";
		document.getElementById("domain_renewed").textContent = newfield;
		document.getElementById("registrar_role").textContent = "";
		document.getElementById("registrar_web_id").textContent = "";
		document.getElementById("registrar_abuse_email").textContent = "";
		document.getElementById("registrar_protected").textContent = derivedfield;
		document.getElementById("reseller_role").textContent = "";
		document.getElementById("reseller_web_id").textContent = "";
		document.getElementById("reseller_protected").textContent = derivedfield;
		document.getElementById("registrant_role").textContent = "";
		document.getElementById("registrant_web_id").textContent = "";
		document.getElementById("registrant_trade_name").textContent = "";
		document.getElementById("registrant_personal_name").textContent = "";
		document.getElementById("registrant_protected").textContent = derivedfield;
		document.getElementById("admin_role").textContent = "";
		document.getElementById("admin_web_id").textContent = "";
		document.getElementById("admin_protected").textContent = derivedfield;
		document.getElementById("tech_role").textContent = "";
		document.getElementById("tech_web_id").textContent = "";
		document.getElementById("tech_protected").textContent = derivedfield;
		document.getElementById("billing_role").textContent = "";
		document.getElementById("billing_protected").textContent = derivedfield;
		document.getElementById("name_servers_role").textContent = "";
		document.getElementById("name_servers_dnssec").textContent = "";
		document.getElementById("zone_role").textContent = "";
	}
	else if (inputlanguage == 1)	{
		var newfield = 'NIEUW - ';
		var derivedfield = 'NIEUW - Niet-openbare gegevens';
		var url = '<a href="https://www.icann.org/en/system/files/files/epp-status-codes-30jun11-en.pdf" target="_blank">www.icann.org/en/system/files/files/epp-status-codes-30jun11-en.pdf</a>';
		document.getElementById("title").textContent = "Whois-modellering";
		document.getElementById("data").textContent = "Domeinnaamgegevens";
		document.getElementById("view_type").textContent = "Weergavetypen: alles, isp (Internet Service Provider), publiek, se (zoekmachine)";
		document.getElementById("domain_role").textContent = "Een webdomein onder een topleveldomein is wereldwijd uniek en onder bepaalde regels vrij te kiezen.";
		document.getElementById("domain_name_unicode").textContent = "Namen met speciale tekens worden opgeslagen als ASCII-tekenreeksen met behulp van Punycode-transcriptie.";
		document.getElementById("domain_type").textContent = newfield + "Domeintypen: persoonlijk privégebruik, persoonlijk openbaar gebruik, handelsnaam bestaat.";
		document.getElementById("domain_status").textContent = "Domeinstatussen: vrij, onttrokken, uitgesloten, in aanvraag, actief, inactief, in quarantaine.";
		document.getElementById("domain_status_codes").textContent = "Statuscodes: " + statuscodes;
		document.getElementById("domain_renewed").textContent = newfield + "Zoekmachines kunnen filteren op 'actief' en een transactie die niet ouder is dan een jaar.";
		document.getElementById("registrar_role").textContent = "Een domain registrar verzorgt de reservering van domeinen en IP-adresroutering.";
		document.getElementById("registrar_web_id").textContent = "";
		document.getElementById("registrar_abuse_email").textContent = "Contactgegevens om misbruik te melden kunnen verplicht worden voor een registrar.";
		document.getElementById("registrar_protected").textContent = derivedfield;
		document.getElementById("reseller_role").textContent = "Een domain reseller kan verantwoordelijk zijn voor de verwerking van de gegevens van de houder.";
		document.getElementById("reseller_web_id").textContent = "";
		document.getElementById("reseller_protected").textContent = derivedfield;
		document.getElementById("registrant_role").textContent = "Een domeinhouder heeft tenminste de rechten van een abonnement op zijn domein.";
		document.getElementById("registrant_web_id").textContent = 'Het web-ID identificatienummer is in voorbereiding voor de Handelsregisters.';
		document.getElementById("registrant_trade_name").textContent = "Whois is informatief bij een bestaande, beoogde en zichtbare handelsnaam.";
		document.getElementById("registrant_personal_name").textContent = "Het is mogelijk om af te wijken van de bescherming van de privacy van de persoonsnaam van de houder.";
		document.getElementById("registrant_protected").textContent = derivedfield;
		document.getElementById("admin_role").textContent = "Het administratief aanspreekpunt beantwoordt een verzoek en stuurt zo nodig door.";
		document.getElementById("admin_web_id").textContent = "";
		document.getElementById("admin_protected").textContent = derivedfield;
		document.getElementById("tech_role").textContent = "Een technisch contact reageert om een gemelde storing op te lossen.";
		document.getElementById("tech_web_id").textContent = "";
		document.getElementById("tech_protected").textContent = derivedfield;
		document.getElementById("billing_role").textContent = "Sommige domain registries houden gegevens bij om hun facturering uit te voeren.";
		document.getElementById("billing_protected").textContent = derivedfield;
		document.getElementById("name_servers_role").textContent = "Naamservers helpen URL's om verbinding te maken met het IP-adres van webservers.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is een web-route-beveiligingsvoorziening op het DNS (Domain Name System).";
		document.getElementById("zone_role").textContent = "Een domein zone is door de ICANN toegewezen aan een domain registry om domeinen te beheren.";
	}
	else if (inputlanguage == 2)	{
		var newfield = 'NEW - ';
		var derivedfield = 'NEW - Non-public data';
		document.getElementById("title").textContent = "Whois modeling";
		document.getElementById("data").textContent = "Domain Name Details";
		document.getElementById("view_type").textContent = "View types: all, isp (Internet Service Provider), public, se (Search Engine)";
		document.getElementById("domain_role").textContent = "A web domain under a top-level domain is unique worldwide and can be freely chosen under certain rules.";
		document.getElementById("domain_name_unicode").textContent = "Names with special characters are stored as ASCII strings using Punycode transcription.";
		document.getElementById("domain_type").textContent = newfield + "Domain types: personal private use, personal public use, trade name exists.";
		document.getElementById("domain_status").textContent = "Domain statuses: free, withdrawn, excluded, requested, active, inactive, in quarantaine.";
		document.getElementById("domain_status_codes").textContent = "Status codes: " + statuscodes;
		document.getElementById("domain_renewed").textContent = newfield + "Search engines can filter by 'active' and a transaction that is not older than one year.";
		document.getElementById("registrar_role").textContent = "A domain registrar takes care of domain reservations and IP address routing.";
		document.getElementById("registrar_web_id").textContent = "";
		document.getElementById("registrar_abuse_email").textContent = "Contact details to report abuse may become mandatory for a registrar.";
		document.getElementById("registrar_protected").textContent = derivedfield;
		document.getElementById("reseller_role").textContent = "A domain reseller may be responsible for processing of the holder's data.";
		document.getElementById("reseller_web_id").textContent = "";
		document.getElementById("reseller_protected").textContent = derivedfield;
		document.getElementById("registrant_role").textContent = "A domain holder has at least the rights of a subscription to his domain.";
		document.getElementById("registrant_web_id").textContent = 'The web ID identification number is being prepared for the Trade Registers.';
		document.getElementById("registrant_trade_name").textContent = "Whois is informative with an existing, intended and visible trade name.";	
		document.getElementById("registrant_personal_name").textContent = "It is possible to deviate from the privacy protection of the holder's personal name.";
		document.getElementById("registrant_protected").textContent = derivedfield;
		document.getElementById("admin_role").textContent = "The administratively responsible desk answers a request, and forwards on if necessary.";
		document.getElementById("admin_web_id").textContent = "";
		document.getElementById("admin_protected").textContent = derivedfield;
		document.getElementById("tech_role").textContent = "A technical contact responds to resolve a reported malfunction.";
		document.getElementById("tech_web_id").textContent = "";
		document.getElementById("tech_protected").textContent = derivedfield;
		document.getElementById("billing_role").textContent = "Some domain registries maintain records to perform their billing.";
		document.getElementById("billing_protected").textContent = derivedfield;
		document.getElementById("name_servers_role").textContent = "Name Servers help URLs connect to the IP address of web servers.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC is a web route security feature on the DNS (Domain Name System).";
		document.getElementById("zone_role").textContent = "A domain zone is assigned by the ICANN to a domain registry to manage domains.";
	}
	else if (inputlanguage == 3)	{
		var newfield = 'NEU - ';
		var derivedfield = 'NEU - Nicht öffentliche Daten';
		document.getElementById("title").textContent = "Whois-Modellierung";
		document.getElementById("data").textContent = "Details zum Domänennamen";
		document.getElementById("view_type").textContent = "Typen anzeigen: alle, isp (Internet Service Provider), öffentlich, se (Suchmaschine)";
		document.getElementById("domain_role").textContent = "Eine Webdomain unter einer Top-Level-Domain ist weltweit einzigartig und unter bestimmten Regeln frei wählbar.";
		document.getElementById("domain_name_unicode").textContent = "Namen mit Sonderzeichen werden mittels Punycode-Transkription als ASCII-Strings gespeichert.";
		document.getElementById("domain_type").textContent = newfield + "Domain-Typen: persönliche private Nutzung, persönliche öffentliche Nutzung, Handelsname existiert.";
		document.getElementById("domain_status").textContent = "Domänenstatus: frei, zurückgezogen, ausgeschlossen, beantragt, aktiv, inaktiv, in Quarantäne.";
		document.getElementById("domain_status_codes").textContent = "Statuscodes: " + statuscodes;
		document.getElementById("domain_renewed").textContent = newfield + "Suchmaschinen können nach „aktiv“ und einer Transaktion filtern, die nicht älter als ein Jahr ist.";
		document.getElementById("registrar_role").textContent = "Ein Domain-Registrar kümmert sich um Domain-Reservierungen und IP-Adress-Routing.";
		document.getElementById("registrar_abuse_email").textContent = "Kontaktdaten zum Melden von Missbrauch können für einen Registrar obligatorisch werden.";
		document.getElementById("registrar_web_id").textContent = "";
		document.getElementById("registrar_protected").textContent = derivedfield;
		document.getElementById("reseller_role").textContent = "Ein Domain-Wiederverkäufer kann für die Verarbeitung der Daten des Inhabers verantwortlich sein.";
		document.getElementById("reseller_web_id").textContent = "";
		document.getElementById("reseller_protected").textContent = derivedfield;
		document.getElementById("registrant_role").textContent = "Ein Domaininhaber hat zumindest die Rechte eines Abonnements seiner Domain.";
		document.getElementById("registrant_web_id").textContent = 'Die Web-ID-Identifikationsnummer wird für die Handelsregister vorbereitet.';
		document.getElementById("registrant_trade_name").textContent = "Whois ist informativ mit einem bestehenden, beabsichtigten und sichtbaren Handelsnamen.";
		document.getElementById("registrant_personal_name").textContent = "Es ist möglich, vom Datenschutz des Personennamens des Inhabers abzuweichen.";
		document.getElementById("registrant_protected").textContent = derivedfield;
		document.getElementById("admin_role").textContent = "Die administrativ zuständige Stelle beantwortet eine Anfrage und leitet sie gegebenenfalls weiter.";
		document.getElementById("admin_web_id").textContent = "";
		document.getElementById("admin_protected").textContent = derivedfield;
		document.getElementById("tech_role").textContent = "Ein technischer Kontakt reagiert, um eine gemeldete Störung zu beheben.";
		document.getElementById("tech_web_id").textContent = "";
		document.getElementById("tech_protected").textContent = derivedfield;
		document.getElementById("billing_role").textContent = "Einige Domänenregistrierungen führen Aufzeichnungen, um ihre Abrechnung durchzuführen.";
		document.getElementById("billing_protected").textContent = derivedfield;
		document.getElementById("name_servers_role").textContent = "Nameserver helfen URLs, sich mit der IP-Adresse von Webservern zu verbinden.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC ist eine Sicherheitsfunktion für Webrouten im DNS (Domain Name System).";
		document.getElementById("zone_role").textContent = "Eine Domänenzone wird von ICANN einer Domänenregistrierungsstelle zugewiesen, um Domänen zu verwalten.";
	}
	else if (inputlanguage == 4)	{
		var newfield = 'NOUVEAU - ';
		var derivedfield = 'NOUVEAU - Données non publiques';
		document.getElementById("title").textContent = "Modélisation Whois";
		document.getElementById("data").textContent = "Détails du nom de domaine";
		document.getElementById("view_type").textContent = "Types d'affichage : toutes, fsi (fournisseur de service Internet), public, se (moteur de recherche)";
		document.getElementById("domain_role").textContent = "Un domaine Web sous un domaine de premier niveau est unique au monde et peut être choisi librement selon certaines règles.";
		document.getElementById("domain_name_unicode").textContent = "Les noms avec des caractères spéciaux sont stockés sous forme de chaînes ASCII à l'aide de la transcription Punycode.";
		document.getElementById("domain_type").textContent = newfield + "Type de domaine : usage privé personnel, usage public personnel, le nom commercial existe.";
		document.getElementById("domain_status").textContent = "Statuts de domaine : libre, retiré, exclu, demandé, actif, inactif, en quarantaine.";
		document.getElementById("domain_status_codes").textContent = "Codes de statuts : " + statuscodes;
		document.getElementById("domain_renewed").textContent = newfield + "Les moteurs de recherche peuvent filtrer par 'actif' et une transaction datant de moins d'un an.";
		document.getElementById("registrar_role").textContent = "Un registraire de domaine s'occupe des réservations de domaine et du routage des adresses IP.";
		document.getElementById("registrar_web_id").textContent = "";
		document.getElementById("registrar_abuse_email").textContent = "Les coordonnées pour signaler un abus peuvent devenir obligatoires pour un bureau d'enregistrement.";
		document.getElementById("registrar_protected").textContent = derivedfield;
		document.getElementById("reseller_role").textContent = "Un revendeur de domaine peut être responsable du traitement des données du titulaire.";
		document.getElementById("reseller_web_id").textContent = "";
		document.getElementById("reseller_protected").textContent = derivedfield;
		document.getElementById("registrant_role").textContent = "Un titulaire de domaine a au moins les droits d'un abonnement à son domaine.";
		document.getElementById("registrant_web_id").textContent = "Le numéro d'identification web ID est en cours d'élaboration pour les registres du commerce.";
		document.getElementById("registrant_trade_name").textContent = "Le Whois est informatif avec un nom commercial existant, prévu et visible.";
		document.getElementById("registrant_personal_name").textContent = "Il est possible de déroger à la protection de la vie privée du nom personnel du titulaire.";
		document.getElementById("registrant_protected").textContent = derivedfield;
		document.getElementById("admin_role").textContent = "Le bureau administrativement responsable répond à une demande, et la transmet si nécessaire.";
		document.getElementById("admin_web_id").textContent = "";
		document.getElementById("admin_protected").textContent = derivedfield;
		document.getElementById("tech_role").textContent = "Un contact technique répond pour résoudre un dysfonctionnement signalé.";
		document.getElementById("tech_web_id").textContent = "";
		document.getElementById("tech_protected").textContent = derivedfield;
		document.getElementById("billing_role").textContent = "Certains registres de domaine conservent des enregistrements pour effectuer leur facturation.";
		document.getElementById("billing_protected").textContent = derivedfield;
		document.getElementById("name_servers_role").textContent = "Les serveurs de noms aident les URL à se connecter à l'adresse IP des serveurs Web.";
		document.getElementById("name_servers_dnssec").textContent = "DNSSEC est une fonctionnalité de sécurité de route Web sur le DNS (Domain Name System).";
		document.getElementById("zone_role").textContent = "Une zone de domaine est attribuée par l'ICANN à un registre de domaine pour gérer les domaines.";
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
$domainfile = 'whois_form_data.xml';
$zonefile = 'whois_zone_data.xml';
$inputdomain = 'webhostingtech.nl';
$url1a = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=$inputdomain&format=xml&type=1";
$url1b = "http://whois.hostingtool.nl/".$domainfile;
$url2a = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=$inputdomain&format=xml&type=2";
$url2b = "http://whois.hostingtool.nl/".$zonefile;

if (file_exists($developmentpath.$domainfile) and false)	{ // for development
	$xml1 = simplexml_load_file($developmentpath.$domainfile) or die("Cannot load xml1 from path,");
}
elseif (file_exists($domainfile))	{ // for working with just the GitHub files
	$xml1 = simplexml_load_file($domainfile) or die("Cannot load xml1 from same folder.");
}
elseif (@get_headers($url1a) and false)	{ // the application to compose is modeled only for zone data.
	$xml1 = simplexml_load_file($url1a, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url1a from non-public folder.");
}
else	{
	$xml1 = simplexml_load_file($url1b, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url1b from public_html folder.");
}

if (file_exists($developmentpath.$zonefile) and false)	{ // for development
	$xml2 = simplexml_load_file($developmentpath.$zonefile) or die("Cannot load xml2 from path.");
}
elseif (file_exists($zonefile))	{ // for working with just the GitHub files
	$xml2 = simplexml_load_file($zonefile) or die("Cannot load xml2 from same folder.");
}
elseif (@get_headers($url2a) and false)	{ // for using the application to compose
	$xml2 = simplexml_load_file($url2a, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url2a from non-public folder.");
}
else	{
	$xml2 = simplexml_load_file($url2b, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url2b from public_html folder.");
}
$html_text = '<body onload=SwitchTranslation('.$inputlanguage.')><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem">
<tr><th style="width:325px"></th><th style="width:300px"></th><th style="width:750px"></th></tr>';
$html_text .= '<tr><td id="title" style="font-size: 1.5rem;color:blue;font-weight:bold"></td><td id="data" style="font-size:1.2rem;color:blue;font-weight:bold"></td>
<td style="font-size: .9rem"><a href="https://www.sidn.nl/en/whois?q=webhostingtech.nl" target="_blank">sidn.nl/en/whois?q=webhostingtech.nl/whois</a>
- <a href="https://github.com/janwillemstegink/xml-whois" target="_blank">github.com/janwillemstegink/xml-whois</a>
- <a href="">future detailed work instructions</a></td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';	
	$html_text .= '<tr><td></td><td></td><td>
	<button style="cursor:pointer" onclick="SwitchTranslation(0)">0</button> - 
	<button style="cursor:pointer" onclick="SwitchTranslation(1)">Toelichting in het nederlands</button> - 
	<button style="cursor:pointer" onclick="SwitchTranslation(2)">Explanation in English</button> - 
	<button style="cursor:pointer" onclick="SwitchTranslation(3)">Erläuterung auf Deutsch</button> - 
	<button style="cursor:pointer" onclick="SwitchTranslation(4)">Explication en français</button></td></tr>';
	$html_text .= '<tr><td><b>view_datetime</b></td><td>'.$item->view->view_datetime.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>view_type</b></td><td>'.$item->view->view_type.'</td><td id="view_type" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(20)">domain +/-</button></td><td></td><td id="domain_role" style="font-weight:bold"></td></tr>';
	$html_text .= '<tr id="201" style="display:none"><td><b>domain_id</b></td><td>'.$item->domain_id.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>domain_name_ascii</b></td><td>'.$item->domain_name_ascii.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>domain_name_unicode</b></td><td>'.$item->domain_name_unicode.'</td><td id="domain_name_unicode" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><b>domain_type</b></td><td>'.$item->domain_type.'</td><td id="domain_type" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><b>domain_status</b></td><td>'.$item->domain_status.'</td><td id="domain_status" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="202" style="display:none"><td><b>domain_status_codes</b></td><td>'.$item->domain_status_codes.'</td><td id="domain_status_codes" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="203" style="display:none"><td><b>domain_created</b></td><td>'.$item->domain_created.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>domain_renewed</b></td><td>'.$item->domain_renewed.'</td><td id="domain_renewed" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="204" style="display:none"><td><b>domain_updated</b></td><td>'.$item->domain_updated.'</td><td></td></tr>';
	$html_text .= '<tr id="205" style="display:none"><td><b>domain_expiration</b></td><td>'.$item->domain_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="206" style="display:none"><td><b>domain_out_of_quarantine</b></td><td>'.$item->domain_out_of_quarantine.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(30)">registrar +/-</button></td><td></td><td id="registrar_role" style="font-weight:bold"></td></tr>';
	$html_text .= '<tr id="301" style="display:none"><td><b>registrar_contact_id</b></td><td>'.$item->registrar->registrar_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>registrar_web_id</b></td><td>'.$item->registrar->registrar_web_id.'</td><td id="registrar_web_id" style="font-style:italic"></td></tr>';		
	$html_text .= '<tr><td><b>registrar_trade_name</b></td><td>'.$item->registrar->registrar_trade_name.'</td><td></td></tr>';
	$html_text .= '<tr id="302" style="display:none"><td><b>registrar_url</b></td><td>'.$item->registrar->registrar_url.'</td><td></td></tr>';
	$html_text .= '<tr id="303" style="display:none"><td><b>registrar_iana_id</b></td><td>'.$item->registrar->registrar_iana_id.'</td><td></td></tr>';
	$html_text .= '<tr id="304" style="display:none"><td><b>registrar_abuse_email</b></td><td>'.$item->registrar->registrar_abuse_email.'</td><td id="registrar_abuse_email" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="305" style="display:none"><td><b>registrar_abuse_phone</b></td><td>'.$item->registrar->registrar_abuse_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="306" style="display:none"><td><b>registrar_personal_name</b></td><td>'.$item->registrar->registrar_personal_name.'</td><td></td></tr>';
	$html_text .= '<tr id="307" style="display:none"><td><b>registrar_phone</b></td><td>'.$item->registrar->registrar_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="308" style="display:none"><td><b>registrar_phone_ext</b></td><td>'.$item->registrar->registrar_phone_ext.'</td><td></td></tr>';
	$html_text .= '<tr id="309" style="display:none"><td><b>registrar_fax</b></td><td>'.$item->registrar->registrar_fax.'</td><td></td></tr>';
	$html_text .= '<tr id="3010" style="display:none"><td><b>registrar_fax_ext</b></td><td>'.$item->registrar->registrar_fax_ext.'</td><td></td></tr>';
	$html_text .= '<tr id="3011" style="display:none"><td><b>registrar_email</b></td><td>'.$item->registrar->registrar_email.'</td><td></td></tr>';
	$html_text .= '<tr id="3012" style="display:none"><td><b>registrar_street</b></td><td>'.$item->registrar->registrar_street.'</td><td></td></tr>';
	$html_text .= '<tr id="3013" style="display:none"><td><b>registrar_postal_code</b></td><td>'.$item->registrar->registrar_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="3014" style="display:none"><td><b>registrar_city</b></td><td>'.$item->registrar->registrar_city.'</td><td></td></tr>';
	$html_text .= '<tr id="3015" style="display:none"><td><b>registrar_state_province</b></td><td>'.$item->registrar->registrar_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="3016" style="display:none"><td><b>registrar_country_code</b></td><td>'.$item->registrar->registrar_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="3017" style="display:none"><td><b>registrar_country_name</b></td><td>'.$item->registrar->registrar_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="3018" style="display:none"><td><b>registrar_country_language</b></td><td>'.$item->registrar->registrar_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="3019" style="display:none"><td><b>registrar_protected</b></td><td>'.$item->registrar->registrar_protected.'</td><td id="registrar_protected" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	if (!empty($item->reseller->reseller_trade_name))	{
		if (strlen(trim($item->reseller->reseller_trade_name)))	{
			$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(40)">reseller +/-</button></td><td></td><td id="reseller_role" style="font-weight:bold"></td></tr>';				$html_text .= '<tr id="401" style="display:none"><td><b>reseller_contact_id</b></td><td>'.$item->reseller->reseller_contact_id.'</td><td></td></tr>';
			$html_text .= '<tr><td><b>reseller_web_id</b></td><td>'.$item->reseller->reseller_web_id.'</td><td id="reseller_web_id" style="font-style:italic"></td></tr>';
			$html_text .= '<tr><td><b>reseller_trade_name</b></td><td>'.$item->reseller->reseller_trade_name.'</td><td></td></tr>';
			$html_text .= '<tr id="402" style="display:none"><td><b>reseller_personal_name</b></td><td>'.$item->reseller->reseller_personal_name.'</td><td></td></tr>';
			$html_text .= '<tr id="403" style="display:none"><td><b>reseller_phone</b></td><td>'.$item->reseller->reseller_phone.'</td><td></td></tr>';
			$html_text .= '<tr id="404" style="display:none"><td><b>reseller_phone_ext</b></td><td>'.$item->reseller->reseller_phone_ext.'</td><td></td></tr>';
			$html_text .= '<tr id="405" style="display:none"><td><b>reseller_fax</b></td><td>'.$item->reseller->reseller_fax.'</td><td></td></tr>';
			$html_text .= '<tr id="406" style="display:none"><td><b>reseller_fax_ext</b></td><td>'.$item->reseller->reseller_fax_ext.'</td><td></td></tr>';
			$html_text .= '<tr id="407" style="display:none"><td><b>reseller_email</b></td><td>'.$item->reseller->reseller_email.'</td><td></td></tr>';			
			$html_text .= '<tr id="408" style="display:none"><td><b>reseller_street</b></td><td>'.$item->reseller->reseller_street.'</td><td></td></tr>';
			$html_text .= '<tr id="409" style="display:none"><td><b>reseller_postal_code</b></td><td>'.$item->reseller->reseller_postal_code.'</td><td></td></tr>';
			$html_text .= '<tr id="4010" style="display:none"><td><b>reseller_city</b></td><td>'.$item->reseller->reseller_city.'</td><td></td></tr>';
			$html_text .= '<tr id="4011" style="display:none"><td><b>reseller_state_province</b></td><td>'.$item->reseller->reseller_state_province.'</td><td></td></tr>';			
			$html_text .= '<tr id="4012" style="display:none"><td><b>reseller_country_code</b></td><td>'.$item->reseller->reseller_country_code.'</td><td></td></tr>';
			$html_text .= '<tr id="4013" style="display:none"><td><b>reseller_country_name</b></td><td>'.$item->reseller->reseller_country_name.'</td><td></td></tr>';
			$html_text .= '<tr id="4014" style="display:none"><td><b>reseller_country_language</b></td><td>'.$item->reseller->reseller_country_language.'</td><td></td></tr>';
			$html_text .= '<tr id="4015" style="display:none"><td><b>reseller_protected</b></td><td>'.$item->reseller->reseller_protected.'</td><td id="reseller_protected" style="font-style:italic"></td></tr>';
			$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
		}	
	}
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(50)">registrant +/-</button></td><td></td><td id="registrant_role" style="font-weight:bold"></td></tr>';
	$html_text .= '<tr id="501" style="display:none"><td><b>registrant_contact_id</b></td><td>'.$item->registrant->registrant_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>registrant_web_id</b></td><td>'.$item->registrant->registrant_web_id.'</td><td id="registrant_web_id" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><b>registrant_trade_name</b></td><td>'.$item->registrant->registrant_trade_name.'</td><td id="registrant_trade_name" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><b>registrant_personal_name</b></td><td>'.$item->registrant->registrant_personal_name.'</td><td id="registrant_personal_name" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="502" style="display:none"><td><b>registrant_phone</b></td><td>'.$item->registrant->registrant_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="503" style="display:none"><td><b>registrant_phone_ext</b></td><td>'.$item->registrant->registrant_phone_ext.'</td><td></td></tr>';
	$html_text .= '<tr id="504" style="display:none"><td><b>registrant_fax</b></td><td>'.$item->registrant->registrant_fax.'</td><td></td></tr>';
	$html_text .= '<tr id="505" style="display:none"><td><b>registrant_fax_ext</b></td><td>'.$item->registrant->registrant_fax_ext.'</td><td></td></tr>';
	$html_text .= '<tr id="506" style="display:none"><td><b>registrant_email</b></td><td>'.$item->registrant->registrant_email.'</td><td></td></tr>';
	$html_text .= '<tr id="507" style="display:none"><td><b>registrant_street</b></td><td>'.$item->registrant->registrant_street.'</td><td></td></tr>';
	$html_text .= '<tr id="508" style="display:none"><td><b>registrant_postal_code</b></td><td>'.$item->registrant->registrant_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="509" style="display:none"><td><b>registrant_city</b></td><td>'.$item->registrant->registrant_city.'</td><td></td></tr>';
	$html_text .= '<tr id="5010" style="display:none"><td><b>registrant_state_province</b></td><td>'.$item->registrant->registrant_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="5011" style="display:none"><td><b>registrant_country_code</b></td><td>'.$item->registrant->registrant_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="5012" style="display:none"><td><b>registrant_country_name</b></td><td>'.$item->registrant->registrant_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="5013" style="display:none"><td><b>registrant_country_language</b></td><td>'.$item->registrant->registrant_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="5014" style="display:none"><td><b>registrant_protected</b></td><td>'.$item->registrant->registrant_protected.'</td><td id="registrant_protected" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(60)">admin +/-</button></td><td></td><td id="admin_role" style="font-weight:bold"></td></tr>';
	$html_text .= '<tr id="601" style="display:none"><td><b>admin_contact_id</b></td><td>'.$item->admin->admin_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr id="603" style="display:none"><td><b>admin_web_id</b></td><td>'.$item->admin->admin_web_id.'</td><td id="admin_web_id" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="602" style="display:none"><td><b>admin_trade_name</b></td><td>'.$item->admin->admin_trade_name.'</td><td></td></tr>';
	$html_text .= '<tr id="604" style="display:none"><td><b>admin_personal_name</b></td><td>'.$item->admin->admin_personal_name.'</td><td></td></tr>';
	$html_text .= '<tr id="605" style="display:none"><td><b>admin_phone</b></td><td>'.$item->admin->admin_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="606" style="display:none"><td><b>admin_phone_ext</b></td><td>'.$item->admin->admin_phone_ext.'</td><td></td></tr>';
	$html_text .= '<tr id="607" style="display:none"><td><b>admin_fax</b></td><td>'.$item->admin->admin_fax.'</td><td></td></tr>';
	$html_text .= '<tr id="608" style="display:none"><td><b>admin_fax_ext</b></td><td>'.$item->admin->admin_fax_ext.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>admin_email</b></td><td>'.$item->admin->admin_email.'</td><td></td></tr>';
	$html_text .= '<tr id="609" style="display:none"><td><b>admin_street</b></td><td>'.$item->admin->admin_street.'</td><td></td></tr>';
	$html_text .= '<tr id="6010" style="display:none"><td><b>admin_postal_code</b></td><td>'.$item->admin->admin_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6011" style="display:none"><td><b>admin_city</b></td><td>'.$item->admin->admin_city.'</td><td></td></tr>';
	$html_text .= '<tr id="6012" style="display:none"><td><b>admin_state_province</b></td><td>'.$item->admin->admin_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="6013" style="display:none"><td><b>admin_country_code</b></td><td>'.$item->admin->admin_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6014" style="display:none"><td><b>admin_country_name</b></td><td>'.$item->admin->admin_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="6015" style="display:none"><td><b>admin_country_language</b></td><td>'.$item->admin->admin_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="6016" style="display:none"><td><b>admin_protected</b></td><td>'.$item->admin->admin_protected.'</td><td id="admin_protected" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(70)">tech +/-</button></td><td></td><td id="tech_role" style="font-weight:bold"></td></tr>';
	$html_text .= '<tr id="701" style="display:none"><td><b>tech_contact_id</b></td><td>'.$item->tech->tech_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr id="702" style="display:none"><td><b>tech_web_id</b></td><td>'.$item->tech->tech_web_id.'</td><td id="tech_web_id" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="703" style="display:none"><td><b>tech_trade_name</b></td><td>'.$item->tech->tech_trade_name.'</td><td></td></tr>';
	$html_text .= '<tr id="704" style="display:none"><td><b>tech_personal_name</b></td><td>'.$item->tech->tech_personal_name.'</td><td></td></tr>';
	$html_text .= '<tr id="705" style="display:none"><td><b>tech_phone</b></td><td>'.$item->tech->tech_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="706" style="display:none"><td><b>tech_phone_ext</b></td><td>'.$item->tech->tech_phone_ext.'</td><td></td></tr>';
	$html_text .= '<tr id="707" style="display:none"><td><b>tech_fax</b></td><td>'.$item->tech->tech_fax.'</td><td></td></tr>';
	$html_text .= '<tr id="708" style="display:none"><td><b>tech_fax_ext</b></td><td>'.$item->tech->tech_fax_ext.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>tech_email</b></td><td>'.$item->tech->tech_email.'</td><td></td></tr>';
	$html_text .= '<tr id="709" style="display:none"><td><b>tech_street</b></td><td>'.$item->tech->tech_street.'</td><td></td></tr>';
	$html_text .= '<tr id="7010" style="display:none"><td><b>tech_postal_code</b></td><td>'.$item->tech->tech_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="7011" style="display:none"><td><b>tech_city</b></td><td>'.$item->tech->tech_city.'</td><td></td></tr>';
	$html_text .= '<tr id="7012" style="display:none"><td><b>tech_state_province</b></td><td>'.$item->tech->tech_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="7013" style="display:none"><td><b>tech_country_code</b></td><td>'.$item->tech->tech_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="7014" style="display:none"><td><b>tech_country_name</b></td><td>'.$item->tech->tech_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="7015" style="display:none"><td><b>tech_country_language</b></td><td>'.$item->tech->tech_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="7016" style="display:none"><td><b>tech_protected</b></td><td>'.$item->tech->tech_protected.'</td><td id="tech_protected" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(80)">billing +/-</button></td><td></td><td id="billing_role" style="font-weight:bold"></td></tr>';
	$html_text .= '<tr id="801" style="display:none"><td><b>billing_contact_id</b></td><td>'.$item->billing->billing_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr id="802" style="display:none"><td><b>billing_web_id</b></td><td>'.$item->billing->billing_web_id.'</td><td></td></tr>';
	$html_text .= '<tr id="803" style="display:none"><td><b>billing_trade_name</b></td><td>'.$item->billing->billing_trade_name.'</td><td></td></tr>';
	$html_text .= '<tr id="804" style="display:none"><td><b>billing_personal_name</b></td><td>'.$item->billing->billing_personal_name.'</td><td></td></tr>';
	$html_text .= '<tr id="805" style="display:none"><td><b>billing_phone</b></td><td>'.$item->billing->billing_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="806" style="display:none"><td><b>billing_phone_ext</b></td><td>'.$item->billing->billing_phone_ext.'</td><td></td></tr>';
	$html_text .= '<tr id="807" style="display:none"><td><b>billing_fax</b></td><td>'.$item->billing->billing_fax.'</td><td></td></tr>';
	$html_text .= '<tr id="808" style="display:none"><td><b>billing_fax_ext</b></td><td>'.$item->billing->billing_fax_ext.'</td><td></td></tr>';
	$html_text .= '<tr id="809" style="display:none"><td><b>billing_email</b></td><td>'.$item->billing->billing_email.'</td><td></td></tr>';
	$html_text .= '<tr id="8010" style="display:none"><td><b>billing_street</b></td><td>'.$item->billing->billing_street.'</td><td></td></tr>';
	$html_text .= '<tr id="8011" style="display:none"><td><b>billing_postal_code</b></td><td>'.$item->billing->billing_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="8012" style="display:none"><td><b>billing_city</b></td><td>'.$item->billing->billing_city.'</td><td></td></tr>';
	$html_text .= '<tr id="8013" style="display:none"><td><b>billing_state_province</b></td><td>'.$item->billing->billing_state_province.'</td><td></td></tr>';	
	$html_text .= '<tr id="8014" style="display:none"><td><b>billing_country_code</b></td><td>'.$item->billing->billing_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="8015" style="display:none"><td><b>billing_country_name</b></td><td>'.$item->billing->billing_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="8016" style="display:none"><td><b>billing_country_language</b></td><td>'.$item->billing->billing_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="8017" style="display:none"><td><b>billing_protected</b></td><td>'.$item->billing->billing_protected.'</td><td id="billing_protected" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(90)">name servers +/-</button></td><td></td><td id="name_servers_role" style="font-weight:bold"></td></tr>';
	if (!empty($item->name_servers->server_1->server_name_1))	{
		if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
			$html_text .= '<tr id="901" style="display:none"><td><b>server_name_1</b></td><td>'.$item->name_servers->server_1->server_name_1.'</td><td></td></tr>';
			$html_text .= '<tr id="902" style="display:none"><td><b>ipv4_1</b></td><td>'.$item->name_servers->server_1->ipv4_1.'</td><td></td></tr>';
			$html_text .= '<tr id="903" style="display:none"><td><b>ipv6_1</b></td><td>'.$item->name_servers->server_1->ipv6_1.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_1->server_name_1))	{		
		if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
			$html_text .= '<tr id="904" style="display:none"><td><b>server_name_2</b></td><td>'.$item->name_servers->server_2->server_name_2.'</td><td></td></tr>';
			$html_text .= '<tr id="905" style="display:none"><td><b>ipv4_2</b></td><td>'.$item->name_servers->server_2->ipv4_2.'</td><td></td></tr>';
			$html_text .= '<tr id="906" style="display:none"><td><b>ipv6_2</b></td><td>'.$item->name_servers->server_2->ipv6_2.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_3->server_name_3))	{
		if (strlen(trim($item->name_servers->server_3->server_name_3)))	{
			$html_text .= '<tr id="907" style="display:none"><td><b>server_name_3</b></td><td>'.$item->name_servers->server_3->server_name_3.'</td><td></td></tr>';
			$html_text .= '<tr id="908" style="display:none"><td><b>ipv4_3</b></td><td>'.$item->name_servers->server_3->ipv4_3.'</td><td></td></tr>';
			$html_text .= '<tr id="909" style="display:none"><td><b>ipv6_3</b></td><td>'.$item->name_servers->server_3->ipv6_3.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_4->server_name_4))	{	
		if (strlen(trim($item->name_servers->server_4->server_name_4)))	{
			$html_text .= '<tr id="9010" style="display:none"><td><b>server_name_4</b></td><td>'.$item->name_servers->server_4->server_name_4.'</td><td></td></tr>';
			$html_text .= '<tr id="9011" style="display:none"><td><b>ipv4_4</b></td><td>'.$item->name_servers->server_4->ipv4_4.'</td><td></td></tr>';
			$html_text .= '<tr id="9012" style="display:none"><td><b>ipv6_4</b></td><td>'.$item->name_servers->server_4->ipv6_4.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_5->server_name_5))	{		
		if (strlen(trim($item->name_servers->server_5->server_name_5)))	{
			$html_text .= '<tr id="9013" style="display:none"><td><b>server_name_5</b></td><td>'.$item->name_servers->server_5->server_name_5.'</td><td></td></tr>';
			$html_text .= '<tr id="9014" style="display:none"><td><b>ipv4_5</b></td><td>'.$item->name_servers->server_5->ipv4_5.'</td><td></td></tr>';
			$html_text .= '<tr id="9015" style="display:none"><td><b>ipv6_5</b></td><td>'.$item->name_servers->server_5->ipv6_5.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_6->server_name_6))	{
		if (strlen(trim($item->name_servers->server_6->server_name_6)))	{
			$html_text .= '<tr id="9016" style="display:none"><td><b>server_name_6</b></td><td>'.$item->name_servers->server_6->server_name_6.'</td><td></td></tr>';
			$html_text .= '<tr id="9017" style="display:none"><td><b>ipv4_6</b></td><td>'.$item->name_servers->server_6->ipv4_6.'</td><td></td></tr>';
			$html_text .= '<tr id="9018" style="display:none"><td><b>ipv6_6</b></td><td>'.$item->name_servers->server_6->ipv6_6.'</td><td></td></tr>';
		}	
	}
	$html_text .= '<tr><td><b>name_servers_dnssec</b></td><td>'.$item->name_servers->name_servers_dnssec.'</td><td id="name_servers_dnssec" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	break;
}
foreach ($xml2->xpath('//zone') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(100)">zone +/-</button></td><td></td><td id="zone_role" style="font-weight:bold"></td></tr>';
	$html_text .= '<tr><td><b>zone_whois_server</b></td><td>'.$item->zone_whois_server.'</td><td></td></tr>';
	$html_text .= '<tr id="1001" style="display:none"><td><b>zone_description</b></td><td>'.$item->zone_description.'</td><td></td></tr>';
	$html_text .= '<tr id="1002" style="display:none"><td><b>zone_support_email</b></td><td>'.$item->zone_support_email.'</td><td></td></tr>';
	$html_text .= '<tr id="1003" style="display:none"><td><b>zone_registry_full_name</b></td><td>'.$item->zone_registry_full_name.'</td><td></td></tr>';
	$html_text .= '<tr id="1004" style="display:none"><td><b>zone_registry_abbreviated_name</b></td><td>'.$item->zone_registry_abbreviated_name.'</td><td></td></tr>';
	$html_text .= '<tr id="1005" style="display:none"><td><b>zone_registry_web_id</b></td><td>'.$item->zone_registry_web_id.'</td><td></td></tr>';
	$html_text .= '<tr id="1006" style="display:none"><td><b>zone_time_zone</b></td><td>'.$item->zone_time_zone.'</td><td></td></tr>';
	$html_text .= '<tr id="1007" style="display:none"><td><b>zone_language</b></td><td>'.$item->zone_language.'</td><td></td></tr>';
	$html_text .= '<tr id="1008" style="display:none"><td><b>zone_format</b></td><td>'.$item->zone_format.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(110)">whois restrictions +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="1101" style="display:none"><td><b>whois_legal_restrictions</b></td><td>'.$item->whois_legal_restrictions.'</td><td></td></tr>';
	$html_text .= '<tr id="1102" style="display:none"><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr id="1103" style="display:none"><td><b>whois_translated_restrictions</b></td><td>'.$item->whois_translated_restrictions.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	break;
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>