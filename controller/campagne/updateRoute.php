<?php
	$route    = $_REQUEST["route"];
	$campagne = substr($_REQUEST["campagne"], 1);

	require_once("partials/class/Bdd.php");
	$bdd = new Bdd();

	$requete = "UPDATE campagne SET route='$route' WHERE id=$campagne";
	if($bdd->executeSimpleExecRequete($requete)) echo "ok";
?>