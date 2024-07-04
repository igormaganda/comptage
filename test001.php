<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Database connection details
require("partials/class/Bdd.php");
$bdd = new Bdd();
$pdo = $bdd->connect();

// Function to generate random strings
function randomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$usedMobileNumbers = [];

// Function to generate random data
function generateRandomData()
{
    $countries = ['France', 'Canada', 'Belgique', 'Allemagne', 'Luxembourg', 'Suisse', 'USA', 'Espagne', 'Angleterre', 'Brésil', 'Chine', 'Inde', 'Russie', 'Pays-Bas', 'Hongrie', 'Danemark'];
    $genders = ['Male', 'Female'];
    $statuses = ['A', 'I'];
    $date = date('Y-m-d', mt_rand(strtotime('1960-01-01'), strtotime('2005-12-31')));
    $yearOfBirth = (int)date('Y', strtotime($date));
    $usedMobileNumbers = [];
    do {
        $telMobile = '0'; // Format standard de début de numéro de téléphone mobile
        for ($i = 0; $i < 9; $i++) {
            $telMobile .= rand(0, 9); // Génère les 9 chiffres restants
        }
    } while (in_array($telMobile, $usedMobileNumbers)); // Vérifie si le numéro est déjà utilisé

    // Ajouter le numéro de téléphone mobile à la liste des numéros utilisés
    $usedMobileNumbers[] = $telMobile;

    return [
        'id_import' => rand(1, 1000),
        'email' => randomString(5) . '@gmail.com',
        'email_md5' => md5(randomString(5) . '@yahoo.fr'),
        'domain' => randomString(10) . '.com',
        'groupe_domaine' => randomString(10),
        'firstname' => randomString(8),
        'lastname' => randomString(8),
        'dateofbirth' => $date,
        'yearofbirth' => $yearOfBirth,
        'agegroupe' => '18-25',  // Example age group, modify as needed
        'adresse_1' => randomString(20),
        'adresse_2' => randomString(20),
        'pays' => $countries[array_rand($countries)],
        'cp' => randomString(5),
        'ville' => randomString(10),
        'region' => randomString(10),
        'gender' => $genders[array_rand($genders)],
        'title' => randomString(5),
        'fonction' => randomString(10),
        'csp' => randomString(10),
        'parent' => randomString(5),
        'proprietaire' => randomString(5),
        'animaux' => randomString(5),
        'tel_mobile' => $telMobile,
        'tel_fixe' => '0987654321',
        'tel_fax' => '1122334455',
        'date_in' => date('Y-m-d H:i:s'),
        'last_date_r' => date('Y-m-d H:i:s'),
        'last_date_o' => date('Y-m-d H:i:s'),
        'last_date_c' => date('Y-m-d H:i:s'),
        'last_date_s' => date('Y-m-d H:i:s'),
        'blacklist' => rand(0, 1) ? 'false' : 'true',
        'statut' => $statuses[array_rand($statuses)],
        'dep' => randomString(2),
        'tranche' => randomString(10),
        'nettoyage_date' => date('Y-m-d H:i:s'),
        'nettoyage_result' => randomString(10),
        'troncon' => rand(1, 100)
    ];
}

try {
    // Prepare the SQL insert statement
    $sql = "INSERT INTO public.b2c (
        id_import, email, email_md5, domain, groupe_domaine, firstname, lastname, dateofbirth, yearofbirth, agegroupe,
        adresse_1, adresse_2, pays, cp, ville, region, gender, title, fonction, csp, parent, proprietaire, animaux,
        tel_mobile, tel_fixe, tel_fax, date_in, last_date_r, last_date_o, last_date_c, last_date_s, blacklist, statut, dep,
        tranche, nettoyage_date, nettoyage_result, troncon
    ) VALUES (
        :id_import, :email, :email_md5, :domain, :groupe_domaine, :firstname, :lastname, :dateofbirth, :yearofbirth, :agegroupe,
        :adresse_1, :adresse_2, :pays, :cp, :ville, :region, :gender, :title, :fonction, :csp, :parent, :proprietaire, :animaux,
        :tel_mobile, :tel_fixe, :tel_fax, :date_in, :last_date_r, :last_date_o, :last_date_c, :last_date_s, :blacklist, :statut, :dep,
        :tranche, :nettoyage_date, :nettoyage_result, :troncon
    )";

    $stmt = $pdo->prepare($sql);

    // Insert random data into the table
    for ($i = 0; $i < 1000000; $i++) { // Change 200 to however many records you want to insert
        $randomData = generateRandomData();
        $stmt->execute($randomData);
    }
    echo "Random data inserted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
