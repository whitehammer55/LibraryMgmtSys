
<style type="text/css">
   h1{
        font-family: 'RobotoRegular',arial;


        

  }

h1 a{
  text-decoration: none !important;
  color: black;
}
 h1 a:hover {
    color: #000000 !important;
}

</style>
<br>

<h1><a id="head" href="index.php" >Library Management</a></h1>
<?php 


$session_set = isset($_SESSION['user']) or isset($_SESSION['emp']);




echo "<script>

window.onscroll = function() {myFunction()};

var header = document.getElementById('myHeader');

var sticky = header.offsetTop;


function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add('sticky');
  } else {
    header.classList.remove('sticky');
  }
}
</script>";

#print_r("Session set: " . $session_set);


if( !(isset($_COOKIE['u_id']) and isset($_COOKIE['u_pwd']) and isset($_COOKIE['user_type']))
    and
     !(isset($_SESSION['user']) or isset($_SESSION['emp']))
    ){
    // if cookies are not set
    // and neither session indicator is set
    // then send user to login.php

    #echo "SHIT";
    ?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
 
    <?php
} 

?>
