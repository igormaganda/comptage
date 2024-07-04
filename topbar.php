<?php
    if (!empty($_SESSION['lang'])) {
        $sessionLang = $_SESSION['lang'];
        require_once ('assets/lang-php/'.$sessionLang.'.php');
    } else {
        require_once ('assets/lang-php/en.php');
    }
    echo "<script>
    console.log('$path')
    </script>";
?>
<div class="menu-wrapper">
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header" id="navbar-header">
                <div class="d-flex" id="header-logo">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="index.php" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="http://207.180.204.157/Datamart/New/v4/assets/images/MGD1.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="http://207.180.204.157/Datamart/New/v4/assets/images/MGD1.png" alt="" height="22">
                            </span>
                        </a>
    
                        <a href="index.php" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="http://207.180.204.157/Datamart/New/v4/assets/images/MGD1.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="http://207.180.204.157/Datamart/New/v4/assets/images/MGD1.png" alt="" height="22">
                            </span>
                        </a>
                    </div>
    
                    <button type="button"
                        class="btn btn-sm px-3 header-item vertical-menu-btn topnav-hamburger shadow-none"
                        id="topnav-hamburger-icon">
                        <span class="hamburger-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
    
                </div>
                <!-- ========== App Menu ========== -->
                <div class="app-menu navbar-menu mx-auto opacity-0">
                    <!-- LOGO -->
                    <div class="navbar-brand-box vertical-logo">
                        <a href="index" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="http://207.180.204.157/Datamart/New/v4/assets/images/MGD1.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="http://207.180.204.157/Datamart/New/v4/assets/images/MGD1.png" alt="" height="22">
                            </span>
                        </a>

                        <a href="index" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="http://207.180.204.157/Datamart/New/v4/assets/images/MGD1.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="http://207.180.204.157/Datamart/New/v4/assets/images/MGD1.png" alt="" height="22">
                            </span>
                        </a>
                    </div>
                    <div id="scrollbar">
                        <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="menu-title"><i class="ri-more-fill"></i><span data-key="t-general"><?php echo $lang["t-general"]; ?></span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link collapsed" href="#sideGenerale" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sideGenerale">
                                <i class="ph-stack-simple"></i> <span data-key="t-general"><?php echo $lang["t-general"]; ?></span>
                            </a>
                            <div class="collapse menu-dropdown" id="sideGenerale">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link collapsed" href="#sideData" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sideData">
                                            <span data-key="t-database"><?php echo $lang["t-database"]; ?></span>
                                        </a>
                                        <div class="collapse menu-dropdown" id="sideData">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="/<?php echo $path; ?>/blacklist.php" class="nav-link" role="button" data-key="t-blacklist"> <?php echo $lang["t-blacklist"]; ?> </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="/<?php echo $path; ?>/prenoms.php" class="nav-link" role="button" data-key="t-frisName"> <?php echo $lang["t-frisName"]; ?> </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#sideOptions" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sideOptions" data-key="t-options"> <?php echo $lang["t-options"]; ?> </a>
                                        <div class="collapse menu-dropdown" id="sideOptions">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="/<?php echo $path; ?>/exclusion.php" class="nav-link" data-key="t-settings"> <?php echo $lang["t-settings"]; ?> </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="/<?php echo $path; ?>/id.php" class="nav-link" data-key="t-route"> <?php echo $lang["t-route"]; ?> </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>


                            <li class="menu-title"><i class="ri-more-fill"></i><span data-key="t-comptages"><?php echo $lang["t-comptages"]; ?></span></li>

                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                                    <i class=" ph-arrow-clockwise-thin"></i> <span data-key="t-comptages"><?php echo $lang["t-comptages"]; ?></span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarPages">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link collapsed" href="#sideImport" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sideImport">
                                                <span data-key="t-import"><?php echo $lang["t-import"]; ?></span>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sideImport">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="auth-signin.php" class="nav-link" role="button" data-key="t-signin"> <?php echo $lang["t-signin"]; ?> </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="auth-signup.php" class="nav-link" role="button" data-key="t-signup"> <?php echo $lang["t-signup"]; ?> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sideSearch" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sideSearch" data-key="t-search"> <?php echo $lang["t-search"]; ?> </a>
                                            <div class="collapse menu-dropdown" id="sideSearch">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="/<?php echo $path; ?>/search/search.php" class="nav-link" data-key="t-search"> <?php echo $lang["t-search"]; ?> </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="/<?php echo $path; ?>/search/search_b.php" class="nav-link" data-key="t-listsearch"> <?php echo $lang["t-listsearch"]; ?> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-title"><i class="ri-more-fill"></i><span data-key="t-compagnes"><?php echo $lang["t-compagnes"]; ?></span></li>
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sideCompagnes" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sideCompagnes">
                                    <i class="ph-buildings-thin"></i> <span data-key="t-compagnes"><?php echo $lang["t-compagnes"]; ?></span>
                                </a>
                                <div class="collapse menu-dropdown" id="sideCompagnes">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link collapsed" href="#sideCompagne" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sideCompagne">
                                                <span data-key="t-compagnes"><?php echo $lang["t-compagnes"]; ?></span>
                                            </a>
                                            <div class="collapse menu-dropdown" id="sideCompagne">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="/<?php echo $path; ?>/DIR_campagnes/brouillon.php" class="nav-link" role="button" data-key="t-trush"> <?php echo $lang["t-trush"]; ?> </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="/<?php echo $path; ?>/DIR_campagnes/campagne.php" class="nav-link" role="button" data-key="t-create-send"> <?php echo $lang["t-create-send"]; ?> </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="/<?php echo $path; ?>/DIR_campagnes/campagne_b.php" class="nav-link" role="button" data-key="t-list-send"> <?php echo $lang["t-list-send"]; ?> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidemManagement" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidemManagement" data-key="t-management"> <?php echo $lang["t-management"]; ?> </a>
                                            <div class="collapse menu-dropdown" id="sidemManagement">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="/<?php echo $path; ?>/DIR_gestion/partenaires.php" class="nav-link" data-key="t-partenanat"> <?php echo $lang["t-partenanat"]; ?> </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="/<?php echo $path; ?>/DIR_gestion/programmes.php" class="nav-link" data-key="t-programme"> <?php echo $lang["t-programme"]; ?> </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="/<?php echo $path; ?>/DIR_gestion/domaines.php" class="nav-link" data-key="t-domaine"> <?php echo $lang["t-domaine"]; ?> </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="/<?php echo $path; ?>/DIR_gestion/routes.php" class="nav-link" data-key="t-route"> <?php echo $lang["t-route"]; ?> </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="/<?php echo $path; ?>/DIR_gestion/tdpf.php" class="nav-link" data-key="t-volume"> <?php echo $lang["t-volume"]; ?> </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="/<?php echo $path; ?>/DIR_gestion/thematiques.php" class="nav-link" data-key="t-thematique"> <?php echo $lang["t-thematique"]; ?> </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="/<?php echo $path; ?>/DIR_gestion/assoaide.php" class="nav-link" data-key="t-partenanat"> <?php echo $lang["t-partenanat"]; ?> (asso-aide) </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-title"><i class="ri-more-fill"></i><span data-key="t-stat"><?php echo $lang["t-stat"]; ?></span></li>
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sideStat" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sideStat">
                                    <i class="ph-chart-bar-thin"></i> <span data-key="t-stat"><?php echo $lang["t-stat"]; ?></span>
                                </a>
                                <div class="collapse menu-dropdown" id="sideStat">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="/<?php echo $path; ?>/DIR_stats/presentation.php" class="nav-link" role="button" data-key="t-data"> <?php echo $lang["t-data"]; ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/<?php echo $path; ?>/DIR_stats/envois.php" class="nav-link" role="button" data-key="t-send"> <?php echo $lang["t-send"]; ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/<?php echo $path; ?>/DIR_stats/stats.php" class="nav-link" role="button" data-key="t-stat"> <?php echo $lang["t-stat"]; ?> </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/<?php echo $path; ?>/DIR_stats/ediware_cmp.php" class="nav-link" role="button" data-key="t-ediware"> <?php echo $lang["t-ediware"]; ?> </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="d-flex align-items-center opacity-0" id="header-items">

                    <div class="dropdown ms-1 topbar-head-dropdown header-item">
                        <button type="button" class="btn btn-icon btn-topbar rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-search align-middle fs-3xl"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown ms-1 topbar-head-dropdown header-item">
                        <button type="button" class="btn btn-icon btn-topbar rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        if (!empty($_SESSION['lang'])) {
                            $language = $_SESSION['lang'];
                            if ($language == "en") {
                                $imgPath = 'https://img.themesbrand.com/judia/flags/us.svg';
                            } elseif ($language == "es") {
                                $imgPath = 'https://img.themesbrand.com/judia/flags/spain.svg';
                            } elseif ($language == "de") {
                                $imgPath = 'https://img.themesbrand.com/judia/flags/germany.svg';
                            } elseif ($language == "it") {
                                $imgPath = 'https://img.themesbrand.com/judia/flags/italy.svg';
                            } elseif ($language == "ru") {
                                $imgPath = 'https://img.themesbrand.com/judia/flags/russia.svg';
                            } elseif ($language == "zh") {
                                $imgPath = 'https://img.themesbrand.com/judia/flags/china.svg';
                            } elseif ($language == "fr") {
                                $imgPath = 'https://img.themesbrand.com/judia/flags/fr.svg';
                            } elseif ($language == "ar") {
                                $imgPath = 'https://img.themesbrand.com/judia/flags/ae.svg';
                            }else {
                                $imgPath = 'https://img.themesbrand.com/judia/flags/us.svg';
                            }
                        } else {
                            $imgPath = 'https://img.themesbrand.com/judia/flags/us.svg';
                        }
                    ?>
                            <img id="header-lang-img" src="<?php echo $imgPath; ?>" alt="Header Language" height="20" class="rounded">
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
    
                            <!-- item-->
                            <a href="?lang=en" class="dropdown-item notify-item language py-2" data-lang="en" title="English">
                                <img src="https://img.themesbrand.com/judia/flags/us.svg" alt="user-image" class="me-2 rounded" height="18">
                                <span class="align-middle">English</span>
                            </a>
    
                            <!-- item-->
                            <a href="?lang=sp" class="dropdown-item notify-item language" data-lang="es" title="Spanish">
                                <img src="https://img.themesbrand.com/judia/flags/spain.svg" alt="user-image" class="me-2 rounded" height="18">
                                <span class="align-middle">Española</span>
                            </a>
    
                            <!-- item-->
                            <a href="?lang=gr" class="dropdown-item notify-item language" data-lang="de" title="German">
                                <img src="https://img.themesbrand.com/judia/flags/germany.svg" alt="user-image" class="me-2 rounded" height="18"> <span class="align-middle">Deutsche</span>
                            </a>
    
                            <!-- item-->
                            <a href="?lang=it" class="dropdown-item notify-item language" data-lang="it" title="Italian">
                                <img src="https://img.themesbrand.com/judia/flags/italy.svg" alt="user-image" class="me-2 rounded" height="18">
                                <span class="align-middle">Italiana</span>
                            </a>
    
                            <!-- item-->
                            <a href="?lang=ru" class="dropdown-item notify-item language" data-lang="ru" title="Russian">
                                <img src="https://img.themesbrand.com/judia/flags/russia.svg" alt="user-image" class="me-2 rounded" height="18">
                                <span class="align-middle">русский</span>
                            </a>
    
                            <!-- item-->
                            <a href="?lang=ch" class="dropdown-item notify-item language" data-lang="zh" title="Chinese">
                                <img src="https://img.themesbrand.com/judia/flags/china.svg" alt="user-image" class="me-2 rounded" height="18">
                                <span class="align-middle">中国人</span>
                            </a>
    
                            <!-- item-->
                            <a href="?lang=fr" class="dropdown-item notify-item language" data-lang="fr" title="French">
                                <img src="https://img.themesbrand.com/judia/flags/fr.svg" alt="user-image" class="me-2 rounded" height="18">
                                <span class="align-middle">français</span>
                            </a>
    
                            <!-- item-->
                            <a href="?lang=ar" class="dropdown-item notify-item language" data-lang="ar" title="Arabic">
                                <img src="https://img.themesbrand.com/judia/flags/ae.svg" alt="user-image" class="me-2 rounded" height="18">
                                <span class="align-middle">عربي</span>
                            </a>
                        </div>
                    </div>

                    <div class="dropdown topbar-head-dropdown ms-1 header-item">
                        <button type="button" class="btn btn-icon btn-topbar rounded-circle mode-layout" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-sun align-middle fs-3xl"></i>
                        </button>
                        <div class="dropdown-menu p-2 dropdown-menu-end" id="light-dark-mode">
                            <a href="#!" class="dropdown-item" data-mode="light"><i class="bi bi-sun align-middle me-2"></i> Default (light mode)</a>
                            <a href="#!" class="dropdown-item" data-mode="dark"><i class="bi bi-moon align-middle me-2"></i> Dark</a>
                            <a href="#!" class="dropdown-item" data-mode="brand"><i class="bi bi-award align-middle me-2"></i> Brand</a>
                            <a href="#!" class="dropdown-item" data-mode="auto"><i class="bi bi-moon-stars align-middle me-2"></i> Auto (system default)</a>
                        </div>
                    </div>
    
                    <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                        <button type="button" class="btn btn-icon btn-topbar rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                            <i class='bi bi-bell fs-2xl'></i>
                            <span class="position-absolute topbar-badge p-0 d-flex align-items-center justify-content-center translate-middle badge rounded-pill bg-danger"><span class="notification-badge">4</span><span class="visually-hidden">unread messages</span></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
    
                            <div class="dropdown-head rounded-top">
                                <div class="p-3 pb-1">
                                    <div class="row align-items-center mb-3">
                                        <div class="col">
                                            <h6 class="mb-0 fs-lg fw-semibold"> Notifications <span class="badge bg-danger-subtle text-danger fs-sm notification-badge"> 4</span></h6>
                                        </div>
                                        <div class="col-auto dropdown">
                                            <a href="javascript:void(0);" data-bs-toggle="dropdown" class="link-secondary fs-md"><i class="bi bi-three-dots-vertical"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">All Clear</a></li>
                                                <li><a class="dropdown-item" href="#">Mark all as read</a></li>
                                                <li><a class="dropdown-item" href="#">Archive All</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card border-top border-bottom mb-0 rounded-0">
                                <div class="p-3 d-flex align-items-center gap-2">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-bell fs-3xl"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Push Notification</h6>
                                        <p class="text-muted mb-0">Automatically send new notification</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="py-2 ps-3" id="notificationItemsTabContent">
                                <div data-simplebar style="max-height: 300px;" class="pe-3">
                                    <div class="text-reset notification-item d-block dropdown-item position-relative unread-message">
                                        <div class="d-flex gap-3">
                                            <div class="flex-shrink-0">
                                                <img src="assets//images/companies/img-3.png" class="rounded-circle avatar-xs" alt="Notification Images">
                                            </div>
                                            <div class="flex-grow-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="fs-md mb-1 lh-base">Judia Membership</h6>
                                                </a>
                                                <p class="text-muted mb-0">Successfully purchased a business plan for <span class="text-danger fw-medium">-$24.99</span></p>
                                            </div>
                                            <p class="mb-0 fs-xs fw-medium flex-shrink-0 text-muted">
                                                57 sec ago
                                            </p>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex gap-3">
                                            <div class="flex-shrink-0">
                                                <img src="https://img.themesbrand.com/judia/users/avatar-8.jpg" class="rounded-circle avatar-xs" alt="Notification Images">
                                            </div>
                                            <div class="flex-grow-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="fs-md mb-1 lh-base">Bella Bailey</h6>
                                                </a>
                                                <p class="text-muted mb-0">Assigned you on the call with Fatima</p>
                                            </div>
                                            <p class="mb-0 fs-xs fw-medium flex-shrink-0 text-muted">
                                                5 min ago
                                            </p>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex gap-3">
                                            <div class="avatar-xs flex-shrink-0">
                                                <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-lg">
                                                    <i class='bx bx-message-square-dots'></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="text-muted mb-0"><b class="text-body">Nathan Keeling</b> replied to your comment on <b>Steex - Admin & Dashboards</b></p>
                                            </div>
                                            <p class="mb-0 fs-xs fw-medium flex-shrink-0 text-muted">
                                                3 hrs ago
                                            </p>
                                        </div>
                                    </div>
    
                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex gap-3">
                                            <div class="position-relative flex-shrink-0">
                                                <img src="https://img.themesbrand.com/judia/users/avatar-2.jpg" class="rounded-circle avatar-xs" alt="Notification Images">
                                                <span class="active-badge position-absolute start-100 translate-middle p-1 bg-success rounded-circle">
                                                    <span class="visually-hidden">New alerts</span>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="fs-md mb-1 lh-base">Angela Bernier</h6>
                                                </a>
                                                <p class="text-muted mb-0">Answered to your comment on the cash flow forecast's graph 🔔.</p>
                                            </div>
                                            <p class="mb-0 fs-xs fw-medium flex-shrink-0 text-muted">
                                                1 week ago
                                            </p>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex gap-3">
                                            <div class="position-relative flex-shrink-0">
                                                <img src="https://img.themesbrand.com/judia/users/avatar-3.jpg" class="rounded-circle avatar-xs" alt="Notification Images">
                                                <span class="active-badge position-absolute start-100 translate-middle p-1 bg-warning rounded-circle">
                                                    <span class="visually-hidden">New alerts</span>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="fs-md mb-1 lh-base">Maureen Gibson</h6>
                                                </a>
                                                <p class="text-muted mb-0">We talked about a project on linkedin.</p>
                                            </div>
                                            <p class="mb-0 fs-xs fw-medium flex-shrink-0 text-muted">
                                                2 week ago
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="notification-actions" id="notification-actions">
                                    <div class="d-flex text-muted justify-content-center align-items-center">
                                        Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result <button type="button" class="btn btn-link link-danger p-0 ms-2" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown topbar-head-dropdown ms-2 header-item">
                        <button type="button" class="btn btn-icon rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle img-fluid" src="https://img.themesbrand.com/judia/users/avatar-1.jpg" alt="Header Avatar">
                        </button>
                        <div class="dropdown-menu p-2 dropdown-menu-end">
                            <div class="d-flex gap-2 mb-3 topbar-profile">
                                <div class="position-relative">
                                    <img class="rounded-1" src="https://img.themesbrand.com/judia/users/avatar-1.jpg" alt="Header Avatar">
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger"><span class="visually-hidden">unread messages</span></span>
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-sm user-name">Sophia Bethany</h6>
                                    <p class="mb-0 fw-medium fs-xs"><a href="#!">sophia@judia.com</a></p>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="dropdown-item"><i class="bi bi-person align-middle me-2"></i> Profile</a>
                            <a href="javascript:void(0);" class="dropdown-item"><i class="bi bi-chat-right-text align-middle me-2"></i> Messages</a>
                            <a href="javascript:void(0);" class="dropdown-item"><i class="bi bi-gem align-middle me-2"></i> My Subscription</a>
                            <a href="javascript:void(0);" class="dropdown-item"><i class="bi bi-person-gear align-middle me-2"></i> Account Settings</a>
                            <a href="auth-logout.php" class="dropdown-item"><i class="bi bi-box-arrow-right align-middle me-2"></i> Sign Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body p-md-5">
                    <div class="text-center">
                        <div class="text-danger">
                            <i class="bi bi-trash display-4"></i>
                        </div>
                        <div class="mt-4 fs-base">
                            <h4 class="mb-1">Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                    </div>
                </div>
    
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- removeCartModal -->
    <div id="removeCartModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-cartmodal"></button>
                </div>
                <div class="modal-body p-md-5">
                    <div class="text-center">
                        <div class="text-danger">
                            <i class="bi bi-trash display-5"></i>
                        </div>
                        <div class="mt-4">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this product ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="remove-cartproduct">Yes, Delete It!</button>
                    </div>
                </div>
    
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>