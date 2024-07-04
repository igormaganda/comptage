<?php
	class Insert {
		private $order_by = 1;
		private $db;
		private $calc;
		private $reqDB = "";

		private $first_record;
		private $dirigeant;
		private $order;
		private $mailOrMd5Data;
		private $mailOrMd5Tmp;
		private $min_path;
		private $save_path;
		private $down_path;
		private $nbCaracts;
		private $nbChiffres;
		private $tab_keys;

		private $b2;
		private $name;
		private $nb_champs;
		private $file_name;
		private $separateur;
		private $programme;
		private $comp_partenaire;
		private $comp_programme;
		private $matching;
		private $ouvreurs;
		private $cliqueurs;
		private $action;
		private $mail_md5;
		private $download;
		private $categorie;
		private $thematiques;

		private $filtre_existant;
		private $filtre_invalide;
		private $filtre_interdit;
		private $filtre_doublon;
		private $filtre_blacklist;
		private $filtre_caracteres;
		private $filtre_nombres;
		private $inter_min;
		private $inter_max;

		private $tmp;


		public function __construct($POST) {
			$bdd = new Bdd();
        	$this->db = $bdd->connect();

			switch ($GLOBALS['env']) {
				case 0: // Windows
					$this->min_path  = "C:/wamp/www/Datamart";
					$this->save_path = "C:/wamp/www/Datamart/extracts/".date("Ymd-his");
					$this->down_path = "/Datamart/extracts/".date("Ymd-his");
					break;
					
				case 1: // Prod
					$this->min_path  = "/var/www/html/Datamart";
					$this->save_path = "/var/www/html/Datamart/extracts/".date("Ymd-his");
					$this->down_path = "/Datamart/extracts/".date("Ymd-his");
					break;
					
				case 10: // BERTRAND
					$this->min_path  = "/var/www/html/ber";
					$this->save_path = "/var/www/html/ber/extracts/".date("Ymd-his");
					$this->down_path = "/ber/extracts/".date("Ymd-his");
					break;

				case 100: // ADN
					$this->min_path  = "/var/www/html/adn";
					$this->save_path = "/var/www/html/adn/extracts/".date("Ymd-his");
					$this->down_path = "/adn/extracts/".date("Ymd-his");
					break;

				case 2: // Preprod
					$this->min_path  = "/var/www/html/Datamart_dev";
					$this->save_path = "/var/www/html/Datamart_dev/extracts/".date("Ymd-his");
					$this->down_path = "/Datamart_dev/extracts/".date("Ymd-his");
					break;

				case 3: // Test
					$this->min_path  = "/var/www/html/Datamart_test";
					$this->save_path = "/var/www/html/Datamart_test/extracts/".date("Ymd-his");
					$this->down_path = "/Datamart_test/extracts/".date("Ymd-his");
					break;

				case 4: // Nettoyage
					$this->min_path  = "/var/www/html/Datamart_nettoyage";
					$this->save_path = "/var/www/html/Datamart_nettoyage/extracts/".date("Ymd-his");
					$this->down_path = "/Datamart_nettoyage/extracts/".date("Ymd-his");
					break;
			}

			$this->calc            = new Calc();
			$this->nbCaracts       = $this->calc->info("lettres");
			$this->nbChiffres      = $this->calc->info("chiffres");
			$this->tab_keys        = array_filter(array_map('trim', explode(",", $this->calc->info("spam"))));
			
			mkdir($this->save_path); chmod($this->save_path, 0777);
			
			$this->first_record    = isset($POST["exclureFirstLine"]) ? $POST["exclureFirstLine"] == "yes" ? "CSV HEADER " : "" : "";
			$this->dirigeant       = isset($POST["dirigeants"]) ? $POST["dirigeants"] == "yes" ? "TRUE" : "FALSE" : "FALSE";
			$this->order           = array();
			
			$this->b2              = isset($POST["b2"]) ? $POST["b2"] == "b2c" ? 1 : 0 : "";
			$this->name            = isset($POST["nom"]) ? $POST["nom"] : "";
			$this->nb_champs       = isset($POST["nb_champs"]) ? $POST["nb_champs"] : "";
			$this->file_name       = isset($POST["file"]) ? $POST["file"] : "";
			$this->separateur      = isset($POST["separateur"]) ? $POST["separateur"] : "";
			$this->programme       = isset($POST["programme"]) ? $POST["programme"] : 0;
			$this->ouvreurs        = isset($POST["ouvreurs"]) ? true : false;
			$this->cliqueurs       = isset($POST["cliqueurs"]) ? true : false;
			$this->action          = isset($POST["action"]) ? $POST["action"] : "";
			$this->mail_md5        = isset($POST["mail_md5"]) ? $POST["mail_md5"] : "";
			$this->download        = isset($POST["download"]) ? $POST["download"] : "";
			$this->categorie       = isset($POST["categorie"]) ? $POST["categorie"] : "";
			$this->thematiques     = isset($POST["thematiques"]) ? $POST["thematiques"] : "";
			$this->comp_partenaire = isset($POST["comp_partenaire"]) && $POST["comp_partenaire"] != "null" ? $POST["comp_partenaire"] : "";
			$this->comp_programme  = isset($POST["comp_programme"]) && $POST["comp_programme"] != "null" ? $POST["comp_programme"] : "";
			$this->matching        = isset($POST["matching"]) && $POST["matching"] != "null" ? $POST["matching"] : "";
			$this->inter_min       = isset($POST["inter-min"]) ? $POST["inter-min"] : "";
			$this->inter_max       = isset($POST["inter-max"]) ? $POST["inter-max"] : "";


			$this->filtre_existant   = TRUE;
			$this->filtre_invalide   = TRUE;
			$this->filtre_interdit   = TRUE;
			$this->filtre_doublon    = TRUE;
			$this->filtre_blacklist  = TRUE;
			$this->filtre_caracteres = TRUE;
			$this->filtre_nombres    = TRUE;

			switch ($this->action) {
				case 0: // INSERTION
					$this->insertBdd(0);
					break;

				case 1: // UPDATE
					$this->insertBdd(1);
					break;

				case 2: // COMPARAISON
					$this->insertBdd(2);
					break;

				case 3: // NETTOYAGE
					$this->filtre_existant   = FALSE;
					$this->filtre_invalide   = isset($POST["filtre_invalide"])   ? TRUE : FALSE;
					$this->filtre_interdit   = isset($POST["filtre_interdit"])   ? TRUE : FALSE;
					$this->filtre_doublon    = isset($POST["filtre_doublon"])    ? TRUE : FALSE;
					$this->filtre_blacklist  = isset($POST["filtre_blacklist"])  ? TRUE : FALSE;
					$this->filtre_caracteres = isset($POST["filtre_caracteres"]) ? TRUE : FALSE;
					$this->filtre_nombres    = isset($POST["filtre_nombres"])    ? TRUE : FALSE;

					$this->insertBdd(3);
					break;
			}

        }











        private function insertBdd($id) {

///////////////////////////////////////
/////////// CRÉATION DE TMP ///////////
///////////////////////////////////////
    		$tableChampsCreate = $tableChampsCopy = $tableChampsDelete = $tableChampsUsefull = array();

			for ($i=0; $i < $this->nb_champs; $i++) {
				if ($_POST["champ".$i] == "Null") {
					$name = "tmp".md5(rand());
					$tableChampsDelete[] = $name;
					$champ = $name;
				} else {
					$champ = $_POST["champ".$i];
					$tableChampsUsefull[] = strtolower($champ);
				}

				$tableChampsCreate[] = $champ." TEXT";
				$tableChampsCopy[]   = $champ;
			}

			// Création de tmp
			$this->tmp = "tmp_import_".md5(rand());

    		$requete = "CREATE TABLE IF NOT EXISTS $this->tmp (".implode(", ", $tableChampsCreate).");";
			$this->e($requete);


			//try {
				// Import dans tmp
				$requete = "COPY $this->tmp(".implode(",", $tableChampsCopy).") FROM '$this->min_path/$this->file_name' WITH DELIMITER '$this->separateur' $this->first_record ENCODING 'UTF8';";

				// Suppression des colonnes Null
				foreach ($tableChampsDelete as $value) $requete .= "ALTER TABLE $this->tmp DROP COLUMN $value;";

				$this->e($requete);

			/*} catch (Exception $e) {
				$last_path       = $this->file_name;
				$this->file_name = "uploads/".rand().".csv";
				$command         = "grep -hoE '[0-9a-zA-Z_-]+@[0-9a-zA-Z_.-]+\.[a-zA-Z]+' '$this->min_path/$last_path' > $this->min_path/$this->file_name";

				$output = shell_exec($command . "; wc -l");
				if($output == 0) {
					echo '<div class="lead center innerTB">
						<h2>Apologies...</h2>
						<p>Malgré tout nos efforts, ce fichier reste intraitable.</p>
					</div>';

					exit;
				}
			}*/


			// Insertion des emails valides du programme dans b2c_emails
			$filename = explode("/", $this->file_name);
			$filename = end($filename);

///////////////////////////////////////
////////////// INSERTION //////////////
///////////////////////////////////////
        	if($id == 0) {

				///////////////////////////////////////
				///////////////// B2B /////////////////
				///////////////////////////////////////
        		if(!$this->b2) {

				///////////////////////////////////////
				///////////////// B2C /////////////////
				///////////////////////////////////////
        		} else {

        			//echo $this->programme."<br />";
        			//print_r($this->thematiques)."<br />";

        			// Affichage du total du fichier
        			$requete = "SELECT COUNT(1) AS total FROM $this->tmp";
        			$total = $this->q($requete)->fetch(PDO::FETCH_NUM);
        			$this->printMsg("", $total[0], false, "", "Lignes dans le fichier.", true);

        			// Nettoyage du fichier & affichage des résultats
        			$tabNb = $this->cleanFile(true, true);

					$this->printMsg("-", $tabNb["nb_doublons"], true, "02.doublons.csv", "Doublons.");
					$this->printMsg("-", $tabNb["nb_correct"], true, "03.invalides.csv", "Invalides.");
					$this->printMsg("-", $tabNb["nb_caract"], true, "05.caracteres.csv", "Moins de $this->nbCaracts caractères.");
					$this->printMsg("-", $tabNb["nb_chiffres"], true, "06.nombres.csv", "Plus de $this->nbChiffres chiffres.");
					$this->printMsg("-", $tabNb["nb_keywords"], true, "07.keywords_exclus.csv", "Mots interdits.");
					$this->printMsg("-", $tabNb["nb_blacklist"], true, "08.blacklist.csv", "Blacklist.");

        			// Partenaire & Programme
        			$requete = "SELECT
        							gestion_partenaire.nom AS partenaire,
        							gestion_programme.nom AS programme,
        							gestion_partenaire.id AS partenaire_id,
        							gestion_programme.id AS programme_id
								FROM gestion_partenaire, gestion_programme
								WHERE gestion_programme.id = $this->programme
								AND gestion_partenaire.id = gestion_programme.partenaire";
					$result = $this->q($requete);
					$result->setFetchMode(PDO::FETCH_OBJ);
					while( $items = $result->fetch() ) {
						$partenaire    = $items->partenaire;
						$programme     = $items->programme;
						$partenaire_id = $items->partenaire_id;
						$programme_id  = $items->programme_id;
					}

					// Insertion des emails dans b2c_emails 
        			$requete = "INSERT INTO b2c_emails(email, fichier, programme, partenaire)
        						SELECT email, '$filename', $programme_id, $partenaire_id FROM $this->tmp";
        			$totalInsertB2Cemails = $this->e($requete);
        			$this->printMsg("+", $totalInsertB2Cemails, false, "", 'Insertions pour le programme "<strong>'.$programme.'</strong>" du partenaire "<strong>'.$partenaire.'</strong>".', true);

        			// Insertion des emails inexistants dans b2c 
        			// $requete = "INSERT INTO b2c(".implode(", ", $tableChampsUsefull).")
        			// 			SELECT ".implode(", ", $tableChampsUsefull)." FROM $this->tmp
        			// 			WHERE email NOT IN(SELECT email FROM b2c)";
        			// $totalInsertB2C = $this->e($requete);
        			// $this->printMsg("+", $totalInsertB2C, false, "", "Nouveaux contacts.", true);


					// Optimisation de la requete pour 
					// l'nsertion des emails inexistants dans b2c 
        			$requete = "INSERT INTO b2c(".implode(", ", $tableChampsUsefull).")
        						SELECT ".implode(", ", $tableChampsUsefull)." FROM $this->tmp
        						WHERE email NOT IN(SELECT email FROM b2c)";
        			$totalInsertB2C = $this->e($requete);
        			$this->printMsg("+", $totalInsertB2C, false, "", "Nouveaux contacts.", true);


					// Insertion des emails dans b2c_aff
					if(!empty($this->thematiques) && is_array($this->thematiques)) {
						foreach ($this->thematiques as $key => $id) {
							$requete = "INSERT INTO b2c_aff(email, thematique)
										SELECT email, $id FROM $this->tmp
										WHERE email NOT IN(SELECT email FROM b2c_aff WHERE thematique=$id)";
							$this->e($requete);
						}
					}
        		}

///////////////////////////////////////
//////////////// UPDATE ///////////////
///////////////////////////////////////
        	} elseif($id == 1) {

				///////////////////////////////////////
				///////////////// B2B /////////////////
				///////////////////////////////////////
        		if(!$this->b2) {

				///////////////////////////////////////
				///////////////// B2C /////////////////
				///////////////////////////////////////
        		} else {

        			// Update en tant que ouvreur
        			if($this->ouvreurs) {
						$requete = "UPDATE b2c
									SET last_date_o = CURRENT_TIMESTAMP
									WHERE email IN(SELECT email FROM $this->tmp)
									AND last_date_o IS NULL";
						$total = $this->e($requete);
						$this->printMsg("", $total, false, "", 'Date de dernière ouverture enrichies.');
        			}

        			// Update en tant que cliqueurs
        			if($this->cliqueurs) {
						$requete = "UPDATE b2c
									SET last_date_c = CURRENT_TIMESTAMP
									WHERE email IN(SELECT email FROM $this->tmp)
									AND last_date_c IS NULL";
						$total = $this->e($requete);
						$this->printMsg("", $total, false, "", 'Date de dernier clic enrichies.');
        			}

        			// Update de l'ensemble des champs renseignés
        			foreach ($tableChampsUsefull as $value) {
        				if($value != "email") {
	        				$requete = "UPDATE b2c
										SET $value = $this->tmp.$value
										FROM $this->tmp
										WHERE $this->tmp.email = b2c.email
										AND b2c.$value IS NULL";
		        			$total = $this->e($requete);
		        			$this->printMsg("", $total, false, "", $this->equal($value).' enrichies.');
        				}
        			}

        			// Update des affinités
					foreach ($this->thematiques as $key => $id) {
						$requete = "INSERT INTO b2c_aff(email, thematique)
									SELECT email, $id FROM $this->tmp
									WHERE email NOT IN(SELECT email FROM b2c_aff WHERE thematique=$id)";
						$this->e($requete);
					}

        		}

///////////////////////////////////////
///////////// COMPARAISON /////////////
///////////////////////////////////////
        	} elseif($id == 2) {

				///////////////////////////////////////
				///////////////// B2B /////////////////
				///////////////////////////////////////
        		if(!$this->b2) {

				///////////////////////////////////////
				///////////////// B2C /////////////////
				///////////////////////////////////////
        		} else {
/*
        			echo "download: ".$this->download.'<br /><br />';
        			echo "comp_partenaire: ".$this->comp_partenaire.'<br /><br />';
        			echo "comp_programme: ".$this->comp_programme.'<br /><br />';
        			echo "matching: ".$this->matching.'<br /><br />';
*/

					$tabNameAlea = $tabInsertBoucle = array();
					for ($i=1; $i <=5 ; $i++) {
						$tmp = md5(rand());
						$tabNameAlea[] = $tmp;

						$requete = "CREATE TABLE IF NOT EXISTS tmp_cmp_$tmp (email TEXT);";
						$this->e($requete);
					}

					$exclu = "blacklist IS NOT TRUE AND (statut != 'U' AND statut != 'HB')";
					$tabInsertBoucle[0] = "INSERT INTO tmp_cmp_$tabNameAlea[0] SELECT email FROM $this->tmp WHERE email IN (SELECT email FROM b2c WHERE $exclu);";
					$tabInsertBoucle[1] = "INSERT INTO tmp_cmp_$tabNameAlea[1] SELECT email FROM $this->tmp WHERE email IN (SELECT email FROM b2c WHERE $exclu AND last_date_o IS NOT NULL);";				
					$tabInsertBoucle[2] = "INSERT INTO tmp_cmp_$tabNameAlea[2] SELECT email FROM $this->tmp WHERE email IN (SELECT email FROM b2c WHERE $exclu AND last_date_c IS NOT NULL);";
					$tabInsertBoucle[3] = "INSERT INTO tmp_cmp_$tabNameAlea[3] SELECT email FROM $this->tmp WHERE email IN (SELECT email FROM b2c WHERE statut='HB');";

					if (!empty($this->comp_partenaire) && empty($this->comp_programme)) {
						for ($i=0; $i<4; $i++)
							$tabInsertBoucle[$i] .= "DELETE FROM tmp_cmp_$tabNameAlea[$i] WHERE email NOT IN(SELECT email FROM b2c_emails WHERE partenaire=$this->comp_partenaire);";
					} elseif (!empty($this->comp_programme)) {
						for ($i=0; $i<4; $i++)
							$tabInsertBoucle[$i] .= "DELETE FROM tmp_cmp_$tabNameAlea[$i] WHERE email NOT IN(SELECT email FROM b2c_emails WHERE programme=$this->comp_programme);";
					} else {
						for ($i=0; $i<4; $i++)
							$tabInsertBoucle[$i] .= "DELETE FROM tmp_cmp_$tabNameAlea[$i] WHERE email NOT IN(SELECT email FROM b2c_emails);";
					}

					foreach ($tabInsertBoucle as $req) $this->e($req);



					$result = array();

					$champs = "email, email_md5, firstname, lastname, dateofbirth, adresse_1, adresse_2, pays, cp, ville, region, gender, tel_mobile, tel_fixe, last_date_r, last_date_o, last_date_c, last_date_s, blacklist, statut";

					///////////////////////////////////////
					////////////// REQUETAGE //////////////
					///////////////////////////////////////
					$copy = "COPY (SELECT email FROM $this->tmp) TO '$this->save_path/1.all.csv' WITH DELIMITER ';' CSV HEADER;";
					$result["nbLine"] = $this->e($copy);


					$req_nbIn = $this->download == 1 
						? "COPY (SELECT email FROM tmp_cmp_$tabNameAlea[0]) TO '$this->save_path/2.commun.csv' WITH DELIMITER ';' CSV HEADER;"
						: "COPY (SELECT $champs FROM b2c WHERE email IN(SELECT email FROM tmp_cmp_$tabNameAlea[0])) TO '$this->save_path/2.commun.csv' WITH DELIMITER ';' CSV HEADER;";
					
					$req_nbO = $this->download == 1 
						? "COPY (SELECT email FROM tmp_cmp_$tabNameAlea[1]) TO '$this->save_path/3.open.csv' WITH DELIMITER ';' CSV HEADER;"
						: "COPY (SELECT $champs FROM b2c WHERE email IN(SELECT email FROM tmp_cmp_$tabNameAlea[1])) TO '$this->save_path/3.open.csv' WITH DELIMITER ';' CSV HEADER;";
					
					$req_nbC = $this->download == 1 
						? "COPY (SELECT email FROM tmp_cmp_$tabNameAlea[2]) TO '$this->save_path/4.clic.csv' WITH DELIMITER ';' CSV HEADER;"
						: "COPY (SELECT $champs FROM b2c WHERE email IN(SELECT email FROM tmp_cmp_$tabNameAlea[2])) TO '$this->save_path/4.clic.csv' WITH DELIMITER ';' CSV HEADER;";

					$req_nbHB = $this->download == 1 
						? "COPY (SELECT email FROM tmp_cmp_$tabNameAlea[3]) TO '$this->save_path/5.hb.csv' WITH DELIMITER ';' CSV HEADER;"
						: "COPY (SELECT $champs FROM b2c WHERE email IN(SELECT email FROM tmp_cmp_$tabNameAlea[3])) TO '$this->save_path/5.hb.csv' WITH DELIMITER ';' CSV HEADER;";

					$req_nbInBl = $this->download == 1 
						? "COPY (SELECT email FROM $this->tmp WHERE email IN (SELECT email FROM blacklist)) TO '$this->save_path/6.blacklist.csv' WITH DELIMITER ';' CSV HEADER;"
						: "COPY (SELECT email FROM $this->tmp WHERE email IN (SELECT email FROM blacklist)) TO '$this->save_path/6.blacklist.csv' WITH DELIMITER ';' CSV HEADER;";


					$result["nbIn"]   = $this->e($req_nbIn);
					$result["nbO"]    = $this->e($req_nbO);
					$result["nbC"]    = $this->e($req_nbC);
					$result["nbHB"]   = $this->e($req_nbHB);
					$result["nbInBl"] = $this->e($req_nbInBl);

					foreach ($tabNameAlea as $value) {
						$requete ="DROP TABLE IF EXISTS tmp_cmp_$value";
						$this->e($requete);
					}


					$this->printMsg("", $result["nbLine"], true, "1.all.csv", "Emails dans le fichier.");
					$this->printMsg("", $result["nbIn"], true, "2.commun.csv", "Communs.");
					$this->printMsg("", $result["nbO"], true, "3.open.csv", "Ouvreurs.");
					$this->printMsg("", $result["nbC"], true, "4.clic.csv", "Cliqueurs.");
					$this->printMsg("", $result["nbHB"], true, "5.hb.csv", "Hard-Bounces.");
					$this->printMsg("", $result["nbInBl"], true, "6.blacklist.csv", "Blacklist.");

        		}

///////////////////////////////////////
////////////// NETTOYAGE //////////////
///////////////////////////////////////
        	} elseif($id == 3) {

				///////////////////////////////////////
				///////////////// B2B /////////////////
				///////////////////////////////////////
        		if(!$this->b2) {

				///////////////////////////////////////
				///////////////// B2C /////////////////
				///////////////////////////////////////
        		} else {

        			// Affichage du total du fichier
        			$requete = "SELECT COUNT(1) AS total FROM $this->tmp";
        			$total = $this->q($requete)->fetch(PDO::FETCH_NUM);
        			$this->printMsg("", $total[0], false, "", "Lignes dans le fichier.", true);

        			// Nettoyage du fichier & affichage des résultats
        			$tabNb = $this->cleanFile(true, true);

					if($this->filtre_doublon) $this->printMsg("-", $tabNb["nb_doublons"], true, "02.doublons.csv", "Doublons.");
					if($this->filtre_invalide) $this->printMsg("-", $tabNb["nb_correct"], true, "03.invalides.csv", "Invalides.");
					if($this->filtre_caracteres) $this->printMsg("-", $tabNb["nb_caract"], true, "05.caracteres.csv", "Moins de $this->nbCaracts caractères.");
					if($this->filtre_nombres) $this->printMsg("-", $tabNb["nb_chiffres"], true, "06.nombres.csv", "Plus de $this->nbChiffres chiffres.");
					if($this->filtre_interdit) $this->printMsg("-", $tabNb["nb_keywords"], true, "07.keywords_exclus.csv", "Mots interdits.");
					if($this->filtre_blacklist) $this->printMsg("-", $tabNb["nb_blacklist"], true, "08.blacklist.csv", "Blacklist.");

					// Suppression de l'interval min & max
					$requete = "ALTER TABLE $this->tmp ADD COLUMN domain TEXT;
								UPDATE $this->tmp SET domain = split_part(email, '@', 2);";
					$total = $this->e($requete);

					if(!empty($this->inter_min) && !empty($this->inter_max)) { // min & max renseignés

						$requete = "DELETE FROM $this->tmp WHERE domain IN (
										SELECT domain
										FROM $this->tmp
										GROUP BY domain
										HAVING (COUNT(domain) > $this->inter_min AND COUNT(domain) < $this->inter_max)
									)";
						$total = $this->e($requete);
						$this->printMsg("-", $total, false, "", "Adresses supprimés (Domaines compris entre <strong>$this->inter_min</strong> et <strong>$this->inter_max</strong> occurences).");

					} elseif(!empty($this->inter_min) && empty($this->inter_max)) { // min renseignés, max non renseignés

						$requete = "DELETE FROM $this->tmp WHERE domain IN (
										SELECT domain
										FROM $this->tmp
										GROUP BY domain
										HAVING (COUNT(domain) > $this->inter_min)
									)";
						$total = $this->e($requete);
						$this->printMsg("-", $total, false, "", "Adresses supprimés (Domaines supérieur à <strong>$this->inter_min</strong> occurences).");

					} elseif(empty($this->inter_min) && !empty($this->inter_max)) { // max renseignés, min non renseignés

						$requete = "DELETE FROM $this->tmp WHERE domain IN (
										SELECT domain
										FROM $this->tmp
										GROUP BY domain
										HAVING (COUNT(domain) < $this->inter_max)
									)";
						$total = $this->e($requete);
						$this->printMsg("-", $total, false, "", "Adresses supprimés (Domaines inférieur à <strong>$this->inter_max</strong> occurences).");

					}

					// Récupération du fichier nettoyé avec l'ensemble des champs
					$requete = "COPY (
									SELECT ".implode(", ", $tableChampsUsefull)." FROM $this->tmp
								)
								TO '$this->save_path/$filename'
								WITH DELIMITER ';'
								CSV HEADER;";
					$total = $this->e($requete);
					$this->printMsg("", $total, true, $filename, "Contacts restant.", true);

        		}

        	}

			// Suppression des tables temporaires
			$requete ="DROP TABLE IF EXISTS $this->tmp"; $this->e($requete);
        }












        // FALSE: pas de delete | TRUE: delete
        private function cleanFile($isDelete, $isCopy) {
			$result = array();

			///////////////////////////////////////
			////////////// NETTOYAGE //////////////
			///////////////////////////////////////
			$this->order_by = $this->order_by == 0 ? "" : " ORDER BY email ASC";

			if($this->download == 0) { // Email

				// Doublons dans le fichier
				if($this->filtre_doublon) {
					$requete = "ALTER TABLE $this->tmp ADD COLUMN id SERIAL";
					$this->e($requete);

					$copy = $isCopy ?
						"COPY (SELECT email, COUNT(email) FROM $this->tmp GROUP BY email HAVING COUNT(*) > 1 ORDER BY COUNT(email) DESC, email ASC) TO '$this->save_path/02.doublons.csv' WITH DELIMITER ';' CSV HEADER;" : "";

					$delete = $isDelete ?
						"DELETE FROM $this->tmp USING $this->tmp tmp2 WHERE $this->tmp.email = tmp2.email AND $this->tmp.id < tmp2.id;" : "";

					$result["nb_doublons"] = $this->e($copy.$delete);
				}

				// Validité de l'email
				if($this->filtre_invalide) {
					$copy = $isCopy ?
						"COPY (SELECT email FROM $this->tmp WHERE email !~ '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][A-Za-z]+$' $this->order_by) TO '$this->save_path/03.invalides.csv' WITH DELIMITER ';' CSV HEADER;" : "";

					$delete = $isDelete ?
						"DELETE FROM $this->tmp WHERE email !~ '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][A-Za-z]+$';" : "";

					$result["nb_correct"] = $this->e($copy.$delete);
				}

				// Mails de moins de 3 caractères
				if($this->filtre_caracteres) {
					$copy = $isCopy ?
						"COPY (SELECT email FROM $this->tmp WHERE length(split_part(email, '@', 1)) < $this->nbCaracts $this->order_by) TO '$this->save_path/05.caracteres.csv' WITH DELIMITER ';' CSV HEADER;" : "";

					$delete = $isDelete ?
						"DELETE FROM $this->tmp WHERE length(split_part(email, '@', 1)) < $this->nbCaracts;" : "";

					$result["nb_caract"] = $this->e($copy.$delete);
				}

				// Suite de plus de 4 nombres
				if($this->filtre_nombres) {
					$copy = $isCopy ?
						"COPY (SELECT email FROM $this->tmp WHERE email ~ "."'[0-9]{".$this->nbChiffres.",}' $this->order_by) TO '$this->save_path/06.nombres.csv' WITH DELIMITER ';' CSV HEADER;" : "";

					$delete = $isDelete ?
						"DELETE FROM $this->tmp WHERE email ~ "."'[0-9]{".$this->nbChiffres.",}';" : "";

					$result["nb_chiffres"] = $this->e($copy.$delete);
				}

				// Keywords blacklist
				if($this->filtre_interdit) {
					foreach ($this->tab_keys as $key => $value) { $this->tab_keys[$key] = trim($value); }
					$copy = $isCopy ?
						"COPY (SELECT email FROM $this->tmp WHERE email LIKE '%".implode("%' OR email LIKE '%", $this->tab_keys)."%' $this->order_by) TO '$this->save_path/07.keywords_exclus.csv' WITH DELIMITER ';' CSV HEADER;" : "";

					$delete = $isDelete ?
						"DELETE FROM $this->tmp WHERE email LIKE '%".implode("%' OR email LIKE '%", $this->tab_keys)."%';" : "";

					$result["nb_keywords"] = $this->e($copy.$delete);
				}

				// Compare la blacklist
				if($this->filtre_blacklist) {
					$copy = $isCopy ?
						"COPY (SELECT $this->tmp.email FROM $this->tmp, blacklist WHERE $this->tmp.email=blacklist.email $this->order_by) TO '$this->save_path/08.blacklist.csv' WITH DELIMITER ';' CSV HEADER;" : "";

					$delete = $isDelete ?
						"DELETE FROM $this->tmp USING blacklist WHERE $this->tmp.email=blacklist.email;" : "";

					$result["nb_blacklist"] = $this->e($copy.$delete);
				}
			}

			return $result;
        }













        private function equal($param) {
        	switch ($param) {
				case 'firstname': return "Prénom";
				case 'lastname': return "Nom";
				case 'dateofbirth': return "Date de naissance";
				case 'yearofbirth': return "Année de naissance";
				case 'agegroupe': return "Groupe d'âge";
				case 'adresse_1': return "Adresse";
				case 'adresse_2': return "Complément d'adresse";
				case 'pays': return "Pays";
				case 'cp': return "Code postale";
				case 'ville': return "Ville";
				case 'region': return "Région";
				case 'gender': return "Civilité";
				case 'title': return "Titre";
				case 'fonction': return "Métier";
				case 'csp': return "CSP";
				case 'parent': return "Parent";
				case 'proprietaire': return "Propriétaire";
				case 'animaux': return "Animaux";
				case 'tel_mobile': return "Téléphone mobile";
				case 'tel_fixe': return "Téléphone fixe";
				case 'tel_fax': return "Fax";
				case 'date_in': return "Date d'inscription";
				case 'last_date_r': return "Date de dernier reçus";
				case 'last_date_o': return "Date de dernière ouverture";
				case 'last_date_c': return "Date de dernier clic";
				case 'last_date_s': return "Date de dernier envoi";
        	}
        }









        // résultat, download, fichier, message
        private function printMsg($plusMoins, $result, $dl, $file, $msg, $force=false) {

			if($result > 0) {
				$etat = "primary";
				$down = $dl ? '<a href="'.$this->down_path.'/'.$file.'" target="_blank" class="download"><i class="fa fa-download"></i> Télécharger</a>' : "";
			} else {
				$etat = "success";
				$down = "";
				$plusMoins = "";
			}

			if($force) $etat = "blue";

			echo '<div class="alert alert-'.$etat.' alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<p><span class="affected_rows2">'.$plusMoins.' '.number_format($result, 0, "", " ").'</span>'.$msg.' '.$down.'</p>
			</div>';
        }






        public function e($requete) {
        	$timestart=microtime(true);

        	$total = $this->db->exec($requete);

        	$timeend=microtime(true);
			$time=$timeend-$timestart;
			$page_load_time = number_format($time, 3);

        	$this->reqDB .= '(<span class="red">'.$page_load_time.'</span>) '.$requete."\n";

        	return $total;
        }






        public function q($requete) {
        	$timestart=microtime(true);

        	$total = $this->db->query($requete);

        	$timeend=microtime(true);
			$time=$timeend-$timestart;
			$page_load_time = number_format($time, 3);

        	$this->reqDB .= '(<span class="red">'.$page_load_time.'</span>) '.$requete."\n";

        	return $total;
        }






		public function __destruct() {
			echo '<div class="panel-group accordion" id="accordion">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse-1">Voir les logs</a></h4>
					    </div>
					    <div id="collapse-1" class="panel-collapse collapse">
					      	<div class="panel-body"><pre><code class="language-sql">'.$this->reqDB.'</code></pre></div>
					    </div>
				  	</div>  	
				</div>';
		}
	}
?>