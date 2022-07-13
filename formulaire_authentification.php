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
	if($_GET['erreur'] == 0)
	{
		echo "login incorrect réessayer de remplir le formulaire ! <br\>";
	}
	
	elseif($_GET['erreur'] == 1)
	{
		echo "mot de passe incorrect réessayer de remplir le formulaire ! <br\>";
	}
	
	elseif($_GET['erreur'] == 2)
	{
		echo "Veuillez entrer un nom d'utilisateur ! <br\>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Formulaire de saisie de login et de mot de passe</title>
	<style type="text/css">
		body {
			background-color:#ffd;
			font-family:Verdana,Helvetica,Arial,sans-serif;
		}
	</style>
</head>

<body>
<h1>Connectez-vous</h1>
<a href ='formulaire_inscription.php'> m'inscrire </a>
<br/> <br/>
<form action="authentification.php" method="post">
	<table>
		<tr><td><label for="login">login</label></td><td><input type="text" name="login" /></td></tr>
		<tr><td><label for="mdp">Mot de passe</label></td><td><input type="password" name="mdp" /></td></tr>
	</table>
	<br />
	<input type="reset" name="reset" value="Effacer" /> 
	<input type="submit" name="submit" value="Valider" />
</form>

</body>
</html>
