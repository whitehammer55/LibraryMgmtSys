<?php

	session_start();
	session_destroy();
	if(isset($_COOKIE['u_id']) and isset($_COOKIE['u_pwd'])){
		$u_id=$_COOKIE['u_id'];
		$u_pwd=$_COOKIE['u_pwd'];

		setcookie('u_id',$userid, time() -1);
                
        setcookie('u_pwd',$password, time() -1);
}

		echo "<script>
		alert('You Have Successfully Logged Out');
		window.location.href='login.php';
	

	</script>";
	
	


?>