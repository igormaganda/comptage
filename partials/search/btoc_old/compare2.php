<?php
	require_once("../../../sdatamart/lib/system_load.php");
	authenticate_user('all');
	require_once("../../header.php");
	require_once("partials/class/Bdd.php");
	require_once("partials/class/Upload.php");

	$bdd    = new Bdd();
	$upload = new Upload($_POST, $_FILES['csv']);
	$upload->uploadFile(2); // Comparaison
?>

<div id="content">
	<div class="widget">
		<div class="widget-body innerAll inner-2x">
			<div class="form-group">
				<?php echo $upload->msg["upload"]; ?>

				<div class="widget-body center" id="b2">
					<h5>B2C / B2B</h5>
					<div class="radio">
						<label class="radio-custom">
							<input type="radio" name="b2b-b2c" value="0" checked="checked"> 
							<i class="fa fa-circle-o checked"></i> B2C
						</label> 
					</div> 
					<div class="radio"> 
						<label class="radio-custom"> 
							<input type="radio" name="b2b-b2c" value="1"> 
							<i class="fa fa-circle-o"></i> B2B
						</label> 
					</div> 
				</div>

				<div class="widget-body center" id="download">
					<h5>Contenu des fichiers</h5>
					<div class="radio">
						<label class="radio-custom">
							<input type="radio" name="download" value="0" checked="checked"> 
							<i class="fa fa-circle-o checked"></i> Tous les champs
						</label> 
					</div> 
					<div class="radio"> 
						<label class="radio-custom"> 
							<input type="radio" name="download" value="1"> 
							<i class="fa fa-circle-o"></i> Email seulement
						</label> 
					</div> 
				</div>

				<div class="widget-body center" id="matching">
					<h5>Matching</h5>
					<select name="matching" class="form-control input-lg" id="matching_field" required>
						<option value="null"></option>
					</select>
				</div>

				<table id="comparaison_partenaire_programme">
					<tr>
						<td class="largeur">
							<label for="comp_partenaire">Comparer avec un partenaire</label>
							<select name="comp_partenaire" class="form-control input-lg" id="comp_partenaire" required>
								<option value="null"></option>
							<?php
								$requete = "SELECT id, nom FROM gestion_partenaire ORDER BY id ASC";
								$result = $bdd->executeQueryRequete($requete, 1);

								while( $items = $result->fetch() ) {
									echo '<option value="'.$items->id.'">'.$items->nom.'</option>';
								}
							?>
							</select>
						</td>
						<td></td>
						<td class="largeur">
							<label for="comp_programme">Comparer avec un programme</label>
							<select name="comp_programme" class="form-control input-lg" id="comp_programme" required>
								<option value="null"></option>
							</select>
						</td>
					</tr>
				</table>
				<hr class="hr" />

				<?php echo $upload->msg["form"]; ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		printPart();

		$("#comp_partenaire option").click(function() {
			var data = { partenaire : $(this).val() };

			if ($(this).val() != "null") {
				$.ajax ({
				    url: "../controller/returnProgrammes.php",
				    type: "post",
				    data: data,
				    complete: function (xhr, result) {
				        if (result == "success") {
							var obj = jQuery.parseJSON( xhr.responseText );
							var result = "";

							$(obj).each(function(index) {
								result += '<option class="prog-tmp" value="'+obj[index].id+'">'+obj[index].nom+'</option>';
							});

							$(".prog-tmp").remove();
							$("#comp_programme").append(result);
				        }
				    }
				});
			}
		});

		$("#b2").change(function() {
			printPart();
		});

		$("#form_champs select.form-control").change(function() {
			$("#matching_field").append('<option value="'+$(this).val()+'">'+$(this).val()+'</option>');
		});
	});

	function printPart() {
		if ($("#b2_input").val() == 'b2b') {
			$("#comparaison_partenaire_programme").css("display", "none");
			$("#comparaison_partenaire_programme select option").removeAttr("selected");
		} else {
			$("#comparaison_partenaire_programme").css("display", "table");
		}
	}
</script>

<?php require_once("../footer.php"); ?>