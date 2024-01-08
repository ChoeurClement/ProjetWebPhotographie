// Récupérer l'icône du menu et le menu déroulant
var menuIcon = document.getElementById('menuIcon');
var closeIcon = document.getElementById('closeIcon');
var menuList = document.getElementById('menuList');
var logoHeader = document.getElementById('logoHeader');

// Click sur l'icone menu
menuIcon.addEventListener('click', function() {
  // Vérifier si le menu est actuellement affiché ou caché
  if (menuList.style.display === 'none' || menuList.style.display === '') {
    // Afficher le menu déroulant
    menuList.style.display = 'flex';
    menuIcon.style.display = 'none';
    logoHeader.style.display = 'none';
  } else {
    // Cacher le menu déroulant
    menuList.style.display = 'none';
    menuIcon.style.display = 'block';
    logoHeader.style.display = 'block';
  }
});

// Click sur l'icone close
closeIcon.addEventListener('click', function() {
    // Vérifier si le menu est actuellement affiché ou caché
    if (menuList.style.display === 'none' || menuList.style.display === '') {
      // Afficher le menu déroulant
      menuList.style.display = 'flex';
      menuIcon.style.display = 'none';
      logoHeader.style.display = 'none';
    } else {
      // Cacher le menu déroulant
      menuList.style.display = 'none';
      menuIcon.style.display = 'block';
      logoHeader.style.display = 'block';
    }
  });