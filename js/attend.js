
function attendBtn1(){

        var value1 = $("#att_upp_inp_tex_1").val();
        var value2 = $("#att_upp_inp_tex_2").val();
        var value3 = $("#att_upp_inp_tex_3").val();
        if(value1=="" || value2=="" || value3=="")
            {$('#att_upp_but_sub_1').attr("disabled", true);}
        else 
            {$('#att_upp_but_sub_1').attr("disabled", false);}
}

function attendBtn2(){

        var value1 = $("#att_upp_inp_tex_4").val();
        var value2 = $("#att_upp_inp_tex_5").val();
        var value3 = $("#att_upp_inp_tex_6").val();
        var value4 = $("#att_upp_inp_tex_7").val();
        var value5 = $("#att_upp_inp_tex_8").val();
        if(value1=="" || value2=="" || value3=="" || value4=="" || value5=="")
            {$('#att_upp_but_sub_2').attr("disabled", true);}
        else 
            {$('#att_upp_but_sub_2').attr("disabled", false);}
}

$(document).ready(function(){


    //for First Button 
    $("#att_upp_inp_tex_1").on("keyup", function() {
        var value = $(this).val();
        var np = /^[0-9]+$/;
        if(value=="")
            {
                $("#att_upp_spa_year").show();
                attendBtn1();
            }
        else 
            if(value.match(np))
                {
                    $("#att_upp_spa_year").hide();
                    attendBtn1();
                }
            else
                {
                    $("#att_upp_spa_year").show();
                }
    });

    $("#att_upp_inp_tex_2").on("change", function() {
       attendBtn1();
    }); 

    $("#att_upp_inp_tex_3").on("change", function() {
       attendBtn1();
    });

    // For Second Button

    $("#att_upp_inp_tex_4").on("change", function() {
       attendBtn2();
    }); 

    $("#att_upp_inp_tex_5").on("change", function() {
       attendBtn2();
    });

    $("#att_upp_inp_tex_6").on("change", function() {
       attendBtn2();
    });

    $("#att_upp_inp_tex_7").on("keyup", function() {
       attendBtn2();
    }); 

    $("#att_upp_inp_tex_8").on("keyup", function() {
       attendBtn2();
    }); 
 
 });