<?php
include('deconnexion.php');
if(isset($_POST['idr']) == false)
{
	header("location:gestion_reservation_admin.php");
}


$id = $_POST['idr'];

$results=$cnx->exec("DELETE from reservation WHERE idr = '$id'; ");

if($results !=0)
{
	header("location:gestion_reservation_admin.php?delete=1");
}
else
{
	header("location:gestion_reservation_admin.php?delete=0");
}
?>
