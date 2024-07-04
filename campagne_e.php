<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php require("partials/class/Bdd.php"); ?>
<?php require("./partials/class/Printer.php"); ?>

<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Statistique')); ?>

    <!-- jsvectormap css -->

    <!--datatable css-->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <!--datatable responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">

    <?php include 'partials/head-css.php'; ?>
    <style>
        .requete_count td {
            word-wrap: break-word;
            /* ou overflow-wrap: break-word; */
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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Campagne', 'title' => 'Statistique')); ?>
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
                                    <h5 class="card-title mb-0">Statistique de l'envoi <?php echo utf8_decode($_POST["text"]) . "(" . $_POST["mailno"] . ")" ?></h5>
                                </div>
                                <div class="card-body">
                                    <div id="content">
                                        <h6>Information générale</h6>

                                        <table class="scroll-horizontal table table-bordered table-striped table-white result" style="width:100%">
                                            <thead>
                                                <th>Nom</th>
                                                <th>Sujet</th>
                                                <th>Expéditeur</th>
                                                <th>Date d'envoi</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo utf8_decode($_POST["text"]); ?></td>
                                                    <td><?php echo utf8_decode($_POST["subject"]); ?></td>
                                                    <td><?php echo utf8_decode($_POST["fromname"]); ?></td>
                                                    <td><?php echo utf8_decode($_POST["start"]); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <br>
                                        <h6>Performances</h6>
                                        <table class="scroll-horizontal table table-bordered table-striped table-white result" style="width:100%">
                                            <thead>
                                                <th class="big">Ouvert</th>
                                                <th>Taux de clics</th>
                                                <th>Taux de réactivité (clic sur ouverture)</th>
                                                <th>Désinscrits</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="big">
                                                        <?php
                                                        echo $_POST["ok"] > 0 ? round($_POST["up"] * 100 / $_POST["ok"], 1) . ' % des reçus (' . $_POST["up"] . ')' : "/";
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $_POST["ok"] > 0 ? round($_POST["ck"] * 100 / $_POST["ok"], 1) . ' % des reçus (' . $_POST["ck"] . ')' : "/";
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $_POST["up"] > 0 ? round($_POST["ck"] * 100 / $_POST["up"], 1) . ' %' : "/";
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $_POST["ok"] > 0 ? round($_POST["un"] * 100 / $_POST["ok"], 1) . ' % des reçus (' . $_POST["un"] . ')' : "/";
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <br>
                                        <h6>Délivrabilité</h6>
                                        <table class="scroll-horizontal table table-bordered table-striped table-white result" style="width:100%">
                                            <thead>
                                                <th class="big">Campagne reçue par</th>
                                                <th>Soumis</th>
                                                <th>Filtrés</th>
                                                <th>Bounced</th>
                                                <th>Hard bounce</th>
                                                <th>Soft bounce</th>
                                                <th>Taux de plainte</th>
                                            </thead>
                                            <tbody>
                                                <td class="big">
                                                    <?php
                                                    echo $_POST["recnb"] > 0 ? round($_POST["ok"] * 100 / $_POST["recnb"], 1) . ' % des sélectionnés (' . $_POST["ok"] . ')' : "/";
                                                    ?>
                                                </td>
                                                <td><?php echo $_POST["recnb"]; ?> emails soumis</td>
                                                <td>
                                                    <?php
                                                    echo $_POST["recnb"] > 0 ? round(($_POST["recnb"] - $_POST["ok"]) * 100 / $_POST["recnb"], 1) . ' % des sélectionnés (' . ($_POST["recnb"] - $_POST["ok"]) . ')' : "/";
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $_POST["recnb"] > 0 ? round(($_POST["hd"] + $_POST["sf"]) * 100 / $_POST["recnb"], 1) . ' % des sélectionnés (' . ($_POST["hd"] + $_POST["sf"]) . ')' : "/";
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $_POST["recnb"] > 0 ? round($_POST["hd"] * 100 / $_POST["recnb"], 1) . ' % des sélectionnés (' . $_POST["hd"] . ')' : "/";
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $_POST["recnb"] > 0 ? round($_POST["sf"] * 100 / $_POST["recnb"], 1) . ' % des sélectionnés (' . $_POST["sf"] . ')' : "/";
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $_POST["recnb"] > 0 ? round($_POST["fb"] * 100 / $_POST["recnb"], 1) . ' % des reçus (' . $_POST["fb"] . ')' : "/";
                                                    ?>
                                                </td>
                                            </tbody>
                                        </table>

                                        <br>
                                        <h6>Rapport par FAI</h6>
                                        <table class="scroll-horizontal table table-bordered table-striped table-white" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Groupes de FAI</th>
                                                    <th>Envoyés</th>
                                                    <th>Aboutis</th>
                                                    <th>Ouvreurs</th>
                                                    <th>Cliqueurs</th>
                                                    <th>Hard bounces</th>
                                                    <th>Soft bounces</th>
                                                    <th>Désinscrits</th>
                                                    <th>Plaintes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Autres</td>
                                                    <td><?php echo $_POST["autresEnvoyes"]; ?></td>
                                                    <td><?php echo $_POST["autresAboutis"]; ?></td>
                                                    <td><?php echo $_POST["autresOuvreurs"]; ?></td>
                                                    <td><?php echo $_POST["autresCliqueurs"]; ?></td>
                                                    <td><?php echo $_POST["autresHardBounces"]; ?></td>
                                                    <td><?php echo $_POST["autresSoftBounces"]; ?></td>
                                                    <td><?php echo $_POST["autresDesinscrits"]; ?></td>
                                                    <td><?php echo $_POST["autresPlaintes"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>@free</td>
                                                    <td><?php echo $_POST["freeEnvoyes"]; ?></td>
                                                    <td><?php echo $_POST["freeAboutis"]; ?></td>
                                                    <td><?php echo $_POST["freeOuvreurs"]; ?></td>
                                                    <td><?php echo $_POST["freeCliqueurs"]; ?></td>
                                                    <td><?php echo $_POST["freeHardBounces"]; ?></td>
                                                    <td><?php echo $_POST["freeSoftBounces"]; ?></td>
                                                    <td><?php echo $_POST["freeDesinscrits"]; ?></td>
                                                    <td><?php echo $_POST["freePlaintes"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>@orange</td>
                                                    <td><?php echo $_POST["orangeEnvoyes"]; ?></td>
                                                    <td><?php echo $_POST["orangeAboutis"]; ?></td>
                                                    <td><?php echo $_POST["orangeOuvreurs"]; ?></td>
                                                    <td><?php echo $_POST["orangeCliqueurs"]; ?></td>
                                                    <td><?php echo $_POST["orangeHardBounces"]; ?></td>
                                                    <td><?php echo $_POST["orangeSoftBounces"]; ?></td>
                                                    <td><?php echo $_POST["orangeDesinscrits"]; ?></td>
                                                    <td><?php echo $_POST["orangePlaintes"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>@neuf</td>
                                                    <td><?php echo $_POST["neufEnvoyes"]; ?></td>
                                                    <td><?php echo $_POST["neufAboutis"]; ?></td>
                                                    <td><?php echo $_POST["neufOuvreurs"]; ?></td>
                                                    <td><?php echo $_POST["neufCliqueurs"]; ?></td>
                                                    <td><?php echo $_POST["neufHardBounces"]; ?></td>
                                                    <td><?php echo $_POST["neufSoftBounces"]; ?></td>
                                                    <td><?php echo $_POST["neufDesinscrits"]; ?></td>
                                                    <td><?php echo $_POST["neufPlaintes"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>@noos</td>
                                                    <td><?php echo $_POST["noosEnvoyes"]; ?></td>
                                                    <td><?php echo $_POST["noosAboutis"]; ?></td>
                                                    <td><?php echo $_POST["noosOuvreurs"]; ?></td>
                                                    <td><?php echo $_POST["noosCliqueurs"]; ?></td>
                                                    <td><?php echo $_POST["noosHardBounces"]; ?></td>
                                                    <td><?php echo $_POST["noosSoftBounces"]; ?></td>
                                                    <td><?php echo $_POST["noosDesinscrits"]; ?></td>
                                                    <td><?php echo $_POST["noosPlaintes"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>@laposte</td>
                                                    <td><?php echo $_POST["laposteEnvoyes"]; ?></td>
                                                    <td><?php echo $_POST["laposteAboutis"]; ?></td>
                                                    <td><?php echo $_POST["laposteOuvreurs"]; ?></td>
                                                    <td><?php echo $_POST["laposteCliqueurs"]; ?></td>
                                                    <td><?php echo $_POST["laposteHardBounces"]; ?></td>
                                                    <td><?php echo $_POST["laposteSoftBounces"]; ?></td>
                                                    <td><?php echo $_POST["laposteDesinscrits"]; ?></td>
                                                    <td><?php echo $_POST["lapostePlaintes"]; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
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