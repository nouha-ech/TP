<?php
//connexion à la base de données
$conn = mysqli_connect("localhost", "root", "Dashboard@2024", "pwd_generator");
if (!$conn) {
    echo "Vous n'êtes pas connecté à la base de donnée";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $generatedPassword = $_POST['generatedPassword'];

    // insertion
    $sql = "INSERT INTO users (mdp) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $generatedPassword);

    if ($stmt->execute()) {
        echo "GONRATS YAYYY!<br>";
        echo "Generated Password: " . htmlspecialchars($generatedPassword);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>