<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'File Manager')); ?>
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
                                            <input type="text" class="form-control" id="placeholderInput" placeholder="Nom">
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
                                            <h4 class="card-title mb-1">Outlined Styles</h4> </div>
                                    </div><!-- end card header -->
                                    <div class="card-body tab-content">
                                        <div class="tab-pane show active" id="outlinedStylesPreview" role="tabpanel" aria-labelledby="outlinedStylesPreview-tab" tabindex="0">
                                            <div class="hstack gap-2 flex-wrap">
                                                <div class="form-check form-switch form-check-inline" dir="ltr">
                                                    <input type="checkbox" class="form-check-input" id="inlineswitch">
                                                    <label class="form-check-label" for="inlineswitch">@ E-mail</label>
                                                </div>
                                                <div class="form-check form-switch form-check-inline" dir="ltr">
                                                    <input type="checkbox" class="form-check-input" id="inlineswitch1">
                                                    <label class="form-check-label" for="inlineswitch1">Mobile</label>
                                                </div>
                                                <div class="form-check form-switch form-check-inline" dir="ltr">
                                                    <input type="checkbox" class="form-check-input" id="inlineswitchdisabled">
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
                            <div class="card">
                                <div class="card-header mb-0">
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <ul class="nav nav-pills arrow-navtabs nav-primary bg-light mb-3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#arrow-region" role="tab">
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
                                                <div class="tab-pane active" id="arrow-region" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                                    <div class="tab-pane show active" id="customFormsPreview" role="tabpanel" aria-labelledby="customFormsPreview-tab" tabindex="0">
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
                                                                                                <option value="">sélectionnez</option>
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
                                                                                    <p class="text-muted mb-1">Set limit values with remove button</p>
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
                                                                                            <input class="form-check-input" type="radio" name="dataregion" id="formradioRight5" checked>
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
                                                                                            <select class="form-control" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups" multiple>
                                                                                                <option value="">sélectionner des départements</option>
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
                                                                                    <p class="text-muted mb-1">Set limit values with remove button</p>
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
                                                                                            <input class="form-check-input" type="radio" name="datadepartement" id="formradioRight5" checked>
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
                                                                            <option value="">sélectionnez</option>
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
                                                                <input type="file" class="form-control" id="inputGroupFile02">
                                                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                            </div>

                                                            <div class="row">
                                                            <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                                <div class="col-6">
                                                                    <div class="form-check form-radio-primary mb-3">
                                                                        <input class="form-check-input" type="radio" name="formradiocolor1" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            Inclure ces villes
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check form-radio-primary mb-3">
                                                                        <input class="form-check-input" type="radio" name="formradiocolor1" id="formradioRight5" checked>
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
                                                                            <option value="">sélectionnez</option>
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
                                                                <p class="text-muted mb-1">Set limit values with remove button</p>
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
                                                                <input type="file" class="form-control" id="inputGroupFile02">
                                                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                            </div>

                                                            <div class="row">
                                                            <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                                <div class="col-6">
                                                                    <div class="form-check form-radio-primary mb-3">
                                                                        <input class="form-check-input" type="radio" name="datacodepostaux" id="formradioRight5" checked>
                                                                        <label class="form-check-label" for="formradioRight5">
                                                                            Inclure ces codes postaux
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-check form-radio-primary mb-3">
                                                                        <input class="form-check-input" type="radio" name="datacodepostaux" id="formradioRight5" checked>
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
                                                                            <option value="">sélectionnez</option>
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
                                                                <p class="text-muted mb-1">Set limit values with remove button</p>
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
                                                                            <option value="">sélectionnez</option>
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
                                                                <p class="text-muted mb-1">Set limit values with remove button</p>
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
                                                                        <input class="form-check-input" type="radio" name="datahexale" id="formradioRight5" checked>
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
                                    <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#arrow-overview" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-house"></i></span>
                                                <span class="d-none d-sm-block">Sexes</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-profile" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-person"></i></span>
                                                <span class="d-none d-sm-block">Tranches d'âges</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-contact" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                <span class="d-none d-sm-block">Revenus</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-contact" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                <span class="d-none d-sm-block">Habitat</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-contact" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                <span class="d-none d-sm-block">Famille</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-contact" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                <span class="d-none d-sm-block">Centre d'intèrêt</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-contact" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                <span class="d-none d-sm-block">Professions</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#arrow-contact" role="tab">
                                                <span class="d-block d-sm-none"><i class="bi bi-envelope"></i></span>
                                                <span class="d-none d-sm-block">Imposition</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content text-muted">
                                        <div class="tab-pane active" id="arrow-overview" role="tabpanel">
                                            <h6>Give your text a good structure</h6>
                                            <p class="mb-0">
                                                Contrary to popular belief, you don’t have to work endless nights and hours to create a <a href="javascript:void(0);" class="text-decoration-underline"><b>Fantastic Design</b></a> by using complicated 3D elements. Flat design is your friend. Remember that. And the great thing about flat design is that it has become more and more popular over the years, which is excellent news to the beginner and advanced designer.
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="arrow-profile" role="tabpanel">
                                            <h6>Use a color palette</h6>
                                            <p class="mb-0">
                                                Opposites attract, and that’s a fact. It’s in our nature to be interested in the unusual, and that’s why using contrasting colors in <a href="javascript:void(0);" class="text-decoration-underline"><b>Graphic Design</b></a> is a must. It’s eye-catching, it makes a statement, it’s impressive graphic design. Increase or decrease the letter spacing depending on the situation and try, try again until it looks right, and each letter has the perfect spot of its own.
                                            </p>
                                        </div>
                                        <div class="tab-pane" id="arrow-contact" role="tabpanel">
                                            <h6>Contact</h6>
                                            <p class="mb-0">
                                                Consistency is the one thing that can take all of the different elements in your design, and tie them all together and make them work. In an awareness campaign, it is vital for people to begin put 2 and 2 together and begin to recognize your cause. Consistency piques people’s interest is that it has become more and more popular over the years, which is excellent news to the beginner and advanced <a href="javascript:void(0);" class="text-decoration-underline"><b>Contact Designer</b></a>.
                                            </p>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
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
    <!-- autocomplete js -->
    <script src="assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js"></script>

    <!-- init js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
<!-- App js -->
<script src="assets/js/app.js"></script>
</body>

</html>