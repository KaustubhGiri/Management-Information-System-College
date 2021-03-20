function modBtn(){
    var value1 = $("#mod_upp_tex_1").val();
    var value2 = $("#mod_upp_sel_act_1").val();
    if(value1=="" || value2=="")
    {
        $("#mod_upp_but_sub_1").attr("disabled", true);
    }
    else
    {
        $("#mod_upp_but_sub_1").attr("disabled", false);
    }
}

$(document).ready(function(){
     
    $("#mod_upp_tex_1").on("keyup", function() {
        var value = $(this).val();
        if(value!="")
            {
                $("#mod_upp_spa_msg").hide();
                modBtn();
            }
        else 
            {
                $("#mod_upp_spa_msg").show();
            }   
    });

    $("#mod_upp_sel_act_1").on("change", function() {
       modBtn();
    });


});