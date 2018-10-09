<?php require_once 'common/global_constants.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.php">
    <script type="text/javascript">
        function validateForm() {
            
            // Check for email
            if(! /[\w]+@[\w]+\.[\w]{3}/.test(document.register_form.Email.value)){
                // Validate email
                alert("Please enter a valid email.");
                return false;
            }


            arr = [];
            s_arr = document.register_form.PhoneNumber.value.split(',');
            for(var i=0; i < s_arr.length; i++){
                
                elem = s_arr[i];
                elem = elem.trim();

                if(elem){
                console.log('a' + elem.trim() + 'a\n');

                if(/^[\d]{10,10}$/.test(elem) ){
                    // valid num
                    arr.push(elem.trim());
                } 
                else {
                    // invalid num
                    alert(elem + ' is not valid 10 digit number!');
                    return false;
                    }
                }
            }

            // Put correct formatted value in input so POST receieves it correctly
            document.register_form.PhoneNumber.value = arr.join('|');

            return true;
        }
    </script>
</head>
<body style="background-color: #D8BFD8">

    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        // assuming all form variables are set

        // echo "POSTED";

        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($mysqli->connect_errno){
           echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
           die;
        }

        $result = $mysqli->query("select count(userid) as 'count' from users;");
        $result->data_seek(0);
        $row = $result->fetch_assoc();
        $total_users = $row['count'];
        $new_user_id = 100 + $total_users + 1;

        $password   = $_POST['Password'];
        $email      = $_POST['Email'];
        $first_name = $_POST['FirstName'];
        $last_name  = $_POST['LastName'];
        $dob        = $_POST['DOB'];
        $str_phone  = $_POST['PhoneNumber'];

        $arr_phone = explode('|', $str_phone);
        foreach($arr_phone as $val){
            // print_r($val);
            if(!$mysqli->query(
                "INSERT INTO U_Contact(UserID, Contact) "
                . " VALUES ('$new_user_id', '$val');")){
                echo "phone number insert failed";
            }

        }
        unset($val); // Remove reference to array variable


        ?>
        
        <p>User ID: <?= $new_user_id ?></p>

        <?php
        $insert_sql = 
        "INSERT INTO Users(UserID, Password, Email, DOB, FirstName, LastName) "
        . " VALUES ('$new_user_id', '$password', '$email', '$dob', '$first_name', '$last_name');";

        if(!$mysqli->query($insert_sql)){
            echo "Query Failed!";
        }

        ?>

        <p>You have successfully registered!</p>
        <p>Your UserID is <?= $new_user_id ?>!</p>

        <p id="timer-p"></p>

        <script type="text/javascript">
            function redirect(){
                window.location = "login.php";
            }

            // https://stackoverflow.com/a/9989343
            var seconds_left = 12000;
            document.getElementById('timer-p').innerHTML = 
                    "You will be redirected to the login page in " + (seconds_left) + " seconds!";
                    
            var interval = setInterval(function() {
                document.getElementById('timer-p').innerHTML = 
                    "You will be redirected to the login page in " + (--seconds_left) + " seconds!";
                    
                if (seconds_left <= 0)
                {
                    document.getElementById('timer-p').innerHTML = 'Redirecting you now!';
                    clearInterval(interval);
                    redirect();
                }
            }, 1000);

        </script>
            
        <?php
        $mysqli->close();
    } // if post request
    else{    
        ?>
        <div class="container">
            <div class="col-sm-10" style="width: 550px; margin-left: 300px; margin-top: 50px;">

        <div class="jumbotron">

        <div class="form-group form-check" style="margin-top: -50px;">

            <h1 style="margin-left: 125px;">Sign Up</h1>

<hr>
    <form name="register_form" action="<?= $_SERVER['PHP_SELF']?>" method="POST" onsubmit="return validateForm();" class="form-horizontal" style="margin-left: 50px;">

        <div class="form-group input-group">
        <p>First Name:
        <input type="text" name="FirstName" required
        class="form-control" placeholder="Enter First Name" style="width: 300px;border-radius: 15px">




    </p>
    </div>
        
        <div class="form-group input-group">
        <p>Last Name:
        <input type="text" name="LastName" required class="form-control" placeholder="Enter Last Name" style="width: 300px;border-radius: 15px">
    </div>
        
        <div class="form-group input-group">
        <p>Email:
        <input type="text" name="Email" required
        class="form-control" placeholder="Enter Email Address" style="width: 300px;border-radius: 15px">



    </p>
    </div>
        
        <div class="md-form form-group input-group date">
        <p>Date of Birth: 
        <input type="date" name="DOB" required
        class="form-control" placeholder="Enter Date in dd/mm/yyyy format" style="width: 300px;border-radius: 15px">


    </p>
    </div>

        <div class="form-group input-group">
        <p>Password: 
        <input type="password" name="Password" required class="form-control" placeholder="Enter Password" style="width: 300px;border-radius: 15px">

    </p>
    </div>
        
        <div class="form-group input-group">
        <p>Contact No: (Separated with ',')
        <input type="text" name="PhoneNumber" required class="form-control" placeholder="Enter Contact No" style="width: 300px; border-radius: 15px">
    </p>
    </div>
        
        <div class="form-group input-group">
            <p>
        <input type="submit" value="Submit" class="form-control btn btn btn-primary custom-btn" style="width: 300px; background-color: #001064;
  border-color: #001064; border-radius: 15px">
    </p>
        </div>

    </form>
    </div>
</div>
</div>
    <?php
    } // if not post request
    ?>
    
</body>
</html>