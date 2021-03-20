<div class="wrapper">
  <div class="upper" id="upper">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/adm_can.js"></script>


<h4 class="titleofpage"> Student Admission Cancellation</h4><br/>
<form method="post" action="" autocomplete="off">
 
  <table class="table">

      <tr class="tr">
          	<td class="td">
                  <label for="adm_upp_inp_enr_1" class="">Enrollment No : </label> <br/><br/> 
            </td>
            
            <td class="td">
              	 <input type="text" class="" value="<?php if(isset($_POST['submit'])){echo $rollno; }?>" id="adm_upp_inp_enr_1" name="cancel_roll_no" onkeyup="AutoUpper(this.id);" autofocus required/><br/></br>
            </td>
            <td class="td">
                  <span id='adm_upp_spa_enr' class="alert">Please enter proper Enrollment Number.</span>
            </td>
      </tr>
       
      <tr class="tr">
            <td class="td"></td>

          	<td class="td">
                 <input type="submit" name="submit" class="btn btn-success" id="adm_upp_but_sub_1" value="Submit" disabled><br/></br>
      	    </td>

            <td class="td"></td>
      </tr>

  </table>

<?php if(isset($_POST['submit'])){ ?>

  <table class="table" > 
    
      <tr class="tr">
              <?php  echo $message;  ?>
      </tr>

      <?php 
          if($do){
            
            foreach ($student_data as $key=>$value){ 
      ?>
          
          <tr class="tr">
                <td class="td">Image</td>

                <td class="td">
                <?php $img = $value->student_image; echo '<img src="data:image/jpeg;base64,'.base64_encode( $img ).'"/>'; ?></td>
          </tr>


          <tr class="tr">
                <td class="td">First Name :</td>

                <td class="td"><?php  echo $value->student_fname; ?></td>
          </tr>

          <tr class="tr">
                <td class="td">Middle Name :</td>

                <td class="td"><?php  echo $value->student_mname; ?></td>
          </tr>

          <tr class="tr">
                <td class="td">Last Name :</td>

                <td class="td"><?php  echo $value->student_lname; ?></td>
          </tr>

          <tr class="tr">
                <td class="td">Enrollment No. :</td>

                <td class="td"><?php  echo $value->student_enrollmentno; ?></td>
          </tr>

          <tr class="tr">
            <td class="td">Caste :</td>

            <td class="td">
                  <?php echo $caste; ?>
            </td>
          </tr>

          <tr class="tr">
                <td class="td">Address :</td>

                <td class="td"><?php  echo $value->student_address; ?></td>
          </tr>

          <tr class="tr">
                <td class="td">DOB :</td>

                <td class="td"><?php  echo $value->student_bdate; ?></td>
          </tr>

          <tr class="tr">
                <td class="td">Mobile No. :</td>

                <td class="td"><?php  echo $value->student_phno; ?></td>
          </tr>

          <tr class="tr">
                <td class="td">Email :</td>

                <td class="td"><?php  echo $value->student_email; ?></td>
          </tr>

          <tr class="tr">
                <td class="td">Gender :</td>

                <td class="td">
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

          <tr class="tr">
                <td class="td">Date of Admission :</td>

                <td class="td"><?php  echo $value->student_dateofadmission; ?></td>
          </tr>

          <tr class="tr">
                <td class="td">Student Shift :</td>

                <td class="td">
                    <?php   
                            if($value->student_shift=="FS") 
                              echo "First Shift";
                            else
                              echo "Second Shift";
                    ?>
                </td>
          </tr>

          <tr class="tr">
                <td class="td">Hostel :</td>

                <td class="td">
                    <?php   
                            if($value->student_hostel==0) 
                              echo "No";
                            else
                              echo "Yes";
                    ?>
                </td>
          </tr>

          <tr class="tr">
                <td class="td">TFWS :</td>

                <td class="td">
                    <?php   
                            if($value->student_tfws==0) 
                              echo "No";
                            else
                              echo "Yes";
                    ?>
                </td>
          </tr>

          <tr class="tr">
                <td class="td">Mother's First Name :</td>

                <td class="td"><?php echo $value->student_mothers_fname; ?></td>
          </tr>

          <tr class="tr">
                <td class="td">Mother's Last Name :</td>

                <td class="td"><?php echo $value->student_mothers_lname; ?></td>
          </tr>

          <tr class="tr">
                <td class="td">Income :</td>

                <td class="td"><?php echo $value->student_income; ?></td>
          </tr>
          
          <tr class="tr">
                <td class="td">Department Name :</td>

                <td class="td">
                    <?php 
                          foreach ($dept as $deptkey => $deptvalue)
                              echo $deptvalue->dept_name;
                    ?>
                </td>
          </tr>

          <tr class="tr">
                <td class="td">Scheme :</td>

                <td class="td">
                    <?php 
                          foreach ($scheme as $schemekey => $schemevalue)
                              echo $schemevalue->scheme_year;
                    ?>
                </td>
          </tr>

          <tr class="tr">
                <td class="td">Direct Second Year :</td>

                <td class="td">
                  <?php   
                        if($value->student_is_directsecondyear==0) 
                              echo "No";
                        else
                              echo "Yes";
                  ?>
                </td>
          </tr>

          <tr class="tr">
                <td class="td">10th Percentage :</td>

                <td class="td"><?php  echo $value->student_10th_percent; ?></td>
          </tr>

          <tr class="tr">
                <td class="td">12th Percentage :</td>

                <td class="td"><?php  echo $value->student_12th_percent; ?></td>
          </tr>

          <tr class="tr">
                <td class="td">DTE Enrollment No. :</td>

                <td class="td"><?php  echo $value->student_dte_enrollment_no; ?></td>
          </tr>

      <?php }    ?> 

          <tr class="tr">

                <td class="td"></td>
                 
                <td class="td">   
                      <input type="submit" value="Cancel Admission" class="btn btn-success" name="cancel"/>
                </td>
                <td class="td"></td>
          </tr>
      <?php }    ?>
      
  </table>

<?php } ?>   

<?php if(isset($_POST['cancel'])){ ?>

  <table class="table" > 
    
      <tr class="">
            <td class=""><?php  echo $message;  ?></td>  
      </tr>

  </table>

<?php } ?>  

</form>


</div>
</div>