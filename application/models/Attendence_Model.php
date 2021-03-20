<?php
class Attendence_Model extends CI_model {
	function get_course($dept = NULL){
    		$this->load->database();
            if($dept == NULL)
                return "Errot: Insufficient arguments provided";
            $query1 = $this->db->query("SELECT * FROM course INNER JOIN scheme ON scheme.scheme_id = course.course_scheme_id WHERE scheme.scheme_dept_id = '$dept'");
            return $query1->result();
    }

    function get_data($dept,$year,$shift){	
    		$this->load->database();
    		$query = $this->db->query(" Select * from  students where student_dateofadmission LIKE '__".$year. "%' and student_shift = '$shift' and student_dept_id='$dept' ");
            return $query->result();
    }
    function get_faculty($dept)
    {
            $this->load->database();    
            $query = $this->db->query("Select * from  faculty where faculty_dept_id = '$dept' ");
            return $query->result();

    }
    function isDuplicate($arr){
        $this->db->get_where('attendance', $arr, 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }
    function get_dept_shift($dept){    
        $query = $this->db->query("SELECT dept_shift FROM dept WHERE dept.dept_id = '$dept'");
        return $query->result();
    }
}