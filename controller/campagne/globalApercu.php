<?php
	require_once("partials/class/Bdd.php");
	$bdd = new Bdd();
	$ref = $_REQUEST["ref"];

	$requete = "SELECT content FROM campagne WHERE this='$ref' LIMIT 1";
	$q = $bdd->executeQueryRequete($requete, 1);
	while( $r = $q->fetch() )
		$content = $r->content;
	
	//echo $content;

	$file = fopen('rendu.html', 'r+');
	ftruncate($file, 0);
	fputs($file, $content);
	fclose($file);
?>