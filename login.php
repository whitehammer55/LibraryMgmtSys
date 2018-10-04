<?php require 'common/global_constants.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.php">

    <style type="text/css">

.rkmd-checkbox {
  color: #818181;
  font-size: 15px;
  font-weight: bold;
  font-family: 'Roboto', sans-serif;
  letter-spacing: .5px;

  .input-checkbox {
    position: relative;
    display: inline-block;
    width: 32px;
    height: 32px;
    text-align: center;
    vertical-align: -9px;

    input[type="checkbox"] {
      visibility: hidden;
      position: absolute;
      left: 7px;
      bottom: 7px;
      margin: 0;
      padding: 0;
      outline: none;
      cursor: pointer;
      opacity: 0;

      & + .checkbox:before {
        position: absolute;
        left: 4px;
        bottom: 8px;
        width: 18px;
        height: 18px;
        font-family: 'Material Icons';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        text-transform: none;
        letter-spacing: normal;
        word-wrap: normal;
        white-space: nowrap;
        direction: ltr;
        vertical-align: -6px;

        /* Support for all WebKit browsers. */
        -webkit-font-smoothing: antialiased;
        /* Support for Safari and Chrome. */
        text-rendering: optimizeLegibility;

        /* Support for Firefox. */
        -moz-osx-font-smoothing: grayscale;

        /* Support for IE. */
        font-feature-settings: 'liga';

        transition: all .2s ease;
        z-index: 1;
      }

      & + .checkbox:before { content: "\e835"; color: #717171; }

      &:checked + .checkbox:before { content: "\e834"; }

      &:active:not(:disabled) + .checkbox:before { transform: scale3d(0.88, 0.88, 1); }

      &:disabled + .checkbox:before { color: rgba(0,0,0,0.157) !important; }
    }
  }

  &.checkbox-light {
    label, .label { color: #FFF; }
    input[type="checkbox"] + .checkbox:before { color: #FFF; }
    input[type="checkbox"]:disabled + .checkbox:before { color: #5d5d5d !important; }

    &.checkbox-rotate {
      input[type="checkbox"] + .checkbox:before { border-color: #FFF; }
      input[type="checkbox"]:disabled + .checkbox:before { border-color: #5d5d5d !important; }
    }
  }

  label, .label { cursor: pointer; }
}
    </style>
</head>
    <title>Login</title>
</head>
<body class="bg">
    <div class="container">
        <div class="row col-sm-10" style="width: 500px; margin-left: 300px; margin-top: 50px;">

        <div class="jumbotron">

        <div class="form-group" style="margin-top: -50px; ">

        <h1 style="margin-left: 150px;">Login</h1>

<hr>
        <form action="login_validation.php" name="form1" method="post" class="form-horizontal"  style="margin-left: 50px; ">
            
            <div class="form-group input-group">
            <p>User ID:
            <input type="text" name="u_id" id="u_id" placeholder="Enter ID" class="form-control"  style="width: 300px; border-radius: 15px;">
            </p>
            </div>

            <div class="form-group input-group">
            <p>Password:
            <input type="password" name="u_pwd" id="u_pwd" placeholder="Enter password" class="form-control" style="width: 300px;border-radius: 15px">
            </p>
            </div>

            <div class="form-group input-group">
            <p>
            <input type="submit" name="submit"  value="Submit" class="form-control btn btn-success" style="width: 300px; border-radius: 15px;">
            </p>
            </div>

            <div class="col-md-4">
            <div class="checkbox checkbox-inline checkbox-success">
            <input type="checkbox" id="checkbox3" name="checkbox" value="1" checked autocomplete="off" >
            <label for="checkbox3" style="margin-bottom: 10px;">Remember Me</label>
            </div>
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