<?php 
class Unit_Report extends Ci_Controller{
	public function index(){

		$this->load->library('session');
		$this->load->model('SessionModel');

        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();

        $token='unit_test_report'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);

        $this->load->model('Accesscontrol_model');
        $this->load->library('pdf_lib');
    	$this->load->model('Pdf_model');
        $User_dept = $this->session->userdata('dept');
		$user_id = $this->session->userdata('id');

        $this->load->model('Unit_Report_model');
        $absent="ABSENT";
        $data['message']='';
        $data ['validclass'] = "";
        $data['title']='Unit Test Marks Report';

	    
    	if(isset($_POST['submit']) && isset($_POST['scheme_id']) && isset($_POST['semester_id']) && isset($_POST['course_id']) && isset($_POST['unit_id']) && isset($_POST['shift'])){

            $scheme_id = $this->input->post('scheme_id');
            $term_type = $this->input->post('semester_id');
            $course_id =$this->input->post('course_id');
            $ut_type = $this->input->post('unit_id');
            $data['shift_id'] = $this->input->post('shift');
    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('semester_id','semester_id ','required');
            $this->form_validation->set_rules('course_id','course_id ','required');
            $this->form_validation->set_rules('scheme_id','scheme_id ','required');
            $this->form_validation->set_rules('unit_id','unit_id','required');
            if($this->form_validation->run()!=true){
                $data['message']= validation_errors();
                $data ['validclass'] = "valid danger";
               return;
            }
            else{
            	/*CODE FOR FINDING UNIT TEST NAME*/

                if($ut_type=='1'){
                  $data['final']="First Unit Test";
                }else{
                  $data['final'] = "Second Unit Test";
                }
            	/*CODE OF UNIT TEST ENDS */

           		/*CODE FOR FINDING TERM NAME*/
           		$term_ty=$this->Unit_Report_model->sem_no($term_type);
                if($term_ty % 2 != 0)
                  $data['term']="ODD";
                else
                  $data['term'] = "EVEN";
          		/*CODE OF FINDING TERM NAME ENDS */
            	$data['pdf_data'] = $this->Unit_Report_model->get_pdf_data($term_type, $course_id,$ut_type,$User_dept,$scheme_id,$data['shift_id']);
	            $data['get_dept'] = $this->Unit_Report_model->get_dept($User_dept);
	           // $data['get_course'] = $this->Unit_Report_model->get_course1($course_id);
	            $data['get_count'] = $this->Unit_Report_model->get_all($data['shift_id'], $course_id, $ut_type);
	            $data['get_absent'] = $this->Unit_Report_model->get_absent($data['shift_id'], $course_id, $ut_type);
	            $data['dept_scheme']=$this->Unit_Report_model->fetch_dept($User_dept,$scheme_id);
                $data['course_code_name']=$this->Unit_Report_model->fetch_course_info($course_id);
                
	            $data['id']=$this->Pdf_model->pdf_id($User_dept,$user_id);
	            $data['doc_title'] = $data['final'].' Marksheet';
	            $data['get_data'] = $this->Unit_Report_model->get_data();
	            $data['get_sum'] =$this->Unit_Report_model->get_sum($User_dept,$course_id,$data['shift_id'], $ut_type);

	            $form=array();
	            $form['report_id']= "";
	            $form['report_key']= $data['id'];
	            $form['report_gen_date ']= date("Y-m-d H:i:s");
	            $form['report_generator']=$user_id;
	            $form['report_hash']= "";
	            $this->db->insert('reports',$form);
	            $this->load->view('Unit_Report',$data);
	        	}
    	}
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
    	$this->load->view('Unit_report_input',$data);
    	$this->load->view('/templets/Footer', $data);
	}
	  function fetch_sc_id(){
	  	
        $department=$this->session->userdata('dept');
        $this->load->database();
        $result = $this->db->query("select * from scheme where scheme_dept_id =$department ")->result();
        echo json_encode($result);
    }


    function fetch_course(){
        $this->load->database();
        $access1 = $this->input->post('sc_id');
        $result = $this->db->query("SELECT * FROM course where course_scheme_id = $access1;")->result();
        echo json_encode($result);
    }
    function fetch_semester(){
        $access=$this->input->post('sc_id');
        $access1=$this->input->post('c_id');
        $result=$this->db->query("SELECT semester_id, semester_number FROM semester WHERE semester_scheme_id='$access' and semester_course_id='$access1';")->result();
        echo json_encode($result);
    }

    function fetch_uttype(){
        $this->load->database();
        $access = $this->input->post('sc_id');
        $access1 = $this->input->post('c_id');
        $result = $this->db->query("SELECT * FROM course WHERE course_id=$access1 AND course_scheme_id=$access")->result();
        echo json_encode($result);
    }
    function fetch_std(){
        $this->load->database();
        $access = $this->input->post('shift_id');
        $access3 = $this->input->post('sc_id');
        $result = $this->db->query("SELECT student_id, student_enrollmentno from students where student_shift='$access' and student_scheme_id=$access3;")->result();
        echo json_encode($result);
    }
    function get_dept_shift(){
        $dept = $this->session->userdata('dept');
        echo json_encode($this->db->query("SELECT dept_shift FROM dept WHERE dept.dept_id = '$dept'")->result());
    }
}
?>