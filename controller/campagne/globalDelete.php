<?php
	require_once("partials/class/Bdd.php");
	$bdd = new Bdd();
	$ref = $_REQUEST["ref"];

	$requete = "DELETE FROM campagne WHERE this='$ref'";
	$q = $bdd->executeSimpleExecRequeteWithReturnVolume($requete);
	if($q>0) {
		echo "ok|".$q;
	}
?>