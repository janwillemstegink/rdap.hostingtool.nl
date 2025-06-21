<?php
session_start();  // is needed with no PHP Generator Scriptcase
if (empty($inputlanguage))	{
	$browserlanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	switch ($browserlanguage) {
		case 'nl':
			$inputlanguage = 1;
			break;
		case 'de':
			$inputlanguage = 3;
			break;
		case 'fr':
			$inputlanguage = 4;
			break;
		default:
			$inputlanguage = 2;
	}		
}
echo '<!DOCTYPE html><html lang="en" style="font-size: 100%"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="UTF-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="robots" content="index" />
<title>TLD Menu Modeling</title>';
?><script>
	
function SwitchTranslation(inputlanguage)	{
	if (inputlanguage == 1)	{
		document.getElementById("title").textContent = "TLD-menumodellering";
		document.getElementById("find").textContent = "Vind een nieuwe domeinnaam";
		document.getElementById("view").textContent = "Gegevens van een domein bekijken";
		document.getElementById("terms").textContent = "Voorwaarden";
		document.getElementById("additional_terms").textContent = "Aanvullende voorwaarden";
		document.getElementById("procedures").textContent = "Procedures";
		document.getElementById("statutory_law").textContent = "Wettelijk recht";
		document.getElementById("judicial_law").textContent = "Rechtersrecht";
		document.getElementById("common_law").textContent = "Gewoonterecht";
		document.getElementById("pricing").textContent = "Prijsinformatie";
		document.getElementById("rdap").textContent = "Whois- en RDAP-informatie";	
		document.getElementById("issues").textContent = "Actuele kwesties";
		document.getElementById("figurs").textContent = "Cijfers";
		document.getElementById("authorities").textContent = "Gerelateerde instanties";
		document.getElementById("knowledge").textContent = "Kennis hyperlinks";
		document.getElementById("tools").textContent = "Algemene hulpmiddelen";
	}
	else if (inputlanguage == 2)	{
		document.getElementById("title").textContent = "TLD Menu Modeling";
		document.getElementById("find").textContent = "Find a new domain name";
		document.getElementById("view").textContent = "View data of a domain";
		document.getElementById("terms").textContent = "Terms and conditions";
		document.getElementById("additional_terms").textContent = "Additional terms";
		document.getElementById("procedures").textContent = "Procedures";
		document.getElementById("statutory_law").textContent = "Statutory law";
		document.getElementById("judicial_law").textContent = "Judicial law";
		document.getElementById("common_law").textContent = "Common law";
		document.getElementById("pricing").textContent = "Pricing information";
		document.getElementById("rdap").textContent = "Whois and RDAP information";
		document.getElementById("issues").textContent = "Current issues";
		document.getElementById("figurs").textContent = "Figures";
		document.getElementById("authorities").textContent = "Related authorities";
		document.getElementById("knowledge").textContent = "Knowledge hyperlinks";
		document.getElementById("tools").textContent = "Common tools";
	}
	else if (inputlanguage == 3)	{
		document.getElementById("title").textContent = "TLD-Menümodellierung";
		document.getElementById("find").textContent = "Finden Sie einen neuen Domainnamen";
		document.getElementById("view").textContent = "Daten einer Domain anzeigen";
		document.getElementById("terms").textContent = "Geschäftsbedingungen";
		document.getElementById("additional_terms").textContent = "Zusätzliche Bedingungen";
		document.getElementById("procedures").textContent = "Verfahren";
		document.getElementById("statutory_law").textContent = "Gesetzesrecht";
		document.getElementById("judicial_law").textContent = "Gerichtsrecht";
		document.getElementById("common_law").textContent = "Gewohnheitsrecht";
		document.getElementById("pricing").textContent = "Preisinformationen";
		document.getElementById("rdap").textContent = "Whois- und RDAP-Informationen";
		document.getElementById("issues").textContent = "Aktuelle Themen";
		document.getElementById("figurs").textContent = "Figuren";
		document.getElementById("authorities").textContent = "Zugehörige Behörden";
		document.getElementById("knowledge").textContent = "Wissens-Hyperlinks";
		document.getElementById("tools").textContent = "Gemeinsame Werkzeuge";
	}
	else if (inputlanguage == 4)	{
		document.getElementById("title").textContent = "Modélisation du menu TLD";
		document.getElementById("find").textContent = "Trouver un nouveau nom de domaine";
		document.getElementById("view").textContent = "Afficher les données d'un domaine";
		document.getElementById("terms").textContent = "Termes et conditions";
		document.getElementById("additional_terms").textContent = "Termes supplémentaires";
		document.getElementById("procedures").textContent = "Procédures";
		document.getElementById("statutory_law").textContent = "Loi statutaire";
		document.getElementById("judicial_law").textContent = "Droit judiciaire";
		document.getElementById("common_law").textContent = "Loi commune";
		document.getElementById("pricing").textContent = "Information sur les prix";
		document.getElementById("rdap").textContent = "Informations Whois et RDAP";
		document.getElementById("issues").textContent = "Questions d'actualité";
		document.getElementById("figurs").textContent = "Chiffres";
		document.getElementById("authorities").textContent = "Autorités connexes";
		document.getElementById("knowledge").textContent = "Liens hypertexte de connaissances";
		document.getElementById("tools").textContent = "Outils communs";
	}
}	
</script><?php
echo '</head>';
$html_text = '<body onload=SwitchTranslation('.$inputlanguage.')><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem">
<tr><th style="width:400px"></th><th style="width:450px"></th></tr>';
$html_text .= '<tr><td id="title" style="font-size: 1.25rem;color:blue;font-weight:bold"></td>
<td style="font-size: .9rem"><a style="font-size: 0.9rem" href="https://github.com/janwillemstegink/rdap.hostingtool.nl" target="_blank">code/issues on GitHub</a> - <a style="font-size: 0.9rem" href="https://janwillemstegink.nl/" target="_blank">janwillemstegink.nl</a></td></tr>';
$html_text .= '<tr><td><hr></td><td><hr></td></tr>';	
$html_text .= '<tr><td></td><td>
<button style="cursor:pointer" onclick="SwitchTranslation(1)">In het nederlands</button> - 
<button style="cursor:pointer" onclick="SwitchTranslation(2)">In English</button> - 
<button style="cursor:pointer" onclick="SwitchTranslation(3)">Auf Deutsch</button> - 
<button style="cursor:pointer" onclick="SwitchTranslation(4)">En français</button></td></tr>';
$html_text .= '<tr><td id="find" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="view" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="terms" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="additional_terms" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="procedures" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="statutory_law" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="judicial_law" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="common_law" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="pricing" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="rdap" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="issues" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="figurs" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="authorities" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="knowledge" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '<tr><td id="tools" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '</table></div></body></html>';
echo $html_text;
?>