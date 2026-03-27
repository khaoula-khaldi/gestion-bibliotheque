
CREATE DATABASE gestion_bibliotheque;
drop database gestion_bibliotheque;
USE gestion_bibliotheque;

-- ========================
-- TABLE USERS
-- ========================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    password VARCHAR(255),
    role ENUM('lecteur', 'bibliothecaire') DEFAULT 'lecteur',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ========================
-- TABLE AUTEURS
-- ========================
CREATE TABLE auteurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    date_naissance DATE,
    biographie TEXT
);

-- ========================
-- TABLE LIVRES
-- ========================
CREATE TABLE livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255),
    isbn VARCHAR(50) UNIQUE,
    annee INT,
    type ENUM('free', 'premium') DEFAULT 'free',
    prix DECIMAL(8,2) DEFAULT 0,
    disponible BOOLEAN DEFAULT TRUE,
    auteur_id INT,
    FOREIGN KEY (auteur_id) REFERENCES auteurs(id)
);

-- ========================
-- TABLE EMPRUNTS
-- ========================
CREATE TABLE emprunts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    livre_id INT,
    date_emprunt DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_retour DATETIME NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (livre_id) REFERENCES livres(id)
);

-- ========================
-- TABLE ACHATS
-- ========================
CREATE TABLE achats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    livre_id INT,
    prix DECIMAL(8,2),
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (livre_id) REFERENCES livres(id)
);

-- ========================
-- TABLE SUBSCRIPTIONS
-- ========================
CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    type ENUM('mensuel', 'annuel'),
    date_debut DATE,
    date_fin DATE,
    statut ENUM('actif', 'expiré'),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (name, email, password, role) VALUES
('Admin', 'admin@gmail.com', '$2y$10$wH7Qy9K8X7F5rJ5YkqQb5uQW6Fz7H6Fz7H6Fz7H6Fz7H6Fz7H6Fz7', 'admin'),
('user', 'user@gmail.com', '$2y$10$wH7Qy9K8X7F5rJ5YkqQb5uQW6Fz7H6Fz7H6Fz7H6Fz7H6Fz7H6Fz7', 'lecteur');

INSERT INTO auteurs (nom, prenom, created_at, updated_at) VALUES
('Hugo', 'Victor', NOW(), NOW()),
('Camus', 'Albert', NOW(), NOW()),
('Zola', 'Emile', NOW(), NOW());

INSERT INTO livres (titre, description, type, disponible, auteur_id, created_at, updated_at) VALUES
('Les Misérables', 'Roman classique très célèbre', 'free', 1, 1, NOW(), NOW()),
('L’étranger', 'Roman philosophique de Camus', 'free', 1, 2, NOW(), NOW()),
('Germinal', 'Roman social sur les mineurs', 'premium', 1, 3, NOW(), NOW()),
('Monte Cristo', 'Histoire de vengeance', 'premium', 0, 1, NOW(), NOW());
DESCRIBE livres;