<style>
			.alert{display: none;color:red;font-size: 12px;}
</style>

	<div class="wrapper">
		<div class="upper" id="upper">

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>

        	<script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>

        	<script type="text/javascript" src="<?php echo base_url(); ?>js/dept.js"></script>
        	<h4 class="titleofpage">Add New Department</h4><br/>
	<form method="post" action="">
		<table class="table">
			<tr class="tr">
				<td class="td">		
					<label for="dep_upp_inp_tex_1" class="dep_upp_lab_txt" id="dep_upp_lab_txt_1">Department Name :</label><br><br>
				</td>	
				<td class="td">
					<input type="text" name="dept_name" class="dep_upp_inp_tex" id="dep_upp_inp_tex_1" onkeyup="AutoCapitalize(this.id);" required><br><br>
				</td>
				<td class="td">
                	<span id='dep_upp_spa_dn' class="alert">Department Name must contain only letters.</span><br><br>
            	</td>
			</tr>
			<tr class="tr">
				<td class="td">	
					<label for="dep_upp_inp_tex_2" class="dep_upp_lab_txt" id="dep_upp_lab_txt_2">Department Intial :</label><br><br>
				</td>
				<td class="td">
					<input type="text" name="dept_intial" class="dep_upp_inp_tex" id="dep_upp_inp_tex_2" onkeyup="AutoUpper(this.id);" required><br><br>
				</td>
				<td class="td">
                	<span id='dep_upp_spa_di' class="alert">Department Initial must contain only letters.</span><br><br>
            	</td>
			</tr>
			<tr class="tr">
				<td class="td">
					<label for="dep_upp_sel_dep_1" class="dep_upp_lab_txt" id="dep_upp_lab_txt_3">Department Shift :</label><br><br>
				</td>
				<td class="td">
					<select name="dept_shifts" class="dep_upp_sel_dep" id="dep_upp_sel_dep_1" required>
						<option value="1">First Shift</option>
						<?php foreach ($shift as $key => $value){
								if($value->dept_shift == 2){ ?>
									<option value="2">Second Shift</option>
						<?php 	} 
							  }
						 ?>
					</select><br><br>
				</td>
			</tr>
			<tr class="tr">		
				<td class="td">
					<label for="dep_upp_inp_num_3" class="dep_upp_lab_txt" id="dep_upp_sel_dep_4">Students Intake :</label><br><br>
				</td>
				<td class="td">
					<input type="number" name="dept_intake" class="dep_upp_inp_num" id="dep_upp_inp_num_3" required><br><br>
				</td>
			</tr>
			<tr class="tr">
				<td class="td"></td>
				<td class="td">
					<input type="submit" name="submit" value="Submit" class="dep_upp_inp_sub btn btn-primary sig_con_but_sub" id="dep_upp_inp_sub_4" disabled>
				</td>
				<td class="td"></td>
			</tr>
		</table>
	<br><br>
	<h4 class="titleofpage">Remove Existing Department</h4><br/>
	<br><br>
	<table class="table">
		<tr class="tr">
			<th class="th">Department Id</th>
         	<th class="th">Department Name</th>
         	<th class="th">Department Intial</th>
         	<th class="th">Department Shifts</th>
         	<th class="th">Department Intake</th>
         	<th class="th">Delete Record</th>
		</tr>
<?php
	if($fetch->num_rows() > 0){
			$count = 0;
         	foreach($fetch->result() as  $row){
?>
		<tr>
			<form method="post" action="">
			<td><?php echo $row->dept_id; ?></td>
			<td><?php echo $row->dept_name;?><input type="hidden" name="tableRow[<?php echo $count;?>][dept_id]" value="<?php echo $row->dept_id; ?>"></td>
			<td><?php echo $row->dept_initial; ?></td>
			<td><?php echo $row->dept_shift; ?></td>
			<td ><?php echo $row->dept_intake;?></td>
			<td><input type="submit" class="btn btn-danger" name="tableRow[<?php echo $count;?>][del_button]"  value="Delete"></td>
			</form>
		</tr>
<?php
				$count ++;
			}		
    }else{
?>
         			<tr>
         				<td colspan="6">No Data Found</td>
         			</tr>
<?php
	}
?>
	</table>
</form>