<?php
	$id = $_REQUEST["send"];

	require_once("../class/Bdd.php");

	$requete = "DELETE FROM counter WHERE id='".$id."'";

	$remove = new Bdd();
	$remove->executeSimpleExecRequete($requete);
?>