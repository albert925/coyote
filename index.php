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
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="" />
	<title>Coyote Store</title>
	<link rel="icon" href="imagenes/icono.png" />
	<link rel="image_src" href="imagenes/icono.png" />
	<link rel="stylesheet" href="css/normalize.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/iconos/style.css" />
	<link rel="stylesheet" href="css/default/default.css" />
	<link rel="stylesheet" href="css/nivo_slider.css" />
	<link rel="stylesheet" href="css/swiper.css" />
	<link rel="stylesheet" href="css/css/elastislide.css" />
	<script src="js/jquery_2_1_1.js"></script>
	<script src="js/scrpag.js"></script>
</head>
<body>
	<header>
		<figure id="logo">
			<a href="">
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
		<a href="" class="sele">Inicio</a>
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
	<article id="automargen">
		<figure id="galery">
			<div class="slider-wrapper theme-default">
				<div id="slider" class="nivoSlider">
					<?php
						$galimg="SELECT * from galery order by id_gal asc";
						$sql_gal=mysql_query($galimg,$conexion) or die (mysql_error());
						while ($dg=mysql_fetch_array($sql_gal)) {
							$idgl=$dg['id_gal'];
							$nmgl=$dg['rut_gal'];
							$pdgl=$dg['producto_id'];
					?>
					<img src="<?php echo $nmgl ?>" alt="imagen<?php echo $idgl ?>" /><!--title="#caption<?php echo $idgl ?>"-->
					<?php
						}
					?>
				</div>
				<!--div id="caption1" style="display:none;">
					<h2>Guia</h2>
				</div><caption-->
			</div>
		</figure>	
	</article>
	<script src="js/nivo_slider.js"></script>
	<script type="text/javascript">
		$(window).load(function(){
				$('#slider').nivoSlider({
					effect: 'boxRainGrowReverse',
					slices: 15,
					boxCols: 8,
					boxRows: 4,
					animSpeed: 800,
					pauseTime: 3000,
					startSlide: 0,
					directionNav: true,
					controlNav: true,
					controlNavThumbs: false,
					pauseOnHover: true,
					manualAdvance: false,
					prevText: 'Prev',
					nextText: 'Next',
					randomStart: false,
				});
		});
		// http://web.tursos.com/como-implementar-nivo-slider-en-tu-pagina-web/
	</script>
	<section id="colorun">
		<article id="automargen" class="cjaaun">
			<article class="swiper-container">
				<article class="swiper-wrapper">
					<div class="swiper-slide">
						<article id="nos_consli">
							<figure>
								<img src="imagenes/bici_nosotros.jpg" alt="bici_nosotros" />
							</figure>
							<figcaption>
								<h2>Misión</h2>
								Ser la mejor opción empresarial enfocada en satisfacer las necesidades de nuestra 
								comunidad en productos y servicios relacionados con la práctica del deporte y 
								la recreación garantizándoles la máxima calidad, respaldo y asesoría a través 
								de nuestros canales de ventas alta mente capacitados para que de esta manera 
								nuestros clientes obtengan las mejores condiciones para su desarrollo integral 
								en respuesta a su esfuerzo individual y en equipo Aportando con ello nuestro 
								conocimiento y experiencia en pro de la salud física y mental de nuestra sociedad. 
							</figcaption>
						</article>
					</div>
					<div class="swiper-slide">
						<article id="nos_consli">
							<figure>
								<img src="imagenes/bicb.jpg" alt="bici_nosotros" />
							</figure>
							<figcaption>
								<h2>Visión</h2>
								Todo nuestro equipo de trabajo tiene como meta en común, 
								lograr que COYOTE STORE S.A.S. crezca y se consolide como la 
								empresa de artículos deportivos de mayor prestigio y tradición en el 
								departamento de sucre y la región Caribe. 
							</figcaption>
						</article>
					</div>
					<div class="swiper-slide">
						<article id="nos_consli">
							<figure>
								<img src="imagenes/bicd.jpg" alt="bici_nosotros" />
							</figure>
							<figcaption>
								<h2>Valores</h2>
								Creemos en Dios y le Creemos a Dios por lo tanto somos fieles a sus preceptos y sin estos valores no podríamos prestar nuestros servicios.
								<ul>
									<li>Conocimiento</li>
									<li>Creatividad</li>
									<li>Disciplina</li>
									<li>Trabajo en equipo </li>
									<li>Liderazgo</li>
									<li>Reconocimiento</li>
									<li>Calidad</li>
									<li>Competitividad</li>
									<li>Identidad</li>
									<li>Espíritu de servicio</li>
								</ul>
							</figcaption>
						</article>
					</div>
				</article>
				<div class="swiper-pagination"></div>
			</article>
		</article>
	</section>
	<section id="colordo">
		<article id="automargen" class="cjaaun">
			<ul id="carousel" class="elastislide-list">
				<?php
					$TodasProdImp="SELECT * from producto order by id_producto desc limit 6";
					$sql_todpr=mysql_query($TodasProdImp,$conexion) or die (mysql_error());
					while ($uty=mysql_fetch_array($sql_todpr)) {
						$idP=$uty['id_producto'];
						$nmP=$uty['nam_producto'];
						$primerimg="SELECT * from img_pr where producto_id=$idP order by id_img_p asc limit 1";
						$sql_img=mysql_query($primerimg,$conexion) or die (mysql_error());
						while ($gm=mysql_fetch_array($sql_img)) {
							$rutimgP=$gm['ruta_pr'];
						}
				?>
				<li>
					<a href="descricp.php?pd=<?php echo $idP ?>">
						<img src="<?php echo $rutimgP ?>" alt="<?php echo $nmP ?>">
					</a>
				</li>
				<?php
					}
				?>
			</ul>
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
	<script src="js/swiper.js"></script>
	<script type="text/javascript">
		var swiper = new Swiper('.swiper-container', {
			pagination: '.swiper-pagination',
			direction: 'vertical',
			paginationClickable: true,
			spaceBetween: 30,
			autoplay: 10500,
			autoplayDisableOnInteraction: false
		});
	</script>
	<script src="js/modernizr.custom.17475.js"></script>
	<script src="js/jquerypp.custom.js"></script>
	<script src="js/jquery.elastislide.js"></script>
	<script type="text/javascript">
		$( '#carousel' ).elastislide();
	</script>
</body>
</html>