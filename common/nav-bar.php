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

  /*.affix {
      top: 20px;
  }
  div.col-sm-9 div {
      height: 250px;
      font-size: 28px;
  }
  #section1 {color: #fff; background-color: #1E88E5;}
  #section2 {color: #fff; background-color: #673ab7;}
  #section3 {color: #fff; background-color: #ff9800;}
  #section41 {color: #fff; background-color: #00bcd4;}
  #section42 {color: #fff; background-color: #009688;}
  
  @media screen and (max-width: 810px) {
    #section1, #section2, #section3, #section41, #section42  {
        margin-left: 150px;
    }
  }*/
    </style>
<div class="container">
  <div class="row">
<nav">
  <ul>
  <li><a href="index.php">Profile</a></li>
  <li><a href="search_for_books.php">Search</a></li>

  <?php 

  if(isset($_SESSION['user'])){
    // TODO: If student then show this page
    // Use session data to determine if student or teacher
      echo '<li><a href="books.php">Books</a></li>';

  }
  else if(isset($_SESSION['emp'])) {
    // If employee
    echo '<li><a href="add_books.php">Add Books</a></li>';
    echo '<li><a href="issue_books.php">Issue Books</a></li>';
    echo '<li><a href="reissue_return_books.php">Reissue/Return</a></li>';
    echo '<li><a href="delete_books.php">Delete Books</a></li>';
    echo'<li><a href="survey.php">FeedBack</a></li>';
  }

  ?>
  <li><a href="logout.php">Logout</a></li>
</ul>
</nav>
</div>
</div>
