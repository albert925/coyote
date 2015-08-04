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
	<meta name="description" content="Imageens de Inicio" />
	<title>Productos colores</title>
	<link rel="icon" href="../../../imagenes/icono.png" />
	<link rel="stylesheet" href="../../../css/normalize.css" />
	<link rel="stylesheet" href="../../../css/style.css" />
	<link rel="stylesheet" href="../../../css/style_adm.css" />
	<script src="../../../js/jquery_2_1_1.js"></script>
	<script src="../../../js/scrpag.js"></script>
	<script src="../../../js/scriadm.js"></script>
	<script src="../../../js/producto.js"></script>
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
		<a href="../producto" class="sele">Productos</a>
		<a href="../factura">Ventas</a>
		<div id="btnmovil"></div>
	</nav>
	<nav id="mnC">
		<a href="../producto">Ver Productos</a>
		<a href="cliente.php">Clientes Productos</a>
		<a href="tipos.php">Tipos Productos</a>
		<a href="marka.php">Marcas Productos</a>
		<a href="tallas.php">Tallas</a>
		<a href="colores.php">Colores</a>
		<a href="relmkpr.php">Rel. producto-talla</a>
		<a href="imagenP.php">Nuevo Imagen Producto</a>
	</nav>
	<nav id="mnB">
		<a href="../galery">Imagenes I.</a>
		<a href="../producto" class="sele">Productos</a>
		<a href="../factura">Ventas</a>
	</nav>
	<section>
		<h1>Colores</h1>
		<article id="automargen" class="columninput">
			<h3>Nuevo color</h3>
			<label><b>Nombre</b></label>
			<input type="text" id="colornm" />
			<div id="txL"></div>
			<input type="submit" value="Ingresar" id="nvcolor" class="botonstyle" />
		</article>
		<article id="automargen" class="flexA">
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
				$ssql="SELECT * from colores order by nam_color asc";
				$rs=mysql_query($ssql,$conexion) or die (mysql_error());
				$num_total_registros= mysql_num_rows($rs);
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from colores order by nam_color asc limit $inicio, $tamno_pagina";
				$impsql=mysql_query($gsql,$conexion) or die (mysql_error());
				while ($gh=mysql_fetch_array($impsql)) {
					$idcolor=$gh['id_color'];
					$nmcolor=$gh['nam_color'];
			?>
			<article id="dates" class="columninput">
				<input type="text" id="Ftcolorm_<?php echo $idcolor ?>" value="<?php echo $nmcolor ?>" />
				<div id="txM_<?php echo $idcolor ?>"></div>
				<input type="submit" value="Modificar" class="camtcolorF" id="botostyl" data-id="<?php echo $idcolor ?>" />
				<a href="borr_color.php?br=<?php echo $idcolor ?>" class="dell">Borrar</a>
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
							<a href="colores.php?pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

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