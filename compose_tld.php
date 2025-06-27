<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//$_GET['tld'] = 'nl';

if (!empty($_GET['tld']))	{
	if (strlen($_GET['tld']))	{
		$tld = mb_strtolower($_GET['tld']);
		$tld = str_replace('http://','', $tld);
		$tld = str_replace('https://','', $tld);
		if (substr_count($tld, '.') > 1)	{
			$tld = str_replace('www.','', $tld);
		}
		$strpos = mb_strpos($tld, '/');
		if ($strpos)	{
			$tld = mb_substr($tld, 0, $strpos);
		}
		$strpos = mb_strpos($tld, ':');
		if ($strpos)	{
			$tld = mb_substr($tld, 0, $strpos);
		}
		header('Content-Type: application/json');
		echo json_encode(write_file($tld), JSON_PRETTY_PRINT);
		die();
	}
	else	{	
		die("No tld name is filled as input");	
	}
}
else	{	
	die("No tld name variable as input");
}

function detect_country_code($inputdefault, $inputCC, $inputcc)	{	
	$outputcc = $inputdefault;
	if (strlen($inputCC))	$outputcc = $inputCC.' "CC"=>"cc"';
	if (strlen($inputcc))	$outputcc = $inputcc;
	return $outputcc;
}

function write_file($inputtld)	{	

$root_zone_data_active_from = null;
$root_zones_url = 'https://www.iana.org/domains/root/db';
$registrar_accreditations_url = 'https://www.iana.org/assignments/registrar-ids/registrar-ids.xhtml';
$lookup_endpoints_url = 'https://data.iana.org/rdap/dns.json';
$tld_category = '';
$tld_type = '';
$restrictions_url = '';
$menu_url = '';
$tld_contacts_json = '[]';	
$tld_roles_json = '[
{"tld_role_sequence": 10,"tld_role_identifier": "contracting_authority","tld_role_shielding": ["name", "tel"]},
{"tld_role_sequence": 20,"tld_role_identifier": "contracting_organization","tld_role_shielding": ["name", "tel"]},
{"tld_role_sequence": 30,"tld_role_identifier": "sponsoring_organization","tld_role_shielding": ["name", "tel"]},
{"tld_role_sequence": 40,"tld_role_identifier": "country_code_designated_manager","tld_role_shielding": ["name", "tel"]},
{"tld_role_sequence": 50,"tld_role_identifier": "registry_operator","tld_role_shielding": []},
{"tld_role_sequence": 60,"tld_role_identifier": "backend_operator","tld_role_shielding": []}]';
$decoded = json_decode($tld_roles_json, true);
usort($decoded, function ($a, $b) {
    return $a['tld_role_sequence'] <=> $b['tld_role_sequence'];
});
$tld_roles = '<b>tld_role_sequence, tld_role_identifier, tld_role_shielding</b><br />';    
foreach ($decoded as $role) {
	$tld_roles .= $role['tld_role_sequence'] . ', ' . $role['tld_role_identifier'] . ', [' . implode(', ', $role['tld_role_shielding']) . ']<br />';
}	
$lifecycle_data_active_from = null;	
$upon_termination = 'Zone-specific regulation';
$zone_roles_json = '[{"zone_role_sequence": 10,"zone_role_identifier": "abuse","zone_role_shielding": ["name"]},
{"zone_role_sequence": 20,"zone_role_identifier": "sponsor","zone_role_shielding": ["name", "email", "tel"]},
{"zone_role_sequence": 30,"zone_role_identifier": "registrant","zone_role_shielding": ["name", "email", "tel", "address"]},
{"zone_role_sequence": 40,"zone_role_identifier": "administrative","zone_role_shielding": ["web_id", "name", "tel", "address"]},
{"zone_role_sequence": 50,"zone_role_identifier": "technical","zone_role_shielding": ["web_id", "name", "tel", "address"]},
{"zone_role_sequence": 60,"zone_role_identifier": "billing","zone_role_shielding": ["web_id", "name", "email", "tel", "address"]},
{"zone_role_sequence": 70,"zone_role_identifier": "emergency","zone_role_shielding": ["name"]},
{"zone_role_sequence": 80,"zone_role_identifier": "reseller","zone_role_shielding": ["name", "email", "tel"]},
{"zone_role_sequence": 90,"zone_role_identifier": "registrar","zone_role_shielding": ["name", "email", "tel"]}]';
$decoded = json_decode($zone_roles_json, true);
usort($decoded, function ($a, $b) {
    return $a['zone_role_sequence'] <=> $b['zone_role_sequence'];
});
$zone_roles = '<b>zone_role_sequence, zone_role_identifier, zone_role_shielding</b><br />';    
foreach ($decoded as $role) {
	$zone_roles .= $role['zone_role_sequence'] . ', ' . $role['zone_role_identifier'] . ', [' . implode(', ', $role['zone_role_shielding']) . ']<br />';
}	
$periods_json = '[
        {"period_identifier": "subscription_period", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "add_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "transfer_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "post_transfer_lock_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "renew_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "redemption_period_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "deletion_phase_days", "period_minimum": null, "period_maximum": null}
    ]';
if ($inputtld == 'nl')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$upon_termination = "40-day quarantine phase (.nl)";
	$periods_json = '[
        {"period_identifier": "subscription_period", "period_minimum": "1 year", "period_maximum": "1 year"},
        {"period_identifier": "add_period_grace_days", "period_minimum": 0, "period_maximum": 0},
        {"period_identifier": "transfer_period_grace_days", "period_minimum": 0, "period_maximum": 0},
        {"period_identifier": "post_transfer_lock_days", "period_minimum": 0, "period_maximum": 0},
        {"period_identifier": "renew_period_grace_days", "period_minimum": 0, "period_maximum": 0},
        {"period_identifier": "redemption_period_days", "period_minimum": 40, "period_maximum": 40},
        {"period_identifier": "deletion_phase_days", "period_minimum": 0, "period_maximum": 0}
    ]';
	$tld_contacts_json = '[
        {"contact_identifier": "contracting_authority", "contact_legal_name": null, "contact_presented_name": null},
		{"contact_identifier": "contracting_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": "Stichting Internet Domeinregistratie Nederland", "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "Stichting Internet Domeinregistratie Nederland", "contact_presented_name": null},
		{"contact_identifier": "backend_operator", "contact_legal_name": "SIDN B.V.", "contact_presented_name": "SIDN"}
    ]';
	$restrictions_url = 'https://www.sidn.nl/en/nl-domain-name/sidn-and-privacy';
	$menu_url = 'https://www.sidn.nl/en/theme/domain-names';
}
elseif ($inputtld == 'frl')	{
	$tld_category = 'gTLD';
	$tld_type = 'geoTLD';
	$tld_contacts_json = '[
		{"contact_identifier": "contracting_authority", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "contracting_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": "FRLregistry B.V.", "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "FRLregistry B.V.", "contact_presented_name": null},
		{"contact_identifier": "backend_operator", "contact_legal_name": "Team Internet Group PLC", "contact_presented_name": "CTO CentralNic"}
    ]';
	$restrictions_url = 'https://nic.frl/';
	$menu_url = 'https://nic.frl/';
}
elseif ($inputtld == 'amsterdam')	{
	$tld_category = 'gTLD';
	$tld_type = 'geoTLD';
	$tld_contacts_json = '[
		{"contact_identifier": "contracting_authority", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "contracting_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": "Gemeente Amsterdam", "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "Stichting Internet Domeinregistratie Nederland", "contact_presented_name": null},
		{"contact_identifier": "backend_operator", "contact_legal_name": "SIDN B.V.", "contact_presented_name": "SIDN"}
    ]';
	$restrictions_url = 'https://www.sidn.nl/en/nl-domain-name/sidn-and-privacy';
	$menu_url = 'https://www.sidn.nl/en/theme/domain-names';
	$registrant_web_id = 'NL88COMM01234567890123456789012345';
}
elseif ($inputtld == 'politie')	{
	$tld_category = 'gTLD';
	$tld_type = 'Brand gTLD';
	$tld_contacts_json = '[
		{"contact_identifier": "contracting_authority", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "contracting_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": "Politie Nederland", "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "Stichting Internet Domeinregistratie Nederland", "contact_presented_name": null},
		{"contact_identifier": "backend_operator", "contact_legal_name": "SIDN B.V.", "contact_presented_name": "SIDN"}
    ]';
	$restrictions_url = 'https://www.sidn.nl/en/nl-domain-name/sidn-and-privacy';
	$menu_url = 'https://www.sidn.nl/en/theme/domain-names';
	$registrant_web_id = 'NL88COMM01234567890123456789012345';
}
elseif ($inputtld == 'eu')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$upon_termination = "40-day quarantine phase (.eu)";
	$periods_json = '[
        {"period_identifier": "subscription_period", "period_minimum": "1 year", "period_maximum": "1 year"},
        {"period_identifier": "add_period_grace_days", "period_minimum": 0, "period_maximum": 5},
        {"period_identifier": "transfer_period_grace_days", "period_minimum": 0, "period_maximum": 0},
        {"period_identifier": "post_transfer_lock_days", "period_minimum": 60, "period_maximum": 60},
        {"period_identifier": "renew_period_grace_days", "period_minimum": 0, "period_maximum": 0},
        {"period_identifier": "redemption_period_days", "period_minimum": 40, "period_maximum": 40},
        {"period_identifier": "deletion_phase_days", "period_minimum": 0, "period_maximum": 0}
    ]';
	$tld_contacts_json = '[
		{"contact_identifier": "contracting_authority", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "contracting_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": "EURid vzw/asbl", "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "EURid vzw", "contact_presented_name": null},
		{"contact_identifier": "backend_operator", "contact_legal_name": "EURid vzw", "contact_presented_name": "Technical Department"}
    ]';
	$restrictions_url = 'https://help.eurid.eu/hc/en-gb/';
	$menu_url = 'https://help.eurid.eu/hc/en-gb/';
}
elseif ($inputtld == 'de')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$periods_json = '[
        {"period_identifier": "subscription_period", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "add_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "transfer_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "post_transfer_lock_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "renew_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "redemption_period_days", "period_minimum": 0, "period_maximum": 28},
        {"period_identifier": "deletion_phase_days", "period_minimum": 0, "period_maximum": 0}
    ]';	
	$tld_contacts_json = '[
        {"contact_identifier": "contracting_authority", "contact_legal_name": null, "contact_presented_name": null},
		{"contact_identifier": "contracting_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": "DENIC eG", "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "DENIC eG", "contact_presented_name": "Vorstand"},
		{"contact_identifier": "backend_operator", "contact_legal_name": "DENIC eG", "contact_presented_name": "Business Services"}
    ]';
	$restrictions_url = 'https://www.denic.de/';
	$menu_url = 'https://www.denic.de/';
}
elseif ($inputtld == 'fr')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$periods_json = '[
        {"period_identifier": "subscription_period", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "add_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "transfer_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "post_transfer_lock_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "renew_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "redemption_period_days", "period_minimum": 30, "period_maximum": 30},
        {"period_identifier": "deletion_phase_days", "period_minimum": 0, "period_maximum": 0}
    ]';
	$tld_contacts_json = '[
        {"contact_identifier": "contracting_authority", "contact_legal_name": null, "contact_presented_name": null},
		{"contact_identifier": "contracting_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": "Association Française pour le Nommage Internet en Coopération", "contact_presented_name": "A.F.N.I.C."},
        {"contact_identifier": "registry_operator", "contact_legal_name": "Association Française pour le Nommage Internet en Coopération", "contact_presented_name": "A.F.N.I.C."},
		{"contact_identifier": "backend_operator", "contact_legal_name": "Association Française pour le Nommage Internet en Coopération", "contact_presented_name": "A.F.N.I.C."}
    ]';	
	$restrictions_url = 'https://www.afnic.fr/';
	$menu_url = 'https://www.afnic.fr/';
}
elseif ($inputtld == 'ch')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$periods_json = '[
        {"period_identifier": "subscription_period", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "add_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "transfer_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "post_transfer_lock_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "renew_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "redemption_period_days", "period_minimum": 40, "period_maximum": 40},
        {"period_identifier": "deletion_phase_days", "period_minimum": 0, "period_maximum": 0}
    ]';
	$tld_contacts_json = '[
        {"contact_identifier": "contracting_authority", "contact_legal_name": null, "contact_presented_name": null},
		{"contact_identifier": "contracting_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": "SWITCH Foundation", "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "SWITCH Foundation", "contact_presented_name": "The Swiss Education & Research Network"},
		{"contact_identifier": "backend_operator", "contact_legal_name": "SWITCH Foundation", "contact_presented_name": "The Swiss Education & Research Network"}
    ]';
	$restrictions_url = 'https://www.nic.ch/';
	$menu_url = 'https://www.nic.ch/';
}	
elseif ($inputtld == 'li')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$tld_contacts_json = '[
        {"contact_identifier": "contracting_authority", "contact_legal_name": null, "contact_presented_name": null},
		{"contact_identifier": "contracting_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": "SWITCH Foundation", "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "SWITCH Foundation", "contact_presented_name": "The Swiss Education & Research Network"},
		{"contact_identifier": "backend_operator", "contact_legal_name": "SWITCH Foundation", "contact_presented_name": "The Swiss Education & Research Network"}
    ]';
	$restrictions_url = 'https://www.nic.li/';
	$menu_url = 'https://www.nic.li/';
}
elseif ($inputtld == 'be')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$tld_contacts_json = '[
        {"contact_identifier": "contracting_authority", "contact_legal_name": null, "contact_presented_name": null},
		{"contact_identifier": "contracting_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": "DNS Belgium vzw/asbl", "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "DNS Belgium vzw/asbl", "contact_presented_name": null},
		{"contact_identifier": "backend_operator", "contact_legal_name": "DNS Belgium vzw/asbl", "contact_presented_name": null}
    ]';
	$restrictions_url = 'https://www.dnsbelgium.be/';
	$menu_url = 'https://www.dnsbelgium.be/';
}
elseif ($inputtld == 'lu')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$tld_contacts_json = '[
        {"contact_identifier": "contracting_authority", "contact_legal_name": null, "contact_presented_name": null},
		{"contact_identifier": "contracting_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": "RESTENA", "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "Fondation RESTENA", "contact_presented_name": null},
		{"contact_identifier": "backend_operator", "contact_legal_name": "Fondation RESTENA", "contact_presented_name": "NOC"}
    ]';
	$restrictions_url = 'https://restena.lu/';
	$menu_url = 'https://restena.lu/';
}
elseif ($inputtld == 'uk')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$periods_json = '[
        {"period_identifier": "subscription_period", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "add_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "transfer_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "post_transfer_lock_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "renew_period_grace_days", "period_minimum": 30, "period_maximum": 30},
        {"period_identifier": "redemption_period_days", "period_minimum": 60, "period_maximum": 60},
        {"period_identifier": "deletion_phase_days", "period_minimum": 0, "period_maximum": 0}
    ]';
	$tld_contacts_json = '[
        {"contact_identifier": "contracting_authority", "contact_legal_name": null, "contact_presented_name": null},
		{"contact_identifier": "contracting_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": "Nominet UK", "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "Nominet UK", "contact_presented_name": "TLD Registry Services Management"},
		{"contact_identifier": "backend_operator", "contact_legal_name": "Nominet UK", "contact_presented_name": "TLD Registry Services Technical"}
    ]';
	$restrictions_url = 'https://nominet.uk/';
	$menu_url = 'https://nominet.uk/';
}
elseif ($inputtld == 'com')	{
	$tld_category = 'gTLD';
	$tld_type = 'gTLD';
	$periods_json = '[
        {"period_identifier": "subscription_period", "period_minimum": "1 year", "period_maximum": "10 years"},
        {"period_identifier": "add_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "transfer_period_grace_days", "period_minimum": 5, "period_maximum": 5},
        {"period_identifier": "post_transfer_lock_days", "period_minimum": 60, "period_maximum": 60},
        {"period_identifier": "renew_period_grace_days", "period_minimum": 0, "period_maximum": 45},
        {"period_identifier": "redemption_period_days", "period_minimum": 30, "period_maximum": 30},
        {"period_identifier": "deletion_phase_days", "period_minimum": 5, "period_maximum": 5}
    ]';
	$tld_contacts_json = '[
		{"contact_identifier": "contracting_authority", "contact_legal_name": "Internet Corporation for Assigned Names and Numbers", "contact_presented_name": "ICANN"},
        {"contact_identifier": "contracting_organization", "contact_legal_name": "VeriSign Global Registry Services", "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "VeriSign Global Registry Services", "contact_presented_name": "Registry Customer Service"},
		{"contact_identifier": "backend_operator", "contact_legal_name": "VeriSign Global Registry Services", "contact_presented_name": "Registry Customer Service"}
    ]';	
	$restrictions_url = 'https://www.verisigninc.com/';
	$menu_url = 'https://www.verisigninc.com/';
}
elseif ($inputtld == 'org')	{
	$tld_category = 'gTLD';
	$tld_type = 'gTLD';
	$periods_json = '[
        {"period_identifier": "subscription_period", "period_minimum": "1 year", "period_maximum": "10 years"},
        {"period_identifier": "add_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "transfer_period_grace_days", "period_minimum": 5, "period_maximum": 5},
        {"period_identifier": "post_transfer_lock_days", "period_minimum": 60, "period_maximum": 60},
        {"period_identifier": "renew_period_grace_days", "period_minimum": 0, "period_maximum": 45},
        {"period_identifier": "redemption_period_days", "period_minimum": 30, "period_maximum": 30},
        {"period_identifier": "deletion_phase_days", "period_minimum": 5, "period_maximum": 5}
    ]';
	$tld_contacts_json = '[
		{"contact_identifier": "contracting_authority", "contact_legal_name": "Internet Corporation for Assigned Names and Numbers", "contact_presented_name": "ICANN"},
        {"contact_identifier": "contracting_organization", "contact_legal_name": "Public Interest Registry (PIR)", "contact_presented_name": null},
        {"contact_identifier": "sponsoring_organization", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "country_code_designated_manager", "contact_legal_name": null, "contact_presented_name": null},
        {"contact_identifier": "registry_operator", "contact_legal_name": "Public Interest Registry (PIR)", "contact_presented_name": "Director of Operations, Compliance and Customer Support"},
		{"contact_identifier": "backend_operator", "contact_legal_name": "Public Interest Registry (PIR)", "contact_presented_name": "Senior Director, DNS Infrastructure Group"}
    ]';	
	$restrictions_url = '';
	$menu_url = '';
}
$delegation_url = 'https://www.iana.org/domains/root/db/'.$inputtld.'.html';		
$decoded = json_decode($tld_contacts_json, true);
$tld_contacts = '<b>tld_contacts</b><br />';   
foreach ($decoded as $contact) {
	if (strlen($contact['contact_legal_name']) or strlen($contact['contact_presented_name']))	{	
		$tld_contacts .= '<br /><em>'.$contact['contact_identifier'] . ':</em><br />';
		if (strlen($contact['contact_legal_name']))	{
			$tld_contacts .= 'legal_name: ' . $contact['contact_legal_name'] . '<br />';
		}
		if (strlen($contact['contact_presented_name']))	{
			$tld_contacts .= 'presented_name: ' . $contact['contact_presented_name'] . '<br />';
		}
	}	
}
$decoded = json_decode($periods_json, true);
$periods = '<b>periods</b><br />';    
foreach ($decoded as $period) {
	$periods .= $period['period_identifier'] . ': Min: ' . $period['period_minimum'] . ' Max: ' . $period['period_maximum'] . '<br />';
}	
	
$resource_upload_at = null;
$zone_status_meanings_json = '[
    {
        "redemption period": {
            "description": "Domain can still be recovered after expiration.",
            "phase": "post-expiration",
            "recoverable": true,
            "final": false
        },
        "pending delete": {
            "description": "Final stage before deletion; recovery no longer possible.",
            "phase": "pre-deletion",
            "recoverable": false,
            "final": true
        }
    }
]';
$decoded = json_decode($zone_status_meanings_json, true);
$zone_status_meanings = "<b>zone_status_meanings</b><br />";
foreach ($decoded as $statuses) {
    foreach ($statuses as $key => $value) {	//ucwords()
        $zone_status_meanings .= '"' . htmlspecialchars($key) . '": ';
        $zone_status_meanings .= htmlspecialchars($value['description']);
        $zone_status_meanings .= " (" . htmlspecialchars($value['phase']) . " phase)<br />";
    }
}

$arr = array();
	
$arr[$inputtld]['common']['root_zones_url'] = $root_zones_url;
$arr[$inputtld]['common']['lookup_endpoints_url'] = $lookup_endpoints_url;
$arr[$inputtld]['common']['registrar_accreditations_url'] = $registrar_accreditations_url;		
$arr[$inputtld]['common']['tld_roles'] = $tld_roles;	
	
$arr[$inputtld]['root_zone']['zone_identifier'] = $inputtld;
$arr[$inputtld]['root_zone']['data_active_from'] = $root_zone_data_active_from;	
$arr[$inputtld]['root_zone']['delegation_url'] = $delegation_url;
$arr[$inputtld]['root_zone']['tld_category'] = $tld_category;
$arr[$inputtld]['root_zone']['tld_type'] = $tld_type;
$arr[$inputtld]['root_zone']['sponsoring_organization_name'] = $sponsoring_organization_name;
$arr[$inputtld]['root_zone']['country_code_designated_manager'] = $country_code_designated_manager;
$arr[$inputtld]['root_zone']['registry_operator_organization_name'] = $registry_operator_organization_name;
$arr[$inputtld]['root_zone']['registry_operator_presented_name'] = $registry_operator_presented_name;
$arr[$inputtld]['root_zone']['backend_operator_organization_name'] = $backend_operator_organization_name;
$arr[$inputtld]['root_zone']['backend_operator_presented_name'] = $backend_operator_presented_name;
$arr[$inputtld]['root_zone']['restrictions_url'] = $restrictions_url;
$arr[$inputtld]['root_zone']['menu_url'] = $menu_url;
$arr[$inputtld]['root_zone']['tld_contacts'] = $tld_contacts;
$arr[$inputtld]['root_zone']['zone_roles'] = $zone_roles;

$arr[$inputtld]['lifecycle']['data_active_from'] = $lifecycle_data_active_from;
$arr[$inputtld]['lifecycle']['upon_termination'] = $upon_termination;
$arr[$inputtld]['lifecycle']['zone_status_meanings'] = $zone_status_meanings;	
$arr[$inputtld]['lifecycle']['periods'] = $periods;

return $arr;
}
?>