<?php

class COURSE extends CI_Controller{
	public function index(){
		$this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='course_registration'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE 
        $this->SessionModel->check_authority($token);
        
		$this->load->library('session');
        $data['message'] = '';
        $data ['validclass'] = "";
        $data['title'] = 'Course Registration';
        $faculty_dept=$this->session->dept;
		$this->load->model('Course_Main');
		$data['course_code_name']=$this->Course_Main->fetch_course_code_course_name($faculty_dept);
		$data['reg_date']=$this->Course_Main->fetch_course_reg_date($faculty_dept);
		if(isset($_POST['tableRow'])){
            $tableRow = $this->input->post('tableRow');
            //print_r($tableRow);

            foreach($tableRow as $row){
            	//print_r($row['course_reg_course_id']);
                if(isset($row['del_button']) && isset($row['course_reg_id']))
                {
                        $this->Course_Main->deleteRecord($row['course_reg_id']);
                        $data['message'] = "Record Deleted ";
                        $data ['validclass'] = "valid success";
                }
            }
        }
		$this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
		$this->load->view('Course_main',$data);
		$this->load->view('/templets/Footer', $data);
	}
	function fetch(){
        $dept = $this->session->userdata('dept');
        $output = '';
        $query=$this->input->post('query');
        $this->load->database();
        $result=$this->db->query("SELECT student_enrollmentno,course_id,course_code,course_name,course_reg_date,course_reg_course_id,course_reg_id FROM students,course,course_reg WHERE students.student_dept_id='$dept' AND course.course_id=course_reg.course_reg_course_id AND students.student_id=course_reg_student_id ORDER BY `course`.`course_id` ASC")->result();
        if($query != ''){
            $query.="%";
            $result=$this->db->query("SELECT student_enrollmentno,course_id,course_code,course_name,course_reg_date,course_reg_course_id FROM students,course,course_reg WHERE students.student_dept_id='$dept' AND course.course_id=course_reg.course_reg_course_id AND course.course_code LIKE '$query' AND students.student_id=course_reg_student_id ORDER BY `course`.`course_id` ASC")->result();
        }
        echo json_encode($result);
    }

    function fetch1(){
        $dept = $this->session->userdata('dept');
        $output = '';
        $query=$this->input->post('query');
        $this->load->database();
        $result=$this->db->query("SELECT student_enrollmentno,course_id,course_code,course_name,course_reg_date,course_reg_course_id FROM students,course,course_reg WHERE students.student_dept_id='$dept' AND course.course_id=course_reg.course_reg_course_id AND students.student_id=course_reg_student_id ORDER BY `course`.`course_id` ASC")->result();
        if($query != ''){
  	        $query.="%";
            $result=$this->db->query("SELECT student_enrollmentno,course_id,course_code,course_name,course_reg_date,course_reg_course_id FROM students,course,course_reg WHERE students.student_dept_id='$dept' AND course.course_id=course_reg.course_reg_course_id AND course.course_name LIKE '$query' AND students.student_id=course_reg_student_id ORDER BY `course`.`course_id` ASC")->result();
        }
        echo json_encode($result);
    }
    function fetch2(){
        $dept = $this->session->userdata('dept');
        $output = '';
        $query=$this->input->post('query');
        $this->load->database();
        $result=$this->db->query("SELECT student_enrollmentno,course_id,course_code,course_name,course_reg_date,course_reg_course_id FROM students,course,course_reg WHERE students.student_dept_id='$dept' AND course.course_id=course_reg.course_reg_course_id AND students.student_id=course_reg_student_id ORDER BY `course`.`course_id` ASC")->result();
        if($query != ''){
  	        $query.="%";
            $result=$this->db->query("SELECT student_enrollmentno,course_id,course_code,course_name,course_reg_date,course_reg_course_id FROM students,course,course_reg WHERE students.student_dept_id='$dept' AND course.course_id=course_reg.course_reg_course_id AND students.student_id=course_reg_student_id AND students.student_enrollmentno LIKE '$query' ORDER BY `course`.`course_id` ASC")->result();
        }
        echo json_encode($result);	
    }
    function fetch3(){
        $dept = $this->session->userdata('dept');
        $output = '';
        $query=$this->input->post('query');
        $this->load->database();
        $result=$this->db->query("SELECT student_enrollmentno,course_id,course_code,course_name,course_reg_date,course_reg_course_id FROM students,course,course_reg WHERE students.student_dept_id='$dept' AND course.course_id=course_reg.course_reg_course_id AND students.student_id=course_reg_student_id ORDER BY `course`.`course_id` ASC")->result();
        if($query != ''){
            $query.="%";
            $result=$this->db->query("SELECT student_enrollmentno,course_id,course_code,course_name,course_reg_date,course_reg_course_id FROM students,course,course_reg WHERE students.student_dept_id='$dept' AND course.course_id=course_reg.course_reg_course_id AND students.student_id=course_reg_student_id AND course_reg.course_reg_date LIKE '$query' ORDER BY `course`.`course_id` ASC")->result();
        }
        echo json_encode($result);
    }
}
?>