<?php

ini_set('max_execution_time', 10000000000);
include 'config.php';

@$back = $_GET['back'];
if(@$back == 'both'){
	$branch_url = '192.168.8.100/wpis/user/iframe/update_to_ims_both.php';
}else if(@$back == 'rec'){
	$branch_url = '192.168.8.100/wpis/user/iframe/update_to_ims_rec.php';
}else if(@$back == 'out'){
	$branch_url = '192.168.8.100/wpis/user/iframe/update_to_ims_out.php';
}

$c = $_POST['ctr'];
$failed_to_insert = 0;
$ctr = 0;
$counter = 0;
while ($ctr < $c) {
     $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='" . $_POST['supplier_id' . $ctr] . "'") or die (mysql_error());
    $rs_sup = mysql_fetch_array($sql_sup);
    $supplier_id = $_POST['supplier_id' . $ctr];
   
    $supplier_name = $rs_sup['supplier_name'];
    $classification = $rs_sup['classification'];
    $bh_ic_charge = $rs_sup['bh_in_charge'];
    $priority_no = '';
    $wp_grade = $_POST['wp_grade' . $ctr];
	if($wp_grade != 'LCWL'){
		if($wp_grade != 'CHIPBOARD')
		{$wp_grade = substr($wp_grade,2);}
	}

   $tid = $_POST['trans_id' . $ctr];
   $did = $_POST['detail_id' . $ctr];
   $weight = $_POST['weight' . $ctr];
   $date = $_POST['date' . $ctr];
   $month_delivered = date("F", strtotime($date));
   $day_delivered = date("d", strtotime($date));
   $year_delivered = date("Y", strtotime($date));

   $priority_number = '';
   $weight_adj = '';
   $mc_percentage = '';

    $remarks = '';
    $mc_percentage = '';
    $mc_weight = '';
	$ic_in_charge = '';
	$plate_number = '';
	$sic_in_charge = '';

	$num = 0;
	$branch = 'Urdaneta';
	$from = $_POST['from'];
	$to = $_POST['to'];
	
		if($tid == '' || $tid =='0' || $did =='' || $did == '0'){
	?>
		<script>
			window.top.location.href = "http://<?php echo $branch_url;?>?tid=<?php echo $tid.'&from='.$from.'&to='.$to;?>";
		</script>
	<?php
	}else   if ($wp_grade != 'OTHERS' || $wp_grade != 'LCOTHERS') {	 
		 
        	if ($weight >= 0 ) {
				$chk = mysql_query("SELECT * from sup_deliveries WHERE trans_id='$tid' and detail_id='$did' and branch_delivered LIKE'%$branch%'") or die (mysql_error());
				
				if(mysql_num_rows($chk) == 0){
            		if (mysql_query("INSERT INTO sup_deliveries (trans_id,detail_id,supplier_id,supplier_name,supplier_type,bh_in_charge,wp_grade,weight,branch_delivered,date_delivered,month_delivered,day_delivered,year_delivered,encoder,shift_in_charge,priority_number,mc_percentage,mc_weight,remarks,plate_number)
VALUES('$tid','$did','$supplier_id','$supplier_name','$classification','$bh_ic_charge','$wp_grade','$weight','$branch','$date','$month_delivered','$day_delivered','$year_delivered','$ic_in_charge','$sic_in_charge','$priority_no','$mc_percentage','$mc_weight','$remarks','$plate_number')") or die (mysql_error())) {
                	$num = 1;
					}             
       	   	}else if( mysql_num_rows($chk) > 0){
					if(mysql_query("UPDATE sup_deliveries SET trans_id='$tid',detail_id='$did',supplier_id='$supplier_id',supplier_name='$supplier_name',supplier_type='$classification',bh_in_charge='$bh_ic_charge',wp_grade='$wp_grade',weight='$weight',branch_delivered='$branch',date_delivered='$date',month_delivered='$month_delivered',day_delivered='$day_delivered',year_delivered='$year_delivered',encoder='$ic_in_charge',shift_in_charge='$sic_in_charge',priority_number='$priority_no',mc_percentage='$mc_percentage',mc_weight='$mc_weight',remarks='$remarks',plate_number='$plate_number' WHERE trans_id='$tid' and detail_id='$did' and branch_delivered='$branch'")or die (mysql_error())){
						$num = 1;
						}
				}
		  }
   		}else{
		?>
	<script>
		window.top.location.href = "http://<?php echo $branch_url.'?tid='.$tid.'& update=receiving&from='.$from.'&to='.$to;?>";
	</script>
		<?php	
	}
	$ctr++;
}

if($num == 1){
?>
	<script>
		window.top.location.href = "http://<?php echo $branch_url;?>?tid=<?php echo $tid.'& update=receiving&from='.$from.'&to='.$to;?>";
	</script>
<?php
	
}else if($num == 0){
	?>
	<script>
		window.top.location.href = "http://<?php echo $branch_url;?>?error=1&tid=<?php echo $tid;?>";
	</script>
	<?php
	
}
?>
