<?php require 'common/global_constants.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.php">
    <title>Login</title>
    <style type="text/css">
       .row{
            margin-left: 300px; margin-top: 50px;
       } 
    </style>
</head>
<body class="bg">
    <div class="container">
        <div class="row col-sm-10" id="1">

        <div id="2" style="margin-top: 100px;">

        <div id="3" class="form-group form-check" style="margin-top: -50px; width: 500px;">

        <h1 style="margin-left: 200px;">Login</h1>

<hr>
        <form action="login_validation.php" name="form1" method="post" class="form-horizontal"  style="margin-left: 80px; ">
            
            <div class="form-group input-group">
            <p>User ID:
            <input type="text" name="u_id" id="u_id" placeholder="Enter ID" class="form-control"  style="width: 350px; border-radius: 15px; ">
            </p>
            </div>

            <div class="form-group input-group">
            <p>Password:
            <input type="password" name="u_pwd" id="u_pwd" placeholder="Enter password" class="form-control" style="width: 350px;border-radius: 15px; ">
            </p>
            </div>

            <div class="form-group input-group">
            <p>
            <input type="submit" name="submit"  value="Submit" class="form-control btn btn-primary custom-btn" style="width: 350px; border-radius: 15px; background-color: #001064;
  border-color: #001064;  ">
            </p>
            </div>

            <div class="custom-control custom-checkbox">
            <input type="checkbox" id="checkbox" name="checkbox" value="1" checked autocomplete="off" class="custom-control-input">
            <label for="checkbox" class="custom-control-label">Remember Me</label>
            </div>
            

            <p>
            Don't have an account? <a href="sign_up.php">Sign up</a>
            </p>
            
        </form>
        </div>
        </div>
        </div>
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