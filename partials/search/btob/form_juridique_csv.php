<?php

if (isset($_FILES['input_form_juridique'])) {


// Ouvrir le fichier CSV en lecture
$fichier = fopen($_FILES['input_form_juridique']['tmp_name'], 'r');

// Définir un tableau pour stocker les formes juridiques
$forms_juridiques = array();

// Lire la première ligne pour obtenir les en-têtes
$ligne = fgets($fichier);

// Découper la ligne en champs
$champs = explode(",", $ligne);

// Rechercher l'index de la colonne des fj
$index_form_juridique = -1;
for ($i = 0; $i < count($champs); $i++) {
    if (stripos($champs[$i], "fj") !== FALSE) {
        $index_form_juridique = $i;
        break;
    }
}


// Si la colonne des formes juridiques a été trouvée
if ($index_form_juridique !== -1) {

    // Parcourir chaque ligne du fichier
    while (($ligne = fgets($fichier)) !== FALSE) {

        // Découper la ligne en champs
        $champs = explode(",", $ligne);

        // Extraire la forme juridique
        $form_juridique = trim($champs[$index_form_juridique]);

        // Ajouter la forme juridique au tableau
        $forms_juridiques[] = $form_juridique;
    }
}

// Fermer le fichier
fclose($fichier);

// Afficher les formes juriqiques
echo json_encode($forms_juridiques);

}
