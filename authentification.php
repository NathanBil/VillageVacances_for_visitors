<?php
session_start();
include('connexion.inc.php');
?>

<?php  
			
			if(!empty($_POST['login']))
			{
				$login = $_POST['login'];
				
			}
			if(!empty($_POST['mdp']))
			{
				$mdp = $_POST['mdp'];
			}
			if(isset($login))
			{
				$results=$cnx->query("SELECT * FROM employe WHERE login = '$login' ");
				$results->setFetchMode(PDO::FETCH_ASSOC);
				//Le foreach réalise un fetch automatiquement
	 			
				foreach($results as $ligne){
					$mdp2 = $ligne['mdp'];
					$login2 = $ligne['login'];
				}
				if(isset($mdp) == true)
				{
					$results=$cnx->query("SELECT * FROM employe WHERE mdp = '$mdp' AND login = '$login' ");
					$results->setFetchMode(PDO::FETCH_ASSOC);
					//Le foreach réalise un fetch automatiquement
	 			
					foreach($results as $ligne){
						$mdp3 = $ligne['mdp'];
						$login3 = $ligne['login'];
						$titre = $ligne['titre'];
					}
				}
				if(isset($login2) == false)
				{
					header("location:formulaire_authentification.php?erreur=0");
				}
				elseif(isset($mdp) == false) 
				{
					header("location:formulaire_authentification.php?erreur=1");
				
				}
				elseif(isset($mdp3) == false)
				{
					header("location:formulaire_authentification.php?erreur=1");
				}
				elseif($mdp2 != $mdp3)
				{
					header("location:formulaire_authentification.php?erreur=1");
				
				}
				elseif($mdp2 == $mdp3 && $login2 == $login3)
				{
					$_SESSION['login'] = $login2;
					$_SESSION['mdp'] = $mdp2;
					$_SESSION['titre'] = $titre;
					if($titre == 'user')
					{
					header("location:accueil_user.php");
					}
					if($titre == 'admin')
					{
					header("location:accueil_admin.php");
					}
				}
			}
			else
			{
				header("location:formulaire_authentification.php?erreur=2");
			
			}
			
?>


