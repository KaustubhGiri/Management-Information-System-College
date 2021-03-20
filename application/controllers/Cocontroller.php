<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cocontroller extends CI_Controller
{
    public function index(){
        $this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='course_management'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);
        $this->load->database();
        $this->load->model('Coursemodel');

        $User_dept = $this->session->userdata('dept');
        $data['title'] = "course";
        $data ['message'] = "";
        $data ['validclass'] = "";
        $data ['course'] = "";
        $data['scheme']=$this->Coursemodel->get_scheme($User_dept);
        
        if(isset($_POST['submit'])){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('course_code','course code','required');
            $this->form_validation->set_rules('course_name','course name','required');
            $this->form_validation->set_rules('course_lectures','course lectures','required');
            $this->form_validation->set_rules('course_practicals','course practicals','required');
            $this->form_validation->set_rules('course_tutorials','course tutorials','required');
            $this->form_validation->set_rules('course_total_teaching_hrs','course teaching hrs','required');
            $this->form_validation->set_rules('cource_credit','course credit','required');
            $this->form_validation->set_rules('course_level','course level','required');
            $this->form_validation->set_rules('course_scheme_id','course scheme id','required');
            $this->form_validation->set_rules('course_total_marks','course total marks','required');
        
            if($this->form_validation->run() !=true ){
                $data ['message'] = validation_errors();
                $data ['validclass'] = "valid danger";
                return;
            }else{
                  
                $this->load->helper(array('form'));

                $duplicate = array(
                'course_code'=> $this->input->post('course_code'),
                'course_name'=> $this->input->post('course_name'),
                'course_lectures'=> $this->input->post('course_lectures'),
                'course_practicals'=> $this->input->post('course_practicals'),
                'course_tutorials'=> $this->input->post('course_tutorials'),
                'course_total_teaching_hrs'=> $this->input->post('course_total_teaching_hrs'),
                'cource_credit'=> $this->input->post('cource_credit'), 
                'course_level'=> $this->input->post('course_level'), 
                'course_scheme_id'=> $this->input->post('course_scheme_id'),
                'course_total_marks'=> $this->input->post('course_total_marks')
                );

        if($this->Coursemodel->isDuplicate($duplicate)){
                $data['message'] = "Recoard alread exists";
                $data ['validclass'] = "valid warning";
                }else{
                //implode code    
                $th=array($this->input->post('th_Minimum'),$this->input->post('th_Maximum'));
                $course_th=implode(",",$th);
                $ts=array($this->input->post('ts_Minimum'),$this->input->post('ts_Maximum'));
                $course_ts=implode(",",$ts);
                $pr=array($this->input->post('pr_Minimum'),$this->input->post('pr_Maximum'));
                $course_pr=implode(",",$pr);
                $or=array($this->input->post('or_Minimum'),$this->input->post('or_Maximum'));
                $course_or=implode(",",$or);
                $tw=array($this->input->post('tw_Minimum'),$this->input->post('tw_Maximum'));
                $course_tw=implode(",",$tw);
                // implode code ends
                 $arr = array(
                'course_id'=>"",
                'course_code'=> $this->input->post('course_code'),
                'course_name'=> $this->input->post('course_name'),
                'course_lectures'=> $this->input->post('course_lectures'),
                'course_practicals'=> $this->input->post('course_practicals'),
                'course_tutorials'=> $this->input->post('course_tutorials'),
                'course_total_teaching_hrs'=> $this->input->post('course_total_teaching_hrs'),
                'course_th'=>$course_th,
                'course_ts'=>$course_ts,
                'course_pr'=>$course_pr,
                'course_or'=>$course_or,
                'course_tw'=>$course_tw,
                'cource_credit'=> $this->input->post('cource_credit'), 
                'course_level'=> $this->input->post('course_level'), 
                'course_scheme_id'=> $this->input->post('course_scheme_id'),
                'course_total_marks'=> $this->input->post('course_total_marks'),
                );
            
                $this->db->insert('course', $arr);
                $data['message'] ="Record Added";
                $data ['validclass'] = "valid success";
            }
        }
    }
    $this->load->view('/templets/Header', $data);
    $this->load->view('/templets/Sider', $data);
    $this->load->view('/templets/Validation',$data);
    $this->load->view('Courseview',$data);
    $this->load->view('/templets/Footer', $data);       
    }
}
?>