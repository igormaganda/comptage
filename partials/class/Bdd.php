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

					$this->PARAM_hote        ='156.67.25.120';
					$this->PARAM_port        ='5432';
					$this->PARAM_nom_bd      ='datamart3';
					$this->PARAM_utilisateur ='postgres';
					$this->PARAM_mot_passe   ='P057G435';

					break;
					
				
				case 1: // Prod
					$this->PARAM_hote        ='156.67.25.120';
					$this->PARAM_port        ='5432';
					$this->PARAM_nom_bd      ='datamart3';
					$this->PARAM_utilisateur ='postgres';
					$this->PARAM_mot_passe   ='P057G435';
					break;

				case 10: // BERTRAND
					$this->PARAM_hote        ='156.67.25.120';
					$this->PARAM_port        ='5432';
					$this->PARAM_nom_bd      ='datamart3';
					$this->PARAM_utilisateur ='postgres';
					$this->PARAM_mot_passe   ='P057G435';
					break;

				case 100: // ADN
					$this->PARAM_hote        ='156.67.25.120';
					$this->PARAM_port        ='5432';
					$this->PARAM_nom_bd      ='datamart3';
					$this->PARAM_utilisateur ='postgres';
					$this->PARAM_mot_passe   ='P057G435';
					break;

				case 2: // Préprod
					$this->PARAM_hote        ='156.67.25.120';
					$this->PARAM_port        ='5432';
					$this->PARAM_nom_bd      ='datamart3';
					$this->PARAM_utilisateur ='postgres';
					$this->PARAM_mot_passe   ='P057G435';
					break;

				case 3: // Test
					$this->PARAM_hote        ='156.67.25.120';
					$this->PARAM_port        ='5432';
					$this->PARAM_nom_bd      ='datamart3';
					$this->PARAM_utilisateur ='postgres';
					$this->PARAM_mot_passe   ='P057G435';
					break;

				case 4: // Nettoyage
					$this->PARAM_hote        ='156.67.25.120';
					$this->PARAM_port        ='5432';
					$this->PARAM_nom_bd      ='datamart3';
					$this->PARAM_utilisateur ='postgres';
					$this->PARAM_mot_passe   ='P057G435';
					break;   
			}

			$db = new PDO(
				'pgsql:host='	.$this->PARAM_hote
				.';port='		.$this->PARAM_port
				.';dbname='		.$this->PARAM_nom_bd
				.';user='		.$this->PARAM_utilisateur
				.';password='	.$this->PARAM_mot_passe
			);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $this->db = $db;
		}


		public function connect() {
			$db = new PDO(
				'pgsql:host='	.$this->PARAM_hote
				.';port='		.$this->PARAM_port
				.';dbname='		.$this->PARAM_nom_bd
				.';user='		.$this->PARAM_utilisateur
				.';password='	.$this->PARAM_mot_passe
			);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $db;
		}


		public function executeQueryRequete($requete, $status) {
			// 0 -> Retourne true si introuvable, false sinon
			// 1 -> Retourne le résultat de la requête (Object)
			// 2 -> Retourne le résultat de la requête (Number)
			try {
				$req = $this->db->query($requete);

				if($status == 0) {
					$row = $req->fetch(PDO::FETCH_NUM);
					return $row[0] > 0 ? false : true;
				} elseif($status == 2) {
					$row = $req->fetch(PDO::FETCH_NUM);
					return $row[0];
				} else {
					$req->setFetchMode(PDO::FETCH_OBJ);
					return $req;
				}
			} catch(PDOException $e) {
			    echo $e->getMessage() . '<br /><br />';
			    echo ' into: '.$requete;

			    return false;
			}
		}


		public function executeSimpleExecRequete($requete) {
			try {
				$this->db->exec($requete);

				return true;
			} catch(PDOException $e) {
			    echo $e->getMessage() . '<br /><br />';
			    echo ' into: '.$requete;
			    return false;
			}
		}


		public function executeSimpleExecRequeteWithReturnVolume($requete) {
			try {
				$volume = $this->db->exec($requete);

				return $volume;
			} catch(PDOException $e) {
			    echo $e->getMessage() . '<br /><br />';
			    echo ' into: '.$requete;
			    return false;
			}
		}


		public function executeSimpleExecRequeteWithReturnValue($requete) {
			try {
				$req = $this->db->query($requete);

				$row = $req->fetch(PDO::FETCH_NUM);

				return $row[0];
			} catch(PDOException $e) {
			    echo $e->getMessage() . '<br /><br />';
			    echo ' into: '.$requete;
			    return false;
			}
		}

		//Fonction de hashage ou cryptage de donnée
		public function hashEmail ($algo, $variable) {
			$hashValue = "";

			$hashValue = hash($algo, $variable);

			return $hashValue;

		}


		public function createTables() {
			try {
				$sql ="CREATE TABLE IF NOT EXISTS info (
					id SERIAL PRIMARY KEY,
					Chiffres SMALLINT,
					Lettres SMALLINT,
					Keywords_spam TEXT,
					Top_domain TEXT,
					Nb_adresses SMALLINT,
					Troncons SMALLINT,
					Hommes TEXT,
					Femmes TEXT,
					Team TEXT
				);
				CREATE TABLE IF NOT EXISTS top_domain (
					id BIGSERIAL PRIMARY KEY,
					Domain TEXT,
					Percent TEXT
				);
				CREATE TABLE IF NOT EXISTS import (
					id BIGSERIAL PRIMARY KEY,
					Name TEXT,
					File TEXT,
					Separateur VARCHAR(1),
					B2 BOOLEAN,
					Data BOOLEAN,
					Date TIMESTAMP default NULL,
					Programme INT
				);
				CREATE TABLE IF NOT EXISTS b2c (
					id BIGSERIAL PRIMARY KEY,
					id_Import INT default NULL,
					Email VARCHAR(255) NOT NULL,
					Email_MD5 VARCHAR(32),
					Domain VARCHAR(255),
					Groupe_Domaine VARCHAR(255),
					FirstName VARCHAR(255),
					LastName VARCHAR(255),
					DateOfBirth DATE,
					YearOfBirth VARCHAR(10),
					AgeGroupe VARCHAR(255),
					Adresse_1 VARCHAR(255),
					Adresse_2 VARCHAR(255),
					Pays VARCHAR(255),
					Region VARCHAR(255),
					CP VARCHAR(255),
					Ville VARCHAR(255),
					Gender VARCHAR(255),
					Title VARCHAR(255),
					Fonction VARCHAR(255),
					CSP VARCHAR(255),
					Parent VARCHAR(255),
					Proprietaire VARCHAR(255),
					Animaux VARCHAR(255),
					Tel_mobile VARCHAR(255),
					Tel_fixe VARCHAR(255),
					Tel_fax VARCHAR(255),
					Date_In TIMESTAMP default NULL,
					Last_Date_R TIMESTAMP default NULL,
					Last_Date_O TIMESTAMP default NULL,
					Last_Date_C TIMESTAMP default NULL,
					Last_Date_S TIMESTAMP default NULL,
					Troncon SMALLINT,
					Pression VARCHAR(255),
					Activity VARCHAR(255),
					R VARCHAR(255),
					Blacklist BOOLEAN default NULL,
					Statut VARCHAR(2),
					Unsub VARCHAR(32)
				);
				CREATE TABLE IF NOT EXISTS b2c_emails (
					id BIGSERIAL PRIMARY KEY,
					email TEXT NOT NULL,
					fichier TEXT,
					programme INTEGER,
					partenaire INTEGER
				);
				CREATE TABLE IF NOT EXISTS b2c_aff (
					id BIGSERIAL PRIMARY KEY,
					email TEXT NOT NULL,
					thematique INTEGER
				);
				CREATE TABLE IF NOT EXISTS b2b_old (
					id BIGSERIAL PRIMARY KEY,
					societe VARCHAR default NULL,
					adresse	VARCHAR default NULL,
					cp VARCHAR default NULL,
					ville VARCHAR default NULL,
					tel VARCHAR default NULL,
					mobile VARCHAR default NULL,
					fax VARCHAR default NULL,
					url VARCHAR default NULL,
					cat VARCHAR default NULL,
					siren VARCHAR default NULL,
					naf VARCHAR default NULL,
					creation VARCHAR default NULL,
					forme VARCHAR default NULL,
					capital VARCHAR default NULL,
					ca VARCHAR default NULL,
					ets VARCHAR default NULL,
					resultat VARCHAR default NULL,
					effectif VARCHAR default NULL,
					civilite VARCHAR default NULL,
					prenom VARCHAR default NULL,
					nom VARCHAR default NULL,
					metier VARCHAR default NULL,
					email VARCHAR default NULL,
					dirigeant VARCHAR default NULL,
					dirigeant_bool BOOLEAN default NULL
				);
				
				CREATE TABLE IF NOT EXISTS b2b (
					id BIGSERIAL PRIMARY KEY,
					fullname VARCHAR default NULL,
					firstname VARCHAR default NULL,
					lastname VARCHAR default NULL,
					civilite VARCHAR default NULL,
					profileregion VARCHAR default NULL,
					locationcompany VARCHAR default NULL,
					currentposition VARCHAR default NULL,
					numberTVA VARCHAR default NULL,
					companyname VARCHAR default NULL,
					size VARCHAR default NULL,
					effectif VARCHAR default NULL,
					domain VARCHAR default NULL,
					website VARCHAR default NULL,
					pays VARCHAR default NULL,
					type VARCHAR default NULL,
					ville VARCHAR default NULL,
					siege VARCHAR default NULL,
					creation VARCHAR default NULL,
					phonecompany VARCHAR default NULL,
					audience VARCHAR default NULL,
					linkeldin VARCHAR default NULL,
					emailpersonel VARCHAR default NULL,
					emailpersonel_md5 VARCHAR default NULL,
					emailpersonel_sha256 VARCHAR default NULL,
					emailpro VARCHAR default NULL,
					emailpro_md5 VARCHAR default NULL,
					emailpro_sha256 VARCHAR default NULL,
					bounce VARCHAR default NULL,
					telcompany VARCHAR default NULL,
					telpersonel VARCHAR default NULL,
					mobilecompany VARCHAR default NULL,
					mobilecompany_md5 VARCHAR default NULL,
					mobilecompany_sha256 VARCHAR default NULL,
					mobilepro VARCHAR default NULL,
					mobilepro_md5 VARCHAR default NULL,
					mobilepro_sha256 VARCHAR default NULL,
					fixecompany VARCHAR default NULL,
					fixepersonel VARCHAR default NULL,
					sirene VARCHAR default NULL,
					naf VARCHAR default NULL,
					adresse VARCHAR default NULL,
					cp VARCHAR default NULL,
					fax VARCHAR default NULL,
					cat VARCHAR default NULL,
					forme VARCHAR default NULL,
					capital VARCHAR default NULL,
					ca VARCHAR default NULL,
					activite VARCHAR default NULL
				);
				
				CREATE TABLE IF NOT EXISTS b2b_activite (
					id SERIAL PRIMARY KEY,
					code VARCHAR NOT NULL,
					libelle VARCHAR NOT NULL,
				);
				
				CREATE TABLE IF NOT EXISTS home1 (
					id SERIAL PRIMARY KEY,
					Email INT,
					Blacklist INT,
					Domaines INT,
					Hommes INT,
					Dames INT,
					Demoiselles INT,
					BtoC INT,
					BtoB INT,
					SB INT,
					HB INT,
					ST INT,
					Unsub INT,
					Fullbase INT
				);
				CREATE TABLE IF NOT EXISTS home2 (
					id SERIAL PRIMARY KEY,
					domain VARCHAR(255),
					total INT
				);
				CREATE TABLE IF NOT EXISTS home3 (
					id SERIAL PRIMARY KEY,
					Email INT,
					FirstName INT,
					LastName INT,
					Date_In INT,
					Tel_mobile INT,
					Tel_fixe INT,
					DateOfBirth INT,
					Adresse_1 INT,
					Pays INT,
					CP INT,
					Ville INT,
					Last_Date_R INT,
					Last_Date_O INT,
					Last_Date_C INT
				);
				CREATE TABLE IF NOT EXISTS home4 (
					id SERIAL PRIMARY KEY,
					envoye_jour INT,
					envoye_semaine INT,
					envoye_mois INT,
					ouvreur_jour INT,
					ouvreur_semaine INT,
					ouvreur_mois INT,
					clic_jour INT,
					clic_semaine INT,
					clic_mois INT,
					ouvreur INT,
					ouvreur_hommes INT,
					ouvreur_femmes INT,
					clic INT,
					clic_hommes INT,
					clic_femmes INT
				);
				CREATE TABLE IF NOT EXISTS blacklist (
					id BIGSERIAL PRIMARY KEY,
					id_Import INT NOT NULL,
					Email VARCHAR(255) NOT NULL
				);
				CREATE TABLE IF NOT EXISTS age (
					id SERIAL PRIMARY KEY,
					Tranche VARCHAR(255) NOT NULL
				);
				CREATE TABLE IF NOT EXISTS counter (
					id SERIAL PRIMARY KEY,
					Request TEXT NOT NULL,
					Campagne TEXT NOT NULL,
					Result INT NOT NULL,
					Name VARCHAR(255) NOT NULL,
					Date TIMESTAMP default NULL
				);
				CREATE TABLE IF NOT EXISTS planning (
					id SERIAL PRIMARY KEY,
					Programme VARCHAR(255),
					Client VARCHAR(255),
					Campagne VARCHAR(255),
					Annonceur VARCHAR(255),
					Operation VARCHAR(255),
					Prix INT,
					Start TIMESTAMP default NULL,
					End TIMESTAMP default NULL
				);
				CREATE TABLE IF NOT EXISTS campagne_tmp (
					id SERIAL PRIMARY KEY,
					B2 BOOLEAN NOT NULL,
					Type_Base TEXT,
					Repasse TEXT,
					Programme TEXT,
					Client TEXT,
					Campagne TEXT,
					Annonceur TEXT,
					Sujet TEXT,
					Expediteur TEXT,
					PJ TEXT,
					Txt TEXT,
					Content TEXT,
					Exist BOOLEAN default FALSE
				);
				CREATE TABLE IF NOT EXISTS campagne (
					id SERIAL PRIMARY KEY,
					B2 BOOLEAN NOT NULL,
					Type_Base TEXT,
					Repasse TEXT,
					Programme TEXT,
					Client TEXT,
					Campagne TEXT,
					Annonceur TEXT,
					Sujet TEXT,
					Expediteur TEXT,
					Adresse TEXT,
					Domaine TEXT,
					PJ TEXT,
					Txt TEXT,
					Content TEXT,
					Miroir BOOLEAN,
					Desabo BOOLEAN,
					Route VARCHAR(255),
					Operation VARCHAR(255),
					Prix INT,
					Objectif INT,
					Comptage INT,
					Volume INT,
					Dpf INT,
					Thematiques TEXT,
					BAT TEXT,
					Status TEXT,
					Reference TEXT,
					Envoi TIMESTAMP default NULL,
					Date TIMESTAMP default NULL
				);
				CREATE TABLE IF NOT EXISTS campagne_send (
					id SERIAL PRIMARY KEY,
					Id_Campagne INT,
					Cible TEXT
				);
				CREATE TABLE IF NOT EXISTS campagne_demon (
					id SERIAL PRIMARY KEY,
					Date TIMESTAMP default NULL,
					Message VARCHAR
				);
				CREATE TABLE IF NOT EXISTS campagne_stats (
					id SERIAL PRIMARY KEY,
					campaign_ref VARCHAR,
					campaign_nodeno VARCHAR,
					campaign_mailno VARCHAR,
					campaign_text VARCHAR,
					campaign_company VARCHAR,
					campaign_account VARCHAR,
					campaign_user VARCHAR,
					campaign_type VARCHAR,
					campaign_split VARCHAR,
					campaign_comment VARCHAR,
					campaign_start VARCHAR,
					campaign_stop VARCHAR,
					campaign_ippool VARCHAR,
					campaign_retry VARCHAR,
					campaign_status VARCHAR,
					campaign_version VARCHAR,
					campaign_xlsx VARCHAR,
					campaign_view VARCHAR,
					campaign_shot VARCHAR,
					message_fromname VARCHAR,
					message_fromaddr VARCHAR,
					message_sendername VARCHAR,
					message_senderaddr VARCHAR,
					message_replytoname VARCHAR,
					message_replytoaddr VARCHAR,
					message_subject VARCHAR,
					message_charset VARCHAR,
					message_textbody VARCHAR,
					message_htmlbody VARCHAR,
					message_view VARCHAR,
					message_attachments VARCHAR,
					message_embedded VARCHAR,
					list_path VARCHAR,
					list_addr VARCHAR,
					list_count VARCHAR,
					list_counts VARCHAR,
					list_inv VARCHAR,
					list_dup VARCHAR,
					list_hard VARCHAR,
					list_soft VARCHAR,
					list_unsub VARCHAR,
					list_recnb VARCHAR,
					perf_text VARCHAR,
					perf_nb VARCHAR,
					perf_hd VARCHAR,
					perf_sf VARCHAR,
					perf_df VARCHAR,
					perf_ok VARCHAR,
					perf_op VARCHAR,
					perf_up VARCHAR,
					perf_cu VARCHAR,
					perf_ck VARCHAR,
					perf_vw VARCHAR,
					perf_un VARCHAR,
					perf_fb VARCHAR,
					perf_rp VARCHAR,
					perf_tn VARCHAR
				);
				CREATE TABLE IF NOT EXISTS gestion_thematique (
					id SERIAL PRIMARY KEY,
					Nom VARCHAR(255) NOT NULL,
					Alias VARCHAR(255) NOT NULL
				);
				CREATE TABLE IF NOT EXISTS gestion_partenaire (
					id SERIAL PRIMARY KEY,
					Nom VARCHAR(255) NOT NULL,
					Alias VARCHAR(255) NOT NULL
				);
				CREATE TABLE IF NOT EXISTS gestion_programme (
					id SERIAL PRIMARY KEY,
					Nom VARCHAR(255) NOT NULL,
					Alias VARCHAR(255) NOT NULL,
					Partenaire INT,
				);
				CREATE TABLE IF NOT EXISTS gestion_domaine (
					id SERIAL PRIMARY KEY,
					Nom VARCHAR(255) NOT NULL,
					Alias VARCHAR(255) NOT NULL
				);
				CREATE TABLE IF NOT EXISTS gestion_routes (
					id SERIAL PRIMARY KEY,
					Ip VARCHAR(255) NOT NULL,
					Alias VARCHAR(255) NOT NULL,
					Username VARCHAR(255),
					Password VARCHAR(255),
					Port VARCHAR(255),
					Ndd TEXT,
					Tls BOOLEAN,
					Domaine SMALLINT,
					Timer SMALLINT
				);
				CREATE TABLE IF NOT EXISTS gestion_limittdpf (
					id SERIAL PRIMARY KEY,
					Limite BIGINT NOT NULL
				);
				CREATE TABLE IF NOT EXISTS route (
					id SERIAL PRIMARY KEY,
					IP_header_html TEXT,
					IP_footer_html TEXT,
					IP_header_txt TEXT,
					IP_footer_txt TEXT,
					Xmailer_login VARCHAR(255),
					Xmailer_password VARCHAR(255),
					Xmailer_server VARCHAR(255),
					Xmailer_header_html TEXT,
					Xmailer_footer_html TEXT,
					Xmailer_header_txt TEXT,
					Xmailer_footer_txt TEXT,
					Mailgun_key VARCHAR(255),
					Mailgun_domain VARCHAR(255),
					Mailgun_header_html TEXT,
					Mailgun_footer_html TEXT,
					Mailgun_header_txt TEXT,
					Mailgun_footer_txt TEXT,
					Sendinblue_server VARCHAR(255),
					Sendinblue_port VARCHAR(255),
					Sendinblue_login VARCHAR(255),
					Sendinblue_password VARCHAR(255),
					Sendinblue_header_html TEXT,
					Sendinblue_footer_html TEXT,
					Sendinblue_header_txt TEXT,
					Sendinblue_footer_txt TEXT,
					Ediware_login VARCHAR(255),
					Ediware_password VARCHAR(255),
					Ediware_header_html TEXT,
					Ediware_footer_html TEXT,
					Ediware_header_txt TEXT,
					Ediware_footer_txt TEXT
				);
				CREATE TABLE IF NOT EXISTS stats_ok (
					id SERIAL PRIMARY KEY,
					Date DATE default NULL,
					Reference TEXT,
					Utilisateur VARCHAR(4),
					Email VARCHAR(255) NOT NULL,
					Member VARCHAR(1),
					Xid VARCHAR(1)
				);
				CREATE TABLE IF NOT EXISTS stats_open (
					id SERIAL PRIMARY KEY,
					Date DATE default NULL,
					Reference TEXT,
					Email VARCHAR(255) NOT NULL,
					IP VARCHAR(255)
				);
				CREATE TABLE IF NOT EXISTS stats_click (
					id SERIAL PRIMARY KEY,
					Date DATE default NULL,
					Reference TEXT,
					Email VARCHAR(255) NOT NULL,
					IP VARCHAR(255)
				);
				CREATE TABLE IF NOT EXISTS stats_unsub (
					id SERIAL PRIMARY KEY,
					Date DATE default NULL,
					Reference TEXT,
					Email VARCHAR(255) NOT NULL,
					IP VARCHAR(255)
				);
				CREATE TABLE IF NOT EXISTS stats_fbl (
					id SERIAL PRIMARY KEY,
					Date DATE default NULL,
					Reference TEXT,
					Email VARCHAR(255) NOT NULL
				);
				CREATE TABLE IF NOT EXISTS stats_hard (
					id SERIAL PRIMARY KEY,
					Date DATE default NULL,
					Reference TEXT,
					Email VARCHAR(255) NOT NULL
				);
				CREATE TABLE IF NOT EXISTS stats_soft (
					id SERIAL PRIMARY KEY,
					Date DATE default NULL,
					Reference TEXT,
					Email VARCHAR(255) NOT NULL
				);
				CREATE TABLE IF NOT EXISTS split_mails (
					id SERIAL PRIMARY KEY,
					Mail VARCHAR(255)
				);
				CREATE TABLE IF NOT EXISTS split_adresses (
					id SERIAL PRIMARY KEY,
					Adresse VARCHAR(255),
					Domaine VARCHAR(255)
				);
				CREATE TABLE IF NOT EXISTS split_domaines (
					id SERIAL PRIMARY KEY,
					Nom VARCHAR(255),
					Nb BIGINT
				);
				CREATE TABLE IF NOT EXISTS send_daemon (
					id SERIAL PRIMARY KEY,
					id_campagne INT,
					Date TIMESTAMP default NULL,
					Reference VARCHAR(255),
					Route VARCHAR(255),
					Cible TEXT,
					Go INTEGER default 0
				);
				CREATE TABLE IF NOT EXISTS send_envoi (
					id SERIAL PRIMARY KEY,
					id_campagne INT,
					id_campagne_send INT,
					Mail VARCHAR(255),
					Key VARCHAR(32),
					Annonceur VARCHAR(255),
					Reference VARCHAR(255),
					Route VARCHAR(2),
					Date TIMESTAMP default NULL,
					Send BOOLEAN,
					Error VARCHAR(255)
				);
				CREATE TABLE IF NOT EXISTS send_ediware (
					id SERIAL PRIMARY KEY,
					Date TIMESTAMP default NULL,
					status TEXT,
					id_campagne INT,
					to_send INT,
					nb_destinataires_detectes VARCHAR(10),
					nb_desinscrits VARCHAR(10),
					nb_spamtrap VARCHAR(10),
					nb_errones VARCHAR(10),
					nb_npai VARCHAR(10),
					nb_doublons VARCHAR(10),
					total_destinataires_updated VARCHAR(10),
					status INT
				);
				CREATE TABLE IF NOT EXISTS send_sendinblue (
					id SERIAL PRIMARY KEY,
					Date TIMESTAMP default NULL,
					id_campagne INT,
					to_send INT,
					code VARCHAR,
					message VARCHAR,
					data VARCHAR
				);
				CREATE TABLE IF NOT EXISTS send_sendinblue_webhook (
					id BIGSERIAL PRIMARY KEY,
					event VARCHAR default NULL,
					email VARCHAR default NULL,
					sb_id VARCHAR default NULL,
					date TIMESTAMP default NULL,
					message_id VARCHAR default NULL,
					tag VARCHAR default NULL,
					X_Mailin_custom VARCHAR default NULL,
					reason VARCHAR default NULL,
					link VARCHAR default NULL
				);
				";

				$this->db->exec($sql);
			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		}


		public function Troncons() {
			try {
				/////////////////////////////////////////
				////// NOMBRE DE MAILS PAR TRONCON //////
				/////////////////////////////////////////
				$requete = "SELECT Troncons FROM info LIMIT 1";
				$result = $this->executeQueryRequete($requete, 1);
				while( $troncon = $result->fetch() ) { $mailByTroncon = $troncon->troncons; }

				/////////////////////////////////////////
				///////// NOMBRE TOTAL DE MAILS /////////
				/////////////////////////////////////////
				$totalContacts = "SELECT COUNT(DISTINCT(email)) FROM b2c";
				$user = $this->executeQueryRequete($totalContacts, 2);

				/////////////////////////////////////////
				////////// UPDATE DES TRONCONS //////////
				/////////////////////////////////////////
				$currentTroncon = 1; $j = 0;
				for ($i=$mailByTroncon ; $i<=$user ; $i+=$mailByTroncon) {
					$j++;
					$requete = "UPDATE b2c SET troncon=".$currentTroncon." WHERE id BETWEEN ".$j." AND ".$i;
					$this->db->exec($requete);
					$currentTroncon++; $j = $i;
				}

				$requete = "UPDATE b2c SET troncon=".$currentTroncon." WHERE id BETWEEN ".$j." AND ".$user;
				$this->db->exec($requete);

				echo '<div class="alert alert-success alert-dismissable bdd_action"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Les <strong>'.$user.'</strong> adresses de la base de donnée ont correctement étés répartient en <strong>'.$currentTroncon.'</strong> tronçons de <strong>'.$mailByTroncon.'</strong> adresses.</div>';

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		}

		public function escape($value) {
			// Échapper la valeur en utilisant mysqli_real_escape_string
			return $this->db->quote($value);
		}


		public function insertPrenomList($POST) {
			try {
				switch ($POST[""]) {
					case 'value':
						# code...
						break;

					default:
						# code...
						break;
				}

				/////////////////////////////////////////
				//////// LISTE DES PRENOMS HOMMES ///////
				/////////////////////////////////////////
				$requete = "SELECT Hommes FROM info LIMIT 1";
				$result = $this->executeQueryRequete($requete, 1);
				while( $hommes = $result->fetch() ) { $prenomsHommes = $hommes->hommes; }

				$tablePrenomsHommes = explode(",", $prenomsHommes);

				foreach ($tablePrenomsHommes as $key => $value) {
					$tablePrenomsHommes[$key] = trim($value);
				}

				/////////////////////////////////////////
				//////// LISTE DES PRENOMS FEMMES ///////
				/////////////////////////////////////////
				$requete = "SELECT Femmes FROM info LIMIT 1";
				$result = $this->executeQueryRequete($requete, 1);
				while( $femmes = $result->fetch() ) { $prenomsFemmes = $femmes->femmes; }

				$tablePrenomsFemmes = explode(",", $prenomsFemmes);

				foreach ($tablePrenomsFemmes as $key => $value) {
					$tablePrenomsFemmes[$key] = trim($value);
				}

				/////////////////////////////////////////
				////// RECHERCHE DE CORRESPONDANCE //////
				/////////////////////////////////////////
				$requete = "SELECT Email FROM b2c WHERE Troncon=".$POST["troncon"];
				$result = $this->executeQueryRequete($requete, 1);

				$nbFemmes = $nbHommes = 0;

				while( $mails = $result->fetch() ) {
					$isWomen = $isMen = false;

					foreach ($tablePrenomsFemmes as $currentWomen) {
						$find = stripos($mails->email, $currentWomen);
						if($find !== false) {
							$isWomen = true;
							$whichWomen = $currentWomen;
						}
					}

					foreach ($tablePrenomsHommes as $currentMen) {
						$find = stripos($mails->email, $currentMen);
						if($find !== false) {
							$isMen = true;
							$whichMen = $currentMen;
						}
					}

					if( $isWomen && !$isMen ) {
						$requete = "UPDATE b2c SET gender='mme' WHERE email='".$mails->email."'";
						$this->db->exec($requete);
						$nbFemmes++;
					} elseif( $isMen && !$isWomen) {
						$requete = "UPDATE b2c SET gender='mr' WHERE email='".$mails->email."'";
						$this->db->exec($requete);
						$nbHommes++;
					}
				}

				echo '<div class="alert alert-success alert-dismissable bdd_action"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Matching effectuée. <strong>'.$nbFemmes.'</strong> femmes et <strong>'.$nbHommes.'</strong> hommes ont étés affectés dans le tronçon '.$POST["troncon"].'.</div>';

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		}
	}
?>
