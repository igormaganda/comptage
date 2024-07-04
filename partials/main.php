<?php

require_once ("lang.php");

function includeFileWithVariables($filePath, $variables = array(), $print = true)
{
    $output = NULL;
    if(file_exists($filePath)){
        // Extract the variables to a local namespace
        extract($variables);

        // Start output buffering
        ob_start();

        // Include the template file
        include $filePath;
		
		// End buffering and return its contents
		$output = ob_get_clean();
    }
    if ($print) {
        print $output;
    }
    return $output;
}

$isScssconverted = false;

require_once ("scssphp/scss.inc.php");

use ScssPhp\ScssPhp\Compiler;

if($isScssconverted){

    global $compiler;
    $compiler = new Compiler();

    $compine_css = "assets/css/app.min.css";

    $source_scss = "assets/scss/config/default/app.scss";

    $scssContents = file_get_contents($source_scss);

    $import_path = "assets/scss/config/default";
    $compiler->addImportPath($import_path);
    $target_css = $compine_css;

    $css = $compiler->compile($scssContents);

    if (!empty($css) && is_string($css)) {
        file_put_contents($target_css, $css);
    }
}

	$rpath = realpath("./");
	$vdev = "";
 
	if (!isset($GLOBALS['env'])) {
		$rpath = realpath("./");
		$vdev = "";

		if (strpos($rpath, "C:") === false) {
			if (strpos($rpath, "Datamart_dev")) {
			    $path = "Datamart_dev";
			    $vdev = " (Dev)";
			    $GLOBALS['env'] = 2;
			} elseif (strpos($rpath, "Datamart_test")) {
				$path = "Datamart_test";
				$vdev = " (Test)";
				$GLOBALS['env'] = 3;
			} elseif (strpos($rpath, "Datamart_nettoyage")) {
				$path = "Datamart_nettoyage";
				$vdev = " (Nettoyage)";
				$GLOBALS['env'] = 4;
			} elseif (strpos($rpath, "adn")) {
				$path = "adn";
				$GLOBALS['env'] = 100;
			} elseif (strpos($rpath, "ber")) {
				$path = "ber";
				$GLOBALS['env'] = 10;
			} else {
				$path = "Datamart";
				$pathTest = "Datamart/New/v4";
				$GLOBALS['env'] = 1;
			}
		} else {
			$path = "Datamart";
			$pathTest = "Datamart/New/v4";
			$vdev = " (Local)";
			$GLOBALS['env'] = 0;
		}
	}

	require_once('class/Calc.php');
?>

<!doctype html>
<html lang="en" data-layout="horizontal" data-layout-width="boxed" data-sidebar="light" data-topbar="dark" data-preloader="disable" data-card-layout="borderless" data-bs-theme="light" data-topbar-image="pattern-1" data-sidebar-size="lg">