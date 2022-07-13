<?php

session_start();
include('connexion.inc.php');
if(isset($_SESSION["login"]) == false)
{
	
	header("location:formulaire_authentification.php");
}

if(isset($_SESSION["titre"]))
{ 
	if($_SESSION["titre"]== 'admin')
	{
		header("location:accueil_admin.php");
	}
	if($_SESSION["titre"]== 'user')
	{
		header("location:accueil_user.php");
	}
}

	
?>
