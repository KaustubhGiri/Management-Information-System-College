<div class="wrapper">
    <div class="upper"  id="upper">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/msgofday.js"></script>
        <h4 class="titleofpage">Message of the day</h4><br/>
        <form id="" action="" method="post" role="form">
            <table class="table">
                <tr class="tr">
                    <td class="td">
                        <label for="mod_upp_tex_1" id="mod_upp_lab_tex_1" class="mod_upp_lab_tex">Message :</label>
                    </td>
                    <td class="td">
                        <textarea id="mod_upp_tex_1" class="mod_upp_tex" name="mesg" maxlength="100" placeholder="Enter Message Details"></textarea>
                    </td>
                    <td class="td">
                        <span id='mod_upp_spa_msg' class="alert">Please write some message.</span>
                    </td>
                </tr>
                
                <tr class="tr">
                    <td class="td">
                        <label for="mod_upp_sel_act_1" id="mod_upp_lab_sel_1" class="mod_upp_lab_tex">Active :</label>
                    </td>
                    <td class="td">
                        <select name="status" class="mod_upp_sel" id="mod_upp_sel_act_1">
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                        </select>
                	</td>
                </tr>
        
                <tr class="tr">
                    <td class="td">
                    </td>
                    <td class="td">
                        <button type="submit" name="submit" value="submit" class="upp_but_sub btn btn-primary sig_con_but_sub" id="mod_upp_but_sub_1" disabled>Create</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>