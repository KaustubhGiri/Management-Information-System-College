<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="" >
		<div class="container">
			<?php echo $room ?>

			Departmet Name:
				<select name = "room_dept_id">
					<option value="">Select Option</option>
					<?php foreach ($dept as $key => $value) { ?>
					<option value="<?php echo $value->dept_id; ?>"><?php echo $value->dept_name; ?>
					</option>
        			<?php } ?>
				</select><br><br>
			Lab :
				<select name="room_lab" >
					<option value="">Select Option</option>
			<option value="1">Yes</option>
			<option value="0">No</option>
			</select><br><br>
					
			Room no:
				<input type="number" name="room_no" required><span class="text-danger"></span></input>
			</div>
			<br>
			<br>
			<div>
        		<button type="submit" name="submit" class="">Submit</button>		    
         	</div>
</body>
</html>

