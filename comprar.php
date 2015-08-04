<?php
	include 'config.php';
	session_start();
	if (isset($_SESSION['us'])) {
		$usR=$_SESSION['us'];
		$datosusuario="SELECT * from usuario where id_us=$usR";
		$sql_user=mysql_query($datosusuario,$conexion) or die (mysql_error());
		while ($ss=mysql_fetch_array($sql_user)) {
			$idus=$ss['id_us'];
			$nmus=$ss['nam_us'];
			$apus=$ss['ape_us'];
			$corus=$ss['correo_us'];
			$telus=$ss['telefono_us'];
			$celus=$ss['celular_us'];
			$paisus=$ss['pais_id'];
			$ciudus=$ss['ciudad_id'];
			$dirus=$ss['direccion_us'];
			$tipus=$ss['tip_us'];
			$estus=$ss['estd_us'];
		}
		$Ttotal=$_GET['tot'];
		if ($Ttotal=="") {
			echo "<script type='text/javascript'>";
				echo "alert('Total en blanco');";
				echo "var pagina='carritoC.php';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$hoy=date("Y-m-d H:i:s");
			$arreglo=$_SESSION['carrito'];
			$numregistro=0;
			$nv="SELECT * from factura order by n_vent desc limit 1";
			$sqlnv=mysql_query($nv,$conexion) or die(mysql_error());
			while ($nr=mysql_fetch_array($sqlnv)) {
				$numregistro=$nr['n_vent'];
			}
			if ($numregistro==0) {
				$numregistro=1;
			}
			else{
				$numregistro=$numregistro+1;
			}
			for ($i=0; $i <count($arreglo) ; $i++) { 
				$a=$arreglo[$i]['Id'];
				$b=$arreglo[$i]['Nomb'];
				$c=$arreglo[$i]['Prec'];
				$d=$arreglo[$i]['Imag'];
				$e=$arreglo[$i]['Cant'];
				$f=$arreglo[$i]['Tll'];
				$hcolor=$arreglo[$i]['CLR'];
				$g=($c*$e);
				$ingresar="INSERT into factura(fec_f,n_vent,producto_id,usuario_id,talla_f,color_f,cant_f,
					subt_f,total_f,estd_f) 
					values('$hoy','$numregistro',$a,$idus,'$f','$hcolor','$e',$g,$Ttotal,'1')";
				mysql_query($ingresar,$conexion) or die (mysql_error());
			}
			include 'miler/class.phpmailer.php';
			$mail=new PHPMailer();
			$body="<section style='margin:0 auto;max-width:1100px;'>
				<header>
					<figure>
						<img src='http://conaxport.com/coyote/imagenes/logo.png' alt='logo' width='40%' />
					</figure>
					<h1>Compra de $nmus del id: $idus</h1>
				</header>
				<section>
					<article>
						<p>
							El usuario ha cotizado unos productos, ingrese a la pagina de administración 
							de coyote store en la pestaña Ventas para ver que productos solicitó.
						</p>
						<h2>Información del usuario</h2>
						<p>
							<b>Nombre: </b>$nmus<br />
							<b>Telefono: </b>$telus/$celus<br />
							<b>Correo: </b>$corus<br/>
						</p>
					</article>
					<article>
						<a herf='http://conaxport.com/coyote/'>Página</a>
					</article>
				</section>
			</section>";
			$mail->SetFrom('$corus','$nmus');
			$mail->From = "$corus";
			$mail->FromName = "$nmus";
			$mail->AddReplyTo('$corus','$nmus');
			$address="albertarias925@gmail.com";
			$mail->AddAddress($address, "Coyote Store");
			$mail->AddAddress("contacto@coyotestore.com", "Coyote Store");
			$mail->AddAddress('albertarias925@outlook.com','Coyote Store');
			$mail->Subject = "Compra solicitada";
			$mail->AltBody = "Cuerpo alternativo del mensaje";
			$mail->CharSet = 'UTF-8';
			$mail->MsgHTML($body);
			if(!$mail->Send()) {
				echo "Error al enviar el mensaje: " . $mail­>ErrorInfo;
				unset($_SESSION['carrito']);
				echo "<script>";
					echo "alert('Error al enviar el mensaje');";
					echo "var pag='factura';";
					echo "document.location.href=pag;";
				echo "</script>";
			} 
			else {
				unset($_SESSION['carrito']);
				echo "<script>";
					echo "alert('Solicitud realizada');";
					echo "var pag='factura';";
					echo "document.location.href=pag;";
				echo "</script>";
			}
		}
	}
	else{
		echo "<script type='text/javascript'>";
			echo "alert('Sesion caducada');";
			echo "var pagina='registro';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>