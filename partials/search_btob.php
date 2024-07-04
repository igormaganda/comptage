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
    private $location;
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

    private $fonction_inclure;
    private $lignes;
    private $input_pays;
    private $input_ville;
    private $ville_inclure;
    private $villes;
    private $pays_inclure;
    private $cp_inclure;
    private $activity;
    private $input_naf;
    private $naf_inclure;
    private $form_juridique;
    private $forme_juridique;
    private $type_ets;

    private $copie_coller_naf;
    private $search_code_naf;
    private $copie_coller_forme_juridique;
    private $search_forme_juridique;
    private $copie_coller_fonctions;
    private $search_fonctions;
    private $input_fonctions;
    private $ca_inclure;
    private $convetion_collecive;
    private $search_convention_coll;
    private $copie_coller_convetion_coll;
    private $conv_collect_inclure;
    private $input_conv_collec;
    private $top_pays;
    private $champs_copier_coller_pays;
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
    private $inputfile_cp;
    private $villes_input;


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
        $this->cp                   = isset($POST["cp"]) ? $POST["cp"] : "";
        $this->input_cp             = isset($POST["input_cp"]) ? $POST["input_cp"] : "";
        $this->top_domaines         = isset($POST["topDomaine"]) ? $POST["topDomaine"] : "";
        $this->domaine_exclu        = isset($POST["domaine_exclu"]) ? $POST["domaine_exclu"] : "";
        $this->autre_domaines_exclu = isset($POST["autre_domaines_exclu"]) ? $POST["autre_domaines_exclu"] : "";
        $this->domaine_inclu        = isset($POST["domaine_inclu"]) ? $POST["domaine_inclu"] : "";
        $this->autre_domaines_inclu = isset($POST["autre_domaines_inclu"]) ? $POST["autre_domaines_inclu"] : "";

        $this->date_regle_ins       = isset($POST["date-regle-ins"]) ? $POST["date-regle-ins"] : "";
        $this->date1_ins            = isset($POST["date1-ins"]) ? $POST["date1-ins"] : "";
        $this->date2_ins            = isset($POST["date2-ins"]) ? $POST["date2-ins"] : "";
        $this->date_regle_ouv       = isset($POST["date-regle-ouv"]) ? $POST["date-regle-ouv"] : "";
        $this->date1_ouv            = isset($POST["date1-ouv"]) ? $POST["date1-ouv"] : "";
        $this->date2_ouv            = isset($POST["date2-ouv"]) ? $POST["date2-ouv"] : "";
        $this->date_regle_env       = isset($POST["date-regle-env"]) ? $POST["date-regle-env"] : "";
        $this->date1_env            = isset($POST["date1-env"]) ? $POST["date1-env"] : "";
        $this->date2_env            = isset($POST["date2-env"]) ? $POST["date2-env"] : "";
        $this->date_regle_cli       = isset($POST["date-regle-cli"]) ? $POST["date-regle-cli"] : "";
        $this->date1_cli            = isset($POST["date1-cli"]) ? $POST["date1-cli"] : "";
        $this->date2_cli            = isset($POST["date2-cli"]) ? $POST["date2-cli"] : "";

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


        $this->location             = isset($POST["location"]) ? $POST["location"] : "";
        $this->fonction_inclure     = isset($POST["fonction_inclure"]) ? $POST["fonction_inclure"] : "";
        $this->lignes               = isset($POST["lignes"]) ? $POST["lignes"] : "";
        $this->input_pays           = isset($POST["input_pays"]) ? $POST["input_pays"] : "";
        $this->input_ville          = isset($POST["villes_input"]) ? $POST["villes_input"] : "";
        $this->ville_inclure        = isset($POST["ville_inclure"]) ? $POST["ville_inclure"] : "";
        $this->villes               = isset($POST["villes"]) ? $POST["villes"] : "";
        $this->pays_inclure         = isset($POST["pays_inclure"]) ? $POST["pays_inclure"] : "";
        $this->cp_inclure           = isset($POST["cp_inclure"]) ? $POST["cp_inclure"] : "";
        $this->activity             = isset($POST["activity"]) ? $POST["activity"] : "";
        $this->postal               = isset($POST["postal"]) ? $POST["postal"] : "";

        $this->naf                  = isset($POST["naf"]) ? $POST["naf"] : "";
        $this->forme_juridique      = isset($POST["forme_juridique"]) ? $POST["forme_juridique"] : "";
        $this->institution          = isset($POST["institution"]) ? $POST["institution"] : "";
        $this->effectif             = isset($POST["effectif"]) ? $POST["effectif"] : "";
        $this->ca                   = isset($POST["ca"]) ? $POST["ca"] : "";
        $this->form_juridique       = isset($POST["form_juridique"]) ? $POST["form_juridique"] : "";
        $this->input_naf            = isset($POST["input_naf"]) ? $POST["input_naf"] : "";
        $this->naf_inclure          = isset($POST["naf_inclure"]) ? $POST["naf_inclure"] : "";
        $this->form_juridique_inclure          = isset($POST["form_juridique_inclure"]) ? $POST["form_juridique_inclure"] : "";
        $this->type_ets            = isset($POST["type_ets"]) ? $POST["type_ets"] : "";

        $this->copie_coller_naf            = isset($POST["code_naf_paste"]) ? $POST["code_naf_paste"] : "";
        $this->search_code_naf            = isset($POST["search_code_naf"]) ? $POST["search_code_naf"] : "";

        $this->copie_coller_forme_juridique            = isset($POST["forme_juridique_paste"]) ? $POST["forme_juridique_paste"] : "";
        $this->search_forme_juridique            = isset($POST["search_forme_juridique"]) ? $POST["search_forme_juridique"] : "";

        $this->copie_coller_fonctions            = isset($POST["fonctions_paste"]) ? $POST["fonctions_paste"] : "";
        $this->search_fonctions            = isset($POST["search_fonctions"]) ? $POST["search_fonctions"] : "";
        $this->input_fonctions           = isset($POST["inputfile_fonctions"]) ? $POST["inputfile_fonctions"] : "";
        $this->ca_inclure           = isset($POST["inclure_ca"]) ? $POST["inclure_ca"] : "";
        $this->convetion_collecive          = isset($POST["convetion_collecive"]) ? $POST["convetion_collecive"] : "";
        $this->search_convention_coll          = isset($POST["search_convention_coll"]) ? $POST["search_convention_coll"] : "";
        $this->copie_coller_convetion_coll          = isset($POST["conv_collec_paste"]) ? $POST["conv_collec_paste"] : "";
        $this->conv_collect_inclure           = isset($POST["conv_collect_inclure"]) ? $POST["conv_collect_inclure"] : "";
        $this->input_conv_collec           = isset($POST["input_conv_collec"]) ? $POST["input_conv_collec"] : "";
        $this->top_pays         = isset($POST["top_pays"]) ? $POST["top_pays"] : "";
        $this->champs_copier_coller_pays           = isset($POST["textarea_numreg"]) ? $POST["textarea_numreg"] : "";

        $this->champs_copier_coller_dep           = isset($POST["textarea_dep"]) ? $POST["textarea_dep"] : "";
        $this->selectcp           = isset($POST["selectcp"]) ? $POST["selectcp"] : "";
        $this->autres_villes           = isset($POST["autres_villes"]) ? $POST["autres_villes"] : "";

        $this->input_dep         = isset($POST["input_dep"]) ? $POST["input_dep"] : "";
        $this->inclure_dep         = isset($POST["inclure_dep"]) ? $POST["inclure_dep"] : "";

        $this->region        = isset($POST["regions"]) ? $POST["regions"] : "";
        $this->autres_regions        = isset($POST["autres_regions"]) ? $POST["autres_regions"] : "";
        $this->champs_copier_coller_region        = isset($POST["textarea_region"]) ? $POST["textarea_region"] : "";
        $this->input_region         = isset($POST["input_region"]) ? $POST["input_region"] : "";

        $this->inclure_region         = isset($POST["region_inclure"]) ? $POST["region_inclure"] : "";

        $this->autre_pays           = isset($POST["autre_pays"]) ? $POST["autre_pays"] : "";
        $this->autre_cp           = isset($POST["autre_cp"]) ? $POST["autre_cp"] : "";
        $this->champs_copier_coller           = isset($POST["textarea_numreg"]) ? $POST["textarea_numreg"] : "";


        $this->cp                   = isset($POST["cp"]) ? $POST["cp"] : "";
        $this->autres_dep                   = isset($POST["autres_dep"]) ? $POST["autres_dep"] : "";
        $this->inputfile_cp                   = isset($POST["inputfile_cp"]) ? $POST["inputfile_cp"] : "";
        $this->villes_input          = isset($POST["villes_input"]) ? $POST["villes_input"] : "";
        $this->champs_copier_coller_cp           = isset($POST["textarea_cp"]) ? $POST["textarea_cp"] : "";
        $this->champs_copier_coller_ville           = isset($POST["textarea_ville"]) ? $POST["textarea_ville"] : "";

        $this->input_region         = isset($POST["input_regions"]) ? $POST["input_regions"] : "";

        $this->generateRequest();
    }

    
    
    private function generateRequest() {
        $bdd = new Bdd();
        $affinitaire = "";
        $partenaire = "";
        
        $CPM_EMAIL_PRICE = 15;
        $CPM_MOBILE_PRICE = 20;
        $CPM_ADRESSE_PRICE = 22;
        
        $CPM_DEFAULT_QUOTA = 1000;
        

        //$requete = "SELECT email FROM b2c WHERE blacklist IS NOT TRUE AND (statut IS NULL OR statut='SB')";
        //$requete = "SELECT emailpro FROM b2b WHERE blacklist IS NOT TRUE AND (statut IS NULL OR statut='SB')";

        /////////////////////////////////////////
        //////////////// Location ////////////////
        /////////////////////////////////////////
        if(!empty($this->location)){
            $cles = implode(",", $this->location);

            $requete = "SELECT $cles FROM b2b WHERE blacklist IS NOT TRUE AND (statut IS NULL OR statut='SB')";

            //echo "Clés : " .$cles."\n";
        } else {
            $requete = "SELECT emailpro FROM b2b WHERE blacklist IS NOT TRUE AND (statut IS NULL OR statut='SB')";

        }

        /////////////////////////////////////////
        ////////////////// Activité /////////////
        /////////////////////////////////////////
        $activite = array();

        if (!empty($this->activity)) {
            $active = explode(",", $this->activity);
            foreach ($active as $currentActivity) {
                $activite[] = $currentActivity;
            };
        }

        if (!empty($this->input_fonctions)) {
            $active = explode(",", $this->input_fonctions);

            foreach ($active as $currentActivity) {
                $activite[] = $currentActivity;
            }
        }

        if (!empty($this->search_fonctions)) {
            $active = explode(",", $this->search_fonctions);
            foreach ($active as $currentActivity) {
                $activite[] = $currentActivity;
            };
        }
        if (!empty($this->copie_coller_fonctions)) {
            $active = explode(",", $this->copie_coller_fonctions);
            foreach ($active as $currentActivity) {
                $activite[] = $currentActivity;
            };
        }

        if (!empty($activite)) {
            if ($this->fonction_inclure == "true") {
                $requete .= "AND activite IN ('" . implode("','", $activite) . "')";
            } else if ($this->fonction_inclure == "false") {
                $requete .= "AND activite NOT IN ('" . implode("','", $activite) . "')";
            } else {
                $requete .= "AND activite  IN ('" . implode("','", $activite) . "')";
            }
        }

        /////////////////////////////////////////
        ///////////////// PAYS //////////////////
        /////////////////////////////////////////
        $country = array();


        if (!empty($this->top_pays)) {
            foreach ($this->top_pays as $value) {
                $country[] = $value;
            }
        }

        if(!empty($this->champs_copier_coller_pays)) {
            $autre_pays = explode(",", $this->champs_copier_coller_pays);

            foreach ($autre_pays as $value) {
                $country[] = $value;
            }
        }

        if (!empty($this->input_pays)) {
            $autre_pays = explode(",", $this->input_pays);

            foreach ($autre_pays as $currentCp) {
                $country[] = $currentCp;
            }
        }
        
        if (!empty($this->pays)) {
            foreach ($this->pays as $value) {
                $country[] = $value;
            }
        }
        if (!empty($this->imput_pays)) {
            foreach ($this->imput_pays as $value) {
                $country[] = $value;
            }
        }

        if (!empty($this->autre_pays)) {
            $autre_pays = explode(",", $this->autre_pays);

            foreach ($autre_pays as $currentCp) {
                $country[] = $currentCp;
            }
        }
        
        
        

        if (!empty($this->input_pays)) {
            $autre_pays = explode(",", $this->input_pays);

            foreach ($autre_pays as $currentCp) {
                $country[] = $currentCp;
            }
        }

        if (!empty($country)) {
            $requete .= " AND (";

            $currenturn = 0;
            if ($this->pays_inclure && $this->pays_inclure == "true") {

                foreach ($country as $value) {
                    if ($currenturn == 0) {
                        $requete .= "pays='" . $value . "'";
                        $currenturn++;
                    } else {
                        $requete .= " OR pays='" . $value . "'";
                    }
                }

                $requete .= ")";
            } else {

                foreach ($country as $value) {
                    if ($currenturn == 0) {
                        $requete .= "pays !='" . $value . "'";
                        $currenturn++;
                    } else {
                        $requete .= " OR pays !='" . $value . "'";
                    }
                }

                $requete .= ")";
            }
        }

        /////////////////////////////////////////
        //////////////// GEOLOC /////////////////
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
            echo "line " .$this->ligne;
            $autre_cp = explode(",", $this->ligne);

            foreach ($autre_cp as $value) {
                $postalCode[] = $value;
            }
        }

        if(!empty($this->inputfile_cp)) {
            //echo "line " .$this->inputfile_cp;
            $autre_cp = explode(",", $this->inputfile_cp);

            foreach ($autre_cp as $value) {
                $postalCode[] = $value;
            }
        }

        if(!empty($postalCode)) {

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
        }
        //echo "cp inclure : " .$this->cp_inclure."\n";


        //echo "<script>console.log('$this->lignes');console.log('$postalCode[0]');console.log('$postalCode[1]');</script>";



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



        /////////////////////////////////////////
        ///////////////   VILLES   //////////////
        /////////////////////////////////////////
        $villesTab = array();
        //input des villes
        if(!empty($this->villes)){
            $ville = explode("," , $this->villes);
            foreach ($ville as $ville_) {
                $villesTab[] = $ville_;
            };
        }

        if(!empty($this->autres_villes)) {
            $autres_villes = explode(",", $this->autres_villes);

            foreach ($autres_villes as $currentVille) {
                $villesTab[] = $currentVille;
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


        //Données villes du fichier
        if(!empty($this->input_ville)){
            $ville = explode("," , $this->input_ville);
            foreach ($ville as $ville_) {
                $villesTab[] = $ville_;
            };
        }
        

        // echo "<script>console.log('la ville');console.log('$villesTab[0]');console.log('$villesTab[1]');console.log('$villesTab[3]');</script>";

        if(!empty($villesTab)){

            $requete .= " AND ";

            $currenturn_ = 0;
            if($this->cp_inclure && $this->ville_inclure == "true"){

                foreach ($villesTab as $value) {
                    if($currenturn_ == 0) {
                        $requete .= "(ville LIKE '".$value."%'";
                        $currenturn_++;
                    } else {
                        $requete .= " OR ville LIKE '".$value."%'";
                    }
                }

                $requete .= ")";
            } else {
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
        ////////////////  NAF  //////////////////
        /////////////////////////////////////////
        $nafTab = array();

        if (!empty($this->naf)) {
            $active = explode(",", $this->naf);
            foreach ($active as $currentNaf) {
                $nafTab[] = $currentNaf;
            }
        }

        if (!empty($this->input_naf)) {
            $active = explode(",", $this->input_naf);
            foreach ($active as $currentNaf) {
                $nafTab[] = $currentNaf;
            };
        }

        if (!empty($this->search_code_naf)) {
            $active = explode(",", $this->search_code_naf);
            foreach ($active as $currentNaf) {
                $nafTab[] = $currentNaf;
            };
        }
        if (!empty($this->copie_coller_naf)) {
            $active = explode(",", $this->copie_coller_naf);
            foreach ($active as $currentNaf) {
                $nafTab[] = $currentNaf;
            };
        }

        if (!empty($nafTab)) {
            if ($this->naf_inclure == "true") {
                $requete .= " AND (naf IN ('".implode("','", $nafTab)."'))";
            } else if ($this->naf_inclure == "false") {
                $requete .= " AND (naf NOT IN ('".implode("','", $nafTab)."'))";
            } else {
                $requete .= " AND (naf  IN ('".implode("','", $nafTab)."'))";
            }
        }


        /////////////////////////////////////////
        ////////// Forme juridique  /////////////
        /////////////////////////////////////////
        $formJuridiqueTab = array();

        if (!empty($this->forme_juridique)) {
            $active = explode(",", $this->forme_juridique);
            foreach ($active as $currentJuridique) {
                $formJuridiqueTab[] = $currentJuridique;
            };
        }

        if (!empty($this->search_forme_juridique)) {
            $active = explode(",", $this->search_forme_juridique);
            foreach ($active as $currentFormJuridique) {
                $formJuridiqueTab[] = $currentFormJuridique;
            };
        }
        if (!empty($this->copie_coller_forme_juridique)) {
            $active = explode(",", $this->copie_coller_forme_juridique);
            foreach ($active as $currentFormJuridique) {
                $formJuridiqueTab[] = $currentFormJuridique;
            };
        }

        if (!empty($this->form_juridique)) {
            $active = explode(",", $this->form_juridique);
            foreach ($active as $currentFormJuridique) {
                $formJuridiqueTab[] = $currentFormJuridique;
            };
        }

        if (!empty($formJuridiqueTab)) {
            if ($this->form_juridique_inclure == "true") {
                $requete .= " AND forme IN ('".implode("','", $formJuridiqueTab)."')";
            } else if ($this->form_juridique_inclure == "false") {
                $requete .= " AND forme NOT IN ('".implode("','", $formJuridiqueTab)."')";
            }
        }

        /////////////////////////////////////////
        ///////////// Institutions //////////////
        // 1:Mariés, 2:EPCI, 3:CD,4:CR,5:D,6:S //
        /////////////////////////////////////////
        // $institutionsTab = array();
        if (!empty($this->institution)) {

            $requete .= " AND (institutions ='" . implode("' OR institutions ='", $this->institution) . "')";

        }

        /////////////////////////////////////////
        /////////////  Effectifs   //////////////
        /////////////////////////////////////////


        if (!empty($this->effectif)) {

            switch ($this->effectif) {
                case 'non':
                    $requete .= " AND  ( effectif IS NULL OR effectif = '')";
                    break;
                case '1':
                    $requete .= " AND ( effectif = '0' )";
                    break;
                case '2':
                    $requete .= " AND ( effectif BETWEEN '1' AND '2' )";
                    break;
                case '3':
                    $requete .= " AND ( effectif BETWEEN '3' AND '5' )";
                    break;
                case '4':
                    $requete .= " AND ( effectif BETWEEN '6' AND '9' )";
                    break;
                case '5':
                    $requete .= " AND ( effectif BETWEEN '10' AND '19' )";
                    break;
                case '6':
                    $requete .= " AND ( effectif BETWEEN '20' AND '24' )";
                    break;
                case '7':
                    $requete .= " AND ( effectif BETWEEN '50' AND '99' )";
                    break;
                case '8':
                    $requete .= " AND ( effectif BETWEEN '100' AND '199' )";
                    break;
                case '9':
                    $requete .= " AND ( effectif BETWEEN '200' AND '249' )";
                    break;
                case '10':
                    $requete .= " AND ( effectif BETWEEN '250' AND '499' )";
                    break;
                case '11':
                    $requete .= " AND ( effectif BETWEEN '500' AND '599' )";
                    break;
                case '12':
                    $requete .= " AND ( effectif BETWEEN '1000' AND '1999' )";
                    break;
                case '13':
                    $requete .= " AND ( effectif BETWEEN '2000' AND '4999' )";
                    break;
                case '14':
                    $requete .= " AND ( effectif BETWEEN '5000' AND '9999' )";
                    break;
                case '15':
                    $requete .= " AND ( effectif >= '10000' )";
                    break;

            }


        }

        /////////////////////////////////////////
        ///////  Chiffres d'affaires   //////////
        /////////////////////////////////////////


       /* if (!empty($this->ca)) {

            switch ($this->ca) {
                case '1':
                    $requete .= " AND ( ca <= '499999' )";
                    break;
                case '2':
                    $requete .= " AND ( ca BETWEEN '500000' AND '999999' )";
                    break;
                case '3':
                    $requete .= " AND ( ca BETWEEN '1000000' AND '1999999' )";
                    break;
                case '4':
                    $requete .= " AND ( ca BETWEEN '2000000' AND '4999999' )";
                    break;
                case '5':
                    $requete .= " AND ( ca BETWEEN '5000000' AND '9999999' )";
                    break;
                case '6':
                    $requete .= " AND ( ca BETWEEN '10000000' AND '19999999' )";
                    break;
                case '7':
                    $requete .= " AND ( ca BETWEEN '20000000' AND '49999999' )";
                    break;
                case '8':
                    $requete .= " AND ( ca BETWEEN '50000000' AND '99999999' )";
                    break;
                case '9':
                    $requete .= " AND ( ca BETWEEN '100000000' AND '199999999' )";
                    break;
                case '10':
                    $requete .= " AND ( ca >= '200000000' )";
                    break;


            }


        }*/
        if (!empty($this->ca)) {

            switch ($this->ca) {
                case '1':
                    if($this->ca_inclure == "true") {
                        $requete .= " AND ( ca <= '999999' )";
                        break;
                    } else {
                        $requete .= " AND NOT ( ca <= '999999' )";
                        break;
                    }
                    
                case '2':
                    if($this->ca_inclure == "true") {
                        $requete .= " AND ( ca BETWEEN '1000000' AND '2000000' )";
                        break;
                    } else {
                        $requete .= " AND NOT ( ca BETWEEN '1000000' AND '2000000' )";
                        break;
                    }
                case '3':
                    if($this->ca_inclure == "true") {
                        $requete .= " AND ( ca BETWEEN '2000000' AND '5000000' )";
                        break;
                    } else {
                        $requete .= " AND NOT ( ca BETWEEN '2000000' AND '5000000' )";
                        break;
                    }
                case '4':
                    if($this->ca_inclure == "true") {
                        $requete .= " AND ( ca BETWEEN '5000000' AND '10000000' )";
                        break;
                    } else {
                        $requete .= " AND NOT ( ca BETWEEN '5000000' AND '10000000' )";
                        break;
                    }
                case '5':
                    if($this->ca_inclure == "true") {
                        $requete .= " AND ( ca >= '10000000' )";
                        break;
                    } else {
                        $requete .= " AND NOT ( ca >= '10000000' )";
                        break;
                    }

            }
            
        }


        /////////////////////////////////////////
        //////////////// Date de création ///////
        /////////////////////////////////////////

        if (!empty($this->date1_ins) && !empty($this->date2_ins)) {

            if ($this->date1_ins > $this->date2_ins) {
               // echo "La 1ere date de creation doit etre inferieure..." . "\n";
            } else {
                $requete .= " AND (date_in::date BETWEEN '$this->date1_ins' AND '$this->date2_ins')";

            }

        }


        /////////////////////////////////////////
        //// Types d'établissements /////////////
        /////////////////////////////////////////

        if (!empty($this->type_ets)) {
            switch ($this->type_ets) {

                case '1':
                    $requete .= " AND siege ='" . $this->type_ets . "'";
                    break;
                case '2':
                    $requete .= " AND siege ='" . $this->type_ets . "'";
                    break;
            }

            //echo "Type ets : " .$requete ."\n";
        }


        /////////////////////////////////////////
        //// Convention collectives /////////////
        /////////////////////////////////////////

        $conv_collective = array();

        if (!empty($this->convetion_collecive)) {
            $active = explode(",", $this->convetion_collecive);
            foreach ($active as $currentCon) {
                $conv_collective[] = $currentCon;
            }
        }

        if (!empty($this->input_conv_collec)) {
            $active = explode(",", $this->input_conv_collec);
            foreach ($active as $currentCon) {
                $conv_collective[] = $currentCon;
            };
        }

        if (!empty($this->search_convention_coll)) {
            $active = explode(",", $this->search_convention_coll);
            foreach ($active as $currentCon) {
                $conv_collective[] = $currentCon;
            };
        }
        if (!empty($this->copie_coller_convetion_coll)) {
            $active = explode(",", $this->copie_coller_convetion_coll);
            foreach ($active as $currentCon) {
                $conv_collective[] = $currentCon;
            };
        }

        if (!empty($conv_collective)) {
            if ($this->conv_collect_inclure == "true") {
                $requete .= " AND (conv_collective IN ('".implode("','", $conv_collective)."'))";
            } else if ($this->conv_collect_inclure == "false") {
                $requete .= " AND (conv_collective NOT IN ('".implode("','", $conv_collective)."'))";
            } else {
                $requete .= " AND (conv_collective  IN ('".implode("','", $conv_collective)."'))";
            }
        }

        /////////////////////////////////////////
        //////////////// DOMAINES ///////////////
        /////////////////////////////////////////

        $domaines_inclu = $domaines_exclu = array();

        if (!empty($this->domaine_exclu)) {
            foreach ($this->domaine_exclu as $select_domaine) {
                $domaines_exclu[] = $select_domaine;
            }

            // echo "domaine exclu : " . $domaines_exclu[0] ."\n";
        }

        if (!empty($this->autre_domaines_exclu)) {
            $autre_dom = explode(",", $this->autre_domaines_exclu);

            foreach ($autre_dom as $new_domaine) {
                $domaines_exclu[] = $new_domaine;
            }
            //var_dump(" exclu " . $domaines_exclu[0] ."\n");
        }

        if (!empty($this->domaine_inclu)) {
            foreach ($this->domaine_inclu as $select_domaine) {
                $domaines_inclu[] = $select_domaine;
            }
            // var_dump(" exclu " . $domaines_inclu[0] ."\n");

        }

        if (!empty($this->autre_domaines_inclu)) {
            $autre_dom = explode(",", $this->autre_domaines_inclu);

            foreach ($autre_dom as $new_domaine) {
                $domaines_inclu[] = $new_domaine;
            }
        }
        if (!empty($this->top_domaines)) {

            $reqTopDom = "SELECT top_domain FROM info LIMIT 1";
            $result = $bdd->executeQueryRequete($reqTopDom, 1);
            while ($top_dom = $result->fetch()) {
                $topDomList = trim($top_dom->top_domain);
            }

            $domList = explode(";", $topDomList);
            //echo "top domain : " .$domList[0] . "\n";
            if (count($domList) > 0) {
                foreach ($domList as $value) {
                    $dom = explode(",", $value);
                    $domaines_inclu[] = trim($dom[0]);
                }
                //echo "top domain : " .$domaines_inclu[0] . "\n";
            }
        }

        $domaines_inclu = array_unique($domaines_inclu);
        $domaines_exclu = array_unique($domaines_exclu);

        if (!empty($domaines_inclu)) {
            $requete .= " AND ";

            $currenturn = 0;

            foreach ($domaines_inclu as $current_domaine) {

                $domain = explode(".", $current_domaine);
                if (count($domain) > 1) {
                    $ext = array_pop($domain);
                    $domain = implode(".", $domain);
                } else {
                    $ext = "";
                    $domain = $domain[0];
                }

                if (empty($ext)) {
                    if ($currenturn == 0) {
                        $requete .= "(domain='" . $domain . "'";
                        $currenturn++;
                    } else {
                        $requete .= " OR domain='" . $domain . "'";
                    }
                } else {
                    if ($currenturn == 0) {
                        $requete .= "((domain='" . $domain . "' AND groupe_domaine='" . $ext . "')";
                        $currenturn++;
                    } else {
                        $requete .= " OR (domain='" . $domain . "' AND groupe_domaine='" . $ext . "')";
                    }
                }
            }

            $requete .= ")";
            //   echo " dom : " .$requete."\n";
        }

        if (!empty($domaines_exclu)) {
            $requete .= " AND NOT ";

            $currenturn = 0;
            foreach ($domaines_exclu as $current_domaine) {

                $domain = explode(".", $current_domaine);
                if (count($domain) > 1) {
                    $ext = array_pop($domain);
                    $domain = implode(".", $domain);
                } else {
                    $ext = "";
                    $domain = $domain[0];
                }

                if (empty($ext)) {
                    if ($currenturn == 0) {
                        $requete .= "(domain='" . $domain . "'";
                        $currenturn++;
                    } else {
                        $requete .= " OR domain='" . $domain . "'";
                    }
                } else {
                    if ($currenturn == 0) {
                        $requete .= "((domain='" . $domain . "' AND groupe_domaine='" . $ext . "')";
                        $currenturn++;
                    } else {
                        $requete .= " OR (domain='" . $domain . "' AND groupe_domaine='" . $ext . "')";
                    }
                }
            }

            $requete .= ")";

            // echo " dom : " .$requete."\n";
        }


        /////////////////////////////////////////
        ////////////// OCCURRENCES //////////////
        /////////////////////////////////////////
        if (!empty($this->date)) {

            $requete .= " Group By $cles, domain HAVING COUNT(domain) <= $this->date ";

            //$requete .= " GROUP BY $cles domain HAVING COUNT(domain) <= $this->occurrence";
        }

        //echo "<script>console.log('FJ');console.log('$formJuridiqueTab[0]');console.log('$formJuridiqueTab[1]');console.log('$formJuridiqueTab[2]');</script>";

        //echo "<script>console.log('Date');console.log('$this->date');</script>";

        // echo " req : " .$requete . "\n";
        // echo " country : " .$country[0] . "\n";



        /////////////////////////////////////////
        //////////////// IMPORT /////////////////
        /////////////////////////////////////////
        if(empty($this->programme)) { // Programme non renseigné
            if(!empty($this->partenaire)) { // Partenaire renseigné
                // Recherche sur un partenaire
                $partenaire = "SELECT emailpro FROM b2b_emails WHERE partenaire = $this->partenaire";
            }
        } else { // Programme renseigné
            // Recherche sur un programme
            $partenaire = "SELECT emailpro FROM b2b_emails WHERE programme = $this->programme";
        }



        $requete_count    = "SELECT COUNT(*) FROM(";
        $allTabReq = array();
        $allTabReq[] = $requete;
        if(!empty($affinitaire)) $allTabReq[] = $affinitaire;
        if(!empty($partenaire))  $allTabReq[] = $partenaire;

        $requete_count    .= implode(" INTERSECT ", $allTabReq);
        $requete_count    .= ") result;";

        $requete_campagne = $requete;
        if(!empty($affinitaire)) $requete_campagne .= " AND emailpro IN(".$affinitaire.")";
        if(!empty($partenaire))  $requete_campagne .= " AND emailpro IN(".$partenaire.")";


        $nRows = $bdd->executeQueryRequete($requete_count, 1)->fetchColumn();

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
	<ul class="list-unstyled row">
		<li class="col-md-12">
			<div class="innerAll">
				<div class="body">
					<div class="price">
						<span class="figure">'.number_format($nRows, 0, "", " ").'</span>
						<span class="term">résultats</span>
					</div>
				</div>
				<div class="features">
					<table class="table table-bordered table-striped table-white">
						<tr>
							<th>Nom de la recherche</th>';
            if(!empty($this->name)) {
                echo '<td>'.$this->name.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Location</th>';
            if(!empty($this->location)) {
                echo '<td>'.implode(',', $this->location).'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Import</th>';
            if(!empty($this->partenaire)) {
                echo '<td>'.$this->partenaire.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }

            echo '</tr><tr>
							<th>Fonctions</th>';
            if(!empty($this->activity)) {
                // echo '<td>'.implode(',', $activite).'</td>';
                if ($this->fonction_inclure == "true") {
                    echo '<td>'.implode(',', $activite).'</td>';
                } else if ($this->fonction_inclure == "false"){
                    echo '<td>'.implode(',', $activite).'</td>';
                }
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
            if(!empty($this->autre_pays || $this->input_pays || $this->imput_pays)) {
                echo '<td>'.implode(',', $country).' </td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }

            echo '</tr><tr>
							<th>Departement</th>';
            if(!empty($this->geoloc || $this->cp || $this->input_cp)) {

                // echo '<td>'.implode(',', $this->geoloc).' </td>';
                echo '<td>'.implode(',', $dep).' </td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }

            echo '</tr><tr>
							<th>Code postal</th>';
            /* if(!empty($this->postal || $this->lignes)) {
 
                 echo '<td>'.implode(',', $postalCode).' </td>';
             } else if ( $this->cp_inclure == "true" || $this->cp_inclure == "false") {
                 echo '<td>'.implode(',', $postalCode).' </td>';
             } else {
                 echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
             }*/

            if(!empty($this->postal || $this->lignes)) {

                echo '<td>' . implode(',', $postalCode) . ' </td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }

            echo '</tr><tr>
							<th>Villes</th>';
            if(!empty($this->villes || $this->input_ville )) {
                echo '<td>'.implode(',', $villesTab).' </td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            /* if(!empty($this->villes)) {
                 echo '<td>'.implode(',', $villesTab).' </td>';
 
             } else if($this->cp_inclure && $this->ville_inclure == "true") {
                 echo '<td>'.implode(',', $villesTab).' </td>';
             } else {
                 echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
             }*/

            echo '</tr><tr>
							<th>NAF</th>';
            if(!empty($this->naf || $this->input_naf )) {
                echo '<td>'.implode(',', $nafTab).' </td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }

            echo '</tr><tr>
							<th>Forme juridique </th>';
            if(!empty($this->forme_juridique || $this->form_juridique )) {
                echo '<td>'.implode(',', $formJuridiqueTab).' </td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }


            echo '</tr><tr>
							<th>Institutions</th>';
            if(!empty($this->institution)) {
                echo '<td>'.implode(',', $this->institution).' </td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }

            echo '</tr><tr>
							<th>Effectif</th>';
            if(!empty($this->effectif)) {
                echo '<td>'. $this->effectif.' </td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }

            echo '</tr><tr>
							<th>Chiffres d\'affaires </th>';
            if(!empty($this->ca)) {
                echo '<td>'. $this->ca.' </td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }



            echo '</tr><tr>
							<th>Date de création </th>';
            if(!empty($this->date1_ins && $this->date2_ins)) {
                echo '<td>'.$this->date1_ins.' - '.$this->date2_ins.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }

            echo '</tr><tr>
							<th>Types d\'établissements </th>';
            if(!empty($this->type_ets)) {
                echo '<td>'.$this->type_ets.'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }


            echo '</tr><tr>
							<th>Top domaine</th>';
            if(!empty($this->top_domaines)) {
                echo '<td>'.implode(',', $domaines_inclu).'</td>';
            } else {
                echo '<td><span class="glyphicons standard remove_2"><i></i></span></td>';
            }
            echo '</tr><tr>
							<th>Nombre d\'occurence</th>';
            if(!empty($this->date)) {
                echo '<td>'.$this->date.' occurence(s) </td>';
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
					<a href="./search_btoc.php" class="btn btn-success">Nouveau comptage</a>
					<a href="./search_b_btob.php" class="btn btn-info">Historique</a>
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
