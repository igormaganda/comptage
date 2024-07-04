<?php

namespace btob\btob;
use Bdd;
use Calc;

class Insert
{
    private $nb_champs;
    private $file_name;
    private $file_type;
    private $name;
    private $b2;
    private $separateur;
    private $first_record;
    private $order;
    private $timestart;
    private $calc;

    public function __construct($POST, $exclureFirstLine)
    {
        $this->calc = new Calc();
        $this->timestart = microtime(true);
        $this->b2 = $POST["b2"] == "b2c" ? 1 : 0;
        $this->name = $POST["nom"];
        $this->nb_champs = $POST["nb_champs"];
        $this->file_name = $POST["file"];
        $this->file_type = $POST["data"];
        $this->separateur = $POST["separateur"];
        $this->first_record = $exclureFirstLine;
        $this->order = array();

        $this->saveImport();
    }

    private function saveImport()
    {
        $bdd = new Bdd();

        $type_file_bool = $this->file_type == "data" ? 1 : 0;

        $requete = "INSERT INTO import(
				Name,
				File,
				Separateur,
				B2,
				Data,
				Date)
			VALUES ('" . str_replace("'", "''", $this->name) . "', '"
            . $this->file_name . "', '"
            . $this->separateur . "', '"
            . $this->b2 . "', '"
            . $type_file_bool . "', 
				CURRENT_TIMESTAMP) 
			RETURNING id";

        if ($id = $bdd->executeSimpleExecRequeteWithReturnValue($requete)) {
            $this->insertBdd($id);
        }
    }

    private function insertBdd($id)
    {
        $bdd = new Bdd();
        $db = $bdd->connect();

        $mailInFileList = array();
        $totalInsert = $totalBreak = $nbBlackList = $currentRecord = $inDb = $inFile = 0;

        for ($i = 0; $i <= $this->nb_champs; $i++) {
            $this->order[$i] = $_POST["champ" . $i];
        }

        /*Array ($order)
        (
            [0] => Email
            [1] => Gender
            ...
            [41] => Null
            [42] => Null
        )*/

        if (($handle = fopen("./" . $this->file_name, "r")) !== FALSE) {
            $nbBl = 0;

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);

                for ($c = 0; $c < $num; $c++) {

                    /////////////////////////////////////////
                    ////////// TRAITE LA BLACKLIST //////////
                    /////////////////////////////////////////
                    if ($this->file_type == "bl") {
                        $requete = "INSERT INTO blacklist(id_Import, Email) 
							VALUES(
								" . $id . ",
								'" . $data[$c] . "'
								);";
                        //$bdd->executeSimpleExecRequete($requete);
                        $db->exec($requete);
                        $nbBl++;
                    }


                    /////////////////////////////////////////
                    //////////// TRAITE LES DATAS ///////////
                    /////////////////////////////////////////
                    if ($this->file_type == "data") {

                        // Parcours chaque ligne
                        $domaine = explode($this->separateur, trim($data[$c]));

                        // Parcours chaque cellule
                        foreach ($domaine as $key => $currentKeyWords) {

                            /*Array ($domaine)
                            (
                                [0] => Email
                                [1] => CivilitÈ
                                ...
                                [41] => Type de client
                                [42] => Type de peau
                            )*/

                            /////////////////////////////////////////
                            //////////// RESET DES CHAMPS ///////////
                            /////////////////////////////////////////
                            $items = array(
                                "Email" => "", // b2c/b2b
                                "Email_MD5" => "", // b2c/b2b
                                "Date_In" => "", // b2c/b2b
                                "Tel_mobile" => "", // b2c
                                "Tel_fixe" => "", // b2c/b2b
                                "Tel_fax" => "", // b2b
                                "Gender" => "", // b2c
                                "Title" => "", // b2c/b2b
                                "Fonction" => "", // b2c/b2b
                                "FirstName" => "", // b2c/b2b
                                "LastName" => "", // b2c/b2b
                                "DateOfBirth" => "", // b2c
                                "YearOfBirth" => "", // b2c
                                "AgeGroupe" => "", // b2c
                                "Adresse_1" => "", // b2c/b2b
                                "Adresse_2" => "", // b2c/b2b
                                "Pays" => "", // b2c/b2b
                                "CP" => "", // b2c/b2b
                                "Ville" => "", // b2c/b2b
                                "Domain" => "", // b2c/b2b
                                "Groupe_Domaine" => "", // b2c/b2b
                                "Raison_Sociale" => "", // b2b
                                "Siret" => "", // b2b
                                "Page_Jaune" => "", // b2b
                                "Code_APE" => "", // b2b
                                "Libelle_APE" => "", // b2b
                                "Effectif" => "", // b2b
                                "CA" => "", // b2b
                                "Last_Date_R" => "", // b2c
                                "Last_Date_O" => "", // b2c
                                "Last_Date_C" => "", // b2c
                                "Pression" => "", // b2c
                                "Activity" => "", // b2c
                                "R" => "" // b2c
                            );

                            /////////////////////////////////////////
                            ////////// MATCHING DES CHAMPS //////////
                            /////////////////////////////////////////
                            foreach ($items as $key => $value) {
                                if (in_array($key, $this->order)) {
                                    $index = array_search($key, $this->order);

                                    if (isset($domaine[$index])) {
                                        $items[$key] = strtolower($domaine[$index]);
                                    }

                                    $items[$key] = htmlspecialchars($items[$key], ENT_QUOTES);
                                }
                            }
                        }


                        /////////////////////////////////////////
                        /// GENERATION DES CHAMPS CALCULABLES ///
                        /////////////////////////////////////////

                        if (!preg_match("#[^a-zA-Z ]#", $items["DateOfBirth"])) {
                            $items["DateOfBirth"] = "";
                        }

                        if ($items["DateOfBirth"] != '') {
                            $part1 = explode(" ", $items["DateOfBirth"]);
                            $items["DateOfBirth"] = $part1[0];
                        }

                        if ($items["DateOfBirth"] != '') {
                            $items["YearOfBirth"] = $this->calc->returnDateOfBirth($items["DateOfBirth"]);
                        }

                        if ($items["YearOfBirth"] != '') {
                            $items["AgeGroupe"] = $this->calc->returnAgeGroupe($items["YearOfBirth"]);
                        }

                        if ($items["Gender"] != '') {
                            $items["Gender"] = $this->calc->returnGender($items["Gender"]);
                        }

                        if ($items["Email"] != '') {
                            $domain = explode("@", $items["Email"]);
                            if (!empty($domain[1])) {
                                $domain = explode(".", $domain[1]);
                                $last = array_pop($domain);

                                $items["Groupe_Domaine"] = $last;
                                $items["Domain"] = implode(".", $domain);
                            }
                        }


                        // Stockage des mails pour calcul des doublons
                        if (in_array($items["Email"], $mailInFileList)) {
                            $inFile++;
                        } else {
                            //array_push($mailInFileList, $items["Email"]);
                            $mailInFileList[] = $items["Email"];
                        }

                        // Requete de recherche du mail dans la table blacklist
                        $isInTableBlackList = "SELECT COUNT(email) FROM blacklist WHERE email='" . $items["Email"] . "'";
                        $req = $db->query($isInTableBlackList);
                        $row = $req->fetch(PDO::FETCH_NUM);
                        $checkBl = $row[0] > 0 ? false : true;

                        // Requete de recherche du mail dans la table data
                        $isInTableData = "SELECT COUNT(email) FROM data WHERE email='" . $items["Email"] . "'";
                        $req = $db->query($isInTableData);
                        $row = $req->fetch(PDO::FETCH_NUM);
                        $checkData = $row[0] > 0 ? false : true;


                        // Si le mail n'est pas dans la blacklist
                        //if($bdd->executeQueryRequete($isInTableBlackList, 0)) {
                        if ($checkBl) {

                            // Si le mail N'EST PAS dans la table data => INSERT
                            //if($bdd->executeQueryRequete($isInTableData, 0)) {
                            if ($checkData) {

                                if ($this->file_type == "data") {
                                    $requete = "INSERT INTO data(id_Import, B2, Email, Email_MD5, Domain, Groupe_Domaine, Date_In, Tel_mobile, Tel_fixe, Tel_fax, Gender, Title, Fonction, FirstName, LastName, DateOfBirth, YearOfBirth, AgeGroupe, Adresse_1, Adresse_2, Pays, CP, Ville, Raison_Sociale, Siret, Page_Jaune, Code_APE, Libelle_APE, Effectif, CA, Last_Date_R, Last_Date_O, Last_Date_C, Pression, Activity, R) 
										VALUES(
											" . $id . ", 
											'" . $this->b2 . "', 
											'" . $items["Email"] . "', 
											'" . md5($items["Email"]) . "', 
											'" . $items["Domain"] . "', 
											'" . $items["Groupe_Domaine"] . "', 
											";
                                    $requete .= $items["Date_In"] == '' ? 'NULL, ' : "'" . $items["Date_In"] . "', 
											";
                                    $requete .= "
											'" . $items["Tel_mobile"] . "', 
											'" . $items["Tel_fixe"] . "', 
											'" . $items["Tel_fax"] . "', 
											'" . $items["Gender"] . "', 
											'" . $items["Title"] . "', 
											'" . $items["Fonction"] . "', 
											'" . ucfirst($items["FirstName"]) . "', 
											'" . ucfirst($items["LastName"]) . "', 
											";
                                    $requete .= $items["DateOfBirth"] == '' ? 'NULL, ' : "'" . $items["DateOfBirth"] . "', 
											";
                                    $requete .= $items["YearOfBirth"] == '' ? 'NULL, ' : "'" . $items["YearOfBirth"] . "', 
											";
                                    $requete .= $items["AgeGroupe"] == '' ? 'NULL, ' : "'" . $items["AgeGroupe"] . "', 
											";
                                    $requete .= "
											'" . ucfirst($items["Adresse_1"]) . "', 
											'" . ucfirst($items["Adresse_2"]) . "', 
											'" . $items["Pays"] . "', 
											'" . $items["CP"] . "', 
											'" . ucfirst($items["Ville"]) . "', 
											'" . $items["Raison_Sociale"] . "', 
											'" . $items["Siret"] . "', 
											'" . $items["Page_Jaune"] . "', 
											'" . $items["Code_APE"] . "', 
											'" . $items["Libelle_APE"] . "', 
											'" . $items["Effectif"] . "', 
											'" . $items["CA"] . "', 
											";
                                    $requete .= $items["Last_Date_R"] == '' ? 'NULL, ' : "'" . $items["Last_Date_R"] . "', 
											";
                                    $requete .= $items["Last_Date_O"] == '' ? 'NULL, ' : "'" . $items["Last_Date_O"] . "', 
											";
                                    $requete .= $items["Last_Date_C"] == '' ? 'NULL, ' : "'" . $items["Last_Date_C"] . "', 
											";
                                    $requete .= "
											'" . $items["Pression"] . "', 
											'" . $items["Activity"] . "', 
											'" . $items["R"] . "'
										);";
                                }

                                /////////////////////////////////////////
                                /// EX|INCLUSION DE LA PREMIERE LIGNE ///
                                /////////////////////////////////////////
                                if ($currentRecord == 0) {
                                    if ($this->first_record == "no") {
                                        $bdd->executeExecRequete($requete, $items["Email"]) ? $totalInsert++ : $totalBreak++;
                                    }
                                    $currentRecord++;
                                } else {
                                    $bdd->executeExecRequete($requete, $items["Email"]) ? $totalInsert++ : $totalBreak++;
                                }

                                // Si le mail EST dans la table data => UPDATE
                            } else {
                                /////////////////////////////////////////
                                ////// UPDATE DES CHAMPS NON VIDE ///////
                                /////////////////////////////////////////
                                $requete = "UPDATE data SET email='" . $items["Email"] . "'";

                                $requete .= $items["Domain"] == '' ? "" : ", Domain='" . $items["Domain"] . "'";
                                $requete .= $items["Groupe_Domaine"] == '' ? "" : ", Groupe_Domaine='" . $items["Groupe_Domaine"] . "'";
                                $requete .= $items["Date_In"] == '' ? "" : ", Date_In='" . $items["Date_In"] . "'";
                                $requete .= $items["Tel_mobile"] == '' ? "" : ", Tel_mobile='" . $items["Tel_mobile"] . "'";
                                $requete .= $items["Tel_fixe"] == '' ? "" : ", Tel_fixe='" . $items["Tel_fixe"] . "'";
                                $requete .= $items["Tel_fax"] == '' ? "" : ", Tel_fax='" . $items["Tel_fax"] . "'";
                                $requete .= $items["Gender"] == '' ? "" : ", Gender='" . $items["Gender"] . "'";
                                $requete .= $items["Title"] == '' ? "" : ", Title='" . $items["Title"] . "'";
                                $requete .= $items["Fonction"] == '' ? "" : ", Fonction='" . $items["Fonction"] . "'";
                                $requete .= $items["FirstName"] == '' ? "" : ", FirstName='" . ucfirst($items["FirstName"]) . "'";
                                $requete .= $items["LastName"] == '' ? "" : ", LastName='" . ucfirst($items["LastName"]) . "'";
                                $requete .= $items["DateOfBirth"] == '' ? "" : ", DateOfBirth='" . $items["DateOfBirth"] . "'";
                                $requete .= $items["YearOfBirth"] == '' ? "" : ", YearOfBirth='" . $items["YearOfBirth"] . "'";
                                $requete .= $items["AgeGroupe"] == '' ? "" : ", AgeGroupe='" . $items["AgeGroupe"] . "'";
                                $requete .= $items["Adresse_1"] == '' ? "" : ", Adresse_1='" . ucfirst($items["Adresse_1"]) . "'";
                                $requete .= $items["Adresse_2"] == '' ? "" : ", Adresse_2='" . ucfirst($items["Adresse_2"]) . "'";
                                $requete .= $items["Pays"] == '' ? "" : ", Pays='" . $items["Pays"] . "'";
                                $requete .= $items["CP"] == '' ? "" : ", CP='" . $items["CP"] . "'";
                                $requete .= $items["Ville"] == '' ? "" : ", Ville='" . ucfirst($items["Ville"]) . "'";
                                $requete .= $items["Raison_Sociale"] == '' ? "" : ", Raison_Sociale='" . ucfirst($items["Raison_Sociale"]) . "'";
                                $requete .= $items["Siret"] == '' ? "" : ", Siret='" . ucfirst($items["Siret"]) . "'";
                                $requete .= $items["Page_Jaune"] == '' ? "" : ", Page_Jaune='" . ucfirst($items["Page_Jaune"]) . "'";
                                $requete .= $items["Code_APE"] == '' ? "" : ", Code_APE='" . ucfirst($items["Code_APE"]) . "'";
                                $requete .= $items["Libelle_APE"] == '' ? "" : ", Libelle_APE='" . ucfirst($items["Libelle_APE"]) . "'";
                                $requete .= $items["Effectif"] == '' ? "" : ", Effectif='" . ucfirst($items["Effectif"]) . "'";
                                $requete .= $items["CA"] == '' ? "" : ", CA='" . ucfirst($items["CA"]) . "'";
                                $requete .= $items["Last_Date_R"] == '' ? "" : ", Last_Date_R='" . $items["Last_Date_R"] . "'";
                                $requete .= $items["Last_Date_O"] == '' ? "" : ", Last_Date_O='" . $items["Last_Date_O"] . "'";
                                $requete .= $items["Last_Date_C"] == '' ? "" : ", Last_Date_C='" . $items["Last_Date_C"] . "'";

                                $requete .= " WHERE email='" . $items["Email"] . "'";

                                $bdd->executeExecRequete($requete, $items["Email"]) ? $inDb++ : $totalBreak++;
                            }

                            // Si le mail est dans la blacklist
                        } else {
                            $nbBlackList++;
                        }
                    }
                }
            }
            fclose($handle);

            if ($this->file_type == "blacklist") {
                $this->printMsg($nbBl . " mails insérés dans la Blacklist en " . $this->calc->timeEnd($this->timestart) . ".", "success");
            }

            if ($this->file_type == "data") {
                /////////////////////////////////////////
                ////////// SYNTHESE DE L'IMPORT /////////
                /////////////////////////////////////////
                $misAjour = ($inDb - $inFile) < 0 ? 0 : $inDb - $inFile;

                $this->printMsg($totalInsert . " contacts importés.", "success");
                $this->printMsg($misAjour . " contacts mis à jour.", "success");
                $this->printMsg($inFile . " doublons dans le fichier.", "primary");
                $this->printMsg($totalBreak . " contacts contenait des données interdites ou erronées.", "primary");
                $this->printMsg($nbBlackList . " contacts appartenant à la black liste.", "danger");
                $this->printMsg($totalBreak + $nbBlackList . " contacts non importés.", "danger");
            }
        }
    }

    private function printMsg($message, $type)
    {
        echo '<div class="alert alert-' . $type . ' alert-dismissible" role="alert">'
            . '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'
            . '<p>' . $message . '</p>'
            . '</div>';
    }
}

?>