function svBtn(){
	var value1 = $("#sev_upp_sel_tex_1").val();
	var value2 = $("#uni_upp_sel_tex_2").val();
	var value3 = $("#sev_upp_sel_tex_3").val();
	var value4 = $("#sev_upp_sel_tex_4").val();
	var value5 = $("#sev_upp_sel_tex_5").val();

	if(value1!="" && value2!="" && value3!="" && value4!="" && value5!="")
	{
		$('#sev_upp_inp_sub_1').attr("disabled", false);
	}
	else
	{
		$('#sev_upp_inp_sub_1').attr("disabled", true);
	}

}

$(document).ready(function(){


	$("#sev_upp_sel_tex_1").on("change", function() {
		svBtn();
	});

	$("#uni_upp_sel_tex_2").on("change", function() {
		svBtn();
	});

	$("#sev_upp_sel_tex_3").on("change", function() {
		svBtn();
	});

	$("#sev_upp_sel_tex_4").on("change", function() {
		svBtn();
	});

	$("#sev_upp_sel_tex_5").on("change", function() {
		svBtn();
	});

});