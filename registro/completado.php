<?php
	include '../config.php';
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
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../css/default/default.css" />
	<link rel="stylesheet" href="../css/nivo_slider.css" />
	<script src="../js/jquery_2_1_1.js"></script>
	<script src="../js/scrpag.js"></script>
	<script type="text/javascript">
		setTimeout(direcionar,3000);
		function direcionar () {
			window.location.href="../";
		}
	</script>
</head>
<body>
	<header>
		<figure id="logo">
			<a href="../">
				<img src="../imagenes/logo.png" alt="Logo" />
			</a>
		</figure>
		<nav>
			<a href="../registro">Registro</a>
			<a id="decar" href="../carrito.php">carrito 0 productos</a>
		</nav>
	</header>
	<nav id="mnP" class="aumnP">
		<a href="../" data-mn="0">Inicio</a>
		<?php
			$tiposP="SELECT * from tipo_producto order by id_tipo asc";
			$sql_tipoP=mysql_query($tiposP,$conexion) or die (mysql_error());
			while ($sl=mysql_fetch_array($sql_tipoP)) {
				$idtp=$sl['id_tipo'];
				$nmtp=$sl['nam_tipo'];
		?>
		<a href="../producto/ind2x.php?tp=<?php echo $idtp ?>" data-mn="<?php echo $idtp ?>"><?php echo "$nmtp"; ?></a>
		<?php
			}
		?>
		<a href="../contacto" data-mn="0">Contacto</a>
		<div id="busq" href="#"></div>
		<div id="btnmovil"></div>
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
	<aside id="busqueda" class="submen">
		<article>
			<input type="search" id="busplpd" />
			<div id="resultadoBs"></div>
		</article>
	</aside>
	<article id="versub" class="submen">
		<article id="lksubm"></article>
		<article id="imagsub">
			<article id="imgportd">
				<figure>
					<img src="../imagenes/bica.jpg" alt="bicicletas" />
				</figure>
			</article>
			<article id="unasimg">
				<figure>
					<img src="../imagenes/bicb.jpg" alt="bicicletas" />
				</figure>
				<figure>
					<img src="../imagenes/bicc.jpg" alt="bicicletas" />
				</figure>
				<figure>
					<img src="../imagenes/bicd.jpg" alt="bicicletas" />
				</figure>
			</article>
		</article>
	</article>
	<section>
		<h1>Registro Completado</h1>
		<article id="automargen" class="flexcjA">
			<p>
				Registro completado, le ha llegado un link de activación a su respectivo correo registrado.
			</p>
		</article>
	</section>
	<footer>
		<article id="automargen">
			<article id="redes">
				<a id="fa" href="" target="_blank"></a>
				<a id="tw" href="" target="_blank"></a>
				<a id="in" href="" target="_blank"></a>
			</article>
		</article>
	</footer>
</body>
</html>