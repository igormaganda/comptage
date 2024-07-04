<?php
	$ref = $_REQUEST["ref"];

	require_once("partials/class/Bdd.php");
	$bdd = new Bdd();

	$requete = "SELECT id, alias FROM gestion_routes ORDER BY alias";
	$q = $bdd->executeQueryRequete($requete, 1);

	$routes = array();
	while( $r = $q->fetch() ) $routes["$r->id"] = $r->alias;

	$requete = "SELECT campagne.id, campagne, gestion_routes.alias AS route, volume, envoi, status
				FROM campagne, gestion_routes
				WHERE this='$ref'
				AND CAST(campagne.route AS INTEGER)=gestion_routes.id
				ORDER BY campagne.id ASC";

	$q = $bdd->executeQueryRequete($requete, 1);

	$retour = array();
	while( $r = $q->fetch() ) {
		$retour[] = array(
			'id'       => $r->id,
			'campagne' => $r->campagne,
			'route'    => $r->route,
			'volume'   => $r->volume,
			'envoi'    => $r->envoi,
			'status'   => $r->status,
			'routes'   => $routes
		);
	}

	header('Content-type: application/json');
	echo json_encode($retour);
?>