<?php
	require_once("../../../sdatamart/lib/system_load.php");
	//user Authentication.
	authenticate_user('all');
	require("partials/class/Bdd.php");
	require("partials/class/Search_b2c.php");

	$search = new Search_b2c($_POST, FALSE);

?>