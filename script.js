var icon = document.getElementById("icon");

document.addEventListener("DOMContentLoaded", function () {
  var savedTheme = localStorage.getItem("theme");
  var iconPath = window.location.pathname.includes("/admin/")
    ? "../icone/"
    : "icone/";

  if (savedTheme === "dark") {
    document.body.classList.add("dark-theme");
    icon.src = iconPath + "moon.png";
  } else {
    document.body.classList.remove("dark-theme");
    icon.src = iconPath + "sun.png";
  }
});

var fileUploadButton = document.querySelector(".file-upload-button");
if (fileUploadButton) {
  fileUploadButton.addEventListener("click", function () {
    document.getElementById("file-upload").click();
  });
}

var fileInput = document.getElementById("file-upload");
if (fileInput) {
  fileInput.addEventListener("change", function () {
    var fileName = this.value.split("\\").pop();
    document.getElementById("file-upload-name").textContent = fileName;
  });
}

icon.onclick = function () {
  var iconPath = window.location.pathname.includes("/admin/")
    ? "../icone/"
    : "icone/";

  document.body.classList.toggle("dark-theme");
  if (document.body.classList.contains("dark-theme")) {
    icon.src = iconPath + "moon.png";
    localStorage.setItem("theme", "dark");
  } else {
    icon.src = iconPath + "sun.png";
    localStorage.setItem("theme", "light");
  }
};

var backButton = document.getElementById("backButton");
if (backButton) {
  backButton.addEventListener("click", function () {
    document.getElementById("photos-container").style.display = "none";
    document.getElementById("album-container").style.display = "block";
    document.getElementById("searchBar").style.display = "block";
  });
}

function showPhotos(albumName) {
  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "PHP/get_photos.php?album=" + encodeURIComponent(albumName),
    true
  );

  xhr.onload = function () {
    if (this.status === 200) {
      document.getElementById("photo-content").innerHTML = this.responseText;
      document.getElementById("album-container").style.display = "none";
      document.getElementById("searchBar").style.display = "none";
      document.getElementById("photos-container").style.display = "block";
    } else {
      console.error("Erreur lors de la requête : " + this.status);
    }
  };

  xhr.onerror = function () {
    console.error("Erreur de réseau");
  };

  xhr.send();
}

function searchAlbum() {
  var input, filter, container, albums, title, i, txtValue;
  input = document.getElementById("searchBar");
  filter = input.value.toUpperCase();
  container = document.getElementById("album-container");
  albums = container.getElementsByClassName("album");

  for (i = 0; i < albums.length; i++) {
    title = albums[i].getElementsByTagName("h3")[0];
    txtValue = title.textContent || title.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      albums[i].style.display = "";
    } else {
      albums[i].style.display = "none";
    }
  }
}

function supprimerImage(idImage) {
  if (confirm("Êtes-vous sûr de vouloir supprimer cette image ?")) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../PHP/suppresion_images.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (this.status == 200) {
          console.log(this.responseText);
          var imageElement = document.getElementById('image-' + idImage);
          if (imageElement) {
              imageElement.parentNode.removeChild(imageElement);
          }
        } else {
          console.error('Erreur lors de la suppression de l’image');
        }
      };
      xhr.send('id=' + idImage);
  }
}

// Ouverture en plein écran
function openFullscreen(src) {
  document.getElementById("fullscreen-img").src = src;
  document.getElementById("fullscreen-container").style.display = "flex";
}

// Fermeture du plein écran
var closeButton = document.getElementById("close-fullscreen");
var fullscreenContainer = document.getElementById("fullscreen-container");
if (closeButton && fullscreenContainer) {
  closeButton.addEventListener("click", function () {
    fullscreenContainer.style.display = "none";
  });
}

var images = document.getElementsByClassName("photo");
if (images.length > 0) {
  for (var i = 0; i < images.length; i++) {
    images[i].addEventListener("click", function () {
      openFullscreen(this.src);
    });
  }
}
