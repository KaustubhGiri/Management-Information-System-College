<?php
class  Course_reg_model extends CI_model{
    function get_scheme($department)
    {
    		$this->load->database();	
            $query1 = $this->db->query("Select * from  scheme ");
            return $query1->result();
    }
    
    function get_sem()
    {
            $this->load->database();	
            $query2 = $this->db->query("Select * from  semester");
            return $query2->result();      
    }
    // function isDuplicate($arr){
    //     $this->db->get_where('course_reg',$arr,1);
    //     return $this->db->affected_rows()>0?TRUE:FALSE;
    // }
    function isDuplicate($student_id = NULL, $course_id){
        if($student_id=='NULL')
            return "Error: Insufficient arguments are provided";
        $query = $this->db->query("SELECT * FROM course_reg WHERE course_reg.course_reg_student_id = $student_id AND course_reg.course_reg_course_id = $course_id AND course_reg.course_reg_examstatus IN (0,1,2,3)");
        return $this->db->affected_rows()>0?TRUE:FALSE;
    }
    function fetch_course(){
        $this->load->database();
        $query = $this->db->query("Select * from  course");
        return $query->result();
    }
    function student_promotion($sem_no='1', $student_id='NULL'){
        if($student_id=='NULL')
            return "Error: Insufficient arguments are provided";
        $query = $this->db->query("select students.student_sem FROM students WHERE students.student_id = '$student_id'");
        $result = $query->result();
        foreach($result as $key => $value)
            $current_sem = $value->student_sem;
        if($current_sem < $sem_no)
            $this->db->query("UPDATE students SET students.student_sem = '$sem_no' WHERE students.student_id = '$student_id'");
    }
    function pdf_course($s_id,$faculty_dept){
        $res=$this->db->query("SELECT * FROM students WHERE student_enrollmentno='$s_id' AND student_dept_id='$faculty_dept'");
        return $res->result();
    }
    function fetch_course_name($student_eno,$sem_no,$faculty_dept){
        $course_info=$this->db->query("SELECT DISTINCT course_code, course_name FROM course, course_reg,semester,students WHERE 
        students.student_enrollmentno = '$student_eno' AND students.student_sem <= '6' AND students.student_dept_id = '$faculty_dept' AND course_reg.course_reg_student_id = students.student_id AND course_reg.course_reg_course_id = course.course_id  AND semester.semester_number='$sem_no' AND semester.semester_course_id = course_reg.course_reg_course_id");
        return $course_info->result();
    }
    function fetch_enroll_name($s_id,$faculty_dept){
        $enroll_name=$this->db->query("SELECT * FROM `students` WHERE student_enrollmentno='$s_id' AND student_dept_id='$faculty_dept'");
        return $enroll_name->result();
    }
    function fetch_sem_no($sem_no,$faculty_dept){
        $sem=$this->db->query("Select * from Students where student_sem='$sem_no' AND student_dept_id='$faculty_dept'");
        return $sem->result();   
    }

    // course list methods begins 
    public function get_course_info($course_code,$shift_course,$faculty_dept){
        $course_info=$this->db->query("SELECT student_enrollmentno,student_fname,student_lname,student_mname,course_reg_date FROM students s,course c,course_reg cr WHERE s.student_dept_id='$faculty_dept' AND s.student_id=cr.course_reg_student_id AND
c.course_code='$course_code'  AND c.course_id=cr.course_reg_course_id AND s.student_shift='$shift_course' AND cr.course_reg_examstatus = '0' ORDER BY s.student_enrollmentno");
        return $course_info->result();
        
    }
    public function course_name($course_code,$shift_course,$faculty_dept){
     $course_list=$this->db->query("SELECT course_code,course_name,student_shift,dept_name from course c,students s,dept d WHERE c.course_code='$course_code'  AND s.student_shift='$shift_course' AND s.student_dept_id='$faculty_dept' AND d.dept_id='$faculty_dept' LIMIT 1");  
     return  $course_list->result();
    }
    function fetch_dept($faculty_dept){
        $dept_info=$this->db->query("SELECT dept_name FROM dept WHERE dept_id='$faculty_dept'");
        return $dept_info->result();
    }
    public function fetch_course_code($faculty_dept){
        $course=$this->db->query("SELECT  DISTINCT course_code, course_name FROM course c,course_reg cr,scheme s WHERE  c.course_scheme_id=s.scheme_id AND s.scheme_dept_id='$faculty_dept' AND c.course_id=cr.course_reg_course_id");
        return $course->result();
    }
    /*
    public function fetch_doc_id(){
        $doc_id=$this->db->query("Select report_unique_id from reports ORDER BY report_id DESC LIMIT 1");
        return $doc_id->result();
    }*/
}
    