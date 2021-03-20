<?php
class Exam_main extends CI_Model
{
function deleteRecord($exam_reg_id,$course_reg_id)
{
$this->db->query("delete  from exam_reg where exam_reg_id  = '$exam_reg_id'");
$arr=array(
'course_reg_examstatus'=>"0"
);
$this->db->where('course_reg_id',$course_reg_id);
$this->db->update('course_reg',$arr);
}
}

?>