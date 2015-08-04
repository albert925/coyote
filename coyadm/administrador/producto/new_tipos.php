<?php
	include '../../../config.php';
	$a=$_POST['ta'];
	if ($a=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from tipo_producto where nam_tipo='$a'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2";
		}
		else{
			$ingresar="INSERT into tipo_producto(nam_tipo) values('$a')";
			mysql_query($ingresar,$conexion) or die (mysql_error());
			echo "3";
		}
	}
?>