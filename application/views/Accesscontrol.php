<style type="text/css">
    p
    {
        color: initial;
        font-style: normal;
    }
</style>
<div class="wrapper">
<div class="upper" id="upper">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
           $(document).ready(function(){
            $('#upp_sel_tex_1').change(function(){
                var access = $('#upp_sel_tex_1').val();
                $.ajax({
                    url:"accesscontrol/fetch_access",
                    type:"POST",
                    dataType:"json",
                    data:{access:access},
                    success:function(data)
                    {
                        $('#table').empty();
                        $.each(data,function(key,value){
                            if(value.admit_student==1)
                            {
                            $('#table').append('<p>student admission</p><input type="radio" name="student_admission" value="1" checked>Yes<br><input type="radio" name="student_admission" value="0">No<br>');
                            }
                            else
                            {
                            $('#table').append('<p>cancel student admission</p><input type="radio" name="student_admission" value="1">Yes<br><input type="radio" name="student_admission" value="0" checked>No<br>'); 
                            }
                            // for admission cancel
                            if(value.admission_cancel==1)
                            {
                            $('#table').append('<p>cancel student admission</p><input type="radio" name="cancel_student_admission" value="1" checked>Yes<br><input type="radio" name="cancel_student_admission" value="0">No<br>');
                            }
                            else
                            {
                            $('#table').append('<p>cancel student admission</p><input type="radio" name="cancel_student_admission" value="1">Yes<br><input type="radio" name="cancel_student_admission" value="0" checked>No<br>');  
                            }

                            // // for course management
                            if(value.course_management==1)
                            {
                            $('#table').append('<p>course management</p><input type="radio" name="course_management" value="1" checked>Yes<br><input type="radio" name="course_management" value="0">No<br>');
                            }
                            else
                            {
                            $('#table').append('<p>course management</p><input type="radio" name="course_management" value="1">Yes<br><input type="radio" name="course_management" value="0" checked>No<br>'); 
                            }  

                            // // for course registration
                            if(value.course_registration==1)
                            {
                            $('#table').append('<p> course registration</p><input type="radio" name="course_registration" value="1" checked>Yes<br><input type="radio" name="course_registration" value="0">No<br>');
                            }
                            else
                            {
                            $('#table').append('<p> course registration</p><input type="radio" name="course_registration" value="1">Yes<br><input type="radio" name="course_registration" value="0" checked>No<br>');   
                            } 

                            // // for department management
                            if(value.add_department==1)
                            {
                            $('#table').append('<p>department management</p><input type="radio" name="department_management" value="1" checked>Yes<br><input type="radio" name="department_management" value="0">No<br>');
                            }
                            else
                            {
                            $('#table').append('<p>department management</p><input type="radio" name="department_management" value="1">Yes<br><input type="radio" name="department_management" value="0" checked>No<br>'); 
                            } 

                            // // for exam registration
                            if(value.exam_registration==1)
                            {
                            $('#table').append('<p>exam registration</p><input type="radio" name="exam_registration" value="1" checked>Yes<br><input type="radio" name="exam_registration" value="0">No<br>');
                            }
                            else
                            {
                            $('#table').append('<p>exam registration</p><input type="radio" name="exam_registration" value="1">Yes<br><input type="radio" name="exam_registration" value="0" checked>No<br>'); 
                            } 

                            // // for add scheme
                            if(value.add_scheme==1)
                            {
                            $('#table').append('<p>add scheme</p><input type="radio" name="add_scheme" value="1" checked>Yes<br><input type="radio" name="add_scheme" value="0">No<br>');
                            }
                            else
                            {
                            $('#table').append('<p>add scheme</p><input type="radio" name="add_scheme" value="1">Yes<br><input type="radio" name="add_scheme" value="0" checked>No<br>');    
                            } 

                            // // for add semester
                            if(value.add_semester==1)
                            {
                            $('#table').append('<p>add semester</p><input type="radio" name="add_semester" value="1" checked>Yes<br><input type="radio" name="add_semester" value="0">No<br>');
                            }
                            else
                            {
                            $('#table').append('<p>add semester</p><input type="radio" name="add_semester" value="1">Yes<br><input type="radio" name="add_semester" value="0" checked>No<br>');  
                            } 

                            // for add faculty
                            if(value.add_user==1)
                            {
                            $('#table').append('<p>add faculty</p><input type="radio" name="add_faculty" value="1" checked>Yes<br><input type="radio" name="add_faculty" value="0">No<br>');
                            }
                            else
                            {
                            $('#table').append('<p>add faculty</p><input type="radio" name="add_faculty" value="1">Yes<br><input type="radio" name="add_faculty" value="0" checked>No<br>');   
                            } 

                            // for access control
                            if(value.accesscontrol_management==1){
                                $('#table').append('<p>access control</p><input type="radio" name="access_control" value="1" checked>Yes<br><input type="radio" name="access_control" value="0">No<br>');
                            }else{
                                $('#table').append('<p>access control</p><input type="radio" name="access_control" value="1">Yes<br><input type="radio" name="access_control" value="0" checked>No<br>');    
                            }
                            //================================
                            if(value.attendance==1){
                                $('#table').append('<p>Add Attendance</p><input type="radio" name="add_attendance" value="1" checked>Yes<br><input type="radio" name="add_attendance" value="0">No<br>');
                            }else{
                                $('#table').append('<p>Add Attendance</p><input type="radio" name="add_attendance" value="1">Yes<br><input type="radio" name="add_attendance" value="0" checked>No<br>');    
                            }
                            if(value.add_messageoftheday==1){
                                $('#table').append('<p>Add message of the day</p><input type="radio" name="add_message_of_the_day" value="1" checked>Yes<br><input type="radio" name="add_message_of_the_day" value="0">No<br>');
                            }else{
                                $('#table').append('<p>Add message of the day</p><input type="radio" name="add_message_of_the_day" value="1">Yes<br><input type="radio" name="add_message_of_the_day" value="0" checked>No<br>');    
                            }
                            if(value.add_notice==1){
                                $('#table').append('<p>Add Notice</p><input type="radio" name="add_notice" value="1" checked>Yes<br><input type="radio" name="add_notice" value="0">No<br>');
                            }else{
                                $('#table').append('<p>Add Notice</p><input type="radio" name="add_notice" value="1">Yes<br><input type="radio" name="add_notice" value="0" checked>No<br>');    
                            }
                            if(value.unit_test_marks_entry==1){
                                $('#table').append('<p>Unit test marks entry</p><input type="radio" name="ut_marks_entry" value="1" checked>Yes<br><input type="radio" name="ut_marks_entry" value="0">No<br>');
                            }else{
                                $('#table').append('<p>Unit test marks entry</p><input type="radio" name="ut_marks_entry" value="1">Yes<br><input type="radio" name="ut_marks_entry" value="0" checked>No<br>');    
                            }
                            if(value.attendance_sheet_generation==1){
                                $('#table').append('<p>Attendance Sheet Generation</p><input type="radio" name="gen_attendance_sheet" value="1" checked>Yes<br><input type="radio" name="gen_attendance_sheet" value="0">No<br>');
                            }else{
                                $('#table').append('<p>Attendance Sheet Generation</p><input type="radio" name="gen_attendance_sheet" value="1">Yes<br><input type="radio" name="gen_attendance_sheet" value="0" checked>No<br>');    
                            }
                            if(value.course_wise_registration_list==1){
                                $('#table').append('<p>Coursewise Students Registration List</p><input type="radio" name="c_stud_reg_list" value="1" checked>Yes<br><input type="radio" name="c_stud_reg_list" value="0">No<br>');
                            }else{
                                $('#table').append('<p>Coursewise Students Registration List</p><input type="radio" name="c_stud_reg_list" value="1">Yes<br><input type="radio" name="c_stud_reg_list" value="0" checked>No<br>');    
                            }
                            if(value.teachers_list==1){
                                $('#table').append('<p>Teachers List</p><input type="radio" name="teachers_list" value="1" checked>Yes<br><input type="radio" name="teachers_list" value="0">No<br>');
                            }else{
                                $('#table').append('<p>Teachers List</p><input type="radio" name="teachers_list" value="1">Yes<br><input type="radio" name="teachers_list" value="0" checked>No<br>');    
                            }
                            if(value.student_admission_list==1){
                                $('#table').append('<p>Departmental Yearwise Student Admission List</p><input type="radio" name="stud_adm_list" value="1" checked>Yes<br><input type="radio" name="stud_adm_list" value="0">No<br>');
                            }else{
                                $('#table').append('<p>Departmental Yearwise Student Admission List</p><input type="radio" name="stud_adm_list" value="1">Yes<br><input type="radio" name="stud_adm_list" value="0" checked>No<br>');    
                            }
                            $('#table').append('<input type="hidden" name="update" value="update" class="upp_inp_sub"><div><input type="submit" name="submit" class="btn btn-primary sig_con_but_sub" value="submit"></div>');
 
                        });
                    }
                })
            });
           });
           
       </script>
    <div class="content">
    <h4 class="titleofpage">Access Controller</h4>
    <form action="" method="POST">
        <p>Access Level &nbsp&nbsp&nbsp
            <select name="level_number" class="upp_sel_tex" id="upp_sel_tex_1">
                <option value="">Select Level</option>
                <option value="2">2nd</option>
                <option value="3">3rd</option>
                <option value="4">4th</option>
                <option value="5">5th</option>
                <option value="6">6th</option>
            </select>
        </p>
            <br>
        
        <table class="table">
            <tr class="tr">
                <th class="th">Category</th>
                <th class="th">Yes</th>
                <th class="th">No</th>
            </tr>
            <tr class="tr">
                <td class="td"><p>Student Admission</p></td>
                <td class="td"><input type="radio" name="student_admission" value="1"></td>
                <td class="td"><input type="radio" name="student_admission" value="0"></td>
            </tr>
            <tr class="tr">
                <td class="td"><p>Cancel Student Admission</p></td>
                <td class="td"><input type="radio" name="cancel_student_admission" value="1"></td>
                <td class="td"><input type="radio" name="cancel_student_admission" value="0"></td>
            </tr>
            <tr class="tr">
                <td class="td"><p>Course Management</p></td>
                <td class="td"><input type="radio" name="course_management" value="1"></td>
                <td class="td"><input type="radio" name="course_management" value="0"></td>
            </tr>
            <tr class="tr">
                <td class="td"><p>Course Registration</p></td>
                <td class="td"><input type="radio" name="course_registration" value="1"></td>
                <td class="td"><input type="radio" name="course_registration" value="0"></td>
            </tr>
            <tr class="tr">
                <td class="td"><p>Department Management</p></td>
                <td class="td"><input type="radio" name="department_management" value="1"></td>
                <td class="td"><input type="radio" name="department_management" value="0"></td>
            </tr>
            <tr class="tr">
                <td class="td"><p>Exam Registration</p></td>
                <td class="td"><input type="radio" name="exam_registration" value="1"></td>
                <td class="td"><input type="radio" name="exam_registration" value="0"></td>
            </tr>
            <tr class="tr">
                <td class="td"><p>Add Scheme</p></td>
                <td class="td"><input type="radio" name="add_scheme" value="1"></td>
                <td class="td"><input type="radio" name="add_scheme" value="0"></td>
            </tr>
            <tr class="tr">
                <td class="td"><p>Add Semester</p></td>
                <td class="td"><input type="radio" name="add_semester" value="1"></td>
                <td class="td"><input type="radio" name="add_semester" value="0"></td>
            </tr>
            <tr class="tr">
                <td class="td"><p>Add Faculty</p></td>
                <td class="td"><input type="radio" name="add_faculty" value="1"></td>
                <td class="td"><input type="radio" name="add_faculty" value="0"></td>
            </tr>
            <tr class="tr">
                <td class="td"><p>Access Control</p></td>
                <td class="td"><input type="radio" name="access_control" value="1"></td>
                <td class="td"><input type="radio" name="access_control" value="0"></td>
            </tr>
            <tr class="tr">
                <td class="td"><p>Add Attendance</p></td>
                <td class="td"><input type="radio" name="add_attendance" value="1"></td>
                <td class="td"><input type="radio" name="add_attendance" value="0"></td>
            </tr>
           <tr class="tr">
                <td class="td"><p>Add message of the day</p></td>
                <td class="td"><input type="radio" name="add_message_of_the_day" value="1"></td>
                <td class="td"><input type="radio" name="add_message_of_the_day" value="0"></td>
          </tr>
          <tr class="tr">
                <td class="td"><p>Add Notice</p></td>
                <td class="td"><input type="radio" name="add_notice" value="1"></td>
                <td class="td"><input type="radio" name="add_notice" value="0"></td>
          </tr>
          <tr class="tr">
                <td class="td"><p>Unit test marks entry</p></td>
                <td class="td"><input type="radio" name="ut_marks_entry" value="1"></td>
                <td class="td"><input type="radio" name="ut_marks_entry" value="0"></td>
          </tr>
          <tr class="tr">
                <td class="td"><p>Attendance Sheet Generation</p></td>
                <td class="td"><input type="radio" name="gen_attendance_sheet" value="1"></td>
                <td class="td"><input type="radio" name="gen_attendance_sheet" value="0"></td>
          </tr>
          <tr class="tr">
                <td class="td"><p>Coursewise Students Registration List</p></td>
                <td class="td"><input type="radio" name="c_stud_reg_list" value="1"></td>
                <td class="td"><input type="radio" name="c_stud_reg_list" value="0"></td>
          </tr>
          <tr class="tr">
                <td class="td"><p>Teachers List</p></td>
                <td class="td"><input type="radio" name="teachers_list" value="1"></td>
                <td class="td"><input type="radio" name="teachers_list" value="0"></td>
          </tr>
          <tr class="tr">
                <td class="td"><p>Departmental Yearwise Student Admission List</p></td>
                <td class="td"><input type="radio" name="stud_adm_list" value="1"></td>
                <td class="td"><input type="radio" name="stud_adm_list" value="0"></td>
          </tr>
          <tr class="tr">
            <td class="td">
            <input type="hidden" name="update" value="update" class="upp_inp_sub">
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </td>
          </tr>
        </table>
    </form>
    </div>
</div>
</div>