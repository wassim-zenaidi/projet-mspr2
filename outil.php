<?php 
    session_start();
    require_once 'config.php'; // ajout connexion bdd 
   // si la session existe pas soit si l'on est pas connecté on redirige
    if(!isset($_SESSION['user'])){
        header('Location:p_connexion.php');
        die();
    }

    // On récupere les données de l'utilisateur
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();
   
?>

<!DOCTYPE html>
<html lang="en">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BonzaÏ</title>
	<link rel="icon" type="image/png" href="favicon.png" />
	<link rel="stylesheet" type="text/css" href="styles.css" /> </head>


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
    <body>
    <div class="outil" id="outil">
		<a>Scannez votre plante</a>
        <div class="file-input">
            <input type="file" id="file" class="file">
            <label for="file">BonsAÏ</label>
    </div>
    <script src="script.js"></script>
    <style>
		.outil a{
			margin-bottom: 50px;
			font-size: 35px;
			color: rgb(7, 113, 109);
		  }
	</style>

</body>
</html>