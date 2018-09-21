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

        $sql = "SELECT b.BookID, b.Title, b.DOI, b.DOR, b.reissue_count FROM Books b JOIN Users u ON b.UserID = u.UserID ";

        $sql .= " WHERE b.UserID = '101'";
        // TODO: Change 101 to uid from user


        $result = $mysqli->query($sql);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // if post then reissue books


        }


        ?>
    <form name="form_issue">
        <table>
            <tr>
                <th>BookID</th>
                <th>Title</th>
                <th>Date of Issue</th>
                <th>Date of Reissue</th>
                <th>Reissue Count</th>
                <th>Reissue?</th>
                <th>Return?</th>
                <th>Fine</th>
            </tr>
        
        <?php
            for($i = 0; $i < $result->num_rows; $i++){
                $result->data_seek($i);
                $row = $result->fetch_assoc();

                $reissue_id = "reissue_" . $i;
                $return_id = "return_" . $i;
                ?>

                <tr>
                    <td><?= $row['BookID'] ?></td>
                    <td><?= $row['Title'] ?></td>
                    <td><?= $row['DOI'] ?></td>
                    <td><?= $row['DOR'] ?></td>
                    <td><?= $row['reissue_count'] ?></td>
                    <td>
                        <input type="checkbox" name="<?= $reissue_id ?>" value="0"
                        <?php if ($row['reissue_count'] >= 3
                                 || date("Y-m-d") > $row['DOR']) {
                            // Disable checkbox if reissue_count >= 3
                            // Or if today is past reissue date
                        
                            echo "disabled";
                        }  
                        ?>
                        >
                    </td>
                    <td>
                        <input type="checkbox" name="<?= $return_id ?>" value="0"
                        <?php if(date("Y-m-d") > $row['DOR']){
                            echo "disabled";
                        }
                        ?>
                        >
                    </td>
                </tr>

                <?php
            }
        ?>

        </table>

        <input type="submit" value="submit">
    </form>
        <?php

    $mysqli->close();
    ?>
        

    </div>
    
</body>
</html>