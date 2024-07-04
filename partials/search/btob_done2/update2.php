<?php 
	require_once("../../../sdatamart/lib/system_load.php");
	//user Authentication.
	authenticate_user('all');	
	require_once("../../header.php"); ?>

<?php require_once("partials/class/Bdd.php"); ?>
<?php require_once("partials/class/Upload.php"); ?>

<div id="content">
	<?php
		$fileUpload = new Upload($_POST, $_FILES['csv']);
		
		$fileUpload->uploadFile(1);
	?>
</div>

<?php require_once("../../footer.php"); ?>