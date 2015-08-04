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
	<title>Producto Relación</title>
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
		<h1>Relación tallas a productos</h1>
		<article id="automargen" class="columninput">
			<h3>Nuevo relación</h3>
			<label><b>De la Talla</b></label>
			<select id="tlR">
				<option value="0">Selecione</option>
				<?php
					$Ttll="SELECT * from tallas order by nam_tll asc";
					$sql_ttll=mysql_query($Ttll,$conexion) or die (mysql_error());
					while ($ra=mysql_fetch_array($sql_ttll)) {
						$idTLL=$ra['id_tll'];
						$nmTLL=$ra['nam_tll'];
				?>
				<option value="<?php echo $idTLL ?>"><?php echo "$nmTLL"; ?></option>
				<?php
					}
				?>
			</select>
			<label><b>Del color</b></label>
			<select id="colR">
				<option value="0">Seleccione</option>
				<?php
					$todcolor="SELECT * from colores order by nam_color asc";
					$sql_todcolr=mysql_query($todcolor,$conexion) or die (mysql_error());
					while ($scl=mysql_fetch_array($sql_todcolr)) {
						$idcolor=$scl['id_color'];
						$nmcolor=$scl['nam_color'];
				?>
				<option value="<?php echo $idcolor ?>"><?php echo "$nmcolor"; ?></option>
				<?php
					}
				?>
			</select>
			<label><b>Cantidad</b></label>
			<input type="number" id="ctnR" />
			<label><b>Del los Productos</b></label>
			<article class="flexA">
				<?php
					$Tdprod="SELECT * from producto order by nam_producto asc";
					$sql_tpdou=mysql_query($Tdprod,$conexion) or die (mysql_error());
					while ($kpd=mysql_fetch_array($sql_tpdou)) {
						$idP=$kpd['id_producto'];
						$nmP=$kpd['nam_producto'];
				?>
				<div>
					<input type="checkbox" class="prd" name="bpd" value="<?php echo $idP ?>" 
					data-id="<?php echo $idP ?>" />
					<label><?php echo "$idP-$nmP"; ?></label>
				</div>
				<?php
					}
				?>
			</article>
			<div id="txJ"></div>
			<input type="submit" value="Ingresar" id="nvrel" class="botonstyle" />
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
				$ssql="SELECT * from pr_tal_rel order by id_rel asc";
				$rs=mysql_query($ssql,$conexion) or die (mysql_error());
				$num_total_registros= mysql_num_rows($rs);
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from pr_tal_rel order by id_rel asc limit $inicio, $tamno_pagina";
				$impsql=mysql_query($gsql,$conexion) or die (mysql_error());
				while ($gh=mysql_fetch_array($impsql)) {
					$idRl=$gh['id_rel'];
					$pdId=$gh['producto_id'];
					$tllId=$gh['talla_id'];
					$colid=$gh['color_id'];
					$ctnRl=$gh['cant_rel'];
			?>
			<article id="dates" class="columninput">
				<select id="fra_<?php echo $idRl ?>">
					<?php
						$Tutll="SELECT * from tallas order by nam_tll asc";
						$sql_tutll=mysql_query($Tutll,$conexion) or die (mysql_error());
						while ($arf=mysql_fetch_array($sql_tutll)) {
							$idOtl=$arf['id_tll'];
							$nmOtl=$arf['nam_tll'];
							if ($idOtl==$tllId) {
								$seltalla="selected";
							}
							else{
								$seltalla="";
							}
					?>
					<option value="<?php echo $idOtl ?>" <?php echo $seltalla ?>><?php echo "$nmOtl"; ?></option>
					<?php
						}
					?>
				</select>
				<select id="crol_<?php echo $idRl ?>">
					<?php
						$todoscolo="SELECT * from colores order by nam_color asc";
						$sql_doscolo=mysql_query($todoscolo,$conexion) or die (mysql_error());
						while ($Ucl=mysql_fetch_array($sql_doscolo)) {
							$didcl=$Ucl['id_color'];
							$dnmcl=$Ucl['nam_color'];
							if ($didcl==$colid) {
								$selcolor="selected";
							}
							else{
								$selcolor="";
							}
					?>
					<option value="<?php echo $didcl ?>" <?php echo $selcolor ?>><?php echo "$dnmcl"; ?></option>
					<?php
						}
					?>
				</select>
				<select id="frb_<?php echo $idRl ?>">
					<?php
						$TopdD="SELECT * from producto order by nam_producto asc";
						$sql_tpdT=mysql_query($TopdD,$conexion) or die (mysql_error());
						while ($brf=mysql_fetch_array($sql_tpdT)) {
							$idOpd=$brf['id_producto'];
							$nmOpd=$brf['nam_producto'];
							if ($idOpd==$pdId) {
								$selproducto="selected";
							}
							else{
								$selproducto="";
							}
					?>
					<option value="<?php echo $idOpd ?>" <?php echo $selproducto ?>><?php echo "$nmOpd"; ?></option>
					<?php
						}
					?>
				</select>
				<input type="number" id="frc_<?php echo $idRl ?>" value="<?php echo $ctnRl ?>" />
				<div id="txk_<?php echo $idRl ?>"></div>
				<input type="submit" value="Modificar" class="camrelaF" id="botostyl" data-id="<?php echo $idRl ?>" />
				<a href="borr_relacion.php?br=<?php echo $idRl ?>" class="dell">Borrar</a>
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
							<a href="relmkpr.php?pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

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