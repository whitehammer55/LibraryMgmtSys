<?php require_once 'common/global_constants.php'; ?>


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
        color: #818181;
        text-align: center;
    }

    /* Change the link color on hover */
    li a:hover {
        background-color: #555;
        color: white;
    }

</style>

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
    echo '<li><a href="issue_books.php">Issue Books</a></li>';
    echo '<li><a href="reissue_return_books.php">Reissue/Return</a></li>';
  }

  ?>
  <li><a href="logout.php">Logout</a></li>


</ul>