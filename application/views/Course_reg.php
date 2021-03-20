<div class="wrapper">
    <div class="upper" id="upper">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/course_reg.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

function myFunction()
{
    $('#cor_upp_sel_tex_1').hide();
    $('#cor_upp_inp_sub_2').hide();
}
$(document).ready(function(){

   
    $('#cor_upp_inp_tex_1').keydown(function (e){
    if(e.keyCode == 13){
        alert('Please click the submit button');
    }
    });
    $('#cor_upp_sel_tex_2').change(function(){
        $('#cor_upp_inp_sub_2').hide();
    });

    $('#cor_upp_inp_sub_1').click(function(){
        var x = document.getElementById("cor_upp_inp_tex_1").value;
        if(x!='')
        {
            $.ajax({
                url:"course_reg_controller/fetch_student_id",
                type:"POST",
                dataType:"json",
                data:{x:x},
                success:function(data){
                  $('#cor_upp_sel_tex_1').empty();
                  $.each(data,function(key,value){
                $('#cor_upp_sel_tex_1').append('<option value="'+value.student_id+'" selected>'+value.student_id+'</option>');
                  });  
                }
            })
        }

    });

    $('#cor_upp_inp_sub_1').click(
        function()
        {
        var enrollment_num = document.getElementById("cor_upp_inp_tex_1").value;
        var scheme_num = $('#cor_upp_sel_tex_2').val();;
        if(scheme_num!='')
        { 
            $.ajax({
                    type:"POST",
                    url:"course_reg_controller/fetch_table",
                    dataType:"json",
                    data:{enrollment_num:enrollment_num,scheme_num:scheme_num},
                    success:function(data)
                    {
                        var count=0;
                        $('#cor_upp_tab_2').empty();
                        $('#cor_upp_tab_2').append('<tr><th>Count</th><th>Name</th><th>Code</th><th>Lectures</th><th>Practicals</th><th>Tutorials</th><th>Teaching hrs</th><th>TH</th><th>TS</th><th>PR</th><th>OR</th><th>TW</th><th>Credit</th><th>Level</th><th>Scheme id</th><th>Total marks</th><th>Add Course</th></tr>');
                        $.each(data,function(key,value){
                            $('#cor_upp_tab_2').append('<tr>'+
                            '<td>'+(count)+'</td>'+
                            '<td>'+value.course_name+'</td>'+
                            '<td>'+value.course_code+'</td>'+
                            '<td>'+value.course_lectures+'</td>'+
                            '<td>'+value.course_practicals+'</td>'+
                            '<td>'+value.course_tutorials+'</td>'+
                            '<td>'+value.course_total_teaching_hrs+'</td>'+
                            '<td>'+value.course_th+'</td>'+
                            '<td>'+value.course_ts+'</td>'+
                            '<td>'+value.course_pr+'</td>'+
                            '<td>'+value.course_or+'</td>'+
                            '<td>'+value.course_tw+'</td>'+
                            '<td>'+value.cource_credit+'</td>'+
                            '<td>'+value.course_level+'</td>'+
                            '<td>'+value.course_scheme_id+'</td>'+
                            '<td>'+value.course_total_marks+'</td>'+
                            '<td>'+'<input type=checkbox name="tableRow['+count+'][course_reg_course_id]" value="'+value.course_id+'"</td>'+'</tr>');
                            count++;
                        });
                        $('#cor_upp_inp_sub_2').show();
                    }
                    
                })//ajax end
        }
    });
});
</script>
  <body onload="myFunction()">
<h4 class="titleofpage"> Course Registration</h4><br/>
<form action="" method="POST" target='_blank'>
            <table class="table" id="cor_upp_tab_1">
                <tr class="tr">
                    <td class="td">
                        <label for="cor_upp_inp_tex_1" id="cor_upp_lab_tex_1" class="cor_upp_lab_tex" >Student Enrollment No :&nbsp </label><br><br>
                    </td>
                    <td class="td">
                        <input name="student_id"  type="text" id="cor_upp_inp_tex_1" class="cor_upp_inp_tex" onkeyup="AutoUpper(this.id);" autofocus required><br><br>
                    </td>
                    <td class="td">
                        <span id='cor_upp_spa_enr' class="alert">Please enter proper Enrollment Number.</span><br>
                    </td>
                    
                    <td class="td">
                        <select name="course_reg_student_id" id="cor_upp_sel_tex_1" class="cor_upp_sel_tex">
                        
                        </select><br><br>
                    </td>
                </tr>
                <tr class="tr">
                    <td class="td">
                        <label for="cor_upp_sel_tex_2" id="cor_upp_lab_tex_3" class="cor_upp_lab_tex">Semester :</label>
                    </td>
                    <td class="td">
                        <select name="sem_no" id="cor_upp_sel_tex_2" class="cor_upp_inp_tex">
                            <option value="">Select Semester</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </td>
                </tr>
                <tr class="tr">
                    <td class="td">
                        <input type="button" name="submit" id="cor_upp_inp_sub_1" class="cor_upp_inp_sub btn btn-primary sig_con_but_sub" value="Get Course" disabled>
                    </td>
                </tr>
            </table><br><br>           
        <table  class="cor_upp_tab" id="cor_upp_tab_2">
        </table>
    <br><br>
    <input type="submit" style="margin-left:60%;" name="submit" id="cor_upp_inp_sub_2" class="cor_upp_inp_sub btn btn-primary sig_con_but_sub" value="Submit">
</form>
    </div> 
</div>
