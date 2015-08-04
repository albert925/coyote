<?php
	include '../../../config.php';
	$idR=$_POST['frar'];//id relacion
	$b=$_POST['frbr'];//talla
	$c=$_POST['frcr'];//producto
	$d=$_POST['frdr'];//cantidad
	$e=$_POST['frer'];//color
	if ($idR=="" || $b=="" || $b=="0" || $c=="" || $c=="0" || $e=="" || $e=="0") {
		echo "1";
	}
	else{
		$modificar="UPDATE pr_tal_rel set producto_id=$c,talla_id=$b,cant_rel='$d',color_id=$e where id_rel=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>