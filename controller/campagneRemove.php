<?php
	require_once("../class/Bdd.php");
	$remove = new Bdd();

	$id = $_REQUEST["send"];

	$rm_campagne = "DELETE FROM campagne WHERE id='".$id."'";
	$remove->executeSimpleExecRequete($rm_campagne);

	$rm_campagne_send = "DELETE FROM campagne_send WHERE id_campagne='".$id."'";
	$remove->executeSimpleExecRequete($rm_campagne_send);
?>