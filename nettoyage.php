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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Importation', 'title' => 'Nettoyage')); ?>
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
                                        <form action="" class="row g-3">
                                            <br>

                                            <div class="row d-flex justify-content-center mt-lg-2">
                                                <div class="input-group w-50 mb-1">
                                                    <input type="file" class="form-control" name="input_pays" id="input_fiile" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                    <label class="input-group-text cursor-pointer" for="inputGroupFile02">Upload</label>
                                                </div>


                                                <div class="card-body tab-content">
                                                    <div class="tab-pane show active d-flex justify-content-center" id="outlinedStylesPreview" role="tabpanel" aria-labelledby="outlinedStylesPreview-tab" tabindex="0">
                                                        <select class="form-select mb-3 w-25" name="separator" aria-label="Default select example" id="separator">
                                                            <option selected disabled hidden>Sélectionner un séparateur</option>
                                                            <option>.</option>
                                                            <option>:</option>
                                                            <option>;</option>
                                                            <option>,</option>
                                                            <option>-</option>
                                                            <option> </option>
                                                            <option>|</option>
                                                            <option>/</option>
                                                            <option>\</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <br><br>

                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-lg-5 d-grid gap-2 mb-3">
                                                        <button class="btn btn-lg btn-success" type="button">Envoyer</button>
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
    <script type="text/javascript">
        const checkbox1 = document.getElementById('checkbox1');
        const checkbox2 = document.getElementById('checkbox2');
        const inclu_pays = document.getElementById('inclu_pays');
        const exclu_pays = document.getElementById('exclu_pays');
        const inclu_ville = document.getElementById('inclu_ville');
        const exclu_ville = document.getElementById('exclu_ville');
        checkbox1.addEventListener('change', function() {
            if (this.checked) {
                checkbox2.checked = false;
            }
        });
        checkbox2.addEventListener('change', function() {
            if (this.checked) {
                checkbox1.checked = false;
            }
        });
        inclu_pays.addEventListener('change', function() {
            if (this.checked) {
                exclu_pays.checked = false;
            }
        });
        exclu_pays.addEventListener('change', function() {
            if (this.checked) {
                inclu_pays.checked = false;
            }
        });
        inclu_ville.addEventListener('change', function() {
            if (this.checked) {
                exclu_ville.checked = false;
            }
        });
        exclu_ville.addEventListener('change', function() {
            if (this.checked) {
                inclu_ville.checked = false;
            }
        });
        $(window).load(function() {
            $("#age_min").val($("div#rangeSlider div.ui-rangeSlider-leftLabel div.ui-rangeSlider-label-value")
                .text());
            $("#age_max").val($("div#rangeSlider div.ui-rangeSlider-rightLabel div.ui-rangeSlider-label-value")
                .text());
        });
        $(document).ready(function() {
            $("#date-between-ins").click(function() {
                $(".none-ins").css("display", "block");
            });
            $(".date-value-ins").click(function() {
                $("#date2-ins").val("");
                $(".none-ins").css("display", "none");
            });
            $("#date-between-ouv").click(function() {
                $(".none-ouv").css("display", "block");
            });
            $(".date-value-ouv").click(function() {
                $("#date2-ouv").val("");
                $(".none-ouv").css("display", "none");
            });
            $("#date-between-env").click(function() {
                $(".none-env").css("display", "block");
            });
            $(".date-value-env").click(function() {
                $("#date2-env").val("");
                $(".none-env").css("display", "none");
            });
            $("#date-between-cli").click(function() {
                $(".none-cli").css("display", "block");
            });
            $(".date-value-cli").click(function() {
                $("#date2-cli").val("");
                $(".none-cli").css("display", "none");
            });
            //-----------------------------------------
            $('input[type=checkbox], input[type=radio], select').on("change", function() {
                ajaxRequest();
            });
            $('input[type=text]').on("keyup", function() {
                ajaxRequest();
            });
            $('#age, #age-slider, #occurrence, #occurrence-slider').on("mouseup", function() {
                $("#age_min").val($(
                    "div#rangeSlider div.ui-rangeSlider-leftLabel div.ui-rangeSlider-label-value"
                ).text());
                $("#age_max").val($(
                    "div#rangeSlider div.ui-rangeSlider-rightLabel div.ui-rangeSlider-label-value"
                ).text());
                ajaxRequest();
            });
            //-----------------------------------------
            $('#map_dep').vectorMap({
                map: 'france_fr',
                hoverOpacity: 0.5,
                hoverColor: false,
                backgroundColor: "transparent",
                colors: couleurs,
                borderColor: "#000000",
                enableZoom: true,
                showTooltip: true,
                onRegionClick: function(element, code, region) {
                    if ($("#input_cp").val() == "") {
                        $("#input_cp").val(code);
                        $("#input_dep").val(code + ' (' + region + ')');
                    } else {
                        if ($("#input_cp").val().search(code) < 0) {
                            $("#input_cp").val($("#input_cp").val() + ',' + code);
                            $("#input_dep").val($("#input_dep").val() + ', ' + code + ' (' +
                                region + ')');
                        } else {
                            $("#input_cp").val($("#input_cp").val().replace(',' + code, ''));
                            $("#input_cp").val($("#input_cp").val().replace(code + ',', ''));
                            $("#input_cp").val($("#input_cp").val().replace(code, ''));
                            $("#input_dep").val($("#input_dep").val().replace(', ' + code + ' (' +
                                region + ')', ''));
                            $("#input_dep").val($("#input_dep").val().replace(code + ' (' + region +
                                ')' + ', ', ''));
                            $("#input_dep").val($("#input_dep").val().replace(code + ' (' + region +
                                ')', ''));
                        }
                    }
                    ajaxRequest();
                }
            });
        });
        //upload des fichiers codes postales
        $('#inputfile').on("change", function() {
            // FormData permet d'envoyer des fichiers avec AJAX
            const formData = new FormData();
            // Récupérer le fichier sélectionné
            const file = $(this)[0].files[0];
            // Ajouter le fichier au FormData
            formData.append('inputfile', file);
            $.ajax({
                url: "fichier_csv.php",
                type: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Parse the JSON response
                    try {
                        const lignes = JSON.parse(response);
                        const input = $('<input type="hidden" name="lignes" value="' + lignes +
                            '">');
                        $("#form_search_db").append(input);
                        //console.log(lignes)
                        /*for (const ligne of lignes) {
                        console.log(ligne[0])	
                        }*/
                        // Appel a la fonction Ajax
                        ajaxRequest();
                    } catch (error) {
                        console.error("Error parsing JSON response:", error);
                    }
                },
                error: function(xhr, status, errorThrown) {
                    console.error("Error sending file:", xhr.statusText);
                }
            });
        });
        $("#input_pays").on("change", function() {
            // FormData permet d'envoyer des fichiers avec AJAX
            const formData2 = new FormData();
            // Récupérer le fichier sélectionné
            const file = $(this)[0].files[0];
            //console.log(file);
            // Ajouter le fichier au FormData
            formData2.append('input_pays', file);
            $.ajax({
                url: "pays_csv.php",
                type: "post",
                data: formData2,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Parse the JSON response
                    try {
                        const pays = JSON.parse(response);
                        const input = $('<input type="hidden" name="input_pays" value="' + pays +
                            '">');
                        $("#form_search_db").append(input);
                        //console.log(response)
                        /*for (const ligne of pays) {
                        console.log(ligne)	
                        }*/
                        // Appel a la fonction Ajax
                        ajaxRequest();
                    } catch (error) {
                        console.error("Error parsing JSON response:", error);
                    }
                },
                error: function(xhr, status, errorThrown) {
                    console.error("Error sending file:", xhr.statusText);
                }
            });
        });
        $('#input_villes').on("change", function() {
            // FormData permet d'envoyer des fichiers avec AJAX
            const formData3 = new FormData();
            // Récupérer le fichier sélectionné
            const file = $(this)[0].files[0];
            // Ajouter le fichier au FormData
            formData3.append('input_villes', file);
            $.ajax({
                url: "ville_csv.php",
                type: "post",
                data: formData3,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Parse the JSON response
                    try {
                        const villes = JSON.parse(response);
                        const input = $('<input type="hidden" name="input_ville" value="' + villes +
                            '">');
                        $("#form_search_db").append(input);
                        //console.log(lignes)
                        /*for (const ligne of lignes) {
                        console.log(ligne[0])	
                        
                        // Un input de type hidden pour chaque
                        const input = $('<input type="hidden" name="lignes" value="' + lignes + '">');
                        $("#form_search_db").append(input);
                        }*/
                        // Appel a la fonction Ajax
                        ajaxRequest();
                    } catch (error) {
                        console.error("Error parsing JSON response:", error);
                    }
                },
                error: function(xhr, status, errorThrown) {
                    console.error("Error sending file:", xhr.statusText);
                }
            });
        });

        function ajaxRequest() {
            $.ajax({
                url: "count_b2c.php",
                type: "post",
                data: $("#form_search_db").serialize(),
                complete: function(xhr, result) {
                    var print = xhr.responseText.split("|");
                    // alert(xhr.responseText.split("|"))
                    $("#requete-count p").html(print[0]);
                    // var odometer = parseInt(print[1])
                    $(".odometer").html(parseInt(print[1]));
                    // alert("mon comptage: "+ odometer)
                }
            });
        }
    </script>
</body>

</html>