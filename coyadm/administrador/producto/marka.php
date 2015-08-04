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
	<title>Productos marcas</title>
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
		<h1>Marcas o subtipos de Productos</h1>
		<article id="automargen" class="columninput">
			<h3>Nuevo marca o subtipo</h3>
			<label><b>Nombre</b></label>
			<input type="text" id="mknm" />
			<label><b>Del tipo</b></label>
			<select id="dstp">
				<option value="0">Selecione</option>
				<?php
					$Tdtipos="SELECT * from tipo_producto order by nam_tipo asc";
					$sql_tdtp=mysql_query($Tdtipos,$conexion) or die (mysql_error());
					while ($Utp=mysql_fetch_array($sql_tdtp)) {
						$idTtp=$Utp['id_tipo'];
						$nmTtp=$Utp['nam_tipo'];
				?>
				<option value="<?php echo $idTtp ?>"><?php echo "$nmTtp"; ?></option>
				<?php
					}
				?>
			</select>
			<div id="txE"></div>
			<input type="submit" value="Ingresar" id="nvmk" class="botonstyle" />
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
				$ssql="SELECT * from marca order by nam_mk asc";
				$rs=mysql_query($ssql,$conexion) or die (mysql_error());
				$num_total_registros= mysql_num_rows($rs);
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from marca order by nam_mk asc limit $inicio, $tamno_pagina";
				$impsql=mysql_query($gsql,$conexion) or die (mysql_error());
				while ($gh=mysql_fetch_array($impsql)) {
					$idmk=$gh['id_mk'];
					$tpmk=$gh['tipo_id'];
					$nmmk=$gh['nam_mk'];
			?>
			<article id="dates" class="columninput">
				<input type="text" id="Fmkm_<?php echo $idmk ?>" value="<?php echo $nmmk ?>" />
				<select id="fpftp_<?php echo $idmk ?>">
					<?php
						$Otiposu="SELECT * from tipo_producto order by nam_tipo asc";
						$sqOutp=mysql_query($Otiposu,$conexion) or die (mysql_error());
						while ($ouo=mysql_fetch_array($sqOutp)) {
							$idoutp=$ouo['id_tipo'];
							$nmoutp=$ouo['nam_tipo'];
							if ($idoutp==$tpmk) {
								$seltipo="selected";
							}
							else{
								$seltipo="";
							}
					?>
					<option value="<?php echo $idoutp ?>" <?php echo $seltipo ?>><?php echo "$nmoutp"; ?></option>
					<?php
						}
					?>
				</select>
				<div id="txF_<?php echo $idmk ?>"></div>
				<input type="submit" value="Modificar" class="cammkF" id="botostyl" data-id="<?php echo $idmk ?>" />
				<a href="borr_marca.php?br=<?php echo $idmk ?>" class="dell">Borrar</a>
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
							<a href="marka.php?pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

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