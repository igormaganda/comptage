<?php include 'partials/session.php'; ?>
<?php include 'partials/main.php'; ?>

<?php require("partials/class/Bdd.php"); 

    //Pour débguer le code
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    $bdd = new Bdd();

    $bd = $bdd->connect();

    //Count des tableaux du début
    $reqSQL = "SELECT 
        SUM(\"Email_total\") AS sum_emt, 
        SUM(\"Email_valide\") AS sum_emv, 
        SUM(\"Email_invalide\") AS sum_eminv, 
        SUM(\"Erreur_connexion\") AS sum_errcon 
    FROM 
        public.nettoyage_count;";
    $resData = $bd->query($reqSQL)->fetch(PDO::FETCH_ASSOC);
    
    //Affichage du Top Serveur
    $reqToServ = "SELECT 
                    \"Serveur\",
                    SUM(\"Fichier_total\") AS sum_sert, 
                    SUM(\"Fichier_valide\") AS sum_serv, 
                    SUM(\"Fichier_invalide\") AS sum_serinv, 
                    SUM(\"Erreur_connexion\") AS sum_serrcon 
                FROM 
                    public.nettoyage_serveur 
                WHERE TO_TIMESTAMP(\"Date_server\", 'YYYY-MM-DD') >= CURRENT_DATE - INTERVAL '29 days'
                AND TO_TIMESTAMP(\"Date_server\", 'YYYY-MM-DD') <= CURRENT_DATE + INTERVAL '1 day'
                GROUP BY 
                    \"Serveur\" 
                ORDER BY 
                    SUM(\"Fichier_invalide\") DESC LIMIT 6;";

        $reqTop = $bd->query($reqToServ)->fetchAll(PDO::FETCH_ASSOC);
    
    // SQL pour l'affichage dans Serveur
    $reqServer = "SELECT \"Serveur\",
                        SUM(\"Fichier_total\") AS sum_sert, 
                        SUM(\"Fichier_valide\") AS sum_serv, 
                        SUM(\"Fichier_invalide\") AS sum_serinv, 
                        SUM(\"Erreur_connexion\") AS sum_serrcon 
                    FROM 
                        public.nettoyage_serveur GROUP BY \"Serveur\";";

    $reqServer = $bd->query($reqServer)->fetchAll(PDO::FETCH_ASSOC);
    

    //Affichage du graphe
    if($_POST['datestart'] && $_POST['dateend']){
        $reqGrap = "SELECT *
                    FROM nettoyage_count
                    WHERE \"Date_count\" BETWEEN :datestart AND :dateend
                    ORDER BY \"Date_count\" ASC";
    
        $resGraph = $bd->prepare($reqGrap);
    
        $resGraph->bindParam(':datestart', $_POST['datestart']);
        $resGraph->bindParam(':dateend', $_POST['dateend']);
    
        // Exécution de la requête
        $resGraph->execute();
     
    }else{
        $reqGrap = "SELECT *
        FROM nettoyage_count
        WHERE TO_TIMESTAMP(\"Date_count\", 'YYYY-MM-DD') >= CURRENT_DATE - INTERVAL '29 days'
        AND TO_TIMESTAMP(\"Date_count\", 'YYYY-MM-DD') <= CURRENT_DATE + INTERVAL '1 day'
        ORDER BY \"Date_count\" ASC";

        $resGraph = $bd->query($reqGrap);
    }

       // Récupération des résultats
    while ($row = $resGraph->fetch(PDO::FETCH_ASSOC)) {
    $date = $row['Date_count'];
    $email_valide = (int)$row['Email_valide'];
    $email_invalide = (int)$row['Email_invalide'];
    $erreur_connexion = (int)$row['Erreur_connexion'];

    // Ajouter les valeurs à chaque série
    $mailvalide[] = $email_valide;
    $mailinvalide[] = $email_invalide;
    $erreurconnexion[] = $erreur_connexion;
    $dated[] = $date;
    }
    
    // Convertir le tableau PHP en JSON pour l'utiliser dans JavaScript
    $mailvalide_json = json_encode($mailvalide);
    $mailinvalide_jon = json_encode($mailinvalide);
    $erreurcon_json = json_encode($erreurconnexion);
    $date_json = json_encode($dated);
    
?>

<head>

    <?php includeFileWithVariables('partials/title-meta.php', array('title' => 'Statistiques')); ?>

    <!-- jsvectormap css -->
    
<!--datatable css-->

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
                                <?php includeFileWithVariables('partials/page-title.php', array('pagetitle' => 'Statistiques', 'title' => 'Nettoyage')); ?>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>

                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-warning overflow-hidden">
                                <div class="position-absolute top-0 right-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="250" height="100" preserveAspectRatio="none" viewBox="0 0 350 200">
                                        <g mask="url(&quot;#SvgjsMask1046&quot;)" fill="none">
                                            <path d="M385.59 13.35C356.64 14.32 333.88 59.69 279.23 59.35 224.58 59.01 208.1-30.2 172.87-37" style="stroke: rgba(var(--tb-white-rgb), 0.14);" stroke-width="2"></path>
                                            <path d="M397.1 120.72C352.81 118.98 323.8 49.73 235.97 46.72 148.15 43.71 118.4-18.41 74.85-19.7" style="stroke: rgba(var(--tb-white-rgb), 0.14);" stroke-width="2"></path>
                                            <path d="M353.25 33.52C326.55 35.03 307.47 83.9 258.67 83.52 209.87 83.14 197.14-6.35 164.09-14.66" style="stroke: rgba(var(--tb-white-rgb), 0.14);" stroke-width="2"></path>
                                            <path d="M385.3 171.91C344.67 169.99 308.53 110.04 239.41 99.91 170.28 89.78 195.34 10.2 166.46-1.88" style="stroke: rgba(var(--tb-white-rgb), 0.14);" stroke-width="2"></path>
                                            <path d="M360.8 147.25C313.76 146.8 258.96 103.74 179.4 97.25 99.84 90.76 123.43-6.99 88.7-19.8" style="stroke: rgba(var(--tb-white-rgb), 0.14);" stroke-width="2"></path>
                                        </g>
                                        <defs>
                                            <mask id="SvgjsMask1046">
                                                <rect width="250" height="100" fill="#ffffff"></rect>
                                            </mask>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="card-body">
                                    <p class="fs-lg text-reset mb-4">Email Total</p>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="display-6 mb-3">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-9 mt-2">
                                            <h3 class="text-reset fw-medium mb-0"><?= number_format($resData['sum_emt'], 0, ',', ' ');  ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-success overflow-hidden">
                                <div class="position-absolute top-0 right-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="250" height="100" preserveAspectRatio="none" viewBox="0 0 350 200">
                                        <g mask="url(&quot;#SvgjsMask1046&quot;)" fill="none">
                                            <path d="M385.59 13.35C356.64 14.32 333.88 59.69 279.23 59.35 224.58 59.01 208.1-30.2 172.87-37" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M397.1 120.72C352.81 118.98 323.8 49.73 235.97 46.72 148.15 43.71 118.4-18.41 74.85-19.7" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M353.25 33.52C326.55 35.03 307.47 83.9 258.67 83.52 209.87 83.14 197.14-6.35 164.09-14.66" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M385.3 171.91C344.67 169.99 308.53 110.04 239.41 99.91 170.28 89.78 195.34 10.2 166.46-1.88" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M360.8 147.25C313.76 146.8 258.96 103.74 179.4 97.25 99.84 90.76 123.43-6.99 88.7-19.8" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                        </g>
                                        <defs>
                                            <mask id="SvgjsMask1046">
                                                <rect width="250" height="100" fill="#ffffff"></rect>
                                            </mask>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="card-body">
                                    <p class="fs-lg text-reset mb-4">Email valide</p>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="display-6 mb-3">
                                                <i class="bi bi-envelope-check"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-9 mt-2">
                                            <h3 class="text-reset fw-medium mb-0"><?= number_format($resData['sum_emv'], 0, ',', ' '); ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-danger overflow-hidden">
                                <div class="position-absolute top-0 right-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="250" height="100" preserveAspectRatio="none" viewBox="0 0 350 200">
                                        <g mask="url(&quot;#SvgjsMask1046&quot;)" fill="none">
                                            <path d="M385.59 13.35C356.64 14.32 333.88 59.69 279.23 59.35 224.58 59.01 208.1-30.2 172.87-37" style="stroke: rgba(var(--tb-white-rgb), 0.1);" stroke-width="2"></path>
                                            <path d="M397.1 120.72C352.81 118.98 323.8 49.73 235.97 46.72 148.15 43.71 118.4-18.41 74.85-19.7" style="stroke: rgba(var(--tb-white-rgb), 0.1);" stroke-width="2"></path>
                                            <path d="M353.25 33.52C326.55 35.03 307.47 83.9 258.67 83.52 209.87 83.14 197.14-6.35 164.09-14.66" style="stroke: rgba(var(--tb-white-rgb), 0.1);" stroke-width="2"></path>
                                            <path d="M385.3 171.91C344.67 169.99 308.53 110.04 239.41 99.91 170.28 89.78 195.34 10.2 166.46-1.88" style="stroke: rgba(var(--tb-white-rgb), 0.1);" stroke-width="2"></path>
                                            <path d="M360.8 147.25C313.76 146.8 258.96 103.74 179.4 97.25 99.84 90.76 123.43-6.99 88.7-19.8" style="stroke: rgba(var(--tb-white-rgb), 0.1);" stroke-width="2"></path>
                                        </g>
                                        <defs>
                                            <mask id="SvgjsMask1046">
                                                <rect width="250" height="100" fill="#ffffff"></rect>
                                            </mask>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="card-body">
                                    <p class="fs-lg text-reset mb-4">Email invalide</p>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="display-6 mb-3">
                                                    <i class="bi bi-envelope-exclamation"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-9 mt-2">
                                                <h3 class="text-reset fw-medium mb-0"><?= number_format($resData['sum_eminv'], 0, ',', ' '); ?></h3>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-xl-3 col-sm-6">
                            <div class="card card-primary overflow-hidden">
                                <div class="position-absolute top-0 right-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="250" height="100" preserveAspectRatio="none" viewBox="0 0 350 200">
                                        <g mask="url(&quot;#SvgjsMask1046&quot;)" fill="none">
                                            <path d="M385.59 13.35C356.64 14.32 333.88 59.69 279.23 59.35 224.58 59.01 208.1-30.2 172.87-37" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M397.1 120.72C352.81 118.98 323.8 49.73 235.97 46.72 148.15 43.71 118.4-18.41 74.85-19.7" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M353.25 33.52C326.55 35.03 307.47 83.9 258.67 83.52 209.87 83.14 197.14-6.35 164.09-14.66" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M385.3 171.91C344.67 169.99 308.53 110.04 239.41 99.91 170.28 89.78 195.34 10.2 166.46-1.88" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                            <path d="M360.8 147.25C313.76 146.8 258.96 103.74 179.4 97.25 99.84 90.76 123.43-6.99 88.7-19.8" style="stroke: rgba(var(--tb-white-rgb), 0.07);" stroke-width="2"></path>
                                        </g>
                                        <defs>
                                            <mask id="SvgjsMask1046">
                                                <rect width="250" height="100" fill="#ffffff"></rect>
                                            </mask>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="card-body">
                                    <p class="fs-lg text-reset mb-4">Erreur de connexion</p>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="display-6 mb-3">
                                                    <i class="bi bi-exclamation-triangle"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-9 mt-2">
                                                <h3 class="text-reset fw-medium mb-0"><?= number_format($resData['sum_errcon'], 0, ',', ' '); ?></h3>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-5">
                                    <div class="text-center">
                                        <p class="text-muted fs-md">Recherche par date</p>
                                    </div>
                                </div>
                            </div>
                            <form action="#" method="post">
                                <div class="row gy-1 align-items-center justify-content-center">
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="datestart" class="form-label">Date début</label>
                                        <input type="date" class="form-control" name="datestart" id="datestart" >
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="dateend" class="form-label">Date Fin</label>
                                        <input type="date" class="form-control" name="dateend"  id="dateend" >
                                    </div>
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mt-3 text-center">
                                            <button type="submit" class="btn btn-primary" id="twodate">Valider</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Graphique</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div id="line_chart_dashed" data-colors='["--tb-primary", "--tb-danger", "--tb-success"]' class="apex-charts" dir="ltr"></div>
                        </div><!-- end card-body -->
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card overflow-hidden card-height-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Top serveur</h5>
                                </div>
                                <div class="card-body p-0 pt-2">
                                    <ul class="list-group list-group-flush mb-0">
                                    <?php foreach ($reqTop as $server): ?>
                                        <li class="list-group-item">
                                            <div class="d-flex gap-2">
                                                <div class="flex-grow-1">
                                                    <a href="apps-crypto-coin-overview.php"><h5 class="fs-md mb-1"><?php echo $server['Serveur']; ?></h5></a>
                                                </div>
                                                <div class="flex-shrink-0 text-end">
                                                    <h5 class="fs-md mb-1"><?php echo $server['sum_sert']; ?></h5>
                                                    <p class="mb-0"><span class="text-danger"><?php echo $server['sum_serinv']; ?></span> <span class="text-success ms-1"><?php echo $server['sum_serv']; ?></span> <span class="text-muted ms-1"><?php echo round($server['sum_serinv']*100/$server['sum_sert'], 2) ; ?>%</span></p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card overflow-hidden">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Tableau récapulative</h5>
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
                    name: "Erreur de connexion",
                    data: <?php echo $erreurcon_json; ?>
                },
                {
                    name: "Email invalide",
                    data: <?php echo $mailinvalide_jon; ?>
                },
                {
                    name: 'Email valide',
                    data: <?php echo $mailvalide_json; ?>
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