
String.prototype.toUpperCaseWords = function () {
    return this.replace(/\w+/g, function(a){ 
      return a.charAt(0).toUpperCase() + a.slice(1).toLowerCase()
    })
}

function deptbutton(){
    var value1 = $("#dep_upp_inp_tex_1").val();
    var value2 = $("#dep_upp_inp_tex_2").val();
    var value3 = $("#dep_upp_inp_num_3").val();
    if(value1=="" || value2=="" || value3=="")
    {
        $("#dep_upp_inp_sub_4").attr("disabled", true);
    }
    else
    {
        $("#dep_upp_inp_sub_4").attr("disabled", false);
    }
}

$(document).ready(function(){  

	$("#dep_upp_inp_tex_1").on("keyup", function() {
    var value = $(this).val();
    var np = /^[A-Za-z\s]+$/;
        if(value=="")
            {
                $("#dep_upp_spa_dn").hide();
                deptbutton();
            }
        else 
            if(value.match(np))
                {
                    $("#dep_upp_spa_dn").hide();
                    deptbutton();
                }
            else
                {
                    $("#dep_upp_spa_dn").show();
                    $("#dep_upp_inp_sub_4").attr("disabled", true);
                }
	});

	$("#dep_upp_inp_tex_2").on("keyup", function() {
    var value = $(this).val();
    var np = /^[A-Za-z]+$/;
    if(value=="")
        {
            $("#dep_upp_spa_di").hide();
            deptbutton();
        }
    else 
        if(value.match(np))
            {
                $("#dep_upp_spa_di").hide();
                deptbutton();
            }
        else
            {
                $("#dep_upp_spa_di").show();
                $("#dep_upp_inp_sub_4").attr("disabled", true);
            }
    });

    $("#dep_upp_inp_num_3").on("keyup", function() {
    var value = $(this).val();
    var np = /^[\d]+$/;
    if(value=="")
        {
            $("#dep_upp_spa_it").hide();
            deptbutton();
        }
    else 
        if(value.match(np))
            {
                $("#dep_upp_spa_it").hide();
                deptbutton();
            }
        else
            {
                $("#dep_upp_spa_it").show();
                $("#dep_upp_inp_sub_4").attr("disabled", true);
            }
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
