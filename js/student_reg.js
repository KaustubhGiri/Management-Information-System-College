
var srvar1;
var srvar2;
var srvar3;
var srvar4;
var srvar5;
var srvar6;
var srvar7;
var srvar8;
var srvar9;
var srvar10;


function srnpCheck(value,np,sid){

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

function srBtn(){

    var value1 = $("#stu_upp_sel_tex_1").val(); //caste
    var value2 = $("#stu_upp_sel_tex_2").val(); //subcaste
    var value3 = $("#stu_upp_tex_tex_1").val(); //address
    var value4 = $("#stu_upp_inp_dat_1").val(); //dob
    var value5 = $("#stu_upp_sel_tex_3").val(); //gender
    var value6 = $("#stu_upp_sel_tex_7").val(); //dept
    var value7 = $("#stu_upp_sel_tex_8").val(); //scheme
    // var value10 = $("#").val();

    if(srvar1==1 && srvar2==1 && srvar3==1 && srvar4==1 && srvar5==1 && srvar6==1 && srvar7==1 && srvar8==1 && srvar9==1 && srvar10==1 && value1!="" && value2!="" && value3!="" && value4!="" && value5!="" && value6!="" && value7!="")
    {
        $("#stu_upp_inp_sub_1").attr("disabled", false);
    }
    else
    {
        $("#stu_upp_inp_sub_1").attr("disabled", true);
    }
}

$(document).ready(function(){

    //first name
    $("#stu_upp_inp_tex_1").on("keyup", function() {
    var value = $(this).val();
    var np = /^[A-Za-z\s]+$/;
    var sid = "#stu_upp_spa_fn";
    srvar1 = srnpCheck(value,np,sid);
    srBtn();
    
    });

  //middle name
  $("#stu_upp_inp_tex_2").on("keyup", function() {
    var value = $(this).val();
    var np = /^[A-Za-z\s]+$/;
    var sid = "#stu_upp_spa_mn";
    srvar2 = srnpCheck(value,np,sid);
    srBtn();
    
  });

  //last name
  $("#stu_upp_inp_tex_3").on("keyup", function() {
    var value = $(this).val();
    var np = /^[A-Za-z\s]+$/;
    var sid = "#stu_upp_spa_ln"; 
    srvar3 = srnpCheck(value,np,sid);
    srBtn();
    });

    //caste
    $("#stu_upp_sel_tex_1").on("change", function() {
        srBtn();
    });

    //subcaste
    $("#stu_upp_sel_tex_2").on("change", function() {
        srBtn();
    });


    //address
     $("#stu_upp_tex_tex_1").on("keyup", function() {
        var value = $(this).val();
        var sid = "#stu_upp_spa_addr"; 
        if(value=="")
        {
            $(sid).show();
        }
        else
        {
            $(sid).hide();
        }
        srBtn();
    });

     //mobile number
    $("#stu_upp_inp_num_1").on("keyup", function(){
        var value = $(this).val();
        var np = /^\d{10}$/;
        var sid = "#stu_upp_spa_mobileno";
        srvar4 = srnpCheck(value,np,sid);
        srBtn();

    });

    //email id
    $("#stu_upp_inp_ema_1").on("keyup", function() {
        var value = $(this).val();
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var sid = "#stu_upp_spa_email";
        srvar5 = srnpCheck(value,mailformat,sid);
        srBtn();
    });

    //dob
    $("#stu_upp_inp_dat_1").on("change", function() {
        srBtn();
    });

    //gender
    $("#stu_upp_sel_tex_3").on("change", function() {
        srBtn();
    });

    //mother's first name
    $("#stu_upp_inp_tex_4").on("keyup", function() {
        var value = $(this).val();
        var np = /^[A-Za-z\s]+$/;
        var sid = "#stu_upp_spa_mfn";
        srvar6 = srnpCheck(value,np,sid);
        srBtn();
    
    });

    //mother's last name
    $("#stu_upp_inp_tex_5").on("keyup", function() {
        var value = $(this).val();
        var np = /^[A-Za-z\s]+$/;
        var sid = "#stu_upp_spa_mln";
        srvar7 = srnpCheck(value,np,sid);
        srBtn();
   
    });

     //Annual Income
     $("#stu_upp_inp_num_2").on("keyup", function() {
        var value = $(this).val();
        var np = /^[\d]+$/;
        var sid = "#stu_upp_spa_ai";
        srvar8 = srnpCheck(value,np,sid);
        srBtn();

    });

      //dept
    $("#stu_upp_sel_tex_7").on("change", function() {
        srBtn();
    });

     //scheme
    $("#stu_upp_sel_tex_8").on("change", function() {
        srBtn();
    });

     //10th percentage
    $("#stu_upp_inp_num_3").on("keyup", function() {
        var value = $(this).val();
        var np = /^[\d \.]+$/;
        var sid = "#stu_upp_spa_tenth";
        srvar9 = srnpCheck(value,np,sid);
        srBtn();

    });

    //12th percentage
    $("#stu_upp_inp_num_4").on("keyup", function() {
        var value1 = $(this).val();
        var value2 = $("#stu_upp_sel_tex_9").val();
        if(value1!="" && value2=="1")
        {
            $("#stu_upp_spa_twelveth").hide();
        }
        else
        {
            $("#stu_upp_spa_twelveth").show();
        }
        srBtn();

    });


    //DTE enrollment number
    $("#stu_upp_inp_tex_6").on("keyup", function() {
        var value = $(this).val();
        var np = /^[A-Z a-z 0-9 ]+$/;
        var sid = "#stu_upp_spa_dteno";
        srvar10 = srnpCheck(value,np,sid);
        srBtn();

    });

    //choose shift
    $("#stu_upp_sel_tex_4").on("change", function(){
        var value1 = $("#stu_upp_sel_tex_4").val();
        var value2 = $("#stu_upp_sel_tex_6").val();
        if(value1=='SS' && value2=="1")
        {
            $("#stu_upp_spa_tfws").show();
        }
        else
        {
            $("#stu_upp_spa_tfws").hide();
        }

    });


    //tfws not available for second shift
    

    $("#stu_upp_sel_tex_6").on("change", function(){
        var value1 = $("#stu_upp_sel_tex_4").val();
        var value2 = $("#stu_upp_sel_tex_6").val();
        if(value1=='SS' && value2=="1")
        {
            $("#stu_upp_spa_tfws").show();
        }
        else
        {
            $("#stu_upp_spa_tfws").hide();
        }

        var value3 = $("#stu_upp_sel_tex_9").val();
        if(value2=='1' && value3=='1')
        {
           $("#stu_upp_spa_dsy").show();
        }
        else
        {
            $("#stu_upp_spa_dsy").hide();
        }
    });

   //tfws not available for direct second year
    $("#stu_upp_sel_tex_9").on("change", function(){
        var value1 = $("#stu_upp_sel_tex_6").val();
        var value2 = $("#stu_upp_sel_tex_9").val();
        if(value1=='1' && value2=='1')
        {
           $("#stu_upp_spa_dsy").show();
        }
        else
        {
            $("#stu_upp_spa_dsy").hide();
        }

            
    });



   

    // subcaste is not available for open
    // $("#stu_upp_sel_tex_1").on("change", function(){
    //     var value = $(this).val().toUpperCase();
    //     if(value=='OPEN')
    //         $("#stu_upp_sel_tex_2").attr("disabled", true);
    //     else
    //         $("#stu_upp_sel_tex_2").attr("disabled", false);
    // });
    
    //12th percentage is required for direct second year
    $("#stu_upp_sel_tex_9").on("change", function(){
        var value = $(this).val();
        if(value=='1')
        {
            $("#stu_upp_inp_num_4").attr("required", true);
            $("#stu_upp_spa_twelveth").show();
        }
        else
        {
            $("#stu_upp_inp_num_4").attr("required", false);
            $("#stu_upp_spa_twelveth").hide();
        }
    });

});


//For Automatic Operations
function AutoUpper(nid)
{
    document.getElementById(nid).value=document.getElementById(nid).value.toUpperCase();
}

function AutoLower(eid)
{
    document.getElementById(eid).value=document.getElementById(eid).value.toLowerCase();
}

//For name validation

// function ValidName()
// {
// 	var np = /^[A-Za-z\s]+$/;   //name pattern
// 	var id = "text_student_registration_fname";
// 	var name = "First Name";
// 	if(CheckName(id,np,name)==false)
// 		return false;
// 	else
// 	{
// 		var id = "text_student_registration_mname";
// 		var name = "Middle Name";
// 		if(CheckName(id,np,name)==false)
// 			return false;
// 		else
// 		{
// 			var id = "text_student_registration_lname";
// 			var name = "Last Name";
// 			if(CheckName(id,np,name)==false)
// 				return false;
// 			else
// 			{
// 				var id = "text_student_registration_motherfname";
// 				var name = "Mother's First Name";
// 				if(CheckName(id,np,name)==false)
// 					return false;
// 				else
// 				{
// 					var id = "text_student_registration_motherlname";
// 					var name = "Mother's Last Name";
// 					if(CheckName(id,np,name)==false)
// 						return false;
// 					else
// 						return true;
// 				}
// 			}
// 		}
// 	}
// }

// function CheckName(id,np,name)
// {
// 	var getbyid = document.getElementById(id);
// 	if(getbyid.value.match(np))
// 		return true;
// 	else
// 		alert("Please check "+name);
// 		getbyid.focus();
// 		return false;
// }




// function ValidateEmail()
// {
// 	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
// 	if(document.getElementById("email_student_registration_email").value.match(mailformat))
// 	{
// 		return true;
// 	}
// 	else
// 	{
// 		alert("You have entered an invalid email address!");
// 		document.getElementById("email_student_registration_email").focus();
// 		return false;
// 	}
// }

// function MobileNumber()
// {
// 	var val = document.getElementById("number_student_registration_mobileno").value;
// 	if (/^\d{10}$/.test(val)) 
// 	{
//     	return true;
// 	} 
// 	else 
// 	{
//     	alert("Invalid number! Mobile Number must be ten digits.");
//     	document.getElementById("number_student_registration_mobileno").focus();
//     	return false;
// 	}
// }

// function GenderCheck()
// {
// 	var g = document.getElementById("dropdown_student_registration_gender").value;
// 	if(g=="")
// 	{
// 		alert("Please select gender.");
// 		document.getElementById("dropdown_student_registration_gender").focus();
// 		return false;
// 	}

// }

// function ShiftCheck()
// {
// 	var sft = document.getElementById("dropdown_student_registration_shift").value;
// 	if(sft=="")
// 	{
// 		alert("Please select shift.");
// 		document.getElementById("dropdown_student_registration_shift").focus();
// 		return false;
// 	}

// }


// function Validation()
// {
//     if(ValidName()==false)
//     	return false;
//     else
//     {
//     	if(MobileNumber()==false)
//         	return false;
//     	else
//         {
//             if(ValidateEmail()==false)
//                 return false;
//             else
//             {
//                 if(GenderCheck()==false)
//                     return false;
//                 else
//                 {
//                     if(ShiftCheck()==false)
//                         return false;
//                     else 
//                     {
//                     	alert("Your form is submitted.");
//                         return true;
//                     }
//                 }
//             }
//         }
//     }
// }

