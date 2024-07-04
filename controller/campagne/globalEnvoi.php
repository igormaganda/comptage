<?php
	print_r($_REQUEST);

	require_once("partials/class/Bdd.php");
	$bdd = new Bdd();


	// Campagnes envoyées ou non
	switch ($_REQUEST["form-cmp-1"]) {
		case 'cmp1':
			$campagnes = "";
			break;
		
		case 'cmp2':
			$campagnes = " AND status='Rien'";
			break;

		case 'cmp3':
			$campagnes = " AND (status='En cours' OR status='Envoyé')";
			break;

		default:
			$campagnes = "";
			break;
	}

	// Order
	switch ($_REQUEST["form-cmp-4"]) {
		case 'cmp1':
			$order = "volume DESC";
			break;
		
		case 'cmp2':
			$order = "volume ASC";
			break;

		default:
			$order = "id";
			break;
	}

	// Récupération des infos
	echo $requete = "SELECT campagne.id, envoi, reference, route, status, volume, cible
				FROM campagne, campagne_send
				WHERE this='".$_REQUEST["form-cmp-0"]."'
				AND campagne.id=campagne_send.id_campagne
				$campagnes
				AND volume>".$_REQUEST["form-cmp-2"]."
				ORDER BY $order";

	$heure = $_REQUEST["form-cmp-3"];
	$q = $bdd->executeQueryRequete($requete, 1);
	while( $r = $q->fetch() ) {

		$requete = "INSERT INTO send_daemon(
						date,
						reference,
						route,
						cible,
						id_campagne,
						go
					) VALUES (
						(NOW()::timestamp + '$heure hour'::interval),
						'$r->reference',
						'$r->route',
						'$r->cible',
						$r->id,
						0
					)";

		$heure+=$_REQUEST["form-cmp-3"];

		if($bdd->executeSimpleExecRequete($requete)) {
			$requeteUpdateStatut = "UPDATE campagne SET status='En cours' WHERE id='$r->id'";
			$bdd->executeSimpleExecRequete($requeteUpdateStatut);
		}

	}
?>