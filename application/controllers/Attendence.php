<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Attendence extends CI_Controller{
	public function index()
	{
		$this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='attendance'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);
		
		$this->load->model('Deptmodel');
		
        $User_dept = $this->session->userdata('dept');
		$data['title'] = 'Attendance';
		$data['message'] = '';
		$data ['validclass'] = "";
		$id="0";
		$this->load->model('Attendence_Model');
		$this->load->model('Student_model');

		if(isset($_POST['submit']) && isset($_POST['year']) && isset($_POST['shift'])  && isset($_POST['course'])){
		$id = $this->input->post('course');
		$data['get_course_id']=$id;
		$data['get']= $this->Attendence_Model->get_data($User_dept,$this->input->post('year'),$this->input->post('shift'));
		}

		if(isset($_POST['submit_attendence'])){
			 $tableRow = $this->input->post('tableRow');
            foreach($tableRow as $row){
                $arr = array(
                	'attendance_student_id'=>$row['student_id'],
                	'attendance_subject_id'=>$this->input->post('course_id_get'),
                	'attendance_date'=>$this->input->post('date'),
                	'attendance_dept_id'=>$User_dept,
                	'attendance_is_practical'=>$this->input->post('practicle_course'),
                	'attendance_teacher_id'=>$this->input->post('faculty'),
                	'attendance_time_from'=>$this->input->post('time_from'),
                	'attendance_time_to'=>$this->input->post('time_to'),
                	'attendence_is_present'=>$row['attendence']
                ); 
                if($this->Attendence_Model->isDuplicate($arr)){
				$data['message'] = "Attendance already exists";
				$data ['validclass'] = "valid warning";
                }else{
                	  $arr1 = array(
                	'attendance_id'=>'',
                	'attendance_student_id'=>$row['student_id'],
                	'attendance_subject_id'=>$this->input->post('course_id_get'),
                	'attendance_date'=>$this->input->post('date'),
                	'attendance_dept_id'=>$User_dept,
                	'attendance_is_practical'=>$this->input->post('practicle_course'),
                	'attendance_teacher_id'=>$this->input->post('faculty'),
                	'attendance_time_from'=>$this->input->post('time_from'),
                	'attendance_time_to'=>$this->input->post('time_to'),
                	'attendence_is_present'=>$row['attendence']
                );
                $this->db->insert('attendance', $arr1);
				$data['message'] = "Attendance Added";
				$data ['validclass'] = "valid success";
            }
		}
    }
		$data['faculty_get']=$this->Attendence_Model->get_faculty($User_dept);
		$data['course']=$this->Attendence_Model->get_course($User_dept);
		$data['shift']=$this->Attendence_Model->get_dept_shift($User_dept);

		$this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
		$this->load->view('Attendence',$data);
		$this->load->view('/templets/Footer', $data);

	}

}
?>