<?php
include('deconnexion.php');
if(isset($_POST['idr']) == false)
{
	header("location:gestion_reservation_admin.php");
}


$id = $_POST['idr'];

$results=$cnx->exec("UPDATE reservation SET statut = 'valide' WHERE idr = '$id' ");

if($results !=0)
{
	header("location:gestion_reservation_admin.php?validate=1");
}
else
{
	header("location:gestion_reservation_admin.php?validate=0");
}
?>
