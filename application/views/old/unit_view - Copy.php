<?php
	error_reporting(0);
?><!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
//script start
$(document).ready(function()
{
	$('#scid').change(
	function()
	{ 	
		var sc_id=$('#scid').val();
		//alert(sc_id);
		if(sc_id!="")
		{
			$.ajax({

				url:"unit/fetch_course",
				method:"POST",
				data:{sc_id:sc_id},
				success:function(data)
				{	//alert("success");
					$('#cid').html(data);
				}

			})//ajax end


		}



	});


});
//script end
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
<body>
	<form method="post" action="" class="modal-content">
		<div class="container">
		<?php echo $unit ?>
		Scheme-Name :
			<select name = "scheme_id" id="scid">
				<option value="">Select Option</option>
				
				<?php foreach ($scheme as $key => $value) { ?>

					<option value="<?php echo $value->scheme_id; ?>"><?php echo $value->scheme_year; ?></option>

				<?php } ?>
			</select><br><br>
		<label>Department-Name</label>
        <select name="dept_id">
					<option value="">Select Option</option>
					<?php foreach ($dept as $key => $value) { ?>
          					<option value="<?php echo $value->dept_id; ?>"><?php echo $value->dept_name; ?></option>
        			<?php } ?>
			</select><br><br>  
		Course-Name :
			<select name = "course_id" id="cid">
				<option value="">Select Option</option>
		<?php foreach ($course as $key => $value) { ?>

      <option value="<?php echo $value->course_id; ?>"><?php echo $value->course_name;?></option>
				
				<?php } ?>
			
			</select><br><br>
		Semester:
			<select name = "semister_id" >
				<option value="">Select Option</option>
				<?php foreach ($sem as $key => $value) { ?>
          			<option value="<?php echo $value->semister_id; ?>"><?php echo $value->semister_type; ?></option>
        		<?php } ?>
			</select><br><br>
			Unit Test Type:
			<select name="ut_type">
				<option value="1">First Unit Test</option>
				<option value="2">Second Unit Test</option>
			</select><br><br>
		
				
		    <table>
 					<tr>
		    			<th>Student Enrollment No.</th>
		    			<th>Marks Gain</th> 
		    			<th>Total Marks</th>
  					</tr>
  					<tr>
						<?php $count = 0; foreach ($std_en as $key => $value) { ?>
						<td ><input type="hidden" name="tableRow[<?php echo $count;?>][student_id]"  value="<?php echo $value->student_id; ?>"    required><?php echo  $value->student_enrollmentno;  ?></td>
						<td><input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][marks]" required><span class="text-danger"><?php echo form_error("marks")?></span></td>
						<td><input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][total_marks]" required></td>
   						
 					</tr>
 					<?php $count ++; } ?>
 			</table>
			<br>
			<div>
        		<button type="submit" name="submit" class="uni">Submit</button>		    
         	</div>
      	</div>
	</form>
</body>
</html>
