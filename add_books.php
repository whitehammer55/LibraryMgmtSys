
<!-- 
    This is a template file.
    When creating a new page,
    copy this file, and then modify the main-content div
    as per your needs.

 -->

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

        ?>

         <form name="add_books" method="POST">
            <table >
                
                <tr>
                    <td>Enter the ISBN of the Book :
                        <input type="text" name="ISBN" required>
                    </td>

                </tr>
                <tr>
                    <td>Enter the Title of the Book :
                        <input type="text" name="TITLE" required>
                    </td>

                </tr>
                <tr>
                    <td>Enter the Author of the Book :
                        <input type="text" name="AuthorName" required>
                    </td>

                </tr>
                <tr>
                    <td>Enter the Edition of the Book :
                        <input type="text" name="EDITION" required>
                    </td>

                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit">
                    </td>

                </tr>
            </table>

            <?php 

                if(isset($_POST['submit'])){

                    
                    $ISBN=$_POST['ISBN'];
                    $title=$_POST['TITLE'];
                    $AuthorName=$_POST['AuthorName'];
                    $edition=$_POST['EDITION'];
                    


                     $count= $mysqli->query("select count(BookID) as 'count' from books;");
                    $count->data_seek(0);
                    $row=$count->fetch_assoc();
                    $total_books =$row['count'];
                    $new_book=$total_books+1;
                    


                     $result = $mysqli->query("Select * from books;");
                     if(!$result){
                            echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
                      }


                     if($result->num_rows != 0){  
                        
                         $check_book=$mysqli->query("select ISBN from books where ISBN='$ISBN'");
                        if(!$check_book){
                             echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;

                         }
                        if ($check_book->num_rows!=0) {
                            echo"<script>
                                    alert('Error/Book already in the database');
                            </script>";
                            
                        }

                    
                         else if($check_book->num_rows==0){
                        mysqli_query($mysqli," INSERT INTO Books (BookID, ISBN, Title, Edition)
                                                                VALUES ('$new_book', '$ISBN', '$title', '$edition');");

                        mysqli_query($mysqli," INSERT INTO b_author (BookID, AuthorName)
                                                                VALUES ('$new_book', '$AuthorName');");

                            echo"<script>
                                    alert('Book Added Successfully!');
                            </script>";
                         
                        }


                }
            }


             ?>




    </div>
    
</body>
</html>