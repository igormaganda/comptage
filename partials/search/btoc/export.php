<?php
	require("../class/Bdd.php");
	require("../class/Export.php");

	$display = new Export($_REQUEST, true, true);
?>