<?php
class Utm extends CI_model{
    function fetch_cn($scheme_id){
        $this->load->database();
        $query = $this->db->query("select * from course where course_scheme_id = $scheme_id");
        return json_encode($query->result());
    }
    function show(){
        $this->load->database();
        $query = $this->db->query("Select * from course");
        return $query->result();

    }
    function get_scheme()
    {
    		$this->load->database();	
            $query1 = $this->db->query("Select * from  scheme");
            return $query1->result();

    }
    function get_sem()
    {
    	$this->load->database();
    	$query2 = $this->db->query("Select * from  semester");
    	return $query2->result();
    }
    function get_en()
    {
        $this->load->database();
        $query3 = $this->db->query("Select * from  students");
        return $query3->result();
    }
    function fetch_data()
    {
        $query4 = $this->db->get("ut");
        return $query4;   
    }
    function fetch_data2()
    {
        $query5 = $this->db->get("ut");
        return $query5;
   
    }
}