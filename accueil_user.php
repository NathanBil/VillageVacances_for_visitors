<?php
include('deconnexion2.php');

if(isset($_SESSION["titre"]))
{
	//modifier pour renvoyer vers la page utilisateur
	if($_SESSION["titre"] != 'user')
	{
		header("location:accueil_admin.php");
	}
}
else
{
	header("location:formulaire_authentification.php");
}
?>

<?php

echo " <h1> Bienvenue sur votre page d'accueil  : </h1>";

echo"  employé " .$_SESSION['login']. "<br/> <br/>";

echo "Que souhaitez vous faire ? : <br/> <br/>" ;

include('liens_user.php');



?>
