<!DOCTYPE html>
<html lang="en">
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
         <div class="login-form">
            <?php 
               if(isset($_GET['reg_err']))
               {
                   $err = htmlspecialchars($_GET['reg_err']);
               
                   switch($err)
                   {
                       case 'success':
                       ?>
            <div class="alert alert-success">
               <strong>Succès</strong> inscription réussie ,
               <a href="p_connexion.php">  <strong> Connectez-vous ! </strong> </a>
            </div>
            <?php
               break;
               
               case 'password':
               ?>
            <div class="alert alert-danger">
               <strong>Erreur</strong> mot de passe différent
            </div>
            <?php
               break;
               
               case 'email':
               ?>
            <div class="alert alert-danger">
               <strong>Erreur</strong> email non valide
            </div>
            <?php
               break;
               
               case 'email_length':
               ?>
            <div class="alert alert-danger">
               <strong>Erreur</strong> email trop long
            </div>
            <?php 
               break;
               
               case 'pseudo_length':
               ?>
            <div class="alert alert-danger">
               <strong>Erreur</strong> pseudo trop long
            </div>
            <?php 
               case 'already':
               ?>
            <div class="alert alert-danger">
               <strong>Erreur</strong> compte deja existant
            </div>
            <?php 
               }
               }
               ?>
            <form action="inscription_traitement.php" method="post">
               <h2 class="text-center">Inscription</h2>
               <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
               </div>
               <div class="form-group">
                  <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required="required" autocomplete="off">
               </div>
               <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
               </div>
               <div class="form-group">
                  <input type="password" name="password_retype" class="form-control" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
               </div>
               <div class="form-group">
                  <input type="text" name="fav_plante" class="form-control" placeholder="Votre plante préféré ?" required="required" autocomplete="off">
               </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block">Inscription</button>
               </div>
            </form>
         </div>
      </div>
      <style>
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
         body{
         background-color: rgb(7, 113, 109);
         }

         a{
           
            color : white;
         }
      </style>
   </body>
</html>