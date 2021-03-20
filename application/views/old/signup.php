<form class="modal-content" action="" method="post">
    <div class="container">
      <h1 class="pageHeader">Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
        <h1><?php echo $message; ?></h1>
      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter Name" name="name" required><br>

      <label for="f_no"><b>Faculti Number</b></label>
      <input type="text" placeholder="Enter Faculti Number" name="f_no" required><br>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required><br>
      
      <label for="phno"><b>Phone No.</b></label>
      <input type="text" placeholder="Enter Phone Number" name="phno" required><br>
      <label for="f_type"><b>Faculty Type</b></label>
        <select name = "f_type">
        <option value="NULL">Selecr One</option>
        <option value="d">Dean</option>
        <option value="h">HOD</option>
        <option value="t">Teacher</option>
        </select> <br>
        <label for="f_dept"><b>Faculty Department</b></label>
        <select name = "f_dept">
            <option value="NULL">Select Department</option>
            <?php foreach ($dept as $key => $value) { ?>
                <option value="<?php echo $value->dept_id; ?>"><?php echo $value->dept_name; ?></option>
            <?php } ?>
        </select> <br>
    
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required><br>

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required><br>

      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label><br>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn btn btn-default">Cancel</button>
        <button type="submit" name="submit" class="signup btn btn-primary">Sign Up</button>
      </div>
    </div>
  </form>