<?php
	error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
/*-------------------------------------------------script start------------------------------------------------*/

//main function start
$(document).ready(function()
{	

/*---------------------------------------------------------------------------------------------------------------*/
	$('#did').change(
	//choosing scheme on basis of dept 
	function()
	{ 	
		var d_id=$('#did').val();
		alert(d_id);
		if(d_id!="")
		{
			$.ajax(
			{
				url:"unit/fetch_sc_id",
				method:"POST",
				data:{d_id:d_id},
				success:function(data)
					{	
						alert("success");
						$('#sc_id').html(data);
					}
				
			})//ajax end
		}	
	});//end of #did

/*---------------------------------------------------------------------------------------------------------------*/	 

	$('#sc_id').change(
	//choosing semtype on basis of scheme 
	//choosing  shift on basis of scheme 
	function()
	{ 	
		var sc_id=$('#sc_id').val();
		var d_id=$('#did').val();
		alert(sc_id);
		if(sc_id!="")
		{

			$.ajax({
   				url:"unit/fetch_smtype",
				method:"POST",
				data:{d_id:d_id,sc_id:sc_id},
				success:function(data)
				{	alert("success");

					$('#smt').html(data);
				}
				
			})//ajax end for #smt
		
			$.ajax({
			
			
				url:"unit/fetch_shift",
				method:"POST",
				data:{d_id:d_id,sc_id:sc_id},
				success:function(data)
				{	alert("success");

					$('#sft_id').html(data);
				}
				
			})//ajax end for #sft_id
		}
});//end of #sc_id
	
	
/*---------------------------------------------------------------------------------------------------------------*/
	
	$('#smt').change(
	//choosing semester no basis on semtype 
	function()
	{ 	

		var sm_t=$('#smt').val();

		alert(sm_t);
		if(sm_t!="")
		{
			$.ajax({     
				url:"unit/fetch_sem_id",
				method:"POST",
				data:{sm_t:sm_t},
				success:function(data)
				{	alert("success");
					$('#semid').html(data);
				}			
			})//ajax end
		}
    }); //end of #smt

	
/*---------------------------------------------------------------------------------------------------------------*/	
	
	$('#semid').change(
		//choosing course basis on semester no
	function()
	{ 	
		var sem_id=$('#semid').val();
		var sc_id=$('#sc_id').val();

		alert(sem_id);
		alert(sc_id);
		
		if(sem_id!="")
		{
			$.ajax({
      
				url:"unit/fetch_c_id",
				method:"POST",
				data:{sem_id:sem_id,sc_id:sc_id},
				success:function(data)
				{	alert("success");
					$('#cid').html(data);
				}
				
			})//ajax end
		}

	});//end of #semid

/*---------------------------------------------------------------------------------------------------------------*/

$('#sft_id').change(
	//choosing student data basis on shift
	function()
	{ 	
		var shift_id=$('#sft_id').val();
		var sc_id=$('#sc_id').val();
		var d_id=$('#did').val();

		alert(shift_id);
	
		if(shift_id!="")
		{
			$.ajax({
 
				url:"unit/fetch_std",
				method:"POST",
				data:{shift_id:shift_id , d_id:d_id , sc_id:sc_id},
				success:function(data)
				{	alert("success");
					$('#std').html(data);
				}
				
			})//ajax end
		}	
	
	});//end of #sft_id


/*---------------------------------------------------------------------------------------------------------------*/

$('#cid').change(
//choosing unit-type  basis on course 
	function()
	{ 	
		var sem_id=$('#semid').val();
		var sc_id=$('#sc_id').val();
		var c_id=$('#cid').val();

		alert(c_id);	
	
		if(sem_id!="" && sc_id!="" && c_id!="")
		{
			alert("if execute");
			$.ajax({

				url:"unit/fetch_uttype",
				method:"POST",
				data:{sem_id:sem_id , sc_id:sc_id , c_id:c_id},
				success:function(data)
				{	alert("success");
					$('#ut').html(data);
				}
				
			})//ajax end
		}
	
	});//end of #cid

/*---------------------------------------------------------------------------------------------------------------*/

});//main function end

/*--------------------------------------------Script end--------------------------------------------------------*/

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
				<label>Department-Name</label>
           <select name="dept_id" id="did">
					<option value="">Select Option</option>
					<?php foreach ($dept as $key => $value) { ?>
          	<option value="<?php echo $value->dept_id; ?>"><?php echo $value->dept_name; ?></option>
        			<?php } ?>
			</select><br><br> 
		
		Scheme-Name :

			<select name = "scheme_id" id="sc_id">
				<option value="">Select Option</option>	
			</select>


			<br><br>
		Semester Type:

			<select name = "semtype" id="smt">
				<option value="">Select Option</option>	

			</select>

		Semester No:

			<select name = "semister_id" id="semid" >
				<option value="">Select Option</option>
				
			</select>


			<br><br>

		Course-Name :

			<select name = "course_id" id="cid">
				<option value="">Select Option</option>
			</select><br><br>


		Unit Test Type:
		
			<select name="ut_type" id="ut">
				<option value="">Select Option</option>
		
			</select><br><br>


		Shift: 
			<select name = "shift_id" id="sft_id">
				<option value="">Select Option</option>	
			<!--		<option value="1">First Shift</option>
					<option value="2">Second Shift</option>
			-->
			</select><br><br>	

 		
	
				
		   <table id="std" >
 					<tr>
		    			<th>Student Enrollment No.</th>
		    			<th>Marks Gain</th> 
		    			<th>Total Marks</th>
		    			<th>Pass / Fail</th>
  					</tr>
  				
  						
  					<tr >
  							<?php $count = 0; foreach ($std_en as $key => $value) { ?>
						<td ><input type="hidden" name="tableRow[<?php echo $count;?>][student_id]"  value="<?php echo $value->student_id; ?>"    required><?php echo  $value->student_enrollmentno;  ?></td>
						
						<td><input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][marks]" required>
						<td>
						<input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][total_marks]" required></td>
						<td>
							<select name="tableRow[<?php echo $count;?>][ut_result]">
								/*<option value="1">Pass</option>
								<option value="0">Fail</option>
							</select>
						</td>

				
						
 					</tr>

 				<?php $count++; } ?>

 			</table>
			<br>
			<div>
        		<button type="submit" name="submit" class="uni">Submit</button>		    
         	</div>
      	</div>
	</form>
</body>
</html>


         	<h1>Unit Test Report</h1>
         	<div>
         		<table>
         			<tr>
         				<th>Id</th>
         				<th>Department Name</th>
         				<th>Sem Id</th>
         				<th>Course Id</th>
         				<th>Scheme Id</th>
         				<th>Student Id</th>
         				<th>Marks</th>
         				<th>Marks Out off</th>
         			</tr>
<?php 
       if ($_POST['ut_type'] == 1){
       			echo "<h2>First Unit Test Result</h2>";
         		if($fetch->num_rows() > 0){
         			foreach($fetch->result() as  $row){
?>

         			<tr>

         				<td><?php echo $row->ut1_id; ?></td>
<?php 					foreach ($department as $key =>$value) { ?>
						<td><?php echo $value->dept_name; ?></td>
<?php				    }?>
 
<?php  					foreach ($semister_name as $key=>$value) { ?>
         				<td><?php echo $value->semister_type; ?></td>
<?php 					} ?>

         
<?php  					foreach ($course_name as $key=>$value) { ?>
         				<td><?php echo $value->course_name; ?></td>
<?php 					} ?>

<?php  					foreach ($scheme_name as $key=>$value) { ?>
         				<td><?php echo $value->scheme_year; ?></td>
<?php 					} ?>

<?php 					foreach ($enroll as $key =>$value) { ?>
						<td><?php echo $value->student_enrollmentno; ?></td>
<?php						} ?>
        			
  					 <!--	<td><?php echo $row->ut1_student_id; ?></td> -->
         				<td><?php echo $row->ut1_marks; ?></td>
         				<td><?php echo $row->ut1_outof; ?></td>
         			</tr>
<?php
         			}
         		}else{
?>
         			<tr>
         				<td colspan="8">No Data Found</td>
         			</tr>
<?php 
         		}		
        }else{
        	echo "<h2>Second Unit Test Result</h2>";

         		if($fetch1->num_rows() > 0){
         			foreach($fetch1->result() as  $row){
?>
         			<tr>
         				<td><?php echo $row->ut2_id; ?></td>

  
<?php 					foreach ($department as $key =>$value) { ?>
						<td><?php echo $value->dept_name; ?></td>
<?php				    }?>
 

<?php  					foreach ($semister_name as $key=>$value) { ?>
         				<td><?php echo $value->semister_type; ?></td>
<?php 					} ?>

         			<!--	<td><?php echo $row->ut2_semister_id; ?></td> -->

<?php  					foreach ($course_name as $key=>$value) { ?>
         				<td><?php echo $value->course_name; ?></td>
<?php 					} ?>

         				<!--<td><?php echo $row->ut2_course_id; ?></td> -->
<?php  					foreach ($scheme_name as $key=>$value) { ?>
         				<td><?php echo $value->scheme_year; ?></td>
<?php 					} ?>


         				<!--<td><?php echo $row->ut2_scheme_id; ?></td> -->
<?php 					foreach ($enroll as $key =>$value) { ?>
						<td><?php echo $value->student_enrollmentno; ?></td>
<?php						} ?>         				
         				<td><?php echo $row->ut2_marks; ?></td>
         				<td><?php echo $row->ut2_outof; ?></td>
         			</tr>
<?php
         			}

         		}else{
?>
         			<tr>
         				<td colspan="8">No Data Found</td>
         			</tr>
<?php
         		}
        }
?>
         		</table>
         	</div>