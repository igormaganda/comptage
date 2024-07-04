<?php
require("partials/class/Bdd.php");
$bdd = new Bdd();
$pdo = $bdd->connect();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// $sql="CREATE TABLE chiff_aff (
//     id_camp INT,
//     vol_camp INT,
//     gain FLOAT,
//     date_ca DATE,
//     type_b2 VARCHAR(3)
// )";
// $pdo->exec( $sql );

// $nb_rows = 1000; 
// for ($i = 0; $i < $nb_rows; $i++) {
//     $id_camp = rand(1, 100); 
//     $vol_camp = rand(100, 1000); 
//     $gain = rand(100, 10000) / 100; 
//     $date = date('Y-m-d', strtotime("-$i days")); 
//     $type = ($i % 2 == 0) ? 'b2b' : 'b2c'; 
    
//     $pdo->exec("INSERT INTO chiff_aff (id_camp, vol_camp, gain, date_ca, type_b2) VALUES ($id_camp, $vol_camp, $gain, '$date', '$type')");
//     echo $gain;
// }
// echo "Données insérées avec succès.";

$req_ca_b2c = "SELECT 
EXTRACT(MONTH FROM date_ca) AS mois, 
SUM(vol_camp * gain) AS somme_multiplications 
FROM chiff_aff WHERE type_b2 = 'b2c' 
GROUP BY EXTRACT(MONTH FROM date_ca) 
ORDER BY mois ;";
//remettre une condition
$query_ca_b2c = $pdo->query($req_ca_b2c);
$result_b2c = $query_ca_b2c->fetchAll(PDO::FETCH_ASSOC);
$sommes_b2c = [];
foreach ($result_b2c as $somme) {
    $sommes_b2c[] = intval($somme['somme_multiplications']);
}

// Affichage du tableau
echo "<pre>";
print_r($sommes_b2c);
echo json_encode($sommes_b2c);
echo "</pre>";
?>