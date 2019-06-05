<?php
session_start();

include('connect.php');



$login = mysql_query("SELECT * FROM tbl_users WHERE username='".$_POST['username']."' and password= BINARY'".$_POST['password']."'") or die("Could not connect to database");



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
        
         $_SESSION['id'] = $row['id'];

	if($row['type']==0){
	 $_SESSION['username'] = $row['username'];
         $selectedss = mysql_query("UPDATE tbl_reassign SET noti_llr='0' Where approved='0' Order by id Asc")or die (mysql_error());
         mysql_query("UPDATE tbl_contract SET gm_noti='0' Where status LIKE 'pending%' Order by id Asc")or die (mysql_error());
		?>
		<script type="text/javascript">
      location.replace("0/");
		</script>
		<?php
	}else if($row['type']==1){
	 $_SESSION['a_username'] = $row['username'];
       
		?>
		<script type="text/javascript">
      location.replace("1/new_truck.php");
		</script>
		<?php
	}
	else if($row['type']==3){
	 $_SESSION['encoder_username'] = $row['username'];
	 $_SESSION['owner'] = $row['branch'];
            
             mysql_query("UPDATE tbl_contract SET 3_noti=0 Where status LIKE 'pending%'");
             
		?>
		<script type="text/javascript">
      location.replace("3/");
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
                        
                        $sql_contract = mysql_query("SELECT * from tbl_contract WHERE status LIKE 'pending%'") or die(mysql_error());
                        while($row_contract = mysql_fetch_array($sql_contract)){
                           $sql_truck = mysql_query("SELECT * from tbl_truck_report WHERE branch LIKE '".$row['branch']."' and id = '".$row_contract['truck_id']."'") or die(mysql_error());
                                if(mysql_num_rows($sql_truck) > 0){
                                    mysql_query("UPDATE tbl_contract SET branch_noti='0' WHERE id='".$row_contract['id']."'") or die(mysql_error());
                                }
                        }
		?>
		<script type="text/javascript">
      location.replace("2/");
		</script>
		<?php
        }else if($row['type']==4){
	 $_SESSION['public_username'] = $row['username'];
       
		?>
		<script type="text/javascript">
      location.replace("4/");
		</script>
		<?php
        }
}

?>
















