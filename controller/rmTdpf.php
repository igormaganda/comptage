<?php
	$id = $_REQUEST["send"];

	require_once("../class/Bdd.php");

	$requete = "DELETE FROM gestion_limittdpf WHERE id='".$id."'";

	$remove = new Bdd();
	$remove->executeSimpleExecRequete($requete);
?>