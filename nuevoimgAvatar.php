<?php
	include 'config.php';
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		$idR=$_POST['idus'];
		//-------------------------------------------
		$fotAcosmodT=$_FILES['avGl']['name'];
		$tipfotA=$_FILES['avGl']['type'];
	 	$almfotA=$_FILES['avGl']['tmp_name'];
	 	$tamfotA=$_FILES['avGl']['size'];
	 	$erorfotA=$_FILES['avGl']['error'];
		//----------------------------------------
		if ($fotAcosmodT=="" || $idR=="") {
			echo "1";
		}
		else{
			if ($erorfotA>0) {
				echo "2";
			}
			else{
				$maAximo = 100204000;
				if ($tamfotA<=$maAximo*1024) {
					$ruta="imagenes/avatar/".$fotAcosmodT;
					if (file_exists($ruta)) {
						echo "Una imagen tiene el mismo nombre";
					}
					else{
						$subiendo=@move_uploaded_file($almfotA, $ruta);
						if ($subiendo) {
							$ddf="UPDATE usuario set avat_us='$ruta' where id_us=$idR";
							mysql_query($ddf,$conexion) or die (mysql_error());
							echo "5";
						}
						else{
							echo "4";
						}
					}
				}
				else{
					echo "3";
				}
			}
		}
	}
	else{
		echo "error";
	}
?>