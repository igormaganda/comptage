<?php

if (isset($_FILES['input_naf'])) {


// Ouvrir le fichier CSV en lecture
$fichier = fopen($_FILES['input_naf']['tmp_name'], 'r');

// Définir un tableau pour stocker les Naf
$nafs = array();

// Lire la première ligne pour obtenir les en-têtes
$ligne = fgets($fichier);

// Découper la ligne en champs
$champs = explode(",", $ligne);

// Rechercher l'index de la colonne des Nafs
$index_naf = -1;
for ($i = 0; $i < count($champs); $i++) {
    if (stripos($champs[$i], "naf") !== FALSE) {
        $index_naf = $i;
        break;
    }
}


// Si la colonne des Naf a été trouvée
if ($index_naf !== -1) {

    // Parcourir chaque ligne du fichier
    while (($ligne = fgets($fichier)) !== FALSE) {

        // Découper la ligne en champs
        $champs = explode(",", $ligne);

        // Extraire le naf
        $naf = trim($champs[$index_naf]);

        // Ajouter le Naf au tableau
        $nafs[] = $naf;
    }
}

// Fermer le fichier
fclose($fichier);

// Afficher les Nafs
echo json_encode($nafs);

}
