<?php

define('DOC_ID', $id);
$doc_title="<b>STUDENT HISTORY<b>";
define('DOC_TITLE', $doc_title);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$pdf->SetFont('helvetica', 'B', 18);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'Government Polytechnic Mumbai','Course Registration List', array(0,64,255), array(0,64,100));
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('THEORY MARKSHEET LIST');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array('helvetica', '','18'));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();
$year=date("y");

	  	
      	foreach ($student_data as $value){
         if($value->student_gender=="M") 
	         	$Gender="Male";
	    elseif($value->student_gender=="F")
	        	$Gender="Female";
	    else
	    		$Gender="Other";

	    if($value->student_shift=="FS") 
                               $shift="First Shift";
                            else
                               $shift="Second Shift"; 
        if($value->student_hostel==0) 
                               $Hostel="No";
                            else
                               $Hostel="Yes";

        if($value->student_tfws==0) 
                             $TFWS="No";
                            else
                               $TFWS="Yes";
        if($value->student_is_directsecondyear==0) 
                               $directsecondyear="No";
                        else
                               $directsecondyear="Yes"; 
        //$img = $value->student_image; 
      //  $img_data=base64_decode($value->student_image);
     // 	$pdf->Image('@'.$img_data,'','','','JPG','','R');
$data.='<table style="border: 1px solid black"> 
      <br><b><label>Student Information</b></label><br><br>
          <tr>
                <td>Student Name :
                '.$value->student_fname.' '.$value->student_mname.' '.$value->student_lname.'</td>
          </tr>
          <tr>
                <td >Enrollment No. : '.$value->student_enrollmentno.' </td>
          </tr>      
          <tr>
            <td>Caste : '.$caste.' 
            </td>
          </tr>

          <tr>
                <td>Address : '.$value->student_address.' </td>
          </tr>

          <tr>
                <td>DOB : '.$value->student_bdate.' </td>
          </tr>

          <tr>
                <td>Mobile No. : '.$value->student_phno.'</td>
          </tr>

          <tr>
                <td>Email : '.$value->student_email.'</td>
          </tr>

          <tr>
                <td >Gender : '.$Gender.'</td>
          </tr>

          <tr>
                <td >Date of Admission : '.$value->student_dateofadmission.' </td>
          </tr>

          <tr>
                <td >Student Shift : '.$shift.'</td>
          </tr>

          <tr>
                <td>Hostel : '.$Hostel.'</td>
          </tr>

          <tr>
                <td >TFWS :'.$TFWS.'</td>
          </tr>

          <tr>
                <td >Mother\'s Name : '.$value->student_mothers_fname."\r".$value->student_mname."\r".$value->student_mothers_lname.' </td>
          </tr>
          <tr>
                <td >Income : '.$value->student_income.' </td>
          </tr>
          
          <tr>';
          foreach ($dept as $deptvalue)
               $data.='<td>Department Name : '.$deptvalue->dept_name.'</td>			
          </tr>

          <tr>';
            foreach ($scheme as $schemekey => $schemevalue)
                	$data.='<td >Scheme : '.$schemevalue->scheme_year.'</td>
          </tr>

          <tr >';

                $data.='<td >Direct Second Year : '.$directsecondyear.'</td>
          </tr>

          <tr >
                <td >10th Percentage : '.$value->student_10th_percent .'</td>
          </tr>

          <tr >
                <td >12th Percentage : '.$value->student_12th_percent.' </td>
          </tr>

          <tr >
                <td >DTE Enrollment No. : '.$value->student_dte_enrollment_no.'</td>
          </tr></table>';
}
//df->lastPage();
//student data ends
//df->AddPage();
$table1='<br><br><label><b>Student Semester Record</b></label>
        <br><br><b><label>Semester 1 Record<br><br></b></label>
        <table>
          <tr>
            <td style="border: 1px solid black" align="center">Course Code</td>
            <td style="border: 1px solid black" align="center">Course Name</td>
            <td style="border: 1px solid black" align="center">Unit Test Marks</td>
            <td style="border: 1px solid black" align="center">Unit Test Presenty</td>
            <td style="border: 1px solid black" align="center">Practical Marks</td>
            <td style="border: 1px solid black" align="center">Oral Marks</td>
            <td style="border: 1px solid black" align="center">Term Work Marks</td>
            <td style="border: 1px solid black" align="center">Internal Marks Presenty</td>
            <td style="border: 1px solid black" align="center">Theory Marks</td>
            <td style="border: 1px solid black" align="center">Theory Marks Presenty</td>
            <td style="border: 1px solid black" align="center">Total Marks</td>
            <td style="border: 1px solid black" align="center">Course Total Marks</td>
            <td style="border: 1px solid black" align="center">Semester Result</td>
          </tr>';
		foreach ($student_info as $key => $value) {

          	if($value->semester_number == '1'){ 
          		if($value->ut_stud_ab=="0") 
                    $ab="PRESENT";
                elseif($value->ut_stud_ab=="1")
                    $ab="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $ab="DETAIN";

             	$Practical='';
                $Term_Work='';
                $Oral='';
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
                }
                if($value->sem_internal_student_absent=="0") 
                    $student_absent="PRESENT";
                elseif($value->sem_internal_student_absent=="1")
                    $student_absent="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $student_absent="DETAIN";
                if($value->course_reg_examstatus=="4") 
                    $marks_th="DETAIN"; 
              	else
                    $marks_th=$value->semester_result_marks_th;
                if($value->semester_result_studentabsent=="0") 
                    $semester_result_studentabsent="PRESENT";
                elseif($value->semester_result_studentabsent=="1")
                    $semester_result_studentabsent="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $semester_result_studentabsent="DETAIN";
                if($value->course_reg_examstatus=="4") 
                    $total="DETAIN";
                else 
                    $total=round($value->AVG)+$value->semester_result_marks_th;
                if($value->course_reg_examstatus=="2") 
                    $course_reg_examstatus="PASS";
                elseif($value->course_reg_examstatus=="3")
                    $course_reg_examstatus="FAIL";
                elseif($value->course_reg_examstatus=="4") 
                    $course_reg_examstatus="DETAIN"; 
                else
                    $course_reg_examstatus=" ";
        $table1.='<tr style="border: 1px solid black">
        			<td style="border: 1px solid black" align="center">'.$value->course_code.'</td> 
            		<td style="border: 1px solid black" align="center">'.$value->course_name.'</td> 
		            <td style="border: 1px solid black" align="center">'.round($value->AVG).'</td>
        		    <td style="border: 1px solid black" align="center">'.$ab.'</td>             
		            <td style="border: 1px solid black" align="center">'.$Practical.'</td>
		            <td style="border: 1px solid black" align="center">'.$Oral.'</td>
		            <td style="border: 1px solid black" align="center">'.$Term_Work.'</td>
		            <td style="border: 1px solid black" align="center">'.$student_absent.'</td>
            		<td style="border: 1px solid black" align="center">'.$marks_th.'</td>
		            <td style="border: 1px solid black" align="center">'.$semester_result_studentabsent.'</td>
		            <td style="border: 1px solid black" align="center">'.$total.'</td> 
		            <td style="border: 1px solid black" align="center">'.$value->course_total_marks.'</td>   
           			 <td style="border: 1px solid black" align="center">'.$course_reg_examstatus.'</td>
				</tr>';

        } 
 } 
 $table1.='</table>';    
$pdf->writeHTML($data, true, false, true, false, '');
$pdf->SetFont('dejavusans', '', 8);
$pdf->AddPage();
$pdf->writeHTML($table1, true, false, true, false, '');
//sem2 table code starts
$table2='<br><br><b><label>Semester 2 Record<br><br></b></label>
        <table>
          <tr>
            <td style="border: 1px solid black" align="center">Course Code</td>
            <td style="border: 1px solid black" align="center">Course Name</td>
            <td style="border: 1px solid black" align="center">Unit Test Marks</td>
            <td style="border: 1px solid black" align="center">Unit Test Presenty</td>
            <td style="border: 1px solid black" align="center">Practical Marks</td>
            <td style="border: 1px solid black" align="center">Oral Marks</td>
            <td style="border: 1px solid black" align="center">Term Work Marks</td>
            <td style="border: 1px solid black" align="center">Internal Marks Presenty</td>
            <td style="border: 1px solid black" align="center">Theory Marks</td>
            <td style="border: 1px solid black" align="center">Theory Marks Presenty</td>
            <td style="border: 1px solid black" align="center">Total Marks</td>
            <td style="border: 1px solid black" align="center">Course Total Marks</td>
            <td style="border: 1px solid black" align="center">Semester Result</td>
          </tr>';
		foreach ($student_info as $key => $value) {

          	if($value->semester_number == '2'){ 
          		if($value->ut_stud_ab=="0") 
                    $ab="PRESENT";
                elseif($value->ut_stud_ab=="1")
                    $ab="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $ab="DETAIN";

             	$Practical='';
                $Term_Work='';
                $Oral='';
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
                }
                if($value->sem_internal_student_absent=="0") 
                    $student_absent="PRESENT";
                elseif($value->sem_internal_student_absent=="1")
                    $student_absent="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $student_absent="DETAIN";
                if($value->course_reg_examstatus=="4") 
                    $marks_th="DETAIN"; 
              	else
                    $marks_th=$value->semester_result_marks_th;
                if($value->semester_result_studentabsent=="0") 
                    $semester_result_studentabsent="PRESENT";
                elseif($value->semester_result_studentabsent=="1")
                    $semester_result_studentabsent="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $semester_result_studentabsent="DETAIN";
                if($value->course_reg_examstatus=="4") 
                    $total="DETAIN";
                else 
                    $total=round($value->AVG)+$value->semester_result_marks_th;
                if($value->course_reg_examstatus=="2") 
                    $course_reg_examstatus="PASS";
                elseif($value->course_reg_examstatus=="3")
                    $course_reg_examstatus="FAIL";
                elseif($value->course_reg_examstatus=="4") 
                    $course_reg_examstatus="DETAIN"; 
                else
                    $course_reg_examstatus=" ";
        $table2.='<tr style="border: 1px solid black">
        			<td style="border: 1px solid black" align="center">'.$value->course_code.'</td> 
            		<td style="border: 1px solid black" align="center">'.$value->course_name.'</td> 
		            <td style="border: 1px solid black" align="center">'.round($value->AVG).'</td>
        		    <td style="border: 1px solid black" align="center">'.$ab.'</td>             
		            <td style="border: 1px solid black" align="center">'.$Practical.'</td>
		            <td style="border: 1px solid black" align="center">'.$Oral.'</td>
		            <td style="border: 1px solid black" align="center">'.$Term_Work.'</td>
		            <td style="border: 1px solid black" align="center">'.$student_absent.'</td>
            		<td style="border: 1px solid black" align="center">'.$marks_th.'</td>
		            <td style="border: 1px solid black" align="center">'.$semester_result_studentabsent.'</td>
		            <td style="border: 1px solid black" align="center">'.$total.'</td> 
		            <td style="border: 1px solid black" align="center">'.$value->course_total_marks.'</td>   
           			 <td style="border: 1px solid black" align="center">'.$course_reg_examstatus.'</td>
				</tr>';

        } 
 } 
 $table2.='</table>';    
$pdf->writeHTML($table2, true, false, true, false, '');
//sem3 data start
$table3='<br><br><b><label>Semester 3 Record<br><br></b></label>
        <table>
          <tr>
            <td style="border: 1px solid black" align="center">Course Code</td>
            <td style="border: 1px solid black" align="center">Course Name</td>
            <td style="border: 1px solid black" align="center">Unit Test Marks</td>
            <td style="border: 1px solid black" align="center">Unit Test Presenty</td>
            <td style="border: 1px solid black" align="center">Practical Marks</td>
            <td style="border: 1px solid black" align="center">Oral Marks</td>
            <td style="border: 1px solid black" align="center">Term Work Marks</td>
            <td style="border: 1px solid black" align="center">Internal Marks Presenty</td>
            <td style="border: 1px solid black" align="center">Theory Marks</td>
            <td style="border: 1px solid black" align="center">Theory Marks Presenty</td>
            <td style="border: 1px solid black" align="center">Total Marks</td>
            <td style="border: 1px solid black" align="center">Course Total Marks</td>
            <td style="border: 1px solid black" align="center">Semester Result</td>
          </tr>';
		foreach ($student_info as $key => $value) {

          	if($value->semester_number == '3'){ 
          		if($value->ut_stud_ab=="0") 
                    $ab="PRESENT";
                elseif($value->ut_stud_ab=="1")
                    $ab="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $ab="DETAIN";

             	$Practical='';
                $Term_Work='';
                $Oral='';
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
                }
                if($value->sem_internal_student_absent=="0") 
                    $student_absent="PRESENT";
                elseif($value->sem_internal_student_absent=="1")
                    $student_absent="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $student_absent="DETAIN";
                if($value->course_reg_examstatus=="4") 
                    $marks_th="DETAIN"; 
              	else
                    $marks_th=$value->semester_result_marks_th;
                if($value->semester_result_studentabsent=="0") 
                    $semester_result_studentabsent="PRESENT";
                elseif($value->semester_result_studentabsent=="1")
                    $semester_result_studentabsent="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $semester_result_studentabsent="DETAIN";
                if($value->course_reg_examstatus=="4") 
                    $total="DETAIN";
                else 
                    $total=round($value->AVG)+$value->semester_result_marks_th;
                if($value->course_reg_examstatus=="2") 
                    $course_reg_examstatus="PASS";
                elseif($value->course_reg_examstatus=="3")
                    $course_reg_examstatus="FAIL";
                elseif($value->course_reg_examstatus=="4") 
                    $course_reg_examstatus="DETAIN"; 
                else
                    $course_reg_examstatus=" ";
        $table3.='<tr style="border: 1px solid black">
        			<td style="border: 1px solid black" align="center">'.$value->course_code.'</td> 
            		<td style="border: 1px solid black" align="center">'.$value->course_name.'</td> 
		            <td style="border: 1px solid black" align="center">'.round($value->AVG).'</td>
        		    <td style="border: 1px solid black" align="center">'.$ab.'</td>             
		            <td style="border: 1px solid black" align="center">'.$Practical.'</td>
		            <td style="border: 1px solid black" align="center">'.$Oral.'</td>
		            <td style="border: 1px solid black" align="center">'.$Term_Work.'</td>
		            <td style="border: 1px solid black" align="center">'.$student_absent.'</td>
            		<td style="border: 1px solid black" align="center">'.$marks_th.'</td>
		            <td style="border: 1px solid black" align="center">'.$semester_result_studentabsent.'</td>
		            <td style="border: 1px solid black" align="center">'.$total.'</td> 
		            <td style="border: 1px solid black" align="center">'.$value->course_total_marks.'</td>   
           			 <td style="border: 1px solid black" align="center">'.$course_reg_examstatus.'</td>
				</tr>';

        } 
 } 
 $table3.='</table>'; 
 $pdf->SetFont('dejavusans', '', 8);
 $pdf->AddPage();   
$pdf->writeHTML($table3, true, false, true, false, '');
//sem4 data starts
 $table4='<br><br><b><label>Semester 4 Record<br><br></b></label>
        <table>
          <tr>
            <td style="border: 1px solid black" align="center">Course Code</td>
            <td style="border: 1px solid black" align="center">Course Name</td>
            <td style="border: 1px solid black" align="center">Unit Test Marks</td>
            <td style="border: 1px solid black" align="center">Unit Test Presenty</td>
            <td style="border: 1px solid black" align="center">Practical Marks</td>
            <td style="border: 1px solid black" align="center">Oral Marks</td>
            <td style="border: 1px solid black" align="center">Term Work Marks</td>
            <td style="border: 1px solid black" align="center">Internal Marks Presenty</td>
            <td style="border: 1px solid black" align="center">Theory Marks</td>
            <td style="border: 1px solid black" align="center">Theory Marks Presenty</td>
            <td style="border: 1px solid black" align="center">Total Marks</td>
            <td style="border: 1px solid black" align="center">Course Total Marks</td>
            <td style="border: 1px solid black" align="center">Semester Result</td>
          </tr>';
		foreach ($student_info as $key => $value) {

          	if($value->semester_number == '4'){ 
          		if($value->ut_stud_ab=="0") 
                    $ab="PRESENT";
                elseif($value->ut_stud_ab=="1")
                    $ab="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $ab="DETAIN";

             	$Practical='';
                $Term_Work='';
                $Oral='';
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
                }
                if($value->sem_internal_student_absent=="0") 
                    $student_absent="PRESENT";
                elseif($value->sem_internal_student_absent=="1")
                    $student_absent="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $student_absent="DETAIN";
                if($value->course_reg_examstatus=="4") 
                    $marks_th="DETAIN"; 
              	else
                    $marks_th=$value->semester_result_marks_th;
                if($value->semester_result_studentabsent=="0") 
                    $semester_result_studentabsent="PRESENT";
                elseif($value->semester_result_studentabsent=="1")
                    $semester_result_studentabsent="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $semester_result_studentabsent="DETAIN";
                if($value->course_reg_examstatus=="4") 
                    $total="DETAIN";
                else 
                    $total=round($value->AVG)+$value->semester_result_marks_th;
                if($value->course_reg_examstatus=="2") 
                    $course_reg_examstatus="PASS";
                elseif($value->course_reg_examstatus=="3")
                    $course_reg_examstatus="FAIL";
                elseif($value->course_reg_examstatus=="4") 
                    $course_reg_examstatus="DETAIN"; 
                else
                    $course_reg_examstatus=" ";
        $table4.='<tr style="border: 1px solid black">
        			<td style="border: 1px solid black" align="center">'.$value->course_code.'</td> 
            		<td style="border: 1px solid black" align="center">'.$value->course_name.'</td> 
		            <td style="border: 1px solid black" align="center">'.round($value->AVG).'</td>
        		    <td style="border: 1px solid black" align="center">'.$ab.'</td>             
		            <td style="border: 1px solid black" align="center">'.$Practical.'</td>
		            <td style="border: 1px solid black" align="center">'.$Oral.'</td>
		            <td style="border: 1px solid black" align="center">'.$Term_Work.'</td>
		            <td style="border: 1px solid black" align="center">'.$student_absent.'</td>
            		<td style="border: 1px solid black" align="center">'.$marks_th.'</td>
		            <td style="border: 1px solid black" align="center">'.$semester_result_studentabsent.'</td>
		            <td style="border: 1px solid black" align="center">'.$total.'</td> 
		            <td style="border: 1px solid black" align="center">'.$value->course_total_marks.'</td>   
           			 <td style="border: 1px solid black" align="center">'.$course_reg_examstatus.'</td>
				</tr>';

        } 
 } 
 $table4.='</table>';    
$pdf->writeHTML($table4, true, false, true, false, '');
//sem5 data starts
 $table5='<br><br><b><label>Semester 5 Record<br><br></b></label>
        <table>
          <tr>
            <td style="border: 1px solid black" align="center">Course Code</td>
            <td style="border: 1px solid black" align="center">Course Name</td>
            <td style="border: 1px solid black" align="center">Unit Test Marks</td>
            <td style="border: 1px solid black" align="center">Unit Test Presenty</td>
            <td style="border: 1px solid black" align="center">Practical Marks</td>
            <td style="border: 1px solid black" align="center">Oral Marks</td>
            <td style="border: 1px solid black" align="center">Term Work Marks</td>
            <td style="border: 1px solid black" align="center">Internal Marks Presenty</td>
            <td style="border: 1px solid black" align="center">Theory Marks</td>
            <td style="border: 1px solid black" align="center">Theory Marks Presenty</td>
            <td style="border: 1px solid black" align="center">Total Marks</td>
            <td style="border: 1px solid black" align="center">Course Total Marks</td>
            <td style="border: 1px solid black" align="center">Semester Result</td>
          </tr>';
		foreach ($student_info as $key => $value) {

          	if($value->semester_number == '5'){ 
          		if($value->ut_stud_ab=="0") 
                    $ab="PRESENT";
                elseif($value->ut_stud_ab=="1")
                    $ab="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $ab="DETAIN";

             	$Practical='';
                $Term_Work='';
                $Oral='';
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
                }
                if($value->sem_internal_student_absent=="0") 
                    $student_absent="PRESENT";
                elseif($value->sem_internal_student_absent=="1")
                    $student_absent="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $student_absent="DETAIN";
                if($value->course_reg_examstatus=="4") 
                    $marks_th="DETAIN"; 
              	else
                    $marks_th=$value->semester_result_marks_th;
                if($value->semester_result_studentabsent=="0") 
                    $semester_result_studentabsent="PRESENT";
                elseif($value->semester_result_studentabsent=="1")
                    $semester_result_studentabsent="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $semester_result_studentabsent="DETAIN";
                if($value->course_reg_examstatus=="4") 
                    $total="DETAIN";
                else 
                    $total=round($value->AVG)+$value->semester_result_marks_th;
                if($value->course_reg_examstatus=="2") 
                    $course_reg_examstatus="PASS";
                elseif($value->course_reg_examstatus=="3")
                    $course_reg_examstatus="FAIL";
                elseif($value->course_reg_examstatus=="4") 
                    $course_reg_examstatus="DETAIN"; 
                else
                    $course_reg_examstatus=" ";
        $table5.='<tr style="border: 1px solid black">
        			<td style="border: 1px solid black" align="center">'.$value->course_code.'</td> 
            		<td style="border: 1px solid black" align="center">'.$value->course_name.'</td> 
		            <td style="border: 1px solid black" align="center">'.round($value->AVG).'</td>
        		    <td style="border: 1px solid black" align="center">'.$ab.'</td>             
		            <td style="border: 1px solid black" align="center">'.$Practical.'</td>
		            <td style="border: 1px solid black" align="center">'.$Oral.'</td>
		            <td style="border: 1px solid black" align="center">'.$Term_Work.'</td>
		            <td style="border: 1px solid black" align="center">'.$student_absent.'</td>
            		<td style="border: 1px solid black" align="center">'.$marks_th.'</td>
		            <td style="border: 1px solid black" align="center">'.$semester_result_studentabsent.'</td>
		            <td style="border: 1px solid black" align="center">'.$total.'</td> 
		            <td style="border: 1px solid black" align="center">'.$value->course_total_marks.'</td>   
           			 <td style="border: 1px solid black" align="center">'.$course_reg_examstatus.'</td>
				</tr>';

        } 
 } 
 $table5.='</table>';
 $pdf->SetFont('dejavusans', '', 8); 
 $pdf->AddPage();   
$pdf->writeHTML($table5, true, false, true, false, '');
//sem6 data starts
 $table6='<br><br><b><label>Semester 6 Record<br><br></b></label>
        <table>
          <tr>
            <td style="border: 1px solid black" align="center">Course Code</td>
            <td style="border: 1px solid black" align="center">Course Name</td>
            <td style="border: 1px solid black" align="center">Unit Test Marks</td>
            <td style="border: 1px solid black" align="center">Unit Test Presenty</td>
            <td style="border: 1px solid black" align="center">Practical Marks</td>
            <td style="border: 1px solid black" align="center">Oral Marks</td>
            <td style="border: 1px solid black" align="center">Term Work Marks</td>
            <td style="border: 1px solid black" align="center">Internal Marks Presenty</td>
            <td style="border: 1px solid black" align="center">Theory Marks</td>
            <td style="border: 1px solid black" align="center">Theory Marks Presenty</td>
            <td style="border: 1px solid black" align="center">Total Marks</td>
            <td style="border: 1px solid black" align="center">Course Total Marks</td>
            <td style="border: 1px solid black" align="center">Semester Result</td>
          </tr>';
		foreach ($student_info as $key => $value) {

          	if($value->semester_number == '6'){ 
          		if($value->ut_stud_ab=="0") 
                    $ab="PRESENT";
                elseif($value->ut_stud_ab=="1")
                    $ab="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $ab="DETAIN";

             	$Practical='';
                $Term_Work='';
                $Oral='';
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
                }
                if($value->sem_internal_student_absent=="0") 
                    $student_absent="PRESENT";
                elseif($value->sem_internal_student_absent=="1")
                    $student_absent="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $student_absent="DETAIN";
                if($value->course_reg_examstatus=="4") 
                    $marks_th="DETAIN"; 
              	else
                    $marks_th=$value->semester_result_marks_th;
                if($value->semester_result_studentabsent=="0") 
                    $semester_result_studentabsent="PRESENT";
                elseif($value->semester_result_studentabsent=="1")
                    $semester_result_studentabsent="ABSENT";
                elseif($value->course_reg_examstatus=="4") 
                    $semester_result_studentabsent="DETAIN";
                if($value->course_reg_examstatus=="4") 
                    $total="DETAIN";
                else 
                    $total=round($value->AVG)+$value->semester_result_marks_th;
                if($value->course_reg_examstatus=="2") 
                    $course_reg_examstatus="PASS";
                elseif($value->course_reg_examstatus=="3")
                    $course_reg_examstatus="FAIL";
                elseif($value->course_reg_examstatus=="4") 
                    $course_reg_examstatus="DETAIN"; 
                else
                    $course_reg_examstatus=" ";
        $table6.='<tr style="border: 1px solid black">
        			<td style="border: 1px solid black" align="center">'.$value->course_code.'</td> 
            		<td style="border: 1px solid black" align="center">'.$value->course_name.'</td> 
		            <td style="border: 1px solid black" align="center">'.round($value->AVG).'</td>
        		    <td style="border: 1px solid black" align="center">'.$ab.'</td>             
		            <td style="border: 1px solid black" align="center">'.$Practical.'</td>
		            <td style="border: 1px solid black" align="center">'.$Oral.'</td>
		            <td style="border: 1px solid black" align="center">'.$Term_Work.'</td>
		            <td style="border: 1px solid black" align="center">'.$student_absent.'</td>
            		<td style="border: 1px solid black" align="center">'.$marks_th.'</td>
		            <td style="border: 1px solid black" align="center">'.$semester_result_studentabsent.'</td>
		            <td style="border: 1px solid black" align="center">'.$total.'</td> 
		            <td style="border: 1px solid black" align="center">'.$value->course_total_marks.'</td>   
           			 <td style="border: 1px solid black" align="center">'.$course_reg_examstatus.'</td>
				</tr>';

        } 
 } 
 $table6.='</table>';    
$pdf->writeHTML($table6, true, false, true, false, '');
// reset pointer to the last page
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page


// create some HTML content
ob_clean();
$pdf->Output('Theory Marksheet.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+