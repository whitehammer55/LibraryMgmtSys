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
        <script type="text/javascript">
            function validateForm(){
                u_id = document.getElementById('u_id').value;
                if(u_id == ""){
                    alert("User ID field can't be empty.");
                    return false;
                }
                if(! /^[\d]+$/.test(u_id)){
                    // ensure u_id is numeric
                    alert("User ID can only be numeric");
                    return false;
                }

                u_pwd = document.getElementById('u_pwd').value;
                if(u_pwd.length < 5){
                    // pwd should be longer than 5
                    alert("Password length should be more than 5");
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body class="bg">
        <div class="container">
            <div class="row col-sm-10">
                <div>
                    <div class="form-group form-check login">
                        <h1 class="login-header">Login</h1>
                        <hr>
                        <form action="login_validation.php" name="form1" method="post" class="form-horizontal login"
                        onsubmit="return validateForm();">
                
                            <div class="form-group input-group login">
                                <p>User ID:
                                    <input type="text" name="u_id" id="u_id" placeholder="Enter ID" class="form-control login">
                                </p>
                            </div>

                            <div class="form-group input-group login">
                                <p>Password:
                                    <input type="password" name="u_pwd" id="u_pwd" placeholder="Enter password" class="form-control login">
                                </p>
                            </div>

                            <div class="form-group input-group login">
                                <p>
                                    <input type="submit" name="submit"  value="Submit" class="form-control btn btn-primary custom-btn login">
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