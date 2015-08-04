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
	<title>Productos</title>
	<link rel="icon" href="../../../imagenes/icono.png" />
	<link rel="stylesheet" href="../../../css/normalize.css" />
	<link rel="stylesheet" href="../../../css/style.css" />
	<link rel="stylesheet" href="../../../css/style_adm.css" />
	<script src="../../../js/jquery_2_1_1.js"></script>
	<script src="../../../js/scrpag.js"></script>
	<script src="../../../js/scriadm.js"></script>
	<script src="../../../ckeditor/ckeditor.js"></script>
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
		<a href="#" id="nvb">Nuevo Producto</a>
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
		<h1>Imágenes</h1>
		<article id="automargen">
			<article id="cbj" class="datnvig">
				<form action="new_producto.php" method="post" class="columninput">
					<label><b>Nombre</b></label>
					<input type="text" name="ap" required="required" />
					<label><b>Del cliente</b></label>
					<select id="bpcl" name="bp">
						<option value="0">Selecione</option>
						<?php
							$Tocl="SELECT * from cliente order by nam_cl asc";
							$sql_tocl=mysql_query($Tocl,$conexion) or die (mysql_error());
							while ($sa=mysql_fetch_array($sql_tocl)) {
								$idOcl=$sa['id_cl'];
								$nmOcl=$sa['nam_cl'];
						?>
						<option value="<?php echo $idOcl ?>"><?php echo "$nmOcl"; ?></option>
						<?php
							}
						?>
					</select>
					<label><b>Del tipo</b></label>
					<select id="cptp" name="cp">
						<option value="0">Selecione</option>
						<?php
							$Totp="SELECT * from tipo_producto order by nam_tipo asc";
							$sql_totp=mysql_query($Totp,$conexion) or die (mysql_error());
							while ($sb=mysql_fetch_array($sql_totp)) {
								$idOtp=$sb['id_tipo'];
								$nmOtp=$sb['nam_tipo'];
						?>
						<option value="<?php echo $idOtp ?>"><?php echo "$nmOtp"; ?></option>
						<?php
							}
						?>
					</select>
					<label><b>Del subtipo</b></label>
					<select id="dpmk" name="dp">
						<option value="0">Selecione</option>
						<?php
							$Tomk="SELECT * from marca order by nam_mk asc";
							$sql_tomk=mysql_query($Tomk,$conexion) or die (mysql_error());
							while ($sc=mysql_fetch_array($sql_tomk)) {
								$idOmk=$sc['id_mk'];
								$nmOmk=$sc['nam_mk'];
						?>
						<option value="<?php echo $idOmk ?>"><?php echo "$nmOmk"; ?></option>
						<?php
							}
						?>
					</select>
					<label><b>Precio</b></label>
					<input type="number" name="ep" placeholder="solo números (10000.00)" required="required" />
					<label><b>Descripción</b></label>
					<textarea id="editor1" name="fp"></textarea>
					<script>
						CKEDITOR.replace('fp');
					</script>
					<div id="msjA"></div>
					<input type="submit" value="Ingresar" id="nvPr" class="botonstyle" />
				</form>
			</article>
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
				$ssql="SELECT * from producto order by id_producto asc";
				$rs=mysql_query($ssql,$conexion) or die (mysql_error());
				$num_total_registros= mysql_num_rows($rs);
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from producto order by id_producto asc limit $inicio, $tamno_pagina";
				$impsql=mysql_query($gsql,$conexion) or die (mysql_error());
				while ($gh=mysql_fetch_array($impsql)) {
					$idP=$gh['id_producto'];
					$nmP=$gh['nam_producto'];
					$clP=$gh['cl_id'];
					$tpP=$gh['tp_id'];
					$mkP=$gh['marca_id'];
					$ctP=$gh['cant_p'];
					$prP=$gh['precio_p'];
					$txP=$gh['text_p'];
					$ffP=$gh['fec_p'];
					$primera_imagern="SELECT * from img_pr where producto_id=$idP order by id_img_p asc limit 1";
					$sql_primer=mysql_query($primera_imagern,$conexion) or die (mysql_error());
					$numero=mysql_num_rows($sql_primer);
					if ($numero>0) {
						while ($cj=mysql_fetch_array($sql_primer)) {
							$imgP=$cj['ruta_pr'];
						}
					}
					else{
						$imgP="imagenes/producto/predeterminado.jpg";
					}
			?>
			<figure>
				<img src="../../../<?php echo $imgP ?>" alt="imagen<?php echo $idPmg ?>" />
				<figcaption class="columninput">
					<a id="adbtn" href="modifprodu.php?pd=<?php echo $idP ?>">Modificar</a>
					<a id="adbtn" href="imagenesProdu.php?pd=<?php echo $idP ?>">Ver Imágenes</a>
					<a href="../../../borrarProducto.php?br=<?php echo $idP ?>" class="dell">Borrar</a>
				</figcaption>
			</figure>
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