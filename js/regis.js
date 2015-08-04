var expr=/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$(document).on("ready",inicioregistro);
function inicioregistro () {
	$("#regusr").on("click",registroNv);
	$("#usreg").on("click",ingreis);
}
var mal={color:"#A54434"};
var normal={color:"#fff"};
var bien={color:"#B3D341"};
function registroNv () {
	var nam=$("#namrs").val();
	var ape=$("#aprs").val();
	var cor=$("#corrs").val();
	var psu=$("#psars").val();
	var psb=$("#psbrs").val();
	if (nam=="") {
		$("#txRa").css(mal).text("Ingrese el nombre");
	}
	else{
		if (ape=="") {
			$("#txRa").css(mal).text("Ingrese el apellido");
		}
		else{
			if (cor=="" || !expr.test(cor)) {
				$("#txRa").css(mal).text("Ingrese el correo");
			}
			else{
				if (psu=="" || psu.length<6) {
					$("#txRa").css(mal).text("Contraseña mínimo 6 dígitos");
				}
				else{
					if (psb!=psu) {
						$("#txRa").css(mal).text("Contraseñas no coinciden");
					}
					else{
						if ($("#acdes").is(":checked")) {
							$("#txRa").css(normal).text("");
							$("#txRa").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
							$.post("registro.php",{a:nam,b:ape,c:cor,d:psu},resulregistro);
						}
						else{
							$("#txRa").css(mal).text("Acepte que vas a dar información tuya");
						}
					}
				}
			}
		}
	}
}
function resulregistro (ulrg) {
	if (ulrg=="2") {
		$("#txRa").css(mal).text("Correo ingresado ya existe");
	}
	else{
		if (ulrg=="3") {
			$("#txRa").css(bien).text("Registro completado");
			window.location.href="completado.php";
		}
		else{
			$("#txRa").css(mal).html(ulrg);
		}
	}
}
function ingreis () {
	var aaus=$("#coinb").val();
	var abus=$("#pasinb").val();
	if (aaus=="") {
		$("#txing").css(mal).text("Ingrese el correo");
		return false;
	}
	else{
		if (abus=="") {
			$("#txing").css(mal).text("Ingrese la contraseña");
			return false;
		}
		else{
			$("#txing").css(normal).text("");
			$("#txing").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
			$.post("ingreso.php",{ja:aaus,jb:abus},resuling);
			return false;
		}
	}
}
function resuling (datus) {
	if (datus=="2") {
		$("#txing").css(mal).text("Usuario o contraseña incorrectas");
		return false;
	}
	else{
		if (datus=="3") {
			$("#txing").css(mal).text("cuenta desactivada");
			return false;
		}
		else{
			if (datus=="4") {
				$("#txing").css(bien).text("Ingresando...");
				window.location.href="../";
			}
			else{
				$("#txing").css(mal).html(datus);
				return false;
			}
		}
	}
}