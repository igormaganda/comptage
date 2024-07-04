<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>
<?php

//require_once("../../sdatamart/lib/system_load.php");
//user Authentication.
//authenticate_user('all');
//Pour débguer le code
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require("partials/class/Bdd.php");
require_once("partials/class/Calc.php");
require_once("partials/class/UploadNew.php");

$bdd    = new Bdd();
$calc   = new Calc();
$upload = new Upload($_POST, $_FILES['csv']);

if (isset($_POST["insert"])) $upload->uploadFile(0);
if (isset($_POST["update"])) $upload->uploadFile(1);
if (isset($_POST["comparaison"])) $upload->uploadFile(2);
if (isset($_POST["nettoyage"])) $upload->uploadFile(3);
?>


<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Importation')); ?>

    <!-- jsvectormap css -->

    <!--datatable css-->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <!--datatable responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">

    <?php include 'partials/head-css.php'; ?>
    <style>
        .requete_count td {
            word-wrap: break-word;
            /* ou overflow-wrap: break-word; */
        }
    </style>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include 'partials/menu.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Recherche', 'Importation' => 'Import de Data')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>

                    <div class="row">
						<div class="col-lg-12 mb-lg-5 d-flex justify-content-center">
							<div class="card mb-lg-5 w-75">
                                <div class="card-body">
                                    <div class="widget">
                                        <div class="widget-body innerAll inner-2x  d-flex justify-content-center  m-3">
                                            <form method="POST" action="import3.php" id="form_validation" class="row g-3">
												<div class="bg-light rounded pt-3">
													<?php echo $upload->msg["upload"]; ?>
												</div>
												

												<?php if (isset($_POST["insert"])) { ?>
													<div class="text-center w-100">
														<label class="form-check-input-label">
															<input type="checkbox" class="form-check-input" name="exclureFirstLine" value="yes">
															<i class="fa fa-fw fa-square-o"></i> Exclure la première ligne
														</label><br/>

														<?php if ($_POST["b2b-b2c"] == "b2c") { ?>

															<div class="row d-flex justify-content-center text-center mb-1" id="filetype">
																<div class="col-md-12">

																	<label for="programme" class="form-label text-muted">Programme</label>
																	<select name="programme" class="form-select input-lg mb-3" id="programme">
	
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
	
																		while ($items = $result->fetch()) {
																			echo '<option value="' . $items->id . '">' . $items->nom . ' (' . $items->partenaire . ')</option>';
																		}
																		?>
																	</select>
																</div>
															</div>



															<?php
															$requete = "SELECT id, Nom, Alias FROM gestion_thematique ORDER BY id ASC";
															$result = $bdd->executeQueryRequete($requete, 1);
															echo '<div class="row bg-light rounded p-2">';
															if (isset($thematiques)) {
																$themes = explode(",", $thematiques);

																while ($items = $result->fetch()) {
																	$is = false;

																	foreach ($themes as $value) {
																		if ($items->alias == $value) {
																			$is = true;
																		}
																	}

																	if ($is) {
																		echo '<div class="col-lg-3 text-start mb-1"><div class="item_thematique"><label class="checkbox-custom"> 
																	<input type="checkbox" class="form-check-input"  name="thematiques[]" value="' . $items->id . '" checked="checked">
																	<i class="fa fa-fw fa-square-o checked"></i>' . $items->nom . '</label></div></div>';
																	} else {
																		echo '<div class="col-lg-3 text-start mb-1"><div class="item_thematique"><label class="checkbox-custom"> 
																	<input type="checkbox" class="form-check-input"  name="thematiques[]" value="' . $items->id . '">
																	<i class="fa fa-fw fa-square-o"></i>' . $items->nom . '</label></div></div>';
																	}
																}
															} else {
																while ($items = $result->fetch()) {
																	echo '<div class="col-lg-3 text-start mb-1"><div class="item_thematique"><label class="checkbox-custom"> 
																	<input type="checkbox" class="form-check-input"  name="thematiques[]" value="' . $items->id . '">
																	<i class="fa fa-fw fa-square-o"></i>' . $items->nom . '</label></div></div>';
																}
															}
															echo '</div>';
														?>
														<?php } ?>


														<div class="justify-content-center text-center">
															<?php if ($_POST["b2b-b2c"] == "b2b") { ?>
																<div class=" row d-flex justify-content-center text-center" id="filetype">
																	<label for="pays" class="form-label text-muted">Pays </label>
																	<select name="pays" class="form-select input-lg mb-1" id="pays">
																		<option value="Null">Sélectionnez un pays</option>
																		<option value="AL">Albanie</option>
																		<option value="DE">Allemagne</option>
																		<option value="AD">Andorre</option>
																		<option value="AT">Autriche</option>
																		<option value="BY">Biélorussie</option>
																		<option value="BE">Belgique</option>
																		<option value="BA">Bosnie-Herzégovine</option>
																		<option value="BG">Bulgarie</option>
																		<option value="HR">Croatie</option>
																		<option value="DK">Danemark</option>
																		<option value="ES">Espagne</option>
																		<option value="EE">Estonie</option>
																		<option value="FI">Finlande</option>
																		<option value="FR">France</option>
																		<option value="GR">Grèce</option>
																		<option value="HU">Hongrie</option>
																		<option value="IE">Irlande</option>
																		<option value="IS">Islande</option>
																		<option value="IT">Italie</option>
																		<option value="XK">Kosovo</option>
																		<option value="LV">Lettonie</option>
																		<option value="LI">Liechtenstein</option>
																		<option value="LT">Lituanie</option>
																		<option value="LU">Luxembourg</option>
																		<option value="MK">Macédoine du Nord</option>
																		<option value="MT">Malte</option>
																		<option value="MD">Moldavie</option>
																		<option value="MC">Monaco</option>
																		<option value="ME">Monténégro</option>
																		<option value="NO">Norvège</option>
																		<option value="NL">Pays-Bas</option>
																		<option value="PL">Pologne</option>
																		<option value="PT">Portugal</option>
																		<option value="RO">Roumanie</option>
																		<option value="GB">Royaume-Uni</option>
																		<option value="RU">Russie</option>
																		<option value="SM">Saint-Marin</option>
																		<option value="RS">Serbie</option>
																		<option value="SK">Slovaquie</option>
																		<option value="SI">Slovénie</option>
																		<option value="SE">Suède</option>
																		<option value="CH">Suisse</option>
																		<option value="CZ">République tchèque</option>
																		<option value="UA">Ukraine</option>
																		<option value="VA">Cité du Vatican</option>

																	</select>
																	<label for="programme" class="form-label text-muted">Programme</label>
																	<select name="programme" class="form-select input-lg mb-3" id="programme">
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

																		while ($items = $result->fetch()) {
																			echo '<option value="' . $items->id . '">' . $items->nom . ' (' . $items->partenaire . ')</option>';
																		}
																		?>
																	</select>
																</div>

																<?php
																$requete = "SELECT id, Nom, Alias FROM gestion_thematique ORDER BY id ASC";
																$result = $bdd->executeQueryRequete($requete, 1);

																echo '<div class="row bg-light rounded p-2">';
																if (isset($thematiques)) {
																	$themes = explode(",", $thematiques);

																	while ($items = $result->fetch()) {
																		$is = false;

																		foreach ($themes as $value) {
																			if ($items->alias == $value) {
																				$is = true;
																			}
																		}

																		if ($is) {
																			echo '<div class="col-md-3 text-start mb-1"><div class="item_thematique"><label class="checkbox-custom"> 
																	<input type="checkbox" class="form-check-input"  name="thematiques[]" value="' . $items->id . '" checked="checked">
																	<i class="fa fa-fw fa-square-o checked"></i>' . $items->nom . '</label></div></div>';
																		} else {
																			echo '<div class="col-md-3 text-start mb-1"><div class="item_thematique"><label class="checkbox-custom"> 
																	<input type="checkbox" class="form-check-input"  name="thematiques[]" value="' . $items->id . '">
																	<i class="fa fa-fw fa-square-o"></i>' . $items->nom . '</label></div></div>';
																		}
																	}
																} else {
																	while ($items = $result->fetch()) {
																		echo '<div class="col-md-3 text-start mb-1"><div class="item_thematique"><label class="checkbox-custom"> 
																	<input type="checkbox" class="form-check-input"  name="thematiques[]" value="' . $items->id . '">
																	<i class="fa fa-fw fa-square-o"></i>' . $items->nom . '</label></div></div>';
																	}
																}
																echo '</div>';
																?>
															<?php } ?>
														</div>
													</div>
												<?php } ?>



												<?php if (isset($_POST["update"])) { ?>
													<?php if ($_POST["b2b-b2c"] == "b2c") { ?>
														<div class="d-flex justify-content-center text-center w-100">
															<table id="update_oc">
																<tr>
																	<td>
																		<div class="checkbox">
																			<label class="checkbox-custom">
																				<input type="checkbox" class="form-check-input" name="ouvreurs" value="yes">
																				<i class="fa fa-fw fa-square-o"></i> Ouvreurs
																			</label>
																		</div>
																	</td>
																	<td>
																		<div class="checkbox">
																			<label class="checkbox-custom">
																				<input type="checkbox" class="form-check-input" name="cliqueurs" value="yes">
																				<i class="fa fa-fw fa-square-o"></i> Cliqueurs
																			</label>
																		</div>
																	</td>
																</tr>
															</table>
														</div>

														<?php
														$requete = "SELECT id, Nom, Alias FROM gestion_thematique ORDER BY id ASC";
														$result = $bdd->executeQueryRequete($requete, 1);

														echo '<div class="w-100"><div class="row bg-light rounded p-2">';
														if (isset($thematiques)) {
															$themes = explode(",", $thematiques);

															while ($items = $result->fetch()) {
																$is = false;

																foreach ($themes as $value) {
																	if ($items->alias == $value) {
																		$is = true;
																	}
																}

																if ($is) {
																	echo '<div class="col-lg-3 text-start mb-1"><div class="item_thematique"><label class="checkbox-custom"> 
																<input type="checkbox" class="form-check-input"  name="thematiques[]" value="' . $items->id . '" checked="checked">
																<i class="fa fa-fw fa-square-o checked"></i>' . $items->nom . '</label></div></div>';
																} else {
																	echo '<div class="col-lg-3 text-start mb-1"><div class="item_thematique"><label class="checkbox-custom"> 
																<input type="checkbox" class="form-check-input"  name="thematiques[]" value="' . $items->id . '">
																<i class="fa fa-fw fa-square-o"></i>' . $items->nom . '</label></div></div>';
																}
															}
														} else {
															while ($items = $result->fetch()) {
																echo '<div class="col-lg-3 text-start mb-1"><div class="item_thematique"><label class="checkbox-custom"> 
																<input type="checkbox" class="form-check-input" name="thematiques[]" value="' . $items->id . '">
																<i class="fa fa-fw fa-square-o"></i>' . $items->nom . '</label></div></div>';
															}
														}
														echo '</div></div>';
														?>
													<?php } ?>

													<?php if ($_POST["b2b-b2c"] == "b2b") { ?>
														<div class="d-flex justify-content-center text-center w-100 ">
															<table id="update_oc">
																<tr>
																	<td>
																		<div class="checkbox">
																			<label class="checkbox-custom">
																				<input type="checkbox" class="form-check-input" name="ouvreurs" value="yes">
																				<i class="fa fa-fw fa-square-o"></i> Ouvreurs
																			</label>
																		</div>
																	</td>
																	<td>
																		<div class="checkbox">
																			<label class="checkbox-custom">
																				<input type="checkbox" class="form-check-input" name="cliqueurs" value="yes">
																				<i class="fa fa-fw fa-square-o"></i> Cliqueurs
																			</label>
																		</div>
																	</td>
																</tr>
																</table>
														</div>
														<?php
														$requete = "SELECT id, Nom, Alias FROM gestion_thematique ORDER BY id ASC";
														$result = $bdd->executeQueryRequete($requete, 1);

														echo '<div class=" w-100 mt-0"><div class="row bg-light rounded p-2">';
														if (isset($thematiques)) {
															$themes = explode(",", $thematiques);

															while ($items = $result->fetch()) {
																$is = false;

																foreach ($themes as $value) {
																	if ($items->alias == $value) {
																		$is = true;
																	}
																}
																if ($is) {
																	echo '<div class="col-lg-3 text-start mb-1"><div class="item_thematique"><label class="checkbox-custom"> 
																<input type="checkbox" class="form-check-input"  name="thematiques[]" value="' . $items->id . '" checked="checked">
																<i class="fa fa-fw fa-square-o checked"></i>' . $items->nom . '</label></div></div>';
																} else {
																	echo '<div class="col-lg-3 text-start mb-1"><div class="item_thematique"><label class="checkbox-custom"> 
																<input type="checkbox" class="form-check-input"  name="thematiques[]" value="' . $items->id . '">
																<i class="fa fa-fw fa-square-o"></i>' . $items->nom . '</label></div></div>';
																}
															}
														} else {
															while ($items = $result->fetch()) {
																echo '<div class="col-lg-3 text-start mb-1"><div class="item_thematique"><label class="checkbox-custom"> 
																<input type="checkbox" class="form-check-input"  name="thematiques[]" value="' . $items->id . '">
																<i class="fa fa-fw fa-square-o"></i>' . $items->nom . '</label></div></div>';
															}
														}
														echo '</div></div>';
														?>
													<?php } ?>
												<?php } ?>


												<?php if (isset($_POST["comparaison"])) { ?>
													<div class="w-100">

														<div class="row text-center m-2 p-1">
															<div class="col-md-12 text-center">
																<label class="text-muted" for="comp_partenaire">Contenu des fichiers</label>
															</div>

															<div class="col-md-6 col-sm-12">
																<div class="p-1">
																	<div class="form-check d-flex justify-content-center">
																		<input type="radio" class="form-check-input" name="download" value="0" checked="checked" id="download_all">
																		<label class="form-check-label" for="download_all"> Tous les champs</label>
																	</div>
																</div>
															</div>
															<div class="col-md-4 col-sm-12">
																<div class="p-1">
																	<div class="form-check d-flex justify-content-end">
																		<input type="radio" class="form-check-input" name="download" value="1" id="download_email">
																		<label class="form-check-label" for="download_email"> Email seulement</label>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center mb-3 bg-light rounded p-2">
															<div class="col-md-12 text-center">
																<label class="text-muted" for="comp_programme">Enrichir le(s) champ(s)</label>
															</div>

															<div class="col-md-2 col-sm-4">
																<div class="p-1">
																	<label class="checkbox-custom">
																		<input type="checkbox" class="form-check-input" name="enrichies[]" value="dateofbirth">
																		<i class="fa fa-fw fa-square-o"></i> DOB
																	</label>
																</div>
															</div>
															<div class="col-md-2 col-sm-4">
																<div class="p-1">
																	<label class="checkbox-custom">
																		<input type="checkbox" class="form-check-input" name="enrichies[]" value="pays">
																		<i class="fa fa-fw fa-square-o"></i> Pays
																	</label>
																</div>
															</div>
															<div class="col-md-2 col-sm-4">
																<div class="p-1">
																	<label class="checkbox-custom">
																		<input type="checkbox" class="form-check-input" name="enrichies[]" value="cp">
																		<i class="fa fa-fw fa-square-o"></i> Code postal
																	</label>
																</div>
															</div>
															<div class="col-md-2 col-sm-4">
																<div class="p-1">
																	<label class="checkbox-custom">
																		<input type="checkbox" class="form-check-input" name="enrichies[]" value="ville">
																		<i class="fa fa-fw fa-square-o"></i> Ville
																	</label>
																</div>
															</div>
															<div class="col-md-2 col-sm-4">
																<div class="p-1">
																	<label class="checkbox-custom">
																		<input type="checkbox" class="form-check-input" name="enrichies[]" value="gender">
																		<i class="fa fa-fw fa-square-o"></i> Civilité
																	</label>
																</div>
															</div>
															<div class="col-md-2 col-sm-4">
																<div class="p-1">
																	<label class="checkbox-custom">
																		<input type="checkbox" class="form-check-input" name="enrichies[]" value="tel_mobile">
																		<i class="fa fa-fw fa-square-o"></i> Tél mobile
																	</label>
																</div>
															</div>
														</div>
														
														<?php if ($_POST["b2b-b2c"] == "b2c") { ?>
															<div class="row g-3 d-flex justify-content-center text-center w-100 mb-3">
																<div class="col-lg-6 w-50">
																	<div class="p-1 border-rounded">
																		<label class="text-muted" for="comp_partenaire">Comparer avec un partenaire</label>
																		<select name="comp_partenaire" class="form-control input-lg " id="comp_partenaire" required>
																			<option value="null"></option>
																			<?php
																			$requete = "SELECT id, nom FROM gestion_partenaire ORDER BY id ASC";
																			$result = $bdd->executeQueryRequete($requete, 1);
														
																			while ($items = $result->fetch()) {
																				echo '<option value="' . $items->id . '">' . $items->nom . '</option>';
																			}
																			?>
																		</select>
																	</div>
																</div>
																<div class="col-lg-6 w-50">
																	<div class="p-1 border-rounded">
																		<label class="text-muted" for="comp_programme">Comparer avec un programme</label>
																		<select name="comp_programme" class="form-control input-lg " id="comp_programme" required>
																			<option value="null"></option>
																		</select>
																	</div>
																</div>
															</div>
														<?php } ?>
													</div>
												<?php } ?>



												<?php if (isset($_POST["nettoyage"])) { ?>
													<div>
														<div class="row d-flex justify-content-center mt-3">
															<div class="col-lg-2 col-sm-4">
																<div class="p-1 checkbox">
																	<label class="checkbox-custom">
																		<input type="checkbox" class="form-check-input" name="filtre_invalide" value="1" checked="checked">
																		<i class="fa fa-fw fa-square-o"></i> Emails invalides
																	</label>
																</div>
															</div>
															<div class="col-lg-2 col-sm-4">
																<div class="p-1 checkbox">
																	<label class="checkbox-custom">
																		<input type="checkbox" class="form-check-input" name="filtre_interdit" value="1" checked="checked">
																		<i class="fa fa-fw fa-square-o"></i> Keywords interdits
																	</label>
																</div>
															</div>
															<div class="col-lg-2 col-sm-4">
																<div class="p-1 checkbox">
																	<label class="checkbox-custom">
																		<input type="checkbox" class="form-check-input" name="filtre_doublon" value="1" checked="checked">
																		<i class="fa fa-fw fa-square-o"></i> Doublons
																	</label>
																</div>
															</div>
															<div class="col-lg-2 col-sm-4">
																<div class="p-1 checkbox">
																	<label class="checkbox-custom">
																		<input type="checkbox" name="filtre_blacklist" value="1" checked="checked">
																		<i class="fa fa-fw fa-square-o"></i> Blacklist
																	</label>
																</div>
															</div>
															<div class="col-lg-2 col-sm-4">
																<div class="p-1 checkbox">
																	<label class="checkbox-custom">
																		<input type="checkbox" name="filtre_caracteres" value="1" checked="checked">
																		<i class="fa fa-fw fa-square-o"></i> Moins de <?php echo $calc->info("lettres"); ?> caractères
																	</label>
																</div>
															</div>
															<div class="col-lg-2 col-sm-4">
																<div class="p-1 checkbox">
																	<label class="checkbox-custom">
																		<input type="checkbox" name="filtre_nombres" value="1" checked="checked">
																		<i class="fa fa-fw fa-square-o"></i> Plus de <?php echo $calc->info("chiffres"); ?> chiffres
																	</label>
																</div>
															</div>
														
															<div class="col-lg-12 text-center">
																<p class="text-muted">Nombre d'occurences</p>
															</div>
															<div class="col-lg-6 w-50">
																<input class="form-control" type="text" name="inter-min" placeholder="Minimum" style="text-align:right;">
															</div>

															<div class="col-lg-6  w-50">
																<input class="form-control" type="text" name="inter-max" placeholder="Maximum">
															</div>
														</div>
													</div>
												<?php } ?>


												<br />
												<?php echo $upload->msg["form"]; ?>
												<div id="input_search_submit" class="mt-4 text-center">
													<input type="submit" value="Valider" class="form-control btn btn-lg btn-info" />
												</div>

											</form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'partials/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?php include 'partials/vendor-scripts.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script type="text/javascript">
        $(document).ready(function() {
            printPart();

            $("#comp_partenaire option").click(function() {
                var data = {
                    partenaire: $(this).val()
                };

                if ($(this).val() != "null") {
                    $.ajax({
                        url: "../controller/returnProgrammes.php",
                        type: "post",
                        data: data,
                        complete: function(xhr, result) {
                            if (result == "success") {
                                var obj = jQuery.parseJSON(xhr.responseText);
                                var result = "";

                                $(obj).each(function(index) {
                                    result += '<option class="prog-tmp" value="' + obj[index].id + '">' + obj[index].nom + '</option>';
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

            $("#form_champs select.form-select").change(function() {
                $("#matching_field").append('<option value="' + $(this).val() + '">' + $(this).val() + '</option>');
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
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>