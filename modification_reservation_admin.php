<?php
include('deconnexion.php');
?>

<?php

if(isset($_POST['idr']) == false)
{
	header("location:gestion_reservation_admin.php");
}
else
{
	$idr = $_POST['idr'];
}

if(!empty($_POST['ide']))
{
	
	$ide = $_POST['ide'];
	$results=$cnx->exec("UPDATE reservation SET ide = '$ide' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}

}

if(!empty($_POST['idlog']))
{

	$idlog = $_POST['idlog'];
	$results=$cnx->exec("UPDATE reservation SET idlog = '$idlog' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}
	

}

if(!empty($_POST['idtype']))
{

	$idtype = $_POST['idtype'];
	$results=$cnx->exec("UPDATE reservation SET idtype = '$idtype' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}
	

}

if(!empty($_POST['prix']))
{

	$prix = $_POST['prix'];
	$results=$cnx->exec("UPDATE reservation SET prix = '$prix' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}
	

}

if(!empty($_POST['idv']))
{

	$idv = $_POST['idv'];
	$results=$cnx->exec("UPDATE reservation SET idv = '$idv' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}
	

}

if(!empty($_POST['statut']))
{

	$statut = $_POST['statut'];
	$results=$cnx->exec("UPDATE reservation SET statut = '$statut' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}
	

}
/* une limite de ce code c'est le cas où on change l'ordre d'insertion des services une amélioration serait de récupérer directement l'id du service qui s'appellle "demi pension" et "pension complète"*/

if(!empty($_POST['ids1']) && $_POST['ids1'] == '4' || !empty($_POST['ids1']) && $_POST['ids1'] == '5' )
{

	$ids1= $_POST['ids1'];
		
		$results=$cnx->exec("DELETE from dispose WHERE idr = '$idr' AND ids ='5' OR idr ='$idr' AND ids ='4'; ");
		/*il n'y a actuellement pas de vérification pour s'assurer que la suppression a bien été effectuée mais à priori elle fonctionne*/
		if($results ==0)
		{
			$req_insert = "INSERT INTO dispose (ids,idr) VALUES ('$ids1', '$idr')";
			$results=$cnx->exec($req_insert);
			if($results ==0)
			{
					$echec = 1;
			}
		}
		else
		{
			$req_insert = "INSERT INTO dispose (ids,idr) VALUES ('$ids1', '$idr')";
			$results=$cnx->exec($req_insert);
			if($results ==0)
			{
					$echec = 1;
			}
		}
		
		
		/*
		elseif($results ==0)
		{
			$echec = 1;
		}*/
	

}
/*ne fonctionne pas avec des elseif ce qui signifie que l'action d'alteration des tables est effectuées deux fois dans certaines situations*/
if(!empty($_POST['datereserv']) && !empty($_POST['datedeb']) && !empty($_POST['datefin']))
{
	$datereserv = $_POST['datereserv'];
	$datedeb = $_POST['datedeb'];
	$datefin = $_POST['datefin'];
	$results=$cnx->exec("UPDATE reservation SET datereserv = '$datereserv', datedebut = '$datedeb', datefin = '$datefin' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}
}
if(!empty($_POST['datereserv']) && !empty($_POST['datedeb']))
{
	$datereserv = $_POST['datereserv'];
	$datedeb = $_POST['datedeb'];
	$results=$cnx->exec("UPDATE reservation SET datereserv = '$datereserv', datedebut = '$datedeb' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}


}

if(!empty($_POST['datereserv']) && !empty($_POST['datefin']))
{
	$datereserv = $_POST['datereserv'];
	$datefin = $_POST['datefin'];
	$results=$cnx->exec("UPDATE reservation SET datereserv = '$datereserv', datefin = '$datefin' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}


}

if(!empty($_POST['datedeb']) && !empty($_POST['datefin']))
{
	$datedeb = $_POST['datedeb'];
	$datefin = $_POST['datefin'];
	$results=$cnx->exec("UPDATE reservation SET datedebut = '$datedeb', datefin = '$datefin' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}
}
if(!empty($_POST['datereserv']))
{

	$datereserv = $_POST['datereserv'];
	$results=$cnx->exec("UPDATE reservation SET datereserv = '$datereserv' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}
	

}

if(!empty($_POST['datedeb']))
{

	$datedeb = $_POST['datedeb'];
	$results=$cnx->exec("UPDATE reservation SET datedebut = '$datedeb' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}
	

}

if(!empty($_POST['datefin']))
{

	$datefin = $_POST['datefin'];
	$results=$cnx->exec("UPDATE reservation SET datefin = '$datefin' WHERE idr = '$idr' ");

	if($results ==0)
	{
		$echec = 1;
	}
	

}
if(isset($_POST['idr']) == true)
{
	if(isset($echec))
	{
		header("location:gestion_reservation_admin.php?modifier=0");
	}
	elseif(isset($echec) == false)
	{
		header("location:gestion_reservation_admin.php?modifier=1");
	}

}


?>
