<?php

if (isset($_FILES['inputfile'])) {


// Ouvrir le fichier CSV en lecture
$fichier = fopen($_FILES['inputfile']['tmp_name'], 'r');

// Définir un tableau pour stocker les codes postaux
$codes_postaux = array();

// Lire la première ligne pour obtenir les en-têtes
$ligne = fgets($fichier);

// Découper la ligne en champs
$champs = explode(",", $ligne);

// Rechercher l'index de la colonne des codes postaux
$index_code_postal = -1;
for ($i = 0; $i < count($champs); $i++) {
    if (stripos($champs[$i], "cp") !== FALSE) {
        $index_code_postal = $i;
        break;
    }
}


// Si la colonne des codes postaux a été trouvée
if ($index_code_postal !== -1) {

    // Parcourir chaque ligne du fichier
    while (($ligne = fgets($fichier)) !== FALSE) {

        // Découper la ligne en champs
        $champs = explode(",", $ligne);

        // Extraire le code postal
        $code_postal = trim($champs[$index_code_postal]);

        // Ajouter le code postal au tableau
        $codes_postaux[] = $code_postal;
    }
}

// Fermer le fichier
fclose($fichier);

// Afficher les codes postaux
echo json_encode($codes_postaux);

}
