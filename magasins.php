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
		<p class="accueil">Nos magasins :</p>
		<br><br><br>
			<?php 
			mag() 
			?>
			<div class="clear"></div>
			
			<?php 
			
			function mag()
			{
				try 
				{
					$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
					$bdd = new PDO('mysql:host='.'localhost'.';dbname='.'lafleur_vitrine', 'root');
					$reponseReq = $bdd->query('SELECT * FROM boutiques');
					while ( $donnees = $reponseReq->fetch() )
					{
						echo '<div class="cadre_m">';
						echo '<div class="hautbas_m">';
						echo '<div class="haut_m">';
						echo  $donnees['nom'];
						echo '</div>';
						echo '<div class="bas_m">';
						echo  $donnees['rue'];
						echo  " à ".$donnees['ville'];
						echo '</div></div>';
						echo '<div class="image_m">';
						echo '<img src="img/boutiques/boutique_'.$donnees['image'].'.jpg" alt="modifier"/>';
						echo '</div><div class="clear"></div>';
					}
				}
				catch (Exception $erreur) 
				{
					die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
				}
			}
			
			?>
	</div>
</body>
</html>