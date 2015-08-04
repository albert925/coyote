<?php
	include '../config.php';
	session_start();
	if (isset($_SESSION['us'])) {
		$usR=$_SESSION['us'];
		$datosusuario="SELECT * from usuario where id_us=$usR";
		$sql_user=mysql_query($datosusuario,$conexion) or die (mysql_error());
		while ($ss=mysql_fetch_array($sql_user)) {
			$idus=$ss['id_us'];
			$nmus=$ss['nam_us'];
			$apus=$ss['ape_us'];
			$corus=$ss['correo_us'];
			$telus=$ss['telefono_us'];
			$celus=$ss['celular_us'];
			$paisus=$ss['pais_id'];
			$ciudus=$ss['ciudad_id'];
			$dirus=$ss['direccion_us'];
			$tipus=$ss['tip_us'];
			$estus=$ss['estd_us'];
		}
		$hoy=date("Y-m-d g:i:s a");
		require_once("../dompdf/dompdf_config.inc.php");
		$datos="SELECT * from factura 
					inner join producto on(factura.producto_id=producto.id_producto) 
				order by cod_f asc";
		$sql_datos=mysql_query($datos,$conexion) or die (mysql_error());
		$venNum=0;
		$codigo="
			<!DOCTYPE html>
				<html lang='es'>
				<head>
					<meta charset='utf-8' />
					<meta name='viewport' content='width=device-width, maximun-scale=1' />
					<title>Factura Walther Arrubla</title>
					<link rel='icon' href='../imagenes/icono.png' />
					<link rel='stylesheet' href='../css/normalize.css' />
					<link rel='stylesheet' href='../css/style_fact.css' />
					<script src='../js/jquery_2_1_1.js'></script>
					<script src='../js/paginascr.js'></script>
				</head>
				<body>
					<header>
						<figure id='logo'>
							<img src='../imagenes/logo.png' alt='Logo' />
						</figure>
					</header>
					<span>tílde</span>
					<hgroup>
						<h1>Facturas</h1>
						<h4>Fecha: <i>$hoy</i></h4>
					</hgroup>
					<article>
						<b>Id: </b>$idus<br />
						<b>Usuario: </b>$nmus $apus<br />
					</article>
					<br/>
					<table border='0.5'>
					<tr id='title'>
						<td><b>No. Factura</b></td>
						<td><b>Fecha y Hora</b></td>
						<td><b>Producto</b></td>
						<td><b>Talla</b></td>
						<td><b>Precio U.</b></td>
						<td><b>Cantidad Comprada</b></td>
						<td><b>Subtotal</b></td>
						<td><b>Estado Factura</b></td>
					</tr>";
		while ($rfc=mysql_fetch_array($sql_datos)) {
			$cdf=$rfc['cod_f'];
			$fff=$rfc['fec_f'];
			$nvf=$rfc['n_vent'];
			$prf=$rfc['producto_id'];
			$tllf=$rfc['talla_f'];
			$colof=$rfc['color_f'];
			$ctf=$rfc['cant_f'];
			$sbf=$rfc['subt_f'];
			$tof=$rfc['total_f'];
			$esdf=$rfc['estd_f'];
			$nmPf=$rfc['nam_producto'];
			$prPf=$rfc['precio_p'];
			$efm=["Error","<b style='color:#07AAF2;'>En proceso</b>",
						"<b style='color:#B3D341;'>Comprada</b>","<b style='color:#A54434;'>Cancelada</b>"];
			$formA=number_format($tof,2);
			$formB=number_format($sbf,2);
			$fomC=number_format($prPf,2);
			if ($venNum!=$nvf) {
				$codigo.="<tr><td colspan='8' style='text-align:center;'><b/><i>Compra N° $nvf</i><b/></td></tr>";
				$codigo.="<tr><td colspan='8' style='text-align:center;'><b style='color:green;'><i>Total: $$formA</i></b></td></tr>";
			}
			$venNum=$nvf;
			$codigo.="<tr>
				<td>$cdf</td>
				<td>$fff</td>
				<td>
					<b>Cod:</b> $prf<br />
					<b>Nombre:</b> $nmPf
				</td>
				<td><b>Talla:</b> $tllf<br /><b>Color:</b> $colof</td>
				<td>$$fomC</td>
				<td>$ctf</td>
				<td>$$formB</td>
				<td>$efm[$esdf]</td>
			</tr>";
		}
		$codigo.="</table>
				</body>
			</html>";
		$codigo=utf8_decode($codigo);
		$dompdf=new DOMPDF();
		$dompdf->load_html($codigo);
		ini_set("memory_limit","128M");
		$dompdf->render();
		$dompdf->stream("factura_"."$nmus.pdf");
	}
	else{
		echo "<script>";
			echo "alert('Sesio caducada');";
			echo "var pag='../registro';";
			echo "document.location.href=pag;";
		echo "</script>";
	}
?>