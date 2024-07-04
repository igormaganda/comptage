<?php
	$odometer = 1;
	$map = 1;

    require_once("../../../sdatamart/lib/system_load.php");
    authenticate_user('all');

	require("../../header.php");
	require("partials/class/Bdd.php");

	$bdd = new Bdd();
?>

    <style>
        .flex{
            display: flex;
            justify-content: space-around;
        }
        .border{
            width:20%;
            border: 1px solid;
            border-radius: 5px;
            border-color: #efefef;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .border>div{
            padding-left: 10px;
            padding-right: 10px;
            display: flex;
            justify-content: space-between;
        }
        .border>div>span>input{
            margin-right: 5px;
        }
        .border>p{
            padding: 10px 32px 0 32px;
        }

        #volume {
            margin: 0px !important;
        }
    </style>

<div id="content">
	<div class="widget" id="search_content">
		<div class="widget-body innerAll inner-2x">
			<form method="POST" action="../../search_a_btob.php" name="form_search_db" id="form_search_db">
				<div class="widget-head">
					<h4 class="heading glyphicons search"><i></i>Nom de la recherche</h4>
				</div>
				
				<div class="widget-body">
					<input name="name" type="text" id="search_name" class="form-control input-lg" placeholder="Nom">
				</div>

                <!-- Début code filtre pour la location(clé) -->
                <div class="widget-head">
                    <h4 class="heading"><i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 8px;"></i>Choisir la location</h4>
                </div>

                <div class="flex">
                    <div class="border">
                        <div>
                                <span>
                                    <input type="checkbox" name="location[]" value="emailpro" checked>
                                    <label for="">Adresses emails</label>
                                </span>
                            <span class="material-icons">
                                    alternate_email
                                </span>
                        </div>
                        <p>
                            La location d'adresses emails
                        </p>
                    </div>

                    <div class="border">
                        <div>
                                <span>
                                    <input type="checkbox" name="location[]" value="phonecompany">
                                    <label>Téléphones mobiles</label>
                                </span>
                            <span><i class="fa fa-mobile fa-2x" aria-hidden="true"></i></span>
                        </div>
                        <p>
                            La location de téléphones mobiles
                        </p>
                    </div>
                    <div class="border">
                        <div>
                                <span>
                                    <input type="checkbox" name="location[]" value="cp">
                                    <label>Adresses postales</label>
                                </span>
                            <span><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i></span>
                        </div>
                        <p>
                            La location d'adresses postales
                        </p>
                    </div>
                </div>
                <!-- Fin code Filtre pour la location(clé) -->


				<div class="widget-head">
					<h4 class="heading glyphicons cloud-download"><i></i>Import</h4>
				</div>
				
				<div class="widget-body">
					<div class="col-sm-6">
					<h5>Partenaires</h5>
					<select name="partenaire" class="form-control input-lg" id="partenaire">
						<option value=""></option>
						<?php
						$requete = "SELECT id, nom FROM gestion_partenaire ORDER BY nom ASC";
						$result = $bdd->executeQueryRequete($requete, 1);

						while( $partenaire = $result->fetch() ) {
							echo '<option value="'.$partenaire->id.'">'.$partenaire->nom.'</option>';
						}
						?>
					</select>
					</div>

					<div class="col-sm-6">
					<h5>Programmes</h5>
					<select name="programme" class="form-control input-lg" id="programme">
						<option value=""></option>
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
                <!-- Debut CRITERES DE POSTES -->
                <div class="widget-head">
                    <h4 class="heading glyphicons calendar"><i></i>CRITERES DE POSTES</h4>
                    <!--<span class="badge badge-info" id="search-add"><i class="fa fa-plus"></i></span>-->
                </div>

                <div class="widget-body">
                    <div class="widget-body">
                        <h5>Saisir une ou plusieurs fonctions / copier-coller une liste de fonctions</h5>
                        <input type="hidden" id="activity" name="activity" class="multiinput" style="width: 100%; height: 80px" />
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="inclu_fonction" name="fonction_inclure" value="true" checked ></i>
                            <label class="form-check-label" for="inclu_fonction">Inclure ces fonctions</label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="exclu_pays">
                                <input type="checkbox" class="form-check-input" id="exclu_fonction" name="fonction_inclure" value="false" >
                                Exclure ces fonctions</label>
                        </div>
                    </div>
                    <!--<table class="search_date">
                        <h5>Inclure ou exclure</h5
                        <tr>
                            <div class="widget-body">
                                <table id="sexe">
                                    <tr>
                                        <td>
                                            <div class="radio">
                                                <label class="radio-custom">
                                                    <input type="radio" name="genre" value="1">
                                                    <i class="fa fa-circle-o"></i> Inclure
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="radio">
                                                <label class="radio-custom">
                                                    <input type="radio" name="genre" value="0" checked="checked">
                                                    <i class="fa fa-circle-o checked"></i> Exclure
                                                </label>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <h5 class="heading glyphicons"><i></i>Vous pouvez inclure ou exclure la ou les fonctions sélectionnées</h5>
                                        </td>

                                    </tr>
                                </table>
                            </div>
                        </tr>
                    </table>-->
                </div>

                <!-- DEBUT CRITETES GEOGRAPHIES --->
                <div class="widget-head">
                    <h4 class="heading glyphicons globe"><i></i>CRITERES GEOGRAPHIQUES</h4>
                </div>
                <div class="widget-body">
                    <input type="hidden" name="input_cp" id="input_cp" />
                    <input type="text" name="input_dep" id="input_dep" class="form-control input-lg" disabled />
                    <!--					<div id="map_dep"></div>-->

                    <table class="half">
                        <tr>
                            <th>Pays</th>
                            <th>Départements</th>
                        </tr>
                        <tr>
                            <td style="width:33%">
                                <select multiple id="multiselect" class="multiselect" name="pays[]">
                                    <?php
                                    $requete = "SELECT pays, extension FROM search_pays ORDER BY pays ASC";
                                    $result = $bdd->executeQueryRequete($requete, 1);

                                    while( $pays = $result->fetch() ) {
                                        echo '<option value="'.$pays->extension.'">'.$pays->pays.'</option>';
                                    }
                                    ?>
                                </select>

                                <h5>Autre pays</h5>
                                <input type="hidden" id="autre_pays" name="autre_pays" class="multiinput" style="width: 90%; height:20% z-index: 0" />
                                <!-- Section Autre pays -->

                                <div class="input-group  d-flex" style="width: 90%; margin-top:10px">
                                        <span class="input-group-text">
                                            <i class="fa fa-cloud-upload"></i>
                                        </span>
                                    <input type="file" class="form-control" name="input_pays" id="input_pays" accept=".txt,.csv,.xls,.xlsx,.ods,.zip" style="height: 37px; z-index: 0" >
                                    <label class="input-group-text" for="inputGroupFile01">Choisir un fichier</label>
                                </div>
                                <span style="color: red; font-size: 12px;">* Votre fichier CSV doit avoir une colonne "pays"</span>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="inclu_pays" name="pays_inclure" value="true" checked ></i>
                                    <label class="form-check-label" for="">Inclure ces pays</label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="exclu_pays">
                                        <input type="checkbox" class="form-check-input" id="exclu_pays" name="pays_inclure" value="false" >
                                        Exclure ces pays</label>
                                </div>

                                <!-- Fin Section Autre pays -->

                            </td>
                            <td style="width:33%">
                                <select multiple id="" class="multiselect" name="geoloc[]">
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

                                <h5>Code postal</h5>
                                <input type="hidden" id="postal" name="postal" class="multiinput" style="width: 90%;" />
                                <!-- Section Code postal -->
                                <div class="input-group  d-flex" style="width: 90%; margin-top:10px">
                                        <span class="input-group-text">
                                            <i class="fa fa-cloud-upload"></i>
                                        </span>
                                    <input type="file" class="form-control" name="inputfile" id="inputfile" accept=".txt,.csv,.xls,.xlsx,.ods,.zip" style="height: 37px; z-index: 0" >
                                    <label class="input-group-text" for="inputGroupFile01">Choisir un fichier</label>
                                </div>
                                <span style="color: #de7474; font-size: 12px;">* Votre fichier CSV doit avoir une colonne "cp"</span>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox1" name="cp_inclure" value="true" checked ></i>
                                    <label class="form-check-label" for="checkbox1">Inclure ces codes</label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="checkbox2">
                                        <input type="checkbox" class="form-check-input" id="checkbox2" name="cp_inclure" value="false" >
                                        Exclure ces codes</label>
                                </div>

                                <!-- Fin Section Code postal -->
                            </td>
                            <td style="width:33%">
                                <select multiple id="multiselect" class="multiselect" name="pays[]">
                                    <?php
                                    $requete = "SELECT pays, extension FROM search_pays ORDER BY pays ASC";
                                    $result = $bdd->executeQueryRequete($requete, 1);

                                    while( $pays = $result->fetch() ) {
                                        echo '<option value="'.$pays->extension.'">'.$pays->pays.'</option>';
                                    }
                                    ?>
                                </select>

                                <h5>Autre Villes</h5>
                                <input type="hidden" id="autre_ville" name="villes" class="multiinput" style="width: 90%; height:20%" />
                                <!-- Section Autre villes -->

                                <div class="input-group  d-flex" style="width: 90%; margin-top:10px">
                                        <span class="input-group-text">
                                            <i class="fa fa-cloud-upload"></i>
                                        </span>
                                    <input type="file" class="form-control" name="input_villes" id="input_villes" accept=".txt,.csv,.xls,.xlsx,.ods,.zip" style="height: 37px; z-index: 0" >
                                    <label class="input-group-text">Choisir un fichier</label>
                                </div>
                                <span style="color: red; font-size: 12px;">* Votre fichier CSV doit avoir une colonne "ville"</span>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="inclu_ville" name="ville_inclure" value="true" checked ></i>
                                    <label class="form-check-label" for="">Inclure ces villes</label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="exclu_ville">
                                        <input type="checkbox" class="form-check-input" id="exclu_ville" name="ville_inclure" value="false" >
                                        Exclure ces villes</label>
                                </div>
                                <!-- Fin Section Autre villes -->
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- FIN CRITETES GEOGRAPHIES --->

                <!-- DEBUT CRITETES SEGMENTATIONS --->

                <div class="widget-head">
                    <h4 class="heading glyphicons beer"><i></i>Centres de segmentation</h4>
                </div>

                <div class="widget-body" id="dates">
                    <table class="search_date">
                        <tr>
                            <div class="widget-body">
                                <div class="col-sm-6">
                                    <h5>NAF</h5>
                                    <input type="hidden" id="naf" name="naf" class="multiinput" style="width: 95%;" />
                                    <!-- Section NAF -->

                                    <div class="input-group  d-flex" style="width: 90%; margin-top:10px">
                                            <span class="input-group-text">
                                                <i class="fa fa-cloud-upload"></i>
                                            </span>
                                        <input type="file" class="form-control" name="input_naf" id="input_naf" accept=".txt,.csv,.xls,.xlsx,.ods,.zip" style="height: 37px; z-index: 0" >
                                        <label class="input-group-text" for="inputGroupFile01">Choisir un fichier</label>
                                    </div>
                                    <span style="color: red; font-size: 12px;">* Votre fichier CSV doit avoir une colonne "naf"</span>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="inclu_naf" name="naf_inclure" value="true" checked ></i>
                                        <label class="form-check-label" for="">Inclure ces NAF</label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="exclu_naf">
                                            <input type="checkbox" class="form-check-input" id="exclu_naf" name="naf_inclure" value="false" >
                                            Exclure ces NAF</label>
                                    </div>

                                </div>
                                <!-- Section Forme Juridique -->

                                <div class="col-sm-6">
                                    <h5>Forme juridique</h5>
                                    <input type="hidden" id="forme_juridique" name="forme_juridique" class="multiinput" style="width: 95%;" />

                                    <div class="input-group  d-flex" style="width: 90%; margin-top:10px">
                                        <span class="input-group-text">
                                            <i class="fa fa-cloud-upload"></i>
                                        </span>
                                        <input type="file" class="form-control" name="input_form_juridique" id="input_form_juridique" accept=".txt,.csv,.xls,.xlsx,.ods,.zip" style="height: 37px; z-index: 0" >
                                        <label class="input-group-text" for="inputGroupFile01">Choisir un fichier</label>
                                    </div>
                                    <span style="color: red; font-size: 12px;">* Votre fichier CSV doit avoir une colonne "fj"</span>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="inclu_form_juridique" name="form_juridique_inclure" value="true" checked ></i>
                                        <label class="form-check-label" for="">Inclure ces formes juridiques</label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" for="exclu_form_juridique">
                                            <input type="checkbox" class="form-check-input" id="exclu_form_juridique" name="form_juridique_inclure" value="false" >
                                            Exclure ces formes juridiques</label>
                                    </div>

                                </div>
                            </div>

                        </tr>
                    </table>

                    <!-- Section Institutions -->
                    <div class="widget-body">
                        <div class="checkbox">
                            <h5>Institutions</h5>
                        </div>

                        <input name="occurrence" type="hidden" id="occurrence">

                        <div class="widget widget-heading-simple widget-body-gray">
                            <div class="widget-body" id="occurrence-slider">
                                <div class="slider-range-min row form-horizontal">

                                    <tr>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="institution[]" value="1">
                                                                <i class="fa fa-fw fa-square-o"></i> Mairies
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="institution[]" value="2">
                                                                <i class="fa fa-fw fa-square-o"></i> EPCI
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="institution[]" value="3">
                                                                <i class="fa fa-fw fa-square-o"></i> Conseils départemantaux
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="institution[]" value="4">
                                                                <i class="fa fa-fw fa-square-o"></i> conseils régionaux
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <br />
                                    <tr>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="institution[]" value="5">
                                                                <i class="fa fa-fw fa-square-o"></i> Députés
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="institution[]" value="6">
                                                                <i class="fa fa-fw fa-square-o"></i> Sénateurs
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;"></td>
                                                    <td style="width: 25%;"></td>

                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- FIN Institutions -->

                    <!-- Effectifs -->
                    <div class="widget-body">
                        <div class="checkbox">
                            <h5>Effectifs</h5>
                        </div>

                        <input name="occurrence" type="hidden" id="occurrence">

                        <div class="widget widget-heading-simple widget-body-gray">
                            <div class="widget-body" id="occurrence-slider">
                                <div class="slider-range-min row form-horizontal">

                                    <tr>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="non">
                                                                <i class="fa fa-fw fa-square-o"></i> Unités non employeuses
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="1">
                                                                <i class="fa fa-fw fa-square-o"></i> 0 salarié
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="2">
                                                                <i class="fa fa-fw fa-square-o"></i> 1 ou 2 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="3">
                                                                <i class="fa fa-fw fa-square-o"></i> 3 à 5 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <br />
                                    <tr>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="4">
                                                                <i class="fa fa-fw fa-square-o"></i> 6 à 9 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="5">
                                                                <i class="fa fa-fw fa-square-o"></i> 10 à 19 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="6">
                                                                <i class="fa fa-fw fa-square-o"></i> 20 à 24 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="7">
                                                                <i class="fa fa-fw fa-square-o"></i> 50 à 99 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <br />
                                    <tr>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="8">
                                                                <i class="fa fa-fw fa-square-o"></i> 100 à 199 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="9">
                                                                <i class="fa fa-fw fa-square-o"></i> 200 à 249 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="10">
                                                                <i class="fa fa-fw fa-square-o"></i> 250 à 499 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="11">
                                                                <i class="fa fa-fw fa-square-o"></i> 500 à 999 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <br />
                                    <tr>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="12">
                                                                <i class="fa fa-fw fa-square-o"></i> 1000 à 1999 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="13">
                                                                <i class="fa fa-fw fa-square-o"></i> 2000 à 4999 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="14">
                                                                <i class="fa fa-fw fa-square-o"></i> 5000 à 9999 salariés
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="effectif" value="15">
                                                                <i class="fa fa-fw fa-square-o"></i> 10000 salariés et plus
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin Effectifs -->

                    <!-- Chiffres d'affaires -->
                    <div class="widget-body">
                        <div class="checkbox">
                            <h5>Chiffres d'affaires</h5>
                        </div>

                        <input name="occurrence" type="hidden" id="occurrence">

                        <div class="widget widget-heading-simple widget-body-gray">
                            <div class="widget-body" id="occurrence-slider">
                                <div class="slider-range-min row form-horizontal">

                                    <tr>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="ca" value="1">
                                                                <i class="fa fa-fw fa-square-o"></i> Moins de 0.5 million d'€
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="ca" value="2">
                                                                <i class="fa fa-fw fa-square-o"></i> De 0.5 à moins de 1 million d'€
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="ca" value="3">
                                                                <i class="fa fa-fw fa-square-o"></i> De 1 million à moins de 2 million d'€
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="ca" value="4">
                                                                <i class="fa fa-fw fa-square-o"></i> De 2 millions à moins de 5 millions d'€
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <br />
                                    <tr>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="ca" value="5">
                                                                <i class="fa fa-fw fa-square-o"></i> De 5 millions à moins de 10 millions d'€
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="ca" value="6">
                                                                <i class="fa fa-fw fa-square-o"></i> De 10 millions à moins de 20 millions d'€
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="ca" value="7">
                                                                <i class="fa fa-fw fa-square-o"></i> De 20 millions à moins de 50 millions d'€
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="ca" value="8">
                                                                <i class="fa fa-fw fa-square-o"></i> De 50 millions à moins de 100 millions d'€
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <br />
                                    <tr>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="ca" value="9">
                                                                <i class="fa fa-fw fa-square-o"></i> De 100 millions à moins de 200 millions d'€
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="ca" value="10">
                                                                <i class="fa fa-fw fa-square-o"></i> De 200 millions d'€ ou plus
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">

                                                    </td>
                                                    <td style="width: 25%;">

                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Fin Chiffres d'affaires -->

                    <!-- Date de création -->
                    <div class="widget-body">
                        <div class="checkbox">
                            <h5>Date de création</h5>
                        </div>

                        <input name="occurrence" type="hidden" id="occurrence">

                        <div class="widget widget-heading-simple widget-body-gray">
                            <div class="widget-body" id="occurrence-slider">
                                <div class="slider-range-min row form-horizontal">
                                    <div id="search-date-ins">
                                        <div class="col-sm-3 ">Plage de la date de création</div>
                                        <div class="col-sm-4 ">
                                            <input name="date1-ins" type="text" id="date1-ins" class="form-control input-lg search-date" placeholder="Sélectionner une plage ...">
                                        </div>
                                        <div class="col-sm-1 search-txt ">entre</div>
                                        <div class="col-sm-4 ">
                                            <input name="date2-ins" type="text" id="date2-ins" class="form-control input-lg search-date" placeholder="Sélectionner une autre plage ...">
                                        </div>

                                        <!--                                            <div class="col-sm-3">-->
                                        <!--                                                <input name="date1-ins" type="text" id="date1-ins" class="form-control input-lg search-date" placeholder="Sélectionner une plage ...">-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="col-sm-1 search-txt none-ins">et</div>-->
                                        <!--                                            <div class="col-sm-2 none-ins">-->
                                        <!--                                                <input name="date2-ins" type="text" id="date2-ins" class="form-control input-lg search-date" placeholder="Date">-->
                                        <!--                                            </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin Date de création -->

                    <!-- Types d'établissements -->

                    <div class="widget-body">
                        <div class="checkbox">
                            <h5>Types d'établissements</h5>
                        </div>

                        <input name="occurrence" type="hidden" id="occurrence">

                        <div class="widget widget-heading-simple widget-body-gray">
                            <div class="widget-body" id="occurrence-slider">
                                <div class="slider-range-min row form-horizontal">

                                    <tr>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="type_ets" value="1">
                                                                <i class="fa fa-fw fa-square-o"></i> Sièges sociaux
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <div class="checkbox">
                                                            <label class="checkbox-custom">
                                                                <input type="checkbox" name="type_ets" value="2">
                                                                <i class="fa fa-fw fa-square-o"></i>Etablissements secondaires
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Fin Types d'établissements -->




                </div>

                <!-- FIN CRITETES SEGMENTATIONS -->



				<div class="widget-head">
					<h4 class="heading glyphicons server"><i></i>Domaines</h4>
				</div>

				<div class="widget-body">
					<div class="checkbox">
						<label class="checkbox-custom"> 
							<input type="checkbox" name="topDomaine" value="yes" checked="checked">
							<i class="fa fa-fw fa-square-o checked"></i> Top domaine uniquement.
						</label> 
					</div>

                    <div class="widget-body">
                        <input name="date" type="hidden" id="date">

                        <div class="widget widget-heading-simple widget-body-gray">
                            <div class="widget-body" id="age-slider">
                                <div class="slider-range-min row form-horizontal">
                                    <div class="col-md-3">
                                        <div class="control-group">
                                            <label class="col-md-8 control-label">Occurrence < ou = à:</label>
                                            <div class="col-md-4 padding-none">
                                                <input type="text" class="amount form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9" style="padding-top: 9px;">
                                        <div class="slider slider-primary"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

				<!--	<input name="occurrence" type="hidden" id="occurrence">

					<div class="widget widget-heading-simple widget-body-gray">
						<div class="widget-body" id="occurrence-slider">
							<div class="slider-range-min row form-horizontal">
								<div class="col-md-3">
									<div class="control-group">
										<label class="col-md-8 control-label">Occurrence < ou = à:</label> 
										<div class="col-md-4 padding-none">
											<input type="text" class="amount form-control" />
										</div>
									</div>
								</div>
								<div class="col-md-9" style="padding-top: 9px;">
									<div class="slider slider-primary"></div>
								</div>
							</div>
						</div>
					</div>-->

					<table class="half">
						<tr>
							<th>Exclusion</th>
							<th>Inclusion</th>
						</tr>
						<tr>
							<td>
								<select multiple class="multiselect" name="domaine_exclu[]">
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

								<input type="hidden" id="autre_domaines_exclu" name="autre_domaines_exclu" class="multiinp^[1-9]{1,}ut" style="width: 90%;" />
							</td>
							<td>
								<select multiple class="multiselect" name="domaine_inclu[]">
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


							</td>
						</tr>
					</table>
				</div>

				<div id="input_search_submit" style="clear:both;">
					<input type="submit" value="Enregistrer le comptage" class="btn btn-info" />
				</div>
			</form>
		</div>
	</div>

	<div id="alert_msg">
		<span id="msg_echec" class="btn btn-danger" data-layout="top" data-type="error" data-toggle="notyfy"></span>
	</div>
</div>

<div id="requete-count">
	<p></p>
</div>
<div id="volume">
	<p class="odometer">0</p>
</div>

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

    inclu_naf.addEventListener('change', function() {if (this.checked) {exclu_naf.checked = false;}});
    exclu_naf.addEventListener('change', function() {if (this.checked) {inclu_naf.checked = false;}});

    inclu_fonction.addEventListener('change', function() {if (this.checked) {exclu_fonction.checked = false;}});
    exclu_fonction.addEventListener('change', function() {if (this.checked) {inclu_fonction.checked = false;}});

    inclu_form_juridique.addEventListener('change', function() {if (this.checked) {exclu_form_juridique.checked = false;}});
    exclu_form_juridique.addEventListener('change', function() {if (this.checked) {inclu_form_juridique.checked = false;}});

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

        //Fonction des fichiers input ville pays cp

        // my input
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

        $('#input_naf').on("change", function(){
            // FormData permet d'envoyer des fichiers avec AJAX
            const formData4 = new FormData();

            // Récupérer le fichier sélectionné
            const file = $(this)[0].files[0];

            // Ajouter le fichier au FormData
            formData4.append('input_naf', file);
            $.ajax ({
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

        $('#input_form_juridique').on("change", function(){
            // FormData permet d'envoyer des fichiers avec AJAX
            const formData5 = new FormData();

            // Récupérer le fichier sélectionné
            const file = $(this)[0].files[0];

            // Ajouter le fichier au FormData
            formData5.append('input_form_juridique', file);
            $.ajax ({
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

	function ajaxRequest() {
		$.ajax ({
		    url: "count_b2b.php",
		    type: "post",
		    data: $("#form_search_db").serialize(),
		    complete: function (xhr, result) {
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

<?php require("../../footer.php"); ?>
