<?php
class Course_Main extends CI_model{
	public function fetch_course_code_course_name($faculty_dept){
	$query=$this->db->query("SELECT student_enrollmentno,course_code,course_name,course_reg_date,course_reg_course_id FROM students,course,course_reg WHERE students.student_dept_id='1' AND course.course_id=course_reg.course_reg_course_id AND students.student_id=course_reg_student_id");
	return $query;
    // SELECT student_enrollmentno,course_code,course_name,course_reg_date,course_reg_course_id FROM students,course,course_reg WHERE students.student_dept_id='1' AND course.course_id=course_reg.course_reg_course_id AND students.student_id=course_reg_student_id
	}
	public function fetch_course_reg_date($faculty_dept){
		$query1=$this->db->query("SELECT * from course_reg WHERE course_reg_student_id IN (SELECT student_id from students WHERE student_dept_id='$faculty_dept')");
		return $query1->result();
	}
	 function deleteRecord($course_reg_id)
    {
        $query = $this->db->query("delete  from course_reg where course_reg_id  = '$course_reg_id'"); 
    }
    function fetch_data($query)
    {
    	$this->db->select("*");
    	$this->db->from("course");
    	if($query!='')
    	{
    		$this->db->like('course_name',$query);
    	}
    	$this->db->order_by('course_id','DESC');
    	return $this->db->get();
    }
}
?>