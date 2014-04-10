<?php

function supp($supp, $base, $hote, $utilisateur, $mdp)
{
	if ( isset($_GET['supp']) && !empty($_GET['supp']) )
	{
		$supp = $_GET['supp'];
		try
		{
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
			$modification = $bdd->prepare('DELETE FROM produits WHERE produit_id=:id');
			$modification->execute(array(
					'id' => $supp
			));
			$modification->closeCursor();
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}
}


function suppMag($supp, $base, $hote, $utilisateur, $mdp)
{
	if ( isset($_GET['supp']) && !empty($_GET['supp']) )
	{
		$supp = $_GET['supp'];
		try
		{
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
			$modification = $bdd->prepare('DELETE FROM boutiques WHERE id=:id');
			$modification->execute(array(
					'id' => $supp
			));
			$modification->closeCursor();
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}
}





function modif($supp, $base, $hote, $utilisateur, $mdp)
{
	
	if ( isset($_GET['modifId']) && !empty($_GET['modifId']) && isset($_GET['modifNom']) && !empty($_GET['modifNom']))
	{
		
		$modifId = $_GET['modifId'];
		$modifNom = $_GET['modifNom'];
		$modifST = $_GET['modifST'];
		$modifPrix = $_GET['modifPrix'];
		$modifCat = $_GET['modifCat'];
		try
		{
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
			{
				$modification = $bdd->prepare('UPDATE produits SET nom = :nom, sous_titre = :sous_titre, prix = :prix, categorie = :categorie WHERE produit_id= "'.$modifId.'"');
				$modification->execute(array(
						'nom' => $modifNom,
						'sous_titre' => $modifST,
						'prix' => $modifPrix,
						'categorie' => $modifCat
				));
				$modification->closeCursor();
			}
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}
}




?>