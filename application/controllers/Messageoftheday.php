<?php
class Messageoftheday extends CI_Controller{
    public function index(){
        $this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='add_messageoftheday'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);
        
        $data['message'] = "";
        $data ['validclass'] = "";
        $data ['title'] = "Message Of The Day";
        if(isset($_POST['submit']) && isset($_POST['mesg']) && isset($_POST['status'])){
            $this->load->helper(array('form'));
            $arr = array(
                'msg_of_day_id'=>"",
                'msg_details'=> $this->input->post('mesg'),
                'created_at'=> date("Y-m-d H:i:s"),
                'created_by'=> $this->session->userdata('id'),  // gets the dpeartment here
                'is_active'=> $this->input->post('status')
            );
                $this->db->insert('msg_of_day',$arr);
                $data['message'] = "Message Added";
                $data ['validclass'] = "valid success";
        }
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Message_of_theday', $data);
        $this->load->view('/templets/Footer', $data);
    }
}