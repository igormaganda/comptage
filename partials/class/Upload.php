<?php
	class Upload {
		private $post;
		private $file_name;
		private $file_type;
		private $file_size;
		private $file_tmp_name;
		private $file_error;

		private $nom;
		private $b2;
		private $type_data;
		private $separateur;
		private $programme;
		private $comp_partenaire;
		private $comp_programme;
		private $ouvreurs;
		private $cliqueurs;
		private $file_select;

		private $extensions = array('csv');
		private $directory = "/var/www/html/Datamart/New/v4/assets/uploads/";
		//private $directory = "";
		private $directoryB = "uploads/";
		public $msg = array("upload" => "", "form" => "");

		public function __construct($POST, $FILE) {
			$this->post            = $POST;
			$this->file_name       = $FILE['name'];
			$this->file_type       = $FILE['type'];
			$this->file_size       = $FILE['size'];
			$this->file_tmp_name   = $FILE['tmp_name'];
			$this->file_error      = $FILE['error'];
			
			$this->nom             = isset($POST["nom"]) ? $POST["nom"] : "";
			$this->b2              = isset($POST["b2b-b2c"]) ? $POST["b2b-b2c"] : "";
			$this->type_data       = isset($POST["filetype"]) ? $POST["filetype"] : "";
			$this->separateur      = isset($POST["separateur"]) ? $POST["separateur"] : "";
			$this->programme       = isset($POST["programme"]) ? $POST["programme"] : "";
			$this->comp_partenaire = isset($POST["comp_partenaire"]) ? $POST["comp_partenaire"] : "";
			$this->comp_programme  = isset($POST["comp_programme"]) ? $POST["comp_programme"] : "";
			$this->ouvreurs        = isset($POST["ouvreurs"]) ? $POST["ouvreurs"] : "";
			$this->cliqueurs       = isset($POST["cliqueurs"]) ? $POST["cliqueurs"] : "";
			$this->file_select     = isset($POST["file_to_submit"]) ? $POST["file_to_submit"] : "";
        }

		public function uploadFile($action) {
			if(empty($this->file_select)) {

				if ($this->file_error > 0) {

					switch ($this->file_error) {
						case 0:
							$error_msg = "Aucune erreur, le téléchargement est correct.";
							break;
						case 1:
							$error_msg = "La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini.";
							break;
						case 2:
							$error_msg = "La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML.";
							break;
						case 3:
							$error_msg = "Le fichier n'a été que partiellement téléchargé.";
							break;
						case 4:
							$error_msg = "Aucun fichier n'a été téléchargé.";
							break;
						case 6:
							$error_msg = "Un dossier temporaire est manquant.";
							break;
						case 7:
							$error_msg = "Échec de l'écriture du fichier sur le disque.";
							break;
						case 8:
							$error_msg = "Une extension PHP a arrêté l'envoi de fichier.";
							break;
						default:
							$error_msg = "La raison de l'échec demeure un mystère.";
							break;
					}

					$this->msg["upload"] =
						'<div class="lead center innerTB" style="text-align: center;">
							<h2>Épic Fail</h2>
							<p>Erreur lors du transfert: '.$error_msg.'</p>
						</div>';
					exit;
				} else {
					$extension_upload = strtolower(substr(strrchr($this->file_name, '.'), 1));

					if ( in_array($extension_upload, $this->extensions) ) {
						$move_file = move_uploaded_file($this->file_tmp_name, $this->directory . $this->file_name);

						if ($move_file) $this->msg["upload"] =
							'<div class="lead center innerTB" style="text-align: center;">
								<h2>Upload du fichier réussi</h2>
								<p class="text-muted mb-1">Merci de faire correspondre les différents champs.</p>
							</div>';
					} else {
						$this->msg["upload"] =
							'<div class="lead center innerTB" style="text-align: center;">
								<h2>Épic Fail</h2>
								<p>Merci d\'uploader un fichier CSV.</p>
							</div>';
						exit;
					}
				}
			}
/* 
			if($action == 3) {
				require_once("../class/Insert.php");
				$this->post["file"] = $this->file_name;
				$this->post["action"] = 3;
				$insert = new Insert($this->post);
			} else {
				$this->recupFirstline($action);
			}
*/
			$this->recupFirstline($action);
		}

		private function recupFirstline($action) {
			$listeDom = $globalTableSep = array();

			$currentCountLine = 0;
			$currentContent = "";


			if(!empty($this->file_select)) {
				//$dir_file = 'C:/Users/Bernie/Documents/btob/';
				$dir_file = '../tmp/b2c/';
				$this->file_name = $this->file_select;
			} else {
				$dir_file = $this->directory;
			}


			// Ouverture du fichier en lecture
			if (($handle = fopen($dir_file . $this->file_name, "r")) !== FALSE) {
				// Parcours du fichier
				while (($data = fgetcsv($handle, 1000, "\n")) !== FALSE) {
					$num = count($data);
					for ($c=0; $c < $num; $c++) {
						$nbSep = substr_count($data[$c], $this->separateur);

						if (array_key_exists($nbSep, $globalTableSep)) {
							$globalTableSep[$nbSep]++;
						} else {
							$globalTableSep[$nbSep] = 1;
						}


						$element = explode($this->separateur, $data[$c]);

						$nb = 0;
						foreach ($element as $value) {
							if(strlen($value) > 0) {
								$nb++;
							}
						}
					}
				}



				//print_r($globalTableSep);
				$nbSepPerLine = array_search(max($globalTableSep), $globalTableSep);

				rewind($handle);

				// Génération du nouveau fichier
				$fileNamePoint = explode(".", $this->file_name);
				$fileNameExt   = array_pop($fileNamePoint);
				$fileNameName  = implode(".", $fileNamePoint) . "_nice." . $fileNameExt;
				$fileNameNormal  = implode(".", $fileNamePoint) . "." . $fileNameExt;

				if (file_exists($this->directory.$fileNameName)) unlink($this->directory.$fileNameName);
				$niceFile = fopen($this->directory.$fileNameName, "a+");

				$counter = 0;
				// Parcourt du fichier (stockage de chaque ligne dans tableau $data)
				while (($data = fgetcsv($handle, 1000, "\n")) !== FALSE) {
					$num = count($data);

					// Écriture du fichier
					for ($c=0; $c < $num; $c++) {
						if(substr_count($data[$c], $this->separateur) == $nbSepPerLine) {
							fwrite($niceFile, str_replace('"', '', $data[$c])."\n");
						} /*else {
							echo $data[$c] . "<br />";
						}*/

						if($counter == 0) $line = $data[$c];
						if($counter == 1) $line2 = $data[$c];
						$counter++;
						
					}
					 echo $data;
				}

				fclose($niceFile);

				// Encodage du fichier en UTF8
			    $contents = file_get_contents($this->directory.$fileNameName);
			    $file = fopen($this->directory.$fileNameName, 'w+');
			    fputs($file, $contents);
				//var_dump($contents);
			    fclose($file);
				fclose($handle);
				//var_dump(" file exists ", $contents);
				
				if(!empty($this->file_select)) {
					//var_dump(" file exists ", $this->file_select);
					// Déplace le fichier vers DONE
					$file = $dir_file . $this->file_name;
					$newfile = $dir_file . "done/" . $fileNameNormal;

					if (!copy($file, $newfile)) {
					    echo "La copie $file du fichier a échoué...\n";
					} else {
						unlink($file);
					}
				}

				$this->genereForm($action, $line, $line2, $this->directory.$fileNameName);
				//$this->genereForm($action, $line, $line2, $this->directoryB.$fileNameName);
			}

			if(!empty($this->file_select)) {
				rename($dir_file.$this->file_name, $dir_file."DONE/".$this->file_name);
			}

		}

		/*
			0: Insertion
			1: Update
			2: Comparaison
			3: Nettoyage
		*/
		private function genereForm($action, $line, $line2, $file) {
			$element = explode($this->separateur, $line);
			$element2 = explode($this->separateur, $line2);
			//var_dump('Value ', $element2);
			$champs = 0;

			$this->msg["form"] .= '<div class="row">';
			foreach ($element as $key => $thisElement) {
				$this->msg["form"] .= '<div class="col-md-6 my-2">'
				.'<label for="champ'.$champs.'" class="control-label">'.($thisElement).' ('.($element2[$key]).')</label>'
				.'<div class="" id="form_champs">'
				.'<select class="form-select" name="champ'.$champs.'" id="matching_field">';
				
					if( $this->b2 == "b2b" ) {
						$this->msg["form"] .= '<option value="Null">Ne pas enregistrer</option>';

						if($action == 2) {
							$this->msg["form"] .= '<option value="Email_md5">Email_md5</option>';
						}

						$this->msg["form"] .= 
						'<option value="societe">Société</option>'
						.'<option value="adresse">Adresse</option>'
						.'<option value="cp">Code postal</option>'
						.'<option value="ville">Ville</option>'
						.'<option value="tel">Téléphone fixe</option>'
						.'<option value="mobile">Téléphone mobile</option>'
						.'<option value="fax">Fax</option>'
						.'<option value="url">Site web</option>'
						.'<option value="cat">Catégorie</option>'
						.'<option value="siren">Siret/Siren</option>'
						.'<option value="naf">Code NAF</option>'
						.'<option value="creation">Date de création</option>'
						.'<option value="forme">Forme juridique</option>'
						.'<option value="capital">Capital</option>'
						.'<option value="ca">Chiffre d\'affaires</option>'
						.'<option value="ets">ETS</option>'
						.'<option value="resultat">Résultats</option>'
						.'<option value="effectif">Taille en effectif</option>'
						.'<option value="dirigeant">Dirigeant</option>'
						.'<option value="civilite">Civilité</option>'
						.'<option value="prenom">Prénom</option>'
						.'<option value="nom">Nom</option>'
						.'<option value="metier">Profession</option>'
						.'<option value="email">Email</option>';
					} else {
						$this->msg["form"] .= 
						'<option value="Null">Ne pas enregistrer</option>'
						.'<option value="Email">Email</option>';

						if($action == 2) {
							$this->msg["form"] .= '<option value="Email_md5">Email_md5</option>';
						}

						$this->msg["form"] .= 
						'<option value="FirstName">Prénom</option>'
						.'<option value="LastName">Nom</option>'
						.'<option value="Gender">Genre</option>'
						.'<option value="Title">Titre</option>'
						.'<option value="Fonction">Fonction</option>'
						.'<option value="CSP">CSP</option>'
						.'<option value="Parent">Parent</option>'
						.'<option value="Proprietaire">Proprietaire</option>'
						.'<option value="Animaux">Animaux</option>'
						.'<option value="DateOfBirth">Date de naissance</option>'
						.'<option value="YearOfBirth">Année de naissance</option>'
						.'<option value="AgeGroupe">Tranche d\'âge</option>'
						.'<option value="Adresse_1">Adresse</option>'
						.'<option value="Adresse_2">Complément d\'adresse</option>'
						.'<option value="Pays">Pays</option>'
						.'<option value="CP">Code postal</option>'
						.'<option value="Ville">Ville</option>'
						.'<option value="Region">Région</option>'
						.'<option value="Tel_mobile">Téléphone mobile</option>'
						.'<option value="Tel_fixe">Téléphone fixe</option>'
						.'<option value="Date_In">Date d\'inscription</option>'
						.'<option value="Last_Date_R">Date dernière campagne reçue</option>'
						.'<option value="Last_Date_O">Date dernière ouverture</option>'
						.'<option value="Last_Date_C">Date dernier clic</option>';
					}
				$this->msg["form"] .= '</select>'
				.'</div>'
				.'</div>';
				$champs++;
				//var_dump('Element ', $thisElement);
			}
			$this->msg["form"] .= '</div>';
			$this->msg["form"] .= '<input type="hidden" name="nb_champs" value="'.$champs.'." />';
			$this->msg["form"] .= '<input type="hidden" name="file" value="'.$file.'" />';
			$this->msg["form"] .= '<input type="hidden" name="separateur" value="'.$this->separateur.'" />';
			$this->msg["form"] .= '<input type="hidden" name="action" value="'.$action.'" />';
			$this->msg["form"] .= '<input type="hidden" name="b2" value="'.$this->b2.'" />';
		}
	}
?>