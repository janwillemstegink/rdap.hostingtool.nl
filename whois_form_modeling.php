<?php
session_start();  // is n50ded with no PHP Generator Scriptcase
$inputlanguage = 0;
echo '<!DOCTYPE html><html lang="en" style="font-size: 90%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>WHOIS modeling</title>';
?><script>
function SwitchDisplay(type) {
	if (type == 20)	{ // domain
		var pre = '20';
		var max = 6
	}
	else if (type == 30)	{ // registrar
		var pre = '30';
		var max = 14
	}
	else if (type == 40)	{ // reseller
		var pre = '40';
		var max = 11
	}
	else if (type == 50)	{ // registrant
		var pre = '50';
		var max = 10
	}
	else if (type == 60)	{ // admin
		var pre = '60';
		var max = 12
	}
	else if (type == 70)	{ // tech
		var pre = '70';
		var max = 12
	}
	else if (type == 80)	{ // billing
		var pre = '80';
		var max = 12
	}
	else if (type == 90)	{ // name servers
		var pre = '90';
		var max = 18
	}
	else if (type == 100)	{ // registry
		var pre = '100';
		var max = 4
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
	if (inputlanguage == 0)	{
		var newdomainfield = '';
		var newcontactfield = '';
		var purpose = '';
		document.getElementById("title").innerText = "WHOIS";
		document.getElementById("data").innerText = "webhostingtech.nl";
		document.getElementById("view_type").innerText = "";		
		document.getElementById("domain_status").innerText = "";
		document.getElementById("domain_web_publish").innerText = newdomainfield + "";	
		document.getElementById("domain_transaction").innerText = newdomainfield + "";
		document.getElementById("registrar_web_id").innerText = newcontactfield;
		document.getElementById("registrar_abuse_email").innerText = "";
		document.getElementById("registrar_protected").innerText = newcontactfield;
		document.getElementById("reseller_trade_name").innerText = "";
		document.getElementById("reseller_web_id").innerText = newcontactfield;
		document.getElementById("reseller_protected").innerText = newcontactfield;
		document.getElementById("registrant_trade_name").innerText = purpose + "";	
		document.getElementById("registrant_web_id").innerText = newdomainfield + "";	
		document.getElementById("registrant_personal_name").innerText = "";
		document.getElementById("registrant_protected").innerText = newcontactfield;
		document.getElementById("admin_web_id").innerText = newcontactfield;
		document.getElementById("admin_email").innerText = purpose + "";
		document.getElementById("admin_protected").innerText = newdomainfield;
		document.getElementById("tech_web_id").innerText = newcontactfield;
		document.getElementById("tech_email").innerText = purpose + "";
		document.getElementById("tech_protected").innerText = newcontactfield;
		document.getElementById("billing_protected").innerText = newcontactfield;
		document.getElementById("name_servers_dnssec").innerText = purpose + "";	
	}
	else if (inputlanguage == 1)	{
		var newdomainfield = 'NIEUW';
		var newcontactfield = '(nieuw veld in de tabel met contacten)';
		var purpose = 'DOEL';
		document.getElementById("title").innerText = "WHOIS-modellering";
		document.getElementById("data").innerText = "webhostingtech.nl";
		document.getElementById("view_type").innerText = "Typen: alles, isp (Internet Service Provider), publiek";
		document.getElementById("domain_status").innerText = "Statussen: vrij, onttrokken, uitgesloten, in aanvraag, actief, inactief, in quarantaine.";
		document.getElementById("domain_web_publish").innerText = newdomainfield + ": Als 'web_publish' is ingesteld op 'ja', dan komt publiceren van een zoekresultaat overeen.";
		document.getElementById("domain_transaction").innerText = newdomainfield + ": Deze datum plus tijd is voor zoekmachines om te controleren op jaarlijkse verlenging.";
		document.getElementById("registrar_web_id").innerText = newcontactfield;
		document.getElementById("registrar_abuse_email").innerText = "Contactgegevens om misbruik te melden zijn niet verplicht voor een registrar.";
		document.getElementById("registrar_protected").innerText = newcontactfield;
		document.getElementById("reseller_trade_name").innerText = "De verwerkersovereenkomst kan tussen de reseller en de houder zijn.";
		document.getElementById("reseller_web_id").innerText = newcontactfield;
		document.getElementById("reseller_protected").innerText = newcontactfield;
		document.getElementById("registrant_trade_name").innerText = purpose + ": Legitiem houderschap bestaat met een bestaande, beoogde en zichtbare handelsnaam.";
		document.getElementById("registrant_web_id").innerText = newdomainfield + ": De KVK kan de benodigde 'web_id'-identificatie aan het Handelsregister toevoegen.";
		document.getElementById("registrant_personal_name").innerText = "De naam van een natuurlijk persoon als houder kan op verzoek zichtbaar zijn.";
		document.getElementById("registrant_protected").innerText = newcontactfield;
		document.getElementById("admin_web_id").innerText = newcontactfield;
		document.getElementById("admin_email").innerText = purpose + ": Het administratief aanspreekpunt beantwoordt een verzoek, en stuurt het indien nodig door.";
		document.getElementById("admin_protected").innerText = newcontactfield;
		document.getElementById("tech_web_id").innerText = newcontactfield;
		document.getElementById("tech_email").innerText = purpose + ": Een technisch contact reageert om een gemelde storing op te lossen.";
		document.getElementById("tech_protected").innerText = newcontactfield;
		document.getElementById("billing_protected").innerText = newcontactfield;
		document.getElementById("name_servers_dnssec").innerText = purpose + ": DNSSEC is een web-route-beveiligingsvoorziening op het DNS (Domain Name System).";				
	}
	else if (inputlanguage == 2)	{
		var newdomainfield = 'NEW';
		var newcontactfield = '(new field in the table of contacts)';
		var purpose = 'PURPOSE';
		document.getElementById("title").innerText = "WHOIS modeling";
		document.getElementById("data").innerText = "webhostingtech.nl";
		document.getElementById("view_type").innerText = "Types: all, isp (Internet Service Provider), public";		
		document.getElementById("domain_status").innerText = "Statusses: free, withdrawn, excluded, requested, active, inactive, in quarantaine.";
		document.getElementById("domain_web_publish").innerText = newdomainfield + ": If 'web_publish' is set to 'yes', then publishing a search result will match.";	
		document.getElementById("domain_transaction").innerText = newdomainfield + ": This date plus time is for search engines to check for annual renewal.";
		document.getElementById("registrar_web_id").innerText = newcontactfield;
		document.getElementById("registrar_abuse_email").innerText = "Contact details to report abuse are not mandatory for a registrar.";
		document.getElementById("registrar_protected").innerText = newcontactfield;
		document.getElementById("reseller_trade_name").innerText = "The processing agreement may be between the reseller and the holder.";
		document.getElementById("reseller_web_id").innerText = newcontactfield;
		document.getElementById("reseller_protected").innerText = newcontactfield;
		document.getElementById("registrant_trade_name").innerText = purpose + ": Legitimate holdership exists with an existing, intended and visible trade name.";	
		document.getElementById("registrant_web_id").innerText = newdomainfield + ": The Chamber of Commerce can add the required 'web_id' identification to the Trade Register.";	
		document.getElementById("registrant_personal_name").innerText = "The name of a natural person as holder can be visible on request.";
		document.getElementById("registrant_protected").innerText = newcontactfield;
		document.getElementById("admin_web_id").innerText = newcontactfield;
		document.getElementById("admin_email").innerText = purpose + ": The administratively responsible desk answers a request, and forwards it if necessary.";
		document.getElementById("admin_protected").innerText = newdomainfield;
		document.getElementById("tech_web_id").innerText = newcontactfield;
		document.getElementById("tech_email").innerText = purpose + ": A technical contact responds to resolve a reported malfunction.";
		document.getElementById("tech_protected").innerText = newcontactfield;
		document.getElementById("billing_protected").innerText = newcontactfield;
		document.getElementById("name_servers_dnssec").innerText = purpose + ": DNSSEC is a web route security feature on the DNS (Domain Name System).";	
	}
	else if (inputlanguage == 3)	{
		var newdomainfield = 'NEU';
		var newcontactfield = '(neues Feld in der Kontakttabelle)';
		var purpose = 'ZWECK';
		document.getElementById("title").innerText = "WHOIS-Modellierung";
		document.getElementById("data").innerText = "webhostingtech.nl";
		document.getElementById("view_type").innerText = "Typen: alle, isp (Internet Service Provider), öffentlich";
		document.getElementById("domain_status").innerText = "Status: frei, zurückgezogen, ausgeschlossen, beantragt, aktiv, inaktiv, in Quarantäne.";
		document.getElementById("domain_web_publish").innerText = newdomainfield + ": Wenn „web_publish“ auf „yes“ gesetzt ist, wird die Veröffentlichung eines Suchergebnisses übereinstimmen.";
		document.getElementById("domain_transaction").innerText = newdomainfield + ": Dieses Datum und die Uhrzeit dienen Suchmaschinen zur Prüfung auf jährliche Erneuerung.";
		document.getElementById("registrar_abuse_email").innerText = "Kontaktdaten zum Melden von Missbrauch sind für einen Registrar nicht zwingend erforderlich.";
		document.getElementById("registrar_web_id").innerText = newcontactfield;
		document.getElementById("registrar_protected").innerText = newcontactfield;
		document.getElementById("reseller_trade_name").innerText = "Die Verarbeitungsvereinbarung kann zwischen dem Wiederverkäufer und dem Halter abgeschlossen werden.";
		document.getElementById("reseller_web_id").innerText = newcontactfield;
		document.getElementById("reseller_protected").innerText = newcontactfield;
		document.getElementById("registrant_trade_name").innerText = purpose + ": Eine rechtmäßige Inhaberschaft besteht mit einem bestehenden, beabsichtigten und sichtbaren Handelsnamen.";
		document.getElementById("registrant_web_id").innerText = newdomainfield + ": Die Handelskammer kann die erforderliche Kennung „web_id“ zum Handelsregister hinzufügen.";
		document.getElementById("registrant_personal_name").innerText = "Der Name einer natürlichen Person als Inhaber kann auf Anfrage einsehbar sein.";
		document.getElementById("registrant_protected").innerText = newcontactfield;
		document.getElementById("admin_web_id").innerText = newcontactfield;
		document.getElementById("admin_email").innerText = purpose + ": Die administrativ zuständige Stelle beantwortet eine Anfrage und leitet diese gegebenenfalls weiter.";
		document.getElementById("admin_protected").innerText = newcontactfield;
		document.getElementById("tech_web_id").innerText = newcontactfield;
		document.getElementById("tech_email").innerText = purpose + ": Ein technischer Kontakt reagiert, um eine gemeldete Störung zu beheben.";
		document.getElementById("tech_protected").innerText = newcontactfield;
		document.getElementById("billing_protected").innerText = newcontactfield;
		document.getElementById("name_servers_dnssec").innerText = purpose + ": DNSSEC ist eine Sicherheitsfunktion für Webrouten im DNS (Domain Name System).";
	}
	else if (inputlanguage == 4)	{
		var newdomainfield = 'NOUVEAU';
		var newcontactfield = '(nouveau champ dans le table des contacts)';
		var purpose = 'BUT';
		document.getElementById("title").innerText = "Modélisation WHOIS";
		document.getElementById("data").innerText = "webhostingtech.nl";
		document.getElementById("view_type").innerText = "Types : toutes, FSI (fournisseur de service Internet), public";
		document.getElementById("domain_status").innerText = "Statuts : libre, retiré, exclu, demandé, actif, inactif, en quarantaine.";
		document.getElementById("domain_web_publish").innerText = newdomainfield + " : Si 'web_publish' est défini sur 'yes', la publication d'un résultat de recherche correspondra.";
		document.getElementById("domain_transaction").innerText = newdomainfield + " : Cette date et cette heure permettent aux moteurs de recherche de vérifier le renouvellement annuel.";
		document.getElementById("registrar_web_id").innerText = newcontactfield;
		document.getElementById("registrar_abuse_email").innerText = "Les coordonnées pour signaler un abus ne sont pas obligatoires pour un bureau d'enregistrement.";
		document.getElementById("registrar_protected").innerText = newcontactfield;
		document.getElementById("reseller_trade_name").innerText = "L'accord de traitement peut être conclu entre le revendeur et le titulaire.";
		document.getElementById("reseller_web_id").innerText = newcontactfield;
		document.getElementById("reseller_protected").innerText = newcontactfield;
		document.getElementById("registrant_trade_name").innerText = purpose + " : Un détenteur légitime existe avec un nom commercial existant, prévu et visible.";
		document.getElementById("registrant_web_id").innerText = newdomainfield + " : La Chambre de Commerce peut ajouter l'identification 'web_id' requise au registre du commerce.";
		document.getElementById("registrant_personal_name").innerText = "Le nom d'une personne physique titulaire peut être visible sur demande.";
		document.getElementById("registrant_protected").innerText = newcontactfield;
		document.getElementById("admin_web_id").innerText = newcontactfield;
		document.getElementById("admin_email").innerText = purpose + " : Le bureau administrativement responsable répond à une demande, et la transmet si nécessaire.";
		document.getElementById("admin_protected").innerText = newdomainfield;
		document.getElementById("tech_web_id").innerText = newcontactfield;
		document.getElementById("tech_email").innerText = purpose + " : Un contact technique répond pour résoudre un dysfonctionnement signalé.";
		document.getElementById("tech_protected").innerText = newcontactfield;
		document.getElementById("billing_protected").innerText = newcontactfield;
		document.getElementById("name_servers_dnssec").innerText = purpose + " : DNSSEC est une fonctionnalité de sécurité de route Web sur le DNS (Domain Name System).";
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
$registryfile = 'whois_registry_data.xml';
$inputdomain = 'webhostingtech.nl';
$url1a = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=$inputdomain&format=xml&type=1";
$url1b = "http://whois.hostingtool.nl/".$domainfile;
$url2a = "http://whois.hostingtool.nl/whois_compose_data/index.php?domain=$inputdomain&format=xml&type=2";
$url2b = "http://whois.hostingtool.nl/".$registryfile;

if (file_exists($developmentpath.$domainfile) and false)	{ // for development
	$xml1 = simplexml_load_file($developmentpath.$domainfile) or die("Cannot load xml1 from path,");
}
elseif (file_exists($domainfile))	{ // for working with just the GitHub files
	$xml1 = simplexml_load_file($domainfile) or die("Cannot load xml1 from same folder.");
}
elseif (@get_headers($url1a) and false)	{ // the application to compose is modeled only for registry data.
	$xml1 = simplexml_load_file($url1a, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url1a from non-public folder.");
}
else	{
	$xml1 = simplexml_load_file($url1b, "SimpleXMLElement", LIBXML_NOCDATA) or die("Cannot load url1b from public_html folder.");
}

if (file_exists($developmentpath.$registryfile) and false)	{ // for development
	$xml2 = simplexml_load_file($developmentpath.$registryfile) or die("Cannot load xml2 from path.");
}
elseif (file_exists($registryfile))	{ // for working with just the GitHub files
	$xml2 = simplexml_load_file($registryfile) or die("Cannot load xml2 from same folder.");
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
$html_text .= '<tr><td id="title" style="font-size: 1.5rem;font-weight:bold"></td><td id="data" style="font-size:1.2rem;font-weight:bold"></td>
<td style="font-size: .9rem"><a href="https://www.sidn.nl/en/whois?q=webhostingtech.nl" target="_blank">sidn.nl/en/whois?q=webhostingtech.nl/whois</a>
- <a href="https://github.com/janwillemstegink/xml-whois" target="_blank">github.com/janwillemstegink/xml-whois</a>
- <a href="">future detailed work instructions</a></td></tr>';
foreach ($xml1->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';	
	$html_text .= '<tr><td></td><td></td><td>
	<button style="cursor:pointer" onclick="SwitchTranslation(0)">0</button> - 
	<button style="cursor:pointer" onclick="SwitchTranslation(1)">Uitleg in het nederlands</button> - 
	<button style="cursor:pointer" onclick="SwitchTranslation(2)">Explanation in English</button> - 
	<button style="cursor:pointer" onclick="SwitchTranslation(3)">Erläuterung auf Deutsch</button> - 
	<button style="cursor:pointer" onclick="SwitchTranslation(4)">Explication en français</button></td></tr>';
	$html_text .= '<tr><td><b>view_datetime</b></td><td>'.$item->view->view_datetime.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>view_type</b></td><td>'.$item->view->view_type.'</td><td id="view_type" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(20)">domain +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="201" style="display:none"><td><b>domain_id</b></td><td>'.$item->domain_id.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>domain_name</b></td><td>'.$item->domain_name.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>domain_status</b></td><td>'.$item->domain_status.'</td><td id="domain_status" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="202" style="display:none"><td><b>domain_status_codes</b></td><td>'.$item->domain_status_codes.'</td><td style="font-style:italic"><a href="https://www.icann.org/en/system/files/files/epp-status-codes-30jun11-en.pdf" target="_blank">www.icann.org/en/system/files/files/epp-status-codes-30jun11-en.pdf</a></td></tr>';
	$html_text .= '<tr><td><b>domain_web_publish</b></td><td>'.$item->domain_web_publish.'</td><td id="domain_web_publish" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="203" style="display:none"><td><b>domain_created</b></td><td>'.$item->domain_created.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>domain_transaction</b></td><td>'.$item->domain_transaction.'</td><td id="domain_transaction" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="204" style="display:none"><td><b>domain_updated</b></td><td>'.$item->domain_updated.'</td><td></td></tr>';
	$html_text .= '<tr id="205" style="display:none"><td><b>domain_expiration</b></td><td>'.$item->domain_expiration.'</td><td></td></tr>';
	$html_text .= '<tr id="206" style="display:none"><td><b>domain_out_of_quarantine</b></td><td>'.$item->domain_out_of_quarantine.'</td><td></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(30)">registrar +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="301" style="display:none"><td><b>registrar_contact_id</b></td><td>'.$item->registrar->registrar_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>registrar_trade_name</b></td><td>'.$item->registrar->registrar_trade_name.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>registrar_web_id</b></td><td>'.$item->registrar->registrar_web_id.'</td><td id="registrar_web_id" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="302" style="display:none"><td><b>registrar_personal_name</b></td><td>'.$item->registrar->registrar_personal_name.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>registrar_abuse_email</b></td><td>'.$item->registrar->registrar_abuse_email.'</td><td id="registrar_abuse_email" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="303" style="display:none"><td><b>registrar_abuse_phone</b></td><td>'.$item->registrar->registrar_abuse_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="304" style="display:none"><td><b>registrar_street</b></td><td>'.$item->registrar->registrar_street.'</td><td></td></tr>';
	$html_text .= '<tr id="305" style="display:none"><td><b>registrar_postal_code</b></td><td>'.$item->registrar->registrar_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="306" style="display:none"><td><b>registrar_city</b></td><td>'.$item->registrar->registrar_city.'</td><td></td></tr>';
	$html_text .= '<tr id="307" style="display:none"><td><b>registrar_phone</b></td><td>'.$item->registrar->registrar_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="308" style="display:none"><td><b>registrar_email</b></td><td>'.$item->registrar->registrar_email.'</td><td></td></tr>';
	$html_text .= '<tr id="309" style="display:none"><td><b>registrar_country_code</b></td><td>'.$item->registrar->registrar_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="3010" style="display:none"><td><b>registrar_country_name</b></td><td>'.$item->registrar->registrar_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="3011" style="display:none"><td><b>registrar_country_language</b></td><td>'.$item->registrar->registrar_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="3012" style="display:none"><td><b>registrar_url</b></td><td>'.$item->registrar->registrar_url.'</td><td></td></tr>';
	$html_text .= '<tr id="3013" style="display:none"><td><b>registrar_iana_id</b></td><td>'.$item->registrar->registrar_iana_id.'</td><td></td></tr>';
	$html_text .= '<tr id="3014" style="display:none"><td><b>registrar_protected</b></td><td>'.$item->registrar->registrar_protected.'</td><td id="registrar_protected" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	if (!empty($item->reseller->reseller_trade_name))	{
		if (strlen(trim($item->reseller->reseller_trade_name)))	{
			$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(40)">reseller +/-</button></td><td></td><td></td></tr>';
			$html_text .= '<tr id="401" style="display:none"><td><b>reseller_contact_id</b></td><td>'.$item->reseller->reseller_contact_id.'</td><td></td></tr>';
			$html_text .= '<tr><td><b>reseller_trade_name</b></td><td>'.$item->reseller->reseller_trade_name.'</td><td id="reseller_trade_name" style="font-style:italic"></td></tr>';
			$html_text .= '<tr><td><b>reseller_web_id</b></td><td>'.$item->reseller->reseller_web_id.'</td><td id="reseller_web_id" style="font-style:italic"></td></tr>';
			$html_text .= '<tr id="402" style="display:none"><td><b>reseller_personal_name</b></td><td>'.$item->reseller->reseller_personal_name.'</td><td></td></tr>';
			$html_text .= '<tr id="403" style="display:none"><td><b>reseller_street</b></td><td>'.$item->reseller->reseller_street.'</td><td></td></tr>';
			$html_text .= '<tr id="404" style="display:none"><td><b>reseller_postal_code</b></td><td>'.$item->reseller->reseller_postal_code.'</td><td></td></tr>';
			$html_text .= '<tr id="405" style="display:none"><td><b>reseller_city</b></td><td>'.$item->reseller->reseller_city.'</td><td></td></tr>';
			$html_text .= '<tr id="406" style="display:none"><td><b>reseller_phone</b></td><td>'.$item->reseller->reseller_phone.'</td><td></td></tr>';
			$html_text .= '<tr id="407" style="display:none"><td><b>reseller_email</b></td><td>'.$item->reseller->reseller_email.'</td><td></td></tr>';
			$html_text .= '<tr id="408" style="display:none"><td><b>reseller_country_code</b></td><td>'.$item->reseller->reseller_country_code.'</td><td></td></tr>';
			$html_text .= '<tr id="409" style="display:none"><td><b>reseller_country_name</b></td><td>'.$item->reseller->reseller_country_name.'</td><td></td></tr>';
			$html_text .= '<tr id="4010" style="display:none"><td><b>reseller_country_language</b></td><td>'.$item->reseller->reseller_country_language.'</td><td></td></tr>';
			$html_text .= '<tr id="4011" style="display:none"><td><b>reseller_protected</b></td><td>'.$item->reseller->reseller_protected.'</td><td id="reseller_protected" style="font-style:italic"></td></tr>';
			$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
		}	
	}
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(50)">registrant +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="501" style="display:none"><td><b>registrant_contact_id</b></td><td>'.$item->registrant->registrant_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>registrant_trade_name</b></td><td>'.$item->registrant->registrant_trade_name.'</td><td id="registrant_trade_name" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><b>registrant_web_id</b></td><td>'.$item->registrant->registrant_web_id.'</td><td id="registrant_web_id" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><b>registrant_personal_name</b></td><td>'.$item->registrant->registrant_personal_name.'</td><td id="registrant_personal_name" style="font-style:italic"></td></tr>';	
	$html_text .= '<tr id="502" style="display:none"><td><b>registrant_street</b></td><td>'.$item->registrant->registrant_street.'</td><td></td></tr>';
	$html_text .= '<tr id="503" style="display:none"><td><b>registrant_postal_code</b></td><td>'.$item->registrant->registrant_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="504" style="display:none"><td><b>registrant_city</b></td><td>'.$item->registrant->registrant_city.'</td><td></td></tr>';
	$html_text .= '<tr id="505" style="display:none"><td><b>registrant_phone</b></td><td>'.$item->registrant->registrant_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="506" style="display:none"><td><b>registrant_email</b></td><td>'.$item->registrant->registrant_email.'</td><td></td></tr>';
	$html_text .= '<tr id="507" style="display:none"><td><b>registrant_country_code</b></td><td>'.$item->registrant->registrant_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="508" style="display:none"><td><b>registrant_country_name</b></td><td>'.$item->registrant->registrant_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="509" style="display:none"><td><b>registrant_country_language</b></td><td>'.$item->registrant->registrant_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="5010" style="display:none"><td><b>registrant_protected</b></td><td>'.$item->registrant->registrant_protected.'</td><td id="registrant_protected" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(60)">admin +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="601" style="display:none"><td><b>admin_contact_id</b></td><td>'.$item->admin->admin_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr id="602" style="display:none"><td><b>admin_trade_name</b></td><td>'.$item->admin->admin_trade_name.'</td><td></td></tr>';
	$html_text .= '<tr id="603" style="display:none"><td><b>admin_web_id</b></td><td>'.$item->admin->admin_web_id.'</td><td id="admin_web_id" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="604" style="display:none"><td><b>admin_personal_name</b></td><td>'.$item->admin->admin_personal_name.'</td><td></td></tr>';
	$html_text .= '<tr id="605" style="display:none"><td><b>admin_street</b></td><td>'.$item->admin->admin_street.'</td><td></td></tr>';
	$html_text .= '<tr id="606" style="display:none"><td><b>admin_postal_code</b></td><td>'.$item->admin->admin_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="607" style="display:none"><td><b>admin_city</b></td><td>'.$item->admin->admin_city.'</td><td></td></tr>';
	$html_text .= '<tr id="608" style="display:none"><td><b>admin_phone</b></td><td>'.$item->admin->admin_phone.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>admin_email</b></td><td>'.$item->admin->admin_email.'</td><td id="admin_email" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="609" style="display:none"><td><b>admin_country_code</b></td><td>'.$item->admin->admin_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="6010" style="display:none"><td><b>admin_country_name</b></td><td>'.$item->admin->admin_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="6011" style="display:none"><td><b>admin_country_language</b></td><td>'.$item->admin->admin_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="6012" style="display:none"><td><b>admin_protected</b></td><td>'.$item->admin->admin_protected.'</td><td id="admin_protected" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(70)">tech +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="701" style="display:none"><td><b>tech_contact_id</b></td><td>'.$item->tech->tech_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr id="702" style="display:none"><td><b>tech_trade_name</b></td><td>'.$item->tech->tech_trade_name.'</td><td></td></tr>';
	$html_text .= '<tr id="703" style="display:none"><td><b>tech_web_id</b></td><td>'.$item->tech->tech_web_id.'</td><td id="tech_web_id" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="704" style="display:none"><td><b>tech_personal_name</b></td><td>'.$item->tech->tech_personal_name.'</td><td></td></tr>';
	$html_text .= '<tr id="705" style="display:none"><td><b>tech_street</b></td><td>'.$item->tech->tech_street.'</td><td></td></tr>';
	$html_text .= '<tr id="706" style="display:none"><td><b>tech_postal_code</b></td><td>'.$item->tech->tech_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="707" style="display:none"><td><b>tech_city</b></td><td>'.$item->tech->tech_city.'</td><td></td></tr>';
	$html_text .= '<tr id="708" style="display:none"><td><b>tech_phone</b></td><td>'.$item->tech->tech_phone.'</td><td></td></tr>';
	$html_text .= '<tr><td><b>tech_email</b></td><td>'.$item->tech->tech_email.'</td><td id="tech_email" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="709" style="display:none"><td><b>tech_country_code</b></td><td>'.$item->tech->tech_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="7010" style="display:none"><td><b>tech_country_name</b></td><td>'.$item->tech->tech_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="7011" style="display:none"><td><b>tech_country_language</b></td><td>'.$item->tech->tech_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="7012" style="display:none"><td><b>tech_protected</b></td><td>'.$item->tech->tech_protected.'</td><td id="tech_protected" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(80)">billing +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr id="801" style="display:none"><td><b>billing_contact_id</b></td><td>'.$item->billing->billing_contact_id.'</td><td></td></tr>';
	$html_text .= '<tr id="802" style="display:none"><td><b>billing_trade_name</b></td><td>'.$item->billing->billing_trade_name.'</td><td id="billing_trade_name" style="font-style:italic"></td></tr>';
	$html_text .= '<tr id="803" style="display:none"><td><b>billing_personal_name</b></td><td>'.$item->billing->billing_personal_name.'</td><td id="billing_personal_name" style="font-style:italic"></td></tr>';	
	$html_text .= '<tr id="804" style="display:none"><td><b>billing_street</b></td><td>'.$item->billing->billing_street.'</td><td></td></tr>';
	$html_text .= '<tr id="805" style="display:none"><td><b>billing_postal_code</b></td><td>'.$item->billing->billing_postal_code.'</td><td></td></tr>';
	$html_text .= '<tr id="806" style="display:none"><td><b>billing_city</b></td><td>'.$item->billing->billing_city.'</td><td></td></tr>';
	$html_text .= '<tr id="807" style="display:none"><td><b>billing_phone</b></td><td>'.$item->billing->billing_phone.'</td><td></td></tr>';
	$html_text .= '<tr id="808" style="display:none"><td><b>billing_email</b></td><td>'.$item->billing->billing_email.'</td><td></td></tr>';
	$html_text .= '<tr id="809" style="display:none"><td><b>billing_country_code</b></td><td>'.$item->billing->billing_country_code.'</td><td></td></tr>';
	$html_text .= '<tr id="8010" style="display:none"><td><b>billing_country_name</b></td><td>'.$item->billing->billing_country_name.'</td><td></td></tr>';
	$html_text .= '<tr id="8011" style="display:none"><td><b>billing_country_language</b></td><td>'.$item->billing->billing_country_language.'</td><td></td></tr>';
	$html_text .= '<tr id="8012" style="display:none"><td><b>billing_protected</b></td><td>'.$item->billing->billing_protected.'</td><td id="billing_protected" style="font-style:italic"></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(90)">name servers +/-</button></td><td></td><td></td></tr>';
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
foreach ($xml2->xpath('//registry') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td><button style="cursor:pointer" onclick="SwitchDisplay(100)">registry +/-</button></td><td></td><td></td></tr>';
	$html_text .= '<tr><td><b>registry_whois_server</b></td><td>'.$item->registry_whois_server.'</td><td></td></tr>';
	$html_text .= '<tr id="1001" style="display:none"><td><b>registry_description</b></td><td>'.$item->registry_description.'</td><td></td></tr>';
	$html_text .= '<tr id="1002" style="display:none"><td><b>registry_time_zone</b></td><td>'.$item->registry_time_zone.'</td><td></td></tr>';
	$html_text .= '<tr id="1003" style="display:none"><td><b>registry_language</b></td><td>'.$item->registry_language.'</td><td></td></tr>';
	$html_text .= '<tr id="1004" style="display:none"><td><b>registry_format</b></td><td>'.$item->registry_format.'</td><td></td></tr>';
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