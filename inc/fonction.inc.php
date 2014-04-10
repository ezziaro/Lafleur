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





function modif($supp, $base, $hote, $utilisateur, $mdp)
{
	if ( isset($_GET['modif']) && !empty($_GET['modif']) )
	{
		$modif = $_GET['modif'];
		try
		{
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
			$modification = $bdd->prepare('UPDATE produits SET WHERE produit_id=:id');
			$modification->execute(array(
					'id' => $modif
			));
			$modification->closeCursor();
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}
}
?>