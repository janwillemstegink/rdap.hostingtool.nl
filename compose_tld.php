<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//$_GET['tld'] = 'nl';
//$_GET['tld'] = 'vermögensberater';

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
		$tld = toPunycodeIfNeeded($tld);
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

function toPunycodeIfNeeded($inputtld) {
    if (strpos($inputtld, 'xn--') === false) {
        $punycode = idn_to_ascii($inputtld, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
        if ($punycode !== false) {
            return $punycode;
        }
		else {
            die("Invalid tld: $inputtld");
        }
    }
    return $inputtld;
}

function write_file($inputtld)	{
	
$tld_json_response_url = 'https://rdap.iana.org/domain/'.$inputtld;
$obj = json_decode(file_get_contents($tld_json_response_url), true);
$notice_0_title = $obj['notices'][0]['title'];
$notice_0_description_0 = $obj['notices'][0]['description'][0];	
$notice_0_description_1 = $obj['notices'][0]['description'][1];
$notice_0_links_0_href = $obj['notices'][0]['links'][0]['href'];
$notice_0_links_0_type = $obj['notices'][0]['links'][0]['type'];
$notice_1_title = $obj['notices'][1]['title'];
$notice_1_description_0 = $obj['notices'][1]['description'][0];
$notice_1_description_1 = $obj['notices'][1]['description'][1];
$notice_1_links_0_href = $obj['notices'][1]['links'][0]['href'];
$notice_1_links_0_type = $obj['notices'][1]['links'][0]['type'];	
$notice_2_title = $obj['notices'][2]['title'];	
$notice_2_description_0 = $obj['notices'][2]['description'][0];
$notice_2_description_1 = $obj['notices'][2]['description'][1];
$notice_2_links_0_href = $obj['notices'][2]['links'][0]['href'];
$notice_2_links_0_type = $obj['notices'][2]['links'][0]['type'];
$notice_3_title = $obj['notices'][3]['title'];	
$notice_3_description_0 = $obj['notices'][3]['description'][0];
$notice_3_description_1 = $obj['notices'][3]['description'][1];
$notice_3_links_0_href = $obj['notices'][3]['links'][0]['href'];
$notice_3_links_0_type = $obj['notices'][3]['links'][0]['type'];
$links_0_value = $obj['links'][0]['value'];
$links_0_related = $obj['links'][0]['rel'];
$links_0_href = $obj['links'][0]['href'];
$links_0_href_lang = $obj['links'][0]['hreflang'];
$links_0_title = $obj['links'][0]['title'];
$links_0_media = $obj['links'][0]['media'];
$links_0_type = $obj['links'][0]['type'];
	
$links_1_value = $obj['links'][1]['value'];
$links_1_related = $obj['links'][1]['rel'];
$links_1_href = $obj['links'][1]['href'];
$links_1_href_lang_1 = $obj['links'][1]['hreflang'];
$links_1_title = $obj['links'][1]['title'];
$links_1_media = $obj['links'][1]['media'];
$links_1_type = $obj['links'][1]['type'];
	
$links_2_value = $obj['links'][2]['value'];
$links_2_related = $obj['links'][2]['rel'];
$links_2_href = $obj['links'][2]['href'];
$links_2_href_lang = $obj['links'][2]['hreflang'];
$links_2_title = $obj['links'][2]['title'];
$links_2_media = $obj['links'][2]['media'];
$links_2_type = $obj['links'][2]['type'];
	
$links_3_value = $obj['links'][3]['value'];
$links_3_related = $obj['links'][3]['rel'];
$links_3_href = $obj['links'][3]['href'];
$links_3_href_lang_1 = $obj['links'][3]['hreflang'];
$links_3_title = $obj['links'][3]['title'];
$links_3_media = $obj['links'][3]['media'];
$links_3_type = $obj['links'][3]['type'];
$tld_ascii_name = $obj['ldhName'];
$tld_unicode_name = $obj['unicodeName'];		
$root_zone_statuses = '';	
$name_servers_handles = '';
$name_servers_ascii = '';
$name_servers_unicode = '';
$name_servers_ipv4 = '';
$name_servers_ipv6 = '';
$name_servers_dnssec_signed = '';
$name_servers_dnssec_algorithm = '';
$name_servers_dnssec_record = '';
foreach($obj as $key1 => $value1) {
	if ($key1 == 'status')	{	
		$root_zone_statuses .= (is_array($value1)) ? implode(",<br />", $value1) : $value1;
	}
	foreach($value1 as $key2 => $value2) {
		if ($key1 == 'secureDNS')	{
			if ($key2 == 'delegationSigned') {
				if ($value2 === true)	{
					$name_servers_dnssec_signed .= 'Yes'."<br />";
				}	
				elseif ($value2 === false)	{
					$name_servers_dnssec_signed .= 'No'."<br />";
				}
				else	{
					$name_servers_dnssec_signed .= 'Not Applicable'."<br />";					
				}	
			}
		}	
		foreach($value2 as $key3 => $value3) {
			if ($key1 == 'nameservers')	{
				if ($key3 == 'handle') {
					$name_servers_handles .= $key2.': '.$value3."<br />";
				}
				elseif ($key3 == 'ldhName') {
					$name_servers_ascii .= $key2.': '.$value3."<br />";
				}
				elseif ($key3 == 'unicodeName')	{
					$name_servers_unicode .= $key2.': '.$value3."<br />";
				}
			}
			if ($key1 == 'secureDNS')	{
				if ($key2 == 'dsData') {
					$name_servers_dnssec_algorithm .= $key3.': '.$value3['algorithm']."<br />";	
					$name_servers_dnssec_record .= $key3.': '.$inputtld.'. IN DS '.$value3['keyTag'].' '.$value3['algorithm'].' '.$value3['digestType'].' '.$value3['digest']."<br />";							}				
			}
			foreach($value3 as $key4 => $value4) {		
				foreach($value4 as $key5 => $value5) {		
					if ($key1 == 'nameservers')	{							
						if ($key3 == 'ipAddresses') {
							if ($key4 == 'v4') {
								$name_servers_ipv4 .= $key2.': '.$value5."<br />";
							}
							elseif ($key4 == 'v6') {
								$name_servers_ipv6 .= $key2.': '.$value5."<br />";
							}
						}														
					}					
				}
			}
		}
	}
}
$root_zone_data_active_from = null;
$root_services_url = 'https://www.iana.org';	
$root_zones_url = 'https://www.iana.org/domains/root/db';
$registrar_accreditations_url = 'https://www.iana.org/assignments/registrar-ids/registrar-ids.xhtml';
$lookup_endpoints_url = 'https://data.iana.org/rdap/dns.json';
$tld_category = '';
$tld_type = '';
$tld_terms_of_service_url = '';
$tld_privacy_policy_url = '';	
$tld_menu_url = '';
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
$root_accepted_workload_json = '[{
	"public_status_requests": {
		"max_per_utc_day": null,
		"max_per_minute": null,
		"max_per_second": null,
		"caching_in_seconds": null
	},
 		"public_object_requests": {
   		"max_per_utc_day": null,
   		"max_per_minute": null,
   		"max_per_second": null,
   		"caching_in_seconds": null
	}
}]';
$decoded = json_decode($root_accepted_workload_json, true);
$root_accepted_workload = '<b>root_accepted_workload</b><br />';    
foreach ($decoded as $workload_entry) {
    foreach ($workload_entry as $request_type => $limits) {
        $root_accepted_workload .= '<b>&bull; </b><em>' . htmlspecialchars($request_type) . ':</em><br />';
        foreach ($limits as $limit_type => $limit_value) {
            $display_value = $limit_value !== null ? htmlspecialchars($limit_value) : 'none';
            $root_accepted_workload .= htmlspecialchars($limit_type) . ': ' . $display_value . '<br />';
        }	
    }	
}	
$lifecycle_data_active_from = null;	
$upon_termination = 'Zone-specific regulation';
$zone_roles_json = '[{"zone_role_sequence": 10,"zone_role_identifier": "sponsor","zone_role_shielding": ["name", "email", "tel"]},
{"zone_role_sequence": 20,"zone_role_identifier": "registrant","zone_role_shielding": ["name", "email", "tel", "address"]},
{"zone_role_sequence": 30,"zone_role_identifier": "administrative","zone_role_shielding": ["web_id", "name", "tel", "address"]},
{"zone_role_sequence": 40,"zone_role_identifier": "technical","zone_role_shielding": ["web_id", "name", "tel", "address"]},
{"zone_role_sequence": 50,"zone_role_identifier": "billing","zone_role_shielding": ["web_id", "name", "email", "tel", "address"]},
{"zone_role_sequence": 60,"zone_role_identifier": "emergency","zone_role_shielding": ["name"]},
{"zone_role_sequence": 70,"zone_role_identifier": "fallback","zone_role_shielding": ["name"]},
{"zone_role_sequence": 80,"zone_role_identifier": "reseller","zone_role_shielding": ["name", "email", "tel"]},
{"zone_role_sequence": 90,"zone_role_identifier": "registrar","zone_role_shielding": ["name", "email", "tel"]},
{"zone_role_sequence": 95,"zone_role_identifier": "abuse","zone_role_shielding": ["name"]}]';
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
$zone_accepted_workload_json = '[{
	"public_status_requests": {
		"max_per_utc_day": null,
		"max_per_minute": null,
		"max_per_second": null,
		"caching_in_seconds": null
	},
 		"public_object_requests": {
   		"max_per_utc_day": null,
   		"max_per_minute": null,
   		"max_per_second": null,
   		"caching_in_seconds": null
	}
}]';	
if ($inputtld == 'nl')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$upon_termination = "40-day quarantine phase for .nl domains.";
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
	$zone_accepted_workload_json = '[{
		"public_status_requests": {
    		"max_per_utc_day": 50000,
    		"max_per_minute": null,
    		"max_per_second": 10,
    		"caching_in_seconds": 420
  		},
  		"public_object_requests": {
    		"max_per_utc_day": 2000,
    		"max_per_minute": null,
    		"max_per_second": 1,
    		"caching_in_seconds": 60
  		}
	}]';
	$tld_terms_of_service_url = 'https://www.sidn.nl/en/nl-domain-name/general-terms-and-conditions-for-nl-registrants';
	$tld_privacy_policy_url = 'https://www.sidn.nl/en/nl-domain-name/sidn-and-privacy';
	$tld_menu_url = 'https://www.sidn.nl/en/theme/domain-names';
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
	$tld_terms_of_service_url = 'https://nic.frl/';
	$tld_menu_url = 'https://nic.frl/';
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
	$tld_terms_of_service_url = 'https://www.sidn.nl/en/nl-domain-name/general-terms-and-conditions-for-nl-registrants';
	$tld_privacy_policy_url = 'https://www.sidn.nl/en/nl-domain-name/sidn-and-privacy';
	$tld_menu_url = 'https://www.sidn.nl/en/theme/domain-names';
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
	$tld_terms_of_service_url = 'https://www.sidn.nl/en/nl-domain-name/general-terms-and-conditions-for-nl-registrants';
	$tld_privacy_policy_url = 'https://www.sidn.nl/en/nl-domain-name/sidn-and-privacy';
	$tld_menu_url = 'https://www.sidn.nl/en/theme/domain-names';
	$registrant_web_id = 'NL88COMM01234567890123456789012345';
}
elseif ($inputtld == 'eu')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$upon_termination = "40-day quarantine phase for .eu domains.";
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
	$tld_terms_of_service_url = 'https://help.eurid.eu/hc/en-gb/';
	$tld_menu_url = 'https://help.eurid.eu/hc/en-gb/';
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
	$tld_terms_of_service_url = 'https://www.denic.de/';
	$tld_menu_url = 'https://www.denic.de/';
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
	$tld_terms_of_service_url = 'https://www.afnic.fr/';
	$tld_menu_url = 'https://www.afnic.fr/';
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
	$tld_terms_of_service_url = 'https://www.nic.ch/';
	$tld_menu_url = 'https://www.nic.ch/';
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
	$tld_terms_of_service_url = 'https://www.nic.li/';
	$tld_menu_url = 'https://www.nic.li/';
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
	$tld_terms_of_service_url = 'https://www.dnsbelgium.be/';
	$tld_menu_url = 'https://www.dnsbelgium.be/';
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
	$tld_terms_of_service_url = 'https://restena.lu/';
	$tld_menu_url = 'https://restena.lu/';
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
	$tld_terms_of_service_url = 'https://nominet.uk/';
	$tld_menu_url = 'https://nominet.uk/';
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
	$tld_terms_of_service_url = 'https://www.icann.org/privacy/tos';
	$tld_privacy_policy_url = 'https://www.icann.org/privacy/policy';
	$tld_menu_url = 'https://www.verisigninc.com/';
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
	$tld_terms_of_service_url = 'https://www.icann.org/privacy/tos';
	$tld_privacy_policy_url = 'https://www.icann.org/privacy/policy';
	$tld_menu_url = '';
}
$tld_delegation_url = 'https://www.iana.org/domains/root/db/'.$inputtld.'.html';		
$decoded = json_decode($tld_contacts_json, true);
$tld_contacts = '<b>tld_contacts</b><br />';   
foreach ($decoded as $contact) {
	if (strlen($contact['contact_legal_name']) or strlen($contact['contact_presented_name']))	{	
		$tld_contacts .= '<b>&bull; </b><em>'.$contact['contact_identifier'] . ':</em><br />';
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
	
$decoded = json_decode($zone_accepted_workload_json, true);
$zone_accepted_workload = '<b>zone_accepted_workload</b><br />';    
foreach ($decoded as $workload_entry) {
    foreach ($workload_entry as $request_type => $limits) {
        $zone_accepted_workload .= '<b>&bull; </b><em>' . htmlspecialchars($request_type) . ':</em><br />';
        foreach ($limits as $limit_type => $limit_value) {
            $display_value = $limit_value !== null ? htmlspecialchars($limit_value) : 'none';
            $zone_accepted_workload .= htmlspecialchars($limit_type) . ': ' . $display_value . '<br />';
        }	
    }	
}
	
$arr = array();
	
$arr[$inputtld]['notices']['notice_0_title'] = $notice_0_title;	
$arr[$inputtld]['notices']['notice_0_description_0'] = $notice_0_description_0;
$arr[$inputtld]['notices']['notice_0_description_1'] = $notice_0_description_1;
$arr[$inputtld]['notices']['notice_0_links_0_href'] = $notice_0_links_0_href;
$arr[$inputtld]['notices']['notice_0_links_0_type'] = $notice_0_links_0_type;
	
$arr[$inputtld]['notices']['notice_1_title'] = $notice_1_title;	
$arr[$inputtld]['notices']['notice_1_description_0'] = $notice_1_description_0;
$arr[$inputtld]['notices']['notice_1_description_1'] = $notice_1_description_1;
$arr[$inputtld]['notices']['notice_1_links_0_href'] = $notice_1_links_0_href;
$arr[$inputtld]['notices']['notice_1_links_0_type'] = $notice_1_links_0_type;
	
$arr[$inputtld]['notices']['notice_2_title'] = $notice_2_title;	
$arr[$inputtld]['notices']['notice_2_description_0'] = $notice_2_description_0;
$arr[$inputtld]['notices']['notice_2_description_1'] = $notice_2_description_1;
$arr[$inputtld]['notices']['notice_2_links_0_href'] = $notice_2_links_0_href;
$arr[$inputtld]['notices']['notice_2_links_0_type'] = $notice_2_links_0_type;
	
$arr[$inputtld]['notices']['notice_3_title'] = $notice_3_title;	
$arr[$inputtld]['notices']['notice_3_description_0'] = $notice_3_description_0;
$arr[$inputtld]['notices']['notice_3_description_1'] = $notice_3_description_1;
$arr[$inputtld]['notices']['notice_3_links_0_href'] = $notice_3_links_0_href;
$arr[$inputtld]['notices']['notice_3_links_0_type'] = $notice_3_links_0_type;	
	
$arr[$inputtld]['links']['links_0_value'] = $links_0_value;		
$arr[$inputtld]['links']['links_0_related'] = $links_0_related;		
$arr[$inputtld]['links']['links_0_href'] = $links_0_href;		
$arr[$inputtld]['links']['links_0_href_lang'] = $links_0_href_lang;			
$arr[$inputtld]['links']['links_0_title'] = $links_0_title;	
$arr[$inputtld]['links']['links_0_media'] = $links_0_media;	
$arr[$inputtld]['links']['links_0_type'] = $links_0_type;

$arr[$inputtld]['links']['links_1_value'] = $links_1_value;		
$arr[$inputtld]['links']['links_1_related'] = $links_1_related;		
$arr[$inputtld]['links']['links_1_href'] = $links_1_href;		
$arr[$inputtld]['links']['links_1_href_lang'] = $links_1_href_lang;			
$arr[$inputtld]['links']['links_1_title'] = $links_1_title;	
$arr[$inputtld]['links']['links_1_media'] = $links_1_media;	
$arr[$inputtld]['links']['links_1_type'] = $links_1_type;
	
$arr[$inputtld]['links']['links_2_value'] = $links_2_value;		
$arr[$inputtld]['links']['links_2_related'] = $links_2_related;		
$arr[$inputtld]['links']['links_2_href'] = $links_2_href;		
$arr[$inputtld]['links']['links_2_href_lang'] = $links_2_href_lang;			
$arr[$inputtld]['links']['links_2_title'] = $links_2_title;	
$arr[$inputtld]['links']['links_2_media'] = $links_2_media;	
$arr[$inputtld]['links']['links_2_type'] = $links_2_type;
	
$arr[$inputtld]['links']['links_3_value'] = $links_3_value;		
$arr[$inputtld]['links']['links_3_related'] = $links_3_related;		
$arr[$inputtld]['links']['links_3_href'] = $links_3_href;		
$arr[$inputtld]['links']['links_3_href_lang'] = $links_3_href_lang;			
$arr[$inputtld]['links']['links_3_title'] = $links_3_title;	
$arr[$inputtld]['links']['links_3_media'] = $links_3_media;	
$arr[$inputtld]['links']['links_3_type'] = $links_3_type;	
	
$arr[$inputtld]['common']['root_services_url'] = $root_services_url;
$arr[$inputtld]['common']['root_zones_url'] = $root_zones_url;
$arr[$inputtld]['common']['lookup_endpoints_url'] = $lookup_endpoints_url;
$arr[$inputtld]['common']['registrar_accreditations_url'] = $registrar_accreditations_url;		
$arr[$inputtld]['common']['tld_roles'] = $tld_roles;
$arr[$inputtld]['common']['root_accepted_workload'] = $root_accepted_workload;	
	
$arr[$inputtld]['root_zone']['zone_identifier'] = $inputtld;
$arr[$inputtld]['root_zone']['data_active_from'] = $root_zone_data_active_from;	
$arr[$inputtld]['root_zone']['tld_category'] = $tld_category;
$arr[$inputtld]['root_zone']['tld_type'] = $tld_type;
$arr[$inputtld]['root_zone']['tld_ascii_name'] = $tld_ascii_name;
$arr[$inputtld]['root_zone']['tld_unicode_name'] = $tld_unicode_name;	
$arr[$inputtld]['root_zone']['tld_statuses'] = $root_zone_statuses;		
$arr[$inputtld]['root_zone']['tld_delegation_url'] = $tld_delegation_url;	
$arr[$inputtld]['root_zone']['tld_json_response_url'] = $tld_json_response_url;
$arr[$inputtld]['root_zone']['tld_terms_of_service_url'] = $tld_terms_of_service_url;
$arr[$inputtld]['root_zone']['tld_privacy_policy_url'] = $tld_privacy_policy_url;
$arr[$inputtld]['root_zone']['tld_menu_url'] = $tld_menu_url;
$arr[$inputtld]['root_zone']['tld_contacts'] = $tld_contacts;
$arr[$inputtld]['root_zone']['zone_roles'] = $zone_roles;
$arr[$inputtld]['root_zone']['zone_accepted_workload'] = $zone_accepted_workload;

$arr[$inputtld]['lifecycle']['data_active_from'] = $lifecycle_data_active_from;
$arr[$inputtld]['lifecycle']['upon_termination'] = $upon_termination;
$arr[$inputtld]['lifecycle']['zone_status_meanings'] = $zone_status_meanings;	
$arr[$inputtld]['lifecycle']['periods'] = $periods;
	
$arr[$inputtld]['name_servers']['entry_handles'] = $name_servers_handles;
$arr[$inputtld]['name_servers']['ascii_names'] = $name_servers_ascii;
$arr[$inputtld]['name_servers']['unicode_names'] = $name_servers_unicode;	
$arr[$inputtld]['name_servers']['ipv4_addresses'] = $name_servers_ipv4;	
$arr[$inputtld]['name_servers']['ipv6_addresses'] = $name_servers_ipv6;	
$arr[$inputtld]['name_servers']['dnssec_signed'] = $name_servers_dnssec_signed;
$arr[$inputtld]['name_servers']['dnssec_algorithm'] = $name_servers_dnssec_algorithm;
$arr[$inputtld]['name_servers']['dnssec_record'] = $name_servers_dnssec_record;

return $arr;
}
?>