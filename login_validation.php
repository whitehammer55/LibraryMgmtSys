<?php
    session_start();

    function isLoginCredentialsValid($userid, $password){
     
        // Boolean to determine if valid credentials or not
        $valid_login = false;      
        
        // Prevent SQL injection
        // $userid = mysqli_real_escape_string($userid);
        // $password = mysqli_real_escape_string($password);

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


          
        $result = $mysqli->query("Select UserID from users where UserID='$userid' and Password = '$password';");

        if(!$result){
            echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
        }


        if($result->num_rows != 0){     // if student
                
                // if retrieved rows are more than zero, then correct login
                $_SESSION['user'] = 1;
                $valid_login = true;
                                

        }// 1st if loop

        else {

            
            $result = $mysqli->query(
                    "SELECT * FROM employees where EmployeeID='$userid' and Password='$password';");
            if(!$result){
                echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            if ($result->num_rows > 0) {    // if employee
                // output data of each row
                
                // if retrieved rows are moer than 0, then correct login
                $_SESSION['emp'] = 1;
                $valid_login = true;
                                
             }// if loop end



        } //else if loop end

        echo "$valid_login";
       return $valid_login;
    }// end function isLoginCredentialsValid

    // check if POST request
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form 
    
        // check if these elements are available
        // if not, then use '0' as default value
        $userid   = isset($_POST["u_id"])  ? $_POST["u_id"]  : '0';
        $password = isset($_POST["u_pwd"]) ? $_POST["u_pwd"] : '0';

        
        if (isLoginCredentialsValid($userid, $password)) {   
            // if user login is correct

            // One of these will be set when login is valid
            // $_SESSION['user']
            // $_SESSION['emp']
            
            if(isset($_POST['checkbox'])){
                setcookie('u_id',$userid, time() + 60*60*7);
            
                setcookie('u_pwd',$password, time() + 60*60*7);
                   // cookie created
            }  

            echo "HELLO, " . $userid . "<br>";


            // Send user to index.php
            ?>
            <script type="text/javascript">
                window.location.href = "index.php";
            </script>

            <?php

        }
        else{
            // redirect to login page

            echo $valid_login;

            echo "<script>alert('Wrong UID Or Password');
            window.location.href='login.php';
            </script>";
           
           
        }

    }// POST
?>