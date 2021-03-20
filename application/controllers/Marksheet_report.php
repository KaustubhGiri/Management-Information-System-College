<?php 
class Marksheet_report extends Ci_Controller{
	public function index(){
		$this->load->model('SessionModel');
		$this->SessionModel->logoutusr();
		$this->SessionModel->not_Session();
		$token='marksheet_report'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
	    $this->SessionModel->check_authority($token);

        $User_dept = $this->session->userdata('dept');
        $user_id = $this->session->userdata('id');

	    $this->load->model('Sem_Model');
        $this->load->model('Student_model');
        $this->load->model('Marksheet_report_model');
        $this->load->library('pdf_lib');
    	$this->load->model('Pdf_model');

        $data['message']='';
        $data['course']=$this->Sem_Model->get_course($User_dept);
        $data['scheme']=$this->Sem_Model->get_scheme($User_dept);
        $data ['shift'] = $this->Student_model->get_dept_shift($User_dept);
        $data ['scheme'] = $this->Student_model->get_scheme($User_dept);
        if(isset($_POST['submit']) && isset($_POST['course']) && isset($_POST['scheme']) && isset($_POST['shift']) && isset($_POST['semester']) && isset($_POST['select_type']) && isset($_POST['course'])){            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('scheme','scheme','required');
            $this->form_validation->set_rules('semester','Semester ','required');
            $this->form_validation->set_rules('course','Course','required');
            $this->form_validation->set_rules('select_type','Marks Type','required');
            $this->form_validation->set_rules('shift','Shift','required');
            
            if($this->form_validation->run()!=true){
                $data['message'] =  validation_errors();
                $data ['validclass'] = "valid danger";
                return;
            }
            $data['id']=$this->Pdf_model->pdf_id($User_dept,$user_id);
            $form=array();
                $form['report_id']= "";
                $form['report_key']= $data['id'];
                $form['report_gen_date ']= date("Y-m-d H:i:s");
                $form['report_generator']=$user_id;
                $form['report_hash']= "";
             	$this->db->insert('reports',$form);
                $data['dept_scheme']=$this->Marksheet_report_model->fetch_dept($User_dept,$this->input->post('scheme'));
                $data['course_code_name']=$this->Marksheet_report_model->fetch_course_info($this->input->post('course'));
                $data['semester_no']=$this->input->post('semester');
                $data['marks_type']=$this->input->post('select_type');
                $data['shift']=$this->input->post('shift');
            if($this->input->post('select_type')=='4'){
            	$data['theory_marks']=$this->Marksheet_report_model->fetch_TheorY_marks($this->input->post('scheme'),$this->input->post('semester'),$this->input->post('course'),$User_dept,$this->input->post('shift'));
                $data['No_Examiness_theory']=$this->Marksheet_report_model->get_all_theory($this->input->post('scheme'),$this->input->post('semester'),$this->input->post('course'),$User_dept,$this->input->post('shift'));
                $data['absent_theory']=$this->Marksheet_report_model->get_absent_theory($this->input->post('scheme'),$this->input->post('semester'),$this->input->post('course'),$User_dept,$this->input->post('shift'));
                
                $this->load->view('Theory_marks_report',$data);
            }
            elseif($this->input->post('select_type')!==''){
            	$data['internal_marks']=$this->Marksheet_report_model->fetch_internal_marks($this->input->post('select_type'),$this->input->post('scheme'),$this->input->post('semester'),$this->input->post('course'),$User_dept,$this->input->post('shift'));
                $data['No_Examiness_internal']=$this->Marksheet_report_model->get_all_internal($this->input->post('select_type'),$this->input->post('scheme'),$this->input->post('semester'),$this->input->post('course'),$User_dept,$this->input->post('shift'));
                $data['absent_internal']=$this->Marksheet_report_model->get_absent_internal($this->input->post('select_type'),$this->input->post('scheme'),$this->input->post('semester'),$this->input->post('course'),$User_dept,$this->input->post('shift'));
                
            	$this->load->view('Internal_marks_report',$data);
            }
        }

        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Marksheet_report_view',$data);
        $this->load->view('/templets/Footer', $data);
    }
    //=========================================================AJAX Functions===============================
	function fetch_semester(){   
        $department=$this->session->userdata('dept');
       // $department='1';
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
    	//$department='1';
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
?>