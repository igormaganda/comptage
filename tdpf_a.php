<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>
<?php
session_start();
// require_once("../../sdatamart/lib/system_load.php");
// //user Authentication.
// authenticate_user('admin');

require_once("partials/class/Bdd.php");

$bdd = new Bdd();

$requete = "INSERT INTO gestion_limittdpf(limite) VALUES ('" . trim($_POST["limit"]) . "')";

if ($bdd->executeSimpleExecRequete($requete)) {
    header('Location: ./tdpf.php?u=ok');
} else {
    header('Location: ./tdpf.php?u=no');
}

//echo $alias;
