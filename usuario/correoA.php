<?php
	include '../config.php';
	$codiR=$_GET['codC'];
	$idR=$_GET['di'];
	function rand_code($chars,$long)
	{
		$code="";
		for ($x=0; $x <=$long ; $x++) { 
			$rand=rand(1,strlen($chars));
			$code.=substr($chars, $rand,1);
		}
		return $code;
	}
	if ($codiR=="" || $idR=="") {
		echo "<script>";
			echo "alert('codigo o id no disponible');";
			echo "var pag='../';";
			echo "document.location.href=pag;";
		echo "</script>";
	}
	else{
		$existe="SELECT * from usuario where id_us=$idR and cod_us='$codiR'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			$caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012456789";
			$longitud=20;
			$codigoal=rand_code($caracteres,$longitud);
			$colocar="UPDATE usuario set cod_us='$codigoal' where id_us=$idR";
			mysql_query($colocar,$conexion) or die (mysql_error());
			$datusers="SELECT * from usuario where id_us=$idR";
			$sql_usdat=mysql_query($datusers,$conexion) or die (mysql_error());
			while ($dau=mysql_fetch_array($sql_usdat)) {
				$nmus=$dau['nam_us'];
				$apus=$dau['ape_us'];
				$corvj=$dau['correo_us'];
				$corus=$dau['corcab_us'];
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
							Hola $nmus $apus para finalizar el cambio click en cambiar, del correo anterior $corvj.
						</p>
						<p>
							Link de activación: 
							<a style='padding: 0.5em 1em;background: #222222;color:#fff;text-decoration: none;' 
								href='http://conaxport.com/coyote/usuario/correoB.php?codC=$codigoal&di=$idR' target='_blank'>
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
			$mail->Subject = "Cambio de correo 2";
			$mail->AltBody = "Cuerpo alternativo del mensaje";
			$mail->CharSet = 'UTF-8';
			$mail->MsgHTML($body);
			if(!$mail->Send()) {
				//echo "Error al enviar el mensaje: " . $mail­>ErrorInfo;
				echo "<script>";
					echo "alert('Error al enviar el mensaje');";
					echo "var pag='../';";
					echo "document.location.href=pag;";
				echo "</script>";
			} 
			else {
				echo "<script>";
					echo "var pag='rescroA.php?dat=3';";
					echo "document.location.href=pag;";
				echo "</script>";
			}
		}
		else{
			echo "<script>";
				echo "var pag='rescroA.php?dat=2';";
				echo "document.location.href=pag;";
			echo "</script>";
		}
	}
?>