<fieldset>

<h2>Student Admission Cancellation</h2>

<?php echo form_open('admission_cancel_controller');?>
 
  <table class="">

      <tr class="">
          	<td class="">
                  <label for="number_cancel_form_cancelno" class="">Enrollment No : </label> <br/><br/> 
            </td>
            
            <td class="">
              	 <input type="text" class="" value="<?php if(isset($_POST['submit'])){echo $rollno; }?>" id="number_cancel_form_cancelno" name="cancel_roll_no" autofocus required/><br/></br>
            </td>
      </tr>
       
      <tr class="">
            <td class=""></td>

          	<td class="">
      	         <button  name="submit" class="">Submit</button><br/></br>
      	    </td>

            <td class=""></td>
      </tr>

  </table>

<?php if(isset($_POST['submit'])){ ?>

  <table class="" > 
    
      <tr class="">
              <?php  echo $message;  ?>
      </tr>

      <?php 
          if($do){

          foreach ($student_data as $key=>$value){ 
      ?>
          <tr class="">
                <td class="">First Name :</td>

                <td class=""><?php  echo $value->student_fname; ?></td>
          </tr>

          <tr class="">
                <td class="">Middle Name :</td>

                <td class=""><?php  echo $value->student_mname; ?></td>
          </tr>

          <tr class="">
                <td class="">Last Name :</td>

                <td class=""><?php  echo $value->student_lname; ?></td>
          </tr>

          <tr class="">
                <td class="">Enrollment No. :</td>

                <td class=""><?php  echo $value->student_enrollmentno; ?></td>
          </tr>

          <tr class="">
                <td class="">Caste :</td>

                <td class="">
                    <?php 
                          foreach ($caste as $castekey => $castevalue)
                              echo $castevalue->CATEGORYNAME;
                    ?>
                </td>
          </tr>

          <tr class="">
                <td class="">Address :</td>

                <td class=""><?php  echo $value->student_address; ?></td>
          </tr>

          <tr class="">
                <td class="">DOB :</td>

                <td class=""><?php  echo $value->student_bdate; ?></td>
          </tr>

          <tr class="">
                <td class="">Mobile No. :</td>

                <td class=""><?php  echo $value->student_phno; ?></td>
          </tr>

          <tr class="">
                <td class="">Email :</td>

                <td class=""><?php  echo $value->student_email; ?></td>
          </tr>

          <tr class="">
                <td class="">Gender :</td>

                <td class="">
                    <?php   
                            if($value->student_gender=="M") 
                              echo "Male";
                            elseif($value->student_gender=="F")
                              echo "Female";
                            else
                              echo "Other";
                    ?>
                </td>
          </tr>

          <tr class="">
                <td class="">Date of Admission :</td>

                <td class=""><?php  echo $value->student_dateofadmission; ?></td>
          </tr>

          <tr class="">
                <td class="">Student Shift :</td>

                <td class="">
                    <?php   
                            if($value->student_shift=="FS") 
                              echo "First Shift";
                            else
                              echo "Second Shift";
                    ?>
                </td>
          </tr>

          <tr class="">
                <td class="">Hostel :</td>

                <td class="">
                    <?php   
                            if($value->student_hostel==0) 
                              echo "No";
                            else
                              echo "Yes";
                    ?>
                </td>
          </tr>

          <tr class="">
                <td class="">TFWS :</td>

                <td class="">
                    <?php   
                            if($value->student_tfws==0) 
                              echo "No";
                            else
                              echo "Yes";
                    ?>
                </td>
          </tr>

          <tr class="">
                <td class="">Mother's First Name :</td>

                <td class=""><?php echo $value->student_mothers_fname; ?></td>
          </tr>

          <tr class="">
                <td class="">Mother's Last Name :</td>

                <td class=""><?php echo $value->student_mothers_lname; ?></td>
          </tr>

          <tr class="">
                <td class="">Income :</td>

                <td class=""><?php echo $value->student_income; ?></td>
          </tr>
          
          <tr class="">
                <td class="">Department Name :</td>

                <td class="">
                    <?php 
                          foreach ($dept as $deptkey => $deptvalue)
                              echo $deptvalue->dept_name;
                    ?>
                </td>
          </tr>

          <tr class="">
                <td class="">Scheme :</td>

                <td class="">
                    <?php 
                          foreach ($scheme as $schemekey => $schemevalue)
                              echo $schemevalue->scheme_year;
                    ?>
                </td>
          </tr>

          <tr class="">
                <td class="">Direct Second Year :</td>

                <td class="">
                    <?php   
                            if($value->student_year==0) 
                              echo "No";
                            else
                              echo "Yes";
                    ?>
                </td>
          </tr>

          <tr class="">
                <td class="">10th Percentage :</td>

                <td class=""><?php  echo $value->student_10th_percent; ?></td>
          </tr>

          <tr class="">
                <td class="">12th Percentage :</td>

                <td class=""><?php  echo $value->student_12th_percent; ?></td>
          </tr>

          <tr class="">
                <td class="">DTE Enrollment No. :</td>

                <td class=""><?php  echo $value->student_dte_enrollment_no; ?></td>
          </tr>

      <?php }    //foreach loop end ?> 

          <tr class="">

                <td class=""></td>
                 
                <td class="">   
                      <button type="" class="" name="cancel">Cancel Admission</button>
                </td>

                <td class=""></td>
          </tr>
      <?php }   //if block end  ?>
      
  </table>

<?php } //if block end?>   

<?php if(isset($_POST['cancel'])){ ?>

  <table class="table" > 
    
      <tr class="">
            <td class=""><?php  echo $message;  ?></td>  
      </tr>

  </table>

<?php } //if block end?>  

</form>

</fieldset>