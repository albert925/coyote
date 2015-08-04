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
		$idPd=$_GET['tbr'];
		if ($idR=="" || $idPd=="") {
			echo "<script type='text/javascript'>";
				echo "alert('id de imagen o de producto no disponible');";
				echo "var pagina='coyadm/administrador/producto';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$lkBr="SELECT * from img_pr where id_img_p=$idR";
			$sql_lkb=mysql_query($lkBr,$conexion) or die (mysql_error());
			while ($rt=mysql_fetch_array($sql_lkb)) {
				$rutborrar=$rt['ruta_pr'];
			}
			unlink($rutborrar);
			$borrar="DELETE from img_pr where id_img_p=$idR";
			mysql_query($borrar,$conexion) or die (mysql_error());
			echo "<script type='text/javascript'>";
				echo "alert('imagen borrado');";
				echo "var pagina='coyadm/administrador/producto/imagenesProdu.php?pd=$idPd';";
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