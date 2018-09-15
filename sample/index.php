<?php require_once 'global_constants.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style type="text/css">
        .header {
            background-color: #fef230;
        }
        .main-content {
            background-color: #ff0000;
            margin-left: <?php echo SIDE_NAV_WIDTH; ?>;
            padding-left: 10px;
        }
        .nav-bar {
            background-color: #ffb3b3;
            width: <?php echo SIDE_NAV_WIDTH; ?>;
            position: fixed; /* Fixed Sidebar (stay in place on scroll) */
            height: 100%; /* Full-height */
            z-index: 1;  /*Stay on top */

        }
    </style>

</head>
<body>
    <div class="header" style>

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

        <h1>YES</h1>
    </div>
    
</body>
</html>