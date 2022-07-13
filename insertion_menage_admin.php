<?php
include('deconnexion.php');
if(isset($_POST['idr']) == false)
{
	header("location:gestion_reservation_admin.php");
}


$id = $_POST['idr'];

$results=$cnx->exec("DELETE from dispose WHERE idr = '$id' AND ids ='6'; ");
		/*il n'y a actuellement pas de vérification pour s'assurer que la suppression a bien été effectuée mais à priori elle fonctionne*/
		if($results ==0)
		{
			$req_insert = "INSERT INTO dispose (ids,idr) VALUES ('6', '$id')";
			$results=$cnx->exec($req_insert);
			if($results ==0)
			{
					$echec = 1;
			}
		}
		else
		{
			$req_insert = "INSERT INTO dispose (ids,idr) VALUES ('6', '$id')";
			$results=$cnx->exec($req_insert);
			if($results ==0)
			{
					$echec = 1;
			}
		}

if(isset($echec))
{
	header("location:gestion_reservation_admin.php?modifier=0");
}
elseif(isset($echec) == false)
{
	header("location:gestion_reservation_admin.php?modifier=1");
}
?>
