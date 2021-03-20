<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Facultytocourse extends CI_Controller{
    public function index(){
        $this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='faculty_course_allotment'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE 
        $this->SessionModel->check_authority($token);
        
        $this->load->model('Pdf_model');
        $this->load->model('Student_model');
        $this->load->model('Facultytocourse_model');

        $data['message']='';
        $data ['validclass'] = "";
        $data ['title'] = "Faculty Course Allotment";

        $dept_id=$this->session->userdata('dept');
        $user_id=$this->session->userdata('id');
        
        if(isset($_POST['submit']) && isset($_POST['semester']) && isset($_POST['scheme']) && isset($_POST['course']) && isset($_POST['teacher']) && isset($_POST['type']) && isset($_POST['shift'])){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('semester','semester','required');
            $this->form_validation->set_rules('course','course','required');
            $this->form_validation->set_rules('teacher','teacher','required');
            $this->form_validation->set_rules('type','type','required');

            if($this->form_validation->run() !=true ){
                $data['message']=validation_errors();
                $data ['validclass'] = "valid danger";
                return;
            }else{
                $arr1 = array(
                            'facultytocourse_semester'=> $this->Facultytocourse_model->get_sem_id($this->input->post('semester'), $this->input->post('scheme'), $this->input->post('course')),
                            'facultytocourse_faculty_id'=>$this->input->post('teacher') ,
                            'facultytocourse_course_id'=>$this->input->post('course'),
                            'facultytocourses_type'=>$this->input->post('type'),
                            'facultytocourse_shift'=>$this->input->post('shift'));

                if($this->Facultytocourse_model->isDuplicate($arr1)){
                    $data['message'] = "faculty already alloted";
                    $data ['validclass'] = "valid warning";
                }else{
                     $arr1 = array(
                            'facultytocourse_id'=>"",
                            'facultytocourse_semester'=> $this->Facultytocourse_model->get_sem_id($this->input->post('semester'), $this->input->post('scheme'), $this->input->post('course')),
                            'facultytocourse_faculty_id'=>$this->input->post('teacher') ,
                            'facultytocourse_course_id'=>$this->input->post('course'),
                            'facultytocourses_type'=>$this->input->post('type'),
                            'facultytocourse_shift'=>$this->input->post('shift'));
                    $this->db->insert('facultytocourse', $arr1);
                    $data['message'] = "Faculty Alloted";
                    $data ['validclass'] = "valid success";
                }
    		}
    	
        }
        
        if(isset($_POST['tableRow'])){
            $tableRow = $this->input->post('tableRow');
            foreach($tableRow as $row){
                if(isset($row['del_button']) && isset($row['facultytocourse_id'])){
                    $this->Facultytocourse_model->deleteRecord($row['facultytocourse_id']);
                    $data['message'] = "Record Deleted.";
                    $data ['validclass'] = "valid success";
                }
            }
        }
        if(isset($_POST['gen_pdf'])){
            $this->load->library('Pdf_lib'); 
            $data['id']=$this->Pdf_model->pdf_id($dept_id,$user_id);
            $data['doc_title'] = "FACULTY TO COURSE ALLOTMENT LIST";
            $data['d']=$this->Facultytocourse_model->get_dept_name($dept_id);
            
            $form=array();
                $form['report_id']= "";
                $form['report_key']= $this->Pdf_model->pdf_id($dept_id,$user_id);
                $form['report_gen_date ']= date('Y-m-s');
                $form['report_generator']=$user_id;
                $form['report_hash']= "";
            $this->db->insert('reports',$form);
            $data['fetch']=$this->Facultytocourse_model->fetch_data($dept_id);
            $this->load->view('allotment',$data);
            $data['message'] = 'Report Generated';
            $data ['validclass'] = "valid info";
        }
        $data['sem']=$this->Facultytocourse_model->get_sem();
        $data['course']=$this->Facultytocourse_model->get_course($dept_id);
        $data['faculty']=$this->Facultytocourse_model->get_teacher($dept_id);
        $data['fetch']=$this->Facultytocourse_model->fetch_data($dept_id);
        $data ['scheme'] = $this->Student_model->get_scheme($dept_id);
        $data ['shift'] = $this->Student_model->get_dept_shift($dept_id);
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Facultytocourse_view',$data);
        $this->load->view('/templets/Footer', $data);
    }
//--------------------------------------------AJAX Functions---------------------------------------
    function fetch_semester(){   
        $department=$this->session->userdata('dept');
        $this->load->database();
        $schene_id = $this->input->post('schene_id');
        $result = $this->db->query("SELECT DISTINCT semester_number FROM semester
                                    INNER JOIN scheme ON scheme.scheme_id = semester.semester_scheme_id
                                    WHERE scheme.scheme_dept_id = '$department' AND scheme.scheme_id ='$schene_id'")->result();
        echo json_encode($result);
    }
    function fetch_course(){   
        $department=$this->session->userdata('dept');
        $this->load->database();
        $sem_num = $this->input->post('sem_num');
        $result = $this->db->query("SELECT course.course_id, course.course_code, course.course_name FROM course 
                                    INNER JOIN semester ON semester.semester_course_id = course.course_id 
                                    INNER JOIN scheme ON scheme.scheme_id = semester.semester_scheme_id 
                                    WHERE semester.semester_number = '$sem_num' AND scheme.scheme_dept_id ='$department'")->result();
        echo json_encode($result);
    }
    function fetch_course_internals(){   
        $department=$this->session->userdata('dept');
        $this->load->database();
        $course_id = $this->input->post('course_id');
        $result = $this->db->query("SELECT COUNT(case WHEN course.course_pr != '0,0' THEN 1 END) AS course_pr,
        COUNT(case WHEN course.course_th != '0,0' THEN 1 END) AS course_th,
        COUNT(case WHEN course.course_tw != '0,0' THEN 1 END) AS course_tw,
        COUNT(case WHEN course.course_tutorials != '0' THEN 1 END) AS course_tu,
        COUNT(case WHEN course.course_or != '0,0' THEN 1 END) AS course_or
        FROM course WHERE course.course_id = '$course_id'")->result();
        echo json_encode($result);
    } 
}