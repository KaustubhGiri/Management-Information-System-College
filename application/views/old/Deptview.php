<?php
	error_reporting(0);
?>
<head>
<title>Department Entry</title>
<style>
			table {
			    width:100%;
			}
			table, th, td {
			    border: 1px solid black;
			    border-collapse: collapse;
			}
			th, td {
			    padding: 15px;
			    text-align: left;
			}
			table#t01 tr:nth-child(even) {
			    background-color: #eee;
			}
			table#t01 tr:nth-child(odd) {
			   background-color: #fff;
			}
			table#t01 th {
			    background-color: black;
			    color: white;
			}
			.h{
				text-align: center;
				width: 100%;
				margin :20px;
			}
	</style>
</head>

<div class="h">
	<form method="post" action="">
			<?php echo $dept ?>
			<label>Department Name :</label>
			<input type="text" name="dept_name"><br><br>
		

			<label>Department Intial :</label>
			<input type="text" name="dept_intial"><br><br>

			<label>Department Shifts :</label>
			<input type="text" name="dept_shifts"><br><br>

			<label>Department Intake :</label>
			<input type="number" name="dept_intake"><br><br>

			<input type="submit" name="submit" value="Submit">

			<br><br>
			<h4>Departments in GPMUMBAI</h4>
			<br><br>
	<table>

		<tr>
			<th>Department Id</th>
         	<th>Department Name</th>
         	<th>Department Intial</th>
         	<th>Department Shifts</th>
         	<th>Department Intake</th>
         	<th>Delete Record</th>
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
			<td><input type="submit" name="tableRow[<?php echo $count;?>][del_button]" value="delete"></td>
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
</div>



