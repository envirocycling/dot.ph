<?php
session_start();
include('connect.php');

$id = $_GET['id'];

$select4 = mysql_query("Select * from tbl_truck_report Where id='" . $_GET['id'] . "' ") or die(mysql_error());
$row4 = mysql_fetch_array($select4);
$class = $row4['class'];
$wheels = $row4['wheels'] . '/';

$month = explode('-', $_POST['date']);
//$nums = $month[1] + 3;

/* if($nums > 12){
  $m =$month[0] + 1;
  $num = $nums - 12 ;
  }else{$num = $nums;
  $m = $month[0];}
  $mm = $month[2];
  if($month[2] < 8){
  $mm = $month[2] + 21;
  $num = $num - 1;
  if($num == 0){
  $m = $m - 1;
  $num = 12;
  }
  }else { $mm = $month[2] - 7;}
  if($mm < 10){
  $mm = '0'.$mm;
  }
  if($num < 10){
  $num1 = '0'.$num;
  $date = $m.'-'.$num1.'-'.$mm;

  }else{
  $date = $m.'-'.$num.'-'.$mm;
  }

  $next_year = $month[0];
  if($wheels == 2 || $class == 'COMPANY'){
  $next_month = $month[1] + 6;
  }else{
  $next_month = $month[1] + 3;
  }
  echo $next_month.'------';

  $next_day = $month[2];

  if($next_month > 12){
  $next_month = $next_month - 12;
  $next_year = $next_year + 1;
  }if($next_month <= 9){
  $next_month = '0'.$next_month;
  }
 */
if ($class == 'HE') {
    $remarks = $_POST['remarks'];
    $last_hrm = $_POST['from'];

    foreach ($_POST['type'] as $type) {
        $sql_coSet = mysql_query("SELECT * from tbl_changeoilset WHERE id = '" . $row4['coSet'] . "'") or die(mysql_error());
        $row_coSet = mysql_fetch_array($sql_coSet);
        $next = $row_coSet[$type] + $last_hrm;
        mysql_query("UPDATE tbl_truck_report SET $type='$next' WHERE id='" . $row4['id'] . "'") or die(mysql_error());
        $sType = strtoupper(str_replace('_', ' ', $type));
        $remarks .= '<li>' . $sType . '</li>';
    }

    $select = mysql_query("Select * from tbl_changeoil Where truckid='" . $_GET['id'] . "'  Order by id Desc LIMIT 1 ") or die(mysql_error());
    $rows = mysql_fetch_array($select);
    if (mysql_num_rows($select) > 0) {
        mysql_query("Update tbl_changeoil Set tos='" . $_POST['from'] . "' Where id='" . $rows['id'] . "'") or die(mysql_error());
    }

    $oil = mysql_query("Insert into tbl_changeoil (truckid,date,performedby,remarks,froms)
Values('" . $_GET['id'] . "','" . $_POST['date'] . "','" . $_POST['performedby'] . "','$remarks','" . $_POST['from'] . "')") or die(mysql_error());
} else {
    if (($wheels == 2 || $class == 'COMPANY')) {
        $next = date('Y-m-d', (strtotime('+6 month', strtotime($_POST['date']))));
    } else {
        $next = date('Y-m-d', (strtotime('+3 month', strtotime($_POST['date']))));
    }
//$next = $next_year.'-'.$next_month.'-'.$next_day;

    $select = mysql_query("Select * from tbl_changeoil Where truckid='" . $_GET['id'] . "'  Order by id Desc LIMIT 1 ") or die(mysql_error());
    $rows = mysql_fetch_array($select);
    if (mysql_num_rows($select) > 0) {
        mysql_query("Update tbl_changeoil Set tos='" . $_POST['from'] . "' Where id='" . $rows['id'] . "'") or die(mysql_error());
    }

    $oil = mysql_query("Insert into tbl_changeoil (truckid,date,performedby,remarks,froms)
Values('" . $_GET['id'] . "','" . $_POST['date'] . "','" . $_POST['performedby'] . "','" . $_POST['remarks'] . "','" . $_POST['from'] . "')") or die(mysql_error());

    $ch = mysql_query("Update tbl_changeoil Set changes='" . $_POST['date'] . "',next='$next' Where truckid='" . $_GET['id'] . "'") or die(mysql_error());
    $select = mysql_query("Select * from tbl_changeoil Where truckid='$id' Order by date Desc LIMIT 1") or die(mysql_error());
    $row = mysql_fetch_array($select);

//$oil_next = date('Y-m-d', strtotime('+3 month',strtotime($row['date'])));
//$oil_next = date('Y-m-d', strtotime('-7 day',strtotime($oil_next1)));
    if (mysql_num_rows($select) == 1) {
        $upadate = mysql_query("Update tbl_truck_report Set oil='" . $row['date'] . "', oil_next='" . $row['next'] . "' Where id='" . $_GET['id'] . "'") or die(mysql_error());
    }
}
?>

<script>
    alert("Update Successful.");
    window.history.back();
</script>