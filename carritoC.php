<?php
	include 'config.php';
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
	}
	else{
		$idus=0;
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
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Mi carrito de compras de coyote store" />
	<title>Carrito de compras</title>
	<link rel="icon" href="imagenes/icono.png" />
	<link rel="stylesheet" href="css/normalize.css" />
	<link rel="stylesheet" href="css/iconos/style.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/carrito.css" />
	<script src="js/jquery_2_1_1.js"></script>
	<script src="js/scrpag.js"></script>
	<script src="js/carro.js"></script>
</head>
<body>
	<header>
		<figure id="logo">
			<a href="">
				<img src="imagenes/logo.png" alt="Logo" />
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
			<a id="inus" href="registro">
				<figure></figure>
			</a>
			<?php
				}
				else{
					if ($imgus=="") {
						$rutavatar="";
					}
					else{
						$rutavatar=$imgus;
					}
			?>
			<div id="senin">
				<a href="usuario"><figure style="background-image:url(<?php echo $rutavatar ?>);"></figure></a>
				<a href="cerrar/us.php">Salir</a>
			</div>
			<?php
				}
			?>
			<a href="carrito.php">
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
				<a href="producto/ind2x.php?tp=<?php echo $idtp ?>" data-mn="<?php echo $idtp ?>"><?php echo "$nmtp"; ?></a>
				<ul>
					<?php
						$Mkkk="SELECT * from marca where tipo_id=$idtp order by nam_mk asc";
						$sql_Mkkk=mysql_query($Mkkk,$conexion) or die (mysql_error());
						while ($kkm=mysql_fetch_array($sql_Mkkk)) {
							$widmk=$kkm['id_mk'];
							$wnmmk=$kkm['nam_mk'];
					?>
					<li><a href="producto/ind3x.php?ba=0&bb=<?php echo $idtp ?>&bc=<?php echo $widmk ?>&bd=0&be=&bf=&bg="><?php echo "$wnmmk"; ?></a></li>
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
			<li><a href="factura" data-mn="0">Historial compras</a></li>
			<?php
				}
			?>
		</ul>
		<div id="btnmovil"><span class="icon-menu"></span></div>
	</nav>
	<nav id="mnB">
		<a href="index.php">Inicio</a>
		<a href="nosotros">Nosotros</a>
		<?php
			$BtiposPb="SELECT * from tipo_producto order by id_tipo asc";
			$bsql_tipoPB=mysql_query($BtiposPb,$conexion) or die (mysql_error());
			while ($slB=mysql_fetch_array($bsql_tipoPB)) {
				$Bidtp=$slB['id_tipo'];
				$Bnmtp=$slB['nam_tipo'];
		?>
		<a href="producto/ind2x.php?tp=<?php echo $Bidtp ?>"><?php echo "$Bnmtp"; ?></a>
		<?php
			}
		?>
		<a href="contacto">Contacto</a>
		<?php
			if ($idus!="0") {
		?>
		<a href="factura">Historial compras</a>
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
		<article id="pasos">
			<div>1</div>
			<div>2</div>
			<div id="pssl">3</div>
		</article>
		<hgroup>
			<h1>Carrito de compras</h1>
			<h2>Paso3: Comprueba los datos de la compra</h2>
		</hgroup>
		<article id="datTcr">
			<article id="prodCr">
				<table border="1">
					<tr>
						<td id="celdA"><b>Producto</b></td>
						<td><b>Precio Unitario</b></td>
						<td><b>Cant.</b></td>
						<td><b>Subtotal</b></td>
					</tr>
					<?php
						$total=0;
						$num_filas=0;
						if (isset($_SESSION['carrito'])) {
							$datos=$_SESSION['carrito'];
							$total=0;
							for ($i=0; $i <count($datos) ; $i++) {
								if ($num_filas%2==0) {
									$color="class='filA'";
								}
								else{
									$color="";
								}
					?>
					<tr id="fil_<?php echo $datos[$i]['Id'] ?>">
						<td>
							<article id="dat_carrito">
								<label><?php echo $datos[$i]['Nomb']; ?></label><br />
								<label>Talla: <span id="ex_<?php echo $datos[$i]['Id'] ?>"><?php echo $datos[$i]['Tll']; ?></span></label><br />
								<label>Color: <span><?php echo $datos[$i]['CLR']; ?></span></label>
							</article>
						</td>
						<td>
							$
							<?php
								$pUf=number_format($datos[$i]['Prec'],2);
								echo "$pUf";
							?>
						</td>
						<td>
							<?php echo $datos[$i]['Cant'] ?>
						</td>
						<td>
							$<span id="subcol_<?php echo $datos[$i]['Id'] ?>"><?php
								$subotal=$datos[$i]['Prec']*$datos[$i]['Cant'];
								$forSub=number_format($subotal,2);
								echo "$forSub";
							?>
							</span>
						</td>
					</tr>
					<?php
								$num_filas++;
								$total=($datos[$i]['Prec']*$datos[$i]['Cant'])+$total;
							}
						}
						else{
					?>
					<tr>
						<td colspan="6">No has añadido ningun producto</td>
					</tr>
					<?php
						}
					?>
					<tr>
						<td colspan="2">
							<b>Total</b>
						</td>
						<td colspan="2">
							$<span id="totDs"><?php $formtotal=number_format($total,2); echo "$formtotal"; ?></span>
						</td>
					</tr>
				</table>
			</article>
			<article id="usdetl">
				<label><b>Id:</b> <?php echo "$idus"; ?></label>
				<label><b>Nombre:</b> <?php echo "$nmus"; ?></label>
				<label><b>Apellido: </b><?php echo "$apus"; ?></label>
				<label><b>Correo:</b> <?php echo "$corus"; ?></label>
				<label><b>Teléfono:</b> <?php echo "$telus"; ?></label>
				<label><b>Celular:</b> <?php echo "$celus"; ?></label>
				<label><b>Pais:</b> <?php echo "$namps"; ?></label>
				<label><b>Ciudad:</b> <?php echo "$namcd"; ?></label>
				<label><b>Dirección:</b> <?php echo "$dirus"; ?></label>
			</article>
		</article>
		<article id="botoncarr">
			<a id="doscompr" href="carritoB.php">Atrás</a>
			<a id="fcompr" href="comprar.php?tot=<?php echo $total ?>">Finalizar</a>
		</article>
	</section>
	<footer>
		<article class="flexfoot">
			<article>
				<a href="" class="sele">Inicio</a>
				<a href="nosotros">Nosotros</a>
				<a href="contacto">Contacto</a>
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