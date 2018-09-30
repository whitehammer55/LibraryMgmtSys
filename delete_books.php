
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
         

            <?php 

                echo"<form name='delete_books' method='POST'>
             <table >
                
                <tr>
                    <td>Enter the BookID of the book :
                        <input type='number' name='BookID' required>
                    </td>

                </tr>
                
                <tr>
                    <td>
                        <input type='submit' name='submit'>
                    </td>

                </tr>
            </table>



        </form>";





                if(isset($_POST['submit'])){

                    
                    $bookid=$_POST['BookID'];
                    

                    


                    //  $max= $mysqli->query("select max(BookID) as 'max' from books;");
                    // $max->data_seek(0);
                    // $row=$max->fetch_assoc();
                    // $total_books =$row['max'];
                    // $new_book=$total_books+1;
                    


                     $result = $mysqli->query("Select BookID from books where BookID='$bookid';");
                     if(!$result){
                            echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
                      }


                     if($result->num_rows != 0){  
                        
                        
                        mysqli_query($mysqli,"delete from books where bookID='$bookid';");

                        echo"<script>alert('Book number $bookid successfully deleted');</script>";

                }else{
                    echo"<script>alert('Book not in the datababse');</script>";

                }

            }


            ?>
        

    </div>
    
</body>
</html>