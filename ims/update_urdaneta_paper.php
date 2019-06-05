<?php
include 'config.php';

$c = $_POST['ctr'];
$ctr = 0;
$counter = 0;

@$back = $_GET['back'];
if(@$back == 'both'){
	$branch_url = '192.168.8.100/wpis/user/iframe/update_to_ims_both.php';
}else if(@$back == 'rec'){
	$branch_url = '192.168.8.100/wpis/user/iframe/update_to_ims_rec.php';
}else if(@$back == 'out'){
	$branch_url = '192.168.8.100/wpis/user/iframe/update_to_ims_out.php';
}

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
    $weight = $_POST['correct_weight' . $ctr];
  $date = $_POST['date' . $ctr];
  $priority_number = '';
  $price = $_POST['price' . $ctr];
  $branch = $_POST['branch' . $ctr];
  $plate_number = $_POST['plate_number' . $ctr];
  	$from = $_POST['from'];
	$to = $_POST['to'];
 

      $paper_buying = $weight * $price;
	 
	 $chk = mysql_query("SELECT * from paper_buying WHERE trans_id='$tid' and detail_id='$did' and branch='$branch'") or die (mysql_error());

	$num = 0;
	if($tid == '' || $tid == '0' || $did == '0' || $did == ''){
	?>
		<script>
			window.top.location.href = "http://<?php echo $branch_url;?>?tid=<?php echo $tid.'&from='.$from.'&to='.$to;?>";
		</script>
	<?php
	}else
    if($wp_grade != 'LCOTHERS' || $wp_grade != 'OTHERS') {

		
  		if ($weight >= 0) {
          		
				if(mysql_num_rows($chk) == 0){  		
				
					if (mysql_query("INSERT INTO paper_buying (trans_id,detail_id,date_received,priority_number,supplier_id,supplier_name,plate_number,wp_grade,corrected_weight,unit_cost,paper_buying,branch)
VALUES('$tid','$did','$date','$priority_number','$supplier_id','$supplier_name','$plate_number','$wp_grade','$weight','$price','$paper_buying',
'$branch')")) 		{
                	$num = 1;
					}             
				}else if(mysql_num_rows($chk) > 0){
					
					if(mysql_query("UPDATE paper_buying SET trans_id='$tid',detail_id='$did',date_received='$date',priority_number='$priority_number',supplier_id='$supplier_id',supplier_name='$supplier_name',plate_number='$plate_number',wp_grade='$wp_grade',corrected_weight='$weight',unit_cost='$price',paper_buying='$paper_buying',branch='$branch' WHERE trans_id='$tid' and detail_id='$did' and branch='$branch' ") ){
					$num=1;					
					}
				}
       	 }
   	}else if ($wp_grade == 'OTHERS'){
		?>
	<script>
		window.top.location.href = "http://<?php echo $branch_url.'?tid='.$tid.'& update=paper&from='.$from.'&to='.$to;?>";
	</script>
		<?php	
	}
	$ctr++;
}
 

if($num == 1){
?>
	<script>
		window.top.location.href = "http://<?php echo $branch_url;?>?tid=<?php echo $tid.'& update=paper&from='.$from.'&to='.$to;?>";
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
