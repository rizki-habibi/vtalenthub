-- ==========================================================
-- VTalentHub — Virtual Talent Data Agency Database Schema
-- Compatible with MySQL 8.0+ / MariaDB / PostgreSQL / SQLite
-- ==========================================================

CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NULL,
    google_id VARCHAR(255) NULL UNIQUE,
    avatar VARCHAR(255) NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'user', -- 'admin', 'manager', 'talent', 'client', 'user'
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE IF NOT EXISTS talents (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    name VARCHAR(255) NOT NULL,
    real_name VARCHAR(255) NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    platform VARCHAR(50) NOT NULL DEFAULT 'youtube', -- 'youtube', 'twitch', 'tiktok', 'bilibili', 'multi'
    status VARCHAR(50) NOT NULL DEFAULT 'onboarding', -- 'active', 'onboarding', 'inactive'
    subscribers BIGINT UNSIGNED NOT NULL DEFAULT 0,
    model_type VARCHAR(50) NOT NULL DEFAULT 'none', -- 'live2d', '3d', 'png', 'none'
    genre VARCHAR(255) NULL,
    language VARCHAR(50) NOT NULL DEFAULT 'ID',
    bio TEXT NULL,
    avatar_url VARCHAR(500) NULL,
    banner_url VARCHAR(500) NULL,
    youtube_url VARCHAR(500) NULL,
    twitch_url VARCHAR(500) NULL,
    tiktok_url VARCHAR(500) NULL,
    twitter_url VARCHAR(500) NULL,
    discord_url VARCHAR(500) NULL,
    tags JSON NULL,
    monthly_revenue DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
    debut_date DATE NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_talents_status (status),
    INDEX idx_talents_platform (platform)
);

CREATE TABLE IF NOT EXISTS talent_needs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    talent_id BIGINT UNSIGNED NOT NULL,
    need_type VARCHAR(100) NOT NULL, -- 'model', 'rigging', 'background', 'overlay', 'emotes', 'logo', 'banner', 'bgm', 'schedule'
    status VARCHAR(50) NOT NULL DEFAULT 'needed', -- 'needed', 'in_progress', 'completed'
    provider VARCHAR(255) NULL,
    estimated_cost DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    notes TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (talent_id) REFERENCES talents(id) ON DELETE CASCADE,
    INDEX idx_needs_type (need_type)
);

CREATE TABLE IF NOT EXISTS assets (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    talent_id BIGINT UNSIGNED NULL,
    created_by BIGINT UNSIGNED NULL,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(100) NOT NULL, -- 'background', 'overlay', 'wallpaper', 'emotes', 'logo', 'banner', 'schedule', 'model', 'rigging'
    theme VARCHAR(100) NULL,
    color VARCHAR(20) NULL,
    resolution VARCHAR(50) NULL,
    file_path VARCHAR(500) NULL,
    preview_url VARCHAR(500) NULL,
    notes TEXT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'draft', -- 'draft', 'generated', 'published', 'sold'
    price DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    downloads INT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (talent_id) REFERENCES talents(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_assets_type (type),
    INDEX idx_assets_status (status)
);

CREATE TABLE IF NOT EXISTS clients (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    talent_id BIGINT UNSIGNED NULL,
    name VARCHAR(255) NOT NULL,
    contact_person VARCHAR(255) NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(50) NULL,
    company VARCHAR(255) NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'lead', -- 'lead', 'negotiation', 'active', 'completed', 'cancelled'
    type VARCHAR(100) NOT NULL DEFAULT 'sponsorship', -- 'sponsorship', 'commission', 'talent-hire', 'event', 'merch', 'other'
    deal_value DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
    deadline DATE NULL,
    notes TEXT NULL,
    proposal_url TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (talent_id) REFERENCES talents(id) ON DELETE SET NULL,
    INDEX idx_clients_status (status),
    INDEX idx_clients_type (type)
);

CREATE TABLE IF NOT EXISTS counseling_sessions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    talent_id BIGINT UNSIGNED NULL,
    topic VARCHAR(100) NOT NULL,
    question TEXT NOT NULL,
    answer TEXT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'pending', -- 'pending', 'answered', 'closed'
    rating TINYINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (talent_id) REFERENCES talents(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS activity_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    action VARCHAR(100) NOT NULL,
    subject_type VARCHAR(255) NULL,
    subject_id BIGINT UNSIGNED NULL,
    description TEXT NULL,
    metadata JSON NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_activity_subject (subject_type, subject_id)
);

CREATE TABLE IF NOT EXISTS team_members (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    name VARCHAR(255) NOT NULL,
    role VARCHAR(100) NOT NULL, -- 'founder', 'manager', 'artist', 'rigger', 'editor', 'marketer'
    avatar_url VARCHAR(500) NULL,
    bio TEXT NULL,
    twitter_url VARCHAR(500) NULL,
    portfolio_url VARCHAR(500) NULL,
    is_public BOOLEAN NOT NULL DEFAULT TRUE,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS showcases (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL DEFAULT 'AVATAR RIG',
    image_url VARCHAR(500) NULL,
    description TEXT NULL,
    author_or_talent VARCHAR(255) NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    is_featured BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE IF NOT EXISTS innovations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL, -- 'asset_tech', 'monetization', 'ai_interaction', 'event_format', 'fan_experience'
    problem_statement TEXT NOT NULL,
    proposed_solution TEXT NOT NULL,
    monetization_potential TEXT NULL,
    target_audience VARCHAR(255) NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'concept', -- 'concept', 'research', 'prototyping', 'ready_to_pitch', 'launched'
    generated_by_ai BOOLEAN NOT NULL DEFAULT FALSE,
    upvotes INT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_innovations_category (category),
    INDEX idx_innovations_status (status)
);
