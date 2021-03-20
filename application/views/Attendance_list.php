<?php
define('DOC_ID', $id);
define('DOC_TITLE', $doc_title);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$pdf->SetFont('helvetica', 'B', 18);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'Government Polytechnic Mumbai',$Attendance_type.' ATTENDANCE', array(0,64,255), array(0,64,100));
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Attendance');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

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

$Course_name;
$Course_code;
$Course_shift;
foreach($Course_info as $course_info){
		$Course_code='<tr>Course Code : '.$course_info->course_code.'</tr>';
		$Course_shift='<tr>Course Shift : '.$course_info->student_shift.'</tr>';
		$Course_dept='<tr>Department : '.strtoupper($course_info->dept_name).'</tr>';	
        $faculty_Name='<tr>Faculty Name : '.strtoupper($course_info->faculty_name).'</tr>';	
}

$table ='<table border="1" cellpadding="2" cellspacing="2">';
$table .='<tr>
  <th width="140" rowspan="2" align="center"><b>STUDENT ENROLLMENTNO</b></th>
  <th width="140" rowspan="2" align="center"><b>STUDENT NAME</b></th>
  <th width="50" align="center"><b>1</b></th>
  <th width="50" align="center"><b>2</b></th>
  <th width="50" align="center"><b>3</b></th>
  <th width="50" align="center"><b>4</b></th>
  <th width="50" align="center"><b>5</b></th>
  <th width="50" align="center"><b>6</b></th>
  <th width="50" align="center"><b>7</b></th>
  </tr>
      <tr>
      <th width="50"></th>
      <th width="50"></th>
      <th width="50"></th>
      <th width="50"></th>
      <th width="50"></th>
      <th width="50"></th>
      <th width="50"></th>
      </tr>';
 foreach($Student_info as $STUDENT){
    $table .='<tr>
            <td width="140" align="left">'.$STUDENT->student_enrollmentno.'</td>
            <td width="140" align="left">'.strtoupper($STUDENT->student_lname).' '.strtoupper($STUDENT->student_fname).' '.strtoupper($STUDENT->student_mname).'</td>
            <td width="50">    </td>
            <td width="50">    </td>
            <td width="50">    </td>
            <td width="50">    </td>
            <td width="50">    </td>
            <td width="50">    </td>
            <td width="50">    </td>
            </tr>';
 }
 $table .='</table>';
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($Course_dept, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($Course_code, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($Course_shift, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($faculty_Name, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($table, true, false, true, false, '');


$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page


// create some HTML content
ob_clean();
$pdf->Output('ATTENDANCE SHEET.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+