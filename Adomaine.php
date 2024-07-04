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
    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Splitte')); ?>


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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Splitte', 'title' => 'Splitte de mail')); ?>
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

                                <div class="card-body tab-content text-center d-flex justify-content-center mt-lg-3 ">
                                    <div class="tab-pane show active" id="formGuttersPreview" role="tabpanel" aria-labelledby="formGuttersPreview-tab" tabindex="0">

                                        <form method="post" action="" enctype="multipart/form-data" id="form_validation" style="padding-bottom: 50px">


                                            <div id="input_upload" class="row d-flex justify-content-center mt-lg-2 mb-4">
                                                <div class="input-group w-50 mb-1">
                                                    <input type="file" class="form-control" name="csv" id="csv" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                    <label class="input-group-text cursor-pointer" for="inputGroupFile02">Upload</label>
                                                </div>

                                            </div>

                                            <div class="row g-2 d-flex justify-content-center m-3 w-100">
                                                <div class="col-md col-sm-4">
                                                    <div class="p-1 checkbox">
                                                        <label class="checkbox-custom">
                                                            <input type="checkbox" class="form-check-input" name="filtre_invalide" value="1">
                                                            <i class="fa fa-fw fa-square-o"></i> Emails invalides
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md col-sm-4">
                                                    <div class="p-1 checkbox">
                                                        <label class="checkbox-custom">
                                                            <input type="checkbox" class="form-check-input" name="filtre_interdit" value="1">
                                                            <i class="fa fa-fw fa-square-o"></i> Keywords interdits
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md col-sm-4">
                                                    <div class="p-1 checkbox">
                                                        <label class="checkbox-custom">
                                                            <input type="checkbox" class="form-check-input" name="filtre_doublon" value="1">
                                                            <i class="fa fa-fw fa-square-o"></i> Doublons
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md col-sm-4">
                                                    <div class="p-1 checkbox">
                                                        <label class="checkbox-custom">
                                                            <input type="checkbox" name="filtre_blacklist" value="1">
                                                            <i class="fa fa-fw fa-square-o"></i> Blacklist
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md col-sm-4">
                                                    <div class="p-1 checkbox">
                                                        <label class="checkbox-custom">
                                                            <input type="checkbox" name="filtre_caracteres" value="1">
                                                            <i class="fa fa-fw fa-square-o"></i> Moins de 3 caractères
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md col-sm-4">
                                                    <div class="p-1 checkbox">
                                                        <label class="checkbox-custom">
                                                            <input type="checkbox" name="filtre_nombres" value="1">
                                                            <i class="fa fa-fw fa-square-o"></i> Plus de 4 chiffres
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row g-3 justify-content-center m-3  w-100">
                                                <div class="col-lg">
                                                    <h6 class="text-muted">Nombre d'adresses par tronçon</h6>
                                                    <input type="number" class="form-control">
                                                </div>

                                                <div class="col-lg">
                                                    <h6 class="text-muted">Exclure les mails de plus de</h6>
                                                    <select class="form-select form-control" name="" id="" aria-label="Default select example">
                                                        <option selected disabled hidden>Sélectionner un nombre</option>
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                        <option value="5">05</option>
                                                        <option value="6">06</option>
                                                        <option value="7">07</option>
                                                        <option value="8">08</option>
                                                        <option value="9">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>

                                                    </select>
                                                </div>

                                                <div class="col-lg">
                                                    <h6 class="text-muted">Exclure les mails qui présentent une suite supérieur à</h6>
                                                    <select class="form-select form-control" name="" id="" aria-label="Default select example">
                                                        <option selected disabled hidden>Sélectionner un nombre</option>
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                        <option value="5">05</option>
                                                        <option value="6">06</option>
                                                        <option value="7">07</option>
                                                        <option value="8">08</option>
                                                        <option value="9">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>

                                                    </select>
                                                </div>

                                            </div>

                                            <div class="row g-3 justify-content-center m-3 w-100">
                                                <div class="col-lg-12">
                                                    <h6 class="text-muted">Exclure les mails comportant les suites de caractères:</h6>
                                                    <input class="form-control" name="" id="" data-choices data-choices-removeItem type="text">
                                                </div>
                                            </div>

                                            <div class="row g-3 justify-content-center text-center m-3">
                                                <div class="col-lg-12 w-25">
                                                    <button type="button" class="btn bg-light" data-toggle="modal" data-target="#exampleModalLong">
                                                        Containtes par domaine
                                                    </button>
                                                </div>
                                            </div>

                                            <br>

                                            <div class="row justify-content-center mt-3">
                                                <div id="" class="w-50">
                                                    <button class="form-control btn btn-lg btn-info" type="submit">Valider</button>
                                                </div>
                                            </div>


                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header mb-4">
                                                            <h4 class="modal-title" id="exampleModalLongTitle">Contraintes par domaine</h4>
                                                            <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="top-domain-content">
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
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-light" data-dismiss="modal">OK</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
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

    <script src="assets/js/pages/form-advanced.init.js"></script>
    <!-- autocomplete js -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#list_files").click(function() {
                $("form div#list_files div.radio").toggle();
            });
        });
    </script>

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
    <!-- App js -->
    <script src="assets/js/app.js"></script>


</body>

</html>