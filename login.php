<?php require 'common/global_constants.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <div class="loginbox">
        <img src="user.png" class="user">
        <h1>Login Here</h1>
        <form action="login_validation.php" name="form1" method="post">
            
            
            <label  >User ID:</label>
            <input type="text" name="u_id" id="u_id" placeholder="Enter ID">
            <!-- TODO: remove br -->
            <br> 

            <label >Password:</label>
            <input type="password" name="u_pwd" id="u_pwd" placeholder="Enter password">
            <input type="submit" name="submit"  value="Submit">
            <br>

            <input type="checkbox" name="checkbox" value="1">Remember Me

        </form>

        <div>
            Don't have an account? <a href="sign_up.php">Sign up</a>
        </div>
    </div>

    <?php  

        if(isset($_COOKIE['u_id']) and isset($_COOKIE['u_pwd'])){
	       $u_id=$_COOKIE['u_id'];
	       $u_pwd=$_COOKIE['u_pwd'];
	       header("location:index.php");
}   

    ?>

</body>
</html>