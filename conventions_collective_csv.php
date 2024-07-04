<?php

if (isset($_FILES['input_conv_collec'])) {

    // Ouvrir le fichier CSV en lecture
    $fichier = fopen($_FILES['input_conv_collec']['tmp_name'], 'r');

    // Définir un tableau pour stocker les fonctions
    $fonctions = array();

    // Lire la première ligne pour obtenir les en-têtes
    $champs = fgetcsv($fichier);

    // Rechercher l'index de la colonne des fonctions
    $index_fonctions = -1;
    for ($i = 0; $i < count($champs); $i++) {
        if (stripos($champs[$i], "cc") !== FALSE) {
            $index_fonctions = $i;
            break;
        }
    }

    // Si la colonne des fonctions a été trouvée
    if ($index_fonctions !== -1) {

        // Parcourir chaque ligne du fichier
        while (($champs = fgetcsv($fichier)) !== FALSE) {

            // Extraire les fonctions et supprimer les apostrophes
            $fonction = str_replace("'", "", trim($champs[$index_fonctions]));

            // Ajouter les fonctions au tableau
            $fonctions[] = $fonction;
        }
    }

    // Fermer le fichier
    fclose($fichier);

    // Afficher les fonctions
    echo json_encode($fonctions);
}
?>
