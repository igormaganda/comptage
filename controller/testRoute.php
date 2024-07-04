<?php
	require_once("../class/Bdd.php");
	require_once("../php/PHPMailer/PHPMailerAutoload.php");

	$tabEmail = explode("\n", $_REQUEST["email"]);
	$route = $_REQUEST["route"];
	$left = $_REQUEST["from"];

	$bdd  = new Bdd();
	$mail = new PHPMailer;

	$requete = "SELECT * FROM gestion_routes WHERE id=$route";
	$result = $bdd->executeQueryRequete($requete, 1);
	while( $gestion_routes = $result->fetch() ) {
		$ip       = $gestion_routes->ip;
		$alias    = $gestion_routes->alias;
		$username = $gestion_routes->username;
		$password = $gestion_routes->password;
		$port     = $gestion_routes->port;
		$ndd      = $gestion_routes->ndd;
		$domaine  = $gestion_routes->domaine;
		$timer    = $gestion_routes->timer;
		$tls      = $gestion_routes->tls;
	}

	$requete = "SELECT nom FROM gestion_domaine WHERE id=$domaine";
	$result = $bdd->executeQueryRequete($requete, 1);
	while( $gestion_routes = $result->fetch() ) $right = $gestion_routes->nom;
	$from = $left."@".$right;

	$mail->Mailer     = "smtp";
	$mail->isSMTP();
	$mail->SMTPAuth   = true;
	$mail->SMTPDebug  = 3;
	$mail->setLanguage('fr', './PHPMailer/language/');
	$mail->CharSet    = 'UTF-8';
	$mail->Host       = $ip;
	$mail->Username   = $username;
	$mail->Password   = $password;
	$mail->SMTPSecure = $tls;
	$mail->Port       = $port;
	$mail->FromName   = "Datamart";
	$mail->isHTML(true);
	$mail->Subject    = "[DATAMART] Test route";
	$mail->From       = $from ;
	$mail->addReplyTo($from, "Datamart");
	
	// Si mailXpertise
	if($ip == 'actu-offres.com') {
		$mail->addCustomHeader("X-Account: 422");
		$mail->addCustomHeader("X-Campaign: TEST");
	}

	foreach ($tabEmail as $email)
		$mail->addAddress($email);

	$mail->Body    = "Test de la route $from via Datamart.";
	$mail->AltBody = "Test de la route $from via Datamart.";

	echo $log = "host: $ip | username: $username | password: $password | SMTPSecure: $tls | port: $port | from: $from";

	$etat = $mail->send();

	echo $bool = $etat ? "TRUE" : "FALSE";

	$requete = "UPDATE gestion_routes SET ok='$bool' WHERE id=$route";
	$bdd->executeSimpleExecRequete($requete);
?>