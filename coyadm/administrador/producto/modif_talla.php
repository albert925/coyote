<?php
	include '../../../config.php';
	$idR=$_POST['fla'];//id talla
	$b=$_POST['flb'];//nombre
	if ($idR=="" || $b=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE tallas set nam_tll='$b' where id_tll=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>