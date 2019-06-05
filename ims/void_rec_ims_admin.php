<?php
include("config.php");
$tid=$_GET['tid'];
$branch=$_GET['branch'];

if($branch == 'Kaybiga'){
 	$branch_url = '192.168.13.5';
 }else if($branch == 'Sauyo'){
 	$branch_url = '192.168.15.5';
 }else if($branch == 'Pasay'){
 	$branch_url = '192.168.254.100';
 }else if($branch == 'Cainta'){
 	$branch_url = '192.168.2.6';
 }else if($branch = 'Mangaldan'){
 	$branch_url = '192.168.0.101';
 }else if($branch = 'Calamba'){
 	$branch_url = '192.168.0.106';
 }else if($branch = 'Cavite'){
 	$branch_url = '192.168.22.5';
 }
 
$select = mysql_query("SELECT * from paper_buying WHERE trans_id='$tid' and trans_id!='' and trans_id!='0' and branch='$branch'") or die (mysql_error());
if(mysql_num_rows($select) > 0){
		while($row = mysql_fetch_array($select)){
			
			$log_id = $row['log_id']; 
			$date =$row['date_received'];
			$trans_id =$row['trans_id'];
			$detail_id =$row['detail_id'];
			$priority_number = $row['priority_number'];
			$supp_id =$row['supplier_id'];
			$supp_name =$row['supplier_name'];
			$plate = $row['plate_number'];
			$wp_grade = $row['wp_grade'];
			$unit_cost = $row['unit_cost'];
		    $weight = $row['corrected_weight'];
			$paper_buying = $row['paper_buying'];
			$branch =$row['branch'];
			$table_name = 'paper_buying';
			
			if(mysql_query("INSERT INTO tbl_deleted_data (trans_id,detail_id,date,priority_number,supplier_id,supplier_name,plate_number,wp_grade,unit_cost,net_weight,paper_buying,branch,table_name) VALUES('$trans_id','$detail_id','$date','$priority_number','$supp_id','$supp_name','$plate','$wp_grade','unit_cost','$weight','$paper_buying','$branch','$table_name')")or die (mysql_error())){
		mysql_query("DELETE from paper_buying WHERE log_id='$log_id' ") or die (mysql_error());
		$num2=1;
		}else{
		?>
			<script>
				alert("There is an Error in IMS Paper Buying.");
				location.replace("http://<?php echo $branch_url;?>/ts/user-login/admin/index.php");
			</script>
		<?php
		}
			
}
}else{
	?>
		<script>
			alert("No data found in paper_buying.");
			location.replace("http://<?php echo $branch_url;?>/ts/user-login/admin/index.php");
		</script>
	<?php
}

$tid=$_GET['tid'];
$branch=$_GET['branch'];

$select_del = mysql_query("SELECT * from sup_deliveries WHERE trans_id='$tid' and trans_id!='' and trans_id!='0' and branch_delivered='$branch' ") or die (mysql_error());
 if(mysql_num_rows($select_del) > 0){
		while($row_del = mysql_fetch_array($select_del)){
		
		$table_name = 'supp_deliveries';
		$supp_id = $row_del['supplier_id'];
		$trans_id = $row_del['trans_id']; 
		$detail_id = $row_del['detail_id']; 
		$supp_name = $row_del['supplier_name'];
		$supp_type = $row_del['supplier_type'];
		$bh = $row_del['bh_in_charge'];
		$plate = $row_del['plate_number'];
		$wp_grade = $row_del['wp_grade']; 
		$weight = $row_del['weight']; 
		$branch = $row_del['branch_delivered'];
		$date = $row_del['date_delivered'];
		$month= $row_del['month_delivered'];
		$day = $row_del['day_delivered'];
		$year = $row_del['year_delivered'];
		$priority_number = $row_del['priority_number'];
		$del_id = $row_del['del_id'];
		if(mysql_query("INSERT INTO tbl_deleted_data (trans_id,detail_id,supplier_id,supplier_name,supp_type,plate_number,wp_grade,weight,branch,date,table_name,bh_incharge,month,day,year,priority_number) VALUES('$trans_id','$detail_id','$supp_id','$supp_name','$supp_type','$plate','$wp_grade','$weight','$branch','$date','$table_name','$bh','$month','$day','$year','$priority_number')") or die (mysql_error())){
		$num1 =1;
		mysql_query("DELETE from sup_deliveries WHERE del_id='$del_id' ") or die (mysql_error());
		}else{
		?>
			<script>
				alert("There is an Error in IMS Supplier Deliveries.");
				location.replace("http://<?php echo $branch_url;?>/ts/user-login/admin/index.php");
			</script>
		<?php
		}
	}

}else{
	?>
		<script>
			alert("No data found in sup_deliveries.");
			location.replace("http://<?php echo $branch_url;?>/ts/user-login/admin/index.php");
		</script>
	<?php
}
if($num1 == 1 && $num2 == 1){
?>
<script>
	alert('Void Successful');
 	location.replace("http://<?php echo $branch_url;?>/ts/user-login/admin/index.php");
</script>
<?php	
}else{
	?>
<script>
	alert('1 or More Error_s Found.');
 	location.replace("http://<?php echo $branch_url;?>/ts/user-login/admin/index.php");
</script>
<?php	
}