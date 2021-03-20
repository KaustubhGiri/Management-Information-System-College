<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/exam_reg.js"></script>	 
<script type="text/javascript">
	function myFunction(){
    	$('#submit_registration').hide();
	}
	$(document).ready(function(){
		$('#exa_upp_inp_tex_1').keydown(function (e){
			if(e.keyCode == 13){
				alert('Please click the submit button');
			}
		});
		$('#exa_upp_inp_sub_1').click(function(){
			var enrollmentno = document.getElementById("exa_upp_inp_tex_1").value;
			var semester_num = document.getElementById("cor_upp_sel_tex_2").value;
			var status = '';
			if(enrollmentno!=''){ 
				var count=0;
				$.ajax({
						type:"POST",
						url:"exam_reg1/fetch_table",
						dataType:"json",
						data:{enrollmentno:enrollmentno,semester_num:semester_num},
						success:function(data){
							$('#table').empty();
							$('#table').append('<tr><th>No.</th><th>Enrollment No.</th><th>Course Name</th><th>Add</th><th>Type</th></tr>');
							$.each(data,function(key,value){
								if(value.course_th != '0'){
									$('#table').append('<tr>'+'<td>'+count+'</td>'+'<td>'+'<input type="hidden" name="tableRow['+count+'][register]" value="'+value.student_id+'"><input type="hidden" name="tableRow['+count+'][status_type]" value="7">'+enrollmentno+'</td><td>'+value.course_name+'</td><td><input type="checkbox" name="tableRow['+count+'][course_register]" value = "'+value.course_reg_id+'"><td>TH</td></tr>');
									count++;
								}
								if(value.course_pr != '0'){
									$('#table').append('<tr>'+'<td>'+count+'</td>'+'<td>'+'<input type="hidden" name="tableRow['+count+'][register]" value="'+value.student_id+'"><input type="hidden" name="tableRow['+count+'][status_type]" value="5">'+enrollmentno+'</td><td>'+value.course_name+'</td><td><input type="checkbox" name="tableRow['+count+'][course_register]" value = "'+value.course_reg_id+'"><td>PR</td></tr>');
									count++;
								}
								if(value.course_or != '0'){
									$('#table').append('<tr>'+'<td>'+count+'</td>'+'<td>'+'<input type="hidden" name="tableRow['+count+'][register]" value="'+value.student_id+'"><input type="hidden" name="tableRow['+count+'][status_type]" value="6">'+enrollmentno+'</td><td>'+value.course_name+'</td><td><input type="checkbox" name="tableRow['+count+'][course_register]" value = "'+value.course_reg_id+'"><td>OR</td></tr>');
									count++;
								}
							//	$('#table').append('<tr>'+'<td>'+count+'</td>'+'<td>'+'<input type="hidden" name="tableRow['+count+'][register]" value="'+value.student_id+'"><input type="hidden" name="tableRow['+count+'][status_type]" value="'+value.course_reg_examstatus+'">'+enrollmentno+'</td><td>'+value.course_name+'</td><td><input type="checkbox" name="tableRow['+count+'][course_register]" value = "'+value.course_reg_id+'"><td>'+status+'</td></tr>');
								//count++;
							});
							$('#submit_registration').show();
						}    
				})//ajax end
				$.ajax({
						type:"POST",
						url:"exam_reg1/fetch_backlog_table",
						dataType:"json",
						data:{enrollmentno:enrollmentno,semester_num:semester_num},
						success:function(data){
							$('#table').append('<tr><th></th><th></th><th>Other</th><th></th><th></th></tr>');
							$('#table').append('<tr><th>No.</th><th>Enrollment No.</th><th>Course Name</th><th>Add</th><th>Type</th></tr>');
							$.each(data,function(key,value){
								if(value.exam_reg_type_status == '7'){
									$('#table').append('<tr>'+'<td>'+count+'</td>'+'<td>'+'<input type="hidden" name="tableRow['+count+'][register]" value="'+value.student_id+'"><input type="hidden" name="tableRow['+count+'][status_type]" value="7">'+enrollmentno+'</td><td>'+value.course_name+'</td><td><input type="checkbox" name="tableRow['+count+'][course_register]" value = "'+value.course_reg_id+'"><td>TH</td></tr>');
									count++;
								}
								if(value.exam_reg_type_status == '5'){
									$('#table').append('<tr>'+'<td>'+count+'</td>'+'<td>'+'<input type="hidden" name="tableRow['+count+'][register]" value="'+value.student_id+'"><input type="hidden" name="tableRow['+count+'][status_type]" value="5">'+enrollmentno+'</td><td>'+value.course_name+'</td><td><input type="checkbox" name="tableRow['+count+'][course_register]" value = "'+value.course_reg_id+'"><td>PR</td></tr>');
									count++;
								}
								if(value.exam_reg_type_status == '6'){
									$('#table').append('<tr>'+'<td>'+count+'</td>'+'<td>'+'<input type="hidden" name="tableRow['+count+'][register]" value="'+value.student_id+'"><input type="hidden" name="tableRow['+count+'][status_type]" value="6">'+enrollmentno+'</td><td>'+value.course_name+'</td><td><input type="checkbox" name="tableRow['+count+'][course_register]" value = "'+value.course_reg_id+'"><td>OR</td></tr>');
									count++;
								}
							});
							$('#submit_registration').show();
						}    
				})//ajax end
			}
		});
	});
</script>
	<body onload="myFunction()">
	<div class="wrapper">
		<div class="upper" id="upper">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/exam_reg.js"></script>
			<div class="content">
	<form method="POST" action="" target="_blank">
		<table class="table">
			<tr class="tr">
				<td class="td">Enrollment no :</td>
				<td class="td"><input type="text" name="student_enrollment" class="upp_inp_tex" id="exa_upp_inp_tex_1" onkeyup="AutoUpper(this.id);" autofocus required></td>
				  <td class="td">
	                    <span id='exa_upp_spa_enr' class="alert">Please enter proper Enrollment Number.</span>
	              </td>
	    	</tr>
			<tr class="tr">
                    <td class="td">
                        <label for="cor_upp_sel_tex_2" id="cor_upp_lab_tex_3" class="cor_upp_lab_tex">Semester :</label>
                    </td>
                    <td class="td">
                        <select name="sem_no" id="cor_upp_sel_tex_2" class="cor_upp_inp_tex">
                            <option value="">Select Semester</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </td>
                </tr>
	    	<tr class="tr">
	    		<td class="td"><button type="button" id="exa_upp_inp_sub_1" class="cor_upp_inp_sub btn btn-primary sig_con_but_sub" disabled>Get Data</button></td>
	    	</tr>
    	</table>
<br>
   <table style="border: 1px solid black" id="table" class="cor_upp_tab">	
   </table>
 	<br>
    <input type="submit" name="submit" id="submit_registration" class="cor_upp_inp_sub btn btn-primary sig_con_but_sub" value="Submit">
</form>
</div>
</div>
</div>