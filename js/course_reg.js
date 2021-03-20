
var crvar1;
function crCheck1(value,np){
     if(value=="")
            {
                $("#cor_upp_spa_enr").hide();
                return 0;
            }
    else 
        if(value.match(np))
            {
                $("#cor_upp_spa_enr").hide();
                return 1;
            }
        else
            {
                $("#cor_upp_spa_enr").show();
                return 0;
            }
}


$(document).ready(function(){
    
    $("#cor_upp_inp_tex_1").on("keyup", function() {
        var value = $(this).val();
        var np = /^[\D]{2}[\d]{2}[\D]{2}[\d]{3}$/;
        var value2 = $("#cor_upp_sel_tex_2").val();
        crvar1 = crCheck1(value,np);
        if(value2!="" && crvar1==1)
            {
                $('#cor_upp_inp_sub_1').attr("disabled", false);
                
            }
        else 
            {
                $('#cor_upp_inp_sub_1').attr("disabled", true);
            }
    });


    $("#cor_upp_sel_tex_2").on("change", function(){
        var value2 = $(this).val();
        var value1 = $("#cor_upp_inp_tex_1").val();
        if(value2!="" && crvar1==1)
            {
                $('#cor_upp_inp_sub_1').attr("disabled", false);
                
            }
        else 
            {
                $('#cor_upp_inp_sub_1').attr("disabled", true);
            }
    });
});

function AutoUpper(nid)
{
    document.getElementById(nid).value=document.getElementById(nid).value.toUpperCase();
}