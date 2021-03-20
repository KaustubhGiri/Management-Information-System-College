<?php
class Notice extends CI_Controller{
    public function index(){
        $this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='add_notice'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);
        
        $data['message'] = "";
        $data ['validclass'] = "";
        $data ['title'] = "Notice";

        if(isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['user_type']) && isset($_POST['date']) && isset($_POST['status'])){
            $this->load->helper(array('form'));
            $arr = array(
                'notice_id'=>"",
                'notice_title'=> $this->input->post('title'),
                'notice_description'=> $this->input->post('description'),
                'notice_user_type'=> $this->input->post('user_type'),
                'notice_date'=> $this->input->post('date'),
                'created_at'=> date("Y-m-d H:i:s"),
                'created_by'=> $this->session->userdata('id'), // gets the dpeartment here
                'is_active'=> $this->input->post('status')
            );
                $this->db->insert('notice',$arr);
                $data['message'] = "Notice Added";
                $data ['validclass'] = "valid success";
        }
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Notice', $data);
        $this->load->view('/templets/Footer', $data);
    }
}