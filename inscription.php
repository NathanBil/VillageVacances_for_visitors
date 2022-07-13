<?php
session_start();
include('connexion.inc.php');
?>

<?php  
			/*pour une raison qui m'échappe totalement les headers ne sont pas traités dans l'ordre c'est le dernier qui est traité en 				premier certains message d'erreur ne se voient donc jamais*/
			if(!empty($_POST['login']))
			{
				$login = $_POST['login'];
				
			}
			else
			{
				header('location:formulaire_inscription.php?erreur=2');
			
			}
			if(!empty($_POST['mdp']))
			{
				$mdp = $_POST['mdp'];
			}
			else
			{
				header('location:formulaire_inscription.php?erreur=3');
			
			}
			if(!empty($_POST['prenom']))
			{
				$prenom= $_POST['prenom'];
			}
			else
			{
				header('location:formulaire_inscription.php?erreur=0');
			
			}
			if(!empty($_POST['nom']))
			{
				$nom = $_POST['nom'];
			}
			else
			{
				header('location:formulaire_inscription.php?erreur=1');
			}
			if(!empty($login) && !empty($nom) && !empty($mdp) && !empty($prenom))
			{
				$titre = 'user';
				$results=$cnx->query("SELECT * FROM employe WHERE login = '$login' ");
				$results->setFetchMode(PDO::FETCH_ASSOC);
				//Le foreach réalise un fetch automatiquement
	 			
				foreach($results as $ligne){
					$login2 = $ligne['login'];
				}
				if(isset($login2))
				{
					header("location:formulaire_inscription.php?erreur=4");
				}
				/* si un utilisateur portant ce nom existe déjà on renvoie l'utisateur s'inscrire*/
				else
				{
					$req_insert = "INSERT INTO employe (nom,prenom,mdp,login,titre) VALUES ('$nom', '$prenom','$mdp','$login','user')";
					$results=$cnx->exec($req_insert);
					if($results ==0)
					{
						header("location:formulaire_inscription.php?erreur=5");
					}
					else
					{
						$_SESSION['login'] = $login;
						$_SESSION['mdp'] = $mdp;
						$_SESSION['titre'] = $titre;
						header("location:accueil_user.php");
					}
				
				}
			}
			
			else
			{
				header("location:formulaire_inscription.php?erreur=6");
			
			}
			
?>


