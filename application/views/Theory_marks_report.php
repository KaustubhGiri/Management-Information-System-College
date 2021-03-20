
<?php
define('DOC_ID', $id);
$doc_title="<b>Theory Marksheet</b>";
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
$year1=$year+1;
if($semester_no==1 || $semester_no==3 || $semester_no==5)
				$sem='<label>Test Exam : ODD-'.$year.$year1.'</label>';
			else
				$sem='<label>Test Exam : EVEN-'.$year.$year1.'</label>';
$course='';
foreach ($course_code_name as $key => $value) {
			
			$course='<label>Course Code & Title :  <b>'.$value->course_code.'-'.$value->course_name.'</b></label>';
}
foreach ($dept_scheme as $key => $value) {
	if($shift=="FS")
		$student_shift="FIRST SHIFT";
	else
		$student_shift="SECOND SHIFT";
	$dept='<label>Programme : <b>'.$value->scheme_year.'-DIPLOMA IN '.strtoupper($value->dept_name).' ('.$student_shift.')</b></label>';
}
//$type="<b>Theory Marksheet</b>";
$max_marks='<label> Max Marks : 70</label>';
	
$newline="";
$table = '<table>';
$table .='<tr>
			<th style="border:1px solid black" align="center" ><b>ENROLLMENT NO</b><br></th>
			<th style="border:1px solid black" align="center" ><b>MARKS</b><br></th>
			
		</tr>';
		$count_detain_student=0;
		foreach($theory_marks as $value){
			if($value->semester_result_studentabsent == '1'){
				$table .= '<tr>
				<td style ="border:1px solid black">  '.$value->student_enrollmentno.'<br></td>
				<td style ="border:1px solid black" align="center">ABSENT<br></td>
			    </tr>';

				}
			elseif($value->semester_result_studentabsent == '2') {
				$table .= '<tr>
							<td style ="border:1px solid black">  '.$value->student_enrollmentno.'<br></td>
							<td style ="border:1px solid black" align="center">DETAIN<br></td>
						   </tr>';
						   $count_detain_student++;
					}
			elseif($value->semester_result_pass == '0') {
				$table .= '<tr>
							<td style ="border:1px solid black">  '.$value->student_enrollmentno.'<br></td>
							<td style ="border:1px solid black" align="center">'.$value->semester_result_marks_th.' (FAIL)<br></td>
						   </tr>';
			}
			else{
				$table .= '<tr>
							<td style ="border:1px solid black">  '.$value->student_enrollmentno.'<br></td>
							<td style ="border:1px solid black" align="center">'.$value->semester_result_marks_th.'<br></td>
						   </tr>';
			}
					

				
		}
$table .='</table>';
$pdf->writeHTMLCell(0,0,'','',$newline,0,1,0,true,'L',true);
$pdf->writeHTMLCell(0,0,'','',$dept,0,1,0,true,'L',true);
$pdf->writeHTMLCell(0,0,'','',$newline,0,1,0,true,'L',true);
$pdf->writeHTMLCell(0,0,'','',$course,0,1,0,true,'L',true);
$pdf->writeHTMLCell(0,0,'','',$newline,0,1,0,true,'L',true);
$pdf->writeHTMLCell(0,0,'','',$sem,0,1,0,true,'R',true);
$pdf->writeHTMLCell(0,0,'','',$max_marks,0,1,0,true,'R',true);
$pdf->writeHTML($newline, true, false, true, false, '');
$pdf->writeHTML($table, true, false, true, false, '');
//$pdf->writeHTMLCell(0, 0, '', '', $table, 'LRTB', 1, 0, true, 'L', true);
foreach ($No_Examiness_theory as  $value)
	$total_students = '<br><br><label>No.of Examinees <u>: '.$value->total.'</u></label>';
$pdf->writeHTMLCell(0,0,'','',$total_students,0,1,0,true,'L',true);
foreach ($absent_theory as $key => $value) 
	$absent_student = '<br><br><label>Absent : <u>'.$value->total.'</u></label>';
$pdf->writeHTMLCell(0,0,'','',$absent_student,0,1,0,true,'L',true);
	$detain='<br><br><label>Detain Students : <u>'.$count_detain_student.'</u></label>';
$pdf->writeHTMLCell(0,0,'','',$detain,0,1,0,true,'L',true);			
foreach($No_Examiness_theory as $key => $data)
	$all_sum= $data->total;
foreach($absent_theory as $key => $data)
	$ab_sum= $data->total;
if($all_sum>$ab_sum){
		$v = $all_sum-$ab_sum-$count_detain_student;
		$total_present = '<br><br><label>Total Present Students <u>: '.$v.'</u></label>';
	}else if($all_sum < $ab_sum){
		$v1 =$ab_sum-$all_sum-$count_detain_student;
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