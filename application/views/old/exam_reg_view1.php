<?php
	//error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	 function myFunction() {

     $('#submit_registration').hide();
}
$(document).ready(function(){

	$('#student_enrollment').keydown(function (e){
    if(e.keyCode == 13){
        alert('Please click the submit button');

    }
	});

	 $('#submit').click(
        function()
        {
        var enrollmentno = document.getElementById("student_enrollment").value;
        alert(enrollmentno);
       	if(enrollmentno!='')
        { alert("hello");
            $.ajax({
                url:"exam_reg1/fetch_table",
                data:{enrollmentno:enrollmentno},
                method:"POST",
                success:function(data)
                {
                    alert("suceeeeeyss");
                    $('#table').html(data);
					$('#submit_registration').show();
                }
            })
        }

    });
});
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
	</style>
</head>
<body onload="myFunction()">
	
	<form method="post" action="" >
		<tr>
			<td>Enrollment no :</td>
			<td><input type="text" name="student_enrollment" id="student_enrollment" ></td>
			<td><button type="button" id="submit">submit</button></td>  
    	</tr>

<br>
   <table id="table">	
   	<tr>
        	
        </tr>
   </table>
 	<br>
    <input type="submit" name="submit_registration" value="Confirm Registration" id="submit_registration">
</form>

</html>