<?php
	$id      = trim($_REQUEST["id"]);
	$bat     = trim($_REQUEST["bat"]);
	$route   = trim($_REQUEST["route"]);
	$adresse = trim($_REQUEST["adresse"]);
	$action  = trim($_REQUEST["action"]);

	

	require_once("../class/Bdd.php");
	require("../class/Mailing.php");

	$mail = new Mailing($id, $route, $adresse);
	$mail->mailSimpleSB($bat, $action);
