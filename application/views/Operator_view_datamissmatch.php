<style>
	input{
		width:70px;
	}
</style>
<div class="wrapper">
    <div class="upper" id="upper">
		<legend align="center">
            <fieldset>
            <form method="post" action="">
                <?php if(isset($unmatched_data)) {?>
                    <table>
					<tr>
                        <th>Index</th>
                        <th>Operator</th>
						<th>Marks Gain</th>
						<th>Pass=1/Fail=0</th>
						<th>Present=0/Absent=1/Detain=2</th>
						<th>Change This Record</th>
					</tr>
					<?php $count = 0; foreach ($unmatched_data as $key =>$value) { ?>			
						<tr>			
							<input type="hidden" name="tableRow[<?php echo $count;?>][sem_op1_id]" value="<?php echo $value->sem_op1_id; ?>">
							<input type="hidden" name="tableRow[<?php echo $count;?>][sem_op1_usr_id]" value="<?php echo $value->sem_op1_user_id; ?>">
                            <td>
                                <label><?php echo $count + 1;?></label>
                            </td>
                            <td>
                                <label>Operator 1</label>
                            </td>
                            <td>
								<input type="hidden" name="tableRow[<?php echo $count;?>][sem_op1_internal_marks_id]"  value="<?php echo $value->sem_op1_internal_marks_id; ?>">
								<input type="text" name="tableRow[<?php echo $count;?>][sem_op1_marks_th]" value="<?php echo $value->sem_op1_marks_th; ?>">
							</td>
                            <td>
								<label><?php echo $value->sem_op1_pass; ?></label>
							</td>
							<td>
								<label><?php echo $value->sem_op1_studentabsent; ?></label>
							</td>
							<td>
                                <label>
									<input type="radio" name="tableRow[<?php echo $count;?>][operator]" value="1">
								</label>
                            </td>
                        </tr>
                        <tr>			
							<input type="hidden" name="tableRow[<?php echo $count;?>][sem_op2_id]" value="<?php echo $value->sem_op2_id; ?>">
							<input type="hidden" name="tableRow[<?php echo $count;?>][sem_op2_usr_id]" value="<?php echo $value->sem_op2_user_id; ?>">
							<td>
                                <label><?php echo $count + 1;?></label>
                            </td>
							<td>
                                <label>Operator 2</label>
                            </td>
                            <td>
								<input type="hidden" name="tableRow[<?php echo $count;?>][sem_op2_internal_marks_id]"  value="<?php echo $value->sem_op2_internal_marks_id; ?>">
								<input type="text" name="tableRow[<?php echo $count;?>][sem_op2_marks_th]" value="<?php echo $value->sem_op2_marks_th; ?>">
							</td>
							<td>
								<label><?php echo $value->sem_op1_pass; ?></label>
							</td>
							<td>
								<label><?php echo $value->sem_op2_studentabsent; ?></label>
							</td>
							<td>
                                <label>
									<input type="radio" name="tableRow[<?php echo $count;?>][operator]" value="2">
								</label>
                            </td>
						</tr>
					<?php $count++; } ?>
				</table>
				<table class="table">
						<tr class="tr">
							<td class="td"></td>
							<td class="td">
								<input type="submit" class="btn btn-success" name="mussmatch_data_submit" value="Submit"><br><br>
							</td>
						</tr>
				</table>
			<?php } ?>
		</form>
			</fieldset>
		</legend>
	</div>
</div>