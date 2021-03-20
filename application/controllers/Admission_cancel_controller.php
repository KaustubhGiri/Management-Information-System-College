<?php
class Admission_cancel_controller extends CI_Controller{
	public function index()
	{
		$this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
		$this->SessionModel->not_Session();
		$token='admission_cancel'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
		$this->SessionModel->check_authority($token);
		$this->load->model('Admission_cancel_model');
		
		$data ['title'] = "Cancel Admission";
		$data['message']="";
		$data ['validclass'] = "";
		$data['do'] = 0;
		$data['rollno']="";
		
		if(isset($_POST['submit'])){			
				if($this->Admission_cancel_model->checkRollno($this->input->post("cancel_roll_no"))){
					
					$data['do'] = $this->Admission_cancel_model->checkRollno($this->input->post("cancel_roll_no"));

					$data['student_data'] = $this->Admission_cancel_model->get_student_data($this->input->post("cancel_roll_no"));

					$alldata = $this->Admission_cancel_model->get_student_data($this->input->post("cancel_roll_no"));

					$data['rollno'] = $this->input->post("cancel_roll_no");
					
					foreach ($alldata as $key => $value) {
						
						$data['dept'] = $this->Admission_cancel_model->get_dept_name($value->student_dept_id);
						
						$data['scheme'] = $this->Admission_cancel_model->get_scheme_name($value->student_scheme_id);

						$data['caste'] = $value->student_caste_category_id;
					}

				}else{
					$data ['validclass'] = "valid warning";
					$data['message'] = "Enrollment Number is not present.";
				}
		}

		if(isset($_POST['cancel']))
		{
			if($this->Admission_cancel_model->cancelAdmission($this->input->post("cancel_roll_no")))
			{
				$data ['validclass'] = "valid success";
				$data['message'] = "Enrollment Number ".$this->input->post('cancel_roll_no')." admission cancelled successfully.";	
			}
		}
		$this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
		$this->load->view("Admission_cancel_view",$data);
		$this->load->view('/templets/Footer', $data);
	}
}