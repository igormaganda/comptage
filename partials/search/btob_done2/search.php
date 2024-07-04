<?php
$odometer = 1;
$map = 1;

require_once("../../../sdatamart/lib/system_load.php");
//user Authentication.
authenticate_user('all');
require("../../header.php");
require("partials/class/Bdd.php");

$bdd = new Bdd();
?>

    <div id="content">
        <div class="widget" id="search_content">
            <div class="widget-body innerAll inner-2x">
                <form method="POST" action="search_a.php" name="form_search_db" id="form_search_db">
                    <div class="widget-head">
                        <h4 class="heading glyphicons search"><i></i>Nom de la recherche</h4>
                    </div>

                    <div class="widget-body">
                        <input name="name" type="text" id="search_name" class="form-control input-lg" placeholder="Nom">
                    </div>

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

                    <div class="widget-head">
                        <h4 class="heading glyphicons calendar"><i></i>CRITERES DE POSTES</h4>
                        <!--<span class="badge badge-info" id="search-add"><i class="fa fa-plus"></i></span>-->
                    </div>

                    <div class="widget-body" id="dates">
                        <table class="search_date">
                            <tr>
                                <div class="widget-body">
                                    <div class="col-sm-12">
                                        <h5>Saisir une ou plusieurs fonctions / copier-coller une liste de fonctions</h5>
                                        <input type="hidden" id="activity" name="activity" class="multiinput" style="width: 90%;" />
                                    </div>
                                </div>

                            </tr>
                        </table>
                        <table class="search_date">
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
                        </table>

                    </div>

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
                                <td>
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
                                    <input type="hidden" id="autre_pays" name="autre_pays" class="multiinput" style="width: 90%; height:20%" />
                                </td>
                                <td>
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

                                </td>
                            </tr>
                        </table>
                    </div>



                    <div class="widget-head">
                        <h4 class="heading glyphicons beer"><i></i>Centres de segmentation</h4>
                    </div>
                    <div class="widget-body" id="dates">
                        <table class="search_date">
                            <tr>
                                <div class="widget-body">
                                    <div class="col-sm-6">
                                        <h5>NAF</h5>
                                        <input type="hidden" id="naf" name="naf" class="multiinput" style="width: 90%;" />
                                    </div>

                                    <div class="col-sm-6">
                                        <h5>Forme juridique</h5>
                                        <input type="hidden" id="forme_juridique" name="forme_juridique" class="multiinput" style="width: 90%;" />
                                    </div>
                                </div>

                            </tr>
                        </table>

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
                                                                    <input type="checkbox" name="institution[]" value="1">
                                                                    <i class="fa fa-fw fa-square-o"></i> Députés
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="institution[]" value="2">
                                                                    <i class="fa fa-fw fa-square-o"></i> Sénateurs
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            //
                                                        </td>
                                                        <td style="width: 25%;">
                                                            //
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </div>
                                </div>
                            </div>

                        </div>

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
                                                                    <input type="checkbox" name="effectif[]" value="1">
                                                                    <i class="fa fa-fw fa-square-o"></i> Unités non employeuses
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="effectif[]" value="2">
                                                                    <i class="fa fa-fw fa-square-o"></i> 0 salarié
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="effectif[]" value="3">
                                                                    <i class="fa fa-fw fa-square-o"></i> 1 ou 2 salariés
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="effectif[]" value="4">type
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
                                                                    <input type="checkbox" name="effectif[]" value="4">
                                                                    <i class="fa fa-fw fa-square-o"></i> 6 à 9 salariés
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="effectif[]" value="1">
                                                                    <i class="fa fa-fw fa-square-o"></i> 10 à 19 salariés
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="effectif[]" value="2">
                                                                    <i class="fa fa-fw fa-square-o"></i> 20 à 24 salariés
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="effectif[]" value="2">
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
                                                                    <input type="checkbox" name="effectif[]" value="2">
                                                                    <i class="fa fa-fw fa-square-o"></i> 100 à 199 salariés
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="effectif[]" value="2">
                                                                    <i class="fa fa-fw fa-square-o"></i> 200 à 249 salariés
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="effectif[]" value="1">
                                                                    <i class="fa fa-fw fa-square-o"></i> 250 à 499 salariés
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="effectif[]" value="2">
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
                                                                    <input type="checkbox" name="effectif[]" value="2">
                                                                    <i class="fa fa-fw fa-square-o"></i> 1000 à 1999 salariés
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="effectif[]" value="2">
                                                                    <i class="fa fa-fw fa-square-o"></i> 2000 à 4999 salariés
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="effectif[]" value="2">
                                                                    <i class="fa fa-fw fa-square-o"></i> 5000 à 9999 salariés
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="effectif[]" value="2">
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
                                                                    <input type="checkbox" name="ca[]" value="1">
                                                                    <i class="fa fa-fw fa-square-o"></i> Moins de 0.5 million d'€
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="ca[]" value="2">
                                                                    <i class="fa fa-fw fa-square-o"></i> De 0.5 à moins de 1 million d'€
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="ca[]" value="3">
                                                                    <i class="fa fa-fw fa-square-o"></i> De 1 million à moins de 2 million d'€
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="ca[]" value="4">
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
                                                                    <input type="checkbox" name="ca[]" value="4">
                                                                    <i class="fa fa-fw fa-square-o"></i> De 5 millions à moins de 10 millions d'€
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="ca[]" value="1">
                                                                    <i class="fa fa-fw fa-square-o"></i> De 10 millions à moins de 20 millions d'€
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="ca[]" value="2">
                                                                    <i class="fa fa-fw fa-square-o"></i> De 20 millions à moins de 50 millions d'€
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="ca[]" value="2">
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
                                                                    <input type="checkbox" name="ca[]" value="2">
                                                                    <i class="fa fa-fw fa-square-o"></i> De 100 millions à moins de 200 millions d'€
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="ca[]" value="2">
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

                        <div class="widget-body">
                            <div class="checkbox">
                                <h5>Date de création</h5>
                            </div>

                            <input name="occurrence" type="hidden" id="occurrence">

                            <div class="widget widget-heading-simple widget-body-gray">
                                <div class="widget-body" id="occurrence-slider">
                                    <div class="slider-range-min row form-horizontal">
                                        <div id="search-date-ins">
                                            <div class="col-sm-4 search-txt">Plage de la date de création</div>

                                            <div class="col-sm-6">
                                                <input name="date1-ins" type="text" id="date1-ins" class="form-control input-lg search-date" placeholder="Sélectionner une plage de la plage de date de création...">
                                            </div>
                                            <div class="col-sm-1 search-txt none-ins">et</div>
                                            <div class="col-sm-2 none-ins">
                                                <input name="date2-ins" type="text" id="date2-ins" class="form-control input-lg search-date" placeholder="Date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                                                    <input type="checkbox" name="type_ets[]" value="1">
                                                                    <i class="fa fa-fw fa-square-o"></i> Sièges sociaux
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <div class="checkbox">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" name="type_ets[]" value="2">
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

<!--                        <div class="widget-body" id="dates">-->
<!--                            <table class="search_date">-->
<!--                                <tr>-->
<!--                                    <div class="widget-body">-->
<!--                                        <div class="col-sm-12">-->
<!--                                            <h5>Conventions collectives</h5>-->
<!--                                            <select name="partenaire" class="form-control input-lg" id="partenaire">-->
<!--                                                <option value=""></option>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </tr>-->
<!--                            </table>-->
<!--                        </div>-->



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

                            <input name="occurrence" type="hidden" id="occurrence">

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
                            </div>

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

                                        <input type="hidden" id="autre_domaines_inclu" name="autre_domaines_inclu" class="multiinput" style="width: 90%;" />
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
        $(window).load(function() {
            $("#age_min").val($("div#rangeSlider div.ui-rangeSlider-leftLabel div.ui-rangeSlider-label-value").text());
            $("#age_max").val($("div#rangeSlider div.ui-rangeSlider-rightLabel div.ui-rangeSlider-label-value").text());
        });

        $(document).ready(function() {
            $("")








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

            $('input[type = hidden]').on("change", function(){
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
                    alert(xhr.responseText.split("|"))
                    $("#requete-count p").html(print[0]);
                    var odometer = parseInt(print[1])
                    $(".odometer").html(parseInt(print[1]));
                    alert("mon comptage: "+ odometer)
                }
            });
        }
    </script>

<?php require_once("../../footer.php"); ?>