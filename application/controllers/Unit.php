 <?php
    defined('BASEPATH') OR exit('No direct script access allowed');
class Unit extends CI_Controller{
    public function index(){
        $this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='unit_test_marks_entry'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);
        $this->load->model('Accesscontrol_model');
        
        $User_dept = $this->session->userdata('dept');
        $user_id = $this->session->userdata('id');

        $absent="ABSENT";
        $data['message']='';
        $data ['validclass'] = "";
        $data['title']='Unit Test Marks Entry';

        $this->load->model('Pdf_model');
        $this->load->model('Unit_Model');
        $this->load->library('pdf_lib');

        if(isset($_POST['submit']) && isset($_POST['scheme_id']) && isset($_POST['semester_id']) && isset($_POST['course_id']) && isset($_POST['unit_id']) && isset($_POST['shift'])){

            $scheme_id = $this->input->post('scheme_id');
            $term_type = $this->input->post('semester_id');
            $course_id =$this->input->post('course_id');
            $ut_type = $this->input->post('unit_id');
            $shift_id = $this->input->post('shift');
    
            $this->load->library('form_validation');
            $this->form_validation->set_rules('semester_id','semester_id ','required');
            $this->form_validation->set_rules('course_id','course_id ','required');
            $this->form_validation->set_rules('scheme_id','scheme_id ','required');
            $this->form_validation->set_rules('unit_id','unit_id','required');
            if($this->form_validation->run()!=true){
                $data['message']= validation_errors();
                $data ['validclass'] = "valid danger";
               return;
            }else{
                $tableRow = $this->input->post('tableRow');
                foreach($tableRow as $row){
                    if($row['marks']=="401"){  //'401 is the Status code when Student is Absent on Unit Test Paper.
                        $arr = array(
                            'ut_semester_id'=> $term_type,
                            'ut_course_id'=> $course_id,
                            'ut_scheme_id'=> $scheme_id,
                            'ut_student_id'=> $row['student_id'],
                            'ut_dept'=>$User_dept,
                            'ut_marks'=> '00',
                            'ut_stud_ab'=>'1',
                            'ut_number'=> $ut_type
                        );
                        if($this->Unit_Model->isDuplicate($arr)){
                            $data['message'] = "Record already exists";
                            $data ['validclass'] = "valid warning";
                        }else{
                            $arr1 = array(
                            'ut_id'=>"",
                            'ut_semester_id'=> $this->input->post('semester_id'),
                            'ut_course_id'=> $this->input->post('course_id'),
                            'ut_scheme_id'=> $this->input->post('scheme_id'),
                            'ut_student_id'=> $row['student_id'],
                            'ut_dept'=>$User_dept,
                            'ut_marks'=>'00',
                            'ut_stud_ab'=>'1',
                            'ut_number'=>$this->input->post('unit_id')
                            );
                            $this->db->insert('ut', $arr1);
                            $data['message'] = "Data Added";
                            $data ['validclass'] = "valid success";
                        }
                    }else{
                        $arr = array(
                            'ut_semester_id'=> $term_type,
                            'ut_course_id'=> $course_id,
                            'ut_scheme_id'=> $scheme_id,
                            'ut_student_id'=> $row['student_id'],
                            'ut_dept'=>$User_dept,
                            'ut_marks'=> $row['marks'],
                            'ut_stud_ab'=>'0',
                            'ut_number'=> $ut_type
                        );
                        if($this->Unit_Model->isDuplicate($arr)){
                            $data['message'] = "Record already exists";
                            $data ['validclass'] = "valid warning";
                        }else{
                            $arr1 = array(
                            'ut_id'=>"",
                            'ut_semester_id'=> $this->input->post('semester_id'),
                            'ut_course_id'=> $this->input->post('course_id'),
                            'ut_scheme_id'=> $this->input->post('scheme_id'),
                            'ut_student_id'=> $row['student_id'],
                            'ut_dept'=>$User_dept,
                            'ut_marks'=>$row['marks'],
                            'ut_stud_ab'=>'0',
                            'ut_number'=>$this->input->post('unit_id')
                            );
                            $this->db->insert('ut', $arr1);
                            $data['message'] = "Data Added";
                            $data ['validclass'] = "valid success";
                        } 
                    }
                }
            }      
        }
        
        $data['dept']=$this->Unit_Model->dept_name();
        $data['scheme'] = $this->Unit_Model->get_scheme();
        $data['course'] = $this->Unit_Model->get_course($User_dept);
        $data['std_en'] = $this->Unit_Model->get_enrollment();

        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Unit_View',$data);
        $this->load->view('/templets/Footer', $data);
   }

//-------------------------------------------------ajax controller function-------------------------------------------------------------------

   function fetch_sc_id(){
        $department=$this->session->userdata('dept');
        $this->load->database();
        $result = $this->db->query("select * from scheme where scheme_dept_id =$department ")->result();
        echo json_encode($result);
    }


    function fetch_course(){
        $this->load->database();
        $faculty_id=$this->session->userdata('id');
        $access1 = $this->input->post('sc_id');
        //$result = $this->db->query("SELECT * FROM course where course_scheme_id = $access1;")->result();
        $result = $this->db->query("SELECT DISTINCT course.course_id, course.course_name, course.course_code FROM course 
        INNER JOIN facultytocourse ON facultytocourse.facultytocourse_course_id = course.course_id
        where course_scheme_id = '$access1' AND facultytocourse.facultytocourse_faculty_id = '$faculty_id' AND facultytocourse.facultytocourses_type = 'TH'")->result();
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
        $result = $this->db->query("SELECT DISTINCT student_id, student_enrollmentno from students
                                    INNER JOIN course_reg ON course_reg.course_reg_student_id = students.student_id
                                    INNER JOIN course ON course.course_id = course_reg.course_reg_course_id
                                    INNER JOIN semester ON semester.semester_course_id = course.course_id AND semester.semester_scheme_id = students.student_scheme_id
                                    where student_shift='$access' and student_scheme_id=$access3")->result();
        echo json_encode($result);
    }
    function get_dept_shift(){
        $faculty_id=$this->session->userdata('id');
        $course_id = $this->input->post('c_id');
        echo json_encode($this->db->query("SELECT COUNT(CASE WHEN facultytocourse.facultytocourse_shift = 'FS' THEN 1 END) AS fs, COUNT(CASE WHEN facultytocourse.facultytocourse_shift = 'SS' THEN 1 END) AS ss
        FROM facultytocourse WHERE facultytocourse.facultytocourse_faculty_id = '$faculty_id' AND facultytocourse.facultytocourse_course_id = '$course_id'")->result());
    }
}