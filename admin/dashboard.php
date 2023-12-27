<?php
session_start();

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: connexion_admin.php"); // Rediriger vers la page de connexion si l'administrateur n'est pas connecté
    exit();
}

// Affichage du nom de l'administrateur
if (isset($_SESSION['nom_admin'])) {
    $nom_admin = $_SESSION['nom_admin'];
    echo "Bonjour, $nom_admin ! Vous êtes connecté en tant qu'administrateur.";
} else {
    echo "Erreur : Nom d'administrateur non trouvé.";
}
?>
