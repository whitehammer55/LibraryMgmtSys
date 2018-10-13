<?php require_once 'common/global_constants.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
        <link rel="stylesheet" type="text/css" href="style.php">
        <style type="text/css">

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
            <div class="table-content">
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        	
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                if($mysqli->connect_errno){
                   echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                   die;
                }

                $ISBN       = $_POST['ISBN'];
                $title      = $_POST['TITLE'];
                $AuthorName = $_POST['AuthorName'];
                $edition    = $_POST['EDITION'];

                $AuthorName = str_replace(' ', '', $AuthorName);

                $Auth_Array=explode(',', $AuthorName);
                
                $max         = $mysqli->query("select max(BookID) as 'max' from books;");
                $max->data_seek(0);
                $row         = $max->fetch_assoc();
                $total_books = $row['max'];
                $new_book    = $total_books+1;
                
                $result = $mysqli->query("Select * from books;");
                if(!$result){
                    echo "Error: (" . $mysqli->errno . ") " . $mysqli->error;
                }

                if($result->num_rows != 0){  

                    $r = $mysqli->query(
                        " INSERT INTO Books (BookID, ISBN, Title, Edition) "
                        . " VALUES ('$new_book', '$ISBN', '$title', '$edition');");
                    if(!$r){
                        echo "INSERT error";
                    }

                    foreach($Auth_Array as $item){
        
                        $r = $mysqli->query(
                            " INSERT INTO b_author (BookID, AuthorName) "
                            . " VALUES ('$new_book', '$item');");
                        if(!$r){
                            echo "INSERT error";
                             }
                }

                } else {
                    echo "BOOK ALREDY EXISTS!";
                }
            

            	?>

                <table class="table table-borderless">
                    <thead>
                    	<tr>
                    		<th scope="col">BookID</th>
                    		<th scope="col">ISBN</th>
                    		<th scope="col">Title</th>
                    		<th scope="col">Author Name</th>
                    		<th scope="col">Edition</th>
                    	</tr>
                    </thead>
                    <tbody>
                    		<tr> 
                    		<td scope="row"><?= $new_book   ?></td>
                    		<td scope="row"><?= $ISBN       ?></td>
                    		<td scope="row"><?= $title      ?></td>
                    		<td scope="row"><?= $AuthorName ?></td>
                    		<td scope="row"><?= $edition    ?></td> 
                    	</tr>
                    </tbody>	            		
                	
            	<?php
                $mysqli->close();


            } // if post


            else{
    			?>
                </table>
            </div>
        </div>

        <div class="main-content">
            <div class="container-fluid">
                <form name="add_books" action="<?= $_SERVER['PHP_SELF']?>" method="POST" class="form-horizontal add-bks">
                    <div class="form-group input-group add-bks">
                        <p class="p add-bks">Enter the ISBN of the Book :
                            <input type="number" class="form-control add-bks" name="ISBN" required >
                        </p>
                    </div>

                    <div class="form-group input-group add-bks">
                        <p class="p add-bks">Enter the Title of the Book :
                            <input type="text" class="form-control add-bks" name="TITLE" required>
                        </p>
                    </div>

                    <div class="form-group input-group add-bks">
                        <p class="p add-bks">Enter the Author of the Book :
                            <input type="text" class="form-control add-bks" name="AuthorName" required>
                        </p>
                    </div>

                    <div class="form-group input-group add-bks">
                        <p class="p add-bks">Enter the Edition of the Book :
                            <input type="number" class="form-control add-bks" name="EDITION" required>
                        </p>
                    </div>

                    <div class="form-group input-group add-bks">
                        <p>
                            <input type="submit" name="submit" class="form-control btn btn-primary custom-btn add-bks"class="add-bks" >
                         </p>
                    </div>

                </form>
                <?php
            }// else post
            ?>
            </div>
        </div>
        
        
    </body>
</html>