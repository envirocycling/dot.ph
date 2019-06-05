<?php

ini_set('max_execution_time', 1000000);
include 'config.php';


$c = $_POST['ctr'];
$failed_to_insert = 0;
$ctr = 0;
$counter = 0;
while ($ctr < $c) {
    $str = $_POST['str' . $ctr];
    
    $wp_type = '';
    $branch = $_POST['branch' . $ctr];

   $wp_grade = strtoupper($_POST['grade' . $ctr]);

    if ($wp_grade == 'HM.M.WASTE') {
        $wp_grade = 'MW';
    }
	
    if ($wp_grade == 'HM.MW') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'NPB' || $wp_grade == 'OPD') {
        $wp_grade = 'ONP';
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
    if ($wp_grade == 'STICKIES LCWL') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL PADJ') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL STICKIES') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'GUMS LCWL') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL FLEXO' || $wp_grade == 'LCWL Flexo') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL BOOKS' || $wp_grade == 'LCWL_CBS') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'ONP BOOKS') {
        $wp_grade = 'ONP ';
    }
	if ($wp_grade == 'BOOKS LCWL') {
        $wp_grade = 'LCWL';
    }
	if ($wp_grade == 'LCBOOKS LCWL') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'CBS W/ GUMS') {
        $wp_grade = 'CBS';
    }
    if ($wp_grade == 'GUMS ONP') {
        $wp_grade = 'ONP';
    }
    if ($wp_grade == 'STICKIES ONP') {
        $wp_grade = 'ONP';
    }
    if ($wp_grade == 'BOOKS ONP') {
        $wp_grade = 'ONP';
    }
    if ($wp_grade == 'GUMS_CBS' || $wp_grade == 'GUMS CBS') {
        $wp_grade = 'CBS';
    }
    if ($wp_grade == 'CORETUBE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade != 'LCWL' && $wp_grade != 'CHIPBOARD' && $wp_grade != 'LCWL_GW') {
        $wp_grade = 'LC'.$wp_grade;
    } if ($wp_grade == 'LCCB' || $wp_grade == 'LCCHIPBOARD') {
        $wp_grade = 'CHIPBOARD';
    }
    if ($wp_grade == 'LCWL_GW') {
        $wp_grade = 'LCWL';
    }if ($wp_grade == 'LCWL_CBS') {
        $wp_grade = 'LCWL';
    }if ($wp_grade == 'LCWL GUMS') {
        $wp_grade = 'LCWL';
    }

    $wp_grade;

    $tid = $_POST['trans_id' . $ctr];
    $did = $_POST['detail_id' . $ctr];
    $weight = $_POST['weight' . $ctr];
    $date = $_POST['date' . $ctr];
    $trucking = $_POST['trucking' . $ctr];

    $remarks = '';
    $mc_percentage = round($_POST['mcpercentage' . $ctr], 2);
    $mc_weight = $_POST['mcweight' . $ctr];
 $chk = mysql_query("SELECT * from outgoing WHERE trans_id='$tid' and detail_id='$did' and branch='$branch'") or die(mysql_error());

    $num = 0;

   if ($branch == 'Cavite') {
      $branch_url = '192.168.16.5';
	//$branch_url = '192.168.10.201';
    } else if( $branch == 'Pasay'){
 	$branch_url = '192.168.14.5';
	}else if($branch == 'Cainta'){
 	$branch_url = '192.168.17.5';
 } else {
	$branch_url = 'localhost';
}
echo $branch."<br>";
 echo $branch_url."<br>";

if($tid == '' || $tid =='0' || $did=='' || $did=='0'){
		?>
			<script>
				window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php";
			</script>
		<?php
	}else     if ($wp_grade != 'OTHERS' || $wp_grade != 'LCOTHERS') {
        $plate = $_POST['plate_number' . $ctr];
        if ($weight >= 0) {
           
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
    } else if($wp_grade == 'LCOTHERS' || $wp_grade == 'OTHERS'){
        ?>
        <script>
            window.top.location.href = "http://<?php echo $branch_url; ?>/ts/export_receiving_ims.php?tid=<?php echo $tid . '& update=out'; ?>";
        </script>
        <?php
    }
    $ctr++;
}

if(empty($branch_url)){
	$branch = $_GET['branch'];
	if( $branch == 'Cavite'){
 	$branch_url = '192.168.16.5';
	//$branch_url = '192.168.10.201';
 }else if( $branch == 'Pasay'){
 	$branch_url = '192.168.14.5';
 }else if($branch == 'Cainta'){
 	$branch_url = '192.168.17.5';
} else {
	$branch_url = 'localhost';
}
}
if ($num == 1) {
    ?>
    <script>
        window.top.location.href = "http://<?php echo $branch_url; ?>/ts/export_receiving_ims.php?tid=<?php echo $tid . '& update=out'; ?>";
    </script>
    <?php
} else if ($num == 0) {
    ?>
    <script>
       window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php";
    </script>
    <?php
}

?>
