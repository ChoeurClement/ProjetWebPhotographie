<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur</title>
</head>
<body>
    <?php
    session_start();

    // Vérifier si l'administrateur est connecté
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: connexion_admin.html"); // Rediriger vers la page de connexion si l'administrateur n'est pas connecté
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
    <a href="../PHP/deconnexion.php">Déconnexion</a>
    <h1>Dashboard Admin</h1>
    <form action="../PHP/upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*">
        <input type="text" name="categorie" placeholder="Catégorie de l'image">
        <textarea name="description" placeholder="Description de l'image"></textarea>
        <input type="submit" value="Envoyer">
    </form>
    <script src="script.js"></script>
</body>
</html>