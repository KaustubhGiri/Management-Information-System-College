$(document).ready(function(){
    $("#log_upp_inp_pas_2").on("keyup", function() {
        var value = $(this).val();
        if(value=="")
            {
                $("#span").hide();
            }
            else
                {
                    $("#span").show();
                }
    });

});