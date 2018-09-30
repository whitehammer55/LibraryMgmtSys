
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
<script type="text/javascript">
    


</script>
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
                        <input type="number" name="BID" required>
                    </td>

                </tr>
                <tr>
                    <td>Enter the Student ID :
                        <input type="number" name="PID" required>
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
                    $valid_user = false;
                    
                    $result = $mysqli->query("Select BookID from books where BookID= '$BID' and UserId is  NULL");
                    if(!$result){
                            echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
                     }
                     if($result->num_rows != 0){     

                        $book_available=true;
                        
                        }
                        else{
                            
                        echo"<script>
                        alert('ERROR: Book has already been issued!');
            
                        </script>";
                        }

                        $check_user=$mysqli->query("select employeeID from employees where employeeID=$PID");
                        if($check_user->num_rows == 0){     

                        $valid_user=true;
                        
                        }




                     if(($book_available && $valid_user)== true){
                        mysqli_query($mysqli,"update books set UserId ='$PID' , EmployeeID ='$EMP',DOI ='$date_now',DOR =DATE_ADD(DOI, INTERVAL 7 DAY)   where BookID='$BID'");
                        


                       echo "<script>alert('Book Issued Successfully');
            
                        </script>";



                     }else{
                        echo"<script>
                        alert('ERROR');
            
                        </script>";
                     }

                }
             ?>

        </form>

        
            
        

    </div>
    
</body>
</html>