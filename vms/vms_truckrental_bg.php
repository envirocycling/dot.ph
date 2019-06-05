<?php
include("connect.php");

date_default_timezone_set("Asia/Singapore");

$sql_chk = mysql_query("SELECT * from tbl_setting") or die(mysql_error());
$row_chk = mysql_fetch_array($sql_chk);		

$branch= $_GET['branch'];
$sql_branch = mysql_query("SELECT * from tbl_branches WHERE branch_name LIKE '%$branch%'") or die(mysql_error());
$row_branch = mysql_fetch_array($sql_branch);
				
if($row_branch['branch_name'] == 'PAMPANGA'){
//$url = 'http://10.151.5.57/paymentsystem/bg_vms_truckrental.php';			
$url = 'http://'.$row_branch['ip_address'].'/paymentsystem/bg_vms_truckrental.php';
}else{
    //$url = 'http://10.151.5.57/ts/bg_vms_truckrental.php';		
  $url = 'http://'.$row_branch['ip_address'].'/ts/bg_vms_truckrental.php';
}
//$url = 'http://10.151.5.57/paymentsystem/bg_vms_truckrental.php';
//$url = 'http://192.168.10.200/paymentsystem-test/bg_vms_truckrental.php';

//if($row_chk['availability'] == '0'){
					
						$date = date('Y/m/d');
						$ctr = 1;
						$sql_given = mysql_query("SELECT * from tbl_givento WHERE up='0' and suppliername!='' and name LIKE '%$branch%' and suppliername != '1449' and suppliername != '1450' and suppliername != '1452' and suppliername != '1453' and suppliername != '1454' and suppliername != '1455' and suppliername != '1456' and suppliername != '1458' and suppliername != '14025' and suppliername != '14066' and suppliername != '14317'") or die(mysql_error()); 
						//$sql_given2 = mysql_query("SELECT * from tbl_givento WHERE up='0' and suppliername!=''") or die(mysql_error()); 
				
				if(mysql_num_rows($sql_given) > 0){
					
					//mysql_query("UPDATE tbl_setting SET availability='1'") or die(mysql_error());
					
					echo '<form action="'.$url.'" method="post" name="myForm">';
						while($row_given = mysql_fetch_array($sql_given)){
								
								$sql_plate = mysql_query("SELECT * from tbl_truck_report WHERE id='".$row_given['truckid']."' and (wheels='6' or wheels='10' or class LIKE '%truck%') and class NOT LIKE '%HE%' and class NOT LIKE '%COMPANY%'") or die (mysql_error());
								$row_plate = mysql_fetch_array($sql_plate);
								$plate = $row_plate['truckplate'];
								
						if(mysql_num_rows($sql_plate) > 0){	
								$sql_status = mysql_query("SELECT * from tbl_assigntosupp_history WHERE given_id='".$row_given['id']."' and up='0' ORDER BY id Desc LIMIT 1") or die(mysql_error());
								$row_status = mysql_fetch_array($sql_status);
								
								echo '<input type="text" name="vms_id'.$ctr.'" value="'.$row_given['id'].'">';
								echo '<input type="text" name="supplier_id'.$ctr.'" value="'.$row_given['suppliername'].'">';
								echo '<input type="text" name="plate_no'.$ctr.'" value="'.$plate.'">';
								echo '<input type="text" name="ref_no'.$ctr.'" value="'.$row_given['ref_no'].'">';
								echo '<input type="text" name="rental'.$ctr.'" value="'.$row_given['amortization'].'">';
								echo '<input type="text" name="rental_mo'.$ctr.'" value="'.$row_given['amortization_month'].'">';
								echo '<input type="text" name="cashbond'.$ctr.'" value="'.$row_given['cashbond'].'">';
								echo '<input type="text" name="porposed_volume'.$ctr.'" value="'.$row_given['proposedvolume'].'">';
								echo '<input type="text" name="penalty'.$ctr.'" value="'.$row_given['penalty'].'">';
								echo '<input type="text" name="cashbond_mo'.$ctr.'" value="'.$row_given['cashbond_month'].'">';
								echo '<input type="text" name="issuance_date'.$ctr.'" value="'.$row_given['issuancedate'].'">';
								echo '<input type="text" name="end_date'.$ctr.'" value="'.$row_given['enddate'].'">';
								echo '<input type="text" name="date_encode'.$ctr.'" value="'.$row_given['date_encode'].'">';
								echo '<input type="text" name="status'.$ctr.'" value="'.$row_status['status'].'">';
								echo '<input type="text" name="ref_nostatus'.$ctr.'" value="'.$row_status['ref_no'].'">';
								echo '<input type="text" name="supplier_idstatus'.$ctr.'" value="'.$row_status['suppliername'].'">';
                                                                echo '<input type="text" name="branch'.$ctr.'" value="'.$branch.'">';
															
							$ctr++;
								mysql_query("UPDATE tbl_assigntosupp_history SET up='1' WHERE id='".$row_status['id']."'") or die (mysql_error());
						}
					}
					
							echo '<input type="text" name="ctr" value="'.$ctr.'">';
					echo '</form>';
					
						if(mysql_query("UPDATE tbl_givento SET up='1' WHERE up='0' and name LIKE '%$branch%'") or die(mysql_error())){
							//mysql_query("UPDATE tbl_setting SET availability='0'") or die(mysql_error());
							echo '<script>
										document.myForm.submit();
								</script>';
						}else{
							//mysql_query("UPDATE tbl_setting SET availability='0'") or die(mysql_error());
							echo '<script>
									window.top.location="'.$url.'";
								</script>';
						}
					
				}else{
				//	mysql_query("UPDATE tbl_setting SET availability='0'") or die(mysql_error());
					echo '<script>
							window.top.location="'.$url.'";
						</script>';
				}



/*}else{
	echo '<script>
			window.top.location="'.$url.'";
		</script>';
}*/
?>