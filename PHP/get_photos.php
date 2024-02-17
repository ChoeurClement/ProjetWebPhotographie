<?php
include 'connexion.php';

if (isset($_GET['album'])) {
    $albumName = $_GET['album'];

    $conn = connect_to_db();

    $stmt = $conn->prepare("SELECT chemin_image, description_image FROM images WHERE categorie_image = :albumName");
    $stmt->bindParam(':albumName', $albumName, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $row) {
        echo "<div class='photo'>";
        echo "<img src='images/" . htmlspecialchars($row["chemin_image"], ENT_QUOTES) . "' alt='" . htmlspecialchars($row["description_image"], ENT_QUOTES) . "'>";
        echo "</div>";
    }

    $conn = null;
} else {
    echo "Aucun album spécifié.";
}
?>
