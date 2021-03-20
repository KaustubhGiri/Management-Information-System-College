<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
    public function index(){
        $this->load->model('SessionModel');
        $this->SessionModel->check_session();
        $this->SessionModel->logoutusr();
        $this->load->library('session');

        $data['message'] = "";
        $data ['validclass'] = "";
        $data ['title'] = "Login";
        
        if(isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])){
            $this->load->model('Faculty_login');
            $data['faculty'] = $this->Faculty_login->login($this->input->post('username'));
            $faculty_reg_date = '';
            $faculty_pass = '';
            foreach ($data['faculty'] as $row){
                $faculty_name = $row['faculty_name'];
                $faculty_id = $row['faculty_id'];
                $faculty_pass =  $row['faculty_pass'];
                $faculty_number = $row['faculty_employee_id'];
                $faculty_phno = $row['faculty_phno'];
                $faculty_type = $row['faculty_type'];
                $faculty_dept_id = $row['faculty_dept_id'];
                $access_level = $row['access_level'];
                $faculty_reg_date = $row['faculty_reg_date'];
            }
            $salt1 = $faculty_reg_date;
            $salt2 = $this->input->post('username');
            $pw_temp = $this->input->post('password');
            if($pw_temp == $faculty_pass){

                $newdata = array( 
                    'name' => $faculty_name, 
                    'username' => $this->input->post('username'), 
                    'password' =>  $faculty_pass,
                    'login' => TRUE,
                    'id' => $faculty_id,
                    'phone_no' => $faculty_phno,
                    'type' => $faculty_type,
                    'dept' => $faculty_dept_id,
                    'accesslevel' => $access_level,
                    'reg_date' => $faculty_reg_date
                );
                $this->session->set_userdata($newdata);
                $this->SessionModel->check_session();
            }else{
                $data['message'] = "Authintication failed.Wrong username or password";
                $data ['validclass'] = "valid warning";
            }
        }
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view("Login", $data);
        $this->load->view('/templets/Footer', $data);
    }
}   