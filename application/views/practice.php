<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post">
			 <label for="student_enrollmentno" >Enrollment No : </label> <br/><br/> 
			 <input type="text" name="student_enrollmentno" required/><br/></br>
			 <input type="submit" name="submit" value="Submit"><br/></br>
<?php if(isset($_POST['submit'])){ ?>

  	<table> 
      <br><b><label>Student Information</b></label><br><br>
      <?php 
          foreach ($student_data as $key=>$value){ 
      ?>
          
          <tr>
                <td>Image</td>
                <td>
                <?php $img = $value->student_image; echo '<img src="data:image/jpeg;base64,'.base64_encode( $img ).'"/>'; ?>
                </td>
          </tr>
          <tr>
                <td>Student Name :</td>
                <td><?php  echo "$value->student_fname" ."\r $value->student_mname"."\r $value->student_lname"; ?></td>
          </tr>
          <tr>
                <td>Enrollment No. :</td>
				        <td><?php  echo $value->student_enrollmentno; ?></td>
          </tr>
          <tr>
                <td>Mobile No. :</td>
				        <td><?php  echo $value->student_phno; ?></td>
          </tr>
		      <tr>
                <td>Email :</td>
				        <td><?php  echo $value->student_email; ?></td>
          </tr>
		      <tr>
                <td>Gender :</td>
                <td>
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
          <tr>
                <td>Student Shift :</td>
				        <td>
                    <?php   
                            if($value->student_shift=="FS") 
                              echo "First Shift";
                            else
                              echo "Second Shift";
                    ?>
                </td>
          </tr>
          <tr>
                <td>Department Name :</td>
				        <td>
                    <?php 
                          foreach ($dept as $deptkey => $deptvalue)
                              echo $deptvalue->dept_name;
                    ?>
                </td>
          </tr>
<?php         } ?>

        </table>
        <br><br><label><b>Student Semester Record</b></label>
        <br><br><b><label>Semester 1 Record</b></label>
        <table>
          <tr>
            <td style="border: 1px solid black">Course Code</td>
            <td style="border: 1px solid black">Course Name</td>
            <td style="border: 1px solid black">Unit Test Marks</td>
            <td style="border: 1px solid black">Unit Test Presenty</td>
            <td style="border: 1px solid black">Practical Marks</td>
            <td style="border: 1px solid black">Oral Marks</td>
            <td style="border: 1px solid black">Term Work Marks</td>
            <td style="border: 1px solid black">Internal Marks Presenty</td>
            <td style="border: 1px solid black">Theory Marks</td>
            <td style="border: 1px solid black">Theory Marks Presenty</td>
            <td style="border: 1px solid black">Total Marks</td>
            <td style="border: 1px solid black">Course Total Marks</td>
            <td style="border: 1px solid black">Semester Result</td>
          </tr>

<?php   foreach ($student_info as $key => $value) {
          if($value->semester_number == '1' or  $value->AVG != NULL){ ?>

            <tr style="border: 1px solid black">
            <td style="border: 1px solid black">
                <?php echo $value->course_code;?>
            </td> 
            
            <td style="border: 1px solid black">
              <?php echo $value->course_name;?>
            </td> 

            <td style="border: 1px solid black">
              <?php echo round($value->AVG);?>
            </td>
            
            <td style="border: 1px solid black"> 
              <?php   
                    if($value->ut_stud_ab=="0") 
                      echo "PRESENT";
                    elseif($value->ut_stud_ab=="1")
                      echo "ABSENT";
                    elseif($value->course_reg_examstatus=="4") 
                      echo "DETAIN";?>
            </td>
<?php           
                if($value->course_reg_examstatus=="4"){
                    $Practical = "DETAIN";
                    $Term_Work ="DETAIN" ;
                    $Oral = "DETAIN";

                } 
                if($value->marks_type == '1') {
                    $Practical = "--";
                    $Term_Work =$value->sem_internal_marks ;
                    $Oral = "--";
                  }
                if($value->marks_type == '2'){
                    $Practical = $value->sem_internal_marks;
                    $Term_Work ="--" ;
                    $Oral = "--";
                }
                if($value->marks_type == '3'){
                    $Practical = "--";
                    $Term_Work ="--" ;
                    $Oral = $value->sem_internal_marks;
                }
                if($value->marks_type == '5'){
                    $Practical = "--";
                    $Term_Work ="--" ;
                    $Oral = "--";
                }?>
            <td style="border: 1px solid black"><?php echo $Practical ?></td>
            <td style="border: 1px solid black"><?php echo $Oral ?></td>
            <td style="border: 1px solid black"><?php echo $Term_Work ?></td>
            

            
            <td style="border: 1px solid black"> 
              <?php   
                  if($value->sem_internal_student_absent=="0") 
                    echo "PRESENT";
                  elseif($value->sem_internal_student_absent=="1")
                    echo "ABSENT";
                  elseif($value->course_reg_examstatus=="4") 
                      echo "DETAIN";?>
            </td>
            
            
            <td style="border: 1px solid black">
              <?php 
              if($value->course_reg_examstatus=="4") 
                      echo "DETAIN"; 
              else
                    echo $value->semester_result_marks_th;?>
            </td>
            
            <td style="border: 1px solid black"> <?php   
                            if($value->semester_result_studentabsent=="0") 
                              echo "PRESENT";
                            elseif($value->semester_result_studentabsent=="1")
                              echo "ABSENT";
                            elseif($value->course_reg_examstatus=="4") 
                              echo "DETAIN"; 
                            ?> 
            </td>
<?php            $total = round($value->AVG)+$value->semester_result_marks_th; ?>
            <td style="border: 1px solid black"><?php 
            if($value->course_reg_examstatus=="4") 
                      echo "DETAIN";
                      else 
                        echo $total ?></td>
            <td style="border: 1px solid black">
              <?php echo $value->course_total_marks;?> 
            </td>
            
            <td style="border: 1px solid black">
              <?php if($value->course_reg_examstatus=="2") 
                              echo "PASS";
                            elseif($value->course_reg_examstatus=="3")
                              echo "FAIL";
                            elseif($value->course_reg_examstatus=="4") 
                              echo "DETAIN"; 
                            else
                              echo ""; ?>
            </td>

        </tr>

<?php        } ?>
<?php } ?>
        
        </table>


        <!--Semester 1 Code Ends -->

        <br><br><b><label>Semester 2 Record</b></label>
        <table>
          <tr>
            <td style="border: 1px solid black">Course Code</td>
            <td style="border: 1px solid black">Course Name</td>
            <td style="border: 1px solid black">Unit Test Marks</td>
            <td style="border: 1px solid black">Unit Test Presenty</td>
            <td style="border: 1px solid black">Practical Marks</td>
            <td style="border: 1px solid black">Oral Marks</td>
            <td style="border: 1px solid black">Term Work Marks</td>
            <td style="border: 1px solid black">Internal Marks Presenty</td>
            <td style="border: 1px solid black">Theory Marks</td>
            <td style="border: 1px solid black">Theory Marks Presenty</td>
            <td style="border: 1px solid black">Course Total Marks</td>
            <td style="border: 1px solid black">Semester Result</td>
          </tr>

<?php   foreach ($student_info as $key => $value) {
          if($value->semester_number == '2'){ ?>

            <tr style="border: 1px solid black">
            <td style="border: 1px solid black">
                <?php echo $value->course_code;?>
            </td> 
            
            <td style="border: 1px solid black">
              <?php echo $value->course_name;?>
            </td> 
            
            <td style="border: 1px solid black">
              <?php echo $value->ut_marks;?>
            </td>
            
            <td style="border: 1px solid black"> 
              <?php   
                    if($value->ut_stud_ab=="0") 
                      echo "PRESENT";
                    elseif($value->ut_stud_ab=="1")
                      echo "ABSENT";
                    else 
                      echo " ";?>
            </td>
            
<?php            if($value->marks_type == '5') {
                    $Practical = "--";
                    $Term_Work = "--";
                    $Oral = "--";
              
} ?>
            <td style="border: 1px solid black"><?php echo $Practical ?></td>
            <td style="border: 1px solid black"><?php echo $Term_Work ?></td>
            <td style="border: 1px solid black"><?php echo $Oral ?></td>
            
            <td style="border: 1px solid black"> 
              <?php   
                  if($value->sem_internal_student_absent=="0") 
                    echo "PRESENT";
                  elseif($value->sem_internal_student_absent=="1")
                    echo "ABSENT";
                  else 
                      echo " ";?>
            </td>
            
            
            <td style="border: 1px solid black">
              <?php echo $value->semester_result_marks_th;?>
            </td>
            
            <td style="border: 1px solid black"> <?php   
                            if($value->semester_result_studentabsent=="0") 
                              echo "PRESENT";
                            elseif($value->semester_result_studentabsent=="1")
                              echo "ABSENT";
                            else 
                              echo " ";?> 
            </td>
            
            <td style="border: 1px solid black">
              <?php echo $value->course_total_marks;?> 
            </td>
            
            <td style="border: 1px solid black">
              <?php if($value->semester_result_pass=="1") 
                              echo "PASS";
                            elseif($value->semester_result_pass=="0")
                              echo "FAIL";
                            else 
                              echo " ";?> 
            </td>
        </tr>

<?php        } ?>
<?php } ?>

        </table>
        <!--Semester 2 Code Ends -->

        <br><br><b><label>Semester 3 Record</b></label>
        <table>
          <tr>
            <td style="border: 1px solid black">Course Code</td>
            <td style="border: 1px solid black">Course Name</td>
            <td style="border: 1px solid black">Unit Test Marks</td>
            <td style="border: 1px solid black">Unit Test Presenty</td>
            <td style="border: 1px solid black">Practical Marks</td>
            <td style="border: 1px solid black">Oral Marks</td>
            <td style="border: 1px solid black">Term Work Marks</td>
            <td style="border: 1px solid black">Internal Marks Presenty</td>
            <td style="border: 1px solid black">Theory Marks</td>
            <td style="border: 1px solid black">Theory Marks Presenty</td>
            <td style="border: 1px solid black">Course Total Marks</td>
            <td style="border: 1px solid black">Semester Result</td>
          </tr>

<?php   foreach ($student_info as $key => $value) {
          if($value->semester_number == '3'){ ?>

            <tr style="border: 1px solid black">
            <td style="border: 1px solid black">
                <?php echo $value->course_code;?>
            </td> 
            
            <td style="border: 1px solid black">
              <?php echo $value->course_name;?>
            </td> 
            
            <td style="border: 1px solid black">
              <?php echo $value->ut_marks;?>
            </td>
            
            <td style="border: 1px solid black"> 
              <?php   
                    if($value->ut_stud_ab=="0") 
                      echo "PRESENT";
                    elseif($value->ut_stud_ab=="1")
                      echo "ABSENT";
                    else 
                      echo " ";?>
            </td>
            
<?php            if($value->marks_type == '5') {
                    $Practical = "--";
                    $Term_Work = "--";
                    $Oral = "--";
              
} ?>
            <td style="border: 1px solid black"><?php echo $Practical ?></td>
            <td style="border: 1px solid black"><?php echo $Term_Work ?></td>
            <td style="border: 1px solid black"><?php echo $Oral ?></td>
            
            <td style="border: 1px solid black"> 
              <?php   
                  if($value->sem_internal_student_absent=="0") 
                    echo "PRESENT";
                  elseif($value->sem_internal_student_absent=="1")
                    echo "ABSENT";
                  else 
                      echo " ";?>
            </td>
            
            
            <td style="border: 1px solid black">
              <?php echo $value->semester_result_marks_th;?>
            </td>
            
            <td style="border: 1px solid black"> <?php   
                            if($value->semester_result_studentabsent=="0") 
                              echo "PRESENT";
                            elseif($value->semester_result_studentabsent=="1")
                              echo "ABSENT";
                            else 
                              echo " ";?> 
            </td>
            
            <td style="border: 1px solid black">
              <?php echo $value->course_total_marks;?> 
            </td>
            
            <td style="border: 1px solid black">
              <?php if($value->semester_result_pass=="1") 
                              echo "PASS";
                            elseif($value->semester_result_pass=="0")
                              echo "FAIL";
                            else 
                              echo " ";?> 
            </td>
        </tr>

<?php        }else{ ?>
          
                <td style="border: 1px solid black" colspan="12">No Data Found</td><?php break ; ?>
          
<?php } ?>          
<?php } ?>

        </table>
        <!--Semester 3 Code Ends -->

<br><br><b><label>Semester 4 Record</b></label>
        <table>
          <tr>
            <td style="border: 1px solid black">Course Code</td>
            <td style="border: 1px solid black">Course Name</td>
            <td style="border: 1px solid black">Unit Test Marks</td>
            <td style="border: 1px solid black">Unit Test Presenty</td>
            <td style="border: 1px solid black">Practical Marks</td>
            <td style="border: 1px solid black">Oral Marks</td>
            <td style="border: 1px solid black">Term Work Marks</td>
            <td style="border: 1px solid black">Internal Marks Presenty</td>
            <td style="border: 1px solid black">Theory Marks</td>
            <td style="border: 1px solid black">Theory Marks Presenty</td>
            <td style="border: 1px solid black">Course Total Marks</td>
            <td style="border: 1px solid black">Semester Result</td>
          </tr>

<?php   foreach ($student_info as $key => $value) {
          if($value->semester_number == '4'){ ?>

            <tr style="border: 1px solid black">
            <td style="border: 1px solid black">
                <?php echo $value->course_code;?>
            </td> 
            
            <td style="border: 1px solid black">
              <?php echo $value->course_name;?>
            </td> 
            
            <td style="border: 1px solid black">
              <?php echo $value->ut_marks;?>
            </td>
            
            <td style="border: 1px solid black"> 
              <?php   
                    if($value->ut_stud_ab=="0") 
                      echo "PRESENT";
                    elseif($value->ut_stud_ab=="1")
                      echo "ABSENT";
                    else 
                      echo " ";?>
            </td>
            
           <?php            if($value->marks_type == '5') {
                    $Practical = "--";
                    $Term_Work = "--";
                    $Oral = "--";
              
} ?>
            <td style="border: 1px solid black"><?php echo $Practical ?></td>
            <td style="border: 1px solid black"><?php echo $Term_Work ?></td>
            <td style="border: 1px solid black"><?php echo $Oral ?></td>
            
            <td style="border: 1px solid black"> 
              <?php   
                  if($value->sem_internal_student_absent=="0") 
                    echo "PRESENT";
                  elseif($value->sem_internal_student_absent=="1")
                    echo "ABSENT";
                  else 
                      echo " ";?>
            </td>
            
            
            <td style="border: 1px solid black">
              <?php echo $value->semester_result_marks_th;?>
            </td>
            
            <td style="border: 1px solid black"> <?php   
                            if($value->semester_result_studentabsent=="0") 
                              echo "PRESENT";
                            elseif($value->semester_result_studentabsent=="1")
                              echo "ABSENT";
                            else 
                              echo " ";?> 
            </td>
            
            <td style="border: 1px solid black">
              <?php echo $value->course_total_marks;?> 
            </td>
            
            <td style="border: 1px solid black">
              <?php if($value->semester_result_pass=="1") 
                              echo "PASS";
                            elseif($value->semester_result_pass=="0")
                              echo "FAIL";
                            else 
                              echo " ";?> 
            </td>
        </tr>

<?php        } ?>
<?php } ?>

        </table>
<!--Semester 4 Code Ends -->

       <br><br><b><label>Semester 5 Record</b></label>
        <table>
          <tr>
            <td style="border: 1px solid black">Course Code</td>
            <td style="border: 1px solid black">Course Name</td>
            <td style="border: 1px solid black">Unit Test Marks</td>
            <td style="border: 1px solid black">Unit Test Presenty</td>
            <td style="border: 1px solid black">Practical Marks</td>
            <td style="border: 1px solid black">Oral Marks</td>
            <td style="border: 1px solid black">Term Work Marks</td>
            <td style="border: 1px solid black">Internal Marks Presenty</td>
            <td style="border: 1px solid black">Theory Marks</td>
            <td style="border: 1px solid black">Theory Marks Presenty</td>
            <td style="border: 1px solid black">Course Total Marks</td>
            <td style="border: 1px solid black">Semester Result</td>
          </tr>

<?php   foreach ($student_info as $key => $value) {
          if($value->semester_number == '5'){ ?>

            <tr style="border: 1px solid black">
            <td style="border: 1px solid black">
                <?php echo $value->course_code;?>
            </td> 
            
            <td style="border: 1px solid black">
              <?php echo $value->course_name;?>
            </td> 
            
            <td style="border: 1px solid black">
              <?php echo $value->ut_marks;?>
            </td>
            
            <td style="border: 1px solid black"> 
              <?php   
                    if($value->ut_stud_ab=="0") 
                      echo "PRESENT";
                    elseif($value->ut_stud_ab=="1")
                      echo "ABSENT";
                    else 
                      echo " ";?>
            </td>
            
            <?php            if($value->marks_type == '5') {
                    $Practical = "--";
                    $Term_Work = "--";
                    $Oral = "--";
              
} ?>
            <td style="border: 1px solid black"><?php echo $Practical ?></td>
            <td style="border: 1px solid black"><?php echo $Term_Work ?></td>
            <td style="border: 1px solid black"><?php echo $Oral ?></td>

            
            <td style="border: 1px solid black"> 
              <?php   
                  if($value->sem_internal_student_absent=="0") 
                    echo "PRESENT";
                  elseif($value->sem_internal_student_absent=="1")
                    echo "ABSENT";
                  else 
                      echo " ";?>
            </td>
            
            
            <td style="border: 1px solid black">
              <?php echo $value->semester_result_marks_th;?>
            </td>
            
            <td style="border: 1px solid black"> <?php   
                            if($value->semester_result_studentabsent=="0") 
                              echo "PRESENT";
                            elseif($value->semester_result_studentabsent=="1")
                              echo "ABSENT";
                            else 
                              echo " ";?> 
            </td>
            
            <td style="border: 1px solid black">
              <?php echo $value->course_total_marks;?> 
            </td>
            
            <td style="border: 1px solid black">
              <?php if($value->semester_result_pass=="1") 
                              echo "PASS";
                            elseif($value->semester_result_pass=="0")
                              echo "FAIL";
                            else 
                              echo " ";?> 
            </td>
        </tr>

<?php        }else{ ?>
          
                <td style="border: 1px solid black" colspan="12">No Data Found</td><?php break ; ?>
          
<?php } ?>          
<?php } ?>

        </table>
        <!--Semester 5 Code Ends -->

       <br><br><b><label>Semester 6 Record</b></label>
        <table>
          <tr>
            <td style="border: 1px solid black">Course Code</td>
            <td style="border: 1px solid black">Course Name</td>
            <td style="border: 1px solid black">Unit Test Marks</td>
            <td style="border: 1px solid black">Unit Test Presenty</td>
            <td style="border: 1px solid black">Practical Marks</td>
            <td style="border: 1px solid black">Oral Marks</td>
            <td style="border: 1px solid black">Term Work Marks</td>
            <td style="border: 1px solid black">Internal Marks Presenty</td>
            <td style="border: 1px solid black">Theory Marks</td>
            <td style="border: 1px solid black">Theory Marks Presenty</td>
            <td style="border: 1px solid black">Course Total Marks</td>
            <td style="border: 1px solid black">Semester Result</td>
          </tr>

<?php   foreach ($student_info as $key => $value) {
          if($value->semester_number == '6'){ ?>

            <tr style="border: 1px solid black">
            <td style="border: 1px solid black">
                <?php echo $value->course_code;?>
            </td> 
            
            <td style="border: 1px solid black">
              <?php echo $value->course_name;?>
            </td> 
            
            <td style="border: 1px solid black">
              <?php echo $value->ut_marks;?>
            </td>
            
            <td style="border: 1px solid black"> 
              <?php   
                    if($value->ut_stud_ab=="0") 
                      echo "PRESENT";
                    elseif($value->ut_stud_ab=="1")
                      echo "ABSENT";
                    else 
                      echo " ";?>
            </td>
            
<?php            if($value->marks_type == '1') {
                    $Practical = "--";
                    $Term_Work =$value->sem_internal_marks ;
                    $Oral = "--";
                  }
                if($value->marks_type == '2'){
                    $Practical = $value->sem_internal_marks;
                    $Term_Work ="--" ;
                    $Oral = "--";
                }
                if($value->marks_type == '3'){
                    $Practical = "--";
                    $Term_Work ="--" ;
                    $Oral = $value->sem_internal_marks;
                }
                /*if($value->marks_type == '4'){
                    $Practical = "--";
                    $Term_Work ="--" ;
                    $Oral = $value->sem_internal_marks;
                }*/
                if($value->marks_type == '5'){
                    $Practical = "--";
                    $Term_Work ="--" ;
                    $Oral = "--";
                }?>

            <td style="border: 1px solid black"><?php echo $Practical ?></td>
            <td style="border: 1px solid black"><?php echo $Term_Work ?></td>
            <td style="border: 1px solid black"><?php echo $Oral ?></td>
            
            <td style="border: 1px solid black"> 
              <?php   
                  if($value->sem_internal_student_absent=="0") 
                    echo "PRESENT";
                  elseif($value->sem_internal_student_absent=="1")
                    echo "ABSENT";
                  else 
                      echo " ";?>
            </td>
            
            
            <td style="border: 1px solid black">
              <?php echo $value->semester_result_marks_th;?>
            </td>
            
            <td style="border: 1px solid black"> <?php   
                            if($value->semester_result_studentabsent=="0") 
                              echo "PRESENT";
                            elseif($value->semester_result_studentabsent=="1")
                              echo "ABSENT";
                            else 
                              echo " ";?> 
            </td>
            
            <td style="border: 1px solid black">
              <?php echo $value->course_total_marks;?> 
            </td>
            
            <td style="border: 1px solid black">
              <?php if($value->semester_result_pass=="1") 
                              echo "PASS";
                            elseif($value->semester_result_pass=="0")
                              echo "FAIL";
                            else 
                              echo " ";?> 
            </td>
        </tr>

<?php        }else{ ?>
          
                <td style="border: 1px solid black" colspan="12">No Data Found</td><?php break ; ?>
          
<?php } ?>          
<?php } ?>

        </table>
<!-- Semester 6 Code Ends -->







<?php } ?>
</form>
</body>
</html>