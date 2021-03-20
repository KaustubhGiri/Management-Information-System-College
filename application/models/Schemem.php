<?php
class Schemem extends CI_model{

	function show($dept_id){
			$this->load->database();
            $query = $this->db->query("SELECT * FROM dept WHERE dept.dept_id = '$dept_id'");
            return $query->result();
	}
	function isDuplicate($arr){
        $this->db->get_where('scheme', $arr, 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

}