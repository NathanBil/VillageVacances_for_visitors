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


echo "L'ensemble des réservations des utilisateurs est présent dans le tableau ci-dessous <br/><br/>";

echo "<table border = '1'>";
	echo '  <tr> ';
	echo '<td>id réservation</td>';
	echo '<td>id employé</td>';
	echo '<td>id logement</td>';
	echo '<td>id type</td>';
	echo '<td>id vacances</td>';
	echo '<td>login de l\'utilisateur</td>';
	echo'   <td>prix</td>';
	echo '<td>date de la réservation</td>';
	echo'   <td>date début</td>';
	echo '<td>date fin</td>';
	echo'   <td>statut</td>';
	echo'   <td>titre</td>';

	echo ' </tr> ';
$results=$cnx->query("SELECT idr,ide,idlog,idtype,idv,login,prix,datereserv,datedebut,datefin,statut,titre FROM reservation natural join employe ORDER BY idr ASC; ");
$results->setFetchMode(PDO::FETCH_ASSOC);
//Le foreach réalise un fetch automatiquement
	 			
	foreach($results as $ligne){
		/*$service = $ligne['service'];
		$nbre = $ligne['nbre'];*/
		echo '<tr>';
		echo "<td> ".$ligne['idr']. "</td>";
		echo "<td> ".$ligne['ide']. "</td>";
		echo "<td> ".$ligne['idlog']. "</td>";
		echo "<td> ".$ligne['idtype']. "</td>";
		echo "<td> ".$ligne['idv']. "</td>";
		echo "<td> ".$ligne['login']. "</td>";
		echo "<td> ".$ligne['prix']. "&euro; </td>";
		echo "<td> ".$ligne['datereserv']." </td>";
		echo "<td> ".$ligne['datedebut'] ." </td>";
		echo "<td> ".$ligne['datefin']." </td>";
		echo "<td> ".$ligne['statut']. " </td>";
		echo "<td> ".$ligne['titre']. " </td>";

		echo '<tr>';
		}
	
	echo '</table>';
	
	echo '<br/><br/>';


























echo "L'ensemble des services associés aux réservations est présents dans le tableau ci-dessous <br/><br/>";

echo "<table border = '1'>";
	echo '  <tr> ';
	echo '<td>id réservation</td>';
	echo '<td>id service</td>';
	echo '<td>nom service</td>';
	echo ' </tr> ';
$results=$cnx->query("SELECT idr,dispose.ids,nom from dispose natural join service ORDER BY idr ASC; ");
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
/* tableau avec l'ensemble des services et leurs identifiants associés (début)*/	
?>
