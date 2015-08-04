$(document).on("ready",inicioproductos);
function inicioproductos () {
	$("#nvcl").on("click",nuevocliente);
	$("#nvtp").on("click",nuevotipo);
	$("#nvmk").on("click",nuevomarca);
	$("#nvPr").on("click",validarselecproducto);
	$("#nvgmPdr").on("click",imagenesPorducto);
	$("#nvtll").on("click",nuevotalla);
	$("#nvcolor").on("click",nuevocolor);
	$("#nvrel").on("click",nuevarelacionU);
	$("#nvsbtp").on("click",nuevosubtipo);
	$(".camclF").on("click",modifclienten);
	$(".camtpF").on("click",modiftiposn);
	$(".cammkF").on("click",mpdifmarca);
	$(".camtllF").on("click",modiftallas);
	$(".camrelaF").on("click",modifrelacionU);
	$(".camtcolorF").on("click",modifciolores);
	$(".camsbtpF").on("click",modifcsubtipo);
}
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
function nuevocliente () {
	var nmcl=$("#clnm").val();
	if (nmcl=="") {
		$("#txA").css(mal).text("Ingrese el nombre");
		$("#txA").fadeIn();
	}
	else{
		$("#txA").css(normal).text("");
		$("#txA").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$("#txA").fadeIn();
		$.post("new_cliente.php",{ca:nmcl},resulCl);
	}
}
function resulCl (rcrl) {
	if (rcrl=="2") {
		$("#txA").css(mal).text("Nombre ya existe");
		$("#txA").fadeIn();
	}
	else{
		if (rcrl=="3") {
			$("#txA").css(bien).text("Tipo cliente ingresado");
			$("#txA").fadeIn();
			location.reload(20);
		}
		else{
			$("#txA").css(mal).html(rcrl);
			$("#txA").fadeIn();
		}
	}
}
function modifclienten () {
	var idcl=$(this).attr("data-id");
	var FnmclF=$("#Fclm_"+idcl).val();
	if (FnmclF=="") {
		$("#txB_"+idcl).css(mal).text("Ingrese el nombre");
		$("#txB_"+idcl).fadeIn();
	}
	else{
		$("#txB_"+idcl).css(normal).text("");
		$("#txB_"+idcl).prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$("#txB_"+idcl).fadeIn();
		$.post("modif_cliente.php",{fca:idcl,fcb:FnmclF},function (Sifa) {
			if (Sifa=="2") {
				$("#txB_"+idcl).css(bien).text("Nombre modificado");
				$("#txB_"+idcl).fadeIn();
				location.reload(20);
			}
			else{
				$("#txB_"+idcl).css(mal).html(Sifa);
				$("#txB_"+idcl).fadeIn();
			}
		});
	}
}
function nuevotipo () {
	var nmtp=$("#tpnm").val();
	if (nmtp=="") {
		$("#txC").css(mal).text("Ingrese el nombre");
		$("#txC").fadeIn();
	}
	else{
		$("#txC").css(normal).text("");
		$("#txC").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$("#txC").fadeIn();
		$.post("new_tipos.php",{ta:nmtp},resulTP);
	}
}
function resulTP (rtrp) {
	if (rtrp=="2") {
		$("#txC").css(mal).text("Nombre ya existe");
		$("#txC").fadeIn();
	}
	else{
		if (rtrp=="3") {
			$("#txC").css(bien).text("Tipo producto ingresado");
			$("#txC").fadeIn();
			location.reload(20);
		}
		else{
			$("#txC").css(mal).html(rtrp);
			$("#txC").fadeIn();
		}
	}
}
function modiftiposn () {
	var idtp=$(this).attr("data-id");
	var FnmtpF=$("#Ftpm_"+idtp).val();
	if (FnmtpF=="") {
		$("#txD_"+idtp).css(mal).text("ingrese le nombre");
		$("#txD_"+idtp).val();
	}
	else{
		$("#txD_"+idtp).css(normal).text("");
		$("#txD_"+idtp).prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$("#txD_"+idtp).val();
		$.post("modif_tipos.php",{fta:idtp,ftb:FnmtpF},function (Sifb) {
			if (Sifb=="2") {
				$("#txD_"+idtp).css(bien).text("nombre modificado");
				$("#txD_"+idtp).val();
				location.reload(20);
			}
			else{
				$("#txD_"+idtp).css(mal).html(Sifb);
				$("#txD_"+idtp).val();
			}
		});
	}
}
function nuevomarca () {
	var nmmk=$("#mknm").val();
	var rtpr=$("#dstp").val();
	if (nmmk=="") {
		$("#txE").css(mal).text("Ingrese el nombre");
		$("#txE").fadeIn();
	}
	else{
		if (rtpr=="0" || rtpr=="") {
			$("#txE").css(mal).text("Selecione el tipo producto");
			$("#txE").fadeIn();
		}
		else{
			$("#txE").css(normal).text("");
			$("#txE").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
			$("#txE").fadeIn();
			$.post("new_marka.php",{ma:nmmk,mb:rtpr},resulMK);
		}
	}
}
function resulMK (rmrk) {
	if (rmrk=="2") {
		$("#txE").css(mal).text("Nombre marca ya existe");
			$("#txE").fadeIn();
	}
	else{
		if (rmrk=="3") {
			$("#txE").css(bien).text("marca ingresada");
			$("#txE").fadeIn();
			location.reload(20);
		}
		else{
			$("#txE").css(mal).html(rmrk);
			$("#txE").fadeIn();
		}
	}
}
function mpdifmarca () {
	var idmk=$(this).attr("data-id");
	var FnmmkF=$("#Fmkm_"+idmk).val();
	var Fsltp=$("#fpftp_"+idmk).val();
	if (FnmmkF=="") {
		$("#txF_"+idmk).css(mal).text("Ingrese el nombre");
		$("#txF_"+idmk).fadeIn();
	}
	else{
		if (Fsltp=="0" || Fsltp=="") {
			$("#txF_"+idmk).css(mal).text("Selecione tipo producto");
			$("#txF_"+idmk).fadeIn();
		}
		else{
			$("#txF_"+idmk).css(normal).text("");
			$("#txF_"+idmk).prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
			$("#txF_"+idmk).fadeIn();
			$.post("modif_marka.php",{fma:idmk,fmb:FnmmkF,fmc:Fsltp},function (Sifc) {
				if (Sifc=="2") {
					$("#txF_"+idmk).css(bien).text("modifcado");
					$("#txF_"+idmk).fadeIn();
					location.reload(20);
				}
				else{
					$("#txF_"+idmk).css(mal).html(Sifc);
					$("#txF_"+idmk).fadeIn();
				}
			});
		}
	}
}
function validarselecproducto () {
	var clientesel=$("#bpcl").val();
	var tiposel=$("#cptp").val();
	var marcasel=$("#dpmk").val();
	if (clientesel=="0" || clientesel=="") {
		$("#msjA").css(mal).text("Selecione tipo cliente");
		$("#msjA").fadeIn();
		alert("Selecione tipo cliente");
		return false;
	}
	else{
		if (tiposel=="0" || tiposel=="") {
			$("#msjA").css(mal).text("Selecione tipo producto");
			$("#msjA").fadeIn();
			alert("Selecione tipo producto");
			return false;
		}
		else{
			if (marcasel=="0" || marcasel=="") {
				$("#msjA").css(mal).text("Selecione tipo subtipo o marca");
				$("#msjA").fadeIn();
				alert("Selecione tipo subtipo o marca");
				return false;
			}
			else{
				return true;
			}
		}
	}
}
function imagenesPorducto () {
	var idPrg=$("#idPD").val();
	var gmPdg=$("#imgPD")[0].files[0];
	var namegmPdg=gmPdg.name;
	var extegmPdg=namegmPdg.substring(namegmPdg.lastIndexOf('.')+1);
	var tamgmPdg=gmPdg.size;
	var tipogmPdg=gmPdg.type;
	if (idPrg=="" || idPrg=="0") {
		$("#msjimgA").css(mal).text("Id producto no disponible");
		$("#msjimgA").fadeIn();
		return false;
	}
	else{
		if (!es_imagen(extegmPdg)) {
			$("#msjimgA").css(mal).text("tipo de imagen no permitido");
			$("#msjimgA").fadeIn();
			return false;
		}
		else{
			$("#msjimgA").css(normal).text("");
			$("#msjimgA").fadeIn();
			var nuevFpd=new FormData($("#pdPmy")[0]);
			$.ajax({
				url: '../../../nuevoimgProducto.php',
				type: 'POST',
				data: nuevFpd,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend:function () {
					$("#msjimgA").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
				},
				success:function (gmDrp) {
					if (gmDrp=="2") {
						$("#msjimgA").css(mal).text("Carpeta sin permisos o resolución de imagen no permitido");
						$("#msjimgA").fadeIn();$("#msjimgA").fadeOut(3000);
						return false;
					}
					else{
						if (gmDrp=="3") {
							$("#msjimgA").css(mal).text("Tamaño no permitido");
							$("#msjimgA").fadeIn();$("#msjimgA").fadeOut(3000);
							return false;
						}
						else{
							if (gmDrp=="4") {
								$("#msjimgA").css(mal).text("Carpeta sin permisos o resolución de imagen no permitido");
								$("#msjimgA").fadeIn();$("#msjimgA").fadeOut(3000);
								return false;
							}
							else{
								if (gmDrp=="5") {
									$("#msjimgA").css(bien).text("Imagen subida");
									$("#msjimgA").fadeIn();$("#msjimgA").fadeOut(3000);
									window.location.href="imagenesProdu.php?pd="+idPrg;
								}
								else{
									$("#msjimgA").css(mal).html(gmDrp);
									$("#msjimgA").fadeIn();
									return false;
								}
							}
						}
					}
				},
				error:function () {
					$("#msjimgA").css(mal).text("Ocurrió un error");
					$("#msjimgA").fadeIn();$("#msjimgA").fadeOut(3000);
				}
			});
			return false;
		}
	}
}
function nuevotalla () {
	var namtll=$("#tllnm").val();
	if (namtll=="") {
		$("#txH").css(mal).text("ingrese la talla");
		$("#txH").fadeIn();
	}
	else{
		$("#txH").css(normal).text("");
		$("#txH").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$("#txH").fadeIn();
		$.post("new_talla.php",{tla:namtll},resulTL);
	}
}
function resulTL (rtrl) {
	if (rtrl=="2") {
		$("#txH").css(mal).text("La talla ya existe");
		$("#txH").fadeIn();
	}
	else{
		if (rtrl=="3") {
			$("#txH").css(bien).text("talla ingresada");
			$("#txH").fadeIn();
			location.reload(20);
		}
		else{
			$("#txH").css(mal).html(rtrl);
			$("#txH").fadeIn();
		}
	}
}
function modiftallas () {
	var idtll=$(this).attr("data-id");
	var nutll=$("#Ftllm_"+idtll).val();
	if (nutll=="") {
		$("#txI_"+idtll).css(mal).text("Ingrese la talla");
		$("#txI_"+idtll).fadeIn();
	}
	else{
		$("#txI_"+idtll).css(normal).text("");
		$("#txI_"+idtll).prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$("#txI_"+idtll).fadeIn();
		$.post("modif_talla.php",{fla:idtll,flb:nutll},function (Sifd) {
			if (Sifd=="2") {
				$("#txI_"+idtll).css(bien).text("talla modificada");
				$("#txI_"+idtll).fadeIn();
				location.reload(20);
			}
			else{
				$("#txI_"+idtll).css(mal).html(Sifd);
				$("#txI_"+idtll).fadeIn();
			}
		});
	}
}
function nuevarelacionU () {
	var rltll=$("#tlR").val();
	var rlctn=$("#ctnR").val();
	var rlcol=$("#colR").val();
	if (rltll=="0" || rltll=="") {
		$("#txJ").css(mal).text("Selecione la talla");
		$("#txJ").fadeIn();
	}
	else{
		if (rlctn=="" || rlctn<0) {
			$("#txJ").css(mal).text("Ingrese la cantidad");
			$("#txJ").fadeIn();
		}
		else{
			var arrpd=new Array();
			$(".prd:checked").each(function() {
				arrpd.push($(this).val());		
			});
			$("#txJ").css(normal).text("");
			$("#txJ").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
			$("#txJ").fadeIn();
			$.post("new_relaciontallaprodu.php",{ra:rltll,rb:rlctn,rc:arrpd,rd:rlcol},resulrelacion);
		}
	}
}
function resulrelacion (crRlr) {
	$("#txJ").html(crRlr)
	$("#txJ").fadeIn();
	setTimeout(dirprodu,2000);
}
function dirprodu () {
	location.reload();
}
function modifrelacionU () {
	var idrel=$(this).attr("data-id");
	var delatalla=$("#fra_"+idrel).val();
	var delprodu=$("#frb_"+idrel).val();
	var delcolor=$("#crol_"+idrel).val();
	var cantirel=$("#frc_"+idrel).val();
	if (delatalla=="0" || delatalla=="") {
		$("#txk_"+idrel).css(mal).text("Selecione la talla");
		$("#txk_"+idrel).fadeIn();
	}
	else{
		if (delprodu=="0" || delprodu=="") {
			$("#txk_"+idrel).css(mal).text("Selecione el producto");
			$("#txk_"+idrel).fadeIn();
		}
		else{
			$("#txk_"+idrel).css(normal).text("");
			$("#txk_"+idrel).prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
			$("#txk_"+idrel).fadeIn();
			$.post("modif_rela_prd_tall.php",{frar:idrel,
					frbr:delatalla,
					frcr:delprodu,
					frdr:cantirel,
					frer:delcolor},
				function (mentrel) {
					if (mentrel=="2") {
						$("#txk_"+idrel).css(bien).text("Relacion modificada");
						$("#txk_"+idrel).fadeIn();
						location.reload(20);
					}
					else{
						$("#txk_"+idrel).css(mal).html(mentrel);
						$("#txk_"+idrel).fadeIn();
					}
			});
		}
	}
}
function nuevocolor () {
	var nmcolor=$("#colornm").val();
	if (nmcolor=="") {
		$("#txL").css(mal).text("Ingrese el nombre");
	}
	else{
		$("#txL").css(normal).text("");
		$("#txL").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$.post("new_color.php",{cla:nmcolor},resulcolora);
	}
}
function resulcolora (colyu) {
	if (colyu=="2") {
		$("#txL").css(mal).text("nombre ya existe");
	}
	else{
		if (colyu=="3") {
			$("#txL").css(bien).text("Color ingresado");
			location.reload(20);
		}
		else{
			$("#txL").css(mal).html(colyu);
		}
	}
}
function modifciolores () {
	var irecol=$(this).attr("data-id");
	var nmcolf=$("#Ftcolorm_"+irecol).val();
	if (nmcolf=="") {
		$("#txM_"+irecol).css(mal).text("Ingrese le nombre");
	}
	else{
		$("#txM_"+irecol).css(mal).text("Ingrese le nombre");
		$("#txM_"+irecol).prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$.post("modif_color.php",{colid:irecol,colad:nmcolf},function (ucolf) {
			if (ucolf=="2") {
				$("#txM_"+irecol).css(bien).text("nombre modificado");
				location.reload(20);
			}
			else{
				$("#txM_"+irecol).css(mal).html(ucolf);
			}
		});
	}
}
function nuevosubtipo () {
	var saba=$("#sltrelpsb").val();
	var sabb=$("#tpsbnm").val();
	if (saba=="0" || saba=="") {
		$("#txJ").css(mal).text("Selecione el tipo");
	}
	else{
		if (sabb=="") {
			$("#txJ").css(mal).text("Ingrese el nombre");
		}
		else{
			$("#txJ").css(normal).text("");
			$("#txJ").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
			$.post("new_subtipo.php",{a:saba,b:sabb},resulsubtipo);
		}
	}
}
function resulsubtipo (hjsnhj) {
	if (hjsnhj=="2") {
		$("#txJ").css(mal).text("Nombre subtipo ya existe");
	}
	else{
		if (hjsnhj=="3") {
			$("#txJ").css(bien).text("Ingresado");
			location.reload(20);
		}
		else{
			$("#txJ").css(mal).html(hjsnhj);
		}
	}
}
function modifcsubtipo () {
	var idh=$(this).attr("data-id");
	var ya=$("#Fsbtpm_"+idh).val();
	var yb=$("#ypsel_"+idh).val();
	if (yb=="0" || yb=="") {
		console.log("proceso modificar subproductos");
	}
}