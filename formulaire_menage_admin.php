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

/* ici se trouve le formulaire pour supprimer le ménage fin de séjour (début)*/	
	echo" <form method = 'POST' action = 'annulation_menage_admin.php'>";
/*Cette partie est le formulaire contenant l'ensemble des numéros des réservation*/
	echo" 	<label for='idr'>Veuillez choisir la réservation pour laquelle vous souhaitez supprimer le ménage fin de séjour en sélectionnant son identifiant :</label>";
	echo "<select name='idr' id='idr'>";
	$results=$cnx->query("SELECT * FROM dispose where ids = 6 ORDER BY idr ASC; ");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
			$i = $ligne['idr'];
	    	echo " <option value=$i>$i</option>";
	    
	}
	echo "</select>";
	echo "<br/> <br/>";
		
		echo "<input type='submit' value='valider'/>";
		echo "<br\>"; echo "<br\>";

		echo "</form>";
 	
 	
echo" <br/><br/>";

/* ici se trouve le formulaire pour supprimer le ménage fin de séjour (fin)*/

echo '<br/><br/>';

/* ici se trouve le formulaire pour ajouter le ménage en fin de séjour (début) */

echo" <form method = 'POST' action = 'insertion_menage_admin.php'>";
/*Cette partie est le formulaire contenant l'ensemble des numéros des réservations */
	echo" 	<label for='idr'>Veuillez choisir la réservation pour laquelle vous souhaiter ajouter le ménage de fin de séjour en précisant son identifiant :</label>";
	echo "<select name='idr' id='idr'>";
	$results=$cnx->query("SELECT idr FROM reservation EXCEPT SELECT Distinct idr from dispose where ids = '6' ORDER BY idr ASC; ");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
			$i = $ligne['idr'];
	    	echo " <option value=$i>$i</option>";
	    
	}
	echo "</select>";
	echo "<br/> <br/>";
		
		echo "<input type='submit' value='valider'/>";
		echo "<br\>"; echo "<br\>";

		echo "</form>";
 	
 	
echo" <br/><br/>";

/*ici se trouve le formulaire pour ajouter le ménage fin de séjour (fin) */
?>
