-- Registry Table Definitions for PostgreSQL.
-- Prepared for implementation on global RDAP servers and migration to the next RDAP version.
-- Created in the Netherlands, May 16, 2025.

-- ========================================
-- Table: tld_categories
-- Description: Stores TLD category types
-- ========================================
CREATE EXTENSION IF NOT EXISTS citext;

CREATE TABLE tld_categories (
	tld_category_id SERIAL PRIMARY KEY,
	tld_category_identifier VARCHAR(20) UNIQUE
);

-- =======================
-- Table: tld_types
-- =======================
CREATE TABLE tld_types (
	tld_type_id SERIAL PRIMARY KEY,
	tld_type_identifier VARCHAR(20) UNIQUE
);

-- =======================
-- Table: common
-- =======================
CREATE TABLE common (
	common_id SERIAL PRIMARY KEY,
	common_root_services_url TEXT,
	common_root_zones_url TEXT,
	common_accredited_registrars_url TEXT,
	common_tld_roles JSONB DEFAULT 
		'[
			{"tld_role_sequence": 10,"tld_role_identifier": "contracting_authority","tld_role_shielding": ["name","tel"]},
			{"tld_role_sequence": 20,"tld_role_identifier": "contracting_organization","tld_role_shielding": ["name", "tel"]},
			{"tld_role_sequence": 30,"tld_role_identifier": "sponsoring_organization","tld_role_shielding": ["name", "tel"]},
			{"tld_role_sequence": 40,"tld_role_identifier": "country_code_designated_manager","tld_role_shielding": ["name", "tel"]},
			{"tld_role_sequence": 50,"tld_role_identifier": "registry_operator","tld_role_shielding": []},
			{"tld_role_sequence": 60,"tld_role_identifier": "backend_operator","tld_role_shielding": []}
		]',
	common_root_accepted_workload JSONB DEFAULT 
		'[
			{
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
			}
		]'
);

-- =======================
-- Table: contacts
-- =======================
CREATE TABLE contacts (
    contact_id SERIAL PRIMARY KEY,
	contact_handle TEXT NOT NULL UNIQUE,
	contact_web_id VARCHAR(34),
    contact_organization_name VARCHAR(511),
	contact_presented_name VARCHAR(511),
    contact_name TEXT,
    contact_email CITEXT,
    contact_phone VARCHAR(50),
    contact_fax VARCHAR(50),
    contact_country_code CHAR(2),
    contact_street_address TEXT,
    contact_city TEXT,
    contact_state_or_province TEXT,
    contact_postal_code VARCHAR(20),
    contact_country_name TEXT,
    contact_latest_update_at TIMESTAMPTZ
);

-- =======================
-- Table: zones
-- Stores full top-level domain (TLD) labels, e.g., 'com', 'co.uk', or 'ac.jp'
-- Includes registry and backend operator metadata for each zone
-- Defines visibility per role (e.g., registrant, technical)
-- role_shielding determines what is hidden in RDAP output depending on TLD policy
-- Clustered roles are deprecated in RDAP output to allow proper role_shielding of fields.
-- =======================
CREATE TABLE zones (
    zone_id SERIAL PRIMARY KEY,
    zone_identifier CITEXT NOT NULL,
	zone_data_active_from TIMESTAMPTZ,
	zone_tld_category VARCHAR(20) NOT NULL,
    zone_tld_type VARCHAR(20) NOT NULL,
	zone_tld_statuses TEXT[],
	zone_tld_delegation_url TEXT,
	zone_tld_json_response_url TEXT,
	zone_tld_terms_of_service_url TEXT,
	zone_tld_privacy_policy_url TEXT,
    zone_tld_menu_url TEXT,
    zone_zone_roles JSONB DEFAULT 
        '[
            {"zone_role_sequence": 10, "zone_role_identifier": "sponsor", "zone_role_shielding": ["name", "email", "tel"]},
            {"zone_role_sequence": 20, "zone_role_identifier": "registrant", "zone_role_shielding": ["name", "email", "tel", "address"]},
            {"zone_role_sequence": 30, "zone_role_identifier": "administrative", "zone_role_shielding": ["web_id", "name", "tel", "address"]},
            {"zone_role_sequence": 40, "zone_role_identifier": "technical", "zone_role_shielding": ["web_id", "name", "tel", "address"]},
            {"zone_role_sequence": 50, "zone_role_identifier": "billing", "zone_role_shielding": ["web_id", "name", "email", "tel", "address"]},
            {"zone_role_sequence": 60, "zone_role_identifier": "emergency", "zone_role_shielding": ["name"]},
            {"zone_role_sequence": 70, "zone_role_identifier": "fallback", "zone_role_shielding": ["name"]},
            {"zone_role_sequence": 80, "zone_role_identifier": "reseller", "zone_role_shielding": ["name", "email", "tel"]},
            {"zone_role_sequence": 90, "zone_role_identifier": "registrar", "zone_role_shielding": ["name", "email", "tel"]},
            {"zone_role_sequence": 95, "zone_role_identifier": "abuse", "zone_role_shielding": ["name"]}
        ]',
	zone_zone_accepted_workload JSONB DEFAULT 
		'[
			{
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
			}
		]',
	zone_name_servers JSONB,
	zone_latest_update_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);
-- Perhaps stabilizing: FOREIGN KEY (zone_tld_category) REFERENCES tld_categories(tld_category_identifier)
-- Perhaps stabilizing: FOREIGN KEY (zone_tld_type) REFERENCES tld_types(tld_type_identifier)

CREATE UNIQUE INDEX idx_lifecycle_zone_data_active_from 
ON lifecycles(lifecycle_zone, lifecycle_data_active_from);

-- Trigger Function: Update zone_latest_update_at on UPDATE
CREATE OR REPLACE FUNCTION update_zone_latest_update_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.zone_latest_update_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_update_zone_latest_update_at
BEFORE UPDATE ON zones
FOR EACH ROW
EXECUTE FUNCTION update_zone_latest_update_at();

-- Function: get_matching_zone_identifier(domain_name)
-- Description: Returns the best matching zone_identifier (VARCHAR) for a given domain name.
-- Logic: Iteratively builds suffixes from right to left and checks for a match in the zones table.

CREATE OR REPLACE FUNCTION get_matching_zone_identifier(domain_name TEXT)
RETURNS VARCHAR AS $$
DECLARE
    suffix TEXT;
    parts TEXT[];
    i INT;
    candidate TEXT;
    match_identifier VARCHAR;
BEGIN
    -- Split domain into parts by dots
    parts := string_to_array(lower(domain_name), '.');

    -- Loop from right to left, building suffixes to find matching zone
    FOR i IN REVERSE array_lower(parts, 1)..array_upper(parts, 1) LOOP
        suffix := array_to_string(parts[i:array_upper(parts, 1)], '.');
		
		SELECT zone_identifier INTO match_identifier
		FROM zones
		WHERE zone_identifier = suffix
		ORDER BY LENGTH(zone_identifier) DESC
		LIMIT 1;

        IF match_identifier IS NOT NULL THEN
            RETURN match_identifier;
        END IF;
    END LOOP;

    RETURN NULL; -- No matching zone found
END;
$$ LANGUAGE plpgsql;

-- =======================
-- Table: lifecycles
-- =======================
CREATE TABLE lifecycles (
    lifecycle_id SERIAL PRIMARY KEY,
    lifecycle_zone VARCHAR(63) NOT NULL,
    lifecycle_data_active_from TIMESTAMPTZ,
	lifecycle_upon_termination TEXT, -- Optional: e.g., "40-day quarantine phase (.nl)"
	lifecycle_zone_status_meanings JSONB DEFAULT '[{
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
	}]';	
    lifecycle_periods JSONB DEFAULT '[
        {"period_identifier": "subscription_period", "period_minimum": "1 year", "period_maximum": "1 year"},
        {"period_identifier": "add_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "transfer_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "post_transfer_lock_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "renew_period_grace_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "redemption_period_days", "period_minimum": null, "period_maximum": null},
        {"period_identifier": "deletion_phase_days", "period_minimum": null, "period_maximum": null}
    ]',
    lifecycle_latest_update_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);

CREATE UNIQUE INDEX idx_lifecycle_zone_data_active_from 
ON lifecycles(lifecycle_zone, lifecycle_data_active_from);

-- =======================
-- Table: domains
-- JSON field specifying registrar accreditation info, e.g.,
-- [{"type": "IANA Registrar ID","identifier": "2288"}]
-- domain_extensions: Additional domain-specific data in JSON format.
-- entity_entry_handle: optional handle reference used by the registrar (or for outsourced name servers).
-- =======================
CREATE TABLE domains (
    domain_id BIGSERIAL PRIMARY KEY,
	domain_zone CITEXT NOT NULL,
    domain_zone_handle TEXT NOT NULL UNIQUE, -- starts with the zone identifier ending with e.g. '_'.
	domain_entry_handle TEXT,
	domain_ascii_name VARCHAR(511) NOT NULL,
    domain_unicode_name VARCHAR(511) NOT NULL,
	domain_zone_statuses TEXT[], -- EPP status codes applied by registry 
    domain_entry_statuses TEXT[], -- EPP status codes applied by registrar
    domain_created_at TIMESTAMPTZ,
    domain_latest_transfer_at TIMESTAMPTZ,
    domain_latest_update_at TIMESTAMPTZ,
    domain_expiration_at TIMESTAMPTZ,
    domain_recoverable_until TIMESTAMPTZ,
    domain_deletion_at TIMESTAMPTZ,
	domain_global_json_response_url VARCHAR(511),
	domain_registry_json_response_url VARCHAR(511),
	domain_registry_language_codes TEXT, -- This field remains without functional use.
	domain_registrar_accreditation JSONB DEFAULT '[]',
	domain_registrar_json_response_url VARCHAR(511),
	domain_registrar_complaint_url TEXT,
	domain_status_explanation_url TEXT,
	domain_geo_location JSONB,
    domain_extensions JSONB DEFAULT '[]', -- to phase out
	domain_remarks JSONB DEFAULT '[]' -- to phase out
);

CREATE TRIGGER trg_set_domain_zone
BEFORE INSERT OR UPDATE ON domains
FOR EACH ROW
EXECUTE FUNCTION set_domain_zone();

-- Trigger Function: Update domain_latest_update_at on UPDATE
CREATE OR REPLACE FUNCTION update_domains_latest_update_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.domain_latest_update_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_update_domains_latest_update_at
BEFORE UPDATE ON domains
FOR EACH ROW
EXECUTE FUNCTION update_domains_latest_update_at();

-- Trigger Function: Set domain_zone using get_matching_zone_identifier
CREATE OR REPLACE FUNCTION set_domain_zone()
RETURNS TRIGGER AS $$
BEGIN
    NEW.domain_zone := get_matching_zone_identifier(NEW.domain_ascii_name);
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- =======================
-- Table: entities
-- =======================
CREATE TABLE entities (
    entity_id BIGSERIAL PRIMARY KEY,
	entity_zone_handle TEXT NOT NULL UNIQUE,
    entity_entry_handle TEXT,
	entity_web_id VARCHAR(34),
    entity_organization_type TEXT,
    entity_organization_name VARCHAR(511),
    entity_presented_name VARCHAR(511),
    entity_kind TEXT,
    entity_name TEXT,
    entity_email CITEXT,
    entity_phone VARCHAR(50),
    entity_fax VARCHAR(50),
    entity_country_code CHAR(2),
    entity_street_address TEXT,
    entity_city TEXT,
    entity_state_or_province TEXT,
    entity_postal_code VARCHAR(20),
    entity_country_name TEXT,
	entity_language_pref1 VARCHAR(5),
	entity_language_pref2 VARCHAR(5),
    entity_statuses TEXT[],    
    entity_created_at TIMESTAMPTZ,
    entity_latest_update_at TIMESTAMPTZ,
    entity_verification_received_at TIMESTAMPTZ,
    entity_verification_set_at TIMESTAMPTZ,
	entity_properties JSONB DEFAULT '[]', -- to phase out
	entity_remarks JSONB DEFAULT '[]' -- to phase out
);
CREATE INDEX idx_entity_postal_code ON entities(entity_postal_code);
CREATE INDEX idx_entity_email ON entities(entity_email);
CREATE INDEX idx_entity_country_code ON entities(entity_country_code);

-- Trigger Function: Update entity_latest_update_at on UPDATE
CREATE OR REPLACE FUNCTION update_entities_latest_update_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.entity_latest_update_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_update_entities_latest_update_at
BEFORE UPDATE ON entities
FOR EACH ROW
EXECUTE FUNCTION update_entities_latest_update_at();

-- =======================
-- Table: nameservers
-- =======================
CREATE TABLE nameservers (
    nameserver_id BIGSERIAL PRIMARY KEY,
	nameserver_zone_handle TEXT NOT NULL UNIQUE,
    nameserver_entry_handle TEXT,
    nameserver_ascii_name TEXT NOT NULL,
    nameserver_unicode_name TEXT,
    nameserver_ipv4_addresses inet[],
    nameserver_ipv6_addresses inet[],
    nameserver_statuses TEXT[],
	nameserver_delegation_check TIMESTAMPTZ,
	nameserver_latest_correct_delegation_check TIMESTAMPTZ,
    nameserver_latest_update_at TIMESTAMPTZ
);
CREATE INDEX idx_nameserver_ascii_name ON nameservers(nameserver_ascii_name);

-- Trigger Function: Update nameserver_latest_update_at on UPDATE
CREATE OR REPLACE FUNCTION update_nameservers_latest_update_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.nameserver_latest_update_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_update_nameservers_latest_update_at
BEFORE UPDATE ON nameservers
FOR EACH ROW
EXECUTE FUNCTION update_nameservers_latest_update_at();

-- =======================
-- Table: ip_network_versions
-- =======================
CREATE TABLE ip_network_versions (
  ip_network_version_id SERIAL PRIMARY KEY,
  ip_network_version_name VARCHAR(20) UNIQUE
);

-- =======================
-- Table: ip_networks
-- =======================
CREATE TABLE ip_networks (
    ip_network_id BIGSERIAL PRIMARY KEY,
	ip_network_zone_handle TEXT NOT NULL UNIQUE,
    ip_network_entry_handle TEXT,	
    ip_network_start_address VARCHAR(50),
    ip_network_end_address VARCHAR(50),
    ip_network_version INT REFERENCES ip_network_versions(ip_network_version_id),
    ip_network_name TEXT,
    ip_network_type VARCHAR(100),
    ip_network_country_code CHAR(2),
    ip_network_statuses TEXT[],
    ip_network_latest_update_at TIMESTAMPTZ
);

-- Trigger Function: Update ip_network_latest_update_at on UPDATE
CREATE OR REPLACE FUNCTION update_ip_networks_latest_update_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.ip_network_latest_update_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_update_ip_networks_latest_update_at
BEFORE UPDATE ON ip_networks
FOR EACH ROW
EXECUTE FUNCTION update_ip_networks_latest_update_at();

-- =======================
-- Table: autnums
-- =======================
CREATE TABLE autnums (
    autnum_id BIGSERIAL PRIMARY KEY,
	autnum_zone_handle TEXT NOT NULL UNIQUE,
    autnum_entry_handle TEXT,
    autnum_start BIGINT,
    autnum_end BIGINT,
    autnum_name TEXT,
    autnum_type VARCHAR(100),
    autnum_country_code CHAR(2),
    autnum_status TEXT[],
    autnum_created_at TIMESTAMPTZ,
    autnum_latest_update_at TIMESTAMPTZ
);

-- Trigger Function: Update autnum_latest_update_at on UPDATE
CREATE OR REPLACE FUNCTION update_autnums_latest_update_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.autnum_latest_update_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_update_autnums_latest_update_at
BEFORE UPDATE ON autnums
FOR EACH ROW
EXECUTE FUNCTION update_autnums_latest_update_at();

-- =======================
-- Table: events
-- Used to provide [event/log/metadata] for RDAP responses on [domains/entities/etc.]
-- Stores lifecycle events such as creation, transfer, expiration, etc., for all RDAP object types
-- =======================
CREATE TABLE events (
    event_id BIGSERIAL PRIMARY KEY,
    event_object_type VARCHAR(50) CHECK (event_object_type IN ('domain', 'entity', 'zone', 'autnum', 'ip_network')),
    event_object_id INT,
    event_action VARCHAR(100) CHECK (
		event_action IN (
		'registration',
		'last changed',
		'deletion',
		'expiration',
		'transfer',
		'locked',
		'unlocked',
		'restored',
		'reassigned',
		'suspended'
		)
	),
    event_date TIMESTAMPTZ,
    event_actor TEXT
);

-- =======================
-- Table: links
-- =======================
CREATE TABLE links (
    link_id BIGSERIAL PRIMARY KEY,
    link_object_type VARCHAR(50) CHECK (link_object_type IN ('domain', 'entity', 'zone', 'autnum', 'ip_network')),
    link_object_id INT,
    link_href TEXT,
    link_rel VARCHAR(100),
    link_type VARCHAR(100),
    link_title TEXT
);

-- =======================
-- Table: remarks
-- =======================
CREATE TABLE remarks (
    remark_id BIGSERIAL PRIMARY KEY,
    remark_object_type VARCHAR(50) CHECK (remark_object_type IN ('domain', 'entity', 'zone', 'autnum', 'ip_network')),
    remark_object_id INT,
    remark_title TEXT,
    remark_description TEXT,
    remark_type TEXT
);

-- =======================
-- Table: notices
-- =======================
CREATE TABLE notices (
    notice_id BIGSERIAL PRIMARY KEY,
    notice_object_type VARCHAR(50) CHECK (notice_object_type IN ('domain', 'entity', 'zone', 'autnum', 'ip_network')),
    notice_object_id INT,
    notice_title TEXT,
    notice_description TEXT,
    notice_type TEXT
);

-- =======================
-- Table: tld_contacts
-- =======================
CREATE TABLE tld_contacts (
    tc_id SERIAL PRIMARY KEY,
    tc_zone INT NOT NULL REFERENCES zones(zone_id) ON DELETE CASCADE,
	tc_role VARCHAR(50), -- holding role identifier
	tc_data_active_from TIMESTAMPTZ,
    tc_contact INT NOT NULL REFERENCES contacts(contact_id) ON DELETE CASCADE
);
CREATE INDEX idx_tc_zone ON tld_contacts(tc_zone);
CREATE INDEX idx_tc_contact ON tld_contacts(tc_contact);
CREATE UNIQUE INDEX uniq_zone_role_start ON tld_contacts(tc_zone, tc_role, tc_data_active_from);

-- =======================
-- Table: domain_entities
-- =======================
CREATE TABLE domain_entities (
    de_id SERIAL PRIMARY KEY,
    de_domain BIGINT NOT NULL REFERENCES domains(domain_id) ON DELETE CASCADE,
	de_role VARCHAR(50), -- holding role identifier like 'abuse', 'sponsor', 'registrant' etc.
    de_entity BIGINT NOT NULL REFERENCES entities(entity_id) ON DELETE CASCADE
);
CREATE INDEX idx_de_domain ON domain_entities(de_domain);
CREATE INDEX idx_de_entity ON domain_entities(de_entity);

-- =======================
-- Table: domain_nameservers
-- =======================
CREATE TABLE domain_nameservers (
    dn_id BIGSERIAL PRIMARY KEY,
    dn_domain BIGINT NOT NULL REFERENCES domains(domain_id) ON DELETE CASCADE,
    dn_nameserver BIGINT NOT NULL REFERENCES nameservers(nameserver_id) ON DELETE CASCADE,
    dn_latest_update_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (dn_domain, dn_nameserver)
);
CREATE INDEX idx_dn_domain ON domain_nameservers(dn_domain);
CREATE INDEX idx_dn_nameserver ON domain_nameservers(dn_nameserver);

-- Trigger Function: Update dn_latest_update_at on UPDATE
CREATE OR REPLACE FUNCTION update_domain_nameservers_latest_update_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.dn_latest_update_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_update_domain_nameservers_latest_update_at
BEFORE UPDATE ON domain_nameservers
FOR EACH ROW
EXECUTE FUNCTION update_domain_nameservers_latest_update_at();

-- =======================
-- Table: entity_entities
-- Represents relationships between parent and child entities, such as abuse contact information.
-- =======================
CREATE TABLE entity_entities (
    ee_id BIGSERIAL PRIMARY KEY,
	ee_parent_role VARCHAR(50),  -- holding 'role_identifier' like 'registrar'
    ee_parent BIGINT NOT NULL REFERENCES entities(entity_id) ON DELETE CASCADE,
	ee_child_role VARCHAR(50),  -- holding 'role_identifier' like 'abuse'
    ee_child BIGINT NOT NULL REFERENCES entities(entity_id) ON DELETE CASCADE
);
CREATE INDEX idx_ee_parent ON entity_entities(ee_parent);
CREATE INDEX idx_ee_child ON entity_entities(ee_child);

-- =======================
-- Table: domain_secure_dns
-- Stores DNSSEC-related settings for a domain.
-- =======================
CREATE TABLE domain_secure_dns (
    ds_id BIGSERIAL PRIMARY KEY,
    ds_domain BIGINT REFERENCES domains(domain_id),
    ds_dnssec_enabled BOOLEAN,
    ds_dns_provider VARCHAR(100),
    ds_created_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    ds_latest_update_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX idx_ds_domain ON domain_secure_dns(ds_domain);

-- Trigger Function: Update ds_latest_update_at on UPDATE
CREATE OR REPLACE FUNCTION update_domain_secure_dns_latest_update_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.ds_latest_update_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_update_domain_secure_dns_latest_update_at
BEFORE UPDATE ON domain_secure_dns
FOR EACH ROW
EXECUTE FUNCTION update_domain_secure_dns_latest_update_at();

-- =======================
-- Table: domain_tlsa_records
-- Stores TLSA records used in DANE (DNS-based Authentication of Named Entities).
-- DNS-based Authentication of Named Entities (DANE) records for DNSSEC-secured domains
-- Used to associate TLS certificates with domain names via DNS
-- =======================
CREATE TABLE domain_tlsa_records (
    dt_id BIGSERIAL PRIMARY KEY,
    dt_secure_dns INT REFERENCES domain_secure_dns(ds_id) ON DELETE CASCADE,
    dt_usage SMALLINT CHECK (dt_usage BETWEEN 0 AND 3), -- TLSA usage field
    dt_selector SMALLINT CHECK (dt_selector BETWEEN 0 AND 1), -- TLSA selector
    dt_matching_type SMALLINT CHECK (dt_matching_type BETWEEN 0 AND 2), -- TLSA matching type
    dt_certificate_association_data TEXT NOT NULL, -- Hex or base64 encoded cert data
    dt_latest_update_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_dt_secure_dns ON domain_tlsa_records(dt_secure_dns);

-- Trigger: Update timestamp
CREATE OR REPLACE FUNCTION update_domain_tlsa_latest_update_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.dt_latest_update_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_update_domain_tlsa_latest_update_at
BEFORE UPDATE ON domain_tlsa_records
FOR EACH ROW
EXECUTE FUNCTION update_domain_tlsa_latest_update_at();