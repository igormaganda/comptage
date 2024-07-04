<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php require("partials/class/Bdd.php"); 
	require_once("partials/class/Calc.php");
?>

<?php require("partials/class/Printer.php"); ?>

<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Dashboard')); ?>

    <!-- jsvectormap css -->
    
<!--datatable css-->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css" >
    <!--datatable responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.bootstrap.min.css" >

    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">

    <?php include 'partials/head-css.php'; ?>
    <style>
    .requete_count td {
        word-wrap: break-word; /* ou overflow-wrap: break-word; */
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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Recherche', 'title' => 'Liste des recherches')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                    <div class="modal fade" id="modal_export" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">
								<form method="POST" action="export.php" id="modal_form_export">
									<div class="modal-header">
										<h5 class="modal-title" id="myExtraLargeModalLabel">Choix des champs </h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
											<input type="hidden" name="number" value="" id="id" />
											<input type="hidden" name="nom" value="" id="nom" />
										<div class="row">
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="email" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Email
													</label>
												</div>
											</div>
                                            <div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="email_md5" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Email MD5
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="firstname" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Prénom
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="lastname" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Nom
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="dateofbirth" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Date de naissance
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="agegroupe" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Groupe d'âge
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="adresse_1" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Adresse
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="adresse_2" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Complément d'adresse
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="pays" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Pays
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="cp" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Code postal
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="ville" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Ville
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="region" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Région
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="gender" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Civilité
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="title" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Titre
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="fonction" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Fonction
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="csp" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Catégorie Socio Professionnelle
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="parent" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Parent
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="proprietaire" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Propriétaire
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="animaux" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Animaux
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="tel_mobile" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Téléphone mobile
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="tel_fixe" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Téléphone fixe
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="tel_fax" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Fax
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="date_in" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Date d'inscription
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="last_date_r" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Date du dernier email reçu
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="last_date_o" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Date du dernier email ouvert
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="last_date_c" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Date du dernier email cliqué
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="last_date_s" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Date du dernier email envoyé
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="blacklist" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Blacklisté
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="statut" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Statut
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="dep" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Département
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="tranche" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Tranche d'âge
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="nettoyage_date" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Date du nettoyage
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="nettoyage_result" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Résultat du nettoyage
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="troncon" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Troncon
													</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 my-2">
												<label for="orderby" class="form-label mb-1"></label>
												<select name="orderby" id="orderby" class="form-select">
													<option value="">Ordonner par</option>
													<option value="email">Email</option>
												</select>
											</div>
											<div class="col-md-4 my-2">
												<label for="" class="form-label mb-1"></label>
												<select name="asc" id="asc" class="form-select">
													<option value="rand">Aléatoire</option>
													<option value="asc">Croissant</option>
													<option value="desc">Décroissant</option>
												</select>
											</div>
											<div class="col-md-4 my-2">
												<label for="" class="form-label mb-1"></label>
												<input type="text" name="admin" id="admin" class="form-control" placeholder="admin" />
											</div>
										</div>
									</div>
										<div class="modal-footer">
											<a href="javascript:void(0);" class="btn btn-link link-danger fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>Fermer</a>
											<button type="submit" class="btn btn-success btn-sm btn-export">Exporter</button>
										</div>
								</form>
							</div>
						</div>
					</div>

	<!-- Modal -->
					<div class="modal fade" id="modal_groupby" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">
								<form method="POST" action="exportGroup.php" id="modal_form_export_group">
									<div class="modal-header">
										<h5 class="modal-title" id="myExtraLargeModalLabel">Choix des champs </h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<input type="hidden" name="number" value="" id="idGroup" />
										<input type="hidden" name="nom" value="" id="nomGroup" />
										<div class="row">
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="email" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Email
													</label>
												</div>
											</div>
                                            <div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="email_md5" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Email MD5
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="firstname" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Prénom
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="lastname" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Nom
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="dateofbirth" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Date de naissance
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="agegroupe" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Groupe d'âge
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="adresse_1" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Adresse
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="adresse_2" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Complément d'adresse
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="pays" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Pays
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="cp" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Code postal
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="ville" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Ville
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="region" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Région
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="gender" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Civilité
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="title" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Titre
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="fonction" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Fonction
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="csp" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Catégorie Socio Professionnelle
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="parent" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Parent
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="proprietaire" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Propriétaire
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="animaux" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Animaux
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="tel_mobile" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Téléphone mobile
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="tel_fixe" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Téléphone fixe
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="tel_fax" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Fax
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="date_in" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Date d'inscription
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="last_date_r" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Date du dernier email reçu
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="last_date_o" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Date du dernier email ouvert
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="last_date_c" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Date du dernier email cliqué
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="last_date_s" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Date du dernier email envoyé
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="blacklist" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Blacklisté
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="statut" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Statut
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="dep" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Département
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="tranche" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Tranche d'âge
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="nettoyage_date" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Date du nettoyage
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="nettoyage_result" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
														Résultat du nettoyage
													</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check mb-2">
													<input type="checkbox" name="fields[]" value="troncon" class="form-check-input">
													<label class="form-check-label" for="formCheck1">
													Troncon
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<a href="javascript:void(0);" class="btn btn-link link-danger fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>Fermer</a>
										<button type="submit" class="btn btn-success btn-sm btn-export">Exporter</button>
									</div>
								</form>
							</div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Resultats des recherches b2b</h5>
                                </div>
                                <div class="card-body">
                                    <div class="widget">
                                        <div class="widget-body innerAll inner-2x">
                                            <?php
                                                $display = new Printer();
                                                $display->printCount();
                                            ?>
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

	<script src="assets/js/script.js"></script>

    <!--datatable js-->
    <script src="assets/js/pages/jquery.dataTables.min.js"></script>
    <script src="assets/js/pages/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/pages/dataTables.responsive.min.js"></script>
    <script src="assets/js/pages/dataTables.buttons.min.js"></script>

    <script src="assets/js/pages/datatables.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>