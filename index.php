<?php require_once 'common/global_constants.php'; 
?>
<?php
include_once'includes/db.php';  //  includes the file to connect to the data base

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="style.php">

    
    <?php 

        
     ?>
</head>
<body>
    <div class="header">

        <?php
            // Uses absolute path when no forward slash
            // Refer: https://stackoverflow.com/a/36577021
            require_once 'common/header.php' ; ?>

    </div>

    <div class="nav-bar">
        <?php 
            // Uses absolute path when no forward slash
            // Refer: https://stackoverflow.com/a/36577021
            require_once 'common/nav-bar.php' ?>
    </div>

    <div class="main-content">

        <?php

        // REMOVE
        echo "
        <h1>
        HELLO USERNAME
        </h1>";
        // REMOVE

        
        ?>

    </div>
    
</body>
</html>