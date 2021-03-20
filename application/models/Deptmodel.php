<?php
class Deptmodel extends CI_model{
	

	function isDuplicate($arr){
        $this->db->get_where('dept', $arr, 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function fetch_data(){
       $query = $this->db->get("dept");
        return $query;
    }

    function deleteRecord($dept_id){
        $query = $this->db->query("delete from dept where dept_id  = $dept_id"); 
    }

    function fetch_shift($dept_id){
        $query = $this->db->query("SELECT dept.dept_shift FROM dept WHERE dept.dept_id = '$dept_id'");
        return $query->result();
    }
}