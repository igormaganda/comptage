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
                                <img src="assets/images/MGD1.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/MGD1.png" alt="" height="22">
                            </span>
                        </a>
    
                        <a href="index.php" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="assets/images/MGD1.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/MGD1.png" alt="" height="22">
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
                                <img src="assets/images/MGD1.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/MGD1.png" alt="" height="22">
                            </span>
                        </a>

                        <a href="index" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="assets/images/MGD1.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/MGD1.png" alt="" height="22">
                            </span>
                        </a>
                    </div>
                    <div id="scrollbar">
                        <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="menu-title"><i class="ri-more-fill"></i><span data-key="t-general"><?php echo $lang["t-general"]; ?></span></li>
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