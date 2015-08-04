<?php
	session_start();
	$total=0;
	$cantidad=0;
	if (isset($_SESSION['carrito'])) {
		$datos=$_SESSION['carrito'];
		for ($i=0; $i <count($datos) ; $i++) { 
			$cantidad=$datos[$i]['Cant']+$cantidad;
			$total=($datos[$i]['Prec']*$datos[$i]['Cant'])+$total;
		}
		$fomatoA=number_format($cantidad);
		$fomatoB=number_format($total);
		echo "$fomatoA";
	}
	else{
		echo "0";
	}
?>