<?php
	class Insert {
		private $nb_champs;
		private $file_name;
		private $order;

		public function __construct($POST) {
			$this->nb_champs = $POST["nb_champs"];
			$this->file_name = $POST["file"];
			$this->order = array();

			$this->insertBdd();
        }

        private function insertBdd() {
			for ($i=0; $i <= $this->nb_champs; $i++) {
				$this->order[$i] = $_POST["champ".$i];
			}

			if (($handle = fopen("../".$this->file_name, "r")) !== FALSE) {

				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$num = count($data);

					for ($c=0; $c < $num; $c++) {

						// Parcours chaque ligne
						$domaine = explode(";", trim($data[$c]));

						// Parcours chaque cellule
						foreach ($domaine as $key => $currentKeyWords) {

							$items = array(
								"Email" => "",
								"Email_MD5" => "",
								"Date_In" => "",
								"Tel_mobile" => "",
								"Tel_fixe" => "",
								"Gender" => "",
								"Title" => "",
								"FirstName" => "",
								"LastName" => "",
								"DateOfBirth" => "",
								"YearOfBirth" => "",
								"AgeGroupe" => "",
								"Adresse_1" => "",
								"Adresse_2" => "",
								"CP" => "",
								"Ville" => "",
								"Domain" => "",
								"Groupe_Domaine" => "",
								"Last_Date_R" => "",
								"Last_Date_O" => "",
								"Last_Date_C" => "",
								"Pression" => "",
								"Activity" => "",
								"R" => ""
							);

							foreach ($items as $key => $value) {
								//echo "Clé : $key; Valeur : $value<br />\n";

								if(in_array($key, $this->order)) {
									$index = array_search($key, $this->order);
									$items[$key] = $domaine[$index];
								}
							}



							/*if(in_array("Email", $this->order)) {
								$index = array_search("Email" , $this->order);
								$Email = $domaine[$index];
								$Email_MD5 = md5($Email);
							} else {
								$Email = "";
								$Email_MD5 = "";
							}

							if(in_array("Date_In", $this->order)) {
								$index = array_search("Date_In" , $this->order);
								$Date_In = $domaine[$index];
							} else {
								$Date_In = "";
							}

							if(in_array("Tel_mobile", $this->order)) {
								$index = array_search("Tel_mobile" , $this->order);
								$Tel_mobile = $domaine[$index];
							} else {
								$Tel_mobile = "";
							}

							if(in_array("Tel_fixe", $this->order)) {
								$index = array_search("Tel_fixe" , $this->order);
								$Tel_fixe = $domaine[$index];
							} else {
								$Tel_fixe = "";
							}

							if(in_array("Gender", $this->order)) {
								$index = array_search("Gender" , $this->order);
								$Gender = $domaine[$index];
							} else {
								$Gender = "";
							}

							if(in_array("Title", $this->order)) {
								$index = array_search("Title" , $this->order);
								$Title = $domaine[$index];
							} else {
								$Title = "";
							}

							if(in_array("FirstName", $this->order)) {
								$index = array_search("FirstName" , $this->order);
								$FirstName = $domaine[$index];
							} else {
								$FirstName = "";
							}

							if(in_array("LastName", $this->order)) {
								$index = array_search("LastName" , $this->order);
								$LastName = $domaine[$index];
							} else {
								$LastName = "";
							}

							if(in_array("DateOfBirth", $this->order)) {
								$index = array_search("DateOfBirth" , $this->order);
								$DateOfBirth = $domaine[$index];
							} else {
								$DateOfBirth = "";
							}

							if(in_array("YearOfBirth", $this->order)) {
								$index = array_search("YearOfBirth" , $this->order);
								$YearOfBirth = $domaine[$index];
							} else {
								$YearOfBirth = "";
							}

							if(in_array("AgeGroupe", $this->order)) {
								$index = array_search("AgeGroupe" , $this->order);
								$AgeGroupe = $domaine[$index];
							} else {
								$AgeGroupe = "";
							}

							if(in_array("Adresse_1", $this->order)) {
								$index = array_search("Adresse_1" , $this->order);
								$Adresse_1 = $domaine[$index];
							} else {
								$Adresse_1 = "";
							}

							if(in_array("Adresse_2", $this->order)) {
								$index = array_search("Adresse_2" , $this->order);
								$Adresse_2 = $domaine[$index];
							} else {
								$Adresse_2 = "";
							}

							if(in_array("CP", $this->order)) {
								$index = array_search("CP" , $this->order);
								$CP = $domaine[$index];
							} else {
								$CP = "";
							}

							if(in_array("Ville", $this->order)) {
								$index = array_search("Ville" , $this->order);
								$Ville = $domaine[$index];
							} else {
								$Ville = "";
							}

							if(in_array("Domain", $this->order)) {
								$index = array_search("Domain" , $this->order);
								$Domain = $domaine[$index];
							} else {
								$Domain = "";
							}

							if(in_array("Groupe_Domaine", $this->order)) {
								$index = array_search("Groupe_Domaine" , $this->order);
								$Groupe_Domaine = $domaine[$index];
							} else {
								$Groupe_Domaine = "";
							}

							if(in_array("Last_Date_R", $this->order)) {
								$index = array_search("Last_Date_R" , $this->order);
								$Last_Date_R = $domaine[$index];
							} else {
								$Last_Date_R = "";
							}

							if(in_array("Last_Date_O", $this->order)) {
								$index = array_search("Last_Date_O" , $this->order);
								$Last_Date_O = $domaine[$index];
							} else {
								$Last_Date_O = "";
							}

							if(in_array("Last_Date_C", $this->order)) {
								$index = array_search("Last_Date_C" , $this->order);
								$Last_Date_C = $domaine[$index];
							} else {
								$Last_Date_C = "";
							}

							$Pression="";
							$Activity="";
							$R="";
							*/
						}

						/*$requete ='INSERT INTO data(Email, Email_MD5, Date_In, Tel_mobile, Tel_fixe, Gender, Title, FirstName, LastName, DateOfBirth, YearOfBirth, AgeGroupe, Adresse_1, Adresse_2, CP, Ville, Domain, Groupe_Domaine, Last_Date_R, Last_Date_O, Last_Date_C, Pression, Activity, R) 
						VALUES
							("'.$Email.'", "'.$Email_MD5.'", "'.$Date_In.'", "'.$Tel_mobile.'", "'.$Tel_fixe.'", "'.$Gender.'", "'.$Title.'", "'.$FirstName.'", "'.$LastName.'", "'.$DateOfBirth.'", "'.$YearOfBirth.'", "'.$AgeGroupe.'", "'.$Adresse_1.'", "'.$Adresse_2.'", "'.$CP.'", "'.$Ville.'", "'.$Domain.'", "'.$Groupe_Domaine.'", "'.$Last_Date_R.'", "'.$Last_Date_O.'", "'.$Last_Date_C.'", "'.$Pression.'", "'.$Activity.'", "'.$R.'")
						;';*/

						$requete ='INSERT INTO data(Email, Email_MD5, Date_In, Tel_mobile, Tel_fixe, Gender, Title, FirstName, LastName, DateOfBirth, YearOfBirth, AgeGroupe, Adresse_1, Adresse_2, CP, Ville, Domain, Groupe_Domaine, Last_Date_R, Last_Date_O, Last_Date_C, Pression, Activity, R) 
						VALUES
							("'.$items["Email"].'", "'.$items["Email_MD5"].'", "'.$items["Date_In"].'", "'.$items["Tel_mobile"].'", "'.$items["Tel_fixe"].'", "'.$items["Gender"].'", "'.$items["Title"].'", "'.$items["FirstName"].'", "'.$items["LastName"].'", "'.$items["DateOfBirth"].'", "'.$items["YearOfBirth"].'", "'.$items["AgeGroupe"].'", "'.$items["Adresse_1"].'", "'.$items["Adresse_2"].'", "'.$items["CP"].'", "'.$items["Ville"].'", "'.$items["Domain"].'", "'.$items["Groupe_Domaine"].'", "'.$items["Last_Date_R"].'", "'.$items["Last_Date_O"].'", "'.$items["Last_Date_C"].'", "'.$items["Pression"].'", "'.$items["Activity"].'", "'.$items["R"].'")
						;';

						echo $requete . '<br /><br />';
					}
				}
				fclose($handle);
			}

        }
	}
?>