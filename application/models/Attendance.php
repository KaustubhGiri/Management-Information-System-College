<?php 
class ATTENDANCE extends CI_model{
	public function fetch_faculty_name($faculty_dept){
		$faculty_name=$this->db->query("SELECT * FROM faculty WHERE faculty_dept_id='$faculty_dept'");
		return  $faculty_name->result();
	}
	public function course_info($course_code,$shift_course,$faculty_dept,$faculty_name){
     $course_info=$this->db->query("SELECT course_code,course_name,student_shift,dept_name,faculty_name from course c,students s,dept d,faculty f WHERE c.course_code='$course_code' AND s.student_shift='$shift_course' AND s.student_dept_id='$faculty_dept' AND d.dept_id='$faculty_dept' AND f.faculty_name='$faculty_name' LIMIT 1");  
     return  $course_info->result();
    }
    public function student_info($course_code,$shift_course,$faculty_dept){
        $student_info=$this->db->query("SELECT student_enrollmentno,student_fname,student_lname,student_mname FROM students s,course c,course_reg cr WHERE s.student_dept_id='$faculty_dept' AND s.student_id=cr.course_reg_student_id AND c.course_code='$course_code'  AND c.course_id=cr.course_reg_course_id AND s.student_shift='$shift_course' ORDER BY s.student_enrollmentno");
        return $student_info->result();
        
    }
    public function fetch_course_code($faculty_dept){
    	$course=$this->db->query("SELECT  DISTINCT course_code, course_name FROM course c,course_reg cr,scheme s WHERE  c.course_scheme_id=s.scheme_id AND s.scheme_dept_id='$faculty_dept' AND c.course_id=cr.course_reg_course_id");
    	return $course->result();
    }
    public function get_course_code($course_id){
    	$course=$this->db->query("SELECT course.course_code FROM course WHERE course.course_id = '$course_id'");
    	return $course->result();
    }
}
?>