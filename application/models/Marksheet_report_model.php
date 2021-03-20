<?php
class Marksheet_report_model extends Ci_Model{
		public function fetch_internal_marks($marks_type,$scheme,$semester_no,$course,$user_dept,$shift){
			$query = $this->db->query("SELECT student_enrollmentno,sem_internal_marks,sem_internal_student_absent,sem_internal_marks_fail, DATE(sem_internal_marks.sem_internal_date_time) AS 'date' FROM students,sem_internal_marks,scheme,semester WHERE sem_internal_marks.sem_internal_student_id=students.student_id AND sem_internal_marks.marks_type='$marks_type' AND scheme.scheme_id='$scheme' AND scheme.scheme_dept_id='$user_dept' AND sem_internal_marks.sem_internal_semister_id=semester.semester_id AND sem_internal_course_id='$course' AND semester.semester_number='$semester_no' AND students.student_shift='$shift'");
        	return $query->result();
		}
		public function fetch_TheorY_marks($scheme,$semester_no,$course,$user_dept,$shift){
			$query=$this->db->query("SELECT Distinct student_enrollmentno,semester_result_marks_th,semester_result_studentabsent,semester_result_pass FROM semester_result,sem_internal_marks,students,scheme,semester WHERE semester_result.semester_result_marks_id=sem_internal_marks.sem_internal_id AND sem_internal_marks.sem_internal_student_id=students.student_id AND scheme.scheme_id='$scheme' AND scheme.scheme_dept_id='$user_dept' AND sem_internal_marks.sem_internal_semister_id=semester.semester_id AND sem_internal_course_id='$course' AND semester.semester_number='$semester_no' AND students.student_shift='$shift'");
			return $query->result();
		}
		public function fetch_dept($faculty_dept,$scheme_id){
        $dept_info=$this->db->query("SELECT dept_name,scheme_year FROM scheme,dept WHERE dept_id='$faculty_dept' AND scheme.scheme_id='$scheme_id'");
        return $dept_info->result();
    	}
    	public function fetch_course_info($course_id){
    		$query=$this->db->query("SELECT course_code,course_name FROM course where course_id='$course_id'");
    		return $query->result();
    	}
    	public function get_all_internal($marks_type,$scheme,$semester_no,$course,$user_dept,$shift){
    		$query=$this->db->query("SELECT count(student_enrollmentno) as total  FROM students,sem_internal_marks,scheme,semester WHERE sem_internal_marks.sem_internal_student_id=students.student_id AND sem_internal_marks.marks_type='$marks_type' AND scheme.scheme_id='$scheme' AND scheme.scheme_dept_id='1' AND sem_internal_marks.sem_internal_semister_id=semester.semester_id AND sem_internal_course_id='$course' AND semester.semester_number='$semester_no' AND students.student_shift='$shift'");
    		return $query->result();	
    	}
    	public function get_all_theory($scheme,$semester_no,$course,$user_dept,$shift){
    		$query=$this->db->query("SELECT count(student_enrollmentno) as total FROM semester_result,sem_internal_marks,students,scheme,semester WHERE semester_result.semester_result_marks_id=sem_internal_marks.sem_internal_id AND sem_internal_marks.sem_internal_student_id=students.student_id AND scheme.scheme_id='$scheme' AND scheme.scheme_dept_id='$user_dept' AND sem_internal_marks.sem_internal_semister_id=semester.semester_id AND sem_internal_course_id='$course' AND semester.semester_number='$semester_no' AND students.student_shift='$shift'");
			return $query->result();

    	}
    	public function get_absent_internal($marks_type,$scheme,$semester_no,$course,$user_dept,$shift){
        $this->load->database();
        $query = $this->db->query("SELECT count(student_enrollmentno) as total  FROM students,sem_internal_marks,scheme,semester WHERE sem_internal_marks.sem_internal_student_id=students.student_id AND sem_internal_marks.marks_type='$marks_type' AND scheme.scheme_id='$scheme' AND scheme.scheme_dept_id='1' AND sem_internal_marks.sem_internal_semister_id=semester.semester_id AND sem_internal_course_id='$course' AND semester.semester_number='$semester_no' AND students.student_shift='$shift' AND sem_internal_marks.sem_internal_student_absent='1'");
        return $query->result();
    	}
        
    	function get_absent_theory($scheme,$semester_no,$course,$user_dept,$shift){
        $this->load->database();
        $query = $this->db->query("SELECT count(student_enrollmentno) as total FROM semester_result,sem_internal_marks,students,scheme,semester WHERE semester_result.semester_result_marks_id=sem_internal_marks.sem_internal_id AND sem_internal_marks.sem_internal_student_id=students.student_id AND scheme.scheme_id='$scheme' AND scheme.scheme_dept_id='$user_dept' AND sem_internal_marks.sem_internal_semister_id=semester.semester_id AND sem_internal_course_id='$course' AND semester.semester_number='$semester_no' AND students.student_shift='$shift' AND semester_result.semester_result_studentabsent='1'");
        return $query->result();
    }
}

?>