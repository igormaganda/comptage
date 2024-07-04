<?php
require("partials/class/Bdd.php");
require("partials/search_btoc.php");
?>

<div id="content" style="min-height: 1500px !important;">
    <?php
    $search = new Search($_POST, TRUE);
    ?>
</div>
