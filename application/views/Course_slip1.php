
<?php
define('DOC_ID', $id);
define('DOC_TITLE', $doc_title);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('COURSE REGISTRATION');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '',18));
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
foreach($enroll as $enr){
$enrollmentno='<tr>STUDENT ENROLLMENT NO : '.$enr->student_enrollmentno.'</tr>';
$shift='<tr>STUDENT SHIFT : '.$enr->student_shift.'</tr>';
}
foreach($name as $fullname){
    $student_full_name='<tr>STUDENT FULL NAME : '.strtoupper($fullname->student_lname).' '.strtoupper($fullname->student_fname).' '.strtoupper($fullname->student_mname).'</tr>';
}
foreach($sem_no as $Sem_no){
    $sem_no_data='<tr>SEMESTER : '.$Sem_no->student_sem.'</tr>';

}
foreach($dept as $Dept){
            $Dept_name='<tr>Programme  : Diploma in '.$Dept->dept_name.'</tr>';
}
$course_status='';
$newline='  ';
$table = '<table>';
$table .='<tr>
            <th style="border:1px solid black" align="center">Course Code</th>
            <th style="border:1px solid black" align="center">Course Name</th>
            <th style="border:1px solid black" align="center">Course Status</th>
            
            
        </tr>';
        

foreach($course_reg_info as $Course){
            $table .='<tr>
                            <td style="border:1px solid black" align="center">'.$Course->course_code.'</td> 
                            <td style="border:1px solid black" align="center">'.$Course->course_name.'</td>
                            <td style="border:1px solid black" align="center">Registered</td>
                            
                    </tr>';                 
}
$table .='</table>';        
$signature_student='Student Signature ';
$signature_HOD='Hod Signature';
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($Dept_name, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($enrollmentno, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($shift, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($student_full_name, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($sem_no_data, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');

$pdf->writeHTML($table, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($newline, true, false, true, false, '');

$pdf->Cell(40,100,$signature_student, 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Cell(240,100,$signature_HOD, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        

// reset pointer to the last page
$pdf->lastPage();



// create some HTML content
ob_clean();
$pdf->Output('course registration slip.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+