

function chpBtn(){
        var value2 = $("#chp_upp_inp_cnp_3").val();
        var value1 = $("#chp_upp_inp_pas_2").val();
        if(value2=="")
            {$('#chp_upp_inp_sub_1').attr("disabled", true);}
        else 
            if(value2==value1)
                {$('#chp_upp_inp_sub_1').attr("disabled", false);}
            else
                {$('#chp_upp_inp_sub_1').attr("disabled", true);}
}

$(document).ready(function(){

    $("#chp_upp_inp_pas_2").on("keyup", function() {
        var value = $(this).val();
        var pp = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,12}$/;
        if(value=="")
            {
                $("#chp_upp_spa_1").show();
                $("#chpeye1").hide();
                chpBtn();
            }
        else 
            if(value.match(pp))
                {
                    $("#chp_upp_spa_1").hide();
                    $("#chpeye1").show();
                    chpBtn();
                }
            else
                {
                    $("#chp_upp_spa_1").show();
                    $("#chpeye1").show();
                }
    });

    $("#chp_upp_inp_cnp_3").on("keyup", function(){
        var value2 = $("#chp_upp_inp_cnp_3").val();
        var value1 = $("#chp_upp_inp_pas_2").val();
        if(value2=="")
            {
                $("#chp_upp_spa_2").hide();
                $("#chpeye2").hide();
                chpBtn();
            }
        else 
            if(value2==value1)
                {
                    $("#chp_upp_spa_2").hide();
                    $("#chpeye2").show();
                    chpBtn();
                }
            else
                {
                    $("#chp_upp_spa_2").show();

                }

    });

});

