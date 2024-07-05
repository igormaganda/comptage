<?php //include 'partials/session.php'; 
?>
<?php include 'partials/main.php'; ?>

<?php
$odometer = 1;
$map = 1;

// require_once("../../../sdatamart/lib/system_load.php");
// authenticate_user('all');
require("partials/class/Bdd.php");

$bdd = new Bdd();
?>

<head>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.7/themes/odometer-theme-default.css" integrity="sha512-kMPqFnKueEwgQFzXLEEl671aHhQqrZLS5IP3HzqdfozaST/EgU+/wkM07JCmXFAt9GO810I//8DBonsJUzGQsQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="assets/libs/nouislider/nouislider.min.css">
    <!-- Sweet Alert css-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- dropzone css -->
    <link href="assets/libs/dropzone/dropzone.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="assets/libs/multi.js/multi.min.css" >
    <!-- autocomplete css -->
    <link rel="stylesheet" href="assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css">

    <?php include 'partials/head-css.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/multi.js/dist/multi.min.js"></script>

    <style>
        .strikethrough {
            text-decoration: line-through;
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

        
            <!-- End Page-content -->

            <?php include 'partials/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

<?php include 'partials/vendor-scripts.php'; ?>



<!-- App js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script src="assets/js/pages/form-advanced.init.js"></script>
<script src="assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js"></script>
<script src="assets/libs/multi.js/multi.min.js"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.7/odometer.min.js" integrity="sha512-v3fZyWIk7kh9yGNQZf1SnSjIxjAKsYbg6UQ+B+QxAZqJQLrN3jMjrdNwcxV6tis6S0s1xyVDZrDz9UoRLfRpWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="assets/libs/nouislider/nouislider.min.js"></script>
<script src="assets/libs/wnumb/wNumb.min.js"></script>

<script src="assets/js/pages/range-sliders.init.js"></script>
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- dropzone js -->
<script src="assets/libs/dropzone/dropzone-min.js"></script>
<script src="assets/libs/list.js/list.min.js"></script>

<script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>

<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="assets/js/pages/file-manager.init.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment-with-locales.min.js" integrity="sha512-vFABRuf5oGUaztndx4KoAEUVQnOvAIFs59y4tO0DILGWhQiFnFHiR+ZJfxLDyJlXgeut9Z07Svuvm+1Jv89w5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="assets/js/app.js"></script>
</body>

</html>
