<?php
	include '../config.php';
	$idr=$_POST['cd'];
	$pasA=$_POST['pa'];
	$pasN=$_POST['pb'];
	if ($idr=="" || $pasA=="" || $pasN=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from usuario where id_us=$idr and password_us='$pasA'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			$modificar="UPDATE usuario set password_us='$pasN' where id_us=$idr";
			mysql_query($modificar,$conexion) or die (mysql_error());
			echo "3";
		}
		else{
			echo "2";
		}
	}
?>