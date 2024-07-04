<?php
	require_once("../../../sdatamart/lib/system_load.php");
	//user Authentication.
	authenticate_user('all');
	require("../../header.php");
	require("partials/class/Bdd.php");
	require("partials/class/Search_b2b.php");
?>

<div id="content">
	<?php
		$search = new Search($_POST, TRUE);
	?>
</div>

<?php require("../../footer.php"); ?>