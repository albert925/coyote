<?php
	include '../../config.php';
	$idR=$_POST['fc'];
	$corR=$_POST['fd'];
	if ($idR=="" || $corR=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from administrador where cor_adm='$corR'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2";
		}
		else{
			$modificar="UPDATE administrador set cor_adm='$corR' where id_admin=$idR";
			mysql_query($modificar,$conexion) or die (mysql_error());
			echo "3";
		}
	}
?>