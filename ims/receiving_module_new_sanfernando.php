<?php


ini_set('max_execution_time', 1000000);
include 'config.php';

$branch_url = '192.168.254.5';
$c = $_POST['ctr'];
$failed_to_insert = 0;
$ctr = 0;
$counter = 0;
while ($ctr < $c) {
    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='" . $_POST['supplier_id' . $ctr] . "'") or die (mysql_error());
    $rs_sup = mysql_fetch_array($sql_sup);
    $supplier_id = $_POST['supplier_id' . $ctr];
    $branch = $_POST['branch' . $ctr];
    $supplier_name = $rs_sup['supplier_name'];
    $classification = $rs_sup['classification'];
    $bh_ic_charge = $rs_sup['bh_in_charge'];
    $priority_no = $_POST['priority_no' . $ctr];
    $wp_grade = strtoupper($_POST['wp_grade' . $ctr]);

    if ((strpos($wp_grade, 'STICKIES') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
        $wp_grade = 'LCWL_GUMS/STICKIES';
    }
    if ((strpos($wp_grade, 'GUMS') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
        $wp_grade = 'LCWL_GUMS/STICKIES';
    }
    if ((strpos($wp_grade, 'BOOKS') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
        $wp_grade = 'LCWL_BOOKS';
    }
    if ((strpos($wp_grade, 'CBS') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
        $wp_grade = 'LCWL_CBS';
    }
    if ((strpos($wp_grade, 'CBS') !== false) && (strpos($wp_grade, 'GUMS') !== false)) {
        $wp_grade = 'LCCBS_GUMS/STICKIES';
    }
    if ((strpos($wp_grade, 'CBS') !== false) && (strpos($wp_grade, 'STICKIES') !== false)) {
        $wp_grade = 'LCCBS_GUMS/STICKIES';
    }
    if ((strpos($wp_grade, 'FLEXO') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
        $wp_grade = 'LCWL';
    }
    if ((strpos($wp_grade, 'BOOKS') !== false) && (strpos($wp_grade, 'ONP') !== false)) {
        $wp_grade = 'ONP';
    }
    if ((strpos($wp_grade, 'GUMS') !== false) && (strpos($wp_grade, 'ONP') !== false)) {
        $wp_grade = 'ONP_GUMS/STICKIES';
    }
    if ((strpos($wp_grade, 'STICKIES') !== false) && (strpos($wp_grade, 'ONP') !== false)) {
        $wp_grade = 'ONP_GUMS/STICKIES';
    }
    if ((strpos($wp_grade, 'GUMS') !== false) && (strpos($wp_grade, 'CBS') !== false)) {
        $wp_grade = 'CBS';
    }
    if ((strpos($wp_grade, 'GW') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
        $wp_grade = 'LCWL_GW';
    }
    if ((strpos($wp_grade, 'CBS') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
        $wp_grade = 'LCWL_CBS';
    }  
    if ((strpos($wp_grade, '_S') !== false) && (strpos($wp_grade, 'MW') !== false)) {
        $wp_grade = 'MW_S';
    }
    if ($wp_grade == 'HM.M.WASTE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'HM.MW') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'M.WASTE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'MW.PLAYING CARDS') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CORETUBE M.WASTE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CARDS') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'MW-PPQ') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CT') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'HM.OCC') {
        $wp_grade = 'OCC';
    }
    if ($wp_grade == 'LCWL PADJ') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'CORETUBE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CB') {
        $wp_grade = 'CHIPBOARD';
    }
    
	$wp_grade;

   $tid = $_POST['trans_id' . $ctr];
   $did = $_POST['detail_id' . $ctr];
   $weight = $_POST['weight' . $ctr];
   $date = $_POST['date' . $ctr];
   $month_delivered = date("F", strtotime($date));
   $day_delivered = date("d", strtotime($date));
   $year_delivered = date("Y", strtotime($date));

   $priority_number = $_POST['priority_no' . $ctr];
   $weight_adj = $_POST['weight_adj' . $ctr];
   $mc_percentage = $_POST['mc_percentage' . $ctr];

    $remarks = '';
    $mc_percentage = '';
    $mc_weight = '';

    if ($weight_adj  == 'moisture') {
        if ($branch == 'Kaybiga') {
            if ($mc_percentage > 10) {
                $remarks = 'High Moisture';
                $mc_percentage=$mc_percentage-10;
                $mc_weight=($weight*($mc_percentage/100));
                $weight=($weight-($weight*($mc_percentage/100)));

            } else {
                $remarks = '';
                $mc_percentage = '';
                $mc_weight = '';
            }
        } else if($branch == 'Sauyo') {
            if ($mc_percentage > 8) {
                $remarks = 'High Moisture';
                $mc_percentage=$mc_percentage-8;
                $mc_weight=($weight*($mc_percentage/100));
                $weight=($weight-($weight*($mc_percentage/100)));

            } else {
                $remarks = '';
                $mc_percentage = '';

                $mc_weight = '';
            }
        } else if($branch == 'Mangaldan') {
            if ($mc_percentage > 8) {
                $remarks = 'High Moisture';
                $mc_percentage=$mc_percentage-8;
                $mc_weight=($weight*($mc_percentage/100));
                $weight=($weight-($weight*($mc_percentage/100)));

            } else {
                $remarks = '';
                $mc_percentage = '';
                $mc_weight = '';
            }
        } else {
            $remarks = '';
            $mc_percentage = '';
            $mc_weight = '';
        }
    } else {
        $remarks = '';
        $mc_percentage = '';
        $mc_weight = '';
    }
	$num = 0;
	
 	//$branch_url = '192.168.254.5';
	
		if($tid == '' || $tid =='0' || $did =='' || $did == '0'){
	?>
		<script>
			window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php";
		</script>
	<?php
	}else   if ($wp_grade != 'OTHERS' || $wp_grade != 'LCOTHERS') {
         $plate_number = $_POST['plate_number' . $ctr];
         $ic_in_charge = $_POST['encoder' . $ctr];
         $sic_in_charge = $_POST['shift_in_charge' . $ctr];
		 
		 
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
		window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php?tid=<?php echo $tid.'& update=receiving';?>";
	</script>
		<?php	
	}
	$ctr++;
}


if($num == 1){
?>
	<script>
		window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php?tid=<?php echo $tid.'& update=receiving';?>";
	</script>
<?php
	
}else if($num == 0){
	?>
	<script>
		window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php";
	</script>
	<?php
	
}
?>
