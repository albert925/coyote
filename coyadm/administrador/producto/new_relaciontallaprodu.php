<?php
	include '../../../config.php';
	$a=$_POST['ra'];//id talla
	$b=$_POST['rb'];//cantida
	$c=$_POST['rc'];//id priducto array
	$d=$_POST['rd'];//id color
	if ($a=="" || $a=="0" || $b=="" || $c=="null" || $c=="false" || $d=="" || $d=="0") {
		echo "1";
	}
	else{
		for ($i=0; $i <count($c) ; $i++) { 
			$verproducto=$c[$i];
			$existe_relacion="SELECT * from pr_tal_rel where producto_id=$verproducto and talla_id=$a and color_id=$d";
			$sql_existe=mysql_query($existe_relacion,$conexion) or die (mysql_error());
			$numero=mysql_num_rows($sql_existe);
			if ($numero>0) {
				echo "<b style='color:#F7F7F7;'>El id $verproducto del producto, id $a de la talla, id $d de color ya tiene relacion</b><br />";
			}
			else{
				$ingresar="INSERT into pr_tal_rel(producto_id,talla_id,color_id,cant_rel) 
					values($verproducto,$a,$d,'$b')";
				mysql_query($ingresar,$conexion) or die (mysql_error());
				echo "<b style='color:#00A5D4;'>Relación ingresada</b><br />";
			}
		}
	}
?>