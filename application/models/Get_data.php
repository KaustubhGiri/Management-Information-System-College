<?php
class Get_data extends CI_model{
    public function get_data($select = "*", $from = "NULL", $return = "result"){
        if($from == "NULL"){
            echo "<b>ERROR: Atleast one parameter 'From' is expected, use general prototype get_dept(select_what, from_where, [return_type[result]or[result_array])<b>";
            return;
        }else{
            echo "In False block";
            $this->load->database();
            $query = $this->db->query("Select $select from $from");
            if($return == "result"){
                return $query->result();
            }elseif($return == "result_array"){
                return $query->result();
            }else{
                echo "<b>ERROR: Atleast one parameter 'From' is expected, use general prototype get_dept(select_what, from_where, [return_type[result]or[result_array])<b>";
                return;
            }
        }
    }
}