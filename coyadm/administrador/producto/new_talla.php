<?php
	include '../../../config.php';
	$a=$_POST['tla'];
	if ($a=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from tallas where nam_tll='$a'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2";
		}
		else{
			$ingresar="INSERT into tallas(nam_tll) values('$a')";
			mysql_query($ingresar,$conexion) or die (mysql_error());
			echo "3";
		}
	}
?>