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
		$idR=$_GET['pd'];
		if ($idR=="") {
			echo "<script type='text/javascript'>";
				echo "alert('id producto no disponible');";
				echo "var pagina='../producto';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$datos="SELECT * from producto where id_producto=$idR";
			$sql_datos=mysql_query($datos,$conexion) or die (mysql_error());
			while ($dtK=mysql_fetch_array($sql_datos)) {
				$nmP=$dtK['nam_producto'];
				$clP=$dtK['cl_id'];
				$tpP=$dtK['tp_id'];
				$mkP=$dtK['marca_id'];
				$ctP=$dtK['cant_p'];
				$prP=$dtK['precio_p'];
				$txP=$dtK['text_p'];
				$ffP=$dtK['fec_p'];
			}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Imageens de Inicio" />
	<title>Imágenes <?php echo "$nmP"; ?></title>
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
		<a href="../producto">Ver Productos</a>
		<a href="#" id="nvb">Nuevo Producto</a>
		<a href="cliente.php">Clientes Productos</a>
		<a href="tipos.php">Tipos Productos</a>
		<a href="marka.php">Marcas Productos</a>
		<a href="tallas.php">Tallas</a>
		<a href="colores.php">Colores</a>
		<a href="relmkpr.php">Rel. producto-talla</a>
		<a href="#" id="nva">Nuevo Imagen</a>
	</nav>
	<nav id="mnB">
		<a href="../galery">Imagenes I.</a>
		<a href="../producto" class="sele">Productos</a>
		<a href="../factura">Ventas</a>
	</nav>
	<section>
		<h1>Imágenes <?php echo "$nmP"; ?></h1>
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
			<article id="caj" class="datnvig">
				<form action="#" method="post" enctype="multipart/form-data" id="pdPmy" class="columninput">
					<input type="text" id="idPD" name="idPD" value="<?php echo $idR ?>" required="required" style="display:none;" />
					<label><b>Selecione la imagen</b></label>
					<input type="file" id="imgPD" name="imgPD" required="required" />
					<div id="msjimgA"></div>
					<input type="submit" value="Ingresar y Subir" id="nvgmPdr" class="botonstyle" />
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
				$ssql="SELECT * from img_pr where producto_id=$idR order by id_img_p asc";
				$rs=mysql_query($ssql,$conexion) or die (mysql_error());
				$num_total_registros= mysql_num_rows($rs);
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from img_pr where producto_id=$idR order by id_img_p asc limit $inicio, $tamno_pagina";
				$impsql=mysql_query($gsql,$conexion) or die (mysql_error());
				while ($gh=mysql_fetch_array($impsql)) {
					$idimgP=$gh['id_img_p'];
					$imgP=$gh['ruta_pr'];
			?>
			<figure>
				<img src="../../../<?php echo $imgP ?>" alt="imagen<?php echo $idimgP ?>" />
				<figcaption class="columninput">
					<a href="../../../borrariamgenProducto.php?br=<?php echo $idimgP ?>&tbr=<?php echo $idR ?>" class="dell">Borrar</a>
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
							<a href="inimagenesProdu.php?pd=<?php echo $idR ?>&pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

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
	}
	else{
		echo "<script type='text/javascript'>";
			echo "var pagina='../../erroradm.html';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>