<?php
class Schemem extends CI_model{

	function show(){

			$this->load->database();
            $query = $this->db->query("Select * from  dept");
            return $query->result();
	}
	function isDuplicate($arr){
        $this->db->get_where('scheme', $arr, 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

}
    