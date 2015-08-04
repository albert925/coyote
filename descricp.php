<?php
	include 'config.php';
	session_start();
	if (isset($_SESSION['us'])) {
		$usR=$_SESSION['us'];
		$datosusuario="SELECT * from usuario where id_us=$usR";
		$sql_user=mysql_query($datosusuario,$conexion) or die (mysql_error());
		while ($ss=mysql_fetch_array($sql_user)) {
			$idus=$ss['id_us'];
			$imgus=$ss['avat_us'];
			$nmus=$ss['nam_us'];
			$apus=$ss['ape_us'];
			$corus=$ss['correo_us'];
			$telus=$ss['telefono_us'];
			$celus=$ss['celular_us'];
			$paisus=$ss['pais_id'];
			$ciudus=$ss['ciudad_id'];
			$dirus=$ss['direccion_us'];
			$tipus=$ss['tip_us'];
			$estus=$ss['estd_us'];
		}
	}
	else{
		$idus=0;
	}
	$idR=$_GET['pd'];
	if ($idR=="") {
		echo "<script type='text/javascript'>";
			echo "alert('id producto no disponible');";
			echo "var pagina='producto';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
	else{
		$datos="SELECT * from producto 
			inner join cliente on(producto.cl_id=cliente.id_cl) 
			inner join tipo_producto on(producto.tp_id=tipo_producto.id_tipo) 
			inner join marca on(producto.marca_id=marca.id_mk) 
			where id_producto=$idR";
		$sql_datos=mysql_query($datos,$conexion) or die (mysql_error());
		while ($dgt=mysql_fetch_array($sql_datos)) {
			$nmP=$dgt['nam_producto'];
			$clP=$dgt['cl_id'];
			$tpP=$dgt['tp_id'];
			$mkP=$dgt['marca_id'];
			$ctP=$dgt['cant_p'];
			$prP=$dgt['precio_p'];
			$txP=$dgt['text_p'];
			$ffP=$dgt['fec_p'];
			$nOmcl=$dgt['nam_cl'];
			$nOmtp=$dgt['nam_tipo'];
			$nOmk=$dgt['nam_mk'];
			$primerimagen="SELECT * from img_pr where producto_id=$idR order by id_img_p asc limit 1";
			$sql_primerimg=mysql_query($primerimagen,$conexion) or die (mysql_error());
			while ($kgm=mysql_fetch_array($sql_primerimg)) {
				$rutimgP=$kgm['ruta_pr'];
			}
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="<?php echo $nmP ?>" />
	<title><?php echo "$nmP"; ?></title>
	<link rel="icon" href="imagenes/icono.png" />
	<link rel="image_src" href="<?php echo $rutimgP ?>" />
	<link rel="stylesheet" href="css/normalize.css" />
	<link rel="stylesheet" href="css/iconos/style.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/cloudzoom.css" />
	<script src="js/jquery_2_1_1.js"></script>
	<script src="js/scrpag.js"></script>
	<script src="js/cloudzoom.js"></script>
</head>
<body>
	<header>
		<figure id="logo">
			<a href="index.php">
				<img src="imagenes/logo.png" alt="Logo" />
			</a>
		</figure>
		<aside id="busqueda">
			<article>
				<input type="search" id="busplpd" /><span class="icon-search"></span>
			</article>
			<div id="resultadoBs"></div>
		</aside>
		<nav>
			<?php
				if ($idus=="0") {
			?>
			<a id="inus" href="registro">
				<figure></figure>
			</a>
			<?php
				}
				else{
					if ($imgus=="") {
						$rutavatar="";
					}
					else{
						$rutavatar=$imgus;
					}
			?>
			<div id="senin">
				<a href="usuario"><figure style="background-image:url(<?php echo $rutavatar ?>);"></figure></a>
				<a href="cerrar/us.php">Salir</a>
			</div>
			<?php
				}
			?>
			<a href="carrito.php">
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
				<a href="producto/ind2x.php?tp=<?php echo $idtp ?>" data-mn="<?php echo $idtp ?>"><?php echo "$nmtp"; ?></a>
				<ul>
					<?php
						$Mkkk="SELECT * from marca where tipo_id=$idtp order by nam_mk asc";
						$sql_Mkkk=mysql_query($Mkkk,$conexion) or die (mysql_error());
						while ($kkm=mysql_fetch_array($sql_Mkkk)) {
							$widmk=$kkm['id_mk'];
							$wnmmk=$kkm['nam_mk'];
					?>
					<li><a href="producto/ind3x.php?ba=0&bb=<?php echo $idtp ?>&bc=<?php echo $widmk ?>&bd=0&be=&bf=&bg="><?php echo "$wnmmk"; ?></a></li>
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
			<li><a href="factura" data-mn="0">Historial compras</a></li>
			<?php
				}
			?>
		</ul>
		<div id="btnmovil"><span class="icon-menu"></span></div>
	</nav>
	<nav id="mnB">
		<a href="index.php">Inicio</a>
		<a href="nosotros">Nosotros</a>
		<?php
			$BtiposPb="SELECT * from tipo_producto order by id_tipo asc";
			$bsql_tipoPB=mysql_query($BtiposPb,$conexion) or die (mysql_error());
			while ($slB=mysql_fetch_array($bsql_tipoPB)) {
				$Bidtp=$slB['id_tipo'];
				$Bnmtp=$slB['nam_tipo'];
		?>
		<a href="producto/ind2x.php?tp=<?php echo $Bidtp ?>"><?php echo "$Bnmtp"; ?></a>
		<?php
			}
		?>
		<a href="contacto">Contacto</a>
		<?php
			if ($idus!="0") {
		?>
		<a href="factura">Historial compras</a>
		<?php
			}
		?>
	</nav>
	<aside id="login">
		<article>
			<a href="registro">Registrarse</a>
		</article>
		<form action="#" method="post" class="columninput">
			<article>
				<input type="email" id="corus" required="required" placeholder="Correo" />
				<input type="password" id="psus" required="required" palceholder="Contraseña" />
				<input type="submit" value="Ingresar" id="bnigus" class="botonstyle" />
			</article>
			<div id="txus"></div>
		</form>
	</aside>
	<section>
		<h1><?php echo "$nmP"; ?></h1>
		<article id="automargen" class="flexdescri">
			<figure id="galerdes">
				<img class="cloudzoom" src="<?php echo $rutimgP ?>" alt="<?php echo $nmP ?>" 
					data-cloudzoom="zoomImage: '<?php echo $rutimgP ?>'" />
				<figcaption>
					<?php
						$todsimgP="SELECT * from img_pr where producto_id=$idR order by id_img_p asc";
						$sql_todgm=mysql_query($todsimgP,$conexion) or die (mysql_error());
						while ($kgm=mysql_fetch_array($sql_todgm)) {
							$idrtg=$kgm['id_img_p'];
							$rtkgmi=$kgm['ruta_pr'];
					?>
					<figure>
						<img class="cloudzoom-gallery" src="<?php echo $rtkgmi ?>" alt="imagen<?php echo $idrtg ?>" 
							data-cloudzoom="useZoom: '.cloudzoom', image: '<?php echo $rtkgmi ?>', zoomImage: '<?php echo $rtkgmi ?>'" />
					</figure>
					<?php
						}
					?>
				</figcaption>
				<script type="text/javascript">
					CloudZoom.quickStart();
				</script>
			</figure>
			<article id="texdexpro">
				<h2><?php echo "$nOmcl $nOmtp $nOmk"; ?></h2>
				<center>
					<a class="cardsn" href="carrito.php?pd=<?php echo $idR ?>">Agregar al carrito</a>
				</center>
				<article>
					<?php echo "$txP"; ?>
				</article>
			</article>
		</article>
	</section>
	<footer>
		<article class="flexfoot">
			<article>
				<a href="" class="sele">Inicio</a>
				<a href="nosotros">Nosotros</a>
				<a href="contacto">Contacto</a>
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
<?php
	}
?>