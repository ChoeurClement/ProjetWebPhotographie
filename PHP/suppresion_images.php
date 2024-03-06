<?php
include 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $idImage = $_POST['id'];

    $conn = connect_to_db();
    if (!$conn) {
        exit('Erreur de connexion à la base de données.');
    }

    try {
        $requete = $conn->prepare("SELECT chemin_image FROM images WHERE image_id = :id");
        $requete->execute(['id' => $idImage]);
        $image = $requete->fetch(PDO::FETCH_ASSOC);

        if ($image) {
            $filePath = '../images/' . $image['chemin_image'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $requete = $conn->prepare("DELETE FROM images WHERE image_id = :id");
            $requete->execute(['id' => $idImage]);

            echo "Image supprimée avec succès";
        } else {
            echo "Image non trouvée";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression de l'image : " . $e->getMessage();
    }
} else {
    echo "Requête invalide";
}
?>
