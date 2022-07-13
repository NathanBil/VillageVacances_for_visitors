<?php
include('deconnexion2.php');
include('liens_admin.php');
include("liens_user.php");

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

if(isset($_GET['import']))
{
	if($_GET['import'] == 1)
	{
		echo "L'importation a été réalisée avec succès. <br/><br/>";
	}
	if($_GET['import'] == 0)
	{
		echo "L'importation a échouée partiellement ou totalement. <br/><br/>";
		echo "Attention il est aussi possible que votre importation ait fonctionné mais que vous ayez tenté d'introduire des données similaires dans la base de données d'où le message d'erreur. Cela signifie simplement que les données qui faisaient doublons n'ont pas pu être introduite car elles étaient déjà présentes. <br/><br/>";
	}

}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Comment importer un fichier CSV dans MySQL avec PHP</title>
</head>
<body>
    
    <form enctype="multipart/form-data" action="import_csv.php" method="post">
        <div class="input-row">
            <label class="col-md-4 control-label">Choisir un fichier CSV</label>
            <input type="file" name="file" id="file" accept=".csv">
            <br />
            <br />
            <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
            <br />
        </div>
    </form>
    <?php
      // Connect to database
     include('connexion.inc.php');
            $sql = "SELECT * FROM vacances";
            $results = $cnx->query($sql);
    ?>
        <table border = '1'>
            <thead>
                <tr>
                    <th>nom</th>
                    <th>date debut</th>
                    <th>date fin</th>
                    <th>localisation</th>
                    <th>zone</th>
                    <th>annee scolaire</th>
                </tr>
            </thead>
            <?php { ?>
                <tbody>
            <?php 
     $results->setFetchMode(PDO::FETCH_ASSOC);
	//Le foreach réalise un fetch automatiquement
	 			
	foreach($results as $ligne){
		/*$service = $ligne['service'];
		$nbre = $ligne['nbre'];*/
		echo '<tr>';
		echo "<td> ".$ligne['nom']. "</td>";
		echo "<td> ".$ligne['datedebut']. "</td>";
		echo "<td> ".$ligne['datefin']. "</td>";
		echo "<td> ".$ligne['localisation']. "</td>";
		echo "<td> ".$ligne['zone']. "</td>";
		echo "<td> ".$ligne['annee_scolaire']. "</td>";
		echo '<tr>';
		}
             ?>       
            <?php } ?>
                </tbody>
        </table>
        <?php ?>
</body>
</html>
