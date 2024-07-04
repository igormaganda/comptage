<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>
<?php 
    require("partials/class/Bdd.php"); 
      /*
        DEBUGER LE CODE PHP
    */ 
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    $bdd = new Bdd();
    $bd = $bdd->connect();
    
    try {
        $reqsql = "SELECT category_product, brand_product, status_product, price_product FROM product_matchs";
    
    } catch (PDOException $e) {
        die("Erreur de requête : " . $e->getMessage());
    }
    ?>
    <style>
        .requete_count td {
            word-wrap: break-word; /* ou overflow-wrap: break-word; */
        }
	</style>
<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Statistiques')); ?>

    <!-- jsvectormap css -->
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css">
    <!--datatable css-->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css" >
    <!--datatable responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.bootstrap.min.css" >

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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Statistiques', 'title' => 'Composition')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Choix</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                        <select class="form-select mb-3" aria-label="Default select example">
                                            <option selected>Choisi le type de catégorie</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        </div>
                                        <div class="col-4">
                                        <select class="form-select mb-3" aria-label="Default select example">
                                            <option selected>Choisir la marque</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        </div>
                                        <div class="col-4">
                                            <select class="form-select mb-3" aria-label="Default select example">
                                                <option selected>Statut de prix</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <!-- <div class="col-4">
                                            <select class="form-select mb-3" aria-label="Default select example">
                                                <option selected>Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Resultats des meilleurs produits de la semaine</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-lg-12">
                                            <table class="table table-sm mb-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col" style="text-align: center;">Nom du serveur</th>
                                                        <th scope="col" style="text-align: center;">Total traité</th>
                                                        <th scope="col" style="text-align: center;">Fichier valides</th>
                                                        <th scope="col" style="text-align: center;">Fichier invalides</th>
                                                        <th scope="col" style="text-align: center;">Fichier d'erreurs</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($reqServer as $server): ?>
                                                    <tr>
                                                        <td class="text-muted text-center"><?php echo $server['Serveur']; ?></td>
                                                        <td class="text-muted text-center"><?php echo $server['sum_sert']; ?></td>
                                                        <td class="text-success text-center"><?php echo $server['sum_serv']; ?></td>
                                                        <td class="text-danger text-center"><?php echo $server['sum_serinv']; ?></td>
                                                        <td class="text-muted text-center"><?php echo $server['sum_serrcon']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                </tbody>
                                            </table>
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

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

    <script src="assets/libs/list.js/list.min.js"></script>

    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-ecommerce.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>