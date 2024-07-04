<?php //include 'partials/session.php'; 
?>
<?php include 'partials/main.php'; ?>

<?php

// require_once("../../../sdatamart/lib/system_load.php");
// authenticate_user('all');
require("partials/class/Bdd.php");

$bdd = new Bdd();
?>

<head>
    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Importation')); ?>

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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Importation', 'title' => 'Import de data')); ?>
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
                        <div class="col-xxl-12 mb-lg-5 d-flex justify-content-center">
                            <div class="card mb-lg-5 w-75">

                                <div class="card-body tab-content text-center justify-content-center  m-3 ">
                                    <div class="tab-pane show active" id="formGuttersPreview" role="tabpanel" aria-labelledby="formGuttersPreview-tab" tabindex="0">
                                        <form  method="post" action="import2.php" enctype="multipart/form-data" class="row g-3">

                                            <div class="row d-flex bg-light rounded justify-content-center">
                                                <div class="w-100" id="list_files">
                                                    <div class="card-body rounded">
                                                        <h4 type="menu" class="form-control border-0 text-center" id="fileContent">Séléctionner un fichier de la liste</h4>
                                                    </div>

                                                    <?php

                                                    $dir    = '/var/www/html/import/';
                                                    @$files1 = scandir($dir);

                                                    if ($files1 != false) {
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

                                                        if (($line - 1) == 0) echo '<p style="text-align: center; margin: 5px 0 0; padding-bottom : 10px;">Aucun fichier présent.</p>';
                                                    } else {
                                                        echo '<p style="text-align: center; margin: 5px 0 0; padding-bottom : 10px;">Le répertoire n\'est pas accessible.</p>';
                                                    }
                                                    ?>

                                                </div>
                                            </div>

                                            <br>

                                            <div class="row d-flex justify-content-center mt-4">
                                                <div class="input-group w-50 mb-1">
                                                    <input type="file" class="form-control" name="csv" id="csv" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                    <label class="input-group-text cursor-pointer" for="inputGroupFile02">Upload</label>
                                                </div>


                                                <div class="card-body tab-content">
                                                    <div class="tab-pane show active d-flex justify-content-center" id="separateur" role="tabpanel" aria-labelledby="outlinedStylesPreview-tab" tabindex="0">
                                                        <select class="form-select w-25" name="separateur" id="separateur_input" aria-label="Default select example">
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

                                            <div class="col-lg-12 mt-0">
                                                
                                                <div id="b2" class="btn-group mt-4 mb-5 " role="group" aria-label="Basic radio toggle button group">
                                                    <input type="radio" class="btn-check" name="b2b-b2c" id="btnradio1" value="b2c" checked>
                                                    <label class="btn btn-outline-secondary mb-0" for="btnradio1">B2C</label>

                                                    <input type="radio" class="btn-check" name="b2b-b2c" id="btnradio2" value="b2b">
                                                    <label class="btn btn-outline-primary mb-0" for="btnradio2">B2B</label>
                                                </div>


                                                <div class="row" id="upload_file">
                                                    <div class="col-lg-2 d-grid gap-2 ">
                                                        <button class="btn btn-lg btn-success form-control" type="submit" name="insert" value="Insertion">Insertion</button>
                                                    </div>
                                                    <div class="col-lg-3 d-grid gap-2 ">
                                                        <button class="btn btn-lg btn-danger form-control" type="submit" name="blacklist" value="BlackList">BlackList</button>
                                                    </div>
                                                    <div class="col-lg-2 d-grid gap-2 ">
                                                        <button class="btn btn-lg btn-secondary form-control" type="submit" name="update" value="Mise à jour">Enrichissement</button>
                                                    </div>
                                                    <div class="col-lg-3 d-grid gap-2 ">
                                                        <button class="btn btn-lg btn-info form-control" type="submit" name="comparaison" value="Comparaison">Comparaison</button>
                                                    </div>
                                                    <div class=" col-lg-2 d-grid gap-2 ">
                                                        <button class="btn btn-lg btn-dark form-control" type="submit" name="nettoyage" value="Nettoyage">Nettoyage</button>
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

    <script src="assets/js/pages/form-advanced.init.js"></script>
    <!-- autocomplete js -->

    <!-- App js -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("#list_files").click(function() {
                $("form div#list_files div.radio").toggle();
            });
        });
    </script>

    <script src="assets/js/app.js"></script>


</body>

</html>