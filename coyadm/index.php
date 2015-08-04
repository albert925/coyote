<?php
	include '../config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Ingreso de administración coyote store" />
	<title>Coyote Administrador</title>
	<link rel="icon" href="../imagenes/icono.png" />
	<link rel="stylesheet" href="../css/normalize.css" />
	<link rel="stylesheet" href="../css/iconos/style.css" />
	<link rel="stylesheet" href="../css/style.css" />
	<script src="../js/jquery_2_1_1.js"></script>
	<script src="../js/scrpag.js"></script>
	<script src="../js/admin.js"></script>
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
					<span id="decar">0</span>
				</div>
			</a>
		</nav>
	</header>
	<nav id="mnP">
		<?php
			$tiposP="SELECT * from tipo_producto order by nam_tipo asc";
			$sql_tipoP=mysql_query($tiposP,$conexion) or die (mysql_error());
			while ($sl=mysql_fetch_array($sql_tipoP)) {
				$idtp=$sl['id_tipo'];
				$nmtp=$sl['nam_tipo'];
		?>
		<a href="../producto/ind2x.php?tp=<?php echo $idtp ?>" data-mn="<?php echo $idtp ?>"><?php echo "$nmtp"; ?></a>
		<?php
			}
		?>
		<div id="btnmovil"><span class="icon-menu"></span></div>
	</nav>
	<nav id="mnB">
		<a href="../" class="sele">Inicio</a>
		<?php
			$BtiposPb="SELECT * from tipo_producto order by nam_tipo asc";
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
	<aside id="busqueda" class="submen">
		<article>
			<input type="search" id="busplpd" />
			<div id="resultadoBs"></div>
		</article>
	</aside>
	<article id="versub" class="submen"></article>
	<section>
		<h1>Ingreso Administrador</h1>
		<article id="automargen">
			<form action="#" method="post" class="columninput">
				<label><b>Usuario</b></label>
				<input type="text" id="usad" required="required" />
				<label><b>Contraseña</b></label>
				<input type="password" id="psad" required="required" />
				<div id="txA"></div>
				<input type="submit" value="Ingresar" id="ingad" class="botonstyle" />
			</form>
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