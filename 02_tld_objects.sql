/* ============================================================================
   02_tld_objects.sql
   Purpose: Registry / TLD-level schema (zone catalog + policy + contacts).

   Tables:
     - tld_categories, tld_types
     - common                : global registry settings (roles, statuses, periods)
     - contacts              : registry/TLD contacts
     - zones                 : public suffix / TLD entries (with role & workload)
     - lifecycles            : TLD lifecycle policy snapshots
     - tld_contacts          : mapping zones ↔ contacts (role + effective date)

   Functions & Triggers:
     - update_zone_latest_update_at() + trigger
     - get_matching_zone_identifier(domain_name TEXT)  ← used by domain script

   Run order: 3 of 4  (bootstrap → logging → TLD → domain)
   Depends on: 00_bootstrap_extensions.sql
   Provides to: 03_domain_objects.sql (zones + get_matching_zone_identifier)
   Safe to re-run: yes (IF NOT EXISTS + CREATE OR REPLACE on functions)
   Notes:
     - Unique index (zone_identifier, zone_data_active_from) supports versioning.
     - Potential future FKs to tld_categories/tld_types are commented for now.
============================================================================ */

-- ========================================
-- Table: tld_categories
-- ========================================
CREATE TABLE IF NOT EXISTS tld_categories (
    tld_category_id SERIAL PRIMARY KEY,
    tld_category_identifier VARCHAR(20) UNIQUE
);

-- ========================================
-- Table: tld_types
-- ========================================
CREATE TABLE IF NOT EXISTS tld_types (
    tld_type_id SERIAL PRIMARY KEY,
    tld_type_identifier VARCHAR(20) UNIQUE
);

-- ========================================
-- Table: common
-- ========================================
CREATE TABLE IF NOT EXISTS common (
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
        ]'::jsonb,
	common_tld_statuses JSONB DEFAULT 
	'{
	"ok":{"rdap_v1":"active","rdap_v2":"dns_delegated","snake_case":"dns_delegated"},
	"inactive":{"rdap_v1":"inactive","rdap_v2":"no_dns","snake_case":"no_dns"},
	"pendingCreate":{"rdap_v1":"pending create","rdap_v2":"pending_create","snake_case":"pending_create"},
	"pendingDelete":{"rdap_v1":"pending delete","rdap_v2":"pending_delete","snake_case":"pending_delete"},
	"pendingRenew":{"rdap_v1":"pending renew","rdap_v2":"pending_renew","snake_case":"pending_renew"},
	"pendingTransfer":{"rdap_v1":"pending transfer","rdap_v2":"pending_transfer","snake_case":"pending_transfer"},
	"pendingUpdate":{"rdap_v1":"pending update","rdap_v2":"pending_update","snake_case":"pending_update"},
	"clientDeleteProhibited":{"rdap_v1":"client delete prohibited","rdap_v2":"client_delete_prohibited","snake_case":"client_delete_prohibited"},
	"serverDeleteProhibited":{"rdap_v1":"server delete prohibited","rdap_v2":"server_delete_prohibited","snake_case":"server_delete_prohibited"},
	"clientHold":{"rdap_v1":"client hold","rdap_v2":"client_hold","snake_case":"client_hold"},
	"serverHold":{"rdap_v1":"server hold","rdap_v2":"server_hold","snake_case":"server_hold"},
	"clientRenewProhibited":{"rdap_v1":"client renew prohibited","rdap_v2":"client_renew_prohibited","snake_case":"client_renew_prohibited"},
	"serverRenewProhibited":{"rdap_v1":"server renew prohibited","rdap_v2":"server_renew_prohibited","snake_case":"server_renew_prohibited"},
	"clientTransferProhibited":{"rdap_v1":"client transfer prohibited","rdap_v2":"client_transfer_prohibited","snake_case":"client_transfer_prohibited"},
	"serverTransferProhibited":{"rdap_v1":"server transfer prohibited","rdap_v2":"server_transfer_prohibited","snake_case":"server_transfer_prohibited"},
	"clientUpdateProhibited":{"rdap_v1":"client update prohibited","rdap_v2":"client_update_prohibited","snake_case":"client_update_prohibited"},
	"serverUpdateProhibited":{"rdap_v1":"server update prohibited","rdap_v2":"server_update_prohibited","snake_case":"server_update_prohibited"},
	"redemptionPeriod":{"rdap_v1":"redemption period","rdap_v2":"pending_redemption","snake_case":"pending_redemption"},
	"pendingRestore":{"rdap_v1":"pending restore","rdap_v2":"pending_restore","snake_case":"pending_restore"},
	"linked":{"rdap_v1":"linked","rdap_v2":"linked","snake_case":"linked"},
	"pendingValidation":{"rdap_v1":"pending validation","rdap_v2":"pending_validation","snake_case":"pending_validation"}
	}'::jsonb,		
    common_indeterminate_rdap_statuses JSONB DEFAULT '{
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
    }'::jsonb,
    common_best_practices_periods JSONB DEFAULT '[
        {"period_identifier": "subscription_years", "min": 1, "max": 10, "optimal": 1},
        {"period_identifier": "add_grace_days", "min": 5, "max": 5, "optimal": 5},
        {"period_identifier": "transfer_grace_days", "min": 5, "max": 5, "optimal": 5},
        {"period_identifier": "renew_grace_days", "min": 5, "max": 45, "optimal": 30},
        {"period_identifier": "post_transfer_lock_days", "min": 60, "max": 60, "optimal": 60},
        {"period_identifier": "pending_redemption_days", "min": 30, "max": 30, "optimal": 30},
        {"period_identifier": "pending_delete_days", "min": 5, "max": 5, "optimal": 5}
    ]'::jsonb,
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
        ]'::jsonb
);

-- ========================================
-- Table: contacts (registry/TLD contacts)
-- ========================================
CREATE TABLE IF NOT EXISTS contacts (
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

-- ========================================
-- Table: zones (TLDs / public suffixes)
-- ========================================
CREATE TABLE IF NOT EXISTS zones (
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
    zone_tld_search_engine_deletion_phase_ready BOOLEAN NOT NULL DEFAULT FALSE,
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
        ]'::jsonb,
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
        ]'::jsonb,
    zone_name_servers JSONB::jsonb,
    zone_latest_update_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);

-- one version per (zone_identifier, active_from)
CREATE UNIQUE INDEX IF NOT EXISTS uniq_zone_effective
  ON zones (zone_identifier, zone_data_active_from);

-- Trigger Function: Update zone_latest_update_at on UPDATE
CREATE OR REPLACE FUNCTION update_zone_latest_update_at()
RETURNS TRIGGER AS $$
BEGIN
  NEW.zone_latest_update_at = CURRENT_TIMESTAMP;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS trg_update_zone_latest_update_at ON zones;
CREATE TRIGGER trg_update_zone_latest_update_at
BEFORE UPDATE ON zones
FOR EACH ROW
EXECUTE FUNCTION update_zone_latest_update_at();

-- Function: get_matching_zone_identifier(domain_name)
-- Returns the best matching zone_identifier for a given domain name.
CREATE OR REPLACE FUNCTION get_matching_zone_identifier(domain_name TEXT)
RETURNS VARCHAR AS $$
DECLARE
    suffix TEXT;
    parts TEXT[];
    i INT;
    match_identifier VARCHAR;
BEGIN
    parts := string_to_array(lower(domain_name), '.');

    FOR i IN REVERSE array_lower(parts, 1)..array_upper(parts, 1) LOOP
        suffix := array_to_string(parts[i:array_upper(parts, 1)], '.');

        SELECT zone_identifier INTO match_identifier
        FROM zones
        WHERE zone_identifier = suffix
          AND (zone_data_active_from IS NULL
               OR (zone_data_active_from AT TIME ZONE 'UTC') <= (CURRENT_TIMESTAMP AT TIME ZONE 'UTC'))
        ORDER BY zone_data_active_from DESC NULLS LAST
        LIMIT 1;

        IF match_identifier IS NOT NULL THEN
            RETURN match_identifier;
        END IF;
    END LOOP;
    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

-- ========================================
-- Table: lifecycles
-- ========================================
CREATE TABLE IF NOT EXISTS lifecycles (
    lifecycle_id SERIAL PRIMARY KEY,
    lifecycle_zone VARCHAR(63) NOT NULL,
    lifecycle_data_active_from TIMESTAMPTZ,
    lifecycle_upon_termination TEXT,
    lifecycle_status_meanings JSONB DEFAULT '[{
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
    }]'::jsonb,
    lifecycle_operational_periods JSONB DEFAULT '[
        {"period_identifier": "subscription_years", "default": null, "allowed": null},
        {"period_identifier": "add_grace_days", "default": null, "allowed": null},
        {"period_identifier": "transfer_grace_days", "default": null, "allowed": null},
        {"period_identifier": "renew_grace_days", "default": null, "allowed": null},
        {"period_identifier": "post_transfer_lock_days", "default": null, "allowed": null},
        {"period_identifier": "pending_redemption_days", "default": null, "allowed": null},
        {"period_identifier": "pending_delete_days", "default": null, "allowed": null}
    ]'::jsonb,
    lifecycle_latest_update_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);

CREATE UNIQUE INDEX IF NOT EXISTS idx_lifecycle_zone_data_active_from
ON lifecycles(lifecycle_zone, lifecycle_data_active_from);

-- ========================================
-- Table: tld_contacts (links zones<->contacts)
-- ========================================
CREATE TABLE IF NOT EXISTS tld_contacts (
    tc_id SERIAL PRIMARY KEY,
    tc_zone INT NOT NULL REFERENCES zones(zone_id) ON DELETE CASCADE,
    tc_role VARCHAR(50),
    tc_data_active_from TIMESTAMPTZ,
    tc_contact INT NOT NULL REFERENCES contacts(contact_id) ON DELETE CASCADE,
    tc_latest_update_at TIMESTAMPTZ
);

CREATE INDEX IF NOT EXISTS idx_tc_zone ON tld_contacts(tc_zone);
CREATE INDEX IF NOT EXISTS idx_tc_contact ON tld_contacts(tc_contact);
CREATE UNIQUE INDEX IF NOT EXISTS uniq_zone_role_start ON tld_contacts(tc_zone, tc_role, tc_data_active_from);
