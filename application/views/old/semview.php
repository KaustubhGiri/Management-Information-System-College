<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 error_reporting(0);
?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
//script start
/*------------------------------------------------------------------------------------------------------------------*/
$(document).ready(function()
{   //choosing scheme on basis of dept 
    $('#sid').change(
    function()
    {   
        var s_id=$('#sid').val();
        //alert(s_id);
        if(s_id!="")
        {
            $.ajax({

                url:"semcontroller/fetch_sc_id",
                method:"POST",
                data:{s_id:s_id},
                success:function(data)
                {
                    $('#sc_id').html(data);
                }
                
            })//ajax end

            }



    });
    
    //choosing sem on basis of scheme 

  $('#sc_id').change(
    function()
    {
       var sem_id=$('#sid').val();
        var sc_id=$('#sc_id').val();

        //alert(sem_id);
        //alert(sc_id);
        if(sem_id!="")
        {
            $.ajax({

                url:"semcontroller/fetch_c_id",
                method:"POST",
                data:{sc_id:sc_id},
                success:function(data)
                {
                    $('#cid').html(data);
                }
                
            })//ajax end

            }

    });
});


/*------------------------------------------------------------------------------------------------------------------*/

</script>


    <style>
            table {
                width:100%;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 15px;
                text-align: left;
            }
            table#t01 tr:nth-child(even) {
                background-color: #eee;
            }
            table#t01 tr:nth-child(odd) {
               background-color: #fff;
            }
            table#t01 th {
                background-color: black;
                color: white;
            }
            form{
                overflow: scroll;
                text-align: center;
                margin: 20px;
                
            }
    </style>
    </head>
    <body>
    <form method="post" action="">
    <?php echo $data ?> 

        <label>Semister Number:</label> 
        <select name="semister_number" id="sid">
            <option value="">Select Semister Number</option>
            <option value="1">1st</option>
            <option value="2">2nd</option>
            <option value="3">3rd</option>
            <option value="4">4th</option>
            <option value="5">5th</option>
            <option value="6">6th</option>
        </select><br><br>

    <label>Scheme: </label>
        <select name = "semister_scheme_id" id="sc_id">
            <option value="">Select Option</option>
            <?php foreach ($scheme as $key => $value) { ?>
            <option value="<?php echo $value->scheme_id; ?>"><?php echo $value->scheme_year; ?>
        </option>
    <?php } ?>
	</select>
    <br><br>
    <table id="cid">
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
    <input type="submit" name="submit">
    
    </form>    
    </body>
</html>