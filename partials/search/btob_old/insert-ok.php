<?php
	require_once("../../../sdatamart/lib/system_load.php");
	//user Authentication.
	authenticate_user('all');
	require_once("../../header.php");
	require_once("partials/class/Bdd.php");
	require_once("partials/class/Upload.php");

	$bdd    = new Bdd();
	$upload = new Upload($_POST, $_FILES['csv']);
	//$upload->uploadFile(0); // Insertion
?>

<div id="content">
	<div class="widget">
		<div class="widget-body innerAll inner-2x">
			<?php //echo $upload->msg["upload"]; ?>
<?php $upload->uploadFile(0); // Insertion ?>
			<!--<div id="form_head">
				<label class="checkbox-custom"> 
					<input type="checkbox" name="exclureFirstLine" value="yes">
					<i class="fa fa-fw fa-square-o"></i> Exclure la première ligne
				</label>
				<label class="checkbox-custom"> 
					<input type="checkbox" name="dirigeants" value="yes">
					<i class="fa fa-fw fa-square-o"></i> Fichier de dirigeants
				</label>
			</div>
			<br /><hr /><br />-->

			<?php //echo $upload->msg["form"]; ?>
		</div>
	</div>
</div>

<?php require_once("../footer.php"); ?>