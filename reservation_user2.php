<?php
include("deconnexion2.php");
if(isset($_SESSION["login"]) == false)
{
	header("location:formulaire_authentification.php");
}
$datereserv = date('Y-m-d'); 
echo "$datereserv <br/><br/>";
$login = $_SESSION['login'];

/* on s'assure que le dernier formulaire a été rempli ce qui signifie implicitement que tous les formulaires ont été remplis car pour arriver au dernier il faut faire les précédents*/
if(!empty($_POST['idlog']))
{
	
	$idv = $_POST['idv'];
	$datedeb = $_POST['datedeb'];
	$datefin = date('Y-m-d',strtotime("$datedeb +7 day"));
	
	echo "datefin = $datefin ";
	/*on vérifie que le nom de la pension que le user a écrit est correct*/
	if($_POST['pension'] == 'demi-pension'  || $_POST['pension'] == 'pension complète')
	{
		$pension = $_POST['pension'];
		/* récupération de l'id du service de pension dans une variable ids*/

	$req_select = "SELECT ids from service where nom = '$pension'";
		$results = $cnx->query($req_select);
		if($results == TRUE)
		{
			$results->setFetchMode(PDO::FETCH_ASSOC);
			foreach($results as $ligne){
			$ids = $ligne['ids'];
			}
		}
		else
		{
			echo "erreur lors de la récupération de l'id de la pension dans une variable <br/><br/>";
			header("location:formulaire_reservation_user2.php?reserver=0");
		}
		
	}
	else
	{
		header("location:formulaire_reservation_user2.php?reserver=0");
	}
	
	/* récupération de l'id du service de ménage dans une variable ids2 (début)*/
	
	if(!empty($_POST['menage']))
	{
		/* on enregistre ménage fin de séjour seulement si le user a souhaité cette option*/
		if($_POST['menage'] == 'oui')
		{
			$menage = 'ménage fin de séjour';
			

		$req_select = "SELECT ids from service where nom = '$menage'";
			$results = $cnx->query($req_select);
			if($results == TRUE)
			{
				$results->setFetchMode(PDO::FETCH_ASSOC);
				foreach($results as $ligne){
				$ids2 = $ligne['ids'];
				}
			}
			else
			{
				echo "erreur lors de la récupération de l'id du ménage dans une variable <br/><br/>";
				header("location:formulaire_reservation_user2.php?reserver=0");
			}
		 }
		
	}
	else
	{
		header("location:formulaire_reservation_user2.php?reserver=0");
	}
	
	/* récupération de l'id du service de ménage dans une variable ids2 (fin)*/
	
	$menage = $_POST['menage'];
	$datedeb = $_POST['datedeb'];
	$idvilla = $_POST['idvilla'];
	$idlog= $_POST['idlog'];
	/* récupération de l'ide dans une variable ide*/

	$req_select = "SELECT ide from employe where login = '$login'";
		$results = $cnx->query($req_select);
		if($results == TRUE)
		{
			$results->setFetchMode(PDO::FETCH_ASSOC);
			foreach($results as $ligne){
			$ide = $ligne['ide'];
			}
		}
		else
		{
			echo "erreur lors de la récupération de l'id de l'employé dans une variable <br/><br/>";
			header("location:formulaire_reservation_user2.php?reserver=0");
		}
		
	/* récupération du type et du prix du logement dans deux variables type et prix */

	$req_select = "select prix, idtype from logement natural join type where idlog='$idlog';";
		$results = $cnx->query($req_select);
		if($results == TRUE)
		{
			$results->setFetchMode(PDO::FETCH_ASSOC);
			foreach($results as $ligne){
			$prix = $ligne['prix'];
			$idtype = $ligne['idtype'];
			}
		}
		else
		{
			echo "erreur lors de la récupération du prix et du type du logement dans deux variable <br/><br/>";
			header("location:formulaire_reservation_user2.php?reserver=0");
		}

	
	/*requête d'insertion de la réservation dans réservation*/
	$req_insert = "INSERT INTO reservation (ide,idlog,idtype,idv,prix,datereserv,datedebut,datefin,statut) VALUES ('$ide', '$idlog','$idtype','$idv','$prix','$datereserv','$datedeb','$datefin','en cours') RETURNING idr";
/*$req_insert = "INSERT INTO reservation (ide,idlog,idtype,idv,prix,datereserv,datedebut,datefin,statut) VALUES ('$ide', '$idlog','$idtype','$idv','$prix','19-01-28','20-01-5','20-01-12','en cours') RETURNING idr";*/
/* À Corriger voir les dates si elles posent problèmes */
		$results = $cnx->query($req_insert);
		if($results == TRUE)
		{
			echo "La réservation a bien été enregistrée. <br/><br/>";
			$results->setFetchMode(PDO::FETCH_ASSOC);
			foreach($results as $ligne){
			$idr = $ligne['idr'];
			}
		}
		else
		{
			echo "erreur lors de l'insertion de la reservation. <br/><br/>";
			header("location:formulaire_reservation_user2.php?reserver=0");
		}
	
	/*requête d'insertion de la pension choisies dans dispose*/
	$results=$cnx->exec("INSERT INTO dispose(ids,idr) VALUES('$ids','$idr')");
	if($results == TRUE)
	{
			echo "La pension a bien été enrgistrée. <br/><br/>";
			/* si l'utilisateur n'a pas choisi le ménage on le renvoie vers la paga de réservation en lui indiquant que sa réservation a fonctionnée*/
			if(isset($ids2) == false)
			{
				header("location:formulaire_reservation_user2.php?reserver=2");
			}
			
	}
	else
	{
		/*suppression de la réservation car échec pour la pension*/
		$results=$cnx->exec("DELETE FROM reservation WHERE idr = '$idr'");
		
		if($results == TRUE)
		{
				echo "La suppression de la réservation a bien été effectuée.";
				header("location:formulaire_reservation_user2.php?reserver=1");
				
		}
		else
		{
			echo "erreur lors de la suppression de la réservation <br/><br/>";
			header("location:formulaire_reservation_user2.php?reserver=1");
		}
		/*suppression de la réservation car écehc pour la pension*/
			
			echo "erreur lors de l'insertion du service de pension et d'un id de réservation dans la table dispose <br/><br/>";
			header("location:formulaire_reservation_user2.php?reserver=1");
	}

	
	/*requête d'insertion du ménage choisies dans dispose ou bien on ne fait rien*/
	if(isset($ids2))
	{
		$results=$cnx->exec("INSERT INTO dispose(ids,idr) VALUES('$ids2','$idr')");
		
		if($results == TRUE)
		{
				echo "Le ménage a bien été enregistré.";
				header("location:formulaire_reservation_user2.php?reserver=2");
				
		}
		else
		{
			/*suppression de la réservation car échec pour le ménage (et par effet domino de la pension)*/
			$results=$cnx->exec("DELETE FROM reservation WHERE idr = '$idr'");
			
			if($results == TRUE)
			{
					echo "La suppression de la réservation a bien été effectuée. <br/><br/>";
					header("location:formulaire_reservation_user2.php?reserver=1");
					
			}
			else
			{
				echo "erreur lors de la suppression de la réservation <br/><br/>";
				header("location:formulaire_reservation_user2.php?reserver=1");
			}
			/*suppression de la réservation car échec pour le ménage*/
			echo "erreur lors de l'insertion du service de ménage et d'un id de réservation dans la table dispose <br/><br/>";
			header("location:formulaire_reservation_user2.php?reserver=1");
		}
	}
	
}
/* on renvoie l'utilisateur si toutes les données n'ont pas été bien remplies*/

else
{
	header("location:formulaire_reservation_user2.php?reserver=0");
}



?>
