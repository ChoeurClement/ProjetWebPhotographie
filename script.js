var icon = document.getElementById("icon");

document.addEventListener('DOMContentLoaded', function() {
    var savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add("dark-theme");
        icon.src = "icone/moon.png";
    } else {
        document.body.classList.remove("dark-theme");
        icon.src = "icone/sun.png";
    }
});


icon.onclick = function() {
    document.body.classList.toggle("dark-theme");
    if(document.body.classList.contains("dark-theme")){
        icon.src = "icone/moon.png";
        localStorage.setItem('theme', 'dark'); // Sauvegarde du thème sombre
    } else {
        icon.src = "icone/sun.png";
        localStorage.setItem('theme', 'light'); // Sauvegarde du thème clair
    }
}

document.getElementById('backButton').addEventListener('click', function() {
    document.getElementById('photos-container').style.display = 'none';
    document.getElementById('album-container').style.display = 'block';
    document.getElementById('searchBar').style.display = 'block';
});

function showPhotos(albumName) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'PHP/get_photos.php?album=' + encodeURIComponent(albumName), true);

    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('photo-content').innerHTML = this.responseText;
            document.getElementById('album-container').style.display = 'none';
            document.getElementById('searchBar').style.display = 'none';
            document.getElementById('photos-container').style.display = 'block';
        } else {
            console.error('Erreur lors de la requête : ' + this.status);
        }
    };

    xhr.onerror = function() {
        console.error('Erreur de réseau');
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

// Ouverture en plein écran
function openFullscreen(src) {
    document.getElementById('fullscreen-img').src = src;
    document.getElementById('fullscreen-container').style.display = 'flex';
}

// Fermeture du plein écran
document.getElementById('close-fullscreen').addEventListener('click', function() {
    document.getElementById('fullscreen-container').style.display = 'none';
});

var images = document.getElementsByClassName('photo');
for (var i = 0; i < images.length; i++) {
    images[i].addEventListener('click', function() {
        openFullscreen(this.src);
    });
}
