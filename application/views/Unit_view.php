<script type="text/javascript">
	function myfunction(){
		$.ajax({
			type:"POST",
			url:"Unit/fetch_sc_id",
			dataType:"json",		
			success:function(data){
				$('#uni_upp_sel_tex_1').empty();
				$('#uni_upp_sel_tex_1').append('<option value="">Select Scheme</option>');					        
				$.each(data,function(key,value){
					$('#uni_upp_sel_tex_1').append('<option value="'+value.scheme_id+'">'+value.scheme_year+'</option');				           
				});
			}						    
		})//ajax end
		}
	$(document).ready(function(){
		$('#uni_upp_sel_tex_1').change(function(){	//choosing course on basis of scheme
			var sc_id=$('#uni_upp_sel_tex_1').val();
			if(sc_id!=""){
				$.ajax({
					type:"POST",
					url:"unit/fetch_course",
					dataType:"json",
					data:{sc_id:sc_id},
					success:function(data){
						$('#uni_upp_sel_tex_2').empty();
						$('#uni_upp_sel_tex_2').append('<option value="">Select Course</option>');
						$.each(data,function(key,value){
							$('#uni_upp_sel_tex_2').append('<option value="'+value.course_id+'">'+value.course_name+' ('+value.course_code+')</option>');
						});
					}				
				})//ajax end
			} //IF ENDS
		});//end of #uni_upp_sel_tex_1_id

		$('#uni_upp_sel_tex_2').change(function(){	//choosing semester on basis of course
			var sc_id=$('#uni_upp_sel_tex_1').val();
			var c_id=$('#uni_upp_sel_tex_2').val();
			if(sc_id!=""){
				$.ajax({
					url:"Unit/fetch_semester",
					data:{sc_id:sc_id,c_id:c_id}, 
					dataType:"json",
					type:"POST",
					success:function(data){	
						$('#uni_upp_sel_tex_3').empty();
						$('#uni_upp_sel_tex_3').append('<option value="">Select Sem</option');
						$.each(data,function(key,value){
							$('#uni_upp_sel_tex_3').append('<option value="'+value.semester_id+'">'+value.semester_number+'</option>');
						});
					}
				})//ajax end for #uni_upp_sel_tex_3
				
				$.ajax({
					type:"POST",
					url:"Unit/get_dept_shift",
					data:{c_id:c_id},
					dataType:"json",
					success:function(data){	
						$('#uni_upp_sel_tex_5').empty();
						$('#uni_upp_sel_tex_5').append('<option value="" >Select Shift</option>');
						$.each(data,function(key,value){
							if(value.fs=='1'){
								$('#uni_upp_sel_tex_5').append('<option value="FS">First Shift</option>');
							}
							if(value.ss=='1'){
								$('#uni_upp_sel_tex_5').append('<option value="SS">Second Shift</option>');
							}
						});
					}
				})//ajax end for #uni_upp_sel_tex_5
			} //IF ENDS
		});//end of #semid
		
		$('#uni_upp_sel_tex_3').change(	//choosing unit-type  basis on course
			function(){
				var sc_id=$('#uni_upp_sel_tex_1').val();
				var c_id=$('#uni_upp_sel_tex_2').val();
				if(c_id!=""){
					$.ajax({
						type:"POST",
						url:"unit/fetch_uttype",
						dataType:"json",
						data:{sc_id:sc_id ,c_id:c_id},
						success:function(data){
							$('#uni_upp_sel_tex_4').empty();
							$.each(data,function(key,value){
								if(value.course_ts!='0,0'){
									$('#uni_upp_sel_tex_4').empty();
									$('#uni_upp_sel_tex_4').html('<select name="shift" id="uni_upp_lab_tex_4"><option value="">Select Unit Test</option><option value="1">First Unit</option><option value="2">Second Unit</option></select><br><br>');
								}else{
									$('#uni_upp_sel_tex_4').empty();
									alert('This course does not have ut');					
								}
							});
						}
					})//ajax end
				}
			});//end of #uni_upp_sel_tex_2
		
			$('#uni_upp_sel_tex_5').change(function(){	//choosing student data basis on shift
				var shift_id=$('#uni_upp_sel_tex_5').val();
				var sc_id=$('#uni_upp_sel_tex_1').val();						
				var count=0;
				if(shift_id!=""){	
					$.ajax({
						url:"unit/fetch_std",
						type:"POST",
						dataType:"json",
						data:{shift_id:shift_id,sc_id:sc_id},
						success:function(data){	
							$('#std').empty();
							$('#std').append('<tr><th>Student Enrollment No.</th><th>Marks Gain</th></tr>');
							$.each(data,function(key,value){
								$('#std').append('<tr>'+'<td><input type="hidden" name="tableRow['+count+'][student_id]"  value="'+value.student_id+'" required><br>'+value.student_enrollmentno+'</td><td><input type="number" id="" class="" name ="tableRow['+count+'][marks]" required=""></td>'+'</tr>');
								count++;
							});
						}
					})//ajax end
				}//IF Ends
			});//end of #uni_upp_sel_tex_5_id
	});
</script>
<body onload="myfunction()">
</head>
<div class="wrapper">
		<div class="upper" id="upper">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
		    <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
		    <script type="text/javascript" src="<?php echo base_url(); ?>js/unit.js"></script>

			<h4 class="titleofpage">Unit Test Marks Entry</h4><br/>
			<form method="post" action="" class="modal-content" autocomplete="off" target="_blank">
			<table class="table" id="table">
			<tr class="tr">
				<td class="td">
					<label for="uni_upp_sel_tex_1" id="uni_upp_lab_tex_1">Scheme Name</label>
				</td>
				<td class="td">
					<select name="scheme_id" id="uni_upp_sel_tex_1" required autofocus>
						<option value="">Select Scheme Name</option>
					</select><br/><br/>
			</td>
			</tr>
			
			<tr class="tr">
				<td class="td">
					<label for="uni_upp_sel_tex_2" id="uni_upp_lab_tex_2">Course Name</label>
					</td>
				<td class="td">
					<select name="course_id" id="uni_upp_sel_tex_2"  required>
						<option value="">Select Course Name</option>
					</select><br><br>
			</td>
			</tr>

			<tr class="tr">
				<td class="td">
					<label for="uni_upp_sel_tex_3" id="uni_upp_lab_tex_3">Semester</label>
					</td>
			<td class="td">
					<select name="semester_id" id="uni_upp_sel_tex_3" required>
						<option value="">Select Semester</option>
					</select><br><br>
			</td>
			</tr>

			<tr class="tr">
				<td class="td">		
						<label for="uni_upp_sel_tex_4" id="uni_upp_lab_tex_4">Unit Test </label>
						</td>
				<td class="td">
					<select name="unit_id"  id="uni_upp_sel_tex_4" required>
						<option value="">Select Unit Test</option>
					</select><br><br>
				</td>
				</tr>

			<tr class="tr">
				<td class="td">
					<label for="uni_upp_sel_tex_5" id="uni_upp_lab_tex_5">Shift</label>
					</td>
			<td class="td">
					<select name="shift"  id="uni_upp_sel_tex_5" required>
						<option value="">Select Shift</option>
					</select><br><br>
				</td>
				</tr>
				</table>
				<table id="std">

				</table><br><br>
				<table class="table">
					<tr class="tr">
						<td class="td"></td>
						<td class="td">
							<input type="submit" name="submit" value="Submit" class="btn btn-primary sig_con_but_sub" id="uni_upp_but_sub_1" disabled>
						</td>
						<td class="td"></td>
					</tr>
				</table>
			</form>
		</div>
</div>