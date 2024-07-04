<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>
<html>

<head>
	<?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Confirmation')); ?>


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
								<?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'BlackList', 'title' => 'Confirmation')); ?>
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
							<div class="card mb-lg-5">

								<div class="card-body tab-content text-center justify-content-center text-center mt-lg-3 mb-lg-5 ">
									<div class="tab-pane show active" id="formGuttersPreview" role="tabpanel" aria-labelledby="formGuttersPreview-tab" tabindex="0">

										<div id="content">
											<div class="row">
												<div class="col-xl-12 bg-light rounded p-2">
													<h5>
														<?php
														require_once("partials/class/Bdd.php");
														$bdd = new Bdd();

														$bl = explode("\n", $_POST["blacklist"]);

														$nbAdd = count($bl);

														switch ($nbAdd) {
															case 0:
																echo "Aucune adresse à blacklister.";
																break;

															case 1:
																echo "L'adresse: ";
																break;

															default:
																echo "Les adesses: ";
																break;
														}

														foreach ($bl as $mail) {
															$requete = "UPDATE b2c SET statut='U' WHERE email='$mail'";
															$bdd->executeSimpleExecRequete($requete);
															echo '<span class="label label-info">' . $mail . '</span> ';
														}

														switch ($nbAdd) {
															case 0:
																break;

															case 1:
																echo "est désormais blacklistée.";
																break;

															default:
																echo "sont désormais blacklistées.";
																break;
														}
														?>
													</h5>
													<div>
														<a href="./blacklist.php" class="border-0">
															<button class="form-control btn btn-lg btn-success w-50 mt-lg-2 mb-lg-4" type="submit">Retour</button>
														</a>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div> <!-- end col -->
					</div>
					<!--end row-->

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

	<script src="assets/libs/list.js/list.min.js"></script>
	<script src="assets/js/pages/file-manager.init.js"></script>
	<script src="assets/libs/multi.js/multi.min.js"></script>
	<!-- init js -->
	<script src="assets/js/pages/form-advanced.init.js"></script>
	<script src="assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js"></script>
	<!-- App js -->
	<script src="assets/js/app.js"></script>

</body>

</html>