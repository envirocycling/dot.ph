<link rel="stylesheet" href="css/styles.css">
<?php
include('connect.php');
$id = $_GET['id'];
$date = $_POST['date'];
$hrm = $_POST['hrm'];
$remarks = mysql_real_escape_string($_POST['remarks']);

$sql_chk = mysql_query("SELECT * from tbl_hrm WHERE truck_id = '$id' ORDER BY date DESC LIMIT 1") or die(mysql_error());
$row_chk = mysql_fetch_array($sql_chk);

if($hrm >= $row_chk['hrm']) {
    mysql_query("INSERT INTO tbl_hrm (truck_id, date, hrm, remarks) VALUES('$id', '$date', '$hrm', '$remarks')");
    echo '<script>
        alert("Successful");
            location.replace("hrm_recording.php?page=recording");
        </script>';
}
?>