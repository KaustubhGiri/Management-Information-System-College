function correglistBtn(){
		var value1 = $("#crl_upp_sel_tex_1").val();
        var value2 = $("#crl_upp_sel_tex_2").val();
        if(value1=="" || value2=="")
            {$('#crl_upp_sub_1').attr("disabled", true);}
        else 
            {$('#crl_upp_sub_1').attr("disabled", false);}
}

$(document).ready(function(){

    $("#crl_upp_sel_tex_1").on("change", function() {
       correglistBtn();
    }); 

    $("#crl_upp_sel_tex_2").on("change", function() {
       correglistBtn();
    }); 
 
 });