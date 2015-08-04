<?php
	include '../../../config.php';
	$idR=$_POST['fta'];//id cliente
	$b=$_POST['ftb'];//nombre
	if ($idR=="" || $b=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE tipo_producto set nam_tipo='$b' where id_tipo=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>