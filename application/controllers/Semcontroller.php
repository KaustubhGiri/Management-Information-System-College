<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Semcontroller extends CI_Controller {
	public function index(){
            $this->load->model('SessionModel');
            $this->SessionModel->logoutusr();
            $this->SessionModel->not_Session();
            $token='add_semester'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
            $this->SessionModel->check_authority($token);
            $this->load->model('Semmodel');
            
            $user_dept = $this->session->userdata('dept');
            $data['title'] = "Semester";
            $data['message'] = "";
            $data ['validclass'] = "";
            if(isset($_POST['tableRow'])){ 
                $tableRow = $this->input->post('tableRow');
                foreach($tableRow as $row){
                    if(isset($_POST['submit'])  && isset($row['semester_course_id'])){
                            $this->load->library('form_validation');
                            $this->form_validation->set_rules('semester_scheme_id','Scheme','required');
                            $this->form_validation->set_rules('semester_number','semester Number','required');
                        if($this->form_validation->run() !=true ){
                                $data['message'] = validation_errors();
                                $data ['validclass'] = "valid danger";
                                return;
                        }else{

                                $duplicate = array(
                                'semester_scheme_id'=> $this->input->post('semester_scheme_id'),
                                'semester_course_id'=> $row['semester_course_id'],
                                'semester_number'=> $this->input->post('semester_number')
                                );
                            if($this->Semmodel->isDuplicate($duplicate)){
                                $data['message'] = "Semester already exists";
                                $data ['validclass'] = "valid warning";
                            }else{
                                $arr = array(
                                'semester_id'=> "",
                                'semester_scheme_id'=> $this->input->post('semester_scheme_id'),
                                'semester_course_id'=> $row['semester_course_id'],
                                'semester_number'=> $this->input->post('semester_number')
                                );
                                $this->db->insert('semester', $arr);
                                $data['message'] = "semester Added";
                                $data ['validclass'] = "valid success";
                            }

                        }       
                }
        }       
    }
        $data ['course'] = $this->Semmodel->get_course();
        $data ['scheme'] = $this->Semmodel->get_scheme($user_dept);
        $data['fetch_course'] = $this->Semmodel->fetch_course();
        
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Semview', $data);
        $this->load->view('/templets/Footer', $data);
}


    function fetch_sc_id()
    {   
        $department=$this->session->userdata('dept');
        $this->load->database();
        $access = $this->input->post('s_id');
        $result = $this->db->query("SELECT * FROM scheme where scheme_dept_id=$department")->result();
        echo json_encode($result);

    }


function fetch_c_id()
    {   
        $access=$this->input->post('sc_id');
        $user_dept = $this->session->userdata('dept');
        $result=$this->db->query("SELECT * FROM course INNER JOIN scheme ON scheme.scheme_id = course.course_scheme_id WHERE scheme.scheme_dept_id = '$user_dept' AND course_scheme_id= '$access'")->result();
        echo json_encode($result);
    } 
}
?>