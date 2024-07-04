<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>
<?php
session_start();
// require_once("../../sdatamart/lib/system_load.php");
//user Authentication.
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

if ($_POST["new_edit"] == 0) {
    $requete = "INSERT INTO gestion_routes(";

    $tab_name = $tab_values = array();
    foreach ($_POST as $index => $valeur) {
        $tab_name[] = $index;
        $tab_values[] = str_replace("'", "''", utf8_decode(trim($valeur)));
    }

    $tab_name = array_slice($tab_name, 1);
    $tab_values = array_slice($tab_values, 1);

    $requete .= implode(", ", $tab_name) . ") VALUES ('";
    echo $requete .= implode("', '", $tab_values) . "')";
} else {
    $requete = "UPDATE gestion_routes SET ";

    foreach ($_POST as $index => $valeur) {
        if ($index != "new_edit") {
            $requete .= $index . "='" . str_replace("'", "''", utf8_decode(trim($valeur))) . "', ";
        }
    }

    $requete = substr($requete, 0, -2);
    echo $requete .= " WHERE id=" . $_POST["new_edit"];
}


if ($bdd->executeSimpleExecRequete($requete)) {
    header('Location: ./routes.php?u=ok');
} else {
    header('Location: ./routes.php?u=no');
}
