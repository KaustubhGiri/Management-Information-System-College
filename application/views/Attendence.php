<div class="wrapper">
	<div class="upper" id="upper">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/attend.js"></script>

        <h4 class="titleofpage">Submit Attendance</h4><br/>
			<form method="post" action="">
				<table class="table" id="table">
					<tr class="tr">
						<td class="td">
							<label for="att_upp_inp_tex_1" id="att_upp_lab_tex_1">Year</label>
						</td>
						<td class="td">
							<input type="number" name="year" id="att_upp_inp_tex_1" min="10" max="99" autofocus><br><br>
						</td>
						<td class="td">
                  			<span id='att_upp_spa_year' class="alert">Please enter year. Like 2018 as 18.</span>
            			</td>
					</tr>

					<tr class="tr">
						<td class="td">
							<label for="att_upp_inp_tex_2" id="att_upp_lab_tex_2">Shift</label>
						</td>
						<td class="td">
							<select name="shift" id="att_upp_inp_tex_2">
								<option value="FS" selected>First Shift</option>
                    			<?php foreach ($shift as $key => $value) {
                        			if($value->dept_shift == 2){ ?>
                            			<option value="SS">Second Shift</option>
                    			<?php } } ?>
							</select><br><br>
						</td>
					</tr>

					<tr class="tr">
						<td class="td">
							<label for="att_upp_inp_tex_3" id="att_upp_lab_tex_3">Course-Name</label>
						</td>
						<td class="td">
							<select name="course" id="att_upp_inp_tex_3">
							<option value="">Select Course</option>
							<?php foreach ($course as $key => $value) { ?>
          					<option value="<?php echo $value->course_id; ?>"><?php echo $value->course_name.' ('.$value->course_code.'0'; ?></option>
        					<?php } ?>
							</select><br><br>
						</td>
					</tr>

					<tr class="tr">
						<td class="td"></td>
						<td class="td">
							<button type="submit" name="submit" class="btn btn-success" id="att_upp_but_sub_1" value="Submit" disabled>Submit</button><br><br>
						</td>
						<td class="td"></td>
					</tr>
				</table>
			</form>

<?php 	if(isset($get)){ ?>

			<form action="" method="post">
				<table class="table" id="table">
					<tr class="tr">
						<td class="td">
							<label for="att_upp_inp_tex_4" id="att_upp_lab_tex_4">Date :</label>
						</td>
						<td class="td">
							<input type="date" name="date" id="att_upp_inp_tex_4"><br><br>
						</td>
					</tr>

					<tr class="tr">
						<td class="td">
							<label for="att_upp_inp_tex_5" id="att_upp_lab_tex_5">Faculty :</label>
						</td>
						<td class="td">
							<select name="faculty" id="att_upp_inp_tex_5">
							<option value="">Select Faculty Name</option>
							<?php foreach ($faculty_get as $key => $value) { ?>
        				  	<option value="<?php echo $value->faculty_id; ?>"><?php echo $value->faculty_name; ?></option>
        					<?php } ?>
							</select><br><br>
						</td>
					</tr>

					<tr class="tr">
						<td class="td">
							<label for="att_upp_inp_tex_6" id="att_upp_lab_tex_6">Type of Lecture : </label>
						</td>
						<td class="td">
							<select name="practicle_course" id="att_upp_inp_tex_6">
							<option value="">Select</option>
							<option value="0">Lecture</option>
							<option value="1">Practicle</option>
							</select><br><br>
						</td>
					</tr>

					<tr class="tr">
						<td class="td">
							<label for="att_upp_inp_tex_7" id="att_upp_lab_tex_7">Start Time :</label>
						</td>
						<td class="td">
							<input type="time" name="time_from" id="att_upp_inp_tex_7"><br><br>
						</td>
					</tr>
					<tr class="tr">
						<td class="td">
							<label for="att_upp_inp_tex_8" id="att_upp_lab_tex_8">End Time :</label>
						</td>
						<td class="td">
							<input type="time" name="time_to" id="att_upp_inp_tex_8"><br><br>
						</td>
					</tr>

					<tr class="tr">
						<td class="td">
							<input type="hidden" name="course_id_get" value="<?php echo $get_course_id ?>">
						</td>
					</tr>

         			<tr class="tr">
         				<th class="th">Student Enrollment Number</th>
         				<th class="th">Attendence</th>
         			</tr>
         			
         			<tr>
         				
<?php 					
						$count = 0;
						foreach ($get as $key =>$value) { ?>

						<td ><input type="hidden" name="tableRow[<?php echo $count;?>][student_id]"  value="<?php echo $value->student_id; ?>"    required><?php echo  $value->student_enrollmentno;  ?></td>

         				<td>
         					<select name="tableRow[<?php echo $count;?>][attendence]">
         						<option selected="" value="0">Present</option>
         						<option value="1">Absent</option>
         					</select>
         				</td>
         			</tr>
<?php
				$count ++; }?>
        			<br><br>
        			<tr class="tr">
        				<td class="td">
        				</td>
        				<td class="td">
							<button type="submit" name="submit_attendence" class="btn btn-success" id="att_upp_but_sub_2" value="Submit" disabled>Submit</button> 			
						</td>						
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<?php } ?>