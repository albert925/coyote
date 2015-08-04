$(document).on("ready",inicio_facturas);
function inicio_facturas () {
	$(".tdstif").on("change",cambiarestado);
}
function cambiarestado () {
	var delcodF=$(this).attr("data-fact");
	var deestado=$("#esdF_"+delcodF).val();
	if (deestado=="0" || deestado=="") {
		alert("Selecione el estado");
	}
	else{
		$.post("cambiar_facestad.php",{fid:delcodF,es:deestado},resulestado);
	}
}
function resulestado (usrt) {
	if (usrt=="2") {
		alert("estado modificado");
		location.reload(20);
	}
	else{
		alert(usrt)
	}
}