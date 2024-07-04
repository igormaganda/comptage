<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php require("partials/class/Bdd.php"); ?>

<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Statistique')); ?>


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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Statistique', 'title' => 'Presentation')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                                <?php include 'partials/customizer.php'; ?>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>

                    <div class="row g-1">
                        <div class="col-lg-12 rounded">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Données</h5>
                                </div>
                                <div class="card-body">
                                    <div id="content">
                                        <div class="row" id="presentation">
                                            <div class="card-body innerAll inner-2x">
                                                <?php
                                                $printData = new Bdd();

                                                $requete = "SELECT * FROM home5";
                                                $arrayInsBdd = array();
                                                $result = $printData->executeQueryRequete($requete, 1);
                                                while ($currentSearch = $result->fetch()) {
                                                    $arrayInsBdd[$currentSearch->champ] = $currentSearch->line;
                                                }

                                                echo '<table class="scroll-horizontal table table-bordered table-striped table-hover stats l3" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Age</th>
                                                            <th>Volume</th>
                                                            <th>%</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                $age = explode(";", $arrayInsBdd["age"]);
                                                array_pop($age);
                                                foreach ($age as $line) {
                                                    $item = explode(",", $line);
                                                    echo '<tr>
                                                        <td>' . $item[0] . '</td>
                                                        <td>' . number_format($item[1], 0, "", " ") . '</td>
                                                        <td>' . $item[2] . '</td>
                                                    </tr>';
                                                }

                                                echo '</tbody>
                                                    </table>';

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 rounded">
                            <div class="card">
                                <div class="card-body">
                                    <div id="content">
                                        <div class="row" id="presentation">
                                            <div class="card-body innerAll inner-2x">
                                                <?php
                                                $printData = new Bdd();

                                                $requete = "SELECT * FROM home5";
                                                $arrayInsBdd = array();
                                                $result = $printData->executeQueryRequete($requete, 1);
                                                while ($currentSearch = $result->fetch()) {
                                                    $arrayInsBdd[$currentSearch->champ] = $currentSearch->line;
                                                }

                                                echo '<table class="scroll-horizontal table table-bordered table-striped table-hover stats l3" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Civilité</th>
                                                            <th>Volume</th>
                                                            <th>%</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                $civilite = explode(";", $arrayInsBdd["civilite"]);
                                                array_pop($civilite);
                                                foreach ($civilite as $line) {
                                                    $item = explode(",", $line);
                                                    echo '<tr>
                                                        <td>' . $item[0] . '</td>
                                                        <td>' . number_format($item[1], 0, "", " ") . '</td>
                                                        <td>' . $item[2] . '</td>
                                                    </tr>';
                                                }

                                                echo '</tbody>
                                                    </table>';


                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 rounded">
                            <div class="card">
                                <div class="card-body">
                                    <div id="content">
                                        <div class="row" id="presentation">
                                            <div class="card-body innerAll inner-2x">
                                                <?php
                                                $printData = new Bdd();

                                                $requete = "SELECT * FROM home5";
                                                $arrayInsBdd = array();
                                                $result = $printData->executeQueryRequete($requete, 1);
                                                while ($currentSearch = $result->fetch()) {
                                                    $arrayInsBdd[$currentSearch->champ] = $currentSearch->line;
                                                }

                                                echo '<table class="scroll-horizontal table table-bordered table-striped table-hover stats l3" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>CSP</th>
                                                            <th>Volume</th>
                                                            <th>%</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                $csp = explode(";", $arrayInsBdd["csp"]);
                                                array_pop($csp);
                                                foreach ($csp as $line) {
                                                    $item = explode(",", $line);
                                                    echo '<tr>
                                                        <td>' . $item[0] . '</td>
                                                        <td>' . number_format($item[1], 0, "", " ") . '</td>
                                                        <td>' . $item[2] . '</td>
                                                    </tr>';
                                                }

                                                echo '</tbody>
                                                    </table>';


                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 rounded">
                            <div class="card">
                                <div class="card-body">
                                    <div id="content">
                                        <div class="row" id="presentation">
                                            <div class="card-body innerAll inner-2x">
                                                <?php
                                                $printData = new Bdd();

                                                $requete = "SELECT * FROM home5";
                                                $arrayInsBdd = array();
                                                $result = $printData->executeQueryRequete($requete, 1);
                                                while ($currentSearch = $result->fetch()) {
                                                    $arrayInsBdd[$currentSearch->champ] = $currentSearch->line;
                                                }

                                                echo '<table class="scroll-horizontal table table-bordered table-striped table-hover stats l3" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Affinités</th>
                                                            <th>Volume</th>
                                                            <th>%</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                $affinite = explode(";", $arrayInsBdd["affinite"]);
                                                foreach ($affinite as $line) {
                                                    $item = explode(",", $line);
                                                    echo '<tr>
                                                        <td>' . $item[0] . '</td>
                                                        <td>' . number_format($item[1], 0, "", " ") . '</td>
                                                        <td>' . $item[2] . '</td>
                                                    </tr>';
                                                }

                                                echo '</tbody>
                                                    </table>';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 rounded">
                            <div class="card">
                                <div class="card-body">
                                    <div id="content">
                                        <div class="row" id="presentation">
                                            <div class="card-body innerAll inner-2x">
                                                <?php
                                                $printData = new Bdd();

                                                $requete = "SELECT * FROM home5";
                                                $arrayInsBdd = array();
                                                $result = $printData->executeQueryRequete($requete, 1);
                                                while ($currentSearch = $result->fetch()) {
                                                    $arrayInsBdd[$currentSearch->champ] = $currentSearch->line;
                                                }

                                                echo '<table class="scroll-horizontal table table-bordered table-striped table-hover stats l3" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Divers</th>
                                                            <th>Volume</th>
                                                            <th>%</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Divers</th>
                                                            <th>Volume</th>
                                                            <th>%</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>';

                                                $divers = explode(";", $arrayInsBdd["divers"]);
                                                array_pop($divers);
                                                foreach ($divers as $line) {
                                                    $item = explode(",", $line);
                                                    echo '<tr>
                                                    <td>' . $item[0] . '</td>
                                                    <td>' . number_format($item[1], 0, "", " ") . '</td>
                                                    <td>' . $item[2] . '</td>
                                                </tr>';
                                                }

                                                echo '</tbody>
                                                    </table>';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 rounded">
                            <div class="card">
                                <div class="card-body">
                                    <div id="content">
                                        <div class="row" id="presentation">
                                            <div class="card-body innerAll inner-2x">
                                                <?php
                                                $printData = new Bdd();

                                                $requete = "SELECT * FROM home5";
                                                $arrayInsBdd = array();
                                                $result = $printData->executeQueryRequete($requete, 1);
                                                while ($currentSearch = $result->fetch()) {
                                                    $arrayInsBdd[$currentSearch->champ] = $currentSearch->line;
                                                }

                                                echo '<table class="scroll-horizontal table table-bordered table-striped table-hover stats l3" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Région</th>
                                                            <th>Volume</th>
                                                            <th>%</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                $region = explode(";", $arrayInsBdd["region"]);
                                                array_pop($region);
                                                array_pop($region);
                                                array_pop($region);
                                                foreach ($region as $line) {
                                                    $item = explode(",", $line);
                                                    echo '<tr>
                                                    <td>' . $item[0] . '</td>
                                                    <td>' . number_format($item[1], 0, "", " ") . '</td>
                                                    <td>' . $item[2] . '</td>
                                                </tr>';
                                                }

                                                echo '</tbody>
                                                    </table>';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 rounded">
                            <div class="card">
                                <div class="card-body">
                                    <div id="content">
                                        <div class="row" id="presentation">
                                            <div class="card-body innerAll inner-2x">
                                                <?php
                                                $printData = new Bdd();

                                                $requete = "SELECT * FROM home5";
                                                $arrayInsBdd = array();
                                                $result = $printData->executeQueryRequete($requete, 1);
                                                while ($currentSearch = $result->fetch()) {
                                                    $arrayInsBdd[$currentSearch->champ] = $currentSearch->line;
                                                }

                                                echo '<table class="scroll-horizontal table table-bordered table-striped table-hover stats l5" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Département</th>
                                                            <th>Total</th>
                                                            <th>Ouvreurs</th>
                                                            <th>Hommes</th>
                                                            <th>Femmes</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                $departement = explode(";", $arrayInsBdd["departement"]);
                                                array_pop($departement);
                                                foreach ($departement as $line) {
                                                    $item = explode(",", $line);
                                                    echo '<tr>
                                                        <td>' . $item[0] . '</td>
                                                        <td>' . number_format($item[1], 0, "", " ") . '</td>
                                                        <td>' . number_format($item[2], 0, "", " ") . ' (' . $item[3] . '%)</td>
                                                        <td>' . number_format($item[4], 0, "", " ") . ' (' . $item[5] . '%)</td>
                                                        <td>' . number_format($item[6], 0, "", " ") . ' (' . $item[7] . '%)</td>
                                                    </tr>';
                                                }

                                                echo '</tbody>
                                                </table>';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

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