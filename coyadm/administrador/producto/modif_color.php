<?php
	include '../../../config.php';
	$idR=$_POST['colid'];//id color
	$b=$_POST['colad'];//nombre
	if ($idR=="" || $b=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE colores set nam_color='$b' where id_color=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>