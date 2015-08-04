<?php
	include '../config.php';
	$idr=$_POST['bd'];
	$corR=$_POST['cc'];
	function rand_code($chars,$long)
	{
		$code="";
		for ($x=0; $x <=$long ; $x++) { 
			$rand=rand(1,strlen($chars));
			$code.=substr($chars, $rand,1);
		}
		return $code;
	}
	if ($idr=="" || $corR=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from usuario where correo_us='$corR'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2";
		}
		else{
			$caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012456789";
			$longitud=20;
			$codigoal=rand_code($caracteres,$longitud);
			$colocar="UPDATE usuario set corcab_us='$corR',cod_us='$codigoal' where id_us=$idr";
			mysql_query($colocar,$conexion) or die (mysql_error());
			$datusers="SELECT * from usuario where id_us=$idr";
			$sql_usdat=mysql_query($datusers,$conexion) or die (mysql_error());
			while ($dau=mysql_fetch_array($sql_usdat)) {
				$nmus=$dau['nam_us'];
				$apus=$dau['ape_us'];
				$corus=$dau['correo_us'];
			}
			include '../miler/class.phpmailer.php';
			$mail=new PHPMailer();
			$body="<header>
					<figure>
						<center>
							<img src='http://conaxport.com/coyote/imagenes/logo.png' alt='logo' width='40%' />
						</center>
					</figure>
					<h1>Cambio de correo electronico Coyote Store</h1>
				</header>
				<section>
					<article>
						<p>
							Hola $nmus $apus has solicitado cambio de correo de la pagina coyote store, 
							para cambiar el correo nuevo $corR; click en cambiar.
						</p>
						<p>
							Link de activación: 
							<a style='padding: 0.5em 1em;background: #222222;color:#fff;text-decoration: none;' 
								href='http://conaxport.com/coyote/usuario/correoA.php?codC=$codigoal&di=$idr' target='_blank'>
								Cambiar
							</a>
						</p>
					</article>
				</section>";
			$mail->SetFrom('contacto@coyotestore.com','Coyote Store');
			$mail->From = "contacto@coyotestore.com";
			$mail->FromName = "Coyote Store";
			$mail->AddReplyTo('contacto@coyotestore.com','Coyote Store');
			$address="$corus";
			$mail->AddAddress($address, "$nmus $apus");
			$mail->Subject = "Cambio de correo 1";
			$mail->AltBody = "Cuerpo alternativo del mensaje";
			$mail->CharSet = 'UTF-8';
			$mail->MsgHTML($body);
			if(!$mail->Send()) {
				echo "Error al enviar el mensaje: " . $mail­>ErrorInfo;
			} 
			else {
				echo "3";
			}
		}
	}
?>