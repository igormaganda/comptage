<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
require_once("../../partials/class/Bdd.php");
require_once("../../partials/class/Calc.php");

$bdd = new Bdd();
$calc = new Calc();

$bd = $bdd->connect();

/**
 * Sélectionne des produits dont le prix est minimun
 */
$reqmin= "SELECT DISTINCT
            pm.title_amazone,
            pm.image_link,
            pm.amz_price,
            pm.amazone_link,
            pm.amz_brand,
            pm.amz_category
        FROM 
            product_match pm
        JOIN (
        SELECT 
            title_amazone,
            MIN(amz_price) AS min_price
        FROM 
            product_match
        WHERE 
            amz_price <= (SELECT PERCENTILE_CONT(0.33) WITHIN GROUP (ORDER BY amz_price) FROM product_match)
        GROUP BY 
            title_amazone
        ) AS min_prices ON pm.title_amazone = min_prices.title_amazone AND pm.amz_price = min_prices.min_price
        ORDER BY 
            pm.amz_price ASC";

$reqnewmn = $bd->query($reqmin)->fetchAll(PDO::FETCH_ASSOC);

foreach ($reqnewmn as $dateinput) {
    $insert = "INSERT INTO product_matchs (\"title_product\", \"price_product\", \"image_product\", \"link_product\", \"category_product\",\"brand_product\", \"status_product\", \"date_input\") VALUES (?, ?, ?, ?, ?, ?, 'mn', NOW())";
    $stmt = $bd->prepare($insert);
    $stmt->execute([$dateinput['title_amazone'], $dateinput['amz_price'], $dateinput['image_link'], $dateinput['amazone_link'], $dateinput['amz_category'], $dateinput['amz_brand']]);
}

/**
 * Sélectionne des produits dont le prix est maximun
 */
$reqmax= "SELECT DISTINCT
            pm.title_amazone,
            pm.image_link,
            pm.amz_price,
            pm.amazone_link,
            pm.amz_brand,
            pm.amz_category
        FROM 
            product_match pm
        JOIN (
        SELECT 
            title_amazone,
            MIN(amz_price) AS max_price
        FROM 
            product_match
        WHERE 
            amz_price >= (SELECT PERCENTILE_CONT(0.67) WITHIN GROUP (ORDER BY amz_price) FROM product_match)
        GROUP BY 
            title_amazone
        ) AS max_prices ON pm.title_amazone = max_prices.title_amazone AND pm.amz_price = max_prices.max_price
        ORDER BY 
            pm.amz_price DESC";

$reqnewmx = $bd->query($reqmax)->fetchAll(PDO::FETCH_ASSOC);
foreach ($reqnewmx as $dateinput) {
    $insert = "INSERT INTO product_matchs (\"title_product\", \"price_product\", \"image_product\", \"link_product\", \"category_product\",\"brand_product\", \"status_product\", \"date_input\") VALUES (?, ?, ?, ?, ?, ?, 'mx', NOW())";
    $stmt = $bd->prepare($insert);
    $stmt->execute([$dateinput['title_amazone'], $dateinput['amz_price'], $dateinput['image_link'], $dateinput['amazone_link'], $dateinput['amz_category'], $dateinput['amz_brand']]);
}

$reqavg= "WITH percentiles AS (
                SELECT 
                    PERCENTILE_CONT(0.33) WITHIN GROUP (ORDER BY amz_price) AS lower_bound,
                    PERCENTILE_CONT(0.67) WITHIN GROUP (ORDER BY amz_price) AS upper_bound
                FROM product_match
            )
            SELECT 
                title_amazone,
                MIN(image_link) AS image_link,
                MIN(amz_price) AS min_price,
                MIN(amazone_link) AS amazone_link,
                MIN(amz_brand) AS amz_brand,
                MIN(amz_category) AS amz_category
            FROM 
                product_match, percentiles
            WHERE 
                amz_price BETWEEN percentiles.lower_bound AND percentiles.upper_bound
            GROUP BY 
                title_amazone
            ORDER BY 
                min_price ASC";

$reqnewmy = $bd->query($reqavg)->fetchAll(PDO::FETCH_ASSOC);
foreach ($reqnewmy as $dateinput) {
    $insert = "INSERT INTO product_matchs (\"title_product\", \"price_product\", \"image_product\", \"link_product\", \"category_product\",\"brand_product\", \"status_product\", \"date_input\") VALUES (?, ?, ?, ?, ?, ?, 'my', NOW())";
    $stmt = $bd->prepare($insert);
    $stmt->execute([$dateinput['title_amazone'], $dateinput['min_price'], $dateinput['image_link'], $dateinput['amazone_link'], $dateinput['amz_category'], $dateinput['amz_brand']]);
}