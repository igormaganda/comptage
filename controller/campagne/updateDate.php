<?php
	$date     = $_REQUEST["date"];
	$campagne = substr($_REQUEST["campagne"], 1);

	require_once("partials/class/Bdd.php");
	$bdd = new Bdd();

	$requete = "UPDATE campagne SET envoi='$date' WHERE id=$campagne";
	if($bdd->executeSimpleExecRequete($requete)) echo "ok";
?>