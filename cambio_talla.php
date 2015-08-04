<?php
	session_start();
	$a=$_POST['ta'];//id producto
	$b=$_POST['tb'];//talla cantidad
	$c=$_POST['tc'];//numero talla
	$arreglo=$_SESSION['carrito'];
	$numero=0;
	for ($i=0; $i <count($arreglo) ; $i++) { 
		if ($arreglo[$i]['Id']==$a) {
			$numero=$i;
		}
	}
	$arreglo[$numero]['Cantmx']=$b;
	$arreglo[$numero]['Tll']=$c;
	$_SESSION['carrito']=$arreglo;
	echo "1";
?>