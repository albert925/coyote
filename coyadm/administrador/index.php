<?php
	include '../../config.php';
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
	<meta name="description" content="Adminitración de <?php echo $useradR ?>" />
	<title>Administrador <?php echo "$usad"; ?></title>
	<link rel="icon" href="../../imagenes/icono.png" />
	<link rel="stylesheet" href="../../css/normalize.css" />
	<link rel="stylesheet" href="../../css/style.css" />
	<link rel="stylesheet" href="../../css/style_adm.css" />
	<script src="../../js/jquery_2_1_1.js"></script>
	<script src="../../js/scrpag.js"></script>
	<script src="../../js/admin.js"></script>
</head>
<body>
	<header>
		<figure id="logo">
			<a href="">
				<img src="../../imagenes/logo.png" alt="Logo" />
			</a>
		</figure>
		<nav>
			<a href=""><?php echo "$usad"; ?></a>
			<a href="../../cerrar">Salir</a>
		</nav>
	</header>
	<nav id="mnP">
		<a href="galery">Imagenes I.</a><!--class="sele"-->
		<a href="producto">Productos</a>
		<a href="factura">Ventas</a>
		<div id="btnmovil"></div>
	</nav>
	<nav id="mnB">
		<a href="galery">Imagenes I.</a>
		<a href="producto">Productos</a>
		<a href="factura">Ventas</a>
	</nav>
	<section>
		<h1>Administrador <?php echo "$useradR"; ?></h1>
		<article id="automargen" class="flexA">
			<article class="columninput">
				<h2>Modificación nombre de usuario</h2>
				<input type="text" id="fadus" value="<?php echo $usad ?>" />
				<div id="txB"></div>
				<input type="submit" value="Modificar" id="cambA" class="botonstyle" data-adm="<?php echo $idad ?>" />
			</article>
			<article class="columninput">
				<h2>Modificación de correo</h2>
				<input type="email" id="fadcr" value="<?php echo $corad ?>" />
				<div id="txC"></div>
				<input type="submit" value="Modificar" id="cambB" class="botonstyle" data-adm="<?php echo $idad ?>" />
			</article>
			<article class="columninput">
				<h2>Modificación de contraseña</h2>
				<label><b>Contraseña actual</b></label>
				<input type="password" id="psA" />
				<label><b>Contraseña nueva</b></label>
				<input type="password" id="psna" />
				<label><b>Repite la contraseña nueva</b></label>
				<input type="password" id="psnb" />
				<div id="txD"></div>
				<input type="submit" value="Modificar" id="cambC" class="botonstyle" data-adm="<?php echo $idad ?>" />
			</article>
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
			echo "var pagina='../erroradm.html';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>