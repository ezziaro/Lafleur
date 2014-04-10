<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start ();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Lafleur</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/lafleur.css">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Alegreya+SC' rel='stylesheet' type='text/css'>
</head>




<body>


	<div class="menu">
		<a class="menu" href="index.php">Accueil</a>
		<a class="menu" href="catalogue.php">Catalogue</a>
		<a class="menu" href="magasins.php">Magasins</a>
		<a class="menu" href="contact.php">Contact</a>
		<?php if (isset($_SESSION['login'])) { ?>
<!--  Contenu de la page connecté -->
<?php echo '<div class="caddie"><img src="img/autres/caddie.png" /></div><br/><div class="caddie2">0 article</div><div class="pseudo">Bonjour,  '.$_SESSION['login'].'</div><br/><a id="apDiv1" href="logout.php">Déconnexion</a></div><a class="admin" href="admin.php">Administration</a>';
} else { ?> 
<!-- Utilisateur non connecté --><?php echo '		<div id="apDiv1">Connexion</div>'; } ?>
	</div>
	
	
	

<div id="apDiv0"><p class="connexion"><u>Connexion</u></p>
	<form id="formConnexion" name="formConnexion"  action="login.php" method="post" >
	<p class="connexion">Utilisateur :</p>
	<input type="text" name="login">
	<p class="connexion">Mot de passe :</p> 
	<input type="password" name="pwd"><br />
	<input type="submit" value="Connexion">
	</form>
</div>
	
	
	
	
	<div class="site">
		<p class="bvn">Bienvenue sur le site LaFleur</p>
		
		
<?php if (isset($_SESSION['login'])) { ?>
<!--  Contenu de la page connecté -->
<?php  
} else { ?> 
<!-- Utilisateur non connecté --><?php echo 'Veuillez vous connecter !'; } ?>
<br/>
<br/>
<br/>
<p class="accueil">Vous pourrez ici commander et choisir des fleurs, des compositions faites par nos soins ainsi que de voir nos divers magasins.</p>
</div>
</body>






<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.9.8/TweenMax.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> 
<script src="js/connexion.js"></script>

</html>