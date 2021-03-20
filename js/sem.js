$(document).ready(function(){

	$("#sem_upp_sel_sem_2").on("change", function(){
        var value2 = $(this).val();
        var value1 = $("#sem_upp_sel_sem_1").val();
        if(value2=="" || value1=="")
            {
            	$('#sem_upp_tab_tex2').hide();
            	$('#sem_upp_inp_sub_1').hide();
    		}
        else 
            {
            	$('#sem_upp_tab_tex2').show();
            	$('#sem_upp_inp_sub_1').show();
    		}
    });

    $("#sem_upp_sel_sem_1").on("change", function(){
        var value2 = $(this).val();
        var value1 = $("#sem_upp_sel_sem_2").val();
        if(value2=="" || value1=="")
            {
            	$('#sem_upp_tab_tex2').hide();
            	$('#sem_upp_inp_sub_1').hide();
    		}
        else 
            {
            	$('#sem_upp_tab_tex2').show();
            	$('#sem_upp_inp_sub_1').show();
    		}
    });


});