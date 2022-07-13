<?php
include('deconnexion2.php');
include('liens_admin.php');
include("liens_user.php");

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

if(isset($_GET['delete']))
{
	if($_GET['delete'] == 1)
	{
		echo "La suppression a été réalisée avec succès. <br/><br/>";
	}
	if($_GET['delete'] == 0)
	{
		echo "La suppression a échouée veuillez réesayer. <br/><br/>";
	}




}

if(isset($_GET['validate']))
{
	if($_GET['validate'] == 1)
	{
		echo "La validation a été réalisée avec succès. <br/><br/>";
	}
	if($_GET['validate'] == 0)
	{
		echo "La validation a échouée veuillez réesayer. <br/><br/>";
	}




}

if(isset($_GET['modifier']))
{
	if($_GET['modifier'] == 1)
	{
		echo "La modification a été réalisée avec succès. <br/><br/>";
	}
	if($_GET['modifier'] == 0)
	{
		echo "La modification a échouée partiellement ou totalement veuillez réesayer. <br/><br/>";
	}




}
echo "<p> Que souhaitez-vous faire pour une réservation ? :</p>";

echo "<p> <a href = 'formulaire_annulation_reservation_admin.php'> supprimer</a> &ensp;";
echo "<a href = 'formulaire_modification_reservation_admin.php'> modifier</a> &ensp;";
echo "<a href = 'formulaire_validation_reservation_admin.php'> valider</a> &ensp;";
echo "<a href = 'formulaire_menage_admin.php'> modifier ménage</a> &ensp; </p>";

/* tableau des réservations des utilisateurs (début) [déplacé sur une autre page]*/
	
/* tableau des réservations des utilisateurs (fin) [déplacé sur une autre page]*/


/* tableau des services associés aux réservation des utilisateurs (début) [déplacé sur une autre page]*/

/* tableau des services associés aux réservation des utilisateurs (fin) [déplacé sur une autre page]*/

/* tableau avec l'ensemble des services et leurs identifiants associés (début) [déplacé sur une autre page]*/	

/* tableau avec l'ensemble des services et leurs identifiants associés (fin) [déplacé sur une autre page]*/	


/* ici se trouve le formulaire pour supprimer une réservation (début) [déplacé]*/	

/* ici se trouve le formulaire pour supprimer une réservation (fin) [déplacé]*/

echo '<br/><br/>';
/* ici se trouve le formulaire pour modifier une réservation (début) [déplacé]*/	
	
/* ici se trouve le formulaire pour modifier une réservation (fin) [déplacé]*/

/* ici se trouve le formulaire pour valider une réservation (début) [déplacé]*/

/* ici se trouve le formulaire pour valider une réservation (fin) [déplacé]*/

/* ici se trouve le formulaire pour ajouter le ménage en fin de séjour (début) [déplacé]*/

/* ici se trouve le formulaire pour ajouter le ménage en fin de séjour (début)[déplacé] */

/* ici se trouve le formulaire pour supprimer le ménage fin de séjour (début) [déplacé]*/	
	
/* ici se trouve le formulaire pour supprimer le ménage fin de séjour (fin) [déplacé]*/

?>
