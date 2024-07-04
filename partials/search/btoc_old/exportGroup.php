<?php
	require_once("../../../sdatamart/lib/system_load.php");
	authenticate_user('all');
	require("partials/class/Bdd.php");
	require("partials/class/Export.php");

	$display = new Export($_REQUEST, false, false);
?>