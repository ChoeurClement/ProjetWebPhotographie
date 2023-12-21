<?php
// Paramètres de connexion à la base de données local
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_photographie";

try {
    // Connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour récupérer toutes les lignes de la table images
    $sql = "SELECT * FROM images";
    $result = $conn->query($sql);

    // Vérification et affichage des résultats
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<img src=../".$row["chemin_image"]." width='50%' height=auto>";
        }
    } else {
        echo "Aucun résultat trouvé dans la table images.";
    }
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermeture de la connexion
$conn = null;
?>
