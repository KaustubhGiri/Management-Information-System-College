<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
<title>Course</title>
<script type="text/javascript" src="course.js"></script>
</head>
<body>
    <!--In this modified file, I added added class name and also created it's related JavaScript.      -->
<form method="post" action="" onsubmit="return CourseSize()">
<table>
	<tr>
		<td>
			<label for="">Course Code :</label>
		</td>
		<td>
			<input type="text" name="course_code" id="" class=""><br>
		</td>
	</tr>

	<tr>
		<td>
			<label for="">Course Name :</label>
		</td>
		<td>
			<input type="text" name="course_name" id="" class=""><br>
		</td>
	</tr>

	<tr>
		<td>
			<label for="number_course_lectures">Course lectures :</label>
		</td>
		<td>
			<input type="number"  id="number_course_lectures" name="course_lectures"><br>
		</td>
	</tr>

	<tr>
		<td>
			<label for="number_course_practicals">Course Practicals :</label>
		</td>
		<td>
			<input type="number"  id="number_course_practicals" name="course_practicals"><br>
		</td>
	</tr>

	<tr>
		<td>
			<label>Course Tutorials :</label>
		</td>
		<td>
			<input type="number"  id="number_course_tutorials" name="course_tutorials"><br>
		</td>
	</tr>

	<tr>
		<td>
			<label>Course Teaching hrs :</label>
		</td>
		<td>
			<input type="number"  id="number_course_hours" name="course_total_teaching_hrs"><br>
		</td>
	</tr>

	<tr>
		<td>
			<label>Course Theory :</label>
		</td>
		<td>
			  Minimum: <input type="text" name="th_Minimum" style="width:30px">
			  Maximum: <input type="text" name="th_Maximum" style="width:30px"><br>
			  <?php 
			   
			   ?>
		</td>
	</tr>

	<tr>
		<td>
			<label>Course ts :</label>
		</td>
		<td>
			 Minimum: <input type="text" name="ts_Minimum" style="width:30px">
			 Maximum: <input type="text" name="ts_Maximum" style="width:30px"><br>
		</td>
	</tr>

	<tr>
		<td>
			<label>Course Practical :</label>
		</td>
		<td>
			  Minimum: <input type="text" name="pr_Minimum" style="width:30px">
			  Maximum: <input type="text" name="pr_Maximum" style="width:30px"><br>
		</td>
	</tr>

	<tr>
		<td>
			<label>Course Oral :</label>
		</td>
		<td>
			  Minimum: <input type="text" name="or_Minimum" style="width:30px">
			  Maximum: <input type="text" name="or_Maximum" style="width:30px"><br>
		</td>
	</tr>

	<tr>
		<td>
			<label>Course tw :</label>
		</td>
		<td>
			  Minimum: <input type="text" name="tw_Minimum" style="width:30px">
			  Maximum: <input type="text" name="tw_Maximum" style="width:30px"><br>
		</td>
	</tr>

	<tr>
		<td>
			<label>Course Credit :</label>
		</td>
		<td>
			<input type="number" name="cource_credit" id="number_course_credit"><br>
		</td>
	</tr>

	<tr>
		<td>
			<label>Course Level :</label>
		</td>
		<td>
			<input type="number" name="course_level" id="number_course_level"><br>
		</td>
	</tr>

	<tr>
		<td>
			<label>Course Scheme Id :</label>
		</td>
		<td>
			<select name="course_scheme_id" >
			<option value="">Select Option</option>
			<?php foreach ($scheme as $key => $value) { ?>
			<option value="<?php echo $value->scheme_id; ?>"><?php echo $value->scheme_year; ?>
			</option>
			<?php } ?>	
			</select><br>
		</td>
	</tr>

	<tr>
		<td>
			<label>Course Total Marks:</label>
		</td>
		<td>
			<input type="text" name="course_total_marks"><br>
		</td>
	</tr>
	  
	<tr>
	 	<td>
	 		<input type="submit" name="submit">
	 	</td>
	</tr>
</table>
</form>
</body>
</html>
