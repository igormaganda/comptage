<?php
    /*
        DEBUGER LE CODE PHP
    */ 
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    require("../partials/class/Bdd.php"); 

    $bdd = new Bdd();
    $bd = $bdd->connect(); 
    $req = "SELECT 
                title_product,
                price_product,
                image_product,
                link_product,
                category_product,
                brand_product,
                status_product
            FROM 
                public.product_matchs 
            WHERE 
                category_product = (
                    SELECT 
                        category_product 
                    FROM 
                        public.product_matchs 
                    WHERE 
                        status_product ='mn' 
                    LIMIT 1
                    OFFSET 0 
                )
            AND 
                status_product ='my' 
            LIMIT 6";

    $reqResult = $bd->query($req)->fetchAll(PDO::FETCH_ASSOC);
    
