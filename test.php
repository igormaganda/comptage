<?php
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
        'fullname' => randomString(10),
        'firstname' => randomString(8),
        'lastname' => randomString(8),
        'gender' => rand(0, 1) ? 'Male' : 'Female',
        'currentposition' => randomString(15),
        'address' => randomString(20),
        'zip' => randomString(5),
        'city' => randomString(10),
        'country' => $countries[array_rand($countries)],
        'personalemail' => randomString(5) . '@azzertu.com',
        'emailpro' => randomString(5) . '@gmail.com',
        'companytel' => '1234567890',
        'personetel' => '0987654321',
        'companymobile' => '1122334455',
        'mobilepro' => $telMobile,
        'fixecompany' => '1234509876',
        'fixepersonel' => '6789012345',
        'companyname' => randomString(10),
        'type' => randomString(5),
        'headq' => randomString(10),
        'profileregion' => randomString(10),
        'comp_location' => randomString(10),
        'comp_address' => randomString(20),
        'comp_zip' => randomString(5),
        'comp_city' => randomString(10),
        'comp_country' => randomString(10),
        'siege' => randomString(10),
        'forme' => randomString(10),
        'capital' => randomString(10),
        'category' => randomString(10),
        'activity' => randomString(10),
        'chiffre_affaires' => randomString(10),
        'effectif' => rand(1, 1000),
        'date_creation' => date('Y-m-d', rand(strtotime('2000-01-01'), strtotime('2023-12-31'))),
        'siren' => randomString(9),
        'siret' => randomString(14),
        'numbertva' => randomString(13),
        'naf' => randomString(5),
        'fax' => randomString(10),
        'domain' => randomString(10),
        'website' => 'http://' . randomString(8) . '.com',
        'groupe_domaine' => randomString(10),
        'longitude' => rand(-1800000, 1800000) / 10000.0,
        'latitude' => rand(-900000, 900000) / 10000.0,
        'nif' => randomString(10)
    ];
}

// Prepare the SQL insert statement
$sql = "INSERT INTO public.b2b (
    fullname, firstname, lastname, gender, currentposition, address, zip, city, country, personalemail,
    emailpro, companytel, personetel, companymobile, mobilepro, fixecompany, fixepersonel, companyname,
    type, headq, profileregion, comp_location, comp_address, comp_zip, comp_city, comp_country, siege, forme,
    capital, category, activity, chiffre_affaires, effectif, date_creation, siren, siret, numbertva, naf, fax,
    domain, website, groupe_domaine, longitude, latitude, nif
) VALUES (
    :fullname, :firstname, :lastname, :gender, :currentposition, :address, :zip, :city, :country, :personalemail,
    :emailpro, :companytel, :personetel, :companymobile, :mobilepro, :fixecompany, :fixepersonel, :companyname,
    :type, :headq, :profileregion, :comp_location, :comp_address, :comp_zip, :comp_city, :comp_country, :siege, :forme,
    :capital, :category, :activity, :chiffre_affaires, :effectif, :date_creation, :siren, :siret, :numbertva, :naf, :fax,
    :domain, :website, :groupe_domaine, :longitude, :latitude, :nif
)";

$stmt = $pdo->prepare($sql);

// Insert random data into the table
for ($i = 0; $i < 100000; $i++) { // Change 10 to however many records you want to insert
    $randomData = generateRandomData();
    $stmt->execute($randomData);
}

echo "Random data inserted successfully!";
