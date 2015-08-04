<?php
	session_start();
	$idR=$_POST['dlid'];
	$arreglo=$_SESSION['carrito'];
	for ($i=0; $i <count($arreglo); $i++) { 
		if ($arreglo[$i]['Id']!=$idR) {
			$datosNuevos[]=array(
					'Id'=>$arreglo[$i]['Id'],
					'Nomb'=>$arreglo[$i]['Nomb'],
					'Precv'=>$arreglo[$i]['Precv'], 
					'Prec'=>$arreglo[$i]['Prec'],
					'Imag'=>$arreglo[$i]['Imag'],
					'Cant'=>$arreglo[$i]['Cant']
				);
		}
	}
	if (isset($datosNuevos)) {
		$_SESSION['carrito']=$datosNuevos;
	}
	else{
		unset($_SESSION['carrito']);
		echo "1";
	}
?>