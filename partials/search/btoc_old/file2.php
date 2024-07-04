<?php
	require_once("../../../sdatamart/lib/system_load.php");
	authenticate_user('all');
	require_once("../../header.php");
	require_once("partials/class/Bdd.php");
	require_once("partials/class/Calc.php");
	require_once("partials/class/Upload.php");

	$bdd    = new Bdd();
	$calc   = new Calc();
	$upload = new Upload($_POST, $_FILES['csv']);

	if(isset($_POST["insert"])) $upload->uploadFile(0);
	if(isset($_POST["update"])) $upload->uploadFile(1);
	if(isset($_POST["comparaison"])) $upload->uploadFile(2);
	if(isset($_POST["nettoyage"])) $upload->uploadFile(3);
?>

<div id="content">
	<div class="widget">
		<div class="widget-body innerAll inner-2x">
			<form method="POST" action="file3.php" id="form_validation">
				<?php echo $upload->msg["upload"]; ?>
				<hr /><br />



				<?php if (isset($_POST["insert"])) { ?>
					<label class="checkbox-custom"> 
						<input type="checkbox" name="exclureFirstLine" value="yes">
						<i class="fa fa-fw fa-square-o"></i> Exclure la première ligne
					</label><br />

					<?php if ($_POST["b2b-b2c"] == "b2c") { ?>
						<div class="widget-body center" id="filetype">
							<label for="programme">Programme</label>
							<select name="programme" class="form-control input-lg" id="programme">
							<?php
								$bdd = new Bdd();

								$requete = "SELECT
												gestion_programme.id,
												gestion_programme.nom,
												gestion_partenaire.nom AS partenaire
											FROM
												gestion_programme,
												gestion_partenaire
											WHERE gestion_programme.partenaire = gestion_partenaire.id
											ORDER BY gestion_programme.id ASC";
								$result = $bdd->executeQueryRequete($requete, 1);

								while( $items = $result->fetch() ) {
									echo '<option value="'.$items->id.'">'.$items->nom.' ('.$items->partenaire.')</option>';
								}
							?>
							</select>
						</div>

						<?php
							$requete = "SELECT id, Nom, Alias FROM gestion_thematique ORDER BY id ASC";
							$result = $bdd->executeQueryRequete($requete, 1);

							if (isset($thematiques)) {
								$themes = explode(",", $thematiques);

								while( $items = $result->fetch() ) {
									$is = false;

									foreach ($themes as $value) {
										if( $items->alias == $value ) {
											$is = true;
										}
									}

									if( $is ) {
										echo '<div class="item_thematique"><label class="checkbox-custom"> 
										<input type="checkbox" name="thematiques[]" value="'.$items->id.'" checked="checked">
										<i class="fa fa-fw fa-square-o checked"></i>'.$items->nom.'</label></div>';
									} else {
										echo '<div class="item_thematique"><label class="checkbox-custom"> 
										<input type="checkbox" name="thematiques[]" value="'.$items->id.'">
										<i class="fa fa-fw fa-square-o"></i>'.$items->nom.'</label></div>';
									}
								}
							} else {
								while( $items = $result->fetch() ) {
									echo '<div class="item_thematique"><label class="checkbox-custom"> 
										<input type="checkbox" name="thematiques[]" value="'.$items->id.'">
										<i class="fa fa-fw fa-square-o"></i>'.$items->nom.'</label></div>';
								}
							}
						?>
					<?php } ?>

					<?php if ($_POST["b2b-b2c"] == "b2b") { ?>
						<label class="checkbox-custom"> 
							<input type="checkbox" name="dirigeants" value="yes">
							<i class="fa fa-fw fa-square-o"></i> Fichier de dirigeants
						</label>

						<input class="form-control" type="text" name="categorie" placeholder="Renseigner des catégories (cat1, cat2, cat3...)"><br />
					<?php } ?>
				<?php } ?>



				<?php if (isset($_POST["update"])) { ?>
					<?php if ($_POST["b2b-b2c"] == "b2c") { ?>
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

						<?php
							$requete = "SELECT id, Nom, Alias FROM gestion_thematique ORDER BY id ASC";
							$result = $bdd->executeQueryRequete($requete, 1);

							if (isset($thematiques)) {
								$themes = explode(",", $thematiques);

								while( $items = $result->fetch() ) {
									$is = false;

									foreach ($themes as $value) {
										if( $items->alias == $value ) {
											$is = true;
										}
									}

									if( $is ) {
										echo '<div class="item_thematique"><label class="checkbox-custom"> 
										<input type="checkbox" name="thematiques[]" value="'.$items->id.'" checked="checked">
										<i class="fa fa-fw fa-square-o checked"></i>'.$items->nom.'</label></div>';
									} else {
										echo '<div class="item_thematique"><label class="checkbox-custom"> 
										<input type="checkbox" name="thematiques[]" value="'.$items->id.'">
										<i class="fa fa-fw fa-square-o"></i>'.$items->nom.'</label></div>';
									}
								}
							} else {
								while( $items = $result->fetch() ) {
									echo '<div class="item_thematique"><label class="checkbox-custom"> 
										<input type="checkbox" name="thematiques[]" value="'.$items->id.'">
										<i class="fa fa-fw fa-square-o"></i>'.$items->nom.'</label></div>';
								}
							}
						?>
					<?php } ?>

					<?php if ($_POST["b2b-b2c"] == "b2b") { ?>
						<label class="checkbox-custom"> 
							<input type="checkbox" name="dirigeants" value="yes">
							<i class="fa fa-fw fa-square-o"></i> Fichier de dirigeants
						</label>

						<input class="form-control" type="text" name="categorie" placeholder="Renseigner des catégories (cat1, cat2, cat3...)"><br />
					<?php } ?>
				<?php } ?>



				<?php if (isset($_POST["comparaison"])) { ?>
					<h5>Contenu des fichiers</h5>
					<div class="radio">
						<label class="radio-custom">
							<input type="radio" name="download" value="0" checked="checked"> 
							<i class="fa fa-circle-o checked"></i> Tous les champs
						</label> 
					</div> 
					<div class="radio"> 
						<label class="radio-custom"> 
							<input type="radio" name="download" value="1"> 
							<i class="fa fa-circle-o"></i> Email seulement
						</label> 
					</div> 

					<?php if ($_POST["b2b-b2c"] == "b2c") { ?>
						<table id="comparaison_partenaire_programme">
							<tr>
								<td class="largeur">
									<label for="comp_partenaire">Comparer avec un partenaire</label>
									<select name="comp_partenaire" class="form-control input-lg" id="comp_partenaire" required>
										<option value="null"></option>
									<?php
										$requete = "SELECT id, nom FROM gestion_partenaire ORDER BY id ASC";
										$result = $bdd->executeQueryRequete($requete, 1);

										while( $items = $result->fetch() ) {
											echo '<option value="'.$items->id.'">'.$items->nom.'</option>';
										}
									?>
									</select>
								</td>
								<td></td>
								<td class="largeur">
									<label for="comp_programme">Comparer avec un programme</label>
									<select name="comp_programme" class="form-control input-lg" id="comp_programme" required>
										<!-- Ajouter une fonction qui renvoie les programmes -->
										<?php
										$requete = "SELECT id, nom FROM gestion_programme ORDER BY id ASC";
										$result = $bdd->executeQueryRequete($requete, 1);

										while( $items = $result->fetch() ) {
											echo '<option value="'.$items->id.'">'.$items->nom.'</option>';
										}
									?>
									</select>
								</td>
							</tr>
						</table>
					<?php } ?>
<!--
					<h5>Matching</h5>
					<select name="matching" class="form-control input-lg" id="matching_field" required>
						<option value="null"></option>
					</select>
-->
				<?php } ?>



				<?php if (isset($_POST["nettoyage"])) { ?>
					<table id="nettoyage">
						<tr>
							<td>
								<div class="checkbox">
									<label class="checkbox-custom"> 
										<input type="checkbox" name="filtre_invalide" value="1" checked="checked">
										<i class="fa fa-fw fa-square-o"></i> Emails invalides
									</label>
								</div>
							</td>
							<td>
								<div class="checkbox">
									<label class="checkbox-custom"> 
										<input type="checkbox" name="filtre_interdit" value="1" checked="checked">
										<i class="fa fa-fw fa-square-o"></i> Keywords interdits
									</label>
								</div>
							</td>
						</tr>

						<tr>
							<td>
								<div class="checkbox">
									<label class="checkbox-custom"> 
										<input type="checkbox" name="filtre_doublon" value="1" checked="checked">
										<i class="fa fa-fw fa-square-o"></i> Doublons
									</label>
								</div>
							</td>
							<td>
								<div class="checkbox">
									<label class="checkbox-custom"> 
										<input type="checkbox" name="filtre_blacklist" value="1" checked="checked">
										<i class="fa fa-fw fa-square-o"></i> Blacklist
									</label>
								</div>
							</td>
						</tr>

						<tr>
							<td>
								<div class="checkbox">
									<label class="checkbox-custom"> 
										<input type="checkbox" name="filtre_caracteres" value="1" checked="checked">
										<i class="fa fa-fw fa-square-o"></i> Moins de <?php echo $calc->info("lettres"); ?> caractères
									</label>
								</div>
							</td>
							<td>
								<div class="checkbox">
									<label class="checkbox-custom"> 
										<input type="checkbox" name="filtre_nombres" value="1" checked="checked">
										<i class="fa fa-fw fa-square-o"></i> Plus de <?php echo $calc->info("chiffres"); ?> chiffres
									</label>
								</div>
							</td>
						</tr>
					</table><br /><hr /><br />

					<h5>Nombre d'occurences</h5>
					<div class="col-md-6">
						<input class="form-control" type="text" name="inter-min" placeholder="Minimum" style="text-align:right;">
					</div>

					<div class="col-md-6">
						<input class="form-control" type="text" name="inter-max" placeholder="Maximum">
					</div><br /><hr /><br />
				<?php } ?>


				<br />
				<?php echo $upload->msg["form"]; ?>

				<div id="input_search_submit">
					<input type="submit" value="Valider" class="btn btn-info" />
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		printPart();

		$("#comp_partenaire option").click(function() {
			var data = { partenaire : $(this).val() };

			if ($(this).val() != "null") {
				$.ajax ({
				    url: "../controller/returnProgrammes.php",
				    type: "post",
				    data: data,
				    complete: function (xhr, result) {
				        if (result == "success") {
							var obj = jQuery.parseJSON( xhr.responseText );
							var result = "";

							$(obj).each(function(index) {
								result += '<option class="prog-tmp" value="'+obj[index].id+'">'+obj[index].nom+'</option>';
							});

							$(".prog-tmp").remove();
							$("#comp_programme").append(result);
				        }
				    }
				});
			}
		});

		$("#b2").change(function() {
			printPart();
		});

		$("#form_champs select.form-control").change(function() {
			$("#matching_field").append('<option value="'+$(this).val()+'">'+$(this).val()+'</option>');
		});
	});

	function printPart() {
		if ($("#b2_input").val() == 'b2b') {
			$("#comparaison_partenaire_programme").css("display", "none");
			$("#comparaison_partenaire_programme select option").removeAttr("selected");
		} else {
			$("#comparaison_partenaire_programme").css("display", "table");
		}
	}
</script>

<?php require_once("../footer.php"); ?>