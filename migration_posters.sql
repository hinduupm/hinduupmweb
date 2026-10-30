-- Run once in phpMyAdmin before deploying the emailed poster feature.

-- Existing rows stay published; emailed posters start as pending.
ALTER TABLE spiritual_activities
    ADD COLUMN status ENUM('pending', 'published', 'rejected') NOT NULL DEFAULT 'published',
    ADD COLUMN source VARCHAR(20) NOT NULL DEFAULT 'manual',
    ADD COLUMN title VARCHAR(255) NULL,
    ADD COLUMN district VARCHAR(255) NULL,
    ADD COLUMN new_place_name VARCHAR(255) NULL,
    ADD COLUMN image_hash CHAR(64) NULL,
    ADD COLUMN submitted_by VARCHAR(255) NULL,
    ADD COLUMN reviewed_by VARCHAR(100) NULL,
    ADD COLUMN reviewed_at DATETIME NULL,
    ADD COLUMN reader_notes TEXT NULL,
    ADD UNIQUE KEY uniq_image_hash (image_hash),
    ADD KEY idx_status (status);

-- Posters can arrive before their type or place is known.
ALTER TABLE spiritual_activities
    MODIFY activity_type_id INT NULL,
    MODIFY activity_place_id INT NULL;

-- Every email sent to the posters address, so nothing is processed twice.
CREATE TABLE poster_inbox (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message_id VARCHAR(255) NOT NULL UNIQUE,
    imap_uid INT NULL,
    from_address VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NULL,
    status ENUM('received', 'done', 'failed', 'ignored') NOT NULL DEFAULT 'received',
    attempts INT NOT NULL DEFAULT 0,
    posters INT NOT NULL DEFAULT 0,
    error TEXT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET = utf8mb4;
