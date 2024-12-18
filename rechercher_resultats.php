<?php
include('../config/db.php');
session_start();

// Variables pour la pagination
$limit = 10; // Nombre de résultats par page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;


$id_etudiant = isset($_POST['id_etudiant']) ? $_POST['id_etudiant'] : '';
$id_devoir = isset($_POST['id_devoir']) ? $_POST['id_devoir'] : '';


$query_count = "SELECT COUNT(*) FROM resultat r 
JOIN utilisateurs u ON r.id_etudiant = u.id
JOIN devoirs d ON r.id_devoir = d.id 
WHERE ('$id_etudiant' = '' OR r.id_etudiant = '$id_etudiant')
AND ('$id_devoir' = '' OR r.id_devoir = '$id_devoir')";
$count_result = $con->query($query_count);
$total_results = $count_result->fetch_row()[0];
$total_pages = ceil($total_results / $limit);

// Requête pour récupérer les résultats paginés
$query = "SELECT r.id_resultat, u.nom AS etudiant, d.titre AS devoir, r.note FROM resultat r
JOIN utilisateurs u ON r.id_etudiant = u.id 
JOIN devoirs d ON r.id_devoir = d.id
WHERE ('$id_etudiant' = '' OR r.id_etudiant = '$id_etudiant')
AND ('$id_devoir' = '' OR r.id_devoir = '$id_devoir') 
LIMIT $limit OFFSET $offset";
$resultats = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats des Devoirs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans text-gray-900">
    <div class="min-h-screen flex flex-col items-center justify-center py-10">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
            <h2 class="text-3xl font-bold text-center text-purple-600 mb-6">Rechercher les Résultats</h2>

            <!-- Formulaire de recherche -->
            <form method="POST" action="rechercher_resultats.php" class="mb-8">
                <div class="flex justify-between gap-4">
                    <!-- Sélectionner l'étudiant -->
                    <div class="flex-1">
                        <label class="block text-gray-700 font-medium mb-2">Étudiant :</label>
                        <select name="id_etudiant" class="w-full p-2 border rounded">
                            <option value="">Tous</option>
                            <?php
                            $query_etudiants = "SELECT id, nom FROM utilisateurs";
                            $result = $con->query($query_etudiants);
                            while ($row = $result->fetch_assoc()) {
                                $selected = ($row['id'] == $id_etudiant) ? 'selected' : '';
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['nom'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Sélectionner le devoir -->
                    <div class="flex-1">
                        <label class="block text-gray-700 font-medium mb-2">Devoir :</label>
                        <select name="id_devoir" class="w-full p-2 border rounded">
                            <option value="">Tous</option>
                            <?php
                            $query_devoirs = "SELECT id, titre FROM devoirs";
                            $result = $con->query($query_devoirs);
                            while ($row = $result->fetch_assoc()) {
                                $selected = ($row['id'] == $id_devoir) ? 'selected' : '';
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['titre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Bouton rechercher -->
                <div class="text-center mt-4">
                    <input type="submit" value="Rechercher" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                </div>
            </form>

            <!-- Table des résultats -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Résultats :</h2>
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-purple-100">
                        <th class="border border-gray-300 px-4 py-2">Étudiant</th>
                        <th class="border border-gray-300 px-4 py-2">Devoir</th>
                        <th class="border border-gray-300 px-4 py-2">Note</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultats->num_rows > 0) {
                        while ($resultat = $resultats->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='border border-gray-300 px-4 py-2'>" . $resultat['etudiant'] . "</td>";
                            echo "<td class='border border-gray-300 px-4 py-2'>" . $resultat['devoir'] . "</td>";
                            echo "<td class='border border-gray-300 px-4 py-2'>" . $resultat['note'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='text-center border border-gray-300 px-4 py-2 text-gray-500'>Aucun résultat trouvé.</td></tr>";
                    } ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-6 text-center">
                <p class="text-gray-700 mb-4">Page <?= $page ?> sur <?= $total_pages ?></p>
                <div class="flex justify-center space-x-4">
                    <a href="rechercher_resultats.php?page=1" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Première page</a>
                    <a href="rechercher_resultats.php?page=<?= ($page > 1) ? $page - 1 : 1 ?>" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Précédente</a>
                    <a href="rechercher_resultats.php?page=<?= ($page < $total_pages) ? $page + 1 : $total_pages ?>" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Suivante</a>
                    <a href="rechercher_resultats.php?page=<?= $total_pages ?>" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Dernière page</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php session_start();
if (isset($_SESSION['message'])) {
    echo "<div class='alert'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}
if (empty($resultats)) {
    $_SESSION['message'] = "Aucun résultat trouvé.";
    header("Location: rechercher_resultats.php");
} ?>