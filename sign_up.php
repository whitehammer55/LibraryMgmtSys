<?php require_once 'common/global_constants.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
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
<body>

    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        // assuming all form variables are set

        echo "POSTED";

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


        print_r("User ID: " . $new_user_id);

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
            var seconds_left = 5;
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

    <form name="register_form" action="<?= $_SERVER['PHP_SELF']?>" method="POST" onsubmit="return validateForm();">

        <label for="FirstName">First Name:</label>
        <input type="text" name="FirstName" required>
        <br>

        <label for="LastName">Last Name:</label>
        <input type="text" name="LastName" required>
        <br>

        <label for="Email">Email:</label>
        <input type="text" name="Email" required>
        <br>

        <label for="DOB">Date of Birth: </label>
        <input type="date" name="DOB" required>
        <br>

        <label for="Password">Password: </label>
        <input type="password" name="Password" required>
        <br>

        <label for="PhoneNumber">Contact No (Separate multiple values with ','):</label>
        <input type="text" name="PhoneNumber" required>
        <br>

        <input type="submit" value="submit">
        <br>

    </form>
    <?php
    } // if not post request
    ?>
    
</body>
</html>