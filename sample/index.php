<?php require_once 'global_constants.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="style.php">

    
    <?php 
        function isLoginCredentialsValid($userid, $password){


            return true;
        }
     ?>
</head>
<body>
    <div class="header">

        <?php
            // Uses absolute path when no forward slash
            // Refer: https://stackoverflow.com/a/36577021
            require_once 'header.php' ; ?>

    </div>

    <div class="nav-bar">
        <?php 
            // Uses absolute path when no forward slash
            // Refer: https://stackoverflow.com/a/36577021
            require_once 'nav-bar.php' ?>
    </div>

    <div class="main-content">

        <?php

        // REMOVE
        echo "
        <h1>
        HELLO USERNAME
        </h1>";
        // REMOVE

        // check if POST request
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form 
        

            $userid   = isset($_POST["u_id"])  ? $_POST["u_id"]  : '0';
            $password = isset($_POST["u_pwd"]) ? $_POST["u_pwd"] : '0';
            // check if these elements are available
            // if not, then use '0' as default value


            if (isLoginCredentialsValid($userid, $password )){
                // if user login is correct

                echo "HELLO, " . $userid . "<br>";

            }
            else{
                // redirect to login page
            }

        }// POST

        ?>

    </div>
    
</body>
</html>