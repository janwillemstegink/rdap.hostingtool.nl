<?php
session_start();  // is needed with no PHP Generator Scriptcase
|if (empty($inputlanguage))	{
	$browserlanguage = getLanguage();
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
<title>zone menu modeling</title>';
?><script>
	
function SwitchTranslation(inputlanguage)	{
	if (inputlanguage == 1)	{
		document.getElementById("title").textContent = "Menu voor '.nl' zone-informatie";
		document.getElementById("find").textContent = "Vind een nieuwe domeinnaam";
		document.getElementById("view").textContent = "Gegevens van een domein bekijken";
		document.getElementById("terms").textContent = "Voorwaarden";
		document.getElementById("additional_terms").textContent = "Aanvullende voorwaarden";
		document.getElementById("procedures").textContent = "Procedures";
		document.getElementById("statutory_law").textContent = "Wettelijk recht";
		document.getElementById("judicial_law").textContent = "Rechtersrecht";
		document.getElementById("common_law").textContent = "Gewoonterecht";
		document.getElementById("pricing").textContent = "Prijsinformatie";
		document.getElementById("authorities").textContent = "Gerelateerde instanties";
	}
	else if (inputlanguage == 2)	{
		document.getElementById("title").textContent = "Menu for '.nl' zone information";
		document.getElementById("find").textContent = "Find a new domain name";
		document.getElementById("view").textContent = "View data of a domain";
		document.getElementById("terms").textContent = "Terms and conditions";
		document.getElementById("additional_terms").textContent = "Additional terms";
		document.getElementById("procedures").textContent = "Procedures";
		document.getElementById("statutory_law").textContent = "Statutory law";
		document.getElementById("judicial_law").textContent = "Judicial law";
		document.getElementById("common_law").textContent = "Common law";
		document.getElementById("pricing").textContent = "Pricing information";
		document.getElementById("authorities").textContent = "Related authorities";
	}
	else if (inputlanguage == 3)	{
		document.getElementById("title").textContent = "Menü für '.nl'-Zoneninformationen";
		document.getElementById("find").textContent = "Finden Sie einen neuen Domainnamen";
		document.getElementById("view").textContent = "Daten einer Domain anzeigen";
		document.getElementById("terms").textContent = "Geschäftsbedingungen";
		document.getElementById("additional_terms").textContent = "Zusätzliche Bedingungen";
		document.getElementById("procedures").textContent = "Verfahren";
		document.getElementById("statutory_law").textContent = "Gesetzesrecht";
		document.getElementById("judicial_law").textContent = "Gerichtsrecht";
		document.getElementById("common_law").textContent = "Gewohnheitsrecht";
		document.getElementById("pricing").textContent = "Preisinformationen";
		document.getElementById("authorities").textContent = "Zugehörige Behörden";
	}
	else if (inputlanguage == 4)	{
		document.getElementById("title").textContent = "Menu pour les informations de zone '.nl'";
		document.getElementById("find").textContent = "Trouver un nouveau nom de domaine";
		document.getElementById("view").textContent = "Afficher les données d'un domaine";
		document.getElementById("terms").textContent = "Termes et conditions";
		document.getElementById("additional_terms").textContent = "Termes supplémentaires";
		document.getElementById("procedures").textContent = "Procédures";
		document.getElementById("statutory_law").textContent = "Loi statutaire";
		document.getElementById("judicial_law").textContent = "Droit judiciaire";
		document.getElementById("common_law").textContent = "Loi commune";
		document.getElementById("pricing").textContent = "Information sur les prix";
		document.getElementById("authorities").textContent = "Autorités connexes";
	}
}	
</script><?php
echo '</head>';
$html_text = '<body onload=SwitchTranslation('.$inputlanguage.')><div style="border-collapse:collapse; line-height:120%">
<table style="font-family:Helvetica, Arial, sans-serif; font-size: 1rem">
<tr><th style="width:400px"></th></th><th style="width:450px"></th></tr>';
$html_text .= '<tr><td id="title" style="font-size: 1.25rem;color:blue;font-weight:bold"></td>
<td style="font-size: .9rem"><a href="https://github.com/janwillemstegink/model_rdap_view" target="_blank">github.com/janwillemstegink/model_rdap_view</a></td></tr>';
$html_text .= '<tr><td><hr></td><td><hr></td><td><hr></td></tr>';	
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
$html_text .= '<tr><td id="authorities" style="font-weight:bold"></td><td>...hyperlink...</td></tr>';
$html_text .= '</table></div></body></html>';
echo $html_text;

/**
* Browser Locale Detection
*
* This functions check the HTTP_ACCEPT_LANGUAGE HTTP-Header
* for the supported browser languages and returns an array.
*
* Basically HTTP_ACCEPT_LANGUAGE locales are composed by 3 elements:
* PREFIX-SUBCLASS ; QUALITY=value
*
* PREFIX: is the main language identifier
* (i.e. en-us, en-ca => both have prefix EN)
* SUBCLASS: is a subdivision for main language (prefix)
* (i.e. en-us runs for english - united states) IT CAN BE BLANK
* QUALITY: is the importance for given language
* primary language setting defaults to 1 (100%)
* secondary and further selections have a lower Q value (value <1).
* EXAMPLE: de-de,de;q=0.8,en-us;q=0.5,en;q=0.3
*
* @access public
* @return Array containing the list of supported languages
* @todo $_SERVER is an httprequest object...
* the method should be placed there and data fetch from the httprequest->method
*/
function getBrowserLanguages()
{
# check if environment variable HTTP_ACCEPT_LANGUAGE exists
if(!isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
{
# if not return an empty language array
return array();
}

# explode environment variable HTTP_ACCEPT_LANGUAGE at ,
$browserLanguages = explode( ',', $_SERVER['HTTP_ACCEPT_LANGUAGE'] );

# convert the headers string to an array
$browserLanguagesSize = sizeof( $browserLanguages );
for ( $i = 0; $i < $browserLanguagesSize; $i++ )
{
# explode string at ;
$browserLanguage = explode( ';', $browserLanguages[$i] );
# cut string and place into array
$browserLanguages[$i] = substr( $browserLanguage[0], 0, 2 );
}

# remove the duplicates and return the browser languages
return array_values( array_unique( $browserLanguages ) );
}

function getLanguage( $supported=array('nl','en','de','fr'))
{
# start with the default language
$language = $supported[1];

# get the list of languages supported by the browser
$browserLanguages = getBrowserLanguages();
# look if the browser language is a supported language, by checking the array entries
foreach ( $browserLanguages as $browserLanguage )
{
# if a supported language is found, set it and stop
if ( in_array( $browserLanguage, $supported ) )
{
$language = $browserLanguage;
break;
}
}

# return the found language
return $language;
}
?>