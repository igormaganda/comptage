<?php 
	require_once("../../../sdatamart/lib/system_load.php");
	authenticate_user('all');
	require_once("../../header.php"); 
?>

<?php require_once("partials/class/Bdd.php"); ?>

<div id="content">
	<div class="widget">
		<div class="widget-body innerAll inner-2x">
			<div class="widget-head">
				<h4 class="heading">Import de data</h4>
			</div>

			<form method="post" action="update2.php" enctype="multipart/form-data">
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

				<table id="update_oc">
					<tr>
						<td>
							<div class="checkbox">
								<label class="checkbox-custom"> 
									<input type="checkbox" name="ouvreurs" value="yes">
									<i class="fa fa-fw fa-square-o"></i> Ouvreurs.
								</label>
							</div>
						</td>
						<td>
							<div class="checkbox">
								<label class="checkbox-custom"> 
									<input type="checkbox" name="cliqueurs" value="yes">
									<i class="fa fa-fw fa-square-o"></i> Cliqueurs.
								</label>
							</div>
						</td>
					</tr>
				</table>

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

<?php require_once("../../footer.php"); ?>