<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>MIS</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/Sidder.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/Footer.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/header.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/om.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/validation.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/grid.css">
    <!-- External css folder -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    <script type='text/javascript' src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <!-- Font Awesome JS -->
   <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <!-- jQuery CDN - Slim version (=without AJAX)-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
</head>
<style>
  .side{
  float: left;
}
@media screen and (min-width:768px )
{
  #sidebar
  {
    width: 250px;
  }
  .upper
  {
    margin-left: 250px;
  }
}
</style>
<script type="text/javascript">
    /*function fun()
        {
        var x=document.getElementById('sidebar');
        if(x.style.marginLeft!="-200px")
        {  
        document.getElementById('sidebar').style.marginLeft="-200px";
        document.getElementById('sidebar2').style.marginLeft="-200px";
      }
      else
      {
        document.getElementById('sidebar').style.marginLeft="0px"; 
        document.getElementById('sidebar2').style.marginLeft="0px"; 
      }
    }*/
</script>
<body>
    <!-- Javascript for header -->
    <!--header-->
  <header>
  <div class='header_div'>
    <div class="row">
      <div class="col-md-3">
      <?php if($this->session->userdata('login')== 1){ ?>
        <span class="span" style="font-size:30px;cursor:pointer;color: white;" onclick="openNav()"  class="side">&#9776;</span>
      <?php }?>
      </div>    
      <div class="col-md-6">
          <div class='side2'>
            <h3 class='small_header'>GPM</h3>
            <h3 class='big_header'>Government Polytechnic Mumbai</h3>
           <!-- <side>  -->
          </div>
      </div>
      <div class="col-md-3">    
      <?php if($this->session->userdata('login')!=0){?>
        <form method="post" action="">
          <div class="logout">
            <p onclick="dis_log()" class='hea_log_img_icon' id="dcba">
                        <?php echo $this->session->userdata('name'); ?><i class="arrow down"></i></p>
               <div id='hea_log' id="abcd">
                  <img class ="img" src="<?php echo base_url(); ?>/img/123.jpg" alt="img2">
                     <p class="user_name">
                       <?php echo $this->session->userdata('username'); ?>
                     </p>
                     <button class='hea_log_chg_pass'><a href="<?php echo site_url(); ?>/Password">Change Password</a></button><br>
                     <button id="logOut" name="logout">Logout</button>

               </div>
          </div>
        </form>
      <?php }?>
      </div>   
    </div>      
  </div>
  </header>
  <style type="text/css">
    i
    {
      margin-left: 10px;
      margin-top: -10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      display: inline-block;
      padding: 3px;
    }
    .down
    {
      transform: rotate(45deg);
      -webkit-transform:rotate(45deg);
    }
  </style>
    <script>
            

     
function dis_log() {
    var x = document.getElementById("hea_log");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}
 window.onclick=function(event)
{
  if(event.target.id!="abcd"&&event.target.id!="dcba")
  {
    document.getElementById("hea_log").style.display="none";
  }
}

function openNav()
{
  if(document.getElementById("sidebar").style.width=="0px")
  {
  document.getElementById("sidebar").style.width = "250px";
  document.getElementById("upper").style.marginLeft = "250px";
}
else
{
  document.getElementById("sidebar").style.width = "0px";
  document.getElementById("upper").style.marginLeft= "0px";
}
}
</script>