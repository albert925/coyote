<?php
	include '../config.php';
	$a=$_POST['us'];
	$b=$_POST['ps'];
	if ($a=="" || $b=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from administrador where us_adm='$a' and pass_adm='$b'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$Numero=mysql_num_rows($sql_existe);
		if ($Numero>0) {
			session_start();
			$_SESSION['adm']=$a;
			echo "3";
		}
		else{
			echo "2";
		}
	}
?>