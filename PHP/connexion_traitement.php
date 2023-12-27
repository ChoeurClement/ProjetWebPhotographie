<?php
include 'connexion.php';

// Récupération des données du formulaire
$nom_admin = $_POST['nom_admin'];
$mot_de_passe = $_POST['mot_de_passe'];

// Connexion à la base de données en utilisant la fonction connect_to_db()
$conn = connect_to_db();

if ($conn) {
    try {
        // Requête préparée pour vérifier les informations de connexion
        $stmt = $conn->prepare("SELECT * FROM admins WHERE nom_admin=:nom_admin");
        $stmt->bindParam(':nom_admin', $nom_admin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($mot_de_passe, $result['mot_de_passe'])) {
                session_start();
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['nom_admin'] = $nom_admin;
                header("Location: ../admin/dashboard.php"); // Rediriger vers la page du tableau de bord admin
                exit(); // Arrêter l'exécution du script après la redirection
            } else {
                echo "Mot de passe incorrect";
            }
        } else {
            echo "Nom d'admin incorrect";
        }
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Fermeture de la connexion
    $conn = null;
} else {
    echo "Une erreur est survenue lors de la connexion à la base de données. Veuillez réessayer plus tard.";
    // Log de l'erreur dans un fichier ou autre méthode de journalisation
    error_log("Erreur de connexion à la base de données : Connexion non établie", 0);
}
?>
