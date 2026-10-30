-- Run once in phpMyAdmin before deploying the WhatsApp poster feature.

-- Existing rows stay published; posters from WhatsApp start as pending.
ALTER TABLE spiritual_activities
    ADD COLUMN status ENUM('pending', 'published', 'rejected') NOT NULL DEFAULT 'published',
    ADD COLUMN source VARCHAR(20) NOT NULL DEFAULT 'manual',
    ADD COLUMN title VARCHAR(255) NULL,
    ADD COLUMN district VARCHAR(255) NULL,
    ADD COLUMN new_place_name VARCHAR(255) NULL,
    ADD COLUMN image_hash CHAR(64) NULL,
    ADD COLUMN submitted_by VARCHAR(20) NULL,
    ADD COLUMN reviewed_by VARCHAR(100) NULL,
    ADD COLUMN reviewed_at DATETIME NULL,
    ADD COLUMN reader_notes TEXT NULL,
    ADD UNIQUE KEY uniq_image_hash (image_hash),
    ADD KEY idx_status (status);

-- Posters can arrive before their type or place is known.
ALTER TABLE spiritual_activities
    MODIFY activity_type_id INT NULL,
    MODIFY activity_place_id INT NULL;

-- Every WhatsApp message carrying a poster, so nothing is processed twice.
CREATE TABLE whatsapp_inbox (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message_id VARCHAR(128) NOT NULL UNIQUE,
    from_number VARCHAR(20) NOT NULL,
    media_id VARCHAR(128) NOT NULL,
    caption TEXT NULL,
    status ENUM('received', 'done', 'failed') NOT NULL DEFAULT 'received',
    attempts INT NOT NULL DEFAULT 0,
    error TEXT NULL,
    activity_id INT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_status (status)
) DEFAULT CHARSET = utf8mb4;

-- Summaries sent to approvers, so a reply can be matched to its poster.
CREATE TABLE whatsapp_review_messages (
    wamid VARCHAR(128) PRIMARY KEY,
    activity_id INT NOT NULL,
    approver VARCHAR(20) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_approver (approver, created_at)
) DEFAULT CHARSET = utf8mb4;
