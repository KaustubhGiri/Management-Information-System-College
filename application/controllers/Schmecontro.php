<?php
class Schmecontro extends CI_Controller{
    public function index(){
        $this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='add_scheme'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);
        $this->load->model('Schemem');
        
        $User_dept = $this->session->userdata('dept');
        $data['dept'] = $this->Schemem->show($User_dept);
        $data['message'] = "";
        $data['title'] = "Scheme";
        $data ['validclass'] = "";

        if(isset($_POST['submit']) && isset($_POST['sc_year']) && isset($_POST['sc_credit']) && isset($_POST['dept_id'])){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('sc_year','Scheme Year','required');
            $this->form_validation->set_rules('sc_credit','Scheme Credits','required');
            $this->form_validation->set_rules('dept_id','Department id','required');
            if($this->form_validation->run() !=true ){
                $data['message'] = validation_errors();
                $data ['validclass'] = "valid danger";
                return;
            }else{
                $this->load->helper(array('form'));
                $arr = array(
                    'scheme_year'=> $this->input->post('sc_year'),
                    'scheme_credit'=> $this->input->post('sc_credit'),
                    'scheme_dept_id'=> $this->input->post('dept_id')
                );
                if($this->Schemem->isDuplicate($arr)){
                    $data['message'] = "Recoard already exists";
                    $data ['validclass'] = "valid warning";
                }else{
                    $arr1 = array(
                    'scheme_id'=>"",
                    'scheme_year'=> $this->input->post('sc_year'),
                    'scheme_credit'=> $this->input->post('sc_credit'),
                    'scheme_dept_id'=> $this->input->post('dept_id')
                    );
                    $this->db->insert('scheme',$arr1);
                    $data['message'] = "Record Updated";
                    $data ['validclass'] = "valid success";
                }
            }

        }
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Scheme', $data);
        $this->load->view('/templets/Footer', $data);
    }
}
?>        