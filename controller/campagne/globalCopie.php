<?php
	require_once("partials/class/Bdd.php");
	$bdd = new Bdd();
	$ref = $_REQUEST["ref"];

	$cmpAcopier = array();
	$requete = "SELECT type_base, repasse, programme, client, campagne, annonceur, sujet, expediteur, adresse, domaine, txt, content, route, comptage, volume, thematiques, envoi, bat, reference, date, dpf, operation, prix, objectif, miroir, desabo, this, cible
				FROM campagne, campagne_send
				WHERE this='$ref'
				AND campagne.id=campagne_send.id_campagne
				ORDER BY campagne.id ASC";
	$q = $bdd->executeQueryRequete($requete, 1);
	while( $r = $q->fetch() ) {
		$cmpAcopier[] = array(
			"type_base"   => $r->type_base,
			"repasse"     => $r->repasse,
			"programme"   => $r->programme,
			"client"      => $r->client,
			"campagne"    => $r->campagne,
			"annonceur"   => $r->annonceur,
			"sujet"       => $r->sujet,
			"expediteur"  => $r->expediteur,
			"adresse"     => $r->adresse,
			"domaine"     => $r->domaine,
			"txt"         => $r->txt,
			"content"     => $r->content,
			"route"       => $r->route,
			"comptage"    => $r->comptage,
			"volume"      => $r->volume,
			"thematiques" => $r->thematiques,
			"envoi"       => $r->envoi,
			"bat"         => $r->bat,
			"reference"   => $r->reference,
			"date"        => $r->date,
			"dpf"         => $r->dpf,
			"operation"   => $r->operation,
			"prix"        => $r->prix,
			"objectif"    => $r->objectif,
			"miroir"      => $r->miroir,
			"desabo"      => $r->desabo,
			"this"        => $r->this,
			"cible"       => $r->cible
		);
	}

	//print_r($cmpAcopier);

	$nbCmp = 0;
	foreach ($cmpAcopier as $tab) {
		$miroir   = $tab["miroir"] == 1 || $tab["miroir"] == TRUE ? "TRUE" : "FALSE";
		$desabo   = $tab["desabo"] == 1 || $tab["desabo"] == TRUE ? "TRUE" : "FALSE";

		$requete = "INSERT INTO campagne(
						b2,
						type_base,
						repasse,
						programme,
						client,
						campagne,
						annonceur,
						sujet,
						expediteur,
						adresse,
						domaine,
						pj,
						txt,
						content,
						route,
						comptage,
						volume,
						thematiques,
						envoi,
						bat,
						status,
						reference,
						date,
						dpf,
						operation,
						prix,
						objectif,
						miroir,
						desabo,
						this
					) VALUES(
						TRUE,
						'".$tab["type_base"]."',
						'".$tab["repasse"]."',
						'".$tab["programme"]."',
						'".str_replace("'", "''", $tab["client"])."',
						'".str_replace("'", "''", $tab["campagne"])."',
						'".str_replace("'", "''", $tab["annonceur"])."',
						'".str_replace("'", "''", $tab["sujet"])."',
						'".str_replace("'", "''", $tab["expediteur"])."',
						'".str_replace("'", "''", $tab["adresse"])."',
						'".str_replace("'", "''", $tab["domaine"])."',
						'NULL',
						'".str_replace("'", "''", $tab["txt"])."',
						'".str_replace("'", "''", $tab["content"])."',
						'".$tab["route"]."',
						'".$tab["comptage"]."',
						'".$tab["volume"]."',
						'".$tab["thematiques"]."',
						'".$tab["envoi"]."',
						'".$tab["bat"]."',
						'Rien',
						'".$tab["reference"]."',
						'".$tab["date"]."',
						'".$tab["dpf"]."',
						'".$tab["operation"]."',
						'".$tab["prix"]."',
						'".$tab["objectif"]."',
						".$miroir.",
						".$desabo.",
						'".$tab["this"]."_copie'
					) RETURNING id";
		$id = $bdd->executeSimpleExecRequeteWithReturnValue($requete);

		if($id > 0) {
			$requete = "INSERT INTO campagne_send(id_campagne, cible) VALUES($id, '".$tab["cible"]."')";
			$bdd->executeSimpleExecRequete($requete);
		} else {
			exit;
		}
		$nbCmp++;
	}

	echo "ok|".$nbCmp;
?>