<?php
session_start();
include('connexion.inc.php');

if(isset($_SESSION["titre"]))
{ 
	/* à modifier pour renvoyer vers la page d'accueil de l'admin ou du user */
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

<?php
if(isset($_GET['erreur']))
{
	if($_GET['erreur'] == 2)
	{
		echo "Veuillez entrer un login ! <br\>";
	}
	
	if($_GET['erreur'] == 0)
	{
		echo "Veuillez entrer un prénom ! <br\>";
	}
	
	elseif($_GET['erreur'] == 1)
	{
		echo "Veuillez entrer un nom ! <br\>";
	}
	
	elseif($_GET['erreur'] == 3)
	{
		echo "Veuillez entrer un mot de passe ! <br\>";
	}
	
	elseif($_GET['erreur'] == 4)
	{
		echo "Essayez avec un autre login celui-ci est déjà pris ! <br\>";
	}
	elseif($_GET['erreur'] == 5)
	{
		echo "La création de votre compte a échouée veuillez réessayer ! <br\>";
	}
	elseif($_GET['erreur'] == 6)
	{
		echo "Veuillez remplir tous les champs ! <br\>";
	}
	
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Formulaire d'inscription</title>
	<style type="text/css">
		body {
			background-color:#ffd;
			font-family:Verdana,Helvetica,Arial,sans-serif;
		}
	</style>
</head>

<body>
<h1>Formulaire d'inscription</h1>

<a href ='formulaire_authentification.php'> se connecter </a>
<br/> <br/>

<form action="inscription.php" method="POST">

	<table>
		<tr><td><label for="nom">nom</label></td><td><input type="text" name="nom" /></td></tr>
		<tr><td><label for="prenom">prenom</label></td><td><input type="text" name="prenom" /></td></tr>
		<tr><td><label for="login">login</label></td><td><input type="text" name="login" /></td></tr>
		<tr><td><label for="mdp">Mot de passe</label></td><td><input type="password" name="mdp" /></td></tr>
		
	</table>
	<br />
	<input type="reset" name="reset" value="Effacer" /> 
	<input type="submit" name="submit" value="Valider" />
</form>

</body>
</html>
