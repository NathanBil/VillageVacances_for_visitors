<?php

include('deconnexion2.php');

if(isset($_SESSION["login"]) == false)
{
	//renvoie vers la page si l'utilisateur n'est pas connecté
	header("location:formulaire_authentification.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Formulaire de modification du mot de passe</title>
	<style type="text/css">
		body {
			background-color:#ffd;
			font-family:Verdana,Helvetica,Arial,sans-serif;
		}
	</style>
</head>

<body>
<h1>Formulaire de modification du mot de passe</h1>

<?php
if(isset($_GET['erreur']))
{
	if($_GET['erreur'] == 0)
	{
		echo "Veuillez entrer un nouveau mot de passe et pas chaine vide ! <br\>";
	}
	
}

if(isset($_GET['succes']))
{
	if($_GET['succes'] == 1)
	{
		echo "Changement de mot de passe réussi ! <br\>";
	}
	
}
?>

<?php 

if(isset($_SESSION["titre"]) == true)
{
	if($_SESSION["titre"] == 'admin')
	{
	include('liens_admin.php');
	}
}

include('liens_user.php');
?>
<br/> <br/>

<form action="modifier_mdp.php" method="POST">

	<table>
		<tr><td><label for="mdp2">nouveau mot de passe</label></td><td><input type="password" name="mdp2" /></td></tr>
		
	</table>
	<br />
	<input type="reset" name="reset" value="Effacer" /> 
	<input type="submit" name="submit" value="Valider" />
</form>

</body>
</html>
