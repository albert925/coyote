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
	error_reporting(E_ALL ^ E_NOTICE);
	$idR=$_GET['pd'];
	if ($idR!="" && $idR!="0") {
		if (isset($_SESSION['carrito'])) {
			$arreglo=$_SESSION['carrito'];
			$encontro=false;
			$numero=0;
			for ($i=0; $i <count($arreglo) ; $i++) { 
				if ($arreglo[$i]['Id']==$idR) {
					$encontro=true;
					$numero=$i;
				}
			}
			if ($encontro==true) {
				$arreglo[$numero]['Cant']=$arreglo[$numero]['Cant']+1;
				$_SESSION['carrito']=$arreglo;
			}
			else{
				$skt="SELECT * from producto where id_producto=$idR";
				$re=mysql_query($skt,$conexion) or die (mysql_error());
				while ($j=mysql_fetch_array($re)) {
					$nmP=$j['nam_producto'];
					$prP=$j['precio_p'];
				}
				$imagenP="SELECT * from img_pr where producto_id=$idR 
					order by id_img_p asc limit 1";
				$serty=mysql_query($imagenP,$conexion) or die (mysql_error());
				while ($gtp=mysql_fetch_array($serty)) {
					$imagen=$gtp['ruta_pr'];
				}
				$datosnuevos=array('Id'=>$idR,
													'Nomb'=>$nmP,
													'Prec'=>$prP,
													'Imag'=>$imagen,
													'Tll'=>0,
													'CLR'=>0,
													'Cantmx'=>500,
													'Cant'=>1);
				array_push($arreglo, $datosnuevos);
				$_SESSION['carrito']=$arreglo;
			}
		}
		else{
			if ($idR) {
				$skt="SELECT * from producto where id_producto=$idR";
				$re=mysql_query($skt,$conexion) or die (mysql_error());
				while ($j=mysql_fetch_array($re)) {
					$nmP=$j['nam_producto'];
					$prP=$j['precio_p'];
				}
				$imagenP="SELECT * from img_pr where producto_id=$idR 
					order by id_img_p asc limit 1";
				$serty=mysql_query($imagenP,$conexion) or die (mysql_error());
				while ($gtp=mysql_fetch_array($serty)) {
					$imagen=$gtp['ruta_pr'];
				}
				$arreglo[]=array(
						'Id'=>$idR,
						'Nomb'=>$nmP,
						'Prec'=>$prP,
						'Imag'=>$imagen,
						'Tll'=>0,
						'CLR'=>0,
						'Cantmx'=>500,
						'Cant'=>1);
				$_SESSION['carrito']=$arreglo;
			}
		}
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
			<a href="index.php">
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
			<div id="pssl">1</div>
			<div>2</div>
			<div>3</div>
		</article>
		<hgroup>
			<h1>Carrito de compras</h1>
			<h2>Paso1: Revisa los Productos de tu Carrito.</h2>
		</hgroup>
		<article id="vercdatcar">
			<table border="1">
				<tr>
					<td id="celdA"><b>Producto</b></td>
					<td><b>Descripción</b></td>
					<td><b>Precio Unitario</b></td>
					<td><b>Cant.</b></td>
					<td></td>
					<td><b>Total</b></td>
				</tr>
				<?php
					$total=0;
					if (isset($_SESSION['carrito'])) {
						$datos=$_SESSION['carrito'];
						$total=0;
						for ($i=0; $i <count($datos) ; $i++) { 
				?>
				<tr id="fil_<?php echo $datos[$i]['Id'] ?>">
					<td id="celdA">
						<figure id="img_carrito">
							<img src="<?php echo $datos[$i]['Imag'] ?>" alt="img_<?php echo $datos[$i]['Nomb'] ?>" />
						</figure>
					</td>
					<td>
						<article id="dat_carrito">
							<label><?php echo $datos[$i]['Nomb']; ?></label><br />
							<label>Talla: <span id="ex_<?php echo $datos[$i]['Id'] ?>"><?php echo $datos[$i]['Tll']; ?></span></label>
							<label>Color: <span id="col_<?php echo $datos[$i]['Id']; ?>"><?php echo $datos[$i]['CLR']; ?></span></label>
							<article id="tam_carrito">
								<?php
									$busiz=$datos[$i]['Id'];
									$Size="SELECT * from pr_tal_rel 
											inner join tallas on(pr_tal_rel.talla_id=tallas.id_tll) 
										where producto_id=$busiz";
									$sql_size=mysql_query($Size,$conexion) or die (mysql_error());
									while ($sz=mysql_fetch_array($sql_size)) {
										$idTall=$sz['talla_id'];
										$nmTall=$sz['nam_tll'];
										$ctTall=$sz['cant_rel'];
								?>
								<div id="cajtl_<?php echo $datos[$i]['Id'] ?>" class="Talsel" data-id="<?php echo $datos[$i]['Id'] ?>" 
									data-ct="<?php echo $ctTall ?>" data-nmtll="<?php echo $nmTall ?>">
									<?php echo "$nmTall"; ?>
								</div>
								<?php
									}
								?>
							</article>
							<article id="tam_carrito">
								<?php
									$colsiz=$datos[$i]['Id'];
								?>
								<select id="coloCam_<?php echo $datos[$i]['Id'] ?>" 
									data-id="<?php echo $datos[$i]['Id'] ?>" class="cambiocolorcar">
										<option value="0">Colores</option>
										<?php
											$coloreDesteprod="SELECT * from pr_tal_rel 
													inner join colores on(pr_tal_rel.color_id=colores.id_color) 
												where producto_id=$colsiz";
											$sql_corores=mysql_query($coloreDesteprod,$conexion) or die (mysql_error());
											while ($jlr=mysql_fetch_array($sql_corores)) {
												$idcor=$jlr['color_id'];
												$nmcolor=$jlr['nam_color'];
										?>
										<option value="<?php echo $idcor ?>"><?php echo "$nmcolor"; ?></option>
										<?php
											}
										?>
								</select>
							</article>
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
						<input type="number" id="carcat_<?php echo $datos[$i]['Id'] ?>" 
							class="cambCtcar" min="0" max="<?php echo $datos[$i]['Cantmx'] ?>" 
							data-id="<?php echo $datos[$i]['Id'] ?>" data-prec="<?php echo $datos[$i]['Prec'] ?>" 
							value="<?php echo $datos[$i]['Cant'] ?>" />
						<div id="locad_<?php echo $datos[$i]['Id'] ?>"></div>
					</td>
					<td>
						<div class="eliminar_carr" data-id="<?php echo $datos[$i]['Id'] ?>"></div>
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
					<td colspan="2"></td>
					<td colspan="2">
						<b>Total</b>
					</td>
					<td colspan="2">
						$<span id="totDs"><?php $formtotal=number_format($total,2); echo "$formtotal"; ?></span>
					</td>
				</tr>
			</table>
		</article>
		<article id="botoncarr">
			<?php
				if ($idus!="0") {
					if ($total!=0) {
			?>
			<a id="fcompr" href="carritoB.php">Continuar el proceso de Compra</a>
			<?php
					}
				}
				else{
			?>
			<a id="doscompr" href="registro">Regístrate</a>
			<?php
				}
			?>
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