<?php
class Student_model extends CI_model{

    function set_image($img, $en_no){
        $query1 = $this->db->query("UPDATE `students` SET `student_image` = '$img' WHERE `students`.`student_enrollmentno` = '$en_no';");
        if ($query1)
            return TRUE;
        else
            return FALSE;
    }
    function get_scheme($dept){
            $query1 = $this->db->query("SELECT * FROM scheme WHERE scheme.scheme_dept_id = '$dept'");
            return $query1->result();

    }
   
    function get_dept_shift($dept){    
        $query = $this->db->query("SELECT dept_shift FROM dept WHERE dept.dept_id = '$dept'");
        return $query->result();
    }

    function get_dept($dept){    
        $query = $this->db->query("SELECT * FROM dept WHERE dept.dept_id = '$dept'");
        return $query->result();
    }

    function get_dept_initial($dept_id){    
        $query = $this->db->query("SELECT dept.dept_initial FROM dept WHERE dept.dept_id = '$dept_id'");
        return $query->result();
    }
    function get_id($shift, $year, $dept_ini, $direct_secondyear){
        if($direct_secondyear == 1)
            $query = $this->db->query("SELECT COUNT(*) AS 'last_id' FROM students WHERE students.student_enrollmentno LIKE 'FD". $year . $dept_ini . "___'", FALSE);
        else
            $query = $this->db->query("SELECT COUNT(*) AS 'last_id' FROM students WHERE students.student_enrollmentno LIKE '". $shift . $year . $dept_ini . "___'", FALSE);
        //$this->db->select_max('student_id', 'last_id');
        //$query = $this->db->get_where('students', array('student_dept_id' => $dept_id ));
        //$query = $this->db->get('students');
        return $query->result();
    }

    function isDuplicate($email, $phno){
        $this->db->get_where('students', array('student_email' => $email, 'student_phno' => $phno), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function get_caste(){
        $query1=$this->db->query('Select * from caste_category');
        return $query1->result();

    }
    function get_info($student_dept_id,$year){
        $k=$this->db->query("SELECT * FROM students WHERE student_dept_id=$student_dept_id AND YEAR(student_dateofadmission)=$year");
        if ($k->num_rows() <= 0)
            return FALSE;
        return $k->result();
    }
    function get_dept_name($dept_id){    
        $query = $this->db->query("Select * from  dept where dept_id = $dept_id");
        return $query->result();
    }
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
    function fetch_get_name($s_id){ 
        $k=$this->db->query("SELECT dept.dept_name FROM `dept` where (SELECT students.student_dept_id FROM `students` WHERE students.student_id = '$s_id')= dept.dept_id");
        return $k->result();
    }
    function getstudent(){ 
        $this->load->library('table');   
        return $this->db->query('SELECT * FROM `students` WHERE student_id=(select MAX(student_id) FROM `students`)')->result();
    }
    function get_year(){
        $year=date('Y');
        return $year.'-'.($year+1);
    }
    public function enrollment($shift, $dept, $direct_secondyear, $student_tfws, $user_dept_id){
        $count='';
        $year = date("Y");
        if($student_tfws == 1)
            $shift = "FW";
        $dept_initials = self::get_dept_initial($dept);
        foreach ($dept_initials as $key => $value1)
            $dept_initial = $value1->dept_initial;
        $count= self::get_id($shift, $year[2] . $year[3] ,$dept_initial, $direct_secondyear);
        foreach($count as $key => $value)
            $serial_count = $value->last_id;
        if (is_null($serial_count))
            $serial_count = 0;
        if($direct_secondyear == 1)
            return  $shift[0] . "D" . $year[2] . $year[3] . $dept_initial . str_pad(($serial_count + 1), 3, '0', STR_PAD_LEFT);
        else
            return $shift . $year[2] . $year[3] . $dept_initial . str_pad(($serial_count + 1), 3, '0', STR_PAD_LEFT);
    }
}