<?php
session_start();
?>
<?php 
include('connect.php');
$select = mysql_query("Select * from tbl_users Where username='".$_SESSION['encoder_username']."'") or die(mysql_error());
	$row = mysql_fetch_array($select);
	$same = mysql_query("Select * from tbl_users Where username='".$_POST['username']."'")or die (mysql_error());
	
	if($row['password'] != $_POST['oldpassword']){
		?><script>
		alert("Password is Incorrect!");
		window.history.back();
		</script>
        <?php
	}else if($_POST['username'] == $_SESSION['encoder_username'] && $_POST['password'] == $row['password']){
		header("Location: new_truck.php");
			}
			
	else if(mysql_num_rows($same) && $row['password'] == $_POST['password']){
		?>
        <script>
		alert("ERROR: Username Already Exist.");
		window.history.back();
		</script>
        <?php
		}

	else if($row['password'] == $_POST['oldpassword']){
		$update = mysql_query("Update tbl_users Set username='".strtoupper($_POST['username'])."', password='".$_POST['password']."' Where username='".$_SESSION['encoder_username']."'") or die (mysql_error());
		$_SESSION['encoder_username'] = strtoupper($_POST['username']);
		?> 
		<script>
			alert("Account Updated Successful.");
			window.history.back();
		</script>
	
	<?php
		
	}else{?> 
		<script>
			alert("Password is Incorrect!");
			window.history.back();
		</script>
	
	<?php }
?>