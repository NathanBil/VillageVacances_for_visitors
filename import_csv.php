<?php
include('deconnexion2.php');
if(isset($_SESSION["titre"]))
{
	// à modifier pour renvoyer vers la vraie page d'accueil utilisateur
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

  if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
      
      $file = fopen($fileName, "r");
      
      while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
        $sql = "INSERT into vacances (nom,datedebut,datefin,localisation,zone,annee_scolaire)
             values ('" . $column[0] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "')";
        $result = $cnx->exec("$sql");
        
        if (!empty($result)) {
          $type = "success";
          $message = "Les Données sont importées dans la base de données";
           header('Location:index.php?import=1');
        } 
        
        else {
          $type = "error";
          $message = "Problème lors de l'importation de données CSV";
          header('Location:index.php?import=0');
        }
      }
    }
  }
  //Retourner à la page index.php
 //header('Location: index.php');
  exit;
?>
