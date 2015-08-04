<?php
	include '../../config.php';
	$idR=$_POST['fe'];
	$passac=$_POST['ff'];
	$passnv=$_POST['fg'];
	if ($idR=="" || $passnv=="" || $passnv=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from administrador where id_admin='$idR' and pass_adm='$passac'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			$modificar="UPDATE administrador set pass_adm='$passnv' where id_admin=$idR";
			mysql_query($modificar,$conexion) or die (mysql_error());
			echo "3";
		}
		else{
			echo "2";
		}
	}
?>