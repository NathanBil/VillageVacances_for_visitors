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

/* tableau avec l'ensemble des services et leurs identifiants associés (début)*/	
echo "L'ensemble des services avec leurs identifiants est présent dans le tableau ci-dessous : <br/><br/>";

echo "<table border = '1'>";
	echo '  <tr> ';
	echo '<td>id service</td>';
	echo '<td>nom du service</td>';
	echo '<td>description</td>';
	echo ' </tr> ';
$results=$cnx->query("SELECT service.ids,nom,description from service ORDER BY ids ASC; ");
$results->setFetchMode(PDO::FETCH_ASSOC);
//Le foreach réalise un fetch automatiquement
	 			
	foreach($results as $ligne){
		/*$service = $ligne['service'];
		$nbre = $ligne['nbre'];*/
		echo '<tr>';
		echo "<td> ".$ligne['ids']. "</td>";
		echo "<td> ".$ligne['nom']. " </td>";
		echo "<td> ".$ligne['description']. " </td>";
		echo '<tr>';
		}
	
	echo '</table>';
	
	echo '<br/><br/>';
/* tableau avec l'ensemble des services et leurs identifiants associés (fin)*/

?>
