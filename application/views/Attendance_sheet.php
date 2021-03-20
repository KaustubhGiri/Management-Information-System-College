<style>

			form
			{
				margin:20px;
				text-align:center;
			}
</style>
<script type="text/javascript">
		$(document).ready(function(){
			$('#scheme_id').change(function(){
				var schene_id=$('#scheme_id').val();
				if(schene_id!=""){
					$.ajax({
						url:"ATTENDANCE_MAIN/fetch_semester",
						type:"POST",
						data:{schene_id:schene_id},
						dataType:"json",
						success:function(data){
							$('#semester_id').empty();
							$('#semester_id').append('<option>Select Semester</option>');
							$.each(data,function(key,value){
								$('#semester_id').append('<option value="'+value.semester_number+'">'+value.semester_number+'</option>')
							});

						}
					})
				}
			});

			$('#semester_id').change(function(){
				var sem_num=$('#semester_id').val();
				if(sem_num!=""){
					$.ajax({
						url:"ATTENDANCE_MAIN/fetch_course",
						type:"POST",
						data:{sem_num:sem_num},
						dataType:"json",
						success:function(data){
							$('#ats_upp_sel_tex_3').empty();
							$('#ats_upp_sel_tex_3').append('<option>Select Course</option>');
							$.each(data,function(key,value){
								$('#ats_upp_sel_tex_3').append('<option value="'+value.course_id+'">'+value.course_name+' ('+value.course_code+')</option>')
							});

						}
					})
				}
			});

			$('#ats_upp_sel_tex_3').change(function(){
				var course_id=$('#ats_upp_sel_tex_3').val();
				if(course_id!=""){
					$.ajax({
						url:"ATTENDANCE_MAIN/fetch_course_internals",
						type:"POST",
						data:{course_id:course_id},
						dataType:"json",
						success:function(data){
							$('#ats_upp_sel_tex_2').empty();
							$('#ats_upp_sel_tex_2').append('<option>Select One</option>');
							$.each(data,function(key,value){
								if(value.course_pr == '1')
									$('#ats_upp_sel_tex_2').append('<option value="PRACTICAL">Practical</option>');
								if(value.course_th == '1')
									$('#ats_upp_sel_tex_2').append('<option value="THEORY">Theory</option>');
							});

						}
					})
				}
			});
		});
	</script>
	
<div class="wrapper">
	<div class="upper">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/attendsheet.js"></script>


		<h4 class="titleofpage">Generate Attendance Sheet</h4><br/>
			<form method="post" action="" autocomplete="off" target="_blank">
				<table class="table" id="table"> 
					<tr class="tr">		
						<td class="td">
							<label for="" id=""> Scheme: </label></td>
						<td class="td">
							<select name="scheme" id="scheme_id">
								<option>Select Scheme</option>
								<?php 	foreach($scheme as $key=>$value){ ?>
									<option value="<?php echo $value->scheme_id; ?>"><?php echo $value->scheme_year;?></option>
								<?php   } ?>
							</select><br><br>
						</td>
					</tr>
					<tr class="tr">		
						<td class="td">
							<label for="" id=""> Semester: </label></td>
						<td class="td">
							<select name="semester" id="semester_id">
								<option>Select Semester</option>
							</select><br><br>
						</td>
					</tr>

					<tr class="tr">	
						<td class="td">
							<label for="ats_upp_sel_tex_3" id="ats_upp_lab_tex_3">Course Code : </label>
						</td>
						<td class="td">
							<select name="course_code" id="ats_upp_sel_tex_3">
								<option value="">Select Course Code</option>
							</select><br><br>
						</td>
					</tr>

					<tr class="tr">
						<td class="td"><label for="ats_upp_sel_tex_2" id="ats_upp_lab_tex_2">Attendance Type : </label>
						</td>
						<td class="td">	
							<select name="Attendance_type" id="ats_upp_sel_tex_2">
								<option value="">Select Attendance Type</option>
							</select><br><br>
						</td>
					</tr>

					<tr class="tr">		
						<td class="td">
							<label for="ats_upp_sel_tex_1" id="ats_upp_lab_tex_1">Faculty Name : </label></td>
						<td class="td">
							<select name="faculty_name" id="ats_upp_sel_tex_1" autofocus>
								<option value="">Select Faculty Name</option>
								<?php foreach ($Faculty_Name as $key => $value) { ?>
									<option value="<?php echo $value->faculty_name;?>"><?php echo $value->faculty_name; ?></option>
								<?php } ?>
							</select><br><br>
						</td>
					</tr>
				
					<tr class="tr">
						<td class="td">
							<label for="ats_upp_sel_tex_4" id="ats_upp_lab_tex_4">Shift : </label>
						</td>
						<td class="td">
							<select name="course_shift" id="ats_upp_sel_tex_4">
								<option value="FS" selected>First Shift</option>
                    			<?php foreach ($shift as $key => $value) {
                        			if($value->dept_shift == 2){ ?>
                            			<option value="SS">Second Shift</option>
                    			<?php } } ?>
							</select><br><br>
						</td>
					</tr>	
					<tr class="tr">
						<td class="td"></td>
						<td class="td">
							<button type="submit" value="Submit" name="submit"  class="btn btn-success" id="ats_upp_but_sub_1" disabled>Submit</button>
						</td>
						<td class="td"></td>
					</tr>
				</table>
			</form>
	</div>
</div>