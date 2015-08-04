<?php
	include '../config.php';
	$idTipo=$_POST['sa'];
	if ($idTipo=="" || $idTipo=="0") {
		echo "1";
	}
	else{
		$buscar="SELECT * from marca where tipo_id=$idTipo order by nam_mk asc";
		$sql_buscar=mysql_query($buscar,$conexion) or die (mysql_error());
		$numreo=mysql_num_rows($sql_buscar);
		if ($numreo>0) {
			while ($gh=mysql_fetch_array($sql_buscar)) {
				$idmk=$gh['id_mk'];
				$nmmk=$gh['nam_mk'];
?>
<a href="../producto/ind3x.php?ba=0&bb=<?php echo $idTipo ?>&bc=<?php echo $idmk ?>&bd=0"><?php echo "$nmmk"; ?></a>
<?php
			}
		}
		else{
			echo "2";
		}
	}
?>