<?php 
require("connecter.php");
$conn = connecter();
$sql = "SELECT code, libelle, prix FROM article";
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['code'] . "</td>";
        echo "<td>" . $row['libelle'] . "</td>";
        echo "<td>" . $row['prix'] . "</td>";
        echo "<td><input type='number' name='quantity[" . $row['code'] . "]' value='1' min='1'></td>";  // Ensure unique name for quantity
        echo "<td><input type='checkbox' name='cb[]' value='" . $row['code'] . "'></td>";
        echo "</tr>";
    }
} else {
    echo "Erreur de la requête: " . $conn->error;
}
?>
