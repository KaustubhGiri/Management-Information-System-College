<?php
class Sem_Model extends CI_model{
	public function get_scheme($dept_id = NULL){
		if($dept_id == NULL)
			return "Error: Insufficient arguments provided";
		else{
			return $this->db->query("SELECT * FROM scheme WHERE scheme.scheme_dept_id = '$dept_id'")->result();
		}
	}
	public function set_detain($student_id = NULL, $course_id){
		if($student_id == NULL)
			return "Error: Insufficient arguments provided";
		else{
			return $this->db->query("UPDATE course_reg 
									SET course_reg.course_reg_examstatus = '4'
									WHERE course_reg.course_reg_student_id = '$student_id' AND course_reg.course_reg_course_id = '$course_id' AND course_reg.course_reg_examstatus = '1'");
		}
	}
	public function set_fail($student_id = NULL, $course_id, $type){
		if($student_id == NULL)
			return "Error: Insufficient arguments provided";
		else{
            if($type != '5' && $type != '1'){
                if($type == '2'){
                    $set_value = '5';
                }elseif($type == '3'){
                    $set_value = '6';
                }
                // elseif($type == '1'){
                //     $set_value = '8';
                // }
                return $this->db->query("UPDATE exam_reg
                                        INNER JOIN course_reg ON course_reg.course_reg_id = exam_reg.exam_reg_course_reg_id
                                        SET exam_reg.exam_reg_type_status = '$set_value'
                                        WHERE course_reg.course_reg_student_id = '$student_id' AND course_reg.course_reg_course_id = '$course_id' AND course_reg.course_reg_examstatus = '1' AND exam_reg.exam_reg_type_status IS NULL AND exam_reg.exam_reg_type = '$set_value'");
            }
		}
	}
	public function set_pass($student_id = NULL, $course_id, $type){
		if($student_id == NULL)
			return "Error: Insufficient arguments provided";
		else{
            if($type != '5' && $type != '1'){
                if($type == '2'){
                    $set_value = '5';
                }elseif($type == '3'){
                    $set_value = '6';
                }
                return $this->db->query("UPDATE exam_reg
                                        INNER JOIN course_reg ON course_reg.course_reg_id = exam_reg.exam_reg_course_reg_id
                                        SET exam_reg.exam_reg_type_status = '9'
                                        WHERE course_reg.course_reg_student_id = '$student_id' AND course_reg.course_reg_course_id = '$course_id' AND course_reg.course_reg_examstatus != 2 AND course_reg.course_reg_examstatus != 0 AND course_reg.course_reg_examstatus != 4 AND exam_reg.exam_reg_type_status IS NULL AND exam_reg.exam_reg_type = '$set_value'");
            }
		}
	}
	public function get_sem_id($sem_num = NULL, $scheme_id, $course_id){
		if($sem_num == NULL)
			return "Error: Insufficient arguments provided";
		else{
			return $this->db->query("SELECT semester.semester_id FROM semester WHERE semester.semester_number = '$sem_num' AND semester.semester_course_id = '$course_id' AND semester.semester_scheme_id = '$scheme_id'")->result();
		}
	}
    public function change_course_exam_status_fail($course_id = NULL, $student_id){
        if($course_id == NULL)
            return "Error: Insufficient arguments provided";
        else{
            return $this->db->query("UPDATE course_reg
                                        INNER JOIN exam_reg ON exam_reg.exam_reg_course_reg_id = course_reg.course_reg_id
                                        SET course_reg.course_reg_examstatus = 3
                                        WHERE course_reg.course_reg_student_id = $student_id
                                        AND course_reg.course_reg_course_id = $course_id
                                        AND course_reg.course_reg_examstatus != 4
                                        AND course_reg.course_reg_examstatus != 0
                                        AND course_reg.course_reg_examstatus != 2
                                        AND exam_reg.exam_reg_type IN (5,6)
                                        AND exam_reg.exam_reg_type_status IN (5,6)");
        }
    }
    public function change_course_exam_status_pass($course_id = NULL, $student_id){
        if($course_id == NULL)
            return "Error: Insufficient arguments provided";
        else{
            return $this->db->query("UPDATE course_reg
                                    INNER JOIN students ON students.student_id = course_reg.course_reg_student_id
                                    INNER JOIN exam_reg ON exam_reg.exam_reg_course_reg_id = course_reg.course_reg_id
                                    SET course_reg.course_reg_examstatus = 2
                                    WHERE course_reg.course_reg_examstatus != 4 
                                    AND course_reg.course_reg_examstatus != 0
                                    AND course_reg.course_reg_examstatus != 4
                                    AND course_reg.course_reg_examstatus != 2
                                    AND course_reg.course_reg_course_id = $course_id
                                    AND students.student_id = $student_id
                                    AND exam_reg.exam_reg_type_status = 9
                                    AND exam_reg.exam_reg_type != 7
                                    AND (SELECT SUM(exam_reg.exam_reg_type) AS course_types FROM exam_reg WHERE exam_reg.exam_reg_course_reg_id = course_reg.course_reg_id AND exam_reg.exam_reg_type_status IN (9) AND exam_reg.exam_reg_type != 7) = (SELECT (case WHEN course.course_or != '0,0' AND course.course_pr != '0,0' THEN 11 WHEN course.course_pr != '0,0' THEN 5 WHEN course.course_or != '0,0' THEN 6 END) AS course_types FROM course WHERE course.course_id = course_reg.course_reg_course_id GROUP BY course.course_id)");
        }
    }
    public function is_pass_pr($marks = NULL, $course_id){
        if($marks == NULL)
            return "Error: Incorrect Arguments Provided";
        $this->load->database();
        $query = $this->db->query("SELECT COUNT(CASE WHEN $marks >= SUBSTRING_INDEX(course.course_pr, ',', 1) THEN TRUE END) AS pass
        FROM course 
        WHERE course.course_id = '$course_id'");
        return $query->result();
    }
    public function is_pass_or($marks = NULL, $course_id){
        if($marks == NULL)
            return "Error: Incorrect Arguments Provided";
        $this->load->database();
        $query = $this->db->query("SELECT COUNT(CASE WHEN $marks >= SUBSTRING_INDEX(course.course_or, ',', 1) THEN TRUE END) AS pass
        FROM course 
        WHERE course.course_id = '$course_id'");
        return $query->result();
    }
    public function is_pass_tw($marks = NULL, $course_id){
        if($marks == NULL)
            return "Error: Incorrect Arguments Provided";
        $this->load->database();
        $query = $this->db->query("SELECT COUNT(CASE WHEN $marks >= SUBSTRING_INDEX(course.course_tw, ',', 1) THEN TRUE END) AS pass
        FROM course 
        WHERE course.course_id = '$course_id'");
        return $query->result();
    }

	public function get_course($faculty_dept)
	{
		$this->load->database();
    	$query = $this->db->query("SELECT  DISTINCT course_code, course_id, course_name FROM course c,course_reg cr,scheme s WHERE  c.course_scheme_id=s.scheme_id AND s.scheme_dept_id='$faculty_dept' AND c.course_id=cr.course_reg_course_id");
    	return $query->result();
	}
	public function get_students($faculty_dept, $shift, $semester_num, $course_id)
	{
		$this->load->database();
        $query = $this->db->query("SELECT DISTINCT students.* from students
									INNER JOIN course_reg ON course_reg.course_reg_student_id = students.student_id AND course_reg.course_reg_examstatus = '1'
									INNER JOIN course ON course.course_id = course_reg.course_reg_course_id
									INNER JOIN semester ON semester.semester_course_id = course.course_id AND semester.semester_scheme_id = students.student_scheme_id
									where student_shift='$shift' AND students.student_dept_id = '$faculty_dept' AND semester.semester_number = '$semester_num'  AND course_reg.course_reg_examstatus = 1 AND course.course_id = $course_id");
        return $query->result();
	}
	function isDuplicate($arr){
        $this->db->get_where('sem_internal_marks', $arr, 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    public function get_course_data($course){
		$this->load->database();
        $query = $this->db->query("Select * from course where course_id='$course'");
        return $query->result();
	}
	// public function get_sem_id($sem_num){
	// 	$this->load->database();
    //     $query = $this->db->query("Select  from course where course_id='$course'");
    //     return $query->result();
	// }
	public function is_pass($marks = NULL, $inernal_marks_id){
        if($marks == NULL)
            return "Error: Incorrect Arguments Provided";
		$this->load->database();
        $query = $this->db->query("SELECT COUNT(CASE WHEN '$marks' >= SUBSTRING_INDEX(course.course_th, ',', 1) THEN TRUE END) AS pass
        FROM course 
        INNER JOIN sem_internal_marks ON sem_internal_marks.sem_internal_course_id = course.course_id
        WHERE sem_internal_marks.sem_internal_id = '$inernal_marks_id'");
        return $query->result();
    }

}