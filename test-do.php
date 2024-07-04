<?php
function isValidEmail($email, $maxDigits, $maxConsecutiveLetters, $excludedPatterns, $thresholds) {
    if (preg_match('/\d{'.$maxDigits.',}/', $email)) {
        return false;
    }

    /* if (preg_match_all('/\d/', $email) > $maxDigitsCount) {
         return false;
     }*/

    if (preg_match('/[a-zA-Z]{'.$maxConsecutiveLetters.',}/', $email)) {
        return false;
    }

    foreach ($excludedPatterns as $pattern) {
        if (preg_match('/'.$pattern.'/', $email)) {
            return false;
        }
    }

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

$maxDigits = $_POST['maxDigits'] ? $_POST['maxDigits'] : 4;
//$maxDigitsCount = $_POST['maxDigitsCount'] ?? 5;
$maxConsecutiveLetters = $_POST['maxConsecutiveLetters'] ? $_POST['maxConsecutiveLetters'] : 10;
$excludedPatterns = explode(',', $_POST['excludedPatterns'] );
$batchSize = $_POST['batchSize'];

/*$thresholds = [];
foreach ($_POST['thresholds'] as $domain => $percentage) {
    $thresholds[$domain] = ['percentage' => $percentage, 'count' => 0];
}*/

$thresholds = [];
foreach ($_POST['thresholds'] as $key => $threshold) {
    $domain = $threshold['domain'];
    $percentage = $threshold['percentage'];
    $thresholds[$domain] = ['percentage' => $percentage, 'count' => 0];
}

$thresholds['total'] = 0;

if ($_FILES['file']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['file']['tmp_name'])) {
    $sourceFile = $_FILES['file']['tmp_name'];
} else {
    die("Erreur lors du téléchargement du fichier.\n");
}

$min_path  = "/var/www/html/Datamart";
$save_path = "/var/www/html/Datamart/extracts-split/".date("Ymd-his");
$down_path = "/Datamart/extracts-split/".date("Ymd-his");

$outputDirectory = $save_path . '/output_files';
if (!is_dir($outputDirectory)) {
    mkdir($outputDirectory, 0777, true);
}

$fileCounter = 0;
$rowCount = 0;
$totalEmails = 0;

if (($handle = fopen($sourceFile, 'r')) !== false) {
    fgetcsv($handle);

    $batchCount = 0;
    $currentOutputFile = $outputDirectory . '/emails_filtered_' . ++$fileCounter . '.csv';
    $csvOutput = fopen($currentOutputFile, 'w');
    fputcsv($csvOutput, ['Email']);

    while (($data = fgetcsv($handle)) !== false) {
        $email = $data[0];

        if (isValidEmail($email, $maxDigits, $maxConsecutiveLetters, $excludedPatterns, $thresholds)) {
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

        if ($batchCount === $batchSize) {
            $batchCount = 0;

            fclose($csvOutput);
            $currentOutputFile = $outputDirectory . '/emails_filtered_' . ++$fileCounter . '.csv';
            $csvOutput = fopen($currentOutputFile, 'w');
            fputcsv($csvOutput, ['Email']);
            // Vérifier si le nombre d'e-mails dans le fichier actuel est inférieur à $batchSize
            if ($totalEmails < $batchSize) {
                // Lire les e-mails restants du fichier source pour atteindre le nombre minimum de lignes
                $remainingEmails = $batchSize - $totalEmails;
                for ($i = 0; $i < $remainingEmails; $i++) {
                    if (($data = fgetcsv($handle)) !== false) {
                        $email = $data[0];
                        if (isValidEmail($email, $maxDigits, $maxConsecutiveLetters, $excludedPatterns, $thresholds)) {
                            fputcsv($csvOutput, [$email]);
                            $totalEmails++;
                        }
                    }
                }
            }
        }
    }

    fclose($csvOutput);
    fclose($handle);
}

/*$zip = new ZipArchive();
$zipFileName = $outputDirectory . '.zip';

if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($outputDirectory),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        if (!$file->isDir()) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($outputDirectory) + 1);
            $zip->addFile($filePath, $relativePath);
        }
    }

    $zip->close();
} else {
    echo "Impossible de créer le fichier ZIP.\n";
}*/

$otherDomainsPercentage = 0;
foreach ($thresholds as $key => $value) {
    if ($key !== 'total') {
        $otherDomainsPercentage += $value['percentage'];
    }
}
$otherDomainsPercentage = 100 - $otherDomainsPercentage;


// Afficher les statistiques de fin de traitement des domaines
echo "\n\n\033[1;34mStatistiques de fin de traitement des domaines :\n\033[0m";
echo "\033[0;33m+------------------+-------------+\n";
echo "| \033[0;36mDomaine\033[0;33m           | \033[0;36mPourcentage\033[0;33m |\n";
echo "\033[0;33m+------------------+-------------+\n";
foreach ($thresholds as $domain => $stats) {
    if ($domain !== 'total') {
        echo "| " . str_pad($domain, 16) . " | " . str_pad($stats['percentage'] . "%", 11) . " |\n";
    }
}
echo "| " . str_pad("Autres domaines", 16) . " | " . str_pad($otherDomainsPercentage . "%", 11) . " |\n";
echo "\033[0;33m+------------------+-------------+\n\033[0m";
?>


        
