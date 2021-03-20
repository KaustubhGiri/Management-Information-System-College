<?php
class Password_model extends CI_model {
    function get_regdate($username = NULL){
    		$this->load->database();
            if($username == NULL)
                return "Errot: Insufficient arguments provided";
            $query = $this->db->query("SELECT faculty.faculty_reg_date FROM faculty WHERE faculty.faculty_email = '$username'");
            return $query->result();
    }
    function update_password($pass, $email = NULL){
        $this->load->database();
        if($email == NULL)
            return "Errot: Insufficient arguments provided";
        $query = $this->db->query("UPDATE faculty SET faculty.faculty_pass = '$pass' WHERE faculty.faculty_email = '$email'");
        return $this->db->affected_rows();
    }
}