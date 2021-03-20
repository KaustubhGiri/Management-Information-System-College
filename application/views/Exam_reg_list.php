
<?php
define('DOC_ID', $id);
define('DOC_TITLE', $doc_title);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('EXAM REGISTRATION');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->setHeaderFont(Array('helvetica', '','18'));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

$Course_name;
$Course_code;
$Course_shift;
foreach($exam_reg_list_details as $course_name){
		$Course_name='<tr>Course Name : '.strtoupper($course_name->course_name).'</tr>';
		$Course_code='<tr>Course Code : '.$course_name->course_code.'</tr>';
		$Course_shift='<tr>Course Shift : '.$course_name->student_shift.'</tr>';
		$Course_dept='<tr>Department : '.$course_name->dept_name.'</tr>';		
}

$table = '<table>';
$table .='<tr>
			<th style="border:1px solid black"> STUDENT ENROLLMENT NO<br></th>
			<th style="border:1px solid black"> STUDENT NAME<br></th>
			
		</tr>';
		foreach($exam_reg_list as $enrollno_name){
		$table .='<tr>
					<td style="border:1px solid black" align="left"> '.$enrollno_name->student_enrollmentno.'<br></td>
					<td style="border:1px solid black" align="left"> '.strtoupper($enrollno_name->student_lname).' '.strtoupper($enrollno_name->student_fname).' '.strtoupper($enrollno_name->student_mname).'<br></td>
					
				</tr>';
		}
$table .='</table>';
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($Course_dept, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($Course_name, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($Course_code, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($Course_shift, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');

$pdf->writeHTML($table, true, false, true, false, '');
$pdf->lastPage();

ob_clean();
$pdf->Output('exam registration list.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+