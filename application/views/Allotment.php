
<?php
define('DOC_ID', $id);
define('DOC_TITLE', $doc_title);
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('GPM');
$pdf->SetTitle('facultytocourse');
$pdf->SetSubject('IF');
$pdf->SetKeywords('IF,MIS');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

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

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$t=date('d/m/y');
$th="Theory";
$pr="pr";
  $body = '<body>';
foreach($d as $row){
    $body.='<p>Department : '.strtoupper($row->dept_name).'</p>';
} 
    $body.='<table style="border: 1px solid black">
              <tr>
                <th style="border: 1px solid black"><b>COURSE NAME</b><br></th>
                <th style="border: 1px solid black">COURSE CODE<br></th>
                <th style="border: 1px solid black"><b>FACULTY NAME</b><br></th>
                <th style="border: 1px solid black"><b>TYPE</b><br></th>
                <th style="border: 1px solid black"><b>SHIFT</b><br></th>
                <th style="border: 1px solid black">SCHEME YEAR<br></th>
              </tr>';
foreach($fetch as $query => $record){
    $body.='<tr>
                <td style="border: 1px solid black">'.$record->course_name.'<br></td>
                <td style="border: 1px solid black">'.$record->course_code.'<br></td>
                <td style="border: 1px solid black">'.$record->faculty_name.'<br></td>
                <td style="border: 1px solid black">'.$record->facultytocourses_type.'<br></td>
                <td style="border: 1px solid black">'.$record->facultytocourse_shift.'<br></td>
                <td style="border: 1px solid black">'.$record->scheme_year.'<br></td>
              </tr>';    
}
    $body.='</table>';
    $body.= '</body>';

$pdf->writeHTML($body, true, false, true, false, '');

//$pdf->writeHTMLCell(0, 0, '', '', $body, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_clean();
$pdf->Output('facultytocourse.pdf', 'I');

//============================================================+
// END OF FILE