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
	<title>Modificación de <?php echo "$nmP"; ?></title>
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
		<h1>Datos <?php echo "$nmP"; ?></h1>
		<article id="automargen">
			<form action="modif_producto.php" method="post" class="columninput">
				<input type="text" name="idSp" value="<?php echo $idR ?>" required="required" style="display:none;" />
				<label><b>Nombre</b></label>
				<input type="text" name="ap" value="<?php echo $nmP ?>" required="required" />
				<label><b>Del cliente</b></label>
				<select id="bpcl" name="bp">
					<option value="0">Selecione</option>
					<?php
						$Tocl="SELECT * from cliente order by nam_cl asc";
						$sql_tocl=mysql_query($Tocl,$conexion) or die (mysql_error());
						while ($sa=mysql_fetch_array($sql_tocl)) {
							$idOcl=$sa['id_cl'];
							$nmOcl=$sa['nam_cl'];
							if ($idOcl==$clP) {
								$selcliente="selected";
							}
							else{
								$selcliente="";
							}
					?>
					<option value="<?php echo $idOcl ?>" <?php echo $selcliente ?>><?php echo "$nmOcl"; ?></option>
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
							if ($idOtp==$tpP) {
								$seltipo="selected";
							}
							else{
								$seltipo="";
							}
					?>
					<option value="<?php echo $idOtp ?>" <?php echo $seltipo ?>><?php echo "$nmOtp"; ?></option>
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
							if ($idOmk==$mkP) {
								$selmarka="selected";
							}
							else{
								$selmarka="";
							}
					?>
					<option value="<?php echo $idOmk ?>" <?php echo $selmarka ?>><?php echo "$nmOmk"; ?></option>
					<?php
						}
					?>
				</select>
				<label><b>Precio</b></label>
				<input type="number" name="ep" value="<?php echo $prP ?>" placeholder="solo números (10000.00)" required="required" />
				<label><b>Descripción</b></label>
				<textarea id="editor1" name="fp"><?php echo "$txP"; ?></textarea>
				<script>
					CKEDITOR.replace('fp');
				</script>
				<div id="msjA"></div>
				<input type="submit" value="Modificar" id="nvPr" class="botonstyle" />
			</form>
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