<?php
	include ("../Desktop/connect_server/connect_server.php");
	$destino = $_POST['email_suscription_'];
	
	$IAm = "suscripciones@bellyrealestate.com";
	$mensaje = "Se ha suscrito exitosamente al sitio de bienes raíces <b><a href='http://www.bellyrealestate.com/'>Belly Real Estate</a></b>\n\n Para más información, no olvides visitarnos.";

	$cabeceras = 'From: ' .$IAm. "\r\n" .
    'Reply-To: '.$IAm;

    $FoundSuscriptor = $Conexion->query("SELECT * FROM suscriptions WHERE email='".$destino."';");

    if ($FoundSuscriptor->num_rows > 0){
    	echo "Exists";
    } else {
	    if ($destino != ""){
			if (mail($destino, "Belly Real Estate", $mensaje, $cabeceras)){
				if ($Conexion->query("INSERT INTO suscriptions (id, email, date_log, date_log_unix, viewed) VALUES ('','".$destino."','".date('Y-n-j')."','".time()."','No');")){
					echo "OK";
				}
			}
	    }
    }

?>