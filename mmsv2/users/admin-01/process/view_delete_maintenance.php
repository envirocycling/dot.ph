<?php

session_start();
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');

$company_id = $_POST['company_id'];
$date_updated = date('Y/m/d H:i');
$branch_id = $_POST['branch_id'];
$position_id = $_POST['position_id'];
$rank_id = $_POST['rank_id'];
$a_id = $_POST['a_id'];
$a_iddel = $_POST['a_iddel'];
if ($company_id > 0) {
    mysql_query("UPDATE company SET status='deleted', date_updated='$date_updated', user_id='" . $_SESSION['user_id'] . "' WHERE company_id='$company_id'") or die(mysql_error());
} else if ($branch_id > 0) {
    mysql_query("UPDATE branches SET status='deleted', date_updated='$date_updated', user_id='" . $_SESSION['user_id'] . "' WHERE branch_id='$branch_id'") or die(mysql_error());
} else if ($position_id > 0) {
    mysql_query("UPDATE positions SET status='deleted', date_updated='$date_updated', user_id='" . $_SESSION['user_id'] . "' WHERE p_id='$position_id'") or die(mysql_error());
} else if ($a_id > 0) {
    mysql_query("UPDATE announcement SET status='" . $_POST['status'] . "' WHERE a_id='$a_id'") or die(mysql_error());
} else if ($a_iddel > 0) {
    $sql_ann = mysql_query("SELECT * from announcement WHERE a_id='$a_iddel'");
    $row_ann = mysql_fetch_array($sql_ann);
    
    $target_dir = '../../../images/announcement/';
    $chk_fname = $target_dir . $row_ann['image_name'];
    if (file_exists($chk_fname)) {
        unlink($chk_fname);
        mysql_query("DELETE from announcement WHERE a_id='$a_iddel'") or die(mysql_error());
    }
} else if ($rank_id > 0) {
    mysql_query("DELETE from rank WHERE r_id='$rank_id'") or die(mysql_error());
}


