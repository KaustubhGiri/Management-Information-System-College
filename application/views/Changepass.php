<style type="text/css">
      a.dropdown-toggle::after
    {
        visibility: hidden;
    }
/* input
{
    border: 0!important;
    border-bottom: 1px solid black!important;
}
input:focus
{
    border: 0;
    border-bottom: 0!important;
    outline: 0;
} */
</style>
<script type="text/javascript">
    function myfun(nid)
    {
       
    var x=document.getElementById(nid);
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

        <script type="text/javascript" src="<?php echo base_url(); ?>js/changepass.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>js/login_eye.js"></script>
        
        <style type="text/css">
            /* td,tr
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
            } */
            .alert
            {
                display: none;
                color:red;
                font-size: 12px;
            }
            #chpeye1 , #chpeye2{display: none;}
        </style>
            <form action="" method="post">
                <label for="loginmsg" class="chp_upp_lab_pas" id="chp_upp_lab_pas_1" style="color:hsla(0,100%,50%,0.5); font-family:"Helvetica Neue",Helvetica,sans-serif;"><?php  echo @$_GET['msg'];?>
                </label>
                <table class="table" id="table">
                    <tr class="tr"> 
                        <td class="td">
                            <label for="chp_upp_inp_pas_2" class="chp_upp_lab_pas" id="chp_upp_lab_pas_2">New Password:&nbsp&nbsp</label><br>
                        </td>
                        <td class="td">
                            <div class="group">
                                <input type="password" class="chp_upp_inp_pas" id="chp_upp_inp_pas_2" name="newpassword"><span id="chpeye1" class="fa fa-eye" onclick="myfun(this.id)" autofocus></span>
                                <span class="bar"></span></div><br>
                        </td>
            
                        <td class="td">
                            <span id='chp_upp_spa_1' class="alert">Contains atleast one character, one number, one special character and length between 6  to 12.</span>
                        </td>

                    </tr>
                    <tr class="tr"> 
                        <td class="td">
                            <label for="chp_upp_inp_cnp_3" class="chp_upp_lab_cnp" id="chp_upp_lab_cnp_3">Confirm New Password:&nbsp&nbsp</label><br>
                        </td>
                        <td class="td">
                            <div class="group">
                                <input type="password" class="chp_upp_inp_cnp" id="chp_upp_inp_cnp_3" name="confirmnewpassword"><span id="chpeye2" class="fa fa-eye" onclick="myfun(this.id)"></span>
                                <span class="bar"></span></div><br>
                        </td>
                        <td class="td">
                            <span id='chp_upp_spa_2' class="alert">Password does not match with above entered password.</span>
                        </td>
                    </tr>
                    <tr class="tr">
                        <td class="td"></td>
                        <td class="td">
                            <input style="margin: 0" type="submit" name="changepass" value="Change Password" class="btn btn-success" id="chp_upp_inp_sub_1" disabled>
                        </td>
                        <td class="td"></td>
                    </tr>   
                </table>     
            </form>
        </div>
    </div>

