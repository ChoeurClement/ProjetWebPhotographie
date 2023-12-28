<?php
include 'connexion.php'; // Fichier de connexion
session_start();

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../admin/connexion_admin.html"); // Rediriger vers la page de connexion si l'administrateur n'est pas connecté
    exit();
}

$targetDirectory = "../images/"; // Dossier où les images seront stockées
$targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Vérifier si le fichier est une image réelle
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "Le fichier est une image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }
}

// Vérifier si le fichier existe déjà
if (file_exists($targetFile)) {
    echo "Désolé, le fichier existe déjà.";
    $uploadOk = 0;
}

// Vérifier la taille du fichier
if ($_FILES["image"]["size"] > 50000000) { // Limite à 50MB ici
    echo "Désolé, le fichier est trop volumineux.";
    $uploadOk = 0;
}

// Autoriser certains formats de fichier
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Désolé, le fichier n'a pas été téléchargé.";
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "Le fichier ". basename( $_FILES["image"]["name"]). " a été téléchargé.";

        // Récupérer les autres informations du formulaire
        $targetFile = basename($_FILES["image"]["name"]);
        $categorie = $_POST['categorie'];
        $description = $_POST['description'];

        $conn = connect_to_db();

        if ($conn) {
            try {
                // Requête préparée pour l'insertion des données dans la table images
                $stmt = $conn->prepare("INSERT INTO images (chemin_image, categorie_image, description_image) VALUES (:chemin_image, :categorie_image, :description_image)");
                $stmt->bindParam(':chemin_image', $targetFile);
                $stmt->bindParam(':categorie_image', $categorie);
                $stmt->bindParam(':description_image', $description);
        
                if ($stmt->execute()) {
                    echo "Les informations ont été ajoutées à la base de données.";
                } else {
                    echo "Erreur lors de l'insertion des informations.";
                }
            } catch(PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        
            // Fermeture de la connexion
            $conn = null;
        }        
    } else {
        echo "Une erreur s'est produite lors du téléchargement du fichier.";
    }
}
?>
