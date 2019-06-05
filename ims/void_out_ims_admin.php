<?php
include('config.php');
echo $tid=$_GET['tid'];
echo $branch=$_GET['branch'];


if($branch == 'Kaybiga'){
 	$branch_url = '192.168.13.5';
 }else if($branch == 'Sauyo'){
 	$branch_url = '192.168.15.5';
 }else  if($branch == 'Pasay'){
 	$branch_url = '192.168.14.5';
 }else if($branch == 'Cainta'){
 	$branch_url = '192.168.2.6';
 }else if($branch = 'Mangaldan'){
 	$branch_url = '192.168.0.5';
 }else if($branch = 'Cavite'){
 	$branch_url = '192.168.22.5';
 }
 
$select_out = mysql_query("SELECT * from outgoing WHERE trans_id='$tid' and trans_id!='' and trans_id!='0' and branch='$branch' ") or die (mysql_error());
 if(mysql_num_rows($select_out) > 0 ){
		while($row_out = mysql_fetch_array($select_out)){
		
		 $table_name = 'outgoing';
		 $log_id = $row_out['log_id'];
		 $str = $row_out['str'];
		 $date = $row_out['date'];
		 $trucking = $row_out['trucking'];
		 $plate_number = $row_out['plate_number'];
		 $wp_grade = $row_out['wp_grade'];
		 $weight= $row_out['weight'];
		 $branch = $row_out['branch'];
		 $trans_id = $row_out['trans_id'];
		 $detail_id = $row_out['detail_id'];
		 
		if(mysql_query("INSERT INTO tbl_deleted_data (trans_id,detail_id,str_no,date,trucking,plate_number,wp_grade,weight,branch,table_name) VALUES('$trans_id','$detail_id','$str','$date','$trucking','$plate_number','$wp_grade','$weight','$branch','$table_name')")){
		mysql_query("DELETE from outgoing WHERE log_id='$log_id' ") or die (mysql_error());
		@$num = 1;
		}else{
		?>
			<script>
				alert("There is an Error in IMS Outgoing.");
				location.replace("http://<?php echo $branch_url;?>/ts/user-login/admin/outgoing.php");
			</script>
		<?php
		}
}
}else{
	?>	
	<script>
				alert("No Data Found.");
				location.replace("http://<?php echo $branch_url;?>/ts/user-login/admin/outgoing.php");
			</script>
	<?php
}
if(@$num == 1){
	?>
			<script>
				alert("Void Successful.");
				location.replace("http://<?php echo $branch_url;?>/ts/user-login/admin/outgoing.php");
			</script>
		<?php
}
	?>