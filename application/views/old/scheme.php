<!DOCTYPE html>
<html>
<body>
    <form  method="post" action="">
        <label>Scheme Year</label>  
        <input type="number" id="input" placeholder="Scheme Year" name="sc_year"><span class="text-danger"></span><br/>

    	<label>Scheme Credits</label>  
    	<input type="number" id="input" placeholder="Scheme credit" name="sc_credit"><span class="text-danger"></span><br/>

        <label>Department id</label>
        <select name="dept_id">
					<option value="">Select Option</option>
					<?php foreach ($dept as $key => $value) { ?>
          					<option value="<?php echo $value->dept_id; ?>"><?php echo $value->dept_name; ?></option>
        			<?php } ?>
			</select><br><br>  
       

        <button type="submit" name="submit" class="Schmecontro">Submit</button>
    </form>
</body>
</html>

