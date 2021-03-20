<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Teacher extends CI_Controller{
    public function index(){
        $this->load->library('session');
		$this->load->model('SessionModel');
		$this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='teachers_list'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);

    	$this->load->model('Teacher_model');
        $data ['title'] = "Teachers";
        $data ['message'] = "";
        $data ['validclass'] = "";

        $User_dept = $this->session->userdata('dept');
        $data['tname'] = $this->Teacher_model->get_teacher_name($User_dept);

        if(isset($_POST['tableRow'])){
            $tableRow = $this->input->post('tableRow');
            foreach($tableRow as $row){
                if(isset($row['del_button'])){
                        if($this->Teacher_model->deletefaculty($row['faculty_id'])){
                            $data['message'] = "faculty Deleted ";
                            $data ['validclass'] = "valid success";
                        }
                }
            }
        }
        
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Teacher_view', $data);
        $this->load->view('/templets/Footer', $data);
        
    }
}
?>