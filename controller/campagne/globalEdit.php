<?php
	$ref = $_REQUEST["ref"];

	require_once("partials/class/Bdd.php");

	$requete = "SELECT * FROM campagne WHERE this='$ref' ORDER BY id ASC LIMIT 1";

	$bdd = new Bdd();
	$q = $bdd->executeQueryRequete($requete, 1);

	while( $r = $q->fetch() ) {
		$retour = array(
			'b2'          => $r->b2,
			'type_base'   => $r->type_base,
			'repasse'     => $r->repasse,
			'programme'   => $r->programme,
			'client'      => $r->client,
			'campagne'    => $r->campagne,
			'annonceur'   => $r->annonceur,
			'sujet'       => $r->sujet,
			'expediteur'  => $r->expediteur,
			'adresse'     => $r->adresse,
			'domaine'     => $r->domaine,
			'pj'          => $r->pj,
			'txt'         => $r->txt,
			'content'     => $r->content,
			'route'       => $r->route,
			'comptage'    => $r->comptage,
			'volume'      => $r->volume,
			'thematiques' => $r->thematiques,
			'envoi'       => $r->envoi,
			'bat'         => $r->bat,
			'status'      => $r->status,
			'reference'   => $r->reference,
			'date'        => $r->date,
			'dpf'         => $r->dpf,
			'operation'   => $r->operation,
			'prix'        => $r->prix,
			'objectif'    => $r->objectif,
			'miroir'      => $r->miroir,
			'desabo'      => $r->desabo,
			'this'        => $r->this
		);
	}

	header('Content-type: application/json');
	echo json_encode($retour);
?>