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

echo '<br/><br/>';
/* ici se trouve le formulaire pour modifier une réservation (début)*/	
	echo" <form method = 'POST' action = 'modification_reservation_admin.php'>";
	
	echo" 	<label for='idr'>Veuillez choisir la réservation que vous souhaiter modifier en sélectionnant son identifiant et en précisant les nouvelles informations que vous souhaitez mettre :</label>";
	echo "<br/> <br/> identifiant réservation : ";
	echo "<select name='idr' id='idr'>";
	$results=$cnx->query("SELECT idr,login,prix,datereserv,datedebut,datefin,statut,titre FROM reservation natural join employe ORDER BY idr ASC; ");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
			$i = $ligne['idr'];
	    	echo " <option value=$i>$i</option>";
	    
	}
	echo "</select>";
	
	echo "<br/> <br/>";
	
	echo "id employé : <input type='text' name='ide'/><br/>";
 	
 	echo "id logement : <input type='text' name='idlog'/><br/>";
 	
 	echo "id service de pension : <input type='text' name='ids1'/><br/>";
 	/* il faudra bloquer la saisi du user pour que la pension soit acceptée ssi elle vaut 4 ou 5*/
 	
	echo "id type : <input type='text' name='idtype'/><br/>";
 	
 	echo "prix : <input type='text' name='prix'/><br/>";
 	
 	echo "date réservation : <input type='date' name='datereserv'/><br/>";
 	
 	echo "date début : <input type='date' name='datedeb'/><br/>";
 	
 	echo "date fin : <input type='date' name='datefin'/><br/>";
 	
 	echo "statut : <input type='text' name='statut'/><br/>";
 	
 	echo "id vacances : <input type='text' name='idv'/><br/>";
		
		echo "<input type='submit' value='valider'/>";
		echo "<br\>"; echo "<br\>";

		echo "</form>";
 	
echo" <br/><br/>";


?>
