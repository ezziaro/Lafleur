<?php
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
	</div>
	<div class="site">
		<br><?php 
			if(!isset($_POST['b2'])){?>
				<form method="POST" action="programme.php">
				<fieldset>
				<legend>Nous contacter</legend>
				Veuillez indiquer votre nom : <input class="nom" type="text" name="nom" /><br/><br/>
				Veuillez indiquer votre prénom : <input class="prenom" type="text" name="prenom" /><br/><br/>
				Commentaire : <textarea name="comm" rows="10" cols="100">Entrez un commentaire ...</textarea>
				<br><br>
				<input name="b1" type="reset" value="Effacer" /><input name="b2" type="submit"value="Valider" />
				</fieldset>
				</form>
		<?php }
		?>
	</div>
</body>
</html>