<?php

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les seuils du formulaire
    $thresholds_input = $_POST['thresholds'];

    // Initialiser le tableau des seuils
    $thresholds = ['total' => 0];
    foreach ($thresholds_input as $input) {
        $domain = $input['domain'];
        $percentage = (int)$input['percentage'];
        $thresholds[$domain] = ['percentage' => $percentage, 'count' => 0];
    }

    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $sourceFile = $_FILES['file']['tmp_name'];
    } else {
        die("Erreur lors du téléchargement du fichier.");
    }

    // Fonction pour vérifier les contraintes sur l'e-mail
    function isValidEmail($email, $maxDigits, $maxDigitsCount, $maxConsecutiveLetters, $excludedPatterns, &$thresholds) {
        // Vérifier la longueur maximale des chiffres
        if (preg_match('/\d{'.$maxDigits.',}/', $email)) {
            return false;
        }

        // Vérifier si l'e-mail contient plus de $maxDigitsCount chiffres
        if (preg_match_all('/\d/', $email) > $maxDigitsCount) {
            return false;
        }

        // Vérifier la suite maximale de lettres consécutives
        if (preg_match('/[a-zA-Z]{'.$maxConsecutiveLetters.',}/', $email)) {
            return false;
        }

        // Vérifier les suites de caractères à exclure
        foreach ($excludedPatterns as $pattern) {
            if (preg_match('/'.$pattern.'/', $email)) {
                return false;
            }
        }

        // Vérifier les seuils de pourcentage pour les domaines spécifiques
        $domain = substr(strrchr($email, "@"), 1);
        if (isset($thresholds[$domain])) {
            $domainCount = $thresholds[$domain]['count'] ?? 0;
            $totalCount = $thresholds['total'] ?? 0;
            $domainPercentage = $totalCount > 0 ? ($domainCount / $totalCount) * 100 : 0;

            if ($domainPercentage >= $thresholds[$domain]['percentage']) {
                return false;
            }
        }

        return true;
    }

    // Définissons les contraintes comme avant...
    $maxDigits = 4;
    $maxDigitsCount = 5; // Maximum 5 chiffres
    $maxConsecutiveLetters = 15;
    $excludedPatterns = ['123', 'abc'];

    // Ouvrir le fichier CSV source
    if (!file_exists($sourceFile)) {
        die("Le fichier source n'existe pas.");
    }

    // Créer un dossier pour stocker les fichiers de sortie
    $save_path = "/var/www/html/Datamart/extracts-split/";
    $outputDirectory = $save_path .'/output_files';
    if (!is_dir($outputDirectory)) {
        mkdir($outputDirectory, 0777, true);
    }

    // Initialiser le compteur de fichiers traités
    $fileCounter = 0;

    // Lire le fichier source et filtrer les e-mails
    $rowCount = 0;
    $batchSize = 100000;
    $totalEmails = 0;

    if (($handle = fopen($sourceFile, 'r')) !== false) {

        // Ignorer l'en-tête si nécessaire
        fgetcsv($handle);

        // Initialiser le compteur de lot
        $batchCount = 0;

        // Initialiser le fichier de sortie
        $currentOutputFile = $outputDirectory . '/emails_filtered_' . ++$fileCounter . '.csv';
        $csvOutput = fopen($currentOutputFile, 'w');

        // Écrire l'en-tête du fichier de sortie
        fputcsv($csvOutput, ['Email']);

        while (($data = fgetcsv($handle)) !== false) {

            $email = $data[0];

            if (isValidEmail($email, $maxDigits, $maxDigitsCount, $maxConsecutiveLetters, $excludedPatterns, $thresholds)) {
                fputcsv($csvOutput, [$email]);

                $domain = substr(strrchr($email, "@"), 1);
                if (isset($thresholds[$domain])) {
                    $thresholds[$domain]['count']++;
                    $thresholds['total']++;
                }
                $totalEmails++;
            }

            $rowCount++;
            $batchCount++;

            // Si la taille du lot est atteinte, notifier et réinitialiser le compteur de lot
            if ($batchCount === $batchSize) {
                $batchCount = 0;

                // Fermer le fichier de sortie actuel et ouvrir un nouveau fichier pour le prochain lot
                fclose($csvOutput);
                $currentOutputFile = $outputDirectory . '/emails_filtered_' . ++$fileCounter . '.csv';
                $csvOutput = fopen($currentOutputFile, 'w');

                // Écrire l'en-tête du fichier de sortie
                fputcsv($csvOutput, ['Email']);
            }
        }

        // Fermer le dernier fichier de sortie
        fclose($csvOutput);
        fclose($handle);

        // Créer un fichier zip
        //$save_path = "/var/www/html/Datamart/extracts-split/";
        $zipFilename = $outputDirectory . '/filtered_emails.zip';
        $zip = new ZipArchive();
        if ($zip->open($zipFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            die("Impossible de créer le fichier zip.");
        }

        // Ajouter les fichiers CSV dans le zip
        $files = glob($outputDirectory . '/*.csv');
        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }

        // Fermer le zip
        $zip->close();

        // Calculer le pourcentage des autres domaines
        $otherDomainsPercentage = 0;
        foreach ($thresholds as $key => $value) {
            if ($key !== 'total') {
                $otherDomainsPercentage += $value['percentage'];
            }
        }
        $otherDomainsPercentage = 100 - $otherDomainsPercentage;

        // Afficher la page de résultats
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>Résultats du traitement</title>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { width: 80%; margin: 0 auto; }
                .results { margin-top: 20px; }
                .stats-table { width: 100%; border-collapse: collapse; }
                .stats-table th, .stats-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                .stats-table th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Résultats du traitement</h1>
                <p>Le fichier zip <a href='$zipFilename'>$zipFilename</a> a été créé avec succès.</p>
                <div class='results'>
                    <h2>Statistiques de fin de traitement des domaines :</h2>
                    <table class='stats-table'>
                        <thead>
                            <tr>
                                <th>Domaine</th>
                                <th>Pourcentage</th>
                            </tr>
                        </thead>
                        <tbody>";

        foreach ($thresholds as $domain => $stats) {
            if ($domain !== 'total') {
                echo "<tr>
                        <td>$domain</td>
                        <td>{$stats['percentage']}%</td>
                      </tr>";
            }
        }

        echo "          <tr>
                            <td>Autres domaines</td>
                            <td>$otherDomainsPercentage%</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </body>
        </html>";
    }
} else {
    echo "Méthode de requête invalide.";
}
?>
