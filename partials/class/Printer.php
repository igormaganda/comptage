<?php
class Printer
{

	public function printCount()
	{
		$bdd = new Bdd();
		$calc = new Calc();

		$requete = "SELECT DISTINCT * FROM counter ORDER BY id";

		$result = $bdd->executeQueryRequete($requete, 1);

		echo '<table id="scroll-horizontal" class="table table-bordered table-striped table-hover align-middle"  style="width:100%">
				<thead class="bg-gray">
					<tr>
						<th style="text-align:center;">Comptage</th>
						<th style="width:40%;text-align:center;">Requête</th>
						<th style="text-align:center;">Volume</th>
						<th style="text-align:center;">Date</th>
						<th style="text-align:center;">Actions</th>
					</tr>
				</thead>
				<tbody>';
		while ($currentSearch = $result->fetch()) {
			if (!empty($currentSearch->name)) {
				$currentSearch->name = strtolower($calc->removeSpecialChars($currentSearch->name));
				$tmp = explode(" ", $currentSearch->name);
				$name = $tmp[0];
			} else {
				$currentSearch->name = "/";
			}

			echo '<tr>';
			echo '<td style="text-align:center;">' . $currentSearch->name . '</td>';
			echo '<td class="requete_count">' . preg_replace("#\\\$#", "'", $currentSearch->request) . '</td>';
			if ($currentSearch->result == 0) {
				echo '<td id="nbcount' . $currentSearch->id . '" style="text-align:center;"><span class="btn btn-danger btn-sm text-light">' . $currentSearch->result . '</span></td>';
			} else {
				echo '<td id="nbcount' . $currentSearch->id . '" style="text-align:center;"><span class="btn btn-secondary btn-sm text-light"">' . number_format($currentSearch->result, 0, "", " ") . '</span></td>';
			}
			$date = explode(".", $currentSearch->date);
			$date = explode(" ", $date[0]);
			echo isset($date[1]) ? "<td style='text-align:center;'>Le $date[0] à $date[1]</td>" : "<td></td>";
			echo '<td class="action_count" style="text-align:center;">
						<button type="button" class="btn btn-secondary btn-sm btn-refresh" onclick="refreshCount(' . $currentSearch->id . ');"><i class="bx bx-refresh"></i></button>
						<button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_export" onclick="putId(' . $currentSearch->id . ', \'' . $name . '\');"><i class="bx bxs-download"></i></button>
						<button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_groupby" onclick="putIdGroup(' . $currentSearch->id . ', \'' . $name . '\');"><i class="bx bx-sort-down"></i></button>
						<button type="button" class="btn btn-danger btn-sm btn-sup" onclick="rmCount(' . $currentSearch->id . ');"><i class="bx bxs-trash"></i></button>
					</td>';
			echo '</tr>';
		}
		echo '</tbody></table>';
	}

	public function printCampagne()
	{
		$bdd = new Bdd();


		$tab_alias = array("1x" => "Xmailer", "2g" => "Mailgun", "3s" => "Sendinblue", "4e" => "Ediware");
		$requete = "SELECT id, alias FROM gestion_routes ORDER BY id ASC";

		$result = $bdd->executeQueryRequete($requete, 1);
		while ($current_alias = $result->fetch()) {
			$tab_alias[$current_alias->id] = $current_alias->alias;
		}

		$requete = "SELECT DISTINCT ON (this) this, annonceur, campagne, date
							FROM campagne
							ORDER BY this, id DESC;";
		$result = $bdd->executeQueryRequete($requete, 1);

		$all = array();

		while ($r = $result->fetch()) {
			$requete = "SELECT SUM(volume) AS volume FROM campagne WHERE this='$r->this'";
			$results = $bdd->executeQueryRequete($requete, 1);
			while ($s = $results->fetch()) $volume = $s->volume;

			$date = explode(".", $r->date);
			$all[$r->date] =
				'<tr id="parentDiv">
						<td>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" name="chk_child">
								<label class="form-check-label"></label>
							</div>
						</td>
						<td class="id" style="display:none;"><a href="apps-customers-overview.php" class="fw-medium link-primary">#TB01</a></td>
						<td class="name">' . $r->annonceur . '</div>
						</td>
						<td class="company_name">' . substr($r->campagne, 0, -5) . '</td>
						<td class="email_id">' . number_format($volume, 0, "", " ") . '</td>
						<td class="date">' . $date[0] . '</td>
						<td>
							<div class="dropdown">
								<a class="btn btn-icon btn-subtle-secondary btn-sm dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="bi bi-three-dots-vertical"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_split" onclick="cmpGlobalOpen(\'' . $r->this . '\')"><i class="bi bi-arrow-down bg-success"></i>Splitte</a>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_visu" onclick="cmpGlobalApercu(\'' . $r->this . '\')"><i class="bi bi-eye bg-info"></i>Aperçu</a>
									<a class="dropdown-item edit-item-btn" href="#" onclick="cmpGlobalEdit(\'' . $r->this . '\')"><i class="bi bi-pencil bg-secondary"></i>Modifier</a>
									<a class="dropdown-item" href="#" onclick="cmpGlobalRegen(\'' . $r->this . '\')"><i class="bi bi-arrow-clockwise bg-primary"></i>Rafraichir</a>
									<a class="dropdown-item" href="#" onclick="cmpGlobalCopie(\'' . $r->this . '\')"><i class="bi bi-clipboard bg-light"></i>Copier</a>
									<a class="dropdown-item remove-item-btn" href="#" onclick="cmpGlobalDelete(\'' . $r->this . '\')"><i class="bi bi-trash bg-danger"></i>Supprimer</a>
								</div>
							</div>
						</td>
					</tr>';
		}

		krsort($all);
		foreach ($all as $value) echo $value;

		$campagnes = $order = array();
		$requete = "SELECT id, sujet, campagne, client, thematiques, route, volume, date, status FROM campagne ORDER BY sujet, campagne";
		$result = $bdd->executeQueryRequete($requete, 1);
		while ($currentSearch = $result->fetch()) {
			$campagnes[$currentSearch->sujet][$currentSearch->id]["campagne"]    = $currentSearch->campagne;
			$campagnes[$currentSearch->sujet][$currentSearch->id]["client"]      = $currentSearch->client;
			$campagnes[$currentSearch->sujet][$currentSearch->id]["thematiques"] = $currentSearch->thematiques;
			$campagnes[$currentSearch->sujet][$currentSearch->id]["route"]       = $currentSearch->route;
			$campagnes[$currentSearch->sujet][$currentSearch->id]["volume"]      = $currentSearch->volume;
			$campagnes[$currentSearch->sujet][$currentSearch->id]["date"]        = $currentSearch->date;
			$campagnes[$currentSearch->sujet][$currentSearch->id]["status"]      = $currentSearch->status;
		}

		$requete = "SELECT sujet, id FROM campagne ORDER BY id DESC";
		$result = $bdd->executeQueryRequete($requete, 1);
		while ($currentSearch = $result->fetch()) {
			$order[] = $currentSearch->sujet;
		}
		$order = array_unique($order);

		echo ' 
				<script src="./assets/js/script_campagnes.js"></script>
			';
	}



	public function printCampagneBrouillon()
	{
		$bdd = new Bdd();

		$requete = "SELECT DISTINCT * FROM campagne_tmp WHERE exist IS FALSE ORDER BY id ASC";

		$result = $bdd->executeQueryRequete($requete, 1);

		echo '<table id="scroll-horizontal" class="table table-bordered table-striped table-hover align-middle"  style="width:100%">
					<thead class="bg-gray">
						<tr>
							<th style="text-align:center;">B2</th>
							<th style="text-align:center;">Client</th>
							<th style="text-align:center;">Campagne</th>
							<th style="text-align:center;">Annonceur</th>
							<th style="text-align:center;">Sujet</th>
							<th style="text-align:center;">Expéditeur</th>
							<th style="text-align:center;">Actions</th>
						</tr>
					</thead>
					<tbody>';

		while ($currentSearch = $result->fetch()) {
			echo '<tr id="brouillon' . $currentSearch->id . '">';
			echo $currentSearch->b2 == 1 ? '<td><span class="label label-info">B2C</span></td>' : '<td><span class="label label-success">B2B</span></td>';
			echo '<td>' . wordwrap($currentSearch->client, 20, "<br />") . '</td>';
			echo '<td>' . wordwrap($currentSearch->campagne, 20, "<br />") . '</td>';
			echo '<td>' . wordwrap($currentSearch->annonceur, 20, "<br />") . '</td>';
			echo '<td>' . wordwrap($currentSearch->sujet, 40, "<br />") . '</td>';
			echo '<td>' . wordwrap($currentSearch->expediteur, 20, "<br />") . '</td>';
			echo '<td class="action_count" style="text-align:center;">
							<button class="btn btn-success btn-sm" onclick="./campagne2.php?id=' . $currentSearch->id . '&cmp=tmp"><i class="bi bi-pencil"></i></button>
							<button type="button" class="btn btn-danger btn-sm btn-sup" onclick="rmCount(' . $currentSearch->id . ');"><i class="bx bxs-trash"></i></button>
						</td>';
			echo '</tr>';
		}
		echo '</tbody></table>';
	}



	public function printStats()
	{
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

		echo '<table class="scroll-horizontal table table-bordered table-striped table-hover" style="width: 100%"><thead class="bg-gray"><tr>'
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
						if (in_array($current["campaign"]["ref"], $ref) == false) { // existe pas

							array_push($ref, $current["campaign"]["ref"]);

							if ($nb > 0) {
								if ($current["campaign"]["start"] != 0) {
									$dh = explode(" ", $current["campaign"]["start"]);
									$day = explode("/", $dh[0]);
									$hour = explode(":", $dh[1]);
									$date_trie = $day[2] . $day[1] . $day[0] . $hour[0] . $hour[1] . $hour[2];
								} else {
									$date_trie = "000000000000";
								}

								///////////////////////////////////////
								/////// GENERATION DU FORMULAIRE //////
								///////////////////////////////////////
								echo '<tr>'
									. '<td><span class="trie">' . $campaign_ref . '</span>'
									. '<form method="POST" action="campagne_e.php" target="_blank">'
									. '<input type="hidden" name="mailno" value="' . $campaign_mailno . '" />'
									. '<input type="hidden" name="text" value="' . $campaign_text . '" />'
									. '<input type="hidden" name="start" value="' . $campaign_start . '" />'
									. '<input type="hidden" name="fromname" value="' . $message_fromname . '" />'
									. '<input type="hidden" name="subject" value="' . $message_subject . '" />'
									. '<input type="hidden" name="recnb" value="' . $list_recnb . '" />'

									. '<input type="hidden" name="nb" value="' . $perf_nb . '" />'
									. '<input type="hidden" name="hd" value="' . $perf_hd . '" />'
									. '<input type="hidden" name="sf" value="' . $perf_sf . '" />'
									. '<input type="hidden" name="df" value="' . $perf_df . '" />'
									. '<input type="hidden" name="ok" value="' . $perf_ok . '" />'
									. '<input type="hidden" name="op" value="' . $perf_op . '" />'
									. '<input type="hidden" name="up" value="' . $perf_up . '" />'
									. '<input type="hidden" name="cu" value="' . $perf_cu . '" />'
									. '<input type="hidden" name="ck" value="' . $perf_ck . '" />'
									. '<input type="hidden" name="vw" value="' . $perf_vw . '" />'
									. '<input type="hidden" name="un" value="' . $perf_un . '" />'
									. '<input type="hidden" name="fb" value="' . $perf_fb . '" />'
									. '<input type="hidden" name="rp" value="' . $perf_rp . '" />'
									. '<input type="hidden" name="tn" value="' . $perf_tn . '" />'

									. '<input type="hidden" name="freeEnvoyes" value="' . $freeEnvoyes . '" />'
									. '<input type="hidden" name="freeAboutis" value="' . $freeAboutis . '" />'
									. '<input type="hidden" name="freeOuvreurs" value="' . $freeOuvreurs . '" />'
									. '<input type="hidden" name="freeCliqueurs" value="' . $freeCliqueurs . '" />'
									. '<input type="hidden" name="freeHardBounces" value="' . $freeHardBounces . '" />'
									. '<input type="hidden" name="freeSoftBounces" value="' . $freeSoftBounces . '" />'
									. '<input type="hidden" name="freeDesinscrits" value="' . $freeDesinscrits . '" />'
									. '<input type="hidden" name="freePlaintes" value="' . $freePlaintes . '" />'
									. '<input type="hidden" name="orangeEnvoyes" value="' . $orangeEnvoyes . '" />'
									. '<input type="hidden" name="orangeAboutis" value="' . $orangeAboutis . '" />'
									. '<input type="hidden" name="orangeOuvreurs" value="' . $orangeOuvreurs . '" />'
									. '<input type="hidden" name="orangeCliqueurs" value="' . $orangeCliqueurs . '" />'
									. '<input type="hidden" name="orangeHardBounces" value="' . $orangeHardBounces . '" />'
									. '<input type="hidden" name="orangeSoftBounces" value="' . $orangeSoftBounces . '" />'
									. '<input type="hidden" name="orangeDesinscrits" value="' . $orangeDesinscrits . '" />'
									. '<input type="hidden" name="orangePlaintes" value="' . $orangePlaintes . '" />'
									. '<input type="hidden" name="neufEnvoyes" value="' . $neufEnvoyes . '" />'
									. '<input type="hidden" name="neufAboutis" value="' . $neufAboutis . '" />'
									. '<input type="hidden" name="neufOuvreurs" value="' . $neufOuvreurs . '" />'
									. '<input type="hidden" name="neufCliqueurs" value="' . $neufCliqueurs . '" />'
									. '<input type="hidden" name="neufHardBounces" value="' . $neufHardBounces . '" />'
									. '<input type="hidden" name="neufSoftBounces" value="' . $neufSoftBounces . '" />'
									. '<input type="hidden" name="neufDesinscrits" value="' . $neufDesinscrits . '" />'
									. '<input type="hidden" name="neufPlaintes" value="' . $neufPlaintes . '" />'
									. '<input type="hidden" name="noosEnvoyes" value="' . $noosEnvoyes . '" />'
									. '<input type="hidden" name="noosAboutis" value="' . $noosAboutis . '" />'
									. '<input type="hidden" name="noosOuvreurs" value="' . $noosOuvreurs . '" />'
									. '<input type="hidden" name="noosCliqueurs" value="' . $noosCliqueurs . '" />'
									. '<input type="hidden" name="noosHardBounces" value="' . $noosHardBounces . '" />'
									. '<input type="hidden" name="noosSoftBounces" value="' . $noosSoftBounces . '" />'
									. '<input type="hidden" name="noosDesinscrits" value="' . $noosDesinscrits . '" />'
									. '<input type="hidden" name="noosPlaintes" value="' . $noosPlaintes . '" />'
									. '<input type="hidden" name="laposteEnvoyes" value="' . $laposteEnvoyes . '" />'
									. '<input type="hidden" name="laposteAboutis" value="' . $laposteAboutis . '" />'
									. '<input type="hidden" name="laposteOuvreurs" value="' . $laposteOuvreurs . '" />'
									. '<input type="hidden" name="laposteCliqueurs" value="' . $laposteCliqueurs . '" />'
									. '<input type="hidden" name="laposteHardBounces" value="' . $laposteHardBounces . '" />'
									. '<input type="hidden" name="laposteSoftBounces" value="' . $laposteSoftBounces . '" />'
									. '<input type="hidden" name="laposteDesinscrits" value="' . $laposteDesinscrits . '" />'
									. '<input type="hidden" name="lapostePlaintes" value="' . $lapostePlaintes . '" />'
									. '<input type="hidden" name="autresEnvoyes" value="' . $autresEnvoyes . '" />'
									. '<input type="hidden" name="autresAboutis" value="' . $autresAboutis . '" />'
									. '<input type="hidden" name="autresOuvreurs" value="' . $autresOuvreurs . '" />'
									. '<input type="hidden" name="autresCliqueurs" value="' . $autresCliqueurs . '" />'
									. '<input type="hidden" name="autresHardBounces" value="' . $autresHardBounces . '" />'
									. '<input type="hidden" name="autresSoftBounces" value="' . $autresSoftBounces . '" />'
									. '<input type="hidden" name="autresDesinscrits" value="' . $autresDesinscrits . '" />'
									. '<input type="hidden" name="autresPlaintes" value="' . $autresPlaintes . '" />'

									. '<input type="submit" value="' . $campaign_ref . '" class="btn btn-default btn-sm" />'
									. '</form>'
									. '</td>'
									. '<td><span class="trie">' . $date_trie . '</span>' . $campaign_start . '</td>'
									. '<td>' . $perf_ok . '</td>'
									. '<td>';
								if ($perf_ok > 0) {
									echo round($perf_up * 100 / $perf_ok, 1);
									echo ' % (' . $perf_up . ')';
								} else {
									echo $perf_up;
								}
								echo '</td>'
									. '<td>';
								if ($perf_ok > 0) {
									echo round($perf_ck * 100 / $perf_ok, 1);
									echo ' % (' . $perf_ck . ')';
								} else {
									echo $perf_ck;
								}
								echo '</td>'
									. '</tr>';
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

					// Le petit dernier
					echo '<tr>'
						. '<td><span class="trie">' . $campaign_ref . '</span>'
						. '<form method="POST" action="traitement.php">'
						. '<input type="hidden" name="mailno" value="' . $campaign_mailno . '" />'
						. '<input type="hidden" name="text" value="' . $campaign_text . '" />'
						. '<input type="hidden" name="start" value="' . $campaign_start . '" />'
						. '<input type="hidden" name="fromname" value="' . $message_fromname . '" />'
						. '<input type="hidden" name="subject" value="' . $message_subject . '" />'
						. '<input type="hidden" name="recnb" value="' . $list_recnb . '" />'

						. '<input type="hidden" name="nb" value="' . $perf_nb . '" />'
						. '<input type="hidden" name="hd" value="' . $perf_hd . '" />'
						. '<input type="hidden" name="sf" value="' . $perf_sf . '" />'
						. '<input type="hidden" name="df" value="' . $perf_df . '" />'
						. '<input type="hidden" name="ok" value="' . $perf_ok . '" />'
						. '<input type="hidden" name="op" value="' . $perf_op . '" />'
						. '<input type="hidden" name="up" value="' . $perf_up . '" />'
						. '<input type="hidden" name="cu" value="' . $perf_cu . '" />'
						. '<input type="hidden" name="ck" value="' . $perf_ck . '" />'
						. '<input type="hidden" name="vw" value="' . $perf_vw . '" />'
						. '<input type="hidden" name="un" value="' . $perf_un . '" />'
						. '<input type="hidden" name="fb" value="' . $perf_fb . '" />'
						. '<input type="hidden" name="rp" value="' . $perf_rp . '" />'
						. '<input type="hidden" name="tn" value="' . $perf_tn . '" />'

						. '<input type="hidden" name="freeEnvoyes" value="' . $freeEnvoyes . '" />'
						. '<input type="hidden" name="freeAboutis" value="' . $freeAboutis . '" />'
						. '<input type="hidden" name="freeOuvreurs" value="' . $freeOuvreurs . '" />'
						. '<input type="hidden" name="freeCliqueurs" value="' . $freeCliqueurs . '" />'
						. '<input type="hidden" name="freeHardBounces" value="' . $freeHardBounces . '" />'
						. '<input type="hidden" name="freeSoftBounces" value="' . $freeSoftBounces . '" />'
						. '<input type="hidden" name="freeDesinscrits" value="' . $freeDesinscrits . '" />'
						. '<input type="hidden" name="freePlaintes" value="' . $freePlaintes . '" />'
						. '<input type="hidden" name="orangeEnvoyes" value="' . $orangeEnvoyes . '" />'
						. '<input type="hidden" name="orangeAboutis" value="' . $orangeAboutis . '" />'
						. '<input type="hidden" name="orangeOuvreurs" value="' . $orangeOuvreurs . '" />'
						. '<input type="hidden" name="orangeCliqueurs" value="' . $orangeCliqueurs . '" />'
						. '<input type="hidden" name="orangeHardBounces" value="' . $orangeHardBounces . '" />'
						. '<input type="hidden" name="orangeSoftBounces" value="' . $orangeSoftBounces . '" />'
						. '<input type="hidden" name="orangeDesinscrits" value="' . $orangeDesinscrits . '" />'
						. '<input type="hidden" name="orangePlaintes" value="' . $orangePlaintes . '" />'
						. '<input type="hidden" name="neufEnvoyes" value="' . $neufEnvoyes . '" />'
						. '<input type="hidden" name="neufAboutis" value="' . $neufAboutis . '" />'
						. '<input type="hidden" name="neufOuvreurs" value="' . $neufOuvreurs . '" />'
						. '<input type="hidden" name="neufCliqueurs" value="' . $neufCliqueurs . '" />'
						. '<input type="hidden" name="neufHardBounces" value="' . $neufHardBounces . '" />'
						. '<input type="hidden" name="neufSoftBounces" value="' . $neufSoftBounces . '" />'
						. '<input type="hidden" name="neufDesinscrits" value="' . $neufDesinscrits . '" />'
						. '<input type="hidden" name="neufPlaintes" value="' . $neufPlaintes . '" />'
						. '<input type="hidden" name="noosEnvoyes" value="' . $noosEnvoyes . '" />'
						. '<input type="hidden" name="noosAboutis" value="' . $noosAboutis . '" />'
						. '<input type="hidden" name="noosOuvreurs" value="' . $noosOuvreurs . '" />'
						. '<input type="hidden" name="noosCliqueurs" value="' . $noosCliqueurs . '" />'
						. '<input type="hidden" name="noosHardBounces" value="' . $noosHardBounces . '" />'
						. '<input type="hidden" name="noosSoftBounces" value="' . $noosSoftBounces . '" />'
						. '<input type="hidden" name="noosDesinscrits" value="' . $noosDesinscrits . '" />'
						. '<input type="hidden" name="noosPlaintes" value="' . $noosPlaintes . '" />'
						. '<input type="hidden" name="laposteEnvoyes" value="' . $laposteEnvoyes . '" />'
						. '<input type="hidden" name="laposteAboutis" value="' . $laposteAboutis . '" />'
						. '<input type="hidden" name="laposteOuvreurs" value="' . $laposteOuvreurs . '" />'
						. '<input type="hidden" name="laposteCliqueurs" value="' . $laposteCliqueurs . '" />'
						. '<input type="hidden" name="laposteHardBounces" value="' . $laposteHardBounces . '" />'
						. '<input type="hidden" name="laposteSoftBounces" value="' . $laposteSoftBounces . '" />'
						. '<input type="hidden" name="laposteDesinscrits" value="' . $laposteDesinscrits . '" />'
						. '<input type="hidden" name="lapostePlaintes" value="' . $lapostePlaintes . '" />'
						. '<input type="hidden" name="autresEnvoyes" value="' . $autresEnvoyes . '" />'
						. '<input type="hidden" name="autresAboutis" value="' . $autresAboutis . '" />'
						. '<input type="hidden" name="autresOuvreurs" value="' . $autresOuvreurs . '" />'
						. '<input type="hidden" name="autresCliqueurs" value="' . $autresCliqueurs . '" />'
						. '<input type="hidden" name="autresHardBounces" value="' . $autresHardBounces . '" />'
						. '<input type="hidden" name="autresSoftBounces" value="' . $autresSoftBounces . '" />'
						. '<input type="hidden" name="autresDesinscrits" value="' . $autresDesinscrits . '" />'
						. '<input type="hidden" name="autresPlaintes" value="' . $autresPlaintes . '" />'

						. '<input type="submit" value="' . $campaign_ref . '" class="btn btn-default btn-sm" />'
						. '</form>'
						. '</td>'
						. '<td><span class="trie">' . $date_trie . '</span>' . $campaign_start . '</td>'
						. '<td>' . $perf_ok . '</td>'
						. '<td>';
					if ($perf_ok > 0) {
						echo round($perf_up * 100 / $perf_ok, 1);
						echo ' % (' . $perf_up . ')';
					} else {
						echo $perf_up;
					}
					echo '</td>'
						. '<td>';
					if ($perf_ok > 0) {
						echo round($perf_ck * 100 / $perf_ok, 1);
						echo ' % (' . $perf_ck . ')';
					} else {
						echo $perf_ck;
					}
					echo '</td>'
						. '</tr>';
				}
			}
		}

		echo '</tbody></table>';
	}


	public function printStatsGlobalIndex()
	{
		$bdd = new Bdd();

		$requete = "SELECT sujet, client, volume, reference, operation, prix, objectif, date, id FROM campagne WHERE status='Envoyé' AND volume > 0 ORDER BY id DESC";

		$campagnes = $bdd->executeQueryRequete($requete, 1);

		echo '<table class="table table-borderless table-centered align-middle table-nowrap mb-0">
				<thead class="text-muted table-light">
					<tr>
						<th scope="col" class="sort cursor-pointer" data-sort="">Date</th>
						<th scope="col" class="sort cursor-pointer" data-sort="">Client</th>
						<th scope="col" class="sort cursor-pointer" data-sort="">Sujet</th>
						<th scope="col" class="sort cursor-pointer" data-sort="">Prix</th>
						<th scope="col" class="sort cursor-pointer" data-sort="">Ouvreurs</th>
						<th scope="col" class="sort cursor-pointer" data-sort="">Cliqueurs</th>
						<th scope="col" class="sort cursor-pointer" data-sort="">Chiffre d\'affaire</th>
						<th scope="col" class="sort cursor-pointer" data-sort="">Ratio</th>
					</tr>
				</thead>
				<tbody>';

		$sujet = "";
		$volume = 0;
		$tmp = 0;
		while ($item = $campagnes->fetch()) {
			if ($tmp == 0) {
				$sujet     = $item->sujet;
				$client    = $item->client;
				$date      = $item->date;
				$volume    = $item->volume;
				$reference = $item->reference;
				$operation = $item->operation;
				$prix      = $item->prix;
				$objectif  = $item->objectif;
			} else {
				if ($item->sujet == $sujet) {
					$sujet     = $item->sujet;
					$client    = $item->client;
					$date      = $item->date;
					$volume    += $item->volume;
					$reference = $item->reference;
					$operation = $item->operation;
					$prix      = $item->prix;
					$objectif  = $item->objectif;
				} else {
					$refA  = explode("/", $reference); // ASSO-AIDE/A_d20141022124046_rASSO-AIDE_124545_20
					$refB  = end($refA); // A_d20141022124046_rASSO-AIDE_124545_20
					$refC  = explode("_", $refB);
					$refD  = array_pop($refC);
					$ref   = implode("_", $refC); // A_d20141022124046_rASSO-AIDE_124545

					$openR = "SELECT COUNT(DISTINCT email) FROM stats_open WHERE reference LIKE '" . $ref . "%'";
					$open  = $bdd->executeQueryRequete($openR, 2);

					$clicR = "SELECT COUNT(DISTINCT email) FROM stats_click WHERE reference LIKE '" . $ref . "%'";
					$clic  = $bdd->executeQueryRequete($clicR, 2);

					$date  = explode(".", $date);
					echo '<tr>';
					echo '<td>' . $date[0] . '</td>';
					echo '<td>' . $client . '</td>';
					echo '<td title="' . $sujet . '">' . substr($sujet, 0, 20) . '...</td>';
					echo '<td>' . $prix . '</td>';
					echo '<td class="right">' . number_format($volume, 0, "", " ") . '</td>';
					echo '<td class="right">' . number_format($open, 0, "", " ") . '</td>';
					if ($open > 0) {
						echo '<td class="right">' . number_format($clic, 0, "", " ") . " (" . round($clic * 100 / $open, 2) . " %)" . '</td>';
					} else {
						echo '<td class="right">' . number_format($clic, 0, "", " ") . " (0 %)" . '</td>';
					}
					echo '<td></td>';
					echo '<td class="right">
								<div class="rating text-faded">';
					if ($open > 0) {
						$per = intval($clic * 100 / $open);
					} else {
						$per = 0;
					}

					if ($per < 2) {
						echo '<span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span>'; // 0
					} elseif ($per >= 2 && $per < 4) {
						echo '<span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star active"></span>'; // 1
					} elseif ($per >= 4 && $per < 6) {
						echo '<span class="star"></span><span class="star"></span><span class="star"></span><span class="star active"></span><span class="star"></span>'; // 2
					} elseif ($per >= 6 && $per < 8) {
						echo '<span class="star"></span><span class="star"></span><span class="star active"></span><span class="star"></span><span class="star"></span>'; // 3
					} elseif ($per >= 8 && $per < 10) {
						echo '<span class="star"></span><span class="star active"></span><span class="star"></span><span class="star"></span><span class="star"></span>'; // 4
					} else {
						echo '<span class="star active"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span>'; // 5
					}
					echo	'</div>  
							</td>';
					echo '</tr>';

					$sujet     = $item->sujet;
					$client    = $item->client;
					$date      = $item->date;
					$volume    = $item->volume;
					$reference = $item->reference;
					$operation = $item->operation;
					$prix      = $item->prix;
					$objectif  = $item->objectif;
				}
			}
			$tmp++;
		}
		echo '</tbody></table>';
	}

	public function printStatsGlobal()
	{
		$bdd = new Bdd();

		$requete = "SELECT sujet, client, volume, reference, operation, prix, objectif, date, id FROM campagne WHERE status='Envoyé' AND volume > 0 ORDER BY id DESC";

		$campagnes = $bdd->executeQueryRequete($requete, 1);

		echo '<table class="scroll-horizontal table table-bordered table-striped table-hover" style="width: 100%">
				<thead>
					<tr>
						<th>Date</th>
						<th>Client</th>
						<th>Sujet</th>
						<th>Opération</th>
						<th>Prix</th>
						<th>Objectif</th>
						<th class="right">Volume</th>
						<th class="right">Ouvreurs</th>
						<th class="right">Cliqueurs</th>
						<th class="right">CA</th>
						<th class="right">Ratio</th>
					</tr>
				</thead>
				<tbody>';

		$sujet = "";
		$volume = 0;
		$tmp = 0;
		while ($item = $campagnes->fetch()) {
			if ($tmp == 0) {
				$sujet     = $item->sujet;
				$client    = $item->client;
				$date      = $item->date;
				$volume    = $item->volume;
				$reference = $item->reference;
				$operation = $item->operation;
				$prix      = $item->prix;
				$objectif  = $item->objectif;
			} else {
				if ($item->sujet == $sujet) {
					$sujet     = $item->sujet;
					$client    = $item->client;
					$date      = $item->date;
					$volume    += $item->volume;
					$reference = $item->reference;
					$operation = $item->operation;
					$prix      = $item->prix;
					$objectif  = $item->objectif;
				} else {
					$refA  = explode("/", $reference); // ASSO-AIDE/A_d20141022124046_rASSO-AIDE_124545_20
					$refB  = end($refA); // A_d20141022124046_rASSO-AIDE_124545_20
					$refC  = explode("_", $refB);
					$refD  = array_pop($refC);
					$ref   = implode("_", $refC); // A_d20141022124046_rASSO-AIDE_124545

					$openR = "SELECT COUNT(DISTINCT email) FROM stats_open WHERE reference LIKE '" . $ref . "%'";
					$open  = $bdd->executeQueryRequete($openR, 2);

					$clicR = "SELECT COUNT(DISTINCT email) FROM stats_click WHERE reference LIKE '" . $ref . "%'";
					$clic  = $bdd->executeQueryRequete($clicR, 2);

					$date  = explode(".", $date);
					echo '<tr>';
					echo '<td>' . $date[0] . '</td>';
					echo '<td>' . $client . '</td>';
					echo '<td title="' . $sujet . '">' . substr($sujet, 0, 20) . '...</td>';
					echo '<td>' . $operation . '</td>';
					echo '<td>' . $prix . '</td>';
					echo '<td>' . $objectif . '</td>';
					echo '<td class="right">' . number_format($volume, 0, "", " ") . '</td>';
					echo '<td class="right">' . number_format($open, 0, "", " ") . '</td>';
					if ($open > 0) {
						echo '<td class="right">' . number_format($clic, 0, "", " ") . " (" . round($clic * 100 / $open, 2) . " %)" . '</td>';
					} else {
						echo '<td class="right">' . number_format($clic, 0, "", " ") . " (0 %)" . '</td>';
					}
					echo '<td></td>';
					echo '<td class="right">
								<div class="rating text-faded">';
					if ($open > 0) {
						$per = intval($clic * 100 / $open);
					} else {
						$per = 0;
					}

					if ($per < 2) {
						echo '<span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span>'; // 0
					} elseif ($per >= 2 && $per < 4) {
						echo '<span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star active"></span>'; // 1
					} elseif ($per >= 4 && $per < 6) {
						echo '<span class="star"></span><span class="star"></span><span class="star"></span><span class="star active"></span><span class="star"></span>'; // 2
					} elseif ($per >= 6 && $per < 8) {
						echo '<span class="star"></span><span class="star"></span><span class="star active"></span><span class="star"></span><span class="star"></span>'; // 3
					} elseif ($per >= 8 && $per < 10) {
						echo '<span class="star"></span><span class="star active"></span><span class="star"></span><span class="star"></span><span class="star"></span>'; // 4
					} else {
						echo '<span class="star active"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span>'; // 5
					}
					echo	'</div>  
							</td>';
					echo '</tr>';

					$sujet     = $item->sujet;
					$client    = $item->client;
					$date      = $item->date;
					$volume    = $item->volume;
					$reference = $item->reference;
					$operation = $item->operation;
					$prix      = $item->prix;
					$objectif  = $item->objectif;
				}
			}
			$tmp++;
		}
		echo '</tbody></table>';
	}


	public function ediwareStats()
	{
		$bdd       = new Bdd();
		$requete   = "SELECT * FROM ediware_campagnes WHERE envois > 100 AND ouvertures_uniques > 0 ORDER BY date_envoi DESC";
		$campagnes = $bdd->executeQueryRequete($requete, 1);

		echo '<table class="ediware scroll-horizontal table table-bordered table-striped table-hover" style="width: 100%">
				<thead>
					<tr>
						<th>Envoyé le</th>
						<th>Objet</th>
						<th>Volume</th>
						<th>Aboutis</th>
						<th>Open</th>
						<th>Clic</th>
						<th>NPAI</th>
						<th>Over</th>
						<th>Unsub</th>
						<th>Expéditeur</th>
						<th>Stats</th>
					</tr>
				</thead>
				<tbody>';

		$camTab = array();
		while ($c = $campagnes->fetch()) {

			$camTab[$c->reference]["date_envoi"]         = $c->date_envoi;
			$camTab[$c->reference]["nom_expediteur"]     = $c->nom_expediteur;
			$camTab[$c->reference]["objet"]              = $c->objet;

			if (isset($camTab[$c->reference]["envois"])) $camTab[$c->reference]["envois"] += $c->envois;
			else $camTab[$c->reference]["envois"] = $c->envois;

			if (isset($camTab[$c->reference]["aboutis"])) $camTab[$c->reference]["aboutis"] += $c->aboutis;
			else $camTab[$c->reference]["aboutis"] = $c->aboutis;

			if (isset($camTab[$c->reference]["ouvertures_uniques"])) $camTab[$c->reference]["ouvertures_uniques"] += $c->ouvertures_uniques;
			else $camTab[$c->reference]["ouvertures_uniques"] = $c->ouvertures_uniques;

			if (isset($camTab[$c->reference]["clics_uniques"])) $camTab[$c->reference]["clics_uniques"] += $c->clics_uniques;
			else $camTab[$c->reference]["clics_uniques"] = $c->clics_uniques;

			if (isset($camTab[$c->reference]["npai_hard"])) $camTab[$c->reference]["npai_hard"] += $c->npai_hard;
			else $camTab[$c->reference]["npai_hard"] = $c->npai_hard;

			if (isset($camTab[$c->reference]["overquota"])) $camTab[$c->reference]["overquota"] += $c->overquota;
			else $camTab[$c->reference]["overquota"] = $c->overquota;

			if (isset($camTab[$c->reference]["desinscrits"])) $camTab[$c->reference]["desinscrits"] += $c->desinscrits;
			else $camTab[$c->reference]["desinscrits"] = $c->desinscrits;


			if (isset($camTab[$c->reference]["items"])) {
				$camTab[$c->reference]["items"] .= "<tr>
						<td>$c->date_envoi</td>
						<td>$c->objet</td>
						<td>$c->envois</td>
						<td>$c->aboutis</td>
						<td>$c->ouvertures_uniques</td>
						<td>$c->clics_uniques</td>
						<td>$c->npai_hard</td>
						<td>$c->overquota</td>
						<td>$c->desinscrits</td>
						<td>$c->nom_expediteur</td>
						<td></td>
					</tr>";
			} else {
				$camTab[$c->reference]["items"] = "<tr>
						<td>$c->date_envoi</td>
						<td>$c->objet</td>
						<td>$c->envois</td>
						<td>$c->aboutis</td>
						<td>$c->ouvertures_uniques</td>
						<td>$c->clics_uniques</td>
						<td>$c->npai_hard</td>
						<td>$c->overquota</td>
						<td>$c->desinscrits</td>
						<td>$c->nom_expediteur</td>
						<td></td>
					</tr>";
			}

			if (isset($camTab[$c->reference]["nb"])) $camTab[$c->reference]["nb"] += 1;
			else $camTab[$c->reference]["nb"] = 1;
		}

		foreach ($camTab as $key => $value) {
			echo '<tr class="ediwareDaddyLine">';
			echo '<td>' . $value["date_envoi"] . '</td>';
			echo '<td>' . $value["objet"] . '</td>';
			echo '<td class="bold">' . $value["envois"] . '</td>';
			echo '<td class="bold">' . $value["aboutis"] . '</td>';
			echo '<td class="bold">' . $value["ouvertures_uniques"] . '</td>';
			echo '<td class="bold">' . $value["clics_uniques"] . '</td>';
			echo '<td class="bold">' . $value["npai_hard"] . '</td>';
			echo '<td class="bold">' . $value["overquota"] . '</td>';
			echo '<td class="bold">' . $value["desinscrits"] . '</td>';
			echo '<td>' . $value["nom_expediteur"] . '</td>';
			echo '<td><a href="#" onclick="ediwareStatsGraph(' . $value["envois"] . ', ' . $value["aboutis"] . ', ' . $value["ouvertures_uniques"] . ', ' . $value["clics_uniques"] . ', ' . $value["npai_hard"] . ', ' . $value["overquota"] . ', ' . $value["desinscrits"] . ')">stats</a></td>';
			echo '</tr>';

			//if($value["nb"] > 1) echo $value["items"];
		}

		echo '</tbody></table>';
	}
}
