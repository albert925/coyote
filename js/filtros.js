$(document).on("ready",iniciofiltros);
function iniciofiltros () {
	$("#fla,#flb,#flc,#fld,.tdfl").on("change",busquedafiltre);
	$("#rang").on("click",busquedafiltre);
	$("#coulto").each(checar);
}
function busquedafiltre () {
	var ca=$("#fla").val();
	var cb=$("#flb").val();
	var cc=$("#flc").val();
	var cd=$("#fld").val();
	var cf=$("#flf").val();
	var cg=$("#flg").val();
	var arrfil=new Array();
	$(".tdfl:checked").each(function () {
		arrfil.push($(this).val());
	});
	window.location.href="ind3x.php?ba="+ca+"&bb="+cb+"&bc="+cc+"&bd="+cd+"&be="+arrfil+"&bf="+cf+"&bg="+cg;
}
function checar () {
	var arrchek=$(this).attr("data-ary").split(",");
	for (var i = 0; i < arrchek.length; i++) {
		var number=arrchek[i];
		var delinput=$(".tdfl").each(function() {
			var delidchek=$(this).attr("data-id");
			if (number==delidchek) {
				$("#fle_"+delidchek).prop("checked","checked");
				console.log(delidchek+"-"+number+"-si");
			}
		});
	};
}