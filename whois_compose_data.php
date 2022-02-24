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
				echo write_file2($whois_domain);
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

function write_file1($inputdomain)	{
	
	// to write simular to the DOM-code for restrictions.	
	return '';	
}	

function write_file2($inputdomain)	{
	
$restrictions_1 = 'Auteursrechtvoorbehoud
Niets uit deze publicatie mag zonder voorafgaande uitdrukkelijke toestemming van SIDN worden verveelvoudigd, openbaar gemaakt, worden opgeslagen in een gegevensbestand of worden overgezonden, in welke vorm dan ook, elektronisch, mechanisch, door middel van opname of anderszins. Voor registrars geldt dit voorbehoud onverkort, behoudens redelijkerwijs noodzakelijke verveelvoudigingen of openbaarmakingen ten behoeve van de werkzaamheden van registrars, zoals vermeld in de "Algemene voorwaarden voor registrars".

Elk gebruik van deze informatie voor commerciële of reclamedoeleinden of soortgelijke activiteiten, is expliciet verboden en tegen overtreding van dat verbod zal worden opgetreden. Stichting Internet Domeinregistratie Nederland (SIDN) verzoekt te worden geïnformeerd bij constatering van dergelijke activiteiten of enig vermoeden daarvan.

© Stichting Internet Domeinregistratie Nederland (SIDN) Auteurswet, geschriftenbescherming (art. 10 lid 1 sub 1).';
	
$restrictions_2 = "Copyright notice
No part of this publication may be reproduced, published, stored in a retrieval system or transmitted, in any form or by any means, electronic, mechanical, recording, or otherwise, without the prior permission of the Foundation for Internet Domain Registration in the Netherlands (SIDN). These restrictions apply equally to registrars, except in that reproduction and publication are permitted insofar as reasonable, necessary and undertaken solely in the context of the registration activities referred to in the General Terms and Conditions for .nl Registrars.

Any use of this material for advertising, the targeting of commercial offers or similar activities is explicitly forbidden and liable to result in legal action. Anyone who is aware or suspects that such activities are taking place is asked to inform the Foundation for Internet Domain Registration in the Netherlands.

©The Foundation for Internet Domain Registration in the Netherlands (SIDN) Dutch Copyright Act, protection of authors' rights (Section 10, subsection 1, clause 1).";	

$doc = new DOMDocument("1.0", "UTF-8");
$doc->xmlStandalone = true;	
$doc->formatOutput = true;
	
$domains = $doc->createElement("domains");
$doc->appendChild($domains);
	
$domain = $doc->createElement("domain");	
$domains->appendChild($domain);
$domain->setAttribute("item", $inputdomain);
	
$restrictions_legally = $doc->createElement("restrictions_legally");
$restrictions_legally->appendChild($doc->createCDATASection($restrictions_1));	
$domain->appendChild($restrictions_legally);
	
$restrictions_translated = $doc->createElement("restrictions_translated");
$restrictions_translated->appendChild($doc->createCDATASection($restrictions_2));		
$domain->appendChild($restrictions_translated);	
	
$domains->appendChild($domain);
$doc->appendChild($domains);
	
//return $doc->saveXML(NULL, LIBXML_NOEMPTYTAG);	
return $doc->saveXML();
}			
?>