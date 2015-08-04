<?php
	include '../../../config.php';
	$idR=$_POST['idSp'];//id producto
	$a=$_POST['ap'];//nombre
	$b=$_POST['bp'];//cliente id
	$c=$_POST['cp'];//tipo id
	$d=$_POST['dp'];//marca id
	$e=$_POST['ep'];//precio
	$f=$_POST['fp'];//texto
	$hoy=date("Y-m-d");
	if ($idR=="" || $a=="" || $b=="" || $b=="0" || $c=="" || $c=="0" || $d=="" || $d=="0") {
		echo "<script type='text/javascript'>";
			echo "alert('id, nombre, id cl, id tp, id mk nos diponible');";
			echo "var pagina='../producto';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
	else{
		$modificar="UPDATE producto set nam_producto='$a',cl_id=$b,tp_id=$c,marca_id=$d,precio_p=$e,
			text_p='$f',fec_p='$hoy' where id_producto=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "<script type='text/javascript'>";
			echo "alert('producto modificado');";
			echo "var pagina='modifprodu.php?pd=$idR';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>