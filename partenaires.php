<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php require("partials/class/Bdd.php"); ?>

<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Partenaires')); ?>
    <!--datatable css-->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <!--datatable responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css">

    <?php include 'partials/head-css.php'; ?>

</head>
<style>
    .requete_count td {
        word-wrap: break-word;
        /* ou overflow-wrap: break-word; */
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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Gestion', 'title' => 'Partenaires')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                                <?php include 'partials/customizer.php'; ?>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="card-title flex-grow-1 mb-0">Liste des partenaires</h5>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#modal_new_part">
                                            <i class="bi bi-plus align-baseline"></i> Ajouter partenaire
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="widget">
                                        <div class="widget-body innerAll inner-2x">
                                            <?php
                                            $selectKeywords = new Bdd();

                                            $requete = "SELECT id, Nom FROM gestion_partenaire ORDER BY id";
                                            $result = $selectKeywords->executeQueryRequete($requete, 1);

                                            echo '<table id="scroll-horizontal" class="table table-bordered table-striped table-hover align-middle" style="width:100%">
                                                <thead class="bg-gray">
                                                    <tr>
                                                        <th style="text-align:start; width: auto;">Partenaire</th>
                                                        <th style="text-align:start; width: 135px">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';

                                            while ($partenaire = $result->fetch()) {
                                                echo '<tr id="nbpart' . $partenaire->id . '">';
                                                echo '<td style="text-align:start; width: auto;">' . $partenaire->nom . '</td>';
                                                echo '<td style="text-align:center; width: 135px;" class="action_count" style="text-align:center;">
                                                    <button class=" text-muted btn btn-success btn-sm" onclick=""><i class="bi bi-pencil"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm btn-sup" onclick="rmPartenaire(' . $partenaire->id . ')"><i class="bx bxs-trash"></i></button>
                                                </td>';
                                                echo '</tr>';
                                            }
                                            echo '</tbody></table>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <!-- Modal -->
                    <div class="modal fade" id="modal_new_part" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header mb-4">
                                    <h4 class="modal-title" id="exampleModalLongTitle">Ajouter un nouveau partenaire</h4>
                                    <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="POST" action="partenaires_a.php" name="form_categorie" id="form_categorie">
                                    <div class="modal-body">
                                        <div class="widget-body">
                                            <input name="prog_part" type="text" id="prog_name" class="form-control input-lg" placeholder="Nouveau partenaire">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-light" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-info">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal end -->


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
    <script src="assets/js/pages/jquery.dataTables.min.js"></script>
    <script src="assets/js/pages/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/pages/dataTables.responsive.min.js"></script>
    <script src="assets/js/pages/dataTables.buttons.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>