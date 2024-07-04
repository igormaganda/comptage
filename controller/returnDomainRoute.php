<?php
	require_once("../class/Bdd.php");

	$route = $_REQUEST["route"];

	$bdd  = new Bdd();
	$requete = "SELECT nom FROM gestion_domaine WHERE id=(SELECT domaine FROM gestion_routes WHERE id=$route)";
	$result = $bdd->executeQueryRequete($requete, 1);
	while( $gestion_routes = $result->fetch() ) echo $route = $gestion_routes->nom;
?>