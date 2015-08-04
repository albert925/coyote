<?php
	include 'config.php';
	session_start();
	if (isset($_SESSION['adm'])) {
		$useradR=$_SESSION['adm'];
		$daad="SELECT * from administrador where us_adm='$useradR'";
		$sql_dad=mysql_query($daad,$conexion) or die (mysql_error());
		while ($dD=mysql_fetch_array($sql_dad)) {
			$idad=$dD['id_admin'];
			$usad=$dD['us_adm'];
			$corad=$dD['cor_adm'];
		}
		$idR=$_GET['br'];
		if ($idR=="") {
			echo "<script type='text/javascript'>";
				echo "alert('id de imagen no disponible');";
				echo "var pagina='coyadm/administrador/galery';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$lkBr="SELECT * from galery where id_gal=$idR";
			$sql_lkb=mysql_query($lkBr,$conexion) or die (mysql_error());
			while ($rt=mysql_fetch_array($sql_lkb)) {
				$rutborrar=$rt['rut_gal'];
			}
			unlink($rutborrar);
			$borrar="DELETE from galery where id_gal=$idR";
			mysql_query($borrar,$conexion) or die (mysql_error());
			echo "<script type='text/javascript'>";
				echo "alert('imagen borrado');";
				echo "var pagina='coyadm/administrador/galery';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
	}
	else{
		echo "<script type='text/javascript'>";
			echo "var pagina='coyadm/erroradm.html';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>