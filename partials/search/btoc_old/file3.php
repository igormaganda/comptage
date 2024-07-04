<?php use btoc\Insert;
	require_once("../../../sdatamart/lib/system_load.php");
	authenticate_user('all');
	require_once("../../header.php"); 
?>

<?php require_once("partials/class/Bdd.php"); ?>
<?php require_once("partials/class/InsertModify.php"); ?>

	<div id="content">
	<?php
		$parsefile = new Insert($_POST);
		//var_dump($_POST);
			?>

	</div>

<script type="text/javascript">
$(document).ready(function() {
	$("#accordion").appendTo("#content");
});
</script>
<script src="/<?php echo $path; ?>/js/prism/prism.js" type="text/javascript"></script>

<?php require_once("../../footer.php"); ?>
