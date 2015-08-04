<?php
	include '../config.php';
	$plaB=$_POST['htx'];
	if ($plaB=="") {
		echo "";
	}
	else{
?>
<a href="#"><?php echo "$plaB"; ?></a>
<?php
		$buscar="SELECT * from producto where nam_producto like '$plaB%'";
		$sql_buscar=mysql_query($buscar,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_buscar);
		if ($numero>0) {
			while ($td=mysql_fetch_array($sql_buscar)) {
				$idP=$td['id_producto'];
				$nmP=$td['nam_producto'];
?>
<a href="../descricp.php?pd=<?php echo $idP ?>"><?php echo "$nmP"; ?></a>
<?php
			}
		}
		else{
			echo "";
		}
	}
?>