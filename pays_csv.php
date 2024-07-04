<?php
if (isset($_FILES['input_pays'])) {

// Ouvrir le fichier CSV en lecture
    $fichier = fopen($_FILES['input_pays']['tmp_name'], 'r');

    if (!$fichier) {
        echo "Erreur lors de l'ouverture du fichier.";
        exit;
    }

// Définir un tableau pour stocker les noms de pays
    $pays = array();

// Lire la première ligne pour obtenir les en-têtes
    $ligne = fgets($fichier);

// Découper la ligne en champs
    $champs = explode(",", $ligne);

// Rechercher l'index de la colonne des noms de pays
    $index_pay = -1;
    for ($i = 0; $i < count($champs); $i++) {
        if (stripos($champs[$i], "pays") !== FALSE) {
            $index_pay = $i;
            break;
        }
    };
// Si la colonne des noms de pays a été trouvée
    if ($index_pay !== -1) {

        // Parcourir chaque ligne du fichier
        while (($ligne = fgets($fichier)) !== FALSE) {

            // Découper la ligne en champs
            $champs = explode(",", $ligne);

            // Extraire les pays
            $pay = trim($champs[$index_pay]);

            //convertir en majuscule
            //$pay_maj = strtoupper(strtr($pay, "ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ", "AAAAAACEEEEIIIIOOOOOUUUUYAAAAAACEEEEIIIIOOOOOOUUUUYY"));
            //$pay_maj = strtoupper($pay, "ÀÁÂAAAAAACEEEEIIIIOOOOOUUUUYAAAAAACEEEEIIIIOOOOOOUUUUYY");


            // Ajouter le pays au tableau
            //$pays[] = $pay_maj;
            $pays[] = $pay;
        }


        /*
            // Parcourir le fichier par blocs de 1024 lignes
            while (!feof($fichier)) {
                // Lire un bloc de lignes
                $lignes = fread($fichier, 1024);
        
                // Découper chaque ligne en champs
                foreach (explode("\n", $lignes) as $ligne) {
                    $champs = explode(",", $ligne);
        
                    // Extraire le nom de la pay
                    $pay = trim($champs[$index_pay]);
        
                    // Convertir la pay en majuscules sans accents
                    $pay_maj = strtoupper(strtr($pay, "ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ", "AAAAAACEEEEIIIIOOOOOUUUUYAAAAAACEEEEIIIIOOOOOOUUUUYY"));
        
                    // Ajouter la pay au tableau
                    $pays[] = $pay_maj;
                }
            }*/

    }
// Fermer le fichier
    fclose($fichier);

// Afficher les noms de pays
    echo json_encode($pays);
}
?>

