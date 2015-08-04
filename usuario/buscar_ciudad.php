<?php
	include 'config.php';
	$pisR=$_POST['idps'];
	if ($pisR=="" || $pisR=="0") {
?>
<option value="0">Pais no selecionado</option>
<?php
	}
	else{
		$buscar="SELECT * from ciudad where pais_id=$pisR order by nam_ciudad asc";
		$sql_buscar=mysql_query($buscar,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_buscar);
		if ($numero>0) {
			while ($ld=mysql_fetch_array($sql_buscar)) {
				$idld=$ld['id_ciudad'];
				$nmld=$ld['nam_ciudad'];
?>
<option value="<?php echo $idld ?>"><?php echo "$nmld"; ?></option>
<?php
			}
		}
		else{
?>
<option value="0">Ciudades no encontrados</option>
<?php
		}
	}
?>