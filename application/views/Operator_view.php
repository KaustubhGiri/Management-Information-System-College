
	<script type="text/javascript">
		$(document).ready(function(){
			$('#opv_upp_sel_tex_2').change(function(){
				var dept_id=$('#opv_upp_sel_tex_2').val();
				if(dept_id!=""){
					$.ajax({
						url:"Operator_Controller/fetch_scheme",
						type:"POST",
						data:{dept_id:dept_id},
						dataType:"json",
						success:function(data){
							$('#opv_upp_sel_tex_3').empty();
							$('#opv_upp_sel_tex_3').append('<option value="">Select Scheme</option>');
							$.each(data,function(key,value){
								$('#opv_upp_sel_tex_3').append('<option value="'+value.scheme_id+'">'+value.scheme_year+'</option>')
							});
						}
					})
					$.ajax({
						url:"Operator_Controller/fetch_shift",
						type:"POST",
						data:{dept_id:dept_id},
						dataType:"json",
						success:function(data){
							$('#opv_upp_sel_tex_6').empty();
							$('#opv_upp_sel_tex_6').append('<option value="">Select Shift</option>');
							$('#opv_upp_sel_tex_6').append('<option value="FS">FS</option>');
							$.each(data,function(key,value){
								if(value.dept_shift == '2'){
									$('#opv_upp_sel_tex_6').append('<option value="SS">SS</option>')
								}
							});
						}
					})
				}
			});

			$('#opv_upp_sel_tex_3').change(function(){
				var schene_id=$('#opv_upp_sel_tex_3').val();
				var dept_id=$('#opv_upp_sel_tex_2').val();
				if(schene_id!=""){
					$.ajax({
						url:"Operator_Controller/fetch_semester",
						type:"POST",
						data:{schene_id:schene_id, dept_id:dept_id},
						dataType:"json",
						success:function(data){
							$('#opv_upp_sel_tex_4').empty();
							$('#opv_upp_sel_tex_4').append('<option value="">Select Semester</option>');
							$.each(data,function(key,value){
								$('#opv_upp_sel_tex_4').append('<option value="'+value.semester_number+'">'+value.semester_number+'</option>')
							});
						}
					})
				}
			});

			$('#opv_upp_sel_tex_4').change(function(){
				var sem_num=$('#opv_upp_sel_tex_4').val();
				var dept_id=$('#opv_upp_sel_tex_2').val();
				if(sem_num!=""){
					$.ajax({
						url:"Operator_Controller/fetch_course",
						type:"POST",
						data:{sem_num:sem_num, dept_id:dept_id},
						dataType:"json",
						success:function(data){
							$('#opv_upp_sel_tex_5').empty();
							$('#opv_upp_sel_tex_5').append('<option value="">Select Course</option>');
							$.each(data,function(key,value){
								$('#opv_upp_sel_tex_5').append('<option value="'+value.course_id+'">'+value.course_name+' ('+value.course_code+')</option>')
							});
						}
					})
				}
			});
		});
	</script>
<div class="wrapper">
    <div class="upper" id="upper">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
		    <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
		    <script type="text/javascript" src="<?php echo base_url(); ?>js/operator.js"></script>
		<form method="post" action="">
		<table class="table" id="table">
			<h4 class="titleofpage">Semester Theory Marks Entry</h4>
			<tr class="tr">
				<td class="td">
					<label for="opv_upp_sel_tex_1" id="opv_upp_lab_tex_1">Operator</label>
				</td>
				<td class="td">
				<select name="operator" id="opv_upp_sel_tex_1">
					<option value="" >Select Operator </option>
					<option value="1">Operataor I</option>
					<option value="2">Operataor II</option>
				</select><br><br>
			</td>
			</tr>
			<tr class="tr">
				<td class="td">
					<label for="opv_upp_sel_tex_2" id="opv_upp_lab_tex_2">Department</label>
				</td>
			<td class="td">
				<select name="department" id="opv_upp_sel_tex_2">
					<option value="" >Select Department</option>
					<?php	foreach($get_department as $key=>$value) {?>
						<option value="<?php echo $value->dept_id; ?>"><?php echo$value->dept_name;?></option>
					<?php   } ?>
				</select><br><br>
			</td>
			</tr>

			<tr class="tr">
				<td class="td">
					<label for="opv_upp_sel_tex_3" id="opv_upp_lab_tex_3">Scheme</label>
				</td>
			<td class="td">
				<select name="scheme" id="opv_upp_sel_tex_3">
					<option value="" >Select Scheme </option>
				</select><br><br>
			</td>
			</tr>
				

			<tr class="tr">
				<td class="td">
					<label for="opv_upp_sel_tex_4" id="opv_upp_lab_tex_4">Semester</label>
				</td>
			<td class="td">
				<select name="semester" id="opv_upp_sel_tex_4">
					<option value="" >Select Semester</option>
				</select><br><br>
			</td>
			</tr>


			<tr class="tr">
				<td class="td">
					<label for="opv_upp_sel_tex_5" id="opv_upp_lab_tex_5">Course</label>
				</td>
			<td class="td">
				<select name="course" id="opv_upp_sel_tex_5">
					<option value="" >Select Course</option>
				</select><br><br>
			</td>
			</tr>			


			<tr class="tr">
				<td class="td">
					<label for="opv_upp_sel_tex_6" id="opv_upp_lab_tex_6">Shift</label>
				</td>
			<td class="td">
				<select name="shift" id="opv_upp_sel_tex_6">
					<option value="" >Select Shift</option>
				</select><br><br>
			</td>
			</tr>
			<tr class="tr">
				<td class="td">
				</td>
				<td class="td">
					<input type="submit" class="btn btn-success" name="submit" value="Submit" id="opv_upp_inp_sub_1" disabled><br><br>
				</td>
				
			</table>
		</form>
		<form method="post" action="">
			<?php if(isset($course_id)) {?>
				<input type="hidden" name="course_id_get" value="<?php echo $course_id ?>">
			<?php } if(isset($enroll_no)){ ?>		
				<input type="hidden" name="operator_final" value="<?php echo $get_operator ?>">
				<table>
					<tr>
						<th>Student Enrollment Number</th>
						<th>Marks Gain</th>
					</tr>
					<?php $count = 0; foreach ($enroll_no as $key =>$value) { ?>			
						<tr>			
							<input type="hidden" name="tableRow[<?php echo $count;?>][sem_internal_id]" value="<?php echo $value->sem_internal_id; ?>">
							<td>
								<input type="hidden" name="tableRow[<?php echo $count;?>][student_id]"  value="<?php echo $value->sem_internal_student_id; ?>" required>
								<?php echo  $value->student_enrollmentno; ?>
							</td>
							<td>
								<input type="number" name = "tableRow[<?php echo $count;?>][marks]" required>
							</td>
						</tr>
					<?php $count ++; } ?>
				</table>
				<br>
				<br>
				<input type="submit" class="btn btn-success" name="marks_submit" value="Submit"><br><br>
			<?php } ?>
		</form>
	</div>
</div>