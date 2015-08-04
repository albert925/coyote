var expr=/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$(document).on("ready",inicio_usuario);
var mal={color:"#A54434"};
var normal={color:"#fff"};
var bien={color:"#B3D341"};
function es_imagen (tipederf) {
	switch(tipederf.toLowerCase()){
		case 'jpg':
			return true;
			break;
		case 'gif':
			return true;
			break;
		case 'png':
			return true;
			break;
		case 'jpeg':
			return true;
			break;
		default:
			return false;
			break;
	}
}
function inicio_usuario () {
	$("#camA").on("click",cambiouno);
	$("#camB").on("click",cambiodos);
	$("#camC").on("click",cambiotres);
	$("#nvAv").on("click",nuevo_avatar);
}
function cambiouno () {
	var ida=$(this).attr("data-us");
	var ana=$("#nmuF").val();
	var bnb=$("#apuF").val();
	var cnc=$("#teluF").val();
	var dnd=$("#celuF").val();
	var ene=$("#pscr").val();
	var fnf=$("#cdcr").val();
	var gng=$("#druF").val();
	if (ana=="") {
		$("#txA").css(mal).text("ingrese el nombre");
	}
	else{
		if (bnb=="") {
			$("#txA").css(mal).text("ingrese el apellido");
		}
		else{
			if (ene=="0" || ene=="") {
				$("#txA").css(mal).text("Selecione el pais");
			}
			else{
				if (fnf=="0" || fnf=="") {
					$("#txA").css(mal).text("Selecione la ciudad");
				}
				else{
					$("#txA").css(normal).text("");
					$("#txA").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
					$.post("modif_dats.php",{ad:ida,a:ana,b:bnb,c:cnc,d:dnd,e:ene,f:fnf,g:gng},resuldates);
				}
			}
		}
	}
}
function resuldates (usRa) {
	if (usRa=="2") {
		$("#txA").css(bien).text("Datos modificaods");
		location.reload(20);
	}
	else{
		$("#txA").css(mal).html(usRa);
	}
}
function cambiodos () {
	var idb=$(this).attr("data-us");
	var corR=$("#coruF").val();
	if (corR=="" || !expr.test(corR)) {
		$("#txB").css(mal).text("ingrese el correo");
	}
	else{
		$("#txB").css(normal).text("");
		$("#txB").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$.post("camb_correo.php",{bd:idb,cc:corR},resulcorr);
	}
}
function resulcorr (usRb) {
	if (usRb=="2") {
		$("#txB").css(mal).text("Correo ingresado ya existe");
	}
	else{
		if (usRb=="3") {
			$("#txB").css(bien).text("Mensaje enviado");
			window.location.href="mesUs.php";
		}
		else{
			$("#txB").css(mal).html(usRb);
		}
	}
}
function cambiotres () {
	var idc=$(this).attr("data-us");
	var coac=$("#psac").val();
	var cona=$("#psan").val();
	var conb=$("#psbn").val();
	if (coac=="") {
		$("#txC").css(mal).text("Ingrese la contraseña actual");
	}
	else{
		if (cona=="" || cona.length<6) {
			$("#txC").css(mal).text("Contraseña mínimo 6 dígitos");
		}
		else{
			if (conb!=cona) {
				$("#txC").css(mal).text("Contraseñas no coinciden");
			}
			else{
				$("#txC").css(normal).text("");
				$("#txC").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
				$.post("modif_psps.php",{cd:idc,pa:coac,pb:cona},resulcontra);
			}
		}
	}
}
function resulcontra (csosp) {
	if (csosp=="2") {
		$("#txC").css(mal).text("Contraseña actual erronea");
	}
	else{
		if (csosp=="3") {
			$("#txC").css(bien).text("Contraseña cambiada");
			setTimeout(direcion,2500);
		}
		else{
			$("#txC").css(mal).html(csosp);
		}
	}
}
function direcion (){
	window.location.href="../cerrar/us.php";
}
function nuevo_avatar () {
	var idusv=$("#idus").val();
	var imgav=$("#avGl")[0].files[0];
	var nameimgav=imgav.name;
	var exteimgav=nameimgav.substring(nameimgav.lastIndexOf('.')+1);
	var tamimgav=imgav.size;
	var tipoimgav=imgav.type;
	if (idusv=="0" || idusv=="") {
		$("#txD").css(mal).text("Id de usuario no diponible");
		return false;
	}
	else{
		if (!es_imagen(exteimgav)) {
			$("#txD").css(mal).text("tipo de imagen no permitido");
			return false;
		}
		else{
			$("#txD").css(normal).text("");
			var nuevF=new FormData($("#giav")[0]);
			$.ajax({
				url: '../nuevoimgAvatar.php',
				type: 'POST',
				data: nuevF,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend:function () {
					$("#txD").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
				},
				success:resultawimw,
				error:function () {
					$("#txD").css(mal).text("Ocurrió un error");
					$("#txD").fadeIn();$("#txD").fadeOut(3000);
				}
			});
			return false;
		}
	}
}
function resultawimw (datimg) {
	if (datimg=="2") {
		$("#txD").css(mal).text("Carpeta sin permisos o resolución de imagen no permitido");
		$("#txD").fadeIn();$("#txD").fadeOut(3000);
		return false;
	}
	else{
		if (datimg=="3") {
			$("#txD").css(mal).text("Tamaño no permitido");
			$("#txD").fadeIn();$("#txD").fadeOut(3000);
			return false;
		}
		else{
			if (datimg=="4") {
				$("#txD").css(mal).text("Carpeta sin permisos o resolución de imagen no permitido");
				$("#txD").fadeIn();$("#txD").fadeOut(3000);
				return false;
			}
			else{
				if (datimg=="5") {
					$("#txD").css(bien).text("Imagen subida");
					$("#txD").fadeIn();$("#txD").fadeOut(3000);
					location.reload(20);
				}
				else{
					$("#txD").css(mal).html(datimg);
					$("#txD").fadeIn();
					return false;
				}
			}
		}
	}
}