<?php require_once 'global_constants.php'; ?>

<style type="text/css">
    ul {
        /* Removes the bullets */
        list-style-type: none; 
     
        /* These two attrs remove default browser settings */
        margin: 0; 
        padding: 0;

        width: <?php echo SIDE_NAV_WIDTH ;?>;
        }

    li a {
        display: block;
    }

    /* Change the link color on hover */
    li a:hover {
        background-color: #555;
        color: white;
    }

    /* Set this value to the correct page
    in the start code of each page */
    .active {
        background-color: #4CAF50;
        color: white;
    }
</style>

<ul>
  <li><a href="default.asp">Home</a></li>
  <li><a href="news.asp">News</a></li>
  <li><a href="contact.asp">Contact</a></li>
  <li><a href="about.asp">About</a></li>
</ul>