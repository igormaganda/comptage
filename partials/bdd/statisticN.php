<?php
	// require_once("../../partials/class/Bdd.php");
	// require_once("../../partials/class/Calc.php");

	$bdd = new Bdd();
	// // $calc = new Calc();

	$req= "SELECT COUNT(id) FROM nettoyage_stats";
	$allemail = $bdd->executeSimpleExecRequete($req);

	// //Requête count
	// $req= "SELECT count(id) FROM nettoyage_stats WHERE `check`='valide'";
	// $validmail = $bdd->executeSimpleExecRequete($req);

	// //Requête count
	// $req= "SELECT count(id) FROM nettoyage_stats WHERE `check`='invalide' OR `check`='bounce'";
	// $invalidmail = $bdd->executeSimpleExecRequete($req);

	// $req = "SELECT count(id) FROM nettoyage_stats WHERE `check` = 'connexion'";
	// $connexionmail = $bdd->executeSimpleExecRequete($req);

	//$insert = "INSERT INTO nettoyage_stats (Date, Email, Check, SmtpServer) VALUES ($allemail, $validmail, $connexionmail)";

?>