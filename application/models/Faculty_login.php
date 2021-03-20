<?php
class Faculty_login extends CI_model{
    public function login($faculty_email = NULL){
        if($faculty_email === NULL){
            return "ERROR: excepting Username, but no parameter provided";
        }
        $this->load->database();
        $query=$this->db->query("select * from faculty where faculty_email = '$faculty_email'");
        return $query->result_array();
    }
    
}