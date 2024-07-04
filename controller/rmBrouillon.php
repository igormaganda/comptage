<?php
	$id = $_REQUEST["id"];

	require_once("../class/Bdd.php");

	$requete = "DELETE FROM campagne_tmp WHERE id='$id'";

	$remove = new Bdd();
	$remove->executeSimpleExecRequete($requete);

	echo 'ok';
?>