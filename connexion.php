<?php 
    session_start(); // Démarrage de la session
    require_once 'config.php'; // On inclut la connexion à la base de données

    if(!empty($_POST['email']) && !empty($_POST['password'])) // Si il existe les champs email, password et qu'il sont pas vident
    {
        // Patch XSS
        $email = htmlspecialchars($_POST['email']); 
        $password = htmlspecialchars($_POST['password']);
        
        $email = strtolower($email); // email transformé en minuscule
        
        // On regarde si l'utilisateur est inscrit dans la table utilisateurs
        $check = $bdd->prepare('SELECT pseudo, email, password, token FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();
        
        // Définition de la largeur et de la hauteur de l'image
$width = 150;
$height = 40;

// Génération d'une chaîne de caractères aléatoires
$captcha_code = substr(md5(uniqid(rand(), true)), 0, 6);

// Enregistrement du code captcha dans une variable de session
$_SESSION['captcha_code'] = $captcha_code;

// Création d'une image vide de la taille spécifiée
$image = imagecreatetruecolor($width, $height);

// Couleurs de fond et de texte
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);

// Remplissage de l'image avec la couleur de fond
imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

// Ajout du texte du captcha
imagettftext($image, 20, 0, 10, 30, $text_color, 'fonts/arial.ttf', $captcha_code);

// Affichage de l'image
header('Content-Type: image/png');
imagepng($image);

// Destruction de l'image pour libérer la mémoire
imagedestroy($image);
        

        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            // Si le mail est bon niveau format
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                // Si le mot de passe est le bon
                if(password_verify($password, $data['password']))
                {
                    // On créer la session et on redirige sur landing.php
                    $_SESSION['user'] = $data['token'];
                    header('Location: landing.php');
                    die();
                }else{ header('Location: p_connexion.php?login_err=password'); die(); }
            }else{ header('Location: p_connexion.php?login_err=email'); die(); }
        }else{ header('Location: p_connexion.php?login_err=already'); die(); }
    }else{ header('Location: p_connexion.php'); die();} // si le formulaire est envoyé sans aucune données
