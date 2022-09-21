<?php
if (!empty($_GET['domain']))	{
	if (strlen(trim($_GET['domain'])))	{
		$whois_domain = trim($_GET['domain']);
		if	($_GET['format'] == 'xml')	{
			if	($_GET['type'] == 1)	{
				echo write_file1($whois_domain);
				die();
			}	
			elseif	($_GET['type'] == 2)	{
				$toplevel_domain = mb_substr($whois_domain, strrpos($whois_domain, '.') + 1);
				echo write_file2($toplevel_domain);
				die();
			}
			else	{
				die("No data type matches.");	
			}
		}
		else	{
			die("No data format matches");	
		}
	}
	else	{	
		die("No domain name is filled as input");	
	}
}
else	{	
	die("No domain name variable as input");	
}

function write_file1($inputwhoisdomain)	{
	
	// technically simular to the DOM-code for restrictions.	
	return '';	
}	

function write_file2($inputtopleveldomain)	{

$whois_server = 'whois.domain-zone';
$description = 'NL Domain zone';
$registry_name = 'SIDN';	
$time_zone = 'Europe/Amsterdam';
$language = 'nl-NL';
$format = 'PLAIN';	
	
$restrictions_1 = "Auteursrechtvoorbehoud
Niets uit deze publicatie mag zonder voorafgaande uitdrukkelijke toestemming van SIDN worden verveelvoudigd, openbaar gemaakt, worden opgeslagen in een gegevensbestand of worden overgezonden, in welke vorm dan ook, elektronisch, mechanisch, door middel van opname of anderszins. Voor registrars geldt dit voorbehoud onverkort, behoudens redelijkerwijs noodzakelijke verveelvoudigingen of openbaarmakingen ten behoeve van de werkzaamheden van registrars, zoals vermeld in de &lsquo;Algemene voorwaarden voor registrars&rsquo;.

Elk gebruik van deze informatie voor commerci&euml;le of reclamedoeleinden of soortgelijke activiteiten, is expliciet verboden en tegen overtreding van dat verbod zal worden opgetreden. Stichting Internet Domeinregistratie Nederland (SIDN) verzoekt te worden ge&iuml;nformeerd bij constatering van dergelijke activiteiten of enig vermoeden daarvan.

&copy; Stichting Internet Domeinregistratie Nederland (SIDN) Auteurswet, geschriftenbescherming (art. 10 lid 1 sub 1).";
	
$restrictions_2 = "Copyright notice
No part of this publication may be reproduced, published, stored in a retrieval system or transmitted, in any form or by any means, electronic, mechanical, recording, or otherwise, without the prior permission of the Foundation for Internet Domain Registration in the Netherlands (SIDN). These restrictions apply equally to registrars, except in that reproduction and publication are permitted insofar as reasonable, necessary and undertaken solely in the context of the registration activities referred to in the General Terms and Conditions for .nl Registrars.

Any use of this material for advertising, the targeting of commercial offers or similar activities is explicitly forbidden and liable to result in legal action. Anyone who is aware or suspects that such activities are taking place is asked to inform the Foundation for Internet Domain Registration in the Netherlands.

&copy; The Foundation for Internet Domain Registration in the Netherlands (SIDN) Dutch Copyright Act, protection of authors&#39; rights (Section 10, subsection 1, clause 1).";	

$doc = new DOMDocument("1.0", "UTF-8");
$doc->xmlStandalone = true;	
$doc->formatOutput = true;
	
$zones = $doc->createElement("zones");
$doc->appendChild($zones);
	
$zone = $doc->createElement("zone");	
$zones->appendChild($zone);
$zone->setAttribute("item", $inputtopleveldomain);

$zone_whois_server = $doc->createElement("zone_whois_server");
$zone_whois_server->appendChild($doc->createCDATASection($whois_server));	
$zone->appendChild($zone_whois_server);
	
$zone_description = $doc->createElement("zone_description");
$zone_description->appendChild($doc->createCDATASection($description));	
$zone->appendChild($zone_description);
	
$zone_registry_name = $doc->createElement("zone_registry_name");
$zone_registry_name->appendChild($doc->createCDATASection($registry_name));	
$zone->appendChild($zone_registry_name);
	
$zone_time_zone = $doc->createElement("zone_time_zone");
$zone_time_zone->appendChild($doc->createCDATASection($time_zone));	
$zone->appendChild($zone_time_zone);
	
$zone_language = $doc->createElement("zone_language");
$zone_language->appendChild($doc->createCDATASection($language));	
$zone->appendChild($zone_language);
	
$zone_format = $doc->createElement("zone_format");
$zone_format->appendChild($doc->createCDATASection($format));	
$zone->appendChild($zone_format);	
	
$whois_legal_restrictions = $doc->createElement("whois_legal_restrictions");
$whois_legal_restrictions->appendChild($doc->createCDATASection($restrictions_1));	
$zone->appendChild($whois_legal_restrictions);
	
$whois_translated_restrictions = $doc->createElement("whois_translated_restrictions");
$whois_translated_restrictions->appendChild($doc->createCDATASection($restrictions_2));		
$zone->appendChild($whois_translated_restrictions);	
	
$zones->appendChild($zone);
$doc->appendChild($zones);
	
//return $doc->saveXML(NULL, LIBXML_NOEMPTYTAG);	
return $doc->saveXML();
}					
?>