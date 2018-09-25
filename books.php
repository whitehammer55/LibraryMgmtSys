
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

        <style type="text/css">
           table, tr, td, th {
            /* To get lines for the table, make pretty later */
            border: 1px solid black;
           }
        </style>

        <table>
            <tr>
                <th>BookID</th>
                <th>ISBN</th>
                <th>Title</th>
                <th>Author(s)</th>
                <th>DOI</th>
                <th>DOR</th>
            </tr>   
        <?php 

        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($mysqli->connect_errno){
           echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
           die;
        }

        $userid = $_SESSION['user'];
        $sql = "SELECT b.BookID, b.ISBN, b.Title, b.DOI, b.DOR, group_concat(a.authorname separator ', ') as 'authors' FROM Books b JOIN B_Author a ON b.BookID = a.BookID WHERE b.UserID = '$userid';";
        $result = $mysqli->query($sql);

        if(! $result){
            echo "Error in query!<br>";
            echo $sql;
            die;
        }


        if($result->num_rows == 0){
            echo "<tr>" . "No Results Found!" . "</tr";
        }


        for($i = 0; $i < $result->num_rows; $i++){
            $result->data_seek($i);
            $row = $result->fetch_assoc();

        ?>
            <tr>
            <td> <?= $row['BookID'] ?> </td>
            <td> <?= $row['ISBN'] ?> </td>
            <td> <?= $row['Title'] ?> </td>
            <td> <?= $row['authors'] ?> </td>
            <td> <?= $row['DOI'] ?> </td>
            <td> <?= $row['DOR'] ?></td>
            </tr>

        <?php  
        } // end for

        $mysqli->close();

        ?>
        </table>

    </div>
    
</body>
</html>
