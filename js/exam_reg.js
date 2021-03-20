$(document).ready(function(){    
    $("#exa_upp_inp_tex_1").on("keyup", function() {
        var value = $(this).val();
        var np = /^[\D]{2}[\d]{2}[\D]{2}[\d]{3}$/;
        if(value=="")
            {
                $("#exa_upp_spa_enr").hide();
                $("#exa_upp_inp_sub_1").attr("disabled", true);
            }
        else 
            if(value.match(np))
                {
                    $("#exa_upp_spa_enr").hide();
                    $("#exa_upp_inp_sub_1").attr("disabled", false);
                }
            else
                {
                    $("#exa_upp_spa_enr").show();
                    $("#exa_upp_inp_sub_1").attr("disabled", true);
                }
    });

});

function AutoUpper(nid)
{
    document.getElementById(nid).value=document.getElementById(nid).value.toUpperCase();
}