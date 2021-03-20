<div class="wrapper">
    <div class="upper">

    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
	    <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
	    <script type="text/javascript" src="<?php echo base_url(); ?>js/infoview.js"></script>

		<h4 class="titleofpage">Department Wise Admission List</h4><br/>
          	<form method="post" autocomplete="off" target="_blank">
            	<table class="table" id="table">
					<tr class="tr">
						<td class="td">
							<label for="inv_upp_sel_tex_1" id="inv_upp_lab_tex_1" autofocus>Department :</label>
						</td>
						<td class="td">    
						    <select name = "student_dept_id" id="inv_upp_sel_tex_1">
	                			<option value="">Select Option</option>
	                			<?php foreach ($dept as $key => $value) { ?>
	                    		<option value="<?php echo $value->dept_id;?>"><?php echo $value->dept_name; ?></option>
	                			<?php } ?>
	            			</select><br><br> 
	            		</td>
	            		
	            	</tr>
					<tr class="tr">
			            <td class="td">
			                <label for="inv_upp_inp_tex_1"  id="inv_upp_lab_tex_2">Year :</label>
			            </td>
			            <td class="td">
			                <input type="number" id="inv_upp_inp_tex_1" name="year" required/> <br/><br/>
			            </td>
			             <td class="td">
                  			<span id='inf_upp_spa_year' class="alert">Please enter year.</span>
            			</td>
			        </tr>
					<tr class="tr">
						<td class="td"></td>
						<td class="td">
							<button type="submit" name="sub" value="Submit" class="btn btn-success" id="inv_upp_but_sub_1" disabled>Submit</button><br><br>
						</td>
						<td class="td"></td>
					</tr>
				</table>
			</form>
	</div>
</div>