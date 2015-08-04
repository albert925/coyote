<?php
	include '../../../config.php';
	$idR=$_POST['fid'];
	$esR=$_POST['es'];
	if ($idR=="" || $esR=="" || $esR=="0") {
		echo "1";
	}
	else{
		$modificar="UPDATE factura set estd_f='$esR' where cod_f=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>