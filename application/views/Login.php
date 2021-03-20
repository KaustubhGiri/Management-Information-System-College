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
</style>
<script type="text/javascript">
    function myfun()
    {
       
    var x=document.getElementById('log_upp_inp_pas_2');
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
    <div class="upper"  id="upper">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/JQuery.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/login.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/login_eye.js"></script>
        
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
                <label for="loginmsg" class="con_lab_log" id="con_lab_log_1" style="color:hsla(0,100%,50%,0.5); font-family:"Helvetica Neue",Helvetica,sans-serif;"><?php  echo @$_GET['msg'];?>
                </label>
                <table class="table" id="table">
                    <tr class="tr">
                        <td class="td"><label for="log_upp_inp_tex_1" class="log_upp_lab_use" id="log_upp_lab_use_2">Username:&nbsp&nbsp</label><br></td>
                        <td class="td"><div class="group"><input type="email" class="log_upp_inp_tex" id="log_upp_inp_tex_1" name="username" autofocus required><span class="bar"></span><br></td>
                        <td class="td">
                            <span id='log_upp_spa_email' class="alert">Use your Email ID as your Username.</span><br>
                        </td>
                    </tr>
                    <tr class="tr"> 
                        <td class="td"><label for="log_upp_inp_pas_2" class="log_upp_lab_pas" id="log_upp_lab_pas_3">Password:&nbsp&nbsp</label><br></td>
                        <td class="td"><div class="group"><input type="password" class="log_upp_inp_pas" id="log_upp_inp_pas_2" name="password"><span id="span" class="fa fa-eye" onclick="myfun()"></span><span class="bar"></span><br></td>
                    </tr>
                   
                    <tr class="tr">
                        <td class="td">
                        <a href="<?php echo site_url(); ?>/Password" class="btn btn-secondary">Forgot Password</a><br>
                        </td>
                       	 <td class="td">
                            <input type="submit" name="login" value="Login" class="btn btn-success" id="log_upp_inp_sub_1" disabled="true">
                       	 </td>
                        <td class="td">
                        </td>
                        <td class="td">
                        </td>
                    </tr> 
                </table>     
            </form>
        </div>
    </div>
</div>

