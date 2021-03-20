<?php 
class Exam_reg_list extends CI_Controller{
      public function index(){
            $this->load->model('SessionModel');
            $this->SessionModel->logoutusr();
            $this->SessionModel->not_Session();
            $token='exam_registration'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
            $this->SessionModel->check_authority($token);

            $this->load->library('pdf_lib');
            $this->load->helper('form');
            $this->load->model('Exam_reg_list_model');
            $this->load->model('Pdf_model');
      
            $data['message']='';
            $data ['validclass'] = "";
            $data['title'] = "Exam Registration";
      
            $user_id=$this->session->id;
            $User_dept=$this->session->dept;
            $data['Course_code']=$this->Exam_reg_list_model->fetch_course_code($User_dept);
            if(isset($_POST['submit']) && isset($_POST['course_code']) && isset($_POST['course_shift'])){
                  $this->load->library('form_validation');
                              $this->form_validation->set_rules('course_code','Course Code','required');
                              $this->form_validation->set_rules('course_shift','Course Shift','required');
                        if($this->form_validation->run() !=true ){
                        $data['message'] = validation_errors();
                        $data ['validclass'] = "valid danger";
                        }else{
                              $course_code=$this->input->post('course_code');
                              $shift_course=$this->input->post('course_shift');	
                              $data['id']=$this->Pdf_model->pdf_id($User_dept,$user_id);
                              $data['doc_title'] = "Exam Registration List";
                              $data['exam_reg_list']=$this->Exam_reg_list_model->get_course_info($course_code,$shift_course,$User_dept);
                              $data['exam_reg_list_details']=$this->Exam_reg_list_model->course_name($course_code,$shift_course,$User_dept);
                              $form=array();
                                    $form['report_id']= "";
                                    $form['report_key']= $data['id'];
                                    $form['report_gen_date ']= date("Y-m-d H:i:s");
                                    $form['report_generator']=$user_id;
                                    $form['report_hash']= "";
                              $this->db->insert('reports',$form);
                              $this->load->view('Exam_reg_list',$data);
                              $data['message']='Report Generated';
                              $data ['validclass'] = "valid info";
                        }
            }
            $this->load->view('/templets/Header', $data);
            $this->load->view('/templets/Sider', $data);
            $this->load->view('/templets/Validation',$data);
            $this->load->view('Exam_reg_list_input',$data);
            $this->load->view('/templets/Footer', $data);
	}
}