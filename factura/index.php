<?php
	include '../config.php';
	session_start();
	if (isset($_SESSION['us'])) {
		$usR=$_SESSION['us'];
		$datosusuario="SELECT * from usuario where id_us=$usR";
		$sql_user=mysql_query($datosusuario,$conexion) or die (mysql_error());
		while ($ss=mysql_fetch_array($sql_user)) {
			$idus=$ss['id_us'];
			$imgus=$ss['avat_us'];
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Historial de compras" />
	<title>Factura de Coyote Store</title>
	<link rel="icon" href="../imagenes/icono.png" />
	<link rel="stylesheet" href="../css/normalize.css" />
	<link rel="stylesheet" href="../css/iconos/style.css" />
	<link rel="stylesheet" href="../css/style.css" />
	<script src="../js/jquery_2_1_1.js"></script>
	<script src="../js/scrpag.js"></script>
</head>
<body>
	<header>
		<figure id="logo">
			<a href="../">
				<img src="../imagenes/logo.png" alt="Logo" />
			</a>
		</figure>
		<aside id="busqueda">
			<article>
				<input type="search" id="busplpd" /><span class="icon-search"></span>
			</article>
			<div id="resultadoBs"></div>
		</aside>
		<nav>
			<?php
				if ($idus=="0") {
			?>
			<a id="inus" href="../registro">
				<figure></figure>
			</a>
			<?php
				}
				else{
					if ($imgus=="") {
						$rutavatar="";
					}
					else{
						$rutavatar="../".$imgus;
					}
			?>
			<div id="senin">
				<a href="../usuario"><figure style="background-image:url(<?php echo $rutavatar ?>);"></figure></a>
				<a href="../cerrar/us.php">Salir</a>
			</div>
			<?php
				}
			?>
			<a href="../carrito.php">
				<div id="caritod">
					<span class="icon-cart"></span>
					<span id="decar">carrito 0</span>
				</div>
			</a>
		</nav>
	</header>
	<nav id="mnP" class="aumnP">
		<ul>
			<?php
				$tiposP="SELECT * from tipo_producto order by id_tipo asc";
				$sql_tipoP=mysql_query($tiposP,$conexion) or die (mysql_error());
				while ($sl=mysql_fetch_array($sql_tipoP)) {
					$idtp=$sl['id_tipo'];
					$nmtp=$sl['nam_tipo'];
			?>
			<li>
				<a href="../producto/ind2x.php?tp=<?php echo $idtp ?>" data-mn="<?php echo $idtp ?>"><?php echo "$nmtp"; ?></a>
				<ul>
					<?php
						$Mkkk="SELECT * from marca where tipo_id=$idtp order by nam_mk asc";
						$sql_Mkkk=mysql_query($Mkkk,$conexion) or die (mysql_error());
						while ($kkm=mysql_fetch_array($sql_Mkkk)) {
							$widmk=$kkm['id_mk'];
							$wnmmk=$kkm['nam_mk'];
					?>
					<li><a href="../producto/ind3x.php?ba=0&bb=<?php echo $idtp ?>&bc=<?php echo $widmk ?>&bd=0&be=&bf=&bg="><?php echo "$wnmmk"; ?></a></li>
					<?php
						}
					?>
				</ul>
			</li>
			<?php
				}
			?>
			<?php
				if ($idus!="0") {
			?>
			<li><a href="../factura" class="sele" data-mn="0">Historial compras</a></li>
			<?php
				}
			?>
		</ul>
		<div id="btnmovil"><span class="icon-menu"></span></div>
	</nav>
	<nav id="mnB">
		<a href="../">Inicio</a>
		<a href="../nosotros">Nosotros</a>
		<?php
			$BtiposPb="SELECT * from tipo_producto order by id_tipo asc";
			$bsql_tipoPB=mysql_query($BtiposPb,$conexion) or die (mysql_error());
			while ($slB=mysql_fetch_array($bsql_tipoPB)) {
				$Bidtp=$slB['id_tipo'];
				$Bnmtp=$slB['nam_tipo'];
		?>
		<a href="../producto/ind2x.php?tp=<?php echo $Bidtp ?>"><?php echo "$Bnmtp"; ?></a>
		<?php
			}
		?>
		<a href="../contacto">Contacto</a>
		<?php
			if ($idus!="0") {
		?>
		<a href="../factura" class="sele">Historial compras</a>
		<?php
			}
		?>
	</nav>
	<aside id="login">
		<article>
			<a href="registro">Registrarse</a>
		</article>
		<form action="#" method="post" class="columninput">
			<article>
				<input type="email" id="corus" required="required" placeholder="Correo" />
				<input type="password" id="psus" required="required" palceholder="Contraseña" />
				<input type="submit" value="Ingresar" id="bnigus" class="botonstyle" />
			</article>
			<div id="txus"></div>
		</form>
	</aside>
	<section>
		<h1>Compras</h1>
		<article>
			<table id="tablsel" border="1">
				<tr>
					<td><b>N° Factura</b></td>
					<td><b>Fecha</b></td>
					<td><b>Producto</b></td>
					<td><b>Talla y color</b></td>
					<td><b>P U.</b></td>
					<td><b>Cantidad</b></td>
					<td><b>Subtotal</b></td>
					<td><b>Estado F.</b></td>
					<td><b>Guadar Pdf</b></td>
				</tr>
				<?php
					error_reporting(E_ALL ^ E_NOTICE);
					$tamno_pagina=30;
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
					while ($rfc=mysql_fetch_array($impsql)) {
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
							echo "<tr><td colspan='9' style='text-align:center;'><b/><i>Compra N° $nvf</i><b/></td></tr>";
							echo "<tr><td colspan='9' style='text-align:center;'><b style='color:#B3D341;'><i>Total: $$formA</i></b></td></tr>";
						}
						$venNum=$nvf;
						$primerImg="SELECT * from img_pr where producto_id=$prf order by id_img_p asc limit 1";
						$sql_primer=mysql_query($primerImg,$conexion) or die (mysql_error());
						while ($ggm=mysql_fetch_array($sql_primer)) {
							$rutgmi=$ggm['ruta_pr'];
						}
				?>
				<tr>
					<td><b><?php echo "$cdf"; ?></b></td>
					<td><?php echo "$fff"; ?></td>
					<td id="celdA">
						<figure>
							<img src="../<?php echo $rutgmi ?>" alt="imagen" />
						</figure>
					</td>
					<td>
						<b>Talla:</b> <?php echo "$tllf"; ?><br />
						<b>Color:</b> <?php echo "$colof"; ?>
					</td>
					<td>$<?php echo "$fomC"; ?></td>
					<td><?php echo "$ctf"; ?></td>
					<td>$<?php echo "$formB"; ?></td>
					<td><?php echo $efm[$esdf]; ?></td>
					<td>
						<a id="facvent" href="guardarvent.php?fnv=<?php echo $nvf ?>">Guardar como pdf</a>
					</td>
				</tr>
				<?php
					}
				?>
			</table>
			<article id="bongn">
				<a id="facvent" href="guardtodf.php">Gauardar todo</a>
			</article>
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
		<article class="flexfoot">
			<article>
				<a href="../">Inicio</a>
				<a href="../nosotros">Nosotros</a>
				<a href="../contacto">Contacto</a>
			</article>
			<article>
				<div><b>Dirección:</b> calle 32A # 34 – 541 local 5 Av. Sincelejito.</div>
				<div><b>Teléfono:</b> (5) 275 10 65</div>
				<div><b>Correo:</b> coyotestore@coyotestore.com.co</div>
			</article>
			<article>
				<div id="redes">
					<a href="" target="_blank"><span class="icon-facebook2"></span></a>
					<a href="" target="_blank"><span class="icon-instagram"></span></a>
					<a href="" target="_blank"><span class="icon-twitter"></span></a>
				</div>
			</article>
		</article>
		<article id="fotfin">
			CONAXPORT © 2015 &nbsp;&nbsp;todo los derechos reservados &nbsp;- &nbsp;PBX (5) 841 733 &nbsp;&nbsp;Cúcuta - Colombia &nbsp;&nbsp;
			<a href="http://conaxport.com/" target="_blank">www.conaxport.com</a>
		</article>
	</footer>
</body>
</html>
<?php
	}
	else{
		echo "<script>";
			echo "alert('Sesio caducada');";
			echo "var pag='../registro';";
			echo "document.location.href=pag;";
		echo "</script>";
	}
?>