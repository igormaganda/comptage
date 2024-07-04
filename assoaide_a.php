<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>
<?php
session_start();
// require_once("../../sdatamart/lib/system_load.php");
// //user Authentication.
// authenticate_user('admin');

// vérifie s'il y a une URL précédente stockée
if (isset($_SESSION['current_url'])) {
    $previous_url = $_SESSION['current_url'];
    unset($_SESSION['current_url']); // Supprime l'URL stockée
    header("Location: $previous_url");
    exit();
} else {
    // Redirige l'utilisateur vers la page d'accueil par défaut
    header("Location: ../../index.php");
    exit();
}
require_once("partials/class/Bdd.php");

$bdd = new Bdd();

function isInArray()
{
    global $bdd;
    $tabKey = array();
    $requete = "SELECT key FROM gestion_partenaire_assoaide";
    $result = $bdd->executeQueryRequete($requete, 1);
    while ($keys = $result->fetch()) {
        $tabKey[] = $keys->key;
    }

    $id = rand(10000, 99999);

    if (in_array($id, $tabKey)) {
        isInArray();
    } else {
        return $id;
    }
}

$id = isInArray();


$nom = utf8_decode(trim($_POST["prog_part"]));
$nom = str_replace("'", "''", $nom);

$requete = "INSERT INTO gestion_partenaire_assoaide(nom, key) VALUES ('" . $nom . "', '" . $id . "')";


if ($bdd->executeSimpleExecRequete($requete)) {
    header('Location: ./assoaide.php?u=ok');
} else {
    header('Location: ./assoaide.php?u=no');
}
