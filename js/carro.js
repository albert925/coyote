$(document).on("ready",iniciocarrito);
function iniciocarrito () {
	$(".actdat").on("click",actulizardatous);
	$(".cambCtcar").change(cambiocantidad);
	$(".eliminar_carr").on("click",borrar_carrito);
	$(".Talsel").on("click",cambiartalla);
	$(".cambiocolorcar").on("change",cambiarcolor);
}
var mal={color:"#A54434"};
var normal={color:"#000"};
var bien={color:"#B3D341"};
function conComas (valor) {
	var nums= new Array();
	var simb=",";
	valor=valor.toString();
	valor=valor.replace(/\D/g, "");//Solo permite numeros
	nums=valor.split("");
	var lonG=nums.length-1;//Se saca la longitud del arreglo
	var patron=3;//Induca cada cuanto se ponen las comas
	var prox=2;//Indica en que lugar se deve insertar la siguiente coma
	var res="";
	while(lonG>prox){
		nums.splice((lonG-prox),0,simb);//Se agrega la coma
		prox+=patron;//Se incremente la posicion maxima para colocar la coma
	}
	for (var i = 0; i <= nums.length-1; i++) {
		res+=nums[i];//se cre la nueva cadena para devolver el valor formateado
	};
	return res;
}
function cambiartalla () {
	var idPra=$(this).attr("data-id");
	var idTlla=$(this).attr("data-ct");
	var numtla=$(this).attr("data-nmtll");
	$.post("cambio_talla.php",{ta:idPra,tb:idTlla,tc:numtla},function (stl) {
		if (stl=="1") {
			$("#ex_"+idPra).text(numtla);
			$("#carcat_"+idPra).attr("max",idTlla);
			$("#cajtl_"+idPra).css({background: "#555555"});
		}
		else{
			alert(stl);
		}
	});
}
function cambiocantidad () {
	var idct=$(this).attr("data-id");
	var prect=$(this).attr("data-prec");
	var nmct=$("#carcat_"+idct).val();
	var subto=nmct*prect;
	var conformato=conComas(subto);
	$("#subcol_"+idct).text(conformato);
	$.post("cambiar_cant_carrito.php",{cid:idct,cpr:prect,cct:nmct},mos_cambios);
}
function mos_cambios (totcm) {
	$("#totDs").html(totcm);
}
function borrar_carrito () {
	var borid=$(this).attr("data-id");
	$.post("borr_camp_carrito.php",{dlid:borid},resulborrr);
}
function resulborrr (tkt) {
	if (tkt=="1") {
		window.location.href="carrito.php";
	}
	window.location.href="carrito.php";
}
function actulizardatous (u) {
	u.preventDefault();
	var idus=$(this).attr("data-us");
	var nom=$("#nmcr").val();
	var ape=$("#apcr").val();
	var tel=$("#telcr").val();
	var cel=$("#celcr").val();
	var pas=$("#pscr").val();
	var ciu=$("#cdcr").val();
	var dir=$("#drcr").val();
	if (nom=="") {
		$("#mscr").css(mal).text("ingrese el nombre");
	}
	else{
		if (ape=="") {
			$("#mscr").css(mal).text("ingrese el apellido");
		}
		else{
			if (pas=="0" || pas=="") {
				$("#mscr").css(mal).text("selecione el país");
			}
			else{
				if (ciu=="0" || ciu=="") {
					$("#mscr").css(mal).text("selecione la ciudad");
				}
				else{
					if (dir=="") {
						$("#mscr").css(mal).text("escribe la dirección");
					}
					else{
						$("#mscr").css(normal).text("");
						$("#mscr").prepend("<center><img src='imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
						$.post("modif_us.php",{isd:idus,a:nom,b:ape,c:tel,d:cel,e:pas,f:ciu,g:dir},resulactulizado);
					}
				}
			}
		}
	}
}
function resulactulizado (auct) {
	if (auct=="2") {
		$("#mscr").css(bien).text("Datos modifcados");
		window.location.href="carritoC.php";
	}
	else{
		$("#mscr").css(normal).html(auct);
	}
}
function cambiarcolor () {
	var selid=$(this).attr("data-id");
	var selcolor=$("#coloCam_"+selid).val();
	if (selcolor=="0" || selcolor=="") {
		alert("selecione el color");
	}
	else{
		$.post("cambio_color.php",{ca:selid,cb:selcolor},function (dtcolor) {
			var separador=dtcolor.split("/");
			var estadoR=separador[0];
			var nomcolor=separador[1];
			if (estadoR=="1") {
				$("#col_"+selid).text(nomcolor);
			}
			else{
				alert(dtcolor);
			}
		});
	}
}