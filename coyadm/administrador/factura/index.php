<?php
	include '../../../config.php';
	session_start();
	if (isset($_SESSION['adm'])) {
		$useradR=$_SESSION['adm'];
		$daad="SELECT * from administrador where us_adm='$useradR'";
		$sql_dad=mysql_query($daad,$conexion) or die (mysql_error());
		while ($dD=mysql_fetch_array($sql_dad)) {
			$idad=$dD['id_admin'];
			$usad=$dD['us_adm'];
			$corad=$dD['cor_adm'];
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Todas las ventas" />
	<title>Ventas o factusras</title>
	<link rel="icon" href="../../../imagenes/icono.png" />
	<link rel="stylesheet" href="../../../css/normalize.css" />
	<link rel="stylesheet" href="../../../css/style.css" />
	<link rel="stylesheet" href="../../../css/style_adm.css" />
	<link rel="stylesheet" href="../../../css/popu.css" />
	<script src="../../../js/jquery_2_1_1.js"></script>
	<script src="../../../js/scrpag.js"></script>
	<script src="../../../js/scriadm.js"></script>
	<script src="../../../js/factura.js"></script>
	<script src="../../../js/popup.js"></script>
</head>
<body>
	<header>
		<figure id="logo">
			<a href="../">
				<img src="../../../imagenes/logo.png" alt="Logo" />
			</a>
		</figure>
		<nav>
			<a href="../"><?php echo "$usad"; ?></a>
			<a href="../../../cerrar">Salir</a>
		</nav>
	</header>
	<nav id="mnP">
		<a href="../galery">Imagenes I.</a>
		<a href="../producto">Productos</a>
		<a href="../factura" class="sele">Ventas</a>
		<div id="btnmovil"></div>
	</nav>
<!-- 	<nav id="mnC">
		<a href="#" id="nva">Nuevo Imagen</a>
	</nav> -->
	<nav id="mnB">
		<a href="../galery">Imagenes I.</a>
		<a href="../producto">Productos</a>
		<a href="../factura" class="sele">Ventas</a>
	</nav>
	<section>
		<h1>Ventas</h1>
		<article id="automargen">
			<article id="caj" class="datnvig">
				<form action="#" method="post" enctype="multipart/form-data" id="gimy" class="columninput">
					<input type="file" id="imGl" name="imGl" required="required" />
					<div id="txA"></div>
					<input type="submit" value="Subir e ingresar" id="nvGyl" class="botonstyle" />
				</form>
			</article>
		</article>
		<article>
			<table border="1">
				<tr>
					<td><b>Cod</b></td>
					<td><b>Fecha</b></td>
					<td><b>Producto</b></td>
					<td><b>Talla</b></td>
					<td><b>Cantidad</b></td>
					<td><b>Subtotal</b></td>
					<td><b>Usuario</b></td>
					<td><b>Estado</b></td>
				</tr>
				<?php
					error_reporting(E_ALL ^ E_NOTICE);
					$tamno_pagina=15;
					$pagina= $_GET['pagina'];
					if (!$pagina) {
						$inicio=0;
						$pagina=1;
					}
					else{
						$inicio= ($pagina - 1)*$tamno_pagina;
					}
					$ssql="SELECT * from factura 
							inner join producto on(factura.producto_id=producto.id_producto) 
						order by cod_f desc";
					$rs=mysql_query($ssql,$conexion) or die (mysql_error());
					$num_total_registros= mysql_num_rows($rs);
					$total_paginas= ceil($num_total_registros / $tamno_pagina);
					$gsql="SELECT * from factura 
							inner join producto on(factura.producto_id=producto.id_producto) 
						order by cod_f desc limit $inicio, $tamno_pagina";
					$impsql=mysql_query($gsql,$conexion) or die (mysql_error());
					$venNum=0;
					while ($gh=mysql_fetch_array($impsql)) {
						$cdf=$gh['cod_f'];
						$fff=$gh['fec_f'];
						$nvf=$gh['n_vent'];
						$prf=$gh['producto_id'];
						$usf=$gh['usuario_id'];
						$tllf=$gh['talla_f'];
						$ctf=$gh['cant_f'];
						$sbf=$gh['subt_f'];
						$tof=$gh['total_f'];
						$esdf=$gh['estd_f'];
						$nmPf=$gh['nam_producto'];
						$prPf=$gh['precio_p'];
						$nomes=["Selecione","En porceso","Vendida","Cancelado"];
						$formA=number_format($tof,2);
						$formB=number_format($sbf,2);
						$fomC=number_format($prPf,2);
						if ($venNum!=$nvf) {
							echo "<tr><td colspan='8' style='text-align:center;'><b><i>Compra N° $nvf</i></b></td></tr>";
							echo "<tr><td colspan='8' style='text-align:center;'><b style='color:#B3D341;'><i>Total: $$formA</i></b></td></tr>";
						}
						$venNum=$nvf;
						$primerImg="SELECT * from img_pr where producto_id=$prf order by id_img_p asc limit 1";
						$sql_primer=mysql_query($primerImg,$conexion) or die (mysql_error());
						while ($ggm=mysql_fetch_array($sql_primer)) {
							$rutgmi=$ggm['ruta_pr'];
						}
						$datusersOr="SELECT * from usuario where id_us=$usf";
						$sql_datusOr=mysql_query($datusersOr,$conexion) or die (mysql_error());
						while ($ys=mysql_fetch_array($sql_datusOr)) {
							$nmusDo=$ys['nam_us'];
							$apusDo=$ys['ape_us'];
						}
				?>
				<tr>
					<td><b><?php echo "$cdf"; ?></b></td>
					<td><?php echo "$fff"; ?></td>
					<td id="imgcolfl">
						<figure>
							<img src="../../../<?php echo $rutgmi ?>" alt="<?php echo $prf ?>" />
						</figure>
					</td>
					<td><?php echo "$tllf"; ?></td>
					<td><?php echo "$ctf"; ?></td>
					<td>$<?php echo "$formB"; ?></td>
					<td>
						<a class="gelcl" href="#" data-us="<?php echo $usf ?>" data-id="<?php echo $cdf ?>">
							<?php echo "$nmusDo $apusDo"; ?>
						</a>
					</td>
					<td>
						<select class="gelcl" id="esdF_<?php echo $cdf ?>" data-fact="<?php echo $cdf ?>">
							<?php
								for ($ie=0; $ie <=3 ; $ie++) { 
									if ($ie==$esdf) {
										$selestado="selected";
									}
									else{
										$selestado="";
									}
							?>
							<option value="<?php echo $ie ?>" <?php echo $selestado ?>><?php echo $nomes[$ie]; ?></option>
							<?php
								}
							?>
						</select>
					</td>
				</tr>
				<?php
					}
				?>
			</table>
			<?php
				$minnivdats="SELECT * from factura order by cod_f desc limit $inicio, $tamno_pagina";
				$sql_quermini=mysql_query($minnivdats,$conexion) or die (mysql_error());
				while ($ui=mysql_fetch_array($sql_quermini)) {
					$dofact=$ui['cod_f'];
					$datusers="SELECT * from usuario where id_us=$usf";
					$sql_datus=mysql_query($datusers,$conexion) or die (mysql_error());
					while ($ys=mysql_fetch_array($sql_datus)) {
						$nmus=$ys['nam_us'];
						$apus=$ys['ape_us'];
						$corus=$ys['correo_us'];
						$telus=$ys['telefono_us'];
						$celus=$ys['celular_us'];
						$paisus=$ys['pais_id'];
						$ciudus=$ys['ciudad_id'];
						$dirus=$ys['direccion_us'];
						$tipus=$ys['tip_us'];
						$estus=$ys['estd_us'];
					}
					$nomps="SELECT * from pais where id_pais=$paisus";
					$sql_nomps=mysql_query($nomps,$conexion) or die (mysql_error());
					while ($sp=mysql_fetch_array($sql_nomps)) {
						$namps=$sp['nam_pais'];
					}
					$nomcd="SELECT * from ciudad where id_ciudad='$ciudus'";
					$sql_nmcd=mysql_query($nomcd,$conexion) or die (mysql_error());
					while ($dc=mysql_fetch_array($sql_nmcd)) {
						$namcd=$dc['nam_ciudad'];
					}
			?>
			<article class="popupContact" id="popupContact_<?php echo $dofact ?>">
				<div id="popupContactClose_<?php echo $dofact ?>" class="popupContactClose" data-id="<?php echo $dofact ?>"></div>
				<article id="contactArea" class="datusF">
					<label><b>Nombre:</b> <?php echo "$nmus"; ?></label>
					<label><b>Apellido:</b> <?php echo "$apus"; ?></label>
					<label><b>Teléfonos:</b> <?php echo "$telus / $celus"; ?></label>
					<label><b>Correo:</b> <?php echo "$corus"; ?></label>
					<label><b>Pais:</b> <?php echo "$namps"; ?></label>
					<label><b>Ciudad: </b><?php echo "$namcd"; ?></label>
					<label><b>Direcciòn:</b> <?php echo "$dirus"; ?></label>
				</article>
			</article>
			<?php
				}
			?>
		</article>
		<article id="automargen">
			<br />
			<b>Páginas: </b>
			<?php
				//muestro los distintos indices de las paginas
				if ($total_paginas>1) {
					for ($i=1; $i <=$total_paginas ; $i++) { 
						if ($pagina==$i) {
							//si muestro el indice del la pagina actual, no coloco enlace
				?>
					<b><?php echo $pagina." "; ?></b>
				<?php
						}
						else{
							//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
				?>
							<a href="index.php?pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

				<?php
						}
					}
				}
			?>
		</article>
	</section>
	<footer>
		<article id="automargen">
			<article id="redes"></article>
		</article>
	</footer>
</body>
</html>
<?php
	}
	else{
		echo "<script type='text/javascript'>";
			echo "var pagina='../../erroradm.html';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>