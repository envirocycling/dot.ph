<?php
include("connect.php");
@session_start();
$series = $_GET['series'];
$sql_plate = mysql_query("SELECT * from tbl_truck_report WHERE series LIKE '%$series%' and branch LIKE '%".$_SESSION['owner']."%'") or die(mysql_error());
while($row_plate = mysql_fetch_array($sql_plate)){
    if(!empty($_GET['id']) && $_GET['id'] == $row_plate['id']){
        $attr = 'selected';
    }else{
        $attr = '';
    }
    $optVal .= '<option value="'.$row_plate['id'].'" '.$attr.'>'.$row_plate['truckplate'].'</option>';
}
echo $optVal;