<?php

function connect_to_db() {
    // Paramètres de connexion à la base de données local
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web_photographie";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        return null;
    }
}
?>
