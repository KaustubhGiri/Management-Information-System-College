<?php
class Faculty_signup extends CI_model{
    public function get_dept($dept_id){
        $this->load->database();
        $query = $this->db->query("SELECT * FROM dept WHERE dept.dept_id = '$dept_id'");
        return $query->result();
    }
    public function isDuplicate($email, $phno){
        $query = $this->db->query("SELECT * FROM faculty WHERE faculty_email = '$email' OR faculty_phno = $phno");
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
}