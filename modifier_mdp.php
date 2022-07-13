<?php

include('deconnexion2.php');



if(isset($_SESSION["login"]) == false)
{
	//renvoie vers la page si l'utilisateur n'est pas connecté
	header("location:formulaire_authentification.php");
}

elseif(!empty($_POST['mdp2']))
{
	/* récupération de l'id de l'employé*/
	$login = $_SESSION["login"];
	$results=$cnx->query("SELECT ide FROM employe where login = '$login'; ");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	//Le foreach réalise un fetch automatiquement
		 			
	foreach($results as $ligne){
		$ide = $ligne['ide'];
		}

	$mdp2 = $_POST['mdp2'];
	$results=$cnx->exec("UPDATE employe SET mdp = '$mdp2' WHERE ide = '$ide' ");

	if($results ==0)
	{
		header("location:formulaire_modifier_mdp.php?erreur=1");
	}
	else
	{	
		header("location:formulaire_modifier_mdp.php?succes=1");
	}
	

}
else
{
	header("location:formulaire_modifier_mdp.php?erreur=0");
}
?>
