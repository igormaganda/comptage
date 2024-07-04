<?php
	require("partials/class/Bdd.php");
	require("partials/class/Export.php");

	$display = new Export($_REQUEST, false, false);
?>