
function infoviewBtn(){

        var value1 = $("#inv_upp_sel_tex_1").val();
        var value2 = $("#inv_upp_inp_tex_1").val();
        if(value1=="" || value2=="")
            {$('#inv_upp_but_sub_1').attr("disabled", true);}
        else 
            {$('#inv_upp_but_sub_1').attr("disabled", false);}
}

$(document).ready(function(){

    $("#inv_upp_sel_tex_1").on("change", function() {
       infoviewBtn();
    }); 

    $("#inv_upp_inp_tex_1").on("keyup", function() {
        var value = $("#inv_upp_inp_tex_1").val();
        var np =/^[\d]+$/;
        if(value=="")
            {
            	$("#inf_upp_spa_year").show();
            	infoviewBtn();
            }
        else 
            if(value.match(np))
                {
                	$("#inf_upp_spa_year").hide();
                	infoviewBtn();
                }
            else
                {
                	$("#inf_upp_spa_year").show();
                }
    }); 

});