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
                                <img src="https://img.themesbrand.com/judia/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="https://img.themesbrand.com/judia/logo-dark.png" alt="" height="22">
                            </span>
                        </a>

                        <a href="index" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="https://img.themesbrand.com/judia/logo-sm.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="https://img.themesbrand.com/judia/logo-light.png" alt="" height="22">
                            </span>
                        </a>
                    </div>
                    <div id="scrollbar">
                        <ul class="navbar-nav" id="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="search_btob.php">
                                   <!-- <i class="ph-paint-brush-broad"></i> <span>Btob</span>-->
                                    <i class=" bx bx-group "></i> <span>Btob</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="search_btoc.php">
                                    <i class=" bx bx-user-check"></i> <span >Btoc</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                
                <div class="d-flex align-items-center opacity-0" id="header-items">
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