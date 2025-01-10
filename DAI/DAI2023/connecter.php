<?php 
// connexion 
function connecter() {
//$host = 'srv_declaration';
// $dbname = 'db_commande';
// $username = 'user_achat';
// $password = 'user@achat@';


$host = "Localhost";
$dbname = "db_commande";
$username = 'root';
$password = 'Dashboard@2024';



$con = new mysqli($host, $username, $password, $dbname);

// Vérification de la connexion
if ($con->connect_error) {
die('Erreur de connexion : ' . $con->connect_error);
}

return $con;
}
?>