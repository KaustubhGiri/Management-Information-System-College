<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Info extends CI_Controller {
 public function index(){

    $this->load->library('session');
    $this->load->model('SessionModel');
    $this->SessionModel->logoutusr();
    $this->SessionModel->not_Session();
    $token='student_admission_list'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
    $this->SessionModel->check_authority($token);

        $data['message'] = '';
        $data ['validclass'] = "";
        $data['title'] = 'Year wise Student Enrollment';
        $this->load->model('Student_model');
        $this->load->model('Pdf_model');
        $User_dept = $this->session->userdata('dept');
        $user_id = $this->session->userdata('id');
        $data['dept'] = $this->Student_model->get_dept($User_dept);

        if(isset($_POST['sub']) && isset($_POST['student_dept_id']) && isset($_POST['year']))
        {               
                $this->load->library('form_validation');
                $this->form_validation->set_rules('year','Please enter year','required');
                if($this->form_validation->run() !=true ){
                    $data['message'] = validation_errors();
                    $data ['validclass'] = "valid danger";
                    return;
                }else{
                        $this->load->library('pdf_lib');
                        $data['id']=$this->Pdf_model->pdf_id($User_dept,$user_id);
                        $data['doc_title'] = "Yearwise Departmental Student Admission List";
                        $data['d']=$this->Student_model->fetch_get_name($this->input->post("student_dept_id"));
                        if($result = $this->Student_model->get_info($this->input->post("student_dept_id"),$this->input->post("year"))){
                            $data['info'] = $result;
                            $form=array();
                            $form['report_id']= "";
                            $form['report_key']= $data['id'];
                            $form['report_gen_date ']= date("Y-m-d H:i:s");
                            $form['report_generator']=$user_id;
                            $form['report_hash']= "";
                            $this->db->insert('reports',$form);
                            $this->load->view('Student_info',$data);
                        }else
                            $data['message'] = 'No Data found';
                            $data ['validclass'] = "valid warning";
                }
        }
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Info_view',$data);
        $this->load->view('/templets/Footer', $data);
    }             
}