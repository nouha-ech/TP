<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $sexe = $_POST['sexe'];
    $classe = $_POST['classe'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $tel_pere = $_POST['tel_pere'];
    $tel_mere = $_POST['tel_mere'];
    $cin = $_POST['cin'];
    $massar = $_POST['massar'];

    $filename = 'inscriptions.csv';
    $file = fopen($filename, 'a');

    if ($file) {
        fputcsv($file, [
            $nom,
            $prenom,
            $date_naissance,
            $sexe,
            $classe,
            $email,
            $tel,
            $tel_pere,
            $tel_mere,
            $cin,
            $massar
        ]);
        fclose($file);
    }

    header('Location: confirmation.php');
    exit();
} else {
    echo "<h2>Erreur: données non envoyées</h2>";
}
?>
