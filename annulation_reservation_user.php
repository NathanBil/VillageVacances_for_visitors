<?php
include('deconnexion.php');
if(isset($_POST['reserv']) == false)
{
	header("location:formulaire_annulation_reservation_user.php");
}


$id = $_POST['reserv'];

$results=$cnx->exec("DELETE from reservation WHERE idr = '$id'; ");

if($results !=0)
{
	header("location:formulaire_annulation_reservation_user.php?delete=1");
}
else
{
	header("location:formulaire_annulation_reservation_user.php?delete=0");
}
?>
