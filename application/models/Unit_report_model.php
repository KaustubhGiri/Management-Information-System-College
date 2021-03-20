<?php
class Unit_report_model extends Ci_model{
	 function get_pdf_data($semester,$course,$ut_number,$dept,$scheme,$shift){
        $this->load->database();
         $query2 = $this->db->query(" Select ut.ut_marks,ut.ut_stud_ab,students.student_enrollmentno,ut.ut_stud_ab FROM ut INNER JOIN students ON students.student_id=ut.ut_student_id WHERE ut.ut_semester_id='$semester' AND ut.ut_course_id='$course' AND ut.ut_number='$ut_number' AND ut.ut_student_id IN(SELECT students.student_id FROM students WHERE students.student_dept_id='$dept' AND students.student_scheme_id='$scheme' AND students.student_shift='$shift')");
        return $query2->result();
    }
    function get_data(){
        $this->load->database();
        $query = $this->db->query("Select * from ut");
        return $query->result();
    }
    function get_sum($dept,$course,$shift, $ut_type){
        $this->load->database();
        $query = $this->db->query("Select SUM(ut_marks) as getsum from ut INNER JOIN students on students.student_id = ut.ut_student_id where ut.ut_stud_ab ='0' and ut.ut_dept ='$dept' and ut.ut_course_id='5' and students.student_shift='$shift' and ut.ut_number = '$ut_type'");
        return $query->result();

    }
    function sem_no($sem_id){
        $query=$this->db->query("SELECT semester_number FROM semester WHERE semester_id='$sem_id'");
        return $query->result();        
    }


    function get_dept($dept){
        $this->load->database();
        $query = $this->db->query("Select * from dept where dept_id = '$dept'");
        return $query->result();

    }
     function fetch_dept($faculty_dept,$scheme_id){
        $dept_info=$this->db->query("SELECT dept_name,scheme_year FROM scheme,dept WHERE dept_id='$faculty_dept' AND scheme.scheme_id='$scheme_id'");
        return $dept_info->result();
        }
     
    function get_course1($course){
        $this->load->database();
        $query = $this->db->query("Select * from course where course_id = '$course'");
        return $query->result();

    }
    function fetch_course_info($course_id){
            $query=$this->db->query("SELECT course_code,course_name FROM course where course_id='$course_id'");
            return $query->result();
     }

    function get_all($shift, $course, $ut_type){
        $this->load->database();
        $query = $this->db->query("Select COUNT(ut_student_id) as get_total FROM ut INNER JOIN students on students.student_id = ut.ut_student_id where students.student_shift ='$shift' and ut.ut_course_id ='$course' and ut.ut_number = '$ut_type'");
        return $query->result();
    }

    function get_absent($shift,$course,$ut_type){
        $this->load->database();
        $query = $this->db->query(" Select COUNT(ut_student_id) as get_absent FROM ut INNER JOIN students on students.student_id = ut.ut_student_id where students.student_shift ='$shift' and ut.ut_course_id ='$course' and ut.ut_stud_ab ='1' and ut.ut_number = '$ut_type'");
        return $query->result();
    }

    function get_unit_test($unit_id){
        $this->load->database();
        $query = $this->db->query("Select * from unit_test_name where unit_id = '$unit_id'");
        return $query->result();
    }
}
?>