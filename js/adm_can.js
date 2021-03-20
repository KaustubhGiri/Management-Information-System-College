$(document).ready(function(){    
    $("#adm_upp_inp_enr_1").on("keyup", function() {
        var value = $(this).val();
        // var np = "^[0-9a-zA-Z]{9}$";
        var np = /^[\D]{2}[\d]{2}[\D]{2}[\d]{3}$/;
        if(value=="")
            {
                $("#adm_upp_spa_enr").hide();
                $("#adm_upp_but_sub_1").attr("disabled", true);
            }
        else 
            if(value.match(np))
                {
                    $("#adm_upp_spa_enr").hide();
                    $("#adm_upp_but_sub_1").attr("disabled", false);
                }
            else
                {
                    $("#adm_upp_spa_enr").show();
                    $("#adm_upp_but_sub_1").attr("disabled", true);
                }
    });

});

function AutoUpper(nid)
{
    document.getElementById(nid).value=document.getElementById(nid).value.toUpperCase();
}