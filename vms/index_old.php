<?php
session_start();
if(isset($_SESSION['a_username'])){
	header("Location: 1/new_truck.php");
	}
	if(isset($_SESSION['bhead_username'])){
	header("Location: 2/existing_truck.php");
	}
	if(isset($_SESSION['encoder_username'])){
	header("Location: 3/new_truck.php");
	}
	if(isset($_SESSION['public_username'])){
	header("Location: 4/existing_truck.php");
	}

?>
<!DOCTYPE html>
<html>
	
<head>
	<title>EFI Truck Management System</title>
		<meta charset="utf-8">
		<link href="css/index.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--webfonts-->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
		<!--//webfonts-->
</head>
<body>
	
				 <!-----start-main---->
				<div class="login-form">
					
				<form action="loginprocess.php" method="post">               
					<li>
						<input type="text" name="username" class="text" value="USERNAME" autocomplete='off' onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'USERNAME';}" required><a  class=" icon user"></a>
					</li>
					<li>
						<input type="password" name="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required><a  class=" icon lock"></a>
					</li>
					<div class="p-container">
							
								<input type="submit" onclick="myFunction()" value="SIGN IN" >
                              

                             
					</div>
                    <br />
                    <div class="copy-right">
						<p>Copyright @ 2015 <a href ="https://www.facebook.com/iDoL.1856">Rj Caridaoan</a></p> 
					</div>
				</form>
             
			</div>
            
			<!--//End-login-form-->
		  <!-----start-copyright---->
   					
				<!-----//end-copyright---->
		 		
</body>
</html>