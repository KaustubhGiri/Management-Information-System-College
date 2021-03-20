

function attendsheetBtn(){

        var value1 = $("#ats_upp_sel_tex_1").val();
        var value2 = $("#ats_upp_sel_tex_2").val();
        var value3 = $("#ats_upp_sel_tex_3").val();
        var value4 = $("#ats_upp_sel_tex_4").val();
        if(value1=="" || value2=="" || value3=="" || value4=="")
            {$('#ats_upp_but_sub_1').attr("disabled", true);}
        else 
            {$('#ats_upp_but_sub_1').attr("disabled", false);}
}



$(document).ready(function(){

    $("#ats_upp_sel_tex_1").on("change", function() {
       attendsheetBtn();
    }); 

    $("#ats_upp_sel_tex_2").on("change", function() {
       attendsheetBtn();
    }); 

    $("#ats_upp_sel_tex_3").on("change", function() {
       attendsheetBtn();
    }); 

    $("#ats_upp_sel_tex_4").on("change", function() {
       attendsheetBtn();
    }); 

});