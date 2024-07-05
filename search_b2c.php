
<?php //include 'partials/session.php'; ?>
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
        
    <link rel="stylesheet" type="text/css" href="assets/libs/multi.js/multi.min.css" >
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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Recherche', 'title' => 'Recherches')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                            <?php include 'partials/customizer.php'; ?>
                            </div><!--end col-->
                        </div><!--end row-->
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
                                                <button id="data4">btn </button>
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
                                                <h4 class="card-title mb-1">Type de location</h4> </div>
                                        </div><!-- end card header -->
                                        <div class="card-body tab-content">
                                            <div class="tab-pane show active" id="outlinedStylesPreview" role="tabpanel" aria-labelledby="outlinedStylesPreview-tab" tabindex="0">
                                                <div class="hstack gap-2 flex-wrap">
                                                    <div class="form-check form-switch form-check-inline" dir="ltr">
                                                        <input type="checkbox" name="location[]" value="email" class="form-check-input" id="inlineswitch">
                                                        <label class="form-check-label" for="inlineswitch">@ E-mail</label>
                                                    </div>
                                                    <div class="form-check form-switch form-check-inline" dir="ltr">
                                                        <input type="checkbox" name="location[]"value="tel_mobile" class="form-check-input" id="inlineswitch1">
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

                                                    while( $partenaire = $result->fetch() ) {
                                                        echo '<option value="'.$partenaire->id.'">'.$partenaire->nom.'</option>';
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
                                                <h4 class="card-title mb-1">Programmes</h4> </div>
                                        </div><!-- end card header -->
                                        <div class="card-body tab-content">
                                            <div class="tab-pane show active" id="outlinedStylesPreview" role="tabpanel" aria-labelledby="outlinedStylesPreview-tab" tabindex="0">
                                            <select class="form-select mb-3" aria-label="Default select example" name="programme" id="programme">
                                                <option selected>Sélectionnez un programme</option>
                                                <?php
                                                    $requete = "SELECT id, nom FROM gestion_programme ORDER BY nom ASC";
                                                    $result = $bdd->executeQueryRequete($requete, 1);

                                                    while( $programme = $result->fetch() ) {
                                                        echo '<option value="'.$programme->id.'">'.$programme->nom.'</option>';
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
                                                                                <p class="text-muted mb-1">Les 12 top pays </p>
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
                                                                                <p class="text-muted mb-1">Sélectionner une ou plusieurs pays </p>
                                                                                    <select class="form-control" id="choices-single-groups" name="pays[]" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                                        <option value="">Sélectionnez</option>
                                                                                        <?php
                                                                                            $requete = "SELECT pays, extension FROM search_pays ORDER BY pays ASC";
                                                                                            $result = $bdd->executeQueryRequete($requete, 1);

                                                                                            while( $pays = $result->fetch() ) {
                                                                                                echo '<option value="'.$pays->extension.'">'.$pays->pays.'</option>';
                                                                                            }
                                                                                        ?>
                                                                                    </select>
                                                                            </div>
                                                                        <div class="mt-0" style="margin-bottom: 10px;">
                                                                            <p class="text-muted mb-1">Rechercher une ou plusieurs pays</p>
                                                                            <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1" >
                                                                        </div>
                                                                        <div class="" style="margin-bottom: 10px;">
                                                                            <p class="text-muted mb-1">Copier-coller :</p>
                                                                                <div class="form-group">
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text text-muted">
                                                                                            <i class="bi bi-clipboard"></i>
                                                                                        </span>
                                                                                        <textarea class="form-control" rows="2" placeholder="Copier-coller des pays..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                        <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                            <i class="bi bi-check2"></i> Valider
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                        </div>

                                                                        <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                                        <div class="input-group mb-1">
                                                                            <input type="file" class="form-control" name="input_pays" id="input_pays" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                        </div>

                                                                        <div class="row">
                                                                        <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
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
                                                            </div><!--end col-->
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="arrow-region" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                        <div class="tab-pane" id="customFormsPreview" role="tabpanel" aria-labelledby="customFormsPreview-tab" tabindex="0">
                                                                            <div class="row g-3">
                                                                                <div class="col-lg-6">
                                                                                        <div class="mt-1 mt-lg-0">
                                                                                        <p class="text-muted mb-1">Rechercher une ou plusieurs régions </p>
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
                                                                                        <label class="btn btn-outline-secondary" for="btn-check-2-outlined">Tout cocher</label>

                                                                                        <input type="radio" class="btn-check" name="options-outlined" id="success-outlined" checked>
                                                                                        <label class="btn btn-outline-success" for="success-outlined">Tout décocher</label>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="mt-1 mb-0 mt-lg-0">
                                                                                        <div style="margin-bottom: 10px;">
                                                                                            <p class="text-muted mb-1">Sélectionner une ou des régions </p>
                                                                                                <select class="form-control" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                                                    <option value="">Sélectionnez</option>
                                                                                                        <optgroup label="UK">
                                                                                                                <option value="London">London</option>
                                                                                                                <option value="Manchester">Manchester</option>
                                                                                                                <option value="Liverpool">Liverpool</option>
                                                                                                            </optgroup>
                                                                                                            <optgroup label="FR">
                                                                                                                <option value="Paris">Paris</option>
                                                                                                                <option value="Lyon">Lyon</option>
                                                                                                                <option value="Marseille">Marseille</option>
                                                                                                            </optgroup>
                                                                                                            <optgroup label="DE" disabled>
                                                                                                                <option value="Hamburg">Hamburg</option>
                                                                                                                <option value="Munich">Munich</option>
                                                                                                                <option value="Berlin">Berlin</option>
                                                                                                            </optgroup>
                                                                                                            <optgroup label="US">
                                                                                                                <option value="New York">New York</option>
                                                                                                                <option value="Washington" disabled>Washington</option>
                                                                                                                <option value="Michigan">Michigan</option>
                                                                                                            </optgroup>
                                                                                                            <optgroup label="SP">
                                                                                                                <option value="Madrid">Madrid</option>
                                                                                                                <option value="Barcelona">Barcelona</option>
                                                                                                                <option value="Malaga">Malaga</option>
                                                                                                            </optgroup>
                                                                                                            <optgroup label="CA">
                                                                                                                <option value="Montreal">Montreal</option>
                                                                                                                <option value="Toronto">Toronto</option>
                                                                                                                <option value="Vancouver">Vancouver</option>
                                                                                                            </optgroup>
                                                                                                </select>
                                                                                        </div>
                                                                                    <div class="mt-0" style="margin-bottom: 10px;">
                                                                                        <p class="text-muted mb-1">Définir les valeurs limites avec le bouton Supprimer</p>
                                                                                        <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1" >
                                                                                    </div>
                                                                                    <div class="" style="margin-bottom: 10px;">
                                                                                        <p class="text-muted mb-1">Copier-coller :</p>
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-text text-muted">
                                                                                                    <i class="bi bi-clipboard"></i>
                                                                                                </span>
                                                                                                <textarea class="form-control" rows="2" placeholder="Copier-coller des régions..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                                <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                                    <i class="bi bi-check2"></i> Valider
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                                                    <div class="input-group mb-1">
                                                                                        <input type="file" class="form-control" id="inputGroupFile02">
                                                                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                    <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
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
                                                            </div><!--end col-->
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="arrow-departement" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                        <div class="tab-pane" id="customFormsPreview" role="tabpanel" aria-labelledby="customFormsPreview-tab" tabindex="0">
                                                                            <div class="row g-3">
                                                                                <div class="col-lg-6">
                                                                                        <div class="mt-1 mt-lg-0">
                                                                                        <p class="text-muted mb-1">Rechercher un ou plusieurs département </p>
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
                                                                                        <label class="btn btn-outline-secondary" for="btn-check-2-outlined">Tout cocher</label>

                                                                                        <input type="radio" class="btn-check" name="options-departement" id="success-outlined" checked>
                                                                                        <label class="btn btn-outline-success" for="success-outlined">Tout décocher</label>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="mt-1 mb-0 mt-lg-0">
                                                                                        <div style="margin-bottom: 10px;">
                                                                                            <p class="text-muted mb-1">Sélectionner un ou plusieurs départements </p>
                                                                                                <select class="form-control" id="choices-single-groups" name="geoloc[]" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                                                    <option value="">Sélectionner des départements</option>
                                                                                                    <option value="01">01 Ain</option>
                                                                                                    <option value="02">02 Aisne</option>
                                                                                                    <option value="03">03 Allier</option>
                                                                                                    <option value="04">04 Alpes-de-Haute-Provence</option>
                                                                                                    <option value="05">05 Hautes-Alpes</option>
                                                                                                    <option value="06">06 Alpes-Maritimes</option>
                                                                                                    <option value="07">07 Ardèche</option>
                                                                                                    <option value="08">08 Ardennes</option>
                                                                                                    <option value="09">09 Ariège</option>
                                                                                                    <option value="10">10 Aube</option>
                                                                                                    <option value="11">11 Aude</option>
                                                                                                    <option value="12">12 Aveyron</option>
                                                                                                    <option value="13">13 Bouches-du-Rhône</option>
                                                                                                    <option value="14">14 Calvados</option>
                                                                                                    <option value="15">15 Cantal</option>
                                                                                                    <option value="16">16 Charente</option>
                                                                                                    <option value="17">17 Charente-Maritime</option>
                                                                                                    <option value="18">18 Cher</option>
                                                                                                    <option value="19">19 Corrèze</option>
                                                                                                    <option value="2A">2A Corse-du-Sud</option>
                                                                                                    <option value="2B">2B Haute-Corse</option>
                                                                                                    <option value="21">21 Côte-d'Or</option>
                                                                                                    <option value="22">22 Côtes-d'Armor</option>
                                                                                                    <option value="23">23 Creuse</option>
                                                                                                    <option value="24">24 Dordogne</option>
                                                                                                    <option value="25">25 Doubs</option>
                                                                                                    <option value="26">26 Drôme</option>
                                                                                                    <option value="27">27 Eure</option>
                                                                                                    <option value="28">28 Eure-et-Loir</option>
                                                                                                    <option value="29">29 Finistère</option>
                                                                                                    <option value="30">30 Gard</option>
                                                                                                    <option value="31">31 Haute-Garonne</option>
                                                                                                    <option value="32">32 Gers</option>
                                                                                                    <option value="33">33 Gironde</option>
                                                                                                    <option value="34">34 Hérault</option>
                                                                                                    <option value="35">35 Ille-et-Vilaine</option>
                                                                                                    <option value="36">36 Indre</option>
                                                                                                    <option value="37">37 Indre-et-Loire</option>
                                                                                                    <option value="38">38 Isère</option>
                                                                                                    <option value="39">39 Jura</option>
                                                                                                    <option value="40">40 Landes</option>
                                                                                                    <option value="41">41 Loir-et-Cher</option>
                                                                                                    <option value="42">42 Loire</option>
                                                                                                    <option value="43">43 Haute-Loire</option>
                                                                                                    <option value="44">44 Loire-Atlantique</option>
                                                                                                    <option value="45">45 Loiret</option>
                                                                                                    <option value="46">46 Lot</option>
                                                                                                    <option value="47">47 Lot-et-Garonne</option>
                                                                                                    <option value="48">48 Lozère</option>
                                                                                                    <option value="49">49 Maine-et-Loire</option>
                                                                                                    <option value="50">50 Manche</option>
                                                                                                    <option value="51">51 Marne</option>
                                                                                                    <option value="52">52 Haute-Marne</option>
                                                                                                    <option value="53">53 Mayenne</option>
                                                                                                    <option value="54">54 Meurthe-et-Moselle</option>
                                                                                                    <option value="55">55 Meuse</option>
                                                                                                    <option value="56">56 Morbihan</option>
                                                                                                    <option value="57">57 Moselle</option>
                                                                                                    <option value="58">58 Nièvre</option>
                                                                                                    <option value="59">59 Nord</option>
                                                                                                    <option value="60">60 Oise</option>
                                                                                                    <option value="61">61 Orne</option>
                                                                                                    <option value="62">62 Pas-de-Calais</option>
                                                                                                    <option value="63">63 Puy-de-Dôme</option>
                                                                                                    <option value="64">64 Pyrénées-Atlantiques</option>
                                                                                                    <option value="65">65 Hautes-Pyrénées</option>
                                                                                                    <option value="66">66 Pyrénées-Orientales</option>
                                                                                                    <option value="67">67 Bas-Rhin</option>
                                                                                                    <option value="68">68 Haut-Rhin</option>
                                                                                                    <option value="69">69 Rhône</option>
                                                                                                    <option value="70">70 Haute-Saône</option>
                                                                                                    <option value="71">71 Saône-et-Loire</option>
                                                                                                    <option value="72">72 Sarthe</option>
                                                                                                    <option value="73">73 Savoie</option>
                                                                                                    <option value="74">74 Haute-Savoie</option>
                                                                                                    <option value="75">75 Paris</option>
                                                                                                    <option value="76">76 Seine-Maritime</option>
                                                                                                    <option value="77">77 Seine-et-Marne</option>
                                                                                                    <option value="78">78 Yvelines</option>
                                                                                                    <option value="79">79 Deux-Sèvres</option>
                                                                                                    <option value="80">80 Somme</option>
                                                                                                    <option value="81">81 Tarn</option>
                                                                                                    <option value="82">82 Tarn-et-Garonne</option>
                                                                                                    <option value="83">83 Var</option>
                                                                                                    <option value="84">84 Vaucluse</option>
                                                                                                    <option value="85">85 Vendée</option>
                                                                                                    <option value="86">86 Vienne</option>
                                                                                                    <option value="87">87 Haute-Vienne</option>
                                                                                                    <option value="88">88 Vosges</option>
                                                                                                    <option value="89">89 Yonne</option>
                                                                                                    <option value="90">90 Territoire de Belfort</option>
                                                                                                    <option value="91">91 Essonne</option>
                                                                                                    <option value="92">92 Hauts-de-Seine</option>
                                                                                                    <option value="93">93 Seine-Saint-Denis</option>
                                                                                                    <option value="94">94 Val-de-Marne</option>
                                                                                                    <option value="95">95 Val-d'Oise</option>
                                                                                                </select>
                                                                                        </div>
                                                                                    <div class="mt-0" style="margin-bottom: 10px;">
                                                                                        <p class="text-muted mb-1">Sélectionnez</p>
                                                                                        <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1" >
                                                                                    </div>
                                                                                    <div class="" style="margin-bottom: 10px;">
                                                                                        <p class="text-muted mb-1">Copier-coller :</p>
                                                                                        <div class="form-group">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-text text-muted">
                                                                                                    <i class="bi bi-clipboard"></i>
                                                                                                </span>
                                                                                                <textarea class="form-control" rows="2" placeholder="Copier-coller des departements..." id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                                                <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                                                    <i class="bi bi-check2"></i> Valider
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                                                    <div class="input-group mb-1">
                                                                                        <input type="file" class="form-control" id="inputGroupFile02">
                                                                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                    <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                                                        <div class="col-6">
                                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                                <input class="form-check-input" type="radio" name="datadepartement" id="formradioRight5" checked>
                                                                                                <label class="form-check-label" for="formradioRight5">
                                                                                                    Inclure ces  départements
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-6">
                                                                                            <div class="form-check form-radio-primary mb-3">
                                                                                                <input class="form-check-input" type="radio" name="datadepartement" id="formradioRight5">
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
                                                            </div><!--end col-->
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
                                                                        <p class="text-muted mb-1">Sélectionner une ou plusieurs villes </p>
                                                                            <select class="form-control" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                                <option value="">Sélectionnez</option>
                                                                                    <optgroup label="UK">
                                                                                            <option value="London">London</option>
                                                                                            <option value="Manchester">Manchester</option>
                                                                                            <option value="Liverpool">Liverpool</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="FR">
                                                                                            <option value="Paris">Paris</option>
                                                                                            <option value="Lyon">Lyon</option>
                                                                                            <option value="Marseille">Marseille</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="DE" disabled>
                                                                                            <option value="Hamburg">Hamburg</option>
                                                                                            <option value="Munich">Munich</option>
                                                                                            <option value="Berlin">Berlin</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="US">
                                                                                            <option value="New York">New York</option>
                                                                                            <option value="Washington" disabled>Washington</option>
                                                                                            <option value="Michigan">Michigan</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="SP">
                                                                                            <option value="Madrid">Madrid</option>
                                                                                            <option value="Barcelona">Barcelona</option>
                                                                                            <option value="Malaga">Malaga</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="CA">
                                                                                            <option value="Montreal">Montreal</option>
                                                                                            <option value="Toronto">Toronto</option>
                                                                                            <option value="Vancouver">Vancouver</option>
                                                                                        </optgroup>
                                                                            </select>
                                                                    </div>
                                                                <div class="mt-0" style="margin-bottom: 10px;">
                                                                    <p class="text-muted mb-1">Rechercher une ou plusieurs villes</p>
                                                                    <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1" >
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

                                                                <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                                <div class="input-group mb-1">
                                                                    <input type="file" class="form-control" name="input_villes" id="input_villes" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                </div>

                                                                <div class="row">
                                                                <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                                    <div class="col-6">
                                                                        <div class="form-check form-radio-primary mb-3">
                                                                            <input class="form-check-input" type="radio" name="formradiocolor1" id="inclu_ville" name="ville_inclure" value="true" checked >
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
                                                                    <p class="text-muted mb-1">Rechercher un ou plusieurs codes postaux</p>
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
                                                                        <p class="text-muted mb-1">Sélectionner un ou plusieurs codes postaux</p>
                                                                            <select class="form-control" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                                <option value="">Sélectionnez</option>
                                                                                    <optgroup label="UK">
                                                                                            <option value="London">London</option>
                                                                                            <option value="Manchester">Manchester</option>
                                                                                            <option value="Liverpool">Liverpool</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="FR">
                                                                                            <option value="Paris">Paris</option>
                                                                                            <option value="Lyon">Lyon</option>
                                                                                            <option value="Marseille">Marseille</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="DE" disabled>
                                                                                            <option value="Hamburg">Hamburg</option>
                                                                                            <option value="Munich">Munich</option>
                                                                                            <option value="Berlin">Berlin</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="US">
                                                                                            <option value="New York">New York</option>
                                                                                            <option value="Washington" disabled>Washington</option>
                                                                                            <option value="Michigan">Michigan</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="SP">
                                                                                            <option value="Madrid">Madrid</option>
                                                                                            <option value="Barcelona">Barcelona</option>
                                                                                            <option value="Malaga">Malaga</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="CA">
                                                                                            <option value="Montreal">Montreal</option>
                                                                                            <option value="Toronto">Toronto</option>
                                                                                            <option value="Vancouver">Vancouver</option>
                                                                                        </optgroup>
                                                                            </select>
                                                                    </div>
                                                                <div class="mt-0" style="margin-bottom: 10px;">
                                                                    <p class="text-muted mb-1">Définir les valeurs limites avec le bouton Supprimer</p>
                                                                    <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1" >
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

                                                                <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                                <div class="input-group mb-1">
                                                                    <input type="file" class="form-control" name="inputfile" id="inputfile" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                </div>

                                                                <div class="row">
                                                                <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
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
                                                                    <p class="text-muted mb-1">Rechercher un ou plusieurs codes INSEE </p>
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
                                                                        <p class="text-muted mb-1">Sélectionner un ou plusieurs codes INSEE </p>
                                                                            <select class="form-control" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                                <option value="">Sélectionnez</option>
                                                                                    <optgroup label="UK">
                                                                                            <option value="London">London</option>
                                                                                            <option value="Manchester">Manchester</option>
                                                                                            <option value="Liverpool">Liverpool</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="FR">
                                                                                            <option value="Paris">Paris</option>
                                                                                            <option value="Lyon">Lyon</option>
                                                                                            <option value="Marseille">Marseille</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="DE" disabled>
                                                                                            <option value="Hamburg">Hamburg</option>
                                                                                            <option value="Munich">Munich</option>
                                                                                            <option value="Berlin">Berlin</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="US">
                                                                                            <option value="New York">New York</option>
                                                                                            <option value="Washington" disabled>Washington</option>
                                                                                            <option value="Michigan">Michigan</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="SP">
                                                                                            <option value="Madrid">Madrid</option>
                                                                                            <option value="Barcelona">Barcelona</option>
                                                                                            <option value="Malaga">Malaga</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="CA">
                                                                                            <option value="Montreal">Montreal</option>
                                                                                            <option value="Toronto">Toronto</option>
                                                                                            <option value="Vancouver">Vancouver</option>
                                                                                        </optgroup>
                                                                            </select>
                                                                    </div>
                                                                <div class="mt-0" style="margin-bottom: 10px;">
                                                                    <p class="text-muted mb-1">Définir les valeurs limites avec le bouton Supprimer</p>
                                                                    <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1" >
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

                                                                <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                                <div class="input-group mb-1">
                                                                    <input type="file" class="form-control" id="inputGroupFile02">
                                                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                </div>

                                                                <div class="row">
                                                                <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
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
                                                                    <p class="text-muted mb-1">Rechercher un ou plusieurs codes IRIS </p>
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
                                                                        <p class="text-muted mb-1">Sélectionner un ou plusieurs codes IRIS </p>
                                                                            <select class="form-control" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                                <option value="">Sélectionnez</option>
                                                                                    <optgroup label="UK">
                                                                                            <option value="London">London</option>
                                                                                            <option value="Manchester">Manchester</option>
                                                                                            <option value="Liverpool">Liverpool</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="FR">
                                                                                            <option value="Paris">Paris</option>
                                                                                            <option value="Lyon">Lyon</option>
                                                                                            <option value="Marseille">Marseille</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="DE" disabled>
                                                                                            <option value="Hamburg">Hamburg</option>
                                                                                            <option value="Munich">Munich</option>
                                                                                            <option value="Berlin">Berlin</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="US">
                                                                                            <option value="New York">New York</option>
                                                                                            <option value="Washington" disabled>Washington</option>
                                                                                            <option value="Michigan">Michigan</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="SP">
                                                                                            <option value="Madrid">Madrid</option>
                                                                                            <option value="Barcelona">Barcelona</option>
                                                                                            <option value="Malaga">Malaga</option>
                                                                                        </optgroup>
                                                                                        <optgroup label="CA">
                                                                                            <option value="Montreal">Montreal</option>
                                                                                            <option value="Toronto">Toronto</option>
                                                                                            <option value="Vancouver">Vancouver</option>
                                                                                        </optgroup>
                                                                            </select>
                                                                    </div>
                                                                <div class="mt-0" style="margin-bottom: 10px;">
                                                                    <p class="text-muted mb-1">Définir les valeurs limites avec le bouton Supprimer</p>
                                                                    <input class="form-control" id="choices-text-remove-button" data-choices data-choices-limit="3" data-choices-removeItem type="text" value="Task-1" >
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

                                                                <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                                <div class="input-group mb-1">
                                                                    <input type="file" class="form-control" id="inputGroupFile02">
                                                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                                </div>

                                                                <div class="row">
                                                                    <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
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
                                                                        <p class="text-muted mb-1">Vous pouvez copier-coller un ou plusieurs codes HEXAVIA</p>
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
                                                                <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
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
                                                                        <p class="text-muted mb-1">Vous pouvez copier-coller un ou plusieurs codes HEXACLE</p>
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
                                                                <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
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
                                                                    <input type="checkbox" class="form-check-input" name="genre" value="homme" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Hommes</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="genre" value="femme" id="customSwitchsizelg">
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
                                                                    <input class="form-check-input" type="radio" name="datasexe" id="formradioRight5" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Inclure ces sexes
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" name="datasexe" id="formradioRight5">
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
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">18 à 25 ans</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">26 à 35 ans</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">36 à 50 ans</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">51 à 65 ans</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
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
                                                                    <input type="number" class="product-quantity" placeholder="Saisir l'âge min" style="text-align: center;" min="18" max="100">
                                                                <button type="button" class="plus">+</button>
                                                            </div>
                                                        </div>
                                                        <div style="margin-bottom: 10px;">
                                                            <h5 class="fs-sm fw-medium text-muted mb-1">Âge maximum</h5>
                                                            <div class="input-step full-width">
                                                                <button type="button" class="minus">–</button>
                                                                    <input type="number" class="product-quantity" placeholder="Saisir l'âge max" style="text-align: center;" min="18" max="100">
                                                                <button type="button" class="plus">+</button>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" name="datatrancheage" id="formradioRight5" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Inclure ces tranches d'âges
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" name="datatrancheage" id="formradioRight5">
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                    Exclure ces tranches d'âges
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                    <div class="form-group "> 
                                                        <label class="col-12 col-form-label">Sélectionner une plage d'âge personnalisée :</label> 
                                                        <div class="col-12 pb-2">
                                                            <div class="slider" id="slider-pips"></div>
                                                            <div data-rangeslider></div>
                                                        </div>
                                                    </div>
                                                    <span class="form-text text-muted">Vous pouvez définir une plage d'âge personnalisée avec vos tranches</span>
                                                        <div class="kt-space-10"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="arrow-revenus" role="tabpanel">
                                                    <div class="row g-3">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <p class="text-muted mb-1">Liste des catégories socioprofessionnelles disponibles :</p>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="csp[]" value="1">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Moins de 3000 €</label>
                                                                        <code class="text-danger"><small>CSP+-</small></code>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="csp[]" value="2">
                                                                        <label class="form-check-label" for="customSwitchsizelg">De 5000 à 7000 €</label>
                                                                        <code class="text-danger"><small>CSP+-</small></code>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="csp[]" value="3">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Moins de 3000 €</label>
                                                                        <code class="text-danger"><small>CSP+</small></code>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="csp[]" value="4">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Plus de 7000 </label>
                                                                        <code class="text-danger"><small>CSP++</small></code>
                                                                    </div>
                                                                </div>
                                                                <small class="text-muted" style="margin-bottom: 10px;">Vous pouvez choisir une ou plusieurs catégories socioprofessionnelles</small>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <input type="radio" class="btn-check" name="cocherrevenue" id="success-outlined" checked>
                                                                            <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                            <input type="radio" class="btn-check" name="cocherrevenue" id="danger-outlined">
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
                                                                        <input class="form-check-input" type="radio" name="dataiesocioprofessionelle" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            Inclure ces catégories socioprofessionnelles
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-check form-radio-primary mb-3">
                                                                        <input class="form-check-input" type="radio" name="dataiesocioprofessionelle" id="formradioRight5">
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
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Propriétaire</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Locataire</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Appartement</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Maison</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Petit collectif</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Moyen collectif</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Grand collectif</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Très grand collectif</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Chauffage au bois</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Chauffage au fioul</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Chauffage au gaz</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Chauffage électrique</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Avec Jardin</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Projet de déménagement</label>
                                                                    </div>
                                                                </div>
                                                                    <small class="text-muted" style="margin-bottom: 10px;">Vous pouvez choisir un ou plusieurs critères habitats</small>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <input type="radio" class="btn-check" name="cocherhabitat" id="success-outlined" checked>
                                                                            <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                            <input type="radio" class="btn-check" name="cocherhabitat" id="danger-outlined">
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
                                                                        <input class="form-check-input" type="radio" name="dataophabitat" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            opérateur « OU » <small class="text-muted">(séparer les critères)</small>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check form-radio-primary mb-3">
                                                                        <input class="form-check-input" type="radio" name="dataophabitat" id="formradioRight5">
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
                                                                        <input class="form-check-input" type="radio" name="dataiehabitat" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            Inclure ces critères habitats
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-check form-radio-primary mb-0">
                                                                        <input class="form-check-input" type="radio" name="dataiehabitat" id="formradioRight5" checked>
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
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Attend un enfant</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Avec enfant(s)</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Concubin(e)</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Célibataire</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Divorcé(e)</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Famille</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Mariage prévu < 12 mois</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Marié(e)</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Sans enfant</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Séparé(e)</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Veuf(ve)</label>
                                                                    </div>
                                                                </div>
                                                                    <small class="text-muted" style="margin-bottom: 10px;">Vous pouvez choisir un ou plusieurs critères familiaux</small>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <input type="radio" class="btn-check" name="cochefamiliaux" id="success-outlined" checked>
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
                                                                        <input class="form-check-input" type="radio" name="dataopfamille" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            opérateur « OU » <small class="text-muted">(séparer les critères)</small>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check form-radio-primary mb-3">
                                                                        <input class="form-check-input" type="radio" name="dataopfamille" id="formradioRight5" checked>
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
                                                                        <input class="form-check-input" type="radio" name="dataiefamillie" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            Inclure ces critères familiaux
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-check form-radio-primary mb-0">
                                                                        <input class="form-check-input" type="radio" name="dataiefamillie" id="formradioRight5" checked>
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
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Achat et investissement immobilier</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Animaux</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Assurance et prévoyance</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Automobile</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Banque</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Beauté, esthétique, Bien-être</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg"> Charme et érotisme</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Cuisine et Gastronomie</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg"> Divers</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg" >Equipement et décoration de l’habitat</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Films, séries et cinéma</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg"> Loisirs et Sorties</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Mode et Accessoires</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Nature et écologie</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg"> Paris et Jeux d'argent</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg"> Santé</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Shopping / Achats</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Sport</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg"> Vacances et voyages</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg"> Voyance et ésotérisme</label>
                                                                    </div>
                                                                </div>
                                                                <small class="text-muted" style="margin-bottom: 10px;">Vous pouvez choisir un ou plusieurs centres d'intérêt</small>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <input type="radio" class="btn-check" name="cochecentreinteret" id="success-outlined" checked>
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
                                                                        <input class="form-check-input" type="radio" name="dataopcentrefamille" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            opérateur « OU » <small class="text-muted">(séparer les critères)</small>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check form-radio-primary mb-3">
                                                                        <input class="form-check-input" type="radio" name="dataopcentrefamille" id="formradioRight5" checked>
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
                                                                        <input class="form-check-input" type="radio" name="datacentreinteret" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            opérateur « OU » <small class="text-muted">(séparer les critères)</small>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check form-radio-primary mb-3">
                                                                        <input class="form-check-input" type="radio" name="datacentreinteret" id="formradioRight5" checked>
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
                                                                        <input class="form-check-input" type="radio" name="dataiecentrefamille" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            Inclure ces familles de centres d'intérêt
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-check form-radio-primary mb-0">
                                                                        <input class="form-check-input" type="radio" name="dataiecentrefamille" id="formradioRight5" checked>
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
                                                                        <input class="form-check-input" type="radio" name="dataiecentreinteret" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            Inclure ces centres d'intérêt
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-check form-radio-primary mb-0">
                                                                        <input class="form-check-input" type="radio" name="dataiecentreinteret" id="formradioRight5" checked>
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
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Dirigeant(e)</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Enseignant</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Fonctionnaire</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Formation</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Retraité(e)</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Salarié(e)</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Sans emploi</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Marié(e)</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Étudiant(e)</label>
                                                                    </div>
                                                                </div>
                                                                <small class="text-muted" style="margin-bottom: 10px;">Vous pouvez choisir un ou plusieurs professions</small>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <input type="radio" class="btn-check" name="cocherprofession" id="success-outlined" checked>
                                                                        <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                        <input type="radio" class="btn-check" name="cocherprofession" id="danger-outlined" checked>
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
                                                                        <input class="form-check-input" type="radio" name="dataopprofession" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            opérateur « OU » <small class="text-muted">(séparer les critères)</small>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check form-radio-primary mb-3">
                                                                        <input class="form-check-input" type="radio" name="dataopprofession" id="formradioRight5" checked>
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
                                                                        <input class="form-check-input" type="radio" name="dataieprofession" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            Inclure ces critères professions
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-check form-radio-primary mb-0">
                                                                        <input class="form-check-input" type="radio" name="dataieprofession" id="formradioRight5" checked>
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
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Imposition < 6000 €</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Imposition > 6000 €</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                        <label class="form-check-label" for="customSwitchsizelg">Impôt sur la fortune immobilière</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg">
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
                                                                        <input class="form-check-input" type="radio" name="dataopimposition" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            opérateur « OU » <small class="text-muted">(séparer les critères)</small>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check form-radio-primary mb-3">
                                                                        <input class="form-check-input" type="radio" name="dataopimposition" id="formradioRight5" checked>
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
                                                                        <input class="form-check-input" type="radio" name="dataieimposition" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            Inclure ces critères professions
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-check form-radio-primary mb-0">
                                                                        <input class="form-check-input" type="radio" name="dataieimposition" id="formradioRight5" checked>
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
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                                <div class="col-xxl-12">
                                <div class="card">
                                    <div class="card-header d-md-flex gap-3">
                                        <div class="flex-grow-1">
                                            <h4 class="card-title mb-1">AUTRES CRITÈRES</h4>
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="card-body tab-content">
                                        <div class="tab-pane show active" id="defaultAccordionPreview" role="tabpanel" aria-labelledby="defaultAccordionPreview-tab" tabindex="0">
                                            <div class="accordion" id="default-accordion-example">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Champs requis
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Email
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Email MD5
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Prénom
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Nom
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Date de naissance
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Groupe d'âge
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Adresse
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Complément d'adresse
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Pays
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Code postal
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Ville
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Région
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Civilité
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Titre
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Fonction
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Catégorie Socio Professionnelle 
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Parent
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Propriétaire
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Animaux
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Téléphone mobile
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Téléphone fix
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Fax
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Date d'inscription
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Date du dernier email reçu
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Date du dernier email ouvert
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Date du dernier email reçu
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Date du dernier email cliqué
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Date du dernier email envoyé
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Blacklisté
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Statut
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Département
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Tranche d'âge
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Date du nettoyage
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Résultat du nettoyage
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <input class="form-check-input" name="requies[]" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Tronçon
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item" id="dates">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            Dates
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
                                                        <div class="accordion-body">
                                                            <div class="row search_date">
                                                                <div class="col-md-3">
                                                                        <div class="form-check form-check-secondary mb-3">
                                                                            <input class="form-check-input" type="checkbox" id="formCheck7" name="inscris_bool" value="yes">
                                                                            <label class="form-check-label" for="formCheck7">
                                                                                Inscris à moins de 
                                                                            </label>
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="number" name="inscris_int" class="form-control" min="1" id="">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select class="form-select mb-3" aria-label="Default select example" name="inscris_date" id="inscris_date">
                                                                        <option value="Jours">Jours</option>
                                                                        <option value="Semaines">Semaines</option>
                                                                        <option value="Mois">Mois</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row search_date">
                                                                <div class="col-md-3">
                                                                        <div class="form-check form-check-secondary mb-3">
                                                                            <input class="form-check-input" type="checkbox" id="formCheck7" name="ouvreurs_bool" value="yes">
                                                                            <label class="form-check-label" for="formCheck7">
                                                                                Ouvreurs à moins de 
                                                                            </label>
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="number" name="ouvreurs_int" class="form-control" min="1" id="">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select class="form-select mb-3" name="ouvreurs_date" id="ouvreurs_date" aria-label="Default select example">
                                                                        <option value="Jours">Jours</option>
                                                                        <option value="Semaines">Semaines</option>
                                                                        <option value="Mois">Mois</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row search_date">
                                                                <div class="col-md-3">
                                                                        <div class="form-check form-check-secondary mb-3">
                                                                            <input class="form-check-input" type="checkbox" id="formCheck7" name="receveurs_bool" value="yes">
                                                                            <label class="form-check-label" for="formCheck7">
                                                                                Receveurs à moins de 
                                                                            </label>
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="number" name="receveurs_int" class="form-control" min="1" id="">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select class="form-select mb-3" aria-label="Default select example" name="receveurs_date" id="receveurs_date">
                                                                        <option value="Jours">Jours</option>
                                                                        <option value="Semaines">Semaines</option>
                                                                        <option value="Mois">Mois</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                        <div class="form-check form-check-secondary mb-3">
                                                                            <input class="form-check-input" type="checkbox" id="formCheck7" name="cliqueurs_bool" value="yes">
                                                                            <label class="form-check-label" for="formCheck7">
                                                                                Cliqueurs à moins de 
                                                                            </label>
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="number" name="cliqueurs_int" class="form-control" min="1" id="">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select class="form-select mb-3" aria-label="Default select example" name="cliqueurs_date" id="cliqueurs_date">
                                                                        <option value="Jours">Jours</option>
                                                                        <option value="Semaines">Semaines</option>
                                                                        <option value="Mois">Mois</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                    <input class="form-check-input" type="checkbox" id="formCheck7">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                            Date d'inscription est
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select class="form-select mb-3" aria-label="Default select example" name="date-regle-ins" id="date-regle-ins">
                                                                        <option selected="selected"></option>
                                                                        <option value="Défi">Défi</option>
                                                                        <option value="Vide">Vide</option>
                                                                        <option value="Égal à ">Égal à </option>
                                                                        <option value="Différent de">Différent de</option>
                                                                        <option value="Inférieur à">Inférieur à</option>
                                                                        <option value="Supérieur à">Supérieur à</option>
                                                                        <option value="Entre">Entre</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="date" name="date1-ins" id="date1-ins"  class="form-control" min="1" id="">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                        <input class="form-check-input" type="checkbox" id="formCheck7">
                                                                            Date d'ouverture est
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select class="form-select mb-3" aria-label="Default select example">
                                                                        <option selected="selected"></option>
                                                                        <option value="Défi">Défi</option>
                                                                        <option value="Vide">Vide</option>
                                                                        <option value="Égal à ">Égal à </option>
                                                                        <option value="Différent de">Différent de</option>
                                                                        <option value="Inférieur à">Inférieur à</option>
                                                                        <option value="Supérieur à">Supérieur à</option>
                                                                        <option value="Entre">Entre</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="date" class="form-control" min="1" id="">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                        <input class="form-check-input" type="checkbox" id="formCheck7">
                                                                            Date d'envoi est
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select class="form-select mb-3" aria-label="Default select example">
                                                                        <option selected="selected"></option>
                                                                        <option value="Défi">Défi</option>
                                                                        <option value="Vide">Vide</option>
                                                                        <option value="Égal à ">Égal à </option>
                                                                        <option value="Différent de">Différent de</option>
                                                                        <option value="Inférieur à">Inférieur à</option>
                                                                        <option value="Supérieur à">Supérieur à</option>
                                                                        <option value="Entre">Entre</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="date" class="form-control" min="1" id="">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-check form-check-secondary mb-3">
                                                                        <label class="form-check-label" for="formCheck7">
                                                                        <input class="form-check-input" type="checkbox" id="formCheck7">
                                                                            Date de clic est
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select class="form-select mb-3" aria-label="Default select example">
                                                                        <option selected="selected"></option>
                                                                        <option value="Défi">Défi</option>
                                                                        <option value="Vide">Vide</option>
                                                                        <option value="Égal à ">Égal à </option>
                                                                        <option value="Différent de">Différent de</option>
                                                                        <option value="Inférieur à">Inférieur à</option>
                                                                        <option value="Supérieur à">Supérieur à</option>
                                                                        <option value="Entre">Entre</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="date" class="form-control" min="1" id="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThree">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            Domaines
                                                        </button>
                                                    </h2>
                                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h5 class="fs-md mb-2">Exclusion</h5>
                                                                    <select required multiple="multiple" name="domaine_exclu[]"id="multiselect-basic">
                                                                    <option value="wanadoo.fr">wanadoo.fr</option>
                                                                    <option value="yahoo.fr">yahoo.fr</option>
                                                                    <option value="orange.fr">orange.fr</option>
                                                                    <option value="gmail.com">gmail.com</option>
                                                                    <option value="free.fr">free.fr</option>
                                                                    <option value="laposte.net">laposte.net</option>
                                                                    <option value="neuf.fr">neuf.fr</option>
                                                                    <option value="sfr.fr">sfr.fr</option>
                                                                    <option value="yahoo.com">yahoo.com</option>
                                                                    <option value="aliceadsl.fr">aliceadsl.fr</option>
                                                                    <option value="voila.fr">voila.fr</option>
                                                                    <option value="club-internet.fr">club-internet.fr</option>
                                                                    <option value="bbox.fr">bbox.fr</option>
                                                                    <option value="numericable.fr">numericable.fr</option>
                                                                    <option value="noos.fr">noos.fr</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5 class="fs-md mb-2">Inclusion</h5>
                                                                    <select required multiple="multiple" name="domaine_inclu[]" id="multiselect-inclusion">
                                                                        <option value="wanadoo.fr">wanadoo.fr</option>
                                                                        <option value="yahoo.fr">yahoo.fr</option>
                                                                        <option value="orange.fr">orange.fr</option>
                                                                        <option value="gmail.com">gmail.com</option>
                                                                        <option value="free.fr">free.fr</option>
                                                                        <option value="laposte.net">laposte.net</option>
                                                                        <option value="neuf.fr">neuf.fr</option>
                                                                        <option value="sfr.fr">sfr.fr</option>
                                                                        <option value="yahoo.com">yahoo.com</option>
                                                                        <option value="aliceadsl.fr">aliceadsl.fr</option>
                                                                        <option value="voila.fr">voila.fr</option>
                                                                        <option value="club-internet.fr">club-internet.fr</option>
                                                                        <option value="bbox.fr">bbox.fr</option>
                                                                        <option value="numericable.fr">numericable.fr</option>
                                                                        <option value="noos.fr">noos.fr</option>
                                                                    </select>
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
                            </div><!--end col-->
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
                                    </div><!--end col-->
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
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end col-->
                        </div><!--end row-->
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

    <script>
        const button = document.querySelector("#search_name");

        button.addEventListener("change", (event) => {
            //var datestart = document.getElementById('datestart').value
           // var dateend = document.getElementById('dateend').value
           var data = button.value;

            alert(data);
        });
    </script>


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

    checkbox1.addEventListener('change', function() {if (this.checked) {checkbox2.checked = false;}});
    checkbox2.addEventListener('change', function() {if (this.checked) {checkbox1.checked = false;}});

	inclu_pays.addEventListener('change', function() {if (this.checked) {exclu_pays.checked = false;}});
	exclu_pays.addEventListener('change', function() {if (this.checked) {inclu_pays.checked = false;}});	
	
	inclu_ville.addEventListener('change', function() {if (this.checked) {exclu_ville.checked = false;}});
	exclu_ville.addEventListener('change', function() {if (this.checked) {inclu_ville.checked = false;}});	

	$(window).load(function() {
		$("#age_min").val($("div#rangeSlider div.ui-rangeSlider-leftLabel div.ui-rangeSlider-label-value").text());
		$("#age_max").val($("div#rangeSlider div.ui-rangeSlider-rightLabel div.ui-rangeSlider-label-value").text());
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
		        if( $("#input_cp").val() == "" ) {
					$("#input_cp").val(code);
					$("#input_dep").val(code+' ('+region+')');
		        } else {
					if( $("#input_cp").val().search(code) < 0 ) {
						$("#input_cp").val($("#input_cp").val()+','+code);
						$("#input_dep").val($("#input_dep").val()+', '+code+' ('+region+')');
					} else {
						$("#input_cp").val( $("#input_cp").val().replace(','+code, '') );
						$("#input_cp").val( $("#input_cp").val().replace(code+',', '') );
						$("#input_cp").val( $("#input_cp").val().replace(code, '') );

						$("#input_dep").val( $("#input_dep").val().replace(', '+code+' ('+region+')', '') );
						$("#input_dep").val( $("#input_dep").val().replace(code+' ('+region+')'+', ', '') );
						$("#input_dep").val( $("#input_dep").val().replace(code+' ('+region+')', '') );
					}
		        }

		        ajaxRequest();
		    }
		});
	});
			//upload des fichiers codes postales
			$('#inputfile').on("change", function(){
			// FormData permet d'envoyer des fichiers avec AJAX
			const formData = new FormData();

			// Récupérer le fichier sélectionné
			const file = $(this)[0].files[0];

			// Ajouter le fichier au FormData
			formData.append('inputfile', file);
			$.ajax ({
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

		$("#input_pays").on("change", function(){
			// FormData permet d'envoyer des fichiers avec AJAX
			const formData2 = new FormData();

			// Récupérer le fichier sélectionné
			const file = $(this)[0].files[0];
			//console.log(file);
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

		$('#input_villes').on("change", function(){
			// FormData permet d'envoyer des fichiers avec AJAX
			const formData3 = new FormData();

			// Récupérer le fichier sélectionné
			const file = $(this)[0].files[0];

			// Ajouter le fichier au FormData
			formData3.append('input_villes', file);
			$.ajax ({
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

	function ajaxRequest() {
		$.ajax ({
		    url: "count_b2c.php",
		    type: "post",
		    data: $("#form_search_db").serialize(),
		    complete: function (xhr, result) {
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