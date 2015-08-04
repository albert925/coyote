$(document).on("ready",inicpagina);
function inicpagina () {
	$("#btnmovil").on("click",abrirsubmn);
	//$("#busq").on("click",enmovilsubmenu);
	$("#inus").on("click",abrircerrarlogin);
	$("#bnigus").on("click",ingresogeneral);
	$("#btnfl").on("click",abrirfiltros);
	$("#pscr").on("change",buscar_ciudad);
	$("#decar").load("cant_carrito.php");
	$("#busplpd").keyup(buscargeneral);
	$("#busplpd").keydown(buscargeneral);
	if ($(window).width()<700) {
		$(".prodVer").on("click",botonosemovilan);
	}
	else{
		$(".prodVer").mouseenter(mosbotones);
		$(".prodVer").mouseleave(oculbotones);
	}
}
var mal={color:"#A54434"};
var normal={color:"#fff"};
var bien={color:"#B3D341"};
function abrirsubmn () {
	$("#mnB").each(abrycersub);
}
function abrycersub () {
	var dspl=$(this).css("display");
	if (dspl=="flex") {
		$(this).css({display:"none"});
	}
	else{
		$(this).css({display:"flex"});
	}
}
function enmovilsubmenu () {
	$("#busqueda").each(sionosub);
}
function sionosub () {
	var dssb=$(this).css("display");
	if (dssb=="block") {
		$(this).css({display:"none"});
	}
	else{
		$(this).css({display:"block"});
	}
}
function abrircerrarlogin (eing) {
	eing.preventDefault();
	$("#login").each(animarlogin);
}
function animarlogin () {
	var alyolog=$(this).css("height");
	if (alyolog=="155px") {
		$(this).animate({height:"0"}, 500);
	}
	else{
		$(this).animate({height:"155px"}, 500);
	}
}
function ingresogeneral () {
	var usG=$("#corus").val();
	var psG=$("#psus").val();
	if (usG=="") {
		$("#txus").css(mal).text("Ingrese el correo");
		return false;
	}
	else{
		if (psG=="") {
			$("#txus").css(mal).text("Ingrese la contraseña");
			return false;
		}
		else{
			$("#txus").css(normal).text("");
			$("#txus").prepend("<center><img src='loadingb.gif' alt='loading' style='width:20px;' /></center>");
			$.post("ingresoG.php",{usa:usG,usb:psG},reulgeneuser);
			return false;
		}
	}
}
function reulgeneuser (kdtkd) {
	if (kdtkd=="2") {
		$("#txus").css(mal).text("Usuario o contraseña incorrectas");
		return false;
	}
	else{
		if (kdtkd=="3") {
			$("#txus").css(mal).text("cuenta desactivada");
			return false;
		}
		else{
			if (kdtkd=="4") {
				$("#txus").css(bien).text("Ingresando...");
				location.reload(20);
			}
			else{
				$("#txus").css(mal).html(kdtkd);
				return false;
			}
		}
	}
}
function abrirfiltros () {
	$("#filtro").each(disonodisfil);
}
function disonodisfil () {
	var displfiltre=$(this).css("display");
	if (displfiltre=="flex") {
		$(this).css({display:"none"});
	}
	else{
		$(this).css({display:"flex"});
	}
}
function mosbotones () {
	var delacaja=$(this).attr("data-id");
	$("#prod_"+delacaja+" figcaption a").css({display:"block"});
}
function oculbotones () {
	var delacaja=$(this).attr("data-id");
	$("#prod_"+delacaja+" figcaption a").css({display:"none"});
}
function botonosemovilan () {
	var cjajdos=$(this).attr("data-id");
	$("#prod_"+cjajdos+" figcaption a").each(mosoculbotna);
}
function mosoculbotna () {
	var displeta=$(this).css("display");
	if (displeta=="none") {
		$(this).css({display:"block"});
	}
	else{
		$(this).css({display:"none"});
	}
}
function buscar_ciudad () {
	var cdid=$("#pscr").val();
	$("#mscr center").remove();
	$("#mscr").prepend("<center><img src='imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
	$.post("buscar_ciudad.php",{idps:cdid},colocarciudad);
}
function colocarciudad (fcd) {
	$("#mscr center").remove();
	$("#cdcr").html(fcd);
}
function buscargeneral () {
	var texplabra=$("#busplpd").val();
	$.post("busqueda_general.php",{htx:texplabra},resulenerla);
}
function resulenerla (dateGn) {
	if (dateGn=="" || $("#busplpd").val()=="") {
		$("#resultadoBs").css({display:"none"});
	}
	else{
		$("#resultadoBs").css({display:"flex"}).html(dateGn);
	}
}