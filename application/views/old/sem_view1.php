<?php error_reporting(0);?>
<!DOCTYPE html>
<html>
	<head>
		<title>final marks</title>
			<style>
				body {
				    width:100%;
				}
		</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
		$('#sc_id').change(function()
		{ 	
		var sc_id=$('#sc_id').val();
		alert(sc_id);
		if(sc_id!="")
		{
			$.ajax({

				url:"Sem_controller1/fetch_sem_id",
				method:"POST",
				success:function(data)
				{	alert("success");
					$('#semid').html(data);
				}
				
			})

		}
	});
		$('#semid').change(
		function()
		{ 	
		var sem_id=$('#semid').val();
		var sc_id=$('#sc_id').val();
		alert(sem_id);
		alert(sc_id);
		if(sem_id!="")
		{
			$.ajax({

				url:"Sem_controller1/fetch_c_id",
				method:"POST",
				data:{sem_id:sem_id,sc_id:sc_id},
				success:function(data)
				{	alert("success");
					$('#cid').html(data);
				}
				
			})//ajax end


			$.ajax({

				url:"Sem_controller1/fetch_sem_type",
				method:"POST",
				data:{sem_id:sem_id},
				success:function(data)
				{	alert("success");
					$('#sem_type').html(data);
				}
				
			})
			}



	});

					});
	</script>
	</head>
	<body>
		<legend align="center">
            <fieldset>
            	<form method="post">
					<label for="scheme_id"><b>Scheme :</b></label>
					<select name = "scheme_id" id="sc_id">
			            <option value="NULL">-Select Scheme-</option>
			            <?php foreach ($scheme as $key => $value) { ?>
			                <option value="<?php echo $value->scheme_id; ?>"><?php echo $value->scheme_year; ?></option>
			            <?php } ?>
			             </select> </br></br>
			        <label for="semister_id" >Semister number:</label>
				    <select name="semister_id" id="semid">
				    	<option value="NULL">select semister</option>
				    </select><br><br>


				    <label for="sem_number" ><b>Semister type :</b></label>
				    <select name = "sem_number" id="sem_type">
			            <option value="NULL">Select semister</option>
			        </select> </br><br>

				    <label for="course_id" ><b>Course :</b></label>
				    <select name = "course_id" id="cid">
			            <option value="NULL">Select Course</option>
			        </select> </br><br>



			 			<legend align="center">
            			<fieldset>	
			 				<table align="center">
							    	<tr>
							    		<td>Enrollment No.</td>
							    		<td>Theory Marks</td>
							    		<td>Oral marks</td>
							    		<td>Practicle marks</td>
							    		<td>Term Work</td>
							    		<td>average	 marks</td>
							    		<td>out marks</td>
							    		<td>Pass/fail</td>
							    	</tr>
							    	<tr><br>
							    		<?php $count = 0; foreach ($std_en as $key => $value) { ?>
										<td >
											<input type="hidden" name="tableRow[<?php echo $count;?>][student_id]"  value="<?php echo $value->student_id; ?>"    required><?php echo  $value->student_enrollmentno;  ?>
										</td>
										<td>
											<input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][sem_marks_th]" required><span class="text-danger"><?php echo form_error("sem_marks_th")?></span>
										</td>
										<td>
											<input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][sem_marks_or]"
											value=""tableRow[<?php echo $count;?>][sem_marks_or]"" required><span class="text-danger"><?php echo form_error("sem_marks_or")?></span>
										</td>
										<td>
											<input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][sem_pr]" required><span class="text-danger"><?php echo form_error("sem_pr")?></span>
										</td>
										<td>
											<input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][sem_marks_tw]" required><span class="text-danger"><?php echo form_error("sem_marks_tw")?></span>
										</td>
										<td>
											<!--<input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][sem_ut_avg]" required><span class="text-danger"><?php echo form_error("sem_ut_avg")?></span>-->
											<input type="hidden" name="tableRow[<?php echo $count;?>][sem_ut_avg]"  value="<?php echo $value9->$utf; ?>"    required><?php echo  $value9->$utf;  ?>

										</td>
										<td>
											<input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][sem_outof]" required><span class="text-danger"><?php echo form_error("sem_outof")?></span>
										</td>
										<td>
											<input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][sem_pass]" required><span class="text-danger"><?php echo form_error("sem_pass")?></span>
										</td>
							    	</tr>
							    	<?php $count ++; } ?>
						    </table><br>
						</fieldset>
       				</legend>
					<input type="submit" name="sub" /> <br/><br/>
				</form>
			</fieldset>
        </legend>
	</body>
</html>