<?php
// Configurer l'API Key pour OpenAI
$apiKey = 'sk-proj-o5bzy0VrrUlXcMewjGjtT3BlbkFJxby3dGMMtfv51VMLfRBa';

// Lire les emails à partir du fichier texte
$emails = file('email.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Créer la requête JSON pour l'API
$data = [
    "model" => "gpt-4",
    "messages" => [
        [
            "role" => "system",
            "content" => "Tu es un assistant qui détermine la civilité et le pourcentage de confiance basés sur des adresses email."
        ],
        [
            "role" => "user",
            "content" => "Sous forme de tableau, détermine la civilité des personnes en te basant sur leur email et le % de confiance que tu accordes à la civilité. Voici la liste des emails : " . implode(", ", $emails)
        ]
    ]
];

// Initialiser cURL
$ch = curl_init('https://api.openai.com/v1/chat/completions');

// Configurer les options cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey,
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Exécuter la requête et obtenir la réponse
$response = curl_exec($ch);

// Vérifier les erreurs de cURL
if (curl_errno($ch)) {
    echo 'Erreur cURL : ' . curl_error($ch);
    exit;
}

// Fermer cURL
curl_close($ch);

// Décoder la réponse JSON
$responseData = json_decode($response, true);

// Extraire le contenu de la réponse
if (isset($responseData['choices'][0]['message']['content'])) {
    $output = $responseData['choices'][0]['message']['content'];
} else {
    echo "Erreur dans la réponse de l'API :\n";
    print_r($responseData);
    exit;
}

// Analyser le contenu de la réponse pour créer le tableau CSV
// Supposons que la réponse de l'API est une chaîne de texte structurée en lignes de tableau
$rows = explode("\n", $output);
$csvData = [];
foreach ($rows as $row) {
    // Nettoyer et diviser les lignes en colonnes
    $csvData[] = str_getcsv($row, "|");
}

// Générer le fichier CSV
$csvFile = 'output.csv';
$fp = fopen($csvFile, 'w');

foreach ($csvData as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);

echo "Le fichier CSV a été généré avec succès : $csvFile\n";
?>