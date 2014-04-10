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
		<br>
		<br>
		Administration
		<br><form id="formIns" name="formIns" method="post" class="formulaire">
		<br>Entrez le nom du produit, ou la catégorie ( compo, plantes ou fleurs ) <input class="cText" type="text" id="choix" name="choix" required="required" />
	<input type="submit" name="envoie" value="Chercher" /> 
</form>
	<br>
		<br>
	
	<?php
	include("inc/connexion.php");
	include("inc/fonction.inc.php");

	
	echo '<table>';
	echo '<tr>';
	echo '<td>';
	echo '<p> Image </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> Nom </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> Sous-titre </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> Prix </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> url de l\'image </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> Catégorie </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> Supp </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> Modif </p>';
	echo '</td>';
echo '</tr>';

if ( isset($_POST['choix']) )
{
	$choix =  $_POST['choix'];
	try 
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp); 
		
		if ($choix == 'compo' || $choix == 'plantes' || $choix == 'fleurs' )
		{ 
			$reponseReq = $bdd->query('SELECT * FROM produits WHERE categorie = \''.$choix.'\'');
		}
		else 
		{
			$reponseReq = $bdd->query('SELECT * FROM produits  Where nom = \''.$choix.'\'');
		}		
		
		while ( $donnees = $reponseReq->fetch() )
		{
	
			echo '<tr>';
				echo '<td>';
				echo '<img src="img/'.$choix.'/'.$donnees['image'].'" width="64" height="64" />';
				echo '</td>';
				echo '<td>';
				echo  $donnees['nom'];
				echo '</td>';
				echo '<td>';
				echo  $donnees['sous_titre'];
				echo '</td>';
				echo '<td>';
				echo  $donnees['prix'].'€';
				echo '</td>';
				echo '<td>';
				echo 'img/'.$choix.'/'.$donnees['image'];
				echo '</td>';
				echo '<td>';
				echo $donnees['categorie'];
				echo '</td>';
				echo '<td>';
				echo '<a class="supp" href="?supp='.$donnees['produit_id'].'"><img class="supp" src="img/supp.png" />';
				echo '</td>';
				echo '<td>';
				echo '<a class="modif" href="?modifId='.$donnees['produit_id'].'"><img class="modif" src="img/modif.png" />';
				echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
	
	catch (Exception $erreur) 	
		{
			die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
		}
}

if ( isset($_GET['supp']) && !empty($_GET['supp']) )
{
	$supp = $_GET['supp'];
	supp($supp, $base, $hote, $utilisateur, $mdp);
}
if ( isset($_GET['modifId']) && !empty($_GET['modifId']) )
{
	$modifId = $_GET['modifId'];
	modif($modifId, $base, $hote, $utilisateur, $mdp);			
}
?>

<?php 
if(isset($_GET['modifId']))
{?>
	<form id="formModif" name="formModif" method="GET" class="formulaire">
	<br>Entrez le nom <input type="text" id="modifNom" name="modifNom" required="required" />
	<br>Entrez le sous-titre <input type="text" id="modifST" name="modifST" required="required" />
	<br>Entrez le prix <input type="text" id="modifPrix" name="modifPrix" required="required" />
	<br>Entrez la catégorie <input type="text" id="modifCat" name="modifCat" required="required" />
	<?php echo '<input type="text" id="modifId" name="modifId" hidden="hidden" value= "'.$_GET['modifId'].'" />'?>
	<input type="reset" name="reset" value="Effacer" />
	<input type="submit" name="envoie" value="Valider" /> 
	</form>
	<br><br>
<?php }?>










<!-- <form id="formModif" name="formModif" method="GET" class="formulaire">
	<br>Entrez le nom <input type="text" id="modifNom" name="modifNom" required="required" />
	<br>Entrez la rue <input type="text" id="modifRue" name="modifRue" required="required" />
	<br>Entrez la ville <input type="text" id="modifVille" name="modifVille" required="required" />
	<br>Entrez le code postal <input type="text" id="modifCp" name="modifCp" required="required" />
	<?php echo '<input type="text" id="modifId" name="modifId" hidden="hidden" value= "'.$_GET['modifId'].'" />'?>
	<input type="reset" name="reset" value="Effacer" />
	<input type="submit" name="envoie" value="Valider" /> 
	</form> -->

<!-- Ajouts de Fleurs -->

<form id="formajts" name="formajts" method="post" class="formajts" action="admin.php" enctype="multipart/form-data">
<fieldset>
<legend>Ajout de plantes :</legend>
Nom : <input class="cText" type="text" id="nom" name="nom" required="required" /> 
Sous-titre : <input class="cText" type="text" id="sous-titre" name="sous-titre" required="required" />  
Prix : <input class="cText" type="text" id="prix" name="prix" required="required" /><br/>
Catégorie : <select name="categorie" size="1">
<option value="compo">compo</option>
<option value="plantes">plantes</option>
<option value="fleurs">fleurs</option>
</select><br/>


<br><br>
Image à mettre en ligne <input class="question" type="file" id="ressPub" name="ressPub" /><br /><br />
<input name="b1" type="reset" value="Effacer" /><input name="b2" type="submit" value="Envoyer" />
<?php
 if ( isset($_POST['nom']) && !empty($_POST['nom'])
 && isset($_POST['sous-titre']) && !empty($_POST['sous-titre'])
 && isset($_POST['prix']) && !empty($_POST['prix'])
 && isset($_POST['categorie']) && !empty($_POST['categorie'])) 
 {
 	if ( isset($_FILES['ressPub']) )
 	{
	 $nom = htmlspecialchars($_POST['nom']);
	 $sous_titre = htmlspecialchars($_POST['sous-titre']);
	 $prix =htmlspecialchars($_POST['prix']);
	 $categorie = $_POST['categorie'];
	
	 
	 if ( $_FILES['ressPub']['error'] == 0 )
	 {
	 	// Vérification d'une éventuelle erreur d'envoi
	 	// Puis traitements liés au fichier transmis
	 	$tailleFichier = $_FILES['ressPub']['size']; // Récupération de la taille du fichier
	 	$typeFichier = $_FILES['ressPub']['type']; // Récupération du type du fichier
	 	$nomFichier = $_FILES['ressPub']['name']; // Récupération du nom complet du fichier
	 	// Récupération des détails du fichier :
	 	$detailsFichier = pathinfo($_FILES['ressPub']['name']);
	 	// Récupération de l’extension du fichier :
	 	$extensionFichier = $detailsFichier['extension'];
	 	if ( $tailleFichier <= 10000000 )
	 	{ // Vérif. de la taille du fichier (<= 10 Mo)
	 		// Tableau contenant les extensions autorisées :
	 		$extensionsPossibles = array('png','gif','jpg','jpeg');
	 		if (in_array($extensionFichier, $extensionsPossibles))
	 		{
	 			$repertoireDestination = 'img/'.$categorie.'/'; // Choix du dossier de destination
	 			$resultat = move_uploaded_file($_FILES['ressPub']['tmp_name'] , $repertoireDestination.$nomFichier); // Ecriture du fichier dans son dossier
	 			if ( $resultat )
	 			{
	 				echo '<p>L\'envoi a bien été effectué.';
	 			}
	 			else
	 			{
	 				echo '<p class="error"><Le fichier n\'a pas pu être téléchargé</p>';
	 			}
	 		}
	 		else
	 		{
	 			// L'extension n'est pas autorisée
	 			echo '<p class="error">Désolé, mais l\'extension <b>'.$extensionFichier.'</b>
 du fichier '.$_FILES['ressPub']['name'].' n\'est pas autorisée !</p>';
	 		}
	 	}
	 	else
	 	{
	 		// La taille du fichier n'est pas autorisée
	 		echo '<p class="error">La taille du fichier
 '.$_FILES['ressPub']['name'].' dépasse 10 Mo !</p>';
	 	}
	 }
	 else
	 {
	 	// Une erreur est survenue au téléchargement
	 	echo '<p class="error">Il y a eu une erreur au téléchargement du
 fichier '.$_FILES['ressPub']['name'].' !</p>';
	 }
	 
	 }
	 try
	 {
	 $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	 $bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
	 $bdd->exec('SET NAMES utf8');
	 $insertion = $bdd->prepare('INSERT INTO produits (produit_id, nom, sous_titre,
	 prix, categorie, image) VALUES (\'\', :nom, :sous_titre,
	 :prix, :categorie, :image)');
	 $insertion->execute(array(
	 		'nom' => $nom,
	 		'sous_titre' => $sous_titre,
	 		'prix' => $prix,
	 		'categorie' => $categorie,
			'image' => $nomFichier));
	 $dernierId = $bdd->lastInsertId();
	 echo '<h4 class="goood">'.$nom.' à bien été ajouté ! <br />Récapitulatifs : <br />'.$sous_titre.'<br /> prix :'.$prix.'<br /> Catégorie :'.$categorie.'</h4>';
	 $insertion->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
 }

?>

</fieldset>
</form>
								
 
 <br><form id="formIns" name="formIns" method="post" class="formulaire">
		<br>Entrez le nom du magasin <input class="cText" type="text" id="choix" name="choix" required="required" />
	<input type="submit" name="envoie" value="Chercher" /> 
</form>
	<br>
		<br>
		
		
<?php		
echo '<table>';
echo '<tr>';
	echo '<td>';
	echo '<p> Nom </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> Rue </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> Code postal </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> Ville </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> Image </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> Supprimer </p>';
	echo '</td>';
	echo '<td>';
	echo '<p> Modifier </p>';
	echo '</td>';
echo '</tr>';

if ( isset($_POST['choix']) )
{
	$choix =  $_POST['choix'];
	try 
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp); 
		
		if ( $choix == 'Nervure' )
		{ 
					$reponseReq = $bdd->query('SELECT * FROM boutiques WHERE nom = \''.$choix.'\'');
		}
		
		while ( $donnees = $reponseReq->fetch() )
		{
	
			echo '<tr>';
				echo '<td>';
				echo $donnees['nom'];
				echo '</td>';
				echo '<td>';
				echo  $donnees['rue'];
				echo '</td>';
				echo '<td>';
				echo  $donnees['cp'];
				echo '</td>';
				echo '<td>';
				echo $donnees['ville'];
				echo '</td>';
				echo '<td>';
				echo '<img src="img/boutiques/boutique_'.$donnees['image'].'.jpg"  width="64" height="64" />';
				echo '</td>';
				echo '<td>';
				echo '<a class="supp" href="?supp='.$donnees['id'].'"><img class="supp" src="img/supp.png" />';
				echo '</td>';
				echo '<td>';
				echo '<a class="modif" href="?modif='.$donnees['id'].'"><img class="modif" src="img/modif.png" /></a>';
				echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
	
	catch (Exception $erreur) 	
		{
		die('Il y a une erreur avec la BDD : '.$erreur->getMessage());
		}
}


if ( isset($_GET['supp']) && !empty($_GET['supp']) )
{
	$supp = $_GET['supp'];
	suppMag($supp, $base, $hote, $utilisateur, $mdp);
}
?>
 
 
 <!-- Ajouts de Magasins -->
<br><br> 
<fieldset>
<legend>Ajout de magasin :</legend>
<form id="formMag" name="formMag" method="POST" class="formajts">
Nom : <input class="cText" type="text" id="nom" name="nom" required="required" />  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
Rue : <input class="cText" type="text" id="rue" name="rue" required="required" />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  
Code postal : <input class="cText" type="text" id="cp" name="cp" required="required" /><br/>
Ville : <input class="cText" type="text" id="ville" name="ville" required="required" /><br/>
<input type="submit" name="envoyerMag" value="Envoyer" /> 
<input type="reset" name="resetMag" value="Effacer" /> 

<?php
 if ( isset($_POST['nom']) && !empty($_POST['nom'])
 && isset($_POST['rue']) && !empty($_POST['rue'])
 && isset($_POST['cp']) && !empty($_POST['cp'])
 && isset($_POST['ville']) && !empty($_POST['ville'])) {

 $nom = htmlspecialchars($_POST['nom']);
 $rue = htmlspecialchars($_POST['rue']);
 $cp =htmlspecialchars($_POST['cp']);
 $ville = $_POST['ville'];
 

 try
 {
 $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
 $bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
 $bdd->exec('SET NAMES utf8');
 $insertion = $bdd->prepare('INSERT INTO boutiques ( nom, rue,
 cp, ville, image) VALUES (\'\', :nom, :rue,
 :cp, :ville, :image)');
 $insertion->execute(array(
 		'nom' => $nom,
 		'rue' => $rue,
 		'cp' => $cp,
 		'ville' => $ville,
		'image' => $nomFichier));
 $dernierId = $bdd->lastInsertId();
 echo '<h4 class="goood">'.$nom.' à bien été ajouté ! <br />Rue : <br />'.$rue.'<br /> Code postal :'.$cp.'<br /> Ville :'.$ville.'</h4>';
 $insertion->closeCursor();
}
catch (Exception $erreur)
{
	die('Erreur : ' . $erreur->getMessage());
}
}

?>

</form>



<br><br>
Image à mettre en ligne <input class="question" type="file" id="ressPub" name="ressPub" /><br /><br />
<input name="b1" type="reset" value="Effacer" /><input name="b2" type="submit" value="Envoyer" />
</fieldset>
<?php
 if ( isset($_POST['nom']) && !empty($_POST['nom'])
 && isset($_POST['rue']) && !empty($_POST['rue'])
 && isset($_POST['cp']) && !empty($_POST['cp'])
 && isset($_POST['ville']) && !empty($_POST['ville'])) 
 {
 	if ( isset($_FILES['ressPub']) )
 	{
	 $nom = htmlspecialchars($_POST['nom']);
	 $rue = htmlspecialchars($_POST['rue']);
	 $cp =htmlspecialchars($_POST['cp']);
	 $ville = $_POST['ville'];
	
	 
	 if ( $_FILES['ressPub']['error'] == 0 )
	 {
	 	// Vérification d'une éventuelle erreur d'envoi
	 	// Puis traitements liés au fichier transmis
	 	$tailleFichier = $_FILES['ressPub']['size']; // Récupération de la taille du fichier
	 	$typeFichier = $_FILES['ressPub']['type']; // Récupération du type du fichier
	 	$nomFichier = $_FILES['ressPub']['name']; // Récupération du nom complet du fichier
	 	// Récupération des détails du fichier :
	 	$detailsFichier = pathinfo($_FILES['ressPub']['name']);
	 	// Récupération de l’extension du fichier :
	 	$extensionFichier = $detailsFichier['extension'];
	 	if ( $tailleFichier <= 10000000 )
	 	{ // Vérif. de la taille du fichier (<= 10 Mo)
	 		// Tableau contenant les extensions autorisées :
	 		$extensionsPossibles = array('png','gif','jpg','jpeg');
	 		if (in_array($extensionFichier, $extensionsPossibles))
	 		{
	 			$repertoireDestination = 'img/boutiques/'; // Choix du dossier de destination
	 			$resultat = move_uploaded_file($_FILES['ressPub']['tmp_name'] , $repertoireDestination.$nomFichier); // Ecriture du fichier dans son dossier
	 			if ( $resultat )
	 			{
	 				echo '<p>L\'envoi a bien été effectué.';
	 			}
	 			else
	 			{
	 				echo '<p class="error"><Le fichier n\'a pas pu être téléchargé</p>';
	 			}
	 		}
	 		else
	 		{
	 			// L'extension n'est pas autorisée
	 			echo '<p class="error">Désolé, mais l\'extension <b>'.$extensionFichier.'</b>
 du fichier '.$_FILES['ressPub']['name'].' n\'est pas autorisée !</p>';
	 		}
	 	}
	 	else
	 	{
	 		// La taille du fichier n'est pas autorisée
	 		echo '<p class="error">La taille du fichier
 '.$_FILES['ressPub']['name'].' dépasse 10 Mo !</p>';
	 	}
	 }
	 else
	 {
	 	// Une erreur est survenue au téléchargement
	 	echo '<p class="error">Il y a eu une erreur au téléchargement du
 fichier '.$_FILES['ressPub']['name'].' !</p>';
	 }
	 
	 }
	 try
	 {
	 $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	 $bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
	 $bdd->exec('SET NAMES utf8');
	 $insertion = $bdd->prepare('INSERT INTO boutiques ( nom, rue,
	 cp, ville, image ) VALUES (\'\', :nom, :rue,
	 :cp, :ville, :image)');
	 $insertion->execute(array(
	 		'nom' => $nom,
	 		'rue' => $rue,
	 		'cp' => $cp,
	 		'ville' => $ville,
			'image' => $nomFichier));
	 $dernierId = $bdd->lastInsertId();
	 $insertion->closeCursor();
	}
	catch (Exception $erreur)
	{
		die('Erreur : ' . $erreur->getMessage());
	}
 }
 ?>


	</div>
</body>
</html>