<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Signup extends CI_Controller{
    public function index(){
        $this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='add_user'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);
        $this->load->model('Faculty_signup');
        $this->load->library('session');

        $User_dept = $this->session->userdata('dept');
        $data ['title'] = "Signup";
        $data ['message'] = "";
        $data ['validclass'] = "";
        
        if(isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['f_gender']) && isset($_POST['phno']) && isset($_POST['f_type'])  && $_POST['psw'] == $_POST['psw-repeat']){
            $this->load->helper(array('form'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required'); 
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('psw', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('psw-repeat', 'Password', 'required|min_length[6]|matches[psw]');
            if($this->form_validation->run() !=true ){
                $data['message'] = validation_errors();
                $data ['validclass'] = "valid danger";
                return;
            }else{
                if($this->Faculty_signup->isDuplicate($this->input->post('email'), $this->input->post('phno'))){
                    $data['message'] = "Faculty already exists";
                    $data ['validclass'] = "valid warning";
                }else{
                    $salt1 = date("Y-m-d H:i:s");
                    $salt2 = $this->input->post('email');
                    $pw_temp = $this->input->post('psw');
                    $hash=hash('sha1', "$salt1$pw_temp$salt2");
                    $arr = array(
                        'faculty_id' => "",
                        'faculty_phno' => $this->input->post('phno'),
                        'faculty_gender' => $this->input->post('f_gender'),
                        'faculty_name' => $this->input->post('name'),
                        'faculty_employee_id' => $this->input->post('f_no'),
                        'faculty_reg_date' => date("Y-m-d H:i:s"),
                        'faculty_DOJ' => $this->input->post('f_doj'),
                        'faculty_email' => $this->input->post('email'),
                        'faculty_type' => $this->input->post('f_type'),
                        'faculty_dept_id' => $this->input->post('f_dept'),
                        'access_level' => $this->input->post('f_level'),
                        'faculty_pass' => $hash
                    );
                    $this->db->insert('faculty', $arr);
                    $data ['message'] = "Faculty added successfully!";
                    $data ['validclass'] = "valid success";
                }
                
            }
        }
        $data ['dept'] = $this->Faculty_signup->get_dept($User_dept);        

        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Signup', $data);
        $this->load->view('/templets/Footer', $data);
    }
}