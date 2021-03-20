<div id="container">
    <h3><?php echo $message; ?></h3>
        <form action="" method="post">
            <label for="loginmsg" style="color:hsla(0,100%,50%,0.5); font-family:"Helvetica Neue",Helvetica,sans-serif;"><?php  echo @$_GET['msg'];?></label>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"></br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"></br>
            <div id="lower">
                <input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label></br>
                <input type="submit" name="login" value="Login">
            </div>
        </form>
    </div>
