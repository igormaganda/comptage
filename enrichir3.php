<?php //include 'partials/session.php'; 
?>
<?php include 'partials/main.php'; ?>

<?php

// require_once("../../../sdatamart/lib/system_load.php");
// authenticate_user('all');
require("partials/class/Bdd.php");
require_once("partials/class/Insert[enrichir].php");

$bdd = new Bdd();
?>

<head>

	<?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Enrichir')); ?>

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
      .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9; 
      }
      .table-striped tbody tr:nth-of-type(even) {
        background-color: #e9ecef; 
      }
      .table-striped tbody tr:nth-of-type(3n+1) {
        background-color: #f1f8ff;
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
								<?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Enrichir', 'title' => 'Enrichissement de data')); ?>
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
						<div class="col-xxl-12">
							<div class="card">

								<div class="card-body tab-content text-center justify-content-center  m-3 ">
									<div class="tab-pane show active" id="formGuttersPreview" role="tabpanel" aria-labelledby="formGuttersPreview-tab" tabindex="0">

                                    <divt class="table-responsive">
                                        <table class="table table-custom align-middle table-borderless table-striped table-custom-effect table-nowrap mb-0">
                                            <thead class="pr-">
                                                <tr>
                                                    <th class="cursor-pointer text-start card-title" data-sort="info">Informations</th>
                                                    <th class="text-end card-title ">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">

                                                <tr>
                                                    <td class="text-start"><strong>101 dans le fichier</strong>.</td>
                                                    <td>
                                                        <div class="flex-shrink-0 text-end">
                                                            <button class="btn btn-info" onclick=""><i class="bi bi-save align-baseline"></i>Télécharger</button>
															<button class="btn btn-danger" onclick="">X</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start"><strong>34 Civilité enrichies</strong>.</td>
                                                    <td>
                                                        <div class="flex-shrink-0 text-end">
                                                            <button class="btn btn-info" onclick=""><i class="bi bi-save align-baseline"></i>Télécharger</button>
															<button class="btn btn-danger" onclick="">X</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start"><strong>37 Prénom enrichies</strong>.</td>
                                                    <td>
                                                        <div class="flex-shrink-0 text-end">
                                                            <button class="btn btn-info" onclick=""><i class="bi bi-save align-baseline"></i>Télécharger</button>
															<button class="btn btn-danger" onclick="">X</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start"><strong>100 Lignes enrichies</strong>.</td>
                                                    <td>
                                                        <div class="flex-shrink-0 text-end">
                                                            <button class="btn btn-info" onclick=""><i class="bi bi-save align-baseline"></i>Télécharger</button>
															<button class="btn btn-danger" onclick="">X</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start"><strong>205 items enrichies</strong>.</td>
                                                    <td>
                                                        <div class="flex-shrink-0 text-end">
                                                            <button class="btn btn-info" onclick=""><i class="bi bi-save align-baseline"></i>Télécharger</button>
															<button class="btn btn-danger" onclick="">X</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>

										<!-- Il s'agit de la fonctionalité php qui devrait s'exécuter pour avoir un affichage comme ci dessus -->
										<?php
										$parsefile = new Insert($_POST);
										// var_dump($_POST);
										?>

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

	<script src="assets/js/pages/form-advanced.init.js"></script>
	<!-- autocomplete js -->

	<!-- App js -->

	<script type="text/javascript">
		$(document).ready(function() {
			$("#accordion").appendTo("#content");
		});
	</script>
	<script src="/<?php echo $path; ?>/js/prism/prism.js" type="text/javascript"></script>

	<script src="assets/js/app.js"></script>


</body>

</html>