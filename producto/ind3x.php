<?php
	include '../config.php';
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
	$a=$_GET['ba'];//cliente
	$b=$_GET['bb'];//tipo
	$c=$_GET['bc'];//subtipo
	$d=$_GET['bd'];//orden
	$e=$_GET['be'];//array tallas
	$f=$_GET['bf'];//minimo precio
	$g=$_GET['bg'];//maximo precio
	function consult($arrob)
	{
		$talsplit=split(",",$arrob);
		$busctall="";
		for ($ji=0; $ji <count($talsplit) ; $ji++) { 
			$tallaar=$talsplit[$ji];
			$busctall="$tallaar,".$busctall;
		}
		return $busctall;
	}
	switch ($a) {
		case '':
			$aa="1";
			break;
		case '0':
			$aa="1";
			break;
		default:
			$aa="cl_id=$a";
			break;
	}
	switch ($b) {
		case '':
			$bb="";
			break;
		case '0':
			$bb="";
			break;
		default:
			$bb="and tp_id=$b";
			break;
	}
	switch ($c) {
		case '':
			$cc="";
			break;
		case '0':
			$cc="";
			break;
		default:
			$cc="and marca_id=$c";
			break;
	}
	switch ($e) {
		case '':
			$ee="";
			break;
		case '0':
			$ee="";
			break;
		case 'null':
			$ee="";
			break;
		case 'false':
			$ee="";
			break;
		default:
			$ee=consult($e)."0";
			break;
	}
	switch ($f) {
		case '':
			$ff="";
			break;
		case '0':
			$ff="";
			break;
		case 'undefined':
			$ff="";
			break;
		default:
			$ff="and precio_p>=$f";
			break;
	}
	switch ($g) {
		case '':
			$gg="";
			break;
		case '0':
			$gg="";
			break;
		case 'undefined':
			$gg="";
			break;
		default:
			$gg="and precio_p<=$g";
			break;
	}
	$ornc=["id_producto asc",
				"nam_producto asc",
				"nam_producto desc",
				"precio_p asc",
				"precio_p desc"];
	$eesplit=split(",",$e);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="" />
	<title>Coyote productos</title>
	<link rel="icon" href="../imagenes/icono.png" />
	<link rel="image_src" href="../imagenes/icono.png" />
	<link rel="stylesheet" href="../css/normalize.css" />
	<link rel="stylesheet" href="../css/iconos/style.css" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../css/productos.css" />
	<script src="../js/jquery_2_1_1.js"></script>
	<script src="../js/scrpag.js"></script>
	<script src="../js/filtros.js"></script>
</head>
<body>
	<header>
		<figure id="logo">
			<a href="../">
				<img src="../imagenes/logo.png" alt="Logo" />
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
			<a id="inus" href="../registro">
				<figure></figure>
			</a>
			<?php
				}
				else{
					if ($imgus=="") {
						$rutavatar="";
					}
					else{
						$rutavatar="../".$imgus;
					}
			?>
			<div id="senin">
				<a href="../usuario"><figure style="background-image:url(<?php echo $rutavatar ?>);"></figure></a>
				<a href="../cerrar/us.php">Salir</a>
			</div>
			<?php
				}
			?>
			<a href="../carrito.php">
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
					if ($idtp==$b) {
						$stylmenu="class='sele'";
					}
					else{
						$stylmenu="";
					}
			?>
			<li>
				<a href="../producto/ind2x.php?tp=<?php echo $idtp ?>" <?php echo $stylmenu ?> data-mn="<?php echo $idtp ?>"><?php echo "$nmtp"; ?></a>
				<ul>
					<?php
						$Mkkk="SELECT * from marca where tipo_id=$idtp order by nam_mk asc";
						$sql_Mkkk=mysql_query($Mkkk,$conexion) or die (mysql_error());
						while ($kkm=mysql_fetch_array($sql_Mkkk)) {
							$widmk=$kkm['id_mk'];
							$wnmmk=$kkm['nam_mk'];
					?>
					<li><a href="../producto/ind3x.php?ba=0&bb=<?php echo $idtp ?>&bc=<?php echo $widmk ?>&bd=0&be=&bf=&bg="><?php echo "$wnmmk"; ?></a></li>
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
			<li><a href="../factura" data-mn="0">Historial compras</a></li>
			<?php
				}
			?>
		</ul>
		<div id="btnmovil"><span class="icon-menu"></span></div>
	</nav>
	<nav id="mnB">
		<a href="../">Inicio</a>
		<a href="../nosotros">Nosotros</a>
		<?php
			$BtiposPb="SELECT * from tipo_producto order by id_tipo asc";
			$bsql_tipoPB=mysql_query($BtiposPb,$conexion) or die (mysql_error());
			while ($slB=mysql_fetch_array($bsql_tipoPB)) {
				$Bidtp=$slB['id_tipo'];
				$Bnmtp=$slB['nam_tipo'];
				if ($Bidtp==$b) {
					$clasedus="class='sele'";
				}
				else{
					$clasedus="";
				}
		?>
		<a <?php echo $clasedus ?> href="../producto/ind2x.php?tp=<?php echo $Bidtp ?>"><?php echo "$Bnmtp"; ?></a>
		<?php
			}
		?>
		<a href="../contacto">Contacto</a>
		<?php
			if ($idus!="0") {
		?>
		<a href="../factura">Historial compras</a>
		<?php
			}
		?>
	</nav>
	<aside id="login">
		<article>
			<a href="../registro">Registrarse</a>
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
		<div id="coulto" data-ary="<?php echo $e ?>" style="display:none;"></div>
		<h1>Productos</h1>
		<section id="automargen" class="secfl">
			<div id="btnfl">Filtros</div>
			<article id="filtro">
				<div class="disctg">Categorias</div>
				<select id="fla">
					<option value="0">Género</option>
					<?php
						$Todcl="SELECT * from cliente order by nam_cl asc";
						$sql_todcl=mysql_query($Todcl,$conexion) or die (mysql_error());
						while ($vcl=mysql_fetch_array($sql_todcl)) {
							$idcl=$vcl['id_cl'];
							$nmcl=$vcl['nam_cl'];
							if ($idcl==$a) {
								$selcl="selected";
							}
							else{
								$selcl="";
							}
					?>
					<option value="<?php echo $idcl ?>" <?php echo $selcl ?>><?php echo "$nmcl"; ?></option>
					<?php
						}
					?>
				</select>
				<select id="flb">
					<option value="0">Categorias</option>
					<?php
						$Tdtp="SELECT * from tipo_producto order by nam_tipo asc";
						$sql_todtp=mysql_query($Tdtp,$conexion) or die (mysql_error());
						while ($vtp=mysql_fetch_array($sql_todtp)) {
							$Uidtp=$vtp['id_tipo'];
							$Unmtp=$vtp['nam_tipo'];
							if ($Uidtp==$b) {
								$seltp="selected";
							}
							else{
								$seltp="";
							}
					?>
					<option value="<?php echo $Uidtp ?>" <?php echo $seltp ?>><?php echo "$Unmtp"; ?></option>
					<?php
						}
					?>
				</select>
				<select id="flc">
					<option value="0">Marcas</option>
					<?php
						$Todmk="SELECT * from marca where tipo_id=$b order by nam_mk asc";
						$sql_todmk=mysql_query($Todmk,$conexion) or die (mysql_error());
						while ($vmk=mysql_fetch_array($sql_todmk)) {
							$Uidmk=$vmk['id_mk'];
							$Unmmk=$vmk['nam_mk'];
							if ($Uidmk==$c) {
								$selmk="selected";
							}
							else{
								$selmk="";
							}
					?>
					<option value="<?php echo $Uidmk ?>" <?php echo $selmk ?>><?php echo "$Unmmk"; ?></option>
					<?php
						}
					?>
				</select>
				<select id="fld">
					<?php
						$ordepalbra=["ordernar","A-Z","Z-A","Precio Menor a Mayor","Precio Mayor a Menor"];
						for ($dor=0; $dor <=4 ; $dor++) {
							if ($dor==$d) {
								$selorden="selected";
							}
							else{
								$selorden="";
							}
					?>
					<option value="<?php echo $dor ?>" <?php echo $selorden ?>><?php echo $ordepalbra[$dor]; ?></option>
					<?php
						}
					?>
				</select>
				<div class="disctg">Tamaño</div>
				<?php
					$tll="SELECT * from tallas order by nam_tll asc";
					$sql_tll=mysql_query($tll,$conexion) or die(mysql_error());
					while ($lt=mysql_fetch_array($sql_tll)) {
						$idtall=$lt['id_tll'];
						$nmtll=$lt['nam_tll'];
				?>
				<div id="tamm">
					<input type="checkbox" id="fle_<?php echo $idtall ?>" class="tdfl" value="<?php echo $idtall ?>" data-id="<?php echo $idtall ?>" />
					<label for="fle_<?php echo $idtall ?>"><?php echo "$nmtll"; ?></label>
				</div>
				<?php
					}
				?>
				<div class="disctg">Precio</div>
				<div id="prec">
					<input type="number" id="flf" value="<?php echo $f ?>" />&nbsp;
					<span>-</span>&nbsp;
					<input type="number" id="flg" value="<?php echo $g ?>" />&nbsp;
					<input type="button" value="go" id="rang" />
				</div>
			</article>
			<article class="flexcjB">
				<?php
					error_reporting(E_ALL ^ E_NOTICE);
					$tamno_pagina=25;
					$pagina= $_GET['pagina'];
					if (!$pagina) {
						$inicio=0;
						$pagina=1;
					}
					else{
						$inicio= ($pagina - 1)*$tamno_pagina;
					}
					if ($e=="0" || $e=="" || $e=="null" || $e=="false") {
						$ssql="SELECT * from producto 
							where $aa $bb $cc $ff $gg order by $ornc[$d]";
						$rs=mysql_query($ssql,$conexion) or die (mysql_error());
						$num_total_registros= mysql_num_rows($rs);
						$total_paginas= ceil($num_total_registros / $tamno_pagina);
						$gsql="SELECT * from producto 
							where $aa $bb $cc $ff $gg order by $ornc[$d] limit $inicio, $tamno_pagina";
					}
					else{
						$ssql="SELECT * from pr_tal_rel 
								inner join producto on(pr_tal_rel.producto_id=producto.id_producto) 
								inner join colores on(pr_tal_rel.color_id=colores.id_color) 
							where $aa $bb $cc $ff $gg and pr_tal_rel.talla_id in ($ee) order by $ornc[$d]";
						$rs=mysql_query($ssql,$conexion) or die (mysql_error());
						$num_total_registros= mysql_num_rows($rs);
						$total_paginas= ceil($num_total_registros / $tamno_pagina);
						$gsql="SELECT * from pr_tal_rel 
								inner join producto on(pr_tal_rel.producto_id=producto.id_producto) 
								inner join colores on(pr_tal_rel.color_id=colores.id_color) 
							where $aa $bb $cc $ff $gg and pr_tal_rel.talla_id in ($ee) order by $ornc[$d] limit $inicio, $tamno_pagina";
					}
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
						$primerimagen="SELECT * from img_pr where producto_id=$idP order by id_img_p asc limit 1";
						$sql_primerimg=mysql_query($primerimagen,$conexion) or die (mysql_error());
						while ($kgm=mysql_fetch_array($sql_primerimg)) {
							$rutimgP=$kgm['ruta_pr'];
						}
						$forprecPP=number_format($prP);
				?>
				<figure id="prod_<?php echo $idP ?>" class="prodVer" data-id="<?php echo $idP ?>">
					<img src="../<?php echo $rutimgP ?>" alt="<?php echo $nmP ?>" />
					<figcaption class="columninput">
						<b><?php echo "$nmP"; ?></b>
						<b><?php echo "$forprecPP"; ?></b>
						<a href="../descricp.php?pd=<?php echo $idP ?>">Descripción</a>
						<a href="../carrito.php?pd=<?php echo $idP ?>">Agregar al carrito</a>
					</figcaption>
				</figure>
				<?php
					}
				?>
			</article>
		</section>
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
							<a href="ind3x.php?ba=<?php echo $a ?>&bb=<?php echo $b ?>&bc=<?php echo $c ?>&bd=<?php echo $d ?>&be=<?php echo $e ?>&bf=<?php echo $f ?>&bg=<?php echo $g ?>&pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

				<?php
						}
					}
				}
			?>
		</article>
	</section>
	<footer>
		<article class="flexfoot">
			<article>
				<a href="../">Inicio</a>
				<a href="../nosotros">Nosotros</a>
				<a href="../contacto">Contacto</a>
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