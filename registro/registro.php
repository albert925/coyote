<?php
	include '../config.php';
	$a=$_POST['a'];//nombre
	$b=$_POST['b'];//apellido
	$c=$_POST['c'];//correo
	$d=$_POST['d'];//contraseña
	function rand_code($chars,$long)
	{
		$code="";
		for ($x=0; $x <=$long ; $x++) { 
			$rand=rand(1,strlen($chars));
			$code.=substr($chars, $rand,1);
		}
		return $code;
	}
	if ($a=="" || $c=="" || $d=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from usuario where correo_us='$c'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2";
		}
		else{
			$caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012456789";
			$longitud=20;
			$codigoal=rand_code($caracteres,$longitud);
			$ingresar="INSERT into usuario(nam_us,ape_us,correo_us,password_us,estd_us,cod_us,tip_us) 
				values('$a','$b','$c','$d','2','$codigoal','1')";
			mysql_query($ingresar,$conexion) or die (mysql_error());
			$tomar_id="SELECT * from usuario where correo_us='$c'";
			$sql_tomar=mysql_query($tomar_id,$conexion) or die (mysql_error());
			while ($fg=mysql_fetch_array($sql_tomar)) {
				$idus=$fg['id_us'];
			}
			include '../miler/class.phpmailer.php';
			$mail=new PHPMailer();
			$body="<header>
					<figure>
						<center>
							<img src='http://conaxport.com/coyote/imagenes/logo.png' alt='logo' width='40%' />
						</center>
					</figure>
					<h1>Registro Coyote Store</h1>
				</header>
				<section>
					<article>
						<p>
							Hola $a $b te has registrado en la página de Coyote Store para 
							completar tu registro ingrese el siguiente link para activar tu cuenta.
						</p>
						<p>
							Link de activación: 
							<a style='padding: 0.5em 1em;background: #222222;color:#fff;text-decoration: none;' 
								href='http://conaxport.com/coyote/activacion.php?alg=$codigoal&di=$idus' target='_blank'>
								Terminar Registro
							</a>
						</p>
					</article>
				</section>";
			$mail->SetFrom('contacto@coyotestore.com','Coyote Store');
			$mail->From = "contacto@coyotestore.com";
			$mail->FromName = "Coyote Store";
			$mail->AddReplyTo('contacto@coyotestore.com','Coyote Store');
			$address="$c";
			$mail->AddAddress($address, "$a $b");
			$mail->Subject = "Registro";
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