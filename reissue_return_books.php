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

        // Select the data
        $sql = "SELECT b.BookID, b.Title, b.DOI, b.DOR, b.reissue_count FROM Books b JOIN Users u ON b.UserID = u.UserID ";

        $sql .= " WHERE b.UserID = '101'";
        // TODO: Change 101 to uid from user


        $result = $mysqli->query($sql);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // if post then reissue books
            // ECHO "ffffff";
            foreach($_POST as $key => $value){
                echo "Keys: " . $key . " " . $value . "<br>";
            

                // REISSUE SECTION
                $book_id = str_replace("reissue_" , "" ,$key, $replace_count);
                print_r("Reissue RepCount: " . $replace_count);
                if($replace_count == 1){
                    // valid reissue post variable

                    // find the book with correct bookid
                    for($i=0; $i < $result->num_rows; $i++){
                        $result->data_seek($i);
                        $row = $result->fetch_assoc();

                        if($row['BookID'] == $book_id){
                            // correct book found
                            $correct_book = $row;
                            break; // quit the loop
                        }
                    }

                    print_r("Reissue" . $correct_book['BookID']);

                    // if reissue count < 3
                    if($correct_book['reissue_count'] < 3){

                        print_r("UPDATE REISSUE");
                        $update_sql = 
                        "UPDATE Books " 
                        . " SET reissue_count = reissue_count + 1, DOR = DATE_ADD(DOR, INTERVAL 7 DAY) "
                        . " WHERE BookID =  '$book_id' ;";

                        if(!$mysqli->query($update_sql)){
                            echo "UPDATE failed (" . $mysqli->errno . ") " . $mysqli->error;
                        }
                    }
                }// if valid reissue variable


                // RETURN SECTION
                $book_id = str_replace("return_", "", $key, $replace_count);
                print_r("Return RepCount: " . $replace_count);

                if($replace_count == 1){
                    // valid return variable
                    // find the book with correct bookid
                    for($i=0; $i < $result->num_rows; $i++){
                        $result->data_seek($i);
                        $row = $result->fetch_assoc();

                        if($row['BookID'] == $book_id){
                            // correct book found
                            $correct_book = $row;
                            break; // quit the loop
                        }
                    }

                    $return_sql = 
                    "UPDATE Books "
                    . "SET DOI= NULL, DOR = NULL, UserID = NULL ,EmployeeID=NULL"
                    . " WHERE BookID = '$book_id' ; ";
                    $mysqli->query($return_sql);
                }

            }
        }// if post


        // Requery to get the data that was updated in POST
        $result = $mysqli->query($sql);




        ?>
    <style type="text/css">
        table, tr, td, th {
            border: 1px solid black;
        }
    </style>
    <form name="form_issue" method="POST">
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

                $reissue_id = "reissue_" . $row['BookID'];
                $return_id = "return_" . $row['BookID'];
                ?>

                <tr>
                    <td><?= $row['BookID'] ?></td>
                    <td><?= $row['Title'] ?></td>
                    <td><?= $row['DOI'] ?></td>
                    <td><?= $row['DOR'] ?></td>
                    <td><?= $row['reissue_count'] ?></td>
                    <td>
                        <input type="checkbox" name="<?= $reissue_id ?>" value="1"
                        <?php if ($row['reissue_count'] == 3
                                 || date("Y-m-d") > $row['DOR']) {
                            // Disable checkbox if reissue_count >= 3
                            // Or if today is past reissue date
                        
                            echo "disabled";
                        }  
                        ?>
                        >
                    </td>
                    <td>
                        <input type="checkbox" name="<?= $return_id ?>" value="1"
                        <?php
                        // Commenting this section, since if return date is crossed,
                        // then employee will take fine and then press return
                        // Hence, no need to disable the return button
                        //
                        //  if(date("Y-m-d") > $row['DOR']){
                        //     echo "disabled";
                        // }
                        ?>
                        >
                    </td>
                    <td>
                        <?php 
                        $date_return = new DateTime($row['DOR']);
                        $date_today = new DateTime(date("Y-m-d"));

                        $interval = $date_return->diff($date_today);
                        // today - DOR

                        if($interval->invert == 1){
                            // negative difference
                            echo "0.0";
                        } else {
                            // positive difference ie return date has been passed

                            $fine = $interval->d * 2;
                            // Rs 2 fine per day after return date
                            echo $fine . ".0";
                        }

                        ?>
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