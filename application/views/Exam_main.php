<style>
    input{
        width: 150px;
        border-radius:2px;
    }
</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			load();
			function load(coursecode,coursename,en_no,date_reg)
			{
				var count=0;
				$.ajax({
					url:"EXAM/fetch_coursecode",
					type:"POST",
					dataType:"json",
					data:{coursecode:coursecode,coursename:coursename,en_no:en_no,date_reg:date_reg},
					success:function(data)
					{

						$('#result').empty();
						$('#result').append('<table>');
						$.each(data,function(key,value)
						{
						
							$('#result').append('<tr><td><form method="POST">'+count+'</td><td>'+value.course_code+'</td><td>'+value.course_name+'</td><td>'+value.student_enrollmentno+'</td><td>'+value.exam_reg_date+'</td><input type="hidden" name="tableRow['+count+'][course_reg_id]" value="'+value.exam_reg_course_reg_id+'"><input type="hidden" name="tableRow['+count+'][exam_reg_id]" value="'+value.exam_reg_id+'"></td><td><input type="submit" class="btn btn-danger" name="tableRow['+count+'][del_button]" value="Delete"></form></td></tr>');

							count++;
						});
						$('#result').append('</table>');
					}
				})
			}
			$('#coursecode').keyup(function(){
				var search_coursename = $('#coursename').val();
				var search_coursecode = $('#coursecode').val();
				var search_en_no = $('#en_no').val();
				var search_date = $('#date_reg').val();
				load(search_coursecode,search_coursename,search_en_no,search_date);
				
			});

			$('#coursename').keyup(function(){
				var search_coursename = $('#coursename').val();
				var search_coursecode = $('#coursecode').val();
				var search_en_no = $('#en_no').val();
				var search_date = $('#date_reg').val();
				load(search_coursecode,search_coursename,search_en_no,search_date);
			})

			$('#en_no').keyup(function(){
				var search_coursename = $('#coursename').val();
				var search_coursecode = $('#coursecode').val();
				var search_en_no = $('#en_no').val();
				var search_date = $('#date_reg').val();
				load(search_coursecode,search_coursename,search_en_no,search_date);
				
			
			})

			$('#date_reg').keyup(function(){
				var search_coursename = $('#coursename').val();
				var search_coursecode = $('#coursecode').val();
				var search_en_no = $('#en_no').val();
				var search_date = $('#date_reg').val();
				load(search_coursecode,search_coursename,search_en_no,search_date);
				
			
			})

		});

	</script>

<div class="wrapper">
    <div class="upper" id="upper">
		<h4 class="titleofpage">Exam Registration</h4>
		<table>
			<tr>
			<th>No.</th>
			<th>Course Code</th>
			<th>Course Name</th>
			<th>Enrollment No</th>
			<th>Date</th>
			<th>Delete</th>
			<th></th>
			</tr>
			<tr>
				<td></td>
				<td align="center"><input type="text" id="coursecode" placeholder="Course Code" name=""></td>
				<td align="center"><input type="text" id="coursename" placeholder="Course Name" name=""></td>
				<td align="center"><input type="text" id="en_no" placeholder="Enrollment No" name=""></td>
				<td align="center"><input type="text" id="date_reg" placeholder="Registration Date" name=""></td>
				<td></td>
				<td>
				<form method="post" action="<?php echo site_url(); ?>/exam_reg1">
				<input type="submit" class="btn btn-warning" value="ADD"/>
				</form>
				<form method="post" action="<?php echo site_url(); ?>/exam_reg_list">
				<input type="submit" class="btn btn-info" value="PDF"/>
				</form>
				</td>

			</tr>
		</table>
		<br>
		<div id="result"></div>
	</div>
</div>