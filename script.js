var icon = document.getElementById("icon");

icon.onclick = function() {
    document.body.classList.toggle("dark-theme");
    if(document.body.classList.contains("dark-theme")){
        icon.src = "icone/moon.png";
    }else{
        icon.src = "icone/sun.png";
    }
}

function showPhotos(albumName) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'PHP/get_photos.php?album=' + encodeURIComponent(albumName), true);

    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('photos-container').innerHTML = this.responseText;
            document.getElementById('album-container').style.display = 'none';
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