<?php
date_default_timezone_set("Asia/Singapore");
session_start();
$date = date('Y/m/d');
?>
<?php

	include('connect.php');
	
	$id 			 = $_POST['id'];
    $series_no 		 = strtoupper($_POST['series_no']);
    $old_series_no	 = strtoupper($_POST['old_series_no']);
	$aquisition_cost = $_POST['aquisition_cost'];
	$motor			 = $_POST['motor'];
	$date_purchased  = $_POST['date_purchased'];
	$cylinder 		 = $_POST['cylinder'];
	$date_release 	 = $_POST['date_release'];
	$tonne 			 = $_POST['tonne'];
	$capacity		 = $_POST['capacity'];
	$condition		 = $_POST['condition'];

	$get_series_no = mysql_query("Select * from tbl_bm_report Where series_no = '$series_no'") or die (mysql_error());
	$result_series_no = mysql_fetch_array($get_series_no);
	
	if($result_series_no['series_no'] == $series_no && $old_series_no != $series_no) { ?>

        <script type= "text/javascript">
            alert("Bail Machine Already Exist.");
            location.replace('existing_bm.php');
        </script>

    <?php } else {

        //mysql_query("UPDATE `tbl_bm_report` SET `series_no`='$series_no',`aquisition_cost`='$aquisition_cost',`motor`='$motor',`date_purchased`='$date_purchased',`cylinder`='$cylinder',`date_purchased='$date_purchased',`tonne`='$tonne',`capacity`='$capacity',`condition`='$condition' WHERE `id`=$id;") or die (mysql_error());

        $query = "UPDATE `tbl_bm_report` SET `series_no`='$series_no',`date_purchased`='$date_purchased',`date_release`='$date_release',`aquisition_cost`='$aquisition_cost',`motor`='$motor',`cylinder`='$cylinder',`tonne`='$tonne',`capacity`='$capacity',`condition`='$condition' WHERE id='$id';";

        mysql_query($query) or die(mysql_error());
    
    ?>

		<script type= "text/javascript">
			alert("Updated Successful.");
			location.replace('existing_bm.php');
		</script>

	<?php } ?>