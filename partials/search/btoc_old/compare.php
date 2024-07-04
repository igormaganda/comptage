<?php
	require_once("../../../sdatamart/lib/system_load.php");
	authenticate_user('all');
	require_once("../../header.php");
	require_once("partials/class/Bdd.php");
?>

<div id="content">
	<div class="widget">
		<div class="widget-body innerAll inner-2x">
			<div class="widget-head">
				<h4 class="heading">Comparer un fichier à Datamart</h4>
			</div>

			<form method="post" action="compare2.php" enctype="multipart/form-data">
				<div id="input_upload">
					<div class="fileupload fileupload-new margin-none" data-provides="fileupload">
						<span class="btn btn-default btn-file">
							<span class="fileupload-new">Sélectionner un fichier CSV</span>
							<span class="fileupload-exists">Changer</span>
							<input type="file" name="csv" id="csv" class="margin-none" />
						</span>
						<span class="fileupload-preview"></span>
						<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
					</div>
				</div>

				<div class="form-group" id="separateur">
					<label for="separateur_input">Séparateur</label>
					<input type="text" name="separateur" class="form-control" id="separateur_input" placeholder="Séparateur" value=";">
				</div>

				<div id="input_search_submit">
					<input type="submit" name="submit" value="Envoyer" class="btn btn-info" />
				</div>
			</form>
		</div>
	</div>
</div>

<?php require_once("../footer.php"); ?>