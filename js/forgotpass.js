
var fpvar1;
var fpvar2;
var fpvar3;
var fpvar4;
var fpvar5;

function emailValid(id,sid){
    var value=$(id).val();
    var spanid=sid;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(value=="")
        {
            $(spanid).hide();
            return 0;
        }
    else 
        if(value.match(mailformat))
            {
                $(spanid).hide();
                return 1;
            }
        else
            {
                $(spanid).show();
                return 0;
            }
    
}



function passValid(id,pp,sid){
        var value = $(id).val();
        var spanid = sid;
        if(value=="")
            {
                $(spanid).show();
                return 0;
            }
        else 
            if(value.match(pp))
                {
                    $(spanid).hide();
                    return 1;
                }
            else
                {
                    $(spanid).show();
                    return 0;
        
                }

}

function fgpBtn(){
       if(fpvar1==1 && fpvar2==1 && fpvar3==1 && fpvar4==1 && fpvar5==1)
        {$('#fgp_upp_inp_sub_1').attr("disabled", false);}
    else 
        {$('#fgp_upp_inp_sub_1').attr("disabled", true);}
}


$(document).ready(function(){

  	$("#fgp_upp_inp_tex_2").on("keyup", function() {
      var spanid = "#fgp_upp_spa_1";
      fpvar1 = emailValid(this,spanid);
      fgpBtn();
    });


    $("#fgp_upp_inp_tex_3").on("keyup", function() {
      var spanid = "#fgp_upp_spa_2";
      var pp = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,12}$/;
      fpvar2 = passValid(this,pp,spanid);
      fgpBtn();
    });

    $("#fgp_upp_inp_tex_4").on("keyup", function() {
      var spanid = "#fgp_upp_spa_3";
      fpvar3 = emailValid(this,spanid);
      fgpBtn();
    });


    $("#fgp_upp_inp_tex_5").on("keyup", function() {
        var spanid = "#fgp_upp_spa_4";
        var pp = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,12}$/;
        fpvar4 = passValid(this,pp,spanid);
        value1 = $("#fgp_upp_inp_tex_5").val(); 
        value2 = $("#fgp_upp_inp_tex_6").val(); 
        if(value1!=value2)
        {
            fpvar5 = 0;   
            $("#fgp_upp_spa_5").show();
        }
        fgpBtn();

    });

    $("#fgp_upp_inp_tex_6").on("keyup", function() {
        var pp = $("#fgp_upp_inp_tex_5").val();
        var spanid = "#fgp_upp_spa_5";
        fpvar5 = passValid(this,pp,spanid);
        fgpBtn();
    });
});