<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php
require_once("partials/class/Bdd.php");
$graph = true;
$home = true;


$bdd = new Bdd();

$home1 = "SELECT * FROM home1 ORDER BY id DESC LIMIT 2";
$recupHome1   = $bdd->executeQueryRequete($home1, 1);

$tour = 1;
while ($item = $recupHome1->fetch()) {
    if ($tour == 1) {
        $fullbase    = $item->fullbase;
        $email       = $item->email;
        $blacklist   = $item->blacklist;
        $domaines    = $item->domaines;
        $hommes      = $item->hommes;
        $dames       = $item->dames;
        $demoiselles = $item->demoiselles;
        $btoc        = $item->btoc;
        $btob        = $item->btob;
        $sb          = $item->sb;
        $hb          = $item->hb;
        $st          = $item->st;
        $unsub       = $item->unsub;
    } else {
        $fullbase2    = $fullbase - $item->fullbase;
        $email2       = $email - $item->email;
        $blacklist2   = $blacklist - $item->blacklist;
        $domaines2    = $domaines - $item->domaines;
        $hommes2      = $hommes - $item->hommes;
        $dames2       = $dames - $item->dames;
        $demoiselles2 = $demoiselles - $item->demoiselles;
        $btoc2        = $btoc - $item->btoc;
        $btob2        = $btob - $item->btob;
        $sb2          = $sb - $item->sb;
        $hb2          = $hb - $item->hb;
        $st2          = $st - $item->st;
        $unsub2       = $unsub - $item->unsub;
    }
    $tour++;
}

if ($fullbase == 0) $fullbase = 1;

/**
 * 
 * Requête b2b, b2c
 * 
 */
$bd = $bdd->connect();

$res = "SELECT COUNT(DISTINCT emailpro) AS emailpro, COUNT(DISTINCT mobilepro) AS mobilpro FROM b2b";
$sum_b2b = $bd->query($res)->fetch(PDO::FETCH_ASSOC);

if ($sum_b2b) {
    $mailpro = $sum_b2b['emailpro'];
    $mobilepro = $sum_b2b['mobilpro'];

    $mailpro_json = json_encode($mailpro);
    $mobilepro_json = json_encode($mobilepro);
} else {
}

$res = "SELECT COUNT(DISTINCT email) AS mail_pers, COUNT(DISTINCT tel_mobile) AS telmobil FROM b2c";
$sum_b2c = $bd->query($res)->fetch(PDO::FETCH_ASSOC);

if ($sum_b2c) {
    $mailpers = $sum_b2c['mail_pers'];
    $mobilepers = $sum_b2c['telmobil'];

    $mailpers_json = json_encode($mailpers);
    $mobilepers_json = json_encode($mobilepers);
} else {
}

$res = "SELECT DISTINCT country, (COUNT(DISTINCT emailpro) / COUNT(DISTINCT mobilepro)) AS topb2b FROM b2b GROUP BY country ORDER BY topb2b DESC LIMIT 12";
$topb2b = $bd->query($res)->fetchAll(PDO::FETCH_ASSOC);

foreach ($topb2b as $print_top) :
    // $print_top['country'];
    // $print_top['topb2b'];

    $top_country[] = $print_top['country'];
    $top_valeurs[] = $print_top['topb2b'];
endforeach;

//affichage dans le graphe
$reqGrap = "SELECT DISTINCT country, (COUNT(*)) AS topb2b FROM b2b GROUP BY country ORDER BY topb2b DESC LIMIT 12";
$graphTop = $bd->query($reqGrap)->fetchAll(PDO::FETCH_ASSOC);

foreach ($graphTop as $print_top) :
    // $print_top['country'];
    // $print_top['topb2b'];

    $top_country_graph[] = $print_top['country'];
    $top_valeurs_graph[] = $print_top['topb2b'];
endforeach;
$top_country_json = json_encode($top_country_graph);
$top_valeurs_json = json_encode($top_valeurs_graph);

$resb2c = "SELECT DISTINCT pays, (COUNT(DISTINCT email) / COUNT(DISTINCT tel_mobile)) AS topb2c FROM b2c GROUP BY pays ORDER BY topb2c DESC LIMIT 12";
$topb2c = $bd->query($resb2c)->fetchAll(PDO::FETCH_ASSOC);
foreach ($topb2c as $print_top) :
    // $print_top['country'];
    // $print_top['topb2b'];

    $top_pays[] = $print_top['pays'];
    $top_valeurs_pays[] = $print_top['topb2c'];
endforeach;

//affichage dans le graphe
$reqGrapb2c = "SELECT DISTINCT pays, (COUNT(*)) AS topb2c FROM b2c GROUP BY pays ORDER BY topb2c DESC LIMIT 12";
$topGraph = $bd->query($reqGrapb2c)->fetchAll(PDO::FETCH_ASSOC);
foreach ($topGraph as $print_top) :
    // $print_top['country'];
    // $print_top['topb2b'];

    $top_pays_graph[] = $print_top['pays'];
    $top_valeurs_pays_graph[] = $print_top['topb2c'];
endforeach;

$top_pays_json = json_encode($top_pays_graph);
$top_valeurs_pays_json = json_encode($top_valeurs_pays_graph);

//TOP X DES COMMANDES API
$req_cmd_api = "SELECT total_price, email, type_appel, volume_appel FROM order_api WHERE TO_DATE(order_date, 'YYYY-MM-DD') >= CURRENT_DATE - INTERVAL '30 days' ORDER BY total_price DESC";
$cmd_api = $bd->query($req_cmd_api)->fetchAll(PDO::FETCH_ASSOC);

// CHIFFRE D'AFFAIRE COMPARAISON (diagramme)
$req_ca_b2b = "SELECT EXTRACT(MONTH FROM date_ca) AS mois, SUM(vol_camp * gain) AS somme_multiplications FROM chiff_aff WHERE type_b2 = 'b2b' GROUP BY EXTRACT(MONTH FROM date_ca) ORDER BY mois ;";
//remettre une condition
$query_ca_b2b = $bd->query($req_ca_b2b);
$result_b2b = $query_ca_b2b->fetchAll(PDO::FETCH_ASSOC);
$sommes_b2b = [];
foreach ($result_b2b as $somme) {
    $sommes_b2b[] = intval($somme['somme_multiplications']);
}
$req_ca_b2c = "SELECT EXTRACT(MONTH FROM date_ca) AS mois, SUM(vol_camp * gain) AS somme_multiplications FROM chiff_aff WHERE type_b2 = 'b2c' GROUP BY EXTRACT(MONTH FROM date_ca) ORDER BY mois ;";
//remettre une condition
$query_ca_b2c = $bd->query($req_ca_b2c);
$result_b2c = $query_ca_b2c->fetchAll(PDO::FETCH_ASSOC);
$sommes_b2c = [];
foreach ($result_b2c as $somme) {
    $sommes_b2c[] = intval($somme['somme_multiplications']);
}

?>

<head>
    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Tableau de bord')); ?>

    <link rel="stylesheet" href="assets/libs/nouislider/nouislider.min.css">
    <!-- Sweet Alert css-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- dropzone css -->
    <link href="assets/libs/dropzone/dropzone.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="assets/libs/multi.js/multi.min.css">
    <!-- autocomplete css -->
    <link rel="stylesheet" href="assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css">

    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <?php include 'partials/head-css.php'; ?>

</head>

<script defer src="/<?php echo $path; ?>/assets/js/apexcharts.js"></script>

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
                        <div class="row align-items-center gy-3">
                            <div class="col-md">
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Accueil', 'title' => 'Tableau de bord')); ?>
                            </div><!--end col-->
                            <div class="col-md-auto ms-auto">
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-xl col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="card-title mb-0 flex-grow-1">Total B2C:</h4>
                                        <p class="text-primary mb-0"><?php echo number_format($btoc, 0, "", " "); ?></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <h6 class="fs-md mb-0 flex-grow-1">Email:</h6>
                                        <p class="text-secondary mb-0"><?php echo number_format($mailpers, 0, "", " "); ?></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="fs-md mb-0 flex-grow-1">Mobile:</h6>
                                        <p class="text-secondary mb-0"> <?php echo number_format($mobilepers, 0, "", " "); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-xl col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="card-title mb-0 flex-grow-1">Total B2B:</h4>
                                        <p class="text-secondary mb-0"><?php echo number_format($btob, 0, "", " "); ?></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <h6 class="fs-md mb-0 flex-grow-1">Email:</h4>
                                            <p class="text-primary mb-0"> <?php echo number_format($mailpro, 0, "", " "); ?></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="fs-md mb-0 flex-grow-1">Mobile:</h6>
                                        <p class="text-primary mb-0"> <?php echo number_format($mobilepro, 0, "", " "); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-xl col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="card-title mb-0 flex-grow-1">Total CA:</h4>
                                        <p class="text-info mb-0">4501250</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <h6 class="fs-md mb-0 flex-grow-1">API:</h6>
                                        <p class="text-info mb-0">201250</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="fs-md mb-0 flex-grow-1">Affiliation:</h6>
                                        <p class="text-info mb-0">112450</p>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-xl col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="card-title mb-0 flex-grow-1">Total Envoyé:</h4>
                                        <p class="text-success mb-0"><?php echo (number_format($btoc, 0, "", " ") + number_format($btob, 0, "", " ")); ?></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <h6 class="fs-md mb-0 flex-grow-1">B2C:</h6>
                                        <p class="text-success mb-0"><?php echo number_format($btoc, 0, "", " "); ?></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="fs-md mb-0 flex-grow-1">B2B:</h6>
                                        <p class="text-success mb-0"><?php echo number_format($btob, 0, "", " "); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->


                    </div><!--end row-->

                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card" id="chart">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">C.A Affiliation sur la période actuelle vs la période précédente</h4>
                                    <div class="toolbar">
                                        <button id="one_month" type="button" class="btn btn-sm btn-subtle-secondary">1M</button>
                                        <button id="three_months" type="button" class="btn btn-sm btn-subtle-secondary">3M</button>
                                        <button id="six_months" type="button" class="btn btn-sm btn-subtle-secondary active">6M</button>
                                        <button id="all" type="button" class="btn btn-sm btn-subtle-secondary">ALL</button>
                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body ps-1">
                                    <div>
                                        <div id="revenue_overview" data-colors='["--tb-primary", "--tb-info"]' class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h6 class="card-title mb-0 flex-grow-1">Stock Market</h6>
                                    <div class="flex-shrink-0">
                                        <div class="nav nav-pills gap-1" id="popularProperty" role="tablist" aria-orientation="vertical">
                                            <button class="btn btn-ghost-success btn-sm active" id="stockMarketActive" data-bs-toggle="pill" data-bs-target="#stockMarketActiveTabs" type="button" role="tab" aria-controls="stockMarketActiveTabs" aria-selected="true">Active</button>
                                            <button class="btn btn-ghost-secondary btn-sm" id="stockMarketGainers" data-bs-toggle="pill" data-bs-target="#stockMarketGainersTabs" type="button" role="tab" aria-controls="stockMarketGainersTabs" aria-selected="false" tabindex="-1">Gainers</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="popularPropertyContent">
                                        <div class="tab-pane show active" id="stockMarketActiveTabs" role="tabpanel" aria-labelledby="stockMarketActive" tabindex="0">
                                            <div id="stock_market_active" data-colors='["--tb-primary"]' class="apex-charts" dir="ltr"></div>
                                            <ul class="list-group list-group-none mb-0 mt-2">
                                                <li class="list-group-item list-group-item-action list-group-item-light">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.html">
                                                                <h6 class="mb-1">ETC</h6>
                                                            </a>
                                                            <p class="text-muted mb-0">Ethereum Classic</p>
                                                        </div>
                                                        <div class="flex-shrink-0 text-end">
                                                            <h6 class="mb-1">$16.90</h6>
                                                            <p class="fs-xs mb-0"><span class="text-success me-1">0.45</span> <span class="text-success">-2.65%</span></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item list-group-item-action">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.html">
                                                                <h6 class="mb-1">NEO</h6>
                                                            </a>
                                                            <p class="text-muted mb-0">NEO Cryptocurrency</p>
                                                        </div>
                                                        <div class="flex-shrink-0 text-end">
                                                            <h6 class="mb-1">$8.91</h6>
                                                            <p class="fs-xs mb-0"><span class="text-danger me-1">-0.59</span> <span class="text-danger">-6.32%</span></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item list-group-item-action">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.html">
                                                                <h6 class="mb-1">MKR</h6>
                                                            </a>
                                                            <p class="text-muted mb-0">Maker Cryptocurrency</p>
                                                        </div>
                                                        <div class="flex-shrink-0 text-end">
                                                            <h6 class="mb-1">$621.00</h6>
                                                            <p class="fs-xs mb-0"><span class="text-danger me-1">-16</span> <span class="text-danger">-2.51%</span></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item list-group-item-action">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.html">
                                                                <h6 class="mb-1">ZEC</h6>
                                                            </a>
                                                            <p class="text-muted mb-0">Zcash Cryptocurrency</p>
                                                        </div>
                                                        <div class="flex-shrink-0 text-end">
                                                            <h6 class="mb-1">$28.70</h6>
                                                            <p class="fs-xs mb-0"><span class="text-success me-1">1.2</span> <span class="text-success">4.01%</span></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item list-group-item-action">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.html">
                                                                <h6 class="mb-1">QNT</h6>
                                                            </a>
                                                            <p class="text-muted mb-0">Qaunt Cryptocurrency</p>
                                                        </div>
                                                        <div class="flex-shrink-0 text-end">
                                                            <h6 class="mb-1">$110.80</h6>
                                                            <p class="fs-xs mb-0"><span class="text-danger me-1">-5.7</span> <span class="text-danger">-4.90%</span></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="stockMarketGainersTabs" role="tabpanel" aria-labelledby="stockMarketGainers" tabindex="0">
                                            <div id="stock_market_gainers" data-colors='["--tb-secondary"]' class="apex-charts" dir="ltr"></div>
                                            <ul class="list-group list-group-none mb-0 mt-2">
                                                <li class="list-group-item list-group-item-action list-group-item-light">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.html">
                                                                <h6 class="mb-1">BNB</h6>
                                                            </a>
                                                            <p class="text-muted mb-0">BNB Cryptocurrency</p>
                                                        </div>
                                                        <div class="flex-shrink-0 text-end">
                                                            <h6 class="mb-1">$260.70</h6>
                                                            <p class="fs-xs mb-0"><span class="text-danger me-1">-2.3</span> <span class="text-danger">-6.56%</span></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item list-group-item-action">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.html">
                                                                <h6 class="mb-1">XMR</h6>
                                                            </a>
                                                            <p class="text-muted mb-0">Monero Cryptocurrency</p>
                                                        </div>
                                                        <div class="flex-shrink-0 text-end">
                                                            <h6 class="mb-1">$144.60</h6>
                                                            <p class="fs-xs mb-0"><span class="text-success me-1">0.47</span> <span class="text-success">1.57%</span></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item list-group-item-action">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.html">
                                                                <h6 class="mb-1">QNT</h6>
                                                            </a>
                                                            <p class="text-muted mb-0">Qaunt Cryptocurrency</p>
                                                        </div>
                                                        <div class="flex-shrink-0 text-end">
                                                            <h6 class="mb-1">$110.80</h6>
                                                            <p class="fs-xs mb-0"><span class="text-danger me-1">-5.7</span> <span class="text-danger">-4.90%</span></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item list-group-item-action">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.html">
                                                                <h6 class="mb-1">EGLD</h6>
                                                            </a>
                                                            <p class="text-muted mb-0">MultiversX Cryptocurrency</p>
                                                        </div>
                                                        <div class="flex-shrink-0 text-end">
                                                            <h6 class="mb-1">$34.87</h6>
                                                            <p class="fs-xs mb-0"><span class="text-danger me-1">-1.51</span> <span class="text-danger">-4.15%</span></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item list-group-item-action">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <a href="apps-crypto-coin-overview.html">
                                                                <h6 class="mb-1">NEO</h6>
                                                            </a>
                                                            <p class="text-muted mb-0">NEO Cryptocurrency</p>
                                                        </div>
                                                        <div class="flex-shrink-0 text-end">
                                                            <h6 class="mb-1">$8.91</h6>
                                                            <p class="fs-xs mb-0"><span class="text-danger me-1">-0.59</span> <span class="text-danger">-6.32%</span></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h6 class="card-title mb-0 flex-grow-1">Tableau des gains affiliation répartis par pays et par thématique</h6>
                                    <div class="flex-shrink-0">
                                        <a href="#!" class="btn btn-sm btn-subtle-primary icon-link">View More <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card mb-0">
                                        <table class="table table-bordered align-middle mb-0 text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <?php foreach ($topb2b as $print_top) : ?>
                                                        <th class="bg-light" scope="col"><img src="`/<?php echo $path; ?>/assets/images/flags/${item.value.toUpperCase()}.svg`" height="16" alt="" class="rounded-circle me-1"><?= $print_top['country']; ?></th>
                                                    <?php endforeach ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Thematic 1</td>
                                                    <td>Data 1.1</td>
                                                    <td>Data 1.2</td>
                                                    <td>Data 1.3</td>
                                                    <td>Data 1.4</td>
                                                    <td>Data 1.5</td>
                                                    <td>Data 1.6</td>
                                                    <td>Data 1.7</td>
                                                    <td>Data 1.8</td>
                                                    <td>Data 1.9</td>
                                                    <td>Data 1.10</td>
                                                    <td>Data 1.11</td>
                                                    <td>Data 1.12</td>
                                                </tr>
                                                <tr>
                                                    <td>Thematic 2</td>
                                                    <td>Data 2.1</td>
                                                    <td>Data 2.2</td>
                                                    <td>Data 2.3</td>
                                                    <td>Data 2.4</td>
                                                    <td>Data 2.5</td>
                                                    <td>Data 2.6</td>
                                                    <td>Data 2.7</td>
                                                    <td>Data 2.8</td>
                                                    <td>Data 2.9</td>
                                                    <td>Data 2.10</td>
                                                    <td>Data 2.11</td>
                                                    <td>Data 2.12</td>
                                                </tr>
                                                <tr>
                                                    <td>Thematic 3</td>
                                                    <td>Data 3.1</td>
                                                    <td>Data 3.2</td>
                                                    <td>Data 3.3</td>
                                                    <td>Data 3.4</td>
                                                    <td>Data 3.5</td>
                                                    <td>Data 3.6</td>
                                                    <td>Data 3.7</td>
                                                    <td>Data 3.8</td>
                                                    <td>Data 3.9</td>
                                                    <td>Data 3.10</td>
                                                    <td>Data 3.11</td>
                                                    <td>Data 3.12</td>
                                                </tr>
                                                <tr>
                                                    <td>Thematic 4</td>
                                                    <td>Data 4.1</td>
                                                    <td>Data 4.2</td>
                                                    <td>Data 4.3</td>
                                                    <td>Data 4.4</td>
                                                    <td>Data 4.5</td>
                                                    <td>Data 4.6</td>
                                                    <td>Data 4.7</td>
                                                    <td>Data 4.8</td>
                                                    <td>Data 4.9</td>
                                                    <td>Data 4.10</td>
                                                    <td>Data 4.11</td>
                                                    <td>Data 4.12</td>
                                                </tr>
                                                <tr>
                                                    <td>Thematic 5</td>
                                                    <td>Data 5.1</td>
                                                    <td>Data 5.2</td>
                                                    <td>Data 5.3</td>
                                                    <td>Data 5.4</td>
                                                    <td>Data 5.5</td>
                                                    <td>Data 5.6</td>
                                                    <td>Data 5.7</td>
                                                    <td>Data 5.8</td>
                                                    <td>Data 5.9</td>
                                                    <td>Data 5.10</td>
                                                    <td>Data 5.11</td>
                                                    <td>Data 5.12</td>
                                                </tr>
                                                <tr>
                                                    <td>Thematic 6</td>
                                                    <td>Data 6.1</td>
                                                    <td>Data 6.2</td>
                                                    <td>Data 6.3</td>
                                                    <td>Data 6.4</td>
                                                    <td>Data 6.5</td>
                                                    <td>Data 6.6</td>
                                                    <td>Data 6.7</td>
                                                    <td>Data 6.8</td>
                                                    <td>Data 6.9</td>
                                                    <td>Data 6.10</td>
                                                    <td>Data 6.11</td>
                                                    <td>Data 6.12</td>
                                                </tr>
                                                <tr>
                                                    <td>Thematic 7</td>
                                                    <td>Data 7.1</td>
                                                    <td>Data 7.2</td>
                                                    <td>Data 7.3</td>
                                                    <td>Data 7.4</td>
                                                    <td>Data 7.5</td>
                                                    <td>Data 7.6</td>
                                                    <td>Data 7.7</td>
                                                    <td>Data 7.8</td>
                                                    <td>Data 7.9</td>
                                                    <td>Data 7.10</td>
                                                    <td>Data 7.11</td>
                                                    <td>Data 7.12</td>
                                                </tr>
                                                <tr>
                                                    <td>Thematic 8</td>
                                                    <td>Data 8.1</td>
                                                    <td>Data 8.2</td>
                                                    <td>Data 8.3</td>
                                                    <td>Data 8.4</td>
                                                    <td>Data 8.5</td>
                                                    <td>Data 8.6</td>
                                                    <td>Data 8.7</td>
                                                    <td>Data 8.8</td>
                                                    <td>Data 8.9</td>
                                                    <td>Data 8.10</td>
                                                    <td>Data 8.11</td>
                                                    <td>Data 8.12</td>
                                                </tr>
                                                <tr>
                                                    <td>Thematic 9</td>
                                                    <td>Data 9.1</td>
                                                    <td>Data 9.2</td>
                                                    <td>Data 9.3</td>
                                                    <td>Data 9.4</td>
                                                    <td>Data 9.5</td>
                                                    <td>Data 9.6</td>
                                                    <td>Data 9.7</td>
                                                    <td>Data 9.8</td>
                                                    <td>Data 9.9</td>
                                                    <td>Data 9.10</td>
                                                    <td>Data 9.11</td>
                                                    <td>Data 9.12</td>
                                                </tr>
                                                <tr>
                                                    <td>Thematic 10</td>
                                                    <td>Data 10.1</td>
                                                    <td>Data 10.2</td>
                                                    <td>Data 10.3</td>
                                                    <td>Data 10.4</td>
                                                    <td>Data 10.5</td>
                                                    <td>Data 10.6</td>
                                                    <td>Data 10.7</td>
                                                    <td>Data 10.8</td>
                                                    <td>Data 10.9</td>
                                                    <td>Data 10.10</td>
                                                    <td>Data 10.11</td>
                                                    <td>Data 10.12</td>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="alert alert-warning mt-3 mb-0">
                                        Judia Will Support the Bitcoin (btc) Network <a href="pages-pricing.html" class="alert-link text-decoration-underline">Upgrade Now</a>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row">
                        <div class="col-xl-8">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header d-flex align-items-center">
                                            <h4 class="card-title mb-0 flex-grow-1">Sales by Traffic Source</h4>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown card-header-dropdown">
                                                    <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#!">Today</a>
                                                        <a class="dropdown-item" href="#!">Last Week</a>
                                                        <a class="dropdown-item" href="#!">Last Month</a>
                                                        <a class="dropdown-item" href="#!">Current Year</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="api_source_b2b_b2c" data-colors='["--tb-primary", "--tb-secondary", "--tb-danger", "--tb-warning"]' class="apex-charts" dir="ltr"></div>
                                            <div class="mt-3 pt-2">
                                                <h6>Traffic Sources:</h6>
                                                <div class="d-flex mb-2 text-primary">
                                                    <div class="flex-grow-1">
                                                        <p class="text-truncate mb-0"><i class="bi bi-circle fs-xs align-baseline me-2"></i>E-mail b2b </p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <p class="mb-0"><?= $mailpro ?></p>
                                                    </div>
                                                </div><!-- end -->
                                                <div class="d-flex mb-2 text-secondary">
                                                    <div class="flex-grow-1">
                                                        <p class="text-truncate mb-0"><i class="bi bi-circle fs-xs align-baseline me-2"></i>Mobile b2b </p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <p class="mb-0"><?= $mobilepro ?></p>
                                                    </div>
                                                </div><!-- end -->
                                                <div class="d-flex mb-2 text-danger">
                                                    <div class="flex-grow-1">
                                                        <p class="text-truncate mb-0"><i class="bi bi-circle fs-xs align-baseline me-2"></i>E-mail b2c </p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <p class="mb-0"><?= $mailpers ?></p>
                                                    </div>
                                                </div><!-- end -->
                                                <div class="d-flex text-warning">
                                                    <div class="flex-grow-1">
                                                        <p class="text-truncate mb-0"><i class="bi bi-circle fs-xs align-baseline me-2"></i>Mobile b2c</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <p class="mb-0"><?= $mobilepers ?></p>
                                                    </div>
                                                </div><!-- end -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card card-height-100">
                                        <div class="card-header d-flex align-items-center">
                                            <h4 class="card-title mb-0 flex-grow-1">Top X des commandes API classé par montant le plus élevé </h4>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown card-header-dropdown">
                                                    <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="fw-semibold text-uppercase">Sort by: </span><span class="text-muted align-baseline">Today<i class="bi bi-chevron-down align-baseline ms-1"></i></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#!">Today</a>
                                                        <a class="dropdown-item" href="#!">Yesterday</a>
                                                        <a class="dropdown-item" href="#!">Last 7 Days</a>
                                                        <a class="dropdown-item" href="#!">Last 30 Days</a>
                                                        <a class="dropdown-item" href="#!">This Month</a>
                                                        <a class="dropdown-item" href="#!">Last Month</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body px-0">
                                            <div data-simplebar class="px-3" style="max-height: 395px;">
                                                <div class="vstack gap-3">
                                                    <?php
                                                    foreach ($cmd_api as $row) {
                                                        $icon = '';
                                                        switch ($row['type_appel']) {
                                                            case 'SMS':
                                                                $icon = '<i class="bi bi-chat-dots-fill"></i>';
                                                                break;
                                                            case 'codepostal':
                                                                $icon = '<i class="ph-map-marker-bold"></i>';
                                                                break;
                                                            case 'email':
                                                                $icon = '<i class="bi bi-envelope-fill"></i>';
                                                                break;
                                                            default:
                                                                $icon = '<i class="bi bi-question-circle-fill"></i>';
                                                        }
                                                        echo '<div class="d-flex align-items-center gap-2">
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <div class="avatar-title bg-light rounded">
                                                                    <img src="https://img.themesbrand.com/judia/products/img-6.png" alt="" class="avatar-xs">
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <a href="#!">
                                                                    <h6 class="fs-md mb-2">' . htmlspecialchars($row['email']) . '</h6>
                                                                </a>
                                                                <ul class="hstack list-unstyled gap-2 mb-0 fs-sm fw-medium text-muted">
                                                                    <li>
                                                                        ' . $icon . htmlspecialchars($row['type_appel']) . '
                                                                    </li>
                                                                    <li>
                                                                        <i class="bi bi-volume-up"></i>' . htmlspecialchars($row['volume_appel']) . '
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="text-end">
                                                                <h5 class="fs-md text-primary mb-0">' . htmlspecialchars($row['total_price']) . '</h5>
                                                            </div>
                                                        </div>';
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div>
                        </div><!-- end col -->
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Réparticition du CA api par B2C et B2B</h4>
                                    <div class="dropdown card-header-dropdown float-end">
                                        <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#!">Today</a>
                                            <a class="dropdown-item" href="#!">Last Week</a>
                                            <a class="dropdown-item" href="#!">Last Month</a>
                                            <a class="dropdown-item" href="#!">Current Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <h5><?php echo json_encode(array_sum($sommes_b2c)) ?></h5>
                                            <p class="text-muted fs-sm mb-0"><i class="bi bi-circle-fill fs-3xs align-middle me-1 text-info"></i> B2B. Mensuel</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h5><?php echo json_encode(array_sum($sommes_b2b)) ?></h5>
                                            <p class="text-muted fs-sm mb-0"><i class="bi bi-circle-fill fs-3xs align-middle me-1 text-primary"></i> B2B. Mensuel</p>
                                        </div>
                                    </div>
                                    <div id="real_time_sales_id" data-colors='["--tb-info", "--tb-primary"]' class="apex-charts ms-n3" dir="ltr"></div>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" id="contactList">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Top 10 des campagnes affiliations ayant le plus grand chiffre d’affaire au cours des 30 derniers jours</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown sortble-dropdown">
                                            <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fw-semibold text-uppercase">Sort by: </span><span class="text-muted dropdown-title">Order Date</span> <i class="bi bi-chevron-down ms-1"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <button class="dropdown-item sort" data-sort="order_date">Order Date</button>
                                                <button class="dropdown-item sort" data-sort="order_id">Order ID</button>
                                                <button class="dropdown-item sort" data-sort="amount">Amount</button>
                                                <button class="dropdown-item sort" data-sort="status">Status</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                            <thead class="text-muted table-light">
                                                <tr>
                                                    <th scope="col" class="sort cursor-pointer" data-sort="order_date">Date</th>
                                                    <th scope="col" class="sort cursor-pointer" data-sort="order_id">Client</th>
                                                    <th scope="col" class="sort cursor-pointer" data-sort="shop">Sujet</th>
                                                    <th scope="col" class="sort cursor-pointer" data-sort="customer">Prix</th>
                                                    <th scope="col" class="sort cursor-pointer" data-sort="amount">Ouvreurs</th>
                                                    <th scope="col" class="sort cursor-pointer" data-sort="status">Cliqueurs</th>
                                                    <th scope="col" class="sort cursor-pointer" data-sort="rating">Chiffre d'affaire</th>
                                                    <th scope="col" class="sort cursor-pointer" data-sort="">Ratio</th>
                                                    <th scope="col" class="sort" data-sort="">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                <tr>
                                                    <td>2024-05-28</td>
                                                    <td>Client XYZ</td>
                                                    <td>Objet A</td>
                                                    <td>100</td>
                                                    <td>Objectif 1</td>
                                                    <td>50</td>
                                                    <td>20</td>
                                                    <td>5000</td>
                                                    <td>10%</td>
                                                </tr>
                                                <tr>
                                                    <td>2024-05-27</td>
                                                    <td>Client ABC</td>
                                                    <td>Objet B</td>
                                                    <td>150</td>
                                                    <td>Objectif 2</td>
                                                    <td>60</td>
                                                    <td>30</td>
                                                    <td>7500</td>
                                                    <td>20%</td>
                                                </tr>
                                                <tr>
                                                    <td>2024-05-26</td>
                                                    <td>Client DEF</td>
                                                    <td>Objet C</td>
                                                    <td>200</td>
                                                    <td>Objectif 3</td>
                                                    <td>70</td>
                                                    <td>40</td>
                                                    <td>10000</td>
                                                    <td>25%</td>
                                                </tr>
                                                <tr>
                                                    <td>2024-05-25</td>
                                                    <td>Client GHI</td>
                                                    <td>Objet D</td>
                                                    <td>250</td>
                                                    <td>Objectif 4</td>
                                                    <td>80</td>
                                                    <td>50</td>
                                                    <td>12500</td>
                                                    <td>15%</td>
                                                </tr>
                                                <tr>
                                                    <td>2024-05-24</td>
                                                    <td>Client JKL</td>
                                                    <td>Objet E</td>
                                                    <td>300</td>
                                                    <td>Objectif 5</td>
                                                    <td>90</td>
                                                    <td>60</td>
                                                    <td>15000</td>
                                                    <td>15%</td>
                                                </tr>
                                                <tr>
                                                    <td>2024-05-23</td>
                                                    <td>Client MNO</td>
                                                    <td>Objet F</td>
                                                    <td>350</td>
                                                    <td>Objectif 6</td>
                                                    <td>100</td>
                                                    <td>70</td>
                                                    <td>17500</td>
                                                    <td>17%</td>
                                                </tr>
                                                <tr>
                                                    <td>2024-05-22</td>
                                                    <td>Client PQR</td>
                                                    <td>Objet G</td>
                                                    <td>400</td>
                                                    <td>Objectif 7</td>
                                                    <td>110</td>
                                                    <td>80</td>
                                                    <td>20000</td>
                                                    <td>20%</td>
                                                </tr>
                                                <tr>
                                                    <td>2024-05-21</td>
                                                    <td>Client STU</td>
                                                    <td>Objet H</td>
                                                    <td>450</td>
                                                    <td>Objectif 8</td>
                                                    <td>120</td>
                                                    <td>90</td>
                                                    <td>22500</td>
                                                    <td>30%</td>
                                                </tr>
                                                <tr>
                                                    <td>2024-05-20</td>
                                                    <td>Client VWX</td>
                                                    <td>Objet I</td>
                                                    <td>500</td>
                                                    <td>Objectif 9</td>
                                                    <td>130</td>
                                                    <td>100</td>
                                                    <td>25000</td>
                                                    <td>25%</td>
                                                </tr>
                                                <tr>
                                                    <td>2024-05-19</td>
                                                    <td>Client YZA</td>
                                                    <td>Objet J</td>
                                                    <td>550</td>
                                                    <td>Objectif 10</td>
                                                    <td>140</td>
                                                    <td>110</td>
                                                    <td>27500</td>
                                                    <td>27%</td>
                                                </tr>
                                            </tbody>

                                        </table><!-- end table -->
                                        <div class="noresult" style="display: none">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                                <p class="text-muted mb-0">We've searched more than 150+ transactions We did not find any transactions for you search.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Stock Products</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fw-semibold text-uppercase">Sort by:
                                                </span><span class="text-muted">Today <i class="bi bi-chevron-down align-baseline ms-1"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#!">Today</a>
                                                <a class="dropdown-item" href="#!">Yesterday</a>
                                                <a class="dropdown-item" href="#!">Last 7 Days</a>
                                                <a class="dropdown-item" href="#!">Last 30 Days</a>
                                                <a class="dropdown-item" href="#!">This Month</a>
                                                <a class="dropdown-item" href="#!">Last Month</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div class="avatar-title bg-light rounded">
                                                                    <img src="https://img.themesbrand.com/judia/products/img-1.png" alt="" class="img-fluid d-block avatar-xs">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1"><a href="#!" class="text-reset">Branded T-Shirts</a></h6>
                                                                <span class="text-muted">24 Apr 2023</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">$29.00</h6>
                                                        <span class="text-muted">Price</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">62</h6>
                                                        <span class="text-muted">Orders</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">510</h6>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">$1,798</h6>
                                                        <span class="text-muted">Amount</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div class="avatar-title bg-light rounded">
                                                                    <img src="https://img.themesbrand.com/judia/products/img-2.png" alt="" class="img-fluid d-block avatar-xs">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1"><a href="#!" class="text-reset">Bentwood Chair</a></h6>
                                                                <span class="text-muted">19 Mar 2023</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">$85.20</h6>
                                                        <span class="text-muted">Price</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">35</h6>
                                                        <span class="text-muted">Orders</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1"><span class="badge bg-danger-subtle text-danger">Out of stock</span> </h6>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">$2982</h6>
                                                        <span class="text-muted">Amount</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div class="avatar-title bg-light rounded">
                                                                    <img src="https://img.themesbrand.com/judia/products/img-3.png" alt="" class="img-fluid d-block avatar-xs">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1"><a href="#!" class="text-reset">Borosil Paper Cup</a></h6>
                                                                <span class="text-muted">01 Mar 2023</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">$14.00</h6>
                                                        <span class="text-muted">Price</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">80</h6>
                                                        <span class="text-muted">Orders</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">749</h6>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">$1120</h6>
                                                        <span class="text-muted">Amount</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div class="avatar-title bg-light rounded">
                                                                    <img src="https://img.themesbrand.com/judia/products/img-4.png" alt="" class="img-fluid d-block avatar-xs">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1"><a href="#!" class="text-reset">One Seater Sofa</a></h6>
                                                                <span class="text-muted">11 Feb 2023</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">$127.50</h6>
                                                        <span class="text-muted">Price</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">56</h6>
                                                        <span class="text-muted">Orders</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1"><span class="badge bg-danger-subtle text-danger">Out of stock</span></h6>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">$7140</h6>
                                                        <span class="text-muted">Amount</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm me-2">
                                                                <div class="avatar-title bg-light rounded">
                                                                    <img src="https://img.themesbrand.com/judia/products/img-5.png" alt="" class="img-fluid d-block avatar-xs">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h6 class="my-1"><a href="#!" class="text-reset">Stillbird Helmet</a></h6>
                                                                <span class="text-muted">17 Jan 2023</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">$54</h6>
                                                        <span class="text-muted">Price</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">74</h6>
                                                        <span class="text-muted">Orders</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">805</h6>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-1">$3996</h6>
                                                        <span class="text-muted">Amount</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                        <div class="col-sm">
                                            <div class="text-muted">
                                                Showing <span class="fw-semibold">5</span> of <span class="fw-semibold">25</span> Results
                                            </div>
                                        </div>
                                        <div class="col-sm-auto  mt-3 mt-sm-0">
                                            <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                                <li class="page-item disabled">
                                                    <a href="#!" class="page-link">←</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#!" class="page-link">1</a>
                                                </li>
                                                <li class="page-item active">
                                                    <a href="#!" class="page-link">2</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#!" class="page-link">3</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#!" class="page-link">→</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
                            <div class="card card-height-100">
                                <div class="card-header d-flex">
                                    <h5 class="card-title mb-0 flex-grow-1">Top 12 Pays b2b</h5>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#!">This Years</a>
                                                <a class="dropdown-item" href="#!">Last Years</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="p-3 text-center bg-light bg-opacity-50 mb-4 rounded">
                                        <h4 class="mb-0">
                                            <span class="counter-value" data-target="<?php echo number_format($mailpro, 0, "", " "); ?>">
                                                <?php echo number_format($mailpro, 0, "", " "); ?>
                                            </span>
                                            <span class="text-muted fw-normal fs-sm">
                                                <span class="text-success fw-medium">
                                                    <?= number_format($mailpro / $mobilepro, 0, "", " "); ?> %
                                                </span> le mois dernier
                                            </span>
                                        </h4>
                                    </div>
                                    <ul class="list-unstyled vstack gap-2 mb-0">
                                        <?php foreach ($topb2b as $print_top) : ?>
                                            <li class="d-flex align-items-center gap-2">
                                                <img src="`/<?php echo $path; ?>/assets/images/flags/${item.value.toUpperCase()}.svg`" alt="" height="16" class="rounded-circle object-fit-cover">
                                                <h6 class="flex-grow-1 mb-0"><?= $print_top['country']; ?></h6>
                                                <p class="text-muted mb-0"><?= $print_top['topb2b']; ?> %</p>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>
                        </div><!--end col-->
                        <?php
                        $home3 = "SELECT * FROM home3 ORDER BY id DESC LIMIT 1";
                        $recupHome3   = $bdd->executeQueryRequete($home3, 1);

                        while ($item = $recupHome3->fetch()) {
                            $email       = $item->email;
                            $firstname   = $item->firstname;
                            $lastname    = $item->lastname;
                            $date_in     = $item->date_in;
                            $tel_mobile  = $item->tel_mobile;
                            $tel_fixe    = $item->tel_fixe;
                            $dateofbirth = $item->dateofbirth;
                            $adresse_1   = $item->adresse_1;
                            $pays        = $item->pays;
                            $cp          = $item->cp;
                            $ville       = $item->ville;
                            $last_date_r = $item->last_date_r;
                            $last_date_o = $item->last_date_o;
                            $last_date_c = $item->last_date_c;
                        }
                        ?>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card card-height-100">
                                <div class="card-header d-flex">
                                    <h5 class="card-title mb-0 flex-grow-1">Data analystic</h5>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#!">This Years</a>
                                                <a class="dropdown-item" href="#!">Last Years</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="p-3 text-center bg-light bg-opacity-50 mb-4 rounded">
                                        <h4 class="mb-0">$<span class="counter-value" data-target="314.57">0</span>M <span class="text-muted fw-normal fs-sm"><span class="text-success fw-medium"><i class="bi bi-arrow-up"></i> +23.57%</span> Last Month</span></h4>
                                    </div>
                                    <ul class="list-unstyled vstack gap-2 mb-0">
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">E-mail</h6>
                                            <p class="text-muted mb-0"><?= round($email * 100 / $fullbase, 2) ?>%</p>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">Téléphones mobile</h6>
                                            <p class="text-muted mb-0"><?= round($tel_mobile * 100 / $fullbase, 2) ?>%</p>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">Téléphones résidentiels</h6>
                                            <p class="text-muted mb-0"><?= round($tel_fixe * 100 / $fullbase, 2) ?>%</p>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">email & mobile</h6>
                                            <p class="text-muted mb-0"><?= round($hommes * 100 / $fullbase, 2) ?>%</p>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">Code postal</h6>
                                            <p class="text-muted mb-0"><?= round($hommes * 100 / $fullbase, 2) ?>%</p>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">Adresse complète</h6>
                                            <p class="text-muted mb-0"><?= round($adresse_1 * 100 / $fullbase, 2) ?>%</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-xl-4 col-lg-6">
                            <div class="card card-height-100">
                                <div class="card-header d-flex">
                                    <h5 class="card-title mb-0 flex-grow-1">Data Ressources</h5>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted fs-lg"><i class="bi bi-three-dots-vertical"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#!">This Years</a>
                                                <a class="dropdown-item" href="#!">Last Years</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="p-3 text-center bg-light bg-opacity-50 mb-4 rounded">
                                        <h4 class="mb-0">$<span class="counter-value" data-target="314.57">0</span>M <span class="text-muted fw-normal fs-sm"><span class="text-success fw-medium"><i class="bi bi-arrow-up"></i> +23.57%</span> Last Month</span></h4>
                                    </div>
                                    <ul class="list-unstyled vstack gap-2 mb-0">
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">Total hommes</h6>
                                            <p class="text-muted mb-0"><?= round($hommes * 100 / $fullbase, 2); ?> %</p>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">Total Femmes </h6>
                                            <p class="text-muted mb-0"><?= round($dames * 100 / $fullbase, 2); ?> %</p>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">Prénom</h6>
                                            <p class="text-muted mb-0"><?= round($firstname * 100 / $fullbase, 2) ?> %</p>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">Nom de famille</h6>
                                            <p class="text-muted mb-0"><?= round($lastname * 100 / $fullbase, 2) ?> %</p>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">Date de naissance</h6>
                                            <p class="text-muted mb-0"><?= round($date_in * 100 / $fullbase, 2) ?> %</p>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">Parents</h6>
                                            <p class="text-muted mb-0">1.25%</p>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">Propriétaire de la maison</h6>
                                            <p class="text-muted mb-0">1.25%</p>
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <h6 class="flex-grow-1 mb-0">Propriétaire d'une voiture</h6>
                                            <p class="text-muted mb-0">1.25%</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Top 12 Pays B2B</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="p-3 text-center bg-light bg-opacity-50 mb-4 rounded">
                                        <h4 class="mb-0"><span class="counter-value" data-target="<?php echo number_format($mailpro, 0, "", " "); ?>"><?php echo number_format($mailpro, 0, "", " "); ?></span> <span class="text-muted fw-normal fs-sm"><span class="text-success fw-medium"><?= number_format($mailpro / $mobilepro, 0, "", " "); ?> %</span> le mois dernier </span></h4>
                                    </div>
                                    <div id="custom_datalabels_bar_b2b" data-colors='["--tb-primary", "--tb-secondary", "--tb-success", "--tb-info", "--tb-warning", "--tb-danger", "--tb-dark", "--tb-primary", "--tb-success", "--tb-secondary"]' class="apex-charts" dir="ltr"></div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Top 12 Pays B2C</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="p-3 text-center bg-light bg-opacity-50 mb-4 rounded">
                                        <h4 class="mb-0"><span class="counter-value" data-target="<?php echo number_format($mailpers, 0, "", " "); ?>"><?php echo number_format($mailpers, 0, "", " "); ?></span> <span class="text-muted fw-normal fs-sm"><span class="text-success fw-medium"><?= number_format($mailpers / $mobilepers, 0, "", " "); ?> %</span> le mois dernier </span></h4>
                                    </div>
                                    <div id="custom_datalabels_bar" data-colors='["--tb-primary", "--tb-secondary", "--tb-success", "--tb-info", "--tb-warning", "--tb-danger", "--tb-dark", "--tb-primary", "--tb-success", "--tb-secondary"]' class="apex-charts" dir="ltr"></div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->




            <?php include 'partials/footer.php'; ?>
        </div>
        <!-- end main content-->
    </div>

    <?php include 'partials/vendor-scripts.php'; ?>

    <!-- sweetalert2 js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- list.js min js -->
    <script src="assets/libs/list.js/list.min.js"></script>
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
    <script src=" assets/js/pages/form-advanced.init.js"></script>
    <script src="assets/js/pages/customer-list.init.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Vector map-->
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>
    <!-- Dashboard init -->
    <script src="assets/js/pages/dashboard-ecommerce.init.js"></script>


    <script>
        // get colors array from the string
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
        var chartDatalabelsBarChartb2b = "";
        var chartDatalabelsBarChart = "";
        var onlineStoreChart = "";
        var realTimeSalesChart = "";

        function loadCharts() {
            // Custom DataLabels Bar
            var chartDatalabelsBarColorsb2b = "";
            chartDatalabelsBarColorsb2b = getChartColorsArray("custom_datalabels_bar_b2b");
            if (chartDatalabelsBarColorsb2b) {
                var options = {
                    series: [{
                        data: <?php echo $top_valeurs_json; ?>
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: {
                            show: false,
                        }
                    },
                    plotOptions: {
                        bar: {
                            barHeight: '100%',
                            distributed: true,
                            horizontal: true,
                            dataLabels: {
                                position: 'bottom'
                            },
                        }
                    },
                    colors: chartDatalabelsBarColorsb2b,
                    dataLabels: {
                        enabled: true,
                        textAnchor: 'start',
                        style: {
                            colors: ['#fff']
                        },
                        formatter: function(val, opt) {
                            return opt.w.globals.labels[opt.dataPointIndex] + " : " + val
                        },
                        offsetX: 0,
                        dropShadow: {
                            enabled: false
                        }
                    },
                    stroke: {
                        width: 1,
                        colors: ['#fff']
                    },
                    xaxis: {
                        categories: <?php echo $top_country_json; ?>,
                    },
                    yaxis: {
                        labels: {
                            show: false
                        }
                    },
                    grid: {
                        padding: {
                            bottom: -14,
                            left: 0,
                            right: 0
                        }
                    },
                    // title: {
                    //     text: 'Top 12 Pays B2B',
                    //     align: 'center',
                    //     floating: true,
                    //     style: {
                    //         fontWeight: 500,
                    //     },
                    // },
                    // subtitle: {
                    //     text: 'Top 12 Pays B2B',
                    //     align: 'center',
                    // },
                    tooltip: {
                        theme: 'dark',
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                                formatter: function() {
                                    return ''
                                }
                            }
                        }
                    }
                };

                if (chartDatalabelsBarChartb2b != "")
                    chartDatalabelsBarChartb2b.destroy();
                chartDatalabelsBarChartb2b = new ApexCharts(document.querySelector("#custom_datalabels_bar_b2b"), options);
                chartDatalabelsBarChartb2b.render();
            }

            var chartDatalabelsBarColors = "";
            chartDatalabelsBarColors = getChartColorsArray("custom_datalabels_bar");
            if (chartDatalabelsBarColors) {
                var options = {
                    series: [{
                        data: <?php echo $top_valeurs_pays_json; ?>
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: {
                            show: false,
                        }
                    },
                    plotOptions: {
                        bar: {
                            barHeight: '100%',
                            distributed: true,
                            horizontal: true,
                            dataLabels: {
                                position: 'bottom'
                            },
                        }
                    },
                    colors: chartDatalabelsBarColors,
                    dataLabels: {
                        enabled: true,
                        textAnchor: 'start',
                        style: {
                            colors: ['#fff']
                        },
                        formatter: function(val, opt) {
                            return opt.w.globals.labels[opt.dataPointIndex] + " : " + val
                        },
                        offsetX: 0,
                        dropShadow: {
                            enabled: false
                        }
                    },
                    stroke: {
                        width: 1,
                        colors: ['#fff']
                    },
                    xaxis: {
                        categories: <?php echo $top_pays_json; ?>,
                    },
                    yaxis: {
                        labels: {
                            show: false
                        }
                    },
                    grid: {
                        padding: {
                            bottom: -14,
                            left: 0,
                            right: 0
                        }
                    },
                    // title: {
                    //     text: 'Top 12 Pays B2B',
                    //     align: 'center',
                    //     floating: true,
                    //     style: {
                    //         fontWeight: 500,
                    //     },
                    // },
                    // subtitle: {
                    //     text: 'Top 12 Pays B2B',
                    //     align: 'center',
                    // },
                    tooltip: {
                        theme: 'dark',
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                                formatter: function() {
                                    return ''
                                }
                            }
                        }
                    }
                };

                if (chartDatalabelsBarChart != "")
                    chartDatalabelsBarChart.destroy();
                chartDatalabelsBarChart = new ApexCharts(document.querySelector("#custom_datalabels_bar"), options);
                chartDatalabelsBarChart.render();
            }

            //api email, mobil( b2b, b2c)

            // api_source_b2b_b2c
            var salesTrafficSourceColors = "";
            salesTrafficSourceColors = getChartColorsArray("api_source_b2b_b2c");
            if (salesTrafficSourceColors) {
                var options = {
                    series: [<?php echo $mailpro_json; ?>, <?php echo $mobilepro_json; ?>, <?php echo $mailpers_json; ?>, <?php echo $mobilepers_json; ?>],
                    labels: ["E-mail b2b", "Mobile b2b", "E-mail b2c", "Mobile b2c"],
                    chart: {
                        height: 267,
                        type: 'donut',
                    },
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        dropShadow: {
                            enabled: false,
                        }
                    },
                    colors: salesTrafficSourceColors
                };

                if (salesTrafficSourceChart != "")
                    salesTrafficSourceChart.destroy();
                salesTrafficSourceChart = new ApexCharts(document.querySelector("#api_source_b2b_b2c"), options);
                salesTrafficSourceChart.render();
            }

            // Real time sales Chart
            var realTimeSalesColors = "";
            realTimeSalesColors = getChartColorsArray("real_time_sales_id");
            if (realTimeSalesColors) {
                var options = {
                    chart: {
                        height: 275,
                        type: 'bar',
                        stacked: true,
                        toolbar: {
                            show: false,
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '45%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 1,
                        colors: ['transparent']
                    },
                    legend: {
                        show: false,
                    },
                    series: [{
                        name: 'chiffre d\'affaire B2C',
                        data: <?php echo json_encode($sommes_b2c) ?>
                    }, {
                        name: 'chiffre d\'affaire B2B',
                        data: <?php echo json_encode($sommes_b2b) ?>
                    }],
                    colors: realTimeSalesColors,
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    },
                    yaxis: {
                        show: true,
                    },
                    grid: {
                        show: true,
                        padding: {
                            right: 0,
                        },
                        borderColor: '#000',
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        },
                    },
                }

                if (realTimeSalesChart != "")
                    realTimeSalesChart.destroy();
                realTimeSalesChart = new ApexCharts(document.querySelector("#real_time_sales_id"), options);
                realTimeSalesChart.render();
            }
        }
        window.addEventListener("resize", function() {
            setTimeout(() => {
                loadCharts();
            }, 250);
        });
        loadCharts();
    </script>
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>