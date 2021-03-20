<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller{
    public function index(){
    	$this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $this->load->model('Home_model');
        
        $data ['message'] = "";
        $data ['validclass'] = "";
        $data ['Home'] = "";
        $data ['title'] = "Home";
        $data ['genderwise_students'] = $this->Home_model->get_students_genter($this->session->userdata('dept'));
        $data ['students_pass_fail'] = $this->Home_model->get_students_result($this->session->userdata('dept'), date('Y'));
        $data ['castwise_students'] = $this->Home_model->get_students_casts($this->session->userdata('dept'), date('Y'));
        //$data ['genderwise_students'] = $this->Home_model->get_students_genter($this->session->userdata('dept'));
        $data ['attandance_students'] = $this->Home_model->get_monthly_attandance($this->session->userdata('dept'), date('Y'));
        $data ['genderwise_employee'] = $this->Home_model->get_employee_gender($this->session->userdata('dept'));
        $data ['deptwise_employee'] = $this->Home_model->get_employee_dept();

        // Message of the day
        $msg_student = $this->Home_model->get_mesg(date('Y'), idate('m'), idate('d'));
        $data ['message_oftheday'] = '';
        foreach($msg_student as $key => $msg)
            $data ['message_oftheday'] .= " &#x25C6; " . $msg->msg_details;
        // Notice section
        $data ['notice_general'] = $this->Home_model->get_notice('G', date("Y-m-d"));
        $data ['notice_employee'] = $this->Home_model->get_notice('E', date("Y-m-d"));
        $data ['notice_student'] = $this->Home_model->get_notice('S', date("Y-m-d"));
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('Home', $data);
        $this->load->view('/templets/Footer', $data);
       
    }
}
?>