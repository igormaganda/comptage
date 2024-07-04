<?php require_once("partials/class/Bdd.php"); ?>

<?php
	$bdd = new Bdd();
	$requete = "SELECT content FROM campagne_tmp WHERE id=".$_GET["id"];


	$result = $bdd->executeQueryRequete($requete, 1);
	while( $content = $result->fetch() ) {
		echo $content->content;
	}
?>
