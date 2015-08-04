<?php
	include '../../../config.php';
	$tipoR=$_POST['sytp'];
	if ($tipoR=="0" || $tipoR=="") {
?>
<option value="0">Tipo no selecionado</option>
<?php
	}
	else{
		$buscar="SELECT * from marca where tipo_id=$tipoR order by nam_mk asc";
		$sql_buscar=mysql_query($buscar,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_buscar);
		if ($numero>0) {
			while ($mmk=mysql_fetch_array($sql_buscar)) {
				$idmmk=$mmk['id_mk'];
				$nmmk=$mmk['nam_mk'];
?>
<option value="<?php echo $idmmk ?>"><?php echo "$nmmk" ?></option>
<?php
			}
		}
		else{
?>
<option value="0">Subtipo o marca no encontrado</option>
<?php
		}
	}
?>