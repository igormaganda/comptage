<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php
// require_once("../../sdatamart/lib/system_load.php");
// //user Authentication.
// authenticate_user('all');
$campagne = true;
$display = true;

require_once("partials/class/Bdd.php");
require_once("partials/class/Calc.php");
require_once("./partials/class/Printer.php");

if (isset($_GET["edit"])) {
    $bdd = new Bdd();

    $requete = "SELECT route, operation, prix, objectif, comptage, volume, dpf, thematiques, envoi, bat FROM campagne WHERE id=" . $_GET["id"];
    $result = $bdd->executeQueryRequete($requete, 1);

    while ($data = $result->fetch()) {
        $route       = $data->route;
        $operation   = $data->operation;
        $prix        = $data->prix;
        $objectif    = $data->objectif;
        $comptage    = $data->comptage;
        $volume      = $data->volume;
        $dpf         = $data->dpf;
        $thematiques = $data->thematiques;
        $envoi       = $data->envoi;
        $bat         = $data->bat;
    }
}
?>

<?php if (!isset($_GET["edit"])) { ?>
    <div id="go_back"><a href="./campagne.php?id=<?php echo $_GET["id"];
                                                    if (isset($_GET["cmp"])) {
                                                        echo '&cmp=' . $_GET["cmp"];
                                                    } ?>" class="text-inverse" data-toggle="tooltip" data-original-title="Retour" data-placement="right"><i class="icon-rewind-fill fa-3x"></i></a></div>
<?php } else { ?>
    <div id="go_back"><a href="./campagne.php?edit=<?php echo $_GET["edit"] ?>" class="text-inverse"><i class="icon-rewind-fill fa-3x" data-toggle="tooltip" data-original-title="Retour" data-placement="right"></i></a></div>
<?php } ?>


<head>
    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Campagne')); ?>

    <link rel="stylesheet" href="assets/libs/nouislider/nouislider.min.css">
    <!-- Sweet Alert css-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- dropzone css -->
    <link href="assets/libs/dropzone/dropzone.css" rel="stylesheet" type="text/css">
    <!--datatable css-->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <!--datatable responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="assets/libs/multi.js/multi.min.css">
    <!-- autocomplete css -->
    <link rel="stylesheet" href="assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">


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

                    <form method="POST" action="campagne_c.php" name="form_campagne" id="form_campagne">
                        <div class="row g-3">
                            <div class="col-xxl-4">

                                <?php
                                if (isset($_GET["edit"]) && !isset($_GET["copie"])) {
                                    echo '<input type="hidden" name="action" id="action" value="edit">';
                                } else {
                                    echo '<input type="hidden" name="action" id="action" value="new">';
                                }
                                ?>

                                <input name="id" value="<?php echo $_GET["id"]; ?>" type="hidden">

                                <div class="card p-1">
                                    <div class="card-header d-md-flex gap-3 bg-light rounded m-1">
                                        <div class="flex-grow-1">
                                            <h4 class="card-title mb-3">Envois de mail</h4>
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="card-body tab-content">
                                        <div class="tab-pane show active" id="autoSizingPreview" role="tabpanel" aria-labelledby="autoSizingPreview-tab" tabindex="0">
                                            <div class="row">

                                                <div class="row">
                                                    <div class="col-xxl-9">
                                                        <textarea name="bat" id="bat" class="form-control border-2 m-2" rows="6" style="height: 83px; resize: none;"><?php if (isset($bat)) {
                                                                                                                                                                            echo trim($bat);
                                                                                                                                                                        } else {
                                                                                                                                                                            echo 'kinhosamuel2@yahoo.com';
                                                                                                                                                                        } ?></textarea>
                                                    </div>
                                                    <div class="col-xxl-3">
                                                        <button type="button" class="btn btn-lg btn-info border-2 m-2 w-100" style="height: 83px;" onclick="sendBAT(<?php echo $_GET["id"] . ', ';
                                                                                                                                                                    if (isset($_GET["edit"])) {
                                                                                                                                                                        echo 1;
                                                                                                                                                                    } else {
                                                                                                                                                                        echo 0;
                                                                                                                                                                    } ?>);">Go</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card p-1">
                                    <div class="card-header d-md-flex gap-3 bg-light rounded m-1">
                                        <div class="flex-grow-1">
                                            <h4 class="card-title mb-3">Sélection d'un comptage</h4>
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="card-body tab-content">
                                        <div class="tab-pane show active" id="autoSizingPreview" role="tabpanel" aria-labelledby="autoSizingPreview-tab" tabindex="0">
                                            <div class="row">

                                                <div class="row">
                                                    <div class="col-xxl-12">
                                                        <input name="comptage" type="hidden" <?php if (isset($comptage)) {
                                                                                                    echo 'value="' . $comptage . '" ';
                                                                                                } ?>id="input_comptage" class="form-control input-lg" required>
                                                        <input type="text" <?php
                                                                            if (isset($comptage)) {
                                                                                $requete = "SELECT name FROM counter WHERE id=" . $comptage;
                                                                                $result = $bdd->executeQueryRequete($requete, 1);

                                                                                while ($data = $result->fetch()) {
                                                                                    echo 'value="' . $data->name . '" ';
                                                                                }
                                                                            }
                                                                            ?> id="input_comptage_name" class="form-control input-lg border-2 m-2" placeholder="Cliquez pour sélectionner un comptage" data-toggle="modal" data-target="#modal_comptage" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xxl-6">
                                                        <input name="volume" type="text" class="form-control input-lg border-2 m-2" placeholder="Volume total" <?php if (isset($volume)) {
                                                                                                                                                                    echo ' value="' . $volume . '"';
                                                                                                                                                                } ?>>
                                                    </div>

                                                    <div class="col-xxl-6">
                                                        <input name="dpf" type="text" class="form-control input-lg border-2 m-2" placeholder="Volume par campagne">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card p-1">
                                    <div class="card-header d-md-flex gap-3 bg-light rounded m-1">
                                        <div class="flex-grow-1">
                                            <h4 class="card-title mb-3">Route d'envoi</h4>
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="card-body tab-content">
                                        <div class="tab-pane show active" id="autoSizingPreview" role="tabpanel" aria-labelledby="autoSizingPreview-tab" tabindex="0">
                                            <div class="row">

                                                <div class="row">
                                                    <div class="col-xxl-6">
                                                        <label class="visually-hidden" for="adresse"></label>
                                                        <div class="input-group m-2">
                                                            <input name="adresse" id="adresse" type="text" class="form-control input-lg border-2 " placeholder="Adresse de l'expéditeur" <?php if (isset($adresse)) {
                                                                                                                                                                                                echo ' value="' . $adresse . '"';
                                                                                                                                                                                            } ?> required>
                                                            <div class="input-group-text">@</div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-6">
                                                        <select name="domaine" class="form-select input-lg border-2 m-2" id="domaine" required>
                                                            <option value="">Domaine</option>
                                                            <?php
                                                            $bdd = new Bdd();

                                                            $requete = "SELECT Id, Nom, Alias FROM gestion_domaine ORDER BY id ASC";
                                                            $result = $bdd->executeQueryRequete($requete, 1);

                                                            while ($items = $result->fetch()) {
                                                                if (isset($domaine)) {
                                                                    if ($items->id == $domaine) {
                                                                        echo '<option value="' . $items->id . '" selected>' . $items->nom . '</option>';
                                                                    } else {
                                                                        echo '<option value="' . $items->id . '">' . $items->nom . '</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option value="' . $items->id . '">' . $items->nom . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xxl-12">
                                                        <select name="route" class="form-select input-lg border-2 m-2" id="route" required>
                                                            <option value=""></option>
                                                            <?php
                                                            $requete = "SELECT Id, Ip, Alias, Domaine FROM gestion_routes ORDER BY Alias ASC";
                                                            $result = $bdd->executeQueryRequete($requete, 1);

                                                            while ($items = $result->fetch()) {
                                                                echo '<option value="' . $items->id . '" class="dynamic route' . $items->domaine . ' hidden">' . $items->alias . ' (' . $items->ip . ')</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card p-1">
                                    <div class="card-header d-md-flex gap-3 bg-light rounded m-1">
                                        <div class="flex-grow-1">
                                            <h4 class="card-title mb-3">Type d'opération</h4>
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="card-body tab-content">
                                        <div class="tab-pane show active" id="autoSizingPreview" role="tabpanel" aria-labelledby="autoSizingPreview-tab" tabindex="0">
                                            <div class="row">

                                                <div class="row">
                                                    <div class="col-xxl-12">
                                                        <select name="ope" class="form-select input-lg border-2 m-2" id="ope">
                                                            <?php
                                                            echo $operation == 'interne' ? '<option value="interne" selected>Interne</option>' : '<option value="interne">Interne</option>';
                                                            echo $operation == 'cpm' ? '<option value="cpm" selected>CPM</option>' : '<option value="cpm">CPM</option>';
                                                            echo $operation == 'cpl' ? '<option value="cpl" selected>CPL</option>' : '<option value="cpl">CPL</option>';
                                                            echo $operation == 'cpc' ? '<option value="cpc" selected>CPC</option>' : '<option value="cpc">CPC</option>';
                                                            echo $operation == 'cpmo' ? '<option value="cpmo" selected>CPMO</option>' : '<option value="cpmo">CPMO</option>';
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xxl-6">
                                                        <input name="prix" type="text" <?php if (isset($prix)) {
                                                                                            echo 'value="' . $prix . '" ';
                                                                                        } ?>class="form-control input-lg border-2 m-2" placeholder="Prix">
                                                    </div>

                                                    <div class="col-xxl-6">
                                                        <input name="objectif" type="text" <?php if (isset($objectif)) {
                                                                                                echo 'value="' . $objectif . '" ';
                                                                                            } ?>class="form-control input-lg border-2 m-2" placeholder="Objectif">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card p-1">
                                    <div class="card-header d-md-flex gap-3 bg-light rounded m-1">
                                        <div class="flex-grow-1">
                                            <h4 class="card-title mb-3">Date de shoot</h4>
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="card-body tab-content">
                                        <div class="tab-pane show active" id="autoSizingPreview" role="tabpanel" aria-labelledby="autoSizingPreview-tab" tabindex="0">
                                            <?php
                                            if (isset($envoi)) {
                                                $date_time = explode(" ", $envoi);

                                                $date = explode("-", $date_time[0]);
                                                $time = explode(":", $date_time[1]);
                                            }
                                            ?>

                                            <div class="row">

                                                <div class="row">
                                                    <div class="col-xxl-2">
                                                        <input type="text" name="annee" class="form-control input-lg border-2 m-2" placeholder="Année" value="<?php if (isset($envoi)) {
                                                                                                                                                                    echo $date[0];
                                                                                                                                                                } else {
                                                                                                                                                                    echo date("Y");
                                                                                                                                                                } ?>">
                                                    </div>
                                                    <div class="col-xxl-2">
                                                        <input type="text" name="mois" class="form-control input-lg border-2 m-2" placeholder="Mois" value="<?php if (isset($envoi)) {
                                                                                                                                                                echo $date[1];
                                                                                                                                                            } else {
                                                                                                                                                                echo date("m");
                                                                                                                                                            } ?>">
                                                    </div>
                                                    <div class="col-xxl-2">
                                                        <input type="text" name="jour" class="form-control input-lg border-2 m-2" placeholder="Jour" value="<?php if (isset($envoi)) {
                                                                                                                                                                echo $date[2];
                                                                                                                                                            } else {
                                                                                                                                                                echo date('d', time() - 3600 * 24);
                                                                                                                                                            } ?>">
                                                    </div>
                                                    <div class="col-xxl-2">
                                                        <input type="text" name="heure" class="form-control input-lg border-2 m-2" placeholder="Heure" value="<?php if (isset($envoi)) {
                                                                                                                                                                    echo $time[0];
                                                                                                                                                                } else {
                                                                                                                                                                    echo date("H");
                                                                                                                                                                } ?>">
                                                    </div>
                                                    <div class="col-xxl-2">
                                                        <input type="text" name="min" class="form-control input-lg border-2 m-2" placeholder="Minute" value="<?php if (isset($envoi)) {
                                                                                                                                                                    echo $time[1];
                                                                                                                                                                } else {
                                                                                                                                                                    echo date("i");
                                                                                                                                                                } ?>">
                                                    </div>
                                                    <div class="col-xxl-2">
                                                        <input type="text" name="sec" class="form-control input-lg border-2 m-2" placeholder="Seconde" value="<?php if (isset($envoi)) {
                                                                                                                                                                    echo $time[2];
                                                                                                                                                                } else {
                                                                                                                                                                    echo date("s");
                                                                                                                                                                } ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-8" id="corps_mail">
                                <div class="card p-3">
                                    <?php
                                    if (isset($_GET["edit"])) {
                                        echo '<iframe style="height: 67.298rem;" src="./apercu.php?id=' . $_GET["id"] . '"></iframe>';
                                    } else {
                                        echo '<iframe style="height: 67.298rem;" src="./vue.php?id=' . $_GET["id"] . '"></iframe>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div><!-- end row -->

                        <div class="card p-1 mb-0">
                            <div class="card-header d-md-flex gap-3 bg-light rounded m-1">
                                <div class="flex-grow-1">
                                    <h4 class="card-title mb-3">Thématiques</h4>
                                </div>
                            </div><!-- end card header -->
                            <div class="card-body tab-content">
                                <div class="tab-pane show active" id="autoSizingPreview" role="tabpanel" aria-labelledby="autoSizingPreview-tab" tabindex="0">
                                    <div class="row">

                                        <div class="row">
                                            <?php
                                            $bdd = new Bdd();

                                            $requete = "SELECT Nom, Alias FROM gestion_thematique ORDER BY id ASC";
                                            $result = $bdd->executeQueryRequete($requete, 1);

                                            echo '<div class="row">';
                                            if (isset($thematiques)) {
                                                $themes = explode(",", $thematiques);

                                                while ($items = $result->fetch()) {
                                                    $is = false;

                                                    foreach ($themes as $value) {
                                                        if ($items->alias == $value) {
                                                            $is = true;
                                                        }
                                                    }

                                                    if ($is) {
                                                        echo '<div class="col-md-3 text-start"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                <input type="checkbox" name="thematiques[]" value="' . $items->alias . '" checked="checked">
                                                                <i class="fa fa-fw fa-square-o checked"></i>' . $items->nom . '</label></div></div>';
                                                    } else {
                                                        echo '<div class="col-md-3 text-start"><div class="item_thematique"><label class="checkbox-custom"> 
                                                                <input type="checkbox" name="thematiques[]" value="' . $items->alias . '">
                                                                <i class="fa fa-fw fa-square-o"></i>' . $items->nom . '</label></div></div>';
                                                    }
                                                }
                                            } else {
                                                while ($items = $result->fetch()) {
                                                    echo '<div class="col-md-3 text-start"><div class="item_thematique"><label class="checkbox-custom"> 
                                                            <input type="checkbox" name="thematiques[]" value="' . $items->alias . '">
                                                            <i class="fa fa-fw fa-square-o"></i>' . $items->nom . '</label></div></div>';
                                                }
                                            }
                                            echo '</div>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end w-100">
                            <div id="valide_campagne_envoyer" class="m-lg-2 w-25">
                                <input type="submit" name="envoyer" value="Enregistrer" class="form-control btn btn-info" />
                            </div>
                        </div>

                        <!-- start Modal -->
                        <div class="modal fade" id="modal_comptage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Sélection d'un comptage</h4>
                                        <button type="button" class="close bg-danger" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $bdd = new Bdd();
                                        $calc = new Calc();

                                        $requete = "SELECT DISTINCT * FROM counter ORDER BY id";

                                        $result = $bdd->executeQueryRequete($requete, 1);

                                        $rowClass = ''; // Variable pour stocker la classe de ligne

                                        echo '<table id="scroll-horizontal"  class="table table-bordered table-striped table-hover" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Résultat</th>
                                                    <th>Date</th>
                                                    <th>Sélection</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                        while ($currentSearch = $result->fetch()) {
                                            // Changer la classe de ligne à chaque itération
                                            $rowClass = ($rowClass == 'even') ? 'odd' : 'even';

                                            if (!empty($currentSearch->name)) {
                                                $currentSearch->name = strtolower($calc->removeSpecialChars($currentSearch->name));
                                                $tmp = explode(" ", $currentSearch->name);
                                                $name = $tmp[0];
                                            } else {
                                                $currentSearch->name = "/";
                                            }

                                            echo '<tr class="' . $rowClass . '">';
                                            echo '<td>' . htmlspecialchars($currentSearch->name) . '</td>';
                                            if ($currentSearch->result == 0) {
                                                echo '<td id="nbcount' . htmlspecialchars($currentSearch->id) . '"><span class="badge bg-danger">' . htmlspecialchars($currentSearch->result) . '</span></td>';
                                            } else {
                                                echo '<td id="nbcount' . htmlspecialchars($currentSearch->id) . '"><span class="badge bg-info">' . number_format($currentSearch->result, 0, "", " ") . '</span></td>';
                                            }
                                            echo '<td>' . htmlspecialchars($currentSearch->date) . '</td>';
                                            echo '<td>
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" onclick=\'selectCount(' . htmlspecialchars($currentSearch->id) . ',"' . htmlspecialchars($currentSearch->name) . '");\' style="width:100%;">Sélectionner</button>
                                            </td>';
                                            echo '</tr>';
                                        }
                                        echo '</tbody></table>';
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end Modal -->
                    </form>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <div id="alert_msg">
                <span id="msg_success" class="btn btn-success" data-layout="top" data-type="success" data-toggle="notyfy">Success</span>
                <span id="msg_echec" class="btn btn-danger" data-layout="top" data-type="error" data-toggle="notyfy">Danger</span>
            </div>

            <?php include 'partials/footer.php'; ?>
        </div>
        <!-- end main content-->
    </div>

    <?php include 'partials/vendor-scripts.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/pages/jquery.dataTables.min.js"></script>
    <script src="assets/js/pages/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/pages/dataTables.responsive.min.js"></script>
    <script src="assets/js/pages/dataTables.buttons.min.js"></script>
    <script src="assets/js/pages/datatables.init.js"></script>

    <script>
        $(document).ready(function() {
            $('#DataPrinter').DataTable({
                "paging": true, // Activer la pagination
                "lengthChange": true, // Activer le choix du nombre d'éléments par page
                "searching": true, // Activer la barre de recherche
                "ordering": true, // Activer le tri des colonnes
                "info": true, // Afficher les informations de pagination
                "autoWidth": false, // Désactiver l'ajustement automatique de la largeur des colonnes
                "language": { // Personnaliser les messages et les libellés
                    "lengthMenu": "Afficher _MENU_ éléments par page",
                    "zeroRecords": "Aucun résultat trouvé",
                    "info": "Page _PAGE_ sur _PAGES_",
                    "infoEmpty": "Aucun élément disponible",
                    "infoFiltered": "(filtré sur _MAX_ éléments au total)",
                    "search": "Rechercher :",
                    "paginate": {
                        "previous": "Précédent",
                        "next": "Suivant"
                    }
                }
            });
        });
    </script>

    <script src=" assets/js/pages/form-advanced.init.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>