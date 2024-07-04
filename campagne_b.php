<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php
require_once("partials/class/Bdd.php");
require_once("./partials/class/Printer.php");
?>

<head>
    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Campagne')); ?>

    <link rel="stylesheet" href="assets/libs/nouislider/nouislider.min.css">
    <!-- Sweet Alert css-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- dropzone css -->
    <link href="assets/libs/dropzone/dropzone.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="assets/libs/multi.js/multi.min.css">
    <!-- autocomplete css -->
    <link rel="stylesheet" href="assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
                        <div class="row align-items-center gy-3">
                            <div class="col-md">
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Campagne', 'title' => 'Liste des envois')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-xl col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <p class="fs-md mb-0 flex-grow-1">Total Campagnes</p>
                                        <p class="text-success mb-0"><i class="bi bi-arrow-up align-baseline"></i> 000%</p>
                                    </div>

                                    <h3 class="fw-semibold mb-0"><span class="counter-value" data-target="10875">0</span> </h3>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <p class="fs-md mb-0 flex-grow-1">B2B</p>
                                        <p class="text-danger mb-0"><i class="bi bi-arrow-down align-baseline"></i> 000%</p>
                                    </div>

                                    <h3 class="fw-semibold mb-0"><span class="counter-value" data-target="7451">0</span> </h3>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <p class="fs-md mb-0 flex-grow-1">B2C</p>
                                        <p class="text-success mb-0"><i class="bi bi-arrow-up align-baseline"></i>000%</p>
                                    </div>

                                    <h3 class="fw-semibold mb-0"><span class="counter-value" data-target="1254">0</span> </h3>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <p class="fs-md mb-0 flex-grow-1">Volume total envoyé</p>
                                        <p class="text-success mb-0"><i class="bi bi-arrow-up align-baseline"></i> 000%</p>
                                    </div>

                                    <h3 class="fw-semibold mb-0"><span class="counter-value" data-target="1254">0</span> </h3>
                                </div>
                            </div>
                        </div><!--end col-->

                    </div><!--end row-->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" id="customerList">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="card-title flex-grow-1 mb-0">Liste des envois</h5>
                                    <div class="flex-shrink-0">
                                        <button class="btn btn-subtle-danger d-none" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        <button class="btn btn-primary add-btn" onclick="redirigerVersLien()"><i class="bi bi-plus align-baseline"></i>Ajouter campagne</button>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <div class="table-responsive table-card">
                                        <table class="table table-custom align-middle table-borderless table-custom-effect table-nowrap mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="option" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th class="sort cursor-pointer" data-sort="name">Annonceur</th>
                                                    <th class="sort cursor-pointer" data-sort="company_name">Campagne</th>
                                                    <th class="sort cursor-pointer" data-sort="email_id">Volume</th>
                                                    <th class="sort cursor-pointer" data-sort="date">Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <?php
                                                $display = new Printer();
                                                $display->printCampagne();
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center py-4">
                                            <div class="avatar-md mx-auto mb-4">
                                                <div class="avatar-title bg-light text-primary rounded-circle fs-4xl">
                                                    <i class="bi bi-search"></i>
                                                </div>
                                            </div>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We have searched more than 150+ customers We did not find any customers for you search.</p>
                                        </div>
                                    </div>
                                    <!-- end noresult -->
                                    <div class="row mt-3 align-items-center" id="pagination-element">
                                        <div class="col-sm">
                                            <div class="text-muted text-center text-sm-start">
                                                Showing <span class="fw-semibold">10</span> of <span class="fw-semibold">35</span> Results
                                            </div>
                                        </div>

                                        <div class="col-sm-auto mt-3 mt-sm-0">
                                            <div class="pagination-wrap hstack gap-2 justify-content-center">
                                                <a class="page-item pagination-prev disabled" href="javascript:void(0)">Previous</a>
                                                <ul class="pagination listjs-pagination mb-0"></ul>
                                                <a class="page-item pagination-next" href="javascript:void(0)">Next</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end pagination-element -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal_split" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header mb-4">
                                    <h4 class="modal-title" id="myLargeModalLabel">Détails de la campagne</h4>
                                    <button type="button" class="close bg-danger" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                </div>

                                <div class="modal-body" style="max-height: 760px; overflow-y: auto;">
                                    <div id="modal-cmp-detail">
                                        <div id="form-envoi-multi">
                                            <form method="POST" action="#" name="form_envoi" id="form_envoi">
                                                <div class="row bg-light rounded p-1 mb-2 justify-content-center">
                                                    <input name="form-cmp-0 " type="hidden" id="form_envoi_id">
                                                    <div class="col-xxl">
                                                        <span>Envoyer</span>
                                                        <select name="form-cmp-1" class="form-select">
                                                            <option value="cmp1">toutes les campagnes</option>
                                                            <option value="cmp2">les campagnes non envoyées</option>
                                                            <option value="cmp3">les campagnes envoyées</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xxl">
                                                        <span>de volume supérieur à</span>
                                                        <input name="form-cmp-2" class="form-control" style="width: 100px;" type="text" placeholder="Volume" value="0" size="5">
                                                    </div>
                                                    <div class="col-xxl">
                                                        <span>adresses, à une fréquence de</span>
                                                        <input name="form-cmp-3" class="form-control" style="width: 100px;" type="text" placeholder="Fréquence" value="4" size="5">
                                                    </div>
                                                    <div class="col-xxl">
                                                        <span>heures, en commençant par</span>
                                                        <select name="form-cmp-4" class="form-select">
                                                            <option value="cmp1">la plus grande</option>
                                                            <option value="cmp2">la plus petite</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xxl-1">
                                                        <input type="submit" class="w-100 h-100 rounded btn-success" value="Envoyer" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal_visu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header mb-4">
                                    <h4 class="modal-title" id="myLargeModalLabel">Aperçu de la campagne</h4>
                                    <button type="button" class="close bg-danger" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                </div>

                                <div class="modal-body">
                                    <iframe src="./vue.php?id=" id="iframe_visu"></iframe>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Merci</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->




            <?php include 'partials/footer.php'; ?>
        </div>
        <!-- end main content-->
    </div>

    <?php include 'partials/vendor-scripts.php'; ?>

    <!-- sweetalert2 js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script>
        function redirigerVersLien() {
            window.location.href = './campagne.php';
        }
    </script>
    <!-- list.js min js -->
    <script src="assets/libs/list.js/list.min.js"></script>
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
    <script src=" assets/js/pages/form-advanced.init.js"></script>
    <script src="assets/js/pages/customer-list.init.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>