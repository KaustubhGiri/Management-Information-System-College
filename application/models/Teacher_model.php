<?php
class Teacher_model extends CI_model{

	function get_teacher_name($User_dept){
            return $this->db->query("SELECT * FROM `faculty` WHERE faculty_dept_id='$User_dept'")->result();
    } 
	function deletefaculty($faculty_id){
    	$this->db->query("insert into faculty_cancel select * FROM faculty where faculty_id = '$faculty_id'");
    	$this->db->query("delete from faculty where faculty_id = '$faculty_id'");
    	return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
	
}
    