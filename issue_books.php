<?php require_once 'common/global_constants.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
        <link rel="stylesheet" type="text/css" href="style.php">
    </head>
    <body class="bg">
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

        <div class="container-fluid">
                <div class="main-content">           
                    <?php 

                        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                        if($mysqli->connect_errno){
                           echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                           die;
                        }

                        ?>

                    <form name="issue_books" method="POST" class="form-horizontal ibks">
                        <div class="form-group input-group ibks">
                            <p class="p ibks">Enter the Book ID :
                                <input type="number" class="form-control ibks" name="BID" required>
                            </p>
                        </div>
                        <div class="form-group input-group ibks">
                            <p class="p ibks">Enter the Student ID :
                                <input type="number" class="form-control ibks" name="PID" required>
                            </p>
                        </div>
                        <div class="form-group input-group ibks">
                            <p class="p ibks">
                                <input type="submit" name="submit" class="form-control btn btn-primary custom-btn ibks">
                            </p>
                        </div>
        <?php 
            if(isset($_POST['submit'])){
                $BID= $_POST['BID'];
                $PID= $_POST['PID'];
                $EMP = $_SESSION['emp'];
                $date_now = date("Y-m-d");
                $book_available=false;
                $valid_user = false;

                // Check if book exists
                    $result = $mysqli->query("SELECT BookID FROM Books WHERE BookID = '$BID';");
                    if(!$result){
                        echo "select error";
                        die;
                    }

                    if($result->num_rows == 0){
                        echo "<script>alert('No Such Books');</script>";
                        die;
                    }

                // Check if user exists
                    $result = $mysqli->query("SELECT UserId FROM Users WHERE UserID = '$PID';");
                    if(!$result){
                        echo "select error";
                        die;
                    }

                    if($result->num_rows == 0){
                        echo "<script>alert('No Such User');</script>";
                        die;
                    }

                // Check if book has been issued
                    $result = $mysqli->query("Select BookID from books where BookID= '$BID' and UserId is  NULL");
                    if(!$result){
                            echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
                    }

                    if($result->num_rows != 0){     
                        $book_available = true;
                    } else{
                        echo"<script>alert('ERROR: Book has already been issued!');</script>";
                        die;
                    }

                $check_user = $mysqli->query("select employeeID from employees where employeeID=$PID");

                if($check_user->num_rows == 0){
                    $valid_user = true;
                }

                if(($book_available && $valid_user)== true){
                    $r = $mysqli->query("update books set UserId ='$PID' , EmployeeID ='$EMP',DOI ='$date_now',DOR =DATE_ADD(DOI, INTERVAL 7 DAY), reissue_count = 0   where BookID='$BID'");
                    if(!$r){
                        echo "update error";
                    }

                    echo "<script>alert('Book Issued Successfully');</script>";

                } else{
                    echo"<script>alert('ERROR');</script>";
                }

            } // if post submit set
        ?>   
                    </form>
                </div>
            </div>
    </body>
</html>