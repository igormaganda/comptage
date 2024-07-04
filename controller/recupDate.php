<?php
	$id = $_REQUEST["send"];

	require_once("../class/Bdd.php");

	$bdd = new Bdd();

	$requete = "SELECT envoi FROM campagne WHERE id=".$id;
	$result = $bdd->executeQueryRequete($requete, 1);

	while( $data = $result->fetch() ) {
		$envoi = $data->envoi;
	}

	echo $envoi;
?>