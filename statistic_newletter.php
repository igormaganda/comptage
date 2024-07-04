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
        $reqsql = "SELECT * FROM product_matchs";
        $resMatch = $bd->query($reqsql)->fetchAll(PDO::FETCH_ASSOC);

        $req = "SELECT 
                        COUNT(id) AS tproduct, 
                        SUM(CASE WHEN status_product = 'mn' THEN 1 ELSE 0 END) AS tmn, 
                        SUM(CASE WHEN status_product = 'my' THEN 1 ELSE 0 END) AS tmy, 
                        SUM(CASE WHEN status_product = 'mx' THEN 1 ELSE 0 END) AS tmx
                    FROM product_matchs;
                    ";
        $resT = $bd->query($req)->fetch(PDO::FETCH_ASSOC);

        $reqT = "SELECT COUNT(*) AS res_temp FROM product_template";
        $resTemp = $bd->query($reqT)->fetch(PDO::FETCH_ASSOC);

        $reqC = "SELECT COUNT(DISTINCT category_product) AS res_cat FROM product_matchs";
        $resCat = $bd->query($reqC)->fetch(PDO::FETCH_ASSOC);

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

    <!--datatable css-->
    <!--datatable css-->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css" >
    <!--datatable responsive css-->
    <link rel="stylesheet" href="assets/css/responsive.bootstrap.min.css" >

    <link rel="stylesheet" href="assets/css/buttons.dataTables.min.css">
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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Statistiques', 'title' => 'Newsletter')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="avatar-sm float-end">
                                        <div class="avatar-title bg-success-subtle text-success rounded fs-3xl">
                                            <i class="bi bi-activity"></i>
                                        </div>
                                    </div>
                                    <p class="fs-md text-muted mb-4">Total Produit (Après Matching)</p>
                                    <h4 class="mb-3"><span class="counter-value" data-target="<?= $resT['tproduct'];?>">0</span></h4>
                                    <p class="text-success mb-0"><i class="bi bi-arrow-up me-1"></i> 06.41%</p>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="avatar-sm float-end">
                                        <div class="avatar-title bg-primary-subtle text-primary rounded fs-3xl">
                                            <i class="bi bi-magnet"></i>
                                        </div>
                                    </div>
                                    <p class="fs-md text-muted mb-4">Total Newsletter</p>
                                    <h4 class="mb-3"><span class="counter-value" data-target="<?= $resTemp['res_temp'];?>">0</span> </h4>
                                    <p class="text-success mb-0"><i class="bi bi-arrow-up me-1"></i> 17.52%</p>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="avatar-sm float-end">
                                        <div class="avatar-title bg-info-subtle text-info rounded fs-3xl">
                                            <i class="bi bi-optical-audio"></i>
                                        </div>
                                    </div>
                                    <p class="fs-md text-muted mb-4">Total Catégorie (Après Matching)</p>
                                    <h4 class="mb-3"><span class="counter-value" data-target="<?= $resCat['res_cat'];?>">0</span></h4>
                                    <p class="text-danger mb-0"><i class="bi bi-arrow-down me-1"></i> 07.26%</p>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="avatar-sm float-end">
                                        <div class="avatar-title bg-warning-subtle text-warning rounded fs-3xl">
                                            <i class="bi bi-eye"></i>
                                        </div>
                                    </div>
                                    <p class="fs-md text-muted mb-4">Total Max</p>
                                    <h4 class="mb-3"><span class="counter-value" data-target="136.19">0</span>k </h4>
                                    <p class="text-success mb-0"><i class="bi bi-arrow-up me-1"></i> 09.33%</p>
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
                                            <table id="scroll-horizontal"  class="table table-bordered table-striped table-hover align-middle">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col" style="width:35%; text-align: center;">Titre</th>
                                                        <th scope="col" style="width:10%; text-align: center;">Prix (euro) </th>
                                                        <th scope="col" style="width:15%; text-align: center;">Catégorie</th>
                                                        <th scope="col" style="width:10%; text-align: center;">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($resMatch as $match): ?>
                                                    <tr>
                                                        <td class="text-muted requete_count"><?php echo $match['title_product']; ?></td>
                                                        <td class="text-muted text-center"><?php echo $match['price_product']; ?></td>
                                                        <td class="text-success text-center"><?php echo $match['category_product']; ?></td>
                                                        <td class="text-danger text-center"><?php echo $match['status_product']; ?></td>
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
    <script src=" https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>

    <!--datatable js-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="assets/js/script.js"></script>

<!--datatable js-->
<script src="assets/js/pages/jquery.dataTables.min.js"></script>
<script src="assets/js/pages/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/pages/dataTables.responsive.min.js"></script>
<script src="assets/js/pages/dataTables.buttons.min.js"></script>

<script src="assets/js/pages/datatables.init.js"></script>
<!-- App js -->
<script src="assets/js/app.js"></script>
</body>

</html>