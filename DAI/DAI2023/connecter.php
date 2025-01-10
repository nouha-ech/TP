<?php 
// connexion 
function connecter() {
//$host = 'srv_declaration';
// $dbname = 'db_commande';
// $username = 'user_achat';
// $password = 'user@achat@';






$con = new mysqli($host, $username, $password, $dbname);


if ($con->connect_error) {
die('Erreur de connexion : ' . $con->connect_error);
}

return $con;
}
?>
