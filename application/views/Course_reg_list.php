<div class="wrapper">
	<div class="upper" id="upper">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
	    <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
	    <script type="text/javascript" src="<?php echo base_url(); ?>js/course_reg_list.js"></script>

		<h4 class="titleofpage">Course Wise Registration List </h4><br/>
		<form method="post" action="" autocomplete="off" target="_blank">
			<table class="table">
				<tr class="tr">
					<td class="td">
						<label for="crl_upp_sel_tex_1" class="crl_upp_lab" id="crl_upp_lab_tex_1">Course Code : </label>
					</td>
					<td class="td">
						<select name="course_code" id="crl_upp_sel_tex_1" class="crl_upp_sel">
						<option value="">Select Course Code</option>
						<?php foreach ($Course_code as $key => $value) { ?>
						<option value="<?php echo $value->course_code;?>"><?php echo $value->course_name.' ('.$value->course_code.')'; ?></option>
								<?php } ?>
						</select><br><br>
					</td>
				</tr>
				<tr class="tr">
					<td class="td">
						<label for="crl_upp_sel_tex_2" class="crl_upp_lab" id="crl_upp_lab_tex_2">Shift : </label>
					</td>
					<td class="td">	
						<select name="course_shift" id="crl_upp_sel_tex_2" class="crl_upp_sel">
							<option value="">Select Course shift</option>
							<option value="FS">First Shift</option>
							<option value="SS">Second Shift</option>
						</select><br><br>
					</td>
				</tr>
				<tr class="tr">
					<td class="td"></td>
					<td class="td">
						<input type="submit" name="submit" value="Submit" class="btn btn-primary sig_con_but_sub" id="crl_upp_sub_1" disabled>
					</td>
					<td class="td"></td>
				</tr>
			</table>
		</form>
	</div>
</div>