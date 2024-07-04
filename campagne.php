<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php
// require_once("../../sdatamart/lib/system_load.php");
// //user Authentication.
// authenticate_user('all');

$campagne = true;
$display = true;

require_once("partials/class/Bdd.php");

if (isset($_GET["edit"]) || isset($_GET["id"])) {
	if (isset($_GET["edit"])) {
		$requete = "SELECT b2, type_base, repasse, programme, client, campagne, annonceur, sujet, expediteur, txt, content, miroir, desabo FROM campagne WHERE id=" . $_GET["edit"];
	} else {
		$requete = "SELECT b2, type_base, repasse, programme, client, campagne, annonceur, sujet, expediteur, txt, content, miroir, desabo FROM campagne_tmp WHERE id=" . $_GET["id"];
	}

	$bdd = new Bdd();

	$result = $bdd->executeQueryRequete($requete, 1);

	while ($data = $result->fetch()) {
		$b2         = $data->b2;
		$type_base  = $data->type_base;
		$repasse    = $data->repasse;
		$programme  = $data->programme;
		$client     = $data->client;
		$campain    = $data->campagne;
		$annonceur  = $data->annonceur;
		$sujet      = $data->sujet;
		$expediteur = $data->expediteur;
		$txt        = $data->txt;
		$content    = $data->content;
		$miroir     = $data->miroir;
		$desabo     = $data->desabo;
	}
}
?>

<head>
    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Campagne')); ?>

    <link rel="stylesheet" href="assets/libs/nouislider/nouislider.min.css">
    <!-- Sweet Alert css-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- dropzone css -->
    <link href="assets/libs/dropzone/dropzone.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="assets/libs/multi.js/multi.min.css">
    <!-- autocomplete css -->
    <link rel="stylesheet" href="assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css">


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Campagne', 'title' => 'Creation d\'envois')); ?>
                            </div>
                            <!--end col-->
                            <div class="col-md-auto ms-auto">
                                <?php include 'partials/customizer.php'; ?>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <form method="POST" action="campagne_a.php" name="form_campagne" id="form_campagne" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-xxl-3  text-center">
                                <div class="card p-3 h-100">
                                    <?php
                                    if (!isset($_GET["copie"])) {
                                        if (isset($_GET["edit"])) {
                                            echo '<input type="hidden" name="action" id="action" value="edit">';
                                            echo '<input type="hidden" name="id" value="' . $_GET["edit"] . '">';
                                        } elseif (isset($_GET["cmp"])) {
                                            echo '<input type="hidden" name="action" id="action" value="back">';
                                            echo '<input type="hidden" name="id" value="' . $_GET["id"] . '">';
                                        } else {
                                            echo '<input type="hidden" name="action" id="action" value="new">';
                                        }
                                    } else {
                                        echo '<input type="hidden" name="action" id="action" value="new">';
                                    }
                                    ?>

                                    <div class="widget-body" id="repasse_bloc">
                                        <select name="type_base" class="form-select input-lg border-2 mb-2" id="type_base">
                                            <?php if (isset($type_base)) {
                                                switch ($type_base) {
                                                    case 'interne':
                                                        echo '
                                                            <option value="">Type de base</option>
                                                            <option value="interne" selected>Interne</option>
                                                            <option value="comptage">Comptage</option>
                                                            <option value="repasse">Repasse</option>
                                                            <option value="marc">Marc</option>';
                                                        break;

                                                    case 'comptage':
                                                        echo '
                                                            <option value="">Type de base</option>
                                                            <option value="interne">Interne</option>
                                                            <option value="comptage" selected>Comptage</option>
                                                            <option value="repasse">Repasse</option>
                                                            <option value="marc">Marc</option>';
                                                        break;

                                                    case 'repasse':
                                                        echo '
                                                            <option value="">Type de base</option>
                                                            <option value="interne">Interne</option>
                                                            <option value="comptage">Comptage</option>
                                                            <option value="repasse" selected>Repasse</option>
                                                            <option value="marc">Marc</option>';
                                                        break;

                                                    case 'marc':
                                                        echo '
                                                            <option value="">Type de base</option>
                                                            <option value="interne">Interne</option>
                                                            <option value="comptage">Comptage</option>
                                                            <option value="repasse">Repasse</option>
                                                            <option value="marc" selected>Marc</option>';
                                                        break;

                                                    default:
                                                        echo '
                                                            <option value="" selected>Type de base</option>
                                                            <option value="interne" selected>Interne</option>
                                                            <option value="comptage">Comptage</option>
                                                            <option value="repasse">Repasse</option>
                                                            <option value="marc">Marc</option>';
                                                        break;
                                                }
                                                echo ' value="' . $type_base . '"';
                                            } else {
                                                echo '
                                                    <option value="">Type de base</option>
                                                    <option value="interne">Interne</option>
                                                    <option value="comptage">Comptage</option>
                                                    <option value="repasse">Repasse</option>
                                                    <option value="marc">Marc</option>';
                                            } ?>
                                        </select>
                                    </div>

                                    <div class="widget-body repasse_option" id="repasse_bloc" style="display:none;">
                                        <select name="repasse" class="form-select input-lg border-2 mb-2" id="repasse">
                                            <option value="">Repasse</option>
                                            <option value="non_ouvreurs">Non ouvreurs</option>
                                            <option value="non_convertis">Non convertis</option>
                                        </select>
                                    </div>

                                    <div class="widget-body">
                                        <div id="b2" class="btn-group m-3" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" name="b2b-b2c" id="btnradio1" value="b2c" checked>
                                            <label class="btn btn-outline-secondary mb-0" for="btnradio1">B2C</label>

                                            <input type="radio" class="btn-check" name="b2b-b2c" id="btnradio2" value="b2b">
                                            <label class="btn btn-outline-primary mb-0" for="btnradio2">B2B</label>
                                        </div>
                                    </div>

                                    <div class="widget-body">
                                        <select name="programme" class="form-select input-lg border-2 mb-2">
                                            <option value="">Programme</option>
                                            <?php
                                            $bdd = new Bdd();

                                            $requete = "SELECT Nom, Alias FROM gestion_programme ORDER BY id ASC";
                                            $result = $bdd->executeQueryRequete($requete, 1);

                                            while ($items = $result->fetch()) {
                                                if (isset($programme)) {
                                                    if ($items->alias == $programme) {
                                                        echo '<option value="' . $items->alias . '" selected>' . $items->nom . '</option>';
                                                    } else {
                                                        echo '<option value="' . $items->alias . '">' . $items->nom . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="' . $items->alias . '">' . $items->nom . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="widget-body">
                                        <input name="client" type="text" class="form-control input-lg border-2 mb-2" placeholder="Client" <?php if (isset($client)) {
                                                                                                                                                echo ' value="' . $client . '"';
                                                                                                                                            } ?>>
                                    </div>

                                    <div class="widget-body">
                                        <input name="campagne" type="text" class="form-control input-lg border-2 mb-2" placeholder="Nom de campagne" <?php if (isset($campain)) {
                                                                                                                                                            echo ' value="' . $campain . '"';
                                                                                                                                                        } ?>>
                                    </div>

                                    <div class="widget-body">
                                        <input name="annonceur" type="text" class="form-control input-lg border-2 mb-2" placeholder="Annonceur" <?php if (isset($annonceur)) {
                                                                                                                                                    echo ' value="' . $annonceur . '"';
                                                                                                                                                } ?>>
                                    </div>

                                    <div class="widget-body">
                                        <input name="sujet" type="text" class="form-control input-lg border-2 mb-2" placeholder="Sujet" <?php if (isset($sujet)) {
                                                                                                                                            echo ' value="' . $sujet . '"';
                                                                                                                                        } ?>>
                                    </div>

                                    <div class="widget-body">
                                        <input name="expediteur" type="text" class="form-control input-lg border-2 mb-2" placeholder="Expéditeur" <?php if (isset($expediteur)) {
                                                                                                                                                        echo ' value="' . $expediteur . '"';
                                                                                                                                                    } ?>>
                                    </div>

                                    <div class="widget-body h-100">
                                        <textarea name="txt-brut" class="form-control border-2 mb-2" rows="6" placeholder="Texte brut"><?php if (isset($txt)) {
                                                                                                                                            echo trim($txt);
                                                                                                                                        } ?></textarea>

                                    </div>

                                </div><!-- end card -->

                            </div>

                            <div class="col-xxl-9">
                                <div class="card p-3 h-100">
                                    <div class=" widget-body">
                                        <div class="checkbox">
                                            <label class="checkbox-custom m-2">
                                                <?php
                                                if (isset($_GET["edit"]) || isset($_GET["id"])) {
                                                    if (isset($miroir) && $miroir == TRUE) {
                                                        echo '<input type="checkbox" name="miroir" value="yes" checked="checked">';
                                                        echo '<i class="fa fa-fw fa-square-o checked"></i>';
                                                    } else {
                                                        echo '<input type="checkbox" name="miroir" value="yes">';
                                                        echo '<i class="fa fa-fw fa-square-o"></i>';
                                                    }
                                                } else {
                                                    echo '<input type="checkbox" name="miroir" value="yes" checked="checked">';
                                                    echo '<i class="fa fa-fw fa-square-o checked"></i>';
                                                }
                                                ?>
                                                Ajouter le lien miroir en en-tête.
                                            </label>
                                        </div>
                                        <div class="checkbox mb-2">
                                            <label class="checkbox-custom m-2">
                                                <?php
                                                if (isset($_GET["edit"]) || isset($_GET["id"])) {
                                                    if (isset($desabo) && $desabo == TRUE) {
                                                        echo '<input type="checkbox" name="desabo" value="yes" checked="checked">';
                                                        echo '<i class="fa fa-fw fa-square-o checked"></i>';
                                                    } else {
                                                        echo '<input type="checkbox" name="desabo" value="yes">';
                                                        echo '<i class="fa fa-fw fa-square-o"></i>';
                                                    }
                                                } else {
                                                    echo '<input type="checkbox" name="desabo" value="yes" checked="checked">';
                                                    echo '<i class="fa fa-fw fa-square-o checked"></i>';
                                                }
                                                ?>
                                                Ajouter le lien de désabonnement en pied de page.
                                            </label>
                                        </div>

                                        <div class="m-2 h-100" id="container">
                                            <textarea name="content" id="editor" class="form-control"><?php if (isset($content)) {
                                                                                                            echo trim($content);
                                                                                                        } ?></textarea>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                        
                        <div class="d-flex justify-content-end w-100">
                            <div id="valide_campagne_envoyer" class="m-lg-2 w-25">
                                <input type="submit" value="Continuer" class="form-control btn btn-info" />
                            </div>
                        </div>

                    </form>
                    <!--end row-->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'partials/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>

    <?php include 'partials/vendor-scripts.php'; ?>

    <script src=" assets/js/pages/form-advanced.init.js"></script>

    <script>
        $('#editor').summernote({
            placeholder: 'Coller votre code dans source </>',
            tabsize: 17,
            height: 425,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>

    <?php if (isset($b2)) {
        echo '<script type="text/javascript">$(window).load(function() {';
        if ($b2) { // B2C
            echo '$("div#b2.widget-body.center div.make-switch.has-switch div.switch-on.switch-animate").removeClass("switch-off").addClass("switch-on");';
            echo '$("#b2_input").val("b2c");';
        } else { // B2B
            echo '$("div#b2.widget-body.center div.make-switch.has-switch div.switch-on.switch-animate").removeClass("switch-on").addClass("switch-off");';
            echo '$("#b2_input").val("b2b");';
        }
        echo '});</script>';
    } ?>

    <script src="assets/js/app.js"></script>
</body>

</html>