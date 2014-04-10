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
		<p class="accueil">Nos fleurs :</p>
		<br><br><br>
			<script type="text/javascript" src="afficher_cacher_div.js"></script> 

<!--  Bouton navigation des plantes -->
<div class="navigation">
<span class="bouton" id="bouton_texte3" onclick="javascript:afficher_cacher('texte3');">Afficher les fleurs</span><div class="bouton2">les fleurs</div>
<span class="bouton" id="bouton_texte" onclick="javascript:afficher_cacher('texte');">Afficher les plantes</span><div class="bouton2">les plantes</div>
    <span class="bouton" id="bouton_texte2" onclick="javascript:afficher_cacher('texte2');">Afficher les compo</span><div class="bouton2">les compositions</div>
</div>
    <div id="texte" class="texte">
<?php plants() ?>
<div class="clear"></div>
        </div>
    <script type="text/javascript">
    //<!--
        afficher_cacher('texte');
    //-->
        </script>


    <div id="texte2" class="texte">
<?php compo() ?>
<div class="clear"></div>
        </div>
    <script type="text/javascript">
    //<!--
        afficher_cacher('texte2');
    //-->
        </script>
    
    <div id="texte3" class="texte">
<?php fleurs() ?>
<div class="clear"></div>
        </div>
    <script type="text/javascript">
    //<!--
        afficher_cacher('texte3');
    //-->
        </script>



<?php 
function plants()
{
					try
					{
											$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
											$categorie = "plantes" ;
											$bdd = new PDO('mysql:host='.'localhost'.';dbname='.'lafleur_vitrine', 'root');
											$reponseReq = $bdd->query('SELECT * FROM produits WHERE categorie = "'.$categorie.'" ');
											while ( $donnees = $reponseReq->fetch() )
											{
													
												echo '<div class="cadre">';
												echo '<div class="bas">';
												echo '<div class="basgauche">';
												echo  $donnees['nom'];
												echo '</div>';
												echo '<div class="basdroit">';
												echo  $donnees['prix'].'€';
												echo '</div></div>';
												echo '<img src="img/'.$categorie.'/'.$donnees['image'].'" alt="modifier"/>';
												echo '</div>';
										
											}
					}
					catch (Exception $erreur)
					{
										die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
					}	
}


function fleurs()
{
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$categorie = "fleurs" ;
		$bdd = new PDO('mysql:host='.'localhost'.';dbname='.'lafleur_vitrine', 'root');
		$reponseReq = $bdd->query('SELECT * FROM produits WHERE categorie = "'.$categorie.'" ');
		while ( $donnees = $reponseReq->fetch() )
		{
				
			echo '<div class="cadre">';
			echo '<div class="bas">';
			echo '<div class="basgauche">';
			echo  $donnees['nom'];
			echo '</div>';
			echo '<div class="basdroit">';
			echo  $donnees['prix'].'€';
			echo '</div></div>';
			echo '<img src="img/'.$categorie.'/'.$donnees['image'].'" alt="modifier"/>';
			echo '</div>';

		}
	}
	catch (Exception $erreur)
	{
		die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
	}
}


function compo()
{
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$categorie = "compo" ;
		$bdd = new PDO('mysql:host='.'localhost'.';dbname='.'lafleur_vitrine', 'root');
		$reponseReq = $bdd->query('SELECT * FROM produits WHERE categorie = "'.$categorie.'" ');
		while ( $donnees = $reponseReq->fetch() )
		{
				
			echo '<div class="cadre">';
			echo '<div class="bas">';
			echo '<div class="basgauche">';
			echo  $donnees['nom'];
			echo '</div>';
			echo '<div class="basdroit">';
			echo  $donnees['prix'].'€';
			echo '</div></div>';
			echo '<img src="img/'.$categorie.'/'.$donnees['image'].'" alt="modifier"/>';
			echo '</div>';

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