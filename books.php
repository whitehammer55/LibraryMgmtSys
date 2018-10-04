
<?php require_once 'common/global_constants.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="style.php">

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
    <div class="table-content">

        <table class="table table-borderless">
            <thead>
            <tr>
                <th scope="col">BookID</th>
                <th scope="col">ISBN</th>
                <th scope="col">Title</th>
                <th scope="col">Author(s)</th>
                <th scope="col">DOI</th>
                <th scope="col">DOR</th>
            </tr>  
            </thead> 
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
            <tbody>
            <tr>    
            <td scope="row"> <?= $row['BookID'] ?> </td>
            <td scope="row"> <?= $row['ISBN'] ?> </td>
            <td scope="row"> <?= $row['Title'] ?> </td>
            <td scope="row"> <?= $row['authors'] ?> </td>
            <td scope="row"> <?= $row['DOI'] ?> </td>
            <td scope="row"> <?= $row['DOR'] ?></td>
            </tr>
            </tbody>

        <?php  
        } // end for

        $mysqli->close();

        ?>
        </table>

    </div>
    </div>
    
</body>
</html>
