<?php
include("inc/connexion.php");

// on teste si nos variables sont définies
if (isset($_POST['login']) && isset($_POST['pwd'])) 
{
				$pseudo_c = htmlspecialchars($_POST['login']);
				$mdp_c = htmlspecialchars($_POST['pwd']);
				
				try 
				{
									$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
									$bdd = new PDO('mysql:host='.$hote.';dbname='.$base, $utilisateur, $mdp);
									$reponseReq = $bdd->query('SELECT * FROM utilisateurs WHERE Pseudo = "'.$pseudo_c.'" ');
									while ( $donnees = $reponseReq->fetch() )
									{				
													$pseudo_bdd = $donnees['Pseudo'];
													$mdp_bdd = $donnees['mdp'];
													$statut_bdd = $donnees['Statut'];
									}
				}
				catch (Exception $erreur)
				{
									die('Erreur : ' . $erreur->getMessage());
				}
}else
{
						echo 'Les variables du formulaire ne sont pas déclarées.';
}	



// on vérifie les informations du formulaire, si le pseudo saisi est bien un pseudo autorisé et le mot de passe
if ($pseudo_bdd == $pseudo_c && $mdp_bdd == $mdp_c) 
{
				// dans ce cas, tout est ok, on peut démarrer notre session
		
				// on la démarre
				session_start ();
				// on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
				$_SESSION['login'] = $pseudo_bdd;
				$_SESSION['pwd'] = $mdp_bdd;
				$_SESSION['statut'] = $statut_bdd;

				// on redirige notre visiteur vers une page de notre section membre
				header ('location: /Lafleur');
}
else
{
						// Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
						echo '<body onLoad="alert(\'Membre non reconnu...\')">';
						// puis on le redirige vers la page d'accueil
						echo '<meta http-equiv="refresh" content="0;URL=index.html">';
}
?>