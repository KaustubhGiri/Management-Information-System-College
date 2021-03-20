<div class="wrapper">
	<div class="upper" id="upper">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
      	<script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
      	<script type="text/javascript" src="<?php echo base_url(); ?>js/course.js"></script>
      	<h4 class="titleofpage">Add New Course</h4><br/>
		<form method="post" action="">
			<table class="table">
				<tr class="tr">
					<td class="td">
						<label for="cov_upp_inp_tex_1" id="cov_upp_lab_tex_1" class="cov_upp_lab_tex">Course Code :</label><br><br>
					</td>
					<td class="td">
						<input type="text" name="course_code" id="cov_upp_inp_tex_1" class="cov_upp_inp_tex " onkeyup="AutoUpper(this.id);" autofocus required><br><br>
					</td>
					<td class="td">
                		<span id='cov_upp_spa_1' class="alert">Course Code should contain only letters and numbers.</span><br>
          			</td>
				</tr>

				<tr class="tr">
					<td class="td">
						<label for="cov_upp_inp_tex_2" id="cov_upp_lab_tex_2" class="cov_upp_lab_tex">Course Name :</label><br><br>
					</td>
					<td class="td">
						<input type="text" name="course_name" id="cov_upp_inp_tex_2" class="cov_upp_inp_tex" onkeyup="AutoCapitalize(this.id);" required><br><br>
					</td>
					<td class="td">
                		<span id='cov_upp_spa_2' class="alert" >Course Name can not be empty.</span>
            		</td>
				</tr>

				<tr class="tr">
					<td class="td">
						<label for="cov_upp_inp_tex_3" id="cov_upp_lab_tex_3" class="cov_upp_lab_tex">Lectures :</label><br><br>
					</td>
					<td class="td">
						<input type="number"  id="cov_upp_inp_tex_3" name="course_lectures" class="cov_upp_inp_tex" ><br><br>
					</td>
					<td class="td">
                		<span id='cov_upp_spa_3' class="alert" >Only numbers are allowed.</span>
            		</td>
				</tr>

				<tr class="tr">
					<td class="td">
						<label for="cov_upp_inp_tex_4" id="cov_upp_lab_tex_4" class="cov_upp_lab_tex">Practicals :</label><br><br>
					</td>
					<td class="td">
						<input type="number"  id="cov_upp_inp_tex_4" name="course_practicals" class="cov_upp_inp_tex"  ><br><br>
					</td>
					<td class="td">
                		<span id='cov_upp_spa_4' class="alert">Only numbers are allowed.</span>
            		</td>
				</tr>

				<tr class="tr">
					<td class="td">
						<label for="cov_upp_inp_tex_5" id="cov_upp_lab_tex_5" class="cov_upp_lab_tex">Tutorials :</label><br><br>
					</td>
					<td class="td">
						<input type="number"  id="cov_upp_inp_tex_5" name="course_tutorials" class="cov_upp_inp_tex"  ><br><br>
					</td>
					<td class="td">
                		<span id='cov_upp_spa_5' class="alert">Only numbers are allowed.</span>
            		</td>
				</tr>

				<tr class="tr">
					<td class="td">
						<label for="cov_upp_inp_tex_6" id="cov_upp_lab_tex_6" class="cov_upp_lab_tex">Total Teaching Hrs :&nbsp&nbsp</label><br><br>
					</td>
					<td class="td">
						<input type="number"  id="cov_upp_inp_tex_6" name="course_total_teaching_hrs" class="cov_upp_inp_tex" ><br><br>
					</td>
					<td class="td">
                		<span id='cov_upp_spa_6' class="alert">Only numbers are allowed.</span>
            		</td>
				</tr>

				<tr class="tr">
					<td class="td">
						<label id="cov_upp_lab_tex_7" class="cov_upp_lab_tex">Theory Marks :</label><br><br>
					</td>
					<td class="td">
					<label id="cov_upp_lab_tex_8" class="cov_upp_lab_tex">Min :</label> <input type="number" name="th_Minimum" style="width :50px"  >&nbsp&nbsp
					<label id="cov_upp_lab_tex_9" class="cov_upp_lab_tex">Max :</label><input type="number" name="th_Maximum" style="width :50px"  ><br><br>
					</td>
				</tr>

				<tr class="tr">
					<td class="td">
					<label id="cov_upp_lab_tex_10" class="cov_upp_lab_tex">TS Marks :</label><br><br>
					</td>
					<td class="td">
					<label id="cov_upp_lab_tex_11" class="cov_upp_lab_tex">Min :</label> <input type="number" name="ts_Minimum" style="width :50px" >&nbsp&nbsp
					<label id="cov_upp_lab_tex_12" class="cov_upp_lab_tex">Max :</label><input type="number" name="ts_Maximum" style="width :50px" ><br><br>
					</td>
				</tr>

				<tr class="tr">
					<td class="td">
					<label id="cov_upp_lab_tex_10" class="cov_upp_lab_tex">Practical Marks :</label><br><br>
					</td>
					<td class="td">
					<label id="cov_upp_lab_tex_14" class="cov_upp_lab_tex">Min :</label> <input type="number" name="pr_Minimum" style="width :50px" >&nbsp&nbsp
					<label id="cov_upp_lab_tex_15" class="cov_upp_lab_tex">Max :</label><input type="number" name="pr_Maximum" style="width :50px" ><br><br>
					</td>
				</tr>

				<tr class="tr">
					<td class="td">
					<label id="cov_upp_lab_tex_16" class="cov_upp_lab_tex">Oral Marks :</label><br><br>
					</td>
					<td class="td">
					<label id="cov_upp_lab_tex_14" class="cov_upp_lab_tex">Min :</label> <input type="number" name="or_Minimum" style="width :50px" >&nbsp&nbsp
					<label id="cov_upp_lab_tex_15" class="cov_upp_lab_tex">Max :</label><input type="number" name="or_Maximum" style="width :50px" ><br><br>
					</td>
				</tr>

				<tr class="tr">
					<td class="td">
					<label id="cov_upp_lab_tex_16" class="cov_upp_lab_tex">TW Marks :</label><br><br>
					</td>
					<td class="td">
					<label id="cov_upp_lab_tex_17" class="cov_upp_lab_tex">Min :</label> <input type="number" name="tw_Minimum" style="width :50px" >&nbsp&nbsp
					<label id="cov_upp_lab_tex_18" class="cov_upp_lab_tex">Max :</label><input type="number" name="tw_Maximum" style="width :50px" ><br><br>
					</td>
				</tr>

				<tr class="tr">
					<td class="td">
					<label for="cov_upp_inp_tex_8" id="cov_upp_lab_tex_19" class="cov_upp_lab_tex">Course Credits :</label><br><br>
					</td>
					<td class="td">
						<input type="number" name="cource_credit" id="cov_upp_inp_tex_8" class="cov_upp_inp_tex "><br><br>
					</td>
					<td class="td">
                		<span id='cov_upp_spa_7' class="alert">Only numbers are allowed.</span>
            		</td>
				</tr>

				<tr class="tr">
					<td class="td">
					<label for="cov_upp_sel_1" id="cov_upp_lab_tex_20" class="cov_upp_lab_tex">Course Level :</label><br><br>
					</td>
					<td class="td">
						<select name="course_level" class="cov_upp_sel" id="cov_upp_sel_1">
							<option value="">Select Option</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
						</select><br><br>
					</td>
				</tr>

				<tr class="tr">
					<td class="td">
						<label for="cov_upp_sel_2" id="cov_upp_lab_tex_21" class="cov_upp_lab_tex">Course Scheme :</label><br><br>
					</td>
					<td class="td">
						<select name="course_scheme_id" class="cov_upp_sel" id="cov_upp_sel_2">
							<option value="">Select Option</option>
							<?php foreach ($scheme as $key => $value) { ?>
								<option value="<?php echo $value->scheme_id; ?>"><?php echo $value->scheme_year; ?>
							</option>
						<?php } ?>	
						</select><br><br>
					</td>
				</tr>

				<tr class="tr">
					<td class="td">
						<label for="cov_upp_inp_tex_7" id="cov_upp_lab_tex_22" class="cov_upp_lab_tex">Total Marks :</label><br><br><br>
					</td>
					<td class="td">
						<input type="number" name="course_total_marks" class="cov_upp_inp_tex" id="cov_upp_inp_tex_7"   ><br><br><br>
					</td>
					<td class="td">
                		<span id='cov_upp_spa_8' class="alert">Only numbers are allowed.</span>
            		</td>
				</tr>
				  
				<tr class="tr">
					<td class="td"></td>
				 	<td class="td">
						 <button type="submit" name="submit" class="btn btn-success" id="cov_upp_inp_sub_1" value="Submit" disabled>Submit</button>
				 	</td>
				 	<td class="td"></td>
				</tr>
			</table>
		</form>
	</div>
</div>