<?php //include 'partials/session.php'; 
?>
<?php include 'partials/main.php'; ?>

<?php
$odometer = 1;
$map = 1;

// require_once("../../../sdatamart/lib/system_load.php");
// authenticate_user('all');
require("partials/class/Bdd.php");

$bdd = new Bdd();
?>

<head>

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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Importation', 'title' => 'Insertion')); ?>
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

                                <div class="card-body tab-content text-center justify-content-center mt-lg-3 mb-lg-5 ">
                                    <div class="tab-pane show active" id="formGuttersPreview" role="tabpanel" aria-labelledby="formGuttersPreview-tab" tabindex="0">
                                        <form method="post" action="insertion_bl2.php" enctype="multipart/form-data" class="row g-3">
                                            <br>

                                            <div id="list_files" class="row d-flex bg-light justify-content-center mt-lg-2">
                                                <div class="input-group w-50 mb-1">
                                                    <input type="file" class="form-control" name="input_pays" id="input_fiile" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                    <label class="input-group-text cursor-pointer" for="inputGroupFile02">Upload</label>
                                                </div>

                                                <div class="w-50 bg-light">
                                                    <div class="card-body rounded">
                                                        <h4 type="menu" class="form-control cursor-pointer border-0 text-center" id="fileContent">Ou sélectionner un fichier de la liste</h4>
                                                    </div>
                                                </div>
                                                <hr />

                                                <?php
                                                $dir    = '/tmp/CLIENTS/ber';
                                                $files1 = scandir($dir);

                                                $line = 1;
                                                foreach ($files1 as $key => $file) {
                                                    if ($file != "." && $file != "..") {
                                                        if (is_file($dir . '/' . $file)) {
                                                            echo '<div class="radio">
                                                                <span>' . $line . '</span>
                                                                <label class="radio-custom">
                                                                    <input type="radio" name="file_to_submit" value="' . $file . '">
                                                                    <i class="fa fa-circle-o"></i>
                                                                    ' . $file . '
                                                                </label>
                                                            </div>';
                                                            $line++;
                                                        }
                                                    }
                                                }

                                                if (($line - 1) == 0) echo '<p style="text-align: center; margin: 5px 0 0;">Aucun fichier présent.</p>';
                                                ?>
                                            </div>

                                            <div class="col-lg-12">
                                                <div id="b2" class="btn-group m-3" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="customerType" id="btnradio1" checked="">
                                                    <label class="btn btn-outline-secondary mb-0" for="btnradio1">B2C</label>

                                                    <input type="radio" class="btn-check" name="customerType" id="btnradio2">
                                                    <label class="btn btn-outline-primary mb-0" for="btnradio2">B2B</label>
                                                </div>

                                                <div id="filetype" class="btn-group m-3" role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="dataType" id="btnradio3" checked="">
                                                    <label class="btn btn-outline-secondary mb-0" for="btnradio3">DATA</label>

                                                    <input type="radio" class="btn-check" name="dataType" id="btnradio4">
                                                    <label class="btn btn-outline-primary mb-0" for="btnradio4">BL</label>
                                                </div>
                                            </div>


                                            <div class="row d-flex justify-content-center mt-lg-1">
                                                <div class="card-body tab-content">
                                                    <div class="tab-pane show active d-flex justify-content-center" id="outlinedStylesPreview" role="tabpanel" aria-labelledby="outlinedStylesPreview-tab" tabindex="0">
                                                        <select class="form-select mb-3 w-25" name="separateur" id="separateur_input" aria-label="Default select example">
                                                            <option selected disabled hidden>Sélectionner un séparateur</option>
                                                            <option value=".">.</option>
                                                            <option value=":">:</option>
                                                            <option value=";">;</option>
                                                            <option value=",">,</option>
                                                            <option value="-">-</option>
                                                            <option value=" "> </option>
                                                            <option value="|">|</option>
                                                            <option value="/">/</option>
                                                            <option value="\">\</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <br>
                                                <div class="mb-1 justify-content-center">
                                                    <h5>Programme</h5>
                                                </div>

                                                <div class="row">
                                                    <div class="card-body tab-content">
                                                        <div class="tab-pane show active d-flex justify-content-center" id="filetype" role="tabpanel" aria-labelledby="outlinedStylesPreview-tab" tabindex="0">
                                                            <select name="programme" class="form-select mb-3 w-75" id="programme" aria-label="Default select example">
                                                                <?php
                                                                $bdd = new Bdd();

                                                                $requete = "SELECT gestion_programme.id, gestion_programme.nom, gestion_partenaire.nom AS partenaire FROM gestion_programme, gestion_partenaire WHERE gestion_programme.partenaire = gestion_partenaire.id ORDER BY gestion_programme.id ASC";
                                                                $result = $bdd->executeQueryRequete($requete, 1);

                                                                while ($items = $result->fetch()) {
                                                                    echo '<option value="' . $items->id . '">' . $items->nom . ' (' . $items->partenaire . ')</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div id="input_search_submit w-25 mt-lg-2">
                                                            <button class="form-control btn btn-lg btn-info" type="submit">Envoyer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

    <!-- nouisliderribute js -->
    <script src="assets/libs/nouislider/nouislider.min.js"></script>
    <script src="assets/libs/wnumb/wNumb.min.js"></script>
    <!-- range slider init -->
    <script src="assets/js/pages/range-sliders.init.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- dropzone js -->
    <script src="assets/libs/dropzone/dropzone-min.js"></script>
    <script src="assets/libs/list.js/list.min.js"></script>
    <!--list pagination js-->
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/file-manager.init.js"></script>

    <script src="assets/libs/multi.js/multi.min.js"></script>

    <!-- init js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <script src="assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js"></script>
    <!-- autocomplete js -->

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>