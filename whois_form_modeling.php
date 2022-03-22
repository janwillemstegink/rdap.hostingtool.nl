<?php
session_start();  // is needed with no PHP Generator Scriptcase
echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="robots" content="index"><title>Modeling of domain Whois fields</title>';
?><script>
function SwitchDisplay(type) {
	if (type == 20)	{ // domain
		var pre = 'B';
		var max = 5
	}
	else if (type == 30)	{ // registrar
		var pre = 'C';
		var max = 15
	}
	else if (type == 40)	{ // reseller
		var pre = 'D';
		var max = 11
	}
	else if (type == 50)	{ // registrant
		var pre = 'E';
		var max = 10
	}
	else if (type == 60)	{ // admin
		var pre = 'F';
		var max = 6
	}
	else if (type == 70)	{ // tech
		var pre = 'G';
		var max = 24
	}
	else if (type == 80)	{ // billing
		var pre = 'H';
		var max = 12
	}
	else if (type == 90)	{ // name servers
		var pre = 'I';
		var max = 18
	}
	else if (type == 100)	{ // registry
		var pre = 'J';
		var max = 2
	}
	else if (type == 110)	{ // conditions
		var pre = 'K';
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
	
function OpenMenu()	{
   	return;
}

function SwitchTranslation(inputlanguage)	{
	if (inputlanguage == 1)	{
		var newdomainfield = 'NIEUW veld';
		var newcontactfield = '(nieuw veld in de tabel met contacten)';
		document.getElementById("title").innerText = "Webdomein Whois-modellering";
		document.getElementById("data").innerText = "Gegevens in xml-formaat uit het register";
		document.getElementById("view_type").innerText = "Typen: alles, isp (Internet Service Provider), publiek";
		document.getElementById("domain_status").innerText = "Statussen: vrij, onttrokken, uitgesloten, in aanvraag, actief, inactief, in quarantaine.";
		document.getElementById("domain_web_publish").innerText = newdomainfield + ": Als 'web_publish' is ingesteld op 'ja', dan komt publiceren van een zoekresultaat overeen.";
		document.getElementById("domain_last_renewal").innerText = newdomainfield + ": Een zoekmachine kan deze datum gebruiken om op jaarlijkse verlenging te controleren.";
		document.getElementById("registrar_web_id").innerText = newcontactfield;
		document.getElementById("registrar_abuse_email").innerText = "Contactgegevens om misbruik te melden zijn niet verplicht voor een registrar.";
		document.getElementById("registrar_protected").innerText = newcontactfield;
		document.getElementById("reseller_company_name").innerText = "De verwerkersovereenkomst kan tussen de reseller en de houder zijn.";
		document.getElementById("reseller_web_id").innerText = newcontactfield;
		document.getElementById("reseller_protected").innerText = newcontactfield;
		document.getElementById("registrant_company_name").innerText = "Er is legitiem houderschap met een bestaande, bedoelde en zichtbare bedrijfsnaam.";
		document.getElementById("registrant_web_id").innerText = newdomainfield + ": De KVK kan de benodigde 'web_id'-identificatie aan het Handelsregister toevoegen.";
		document.getElementById("registrant_personal_name").innerText = "De houdernaam van een natuurlijke persoon kan op verzoek zichtbaar zijn.";
		document.getElementById("registrant_protected").innerText = newcontactfield;
		document.getElementById("admin_web_id").innerText = newcontactfield;
		document.getElementById("admin_email").innerText = "Het administratief aanspreekpunt beantwoordt een verzoek, en stuurt het indien nodig door.";
		document.getElementById("admin_protected").innerText = newcontactfield;
		document.getElementById("tech_web_id_1").innerText = newcontactfield;
		document.getElementById("tech_email_1").innerText = "Een technisch contact reageert om een gemelde storing op te lossen.";
		document.getElementById("tech_protected_1").innerText = newcontactfield;
		document.getElementById("billing_protected").innerText = newcontactfield;
		document.getElementById("name_servers_dnssec").innerText = "DNSSEC is een web-route-beveiligingsvoorziening op het DNS (Domain Name System).";				
	}
	else if (inputlanguage == 2)	{
		var newdomainfield = 'NEW field';
		var newcontactfield = '(new field in the table of contacts)';
		document.getElementById("title").innerText = "Web Domain Whois Modeling";
		document.getElementById("data").innerText = "Data in xml format from the registry";
		document.getElementById("view_type").innerText = "Types: all, isp (Internet Service Provider), public";		
		document.getElementById("domain_status").innerText = "Statusses: free, withdrawn, excluded, requested, active, inactive, in quarantaine.";	
		document.getElementById("domain_web_publish").innerText = newdomainfield + ": If 'web_publish' is set to 'yes', then publishing a search result will match.";	
		document.getElementById("domain_last_renewal").innerText = newdomainfield + ": A search engine can use this date to check for annual renewal.";
		document.getElementById("registrar_web_id").innerText = newcontactfield;
		document.getElementById("registrar_abuse_email").innerText = "Contact details to report abuse are not mandatory for a registrar.";
		document.getElementById("registrar_protected").innerText = newcontactfield;
		document.getElementById("reseller_company_name").innerText = "The processing agreement may be between the reseller and the holder.";
		document.getElementById("reseller_web_id").innerText = newcontactfield;
		document.getElementById("reseller_protected").innerText = newcontactfield;
		document.getElementById("registrant_company_name").innerText = "Legitimate holdership exists with an existing, intended and visible company name.";	
		document.getElementById("registrant_web_id").innerText = newdomainfield + ": The Chamber of Commerce can add the required 'web_id' identification to the Trade Register.";	
		document.getElementById("registrant_personal_name").innerText = "The holder's name of a natural person can be visible on request.";
		document.getElementById("registrant_protected").innerText = newcontactfield;
		document.getElementById("admin_web_id").innerText = newcontactfield;
		document.getElementById("admin_email").innerText = "The administratively responsible desk answers a request, and forwards it if necessary.";
		document.getElementById("admin_protected").innerText = newdomainfield;
		document.getElementById("tech_web_id_1").innerText = newcontactfield;
		document.getElementById("tech_email_1").innerText = "A technical contact responds to resolve a reported malfunction.";
		document.getElementById("tech_protected_1").innerText = newcontactfield;
		document.getElementById("billing_protected").innerText = newcontactfield;
		document.getElementById("name_servers_dnssec").innerText = "DNSSEC is a web route security feature on the DNS (Domain Name System).";	
	}
	else if (inputlanguage == 3)	{
		var newdomainfield = 'NEUES Feld';
		var newcontactfield = '(neues Feld in der Kontakttabelle)';
		document.getElementById("title").innerText = "Whois-Modellierung von Webdomänen";
		document.getElementById("data").innerText = "Daten im xml-Format aus der Registry";
		document.getElementById("view_type").innerText = "Typen: all, isp (Internet Service Provider), öffentlich";
		document.getElementById("domain_status").innerText = "Status: frei, zurückgezogen, ausgeschlossen, beantragt, aktiv, inaktiv, in Quarantäne.";
		document.getElementById("domain_web_publish").innerText = newdomainfield + ": Wenn „web_publish“ auf „yes“ gesetzt ist, wird die Veröffentlichung eines Suchergebnisses übereinstimmen.";
		document.getElementById("domain_last_renewal").innerText = newdomainfield + ": Eine Suchmaschine kann dieses Datum verwenden, um nach einer jährlichen Verlängerung zu suchen.";
		document.getElementById("registrar_abuse_email").innerText = "Kontaktdaten zum Melden von Missbrauch sind für einen Registrar nicht zwingend erforderlich.";
		document.getElementById("registrar_web_id").innerText = newcontactfield;
		document.getElementById("registrar_protected").innerText = newcontactfield;
		document.getElementById("reseller_company_name").innerText = "Die Verarbeitungsvereinbarung kann zwischen dem Wiederverkäufer und dem Halter abgeschlossen werden.";
		document.getElementById("reseller_web_id").innerText = newcontactfield;
		document.getElementById("reseller_protected").innerText = newcontactfield;
		document.getElementById("registrant_company_name").innerText = "Eine rechtmäßige Inhaberschaft liegt mit einem bestehenden, beabsichtigten und sichtbaren Firmennamen vor.";
		document.getElementById("registrant_web_id").innerText = newdomainfield + ": Die Handelskammer kann die erforderliche Kennung „web_id“ zum Handelsregister hinzufügen.";
		document.getElementById("registrant_personal_name").innerText = "Der Name des Inhabers einer natürlichen Person kann auf Anfrage sichtbar sein.";
		document.getElementById("registrant_protected").innerText = newcontactfield;
		document.getElementById("admin_web_id").innerText = newcontactfield;
		document.getElementById("admin_email").innerText = "Die administrativ zuständige Stelle beantwortet eine Anfrage und leitet diese gegebenenfalls weiter.";
		document.getElementById("admin_protected").innerText = newcontactfield;
		document.getElementById("tech_web_id_1").innerText = newcontactfield;
		document.getElementById("tech_email_1").innerText = "Ein technischer Kontakt reagiert, um eine gemeldete Störung zu beheben.";
		document.getElementById("tech_protected_1").innerText = newcontactfield;
		document.getElementById("billing_protected").innerText = newcontactfield;
		document.getElementById("name_servers_dnssec").innerText = "DNSSEC ist eine Sicherheitsfunktion für Webrouten im DNS (Domain Name System).";
	}
	else if (inputlanguage == 4)	{
		var newdomainfield = 'NOUVEAU champ';
		var newcontactfield = '(nouveau champ dans le table des contacts)';
		document.getElementById("title").innerText = "Modélisation Whois de domaine Web";
		document.getElementById("data").innerText = "Données au format xml du registre";
		document.getElementById("view_type").innerText = "Types : tous, FSI (fournisseur de service Internet), public";
		document.getElementById("domain_status").innerText = "Statuts : libre, retiré, exclu, demandé, actif, inactif, en quarantaine.";
		document.getElementById("domain_web_publish").innerText = newdomainfield + " : Si 'web_publish' est défini sur 'yes', la publication d'un résultat de recherche correspondra.";
		document.getElementById("domain_last_renewal").innerText = newdomainfield + " : Un moteur de recherche peut utiliser cette date pour vérifier le renouvellement annuel.";
		document.getElementById("registrar_web_id").innerText = newcontactfield;
		document.getElementById("registrar_abuse_email").innerText = "Les coordonnées pour signaler un abus ne sont pas obligatoires pour un bureau d'enregistrement.";
		document.getElementById("registrar_protected").innerText = newcontactfield;
		document.getElementById("reseller_company_name").innerText = "L'accord de traitement peut être conclu entre le revendeur et le titulaire.";
		document.getElementById("reseller_web_id").innerText = newcontactfield;
		document.getElementById("reseller_protected").innerText = newcontactfield;
		document.getElementById("registrant_company_name").innerText = "Un détenteur légitime existe avec un nom de société existant, prévu et visible.";
		document.getElementById("registrant_web_id").innerText = newdomainfield + " : La Chambre de Commerce peut ajouter l'identification 'web_id' requise au registre du commerce.";
		document.getElementById("registrant_personal_name").innerText = "Le nom du titulaire d'une personne physique peut être visible sur demande.";
		document.getElementById("registrant_protected").innerText = newcontactfield;
		document.getElementById("admin_web_id").innerText = newcontactfield;
		document.getElementById("admin_email").innerText = "Le bureau administrativement responsable répond à une demande, et la transmet si nécessaire.";
		document.getElementById("admin_protected").innerText = newdomainfield;
		document.getElementById("tech_web_id_1").innerText = newcontactfield;
		document.getElementById("tech_email_1").innerText = "Un contact technique répond pour résoudre un dysfonctionnement signalé.";
		document.getElementById("tech_protected_1").innerText = newcontactfield;
		document.getElementById("billing_protected").innerText = newcontactfield;
		document.getElementById("name_servers_dnssec").innerText = "DNSSEC est une fonctionnalité de sécurité de route Web sur le DNS (Domain Name System).";
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
$filesPath = '/home/admin/whois_file/';
$dataFile = 'whois_source_data.xml';
$restrictionsFile = 'whois_restrictions.xml';
$inputdomain = 'webhostingtech.nl';
$url1a = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=$inputdomain&format=xml&type=1";
$url2a = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=$inputdomain&format=xml&type=2";
$url1b = "http://whois.hostingtool.nl/".$dataFile;
$url2b = "http://whois.hostingtool.nl/".$restrictionsFile;

if (file_exists($filesPath.$dataFile) and false)	{ // skipping initial testing
	$xml1 = simplexml_load_file($filesPath.$dataFile) or die("Cannot load xml1 from path,");
}
elseif (file_exists($dataFile))	{
	$xml1 = simplexml_load_file($dataFile) or die("Cannot load xml1 from same folder.");
}
elseif (@get_headers($url1a) and false)	{ // skipping complex application to compose
	$xml1 = simplexml_load_file($url1a, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url1a from Scriptcase folder.");
}
else	{
	$url1 = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=$inputdomain&format=xml&type=1";
	$xml1 = simplexml_load_file($url1b, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url1b from public_html folder.");
}

if (file_exists($filesPath.$restrictionsFile and false))	{ // skipping initial testing
	$xml2 = simplexml_load_file($filesPath.$restrictionsFile) or die("Cannot load xml2 from path.");
}
elseif (file_exists($restrictionsFile))	{
	$xml2 = simplexml_load_file($restrictionsFile) or die("Cannot load xml2 from same folder.");
}
elseif (@get_headers($url2a))	{	
	$xml2 = simplexml_load_file($url2a, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url2a from Scriptcase folder.");
}
else	{	
	$xml2 = simplexml_load_file($url2b, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url2b from public_html folder.");
}
$html_text = '<body onload=SwitchTranslation(2)><div style="border-spacing=0; padding=0; border-width=0; padding-bottom:5px; line-height:120%;">
<table style="border-collapse:collapse; font-family:Helvetica, Arial, sans-serif; font-size:13px;">
<tr><th style="width:300px"></th><th style="width:300px"></th><th style="width:725px"></th></tr>';
$html_text .= '<tr><td id="title" style="font-size:16px"><b></b></td><td id="data"></td>
<td><a href="https://www.sidn.nl/whois?q=webhostingtech.nl" target="_blank">sidn.nl/whois?q=webhostingtech.nl/whois</a>
- <a href="https://github.com/janwillemstegink/xml-whois" target="_blank">github.com/janwillemstegink/xml-whois</a></td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="OpenMenu()">see work instruction by a c-c registry</button></td><td></td><td>
	<button style="cursor:pointer;cursor:hand" onclick="SwitchTranslation(1)">nl_NL</button> 
	<button style="cursor:pointer;cursor:hand" onclick="SwitchTranslation(2)">en_US</button> 
	<button style="cursor:pointer;cursor:hand" onclick="SwitchTranslation(3)">de_DE</button> 
	<button style="cursor:pointer;cursor:hand" onclick="SwitchTranslation(4)">fr_FR</button></td></tr>';
	$html_text .= '<tr><td><b>view_datetime</b></td><td>'.$item->view->view_datetime.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>view_type</b></td><td>'.$item->view->view_type.'</td><td id="view_type"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(20)">domain +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="B1" style="display:none"><td><b>domain_id</b></td><td>'.$item->domain_id.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>domain_name</b></td><td>'.$item->domain_name.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>domain_status</b></td><td>'.$item->domain_status.'</td><td id="domain_status"></td></tr>';
	$html_text .= '<tr><td><b>domain_web_publish</b></td><td>'.$item->domain_web_publish.'</td><td id="domain_web_publish"></td></tr>';
	$html_text .= '<tr id="B2" style="display:none"><td><b>domain_creation</b></td><td>'.$item->domain_creation.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>domain_last_renewal</b></td><td>'.$item->domain_last_renewal.'</td><td id="domain_last_renewal"></td></tr>';
	$html_text .= '<tr id="B3" style="display:none"><td><b>domain_updated</b></td><td>'.$item->domain_updated.'</td><td></td></tr>';
	$html_text .= '<tr id="B4" style="display:none"><td><b>domain_expiration</b></td><td>'.$item->domain_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="B5" style="display:none"><td><b>domain_out_of_quarantine</b></td><td>'.$item->domain_out_of_quarantine.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(30)">registrar +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="C1" style="display:none"><td><b>registrar_contact_id</b></td><td>'.$item->registrar->registrar_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>registrar_company_name</b></td><td>'.$item->registrar->registrar_company_name.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>registrar_web_id</b></td><td>'.$item->registrar->registrar_web_id.'</td><td id="registrar_web_id"></td></tr>';
	$html_text .= '<tr id="C2" style="display:none"><td><b>registrar_personal_name</b></td><td>'.$item->registrar->registrar_personal_name.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>registrar_abuse_email</b></td><td>'.$item->registrar->registrar_abuse_email.'</td><td id="registrar_abuse_email"></td></tr>';
	$html_text .= '<tr id="C3" style="display:none"><td><b>registrar_abuse_phone</b></td><td>'.$item->registrar->registrar_abuse_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="C4" style="display:none"><td><b>registrar_street</b></td><td>'.$item->registrar->registrar_street.'</td><td></td></tr>';
	$html_text .= '<tr id="C5" style="display:none"><td><b>registrar_postal_code</b></td><td>'.$item->registrar->registrar_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="C6" style="display:none"><td><b>registrar_city</b></td><td>'.$item->registrar->registrar_city.'</td><td></td></tr>';
	$html_text .= '<tr id="C7" style="display:none"><td><b>registrar_phone</b></td><td>'.$item->registrar->registrar_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="C8" style="display:none"><td><b>registrar_email</b></td><td>'.$item->registrar->registrar_email.'</td><td></td></tr>';
	$html_text .= '<tr id="C9" style="display:none"><td><b>registrar_country_code</b></td><td>'.$item->registrar->registrar_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="C10" style="display:none"><td><b>registrar_country_name</b></td><td>'.$item->registrar->registrar_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="C11" style="display:none"><td><b>registrar_country_language</b></td><td>'.$item->registrar->registrar_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="C12" style="display:none"><td><b>registrar_whois_server</b></td><td>'.$item->registrar->registrar_whois_server.'</td><td></td></tr>';
	$html_text .= '<tr id="C13" style="display:none"><td><b>registrar_url</b></td><td>'.$item->registrar->registrar_url.'</td><td></td></tr>';
	$html_text .= '<tr id="C14" style="display:none"><td><b>registrar_iana_id</b></td><td>'.$item->registrar->registrar_iana_id.'</td><td></td></tr>';
	$html_text .= '<tr id="C15" style="display:none"><td><b>registrar_protected</b></td><td>'.$item->registrar->registrar_protected.'</td><td id="registrar_protected"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	if (!empty($item->reseller->reseller_company_name))	{
		if (strlen(trim($item->reseller->reseller_company_name)))	{
			$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(40)">reseller +/-</button></td><td></td><td></td></tr>';
			$html_text .= '<tr id="D1" style="display:none"><td><b>reseller_contact_id</b></td><td>'.$item->reseller->reseller_contact_id.'</td><td></td></tr>';
			$html_text .= '<tr><td><b>reseller_company_name</b></td><td>'.$item->reseller->reseller_company_name.'</td><td id="reseller_company_name"></td></tr>';
			$html_text .= '<tr><td><b>reseller_web_id</b></td><td>'.$item->reseller->reseller_web_id.'</td><td id="reseller_web_id"></td></tr>';
			$html_text .= '<tr id="D2" style="display:none"><td><b>reseller_personal_name</b></td><td>'.$item->reseller->reseller_personal_name.'</td><td></td></tr>';
			$html_text .= '<tr id="D3" style="display:none"><td><b>reseller_street</b></td><td>'.$item->reseller->reseller_street.'</td><td></td></tr>';
			$html_text .= '<tr id="D4" style="display:none"><td><b>reseller_postal_code</b></td><td>'.$item->reseller->reseller_postal_code.'</td><td></td></tr>';
			$html_text .= '<tr id="D5" style="display:none"><td><b>reseller_city</b></td><td>'.$item->reseller->reseller_city.'</td><td></td></tr>';
			$html_text .= '<tr id="D6" style="display:none"><td><b>reseller_phone</b></td><td>'.$item->reseller->reseller_phone.'</td><td></td></tr>';
			$html_text .= '<tr id="D7" style="display:none"><td><b>reseller_email</b></td><td>'.$item->reseller->reseller_email.'</td><td></td></tr>';
			$html_text .= '<tr id="D8" style="display:none"><td><b>reseller_country_code</b></td><td>'.$item->reseller->reseller_country_code.'</td><td></td></tr>';
			$html_text .= '<tr id="D9" style="display:none"><td><b>reseller_country_name</b></td><td>'.$item->reseller->reseller_country_name.'</td><td></td></tr>';
			$html_text .= '<tr id="D10" style="display:none"><td><b>reseller_country_language</b></td><td>'.$item->reseller->reseller_country_language.'</td><td></td></tr>';
			$html_text .= '<tr id="D11" style="display:none"><td><b>reseller_protected</b></td><td>'.$item->reseller->reseller_protected.'</td><td id="reseller_protected"></td></tr>';
			$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
		}	
	}
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(50)">registrant +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="E1" style="display:none"><td><b>registrant_contact_id</b></td><td>'.$item->registrant->registrant_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>registrant_company_name</b></td><td>'.$item->registrant->registrant_company_name.'</td><td id="registrant_company_name"></td></tr>';
	$html_text .= '<tr><td><b>registrant_web_id</b></td><td>'.$item->registrant->registrant_web_id.'</td><td id="registrant_web_id"></td></tr>';
	$html_text .= '<tr><td><b>registrant_personal_name</b></td><td>'.$item->registrant->registrant_personal_name.'</td><td id="registrant_personal_name"></td></tr>';	
	$html_text .= '<tr id="E2" style="display:none"><td><b>registrant_street</b></td><td>'.$item->registrant->registrant_street.'</td><td></td></tr>';
	$html_text .= '<tr id="E3" style="display:none"><td><b>registrant_postal_code</b></td><td>'.$item->registrant->registrant_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="E4" style="display:none"><td><b>registrant_city</b></td><td>'.$item->registrant->registrant_city.'</td><td></td></tr>';
	$html_text .= '<tr id="E5" style="display:none"><td><b>registrant_phone</b></td><td>'.$item->registrant->registrant_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="E6" style="display:none"><td><b>registrant_email</b></td><td>'.$item->registrant->registrant_email.'</td><td></td></tr>';
	$html_text .= '<tr id="E7" style="display:none"><td><b>registrant_country_code</b></td><td>'.$item->registrant->registrant_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="E8" style="display:none"><td><b>registrant_country_name</b></td><td>'.$item->registrant->registrant_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="E9" style="display:none"><td><b>registrant_country_language</b></td><td>'.$item->registrant->registrant_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="E10" style="display:none"><td><b>registrant_protected</b></td><td>'.$item->registrant->registrant_protected.'</td><td id="registrant_protected"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(60)">admin +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="F1" style="display:none"><td><b>admin_contact_id</b></td><td>'.$item->admin->admin_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr id="F2" style="display:none"><td><b>admin_company_name</b></td><td>'.$item->admin->admin_company_name.'</td><td></td></tr>';
	$html_text .= '<tr id="F3" style="display:none"><td><b>admin_web_id</b></td><td>'.$item->admin->admin_web_id.'</td><td id="admin_web_id"></td></tr>';
	$html_text .= '<tr id="F4" style="display:none"><td><b>admin_personal_name</b></td><td>'.$item->admin->admin_personal_name.'</td><td></td></tr>';
	$html_text .= '<tr id="F5" style="display:none"><td><b>admin_phone</b></td><td>'.$item->admin->admin_phone.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>admin_email</b></td><td>'.$item->admin->admin_email.'</td><td id="admin_email"></td></tr>';
	$html_text .= '<tr id="F6" style="display:none"><td><b>admin_protected</b></td><td>'.$item->admin->admin_protected.'</td><td id="admin_protected"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(70)">tech +/-</button></td><td></td><td></td></tr>';
	if (!empty($item->tech->contact_1->tech_email_1))	{
		if (strlen(trim($item->tech->contact_1->tech_email_1)))	{	
			$html_text .= '<tr id="G1" style="display:none"><td><b>tech_contact_id_1</b></td><td>'.$item->tech->contact_1->tech_contact_id_1.'</td><td></td></tr>';
			$html_text .= '<tr id="G2" style="display:none"><td><b>tech_company_name_1</b></td><td>'.$item->tech->contact_1->tech_company_name_1.'</td><td></td></tr>';
			$html_text .= '<tr id="G3" style="display:none"><td><b>tech_web_id_1</b></td><td>'.$item->tech->contact_1->tech_web_id_1.'</td><td id="tech_web_id_1"></td></tr>';
			$html_text .= '<tr id="G4" style="display:none"><td><b>tech_personal_name_1</b></td><td>'.$item->tech->contact_1->tech_personal_name_1.'</td><td></td></tr>';
			$html_text .= '<tr id="G5" style="display:none"><td><b>tech_phone_1</b></td><td>'.$item->tech->contact_1->tech_phone_1.'</td><td></td></tr>';
			$html_text .= '<tr><td><b>tech_email_1</b></td><td>'.$item->tech->contact_1->tech_email_1.'</td><td id="tech_email_1"></td></tr>';
			$html_text .= '<tr id="G6" style="display:none"><td><b>tech_protected_1</b></td><td>'.$item->tech->contact_1->tech_protected_1.'</td><td id="tech_protected_1"></td></tr>';
		}	
	}
	if (!empty($item->tech->contact_2->tech_email_2))	{
		if (strlen(trim($item->tech->contact_2->tech_email_2)))	{	
			$html_text .= '<tr id="G7" style="display:none"><td><b>tech_contact_id_2</b></td><td>'.$item->tech->contact_2->tech_contact_id_2.'</td><td></td></tr>';
			$html_text .= '<tr id="G8" style="display:none"><td><b>tech_company_name_2</b></td><td>'.$item->tech->contact_2->tech_company_name_2.'</td><td></td></tr>';
			$html_text .= '<tr id="G9" style="display:none"><td><b>tech_web_id_2</b></td><td>'.$item->tech->contact_2->tech_web_id_2.'</td><td></td></tr>';
			$html_text .= '<tr id="G10" style="display:none"><td><b>tech_personal_name_2</b></td><td>'.$item->tech->contact_2->tech_personal_name_2.'</td><td></td></tr>';
			$html_text .= '<tr id="G11" style="display:none"><td><b>tech_phone_2</b></td><td>'.$item->tech->contact_2->tech_phone_2.'</td><td></td></tr>';
			$html_text .= '<tr><td><b>tech_email_2</b></td><td>'.$item->tech->contact_2->tech_email_2.'</td><td></td></tr>';
			$html_text .= '<tr id="G12" style="display:none"><td><b>tech_protected_2</b></td><td>'.$item->tech->contact_2->tech_protected_2.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->tech->contact_3->tech_email_3))	{
		if (strlen(trim($item->tech->contact_3->tech_email_3)))	{	
			$html_text .= '<tr id="G13" style="display:none"><td><b>tech_contact_id_3</b></td><td>'.$item->tech->contact_3->tech_contact_id_3.'</td><td></td></tr>';
			$html_text .= '<tr id="G14" style="display:none"><td><b>tech_company_name_3</b></td><td>'.$item->tech->contact_3->tech_company_name_3.'</td><td></td></tr>';
			$html_text .= '<tr id="G15" style="display:none"><td><b>tech_web_id_3</b></td><td>'.$item->tech->contact_3->tech_web_id_3.'</td><td></td></tr>';
			$html_text .= '<tr id="G16" style="display:none"><td><b>tech_personal_name_3</b></td><td>'.$item->tech->contact_3->tech_personal_name_3.'</td><td></td></tr>';
			$html_text .= '<tr id="G17" style="display:none"><td><b>tech_phone_3</b></td><td>'.$item->tech->contact_3->tech_phone_3.'</td><td></td></tr>';
			$html_text .= '<tr><td><b>tech_email_3</b></td><td>'.$item->tech->contact_3->tech_email_3.'</td><td></td></tr>';
			$html_text .= '<tr id="G18" style="display:none"><td><b>tech_protected_3</b></td><td>'.$item->tech->contact_3->tech_protected_3.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->tech->contact_4->tech_email_4))	{
		if (strlen(trim($item->tech->contact_4->tech_email_4)))	{	
			$html_text .= '<tr id="G19" style="display:none"><td><b>tech_contact_id_4</b></td><td>'.$item->tech->contact_4->tech_contact_id_4.'</td><td></td></tr>';
			$html_text .= '<tr id="G20" style="display:none"><td><b>tech_company_name_4</b></td><td>'.$item->tech->contact_4->tech_company_name_4.'</td><td></td></tr>';
			$html_text .= '<tr id="G21" style="display:none"><td><b>tech_web_id_4</b></td><td>'.$item->tech->contact_4->tech_web_id_4.'</td><td></td></tr>';
			$html_text .= '<tr id="G22" style="display:none"><td><b>tech_personal_name_4</b></td><td>'.$item->tech->contact_4->tech_personal_name_4.'</td><td></td></tr>';
			$html_text .= '<tr id="G23" style="display:none"><td><b>tech_phone_4</b></td><td>'.$item->tech->contact_4->tech_phone_4.'</td><td></td></tr>';
			$html_text .= '<tr><td><b>tech_email_4</b></td><td>'.$item->tech->contact_4->tech_email_4.'</td><td></td></tr>';
			$html_text .= '<tr id="G24" style="display:none"><td><b>tech_protected_4</b></td><td>'.$item->tech->contact_4->tech_protected_4.'</td><td></td></tr>';
		}	
	}
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(80)">billing +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="H1" style="display:none"><td><b>billing_contact_id</b></td><td>'.$item->billing->billing_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr id="H2" style="display:none"><td><b>billing_company_name</b></td><td>'.$item->billing->billing_company_name.'</td><td id="billing_company_name"></td></tr>';
	$html_text .= '<tr id="H3" style="display:none"><td><b>billing_personal_name</b></td><td>'.$item->billing->billing_personal_name.'</td><td id="billing_personal_name"></td></tr>';	
	$html_text .= '<tr id="H4" style="display:none"><td><b>billing_street</b></td><td>'.$item->billing->billing_street.'</td><td></td></tr>';
	$html_text .= '<tr id="H5" style="display:none"><td><b>billing_postal_code</b></td><td>'.$item->billing->billing_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="H6" style="display:none"><td><b>billing_city</b></td><td>'.$item->billing->billing_city.'</td><td></td></tr>';
	$html_text .= '<tr id="H7" style="display:none"><td><b>billing_phone</b></td><td>'.$item->billing->billing_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="H8" style="display:none"><td><b>billing_email</b></td><td>'.$item->billing->billing_email.'</td><td></td></tr>';
	$html_text .= '<tr id="H9" style="display:none"><td><b>billing_country_code</b></td><td>'.$item->billing->billing_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="H10" style="display:none"><td><b>billing_country_name</b></td><td>'.$item->billing->billing_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="H11" style="display:none"><td><b>billing_country_language</b></td><td>'.$item->billing->billing_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="H12" style="display:none"><td><b>billing_protected</b></td><td>'.$item->billing->billing_protected.'</td><td id="billing_protected"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(90)">name servers +/-</button></td><td></td><td></td></tr>';
	if (!empty($item->name_servers->server_1->server_name_1))	{
		if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
			$html_text .= '<tr id="I1" style="display:none"><td><b>server_name_1</b></td><td>'.$item->name_servers->server_1->server_name_1.'</td><td></td></tr>';
			$html_text .= '<tr id="I2" style="display:none"><td><b>ipv4_1</b></td><td>'.$item->name_servers->server_1->ipv4_1.'</td><td></td></tr>';
			$html_text .= '<tr id="I3" style="display:none"><td><b>ipv6_1</b></td><td>'.$item->name_servers->server_1->ipv6_1.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_1->server_name_1))	{		
		if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
			$html_text .= '<tr id="I4" style="display:none"><td><b>server_name_2</b></td><td>'.$item->name_servers->server_2->server_name_2.'</td><td></td></tr>';
			$html_text .= '<tr id="I5" style="display:none"><td><b>ipv4_2</b></td><td>'.$item->name_servers->server_2->ipv4_2.'</td><td></td></tr>';
			$html_text .= '<tr id="I6" style="display:none"><td><b>ipv6_2</b></td><td>'.$item->name_servers->server_2->ipv6_2.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_3->server_name_3))	{
		if (strlen(trim($item->name_servers->server_3->server_name_3)))	{
			$html_text .= '<tr id="I7" style="display:none"><td><b>server_name_3</b></td><td>'.$item->name_servers->server_3->server_name_3.'</td><td></td></tr>';
			$html_text .= '<tr id="I8" style="display:none"><td><b>ipv4_3</b></td><td>'.$item->name_servers->server_3->ipv4_3.'</td><td></td></tr>';
			$html_text .= '<tr id="I9" style="display:none"><td><b>ipv6_3</b></td><td>'.$item->name_servers->server_3->ipv6_3.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_4->server_name_4))	{	
		if (strlen(trim($item->name_servers->server_4->server_name_4)))	{
			$html_text .= '<tr id="I10" style="display:none"><td><b>server_name_4</b></td><td>'.$item->name_servers->server_4->server_name_4.'</td><td></td></tr>';
			$html_text .= '<tr id="I11" style="display:none"><td><b>ipv4_4</b></td><td>'.$item->name_servers->server_4->ipv4_4.'</td><td></td></tr>';
			$html_text .= '<tr id="I12" style="display:none"><td><b>ipv6_4</b></td><td>'.$item->name_servers->server_4->ipv6_4.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_5->server_name_5))	{		
		if (strlen(trim($item->name_servers->server_5->server_name_5)))	{
			$html_text .= '<tr id="I13" style="display:none"><td><b>server_name_5</b></td><td>'.$item->name_servers->server_5->server_name_5.'</td><td></td></tr>';
			$html_text .= '<tr id="I14" style="display:none"><td><b>ipv4_5</b></td><td>'.$item->name_servers->server_5->ipv4_5.'</td><td></td></tr>';
			$html_text .= '<tr id="I15" style="display:none"><td><b>ipv6_5</b></td><td>'.$item->name_servers->server_5->ipv6_5.'</td><td></td></tr>';
		}	
	}
	if (!empty($item->name_servers->server_6->server_name_6))	{
		if (strlen(trim($item->name_servers->server_6->server_name_6)))	{
			$html_text .= '<tr id="I16" style="display:none"><td><b>server_name_6</b></td><td>'.$item->name_servers->server_6->server_name_6.'</td><td></td></tr>';
			$html_text .= '<tr id="I17" style="display:none"><td><b>ipv4_6</b></td><td>'.$item->name_servers->server_6->ipv4_6.'</td><td></td></tr>';
			$html_text .= '<tr id="I18" style="display:none"><td><b>ipv6_6</b></td><td>'.$item->name_servers->server_6->ipv6_6.'</td><td></td></tr>';
		}	
	}
	$html_text .= '<tr><td><b>name_servers_dnssec</b></td><td>'.$item->name_servers->name_servers_dnssec.'</td><td id="name_servers_dnssec"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(100)">registry +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>registry_description</b></td><td>'.$item->data_management->registry_description.'</td><td></td></tr>';
	$html_text .= '<tr id="J1" style="display:none"><td><b>registry_language</b></td><td>'.$item->data_management->registry_language.'</td><td></td></tr>';
	$html_text .= '<tr id="J2" style="display:none"><td><b>registry_format</b></td><td>'.$item->data_management->registry_format.'</td><td></td></tr>';
	break;
}	
foreach ($xml2->xpath('//domain') as $item)	{
simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer;cursor:hand" onclick="SwitchDisplay(110)">whois restrictions +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="K1" style="display:none"><td><b>restrictions_legally</b></td><td>'.$item->restrictions_legally.'</td><td></td></tr>';
	$html_text .= '<tr id="K2" style="display:none"><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr id="K3" style="display:none"><td><b>restrictions_translated</b></td><td>'.$item->restrictions_translated.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	break;
}
$html_text .= '</table></div></body></html>';
echo $html_text;session_start();  // is needed with no PHP Generator Scriptcase

?>