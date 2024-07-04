<?php
	require_once("../../partials/class/Bdd.php");
	require_once("../../partials/class/Calc.php");

	$bdd = new Bdd();
	$calc = new Calc();

	$bd = $bdd->connect();
	
	$reqSQL = "SELECT COUNT(*) AS total_email FROM nettoyage_stats WHERE DATE(\"Date_nettoyage\") = CURRENT_DATE";
    $resData = $bd->query($reqSQL)->fetch(PDO::FETCH_ASSOC);

    $reqSQL = "SELECT COUNT(*) AS tmailvalide FROM nettoyage_stats WHERE \"Check\" ='valide' AND DATE(\"Date_nettoyage\") = CURRENT_DATE";
    $resDataVal = $bd->query($reqSQL)->fetch(PDO::FETCH_ASSOC);

    $reqSQL = "SELECT COUNT(*) AS tmailinv FROM nettoyage_stats WHERE \"Check\" ='invalide' OR \"Check\" ='bounce' AND DATE(\"Date_nettoyage\") = CURRENT_DATE";
    $resDataInv = $bd->query($reqSQL)->fetch(PDO::FETCH_ASSOC);

    $reqSQL = "SELECT COUNT(*) AS tmailconn FROM nettoyage_stats WHERE \"Check\" ='connexion' AND DATE(\"Date_nettoyage\") = CURRENT_DATE";
    $resDataConn = $bd->query($reqSQL)->fetch(PDO::FETCH_ASSOC);

  
    $insert = "INSERT INTO nettoyage_count (\"Email_total\", \"Email_valide\", \"Email_invalide\", \"Erreur_connexion\", \"Date_count\") VALUES (?, ?, ?, ?, NOW())";
    $stmt = $bd->prepare($insert);
    $stmt->execute([$resData['total_email'], $resDataVal['tmailvalide'], $resDataInv['tmailinv'], $resDataConn['tmailconn']]);


    //cron pour le serveur
    $reqServer = "SELECT 
        \"Serveur\",
        COUNT(*) AS nbrefichier,
        SUM(CASE WHEN \"Check\" = 'valide' THEN 1 ELSE 0 END) AS nbrefichiervalide,
        SUM(CASE WHEN \"Check\" = 'invalide' OR \"Check\" = 'bounce' THEN 1 ELSE 0 END) AS nbrefichierinvalide,
        SUM(CASE WHEN \"Check\" = 'connexion' THEN 1 ELSE 0 END) AS nbrefichierconn
    FROM 
        nettoyage_stats 
    WHERE 
    DATE_TRUNC('day', TO_TIMESTAMP(\"Date\", 'DD/MM/YYYY HH24:MI:SS')) = CURRENT_DATE
    GROUP BY 
        \"Serveur\"";

    $resServer = $bd->query($reqServer)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resServer as $dateinsert) {
        $insert = "INSERT INTO nettoyage_serveur (\"Fichier_total\", \"Fichier_valide\", \"Fichier_invalide\", \"Erreur_connexion\", \"Serveur\", \"Date_server\") VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $bd->prepare($insert);
        $stmt->execute([$dateinsert['nbrefichier'], $dateinsert['nbrefichiervalide'], $dateinsert['nbrefichierinvalide'], $dateinsert['nbrefichierconn'], $dateinsert['Serveur']]);
    }


    /* ======================================================================================================================== */

    /*  
        CRON STATISTIC APPEL D'API
    */

    $reqSQL = "SELECT COUNT(*) AS comptage, SUM(\"total_price\") AS t_prices, SUM(\"volume_appel\") AS contacts FROM order_api WHERE DATE(\"order_date\") = CURRENT_DATE";
    $resData = $bd->query($reqSQL)->fetch(PDO::FETCH_ASSOC);

    $reqSQL = "SELECT COUNT(*) AS campagnes FROM order_api WHERE status_compagne = 'buy' AND DATE(\"order_date\") = CURRENT_DATE;";
    $resComp = $bd->query($reqSQL)->fetch(PDO::FETCH_ASSOC);

    $insert = "INSERT INTO stats_appel (\"stats_count\", \"stats_campagnes\", \"stats_contact\", \"stats_revenus\", \"stats_charge\", \"date_appel\") VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $bd->prepare($insert);
    $stmt->execute([$resData['comptage'], $resComp['campagnes'], $resData['contacts'], $resData['t_prices'], 0]);

    /*
        CRON POUR AJOUTER LES DATA DANS LA TABLE STATS_APPEL_ACCOUNT
    */

    $reqSQL = "SELECT \"email\", COUNT(*) AS comptage, SUM(\"total_price\") AS t_prices, SUM(\"volume_appel\") AS contacts 
        FROM order_api 
        WHERE DATE(\"order_date\") = CURRENT_DATE
        GROUP BY \"email\"";
    $resGroupA = $bd->query($reqSQL)->fetchAll(PDO::FETCH_ASSOC);


    $reqSQL = "SELECT \"email\", COUNT(*) AS campagnes 
        FROM order_api 
        WHERE status_compagne = 'buy' AND DATE(\"order_date\") = CURRENT_DATE
        GROUP BY \"email\"";
    $rescam = $bd->query($reqSQL)->fetchAll(PDO::FETCH_ASSOC);


    $groupData = [];
    foreach ($resGroupA as $row) {
        $groupData[$row['email']] = $row;
    }

    $campaignDataBuy = [];
    foreach ($rescam as $row) {
        $campaignDataBuy[$row['email']] = $row['campagnes'];
    }


    $allEmails = array_unique(array_merge(
        array_keys($groupData),
        array_keys($campaignDataBuy)
    ));

    foreach ($allEmails as $email) {
        $comptage = isset($groupData[$email]['comptage']) ? $groupData[$email]['comptage'] : 0;
        $t_prices = isset($groupData[$email]['t_prices']) ? $groupData[$email]['t_prices'] : 0;
        $contacts = isset($groupData[$email]['contacts']) ? $groupData[$email]['contacts'] : 0;
        $campagnesBuy = isset($campaignDataBuy[$email]) ? $campaignDataBuy[$email] : 0;


        $insert = "INSERT INTO stats_appel_account (\"stats_email\", \"stats_count\", \"stats_campagnes\", \"stats_contact\", \"stats_revenus\", \"stats_charge\", \"date_appel\") 
                VALUES (?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $bd->prepare($insert);
            $stmt->execute([
                $email,
                $comptage,
                $campagnesBuy, 
                $contacts,
                $t_prices,
                0
            ]);
    }
