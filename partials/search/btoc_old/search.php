<?php
	require_once("../../../sdatamart/lib/system_load.php");
	authenticate_user('all');
	$odometer = 1;
	$map = 1;

	require_once("../../header.php");
	require_once("partials/class/Bdd.php");

	$bdd = new Bdd();
?>

<div id="content">
	<div class="widget" id="search_content">
		<div class="widget-body innerAll inner-2x">
			<form method="POST" action="search_a.php" name="form_search_db" id="form_search_db">
				<div class="widget-head">
					<h4 class="heading glyphicons search"><i></i>Nom de la recherche</h4>
				</div>
				
				<div class="widget-body">
					<input name="name" type="text" id="search_name" class="form-control input-lg" placeholder="Nom">
				</div>

				<div class="widget-head">
					<h4 class="heading glyphicons cloud-download"><i></i>Import</h4>
				</div>
				
				<div class="widget-body">
					<div class="col-sm-6">
					<h5>Partenaires</h5>
					<select name="partenaire" class="form-control input-lg" id="partenaire">
						<option value=""></option>
						<?php
						$requete = "SELECT id, nom FROM gestion_partenaire ORDER BY nom ASC";
						$result = $bdd->executeQueryRequete($requete, 1);

						while( $partenaire = $result->fetch() ) {
							echo '<option value="'.$partenaire->id.'">'.$partenaire->nom.'</option>';
						}
						?>
					</select>
					</div>

					<div class="col-sm-6">
					<h5>Programmes</h5>
					<select name="programme" class="form-control input-lg" id="programme">
						<option value=""></option>
						<?php
						$requete = "SELECT id, nom FROM gestion_programme ORDER BY nom ASC";
						$result = $bdd->executeQueryRequete($requete, 1);

						while( $programme = $result->fetch() ) {
							echo '<option value="'.$programme->id.'">'.$programme->nom.'</option>';
						}
						?>
					</select>
					</div>
				</div>

<!--				<div class="widget-head">-->
<!--					<h4 class="heading glyphicons group"><i></i>B2B/B2C</h4>-->
<!--					<h4 class="heading glyphicons group"><i></i>B2C</h4>-->
<!--				</div>-->

<!--				<div class="widget-body">-->
<!--					<div class="widget-body center" id="b2">-->
<!--						<div class="make-switch" data-on="default" data-off="default">-->
<!--						<input type="checkbox" checked></div>-->
<!--					</div>-->
<!---->
<!--					<input type="hidden" name="b2b-b2c" id="b2_input" value="b2c">-->
<!--				</div>-->

				<div class="widget-head">
					<h4 class="heading glyphicons parents"><i></i>Informations</h4>
				</div>
				
				<div class="widget-body">
					<table id="sexe">
						<tr>
							<td>
								<h5 class="heading glyphicons parents"><i></i>Civilité</h5>
							</td>
							<td>
								<div class="radio">
									<label class="radio-custom">
										<input type="radio" name="genre" value="homme"> 
										<i class="fa fa-circle-o"></i> Hommes
									</label> 
								</div> 
							</td>
							<td>
								<div class="radio"> 
									<label class="radio-custom"> 
										<input type="radio" name="genre" value="both" checked="checked">
										<i class="fa fa-circle-o checked"></i> Hommes & Femmes
									</label> 
								</div>
							</td>
							<td>
								<div class="radio"> 
									<label class="radio-custom"> 
										<input type="radio" name="genre" value="femme"> 
										<i class="fa fa-circle-o"></i> Femmes
									</label> 
								</div>
							</td>
						</tr>

						<tr>
							<td>
								<h5 class="heading glyphicons home"><i></i>Propriétaire</h5>
							</td>
							<td>
								<div class="radio">
									<label class="radio-custom">
										<input type="radio" name="proprio" value="none"> 
										<i class="fa fa-circle-o"></i> Non-Propriétaire
									</label> 
								</div> 
							</td>
							<td>
								<div class="radio"> 
									<label class="radio-custom"> 
										<input type="radio" name="proprio" value="both" checked="checked">
										<i class="fa fa-circle-o checked"></i> Tout le monde
									</label> 
								</div>
							</td>
							<td>
								<div class="radio"> 
									<label class="radio-custom"> 
										<input type="radio" name="proprio" value="1"> 
										<i class="fa fa-circle-o"></i> Propriétaire
									</label> 
								</div>
							</td>
						</tr>

						<tr>
							<td>
								<h5 class="heading glyphicons girl"><i></i>Enfants</h5>
							</td>
							<td>
								<div class="radio">
									<label class="radio-custom">
										<input type="radio" name="enfants" value="none"> 
										<i class="fa fa-circle-o"></i> Sans enfants
									</label> 
								</div> 
							</td>
							<td>
								<div class="radio"> 
									<label class="radio-custom"> 
										<input type="radio" name="enfants" value="both" checked="checked">
										<i class="fa fa-circle-o checked"></i> Tout le monde
									</label> 
								</div>
							</td>
							<td>
								<div class="radio"> 
									<label class="radio-custom"> 
										<input type="radio" name="enfants" value="1"> 
										<i class="fa fa-circle-o"></i> 1 ou plusieurs enfants
									</label> 
								</div>
							</td>
						</tr>

						<tr>
							<td>
								<h5 class="heading glyphicons coins"><i></i>CSP</h5>
							</td>
							<td>
								<table width="100%">
									<tr>
										<td style="width: 25%;">
											<div class="checkbox">
												<label class="checkbox-custom"> 
													<input type="checkbox" name="csp[]" value="1">
													<i class="fa fa-fw fa-square-o"></i> 1
												</label> 
											</div>
										</td>
										<td style="width: 25%;">
											<div class="checkbox">
												<label class="checkbox-custom"> 
													<input type="checkbox" name="csp[]" value="2">
													<i class="fa fa-fw fa-square-o"></i> 2
												</label> 
											</div>
										</td>
										<td style="width: 25%;">
											<div class="checkbox">
												<label class="checkbox-custom"> 
													<input type="checkbox" name="csp[]" value="3">
													<i class="fa fa-fw fa-square-o"></i> 3
												</label> 
											</div>
										</td>
										<td style="width: 25%;">
											<div class="checkbox">
												<label class="checkbox-custom"> 
													<input type="checkbox" name="csp[]" value="4">
													<i class="fa fa-fw fa-square-o"></i> 4
												</label> 
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>

				<div class="widget-head">
					<h4 class="heading glyphicons old_man"><i></i>Age</h4>
				</div>

				<div class="checkbox">
					<label class="checkbox-custom"> 
						<input type="checkbox" name="exclureAge" value="yes" checked="checked">
						<i class="fa fa-fw fa-square-o checked"></i> Tout le monde.
					</label> 
				</div>

				<div class="widget-body" id="age">
					<div class="sliderContainer">
						<div id="rangeSlider"></div>
					</div>
				</div>

				<input type="hidden" name="age_min" id="age_min" />
				<input type="hidden" name="age_max" id="age_max" />

				<div class="widget-head">
					<h4 class="heading glyphicons skull"><i></i>Exclusions</h4>
				</div>
				
				<div class="widget-body">
					<input name="date" type="hidden" id="date">

					<div class="widget widget-heading-simple widget-body-gray">
						<div class="widget-body" id="age-slider">
							<div class="slider-range-min row form-horizontal">
								<div class="col-md-3">
									<div class="control-group">
										<label class="col-md-8 control-label">Nombre de jours:</label> 
										<div class="col-md-4 padding-none">
											<input type="text" class="amount form-control" />
									</div>
								</div>
										</div>
								<div class="col-md-9" style="padding-top: 9px;">
									<div class="slider slider-primary"></div>
								</div>
							</div>
						</div>
					</div>
				</div>





				<div class="widget-head">
					<h4 class="heading glyphicons skull"><i></i>Champs requis</h4>
				</div>

				<div class="widget-body">
					<table id="modal-check">
						<tr>
							<td>
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="email">
									<i class="fa fa-fw fa-square-o"></i> Email
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="email_md5">
									<i class="fa fa-fw fa-square-o"></i> Email MD5
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="firstname">
									<i class="fa fa-fw fa-square-o"></i> Prénom
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="lastname">
									<i class="fa fa-fw fa-square-o"></i> Nom
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="dateofbirth">
									<i class="fa fa-fw fa-square-o"></i> Date de naissance
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="agegroupe">
									<i class="fa fa-fw fa-square-o"></i> Groupe d'âge
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="adresse_1">
									<i class="fa fa-fw fa-square-o"></i> Adresse
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="adresse_2">
									<i class="fa fa-fw fa-square-o"></i> Complément d'adresse
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="pays">
									<i class="fa fa-fw fa-square-o"></i> Pays
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="cp">
									<i class="fa fa-fw fa-square-o"></i> Code postal
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="ville">
									<i class="fa fa-fw fa-square-o"></i> Ville
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="region">
									<i class="fa fa-fw fa-square-o"></i> Région
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="gender">
									<i class="fa fa-fw fa-square-o"></i> Civilité
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="title">
									<i class="fa fa-fw fa-square-o"></i> Titre
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="fonction">
									<i class="fa fa-fw fa-square-o"></i> Fonction
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="csp">
									<i class="fa fa-fw fa-square-o"></i> Catégorie Socio Professionnelle
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="parent">
									<i class="fa fa-fw fa-square-o"></i> Parent
								</label><br />
							</td>
							<td>
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="proprietaire">
									<i class="fa fa-fw fa-square-o"></i> Propriétaire
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="animaux">
									<i class="fa fa-fw fa-square-o"></i> Animaux
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="tel_mobile">
									<i class="fa fa-fw fa-square-o"></i> Téléphone mobile
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="tel_fixe">
									<i class="fa fa-fw fa-square-o"></i> Téléphone fixe
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="tel_fax">
									<i class="fa fa-fw fa-square-o"></i> Fax
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="date_in">
									<i class="fa fa-fw fa-square-o"></i> Date d'inscription
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="last_date_r">
									<i class="fa fa-fw fa-square-o"></i> Date du dernier email reçu
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="last_date_o">
									<i class="fa fa-fw fa-square-o"></i> Date du dernier email ouvert
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="last_date_c">
									<i class="fa fa-fw fa-square-o"></i> Date du dernier email cliqué
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="last_date_s">
									<i class="fa fa-fw fa-square-o"></i> Date du dernier email envoyé
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="blacklist">
									<i class="fa fa-fw fa-square-o"></i> Blacklisté
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="statut">
									<i class="fa fa-fw fa-square-o"></i> Statut
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="dep">
									<i class="fa fa-fw fa-square-o"></i> Département
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="tranche">
									<i class="fa fa-fw fa-square-o"></i> Tranche d'âge
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="nettoyage_date">
									<i class="fa fa-fw fa-square-o"></i> Date du nettoyage
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="nettoyage_result">
									<i class="fa fa-fw fa-square-o"></i> Résultat du nettoyage
								</label><br />
								<label class="checkbox-custom"> 
								<input type="checkbox" name="requies[]" value="troncon">
									<i class="fa fa-fw fa-square-o"></i> Troncon
								</label><br />
							</td>
						</tr>
					</table>
				</div>






				<div class="widget-head">
					<h4 class="heading glyphicons calendar"><i></i>Dates</h4>
					<!--<span class="badge badge-info" id="search-add"><i class="fa fa-plus"></i></span>-->
				</div>

				<div class="widget-body" id="dates">
					<table class="search_date">
						<tr>
							<td>
								<div class="checkbox">
									<label class="checkbox-custom"> 
										<input type="checkbox" name="inscris_bool" value="yes">
										<i class="fa fa-fw fa-square-o"></i> Inscris
									</label>
								</div>
							</td>
							<td>à moins de</td>
							<td><input name="inscris_int" type="text" class="form-control input-lg" placeholder="X"></td>
							<td>
								<select name="inscris_date" class="form-control input-lg" id="inscris_date">
									<option value="day">Jours</option>
									<option value="week">Semaines</option>
									<option value="month">Mois</option>
								</select>
							</td>
						</tr>
					</table>

					<table class="search_date">
						<tr>
							<td>
								<div class="checkbox">
									<label class="checkbox-custom"> 
										<input type="checkbox" name="ouvreurs_bool" value="yes">
										<i class="fa fa-fw fa-square-o"></i> Ouvreurs
									</label>
								</div>
							</td>
							<td>à moins de</td>
							<td><input name="ouvreurs_int" type="text" class="form-control input-lg" placeholder="X"></td>
							<td>
								<select name="ouvreurs_date" class="form-control input-lg" id="ouvreurs_date">
									<option value="day">Jours</option>
									<option value="week">Semaines</option>
									<option value="month">Mois</option>
								</select>
							</td>
						</tr>
					</table>

					<table class="search_date">
						<tr>
							<td>
								<div class="checkbox">
									<label class="checkbox-custom"> 
										<input type="checkbox" name="receveurs_bool" value="yes">
										<i class="fa fa-fw fa-square-o"></i> Receveurs
									</label>
								</div>
							</td>
							<td>à moins de</td>
							<td><input name="receveurs_int" type="text" class="form-control input-lg" placeholder="X"></td>
							<td>
								<select name="receveurs_date" class="form-control input-lg" id="receveurs_date">
									<option value="day">Jours</option>
									<option value="week">Semaines</option>
									<option value="month">Mois</option>
								</select>
							</td>
						</tr>
					</table>

					<table class="search_date">
						<tr>
							<td>
								<div class="checkbox">
									<label class="checkbox-custom"> 
										<input type="checkbox" name="cliqueurs_bool" value="yes">
										<i class="fa fa-fw fa-square-o"></i> Cliqueurs
									</label>
								</div>
							</td>
							<td>à moins de</td>
							<td><input name="cliqueurs_int" type="text" class="form-control input-lg" placeholder="X"></td>
							<td>
								<select name="cliqueurs_date" class="form-control input-lg" id="cliqueurs_date">
									<option value="day">Jours</option>
									<option value="week">Semaines</option>
									<option value="month">Mois</option>
								</select>
							</td>
						</tr>
					</table>
					<hr />
					<div id="search-date-ins">
						<div class="col-sm-4 search-txt">Date d'inscription est</div>
						<div class="col-sm-3">
							<select name="date-regle-ins" class="form-control input-lg" id="date-regle-ins">
								<option value="" class="date-value-ins"></option>
								<option value="date-def-ins" class="date-value-ins">Défini</option>
								<option value="date-vid-ins" class="date-value-ins">Vide</option>
								<option value="date-ega-ins" class="date-value-ins">Égal à</option>
								<option value="date-dif-ins" class="date-value-ins">Différent de</option>
								<option value="date-inf-ins" class="date-value-ins">Inférieur à</option>
								<option value="date-sup-ins" class="date-value-ins">Supérieur à</option>
								<option value="date-ent-ins" id="date-between-ins">Entre</option>
							</select>
						</div>
						<div class="col-sm-2">
							<input name="date1-ins" type="text" id="date1-ins" class="form-control input-lg search-date" placeholder="Date">
						</div>
						<div class="col-sm-1 search-txt none-ins">et</div>
						<div class="col-sm-2 none-ins">
							<input name="date2-ins" type="text" id="date2-ins" class="form-control input-lg search-date" placeholder="Date">
						</div>
					</div>

					<div id="search-date-ouv">
						<div class="col-sm-4 search-txt">Date d'ouverture est</div>
						<div class="col-sm-3">
							<select name="date-regle-ouv" class="form-control input-lg" id="date-regle-ouv">
								<option value="" class="date-value-ouv"></option>
								<option value="date-def-ouv" class="date-value-ouv">Défini</option>
								<option value="date-vid-ouv" class="date-value-ouv">Vide</option>
								<option value="date-ega-ouv" class="date-value-ouv">Égal à</option>
								<option value="date-dif-ouv" class="date-value-ouv">Différent de</option>
								<option value="date-inf-ouv" class="date-value-ouv">Inférieur à</option>
								<option value="date-sup-ouv" class="date-value-ouv">Supérieur à</option>
								<option value="date-ent-ouv" id="date-between-ouv">Entre</option>
							</select>
						</div>
						<div class="col-sm-2">
							<input name="date1-ouv" type="text" id="date1-ouv" class="form-control input-lg search-date" placeholder="Date">
						</div>
						<div class="col-sm-1 search-txt none-ouv">et</div>
						<div class="col-sm-2 none-ouv">
							<input name="date2-ouv" type="text" id="date2-ouv" class="form-control input-lg search-date" placeholder="Date">
						</div>
					</div>

					<div id="search-date-env">
						<div class="col-sm-4 search-txt">Date d'envoi est</div>
						<div class="col-sm-3">
							<select name="date-regle-env" class="form-control input-lg" id="date-regle-env">
								<option value="" class="date-value-env"></option>
								<option value="date-def-env" class="date-value-env">Défini</option>
								<option value="date-vid-env" class="date-value-env">Vide</option>
								<option value="date-ega-env" class="date-value-env">Égal à</option>
								<option value="date-dif-env" class="date-value-env">Différent de</option>
								<option value="date-inf-env" class="date-value-env">Inférieur à</option>
								<option value="date-sup-env" class="date-value-env">Supérieur à</option>
								<option value="date-ent-env" id="date-between-env">Entre</option>
							</select>
						</div>
						<div class="col-sm-2">
							<input name="date1-env" type="text" id="date1-env" class="form-control input-lg search-date" placeholder="Date">
						</div>
						<div class="col-sm-1 search-txt none-env">et</div>
						<div class="col-sm-2 none-env">
							<input name="date2-env" type="text" id="date2-env" class="form-control input-lg search-date" placeholder="Date">
						</div>
					</div>

					<div id="search-date-cli">
						<div class="col-sm-4 search-txt">Date de clic est</div>
						<div class="col-sm-3">
							<select name="date-regle-cli" class="form-control input-lg" id="date-regle-cli">
								<option value="" class="date-value-cli"></option>
								<option value="date-def-cli" class="date-value-cli">Défini</option>
								<option value="date-vid-cli" class="date-value-cli">Vide</option>
								<option value="date-ega-cli" class="date-value-cli">Égal à</option>
								<option value="date-dif-cli" class="date-value-cli">Différent de</option>
								<option value="date-inf-cli" class="date-value-cli">Inférieur à</option>
								<option value="date-sup-cli" class="date-value-cli">Supérieur à</option>
								<option value="date-ent-cli" id="date-between-cli">Entre</option>
							</select>
						</div>
						<div class="col-sm-2">
							<input name="date1-cli" type="text" id="date1-cli" class="form-control input-lg search-date" placeholder="Date">
						</div>
						<div class="col-sm-1 search-txt none-cli">et</div>
						<div class="col-sm-2 none-cli">
							<input name="date2-cli" type="text" id="date2-cli" class="form-control input-lg search-date" placeholder="Date">
						</div>
					</div>
				</div>

				<div class="widget-head">
					<h4 class="heading glyphicons globe"><i></i>Pays / Départements</h4>
				</div>

				<div class="widget-body">
					<input type="hidden" name="input_cp" id="input_cp" />
					<input type="text" name="input_dep" id="input_dep" class="form-control input-lg" disabled />
<!--					<div id="map_dep"></div>-->

					<table class="half">
						<tr>
							<th>Pays</th>
							<th>Départements</th>
						</tr>
						<tr>
							<td>
								<select multiple id="multiselect" class="multiselect" name="pays[]">
									<?php
										$requete = "SELECT pays, extension FROM search_pays ORDER BY pays ASC";
										$result = $bdd->executeQueryRequete($requete, 1);

										while( $pays = $result->fetch() ) {
											echo '<option value="'.$pays->extension.'">'.$pays->pays.'</option>';
										}
									?>
								</select>

								<h5>Autre pays</h5>
								<input type="hidden" id="autre_pays" name="autre_pays" class="multiinput" style="width: 90%; height:20%" />
							</td>
							<td>
								<select multiple id="" class="multiselect" name="geoloc[]">
									<option value="01">01 Ain</option>
									<option value="02">02 Aisne</option>
									<option value="03">03 Allier</option>
									<option value="04">04 Alpes-de-Haute-Provence</option>
									<option value="05">05 Hautes-Alpes</option>
									<option value="06">06 Alpes-Maritimes</option>
									<option value="07">07 Ardèche</option>
									<option value="08">08 Ardennes</option>
									<option value="09">09 Ariège</option>
									<option value="10">10 Aube</option>
									<option value="11">11 Aude</option>
									<option value="12">12 Aveyron</option>
									<option value="13">13 Bouches-du-Rhône</option>
									<option value="14">14 Calvados</option>
									<option value="15">15 Cantal</option>
									<option value="16">16 Charente</option>
									<option value="17">17 Charente-Maritime</option>
									<option value="18">18 Cher</option>
									<option value="19">19 Corrèze</option>
									<option value="2A">2A Corse-du-Sud</option>
									<option value="2B">2B Haute-Corse</option>
									<option value="21">21 Côte-d'Or</option>
									<option value="22">22 Côtes-d'Armor</option>
									<option value="23">23 Creuse</option>
									<option value="24">24 Dordogne</option>
									<option value="25">25 Doubs</option>
									<option value="26">26 Drôme</option>
									<option value="27">27 Eure</option>
									<option value="28">28 Eure-et-Loir</option>
									<option value="29">29 Finistère</option>
									<option value="30">30 Gard</option>
									<option value="31">31 Haute-Garonne</option>
									<option value="32">32 Gers</option>
									<option value="33">33 Gironde</option>
									<option value="34">34 Hérault</option>
									<option value="35">35 Ille-et-Vilaine</option>
									<option value="36">36 Indre</option>
									<option value="37">37 Indre-et-Loire</option>
									<option value="38">38 Isère</option>
									<option value="39">39 Jura</option>
									<option value="40">40 Landes</option>
									<option value="41">41 Loir-et-Cher</option>
									<option value="42">42 Loire</option>
									<option value="43">43 Haute-Loire</option>
									<option value="44">44 Loire-Atlantique</option>
									<option value="45">45 Loiret</option>
									<option value="46">46 Lot</option>
									<option value="47">47 Lot-et-Garonne</option>
									<option value="48">48 Lozère</option>
									<option value="49">49 Maine-et-Loire</option>
									<option value="50">50 Manche</option>
									<option value="51">51 Marne</option>
									<option value="52">52 Haute-Marne</option>
									<option value="53">53 Mayenne</option>
									<option value="54">54 Meurthe-et-Moselle</option>
									<option value="55">55 Meuse</option>
									<option value="56">56 Morbihan</option>
									<option value="57">57 Moselle</option>
									<option value="58">58 Nièvre</option>
									<option value="59">59 Nord</option>
									<option value="60">60 Oise</option>
									<option value="61">61 Orne</option>
									<option value="62">62 Pas-de-Calais</option>
									<option value="63">63 Puy-de-Dôme</option>
									<option value="64">64 Pyrénées-Atlantiques</option>
									<option value="65">65 Hautes-Pyrénées</option>
									<option value="66">66 Pyrénées-Orientales</option>
									<option value="67">67 Bas-Rhin</option>
									<option value="68">68 Haut-Rhin</option>
									<option value="69">69 Rhône</option>
									<option value="70">70 Haute-Saône</option>
									<option value="71">71 Saône-et-Loire</option>
									<option value="72">72 Sarthe</option>
									<option value="73">73 Savoie</option>
									<option value="74">74 Haute-Savoie</option>
									<option value="75">75 Paris</option>
									<option value="76">76 Seine-Maritime</option>
									<option value="77">77 Seine-et-Marne</option>
									<option value="78">78 Yvelines</option>
									<option value="79">79 Deux-Sèvres</option>
									<option value="80">80 Somme</option>
									<option value="81">81 Tarn</option>
									<option value="82">82 Tarn-et-Garonne</option>
									<option value="83">83 Var</option>
									<option value="84">84 Vaucluse</option>
									<option value="85">85 Vendée</option>
									<option value="86">86 Vienne</option>
									<option value="87">87 Haute-Vienne</option>
									<option value="88">88 Vosges</option>
									<option value="89">89 Yonne</option>
									<option value="90">90 Territoire de Belfort</option>
									<option value="91">91 Essonne</option>
									<option value="92">92 Hauts-de-Seine</option>
									<option value="93">93 Seine-Saint-Denis</option>
									<option value="94">94 Val-de-Marne</option>
									<option value="95">95 Val-d'Oise</option>
								</select>

								<h5>Code postal</h5>
								<input type="hidden" id="postal" name="postal" class="multiinput" style="width: 90%;" />
							</td>
						</tr>
					</table>
				</div>



				<div class="widget-head">
					<h4 class="heading glyphicons beer"><i></i>Centres d'intérêts</h4>
				</div>

				<div class="widget-body">
					<select multiple id="" class="multiselect" name="affinite[]">
						<?php
						$requete = "SELECT id, nom FROM gestion_thematique ORDER BY nom";
						$result = $bdd->executeQueryRequete($requete, 1);

						while( $thematique = $result->fetch() ) {
							echo '<option value="'.$thematique->id.'">'.$thematique->nom.'</option>';
						}
						?>
					</select>
				</div>




				<div class="widget-head">
					<h4 class="heading glyphicons server"><i></i>Domaines</h4>
				</div>

				<div class="widget-body">
					<div class="checkbox">
						<label class="checkbox-custom"> 
							<input type="checkbox" name="topDomaine" value="yes" checked="checked">
							<i class="fa fa-fw fa-square-o checked"></i> Top domaine uniquement.
						</label> 
					</div>

					<input name="occurrence" type="hidden" id="occurrence">

					<div class="widget widget-heading-simple widget-body-gray">
						<div class="widget-body" id="occurrence-slider">
							<div class="slider-range-min row form-horizontal">
								<div class="col-md-3">
									<div class="control-group">
										<label class="col-md-8 control-label">Occurrence < ou = à:</label> 
										<div class="col-md-4 padding-none">
											<input type="text" class="amount form-control" />
										</div>
									</div>
								</div>
								<div class="col-md-9" style="padding-top: 9px;">
									<div class="slider slider-primary"></div>
								</div>
							</div>
						</div>
					</div>

					<table class="half">
						<tr>
							<th>Exclusion</th>
							<th>Inclusion</th>
						</tr>
						<tr>
							<td>
								<select multiple class="multiselect" name="domaine_exclu[]">
									<option value="wanadoo.fr">wanadoo.fr</option>
									<option value="yahoo.fr">yahoo.fr</option>
									<option value="orange.fr">orange.fr</option>
									<option value="gmail.com">gmail.com</option>
									<option value="free.fr">free.fr</option>
									<option value="laposte.net">laposte.net</option>
									<option value="neuf.fr">neuf.fr</option>
									<option value="sfr.fr">sfr.fr</option>
									<option value="yahoo.com">yahoo.com</option>
									<option value="aliceadsl.fr">aliceadsl.fr</option>
									<option value="voila.fr">voila.fr</option>
									<option value="club-internet.fr">club-internet.fr</option>
									<option value="bbox.fr">bbox.fr</option>
									<option value="numericable.fr">numericable.fr</option>
									<option value="noos.fr">noos.fr</option>
								</select>

								<input type="hidden" id="autre_domaines_exclu" name="autre_domaines_exclu" class="multiinp^[1-9]{1,}ut" style="width: 90%;" />
							</td>
							<td>
								<select multiple class="multiselect" name="domaine_inclu[]">
									<option value="wanadoo.fr">wanadoo.fr</option>
									<option value="yahoo.fr">yahoo.fr</option>
									<option value="orange.fr">orange.fr</option>
									<option value="gmail.com">gmail.com</option>
									<option value="free.fr">free.fr</option>
									<option value="laposte.net">laposte.net</option>
									<option value="neuf.fr">neuf.fr</option>
									<option value="sfr.fr">sfr.fr</option>
									<option value="yahoo.com">yahoo.com</option>
									<option value="aliceadsl.fr">aliceadsl.fr</option>
									<option value="voila.fr">voila.fr</option>
									<option value="club-internet.fr">club-internet.fr</option>
									<option value="bbox.fr">bbox.fr</option>
									<option value="numericable.fr">numericable.fr</option>
									<option value="noos.fr">noos.fr</option>
								</select>

								<input type="hidden" id="autre_domaines_inclu" name="autre_domaines_inclu" class="multiinput" style="width: 90%;" />
							</td>
						</tr>
					</table>
				</div>

				<div id="input_search_submit" style="clear:both;">
					<input type="submit" value="Enregistrer le comptage" class="btn btn-info" />
				</div>
			</form>
		</div>
	</div>

	<div id="alert_msg">
		<span id="msg_echec" class="btn btn-danger" data-layout="top" data-type="error" data-toggle="notyfy"></span>
	</div>
</div>

<div id="requete-count">
	<p></p>
</div>
<div id="volume">
	<p class="odometer">0</p>
</div>

<script type="text/javascript">
	$(window).load(function() {
		$("#age_min").val($("div#rangeSlider div.ui-rangeSlider-leftLabel div.ui-rangeSlider-label-value").text());
		$("#age_max").val($("div#rangeSlider div.ui-rangeSlider-rightLabel div.ui-rangeSlider-label-value").text());
	});

	$(document).ready(function() {
		$("#date-between-ins").click(function() {
			$(".none-ins").css("display", "block");
		});
		$(".date-value-ins").click(function() {
			$("#date2-ins").val("");
			$(".none-ins").css("display", "none");
		});

		$("#date-between-ouv").click(function() {
			$(".none-ouv").css("display", "block");
		});
		$(".date-value-ouv").click(function() {
			$("#date2-ouv").val("");
			$(".none-ouv").css("display", "none");
		});

		$("#date-between-env").click(function() {
			$(".none-env").css("display", "block");
		});
		$(".date-value-env").click(function() {
			$("#date2-env").val("");
			$(".none-env").css("display", "none");
		});

		$("#date-between-cli").click(function() {
			$(".none-cli").css("display", "block");
		});
		$(".date-value-cli").click(function() {
			$("#date2-cli").val("");
			$(".none-cli").css("display", "none");
		});

		//-----------------------------------------

		$('input[type=checkbox], input[type=radio], select').on("change", function() {
			ajaxRequest();
		});

		$('input[type=text]').on("keyup", function() {
			ajaxRequest();
		});

        $('input[type = hidden]').on("change", function(){
            // var countries = $('#post').val();
            // alert('les pays saisies:' +countries);
            ajaxRequest();
        });

		$('#age, #age-slider, #occurrence, #occurrence-slider').on("mouseup", function() {
			$("#age_min").val($("div#rangeSlider div.ui-rangeSlider-leftLabel div.ui-rangeSlider-label-value").text());
			$("#age_max").val($("div#rangeSlider div.ui-rangeSlider-rightLabel div.ui-rangeSlider-label-value").text());
			
			ajaxRequest();
		});

		//-----------------------------------------

		$('#map_dep').vectorMap({
		    map: 'france_fr',
			hoverOpacity: 0.5,
			hoverColor: false,
			backgroundColor: "transparent",
			colors: couleurs,
			borderColor: "#000000",
			enableZoom: true,
			showTooltip: true,
		    onRegionClick: function(element, code, region) {
		        if( $("#input_cp").val() == "" ) {
					$("#input_cp").val(code);
					$("#input_dep").val(code+' ('+region+')');
		        } else {
					if( $("#input_cp").val().search(code) < 0 ) {
						$("#input_cp").val($("#input_cp").val()+','+code);
						$("#input_dep").val($("#input_dep").val()+', '+code+' ('+region+')');
					} else {
						$("#input_cp").val( $("#input_cp").val().replace(','+code, '') );
						$("#input_cp").val( $("#input_cp").val().replace(code+',', '') );
						$("#input_cp").val( $("#input_cp").val().replace(code, '') );

						$("#input_dep").val( $("#input_dep").val().replace(', '+code+' ('+region+')', '') );
						$("#input_dep").val( $("#input_dep").val().replace(code+' ('+region+')'+', ', '') );
						$("#input_dep").val( $("#input_dep").val().replace(code+' ('+region+')', '') );
					}
		        }

		        ajaxRequest();
		    }
		});
	});

	function ajaxRequest() {
		$.ajax ({
		    url: "count_b2c.php",
		    type: "post",
		    data: $("#form_search_db").serialize(),

		    complete: function (xhr, result) {
		    	var print = xhr.responseText.split("|");
                // alert(xhr.responseText.split("|"))
		    	$("#requete-count p").html(print[0]);
                // var odometer = parseInt(print[1])
		    	$(".odometer").html(parseInt(print[1]));
                 // alert("mon comptage: "+ odometer)
		    }
		});
	}
</script>

<?php require_once("../../footer.php"); ?>