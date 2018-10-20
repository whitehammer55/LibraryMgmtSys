        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style.php">
<?php
    require_once 'common/global_constants.php';

    function isLoginCredentialsValid($userid, $password){
     
        // Boolean to determine if valid credentials or not
        $valid_login = false;      
        
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($mysqli->connect_errno){
           echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
           die;
        }
 
        $result = $mysqli->query("Select UserID from users where UserID='$userid' and Password = '$password';");

        if(!$result){
            echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
        }


        if($result->num_rows != 0){
            // if student
                
            // if retrieved rows are more than zero, then correct login
            $_SESSION['user'] = $userid;
            $valid_login = true;
            
            unset($_SESSION['emp']);

        }// if student
        else {

            $result = $mysqli->query(
                    "SELECT * FROM employees where EmployeeID='$userid' and Password='$password';");
            if(!$result){
                echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            if ($result->num_rows > 0) {
                // if employee
                
                // if retrieved rows are more than 0, then correct login
                $_SESSION['emp'] = $userid;
                $valid_login = true;

                unset($_SESSION['user']);
                                
             }// if employee

        } //else end

        // echo "$valid_login";
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
            // and the other will be unset
            // $_SESSION['user']
            // $_SESSION['emp']
            
            if(isset($_POST['checkbox'])){
                setcookie('u_id',$userid, time() + 60*60*7);
            
                setcookie('u_pwd',$password, time() + 60*60*7);
                   // cookie created

                if(isset($_SESSION['user'])){
                    $type = 'user';
                }
                elseif(isset($_SESSION['emp'])){
                    $type = 'emp';
                }
                // else doesn't come since one of the session variables
                // is set in the isLoginCredentialsValid function

                setcookie('user_type', $type, time() + 60*60*7);
            }  

            echo "<body class='bg'>
                    <div class='container'>
                        <div class='row col-sm-10'>
                            <div>
                                <div class='form-group form-check login'>
                                    <h1 class='login-validation'>HELLO, $userid !!</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>";


            // Send user to index.php
            ?>
            <script type="text/javascript">
                window.location.href = "index.php";
            </script>

            <?php

        } else{
            // redirect to login page

            echo $valid_login;

            echo "<script>alert('Wrong UID Or Password');
            window.location.href='login.php';
            </script>";

        }

    }// if POST
?>