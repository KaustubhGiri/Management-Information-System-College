<?php
class Home_model extends CI_model{

    public function get_mesg($year, $month, $day="NULL"){
        if($day == "NULL"){
            echo "<b>ERROR: Invalid Parameters<b>";
            return;
        }else{
            $this->load->database();
            $query = $this->db->query("SELECT msg_of_day.msg_details, faculty.faculty_name FROM msg_of_day INNER JOIN
            faculty ON faculty.faculty_id = msg_of_day.created_by WHERE msg_of_day.is_active = '1' AND YEAR(msg_of_day.created_at) = '$year' AND MONTH(msg_of_day.created_at) = '$month' AND DAY(msg_of_day.created_at)='$day'");
            return $query->result();
        }
    }
    public function get_notice($msg_user_type = "S", $date="NULL"){
        if($date == "NULL"){
            echo "<b>ERROR: Invalid Parameters<b>";
            return;
        }else{
            $this->load->database();
            $query = $this->db->query("SELECT notice.notice_title, notice.notice_description, faculty.faculty_name FROM notice INNER JOIN faculty ON faculty.faculty_id = notice.created_by WHERE notice.is_active = '1' AND notice.notice_user_type ='$msg_user_type' AND DATE(notice.notice_date) >= '$date'"); 
            return $query->result();
        }
    }
    public function get_students_genter($dept = "NULL"){
        if($dept == "NULL"){
            echo "<b>ERROR: Invalid Parameters<b>";
            return;
        }else{
            $this->load->database();
            $query = $this->db->query("SELECT COUNT(case WHEN students.student_gender = 'M' THEN 1 END) AS male_cnt, COUNT(case WHEN students.student_gender = 'F' THEN 1 END) AS female_cnt FROM students WHERE students.student_dept_id = '$dept'");
            return $query->result();
        }
    }
    public function get_students_result($dept = "NULL", $year){
        if($dept == "NULL"){
            echo "<b>ERROR: Invalid Parameters<b>";
            return;
        }else{
            $this->load->database();
            $query = $this->db->query("SELECT COUNT(case WHEN semester_result.semester_result_pass = '1' THEN 1 END) AS pass,
                                        COUNT(case WHEN semester_result.semester_result_pass = '0' THEN 1 END) AS fail 
                                        FROM semester_result 
                                        INNER JOIN sem_internal_marks ON sem_internal_marks.sem_internal_id = semester_result.semester_result_marks_id
                                        INNER JOIN students ON students.student_id = sem_internal_marks.sem_internal_student_id
                                        WHERE YEAR(students.student_dateofadmission) = '$year' AND students.student_dept_id = '$dept'");
            return $query->result();
        }
    }
    public function get_students_casts($dept = "NULL", $year){
        if($dept == "NULL"){
            echo "<b>ERROR: Invalid Parameters<b>";
            return;
        }else{
            $this->load->database();
            /* Returns result as 
            open    SC    ST    VJ/DT NT-A    NT-B    NT-C    NT-D    OBC    SBC 
            15      7     0         0           0       1       0      7      0
            */
            $query = $this->db->query("SELECT COUNT(CASE WHEN students.student_caste_category_id = 'Open' THEN 1 END) as 'open',
            COUNT(CASE WHEN students.student_caste_category_id = 'Scheduled caste' THEN 1 END) as 'SC',
            COUNT(CASE WHEN students.student_caste_category_id = 'Scheduled Tribes' THEN 1 END) as 'ST',
            COUNT(CASE WHEN students.student_caste_category_id = 'Vimukta Jati(VJ/DT)(NT-A)' THEN 1 END) as 'VJ/DT NT-A',
            COUNT(CASE WHEN students.student_caste_category_id = 'Nomadic Tribes-1( NT-B)' THEN 1 END) as 'NT-B',
            COUNT(CASE WHEN students.student_caste_category_id = 'Nomadic Tribes-2( NT-C)' THEN 1 END) as 'NT-C',
            COUNT(CASE WHEN students.student_caste_category_id = 'Nomadic Tribes-3( NT-D)' THEN 1 END) as 'NT-D',
            COUNT(CASE WHEN students.student_caste_category_id = 'Other Backward Class' THEN 1 END) as 'OBC',
            COUNT(CASE WHEN students.student_caste_category_id = 'Special Backward class' THEN 1 END) as 'SBC' FROM students WHERE students.student_dept_id = '$dept' AND YEAR(students.student_dateofadmission) = '$year'");
            return $query->result();
        }
    }
    public function get_monthly_attandance($dept = "NULL", $year){
        if($dept == "NULL"){
            echo "<b>ERROR: Invalid Parameters<b>";
            return;
        }else{
            $this->load->database();
            $query = $this->db->query("SELECT COUNT(CASE WHEN MONTH(attendance.attendance_date) = '1' THEN 1 END) as 'Jan',
                                        COUNT(CASE WHEN MONTH(attendance.attendance_date) = '2' THEN 1 END) as 'feb',
                                        COUNT(CASE WHEN MONTH(attendance.attendance_date) = '3' THEN 1 END) as 'mar',
                                        COUNT(CASE WHEN MONTH(attendance.attendance_date) = '4' THEN 1 END) as 'apr',
                                        COUNT(CASE WHEN MONTH(attendance.attendance_date) = '5' THEN 1 END) as 'may',
                                        COUNT(CASE WHEN MONTH(attendance.attendance_date) = '6' THEN 1 END) as 'Jun',
                                        COUNT(CASE WHEN MONTH(attendance.attendance_date) = '7' THEN 1 END) as 'Jul',
                                        COUNT(CASE WHEN MONTH(attendance.attendance_date) = '8' THEN 1 END) as 'aug',
                                        COUNT(CASE WHEN MONTH(attendance.attendance_date) = '9' THEN 1 END) as 'sept',
                                        COUNT(CASE WHEN MONTH(attendance.attendance_date) = '10' THEN 1 END) as 'oct',
                                        COUNT(CASE WHEN MONTH(attendance.attendance_date) = '11' THEN 1 END) as 'nov',
                                        COUNT(CASE WHEN MONTH(attendance.attendance_date) = '12' THEN 1 END) as 'dec'
                                        FROM attendance WHERE attendance.attendance_dept_id = '$dept' AND YEAR(attendance.attendance_date) = '$year'");
            return $query->result();
        }
    }
    public function get_employee_gender($dept = "NULL"){
        if($dept == "NULL"){
            echo "<b>ERROR: Invalid Parameters<b>";
            return;
        }else{
            $this->load->database();
            // will return data in male_cnt and female_cnt columns
            $query = $this->db->query("SELECT COUNT(case WHEN faculty.faculty_gender = 'M' THEN 1 END) AS male_cnt, COUNT(case WHEN faculty.faculty_gender = 'F' THEN 1 END) AS female_cnt FROM faculty WHERE faculty.faculty_dept_id = '$dept'");
            return $query->result();
        }
    }
    public function get_employee_dept(){
            $this->load->database();
            $query = $this->db->query("SELECT COUNT(*) as 'count', dept.dept_initial FROM faculty INNER JOIN dept ON faculty.faculty_dept_id = dept.dept_id GROUP BY dept.dept_initial");
            return $query->result();
    }
}