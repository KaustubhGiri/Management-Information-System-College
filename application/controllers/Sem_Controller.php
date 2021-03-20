<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sem_Controller extends CI_Controller{
    public function index(){
        $this->load->model('SessionModel');
		$this->SessionModel->logoutusr();
		$this->SessionModel->not_Session();
		$token='semester_internalmarks_entry'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
	    $this->SessionModel->check_authority($token);
        
        $this->load->model('Sem_Model');
        $this->load->model('Student_model');

        $user_id=$this->session->id;
        $User_dept=$this->session->dept;

        $data['title'] = 'Semester Marks Entry';
		$data['message'] = '';
		$data['validclass'] = "";
 
    	if(isset($_POST['submit']) && isset($_POST['course']) && isset($_POST['scheme']) && isset($_POST['shift']) && isset($_POST['semester']) && isset($_POST['select_type']) && isset($_POST['course'])){            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('semester','Semester ','required');
            $this->form_validation->set_rules('course','Course','required');
            $this->form_validation->set_rules('select_type','Marks Type','required');
            
            if($this->form_validation->run()!=true){
                $data['message'] =  validation_errors();
                $data ['validclass'] = "valid danger";
                return;
            }else{

                $data['get_student']=$this->Sem_Model->get_students($User_dept,$this->input->post('shift'), $this->input->post('semester'), $this->input->post('course'));
                $data['sem_id']= $this->Sem_Model->get_sem_id($this->input->post('semester'), $this->input->post('scheme'), $this->input->post('course'));
                $data['scheme_id']=$this->input->post('scheme');
                $data['course_id']=$this->input->post('course');
                $data['marks_id']=$this->input->post('select_type');
                $data['check_course']=$this->Sem_Model->get_course_data($this->input->post('course'));
            }
        }
        if(isset($_POST['submit_marks']) && isset($_POST['tableRow'])){
            $tableRow = $this->input->post('tableRow');
            foreach($tableRow as $row){
                if($row['marks'] == '401'){ // check if student is absent
                                $absent = '1';
                                $marks = '0';
                                $pass_fail='1';
                                $this->Sem_Model->set_fail($row['student_id'], $this->input->post('course_id_get'), $this->input->post('select_type'));
                                $this->Sem_Model->change_course_exam_status_fail($this->input->post('course_id_get'), $row['student_id']);
                            }elseif($row['marks'] == '402'){ // check is student is detained
                                $absent = '2';
                                $marks = '0';
                                $pass_fail='1';
                                $this->Sem_Model->set_detain($row['student_id'], $this->input->post('course_id_get'));

                            }else{ // if none of above then checks if student is pass
                                if($this->input->post('select_type') == '2'){
                                    $result = $this->Sem_Model->is_pass_pr($row['marks'], $this->input->post('course_id_get')); // returns 1 if pass 0 if fail
                                }elseif($this->input->post('select_type') == '3'){
                                    $result = $this->Sem_Model->is_pass_or($row['marks'], $this->input->post('course_id_get')); // returns 1 if pass 0 if fail
                                }elseif($this->input->post('select_type') == '1'){
                                    $result = $this->Sem_Model->is_pass_tw($row['marks'], $this->input->post('course_id_get')); // returns 1 if pass 0 if fail
                                }
                                if($this->input->post('select_type') != '5'){
                                    foreach($result as $key => $value)
                                        $status = $value->pass;
                                }
                                if($this->input->post('select_type') == '5')
                                    $status = TRUE;
                                if($status){ // Check is student is pass
                                    $absent = '0';
                                    $marks=$row['marks'];
                                    $pass_fail='0';
                                    $this->Sem_Model->set_pass($row['student_id'], $this->input->post('course_id_get'), $this->input->post('select_type'));
                                    $this->Sem_Model->change_course_exam_status_pass($this->input->post('course_id_get'), $row['student_id']);
                                }else{ // if student is not passed
                                    $this->Sem_Model->set_fail($row['student_id'], $this->input->post('course_id_get'), $this->input->post('select_type'));
                                    $this->Sem_Model->change_course_exam_status_fail($this->input->post('course_id_get'), $row['student_id']);
                                    $absent = '0';
                                    $marks=$row['marks'];
                                    $pass_fail='1';
                                }
                            }
                $arr = array(
                    'sem_internal_semister_id'=> $this->input->post('sem_id_get'),
                    'sem_internal_course_id'=> $this->input->post('course_id_get'),
                    'sem_internal_student_id'=>$row['student_id'],
                    'marks_type'=>$this->input->post('marks_type_id_get'),
                    'sem_internal_student_absent'=>$absent,
                   	'sem_internal_marks'=>$marks,
                    'sem_internal_marks_fail'=>$pass_fail
                    );
                if($this->Sem_Model->isDuplicate($arr)){
                    $data['message'] = "Record already exists";
                    $data ['validclass'] = "valid warning";
                }else{
                     $arr = array(
                    'sem_internal_id'=>"",
                    'sem_internal_semister_id'=> $this->input->post('sem_id_get'),
                    'sem_internal_course_id'=> $this->input->post('course_id_get'),
                    'sem_internal_student_id'=>$row['student_id'],
                    'marks_type'=>$this->input->post('marks_type_id_get'),
                    'sem_internal_student_absent'=>$absent,
                   	'sem_internal_marks'=>$marks,
                    'sem_internal_marks_fail'=>$pass_fail
                    );

                    $this->db->insert('sem_internal_marks', $arr);
                    $data['message'] = "Marks Added";
                    $data ['validclass'] = "valid success";
                }
            }
        }
        $data ['scheme'] = $this->Student_model->get_scheme($User_dept);

        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('sem_view',$data);
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
        $faculty_id=$this->session->userdata('id');
        $this->load->database();
        $sem_num = $this->input->post('sem_num');
        $result = $this->db->query("SELECT DISTINCT course.course_id, course.course_code, course.course_name FROM course 
                                    INNER JOIN semester ON semester.semester_course_id = course.course_id 
                                    INNER JOIN scheme ON scheme.scheme_id = semester.semester_scheme_id 
                                    INNER JOIN facultytocourse ON facultytocourse.facultytocourse_course_id = course.course_id 
                                    WHERE semester.semester_number = '$sem_num' AND scheme.scheme_dept_id ='$department' AND facultytocourse.facultytocourse_faculty_id = '$faculty_id'")->result();
        echo json_encode($result);
    }
    function fetch_course_internals(){   
        $department=$this->session->userdata('dept');
        $this->load->database();
        $course_id = $this->input->post('course_id');
        $result = $this->db->query("SELECT COUNT(case WHEN course.course_pr != '0,0' THEN 1 END) AS course_pr,
                                            COUNT(case WHEN course.course_or != '0,0' THEN 1 END) AS course_or,
                                            COUNT(case WHEN course.course_tw != '0,0' THEN 1 END) AS course_tw
                                    FROM course WHERE course.course_id = '$course_id'")->result();
        echo json_encode($result);
    }
    function get_dept_shift(){
        $faculty_id=$this->session->userdata('id');
        $course_id = $this->input->post('course_id');
        echo json_encode($this->db->query("SELECT COUNT(CASE WHEN facultytocourse.facultytocourse_shift = 'FS' THEN 1 END) AS fs, COUNT(CASE WHEN facultytocourse.facultytocourse_shift = 'SS' THEN 1 END) AS ss
        FROM facultytocourse WHERE facultytocourse.facultytocourse_faculty_id = '$faculty_id' AND facultytocourse.facultytocourse_course_id = '$course_id'")->result());
    }
    function get_type(){
        $faculty_id=$this->session->userdata('id');
        $course_id = $this->input->post('course_id');
        $shift = $this->input->post('shift');
        echo json_encode($this->db->query("SELECT COUNT(CASE WHEN facultytocourse.facultytocourses_type = 'TH' THEN TRUE END) AS th, COUNT(CASE WHEN facultytocourse.facultytocourses_type = 'PR' THEN TRUE END) AS pr, COUNT(CASE WHEN facultytocourse.facultytocourses_type = 'TR' THEN TRUE END) AS tu , COUNT(CASE WHEN facultytocourse.facultytocourses_type = 'TW' THEN TRUE END) AS tw,
                        COUNT(CASE WHEN facultytocourse.facultytocourses_type = 'OR' THEN TRUE END) AS 'or'
        FROM facultytocourse 
        WHERE facultytocourse.facultytocourse_faculty_id ='$faculty_id' AND facultytocourse.facultytocourse_shift = '$shift' AND facultytocourse.facultytocourse_course_id = '$course_id'")->result());
    }
}