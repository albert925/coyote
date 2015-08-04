$(document).on("ready",inicioimagenes);
function inicioimagenes () {
	$("#nvGyl").on("click",nuevoimagenG);
}
var mal={color:"#A54434"};
var normal={color:"#000"};
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
function nuevoimagenG () {
	var gmig=$("#imGl")[0].files[0];
	var namegmig=gmig.name;
	var extegmig=namegmig.substring(namegmig.lastIndexOf('.')+1);
	var tamgmig=gmig.size;
	var tipogmig=gmig.type;
	if (!es_imagen(extegmig)) {
		$("#txA").css(mal).text("Tipo de imagen no permitido")
		$("#txA").fadeIn();
		return false;
	}
	else{
		$("#txA").css(normal).text("")
		$("#txA").fadeIn();
		var nuevF=new FormData($("#gimy")[0]);
		$.ajax({
			url: '../../../nuevoimgGalery.php',
			type: 'POST',
			data: nuevF,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend:function () {
				$("#txA").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
			},
			success:resultawimw,
			error:function () {
				$("#txA").css(mal).text("Ocurrió un error");
				$("#txA").fadeIn();$("#txA").fadeOut(3000);
			}
		});
		return false;
	}
}
function resultawimw (datimg) {
	if (datimg=="2") {
		$("#txA").css(mal).text("Carpeta sin permisos o resolución de imagen no permitido");
		$("#txA").fadeIn();$("#txA").fadeOut(3000);
		return false;
	}
	else{
		if (datimg=="3") {
			$("#txA").css(mal).text("Tamaño no permitido");
			$("#txA").fadeIn();$("#txA").fadeOut(3000);
			return false;
		}
		else{
			if (datimg=="4") {
				$("#txA").css(mal).text("Carpeta sin permisos o resolución de imagen no permitido");
				$("#txA").fadeIn();$("#txA").fadeOut(3000);
				return false;
			}
			else{
				if (datimg=="5") {
					$("#txA").css(bien).text("Imagen subida");
					$("#txA").fadeIn();$("#txA").fadeOut(3000);
					location.reload(20);
				}
				else{
					$("#txA").css(mal).html(datimg);
					$("#txA").fadeIn();
					return false;
				}
			}
		}
	}
}