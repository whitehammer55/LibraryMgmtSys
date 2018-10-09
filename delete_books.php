
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

        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($mysqli->connect_errno){
           echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
           die;
        } 

        ?>
        <div class="main-content">
            <div class="container-fluid">
                  <form name='delete_books' method='POST' class="form-horizontal">
                        <div class="form-group input-group">
                        <p>Enter the BookID of the book :
                        <input type="number" style="width: 350px; border-radius: 15px; margin-top: 20px;" class="form-control" name="BookID" required>
                        </p>
                        </div>
                        <div class="form-group input-group">
                            <p>
                        <input type="submit" style="width: 350px; border-radius: 15px; background-color: #001064; border-color: #001064;" class="form-control btn btn-primary custom-btn" name="submit">
                        </p>
                        </div>
                    </div>
        </div>
        </form>
        <?php

        if(isset($_POST['submit'])){

            $bookid = $_POST['BookID'];
            
            $result = $mysqli->query("Select BookID from books where BookID='$bookid';");
            if(!$result){
                echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            if($result->num_rows != 0){  
                
                $r = $mysqli->query("delete from books where bookID='$bookid';");
                $s = $mysqli->query("delete from b_author where bookID='$bookid';");
                if(!$r){
                    echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
                }
                if(!$s){
                    echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
                }

                $r = $mysqli->query("delete from b_author where bookID='$bookid';");
                if(!$r){
                    echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
                }

                echo"<script>alert('Book number $bookid successfully deleted');</script>";

            } else{
                echo"<script>alert('Book number $bookid not in the datababse');</script>";
            }
        }// if post submit set

        ?>
    </div>
    
</body>
</html>