function ftocBtn(){
	var value1 = $("#fcv_upp_sel_tex_1").val();
	var value2 = $("#fcv_upp_sel_tex_2").val();
	var value3 = $("#fcv_upp_sel_tex_3").val();
	var value4 = $("#fcv_upp_sel_tex_4").val();
	var value5 = $("#fcv_upp_sel_tex_5").val();
	var value6 = $("#fcv_upp_sel_tex_6").val();
	if(value1!="" && value2!="" &&value3!="" &&value4!="" &&value5!="" &&value6!="")
	{
		{$('#fcv_upp_inp_sub_1').attr("disabled", false);}
	}
	else
	{
		{$('#fcv_upp_inp_sub_1').attr("disabled", true);}
	}

}

$(document).ready(function(){


	$("#fcv_upp_sel_tex_1").on("change", function() {
		ftocBtn();
	});

	$("#fcv_upp_sel_tex_2").on("change", function() {
		ftocBtn();
	});

	$("#fcv_upp_sel_tex_3").on("change", function() {
		ftocBtn();
	});

	$("#fcv_upp_sel_tex_4").on("change", function() {
		ftocBtn();
	});

	$("#fcv_upp_sel_tex_5").on("change", function() {
		ftocBtn();
	});

	$("#fcv_upp_sel_tex_6").on("change", function() {
		ftocBtn();
	});

});