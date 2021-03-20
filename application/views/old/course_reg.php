!<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
-->  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    function myFunction() {
    // $('#hide').hide();
    // $('#student_id').hide();
}
$(document).ready(function(){
    $('#sc').change(
        function()
        {
        var sc_id=$('#sc').val();
        var x = document.getElementById("s_enroll").value;
        alert(sc_id);
        if(x!='')
        {alert("inside x")
            $.ajax({
                url:"course_reg_controller/fetch_student_id",
                method:"POST",
                data:{x:x},
                success:function(data)
                {
                    alert("suceeeeeyss");
                    $('#student_id').html(data);
                     

                }
            })  
        }
        if(sc_id!='')
        { //alert("hello");
            $.ajax({
                url:"course_reg_controller/fetch_sem",
                method:"POST",
                success:function(data)
                {
                    alert("suceeeeeyss fetch_sem");
                    $('#semester').html(data);
                }
            })
        }
    });
    $('#semester').change(
        function()
        {
        var sc_id=$('#semester').val();
        var scid=$('#sc').val();
        var x = document.getElementById("student_id").value;
        alert(sc_id);
        if(x=='')
        {
            alert("enter proper enrollment no");
        }
        if(sc_id!='')
        { alert("hello");
            $.ajax({
                url:"course_reg_controller/fetch_table",
                data:{sc_id:sc_id,scid:scid},
                method:"POST",
                success:function(data)
                {
                    alert("suceeeeeyss");
                    $('#table').html(data);
                }
            })
        }
    });
});
</script>
  </head>
  <body onload="myFunction()">
    <div id="upper">
        <form action="" method="POST">
            <table>
                <tr>
                    <td><label  >Student Enrollment NO:</label></td>
                    <td><input name="student_id"  type="text" id="s_enroll"></td>
                </tr>
                <td id = "hide"><label >Student id</label></td>
                    <td>
                        <select name="course_reg_student_id" id="student_id" >
                            
                        </select>
                    </td>
                <tr>
                    <td><label >Scheme:</label></td>
                    <td>
                        <select name="course_reg_scheme_id" id="sc">
                        <option>select scheme</option>
                       <?php foreach ($scheme as $key => $value) {?>
                       <option value="<?php echo $value->scheme_id;?>"><?php echo $value->scheme_year;?></option>
                           # code...
                           <?php
                       }?>
                           
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Semester:</label></td>
                    <td>
                        <select name="sem_no" id="semester">
                        <!--<option value="">select option</option>-->
                        </select>
                    </td>
                </tr>
                       
<table style="border: 1px solid black" id="table">
                <tr>
                    <th>Course Id</th>
                    <th>Course Name</th>
                    <th>Course Code</th>
                    <th>Course lec</th>
                    <th>Course pra</th>
                    <th>Course tuto</th>
                    <th>Course tech hrs</th>
                    <th>Course th</th>
                    <th>Course ts</th>
                    <th>Course pr</th>
                    <th>Course or</th>
                <th>Course tw</th>
                <th>Course credit</th>
                <th>Course Level</th>
                <th>Course scheme id</th>
                <th>course total marks</th>
                <th>Add Course</th>
                </tr>

            </table>

    <br><br>
    <input type="submit" name="submit" id="submit">
     </form>
</html>