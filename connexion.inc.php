<?php

/*
 * création d'objet PDO de la connexion qui sera représenté par la variable $cnx
 */
$user =  "nathanbilingi";
$pass =  '2456';
$dsn = 'pgsql:host=localhost;dbname=nathanbilingi';
try {
    $cnx = new PDO($dsn,
	$user, $pass);
}
catch (PDOException $e) {
    echo "ERREUR : La connexion a échouée";

 /* Utiliser l'instruction suivante pour afficher le détail de erreur sur la
 * page html. Attention c'est utile pour débugger mais cela affiche des
 * informations potentiellement confidentielles donc éviter de le faire pour un
 * site en production.*/
	echo "Error: " . $e;

/* les données rendues publiques en cas d'erreur sont : le nom de la base de données et l'endroit où est stocké le fichier connexion.inc.php
*/

}

?>

