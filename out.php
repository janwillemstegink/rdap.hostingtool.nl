<?php
$inputPathAndFile = '/home/admin/whois_file/example.xml';
$inputFile = 'example.xml';
if (file_exists($inputPathAndFile))	{
	$xml = simplexml_load_file($inputPathAndFile);
	file_get_contents($inputPathAndFile);
}
elseif (file_exists($inputFile))	{
	$xml = simplexml_load_file($inputFile);
	file_get_contents($inputFile);	
}	
else	{
	die('The XML file was not found.');	
}
$html_text = '<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="robots" content="noindex"><title>Whois for Public</title></head>
<body><div style="border-spacing=0; padding=0; border-width=0; padding-bottom:5px; line-height:120%;">
<table style="border-collapse:collapse; font-family:Helvetica, Arial, sans-serif; font-size:13px; width:570px; max-width:570px;">
<tr><th style="width:40%"></th><th style="width:60%"></th></tr>';
foreach ($xml->xpath('//domain') as $item)	{
	simplexml_load_string($item->asXML());
	$html_text .= '<tr><td>domain_id</td><td>'.$item->domain_id.'</td></tr>';
	$html_text .= '<tr><td>domain_name</td><td>'.$item->domain_name.'</td></tr>';
	$html_text .= '<tr><td>domain_view_datetime</td><td>'.$item->domain_view_datetime.'</td></tr>';
	$html_text .= '<tr><td>domain_view_type</td><td>'.$item->domain_view_type.'</td></tr>';
	$html_text .= '<tr><td>domain_status</td><td>'.$item->domain_status.'</td></tr>';
	$html_text .= '<tr><td>domain_creation</td><td>'.$item->domain_creation.'</td></tr>';
	$html_text .= '<tr><td>domain_last_renewal</td><td>'.$item->domain_last_renewal.'</td></tr>';
	$html_text .= '<tr><td>domain_updated</td><td>'.$item->domain_updated.'</td></tr>';
	$html_text .= '<tr><td>domain_expiration</td><td>'.$item->domain_expiration.'</td></tr>';
	$html_text .= '<tr><td>domain_out_of_quarantine</td><td>'.$item->domain_out_of_quarantine.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td>registrar_contact_id</td><td>'.$item->registrar->registrar_contact_id.'</td></tr>';
	$html_text .= '<tr><td>registrar_name</td><td>'.$item->registrar->registrar_name.'</td></tr>';
	$html_text .= '<tr><td>registrar_web_id</td><td>'.$item->registrar->registrar_web_id.'</td></tr>';
	$html_text .= '<tr><td>registrar_abuse_email</td><td>'.$item->registrar->registrar_abuse_email.'</td></tr>';
	$html_text .= '<tr><td>registrar_abuse_phone</td><td>'.$item->registrar->registrar_abuse_phone.'</td></tr>';
	$html_text .= '<tr><td>registrar_street</td><td>'.$item->registrar->registrar_street.'</td></tr>';
	$html_text .= '<tr><td>registrar_postal_code</td><td>'.$item->registrar->registrar_postal_code.'</td></tr>';
	$html_text .= '<tr><td>registrar_city</td><td>'.$item->registrar->registrar_city.'</td></tr>';
	$html_text .= '<tr><td>registrar_country_code</td><td>'.$item->registrar->registrar_country_code.'</td></tr>';
	$html_text .= '<tr><td>registrar_country_name</td><td>'.$item->registrar->registrar_country_name.'</td></tr>';
	$html_text .= '<tr><td>registrar_country_language</td><td>'.$item->registrar->registrar_country_language.'</td></tr>';
	$html_text .= '<tr><td>registrar_whois_server</td><td>'.$item->registrar->registrar_whois_server.'</td></tr>';
	$html_text .= '<tr><td>registrar_url</td><td>'.$item->registrar->registrar_url.'</td></tr>';
	$html_text .= '<tr><td>registrar_iana_id</td><td>'.$item->registrar->registrar_iana_id.'</td></tr>';
	$html_text .= '<tr><td>registrar_held_back</td><td>'.$item->registrar->registrar_held_back.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td>reseller_contact_id</td><td>'.$item->reseller->reseller_contact_id.'</td></tr>';
	$html_text .= '<tr><td>reseller_name</td><td>'.$item->reseller->reseller_name.'</td></tr>';
	$html_text .= '<tr><td>reseller_web_id</td><td>'.$item->reseller->reseller_web_id.'</td></tr>';
	$html_text .= '<tr><td>reseller_street</td><td>'.$item->reseller->reseller_street.'</td></tr>';
	$html_text .= '<tr><td>reseller_postal_code</td><td>'.$item->reseller->reseller_postal_code.'</td></tr>';
	$html_text .= '<tr><td>reseller_city</td><td>'.$item->reseller->reseller_city.'</td></tr>';
	$html_text .= '<tr><td>reseller_country_code</td><td>'.$item->reseller->reseller_country_code.'</td></tr>';
	$html_text .= '<tr><td>reseller_country_name</td><td>'.$item->reseller->reseller_country_name.'</td></tr>';
	$html_text .= '<tr><td>reseller_country_language</td><td>'.$item->reseller->reseller_country_language.'</td></tr>';
	$html_text .= '<tr><td>reseller_held_back</td><td>'.$item->reseller->reseller_held_back.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td>registrant_holder_contact_id</td><td>'.$item->registrant->registrant_holder_contact_id.'</td></tr>';
	$html_text .= '<tr><td><b>registrant_holder_name</b></td><td><b>'.$item->registrant->registrant_holder_name.'</b></td></tr>';
	$html_text .= '<tr><td><b>registrant_holder_business_use</b></td><td><b>'.$item->registrant->registrant_holder_business_use.'</b></td></tr>';
	$html_text .= '<tr><td><b>registrant_holder_web_id</b></td><td><b>'.$item->registrant->registrant_holder_web_id.'</b></td></tr>';
	$html_text .= '<tr><td>registrant_holder_street</td><td>'.$item->registrant->registrant_holder_street.'</td></tr>';
	$html_text .= '<tr><td>registrant_holder_postal_code</td><td>'.$item->registrant->registrant_holder_postal_code.'</td></tr>';
	$html_text .= '<tr><td>registrant_holder_city</td><td>'.$item->registrant->registrant_holder_city.'</td></tr>';
	$html_text .= '<tr><td>registrant_holder_country_code</td><td>'.$item->registrant->registrant_holder_country_code.'</td></tr>';
	$html_text .= '<tr><td>registrant_holder_country_name</td><td>'.$item->registrant->registrant_holder_country_name.'</td></tr>';
	$html_text .= '<tr><td>registrant_holder_country_language</td><td>'.$item->registrant->registrant_holder_country_language.'</td></tr>';
	$html_text .= '<tr><td>registrant_holder_held_back</td><td>'.$item->registrant->registrant_holder_held_back.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td>admin_email</td><td>'.$item->admin->admin_email.'</td></tr>';
	$html_text .= '<tr><td>admin_held_back</td><td>'.$item->admin->admin_held_back.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
	if (strlen(trim($item->tech->contact_1->tech_email_1)))	{	
		$html_text .= '<tr><td>tech_contact_id_1</td><td>'.$item->tech->contact_1->tech_contact_id_1.'</td></tr>';
		$html_text .= '<tr><td>tech_email_1</td><td>'.$item->tech->contact_1->tech_email_1.'</td></tr>';
		$html_text .= '<tr><td>tech_held_back_1</td><td>'.$item->tech->contact_1->tech_held_back_1.'</td></tr>';
	}
	if (strlen(trim($item->tech->contact_2->tech_email_2)))	{	
		$html_text .= '<tr><td>tech_contact_id_2</td><td>'.$item->tech->contact_2->tech_contact_id_2.'</td></tr>';
		$html_text .= '<tr><td>tech_email_2</td><td>'.$item->tech->contact_2->tech_email_2.'</td></tr>';
		$html_text .= '<tr><td>tech_held_back_2</td><td>'.$item->tech->contact_2->tech_held_back_2.'</td></tr>';
	}
	if (strlen(trim($item->tech->contact_3->tech_email_3)))	{	
		$html_text .= '<tr><td>tech_contact_id_3</td><td>'.$item->tech->contact_3->tech_contact_id_3.'</td></tr>';
		$html_text .= '<tr><td>tech_email_3</td><td>'.$item->tech->contact_3->tech_email_3.'</td></tr>';
		$html_text .= '<tr><td>tech_held_back_3</td><td>'.$item->tech->contact_3->tech_held_back_3.'</td></tr>';
	}
	if (strlen(trim($item->tech->contact_4->tech_email_4)))	{	
		$html_text .= '<tr><td>tech_contact_id_4</td><td>'.$item->tech->contact_4->tech_contact_id_4.'</td></tr>';
		$html_text .= '<tr><td>tech_email_4</td><td>'.$item->tech->contact_4->tech_email_4.'</td></tr>';
		$html_text .= '<tr><td>tech_held_back_4</td><td>'.$item->tech->contact_4->tech_held_back_4.'</td></tr>';
	}	
	$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
	if (strlen(trim($item->name_servers->server_1->server_name_1)))	{
		$html_text .= '<tr><td>server_name_1</td><td>'.$item->name_servers->server_1->server_name_1.'</td></tr>';
		$html_text .= '<tr><td>ipv4_1</td><td>'.$item->name_servers->server_1->ipv4_1.'</td></tr>';
		$html_text .= '<tr><td>ipv6_1</td><td>'.$item->name_servers->server_1->ipv6_1.'</td></tr>';
	}
	if (strlen(trim($item->name_servers->server_2->server_name_2)))	{
		$html_text .= '<tr><td>server_name_2</td><td>'.$item->name_servers->server_2->server_name_2.'</td></tr>';
		$html_text .= '<tr><td>ipv4_2</td><td>'.$item->name_servers->server_2->ipv4_2.'</td></tr>';
		$html_text .= '<tr><td>ipv6_2</td><td>'.$item->name_servers->server_2->ipv6_2.'</td></tr>';
	}
	if (strlen(trim($item->name_servers->server_3->server_name_3)))	{
		$html_text .= '<tr><td>server_name_3</td><td>'.$item->name_servers->server_3->server_name_3.'</td></tr>';
		$html_text .= '<tr><td>ipv4_3</td><td>'.$item->name_servers->server_3->ipv4_3.'</td></tr>';
		$html_text .= '<tr><td>ipv6_3</td><td>'.$item->name_servers->server_3->ipv6_3.'</td></tr>';
	}
	if (strlen(trim($item->name_servers->server_4->server_name_4)))	{
		$html_text .= '<tr><td>server_name_4</td><td>'.$item->name_servers->server_4->server_name_4.'</td></tr>';
		$html_text .= '<tr><td>ipv4_4</td><td>'.$item->name_servers->server_4->ipv4_4.'</td></tr>';
		$html_text .= '<tr><td>ipv6_4</td><td>'.$item->name_servers->server_4->ipv6_4.'</td></tr>';
	}
	if (strlen(trim($item->name_servers->server_5->server_name_5)))	{
		$html_text .= '<tr><td>server_name_5</td><td>'.$item->name_servers->server_5->server_name_5.'</td></tr>';
		$html_text .= '<tr><td>ipv4_5</td><td>'.$item->name_servers->server_5->ipv4_5.'</td></tr>';
		$html_text .= '<tr><td>ipv6_5</td><td>'.$item->name_servers->server_5->ipv6_5.'</td></tr>';
	}
	if (strlen(trim($item->name_servers->server_6->server_name_6)))	{
		$html_text .= '<tr><td>server_name_6</td><td>'.$item->name_servers->server_6->server_name_6.'</td></tr>';
		$html_text .= '<tr><td>ipv4_6</td><td>'.$item->name_servers->server_6->ipv4_6.'</td></tr>';
		$html_text .= '<tr><td>ipv6_6</td><td>'.$item->name_servers->server_6->ipv6_6.'</td></tr>';
	}
	$html_text .= '<tr><td>name_servers_dnssec</td><td>'.$item->name_servers->name_servers_dnssec.'</td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td>registry_description</td><td>'.$item->data_management->registry_description.'</td></tr>';
	$html_text .= '<tr><td>registry_language</td><td>'.$item->data_management->registry_language.'</td></tr>';
	$html_text .= '<tr><td>registry_format</td><td>'.$item->data_management->registry_format.'</td></tr>';
	$html_text .= '<tr><td>restrictions_legally</td><td>'.$item->data_management->restrictions_legally.'</td></tr>';
	$html_text .= '<tr><td>restrictions_translated</td><td>'.$item->data_management->restrictions_translated.'</td></tr>';		
	$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
	$html_text .= '<tr><td><hr></td><td><hr></td></tr>';
}
$html_text .= '</table></div></body></html>';
echo $html_text;
?>