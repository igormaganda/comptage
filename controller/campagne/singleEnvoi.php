<?php
	require_once("partials/class/Bdd.php");
	$bdd = new Bdd();

	$id = substr($_REQUEST["id"], 1);

	// Récupération des infos
	$requete = "SELECT envoi, reference, route, cible
				FROM campagne, campagne_send
				WHERE campagne.id=campagne_send.id_campagne
				AND campagne.id=$id";

	$q = $bdd->executeQueryRequete($requete, 1);
	while( $r = $q->fetch() ) {

		$requete = "INSERT INTO send_daemon(
						date,
						reference,
						route,
						cible,
						id_campagne,
						go
					) VALUES (
						'$r->envoi',
						'$r->reference',
						'$r->route',
						'$r->cible',
						$id,
						0
					)";

		if($bdd->executeSimpleExecRequete($requete)) {
			$requeteUpdateStatut = "UPDATE campagne SET status='En cours' WHERE id='$id'";
			$bdd->executeSimpleExecRequete($requeteUpdateStatut);
			echo "ok";
		}
	}
?>