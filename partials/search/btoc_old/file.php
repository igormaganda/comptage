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

			<form method="post" action="file2.php" enctype="multipart/form-data">
				<div id="list_files">
					<h5>Sélectionner un fichier de la liste</h5>

					<?php
						//$dir    = 'C:/Users/Bernie/Documents/btob';
						$dir    = '/var/www/html/Datamart/import/';
						@$files1 = scandir($dir);

						if($files1 != false) {
							$line = 1;
							foreach ($files1 as $key => $file) {
								if ($file != "." && $file !="..") {
									if(is_file($dir.'/'.$file)) {
										echo '<div class="radio">
												<span>'.$line.'</span>
												<label class="radio-custom">
													<input type="radio" name="file_to_submit" value="'.$file.'">
													<i class="fa fa-circle-o"></i>
													'.$file.'
												</label>
											</div>';
										$line++;
									}
								}
							}

							if(($line-1) == 0) echo '<p style="text-align: center; margin: 5px 0 0;">Aucun fichier présent.</p>';
						} else {
							echo '<p style="text-align: center; margin: 5px 0 0;">Le répertoire n\'est pas accessible.</p>';
						}
					?>
				</div>


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


				<div class="widget-body center" id="b2">
					<div class="make-switch" data-on="default" data-off="default">
					<input type="checkbox" checked></div>
				</div>

				<input type="hidden" name="b2b-b2c" id="b2_input" value="b2c">



				<div class="row separator bottom" id="upload_file">
					<div class="col-md-2">
						<button type="submit" name="insert" value="Insertion" class="btn btn-success">
							<i class="fa fa-download"></i> Insertion
						</button>
					</div>
					
					<div class="col-md-1">
						<button type="submit" name="insert" value="Insertion" class="btn btn-success">
							<i class="fa fa-download"></i> Blackliste
						</button>
					</div>

					<div class="col-md-3">
						<button type="submit" name="update" value="Mise à jour" class="btn btn-warning">
							<i class="fa fa-edit"></i> Enrichissement
						</button>
					</div>
					
					<div class="col-md-3">
						<button type="submit" name="comparaison" value="Comparaison" class="btn btn-info">
							<i class="fa fa-book"></i> Comparaison
						</button>
					</div>
					
					<div class="col-md-3">
						<button type="submit" name="nettoyage" value="Nettoyage" class="btn btn-danger">
							<i class="fa fa-trash-o"></i> Nettoyage
						</button>
					</div>					
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#list_files").click(function() {
			$("form div#list_files div.radio").toggle();
		});
	});
</script>

<?php require_once("../footer.php"); ?>