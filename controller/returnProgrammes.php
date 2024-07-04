<?php
	$partenaire = $_REQUEST["partenaire"];

	require("../class/Bdd.php");

	$requete = "SELECT * FROM gestion_programme WHERE partenaire='$partenaire'";

	$bdd = new Bdd();
	$onTheRoad = $bdd->executeQueryRequete($requete, 1);

	$retour = array();
	while( $route = $onTheRoad->fetch() ) {
		$retour[] = array(
			'id'    => $route->id,
			'nom'   => $route->nom,
			'alias' => $route->alias
		);
	var_dump(' retour ', $route . "\n" );
	}

	header('Content-type: application/json');
	echo json_encode($retour);
?>