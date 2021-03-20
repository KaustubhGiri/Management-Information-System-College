<?php
class Password extends CI_Controller{
    public function index(){
        $this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $data['message'] = "";
        $data ['validclass'] = "";
        if($this->session->userdata('login')== 1){
            $data ['title'] = "Change Password";
            if(isset($_POST['changepass']) && isset($_POST['newpassword']) && isset($_POST['confirmnewpassword']) && $_POST['newpassword'] == $_POST['confirmnewpassword']){
                $this->load->model('Password_model');
                $this->load->helper(array('form'));
                $username = $this->session->userdata('username');
                $result=$this->Password_model->get_regdate($username);
                    foreach($result as $key => $value)
                        $reg_date = $value->faculty_reg_date;
                $salt5 = $reg_date;
                $salt6 = $username;
                $pw_temp = $this->input->post('confirmnewpassword');
                $this->Password_model->update_password(hash('sha1', "$salt5$pw_temp$salt6"), $username);
                $data['message'] = "Password changed.";
                $data ['validclass'] = "valid success";
            }
            $this->load->view('/templets/Header', $data);
            $this->load->view('/templets/Sider', $data);
            $this->load->view('/templets/Validation',$data);
            $this->load->view('Changepass', $data);
            $this->load->view('/templets/Footer', $data);
        }else{
            $data ['title'] = "Reset Password";
            if(isset($_POST['forgot']) && isset($_POST['admin_username']) && isset($_POST['admin_password']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmnewpassword']) && $_POST['confirmnewpassword'] == $_POST['password']){
                $this->load->model('Password_model');
                $this->load->model('Faculty_login');
                $this->load->helper(array('form'));

                $data['faculty'] = $this->Faculty_login->login($this->input->post('admin_username'));
                $faculty_pass = '';
                foreach ($data['faculty'] as $row){
                    $faculty_pass =  $row['faculty_pass'];
                    $faculty_type = $row['faculty_type'];
                    $access_level = $row['access_level'];
                    $faculty_reg_date = $row['faculty_reg_date'];
                }
                $salt1 = $faculty_reg_date;
                $salt2 = $this->input->post('admin_username');
                $pw_temp = $this->input->post('admin_password');
                if(hash('sha1', "$salt1$pw_temp$salt2") == $faculty_pass && $faculty_type == 'a' && $access_level == '1'){ //Checks IF ADMIN
                    $result=$this->Password_model->get_regdate($this->input->post('username'));
                    $reg_date = '';
                    foreach($result as $key => $value)
                        $reg_date = $value->faculty_reg_date;
                    $salt3 = $reg_date;
                    $salt4 = $this->input->post('username');
                    $new_pass = $this->input->post('password');
                    if($this->Password_model->update_password(hash('sha1', "$salt3$new_pass$salt4"), $this->input->post('username')) == '1'){
                        $data['message'] = "Password changed.";
                        $data ['validclass'] = "valid success";
                    }else{
                       $data['message'] = "Oops! Something Went Wrong.";
                       $data ['validclass'] = "valid info";
                    }
                }else{
                    $data['message'] = "Admin Authintication failed";
                    $data ['validclass'] = "valid warning";
                }
            }
            $this->load->view('/templets/Header', $data);
            $this->load->view('/templets/Validation',$data);
            $this->load->view('Forgotpassword', $data);
            $this->load->view('/templets/Footer', $data);
        }
    }
}