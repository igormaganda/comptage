<?php
	$id = $_REQUEST["send"];

	require_once("../class/Bdd.php");
	$bdd = new Bdd();

	/////////////////////////////////////////
	///// RECUPERE & CORRIGE LA REQUETE /////
	/////////////////////////////////////////
	$recupRequest = $bdd->executeQueryRequete("SELECT request FROM counter WHERE id=".$id, 1);
	while( $print = $recupRequest->fetch() ) { $requete = $print->request; }
	$requete = preg_replace("#\\\$#", "'", $requete);

	$nb_result = $bdd->executeQueryRequete($requete, 1)->fetchColumn();


	$update = "UPDATE counter SET result=".$nb_result." WHERE id=".$id;

	if($bdd->executeSimpleExecRequete($update)) {
		echo $nb_result;
	}
?>