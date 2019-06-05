<style>
    .noti
    {
        font-size: 15px;
        color: white;
        margin-left: 20px;
        margin-top: -38px;
        position: absolute;
        background-image: url(images/noti_1.png);
        background-position: center;
        height: 22px;
        width: 23px;
    }
    .font
    {
        font-size: 15px;
        color: white;
        position: absolute;
        margin-top: 0px;
        margin-left: 7px;
    }
    .noti2
    {
        font-size: 15px;
        color: white;
        margin-left: 20px;
        margin-top: -38px;
        position: absolute;
        background-image: url(images/noti_1.png);
        background-position: center;
        height: 22px;
        width: 23px;
    }
    .font2
    {
        font-size: 15px;
        color: white;
        position: absolute;
        margin-top: 0px;
        margin-left: 3px;
    }
</style>
<?php
session_start();
include 'config.php';
$to_id = $_SESSION['username'];
if ($to_id == 'lonlon') {
    $sql = mysql_query("SELECT * FROM messages WHERE to_id='$to_id' and to_noti=''") or die (mysql_error());
    $count = mysql_num_rows($sql);
    if ($count > '0') {
        echo "<div class='noti2'>";
        echo "<div class='font2'>";
        echo $count;
        echo "</div>";
        echo "</div>";
    }
} else {
    if ($_SESSION['usertype']=='User') {
        $sql = mysql_query("SELECT * FROM messages WHERE to_id='$to_id' and to_noti=''") or die (mysql_error());
        $count = mysql_num_rows($sql);
        if ($count > '0') {
            if ($count < '10') {
                echo "<div class='noti'>";
                echo "<div class='font'>";
                echo $count;
                echo "</div>";
                echo "</div>";
            } else {
                echo "<div class='noti2'>";
                echo "<div class='font2'>";
                echo $count;
                echo "</div>";
                echo "</div>";
            }
        }
    }
}

mysql_close($con);
?>