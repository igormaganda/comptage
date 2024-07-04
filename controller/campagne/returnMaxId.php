<?php
	$ref = $_REQUEST["ref"];

	require_once("partials/class/Bdd.php");

	$requete = "SELECT MAX(id) FROM campagne WHERE this='$ref'";

	$bdd = new Bdd();
	$q = $bdd->executeSimpleExecRequeteWithReturnValue($requete, 1);

	if($q > 0) {
		echo "ok|".$q;
	}
?>