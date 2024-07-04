<?php
	require_once("../class/Bdd.php");

	$id      = $_REQUEST["id"];
	$route   = $_REQUEST["route"];

	$bdd     = new Bdd();

	// Récupération des infos
	$requete = "SELECT envoi, reference, route, miroir, desabo FROM campagne WHERE id=$id";
	$recupInfos = $bdd->executeQueryRequete($requete, 1);

	while( $item = $recupInfos->fetch() ) {
		$envoi     = $item->envoi;
		$reference = $item->reference;
		$route     = $item->route;
		$miroir    = $item->miroir == 1 ? "TRUE" : "FALSE";
		$desabo    = $item->desabo == 1 ? "TRUE" : "FALSE";
	}

	$requete = "SELECT cible FROM campagne_send WHERE id_campagne=$id";
	$recupInfos = $bdd->executeQueryRequete($requete, 1);

	while( $item = $recupInfos->fetch() ) {
		$cible = isset($item->cible) ? $item->cible : "";
		if(isset($item->cible)) {
			// Ajout à la liste d'envois
			$requete = "INSERT INTO send_daemon(date, reference, route, cible, id_campagne, go)
						VALUES ('$envoi', '$reference', '$route', '$item->cible', $id, 0)";
			if($bdd->executeSimpleExecRequete($requete)) {
				$requeteUpdateStatut = "UPDATE campagne SET status='En cours' WHERE id='$id'";
				$bdd->executeSimpleExecRequete($requeteUpdateStatut);
				
				echo 0; // Ok 
			}
		} else {
			echo 1; // Erreur(Pas de cible)
		}
	}
?>