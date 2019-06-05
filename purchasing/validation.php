<?php

session_start();
include('config.php');
$username = $_POST['username'];
$pass = $_POST['pass'];
$_SESSION['check_req_type'] = 'all_me';
$_SESSION['check_req_status'] = 'pending';
$result = mysql_query("SELECT * FROM users where user_id='$username' and password='$pass'");
$checker = 0;
while ($row = mysql_fetch_array($result)) {
    $checker++;
    $usertype = $row['type'];
    $user = $row['user_id'];
    $branch = $row['branch'];
    $position = $row['position'];
    $name = $row['name'];
    $authority = $row['authority'];
    $user_type = $row['user_type'];
}
if ($checker > 0) {
    $_SESSION['name'] = $name;
    $_SESSION['username'] = $user;
    $_SESSION['usertype'] = $usertype;
    $_SESSION['branch'] = $branch;
    $_SESSION['position'] = $position;
    $_SESSION['authority'] = $authority;
    $_SESSION['user_type'] = $user_type;
    if($_SESSION['user_type'] == 'view') {
        header('Location:prRequests_mecha.php');
    } else {
        header('Location:home.php');
    }
} else {
    echo "<script>
            alert('Unregistered Account');
            window.location = 'index.php';
         </script>";
}
?>