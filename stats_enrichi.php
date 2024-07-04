<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>



<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Statistique enrichissement')); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>

    <?php include 'partials/head-css.php'; ?>

</head>
<?php require("partials/class/Bdd.php");

//Pour débguer le code
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$bdd = new Bdd();

?>
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
                            <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Statistiques', 'title' => 'Enrichissements')); ?>
                        </div><!--end col-->
                        <div class="col-md-auto ms-auto">
                            <?php include 'partials/customizer.php'; ?>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>

                <div class="row">
                    <div class="col-xxl-12">
                        <div class="row">
                            <div class="col-xxl col-sm-6">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <span class="badge bg-danger-subtle text-danger float-end"><i class="bi bi-file-earmark-arrow-down-fill"></i> </span>

                                        <a href="#"><h5 class="fs-lg mb-1">Total</h5></a>
                                        <p class="text-muted fs-xs mb-4">Journalier</p>
                                        <?php
                                        $requete = "SELECT SUM(CAST(total_item_match AS FLOAT)) as total_journalier FROM stats_enrichis WHERE DATE(date_enrichis) = CURRENT_DATE;";
                                        $results = $bdd->executeQueryRequete($requete, 1);

                                        if( $result = $results->fetch() ) {
                                        $total = $result->total_journalier;
                                        ?>
                                        <h2 class="mb-0"><span class="counter-value" data-target="<?= $total ?>">0</span> <small class="fw-normal text-muted fs-xs"> item(s) enrichi(s)</small></h2>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl col-sm-6">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <span class="badge bg-success-subtle text-success float-end"><i class="bi bi-file-earmark-check-fill"></i></span>

                                        <a href="#"><h5 class="fs-lg mb-1">Total</h5></a>
                                        <p class="text-muted fs-xs mb-4">Item(s) matché(s)</p>
                                        <?php
                                        $requete = "SELECT SUM(CAST(items_match_valid AS FLOAT)) AS total_lignes FROM stats_enrichis";
                                        $results = $bdd->executeQueryRequete($requete, 1);

                                        if( $result = $results->fetch() ) {
                                        $total = $result->total_lignes;
                                        ?>
                                        <h2 class="mb-0"><span class="counter-value" data-target="<?= $total ?>">0</span> <small class="fw-normal text-muted fs-xs"> enrichi(s)</small></h2>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!--end col-->
                            <div class="col-xxl col-sm-6">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <span class="badge bg-info-subtle text-info float-end"><i class="bi bi-arrow-counterclockwise"></i></span>

                                        <a href="#"><h5 class="fs-lg mb-1 bold">Total</h5></a>
                                        <p class="text-muted fs-xs mb-4">B2C</p>
                                        <?php
                                        $requete = "SELECT SUM(CAST(total_item_match AS FLOAT)) AS total_global FROM stats_enrichis where type_campagne = 'b2c'";
                                        $results = $bdd->executeQueryRequete($requete, 1);

                                        if( $result = $results->fetch() ) {
                                            $total = $result->total_global;
                                            ?>
                                            <h2 class="mb-0"><span class="counter-value" data-target="<?= $total ?>">0</span> <small class="fw-normal text-muted fs-xs"> item(s) enrichi(s)</small></h2>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-xxl col-sm-6">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <span class="badge bg-warning-subtle text-warning float-end"><i class="bi bi-filetype-key"></i></span>

                                        <a href="#"><h5 class="fs-lg mb-1">Total</h5></a>
                                        <p class="text-muted fs-xs mb-4">Ligne(s) </p>
                                        <?php
/*                                        $requete = "SELECT SUM(CAST(nbe_ligne_match AS FLOAT)) AS total_lignes FROM stats_enrichis";
                                        $results = $bdd->executeQueryRequete($requete, 1);

                                        if( $result = $results->fetch() ) {
                                         $total = $result->total_lignes;
                                        */?>
                                        <h2 class="mb-0"><span class="counter-value" data-target="<?php /*= $total */?>">0</span><small class="fw-normal text-muted fs-xs"> enrichie(s)</small></h2>
                                   <?php /*} */?>
                                    </div>
                                </div>
                            </div>-->
                            <div class="col-xxl col-sm-6">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <span class="badge bg-info-subtle text-info float-end"><i class="bi bi-arrow-counterclockwise"></i></span>

                                        <a href="#"><h5 class="fs-lg mb-1 bold">Total</h5></a>
                                        <p class="text-muted fs-xs mb-4">B2B</p>
                                        <?php
                                        $requete = "SELECT SUM(CAST(total_item_match AS FLOAT)) AS total_global FROM stats_enrichis where type_campagne = 'b2b'";
                                        $results = $bdd->executeQueryRequete($requete, 1);

                                        if( $result = $results->fetch() ) {
                                        $total = $result->total_global;
                                        ?>
                                        <h2 class="mb-0"><span class="counter-value" data-target="<?= $total ?>">0</span> <small class="fw-normal text-muted fs-xs"> item(s) enrichi(s)</small></h2>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <!--<div class="col-xxl col-sm-6">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <span class="float-end"> </span>
                                        <a href="#"><h5 class="fs-lg mb-1">Total</h5></a>
                                        <p class="text-muted fs-xs mb-4">Clé(s) enrichi(s)</p>
                                        <h4 class="mb-0"><span class="counter-value" data-target="26807.45">0</span> <small class="fw-normal text-muted fs-xs"></small></h4>
                                    </div>
                                </div>
                            </div>--><!--end col-->
                        </div><!--end row-->

                    </div><!--end col-->
                    
                </div><!--end row-->
                

                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="card" id="leadsList">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Enrichissements récents</h4>
                                
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-hover table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted border-top">
                                        <tr>
                                            <th class="sort cursor-pointer" data-sort="coin_name">Fichier</th>
                                            <th class="sort cursor-pointer" data-sort="total_coin">Nbre. initiale </th>
                                            <th class="sort cursor-pointer" data-sort="price">Clé(s)</th> 
                                            <th class="sort cursor-pointer" data-sort="price">Campagne</th>
                                            <th class="sort cursor-pointer" data-sort="24h_change">Item(s) matché(s)</th>
                                            <th class="sort cursor-pointer" data-sort="total_coin" >Ligne(s) matchée(s) </th>
                                            <th class="sort cursor-pointer" data-sort="total_coin">Date </th>
                                            <th >Actions </th>
                                        </tr>
                                        </thead><!-- end thead -->
                                        <tbody class="list">
                                        <?php
                                        $requete = "SELECT * FROM stats_enrichis ORDER BY id DESC";
                                        $results = $bdd->executeQueryRequete($requete, 1);

                                        while( $result = $results->fetch() ) {
                                        $file_path = $result->files;
                                        $file_name = basename($result->files);
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">
                                                        <i class="bi bi-filetype-csv"></i>
                                                    </div>
                                                    <div>
                                                        <a href="#"><h6 class="fs-md mb-0 coin_name"><?= $file_name ?> </h6></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="total_coin"><?= $result->file_volume_initial ?></td>
                                            <td>
                                                <h6 class="total_coin">#<?= $result->type ?>  </h6> 
                                            </td>
                                            <td>
                                                <h6 class="total_coin text-uppercase"><?= $result->type_campagne ?>  </h6>
                                            </td>
                                            <td class="total_coin"> <?= $result->items_match_name_valid ?>   <a href="#"> <i class="bi bi-info-circle-fill " title=" <?= $result->items_match_valid ?> "></i> <?= $result->total_item_match != "" ? "(". number_format($result->total_item_match) . ")" : "" ?>  </a></td>
                                            <td class="total_coin"><?= $result->nbe_ligne_match ?></td>
                                            <td class="total_coin" ><?php
                                            echo $result->date_enrichis ?>
                                            </td>
                                            <td><a href="<?= $file_path ?>" class="btn btn-md btn-subtle-primary"> <i class="bi bi-download"></i> Telecharger le fichier</a></td>
                                        </tr><!-- end -->
                                        </tbody><!-- end tbody -->
                                        <?php } ?>
                                    </table><!-- end table -->
                                </div>
                                <div class="align-items-center mt-4 pt-2 row">
                                    <div class="col-sm">
                                        <div class="text-muted text-center text-sm-start">
                                            Affichage <span class="fw-semibold">05</span> des <span class="fw-semibold">07</span> Résultats
                                        </div>
                                    </div>
                                    <div class="col-sm-auto mt-3 mt-sm-0">
                                        <div class="pagination-wrap pagination-sm hstack gap-2 justify-content-center">
                                            <a class="page-item pagination-prev disabled" href="#!">
                                                <i class="bi bi-arrow-left"></i>
                                            </a>
                                            <ul class="pagination listjs-pagination mb-0"></ul>
                                            <a class="page-item pagination-next" href="#!">
                                                <i class="bi bi-arrow-right"></i>
                                            </a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment-with-locales.min.js" integrity="sha512-vFABRuf5oGUaztndx4KoAEUVQnOvAIFs59y4tO0DILGWhQiFnFHiR+ZJfxLDyJlXgeut9Z07Svuvm+1Jv89w5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- list js-->
<script src="assets/libs/list.js/list.min.js"></script>
<script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!--dashboard crm init js-->
<script src="assets/js/pages/dashboard-crypto.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>
</body>

</html>
