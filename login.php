<?php require 'common/global_constants.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css"href="style.php">
</head>
    <title>Login</title>
</head>
<body>
    <div class="login">
        <div class="login-triangle"></div>
        
        <h1 class="login-header">Login Here</h1>
        <form action="login_validation.php" name="form1" method="post" class="login-container">
            
            
            <p>User ID:
            <input type="text" name="u_id" id="u_id" placeholder="Enter ID">
            </p>
            
            <p>Password:
            <input type="password" name="u_pwd" id="u_pwd" placeholder="Enter password">
            </p>

            <p>
            <input type="submit" name="submit"  value="Submit">
            </p>
            
            <p>
                <label class="container">Remember Me
                <input type="checkbox" name="checkbox" value="1">
                <span class="checkmark"></span>
                </label>
            </p>

            <p>
            Don't have an account? <a href="sign_up.php">Sign up</a>
            </p>

        </form>

        
    </div>

    <?php  

        if(isset($_COOKIE['u_id']) and isset($_COOKIE['u_pwd']) and isset($_COOKIE['user_type'])){
	       $u_id=$_COOKIE['u_id'];
	       $u_pwd=$_COOKIE['u_pwd'];

           $type = $_COOKIE['user_type'];

           $_SESSION[$type] = $u_id;

	       header("location:index.php");
        }   

    ?>

</body>
</html>