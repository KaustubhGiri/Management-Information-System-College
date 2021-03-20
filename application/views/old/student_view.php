
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript">   
</script>

<script>
$(document).ready(function(){
    $('#sub_caste').change(function(){
        var subcaste=$('#sub_caste').val();
        alert(subcaste);
    });
    /*
     $('#direct_second').change(function(){
        var direct_second=$('#direct_second').val();

        alert(direct_second);
        if(direct_second==1)
        {
            $.ajax({
                url:"student_controller/fetch_percent12",
                data:{direct_second:direct_second},
                method:"POST",
                success:function(data)
                {alert('success')
                    $('#gayab').html(data);
                }
            })
        }
        else
        {
            $.ajax({
              //  url:"student_controller/fetch_percent12",
                //data:{direct_second:direct_second},
                method:"POST",
                success:function(data)
                {alert('success')
                    $('#gayab').empty();
                }
            })
        }
    });*/
    $('#caste').change(function(){
        var caste=$('#caste').val();
        
        if(caste=='Open')
        {
            $.ajax(
            {
                //url:"student_controller/fetch_open",
                //method:"POST",
                //data:{caste:caste},
                success:function(data)
                    {   
                        
                        $('#sub_caste').empty();
                        $('#sub_caste').html("<option>NO Sub-Caste</option>");

                    }
                
            })//ajax end  
        }
        if(caste=='Scheduled caste'||caste=='Scheduled Tribes'||caste=='Special Backward class'||caste=='Nomadic Tribes-2( NT-C)'||caste=='Nomadic Tribes-3( NT-D)'||caste=='Other Backward Class')
        { 
            $.ajax(
            {
                url:"student_controller/fetch_subcaste",
                method:"POST",
                data:{caste:caste},
                success:function(data)
                    {   
                    
                        $('#sub_caste').html(data);
                    }
                
            })//ajax end

        }
        if(caste=='Nomadic Tribes-1( NT-B)')
        { alert("in")
            $.ajax(
            {
                url:"student_controller/fetch_subcaste1",
                method:"POST",
                data:{caste:caste},
                success:function(data)
                    {   
                        
                        $('#sub_caste').html(data);
                    }
                
            })//ajax end

        }
        if(caste=='Vimukta Jati(VJ/DT)(NT-A)')
        { alert("in")
            $.ajax(
            {
                url:"student_controller/fetch_subcaste2",
                method:"POST",
                data:{caste:caste},
                success:function(data)
                    {   
                        $('#sub_caste').html(data);
                    }
                
            })//ajax end

        }

    });
});
</script>
<fieldset>

<h2> Student Registration Form</h2><br/>


<?php echo form_open('Student_controller');?>

    <table>

        <tr> 
            <td> 
                <label for="student_fname">First Name :</label> <br/><br/>
            </td> 
            <td> 
                <input type="text" id="" class="" name="student_fname"/><br/><br/>
            </td>
        </tr>

        <tr> 
            <td> 
                <label for="student_mname"> Middle Name :</label> <br/><br/>
            </td>
            <td>
                <input type="text" id="" class="" name="student_mname"/><br/><br/>
            </td>
        </tr>

        <tr>
            <td> 
                <label for="student_lname">Last Name : </label> <br/><br/>
            </td>
            <td> 
                <input type="text" id="" class="" name="student_lname"/> <br/><br/>
            </td>
        </tr>

        <tr>
            <td> 
                <label for="student_caste" > Caste :</label> <br/><br/>
            </td>
            <td> 
                <select name="student_caste" id="caste" class="">
                <option value="">Select Option</option>
                    <?php foreach ($Caste as $key => $value) { ?>
            <option value="<?php echo $value->CATEGORYNAME;?>"><?php echo $value->CATEGORYNAME; ?></option>
                    <?php } ?>
            </select><br><br>                     
             
            </td>
        </tr>

        <tr>
            <td> 
                <label for="student_subcaste"> Sub-Caste :</label> <br/><br/>
            </td>
            <td> 
                <select name="student_subcaste" id="sub_caste" class="">
                    <option value=""></option>
                    
                </select><br/><br/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="student_address"> Address :</label><br/><br/>
            </td>
            <td>
                <textarea name="student_address" id="" rows="10" cols="30" class="" ></textarea> <br/><br/>
            </td>
        </tr>

        <tr>
            <td>
                <label for="student_bdate"> DOB :</label> <br/><br/>
            </td>
            <td>
                <input type="date" id="" class="" name="student_bdate" /> <br/><br/>
            </td>
        </tr>

        <tr>
            <td>
                <label for="student_phno"> Mobile no. :</label> <br/><br/>
            </td>
            <td>
                <input type="number"  maxlength="10" size="10" id="" name="student_phno" class="" /> <br/><br/>
            </td>
        </tr>

        <tr>
            <td>
                <label for="student_email"> Email ID :</label> <br/><br/>
            </td>
            <td>
                <input type="email" id="" class="" name="student_email" /> <br/><br/>
            </td>
        </tr>

        <tr>
            <td>
                <label for="student_gender"> Gender :</label> <br/><br/>
            </td>
            <td>
                <select name="student_gender" id="" class="">
                    <option value="">-Select-</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="O">Other</option>
                </select> <br/><br/>
            </td>
        </tr>

        <tr>
            <td>
                <label for="student_shift">Student Shift : </label> <br/><br/>
            </td>
            <td>
                <select name="student_shift" id="" class="">
                    <option value="">-Select-</option>
                    <option value="FS">First Shift</option>
                    <option value="SS">Second Shift</option>
                </select> <br/><br/>
            </td>
        </tr>

        <tr>
            <td>
                <label for="student_hostel">Hostel : </label> <br/><br/>
            </td>
            <td>
                <select name="student_hostel" id="" class="">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select> <br/><br/>
            </td>
        </tr>

        <tr>
            <td>
                <label for="student_tfws"> TFWS :</label> <br/><br/>
            </td>
            <td>
                <select name="student_tfws" id="" class="">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select> <br/><br/>
            </td>
        </tr>


        <tr>
            <td>
                <label for="student_mothers_fname">Mother's First Name : </label> <br/><br/>
            </td>
            <td>
                <input type="text" id="" class="" name="student_mothers_fname" /> <br/><br/>
            </td>
        </tr>

        <tr>
            <td>
                <label for="student_mothers_lname"> Mother's Last Name :</label> <br/><br/>
            </td>
            <td>
                <input type="text" id="" class="" name="student_mothers_lname" /> <br/><br/>
            </td>
        </tr>

        <tr>
            <td>
                <label for="student_income"> Annual Income :</label> <br/><br/>
            </td>
            <td>
                <input type="number" id="" class="" name="student_income" /> <br/><br/>
            </td>
        </tr>

        <tr>    
            <td>
                <label for="student_dept_id"> Student Department :</label> <br/><br/>
            </td>
            <td>
            <select name = "student_dept_id">
                <option value="">Select Option</option>
                <?php foreach ($dept as $key => $value) { ?>
                    <option value="<?php echo $value->dept_id; ?>"><?php echo $value->dept_name; ?></option>
                <?php } ?>
            </select><br><br>
            </td>
        </tr>

        <tr>    
            <td>
                <label for="student_scheme_id"> Student Scheme :</label> <br/><br/>
            </td>
            <td>
            <select name = "student_scheme_id">
                <option value="">Select Option</option>
                <?php foreach ($scheme as $key => $value1) { ?>
                    <option value="<?php echo $value1->scheme_id; ?>"><?php echo $value1->scheme_year; ?></option>
                <?php } ?>
            </select><br><br>
            </td>
        </tr>

        <tr>
            <td>
                <label for="student_year" > Direct Second Year :</label> <br/><br/>
            </td>
            <td>
                <select name="student_year" id="direct_second" class="">
                    <option value="">select</option>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select> <br/><br/>
            </td>
        </tr>

        <tr>
            <td>
                <label for="number_student_registration_10th"> 10<sup>th</sup> Percentage :</label> <br/><br/>
            </td>
            <td>
                <input type="number" step="0.01" id="number_student_registration_10th" class="" name="student_10th" required/> <br/><br/>
            </td>
        </tr>

        <tr id="gayab">
            <td >
                <label for="number_student_registration_12th"> 12<sup>th</sup> Percentage :</label> <br/><br/>
            </td>
            <td>
                <input type="number" step="0.01" id="number_student_registration_12th" class="" name="student_12th"/> <br/><br/>
            </td>
        </tr>

        <tr>
            <td>
                <label for="text_student_registration_dteno">DTE Enrollment No. : </label> <br/><br/>
            </td>
            <td>
                <input type="text" id="text_student_registration_dteno" class="" name="student_dte_enrollment_no" required /> <br/><br/>
            </td>
        </tr>

        <tr>
            <td>
                <input type="submit" id="" class="" name="submit" /> <br/><br/>
            </td>
        </tr>

    </table>

</form>
</fieldset>