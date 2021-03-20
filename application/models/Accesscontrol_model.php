<?php
class  Accesscontrol_model extends CI_model{
    function update_level($level, $arr){
    	$this->load->database();
        $this->db->where('access_level', $level);
        $this->db->update('accesscontrol', $arr);
    }
}
