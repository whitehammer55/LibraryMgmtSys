<?php require 'global_constants.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <div class="loginbox">
        <img src="user.png" class="user">
        <h1>Login Here</h1>
        <form action="index.php" name="form1" method="post">
            
            
            <label for="u_id">User ID:</label>
            <input type="text" name="u_id" placeholder="Enter ID">
            <!-- TODO: remove br -->
            <br> 

            <label for="u_pwd">Password:</label>
            <input type="password" name="u_pwd" placeholder="Enter password">
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>