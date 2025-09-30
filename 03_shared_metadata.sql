-- ========================================
-- Shared RDAP Metadata (events/links/remarks/notices)
-- Safe to run independently. No FKs.
-- ========================================

-- EVENTS ----------------------------------------------------
CREATE TABLE IF NOT EXISTS events (
    event_id BIGSERIAL PRIMARY KEY,
    event_object_type VARCHAR(50)
        CHECK (event_object_type IN ('domain', 'entity', 'zone', 'autnum', 'ip_network')),
    event_object_id INT,
    event_action VARCHAR(100)
        CHECK (event_action IN (
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
        )),
    event_date TIMESTAMPTZ,
    event_actor TEXT
);

-- Optional helper indexes if you’ll query events by object frequently:
CREATE INDEX IF NOT EXISTS idx_events_object ON events(event_object_type, event_object_id);
CREATE INDEX IF NOT EXISTS idx_events_date ON events(event_date);

-- LINKS -----------------------------------------------------
CREATE TABLE IF NOT EXISTS links (
    link_id BIGSERIAL PRIMARY KEY,
    link_object_type VARCHAR(50)
        CHECK (link_object_type IN ('domain', 'entity', 'zone', 'autnum', 'ip_network')),
    link_object_id INT,
    link_href TEXT,
    link_rel VARCHAR(100),
    link_type VARCHAR(100),
    link_title TEXT
);

CREATE INDEX IF NOT EXISTS idx_links_object ON links(link_object_type, link_object_id);

-- REMARKS ---------------------------------------------------
CREATE TABLE IF NOT EXISTS remarks (
    remark_id BIGSERIAL PRIMARY KEY,
    remark_object_type VARCHAR(50)
        CHECK (remark_object_type IN ('domain', 'entity', 'zone', 'autnum', 'ip_network')),
    remark_object_id INT,
    remark_title TEXT,
    remark_description TEXT,
    remark_type TEXT
);

CREATE INDEX IF NOT EXISTS idx_remarks_object ON remarks(remark_object_type, remark_object_id);

-- NOTICES ---------------------------------------------------
CREATE TABLE IF NOT EXISTS notices (
    notice_id BIGSERIAL PRIMARY KEY,
    notice_object_type VARCHAR(50)
        CHECK (notice_object_type IN ('domain', 'entity', 'zone', 'autnum', 'ip_network')),
    notice_object_id INT,
    notice_title TEXT,
    notice_description TEXT,
    notice_type TEXT
);

CREATE INDEX IF NOT EXISTS idx_notices_object ON notices(notice_object_type, notice_object_id);
