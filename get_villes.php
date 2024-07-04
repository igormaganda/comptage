<?php
// Vérifier si un pays a été sélectionné
if(isset($_POST['top_pays']) && is_array($_POST['top_pays'])) {
    // Échapper les valeurs des pays pour éviter les injections SQL
    $selectedCountries = $_POST['top_pays'];

    // Si un seul pays est sélectionné, utiliser un paramètre de requête unique
    $sql = "SELECT DISTINCT city_name FROM gestion_pays WHERE country_name = ?";

    // Initialiser la chaîne de résultats
    //$options = "<option value=''>Sélectionnez une région</option>";

    // Connexion à la base de données (à remplacer par vos propres informations de connexion)
    $servername = "localhost";
    $username = "postgres";
    $password = "P057G435";
    $dbname = "datamart3";

    try {
        // Connexion à la base de données avec PDO
        $pdo = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
        // Définir le mode d'erreur PDO à exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête SQL
        $stmt = $pdo->prepare($sql);

        // Exécuter la requête pour chaque pays sélectionné
        foreach($selectedCountries as $country) {
            $stmt->execute([$country]);

            // Récupérer les résultats de la requête
            $regions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Ajouter chaque région à la chaîne de résultats
            foreach($regions as $row) {
                $options .= "<option value='" . $row['city_name'] . "'>" . $row['city_name'] . "</option>";
            }
        }

        // Renvoyer les options du select
        echo $options;
    } catch(PDOException $e) {
        // En cas d'erreur PDO, afficher l'erreur
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Si aucun pays n'est sélectionné, renvoyer une option vide
    echo "<option value=''>Aucune ville sélectionnée</option>";
}
?>



