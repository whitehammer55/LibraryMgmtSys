
<!-- 
    This is a template file.
    When creating a new page,
    copy this file, and then modify the main-content div
    as per your needs.

 -->

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
    <style type="text/css">

    .main-content {
        background-color: #E2E2E5;
    }
    hr{ 
      height: 1px;
    
      background-color: #0007A0;
      border: none;
    }


    </style>

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
        <div class="main-content">
            
            <div class ='style'>
                

                

                        <?php 

                         $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                        if($mysqli->connect_errno){
                           echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                           die;
                        }
                          
                         
                        $sql = "select user_id from survey where user_id='" . $_SESSION['user'] . "';" ;
                        
                        $bool = $mysqli->query($sql);

                        

                        if($bool->num_rows == 0 ){
                            ?>
                            <table>
                                <form name="survey" method="POST" action="survey_form.php" >
            
                        
                            <p>Your UserID :
                                <input type="number" value ="<?PHP echo $_SESSION['user']; ?>" name="UID" style='width: 150px; border-radius: 15px; margin-top: 20px; 'required>
                            </p>
                    
                        
                            <p> First Name :
                                <input type="text" value ="<?PHP echo $_SESSION['firstName']; ?>" name="firstname" style='width: 150px; border-radius: 15px; margin-top: 20px;' required>
                                Last Name:
                                <input type="text" value ="<?PHP echo $_SESSION['lastName']; ?>" name="lastname" style='width: 150px; border-radius: 15px; margin-top: 20px;' required>
                            </p>

                            <p>Email :
                                <input type="text" value ="<?PHP echo $_SESSION['email']; ?>" name="email" style='width: 350px; border-radius: 15px; margin-top: 20px; 'required>
                            </p>

                            Survey Questions :
                            <hr>


                            1.What was your first impression when you entered the website?
                            <p>
                                <input type='text' name="q1" style='width: 350px; border-radius: 15px; margin-top: 20px; 'required>
                            </p>

                            2. How did you first hear about us?
                            <p>
                                <input type="text" name="q2" style='width: 350px; border-radius: 15px; margin-top: 20px; 'required>
                            </p>

                            3. Is there anything missing on this page?
                            <p>
                                <input type="text" name="q3" style='width: 350px; border-radius: 15px; margin-top: 20px; 'required>
                            </p>
                            
                            4. How likely are you to recommend us to a friend or colleague?
                            <p>
                                <input type="text" name="q4" style='width: 350px; border-radius: 15px; margin-top: 20px; 'required>
                            </p>


                            
                            <p>
                                <input type="submit" name="submit" value ='submit'class="form-control btn btn-primary custom-btn" style="width: 350px; border-radius: 15px; background-color: #001064; border-color: #001064;">
                            </p>
                        
                         </form>   

                            </table>
                            <?php
                        }// not submitted before
                        else {

                            ?><?php 



                                    if(! $result = $mysqli->query("select * from survey where user_id='" . $_SESSION['user'] . "';" )){
                                               echo "Query Error!";
                                            }
                                             $result->data_seek(0);
                                            $row = $result->fetch_assoc();

                                            

                             ?>
                        
                            
                    <table class="table table-borderless" >
                        <thead>
                            <tr>
                                <th scope="col">1.What was your first impression when you entered the website? <br><hr><?= $row['answer1'] ?></th>
                            </tr>
                        </thead>
                    </table>

                    <table class="table table-borderless" >
                        <thead>
                            <tr>
                                <th scope="col">2. How did you first hear about us? <br><hr><?= $row['answer2'] ?></th>
                            </tr>
                        </thead>
                    </table>

                    <table class="table table-borderless" >
                        <thead>
                            <tr>
                                <th scope="col">3. Is there anything missing on this page? <br><hr><?= $row['answer3'] ?></th>
                            </tr>
                        </thead>
                    </table>

                    <table class="table table-borderless" >
                        <thead>
                            <tr>
                                <th scope="col">4. How likely are you to recommend us to a friend or colleague? <br><hr><?= $row['answer4'] ?></th>
                            </tr>
                        </thead>
                    </table>
                        <!-- TR for Post -->
                        



                            <?php 
                            

                        }// submitted before
                         ?>
                   
                        </div>
                    
    </div>
    
</body>
</html>