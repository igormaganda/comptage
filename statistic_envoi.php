<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php 

require("partials/class/Bdd.php"); 
require("partials/class/StatistAppel.php"); 

    /*
        DEBUGER LE CODE PHP
    */ 
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    $bdd = new Bdd();

    $bd = $bdd->connect(); 
    
    $statsManager = new StatistAppel($bd);

    $dstart = $_POST['dstart'] ?? null;
    $dend = $_POST['dend'] ?? null;
    $account = $_POST['account'] ?? null;
    
    $resData = $statsManager->getStats($dstart, $dend, $account);
    $resTab = $statsManager->getOrders($dstart, $dend, $account);
    $resEmail = $statsManager->getDistinctEmails();
    $resGraph = $statsManager->getGraphData($dstart, $dend, $account);
    
    $dated = $count = $campages = $revenus = [];
    
    foreach ($resGraph as $row) {
        $dated[] = $row['date_group'];
        $count[] = (int)$row['stats_count'];
        $campages[] = (int)$row['stats_campagnes'];
        $revenus[] = (int)$row['stats_revenus'];
    }
    
    $count_json = json_encode($count);
    $campages_json = json_encode($campages);
    $revenus_json = json_encode($revenus);
    $date_json = json_encode($dated);

?>

<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Statistiques')); ?>

    <!-- jsvectormap css -->
    
<!--datatable css-->

    <?php include 'partials/head-css.php'; ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" >
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" >

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Statistiques', 'title' => 'Appel')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-5">
                                    <div class="text-center">
                                        <p class="text-muted fs-md"></p>
                                    </div>
                                </div>
                            </div>
                            
                            <form action="#" method="post">
                                <div class="row gy-1 align-items-center justify-content-center">
                                    <div class="col-lg-3">
                                        <label for="datestart" class="form-label">Date début</label>
                                        <input type="date" class="form-control" name="dstart" id="dstart" >
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="dend" class="form-label">Date Fin</label>
                                        <input type="date" class="form-control" name="dend" id="dend" >
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="account" class="form-label">Compte</label>
                                        <select class="form-select" aria-label="Default select example" name="account" id="account">
                                            <option selected>Sélectionnez</option>
                                            <?php foreach($resEmail as $resmail): ?>
                                            <option value="<?= $resmail['stats_email'] ?>"><?= $resmail['stats_email'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary" id="twodate">Valider</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-warning overflow-hidden">
                                <div class="position-absolute top-0 right-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="350" height="200" preserveAspectRatio="none" viewBox="0 0 350 200">
                                        <g mask="url(&quot;#SvgjsMask1046&quot;)" fill="none">
                                            <path d="M385.59 13.35C356.64 14.32 333.88 59.69 279.23 59.35 224.58 59.01 208.1-30.2 172.87-37" style="stroke: rgba(var(--tb-white-rgb), 0.14);" stroke-width="2"></path>
                                            <path d="M397.1 120.72C352.81 118.98 323.8 49.73 235.97 46.72 148.15 43.71 118.4-18.41 74.85-19.7" style="stroke: rgba(var(--tb-white-rgb), 0.14);" stroke-width="2"></path>
                                            <path d="M353.25 33.52C326.55 35.03 307.47 83.9 258.67 83.52 209.87 83.14 197.14-6.35 164.09-14.66" style="stroke: rgba(var(--tb-white-rgb), 0.14);" stroke-width="2"></path>
                                            <path d="M385.3 171.91C344.67 169.99 308.53 110.04 239.41 99.91 170.28 89.78 195.34 10.2 166.46-1.88" style="stroke: rgba(var(--tb-white-rgb), 0.14);" stroke-width="2"></path>
                                            <path d="M360.8 147.25C313.76 146.8 258.96 103.74 179.4 97.25 99.84 90.76 123.43-6.99 88.7-19.8" style="stroke: rgba(var(--tb-white-rgb), 0.14);" stroke-width="2"></path>
                                        </g>
                                        <defs>
                                            <mask id="SvgjsMask1046">
                                                <rect width="350" height="200" fill="#ffffff"></rect>
                                            </mask>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="card-body">
                                    <p class="fs-lg text-reset mb-4">Comptages</p>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="display-6 mb-3">
                                                <i class="bi bi-arrow-repeat"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-7 mt-3">
                                            <h5 class="text-reset fw-medium mb-0"><?= number_format($resData['sum_count'], 0, ',', ' ');  ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl-2 col-sm-6">
                            <div class="card card-primary overflow-hidden">
                                <div class="position-absolute top-0 right-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="350" height="200" preserveAspectRatio="none" viewBox="0 0 350 200">
                                        <g mask="url(&quot;#SvgjsMask1046&quot;)" fill="none">
                                            <path d="M385.59 13.35C356.64 14.32 333.88 59.69 279.23 59.35 224.58 59.01 208.1-30.2 172.87-37" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M397.1 120.72C352.81 118.98 323.8 49.73 235.97 46.72 148.15 43.71 118.4-18.41 74.85-19.7" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M353.25 33.52C326.55 35.03 307.47 83.9 258.67 83.52 209.87 83.14 197.14-6.35 164.09-14.66" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M385.3 171.91C344.67 169.99 308.53 110.04 239.41 99.91 170.28 89.78 195.34 10.2 166.46-1.88" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M360.8 147.25C313.76 146.8 258.96 103.74 179.4 97.25 99.84 90.76 123.43-6.99 88.7-19.8" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                        </g>
                                        <defs>
                                            <mask id="SvgjsMask1046">
                                                <rect width="350" height="200" fill="#ffffff"></rect>
                                            </mask>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="card-body">
                                    <p class="fs-lg text-reset mb-4">Campagnes</p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="display-6 mb-3">
                                                <i class="ph-buildings-thin"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-7 mt-3">
                                            <h5 class="text-reset fw-medium mb-0"><?= number_format($resData['sum_camp'], 0, ',', ' ');  ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl-2 col-sm-6">
                            <div class="card card-success overflow-hidden">
                                <div class="position-absolute top-0 right-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="350" height="200" preserveAspectRatio="none" viewBox="0 0 350 200">
                                        <g mask="url(&quot;#SvgjsMask1046&quot;)" fill="none">
                                            <path d="M385.59 13.35C356.64 14.32 333.88 59.69 279.23 59.35 224.58 59.01 208.1-30.2 172.87-37" style="stroke: rgba(var(--tb-white-rgb), 0.1);" stroke-width="2"></path>
                                            <path d="M397.1 120.72C352.81 118.98 323.8 49.73 235.97 46.72 148.15 43.71 118.4-18.41 74.85-19.7" style="stroke: rgba(var(--tb-white-rgb), 0.1);" stroke-width="2"></path>
                                            <path d="M353.25 33.52C326.55 35.03 307.47 83.9 258.67 83.52 209.87 83.14 197.14-6.35 164.09-14.66" style="stroke: rgba(var(--tb-white-rgb), 0.1);" stroke-width="2"></path>
                                            <path d="M385.3 171.91C344.67 169.99 308.53 110.04 239.41 99.91 170.28 89.78 195.34 10.2 166.46-1.88" style="stroke: rgba(var(--tb-white-rgb), 0.1);" stroke-width="2"></path>
                                            <path d="M360.8 147.25C313.76 146.8 258.96 103.74 179.4 97.25 99.84 90.76 123.43-6.99 88.7-19.8" style="stroke: rgba(var(--tb-white-rgb), 0.1);" stroke-width="2"></path>
                                        </g>
                                        <defs>
                                            <mask id="SvgjsMask1046">
                                                <rect width="350" height="200" fill="#ffffff"></rect>
                                            </mask>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="card-body">
                                    <p class="fs-lg text-reset mb-4">Contacts</p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="display-6 mb-3">
                                                <i class="bi bi-person-lines-fill"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-7 mt-3">
                                            <h5 class="text-reset fw-medium mb-0"><?= number_format($resData['sum_cont'], 0, ',', ' ');  ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl-2 col-sm-6">
                            <div class="card card-secondary overflow-hidden">
                                <div class="position-absolute top-0 right-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="350" height="200" preserveAspectRatio="none" viewBox="0 0 350 200">
                                        <g mask="url(&quot;#SvgjsMask1046&quot;)" fill="none">
                                            <path d="M385.59 13.35C356.64 14.32 333.88 59.69 279.23 59.35 224.58 59.01 208.1-30.2 172.87-37" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M397.1 120.72C352.81 118.98 323.8 49.73 235.97 46.72 148.15 43.71 118.4-18.41 74.85-19.7" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M353.25 33.52C326.55 35.03 307.47 83.9 258.67 83.52 209.87 83.14 197.14-6.35 164.09-14.66" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M385.3 171.91C344.67 169.99 308.53 110.04 239.41 99.91 170.28 89.78 195.34 10.2 166.46-1.88" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M360.8 147.25C313.76 146.8 258.96 103.74 179.4 97.25 99.84 90.76 123.43-6.99 88.7-19.8" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                        </g>
                                        <defs>
                                            <mask id="SvgjsMask1046">
                                                <rect width="350" height="200" fill="#ffffff"></rect>
                                            </mask>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="card-body">
                                    <p class="fs-lg text-reset mb-4">Revenus</p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="display-6 mb-3">
                                                <i class="bi bi-currency-exchange"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-7 mt-3">
                                            <h5 class="text-reset fw-medium mb-0"><?= number_format($resData['sum_reven'], 0, ',', ' ');  ?> €</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-danger overflow-hidden">
                                <div class="position-absolute top-0 right-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="350" height="200" preserveAspectRatio="none" viewBox="0 0 350 200">
                                        <g mask="url(&quot;#SvgjsMask1046&quot;)" fill="none">
                                            <path d="M385.59 13.35C356.64 14.32 333.88 59.69 279.23 59.35 224.58 59.01 208.1-30.2 172.87-37" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M397.1 120.72C352.81 118.98 323.8 49.73 235.97 46.72 148.15 43.71 118.4-18.41 74.85-19.7" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M353.25 33.52C326.55 35.03 307.47 83.9 258.67 83.52 209.87 83.14 197.14-6.35 164.09-14.66" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M385.3 171.91C344.67 169.99 308.53 110.04 239.41 99.91 170.28 89.78 195.34 10.2 166.46-1.88" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M360.8 147.25C313.76 146.8 258.96 103.74 179.4 97.25 99.84 90.76 123.43-6.99 88.7-19.8" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                        </g>
                                        <defs>
                                            <mask id="SvgjsMask1046">
                                                <rect width="350" height="200" fill="#ffffff"></rect>
                                            </mask>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="card-body">
                                    <p class="fs-lg text-reset mb-4">Charges</p>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="display-6 mb-3">
                                                <i class="bi bi-clipboard-data"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-9 mt-3">
                                            <h5 class="text-reset fw-medium mb-0"><?= number_format($resData['sum_charge'], 0, ',', ' ');  ?> €</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Graphique de comptage</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div id="line_chart_dashed" data-colors='["--tb-primary", "--tb-danger", "--tb-success"]' class="apex-charts" dir="ltr"></div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-lg-12">
                            <div class="card overflow-hidden">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Tableau récapulative</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-lg-12">
                                            <table id="fixed-header" class="table table-bordered dt-responsive nowrap table-striped align-middle">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col" style="text-align: center;">B2</th>
                                                        <th scope="col" style="text-align: center;">Dates</th>
                                                        <th scope="col" style="text-align: center;">Log uuid</th>
                                                        <th scope="col" style="text-align: center;">Comptes</th>
                                                        <th scope="col" style="text-align: center;">Type</th>
                                                        <th scope="col" style="text-align: center;">Volume</th>
                                                        <th scope="col" style="text-align: center;">Revenus</th>
                                                        <th style="text-align: center;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($resTab as $rTab): ?>
                                                    <tr>
                                                        <td class="text-muted" style="text-align: center;"><?= $rTab['type'] ?></td>
                                                        <td class="text-muted" style="text-align: center;"><?= $rTab['order_date'] ?></td>
                                                        <td class="text-success" style="text-align: center;"><?= $rTab['api_token'] ?></td>
                                                        <td class="text-muted" style="text-align: center;"><?= $rTab['email'] ?></td>
                                                        <td class="text-muted" style="text-align: center;"><?= $rTab['type_appel'] ?></td>
                                                        <td class="text-muted" style="text-align: center;"><?= $rTab['volume_appel'] ?></td>
                                                        <td class="text-muted" style="text-align: center;"><?= $rTab['total_price'] ?></td>
                                                        
                                                        <td style="text-align: center;">
                                                            <div class="dropdown d-inline-block">
                                                                <button class="btn btn-subtle-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill align-middle"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                                                    <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                                                    <li>
                                                                        <a class="dropdown-item remove-item-btn">
                                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
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
    
    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="assets/js/pages/jquery.dataTables.min.js"></script>
    <script src="assets/js/pages/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/pages/dataTables.responsive.min.js"></script>
    <script src="assets/js/pages/dataTables.buttons.min.js"></script>

    <script src="assets/js/pages/datatables.init.js"></script>
        <!-- linecharts init -->
        <script>
    
    const datesJSON = '<?php echo $date_json; ?>';

    const dates = JSON.parse(datesJSON);

    console.log(dates)

    const datesFormatees = dates.map(date => {
        const dateObj = new Date(date);
        const jour = ('0' + dateObj.getDate()).slice(-2);
        const mois = moisToString(dateObj.getMonth());
        return `${jour} ${mois}`;
    });

    function moisToString(mois) {
        const nomsMois = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
        return nomsMois[mois];
    }

    function getChartColorsArray(chartId) {
        const chartElement = document.getElementById(chartId);
        if (chartElement) {
            const colors = chartElement.dataset.colors;
            if (colors) {
                const parsedColors = JSON.parse(colors);
                const mappedColors = parsedColors.map((value) => {
                    const newValue = value.replace(/\s/g, "");
                    if (!newValue.includes(",")) {
                        const color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                        return color || newValue;
                    } else {
                        const val = value.split(",");
                        if (val.length === 2) {
                            const rgbaColor = `rgba(${getComputedStyle(document.documentElement).getPropertyValue(val[0])}, ${val[1]})`;
                            return rgbaColor;
                        } else {
                            return newValue;
                        }
                    }
                });
                return mappedColors;
            } else {
                console.warn(`data-colors attribute not found on: ${chartId}`);
            }
        }
    }
    var linechartDashedChart = "";
function loadCharts() {
     var linechartDashedColors = "";
    linechartDashedColors = getChartColorsArray("line_chart_dashed");
    if (linechartDashedColors) {
        var options = {
            chart: {
                height: 380,
                type: 'line',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false,
                }
            },
            colors: linechartDashedColors,
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [3, 4, 3],
                curve: 'straight',
                dashArray: [0, 8, 5]
            },
            series: [{
                name: "Revenus",
                data: <?php echo $revenus_json; ?>
            },
            {
                name: "Campagnes",
                data: <?php echo $campages_json; ?>
            },
            {
                name: 'Comptages',
                data: <?php echo $count_json; ?>
            }
            ],
            title: {
                text: 'Graphique Nettoyage',
                align: 'left',
                style: {
                    fontWeight: 500,
                },
            },
            markers: {
                size: 0,

                hover: {
                    sizeOffset: 6
                }
            },
            xaxis: {
                categories: datesFormatees,
            },
            tooltip: {
                y: [{
                    title: {
                        formatter: function (val) {
                            return val + " :"
                        }
                    }
                }, {
                    title: {
                        formatter: function (val) {
                            return val + " :"
                        }
                    }
                }, {
                    title: {
                        formatter: function (val) {
                            return val + " :";
                        }
                    }
                }]
            },
            grid: {
                borderColor: '#f1f1f1',
            }
        }

        if (linechartDashedChart != "")
            linechartDashedChart.destroy();
        linechartDashedChart = new ApexCharts(document.querySelector("#line_chart_dashed"), options);
        linechartDashedChart.render();
    }
}
window.addEventListener("resize", function () {
    setTimeout(() => {
        loadCharts();
    }, 250);
});
loadCharts();
</script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>