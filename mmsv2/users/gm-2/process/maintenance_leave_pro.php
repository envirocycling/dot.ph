<?php
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');

$emp_num = $_POST['employee'];
$vl = $_POST['vl'];
$sl = $_POST['sl'];
$date_effective = $_POST['date_effective'];

$sql_chk = mysql_query("SELECT * from entitled_leaves WHERE emp_num = '$emp_num'") or die(mysql_error());
$row_chk = mysql_fetch_array($sql_chk);

if(mysql_num_rows($sql_chk) > 0){
    if($row_chk['period'] != 0){     
        $date_range = date('Y-m-d', strtotime('+6 month', strtotime($date_effective)));
        //$period = $row_chk['period'] - 1;
    }else{
         $date_range = date('Y-m-d', strtotime('+1 year', strtotime($date_effective)));
         //$period = $row_chk['period'];
    }
    if(mysql_query("UPDATE entitled_leaves SET vl='$vl', sl='$sl', date_effective='$date_effective', date_range='$date_range'  WHERE emp_num='$emp_num' ") or die(mysql_error())){
        echo '<script>
                alert("Successful");
                location.replace("../maintenance_leaves.php?active=maintenance");
            </script>';
    }
}else{
    $date_range = date('Y-m-d', strtotime('+6 month', strtotime($date_effective)));
    if(mysql_query("INSERT INTO entitled_leaves (emp_num, vl, sl, date_effective, date_range, period) VALUES ('$emp_num', '$vl', '$sl', '$date_effective', '$date_range', '2') ") or die(mysql_error())){
      echo '<script>
                alert("Successful");
                location.replace("../maintenance_leaves.php?active=maintenance");
            </script>';  
    }
}