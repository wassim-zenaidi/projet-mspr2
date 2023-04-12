<?php
session_start();

// Génère une chaîne aléatoire de 6 caractères
function generateCaptchaString() {
  $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $length = 6;
  $captchaString = "";
  for ($i = 0; $i < $length; $i++) {
    $captchaString .= $chars[rand(0, strlen($chars) - 1)];
  }
  return $captchaString;
}

// Génère une image captcha et stocke la chaîne captcha dans une variable de session
function generateCaptchaImage() {
  $captchaString = generateCaptchaString();
  $_SESSION["captcha"] = $captchaString;

  // Crée une image captcha
  $font = 'fonts/28DaysLater.ttf';
  $image = imagecreatetruecolor(100, 40);
  $backgroundColor = imagecolorallocate($image, 255, 255, 255);
  $textColor = imagecolorallocate($image, 0, 0, 0);
  imagefilledrectangle($image, 0, 0, 100, 40, $backgroundColor);
  imagettftext($image, 20, 0, 10, 30, $textColor, $font, $captchaString);

  // Affiche l'image captcha
  header("Content-type: image/jpeg");
  imagepng($image);
  imagedestroy($image);
}

// Vérifie si la chaîne captcha entrée correspond à la chaîne captcha stockée dans la variable de session
function validateCaptcha($captchaString) {
  if (isset($_SESSION["captcha"]) && strtolower($captchaString) == strtolower($_SESSION["captcha"])) {
    return true;
  } else {
    return false;
  }
}

// Si la requête est un appel pour générer une image captcha, génère l'image captcha
if (isset($_GET["generate"])) {
  generateCaptchaImage();
  exit();
}

// Si le formulaire est soumis, vérifie le captcha
if (isset($_POST["submit"])) {
  if (validateCaptcha($_POST["captcha"])) {
    echo "Captcha is correct!";
  } else {
    echo "Captcha is incorrect. Please try again.";
  }
}
?>

<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BonzaÏ</title>
	<link rel="icon" type="image/png" href="favicon.png" />
	<link rel="stylesheet" type="text/css" href="styles.css" /> 
 </head>

 <body>
    <div id="container">
    <!-- zone de connexion -->
    
    <div class="login-form">
        <?php 
           if(isset($_GET['login_err']))
           {
               $err = htmlspecialchars($_GET['login_err']);

               switch($err)
               {
                   case 'password':
                   ?>
                       <div class="alert alert-danger">
                           <strong>Erreur</strong> mot de passe incorrect
                       </div>
                   <?php
                   break;

                   case 'email':
                   ?>
                       <div class="alert alert-danger">
                           <strong>Erreur</strong> email incorrect
                       </div>
                   <?php
                   break;

                   case 'already':
                   ?>
                       <div class="alert alert-danger">
                           <strong>Erreur</strong> compte non existant
                       </div>
                   <?php
                   break;
               }
           }
           
           ?> 
           
       
       <form action="connexion.php" method="post">
           <h2 class="text-center">Connexion</h2>       
           <div class="form-group">
               <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
           </div>
           <div class="form-group">
               <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
           </div>
           <div class="form-group">
                <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Entrer le captcha"  autocomplete="off">
                <img src="captcha.php?generate" alt="Captcha Image">
           </div>
           <div class="form-group">
               <button type="submit" class="btn btn-primary btn-block">Connexion</button>
           </div>   
       </form> 
   </div>
    </div>
    <style>
        body{
            background-color: rgb(7, 113, 109);
        }

        /* Sélecteur pour le conteneur principal de la page de connexion */


/* Style pour les titres */
h2 {
  text-align: center; /* Centre le texte horizontalement */
  margin-bottom: 20px; /* Ajoute un espace sous le titre */
  color: rgb(7, 113, 109); /* Couleur de texte sombre */
}

/* Style pour les champs de formulaire */
.form-control {
  width: 100%; /* Définit la largeur du champ à 100% */
  height: 45px; /* Définit la hauteur du champ */
  background-color: #f9f9f9; /* Couleur de fond légèrement grise */
  border: none; /* Supprime la bordure par défaut */
  padding: 0 10px; /* Ajoute un espace de remplissage à l'intérieur du champ */
  margin-bottom: 20px; /* Ajoute un espace sous chaque champ */
  border-radius: 5px; /* Arrondit les coins du champ */
 
}

/* Style pour le bouton de connexion */
.btn-primary {

  margin-top:50px;
  background-color: rgb(7, 113, 109); /* Couleur de fond verte */
  border: none; /* Supprime la bordure par défaut */
  width: 100%; /* Définit la largeur du bouton à 100% */
  height: 45px; /* Définit la hauteur du bouton */
  color: white; /* Couleur de texte blanche */
  border-radius: 5px; /* Arrondit les coins du bouton */
  cursor: pointer; /* Change le curseur de la souris en main lorsque survolé */
  transition: all 0.3s ease; /* Ajoute une transition fluide lors de l'hover */
}

/* Style pour le bouton de connexion lorsqu'il est survolé */
.btn-primary:hover {
  background-color: rgb(0, 113, 109); /* Couleur de fond verte foncée */
}



/* Style pour les messages d'erreur */
.alert {
  color: white; /* Couleur de texte blanche */
  padding: 10px 20px; /* Ajoute un espace de remplissage autour du contenu */
  border-radius: 5px; /* Arrondit les coins du conteneur */
  margin-bottom: 20px; /* Ajoute un espace sous chaque message */
}

/* Style pour les messages d'erreur de type "danger" */
.alert-danger {
  background-color: #f44336; /* Couleur de fond rouge */
}
    </style>
 </body>
</html>

