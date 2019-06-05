<?php

include 'config.php';
echo "<div align='center'>";
echo "<br><br><br>";
echo "<font color='Blue' size='30'>Saving Data to IMS</font>";
echo "<br>";
echo "<font color='Blue' size='30'>Please Wait</font>";
echo "<br>";
echo "<img src='images/ajax-loader.gif'>";
echo "</div>";

$from = $_POST['from'];
$to = $_POST['to'];
$branch = $_POST['branch'];



$c = $_POST['ctr'];
$failed_to_insert = 0;
$ctr = 0;
$counter = 0;

while ($ctr < $c) {
    $str = $_POST['str' . $ctr];
    $date = $_POST['date' . $ctr];
    $priority_no = $_POST['priority_no' . $ctr];
    $trucking = $_POST['trucking' . $ctr];
    $plate_number = $_POST['plate_number' . $ctr];
    $wp_grade = $_POST['wp_grade' . $ctr];
    $weight = $_POST['weight' . $ctr];
    if ($wp_grade == 'M.WASTE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CB') {
        $wp_grade = 'CHIPBOARD';
    }
    if ($wp_grade == 'CORETUBE M.WASTE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CT') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'LCWL PADJ') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'STICKIES LCWL') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'GUMS LCWL') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL FLEXO' || $wp_grade == 'LCWL Flexo') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'BOOKS LCWL') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'GUMS ONP') {
        $wp_grade = 'ONP';
    }
    if ($wp_grade == 'BOOKS ONP') {
        $wp_grade = 'ONP';
    }
    if ($wp_grade == 'STICKIES ONP') {
        $wp_grade = 'ONP';
    }
    if ($wp_grade != 'LCWL' && $wp_grade != 'CHIPBOARD') {
        $wp_grade = "LC" . $wp_grade;
    }
    if ($wp_grade == 'OTHERS') {
        
    }
    if ($wp_grade == 'OTHERS') {
        
    }
	$others = 0;
	$chk = mysql_query("SELECT * FROM outgoing WHERE date='$date' and branch='$branch' and str='$str' and plate_number = '$plate_number' and wp_grade='$wp_grade' and weight='$weight' and trucking='$trucking'") or die (mysql_error());
	
    if ($wp_grade != 'LCOTHERS') {
        if ($weight > 0 && mysql_num_rows($chk) < 1) {
            if (mysql_query("INSERT INTO outgoing(str,date,trucking,plate_number,wp_grade,weight,branch)
            VALUES('$str','$date','$trucking','$plate_number','$wp_grade','$weight','$branch')")) {
                $counter++;
            }else {
                $failed_to_insert++;
            }
        }else if(mysql_num_rows($chk) > 0){
					if(mysql_query("UPDATE outgoing SET str='$str',date='$date',trucking='$trucking', plate_number='$plate_number',wp_grade='$wp_grade',weight='$weight',branch='$branch' WHERE date='$date' and branch='$branch' and str='$str' and plate_number = '$plate_number' and wp_grade='$wp_grade' and weight='$weight' and trucking='$trucking'")){
					$counter++;
					}else{
					$failed_to_insert++;
					}
			}
    }else{
		$others++;
	}
    $ctr++;
}
echo "<script>";
echo "alert('$counter records has been inserted successfully...');";
echo "alert('$failed_to_insert records failed to insert...');";
echo "alert('$others records failed to insert...');";
echo "window.history.back();";
echo "</script>";
?>