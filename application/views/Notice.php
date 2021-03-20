<style type="text/css">
input
{
    margin-right: -30px;
}
legend
{
    margin-left: 30%;
}
</style>
<div class="wrapper">
    <div class="upper" id="upper">
            <h4 class="titleofpage">New Notice</h4><br/>
                <label id="upp_inp_tex_3">User Type : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <input type="radio" name="user_type" value="S" class="upp_inp_tex" id="not_upp_rad_1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="not_upp_rad_1">Student</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <input type="radio" name="user_type" value="E" class="upp_inp_tex" id="not_upp_rad_2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="not_upp_rad_2">Employee</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <input type="radio" name="user_type" value="G" class="upp_inp_tex" id="not_upp_rad_3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="not_upp_rad_3">General</label>

                <form id="" action="" method="post">
                    <table class="table">     
                        <tr class="tr">
                            <td class="td">
                                <label for="not_upp_inp_tex_1" id="not_upp_lab_tex_1" class="not_upp_lab">Title :</label>
                            </td>
                            <td class="td">
                                <input type="text" id="not_upp_inp_tex_1" class="not_upp_inp_tex" name="title" maxlength="25" title="Title" placeholder="Enter Title">
                            </td>
                        </tr>
                        <tr class="tr">
                            <td class="td">
                                <label id="not_upp_lab_tex_2" for="not_upp_inp_tex_2" class="not_upp_lab">Description :</label>
                            </td>
                            <td class="td">
                                <textarea id="not_upp_inp_tex_2" class="not_upp_texa_tex" name="description" maxlength="255" placeholder="Enter Description"></textarea>
                            </td>
                        </tr>

                        <tr class="tr">
                            <td class="td">
                                <label id="not_upp_lab_tex_3" for="not_upp_dat_dat_1" class="not_upp_lab">Date :</label>
                            </td>
                            <td class="td">
                                <input type="date" id="not_upp_dat_dat_1" class="not_upp_dat" name="date">
                            </td>
                        </tr>
                    
                        
                        <tr class="tr">
                            <td class="td">
                                <label id="not_upp_lab_tex_4" for="not_upp_sel_tex_1" class="not_upp_lab" >Active :</label>
                            </td>
                            <td class="td">
                                <select name="status" id="not_upp_sel_tex_1" class="not_upp_sel">
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="tr">
                            <td class="td">
                            </td>
                            <td class="td">
                                <input type="submit" name="submit" value="Create" class="btn btn-primary">
                            </td>
                        </tr>
                    </table>
                </form>
    </div>
</div>
