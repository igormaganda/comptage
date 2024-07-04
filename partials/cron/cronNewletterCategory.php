<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
try {
    require("../../partials/class/Bdd.php"); 

    $bdd = new Bdd();
    $bd = $bdd->connect(); 

    
    $categories_query = "SELECT DISTINCT category_product FROM public.product_matchs";
    $categories_result = $bd->query($categories_query)->fetchAll(PDO::FETCH_ASSOC);

    $insertStmt = $bd->prepare('INSERT INTO product_template ("name_categorie", "template", "date_input") VALUES (?, ?, NOW())');
    $template = file_get_contents('template.html');

   
    foreach ($categories_result as $category) {
        $category_name = $category['category_product'];

        
        $products_query = "SELECT 
                                title_product,
                                price_product,
                                image_product,
                                link_product,
                                category_product,
                                brand_product
                            FROM 
                                public.product_matchs
                            WHERE 
                            (status_product='mn' OR status_product='my') 
                             AND category_product = ? LIMIT 5";
        $products_stmt = $bd->prepare($products_query);
        $products_stmt->execute([$category_name]);
        $products_result = $products_stmt->fetchAll(PDO::FETCH_ASSOC);

        // Générer le contenu du template pour cette catégorie
        $content = '';
        foreach ($products_result as $product) {
            $content .= '<table align="left" cellpadding="0" cellspacing="0" class="es-left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">';
            $content .= '<tbody>';
            $content .= '<tr style="border-collapse:collapse">';
            $content .= '<td align="left" class="es-m-p20b" style="padding:0;Margin:0;width:167px">';
            $content .= '<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">';
            $content .= '<tbody>';
            $content .= '<tr style="border-collapse:collapse">';
            $content .= '<td align="center" style="padding:5px;Margin:0;font-size:0px"><a href="' . htmlspecialchars($product['link_product']) . '" spellcheck="false" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#D60B2C;font-size:14px" target="_blank"><img alt="' . htmlspecialchars($product['title_product']) . '" class="adapt-img p_image" height="152" src="' . htmlspecialchars($product['image_product']) . '" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;width:152px" title="Hachoir Quid Naturalia Vert Métal 8,2 x 23 cm Manuel" width="152" /></a></td>';
            $content .= '</tr>';
            $content .= '<tr style="border-collapse:collapse">';
            $content .= '<td align="center" spellcheck="false" style="Margin:0;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:15px">';
            $content .= '<h3 class="p_name" style="Margin:0;line-height:18px;mso-line-height-rule:exactly;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#333333">' . htmlspecialchars($product['title_product']) . '</h3>';
            $content .= '<mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension></td>';
            $content .= '</tr>';
            $content .= '<tr style="border-collapse:collapse">';
            $content .= '<td align="center" bgcolor="transparent" spellcheck="false" style="Margin:0;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:10px">';
            $content .= '<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;line-height:30px;color:#666666;font-size:14px"><strong><span style="color:#ff0000;font-size:20px">' . htmlspecialchars($product['price_product']) . '</span></strong></p>';
            $content .= '<mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension></td>';
            $content .= '</tr>';
            $content .= '<tr style="border-collapse:collapse">';
            $content .= '<td align="center" style="padding:0;Margin:0;padding-left:10px;padding-right:10px;padding-bottom:20px"><a href="' . htmlspecialchars($product['link_product']) . '" target="_blank" hidden> <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="' . htmlspecialchars($product['link_product']) . '" style="height:39px; v-text-anchor:middle; width:139px" arcsize="50%" stroke="f" fillcolor="#d60b2c"> <w:anchorlock></w:anchorlock> <center style=\'color:#ffffff; font-family:helvetica, "helvetica neue", arial, verdana, sans-serif; font-size:14px; font-weight:400; line-height:14px; mso-text-raise:1px\'>Commander</center> </v:roundrect></a>';
            $content .= '<span class="msohide es-button-border" style="border-style:solid;border-color:transparent;background:#D60B2C;border-width:0px;display:inline-block;border-radius:20px;width:auto;mso-hide:all"><a class="es-button" href="' . htmlspecialchars($product['link_product']) . '" spellcheck="false" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:16px;display:inline-block;background:#D60B2C;border-radius:20px;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center;padding:10px 25px 10px 25px;mso-padding-alt:0;mso-border-alt:10px solid #D60B2C" target="_blank">Commander</a> </span></td>';
            $content .= '</tr>';
            $content .= '</tbody>';
            $content .= '</table>';
            $content .= '</td>';
            $content .= '</tr>';
            $content .= '</tbody>';
            $content .= '</table>';
        }

        // Générer le template complet
            $template_first = str_replace('<div id="contentfrist"></div>', $content, $template);

            // Sélectionnez les produits de la catégorie actuelle
            $products_query = "SELECT 
                    title_product,
                    price_product,
                    image_product,
                    link_product,
                    category_product,
                    brand_product
                FROM 
                    public.product_matchs
                WHERE 
                    
                (status_product='mx' OR status_product='my')  AND category_product = ? LIMIT 6";
            $products_stmt = $bd->prepare($products_query);
            $products_stmt->execute([$category_name]);
            $products_result = $products_stmt->fetchAll(PDO::FETCH_ASSOC);

            // Générer le contenu du template pour cette catégorie
            $contents = '';
            foreach ($products_result as $product) {
            $contents .= '<table align="left" cellpadding="0" cellspacing="0" class="es-left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">';
            $contents .= '<tbody>';
            $contents .= '<tr style="border-collapse:collapse">';
            $contents .= '<td align="left" class="es-m-p20b" style="padding:0;Margin:0;width:167px">';
            $contents .= '<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">';
            $contents .= '<tbody>';
            $contents .= '<tr style="border-collapse:collapse">';
            $contents .= '<td align="center" style="padding:5px;Margin:0;font-size:0px"><a href="' . htmlspecialchars($product['link_product']) . '" spellcheck="false" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#D60B2C;font-size:14px" target="_blank"><img alt="' . htmlspecialchars($product['title_product']) . '" class="adapt-img p_image" height="152" src="' . htmlspecialchars($product['image_product']) . '" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;width:152px" title="Hachoir Quid Naturalia Vert Métal 8,2 x 23 cm Manuel" width="152" /></a></td>';
            $contents .= '</tr>';
            $contents .= '<tr style="border-collapse:collapse">';
            $contents .= '<td align="center" spellcheck="false" style="Margin:0;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:15px">';
            $contents .= '<h3 class="p_name" style="Margin:0;line-height:18px;mso-line-height-rule:exactly;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#333333">' . htmlspecialchars($product['title_product']) . '</h3>';
            $contents .= '<mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension></td>';
            $contents .= '</tr>';
            $contents .= '<tr style="border-collapse:collapse">';
            $contents .= '<td align="center" bgcolor="transparent" spellcheck="false" style="Margin:0;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:10px">';
            $contents .= '<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;line-height:30px;color:#666666;font-size:14px"><strong><span style="color:#ff0000;font-size:20px">' . htmlspecialchars($product['price_product']) . '</span></strong></p>';
            $contents .= '<mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension></td>';
            $contents .= '</tr>';
            $contents .= '<tr style="border-collapse:collapse">';
            $contents .= '<td align="center" style="padding:0;Margin:0;padding-left:10px;padding-right:10px;padding-bottom:20px"><a href="' . htmlspecialchars($product['link_product']) . '" target="_blank" hidden> <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="' . htmlspecialchars($product['link_product']) . '" style="height:39px; v-text-anchor:middle; width:139px" arcsize="50%" stroke="f" fillcolor="#d60b2c"> <w:anchorlock></w:anchorlock> <center style=\'color:#ffffff; font-family:helvetica, "helvetica neue", arial, verdana, sans-serif; font-size:14px; font-weight:400; line-height:14px; mso-text-raise:1px\'>Commander</center> </v:roundrect></a>';
            $contents .= '<span class="msohide es-button-border" style="border-style:solid;border-color:transparent;background:#D60B2C;border-width:0px;display:inline-block;border-radius:20px;width:auto;mso-hide:all"><a class="es-button" href="' . htmlspecialchars($product['link_product']) . '" spellcheck="false" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:16px;display:inline-block;background:#D60B2C;border-radius:20px;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center;padding:10px 25px 10px 25px;mso-padding-alt:0;mso-border-alt:10px solid #D60B2C" target="_blank">Commander</a> </span></td>';
            $contents .= '</tr>';
            $contents .= '</tbody>';
            $contents .= '</table>';
            $contents .= '</td>';
            $contents .= '</tr>';
            $contents .= '</tbody>';
            $contents .= '</table>';
            }

        // Générer le template complet
        $template_seconde = str_replace('<div id="contentseconde"></div>', $contents, $template_first);

        $template_title = str_replace('<span id="title"></span>', $category_name, $template_seconde);
        $template_all = str_replace('<title id="title"></title>', $category_name, $template_title);
        // Insérer le template dans la base de données
        $insertStmt->execute([$category_name, $template_all]);
    }
    foreach ($categories_result as $category) {
        $category_name = $category['category_product'];

        
        $products_query = "SELECT 
                                title_product,
                                price_product,
                                image_product,
                                link_product,
                                category_product,
                                brand_product
                            FROM 
                                public.product_matchs
                            WHERE 
                            (status_product='mn' OR status_product='mx') 
                             AND category_product = ? LIMIT 5";
        $products_stmt = $bd->prepare($products_query);
        $products_stmt->execute([$category_name]);
        $products_result = $products_stmt->fetchAll(PDO::FETCH_ASSOC);

        // Générer le contenu du template pour cette catégorie
        $content = '';
        foreach ($products_result as $product) {
            $content .= '<table align="left" cellpadding="0" cellspacing="0" class="es-left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">';
            $content .= '<tbody>';
            $content .= '<tr style="border-collapse:collapse">';
            $content .= '<td align="left" class="es-m-p20b" style="padding:0;Margin:0;width:167px">';
            $content .= '<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">';
            $content .= '<tbody>';
            $content .= '<tr style="border-collapse:collapse">';
            $content .= '<td align="center" style="padding:5px;Margin:0;font-size:0px"><a href="' . htmlspecialchars($product['link_product']) . '" spellcheck="false" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#D60B2C;font-size:14px" target="_blank"><img alt="' . htmlspecialchars($product['title_product']) . '" class="adapt-img p_image" height="152" src="' . htmlspecialchars($product['image_product']) . '" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;width:152px" title="Hachoir Quid Naturalia Vert Métal 8,2 x 23 cm Manuel" width="152" /></a></td>';
            $content .= '</tr>';
            $content .= '<tr style="border-collapse:collapse">';
            $content .= '<td align="center" spellcheck="false" style="Margin:0;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:15px">';
            $content .= '<h3 class="p_name" style="Margin:0;line-height:18px;mso-line-height-rule:exactly;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#333333">' . htmlspecialchars($product['title_product']) . '</h3>';
            $content .= '<mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension></td>';
            $content .= '</tr>';
            $content .= '<tr style="border-collapse:collapse">';
            $content .= '<td align="center" bgcolor="transparent" spellcheck="false" style="Margin:0;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:10px">';
            $content .= '<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;line-height:30px;color:#666666;font-size:14px"><strong><span style="color:#ff0000;font-size:20px">' . htmlspecialchars($product['price_product']) . '</span></strong></p>';
            $content .= '<mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension></td>';
            $content .= '</tr>';
            $content .= '<tr style="border-collapse:collapse">';
            $content .= '<td align="center" style="padding:0;Margin:0;padding-left:10px;padding-right:10px;padding-bottom:20px"><a href="' . htmlspecialchars($product['link_product']) . '" target="_blank" hidden> <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="' . htmlspecialchars($product['link_product']) . '" style="height:39px; v-text-anchor:middle; width:139px" arcsize="50%" stroke="f" fillcolor="#d60b2c"> <w:anchorlock></w:anchorlock> <center style=\'color:#ffffff; font-family:helvetica, "helvetica neue", arial, verdana, sans-serif; font-size:14px; font-weight:400; line-height:14px; mso-text-raise:1px\'>Commander</center> </v:roundrect></a>';
            $content .= '<span class="msohide es-button-border" style="border-style:solid;border-color:transparent;background:#D60B2C;border-width:0px;display:inline-block;border-radius:20px;width:auto;mso-hide:all"><a class="es-button" href="' . htmlspecialchars($product['link_product']) . '" spellcheck="false" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:16px;display:inline-block;background:#D60B2C;border-radius:20px;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center;padding:10px 25px 10px 25px;mso-padding-alt:0;mso-border-alt:10px solid #D60B2C" target="_blank">Commander</a> </span></td>';
            $content .= '</tr>';
            $content .= '</tbody>';
            $content .= '</table>';
            $content .= '</td>';
            $content .= '</tr>';
            $content .= '</tbody>';
            $content .= '</table>';
        }

        // Générer le template complet
            $template_first = str_replace('<div id="contentfrist"></div>', $content, $template);

            // Sélectionnez les produits de la catégorie actuelle
            $products_query = "SELECT 
                    title_product,
                    price_product,
                    image_product,
                    link_product,
                    category_product,
                    brand_product
                FROM 
                    public.product_matchs
                WHERE 
                    
                (status_product='mx' OR status_product='my')  AND category_product = ? LIMIT 6";
            $products_stmt = $bd->prepare($products_query);
            $products_stmt->execute([$category_name]);
            $products_result = $products_stmt->fetchAll(PDO::FETCH_ASSOC);

            // Générer le contenu du template pour cette catégorie
            $contents = '';
            foreach ($products_result as $product) {
            $contents .= '<table align="left" cellpadding="0" cellspacing="0" class="es-left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">';
            $contents .= '<tbody>';
            $contents .= '<tr style="border-collapse:collapse">';
            $contents .= '<td align="left" class="es-m-p20b" style="padding:0;Margin:0;width:167px">';
            $contents .= '<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px" width="100%">';
            $contents .= '<tbody>';
            $contents .= '<tr style="border-collapse:collapse">';
            $contents .= '<td align="center" style="padding:5px;Margin:0;font-size:0px"><a href="' . htmlspecialchars($product['link_product']) . '" spellcheck="false" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#D60B2C;font-size:14px" target="_blank"><img alt="' . htmlspecialchars($product['title_product']) . '" class="adapt-img p_image" height="152" src="' . htmlspecialchars($product['image_product']) . '" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;width:152px" title="Hachoir Quid Naturalia Vert Métal 8,2 x 23 cm Manuel" width="152" /></a></td>';
            $contents .= '</tr>';
            $contents .= '<tr style="border-collapse:collapse">';
            $contents .= '<td align="center" spellcheck="false" style="Margin:0;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:15px">';
            $contents .= '<h3 class="p_name" style="Margin:0;line-height:18px;mso-line-height-rule:exactly;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#333333">' . htmlspecialchars($product['title_product']) . '</h3>';
            $contents .= '<mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension></td>';
            $contents .= '</tr>';
            $contents .= '<tr style="border-collapse:collapse">';
            $contents .= '<td align="center" bgcolor="transparent" spellcheck="false" style="Margin:0;padding-top:5px;padding-left:5px;padding-right:5px;padding-bottom:10px">';
            $contents .= '<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;line-height:30px;color:#666666;font-size:14px"><strong><span style="color:#ff0000;font-size:20px">' . htmlspecialchars($product['price_product']) . '</span></strong></p>';
            $contents .= '<mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension><mci-extension data-role="overlay" id="overlay-root"></mci-extension></td>';
            $contents .= '</tr>';
            $contents .= '<tr style="border-collapse:collapse">';
            $contents .= '<td align="center" style="padding:0;Margin:0;padding-left:10px;padding-right:10px;padding-bottom:20px"><a href="' . htmlspecialchars($product['link_product']) . '" target="_blank" hidden> <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="' . htmlspecialchars($product['link_product']) . '" style="height:39px; v-text-anchor:middle; width:139px" arcsize="50%" stroke="f" fillcolor="#d60b2c"> <w:anchorlock></w:anchorlock> <center style=\'color:#ffffff; font-family:helvetica, "helvetica neue", arial, verdana, sans-serif; font-size:14px; font-weight:400; line-height:14px; mso-text-raise:1px\'>Commander</center> </v:roundrect></a>';
            $contents .= '<span class="msohide es-button-border" style="border-style:solid;border-color:transparent;background:#D60B2C;border-width:0px;display:inline-block;border-radius:20px;width:auto;mso-hide:all"><a class="es-button" href="' . htmlspecialchars($product['link_product']) . '" spellcheck="false" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:16px;display:inline-block;background:#D60B2C;border-radius:20px;font-family:helvetica, \'helvetica neue\', arial, verdana, sans-serif;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center;padding:10px 25px 10px 25px;mso-padding-alt:0;mso-border-alt:10px solid #D60B2C" target="_blank">Commander</a> </span></td>';
            $contents .= '</tr>';
            $contents .= '</tbody>';
            $contents .= '</table>';
            $contents .= '</td>';
            $contents .= '</tr>';
            $contents .= '</tbody>';
            $contents .= '</table>';
            }

        // Générer le template complet
        $template_seconde = str_replace('<div id="contentseconde"></div>', $contents, $template_first);

        $template_title = str_replace('<span id="title"></span>', $category_name, $template_seconde);
        $template_all = str_replace('<title id="title"></title>', $category_name, $template_title);
        // Insérer le template dans la base de données
        $insertStmt->execute([$category_name, $template_all]);
    }
    echo 'Templates insérés avec succès.';

} catch (PDOException $e) {
    echo 'Échec de la connexion : ' . $e->getMessage();
}
