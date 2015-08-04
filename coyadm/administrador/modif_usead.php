<?php
	include '../../config.php';
	$idR=$_POST['fa'];
	$usR=$_POST['fb'];
	if ($idR=="" || $usR=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from administrador where us_adm='$usR'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2";
		}
		else{
			$modificar="UPDATE administrador set us_adm='$usR' where id_admin=$idR";
			mysql_query($modificar,$conexion) or die (mysql_error());
			echo "3";
		}
	}
?>