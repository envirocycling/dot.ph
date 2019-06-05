<?php
session_start();

include('connect.php');



$login = mysql_query("SELECT * FROM tbl_users WHERE username='".$_POST['username']."' and password='".$_POST['password']."'") or die("Could not connect to database");



if (mysql_num_rows($login) != 1)
{
	?>
		<script type="text/javascript">
		alert('Incorrect Username or Password.');
		window.history.back();
		</script>
		<?php
	exit;
	}
	$row = mysql_fetch_array($login) or die(mysql_error());
$acc=$row['type'];

if (mysql_num_rows($login) == 1) {

	if($row['type']==0){
	 $_SESSION['username'] = $row['username'];
       $selectedss = mysql_query("UPDATE tbl_reassign SET noti_llr='0' Where approved='0' Order by id Asc")or die (mysql_error());
		?>
		<script type="text/javascript">
      location.replace("0/existing_truck.php")
		</script>
		<?php
	}else if($row['type']==1){
	 $_SESSION['a_username'] = $row['username'];
       
		?>
		<script type="text/javascript">
      location.replace("1/new_truck.php")
		</script>
		<?php
	}
	else if($row['type']==3){
	 $_SESSION['encoder_username'] = $row['username'];
       
		?>
		<script type="text/javascript">
      location.replace("3/new_truck.php")
		</script>
		<?php
        }	else if($row['type']==2){
	 $_SESSION['bhead_username'] = $row['username'];
	 $_SESSION['owner'] = $row['branch'];
	 
	 		$chk_sen = mysql_query("SELECT * from tbl_reassign WHERE name='".$_SESSION['owner']."' ") or die (mysql_error());
			$chk_rec = mysql_query("SELECT * from tbl_reassign WHERE suppliername='".$_SESSION['owner']."' ") or die (mysql_error());
			
	 		if(mysql_num_rows($chk_sen) > 0){
				 mysql_query("UPDATE tbl_reassign SET noti_send=0 Where name='".$_SESSION['owner']."' ")or die (mysql_error());
			}
			if(mysql_num_rows($chk_rec) > 0){
			    mysql_query("UPDATE tbl_reassign SET noti_rec=0 Where  suppliername='".$_SESSION['owner']."' ")or die (mysql_error());
			}       
		?>
		<script type="text/javascript">
      location.replace("2/existing_truck.php")
		</script>
		<?php
        }else if($row['type']==4){
	 $_SESSION['public_username'] = $row['username'];
       
		?>
		<script type="text/javascript">
      location.replace("4/existing_truck.php")
		</script>
		<?php
        }
}

?>
















