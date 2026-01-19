/* ============================================================================
   03_domain_objects.sql
   Purpose: Domain-level and other RDAP object schemas (operational data).

   Tables:
     - domains               : domain core + registry links (JSON URLs, statuses)
     - entities              : contacts/organizations (registrant/admin/tech/etc.)
     - nameservers           : host objects with IPv4/IPv6 arrays
     - ip_network_versions   : registry for IPv4/IPv6 labels
     - ip_networks           : IP ranges with metadata
     - autnums               : Autonomous System Numbers
     - domain_entities       : domains ↔ entities (role-based)
     - domain_nameservers    : domains ↔ nameservers (unique pairs)
     - entity_entities       : entity ↔ entity relations (e.g., registrar ↔ abuse)
     - domain_secure_dns     : DNSSEC/DANE settings per domain
     - domain_tlsa_records   : TLSA records tied to domain_secure_dns

   Functions & Triggers:
     - update_*_latest_change_at() for several tables
     - set_domain_zone() BEFORE INSERT/UPDATE → calls
       get_matching_zone_identifier() from 02_tld_objects.sql

   Run order: 4 of 4  (bootstrap → logging → TLD → domain)
   Depends on: 00_bootstrap_extensions.sql, 02_tld_objects.sql
   Safe to re-run: yes (IF NOT EXISTS + CREATE OR REPLACE on functions)
   Notes:
     - Shared tables (events, links, remarks, notices) are defined in 01_logging.sql.
     - Consider FK from domains.domain_zone → zones.zone_identifier once policies
       around historical snapshots are finalized.
============================================================================ */

-- ========================================
-- Table: domains
-- ========================================
CREATE TABLE IF NOT EXISTS domains (
    domain_id BIGSERIAL PRIMARY KEY,
    domain_zone CITEXT NOT NULL,
    domain_server_handle TEXT NOT NULL UNIQUE,
    domain_client_handle TEXT,
    domain_ascii_name VARCHAR(511) NOT NULL,
    domain_unicode_name VARCHAR(511) NOT NULL,
    domain_statuses TEXT[],
    domain_created_at TIMESTAMPTZ,
    domain_latest_transfer_at TIMESTAMPTZ,
    domain_latest_change_at TIMESTAMPTZ,
    domain_expiration_at TIMESTAMPTZ,
    domain_recoverable_until TIMESTAMPTZ,
    domain_deletion_at TIMESTAMPTZ,
    domain_global_json_response_uri VARCHAR(511),
    domain_registry_json_response_uri VARCHAR(511),
    domain_registry_language_codes TEXT,
    domain_registrar_accreditation_id JSONB DEFAULT '[]'::jsonb,
    domain_registrar_json_response_uri VARCHAR(511),
    domain_registrar_complaint_uri TEXT,
    domain_status_explanation_uri TEXT,
    domain_geo_location JSONB::jsonb,
    domain_extensions JSONB DEFAULT '[]'::jsonb,
    domain_remarks JSONB DEFAULT '[]'::jsonb
);

-- Trigger Function: Update domain_latest_change_at on UPDATE
CREATE OR REPLACE FUNCTION update_domains_latest_change_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.domain_latest_change_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS trg_update_domains_latest_change_at ON domains;
CREATE TRIGGER trg_update_domains_latest_change_at
BEFORE UPDATE ON domains
FOR EACH ROW
EXECUTE FUNCTION update_domains_latest_change_at();

-- Trigger Function: Set domain_zone using get_matching_zone_identifier (from 01)
CREATE OR REPLACE FUNCTION set_domain_zone()
RETURNS TRIGGER AS $$
BEGIN
    NEW.domain_zone := get_matching_zone_identifier(NEW.domain_ascii_name);
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS trg_set_domain_zone ON domains;
CREATE TRIGGER trg_set_domain_zone
BEFORE INSERT OR UPDATE ON domains
FOR EACH ROW
EXECUTE FUNCTION set_domain_zone();

-- ========================================
-- Table: entities
-- ========================================
CREATE TABLE IF NOT EXISTS entities (
    entity_id BIGSERIAL PRIMARY KEY,
    entity_server_handle TEXT NOT NULL UNIQUE,
    entity_client_handle TEXT,
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
    entity_latest_change_at TIMESTAMPTZ,
    entity_verification_received_at TIMESTAMPTZ,
    entity_verification_set_at TIMESTAMPTZ,
    entity_properties JSONB DEFAULT '[]'::jsonb,
    entity_remarks JSONB DEFAULT '[]'::jsonb,
    entity_accreditation JSONB DEFAULT '[]'::jsonb,
    entity_links JSONB DEFAULT '[]'::jsonb,
    entity_json_response_uri TEXT
);

CREATE INDEX IF NOT EXISTS idx_entity_postal_code ON entities(entity_postal_code);
CREATE INDEX IF NOT EXISTS idx_entity_email ON entities(entity_email);
CREATE INDEX IF NOT EXISTS idx_entity_country_code ON entities(entity_country_code);

-- Trigger Function: Update entity_latest_change_at on UPDATE
CREATE OR REPLACE FUNCTION update_entities_latest_change_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.entity_latest_change_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS trg_update_entities_latest_change_at ON entities;
CREATE TRIGGER trg_update_entities_latest_change_at
BEFORE UPDATE ON entities
FOR EACH ROW
EXECUTE FUNCTION update_entities_latest_change_at();

-- ========================================
-- Table: nameservers
-- ========================================
CREATE TABLE IF NOT EXISTS nameservers (
    nameserver_id BIGSERIAL PRIMARY KEY,
    nameserver_server_handle TEXT NOT NULL UNIQUE,
    nameserver_client_handle TEXT,
    nameserver_ascii_name TEXT NOT NULL,
    nameserver_unicode_name TEXT,
    nameserver_ipv4_addresses inet[],
    nameserver_ipv6_addresses inet[],
    nameserver_statuses TEXT[],
    nameserver_delegation_check TIMESTAMPTZ,
    nameserver_latest_correct_delegation_check TIMESTAMPTZ,
    nameserver_latest_change_at TIMESTAMPTZ
);

CREATE INDEX IF NOT EXISTS idx_nameserver_ascii_name ON nameservers(nameserver_ascii_name);

-- Trigger Function: Update nameserver_latest_change_at on UPDATE
CREATE OR REPLACE FUNCTION update_nameservers_latest_change_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.nameserver_latest_change_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS trg_update_nameservers_latest_change_at ON nameservers;
CREATE TRIGGER trg_update_nameservers_latest_change_at
BEFORE UPDATE ON nameservers
FOR EACH ROW
EXECUTE FUNCTION update_nameservers_latest_change_at();

-- ========================================
-- Table: ip_network_versions
-- ========================================
CREATE TABLE IF NOT EXISTS ip_network_versions (
  ip_network_version_id SERIAL PRIMARY KEY,
  ip_network_version_name VARCHAR(20) UNIQUE
);

-- ========================================
-- Table: ip_networks
-- ========================================
CREATE TABLE IF NOT EXISTS ip_networks (
    ip_network_id BIGSERIAL PRIMARY KEY,
    ip_network_server_handle TEXT NOT NULL UNIQUE,
    ip_network_client_handle TEXT,
    ip_network_start_address VARCHAR(50),
    ip_network_end_address VARCHAR(50),
    ip_network_version INT REFERENCES ip_network_versions(ip_network_version_id),
    ip_network_name TEXT,
    ip_network_type VARCHAR(100),
    ip_network_country_code CHAR(2),
    ip_network_statuses TEXT[],
    ip_network_latest_change_at TIMESTAMPTZ
);

-- Trigger Function: Update ip_network_latest_change_at on UPDATE
CREATE OR REPLACE FUNCTION update_ip_networks_latest_change_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.ip_network_latest_change_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS trg_update_ip_networks_latest_change_at ON ip_networks;
CREATE TRIGGER trg_update_ip_networks_latest_change_at
BEFORE UPDATE ON ip_networks
FOR EACH ROW
EXECUTE FUNCTION update_ip_networks_latest_change_at();

-- ========================================
-- Table: autnums
-- ========================================
CREATE TABLE IF NOT EXISTS autnums (
    autnum_id BIGSERIAL PRIMARY KEY,
    autnum_server_handle TEXT NOT NULL UNIQUE,
    autnum_client_handle TEXT,
    autnum_start BIGINT,
    autnum_end BIGINT,
    autnum_name TEXT,
    autnum_type VARCHAR(100),
    autnum_country_code CHAR(2),
    autnum_status TEXT[],
    autnum_created_at TIMESTAMPTZ,
    autnum_latest_change_at TIMESTAMPTZ
);

-- Trigger Function: Update autnum_latest_change_at on UPDATE
CREATE OR REPLACE FUNCTION update_autnums_latest_change_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.autnum_latest_change_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS trg_update_autnums_latest_change_at ON autnums;
CREATE TRIGGER trg_update_autnums_latest_change_at
BEFORE UPDATE ON autnums
FOR EACH ROW
EXECUTE FUNCTION update_autnums_latest_change_at();

-- ========================================
-- Table: domain_entities (link domains<->entities with role)
-- ========================================
CREATE TABLE IF NOT EXISTS domain_entities (
    de_id SERIAL PRIMARY KEY,
    de_domain BIGINT NOT NULL REFERENCES domains(domain_id) ON DELETE CASCADE,
    de_role VARCHAR(50),
    de_shielding JSONB DEFAULT '[
        {
            "organization_name": "yes",
            "presented_name": "yes",
            "name": "yes",
            "email": "yes",
			"contact_uri": "yes",
            "phone": "yes",
            "country_code": "yes",
            "address": "yes"
        }
    ]'::jsonb,
    de_entity BIGINT NOT NULL REFERENCES entities(entity_id) ON DELETE CASCADE
);

CREATE INDEX IF NOT EXISTS idx_de_domain ON domain_entities(de_domain);
CREATE INDEX IF NOT EXISTS idx_de_entity ON domain_entities(de_entity);

-- ========================================
-- Table: domain_nameservers (link domains<->nameservers)
-- ========================================
CREATE TABLE IF NOT EXISTS domain_nameservers (
    dn_id BIGSERIAL PRIMARY KEY,
    dn_domain BIGINT NOT NULL REFERENCES domains(domain_id) ON DELETE CASCADE,
    dn_nameserver BIGINT NOT NULL REFERENCES nameservers(nameserver_id) ON DELETE CASCADE,
    dn_latest_change_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (dn_domain, dn_nameserver)
);

CREATE INDEX IF NOT EXISTS idx_dn_domain ON domain_nameservers(dn_domain);
CREATE INDEX IF NOT EXISTS idx_dn_nameserver ON domain_nameservers(dn_nameserver);

-- Trigger Function: Update dn_latest_change_at on UPDATE
CREATE OR REPLACE FUNCTION update_domain_nameservers_latest_change_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.dn_latest_change_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS trg_update_domain_nameservers_latest_change_at ON domain_nameservers;
CREATE TRIGGER trg_update_domain_nameservers_latest_change_at
BEFORE UPDATE ON domain_nameservers
FOR EACH ROW
EXECUTE FUNCTION update_domain_nameservers_latest_change_at();

-- ========================================
-- Table: entity_entities (entity relationships)
-- ========================================
CREATE TABLE IF NOT EXISTS entity_entities (
    ee_id BIGSERIAL PRIMARY KEY,
    ee_parent_role VARCHAR(50),
    ee_parent BIGINT NOT NULL REFERENCES entities(entity_id) ON DELETE CASCADE,
    ee_child_role VARCHAR(50),
    ee_shielding JSONB DEFAULT '[
        {
            "organization_name": "yes",
            "presented_name": "yes",
            "name": "yes",
            "email": "yes",
			"contact_uri": "yes",
            "phone": "yes",
            "country_code": "yes",
            "address": "yes"
        }
    ]'::jsonb,
    ee_child BIGINT NOT NULL REFERENCES entities(entity_id) ON DELETE CASCADE
);

CREATE INDEX IF NOT EXISTS idx_ee_parent ON entity_entities(ee_parent);
CREATE INDEX IF NOT EXISTS idx_ee_child ON entity_entities(ee_child);

-- ========================================
-- Table: domain_secure_dns
-- ========================================
CREATE TABLE IF NOT EXISTS domain_secure_dns (
    ds_id BIGSERIAL PRIMARY KEY,
    ds_domain BIGINT REFERENCES domains(domain_id),
    ds_dnssec_enabled BOOLEAN,
    ds_dns_provider VARCHAR(100),
    ds_created_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
    ds_latest_change_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_ds_domain ON domain_secure_dns(ds_domain);

-- Trigger Function: Update ds_latest_change_at on UPDATE
CREATE OR REPLACE FUNCTION update_domain_secure_dns_latest_change_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.ds_latest_change_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS trg_update_domain_secure_dns_latest_change_at ON domain_secure_dns;
CREATE TRIGGER trg_update_domain_secure_dns_latest_change_at
BEFORE UPDATE ON domain_secure_dns
FOR EACH ROW
EXECUTE FUNCTION update_domain_secure_dns_latest_change_at();

-- ========================================
-- Table: domain_tlsa_records (DANE/TLSA)
-- ========================================
CREATE TABLE IF NOT EXISTS domain_tlsa_records (
    dt_id BIGSERIAL PRIMARY KEY,
    dt_secure_dns INT REFERENCES domain_secure_dns(ds_id) ON DELETE CASCADE,
    dt_usage SMALLINT CHECK (dt_usage BETWEEN 0 AND 3),
    dt_selector SMALLINT CHECK (dt_selector BETWEEN 0 AND 1),
    dt_matching_type SMALLINT CHECK (dt_matching_type BETWEEN 0 AND 2),
    dt_certificate_association_data TEXT NOT NULL,
    dt_latest_change_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_dt_secure_dns ON domain_tlsa_records(dt_secure_dns);

-- Trigger: Update dt_latest_change_at
CREATE OR REPLACE FUNCTION update_domain_tlsa_latest_change_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.dt_latest_change_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS trg_update_domain_tlsa_latest_change_at ON domain_tlsa_records;
CREATE TRIGGER trg_update_domain_tlsa_latest_change_at
BEFORE UPDATE ON domain_tlsa_records
FOR EACH ROW
EXECUTE FUNCTION update_domain_tlsa_latest_change_at();
