
String.prototype.toUpperCaseWords = function () {
    return this.replace(/\w+/g, function(a){ 
      return a.charAt(0).toUpperCase() + a.slice(1).toLowerCase()
    })
}

var coursevar1;
var coursevar2;
var coursevar3;
var coursevar4;

function courseBtn(){
        var value4 = $("#cov_upp_sel_1").val();
        var value5 = $("#cov_upp_sel_2").val();
        if(coursevar1==1 && coursevar2==1 && coursevar3==1 && value4!="" && value5!="" && coursevar4==1)
            {$('#cov_upp_inp_sub_1').attr("disabled", false);}
        else 
            {$('#cov_upp_inp_sub_1').attr("disabled", true);}

}


function cnpCheck(value,np,sid){
      if(value=="")
            {
                $(sid).hide();
                return 0;
                
            }
        else 
            if(value.match(np))
                {
                    $(sid).hide();
                    return 1;
                  
                }
            else
                {
                    $(sid).show();
                    return 0;
                }
}

$(document).ready(function(){

	//For Course code
    $("#cov_upp_inp_tex_1").on("keyup", function() {
        var value = $(this).val();
        var np = /^[A-Za-z0-9]+$/;
        var sid = "#cov_upp_spa_1";
        coursevar1 = cnpCheck(value,np,sid);
        courseBtn();
       
    });

    //course Name
    $("#cov_upp_inp_tex_2").on("keyup", function() {
        var value = $(this).val();
        var np = /^[A-Za-z0-9-\s]+$/;
        sid = "#cov_upp_spa_2";
        coursevar2 = cnpCheck(value,np,sid);
        courseBtn();
    });



    //Lecture
    $("#cov_upp_inp_tex_3").on("keyup", function(){
        var value = $(this).val();
        var np = /^[\d]+$/;
        if(value=="")
            {$("#cov_upp_spa_3").hide();}
        else 
            if(value.match(np))
                {$("#cov_upp_spa_3").hide();}
            else
                {$("#cov_upp_spa_3").show();}
    });

    //Practicals
    $("#cov_upp_inp_tex_4").on("keyup", function(){
        var value = $(this).val();
        var np = /^[\d]+$/;
        if(value=="")
            {$("#cov_upp_spa_4").hide();}
        else 
            if(value.match(np))
                {$("#cov_upp_spa_4").hide();}
            else
                {$("#cov_upp_spa_4").show();}
    });

    //Tutorials
    $("#cov_upp_inp_tex_5").on("keyup", function(){
        var value = $(this).val();
        var np = /^[\d]+$/;
        if(value=="")
            {$("#cov_upp_spa_5").hide();}
        else 
            if(value.match(np))
                {$("#cov_upp_spa_5").hide();}
            else
                {$("#cov_upp_spa_5").show();}
    });

    //Teaching Hours
    $("#cov_upp_inp_tex_6").on("keyup", function(){
        var value = $(this).val();
        var np = /^[\d]+$/;
        if(value=="")
            {$("#cov_upp_spa_6").hide();}
        else 
            if(value.match(np))
                {$("#cov_upp_spa_6").hide();}
            else
                {$("#cov_upp_spa_6").show();}
    });

    //Course Credits
    $("#cov_upp_inp_tex_8").on("keyup", function(){
        var value = $(this).val();
        var np = /^[\d]+$/;
        sid = "#cov_upp_spa_7";
        coursevar3 = cnpCheck(value,np,sid);
        courseBtn();
    });

    //Course Level

    $("#cov_upp_sel_1").on("change", function() {
       courseBtn();
    }); 


    //Course Scheme
    $("#cov_upp_sel_2").on("change", function() {
       courseBtn();
    }); 

   //For Total
    $("#cov_upp_inp_tex_7").on("keyup", function(){
        var value = $(this).val();
        var np = /^[\d]+$/;
        sid = "#cov_upp_spa_8";
        coursevar4 = cnpCheck(value,np,sid);
        courseBtn();

    });
    
});

function AutoUpper(nid)
{
    document.getElementById(nid).value=document.getElementById(nid).value.toUpperCase();
}

function AutoCapitalize(nid)
{
  document.getElementById(nid).value=document.getElementById(nid).value.toUpperCaseWords();
}