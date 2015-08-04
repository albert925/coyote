var expr=/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$(document).on("ready",iniciomensajecont);
function iniciomensajecont () {
	$("#nvmsjsj").on("click",nuevo_mensaje);
}
var mal={color:"#A54434"};
var normal={color:"#000"};
var bien={color:"#B3D341"};
function nuevo_mensaje () {
	var ca=$("#nmmj").val();
	var cb=$("#crmj").val();
	var cc=$("#asmj").val();
	var cd=$("#tsmj").val();
	if (ca=="") {
		$("#txmsj").css(mal).text("ingrese el nombre");
	}
	else{
		if (cb=="" || !expr.test(cb)) {
			$("#txmsj").css(mal).text("ingrese el correo");
		}
		else{
			if (cc=="") {
				$("#txmsj").css(mal).text("ingrese el asunto");
			}
			else{
				if (cd=="") {
					$("#txmsj").css(mal).text("ingrese el mensaje");
				}
				else{
					$("#txmsj").css(normal).text("");
					$("#txmsj").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
					$.post("enviarmensaje.php",{a:ca,b:cb,c:cc,d:cd},resultmensaje);
				}
			}
		}
	}
}
function resultmensaje (sjj) {
	if (sjj=="2") {
		$("#txmsj").css(bien).text("Mensaje Enviado");
		location.reload(20);
	}
	else{
		$("#txmsj").css(mal).html(sjj);
	}
}