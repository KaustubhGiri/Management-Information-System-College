
	    <script type="text/javascript">
		$(document).ready(function(){
			$('#fcv_upp_sel_tex_1').change(function(){
				var schene_id=$('#fcv_upp_sel_tex_1').val();
				if(schene_id!=""){
					$.ajax({
						url:"Facultytocourse/fetch_semester",
						type:"POST",
						data:{schene_id:schene_id},
						dataType:"json",
						success:function(data){
							$('#fcv_upp_sel_tex_2').empty();
							$('#fcv_upp_sel_tex_2').append('<option value="">Select Semester</option>');
							$.each(data,function(key,value){
								$('#fcv_upp_sel_tex_2').append('<option value="'+value.semester_number+'">'+value.semester_number+'</option>')
							});

						}
					})
				}
			});

			$('#fcv_upp_sel_tex_2').change(function(){
				var sem_num=$('#fcv_upp_sel_tex_2').val();
				if(sem_num!=""){
					$.ajax({
						url:"Facultytocourse/fetch_course",
						type:"POST",
						data:{sem_num:sem_num},
						dataType:"json",
						success:function(data){
							$('#fcv_upp_sel_tex_3').empty();
							$('#fcv_upp_sel_tex_3').append('<option value="">Select Course</option>');
							$.each(data,function(key,value){
								$('#fcv_upp_sel_tex_3').append('<option value="'+value.course_id+'">'+value.course_name+' ('+value.course_code+')</option>')
							});

						}
					})
				}
			});

			$('#fcv_upp_sel_tex_3').change(function(){
				var course_id=$('#fcv_upp_sel_tex_3').val();
				if(course_id!=""){
					$.ajax({
						url:"Facultytocourse/fetch_course_internals",
						type:"POST",
						data:{course_id:course_id},
						dataType:"json",
						success:function(data){
							$('#fcv_upp_sel_tex_5').empty();
							$('#fcv_upp_sel_tex_5').append('<option value="">Select One</option>');
							$.each(data,function(key,value){
							if(value.course_pr == '1')
								$('#fcv_upp_sel_tex_5').append('<option value="PR">Practcal</option>');
							if(value.course_th == '1')
								$('#fcv_upp_sel_tex_5').append('<option value="TH">Theory</option>');
							if(value.course_tu == '1')
								$('#fcv_upp_sel_tex_5').append('<option value="TR">Tutorial</option>');
							if(value.course_tw == '1')
								$('#fcv_upp_sel_tex_5').append('<option value="TW">Turm Work</option>');
							if(value.course_or == '1')
								$('#fcv_upp_sel_tex_5').append('<option value="OR">Oral</option>');
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
		    <script type="text/javascript" src="<?php echo base_url(); ?>js/ftoc.js"></script>

			<h4 class="titleofpage">Faculty Course Allocation</h4><br/>
			<form method="post" action="">
			<table class="table" id="table">
			<tr class="tr">
				<td class="td">
					<label for="fcv_upp_sel_tex_1" id="fcv_upp_lab_tex_1">Scheme : </label>
				</td>
				<td class="td">	
					<select name="scheme" id="fcv_upp_sel_tex_1">
						<option value="" >Select Scheme</option>
						<?php 	foreach($scheme as $key=>$value){ ?>
							<option value="<?php echo $value->scheme_id; ?>"><?php echo $value->scheme_year;?></option>
						<?php   } ?>
				</select><br><br>
							</td>
							</tr>

				<tr class="tr">
				<td class="td">
					<label for="fcv_upp_sel_tex_2" id="fcv_upp_lab_tex_2">Semester : </label>
				</td>
				<td class="td">	
					<select name="semester" id="fcv_upp_sel_tex_2">
						<option value="" >Select Semester</option>
					</select><br><br>
				</td>
				</tr>

				<tr class="tr">
				<td class="td">
					<label for="fcv_upp_sel_tex_3" id="fcv_upp_lab_tex_3">Course :</label>
				</td>
				<td class="td">	
					<select name="course" id="fcv_upp_sel_tex_3">
						<option value="" >Select Course</option>
					</select><br><br>
				</td>
				</tr>

				<tr class="tr">
				<td class="td">
					<label for="fcv_upp_sel_tex_4" id="fcv_upp_lab_tex_4">Teacher :</label>
				</td>
				<td class="td">	
					<select name="teacher" id="fcv_upp_sel_tex_4" >
							<option value="">Select teacher</option>
						<?php 	foreach($faculty as $key=>$value){ ?>
								<option value="<?php echo $value->faculty_id; ?>"><?php echo $value->faculty_name; ?></option>
						<?php   } ?>
						</select><br><br>
						</td>
						</tr>

				<tr class="tr">
					<td class="td">
						<label for="fcv_upp_sel_tex_5" id="fcv_upp_lab_tex_5">Type :</label>
					</td>
					<td class="td">	
						<select name="type" id="fcv_upp_sel_tex_5" >
							<option value="">Select One</option>
						</select><br><br>
					</td>
				</tr>

				<tr class="tr">
					<td class="td">
						<label for="fcv_upp_sel_tex_6" id="fcv_upp_lab_tex_6">Shift :</label>
					</td>
					<td class="td">	
						<select name="shift" id="fcv_upp_sel_tex_6">
							<option value="FS">First Shift</option>
							<?php foreach ($shift as $key => $value) {
	                        	if($value->dept_shift == 2){ ?>
	                            	<option value="SS">Second Shift</option>
	                    	<?php } } ?>
						</select><br><br>
					</td>
				</tr>
				<tr class="tr">
					<td class="td">
					</td>
					<td class="td">
							<input type="submit" class="btn btn-success" name="submit" value="Submit" id="fcv_upp_inp_sub_1" disabled>
					</td>
					<td class="td">
					</td>
					
				</tr>
			</form>
			</table>
		<h4 class="titleofpage" >Faculty to course allocation list</h4>
		<form method="post" action="" target="_blank">
			<br><input type="submit" class="btn btn-danger" name="gen_pdf" value="Generate PDF" id="fcv_upp_inp_sub_2">
		</form>
		<table class="table" id="table">
			<tr class="tr">
				<th class="th">Course Name</th>
				<th class="th">Course Code</th>
				<th class="th">Faculty Name</th>
				<th class="th">Type</th>
				<th class="th">Shift</th>
				<th class="th">Scheme Year</th>
				<th class="th">Delete Record</th>
			</tr>
			<?php  $count=0; foreach ($fetch as $key => $value){ ?>
				<tr>
					<form method="post" action="">
						<td><?php echo $value->course_name; ?><input type="hidden" name="tableRow[<?php echo $count;?>][facultytocourse_id]" value="<?php echo $value->facultytocourse_id; ?>"></td>
						<td><?php echo $value->course_code; ?></td>
						<td><?php echo $value->faculty_name; ?></td>
						<td><?php echo $value->facultytocourses_type; ?></td>	
						<td><?php echo $value->facultytocourse_shift; ?></td>
						<td><?php echo $value->scheme_year; ?></td>
						<td><input type="submit" class="btn btn-danger" name="tableRow[<?php echo $count;?>][del_button]" value="Delete" ></td>
					</form>
				</tr>
			<?php  $count ++; } ?>
		</table>
	</div>
</div>