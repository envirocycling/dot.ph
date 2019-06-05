<!DOCTYPE html>
<html>
	
<head>
	<title>EFI Manpower Management</title>
		<link href="css/styles.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--webfonts-->
		<link href='css/fonts' rel='stylesheet' type='text/css'>
                <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
</head>
<body>
<?php
session_start();
if(isset($_SESSION['username-0']) && !empty($_SESSION['username-0'])){
    echo '<script>
            location.replace("users/admin-01/");
    </script>';
}else if(isset($_SESSION['username-1']) && !empty($_SESSION['username-1'])){
    echo '<script>
            location.replace("users/hr-1/");
    </script>';
}else if(isset($_SESSION['username-2']) && !empty($_SESSION['username-2'])){
    echo '<script>
            location.replace("users/gm-2/");
    </script>';
}else if(isset($_SESSION['username-3']) && !empty($_SESSION['username-3'])){
    echo '<script>
            location.replace("users/bh-3/");
    </script>';
}else if(isset($_SESSION['username-4']) && !empty($_SESSION['username-4'])){
    echo '<script>
            location.replace("users/accounting-4/");
    </script>';
}else if(isset($_SESSION['username-5']) && !empty($_SESSION['username-5'])){
    echo '<script>
            location.replace("users/employee-5/");
    </script>';
}
?>	
				 <!-----start-main---->
<center><div class="company">Manpower Management System</div></center>
                                 <div class="login-form">
                                     <div class="h1">Sign In</div>
                                     <form action="login_process.php" method="post">
					<li>
                                            <input type="text" class="text" placeholder="username" name="username" autocomplete="off" required autofocus><a class="icon user"></a>
					</li>
					<li>
                                            <input type="password" placeholder="password" name="password" required><a class="icon lock"></a>
					</li>
					
					 <div class ="forgot">
						<input type="submit" value="Sign In" > <a  class="icon arrow"></a>                                                                                                                                                                                                                                 </h4>
					</div>
				</form>
			</div>
			<!--//End-login-form-->		 		
</body>
</html>
