<div class="wrapper">
    <div class="upper" id="upper">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/scheme.js"></script>
        <h4 class="titleofpage">Add New Scheme</h4><br/>
    <form  method="post" action="">
        <table class="table">
            <tr class="tr">
                <td class="td">
                    <label for="sch_upp_inp_num_1" id="sch_upp_lab_txt_1" class="sch_upp_lab_txt">Scheme Name :&nbsp</label><br><br>  
                </td>
                <td class="td">
                    <input type="text" class="sch_upp_inp_num" id="sch_upp_inp_txt_1" placeholder="Scheme Year" 
                    name="sc_year" onkeyup="AutoUpper(this.id);" autofocus required><br><br>    
                </td>
                <td class="td">
                    <span id='sch_upp_spa_sy' class="alert">Scheme Name should contain only letters and numbers.</span><br/><br/>
                </td>
            </tr>
            <tr class="tr">
        	   <td class="td">
                    <label for="sch_upp_inp_num_2" class="sch_upp_lab_txt" id="sch_upp_lab_num_1">Scheme Credits :&nbsp</label><br><br>
               </td>  
        	   <td class="td">
                <input type="number" id="sch_upp_inp_num_1" class="sch_upp_inp_num" placeholder="Scheme credit" name="sc_credit" required><br><br>
                </td>
            </tr>
            <tr class="tr">
                <td class="td">
                    <label for="sch_upp_sel_dep_1" class="sch_upp_lab_txt" id="sch_upp_lab_sel_1">Department :&nbsp</label><br><br>
                </td>
                <td class="td">
                    <select name="dept_id" class="sch_upp_sel_dep" id="sch_upp_sel_dep_1" required>
    					<option value="">Select Option</option>
    					<?php foreach ($dept as $key => $value) { ?>
              					<option value="<?php echo $value->dept_id; ?>"><?php echo $value->dept_name; ?>
                                </option>
            			<?php } ?>
    			     </select><br><br>
                </td>  
            </tr>       
            <tr class="tr">
                <td class="td"></td>
                <td class="td">
                   <input type="submit" name="submit" value="Submit" class="sch_upp_but_sub btn btn-primary sig_con_but_sub" id="sch_upp_but_sub_1" disabled>
                </td>
                <td class="td"></td>
            </tr>   
        </table>    
        </form>
    </div>
</div>