<?php
	require_once("../class/Bdd.php");
	$bdd = new Bdd();

	$update = "UPDATE campagne SET envoi='".$_POST["annee"]."-".$_POST["mois"]."-".$_POST["jour"]." ".$_POST["heure"].":".$_POST["min"].":".$_POST["sec"]."' WHERE id=".$_POST["id"];

	if($bdd->executeSimpleExecRequete($update)) {
		header('Location: ../campagne_b.php');
	}
?>