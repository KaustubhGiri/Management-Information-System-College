function exrlBtn(){
	var value1 = $("#exrl_upp_sel_tex_1").val();
	var value2 = $("#exrl_upp_sel_tex_2").val();
	if(value1!="" && value2!="")
	{
		$('#exrl_upp_inp_sub_1').attr("disabled", false);
	}
	else
	{
		$('#exrl_upp_inp_sub_1').attr("disabled", true);
	}
}	


$(document).ready(function(){
	$("#exrl_upp_sel_tex_1").on("change", function() {
		exrlBtn();
	});

	$("#exrl_upp_sel_tex_2").on("change", function() {
		exrlBtn();
	});
});
