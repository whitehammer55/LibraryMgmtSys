
<?php 
    header("Content-type: text/css; charset: UTF-8");
    // Rest of the file is interpreted as CSS

    // Source:
    // https://css-tricks.com/css-variables-with-php/

    // This line is needed to include PHP variables from global constants
    require_once 'common/global_constants.php';


?>


.header {
    background-color: #fef230;
}
.main-content {
    background-color: #ff0000;
    margin-left: <?php echo (SIDE_NAV_WIDTH + 10) . 'px'; ?>;
    /* + 10 is provide gap between side bar and main content */
    
}
.nav-bar {
    background-color: #ffb3b3;
    width: <?php echo SIDE_NAV_WIDTH . 'px'; ?>;
    position: fixed; /* Fixed Sidebar (stay in place on scroll) */
    height: 100%; /* Full-height */
    z-index: 1;  /*Stay on top */
}
