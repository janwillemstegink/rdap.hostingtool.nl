/* ============================================================================
   00_bootstrap_extensions.sql
   Purpose: Enable required PostgreSQL extensions used across the RDAP schema.
   Contents:
     - CREATE EXTENSION citext

   Run order: 1 of 4  (bootstrap → logging → TLD → domain)
   Dependencies: none
   Safe to re-run: yes (CREATE EXTENSION IF NOT EXISTS)
   Target: PostgreSQL 13+ (tested with newer)
   Notes:
     - Keep this file minimal so other scripts can assume extensions exist.
============================================================================ */
CREATE EXTENSION IF NOT EXISTS citext;
