<?php
class Semmodel extends CI_model{
	function get_course(){
            $this->load->database();
			$query = $this->db->query("Select * from  course");
            return $query->result();
    }
    function get_scheme($dept){
            $query1 = $this->db->query("SELECT * FROM scheme WHERE scheme.scheme_dept_id = '$dept'");
            return $query1->result();

    }
       function isDuplicate($arr){
            $this->load->database();
        $this->db->get_where('semester', $arr, 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    public function fetch_course(){
        $q = $this->db->get('course');
        return $q;
    }

    function fetch_sc_id($s_id) {
        
        $this->load->database();
        $query=$this->db->query("SELECT * FROM scheme WHERE scheme_id in ( select semester_scheme_id from semester where semester_number =$s_id)");
    
        $output.='<option value="">Select course</option>';

        foreach ($query->result() as $row) {
            
            $output .='<option value="'.$row->scheme_id.'">'.$row->scheme_year.'</option>';

        }

        return $output;

    }

    function fetch_c_id($sc_id) 
    {
        
   
        $this->load->database();
        $query=$this->db->query("SELECT * FROM course where course_scheme_id=$sc_id ");
       
        $output="";

        $data=$query->result() ;
    if ( $query->result() > 0) 
     {   
                    $count = 0;

        foreach ($data as $row) {
    
'<tr>'.$output .='<td>'.$row->course_id.'</td>';
$output .='<td>'.$row->course_name.'</td>';
$output .='<td>'.$row->course_code.'</td>';
$output .='<td>'.$row->course_lectures.'</td>';
$output .='<td>'.$row->course_practicals.'</td>';
$output .='<td>'.$row->course_tutorials.'</td>';
$output .='<td>'.$row->course_teschinh_hrs.'</td>';
$output .='<td>'.$row->course_th.'</td>';
$output .='<td>'.$row->course_ts.'</td>';
$output .='<td>'.$row->course_pr.'</td>';
$output .='<td>'.$row->course_or.'</td>';
$output .='<td>'.$row->course_tw.'</td>';
$output .='<td>'.$row->cource_credit.'</td>';
$output .='<td>'.$row->course_level.'</td>';
$output .='<td>'.$row->course_scheme_id.'</td>';
$output .='<td>'.$row->course_total_marks.'</td>';
$output .='<td>'.'<input type=checkbox  name="tableRow[ '. $count.'][semister_course_id]" value="'. $row->course_id.'"</td>'.'</tr>';
  
     $count ++;

          }
      }
      
       return $output;
       

    }
}

?>