<?php

class MYPDF extends TCPDF {
    //Page header
    public function Header() {
    	$this->Cell(15);
        $this->Image('logo.png',33,0,20);
        $this->SetFont('times','',12);
        $this->WriteHTMLCell(0,0,'15','19',"Government Polytechnic Mumbai",0,1,0,true,'L',true);

        $date=date_default_timezone_set('Asia/Kolkata');
        $this->SetFont('','',11);
       	$this->WriteHTMLCell(0,0,'10','10',"Date ".date(" d/m/Y"),0,1,0,true,'R',true);
       	$this->WriteHTMLCell(0,0,'13','15',"Time  ".date(" g:i a"),0,1,0,true,'R',true);
       	$this->writeHTML("<br><hr><br>", true, false, false, false, '');
       	
    }
    public function Footer(){
     	$this->SetY(-18);
     	$this->writeHTML("<hr>", true, false, false, false, '');
    	$this->SetFont('times','',11);
    	$this->WriteHTMLCell(0,0,'','280',"Auto generated through Management Information System for GPM , Document belong to GPM college.",0,1,0,true,'L',true);
    	$this->WriteHTMLCell(0,0,'','285',"Address : 49,Kherwadi, Aliyawar Jung Marg,Bandra (East), Mumbai-51 , 26474587,26474780",0,1,0,true,'L',true);
    	$this->WriteHTMLCell(0,0,'','290',"Website : http://www.gpmumbai.ac.in/   Email : principal@gpmumbai.ac.in",0,1,0,true,'L',true);
    	$this->SetFont('times','',10);
    	$this->WriteHTMLCell(0,0,'','290','Page'.$this->PageNo(),0,1,0,true,'R',true);
   
    }
}

?>