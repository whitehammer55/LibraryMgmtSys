
<!-- 
    This is a template file.
    When creating a new page,
    copy this file, and then modify the main-content div
    as per your needs.

 -->

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
        // Database credentials
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "wdl";


        $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        if($mysqli->connect_errno){
           echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
           die;
        }

        ?>
        
        <form name="issue_books" method="POST">
            <table>
                <tr>
                    <td>Enter the Book ID :
                        <input type="text" name="BID">
                    </td>

                </tr>
                <tr>
                    <td>Enter the Student ID :
                        <input type="text" name="PID">
                    </td>

                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit">
                    </td>

                </tr>
            </table>

            <?php 
                if(isset($_POST['submit'])){
                    $BID= $_POST['BID'];
                    $PID= $_POST['PID'];
                    $EMP = $_SESSION['emp'];
                    $date_now = date("Y-m-d");
                    $book_available=false;
                    
                    $result = $mysqli->query("Select BookID from books where BookID= '$BID' and UserId is  NULL");
                    if(!$result){
                            echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
                     }
                     if($result->num_rows != 0){     

                        $book_available=true;
                        

                        }
                        else{
                            
                        echo"<script>
                        alert('ERROR');
            
                        </script>";

                     

                        }

                     if($book_available){
                        mysqli_query($mysqli,"update books set UserId ='$PID'  where BookID='$BID'");
                        mysqli_query($mysqli,"update books set EmployeeID ='$EMP'  where BookID='$BID'");
                        mysqli_query($mysqli,"update books set DOI ='$date_now'  where BookID='$BID'");
                        mysqli_query($mysqli,"update books set DOR =DATE_ADD(DOI, INTERVAL 7 DAY)  where BookID='$BID'");


                       echo "<script>alert('Book Issued Successfully');
            
                        </script>";



                     }

                }
             ?>

        </form>

        
            
        

    </div>
    
</body>
</html>