<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php require("partials/class/Bdd.php"); ?>
<?php require("partials/class/Search_b2c.php");
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
	<!-- Modal -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Resultats des recherches b2c</h5>
                                </div>
                                <div class="card-body">
                                    <div id="content">
                                      
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

    <script src="assets/js/pages/datatables.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>