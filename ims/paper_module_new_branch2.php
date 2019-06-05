<?php

ini_set('max_execution_time', 1000000);
include 'config.php';

$c = $_POST['ctr'];
$failed_to_insert = 0;
$ctr = 0;
$counter = 0;
while ($ctr < $c) {
    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='" . $_POST['supplier_id' . $ctr] . "'") or die (mysql_error());
    $rs_sup = mysql_fetch_array($sql_sup);
    $supplier_id = $_POST['supplier_id' . $ctr];
	   $branch = 'Mangaldan';

 	$branch_url = '192.168.19.5';

 
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
    $weight = $_POST['correct_weight' . $ctr];
  $date = $_POST['date' . $ctr];
   $priority_number = $_POST['priority_no' . $ctr];
   $price = $_POST['price' . $ctr];
 

      $paper_buying = $weight * $price;
	 
	 $chk = mysql_query("SELECT * from paper_buying WHERE trans_id='$tid' and detail_id='$did' and branch='$branch'") or die (mysql_error());

	$num = 0;
	if($tid == '' || $tid == '0' || $did == '0' || $did == ''){
	?>
		<script>
			window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php";
		</script>
	<?php
	}else
    if($wp_grade != 'LCOTHERS' || $wp_grade != 'OTHERS'){
        $plate_number = $_POST['plate_number' . $ctr];
		
  		if ($weight >= 0) {
          		
				if(mysql_num_rows($chk) == 0 ){  		
				
					if (mysql_query("INSERT INTO paper_buying (trans_id,detail_id,date_received,priority_number,supplier_id,supplier_name,plate_number,wp_grade,corrected_weight,unit_cost,paper_buying,branch)
VALUES('$tid','$did','$date','$priority_number','$supplier_id','$supplier_name','$plate_number','$wp_grade','$weight','$price','$paper_buying',
'$branch')")) 		{
                	$num = 1;
					}             
				}else if(mysql_num_rows($chk) > 0 ){
					
					if(mysql_query("UPDATE paper_buying SET trans_id='$tid',detail_id='$did',date_received='$date',priority_number='$priority_number',supplier_id='$supplier_id',supplier_name='$supplier_name',plate_number='$plate_number',wp_grade='$wp_grade',corrected_weight='$weight',unit_cost='$price',paper_buying='$paper_buying',branch='$branch' WHERE trans_id='$tid' and detail_id='$did' and branch='$branch' ") ){
					$num=1;					
					}
				}
       	 }
   	}else if($wp_grade == 'OTHERS'){
		?>
	<script>
		window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php?tid=<?php echo $tid.'& update=paper';?>";
	</script>
		<?php	
	}
	$ctr++;
}
 
$branch_url = '192.168.19.5';
if($num == 1){
?>
	<script>
		window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php?tid=<?php echo $tid.'& update=paper';?>";
	</script>
<?php
	
}else if($num == 0){
	?>
	<script>
		window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php?error=1&tbl=paper&tid=<?php echo $tid.'&did='.$did;?>";
	</script>
	<?php
	
}

?>
