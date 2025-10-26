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
$name_servers_statuses = '';	
$name_servers_dnssec_signed = '';
$name_servers_dnssec_key_tag = '';	
$name_servers_dnssec_algorithm = '';
$name_servers_dnssec_digest_type = '';
$name_servers_dnssec_digest = '';	
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
				elseif ($key3 == 'status')	{
					$name_servers_statuses .= $key2.': '.$value3[0]."<br />";	
				}
			}
			if ($key1 == 'secureDNS')	{
				if ($key2 == 'dsData') {
					$name_servers_dnssec_key_tag .= $key3.': '.$value3['keyTag']."<br />";	
					$name_servers_dnssec_algorithm .= $key3.': '.$value3['algorithm']."<br />";	
					$name_servers_dnssec_digest_type .= $key3.': '.$value3['digestType']."<br />";	
					$name_servers_dnssec_digest .= $key3.': '.$value3['digest']."<br />";
				}				
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
$root_terms_of_service_url = 'https://www.icann.org/en/data-protection/terms-of-service';
$root_privacy_policy_url = 'https://www.icann.org/privacy/policy';	
$registrar_accreditations_url = 'https://www.iana.org/assignments/registrar-ids/registrar-ids.xhtml';
$lookup_endpoints_url = 'https://data.iana.org/rdap/dns.json';
$tld_category = '';
$tld_type = '';
$tld_terms_of_service_url = '';
$tld_privacy_policy_url = '';	
$tld_menu_url = '';
$tld_search_engine_deletion_phase_ready = 'n/a';	
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
$indeterminate_rdap_statuses_json = '{
  "indeterminate_rdap_statuses": [
    "locked",
    "renew prohibited",
    "transfer prohibited",
    "update prohibited",
    "delete prohibited",
    "removed",
    "obscured",
    "private",
    "proxy",
    "associated"
  ]
}';
$decoded = json_decode($indeterminate_rdap_statuses_json, true);
$indeterminate_rdap_statuses = ''; 
$indeterminate_rdap_statuses .=	implode('<br />', $decoded['indeterminate_rdap_statuses']);
$best_practices_periods_json = '[
	{"period_identifier": "subscription_years", "min": 1, "max": 10, "optimal": 1},
	{"period_identifier": "add_grace_days", "min": 5, "max": 5, "optimal": 5},
	{"period_identifier": "transfer_grace_days", "min": 5, "max": 5, "optimal": 5},
	{"period_identifier": "renew_grace_days", "min": 5, "max": 45, "optimal": 30},
	{"period_identifier": "post_transfer_lock_days", "min": 60, "max": 60, "optimal": 60},
	{"period_identifier": "pending_redemption_days", "min": 30, "max": 30, "optimal": 30},
	{"period_identifier": "pending_delete_days", "min": 5, "max": 5, "optimal": 5}
]';
$decoded = json_decode($best_practices_periods_json, true);	
$best_practices_periods = '';    
foreach ($decoded as $period) {
	$best_practices_periods .= $period['period_identifier'] . ': min ' . $period['min'] . ', max ' . $period['max'] .  ', optimal ' . $period['optimal'] . '<br />';
}	
$root_accepted_workload_json = '[{
	"public_status_requests": {
		"maximum_per_utc_day": null,
		"maximum_per_minute": null,
		"maximum_per_second": null,
		"caching_in_seconds": null
	},
 		"public_object_requests": {
   		"maximum_per_utc_day": null,
   		"maximum_per_minute": null,
   		"maximum_per_second": null,
   		"caching_in_seconds": null
	}
}]';
$decoded = json_decode($root_accepted_workload_json, true);
$root_accepted_workload = '';    
foreach ($decoded as $workload_entry) {
    foreach ($workload_entry as $request_type => $limits) {
        $root_accepted_workload .= '<b>&bull; </b><em>' . htmlspecialchars($request_type) . ':</em><br />';
        foreach ($limits as $limit_type => $limit_value) {
            $display_value = $limit_value !== null ? htmlspecialchars($limit_value) : 'n/a';
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
$operational_periods_json = '[
	{"period_identifier": "subscription_years", "default": null, "allowed": null},
	{"period_identifier": "add_grace_days", "default": null, "allowed": null},
	{"period_identifier": "transfer_grace_days", "default": null, "allowed": null},
	{"period_identifier": "renew_grace_days", "default": null, "allowed": null},
	{"period_identifier": "post_transfer_lock_days", "default": null, "allowed": null},
	{"period_identifier": "pending_redemption_days", "default": null, "allowed": null},
	{"period_identifier": "pending_delete_days", "default": null, "allowed": null}
]';
$zone_accepted_workload_json = '[{
	"public_status_requests": {
		"maximum_per_utc_day": null,
		"maximum_per_minute": null,
		"maximum_per_second": null,
		"caching_in_seconds": null
	},
 		"public_object_requests": {
   		"maximum_per_utc_day": null,
   		"maximum_per_minute": null,
   		"maximum_per_second": null,
   		"caching_in_seconds": null
	}
}]';	
if ($inputtld == 'nl')	{
	$tld_category = 'ccTLD';
	$tld_type = 'ccTLD';
	$upon_termination = "40-day quarantine for .nl";
	$operational_periods_json = '[
		{"period_identifier": "subscription_years", "default": 1, "allowed": [1]},
		{"period_identifier": "add_grace_days", "default": null, "allowed": null},
		{"period_identifier": "transfer_grace_days", "default": null, "allowed": null},
		{"period_identifier": "renew_grace_days", "default": null, "allowed": null},
		{"period_identifier": "post_transfer_lock_days", "default": null, "allowed": null},
		{"period_identifier": "pending_redemption_days", "default": 40, "allowed": [40]},
		{"period_identifier": "pending_delete_days", "default": 0, "allowed": [0]}
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
    		"maximum_per_utc_day": 50000,
    		"maximum_per_minute": null,
    		"maximum_per_second": 10,
    		"caching_in_seconds": 420
  		},
  		"public_object_requests": {
    		"maximum_per_utc_day": 2000,
    		"maximum_per_minute": null,
    		"maximum_per_second": 1,
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
	$upon_termination = "40-day quarantine for .eu";
	$operational_periods_json = '[
		{"period_identifier": "subscription_years", "default": 1, "allowed": [1]},
		{"period_identifier": "add_grace_days", "default": 5, "allowed": [5]},
		{"period_identifier": "transfer_grace_days", "default": null, "allowed": null},
		{"period_identifier": "renew_grace_days", "default": null, "allowed": null},
		{"period_identifier": "post_transfer_lock_days", "default": 60, "allowed": [60]},
		{"period_identifier": "pending_redemption_days", "default": 40, "allowed": [40]},
		{"period_identifier": "pending_delete_days", "default": 0, "allowed": [0]}
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
	$operational_periods_json = '[
		{"period_identifier": "subscription_years", "default": null, "allowed": null},
		{"period_identifier": "add_grace_days", "default": null, "allowed": null},
		{"period_identifier": "transfer_grace_days", "default": null, "allowed": null},
		{"period_identifier": "renew_grace_days", "default": null, "allowed": null},
		{"period_identifier": "post_transfer_lock_days", "default": null, "allowed": null},
		{"period_identifier": "pending_redemption_days", "default": 28, "allowed": [28]},
		{"period_identifier": "pending_delete_days", "default": 0, "allowed": [0]}
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
	$operational_periods_json = '[
		{"period_identifier": "subscription_years", "default": null, "allowed": null},
		{"period_identifier": "add_grace_days", "default": null, "allowed": null},
		{"period_identifier": "transfer_grace_days", "default": null, "allowed": null},
		{"period_identifier": "renew_grace_days", "default": null, "allowed": null},
		{"period_identifier": "post_transfer_lock_days", "default": null, "allowed": null},
		{"period_identifier": "pending_redemption_days", "default": 30, "allowed": [30]},
		{"period_identifier": "pending_delete_days", "default": 0, "allowed": [0]}
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
	$operational_periods_json = '[
		{"period_identifier": "subscription_years", "default": null, "allowed": null},
		{"period_identifier": "add_grace_days", "default": null, "allowed": null},
		{"period_identifier": "transfer_grace_days", "default": null, "allowed": null},
		{"period_identifier": "renew_grace_days", "default": null, "allowed": null},
		{"period_identifier": "post_transfer_lock_days", "default": null, "allowed": null},
		{"period_identifier": "pending_redemption_days", "default": 40, "allowed": [40]},
		{"period_identifier": "pending_delete_days", "default": 0, "allowed": [0]}
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
	$operational_periods_json = '[
		{"period_identifier": "subscription_years", "default": null, "allowed": null},
		{"period_identifier": "add_grace_days", "default": null, "allowed": null},
		{"period_identifier": "transfer_grace_days", "default": null, "allowed": null},
		{"period_identifier": "renew_grace_days", "default": 30, "allowed": [30]},
		{"period_identifier": "post_transfer_lock_days", "default": null, "allowed": null},
		{"period_identifier": "pending_redemption_days", "default": 60, "allowed": [60]},
		{"period_identifier": "pending_delete_days", "default": 0, "allowed": [0]}
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
	$operational_periods_json = '[
		{"period_identifier": "subscription_years", "default": 1, "allowed": [1,10]},
		{"period_identifier": "add_grace_days", "default": 5, "allowed": [5]},
		{"period_identifier": "transfer_grace_days", "default": 5, "allowed": [5]},
		{"period_identifier": "renew_grace_days", "default": 45, "allowed": [45]},
		{"period_identifier": "post_transfer_lock_days", "default": 60, "allowed": [60]},
		{"period_identifier": "pending_redemption_days", "default": 30, "allowed": [30]},
		{"period_identifier": "pending_delete_days", "default": 5, "allowed": [5]}
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
	$operational_periods_json = '[
		{"period_identifier": "subscription_years", "default": 1, "allowed": [1,10]},
		{"period_identifier": "add_grace_days", "default": 5, "allowed": [5]},
		{"period_identifier": "transfer_grace_days", "default": 5, "allowed": [5]},
		{"period_identifier": "renew_grace_days", "default": 45, "allowed": [45]},
		{"period_identifier": "post_transfer_lock_days", "default": 60, "allowed": [60]},
		{"period_identifier": "pending_redemption_days", "default": 30, "allowed": [30]},
		{"period_identifier": "pending_delete_days", "default": 5, "allowed": [5]}
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
$tld_contacts = '';   
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
$decoded = json_decode($operational_periods_json, true);
$operational_periods = '';
foreach ($decoded as $period) {
	$operational_periods .= $period['period_identifier'] . ':';
	if ($period['default'] !== null)	{
		$operational_periods .= ' default ';
		$operational_periods .= (is_array($period['default'])) ? implode(',', $period['default']) : $period['default'];
	}
	if ($period['allowed'] !== null)	{
		$operational_periods .= ', allowed ';
		$operational_periods .= (is_array($period['allowed'])) ? implode(',', $period['allowed']): $period['allowed'];
	}
	if ($period['default'] == null and $period['allowed'] == null)	{
		$operational_periods .= ' n/a';
	}	
	$operational_periods .= '<br />';
}	
$resource_upload_at = null;
$status_meanings_json = '[
    {
        "pending_redemption": {
            "description": "Recoverable",
            "phase": "post-expiration",
            "recoverable": true,
            "final": false
        },
        "pending_delete": {
            "description": "Final stage",
            "phase": "pre-deletion",
            "recoverable": false,
            "final": true
		}	
    }
]';
		//"transfer prohibited": {
        //   "description": "server_transfer_prohibited",
        //    "phase": "active"
        //},
		//"locked": {
        //    "description": "server_protected_state",
        //    "phase": "active"
        //},		
		//"inactive": {
        //    "description": "dns_glue_tld_nameservers",
        //    "phase": "active"
        //},		
		//"excluded": {
        //    "description": "server_registration_restricted",
		//	"phase": "inactive"
        //}	
	
	
$decoded = json_decode($status_meanings_json, true);
$status_meanings = '';
foreach ($decoded as $statuses) {
    foreach ($statuses as $key => $value) {	//ucwords()
        $status_meanings .= '"' . htmlspecialchars($key) . '": ';
        $status_meanings .= htmlspecialchars($value['description']);
        $status_meanings .= " (" . htmlspecialchars($value['phase']) . " phase)<br />";
    }
}	
	
$decoded = json_decode($zone_accepted_workload_json, true);
$zone_accepted_workload = '';    
foreach ($decoded as $workload_entry) {
    foreach ($workload_entry as $request_type => $limits) {
        $zone_accepted_workload .= '<b>&bull; </b><em>' . htmlspecialchars($request_type) . ':</em><br />';
        foreach ($limits as $limit_type => $limit_value) {
            $display_value = $limit_value !== null ? htmlspecialchars($limit_value) : 'n/a';
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
$arr[$inputtld]['common']['root_terms_of_service_url'] = $root_terms_of_service_url;
$arr[$inputtld]['common']['root_privacy_policy_url'] = $root_privacy_policy_url;	
$arr[$inputtld]['common']['lookup_endpoints_url'] = $lookup_endpoints_url;
$arr[$inputtld]['common']['registrar_accreditations_url'] = $registrar_accreditations_url;	
$arr[$inputtld]['common']['tld_roles'] = $tld_roles;
$arr[$inputtld]['common']['indeterminate_rdap_statuses'] = $indeterminate_rdap_statuses;
$arr[$inputtld]['common']['best_practices_periods'] = $best_practices_periods;		
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
$arr[$inputtld]['root_zone']['tld_search_engine_deletion_phase_ready'] = $tld_search_engine_deletion_phase_ready;
$arr[$inputtld]['root_zone']['tld_contacts'] = $tld_contacts;
$arr[$inputtld]['root_zone']['zone_roles'] = $zone_roles;
$arr[$inputtld]['root_zone']['zone_accepted_workload'] = $zone_accepted_workload;

$arr[$inputtld]['lifecycle']['data_active_from'] = $lifecycle_data_active_from;
$arr[$inputtld]['lifecycle']['upon_termination'] = $upon_termination;
$arr[$inputtld]['lifecycle']['status_meanings'] = $status_meanings;	
$arr[$inputtld]['lifecycle']['operational_periods'] = $operational_periods;
	
$arr[$inputtld]['name_servers']['handles'] = $name_servers_handles;
$arr[$inputtld]['name_servers']['ascii_names'] = $name_servers_ascii;
$arr[$inputtld]['name_servers']['unicode_names'] = $name_servers_unicode;	
$arr[$inputtld]['name_servers']['ipv4_addresses'] = $name_servers_ipv4;	
$arr[$inputtld]['name_servers']['ipv6_addresses'] = $name_servers_ipv6;
$arr[$inputtld]['name_servers']['statuses'] = $name_servers_statuses;
$arr[$inputtld]['name_servers']['dnssec_signed'] = $name_servers_dnssec_signed;
$arr[$inputtld]['name_servers']['dnssec_key_tag'] = $name_servers_dnssec_key_tag;
$arr[$inputtld]['name_servers']['dnssec_algorithm'] = $name_servers_dnssec_algorithm;
$arr[$inputtld]['name_servers']['dnssec_digest_type'] = $name_servers_dnssec_digest_type;
$arr[$inputtld]['name_servers']['dnssec_digest'] = $name_servers_dnssec_digest;

return $arr;
}
?>