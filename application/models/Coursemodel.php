<?php
class  Coursemodel extends CI_model{

    function get_scheme($dept_id){
    		$this->load->database();	
            $query1 = $this->db->query("SELECT * FROM scheme WHERE scheme.scheme_dept_id = '$dept_id'");
            return $query1->result();
    }
    
    function isDuplicate($arr){
        $this->db->get_where('course', $arr, 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

}
    