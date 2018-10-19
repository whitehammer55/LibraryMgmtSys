<?php require_once 'common/global_constants.php'; ?>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<style type="text/css">
    ul {
        /* Removes the bullets */
        list-style-type: none; 
     
        /* These two attrs remove default browser settings */
        margin: 0; 
        padding: 0;

        width: <?php echo SIDE_NAV_WIDTH . 'px' ;?>;
        }

    li a {
        display: block;
        padding: 6px 8px 6px 8px;
        text-decoration: none;
        font-size: 25px;
        color: #fff;
        background-color: #283593;
        text-align: center;
        
    }

    /* Change the link color on hover */
    li a:hover {
        color: white;
        border-radius: 15px;
        background-color: #003366;
        text-decoration: none;
      }

    .selected-a {
        background-color: #0f2467;
        border-radius: 15px;
    }
    </style>
<div class="container">
  <div class="row">
<nav>
    <?php 
    $dict = 
        array(
            "add_books.php" => "",
            "books.php" => "",
            "delete_books.php" => "",
            "index.php" => "",
            "issue_books.php" => "",
            "login.php" => "",
            "login_validation.php" => "",
            "logout.php" => "",
            "reissue_return_books.php" => "",
            "search_for_books.php" => "",
            "survey.php" => ""
            );


    // get the page name and use dict to set class to correct attribute
    $page_name = basename($_SERVER['PHP_SELF']);

    $dict[$page_name] = " class='selected-a' ";

    ?>

  <ul>
  <li><a href="index.php" 
        <?= $dict['index.php'] ?>           >Profile</a></li>
  <li><a href="search_for_books.php" 
        <?= $dict['search_for_books.php']?> >Search</a></li>

  <?php 

  if(isset($_SESSION['user'])){
    // TODO: If student then show this page
    // Use session data to determine if student or teacher
    ?>
    <li><a href="books.php">Books</a></li>
    <?php
  }
  else if(isset($_SESSION['emp'])) {
    // If employee
    ?>
    <li><a href="add_books.php"   <?= $dict['add_books.php'] ?>>
        Add Books</a></li>
    <li><a href="issue_books.php" <?= $dict['issue_books.php'] ?>>
        Issue Books</a></li>
    <li><a href="reissue_return_books.php" <?= $dict['reissue_return_books.php'] ?>>
        Reissue/Return</a></li>
    <li><a href="delete_books.php" <?= $dict['delete_books.php'] ?>>
        Delete Books</a></li>
    <li><a href="survey.php"       <?= $dict['survey.php'] ?>>
        FeedBack</a></li>

  <?php
    }
  ?>
  <li><a href="logout.php">Logout</a></li>
</ul>
</nav>
</div>
</div>
