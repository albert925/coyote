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
			<div id="pssl">2</div>
			<div>3</div>
		</article>
		<hgroup>
			<h1>Carrito de compras</h1>
			<h2>Paso2: Actualise los datos</h2>
		</hgroup>
		<article id="automargen" class="columninput">
			<label>*<b>Correo</b></label>
			<label><?php echo "$corus"; ?></label>
			<label>*<b>Nombres</b></label>
			<input type="text" id="nmcr" value="<?php echo $nmus ?>" />
			<label>*<b>Apellidos</b></label>
			<input type="text" id="apcr" value="<?php echo $apus ?>" />
			<label><b>Teléfono</b></label>
			<input type="tel" id="telcr" value="<?php echo $telus ?>" />
			<label><b>Celular</b></label>
			<input type="tel" id="celcr" value="<?php echo $celus ?>" />
			<label>*<b>País</b></label>
			<select id="pscr">
				<option value="0">Paises</option>
				<?php
					$tpais="SELECT * from pais order by nam_pais asc";
					$sql_pais=mysql_query($tpais,$conexion) or die (mysql_error());
					while ($kps=mysql_fetch_array($sql_pais)) {
						$idps=$kps['id_pais'];
						$nmps=$kps['nam_pais'];
						if ($idps==$paisus) {
							$selpais="selected";
						}
						else{
							$selpais="";
						}
				?>
				<option value="<?php echo $idps ?>" <?php echo $selpais ?>><?php echo "$nmps"; ?></option>
				<?php
					}
				?>
			</select>
			<label>*<b>Ciudad</b></label>
			<select id="cdcr">
				<?php
					if ($ciudus=="0" || $ciudus=="") {
				?>
				<option value="0">Ciudad no selecionado</option>
				<?php
					}
					else{
				?>
				<option value="<?php echo $ciudus ?>"><?php echo "$namcd"; ?></option>
				<?php
					}
				?>
			</select>
			<label>*<b>Dirección</b></label>
			<input type="text" id="drcr" value="<?php echo $dirus ?>" />
			<div id="mscr"></div>
			<!-- <input type="submit" value="Modificar"  class="botonstyle" /> -->
		</article>
		<article id="botoncarr">
			<a id="doscompr" href="carrito.php">Atrás</a>
			<a id="fcompr" class="actdat" href="#" data-us="<?php echo $idus ?>">Continuar el proceso de Compra</a>
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