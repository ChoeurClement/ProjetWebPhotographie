<?php
  include 'PHP/connexion.php';

  // Connexion à la base de données
  $conn = connect_to_db();

  // Requête pour récupérer les catégories d'albums
  $stmt = $conn->prepare("SELECT DISTINCT categorie_image FROM images");
  $stmt->execute(); 
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Albums Photo</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Accueil du site" />
    <meta name="author" content="Clément Choeur" />
    <meta name="copyright" content="" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
  </head>
  <body>
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
            <li><img src="icone/sun.png" id="icon"/></li>
          </ul>
        </div>
      </nav>
      <img src="images/p3.jpg" />
    </header>
    <hr>
    <main>
      <section class="presentation">
        <h1>Albums Photo</h1>
        <input type="text" id="searchBar" placeholder="Rechercher un album..." onkeyup="searchAlbum()">
        <div id="album-container">
          <?php
            foreach($result as $row) {
              echo "<div class='album' onclick='showPhotos(\"" . htmlspecialchars($row["categorie_image"], ENT_QUOTES) . "\")'>";
              echo "<h3>" . htmlspecialchars($row["categorie_image"], ENT_QUOTES) . "</h3>";
              echo "</div>";
            }
          ?>
        </div>
      </section>
    </main>

    <div id="photos-container" style="display:none;">
      <button id="backButton">Retour</button>
      <div id="photo-content">
        <!-- Les photos seront chargées ici -->
      </div>
    </div>
    <div id="fullscreen-container" style="display:none;">
      <span id="close-fullscreen">&#10005;</span>
      <img id="fullscreen-img" src="" alt="Image en plein écran">
    </div>
    <hr>
    <footer>
      <p>© - Savinien Lepoivre</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>

<?php
  $conn = null;
?>