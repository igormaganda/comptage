<?php include 'partials/session.php';
?>
<?php include 'partials/main.php'; ?>

<?php
require("partials/class/Bdd.php");

$bdd = new Bdd();
?>

<head>
	<?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Exclusion')); ?>


	<link rel="stylesheet" href="assets/libs/nouislider/nouislider.min.css">
	<!-- Sweet Alert css-->
	<link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<!-- dropzone css -->
	<link href="assets/libs/dropzone/dropzone.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" type="text/css" href="assets/libs/multi.js/multi.min.css">
	<!-- autocomplete css -->
	<link rel="stylesheet" href="assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css">

	<?php include 'partials/head-css.php'; ?>

</head>

<style>
	.scrollable-content1 {
		max-height: 890px;
		overflow-y: auto;
	}
	.choices__inner {
		max-height: 100px;
		overflow-y: auto;
	}
</style>

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
								<?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Exclusion', 'title' => 'Exclusion de mail')); ?>
							</div>
							<!--end col-->
							<div class="col-md-auto ms-auto">
								<?php include 'partials/customizer.php'; ?>
							</div>
							<!--end col-->
						</div>
						<!--end row-->
					</div>


					<div class="row">
						<div class="col-xxl-12 mb-lg-5">
							<div id="content">
								<?php
								if (isset($_GET["u"])) {
									echo '<div class="alert alert-success alert-dismissable bdd_action"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Sauvegarde effectuée.</div>';
								}
								?>

								<form method="POST" action="exclusion_a.php" id="form_blacklist_gestion" name="form_blacklist_gestion" class="form-horizontal" role="form">
									<div class="row">
										<div id="left-card" class="col-xl-6">
											<div class="card">
												<div class="card-header">
													<h4 class="card-title mb-0">Top domaine</h4>
												</div><!-- end card header -->

												<div class="card-body">
													<div id="top-domain-content" class="scrollable-content1">
														<?php
														$requete = "SELECT Top_domain FROM info LIMIT 1";
														$result = $bdd->executeQueryRequete($requete, 1);

														$first = true;
														while ($top_dom = $result->fetch()) {
															$domaines = explode(";", $top_dom->top_domain);
															foreach ($domaines as $couple) {
																$rep = explode(",", $couple);

																echo '<div class="row g-1 top-domain-wb">
																	<div class="col-lg-5 mb-1"><input type="text" name="top-domain-name[]" class="form-control" value="' . $rep[0] . '" /></div>
																	<div class="col-lg-5 mb-1"><input type="text" name="top-domain-percent[]" class="form-control percent" value="' . $rep[1] . '" /></div>
																	<span class="col-lg btn btn-danger rm-item m-1"><i class="bi bi-dash"></i></span>';
																if ($first) echo '<span class="col-lg btn btn-success add-item m-1"><i class="bi bi-plus"></i></span>';
																echo '</div>';

																$first = false;
															}
														}
														?>
													</div>
												</div><!-- end card-body -->
											</div><!-- end card -->
										</div>
										<div id="right-card" class="col-xl-6">
											<div class="row">
												<div class="col-xl-12">
													<div class="card">
														<div class="card-header">
															<h4 class="card-title mb-0">Tronçon</h4>
														</div><!-- end card header -->
														<div class="card-body">
															<div id="other-content" class="row">
																<div class="col-12">
																	<label for="nombre_troncon" class="form-label">Nombre d'adresses par tronçon:</label>
																	<input class="form-control" name="troncon" id="nombre_troncon" type="text">
																</div><!-- end col -->
															</div><!-- end row -->
														</div><!-- end card-body -->

														<div class="card-header">
															<h4 class="card-title mb-0">Exclusion</h4>
														</div><!-- end card header -->
														<div class="card-body">

															<div class="row">
																<label for="chiffres" class="col-xl-6 control-label">Exclure les mails de plus de </label>
																<div class="col-xl">
																	<select name="chiffres" class="form-select" id="chiffres"><?php
																																$requete = "SELECT Chiffres FROM info LIMIT 1";
																																$result = $bdd->executeQueryRequete($requete, 1);

																																while ($chiffres = $result->fetch()) {
																																	for ($i = 1; $i <= 20; $i++) {
																																		if ($i == $chiffres->chiffres) {
																																			echo '<option value="' . $i . '" selected>' . $i . '</option>';
																																		} else {
																																			echo '<option value="' . $i . '">' . $i . '</option>';
																																		}
																																	}
																																}
																																?></select>
																</div>
																<label for="chiffres" class="col-xl control-label"> chiffres.</label>
															</div>
															<br />
															<div class="row">
																<label for="lettres" class="col-xl-6 control-label">Exclure les mails qui présentent une suite supérieur à</label>
																<div class="col-xl">
																	<select name="lettres" class="form-select" id="lettres"><?php
																															$requete = "SELECT Lettres FROM info LIMIT 1";
																															$result = $bdd->executeQueryRequete($requete, 1);

																															while ($lettres = $result->fetch()) {
																																for ($i = 1; $i <= 20; $i++) {
																																	if ($i == $lettres->lettres) {
																																		echo '<option value="' . $i . '" selected>' . $i . '</option>';
																																	} else {
																																		echo '<option value="' . $i . '">' . $i . '</option>';
																																	}
																																}
																															}
																															?></select>
																</div>
																<label for="lettres" class="col-xl control-label"> lettres.</label>
															</div>
															<br />
															<div class="row">
																<div class="col-12">
																	<div class="mb-2 ">
																		<label for="keywords-content" class="form-label">Exclure les mails comportant les suites de caractères:</label>
																		<input class="form-control scrollable-content2" name="keywords" id="keywords-content" data-choices data-choices-removeItem type="text">
																	</div>
																</div><!-- end col -->
															</div><!-- end row -->
														</div>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-xl-12">
													<div class="card">
														<div class="card-header">
															<h4 class="card-title mb-0">Prénom</h4>
														</div><!-- end card header -->
														<div class="card-body">
															<div class="row">
																<div class="col-xl-6">
																	<label for="hommes" class="control-label">Prénoms hommes: (séparer les prénoms d'une virgule)</label>
																	<textarea name="hommes" class="form-control" rows="5" id="hommes" style="resize: none;"><?php
																																							$requete = "SELECT Hommes FROM info LIMIT 1";
																																							$result = $bdd->executeQueryRequete($requete, 1);

																																							while ($hommes = $result->fetch()) {
																																								echo trim($hommes->hommes);
																																							}
																																							?></textarea>
																</div>
																<div class="col-xl-6">
																	<label for="femmes" class="control-label">Prénoms femmes: (séparer les prénoms d'une virgule)</label>
																	<textarea name="femmes" class="form-control" rows="5" id="femmes" style="resize: none;"><?php
																																							$requete = "SELECT Femmes FROM info LIMIT 1";
																																							$result = $bdd->executeQueryRequete($requete, 1);

																																							while ($femmes = $result->fetch()) {
																																								echo trim($femmes->femmes);
																																							}
																																							?></textarea>
																</div>
															</div><!-- end row -->
														</div><!-- end card-body -->

														<div class="card-header">
															<h4 class="card-title mb-0">Management Dream Team</h4>
														</div><!-- end card header -->
														<div class="card-body">
															<div class="row">
																<div class="col-xl-12">
																	<label for="team" class="control-label">E-Mails de controle des campagnes envoyées: (retour à la ligne entre chaque e-mail)</label>
																	<textarea name="team" class="form-control" rows="5" id="team" style="resize: none;"><?php
																																						$requete = "SELECT Team FROM info LIMIT 1";
																																						$result = $bdd->executeQueryRequete($requete, 1);

																																						while ($team = $result->fetch()) {
																																							$all = explode(";", $team->team);
																																							foreach ($all as $value) {
																																								echo $value . "\n";
																																							}
																																						}
																																						?></textarea>
																</div><!-- end col -->
															</div><!-- end row -->
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-12">
											<div id="input_search_submit" class="d-flex justify-content-end">
												<button class="form-control btn btn-lg btn-info w-100 mt-lg-2 mb-lg-4" type="submit">Envoyer</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div> <!-- end col -->
					</div><!--end row-->

				</div><!-- container-fluid -->
			</div><!-- End Page-content -->


			<?php include 'partials/footer.php'; ?>
		</div>
		<!-- end main content-->

	</div>
	<!-- END layout-wrapper -->

	<?php include 'partials/vendor-scripts.php'; ?>

	<?php
	$requete = "SELECT Keywords_spam FROM info LIMIT 1";
	$result = $bdd->executeQueryRequete($requete, 1);

	while ($keywords = $result->fetch()) {
		$words = explode(",", $keywords->keywords_spam);
		$content = "";
		foreach ($words as $word) {
			$content .= '<li class="Token" data-value="' . trim($word) . '"><a class="Close">×</a><span>' . trim($word) . '</span></li>';
		}
	}
	?>
	<script src="assets/js/pages/form-advanced.init.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			$(function() {
				$("#top-domain-content").on('click', '.add-item', function() {
					$("#top-domain-content").append('<div class="row g-1 top-domain-wb"><div class="col-lg-5 mb-1"><input type="text" name="top-domain-name[]" class="form-control" /></div><div class="col-lg-5 mb-1"><input type="text" name="top-domain-percent[]" class="form-control" /></div><span class="col-lg btn btn-danger rm-item m-1"><i class="bi bi-dash"></i></span></div>');
				});

				$("#top-domain-content").on('click', '.rm-item', function() {
					$(this).parent().remove();
				});



				$('select#tokenize_defaults').tokenize();
				$(".TokensContainer").prepend('<?php echo $content; ?>');

				$(".TokensContainer").on('click', '.Close', function() {
					$(this).parent().remove();
				});


				$(".percent").on('keyup', function() {
					var total = 0;
					$(".percent").each(function() {
						if (!isNaN(parseInt($(this).val()))) {
							total += parseInt($(this).val());
						}
					});

					if (total < 100) {
						var color = "orange";
					} else if (total == 100) {
						var color = "green";
					} else {
						var color = "red";
					}

					$("#percent-print").html('<span style="color:' + color + '">' + total + '</span> %');
				});
			});


			$('#form_blacklist_gestion').on('submit', function(e) {
				e.preventDefault();

				var keywords = '';
				$("div.tokenize-sample.Tokenize ul.TokensContainer li.Token span").each(function() {
					keywords += keywords == "" ? $(this).text() : "," + $(this).text();
				});

				$("#keywords-content").val(keywords);

				if ($("#percent-print span").text() <= 100) {
					document.form_blacklist_gestion.submit();
				} else {
					alert("Top domaine est supérieur à 100% !\nMerci de corriger ça.");
				}
			});

			console.log($(".TokensContainer").height());
		});
	</script>
	
	<script src="assets/js/app.js"></script>


</body>

</html>