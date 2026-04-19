/* ============================================================================
   02_tld_objects.sql
   Purpose: Registry / TLD-level schema (zone catalog + policy + functions).

   Tables:
     - tld_categories, tld_types
     - common                : global registry settings (functions, statuses, periods)
     - zones                 : public suffix / TLD entries (with functions & workload)
	 - function_entities     : entity functions
     - lifecycles            : TLD lifecycle policy snapshots

   Functions & Triggers:
     - update_zone_latest_update_at() + trigger
     - get_matching_zone_tld_ascii_name(domain_name TEXT)  ← used by domain script

   Run order: 3 of 4  (bootstrap → logging → TLD → domain)
   Depends on: 00_bootstrap_extensions.sql
   Provides to: 03_domain_objects.sql (zones + get_matching_zone_tld_ascii_name)
   Safe to re-run: yes (IF NOT EXISTS + CREATE OR REPLACE on functions)
   Notes:
     - Unique index (zone_tld_ascii_name, zone_tld_data_active_from) supports versioning.
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
    common_root_services_uri TEXT[],
    common_root_zones_uri TEXT[],
    common_registrar_accreditations_uri TEXT[],
    common_function_identifiers JSONB DEFAULT 
        '[
            {"function_sequence": 10,"function_identifier": "contracting_authority"},
            {"function_sequence": 20,"function_identifier": "contract_holder"},
            {"function_sequence": 30,"function_identifier": "sponsoring_organization"},
            {"function_sequence": 40,"function_identifier": "country_code_designated_manager"),
            {"function_sequence": 50,"function_identifier": "registry_operator"},
            {"function_sequence": 60,"function_identifier": "backend_operator"}
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
    common_lifecycle_period_ranges JSONB DEFAULT '[
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
-- Table: zones (TLDs / public suffixes)
-- ========================================
CREATE TABLE IF NOT EXISTS zones (
    zone_id SERIAL PRIMARY KEY,
	zone_tld_ascii_name CITEXT NOT NULL,
	zone_tld_unicode_name TEXT NOT NULL,
    zone_tld_data_active_from TIMESTAMPTZ,
    zone_tld_category VARCHAR(20) NOT NULL,
    zone_tld_type VARCHAR(20) NOT NULL,
    zone_tld_statuses TEXT[],
	zone_tld_storage_model TEXT[],
	zone_tld_response_model TEXT[],
	zone_tld_services_uri TEXT[],
	zone_tld_standardized_prices_uri TEXT[],
    zone_tld_delegation_uri TEXT[],
    zone_tld_json_response_uri TEXT[],
    zone_tld_terms_of_service_uri TEXT[],
    zone_tld_privacy_policy_uri TEXT[],
    zone_tld_search_engine_deletion_phase_ready BOOLEAN NOT NULL DEFAULT FALSE,
    zone_tld_accepted_workload JSONB DEFAULT 
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
    zone_tld_relationships JSONB DEFAULT 
        '[
            {"zone_relationship_sequence": 10, "zone_relationship_identifier": "sponsor"},
            {"zone_relationship_sequence": 20, "zone_relationship_identifier": "registrant"},
            {"zone_relationship_sequence": 30, "zone_relationship_identifier": "administrative"},
            {"zone_relationship_sequence": 40, "zone_relationship_identifier": "technical"},
            {"zone_relationship_sequence": 50, "zone_relationship_identifier": "billing"},
            {"zone_relationship_sequence": 60, "zone_relationship_identifier": "emergency"},
            {"zone_relationship_sequence": 70, "zone_relationship_identifier": "fallback"},
            {"zone_relationship_sequence": 80, "zone_relationship_identifier": "reseller"},
            {"zone_relationship_sequence": 90, "zone_relationship_identifier": "registrar"},
            {"zone_relationship_sequence": 95, "zone_relationship_identifier": "abuse"}
        ]'::jsonb,
    zone_name_servers JSONB::jsonb,
    zone_latest_update_at TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
);

-- one version per (zone_tld_ascii_name, zone_tld_data_active_from)
CREATE UNIQUE INDEX IF NOT EXISTS uniq_zone_effective
  ON zones (zone_tld_ascii_name, zone_tld_data_active_from);

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

-- Function: get_matching_zone_tld_ascii_name(domain_name)
-- Returns the best matching zone_tld_ascii_name for a given domain name.
CREATE OR REPLACE FUNCTION get_matching_zone_tld_ascii_name(domain_name TEXT)
RETURNS VARCHAR AS $$
DECLARE
    suffix TEXT;
    parts TEXT[];
    i INT;
    match_tld_ascii_name VARCHAR;
BEGIN
    parts := string_to_array(lower(domain_name), '.');

    FOR i IN REVERSE array_lower(parts, 1)..array_upper(parts, 1) LOOP
        suffix := array_to_string(parts[i:array_upper(parts, 1)], '.');

        SELECT zone_tld_ascii_name INTO match_tld_ascii_name
        FROM zones
        WHERE zone_tld_ascii_name = suffix
          AND (zone_tld_data_active_from IS NULL
               OR (zone_tld_data_active_from AT TIME ZONE 'UTC') <= (CURRENT_TIMESTAMP AT TIME ZONE 'UTC'))
        ORDER BY zone_tld_data_active_from DESC NULLS LAST
        LIMIT 1;

        IF match_tld_ascii_name IS NOT NULL THEN
            RETURN match_tld_ascii_name;
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

CREATE UNIQUE INDEX IF NOT EXISTS idx_lifecycle_data_active_from
ON lifecycles(lifecycle_zone, lifecycle_data_active_from);

-- ========================================
-- Table: function_entities (registry/TLD function entities)
-- ========================================
CREATE TABLE IF NOT EXISTS functions_entities (
    function_entity_id SERIAL PRIMARY KEY,
    function_entity_handle TEXT NOT NULL UNIQUE,
    function_entity_web_id VARCHAR(34),
    function_entity_organization_name VARCHAR(511),
    function_entity_presented_name VARCHAR(511),
    function_entity_name TEXT,
    function_entity_email CITEXT,
    function_entity_phone VARCHAR(50),
    function_entity_fax VARCHAR(50),
    function_entity_country_code CHAR(2),
    function_entity_street_address TEXT,
    function_entity_city TEXT,
    function_entity_state_or_province TEXT,
    function_entity_postal_code VARCHAR(20),
    function_entity_country_name TEXT,
    function_entity_latest_update_at TIMESTAMPTZ
);

-- ========================================
-- Table: zone_functions (links zones<->functions)
-- ========================================
CREATE TABLE IF NOT EXISTS zone_functions (
    zf_id SERIAL PRIMARY KEY,
    zf_zone INT NOT NULL REFERENCES zones(zone_id) ON DELETE CASCADE,
    zf_function_identifier VARCHAR(50),
    zf_data_active_from TIMESTAMPTZ,
	zf_field_publication JSONB::jsonb,
    zf_function INT NOT NULL REFERENCES function_entities(function_entity_id) ON DELETE CASCADE,
    zf_latest_update_at TIMESTAMPTZ
);

CREATE INDEX IF NOT EXISTS idx_zf_zone ON zone_functions(zf_zone);
CREATE INDEX IF NOT EXISTS idx_zf_function ON zone_functions(zf_function);
CREATE UNIQUE INDEX IF NOT EXISTS uniq_zone_function_start
    ON zone_functions(zf_zone, zf_function_identifier, zf_data_active_from);