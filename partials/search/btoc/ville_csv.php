<?php

if (isset($_FILES['input_villes'])) {


// Ouvrir le fichier CSV en lecture
$fichier = fopen($_FILES['input_villes']['tmp_name'], 'r');

// Définir un tableau pour stocker les villes
$villes = array();

// Lire la première ligne pour obtenir les en-têtes
$ligne = fgets($fichier);

// Découper la ligne en champs
$champs = explode(",", $ligne);

// Rechercher l'index de la colonne des villes
$index_ville = -1;
for ($i = 0; $i < count($champs); $i++) {
    if (stripos($champs[$i], "villes") !== FALSE) {
        $index_ville = $i;
        break;
    }
}
// Si la colonne des villes a été trouvée
if ($index_ville !== -1) {

    // Parcourir chaque ligne du fichier
    while (($ligne = fgets($fichier)) !== FALSE) {

        // Découper la ligne en champs
        $champs = explode(",", $ligne);

        // Extraire la ville
        $ville = trim($champs[$index_ville]);

        // Ajouter la ville au tableau
        $villes[] = $ville;
    }
}

// Fermer le fichier
fclose($fichier);

// Afficher les villes
echo json_encode($villes);

}
?>