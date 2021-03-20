<?php
class Student_Information_Model extends CI_model{

	function get_student_info($enrollment_no){
            return $this->db->query("SELECT  AVG(ut.ut_marks) as 'AVG' ,students.*, dept.*, course.*, course_reg.*, exam_reg.*, attendance.*, ut.*, sem_internal_marks.*, semester_result.*, semester.* FROM students
			INNER JOIN dept ON dept.dept_id = students.student_dept_id
			LEFT JOIN course_reg ON course_reg.course_reg_student_id = students.student_id
			INNER JOIN course ON course.course_id = course_reg.course_reg_course_id
			LEFT JOIN exam_reg ON exam_reg.exam_reg_student_id = students.student_id AND exam_reg.exam_reg_course_reg_id = course_reg.course_reg_id
			LEFT JOIN attendance ON attendance.attendance_student_id = students.student_id AND attendance.attendance_dept_id = students.student_dept_id AND attendance.attendance_student_id = course_reg.course_reg_course_id
			LEFT JOIN ut ON ut.ut_student_id = students.student_id AND ut.ut_course_id = course_reg.course_reg_course_id AND ut.ut_scheme_id = students.student_scheme_id AND ut.ut_dept = students.student_dept_id
			LEFT JOIN sem_internal_marks ON sem_internal_marks.sem_internal_student_id = students.student_id AND sem_internal_marks.sem_internal_course_id = course_reg.course_reg_course_id
			LEFT JOIN semester_result ON semester_result.semester_result_marks_id = sem_internal_marks.sem_internal_id
			INNER JOIN semester ON semester.semester_scheme_id = students.student_scheme_id AND semester.semester_course_id = course_reg.course_reg_course_id
			WHERE students.student_enrollmentno = '$enrollment_no' GROUP BY ut.ut_course_id")->result();
				    } 
	function get_semester(){
		$query = $this->db->query("Select * from  semester");
        return $query->result();

	}
    function get_student_data($roll_no){
		$query = $this->db->query("Select * from  students where student_enrollmentno = '$roll_no'");
        return $query->result();
	}
	function get_dept_name($dept_id){    
        $query = $this->db->query("Select * from  dept where dept_id = $dept_id");
        return $query->result();
    }

    function get_scheme_name($scheme_id){    
        $query = $this->db->query("Select * from  scheme where scheme_id = $scheme_id");
        return $query->result();
    }
    	
}
    