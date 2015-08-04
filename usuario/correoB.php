<?php
	include '../config.php';
	$codiR=$_GET['codC'];
	$idR=$_GET['di'];
	if ($codiR=="" || $idR=="") {
		echo "<script>";
			echo "alert('codigo o id no disponible');";
			echo "var pag='../';";
			echo "document.location.href=pag;";
		echo "</script>";
	}
	else{
		$existe="SELECT * from usuario where id_us=$idR and cod_us='$codiR'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			while ($ksF=mysql_fetch_array($sql_existe)) {
				$corNv=$ksF['corcab_us'];
			}
			$colocar="UPDATE usuario set correo_us='$corNv',corcab_us='',cod_us='000' where id_us=$idR";
			mysql_query($colocar,$conexion) or die (mysql_error());
			echo "<script>";
				echo "var pag='rescroB.php?dat=3';";
				echo "document.location.href=pag;";
			echo "</script>";
		}
		else{
			echo "<script>";
				echo "var pag='rescroB.php?dat=2';";
				echo "document.location.href=pag;";
			echo "</script>";
		}
	}
?>