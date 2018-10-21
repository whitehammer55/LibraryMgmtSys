
<?php require_once 'common/global_constants.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Library Management system | Search</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    
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

        
            <div class="main-content">
                <form name="form_book" method="post" class="form-horizontal">

                    <div  class="form-group input-group">
                        <table class="sfb">
                            <tr class="sfb">
                                <th class="sfb">
                                    <input type="text" name="search_query" class="form-control sfb">
                                </th>
                                <td class="sfb">
                                    <input type="submit" value="Submit" class="form-control btn btn-primary custom-btn sfb" onclick="
                                    // THIS ONCLICK VERIFIES THAT INPUTS ARE NOT EMPTY

                                    if(document.form_book.search_query.value == ''){
                                        alert('You need to enter a search query');
                                        return false; // to prevent form refresh
                                    }

                                    if(document.form_book.search_field.value == ''){
                                        alert('Choose a parameter to search from!');
                                        return false; // to prevent form refresh
                                    }">
                                </td>
                            </tr>
                        </table>
                    </div>
                
                    
                    <br>

                        <?php
                        // Variables created to be used 
                        // 1) as values, and IDs in radio button, 
                        // 2) and in the if else to search for the correct field

                        $COL_TITLE = "Books.Title";
                        $COL_ISBN = "Books.ISBN";
                        $COL_BOOKID = "Books.BookID";
                        $COL_AUTHOR = "B_Author.AuthorName"
                        ?>
                        <div class="container">
                            <div class="custom-control custom-radio custom-control-inline form-group">
                                <input type="radio" name="search_field" value="<?= $COL_BOOKID ?>" id="<?= $COL_BOOKID ?>" class="form-control custom-control-input" >
                                <label for="<?= $COL_BOOKID ?>" class="custom-control-label">BookID</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline form-group">
                                <input type="radio" name="search_field" value="<?= $COL_ISBN ?>" id="<?= $COL_ISBN ?>" class="form-control custom-control-input" >
                                <label for="<?= $COL_ISBN ?>" class="custom-control-label">ISBN</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline form-group">
                                <input type="radio" name="search_field" value="<?= $COL_TITLE ?>" id="<?= $COL_TITLE ?>" class="form-control custom-control-input" >
                                <label for="<?= $COL_TITLE ?>" class="custom-control-label">Title</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline form-group">
                                <input type="radio" name="search_field" value="<?= $COL_AUTHOR ?>" id="<?= $COL_AUTHOR ?>" class="form-control custom-control-input" >
                                <label for="<?= $COL_AUTHOR ?>" class="custom-control-label">Author</label>
                            </div>
                        </div>
                </form>
            </div>

            <?php 
                if ($_SERVER['REQUEST_METHOD'] === 'POST'
                    && isset($_POST['search_query'])
                    && isset($_POST['search_field']))  {
                    // Check if request is post and search variables are set
                    
                    ?>
                    <script type="text/javascript">
                        // Restore values of input variables
                        document.form_book.search_query.value = '<?= $_POST["search_query"] ?>';
                        document.getElementById('<?= $_POST["search_field"] ?>').checked = true;
                    </script>

                    <?php

                    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                    if($mysqli->connect_errno){
                       echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                       die;
                    }

                    $field = $_POST['search_field'];
                    $query = $_POST['search_query'];

                    // Create first part of the query where join is done
                    $sql = "SELECT b.BookID, b.ISBN, b.Title, b.DOI, group_concat(a.authorname separator ', ') as 'authors' FROM Books b JOIN B_Author a ON b.BookID = a.BookID "; 
                    // 'authors' is used as key, when printing the data

                    // This if else applies the correct query to be searced for
                    if($field == $COL_BOOKID){
                        $sql .= " WHERE b.BookID LIKE '%" . $query . "%' ";
                    }
                    elseif ($field == $COL_ISBN) {
                        $sql .= " WHERE b.ISBN LIKE '%" . $query . "%' ";
                    }
                    elseif($field == $COL_TITLE){
                        $sql .= " WHERE b.Title LIKE '%" . $query ."%' ";
                    }
                    elseif($field == $COL_AUTHOR){
                        $sql .= " WHERE a.AuthorName LIKE '%" . $query . "%' ";
                    }

                    // End the query
                    $sql .= " GROUP BY b.BookID;";

                    // Actually execute the query
                    $result = $mysqli->query($sql);

            ?>     
            <div class="table-content sfb">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">BookID</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author(s)</th>
                        </tr>   
                    </thead>
                    <tbody>
                <?php 
                if($result->num_rows == 0){
                    echo "<tr>" . "No Results Found!" . "</tr";
                }


                for($i = 0; $i < $result->num_rows; $i++){
                    $result->data_seek($i);
                    $row = $result->fetch_assoc();

                ?>
                    
                        <tr>
                            <td> <?= $row['BookID']  ?> </td>
                            <td> <?= $row['ISBN']    ?> </td>
                            <td> <?= $row['Title']   ?> </td>
                            <td> <?= $row['authors'] ?> </td>
                        </tr>
                    

                <?php  
                } // end for

                $mysqli->close();
                } // end if post
                ?>
                    </tbody>
                </table>
            </div>
        
    </body>
</html>