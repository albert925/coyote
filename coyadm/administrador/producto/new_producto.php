<?php
	include '../../../config.php';
	$a=$_POST['ap'];//nombre
	$b=$_POST['bp'];//cliente id
	$c=$_POST['cp'];//tipo id
	$d=$_POST['dp'];//marca id
	$e=$_POST['ep'];//precio
	$f=$_POST['fp'];//texto
	$hoy=date("Y-m-d");
	if ($a=="" || $b=="" || $b=="0" || $c=="" || $c=="0" || $d=="" || $d=="0") {
		echo "<script type='text/javascript'>";
			echo "alert('nombre, id cl, id tp, id mk nos diponible');";
			echo "var pagina='../producto';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
	else{
		$ingresar="INSERT into producto(nam_producto,cl_id,tp_id,marca_id,precio_p,text_p,fec_p) 
			values('$a',$b,$c,$d,$e,'$f','$hoy')";
		mysql_query($ingresar,$conexion) or die (mysql_error());
		echo "<script type='text/javascript'>";
			echo "alert('producto ingresado');";
			echo "var pagina='../producto';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>