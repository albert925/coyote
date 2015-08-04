<?php
	include '../../../config.php';
	$a=$_POST['ma'];//nombre marca
	$b=$_POST['mb'];//tipo producto id
	if ($a=="" || $b=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from marca where nam_mk='$a'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2";
		}
		else{
			$ingresar="INSERT into marca(nam_mk,tipo_id) values('$a',$b)";
			mysql_query($ingresar,$conexion) or die (mysql_error());
			echo "3";
		}
	}
?>