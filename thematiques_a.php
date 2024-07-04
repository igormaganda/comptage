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
require_once("partials/class/Calc.php");

$bdd = new Bdd();
$tools = new Calc();

$alias = $tools->removeSpecialChars(trim($_POST["cat_name"]));
$alias = preg_replace("# {1,}#", "-", strtolower($alias));

$nom = utf8_decode(trim($_POST["cat_name"]));
$nom = str_replace("'", "''", $nom);

$requete = "INSERT INTO gestion_thematique(nom, alias) VALUES ('" . $nom . "', '" . $alias . "')";

if ($bdd->executeSimpleExecRequete($requete)) {
    header('Location: ./thematiques.php?u=ok');
} else {
    header('Location: ./thematiques.php?u=no');
}
