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

/* ici se trouve le formulaire pour valider une réservation (début)*/

echo" <form method = 'POST' action = 'validation_reservation_admin.php'>";
/*Cette partie est le formulaire contenant l'ensemble des numéros des réservations */
	echo" 	<label for='idr'>Veuillez choisir la réservation que vous souhaitez valider en sélectionnant son identifiant :</label>";
	echo "<select name='idr' id='idr'>";
	$results=$cnx->query("SELECT idr FROM reservation where statut <> 'valide' ORDER BY idr ASC; ");
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

/* ici se trouve le formulaire pour valider une réservation (fin)*/

?>
