<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student_Information extends CI_Controller{
    public function index(){
    	//$this->load->model('SessionModel');
        //$this->SessionModel->logoutusr();
       // $this->SessionModel->not_Session();
        //$token='students_report'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        //$this->SessionModel->check_authority($token);
        $this->load->library('pdf_lib');
        $this->load->model('Pdf_model');
        $User_dept='1';
        $user_id='31';
    	$this->load->model('Student_Information_Model');
    	$data ['message'] = " ";
    	    
    	if(isset($_POST['submit'])){
            $data['enroll']=$this->input->post("student_enrollmentno");
	    	$data['student_data']=$this->Student_Information_Model->get_student_data($this->input->post("student_enrollmentno"));
	    	$alldata = $this->Student_Information_Model->get_student_data($this->input->post("student_enrollmentno"));
			foreach ($alldata as $key => $value) {
		    	$data['dept'] = $this->Student_Information_Model->get_dept_name($value->student_dept_id);
				$data['scheme'] = $this->Student_Information_Model->get_scheme_name($value->student_scheme_id);
				$data['caste'] = $value->student_caste_category_id;
				$data['rollno'] = $this->input->post("student_enrollmentno");
	    	}
	    }
	    		$data['student_info'] = $this->Student_Information_Model->get_student_info($this->input->post("student_enrollmentno"));
	    		$data['sem']=$this->Student_Information_Model->get_semester();

    if(isset($_POST['pdf_button'])){
        $data['student_data']=$this->Student_Information_Model->get_student_data($this->input->post("pdf_enroll")); 
        $alldata = $this->Student_Information_Model->get_student_data($this->input->post("pdf_enroll"));
        $data['id']=$this->Pdf_model->pdf_id($User_dept,$user_id);
        $form=array();
                $form['report_id']= "";
                $form['report_key']= $data['id'];
                $form['report_gen_date ']= date("Y-m-d H:i:s");
                $form['report_generator']=$user_id;
                $form['report_hash']= "";
                $this->db->insert('reports',$form);
        foreach ($alldata as $key => $value) {
            $data['dept'] = $this->Student_Information_Model->get_dept_name($value->student_dept_id);
            $data['scheme'] = $this->Student_Information_Model->get_scheme_name($value->student_scheme_id);
            $data['caste'] = $value->student_caste_category_id;            
        }     
        $data['student_info'] = $this->Student_Information_Model->get_student_info($this->input->post("pdf_enroll"));
        $this->load->view('Student_Information_report',$data);
    }
                            //$this->load->view('/templets/Header', $data);
                            //$this->load->view('/templets/Sider', $data);
                            //$this->load->view('/templets/Validation',$data);
                            $this->load->view('Student_Information_View1',$data); 
                            //$this->load->view('/templets/Footer', $data);
        

	 }
}

?>