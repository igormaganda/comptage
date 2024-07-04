<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php require("partials/class/Bdd.php"); ?>
<?php
$bdd = new Bdd();
$campagnebytotalsuccess = $campagnebytotalfail = $campagnetotauxtheo = $idtoroutes = array();

// Tableau des volumes totaux par campagne
$requete = "SELECT id_campagne, volume
				FROM send_daemon, campagne
				WHERE id_campagne = campagne.id";

$result = $bdd->executeQueryRequete($requete, 1);
while ($campagne = $result->fetch()) {
    $campagnetotauxtheo[$campagne->id_campagne] = $campagne->volume;
}

// Tableau des volumes envoyés par campagne (réussi)
$requete = "SELECT id_campagne, route, COUNT(id_campagne) AS total
				FROM send_envoi
				WHERE error = ''
				GROUP BY id_campagne, route
				ORDER BY COUNT(id_campagne) DESC";

$result = $bdd->executeQueryRequete($requete, 1);
while ($campagne = $result->fetch()) {
    $campagnebytotalsuccess[$campagne->id_campagne] = $campagne->total;
}

// Tableau des volumes envoyés par campagne (échoué)
$requete = "SELECT id_campagne, route, COUNT(id_campagne) AS total
				FROM send_envoi
				WHERE error != ''
				GROUP BY id_campagne, route
				ORDER BY COUNT(id_campagne) DESC";

$result = $bdd->executeQueryRequete($requete, 1);
while ($campagne = $result->fetch()) {
    $campagnebytotalfail[$campagne->id_campagne] = $campagne->total;
}

// Tableau des ip/routes
$requete = "SELECT id, alias
				FROM gestion_routes
				ORDER BY id ASC";

$result = $bdd->executeQueryRequete($requete, 1);
while ($campagne = $result->fetch()) {
    $idtoroutes[$campagne->id] = $campagne->alias;
}


//print_r($campagnetotauxtheo); print_r($campagnebytotal);
?>

<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Envois')); ?>


    <!--datatable css-->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <!--datatable responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">

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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Statistique', 'title' => 'Envois')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                                <?php include 'partials/customizer.php'; ?>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Liste d'envois</h5>
                                </div>
                                <div class="card-body">
                                    <div id="content">
                                        <div class="widget">
                                            <div>
                                                <table class="scroll-horizontal table table-bordered table-striped table-hover" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Reference</th>
                                                            <th>Route</th>
                                                            <th>Programmé le</th>
                                                            <th>Volume</th>
                                                            <th>Réussis</th>
                                                            <th>Échec</th>
                                                            <th>Avancement</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $requete = "SELECT id, id_campagne, reference, route, date, go FROM send_daemon ORDER BY date DESC";

                                                        $result = $bdd->executeQueryRequete($requete, 1);
                                                        while ($campagne = $result->fetch()) {
                                                            echo '<tr>';
                                                            echo '<td>' . $campagne->id . '</td>';
                                                            echo '<td>' . $campagne->reference . '</td>';

                                                            if (array_key_exists($campagne->route, $idtoroutes)) {
                                                                echo '<td>' . $idtoroutes[$campagne->route] . ' (' . $campagne->route . ')</td>';
                                                            } else {
                                                                $onTheRoad = $campagne->route == '1x' ? 'Xmailer' : $campagne->route;
                                                                echo '<td>' . $onTheRoad . '</td>';
                                                            }

                                                            echo '<td>' . $campagne->date . '</td>';
                                                            if (array_key_exists($campagne->id_campagne, $campagnetotauxtheo)) {
                                                                echo '<td>' . $campagnetotauxtheo[$campagne->id_campagne] . '</td>';
                                                            } else {
                                                                echo '<td>.</td>';
                                                            }

                                                            if (array_key_exists($campagne->id_campagne, $campagnebytotalsuccess)) {
                                                                echo '<td>' . $campagnebytotalsuccess[$campagne->id_campagne] . '</td>';
                                                            } else {
                                                                if ($campagne->route == '1x') {
                                                                    echo '<td>' . $campagnetotauxtheo[$campagne->id_campagne] . '</td>';
                                                                } else {
                                                                    echo '<td>.</td>';
                                                                }
                                                            }

                                                            if (array_key_exists($campagne->id_campagne, $campagnebytotalfail)) {
                                                                echo '<td>' . $campagnebytotalfail[$campagne->id_campagne] . '</td>';
                                                            } else {
                                                                echo '<td>.</td>';
                                                            }

                                                            if (array_key_exists($campagne->id_campagne, $campagnebytotalsuccess) && array_key_exists($campagne->id_campagne, $campagnetotauxtheo)) {
                                                                if ($campagnetotauxtheo[$campagne->id_campagne] > 0 && $campagnebytotalsuccess[$campagne->id_campagne] > 0) {
                                                                    $ratio = round($campagnebytotalsuccess[$campagne->id_campagne] * 100 / $campagnetotauxtheo[$campagne->id_campagne], 2);
                                                                    if ($ratio > 100) $ratio = 100;
                                                                    echo '<td>' . $ratio . ' %</td>';
                                                                } else {
                                                                    echo '<td>.</td>';
                                                                    $ratio = 0;
                                                                }
                                                            } else {
                                                                if ($campagne->route == '1x') {
                                                                    echo '<td>100 %</td>';
                                                                } else {
                                                                    echo '<td>.</td>';
                                                                }
                                                                $ratio = 0;
                                                            }

                                                            switch ($campagne->go) {
                                                                case 0:
                                                                    echo '<td><span class="label label-default">En attente</span></td>';
                                                                    break;

                                                                case 1:
                                                                    echo '<td><span class="label label-info">En cours</span></td>';
                                                                    break;

                                                                case 2:
                                                                    if ($ratio >= 100) {
                                                                        echo '<td><span class="label label-success">Terminé</span></td>';
                                                                    } else {
                                                                        if ($campagne->route == '1x') {
                                                                            echo '<td><span class="label label-success">Terminé</span></td>';
                                                                        } else {
                                                                            echo '<td><span class="label label-danger">Inachevé</span></td>';
                                                                        }
                                                                    }
                                                                    break;
                                                            }
                                                            echo '</tr>';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
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

    <script src=" https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>

    <!--datatable js-->
    <script src="assets/js/pages/jquery.dataTables.min.js"></script>
    <script src="assets/js/pages/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/pages/dataTables.responsive.min.js"></script>
    <script src="assets/js/pages/dataTables.buttons.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let tables = document.querySelectorAll('.scroll-horizontal');
            tables.forEach(function(table) {
                $(table).DataTable({
                    "scrollX": true
                });
            });
        });
    </script>
    <script src="assets/js/pages/datatables.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>