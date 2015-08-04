<?php
	include '../config.php';
	$a=$_POST['a'];//nombre
	$b=$_POST['b'];//correo
	$c=$_POST['c'];//asunto
	$d=$_POST['d'];//mensaje
	if ($a=="" || $b=="" || $c=="" || $d=="") {
		echo "1";
	}
	else{
		include '../miler/class.phpmailer.php';
		$mail=new PHPMailer();
		$body="<section style='max-width:1100px;'>
			<header>
				<figure>
					<img src='http://conaxport.com/coyote/imagenes/logo.png' width='100%' alt='logo' />
				</figure>
				<h1>Contacto de $a</h1>
			</header>
			<section>
				<article>
					<p>
						<b>Nombre:</b> $a<br />
						<b>Correo:</b> $b<br />
					</p>
					<p>
						$d
					</p>
				</article>
				<article>
					<a herf='http://conaxport.com/' target='_blank'>Página</a>
				</article>
			</section>
		</section>";
		$mail->SetFrom('$b','$a');
		$mail->From = "$b";
		$mail->FromName = "$a";
		$mail->AddReplyTo('$b','$a');
		$address="coyotestore@coyotestore.com.co";
		$mail->AddAddress($address, "Coyote Store");
		$mail->AddAddress("albertarias925@gmail.com", "Coyote Store");
		$mail->Subject = "$c";
		$mail->AltBody = "Cuerpo alternativo del mensaje";
		$mail->CharSet = 'UTF-8';
		$mail->MsgHTML($body);
		if(!$mail->Send()) {
			echo "Error al enviar el mensaje: " . $mail­>ErrorInfo;
		} 
		else {
			echo "2";
		}
	}
?>