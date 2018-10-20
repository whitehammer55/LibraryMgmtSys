
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
            .form-control.survey{
                width: 350px; 
                border-radius: 15px; 
                margin-top: 20px; 
            }
            .form-control.btn.btn-primary.custom-btn.survey{
                width: 350px; 
                border-radius: 15px; 
                background-color: #001064; 
                border-color: #001064; 
            }
            .p.survey{
                margin-left: 30px;
                margin-top: 15px;
            }
            .surveyhead{
                margin-left: 80px;
            }
    </style>

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
                          
                        $sql = "select user_id from survey where user_id='" . $_SESSION['user'] . "';" ;
                        
                        $bool = $mysqli->query($sql);

                        if($bool->num_rows == 0 ){
                            ?>
                            <form name="survey" method="POST" action="survey_form.php" class="form-horizontal survey">
                                <div class="form-group input-group survey">                                
                                    <p class="p survey">Your UserID :
                                        <input type="number" class="form-control survey" value ="<?PHP echo $_SESSION['user']; ?>" name="UID" required disabled>
                                    </p>
                                </div>
                                <div class="form-group input-group survey">                                
                                    <p class="p survey"> First Name :
                                        <input type="text" class="form-control survey" value ="<?PHP echo $_SESSION['firstName']; ?>" name="firstname" required disabled>
                                    </p>
                                </div>
                                <div class="form-group input-group survey">
                                    <p class="p survey">Last Name:
                                        <input type="text" class="form-control survey" value ="<?PHP echo $_SESSION['lastName']; ?>" name="lastname" required disabled>
                                    </p>
                                </div>
                                <div class="form-group input-group survey">
                                    <p class="p survey">Email :
                                        <input type="text" class="form-control survey" value ="<?PHP echo $_SESSION['email']; ?>" name="email" required disabled>
                                    </p>
                                </div>
                                <hr>
                                    <h3 class="surveyhead">Survey Questions</h3>
                                <hr>
                                <div class="form-group input-group survey">
                                    <p class="p survey">1.What was your first impression when you entered the website?
                                    
                                        <textarea type='text' class="form-control survey" name="q1" required></textarea> 
                                    </p>
                                </div>
                                <div class="form-group input-group survey">
                                    <p class="p survey">2. How did you first hear about us?
                                    
                                        <textarea type="text" class="form-control survey" name="q2" required></textarea> 
                                    </p>
                                </div>
                                <div class="form-group input-group survey">
                                    <p class="p survey">3. Is there anything missing on this page?
                                    
                                        <textarea type="text" class="form-control survey" name="q3" required></textarea> 
                                    </p>
                                <div class="form-group input-group survey">     
                                    <p class="p survey">4. How likely are you to recommend us to a friend or colleague?
                                    
                                        <textarea type="text" class="form-control survey" name="q4" required></textarea> 
                                    </p>
                                </div>
                                <div class="form-group input-group survey">
                                    <p class="p survey">
                                        <input type="submit" name="submit" value ='Submit' class="form-control btn btn-primary custom-btn survey">
                                    </p>
                                </div>
                            </form>   
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