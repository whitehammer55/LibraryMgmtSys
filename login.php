<?php require 'common/global_constants.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="col-sm-10" style="width: 600px; margin-left: 250px; margin-top: 50px;">

        <div class="jumbotron">

        <div class="form-group" style="margin-top: -50px;">

        <h1 style="margin-left: 50px;">Login</h1>

<hr>
        <form action="login_validation.php" name="form1" method="post" class="form-horizontal" style="margin-left: 50px;">
            
            <div class="form-group, input-group">
            <p>User ID:
            <input type="text" name="u_id" id="u_id" placeholder="Enter ID" class="form-control">
            </p>
            </div>

            <div class="form-group, input-group">
            <p>Password:
            <input type="password" name="u_pwd" id="u_pwd" placeholder="Enter password" class="form-control">
            </p>
            </div>

            <div class="form-group, input-group">
            <p>
            <input type="submit" name="submit"  value="Submit" class="form-control btn btn-danger btn-info" style="width: 205px;">
            </p>
            </div>

            <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-primary active " style="width: 205px;">
            <input type="checkbox" name="checkbox" value="1"> Remember Me
            </label>
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