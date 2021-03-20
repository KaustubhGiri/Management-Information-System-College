<?php
class ATTENDANCE_MAIN extends CI_Controller{
public function index(){
		$this->load->library('session');
		$this->load->model('SessionModel');
		$this->load->model('Pdf_model');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='attendance_sheet_generation'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);

        $User_dept = $this->session->userdata('dept');
        $user_id = $this->session->userdata('id');

        $data ['message'] = "";
        $data ['validclass'] = "";
        $data ['title'] = "Attendance Sheet";
        $this->load->helper('form');

        $this->load->library('pdf_lib');
        $this->load->model('Attendance');
        $this->load->model('Student_model');
		
        if(isset($_POST['submit']) && isset($_POST['scheme']) && isset($_POST['semester']) && isset($_POST['course_code']) && isset($_POST['Attendance_type']) && isset($_POST['faculty_name']) && isset($_POST['course_shift'])){
                echo "<br><br>";
                print_r($_POST);
                $this->load->library('form_validation');
                $this->form_validation->set_rules('faculty_name','Faculty_name','required');
                $this->form_validation->set_rules('course_code','Course_code','required');
                $this->form_validation->set_rules('course_shift','Course_shift','required');
                $this->form_validation->set_rules('Attendance_type','Attendance_Type','required');
            
        		    if($this->form_validation->run() !=true ){
                        $data ['message'] = validation_errors();
                        $data ['validclass'] = "valid danger";
                    }else{
                        $ccode=$this->Attendance->get_course_code($this->input->post('course_code'));
                        foreach($ccode as $key => $value)
                            $course_code = $value->course_code;
                        $shift_course=$this->input->post('course_shift');
                        $faculty_name=$this->input->post('faculty_name');
                        $data['id']=$this->Pdf_model->pdf_id($User_dept,$user_id);
                        $data['doc_title'] = $this->input->post('Attendance_type') . ' ATTENDANCE';
                        $data['Course_info']=$this->Attendance->course_info($course_code,$shift_course,$User_dept,$faculty_name);
                        $data['Student_info']=$this->Attendance->student_info($course_code,$shift_course,$User_dept);
                        $form=array();
                            $form['report_id']= "";
                            $form['report_key']= $data['id'];
                            $form['report_gen_date ']= date("Y-m-d H:i:s");
                            $form['report_generator']=$user_id;
                            $form['report_hash']= "";
                        $this->db->insert('reports',$form);
                        $data ['message'] = "Attendance Generated";
                        $data ['validclass'] = "valid success";
                        $this->load->view('Attendance_list',$data);
                    }
        }

        $data['Faculty_Name']=$this->Attendance->fetch_faculty_name($User_dept);
        $data['Course_code']=$this->Attendance->fetch_course_code($User_dept);
        $data ['shift'] = $this->Student_model->get_dept_shift($User_dept);
        $data ['scheme'] = $this->Student_model->get_scheme($User_dept);

        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Attendance_sheet',$data);
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
    COUNT(case WHEN course.course_th != '0,0' THEN 1 END) AS course_th
    FROM course WHERE course.course_id = '$course_id'")->result();
    echo json_encode($result);
} 
}
?>