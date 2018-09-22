
<?php require_once 'common/global_constants.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="style.php">

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
        // TODO: Change this to retreivals from database
        echo"
            <table>
                <tr>
                    <th>BOOK TITLE</th>
                    <th>DUE DATE</th>
                </tr>
                <tr>
                    <td>JAMES BOND</td>
                    <td>19-1-1999</td>
                </tr>
                <tr>
                    <td>CHANANDLER BONG</td>
                    <td>10-1-1990</td>
                </tr>
            </table>
            ";
        ?>

    </div>
    
</body>
</html>
