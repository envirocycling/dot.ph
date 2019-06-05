<?php
ini_set('max_execution_time', 1000000);
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
    
	echo $str = $_POST['str' . $ctr];

    echo $wp_grade = $_POST['grade' . $ctr];
    $tid = $_POST['trans_id' . $ctr];
    $did = $_POST['detail_id' . $ctr];
    $weight = $_POST['weight' . $ctr];
    $date = $_POST['date' . $ctr];
    $trucking = $_POST['trucking' . $ctr];
	$plate = $_POST['plate_number' . $ctr];

    $remarks = '';
    $mc_percentage = '';
    $mc_weight = '';


    $num = 0;
	$from = $_POST['from'];
	$to = $_POST['to'];
  	$branch = 'Urdaneta';
 	
if($tid == '' || $tid == '0' || $did == '0' || $did == ''){
	?>
		<script>
			window.top.location.href = "http://<?php echo $branch_url;?>?tid=<?php echo $tid.'&from='.$from.'&to='.$to;?>";
		</script>
	<?php
	}else
    if ($wp_grade != 'OTHERS' || $wp_grade != 'LCOTHERS' ) {
        if ($weight >= 0) {
            $chk = mysql_query("SELECT * from outgoing WHERE trans_id='$tid' and detail_id='$did' and branch='$branch'") or die(mysql_error());
            if (mysql_num_rows($chk) == 0) {
                if (mysql_query("INSERT INTO outgoing (trans_id,detail_id,str,date,trucking,plate_number,wp_grade,weight,branch,mc_perct,mc_weight) VALUES ('$tid','$did','$str','$date','$trucking','$plate','$wp_grade','$weight','$branch','$mc_percentage','$mc_weight')")or die(mysql_error())) {
                    $num = 1;
                }
            } else if (mysql_num_rows($chk) > 0) {
                if (mysql_query("UPDATE outgoing SET trans_id='$tid',detail_id='$did',str='$str',date='$date',trucking='$trucking',plate_number='$plate',wp_grade='$wp_grade',weight='$weight',branch='$branch',mc_perct='$mc_percentage',mc_weight='$mc_weight' WHERE trans_id='$tid' and detail_id='$did' and branch='$branch'") or die(mysql_error())) {
                    $num = 1;
                }
            }
        }
    } else  if($wp_grade == 'LCOTHERS' || $wp_grade == 'OTHERS'){
        ?>
        <script>
            window.top.location.href = "http://<?php echo $branch_url; ?>?tid=<?php echo $tid.'& update=outgoing&from='.$from.'&to='.$to;?>";
        </script>
        <?php
    }

    $ctr++;

}

if ($num == 1) {
    ?>
    <script>
        window.top.location.href = "http://<?php echo $branch_url; ?>?tid=<?php echo $tid.'& update=outgoing&from='.$from.'&to='.$to;?>";
    </script>
    <?php
} else if ($num == 0) {
    ?>
    <script>
        alert("System Error.");
       window.top.location.href = "http://<?php echo $branch_url; ?>?error=1&tid=<?php echo $tid;?>";
    </script>
    <?php
}
?>
