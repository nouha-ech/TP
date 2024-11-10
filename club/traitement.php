<?php
$con = new mysqli("localhost", "root", "Dashboard@2024", "club");
if (!$con) {
    echo "connection failed";
}

$sql = "select * from users where username = '" . $_GET['username'] . "' and pwd = '" . $_GET['pwd'] . "'";
$res = $con->query($sql);
$row = $res->fetch_assoc();

echo "Bonjour " . $row['username'] . " <br> ";


$sql2 = "SELECT A.title  as 'mes activite' from reservations R join activite A on R.id_activite = A.id_activite where username = '" . $_GET['username'] . "'";
$res2 = $con->query($sql2);
#$row2 = $res2->fetch_array();

echo "<table border='1'>";
echo "<tr><th>vos Activités</th></tr>";
while ($row2 = $res2->fetch_array()){
    echo "<tr><td>" . $row2[0] . " </td></tr>";
}
echo "</table> <br>";

$sql3 = "SELECT A.title AS 'mes activite' FROM reservations R JOIN activite A ON R.id_activite = A.id_activite 
         WHERE username = '" . $_GET['username'] . "'";
$res3 = $con->query($sql3);

echo "<table border='1'>";
echo "<tr><th>vos Activités</th></tr>";

while ($row3 = $res3->fetch_array()) {
}

echo "</table>";



?>