<?php


class Bdd {

    private $db;
    private $requete = '';

    private $PARAM_hote;
    private $PARAM_port;
    private $PARAM_nom_bd;
    private $PARAM_utilisateur;
    private $PARAM_mot_passe;

    public function __construct() {

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
                    $GLOBALS['env'] = 1;
                }
            } else {
                $path = "Datamart";
                $vdev = " (Local)";
                $GLOBALS['env'] = 0;
            }
        }

        switch ($GLOBALS['env']) {
            case 0: // Windows
                /*
                                    $this->PARAM_hote        ='localhost';
                                    $this->PARAM_port        ='5432';
                                    $this->PARAM_nom_bd      ='datamart';
                                    $this->PARAM_utilisateur ='postgres';
                                    $this->PARAM_mot_passe   ='root';
                */

                $this->PARAM_hote        ='localhost';
                $this->PARAM_port        ='5432';
                $this->PARAM_nom_bd      ='datamart';
                $this->PARAM_utilisateur ='postgres';
                $this->PARAM_mot_passe   ='P057G435';

                break;


            case 1: // Prod
                $this->PARAM_hote        ='localhost';
                $this->PARAM_port        ='5432';
                $this->PARAM_nom_bd      ='datamart2';
                $this->PARAM_utilisateur ='postgres';
                $this->PARAM_mot_passe   ='P057G435';
                break;

            case 10: // BERTRAND
                $this->PARAM_hote        ='localhost';
                $this->PARAM_port        ='5432';
                $this->PARAM_nom_bd      ='datamart_ber';
                $this->PARAM_utilisateur ='postgres';
                $this->PARAM_mot_passe   ='P057G435';
                break;

            case 100: // ADN
                $this->PARAM_hote        ='localhost';
                $this->PARAM_port        ='5432';
                $this->PARAM_nom_bd      ='datamart_adn';
                $this->PARAM_utilisateur ='postgres';
                $this->PARAM_mot_passe   ='P057G435';
                break;

            case 2: // Préprod
                $this->PARAM_hote        ='localhost';
                $this->PARAM_port        ='5432';
                $this->PARAM_nom_bd      ='datamart_dev';
                $this->PARAM_utilisateur ='postgres';
                $this->PARAM_mot_passe   ='P057G435';
                break;

            case 3: // Test
                $this->PARAM_hote        ='localhost';
                $this->PARAM_port        ='5432';
                $this->PARAM_nom_bd      ='datamart_test';
                $this->PARAM_utilisateur ='postgres';
                $this->PARAM_mot_passe   ='P057G435';
                break;

            case 4: // Nettoyage
                $this->PARAM_hote        ='localhost';
                $this->PARAM_port        ='5432';
                $this->PARAM_nom_bd      ='datamart_test';
                $this->PARAM_utilisateur ='postgres';
                $this->PARAM_mot_passe   ='P057G435';
                break;
        }

        try {
            $db = new PDO(
                'pgsql:host='	.$this->PARAM_hote
                .';port='		.$this->PARAM_port
                .';dbname='		.$this->PARAM_nom_bd
                .';user='		.$this->PARAM_utilisateur
                .';password='	.$this->PARAM_mot_passe
            );
            // Configuration pour générer des exceptions en cas d'erreur
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête de vérification
            $result = $db->query('SELECT 1');

            echo "Connexion à la base de données établie avec succès !";
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->db = $db;
            
            
        } catch (PDOException $e) {
            // En cas d'erreur, affichage du message d'erreur
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }

        

        
    }



}

?>
