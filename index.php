<?php require_once 'common/global_constants.php'; 
?>

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

            if(isset($_SESSION['user'])){
                $id = $_SESSION['user'];
                $sql = "SELECT UserID, FirstName, LastName, Email, DOB FROM Users WHERE UserID ='$id' ";
            }
            elseif (isset($_SESSION['emp'])) {
                $id = $_SESSION['emp'];
                $sql = "SELECT EmployeeID, Post, FirstName, LastName, Email, DOB FROM Employees WHERE EmployeeID = '$id';";
            }
            else{
                echo "Invalid login";
                die;
            }


            if(! $result = $mysqli->query($sql)){
               echo "Query Error!";
            }

            $result->data_seek(0);
            $row = $result->fetch_assoc();

            ?>

            <style type="text/css">
               table, tr, td, th {
                /* To get lines for the table, make pretty later */
                border: 1px solid black;
               }
            </style>
        
            <table class="index">
                <tr>
                    <td> ID: </td>
                    <td> <?= $id ?> </td>
                </tr>

                <!-- TR for Post -->
                <?php
                if(isset($_SESSION['emp'])){
                ?>
                    <tr>
                        <td>Post:</td>
                        <td> <?= $row['Post']?></td>
                    </tr>
                <?php
                }
                ?>

                <tr>
                    <td>Full Name:</td>
                    <td> <?= $row['FirstName'] . " " . $row['LastName'] ?></td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td> <?= $row['Email']?></td>
                </tr>

                <tr>
                    <td>Date of Birth:</td>
                    <td> <?= $row['DOB']?></td>
                </tr>

                <!-- TR for Contact Numbers -->
                <?php 
                if(isset($_SESSION['user'])){
                ?>

                <tr>
                    <td>Phone Numbers:</td>
                    <td>
                        <?php 
                        $result = $mysqli->query(
                            "SELECT group_concat(u_contact.contact separator ', ') as 'phones' from u_contact join users on u_contact.userid = users.userid where users.userid = '$id' ;");
                        if(!$result){
                            echo " error in phone number";
                        }
                        $result->data_seek(0);
                        $phone_row = $result->fetch_assoc();
                        $str_phones = $phone_row['phones'];

                        echo $str_phones;
                        ?>
                    </td>
                </tr>
                <?php 
                }
                ?>

            </table>

            <?php
            $mysqli->close();
        ?>

    </div>
    
</body>
</html>