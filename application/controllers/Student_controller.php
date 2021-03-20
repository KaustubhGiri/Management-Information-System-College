<?php
class Student_controller extends CI_Controller{
 
    public function index(){
        $this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='admit_student'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);
        $this->load->helper('form');
        $this->load->model('Student_model');
        $this->load->model('Pdf_model');

        $user_dept_id = $this->session->userdata('dept');
        $user_id = $this->session->userdata('id');

        $data ['message'] = "";
        $data ['validclass'] = "";
        $data ['title'] = "Student Admission";
        $data ['dept'] = $this->Student_model->get_dept($user_dept_id);
        $data ['scheme'] = $this->Student_model->get_scheme($user_dept_id);
        $data ['shift'] = $this->Student_model->get_dept_shift($user_dept_id);
        $data ['Caste'] = $this->Student_model->get_caste();
        
        if(isset($_POST['submit']) && isset($_FILES["myimage"]) && $_FILES["myimage"]["error"] == 0 && $_FILES["myimage"]["size"] < 500000){//500000 Bytes == 5000 Kb
            $this->load->library('form_validation');
            $this->form_validation->set_rules('student_fname','student first name ','required');
            $this->form_validation->set_rules('student_mname','student middle name ','required');
            $this->form_validation->set_rules('student_lname','student last name ','required');
            $this->form_validation->set_rules('student_caste','student caste ','required');
            $this->form_validation->set_rules('student_address','student address ','required');
            $this->form_validation->set_rules('student_bdate','student bdate ','required');
            $this->form_validation->set_rules('student_phno','student phoneNo ','required');
            $this->form_validation->set_rules('student_email','student email ','required');
            $this->form_validation->set_rules('student_gender','student gender ','required');
            $this->form_validation->set_rules('student_shift','student shift ','required');
            $this->form_validation->set_rules('student_hostel','hostel ','required');
            $this->form_validation->set_rules('student_tfws','tfws ','required');
            $this->form_validation->set_rules('student_mothers_fname','mother first name ','required');
            $this->form_validation->set_rules('student_mothers_lname','mother last name ','required');
            $this->form_validation->set_rules('student_income','income ','required');
            //Add Image varification=======================================================================
            if($this->form_validation->run() !=true ){
                $data['message'] = validation_errors();
                $data ['validclass'] = "valid danger";
                return;
            }else{
                if($this->Student_model->isDuplicate($this->input->post('student_email'), $this->input->post('student_phno'), $this->input->post('student_dte_enrollment_no'))){
                    $data['message'] = "Student alread exists";
                    $data ['validclass'] = "valid warning";
                }else{
                    $form=array();
                    $form['student_fname']= $this->input->post("student_fname");
                    $form['student_mname']= $this->input->post("student_mname");
                    $form['student_lname']= $this->input->post("student_lname");
                    $form['student_enrollmentno']= self::enrollment($this->input->post("student_shift"), $this->input->post("student_dept_id"), $this->input->post("direct_second"), $this->input->post("student_tfws"), $user_dept_id);
                    $form['student_caste']= $this->input->post("student_caste");
                    $form['student_address']= $this->input->post("student_address");
                    $form['student_bdate']= $this->input->post("student_bdate");
                    $form['student_phno']= $this->input->post("student_phno");
                    $form['student_email']= $this->input->post("student_email");
                    $form['student_gender']= $this->input->post("student_gender");
                    $form['student_dateofadmission']= date("Y-m-d H:i:s");
                    $form['student_shift']= $this->input->post("student_shift");
                    $form['student_hostel']= $this->input->post("student_hostel");
                    $form['student_tfws']= $this->input->post("student_tfws");
                    $form['student_mothers_fname']= $this->input->post("student_mothers_fname");
                    $form['student_mothers_lname']= $this->input->post("student_mothers_lname");
                    $form['student_income']= $this->input->post("student_income");
                    $form['student_dept_id']= $this->input->post("student_dept_id");
                    $form['student_scheme_id']= $this->input->post("student_scheme_id");
                    $form['student_is_directsecondyear']= $this->input->post("direct_second");
                    $form['student_sem'] = $this->input->post("direct_second") ? '3': '1';
                    $form['student_10th_percent'] = $this->input->post("student_10th");
                    $form['student_12th_percent'] = $this->input->post("student_12th");
                    $form['student_dte_enrollment_no'] = $this->input->post("student_dte_enrollment_no");
                    $form['student_caste_category_id'] = $this->input->post("student_caste");
                    $form['student_sub_caste_id'] = $this->input->post("student_subcaste");
                    $form['student_image_name'] = $_FILES["myimage"]["name"];
                    if(self::createuser($form ) == true){
                         $data['message'] = "Student added successfully";
                         $data ['validclass'] = "valid success";
                         //==============PDF===========================
                         $this->load->library('pdf_lib');
                         $data['id']=$this->Pdf_model->pdf_id($user_dept_id,$user_id);
                         $data['doc_title'] = 'Student Admission Slip';
                         $data['s']=$this->Student_model->getstudent();
                         $data['d']=$this->Student_model->fetch_get_name($this->input->post("student_dept_id"));
                         $data['year']=$this->Student_model->get_year();
                         $form=array();
                            $form['report_id']= "";
                            $form['report_key']= $data['id'];
                            $form['report_gen_date ']= date("Y-m-d H:i:s");
                            $form['report_generator']=$user_id;
                            $form['report_hash']= "";
                         $this->db->insert('reports',$form);
                         $this->load->view('report',$data);
                        //================================================
                    }
                }
            }
        }
        if (isset($_POST['submit']) && $_FILES["myimage"]["size"] > 500000){ //500000 Bytes == 5000 Kb
            $data['message'] = "File size must be less than 500Kb, Registration failed !";
            $data ['validclass'] = "valid warning";
        }
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Student_view',$data);
        $this->load->view('/templets/Footer', $data);
    }
    public function createuser( $form){
        if ($this->db->insert('students',$form) && $this->Student_model->set_image(addslashes (file_get_contents($_FILES['myimage']['tmp_name'])), $form['student_enrollmentno']) ==true){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function enrollment($shift, $dept, $direct_secondyear, $student_tfws, $user_dept_id){
        $count='';
        $year = date("Y");
        if($student_tfws == 1)
            $shift = "FW";
        $dept_initials = $this->Student_model->get_dept_initial($dept);
        foreach ($dept_initials as $key => $value1)
            $dept_initial = $value1->dept_initial;
        $count= $this->Student_model->get_id($shift, $year[2] . $year[3] ,$dept_initial, $direct_secondyear);
        foreach($count as $key => $value)
            $serial_count = $value->last_id;
        if (is_null($serial_count))
            $serial_count = 0;
        if($direct_secondyear == 1)
            return  $shift[0] . "D" . $year[2] . $year[3] . $dept_initial . str_pad(($serial_count + 1), 3, '0', STR_PAD_LEFT);
        else
            return $shift . $year[2] . $year[3] . $dept_initial . str_pad(($serial_count + 1), 3, '0', STR_PAD_LEFT);
    }
//=============================================AJAX Functions============================================ 
    function fetch_subcaste(){
        $this->load->database();
        $access=$this->input->post('caste');
    	$result=$this->db->query("Select * from caste_sc_st_sbc_obc where Caste_Category = '$access'")->result();
        echo json_encode($result);
    }
    function fetch_subcaste1(){
        $this->load->database();
        $access=$this->input->post('caste');
        $result=$this->db->query("Select * from caste_ntb")->result();
        echo json_encode($result);
    }
    function fetch_subcaste2(){
        $this->load->database();
        $access=$this->input->post('caste');
        $result=$this->db->query("Select * from caste_vj_dt")->result();
        echo json_encode($result);
    }
    
}