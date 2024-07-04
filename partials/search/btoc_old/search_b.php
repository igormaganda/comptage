<?php $display = true ?>

<?php 
	require_once("../../../sdatamart/lib/system_load.php");
	authenticate_user('all');
	require("../../header.php"); 
?>

<?php require("partials/class/Bdd.php"); ?>
<?php require("partials/class/Printer.php"); ?>

<div id="content">

	<!-- Modal -->
	<div class="modal fade" id="modal_export" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<form method="POST" action="export.php" id="modal_form_export">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
						<h4 class="modal-title" id="myModalLabel">Choix des champs</h4>
					</div>
					<div class="modal-body">
						<input type="hidden" name="number" value="" id="id" />
						<input type="hidden" name="nom" value="" id="nom" />
						<div class="checkbox">
							<table id="modal-check">
								<tr>
									<td>
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="email" checked="checked">
											<i class="fa fa-fw fa-square-o checked"></i> Email
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="email_md5">
											<i class="fa fa-fw fa-square-o"></i> Email MD5
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="firstname">
											<i class="fa fa-fw fa-square-o"></i> Prénom
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="lastname">
											<i class="fa fa-fw fa-square-o"></i> Nom
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="dateofbirth">
											<i class="fa fa-fw fa-square-o"></i> Date de naissance
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="agegroupe">
											<i class="fa fa-fw fa-square-o"></i> Groupe d'âge
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="adresse_1">
											<i class="fa fa-fw fa-square-o"></i> Adresse
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="adresse_2">
											<i class="fa fa-fw fa-square-o"></i> Complément d'adresse
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="pays">
											<i class="fa fa-fw fa-square-o"></i> Pays
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="cp">
											<i class="fa fa-fw fa-square-o"></i> Code postal
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="ville">
											<i class="fa fa-fw fa-square-o"></i> Ville
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="region">
											<i class="fa fa-fw fa-square-o"></i> Région
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="gender">
											<i class="fa fa-fw fa-square-o"></i> Civilité
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="title">
											<i class="fa fa-fw fa-square-o"></i> Titre
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="fonction">
											<i class="fa fa-fw fa-square-o"></i> Fonction
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="csp">
											<i class="fa fa-fw fa-square-o"></i> Catégorie Socio Professionnelle
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="parent">
											<i class="fa fa-fw fa-square-o"></i> Parent
										</label><br />
									</td>
									<td>
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="proprietaire">
											<i class="fa fa-fw fa-square-o"></i> Propriétaire
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="animaux">
											<i class="fa fa-fw fa-square-o"></i> Animaux
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="tel_mobile">
											<i class="fa fa-fw fa-square-o"></i> Téléphone mobile
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="tel_fixe">
											<i class="fa fa-fw fa-square-o"></i> Téléphone fixe
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="tel_fax">
											<i class="fa fa-fw fa-square-o"></i> Fax
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="date_in">
											<i class="fa fa-fw fa-square-o"></i> Date d'inscription
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="last_date_r">
											<i class="fa fa-fw fa-square-o"></i> Date du dernier email reçu
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="last_date_o">
											<i class="fa fa-fw fa-square-o"></i> Date du dernier email ouvert
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="last_date_c">
											<i class="fa fa-fw fa-square-o"></i> Date du dernier email cliqué
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="last_date_s">
											<i class="fa fa-fw fa-square-o"></i> Date du dernier email envoyé
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="blacklist">
											<i class="fa fa-fw fa-square-o"></i> Blacklisté
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="statut">
											<i class="fa fa-fw fa-square-o"></i> Statut
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="dep">
											<i class="fa fa-fw fa-square-o"></i> Département
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="tranche">
											<i class="fa fa-fw fa-square-o"></i> Tranche d'âge
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="nettoyage_date">
											<i class="fa fa-fw fa-square-o"></i> Date du nettoyage
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="nettoyage_result">
											<i class="fa fa-fw fa-square-o"></i> Résultat du nettoyage
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="troncon">
											<i class="fa fa-fw fa-square-o"></i> Troncon
										</label><br />
									</td>
								</tr>
							</table>
						</div>
						<label for="orderby" class="control-label">Ordonner par</label><br />
						<div class="col-sm-8">
							<select name="orderby" id="orderby" class="form-control"></select>
						</div>
						<div class="col-sm-4">
							<select name="asc" id="asc" class="form-control">
								<option value="rand">Aléatoire</option>
								<option value="asc">Croissant</option>
								<option value="desc">Décroissant</option>
							</select>
						</div>
						<br /><hr /><br />
						<input type="text" name="admin" id="admin" class="form-control" placeholder="admin" />
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
						<button type="submit" class="btn btn-success btn-sm btn-export">Exporter</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modal_groupby" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<form method="POST" action="exportGroup.php" id="modal_form_export_group">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
						<h4 class="modal-title" id="myModalLabel">Choix des champs</h4>
					</div>
					<div class="modal-body">
						<input type="hidden" name="number" value="" id="idGroup" />
						<input type="hidden" name="nom" value="" id="nomGroup" />
						<div class="checkbox">
							<table id="modal-check">
								<tr>
									<td>
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="email">
											<i class="fa fa-fw fa-square-o"></i> Email
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="email_md5">
											<i class="fa fa-fw fa-square-o"></i> Email MD5
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="firstname">
											<i class="fa fa-fw fa-square-o"></i> Prénom
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="lastname">
											<i class="fa fa-fw fa-square-o"></i> Nom
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="dateofbirth">
											<i class="fa fa-fw fa-square-o"></i> Date de naissance
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="agegroupe">
											<i class="fa fa-fw fa-square-o"></i> Groupe d'âge
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="adresse_1">
											<i class="fa fa-fw fa-square-o"></i> Adresse
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="adresse_2">
											<i class="fa fa-fw fa-square-o"></i> Complément d'adresse
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="pays">
											<i class="fa fa-fw fa-square-o"></i> Pays
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="cp">
											<i class="fa fa-fw fa-square-o"></i> Code postal
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="ville">
											<i class="fa fa-fw fa-square-o"></i> Ville
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="region">
											<i class="fa fa-fw fa-square-o"></i> Région
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="gender">
											<i class="fa fa-fw fa-square-o"></i> Civilité
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="title">
											<i class="fa fa-fw fa-square-o"></i> Titre
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="fonction">
											<i class="fa fa-fw fa-square-o"></i> Fonction
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="csp">
											<i class="fa fa-fw fa-square-o"></i> Catégorie Socio Professionnelle
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="parent">
											<i class="fa fa-fw fa-square-o"></i> Parent
										</label><br />
									</td>
									<td>
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="proprietaire">
											<i class="fa fa-fw fa-square-o"></i> Propriétaire
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="animaux">
											<i class="fa fa-fw fa-square-o"></i> Animaux
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="tel_mobile">
											<i class="fa fa-fw fa-square-o"></i> Téléphone mobile
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="tel_fixe">
											<i class="fa fa-fw fa-square-o"></i> Téléphone fixe
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="tel_fax">
											<i class="fa fa-fw fa-square-o"></i> Fax
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="date_in">
											<i class="fa fa-fw fa-square-o"></i> Date d'inscription
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="last_date_r">
											<i class="fa fa-fw fa-square-o"></i> Date du dernier email reçu
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="last_date_o">
											<i class="fa fa-fw fa-square-o"></i> Date du dernier email ouvert
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="last_date_c">
											<i class="fa fa-fw fa-square-o"></i> Date du dernier email cliqué
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="last_date_s">
											<i class="fa fa-fw fa-square-o"></i> Date du dernier email envoyé
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="blacklist">
											<i class="fa fa-fw fa-square-o"></i> Blacklisté
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="statut">
											<i class="fa fa-fw fa-square-o"></i> Statut
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="dep">
											<i class="fa fa-fw fa-square-o"></i> Département
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="tranche">
											<i class="fa fa-fw fa-square-o"></i> Tranche d'âge
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="nettoyage_date">
											<i class="fa fa-fw fa-square-o"></i> Date du nettoyage
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="nettoyage_result">
											<i class="fa fa-fw fa-square-o"></i> Résultat du nettoyage
										</label><br />
										<label class="checkbox-custom"> 
											<input type="checkbox" name="fields[]" value="troncon">
											<i class="fa fa-fw fa-square-o"></i> Troncon
										</label><br />
									</td>
								</tr>
							</table>
							<!--<br /><hr /><br />
							<input type="text" name="admin" id="admin" class="form-control" placeholder="admin" />-->
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
						<button type="submit" class="btn btn-success btn-sm btn-export">Exporter</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="alert_msg">
		<span id="msg_success" class="btn btn-success" data-layout="top" data-type="success" data-toggle="notyfy">Success</span>
		<span id="msg_echec" class="btn btn-danger" data-layout="top" data-type="error" data-toggle="notyfy">Danger</span>
		<span class="btn btn-warning" data-layout="top" data-type="warning" data-toggle="notyfy">Warning</span>
		<span class="btn btn-info" data-layout="top" data-type="information" data-toggle="notyfy">Information</span>
		<span class="btn btn-inverse" data-layout="top" data-type="confirm" data-toggle="notyfy">Confirm</span>
	</div>

	<div class="widget">
		<div class="widget-body innerAll inner-2x">
			<?php
			$display = new Printer();
			$display->printCount();
			?>
		</div>
	</div>
</div>
<?php require("../../footer.php"); ?>