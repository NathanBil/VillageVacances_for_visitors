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
if(isset($_GET['reserver']))
{
	if($_GET['reserver'] == '0')
	{
		echo "La réservation a échouée veuillez réessayer .";
	}
	if($_GET['reserver'] == '1')
	{
		echo "Le choix des services a échouée veuillez recommencer toute votre réservation.";
	}
	if($_GET['reserver'] == '2')
	{
		echo "Votre réservation a été réalisée avec succès.";
	}



}
?>

<?php

$datereserv = date('Y-m-d'); 
/* ici  se trouve le formulaire pour choisir une zone (début) */
if(isset($_GET['zone']) == false  && isset($_GET['localisation']) == false && isset($_GET['nomvac']) == false)
{
	

echo" <form method = 'GET' action = 'formulaire_reservation_user2.php'>";

	echo" 	<label for='zone'>Veuillez écrire la zone à laquelle vous appartenez en recopiant parfaitement le nom d'une des zones présentes dans le tableau ci-dessus :</label>";
	echo "<br/> <br/>";
	
	echo "<br/> <br/> zone : ";
	echo "<select name='zone' id='zone'>";
	$results=$cnx->query("select distinct zone from vacances ORDER BY zone ASC;");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
			$i = $ligne['zone'];
	    	echo " <option value='$i'>$i</option>";
	    
	}
	echo "</select>";
	
	echo "<br/> <br/>";
	
	echo "<input type='submit' value='valider'/>";
		echo "<br\>"; echo "<br\>";

		echo "</form>";
 	
echo" <br/><br/>";


}
/* ici se trouve le formulaire pour choisir une zone (fin) */

/* ici  se trouve le formulaire pour choisir une localisation (début) */
if(isset($_GET['zone']) == true  && isset($_GET['localisation']) == false && isset($_GET['nomvac']) == false)
{

$zone = $_GET['zone'];

echo "<a href = 'formulaire_reservation_user2.php'> précédent </a>";
echo "<br/> </br>";
echo" <form method = 'GET' action = 'formulaire_reservation_user2.php'>";

echo "<p> Zone choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='zone' name='zone' value='$zone' checked>";
  echo "<label for='zone'>$zone</label>";
echo "</div>";
	
	echo" 	<label for='localisation'>Veuillez sélectionner l'endroit où vous vous situez :</label>";
	echo "<br/> <br/>";
	
	echo "<br/> <br/> localisation : ";
	echo "<select name='localisation' id='localisation'>";
	$results=$cnx->query("select distinct localisation from vacances where zone ='$zone' ORDER BY localisation ASC;");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
			$i = $ligne['localisation'];
	    	echo " <option value='$i'>$i</option>";
	    
	}
	echo "</select>";
	
	echo "<input type='submit' value='valider'/>";
		echo "<br\>"; echo "<br\>";

		echo "</form>";
 	
echo" <br/><br/>";


}

/* ici se trouve le formulaire pour choisir une localisation (fin) */

/* ici se trouve le formulaire pour choisir un nom de vacances (début) */

if(isset($_GET['localisation']) == true && isset($_GET['nomvac']) == false)
{

$zone = $_GET['zone'];
$localisation = $_GET['localisation'];
	
echo "<a href = 'formulaire_reservation_user2.php?zone=$zone'> précédent </a>";
echo "<br/> </br>";
echo" <form method = 'GET' action = 'formulaire_reservation_user2.php?'>";

echo "<p> Zone choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='zone' name='zone' value='$zone' checked>";
  echo "<label for='zone'>$zone</label>";
echo "</div>";

echo "<p> localisation choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='localisation' name='localisation' value='$localisation' checked>";
  echo "<label for='localisation'>$localisation</label>";
echo "</div>";
	
	echo" 	<label for='nomvac'>Veuillez sélectionner les vacances pour lesquelles vous voulez réserver une place :</label>";
	echo "<br/> <br/>";
	
	echo "<br/> <br/> vacances : ";
	echo "<select name='nomvac' id='nomvac'>";
	$results=$cnx->query("select distinct nom from vacances where zone = '$zone' AND localisation = '$localisation' ORDER BY nom ASC;");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
			$i = $ligne['nom'];
	    	echo " <option value='$i'>$i</option>";
	    
	}
	echo "</select>";
	
	echo "<input type='submit' value='valider'/>";
		echo "<br\>"; echo "<br\>";

		echo "</form>";
 	
echo" <br/><br/>";
}
/* ici se trouve le formulaire pour choisir un nom de vacances (fin) */


/* ici se trouve le formulaire pour choisir la période de vacances qui nous intéresse (début) */

if(isset($_GET['nomvac']) == true && !empty($_GET['idv']) == false)
{

$zone = $_GET['zone'];
$localisation = $_GET['localisation'];
$nomvac = $_GET['nomvac'];

echo "<table border = '1'>";
	echo '  <tr> ';
	echo '<td>id vacances</td>';
	echo '<td>date debut</td>';
	echo '<td>date fin</td>';
	echo '<td>Vacances</td>';
	echo ' </tr> ';
	
$results=$cnx->query("select idv, datedebut,datefin from vacances where zone = '$zone' AND localisation = '$localisation' AND nom = '$nomvac' AND datedebut > '$datereserv' ORDER BY datedebut ASC;");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
		//$service = $ligne['service'];
		//$nbre = $ligne['nbre'];
		echo '<tr>';
		echo "<td> ".$ligne['idv']. "</td>";
		echo "<td> ".$ligne['datedebut']. "</td>";
		echo "<td> ".$ligne['datefin']. "</td>";
		echo "<td>$nomvac</td>";
		echo '<tr>';
		}
	
	echo '</table>';
	
	echo '<br/><br/>';
	
echo "<a href = 'formulaire_reservation_user2.php?zone=$zone&localisation=$localisation'> précédent </a>";
echo "<br/> </br>";
echo" <form method = 'GET' action = 'formulaire_reservation_user2.php'>";

	
echo "<p> Zone choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='zone' name='zone' value='$zone' checked>";
  echo "<label for='zone'>$zone</label>";
echo "</div>";

echo "<p> localisation choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='localisation' name='localisation' value='$localisation' checked>";
  echo "<label for='localisation'>$localisation</label>";
echo "</div>";
	
echo "<p> Vacances choisies :</p>";
	
echo "<div>";
  echo "<input type='radio' id='nomvac' name='nomvac' value='$nomvac' checked>";
  echo "<label for='nomvac'>$nomvac</label>";
echo "</div>";

echo" <br/><br/>";

echo" 	<label for='idv'>Veuillez choisir la période sur laquelle vous souhaitez réserver vos vacances en sélectionnant l'identifiant de cette période (vous choisirez dans le prochain formulaire le samedi exact pour lequel vous souhaitez réserver) :</label>";
	echo "<br/> <br/> identifiant vacances : ";
	echo "<select name='idv' id='idv'>";
	$results=$cnx->query("select idv, datedebut,datefin from vacances where zone = '$zone' AND localisation = '$localisation' AND nom = '$nomvac' AND datedebut > '$datereserv' ORDER BY datedebut ASC;");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
			$i = $ligne['idv'];
	    	echo " <option value=$i>$i</option>";
	    
	}
	echo "</select>";
	
	echo "<br/> <br/>";
	
	echo "<input type='submit' value='valider'/>";
		echo "<br\>"; echo "<br\>";

		echo "</form>";
 	
echo" <br/><br/>";

/* ici se trouve le formulaire pour choisir la période de vacances qui nous intéresse(fin) */


}

/* ici se trouve le formulaire pour choisir la date de départ de vacances qui nous intéresse (début) */

if(isset($_GET['nomvac']) == true && !empty($_GET['idv']) == true && !empty($_GET['datedeb']) ==false)
{

$zone = $_GET['zone'];
$localisation = $_GET['localisation'];
$nomvac = $_GET['nomvac'];
$idv = $_GET['idv'];


echo "<table border = '1'>";
	echo '  <tr> ';
	echo '<td>id vacances</td>';
	echo '<td>date debut</td>';
	echo '<td>date fin</td>';
	echo '<td>Vacances</td>';
	echo ' </tr> ';
	
$results=$cnx->query("select idv, datedebut,datefin from vacances where zone = '$zone' AND localisation = '$localisation' AND nom = '$nomvac' AND idv = '$idv' ORDER BY datedebut ASC;");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
		//$service = $ligne['service'];
		//$nbre = $ligne['nbre'];
		echo '<tr>';
		echo "<td> ".$ligne['idv']. "</td>";
		echo "<td> ".$ligne['datedebut']. "</td>";
		echo "<td> ".$ligne['datefin']. "</td>";
		echo "<td>$nomvac</td>";
		echo '<tr>';
		}
	
	echo '</table>';
	
	echo '<br/><br/>';
	
echo "<a href = 'formulaire_reservation_user2.php?zone=$zone&localisation=$localisation&nomvac=$nomvac'> précédent </a>";
echo "<br/> </br>";
echo" <form method = 'GET' action = 'formulaire_reservation_user2.php'>";

	
echo "<p> Zone choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='zone' name='zone' value='$zone' checked>";
  echo "<label for='zone'>$zone</label>";
echo "</div>";

echo "<p> localisation choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='localisation' name='localisation' value='$localisation' checked>";
  echo "<label for='localisation'>$localisation</label>";
echo "</div>";
	
echo "<p> Vacances choisies :</p>";
	
echo "<div>";
  echo "<input type='radio' id='nomvac' name='nomvac' value='$nomvac' checked>";
  echo "<label for='nomvac'>$nomvac</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Période choisie :</p>";
	
echo "<div>";
  echo "<input type='radio' id='idv' name='idv' value='$idv' checked>";
  echo "<label for='idv'>$idv</label>";
echo "</div>";

echo" <br/><br/>";

if($nomvac != 'Vacances été')
{
	echo" 	<label for='datedeb'>Veuillez choisir la date du samedi pour lequel vous souhaitez commencer votre séjour (les séjours durent 1 semaine du samedi au samedi) :</label>";
		echo "<br/> <br/> date début : ";
		echo "<select name='datedeb' id='datedeb'>";
		$results=$cnx->query("select idv, datedebut,datefin-9 as datefin from vacances where zone = '$zone' AND localisation = '$localisation' AND nom = '$nomvac' AND idv = '$idv' ORDER BY datedebut ASC;");
		$results->setFetchMode(PDO::FETCH_ASSOC);
		foreach($results as $ligne){
				$i = $ligne['datedebut'];
		    	echo " <option value=$i>$i</option>";
		    		$i = $ligne['datefin'];
		    	echo " <option value=$i>$i</option>";
		    		
		    
		}
		echo "</select>";
		
		echo "<br/> <br/>";
		
		echo "<input type='submit' value='valider'/>";
			echo "<br\>"; echo "<br\>";

			echo "</form>";
	 	
	echo" <br/><br/>";
}
if($nomvac == 'Vacances été')
{
	
	echo" 	<label for='datedeb'>Veuillez choisir la date du samedi pour lequel vous souhaitez commencer votre séjour (les séjours durent 1 semaine du samedi au samedi) :</label>";
		echo "<br/> <br/> date début : ";
		echo "<select name='datedeb' id='datedeb'>";
		$results=$cnx->query("select idv, datedebut,datefin as datefin from vacances where zone = '$zone' AND localisation = '$localisation' AND nom = '$nomvac' AND idv = '$idv' ORDER BY datedebut ASC;");
		$results->setFetchMode(PDO::FETCH_ASSOC);
		foreach($results as $ligne){
				$i1 = $ligne['datedebut'];
		    	echo " <option value=$i1>$i1</option>";
		    	$i2 = $ligne['datefin'];	
		    
		}
		
		
		/*$date = date('d-m-y',strtotime("$i1 +7 day"));
		while($date < date('d-m-y',strtotime("$i2 -2 day")))
		{
			echo " <option value=$date>$date</option>";
			$date = date('d-m-y',strtotime("$date +7 day"));
		}*/
		$date = date('Y-m-d',strtotime("$i1 +7 day"));
		while($date < date('Y-m-d',strtotime("$i2 -2 day")))
		{
			echo " <option value=$date>$date</option>";
			$date = date('Y-m-d',strtotime("$date +7 day"));
		}
		echo "</select>";
		
		echo "<br/> <br/>";
		
		echo "<input type='submit' value='valider'/>";
			echo "<br\>"; echo "<br\>";

			echo "</form>";
	 	
	echo" <br/><br/>";




}

/* ici se trouve le formulaire pour choisir la date de départ des vacances (fin) */


}

/* ici se trouve le formulaire pour choisir la pension qui vous intéresse (début) */

if(isset($_GET['nomvac']) == true && !empty($_GET['idv']) == true && !empty($_GET['datedeb']) ==true && !empty($_GET['pension']) ==false)
{

$zone = $_GET['zone'];
$localisation = $_GET['localisation'];
$nomvac = $_GET['nomvac'];
$idv = $_GET['idv'];
$datedeb = $_GET['datedeb'];
	
echo "<a href = 'formulaire_reservation_user2.php?zone=$zone&localisation=$localisation&nomvac=$nomvac&idv=$idv'> précédent </a>";
echo "<br/> </br>";
echo" <form method = 'GET' action = 'formulaire_reservation_user2.php'>";

	
echo "<p> Zone choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='zone' name='zone' value='$zone' checked>";
  echo "<label for='zone'>$zone</label>";
echo "</div>";

echo "<p> localisation choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='localisation' name='localisation' value='$localisation' checked>";
  echo "<label for='localisation'>$localisation</label>";
echo "</div>";
	
echo "<p> Vacances choisies :</p>";
	
echo "<div>";
  echo "<input type='radio' id='nomvac' name='nomvac' value='$nomvac' checked>";
  echo "<label for='nomvac'>$nomvac</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Période choisie :</p>";
	
echo "<div>";
  echo "<input type='radio' id='idv' name='idv' value='$idv' checked>";
  echo "<label for='idv'>$idv</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Date de départ choisie :</p>";
	
echo "<div>";
  echo "<input type='radio' id='datedeb' name='datedeb' value='$datedeb' checked>";
  echo "<label for='datedeb'>$datedeb</label>";
echo "</div>";

echo" <br/><br/>";

		
		echo" 	<label for='pension'>Veuillez sélectionner le service de pension que vous souhaiter prendre :</label>";
	echo "<br/> <br/>";
		echo "<br/> <br/> service : ";
		echo "<select name='pension' id='pension'>";
		$results=$cnx->query("select nom from service where nom = 'demi-pension' OR nom = 'pension complète';");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
			$i = $ligne['nom'];
	    	echo " <option value='$i'>$i</option>";
	    
	}	
		echo "</select>";
		
		echo "<br/> <br/>";
		
		/*echo" 	<label for='nomvac'>Veuillez sélectionner les vacances pour lesquelles vous voulez réserver une place :</label>";
	echo "<br/> <br/>";
	
	echo "<br/> <br/> service : ";
	echo "<select name='nomvac' id='nomvac'>";
	$results=$cnx->query("select distinct nom from vacances where zone = '$zone' AND localisation = '$localisation' ORDER BY nom ASC;");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
			$i = $ligne['nom'];
	    	echo " <option value='$i'>$i</option>";
	    
	}
	echo "</select>";*/
		
		echo "<input type='submit' value='valider'/>";
			echo "<br\>"; echo "<br\>";

			echo "</form>";
	 	
	echo" <br/><br/>";






}
/* ici se trouve le formulaire pour choisir votre pension (fin) */

/* ici se trouve le formulaire pour choisir si vous souhaitez ou non prendre le service de ménage de fin de séjour (début) */

if(isset($_GET['nomvac']) == true && !empty($_GET['idv']) == true && !empty($_GET['datedeb']) ==true && !empty($_GET['pension']) ==true && !empty($_GET['menage']) == false)
{

$zone = $_GET['zone'];
$localisation = $_GET['localisation'];
$nomvac = $_GET['nomvac'];
$idv = $_GET['idv'];
$datedeb = $_GET['datedeb'];
$pension = $_GET['pension'];

	
echo "<a href = 'formulaire_reservation_user2.php?zone=$zone&localisation=$localisation&nomvac=$nomvac&idv=$idv&datedeb=$datedeb'> précédent </a>";
echo "<br/> </br>";
echo" <form method = 'GET' action = 'formulaire_reservation_user2.php'>";

	
echo "<p> Zone choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='zone' name='zone' value='$zone' checked>";
  echo "<label for='zone'>$zone</label>";
echo "</div>";

echo "<p> localisation choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='localisation' name='localisation' value='$localisation' checked>";
  echo "<label for='localisation'>$localisation</label>";
echo "</div>";
	
echo "<p> Vacances choisies :</p>";
	
echo "<div>";
  echo "<input type='radio' id='nomvac' name='nomvac' value='$nomvac' checked>";
  echo "<label for='nomvac'>$nomvac</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Période choisie :</p>";
	
echo "<div>";
  echo "<input type='radio' id='idv' name='idv' value='$idv' checked>";
  echo "<label for='idv'>$idv</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Date de départ choisie :</p>";
	
echo "<div>";
  echo "<input type='radio' id='datedeb' name='datedeb' value='$datedeb' checked>";
  echo "<label for='datedeb'>$datedeb</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Pension choisie :</p>";
	
echo "<div>";
  echo "<input type='radio' id='pension' name='pension' value='$pension' checked>";
  echo "<label for='pension'>$pension</label>";
echo "</div>";

echo" <br/><br/>";

		
echo" 	<label for='menage'>Veuillez choisir si oui ou non vous souhaitez prendre le service de ménage de fin de séjour :</label>";
	echo "<br/> <br/> ménage : ";
	echo "<select name='menage' id='menage'>";
	    	echo " <option value='oui'>oui</option>";
	    	echo " <option value='non'>non</option>";
	echo "</select>";
	
	echo "<br/> <br/>";
		
		echo "<input type='submit' value='valider'/>";
			echo "<br\>"; echo "<br\>";

			echo "</form>";
	 	
	echo" <br/><br/>";


}
/* ici se trouve le formulaire pour choisir si vous souhaitez ou non prendre le service de ménage de fin de séjour (fin) */

/* ici se trouve le formulaire pour choisir le logement dans lequel (début) */

if(isset($_GET['nomvac']) == true && !empty($_GET['idv']) == true && !empty($_GET['datedeb']) ==true && !empty($_GET['pension']) ==true && !empty($_GET['menage']) == true && !empty($_GET['idvilla']) == false)
{

$zone = $_GET['zone'];
$localisation = $_GET['localisation'];
$nomvac = $_GET['nomvac'];
$idv = $_GET['idv'];
$datedeb = $_GET['datedeb'];
$pension = $_GET['pension'];
$menage = $_GET['menage'];
	
echo "<a href = 'formulaire_reservation_user2.php?zone=$zone&localisation=$localisation&nomvac=$nomvac&idv=$idv&datedeb=$datedeb&pension=$pension'> précédent </a>";
echo "<br/> </br>";

echo "<table border = '1'>";
	echo '  <tr> ';
	echo '<td>id village</td>';
	echo '<td>nom</td>';
	echo '<td>ville</td>';
	echo '<td>region</td>';
	echo '<td>Superficie en Km2</td>';
	echo '<td>Description</td>';
	echo ' </tr> ';
	
$results=$cnx->query("select * from village;");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
		//$service = $ligne['service'];
		//$nbre = $ligne['nbre'];
		echo '<tr>';
		echo "<td> ".$ligne['idvilla']. "</td>";
		echo "<td> ".$ligne['nom']. "</td>";
		echo "<td> ".$ligne['ville']. "</td>";
		echo "<td> ".$ligne['region']. "</td>";
		echo "<td> ".$ligne['superficiekm2']. "</td>";
		echo "<td> ".$ligne['description']. "</td>";
		echo '<tr>';
		}
	
	echo '</table>';
	
	echo '<br/><br/>';
	
	
echo" <form method = 'GET' action = 'formulaire_reservation_user2.php'>";

	
echo "<p> Zone choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='zone' name='zone' value='$zone' checked>";
  echo "<label for='zone'>$zone</label>";
echo "</div>";

echo "<p> localisation choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='localisation' name='localisation' value='$localisation' checked>";
  echo "<label for='localisation'>$localisation</label>";
echo "</div>";
	
echo "<p> Vacances choisies :</p>";
	
echo "<div>";
  echo "<input type='radio' id='nomvac' name='nomvac' value='$nomvac' checked>";
  echo "<label for='nomvac'>$nomvac</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Période choisie :</p>";
	
echo "<div>";
  echo "<input type='radio' id='idv' name='idv' value='$idv' checked>";
  echo "<label for='idv'>$idv</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Date de départ choisie :</p>";
	
echo "<div>";
  echo "<input type='radio' id='datedeb' name='datedeb' value='$datedeb' checked>";
  echo "<label for='datedeb'>$datedeb</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Pension choisie :</p>";
	
echo "<div>";
  echo "<input type='radio' id='pension' name='pension' value='$pension' checked>";
  echo "<label for='pension'>$pension</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Option ménage fin de séjour :</p>";
	
echo "<div>";
  echo "<input type='radio' id='$menage' name='menage' value='$menage' checked>";
  echo "<label for='$menage'>$menage</label>";
echo "</div>";

echo" <br/><br/>";

		
echo" 	<label for='idvilla'>Veuillez choisir l'id du village dans lequel vous souhaitez passer vos vacances:</label>";
	echo "<select name='idvilla' id='idvilla'>";
	$results=$cnx->query("select * from village;");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
			$i = $ligne['idvilla'];
	    	echo " <option value=$i>$i</option>";
	    
	}
	echo "</select>";
		
		echo "<input type='submit' value='valider'/>";
			echo "<br\>"; echo "<br\>";

			echo "</form>";
	 	
	echo" <br/><br/>";


}
/* ici se trouve le formulaire pour choisir le village dans lequel l'utilisateur va s'installer (fin) */


/* ici se trouve le formulaire pour choisir le logement dans lequel l'utilisateur va s'installer (début) */

if(isset($_GET['nomvac']) == true && !empty($_GET['idv']) == true && !empty($_GET['datedeb']) ==true && !empty($_GET['pension']) ==true && !empty($_GET['menage']) == true && !empty($_GET['idvilla']) == true && !empty($_GET['idlog']) == false)
{

$zone = $_GET['zone'];
$localisation = $_GET['localisation'];
$nomvac = $_GET['nomvac'];
$idv = $_GET['idv'];
$datedeb = $_GET['datedeb'];
$pension = $_GET['pension'];
$menage = $_GET['menage'];
$idvilla = $_GET['idvilla'];	

echo "<a href = 'formulaire_reservation_user2.php?zone=$zone&localisation=$localisation&nomvac=$nomvac&idv=$idv&datedeb=$datedeb&pension=$pension&menage=$menage'> précédent </a>";
echo "<br/> </br>";

echo "<p> Tous les logements disponible dans le village que vous avez choisi : </p>";

echo "<table border = '1'>";
	echo '  <tr> ';
	echo '<td>id logement</td>';
	echo '<td>nom village</td>';
	echo '<td>prix</td>';
	echo '<td>gamme</td>';
	echo '<td>nombre de places</td>';
	echo '<td>nombre de lits </td>';
	echo '<td>nombre de chambres</td>';
	echo '<td>Description</td>';
	echo ' </tr> ';
	
$results=$cnx->query("select idlog,village.nom,nblit,nbchambre,prix,gamme,nbplace,logement.description from logement,village,type where village.idvilla = logement.idvilla AND type.idtype = logement.idtype AND village.idvilla = '$idvilla' AND idlog NOT IN (select idlog from reservation where datedebut = '$datedeb' ORDER BY idlog ASC)
ORDER BY idlog ASC;");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
		//$service = $ligne['service'];
		//$nbre = $ligne['nbre'];
		echo '<tr>';
		echo "<td> ".$ligne['idlog']. "</td>";
		echo "<td> ".$ligne['nom']. "</td>";
		echo "<td> ".$ligne['prix']. " &euro;</td>";
		echo "<td> ".$ligne['gamme']. "</td>";
		echo "<td> ".$ligne['nbplace']. "</td>";
		echo "<td> ".$ligne['nblit']. "</td>";
		echo "<td> ".$ligne['nbchambre']. "</td>";
		echo "<td> ".$ligne['description']. "</td>";
		echo '<tr>';
		}
	
	echo '</table>';
	
	echo '<br/><br/>';
	


	
	
echo" <form method = 'POST' action = 'reservation_user2.php'>";

	
echo "<p> Zone choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='zone' name='zone' value='$zone' checked>";
  echo "<label for='zone'>$zone</label>";
echo "</div>";

echo "<p> localisation choisie :</p>";

echo "<div>";
  echo "<input type='radio' id='localisation' name='localisation' value='$localisation' checked>";
  echo "<label for='localisation'>$localisation</label>";
echo "</div>";
	
echo "<p> Vacances choisies :</p>";
	
echo "<div>";
  echo "<input type='radio' id='nomvac' name='nomvac' value='$nomvac' checked>";
  echo "<label for='nomvac'>$nomvac</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Période choisie :</p>";
	
echo "<div>";
  echo "<input type='radio' id='idv' name='idv' value='$idv' checked>";
  echo "<label for='idv'>$idv</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Date de départ choisie :</p>";
	
echo "<div>";
  echo "<input type='radio' id='datedeb' name='datedeb' value='$datedeb' checked>";
  echo "<label for='datedeb'>$datedeb</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Pension choisie :</p>";
	
echo "<div>";
  echo "<input type='radio' id='pension' name='pension' value='$pension' checked>";
  echo "<label for='pension'>$pension</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> Option ménage fin de séjour :</p>";
	
echo "<div>";
  echo "<input type='radio' id='$menage' name='menage' value='$menage' checked>";
  echo "<label for='$menage'>$menage</label>";
echo "</div>";

echo" <br/><br/>";

echo "<p> ID du village choisi :</p>";
	
echo "<div>";
  echo "<input type='radio' id='$idvilla' name='idvilla' value='$idvilla' checked>";
  echo "<label for='$idvilla'>$idvilla</label>";
echo "</div>";

echo" <br/><br/>";

		
echo" 	<label for='idlog'>Veuillez choisir le logement dans lequel vous souhaitez passer vos vacances:</label>";
	echo "<select name='idlog' id='idlog'>";
	$results=$cnx->query("select idlog,village.nom,nblit,nbchambre,prix,gamme,nbplace,logement.description from logement,village,type where village.idvilla = logement.idvilla AND type.idtype = logement.idtype AND village.idvilla = '$idvilla' AND idlog NOT IN (select idlog from reservation where datedebut = '$datedeb' ORDER BY idlog ASC)
ORDER BY idlog ASC;");
	$results->setFetchMode(PDO::FETCH_ASSOC);
	foreach($results as $ligne){
			$i = $ligne['idlog'];
	    	echo " <option value=$i>$i</option>";
	    
	}
	echo "</select>";
		
		echo "<input type='submit' value='valider'/>";
			echo "<br\>"; echo "<br\>";

			echo "</form>";
	 	
	echo" <br/><br/>";


}
/* ici se trouve le formulaire pour choisir le logement dans lequel l'utilisateur va s'installer (fin) */
?>
