<?php
	require_once("../class/Bdd.php");
	require_once("../class/Xmailer.php");
	require_once("../class/Ftp.php");

	$id    = $_REQUEST["id"];
	$route = $_REQUEST["route"];

	if($route == "1x") {
		$bdd = new Bdd();
        $requete = "SELECT reference FROM campagne WHERE id=".$id;
        $ref = $bdd->executeQueryRequete($requete, 1);
        while( $data = $ref->fetch() ) {
        	$reference = $data->reference;
        }

        $ftp = new Ftp();
        $ftp->uploadCampagneReprise($reference);
	}
?>