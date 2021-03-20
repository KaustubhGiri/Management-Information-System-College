function oprBtn(){
	var value1 = $("#opv_upp_sel_tex_1").val();
	var value2 = $("#opv_upp_sel_tex_2").val();
	var value3 = $("#opv_upp_sel_tex_3").val();
	var value4 = $("#opv_upp_sel_tex_4").val();
	var value5 = $("#opv_upp_sel_tex_5").val();
	var value6 = $("#opv_upp_sel_tex_6").val();
	if(value1!="" && value2!="" && value3!="" && value4!="" && value5!="" && value6!="")
	{
		$('#opv_upp_inp_sub_1').attr("disabled", false);
	}
	else
	{
		$('#opv_upp_inp_sub_1').attr("disabled", true);
	}

}

$(document).ready(function(){

	$("#opv_upp_sel_tex_1").on("change", function() {
		oprBtn();
	});

	$("#opv_upp_sel_tex_2").on("change", function() {
		oprBtn();
	});

	$("#opv_upp_sel_tex_3").on("change", function() {
		oprBtn();
	});

	$("#opv_upp_sel_tex_4").on("change", function() {
		oprBtn();
	});

	$("#opv_upp_sel_tex_5").on("change", function() {
		oprBtn();
	});

	$("#opv_upp_sel_tex_6").on("change", function() {
		oprBtn();
	});

});