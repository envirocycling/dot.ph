<?php
include 'config.php';
$note = $_SESSION['username'];
$id = $_POST['id'];
$unit_cost = $_POST['unit_cost'];
$weight = $_POST['weight'];
$paper_buying = $unit_cost*$weight;
$sql_paper = mysql_query("SELECT * from paper_buying WHERE log_id='$id'") or die(mysql_error());

if(mysql_num_rows($sql_paper) > 0){
    $row_paper = mysql_fetch_array($sql_paper);
    $prev_cost = $row_paper['unit_cost'];
    mysql_query("UPDATE paper_buying SET unit_cost='$unit_cost',corrected_weight='$weight', prev_unit_cost= '$prev_cost' ,paper_buying='$paper_buying', status='update', notes='$note' WHERE log_id='$id'");
}
?>