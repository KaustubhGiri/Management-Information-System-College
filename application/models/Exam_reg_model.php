<?php
class Exam_reg_model extends Ci_Model{
 function fetch_exam_data($student_enrollmentno,$course_id,$faculty_dept,$type){
        $course_info=$this->db->query("SELECT course.course_code, course.course_name, exam_reg.exam_reg_type
FROM course
INNER JOIN course_reg ON course_reg.course_reg_course_id = course.course_id 
INNER JOIN students ON students.student_id = course_reg.course_reg_student_id
INNER JOIN exam_reg ON exam_reg.exam_reg_course_reg_id = course_reg.course_reg_id AND exam_reg.exam_reg_student_id = students.student_id
WHERE students.student_enrollmentno = '$student_enrollmentno' AND students.student_dept_id = '$faculty_dept' AND course_reg.course_reg_id = '$course_id' AND exam_reg.exam_reg_type =$type");
        return $course_info->result();
    }
    function pdf_course($s_id,$faculty_dept){
        $res=$this->db->query("SELECT * FROM students WHERE student_enrollmentno='$s_id' AND student_dept_id='$faculty_dept'");
        return $res->result();
    }
    function fetch_enroll_name($s_id,$faculty_dept){
        $enroll_name=$this->db->query("SELECT * FROM `students` WHERE student_enrollmentno='$s_id' AND student_dept_id='$faculty_dept'");
        return $enroll_name->result();
    }
    function fetch_dept($faculty_dept){
        $dept_info=$this->db->query("SELECT dept_name FROM dept WHERE dept_id='$faculty_dept'");
        return $dept_info->result();
    }
    function isDuplicate($arr){
        $this->db->get_where('exam_reg',$arr,1);
        return $this->db->affected_rows()>0?TRUE:FALSE;
    }

}
?>