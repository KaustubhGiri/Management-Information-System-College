
<div class="wrapper">
  <div class="upper" id="upper">

    <div class="content">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>js/signup.js"></script>

    <form class="modal-content" style="padding: 10px;background-color: #f1f1f1;border:none;" action="" method="post">
        <h4 class="titleofpage">Sign Up</h1>

      <p>Please fill in this form to create an account.</p><br>
    <div style="overflow-x:auto;">     
    <table class="table">
      <tr class="tr">         
          <td class="td">
               <label for="sig_con_inp_tex_1" class="sig_con_lab_tex" id="sig_con_lab_tex_1"><b>Name :</b></label><br/><br/>
          </td>
          <td class="td"> <input type="text" placeholder="Enter Name" name="name" class="sig_con_inp_tex" id="sig_con_inp_tex_1" onkeyup="AutoUpper(this.id);" autofocus required /><br/><br/>
          </td>
          <td class="td">
                <span id='sig_con_spa_fn' class="alert">Name must contain only letters.</span><br/><br/>
          </td>
      </tr>      

      <tr class="tr">
        <td class="td">
          <label for="sig_con_inp_tex_2" class="sig_con_lab_tex" id="sig_con_lab_tex_2"><b>Faculty Number :</b></label><br/><br/>
        </td>          
        <td class="td">  
          <input type="text" placeholder="Enter Faculty Number" name="f_no" class="sig_con_inp_tex" id="sig_con_inp_tex_2" required><br/><br/>
        </td>
        <td class="td"><br/><br/></td>
      </tr>    

      <tr class="tr">
        <td class="td">
              <label for="sig_con_inp_dat_1" class="sig_con_lab_dat" id="sig_con_lab_dat_1"> <b>Date of Joining :</b></label><br/><br/>
        </td>      
        <td class="td">
              <input type="date" name="f_doj" class="sig_con_inp_dat" id="sig_con_inp_dat_1" required><br/><br/>
        </td>
        <td class="td"><br/><br/></td>
      </tr>    

      <tr class="tr">
        <td class="td">
              <label for="sig_con_inp_gender" class="" id=""> <b>Gender: </b></label><br/><br/>
        </td>      
        <td class="td">
            <select name = "f_gender" id="sig_con_inp_gender">
                <option value="">Select</option>
                <option value="M" >Male</option>
                <option value="F">Female</option>
                <option value="O">Other</option>
            </select><br/><br/>
        </td>
        <td class="td"><br/><br/></td>
      </tr>  

      <tr class="tr">
          <td class="td">
              <label for="sig_con_inp_tex_3" class="sig_con_lab_tex" id="sig_con_lab_tex_3"><b>Email :</b></label><br/><br/>
          </td>    
          <td class="td">
              <input type="email" placeholder="Enter Email" name="email" class="sig_con_inp_tex" id="sig_con_inp_tex_3" required><br/><br/>
          </td>
          <td class="td">
                <span id='sig_con_spa_femail' class="alert">Wrong email format</span><br/><br/>
          </td>
      </tr>      
      
      <tr class="tr">
        <td class="td">
            <label for="sig_con_inp_tex_4" class="sig_con_lab_tex" id="sig_con_lab_num_1"><b>Mobile No :</b></label><br/><br/>
        </td>
        <td class="td">    
              <input type="number" placeholder="Enter Mobile Number" name="phno" class="sig_con_inp_tex" id="sig_con_inp_num_1"  required><br/><br/>
         </td>
         <td class="td">
                <span id='sig_con_spa_fmobileno' class="alert">Mobile number must contain 10 digits.</span><br/><br/>
          </td>
      </tr>        
    
      <tr class="tr">
        <td class="td">
             <label for="sig_con_sel_tex_1" class="sig_con_lab_tex" id="sig_con_lab_sel_1"><b>Faculty Type :</b></label><br/><br/>
        </td>
        <td class="td">     
            <select name="f_type" class="sig_con_sel_tex" id="sig_con_sel_tex_1" required>
                <option value="">Select</option>
                <option value="d">Dean</option>
                <option value="h">HOD</option>
                <option value="t">Teacher</option>
                <option value="c">clerk</option>
            </select><br/><br/>
        </td>
        <td class="td"><br/><br/></td>
      </tr>          
      
      <tr class="tr">
          <td class="td">
            <label for="sig_con_sel_tex_2" class="sig_con_lab_tex" id="sig_con_lab_sel_2"><b>Access Level :</b></label><br/><br/>
          </td>      
          <td class="td">
              <select name = "f_level" class="sig_con_sel_tex" id="sig_con_sel_tex_2" required>
                <option value="">Select</option>
                <option value="0">None</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
              </label><br/><br/>
          </td>
          <td class="td"><br/><br/></td>
      </tr>              
        
      <tr class="tr">
          <td class="td">  
                <label for="sig_con_sel_tex_3" class="sig_con_lab_tex" id="sig_con_lab_sel_3"><b>Department :</b></label><br/><br/>
          </td>      
          <td class="td">         <select name = "f_dept" class="sig_con_sel_tex" id="sig_con_sel_tex_3" required>
                       <option value="">Select Department</option>
                            <?php foreach ($dept as $key => $value) { ?>
                        <option value="<?php echo $value->dept_id; ?>"><?php echo $value->dept_name; ?></option>
                            <?php } ?>
                    </select><br/><br/>
          </td>
          <td class="td" ><br/><br/></td>
      </tr> 
      
      <tr class="tr">     
          <td class="td">
                  <label for="sig_con_inp_pas_1" class="sig_con_lab_pas" id="sig_con_lab_pas_1"><b>Password :</b></label><br/><br/>
          </td>        
          <td class="td">    
                  <input type="password" placeholder="Enter Password" name="psw" class="sig_con_inp_pas" id="sig_con_inp_pas_1" required><br/><br/>
          </td>  
          <td class="td" >
              <span id='sig_con_spa_pass1' class="alert">Contains atleast one character, one number, one special character and length between 6  to 12.</span><br/><br/>
          </td>      
      </tr>
      
      <tr class="tr">
          <td class="td">      
              <label for="sig_con_inp_pas_2" class="sig_con_lab_pas" id="sig_con_lab_pas_2"><b>Repeat Password :</b></label><br/><br/>
          </td>    
          <td class="td">    
              <input type="password" placeholder="Repeat Password" name="psw-repeat" class="sig_con_inp_pas" id="sig_con_inp_pas_2" required><br/><br/>
          </td>    
          <td class="td" >
              <span id='sig_con_spa_pass2' class="alert">Password does not match as above entered password.</span><br/><br/>
          </td>
      </tr>    

      <tr class="tr">
          <td colspan="3" class="td">  
            <input type="checkbox" name="" class="sig_con_che_tac" id="sig_con_che_tac_1" disabled>&nbspBy creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</input><br/><br/>
          </td>
      </tr>       

      <tr class="tr">
        <td class="td"></td>
        <td class="td">
              <button type="button" onclick="Cancel()" class="btn btn-danger" id="sig_con_but_can_1">Cancel</button>
        </td>
        <td class="td">
            <button type="submit" name="submit" class="btn btn-primary"  id="sig_con_but_sub_1" disabled >Sign Up</button>
        </td>
        <td class="td"></td>
      </tr>           
      </table>
      
    </div> <?php // div for table?>
    </form>
    </div> <?php // div of content?>
    </div> <?php // div of upper?>
</div> <?php // div of wrapper?>