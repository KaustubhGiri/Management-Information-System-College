
$(document).ready(function(){
    $("#log_upp_inp_tex_1").on("keyup", function() {
        var value = $(this).val();
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(value=="")
            {
                $("#log_upp_spa_email").hide();
                $("#log_upp_inp_sub_1").attr("disabled", true);
            }
        else 
            if(value.match(mailformat))
            {
                $("#log_upp_spa_email").hide();
                $("#log_upp_inp_sub_1").attr("disabled", false);
                
            }
            else
                {
                    $("#log_upp_spa_email").show();
                    $("#log_upp_inp_sub_1").attr("disabled", true);
                }
    });

});