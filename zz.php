<?php
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
    document.querySelectorAll('input[name="top_pays[]"], select[name="top_pays[]"]').forEach(function(element) {
        element.removeEventListener('change', function() {});
    });

    // Ajouter les événements change pour récupérer les régions, départements et villes
    document.querySelectorAll('input[name="top_pays[]"], select[name="top_pays[]"]').forEach(function(element) {
        element.addEventListener('change', function() {
            const selectedCountries = document.querySelectorAll('input[name="top_pays[]"]:checked, select[name="top_pays[]"] option:checked');
            const selectedCountriesValues = Array.from(selectedCountries).map(checked => checked.value);

            // Requête AJAX pour les régions
            $.ajax({
                url: '/v4/get_regions.php',
                type: 'POST',
                data: { top_pays: selectedCountriesValues },
                success: function(response) {
                    updateSelect('select_multiselect_region', response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Erreur Ajax:", textStatus, errorThrown);
                }
            });

            // Requête AJAX pour les départements
            $.ajax({
                url: '/v4/get_depart.php',
                type: 'POST',
                data: { top_pays: selectedCountriesValues },
                success: function(response) {
                    console.log("dep " + response);
                    updateSelect('select_multiselect_departement', response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Erreur Ajax:", textStatus, errorThrown);
                }
            });

            // Requête AJAX pour les villes
            $.ajax({
                url: '/v4/get_villes.php',
                type: 'POST',
                data: { top_pays: selectedCountriesValues },
                success: function(response) {
                    console.log("villes " + response);
                    updateSelect('select_multiselect_ville', response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Erreur Ajax:", textStatus, errorThrown);
                }
            });
        });
    });
});

?>             
                        
                        
                        <div class="card">
                                    <div class="card-header ">
                                        <div class="flex-grow-1">
                                            <h4 class="card-title mb-1">Type de location</h4>
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="card-body tab-content">
                                        <div class="tab-pane show active" id="outlinedStylesPreview" role="tabpanel" aria-labelledby="outlinedStylesPreview-tab" tabindex="0">
                                            <div class="hstack gap-2 flex-wrap">
                                                <div class="form-check form-switch form-check-inline" dir="ltr">
                                                    <input type="checkbox" checked name="type[]" value="emailpro" class="form-check-input" id="inlineswitch">
                                                    <label class="form-check-label" for="inlineswitch">@
                                                        E-mail</label>
                                                </div>
                                                <div class="form-check form-switch form-check-inline" dir="ltr">
                                                    <input type="checkbox" name="type[]" value="phonecompany" class="form-check-input" id="inlineswitch1">
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
                                                                                    pays </p><!-- 'Suède', 'Russie', 'Finlande', 'Roumanie', 'Hongrie',];-->
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
                                                                                    <select class="form-control paysSelect" id="choices-single-groups" name="pays[]" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem name="choices-single-groups"  multiple>
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
                                                                                    <input class="form-control paysInput" name="autre_pays[]" id="choices-text-remove-button" data-choices  data-choices-removeItem type="text" >
                                                                                </div>
                                                                                <div class="" style="margin-bottom: 10px;">
                                                                                    <p class="text-muted mb-1">
                                                                                        Copier-coller :</p>
                                                                                    <div class="form-group">
                                                                                        <div class="input-group">
                                                                                                <span class="input-group-text text-muted">
                                                                                                    <i class="bi bi-clipboard"></i>
                                                                                                </span>
                                                                                            <textarea class="form-control " rows="2" placeholder="Copier-coller des pays..." name="textarea_numreg" id="textarea_numreg" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
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
                                                                                    <input type="file" class="form-control " name="input_pays" id="input_pays" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
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
                                                                                   <select id="select_multiselect_region" class="form-control"   data-choices data-choices-groups  data-choices-removeItem name="regions" multiple>
                                                                                   
                                                                                </div>
                                                                                <div class="mt-0" style="margin-bottom: 10px;">
                                                                                    <p class="text-muted mb-1">Ajouter un ou plusieurs regions</p>
                                                                                    <input class="form-control" id="choices-text-remove-button" name="autres_regions" data-choices  data-choices-removeItem type="text" value="" >
                                                                                </div>
                                                                                <select id="regionsSelect" class="form-control" multiple>
                                                                                    <!-- Les options seront ajoutées dynamiquement -->
                                                                                </select>
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
                                                    <!-- Département-->
                                                    <div class="tab-pane" id="arrow-departement" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="tab-pane" id="customFormsPreview" role="tabpanel" aria-labelledby="customFormsPreview-tab" tabindex="0">
                                                                    <div class="row g-3">
                                                                        <div class="col-lg-6">
                                                                            <div class="mt-1 mt-lg-0">
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
                                                                                <div style="margin-bottom: 10px;">
                                                                                    <p class="text-muted mb-1">Sélectionner un ou plusieurs départements </p>
                                                                                    <select id="select_multiselect_departement" class="form-control"  name="geoloc[]" data-choices data-choices-groups data-choices-removeItem  multiple>
                                                                                        <option value="">Sélectionnez</option>
                                                                                        <option value="zz">Sélectionnez</option>
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
                                                                                            <input class="form-check-input" type="radio" name="inclu_departement" id="formradioRight5" value="true" checked>
                                                                                            <label class="form-check-label" for="formradioRight5">
                                                                                                Inclure ces  départements
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-check form-radio-primary mb-3">
                                                                                            <input class="form-check-input" type="radio" name="inclu_departement" value="false" id="formradioRight5">
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
                                                     <!-- Ville-->
                                                    <div class="tab-pane" id="ville" role="tabpanel">
                                                        <div class="row g-3">
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mt-lg-0">
                                                                    <p class="text-muted mb-1">Les 12 Tops des villes </p>
                                                                    <div class="row">
                                                                        <?php
                                                                        $requete = "SELECT DISTINCT (city_name) FROM world_cities GROUP BY city_name order by city_name desc LIMIT 12";
                                                                        $result = $bdd->executeQueryRequete($requete, 1);

                                                                        while( $city = $result->fetch() ) { ?>
                                                                            <div class="col-lg-6">
                                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                                    <input name="ville" type="checkbox" value="<?= htmlspecialchars($city->city_name) ?>" class="form-check-input" id="customSwitchsizemd">
                                                                                    <label class="form-check-label" for="customSwitchsizemd"> <?= $city->city_name ?></label>
                                                                                </div>
                                                                            </div>
                                                                        <?php  } ?>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                &nbsp;
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mt-1 mb-0 mt-lg-0">
                                                                    <div style="margin-bottom: 10px;">
                                                                        <p class="text-muted mb-1">Sélectionner une ou plusieurs villes </p>
                                                                        <select class="form-control" name="villes[]" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" data-choices-removeItem multiple>
                                                                            <option value="">Sélectionnez</option>

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
                                                     <!-- Code postal-->
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
                                                                        <select class="form-control" id="multiple_code_postal" data-choices data-choices-groups   data-choices-removeItem name="cp[]" multiple>
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
                                                     <!-- Codes INSEE-->
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
                                                    <!-- Codes INSEE-->
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
                                                    <!-- Codes HEXAVIA-->
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
                                                     <!-- Codes HEXACLE-->
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
                                                                <input class="form-control" id="naf" name="naf" data-choices data-choices-removeItem type="text">
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Rechercher les codes NAF:</p>
                                                            <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                <select id="search_code_naf" name="search_code_naf" class="form-select mb-3" aria-label="Default select example" >
                                                                    <option value="">Rechercher des codes NAF 2008</option>
                                                                    <option value="22">NAF 2008</option>
                                                                    
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
                                                                    <textarea class="form-control" rows="2" placeholder="Copier-coller des codes NAF 2008..." id="code_naf_paste" name="code_naf_paste" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                    <!--<button type="button" id="valider_naf" name="valider_naf" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                        <i class="bi bi-check2"></i> Valider
                                                                    </button>-->
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
                                                                    <input class="form-check-input" type="radio" id="inclu_naf" name="inclu_naf" value="true" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Inclure ces codes NAF 2008
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="inclu_naf" name="inclu_naf"  value="false">
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
                                                            <p class="text-muted mb-1">Rechercher les formes juridiques:</p>
                                                            <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                <select id="search_forme_juridique" name="search_forme_juridique" class="form-select mb-3" aria-label="Default select example" >
                                                                    <option value="">Rechercher des formes juridiques</option>
                                                                <option value="33">Forme juridique</option>
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
                                                                    <textarea class="form-control" rows="2" placeholder="Copier-coller des formes juridiques..." id="forme_juridique_paste" name="forme_juridique_paste"  data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                <!-- <button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                        <i class="bi bi-check2"></i> Valider
                                                                    </button>-->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                        <div class="input-group mb-1">
                                                            <input type="file" class="form-control" id="input_form_juridique"  name="input_form_juridique" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                        </div>

                                                        <div class="row">
                                                            <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="inclu_form_juridique" name="inclu_forme" value="true" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Inclure ces formes juridiques
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="inclu_form_juridique" name="inclu_forme" value="false">
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Exclure ces formes juridiques
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
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="institutions[]" value="1">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Mairies</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="institutions[]" value="2">
                                                                    <label class="form-check-label" for="customSwitchsizelg">EPCI</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="institutions[]" value="3">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Conseils départementaux</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="institutions[]" value="4">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Conseils généraux</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="institutions[]" value="4">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Députés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" id="customSwitchsizelg" name="institutions[]" value="4">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Sénateurs</label>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted" style="margin-bottom: 10px;">Vous
                                                                pouvez choisir une ou plusieurs institutions</small>
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <input type="radio" class="btn-check" name="fj_tout_cocher" id="fj_tout_cocher" checked>
                                                                    <label class="btn btn-outline-light" for="success-outlined">Tout cocher</label>

                                                                    <input type="radio" class="btn-check" name="fj_tout_decocher" id="fj_tout_decocher">
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
                                                            <p class="text-muted mb-1">Sélectionner une ou plusieurs fonctions :</p>
                                                            <div class="" style="margin-bottom: 10px;">
                                                                <input class="form-control" id="activity" name="activity" data-choices  data-choices-removeItem type="text" >
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Rechercher une ou plusieurs fonctions :</p>
                                                            <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                <select class="form-select mb-3" aria-label="Default select example" name="search_fonctions" id="search_fonctions">
                                                                    <option value="">Rechercher des fonctions</option>
                                                                    <option value="zz">Postes</option>
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
                                                                    <textarea class="form-control" rows="2" placeholder="Copier-coller des fonctions..." name="fonctions_paste" id="fonctions_paste" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                    <!--<button type="button" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                        <i class="bi bi-check2"></i> Valider
                                                                    </button>-->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                        <div class="input-group mb-1">
                                                            <input type="file" class="form-control" name="inputfile_fonctions" id="inputfile_fonctions" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                        </div>

                                                        <div class="row">
                                                            <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="inclu_fonction" name="inclu_fonction" value="true" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Inclure ces fonctions
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="inclu_fonction" name="inclu_fonction" value="false">
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
                                                                    <input type="checkbox" class="form-check-input" value="non" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Effectif inconnu</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="1" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">0 salarié</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="2" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">1 ou 2 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="3" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">3 à 4 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="4" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">6 à 9 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="5" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">10 à 19 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="6" type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">20 à 49 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="7" type="checkbox" class="form-check-input" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">50 à 99 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="8" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">100 à 119 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="9" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">200 à 249 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="10" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">250 à 499 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="11" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">500 à 999 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="12" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">1000 à 1999 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="13" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">2000 à 4999 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="14" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">5000 à 9999 salariés</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="15" type="checkbox" class="form-check-input" name="effectif" id="customSwitchsizelg">
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
                                                                    <input value="1" type="checkbox" class="form-check-input" name="ca" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Moins de 1 million d'€</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="2" type="checkbox" class="form-check-input" name="ca" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">De 1 à 2 million d'€</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="3" type="checkbox" class="form-check-input" name="ca" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">De 2 à 5 million d'€</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="4" type="checkbox" class="form-check-input" name="ca" id="customSwitchsizelg">
                                                                    <label class="form-check-label" for="customSwitchsizelg">De 5 à 10 million d'€</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input value="5" type="checkbox" class="form-check-input" name="ca" id="customSwitchsizelg">
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
                                                                    <input value="true" class="form-check-input" type="radio" name="inclu_ca" id="inclure_ca" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Inclure ces tranches de chiffre d'affaires
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-check form-radio-primary mb-0">
                                                                    <input value="false" class="form-check-input" type="radio" name="inclu_ca" id="inclure_ca" checked>
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
                                                                <input name="date1-ins" type="date" id="date1_ins" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Choisir la date de fin :</p>
                                                            <div class="" style="margin-bottom: 10px;">
                                                                <input name="date2-ins" type="date" id="date2_ins" class="form-control">
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
                                                                    <input type="checkbox" class="form-check-input" name="type_ets" id="customSwitchsizelg" value="1">
                                                                    <label class="form-check-label" for="customSwitchsizelg">Sièges sociaux</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                                    <input type="checkbox" class="form-check-input" name="type_ets" id="customSwitchsizelg" value="2">
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
                                                                <input name="convetion_collecive"  class="form-control" id="choices-cCol" data-choices  data-choices-removeItem type="text" value="">
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                            <p class="text-muted mb-1">Rechercher :</p>
                                                            <div class="tab-pane show active" id="radioToggleButtonsPreview" role="tabpanel" aria-labelledby="radioToggleButtonsPreview-tab" tabindex="0">
                                                                <select class="form-select mb-3" aria-label="Default select example" name="search_convention_coll" id="search_convention_coll">
                                                                    <option value="">Rechercher des conventions collectives</option>
                                                                    <option value="22">Conventions collectives</option>
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
                                                                    <textarea class="form-control" rows="2" placeholder="Copier-coller des conventions collectives..." id="conv_collec_paste" name="conv_collec_paste" data-sider-insert-id="729f8458-7b21-4b7a-8e44-5cfdebe9cff2" data-sider-select-id="5f22a146-fc32-4835-93e4-069ab4abb7a4"></textarea>
                                                                    <!--<button type="button" id="valider_cCol" class="input-group-text text-muted" data-func="_copypaste" data-subcat="numreg" data-map="map_numreg" data-gmap="gmap_numreg" data-checkbox=".check_numreg" data-textarea="textarea_numreg" data-totcounter="geo" data-selectedtext="régions sélectionnées" data-addedtext="régions ajoutées" data-deletedtext="régions supprimées">
                                                                        <i class="bi bi-check2"></i> Valider
                                                                    </button>-->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <p class="text-muted mt-1 mb-1">Envoyer un fichier</p>
                                                        <div class="input-group mb-1">
                                                            <input type="file" class="form-control" name="input_conv_collec" id="input_conv_collec" accept=".txt,.csv,.xls,.xlsx,.ods,.zip">
                                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                                        </div>

                                                        <div class="row">
                                                            <p class="text-muted mt-2 mb-1">Inclure ou exclure</p>
                                                            <div class="col-12">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="conv_collect_inclure" name="conv_collect_inclure" value="true" checked>
                                                                    <label class="form-check-label" for="formradioRight5">
                                                                        Inclure ces conventions collectives
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-check form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" id="conv_collect_inclure" name="conv_collect_inclure" value="false">
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