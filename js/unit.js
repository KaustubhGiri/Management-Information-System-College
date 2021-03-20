
function unitBtn(){

        var value1 = $("#uni_upp_sel_tex_1").val();
        var value2 = $("#uni_upp_sel_tex_2").val();
        var value3 = $("#uni_upp_sel_tex_3").val();
        var value4 = $("#uni_upp_sel_tex_4").val();
        var value5 = $("#uni_upp_sel_tex_5").val();
        if(value1!="" && value2!="" && value3!="" && value4!="" && value5!="")
            {$('#uni_upp_but_sub_1').attr("disabled", false);}
        else 
            {$('#uni_upp_but_sub_1').attr("disabled", true);}
}

$(document).ready(function(){

    $("#uni_upp_sel_tex_1").on("change", function() {
       unitBtn();
    }); 

    $("#uni_upp_sel_tex_2").on("change", function() {
       unitBtn();
    }); 

    $("#uni_upp_sel_tex_3").on("change", function() {
       unitBtn();
    }); 

    $("#uni_upp_sel_tex_4").on("change", function() {
       unitBtn();
    }); 

    $("#uni_upp_sel_tex_5").on("change", function() {
       unitBtn();
    }); 

});