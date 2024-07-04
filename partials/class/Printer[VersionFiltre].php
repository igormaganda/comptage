<?php
	class Printer {
		public function printAll() {
			$printData = new Bdd();

			$requete = "SELECT DISTINCT * FROM b2c ORDER BY id";

			$result = $printData->executeQueryRequete($requete, 1);

			echo '<table class="dynamicTable colVis table" id="DataPrinter">
				<thead class="bg-gray">
					<tr>
						<th>B2</th>
						<th>Email</th>
						<th>Gender</th>
						<th>FirstName</th>
						<th>LastName</th>
						<th>AgeGroupe</th>
						<th>Adresse_1</th>
						<th>CP</th>
						<th>Ville</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>B2</th>
						<th>Email</th>
						<th>Gender</th>
						<th>FirstName</th>
						<th>LastName</th>
						<th>AgeGroupe</th>
						<th>Adresse_1</th>
						<th>CP</th>
						<th>Ville</th>
					</tr>
				</tfoot>
				<tbody>';
			while( $currentSearch = $result->fetch() ) {
				echo '<tr>';
					if($currentSearch->b2) {
						echo '<td>B2C</td>';
					} else {
						echo '<td>B2B</td>';
					}
					echo '<td>'.$currentSearch->email.'</td>';
					echo '<td>'.$currentSearch->gender.'</td>';
					echo '<td>'.$currentSearch->firstname.'</td>';
					echo '<td>'.$currentSearch->lastname.'</td>';
					switch ($currentSearch->agegroupe) {
						case 1:
							echo '<td>18 - 25</td>';
							break;
						case 2:
							echo '<td>26 - 35</td>';
							break;
						case 3:
							echo '<td>36 - 50</td>';
							break;
						case 4:
							echo '<td>51 et +</td>';
							break;
						case 0:
						default:
							echo '<td></td>';
							break;
					}
					echo '<td>'.$currentSearch->adresse_1.'</td>';
					echo '<td>'.$currentSearch->cp.'</td>';
					echo '<td>'.$currentSearch->ville.'</td>';
				echo '</tr>';
			}
			echo '</tbody>
			</table>';
		}

		public function printCount() {
			$bdd = new Bdd();
			$calc = new Calc();

			$requete = "SELECT DISTINCT * FROM counter ORDER BY id";

			$result = $bdd->executeQueryRequete($requete, 1);

			echo '<table class="dynamicTable colVis table" id="DataPrinter">
				<thead class="bg-gray">
					<tr>
						<th>name</th>
						<th style="width:40%;">request</th>
						<th>result</th>
						<th>date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>name</th>
						<th>request</th>
						<th>result</th>
						<th>date</th>
						<th>Actions</th>
					</tr>
				</tfoot>
				<tbody>';
			while( $currentSearch = $result->fetch() ) {
				if( !empty($currentSearch->name) ) {
					$currentSearch->name = strtolower($calc->removeSpecialChars($currentSearch->name));
					$tmp = explode(" ", $currentSearch->name);
					$name = $tmp[0];
				} else {
					$currentSearch->name = "/";
				}

				echo '<tr>';
					echo '<td>'.$currentSearch->name.'</td>';
					echo '<td>'.preg_replace("#\\\$#", "'", $currentSearch->request).'</td>';
					if($currentSearch->result == 0) {
						echo '<td id="nbcount'.$currentSearch->id.'"><span class="label label-danger">'.$currentSearch->result.'</span></td>';
					} else {
						echo '<td id="nbcount'.$currentSearch->id.'"><span class="label label-info">'.number_format($currentSearch->result, 0, "", " ").'</span></td>';
					}
					echo '<td>'.$currentSearch->date.'</td>';
					echo '<td>
						<button type="button" class="btn btn-primary btn-sm btn-refresh" onclick="refreshCount('.$currentSearch->id.');"><i class="fa fa-refresh"></i></button>
						<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_export" onclick="putId('.$currentSearch->id.', \''.$name.'\');"><i class="fa fa-download"></i></button>
						<button type="button" class="btn btn-danger btn-sm btn-sup" onclick="rmCount('.$currentSearch->id.');"><i class="fa fa-times"></i></button>
					</td>';
				echo '</tr>';
			}
			echo '</tbody></table>';
		}

		public function printCampagne() {
			$bdd = new Bdd();

			$requete = "SELECT DISTINCT * FROM campagne ORDER BY id";

			$result = $bdd->executeQueryRequete($requete, 1);

			echo '<table class="dynamicTable colVis table" id="DataPrinter">
				<thead class="bg-gray">
					<tr>
						<th>Campagne</th>
						<th>Annonceur</th>
						<th>Programme</th>
						<th>Client</th>
						<th>Thématique</th>
						<th>Cible</th>
						<th>Volume</th>
						<th>Date shoot</th>
						<th>Statut</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Campagne</th>
						<th>Annonceur</th>
						<th>Programme</th>
						<th>Client</th>
						<th>Thématique</th>
						<th>Cible</th>
						<th>Volume</th>
						<th>Date shoot</th>
						<th>Statut</th>
						<th>Actions</th>
					</tr>
				</tfoot>
				<tbody>';
				while( $currentSearch = $result->fetch() ) {
					if( $currentSearch->type_base == "marc" ) {
						echo '<tr id="nbcampagne'.$currentSearch->id.'">';
							echo '<td>'.$currentSearch->campagne.'</td>';
							echo '<td>'.$currentSearch->annonceur.'</td>';
							echo '<td>'.$currentSearch->programme.'</td>';
							echo '<td>'.$currentSearch->client.'</td>';
							echo '<td id="sujet'.$currentSearch->id.'">'.$currentSearch->sujet.'</td>';
							switch ($currentSearch->b2) {
								case 0:
									echo '<td>B2B</td>';
									break;
								case 1:
									echo '<td>B2C</td>';
									break;
							}
							echo '<td>'.$currentSearch->volume.'</td>';
							echo '<td>'.$currentSearch->envoi.'</td>';
							echo '<td id="status'.$currentSearch->id.'">'.$currentSearch->status.'</td>';
							echo '<td class="nowrap">
								<button class="btn btn-inverse" data-toggle="tooltip" data-original-title="Envoyer la campagne" data-placement="top" onclick="campagneEnvoi('.$currentSearch->id.',\''.$currentSearch->route.'\')"><i class="fa fa-envelope"></i></button>
								<button class="btn btn-inverse" data-toggle="tooltip" data-original-title="Suspendre l\'envoi" data-placement="top" onclick="campagnePause('.$currentSearch->id.',\''.$currentSearch->route.'\')"><i class="fa fa-envelope-o"></i></button>
								<button class="btn btn-inverse" data-toggle="tooltip" data-original-title="Reprendre l\'envoi" data-placement="top" onclick="campagneReprise('.$currentSearch->id.',\''.$currentSearch->route.'\')"><i class="fa fa-envelope-o"></i></button>
								<button class="btn btn-primary" data-toggle="tooltip" data-original-title="Copier" data-placement="top" onclick="campagneCopie('.$currentSearch->id.')"><i class="fa fa-copy"></i></button>
								<button class="btn btn-inverse" data-toggle="tooltip" data-original-title="Afficher" data-placement="top" onclick="campagneVisu('.$currentSearch->id.')"><i class="fa fa-eye"></i></button>
								<button class="btn btn-primary" data-toggle="tooltip" data-original-title="Date" data-placement="top" onclick="campagneDate('.$currentSearch->id.')"><i class="fa fa-calendar"></i></button>
								<a href="./campagne.php?edit='.$currentSearch->id.'" class="btn btn-inverse" data-toggle="tooltip" data-original-title="Éditer" data-placement="top"><i class="fa fa-pencil"></i></a>
								<button class="btn btn-danger" data-toggle="tooltip" data-original-title="Supprimer" data-placement="top" onclick="campagneRemove('.$currentSearch->id.')"><i class="fa fa-trash-o"></i></button>
							</td>';
						echo '</tr>';
					}
				}
			echo '</tbody></table>';
		}


		public function printStats() {
			$printData = new Bdd();

			// Ouverture du flux
			$fluxBrut = file_get_contents('http://ddm1.x-mailer.com/report/ddm1452638901174.xml');

			// Conversion en tableau
			$xmlArray = xml2array($fluxBrut, 1, 'tag');



			$freeEnvoyes = $orangeEnvoyes = $neufEnvoyes = $noosEnvoyes = $laposteEnvoyes = $autresEnvoyes = 0;
			$freeAboutis = $orangeAboutis = $neufAboutis = $noosAboutis = $laposteAboutis = $autresAboutis = 0;
			$freeOuvreurs = $orangeOuvreurs = $neufOuvreurs = $noosOuvreurs = $laposteOuvreurs = $autresOuvreurs = 0;
			$freeCliqueurs = $orangeCliqueurs = $neufCliqueurs = $noosCliqueurs = $laposteCliqueurs = $autresCliqueurs = 0;
			$freeHardBounces = $orangeHardBounces = $neufHardBounces = $noosHardBounces = $laposteHardBounces = $autresHardBounces = 0;
			$freeSoftBounces = $orangeSoftBounces = $neufSoftBounces = $noosSoftBounces = $laposteSoftBounces = $autresSoftBounces = 0;
			$freeDesinscrits = $orangeDesinscrits = $neufDesinscrits = $noosDesinscrits = $laposteDesinscrits = $autresDesinscrits = 0;
			$freePlaintes = $orangePlaintes = $neufPlaintes = $noosPlaintes = $lapostePlaintes = $autresPlaintes = 0;


			$ref = array();

			echo '<table class="dynamicTable colVis table" id="DataPrinter"><thead class="bg-gray"><tr>'
			. '<td>Campagne</td>'
			. '<td>Envoi</td>'
			. '<td>Volume d\'envoi</td>'
			. '<td>Ouverture</td>'
			. '<td>Clics</td>'
			. '</tr></thead>';

			echo '<tfoot><tr>'
			. '<td>Campagne</td>'
			. '<td>Envoi</td>'
			. '<td>Volume d\'envoi</td>'
			. '<td>Ouverture</td>'
			. '<td>Clics</td>'
			. '</tr></tfoot><tbody>';

			foreach ($xmlArray as $list) {
				foreach ($list as $entry) {
					if (is_array($entry)) {
						$nb = 0;
						foreach ($entry as $current) {
							// Recherche si la référence existe déja
							if(in_array($current["campaign"]["ref"], $ref) == false) { // existe pas

								// Récupère le propriétaire de la campagne
								$requete = "SELECT type_base FROM campagne WHERE reference LIKE '%".$current["campaign"]["ref"]."%' LIMIT 1";
								$result = $printData->executeQueryRequete($requete, 1);

								$proprio = "";
								while( $currentSearch = $result->fetch() ) {
									$proprio = $currentSearch->type_base;
								}

								///////////////////////////////////////
								///////// RESET DES VARIABLES /////////
								///////////////////////////////////////
								$campaign_ref = $current["campaign"]["ref"];
								$campaign_mailno = $current["campaign"]["mailno"];
								$campaign_text = $current["campaign"]["text"];
								$campaign_start = $current["campaign"]["start"];

								$message_fromname = $current["message"]["fromname"];
								$message_subject = $current["message"]["subject"];

								$list_recnb = $current["list"]["recnb"];

								$perf_nb = $current["perf"]["nb"];
								$perf_hd = $current["perf"]["hd"];
								$perf_sf = $current["perf"]["sf"];
								$perf_df = $current["perf"]["df"];
								$perf_ok = $current["perf"]["ok"];
								$perf_op = $current["perf"]["op"];
								$perf_up = $current["perf"]["up"];
								$perf_cu = $current["perf"]["cu"];
								$perf_ck = $current["perf"]["ck"];
								$perf_vw = $current["perf"]["vw"];
								$perf_un = $current["perf"]["un"];
								$perf_fb = $current["perf"]["fb"];
								$perf_rp = $current["perf"]["rp"];
								$perf_tn = $current["perf"]["tn"];

								$freeEnvoyes = $orangeEnvoyes = $neufEnvoyes = $noosEnvoyes = $laposteEnvoyes = $autresEnvoyes = 0;
								$freeAboutis = $orangeAboutis = $neufAboutis = $noosAboutis = $laposteAboutis = $autresAboutis = 0;
								$freeOuvreurs = $orangeOuvreurs = $neufOuvreurs = $noosOuvreurs = $laposteOuvreurs = $autresOuvreurs = 0;
								$freeCliqueurs = $orangeCliqueurs = $neufCliqueurs = $noosCliqueurs = $laposteCliqueurs = $autresCliqueurs = 0;
								$freeHardBounces = $orangeHardBounces = $neufHardBounces = $noosHardBounces = $laposteHardBounces = $autresHardBounces = 0;
								$freeSoftBounces = $orangeSoftBounces = $neufSoftBounces = $noosSoftBounces = $laposteSoftBounces = $autresSoftBounces = 0;
								$freeDesinscrits = $orangeDesinscrits = $neufDesinscrits = $noosDesinscrits = $laposteDesinscrits = $autresDesinscrits = 0;
								$freePlaintes = $orangePlaintes = $neufPlaintes = $noosPlaintes = $lapostePlaintes = $autresPlaintes = 0;

								$domaine = preg_replace("#@#", "", $current["campaign"]["split"]);
								if ($domaine == "free") {
									$freeEnvoyes = $current["list"]["recnb"];
									$freeAboutis = $current["perf"]["ok"];
									$freeOuvreurs = $current["perf"]["up"];
									$freeCliqueurs = $current["perf"]["ck"];
									$freeHardBounces = $current["perf"]["hd"];
									$freeSoftBounces = $current["perf"]["sf"];
									$freeDesinscrits = $current["perf"]["un"];
									$freePlaintes = $current["perf"]["fb"];
								} elseif ($domaine == "orange") {
									$orangeEnvoyes = $current["list"]["recnb"];
									$orangeAboutis = $current["perf"]["ok"];
									$orangeOuvreurs = $current["perf"]["up"];
									$orangeCliqueurs = $current["perf"]["ck"];
									$orangeHardBounces = $current["perf"]["hd"];
									$orangeSoftBounces = $current["perf"]["sf"];
									$orangeDesinscrits = $current["perf"]["un"];
									$orangePlaintes = $current["perf"]["fb"];
								} elseif ($domaine == "neuf") {
									$neufEnvoyes = $current["list"]["recnb"];
									$neufAboutis = $current["perf"]["ok"];
									$neufOuvreurs = $current["perf"]["up"];
									$neufCliqueurs = $current["perf"]["ck"];
									$neufHardBounces = $current["perf"]["hd"];
									$neufSoftBounces = $current["perf"]["sf"];
									$neufDesinscrits = $current["perf"]["un"];
									$neufPlaintes = $current["perf"]["fb"];
								} elseif ($domaine == "noos") {
									$noosEnvoyes = $current["list"]["recnb"];
									$noosAboutis = $current["perf"]["ok"];
									$noosOuvreurs = $current["perf"]["up"];
									$noosCliqueurs = $current["perf"]["ck"];
									$noosHardBounces = $current["perf"]["hd"];
									$noosSoftBounces = $current["perf"]["sf"];
									$noosDesinscrits = $current["perf"]["un"];
									$noosPlaintes = $current["perf"]["fb"];
								} elseif ($domaine == "laposte") {
									$laposteEnvoyes = $current["list"]["recnb"];
									$laposteAboutis = $current["perf"]["ok"];
									$laposteOuvreurs = $current["perf"]["up"];
									$laposteCliqueurs = $current["perf"]["ck"];
									$laposteHardBounces = $current["perf"]["hd"];
									$laposteSoftBounces = $current["perf"]["sf"];
									$laposteDesinscrits = $current["perf"]["un"];
									$lapostePlaintes = $current["perf"]["fb"];
								} else {
									$autresEnvoyes = $current["list"]["recnb"];
									$autresAboutis = $current["perf"]["ok"];
									$autresOuvreurs = $current["perf"]["up"];
									$autresCliqueurs = $current["perf"]["ck"];
									$autresHardBounces = $current["perf"]["hd"];
									$autresSoftBounces = $current["perf"]["sf"];
									$autresDesinscrits = $current["perf"]["un"];
									$autresPlaintes = $current["perf"]["fb"];
								}

								if( $proprio == "marc" ) {
									array_push($ref, $current["campaign"]["ref"]);

									if($nb > 0) {
										if($current["campaign"]["start"] != 0) {
											$dh = explode(" ", $current["campaign"]["start"]);
											$day = explode("/", $dh[0]);
											$hour = explode(":", $dh[1]);
											$date_trie = $day[2].$day[1].$day[0].$hour[0].$hour[1].$hour[2];
										} else {
											$date_trie = "000000000000";
										}

										///////////////////////////////////////
										/////// GENERATION DU FORMULAIRE //////
										///////////////////////////////////////
										echo '<tr>'
											. '<td><span class="trie">' . $campaign_ref . '</span>'
											. '<form method="POST" action="campagne_e.php" target="_blank">'
											. '<input type="hidden" name="mailno" value="'.$campaign_mailno.'" />'
											. '<input type="hidden" name="text" value="'.$campaign_text.'" />'
											. '<input type="hidden" name="start" value="'.$campaign_start.'" />'
											. '<input type="hidden" name="fromname" value="'.$message_fromname.'" />'
											. '<input type="hidden" name="subject" value="'.$message_subject.'" />'
											. '<input type="hidden" name="recnb" value="'.$list_recnb.'" />'

											. '<input type="hidden" name="nb" value="'.$perf_nb.'" />'
											. '<input type="hidden" name="hd" value="'.$perf_hd.'" />'
											. '<input type="hidden" name="sf" value="'.$perf_sf.'" />'
											. '<input type="hidden" name="df" value="'.$perf_df.'" />'
											. '<input type="hidden" name="ok" value="'.$perf_ok.'" />'
											. '<input type="hidden" name="op" value="'.$perf_op.'" />'
											. '<input type="hidden" name="up" value="'.$perf_up.'" />'
											. '<input type="hidden" name="cu" value="'.$perf_cu.'" />'
											. '<input type="hidden" name="ck" value="'.$perf_ck.'" />'
											. '<input type="hidden" name="vw" value="'.$perf_vw.'" />'
											. '<input type="hidden" name="un" value="'.$perf_un.'" />'
											. '<input type="hidden" name="fb" value="'.$perf_fb.'" />'
											. '<input type="hidden" name="rp" value="'.$perf_rp.'" />'
											. '<input type="hidden" name="tn" value="'.$perf_tn.'" />'

											. '<input type="hidden" name="freeEnvoyes" value="'.$freeEnvoyes.'" />'
											. '<input type="hidden" name="freeAboutis" value="'.$freeAboutis.'" />'
											. '<input type="hidden" name="freeOuvreurs" value="'.$freeOuvreurs.'" />'
											. '<input type="hidden" name="freeCliqueurs" value="'.$freeCliqueurs.'" />'
											. '<input type="hidden" name="freeHardBounces" value="'.$freeHardBounces.'" />'
											. '<input type="hidden" name="freeSoftBounces" value="'.$freeSoftBounces.'" />'
											. '<input type="hidden" name="freeDesinscrits" value="'.$freeDesinscrits.'" />'
											. '<input type="hidden" name="freePlaintes" value="'.$freePlaintes.'" />'
											. '<input type="hidden" name="orangeEnvoyes" value="'.$orangeEnvoyes.'" />'
											. '<input type="hidden" name="orangeAboutis" value="'.$orangeAboutis.'" />'
											. '<input type="hidden" name="orangeOuvreurs" value="'.$orangeOuvreurs.'" />'
											. '<input type="hidden" name="orangeCliqueurs" value="'.$orangeCliqueurs.'" />'
											. '<input type="hidden" name="orangeHardBounces" value="'.$orangeHardBounces.'" />'
											. '<input type="hidden" name="orangeSoftBounces" value="'.$orangeSoftBounces.'" />'
											. '<input type="hidden" name="orangeDesinscrits" value="'.$orangeDesinscrits.'" />'
											. '<input type="hidden" name="orangePlaintes" value="'.$orangePlaintes.'" />'
											. '<input type="hidden" name="neufEnvoyes" value="'.$neufEnvoyes.'" />'
											. '<input type="hidden" name="neufAboutis" value="'.$neufAboutis.'" />'
											. '<input type="hidden" name="neufOuvreurs" value="'.$neufOuvreurs.'" />'
											. '<input type="hidden" name="neufCliqueurs" value="'.$neufCliqueurs.'" />'
											. '<input type="hidden" name="neufHardBounces" value="'.$neufHardBounces.'" />'
											. '<input type="hidden" name="neufSoftBounces" value="'.$neufSoftBounces.'" />'
											. '<input type="hidden" name="neufDesinscrits" value="'.$neufDesinscrits.'" />'
											. '<input type="hidden" name="neufPlaintes" value="'.$neufPlaintes.'" />'
											. '<input type="hidden" name="noosEnvoyes" value="'.$noosEnvoyes.'" />'
											. '<input type="hidden" name="noosAboutis" value="'.$noosAboutis.'" />'
											. '<input type="hidden" name="noosOuvreurs" value="'.$noosOuvreurs.'" />'
											. '<input type="hidden" name="noosCliqueurs" value="'.$noosCliqueurs.'" />'
											. '<input type="hidden" name="noosHardBounces" value="'.$noosHardBounces.'" />'
											. '<input type="hidden" name="noosSoftBounces" value="'.$noosSoftBounces.'" />'
											. '<input type="hidden" name="noosDesinscrits" value="'.$noosDesinscrits.'" />'
											. '<input type="hidden" name="noosPlaintes" value="'.$noosPlaintes.'" />'
											. '<input type="hidden" name="laposteEnvoyes" value="'.$laposteEnvoyes.'" />'
											. '<input type="hidden" name="laposteAboutis" value="'.$laposteAboutis.'" />'
											. '<input type="hidden" name="laposteOuvreurs" value="'.$laposteOuvreurs.'" />'
											. '<input type="hidden" name="laposteCliqueurs" value="'.$laposteCliqueurs.'" />'
											. '<input type="hidden" name="laposteHardBounces" value="'.$laposteHardBounces.'" />'
											. '<input type="hidden" name="laposteSoftBounces" value="'.$laposteSoftBounces.'" />'
											. '<input type="hidden" name="laposteDesinscrits" value="'.$laposteDesinscrits.'" />'
											. '<input type="hidden" name="lapostePlaintes" value="'.$lapostePlaintes.'" />'
											. '<input type="hidden" name="autresEnvoyes" value="'.$autresEnvoyes.'" />'
											. '<input type="hidden" name="autresAboutis" value="'.$autresAboutis.'" />'
											. '<input type="hidden" name="autresOuvreurs" value="'.$autresOuvreurs.'" />'
											. '<input type="hidden" name="autresCliqueurs" value="'.$autresCliqueurs.'" />'
											. '<input type="hidden" name="autresHardBounces" value="'.$autresHardBounces.'" />'
											. '<input type="hidden" name="autresSoftBounces" value="'.$autresSoftBounces.'" />'
											. '<input type="hidden" name="autresDesinscrits" value="'.$autresDesinscrits.'" />'
											. '<input type="hidden" name="autresPlaintes" value="'.$autresPlaintes.'" />'

											. '<input type="submit" value="'.$campaign_ref.'" class="btn btn-default btn-sm" />'
										. '</form>'
										. '</td>'
										. '<td><span class="trie">' . $date_trie . '</span>'. $campaign_start .'</td>'
										. '<td>'. $perf_ok .'</td>'
										. '<td>';
										if($perf_ok>0) {
											echo round($perf_up*100/$perf_ok, 1);
											echo ' % ('. $perf_up .')';
										} else {
											echo $perf_up;
										}
										echo '</td>'
										. '<td>';
										if($perf_ok>0) {
											echo round($perf_ck*100/$perf_ok, 1);
											echo ' % ('. $perf_ck .')';
										} else {
											echo $perf_ck;
										}
										echo '</td>'
										. '</tr>';
									}
								}

								///////////////////////////////////////
								///////// RESET DES VARIABLES /////////
								///////////////////////////////////////
								$campaign_ref = $current["campaign"]["ref"];
								$campaign_mailno = $current["campaign"]["mailno"];
								$campaign_text = $current["campaign"]["text"];
								$campaign_start = $current["campaign"]["start"];

								$message_fromname = $current["message"]["fromname"];
								$message_subject = $current["message"]["subject"];

								$list_recnb = $current["list"]["recnb"];

								$perf_nb = $current["perf"]["nb"];
								$perf_hd = $current["perf"]["hd"];
								$perf_sf = $current["perf"]["sf"];
								$perf_df = $current["perf"]["df"];
								$perf_ok = $current["perf"]["ok"];
								$perf_op = $current["perf"]["op"];
								$perf_up = $current["perf"]["up"];
								$perf_cu = $current["perf"]["cu"];
								$perf_ck = $current["perf"]["ck"];
								$perf_vw = $current["perf"]["vw"];
								$perf_un = $current["perf"]["un"];
								$perf_fb = $current["perf"]["fb"];
								$perf_rp = $current["perf"]["rp"];
								$perf_tn = $current["perf"]["tn"];

								$freeEnvoyes = $orangeEnvoyes = $neufEnvoyes = $noosEnvoyes = $laposteEnvoyes = $autresEnvoyes = 0;
								$freeAboutis = $orangeAboutis = $neufAboutis = $noosAboutis = $laposteAboutis = $autresAboutis = 0;
								$freeOuvreurs = $orangeOuvreurs = $neufOuvreurs = $noosOuvreurs = $laposteOuvreurs = $autresOuvreurs = 0;
								$freeCliqueurs = $orangeCliqueurs = $neufCliqueurs = $noosCliqueurs = $laposteCliqueurs = $autresCliqueurs = 0;
								$freeHardBounces = $orangeHardBounces = $neufHardBounces = $noosHardBounces = $laposteHardBounces = $autresHardBounces = 0;
								$freeSoftBounces = $orangeSoftBounces = $neufSoftBounces = $noosSoftBounces = $laposteSoftBounces = $autresSoftBounces = 0;
								$freeDesinscrits = $orangeDesinscrits = $neufDesinscrits = $noosDesinscrits = $laposteDesinscrits = $autresDesinscrits = 0;
								$freePlaintes = $orangePlaintes = $neufPlaintes = $noosPlaintes = $lapostePlaintes = $autresPlaintes = 0;

								$domaine = preg_replace("#@#", "", $current["campaign"]["split"]);
								if ($domaine == "free") {
									$freeEnvoyes = $current["list"]["recnb"];
									$freeAboutis = $current["perf"]["ok"];
									$freeOuvreurs = $current["perf"]["up"];
									$freeCliqueurs = $current["perf"]["ck"];
									$freeHardBounces = $current["perf"]["hd"];
									$freeSoftBounces = $current["perf"]["sf"];
									$freeDesinscrits = $current["perf"]["un"];
									$freePlaintes = $current["perf"]["fb"];
								} elseif ($domaine == "orange") {
									$orangeEnvoyes = $current["list"]["recnb"];
									$orangeAboutis = $current["perf"]["ok"];
									$orangeOuvreurs = $current["perf"]["up"];
									$orangeCliqueurs = $current["perf"]["ck"];
									$orangeHardBounces = $current["perf"]["hd"];
									$orangeSoftBounces = $current["perf"]["sf"];
									$orangeDesinscrits = $current["perf"]["un"];
									$orangePlaintes = $current["perf"]["fb"];
								} elseif ($domaine == "neuf") {
									$neufEnvoyes = $current["list"]["recnb"];
									$neufAboutis = $current["perf"]["ok"];
									$neufOuvreurs = $current["perf"]["up"];
									$neufCliqueurs = $current["perf"]["ck"];
									$neufHardBounces = $current["perf"]["hd"];
									$neufSoftBounces = $current["perf"]["sf"];
									$neufDesinscrits = $current["perf"]["un"];
									$neufPlaintes = $current["perf"]["fb"];
								} elseif ($domaine == "noos") {
									$noosEnvoyes = $current["list"]["recnb"];
									$noosAboutis = $current["perf"]["ok"];
									$noosOuvreurs = $current["perf"]["up"];
									$noosCliqueurs = $current["perf"]["ck"];
									$noosHardBounces = $current["perf"]["hd"];
									$noosSoftBounces = $current["perf"]["sf"];
									$noosDesinscrits = $current["perf"]["un"];
									$noosPlaintes = $current["perf"]["fb"];
								} elseif ($domaine == "laposte") {
									$laposteEnvoyes = $current["list"]["recnb"];
									$laposteAboutis = $current["perf"]["ok"];
									$laposteOuvreurs = $current["perf"]["up"];
									$laposteCliqueurs = $current["perf"]["ck"];
									$laposteHardBounces = $current["perf"]["hd"];
									$laposteSoftBounces = $current["perf"]["sf"];
									$laposteDesinscrits = $current["perf"]["un"];
									$lapostePlaintes = $current["perf"]["fb"];
								} else {
									$autresEnvoyes = $current["list"]["recnb"];
									$autresAboutis = $current["perf"]["ok"];
									$autresOuvreurs = $current["perf"]["up"];
									$autresCliqueurs = $current["perf"]["ck"];
									$autresHardBounces = $current["perf"]["hd"];
									$autresSoftBounces = $current["perf"]["sf"];
									$autresDesinscrits = $current["perf"]["un"];
									$autresPlaintes = $current["perf"]["fb"];
								}

							} else { // existe

								///////////////////////////////////////
								///////// ADDITION DES VALEURS ////////
								///////////////////////////////////////
								$list_recnb += $current["list"]["recnb"];

								$perf_nb += $current["perf"]["nb"];
								$perf_hd += $current["perf"]["hd"];
								$perf_sf += $current["perf"]["sf"];
								$perf_df += $current["perf"]["df"];
								$perf_ok += $current["perf"]["ok"];
								$perf_op += $current["perf"]["op"];
								$perf_up += $current["perf"]["up"];
								$perf_cu += $current["perf"]["cu"];
								$perf_ck += $current["perf"]["ck"];
								$perf_vw += $current["perf"]["vw"];
								$perf_un += $current["perf"]["un"];
								$perf_fb += $current["perf"]["fb"];
								$perf_rp += $current["perf"]["rp"];
								$perf_tn += $current["perf"]["tn"];

								$domaine = preg_replace("#@#", "", $current["campaign"]["split"]);
								if ($domaine == "free") {
									$freeEnvoyes += $current["list"]["recnb"];
									$freeAboutis += $current["perf"]["ok"];
									$freeOuvreurs += $current["perf"]["up"];
									$freeCliqueurs += $current["perf"]["ck"];
									$freeHardBounces += $current["perf"]["hd"];
									$freeSoftBounces += $current["perf"]["sf"];
									$freeDesinscrits += $current["perf"]["un"];
									$freePlaintes += $current["perf"]["fb"];
								} elseif ($domaine == "orange") {
									$orangeEnvoyes += $current["list"]["recnb"];
									$orangeAboutis += $current["perf"]["ok"];
									$orangeOuvreurs += $current["perf"]["up"];
									$orangeCliqueurs += $current["perf"]["ck"];
									$orangeHardBounces += $current["perf"]["hd"];
									$orangeSoftBounces += $current["perf"]["sf"];
									$orangeDesinscrits += $current["perf"]["un"];
									$orangePlaintes += $current["perf"]["fb"];
								} elseif ($domaine == "neuf") {
									$neufEnvoyes += $current["list"]["recnb"];
									$neufAboutis += $current["perf"]["ok"];
									$neufOuvreurs += $current["perf"]["up"];
									$neufCliqueurs += $current["perf"]["ck"];
									$neufHardBounces += $current["perf"]["hd"];
									$neufSoftBounces += $current["perf"]["sf"];
									$neufDesinscrits += $current["perf"]["un"];
									$neufPlaintes += $current["perf"]["fb"];
								} elseif ($domaine == "noos") {
									$noosEnvoyes += $current["list"]["recnb"];
									$noosAboutis += $current["perf"]["ok"];
									$noosOuvreurs += $current["perf"]["up"];
									$noosCliqueurs += $current["perf"]["ck"];
									$noosHardBounces += $current["perf"]["hd"];
									$noosSoftBounces += $current["perf"]["sf"];
									$noosDesinscrits += $current["perf"]["un"];
									$noosPlaintes += $current["perf"]["fb"];
								} elseif ($domaine == "laposte") {
									$laposteEnvoyes += $current["list"]["recnb"];
									$laposteAboutis += $current["perf"]["ok"];
									$laposteOuvreurs += $current["perf"]["up"];
									$laposteCliqueurs += $current["perf"]["ck"];
									$laposteHardBounces += $current["perf"]["hd"];
									$laposteSoftBounces += $current["perf"]["sf"];
									$laposteDesinscrits += $current["perf"]["un"];
									$lapostePlaintes += $current["perf"]["fb"];
								} else {
									$autresEnvoyes += $current["list"]["recnb"];
									$autresAboutis += $current["perf"]["ok"];
									$autresOuvreurs += $current["perf"]["up"];
									$autresCliqueurs += $current["perf"]["ck"];
									$autresHardBounces += $current["perf"]["hd"];
									$autresSoftBounces += $current["perf"]["sf"];
									$autresDesinscrits += $current["perf"]["un"];
									$autresPlaintes += $current["perf"]["fb"];
								}
							}

							$nb++;
						}
					}
				}
			}

			echo '</tbody></table>';
		}
	}
?>