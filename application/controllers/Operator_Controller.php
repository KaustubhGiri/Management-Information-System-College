<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Operator_Controller extends CI_Controller {
    public function index(){
        $this->load->model('SessionModel');
        $this->SessionModel->logoutusr();
        $this->SessionModel->not_Session();
        $token='semester_theorymarks_entry'; // DONT REMOVE, CHANGE THE VARIABLE---MANAGES USER ACCESS TO THIS PAGE
        $this->SessionModel->check_authority($token);

        $this->load->model('Operator_model');
        $data['message']='';
        $data ['validclass'] = "";
        $operator='';
        $pass = '1';
        $absent = '0'; 
        $user_id = $this->session->userdata('id');
        $data['get_department']=$this->Operator_model->get_department();

    	if(isset($_POST['submit']) && isset($_POST['operator']) && isset($_POST['department']) && isset($_POST['scheme']) && isset($_POST['semester']) && isset($_POST['course']) && isset($_POST['shift'])){
//===================================FORM Validation Section To Be Added====================================
            $data['course_id']='';
            $data['course_id']= $this->input->post('course');

    	 	$data['enroll_no']=$this->Operator_model->get_data($this->input->post('course'), $this->input->post('shift'), $this->input->post('scheme'), $this->input->post('semester'), $this->input->post('department'));
            $data['get_operator']= $this->input->post('operator');
    	}else{
            	if (isset($_POST['marks_submit'])){
                    $operator= $this->input->post('operator_final');
                    if($operator=="1"){
                        $tableRow =  $this->input->post('tableRow');
                    	foreach($tableRow as $row){
                            if($row['marks'] == '401'){ // check if student is absent
                                $pass = '0';
                                $absent = '1';
                                $marks = '0';
                            }elseif($row['marks'] == '402'){ // check is student is detained
                                $pass = '0';
                                $absent = '2';
                                $marks = '0';
                            }else{ // if none of above then checks if student is pass
                                $result = $this->Operator_model->is_pass($row['marks'], $row['sem_internal_id']); // returns 1 if pass 0 if fail
                                foreach($result as $key => $value)
                                    $status = $value->pass;
                                if($status){ // Check is student is pass
                                    $pass = '1';
                                    $absent = '0';
                                    $marks = $row['marks'];
                                }else{ // if student is not passed
                                    $pass = '0';
                                    $absent = '0';
                                    $marks = $row['marks'];
                                }
                            }
                            $arr = array(
                                'sem_op1_internal_marks_id'=> $row['sem_internal_id'],
                                'sem_op1_marks_th'=> $marks,
                                'sem_op1_pass'=>$pass, //------------------
                                'sem_op1_studentabsent'=>$absent //+++++++++++++
                            );
                            if($this->Operator_model->isDuplicate($arr)){
                                $data['message'] = "Record already exists";
                                $data ['validclass'] = "valid warning";
                            }else{
                                $arr1 = array(
                                    'sem_op1_id'=>"",
                                    'sem_op1_internal_marks_id'=> $row['sem_internal_id'],
                                    'sem_op1_marks_th'=> $marks,
                                    'sem_op1_pass'=>$pass, //------------------
                                    'sem_op1_studentabsent'=>$absent, //+++++++++++++++
                                    'sem_op1_user_id'=>$user_id
                                );
                                $this->db->insert('sem_op1', $arr1);
                                $data['message'] = "Operator 1 Marks Added";
                                $data ['validclass'] = "valid success";
                            }
                        }
            	 	}
                    if($operator=="2"){
                        $tableRow =  $this->input->post('tableRow');
                        foreach($tableRow as $row){
                            if($row['marks'] == '401'){ // check if student is absent
                                $pass = '0';
                                $absent = '1';
                                $marks = '0';
                            }elseif($row['marks'] == '402'){ // check is student is detained
                                $pass = '0';
                                $absent = '2';
                                $marks = '0';    
                            }else{ // if none of above then checks if student is pass
                                $result = $this->Operator_model->is_pass($row['marks'], $row['sem_internal_id']); // returns 1 if pass 0 if fail
                                foreach($result as $key => $value)
                                    $status = $value->pass;
                                if($status){ // Check is student is pass
                                    $pass = '1';
                                    $absent = '0';
                                    $marks = $row['marks'];
                                }else{ // if student is not passed
                                    $pass = '0';
                                    $absent = '0';
                                    $marks = $row['marks'];
                                }
                            }
                            $arr = array(
                                'sem_op2_internal_marks_id'=> $row['sem_internal_id'],
                                'sem_op2_marks_th'=> $marks,
                                'sem_op2_pass'=>$pass, //------------------
                                'sem_op2_studentabsent'=>$absent//++++++++
                            );
                            if($this->Operator_model->isDuplicate1($arr)){
                                $data['message'] = "Record already exists";
                                $data ['validclass'] = "valid warning";
                            }else{
                                $arr1 = array(
                                    'sem_op2_id'=>"",
                                    'sem_op2_internal_marks_id'=> $row['sem_internal_id'],
                                    'sem_op2_marks_th'=> $marks,
                                    'sem_op2_pass'=>$pass, //------------------
                                    'sem_op2_studentabsent'=>$absent,//++++++++
                                    'sem_op2_user_id'=>$user_id
                                );
                                $this->db->insert('sem_op2',$arr1);
                                $data['message'] = "Operator 2 Marks Added";
                                $data ['validclass'] = "valid success";
                            }
                        }
                        //==========Checks If the Recoards Match===================
                        $query = $this->Operator_model->check_integrity($user_id);
                        if($query->num_rows() == 0){
                            $data['message']="data match";
                            $data ['validclass'] = "valid info";
                            $result_op1_id = $this->Operator_model->get_op1_id($user_id); // Gets Op1 ID
                            foreach($result_op1_id as $kay => $value)
                                $idd = $value->sem_op1_user_id;                     // Extracts Op1 ID fron Result
                            if($this->Operator_model->submit_data($user_id, $idd)){ //user_id is op2 id
                                $data['message'] = "Record Submitted To Results";
                                $data ['validclass'] = "valid success";
                            }else{
                                $data['message'] = "Oops! Something Went Wrong. Contact Your Administrator Immediately!";
                                $data ['validclass'] = "valid danger";
                            }
                        }else{
                            $data['unmatched_data'] = $query->result();
                            $data['message'] = "Data Mismatch.";
                            $data ['validclass'] = "valid info";
                            $data['title'] = "Data Mismatch";
                        
                            $this->load->view('/templets/Header', $data);
                            $this->load->view('/templets/Sider', $data);
                            $this->load->view('/templets/Validation',$data);
                            $this->load->view('Operator_view_datamissmatch',$data); // Loades Different View If the Data Missmatches
                            $this->load->view('/templets/Footer', $data);
                            return;
                        }
                        //================================================================
                    }
                }
        }
        //================Start IF====================[Accepts the Update Date from 'operator_view_datamissmatch' View]
        if(isset($_POST['mussmatch_data_submit']) && isset($_POST['tableRow'])){
            $taRow = $this->input->post('tableRow');
            foreach($taRow as $row){
                if(isset($row['operator']) 
                && isset($row['sem_op1_id']) && isset($row['sem_op1_internal_marks_id']) && isset($row['sem_op1_marks_th'])
                && isset($row['sem_op1_usr_id']) && isset($row['sem_op2_id'])
                && isset($row['sem_op2_internal_marks_id']) && isset($row['sem_op2_marks_th'])
                && isset($row['sem_op2_usr_id'])){
                    if( $row['operator'] == '1'){
                        if($row['sem_op1_marks_th'] == '401'){ // check if student is absent
                            $pass = '0';
                            $absent = '1';
                            $marks = '0';
                        }elseif($row['sem_op1_marks_th'] == '402'){ // check is student is detained
                            $pass = '0';
                            $absent = '2';
                            $marks = '0';
                        }else{ // if none of above then checks if student is pass
                            $result = $this->Operator_model->is_pass($row['sem_op1_marks_th'], $row['sem_op1_internal_marks_id']); // returns 1 if pass 0 if fail
                            foreach($result as $key => $value)
                                $status = $value->pass;
                            if($status){ // Check is student is pass
                                $pass = '1';
                                $absent = '0';
                                $marks = $row['sem_op1_marks_th'];
                            }else{ // if student is not passed
                                $pass = '0';
                                $absent = '0';
                                $marks = $row['sem_op1_marks_th'];
                            }
                        }
                        $this->Operator_model->update_op1( $row['sem_op1_usr_id'], $marks, $pass, $absent, $row['sem_op1_id'], $row['sem_op1_internal_marks_id']);
                        $data['message'] = "Operator 1 Data Updated";
                        $data ['validclass'] = "valid success";
                        $user_id =  $row['sem_op1_usr_id'];
                    }elseif( $row['operator'] == '2'){
                        if($row['sem_op2_marks_th'] == '401'){ // check if student is absent
                            $pass = '0';
                            $absent = '1';
                            $marks = '0';
                        }elseif($row['sem_op2_marks_th'] == '402'){ // check is student is detained
                            $pass = '0';
                            $absent = '2';
                            $marks = '0';    
                        }else{ // if none of above then checks if student is pass
                            $result = $this->Operator_model->is_pass($row['sem_op2_marks_th'], $row['sem_op2_internal_marks_id']); // returns 1 if pass 0 if fail
                            foreach($result as $key => $value)
                                $status = $value->pass;
                            if($status){ // Check is student is pass
                                $pass = '1';
                                $absent = '0';
                                $marks = $row['sem_op2_marks_th'];
                            }else{ // if student is not passed
                                $pass = '0';
                                $absent = '0';
                                $marks = $row['sem_op2_marks_th'];
                            }
                        }
                        $this->Operator_model->update_op2( $row['sem_op2_usr_id'], $marks, $pass, $absent, $row['sem_op2_id'], $row['sem_op2_internal_marks_id']);
                        $data['message'] = "Operator 2 Data Updated";
                        $data ['validclass'] = "valid success";
                        $user_id =  $row['sem_op2_usr_id'];
                    }
                }
            }
            $query = $this->Operator_model->check_integrity($user_id);
                    if($query->num_rows() == 0){
                        $result_op1_id = $this->Operator_model->get_op1_id($user_id); // Gets Op1 ID
                        foreach($result_op1_id as $kay => $value)
                            $idd = $value->sem_op1_user_id;                     // Extracts Op1 ID fron Result
                        if($this->Operator_model->submit_data($user_id, $idd)){ //user_id is op2 id
                            $data['message'] = "Record Submitted To Results";
                            $data ['validclass'] = "valid success";
                        }else{
                            $data['message'] = "Oops! Something Went Wrong. Contact Your Administrator Immediately!";
                            $data ['validclass'] = "valid danger";
                        }
                    }else{
                        $data['unmatched_data'] = $query->result();
                        $data['message'] = "Data Mismatch.";
                        $data ['validclass'] = "valid info";
                        $data['title'] = "Data Mismatch";
                    
                        $this->load->view('/templets/Header', $data);
                        $this->load->view('/templets/Sider', $data);
                        $this->load->view('/templets/Validation',$data);
                        $this->load->view('Operator_view_datamissmatch',$data); // Loades Different View If the Data Missmatches
                        $this->load->view('/templets/Footer', $data);
                        return;
                    }
        } 
        //================End IF====================
        $this->load->view('/templets/Header', $data);
        $this->load->view('/templets/Sider', $data);
        $this->load->view('/templets/Validation',$data);
        $this->load->view('Operator_view',$data);
        $this->load->view('/templets/Footer', $data);
    }
    //--------------------------------------------AJAX Functions---------------------------------------
    function fetch_scheme(){
        $this->load->database();
        $dept_id = $this->input->post('dept_id');
        $result = $this->db->query("SELECT scheme.scheme_id, scheme.scheme_year FROM scheme WHERE scheme.scheme_dept_id = '1'")->result();
        echo json_encode($result);
    }
    function fetch_semester(){
        $this->load->database();
        $schene_id = $this->input->post('schene_id');
        $dept_id = $this->input->post('dept_id');
        $result = $this->db->query("SELECT DISTINCT semester_number FROM semester
                                    INNER JOIN scheme ON scheme.scheme_id = semester.semester_scheme_id
                                    WHERE scheme.scheme_dept_id = '$dept_id' AND scheme.scheme_id ='$schene_id'")->result();
        echo json_encode($result);
    }
    function fetch_course(){   
        $this->load->database();
        $department=$this->input->post('dept_id');
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
                                            COUNT(case WHEN course.course_or != '0,0' THEN 1 END) AS course_or,
                                            COUNT(case WHEN course.course_tw != '0,0' THEN 1 END) AS course_tw
                                    FROM course WHERE course.course_id = '$course_id'")->result();
        echo json_encode($result);
    }
    function fetch_shift(){
        $dept_id = $this->input->post('dept_id');
        $result = $this->db->query("SELECT dept_shift FROM dept WHERE dept.dept_id = '$dept_id'")->result();
        echo json_encode($result);
    }
}
?>