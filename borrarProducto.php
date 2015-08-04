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
				echo "alert('id de producto no disponible');";
				echo "var pagina='coyadm/administrador/producto';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$lkBr="SELECT * from img_pr where producto_id=$idR";
			$sql_lkb=mysql_query($lkBr,$conexion) or die (mysql_error());
			while ($rt=mysql_fetch_array($sql_lkb)) {
				$idrut=$rt['id_img_p'];
				$rutborrar=$rt['ruta_pr'];
				unlink($rutborrar);
				$borrarrut="DELETE from img_pr where id_img_p=$idrut";
				mysql_query($borrarrut,$conexion) or die (mysql_error());
			}
			$borT="DELETE from producto where id_producto=$idR";
			mysql_query($borT,$conexion) or die (mysql_error());
			echo "<script type='text/javascript'>";
				echo "alert('Producto borrado');";
				echo "var pagina='coyadm/administrador/producto';";
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