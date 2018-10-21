
<?php require_once 'common/global_constants.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library Management system | Survey Result</title>

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

    <div class="table-content survey">
        <?php 

        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($mysqli->connect_errno){
           echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
           die;
        }

        if(! $result = $mysqli->query(" select * from survey;")){
           echo "Query Error!";
        }

        if($result->num_rows == 0 ){
            echo "<script>alert('No student has filled the form');
                            window.location.href='index.php';
                            </script>";
        }

        echo "<table class='table table-borderless' >
                <thead><tr>
                <th>PID</th>
                <th>1.What was your first impression when you entered the website?</th>
                <th>2. How did you first hear about us?</th>
                <th>3. Is there anything missing on this page?</th>
                <th>4. How likely are you to recommend us to a friend or colleague? </th>
                </tr></thead>";

        while($row = $result->fetch_assoc()){                            
            ?>
            <tr>
                <td > <?= $row['user_id'] ?></td>
                <td > <?= $row['answer1'] ?></td>
                <td > <?= $row['answer2'] ?></td>
                <td > <?= $row['answer3'] ?></td>
                <td ><?= $row['answer4'] ?></td>
            </tr>
                <?php  
        }// while row fetch
        
        $mysqli->close();
        
         ?>
        </div>
    </body>
</html>
