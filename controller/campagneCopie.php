<?php
	$id = $_REQUEST["send"];

	require_once("../class/Bdd.php");

	$requete = "SELECT * FROM campagne WHERE id='".$id."'";

	$bdd = new Bdd();
	$result = $bdd->executeQueryRequete($requete, 1);

	while( $currentCampagne = $result->fetch() ) {
		$currentCampagne->b2 = empty($currentCampagne->b2) ? 0 : 1;

		if($currentCampagne->comptage == "") $currentCampagne->comptage = "NULL";

		$currentCampagne->thematiques = $currentCampagne->thematiques == "" ?
		"''" : "'".$currentCampagne->thematiques."'";
		
		$currentCampagne->envoi       = $currentCampagne->envoi == "" ?
		"NULL" : "'".$currentCampagne->envoi."'";
		
		$currentCampagne->bat         = $currentCampagne->bat == "" ?
		"NULL" : "'".$currentCampagne->bat."'";
		
		$currentCampagne->prix        = $currentCampagne->prix == "" ?
		"NULL" : "'".$currentCampagne->prix."'";
		
		$currentCampagne->objectif    = $currentCampagne->objectif == "" ?
		"NULL" : "'".$currentCampagne->objectif."'";

		$copie = "INSERT INTO campagne(
			B2,
			Type_Base,
			Repasse,
			Programme,
			Client,
			Campagne,
			Annonceur,
			Sujet,
			Expediteur,
			Adresse,
			Domaine,
			PJ,
			Txt,
			Content,
			Route,
			Operation,
			Prix,
			Objectif,
			Comptage,
			Volume,
			Dpf,
			Thematiques,
			Envoi,
			BAT,
			Status,
			Reference,
			Date)
		VALUES ('".$currentCampagne->b2."', '"
			.$currentCampagne->type_base."', '"
			.$currentCampagne->repasse."', '"
			.utf8_decode($currentCampagne->programme)."', '"
			.utf8_decode($currentCampagne->client)."', '"
			.utf8_decode($currentCampagne->campagne)."', '"
			.utf8_decode($currentCampagne->annonceur)."', 'Copie de "
			.utf8_decode($currentCampagne->sujet)."', '"
			.utf8_decode($currentCampagne->expediteur)."', '"
			.utf8_decode($currentCampagne->adresse)."', '"
			.$currentCampagne->domaine."', '"
			.$currentCampagne->pj."', '"
			.utf8_decode($currentCampagne->txt)."', '"
			.$currentCampagne->content."', '"
			.$currentCampagne->route."', '"
			.$currentCampagne->operation."', "
			.$currentCampagne->prix.", "
			.$currentCampagne->objectif.", "
			.$currentCampagne->comptage.", "
			.$currentCampagne->volume.", "
			.$currentCampagne->dpf.", "
			.$currentCampagne->thematiques.", "
			.$currentCampagne->envoi.", "
			.$currentCampagne->bat.", '
			Rien', '"
			.$currentCampagne->reference."', '"
			.$currentCampagne->date."') 
		RETURNING id";

		if($id_copie_campagne = $bdd->executeSimpleExecRequeteWithReturnValue($copie)) {
			$requete = "SELECT * FROM campagne_send WHERE id_campagne='".$id."'";
			$result = $bdd->executeQueryRequete($requete, 1);

			while( $listeId = $result->fetch() ) {
				$Ids = $listeId->cible;
			}

			$requete = "INSERT INTO campagne_send(id_campagne, cible) VALUES ('".$id_copie_campagne."', '".$Ids."')";
			$bdd->executeSimpleExecRequete($requete);
		}
	}
?>