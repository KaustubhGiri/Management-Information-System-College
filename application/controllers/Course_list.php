<?php 
class Course_list extends CI_Controller{
	public function index(){
    $this->load->model('SessionModel');
    $this->SessionModel->logoutusr();
    $this->SessionModel->not_Session();
    $token='course_wise_registration_list'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
    $this->SessionModel->check_authority($token);
    
    $this->load->library('pdf_lib');
    $this->load->helper('form');
    $this->load->model('Course_reg_model');
    $this->load->model('Pdf_model');

    $data ['message'] = "";
    $data ['validclass'] = "";
    $data ['title'] = "Course wise registration list";

    $User_dept = $this->session->userdata('dept');
    $user_id = $this->session->userdata('id');
    
    $data['Course_code']=$this->Course_reg_model->fetch_course_code($User_dept);
        
      if(isset($_POST['submit'])){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('course_code','Course Code','required');
        $this->form_validation->set_rules('course_shift','Course Shift','required');
        if($this->form_validation->run() !=true ){
            $data ['message'] = validation_errors();
            $data ['validclass'] = "valid danger";
        }else{
          $course_code=$this->input->post('course_code');
         	$shift_course=$this->input->post('course_shift');	
          $data['id']=$this->Pdf_model->pdf_id($User_dept,$user_id);
          $data['doc_title'] = "Course wise registration list";
          $data['course_reg_list']=$this->Course_reg_model->get_course_info($course_code,$shift_course,$User_dept);
          $data['course_reg_list_details']=$this->Course_reg_model->course_name($course_code,$shift_course,$User_dept);
          $form=array();
            $form['report_id']= "";
            $form['report_key']= $data['id'];
            $form['report_gen_date ']= date("Y-m-d H:i:s");
            $form['report_generator']=$user_id;
             $form['report_hash']= "";
          $this->db->insert('reports',$form);
          $data ['message'] = "Report Generated";
          $data ['validclass'] = "valid success";
          $this->load->view('Course_list',$data);
		    }
      }
      $this->load->view('/templets/Header', $data);
      $this->load->view('/templets/Sider', $data);
      $this->load->view('/templets/Validation',$data);
      $this->load->view('Course_reg_list',$data);
      $this->load->view('/templets/Footer', $data);
      
	}
	
}