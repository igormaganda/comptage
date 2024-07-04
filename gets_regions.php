<?php
require("partials/class/Bdd.php");

// Récupérer les pays sélectionnés envoyés par la requête AJAX
$data = json_decode(file_get_contents('php://input'), true);
$countries = $data['countries'];
echo $countries;
exit;
// Utilisez ces pays pour récupérer les régions correspondantes dans la base de données
// Exemple de requête SQL à adapter à votre structure de base de données

$bdd = new Bdd();
$bd = $bdd->connect();
$regions = [];

foreach ($countries as $countryCode) {
    $stmt = $bd->prepare("SELECT region_name FROM region_departement_france WHERE country_code = :country_code");
    $stmt->bindParam(':country_code', $countryCode);
    $stmt->execute();
    $regionsForCountry = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $regions = array_merge($regions, $regionsForCountry);
}

// Renvoyer les régions au format JSON
echo json_encode(['regions' => $regions]);
?>
