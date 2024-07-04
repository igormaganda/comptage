<?php
class Search {
    private $bool;
    private $name;
    private $import;
    private $programme;
    private $partenaire;
    private $b2;
    private $genre;
    private $proprio;
    private $enfants;
    private $csp;
    private $exclureAge;
    private $age_min;
    private $age_max;
    private $date;
    private $requies;
    private $occurrence;
    private $pays;
    private $geoloc;
    private $affinite;
    private $autre_pays;
    private $cp;
    private $input_cp;
    private $top_domaines;
    private $domaine_exclu;
    private $autre_domaines_exclu;
    private $domaine_inclu;
    private $autre_domaines_inclu;

    private $date_regle_ins;
    private $date1_ins;
    private $date2_ins;
    private $date_regle_ouv;
    private $date1_ouv;
    private $date2_ouv;
    private $date_regle_env;
    private $date1_env;
    private $date2_env;
    private $date_regle_cli;
    private $date1_cli;
    private $date2_cli;

    private $inscris_bool;
    private $inscris_int;
    private $inscris_date;
    private $ouvreurs_bool;
    private $ouvreurs_int;
    private $ouvreurs_date;
    private $receveurs_bool;
    private $receveurs_int;
    private $receveurs_date;
    private $cliqueurs_bool;
    private $cliqueurs_int;
    private $cliqueurs_date;

    private $ligne;
    private $cp_inclure;
    private $location;
    private $input_pays;
    private $input_ville;
    private $ville_inclure;
    private $villes;
    private $pays_inclure;
    private $top_pays;
    
    private $inclure_sexe;
    private $inclure_csp;
    private $inclure_age;
    private $age;
    private $habitats;
    private $operateur_logique;
    private $inclure_habitats;
    private $inclure_famille;
    private $famille;
    private $operateur_logique_famille;
    
    private $centre_interet;
    private $operateur_logique_famille_centre_interet;
    private $operateur_logique_centre_interet;
    private $inclure_famille_centre_interet;
    private $inclure_centre_interet;
    
    private $professions;
    
    private $operation_logique_professions;
    private $inclure_professions;
    
    private $impositions;
    
    private $operations_impositions;
    
    private $inclure_impositions;

    private $champs_copier_coller;
    private $champs_copier_coller_dep;
    private $inputfile;
    private $selectcp;
    private $autre_cp;
    private $champs_copier_coller_cp;
    private $autres_villes;
    private $champs_copier_coller_ville;
    private $autres_dep;
    private $input_dep;
    private $inclure_dep;
    private $region;
    private $autres_regions;
    private $champs_copier_coller_region;
    private $input_region;
    private $inclure_region;
    
    
    
    
    

    public function __construct($POST, $bool) {
        $this->bool                 = $bool;
        $this->name                 = isset($POST["name"]) ? $POST["name"] : "";
        $this->partenaire           = isset($POST["partenaire"]) ? $POST["partenaire"] : "";
        $this->programme            = isset($POST["programme"]) ? $POST["programme"] : "";
        $this->import               = isset($POST["import"]) ? $POST["import"] : "";
        $this->b2                   = isset($POST["b2b-b2c"]) ? $POST["b2b-b2c"] : "";
        $this->genre                = isset($POST["genre"]) ? $POST["genre"] : "";
        $this->proprio              = isset($POST["proprio"]) ? $POST["proprio"] : "";
        $this->enfants              = isset($POST["enfants"]) ? $POST["enfants"] : "";
        $this->csp                  = isset($POST["csp"]) ? $POST["csp"] : "";
        $this->exclureAge           = isset($POST["exclureAge"]) ? $POST["exclureAge"] : "";
        $this->age_min              = isset($POST["age_min"]) ? $POST["age_min"] : "";
        $this->age_max              = isset($POST["age_max"]) ? $POST["age_max"] : "";
        $this->date_ins             = isset($POST["date_ins"]) ? $POST["date_ins"] : "";
        $this->date_env             = isset($POST["date_env"]) ? $POST["date_env"] : "";
        $this->date_ouv             = isset($POST["date_ouv"]) ? $POST["date_ouv"] : "";
        $this->date_cli             = isset($POST["date_cli"]) ? $POST["date_cli"] : "";
        $this->date                 = isset($POST["date"]) ? $POST["date"] : "";
        $this->requies              = isset($POST["requies"]) ? $POST["requies"] : "";
        $this->occurrence           = isset($POST["occurrence"]) ? $POST["occurrence"] : "";
        $this->pays                 = isset($POST["pays"]) ? $POST["pays"] : "";
        $this->geoloc               = isset($POST["geoloc"]) ? $POST["geoloc"] : "";
        $this->affinite             = isset($POST["affinite"]) ? $POST["affinite"] : "";


        $this->autre_pays           = isset($POST["autre_pays"]) ? $POST["autre_pays"] : "";
        $this->autre_cp           = isset($POST["autre_cp"]) ? $POST["autre_cp"] : "";
        $this->champs_copier_coller           = isset($POST["textarea_numreg"]) ? $POST["textarea_numreg"] : "";


        $this->cp                   = isset($POST["cp"]) ? $POST["cp"] : "";
        $this->autres_dep                   = isset($POST["autres_dep"]) ? $POST["autres_dep"] : "";
        $this->input_cp             = isset($POST["input_cp"]) ? $POST["input_cp"] : "";
        $this->top_domaines         = isset($POST["topDomaine"]) ? $POST["topDomaine"] : "";
        $this->domaine_exclu        = isset($POST["domaine_exclu"]) ? $POST["domaine_exclu"] : "";
        $this->autre_domaines_exclu = isset($POST["autre_domaines_exclu"]) ? $POST["autre_domaines_exclu"] : "";
        $this->domaine_inclu        = isset($POST["domaine_inclu"]) ? $POST["domaine_inclu"] : "";
        $this->autre_domaines_inclu = isset($POST["autre_domaines_inclu"]) ? $POST["autre_domaines_inclu"] : "";

        $this->date_regle_ins       = isset($POST["date_regle_ins"]) ? $POST["date_regle_ins"] : "";
        $this->date1_ins            = isset($POST["date1_ins"]) ? $POST["date1_ins"] : "";
        $this->date2_ins            = isset($POST["date2_ins"]) ? $POST["date2_ins"] : "";
        $this->date_regle_ouv       = isset($POST["date_regle_ouv"]) ? $POST["date_regle_ouv"] : "";
        $this->date1_ouv            = isset($POST["date1_ouv"]) ? $POST["date1_ouv"] : "";
        $this->date2_ouv            = isset($POST["date2_ouv"]) ? $POST["date2_ouv"] : "";
        $this->date_regle_env       = isset($POST["date_regle_env"]) ? $POST["date_regle_env"] : "";
        $this->date1_env            = isset($POST["date1_env"]) ? $POST["date1_env"] : "";
        $this->date2_env            = isset($POST["date2_env"]) ? $POST["date2_env"] : "";
        $this->date_regle_cli       = isset($POST["date_regle_cli"]) ? $POST["date_regle_cli"] : "";
        $this->date1_cli            = isset($POST["date1_cli"]) ? $POST["date1_cli"] : "";
        $this->date2_cli            = isset($POST["date2_cli"]) ? $POST["date2_cli"] : "";

        $this->inscris_bool         = isset($POST["inscris_bool"]) ? $POST["inscris_bool"] : "";
        $this->inscris_int          = isset($POST["inscris_int"]) ? $POST["inscris_int"] : "";
        $this->inscris_date         = isset($POST["inscris_date"]) ? $POST["inscris_date"] : "";
        $this->ouvreurs_bool        = isset($POST["ouvreurs_bool"]) ? $POST["ouvreurs_bool"] : "";
        $this->ouvreurs_int         = isset($POST["ouvreurs_int"]) ? $POST["ouvreurs_int"] : "";
        $this->ouvreurs_date        = isset($POST["ouvreurs_date"]) ? $POST["ouvreurs_date"] : "";
        $this->receveurs_bool       = isset($POST["receveurs_bool"]) ? $POST["receveurs_bool"] : "";
        $this->receveurs_int        = isset($POST["receveurs_int"]) ? $POST["receveurs_int"] : "";
        $this->receveurs_date       = isset($POST["receveurs_date"]) ? $POST["receveurs_date"] : "";
        $this->cliqueurs_bool       = isset($POST["cliqueurs_bool"]) ? $POST["cliqueurs_bool"] : "";
        $this->cliqueurs_int        = isset($POST["cliqueurs_int"]) ? $POST["cliqueurs_int"] : "";
        $this->cliqueurs_date       = isset($POST["cliqueurs_date"]) ? $POST["cliqueurs_date"] : "";

        $this->ligne                = isset($POST["lignes"]) ? $POST["lignes"] : "";
        $this->inputfile             = isset($POST["inputfile"]) ? $POST["inputfile"] : "";
        $this->cp_inclure           = isset($POST["cp_inclure"]) ? $POST["cp_inclure"] : "";
        $this->location             = isset($POST["location"]) ? $POST["location"] : "";
        $this->input_pays           = isset($POST["input_pays"]) ? $POST["input_pays"] : "";
        $this->input_ville          = isset($POST["input_ville"]) ? $POST["input_ville"] : "";
        $this->ville_inclure        = isset($POST["ville_inclure"]) ? $POST["ville_inclure"] : "";
        $this->villes               = isset($POST["villes"]) ? $POST["villes"] : "";
        $this->pays_inclure         = isset($POST["pays_inclure"]) ? $POST["pays_inclure"] : "";

        // Nouvelle variable du nouveau design
        $this->top_pays         = isset($POST["top_pays"]) ? $POST["top_pays"] : "";
        $this->inclure_sexe         = isset($POST["datasexe"]) ? $POST["datasexe"] : "";
        $this->inclure_csp         = isset($POST["dataiesocioprofessionelle"]) ? $POST["dataiesocioprofessionelle"] : "";
        $this->inclure_age         = isset($POST["datatrancheage"]) ? $POST["datatrancheage"] : "";
        $this->age         = isset($POST["age"]) ? $POST["age"] : "";
        $this->habitats         = isset($POST["habitats"]) ? $POST["habitats"] : "";
        $this->famille         = isset($POST["familles"]) ? $POST["familles"] : "";
        $this->operateur_logique_famille         = isset($POST["dataopfamille"]) ? $POST["dataopfamille"] : "";
        $this->operateur_logique         = isset($POST["dataophabitat"]) ? $POST["dataophabitat"] : "";
        $this->inclure_famille         = isset($POST["dataincfamillie"]) ? $POST["dataincfamillie"] : "";
        $this->inclure_habitats         = isset($POST["datainchabitat"]) ? $POST["datainchabitat"] : "";


        $this->centre_interet         = isset($POST["ci"]) ? $POST["ci"] : "";
       
        $this->operateur_logique_famille_centre_interet         = isset($POST["dataopcentrefamille"]) ? $POST["dataopcentrefamille"] : "";
        $this->operateur_logique_centre_interet        = isset($POST["datacentreinteret"]) ? $POST["datacentreinteret"] : "";

        $this->inclure_famille_centre_interet      = isset($POST["dataiecentrefamille"]) ? $POST["dataiecentrefamille"] : "";
        $this->inclure_centre_interet        = isset($POST["dataiecentreinteret"]) ? $POST["dataiecentreinteret"] : "";

        $this->professions      = isset($POST["professions"]) ? $POST["professions"] : "";
        $this->operation_logique_professions        = isset($POST["dataopprofession"]) ? $POST["dataopprofession"] : "";
        $this->inclure_professions        = isset($POST["dataieprofession"]) ? $POST["dataieprofession"] : "";

        $this->impositions        = isset($POST["impositions"]) ? $POST["impositions"] : "";
        $this->operations_impositions        = isset($POST["dataopimposition"]) ? $POST["dataopimposition"] : "";
        $this->inclure_impositions        = isset($POST["dataieimposition"]) ? $POST["dataieimposition"] : "";


        $this->champs_copier_coller_dep           = isset($POST["textarea_dep"]) ? $POST["textarea_dep"] : "";
        $this->selectcp           = isset($POST["selectcp"]) ? $POST["selectcp"] : "";
        $this->champs_copier_coller_cp           = isset($POST["textarea_cp"]) ? $POST["textarea_cp"] : "";
        $this->autres_villes           = isset($POST["autres_villes"]) ? $POST["autres_villes"] : "";
        $this->champs_copier_coller_ville           = isset($POST["textarea_ville"]) ? $POST["textarea_ville"] : "";

        $this->input_dep         = isset($POST["input_dep"]) ? $POST["input_dep"] : "";
        $this->inclure_dep         = isset($POST["inclure_dep"]) ? $POST["inclure_dep"] : "";

        $this->region        = isset($POST["regions"]) ? $POST["regions"] : "";
        $this->autres_regions        = isset($POST["autres_regions"]) ? $POST["autres_regions"] : "";
        $this->champs_copier_coller_region        = isset($POST["textarea_region"]) ? $POST["textarea_region"] : "";
        $this->input_region         = isset($POST["input_region"]) ? $POST["input_region"] : "";
        
        $this->inclure_region         = isset($POST["region_inclure"]) ? $POST["region_inclure"] : "";
        
        


        $this->generateRequest();
    }

    private function generateRequest() {

        $bdd = new Bdd();
        
        $affinitaire = "";
        $partenaire = "";

        if (!empty($this->location)) {
            $cles = implode(",", $this->location);
            
            $requete = "SELECT $cles FROM b2c WHERE blacklist IS NOT TRUE AND (statut IS NULL OR statut='SB')";
        }else{
            $requete = "SELECT email FROM b2c WHERE blacklist IS NOT TRUE AND (statut IS NULL OR statut='SB')";
        }

       // echo "Top ".$this->top_pays;
        /////////////////////////////////////////
        ////////////////// SEXE /////////////////
        /////////////////////////////////////////
        if (!empty($this->genre)) {
          
            switch ($this->genre) {
                case 'homme':
                    if($this->inclure_sexe == "on") {
                        $requete .= " AND ( gender='mr')";
                    } else if ($this->inclure_sexe == "off") {
                        $requete .= " AND NOT ( gender='mr')";
                    }
                    break;

                case 'femme':
                    if($this->inclure_sexe == "on") {
                        $requete .= " AND (gender='Mme' OR gender='Mlle')";
                    } else if($this->inclure_sexe == "off") {
                        $requete .= " AND NOT (gender='Mme' OR gender='Mlle')";
                    }
                    break;
            }
        }

        /////////////////////////////////////////
        ///////////////// CSP ////////////////
        /////////////////////////////////////////

       /* if (!empty($this->csp)) {
            $requete .= " AND (csp='".implode("' OR csp='", $this->csp)."')";
        }*/

        if (!empty($this->csp)) {

            switch ($this->csp) {
                case '1':
                    if($this->inclure_csp == "on") {
                        $requete .= " AND ( csp <= '3000' )";
                    } else {
                        $requete .= " AND NOT ( csp <= '3000' )";
                    }
                    break;
                case '2':
                    if($this->inclure_csp == "on") {
                        $requete .= " AND ( csp BETWEEN '5000' AND '7000' )";
                    } else {
                        $requete .= " AND NOT ( csp BETWEEN '5000' AND '7000' )";
                    }
                    break;
                case '3':
                    if($this->inclure_csp == "on") {
                        $requete .= " AND ( csp >= '3000' )";
                    } else {
                        $requete .= " AND NOT ( csp >= '3000' )";
                    }
                    break;
                
                case '4':
                    if($this->inclure_csp == "on") {
                        $requete .= " AND ( csp >= '7000' )";
                    } else {
                        $requete .= " AND NOT ( csp >= '7000' )";
                    }
                    break;

            }

        }



        /////////////////////////////////////////
        ////////////////// AGE //////////////////
        /////////////////////////////////////////

       // echo "Age ".$this->age;

        if (!empty($this->age)) {

            switch ($this->age) {
                case '18':
                    if($this->inclure_age == "on") {
                        $requete .= " AND ( age BETWEEN '18' AND '25' )";
                    } else {
                        $requete .= " AND NOT ( age BETWEEN '18' AND '25' )";
                    }
                    break;
                case '26':
                    if($this->inclure_age == "on") {
                        $requete .= " AND ( age BETWEEN '26' AND '35' )";
                    } else {
                        $requete .= " AND NOT ( age BETWEEN '26' AND '35' )";
                    }
                    break;
                case '36':
                    if($this->inclure_age == "on") {
                        $requete .= " AND ( age BETWEEN '36' AND '50' )";
                    } else {
                        $requete .= " AND NOT ( age BETWEEN '36' AND '50' )";
                    }
                    break;

                case '51':
                    if($this->inclure_age == "on") {
                        $requete .= " AND ( age BETWEEN '51' AND '65' )";
                    } else {
                        $requete .= " AND NOT ( age BETWEEN '51' AND '65' )";
                    }
                    break;
                case '66':
                    if($this->inclure_age == "on") {
                        $requete .= " AND ( age >= '66' )";
                    } else {
                        $requete .= " AND NOT ( age >= '66' )";
                    }
                    break;
            }

        }
        
        
        if($this->inclure_age == "on") {

            if (!empty($this->age_min) && !empty($this->age_max)) {

                if ($this->age_min > $this->age_max) {
                    echo "Information incorrecte..." . "\n";
                } else {
                    $requete .= " AND ( age BETWEEN '$this->age_min' AND '$this->age_max')";

                }

            }
        } else {
            if (!empty($this->age_min) && !empty($this->age_max)) {

                if ($this->age_min > $this->age_max) {
                    echo "Information incorrecte..." . "\n";
                } else {
                    $requete .= " AND NOT ( age BETWEEN '$this->age_min' AND '$this->age_max')";

                }

            }
        }

        /////////////////////////////////////////
        ////////////////// HABITAT //////////////
        /////////////////////////////////////////

        if (!empty($this->habitats)) {
            //echo "habitats ".$this->habitats;
            switch ($this->habitats) {
                
                case '1' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( proprietaire = '1' )";
                        } else {
                            $requete .= " AND ( proprietaire = '1' )";
                        }
                        
                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( proprietaire = '1' )";
                        } else {
                            $requete .= " AND NOT ( proprietaire = '1' )";
                        }
                    }
                    break;

                case '2' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( locataire = '1' )";
                        } else {
                            $requete .= " AND ( locatiare = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( locataire = '1' )";
                        } else {
                            $requete .= " AND NOT ( locataire = '1' )";
                        }
                    }
                    break;

                case '3' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( appartement = '1' )";
                        } else {
                            $requete .= " AND ( appartement = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( appartement = '1' )";
                        } else {
                            $requete .= " AND NOT ( appartement = '1' )";
                        }
                    }
                    break;
                    
                case '4' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( maison = '1' )";
                        } else {
                            $requete .= " AND ( maison = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( maison = '1' )";
                        } else {
                            $requete .= " AND NOT ( maison = '1' )";
                        }
                    }
                    break;

                case '5' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( petit_collectif = '1' )";
                        } else {
                            $requete .= " AND ( petit_collectif = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( petit_collectif = '1' )";
                        } else {
                            $requete .= " AND NOT ( petit_collectif = '1' )";
                        }
                    }
                    break;

                case '6' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( moyen_collectif = '1' )";
                        } else {
                            $requete .= " AND ( moyen_collectif = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( moyen_collectif = '1' )";
                        } else {
                            $requete .= " AND NOT ( moyen_collectif = '1' )";
                        }
                    }
                    break;

                case '7' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( grand_collectif = '1' )";
                        } else {
                            $requete .= " AND ( grand_collectif = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( grand_collectif = '1' )";
                        } else {
                            $requete .= " AND NOT ( grand_collectif = '1' )";
                        }
                    }
                    break;

                case '8' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( tres_grand_collectif = '1' )";
                        } else {
                            $requete .= " AND ( tres_grand_collectif = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( tres_grand_collectif = '1' )";
                        } else {
                            $requete .= " AND NOT ( tres_grand_collectif = '1' )";
                        }
                    }
                    break;

                case '9' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( chauffage_au_bois = '1' )";
                        } else {
                            $requete .= " AND ( chauffage_au_bois = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( chauffage_au_bois = '1' )";
                        } else {
                            $requete .= " AND NOT ( chauffage_au_bois = '1' )";
                        }
                    }
                    break;

                case '10' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( chauffage_au_fioul = '1' )";
                        } else {
                            $requete .= " AND ( chauffage_au_fioul = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( chauffage_au_fioul = '1' )";
                        } else {
                            $requete .= " AND NOT ( chauffage_au_fioul = '1' )";
                        }
                    }
                    break;

                case '11' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( chauffage_au_gaz = '1' )";
                        } else {
                            $requete .= " AND ( chauffage_au_gaz = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( chauffage_au_gaz = '1' )";
                        } else {
                            $requete .= " AND NOT ( chauffage_au_gaz = '1' )";
                        }
                    }
                    break;

                case '12' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( chauffage_electrique = '1' )";
                        } else {
                            $requete .= " AND ( chauffage_electrique = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( chauffage_electrique = '1' )";
                        } else {
                            $requete .= " AND NOT ( chauffage_electrique = '1' )";
                        }
                    }
                    break;

                case '13' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( avec_jardin = '1' )";
                        } else {
                            $requete .= " AND ( avec_jardin = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( avec_jardin = '1' )";
                        } else {
                            $requete .= " AND NOT ( avec_jardin = '1' )";
                        }
                    }
                    break;

                case '14' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( projet_de_demenagement = '1' )";
                        } else {
                            $requete .= " AND ( projet_de_demenagement = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( projet_de_demenagement = '1' )";
                        } else {
                            $requete .= " AND NOT ( projet_de_demenagement = '1' )";
                        }
                    }
                    break;
            }
        }




        /////////////////////////////////////////
        //////////////// FAMILLE ///////////////
        /////////////////////////////////////////

        if (!empty($this->famille)) {
            //echo "habitats ".$this->habitats;
            switch ($this->famille) {

                case '1' :
                    if($this->inclure_famille == "on") {
                        if($this->operateur_logique_famille == "on") {
                            $requete .= " OR ( attend_un_enfant = '1' )";
                        } else {
                            $requete .= " AND ( attend_un_enfant = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille == "on") {
                            $requete .= " OR NOT ( attend_un_enfant = '1' )";
                        } else {
                            $requete .= " AND NOT ( attend_un_enfant = '1' )";
                        }
                    }
                    break;

                case '2' :
                    if($this->inclure_famille == "on") {
                        if($this->operateur_logique_famille == "on") {
                            $requete .= " OR ( avec_enfants = '1' )";
                        } else {
                            $requete .= " AND ( avec_enfants = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille == "on") {
                            $requete .= " OR NOT ( avec_enfants = '1' )";
                        } else {
                            $requete .= " AND NOT ( avec_enfants = '1' )";
                        }
                    }
                    break;

                case '3' :
                    if($this->inclure_famille == "on") {
                        if($this->operateur_logique_famille == "on") {
                            $requete .= " OR ( concubine = '1' )";
                        } else {
                            $requete .= " AND ( concubine = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille == "on") {
                            $requete .= " OR NOT ( concubine = '1' )";
                        } else {
                            $requete .= " AND NOT ( concubine = '1' )";
                        }
                    }
                    break;

                case '4' :
                    if($this->inclure_famille == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( celibataire = '1' )";
                        } else {
                            $requete .= " AND ( celibataire = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( celibataire = '1' )";
                        } else {
                            $requete .= " AND NOT ( celibataire = '1' )";
                        }
                    }
                    break;

                case '5' :
                    if($this->inclure_famille == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( divorce = '1' )";
                        } else {
                            $requete .= " AND ( divorce = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( divorce = '1' )";
                        } else {
                            $requete .= " AND NOT ( divorce = '1' )";
                        }
                    }
                    break;

                case '6' :
                    if($this->inclure_famille == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( famille = '1' )";
                        } else {
                            $requete .= " AND ( famille = '1' )";
                        }

                    } else {
                        if($this->inclure_famille == "on") {
                            $requete .= " OR NOT ( famille = '1' )";
                        } else {
                            $requete .= " AND NOT ( famille = '1' )";
                        }
                    }
                    break;

                case '7' :
                    if($this->inclure_famille == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( mariage_prevu_inferieur_12_mois = '1' )";
                        } else {
                            $requete .= " AND ( mariage_prevu_inferieur_12_mois = '1' )";
                        }

                    } else {
                        if($this->operateuinclure_famille == "on") {
                            $requete .= " OR NOT ( mariage_prevu_inferieur_12_mois = '1' )";
                        } else {
                            $requete .= " AND NOT ( mariage_prevu_inferieur_12_mois = '1' )";
                        }
                    }
                    break;

                case '8' :
                    if($this->inclure_famille == "on") {
                        if($this->operateur_logique_famille == "on") {
                            $requete .= " OR ( marie = '1' )";
                        } else {
                            $requete .= " AND ( marie = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille == "on") {
                            $requete .= " OR NOT ( marie = '1' )";
                        } else {
                            $requete .= " AND NOT ( marie = '1' )";
                        }
                    }
                    break;

                case '9' :
                    if($this->inclure_famille == "on") {
                        if($this->operateur_logique_famille == "on") {
                            $requete .= " OR ( sans_enfant = '1' )";
                        } else {
                            $requete .= " AND ( sans_enfant = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille == "on") {
                            $requete .= " OR NOT ( sans_enfant = '1' )";
                        } else {
                            $requete .= " AND NOT ( sans_enfant = '1' )";
                        }
                    }
                    break;

                case '10' :
                    if($this->inclure_famille == "on") {
                        if($this->operateur_logique_famille == "on") {
                            $requete .= " OR ( separe = '1' )";
                        } else {
                            $requete .= " AND ( separe = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille == "on") {
                            $requete .= " OR NOT ( separe = '1' )";
                        } else {
                            $requete .= " AND NOT ( separe = '1' )";
                        }
                    }
                    break;

                case '11' :
                    if($this->inclure_habitats == "on") {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR ( veuf = '1' )";
                        } else {
                            $requete .= " AND ( veuf = '1' )";
                        }

                    } else {
                        if($this->operateur_logique == "on") {
                            $requete .= " OR NOT ( veuf = '1' )";
                        } else {
                            $requete .= " AND NOT ( veuf = '1' )";
                        }
                    }
                    break;
                    
            }
        }

        /////////////////////////////////////////
        //////// Centre d'interet ///////////////
        /////////////////////////////////////////
        
        if (!empty($this->centre_interet)) {
            switch ($this->centre_interet) {
                case '1':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( achat_invest_immob = '1' )";
                        } else {
                            $requete .= " AND ( achat_invest_immob = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( achat_invest_immob = '1' )";
                        } else {
                            $requete .= " AND ( achat_invest_immob = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( achat_invest_immob = '1' )";
                        } else {
                            $requete .= " AND NOT ( achat_invest_immob = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( achat_invest_immob = '1' )";
                        } else {
                            $requete .= " AND NOT ( achat_invest_immob = '1' )";
                        }
                    }
                    break;

                case '2':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( animaux = '1' )";
                        } else {
                            $requete .= " AND ( animaux = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( animaux = '1' )";
                        } else {
                            $requete .= " AND ( animaux = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( animaux = '1' )";
                        } else {
                            $requete .= " AND NOT ( animaux = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( animaux = '1' )";
                        } else {
                            $requete .= " AND NOT ( animaux = '1' )";
                        }
                    }
                    break;

                case '3':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( assurance_prévoyance = '1' )";
                        } else {
                            $requete .= " AND ( assurance_prévoyance = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( assurance_prévoyance = '1' )";
                        } else {
                            $requete .= " AND ( assurance_prévoyance = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( assurance_prévoyance = '1' )";
                        } else {
                            $requete .= " AND NOT ( assurance_prévoyance = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( assurance_prévoyance = '1' )";
                        } else {
                            $requete .= " AND NOT ( assurance_prévoyance = '1' )";
                        }
                    }
                    break;


                case '4':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( automobile = '1' )";
                        } else {
                            $requete .= " AND ( automobile = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( automobile = '1' )";
                        } else {
                            $requete .= " AND ( automobile = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( automobile = '1' )";
                        } else {
                            $requete .= " AND NOT ( automobile = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( automobile = '1' )";
                        } else {
                            $requete .= " AND NOT ( automobile = '1' )";
                        }
                    }
                    break;

                case '5':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( banque = '1' )";
                        } else {
                            $requete .= " AND ( banque = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( banque = '1' )";
                        } else {
                            $requete .= " AND ( banque = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( banque = '1' )";
                        } else {
                            $requete .= " AND NOT ( banque = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( banque = '1' )";
                        } else {
                            $requete .= " AND NOT ( banque = '1' )";
                        }
                    }
                    break;

                case '6':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( beaute_esthetique_bien_etre = '1' )";
                        } else {
                            $requete .= " AND ( beaute_esthetique_bien_etre = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( beaute_esthetique_bien_etre = '1' )";
                        } else {
                            $requete .= " AND ( beaute_esthetique_bien_etre = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( beaute_esthetique_bien_etre = '1' )";
                        } else {
                            $requete .= " AND NOT ( beaute_esthetique_bien_etre = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( beaute_esthetique_bien_etre = '1' )";
                        } else {
                            $requete .= " AND NOT ( beaute_esthetique_bien_etre = '1' )";
                        }
                    }
                    break;

                case '7':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( charme_erotisme = '1' )";
                        } else {
                            $requete .= " AND ( charme_erotisme = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( charme_erotisme = '1' )";
                        } else {
                            $requete .= " AND ( charme_erotisme = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( charme_erotisme = '1' )";
                        } else {
                            $requete .= " AND NOT ( charme_erotisme = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( charme_erotisme = '1' )";
                        } else {
                            $requete .= " AND NOT ( charme_erotisme = '1' )";
                        }
                    }
                    break;

                case '8':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( cuisine_gastronomie = '1' )";
                        } else {
                            $requete .= " AND ( cuisine_gastronomie = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( cuisine_gastronomie = '1' )";
                        } else {
                            $requete .= " AND ( cuisine_gastronomie = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( cuisine_gastronomie = '1' )";
                        } else {
                            $requete .= " AND NOT ( cuisine_gastronomie = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( cuisine_gastronomie = '1' )";
                        } else {
                            $requete .= " AND NOT ( cuisine_gastronomie = '1' )";
                        }
                    }
                    break;

                case '9':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( divers = '1' )";
                        } else {
                            $requete .= " AND ( divers = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( divers = '1' )";
                        } else {
                            $requete .= " AND ( divers = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( divers = '1' )";
                        } else {
                            $requete .= " AND NOT ( divers = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( divers = '1' )";
                        } else {
                            $requete .= " AND NOT ( divers = '1' )";
                        }
                    }
                    break;

                case '10':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( equipement_decoration_habitat = '1' )";
                        } else {
                            $requete .= " AND ( equipement_decoration_habitat = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( equipement_decoration_habitat = '1' )";
                        } else {
                            $requete .= " AND ( equipement_decoration_habitat = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( equipement_decoration_habitat = '1' )";
                        } else {
                            $requete .= " AND NOT ( equipement_decoration_habitat = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( equipement_decoration_habitat = '1' )";
                        } else {
                            $requete .= " AND NOT ( equipement_decoration_habitat = '1' )";
                        }
                    }
                    break;

                case '11':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( films_series_cinema = '1' )";
                        } else {
                            $requete .= " AND ( films_series_cinema = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( films_series_cinema = '1' )";
                        } else {
                            $requete .= " AND ( films_series_cinema = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( films_series_cinema = '1' )";
                        } else {
                            $requete .= " AND NOT ( films_series_cinema = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( films_series_cinema = '1' )";
                        } else {
                            $requete .= " AND NOT ( films_series_cinema = '1' )";
                        }
                    }
                    break;

                case '12':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( loisirs_sorties = '1' )";
                        } else {
                            $requete .= " AND ( loisirs_sorties = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( loisirs_sorties = '1' )";
                        } else {
                            $requete .= " AND ( loisirs_sorties = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( loisirs_sorties = '1' )";
                        } else {
                            $requete .= " AND NOT ( loisirs_sorties = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( loisirs_sorties = '1' )";
                        } else {
                            $requete .= " AND NOT ( loisirs_sorties = '1' )";
                        }
                    }
                    break;

                case '13':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( mode_accessoires = '1' )";
                        } else {
                            $requete .= " AND ( mode_accessoires = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( mode_accessoires = '1' )";
                        } else {
                            $requete .= " AND ( mode_accessoires = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( mode_accessoires = '1' )";
                        } else {
                            $requete .= " AND NOT ( mode_accessoires = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( mode_accessoires = '1' )";
                        } else {
                            $requete .= " AND NOT ( mode_accessoires = '1' )";
                        }
                    }
                    break;

                case '14':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( nature_ecologie = '1' )";
                        } else {
                            $requete .= " AND ( nature_ecologie = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( nature_ecologie = '1' )";
                        } else {
                            $requete .= " AND ( nature_ecologie = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( nature_ecologie = '1' )";
                        } else {
                            $requete .= " AND NOT ( nature_ecologie = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( nature_ecologie = '1' )";
                        } else {
                            $requete .= " AND NOT ( nature_ecologie = '1' )";
                        }
                    }
                    break;

                case '15':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( paris_jeux_argent = '1' )";
                        } else {
                            $requete .= " AND ( paris_jeux_argent = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( paris_jeux_argent = '1' )";
                        } else {
                            $requete .= " AND ( paris_jeux_argent = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( paris_jeux_argent = '1' )";
                        } else {
                            $requete .= " AND NOT ( paris_jeux_argent = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( paris_jeux_argent = '1' )";
                        } else {
                            $requete .= " AND NOT ( paris_jeux_argent = '1' )";
                        }
                    }
                    break;

                case '16':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( sante = '1' )";
                        } else {
                            $requete .= " AND ( sante = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( sante = '1' )";
                        } else {
                            $requete .= " AND ( sante = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( sante = '1' )";
                        } else {
                            $requete .= " AND NOT ( sante = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( sante = '1' )";
                        } else {
                            $requete .= " AND NOT ( sante = '1' )";
                        }
                    }
                    break;

                case '17':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( shopping_achats = '1' )";
                        } else {
                            $requete .= " AND ( shopping_achats = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( shopping_achats = '1' )";
                        } else {
                            $requete .= " AND ( shopping_achats = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( shopping_achats = '1' )";
                        } else {
                            $requete .= " AND NOT ( shopping_achats = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( shopping_achats = '1' )";
                        } else {
                            $requete .= " AND NOT ( shopping_achats = '1' )";
                        }
                    }
                    break;


                case '18':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( sport = '1' )";
                        } else {
                            $requete .= " AND ( sport = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( sport = '1' )";
                        } else {
                            $requete .= " AND ( sport = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( sport = '1' )";
                        } else {
                            $requete .= " AND NOT ( sport = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( sport = '1' )";
                        } else {
                            $requete .= " AND NOT ( sport = '1' )";
                        }
                    }
                    break;

                case '19':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( vacances_voyages = '1' )";
                        } else {
                            $requete .= " AND ( vacances_voyages = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( vacances_voyages = '1' )";
                        } else {
                            $requete .= " AND ( vacances_voyages = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( vacances_voyages = '1' )";
                        } else {
                            $requete .= " AND NOT ( vacances_voyages = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( vacances_voyages = '1' )";
                        } else {
                            $requete .= " AND NOT ( vacances_voyages = '1' )";
                        }
                    }
                    break;


                case '20':
                    if($this->inclure_famille_centre_interet == "on") {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR ( voyance_esoterisme = '1' )";
                        } else {
                            $requete .= " AND ( voyance_esoterisme = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR ( voyance_esoterisme = '1' )";
                        } else {
                            $requete .= " AND ( voyance_esoterisme = '1' )";
                        }

                    } else {
                        if($this->operateur_logique_famille_centre_interet == "on") {
                            $requete .= " OR NOT ( voyance_esoterisme = '1' )";
                        } else {
                            $requete .= " AND NOT ( voyance_esoterisme = '1' )";
                        }
                        if($this->operateur_logique_centre_interet == "on") {
                            $requete .= " OR NOT ( voyance_esoterisme = '1' )";
                        } else {
                            $requete .= " AND NOT ( voyance_esoterisme = '1' )";
                        }
                    }
                    break;
            }
        }



        /////////////////////////////////////////
        ///////////// Professions ///////////////
        /////////////////////////////////////////

        if (!empty($this->professions)) {
            switch ($this->professions) {
                case '1':
                    if($this->inclure_professions == "on") {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR ( profession_dirigeant = '1' )";
                        } else {
                            $requete .= " AND ( profession_dirigeant = '1' )";
                        }
                        
                    } else {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR NOT ( profession_dirigeant = '1' )";
                        } else {
                            $requete .= " AND NOT ( profession_dirigeant = '1' )";
                        }
                        
                    }
                    break;

                case '2':
                    if($this->inclure_professions == "on") {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR ( profession_enseignant = '1' )";
                        } else {
                            $requete .= " AND ( profession_enseignant = '1' )";
                        }

                    } else {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR NOT ( profession_enseignant = '1' )";
                        } else {
                            $requete .= " AND NOT ( profession_enseignant = '1' )";
                        }

                    }
                    break;

                case '3':
                    if($this->inclure_professions == "on") {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR ( profession_fonctionnaire = '1' )";
                        } else {
                            $requete .= " AND ( profession_fonctionnaire = '1' )";
                        }

                    } else {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR NOT ( profession_fonctionnaire = '1' )";
                        } else {
                            $requete .= " AND NOT ( profession_fonctionnaire = '1' )";
                        }

                    }
                    break;


                case '4':
                    if($this->inclure_professions == "on") {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR ( profession_formation = '1' )";
                        } else {
                            $requete .= " AND ( profession_formation = '1' )";
                        }

                    } else {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR NOT ( profession_formation = '1' )";
                        } else {
                            $requete .= " AND NOT ( profession_formation = '1' )";
                        }

                    }
                    break;

                case '5':
                    if($this->inclure_professions == "on") {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR ( profession_retraite = '1' )";
                        } else {
                            $requete .= " AND ( profession_retraite = '1' )";
                        }

                    } else {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR NOT ( profession_retraite = '1' )";
                        } else {
                            $requete .= " AND NOT ( profession_retraite = '1' )";
                        }

                    }
                    break;

                case '6':
                    if($this->inclure_professions == "on") {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR ( profession_salarie = '1' )";
                        } else {
                            $requete .= " AND ( profession_salarie = '1' )";
                        }

                    } else {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR NOT ( profession_salarie = '1' )";
                        } else {
                            $requete .= " AND NOT ( profession_salarie = '1' )";
                        }

                    }
                    break;

                case '7':
                    if($this->inclure_professions == "on") {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR ( profession_sans_emploi = '1' )";
                        } else {
                            $requete .= " AND ( profession_sans_emploi = '1' )";
                        }

                    } else {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR NOT ( profession_sans_emploi = '1' )";
                        } else {
                            $requete .= " AND NOT ( profession_sans_emploi = '1' )";
                        }

                    }
                    break;

                case '8':
                    if($this->inclure_professions == "on") {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR ( profession_marie = '1' )";
                        } else {
                            $requete .= " AND ( profession_marie = '1' )";
                        }

                    } else {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR NOT ( profession_marie = '1' )";
                        } else {
                            $requete .= " AND NOT ( profession_marie = '1' )";
                        }

                    }
                    break;

                case '9':
                    if($this->inclure_professions == "on") {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR ( profession_etudiant = '1' )";
                        } else {
                            $requete .= " AND ( profession_etudiant = '1' )";
                        }

                    } else {
                        if($this->operation_logique_professions == "on") {
                            $requete .= " OR NOT ( profession_etudiant = '1' )";
                        } else {
                            $requete .= " AND NOT ( profession_etudiant = '1' )";
                        }

                    }
                    break;
                    
            }
        }



        /////////////////////////////////////////
        //////////////// Imposition /////////////
        /////////////////////////////////////////

        if (!empty($this->impositions)) {
            switch ($this->impositions) {
                case '1':
                    if($this->inclure_impositions == "on") {
                        if($this->operations_impositions == "on") {
                            $requete .= " OR ( imposition < '6000' )";
                        } else {
                            $requete .= " AND ( imposition < '6000' )";
                        }

                    } else {
                        if($this->operations_impositions == "on") {
                            $requete .= " OR NOT ( imposition < '6000' )";
                        } else {
                            $requete .= " AND NOT ( imposition < '6000' )";
                        }

                    }
                    break;

                case '2':
                    if($this->inclure_impositions == "on") {
                        if($this->operations_impositions == "on") {
                            $requete .= " OR ( imposition > '6000' )";
                        } else {
                            $requete .= " AND ( imposition > '6000' )";
                        }

                    } else {
                        if($this->operations_impositions == "on") {
                            $requete .= " OR NOT ( imposition > '6000' )";
                        } else {
                            $requete .= " AND NOT ( imposition > '6000' )";
                        }

                    }
                    break;

                case '3':
                    if($this->inclure_impositions == "on") {
                        if($this->operations_impositions == "on") {
                            $requete .= " OR ( ifi = '1' )";
                        } else {
                            $requete .= " AND ( ifi ='1' )";
                        }

                    } else {
                        if($this->operations_impositions == "on") {
                            $requete .= " OR NOT ( ifi = '1' )";
                        } else {
                            $requete .= " AND NOT ( ifi = '1' )";
                        }

                    }
                    break;


                case '4':
                    if($this->inclure_impositions == "on") {
                        if($this->operations_impositions == "on") {
                            $requete .= " OR ( non_imposable = '1' )";
                        } else {
                            $requete .= " AND ( non_imposable = '1' )";
                        }

                    } else {
                        if($this->operations_impositions == "on") {
                            $requete .= " OR NOT ( non_imposable = '1' )";
                        } else {
                            $requete .= " AND NOT ( non_imposable = '1' )";
                        }

                    }
                    break;

            }
        }


        /////////////////////////////////////////
        ///////////// CHAMPS REQUIES ////////////
        /////////////////////////////////////////
        /*if (!empty($this->requies)) {
            $requete .= " AND ".implode(" IS NOT NULL AND ", $this->requies)." ";
        }
*/


        /////////////////////////////////////////
        ///////////////// DATES /////////////////
        /////////////////////////////////////////
        if (!empty($this->inscris_bool)) {
            $requete .= " AND date_in IS NOT NULL";

            if (!empty($this->inscris_int) && !empty($this->inscris_date)) {
                $requete .= " AND (date_in > (NOW()::date - '$this->inscris_int $this->inscris_date'::interval))";
            }
        }

        if (!empty($this->ouvreurs_bool)) {
            $requete .= " AND last_date_o IS NOT NULL";

            if (!empty($this->ouvreurs_int) && !empty($this->ouvreurs_date)) {
                $requete .= " AND (last_date_o > (NOW()::date - '$this->ouvreurs_int $this->ouvreurs_date'::interval))";
            }
        }

        if (!empty($this->receveurs_bool)) {
            $requete .= " AND last_date_r IS NOT NULL";

            if (!empty($this->receveurs_int) && !empty($this->receveurs_date)) {
                $requete .= " AND (last_date_r > (NOW()::date - '$this->receveurs_int $this->receveurs_date'::interval))";
            }
        }

        if (!empty($this->cliqueurs_bool)) {
            $requete .= " AND last_date_c IS NOT NULL";

            if (!empty($this->cliqueurs_int) && !empty($this->cliqueurs_date)) {
                $requete .= " AND (last_date_c > (NOW()::date - '$this->cliqueurs_int $this->cliqueurs_date'::interval))";
            }
        }

        
        if(!empty($this->date_regle_ins)) {
            
            switch ($this->date_regle_ins) {
                case 'date-def-ins':
                    $requete .= " AND date_in IS NOT NULL";
                    break;
                    
                case 'date-vid-ins':
                    $requete .= " AND date_in IS NULL";
                    break;
                    
                case 'date-ega-ins':
                    if(!empty($this->date1_ins)) {
                        $requete .= " AND date_in::date = '$this->date1_ins'";
                    }
                    break;
                    
                case 'date-dif-ins':
                    if(!empty($this->date1_ins)) {
                        $requete .= " AND date_in::date != '$this->date1_ins'";
                    }
                    break;
                    
                case 'date-inf-ins':
                    if(!empty($this->date1_ins)) {
                        $requete .= " AND date_in::date < '$this->date1_ins'";
                    }
                    break;
                    
                case 'date-sup-ins':
                    if(!empty($this->date1_ins)) {
                        $requete .= " AND date_in::date > '$this->date1_ins'";
                    }
                    break;
                    
                case 'date-ent-ins':
                    if(!empty($this->date1_ins) && !empty($this->date2_ins)) {
                        $requete .= " AND (date_in::date BETWEEN '$this->date1_ins' AND '$this->date2_ins')";
                    }
                    break;
            }
        }

        if(!empty($this->date_regle_ouv)) {

            switch ($this->date_regle_ins) {
                case 'date-def-ins':
                    $requete .= " AND date_in IS NOT NULL";
                    break;

                case 'date-vid-ins':
                    $requete .= " AND date_in IS NULL";
                    break;

                case 'date-ega-ins':
                    if(!empty($this->date1_ins)) {
                        $requete .= " AND date_in::date = '$this->date1_ins'";
                    }
                    break;

                case 'date-dif-ins':
                    if(!empty($this->date1_ins)) {
                        $requete .= " AND date_in::date != '$this->date1_ins'";
                    }
                    break;

                case 'date-inf-ins':
                    if(!empty($this->date1_ins)) {
                        $requete .= " AND date_in::date < '$this->date1_ins'";
                    }
                    break;

                case 'date-sup-ins':
                    if(!empty($this->date1_ins)) {
                        $requete .= " AND date_in::date > '$this->date1_ins'";
                    }
                    break;

                case 'date-ent-ins':
                    if(!empty($this->date1_ins) && !empty($this->date2_ins)) {
                        $requete .= " AND (date_in::date BETWEEN '$this->date1_ins' AND '$this->date2_ins')";
                    }
                    break;
            }
        }



        
        /////////////////////////////////////////
        ///////////////// PAYS //////////////////
        /////////////////////////////////////////
        $country = array();

        if(!empty($this->pays)) {
            foreach ($this->pays as $value) {
                $country[] = $value;
            }
        }

        if(!empty($this->top_pays)) {
            foreach ($this->top_pays as $value) {
                $country[] = $value;
            }
        }
        
      //  echo "Top pays " .$country[0] ."".$country[1] ." ".$country[1] . "\n";

        if(!empty($this->autre_pays)) {
            $autre_pays = explode(",", $this->autre_pays);

            foreach ($autre_pays as $currentCp) {
                $country[] = $currentCp;
            }
        }
        
        if(!empty($this->input_pays)) {
            $autre_pays = explode(",", $this->input_pays);

            foreach ($autre_pays as $value) {
                $country[] = $value;
            }
        }
        
       // echo " Input pays : " .implode(",", $country);
        
        
        if(!empty($this->champs_copier_coller)) {
            $autre_pays = explode(",", $this->champs_copier_coller);

            foreach ($autre_pays as $value) {
                $country[] = $value;
            }
        }

        if(!empty($country)) {
            $requete .= " AND (";

            $currenturn = 0;
            
            if($this->pays_inclure && $this->pays_inclure == "true"){

                foreach ($country as $value) {
                    if($currenturn == 0) {
                        $requete .= "(pays ='".$value."'";
                        $currenturn++;
                    } else {
                        $requete .= " OR pays ='".$value."'";
                    }
                }

                $requete .= ")";
                
            }else{
                
                foreach ($country as $value) {
                    if($currenturn == 0) {
                        $requete .= "(pays !='".$value."'";
                        $currenturn++;
                    } else {
                        $requete .= " OR pays !='".$value."'";
                    }
                }

                $requete .= ")";
            }
        }

        if(!empty($country)) {
            $requete .= " OR ";

            $currenturn = 0;
            if($this->pays_inclure && $this->pays_inclure == "true"){
                foreach ($country as $value) {
                    if($currenturn == 0) {
                        $requete .= "(groupe_domaine='".substr($value, 0, 2)."'";
                        $currenturn++;
                    } else {
                        $requete .= " OR groupe_domaine='".substr($value, 0, 2)."'";
                    }
                }

                $requete .= "))";
                
            }else{
                foreach ($country as $value) {
                    if($currenturn == 0) {
                        $requete .= "(groupe_domaine !='".substr($value, 0, 2)."'";
                        $currenturn++;
                    } else {
                        $requete .= " OR groupe_domaine !='".substr($value, 0, 2)."'";
                    }
                }

                $requete .= "))";
            }
        }


        /////////////////////////////////////////
        ////////////// REGION ///////////////////
        /////////////////////////////////////////
        $region = array();

        if(!empty($this->region)) {
            foreach ($this->region as $value) {
                $region[] = $value;
            }
        }
        
        // Donnees ajouter autre region
        if(!empty($this->autres_regions)) {
            $autres_region = explode(",", $this->autres_regions);

            foreach ($autres_region as $currentRegion) {
                $region[] = $currentRegion;
            }
        }

        // Donne copier coller champs region
        if(!empty($this->champs_copier_coller_region)) {
            $champs_copie_region = explode(",", $this->champs_copier_coller_region);

            foreach ($champs_copie_region as $value) {
                $region[] = $value;
            }
        }

        //Donnees champs input file region
        if(!empty($this->input_region)) {

            $input_file_region = explode(",", $this->input_region);
            foreach ($input_file_region as $value) {
                $region[] = $value;
            }
        }

        if(!empty($region)) {

            $requete .= " AND ";

            $currenturn = 0;
            if($this->inclure_region && $this->inclure_region == "true"){
                foreach ($region as $value) {
                    if($currenturn == 0) {
                        $requete .= "(region LIKE '".$value."%'";
                        $currenturn++;
                    } else {
                        $requete .= " OR region LIKE '".$value."%'";
                    }
                }

                $requete .= ")";

            }else{

                foreach ($region as $value) {
                    if($currenturn == 0) {
                        $requete .= "(region NOT LIKE '".$value."%'";
                        $currenturn++;
                    } else {
                        $requete .= " OR region NOT LIKE '".$value."%'";
                    }
                }

                $requete .= ")";
            }
        }
        

        //echo "Region :" .$region[0]. " " .$region[1]."\n";
        
        
        /////////////////////////////////////////
        ////////////// DÉPARTEMENT //////////////
        /////////////////////////////////////////
        $dep = array();

        if(!empty($this->geoloc)) {
            foreach ($this->geoloc as $value) {
                $dep[] = $value;
            }
        }

        if(!empty($this->autres_dep)) {
            $autres_dep = explode(",", $this->autres_dep);

            foreach ($autres_dep as $currentDep) {
                $dep[] = $currentDep;
            }
        }

        // Donne copier coller champs dep
        if(!empty($this->champs_copier_coller_dep)) {
            $champs_copie_dep = explode(",", $this->champs_copier_coller_dep);

            foreach ($champs_copie_dep as $value) {
                $dep[] = $value;
            }
        }
        
        //Donnee champs input file dep
        if(!empty($this->input_dep)) {
            
            $input_file_dep = explode(",", $this->input_dep);
            foreach ($input_file_dep as $value) {
                $dep[] = $value;
            }
        }

        if(!empty($dep)) {

            $requete .= " AND ";

            $currenturn = 0;
            if($this->inclure_dep && $this->inclure_dep == "true"){
                foreach ($dep as $value) {
                    if($currenturn == 0) {
                        $requete .= "(dep LIKE '".$value."%'";
                        $currenturn++;
                    } else {
                        $requete .= " OR dep LIKE '".$value."%'";
                    }
                }

                $requete .= ")";

            }else{

                foreach ($dep as $value) {
                    if($currenturn == 0) {
                        $requete .= "(dep NOT LIKE '".$value."%'";
                        $currenturn++;
                    } else {
                        $requete .= " OR dep NOT LIKE '".$value."%'";
                    }
                }

                $requete .= ")";
            }
        }
        

        //echo " Dep : " .$dep[0]. " " .$dep[1]."\n";

        
        

        /////////////////////////////////////////
        ///////////////   VILLES   //////////////
        /////////////////////////////////////////
        $villesTab = array();

        
        //input des villes
        if(!empty($this->villes)){
           
            $ville = explode("," , $this->villes);
           
            foreach ($ville as $ville_) {
                $villesTab[] = $ville_;
            }
        }
        
        // Donnee un ou plusiers villes
        if(!empty($this->villes)) {
            foreach ($this->villes as $value) {
                $villesTab[] = $value;
            }
        }
        
        //Donnee champs copier coller
        if(!empty($this->champs_copier_coller_ville)) {
            $autre_villes = explode(",", $this->champs_copier_coller_ville);

            foreach ($autre_villes as $value) {
                $villesTab[] = $value;
            }
        }


        // Données autres villes 
        
        if(!empty($this->autres_villes)) {
            $autres_villes = explode(",", $this->autres_villes);

            foreach ($autres_villes as $currentVille) {
                $villesTab[] = $currentVille;
            }
        }
        
        //Données villes du fichier
        if(!empty($this->input_ville)){
            $ville = explode("," , $this->input_ville);
            foreach ($ville as $ville_) {
                $villesTab[] = $ville_;
            };
        }

        if(!empty($villesTab)){

            $requete .= " AND ";

            $currenturn_ = 0;
            if($this->ville_inclure && $this->ville_inclure == "true"){

                foreach ($villesTab as $value) {
                    if($currenturn_ == 0) {
                        $requete .= "(ville LIKE '".$value."%'";
                        $currenturn_++;
                    } else {
                        $requete .= " OR ville LIKE '".$value."%'";
                    }
                }

                $requete .= ")";
            }else{
                foreach ($villesTab as $value) {
                    if($currenturn_ == 0) {
                        $requete .= "(ville NOT LIKE '".$value."%'";
                        $currenturn_++;
                    } else {
                        $requete .= " OR ville NOT LIKE '".$value."%'";
                    }
                }

                $requete .= ")";
            }
        }
        
        

        /////////////////////////////////////////
        /////////////// CODE POSTAL //////////////
        /////////////////////////////////////////
        $postalCode = array();

        if(!empty($this->selectcp)) {
            //echo "cp ".$this->selectcp;
            foreach ($this->selectcp as $value) {
                $postalCode[] = $value;
            }
        }
        
        if(!empty($this->autre_cp)) {
            $autre_cp = explode(",", $this->autre_cp);

            foreach ($autre_cp as $currentCp) {
                $postalCode[] = $currentCp;
            }
        }

        if(!empty($this->champs_copier_coller_cp)) {
            $autre_cp = explode(",", $this->champs_copier_coller_cp);

            foreach ($autre_cp as $value) {
                $postalCode[] = $value;
            }
        }

        if(!empty($this->ligne)) {
            //echo "line " .$this->ligne;
            $autre_cp = explode(",", $this->ligne);

            foreach ($autre_cp as $value) {
                $postalCode[] = $value;
            }
        }

        /*if(!empty($postalCode)) {

            $requete .= " AND ";

            $currenturn = 0;
            if($this->cp_inclure && $this->cp_inclure == "true"){
                foreach ($postalCode as $value) {
                    if($currenturn == 0) {
                        $requete .= "(cp LIKE '".$value."%'";
                        $currenturn++;
                    } else {
                        $requete .= " OR cp LIKE '".$value."%'";
                    }
                }

                $requete .= ")";
            }else{
                foreach ($postalCode as $value) {
                    if($currenturn == 0) {
                        $requete .= "(cp NOT LIKE '".$value."%'";
                        $currenturn++;
                    } else {
                        $requete .= " OR cp NOT LIKE '".$value."%'";
                    }
                }

                $requete .= ")";
            }
        }*/

        if(!empty($postalCode)) {

            $requete .= " AND ";

            $currenturn = 0;
            if($this->cp_inclure && $this->cp_inclure == "true"){
                foreach ($postalCode as $value) {
                    if($currenturn == 0) {
                        $requete .= "(cp IN '".$value."%'";
                        $currenturn++;
                    } else {
                        $requete .= " OR cp LIKE '".$value."%'";
                    }
                }

                $requete .= ")";
            }else{
                foreach ($postalCode as $value) {
                    if($currenturn == 0) {
                        $requete .= "(cp NOT LIKE '".$value."%'";
                        $currenturn++;
                    } else {
                        $requete .= " OR cp NOT LIKE '".$value."%'";
                    }
                }

                $requete .= ")";
            }
        }
        //echo " CP : " .$postalCode[0]. " " .$postalCode[1]."\n";
        
        
        /////////////////////////////////////////
        //////////////// DOMAINES ///////////////
        /////////////////////////////////////////
       
       
        $domaines_inclu = $domaines_exclu = array();

        if(!empty($this->domaine_exclu)) {
            foreach ($this->domaine_exclu as $select_domaine) {
                $domaines_exclu[] = $select_domaine;
            }
        }

        if(!empty($this->autre_domaines_exclu)) {
            $autre_dom = explode(",", $this->autre_domaines_exclu);

            foreach ($autre_dom as $new_domaine) {
                $domaines_exclu[] = $new_domaine;
            }
        }

        if(!empty($this->domaine_inclu)) {
            foreach ($this->domaine_inclu as $select_domaine) {
                $domaines_inclu[] = $select_domaine;
            }
        }

        if(!empty($this->autre_domaines_inclu)) {
            $autre_dom = explode(",", $this->autre_domaines_inclu);

            foreach ($autre_dom as $new_domaine) {
                $domaines_inclu[] = $new_domaine;
            }
        }

        if(!empty($this->top_domaines)) {
            $reqTopDom = "SELECT Top_domain FROM info LIMIT 1";
            $result = $bdd->executeQueryRequete($reqTopDom, 1);
            while( $top_dom = $result->fetch() ) { $topDomList = trim($top_dom->top_domain); }

            $domList = explode(";", $topDomList);

            if(count($domList) > 0) {
                foreach ($domList as $value) {
                    $dom = explode(",", $value);
                    $domaines_inclu[] = trim($dom[0]);
                }
            }
        }

        
        


        $domaines_inclu = array_unique($domaines_inclu);
        $domaines_exclu = array_unique($domaines_exclu);

        if (!empty($domaines_inclu)) {
            $requete .= " AND ";

            $currenturn = 0;

            foreach ($domaines_inclu as $current_domaine) {

                $domain = explode(".", $current_domaine);
                if(count($domain)>1) {
                    $ext = array_pop($domain);
                    $domain = implode(".", $domain);
                } else {
                    $ext = "";
                    $domain = $domain[0];
                }

                if(empty($ext)) {
                    if($currenturn == 0) {
                        $requete .= "(domain='".$domain."'";
                        $currenturn++;
                    } else {
                        $requete .= " OR domain='".$domain."'";
                    }
                } else {
                    if($currenturn == 0) {
                        $requete .= "((domain='".$domain."' AND groupe_domaine='".$ext."')";
                        $currenturn++;
                    } else {
                        $requete .= " OR (domain='".$domain."' AND groupe_domaine='".$ext."')";
                    }
                }
            }

            $requete .= ")";
        }
        if (!empty($domaines_exclu)) {
            $requete .= " AND NOT ";

            $currenturn = 0;
            foreach ($domaines_exclu as $current_domaine) {

                $domain = explode(".", $current_domaine);
                if(count($domain)>1) {
                    $ext = array_pop($domain);
                    $domain = implode(".", $domain);
                } else {
                    $ext = "";
                    $domain = $domain[0];
                }

                if(empty($ext)) {
                    if($currenturn == 0) {
                        $requete .= "(domain='".$domain."'";
                        $currenturn++;
                    } else {
                        $requete .= " OR domain='".$domain."'";
                    }
                } else {
                    if($currenturn == 0) {
                        $requete .= "((domain='".$domain."' AND groupe_domaine='".$ext."')";
                        $currenturn++;
                    } else {
                        $requete .= " OR (domain='".$domain."' AND groupe_domaine='".$ext."')";
                    }
                }
            }

            $requete .= ")";
        }


        
        
        //echo $requete;


        /////////////////////////////////////////
        //////////////// IMPORT /////////////////
        /////////////////////////////////////////
        if(empty($this->programme)) { // Programme non renseigné
            if(!empty($this->partenaire)) { // Partenaire renseigné
                // Recherche sur un partenaire
                $partenaire = "SELECT email FROM b2c_emails WHERE partenaire = $this->partenaire";
            }
        } else { // Programme renseigné
            // Recherche sur un programme
            $partenaire = "SELECT email FROM b2c_emails WHERE programme = $this->programme";
        }

        // Comptage global
        $requete_count    = "SELECT COUNT(*) FROM(";
        $allTabReq = array();
        $allTabReq[] = $requete;
        if(!empty($affinitaire)) $allTabReq[] = $affinitaire;
        if(!empty($partenaire))  $allTabReq[] = $partenaire;

        $requete_count    .= implode(" INTERSECT ", $allTabReq);
        $requete_count    .= ") result;";

        
        $requete_campagne = $requete;
        if(!empty($affinitaire)) $requete_campagne .= " AND email IN(".$affinitaire.")";
        if(!empty($partenaire))  $requete_campagne .= " AND email IN(".$partenaire.")";


        $nRows = $bdd->executeQueryRequete($requete_count, 1)->fetchColumn();
        echo $nRows;
        
        // Comptage sur la civilité
       // $requete_count_civilite    = "SELECT COUNT(*) FROM(";
       // $allTabReqs = array();
       // $allTabReqs[] = $requete;
        /*if(!empty($affinitaire)) $allTabReq[] = $affinitaire;
        if(!empty($partenaire))  $allTabReq[] = $partenaire;*/

       // $requete_count_civilite    .= implode(" INTERSECT ", $allTabReqs);
      //  $requete_count_civilite    .= " AND (gender='mr' OR gender='Mme' OR gender='Mlle') ) results;";
        
        //AND (gender='Mme' OR gender='Mlle')
        /*$requete_campagne = $requete;
        if(!empty($affinitaire)) $requete_campagne .= " AND email IN(".$affinitaire.")";
        if(!empty($partenaire))  $requete_campagne .= " AND email IN(".$partenaire.")";*/

        

       // $nRowsCiv = $bdd->executeQueryRequete($requete_count_civilite, 1)->fetchColumn();
       // echo $nRowsCiv;
        
        //$nRows = $bdd->executeQueryRequete($requete, 1)->fetchColumn();
        //echo $nRows;
        
        

        if($this->bool) {

            /////////////////////////////////////////
            /////// SAUVEGARDE DE LA RECHERCHE //////
            /////////////////////////////////////////
            $saveCount = "INSERT INTO counter(
					request, 
					campagne, 
					result, 
					name, 
					date) 
				VALUES ('"
                .str_replace("'", "''", $requete_count)."', '"
                .str_replace("'", "''", $requete_campagne)."', "
                .$nRows.", '"
                .str_replace("'", "''", $this->name)
                ."', CURRENT_TIMESTAMP)";

            $bdd->executeSimpleExecRequete($saveCount);


            /////////////////////////////////////////
            //////// AFFICHAGE DES RÉSULTATS ////////
            /////////////////////////////////////////
            echo '
<div class="table-pricing-3">
	<ul class="card row">
		<li class="col-md-12">
			<div class="innerAll">
				<div class="body">
					<div class="card-header">
						<span class="card-title mb-0">'.number_format($nRows, 0, "", " ").'</span>
						<span class="fs-xs text-reset mb-4">résultats</span>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped table-white">
						<tr>
							<th>Nom de la recherche</th>';
            if(!empty($this->name)) {
                echo '<td>'.$this->name.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Import</th>';
            if(!empty($this->import)) {
                echo '<td>'.$this->import.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Cible</th>';
            if(!empty($this->b2)) {
                echo '<td>'.strtoupper($this->b2).'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Sexe</th>';
            if(!empty($this->genre)) {
                switch ($this->genre) {
                    case 'homme':
                        echo '<td>Homme</td>';
                        break;
                    case 'femme':
                        echo '<td>Femme</td>';
                        break;
                    default:
                        echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
                        break;
                }
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Age</th>';
            if(empty($this->exclureAge)) {
                echo '<td>'.$this->age_min.' à '.$this->age_max.' ans</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Date d\'inscription</th>';
            if(!empty($this->date_regle_ins)) {
                echo '<td>'.$this->date_regle_ins.' '.$this->date1_ins.' '.$this->date2_ins.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Date d\'ouverture</th>';
            if(!empty($this->date_regle_ouv)) {
                echo '<td>'.$this->date_regle_ouv.' '.$this->date1_ouv.' '.$this->date2_ouv.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Date d\'envoi</th>';
            if(!empty($this->date_regle_env)) {
                echo '<td>'.$this->date_regle_env.' '.$this->date1_env.' '.$this->date2_env.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Date de clic</th>';
            if(!empty($this->date_regle_cli)) {
                echo '<td>'.$this->date_regle_cli.' '.$this->date1_cli.' '.$this->date2_cli.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Exclusion</th>';
            if(!empty($this->date)) {
                echo '<td>'.$this->date.' jours</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Pays</th>';
            if(!empty($this->pays)) {
                echo '<td>'.implode(',', $this->pays).'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Autres pays</th>';
            if(!empty($this->autre_pays)) {
                echo '<td>'.$this->autre_pays.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Départements français</th>';
            if(!empty($this->geoloc)) {
                echo '<td>'.implode(',', $this->geoloc).'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Code postal</th>';
            if(!empty($this->cp)) {
                echo '<td>'.$this->cp.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Top domaine</th>';
            if(!empty($this->cp)) {
                echo '<td><span class="glyphicons standard circle_ok"><i></i></span></td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Domaines exclus</th>';
            if(!empty($this->domaine_exclu)) {
                echo '<td>'.implode(',', $this->domaine_exclu).'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Autres domaines exclus</th>';
            if(!empty($this->autre_domaines_exclu)) {
                echo '<td>'.$this->autre_domaines_exclu.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Domaines inclus</th>';
            if(!empty($this->domaine_inclu)) {
                echo '<td>'.implode(',', $this->domaine_inclu).'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Autres domaines inclus</th>';
            if(!empty($this->autre_domaines_inclu)) {
                echo '<td>'.$this->autre_domaines_inclu.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr>
					</table>
				</div>
				<div class="footer">
					<a href="./search.php" class="btn btn-success">Nouveau comptage</a>
					<a href="./search_b.php" class="btn btn-info">Historique</a>
				</div>
			</div>
		</li>
	</ul>
</div>';
        } else {
            //echo $nRows;
            echo str_replace("'", "''", $requete_count).'|'.$nRows;
            //echo $requete_count;
        }

    }
}
?>
