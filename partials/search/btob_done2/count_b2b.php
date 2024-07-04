<?php
	require_once("../../../sdatamart/lib/system_load.php");
	//user Authentication.
	authenticate_user('all');
	require("partials/class/Bdd.php");
	require("partials/class/Search_b2b.php");

	$search = new Search_b2b($_POST, FALSE);

?>