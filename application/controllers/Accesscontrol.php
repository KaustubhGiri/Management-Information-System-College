<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accesscontrol extends CI_Controller{
    public function index(){
    	$this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='accesscontrol_management'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);
        $this->load->model('Accesscontrol_model');
        
        $data ['message'] = "";
        $data ['validclass'] = "";
        $data ['title'] = "Access Controller";

        if(isset($_POST['submit']) && isset($_POST['level_number'])){
            $arr = array(
                'admission_cancel'=> $this->input->post('cancel_student_admission'),
                'course_management'=> $this->input->post('course_management'),
                'course_registration'=> $this->input->post('course_registration'),
                'add_department'=> $this->input->post('department_management'),
                'exam_registration'=> $this->input->post('exam_registration'),
                'add_scheme'=> $this->input->post('add_scheme'),
                'add_semester'=> $this->input->post('add_semester'),
                'add_user'=> $this->input->post('add_faculty'),
                'admit_student'=> $this->input->post('student_admission'),
                'accesscontrol_management'=> $this->input->post('access_control'),
                'add_messageoftheday'=> $this->input->post('add_message_of_the_day'),
                'add_notice'=> $this->input->post('add_notice'),
                'attendance'=> $this->input->post('add_attendance'),
                'unit_test_marks_entry'=> $this->input->post('ut_marks_entry'),
                'attendance_sheet_generation'=> $this->input->post('gen_attendance_sheet'),
                'course_wise_registration_list'=> $this->input->post('c_stud_reg_list'),
                'teachers_list'=> $this->input->post('teachers_list'),
                'student_admission_list'=> $this->input->post('stud_adm_list')
            );
            $level = $this->input->post('level_number');
            $this->Accesscontrol_model->update_level($level, $arr);
            $data ['message'] = "Level Updated";
            $data ['validclass'] = "valid success";
        }

        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Accesscontrol', $data);
        $this->load->view('/templets/Footer', $data);
       
    }

    function fetch_access()
    {
        $this->load->database();
        $access= $this->input->post('access');
        $result = $this->db->query("SELECT * FROM `accesscontrol` WHERE access_level=$access")->result();
        echo json_encode($result);

    }
}