<?php
class Facultytocourse_model extends CI_model{
     function fetch_data($dept_id){
       	$query = $this->db->query("SELECT course.course_code, course.course_name, course.course_id, facultytocourse.facultytocourse_faculty_id, faculty.faculty_name, scheme.scheme_year,facultytocourse.facultytocourses_type,facultytocourse.facultytocourse_shift,facultytocourse_id FROM course LEFT JOIN facultytocourse ON facultytocourse.facultytocourse_course_id = course.course_id LEFT JOIN faculty ON faculty.faculty_id = facultytocourse.facultytocourse_faculty_id INNER JOIN semester ON semester.semester_course_id = course.course_id INNER JOIN scheme ON scheme.scheme_id = semester.semester_scheme_id WHERE scheme.scheme_dept_id = '$dept_id'");
        return $query->result();
    }
    public function get_sem_id($sem_num = NULL, $scheme_id, $course_id){
		if($sem_num == NULL)
			return "Error: Insufficient arguments provided";
		else{
			$result = $this->db->query("SELECT semester.semester_id FROM semester WHERE semester.semester_number = '$sem_num' AND semester.semester_course_id = '$course_id' AND semester.semester_scheme_id = '$scheme_id'")->result();
            foreach($result as $key => $value)
                $sem_id=$value->semester_id;
            return $sem_id;
        }
	}
    function deleteRecord($facultytocourse_id){
        $query = $this->db->query("delete from facultytocourse where facultytocourse_id = $facultytocourse_id"); 
    }
    public function get_sem(){
        $query = $this->db->query("Select * from semester");
        return $query->result();
    }
    public function get_course($dept_id){
        $query = $this->db->query("SELECT  DISTINCT * FROM course,scheme WHERE  course_scheme_id=scheme_id AND scheme_dept_id='$dept_id'");
        return $query->result();
    }
    public function get_teacher($userid){
        $query = $this->db->query("Select * from faculty where faculty_dept_id='$userid'");
        return $query->result();
    }
    function isDuplicate($arr){
        $this->db->get_where('facultytocourse', $arr, 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    function fetch_get_name($s_id){ 
        $k=$this->db->query("SELECT dept.dept_name FROM `dept` where (SELECT students.student_dept_id FROM `students` WHERE students.student_id = '$s_id')= dept.dept_id");
        return $k->result();
    }
    function get_dept_name($dept_id){    
        $query = $this->db->query("Select * from  dept where dept_id = $dept_id");
        return $query->result();
    }
}
