<?php
class 	Admission_cancel_model extends CI_model{ 
	function get_student_data($roll_no)
	{
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

    function get_caste($casteid){
    	$query = $this->db->query("Select * from caste_category where CATEGORYID = '$casteid'");
    	return $query->result();
    }

    function isDupRollno($roll_no){
        $this->db->query("Select * from  cancled_students where student_enrollmentno = '$roll_no'");
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function checkRollno($roll_no){
        $this->db->query("Select * from  students where student_enrollmentno = '$roll_no'");
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function cancelAdmission($roll_no){
    	$this->db->query("insert into cancled_students select * FROM students where student_enrollmentno = '$roll_no'");
    	$this->db->query("delete from students where student_enrollmentno = '$roll_no'");
    	return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
}