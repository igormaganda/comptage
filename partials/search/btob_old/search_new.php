<?php
$odometer = 1;
$map = 1;
require_once("../../../sdatamart/lib/system_load.php");
//user Authentication.
authenticate_user('all');
require("../../header.php");
require("partials/class/Bdd.php");

$bdd = new Bdd();
?>

<?php require_once("../../footer.php"); ?>
