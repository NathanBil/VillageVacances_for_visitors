<?php
include('deconnexion2.php');

if(isset($_SESSION["titre"]))
{
	if($_SESSION["titre"] != 'admin')
	{
		header("location:accueil_user.php");
	}
}
else
{
	header("location:formulaire_authentification.php");
}
?>

<?php

echo " <h1> Bienvenue sur votre page d'accueil  : </h1>";

echo"  administrateur " .$_SESSION['login']. "<br/> <br/>";

echo "Que souhaitez vous faire ? : <br/> <br/>" ;

include('liens_admin.php');
include('liens_user.php');


?>
