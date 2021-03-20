$(document).ready(function(){
  $("#sch_upp_inp_txt_1").on("keyup", function() {
    var value = $(this).val();
    var np = /^[A-Za-z0-9]+$/;
    if(value=="")
        {$("#sch_upp_spa_sy").hide();}
    else 
        if(value.match(np))
            {$("#sch_upp_spa_sy").hide();}
        else
            {$("#sch_upp_spa_sy").show();}
	});

    $("#sch_upp_inp_txt_1").on("keyup", function() {
        var value1 = $(this).val();
        var value2 = $("#sch_upp_inp_num_1").val();
        var value3 = $("#sch_upp_sel_dep_1").val();
        if(value1=="" || value2=="" || value3=="")
            {$('#sch_upp_but_sub_1').attr("disabled", true);}
        else 
            {$('#sch_upp_but_sub_1').attr("disabled", false);}
    }); 

    $("#sch_upp_inp_num_1").on("keyup", function() {
        var value1 = $("#sch_upp_inp_txt_1").val();
        var value2 = $(this).val();
        var value3 = $("#sch_upp_sel_dep_1").val();
        if(value1=="" || value2=="" || value3=="")
            {$('#sch_upp_but_sub_1').attr("disabled", true);}
        else 
            {$('#sch_upp_but_sub_1').attr("disabled", false);}
    }); 

    $("#sch_upp_sel_dep_1").on("change", function() {
        var value1 = $("#sch_upp_inp_txt_1").val();
        var value2 = $("#sch_upp_inp_num_1").val();
        var value3 = $(this).val();
        if(value1=="" || value2=="" || value3=="")
            {$('#sch_upp_but_sub_1').attr("disabled", true);}
        else 
            {$('#sch_upp_but_sub_1').attr("disabled", false);}
    });    

});

function AutoUpper(nid)
{
    document.getElementById(nid).value=document.getElementById(nid).value.toUpperCase();
}