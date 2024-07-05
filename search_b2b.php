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
    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Recherche')); ?>

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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Recherche', 'title' => 'Recherches B2B')); ?>
                            </div>
                            <!--end col-->
                            <div class="col-md-auto ms-auto">
                                <?php include 'partials/customizer.php'; ?>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <form method="POST" action="search_a.php" name="form_search_db" id="form_search_db">
                        <div class="row">
                            <div class="col-xxl-9">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header d-md-flex gap-3">
                                                <div class="flex-grow-1">
                                                    <h4 class="card-title mb-1">Nom de la recherche</h4>
                                                </div>
                                            </div><!-- end card header -->
                                            <div class="card-body tab-content">
                                                <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                    <div>
                                                        <input name="name" type="text" id="search_name" class="form-control" placeholder="Nom">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-->
                                    </div> <!-- end col -->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header d-md-flex gap-3">
                                                <div class="flex-grow-1">
                                                    <h4 class="card-title mb-1">Type de location</h4>
                                                </div>
                                            </div><!-- end card header -->
                                            <div class="card-body tab-content">
                                                <div class="tab-pane show active" id="outlinedStylesPreview" role="tabpanel" aria-labelledby="outlinedStylesPreview-tab" tabindex="0">
                                                    <div class="hstack gap-2 flex-wrap">
                                                        <div class="form-check form-switch form-check-inline" dir="ltr">
                                                            <input type="checkbox" name="location[]" value="email" class="form-check-input" id="inlineswitch">
                                                            <label class="form-check-label" for="inlineswitch">@
                                                                E-mail</label>
                                                        </div>
                                                        <div class="form-check form-switch form-check-inline" dir="ltr">
                                                            <input type="checkbox" name="location[]" value="tel_mobile" class="form-check-input" id="inlineswitch1">
                                                            <label class="form-check-label" for="inlineswitch1">Mobile</label>
                                                        </div>
                                                        <div class="form-check form-switch form-check-inline" dir="ltr">
                                                            <input type="checkbox" name="location[]" value="cp" class="form-check-input" id="inlineswitchdisabled">
                                                            <label class="form-check-label" for="inlineswitchdisabled">Adresse postal</label>
                                                        </div>
                                                        <br>
                                                        &nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header d-md-flex gap-3">
                                                <div class="flex-grow-1">
                                                    <h4 class="card-title mb-1">Partenaires</h4>
                                                </div>
                                            </div><!-- end card header -->
                                            <div class="card-body tab-content">
                                                <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                    <select class="form-select mb-3" aria-label="Default select example" name="partenaire" id="partenaire">
                                                        <option selected>Sélectionnez un partenaire</option>
                                                        <?php
                                                        $requete = "SELECT id, nom FROM gestion_partenaire ORDER BY nom ASC";
                                                        $result = $bdd->executeQueryRequete($requete, 1);

                                                        while ($partenaire = $result->fetch()) {
                                                            echo '<option value="' . $partenaire->id . '">' . $partenaire->nom . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-->
                                    </div> <!-- end col -->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header d-md-flex gap-3">
                                                <div class="flex-grow-1">
                                                    <h4 class="card-title mb-1">Programmes</h4>
                                                </div>
                                            </div><!-- end card header -->
                                            <div class="card-body tab-content">
                                                <div class="tab-pane show active" id="outlinedStylesPreview" role="tabpanel" aria-labelledby="outlinedStylesPreview-tab" tabindex="0">
                                                    <select class="form-select mb-3" aria-label="Default select example" name="programme" id="programme">
                                                        <option selected>Sélectionnez un programme</option>
                                                        <?php
                                                        $requete = "SELECT id, nom FROM gestion_programme ORDER BY nom ASC";
                                                        $result = $bdd->executeQueryRequete($requete, 1);

                                                        while ($programme = $result->fetch()) {
                                                            echo '<option value="' . $programme->id . '">' . $programme->nom . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>

                                <div class="card">
                                    <div class="card-header mb-0">
                                        <h4 class="card-title mb-3">CRITÈRES DE POSTES</h4>
                                    </div>
                                    <div class="card-body mx-3 ">
                                        <div class="d-flex gap-2 align-items-center flex-wrap">
                                            <div class="col-xxl-12">
                                                <!-- Tab panes -->
                                                <div class="tab-content text-muted">
                                                    <div class="tab-pane active" id="arrow-pays" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                    <p class="text-muted mb-1">Sélectionner :</p>
                                                                    <div class="" style="margin-bottom: 10px;">
                                                                        <input class="form-control" id="activity" name="activity" data-choices data-choices-limit="3" data-choices-removeItem type="text">
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                    <p class="text-muted mb-1">Rechercher :</p>
                                                                    <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                        <select class="form-select mb-3" aria-label="Default select example" name="partenaire" id="partenaire">
                                                                            <option selected>Rechercher des fonctions</option>
                                                                            <?php
                                                                            $requete = "SELECT id, nom FROM gestion_partenaire ORDER BY nom ASC";
                                                                            $result = $bdd->executeQueryRequete($requete, 1);

                                                                            while ($partenaire = $result->fetch()) {
                                                                                echo '<option value="' . $partenaire->id . '">' . $partenaire->nom . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                    <p class="text-muted mb-1">Rechercher :</p>
                                                                    <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                        <select class="form-select mb-3" aria-label="Default select example" name="partenaire" id="partenaire">
                                                                            <option selected>Rechercher des familles de fonctions</option>
                                                                            <?php
                                                                            $requete = "SELECT id, nom FROM gestion_partenaire ORDER BY nom ASC";
                                                                            $result = $bdd->executeQueryRequete($requete, 1);

                                                                            while ($partenaire = $result->fetch()) {
                                                                                echo '<option value="' . $partenaire->id . '">' . $partenaire->nom . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                    <p class="text-muted mb-1">Rechercher :</p>
                                                                    <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                        <select class="form-select mb-3" aria-label="Default select example" name="partenaire" id="partenaire">
                                                                            <option selected>Rechercher des sous-familles de fonctions</option>
                                                                            <?php
                                                                            $requete = "SELECT id, nom FROM gestion_partenaire ORDER BY nom ASC";
                                                                            $result = $bdd->executeQueryRequete($requete, 1);

                                                                            while ($partenaire = $result->fetch()) {
                                                                                echo '<option value="' . $partenaire->id . '">' . $partenaire->nom . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">

                                                                <div class="" style="margin-bottom: 10px;">
                                                                    <p class="text-muted mb-1">Copier-coller :</p>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text text-muted">
                                                                                <i class="bi bi-clipboard"></i>
                                                                            </span>
                                                                            <textarea class="form-control" rows="2" placeholder="Copier-coller des code postaux..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                            <button type="button" id="valider_poste" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                <i class="bi bi-check2"></i> Valider
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                                <div class="input-group mb-1">
                                                                    <input type="file" class="form-control" name="input_ce_poste" id="input_ce_poste" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                </div>

                                                                <div class="row">
                                                                    <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                                    <div class="col-6">
                                                                        <div class="form-check form-radio-primary mb-3">
                                                                            <input class="form-check-input" type="radio" id="inclu_fonction" name="fonction_inclure" value="true" checked>
                                                                            <label class="form-check-label" for="formradioRight5">
                                                                                Inclure ces fonctions
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-check form-radio-primary mb-3">
                                                                            <input class="form-check-input" type="radio" id="exclu_fonction" name="fonction_exclure" value="false">
                                                                            <label class="form-check-label" for="formradioRight5">
                                                                                Exclure ces fonctions
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div id="ethereum_overview" data-colors='["--tb-success", "--tb-danger"]' class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header mb-0">
                                        <h4 class="card-title mb-3">CRITÈRES GÉOGRAPHIQUES</h4>
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <ul class="nav nav-pills arrow-navtabs nav-secondary bg-light mb-3" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#arrow-pays" role="tab">
                                                        <span class="d-block d-sm-none"><i class="bi bi-house"></i></span>
                                                        <span class="d-none d-sm-block">Pays</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#arrow-region" role="tab">
                                                        <span class="d-block d-sm-none"><i class="bi bi-house"></i></span>
                                                        <span class="d-none d-sm-block">Région</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#arrow-departement" role="tab">
                                                        <span class="d-block d-sm-none"><i class="bi bi-person"></i></span>
                                                        <span class="d-none d-sm-block">Département</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#ville" role="tab">
                                                        <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                        <span class="d-none d-sm-block">Villes</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#arrow-postaux" role="tab">
                                                        <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                        <span class="d-none d-sm-block">Codes Postaux</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#arrow-INSEE" role="tab">
                                                        <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                        <span class="d-none d-sm-block">Codes INSEE</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#arrow-IRIS" role="tab">
                                                        <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                        <span class="d-none d-sm-block">Codes IRIS</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#arrow-HEXAVIA" role="tab">
                                                        <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                        <span class="d-none d-sm-block">Codes HEXAVIA</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#arrow-HEXACLE" role="tab">
                                                        <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                        <span class="d-none d-sm-block">Codes HEXACLE</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body mx-3 ">
                                        <div class="d-flex gap-2 align-items-center flex-wrap">
                                            <div class="col-xxl-12">
                                                <!-- Tab panes -->
                                                <div class="tab-content text-muted">
                                                    <div class="tab-pane active" id="arrow-pays" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="tab-pane show active" id="customFormsPreview" role="tabpanel" aria-labelledby="customFormsPreview-tab" tabindex="0">
                                                                    <div class="row g-3">
                                                                        <div class="col-lg-6">
                                                                            <div class="mt-1 mt-lg-0">
                                                                                <p class="text-muted mb-1">Les 12 top
                                                                                    pays </p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                            <label class="form-check-label" for="customSwitchsizemd">France</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                            <label class="form-check-label" for="customSwitchsizemd">USA</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                            <label class="form-check-label" for="customSwitchsizemd">Japon</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                            <label class="form-check-label" for="customSwitchsizemd">Allemagne</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                            <label class="form-check-label" for="customSwitchsizemd">Angleterre</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                            <label class="form-check-label" for="customSwitchsizemd">Suisse</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                            <label class="form-check-label" for="customSwitchsizemd">Suède</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                            <label class="form-check-label" for="customSwitchsizemd">Inde</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                            <label class="form-check-label" for="customSwitchsizemd">Espagne</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                            <label class="form-check-label" for="customSwitchsizemd">Portugal</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                            <label class="form-check-label" for="customSwitchsizemd">Belgique</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                            <label class="form-check-label" for="customSwitchsizemd">Brésil</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            &nbsp;
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mt-1 mb-0 mt-lg-0">
                                                                                <div style="margin-bottom: 10px;">
                                                                                    <p class="text-muted mb-1">
                                                                                        Sélectionner une ou plusieurs
                                                                                        pays </p>
                                                                                    <select class="form-control" id="choices-single-groups" name="pays[]" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                                        <option value="">Sélectionnez
                                                                                        </option>
                                                                                        <?php
                                                                                        $requete = "SELECT pays, extension FROM search_pays ORDER BY pays ASC";
                                                                                        $result = $bdd->executeQueryRequete($requete, 1);

                                                                                        while ($pays = $result->fetch()) {
                                                                                            echo '<option value="' . $pays->extension . '">' . $pays->pays . '</option>';
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mt-0" style="margin-bottom: 10px;">
                                                                                    <p class="text-muted mb-1">
                                                                                        Rechercher une ou plusieurs pays
                                                                                    </p>
                                                                                    <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1">
                                                                                </div>
                                                                                <div class="" style="margin-bottom: 10px;">
                                                                                    <p class="text-muted mb-1">
                                                                                        Copier-coller :</p>
                                                                                    <div class="form-group">
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-text text-muted">
                                                                                                <i class="bi bi-clipboard"></i>
                                                                                            </span>
                                                                                            <textarea class="form-control" rows="2" placeholder="Copier-coller des pays..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                            <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                                <i class="bi bi-check2"></i>
                                                                                                Valider
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <p class="text-muted mt-1 mb-1">Envoyer
                                                                                    un fichier</p>
                                                                                <div class="input-group mb-1">
                                                                                    <input type="file" class="form-control" name="input_pays" id="input_pays" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <p class="text-muted mt-2 mb-1">
                                                                                        Inclure ou exclure</p>
                                                                                    <div class="col-6">
                                                                                        <div class="form-check form-radio-primary mb-3">
                                                                                            <input class="form-check-input" type="radio" id="inclu_pays" name="pays_inclure" value="true" checked>
                                                                                            <label class="form-check-label" for="formradioRight5">
                                                                                                Inclure ces pays
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-check form-radio-primary mb-3">
                                                                                            <input class="form-check-input" type="radio" id="exclu_pays" name="pays_inclure" value="false">
                                                                                            <label class="form-check-label" for="formradioRight5">
                                                                                                Exclure ces pays
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="arrow-region" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="tab-pane" id="customFormsPreview" role="tabpanel" aria-labelledby="customFormsPreview-tab" tabindex="0">
                                                                    <div class="row g-3">
                                                                        <div class="col-lg-6">
                                                                            <div class="mt-1 mt-lg-0">
                                                                                <p class="text-muted mb-1">Rechercher
                                                                                    une ou plusieurs régions </p>
                                                                                <select required multiple="multiple" name="favorite_cars" id="multiselect-region">
                                                                                    <option>Chevrolet</option>
                                                                                    <option>Fiat</option>
                                                                                    <option>Ford</option>
                                                                                    <option>Honda</option>
                                                                                    <option selected>Hyundai</option>
                                                                                    <option>Kia</option>
                                                                                    <option>Mahindra</option>
                                                                                    <option>Maruti</option>
                                                                                    <option>Mitsubishi</option>
                                                                                    <option>MG</option>
                                                                                    <option>Nissan</option>
                                                                                    <option>Renault</option>
                                                                                    <option selected>Skoda</option>
                                                                                    <option selected>Tata</option>
                                                                                    <option selected>Toyato</option>
                                                                                    <option>Volkswagen</option>
                                                                                </select>
                                                                            </div>
                                                                            <br>
                                                                            &nbsp;
                                                                            <input type="checkbox" class="btn-check" id="btn-check-2-outlined" checked>
                                                                            <label class="btn btn-outline-secondary" for="btn-check-2-outlined">Tout
                                                                                cocher</label>

                                                                            <input type="radio" class="btn-check" name="options-outlined" id="success-outlined" checked>
                                                                            <label class="btn btn-outline-success" for="success-outlined">Tout
                                                                                décocher</label>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mt-1 mb-0 mt-lg-0">
                                                                                <div style="margin-bottom: 10px;">
                                                                                    <p class="text-muted mb-1">
                                                                                        Sélectionner une ou des régions
                                                                                    </p>
                                                                                    <select class="form-control" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                                        <option value="">Sélectionnez
                                                                                        </option>
                                                                                        <optgroup label="UK">
                                                                                            <option value="London">
                                                                                                London</option>
                                                                                            <option value="Manchester">
                                                                                                Manchester</option>
                                                                                            <option value="Liverpool">
                                                                                                Liverpool</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="FR">
                                                                                            <option value="Paris">Paris
                                                                                            </option>
                                                                                            <option value="Lyon">Lyon
                                                                                            </option>
                                                                                            <option value="Marseille">
                                                                                                Marseille</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="DE" disabled>
                                                                                            <option value="Hamburg">
                                                                                                Hamburg</option>
                                                                                            <option value="Munich">
                                                                                                Munich</option>
                                                                                            <option value="Berlin">
                                                                                                Berlin</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="US">
                                                                                            <option value="New York">New
                                                                                                York</option>
                                                                                            <option value="Washington" disabled>Washington
                                                                                            </option>
                                                                                            <option value="Michigan">
                                                                                                Michigan</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="SP">
                                                                                            <option value="Madrid">
                                                                                                Madrid</option>
                                                                                            <option value="Barcelona">
                                                                                                Barcelona</option>
                                                                                            <option value="Malaga">
                                                                                                Malaga</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="CA">
                                                                                            <option value="Montreal">
                                                                                                Montreal</option>
                                                                                            <option value="Toronto">
                                                                                                Toronto</option>
                                                                                            <option value="Vancouver">
                                                                                                Vancouver</option>
                                                                                        </optgroup>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mt-0" style="margin-bottom: 10px;">
                                                                                    <p class="text-muted mb-1">Définir
                                                                                        les valeurs limites avec le
                                                                                        bouton Supprimer</p>
                                                                                    <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1">
                                                                                </div>
                                                                                <div class="" style="margin-bottom: 10px;">
                                                                                    <p class="text-muted mb-1">
                                                                                        Copier-coller :</p>
                                                                                    <div class="form-group">
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-text text-muted">
                                                                                                <i class="bi bi-clipboard"></i>
                                                                                            </span>
                                                                                            <textarea class="form-control" rows="2" placeholder="Copier-coller des régions..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                            <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                                <i class="bi bi-check2"></i>
                                                                                                Valider
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <p class="text-muted mt-1 mb-1">Envoyer
                                                                                    un fichier</p>
                                                                                <div class="input-group mb-1">
                                                                                    <input type="file" class="form-control" id="inputGroupFile02">
                                                                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <p class="text-muted mt-2 mb-1">
                                                                                        Inclure ou exclure</p>
                                                                                    <div class="col-6">
                                                                                        <div class="form-check form-radio-primary mb-3">
                                                                                            <input class="form-check-input" type="radio" name="dataregion" id="formradioRight5" checked>
                                                                                            <label class="form-check-label" for="formradioRight5">
                                                                                                Inclure ces régions
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-check form-radio-primary mb-3">
                                                                                            <input class="form-check-input" type="radio" name="dataregion" id="formradioRight5">
                                                                                            <label class="form-check-label" for="formradioRight5">
                                                                                                Exclure ces régions
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="arrow-departement" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="tab-pane" id="customFormsPreview" role="tabpanel" aria-labelledby="customFormsPreview-tab" tabindex="0">
                                                                    <div class="row g-3">
                                                                        <div class="col-lg-6">
                                                                            <div class="mt-1 mt-lg-0">
                                                                                <p class="text-muted mb-1">Rechercher un
                                                                                    ou plusieurs département </p>
                                                                                <select required multiple="multiple" name="favorite_cars" id="multiselect-departement">
                                                                                    <option>Chevrolet</option>
                                                                                    <option>Fiat</option>
                                                                                    <option>Ford</option>
                                                                                    <option>Honda</option>
                                                                                    <option selected>Hyundai</option>
                                                                                    <option>Kia</option>
                                                                                    <option>Mahindra</option>
                                                                                    <option>Maruti</option>
                                                                                    <option>Mitsubishi</option>
                                                                                    <option>MG</option>
                                                                                    <option>Nissan</option>
                                                                                    <option>Renault</option>
                                                                                    <option selected>Skoda</option>
                                                                                    <option selected>Tata</option>
                                                                                    <option selected>Toyato</option>
                                                                                    <option>Volkswagen</option>
                                                                                </select>
                                                                            </div>
                                                                            <br>
                                                                            &nbsp;
                                                                            <input type="checkbox" class="btn-check" id="btn-check-2-outlined" checked>
                                                                            <label class="btn btn-outline-secondary" for="btn-check-2-outlined">Tout
                                                                                cocher</label>

                                                                            <input type="radio" class="btn-check" name="options-departement" id="success-outlined" checked>
                                                                            <label class="btn btn-outline-success" for="success-outlined">Tout
                                                                                décocher</label>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mt-1 mb-0 mt-lg-0">
                                                                                <div style="margin-bottom: 10px;">
                                                                                    <p class="text-muted mb-1">
                                                                                        Sélectionner un ou plusieurs
                                                                                        départements </p>
                                                                                    <select class="form-control" id="choices-single-groups" name="geoloc[]" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                                        <option value="">Sélectionner
                                                                                            des départements</option>
                                                                                        <option value="01">01 Ain
                                                                                        </option>
                                                                                        <option value="02">02 Aisne
                                                                                        </option>
                                                                                        <option value="03">03 Allier
                                                                                        </option>
                                                                                        <option value="04">04
                                                                                            Alpes-de-Haute-Provence
                                                                                        </option>
                                                                                        <option value="05">05
                                                                                            Hautes-Alpes</option>
                                                                                        <option value="06">06
                                                                                            Alpes-Maritimes</option>
                                                                                        <option value="07">07 Ardèche
                                                                                        </option>
                                                                                        <option value="08">08 Ardennes
                                                                                        </option>
                                                                                        <option value="09">09 Ariège
                                                                                        </option>
                                                                                        <option value="10">10 Aube
                                                                                        </option>
                                                                                        <option value="11">11 Aude
                                                                                        </option>
                                                                                        <option value="12">12 Aveyron
                                                                                        </option>
                                                                                        <option value="13">13
                                                                                            Bouches-du-Rhône</option>
                                                                                        <option value="14">14 Calvados
                                                                                        </option>
                                                                                        <option value="15">15 Cantal
                                                                                        </option>
                                                                                        <option value="16">16 Charente
                                                                                        </option>
                                                                                        <option value="17">17
                                                                                            Charente-Maritime</option>
                                                                                        <option value="18">18 Cher
                                                                                        </option>
                                                                                        <option value="19">19 Corrèze
                                                                                        </option>
                                                                                        <option value="2A">2A
                                                                                            Corse-du-Sud</option>
                                                                                        <option value="2B">2B
                                                                                            Haute-Corse</option>
                                                                                        <option value="21">21 Côte-d'Or
                                                                                        </option>
                                                                                        <option value="22">22
                                                                                            Côtes-d'Armor</option>
                                                                                        <option value="23">23 Creuse
                                                                                        </option>
                                                                                        <option value="24">24 Dordogne
                                                                                        </option>
                                                                                        <option value="25">25 Doubs
                                                                                        </option>
                                                                                        <option value="26">26 Drôme
                                                                                        </option>
                                                                                        <option value="27">27 Eure
                                                                                        </option>
                                                                                        <option value="28">28
                                                                                            Eure-et-Loir</option>
                                                                                        <option value="29">29 Finistère
                                                                                        </option>
                                                                                        <option value="30">30 Gard
                                                                                        </option>
                                                                                        <option value="31">31
                                                                                            Haute-Garonne</option>
                                                                                        <option value="32">32 Gers
                                                                                        </option>
                                                                                        <option value="33">33 Gironde
                                                                                        </option>
                                                                                        <option value="34">34 Hérault
                                                                                        </option>
                                                                                        <option value="35">35
                                                                                            Ille-et-Vilaine</option>
                                                                                        <option value="36">36 Indre
                                                                                        </option>
                                                                                        <option value="37">37
                                                                                            Indre-et-Loire</option>
                                                                                        <option value="38">38 Isère
                                                                                        </option>
                                                                                        <option value="39">39 Jura
                                                                                        </option>
                                                                                        <option value="40">40 Landes
                                                                                        </option>
                                                                                        <option value="41">41
                                                                                            Loir-et-Cher</option>
                                                                                        <option value="42">42 Loire
                                                                                        </option>
                                                                                        <option value="43">43
                                                                                            Haute-Loire</option>
                                                                                        <option value="44">44
                                                                                            Loire-Atlantique</option>
                                                                                        <option value="45">45 Loiret
                                                                                        </option>
                                                                                        <option value="46">46 Lot
                                                                                        </option>
                                                                                        <option value="47">47
                                                                                            Lot-et-Garonne</option>
                                                                                        <option value="48">48 Lozère
                                                                                        </option>
                                                                                        <option value="49">49
                                                                                            Maine-et-Loire</option>
                                                                                        <option value="50">50 Manche
                                                                                        </option>
                                                                                        <option value="51">51 Marne
                                                                                        </option>
                                                                                        <option value="52">52
                                                                                            Haute-Marne</option>
                                                                                        <option value="53">53 Mayenne
                                                                                        </option>
                                                                                        <option value="54">54
                                                                                            Meurthe-et-Moselle</option>
                                                                                        <option value="55">55 Meuse
                                                                                        </option>
                                                                                        <option value="56">56 Morbihan
                                                                                        </option>
                                                                                        <option value="57">57 Moselle
                                                                                        </option>
                                                                                        <option value="58">58 Nièvre
                                                                                        </option>
                                                                                        <option value="59">59 Nord
                                                                                        </option>
                                                                                        <option value="60">60 Oise
                                                                                        </option>
                                                                                        <option value="61">61 Orne
                                                                                        </option>
                                                                                        <option value="62">62
                                                                                            Pas-de-Calais</option>
                                                                                        <option value="63">63
                                                                                            Puy-de-Dôme</option>
                                                                                        <option value="64">64
                                                                                            Pyrénées-Atlantiques
                                                                                        </option>
                                                                                        <option value="65">65
                                                                                            Hautes-Pyrénées</option>
                                                                                        <option value="66">66
                                                                                            Pyrénées-Orientales</option>
                                                                                        <option value="67">67 Bas-Rhin
                                                                                        </option>
                                                                                        <option value="68">68 Haut-Rhin
                                                                                        </option>
                                                                                        <option value="69">69 Rhône
                                                                                        </option>
                                                                                        <option value="70">70
                                                                                            Haute-Saône</option>
                                                                                        <option value="71">71
                                                                                            Saône-et-Loire</option>
                                                                                        <option value="72">72 Sarthe
                                                                                        </option>
                                                                                        <option value="73">73 Savoie
                                                                                        </option>
                                                                                        <option value="74">74
                                                                                            Haute-Savoie</option>
                                                                                        <option value="75">75 Paris
                                                                                        </option>
                                                                                        <option value="76">76
                                                                                            Seine-Maritime</option>
                                                                                        <option value="77">77
                                                                                            Seine-et-Marne</option>
                                                                                        <option value="78">78 Yvelines
                                                                                        </option>
                                                                                        <option value="79">79
                                                                                            Deux-Sèvres</option>
                                                                                        <option value="80">80 Somme
                                                                                        </option>
                                                                                        <option value="81">81 Tarn
                                                                                        </option>
                                                                                        <option value="82">82
                                                                                            Tarn-et-Garonne</option>
                                                                                        <option value="83">83 Var
                                                                                        </option>
                                                                                        <option value="84">84 Vaucluse
                                                                                        </option>
                                                                                        <option value="85">85 Vendée
                                                                                        </option>
                                                                                        <option value="86">86 Vienne
                                                                                        </option>
                                                                                        <option value="87">87
                                                                                            Haute-Vienne</option>
                                                                                        <option value="88">88 Vosges
                                                                                        </option>
                                                                                        <option value="89">89 Yonne
                                                                                        </option>
                                                                                        <option value="90">90 Territoire
                                                                                            de Belfort</option>
                                                                                        <option value="91">91 Essonne
                                                                                        </option>
                                                                                        <option value="92">92
                                                                                            Hauts-de-Seine</option>
                                                                                        <option value="93">93
                                                                                            Seine-Saint-Denis</option>
                                                                                        <option value="94">94
                                                                                            Val-de-Marne</option>
                                                                                        <option value="95">95 Val-d'Oise
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mt-0" style="margin-bottom: 10px;">
                                                                                    <p class="text-muted mb-1">
                                                                                        Sélectionnez</p>
                                                                                    <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1">
                                                                                </div>
                                                                                <div class="" style="margin-bottom: 10px;">
                                                                                    <p class="text-muted mb-1">
                                                                                        Copier-coller :</p>
                                                                                    <div class="form-group">
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-text text-muted">
                                                                                                <i class="bi bi-clipboard"></i>
                                                                                            </span>
                                                                                            <textarea class="form-control" rows="2" placeholder="Copier-coller des departements..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                            <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                                <i class="bi bi-check2"></i>
                                                                                                Valider
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <p class="text-muted mt-1 mb-1">Envoyer
                                                                                    un fichier</p>
                                                                                <div class="input-group mb-1">
                                                                                    <input type="file" class="form-control" id="inputGroupFile02">
                                                                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <p class="text-muted mt-2 mb-1">
                                                                                        Inclure ou exclure</p>
                                                                                    <div class="col-6">
                                                                                        <div class="form-check form-radio-primary mb-3">
                                                                                            <input class="form-check-input" type="radio" name="datadepartement" id="formradioRight5" checked>
                                                                                            <label class="form-check-label" for="formradioRight5">
                                                                                                Inclure ces départements
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-check form-radio-primary mb-3">
                                                                                            <input class="form-check-input" type="radio" name="datadepartement" id="formradioRight5">
                                                                                            <label class="form-check-label" for="formradioRight5">
                                                                                                Exclure ces départements
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="ville" role="tabpanel">
                                                        <div class="row g-3">
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mt-lg-0">
                                                                    <p class="text-muted mb-1">Les 12 des villes </p>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                <label class="form-check-label" for="customSwitchsizemd">Marseille</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                <label class="form-check-label" for="customSwitchsizemd">Genève</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                <label class="form-check-label" for="customSwitchsizemd">Paris</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                <label class="form-check-label" for="customSwitchsizemd">Bruxelles</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                <label class="form-check-label" for="customSwitchsizemd">Lille</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                <label class="form-check-label" for="customSwitchsizemd">Nantes</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                <label class="form-check-label" for="customSwitchsizemd">Luxembourg</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                <label class="form-check-label" for="customSwitchsizemd">Neuchâtel</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                <label class="form-check-label" for="customSwitchsizemd">Lausanne</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                <label class="form-check-label" for="customSwitchsizemd">Liège</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                <label class="form-check-label" for="customSwitchsizemd">Strasbourg</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                                                <label class="form-check-label" for="customSwitchsizemd">Bordeaux</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                &nbsp;
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mb-0 mt-lg-0">
                                                                    <div style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Sélectionner une ou
                                                                            plusieurs villes </p>
                                                                        <select class="form-control" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                            <option value="">Sélectionnez</option>
                                                                            <optgroup label="UK">
                                                                                <option value="London">London</option>
                                                                                <option value="Manchester">Manchester
                                                                                </option>
                                                                                <option value="Liverpool">Liverpool
                                                                                </option>
                                                                            </optgroup>
                                                                            <optgroup label="FR">
                                                                                <option value="Paris">Paris</option>
                                                                                <option value="Lyon">Lyon</option>
                                                                                <option value="Marseille">Marseille
                                                                                </option>
                                                                            </optgroup>
                                                                            <optgroup label="DE" disabled>
                                                                                <option value="Hamburg">Hamburg</option>
                                                                                <option value="Munich">Munich</option>
                                                                                <option value="Berlin">Berlin</option>
                                                                            </optgroup>
                                                                            <optgroup label="US">
                                                                                <option value="New York">New York
                                                                                </option>
                                                                                <option value="Washington" disabled>
                                                                                    Washington</option>
                                                                                <option value="Michigan">Michigan
                                                                                </option>
                                                                            </optgroup>
                                                                            <optgroup label="SP">
                                                                                <option value="Madrid">Madrid</option>
                                                                                <option value="Barcelona">Barcelona
                                                                                </option>
                                                                                <option value="Malaga">Malaga</option>
                                                                            </optgroup>
                                                                            <optgroup label="CA">
                                                                                <option value="Montreal">Montreal
                                                                                </option>
                                                                                <option value="Toronto">Toronto</option>
                                                                                <option value="Vancouver">Vancouver
                                                                                </option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mt-0" style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Rechercher une ou
                                                                            plusieurs villes</p>
                                                                        <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1">
                                                                    </div>
                                                                    <div class="" style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Copier-coller :</p>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-text text-muted">
                                                                                    <i class="bi bi-clipboard"></i>
                                                                                </span>
                                                                                <textarea class="form-control" rows="2" placeholder="Copier-coller des villes..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                    <i class="bi bi-check2"></i> Valider
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <p class="text-muted mt-1 mb-1">Envoyer un fichier
                                                                    </p>
                                                                    <div class="input-group mb-1">
                                                                        <input type="file" class="form-control" name="input_villes" id="input_villes" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                    </div>

                                                                    <div class="row">
                                                                        <p class="text-muted mt-2 mb-1">Inclure ou
                                                                            exclure</p>
                                                                        <div class="col-6">
                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                <input class="form-check-input" type="radio" name="formradiocolor1" id="inclu_ville" name="ville_inclure" value="true" checked>
                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                    Inclure ces villes
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                <input class="form-check-input" type="radio" name="formradiocolor1" id="exclu_ville" name="ville_inclure" value="false">
                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                    Exclure ces villes
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="arrow-postaux" role="tabpanel">
                                                        <div class="row g-3">
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mt-lg-0">
                                                                    <p class="text-muted mb-1">Rechercher un ou
                                                                        plusieurs codes postaux</p>
                                                                    <select required multiple="multiple" name="favorite_cars" id="multiselect-postaux">
                                                                        <option>Chevrolet</option>
                                                                        <option>Fiat</option>
                                                                        <option>Ford</option>
                                                                        <option>Honda</option>
                                                                        <option selected>Hyundai</option>
                                                                        <option>Kia</option>
                                                                        <option>Mahindra</option>
                                                                        <option>Maruti</option>
                                                                        <option>Mitsubishi</option>
                                                                        <option>MG</option>
                                                                        <option>Nissan</option>
                                                                        <option>Renault</option>
                                                                        <option selected>Skoda</option>
                                                                        <option selected>Tata</option>
                                                                        <option selected>Toyato</option>
                                                                        <option>Volkswagen</option>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                &nbsp;
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mb-0 mt-lg-0">
                                                                    <div style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Sélectionner un ou
                                                                            plusieurs codes postaux</p>
                                                                        <select class="form-control" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                            <option value="">Sélectionnez</option>
                                                                            <optgroup label="UK">
                                                                                <option value="London">London</option>
                                                                                <option value="Manchester">Manchester
                                                                                </option>
                                                                                <option value="Liverpool">Liverpool
                                                                                </option>
                                                                            </optgroup>
                                                                            <optgroup label="FR">
                                                                                <option value="Paris">Paris</option>
                                                                                <option value="Lyon">Lyon</option>
                                                                                <option value="Marseille">Marseille
                                                                                </option>
                                                                            </optgroup>
                                                                            <optgroup label="DE" disabled>
                                                                                <option value="Hamburg">Hamburg</option>
                                                                                <option value="Munich">Munich</option>
                                                                                <option value="Berlin">Berlin</option>
                                                                            </optgroup>
                                                                            <optgroup label="US">
                                                                                <option value="New York">New York
                                                                                </option>
                                                                                <option value="Washington" disabled>
                                                                                    Washington</option>
                                                                                <option value="Michigan">Michigan
                                                                                </option>
                                                                            </optgroup>
                                                                            <optgroup label="SP">
                                                                                <option value="Madrid">Madrid</option>
                                                                                <option value="Barcelona">Barcelona
                                                                                </option>
                                                                                <option value="Malaga">Malaga</option>
                                                                            </optgroup>
                                                                            <optgroup label="CA">
                                                                                <option value="Montreal">Montreal
                                                                                </option>
                                                                                <option value="Toronto">Toronto</option>
                                                                                <option value="Vancouver">Vancouver
                                                                                </option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mt-0" style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Définir les valeurs
                                                                            limites avec le bouton Supprimer</p>
                                                                        <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1">
                                                                    </div>
                                                                    <div class="" style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Copier-coller :</p>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-text text-muted">
                                                                                    <i class="bi bi-clipboard"></i>
                                                                                </span>
                                                                                <textarea class="form-control" rows="2" placeholder="Copier-coller des code postaux..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                    <i class="bi bi-check2"></i> Valider
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <p class="text-muted mt-1 mb-1">Envoyer un fichier
                                                                    </p>
                                                                    <div class="input-group mb-1">
                                                                        <input type="file" class="form-control" name="inputfile" id="inputfile" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                    </div>

                                                                    <div class="row">
                                                                        <p class="text-muted mt-2 mb-1">Inclure ou
                                                                            exclure</p>
                                                                        <div class="col-6">
                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                <input class="form-check-input" type="radio" name="datacodepostaux" id="checkbox1" name="cp_inclure" value="true" checked>
                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                    Inclure ces codes postaux
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                <input class="form-check-input" type="radio" name="datacodepostaux" id="checkbox2" name="cp_inclure" value="false">
                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                    Exclure ces codes postaux
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="arrow-INSEE" role="tabpanel">
                                                        <div class="row g-3">
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mt-lg-0">
                                                                    <p class="text-muted mb-1">Rechercher un ou
                                                                        plusieurs codes INSEE </p>
                                                                    <select required multiple="multiple" name="favorite_cars" id="multiselect-insee">
                                                                        <option>Chevrolet</option>
                                                                        <option>Fiat</option>
                                                                        <option>Ford</option>
                                                                        <option>Honda</option>
                                                                        <option selected>Hyundai</option>
                                                                        <option>Kia</option>
                                                                        <option>Mahindra</option>
                                                                        <option>Maruti</option>
                                                                        <option>Mitsubishi</option>
                                                                        <option>MG</option>
                                                                        <option>Nissan</option>
                                                                        <option>Renault</option>
                                                                        <option selected>Skoda</option>
                                                                        <option selected>Tata</option>
                                                                        <option selected>Toyato</option>
                                                                        <option>Volkswagen</option>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                &nbsp;
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mb-0 mt-lg-0">
                                                                    <div style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Sélectionner un ou
                                                                            plusieurs codes INSEE </p>
                                                                        <select class="form-control" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                            <option value="">Sélectionnez</option>
                                                                            <optgroup label="UK">
                                                                                <option value="London">London</option>
                                                                                <option value="Manchester">Manchester
                                                                                </option>
                                                                                <option value="Liverpool">Liverpool
                                                                                </option>
                                                                            </optgroup>
                                                                            <optgroup label="FR">
                                                                                <option value="Paris">Paris</option>
                                                                                <option value="Lyon">Lyon</option>
                                                                                <option value="Marseille">Marseille
                                                                                </option>
                                                                            </optgroup>
                                                                            <optgroup label="DE" disabled>
                                                                                <option value="Hamburg">Hamburg</option>
                                                                                <option value="Munich">Munich</option>
                                                                                <option value="Berlin">Berlin</option>
                                                                            </optgroup>
                                                                            <optgroup label="US">
                                                                                <option value="New York">New York
                                                                                </option>
                                                                                <option value="Washington" disabled>
                                                                                    Washington</option>
                                                                                <option value="Michigan">Michigan
                                                                                </option>
                                                                            </optgroup>
                                                                            <optgroup label="SP">
                                                                                <option value="Madrid">Madrid</option>
                                                                                <option value="Barcelona">Barcelona
                                                                                </option>
                                                                                <option value="Malaga">Malaga</option>
                                                                            </optgroup>
                                                                            <optgroup label="CA">
                                                                                <option value="Montreal">Montreal
                                                                                </option>
                                                                                <option value="Toronto">Toronto</option>
                                                                                <option value="Vancouver">Vancouver
                                                                                </option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mt-0" style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Définir les valeurs
                                                                            limites avec le bouton Supprimer</p>
                                                                        <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1">
                                                                    </div>
                                                                    <div class="" style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Copier-coller :</p>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-text text-muted">
                                                                                    <i class="bi bi-clipboard"></i>
                                                                                </span>
                                                                                <textarea class="form-control" rows="2" placeholder="Copier-coller des codes INSEE..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                    <i class="bi bi-check2"></i> Valider
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <p class="text-muted mt-1 mb-1">Envoyer un fichier
                                                                    </p>
                                                                    <div class="input-group mb-1">
                                                                        <input type="file" class="form-control" id="inputGroupFile02">
                                                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                    </div>

                                                                    <div class="row">
                                                                        <p class="text-muted mt-2 mb-1">Inclure ou
                                                                            exclure</p>
                                                                        <div class="col-6">
                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                <input class="form-check-input" type="radio" name="datainsee" id="formradioRight5" checked>
                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                    Inclure ces codes INSEE
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                <input class="form-check-input" type="radio" name="datainsee" id="formradioRight5" checked>
                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                    Exclure ces codes INSEE
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="arrow-IRIS" role="tabpanel">
                                                        <div class="row g-3">
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mt-lg-0">
                                                                    <p class="text-muted mb-1">Rechercher un ou
                                                                        plusieurs codes IRIS </p>
                                                                    <select required multiple="multiple" name="favorite_cars" id="multiselect-iris">
                                                                        <option>Chevrolet</option>
                                                                        <option>Fiat</option>
                                                                        <option>Ford</option>
                                                                        <option>Honda</option>
                                                                        <option selected>Hyundai</option>
                                                                        <option>Kia</option>
                                                                        <option>Mahindra</option>
                                                                        <option>Maruti</option>
                                                                        <option>Mitsubishi</option>
                                                                        <option>MG</option>
                                                                        <option>Nissan</option>
                                                                        <option>Renault</option>
                                                                        <option selected>Skoda</option>
                                                                        <option selected>Tata</option>
                                                                        <option selected>Toyato</option>
                                                                        <option>Volkswagen</option>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                &nbsp;
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mb-0 mt-lg-0">
                                                                    <div style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Sélectionner un ou
                                                                            plusieurs codes IRIS </p>
                                                                        <select class="form-control" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                            <option value="">Sélectionnez</option>
                                                                            <optgroup label="UK">
                                                                                <option value="London">London</option>
                                                                                <option value="Manchester">Manchester
                                                                                </option>
                                                                                <option value="Liverpool">Liverpool
                                                                                </option>
                                                                            </optgroup>
                                                                            <optgroup label="FR">
                                                                                <option value="Paris">Paris</option>
                                                                                <option value="Lyon">Lyon</option>
                                                                                <option value="Marseille">Marseille
                                                                                </option>
                                                                            </optgroup>
                                                                            <optgroup label="DE" disabled>
                                                                                <option value="Hamburg">Hamburg</option>
                                                                                <option value="Munich">Munich</option>
                                                                                <option value="Berlin">Berlin</option>
                                                                            </optgroup>
                                                                            <optgroup label="US">
                                                                                <option value="New York">New York
                                                                                </option>
                                                                                <option value="Washington" disabled>
                                                                                    Washington</option>
                                                                                <option value="Michigan">Michigan
                                                                                </option>
                                                                            </optgroup>
                                                                            <optgroup label="SP">
                                                                                <option value="Madrid">Madrid</option>
                                                                                <option value="Barcelona">Barcelona
                                                                                </option>
                                                                                <option value="Malaga">Malaga</option>
                                                                            </optgroup>
                                                                            <optgroup label="CA">
                                                                                <option value="Montreal">Montreal
                                                                                </option>
                                                                                <option value="Toronto">Toronto</option>
                                                                                <option value="Vancouver">Vancouver
                                                                                </option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mt-0" style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Définir les valeurs
                                                                            limites avec le bouton Supprimer</p>
                                                                        <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1">
                                                                    </div>
                                                                    <div class="" style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Copier-coller :</p>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-text text-muted">
                                                                                    <i class="bi bi-clipboard"></i>
                                                                                </span>
                                                                                <textarea class="form-control" rows="2" placeholder="Copier-coller des code IRIS..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                    <i class="bi bi-check2"></i> Valider
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <p class="text-muted mt-1 mb-1">Envoyer un fichier
                                                                    </p>
                                                                    <div class="input-group mb-1">
                                                                        <input type="file" class="form-control" id="inputGroupFile02">
                                                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                    </div>

                                                                    <div class="row">
                                                                        <p class="text-muted mt-2 mb-1">Inclure ou
                                                                            exclure</p>
                                                                        <div class="col-6">
                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                <input class="form-check-input" type="radio" name="datairis" id="formradioRight5" checked>
                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                    Inclure ces codes IRIS
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                <input class="form-check-input" type="radio" name="datairis" id="formradioRight5" checked>
                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                    Exclure ces codes IRIS
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="arrow-HEXAVIA" role="tabpanel">
                                                        <div class="row g-3">
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mt-lg-0">
                                                                    <div class="mt-0" style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Vous pouvez
                                                                            copier-coller un ou plusieurs codes HEXAVIA
                                                                        </p>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-text text-muted">
                                                                                    <i class="bi bi-clipboard"></i>
                                                                                </span>
                                                                                <textarea class="form-control" rows="2" placeholder="Copier-coller des code HEXAVIA..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                    <i class="bi bi-check2"></i> Valider
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                &nbsp;
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mb-0 mt-lg-0">
                                                                    <p class="text-muted mb-1">Envoyer un fichier</p>
                                                                    <div class="input-group mb-1">
                                                                        <input type="file" class="form-control" id="inputGroupFile02">
                                                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                    </div>

                                                                    <div class="row">
                                                                        <p class="text-muted mt-2 mb-1">Inclure ou
                                                                            exclure</p>
                                                                        <div class="col-6">
                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                <input class="form-check-input" type="radio" name="datahexavia" id="formradioRight5" checked>
                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                    Inclure ces codes HEXAVIA
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                <input class="form-check-input" type="radio" name="datahexavia" id="formradioRight5" checked>
                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                    Exclure ces codes HEXAVIA
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="arrow-HEXACLE" role="tabpanel">
                                                        <div class="row g-3">
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mt-lg-0">
                                                                    <div class="mt-0" style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Vous pouvez
                                                                            copier-coller un ou plusieurs codes HEXACLE
                                                                        </p>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <span class="input-group-text text-muted">
                                                                                    <i class="bi bi-clipboard"></i>
                                                                                </span>
                                                                                <textarea class="form-control" rows="2" placeholder="Copier-coller des code HEXACLE..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                    <i class="bi bi-check2"></i> Valider
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                &nbsp;
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mb-0 mt-lg-0">
                                                                    <p class="text-muted mb-1">Envoyer un fichier</p>
                                                                    <div class="input-group mb-1">
                                                                        <input type="file" class="form-control" id="inputGroupFile02">
                                                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                    </div>

                                                                    <div class="row">
                                                                        <p class="text-muted mt-2 mb-1">Inclure ou
                                                                            exclure</p>
                                                                        <div class="col-6">
                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                <input class="form-check-input" type="radio" name="datahexale" id="formradioRight5" checked>
                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                    Inclure ces codes HEXACLE
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                <input class="form-check-input" type="radio" name="datahexale" id="formradioRight5">
                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                    Exclure ces codes HEXACLE
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="ethereum_overview" data-colors='["--tb-success", "--tb-danger"]' class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-1">CRITÈRES DE SEGMENTATION</h4>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <ul class="nav nav-pills arrow-navtabs nav-secondary bg-light mb-3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#arrow-naf2008" role="tab">
                                                    <span class="d-block d-sm-none"><i class="bi bi-house"></i></span>
                                                    <span class="d-none d-sm-block">NAF 2008</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#arrow-formeJuri" role="tab">
                                                    <span class="d-block d-sm-none"><i class="bi bi-person"></i></span>
                                                    <span class="d-none d-sm-block">Formes Juridiques</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#arrow-institutions" role="tab">
                                                    <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Institutions</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#arrow-fonctions" role="tab">
                                                    <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Fonctions</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#arrow-effectifs" role="tab">
                                                    <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Effectifs</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#arrow-chAff" role="tab">
                                                    <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Chiffre d'Affaires</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#arrow-dateCreation" role="tab">
                                                    <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Date de création</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#arrow-type" role="tab">
                                                    <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Type d'établissement</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#arrow-cCol" role="tab">
                                                    <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Conventions collectives</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content text-muted">
                                            <div class="tab-pane active" id="arrow-naf2008" role="tabpanel">
                                                <div class="row g-3">

                                                    <div class="col-lg-6">
                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Sélectionner :</p>
                                                            <div class="" style="margin-bottom: 10px;">
                                                                <input class="form-control" id="naf" name="naf" data-choices data-choices-limit="3" data-choices-removeItem type="text">
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Rechercher :</p>
                                                            <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                <select class="form-select mb-3" aria-label="Default select example" name="partenaire" id="partenaire">
                                                                    <option selected>Rechercher des codes NAF 2008</option>
                                                                    <?php
                                                                    $requete = "SELECT id, nom FROM gestion_partenaire ORDER BY nom ASC";
                                                                    $result = $bdd->executeQueryRequete($requete, 1);

                                                                    while ($partenaire = $result->fetch()) {
                                                                        echo '<option value="' . $partenaire->id . '">' . $partenaire->nom . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">

                                                        <div class="" style="margin-bottom: 10px;">
                                                            <p class="text-muted mb-1">Copier-coller :</p>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-text text-muted">
                                                                        <i class="bi bi-clipboard"></i>
                                                                    </span>
                                                                    <textarea class="form-control" rows="2" placeholder="Copier-coller des codes NAF 2008..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                    <button type="button" id="valider_naf" name="valider_naf" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                        <i class="bi bi-check2"></i> Valider
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                        <div class="input-group mb-1">
                                                            <input type="file" class="form-control" name="input_naf" id="input_naf" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                            <label class="input-group-text" for="inputGroupFile02">Choisir votre fichier</label>
                                                        </div>

                                                        <div class="row">
                                                            <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="inclu_naf" name="naf_inclure" value="true" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Inclure ces codes NAF 2008
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="exclu_naf" name="naf_inclure" value="false">
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Exclure ces codes NAF 2008
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="tab-pane" id="arrow-formeJuri" role="tabpanel">
                                                <div class="row g-3">
                                                    <div class="col-lg-6">
                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Sélectionner :</p>
                                                            <div class="" style="margin-bottom: 10px;">
                                                                <input class="form-control" id="forme_juridique" name="forme_juridique" data-choices data-choices-limit="3" data-choices-removeItem type="text">
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Rechercher :</p>
                                                            <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                <select class="form-select mb-3" aria-label="Default select example" name="partenaire" id="partenaire">
                                                                    <option selected>Rechercher des formes juridiques</option>
                                                                    <?php
                                                                    $requete = "SELECT id, nom FROM gestion_partenaire ORDER BY nom ASC";
                                                                    $result = $bdd->executeQueryRequete($requete, 1);

                                                                    while ($partenaire = $result->fetch()) {
                                                                        echo '<option value="' . $partenaire->id . '">' . $partenaire->nom . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">

                                                        <div class="" style="margin-bottom: 10px;">
                                                            <p class="text-muted mb-1">Copier-coller :</p>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-text text-muted">
                                                                        <i class="bi bi-clipboard"></i>
                                                                    </span>
                                                                    <textarea class="form-control" rows="2" placeholder="Copier-coller des code postaux..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                    <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                        <i class="bi bi-check2"></i> Valider
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                        <div class="input-group mb-1">
                                                            <input type="file" class="form-control" class="form-control" name="input_form_juridique" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                        </div>

                                                        <div class="row">
                                                            <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="inclu_form_juridique" name="form_juridique_inclure" value="true" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Inclure ces formes juridiques
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="exclu_form_juridique" name="form_juridique_inclure" value="false">
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Exclure ces codes formes juridiques
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="tab-pane" id="arrow-institutions" role="tabpanel">
                                                <div class="row g-3">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <p class="text-muted mb-1">Liste des institutions disponibles :</p>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="institution[]" value="1">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Mairies</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="institution[]" value="2">
                                                                    <label class="form-check-label" for="customSwitchsizelg">EPCI</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="institution[]" value="3">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Conseils départementaux</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="institution[]" value="4">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Conseils généraux</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="institution[]" value="4">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Députés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="institution[]" value="4">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Sénateurs</label>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted" style="margin-bottom: 10px;">Vous
                                                                pouvez choisir une ou plusieurs institutions</small>
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <input type="radio" class="btn-check" name="fj_tout_cocher" id="success-outlined" checked>
                                                                    <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                    <input type="radio" class="btn-check" name="fj_tout_decocher" id="danger-outlined">
                                                                    <label class="btn btn-outline-light" for="danger-outlined">Tout décocher</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="arrow-fonctions" role="tabpanel">
                                                <div class="row g-3">
                                                    <div class="col-lg-6">
                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Sélectionner :</p>
                                                            <div class="" style="margin-bottom: 10px;">
                                                                <input class="form-control" name="occurrence" id="occurrence" data-choices data-choices-limit="3" data-choices-removeItem type="text">
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Rechercher :</p>
                                                            <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                <select class="form-select mb-3" aria-label="Default select example" name="partenaire" id="partenaire">
                                                                    <option selected>Rechercher des fonctions</option>
                                                                    <?php
                                                                    $requete = "SELECT id, nom FROM gestion_partenaire ORDER BY nom ASC";
                                                                    $result = $bdd->executeQueryRequete($requete, 1);

                                                                    while ($partenaire = $result->fetch()) {
                                                                        echo '<option value="' . $partenaire->id . '">' . $partenaire->nom . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">

                                                        <div class="" style="margin-bottom: 10px;">
                                                            <p class="text-muted mb-1">Copier-coller :</p>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-text text-muted">
                                                                        <i class="bi bi-clipboard"></i>
                                                                    </span>
                                                                    <textarea class="form-control" rows="2" placeholder="Copier-coller des code postaux..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                    <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                        <i class="bi bi-check2"></i> Valider
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                        <div class="input-group mb-1">
                                                            <input type="file" class="form-control" name="inputfile" id="inputfile" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                        </div>

                                                        <div class="row">
                                                            <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" name="inclure_fonction" id="inclure_fonction" value="true" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Inclure ces fonctions
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" name="exclure_fonction" id="exclure_fonction" value="false">
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Exclure ces fonctions
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="tab-pane" id="arrow-effectifs" role="tabpanel">
                                                <div class="row g-3">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <p class="text-muted mb-1">Liste des tranches d'éffectifs disponibles
                                                                disponibles :</p>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Effectif inconnu</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">0 salarié</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">1 ou 2 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">3 à 4 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">6 à 9 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">10 à 19 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">20 à 49 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">50 à 99 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">100 à 119 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">200 à 249 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">250 à 499 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">500 à 999 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">1000 à 1999 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">2000 à 4999 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">5000 à 9999 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">10000 salariés et plus</label>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted" style="margin-bottom: 10px;">Vous
                                                                pouvez choisir un ou plusieurs tranches d'éffectifs</small>
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <input type="radio" class="btn-check" name="effectif_tout_cocher" id="success-outlined" checked>
                                                                    <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                    <input type="radio" class="btn-check" name="effectif_tout_decocher" id="danger-outlined">
                                                                    <label class="btn btn-outline-light" for="danger-outlined">Tout décocher</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="arrow-chAff" role="tabpanel">
                                                <div class="row g-3">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <p class="text-muted mb-1">Liste des tranches de chiffre d'affaires disponibles :</p>
                                                            <div class="col-md-4">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="ca" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Moins de 1 million d'€</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="ca" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">De 1 à 2 million d'€</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="ca" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">De 2 à 5 million d'€</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="ca" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">De 5 à 10 million d'€</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="ca" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Plus de 10 million d'€</label>
                                                                </div>
                                                            </div>

                                                            <small class="text-muted" style="margin-bottom: 10px;">Vous pouvez choisir une ou plusieurs tranches de chiffres d'affaires</small>
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <input type="radio" class="btn-check" name="chAff_tout_cocher" id="success-outlined" checked>
                                                                    <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                    <input type="radio" class="btn-check" name="chAff_tout_decocher" id="danger-outlined" checked>
                                                                    <label class="btn btn-outline-light" for="danger-outlined">Tout décocher</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                            <div class="col-4">
                                                                <div class="form-check form-radio-primary mb-0">
                                                                    <input class="form-check-input" type="radio" name="dataiecentreinteret" id="formradioRight5" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Inclure ces tranches de chiffre d'affaires
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-check form-radio-primary mb-0">
                                                                    <input class="form-check-input" type="radio" name="dataiecentreinteret" id="formradioRight5" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Exclure ces tranches de chiffre d'affaires
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <p class="text-muted mt-0 mb-0"><small>Vous pouvez inclure ou exclure la ou les tranches de chiffre d'affaires sélectionnées</small> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="arrow-dateCreation" role="tabpanel">
                                                <div class="row g-3 text-center">
                                                    <div class="text-center">
                                                        <h4 class="text-muted mb-1">Vous pouvez choisir une plage de date de création</h4>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="tab-pane show active " id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Choisir la date de début :</p>
                                                            <div class="" style="margin-bottom: 10px;">
                                                                <input name="date1-ins" type="date" id="date1-ins" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Choisir la date de fin :</p>
                                                            <div class="" style="margin-bottom: 10px;">
                                                                <input name="date2-ins" type="date" id="date2-ins" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="arrow-type" role="tabpanel">
                                                <div class="row g-3">

                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <p class="text-muted mb-1">Liste des catégories
                                                                socioprofessionnelles disponibles :</p>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="type_ets" id="customSwitchsizelg" name="csp[]" value="1">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Sièges sociaux</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="type_ets" id="customSwitchsizelg" name="csp[]" value="2">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Établissements secondaires</label>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted" style="margin-bottom: 10px;">Vous pouvez choisir une ou plusieurs types d'établissements</small>
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <input type="radio" class="btn-check" name="type_tout_cocher" id="success-outlined" checked>
                                                                    <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                    <input type="radio" class="btn-check" name="type_tout_decocher" id="danger-outlined">
                                                                    <label class="btn btn-outline-light" for="danger-outlined">Tout décocher</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="tab-pane" id="arrow-cCol" role="tabpanel">
                                                <div class="row g-3">

                                                    <div class="col-lg-6">
                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Sélectionner :</p>
                                                            <div class="" style="margin-bottom: 10px;">
                                                                <input class="form-control" id="choices-cCol" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="ConvCollectif01">
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Rechercher :</p>
                                                            <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                <select class="form-select mb-3" aria-label="Default select example" name="partenaire" id="partenaire">
                                                                    <option selected>Rechercher des conventions collectives</option>
                                                                    <?php
                                                                    $requete = "SELECT id, nom FROM gestion_partenaire ORDER BY nom ASC";
                                                                    $result = $bdd->executeQueryRequete($requete, 1);

                                                                    while ($partenaire = $result->fetch()) {
                                                                        echo '<option value="' . $partenaire->id . '">' . $partenaire->nom . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">

                                                        <div class="" style="margin-bottom: 10px;">
                                                            <p class="text-muted mb-1">Copier-coller :</p>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-text text-muted">
                                                                        <i class="bi bi-clipboard"></i>
                                                                    </span>
                                                                    <textarea class="form-control" rows="2" placeholder="Copier-coller des code postaux..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                    <button type="button" id="valider_cCol" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                        <i class="bi bi-check2"></i> Valider
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                        <div class="input-group mb-1">
                                                            <input type="file" class="form-control" name="input_cCol" id="inputfile" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                        </div>

                                                        <div class="row">
                                                            <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                            <div class="col-12">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="inclu_cCol" name="inclu_cCol" value="true" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Inclure ces conventions collectives
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="exclu_cCol" name="exclu_cCol" value="false">
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Exclure ces conventions collectives
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->

                            </div>
                            <!--end col-->
                            <div class="col-xxl-3">
                                <div class="row">
                                    <div class="col-xxl-12 col-lg-6">
                                        <div class="card card-height-100">
                                            <div class="card-body">
                                                <ul class="nav nav-pills nav-fill nav-secondary gap-1 p-1 small bg-light rounded-pill shadow-sm" id="balanceWidgets" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active rounded-pill" id="balance-tab" data-bs-toggle="pill" data-bs-target="#balance" type="button" role="tab" aria-controls="balance" aria-selected="true">Balance</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link rounded-pill" id="pending-tab" data-bs-toggle="pill" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="false">Pending</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content mt-3" id="balanceWidgetsContent">
                                                    <div class="tab-pane show active" id="balance" role="tabpanel" aria-labelledby="balance-tab" tabindex="0">
                                                        <div class="d-flex gap-2">
                                                            <div class="flex-grow-1">
                                                                <h5>$23,475.97</h5>
                                                                <p class="text-muted mb-0">14:35:21</p>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <select class="form-control" id="choices-single-no-search2" name="choices-single-no-search2" data-choices data-choices-search-false>
                                                                    <option value="ETH">ETH</option>
                                                                    <option value="BTC">BTC</option>
                                                                    <option value="LTC">LTC</option>
                                                                    <option value="SOL">SOL</option>
                                                                    <option value="USD">USD</option>
                                                                    <option value="DCR">DCR</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="pt-4 mt-4 border-top">
                                                            <div class="row gy-3">
                                                                <div class="col-md-4">
                                                                    <h6 class="mb-1">$120.48</h6>
                                                                    <p class="text-muted mb-0">Daily volume</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h6 class="mb-1">0.074</h6>
                                                                    <p class="text-muted mb-0">BTC volume</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h6 class="mb-1">0.64%</h6>
                                                                    <p class="text-muted mb-0">% amount</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hstack gap-2 mt-4">
                                                            <button class="btn btn-primary w-100">Deposit</button>
                                                            <button class="btn btn-outline-primary w-100">Withdraw</button>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="pending" role="tabpanel" aria-labelledby="pending-tab" tabindex="0">
                                                        <div class="d-flex gap-2">
                                                            <div class="flex-grow-1">
                                                                <h5>$14,941.26</h5>
                                                                <p class="text-muted mb-0">08:27:39</p>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <select class="form-control" id="choices-single-no-search" name="choices-single-no-search" data-choices data-choices-search-false>
                                                                    <option value="ETH">ETH</option>
                                                                    <option value="BTC">BTC</option>
                                                                    <option value="LTC">LTC</option>
                                                                    <option value="SOL">SOL</option>
                                                                    <option value="USD">USD</option>
                                                                    <option value="DCR">DCR</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="pt-4 mt-4 border-top">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <h6 class="mb-1">$97.11</h6>
                                                                    <p class="text-muted mb-0">Daily volume</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h6 class="mb-1">0.024</h6>
                                                                    <p class="text-muted mb-0">BTC volume</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h6 class="mb-1">0.87%</h6>
                                                                    <p class="text-muted mb-0">% amount</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hstack gap-2 mt-4">
                                                            <a href="apps-crypto-transactions.php" class="btn btn-primary w-100">View Transaction</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-12 col-lg-6">
                                        <div class="card card-height-100">
                                            <div class="card-header align-items-center d-flex">
                                                <h6 class="card-title mb-0 flex-grow-1">Précédentes recherches</h6>
                                                <div class="flex-shrink-0">
                                                    <a class="icon-link" href="apps-crypto-transactions.php">
                                                        View All <i class="bi bi-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-unstyled vstack gap-3 mb-0">
                                                    <li class="d-flex align-items-center gap-2 position-relative">
                                                        <img src="https://img.themesbrand.com/judia/svg/crypto-icons/btc.svg" alt="" class="avatar-xxs">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.php" class="stretched-link">
                                                                <h6 class="fs-sm mb-0">Bitcoin (BTC)</h6>
                                                            </a>
                                                            <p class="text-danger fs-xs mb-0">Buy</p>
                                                        </div>
                                                        <div class="text-end flex-shrink-0">
                                                            <h6 class="fs-sm mb-0">$154.31</h6>
                                                            <p class="text-muted fs-xs mb-0">21 June, 2023</p>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2 position-relative">
                                                        <img src="https://img.themesbrand.com/judia/svg/crypto-icons/usdt.svg" alt="" class="avatar-xxs">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.php" class="stretched-link">
                                                                <h6 class="fs-sm mb-0">Tether (USDT)</h6>
                                                            </a>
                                                            <p class="text-success fs-xs mb-0">Sell</p>
                                                        </div>
                                                        <div class="text-end flex-shrink-0">
                                                            <h6 class="fs-sm mb-0">$2.5487</h6>
                                                            <p class="text-muted fs-xs mb-0">19 June, 2023</p>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2 position-relative">
                                                        <img src="https://img.themesbrand.com/judia/svg/crypto-icons/dcr.svg" alt="" class="avatar-xxs">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.php" class="stretched-link">
                                                                <h6 class="fs-sm mb-0">Decred (DCR)</h6>
                                                            </a>
                                                            <p class="text-danger fs-xs mb-0">Buy</p>
                                                        </div>
                                                        <div class="text-end flex-shrink-0">
                                                            <h6 class="fs-sm mb-0">$136.97</h6>
                                                            <p class="text-muted fs-xs mb-0">14 June, 2023</p>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2 position-relative">
                                                        <img src="https://img.themesbrand.com/judia/svg/crypto-icons/eth.svg" alt="" class="avatar-xxs">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.php" class="stretched-link">
                                                                <h6 class="fs-sm mb-0">Ethereum (ETH)</h6>
                                                            </a>
                                                            <p class="text-success fs-xs mb-0">Sell</p>
                                                        </div>
                                                        <div class="text-end flex-shrink-0">
                                                            <h6 class="fs-sm mb-0">$324.15</h6>
                                                            <p class="text-muted fs-xs mb-0">01 June, 2023</p>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2 position-relative">
                                                        <img src="https://img.themesbrand.com/judia/svg/crypto-icons/aave.svg" alt="" class="avatar-xxs">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.php" class="stretched-link">
                                                                <h6 class="fs-sm mb-0">Aave (AAVE)</h6>
                                                            </a>
                                                            <p class="text-danger fs-xs mb-0">Buy</p>
                                                        </div>
                                                        <div class="text-end flex-shrink-0">
                                                            <h6 class="fs-sm mb-0">$87.64</h6>
                                                            <p class="text-muted fs-xs mb-0">27 May, 2023</p>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex align-items-center gap-2 position-relative">
                                                        <img src="https://img.themesbrand.com/judia/svg/crypto-icons/ltc.svg" alt="" class="avatar-xxs">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.php" class="stretched-link">
                                                                <h6 class="fs-sm mb-0">Litecoin (LTC)</h6>
                                                            </a>
                                                            <p class="text-danger fs-xs mb-0">Buy</p>
                                                        </div>
                                                        <div class="text-end flex-shrink-0">
                                                            <h6 class="fs-sm mb-0">$874.31</h6>
                                                            <p class="text-muted fs-xs mb-0">17 May, 2023</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
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
        const inclu_fonction = document.getElementById('inclu_fonction');
        const exclu_fonction = document.getElementById('exclu_fonction');
        const checkbox1 = document.getElementById('checkbox1');
        const checkbox2 = document.getElementById('checkbox2');
        const inclu_pays = document.getElementById('inclu_pays');
        const exclu_pays = document.getElementById('exclu_pays');
        const inclu_ville = document.getElementById('inclu_ville');
        const exclu_ville = document.getElementById('exclu_ville');

        const inclu_form_juridique = document.getElementById('inclu_form_juridique')
        const exclu_form_juridique = document.getElementById('exclu_form_juridique')
        const inclu_naf = document.getElementById('inclu_naf')
        const exclu_naf = document.getElementById('exclu_naf')

        inclu_naf.addEventListener('change', function() {
            if (this.checked) {
                exclu_naf.checked = false;
            }
        });
        exclu_naf.addEventListener('change', function() {
            if (this.checked) {
                inclu_naf.checked = false;
            }
        });

        inclu_fonction.addEventListener('change', function() {
            if (this.checked) {
                exclu_fonction.checked = false;
            }
        });
        exclu_fonction.addEventListener('change', function() {
            if (this.checked) {
                inclu_fonction.checked = false;
            }
        });

        inclu_form_juridique.addEventListener('change', function() {
            if (this.checked) {
                exclu_form_juridique.checked = false;
            }
        });
        exclu_form_juridique.addEventListener('change', function() {
            if (this.checked) {
                inclu_form_juridique.checked = false;
            }
        });

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
            $("#age_min").val($("div#rangeSlider div.ui-rangeSlider-leftLabel div.ui-rangeSlider-label-value").text());
            $("#age_max").val($("div#rangeSlider div.ui-rangeSlider-rightLabel div.ui-rangeSlider-label-value").text());
        });









        $(document).ready(function() {

            //Fonction des fichiers input ville pays cp

            // my input
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
                            const input = $('<input type="hidden" name="lignes" value="' + lignes + '">');
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
                            const input = $('<input type="hidden" name="input_pays" value="' + pays + '">');
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
                            const input = $('<input type="hidden" name="input_ville" value="' + villes + '">');
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

            $('#input_naf').on("change", function() {
                // FormData permet d'envoyer des fichiers avec AJAX
                const formData4 = new FormData();

                // Récupérer le fichier sélectionné
                const file = $(this)[0].files[0];

                // Ajouter le fichier au FormData
                formData4.append('input_naf', file);
                $.ajax({
                    url: "naf_csv.php",
                    type: "post",
                    data: formData4,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Parse the JSON response
                        try {
                            const nafs = JSON.parse(response);
                            const input = $('<input type="hidden" name="input_naf" value="' + nafs + '">');
                            $("#form_search_db").append(input);
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

            $('#input_form_juridique').on("change", function() {
                // FormData permet d'envoyer des fichiers avec AJAX
                const formData5 = new FormData();

                // Récupérer le fichier sélectionné
                const file = $(this)[0].files[0];

                // Ajouter le fichier au FormData
                formData5.append('input_form_juridique', file);
                $.ajax({
                    url: "form_juridique_csv.php",
                    type: "post",
                    data: formData5,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Parse the JSON response
                        try {
                            const form_juridique = JSON.parse(response);
                            const input = $('<input type="hidden" name="form_juridique" value="' + form_juridique + '">');
                            $("#form_search_db").append(input);
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

            // Fin des fonction ajoutés nouvellement pays ville cpde postal



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

            $('input[type=checkbox], input[type=radio], input[type=hidden], select').on("change", function() {
                ajaxRequest();
            });



            $('input[type=text]').on("keyup", function() {
                ajaxRequest();
            });

            $('#age, #age-slider, #occurrence, #occurrence-slider').on("mouseup", function() {
                $("#age_min").val($("div#rangeSlider div.ui-rangeSlider-leftLabel div.ui-rangeSlider-label-value").text());
                $("#age_max").val($("div#rangeSlider div.ui-rangeSlider-rightLabel div.ui-rangeSlider-label-value").text());

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
                            $("#input_dep").val($("#input_dep").val() + ', ' + code + ' (' + region + ')');
                        } else {
                            $("#input_cp").val($("#input_cp").val().replace(',' + code, ''));
                            $("#input_cp").val($("#input_cp").val().replace(code + ',', ''));
                            $("#input_cp").val($("#input_cp").val().replace(code, ''));

                            $("#input_dep").val($("#input_dep").val().replace(', ' + code + ' (' + region + ')', ''));
                            $("#input_dep").val($("#input_dep").val().replace(code + ' (' + region + ')' + ', ', ''));
                            $("#input_dep").val($("#input_dep").val().replace(code + ' (' + region + ')', ''));
                        }
                    }

                    ajaxRequest();
                }
            });
        });

        function ajaxRequest() {
            $.ajax({
                url: "count_b2b.php",
                type: "post",
                data: $("#form_search_db").serialize(),
                complete: function(xhr, result) {
                    var print = xhr.responseText.split("|");
                    //alert(xhr.responseText.split("|"))
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