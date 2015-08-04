<?php
	include '../config.php';
	$idus=0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="" />
	<title>Coyote registro usuarios</title>
	<link rel="icon" href="../imagenes/icono.png" />
	<link rel="image_src" href="../imagenes/icono.png" />
	<link rel="stylesheet" href="../css/normalize.css" />
	<link rel="stylesheet" href="../css/iconos/style.css" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../css/default/default.css" />
	<link rel="stylesheet" href="../css/nivo_slider.css" />
	<script src="../js/jquery_2_1_1.js"></script>
	<script src="../js/scrpag.js"></script>
	<script src="../js/regis.js"></script>
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
			<a id="inus" href="../registro">
				<figure></figure>
			</a>
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
			<a href="factura" data-mn="0">Historial compras</a>
			<?php
				}
			?>
		</ul>
		<div id="btnmovil"><span class="icon-menu"></span></div>
	</nav>
	<nav id="mnB">
		<a href="../">Inicio</a>
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
	</nav>
	<section>
		<h1>Registro</h1>
		<article id="automargen" class="flexcjA">
			<article class="columninput">
				<h2>Nuevos usuarios</h2>
				<label><b>Nombre</b></label>
				<input type="text" id="namrs" />
				<label><b>Apellido</b></label>
				<input type="text" id="aprs" />
				<label><b>Correo</b></label>
				<input type="email" id="corrs" />
				<label><b>Contraseña</b></label>
				<input type="password" id="psars" />
				<label><b>Repite la contraseña</b></label>
				<input type="password" id="psbrs" />
				<article>
					<input type="checkbox" id="acdes" />
					<label><b>Aceptas dar información requerida para este sitio web</b></label>
				</article>
				<div id="txRa"></div>
				<input type="submit" value="Registrar" id="regusr" class="botonstyle" />
			</article>
			<article>
				<h2>Usario Registrados</h2>
				<form action="#" method="post" class="columninput">
					<label><b>Correo</b></label>
					<input type="email" id="coinb" required="required" />
					<label><b>Contraseña</b></label>
					<input type="password" id="pasinb" required="required" />
					<div id="txing"></div>
					<input type="submit" value="Ingresar" id="usreg" class="botonstyle" />
				</form>
			</article>
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