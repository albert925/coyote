<?php
	session_start();
	$idR=$_POST['cid'];
	$prR=$_POST['cpr'];
	$canR=$_POST['cct'];
	$arreglo=$_SESSION['carrito'];
	$total=0;
	$numero=0;
	for ($i=0; $i <count($arreglo) ; $i++) { 
		if ($arreglo[$i]['Id']==$idR) {
			$numero=$i;
		}
	}
	$arreglo[$numero]['Cant']=$canR;
	for ($i=0; $i <count($arreglo) ; $i++) { 
		$total=($arreglo[$i]['Cant']*$arreglo[$i]['Prec'])+$total;
	}
	$_SESSION['carrito']=$arreglo;
	$fottoal=number_format($total);
	echo $fottoal;
?>