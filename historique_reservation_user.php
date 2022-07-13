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

/* récupération de l'id de l'employé*/
$login = $_SESSION["login"];
$results=$cnx->query("SELECT ide FROM employe where login = '$login'; ");
$results->setFetchMode(PDO::FETCH_ASSOC);
//Le foreach réalise un fetch automatiquement
	 			
	foreach($results as $ligne){
		$ide = $ligne['ide'];
		}

/* création du tableau qui contient un résumé des réservations du user (début)*/

echo "<table border = '1'>";
	echo '  <tr> ';
	echo '<td>login du user</td>';
	echo '<td>id de la réservation</td>';
	echo '<td>date de réservation</td>';
	echo '<td>date début</td>';
	echo '<td>date fin</td>';
	echo '<td>Nom du village</td>';
	echo '<td>Prix</td>';
	echo '<td>Statut de la réservation</td>';
	echo ' </tr> ';
	
$results=$cnx->query("SELECT reservation.idr,login,prix,datereserv,datedebut,datefin,statut,village.nom FROM reservation, employe,village,logement where employe.ide = reservation.ide AND logement.idlog = reservation.idlog AND logement.idvilla = village.idvilla AND employe.ide = '$ide' ORDER BY datereserv ASC; ");
$results->setFetchMode(PDO::FETCH_ASSOC);
//Le foreach réalise un fetch automatiquement
	 			
	foreach($results as $ligne){

		echo '<tr>';
		echo "<td> ".$ligne['login']. "</td>";
		echo "<td> ".$ligne['idr']. "</td>";
		echo "<td> ".$ligne['datereserv']. "</td>";
		echo "<td> ".$ligne['datedebut']. "</td>";
		echo "<td> ".$ligne['datefin']. "</td>";
		echo "<td> ".$ligne['nom']. "</td>";
		echo "<td> ".$ligne['prix']. " &euro; </td>";
		echo "<td> ".$ligne['statut']. "</td>";

		echo '<tr>';
		}
	
	echo '</table>';
	
	echo '<br/><br/>';

/* création du tableau qui contient un résumé des réservations du user (fin)*/

echo "L'ensemble des services associés à vos réservations est présent dans le tableau ci-dessous <br/><br/>";

echo "<table border = '1'>";
	echo '  <tr> ';
	echo '<td>id réservation</td>';
	echo '<td>id service</td>';
	echo '<td>nom service</td>';
	echo ' </tr> ';
$results=$cnx->query("SELECT reservation.idr,dispose.ids,service.nom from dispose,employe,reservation,service where dispose.ids = service.ids AND employe.ide = reservation.ide AND dispose.idr = reservation.idr AND employe.ide ='$ide' ORDER BY idr ASC; ");
$results->setFetchMode(PDO::FETCH_ASSOC);
//Le foreach réalise un fetch automatiquement
	 			
	foreach($results as $ligne){
		/*$service = $ligne['service'];
		$nbre = $ligne['nbre'];*/
		echo '<tr>';
		echo "<td> ".$ligne['idr']. "</td>";
		echo "<td> ".$ligne['ids']. " </td>";
		echo "<td> ".$ligne['nom']. " </td>";
		echo '<tr>';
		}
	
	echo '</table>';
	
	echo '<br/><br/>';

?>
