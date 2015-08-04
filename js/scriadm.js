$(document).on("ready",iniadminscrpag);
function iniadminscrpag () {
	$("#nva").on("click",abrirA);
	$("#nvb").on("click",abrirB);
	$("#cptp").on("change",buscarsubtipo);
	$(".dell").on("click",comfirmarborrar);
	$(".cerrar").on("click",cerrV);
}
function comfirmarborrar () {
	return confirm("¿Estas seguro de eliminar el dato?");
}
function abrirA (ak) {
	ak.preventDefault();
	$("#caj").each(animarA);
}
function abrirB (bk) {
	bk.preventDefault();
	$("#cbj").each(animarB);
}
function animarA () {
	var altoA=$(this).css("height");
	if (altoA=="150px") {
		$(this).animate({height:"0"}, 500);
	}
	else{
		$(this).animate({height:"150px"}, 500);
	}
}
function animarB () {
	var altoA=$(this).css("height");
	if (altoA=="800px") {
		$(this).animate({height:"0"}, 500);
	}
	else{
		$(this).animate({height:"800px"}, 500);
	}
}
function buscarsubtipo () {
	var tipB=$("#cptp").val();
	$.post("busq_submark.php",{sytp:tipB},colocarmarca);
}
function colocarmarca (dmkd) {
	$("#dpmk").html(dmkd);
}
function cerrV () {
	$(".datusF").fadeOut();
}