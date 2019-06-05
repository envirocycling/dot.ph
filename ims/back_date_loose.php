<?php
include 'config.php';

$sql = mysql_query("SELECT * FROM loose_papers WHERE branch='Cainta' and date='2015/05/23'");
while($rs = mysql_fetch_array($sql)) {
//    echo $rs['date']."-".date("Y/m/d", strtotime("-1 day", strtotime($rs['date'])))."<br>";
//    mysql_query("UPDATE loose_papers SET date='".date("Y/m/d", strtotime("-1 day", strtotime($rs['date'])))."' WHERE log_id='".$rs['log_id'] ."'");
}

?>