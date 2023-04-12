<?php 
   session_start();
   require_once 'config.php'; // ajout connexion bdd 
   // si la session existe pas soit si l'on est pas connecté on redirige
   if(!isset($_SESSION['user'])){
       header('Location:index.php');
       die();
   }
   
   // On récupere les données de l'utilisateur
   $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
   $req->execute(array($_SESSION['user']));
   $data = $req->fetch();
   
   
   //cookies
   if(!isset($_COOKIE['pseudo']) || empty($_COOKIE['pseudo'])){
    setcookie('pseudo', $data['pseudo'], time() + (30 *24 * 3600), null, null, false, true );
   
   }
   
   if(!isset($_COOKIE['fav_plante']) || empty($_COOKIE['fav_plante'])){
   setcookie('fav_plante', $data['fav_plante'], time() + (30 *24 * 3600), null, null, false, true );
   }
   
   ?>
<!doctype html>
<html lang="en">
   <head>
      <title>Espace membre</title>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" type="image/png" href="favicon.png" />
      <link rel="stylesheet" type="text/css" href="styles.css" />
   </head>
   <body>
      <header>
         <ul>
            <li><a href="landing.php">Accueil</a></li>
            <li><a href="outil.php">Outil</a></li>
         </ul>
         <div class="profile">
            <a href="Profile.html">My Profile</a>
         </div>
      </header>
      <div class="home">
         <div class="box_home">
            <img src="logo-bis.png" height="330px" width="370px">
         </div>
         <p class="p-5">Bonjour <?php echo $data['pseudo']; ?> !</p>
      </div>
      <div class="cookie-popup">
         <div class="cookie-popup-content">
            <p>Ce site utilise des cookies pour améliorer votre expérience de navigation.</p>
            <div class="cookie-popup-buttons">
               <button id="cookie-popup-accept">Accepter</button>
               <button id="cookie-popup-decline">Refuser</button>
            </div>
         </div>
      </div>
      <script>
         // Récupération du bouton d'acceptation de cookies et de la boîte de dialogue de cookies
         const cookieBtn = document.querySelector('.cookie-popup-buttons');
         const cookieBox = document.querySelector('.cookie-popup');
         
         // Fonction pour cacher la boîte de dialogue de cookies
         const hideCookieBox = () => {
         cookieBox.style.display = 'none';
         }
         
         // Fonction pour ajouter un cookie avec une durée de validité de 30 jours
         const addCookie = () => {
         document.cookie = 'cookie-popup-accept=true; expires=' + new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toUTCString() + '; path=/';
         }
         
         // Vérification si le cookie est déjà accepté
         const checkCookieAccepted = () => {
         return document.cookie.split(';').some((item) => {
         return item.trim().startsWith('cookie-popup-accept=');
         });
         }
         
         // Si le cookie est déjà accepté, on cache la boîte de dialogue
         if (checkCookieAccepted()) {
         hideCookieBox();
         }
         
         // Gestion de l'événement de clic sur le bouton d'acceptation de cookies
         cookieBtn.addEventListener('click', () => {
         addCookie();
         hideCookieBox();
         });
         
      </script>
   </body>
   <style>
      .cookie-popup {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: #333;
      color: #fff;
      padding: 20px;
      z-index: 9999;
      }
      .cookie-btn {
      background-color: #fff;
      color: #333;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
      }
      .cookie-btn:hover {
      background-color: #ccc;
      }
   </style>
</html>