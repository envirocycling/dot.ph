<?php
session_start();
include ('config.php');
$del_id=$_GET['del_id'];
$processed_by=$_SESSION['username'];
$date_processed=date('Y/m/d');
$time_processed=date('H:i');
$remarks="Processed by: <u><i>".$_SESSION['username']."</u></i><br> last <u><i>".date('M d, Y H:i')."</i></u>";
if(mysql_query("UPDATE incentive_scheme set remarks='$remarks' where del_id='$del_id'") or die(mysql_error())) {
   /* mysql_query("INSERT INTO inc_processing (del_id,processed_by,date_processed,time_processed)
                            VALUES('$del_id','$processed_by','$date_processed','$time_processed');") or die(mysql_error());*/
    $sql_inc = mysql_query("SELECT * FROM incentive_scheme WHERE del_id='$del_id'") or die(mysql_error());
    $rs_inc = mysql_fetch_array($sql_inc);

    $from = $rs_inc['start_date'];
    $to = $rs_inc['end_date'];
    $incentive = $rs_inc['incentive'];
    $sup_id = $rs_inc['sup_id'];
    $wp_grade = $rs_inc['wp_grade'];

    if ($wp_grade == 'all_grades') {
        $wp_grade = '';
    }
//echo "SELECT * FROM paper_buying WHERE wp_grade like '%$wp_grade%' and date_received>='$from' and date_received<='$to' and supplier_id='$sup_id'";
    $sql_paper_buy = mysql_query("SELECT * FROM paper_buying WHERE wp_grade like '%$wp_grade%' and date_received>='$from' and date_received<='$to' and supplier_id='$sup_id'") or die(mysql_error());
    while ($rs_paper_buy = mysql_fetch_array($sql_paper_buy)) {
        //if($rs_paper_buy['status'] == 'billed' || $rs_paper_buy['status'] == 'change'){
        /*if($rs_paper_buy['status'] == 'billed'){
            $unit_cost = $rs_paper_buy['unit_cost'];
            $prev_cost = $rs_paper_buy['prev_unit_cost'];
            mysql_query("UPDATE paper_buying SET prev_unit_cost='$prev_cost', unit_cost='$unit_cost' WHERE log_id='".$rs_paper_buy['log_id']."'") or die(mysql_error());
           // echo $unit_cost.'<br>';
        }else */
        if($rs_paper_buy['status'] != 'billed' && $rs_paper_buy['status'] != 'update'){
            $prev_cost = $rs_paper_buy['unit_cost'];
            $unit_cost = $rs_paper_buy['unit_cost'] + $incentive;
            mysql_query("UPDATE paper_buying SET prev_unit_cost='$prev_cost', unit_cost='$unit_cost' WHERE log_id='".$rs_paper_buy['log_id']."'") or die(mysql_error());
            //echo $unit_cost.'='.$incentive.'<br>';
        }
        
    }

    echo "<script>";
    echo "alert('Updated Successfully...');";
    echo "window.history.go(-2);";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to update record...');";
    echo "window.history.go(-2);";
    echo "</script>";
}



?>