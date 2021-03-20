<?php
class Unit_Model extends CI_model{
	function dept_name(){
        	$this->load->database();
        	$query = $this->db->query("Select * from dept");
        	return $query->result();
    }

    function get_scheme(){
    		$this->load->database();
            $query1 = $this->db->query("Select * from  scheme ");
            return $query1->result();
    }

    function get_course(){
    		$this->load->database();
            $query1 = $this->db->query("Select * from  course ");
            return $query1->result();
    }

    function get_enrollment(){
    		$this->load->database();
        	$query = $this->db->query(" Select * from students");
        	return $query->result();

    }

    function isDuplicate($arr){
        $this->db->get_where('ut', $arr, 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function get_data(){
        $this->load->database();
        $query = $this->db->query("Select * from ut");
        return $query->result();
    }
    function get_sum($dept,$course,$shift, $ut_type){
        $this->load->database();
        $query = $this->db->query("Select SUM(ut_marks) as getsum from ut INNER JOIN students on students.student_id = ut.ut_student_id where ut.ut_stud_ab ='0' and ut.ut_dept ='$dept' and ut.ut_course_id='5' and students.student_shift='$shift' and ut.ut_number = '$ut_type'");
        return $query->result();

    }

    function get_enrollment1($student_id){
        $query2 = $this->db->query("Select * from students where student_id = $student_id");
        return $query2->result();    
    }

    function get_pdf_data($semester,$course,$ut_number,$dept,$scheme,$shift){
        $this->load->database();
         $query2 = $this->db->query(" Select ut.ut_marks,ut.ut_stud_ab,students.student_enrollmentno FROM ut INNER JOIN students ON students.student_id=ut.ut_student_id WHERE ut.ut_semester_id='$semester' AND ut.ut_course_id='$course' AND ut.ut_number='$ut_number' AND ut.ut_student_id IN(SELECT students.student_id FROM students WHERE students.student_dept_id='$dept' AND students.student_scheme_id='$scheme' AND students.student_shift='$shift')");
        return $query2->result();
    }

    function get_dept($dept){
        $this->load->database();
        $query = $this->db->query("Select * from dept where dept_id = '$dept'");
        return $query->result();

    }

    function get_course1($course){
        $this->load->database();
        $query = $this->db->query("Select * from course where course_id = '$course'");
        return $query->result();

    }

    function get_all($shift, $course, $ut_type){
        $this->load->database();
        $query = $this->db->query("Select COUNT(ut_student_id) as get_total FROM ut INNER JOIN students on students.student_id = ut.ut_student_id where students.student_shift ='$shift' and ut.ut_course_id ='$course' and ut.ut_number = '$ut_type'");
        return $query->result();
    }

    function get_absent($shift,$course,$ut_type){
        $this->load->database();
        $query = $this->db->query(" Select COUNT(ut_student_id) as get_absent FROM ut INNER JOIN students on students.student_id = ut.ut_student_id where students.student_shift ='$shift' and ut.ut_course_id ='$course' and ut.ut_stud_ab ='1' and ut.ut_number = '$ut_type'");
        return $query->result();
    }

    function get_unit_test($unit_id){
        $this->load->database();
        $query = $this->db->query("Select * from unit_test_name where unit_id = '$unit_id'");
        return $query->result();
    }
}