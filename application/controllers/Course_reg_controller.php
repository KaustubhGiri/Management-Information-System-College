<?php
class Course_reg_controller extends CI_Controller
{
    public function index()
    {
        $this->load->model('SessionModel');
        $this->load->model('Pdf_model');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='course_registration'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE 
        $this->SessionModel->check_authority($token);
        
        $this->load->library('pdf_lib');
        $this->load->model('Course_reg_model');
        $data['message'] ='';
        $data ['validclass'] = "";
        $data['title'] ='Course Registration Slip';
        $user_id=$this->session->id;
        $User_dept=$this->session->dept;

        if(isset($_POST['tableRow'])){
            $sem_no=$this->input->post('sem_no');
            $s_id=$this->input->post('student_id');
              $tableRow = $this->input->post('tableRow');
                foreach($tableRow as $row){
                        if(isset($_POST['submit'])  && isset($row['course_reg_course_id'])){
                            $this->load->library('form_validation');
                            $this->form_validation->set_rules('student_id','required');
                            $this->form_validation->set_rules('sem_no','required');
                            if($this->form_validation->run() ==true ){
                                $data['message'] = validation_errors();
                                $data ['validclass'] = "valid danger";
                                return;
                            }else{
                                if($this->Course_reg_model->isDuplicate($this->input->post('course_reg_student_id'), $row['course_reg_course_id'])){
                                    $data['message'] = "Record already exists";
                                    $data ['validclass'] = "valid warning";
                                }else{
                                    $arr = array(
                                        'course_reg_id'=> '',
                                        'course_reg_student_id'=> $this->input->post('course_reg_student_id'),
                                        'course_reg_course_id'=> $row['course_reg_course_id'],
                                        'course_reg_date'=> date("Y-m-d H:i:s"),
                                        'course_reg_examstatus'=> ''
                                    );
                                    $this->db->insert('course_reg', $arr);
                                    $this->Course_reg_model->student_promotion($this->input->post('sem_no'), $this->input->post('course_reg_student_id'));
                                    $data['message'] = "Course Registered";
                                    $data ['validclass'] = "valid success";
                                }
                            }   
                        }
                }
                $data['id']=$this->Pdf_model->pdf_id($User_dept,$user_id);
                $data['doc_title'] = "Course Registration Slip";
                $data['enroll']=$this->Course_reg_model->pdf_course($s_id,$User_dept);
                $data['course_reg_info']=$this->Course_reg_model->fetch_course_name($s_id,$sem_no,$User_dept);//slip data
                $data['name']=$this->Course_reg_model->fetch_enroll_name($s_id,$User_dept);//for pritning name of student
                $data['sem_no']=$this->Course_reg_model->fetch_sem_no($sem_no,$User_dept);//sem no
                $data['dept']=$this->Course_reg_model->fetch_dept($User_dept);//for printing dept 
                $form=array();
                $form['report_id']= "";
                $form['report_key']= $data['id'];
                $form['report_gen_date ']= date("Y-m-d H:i:s");
                $form['report_generator']=$user_id;
                $form['report_hash']= "";
                $this->db->insert('reports',$form);
                $this->load->view('Course_slip1',$data);
        }
        $data['scheme']=$this->Course_reg_model->get_scheme($User_dept);
        $data['fetch_course'] = $this->Course_reg_model->fetch_course();
        
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Course_reg',$data);
        $this->load->view('/templets/Footer', $data);

    }
//+===============================================AJAX FUnctions=====================================
     function fetch_student_id()
    {
        $access=$this->input->post('x');
        $result=$this->db->query("select student_id from students where student_enrollmentno = '$access'")->result();
        echo json_encode($result);
    }
    function fetch_table()
    {
        $this->load->database();
        $enrollment_num = $this->input->post('enrollment_num');
        $semester_num = $this->input->post('scheme_num');
        $result = $this->db->query("SELECT DISTINCT course.* FROM course
                                    INNER JOIN semester ON semester.semester_course_id = course.course_id
                                    INNER JOIN scheme ON scheme.scheme_id = semester.semester_scheme_id
                                    INNER JOIN students ON students.student_scheme_id = scheme.scheme_id 
                                    LEFT JOIN course_reg ON course_reg.course_reg_course_id IN (SELECT course.course_id FROM course
                                        INNER JOIN course_reg ON course_reg.course_reg_course_id = course.course_id
                                        INNER JOIN students ON students.student_id = course_reg.course_reg_student_id AND course_reg.course_reg_examstatus = '4'
                                        WHERE students.student_enrollmentno = 'FS18IF001')
                                    WHERE students.student_enrollmentno = '$enrollment_num' AND semester.semester_number = '$semester_num' AND course.course_id NOT IN (SELECT course.course_id FROM course
                                        INNER JOIN course_reg ON course_reg.course_reg_course_id = course.course_id
                                        INNER JOIN students ON students.student_id = course_reg.course_reg_student_id AND course_reg.course_reg_examstatus != '4'
                                        WHERE students.student_enrollmentno = '$enrollment_num')")->result();
        echo json_encode($result);
    }
}
?>