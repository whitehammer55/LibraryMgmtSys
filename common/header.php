
<h1>HEADER</h1>
<?php 
print_r($_SESSION);

$session_set = isset($_SESSION['user']) or isset($_SESSION['emp']);

print_r("Session set: " . $session_set);


if( !(isset($_COOKIE['u_id']) and isset($_COOKIE['u_pwd']) and isset($_COOKIE['user_type']))
    and
     !(isset($_SESSION['user']) or isset($_SESSION['emp']))
    ){
    // if cookies are not set
    // and neither session indicator is set
    // then send user to login.php

    echo "SHIT";
    ?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
 
    <?php
} 

?>
