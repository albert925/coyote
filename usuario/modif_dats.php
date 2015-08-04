<?php
	include '../config.php';
	$idr=$_POST['ad'];
	$a=$_POST['a'];//nombre
	$b=$_POST['b'];//apelldio
	$c=$_POST['c'];//telefono
	$d=$_POST['d'];//celular
	$e=$_POST['e'];//pais
	$f=$_POST['f'];//ciudad
	$g=$_POST['g'];//direccion
	if ($idr=="" || $a=="" || $b=="" || $e=="0" || $e=="" || $f=="0" || $f=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE usuario set nam_us='$a',ape_us='$b',
			telefono_us='$c',celular_us='$d',pais_id=$e,ciudad_id=$f,direccion_us='$g' 
			where id_us=$idr";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>