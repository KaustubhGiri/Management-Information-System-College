
var suvar1;
var suvar2;
var suvar3;
var suvar4;
var suvar5;


function signupCheckbox(){

    var value1 = $("#sig_con_inp_tex_2").val();
    var value2 = $("#sig_con_inp_dat_1").val();
    var value3 = $("#sig_con_inp_gender").val();
    var value4 = $("#sig_con_sel_tex_1").val();
    var value5 = $("#sig_con_sel_tex_2").val();
    var value6 = $("#sig_con_sel_tex_3").val();

    if(suvar1==1 && value1!="" && value2!="" && value3!="" && suvar2==1 && suvar3==1 &&  value4!="" && value5!="" && value6!="" && suvar4==1 && suvar5==1)
        {$('#sig_con_che_tac_1').attr("disabled", false);}
    else 
        {$('#sig_con_che_tac_1').attr("disabled", true);}
}

//Signup Name pattern check
function sunpCheck(value,np,sid){
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

	//For faculty Name
  	$("#sig_con_inp_tex_1").on("keyup", function() {
	    var value = $(this).val();
	    var np = /^[A-Za-z\s]+$/;
        var sid = "#sig_con_spa_fn";
        suvar1 = sunpCheck(value,np,sid);
	    signupCheckbox();
	});
  
    //Faculty Number
    $("#sig_con_inp_tex_2").on("keyup", function() {
        signupCheckbox();
    });

    //Date fo joining
    $("#sig_con_inp_dat_1").on("change", function() {
        signupCheckbox();
    });

    //Gender
    $("#sig_con_inp_gender").on("change", function() {
        signupCheckbox();
    });

  	//For Email ID
  	$("#sig_con_inp_tex_3").on("keyup", function() {
        var value = $(this).val();
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var sid = "#sig_con_spa_femail";
        suvar2 = sunpCheck(value,mailformat,sid);
        signupCheckbox();
    });

    //For mobile number

  	$("#sig_con_inp_num_1").on("keyup", function(){
        var value = $(this).val();
        var np = /^\d{10}$/;
        var sid = "#sig_con_spa_fmobileno";
        suvar3 = sunpCheck(value,np,sid);
        signupCheckbox();

    });

    //Faculty type
    $("#sig_con_sel_tex_1").on("change", function() {
        signupCheckbox();
    });

    //Access Level
    $("#sig_con_sel_tex_2").on("change", function() {
        signupCheckbox();
    });

    //Department
    $("#sig_con_sel_tex_3").on("change", function() {
        signupCheckbox();
    });

    //Password pattern Check
    $("#sig_con_inp_pas_1").on("keyup", function(){
        var value = $(this).val();
        var pp = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,12}$/;
        var sid = "#sig_con_spa_pass1";
        suvar4 = sunpCheck(value,pp,sid);
        signupCheckbox();

    });

    //password confirmation
    $("#sig_con_inp_pas_2").on("keyup", function(){
        var value = $(this).val();
        var pp = $("#sig_con_inp_pas_1").val();
        var sid = "#sig_con_spa_pass2";
        suvar5 = sunpCheck(value,pp,sid);
        signupCheckbox();

    });

	// for checkbox to disable submit button
	$('#sig_con_che_tac_1').click(function(){
        if($(this).prop("checked") == true){   
                $("#sig_con_but_sub_1").attr("disabled", false);
            }
        else if($(this).prop("checked") == false){
                $("#sig_con_but_sub_1").attr("disabled", true);
            }
    });
 });
 
function AutoUpper(nid)
{
    document.getElementById(nid).value=document.getElementById(nid).value.toUpperCase();
}

function Cancel(){
    setTimeout("location.reload(true);", 1);
}
