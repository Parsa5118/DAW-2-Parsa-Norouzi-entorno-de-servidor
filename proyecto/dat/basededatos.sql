-- ===============================
-- Base de datos: videojuegos
-- Proyecto: GameNation
-- ===============================

DROP DATABASE IF EXISTS videojuegos;
CREATE DATABASE videojuegos CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE videojuegos;

-- ===============================
-- Tabla: userapp
-- ===============================
CREATE TABLE userapp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- ===============================
-- Tabla: favorites
-- ===============================
CREATE TABLE favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL,
    game_code VARCHAR(100) NOT NULL,
    platform VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_fav (login, game_code),
    FOREIGN KEY (login) REFERENCES userapp(login)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ===============================
-- Tabla: mensajes (contacto)
-- Solo usuarios logueados
-- ===============================
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mensaje TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (login) REFERENCES userapp(login)
        ON DELETE CASCADE
) ENGINE=InnoDB;
