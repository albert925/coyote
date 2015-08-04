<?php
	include '../../../config.php';
	$idR=$_POST['fca'];//id cliente
	$b=$_POST['fcb'];//nombre
	if ($idR=="" || $b=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE cliente set nam_cl='$b' where id_cl=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>