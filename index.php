<?php require_once 'common/global_constants.php'; 
?>
<?php
include_once'includes/db.php';  //  includes the file to connect to the data base
session_start(); // related to session variable set down
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

        function isLoginCredentialsValid($userid, $password, $uid, $upswd){
         
            if($uid==$userid and $upswd == $password){

               return true;     

            }
            else{
                
                return false;
            }

           // return true;
        }
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

        // check if POST request
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form 
        

            $userid   = isset($_POST["u_id"])  ? $_POST["u_id"]  : '0';
            $password = isset($_POST["u_pwd"]) ? $_POST["u_pwd"] : '0';

            // check if these elements are available
            // if not, then use '0' as default value
            $conn;   // connection from db.php stored here

            $empRegX="[2]";   // using regex to sort out employee ID from user ID
            if(!preg_match($empRegX, $userid)){


            $Users = "SELECT * FROM users where UserID='$userid' and Password='$password'";
            $result = mysqli_query($conn, $Users);
            $EMP=false;  // using boolean to change  between index.php and tempEMP.php

            if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                while($row = mysqli_fetch_assoc($result)) 
                {
                        $uid=$row['UserID'];
                        $upswd=$row['Password'];

                }

                                
             } //2nd if loop

            }// 1st if loop

            else if(preg_match($empRegX, $userid)){

                $emp = "SELECT * FROM employees where EmployeeID='$userid' and Password='$password'";
                $result = mysqli_query($conn, $emp);
                $EMP=true;
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) 
                    {
                            $uid=$row['EmployeeID'];

                            $upswd=$row['Password'];
                            

                    }
                    

                                    
                 }// if loop end



            } //else if loop end


             else {
                    echo "0 results";
                }   


            if (isLoginCredentialsValid($userid, $password, $uid ,$upswd )){   // userid is the user entered UID /EID
                // uid is the uid matched from the databse
                // if user login is correct
                if(isset($_POST['checkbox'])){
                    setcookie('u_id',$userid, time() + 60*60*7);
                
                    setcookie('u_pwd',$password, time() + 60*60*7);
                       // cookie created
                }  

                if($EMP==true){
                    header("location:tempEmp.php"); // displays the emp ID
                }     
                
                                                           // using sessions  to store userId for other uses
                $_SESSION['u_id']=$userid; //stores emp/ students  id in to session var


                echo "HELLO, " . $userid . "<br>";

            }
            else{
                // redirect to login page

                echo "<script>alert('Wrong UID Or Password');
                window.location.href='login.php';
                </script>";
               
               
            }

        }// POST

        ?>

    </div>
    
</body>
</html>