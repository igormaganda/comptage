<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>
<?php

//require_once("../../sdatamart/lib/system_load.php");
//user Authentication.
//authenticate_user('all');
//Pour débguer le code
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

    require("partials/class/Bdd.php"); 
	require_once("partials/class/Calc.php");
	require_once("partials/class/UploadNew.php");

	$bdd    = new Bdd();
	$calc   = new Calc();
	$upload = new Upload($_POST, $_FILES['csv']);

	if(isset($_POST["insert"])) $upload->uploadFile(0);
	if(isset($_POST["update"])) $upload->uploadFile(1);
	if(isset($_POST["comparaison"])) $upload->uploadFile(2);
	if(isset($_POST["nettoyage"])) $upload->uploadFile(3);
?>


<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Dashboard')); ?>

    <!-- jsvectormap css -->
    
<!--datatable css-->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css" >
    <!--datatable responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.bootstrap.min.css" >

    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">

    <?php include 'partials/head-css.php'; ?>
    <style>
    .requete_count td {
        word-wrap: break-word; /* ou overflow-wrap: break-word; */
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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Recherche', 'title' => 'Liste des recherches')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="widget">
                                        <div class="widget-body innerAll inner-2x">
                                        <form method="POST" action="file3.php" id="form_validation" style="padding-bottom: 50px">
                                                <?php echo $upload->msg["upload"]; ?>
                                                <hr /><br />

                                                <?php if (isset($_POST["insert"])) { ?>
                                                    <label class="form-check-input-label"> 
                                                        <input type="checkbox" class="form-check-input" name="exclureFirstLine" value="yes">
                                                        <i class="fa fa-fw fa-square-o"></i> Exclure la première ligne
                                                    </label><br />

                                                    <?php if ($_POST["b2b-b2c"] == "b2c") { ?>
                                                        <div class="widget-body center" id="filetype">
                                                            <label for="programme" class="form-label">Programme</label>
                                                            <select name="programme" class="form-select input-lg m-2" id="programme">
                                                            <?php
                                                                $bdd = new Bdd();

                                                                $requete = "SELECT
                                                                                gestion_programme.id,
                                                                                gestion_programme.nom,
                                                                                gestion_partenaire.nom AS partenaire
                                                                            FROM
                                                                                gestion_programme,
                                                                                gestion_partenaire
                                                                            WHERE gestion_programme.partenaire = gestion_partenaire.id
                                                                            ORDER BY gestion_programme.id ASC";
                                                                $result = $bdd->executeQueryRequete($requete, 1);

                                                                while( $items = $result->fetch() ) {
                                                                    echo '<option value="'.$items->id.'">'.$items->nom.' ('.$items->partenaire.')</option>';
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>

                                                        <?php
                                                            $requete = "SELECT id, Nom, Alias FROM gestion_thematique ORDER BY id ASC";
                                                            $result = $bdd->executeQueryRequete($requete, 1);
                                                            echo '<div class="row m-1">';
                                                            if (isset($thematiques)) {
                                                                $themes = explode(",", $thematiques);

                                                                while( $items = $result->fetch() ) {
                                                                    $is = false;

                                                                    foreach ($themes as $value) {
                                                                        if( $items->alias == $value ) {
                                                                            $is = true;
                                                                        }
                                                                    }

                                                                    if( $is ) {
                                                                        echo '<div class="col-md-3"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="thematiques[]" value="'.$items->id.'" checked="checked">
                                                                        <i class="fa fa-fw fa-square-o checked"></i>'.$items->nom.'</label></div></div>';
                                                                    } else {
                                                                        echo '<div class="col-md-3"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="thematiques[]" value="'.$items->id.'">
                                                                        <i class="fa fa-fw fa-square-o"></i>'.$items->nom.'</label></div></div>';
                                                                    }
                                                                }
                                                            } else {
                                                                while( $items = $result->fetch() ) {
                                                                    echo '<div class="col-md-3"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="thematiques[]" value="'.$items->id.'">
                                                                        <i class="fa fa-fw fa-square-o"></i>'.$items->nom.'</label></div></div>';
                                                                }
                                                            }
                                                            echo'</div>';
                                                        ?>
                                                    <?php } ?>

                                                    <?php if ($_POST["b2b-b2c"] == "b2b") { ?>
                                                        <div class="widget-body center" id="filetype">
                                                            <label for="pays">Pays </label>
                                                            <select name="pays" class="form-select input-lg " id="pays">
                                                                <option value="Null">Sélectionnez un pays</option>
                                                                <option value="AL">Albanie</option>
                                                                <option value="DE">Allemagne</option>
                                                                <option value="AD">Andorre</option>
                                                                <option value="AT">Autriche</option>
                                                                <option value="BY">Biélorussie</option>
                                                                <option value="BE">Belgique</option>
                                                                <option value="BA">Bosnie-Herzégovine</option>
                                                                <option value="BG">Bulgarie</option>
                                                                <option value="HR">Croatie</option>
                                                                <option value="DK">Danemark</option>
                                                                <option value="ES">Espagne</option>
                                                                <option value="EE">Estonie</option>
                                                                <option value="FI">Finlande</option>
                                                                <option value="FR">France</option>
                                                                <option value="GR">Grèce</option>
                                                                <option value="HU">Hongrie</option>
                                                                <option value="IE">Irlande</option>
                                                                <option value="IS">Islande</option>
                                                                <option value="IT">Italie</option>
                                                                <option value="XK">Kosovo</option>
                                                                <option value="LV">Lettonie</option>
                                                                <option value="LI">Liechtenstein</option>
                                                                <option value="LT">Lituanie</option>
                                                                <option value="LU">Luxembourg</option>
                                                                <option value="MK">Macédoine du Nord</option>
                                                                <option value="MT">Malte</option>
                                                                <option value="MD">Moldavie</option>
                                                                <option value="MC">Monaco</option>
                                                                <option value="ME">Monténégro</option>
                                                                <option value="NO">Norvège</option>
                                                                <option value="NL">Pays-Bas</option>
                                                                <option value="PL">Pologne</option>
                                                                <option value="PT">Portugal</option>
                                                                <option value="RO">Roumanie</option>
                                                                <option value="GB">Royaume-Uni</option>
                                                                <option value="RU">Russie</option>
                                                                <option value="SM">Saint-Marin</option>
                                                                <option value="RS">Serbie</option>
                                                                <option value="SK">Slovaquie</option>
                                                                <option value="SI">Slovénie</option>
                                                                <option value="SE">Suède</option>
                                                                <option value="CH">Suisse</option>
                                                                <option value="CZ">République tchèque</option>
                                                                <option value="UA">Ukraine</option>
                                                                <option value="VA">Cité du Vatican</option>

                                                            </select>
                                                            <label for="programme">Programme</label>
                                                            <select name="programme" class="form-select input-lg" id="programme">
                                                                <?php
                                                                $bdd = new Bdd();

                                                                $requete = "SELECT
                                                                                gestion_programme.id,
                                                                                gestion_programme.nom,
                                                                                gestion_partenaire.nom AS partenaire
                                                                            FROM
                                                                                gestion_programme,
                                                                                gestion_partenaire
                                                                            WHERE gestion_programme.partenaire = gestion_partenaire.id
                                                                            ORDER BY gestion_programme.id ASC";
                                                                $result = $bdd->executeQueryRequete($requete, 1);

                                                                while( $items = $result->fetch() ) {
                                                                    echo '<option value="'.$items->id.'">'.$items->nom.' ('.$items->partenaire.')</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <?php
                                                        $requete = "SELECT id, Nom, Alias FROM gestion_thematique ORDER BY id ASC";
                                                        $result = $bdd->executeQueryRequete($requete, 1);
                                                        
                                                        echo '<div class="row">';
                                                        if (isset($thematiques)) {
                                                            $themes = explode(",", $thematiques);

                                                            while( $items = $result->fetch() ) {
                                                                $is = false;

                                                                foreach ($themes as $value) {
                                                                    if( $items->alias == $value ) {
                                                                        $is = true;
                                                                    }
                                                                }

                                                                if( $is ) {
                                                                    echo '<div class="col-md-3"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="thematiques[]" value="'.$items->id.'" checked="checked">
                                                                        <i class="fa fa-fw fa-square-o checked"></i>'.$items->nom.'</label></div></div>';
                                                                } else {
                                                                    echo '<div class="col-md-3"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="thematiques[]" value="'.$items->id.'">
                                                                        <i class="fa fa-fw fa-square-o"></i>'.$items->nom.'</label></div></div>';
                                                                }
                                                            }
                                                        } else {
                                                            while( $items = $result->fetch() ) {
                                                                echo '<div class="col-md-3"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="thematiques[]" value="'.$items->id.'">
                                                                        <i class="fa fa-fw fa-square-o"></i>'.$items->nom.'</label></div></div>';
                                                            }
                                                        }
                                                        echo '</div>';
                                                        ?>
                                                    <?php } ?>
                                                <?php } ?>



                                                <?php if (isset($_POST["update"])) { ?>
                                                    <?php if ($_POST["b2b-b2c"] == "b2c") { ?>
                                                        <table id="update_oc">
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox">
                                                                        <label class="checkbox-custom"> 
                                                                            <input type="checkbox" class="form-check-input"  name="ouvreurs" value="yes">
                                                                            <i class="fa fa-fw fa-square-o"></i> Ouvreurs.
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="checkbox">
                                                                        <label class="checkbox-custom"> 
                                                                            <input type="checkbox" class="form-check-input"  name="cliqueurs" value="yes">
                                                                            <i class="fa fa-fw fa-square-o"></i> Cliqueurs.
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                        <?php
                                                            $requete = "SELECT id, Nom, Alias FROM gestion_thematique ORDER BY id ASC";
                                                            $result = $bdd->executeQueryRequete($requete, 1);
                                                            
                                                            echo '<div class="row">';
                                                            if (isset($thematiques)) {
                                                                $themes = explode(",", $thematiques);

                                                                while( $items = $result->fetch() ) {
                                                                    $is = false;

                                                                    foreach ($themes as $value) {
                                                                        if( $items->alias == $value ) {
                                                                            $is = true;
                                                                        }
                                                                    }

                                                                    if( $is ) {
                                                                        echo '<div class="col-md-3"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="thematiques[]" value="'.$items->id.'" checked="checked">
                                                                        <i class="fa fa-fw fa-square-o checked"></i>'.$items->nom.'</label></div></div>';
                                                                    } else {
                                                                        echo '<div class="col-md-3"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="thematiques[]" value="'.$items->id.'">
                                                                        <i class="fa fa-fw fa-square-o"></i>'.$items->nom.'</label></div></div>';
                                                                    }
                                                                }
                                                            } else {
                                                                while( $items = $result->fetch() ) {
                                                                    echo '<div class="col-md-3"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input" name="thematiques[]" value="'.$items->id.'">
                                                                        <i class="fa fa-fw fa-square-o"></i>'.$items->nom.'</label></div></div>';
                                                                }
                                                            }
                                                            echo '</div>';
                                                        ?>
                                                    <?php } ?>

                                                    <?php if ($_POST["b2b-b2c"] == "b2b") { ?>

                                                        <table id="update_oc">
                                                            <tr>
                                                                <td>
                                                                    <div class="checkbox">
                                                                        <label class="checkbox-custom">
                                                                            <input type="checkbox" class="form-check-input"  name="ouvreurs" value="yes">
                                                                            <i class="fa fa-fw fa-square-o"></i> Ouvreurs.
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="checkbox">
                                                                        <label class="checkbox-custom">
                                                                            <input type="checkbox"  class="form-check-input" name="cliqueurs" value="yes">
                                                                            <i class="fa fa-fw fa-square-o"></i> Cliqueurs.
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                        <?php
                                                        $requete = "SELECT id, Nom, Alias FROM gestion_thematique ORDER BY id ASC";
                                                        $result = $bdd->executeQueryRequete($requete, 1);

                                                        echo '<div class="row">';
                                                        if (isset($thematiques)) {
                                                            $themes = explode(",", $thematiques);

                                                            while( $items = $result->fetch() ) {
                                                                $is = false;

                                                                foreach ($themes as $value) {
                                                                    if( $items->alias == $value ) {
                                                                        $is = true;
                                                                    }
                                                                }
                                                                if( $is ) {
                                                                    echo '<div class="col-md-3"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="thematiques[]" value="'.$items->id.'" checked="checked">
                                                                        <i class="fa fa-fw fa-square-o checked"></i>'.$items->nom.'</label></div></div>';
                                                                } else {
                                                                    echo '<div class="col-md-3"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="thematiques[]" value="'.$items->id.'">
                                                                        <i class="fa fa-fw fa-square-o"></i>'.$items->nom.'</label></div></div>';
                                                                }
                                                            }
                                                        } else {
                                                            while( $items = $result->fetch() ) {
                                                                echo '<div class="col-md-3"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="thematiques[]" value="'.$items->id.'">
                                                                        <i class="fa fa-fw fa-square-o"></i>'.$items->nom.'</label></div></div>';
                                                            }
                                                        }
                                                        echo '</div>';
                                                        ?>
                                                        <!--<label class="checkbox-custom">
                                                            <input type="checkbox" name="dirigeants" value="yes">
                                                            <i class="fa fa-fw fa-square-o"></i> Fichier de dirigeants
                                                        </label>

                                                        <input class="form-control" type="text" name="categorie" placeholder="Renseigner des catégories (cat1, cat2, cat3...)"><br />-->
                                                    <?php } ?>
                                                <?php } ?>


                                                <?php if (isset($_POST["comparaison"])) { ?>
                                                    <table id="comparaison_partenaire_programme">
                                                        <tr>
                                                            <td class="largeur">
                                                                <label for="comp_partenaire">Contenu des fichiers</label>
                                                                <div class="radio">
                                                                    <label class="radio-custom">
                                                                        <input type="radio" class="form-check-input" name="download" value="0" checked="checked">
                                                                        <i class="fa fa-circle-o checked"></i> Tous les champs
                                                                    </label>
                                                                </div>
                                                                <div class="radio">
                                                                    <label class="radio-custom">
                                                                        <input type="radio" class="form-check-input" name="download" value="1">
                                                                        <i class="fa fa-circle-o"></i> Email seulement
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                            <td class="largeur">
                                                                <label for="comp_programme">Enrichir le(s) champ(s)</label>
                                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" class="form-check-input"  name="enrichies[]" value="dateofbirth">
                                                                    <i class="fa fa-fw fa-square-o"></i> DOB
                                                                </label>
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" class="form-check-input"  name="enrichies[]" value="pays">
                                                                    <i class="fa fa-fw fa-square-o"></i> Pays
                                                                </label>
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" class="form-check-input"  name="enrichies[]" value="cp">
                                                                    <i class="fa fa-fw fa-square-o"></i> Code postal
                                                                </label>
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" class="form-check-input"  name="enrichies[]" value="ville">
                                                                    <i class="fa fa-fw fa-square-o"></i> Ville
                                                                </label>
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" class="form-check-input"  name="enrichies[]" value="gender">
                                                                    <i class="fa fa-fw fa-square-o"></i> Civilité
                                                                </label>
                                                                <label class="checkbox-custom">
                                                                    <input type="checkbox" class="form-check-input"  name="enrichies[]" value="tel_mobile">
                                                                    <i class="fa fa-fw fa-square-o"></i> Tél mobile
                                                                </label>

                                                            </div>
                                                                <div></div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <!--<div class="radio">
                                                        <label class="radio-custom">
                                                            <input type="radio" class="form-check-input" name="download" value="0" checked="checked"> 
                                                            <i class="fa fa-circle-o checked"></i> Tous les champs
                                                        </label> 
                                                    </div> 
                                                    <div class="radio"> 
                                                        <label class="radio-custom"> 
                                                            <input type="radio" class="form-check-input" name="download" value="1"> 
                                                            <i class="fa fa-circle-o"></i> Email seulement
                                                        </label> 
                                                    </div>-->


                                                    <?php if ($_POST["b2b-b2c"] == "b2c") { ?>
                                                        <table id="comparaison_partenaire_programme">
                                                            <tr>
                                                                <td class="largeur">
                                                                    <label for="comp_partenaire">Comparer avec un partenaire</label>
                                                                    <select name="comp_partenaire" class="form-control input-lg" id="comp_partenaire" required>
                                                                        <option value="null"></option>
                                                                    <?php
                                                                        $requete = "SELECT id, nom FROM gestion_partenaire ORDER BY id ASC";
                                                                        $result = $bdd->executeQueryRequete($requete, 1);

                                                                        while( $items = $result->fetch() ) {
                                                                            echo '<option value="'.$items->id.'">'.$items->nom.'</option>';
                                                                        }
                                                                    ?>
                                                                    </select>
                                                                </td>
                                                                <td></td>
                                                                <td class="largeur">
                                                                    <label for="comp_programme">Comparer avec un programme</label>
                                                                    <select name="comp_programme" class="form-control input-lg" id="comp_programme" required>
                                                                        <option value="null"></option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php } ?>
                                <!--
                                                    <h5>Matching</h5>
                                                    <select name="matching" class="form-control input-lg" id="matching_field" required>
                                                        <option value="null"></option>
                                                    </select>
                                -->
                                                <?php } ?>



                                                <?php if (isset($_POST["nettoyage"])) { ?>
                                                    <table id="nettoyage">
                                                        <tr>
                                                            <td>
                                                                <div class="checkbox">
                                                                    <label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="filtre_invalide" value="1" checked="checked">
                                                                        <i class="fa fa-fw fa-square-o"></i> Emails invalides
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="checkbox">
                                                                    <label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="filtre_interdit" value="1" checked="checked">
                                                                        <i class="fa fa-fw fa-square-o"></i> Keywords interdits
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="checkbox">
                                                                    <label class="checkbox-custom"> 
                                                                        <input type="checkbox" class="form-check-input"  name="filtre_doublon" value="1" checked="checked">
                                                                        <i class="fa fa-fw fa-square-o"></i> Doublons
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="checkbox">
                                                                    <label class="checkbox-custom"> 
                                                                        <input type="checkbox" name="filtre_blacklist" value="1" checked="checked">
                                                                        <i class="fa fa-fw fa-square-o"></i> Blacklist
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <div class="checkbox">
                                                                    <label class="checkbox-custom"> 
                                                                        <input type="checkbox" name="filtre_caracteres" value="1" checked="checked">
                                                                        <i class="fa fa-fw fa-square-o"></i> Moins de <?php echo $calc->info("lettres"); ?> caractères
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="checkbox">
                                                                    <label class="checkbox-custom"> 
                                                                        <input type="checkbox" name="filtre_nombres" value="1" checked="checked">
                                                                        <i class="fa fa-fw fa-square-o"></i> Plus de <?php echo $calc->info("chiffres"); ?> chiffres
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table><br /><hr /><br />

                                                    <h5>Nombre d'occurences</h5>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text" name="inter-min" placeholder="Minimum" style="text-align:right;">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text" name="inter-max" placeholder="Maximum">
                                                    </div><br /><hr /><br />
                                                <?php } ?>


                                                <br />
                                                <?php echo $upload->msg["form"]; ?>

                                                <div id="input_search_submit">
                                                    <input type="submit" value="Valider" class="btn btn-info" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script type="text/javascript">
	$(document).ready(function() {
		printPart();

		$("#comp_partenaire option").click(function() {
			var data = { partenaire : $(this).val() };

			if ($(this).val() != "null") {
				$.ajax ({
				    url: "../controller/returnProgrammes.php",
				    type: "post",
				    data: data,
				    complete: function (xhr, result) {
				        if (result == "success") {
							var obj = jQuery.parseJSON( xhr.responseText );
							var result = "";

							$(obj).each(function(index) {
								result += '<option class="prog-tmp" value="'+obj[index].id+'">'+obj[index].nom+'</option>';
							});

							$(".prog-tmp").remove();
							$("#comp_programme").append(result);
				        }
				    }
				});
			}
		});

		$("#b2").change(function() {
			printPart();
		});

		$("#form_champs select.form-select").change(function() {
			$("#matching_field").append('<option value="'+$(this).val()+'">'+$(this).val()+'</option>');
		});
	});

	function printPart() {
		if ($("#b2_input").val() == 'b2b') {
			$("#comparaison_partenaire_programme").css("display", "none");
			$("#comparaison_partenaire_programme select option").removeAttr("selected");
		} else {
			$("#comparaison_partenaire_programme").css("display", "table");
		}
	}
</script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>