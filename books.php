<?php require_once 'common/global_constants.php'; ?>
<?php
include_once'includes/db.php';
?>

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

            <h2>List of Books</h2>

        <?php
        $conn;

        // TODO: Change this to retreivals from database
        echo"
                    <table>
                <tr>
                    <th>BOOK Title</th>
                </tr>


                ";
       


        $books = "SELECT * FROM books ";
        $result = mysqli_query($conn, $books);
        while($book_data=mysqli_fetch_row($result)){


        


            echo"
            
                <tr>

                    <td>".$book_data[2]."<br></td>
                    
                </tr>
                
            </table>
            ";

        }
        
        ?>

    </div>
    
</body>
</html>