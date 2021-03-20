<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Department extends CI_Controller{
    public function index(){
    	$this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='add_department'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE 
        $this->SessionModel->check_authority($token);
        $this->load->model('Deptmodel');

        $User_dept = $this->session->userdata('dept');
        $data ['message'] = "";
        $data ['validclass'] = "";
        $data ['title'] = "Department";
        
        if(isset($_POST['submit']) && isset($_POST['dept_name']) && isset($_POST['dept_intial']) && isset($_POST['dept_shifts']) && isset($_POST['dept_intake'])){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('dept_name','Department name','required');
            $this->form_validation->set_rules('dept_intial','Department intial','required');
            $this->form_validation->set_rules('dept_shifts','Department shifts','required');
            $this->form_validation->set_rules('dept_intake','Department intake','required');

            if($this->form_validation->run() !=true ){
                echo validation_errors();
                return;
            }else{
            $arr = array(
                        'dept_name'=> $this->input->post('dept_name'),
                        'dept_initial'=> $this->input->post('dept_intial'),
                        'dept_shift'=>$this->input->post('dept_shifts'),
                        'dept_intake'=>$this->input->post('dept_intake')
                    );
        		if($this->Deptmodel->isDuplicate($arr)){
                    $data['message'] = "Such Department Already Exists";
                    $data ['validclass'] = "valid warning";
                }
                else
                {
                	$arr1 = array(
                		'dept_id'=>'',
                        'dept_name'=> $this->input->post('dept_name'),
                        'dept_initial'=> $this->input->post('dept_intial'),
                        'dept_shift'=>$this->input->post('dept_shifts'),
                        'dept_intake'=>$this->input->post('dept_intake')
                    );
                    
                    $this->db->insert('dept', $arr1);
                    $data['message'] = "Department Added";
                    $data ['validclass'] = "valid success";
    		}
    	}
}
        
        if(isset($_POST['tableRow'])){
            $tableRow = $this->input->post('tableRow');
            foreach($tableRow as $row){
                if(isset($row['del_button']) && isset($row['dept_id']))
                {
                        
                        $this->Deptmodel->deleteRecord($row['dept_id']);
                        $data['message'] = "Department Deleted";
                        $data ['validclass'] = "valid success";
                }
            }
        }
        $data['fetch'] = $this->Deptmodel->fetch_data();
        $data['shift'] = $this->Deptmodel->fetch_shift($User_dept);

        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Deptview',$data);
        $this->load->view('/templets/Footer', $data);
       
}
}

?>