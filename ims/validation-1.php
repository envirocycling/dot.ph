<?php

session_start();
include('config.php');
$username = $_POST['username'];
$password = $_POST['password'];
$_SESSION['usertype'] = "";
$result = mysql_query("SELECT * FROM users where user_id='$username' and password='$password'");
$checker = 0;
while ($row = mysql_fetch_array($result)) {
    $checker++;
    $_SESSION['encoding_branch_delivered'] = $row['branch'];
    $_SESSION['username'] = $username;
    $_SESSION['initial'] = $row['initial'];
    $_SESSION['user_branch'] = $row['branch'];
    $_SESSION['usertype'] = $row['user_type'];
    $_SESSION['weekly_branch'] = $row['branch'];
    $_SESSION['position'] = $row['position'];
	$_SESSION['main'] = $row['main'];
}
if ($checker > 0) {
    mysql_query("INSERT INTO login_frequency(user,login_date) values('$username','" . date('Y/m/d') . "')");
    if ($_SESSION['usertype'] == 'RMD Supervisor') {
        header('Location:rmd_data.php');
    } else if ($_SESSION['usertype'] == 'Tipco Accounting') {
        header('Location:tipco_multiply_billings.php');
    } else if ($_SESSION['usertype'] == 'PLD Tipco') {
        header('Location:frm_daily_sales_analysis.php');
    } else {
        header('Location:dashboard_receiving.php');
    }
} else {
    echo "<script>
           alert('Unregistered Account');
           window.location = 'index.php';
         </script>";
}
?>