
    <script type="text/javascript">
		$(document).ready(function(){
			$('#sev_upp_sel_tex_1').change(function(){
				var schene_id=$('#sev_upp_sel_tex_1').val();
				if(schene_id!=""){
					$.ajax({
						url:"Sem_Controller/fetch_semester",
						type:"POST",
						data:{schene_id:schene_id},
						dataType:"json",
						success:function(data){
							$('#uni_upp_sel_tex_2').empty();
							$('#uni_upp_sel_tex_2').append('<option value="">Select Semester</option>');
							$.each(data,function(key,value){
								$('#uni_upp_sel_tex_2').append('<option value="'+value.semester_number+'">'+value.semester_number+'</option>')
							});

						}
					})
				}
			});

			$('#uni_upp_sel_tex_2').change(function(){
				var sem_num=$('#uni_upp_sel_tex_2').val();
				if(sem_num!=""){
					$.ajax({
						url:"Sem_Controller/fetch_course",
						type:"POST",
						data:{sem_num:sem_num},
						dataType:"json",
						success:function(data){
							$('#sev_upp_sel_tex_3').empty();
							$('#sev_upp_sel_tex_3').append('<option value="">Select Course</option>');
							$.each(data,function(key,value){
								$('#sev_upp_sel_tex_3').append('<option value="'+value.course_id+'">'+value.course_name+' ('+value.course_code+')</option>')
							});

						}
					})
				}
			});

			$('#sev_upp_sel_tex_3').change(function(){
				var course_id=$('#sev_upp_sel_tex_3').val();
				if(course_id!=""){
					$.ajax({
					type:"POST",
					url:"Sem_Controller/get_dept_shift",
					data:{course_id:course_id},
					dataType:"json",
					success:function(data){	
						$('#sev_upp_sel_tex_4').empty();
						$('#sev_upp_sel_tex_4').append('<option value="" >Select Shift</option>');
						$.each(data,function(key,value){
							if(value.fs!='0'){
								$('#sev_upp_sel_tex_4').append('<option value="FS">First Shift</option>');
							}
							if(value.ss!='0'){
								$('#sev_upp_sel_tex_4').append('<option value="SS">Second Shift</option>');
							}
						});
					}
				})
				}
			});
			$('#sev_upp_sel_tex_4').change(function(){
				var course_id=$('#sev_upp_sel_tex_3').val();
				var shift=$('#sev_upp_sel_tex_4').val();
				if(course_id!=""){
					$.ajax({
					type:"POST",
					url:"Sem_Controller/get_type",
					data:{course_id:course_id, shift:shift},
					dataType:"json",
					success:function(data){	
						$('#sev_upp_sel_tex_5').empty();
						$('#sev_upp_sel_tex_5').append('<option value="" >Select One</option>');
						$('#sev_upp_sel_tex_5').append('<option value="5" >Forward Students</option>');
						$.each(data,function(key,value){
							if(value.tw=='1'){
								$('#sev_upp_sel_tex_5').append('<option value="1">Term Work</option>');
							}
							if(value.or=='1'){
								$('#sev_upp_sel_tex_5').append('<option value="3">Oral</option>');
							}
							if(value.pr=='1'){
								$('#sev_upp_sel_tex_5').append('<option value="2">Practical</option>');
							}
						});
					}
				})
				}
			});

		});

	</script>
<div class="wrapper">
    <div class="upper" id="upper">
		<h4 class="titleofpage">Internal Marks Entry</h4>
    		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
		    <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
		    <script type="text/javascript" src="<?php echo base_url(); ?>js/sem_view.js"></script>

			<form method="post" action="" >
				<table class="table" id="table">
			<tr class="tr">
				<td class="td">
					<label for="sev_upp_sel_tex_1" id="sev_upp_lab_tex_1">Scheme Name</label>
				</td>
				<td class="td">
				<select name="scheme" id="sev_upp_sel_tex_1">
						<option value="" >Select Scheme</option>
						<?php 	foreach($scheme as $key=>$value){ ?>
							<option value="<?php echo $value->scheme_id; ?>"><?php echo $value->scheme_year;?></option>
						<?php   } ?>
					</select><br><br>
			</td>
			</tr>	
					
				<tr class="tr">
				<td class="td">
					<label for="uni_upp_sel_tex_2" id="sev_upp_lab_tex_2">Semester</label>
				</td>
				<td class="td">
					<select name="semester" id="uni_upp_sel_tex_2">
						<option value="" >Select Semester</option>
					</select><br><br>
				</td>
				</tr>
			
				<tr class="tr">
				<td class="td">
					<label for="sev_upp_sel_tex_3" id="sev_upp_lab_tex_3">Course</label>
				</td>
				<td class="td">
					<select name="course" id="sev_upp_sel_tex_3" required>
						<option value="" >Select Course</option>
					</select><br><br>
				</td>
				</tr>

				<tr class="tr">
				<td class="td">
					<label for="sev_upp_sel_tex_4" id="sev_upp_lab_tex_4">Shift</label>
				</td>
				<td class="td">
					<select name="shift" id="sev_upp_sel_tex_4" required>
						<option value="" >Select Shift</option>
					</select><br><br>
				</td>
				</tr>

				<tr class="tr">
				<td class="td">
					<label for="sev_upp_sel_tex_5" id="sev_upp_lab_tex_5">Select Type</label>
				</td>
				<td class="td">
					<select name="select_type" id="sev_upp_sel_tex_5">
						<option value="" >Select One</option>
					</select><br><br>
				</td>
				</tr>
				</table>
				<table class="table">
					<tr class="tr">
						<td class="td"></td>
						<td class="td">
							<input type="submit" class="btn btn-success" name="submit" value="Submit" id="sev_upp_inp_sub_1" disabled><br><br>
						</td>
						<td class="td"></td>
					</tr>
				</table>
			</form>
			
			<?php 	if(isset($get_student)){
					foreach($sem_id as $key => $value)
						$semester_id = $value->semester_id;
				?>
				<form method="post" action="">

					<input type="hidden" name="sem_id_get" value="<?php echo $semester_id; ?>">
					<input type="hidden" name="course_id_get" value="<?php echo $course_id; ?>">
					<input type="hidden" name="marks_type_id_get" value="<?php echo $marks_id; ?>">
					<input type="hidden" name="select_type" value="<?php echo $marks_id; ?>" >
							<input type="checkbox" name="no_data" value="No Internal Marks" ><label>There is No Internal Marks For this Subject.</label><br>
							<table>
								<tr>
									<th>Student Enrollment Number</th>
									<th>Marks Gain</th>
								</tr>
							<?php foreach ($check_course as $key => $value) {
								if($value->course_practicals=="0" and $value->course_or="0,0" and $value->course_tw="0,0"){ ?>		
									<?php 	$count = 0; foreach ($get_student as $key =>$value) { ?>
										<tr>
											<td>
												<input type="hidden" name="tableRow[<?php echo $count;?>][student_id]"  value="<?php echo $value->student_id; ?>">
												<?php echo  $value->student_enrollmentno;  ?>
											</td>
											<td>
												<input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][marks]" >
											</td>
										</tr>
									<?php $count ++; }?>
						<?php  }else{ ?>
									<?php $count = 0; foreach ($get_student as $key =>$value) { ?>
										<tr>
											<td>
												<input type="hidden" name="tableRow[<?php echo $count;?>][student_id]"  value="<?php echo $value->student_id; ?>" required>
												<?php echo  $value->student_enrollmentno;  ?>
											</td>
											<td>
												<input type="text" id="" class="" name = "tableRow[<?php echo $count;?>][marks]" required>
											</td>
										</tr>
									<?php $count ++; } ?>
							<?php } ?>
							</table>
						<table class="table">
							<tr class="tr">
								<td class="td"></td>
								<td class="td"><input type="submit" class="btn btn-success" name="submit_marks" id="sev_upp_inp_sub_2"></td>
								<td class="td"></td>
							</tr>
						</table>
					
				</form>
				<?php 	}
				} ?>
		</div>
</div>