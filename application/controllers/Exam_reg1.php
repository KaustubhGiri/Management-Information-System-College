<?php
class Exam_reg1 extends CI_Controller{
	public function index(){			
			$this->load->model('SessionModel');
		    $this->SessionModel->logoutusr();
			$this->SessionModel->not_Session();
			$token='exam_registration'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
		    $this->SessionModel->check_authority($token);
			
			$this->load->library('pdf_lib');
		    $this->load->model('Pdf_model');
			$this->load->model("Exam_reg_model");
		    $user_id=$this->session->id;
		    $User_dept=$this->session->dept;
			$data['message']="";
			$data ['validclass'] = "";
			$data['title']="Exam Registration";
			
			if(isset($_POST['tableRow'])){
				$tableRow = $this->input->post('tableRow');
				$count=0;
				$exam_reg_data = array();
					foreach ($tableRow as $row){
									if(isset($_POST['submit'])  && isset($row['course_register'])){
											$this->load->library('form_validation');
											$this->form_validation->set_rules('student_enrollment','required');
											if($this->form_validation->run() ==true){
												$data['message'] = validation_errors();
												$data ['validclass'] = "valid danger";
												return;
											}else{
												 $duplicate = array(
                                    			'exam_reg_course_reg_id'=>$row['course_register'],
			                                    'exam_reg_student_id'=>$row['register'],
												'exam_reg_type'=>$row['status_type'],
												'exam_reg_type_status'=> NULL
			                               		 );
				                                if($this->Exam_reg_model->isDuplicate($duplicate)){
													$data['message'] = "Record already exists";
													$data ['validclass'] = "valid warning";
				                                }else{
											   		$arr = array(
													'exam_reg_id'=> "",
													'exam_reg_course_reg_id'=>$row['course_register'],
													'exam_reg_student_id'=>$row['register'],
													'exam_reg_type'=>$row['status_type']
													);
													$this->db->insert('exam_reg', $arr);
													$arr1=array(
														'course_reg_examstatus' => "1"
													);
													$this->db->where('course_reg_id', $row['course_register']);  
													$this->db->update('course_reg', $arr1);
													$exam_reg_data[$count]['course_reg_info']=$this->Exam_reg_model->fetch_exam_data($this->input->post('student_enrollment'),$row['course_register'],$User_dept, $row['status_type']);
													$data['message'] = "Registered";
													$data ['validclass'] = "valid success";
												}

											}
										$count++;
									}
					}
				$data['reg_data'] = $exam_reg_data;
				$data['id']=$this->Pdf_model->pdf_id($User_dept,$user_id);
                $data['doc_title'] = "Exam Registration Slip";	
				$data['enroll']=$this->Exam_reg_model->pdf_course($this->input->post('student_enrollment'),$User_dept);
				$form=array();
					$form['report_id']= "";
					$form['report_key']= $data['id'];
					$form['report_gen_date ']= date("Y-m-d H:i:s");
					$form['report_generator']=$user_id;
					$form['report_hash']= "";
                $this->db->insert('reports',$form);
                $data['name']=$this->Exam_reg_model->fetch_enroll_name($this->input->post('student_enrollment'),$User_dept);//for pritning name of student
                $data['dept']=$this->Exam_reg_model->fetch_dept($User_dept);//for printing dept 
        		$this->load->view('Exam_reg_slip',$data);     
                
		}  
		$this->load->view('/templets/Header',$data);
    	$this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
     	$this->load->view('Exam_reg_view1',$data);
    	$this->load->view('/templets/Footer', $data);
	}
	function fetch_table(){
		$this->load->database();
		$enrollment_num = $this->input->post('enrollmentno');
		$semester_num = $this->input->post('semester_num');
		$result = $this->db->query("SELECT course_reg.course_reg_id, course_reg.course_reg_examstatus, course.course_name, course.course_code, students.student_id, 
		COUNT(case WHEN course.course_pr != '0,0' THEN TRUE END) AS course_pr,
		COUNT(case WHEN course.course_or != '0,0' THEN TRUE END) AS course_or,
		COUNT(case WHEN course.course_tw != '0,0' THEN TRUE END) AS course_tw,
		COUNT(case WHEN course.course_th != '0,0' THEN TRUE END) AS course_th
		FROM students 
		INNER JOIN course_reg on course_reg.course_reg_student_id = students.student_id
		INNER JOIN course ON course.course_id = course_reg.course_reg_course_id 
		INNER JOIN semester ON semester.semester_course_id = course.course_id
		INNER JOIN scheme ON scheme.scheme_id = semester.semester_scheme_id AND scheme.scheme_id =students.student_scheme_id
		WHERE course_reg.course_reg_examstatus = 0 AND students.student_enrollmentno = '$enrollment_num' AND semester.semester_number = '$semester_num' GROUP BY course.course_id")->result();
		echo json_encode($result);
	}
	function fetch_backlog_table(){
		$this->load->database();
		$enrollment_num = $this->input->post('enrollmentno');
		$semester_num = $this->input->post('semester_num');
		$result = $this->db->query("SELECT course_reg.course_reg_id, course_reg.course_reg_examstatus, course.course_name, course.course_code, students.student_id, exam_reg.exam_reg_type_status,
									COUNT(case WHEN course.course_pr != '0,0' THEN TRUE END) AS course_pr,
									COUNT(case WHEN course.course_or != '0,0' THEN TRUE END) AS course_or,
									COUNT(case WHEN course.course_tw != '0,0' THEN TRUE END) AS course_tw,
									COUNT(case WHEN course.course_th != '0,0' THEN TRUE END) AS course_th
									FROM students 
									INNER JOIN course_reg on course_reg.course_reg_student_id = students.student_id
									INNER JOIN course ON course.course_id = course_reg.course_reg_course_id 
									INNER JOIN exam_reg ON exam_reg.exam_reg_course_reg_id = course_reg.course_reg_id
									INNER JOIN semester ON semester.semester_course_id = course.course_id
									INNER JOIN scheme ON scheme.scheme_id = semester.semester_scheme_id AND students.student_scheme_id = scheme.scheme_id 
									WHERE course_reg.course_reg_examstatus != '1' AND course_reg.course_reg_examstatus != '2' AND course_reg.course_reg_examstatus != '4' AND course_reg.course_reg_examstatus != '1'
									AND exam_reg.exam_reg_type_status != 9  AND exam_reg.exam_reg_type_status IS NOT NULL
									AND students.student_enrollmentno = '$enrollment_num'")->result();
		echo json_encode($result);
	}
	
}
?>