<?php
require("connecter.php");
$conn = connecter();

$dateCmd = date('Y-m-d');
$numCl = $_POST['numCl'];
$numCmd = $_POST['numCmd'];


$sql = "INSERT INTO commande (numCmd, dateCmd, num, etat, dateValidation)
        VALUES ('$numCmd', '$dateCmd', '$numCl', 'en cours', NULL)";

if ($conn->query($sql) === TRUE) {
    if (isset($_POST['cb'])) {
        foreach ($_POST['cb'] as $valeur) {
          
            $qte = isset($_POST['quantity'][$valeur]) ? $_POST['quantity'][$valeur] : 0;
            
            if ($qte > 0) {
             
                $sql = "INSERT INTO ligneCmd (numCmd, code, Qte)
                        VALUES ('$numCmd', '$valeur', '$qte')";
                
                if (!$conn->query($sql)) {
                    echo "Erreur lors de l'ajout de la ligne commande: " . mysqli_error($conn);
                    exit;
                }
            }
        }
        echo "<script type='text/javascript'>
                alert('Commande ajoutée avec succès');
                window.location.href = 'passerCmd.php';  
              </script>";
    } else {
        echo "Aucun article sélectionné.";
    }
} else {
    echo "Erreur lors de l'ajout de la commande: " . $conn->error;
}
?>

