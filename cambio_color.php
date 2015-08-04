<?php
	include 'config.php';
	session_start();
	$a=$_POST['ca'];//id producto
	$b=$_POST['cb'];//id color
	$sacar_nombre_color="SELECT * from colores where id_color=$b";
	$sql_colores=mysql_query($sacar_nombre_color,$conexion) or die (mysql_error());
	while ($cl=mysql_fetch_array($sql_colores)) {
		$nmcolor=$cl['nam_color'];
	}
	$arreglo=$_SESSION['carrito'];
	$numero=0;
	for ($i=0; $i <count($arreglo) ; $i++) { 
		if ($arreglo[$i]['Id']==$a) {
			$numero=$i;
		}
	}
	$arreglo[$numero]['CLR']=$nmcolor;
	$_SESSION['carrito']=$arreglo;
	echo "1/$nmcolor";
?>