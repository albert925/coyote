<?php
	include '../config.php';
	$a=$_POST['ja'];//correo
	$b=$_POST['jb'];//contraseña
	if ($a=="" || $b=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from usuario where correo_us='$a' and password_us='$b'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$Numero=mysql_num_rows($sql_existe);
		if ($Numero>0) {
			$activado="SELECT * from usuario where correo_us='$a' and estd_us='1'";
			$sql_act=mysql_query($activado,$conexion) or die (mysql_error());
			$numact=mysql_num_rows($sql_act);
			if ($numact>0) {
				while ($ig=mysql_fetch_array($sql_existe)) {
					$idus=$ig['id_us'];
				}
				session_start();
				$_SESSION['us']=$idus;
				echo "4";
			}
			else{
				echo "3";
			}
		}
		else{
			echo "2";
		}
	}
?>