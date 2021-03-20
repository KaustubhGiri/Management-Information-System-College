<?php
class Exam_reg_list_model extends CI_model{

	 public function get_course_info($course_code,$shift_course,$faculty_dept){
        $course_info=$this->db->query("SELECT DISTINCT student_enrollmentno,student_fname,student_lname,student_mname,exam_reg_date FROM students s,course c,course_reg cr,exam_reg ex WHERE c.course_id =cr.course_reg_course_id AND ex.exam_reg_course_reg_id=cr.course_reg_id AND cr.course_reg_examstatus='1' AND s.student_dept_id='$faculty_dept' AND s.student_id=ex.exam_reg_student_id AND c.course_code='$course_code' AND s.student_shift='$shift_course'");
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
        $course=$this->db->query("SELECT  DISTINCT course_code FROM course c,course_reg cr,scheme s WHERE  c.course_scheme_id=s.scheme_id AND s.scheme_dept_id='$faculty_dept' AND c.course_id=cr.course_reg_course_id");
        return $course->result();
    }
  
   
}
?>