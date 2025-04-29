-- Tabla: users
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    apartment_number VARCHAR(20) NULL,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    restored_at TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (id, uuid, name, email, password, apartment_number) VALUES
(1, 'a61f3b62-9d25-4b8f-bb84-63284e9b56f2', 'Juan Pérez', 'juan.perez@gmail.com', 'hashed_password_juan', 'A101'),
(2, 'f4b8c1fc-1d96-40a1-93f1-c4658f689784', 'Laura Gómez', 'laura.gomez@outlook.com', 'hashed_password_laura', 'B202'),
(3, 'b31e7c8f-82d3-4d36-bfa7-21f3fdcba2ab', 'Carlos Méndez', 'carlos.mendez@gmail.com', 'hashed_password_carlos', 'C303'),
(4, 'fdb8d7b8-c6d9-4b79-a45f-0a7889f9ed85', 'Ana Torres', 'ana.torres@outlook.com', 'hashed_password_ana', 'D404'),
(5, 'c79a07f6-b029-41f7-b222-7e7fe27bfc60', 'Javier Sánchez', 'javier.sanchez@gmail.com', 'hashed_password_javier', 'E505'),
(6, 'b3f2616c-27cc-4180-b9b3-2830a222d08e', 'María López', 'maria.lopez@outlook.com', 'hashed_password_maria', 'F606'),
(7, 'f0837c71-c4c1-41e1-9d53-d0f38d0f7f70', 'Luis Fernández', 'luis.fernandez@gmail.com', 'hashed_password_luis', 'G707'),
(8, 'efb88c9f-ec2c-44f5-bcf5-9cc2320a30cb', 'Sofía Martín', 'sofia.martin@outlook.com', 'hashed_password_sofia', 'H808');

-- Tabla: roles
CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO roles (id, name, description) VALUES
(1, 'admin', 'Administrador del sistema'),
(2, 'resident', 'Residente del condominio'),
(3, 'guest', 'Invitado temporal al condominio'),
(4, 'security', 'Personal de seguridad del condominio'),
(5, 'maintenance', 'Personal encargado de mantenimiento del condominio'),
(6, 'manager', 'Encargado de la gestión del condominio'),
(7, 'staff', 'Personal de soporte');

-- Tabla: user_roles
CREATE TABLE user_roles (
    user_id BIGINT UNSIGNED NOT NULL,
    role_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

INSERT INTO user_roles (user_id, role_id) VALUES
(1, 1), -- Juan es admin
(2, 2), -- Laura es residente
(3, 2), -- Carlos es residente
(4, 3), -- Ana es invitada
(5, 4), -- Javier es personal de seguridad
(6, 2), -- María es residente
(7, 5), -- Luis es parte del equipo de mantenimiento
(8, 6); -- Sofía es encargada de la gestión del condominio

-- Tabla: voting_sessions
CREATE TABLE voting_sessions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL UNIQUE,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('active', 'closed') DEFAULT 'active',
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    restored_at TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO voting_sessions (id, uuid, title, description, status) VALUES
(1, '4bc03526-07da-47b8-928b-3d2f8194d7ac', 'Elección de presidente de condominio', 'Votación anual para elegir presidente del condominio. Todos los residentes pueden votar.', 'active'),
(2, '5c897c43-7d76-4f95-8f1d-56c77c50497e', 'Votación sobre proyectos de mantenimiento', 'Votación para aprobar proyectos de mantenimiento para el condominio', 'active'),
(3, '7f5a6cd9-e332-41e8-b0f5-8ffda88d2952', 'Votación para cambiar las normas de convivencia', 'Votación para modificar las normas de convivencia del condominio.', 'closed'),
(4, 'e70f7b3f-83b1-4961-8d4a-df7f35e5c4e4', 'Elección de representantes para la junta', 'Votación para elegir representantes del condominio para la junta administrativa.', 'active');

-- Tabla: questions
CREATE TABLE questions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL UNIQUE,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    voting_session_id BIGINT UNSIGNED NULL,
    closes_at TIMESTAMP NULL DEFAULT NULL,
    created_by BIGINT UNSIGNED NULL,
    updated_by BIGINT UNSIGNED NULL,
    FOREIGN KEY (voting_session_id) REFERENCES voting_sessions(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    restored_at TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO questions (id, uuid, title, description, voting_session_id, closes_at, created_by, updated_by) VALUES
(1, 'f0fa73da-b9b7-4724-9b0b-cdf8e580a392', '¿Quién debe ser el próximo presidente?', 'Votación para elegir el próximo presidente de condominio. Los candidatos son Carlos Méndez y Ana Torres.', 1, '2025-05-10 23:59:59', 1, 1),
(2, 'c39edbd0-e8fa-4567-a343-18c9de19fe6a', '¿Qué proyecto debe aprobarse primero?', 'Votación para seleccionar el primer proyecto de mantenimiento. Las opciones son Proyecto A - Piscina o Proyecto B - Jardines.', 2, '2025-05-15 23:59:59', 2, 2),
(3, 'e756d4c8-4c1d-4171-bebd-f21c7c865105', '¿Debe modificarse el reglamento interno?', 'Votación para aprobar las modificaciones al reglamento interno del condominio.', 3, '2025-05-20 23:59:59', 3, 3),
(4, '4baf53cd-4aef-4c8c-897e-e6187e40d34d', '¿Quién debe ser el nuevo representante en la junta?', 'Votación para elegir al nuevo representante en la junta administrativa del condominio.', 4, '2025-05-25 23:59:59', 4, 4);

-- Tabla: options
CREATE TABLE options (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    question_id BIGINT UNSIGNED NOT NULL,
    text VARCHAR(255) NOT NULL,
    votes_cache INT UNSIGNED DEFAULT 0,
    created_by BIGINT UNSIGNED NULL,
    updated_by BIGINT UNSIGNED NULL,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    restored_at TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO options (id, question_id, text, created_by, updated_by) VALUES
(1, 1, 'Carlos Méndez', 1, 1),
(2, 1, 'Ana Torres', 1, 1),
(3, 2, 'Proyecto A - Piscina', 1, 1),
(4, 2, 'Proyecto B - Jardines', 2, 2),
(5, 3, 'Sí', 3, 3),
(6, 3, 'No', 3, 3),
(7, 4, 'Juan Pérez', 4, 4),
(8, 4, 'Sofía Martín', 4, 4);

-- Tabla: votes
CREATE TABLE votes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL UNIQUE,
    user_id BIGINT UNSIGNED NOT NULL,
    question_id BIGINT UNSIGNED NOT NULL,
    option_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
    FOREIGN KEY (option_id) REFERENCES options(id) ON DELETE CASCADE,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    restored_at TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_vote (user_id, question_id)
);

INSERT INTO votes (uuid, user_id, question_id, option_id) VALUES
('8dbab15e-87bb-4e5d-84cf-cb4f8be612e0', 2, 1, 2),
('d1fc9d1f-2fdb-4640-8b61-90a758f1d393', 3, 1, 1),
('ec9b67ab-7f88-40d7-800b-54c2c24d6872', 4, 2, 3),
('b69e4b3e-b8fe-497b-90ae-fb0f22d6c8ea', 5, 3, 6),
('1abfb08f-bc22-462e-b6fe-f632eaad3813', 6, 4, 7),
('aceac6d4-7270-4e0f-a2c3-b4e8e6256db1', 7, 2, 4);

-- Tabla: password_resets
CREATE TABLE password_resets (
    email VARCHAR(150) NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO password_resets (email, token) VALUES
('laura.gomez@outlook.com', 'reset_token_hash_1'),
('carlos.mendez@gmail.com', 'reset_token_hash_2'),
('javier.sanchez@gmail.com', 'reset_token_hash_3'),
('maria.lopez@outlook.com', 'reset_token_hash_4');

-- Tabla: sessions
CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    expired_at TIMESTAMP NULL,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    payload TEXT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO sessions (id, user_id, ip_address, user_agent, payload) VALUES
('a0b23d0b-69bb-4724-8ba6-3e59cc12b84c', 2, '192.168.0.5', 'Mozilla/5.0', '{"auth":true}'),
('c1e9baf4-93da-4631-b3e5-e53b5dbfaed8', 3, '192.168.0.6', 'Mozilla/5.0', '{"auth":true}'),
('a0c23f5e-07a3-4b6e-9e57-9c792b69da93', 6, '192.168.0.7', 'Mozilla/5.0', '{"auth":true}'),
('c2d9a4fb-d960-4649-8759-d1f1c3bdb9e0', 8, '192.168.0.8', 'Mozilla/5.0', '{"auth":true}');

-- Tabla: activity_logs
CREATE TABLE activity_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    action VARCHAR(100) NOT NULL,
    target_table VARCHAR(100) NULL,
    target_id BIGINT UNSIGNED NULL,
    description TEXT,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

INSERT INTO activity_logs (user_id, action, target_table, target_id, description, ip_address, user_agent) VALUES
(1, 'create', 'voting_sessions', 1, 'Creó la sesión de votación para presidente', '192.168.0.10', 'Mozilla/5.0'),
(2, 'vote', 'questions', 1, 'Votó por opción 2 (Ana Torres)', '192.168.0.5', 'Mozilla/5.0'),
(5, 'create', 'voting_sessions', 2, 'Creó la sesión de votación para proyectos de mantenimiento', '192.168.0.20', 'Mozilla/5.0'),
(7, 'create', 'questions', 2, 'Creó la pregunta sobre proyectos de mantenimiento', '192.168.0.30', 'Mozilla/5.0');

-- Tabla: cache
CREATE TABLE cache (
    `key` VARCHAR(255) PRIMARY KEY,
    value MEDIUMTEXT NOT NULL,
    expiration INT NOT NULL
);

-- Insert for cache table
INSERT INTO cache (`key`, value, expiration) VALUES
('user_data_123', '{"name": "Juan Pérez", "email": "juan.perez@gmail.com"}', 3600),
('session_data_987', '{"session_id": "a0b23d0b-69bb-4724-8ba6-3e59cc12b84c", "status": "active"}', 3600);

-- Tabla: cache_locks
CREATE TABLE cache_locks (
    `key` VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INT NOT NULL
);

-- Insert for cache_locks table
INSERT INTO cache_locks (`key`, owner, expiration) VALUES
('user_data_123', 'admin_user', 600),
('session_data_987', 'maintenance_team', 600);

-- Tabla: jobs
CREATE TABLE jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    queue VARCHAR(50) NOT NULL,
    payload LONGTEXT NOT NULL,
    attempts INT UNSIGNED DEFAULT 0,
    reserved_at TIMESTAMP NULL,
    available_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert for jobs table
INSERT INTO jobs (queue, payload) VALUES
('default', '{"task": "send_email", "to": "juan.perez@gmail.com", "subject": "Bienvenido"}'),
('maintenance', '{"task": "notify_maintenance_team", "project": "Proyecto A - Piscina"}'),
('default', '{"task": "send_email", "to": "laura.gomez@outlook.com", "subject": "Recordatorio de votación"}'),
('maintenance', '{"task": "notify_maintenance_team", "project": "Proyecto B - Jardines"}');
