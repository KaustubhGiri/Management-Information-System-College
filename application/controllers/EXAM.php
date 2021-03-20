<?php
//error_reporting(0);
class EXAM extends CI_Controller
{
	public function index()
	{
		$this->load->model('SessionModel');
		$this->SessionModel->logoutusr();
		$this->SessionModel->not_Session();
		$token='exam_registration'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
		$this->SessionModel->check_authority($token); 
		
		$this->load->library('session');
		$this->load->model('Exam_main');
		
		$data['message']='';
		$data ['validclass'] = "";
		$data['title'] = 'Exam Registration';

		if(isset($_POST['tableRow']))
		{
			$tableRow=$this->input->post('tableRow');
			foreach ($tableRow as  $row){
				if( isset($row['exam_reg_id']) && isset($row['del_button']) )
				{
					$this->Exam_main->deleteRecord($row['exam_reg_id'],$row['course_reg_id']);
					$data['message']='Record deleted';
					$data ['validclass'] = "valid success";
				}
			}
		}
		
		$this->load->view('/templets/Header',$data);
		$this->load->view('/templets/Sider',$data);
		$this->load->view('Exam_main',$data);	
		$this->load->view('/templets/Footer',$data);
	}
	function fetch_coursecode()
	{
		$coursecode=$this->input->post('coursecode');
		$coursename=$this->input->post('coursename');
		$en_no=$this->input->post('en_no');
		$date_reg=$this->input->post('date_reg');
		$coursecode.="%";
		$coursename.="%";
		$en_no.="%";
		$date_reg.="%";
		$result=$this->db->query("SELECT exam_reg_id,exam_reg_course_reg_id,exam_reg_student_id,exam_reg_date,course_reg_id,course_name,student_enrollmentno,course_code from exam_reg,course_reg,course,students WHERE exam_reg.exam_reg_course_reg_id=course_reg.course_reg_id and course.course_id=course_reg.course_reg_course_id and students.student_id=course_reg.course_reg_student_id and course.course_name LIKE '$coursename' and course.course_code LIKE '$coursecode' and exam_reg.exam_reg_date LIKE '$date_reg' and students.student_enrollmentno LIKE '$en_no';")->result();
		echo json_encode($result);
	}
}
?>