CREATE DATABASE web_photographie;
USE web_photographie;

CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    nom_admin VARCHAR(50) NOT NULL,
    mot_de_passe VARCHAR(100) NOT NULL,
    date_ajout_admin TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE images (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    chemin_image VARCHAR(255) NOT NULL,
    categorie_image VARCHAR(50),
    description_image TEXT,
    date_ajout_image TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    admin_id INT,
    FOREIGN KEY (admin_id) REFERENCES admins(admin_id)
);

CREATE TABLE messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    nom_message VARCHAR(50) NOT NULL,
    email_message VARCHAR(100) NOT NULL,
    sujet_message VARCHAR(100),
    contenu_message TEXT,
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);