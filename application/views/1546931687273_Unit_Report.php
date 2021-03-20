<?php
define('DOC_ID', $id);
define('DOC_TITLE', $doc_title);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Goverment Polytechnic Mumbai');
$pdf->SetTitle('Unit Test Report');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData('','' , PDF_HEADER_TITLE);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'Government Polytechnic Mumbai',PDF_HEADER_STRING);

//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
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
foreach ($dept_scheme as $key => $value) {
	if($shift_id=="FS")
		$student_shift="FIRST SHIFT";
	else
		$student_shift="SECOND SHIFT";
	$dept='<label>Programme : <b>'.$value->scheme_year.'-DIPLOMA IN '.strtoupper($value->dept_name).' ('.$student_shift.')</b></label><br>';
}
$pdf->writeHTMLCell(0,0,'','',$dept,0,1,0,true,'L',true);
$year=date("y");
$year1=$year+1;
foreach ($course_code_name as $key => $value) {
			$course='<label>Course Code & Title :  <b>'.$value->course_code.'-'.$value->course_name.'</b></label><br>';
}
$pdf->writeHTMLCell(0,0,'','',$course,0,1,0,true,'L',true);

$unit_test = '<label>Unit Test : <b>'.$final.'</b></label><br>';
$pdf->writeHTMLCell(0,0,'','',$unit_test,0,1,0,true,'L',true);

$term_name = '<label>Term : <b>'.$term.'-'.$year.$year1.'</b></label><br>';
$pdf->writeHTMLCell(0,0,'','',$term_name,0,1,0,true,'R',true);

$maximum_marks = '<label>Max. Marks :<b>30</label>';
$pdf->writeHTMLCell(0,0,'','',$maximum_marks,0,1,0,true,'R',true);

$heading =<<<EOD
<h3> <u> Marks List </u> </h3>
EOD;
$pdf->writeHTMLCell(0,0,'','',$heading,0,1,0,true,'C',true);
$pdf->Ln(8);
$Absent ="Absent";

$table = '<table style ="border:1px solid black">';
$table .= '<tr>
				<th style ="border:1px solid black">Enrollment Number<br></th>
				<th style ="border:1px solid black">Marks<br></th>
				<th style ="border:1px solid black">DATE<br></th>
			</tr>';
foreach ($pdf_data as $value) {
	if($value->ut_stud_ab == '1'){
	
	$table .= '<tr>
				<td style ="border:1px solid black">'.$value->student_enrollmentno.'<br></td>
				<td style ="border:1px solid black">'.$Absent.'<br></td>
				<td style ="border:1px solid black">'.$value->date.'<br></td>
			   </tr>';

}else {
	$table .= '<tr>
				<td style ="border:1px solid black">'.$value->student_enrollmentno.'<br></td>
				<td style ="border:1px solid black">'.$value->ut_marks.'<br></td>
				<td style ="border:1px solid black">'.$value->date.'<br></td>
			   </tr>';
}
}
$table .='</table>';
$pdf->writeHTMLCell(0,0,'','',$table,0,1,0,true,'C',true);

$pdf->writeHTMLCell(0,0,'','',$total_marks,0,1,0,true,'L',true);

foreach ($get_count as  $value) {
$total_students = '<br><br><label>No.of Examinees <u>: '.$value->get_total.'</u></label>';
}
$pdf->writeHTMLCell(0,0,'','',$total_students,0,1,0,true,'L',true);


foreach ($get_absent as $key=> $value) {
$absent_student = '<br><br><label>Absent : <u>'.$value->get_absent.'</u></label>';
}
$pdf->writeHTMLCell(0,0,'','',$absent_student,0,1,0,true,'L',true);

foreach($get_count as $key => $data)
	$all_sum= $data->get_total;
foreach($get_absent as $key => $data)
	$ab_sum= $data->get_absent;
if($all_sum>$ab_sum){
		$v = $all_sum-$ab_sum;
		$total_present = '<br><br><label>Total Present Students <u>: '.$v.'</u></label>';
	}else if($all_sum < $ab_sum){
		$v1 =$ab_sum-$all_sum;
		$total_present = '<br><br><label>Total Present Students <u>: '.$v1.'</u></label>';
	}	

$pdf->writeHTMLCell(0,0,'','',$total_present,0,1,0,true,'L',true);


$name ='<lable>Name of Examiner </label>';
$pdf->writeHTMLCell(0,0,'','',$name,0,1,0,true,'R',true);

$line='<label>____________________________________</label>';
$pdf->writeHTMLCell(0,0,'','',$line,0,1,0,true,'R',true);

$sign ='<br><lable>Signature of Examiner </label>';
$pdf->writeHTMLCell(0,0,'','',$sign,0,1,0,true,'R',true);
$pdf->writeHTMLCell(0,0,'','',$line,0,1,0,true,'R',true);


//Close and output PDF document
ob_clean();
$pdf->Output('Unit_Test_Report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+