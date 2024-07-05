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

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.7/themes/odometer-theme-default.css" integrity="sha512-kMPqFnKueEwgQFzXLEEl671aHhQqrZLS5IP3HzqdfozaST/EgU+/wkM07JCmXFAt9GO810I//8DBonsJUzGQsQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="assets/libs/nouislider/nouislider.min.css">
    <!-- Sweet Alert css-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- dropzone css -->
    <link href="assets/libs/dropzone/dropzone.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="assets/libs/multi.js/multi.min.css" >
    <!-- autocomplete css -->
    <link rel="stylesheet" href="assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css">

    <?php include 'partials/head-css.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/multi.js/dist/multi.min.js"></script>

    <style>
        .strikethrough {
            text-decoration: line-through;
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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Recherche', 'title' => 'Recherches B2C')); ?>
                            </div>
                            <!--end col-->
                            <div class="col-md-auto ms-auto">
                                <?php include 'partials/customizer.php'; ?>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <form method="POST" action="search_a_btoc.php" name="form_search_db" id="form_search_db">
                    <div class="row">
                        <div class="col-xxl-9">

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
                                                        <input type="checkbox" checked name="type[]" value="email" class="form-check-input" id="inlineswitch">
                                                        <label class="form-check-label" for="inlineswitch">@
                                                            E-mail</label>
                                                    </div>
                                                    <div class="form-check form-switch form-check-inline" dir="ltr">
                                                        <input type="checkbox" name="type[]" value="tel_mobile" class="form-check-input" id="inlineswitch1">
                                                        <label class="form-check-label" for="inlineswitch1">Mobile</label>
                                                    </div>
                                                    <div class="form-check form-switch form-check-inline" dir="ltr">
                                                        <input type="checkbox" name="type[]" value="cp" class="form-check-input" id="inlineswitchdisabled">
                                                        <label class="form-check-label" for="inlineswitchdisabled">Adresse postal</label>
                                                    </div>
                                                    <br>
                                                    &nbsp;
                                                </div>
                                            </div>
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
                                                                                    <?php
                                                                                    // Liste des pays prioritaires dans l'ordre voulu
                                                                                    $pays_prioritaires = ['France', 'Belgique', 'Suisse', 'Allemagne', 'Italie', 'Portugal', 'UK', 'Suède', 'Russie', 'Finlande', 'Roumanie', 'Hongrie', 'Espagne'];

                                                                                    // Requête pour obtenir tous les pays disponibles
                                                                                    $requete = "SELECT DISTINCT country_name FROM gestion_pays ORDER BY country_name";
                                                                                    $result = $bdd->executeQueryRequete($requete, 1);

                                                                                    // Tableaux pour stocker les pays
                                                                                    $pays_affiches = [];
                                                                                    $autres_pays = [];

                                                                                    // Filtrage des pays prioritaires et autres
                                                                                    while ($pays = $result->fetch()) {
                                                                                        if (in_array($pays->country_name, $pays_prioritaires)) {
                                                                                            $pays_affiches[$pays->country_name] = $pays->country_name;
                                                                                        } else {
                                                                                            $autres_pays[] = $pays->country_name;
                                                                                        }
                                                                                    }

                                                                                    // Assurez-vous que les pays prioritaires sont dans l'ordre spécifié
                                                                                    $pays_affiches_ordonnés = [];
                                                                                    foreach ($pays_prioritaires as $pays) {
                                                                                        if (isset($pays_affiches[$pays])) {
                                                                                            $pays_affiches_ordonnés[] = $pays;
                                                                                        }
                                                                                    }

                                                                                    // Compléter avec les autres pays jusqu'à atteindre 12
                                                                                    $pays_affiches_ordonnés = array_merge($pays_affiches_ordonnés, array_slice($autres_pays, 0, 12 - count($pays_affiches_ordonnés)));
                                                                                   
                                                                                    
                                                                                    // Affichage des pays
                                                                                    foreach ($pays_affiches_ordonnés as $pays) {
                                                                                    ?>
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                                <input type="checkbox" name="top_pays[]" id="top_pays" class="form-check-input pays-checkbox" value="<?= htmlspecialchars($pays) ?>">
                                                                                                <label class="form-check-label" for="customSwitchsizemd"><?= $pays ?></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
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
                                                                                <select class="form-control" id="choices-single-groups" name="pays" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                                    <option value="">Sélectionnez
                                                                                    </option>
                                                                                    <?php
                                                                                    $requete = "SELECT pays, extension FROM search_pays ORDER BY pays ASC";
                                                                                    $result = $bdd->executeQueryRequete($requete, 1);

                                                                                    while ($pays = $result->fetch()) {
                                                                                        echo '<option value="' . $pays->pays . '">' . $pays->pays . '</option>';
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="mt-0" style="margin-bottom: 10px;">
                                                                                <p class="text-muted mb-1">
                                                                                    Rechercher une ou plusieurs pays
                                                                                </p>
                                                                                <input class="form-control" name="autre_pays[]" id="choices-text-remove-button" data-choices  data-choices-removeItem type="text" >
                                                                            </div>
                                                                            <div class="" style="margin-bottom: 10px;">
                                                                                <p class="text-muted mb-1">
                                                                                    Copier-coller :</p>
                                                                                <div class="form-group">
                                                                                    <div class="input-group">
                                                                                            <span class="input-group-text text-muted">
                                                                                                <i class="bi bi-clipboard"></i>
                                                                                            </span>
                                                                                        <textarea class="form-control" rows="2" placeholder="Copier-coller des pays..." name="textarea_numreg" id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                        <!--<button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                            <i class="bi bi-check2"></i>
                                                                                            Valider
                                                                                        </button>-->
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
                                                                                        <input class="form-check-input" type="radio" id="inclu_pays" name="inclu_pays" value="true" checked>
                                                                                        <label class="form-check-label" for="formradioRight5">
                                                                                            Inclure ces pays
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-check form-radio-primary mb-3">
                                                                                        <input class="form-check-input" type="radio" id="exclu_pays" name="inclu_pays" value="false">
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
                                                                            <select id="multiselect_region"   multiple="multiple" name="regions[]" >
                                                                                

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
                                                                            
                                                                            <div style="margin-bottom: 10px;" id="select-container">
                                                                                <p class="text-muted mb-1">
                                                                                    Sélectionner une ou plusieurs régions
                                                                                </p>
                                                                                <select id="select_multiselect_region" class="form-control" name="regions[]" multiple>
                                                                                   <!-- <option value="">Sélectionnez</option>-->
                                                                                </select>
                                                                            </div>
                                                                            <div class="mt-0" style="margin-bottom: 10px;">
                                                                                <p class="text-muted mb-1">Ajouter un ou plusieurs regions</p>
                                                                                <input class="form-control" id="choices-text-remove-button" name="autres_regions" data-choices  data-choices-removeItem type="text" value="" >
                                                                            </div>
                                                                            <div class="" style="margin-bottom: 10px;">
                                                                                <p class="text-muted mb-1">
                                                                                    Copier-coller :</p>
                                                                                <div class="form-group">
                                                                                    <div class="input-group">
                                                                                                <span class="input-group-text text-muted">
                                                                                                    <i class="bi bi-clipboard"></i>
                                                                                                </span>
                                                                                        <textarea class="form-control" name="textarea_region" rows="2" placeholder="Copier-coller des régions..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                        <!--<button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                            <i class="bi bi-check2"></i> Valider
                                                                                        </button>-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <p class="text-muted mt-1 mb-1">Envoyer
                                                                                un fichier</p>
                                                                            <div class="input-group mb-1">
                                                                                <input type="file" name="input_regions" id="input_regions" class="form-control" >
                                                                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                            </div>

                                                                            <div class="row">
                                                                                <p class="text-muted mt-2 mb-1">
                                                                                    Inclure ou exclure</p>
                                                                                <div class="col-6">
                                                                                    <div class="form-check form-radio-primary mb-3">
                                                                                        <input class="form-check-input" type="radio" name="inclu_region" id="formradioRight5" checked value="true">
                                                                                        <label class="form-check-label" for="formradioRight5">
                                                                                            Inclure ces régions
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-check form-radio-primary mb-3">
                                                                                        <input class="form-check-input" type="radio" name="inclu_region" id="formradioRight5" value="false">
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
                                                                        <div class="mt-1 mt-lg-0 " >
                                                                            <p class="text-muted mb-1">Rechercher un
                                                                                ou plusieurs département </p>
                                                                            <select id="multiselect_departement" multiple="multiple" name="geoloc[]" >

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
                                                                            <div style="margin-bottom: 10px;" id="select_container">
                                                                                <p class="text-muted mb-1">Sélectionner un ou plusieurs départements </p>
                                                                                <select id="select_multiselect_departement" class="form-control"  name="geoloc[]" multiple>
                                                                               
                                                                                </select>
                                                                            </div>
                                                                            <div class="mt-0" style="margin-bottom: 10px;">
                                                                                <p class="text-muted mb-1">Ajouter d'autres départements</p>
                                                                                <input class="form-control" data-placeholder="01 02 03" id="choices-text-remove-button" data-choices  data-choices-removeItem type="text" value="" name="autres_dep">
                                                                            </div>
                                                                            <div class="" style="margin-bottom: 10px;">
                                                                                <p class="text-muted mb-1">
                                                                                    Copier-coller :</p>
                                                                                <div class="form-group">
                                                                                    <div class="input-group">
                                                                                                <span class="input-group-text text-muted">
                                                                                                    <i class="bi bi-clipboard"></i>
                                                                                                </span>
                                                                                        <textarea name="textarea_dep" class="form-control" rows="2" placeholder="Copier-coller des departements..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                        <!--<button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                            <i class="bi bi-check2"></i> Valider
                                                                                        </button>-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <p class="text-muted mt-1 mb-1">Envoyer
                                                                                un fichier</p>
                                                                            <div class="input-group mb-1">
                                                                                <input type="file" name="input_dep" id="input_dep"   class="form-control" data-id="inputGroupFile02">
                                                                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                            </div>

                                                                            <div class="row">
                                                                                <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                                                <div class="col-6">
                                                                                    <div class="form-check form-radio-primary mb-3">
                                                                                        <input class="form-check-input" type="radio" name="inclure_dep" id="formradioRight5" value="true" checked>
                                                                                        <label class="form-check-label" for="formradioRight5">
                                                                                            Inclure ces  départements
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-check form-radio-primary mb-3">
                                                                                        <input class="form-check-input" type="radio" name="inclure_dep" value="false" id="formradioRight5">
                                                                                        <label class="form-check-label" for="formradioRight5">
                                                                                            Exclure ces  départements
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
                                                                <p class="text-muted mb-1">Les 12 Tops des villes </p>
                                                                <div class="row">
                                                                    <?php
                                                                    // Liste des villes prioritaires dans l'ordre voulu
                                                                    $villes_prioritaires = ['Paris', 'Bruxelles', 'Berne', 'Berlin', 'Rome', 'Lisbonne', 'Londres', 'Stockholm', 'Moscou', 'Helsinki', 'Bucarest', 'Budapest', 'Madrid'];

                                                                    // Requête pour obtenir toutes les villes disponibles
                                                                    $requete1 = "SELECT DISTINCT city_name FROM gestion_pays";
                                                                    $result1 = $bdd->executeQueryRequete($requete1, 1);

                                                                    // Tableaux pour stocker les villes
                                                                    $villes_affichees = [];
                                                                    $autres_villes = [];
                                                                   
                                                                    // Filtrage des villes prioritaires et autres
                                                                    while ($ville = $result1->fetch()) {
                                                                        if (in_array($ville->city_name, $villes_prioritaires)) {
                                                                            $villes_affichees[$ville->city_name ]= $ville->city_name;
                                                                        } else {
                                                                            $autres_villes[] = $ville->city_name;
                                                                        }
                                                                    }
                                                                
                                                                    // Assurez-vous que les villes prioritaires sont dans l'ordre spécifié
                                                                    $villes_affichees_ordonnees = [];
                                                                    foreach ($villes_prioritaires as $ville) {
                                                                        if (isset($villes_affichees[$ville])) {
                                                                            $villes_affichees_ordonnees[] = $ville;
                                                                        }
                                                                    }
                                                                   // var_dump($villes_affichees_ordonnees);

                                                                        // Compléter avec les autres villes jusqu'à atteindre 12
                                                                       // $villes_affichees_ordonnees = array_merge($villes_affichees_ordonnees, array_slice($autres_villes, 0, 12 - count($villes_affichees_ordonnees)));
                                                                        // Affichage des villes
                                                                        foreach ($villes_affichees_ordonnees as $ville) {
                                                                        ?>
                                                                            <div class="col-lg-6">
                                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                    <input type="checkbox" name="villes[]" id="top_villes_<?= htmlspecialchars($ville) ?>" class="form-check-input pays-checkbox" value="<?= htmlspecialchars($ville) ?>">
                                                                                    <label class="form-check-label" for="top_villes_<?= htmlspecialchars($ville) ?>"><?= htmlspecialchars($ville) ?></label>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                </div>

                                                            </div>
                                                            <br>
                                                            &nbsp;
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mt-1 mb-0 mt-lg-0">
                                                                <div style="margin-bottom: 10px;" id="ville_container">
                                                                    <p class="text-muted mb-1">Sélectionner une ou plusieurs villes </p>
                                                                    <select class="form-control" name="villes[]" id="select_multiselect_ville" data-placeholder="Select City" data-choices-removeItem multiple>

                                                                       
                                                                    </select>
                                                                </div>
                                                                <div class="mt-0" style="margin-bottom: 10px;">
                                                                    <p class="text-muted mb-1">Rechercher une ou plusieurs villes</p>
                                                                    <input class="form-control" name="autres_villes" id="choices-text-remove-button" data-choices  data-choices-removeItem type="text" value="" >
                                                                </div>
                                                                <div class="" style="margin-bottom: 10px;">
                                                                    <p class="text-muted mb-1">Copier-coller :</p>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                                <span class="input-group-text text-muted">
                                                                                    <i class="bi bi-clipboard"></i>
                                                                                </span>
                                                                            <textarea class="form-control" name="textarea_ville" rows="2" placeholder="Copier-coller des villes..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                            <!--<button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                <i class="bi bi-check2"></i> Valider
                                                                            </button>-->
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <p class="text-muted mt-1 mb-1">Envoyer un fichier
                                                                </p>
                                                                <div class="input-group mb-1">
                                                                    <input type="file" class="form-control" name="villes_input" id="villes_input" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                </div>

                                                                <div class="row">
                                                                    <p class="text-muted mt-2 mb-1">Inclure ou
                                                                        exclure</p>
                                                                    <div class="col-6">
                                                                        <div class="form-check form-radio-primary mb-3">
                                                                            <input class="form-check-input" type="radio" id="inclu_ville" name="inclu_ville" value="true" checked >
                                                                            <label class="form-check-label" for="formradioRight5">
                                                                                Inclure ces villes
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-check form-radio-primary mb-3">
                                                                            <input class="form-check-input" type="radio" id="exclu_ville" name="inclu_ville" value="false">
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
                                                        <!--<div class="col-lg-6">
                                                            <div class="mt-1 mt-lg-0">
                                                                <p class="text-muted mb-1">Rechercher un ou
                                                                    plusieurs codes postaux</p>
                                                                <select id="multiselect_postaux" multiple="multiple" name="favorite_cars" >
                                                                    
                                                                </select>
                                                            </div>
                                                            <br>
                                                            &nbsp;
                                                        </div>-->
                                                        <div class="col-lg-6">
                                                            <div class="mt-1 mb-0 mt-lg-0">
                                                                <div style="margin-bottom: 10px;">
                                                                    <p class="text-muted mb-1">Sélectionner un ou plusieurs codes postaux</p>
                                                                    <select class="form-control" id="multiple_code_postal" data-choices data-choices-groups   data-choices-removeItem name="selectcp[]" multiple>
                                                                        <option value="">Sélectionnez</option>
                                                                        <?php
                                                                        $requete = "SELECT DISTINCT code_postal, nom_departement FROM cp_france_data ORDER BY code_postal ASC LIMIT 1000";
                                                                        $result = $bdd->executeQueryRequete($requete, 1);

                                                                        while( $pays = $result->fetch() ) {
                                                                            echo '<option value="'.$pays->code_postal.'">'.$pays->code_postal.' (' .$pays->nom_departement.')</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="mt-0" style="margin-bottom: 10px;">
                                                                    <p class="text-muted mb-1">Ajouter d'autres code postaux</p>
                                                                    <input class="form-control" id="choices-text-remove-button" data-choices data-choices-removeItem type="text" value="" name="autre_cp" >
                                                                </div>
                                                                <div class="" style="margin-bottom: 10px;">
                                                                    <p class="text-muted mb-1">Copier-coller :</p>
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                                <span class="input-group-text text-muted">
                                                                                    <i class="bi bi-clipboard"></i>
                                                                                </span>
                                                                            <textarea name="textarea_cp" class="form-control" rows="2" placeholder="Copier-coller des code postaux..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                            <!--<button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                <i class="bi bi-check2"></i> Valider
                                                                            </button>-->
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                                <div class="input-group mb-1">
                                                                    <input type="file" class="form-control" name="inputfile_cp" id="inputfile_cp" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                </div>

                                                                <div class="row">
                                                                    <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                                    <div class="col-6">
                                                                        <div class="form-check form-radio-primary mb-3">
                                                                            <input class="form-check-input" type="radio"  id="checkbox1" name="inclu_cp" value="true" checked>
                                                                            <label class="form-check-label" for="formradioRight5">
                                                                                Inclure ces codes postaux
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-check form-radio-primary mb-3">
                                                                            <input class="form-check-input" type="radio" id="checkbox2" name="inclu_cp" value="false">
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
                                            <a class="nav-link active" data-bs-toggle="tab" href="#arrow-sexe" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-house"></i></span>
                                                <span class="d-none d-sm-block">Sexes</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-ages" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-person"></i></span>
                                                <span class="d-none d-sm-block">Tranches d'âges</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-revenus" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                <span class="d-none d-sm-block">Revenus</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-habitat" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                <span class="d-none d-sm-block">Habitat</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-famille" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                <span class="d-none d-sm-block">Famille</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-interet" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                <span class="d-none d-sm-block">Centre d'intèrêt</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-profession" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                <span class="d-none d-sm-block">Professions</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-imposition" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                <span class="d-none d-sm-block">Imposition</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content text-muted">
                                        <div class="tab-pane active" id="arrow-sexe" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <p class="text-muted mb-1">Liste des sexes disponibles :</p>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" class="form-check-input" name="gender" value="homme" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Hommes</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" class="form-check-input" name="gender" value="femme" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Femmes</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                        <div class="col-6">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" type="radio" name="inclu_genre" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Inclure ces sexes
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="off" type="radio" name="inclu_genre" id="formradioRight5">
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Exclure ces sexes
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="arrow-ages" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <p class="text-muted mb-1">Liste des tranches d'âges disponibles :</p>
                                                        <div class="col-6">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" value="18" name="age" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">18 à 25 ans</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" value="26" name="age" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">26 à 35 ans</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" value="36" name="age" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">36 à 50 ans</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" value="51" name="age" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">51 à 65 ans</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" value="66" name="age" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">66 ans et plus</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <p class="text-muted mb-1"> Définition de plages d'âges personnalisées :</p>
                                                    </div>
                                                    <div style="margin-bottom: 10px;">
                                                        <h5 class="fs-sm fw-medium text-muted mb-1">Âge minimum</h5>
                                                        <div class="input-step full-width">
                                                            <button type="button" class="minus">–</button>
                                                            <input type="number" name="age_min" class="product-quantity" placeholder="Saisir l'âge min" style="text-align: center;" min="18" max="100">
                                                            <button type="button" class="plus">+</button>
                                                        </div>
                                                    </div>
                                                    <div style="margin-bottom: 10px;">
                                                        <h5 class="fs-sm fw-medium text-muted mb-1">Âge maximum</h5>
                                                        <div class="input-step full-width">
                                                            <button type="button" class="minus">–</button>
                                                            <input type="number" name="age_max" class="product-quantity" placeholder="Saisir l'âge max" style="text-align: center;" min="18" max="100">
                                                            <button type="button" class="plus">+</button>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                        <div class="col-6">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="on" type="radio" name="inclu_age" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Inclure ces tranches d'âges
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="off" type="radio" name="inclu_age" id="formradioRight5">
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Exclure ces tranches d'âges
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--<div class="col-12">
                                                    <div class="form-group ">
                                                        <label class="col-12 col-form-label">Sélectionner une plage d'âge personnalisée :</label>
                                                        <div class="col-12 pb-2">
                                                            <div class="slider" id="slider-pips"></div>
                                                            <div data-rangeslider></div>
                                                        </div>
                                                    </div>
                                                    <span class="form-text text-muted">Vous pouvez définir une plage d'âge personnalisée avec vos tranches</span>
                                                    <div class="kt-space-10"></div>
                                                </div>-->
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="arrow-revenus" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mb-1">Liste des catégories socioprofessionnelles disponibles :</p>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="csp" value="1">
                                                                <label class="form-check-label" for="customSwitchsizelg">Moins de 3000 €</label>
                                                                <code class="text-danger"><small>CSP+-</small></code>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="csp" value="2">
                                                                <label class="form-check-label" for="customSwitchsizelg">De 5000 à 7000 €</label>
                                                                <code class="text-danger"><small>CSP+-</small></code>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="csp" value="3">
                                                                <label class="form-check-label" for="customSwitchsizelg">Moins de 3000 €</label>
                                                                <code class="text-danger"><small>CSP+</small></code>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="csp" value="4">
                                                                <label class="form-check-label" for="customSwitchsizelg">Plus de 7000 </label>
                                                                <code class="text-danger"><small>CSP++</small></code>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted" style="margin-bottom: 10px;">Vous pouvez choisir une ou plusieurs catégories socioprofessionnelles</small>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <input type="radio" class="btn-check" value="on" name="cocherrevenue" id="success-outlined" checked>
                                                                <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                <input type="radio" class="btn-check" value="off" name="cocherrevenue" id="danger-outlined">
                                                                <label class="btn btn-outline-light" for="danger-outlined">Tout décocher</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="on" type="radio" name="inclu_csp" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Inclure ces catégories socioprofessionnelles
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="off" type="radio" name="inclu_csp" id="formradioRight5">
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Exclure ces catégories socioprofessionnelles
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="arrow-habitat" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mb-1">Liste des critères habitats disponibles :</p>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="1" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Propriétaire</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="2" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Locataire</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="3" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Appartement</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="4" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Maison</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="5" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Petit collectif</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="6" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Moyen collectif</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="7" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Grand collectif</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="8" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Très grand collectif</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="9" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Chauffage au bois</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="10" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Chauffage au fioul</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="11" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Chauffage au gaz</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="12" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Chauffage électrique</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="13" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Avec Jardin</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="habitats" value="14" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Projet de déménagement</label>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted" style="margin-bottom: 10px;">Vous pouvez choisir un ou plusieurs critères habitats</small>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <input type="radio" value="on" class="btn-check" name="cocherhabitat" id="success-outlined" checked>
                                                                <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                <input type="radio"  value="off" class="btn-check" name="cocherhabitat" id="danger-outlined">
                                                                <label class="btn btn-outline-light" for="danger-outlined">Tout décocher</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Opérateur logique entre les critères « critères habitats » :</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" type="radio" value="on" name="operateur_logique" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    opérateur « OU » <small class="text-muted">(séparer les critères)</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="off" type="radio" name="operateur_logique" id="formradioRight5">
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    opérateur « ET » <small class="text-muted">(cumuler les critères)</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-0">
                                                                <input class="form-check-input" type="radio" value="on" name="inclu_habitats" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Inclure ces critères habitats
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-0">
                                                                <input class="form-check-input" type="radio" value="off" name="inclu_habitats" id="formradioRight5" >
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Exclure ces critères habitats
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mt-0 mb-0"><small>Vous pouvez inclure ou exclure le ou les critères habitats sélectionnées</small> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="arrow-famille" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mb-1">Liste des critères familiaux disponibles :</p>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="familles" value="1" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Attend un enfant</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="familles" value="2" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Avec enfant(s)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="familles" value="3" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Concubin(e)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="familles" value="4" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Célibataire</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="familles" value="5" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Divorcé(e)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="familles" value="6" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Famille</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="familles" value="7" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Mariage prévu < 12 mois</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="familles" value="8" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Marié(e)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="familles" value="9"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Sans enfant</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="familles" value="10" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Séparé(e)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="familles" value="11" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Veuf(ve)</label>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted" style="margin-bottom: 10px;">Vous pouvez choisir un ou plusieurs critères familiaux</small>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <input type="radio" class="btn-check" name="cochefamiliaux" id="success-outlined" >
                                                                <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                <input type="radio" class="btn-check" name="cochefamiliaux" id="danger-outlined" checked>
                                                                <label class="btn btn-outline-light" for="danger-outlined">Tout décocher</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Opérateur logique entre les critères « critères familiaux » :</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="on" type="radio" name="operateur_logique" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    opérateur « OU » <small class="text-muted">(séparer les critères)</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="off" type="radio" name="operateur_logique" id="formradioRight5">
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    opérateur « ET » <small class="text-muted">(cumuler les critères)</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mt-0 mb-0"><small>Vous pouvez séparer ou cumuler les critères suivant l'opérateur choisi</small> </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-0">
                                                                <input class="form-check-input" value="on" type="radio" name="inclu_famille" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Inclure ces critères familiaux
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-0">
                                                                <input class="form-check-input" value="off" type="radio" name="inclu_famille" id="formradioRight5">
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Exclure ces critères familiaux
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mt-0 mb-0"><small>Vous pouvez inclure ou exclure le ou les critères familiaux sélectionnées</small> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="arrow-interet" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mb-1">Liste des familles de centres d'intérêt disponibles :</p>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="1" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Achat et investissement immobilier</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="2"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Animaux</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="3"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Assurance et prévoyance</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="4"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Automobile</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="5"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Banque</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="6"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Beauté, esthétique, Bien-être</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="7"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg"> Charme et érotisme</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="8"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Cuisine et Gastronomie</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="9"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg"> Divers</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="10"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg" >Equipement et décoration de l’habitat</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="11"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Films, séries et cinéma</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="12"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg"> Loisirs et Sorties</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="13"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Mode et Accessoires</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="14"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Nature et écologie</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="15"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg"> Paris et Jeux d'argent</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="16"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg"> Santé</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="17"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Shopping / Achats</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="18"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Sport</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="19"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg"> Vacances et voyages</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="ci" value="20"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg"> Voyance et ésotérisme</label>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted" style="margin-bottom: 10px;">Vous pouvez choisir un ou plusieurs centres d'intérêt</small>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <input type="radio" class="btn-check" name="cochecentreinteret" id="success-outlined" >
                                                                <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                <input type="radio" class="btn-check" name="cochecentreinteret" id="danger-outlined" checked>
                                                                <label class="btn btn-outline-light" for="danger-outlined">Tout décocher</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Opérateur logique entre les critères « familles de centres d'intérêt » :</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="on" type="radio" name="operateur_logique_famille_centre_interet" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    opérateur « OU » <small class="text-muted">(séparer les critères)</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="off" type="radio" name="operateur_logique_famille_centre_interet" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    opérateur « ET » <small class="text-muted">(cumuler les critères)</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Opérateur logique entre les critères « centres d'intérêt » :</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="on" type="radio" name="operateur_logique_centre_interet" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    opérateur « OU » <small class="text-muted">(séparer les critères)</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="off" type="radio" name="operateur_logique_centre_interet" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    opérateur « ET » <small class="text-muted">(cumuler les critères)</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-0">
                                                                <input class="form-check-input" value="on" type="radio" name="inclu_famille_centre_interet" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Inclure ces familles de centres d'intérêt
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-0">
                                                                <input class="form-check-input" value="off" type="radio" name="inclu_famille_centre_interet" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Exclure ces familles de centres d'intérêt
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mt-0 mb-0"><small>Vous pouvez inclure ou exclure la ou les familles de centres d'intérêt sélectionnées</small> </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-0">
                                                                <input class="form-check-input" value="on" type="radio" name="inclu_centre_interet" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Inclure ces centres d'intérêt
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-0">
                                                                <input class="form-check-input" value="off" type="radio" name="inclu_centre_interet" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Exclure ces centres d'intérêt
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mt-0 mb-0"><small>Vous pouvez inclure ou exclure le ou les centres d'intérêt sélectionnés</small> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="arrow-profession" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mb-1">Liste des professions disponibles :</p>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="professions" value="1" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Dirigeant(e)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="professions" value="2"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Enseignant</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="professions" value="3"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Fonctionnaire</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="professions" value="4"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Formation</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="professions" value="5"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Retraité(e)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="professions" value="6"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Salarié(e)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="professions" value="7"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Sans emploi</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="professions" value="8"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Marié(e)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="professions" value="9"  class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Étudiant(e)</label>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted" style="margin-bottom: 10px;">Vous pouvez choisir un ou plusieurs professions</small>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <input type="radio" class="btn-check" value="on" name="cocherprofession" id="success-outlined" >
                                                                <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                <input type="radio" class="btn-check" value="off" name="cocherprofession" id="danger-outlined" checked>
                                                                <label class="btn btn-outline-light" for="danger-outlined">Tout décocher</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Opérateur logique entre les critères « professions » :</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="on" type="radio" name="operation_logique" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    opérateur « OU » <small class="text-muted">(séparer les critères)</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="off" type="radio" name="operation_logique" id="formradioRight5" >
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    opérateur « ET » <small class="text-muted">(cumuler les critères)</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mt-0 mb-0"><small>Vous pouvez séparer ou cumuler les critères suivant l'opérateur choisi</small> </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-0">
                                                                <input class="form-check-input" value="on" type="radio" name="inclu_profession" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Inclure ces critères professions
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-0">
                                                                <input class="form-check-input" value="off" type="radio" name="inclu_profession" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Exclure ces critères professions
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mt-0 mb-0"><small>Vous pouvez inclure ou exclure le ou les professions sélectionnées</small> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="arrow-imposition" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mb-1">Liste des tranches d'imposition disponibles :</p>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="impositions" value="1" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Imposition < 6000 €</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="impositions" value="2" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Imposition > 6000 €</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="impositions" value="3" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Impôt sur la fortune immobilière (IFI)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                <input type="checkbox" name="impositions" value="4" class="form-check-input" id="customSwitchsizelg">
                                                                <label class="form-check-label" for="customSwitchsizelg">Non imposable</label>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">Vous pouvez choisir une ou plusieurs tranches d'imposition</small>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Opérateur logique entre les critères « tranches d'imposition » :</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="on"    type="radio" name="operation_logique" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    opérateur « OU » <small class="text-muted">(séparer les critères)</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" value="off" type="radio" name="operation_logique" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    opérateur « ET » <small class="text-muted">(cumuler les critères)</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mt-0 mb-0"><small>Vous pouvez inclure ou exclure la ou les tranches d'imposition sélectionnées</small> </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-0">
                                                                <input class="form-check-input" value="on" type="radio" name="inclu_imposition" id="formradioRight5" checked>
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Inclure ces critères d'imposition
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-check form-radio-primary mb-0">
                                                                <input class="form-check-input" value="off" type="radio" name="inclu_imposition" id="formradioRight5" >
                                                                <label class="form-check-label" for="formradioRight5">
                                                                    Exclure ces critères  d'imposition
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mt-0 mb-0"><small>Vous pouvez inclure ou exclure le ou les tranches d'imposition sélectionnées</small> </p>
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
                                                    <button class="nav-link active rounded-pill" id="balance-tab" data-bs-toggle="pill" data-bs-target="#balance" type="button" role="tab" aria-controls="balance" aria-selected="true" style="font-size: 10px">VOTRE COMPTAGE</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link rounded-pill" id="pending-tab" data-bs-toggle="pill" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="false" style="font-size: 10px"> DÉFINIR UN VOLUME </button>
                                                </li>
                                            </ul>
                                            <div class="tab-content mt-3" id="balanceWidgetsContent">
                                                <div class="tab-pane show active" id="balance" role="tabpanel" aria-labelledby="balance-tab" tabindex="0">
                                                    <div class="d-flex gap-2" style="margin-top: -10px !important;margin-bottom: -15px !important;">
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted mb-0" style="font-weight: bold">
                                                                Fiches <br /> (B2C)
                                                            </p>

                                                        </div>
                                                        <div class="flex-shrink-0 p-0 m-0"  id="requete-count" >
                                                            <!-- <span  class="counter-value" data-target="0">0</span>-->
                                                            <p class="odometer" style="font-size: 2.5em; font-weight: bold;">0</p>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="pt-2  border-top" style="margin-bottom: -10px !important;">
                                                        <div class="row gy-1">
                                                            <div  class="col-md-10 total" style="display: flex; justify-content: space-between">
                                                                <p class="text-muted" style="font-weight: bold" >Prix (€) <br /><span class="remise"></span> </p>
                                                                <h6 class="data odometer" style="font-size: 25px">0 </h6>
                                                                
                                                            </div>
                                                            <div class="col-md-2"><h6> € HT</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="pt-2 border-top" style="margin-bottom: -10px !important;">
                                                        <div class="row gy-1">
                                                            <div class="col-md-10" style="display: flex; justify-content: space-between">
                                                                <p class="text-muted " style="font-weight: bold" >Total <br />Hors Taxes</p>
                                                                <h6 class="total_prices odometer" style="font-size: 25px; margin-top: 4px">0 </h6>
                                                            </div>
                                                            <div class="col-md-2"><h6> € HT</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="pt-2 border-top" style="margin-bottom: -10px !important;">
                                                        <div class="row gy-1">
                                                            <button type="button" disabled class="cpm btn btn-light p-3 mt-2"></button>
                                                        </div>
                                                    </div>

                                                    <div class="pt-4 border-top">
                                                        <div class="row gy-1">
                                                            <div class="col-md-4">
                                                                <h6 class="mb-1 odometer">0</h6>
                                                                <p class="text-muted mb-0">Civilité(s)</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h6 class="mb-1 odometer">0</h6>
                                                                <p class="text-muted mb-0">Homme(s)</p>
                                                            </div>
                                                            <div class="col-md-4 ">
                                                                <h6 class="mb-1 odometer">0</h6>
                                                                <p class="text-muted mb-0">Femme(s)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="hstack gap-2 mt-4">
                                                        <button type="submit" class="btn btn-primary w-100">Enregistrer le comptage</button>
                                                        <!--                                                        <button class="btn btn-outline-primary w-100">Withdraw</button>-->
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
                                                    Voir tout <i class="bi bi-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled vstack gap-3 mb-0">
                                                <?php
                                                $requete = "SELECT id, name, result, date FROM counter ORDER BY id DESC LIMIT 10";
                                                $result = $bdd->executeQueryRequete($requete, 1);

                                                while( $search = $result->fetch() ) {

                                                    ?>
                                                    <li class="d-flex align-items-center gap-2 position-relative">
                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/7d/Refresh_icon.svg" alt="" class="avatar-xxs">
                                                        <div class="flex-grow-1">
                                                            <a href="#" class="stretched-link"  data-toggle="tooltip" title="<?= $search->name ?>">
                                                                <h6 class="fs-sm text-muted text-truncate mb-0"

                                                                ><?php
                                                                    $name = substr(htmlspecialchars($search->name) , 0, 14);
                                                                    $name .='...';
                                                                    echo $name;
                                                                    ?> </h6>
                                                            </a>
                                                            <!--<p class="text-danger fs-xs mb-0">Buy</p>-->
                                                        </div>
                                                        <div class="text-end flex-shrink-0">
                                                            <h6 class="text-muted text-truncate fs-sm mb-0"><?= number_format($search->result, 0, ',', ' ');;
                                                                ?> </h6>
                                                            <p class="text-muted fs-xs mb-0"><?php
                                                                //moment.locale('fr');

                                                                $date = new DateTime($search->date);

                                                                $formattedDate = $date->format('d F Y');
                                                                echo $formattedDate;
                                                                ?></p>
                                                        </div>
                                                    </li>
                                                <?php } ?>
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



<!-- App js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script src="assets/js/pages/form-advanced.init.js"></script>
<script src="assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js"></script>
<script src="assets/libs/multi.js/multi.min.js"></script>



<script >

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        // $(document).tooltip();
        $(".cpm").hide();
        $(".remise").html("Remise : 0%");
    });
    // Fonction pour récupérer les régions en fonction des pays sélectionnés


    document.addEventListener('DOMContentLoaded', function() {
            const paysInputs = document.querySelectorAll('.pays-input');
            const regionsSelect = document.getElementById('regionsSelect');

            function updateURL(selectedPays) {
                const currentUrl = new URL(window.location.href);
                if (selectedPays.length > 0) {
                    currentUrl.searchParams.set('selectedPays', selectedPays.join(','));
                } else {
                    currentUrl.searchParams.delete('selectedPays');
                }
                window.history.pushState({}, '', currentUrl);
                handleURLChange(); // Call this to immediately update regions
            }

            function handleURLChange() {
                const currentUrl = new URL(window.location.href);
                const selectedPays = currentUrl.searchParams.get('selectedPays');
                if (selectedPays) {
                    const selectedPaysArray = selectedPays.split(',');
                    fetchRegions(selectedPaysArray);
                } else {
                    regionsSelect.innerHTML = ''; // Clear regions if no country is selected
                }
            }

            function fetchRegions(selectedPays) {
                // Remplacez cette partie avec votre requête pour récupérer les régions
                // Par exemple, une requête AJAX
                // Pour cette démo, nous allons simuler les résultats

                const regions = {
                    France: ['Île-de-France', 'Provence-Alpes-Côte d\'Azur'],
                    Allemagne: ['Bavière', 'Saxe']
                };

                regionsSelect.innerHTML = ''; // Clear current options

                selectedPays.forEach(pays => {
                    if (regions[pays]) {
                        regions[pays].forEach(region => {
                            const option = document.createElement('option');
                            option.value = region;
                            option.text = region;
                            regionsSelect.appendChild(option);
                        });
                    }
                });
            }

            paysInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const selectedPays = Array.from(document.querySelectorAll('.pays-checkbox:checked')).map(checkbox => checkbox.value)
                        .concat(Array.from(document.querySelectorAll('#paysSelect option:checked')).map(option => option.value))
                        .concat(document.getElementById('paysInput').value.trim() ? [document.getElementById('paysInput').value.trim()] : [])
                        .filter((value, index, self) => self.indexOf(value) === index); // Remove duplicates
                    updateURL(selectedPays);
                });
            });

            handleURLChange(); // Call initially to load regions based on URL

            window.addEventListener('popstate', handleURLChange);
        });








    
    
    var form_search_db = document.querySelector("#form_search_db");

    form_search_db.addEventListener('submit', function(e) {
        e.preventDefault();

        var search_name = document.getElementById('search_name').value;

        if(search_name.trim() === "") {
            var msg = "Merci de donner un nom à votre recherche.";
            Toastify({
                text: msg,
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                className: "info",
                style: {
                    background: "linear-gradient(to right, #FF5F6D, #FFC371)", // Dégradé de rouge à jaune
                }
            }).showToast();

            //alert(msg);
        } else {
            form_search_db.submit();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour mettre à jour le <select> avec Choices.js
    function updateSelect(selectId, response) {
        const selectElement = document.getElementById(selectId);
        selectElement.innerHTML = response;
        new Choices(selectElement, {
            removeItemButton: true,
            placeholderValue: 'Sélectionnez',
            allowHTML: true
        });
    }

    // Supprimer les événements change existants
    document.querySelectorAll('input[name="top_pays[]"]').forEach(function(checkbox) {
        checkbox.removeEventListener('change', function() {});
    });

    // Ajouter les événements change pour récupérer les régions, départements et villes
    let selectedCountries = [];

    document.querySelectorAll('input[name="top_pays[]"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const checked = checkbox.checked;
            const countryValue = checkbox.value;

            if (checked) {
                selectedCountries.push(countryValue);
            } else {
                selectedCountries = selectedCountries.filter(function(country) {
                    return country !== countryValue;
                });
            }

            // Requête AJAX pour les régions
            $.ajax({
                url: 'get_regions.php',
                type: 'POST',
                data: { top_pays: selectedCountries },
                success: function(response) {
                    updateSelect('select_multiselect_region', response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Erreur Ajax:", textStatus, errorThrown);
                }
            });

            // Requête AJAX pour les départements
            $.ajax({
                url: 'get_depart.php',
                type: 'POST',
                data: { top_pays: selectedCountries },
                success: function(response) {
                   // console.log("dep " + response);
                    updateSelect('select_multiselect_departement', response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Erreur Ajax:", textStatus, errorThrown);
                }
            });

            // Requête AJAX pour les villes
            $.ajax({
                url: 'get_villes.php',
                type: 'POST',
                data: { top_pays: selectedCountries },
                success: function(response) {
                    //console.log("villes " + response);
                    updateSelect('select_multiselect_ville', response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Erreur Ajax:", textStatus, errorThrown);
                }
            });
        });
    });
});


    

    var inclure_sexes = document.querySelector("#formradioRight5");
    var exclure_sexes = document.querySelector("#formradioRight5");
    //var replace = document.querySelector("#choices-single-groups");

    //replace.html("ssss");

    document.addEventListener("DOMContentLoaded", function() {
        // Sélectionner tous les éléments input et leur ajouter un événement change
        var inputs = document.querySelectorAll('input[type=file], textarea, input[type=date],input[type=checkbox], input[type=hidden], input[type=text], input[type=number], input[type=radio], select');

       
        
        inputs.forEach(function(input) {
            input.addEventListener("change", function() {
                // Code à exécuter lorsque la valeur d'un élément input change
                ajaxRequest()
            });
        });
    });




    //fonction permettant de bien formater les données a envoyer
    function processFormData() {
        const formData = $("#form_search_db").serializeArray();
        const newJsonObject = {};
        for (const item of formData) {
            if (item.name && item.value.trim() !== "") {
                if (item.name.endsWith('[]')) {
                    // Cas des champs de type "checkbox"
                    const fieldName = item.name.slice(0, -2); // Supprime les crochets "[]" du nom du champ
                    if (!newJsonObject[fieldName]) {
                        newJsonObject[fieldName] = [];
                    }
                    newJsonObject[fieldName].push(item.value);
                } else {
                    // Cas des autres champs
                    newJsonObject[item.name] = item.value;
                }
            }
        }
        /*for (const item of formData) {
            if (item.name && item.value.trim() !== "") {
            newJsonObject[item.name] = item.value;
            }
        }*/
        return newJsonObject;
    }

    function ajaxRequest() {

        const CPM_EMAIL_PRICE = 15;
        const CPM_MOBILE_PRICE = 20;
        const CPM_ADRESSE_PRICE = 22;
        var pourcentage_ajout = 0.05;

        const CPM_DEFAULT = 1000;
        const message = "Soit un CPM de ";
        //console.log(data);
        //  url: "http://207.180.204.157/api/count.php",


        $.ajax({
            url: "https://api23.mgd-crm.com/count.php",
            type: "post",
            data:JSON.stringify(processFormData()),
            complete: function(xhr, result) {

               // console.log(JSON.stringify(processFormData()));
               // console.log(xhr.responseText);
                var print = JSON.parse(xhr.responseText);
                //console.log(print)
                var comptage_finale = print.total;
               // console.log(print.total);

                // Initialisation du coût total des CPM
                var cout_total = 0;
                var cpm_total = 0;

                // Additionner les prix CPM en fonction des cases cochées
                if ($("#inlineswitch").is(":checked")) {
                    cout_total += CPM_EMAIL_PRICE * (comptage_finale / CPM_DEFAULT);
                    cpm_total += CPM_EMAIL_PRICE;
                }
                if ($("#inlineswitch1").is(":checked")) {
                    cout_total += CPM_MOBILE_PRICE * (comptage_finale / CPM_DEFAULT);
                    cpm_total += CPM_MOBILE_PRICE;
                }
                if ($("#inlineswitchdisabled").is(":checked")) {
                    cout_total += CPM_ADRESSE_PRICE * (comptage_finale / CPM_DEFAULT);
                    cpm_total += CPM_ADRESSE_PRICE;
                }


                var remise = pourcentage_ajout * 100; // Convertir la remise en pourcentage
                var cout_avec_remise = cout_total * (1 - pourcentage_ajout) * (1 + pourcentage_ajout);

                // Mise à jour des éléments HTML
                $(".odometer").html(comptage_finale);
              //  $(".data").html(cout_total.toFixed(2) + "€ HT");
                $(".total_prices").html(cout_avec_remise.toFixed(2) + "€ HT");


                if (pourcentage_ajout > 0) {
                    $(".data").html(cout_total.toFixed(2) + "€ HT");
                    //  $(".data").addClass("strikethrough");
                    $(".remise").html("Remise : " + remise + "%").fadeIn();
                } else {
                    $(".data").html(cout_total.toFixed(2) + "€ HT");
                    // $(".data").removeClass("strikethrough");
                    $(".remise").html("Remise : 0%");
                }

                $(".cpm").html(message + cpm_total + "€ HT").fadeIn();
            }

        });
    }
    // upload des fichiers de villes
    var villes_input = document.querySelector("#villes_input")
     villes_input.addEventListener("change", function(){
        // FormData permet d'envoyer des fichiers avec AJAX
        const formData12 = new FormData();

        // Récupérer le fichier sélectionné
        const file = $(this)[0].files[0];

        // Ajouter le fichier au FormData
        formData12.append('villes_input', file);
        $.ajax ({
            url: "villes_btob_csv.php",
            type: "post",
            data: formData12,
            contentType: false,
            processData: false,
            success: function(response) {
                // Parse the JSON response
                try {
                    const villes = JSON.parse(response);
                    const input = $('<input type="hidden" name="villes_input" value="' + villes + '">');
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
    
    //upload des fichiers forme juridique
    var input_form_juridique = document.querySelector("#input_form_juridique");
        input_form_juridique.addEventListener("change", function(){
        // FormData permet d'envoyer des fichiers avec AJAX
        const formData11 = new FormData();

        // Récupérer le fichier sélectionné
        const file = $(this)[0].files[0];

        // Ajouter le fichier au FormData
        formData11.append('input_form_juridique', file);
        $.ajax ({
            url: "form_juridique_csv.php",
            type: "post",
            data: formData11,
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


    //upload des fichiers depatements
    var input_dep2 = document.querySelector("#input_dep");
        input_dep2.addEventListener("change", function(){
        // FormData permet d'envoyer des fichiers avec AJAX
        const formData10 = new FormData();

        // Récupérer le fichier sélectionné
        const file = $(this)[0].files[0];

        // Ajouter le fichier au FormData
        formData10.append('input_dep', file);
        $.ajax ({
            url: "depbtob_csv.php",
            type: "post",
            data: formData10,
            contentType: false,
            processData: false,
            success: function(response) {
                // Parse the JSON response
                try {
                    const dep = JSON.parse(response);
                    const input = $('<input type="hidden" name="input_dep" value="' + dep + '">');
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


    //upload des fichiers de regions
    var input_regions = document.querySelector("#input_regions");
        input_regions.addEventListener("change", function(){
        // FormData permet d'envoyer des fichiers avec AJAX
        const formData9 = new FormData();

        // Récupérer le fichier sélectionné
        const file = $(this)[0].files[0];

        // Ajouter le fichier au FormData
        formData9.append('input_regions', file);
        $.ajax ({
            url: "region_btob_csv.php",
            type: "post",
            data: formData9,
            contentType: false,
            processData: false,
            success: function(response) {
                // Parse the JSON response
                try {
                    const region = JSON.parse(response);
                    const input = $('<input type="hidden" name="input_regions" value="' + region + '">');
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
    
    //upload des fichiers conventions collectives
    var input_conv_collec = document.querySelector("#input_conv_collec");
        input_conv_collec.addEventListener("change", function(){
        // FormData permet d'envoyer des fichiers avec AJAX
        const formData8 = new FormData();

        // Récupérer le fichier sélectionné
        const file = $(this)[0].files[0];

        // Ajouter le fichier au FormData
        formData8.append('input_conv_collec', file);
        $.ajax ({
            url: "conventions_collective_csv.php",
            type: "post",
            data: formData8,
            contentType: false,
            processData: false,
            success: function(response) {
                // Parse the JSON response
                try {
                    const conv_collective = JSON.parse(response);
                    const input = $('<input type="hidden" name="input_conv_collec" value="' + conv_collective + '">');
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
    

    //upload des fichiers des fonctions
    var input_fonctions = document.querySelector("#inputfile_fonctions");
        input_fonctions.addEventListener("change", function(){
        // FormData permet d'envoyer des fichiers avec AJAX
        const formData7 = new FormData();

        // Récupérer le fichier sélectionné
        const file = $(this)[0].files[0];

        // Ajouter le fichier au FormData
        formData7.append('inputfile_fonctions', file);
        $.ajax ({
            url: "fonctions_csv.php",
            type: "post",
            data: formData7,
            contentType: false,
            processData: false,
            success: function(response) {
                // Parse the JSON response
                try {
                    const fonctions = JSON.parse(response);
                    const input = $('<input type="hidden" name="inputfile_fonctions" value="' + fonctions + '">');
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
    
    //upload des fichiers de naf
    var input_naf = document.querySelector("#input_naf");
        input_naf.addEventListener("change", function(){
        // FormData permet d'envoyer des fichiers avec AJAX
        const formData6 = new FormData();

        // Récupérer le fichier sélectionné
        const file = $(this)[0].files[0];

        // Ajouter le fichier au FormData
        formData6.append('input_naf', file);
        $.ajax ({
            url: "naf_csv.php",
            type: "post",
            data: formData6,
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


    //upload des fichiers de departements

    

    //upload des fichiers codes postales
    var inputfile = document.querySelector("#inputfile_cp");
        inputfile.addEventListener("change", function(e){
        e.preventDefault();
        // FormData permet d'envoyer des fichiers avec AJAX
        const formData = new FormData();

        // Récupérer le fichier sélectionné
        const file = $(this)[0].files[0];

        // Ajouter le fichier au FormData
        formData.append('inputfile_cp', file);
        $.ajax ({
            url: "cp_csv.php",
            type: "post",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Parse the JSON response
                try {
                    const cp = JSON.parse(response);
                    const input = $('<input type="hidden" name="inputfile_cp" value="' + cp + '">');
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
    
    
    // les donnés de mon fichier csv pays importés 
    var input_pays = document.querySelector("#input_pays");
    input_pays.addEventListener("change", function(e){
        e.preventDefault();
        // FormData permet d'envoyer des fichiers avec AJAX
        const formData2 = new FormData();

        // Récupérer le fichier sélectionné
        const file = $(this)[0].files[0];
       // console.log(file);
        // Ajouter le fichier au FormData
        formData2.append('input_pays', file);
        $.ajax ({
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

    // upload des fichiers de departement
    /*var input_dep = document.querySelector("#input_dep")
    input_dep.addEventListener("change", function(){
        // FormData permet d'envoyer des fichiers avec AJAX
        const formData4 = new FormData();

        // Récupérer le fichier sélectionné
        const file = $(this)[0].files[0];

        // Ajouter le fichier au FormData
        formData4.append('input_dep', file);
        $.ajax ({
            url: "dep_csv.php",
            type: "post",
            data: formData4,
            contentType: false,
            processData: false,
            success: function(response) {
                // Parse the JSON response
                try {
                    const dep = JSON.parse(response);
                    const input = $('<input type="hidden" name="input_dep" value="' + dep + '">');
                    $("#form_search_db").append(input);
                    //console.log(lignes)
                    /!*for (const ligne of lignes) {
                    console.log(ligne[0])	
                    
                    // Un input de type hidden pour chaque
                    const input = $('<input type="hidden" name="lignes" value="' + lignes + '">');
                    $("#form_search_db").append(input);
                    }*!/

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
    });*/

    // upload des fichiers de region
    var input_region = document.querySelector("#input_region")
    input_region.addEventListener("change", function(e){
        e.preventDefault()
        // FormData permet d'envoyer des fichiers avec AJAX
        const formData5 = new FormData();

        // Récupérer le fichier sélectionné
        const file = $(this)[0].files[0];

        // Ajouter le fichier au FormData
        formData5.append('input_region', file);
        $.ajax ({
            url: "region_csv.php",
            type: "post",
            data: formData5,
            contentType: false,
            processData: false,
            success: function(response) {
                // Parse the JSON response
                try {
                    const region = JSON.parse(response);
                    const input = $('<input type="hidden" name="input_region" value="' + region + '">');
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



</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.7/odometer.min.js" integrity="sha512-v3fZyWIk7kh9yGNQZf1SnSjIxjAKsYbg6UQ+B+QxAZqJQLrN3jMjrdNwcxV6tis6S0s1xyVDZrDz9UoRLfRpWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="assets/libs/nouislider/nouislider.min.js"></script>
<script src="assets/libs/wnumb/wNumb.min.js"></script>

<script src="assets/js/pages/range-sliders.init.js"></script>
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- dropzone js -->
<script src="assets/libs/dropzone/dropzone-min.js"></script>
<script src="assets/libs/list.js/list.min.js"></script>

<script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>

<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="assets/js/pages/file-manager.init.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment-with-locales.min.js" integrity="sha512-vFABRuf5oGUaztndx4KoAEUVQnOvAIFs59y4tO0DILGWhQiFnFHiR+ZJfxLDyJlXgeut9Z07Svuvm+1Jv89w5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="assets/js/app.js"></script>
</body>

</html>
