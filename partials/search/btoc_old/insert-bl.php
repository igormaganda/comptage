<?php 
require_once("../../../sdatamart/lib/system_load.php");
authenticate_user('all');
require_once("../../header.php"); ?>

<?php require_once("partials/class/Bdd.php"); ?>

<div id="content">
	<div class="widget">
		<div class="widget-body innerAll inner-2x">
			<div class="widget-head">
				<h4 class="heading">Import de data</h4>
			</div>

			<form method="post" action="insert2.php" enctype="multipart/form-data">
				<!--<div class="form-group" id="upload_name">
					<input type="text" name="nom" class="form-control input-lg" id="nom" placeholder="Nom de l'import">
				</div>-->

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

				<div id="list_files">
					<h5>Ou sélectionner un fichier de la liste</h5>
					<hr />

					<?php
						//$dir    = 'C:/Users/Bernie/Documents/btob';
						$dir    = '/tmp/CLIENTS/ber';
						$files1 = scandir($dir);

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
					?>
				</div>

				<div class="widget-body center" id="b2">
					<div class="make-switch" data-on="default" data-off="default">
					<input type="checkbox" checked></div>
				</div>

				<input type="hidden" name="b2b-b2c" id="b2_input" value="b2c">

				<div class="widget-body center" id="filetype">
					<div class="make-switch" data-on="default" data-off="default">
					<input type="checkbox" checked></div>
				</div>

				<input type="hidden" name="filetype" id="filetype_input" value="data">

				<div class="form-group" id="separateur">
					<label for="separateur_input">Séparateur</label>
					<input type="text" name="separateur" class="form-control" id="separateur_input" placeholder="Séparateur" value=";">
				</div>

				<div class="widget-body center" id="filetype">
					<label for="programme">Programme</label>
					<select name="programme" class="form-control input-lg" id="programme">
					<?php
						$bdd = new Bdd();

						$requete = "SELECT gestion_programme.id, gestion_programme.nom, gestion_partenaire.nom AS partenaire FROM gestion_programme, gestion_partenaire WHERE gestion_programme.partenaire = gestion_partenaire.id ORDER BY gestion_programme.id ASC";
						$result = $bdd->executeQueryRequete($requete, 1);

						while( $items = $result->fetch() ) {
							echo '<option value="'.$items->id.'">'.$items->nom.' ('.$items->partenaire.')</option>';
						}
					?>
					</select>
				</div>

				<div id="input_search_submit">
					<input type="submit" name="submit" value="Envoyer" class="btn btn-info" />
				</div>
			</form>
		</div>
	</div>
</div>

<?php require_once("../../footer.php"); ?>