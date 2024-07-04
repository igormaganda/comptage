<?php
$id = $_REQUEST["send"];

require_once("../class/Bdd.php");

$requete = "SELECT * FROM gestion_routes WHERE id='$id'";

$bdd = new Bdd();
$onTheRoad = $bdd->executeQueryRequete($requete, 1);

while ($route = $onTheRoad->fetch()) {
	$retour = array(
		'ip'       => $route->ip,
		'alias'    => $route->alias,
		'username' => $route->username,
		'password' => $route->password,
		'port'     => $route->port,
		'ndd'      => $route->ndd,
		'tls'      => $route->tls,
		'domaine'  => $route->domaine,
		'header_html'  => $route->header_html,
		'footer_html'  => $route->footer_html,
		'timer'    => $route->timer
	);
}
//header("Location: ");
header('Content-type: application/json');
echo json_encode($retour);
