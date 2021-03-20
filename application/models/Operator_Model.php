<?php
class Operator_Model extends CI_model{
    public function submit_data($op2_id, $op1_id){
        // copyes the data from op1 and op2 tables
    	$this->db->query("INSERT INTO semester_result(semester_result.semester_result_marks_id, semester_result.semester_result_marks_th, semester_result.semester_result_pass, semester_result.semester_result_studentabsent) 
                            SELECT sem_op2.sem_op2_internal_marks_id, sem_op2.sem_op2_marks_th, sem_op2.sem_op2_pass, sem_op2.sem_op2_studentabsent 
                            FROM sem_op2
                            WHERE sem_op2.sem_op2_id IN (SELECT sem_op2.sem_op2_id
                            FROM sem_op1, sem_op2
                            WHERE (sem_op1.sem_op1_internal_marks_id, sem_op1.sem_op1_marks_th, sem_op1.sem_op1_pass, sem_op1.sem_op1_studentabsent) IN (SELECT sem_op2.sem_op2_internal_marks_id, sem_op2.sem_op2_marks_th, sem_op2.sem_op2_pass, sem_op2.sem_op2_studentabsent FROM sem_op2) AND sem_op1.sem_op1_internal_marks_id = sem_op2.sem_op2_internal_marks_id AND sem_op2.sem_op2_user_id = '$op2_id' AND sem_op1.sem_op1_user_id = '$op1_id')");
        $result1 = $this->db->affected_rows();
        // sets the exam status in exam table to passed
        $this->db->query("UPDATE exam_reg
                            INNER JOIN course_reg ON course_reg.course_reg_id = exam_reg.exam_reg_course_reg_id AND course_reg.course_reg_student_id = exam_reg.exam_reg_student_id
                            INNER JOIN sem_internal_marks ON sem_internal_marks.sem_internal_course_id = course_reg.course_reg_course_id AND sem_internal_marks.sem_internal_student_id = course_reg.course_reg_student_id
                            INNER JOIN sem_op2 ON sem_op2.sem_op2_internal_marks_id = sem_internal_marks.sem_internal_id
                            SET exam_reg.exam_reg_type_status = CASE WHEN sem_op2.sem_op2_pass = 1 THEN 9 WHEN sem_op2.sem_op2_pass != 1 THEN 7 END
                            WHERE course_reg.course_reg_examstatus != 0 AND course_reg.course_reg_examstatus != 4 AND course_reg.course_reg_examstatus != 2 AND exam_reg.exam_reg_type = 7 AND exam_reg.exam_reg_type_status IS NULL AND sem_internal_marks.sem_internal_id IN (SELECT sem_op2.sem_op2_internal_marks_id FROM sem_op1, sem_op2 WHERE (sem_op1.sem_op1_internal_marks_id, sem_op1.sem_op1_marks_th, sem_op1.sem_op1_pass, sem_op1.sem_op1_studentabsent) IN (SELECT sem_op2.sem_op2_internal_marks_id, sem_op2.sem_op2_marks_th, sem_op2.sem_op2_pass, sem_op2.sem_op2_studentabsent FROM sem_op2) AND sem_op1.sem_op1_internal_marks_id = sem_op2.sem_op2_internal_marks_id AND sem_op2.sem_op2_user_id = '$op2_id' AND sem_op1.sem_op1_user_id = '$op1_id')");
        //====EXPERIMENTAL===sets course_exam_reg_status to pass based on valued from exam_reg table
        $this->db->query("UPDATE course_reg
INNER JOIN exam_reg ON exam_reg.exam_reg_course_reg_id = course_reg.course_reg_id
INNER JOIN sem_internal_marks ON sem_internal_marks.sem_internal_student_id = course_reg.course_reg_student_id AND sem_internal_marks.sem_internal_course_id = course_reg.course_reg_course_id AND sem_internal_marks.sem_internal_id IN (SELECT sem_op2.sem_op2_internal_marks_id FROM sem_op1, sem_op2 WHERE (sem_op1.sem_op1_internal_marks_id, sem_op1.sem_op1_marks_th, sem_op1.sem_op1_pass, sem_op1.sem_op1_studentabsent) IN (SELECT sem_op2.sem_op2_internal_marks_id, sem_op2.sem_op2_marks_th, sem_op2.sem_op2_pass, sem_op2.sem_op2_studentabsent FROM sem_op2) AND sem_op1.sem_op1_internal_marks_id = sem_op2.sem_op2_internal_marks_id AND sem_op2.sem_op2_user_id = '$op2_id' AND sem_op1.sem_op1_user_id = '$op1_id')
SET course_reg.course_reg_examstatus = 2
WHERE NOT EXISTS (SELECT * FROM exam_reg WHERE exam_reg.exam_reg_type_status != 9 AND exam_reg.exam_reg_course_reg_id = course_reg.course_reg_id) AND exam_reg.exam_reg_type_status = 9");
        //====EXPERIMENTAL===sets course_exam_reg_status to fail based on valued from exam_reg table
        $this->db->query("UPDATE course_reg
INNER JOIN exam_reg ON exam_reg.exam_reg_course_reg_id = course_reg.course_reg_id
INNER JOIN sem_internal_marks ON sem_internal_marks.sem_internal_student_id = course_reg.course_reg_student_id AND sem_internal_marks.sem_internal_course_id = course_reg.course_reg_course_id AND sem_internal_marks.sem_internal_id IN (SELECT sem_op2.sem_op2_internal_marks_id FROM sem_op1, sem_op2 WHERE (sem_op1.sem_op1_internal_marks_id, sem_op1.sem_op1_marks_th, sem_op1.sem_op1_pass, sem_op1.sem_op1_studentabsent) IN (SELECT sem_op2.sem_op2_internal_marks_id, sem_op2.sem_op2_marks_th, sem_op2.sem_op2_pass, sem_op2.sem_op2_studentabsent FROM sem_op2) AND sem_op1.sem_op1_internal_marks_id = sem_op2.sem_op2_internal_marks_id AND sem_op2.sem_op2_user_id = '$op2_id' AND sem_op1.sem_op1_user_id = '$op1_id')
SET course_reg.course_reg_examstatus = 3
WHERE exam_reg.exam_reg_type_status != 9");
        // sets the detention status in course_reg table
        $this->db->query("UPDATE course_reg 
                            INNER JOIN sem_internal_marks ON sem_internal_marks.sem_internal_student_id = course_reg.course_reg_student_id AND sem_internal_marks.sem_internal_course_id = course_reg.course_reg_course_id AND sem_internal_marks.sem_internal_id IN (SELECT sem_op2.sem_op2_internal_marks_id FROM sem_op1, sem_op2 WHERE (sem_op1.sem_op1_internal_marks_id, sem_op1.sem_op1_marks_th, sem_op1.sem_op1_pass, sem_op1.sem_op1_studentabsent) IN (SELECT sem_op2.sem_op2_internal_marks_id, sem_op2.sem_op2_marks_th, sem_op2.sem_op2_pass, sem_op2.sem_op2_studentabsent FROM sem_op2) AND sem_op1.sem_op1_internal_marks_id = sem_op2.sem_op2_internal_marks_id AND sem_op2.sem_op2_user_id = '$op2_id' AND sem_op1.sem_op1_user_id = '$op1_id')
                            INNER JOIN sem_op2 ON sem_op2.sem_op2_internal_marks_id = sem_internal_marks.sem_internal_id
                            SET course_reg.course_reg_examstatus = CASE WHEN sem_op2.sem_op2_studentabsent = 2 THEN 4 WHEN sem_op2.sem_op2_studentabsent = 1 THEN 3  WHEN sem_op2.sem_op2_pass = 1 THEN 2 WHEN sem_op2.sem_op2_pass = 0 THEN 3 END
                            WHERE sem_op2.sem_op2_pass IN (0,1) AND sem_op2.sem_op2_studentabsent IN (0,1,2) AND sem_internal_marks.marks_type = '5' AND course_reg.course_reg_examstatus != 0 AND course_reg.course_reg_examstatus != 4 AND course_reg.course_reg_examstatus != 2");
        $result4 = $this->db->affected_rows();
        return TRUE;
        echo"$result1<br><br>$result4";
     //   if($result1 == $result4){
             //$this->db->query("DELETE FROM sem_op2 WHERE sem_op2.sem_op2_user_id = '$op2_id'");
             //$result2 = $this->db->affected_rows();
             //$this->db->query("DELETE FROM sem_op1 WHERE sem_op1.sem_op1_user_id = '$op1_id'");
             //$result3 = $this->db->affected_rows();
             //return $result1 == $result2 && $result2 == $result3 && $result3 = $result4 ? TRUE : FALSE;
      //  }else{
         //    return FALSE;
       // }
    }

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

	public function get_op1_id($op2_id){
        if($op2_id == NULL)
            return "Error: Incorrect Arguments Provided";
		$this->load->database();
        $query = $this->db->query("SELECT DISTINCT sem_op1.sem_op1_user_id
        FROM sem_op1, sem_op2
        WHERE (sem_op1.sem_op1_internal_marks_id, sem_op1.sem_op1_marks_th, sem_op1.sem_op1_pass, sem_op1.sem_op1_studentabsent) IN (SELECT sem_op2.sem_op2_internal_marks_id, sem_op2.sem_op2_marks_th, sem_op2.sem_op2_pass, sem_op2.sem_op2_studentabsent FROM sem_op2) AND sem_op1.sem_op1_internal_marks_id = sem_op2.sem_op2_internal_marks_id AND sem_op2.sem_op2_user_id = '$op2_id'");
        return $query->result();
    }
    
	public function update_op2($op2_id = NULL, $marks_th, $is_pass, $is_ab, $sem_op2_id, $internal_marks_id){
        if($op2_id == NULL)
            return "Error: Incorrect Arguments Provided";
		$this->load->database();
        $query = $this->db->query("UPDATE sem_op2 SET sem_op2.sem_op2_marks_th = '$marks_th', sem_op2.sem_op2_pass = '$is_pass', sem_op2.sem_op2_studentabsent = '$is_ab' WHERE sem_op2.sem_op2_id = '$sem_op2_id' AND sem_op2.sem_op2_internal_marks_id = '$internal_marks_id' AND sem_op2.sem_op2_user_id = '$op2_id'");
    }
    
	public function update_op1($op1_id = NULL, $marks_th, $is_pass, $is_ab, $sem_op1_id, $internal_marks_id){
        if($op1_id == NULL)
            return "Error: Incorrect Arguments Provided";
		$this->load->database();
        $query = $this->db->query("UPDATE sem_op1 SET sem_op1.sem_op1_marks_th = '$marks_th', sem_op1.sem_op1_pass = '$is_pass', sem_op1.sem_op1_studentabsent = '$is_ab' WHERE sem_op1.sem_op1_id = '$sem_op1_id' AND sem_op1.sem_op1_internal_marks_id = '$internal_marks_id' AND sem_op1.sem_op1_user_id = '$op1_id'");
    }
    
	public function check_integrity($op2_id = NULL){
        if($op2_id == NULL)
            return "Error: Incorrect Arguments Provided";
		$this->load->database();
        $query = $this->db->query("SELECT sem_op1.sem_op1_id, sem_op1.sem_op1_user_id, sem_op1.sem_op1_internal_marks_id, sem_op1.sem_op1_marks_th, sem_op1.sem_op1_pass, sem_op1.sem_op1_studentabsent, 
                                    sem_op2.sem_op2_id, sem_op2.sem_op2_user_id, sem_op2.sem_op2_internal_marks_id, sem_op2.sem_op2_marks_th, sem_op2.sem_op2_pass, sem_op2.sem_op2_studentabsent
                                    FROM sem_op1, sem_op2 
                                    WHERE (sem_op1.sem_op1_internal_marks_id, sem_op1.sem_op1_marks_th, sem_op1.sem_op1_pass, sem_op1.sem_op1_studentabsent) NOT IN (SELECT sem_op2.sem_op2_internal_marks_id, sem_op2.sem_op2_marks_th, sem_op2.sem_op2_pass, sem_op2.sem_op2_studentabsent FROM sem_op2) AND sem_op1.sem_op1_internal_marks_id = sem_op2.sem_op2_internal_marks_id AND sem_op2.sem_op2_user_id = '$op2_id'");
        return $query;
	}
	public function get_sem($faculty_dept)
	{
			$this->load->database();
        	$query = $this->db->query("SELECT * from semester");
        	return $query->result();
	}
	public function get_course($faculty_dept)
	{
			$this->load->database();
        	$query = $this->db->query("select * from course");
        	return $query->result();
    }
    
    public function get_data($course,$shift){
		$query =$this->db->query("SELECT student_enrollmentno,sem_internal_id,sem_internal_student_id FROM students,sem_internal_marks WHERE sem_internal_marks.sem_internal_course_id='$course' AND sem_internal_marks.sem_internal_student_id=students.student_id AND students.student_shift='$shift' AND sem_internal_marks.marks_type = '5'");
			return $query->result();
	}
	function isDuplicate($arr){
        $this->db->get_where('sem_op1', $arr, 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    function isDuplicate1($arr){
        $this->db->get_where('sem_op2', $arr,1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    function isDuplicate2($arr){
        $this->db->get_where('semester_result', $arr, 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    function operator1($sem_id,$sem_marks,$sem_pass,$sem_absent){
    	$query = $this->db->query("SELECT `sem_op1_internal_marks_id`,`sem_op1_marks_th`,`sem_op1_pass`,`sem_op1_studentabsent` from  sem_op1 where `sem_op1_internal_marks_id`='$sem_id' AND `sem_op1_marks_th`='$sem_marks' and `sem_op1_pass`='$sem_pass' and `sem_op1_studentabsent`='$sem_absent'");
        return $query->result();

    }
    function operator2($sem_id,$sem_marks,$sem_pass,$sem_absent){
    	$query = $this->db->query("SELECT `sem_op2_internal_marks_id`,`sem_op2_marks_th`,`sem_op2_pass`,`sem_op2_studentabsent` from  sem_op2 where `sem_op2_internal_marks_id`='$sem_id' AND `sem_op2_marks_th`='$sem_marks' and `sem_op2_pass`='$sem_pass' and `sem_op2_studentabsent`='$sem_absent'");
        return $query->result();

    }
    function get_average($student_id,$course){
        $query = $this->db->query("select avg(ut.ut_marks) as 'avg' from ut where ut.ut_student_id='$student_id' AND ut.ut_course_id='$course'",FALSE);
        return $query->result();
    }
    function get_department(){
         $query = $this->db->query("Select * from dept");
        return $query->result();
    }
    function get_scheme(){
         $query = $this->db->query("Select * from scheme");
        return $query->result();
    }
}