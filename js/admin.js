var expr=/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$(document).on("ready",inicioadministrador);
function inicioadministrador () {
	$("#ingad").on("click",ingreso);
	$("#cambA").on("click",vambioA);
	$("#cambB").on("click",vambioB);
	$("#cambC").on("click",vambioC);
}
var mal={color:"#A54434"};
var normal={color:"#000"};
var bien={color:"#B3D341"};
function ingreso () {
	var adus=$("#usad").val();
	var adps=$("#psad").val();
	if (adus=="") {
		$("#txA").css(mal).text("Ingrese el nombre de usuario");
		$("#txA").fadeIn();
		return false;
	}
	else{
		if (adps=="") {
			$("#txA").css(mal).text("Ingrese la contraseña");
			$("#txA").fadeIn();
			return false;
		}
		else{
			$("#txA").css(normal).text("");
			$("#txA").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
			$("#txA").fadeIn();
			$.post("ingresoadmn.php",{us:adus,ps:adps},resulunAd);
			return false;
		}
	}
}
function resulunAd (stad) {
	if (stad=="2") {
		$("#txA").css(mal).text("Usuario o contraseña incorrectas");
		$("#txA").fadeIn();
		return false;
	}
	else{
		if (stad=="3") {
			$("#txA").css(bien).text("Ingresando...");
			$("#txA").fadeIn();
			window.location.href="administrador";
		}
		else{
			$("#txA").css(mal).html(stad);
			$("#txA").fadeIn();
			return false;
		}
	}
}
function vambioA () {
	var ida=$(this).attr("data-adm");
	var usF=$("#fadus").val();
	if (usF=="") {
		$("#txB").css(mal).text("ingrese nombre usuario");
		$("#txB").fadeIn();
	}
	else{
		$("#txB").css(normal).text("");
		$("#txB").prepend("<center><img src='../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$("#txB").fadeIn();
		$.post("modif_usead.php",{fa:ida,fb:usF},resKa);
	}
}
function resKa (loa) {
	if (loa=="2") {
		$("#txB").css(mal).text("nombre ingresado ya existe");
		$("#txB").fadeIn();
	}
	else{
		if (loa=="3") {
			$("#txB").css(bien).text("nombre modifcado");
			$("#txB").fadeIn();
			window.location.href="../../cerrar";
		}
		else{
			$("#txB").css(mal).html(loa);
			$("#txB").fadeIn();
		}
	}
}
function vambioB () {
	var idb=$(this).attr("data-adm");
	var corF=$("#fadcr").val();
	if (corF=="" || !expr.test(corF)) {
		$("#txC").css(mal).text("Ingrese el correo");
		$("#txC").fadeIn();
	}
	else{
		$("#txC").css(normal).text("");
		$("#txC").prepend("<center><img src='../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$("#txC").fadeIn();
		$.post("modicorad.php",{fc:idb,fd:corF},resKb);
	}
}
function resKb (lob) {
	if (lob=="2") {
		$("#txC").css(mal).text("correo ingresado ya existe");
		$("#txC").fadeIn();
	}
	else{
		if (lob=="3") {
			$("#txC").css(bien).text("correo modifcado");
			$("#txC").fadeIn();
			location.reload(20);
		}
		else{
			$("#txC").css(mal).html(lob);
			$("#txC").fadeIn();
		}
	}
}
function vambioC () {
	var idc=$(this).attr("data-adm");
	var coa=$("#psA").val();
	var cna=$("#psna").val();
	var cnb=$("#psnb").val();
	if (coa=="") {
		$("#txD").css(mal).text("Ingrese la contraseña nueva");
		$("#txD").fadeIn();
	}
	else{
		if (cna=="" || cna.length<6) {
			$("#txD").css(mal).text("Contraseña nueva mínimo 6 dígitos");
			$("#txD").fadeIn();
		}
		else{
			if (cnb!=cna) {
				$("#txD").css(mal).text("Las contraseñas no coinciden");
				$("#txD").fadeIn();
			}
			else{
				$("#txD").css(normal).text("");
				$("#txD").prepend("<center><img src='../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
				$("#txD").fadeIn();
				$.post("modif_password.php",{fe:idc,ff:coa,fg:cna},resKc);
			}
		}
	}
}
function resKc (loc) {
	if (loc=="2") {
		$("#txD").css(mal).text("Contraseña actual erronea");
			$("#txD").fadeIn();
	}
	else{
		if (loc=="3") {
			$("#txD").css(bien).text("Contraseña modificada");
			$("#txD").fadeIn();
			window.location.href="../../cerrar";
		}
		else{
			$("#txD").css(mal).html(loc);
			$("#txD").fadeIn();
		}
	}
}