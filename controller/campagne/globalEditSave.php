<?php
	$form = $_REQUEST;

	require_once("partials/class/Bdd.php");
	$bdd = new Bdd();

	//print_r($form);


	$thematiques = implode(",", $form["thematiques"]);
	$envoi       = $form["annee"]."-".$form["mois"]."-".$form["jour"]." ".$form["heure"].":".$form["min"].":".$form["sec"];
	$miroir      = isset($form["miroir"]) && $form["miroir"]=="yes" ? "TRUE" : "FALSE";
	$desabo      = isset($form["desabo"]) && $form["desabo"]=="yes" ? "TRUE" : "FALSE";

	$requete = "UPDATE campagne
				SET 
					type_base   ='".$form["type_base"]."',
					repasse     ='".$form["repasse"]."',
					programme   ='".$form["programme"]."',
					client      ='".str_replace("'", "''", $form["client"])."',
					campagne    ='".str_replace("'", "''", $form["campagne"])."' || right(campagne, 5),
					annonceur   ='".str_replace("'", "''", $form["annonceur"])."',
					sujet       ='".str_replace("'", "''", $form["sujet"])."',
					expediteur  ='".str_replace("'", "''", $form["expediteur"])."',
					adresse     ='".str_replace("'", "''", $form["adresse"])."',
					domaine     ='".str_replace("'", "''", $form["domaine"])."',
					txt         ='".str_replace("'", "''", $form["txt-brut"])."',
					content     ='".str_replace("'", "''", $form["tinymce"])."',
					route       ='".$form["route"]."',
					thematiques ='".$thematiques."',
					envoi       ='".$envoi."',
					bat         ='".$form["bat"]."',
					operation   ='".$form["ope"]."',
					prix        ='".$form["prix"]."',
					objectif    ='".$form["objectif"]."',
					miroir      =".$miroir.",
					desabo      =".$desabo."
				WHERE this  ='".$form["this"]."'";
	if($bdd->executeSimpleExecRequete($requete)) echo "ok";
?>