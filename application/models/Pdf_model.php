<?php
class Pdf_model extends CI_model{

    function pdf_id($dept,$user_id){
            $dept_name= self::get_dept_name($dept);
            foreach ($dept_name as $key => $value1)
                $dept_name = $value1->dept_initial;
            //$timestamp =time();
            $user_id = str_pad($user_id, 2, '0', STR_PAD_LEFT);
            $string= str_pad(idate ('d'), 2, '0', STR_PAD_LEFT);
            $string.= str_pad(idate ('m'), 2, '0', STR_PAD_LEFT);
            $string.= idate ('y');
            $string.= str_pad(idate ('h'), 2, '0', STR_PAD_LEFT);
            $string.= str_pad(idate ('i'), 2, '0', STR_PAD_LEFT);
            $string.= str_pad(idate ('s'), 2, '0', STR_PAD_LEFT);
            return $dept_name.$user_id.$string;

    }
    function get_dept_name($dept_id){    
        $query = $this->db->query("Select * from  dept where dept_id = $dept_id");
        return $query->result();
    }
}