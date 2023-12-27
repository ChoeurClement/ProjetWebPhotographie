<?php
include 'connexion.php'; // Inclure le fichier de connexion

// Récupération des données du formulaire
$nom_admin = $_POST['nom_admin'];
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

// Connexion à la base de données en utilisant la fonction connect_to_db()
$conn = connect_to_db();

if ($conn) {
    try {
        // Requête préparée pour l'insertion des données dans la table admins
        $stmt = $conn->prepare("INSERT INTO admins (nom_admin, mot_de_passe) VALUES (:nom_admin, :mot_de_passe)");
        $stmt->bindParam(':nom_admin', $nom_admin);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe);

        if ($stmt->execute()) {
            echo "Inscription réussie";
        } else {
            echo "Erreur lors de l'inscription";
        }
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Fermeture de la connexion
    $conn = null;
} else {
    echo "Une erreur est survenue lors de la connexion à la base de données.";
}
?>
