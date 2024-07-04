<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>
<?php 
// require_once("../../sdatamart/lib/system_load.php");
//user Authentication.
// authenticate_user('all');
require_once("partials/class/Bdd.php"); 
?>
<?php require_once("partials/class/Campagne.php"); ?>
<div id="content">
	<?php
		$campagne = new Campagne($_POST);

		$campagne->saveCampagnePart1();
	?>
</div>