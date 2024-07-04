<?php
	class Calc {

                public function currentDate() {
                	$date = date("D j F Y, H\hi", time());

        			$patterns = array('#Mon#', '#Tue#', '#Wed#', '#Thu#', '#Fri#', '#Sat#', '#Sun#');
        			$replacements = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

        			$date = preg_replace($patterns, $replacements, $date);

        			$patterns = array('#January#', '#February#', '#March#', '#April#', '#May#', '#June#', '#July#', '#August#', '#September#', '#October#', '#November#', '#December#');
        			$replacements = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

        			$date = preg_replace($patterns, $replacements, $date);

                	return $date;
                }

                public function returnDateOfBirth($date) {
                	if (preg_match("#[0-9]{4}#", $date, $matches)) {
                		return $matches[0];
                	} else {
                		return "";
                	}
                }

                public function returnAgeGroupe($year) {
                        $today = date("Y");
                        $age = $today - $year;

                        switch ($age) {
                                case ($age >= 18 && $age <= 25):
                                        return 1;
                                
                                case ($age >= 26 && $age <= 35):
                                        return 2;

                                case ($age >= 36 && $age <= 50):
                                        return 3;

                                case ($age > 50):
                                        return 4;

                                default:
                                        return 0;
                        }
                }

                public function returnAge($ageMin, $ageMax, $min_max) {
                        $currentYear = date('Y');

                        $yearMin = $currentYear - $ageMin;
                        $yearMax = $currentYear - $ageMax;

                        if($min_max == 0) {
                                return $yearMin;
                        }
                        if($min_max == 1) {
                                return $yearMax;
                        }
                }

                public function returnGender($gender) {
                        switch (strtolower($gender)) {
                                case 'm':
                                case 'm.':
                                case 'mr':
                                case 'monsieur':
                                        return "mr";

                                case 'mme':
                                case 'madame':
                                        return "mme";

                                case 'mlle':
                                case 'mademoiselle':
                                        return "mlle";

                                default:
                                        return "";
                        }
                }

                public function removeSpecialChars($val) {
                        return preg_replace(array('#\&[a-z]+\;#si', '#[^a-z0-9-_.  ]#si'), NULL, str_replace(explode(',', 'À,Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Œ,Ù,Ú,Û,Ü,Ý,Ÿ,ß,à,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ñ,ò,ó,ô,õ,ö,ø,œ,ù,ú,û,ü,ý,ÿ'), explode(',', 'A,A,A,A,A,A,AE,C,E,E,E,E,I,I,I,I,N,O,O,O,O,O,O,OE,U,U,U,U,Y,Y,B,a,a,a,a,a,a,ae,c,e,e,e,e,n,o,o,o,o,o,o,oe,u,u,u,u,y,y'), $val));
                }

                public function slug($val) {
                        return strtolower(preg_replace(array('#-+#', '#^-+#', '#-+$#'), array('-', NULL, NULL), str_replace(array(' ', '.'), array('-', NULL), removeSpecialChars($val))));
                }

                public function timeParsing($duree) {
                        $time = gmdate("H:i:s", $duree);
                        $time = explode(":", $time);

                        if ($time[0] != "00") {
                                return $time[0] . " h, " . $time[1] . " min, " . $time[2] . " sec";
                        } elseif($time[0] == "00" && $time[1] != "00") {
                                return $time[1] . " min, " . $time[2] . " sec";
                        } else {
                                return $time[2] . " sec";
                        }
                }

                public function timeEnd($timestart) {
                        $timeend = microtime(true);
                        $time = $timeend - $timestart;
                        $page_load_time = number_format($time, 0);
                        return $this->timeParsing($page_load_time);
                }

                public function info($champ) {
                        $bdd = new Bdd();

                        switch ($champ) {
                                case 'chiffres':
                                        $item = "chiffres"; break;
                                case 'lettres':
                                        $item = "lettres"; break;
                                case 'spam':
                                        $item = "keywords_spam"; break;
                                case 'domaines':
                                        $item = "top_domain"; break;
                                case 'troncons':
                                        $item = "troncons"; break;
                                case 'hommes':
                                        $item = "hommes"; break;
                                case 'femmes':
                                        $item = "femmes"; break;
                        }

                        $requete = "SELECT ".$item." FROM info LIMIT 1";

                        $result = $bdd->executeQueryRequete($requete, 1);

                        while( $go = $result->fetch() ) {
                                return $go->$item;
                        }
                }

                public function requeteCountComptage($id) {
                        $bdd = new Bdd();

                        if (!empty($id)) {
                                $requete = "SELECT request FROM counter WHERE id=".$id;
                        } else {
                                return "SELECT COUNT(DISTINCT email) FROM b2c WHERE email='igor@ddream-media.fr'";
                        }

                        $result = $bdd->executeQueryRequete($requete, 1);

                        while( $go = $result->fetch() ) {
                                return str_replace("$", "'", $go->request);
                        }
                }

                public function requeteResultComptage($id) {
                        $bdd = new Bdd();

                        if (!empty($id)) {
                                $requete = "SELECT campagne FROM counter WHERE id=".$id;
                        } else {
                                return "SELECT DISTINCT email, id FROM b2c WHERE email='igor@ddream-media.fr'";
                        }

                        $result = $bdd->executeQueryRequete($requete, 1);

                        while( $go = $result->fetch() ) {
                                return str_replace("$", "'", $go->campagne);
                        }
                }
        }
?>