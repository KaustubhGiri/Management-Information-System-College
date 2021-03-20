
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/student_reg.js"></script>
<script>
$(document).ready(function(){
    $('#stu_upp_sel_tex_1').change(function(){
        var caste=$('#stu_upp_sel_tex_1').val();
        if(caste=='Open')
        {
            $.ajax(
            {
                success:function(data)
                    {   
                        
                        $('#stu_upp_sel_tex_2').empty();
                        $('#stu_upp_sel_tex_2').html("<option value='0'>NO Sub-Caste</option>");

                    }
                
            })
        }
        if(caste=='Scheduled caste'||caste=='Scheduled Tribes'||caste=='Special Backward class'||caste=='Nomadic Tribes-2( NT-C)'||caste=='Nomadic Tribes-3( NT-D)'||caste=='Other Backward Class')
        {
            $.ajax(
            {
                url:"Student_controller/fetch_subcaste",
                type:"POST",
                dataType:"json",
                data:{caste:caste},
                success:function(data)
                    {
                        $('#stu_upp_sel_tex_2').empty();
                        $.each(data,function(key,value){
                                $('#stu_upp_sel_tex_2').append('<option value="'+value.Caste+'">'+value.Caste+'</option>');   
                        });
                        
                    }
                
            })
        }
        if(caste=='Nomadic Tribes-1( NT-B)')
        { 
            $.ajax(
            {
                 url:"Student_controller/fetch_subcaste1",
                type:"POST",
                dataType:"json",
                data:{caste:caste},
                success:function(data)
                    {
                        $('#stu_upp_sel_tex_2').empty();
                        $.each(data,function(key,value){
                                $('#stu_upp_sel_tex_2').append('<option value="'+value.Name_of_Tribe__NT+'">'+value.Name_of_Tribe__NT+'</option>');   
                        });
                        
                    }
            })
        }
        if(caste=='Vimukta Jati(VJ/DT)(NT-A)')
        { 
            $.ajax(
            { url:"Student_controller/fetch_subcaste2",
                type:"POST",
                dataType:"json",
                data:{caste:caste},
                success:function(data)
                    {
                        $('#stu_upp_sel_tex_2').empty();
                        $.each(data,function(key,value){
                                $('#stu_upp_sel_tex_2').append('<option value="'+value.akin_tribe+'">'+value.akin_tribe+'</option>');   
                        });
                        
                    }
                
            })
        }

    });
});

</script>

<style type="text/css">
    fieldset{
        overflow : hidden;
    }
span{display: none;color:red;}



.tooltip {
    position: relative;
    display: inline-block;
    /*border-bottom: 1px dotted black;*/
}

.tooltip .tooltiptext {
    visibility: visible;
    width: 400px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    top: -55px;
    left: 110%;
}

.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 50%;
    right: 100%;
    margin-top: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent black transparent transparent;
}
</style>
<div class="wrapper">
<div class="upper"  id="upper">

<script type="text/javascript">



</script>

<h4 class="titleofpage"> Student Registration Form</h4><br/>
<form method="POST" action="" enctype="multipart/form-data" autocomplete="off" target="_blank"><?php // DO NOT CHANGE THE enctype attribute....[CRITICAL]?>
    <table class="table">

        <tr class="tr"> 
            <td class="td"> 
                <label for="stu_upp_inp_tex_1" class="stu_upp_lab_tex" id="stu_upp_lab_tex_1">First Name :</label> <br/><br/>
            </td> 
            <td class="td"> 
                <input type="text" name="student_fname" class="stu_upp_inp_tex" id="stu_upp_inp_tex_1" onkeyup="AutoUpper(this.id);" autofocus /><br/><br/>
            </td>
            <td class="td">
                <!-- <div class="tooltip" id="div_fn">
                    <span class="alert" class="tooltiptext" id="fn">First Name must contain only letters.</span><br/>
                </div> -->
                <span class="alert" id="stu_upp_spa_fn">First Name must contain only letters.</span><br/>
            </td>
        </tr>

        <tr class="tr"> 
            <td class="td"> 
                <label for="stu_upp_inp_tex_2" class="stu_upp_lab_tex" id="stu_upp_lab_tex_2"> Middle Name :</label> <br/><br/>
            </td>
            <td class="td">
                <input type="text" name="student_mname" class="stu_upp_inp_tex" id="stu_upp_inp_tex_2" onkeyup="AutoUpper(this.id);" /><br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_mn'>Middle Name must contain only letters.</span><br/>
            </td>
        </tr>

        <tr class="tr">
            <td class="td"> 
                <label for="stu_upp_inp_tex_3" class="stu_upp_lab_tex" id="stu_upp_lab_tex_3" >Last Name : </label> <br/><br/>
            </td>
            <td class="td"> 
                <input type="text" name="student_lname" class="stu_upp_inp_tex" id="stu_upp_inp_tex_3" onkeyup="AutoUpper(this.id);" /> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_ln'>Last Name must contain only letters.</span>
            </td>
        </tr>

        <tr class="tr">
            <td class="td"> 
                <label for="stu_upp_inp_fil_1" class="stu_upp_lab_tex" id="stu_upp_lab_tex_4">Photo: </label> <br/><br/>
            </td>
            <td class="td"> 
    
                <input type="file" name="myimage" class="stu_upp_inp_fil" id="stu_upp_inp_fil_1"> <br/><br/>
            </td>
            <td class="td"> 
                <span  style="color: red;" id="stu_upp_spa_pz">File size must be under 500Kb.</span><br/>
            </td>
        </tr>

        <tr class="tr">
            <td class="td"> 
                <label for="stu_upp_sel_tex_1" class="stu_upp_lab_tex" id="stu_upp_lab_tex_5" > Caste :</label> <br/><br/>
            </td>
            <td class="td"> 
                <select name="student_caste" class="stu_upp_sel_tex" id="stu_upp_sel_tex_1">
                <option value="">Select Caste</option>
                    <?php foreach ($Caste as $key => $value) { ?>
            <option value="<?php echo $value->CATEGORYNAME;?>"><?php echo $value->CATEGORYNAME; ?></option>
                    <?php } ?>
            </select><br><br>                     
             
            </td>
        </tr>

        <tr class="tr">
            <td class="td"> 
                <label class="stu_upp_lab_tex" id="stu_upp_lab_tex_6"> Sub-Caste :</label> <br/><br/>
            </td>
            <td class="td"> 
                <select name="student_subcaste" class="stu_upp_sel_tex" id="stu_upp_sel_tex_2">
                    <option value="">-Select-</option>
                    
                </select><br/><br/>
            </td>
        </tr>
        <tr class="tr">
            <td class="td">
                <label for="stu_upp_tex_tex_1" class="stu_upp_lab_tex" id="stu_upp_lab_tex_7"> Address :</label><br/><br/>
            </td>
            <td class="td">
                <textarea name="student_address" rows="10" cols="30" class="stu_upp_tex_tex" id="stu_upp_tex_tex_1" ></textarea> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_addr' >Address field can not be empty.</span>
            </td>

        </tr>

        <tr class="tr">
            <td class="td">
                <label for="stu_upp_inp_dat_1" class="stu_upp_lab_dat" id="stu_upp_lab_dat_1"> DOB :</label> <br/><br/>
            </td>
            <td class="td">
                <input type="date" name="student_bdate" class="stu_upp_inp_dat" id="stu_upp_inp_dat_1" /> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_dob' >DOB field can not be empty.</span>
            </td>
        </tr>

        <tr class="tr">
            <td class="td">
                <label for="stu_upp_inp_num_1" class="stu_upp_lab_num" id="stu_upp_lab_num_1" > Mobile no. :</label> <br/><br/>
            </td>
            <td class="td">
                <input type="number"  maxlength="10" size="10" name="student_phno" class="stu_upp_inp_num" id="stu_upp_inp_num_1" /> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_mobileno' >Mobile number must contain 10 digits.</span>
            </td>
        </tr>

        <tr class="tr">
            <td class="td">
                <label for="stu_upp_inp_ema_1" class="stu_upp_lab_ema" id="stu_upp_lab_ema_1"> Email ID :</label> <br/><br/>
            </td>
            <td class="td">
                <input type="email" name="student_email" class="stu_upp_inp_ema" id="stu_upp_inp_ema_1" onkeyup="AutoLower(this.id);" /> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_email'>Wrong email format</span>
            </td>
        </tr>

        <tr class="tr">
            <td class="td">
                <label for="stu_upp_sel_tex_3" class="stu_upp_lab_tex" id="stu_upp_lab_tex_8"> Gender :</label> <br/><br/>
            </td>
            <td class="td">
                <select name="student_gender" class="stu_upp_sel_tex" id="stu_upp_sel_tex_3">
                    <option value="">-Select-</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="O">Other</option>
                </select> <br/><br/>
            </td>
        </tr>

        <tr class="tr">
            <td class="td">
                <label for="stu_upp_sel_tex_4" class="stu_upp_lab_tex" id="stu_upp_lab_tex_9">Student Shift : </label> <br/><br/>
            </td>
            <td class="td">
                <select name="student_shift" class="stu_upp_sel_tex" id="stu_upp_sel_tex_4"> <!--stu_upp_sel_tex_4-->
                <option value="FS" selected>First Shift</option>
                    <?php foreach ($shift as $key => $value) {
                        if($value->dept_shift == 2){ ?>
                            <option value="SS">Second Shift</option>
                    <?php } } ?>
                </select> <br/><br/>
            </td>
        </tr>

        <tr class="tr">
            <td class="td">
                <label for="stu_upp_sel_tex_5" class="stu_upp_lab_tex" id="stu_upp_lab_tex_10">Hostel : </label> <br/><br/>
            </td>
            <td class="td">
                <select name="student_hostel" class="stu_upp_sel_tex" id="stu_upp_sel_tex_5">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select> <br/><br/>
            </td>
        </tr>

        <tr class="tr">
            <td class="td">
                <label for="stu_upp_sel_tex_6" class="stu_upp_lab_tex" id="stu_upp_lab_tex_11"> TFWS :</label> <br/><br/>
            </td>
            <td class="td">
                <select name="student_tfws" class="stu_upp_sel_tex" id="stu_upp_sel_tex_6" data-default-value="0"> <!--stu_upp_sel_tex_6-->
                    <option value="0" selected>No</option>
                    <option value="1">Yes</option>
                </select> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_tfws' >TFWS category is not available in second shift.</span>
            </td>
        </tr>


        <tr class="tr">
            <td class="td">
                <label for="stu_upp_inp_tex_4" class="stu_upp_lab_tex" id="stu_upp_lab_tex_12">Mother's First Name : </label> <br/><br/>
            </td>
            <td class="td">
                <input type="text" name="student_mothers_fname" class="stu_upp_inp_tex" id="stu_upp_inp_tex_4" onkeyup="AutoUpper(this.id);" /> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_mfn'>Mother's First Name must contain only letters.</span>
            </td>
        </tr>

        <tr class="tr">
            <td class="td">
                <label for="stu_upp_inp_tex_5" class="stu_upp_lab_tex" id="stu_upp_lab_tex_13"> Mother's Last Name :</label> <br/><br/>
            </td>
            <td class="td">
                <input type="text" name="student_mothers_lname" class="stu_upp_inp_tex" id="stu_upp_inp_tex_5" onkeyup="AutoUpper(this.id);" /> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_mln'>Mother's Last Name must contain only letters.</span>
            </td>
        </tr>

        <tr class="tr">
            <td class="td">
                <label for="stu_upp_inp_num_2" class="stu_upp_lab_num" id="stu_upp_lab_num_2"> Annual Income :</label> <br/><br/>
            </td>
            <td class="td">
                <input type="number" name="student_income" class="stu_upp_inp_num" id="stu_upp_inp_num_2" /> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_ai' >Enter Annual income.</span>
            </td>
        </tr>

        <tr class="tr">    
            <td class="td">
                <label for="stu_upp_sel_tex_7" class="stu_upp_lab_tex" id="stu_upp_lab_tex_14"> Student Department :</label> <br/><br/>
            </td>
            <td class="td">
            <select name = "student_dept_id" class="stu_upp_sel_tex" id="stu_upp_sel_tex_7">
                <option value="">Select Option</option>
                <?php foreach ($dept as $key => $value) { ?>
                    <option value="<?php echo $value->dept_id; ?>"><?php echo $value->dept_name; ?></option>
                <?php } ?>
            </select><br><br>
            </td>
        </tr>

        <tr class="tr">    
            <td class="td">
                <label for="stu_upp_sel_tex_8" class="stu_upp_lab_tex" id="stu_upp_lab_tex_15"> Student Scheme :</label> <br/><br/>
            </td>
            <td class="td">
            <select name = "student_scheme_id" class="stu_upp_sel_tex" id="stu_upp_sel_tex_8">
                <option value="">Select Option</option>
                <?php foreach ($scheme as $key => $value1) { ?>
                    <option value="<?php echo $value1->scheme_id; ?>"><?php echo $value1->scheme_year; ?></option>
                <?php } ?>
            </select><br><br>
            </td>
        </tr>

        <tr class="tr">
            <td class="td">
                <label for="stu_upp_sel_tex_9" class="stu_upp_lab_tex" id="stu_upp_lab_tex_16"> Direct Second Year :</label> <br/><br/> 
            </td>
            <td class="td">
                <select name="direct_second" class="stu_upp_sel_tex" id="stu_upp_sel_tex_9" data-default-value="0">  <!--stu_upp_sel_tex_9-->
                    <option value="0" selected>No</option>
                    <option value="1">Yes</option>
                </select> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_dsy' >TFWS category is not available in direct second year.</span>
            </td>
        </tr>

        <tr class="tr">
            <td class="td">
                <label for="stu_upp_inp_num_3" class="stu_upp_lab_num" id="stu_upp_lab_num_3"> 10<sup>th</sup> Percentage :</label> <br/><br/>
            </td>
            <td class="td">
                <input type="number" step="0.01" name="student_10th" class="stu_upp_inp_num" id="stu_upp_inp_num_3" required/> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_tenth' >Enter 10th's percentage.</span>
            </td>
        </tr>

        <tr id="gayab" class="tr">
            <td class="td"> 
                <label for="stu_upp_inp_num_4" class="stu_upp_lab_num" id="stu_upp_lab_num_4"> 12<sup>th</sup> Percentage :</label> <br/><br/>
            </td>
            <td class="td">
                <input type="number" step="0.01" name="student_12th" class="stu_upp_inp_num" id="stu_upp_inp_num_4" /> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_twelveth' >12th's percentage is required for Direct second year.</span>
            </td>
        </tr>

        <tr class="tr">
            <td class="td">
                <label for="stu_upp_inp_tex_6" class="stu_upp_lab_tex" id="stu_upp_lab_tex_17" >DTE Enrollment No. : </label> <br/><br/>
            </td>
            <td class="td">
                <input type="text" name="student_dte_enrollment_no" class="stu_upp_inp_tex" id="stu_upp_inp_tex_6" onkeyup="AutoUpper(this.id);" required /> <br/><br/>
            </td>
            <td class="td">
                <span class="alert" id='stu_upp_spa_dteno' >Enter DTE enrollment Number.</span>
            </td>

        </tr>

        <tr class="tr">
            <td class="td"></td>
            <td class="td">
                <input type="submit" name="submit" class="btn btn-success" id="stu_upp_inp_sub_1" value="Submit" /> <br/><br/>
            </td>
            <td class="td"></td>
        </tr>

    </table>

</form>

</div>
</div>