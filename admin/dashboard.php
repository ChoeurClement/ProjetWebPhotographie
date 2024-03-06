<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur</title>
    <meta name="author" content="Clément Choeur" />
    <meta name="copyright" content="" />
    <link rel="stylesheet" type="text/css" href="../styles.css" />
</head>
<body>
    <?php
    session_start();

    // Vérifier si l'administrateur est connecté
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: connexion_admin.html");
        exit();
    }
    ?>
    <header>
      <nav role="navigation">
        <div id="menuToggle">
          <input type="checkbox" id="toggleCheckbox">
            <label for="toggleCheckbox" class="menu-icon">
                <span></span>
                <span></span>
                <span></span>
            </label>
          <ul id="menu">
            <li><a href="index.html">Accueil</a></li>
            <li><a href="album.php">Photos</a></li>
            <li><a href="aPropos.html">À propos</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><img src="../icone/sun.png" id="icon"/></li>
          </ul>
        </div>
        <button class="logout-btn" onclick="window.location.href='../PHP/deconnexion.php'">Déconnexion</button>
      </nav>
    </header>
    <hr>
    <main>
        <?php
        if (isset($_SESSION['nom_admin'])) {
            $nom_admin = $_SESSION['nom_admin'];
            echo "<h1><span class='text-degrade'>$nom_admin</span>, Dashboard</h1>";
        } else {
            echo "Erreur : Nom d'administrateur non trouvé.";
        }
        ?>
        <div class="card">
            <h2>Ajout Photo</h2>
            <form action="../PHP/upload.php" method="post" enctype="multipart/form-data">
                <div class="file-upload-wrapper">
                    <input type="file" name="image" accept="image/*" id="file-upload" style="display:none;">
                    <button type="button" class="btnEnvoyer file-upload-button">Choisir une image</button>
                    <p id="file-upload-name">Aucun fichier sélectionné</p>
                </div>
                <hr>
                <div class="form-group">
                    <label for="categorie">Nom Album</label>
                    <input type="text" name="categorie" placeholder="Ex : Automobile ...">
                </div>
                <div class="form-group">
                    <label for="Description">Description Image</label>
                    <textarea id="description" name="description" placeholder="Description de l'image"></textarea>
                </div>
                <button type="submit" class="btnEnvoyer">Ajouter</button>
            </form>
        </div>
        <div class="card">
            <?php
                include '../PHP/connexion.php';
                $conn = connect_to_db();

                if ($conn) {
                    try {
                        $requete = "SELECT * FROM images";
                        $resultat = $conn->query($requete);
                        $images = $resultat->fetchAll(PDO::FETCH_ASSOC);
                    } catch(PDOException $e) {
                        echo "Erreur lors de la récupération des images : " . $e->getMessage();
                        $images = [];
                    }
                
                    $conn = null;
                }  
                foreach ($images as $image) : 
            ?>
                <div id="image-<?php echo $image['image_id']; ?>" class="image">
                    <img src="../images/<?php echo htmlspecialchars($image['chemin_image']); ?>" alt="<?php echo htmlspecialchars($image['description_image']); ?>">
                    <button onclick="supprimerImage('<?php echo $image['image_id']; ?>')">Supprimer</button>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <hr>
    <footer>

    </footer>
    <script src="../script.js"></script>
</body>
</html>