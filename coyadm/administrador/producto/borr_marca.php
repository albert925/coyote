<?php
	include '../../../config.php';
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
				echo "alert('id marca no disponible');";
				echo "var pagina='marka.php';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$borrar="DELETE from marca where id_mk=$idR";
			mysql_query($borrar,$conexion) or die (mysql_error());
			echo "<script type='text/javascript'>";
				echo "alert('$idR marca borrado');";
				echo "var pagina='marka.php';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
	}
	else{
		echo "<script type='text/javascript'>";
			echo "var pagina='../../erroradm.html';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>