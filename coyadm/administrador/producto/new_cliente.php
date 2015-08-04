<?php
	include '../../../config.php';
	$a=$_POST['ca'];
	if ($a=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from cliente where nam_cl='$a'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2";
		}
		else{
			$ingresar="INSERT into cliente(nam_cl) values('$a')";
			mysql_query($ingresar,$conexion) or die (mysql_error());
			echo "3";
		}
	}
?>