<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
$(document).ready(function()
{   //choosing scheme on basis of dept 
    $('#sem_upp_sel_sem_1').change(
    function()
    {   
        var s_id=$('#sem_upp_sel_sem_1').val();
        //alert(s_id);
        if(s_id!="")
        {
            $.ajax({
                type:"POST",
                url:"semcontroller/fetch_sc_id",
                dataType:"json",
                data:{s_id:s_id},
                success:function(data)
                {
                    $('#sem_upp_sel_sem_2').empty();
                    $('#sem_upp_sel_sem_2').append('<option>select scheme</option>');
                    $.each(data,function(key,value)
                    {
                        $('#sem_upp_sel_sem_2').append('<option value="'+value.scheme_id+'">'+value.scheme_year+'</option>');
                    });
                }
                
            })//ajax end
            }
    });
    
    //choosing sem on basis of scheme 

  $('#sem_upp_sel_sem_2').change(
    function()
    {
       var sem_id=$('#sem_upp_sel_sem_1').val();
        var sc_id=$('#sem_upp_sel_sem_2').val();

        //alert(sem_id);
        //alert(sc_id);
        if(sem_id!="")
        {
            $.ajax({

                url:"semcontroller/fetch_c_id",
                type:"POST",
                data:{sc_id:sc_id},
                dataType:"json",
                success:function(data)
                {
                    $('#sem_upp_tab_tex2').empty();
                    var count=0;
                    $('#sem_upp_tab_tex2').append('<tr>  <th>Course Id</th><th>Course Name</th><th>Course Code</th><th>Course lec</th><th>Course pra</th><th>Course tuto</th><th>Course tech hrs</th><th>Course th</th><th>Course ts</th><th>Course pr</th><th>Course or</th><th>Course tw</th><th>Course credit</th><th>Course Level</th><th>Course scheme id</th><th>course total marks</th><th>Add Course</th></tr>');
                    $.each(data, function(key,value){

                        $('#sem_upp_tab_tex2').append('<tr>'+
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
                            '<td>'+'<input type=checkbox name="tableRow['+(count)+'][semester_course_id]" value="'+ value.course_id+'"</td>'+'</tr>');

                        count++;
                    });
                }
                
            })//ajax end

            }

    });
});
</script>
    <style>
            /*below css is used for validation and written by Bimalesh*/
            #sem_upp_tab_tex2,#sem_upp_inp_sub_1{display: none;}
    </style>
</head>
        <div class="wrapper">
            <div class="upper" id="upper">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
                <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
                <script type="text/javascript" src="<?php echo base_url(); ?>js/sem.js"></script>
                <h4 class="titleofpage">Add New Semester</h4><br/>
    <form method="post" action="">
  <!--   <?php echo $data ?>  -->
    <table id="sem_upp_tab_tex1" class="table">
        <tr class="tr">
            <td class="td">
                <label for="sem_upp_sel_sem_1" class="sem_upp_lab_txt" id="sem_upp_lab_txt_1">Semester:</label><br><br>
            </td>
            <td class="td">
                <select name="semester_number" class="sem_upp_sel_sem" id="sem_upp_sel_sem_1" required>
                    <option value="">Select</option>
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
                    <option value="5">5th</option>
                    <option value="6">6th</option>
                </select><br><br>
            </td>
        </tr>
        <tr class="tr">
            <td class="td">    
                <label for="sem_upp_sel_sem_2" class="sem_upp_lab_txt" id="sem_upp_lab_txt_2">Scheme:</label><br><br>
            </td>
            <td class="td">
                <select name="semester_scheme_id" class="sem_upp_sel_sem" id="sem_upp_sel_sem_2" required>
                        <option value="">Select</option>
                        <?php foreach ($scheme as $key => $value) { ?>
                        <option value="<?php echo $value->scheme_id; ?>"><?php echo $value->scheme_year; ?>
                        </option>
                        <?php } ?>
	           </select><br><br>
            </td>
        </tr>
    </table>
    <br><br>
    <table id="sem_upp_tab_tex2" class="table">
                <tr class="tr">
                    <th class="th">Name</th>
                    <th class="th">Code</th>
                    <th class="th">Lectures</th>
                    <th class="th">Practicals</th>
                    <th class="th">Tutorials</th>
                    <th claas="th">Teaching hrs</th>
                    <th class="th">TH</th>
                    <th class="th">TS</th>
                    <th class="th">PR</th>
                    <th class="th">OR</th>
                    <th class="th">TW</th>
                    <th class="th">Credit</th>
                    <th class="th">Level</th>
                    <th class="th">Scheme id</th>
                    <th class="th">Total Marks</th>
                    <th class="th">Add Course</th>
                </tr>

    </table> 

    <br><br>   
            <input type="submit" style="margin-left:60%;" name="submit" class="btn btn-success" id="sem_upp_inp_sub_1" value="Submit">
    </form>    
    </div>
</div>
