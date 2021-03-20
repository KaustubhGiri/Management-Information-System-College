<style type="text/css">
      a.dropdown-toggle::after
    {
        visibility: hidden;
    }
    #span
    {
        display: none;
        margin-left: -20px;
    }
input
{
    border: 0!important;
    border-bottom: 1px solid black!important;
}
input:focus
{
    border: 0;
    border-bottom: 0!important;
    outline: 0;
}
</style>
<script type="text/javascript">
    function myfun()
    {
       
    var x=document.getElementById('fgp_upp_lab_pas_6');
    var y=document.getElementById('span');
        if(x.type==='password')
        {
        x.type='text';
        }
        else
        {
        x.type='password';
        }
    }
</script>

<div class="wrapper">
    <div class="upper" id="upper">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/forgotpass.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/fgpin_eye.js"></script>
        
        <style type="text/css">
            td,tr
            {
                border: none!important;
            }
            td:hover
            {
                background-color: #f1f1f1!important;
            }
            tr:hover
            {
                background-color: #f1f1f1!important;
            }
            .alert
            {
                display: none;
                color:red;
                font-size: 12px;
            }
        </style>
            <form action="" method="post">
                <label for="fgpinmsg" class="con_lab_fgp" id="con_lab_fgp_1" style="color:hsla(0,100%,50%,0.5); font-family:"Helvetica Neue",Helvetica,sans-serif;"><?php  echo @$_GET['msg'];?>
                </label>
                <table>
                    <tr>
                        <td><label for="fgp_upp_inp_tex_2" class="fgp_upp_lab_use" id="fgp_upp_lab_use_2">Admin Username:&nbsp&nbsp</label><br></td>
                        <td><div class="group"><input type="email" class="fgp_upp_inp_tex" id="fgp_upp_inp_tex_2" name="admin_username" autofocus required><span class="bar"></span><br></td>
                        <td>
                            <span id='fgp_upp_spa_1' class="alert">Use Admin Username.</span><br>
                        </td>
                    </tr>
                    <tr> 
                        <td><label for="fgp_upp_inp_tex_3" class="fgp_upp_lab_pas" id="fgp_upp_lab_pas_3">Admin Password:&nbsp&nbsp</label><br></td>
                        <td><div class="group"><input type="password" class="fgp_upp_inp_tex" id="fgp_upp_inp_tex_3" name="admin_password"><span id="span" class="fa fa-eye" onclick="myfun()"></span><span class="bar"></span><br></td>
                        <td>
                            <span id='fgp_upp_spa_2' class="alert">Use Admin password.</span><br>
                        </td>

                    </tr>
                    <tr>
                        <td><label for="fgp_upp_inp_tex_4" class="fgp_upp_lab_use" id="fgp_upp_lab_use_4">Username to reset Password:&nbsp&nbsp</label><br></td>
                        <td><div class="group"><input type="email" class="fgp_upp_inp_tex" id="fgp_upp_inp_tex_4" name="username" autofocus required><span class="bar"></span><br></td>
                        <td>
                            <span id='fgp_upp_spa_3' class="alert">Use your Email ID as your Username.</span><br>
                        </td>
                    </tr>
                    <tr> 
                        <td><label for="fgp_upp_inp_tex_5" class="fgp_upp_lab_pas" id="fgp_upp_lab_pas_5">New Password:&nbsp&nbsp</label><br></td>
                        <td><div class="group"><input type="password" class="fgp_upp_inp_tex" id="fgp_upp_inp_tex_5" name="password"><span id="span" class="fa fa-eye" onclick="myfun()"></span><span class="bar"></span><br></td>
                         <td>
                            <span id='fgp_upp_spa_4' class="alert">Contains atleast one character, one number, one special character and length between 6  to 12.</span><br>
                        </td>
                    </tr>
                    <tr> 
                        <td><label for="fgp_upp_inp_tex_6" class="fgp_upp_lab_pas" id="fgp_upp_lab_pas_6">Confirm New Password:&nbsp&nbsp</label><br></td>
                        <td><div class="group"><input type="password" class="fgp_upp_inp_tex" id="fgp_upp_inp_tex_6" name="confirmnewpassword"><span id="span" class="fa fa-eye" onclick="myfun()"></span><span class="bar"></span><br></td>
                         <td>
                            <span id='fgp_upp_spa_5' class="alert">Password does not match as above entered password.</span><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input style="margin: 0" type="submit" name="forgot" value="Reset Password" class="fgp_upp_inp_sub btn btn-primary sig_con_but_sub" id="fgp_upp_inp_sub_1" disabled>
                        </td>

                    </tr>   
                    <tr>
                        <td>
                        </td>
                        <td class="td">
                            <a href="<?php echo site_url(); ?>/login" class="btn btn-primary sig_con_but_sub">Login</a><br>
                        </td>
                    </tr>   
                </table>     
            </form>
        
        </div>
    </div>
</div>

