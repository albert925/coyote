<?php
	include '../../../config.php';
	$idR=$_POST['fma'];//id marca
	$b=$_POST['fmb'];//nombre
	$c=$_POST['fmc'];//tipo producto
	if ($idR=="" || $b=="" || $c=="" || $c=="0") {
		echo "1";
	}
	else{
		$modificar="UPDATE marca set tipo_id=$c,nam_mk='$b' where id_mk=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>