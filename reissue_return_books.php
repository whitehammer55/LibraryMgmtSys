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
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($mysqli->connect_errno){
           echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
           die;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // if post then reissue books
            
            foreach($_POST as $key => $value){
                // echo "Keys: " . $key . " " . $value . "<br>";
            

                // REISSUE SECTION
                $book_id = str_replace("reissue_" , "" ,$key, $replace_count);
                // print_r("Reissue RepCount: " . $replace_count);
                if($replace_count == 1){
                    // valid reissue post variable

                    // print_r("Reissue" . $correct_book['BookID']);
                    $res = $mysqli->query("SELECT reissue_count FROM Books where BookID = '$book_id'");
                    if(!$res){
                        echo "error in getting book";
                    }
                    $res->data_seek(0);
                    $correct_book = $res->fetch_assoc();


                    // if reissue count < 3
                    if($correct_book['reissue_count'] < 3){

                        // print_r("UPDATE REISSUE");
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
                // print_r("Return RepCount: " . $replace_count);

                if($replace_count == 1){
                    // valid return variable
                    
                    $return_sql = 
                    "UPDATE Books "
                    . "SET DOI= NULL, DOR = NULL, UserID = NULL ,EmployeeID=NULL"
                    . " WHERE BookID = '$book_id' ; ";
                    if(!$mysqli->query($return_sql)){;
                        echo "Error in returning query";
                    }
                }

            }
        }// if post
        ?>


    <input type="number" id="user_id"><br>
    <button id="btn_search_books" 
    onclick="
        var user_id = document.getElementById('user_id').value;
        if(user_id == ''){
            alert('User id can\'t be empty');
            return false;
        }

        loadTableRows(user_id);
        // Populate the form_issue.table element with AJAX request

    ">See books</button>

    <script>
        // This block of code will make sure that 
        // Enter button will click on the button
        input_user_id = document.getElementById('user_id');

        // https://www.w3schools.com/howto/howto_js_trigger_button_enter.asp
        // Execute a function when the user releases a key on the keyboard
        input_user_id.addEventListener("keyup", function(event) {
          // Cancel the default action, if needed
          event.preventDefault();
          // Number 13 is the "Enter" key on the keyboard
          if (event.keyCode === 13) {
            // Trigger the button element with a click
            document.getElementById("btn_search_books").click();
          }
        });


    function loadTableRows(user_id){
        // https://www.w3schools.com/xml/ajax_xmlhttprequest_response.asp

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var table = document.getElementById("form_for_reissue").firstElementChild;
                var tbody = table.firstElementChild;
                var table_head_row_outerHTML = tbody.firstElementChild.outerHTML;
                // table.firstChild doesn't work because
                // https://www.reddit.com/r/learnjavascript/comments/55wauv/node_firstchild_text/d8f5mdw

                var table_tr_rows_for_books = this.responseText;

                // First clear the tbody tag so previous data is wiped away
                tbody.innerHTML = '';
                tbody.insertAdjacentHTML("afterbegin", table_head_row_outerHTML)
                // insert as first child

                tbody.insertAdjacentHTML("beforeend", table_tr_rows_for_books);
                // insert as last child
           }
        };
        xhttp.open("GET", "ajax/get_user_books.php?user_id=" + user_id, true);
        xhttp.send(); 
    }

    <?php 
        if(isset($_SESSION['latest_user_reissued'])){
            // this variable is set in the ajax/get_user_books.php file

            // restore the input tag with the id of user who searched for the book
            // and also call loadTableRows() function
            ?>
            document.getElementById('user_id').value = <?= $_SESSION['latest_user_reissued'] ?>;
            loadTableRows(<?= $_SESSION['latest_user_reissued'] ?>);
            <?php
        }

    ?>
    </script>


    <style type="text/css">
        table, tr, td, th {
            border: 1px solid black;
        }
    </style>
    <form name="form_issue" method="POST" action="<?= $_SERVER['PHP_SELF']?>"
        id="form_for_reissue">
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

            <!-- Data is added here via AJAX call -->
        </table>

        <input type="submit" value="submit">
    </form>
    <?php
    $mysqli->close();
    ?>
        
    </div>
    
</body>
</html>