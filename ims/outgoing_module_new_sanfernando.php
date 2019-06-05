<?php

ini_set('max_execution_time', 1000000);
include 'config.php';

 $branch_url = '192.168.254.5';
$c = $_POST['ctr'];
$failed_to_insert = 0;
$ctr = 0;
$counter = 0;
$wp_type = '';
while ($ctr < $c) {
    $str = $_POST['str' . $ctr];
    $branch = $_POST['branch' . $ctr];
    $wp_grade = strtoupper($_POST['grade' . $ctr]);

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
    if ((strpos($wp_grade, 'CBS') !== false) && (strpos($wp_grade, 'GUMS') !== false)) {
        $wp_grade = 'LCCBS_GUMS/STICKIES';
    }
    if ((strpos($wp_grade, 'CBS') !== false) && (strpos($wp_grade, 'STICKIES') !== false)) {
        $wp_grade = 'LCCBS_GUMS/STICKIES';
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
    
    if ((strpos($wp_grade, 'LCWL') === false) && (strpos($wp_grade, 'CHIPBOARD') === false)) {
        //$wp_grade = 'LC'.$wp_grade;
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


    $num = 0;

   
 
  
if($tid == '' || $tid =='0' || $did=='' || $did == '0'){
	?>
		<script>
			window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php";
		</script>
	<?php
	}else   if ($wp_grade != 'LCOTHERS' || $wp_grade != 'OTHERS') {
        $plate = $_POST['plate_number' . $ctr];
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
    } else {
        ?>
        <script>
            window.top.location.href = "http://<?php echo $branch_url; ?>/ts/export_receiving_ims.php?tid=<?php echo $tid . '& update=out'; ?>";
        </script>
        <?php
    }
    $ctr++;
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
