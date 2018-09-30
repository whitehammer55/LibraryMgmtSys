
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

</head><style type="text/css">
	
	table{
		border-collapse: collapse;
	}
</style>
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

                $r = $mysqli->query(
                    " INSERT INTO b_author (BookID, AuthorName) "
                    . " VALUES ('$new_book', '$AuthorName');");
                if(!$r){
                    echo "INSERT error";
                }

            } else {
                echo "BOOK ALREDY EXISTS!";
            }
        

        	?>
            	<table border =1>
            		<tr>
            			<th>BookID</th>
            			<th>ISBN</th>
            			<th>Title</th>
            			<th>Author Name</th>
            			<th>Edition</th>
            		</tr>
            		<tr>
            			<td><?= $new_book   ?></td>
            			<td><?= $ISBN       ?></td>
            			<td><?= $title      ?></td>
            			<td><?= $AuthorName ?></td>
            			<td><?= $edition    ?></td>
            		</tr>	            		
            	</table>
        	<?php
            $mysqli->close();

        } // if post
        else{
			?>
        <form name="add_books" action="<?= $_SERVER['PHP_SELF']?>" method="POST">
            <table >
                
                <tr>
                    <td>Enter the ISBN of the Book :
                        <input type="number" name="ISBN" required>
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
                        <input type="number" name="EDITION" required>
                    </td>

                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit">
                    </td>

                </tr>
            </table>
        </form>
            <?php
        }// else post
        ?>
    </div>
    
</body>
</html>