<?php
include("deconnexion2.php");

if(isset($_SESSION["login"]) == false)
{
	header("location:formulaire_authentification.php");
}

if(isset($_SESSION["login"]) == true)
{
	include("liens_user.php");
}
if(isset($_SESSION["titre"]) == true)
{
	if($_SESSION["titre"] == "admin")
	{
	include("liens_admin.php");
	}
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
if(isset($_SESSION['login']))
{
	$login = $_SESSION['login'];
}

echo "L'historique de vos réservations est présent dans le tableau ci-dessous <br/><br/>";

echo "<table border = '1'>";
	echo '  <tr> ';
	echo '<td>id réservation</td>';
	echo '<td>login</td>';
	echo'   <td>prix</td>';
	echo '<td>date de la réservation</td>';
	echo'   <td>date début</td>';
	echo '<td>date fin</td>';
	echo'   <td>statut</td>';
	echo ' </tr> ';
$results=$cnx->query("SELECT idr,login,prix,datereserv,datedebut,datefin,statut FROM reservation natural join employe where employe.login = '$login'; ");
				$results->setFetchMode(PDO::FETCH_ASSOC);
				//Le foreach réalise un fetch automatiquement
	 			
	foreach($results as $ligne){
		/*$service = $ligne['service'];
		$nbre = $ligne['nbre'];*/
		echo '<tr>';
		echo "<td> ".$ligne['idr']. "</td>";
		echo "<td> ".$ligne['login']. "</td>";
		echo "<td> ".$ligne['prix']. " </td>";
		echo "<td> ".$ligne['datereserv']." </td>";
		echo "<td> ".$ligne['datedebut'] ." </td>";
		echo "<td> ".$ligne['datefin']." </td>";
		echo "<td> ".$ligne['statut']. " </td>";
		echo '<tr>';
		}
	
	echo '</table>';
	
	echo '<br/><br/>';
	

echo" <form method = 'POST' action = 'annulation_reservation_user.php'>";
/*Cette partie est le formulaire contenant l'ensemble des numéros de réservation de l'utilisateur*/
	echo" 	<label for='reserv'>Veuillez choisir la réservation que vous souhaitez annuler en sélectionnant son identifiant :</label>";
	echo "<select name='reserv' id='reserv'>";
	$results=$cnx->query("SELECT idr,login,prix,datereserv,datedebut,datefin,statut FROM reservation natural join employe where employe.login = '$login'; ");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
		if($ligne['statut'] == 'en cours')
		{
			$i = $ligne['idr'];
	    	echo " <option value=$i>$i</option>";
	    }
	}
	echo "</select>";
	echo "<br/> <br/>";
		
		echo "<input type='submit' value='valider'/>";
		echo "<br\>"; echo "<br\>";

		echo "</form>";
 	
 	
echo" <br/><br/>";

?>
