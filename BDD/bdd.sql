-- CREATE DATABASE web_photographie;
-- USE web_photographie;

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_admin VARCHAR(50) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_ajout_admin TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chemin_image VARCHAR(255) NOT NULL,
    categorie_image VARCHAR(50),
    description_image VARCHAR(255),
    date_ajout_image TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);